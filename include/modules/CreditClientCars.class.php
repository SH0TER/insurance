<?
/*
 * Title: credit client car class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class CreditClientCars extends Form {

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
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'credit_clients_id',
							'description'		=> 'Клієнт',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_client_cars',
							'sourceTable'		=> 'credit_clients',
							'selectField'		=> 'CONCAT(lastname, \' \', firstname)',
							'orderField'		=> 'lastname'),
						array(
							'name'				=> 'brands_id',
							'description'		=> 'Марка',
					        'type'				=> fldSelect,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_client_cars',
							'sourceTable'		=> 'car_brands',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'models_id',
							'description'		=> 'Модель',
					        'type'				=> fldSelect,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_client_cars',
							'sourceTable'		=> 'car_models',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
/*
						array(
							'name'				=> 'brand',
							'description'		=> 'Марка',
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
							'orderPosition'		=> 1,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'model',
							'description'		=> 'Модель',
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
							'table'				=> 'credit_client_cars'),
 */
						array(
							'name'				=> 'year',
							'description'		=> 'Рік випуску',
					        'type'				=> fldInteger,
					        'maxlength'			=> 4,
					        'validationRule'	=> '^(19|20)[0-9]{2}$',
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
							'orderPosition'		=> 3,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'transmissions_id',
							'description'		=> 'КПП',
					        'type'				=> fldRadio,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'colors_id',
							'description'		=> 'Колір',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 4,
							'table'				=> 'credit_client_cars',
							'sourceTable'		=> 'car_colors',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'number_places',
							'description'		=> 'Кількість місць в автомобілі',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'shassi',
							'description'		=> '№ шасі (кузов, рама)',
					        'type'				=> fldText,
					        'maxlength'			=> 20,
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
							'orderPosition'		=> 5,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'sign',
							'description'		=> 'Державний знак (реєстраційний №)',
					        'type'				=> fldText,
                            'validationFunction'        => 'isValidSign',
                            'validationFunctionType'    => 'function',
					        'maxlength'			=> 8,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 6,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'race',
							'description'		=> 'Пробіг, тис. км.',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'protection_multlock',
							'description'		=> 'Mul-T-Lock',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'protection_immobilaser',
							'description'		=> 'Immobilaser',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'protection_manual',
							'description'		=> 'Механічна',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'protection_signalling',
							'description'		=> 'Сигналізація',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_client_cars'),
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
							'width'				=> 100,
							'orderPosition'		=> 7,
							'table'				=> 'credit_client_cars'),
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
							'width'				=> 100,
							'orderPosition'		=> 8,
							'table'				=> 'credit_client_cars')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 8,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'CONCAT(brand, \' \', model)'
					)
			);

	function CreditClientCars($data) {
		global $TRANSMISSIONS;

		Form::Form($data);

		$this->formDescription['fields'][ $this->getFieldPositionByName('transmissions_id') ]['list'] = $TRANSMISSIONS;

		$this->messages['plural'] = 'Автомобілі';
		$this->messages['single'] = 'Автомобіль';
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
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

    function setConstants(&$data) {
		$data['shassi']	= fixShassiSimbols($data['shassi']);
		$data['sign']	= fixSignSimbols($data['sign']);
	}

	function setAdditionalFields($id,$data) {
		global $db;

		$sql =	'UPDATE ' . $this->tables[0] . ' SET ' .
				'cars_title = ' . $db->quote($data['brand'] . ' / ' . $data['model']) . ' ' .
				'WHERE id = ' . intval($id);
		$db->query($sql);
	}

	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {

		$data['id'] = parent::insert($data, false, false);

        if ($data['id']) {
            $this->setAdditionalFields($data['id'],$data);
        }

        if ($redirect) {
			header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id']);
			exit;
		} else {
			return $data['id'];
		}
	}

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {

        $data['id'] = parent::update($data, false, false);

		if ($data['id']) {
			$this->setAdditionalFields($data['id'],$data);
		}

		if ($redirect) {
			header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id']);
			exit;
		} else {
			return $data['id'];
		}
	}
}
?>