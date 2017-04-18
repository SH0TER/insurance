<?
/*
 * Title: parameters driver standing class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersDriverStandings extends Form {

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
							'table'				=> 'parameters_driver_standings'),
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
							'table'				=> 'parameters_driver_standings'),
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
							'table'				=> 'parameters_driver_standings'),
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
							'table'				=> 'parameters_driver_standings'),
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
							'table'				=> 'parameters_driver_standings'),
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
							'table'				=> 'parameters_driver_standings')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersDriverStandings($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Стаж водіїв';
		$this->messages['single'] = 'Стаж водія';
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
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_driver_standings ' .
				'WHERE driver_standings_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_driver_standings as a ' .
				'LEFT JOIN ' . PREFIX . '_product_driver_standings as b ON a.id = b.driver_standings_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(driver_standings_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>СТАЖ ВОДІЯ (з моменту отримання прав водія):</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['driver_standings'])) ? $data['driver_standings'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="driver_standings[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="driver_standingsTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['driver_standings'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_driver_standings ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			$first = true;
			$sql='';
			
			foreach ($data['driver_standings'] as $id => $value) {
			  if (intval($data['products_id'])) {
				if ($first) $sql =	'INSERT INTO ' . PREFIX . '_product_driver_standings (products_id,driver_standings_id,value,modified) VALUES ' ;
				$sql .=	(!$first ? ',':'').	'(' . intval($data['products_id']) . ', ' . intval($id) . ', ' . $db->quote($value) . ',  NOW())';
				$first = false;
			  }	
			}
			if ($sql) $db->query($sql);
		}
	}

}

?>