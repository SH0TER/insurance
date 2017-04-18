<?
/*
 * Title: ParametersProperty class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersProperty extends Form {

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
							'table'				=> 'parameters_property'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
					        'maxlength'			=> 250,
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
							'table'				=> 'parameters_property'),
						array(
                            'name'              => 'types_id',
                            'description'       => 'Тип',
                            'type'              => fldRadio,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
							'orderPosition'         => 3,
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'sourceTable'		=> 'parameters_property_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position',
                            'table'             => 'parameters_property'),
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
							'table'				=> 'parameters_property'),
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
							'table'				=> 'parameters_property')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersProperty($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Параметри договору майна';
		$this->messages['single'] = 'Параметри договору майна';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'add'		=> true,
					'edit'		=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> true);
				break;
		}
	}

	function getList($data) {
		global $db;

		$sql =	'SELECT b.id, a.title AS types_title, b.title, c.value ' . 
				'FROM ' . PREFIX . '_parameters_property_types AS a ' .
				'JOIN ' . PREFIX . '_parameters_property AS b ON a.id = b.types_id ' .
				'LEFT JOIN ' . PREFIX . '_product_property_values AS c ON b.id = c.property_id AND c.products_id = ' . intval($data['id']) . '  ' .
				'ORDER BY a.order_position,b.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b><u>ПАРАМЕТРИ МАЙНА:</u></b></td></tr>';
		$types_title='';
		while($res->fetchInto($row)) {
			$value = (is_array($data['propery_values'])) ? $data['propery_values'][ $row['id'] ] : $row['value'];

			if ($row['types_title'] != $types_title) {
				$result .=
					'<tr>
						<td > </td>
						<td>
							<b>'.$row['types_title'].':</b>
						</td>
					</tr>';
			}

			$result .=
				'<tr>
					<td >* ' . $row['title'] . ':</td>
					<td>
						<input type="text" name="propery_values[' . $row['id'] . ']" value="' . $value . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />
					</td>
				</tr>';
			$types_title = $row['types_title'];	
		}

		return $result;
	}
	
	function setValues($data) {
		global $db;

		if (is_array($data['propery_values'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_property_values ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['propery_values'] as $id => $value) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_property_values SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'property_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			}
		}
	}
}

?>