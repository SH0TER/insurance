<?
/*
 * Title: reinsurance agreement deductible class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ReinsuranceAgreementDeductibles extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'reinsurance_agreement_deductibles'),
                        array(
                            'name'              => 'title',
                            'description'       => 'Назва',
                            'type'              => fldUnique,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'reinsurance_agreement_deductibles'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'                => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'reinsurance_agreement_deductibles'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'                => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 4,
                            'width'             => 100,
                            'table'             => 'reinsurance_agreement_deductibles')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 2,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'title'
                    )
            );

    function ReinsuranceAgreementDeductibles($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Франшизи';
        $this->messages['single'] = 'Франшиза';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'add'       => false,
                    'edit'      => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ 'ReinsuranceAgreements' ];
				break;
        }
    }

    function isExists($table, $field, $value, $id = 0, $data = null) {
        global $db;

        $conditions[] = $field . '=' . $db->quote($value) . ' AND id <> ' . intval($id);

        $sql =  'SELECT count(*) ' .
                'FROM ' . $table . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $count = $db->getOne($sql);

        return ($count != 0);
    }

    function view($data) {
        if ($data['deductibles_id']) {
            $data['id'] = $data['deductibles_id'];
        }

        $row = parent::view($data);

        $data['deductibles_id'] = $row['id'];
    }

    function getSign($absolute) {
        return ($absolute)? ' грн.' : '%';
    }

    function getList($data, $product_types_id) {
        global $db;

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_car_types ' .
				'WHERE product_types_id = ' . intval($product_types_id);
		$car_types = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><br /><b>ФРАНШИЗИ:</b></td></tr>';

		$result .= '<tr><td>&nbsp;</td><td><table id="deductibles" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;">';
		$result .= '<tr class="columns"><td rowspan="2">Тип ТЗ</td><td colspan="2">Франшизи</td><td colspan="2">Базовий тариф</td><td rowspan="2">СНГ</td><td rowspan="2" style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addDeductible(this)" /></td></tr>';

		$result .= '<tr class="columns">';

		$result .= '<td>Пошкодження</td>';
		$result .= '<td>Викрадення</td>';

		$result .='<td>Пошкодження</td>';
		$result .='<td>Повне КАСКО</td>';

		$result .= '</tr>';

		if (!is_array($data['deductibles'])) {
			$sql =  'SELECT * ' .
					'FROM ' . PREFIX . '_reinsurance_agreement_deductibles AS a ' .
					'WHERE a.agreements_id = ' . intval($data['agreements_id']) . ' ' .
					'ORDER BY car_types_id, sng DESC, value1, value0 ASC';
			$data['deductibles'] = $db->getAll($sql);
		}

		if (is_array($data['deductibles']) && sizeOf($data['deductibles'])) {
			foreach ($data['deductibles'] as $i => $row) {
				if ($row['id'] == NULL) $row['id'] = $i;

				$result .=
					'<tr class="row' . (($i % 2) ? '1' : '0') . '">' .
						'<td><select name="deductibles[' . $row['id'] . '][car_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';

				foreach ($car_types as $j=>$car_type) {
						$result .='<option value="' . $j . '" ' . ($row['car_types_id'] == $j ? 'selected' : '') . '>' . $car_type . '</option>';
				}

				$result .='</select></td>'.
						'<td><input type="text" name="deductibles[' . $row['id'] . '][value0]" value="' . $row['value0'] . '" maxlength="5" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $row['id'] . '][absolute0]" value="0" ' . (($row['absolute0'] == 0) ? 'checked' : '') . ' />% <input type="radio" name="deductibles[' . $row['id'] . '][absolute0]" value="1" ' . (($row['absolute0'] == 1) ? 'checked' : '') . ' /> грн.</td>' .
						'<td><input type="text" name="deductibles[' . $row['id'] . '][value1]" value="' . $row['value1'] . '" maxlength="5" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $row['id'] . '][absolute1]" value="0" ' . (($row['absolute1'] == 0) ? 'checked' : '') . ' />% <input type="radio" name="deductibles[' . $row['id'] . '][absolute1]" value="1" ' . (($row['absolute1'] == 1) ? 'checked' : '') . ' /> грн.</td>' .
						'<td><input type="text" name="deductibles[' . $row['id'] . '][value_other]" value="' . $row['value_other'] . '" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
						'<td><input type="text" name="deductibles[' . $row['id'] . '][value_hijacking]" value="' . $row['value_hijacking'] . '" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
						'<td><input type="checkbox" name="deductibles[' . $row['id'] . '][sng]" value="1" '.($row['sng'] ? 'checked':'').' /></td>' .
						'<td style="padding-left: 10px;"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteDeductible(this)" /></td>' .
					'</tr>';
			}
		} else {
			$i = 0;
				 $result .=
						'<tr>' .
							'<td><select name="deductibles[' . $i . '][car_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';"> ';
					foreach ($car_types as $j=>$car_type) {
							$result .= '<option value="' . $j . '" '  .($row['car_types_id'] == $j ? 'selected' : '') . '>' . $car_type . '</option>';
					}					
					$result .='</select></td>'.
					'<td><input type="text" name="deductibles[' . $i . '][value0]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $i . '][absolute0]" value="0" />% <input type="radio" name="deductibles[' . $i . '][absolute0]" value="1" /> грн.</td>' .
					'<td><input type="text" name="deductibles[' . $i . '][value1]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $i . '][absolute1]" value="0" />% <input type="radio" name="deductibles[' . $i . '][absolute1]" value="1" /> грн.</td>' .
					'<td><input type="text" name="deductibles[' . $i . '][value_other]" value="" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td><input type="text" name="deductibles[' . $i . '][value_hijacking]" value="" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td><input type="checkbox" name="deductibles[' . $row['id'] . '][sng]" value="1" '.($row['sng'] ? 'checked':'').' /></td>' .
					'<td style="padding-left: 10px;"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteDeductible(this)" /></td>' .
				'</tr>';
		}

		$result .= '</table>';

		$car_type = '';
		foreach ($car_types as $car_types_id => $car_typesTitle) {
			$car_type .= '<option value="' . $car_types_id . '">' . $car_typesTitle . '</option>';
		}

		$result .= '
<script type="text/javascript">
    numDeductible = -1;
    function addDeductible(obj) {
        var row			= document.getElementById(\'deductibles\').insertRow(-1);

		var cell		= row.insertCell(0);
        cell.innerHTML	= \'<select name="deductibles[\' + numDeductible + \'][car_types_id]" value="" class="fldSelect" onfocus="this.className=\\\'fldSelectOver\\\';" onblur="this.className=\\\'fldSelect\\\';" />' . $car_type . '</select>\';

		cell			= row.insertCell(-1);
        cell.innerHTML	= \'<input type="text" name="deductibles[\' + numDeductible + \'][value0]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\\\'fldMoneyOver\\\';" onblur="this.className=\\\'fldMoney\\\';" /> <input type="radio" name="deductibles[\' + numDeductible + \'][absolute0]" value="0" />% <input type="radio" name="deductibles[\' + numDeductible + \'][absolute0]" value="1" /> грн.\';

        cell			= row.insertCell(-1);
        cell.innerHTML	= \'<input type="text" name="deductibles[\' + numDeductible + \'][value1]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\\\'fldMoneyOver\\\';" onblur="this.className=\\\'fldMoney\\\';" /> <input type="radio" name="deductibles[\' + numDeductible + \'][absolute1]" value="0" />% <input type="radio" name="deductibles[\' + numDeductible + \'][absolute1]" value="1" /> грн.\';

        cell			= row.insertCell(-1);
        cell.innerHTML	= \'<input type="text" name="deductibles[\' + numDeductible + \'][value_other]" value="" maxlength="10" class="fldPercent" onfocus="this.className=\\\'fldPercentOver\\\';" onblur="this.className=\\\'fldPercent\\\';" />\';

        cell			= row.insertCell(-1);
        cell.innerHTML	= \'<input type="text" name="deductibles[\' + numDeductible + \'][value_hijacking]" value="" maxlength="10" class="fldPercent" onfocus="this.className=\\\'fldPercentOver\\\';" onblur="this.className=\\\'fldPercent\\\';" />\';
		
		cell			= row.insertCell(-1);
        cell.innerHTML	= \'<input type="checkbox" name="deductibles[\' + numDeductible + \'][sng]" value="1" />\';

        cell			= row.insertCell(-1);
        cell.innerHTML	= \'<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteDeductible(this)" />\';

        numDeductible--;
    }

    function deleteDeductible(obj) {
        if (confirm(\'Ви дійсно бажаєте вилучити вибранний набір франшиз?\')) {
            document.getElementById(\'deductibles\').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );
        }
    }
	</script>';

        return $result;
    }

    function setValues($data) {
        global $db;

        if (is_array($data['deductibles'])) {

            foreach ($data['deductibles'] as $id => $row) {
                if ($id > 0) {
                    $ids[] = $id;
                }
            }

            if (is_array($ids)) {
                $sql =	'DELETE FROM ' . PREFIX . '_reinsurance_agreement_deductibles ' .
                    	'WHERE agreements_id = ' . intval($data['agreements_id']) . ' AND id NOT IN(' . implode(', ', $ids) . ')';
                $db->query($sql);
            }

            foreach ($data['deductibles'] as $id => $row) {
                if ($id <= 0) {
                    $sql =  'INSERT INTO ' . PREFIX . '_reinsurance_agreement_deductibles SET ' .
                            'agreements_id = ' . intval($data['agreements_id']) . ', ' .
                            'deductibles_id0 = ' . intval($data['deductibles_id0']) . ', ' .
                            'value0 = ' . $db->quote($row['value0']) . ', ' .
                            'absolute0 = ' . intval($row['absolute0']) . ', ' .
                            'deductibles_id1 = ' . intval($data['deductibles_id1']) . ', ' .
                            'value1 = ' . $db->quote($row['value1']) . ', ' .
                            'absolute1= ' . intval($row['absolute1']) . ', ' .
							'car_types_id = ' . $db->quote($row['car_types_id']) . ', ' .
                            'value_other = ' . $db->quote($row['value_other']) . ', ' .
							'value_hijacking = ' . $db->quote($row['value_hijacking']) . ', ' .
							'sng = ' . intval($row['sng']) . ', ' .
                            'created = NOW(), ' .
                            'modified = NOW()';
                } else {
                    $sql =  'UPDATE ' . PREFIX . '_reinsurance_agreement_deductibles SET ' .
                            'deductibles_id0 = ' . intval($data['deductibles_id0']) . ', ' .
                            'value0 = ' . $db->quote($row['value0']) . ', ' .
                            'absolute0 = ' . intval($row['absolute0']) . ', ' .
                            'deductibles_id1 = ' . intval($data['deductibles_id1']) . ', ' .
                            'value1 = ' . $db->quote($row['value1']) . ', ' .
                            'absolute1= ' . intval($row['absolute1']) . ', ' .
							'car_types_id = ' . $db->quote($row['car_types_id']) . ', ' .
                            'value_other = ' . $db->quote($row['value_other']) . ', ' .
							'value_hijacking = ' . $db->quote($row['value_hijacking']) . ', ' .
							'sng = ' . intval($row['sng']) . ', ' .
                            'modified = NOW() ' .
                            'WHERE id = ' . intval($id) . ' AND agreements_id = ' . intval($data['agreements_id']);
                }

                $db->query($sql);
            }
        }
    }
}

?>