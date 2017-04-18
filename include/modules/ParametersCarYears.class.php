<?
/*
 * Title: parameters engine size class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersCarYears extends Form {

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
							'table'				=> 'parameters_car_years'),
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
							'table'				=> 'parameters_car_years'),
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
							'table'				=> 'parameters_car_years'),
						array(
							'name'				=> 'years',
							'description'		=> 'Кiлькiсть рокiв',
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
							'table'				=> 'parameters_car_years'),
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
							'table'				=> 'parameters_car_years'),
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
							'table'				=> 'parameters_car_years'),
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
							'table'				=> 'parameters_car_years')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersCarYears($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Кiлькiсть рокiв';
		$this->messages['single'] = 'Кiлькiсть рокiв';
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

		$sql =	'DELETE FROM ' . PREFIX . '_product_car_years ' .
				'WHERE car_years_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);
		$car_years = $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_parameters_car_years AS a WHERE ' . implode(' AND ', $conditions) . ' ORDER BY order_position');
		$car_types = $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_car_types WHERE product_types_id = ' . intval($product_types_id));

		$sql =	'SELECT a.id, a.title, b.value_foreign, b.value_sng, car_types_id ' . 
				'FROM ' . PREFIX . '_parameters_car_years AS a ' .
				'LEFT JOIN ' . PREFIX . '_product_car_years AS b ON a.id = b.car_years_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(car_years_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$list =	$db->getAll($sql);

		$result = '<tr><td>&nbsp;</td><td><b>КIЛЬКIСТЬ РОКIВ:</b></td></tr>';
        $result .= '<tr><td>&nbsp;</td><td><table  cellspacing="0" cellpadding="5" style="border: solid 1px #000000;"><tr class="columns" align=center>';
		$result .= '<td rowspan="2">Тип ТЗ</td>';

		foreach ($car_years as $i => $car_year) {
			$result .='<td colspan="2">' . $car_year . '</td>';
		}
		$result .='</tr><tr  class="columns" align="center">';
		foreach ($car_years as $i=>$car_year) {
			$result .='<td>СНГ</td><td>Іноземн.</td>';
		}
		$result .='</tr>';

		foreach ($car_types as $i => $car_type) {
			$result .='<tr class="row0"><td>' . $car_type . '</td>';
			foreach ($car_years as $j => $car_year) {
				$value_sng = 0;
				$value_foreign = 0;
				foreach ($list as $k => $v) {
					if ($v['id'] == $j && $v['car_types_id'] == $i) {
						$value_sng		= $v['value_sng'];
						$value_foreign	= $v['value_foreign'];
						break;
					}
				}
				$result .='<td><input type="text" name="car_years[' . $i . '][' . $j . '][value_sng]" value="' . $value_sng . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>';
				$result .='<td><input type="text" name="car_years[' . $i . '][' . $j . '][value_foreign]" value="' . $value_foreign . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>';
			}
			$result .='</tr>';
		}

		$result .= '</table>';
		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['car_years'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_car_years ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			$first = true;
			$sql='';
			
			foreach ($data['car_years'] as $car_types_id => $value) {
				foreach ($value as $car_year => $row) {
					if (intval($data['products_id'])) {
						if ($first) $sql =	'INSERT INTO ' . PREFIX . '_product_car_years (products_id,car_types_id,car_years_id,value_foreign,value_sng,modified) VALUES ' ;
						$sql .=	(!$first ? ',':'').	' ( ' . intval($data['products_id']) . ', ' .intval($car_types_id) . ', ' . intval($car_year) . ', ' . $db->quote($row['value_foreign']) . ', ' . $db->quote($row['value_sng']) . ', NOW())';
						$first = false;
					}
				}
			}
			if ($sql) $db->query($sql);
		}
	}

	function getIdByYear($product_types_id, $year) {
		global $db;
		
		$year = intval(date('Y')) - intval($year) + 1;
		
		$conditions[] = 'product_types_id = ' . intval($product_types_id);
		$conditions[] = 'year = ' . intval($year);

		$sql =	'SELECT id ' . 
				'FROM ' . PREFIX . '_parameters_car_years ' . 
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY year ASC ' .
				'LIMIT 1';
		return $db->getOne($sql);
	}
}

?>