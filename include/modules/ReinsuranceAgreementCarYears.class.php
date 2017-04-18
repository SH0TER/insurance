<?
/*
 * Title: reinsurance agreement car years
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ParametersCarYears.class.php';
require_once 'ReinsuranceAgreementCarYears.class.php';

class ReinsuranceAgreementCarYears extends Form {

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
							'table'				=> 'reinsurance_agreement_car_years'),
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
							'table'				=> 'reinsurance_agreement_car_years'),
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
							'table'				=> 'reinsurance_agreement_car_years'),
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
							'table'				=> 'reinsurance_agreement_car_years'),
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
							'table'				=> 'reinsurance_agreement_car_years'),
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
							'table'				=> 'reinsurance_agreement_car_years'),
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
							'table'				=> 'reinsurance_agreement_car_years')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersReinsuranceCarYears($data) {
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
					'add'		=> true,
					'edit'		=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ 'ReinsuranceAgreements' ];
				break;
		}
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$car_years = $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_parameters_car_years AS a WHERE ' . implode(' AND ', $conditions) . ' ORDER BY order_position');
		$car_types = $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_car_types WHERE product_types_id = ' . intval($product_types_id));

		$sql =	'SELECT a.id, a.title, b.value, car_types_id ' . 
				'FROM ' . PREFIX . '_parameters_car_years AS a ' .
				'LEFT JOIN ' . PREFIX . '_reinsurance_agreement_car_years AS b ON a.id = b.car_years_id AND (b.agreements_id = ' . intval($data['id']) . ' OR ISNULL(car_years_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$list =	$db->getAll($sql);

		$result = '<tr><td>&nbsp;</td><td><br /><b>КIЛЬКIСТЬ РОКIВ:</b></td></tr>';
        $result .= '<tr><td>&nbsp;</td><td><table  cellspacing="0" cellpadding="5" style="border: solid 1px #000000;"><tr class="columns" align=center>';
		$result .= '<td >Тип ТЗ</td>';

		foreach ($car_years as $i => $car_year) {
			$result .='<td>' . $car_year . '</td>';
		}

		foreach ($car_types as $i => $car_type) {
			$result .='<tr class="row0"><td>' . $car_type . '</td>';
			foreach ($car_years as $j => $car_year) {
				$value = 0;
				foreach ($list as $k => $v) {
					if ($v['id'] == $j && $v['car_types_id'] == $i) {
						$value 		= $v['value'];
						break;
					}
				}
				$result .='<td><input type="text" name="car_years[' . $i . '][' . $j . '][value]" value="' . $value  . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>';

			}
			$result .='</tr>';
		}

		$result .= '</table>';
		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['car_years'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_reinsurance_agreement_car_years ' . 
					'WHERE agreements_id = ' . intval($data['agreements_id']);
			$db->query($sql);

			foreach ($data['car_years'] as $car_types_id => $value) {
				foreach ($value as $car_year => $row) {
					if (intval($data['agreements_id'])) {
						$sql =	'INSERT INTO ' . PREFIX . '_reinsurance_agreement_car_years SET ' .
								'agreements_id = ' . intval($data['agreements_id']) . ', ' .
								'car_types_id = ' . intval($car_types_id) . ', ' .
								'car_years_id = ' . intval($car_year) . ', ' .
								'value = ' . $db->quote($row['value']) . ', ' .
								'modified = NOW()';
						$db->query($sql);
					}
				}
			}
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_reinsurance_agreement_car_years ' .
				'WHERE car_years_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getValue($agreements_id, $car_types_id, $year) {
		global $db;

		$car_years_id = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO, $year);

		$sql =	'SELECT value ' .
				'FROM ' . PREFIX . '_reinsurance_agreement_car_years ' .
				'WHERE agreements_id = ' . intval($agreements_id) . ' AND car_types_id = ' . intval($car_types_id) . ' AND car_years_id = ' . intval($car_years_id);
		$value = $db->getOne($sql, 30 * 60);

		return ($value > 0) ? $value : 1;
	}
}

?>