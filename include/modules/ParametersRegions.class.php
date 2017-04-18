<?
/*
 * Title: parameters region class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Cities.class.php';

class ParametersRegions extends Form {

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
							'table'				=> 'parameters_regions'),
						array(
							'name'				=> 'product_types_id',
							'description'		=> 'Тип страхового продукту',
					        'type'				=> fldHidden,
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
							'table'				=> 'parameters_regions'),
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
							'table'				=> 'parameters_regions'),
						array(
							'name'				=> 'order_position',
							'description'		=> 'Номер зони',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'parameters_regions'),
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
							'table'				=> 'parameters_regions'),
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
							'table'				=> 'parameters_regions')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersRegions($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Терирорії переважного використання траспортного засобу';
		$this->messages['single'] = 'Терирорія переважного використання траспортного засобу';
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
					'change'	=> true,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
		}
	}

	function isExists($table, $field, $value, $id = 0, $data = null) {
		global $db;

		$sql =	'SELECT count(*) ' .
				'FROM ' . $table . ' ' .
				'WHERE ' . $field . '=' . $db->quote($value) . ' AND id <> ' . intval($id) . ' AND product_types_id = ' . intval($data['product_types_id']);
		$count = $db->getOne($sql);

		return ($count != 0);
	}

	function view($data) {
		if (intval($data['regions_id'])) {
			$data['id'] = $data['regions_id'];
		}

		$row = parent::view($data);

		$data['regions_id'] = $row['id'];

		$fields[]		= 'regions_id';
		$conditions[]	= 'regions_id = ' . intval($data['regions_id']);

		$Cities = new Cities($data);
		$Cities->show($data, $fields, $conditions);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$Cities = new Cities($data);

		$sql =	'SELECT id ' .
				'FROM ' . $Cities->tables[0] . ' ' .
				'WHERE parameters_regions_id IN (' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>Міста</b>.');
			return false;
		}

		$sql =	'DELETE FROM ' . PREFIX . '_product_regions ' .
				'WHERE regions_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_regions as a ' .
				'LEFT JOIN ' . PREFIX . '_product_regions as b ON a.id = b.regions_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(regions_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>ТЕРИТОРІЯ ПЕРЕВАЖНОГО ВИКОРИСТАННЯ ТРАНСПОРТНОГО ЗАСОБУ'.(intval($product_types_id)==PRODUCT_TYPES_KASKO ? ' РIТЕЙЛ' :'').':</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['regions'])) ? $data['regions'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="regions[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="regionsTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['regions'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_regions ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['regions'] as $id => $value) {
			  if (intval($data['products_id'])) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_regions SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'regions_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			   }	
			}
		}
	}

}

?>