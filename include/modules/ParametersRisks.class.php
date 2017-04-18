<?
/*
 * Title: parameters risks class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersRisks extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'id',
					        'type'				=> fldIdentity,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'parameters_risks'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 100,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'parameters_risks'),
						array(
							'name'				=> 'title_en',
							'description'		=> 'Назва (англійська)',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'parameters_risks'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'parameters_risks'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 2,
							'width'				=> 100,
							'table'				=> 'parameters_risks')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersRisks($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Ризики';
		$this->messages['single'] = 'Ризик';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> false,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> false);
				break;
/*
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
                break;
*/
		}
	}

	function getList($data, $product_types_id) {
		global $db;

         if ($product_types_id == PRODUCT_TYPES_DSKV)
            $conditions[] = 'a.id IN (2,3,8,9,10) ';
        else
            $conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value, b.obligatory ' .
				'FROM ' . PREFIX . '_parameters_risks AS a ' .
				'LEFT JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(risks_id)) ' .
				'WHERE '. implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>РИЗИКИ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['risks'])) ? $data['risks'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="risks[' . $row['id'] . ']" value="' . $value . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />
						<input type="hidden" name="risks_title[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
						<label class="label">обов\'язково до вибору</label>
						<input type ="checkbox" name="risks_obligatory[' . $row['id'] . ']" value="1" ' . (($row['obligatory']) ? 'checked' : '') .' />
					</td>
				</tr>';
		}

		return $result;
	}

	function checkValues($data) {
		global $Log;

        if (is_array($data['risks'])) {
            foreach ($data['risks'] as $id => $value) {

                $params = array($data['risks_title'][ $id ], $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }
	}

	function setValues($data) {
		global $db;
       
		if (is_array($data['risks'])) {

			$sql =	'DELETE ' .
					'FROM ' . PREFIX . '_product_risks ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['risks'] as $id => $value) {

				$sql =	'INSERT INTO ' . PREFIX . '_product_risks SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'risks_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
                        'obligatory =' . intval($data['risks_obligatory'][$id]) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			}

		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$sql =	'SELECT policies_id ' .
				'FROM ' . PREFIX . '_policy_risks ' .
				'WHERE risks_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>Поліси</b>.');
			return false;
		}

		$sql =	'SELECT policies_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE application_risks_id IN(' . implode(', ', $data['id']) . ') OR risks_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>Страхі випадки</b>.');
			return false;
		}

		return parent::deleteProcess($data, $i, $folder);
	}

	//загружаем перечень рисков на странице оформления полиса
    function getListPolicy($product_types_id, $data, $additional, $layout='horisontal') {
        global $db;

        if ($product_types_id == PRODUCT_TYPES_DSKV)
            $conditions[] = 'a.id IN (2,3,8,9,10) ';
        elseif ($product_types_id ==PRODUCT_TYPES_CARGO)
            $conditions[] = 'a.product_types_id = 0' ;
        else
            $conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		if ($product_types_id == PRODUCT_TYPES_NS) {

			$conditions[] = 'b.value > 0';

			if (intval($data['financial_institutions_id'])) {
				$conditions[] = 'b.products_id IN (SELECT DISTINCT products_id FROM ' . PREFIX . '_product_financial_institution_assignments WHERE financial_institutions_id = ' . intval($data['financial_institutions_id']) . ') AND b.products_id IN (SELECT DISTINCT products_id FROM insurance_product_agency_assignments WHERE agencies_id='.intval($data['agencies_id']).')';
			} else {
				$conditions[] = 'b.products_id NOT IN (SELECT DISTINCT products_id FROM ' . PREFIX . '_product_financial_institution_assignments WHERE financial_institutions_id != ' . intval($data['financial_institutions_id']) . ')';

			}

            if($data['types_id'] == POLICY_TYPES_AGREEMENT) {
            $sql =  'SELECT DISTINCT a.id, a.title, b.obligatory ' .
                        'FROM ' . PREFIX . '_parameters_risks AS a ' .
                        'LEFT JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
                        'WHERE ' . implode(' AND ', $conditions) . ' ' .
                        'ORDER BY a.order_position';

            }
            else {
            $sql = 'SELECT DISTINCT a.id, a.title ' .
                   'FROM ' . PREFIX . '_parameters_risks AS a ' .
                   'WHERE product_types_id = ' . PRODUCT_TYPES_NS . ' ' .
                   'ORDER BY a.order_position';
            }
		}
		elseif($product_types_id ==PRODUCT_TYPES_NS_TRANSPORT) {
			  $sql =  'SELECT DISTINCT a.id, a.title, b.obligatory ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'LEFT JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.order_position';
		}
        else {

        $sql =  'SELECT DISTINCT a.id, a.title ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'LEFT JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.order_position';
        }
		$list = $db->getAll($sql );
        if (is_array($list)) {
            $result = '<table class="expressproduct testdriveproduct" id="risksBlock" cellpadding="5" cellspacing="0" style="display: ' . (($data['financial_institutions_id'] && $product_types_id != PRODUCT_TYPES_NS) ? 'none' : 'block') . '">';

            if ($layout == 'horisontal') {
                $result .= '<tr>';
            }

            foreach ($list as $row) {

                if ($layout == 'vertical') {
                    $result .= '<tr>';
                }

                $result .= '<td class="label grey">' . $row['title'] . ':</td>';
                $result .= '<td>';

                if ($row['obligatory']) {
                    $result .= '<input class="riskbox" type="checkbox" name="risks' . $row['id'] . '" checked disabled onclick="calculate();" />';
                    $result .= '<input type="hidden" name="risks[]" value="' . $row['id'] . '" />';
                } else {
                    $result .= '<input class="riskbox" type="checkbox" name="risks[]" value="' . $row['id'] . '" ' . ((is_array($data['risks']) && in_array($row['id'], $data['risks'])) ? 'checked' : '') . ' ' . $additional . ' onclick="calculate(); checkValidRisks(' . intval($row['id']) . ')" />';
                }

                $result .= '</td>';

                if ($layout == 'vertical') {
                    $result .= '</tr>';
                }
            }

            if ($layout == 'horisontal') {
                $result .= '</tr>';
            }

            $result .= '</table>';
        }

        return $result;
    }

	function getListPolicyInWindow($data) {
		echo $this->getListPolicy($data['product_types_id'], $data, $this->getReadonly(true) . ' onclick="calculate()"');
		exit;
	}

    function setAll($product_types_id) {
        global $db;

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_parameters_risks ' .
                'WHERE product_types_id = ' . intval($product_types_id);
        return $db->getCol($sql);
    }

    function getRate($products_id, $risks) {
        global $db;

        $rate = 0;

        if (is_array($risks)) {
            $conditions[] = 'products_id = ' . intval($products_id);
            $conditions[] = 'risks_id IN(' . implode(', ', $risks) . ')';

            $sql =  'SELECT SUM(value) ' .
                    'FROM ' . PREFIX . '_product_risks ' .
                    'WHERE ' . implode(' AND ', $conditions);
            $rate = $db->getOne($sql);
        }

        return $rate;
    }

    function getArrayByPoliciesId($policies_id) {
        global $db;

        $sql =  'SELECT c.title, 1 as value ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policy_risks AS d ON a.id=d.policies_id ' .
                'JOIN ' . PREFIX . '_parameters_risks AS c ON d.risks_id = c.id ' .
                'WHERE a.id = ' . intval($policies_id) . ' ' .
                'ORDER BY c.order_position';
        return $db->getAll($sql);
    }
	
	function getListForHTML($data) {
		global $db;
		
		$conditions[] = '1';
		if ($data['product_types_id']) {
			if (is_array($data['product_types_id'])) {
				$conditions[] = 'product_types_id IN (' . implode(', ', $data['product_types_id']) . ')';
			} else {
				$conditions[] = 'product_types_id = ' . intval($data['product_types_id']);
			}
		}
				
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_parameters_risks ' .
			   'WHERE ' . implode(' AND ', $conditions);
		$list = $db->getAll($sql);
		
		$result = '<select name="risks_id[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';
		foreach ($list as $row) {
			$result .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['risks_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
		}
		$result .= '</select>';
		
		return $result;
	}
}

?>