<?
/*
 * Title: parameters property section class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersPropertySections extends Form {

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
							'table'				=> 'parameters_property_sections'),

						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 50,
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
							'table'				=> 'parameters_property_sections'),
						array(
							'name'				=> 'order_position',
							'description'		=> 'Порядок виводу',
					        'type'				=> fldOrderPosition,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'parameters_property_sections'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'parameters_property_sections'),
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
							'orderPosition'		=> 4,
                            'width'             => 100,
							'table'				=> 'parameters_property_sections')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersPropertySections($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Категорії майна';
		$this->messages['single'] = 'Категорія майна';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'		=> true,
					'update'		=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> true);
				break;
/*
			case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
				break;
*/
		}
	}

	function getList($data) {
		global $db;

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_property_sections as a ' .
				'LEFT JOIN ' . PREFIX . '_product_property_sections as b ON a.id = b.property_sections_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(property_sections_id)) ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>КАТЕГОРІЇ МАЙНА:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['propery_sections'])) ? $data['propery_sections'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ', грн.:</td>
					<td>
						<input type="text" name="propery_sections[' . $row['id'] . ']" value="' . $value . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />
						<input type="hidden" name="propery_sectionsTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['propery_sections'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_property_sections ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['propery_sections'] as $id => $value) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_property_sections SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'property_sections_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			}
		}
	}

    function getJavaScriptArray($data) {
        global $db;

        $conditions[] = '';

        $sql =  'SELECT a.id, b.property_sections_id, c.title, b.value ' .
                'FROM ' . PREFIX . '_products as a ' .
                'JOIN ' . PREFIX . '_product_property_sections as b ON a.id = b.products_id ' .
                'JOIN ' . PREFIX . '_parameters_property_sections as c ON b.property_sections_id = c.id ' .
                'ORDER BY products_id, property_sections_id';
        $list = $db->getAll($sql, 3600);

		$result = '';

		if ($list) {
			$result = "var property_sections = new Array();\r\n";
			foreach ($list as $i => $row) {
				$result .= "property_sections[" . $i . "] = Array('" . $row['id'] . "', '" . $row['property_sections_id'] . "', '" . $row['value'] . "');\r\n";
			}
		}

        return $result;
    }

    function getListPolicy($data, $additional) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_parameters_property_sections ' .
                'ORDER BY order_position';
        $list = $db->getAll($sql, 30 * 60);

        $result = '';
        if (is_array($list)) {

            $result = '<table cellspacing="0" cellpadding="5"><tr>';

            foreach ($list as $i => $row) {
                $result .= '<td align="right">' . $row['title'] . ':</td>';
                $result .= '<td><input type="text" id="property_sectionsValue' . $row['id'] . '" name="property_sections[value][' . $row['id'] . ']" value="' . $data['property_sections']['value'][ $row['id'] ] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" ' . Policies::getReadonly(false, true) . ' /></td>';
                $result .= '<td><input type="checkbox" name="property_sections[id][' . $row['id'] . ']" value="' . $row['id'] . '" ' . ((is_array($data['property_sections']['id']) && in_array($row['id'], $data['property_sections']['id'])) ? 'checked' : '') . ' onclick="getRate(this)" ' . (($row['order_position'] == 1) ? 'readonly' : $additional) . ' /></td>';
            }

            $result .= '</tr></table>';
        }

        return $result;
    }

    function getArrayByPoliciesId($policies_id) {
        global $db;

        $sql =  'SELECT c.title, b.value, k.rate_dskv as rate, round(b.value * k.rate_dskv/100, 2) as amount ' .
                'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_dskv k ON a.id = k.policies_id ' .
                'JOIN ' . PREFIX . '_policies_dskv_property_sections AS b ON a.id = b.policies_id ' .
                'RIGHT JOIN ' . PREFIX . '_parameters_property_sections AS c ON b.property_sections_id = c.id ' .
                'WHERE a.id = ' . intval($policies_id) . ' ' .
                'ORDER BY c.order_position';
        return $db->getAll($sql, 300);
    }
 }

?>