<?php
/*
 * Title: car service class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class CarServicesPriority extends Form {

    var $car_brands = array(
        5   => "CHERY",
        354	=> "LANDMARK",
        3   => "ВАЗ",
        16  => "ЗАЗ",
        4   => "DAEWOO",
        6   => "CHEVROLET",
        8   => "OPEL",
        13  => "MERCEDES-BENZ",
        15  => "CHRYSLER",
        14  => "JEEP",
        12  => "DODGE",
        7   => "RENAULT",
        9   => "NISSAN",
        11  => "TOYOTA",
        28  => "KIA",
        1  => "Інші"
     );

     var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'					=> 'id',
                            'type'                	=> fldIdentity,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                    	array(
							'name'				=> 'car_services_id',
							'description'		=> 'СТО',
					        'type'				=> fldHidden,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'car_services_priority'),
                        array(
                            'name'                	=> 'brands_id',
                            'description'        	=> 'Марка',
                            'type'                	=> fldSelect,
							'maxlength'				=> 50,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 1,
                            'table'                	=> 'car_services_priority',
                            'sourceTable'           => 'car_brands',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
                        array(
                            'name'                	=> 'priority',
                            'description'        	=> 'Пріоритет для страхувальників',
                            'type'                	=> fldInteger,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 2,
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                  => 'priority2',
                            'description'           => 'Пріоритет для потерпілих',
                            'type'                  => fldInteger,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 3,
                            'table'                 => 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id8',
                            'description'        	=> 'Легкові автомобілі та мінівени (B)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id9',
                            'description'        	=> 'Вантажні автомобілі (C)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id11',
                            'description'        	=> 'Мікроавтобуси та вантажопасажирські автомобілі (V)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id12',
                            'description'        	=> 'Автобуси (D)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id14',
                            'description'        	=> 'Причепи та напівпричепи для вантажних авто (F)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id15',
                            'description'        	=> 'Технологічний транспорт та транспорт для с/г виробництва (T)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id27',
                            'description'        	=> 'Причепи та напівпричепи для легкових авто (E)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'car_types_id28',
                            'description'        	=> 'Мотоцикли, моторолери, мопеди (A)',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'created',
                            'description'        	=> 'Створено',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 4,
                            'table'                	=> 'car_services_priority'),
                        array(
                            'name'                	=> 'modified',
                            'description'        	=> 'Редаговано',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 5,
                            'width'                	=> 100,
                            'table'                	=> 'car_services_priority')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
                        'titleField'			=> 'car_services_id'
                    )
            );
    function CarServicesPriority($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Пріоритети';
        $this->messages['single'] = 'Пріоритет';

    }
    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'    	=> true,
                    'insert'    => true,
                    'update'   	=> true,
                    'view'    	=> true,
                    'change'    => true,
                    'delete'    => true,
                    'export'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }
	
	function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        $this->checkPermissions('update', $data);
		
		$car_services_id = $data['car_services_id'];

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);
		$data['car_services_id'] = $car_services_id;

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $this->setTables('show');
        $this->setShowFields();

        $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
               'FROM ' . PREFIX . '_car_services_priority ' .
               'JOIN ' . PREFIX . '_car_brands ON ' . PREFIX . '_car_services_priority.brands_id = ' . PREFIX . '_car_brands.id ' .
               'WHERE car_services_id = ' .intval($data['car_services_id']) . ' ' .
               'ORDER BY ';

        $total = $db->getOne(transformToGetCount($sql));
        //_dump($total);
        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);
        //_dump($list);

        include_once $this->objectTitle . '/' . $template;
    }

    function getListValue($field, $data) {

        $options = array();

        switch ($field['name']) {
            case 'brands_id':
                foreach ($this->car_brands as $id => $title) {
                    $options[$id] = $title;
                }
            break;
        }

        return $options;

    }

    function checkFields($data, $action) {
        global $Log;

        parent::checkFields($data, $action);
    }

}
?>