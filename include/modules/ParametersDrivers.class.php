<?
/*
 * Title: parameters driver class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersDrivers extends Form {

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
							'table'				=> 'parameters_drivers'),
						array(
							'name'				=> 'product_types_id',
							'description'		=> 'Тип страхового продукту',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'parameters_drivers'),
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
							'table'				=> 'parameters_drivers'),
						array(
							'name'				=> 'limitation',
							'description'		=> 'Верхній ліміт',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'parameters_drivers'),
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
							'orderPosition'		=> 3,
							'table'				=> 'parameters_drivers'),
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
							'table'				=> 'parameters_drivers'),
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
							'table'				=> 'parameters_drivers')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersDrivers($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Кількість осіб допущених до керування';
		$this->messages['single'] = 'Кількість осіб допущених до керування';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
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

	function isExists($table, $field, $value, $id = 0, $data = null) {
		global $db;

		$conditions[] = $field . '=' . $db->quote($value) . ' AND id <> ' . intval($id);
		$conditions[] = 'product_types_id = ' . intval($data['product_types_id']);

		$sql =	'SELECT count(*) ' . 
				'FROM ' . $table . ' ' . 
				'WHERE ' . implode(' AND ', $conditions);
		$count = $db->getOne($sql);

		return ($count != 0);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_drivers ' .
				'WHERE drivers_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_drivers as a ' .
				'LEFT JOIN ' . PREFIX . '_product_drivers as b ON a.id = b.drivers_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(drivers_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>КІЛЬКІСТЬ ОСІБ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['drivers'])) ? $data['drivers'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="drivers[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="driversTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['drivers'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_drivers ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			$first = true;
			$sql='';
			
			foreach ($data['drivers'] as $id => $value) {
			  if (intval($data['products_id'])) {
					if ($first)$sql =	'INSERT INTO ' . PREFIX . '_product_drivers (products_id,drivers_id,value,modified) VALUES ' ;
					$sql .=	(!$first ? ',':'').	'( ' . intval($data['products_id']) . ', ' . intval($id) . ', ' . $db->quote($value) . ',  NOW())';
					$first = false;
				}
			}
			if ($sql) $db->query($sql);
		}
	}

}

?>