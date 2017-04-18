<?
/*
 *
 */

class ParametersCarPrices extends Form {

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
							'table'				=> 'parameters_car_prices'),
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
							'table'				=> 'parameters_car_prices'),
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
							'table'				=> 'parameters_car_prices'),
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
							'table'				=> 'parameters_car_prices'),
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
							'table'				=> 'parameters_car_prices'),
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
							'orderPosition'		=> 3,
                            'width'             => 100,
							'table'				=> 'parameters_car_prices')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersCarPrices($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Вік водіїв';
		$this->messages['single'] = 'Вік водія';
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

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_car_prices ' .
				'WHERE car_price_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_car_prices as a ' .
				'LEFT JOIN ' . PREFIX . '_product_car_prices as b ON a.id = b.car_price_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(car_price_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>ВАРТІСТЬ АВТО:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['car_prices'])) ? $data['car_prices'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="car_prices[' . $row['id'] . ']" value="' . $value . '" maxlength="14" style="width: 100px !important" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="car_prices_title[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['car_prices'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_car_prices ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			$first = true;
			$sql='';
			
			
			foreach ($data['car_prices'] as $id => $value) {
			  if (intval($data['products_id'])) {
					if ($first) $sql =	'INSERT INTO ' . PREFIX . '_product_car_prices (products_id,car_price_id,value,modified) VALUES ' ;
					$sql .=	(!$first ? ',':'').	' ( ' . intval($data['products_id']) . ', '  . intval($id) . ', ' . $db->quote($value) . ',  NOW())';
					$first = false;
				}
			}
			if ($sql) $db->query($sql);
		}
	}
	
	function getIdByPrice($price) {
		if ($price<=150000) return 1;
		if ($price<=800000) return 2;
		return 3;
	}

}

?>