<?
/*
 * Title: parameters passenger class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersPassengers extends Form {

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
							'table'				=> 'parameters_passengers'),

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
							'table'				=> 'parameters_passengers'),
						array(
							'name'				=> 'number',
							'description'		=> 'Кiлькiсть пасажирiв',
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
							'table'				=> 'parameters_passengers'),
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
							'table'				=> 'parameters_passengers'),
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
							'table'				=> 'parameters_passengers'),
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
							'table'				=> 'parameters_passengers')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersPassengers($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Кiлькiсть пасажирiв';
		$this->messages['single'] = 'Кiлькiсть пасажирiв';
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
				'FROM ' . PREFIX . '_parameters_passengers as a ' .
				'LEFT JOIN ' . PREFIX . '_product_passengers as b ON a.id = b.passengers_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(passengers_id)) ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>КІЛЬКІСТЬ ПАСАЖИРІВ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['passengers'])) ? $data['passengers'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="passengers[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="passengersTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['engine_sizes'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_passengers ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['passengers'] as $id => $value) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_passengers SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'passengers_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			}
		}
	}

	function getIdByNumber($number) {
		global $db;

		if (intval($number)==0) return 0;

		$conditions[] = '(number >= ' . intval($number) . ' )';

		$sql =	'SELECT id ' . 
				'FROM ' . PREFIX . '_parameters_passengers  ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY number ASC ' .
				'LIMIT 1';
		return $db->getOne($sql);
	}
}

?>