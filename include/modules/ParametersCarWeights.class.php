<?
/*
 * Title: parameters car weight class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersCarWeights extends Form {

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
							'table'				=> 'parameters_car_weights'),

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
							'table'				=> 'parameters_car_weights'),
						array(
							'name'				=> 'weight',
							'description'		=> 'Вантажопiд\'ємність',
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
							'table'				=> 'parameters_car_weights'),
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
							'table'				=> 'parameters_car_weights'),
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
							'table'				=> 'parameters_car_weights'),
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
							'table'				=> 'parameters_car_weights')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersCarWeights($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Вантажопiд\'ємність';
		$this->messages['single'] = 'Вантажопiд\'ємність';
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

	

	function getList($data) {
		global $db;

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_car_weights as a ' .
				'LEFT JOIN ' . PREFIX . '_product_car_weights as b ON a.id = b.car_weights_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(car_weights_id)) ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>ВАНТАЖОПІД\'ЄМНІСТЬ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['car_weights'])) ? $data['car_weights'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="car_weights[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="car_weightsTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['car_weights'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_car_weights ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['car_weights'] as $id => $value) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_car_weights SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'car_weights_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			}
		}
	}

	function getIdByWeight($weight) {
		global $db;
		if (intval($weight)==0) return 0;
		$conditions[] = '(weight >= ' . intval($weight) . ' )';

		$sql =	'SELECT id ' . 
				'FROM ' . PREFIX . '_parameters_car_weights  ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY weight ASC ' .
				'LIMIT 1';
		return $db->getOne($sql);
	}
}

?>