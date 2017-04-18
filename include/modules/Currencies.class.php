<?
/*
 * Title: currency class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ParametersPriceRanges.class.php';

class Currencies extends Form {
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
							'table'				=> 'currencies'),
						array(
							'name'				=> 'code',
							'description'		=> 'Код',
					        'type'				=> fldUnique,
					        'maxlength'			=> 3,
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
							'width'				=> 100,
							'orderPosition'		=> 1,
							'table'				=> 'currencies'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
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
							'orderPosition'		=> 2,
							'table'				=> 'currencies'),
						array(
							'name'				=> 'sign',
							'description'		=> 'Знак',
					        'type'				=> fldUnique,
					        'maxlength'			=> 6,
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
							'width'				=> 100,
							'orderPosition'		=> 3,
							'table'				=> 'currencies'),
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
							'width'				=> 130,
							'orderPosition'		=> 4,
							'table'				=> 'currencies'),
						array(
							'name'				=> 'import',
							'description'		=> 'Імпорт',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'currencies'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
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
							'table'				=> 'currencies'),
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
							'orderPosition'		=> 5,
                            'width'             => 100,
							'table'				=> 'currencies')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 4,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'code'
					)
			);

	function Currencies($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Валюти';
		$this->messages['single'] = 'Валюта';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> false);
				break;
		}
	}

	function deleteProcess($data, $i=0) {
		global $db, $Log;

		$ParametersPriceRanges = new ParametersPriceRanges($data);

		$sql =	'SELECT id ' . 
				'FROM ' . $ParametersPriceRanges->tables[0] . ' ' .
				'WHERE currencies_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersPriceRanges->messages['plural'] . '</b> об\'єктів страхування.');
			return false;
		}

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_currency_rates ' .
				'WHERE currencies_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		parent::deleteProcess($data);
	}

	function get() {
		global $db;

		$sql =	'SELECT a.*, IF(a.id = 1, 1, b.rate) as rate ' .
				'FROM ' . PREFIX . '_currencies as a ' .
				'LEFT JOIN ' . PREFIX . '_currency_rates as b ON a.id=b.currencies_id ' .
				'WHERE b.date = (SELECT date FROM ' . PREFIX . '_currency_rates ORDER BY date DESC LIMIT 1) OR (a.id = 1 AND ISNULL(b.currencies_id)) ' .
				'ORDER BY order_position';
		$list =	$db->getAll($sql, 300);

		if (is_array($list)) {
			foreach ($list as $row) {
				$result[ $row['id'] ] = $row;
			}
		}

		return $result;
	}

	function getRate($id) {
		global $db;

		$sql =	'SELECT rate ' .
				'FROM ' . PREFIX . '_currency_rates ' .
				'WHERE currencies_id=' . intval($id) . ' ' .
				'ORDER BY date DESC ' .
				'LIMIT 1';
		$rate = $db->getOne($sql, 300);

		return ($rate > 0) ? $rate : 1;
	}

	function exchage($price, $id) {
		return $price / Currencies::getRate($id);
	}
}

?>