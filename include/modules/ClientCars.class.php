<?
/*
 * Title: client car class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ClientCars extends Form {

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
							'table'				=> 'client_cars'),
						array(
							'name'				=> 'clients_id',
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
							'table'				=> 'client_cars',
							'sourceTable'		=> 'clients',
							'selectField'		=> 'IF(person_types_id = 2, company, CONCAT(lastname, \' \', firstname))',
							'orderField'		=> 'company, lastname'),
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
							'table'				=> 'client_cars',
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
							'table'				=> 'client_cars',
							'sourceTable'		=> 'car_models',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'title',
							'description'		=> 'Автомобіль',
					        'type'				=> fldText,
							'maxlength'			=> 50,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'client_cars'),
  						array(
							'name'				=> 'price',
							'description'		=> 'Вартість, грн',
					        'type'				=> fldMoney,
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
							'table'				=> 'client_cars'),
  						array(
							'name'				=> 'engine_size',
							'description'		=> 'Об\'єм двигуна, см<sup>3</sup>',
					        'type'				=> fldInteger,
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
							'orderPosition'		=> 2,
							'table'				=> 'client_cars'),
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'client_cars'),
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
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 3,
							'table'				=> 'client_cars'),
						array(
							'name'              => 'race',
							'description'       => 'Пробіг, тис. км.',
							'type'              => fldInteger,
							'display'           =>
								array(
									'show'      => false,
									'insert'    => true,
									'view'      => true,
									'update'    => true
								),
							'verification'      =>
								array(
									'canBeEmpty'    => false
								),
							'table'             => 'client_cars'),
						array(
							'name'				=> 'colors_id',
							'description'		=> 'Колір',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'client_cars',
							'sourceTable'		=> 'car_colors',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'passengers',
							'description'		=> 'Кількість місць',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'client_cars'),
                        array(
                            'name'                => 'car_weight',
                            'description'        => 'Вантажопiд\'ємність, кг',
                            'type'                => fldInteger,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'client_cars'),
						array(
							'name'              => 'shassi',
							'description'       => '№ шасі (кузов, рама)',
							'type'              => fldText,
							'maxlength'         => 17,
							'display'           =>
								array(
									'show'      => true,
									'insert'    => true,
									'view'      => true,
									'update'    => true
								),
							'verification'      =>
								array(
									'canBeEmpty'    => false
								),
							'orderPosition'		=> 5,
							'table'             => 'client_cars'),
						array(
							'name'              => 'sign',
							'description'       => 'Державний знак (реєстраційний №)',
							'type'              => fldText,
                            'validationFunction'        => 'isValidSign',
                            'validationFunctionType'    => 'function',
							'maxlength'         => 8,
							'display'           =>
								array(
									'show'      => true,
									'insert'    => true,
									'view'      => true,
									'update'    => true
								),
							'verification'      =>
								array(
									'canBeEmpty'    => true
								),
							'orderPosition'		=> 6,
							'table'             => 'client_cars'),
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
							'table'				=> 'client_cars'),
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
							'table'				=> 'client_cars'),
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
							'table'				=> 'client_cars'),
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
							'table'				=> 'client_cars'),
						array(
							'name'				=> 'registration_number',
							'description'		=> 'Свідоцтво про реєстрацію:  № ',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'client_cars'),
						array(
							'name'				=> 'registration_place',
							'description'		=> 'Свідоцтво видане',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'client_cars'),
						array(
							'name'				=> 'registration_date',
							'description'		=> 'Дата видачі свідоцтва',
							'input'				=> true,
					        'type'				=> fldDate,
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
							'table'				=> 'client_cars'),
						array(
							'name'				=> 'registration_cities_id',
							'description'		=> 'Місце реєстрації',
					        'type'				=> fldHidden,
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
							'table'				=> 'client_cars'),
						array(
							'name'				=> 'registration_cities_title',
							'description'		=> 'Місце реєстрації',
					        'type'				=> fldText,
                            'maxlength'         => 50,
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
							'table'				=> 'client_cars'),
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
							'table'				=> 'client_cars'),
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
							'table'				=> 'client_cars')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 8,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'CONCAT(brand, \' \', model)'
					)
			);

	function ClientCars($data) {
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
			default:
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

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		if (intval($data['clients_id'])) {
            $fields[] = 'id';
			$conditions[] = 'clients_id = ' . intval($data['clients_id']);
		}

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

    function setConstants(&$data) {
		$data['shassi']	= fixShassiSimbols($data['shassi']);
		$data['sign']	= fixSignSimbols($data['sign']);
	}

	function setAdditionalFields($id,$data) {
		global $db;

		$sql =	'UPDATE ' . $this->tables[0] . ' AS a ' .
				'JOIN ' . PREFIX . '_car_brands AS b ON a.brands_id = b.id ' .
				'JOIN ' . PREFIX . '_car_models AS c ON a.models_id = c.id SET ' .
				'a.brand = b.title, ' . 
				'a.model = c.title, ' . 
				'a.title = CONCAT(b.title, \' \', c.title) ' .
				'WHERE a.id = ' . intval($id);
		$db->query($sql);
	}

	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

		$data['id'] = parent::insert($data, false, $showForm);

        if ($data['id']) {
            $this->setAdditionalFields($data['id'],$data);

			if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id']);
				exit;
			} else {
				return $data['id'];
			}
        }
	}

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

        $data['id'] = parent::update($data, false, $showForm);

		if ($data['id']) {
			$this->setAdditionalFields($data['id'],$data);

			if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id']);
				exit;
			} else {
				return $data['id'];
			}
		}
	}

	function getIdByShassi($shassi) {
		global $db;

		$conditions[] = 'shassi = ' . $db->quote($shassi);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_client_cars ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}
	function getClientIdByShassi($shassi) {
		global $db;

		$conditions[] = 'shassi = ' . $db->quote($shassi);

		$sql =	'SELECT clients_id ' .
				'FROM ' . PREFIX . '_client_cars ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}

	function getIdBySign($sign) {
		global $db;

		$conditions[] = 'sign = ' . $db->quote($sign);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_client_cars ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}


	function getClientsIdByShassi($shassi) {
		global $db;

		$conditions[] = 'shassi = ' . $db->quote($shassi);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_client_cars ' .
				'WHERE ' . implode(' AND ', $conditions).' LIMIT 10';
		return $db->getOne($sql);
	}

	function setFormDescription($data) {

		$fields = array_keys($data);

		foreach ($this->formDescription['fields'] as $i => $field) {
			if (!ereg('id|created|modified', $field['name']) && !in_array($field['name'], $fields)) {
				unset($this->formDescription['fields'][ $i ]);
			}
		}
	}

	function fill($data) {
		if (!intval($data['clients_id'])) {//если нет клиента уходим без проверок
			return;
		} elseif ($data['shassi']) {//ищем авто по номеру кузова
			$data['id'] = $this->getIdByShassi($data['shassi']);
		} elseif ($data['sign']) {//ищем авто по гос номеру
			$data['id'] = $this->getIdBySign($data['sign']);
		} else {
			return;
		}

		if (!$data['colors_id']) $data['colors_id'] = 18;//не визначен

		$this->setFormDescription($data);

		return (intval($data['id'])) ? $this->update($data, false, false) : $this->insert($data, false, false);
	}
}
?>