<?
/*
 * Title: accident document class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';
require_once 'CarServices.class.php';
require_once 'PolicyDocuments.class.php';
//require_once 'AccidentMessages.class.php';

class AccidentDocuments extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                  => 'id',
                            'type'                  => fldIdentity,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'accidents_id',
                            'description'           => 'Справа',
                            'type'                  => fldInteger,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'         => 1,
                            'table'                 => 'accident_documents'),
						array(
                            'name'                  => 'application_accidents_id',
                            'description'           => 'Заява',
                            'type'                  => fldInteger,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'         => 1,
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'accident_types_title',
                            'description'           => 'Страхувальник/Потерпілий',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
							'orderPosition'         => 2,
                            'orderName'             => 'owner_types_id',
                            'table'                 => 'accident_documents'),
						array(
                            'name'                  => 'number',
                            'description'           => 'Поліс',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 3,
                            'table'                 => 'policies'),
						array(
                            'name'                  => 'insurer',
                            'description'           => 'Страхувальник',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
							'orderName'				=> 'insurer',
							'orderPosition'         => 4,
                            'table'                 => 'policies'),
						 array(
                            'name'                	=> 'shassi',
                            'description'        	=> '№ шасі (кузов, рама)',
                            'type'                	=> fldText,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
							'orderPosition'         => 6,
                            'table'                	=> 'policies_kasko'),
                        array(
                            'name'                  => 'product_document_types_id',
                            'description'           => 'Тип',
                            'type'                  => fldSelect,
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
                            'orderPosition'         => 7,
                            'table'                 => 'accident_documents',
                            'sourceTable'           => 'product_document_types',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
                        array(
                            'name'                  => 'file',
                            'description'           => 'Файл',
                            'type'                  => fldFile,
                            'format'                => '.*\.(jpg|jpeg|gif|png|doc|xls|zip|pdf|txt|docx|xlsx|7z|rar|tif|bmp|rtf)$',
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
                            'orderPosition'         => 8,
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'original',
                            'description'           => 'Оригінал',
                            'type'                  => fldBoolean,
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
                            'orderPosition'         => 9,
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'params',
                            'description'           => 'Параметри',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'comment',
                            'description'           => 'Коментар',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'created',
                            'description'           => 'Створено',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'width'                 => 100,
                            'orderPosition'         => 14,
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'modified',
                            'description'           => 'Редаговано',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 10,
                            'width'                 => 100,
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'title',
                            'description'           => 'СТО',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 11,
                            'table'                 => 'car_services'),
                        array(
                            'name'                  => 'authors_id',
                            'description'           => 'Автор',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'authors_title',
                            'description'           => 'Автор',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 12,
                            'table'                 => 'accident_documents'),
                        array(
                            'name'                  => 'managers_title',
                            'description'           => 'Менеджер',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 13,
                            'table'                 => 'accident_documents'),
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'      => 10,
                        'defaultOrderDirection'     => 'desc',
                        'titleField'                => 'product_document_types_id'
                    )
            );

    function AccidentDocuments($data, $ownersId=null) {

        Form::Form($data);

        $this->messages['plural'] = 'Документи';
        $this->messages['single'] = 'Документ';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false,
					'generatePaymentApplication'	=> true);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                //$this->permissions['insert'] = (intval($data['accidents_id']) && $this->permissions['insert']) ? true : false;
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,//(intval($data['accidents_id']) || intval($data['application_accidents_id'])) ? true : false,
                    'update'    => true,
                    'view'      => true,
                    'change'    => true,
                    'delete'    => true,
                    'generatePaymentApplication' => true,
					'generateLetterDecision'	=>	true);
                break;
        }
    }


    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;
		
		if (!intval($data['accidents_id']) && !intval($data['product_types_id'])) $data['product_types_id'] = PRODUCT_TYPES_KASKO;

        if($data['product_types_id'] != PRODUCT_TYPES_GO){
            $this->formDescription['fields'][ $this->getFieldPositionByName('accident_types_title') ]['display']['show'] = false;
            $_COOKIE[$this->objectTitle]['orderPosition'] = null;
        }
		
        $fields[] = 'do';
        $data['do'] = 'Accidents|show&show=documents';
		$hidden['do'] = $data['do'];
		
		if (intval($data['application_accidents_id'])) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('application_accidents_id') ]['display']['show'] = false;
			$_COOKIE[$this->objectTitle]['orderPosition'] = null;

            if ($data['application_accident_statuses_id'] == 3) {
                $this->permissions['insert'] = false;
            }
		}

		$this->permissions['view'] = false;		

		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$data['car_services_id'] = array($Authorization->data['car_services_id']);
            $conditions[] = PREFIX . '_accident_documents.product_document_types_id NOT IN (' . implode(', ',array(DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT)) . ')';
		}

        $sql = 'SELECT policies_id ' .
            'FROM ' . PREFIX . '_accidents ' .
            'WHERE id = '. intval($data['id']);
        $policies_id = $db->getOne($sql);


        $sql =	'SELECT id, title ' .
            'FROM ' . PREFIX . '_product_document_types ' .
            'ORDER BY title';
        $fields['product_document_types'] = $db->getAll($sql);

        $sql =	'SELECT id, title ' .
            'FROM ' . PREFIX . '_car_services ' .
            'ORDER BY title';
        $fields['car_services'] = $db->getAll($sql);

        $sql = null;

		if (intval($data['accidents_id']) || intval($data['application_accidents_id'])) {
		
			if (intval($data['accidents_id'])) {
				$fields[] = 'accidents_id';
				
				$sql = 'SELECT application_accidents_id ' .
					   'FROM ' . PREFIX . '_accidents ' .
					   'WHERE id = ' . intval($data['accidents_id']);
				$application_accidents_id = $db->getOne($sql);

				if (intval($application_accidents_id)) {
				    $join_cond = 'OR ' . PREFIX . '_accident_documents.application_accidents_id = ' . PREFIX . '_accidents.application_accidents_id ';
					$conditions[] = '(' . PREFIX . '_accident_documents.accidents_id = ' . intval($data['accidents_id']) . ' OR ' . PREFIX . '_accident_documents.application_accidents_id = ' . intval($application_accidents_id) . ')';
				} else {
					$conditions[] = PREFIX . '_accident_documents.accidents_id = ' . intval($data['accidents_id']);
				}

                $sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accidents.product_types_id, ' .
                            PREFIX . '_accidents.number AS accidents_id, ' . PREFIX . '_product_document_types.title AS product_document_types_id,   '.
                            PREFIX . '_accident_documents.file, ' .
                            'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                            'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
                            PREFIX . '_car_services.title, ' .
                            PREFIX . '_accident_documents.authors_title, ' .
                            'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .
                        'FROM ' . PREFIX . '_accident_documents ' .
                        'LEFT JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' .
                        'LEFT JOIN ' . PREFIX . '_application_accidents ON ' . PREFIX . '_accident_documents.application_accidents_id = ' . PREFIX . '_application_accidents.id ' .
                        'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
                        'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
                        'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
                        'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
                        (sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
			}
			
			if (intval($data['application_accidents_id'])) {
				$fields[] = 'application_accidents_id';
				$conditions[] = PREFIX . '_accident_documents.application_accidents_id = ' . intval($data['application_accidents_id']);

                $sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accidents.product_types_id, ' .
                            PREFIX . '_accidents.number AS accidents_id, ' . PREFIX . '_product_document_types.title AS product_document_types_id,   '.
                            PREFIX . '_accident_documents.file, ' .
                            'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                            'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
                            PREFIX . '_car_services.title, ' .
                            PREFIX . '_accident_documents.authors_title, ' .
                            'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .
                        'FROM ' . PREFIX . '_accident_documents ' .
                        'LEFT JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' .
                        'LEFT JOIN ' . PREFIX . '_application_accidents ON ' . PREFIX . '_accident_documents.application_accidents_id = ' . PREFIX . '_application_accidents.id ' .
                        'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
                        'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
                        'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
                        'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
                        (sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
			}

            $this->formDescription['fields'][ $this->getFieldPositionByName('accident_types_title') ]['display']['show'] = false;

			$this->formDescription['fields'][ $this->getFieldPositionByName('number') ]['display']['show'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('accidents_id') ]['display']['show'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('insurer') ]['display']['show'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('item') ]['display']['show'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('sign') ]['display']['show'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('shassi') ]['display']['show'] = false;


		} elseif(in_array(ACCOUNT_GROUPS_AVERAGE, $Authorization->data['account_groups_id'])) {
            //$conditions[] = PREFIX . '_accidents.average_managers_id = ' . intval($Authorization->data['id']);
            $Authorization->data['managers'][] = intval($Authorization->data['id']);
            $conditions[] = 'average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ')';
            $conditions[] = PREFIX . '_accident_documents.managers_id = 0';
			$conditions[] = PREFIX . '_accident_documents.accidents_id > 0';
        } elseif (in_array(ACCOUNT_GROUPS_ESTIMATE, $Authorization->data['account_groups_id'])) {
            $accidents_estimate = AccidentMessages::getAccidentsEstimatesMessagesInWork($Authorization->data['id']);
            if ($accidents_estimate) {
                $conditions[] = PREFIX . '_accident_documents.accidents_id IN(' . implode(', ', $accidents_estimate) . ')';
                $conditions[] = PREFIX . '_accident_documents.product_document_types_id IN(' . DOCUMENT_TYPES_ACCIDENT_PHOTO_CAR . ', ' .
                                                                                               DOCUMENT_TYPES_ACCIDENT_PROTOCOL_REVIEW . ', ' .
                                                                                               DOCUMENT_TYPES_ACCIDENT_INVOICE . ', ' .
                                                                                               DOCUMENT_TYPES_ACCIDENT_COMPLETION_ACT . ')';
                $conditions[] = PREFIX . '_accident_documents.managers_id = 0';
            } elseif(in_array(ACCOUNT_GROUPS_RECEPTIONIST, $Authorization->data['account_groups_id']) || in_array(ACCOUNT_GROUPS_MONITORING, $Authorization->data['account_groups_id'])) {
                $conditions[] = PREFIX . '_accident_documents.managers_id = 0';
            } else {
                $conditions[] = '0';
            }
			$conditions[] = PREFIX . '_accident_documents.accidents_id > 0';
        } else {
            $conditions[] = PREFIX . '_accident_documents.managers_id = 0';
			$conditions[] = PREFIX . '_accident_documents.accidents_id > 0';
		}

        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['number'] . '%');
        }

		if ($data['sign']) {
            $fields[] = 'sign';
            $conditions[] =  'sign LIKE ' . $db->quote($data['sign'] . '%');
        }

        if ($data['shassi']){
            $fields[] = 'shassi';
            $conditions[] = 'shassi LIKE ' . $db->quote($data['shassi'] . '%');
        }

        if ($data['policies_number']) {
            $fields[] = 'policies_number';
            $conditions[] = PREFIX . '_policies.number LIKE ' . $db->quote($data['policies_number'] . '%');
        }

        if ($data['insurer']) {
            $fields[] = 'insurer';
            $conditions[] = '(' . PREFIX . '_policies.insurer LIKE ' . $db->quote('%' . $data['insurer'] . '%') . ')';
        }

		if (is_array($data['product_document_types_id'])) {
			$fields[] = 'product_document_types_id';
			$conditions[] = 'product_document_types_id IN(' . implode(', ', $data['product_document_types_id']) . ')';
		}

		if (is_array($data['car_services_id'])) {
			$fields[] = 'car_services_id';
            if(!isset($data['accidents_id']))
			    $conditions[] = PREFIX . '_masters.car_services_id IN(' . implode(', ', $data['car_services_id']) . ')';
		}

		$fields[] = 'product_types_id';
		
		if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        if (!$sql) {
            switch($data['product_types_id']){
                case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                case PRODUCT_TYPES_KASKO:
                    $sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' .
                            PREFIX . '_policies.number, ' .
                            PREFIX . '_accidents.number AS accidents_id, ' .PREFIX . '_accidents.policies_id as policies_id, ' . PREFIX . '_accidents.product_types_id, ' .
                            'IF(' . PREFIX . '_policies_kasko.insurer_person_types_id = 2, ' . PREFIX . '_policies_kasko.insurer_company, CONCAT(' . PREFIX . '_policies_kasko.insurer_lastname, \' \', ' . PREFIX . '_policies_kasko.insurer_firstname)) AS insurer, ' .
                            PREFIX . '_policies_kasko_items.sign, ' .
                            PREFIX . '_policies_kasko_items.shassi, ' .
                            'CONCAT(' . PREFIX . '_policies_kasko_items.brand, \'/\', ' . PREFIX . '_policies_kasko_items.model) AS item, '.
                            PREFIX . '_product_document_types.title AS product_document_types_id,   '.
                            PREFIX . '_accident_documents.file, ' .
                            'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                            'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
                            PREFIX . '_car_services.title, ' .
                            PREFIX . '_accident_documents.authors_title, ' .
                            'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .

                            'FROM ' . PREFIX . '_accident_documents ' .
                            'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' . $join_cond .
                            'JOIN ' . PREFIX . '_accidents_kasko ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_kasko.accidents_id ' .
                            'JOIN ' . PREFIX . '_policies ON  ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                            'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko.policies_id ' .
                            'JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko_items.policies_id AND ' . PREFIX . '_accidents_kasko.items_id = ' . PREFIX . '_policies_kasko_items.id ' .
                            'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
                            'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
                            'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
                            'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
                            (sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
                    break;
                case PRODUCT_TYPES_GO :
                     $sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' .
                            PREFIX . '_policies.number, ' .
                            PREFIX . '_accidents.number AS accidents_id, ' .PREFIX . '_accidents.policies_id as policies_id, ' . PREFIX . '_accidents.product_types_id, ' .
                            'IF(' . PREFIX . '_policies_go.person_types_id = 2, ' . PREFIX . '_policies_go.insurer_lastname, CONCAT(' . PREFIX . '_policies_go.insurer_lastname, \' \', ' . PREFIX . '_policies_go.insurer_firstname)) AS insurer, ' .
                            PREFIX . '_policies_go.sign, ' .
                            PREFIX . '_policies_go.shassi, ' .
                            'CONCAT(' . PREFIX . '_policies_go.brand, \'/\', ' . PREFIX . '_policies_go.model) AS item, '.
                            PREFIX . '_product_document_types.title AS product_document_types_id,   '.
                            PREFIX . '_accident_documents.file, ' .
                            'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                            'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
                            PREFIX . '_car_services.title, ' .
                            PREFIX . '_accident_documents.authors_title, ' .
                            'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id, ' .
                            'IF(' . PREFIX . '_accidents_go.owner_types_id = 1, \'Страхувальник\', \'Потерпілий\') as accident_types_title ' .

                            'FROM ' . PREFIX . '_accident_documents ' .
                            'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' . $join_cond .
                            'JOIN ' . PREFIX . '_accidents_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_go.accidents_id ' .
                            'JOIN ' . PREFIX . '_policies ON  ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                            'JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_go.policies_id ' .
                            'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
                            'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
                            'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
                            'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
                            (sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
                     break;
				case PRODUCT_TYPES_CARGO_CERTIFICATE:
					$sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' .
								PREFIX . '_policies.number,  ' . PREFIX . '_policies.product_types_id, ' . PREFIX . '_policies.insurer, ' .
								PREFIX . '_accidents.number AS accidents_id, ' .PREFIX . '_accidents.policies_id as policies_id,' .
								PREFIX . '_product_document_types.title AS product_document_types_id,   '.
								PREFIX . '_accident_documents.file, ' .
								'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
								'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
								PREFIX . '_car_services.title, ' .
								PREFIX . '_accident_documents.authors_title, ' .
								'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .
							'FROM ' . PREFIX . '_accident_documents ' .
							'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' .
							'JOIN ' . PREFIX . '_accidents_cargo ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_cargo.accidents_id ' .
							'JOIN ' . PREFIX . '_policies ON  ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
							'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
							'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
							'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
							'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
							(sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
					break;
				case PRODUCT_TYPES_PROPERTY:
					$sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' .
								PREFIX . '_policies.number,  ' . PREFIX . '_policies.product_types_id, ' . PREFIX . '_policies.insurer, ' .
								PREFIX . '_accidents.number AS accidents_id, ' .PREFIX . '_accidents.policies_id as policies_id,' .
								PREFIX . '_product_document_types.title AS product_document_types_id,   '.
								PREFIX . '_accident_documents.file, ' .
								'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
								'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
								PREFIX . '_car_services.title, ' .
								PREFIX . '_accident_documents.authors_title, ' .
								'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .
							'FROM ' . PREFIX . '_accident_documents ' .
							'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' .
							'JOIN ' . PREFIX . '_accidents_property ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_property.accidents_id ' .
							'JOIN ' . PREFIX . '_policies ON  ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
							'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
							'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
							'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
							'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
							(sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
					break;
                default:
                    if (intval($data['application_accidents_id'])) {
                        $sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' .
                                    PREFIX . '_accidents.number AS accidents_id, ' . PREFIX . '_product_document_types.title AS product_document_types_id,   '.
                                    PREFIX . '_accident_documents.file, ' .
                                    'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                                    'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
                                    PREFIX . '_car_services.title, ' .
                                    PREFIX . '_accident_documents.authors_title, ' .
                                    'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .
                                'FROM ' . PREFIX . '_accident_documents ' .
                                'LEFT JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' .
                                'LEFT JOIN ' . PREFIX . '_application_accidents ON ' . PREFIX . '_accident_documents.application_accidents_id = ' . PREFIX . '_application_accidents.id ' .
                                'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
                                'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
                                'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
                                'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
                                (sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
                    } else {
                        $sql =  'SELECT ' . PREFIX . '_accident_documents.id, ' . PREFIX . '_accident_documents.id, ' .
                                    PREFIX . '_policies.number,  ' . PREFIX . '_policies.product_types_id, ' . PREFIX . '_policies.insurer, ' .
                                    PREFIX . '_accidents.number AS accidents_id, ' .PREFIX . '_accidents.policies_id as policies_id,' .
                                    PREFIX . '_product_document_types.title AS product_document_types_id,   '.
                                    PREFIX . '_accident_documents.file, ' .
                                    'date_format(' . PREFIX . '_accident_documents.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                                    'date_format(' . PREFIX . '_accident_documents.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format, ' .
                                    PREFIX . '_car_services.title, ' .
                                    PREFIX . '_accident_documents.authors_title, ' .
                                    'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) AS managers_title, ' . PREFIX . '_masters.car_services_id ' .
                                'FROM ' . PREFIX . '_accident_documents ' .
                                'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_documents.accidents_id = ' . PREFIX . '_accidents.id ' .
                                'JOIN ' . PREFIX . '_policies ON  ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                                'JOIN ' . PREFIX . '_product_document_types ON ' . PREFIX . '_accident_documents.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
                                'LEFT JOIN ' . PREFIX . '_masters ON ' . PREFIX . '_accident_documents.authors_id = ' . PREFIX . '_masters.accounts_id ' .
                                'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_masters.car_services_id = ' . PREFIX . '_car_services.id ' .
                                'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accident_documents.managers_id = ' . PREFIX . '_accounts.id OR ISNULL(' . PREFIX . '_accounts.id) ' .
                                (sizeof($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '');
                    }

                    break;

            }
        }
		$this->setTables('show');
        $this->setShowFields();

        $total = $db->getOne(transformToGetCount($sql));

        $sql .= ' ORDER BY ' . $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);

        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        include $this->object . '/' . $template;

        //_dump($sql);
        //parent::show($data, $fields, $conditions, $sql, $this->object . '/' . $template, $limit);
    }

    function getShowOrderCondition() {
        return str_replace ( PREFIX.'_accident_documents.managers_title' , 'managers_title' , parent::getShowOrderCondition() );
		
    }


    function getListValue($field, $data) {
        global $db, $data;
//_dump($data);exit;
        switch ($field['name']) {
            case 'product_document_types_id':

                $options = (($field['verification']['canBeEmpty']) && $field['type'] == fldSelect) ? array('0' => '...') : array();
				
				if (intval($data['product_types_id']) == 0) $data['product_types_id'] = PRODUCT_TYPES_KASKO;
                if (intval($data['product_types_id']) == PRODUCT_TYPES_DRIVE_CERTIFICATE) $data['product_types_id'] = PRODUCT_TYPES_KASKO;
                
				$conditions[] = '(product_types_id =' . intval($data['product_types_id']).' OR product_types_id=1)';
				
				if ($data['product_types_id'] = PRODUCT_TYPES_GO)
					$conditions[] = 'sections_id = 2';
				
				//$conditions[] = 'id NOT IN(SELECT product_document_types_id FROM ' . PREFIX . '_product_documents WHERE product_types_id = ' . PRODUCT_TYPES_KASKO . ')'; //Для отображения всех типов документво в документах в ожидании

                $sql =  'SELECT ' . PREFIX . '_product_document_types.id, ' . PREFIX . '_product_document_types.title ' .
                        'FROM ' . PREFIX . '_product_document_types ' .
                        'WHERE ' . implode(' AND ', $conditions) . ' ' .
                        'ORDER BY title';
                $list = $db->getAll($sql);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[$row['id']] = array(
                            'title'         => $row['title'],
                            'obligatory'    => $row['obligatory']);
                    }
                }

                return $options;
                break;
            default:
                return parent::getListValue($field, $data);
                break;
        }
    }

    function showForm($data, $action, $actionType=null, $template=null) {
		global $db;

		$template = 'kaskoPolicy.php';
		
		if (intval($data['accidents_id'])) {

			$conditions[] = 'a.accidents_id = ' . intval($data['accidents_id']);

			$sql =  'SELECT d.number AS policies_number, d.date AS policies_date, ' .
					'e.insurer_lastname, e.insurer_passport_series, e.insurer_passport_number, e.insurer_identification_code, e.insurer_driver_licence_series, e.insurer_driver_licence_number, ' .
					'f.shassi, f.sign ' .
					'FROM ' . PREFIX . '_accident_documents AS a ' .
					'LEFT JOIN ' . PREFIX . '_accidents_kasko AS b ON a.accidents_id = b.accidents_id ' .
					'LEFT JOIN ' . PREFIX . '_accidents AS c ON a.accidents_id = c.id ' .
					'LEFT JOIN ' . PREFIX . '_policies AS d ON c.policies_id = d.id ' .
					'LEFT JOIN ' . PREFIX . '_policies_kasko AS e ON d.id = e.policies_id ' .
					'LEFT JOIN ' . PREFIX . '_policies_kasko_items AS f ON d.id = f.policies_id AND b.items_id = f.id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'LIMIT 1';
			$row =  $db->getRow($sql);

			$data = array_merge($data, $row);
		}
		
		if (intval($data['application_accidents_id'])) {
			$template = 'add_application_accidents.php';
		}

        if ($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE) {
            $template = 'cargo.php';
        }

        parent::showForm($data, $action, $actionType, $template);
    }

    function setConstants(&$data) {
        global $Authorization, $db;

        //parent::setConstants($data);
        
        if (is_array($data['accidents_id'])) {
            $data['accidents_id'] = $data['accidents_id'][ $data['policies_number'] ];
        }
		
		if (intval($data['application_accidents_id'])) {		
			$this->formDescription['fields'][ $this->getFieldPositionByName('accidents_id') ]['verification']['canBeEmpty'] = true;
		}
		if (intval($data['accidents_id'])) {		
			$this->formDescription['fields'][ $this->getFieldPositionByName('application_accidents_id') ]['verification']['canBeEmpty'] = true;
		}

        /*if(in_array($data['message_types_id'],$this->messages_types)){
          $data['authors_id']         = $Authorization->data['id'];
          $data['authors_title ']     = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
          $data['messages_id']        = $data['id'];
          $data['product_document_types_id'] = 68;
        }*/

        parent::setConstants($data);

        $params = array();
        if (strlen($data['param1'])) $params['param1'] = $data['param1'];
        if (strlen($data['param2'])) $params['param2'] = $data['param2'];
        if (strlen($data['param3'])) $params['param3'] = $data['param3'];
        $data['params'] = serialize($params);
    }

	function setAdditionalFields($id, $data) {
		global $db, $Authorization;

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && is_array($id) && sizeOf($id)) {
			$sql =	'UPDATE ' . PREFIX . '_accident_documents SET ' .
					'managers_id = ' . intval($Authorization->data['id']) . ' ' .
					//'managers_lastname = ' . $db->quote($Authorization->data['lastname']) . ', ' .
					//'managers_firstname = ' . $db->quote($Authorization->data['firstname']) . ', ' .
					//'managers_patronymicname = ' . $db->quote($Authorization->data['patronymicname']) . ' ' .
					'WHERE id IN (' . implode(', ' , $id) . ')';

			$db->query($sql);
        }

		//приложили документ с дополнительными деффектами
		if ($data['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_DEFECTS && $data['surcharge'] == '1') {
			$Accidents = new Accidents($data);
			$Accidents->changeAccidentStatus($data['accidents_id'][ $data['policies_number'] ], ACCIDENT_STATUSES_DEFECTS);
		}
	}

    function ecmInsertInWindow($data) {
        global $db;

        if($data['pass'] === "pqrsus1!ecm" && $data['login']) {
            $sql = "SELECT id, lastname, firstname, roles_id FROM insurance_accounts WHERE active = 1 AND login = '" . mysql_escape_string($data['login']) . "'";
            $data['userInformation'] = $db->getRow($sql);

            if(intval($data['userInformation']['id']) == 0) {
                echo json_encode(array("error"  =>  "Вашого логіну не знайдено в Insurance. Зверніться до It-відділу."));
                return;
            }
        } else {
            echo json_encode(array("error"  =>  "Помилка доступу. Зверніться до It-відділу."));
            return;
        }

        switch ($data['userInformation']['roles_id']) {
            case ROLES_MASTER:
            case ROLES_MANAGER:
            case ROLES_ADMINISTRATOR:
                $data['authors_id'] = $data['userInformation']['id'];
                break;
        }
        $data['authors_title'] = $data['userInformation']['lastname'] . ' ' . $data['userInformation']['firstname'];

        $sql = "SELECT a.id as id, b.product_types_id as product_types_id, b.number as policy_number FROM insurance_accidents a " .
                "JOIN insurance_policies b on a.policies_id=b.id " .
                "WHERE a.number='" . mysql_escape_string($data['accident_number']) . "'";

        $result = $db->getRow($sql);

        if(intval($result['id']) == 0) {
            echo json_encode(array("error"  =>  "Випадок не знайдено в Insurance. Зверніться до It-відділу."));
            return;
        }


        $data['accidents_id'][$result['policy_number']] = $result['id'];
        $data['policies_number'] = $result['policy_number'];
        $data['product_types_id'] = $result['product_types_id'];

        $data['id'] = parent::insert($data, false);

        if ($data['id']) {
        
            if (intval($data['application_accidents_id']) && $data['product_document_types_id'] == 149 && ApplicationAccidents::getStatusesId($data['application_accidents_id']) == 1) {
                ApplicationAccidents::setStatusesId($data['application_accidents_id'], 2);
            }
            
            //якщо документ один з: "Фото пошкодженого ТЗ", "Протокол огляду", "Рахунок-фактура", "Акт виконаних робіт" і поставлена задача "Розрахунок вартості відновлювального ремонту" - лист експерту, закріпленому за справою
            if (in_array($data['product_document_types_id'], array(DOCUMENT_TYPES_ACCIDENT_PHOTO_CAR, DOCUMENT_TYPES_ACCIDENT_PROTOCOL_REVIEW, DOCUMENT_TYPES_ACCIDENT_INVOICE, DOCUMENT_TYPES_ACCIDENT_COMPLETION_ACT))
                && in_array($data['accidents_id'][$data['policies_number']], AccidentMessages::getAccidentsEstimatesMessagesInWork(Accidents::getEstimateManagersId($data['accidents_id'][$data['policies_number']])))) {
                
                $this->send($data['id'], 'DocumentsInsert. Estimate');
            }

            $this->setAdditionalFields(array($data['id']), $data);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['documents_id'] = $data['id'];
            $params['storage']  = $this->tables[0];
        }

        echo json_encode(array("success"    =>  $data['id']));
    }
    
    function insert($data, $redirect=true) {
        global $Log, $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_MASTER:
            case ROLES_MANAGER:
            case ROLES_ADMINISTRATOR:
				$data['authors_id'] = $Authorization->data['id'];
				break;
		}
		$data['authors_title'] = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
        $data['id'] = parent::insert($data, false);

        if ($data['id']) {
		
			if (intval($data['application_accidents_id']) && $data['product_document_types_id'] == 149 && ApplicationAccidents::getStatusesId($data['application_accidents_id']) == 1) {
				ApplicationAccidents::setStatusesId($data['application_accidents_id'], 2);
			}
			
            //якщо документ один з: "Фото пошкодженого ТЗ", "Протокол огляду", "Рахунок-фактура", "Акт виконаних робіт" і поставлена задача "Розрахунок вартості відновлювального ремонту" - лист експерту, закріпленому за справою
            if (in_array($data['product_document_types_id'], array(DOCUMENT_TYPES_ACCIDENT_PHOTO_CAR, DOCUMENT_TYPES_ACCIDENT_PROTOCOL_REVIEW, DOCUMENT_TYPES_ACCIDENT_INVOICE, DOCUMENT_TYPES_ACCIDENT_COMPLETION_ACT))
                && in_array($data['accidents_id'][$data['policies_number']], AccidentMessages::getAccidentsEstimatesMessagesInWork(Accidents::getEstimateManagersId($data['accidents_id'][$data['policies_number']])))) {
				
                $this->send($data['id'], 'DocumentsInsert. Estimate');
            }

			$this->setAdditionalFields(array($data['id']), $data);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['documents_id'] = $data['id'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {

                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        switch ($action) {
            case 'update':
				$sql =  'SELECT d.number AS policies_number, d.date AS policies_date, d.product_types_id, ' .
						'e.insurer_lastname, e.insurer_passport_series, e.insurer_passport_number, e.insurer_identification_code, e.insurer_driver_licence_series, e.insurer_driver_licence_number, ' .
						'f.shassi, f.sign ' .
						'FROM ' . PREFIX . '_accident_documents AS a ' .
						'LEFT JOIN ' . PREFIX . '_accidents_kasko AS b ON a.accidents_id = b.accidents_id ' .
						'LEFT JOIN ' . PREFIX . '_accidents AS c ON a.accidents_id = c.id ' .
						'LEFT JOIN ' . PREFIX . '_policies AS d ON c.policies_id = d.id ' .
						'LEFT JOIN ' . PREFIX . '_policies_kasko AS e ON d.id = e.policies_id ' .
						'LEFT JOIN ' . PREFIX . '_policies_kasko_items AS f ON d.id = f.policies_id AND b.items_id = f.id ' .
						'WHERE a.id = ' . intval($data['id']);
                $row =  $db->getRow($sql);

                $data = array_merge($data, $row);
                break;
        }

        return $data;
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template='kaskoPolicy.php') {
        //return parent::load($data, $showForm, $action, $actionType, $template);
        global $db;

        $this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $is_accidents = $data['is_accidents'];

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);
        $data['is_accidents'] = $is_accidents;
        $data['redirect'] = '/index.php?do=Accidents|show&product_types_id=' . $data['product_types_id'];

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function getOwner($id) {
        global $db;

        $sql =  'SELECT car_services_id, masters_id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE id = ' . intval($id);
        return $db->getRow($sql);
    }

    function update($data, $redirect=true) {
        global $Log, $Authorization;

        if (parent::update($data, false)) {

			$this->setAdditionalFields(array($data['id']), $data);
            $params['title']    = $this->messages['single'];
            $params['id']       = $data['documents_id'] = $data['id'];
            $params['storage']  = $this->tables[0];

            $this->generateTemplates($data['accidents_id'][$data['policies_number']], $data['id'], true);
			
			if (intval($data['application_accidents_id']) && $data['product_document_types_id'] == 149 && ApplicationAccidents::getStatusesId($data['application_accidents_id']) == 1) {
				ApplicationAccidents::setStatusesId($data['application_accidents_id'], 2);
			}

            if ($redirect) {

                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                /*if (is_numeric($data['accidents_id'])) {
                    header('Location: /?do=Accidents|view&accidents_id=' . $data['accidents_id'] . '&product_types_id='.$data['product_types_id']);
                } elseif (is_numeric($data['accidents_id'][$data['policies_number']])) {
                    header('Location: /?do=Accidents|view&accidents_id=' . $data['accidents_id'][$data['policies_number']] . '&product_types_id='.$data['product_types_id']);
                } else {
                    header('Location: /?do=Accidents|show&product_types_id='.$data['product_types_id']);
                }*/
                header('Location: ' . $data['redirect']);
                exit;
            } else {

                return $params['id'];
            }
        }
    }

	function delete($data, $redirect=true, $generateMessage=true, $folder=null) {
		global $db, $Log;

		$this->checkPermissions('delete', $data);

		$unsetFields = array('number', 'insurer', 'item', 'sign', 'shassi', 'title');

		foreach ($unsetFields as $field) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]);
		}

//		if (ereg('^' . $this->object . '|delete$', $data['do']) && sizeOf($data['id'])) {
		if (sizeOf($data['id'])) {

			$conditions[] = 'file = 1';
			$conditions[] = 'managers_id <> 0';
			$conditions[] = 'id IN(' . implode(', ', $data['id']) . ')';

			$sql =	'SELECT id ' .
					'FROM ' . $this->tables[0] . ' ' .
					'WHERE ' . implode(' AND ', $conditions);
			$id = $db->getCol($sql);

			if (sizeOf($id) && false) {
				$Log->add('error', 'В переліку документів на вилучення вибрали документи вилучення яких заборонено.', array(), '', true);

				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			} else {

				$redirectToList = false;

				if (!is_array($data['id'])) {
					$redirectToList = true;
					$data['id'] = array($data['id']);
				}

				if (is_array($data['id']) && sizeOf($data['id']) > 0) {

					$fileFields = $this->getListOfFileFields();

					if (sizeOf($fileFields) > 0) {
						foreach ($data['id'] as $id) {
							$files = $db->getRow('SELECT file, template FROM '. $this->tables[0] . ' WHERE id = '.intval($id));

							if ($files['file'] != '1') {
								@unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . '/' . $files['file']);
							}

							if ($files['template'] != '') {
								@unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . 'Templates/' . $files['template']);
							}
						}
					}

					$this->setTables('delete');

					if ($this->deleteProcess($data, 0, $folder)) {

						if ($this->renumerate) {
							$this->renumerate($data);
						}

						if ($generateMessage) {
							$params['title']	= $this->messages['plural'];
							$params['storage']	= $this->tables[0];
							$Log->add('confirm', $this->messages['delete']['confirm'], $params, '', true);
						}
					}
				}

				if ($redirect) {
					($redirectToList)
						? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show')
						: header('Location: ' . $_SERVER['HTTP_REFERER']);
					exit;
				}
			}
		}
	}

	function getId($accidents_id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id) {
		global $db;

		$conditions[] = 'accidents_id = ' . intval($accidents_id);
		$conditions[] = 'messages_id = ' . intval($messages_id);
		$conditions[] = 'payments_calendar_id = ' . intval($payments_calendar_id);
		$conditions[] = 'acts_id = ' . intval($acts_id);
		$conditions[] = 'product_document_types_id = ' . intval($product_document_types_id);
		$conditions[] = 'file = 1';

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_accident_documents ' .
				'WHERE ' . implode(' AND ', $conditions);
		return	$db->getOne($sql, 30 * 60);
	}

	//необходимо только для документов, которые генерятся
    function setNumber($id, $accidents_id, $product_document_types_id) {
        global $db;

        $conditions[] = 'product_document_types_id = ' . intval($product_document_types_id);
        $conditions[] = 'accidents_id = ' . intval($accidents_id);
        $conditions[] = 'id < ' . intval($id);

        $sql =  'SELECT count(*) + 1 ' .
                'FROM ' . PREFIX . '_accident_documents ' .
                'WHERE ' . implode(' AND ', $conditions);
        $number = $db->getOne($sql);

        $sql =  'UPDATE ' . PREFIX . '_accident_documents AS a, ' .
        		PREFIX . '_accidents AS b SET ' .
                'a.number = CONCAT(\'ВИХ-\', b.number, \'-\', ' . $product_document_types_id . ', \'-\', ' . $number .  ') ' .
                'WHERE a.accidents_id = b.id AND a.id = ' . intval($id);
        $db->query($sql);
    }

	//создание шаблонов документов, фиксация документов
    function generateTemplates($accidents_id, $id=null, $regenerate=false) {
        global $db, $Smarty;

        $conditions[] = 'a.accidents_id = ' . intval($accidents_id);
        $conditions[] = 'a.file = \'1\'';

        if (intval($id)) {
            $conditions[] = 'a.id = ' . $id;
        }

        if ($regenerate == false) {
            $conditions[] = '(a.template  = \'\' OR a.template IS NULL)';
        }

        $sql =  'SELECT a.id, a.template, a.accidents_id, b.product_types_id ' .
                'FROM ' . PREFIX . '_accident_documents AS a ' .
                'JOIN ' . PREFIX . '_accidents as b ON a.accidents_id = b.id ' .
				'JOIN ' . PREFIX . '_product_document_types AS c ON a.product_document_types_id = c.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        $data = array();

        foreach($list as $row) {

			//удаляем старый шаблон
            if ($row['template']) {
                @unlink($_SERVER['DOCUMENT_ROOT'] .'/files/AccidentDocumentsTemplates/' . $row['template']);
            }

            $file['id'] = $row['id'];

            if($row['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE)
                $row['product_types_id'] = PRODUCT_TYPES_KASKO;

            $Accidents = Accidents::factory($data, ProductTypes::get($row['product_types_id']));
            $values = $Accidents->getValues($file);

            if($values['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE)
                $values['product_types_id'] = PRODUCT_TYPES_KASKO;

            //обнуляем ограничения
            $conditions = array();

            //проверка на установку messages_id (создание документа при назначении задачи)
            if (intval($values['messages_id'])){
                $sql =	'SELECT * ' .
						'FROM ' . PREFIX . '_accident_messages ' .
						'WHERE id =' .intval($values['messages_id']);
                $row = $db->getRow($sql);

                $values['question'] = unserialize($row['question']);

				if (intval($values['question']['calculation_car_services_id'])) {
					$values['question']['calculation_car_services_title'] = CarServices::getTitle($values['question']['calculation_car_services_id']);
				}

                if ($values['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_REQUEST_VICTIM) {
                    $values['question']['document_types'][] = 0;
                    $values['documents'] = $db->getCol('SELECT title FROM ' . PREFIX . '_product_document_types WHERE id <> 90 AND id IN (' . implode(', ', $values['question']['document_types']) . ')');

                    if (in_array(90, $values['question']['document_types'])) {
                        $add_docs = explode(';', $values['question']['comment_question']);
                        foreach($add_docs as $add_doc) if (strlen($add_doc) > 0) $values['documents'][] = $add_doc;
                    }
                }
				
				if (intval($values['question']['courts_id'])) {
					$values['question']['courts_title'] = Courts::getTitle($values['question']['courts_id']);
					$values['question']['courts_address'] = Courts::getAddress($values['question']['courts_id']);
				}
				
				if (intval($row['recipients_id'])) {
					$sql = 'SELECT lastname, firstname, patronymicname ' . 
						   'FROM ' . PREFIX . '_accounts ' . 
						   'WHERE id = ' . intval($row['recipients_id']);
					$values['recipient'] = $db->getRow($sql);
				}

                $values['question']['created'] = $row['created'];

                $conditions[] = 'messages_id = ' . intval($row['id']);
            }//если нет задачи
            else {
                $conditions[] = 'id = ' . intval($row['id']);
            }

            $template = ProductDocuments::get($values['product_types_id'], $values['product_document_types_id'], $values['date']);

            $Smarty->assign('values', $values);

            $content= $Smarty->fetch($_SERVER['DOCUMENT_ROOT'] .'/files/ProductDocuments/' . $template);

			$filename = Form::generateFilename('document.html');
            
            $handle = fopen($_SERVER['DOCUMENT_ROOT'] .'/files/AccidentDocumentsTemplates/' . $filename, 'wb+');



            if (fwrite($handle, $content) !== FALSE ) {
                $sql =  'UPDATE ' . PREFIX . '_accident_documents SET ' .
                        'template = ' . $db->quote($filename) . ' ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $db->query($sql);
            }
            
            fclose($handle);
        }
    }

    function change($data, $redirect = true) {
        global $db, $Log;

        $this->checkPermissions('change', $data);

        if (is_array($data['id'])) {

            foreach ($data['id'] as $id) {
                $this->generateTemplates($data['accidents_id'], $id, true);
            }

            $params['title'] = $this->messages['plural'];
            $params['storage'] = $this->tables[0];

            $Log->add('confirm', $this->messages['change']['confirm'], $params, '', true);
        }

        if (intval($data['accidents_id'])) {
			if (!$data['redirect']) {
				$data['redirect'] = '/index.php?do=Accidents|load&accidents_id=' . intval($data['accidents_id']) . '&product_types_id=' . intval($data['product_types_id']);
			}
        } else {
            $data['redirect'] = '/index.php?do=Accidents|show&product_types_id=' . intval($data['product_types_id']);
        }

        if ($redirect) {
            ($data['redirect'])
                ? header('Location: ' . $data['redirect'])
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return $data['id'];
    }

    function generate($accidents_id, $application_accidents_id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id, $data, $template=true) {
        global $db, $Authorization;

        $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
				'authors_id = ' . intval($Authorization->data['id']) . ', ' .
				'authors_title = ' . $db->quote($Authorization->data['lastname'] . ' ' . $Authorization->data['firstname']) . ', ' .
				'modified = NOW() ' .
                'WHERE application_accidents_id = ' . intval($application_accidents_id) . ' AND accidents_id ' . (intval($application_accidents_id) ? 'IS NULL' : '= ' . intval($accidents_id)) . ' AND messages_id=' . intval($messages_id) . ' AND payments_calendar_id = ' . intval($payments_calendar_id) . ' AND acts_id = ' . intval($acts_id) . ' AND product_document_types_id = ' . intval($product_document_types_id) . ' AND file = 1';
        $db->query($sql);
		//_dump($sql);exit;

        if (!$db->affectedRows()) {
                $sql =  'INSERT INTO ' . $this->tables[0] . ' SET ' .
                        'authors_id = ' . intval($Authorization->data['id']) . ', ' .
                        'authors_title = ' . $db->quote( $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'] ) . ', ' .
                        'managers_id = ' . $Authorization->data['id'] . ', ' .
						'application_accidents_id = ' . intval( $application_accidents_id ) . ', ' .
                        'accidents_id = ' . (intval( $accidents_id ) ? intval( $accidents_id ) : 'NULL') . ', ' .
                        'messages_id = ' . intval( $messages_id ) . ', ' .
                        'payments_calendar_id = ' . intval( $payments_calendar_id) . ', ' .
                        'acts_id = ' . intval($acts_id) . ', ' .
                        'product_document_types_id = ' . intval($product_document_types_id) . ', ' .
                        'number = \'\', ' .
                        'file = 1, ' .
                        'original = 0, ' .
                        'comment = \'\', ' .
                        'created = NOW(), ' .
                        'modified = NOW()';
                $db->query($sql);

                $data['id'] =  mysql_insert_id();

        }

		$data['id'] = $this->getId($accidents_id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id);

		//устанавливаем номер, необходимо для документов какие генеряться
		$this->setNumber($data['id'], $accidents_id, $product_document_types_id);
	
		if ($template) $this->generateTemplates($accidents_id, $data['id'], true);
    }

    function remove($accidents_id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id, $data) {
        global $db;

        $conditions[] = 'accidents_id = ' . intval($accidents_id);

		if (intval($messages_id)) {
			$conditions[] = 'messages_id = ' . intval($messages_id);
		}

		if (intval($payments_calendar_id)) {
			$conditions[] = 'payments_calendar_id = ' . intval($payments_calendar_id);
		}

		if (intval($acts_id)) {
			$conditions[] = 'acts_id = ' . intval($acts_id);
		}

        if (intval($product_document_types_id)) {
            $conditions[] = 'product_document_types_id = ' . intval($product_document_types_id);
        }

        $sql =	'SELECT id ' .
				'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $data['id'] = $db->getCol($sql);

		$this->permissions['delete'] = true;

		$this->delete($data, false, false);
    }

    function getListId($accident_id){
         global $db;

       $sql = 'SELECT  id FROM ' . PREFIX . '_accident_documents WHERE ' .
              'accidents_id = ' . intval($accident_id);

       return $db->getCol($sql);
    }

    function downloadFileInWindow($data) {
        global $db, $Smarty, $Authorization;

        $file = unserialize($data['file']);
   
        $this->checkPermissions('view', $file);

         $sql = 'SELECT c.product_types_id AS product_types_id, ' .
                'a.template, a.file, a.messages_id, a.created, a.product_document_types_id, ' .
                'b.number, ' .
                'c.id as policies_id, c.id '.
                'FROM ' . $this->tables[0] . ' AS a ' .
                'LEFT JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id OR ISNULL(a.accidents_id) ' .
				'JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
                'WHERE a.id = ' . intval($file['id']);
        $row = $db->getRow($sql);

		if (intval($data['application_accidents_id']) && $row['file'] == 1 || $data['download'] == 1) {

			if (intval($data['document_product_types_id'])) {
				$product_document_types_id = $data['document_product_types_id'];
			} else {
				$product_document_types_id = $db->getOne('SELECT product_document_types_id FROM ' . PREFIX . '_accident_documents WHERE id = ' . intval($file['id']));
			}
			$template = ProductDocuments::get(1, $product_document_types_id, null);
			$ApplicationAccidents = new ApplicationAccidents($data);
			$values = $ApplicationAccidents->getValues($data);
			$Smarty->assign('values', $values);
			$file['content'] = $Smarty->fetch('../files/ProductDocuments/' . $template);
			$file['name'] = $values['application_accidents_number'] . '_' . $product_document_types_id;
			html2pdf($file);

            $ApplicationAccidents = new ApplicationAccidents($data);
            $ApplicationAccidents->view($data);

		}
		
		if (intval($row['product_document_types_id']) == DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK && intval($data['file_type']) == 2) {		
			$Accidents = Accidents::factory($data, ProductTypes::get($row['product_types_id']));
			$values = $Accidents->getValues($file);
			$Smarty->assign('values', $values);
			$file['content']	= $Smarty->fetch('../files/ProductDocuments/bank_query_sign.tpl');
			$file['name']		= $values['accidents_number'] . '_' . $values['product_document_types_id'] . '_sign';
			html2pdf($file);
		}

        if ($row['file'] != '1' && is_file($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . '/' . $row['file'])) {
            $result = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . '/' . $row['file']);

            header('Content-Disposition: attachment; filename="' . $row['file'] . '"');
            header('Content-Type: ' . $this->getContentType($row['file']));
            header('Content-Length: ' . strlen($result));
            echo $result;
            exit;
        } elseif (!$row['template']) {
			$Accidents = Accidents::factory($data, ProductTypes::get($row['product_types_id']));
			$values = $Accidents->getValues($file);

			//проверка на установку messages_id (создание документа при назначении задачи)
			if (intval($values['messages_id'])){

				$sql =	'SELECT * ' .
						'FROM ' . PREFIX . '_accident_messages ' .
						'WHERE id =' .intval($values['messages_id']);
				$row = $db->getRow($sql);

				$values['question'] = unserialize($row['question']);

				if (intval($values['question']['calculation_car_services_id'])) {
					$values['question']['calculation_car_services_title'] = CarServices::getTitle($values['question']['calculation_car_services_id']);
				}

                if ($values['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_REQUEST_VICTIM) {
                    $values['question']['document_types'][] = 0;
                    $values['documents'] = $db->getCol('SELECT title FROM ' . PREFIX . '_product_document_types WHERE id <> 90 AND id IN (' . implode(', ', $values['question']['document_types']) . ')');

                    if (in_array(90, $values['question']['document_types'])) {
                        $add_docs = explode(';', $values['question']['comment_question']);
                        foreach($add_docs as $add_doc) if (strlen($add_doc) > 0) $values['documents'][] = $add_doc;
                    }
                }
				
				if ($values['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_REQUEST_LETTER_INSURER_KASKO) {
                    $values['question']['document_types'][] = 0;
                    $values['documents'] = $db->getCol('SELECT title FROM ' . PREFIX . '_product_document_types WHERE id <> 90 AND id IN (' . implode(', ', $values['question']['document_types']) . ')');

                    if (in_array(90, $values['question']['document_types'])) {
                        $add_docs = explode(';', $values['question']['comment_question']);
                        foreach($add_docs as $add_doc) if (strlen($add_doc) > 0) $values['documents'][] = $add_doc;
                    }
                }

				$values['question']['created'] = $row['created'];
			}

			$template = ProductDocuments::get($values['product_types_id'], $values['product_document_types_id'], $values['date']);

			$Smarty->assign('values', $values);

			$file['content']	= $Smarty->fetch('../files/ProductDocuments/' . $template);
			$file['name']		= $values['accidents_number'] . '_' . $values['product_document_types_id'];
            echo $template.'\n';
		} else {
			$file['name']       = $row['number'] . '_' . $row['product_document_types_id'];
			$file['content']    = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/files/AccidentDocumentsTemplates/' . $row['template']);
		}

        if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR && $data['download']==1) {
            header('Content-Disposition: attachment; filename="' . $file['name'] . '.html"');
            header('Content-Type: ' . Form::getContentType($file['name'] . '.html'));
            header('Accept-Ranges: bytes');
            header('Expires: 0');
            header('Cache-Control: private');
            echo $file['content'];exit;
        }

		html2pdf($file);
    }

    function send($id, $template = null) {
        global $db, $Templates;

        $sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, accidents.product_types_id, document_types.title as subject ' .
               'FROM ' . PREFIX . '_accidents as accidents ' .
               'JOIN ' . PREFIX . '_accident_documents as documents ON accidents.id = documents.accidents_id ' .
               'JOIN ' . PREFIX . '_product_document_types as document_types ON documents.product_document_types_id = document_types.id ' .
               'WHERE documents.id = ' . intval($id);
        $row = $db->getRow($sql);

        if ($template) {
            switch ($template) {
                case 'DocumentsInsert. Estimate':
                    $sql = 'SELECT accounts.email ' .
                           'FROM ' . PREFIX . '_accounts as accounts '.
                           'JOIN ' . PREFIX . '_accidents as accidents ON accounts.id = accidents.estimate_managers_id ' .
                           'WHERE accounts.active = 1 AND accidents.id = ' . intval($row['accidents_id']);
                    $recipients = $db->getAll($sql);
                    //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
                    break;
            }

            if (is_array($recipients) && sizeOf($recipients)) {
                foreach($recipients as $recipient) {
                    $Templates->send($recipient['email'], $row, $template, $row['subject']);
                }
            }
        }
    }

    function generateDocInWindow($data) {
        global $db, $Smarty;

        if (intval($data['application_accidents_id'])) {
            $sql = 'SELECT application_accidents.number as number, application_accidents.owner_types_id, application_accidents.datetime, application_accidents.car_services_id, CONCAT_WS(\'/\', policies_kasko_items.brand, policies_kasko_items.model) as item_kasko, ' .
                        'CONCAT_WS(\'/\', policies_go.brand, policies_go.model) as item_go, policies_kasko_items.sign as sign_kasko, policies_go.sign as sign_go, ' .
                        'kasko.number as policies_kasko_number, go.number as policies_go_number, kasko.date as policies_kasko_date, go.date as policies_go_date, ' .
                        'application_accidents.application_risks_id, policies_kasko_items.deductibles_value0, policies_kasko_items.deductibles_value1, ' .
                        'IF(policies_kasko_item_year_payments.id > 0, policies_kasko_item_year_payments.item_price, policies_kasko_items.car_price) as insurance_price, 510 as deductible_amount_go ' .
                   'FROM ' . PREFIX . '_application_accidents as application_accidents ' .
                   'LEFT JOIN ' . PREFIX . '_policies as kasko ON application_accidents.policies_kasko_id = kasko.id ' .
                   'LEFT JOIN ' . PREFIX . '_policies as go ON application_accidents.policies_go_id = go.id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_items as policies_kasko_items ON application_accidents.policies_kasko_items_id = policies_kasko_items.id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as policies_kasko_item_year_payments ON application_accidents.policies_kasko_items_id = policies_kasko_item_year_payments.items_id AND application_accidents.datetime BETWEEN policies_kasko_item_year_payments.date AND ADDDATE(policies_kasko_item_year_payments.date, INTERVAL 1 YEAR) ' .
                   'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON application_accidents.policies_go_id = policies_go.policies_id ' .
                   'WHERE application_accidents.id = ' . intval($data['application_accidents_id']);
        } elseif (intval($data['accidents_id'])) {
            $sql = 'SELECT accidents.number as number, accidents.product_types_id, accidents.datetime, accidents.car_services_id, CONCAT_WS(\'/\', policies_kasko_items.brand, policies_kasko_items.model) as item_kasko, ' .
                        'CONCAT_WS(\'/\', policies_go.brand, policies_go.model) as item_go, policies_kasko_items.sign as sign_kasko, policies_go.sign as sign_go, ' .
                        'kasko.number as policies_kasko_number, go.number as policies_go_number, kasko.date as policies_kasko_date, go.date as policies_go_date, ' .
                        'accidents.application_risks_id, policies_kasko_items.deductibles_value0, policies_kasko_items.deductibles_value1, ' .
                        'IF(policies_kasko_item_year_payments.id > 0, policies_kasko_item_year_payments.item_price, policies_kasko_items.car_price) as insurance_price, 510 as deductible_amount_go ' .
                   'FROM ' . PREFIX . '_accidents as accidents ' .
                   'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                   'LEFT JOIN ' . PREFIX . '_policies as kasko ON accidents.policies_id = kasko.id ' .
                   'LEFT JOIN ' . PREFIX . '_policies as go ON accidents.policies_id = go.id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_items as policies_kasko_items ON accidents_kasko.items_id = policies_kasko_items.id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as policies_kasko_item_year_payments ON accidents_kasko.items_id = policies_kasko_item_year_payments.items_id AND accidents.datetime BETWEEN policies_kasko_item_year_payments.date AND ADDDATE(policies_kasko_item_year_payments.date, INTERVAL 1 YEAR) ' .
                   'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
                   'WHERE accidents.id = ' . intval($data['accidents_id']);
        } else {
            $sql = '';
        }

        $values = $db->getRow($sql);

        if ($values['item_kasko']) $values['item'] = $values['item_kasko'];
        else $values['item'] = $values['item_go'];

        if ($values['sign_kasko']) $values['sign'] = $values['sign_kasko'];
        else $values['sign'] = $values['sign_go'];

        if ($values['policies_kasko_number']) $values['policies_number'] = $values['policies_kasko_number'];
        else $values['policies_number'] = $values['policies_go_number'];

        if ($values['policies_kasko_date']) $values['policies_date'] = $values['policies_kasko_date'];
        else $values['policies_date'] = $values['policies_go_date'];

        if ($values['owner_types_id'] == 1 || $values['product_types_id'] == PRODUCT_TYPES_KASKO) {
            if ($values['application_risks_id'] == RISKS_HIJACKING1) {
                $values['deductible'] = roundNumber($values['insurance_price'] * $values['deductibles_value1'] / 100, 2);
            } else {
                $values['deductible'] = roundNumber($values['insurance_price'] * $values['deductibles_value0'] / 100, 2);
            }
        } else {
            $values['deductible'] = $values['deductible_amount_go'];
        }

        if ($values['car_services_id'] == 37) {
            $values['car_services_title'] = CarServices::getTitle(171);
            $values['car_services_edrpou'] = CarServices::getEDRPOU(171);
        } else {
            $values['car_services_title'] = CarServices::getTitle($values['car_services_id']);
            $values['car_services_edrpou'] = CarServices::getEDRPOU($values['car_services_id']);
        }
//_dump($values);
        $Smarty->assign('values', $values);
        $Smarty->assign('data', $data);

        $file['name']       = $values['number'] . '_payment_application_' . $data['payment_type'];
        $file['content']    = $Smarty->fetch('../files/ProductDocuments/payment_application.tpl');
//echo $file['content'];exit;
        html2pdf($file);
    }
	
	function generateLetterDecisionInWindow($data) {
		global $db, $Smarty;
		
		$accident_sections_titles = array('Не визначено', 'A', 'B', 'C', 'D');
        $zones_id_titles = array('...', 'Україна', 'Україна+Європа', 'Україна+СНД', 'Україна+СНД+Європа');
        $insurer_status_titles = array('-', 'VIP', 'VIP УкрАвто');
        $insurance_price_type = array('агрегатна', 'неагрегатна');
        $assistance = array('не повідомлено', 'не з місця події', 'з місця події');
        $written_sign = array('не своєчасно', 'своєчасно');
        $mvs_sign = array('не повідомлено', 'повідомлено');
        $insurance = array('...', 'страховий з виплатою', 'страховий без виплати', 'не страховий');

        $sql = 'SELECT accidents.number as accidents_number, accidents.accident_sections_id, policies.number as policies_number, policies.date as policies_date, ' .
                    'getPolicyDate(policies.number, 2) as policies_begin_date, getPolicyDate(policies.number, 3) as policies_end_date, ' .
                    'CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname) as insurer, ' .
                    'policies_kasko.assured_title, CONCAT_WS(\' \', items.brand, items.model) as item, items.sign, items.shassi, policies_kasko.zones_id, ' .

                    'items.products_title, IF(clients.important_person = 1, IF(clients.client_groups_id = 1, 2, 1), 0) as insurer_status_id, ' .
                    'IF(years_payments.id > 0, years_payments.item_price, items.car_price) as insurance_price, items.market_price, items.amount_equipment, ' .
                    'policies_kasko.options_agregate_no, ' .

                    'accidents_kasko.options_deductible_glass_no as options_deductible_glass_no, accidents_kasko.options_deterioration_no as options_deterioration_no, ' .
                    'accidents_kasko.options_agregate_no as options_agregate_no, policies_kasko.options_fifty_fifty as options_fifty_fifty, ' .

                    'accidents.datetime as accidents_datetime, accidents_kasko.address as accidents_address, accidents.description_average, accidents.damage, ' .

                    'accidents.application_risks_id, parameters_risks.title as application_risks_title, ' .

                    'IF(accidents.application_risks_id = 7, items.deductibles_value1, items.deductibles_value0) as deductible_percent, accidents.amount_rough, ' .

                    'IF(accidents.assistance_place = 1, 2, IF(accidents.assistance = 1, 1, 0)) as assistance, ' .

                    'IF(ADDDATE(accidents.datetime, INTERVAL 3 DAY) > accidents.date, 1, 0) as written_sign, IF(accidents_kasko.mvs > 0, 1, 0) as mvs_sign, ' .

                    'car_services.title as car_services_title, ' .

                    'CONCAT(average_manager.lastname, \' \', average_manager.firstname) as average_manager_name, CONCAT(estimate_manager.lastname, \' \', estimate_manager.firstname) as estimate_manager_name, ' .
					
					'accidents.compromise_delta_premium, accidents.compromise_delta_compensation, accidents.compromise_comment, GROUP_CONCAT(compromise_violation.title SEPARATOR \', \') as compromise_violation_list, ' .

                    'policies.top as policies_top ' .

               'FROM ' . PREFIX . '_accidents as accidents ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
               'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients ON policies.clients_id = clients.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND accidents.datetime BETWEEN years_payments.date AND SUBDATE(ADDDATE(years_payments.date, INTERVAL 1 YEAR), INTERVAL 1 DAY) ' .
               'LEFT JOIN ' . PREFIX . '_parameters_risks as parameters_risks ON accidents.application_risks_id = parameters_risks.id ' .
               'JOIN ' . PREFIX . '_car_services as car_services ON accidents.car_services_id = car_services.id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as average_manager ON accidents.average_managers_id = average_manager.id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as estimate_manager ON accidents.estimate_managers_id = estimate_manager.id ' .
			   'LEFT JOIN ' . PREFIX . '_accidents_compromise_violation as compromise_violation ON compromise_violation.value&accidents.compromise_violation <> 0 ' .
               'WHERE accidents.id = ' . intval($data['accidents_id']);
        $values = $db->getRow($sql);

        $sql = 'SELECT policies.id as policies_id, policies.number as policies_number, policies.date as policies_date, calendar.date as calendar_date, calendar.amount as calendar_amount, SUM(payments_calendar.amount) as payed_amount ' .
               'FROM ' . PREFIX . '_policies as policies ' .
               'LEFT JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_policy_payments_policy_payments_calendar as payments_calendar ON calendar.id = payments_calendar.policy_payments_calendar_id ' .
               'WHERE calendar.valid = 1 AND policies.top = ' . $values['policies_top'] . ' ' .
               'GROUP BY calendar.id ' .
               'ORDER BY calendar.date ASC';
        $values['policies'] = $db->getAll($sql);

        $sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, policies.number as policies_number, accidents.datetime as accidents_datetime, accidents.damage, ' .
                    'accident_statuses.title as accident_statuses_title, GROUP_CONCAT(accidents_compromise_violation.title SEPARATOR \', \') as compromise_violation ' .
               'FROM ' . PREFIX . '_accidents as accidents ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
               'JOIN ' . PREFIX . '_policies as policies ON items.policies_id = policies.id ' .
               'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents.accident_statuses_id = accident_statuses.id ' .
               'LEFT JOIN ' . PREFIX . '_accidents_compromise_violation as accidents_compromise_violation ON accidents_compromise_violation.value & accidents.compromise_violation <> 0 ' .
               'WHERE items.shassi = ' . $db->quote($values['shassi']) . ' AND accidents.datetime < ' . $db->quote($values['accidents_datetime']) . ' ' .
               'GROUP BY accidents.id';
		$accidents = $db->getAll($sql);

		$values['accidents'] = array();
        foreach($accidents as $accident) {
            $values['accidents'][$accident['accidents_id']] = $accident;

            $sql = 'SELECT acts.id, acts.number, acts.insurance, acts.amount, GROUP_CONCAT(reasons.title SEPARATOR \', \') as reason_not_payment ' .
                   'FROM ' . PREFIX . '_accidents_acts as acts ' .
                   'LEFT JOIN ' . PREFIX . '_accidents_not_payment_reason as reasons ON acts.reason_not_payment & reasons.value <> 0 ' .
                   'WHERE acts.accidents_id = ' . intval($accident['accidents_id']) . ' ' .
                   'GROUP BY acts.id ORDER BY acts.number';
            $acts = $db->getAll($sql);

            $values['accidents'][$accident['accidents_id']]['calendar_length'] = 0;
            foreach($acts as $act) {
				$act['insurance'] = $insurance[$act['insurance']];
                $values['accidents'][$accident['accidents_id']]['acts'][$act['id']] = $act;

                $sql = 'SElECT id, amount, recipient, payment_date ' .
                       'FROM ' . PREFIX . '_accident_payments_calendar ' .
                       'WHERE acts_id = ' . $act['id'] . ' ' .
                       'ORDER BY  payment_statuses_id DESC, payment_date ASC';
                $calendar = $db->getAll($sql);

                $values['accidents'][$accident['accidents_id']]['acts'][$act['id']]['calendar'] = $calendar;
                $values['accidents'][$accident['accidents_id']]['calendar_length'] += sizeof($calendar);

            }
        }

        $sql = 'SELECT changes.accident_statuses_id, changes.created, descriptions.description ' .
               'FROM ' . PREFIX . '_accident_status_changes as changes ' .
               'JOIN ' . PREFIX . '_accident_statuses_descriptions as descriptions ON changes.accident_statuses_id = descriptions.accident_statuses_id ' .
               'WHERE changes.accidents_id = ' . intval($data['accidents_id']) . ' AND descriptions.product_types_id IN (1, 3) ' .
               'ORDER BY changes.created ASC';
        $values['history'] = $db->getAll($sql);

        $sql = 'SELECT (calendar.amount) ' .
               'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON calendar.accidents_id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
               'JOIN ' . PREFIX . '_policies as policies ON items.policies_id = policies.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND ' . $db->quote($values['accidents_datetime']) . ' BETWEEN years_payments.date AND SUBDATE(ADDDATE(years_payments.date, INTERVAL 1 YEAR), INTERVAL 1 DAY) ' .
               'WHERE policies.number = ' . $db->quote($values['policies_number']) . ' AND calendar.payment_date < ' . $db->quote($values['accidents_datetime']) . ' AND calendar.payment_types_id IN (5, 6) AND items.shassi = ' . $db->quote($values['shassi']);
        $values['previous_accidents_amount'] = $db->getOne($sql);

        $sql = 'SELECT messages.message_types_id, messages.question, messages.answer ' .
               'FROM ' . PREFIX . '_accident_messages as messages ' .
               'WHERE messages.message_types_id IN(5, 9) AND messages.statuses_id = 2 AND messages.accidents_id = ' . intval($data['accidents_id']) . ' ' .
               'ORDER BY decision DESC';
        $messages = $db->getAll($sql);

        $values['messages'][0]['type'] = 0;
        $values['messages'][1]['title'] = 'Рахунок СТО';
        $values['messages'][2]['title'] = 'Audatex';
        $values['messages'][3]['title'] = 'Незалежний експерт';

        $check_messages = array();
        foreach($messages as $message) {
            $question = unserialize($message['question']);

            if ($message['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH) {
                if (in_array(3, $check_messages)) continue;
                array_push($check_messages, 3);
                $message['answer'] = unserialize($message['answer']);
                $values['messages'][3]['data'] = $message;

                if (in_array($values['messages'][0]['type'], array(0))) {
                    $values['messages'][0]['market_price'] = $message['answer']['market_price'];
                    $values['messages'][0]['deterioration_value'] = $message['answer']['deterioration_value'];
                }
            } elseif ($message['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $question['perform_audatex']) {
                if (in_array(2, $check_messages)) continue;
                array_push($check_messages, 2);
                $message['answer'] = unserialize($message['answer']);
                $values['messages'][2]['data'] = $message;

                if (in_array($values['messages'][0]['type'], array(0, 3))) {
                    $values['messages'][0]['market_price'] = $message['answer']['market_price'];
                    $values['messages'][0]['deterioration_value'] = $message['answer']['deterioration_value'];
                }
            } else {
                if (in_array(1, $check_messages)) continue;
                array_push($check_messages, 1);
                $message['answer'] = unserialize($message['answer']);
                $values['messages'][1]['data'] = $message;

                $result_calculation_car_services_title = $message['answer']['result_calculation_car_services_title'];

                if (in_array($values['messages'][0]['type'], array(0, 2, 3))) {
                    $values['messages'][0]['market_price'] = $message['answer']['market_price'];
                    $values['messages'][0]['deterioration_value'] = $message['answer']['deterioration_value'];
                }
            }
        }
		
		$values['accident_sections_titles'] = $accident_sections_titles[ $values['accident_sections_id'] ];
		$values['zones_id_titles'] = $zones_id_titles[ $values['zones_id'] ];
		$values['insurer_status_titles'] = $insurer_status_titles[ $values['insurer_status_id'] ];
		$values['insurance_price_type'] = $insurance_price_type[ $values['options_agregate_no'] ];
		$values['assistance'] = $assistance[ $values['assistance'] ];
		$values['written_sign'] = $written_sign[ $values['written_sign'] ];
		$values['mvs_sign'] = $mvs_sign[ $values['mvs_sign'] ];
		
		$Smarty->assign('values', $values);
        $Smarty->assign('data', $data);
		$Smarty->assign('result_calculation_car_services_title', $result_calculation_car_services_title);
		
		$file['name']       = $values['accidents_number'] . '_letter_decision';
        $file['content']    = $Smarty->fetch('../files/ProductDocuments/accidents_letter_decision.tpl');
//_dump($values['accidents']);
//_dump($values['policies']);exit;
//echo $file['content'];exit;
        html2pdf($file, array('--orientation' => 'Portrait'));
		
	}

}

?>