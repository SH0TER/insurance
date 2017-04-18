<?
/*
 * Title: accident class
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassy@gmail.com
 * @version 3.0
 */

require_once 'ExpertOrganizations.class.php';
require_once 'AccidentActs.class.php';
require_once 'CarServices.class.php';
require_once 'ProductTypes.class.php';
require_once 'AccidentCalls.class.php';
require_once 'AccidentPayments.class.php';
require_once 'AccidentMessages.class.php';
require_once 'AccidentDocuments.class.php';
require_once 'AccidentStatusChanges.class.php';
require_once 'AccidentPaymentsCalendar.class.php';
require_once 'Users.class.php';
require_once 'Tasks.class.php';
require_once 'AccidentEmails.class.php';
require_once 'ApplicationAccidents.class.php';
require_once 'ApplicationCalls.class.php';
require_once 'RecoveryRepairs.class.php';

class Accidents extends Form {

	var $documentsDelimiter = '	';

    var $sectionFormDescription =
        array(
            'fields'     =>
                array(
                    array(
                        'name'              => 'id',
                        'type'              => fldIdentity,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'                  => 'product_types_id',
                        'description'           => 'Тип продукту',
                        'type'                  => fldHidden,
                        'display'               =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'                 => 'accidents'),
                    array(
                        'name'              => 'accident_sections_id',
                        'description'       => 'Категорія',
                        'type'              => fldSelect,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents',
                        'sourceTable'       => 'accident_sections',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'              => 'update_section_comment',
                        'description'       => 'Коментарій',
                        'type'              => fldNote,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'number',
                        'description'       => 'Номер',
                        'type'              => fldText,
                        'maxlenght'         => 20,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> true
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'modified',
                        'description'       => 'Редаговано',
                        'type'              => fldDate,
                        'value'             => 'NOW()',
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents')
                )
        );

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'maxlenght'         => 20,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 1,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата заяви',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 2,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'product_types_title',
                            'description'       => 'Тип продукту',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 3,
                            'width'             => 100,
                            'withoutTable'		=> true,
                            'table'             => 'product_types'),
                        array(
                            'name'              => 'policies_number',
                            'description'       => 'Поліс',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'withoutTable'		=> true,
                            'orderPosition'     => 4,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'insurer',
                            'description'       => 'Страхувальник',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'withoutTable'		=> true,
                            'orderPosition'		=> 5,
                            'sourceTable'       => 'policies'),
                        array(
                            'name'              => 'item',
                            'description'       => 'Об\'єкт',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'withoutTable'		=> true,
                            'orderPosition'		=> 6,
                            'sourceTable'       => 'policies'),
                        array(
                            'name'              => 'amount_rough',
                            'description'       => 'Орієнтовний збиток, грн.',
                            'type'              => fldMoney,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 7,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'IF(accident_sections_id > 0, insurance_accident_sections.title, \'Не визначено\') AS accident_sections_id',
                            'description'       => 'Категорія',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'withoutTable'		=> true,
                            'orderPosition'     => 8,
                            'table'             => 'accident_sections'),
                        array(
                            'name'              => 'insurance',
                            'description'       => 'Випадок',
                            'type'              => fldInteger,
                            'list'				=> array(
                                                    1 => 'Страховий, з виплатою',
                                                    2 => 'Страховий, без виплати',
                                                    3 => 'Не страховий'),
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 9,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'regres',
                            'description'       => 'Регрес',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 10,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'repair_classifications_title',
                            'description'       => 'Клас ремонту',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 11,
                            'withoutTable'		=> true,
                            'table'             => 'repair_classifications'),
                        array(
                            'name'              => 'payment_statuses_title',
                            'description'       => 'Оплата',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 12,
                            'withoutTable'		=> true,
                            'table'             => 'payment_statuses'),
                        array(
                            'name'            	=> 'getCompensation(insurance_accidents.id, insurance_accidents.product_types_id) as compensation',
                            'description'       => 'Відшкодування, грн',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 13,
                            'withoutTable'		=> true,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'accident_statuses_title',
                            'description'       => 'Статус',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 14,
                            'table'             => 'accident_statuses'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'table'             => 'accidents')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'date'
                    )
            );

    function Accidents($data) {
        $this->object = 'Accidents';
        $this->objectTitle = 'Accidents';

        Form::Form($data);

        $this->messages['plural'] = 'Випадки';
        $this->messages['single'] = 'Випадок';

        $this->setStatusesSchema($data);

    }

    function getRowClass($row, $i){
        $result = parent::getRowClass($row, $i);

		/*if ($row['sectionsId'] == 1) {
 			if ($row['days_cl'] >= 7) $result .= ' lightblue';
            if ($row['days_cl'] >= 10) $result .= ' darkblue';
			return $result;
		}

		if ($row['days'] >= 2 && $row['days'] < 4 && in_array($row['statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION))) {
        	$result .= ' green';
        } elseif($row['days'] >= 4  && $row['days'] < 6 && in_array($row['statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION))) {
        	$result .= ' yellow';
        } elseif($row['days'] >= 6 && in_array($row['statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION))){
        	$result .= ' red';
        }*/
		
		if (in_array($row['statuses_id'], array(ACCIDENT_STATUSES_CLASSIFICATION, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
		
			switch ($row['sectionsId']) {
				case 1:
					if (intval($row['days'])) {
						$result .= ' red';
					} else {
						$result .= ' green';
					}
					break;
				case 2:
					if (intval($row['days']) == 1) {
						$result .= ' magenta';
					} elseif (intval($row['days']) > 1) {
						$result .= ' red';
					} else  {
						$result .= ' yellow';
					}
					break;
				case 3:
					if (intval($row['days']) == 1) {
						$result .= ' magenta';
					} elseif (intval($row['days']) > 1) {
						$result .= ' red';
					} else  {
						$result .= ' orange';
					}
					break;
				case 4:
					if (intval($row['days']) == 3) {
						$result .= ' magenta';
					} elseif (intval($row['days']) > 3) {
						$result .= ' red';
					} else  {
						$result .= ' lightblue';
					}
					break;
				default:
					break;
			}
			
		}

        return $result;
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                if ($Authorization->data['agencies_id'] == SELLER_AGENCIES_ID) {
                    $this->permissions = array(
                        'show'      	            => true,
                        'view'			            => true);
                    break;
                }
                break;
            case ROLES_MASTER:
                $this->permissions = array(
					'show'      	            => true,
                    'insert'		            => false,
                    'update'		            => true,
                    'view'			            => true,
                    'change'		            => false,
                    'delete'		            => false);
                break;
            case ROLES_INSURER:
                $this->permissions = array(
                    'show'      	=> true,
                    'insert'		=> false,
                    'update'		=> true,
                    'view'			=> true,
                    'change'		=> false,
                    'delete'		=> false);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                if ($Authorization->data['id'] == 6556) {
                    $this->permissions['deleteComments'] = true;
                }
                $this->permissions['exportCarServicesCompensation'] = true;
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'						=> true,
                    'insert'					=> true,
                    'update'					=> true,
					'reset'						=> true,
                    'view'						=> true,
                    'change'					=> true,
					'updateClassification'		=> true,
					'updateRisk'				=> true,
					'updateActs'				=> true,
                    'delete'					=> true,
                    'updateMTSBU'               => true,
					'archive'					=> true,
					'backToRisk'				=> true,
                    'closeAccident'             => true,
					'updateSection'				=> true,
                    'assignMonitorUser'         => true,
                    'paymentApplication'        => true,
                    'exportAll'                 => true,
                    'exportClosed'              => true,
                    'exportPayments'            => true,
                    'importAll'                 => true,
                    'importClosed'              => true,
                    'importPayments'            => true,
                    'deleteComments'            => true,
                    'exportCarServicesCompensation' =>  true,
                    'importRepairInfo'          => true,
					'inExpress'					=> true,
					'previousStatuses'			=> true,
					'updateAll'					=> true,
					'updateRegres'				=> true
                    );
                break;
        }
    }

	function getPaymentStatusesId($id) {
		global $db;

		$sql =	'SELECT payment_statuses_id ' .
				'FROM ' . PREFIX .'_accidents' .//. $this->tables['0'] . ' ' .
				'WHERE id = ' . intval($id);
		return	$db->getOne($sql, 30 * 60);
	}

    function checkPermissions($action, $data, $redirect=false) {

        global $db, $Authorization, $Log;

        if ($action == 'show' || $action == 'view') {
        	$result = parent::checkPermissions($action, $data, $redirect);
        } else {

        	if ($data['accidents_id']) {
        		$data['id'] = $data['accidents_id'];
        	} elseif (is_array($data['id'])) {
        		$data['id'] = $data['id'][ 0 ];
        	}

			$conditions[] = 'id = ' . intval($data['id']);
	
			$sql =	'SELECT car_services_id, masters_id, average_managers_id, estimate_managers_id, accident_statuses_id, insurance ' .
					'FROM ' . PREFIX . '_accidents ' .
					'WHERE ' . implode(' AND ', $conditions);

			$row = $db->getRow($sql);

			switch ($action) {
				case 'view':
					switch ($Authorization->data['roles_id']) {
						case ROLES_MASTER:
							if ($row['car_services_id'] != $Authorization->data['car_services_id']) {
								parent::checkPermissions($action, $data, true);
							}
							break;
					}
					break;
	            case 'update':
					switch ($Authorization->data['roles_id']) {
						case ROLES_MASTER:
							if ($row['car_services_id'] == $Authorization->data['car_services_id']) {
								$accident_statuses = array(
									ACCIDENT_STATUSES_APPLICATION);
							}
							break;
						case ROLES_MANAGER:  
                            if(in_array(ACCIDENT_ARCHIVE_STATUSES_YES,$data['archive_statuses_id'])){
                                return parent::checkPermissions($action, $data, true);
                            }
                            else{
                                if ($this->permissions['update']) {
                                    $accident_statuses = array(
                                        ACCIDENT_STATUSES_APPLICATION,
                                        ACCIDENT_STATUSES_CLASSIFICATION,
                                        ACCIDENT_STATUSES_APPROVAL,
										ACCIDENT_STATUSES_COORDINATION,
                                        ACCIDENT_STATUSES_MTSBU,
                                        ACCIDENT_STATUSES_RESET);
                                }

                                if ($this->permissions['updateClassification']) {
					                $accident_statuses[] = ACCIDENT_STATUSES_CLASSIFICATION;
                                    $accident_statuses[] = ACCIDENT_STATUSES_INVESTIGATION;
									$accident_statuses[] = ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
                                    $accident_statuses[] = ACCIDENT_STATUSES_APPROVAL;
									$accident_statuses[] = ACCIDENT_STATUSES_COORDINATION;
                                    $accident_statuses[] = ACCIDENT_STATUSES_RESET;
                                    $accident_statuses[] = ACCIDENT_STATUSES_REINVESTIGATION;
                                    $accident_statuses[] = ACCIDENT_STATUSES_DEFECTS;
                                }

                                if ($this->permissions['updateRisk'] && (in_array($row['average_managers_id'], $Authorization->data['managers']) || $this->permissions['updateRiskAll']) &&
                                    $this->permissions['updateActs'] && (in_array($row['average_managers_id'], $Authorization->data['managers']) || $this->permissions['updateActsAll'])) {
                                    $accident_statuses[] = ACCIDENT_STATUSES_INVESTIGATION;
									$accident_statuses[] = ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
                                    $accident_statuses[] = ACCIDENT_STATUSES_REINVESTIGATION;
									$accident_statuses[] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;
                                }
                                break;
                            }

						case ROLES_ADMINISTRATOR:

							$accident_statuses = array(
								ACCIDENT_STATUSES_APPLICATION,
								ACCIDENT_STATUSES_CLASSIFICATION,
								ACCIDENT_STATUSES_INVESTIGATION,
								ACCIDENT_STATUSES_COMPROMISE_AGREEMENT,
								ACCIDENT_STATUSES_COMPROMISE_CONTINUE,								
                                ACCIDENT_STATUSES_MTSBU,
								ACCIDENT_STATUSES_APPROVAL,
								ACCIDENT_STATUSES_COORDINATION,
								ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY,
								ACCIDENT_STATUSES_RESET,
								ACCIDENT_STATUSES_REINVESTIGATION,
                                ACCIDENT_STATUSES_PAYMENT,
                                ACCIDENT_STATUSES_CLOSED,
								ACCIDENT_STATUSES_DEFECTS,
                                ACCIDENT_STATUSES_RESOLVED,
								ACCIDENT_STATUSES_SUSPENDED);

							break;
					}
					if (!in_array($row['accident_statuses_id'], $accident_statuses)) {
						parent::checkPermissions($action, $data, true);
					}

					break;
                case 'updateClassification' :
                    if (!$this->permissions['updateClassification'] || ($row['accident_statuses_id'] > ACCIDENT_STATUSES_INVESTIGATION && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR)) {                         
                        return parent::checkPermissions($action, $data, true);
                    }
                    break;
                
                case 'updateRisk' :
                    if (!$this->permissions['updateRisk'] || (!in_array($row['accident_statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR)) {
                        return parent::checkPermissions($action, $data, true);
                    }
                    break;

                case 'updateActs': //запрещаем переходить на страховые акты, когда не проведен "Розгляд"
                     if (!$row['insurance']) {
                        return parent::checkPermissions($action, $data, true);
                     }
                     break;
                case 'updateMTSBU':
                    if ((!$this->permissions['updateMTSBU'] && (!in_array($row['average_managers_id'], $Authorization->data['managers']))) || (!in_array($row['accident_statuses_id'], array(ACCIDENT_STATUSES_MTSBU, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION))  && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR)) {
                        return parent::checkPermissions($action, $data, true);
                     } else {
                        $this->permissions['updateMTSBU'] = true;
                        $result = true;
                    }
                    break;
                case 'updateSection':
                     if (!$this->permissions['updateSection']) {
                        return parent::checkPermissions($action, $data, true);
                     }					
					 return true;
                     break;

				case 'reset':
					$result = parent::checkPermissions($action, $data, $redirect);

					if (!$result) {//запрещаем перезапускать, если было оплата по акту
						$result = parent::checkPermissions($action, $data, $this->getPaymentStatusesId( $data['id'] ) != PAYMENT_STATUSES_NOT);
					}
					break;
	        }
        }
 
        return $result;
    }

    function factory(&$data, $type=null) {

        if (!$type) {
            $type = ProductTypes::get($data['product_types_id']);
        }

        if($data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE || $type == 'Drive'){
            $type = 'KASKO';
        }
		
		if($data['product_types_id'] == PRODUCT_TYPES_PRODUCT_TYPES_ONE_SHIPPING || $type == 'OneShipping'){
            $type = 'Cargo';
        }

        require_once 'Accidents/' . $type . '.class.php';

        $class = 'Accidents_' . $type;

        @$obj =& new $class($data);

        return $obj;
    }

    function setStatusesSchema($data,$roles_id=null) {
        global $Authorization, $ACCIDENT_STATUSES_SCHEMA;

        if (is_null($roles_id)) {
            $roles_id = $Authorization->data['roles_id'];
        }

		switch ($roles_id) {
			case ROLES_MANAGER:
			case ROLES_ADMINISTRATOR:
				$ACCIDENT_STATUSES_SCHEMA = array(

					ACCIDENT_STATUSES_APPLICATION =>
						array(
							ACCIDENT_STATUSES_APPLICATION,
							ACCIDENT_STATUSES_CLASSIFICATION),

					ACCIDENT_STATUSES_CLASSIFICATION =>
						array(
							ACCIDENT_STATUSES_CLASSIFICATION,
							ACCIDENT_STATUSES_INVESTIGATION),
                    ACCIDENT_STATUSES_MTSBU =>
                        array(
							ACCIDENT_STATUSES_MTSBU),
					ACCIDENT_STATUSES_INVESTIGATION =>
						array(
							ACCIDENT_STATUSES_INVESTIGATION,
							ACCIDENT_STATUSES_COMPROMISE_AGREEMENT,
							ACCIDENT_STATUSES_COORDINATION),
					ACCIDENT_STATUSES_COMPROMISE_AGREEMENT =>
						array(
							ACCIDENT_STATUSES_COMPROMISE_AGREEMENT,
							ACCIDENT_STATUSES_COMPROMISE_CONTINUE,
							ACCIDENT_STATUSES_REINVESTIGATION),
					ACCIDENT_STATUSES_COMPROMISE_CONTINUE =>
						array(
							ACCIDENT_STATUSES_COMPROMISE_CONTINUE,
							ACCIDENT_STATUSES_COORDINATION,
							ACCIDENT_STATUSES_REINVESTIGATION),
					ACCIDENT_STATUSES_COORDINATION =>
						array(
							ACCIDENT_STATUSES_COORDINATION,
							ACCIDENT_STATUSES_APPROVAL),
					ACCIDENT_STATUSES_APPROVAL =>
						array(
							ACCIDENT_STATUSES_APPROVAL,
							ACCIDENT_STATUSES_PAYMENT,
							ACCIDENT_STATUSES_RESOLVED),
					ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY =>
						array(
							ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY),
					ACCIDENT_STATUSES_PAYMENT =>
						array(
							ACCIDENT_STATUSES_PAYMENT),
					ACCIDENT_STATUSES_RESOLVED =>
						array(
							ACCIDENT_STATUSES_RESOLVED),
                    ACCIDENT_STATUSES_CLOSED =>
                        array(
                            ACCIDENT_STATUSES_CLOSED),
					ACCIDENT_STATUSES_RESET =>
						array(
							ACCIDENT_STATUSES_RESET,
							ACCIDENT_STATUSES_CLASSIFICATION),

					ACCIDENT_STATUSES_REINVESTIGATION =>
						array(
							ACCIDENT_STATUSES_REINVESTIGATION,
							ACCIDENT_STATUSES_COORDINATION),

					ACCIDENT_STATUSES_DEFECTS =>
						array(
							ACCIDENT_STATUSES_DEFECTS),

					ACCIDENT_STATUSES_SUSPENDED =>
						array(
							ACCIDENT_STATUSES_SUSPENDED,
							ACCIDENT_STATUSES_RESOLVED)
				);
				break;
			case ROLES_MASTER:
				$ACCIDENT_STATUSES_SCHEMA = array(

					ACCIDENT_STATUSES_APPLICATION =>
						array(
							ACCIDENT_STATUSES_APPLICATION),

					ACCIDENT_STATUSES_CLASSIFICATION =>
						array(
							ACCIDENT_STATUSES_CLASSIFICATION),
                    ACCIDENT_STATUSES_MTSBU =>
                        array(
							ACCIDENT_STATUSES_MTSBU),
					ACCIDENT_STATUSES_INVESTIGATION =>
						array(
							ACCIDENT_STATUSES_INVESTIGATION),
					ACCIDENT_STATUSES_COMPROMISE_AGREEMENT =>
						array(
							ACCIDENT_STATUSES_COMPROMISE_AGREEMENT),
					ACCIDENT_STATUSES_COMPROMISE_CONTINUE =>
						array(
							ACCIDENT_STATUSES_COMPROMISE_CONTINUE),
					ACCIDENT_STATUSES_COORDINATION =>
						array(
							ACCIDENT_STATUSES_COORDINATION),
					ACCIDENT_STATUSES_APPROVAL =>
						array(
							ACCIDENT_STATUSES_APPROVAL),

					ACCIDENT_STATUSES_PAYMENT =>
						array(
							ACCIDENT_STATUSES_PAYMENT),

					ACCIDENT_STATUSES_RESOLVED =>
						array(
							ACCIDENT_STATUSES_RESOLVED),

					ACCIDENT_STATUSES_RESET =>
						array(
							ACCIDENT_STATUSES_RESET,
							ACCIDENT_STATUSES_CLASSIFICATION),
					ACCIDENT_STATUSES_REINVESTIGATION =>
						array(
							ACCIDENT_STATUSES_REINVESTIGATION),

					ACCIDENT_STATUSES_DEFECTS =>
						array(
							ACCIDENT_STATUSES_DEFECTS),
					ACCIDENT_STATUSES_SUSPENDED =>
						array(
							ACCIDENT_STATUSES_SUSPENDED
							),
                    ACCIDENT_STATUSES_CLOSED =>
                        array(
                            ACCIDENT_STATUSES_CLOSED),
				);
				break;
            case ROLES_AGENT:
                $ACCIDENT_STATUSES_SCHEMA = array(

                    ACCIDENT_STATUSES_APPLICATION =>
                        array(
                            ACCIDENT_STATUSES_APPLICATION),

                    ACCIDENT_STATUSES_CLASSIFICATION =>
                        array(
                            ACCIDENT_STATUSES_CLASSIFICATION),
                    ACCIDENT_STATUSES_MTSBU =>
                        array(
                            ACCIDENT_STATUSES_MTSBU),
                    ACCIDENT_STATUSES_INVESTIGATION =>
                        array(
                            ACCIDENT_STATUSES_INVESTIGATION),
                    ACCIDENT_STATUSES_COMPROMISE_AGREEMENT =>
                        array(
                            ACCIDENT_STATUSES_COMPROMISE_AGREEMENT),
                    ACCIDENT_STATUSES_COMPROMISE_CONTINUE =>
                        array(
                            ACCIDENT_STATUSES_COMPROMISE_CONTINUE),
                    ACCIDENT_STATUSES_COORDINATION =>
                        array(
                            ACCIDENT_STATUSES_COORDINATION),
                    ACCIDENT_STATUSES_APPROVAL =>
                        array(
                            ACCIDENT_STATUSES_APPROVAL),

                    ACCIDENT_STATUSES_PAYMENT =>
                        array(
                            ACCIDENT_STATUSES_PAYMENT),

                    ACCIDENT_STATUSES_RESOLVED =>
                        array(
                            ACCIDENT_STATUSES_RESOLVED),

                    ACCIDENT_STATUSES_RESET =>
                        array(
                            ACCIDENT_STATUSES_RESET,
                            ACCIDENT_STATUSES_CLASSIFICATION),
                    ACCIDENT_STATUSES_REINVESTIGATION =>
                        array(
                            ACCIDENT_STATUSES_REINVESTIGATION),

                    ACCIDENT_STATUSES_DEFECTS =>
                        array(
                            ACCIDENT_STATUSES_DEFECTS),
                    ACCIDENT_STATUSES_SUSPENDED =>
                        array(
                            ACCIDENT_STATUSES_SUSPENDED
                        ),
                    ACCIDENT_STATUSES_CLOSED =>
                        array(
                            ACCIDENT_STATUSES_CLOSED),
                );
                break;
		}
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $Authorization;

        if ($data['clients_id']) {

            $this->setTables('show');
            $this->setShowFields();

            $fields[] = 'clients_id';
            $conditions[] = PREFIX . '_accidents.policies_id IN(SELECT id FROM ' . PREFIX . '_policies WHERE clients_id = ' . intval($data['clients_id']) . ')';

            $sql =  'SELECT ' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.number, date_format(' . PREFIX . '_accidents.date, \'%d.%m.%Y\') AS date_format, ' .
                    PREFIX . '_accidents.product_types_id, ' . PREFIX . '_product_types.title AS product_types_title, CONCAT(' . PREFIX . '_policies.number, \'-\', ' . PREFIX . '_policies.sub_number) AS policies_number, ' .
                    PREFIX . '_policies.insurer, ' . PREFIX . '_policies.item, ' . PREFIX . '_accidents.amount_rough, IF(accident_sections_id > 0, ' . PREFIX . '_accident_sections.title, \'Не визначено\') AS accident_sections_title, ' .
                    PREFIX . '_accidents.insurance, ' . PREFIX . '_accidents.regres, ' . PREFIX . '_repair_classifications.title AS repair_classifications_title, ' . PREFIX . '_payment_statuses.title AS payment_statuses_title, ' .
                    'getCompensation(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.product_types_id) as compensation, ' . PREFIX . '_accident_statuses.title AS accident_statuses_title ' .
                    'FROM ' . PREFIX . '_accidents ' .
                    'LEFT JOIN ' . PREFIX . '_product_types ON ' . PREFIX . '_accidents.product_types_id = ' . PREFIX . '_product_types.id ' .
                    'LEFT JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policies.id = ' . PREFIX . '_accidents.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_accident_sections ON ' . PREFIX . '_accidents.accident_sections_id = ' . PREFIX . '_accident_sections.id ' .
                    'LEFT JOIN ' . PREFIX . '_repair_classifications ON ' . PREFIX . '_accidents.repair_classifications_id = ' . PREFIX . '_repair_classifications.id ' .
                    'LEFT JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_accidents.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' .
                    'LEFT JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accidents.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ';
            return parent::show($data, $fields, $conditions, $sql, $template, $limit);
        } else {
            /*$data['product_types_id'] = PRODUCT_TYPES_KASKO;

            $Accidents = Accidents::factory($data);
            $Accidents->show($data, $fields, $conditions, $sql);*/
			
			include_once $this->objectTitle . '/showAll.php';
        }
	}

    function getFormFields($action) {
        $indexFieldTable = $this->getIdentityFieldTable();

        foreach($this->formDescription['fields'] as $field) {
            if ($field['display'][ $action ]) {
                if ($field['multiLanguages']) {
                    foreach($this->languages as $languageCode => $languageTitle) {
                        $this->formFields[] = $this->getFormField($field, $languageCode);
                    }
                } else {
                    $this->formFields[] = $this->getFormField($field);
                }
            }
        }

        return $this->formFields;
    }

    function getAssignmentConditions($action, $prefixSQL='', $postfixSQL='') {
        $result = parent::getAssignmentConditions($action, $prefixSQL, $postfixSQL);
        return str_replace(PREFIX . '_accidents.id=' . PREFIX . '_policies.accidents_id', PREFIX . '_policies.id=' . PREFIX . '_accidents.policies_id', $result);
    }

    function showAgenda($data) {
    	global $Authorization;

        if (!$data['accidents_id']) {
            $data['accidents_id'] = $data['id'];
        }

        include_once $this->object . '/kaskoAgenda.php';
    }

    function getSumAmounts($accidents_id) {
        global $db;

        $sql = 'SELECT SUM(amount) FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE accidents_id = ' . intval($accidents_id) . ' ' .
               'GROUP BY accidents_id';
        return $db->getOne($sql);
    }

    function setMode($data) {

        if (is_array($data['id'])) {
            $data['accidents_id'] = $data['id'][0];
        } elseIf (!intval($data['accidents_id']) && $data['id']) {
            $data['accidents_id'] = $data['id'];
        }

		if (ereg('^' . $this->object . '\|view', $data['do'])) {
            $this->mode = 'view';
			$_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'] = 'view';
		} elseif (ereg('^' . $this->object . '\|(add|insert|load|update)', $data['do'])) {
            $this->mode = 'update';
			$_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'] = 'update';
        } elseif ($_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode']) {
            $this->mode = $_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'];
		}
    }

	function getMode($id) {
		return ($_SESSION[ 'Accidents' ][ $id ]['mode']) ? $_SESSION[ 'Accidents' ][ $id ]['mode'] : 'update';
	}

    function getListValue($field, $data) {
        global $db, $ACCIDENT_STATUSES_SCHEMA;

        switch ($field['name']) {
            case 'accident_statuses_id':

                //если случай без выплаты, убираем оплату из списка статусов
                if($data['amount'] > 0 && $data['act_type'] != ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL){
                    $ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_APPROVAL ] = array(
                        ACCIDENT_STATUSES_APPROVAL,
						ACCIDENT_STATUSES_PAYMENT);
                } else {
                    $ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_APPROVAL ] = array(
						ACCIDENT_STATUSES_APPROVAL,
						ACCIDENT_STATUSES_SUSPENDED,
						ACCIDENT_STATUSES_RESOLVED);
                }
		
				if(in_array(Accidents::getAccidentStatusesId($data['accidents_id']), array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION))) {
					$ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_INVESTIGATION ] = array(
						ACCIDENT_STATUSES_INVESTIGATION,
						ACCIDENT_STATUSES_COORDINATION);
					$ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_REINVESTIGATION ] = array(
						ACCIDENT_STATUSES_INVESTIGATION,
						ACCIDENT_STATUSES_COORDINATION);
				} elseif (Accidents::getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_COORDINATION) {
					$ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_COORDINATION ] = array(
						ACCIDENT_STATUSES_COORDINATION,
						ACCIDENT_STATUSES_APPROVAL);
				}
				
				if (Accidents::getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY && $data['amount'] > 0 && $data['act_type'] != ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL) {
					$ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY ] = array(
						ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY,
						ACCIDENT_STATUSES_PAYMENT
					);
				} elseif (Accidents::getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY && $data['sign_suspended'] == 1) {
					$ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY ] = array(
						ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY,
						ACCIDENT_STATUSES_SUSPENDED
					);
				} elseif (Accidents::getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY) {
					$ACCIDENT_STATUSES_SCHEMA[ ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY ] = array(
						ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY,
						ACCIDENT_STATUSES_RESOLVED
					);
				}

                if (!ereg('(Accidents\|show)|(Clients\|view)', $data['do'])) {
					$field['condition'] = 'id IN(' . implode(', ', $ACCIDENT_STATUSES_SCHEMA[ $data['accident_statuses_id'] ]) . ')';
                }

                break;
        }

        return parent::getListValue($field, $data);
    }

    function header($data) {
        include_once $this->object . '/header.php';
    }

    function footer($data) {
    	global $Authorization, $db;

        $back 			= true;
        $next 			= true;
        $backToList 	= true;
		//$backToRisk		= $this->permissions['backToRisk'];

		//если не все акты во врегульовано, то убераем "Справу закрито"
        $sql = 'SELECT SUM(act_statuses_id)/count(id) as degree ' .
               'FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE accidents_id = ' . intval($data['accidents_id']);
        $degree = $db->getOne($sql);
		 
		$sql = 'SELECT accident_statuses_id ' .
		       'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($data['accidents_id']);
		$accident_statuses_id = $db->getOne($sql);
		
		if ($accident_statuses_id == ACCIDENT_STATUSES_RESOLVED || $accident_statuses_id == ACCIDENT_STATUSES_CLOSED || $accident_statuses_id == ACCIDENT_STATUSES_SUSPENDED) {
			$backToRisk = $this->permissions['backToRisk'];
		} 

		if($degree == ACCIDENT_STATUSES_RESOLVED && $accident_statuses_id == ACCIDENT_STATUSES_RESOLVED) {
			$closeAccident = $this->permissions['closeAccident'];
		}
		switch ($data['step']) {
			case 1:
				$back = false;
				break;
			case 5:
				$next = false;
				break;
		}

		if ($Authorization->data['roles_id'] == ROLES_MASTER && $data['step'] != 1) {
			$next = false;
		}

		$previousStatusesInfo = $this->getPreviousStatuses($data['accidents_id']);

		if (in_array($previousStatusesInfo['accident_statuses_id'], $this->previousStatusesSchema[$accident_statuses_id])) {
			$previousStatuses = $this->permissions['previousStatuses'];
		}

        $row = $this->getPoliciesValues($data['accidents_id']);

        /*if (is_array($row) && sizeOf($row)) {
            $data = array_merge($data, $row);
			$data['accidents_id'] = $row['id'];
        }*/
        //_dump($data);
        include_once $this->object . '/footer.php';

		//$row = $this->getPoliciesValues($data['accidents_id']);
//_dump($row);
		if (!preg_match('/add|insert/', $data['do'])) {
			$data['do'] = 'Accidents|show';

			$row['accidents_id']		= $data['accidents_id'];
			$row['companies_id']		= array( $row['companies_id'] );
			$row['archive_statuses_id']	= array(0, 1);
            if ($Authorization->data['roles_id'] != ROLES_MASTER) {
                $Accidents = Accidents::factory($data, $this->product_title);
                $Accidents->objectTitle = 'AccidentsOther';
                $Accidents->show($row);
            }
		}		
    }

	//формируем список цветов, используется урегулированием
	function getColors() {
        global $db;

		$result[] = array('id' => 0, 'title' => '...');

        $sql =  'SELECT id, title ' .
                'FROM ' . PREFIX . '_car_colors ' .
                'ORDER BY order_position';
		return array_merge($result, $db->getAll($sql, 60*60));
    }

	function getDocumentTypes($data) {
		global $db;

        $conditions[] = 'product_types_id in ( ' . PRODUCT_TYPES_KASKO . ', 1)'; //КАСКО+Тип = Транспорт
        $conditions[] = 'id <> ' . DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT;

		if ($data['step'] == 1) {
			$conditions[] = 'declaration & 1';
		}

        $sql =  'SELECT id, title ' .
				'FROM ' . PREFIX . '_product_document_types ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY title';
        $list =  $db->getAll($sql);

        $result = '';
        if (is_array($list)) {
			$result = '<table>';
            foreach ($list as $i => $row) {
                $result .=  '<tr><td><input type="checkbox" name="product_document_types[]" value="' . $row['id'] . '" ' . (in_array($row['id'], $data['product_document_types']) ? 'checked' : '') . ' ' . $this->getReadonly(true) . ' /></td><td>' . $row['title'] . '</tr>';
            }
			$result .= '</table>';
        }

		return $result;
	}

    function showForm($data, $action, $actionType=null, $template='kaskoApplication.php') {
        global $db, $Authorization, $ACCIDENT_STATUSES_SCHEMA;

        switch ($action) {
            case 'insert':
            case 'view':
            case 'update':
                $data['step'] = 1;
				$data['colors'] = $this->getColors();
                break;
            case 'viewClassification':
            case 'updateClassification':
                $data['step'] = 2;

				//строим список менеджеров, которые имеют право урегулировать дело
				$conditions		= array();
				$conditions[]	= 'a.active = 1';
				$conditions[]	= '(b.account_groups_id > 0 OR c.account_groups_id > 0)';

                $sql = 'SELECT a.id, a.lastname, a.firstname, ' .
                               'IF(b.account_groups_id > 0, TRUE, FALSE) as risk, IF(c.account_groups_id > 0, TRUE, FALSE) as estimate, ' .
                               'getCountAccidentsForManager(a.id, ' . intval($data['product_types_id']) . ') as accidents_investigated, ' .
                               'getCountMessagesForManager(a.id, ' . intval($data['product_types_id']) . ') as messages_investigated ' .
                        'FROM ' . PREFIX . '_accounts as a ' .
                        'LEFT JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id AND b.account_groups_id IN (' . ACCOUNT_GROUPS_AVERAGE . ', ' . ACCOUNT_GROUPS_AVERAGE_HEAD . ') ' .
                        'LEFT JOIN ' . PREFIX . '_account_groups_managers_assignments as c ON a.id = c.accounts_id AND c.account_groups_id IN (' . ACCOUNT_GROUPS_ESTIMATE . ', ' . ACCOUNT_GROUPS_ESTIMATE_HEAD . ') ' .
                        'WHERE ' . implode(' AND ', $conditions) . ' ' .
                        'GROUP BY a.id ' .
                        'ORDER BY a.lastname, a.firstname, a.patronymicname';

				$data['managers'] = $db->getAll($sql, 5 * 60);

                $sql = 'SELECT a.id,a.title ' .
                       'FROM ' . PREFIX . '_expert_organizations as a ORDER BY id';
                $data['experts_organizations'] = $db->getAll($sql, 5 * 60);

                break;
            case 'viewMTSBU':
            case 'updateMTSBU':
                $data['step'] = 3;
                break;
            case 'viewRisk':
            case 'updateRisk':
                $data['step'] = 4;
				$data['risks'] = $this->getRisks($data['id']);
                break;
            case 'viewActs':
            case 'updateActs':
                $data['step'] = 5;
                break;
			case 'viewCall':
				break;
            default:
                $data['step'] = 0;
                break;
        }

		$sql = 'SELECT application_accidents_id ' .
			'FROM ' . PREFIX . '_accidents ' .
			'WHERE id = ' . intval($data['id']);
		$application_accidents_id = $db->getOne($sql);
		
		$sql = 'SELECT id ' .
			   'FROM ' . PREFIX . '_application_calls ' .
			   'WHERE application_accidents_id = ' . intval($application_accidents_id);
		$application_calls_id = $db->getOne($sql);
		
		/*if (!intval($application_calls_id) && $data['step'] == 'call') {
			$action = 'view';
			$data['step'] = 1;
		}*/

		if (intval($_GET['owner_types_id']) == 1) {
			$sql = 'SELECT insurer_application_accidents_id ' .
				'FROM ' . PREFIX . '_application_accidents_go_victim_to_insurer ' .
				'WHERE victim_application_accidents_id = ' . intval($application_accidents_id);
			$application_accidents_id = $db->getOne($sql);
		}

		
		if (!ereg('.*Section$', $_REQUEST['do'])) {
			$this->header($data);
		}

		if (intval($application_calls_id) && $data['action'] == 'viewCall') {		
			include_once 'Accidents/monitoring.php';
            echo '<div id="comments"></div>';
			$ApplicationCalls = new ApplicationCalls(null);
			$ApplicationCalls->view(array('id' => $application_calls_id, 'in_accidents' => 1, 'accidents_id' => $data['id'], 'product_types_id' => $data['product_types_id']));
		} elseif (intval($application_accidents_id) && ($action == 'view' || $data['action'] == 'viewCall')) {
            include_once 'Accidents/monitoring.php';
            echo '<div id="comments"></div>';
			$ApplicationAccidents = new ApplicationAccidents(null);
			$ApplicationAccidents->view(array('id' => $application_accidents_id, 'in_accidents' => 1, 'accidents_id' => $data['id'], 'product_types_id' => $data['product_types_id']));
		} else {
			parent::showForm($data, $action, $actionType, $template);
		}

		if (!ereg('.*Section$', $_REQUEST['do'])) {
			$data = array_merge ($_GET,$data);
			$this->footer($data);
		}
    }

    function add($data) {
        global $db, $Authorization;

        switch($Authorization->data['roles_id']){
            case ROLES_MASTER:
                $data['location'] = $Authorization->data['car_services_address'];
                break;
			case ROLES_MANAGER:
				if (in_array(ACCOUNT_GROUPS_SETTLEMENT_EXPRESS, $Authorization->data['account_groups_id'])) {
					$data['car_services_id'] = 1;
					$Authorization->data['car_services_id'] = 1;
				}
				if (in_array(ACCOUNT_GROUPS_RECEPTIONIST, $Authorization->data['account_groups_id'])) {
					$data['car_services_id'] = 159;
					$Authorization->data['car_services_id'] = 159;
				}
				break;
        }

		$data['accident_statuses_id'] = ACCIDENT_STATUSES_APPLICATION;
		$data['payment_statuses_id'] = PAYMENT_STATUSES_NOT;

		return parent::add($data);
    }

    function changeStep($data) {

        if($this->mode == 'u'){
            $this->mode = 'update';
        }
        if($this->mode == 'v'){
            $this->mode = 'view';
        }

        switch ($data['step']) {
            case 1:
                $action = ($this->mode == 'update') ? 'load' : 'view';
                header('Location: /?do=' . $this->object . '|' . $action . '&id=' . $data['accidents_id'] . '&application=1&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 2:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'Classification&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 3:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'MTSBU&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 4:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'Risk&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 5:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'Acts&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
			case 'call':
				$action = ($this->mode == 'update') ? 'load' : 'view';
                header('Location: /?do=' . $this->object . '|viewCall&id=' . $data['accidents_id'] . '&call=1&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            default:
                header('Location: /?do=' . $this->object . '|show');
                exit;
                break;
        }
    }

    function changeApplicant($data) {
        $action = ($data['mode'] == 'update') ? 'load' : 'view';
        header('Location: /?do=' . $this->object . '|' . $action . '&id=' . $data['accidents_id'] . '&mode='.$this->mode.'&product_types_id=' . $data['product_types_id'] . '&victim_accidents_id=' . $data['victim_accidents_id'] . '&insurer_accidents_id=' . $data['insurer_accidents_id']);
        exit;
    }

    function setConstants(&$data) {
        parent::setConstants($data);
		
		if ($data['compromise']) {
			$data['compromise_violation'] = array_sum($data['compromise_violation']);
			
			$this->formDescription['fields'][ $this->getFieldPositionByName('compromise_violation') ]['verification']['canBeEmpty'] = false;
			//$this->formDescription['fields'][ $this->getFieldPositionByName('compromise_date') ]['verification']['canBeEmpty'] = false;
		} else {
				$data['compromise_violation'] = '0';
				$data['compromise_date'] = '0000-00-00';
				$data['compromise_date_day'] = '00';
				$data['compromise_date_month'] = '00';
				$data['compromise_date_year'] = '0000';
				$data['compromise_comment'] = '';
		}
		
		if (intval($data['insurance']) == 2) {
			$data['reason_not_payment'] = array_sum($data['reason_not_payment_insurance_2']);
		} elseif (intval($data['insurance']) == 3) {
			$data['reason_not_payment'] = array_sum($data['reason_not_payment_insurance_3']);
		}

		$data['documents'] = (is_array($data['document'])) ? implode($this->documentsDelimiter, $data['document']) : '';
    }
	function checkFields($data, $action) {
		global $Log;
	
		parent::checkFields($data, $action);
		
		if ($data['compromise']) {
			if (!intval($data['compromise_violation'])) {
				//$Log->add('error', 'Потрібно вибрати <b>Умови договору, що порушені</b> для компромісного випадку.');
			}
			if ($data['compromise_date'] && !checkdate($data['compromise_date_month'], $data['compromise_date_day'], $data['compromise_date_year'])) {
				$Log->add('error', '<b>Дата прийняття компромісного рішення</b> невірна');
			}
			
			if (checkdate($data['compromise_date_month'], $data['compromise_date_day'], $data['compromise_date_year'])) {
				if (mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year']) > mktime(0, 0, 0, $data['compromise_date_month'], $data['compromise_date_day'], $data['compromise_date_year'])) {
					$Log->add('error', '<b>Дата прийняття компромісного рішення</b> не може бути раніше <b>Дати події</b>.');
				}
			}
			
			if (checkdate($data['compromise_date_month'], $data['compromise_date_day'], $data['compromise_date_year'])) {
				if (mktime(0, 0, 0, date('m'), date('d'), date('Y')) < mktime(0, 0, 0, $data['compromise_date_month'], $data['compromise_date_day'], $data['compromise_date_year'])) {
					$Log->add('error', '<b>Дата прийняття компромісного рішення</b> не може бути більшою за сьогоднішню дату.');
				}
			}
		}
		
		if (in_array(intval($data['insurance']), array(2, 3)) && in_array($data['product_types_id'], array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO))) {
			if (!intval($data['reason_not_payment'])) {
				$Log->add('error', 'Потрібно вибрати <b>Критерії відмови в виплаті</b>.');
			}
		}
	}

    function getProductType() {
		return '0';
	}

    function getLastNumber($product_types_id) {
        global $db;

        $sql = 'SELECT accidents_last_number ' .
               'FROM ' . PREFIX . '_accidents_last_numbers ' .
               'WHERE product_types_id = ' . intval($product_types_id);

        return $db->getOne($sql);
    }

    function setNumber($id, $product_types_id) {
        global $db;

        $last_number = $this->getLastNumber($product_types_id);
        $sql =  'UPDATE ' . PREFIX . '_accidents AS a ' .
            'SET a.number = CONCAT(\''.$this->getProductType().'\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . ') ' .
            'WHERE a.id = ' . intval($id);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
            'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
            'WHERE product_types_id = ' . intval($product_types_id);
        $db->query($sql);
    }

	function updateDocumentTypes($id, $data) {
		global $db;

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_accident_document_type_assignments ' .
				'WHERE accidents_id = ' . intval($id);
		$db->query($sql);

		if (is_array($data['product_document_types'])) {
			foreach ($data['product_document_types'] as $product_document_types_id) {
				$sql =	'INSERT INTO ' . PREFIX . '_accident_document_type_assignments SET ' .
						'accidents_id = ' . intval($id) . ', ' .
						'product_document_types_id = ' . intval($product_document_types_id) . ', ' .
						'created = NOW()';
				$db->query($sql);
			}
		}
	}

    function setAdditionalFields($id, $data) {
		global $db;

		//устанавливаем клиента
/*!!!
		$sql =	'UPDATE ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id SET ' .
				'a.clients_id = b.clients_id ' .
				'WHERE a.id = ' . intval($id);
		$db->query($sql);
*/

		$this->updateDocumentTypes($id, $data);
	}

    function prepareFields($action, &$data) {
    	global $db;

        $data = parent::prepareFields($action, $data);

		$sql =	'SELECT product_document_types_id ' .
				'FROM ' . PREFIX . '_accident_document_type_assignments ' .
				'WHERE accidents_id = ' . intval($data['id']);
		$data['product_document_types']	= $db->getCol($sql);

		$data['document'] = explode($this->documentsDelimiter, $data['documents']);

        return $data;
    }

    function updateStep($id, $step) {
        global $db;

        $sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
                'step = ' . intval($step) . ' ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);
    }

    function updateRepairClassification($data) {
        global $db;

        $sql = 'UPDATE '. PREFIX . '_accidents SET ' .
               'repair_classifications_id = ' . intval($data['repair_classifications_id']) . ', ' .
               'modified = NOW() ' .
               'WHERE id = ' . intval($data['accidents_id']);
        $db->query($sql);
    }
	
	function setCalculationCarServicesIdInWindow($data) {
		global $db;
		
		$sql = 'UPDATE ' . PREFIX . '_accidents SET calculation_car_services_id = ' . intval($data['car_services_id']) . ' WHERE id = ' . intval($data['accidents_id']);
		$db->query($sql);
		
		$result['message'] = "Відповідальне СТО встановлено";
		echo json_encode($result);
		exit;
	}

    function updateModified($id) {
        global $db;

        $sql =  'UPDATE ' . PREFIX . '_accidents SET ' .
                'modified = NOW() ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);
    }

    function loadArchive($data) {
        global $db;

        $this->checkPermissions('archive', $data);

        include_once $this->object . '/archive.php';
    }

    function moveArchive($id, $archive_statuses_id, $accident_statuses_id = null) {
        global $db;

        if ($accident_statuses_id == 17) {
            $accident_statuses_id = ACCIDENT_STATUSES_CLASSIFICATION;
        } elseif ($accident_statuses_id == ACCIDENT_STATUSES_CLASSIFICATION) {
            $accident_statuses_id = 17;
        }

        if ($accident_statuses_id) {
            $sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
					'archive_statuses_id = ' . intval($archive_statuses_id) . ', ' .
					'archive_datetime = IF(archive_datetime = \'0000-00-00\', NOW(), archive_datetime), ' .
                    'accident_statuses_id = ' . $accident_statuses_id . ', ' .
                    'modified = NOW() ' .
					'WHERE id = ' . intval($id);
			$db->query($sql);
        }
    }

    function updateArchive($data) {
        global $db, $Log;

        $this->checkPermissions('archive', $data);

        if (is_array($data['id']) && sizeof($data['id'])) {
            $accident_statuses = array();
            $accidents_confirm = array();
            $accidents_error = array();
            if ($data['archive_statuses_id'] == ACCIDENT_ARCHIVE_STATUSES_NO) {
                $accident_statuses[] = ACCIDENT_STATUSES_CLOSED;
                $accident_statuses[] = ACCIDENT_STATUSES_SUSPENDED;
                $accident_statuses[] = 17;
            }
            if ($data['archive_statuses_id'] == ACCIDENT_ARCHIVE_STATUSES_YES) {
                $accident_statuses[] = ACCIDENT_STATUSES_CLOSED;
                $accident_statuses[] = ACCIDENT_STATUSES_SUSPENDED;
                $accident_statuses[] = ACCIDENT_STATUSES_CLASSIFICATION;
            }
            foreach($data['id'] as $id) {
				if ($this->getProductTypesId($id) == PRODUCT_TYPES_GO && $data['archive_statuses_id'] == ACCIDENT_ARCHIVE_STATUSES_YES && $this->getOwnerTypesId($id) == 1) {
					$accident_statuses[] = ACCIDENT_STATUSES_CLASSIFICATION;
				}
                $statuses_id = $this->getStatusesId($id);
                if (in_array($statuses_id, $accident_statuses)) {
                    $this->moveArchive($id, $data['archive_statuses_id'], $statuses_id);
                    $accidents_confirm[] = $this->getNumber($id);
                } else {
                    $accidents_error[] = $this->getNumber($id);
                }
            }
        }

        if (!sizeof($accidents_confirm)) {
            $Log->add('error', 'Архівний статус не змінено.');
        } elseif (!sizeof($accidents_error)) {
            $Log->add('confirm', 'Архівний статус змінено.');
        } else {
            if (sizeof($accidents_confirm) >= 5 && sizeof($accidents_confirm) <= 20) {
                $confirm = 'справ';
            } elseif (sizeof($accidents_confirm) % 10 == 1) {
                $confirm = 'справа';
            } else {
                $confirm = 'справи';
            }

            if (sizeof($accidents_error) >= 5 && sizeof($accidents_error) <= 20) {
                $error = 'справ';
            } elseif (sizeof($accidents_error) % 10 == 1) {
                $error = 'справа';
            } else {
                $error = 'справи';
            }
            $Log->add('confirm', 'Архівний статус змінено: ' . sizeof($accidents_confirm) . ' ' . $confirm . '.');
            $Log->add('error', 'Архівний статус не змінено ' . sizeof($accidents_error) . ' ' . $error . '. Перелік справ: ' . implode(', ', $accidents_error));
        }

        header('Location: index.php?do=Accidents|show&product_types_id=' . $data['product_types_id']);
        exit;
    }

	/*function moveArchive($id, $archive_statuses_id, $accident_statuses_id = null) {
		global $db;

		if (is_array($id) && sizeOf($id)) {// && ($archive_statuses_id == ACCIDENT_ARCHIVE_STATUSES_NO || in_array($accident_statuses_id, array(ACCIDENT_STATUSES_CLOSED, ACCIDENT_STATUSES_SUSPENDED)))) {
            $accident_statuses = array();
            if ($archive_statuses_id == ACCIDENT_ARCHIVE_STATUSES_YES) {
                $accident_statuses[] = ACCIDENT_STATUSES_RESOLVED;
                $accident_statuses[] = ACCIDENT_STATUSES_CLOSED;
                $accident_statuses[] = ACCIDENT_STATUSES_SUSPENDED;

            }
            if ($archive_statuses_id == ACCIDENT_ARCHIVE_STATUSES_NO) {
                $accident_statuses[] = ACCIDENT_STATUSES_RESOLVED;
                $accident_statuses[] = ACCIDENT_STATUSES_CLOSED;
                $accident_statuses[] = ACCIDENT_STATUSES_SUSPENDED;
            }
			$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
					'archive_statuses_id = ' . intval($archive_statuses_id) . ', ' .
					'archive_datetime = NOW(), ' .
                    'modified = NOW() ' .
					'WHERE accident_statuses_id IN(' . implode(', ', $accident_statuses) . ') AND id IN(' . implode(', ', $id) . ')';
			$db->query($sql);
            return true;
		}else{
            return false;
        }
	}

    function updateArchive($data) {
        global $Log;

        $this->checkPermissions('archive', $data);

		if (is_array($data['id'])) {

			$isMove = $this->moveArchive($data['id'], $data['archive_statuses_id']);

            if($isMove){
                switch ($data['archive_statuses_id']) {
                    case '1':
                        $message = 'Справу(и) було відправлено в архів.';
                        $Log->add('confirm', $message);
                        break;
                    default:
                        $message = 'Справу(и) було повернуто з архіву.';
                        $Log->add('confirm', $message);
                        break;
                }
            }else{
                $message = 'Справу(и) не можна перенести в архів.';
                $Log->add('error', $message);
            }

		}

        header('Location: ' . $data['redirect']);
        exit;
    }*/

	function getStatusesId($id) {
		global $db;

		$sql =	'SELECT accident_statuses_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}

	function getRisksId($id) {
		global $db;

		$sql =	'SELECT risks_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}

	//проверка попадания даты события в действие покрытия по договору
	function isValidPolicyPeriod($id, $date_year, $date_month, $date_day) {
		global $db, $Log;

		$sql =	'SELECT IF(begin_datetime > ' . $db->quote($date_year . '.' . $date_month . '.' . $date_day) . ', 1, 0) + IF(interrupt_datetime < ' . $db->quote($date_year . '.' . $date_month . '.' . $date_day) . ', 2, 0) ' .
				'FROM ' . PREFIX . '_policies ' .
				'WHERE id = ' . intval($id);
		$result = $db->getOne($sql);

		switch ($result) {
			case '0'://все ок
				break;
			case '1':
				$Log->add('error', 'Дата події раніше дати початку дії полісу.');
				break;
			case '2':
				$Log->add('error', 'Дата події пізніше дати закінчення дії полісу.');
				break;
		}

		return ($result == 0) ? true : false;
	}

	function getCreatedManagersId() {
		global $db;

		$conditions[] = 'roles_id = ' . intval(ROLES_MANAGER);
		$conditions[] = 'account_groups_id = ' . ACCOUNT_GROUPS_ACCIDENT_CREATED;

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_accounts AS a ' .
				'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'LIMIT 1';
		return $db->getOne($sql, 30 * 60);
	}

	function getManagersId() {
		global $Authorization;
		return ($Authorization->data['roles_id'] == ROLES_MANAGER) ? $Authorization->data['id'] : Accidents::getCreatedManagersId();;
	}

	//получаем перечень рисков, используется класификации дела
	function getRisks($id) {
		global $db;

		$sql =	'SELECT c.id, c.title, b.risks_id ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policy_risks AS b ON a.policies_id = b.policies_id ' .
				'RIGHT JOIN ' . PREFIX . '_parameters_risks AS c ON b.risks_id = c.id ' .
				'WHERE a.id = ' . intval($id);

		return $db->getAll($sql, 30 * 60);
	}

    function generateDocuments($id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types, $data) {

        if (is_array($product_document_types)) {

            $AccidentDocuments = new AccidentDocuments($data);

            foreach ($product_document_types as $product_document_types_id) {
                $AccidentDocuments->generate($id, 0, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id, $data);
            }
        }
    }

    function removeDocuments($id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types, $data) {
        if (is_array($product_document_types)) {

            $AccidentDocuments = new AccidentDocuments($data);

            foreach ($product_document_types as $product_document_types_id) {
                $AccidentDocuments->remove($id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id, $data);
            }
        }
    }

	function getCarServiceEssentialInWindow($data) {
		global $db;


		$sql =	'SELECT b.* ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_car_services AS b ON a.car_services_id = b.id ' .
				'WHERE a.id = ' . intval($data['id']);
		$row =	$db->getRow($sql);

		echo '{"recipient":"' . addslashes(html_entity_decode($row['title'])) . '","recipient_identification_code":"' . $row['edrpou'] . '","recipient_bank_account":"' . $row['bank_account'] . '","recipient_bank":"' . addslashes(html_entity_decode($row['bank'])) . '","recipient_bank_mfo":"' . $row['bank_mfo'] . '"}';
		exit;
	}

	function getAccidentStatusesId($id) {
		global $db;

		$sql =	'SELECT accident_statuses_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}

	function changeAccidentStatus($id, $accident_statuses_id, $redirect=false, $buh=false) {
        global $db, $Log;
//_dump($this->getAccidentStatusesId($id));
//_dump($accident_statuses_id);exit;
		if ($this->getAccidentStatusesId($id) == $accident_statuses_id && $accident_statuses_id != ACCIDENT_STATUSES_INVESTIGATION) {//исключаем Розгляд так как при нажатии кнопки "Далі" статус дела не изменяется
			$Log->add('error', 'Справа вже знаходиться в статусі в який Ви хочете перевести.');
		} else {
			$subject = '';
            $archive_statuses_id = ACCIDENT_ARCHIVE_STATUSES_NO;
			switch ($accident_statuses_id) {
				case ACCIDENT_STATUSES_APPLICATION:
					$subject = 'Справу переведено в статус "Формування справи"';
				case ACCIDENT_STATUSES_CLASSIFICATION:
				case ACCIDENT_STATUSES_INVESTIGATION:				
					$act_statuses_id = ACCIDENT_STATUSES_INVESTIGATION;
					break;
				case ACCIDENT_STATUSES_REINVESTIGATION:
					$act_statuses_id = ACCIDENT_STATUSES_RESOLVED;
					break;
				case ACCIDENT_STATUSES_COORDINATION:
					$act_statuses_id = ACCIDENT_STATUSES_COORDINATION;
                    $AccidentMessages = new AccidentMessages($data);
                    $AccidentMessages->setStatusByAccidentStatusesId($id, $accident_statuses_id);
					break;
				case ACCIDENT_STATUSES_APPROVAL:
					$act_statuses_id = ACCIDENT_STATUSES_APPROVAL;
                    $AccidentMessages = new AccidentMessages($data);
                    $AccidentMessages->setStatusByAccidentStatusesId($id, $accident_statuses_id);
					break;
				case ACCIDENT_STATUSES_PAYMENT:
					$act_statuses_id = ACCIDENT_STATUSES_PAYMENT;
					break;
                case ACCIDENT_STATUSES_RESOLVED:
					$act_statuses_id = ACCIDENT_STATUSES_RESOLVED;
                    //при "Врегульовано пишем коментарий мониторинга про списание дела в архив
                    $this->insertAccidentsComment(array('accidents_id'=> $id,'buh'=> $buh, 'text' => 'Врегульовано'));
                    break;
                case ACCIDENT_STATUSES_CLOSED:
                    //если статус дела проводят через акт в "Справу закрито", то статус акта оставляем во "врегульовано"
                    $act_statuses_id = ACCIDENT_STATUSES_RESOLVED;
                    //при "Закрито" пишем коментарий мониторинга про списание дела в Архів
                    $this->insertAccidentsComment(array('accidents_id'=> $id, 'text' => 'Архів'));
                    //перенос дела в Архив
                    $archive_statuses_id = ACCIDENT_ARCHIVE_STATUSES_YES;
                    $this->moveArchive($id, ACCIDENT_ARCHIVE_STATUSES_YES, ACCIDENT_STATUSES_CLOSED);
                    $data['accidents_id'] = $id;
                    $data['monitoring_managers_id'] = 6939;
                    $this->updateMonitoring($data);
                    $AccidentMessages = new AccidentMessages($data);
                    $AccidentMessages->setStatusByAccidentStatusesId($id, $accident_statuses_id);
                    break;
                case ACCIDENT_STATUSES_SUSPENDED:
                    $act_statuses_id = ACCIDENT_STATUSES_SUSPENDED;//ACCIDENT_STATUSES_APPROVAL;
                    //при "Призупинено пишем коментарий мониторинга про списание дела в Тимчасовий архів
                    $this->insertAccidentsComment(array('accidents_id'=> $id, 'text' => 'Тимчасовий архів'));
                   //перенос дела в Архив
                    $archive_statuses_id = ACCIDENT_ARCHIVE_STATUSES_YES;
                    $this->moveArchive($id, ACCIDENT_ARCHIVE_STATUSES_YES, ACCIDENT_STATUSES_SUSPENDED);
                    $data['accidents_id'] = $id;
                    $data['monitoring_managers_id'] = 6942;
                    $this->updateMonitoring($data);
                    $AccidentMessages = new AccidentMessages($data);
                    $AccidentMessages->setStatusByAccidentStatusesId($id, $accident_statuses_id);
					break;
			}

			//сбрасываем статус не переданных на выплату страховых актов
			if ((intval($act_statuses_id) /*&& $act_statuses_id != ACCIDENT_STATUSES_RESOLVED*/) || $accident_statuses_id == ACCIDENT_STATUSES_CLOSED) {

                //нельзя редактировать акиты в данных статуст оплаты, кроме случая когда дело Закрывается
                if($accident_statuses_id != ACCIDENT_STATUSES_CLOSED) {
                    $payment_statuses = array(
                        PAYMENT_STATUSES_PARTIAL,
                        PAYMENT_STATUSES_PAYED,
                        PAYMENT_STATUSES_OVER);
                    $conditions[] = 'payment_statuses_id NOT IN(' . implode(', ', $payment_statuses) . ')';
                }

                //Акт не может быть отредактирован в статусе Врегульовано и Оплата
                $conditions_statuses_acts = array(
                    ACCIDENT_STATUSES_SUSPENDED);
                $conditions[] =  'act_statuses_id IN (' . implode(', ', $conditions_statuses_acts) . ')';
                $conditions[]  = 'accidents_id = ' . intval($id);

				$sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
						'act_statuses_id = ' . $act_statuses_id . ', ' .
                        'modified = NOW() ' .
						'WHERE  '. implode(' AND ', $conditions)  ;

				$db->query($sql);
			}

			//сбрасываем статус страхового дела

            if ($this->getAccidentStatusesId($id) != ACCIDENT_STATUSES_REINVESTIGATION || $accident_statuses_id != ACCIDENT_STATUSES_INVESTIGATION){
                $sql = 'UPDATE ' . PREFIX . '_accidents SET ' .
					'accident_statuses_id = ' . $accident_statuses_id . ', ' .
                    'archive_statuses_id = ' . $archive_statuses_id . ', ' .
                    'modified = NOW() ' .
					'WHERE id=' . intval($id);
			    $db->query($sql);
            }

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($id,null,$buh);

			$Log->add('confirm', 'Статус по справі змінено.');
		}

		if ($redirect) {
	        $redirect = ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
    	    header('Location: ' . $redirect);
        	exit;
		}
	}

    function loadSection($data, $showForm=true, $action='updateSection', $actionType='update', $template=null/*'updateSection.php'*/) {

		$this->checkPermissions('updateSection', $data);

		$this->formDescription = $this->sectionFormDescription;

        $data = parent::load($data, false, 'updateSection');

        return parent::load($data, $showForm, $action, $actionType, $template);
    }

    function updateSection($data) {
		global $db, $Log, $Authorization;

		$this->checkPermissions('updateSection', $data);

        $this->formDescription = $this->sectionFormDescription;
		
		$accident_sections_id = $this->getSectionsId($data['id']);
		$accident_sections_title = $this->getSectionsTitle($accident_sections_id);
		$data['accident_sections_title'] = $this->getSectionsTitle($data['accident_sections_id']);

        if ($_POST['do'] == $this->object . '|updateSection') {

            //if (Form::update($data, false, false)) {
			
				$sql = 'UPDATE ' . PREFIX . '_accidents SET accident_sections_id = ' . intval($data['accident_sections_id']) . ' WHERE id = ' . intval($data['id']);
				$db->query($sql);

				$AccidentStatusChanges = new AccidentStatusChanges($data);
				$AccidentStatusChanges->set($data['id'], ACCIDENT_STATUSES_CHANGE_SECTION);

				$params['title']    = $this->messages['single'];
				$params['id']       = $data['accidents_id'];
				$params['storage']  = PREFIX . '_accidents';

                $this->send($data['id'], 'Accident. updateSection');

				$Log->add('confirm', 'По страховій справі було змінено категорію.', $params);
				
				if ($accident_sections_id != $data['accident_sections_id']) {
					$this->insertAccidentsComment(array(
														'accidents_id'=> $data['id'], 
														'monitoring_comment' => 'Категорію змінено з <b> ' . $accident_sections_title .  '</b> на <b>' . $data['accident_sections_title'] . '</b>. <b>Коментар: </b>' . $data['update_section_comment']
					));
				}

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
				exit;
            //}

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
            $data = parent::load($data, false, 'updateSection');
        }

		return $this->showForm($data, 'updateSection', 'update', null);
    }

    function updateRegres($data) {
		global $db, $Log, $Authorization;

		if (is_array($data['id'])) {
			$data['id'] = $data['id'][0];
		}

		$this->checkPermissions('updateRegres', $data);

		$sql = 'UPDATE ' . PREFIX . '_accidents SET regres = IF(regres > 0, 0, 1) WHERE id = ' . intval($data['id']);
		$db->query($sql);

		$params['title']    = $this->messages['single'];
		$params['id']       = $data['accidents_id'];
		$params['storage']  = PREFIX . '_accidents';

		$Log->add('confirm', 'Ознака регрес змінена', $params);
		
		header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
		exit;
    }

	function getSectionsId($id) {
		global $db;
		
		$sql = 'SELECT accident_sections_id ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getSectionsTitle($accident_sections_id) {
		global $db;
		
		$sql = 'SELECT title ' . 
			   'FROM ' . PREFIX . '_accident_sections ' .
			   'WHERE id = ' . intval($accident_sections_id);
		return $db->getOne($sql);
	}

	function reset($data) {
        global $db, $Log;

		$this->checkPermissions('reset', $data, $redirect);

		if (is_array($data['id'])) {
			$data['id'] = $data['id'][0];
		}

		$this->changeAccidentStatus($data['id'], ACCIDENT_STATUSES_RESET, true);
	}

	function backToRisk($data) {

		$this->checkPermissions('backToRisk', $data, $redirect);

		$this->changeAccidentStatus($data['id'], ACCIDENT_STATUSES_REINVESTIGATION, true);
	}
    function closeAccident($data) {
		global $db;

        if (!$data['permission']) $this->checkPermissions('closeAccident', $data, $redirect);
		
		if (!AccidentPayments::checkNumberPaymentOrder($data, 1)) {
			$redirect = ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
    	    header('Location: ' . $redirect);
        	exit;
		}		
		
		$this->changeAccidentStatus($data['id'], ACCIDENT_STATUSES_CLOSED, true);
	}

	function getRecipients($id) {
		global $db;

		$sql =	'SELECT car_services_id, masters_id, average_managers_id, estimate_managers_id ' .//managers_id, 
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
        return $db->getRow($sql, 30 * 60);
	}

	function setManagers($id) {
		global $db, $Authorization;

		$sql =	'SELECT average_managers_id, estimate_managers_id ' .//managers_id, 
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
		$row =	$db->getRow($sql);

		$this->managers = array(1, $row['managers_id'], 'average_managers_id' => $row['average_managers_id'], $row['estimate_managers_id']);

		$conditions[] = 'a.active = 1';
		$conditions[] = 'object LIKE ' . $db->quote('Accidents%');
		$conditions[] = 'method IN(' . $db->quote('updateActsAll') . ', ' . $db->quote('updateEstimatesAll') . ', ' . $db->quote('updateRiskAll') . ')';

		$sql =	'SELECT DISTINCT a.id ' .
				'FROM ' . PREFIX . '_accounts AS a ' .
				'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id ' .
				'JOIN ' . PREFIX . '_account_group_permissions AS c ON b.account_groups_id = c.account_groups_id ' .
				'JOIN ' . PREFIX . '_account_permissions AS d ON c.account_permissions_id = d.id ' .
				'WHERE ' .  implode(' AND ', $conditions);
		$this->managers = array_merge($this->managers, $db->getCol($sql), $Authorization->data['managers']);
	}

	function getInsuranceTitle($insurance) {
		switch ($insurance) {
			case '1':
				return 'страховий, з виплатою';
				break;
			case '2':
				return 'страховий, без виплати';
				break;
			case '3':
				return 'не страховий';
				break;
			default:
				return '&nbsp;';
				break;
		}
	}

	function getAverageManagersId($id) {
		global $db;

		$sql =	'SELECT average_managers_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql, 30 * 60);
	}

    function getEstimateManagersId($id) {
		global $db;

		$sql =	'SELECT estimate_managers_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql, 30 * 60);
	}

	function setPaymentStatus($accidents_id) {
		global $db;

		$sql =	'SELECT b.id, MAX(a.date) AS date, SUM(IF(a.is_return = 0, a.amount, 0)) AS amount, b.acts_id, b.payment_types_id, b.number, b.payment_statuses_id, c.act_type, b.recipient_types_id, b.recipients_id ' .
				'FROM ' . PREFIX . '_accident_payments_calendar AS b ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments AS a ON a.payments_calendar_id = b.id ' .
				//'FROM ' . PREFIX . '_accident_payments AS a ' .
				//'LEFT JOIN ' . PREFIX . '_accident_payments_calendar AS b ON a.payments_calendar_id = b.id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_acts AS c ON b.acts_id = c.id ' .
				'WHERE b.accidents_id = ' . intval($accidents_id) . ' ' .
				'GROUP BY a.payments_calendar_id, b.acts_id';
		$list = $db->getAll($sql);
//_dump($list);
		$aktsAmount = array();

		if (is_array($list) && sizeof($list)) {
			//проставляем статусы по календарю
			foreach($list as $row) {
				$sql =	'SELECT amount ' .
						'FROM ' . PREFIX . '_accident_payments_calendar ' .
						'WHERE id = ' . intval($row['id']);
				$amount = doubleval($db->getOne($sql));
//_dump($amount);
				$aktsAmount[$row['acts_id']] += $row['amount']; //факт по каждому акту

				if ((string)$amount == (string)$row['amount']) {
					$status = PAYMENT_STATUSES_PAYED;

                    if (in_array($row['payment_types_id'], array(PAYMENT_TYPES_COMPENSATION, PAYMENT_TYPES_PART_PREMIUM)) && $row['payment_statuses_id'] == PAYMENT_STATUSES_NOT && $row['act_type'] != ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL) {
						//AccidentMessages::generateAdditionalAgreement($accidents_id);
                        $tasks_id = Tasks::generateTask(TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION, intval($row['id']), date('Y-m-d', strtotime(date('Y-m-d'))));
						
						if ($row['payment_types_id'] == PAYMENT_TYPES_COMPENSATION && $row['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE) {
//							RecoveryRepairs::checkAndGenerate($row['id'], $row['recipients_id']);
						}
						
						$sql = 'SELECT  policies.id as policies_id, policies_kasko.terms_years_id, accidents.id as accidents_id,  policies_kasko.options_agregate_no AS policies_options_agregate_no, date_format(accidents.datetime, \'%d.%m.%Y\') as datetime, ' .
								'IF(policies_kasko.terms_years_id = 1, kasko_items.car_price + kasko_items.price_equipment, years_payments.item_price) AS policies_price,  ' .
								'IF(policies_kasko.terms_years_id = 1, date_format(policies.interrupt_datetime, \'%d.%m.%Y\'),  date_format(MAX(years_payments.date) + INTERVAL 1 YEAR - INTERVAL 1 DAY, \'%d.%m.%Y\')) as interrupt_datetime, ' .
								'date_format(years_payments.date, \'%d.%m.%Y\') as payment_date, isAccidentsTotal(' . $accidents_id . ') as is_total, SUM(accidents_acts.amount) as accidents_amount ' .
								'FROM ' . PREFIX . '_accidents as accidents ' .
								'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
								'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
								'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents.policies_id = kasko_items.policies_id ' .
								'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
								'JOIN ' . PREFIX . '_accidents_acts AS accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
								'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON policies.id = years_payments.policies_id AND accidents_kasko.items_id = years_payments.items_id AND accidents.datetime between years_payments.date AND (years_payments.date + INTERVAL 1 YEAR) ' .
								'WHERE accidents.id = ' . intval($accidents_id) .
								' GROUP BY policies.id ' .
								'ORDER BY  years_payments.date desc';
						$list = $db->getRow($sql);
						$previous_begin_date = AccidentMessages::getLastBeginDatePayedRecoveryInsuredSum($accidents_id);
						$end_data = $list['interrupt_datetime'];
						if(strtotime($list['payment_date']) < strtotime($previous_begin_date)){
							$amount_previous_acts = AccidentMessages::getSumActs($accidents_id, $previous_begin_date, $end_data);
						}else{
							$Accidents = Accidents::factory($data, 'KASKO');
							$amount_previous_acts = $Accidents->getAmountPrevious($accidents_id, 1) + $list['accidents_amount'];
						}
						switch(intval($list['terms_years_id'])){
							case '1':
								$in_period = true;
								break;
							default:
								$in_period = strtotime($list['datetime']) >= strtotime($list['payment_date']) &&
											 strtotime($end_data) >= strtotime(date('d.m.Y'))  && strtotime(date('d.m.Y')) <= strtotime($end_data);
								break;
						}
						$losing = ($list['policies_options_agregate_no'] == 1) ? $list['policies_price']/$list['policies_price'] : ($list['policies_price'] - $amount_previous_acts)/$list['policies_price'];
						
                        if ($tasks_id > 0 && $losing <= 0.95 && strtotime(date('d.m.Y')) <= strtotime($end_data)-(45*(24*60*60)) && $in_period && $list['is_total'] == 0) {
                            Tasks::generateTask(TASK_TYPES_POLICIES_RENEW_AMOUNT, intval($row['id']), date('Y-m-d', strtotime(date('Y-m-d'))));
                        }
                    }
				} elseif ($row['amount'] <= 0) {
					$status = PAYMENT_STATUSES_NOT;
					$row['date'] = '0000-00-00'; 
				} elseif ($amount > $row['amount']) {
					$status = PAYMENT_STATUSES_PARTIAL;
				} else {
					$status = PAYMENT_STATUSES_OVER;
				}

				$sql =	'UPDATE ' . PREFIX . '_accident_payments_calendar SET ' .
						'payment_statuses_id = ' . intval($status) . ', ' .
						'payment_date = ' . $db->quote($row['date']) . ', ' .
                        'modified = NOW() ' .
						'WHERE id = ' . intval($row['id']);
				$db->query($sql);

                if(in_array($row['payment_types_id'], array(PAYMENT_TYPES_COMPENSATION, PAYMENT_TYPES_PART_PREMIUM)) && $row['payment_statuses_id'] == PAYMENT_STATUSES_NOT && $row['act_type'] != ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL){
                    //AccidentMessages::generateAdditionalAgreement($accidents_id);
                }
			}//exit;
		} else {
            $sql =	'UPDATE ' . PREFIX . '_accident_payments_calendar SET ' .
                    'payment_statuses_id = ' . PAYMENT_STATUSES_NOT . ', ' .
                    'payment_date = \'0000-00-00\', ' .
                    'modified = NOW() ' .
                    'WHERE accidents_id = ' . intval($accidents_id);
            $db->query($sql);
        }

		//ставим оплату в разрезе актов в деле
		$sql =	'SELECT id, SUM(amount) AS amount ' .
				'FROM ' . PREFIX . '_accidents_acts ' .
				'WHERE accidents_id = ' . intval($accidents_id) . ' AND act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ',' . ACCIDENT_STATUSES_RESOLVED . ')' .
				'GROUP BY id';
		$list = $db->getAll($sql);

		if (is_array($list)) {
			foreach($list as $row) {
				$amount = doubleval($aktsAmount[$row['id']]); //то что зашло по факту в акт

				if ($amount<=0) {
					$status = PAYMENT_STATUSES_NOT;
				} else {
					if ((string)$amount == (string)$row['amount']) {
						$status = PAYMENT_STATUSES_PAYED;
					} elseif ($amount < $row['amount']) {
						$status = PAYMENT_STATUSES_PARTIAL;
					} else {
						$status = PAYMENT_STATUSES_OVER;
					}
				}

				$sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
						'payment_statuses_id = ' . intval($status) . ', ' .
                        'modified = NOW() ' .
						'WHERE id = ' . intval($row['id']);
				$db->query($sql);

				if ($status == PAYMENT_STATUSES_PAYED || $status == PAYMENT_STATUSES_OVER) {
					$sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
							'act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ', ' .
							'modified = NOW() ' .
							'WHERE id = ' . intval($row['id']);
					$db->query($sql);
				}
			}
		}

		//проставить статус по делу в целом
        $conditions[] = 'calendar.accidents_id = ' . intval($accidents_id);
        $conditions[] = 'calendar.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION . ',' . PAYMENT_TYPES_PART_PREMIUM .')';

		$sql =	'SELECT MIN(calendar.payment_statuses_id) AS min_statuses, MAX(calendar.payment_statuses_id) AS max_statuses ' .
				'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				'JOIN ' . PREFIX . '_accident_payments as payments ON calendar.id = payments.payments_calendar_id AND payments.is_return = 0 ' .
				'WHERE '. implode(' AND ', $conditions);
		$statuses = $db->getRow($sql);

		$status = intval($statuses['min_statuses']);
		if ($status == 0) $status = PAYMENT_STATUSES_NOT;
		if ($status == PAYMENT_STATUSES_PAYED && $statuses['max_statuses']==PAYMENT_STATUSES_OVER) $status = PAYMENT_STATUSES_OVER;

		$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
				'payment_statuses_id = ' . intval($status) . ', ' .
                'modified = NOW() ' .
				'WHERE id = ' . intval($accidents_id);
		$db->query($sql);

		$Accidents = new Accidents($data);

        $sql = 'SELECT SUM(act_statuses_id)/count(id) as degree ' .
               'FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE accidents_id = ' . intval($accidents_id);
        $degree = $db->getOne($sql);

		if (($status == PAYMENT_STATUSES_PAYED || $status == PAYMENT_STATUSES_OVER) &&  in_array($Accidents->getAccidentStatusesId($accidents_id), array(ACCIDENT_STATUSES_PAYMENT)) && intval($degree) == ACCIDENT_STATUSES_RESOLVED) {
			$Accidents->changeAccidentStatus(intval($accidents_id), ACCIDENT_STATUSES_RESOLVED, false, true);
		}

		$sql = 'UPDATE ' . PREFIX . '_accidents SET resolved_date = getResolvedDate(' . intval($accidents_id) . ', 0) WHERE id = ' . intval($accidents_id);
		$db->query($sql);

		$sql =  'SELECT a.id, a.amount, a.act_type ' .
                'FROM insurance_accidents_acts as a ' .
                'JOIN insurance_accident_payments_calendar as b ON a.id = b.acts_id ' .
                'WHERE a.payment_statuses_id > 1 AND a.accidents_id = ' . intval($accidents_id) . ' ' .
                'ORDER BY a.id DESC';
		$acts_list = $db->getAll($sql);

		$prev_act_type = 0;
		foreach ($acts_list as $act) {
			if ($prev_act_type == 2 || $prev_act_type == 3 || $prev_act_type == 4) {
				$sql = 'UPDATE insurance_accident_payments_calendar SET is_return = 1 WHERE acts_id = ' . intval($act['id']);
				$db->query($sql);
			}
			$prev_act_type = $act['act_type'];
		}
	}

    function getListCommentsInWindow($data) {
        global $Authorization, $db;


        $sql = 'SELECT * FROM ' . PREFIX . '_accident_comments ' .
               'WHERE accidents_id = ' .intval($data['accidents_id']) . ' ' .
               'ORDER BY id desc';

        $comment_list = $db->getAll($sql);
        $result = '<table width="50%">';

        foreach($comment_list as $comment){
            if($comment['monitoring_managers_yes'] == 0) {
                 $result .= '<tr><td><b style="color:#2B587A;">'.$comment['authors_title'].'</b> ' . ($this->permissions['deleteComments'] ? '<a href="javascript: deleteComment(' . $comment['id'] . ')"><image src="/images/administration/navigation/delete_over.gif" /></a>' : '') . '</td></tr>' .
                 '<tr><td><label style="color:#777777; width=\'200px;\'">'.date('d.m.Y',strtotime($comment['created'])).' в '.date('H:i:s',strtotime($comment['created'])).'</label></td></tr>'.
                 '<tr><td><label><i>'.$comment['text'].'</i></label></td></tr>';
            }
            else{
                $result .= '<tr><td><b style="color:#2B587A;">'.$comment['authors_title'].'</b> ' . ($this->permissions['deleteComments'] ? '<a href="javascript: deleteComment(' . $comment['id'] . ')"><image src="/images/administration/navigation/delete_over.gif" /></a>' : '') . '</td></tr>' .
                        '<tr><td><label style="color:#777777; width=\'200px;\'">'.date('d.m.Y',strtotime($comment['created'])).' в '.date('H:i:s',strtotime($comment['created'])).'</label></td></tr>' .
                        '<tr><td><h3><b>На даний момент справа перебуває у: <label style="color:red;">' . $comment['text'] . '</label></b></h3></td></tr>';
            }
        }
        $result .= '</table>';

        echo $result;
        exit;
    }

    function insertAccidentsComment($data) {
        global $Authorization, $db;

        $monitoring_managers_yes = 1;

        //установка пользователя Бухгалтерия
        if ($data['buh']) {//пользователь бухгалтерия
			$authors_title = 'Бухгалтерія';
			$authors_id = ACCOUNT_BUH;
		} elseif ($data['ei']) {
            $authors_title = 'Експрес Страхування';
			$authors_id = ACCOUNT_EI;
        } else {
            $authors_title = $Authorization->data['lastname'] .' '. $Authorization->data['firstname'];
            $authors_id = intval($Authorization->data['id']);
        }

        if($data['monitoring_comment'] && !$data['monitoring_managers_id']) {
            $monitoring_managers_yes = 0;
            $text = $data['monitoring_comment'];
        } elseif(!$data['buh'] && !$data['text']) {
			$sql = 'SELECT CONCAT(lastname,\' \',firstname) as fio ' .
					'FROM ' . PREFIX . '_accounts ' .
					'WHERE id = ' . $data['monitoring_managers_id'];
			$text = $db->getOne($sql);
        } elseif($data['text']) {
			$text = $data['text'];
        }

        $sql = 'INSERT INTO ' . PREFIX . '_accident_comments SET ' .
				'accidents_id               = ' . intval($data['accidents_id']) . ', ' .
				'authors_id                 = ' . $db->quote($authors_id) . ', ' .
				'authors_title              = ' . $db->quote($authors_title) . ', ' .
				'text                       = ' . $db->quote($text) . ', ' .
				'monitoring_managers_yes    = ' . intval($monitoring_managers_yes) . ', ' .
				'created                    = NOW()';
         $db->query($sql);

        //устанавливаем пользователя у которого дело в таблице дел
        if($data['setAccidentsMonitor']){
            $this->updateMonitoring($data);
        }
    }

    function insertAccidentsCommentInWindow($data) {
        $this->insertAccidentsComment($data);
    }

    function setAccidentClosedComment($data) {
        global $db;

        $sql = 'UPDATE ' . PREFIX . '_accidents ' .
               'SET comment_closed = ' . $db->quote($data['comment_closed']) . ' ' .
               'WHERE id = ' . intval($data['accidents_id']);
        $db->query($sql);

        echo $data['comment_closed'];
    }

    function setAccidentClosedCommentInWindow($data) {
        $this->setAccidentClosedComment($data);
    }

    function getAccidentClosedCommentInWindow($data) {
        global $db;

        $sql = 'SELECT comment_closed ' .
               'FROM ' . PREFIX . '_accidents ' .
               'WHERE id = ' . intval($data['accidents_id']);
        echo $db->getOne($sql);
    }

    function deleteAccidentsComment($data) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_accident_comments ' .
                'WHERE id = ' . intval($data['id']);
        $db->query($sql);
    }

    function deleteAccidentsCommentInWindow($data) {
        $this->deleteAccidentsComment($data);
    }

    function updateMonitoring($data) {
        global $db,$Authorization;

        if($data['accidents_id']) {
            $sql = 'UPDATE '.PREFIX.'_accidents SET ' .
                   'monitoring_managers_id =' . $data['monitoring_managers_id'] . ' ' .
                   'WHERE id=' . $data['accidents_id'];
            $db->query($sql);
        }
    }

    function updateMonitoringInWindow($data) {
        $this->updateMonitoring($data);
    }

    function send($id, $template, $params=null) {
        global $db, $Templates;

		if ($this->getProductTypesId($id) == PRODUCT_TYPES_KASKO) {
			$sql =  'SELECT a.id as accidents_id, a.amount_rough , a.number as number, a.product_types_id, date_format(a.datetime, \'%d.%m.%Y\') as accidents_date, c.number as policies_number, date_format(c.date, \'%d.%m.%Y\') as policies_date, ' .
					'CONCAT_WS(\' \', d.brand, d.model) as item, d.year, d.sign, d.shassi, b.id as act_id, b.number as act_number, g.title as risks_title, e.title as title, ' .
					'IF(h.insurer_person_types_id = 1, CONCAT_WS(\' \', h.insurer_lastname, h.insurer_firstname, h.insurer_patronymicname), h.insurer_company) as insurer ' .
					'FROM ' . PREFIX . '_accidents AS a ' .
					'JOIN ' . PREFIX . '_accidents_kasko as f ON a.id = f.accidents_id ' .
					'LEFT JOIN ' . PREFIX . '_accidents_acts AS b ON a.id = b.accidents_id ' .
					'LEFT JOIN ' . PREFIX . '_accident_sections AS e ON a.accident_sections_id = e.id ' .
					'JOIN ' . PREFIX . '_policies as c ON a.policies_id = c.id ' .
					'JOIN ' . PREFIX . '_policies_kasko as h ON c.id = h.policies_id ' .
					'JOIN ' . PREFIX . '_policies_kasko_items as d ON f.items_id = d.id ' .
					'JOIN ' . PREFIX . '_parameters_risks as g ON a.application_risks_id = g.id ' .
					'WHERE a.id = ' . intval($id);
			$row = $db->getRow($sql);
			$data['id'] = $id;
			$row['insurance_price'] = $this->getInsurancePrice($data);
		} else {
			$sql =  'SELECT a.id as accidents_id, a.amount_rough , a.number as number, a.product_types_id, date_format(a.datetime, \'%d.%m.%Y\') as accidents_date, c.number as policies_number, date_format(c.date, \'%d.%m.%Y\'), ' .
					'b.id as act_id, b.number as act_number, ' .
					'e.title as title ' .
					'FROM ' . PREFIX . '_accidents AS a ' .
					'LEFT JOIN ' . PREFIX . '_accidents_acts AS b ON a.id = b.accidents_id ' .
					'LEFT JOIN ' . PREFIX . '_accident_sections AS e ON a.accident_sections_id = e.id ' .
					'JOIN ' . PREFIX . '_policies as c ON a.policies_id = c.id ' .
					'WHERE a.id = ' . intval($id);
			$row = $db->getRow($sql);
		}

		if (is_array($params) && sizeof($params)) {
			$row = array_merge($row, $params);
		}

        foreach($this->getMailRecipients($id,$template) as $email) {
		    $Templates->send($email, $row, $template);
        }

    }

    function getMailRecipients($id, $template) {
        global $db;

        switch ($template) {
            case 'Accident. updateClassification':
                return array(
                    //'a.nimchenko@express-group.com.ua',
                    //'v.kochukova@express-group.com.ua',
					'y.belik@express-group.com.ua',
                    //'o.arzyaeva@express-group.com.ua',
					'o.nikonova@express-group.com.ua',
					'i.kuznetsova@express-group.com.ua',
					'm.marchuk@express-group.com.ua'
                    /*'d.mironenko@express-group.com.ua'*/);
                break;
			case 'Accident. changeAmountRough':
				return array(
					'o.gorobets@express-group.com.ua',
                    'v.kochukova@express-group.com.ua',                    
                    'v.ahramovich@express-group.com.ua',
					's.shestopal@express-group.com.ua');
				break;
            case 'Accident. createdAct':
                $conditions[] = 'b.account_groups_id = ' . ACCOUNT_GROUPS_RECEPTIONIST;//только отедел учета и регистрации
                $conditions[] = 'a.active = 1';

                $sql = 'SELECT DISTINCT a.email ' .
                       'FROM ' . PREFIX . '_accounts as a ' .
                       'JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id ' .
                       'WHERE ' . implode(' AND ', $conditions);
                return $db->getCol($sql);
                break;
            case 'Accident. moveArchive':
                $conditions[] = 'a.active = 1';
                $conditions[] = 'a.id = ' . $id;
                $sql = 'SELECT b.email ' .
                       'FROM ' . PREFIX . '_accidents as a ' .
                       'LEFT JOIN ' . PREFIX . '_accounts as b ON a.average_managers_id = b.id ' .
                       'WHERE ' . implode(' AND ', $conditions);
                return $db->getCol($sql);
                break;
            case 'Accident. updateSection':
                return array(
                    //'v.kochukova@express-group.com.ua',
                    /*'ybitki@gmail.com'*/);
                break;
			case 'AccidentsGO.CreateVictim':
				return array(
                    'l.mironenko@euassist.com.ua',
                    'n.kravec@euassist.com.ua',
					'v.kochukova@euassist.com.ua',
					'y.bazichev@euassist.com.ua',
					'm.marchuk@express-group.com.ua');
				break;
        }
    }

    function dates_validate($date, $msg) {
        global $Log;

        if(intval($date) < ACCIDENT_APPLICATION_YEAR_LIMIT) {
             $Log->add('error', $msg);
        }
        return;
    }

    function getAssignUsersSelect($data) {
		global $db, $Authorization;

        /*$Users = new Users($data);
        $monitoring_users = $Users->getListByGroup(array(ACCOUNT_GROUPS_MONITORING), array(6939, 6941, 6942));*/
		
		$sql = 'SELECT a.id, a.lastname, a.firstname FROM ' . PREFIX . '_accounts as a ' .
               'LEFT JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id ' .
			   'LEFT JOIN ' . PREFIX . '_account_group_permissions as c ON b.account_groups_id = c.account_groups_id ' .
               'WHERE (a.active = 1 AND c.account_permissions_id = 638) OR  a.id IN (6939, 6941, 6942) ' .
               'GROUP BY a.email ORDER BY a.lastname';
		$monitoring_users = $db->getAll($sql);
		
		//$in_express = $this->getStateInExpress($data['id']);

        $select  = '<select name="monitoring_managers_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">
                    <option value="">...</option>';

        foreach($monitoring_users as $value){
			//if ($Authorization->data['roles_id'] == ROLES_MANAGER && ($in_express == 1 && $value['express'] != 1 || $in_express == 0 && $value['express'] != 0)) continue;
			
            $select .= ($value['id'] == $data['monitoring_managers_id'])
				? '<option value="' . $value['id'] . '" selected="selected">' . $value['lastname'] . ' ' . $value['firstname'] . '</option>'
				: '<option value="' . $value['id'] . '">' . $value['lastname'] . ' ' . $value['firstname'] . '</option>';
        }

        $select .= '</select>';

        return $select;
    }

    //реквизиты ТДВ "Експрес Страхування", используется при создании/редактировании страхового акта
    function getEssentialExpressInWindow($data) {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_car_services AS a ' .
                'JOIN ' . PREFIX . '_car_services_banking_details AS b ON a.id = b.car_services_id ' .
				'WHERE a.id = 1';
		$row =	$db->getRow($sql);

        echo '{"recipient_types_id":"' . RECIPIENT_TYPES_INSURED . '","recipient":"' . addslashes(html_entity_decode($row['title'])) .'","recipient_identification_code":"' . $row['edrpou'] . '","bank":"' . $row['bank'] . '","bank_edrpou":"' . $row['bank_edrpou'] . '","bank_mfo":"' . $row['bank_mfo'] . '","bank_account":"' . $row['bank_account'] . '"}';

		exit;
	}

    //реквизиты страхователя, используется при создании/редактировании страхового акта
	function getEssentialInsurerInWindow($data) {
		global $db;

        switch ($this->product_types_id){
            case PRODUCT_TYPES_GO:
                $sql =	'SELECT b.*, b.person_types_id AS insurer_person_types_id ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies_go AS b ON a.policies_id = b.policies_id ' .
				'WHERE a.id = ' . intval($data['id']);
                break;
            case PRODUCT_TYPES_KASKO:
				$sql =	'SELECT b.* ' .
						'FROM ' . PREFIX . '_accidents AS a ' .
						'JOIN ' . PREFIX . '_policies_kasko AS b ON a.policies_id = b.policies_id ' .
						'WHERE a.id = ' . intval($data['id']);
                break;
			case  PRODUCT_TYPES_CARGO_CERTIFICATE:
				$sql =	'SELECT b.*,2 as insurer_person_types_id ' .
						'FROM ' . PREFIX . '_accidents AS a ' .
						'JOIN ' . PREFIX . '_policies_cargo AS b ON a.policies_id = b.policies_id ' .
						'WHERE a.id = ' . intval($data['id']);
                break;				
        }

		$row =	$db->getRow($sql, 60 * 60);
        switch ($row['insurer_person_types_id']) {
            case 1://физ. лицо
                echo '{"recipient_types_id":"' . RECIPIENT_TYPES_INSURER . '","recipient":"' . addslashes(html_entity_decode($row['insurer_lastname']  . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname'])) . '","recipient_identification_code":"' . $row['insurer_identification_code'] . '","bank":"","bank_edrpou":"","bank_mfo":"","bank_account":""}';
                break;
            case 2://юр. лицо
                echo '{"recipient_types_id":"' . RECIPIENT_TYPES_INSURER . '","recipient":"' . addslashes(html_entity_decode($row['insurer_company'])) . '","recipient_identification_code":"' . $row['insurer_edrpou'] . '","bank":"' . addslashes(html_entity_decode($row['insurer_bank'])) . '","bank_edrpou":"","bank_mfo":"' . $row['insurer_bank_mfo'] . '","bank_account":"' . $row['insurer_bank_account'] . '"}';
                break;
        }
        exit;
	}

    function setDateField($fieldname, &$data) {
    	$data[$fieldname.'_year']		= substr($data[$fieldname], 0, 4);
    	$data[$fieldname.'_month']		= substr($data[$fieldname], 5, 2);
    	$data[$fieldname.'_day']		= substr($data[$fieldname], 8, 2);
    }

    function setDateTimeField($fieldname,&$data) {
    	$data[$fieldname.'_year']		= substr($data[$fieldname], 0, 4);
    	$data[$fieldname.'_month']		= substr($data[$fieldname], 5, 2);
    	$data[$fieldname.'_day']		= substr($data[$fieldname], 8, 2);
		$data[$fieldname . '_hour']		= substr($data[$fieldname], 11, 2);
		$data[$fieldname . '_minute']	= substr($data[$fieldname], 14, 2);
    }

	function setCheckedInWindow($data) {
        global $db, $Authorization;
		if($this->permissions['change']) {
			$sql =  'UPDATE ' . PREFIX . '_accidents SET ' .
						   $data['name'] . ' = ' . intval($data['value']) . ' ' .
						   'WHERE id = ' . intval($data['id']);
			switch ($data['name']) {
				case 'master_documents':
					$result = array('confirm', 'Наявність оригиналів документів '.(intval($data['value']) ? 'встановлено' : 'знято'));
					break;
				case 'avr_sign':
					$result = array('confirm', 'Справу '.(intval($data['value']) ? 'включено до ' : 'виключено з ') . 'АВР');
					break;
			}

			$db->query($sql);
		}
		else
		{
			$result = array('error', 'Вiдсутнi права на встановлення оригиналів документів.');
		}

        echo '{"type": "' . $result[ 0 ] . '", "text": "' . $result[ 1 ] . '"}';
    }

    function loadChangeResponsible($data){
        global $db;

        //$this->checkPermissions('archive', $data);

        $sql = 'SELECT accounts.id, CONCAT_WS(\' \', accounts.lastname, accounts.firstname) as name ' .
               'FROM ' . PREFIX . '_accounts as accounts ' .
               'JOIN ' . PREFIX . '_account_groups_managers_assignments as account_groups_managers ON accounts.id = account_groups_managers.accounts_id ' .
               'WHERE accounts.active = 1 AND account_groups_managers.account_groups_id IN(' . ACCOUNT_GROUPS_AVERAGE . ', ' . ACCOUNT_GROUPS_AVERAGE_HEAD . ') ' .
               'GROUP BY accounts.id ' .
               'ORDER BY accounts.lastname, accounts.firstname';
        $average_managers = $db->getAll($sql);

        $sql = 'SELECT accounts.id, CONCAT_WS(\' \', accounts.lastname, accounts.firstname) as name ' .
               'FROM ' . PREFIX . '_accounts as accounts ' .
               'JOIN ' . PREFIX . '_account_groups_managers_assignments as account_groups_managers ON accounts.id = account_groups_managers.accounts_id ' .
               'WHERE accounts.active = 1 AND account_groups_managers.account_groups_id IN(' . ACCOUNT_GROUPS_ESTIMATE . ', ' . ACCOUNT_GROUPS_ESTIMATE_HEAD . ') ' .
               'GROUP BY accounts.id ' .
               'ORDER BY accounts.lastname, accounts.firstname';
        $estimate_managers = $db->getAll($sql);

        include_once $this->object . '/changeResponsible.php';
    }

    function changeResponsible($data){
        global $db, $Log;

        switch ($data['responsible_type']) {
            case 1:
                $manager_type = 'average_managers_id';
                $manager_id = $data['responsible_average_list'];
                $info_title = 'аварійного комісара';
                break;
            case 2:
                $manager_type = 'estimate_managers_id';
                $manager_id = $data['responsible_estimate_list'];
                $info_title = 'експерта';
                break;
        }

        if ($manager_type) {
            $sql = 'SELECT ' . $manager_type . ' ' .
                   'FROM ' . PREFIX . '_accidents ' .
                   'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $managers_id_old = $db->getCol($sql);

            $sql = 'UPDATE ' . PREFIX . '_accidents ' .
                   'SET ' . $manager_type . ' = ' . intval($manager_id) . ' ' .
                   'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $db->query($sql);

            if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
                $sql = 'SELECT parent_application_id ' .
                       'FROM ' . PREFIX . '_accidents_go ' .
                       'WHERE accidents_id IN(' . implode(', ', $data['id']) . ') AND parent_application_id > 0';
                $parent_application_id = $db->getCol($sql);

                $sql = 'UPDATE ' . PREFIX . '_accidents ' .
                       'SET ' . $manager_type . ' = ' . intval($manager_id) . ' ' .
                       'WHERE id IN(' . (sizeof($parent_application_id) ? implode(', ', $parent_application_id) : '0') . ')';
                $db->query($sql);
            }

            $sql = 'UPDATE ' . PREFIX . '_accident_messages ' .
                   'SET recipients_id = ' . intval($manager_id) . ', ' .
                        'recipient = ' . $db->quote($data['responsible_name']) . ' ' .
                   'WHERE recipients_id IN(' . implode(', ', $managers_id_old) . ') AND accidents_id IN(' . implode(', ', $data['id']) . ') AND statuses_id IN(' . ACCIDENT_MESSAGE_STATUSES_QUESTION . ', ' . ACCIDENT_MESSAGE_STATUSES_ERROR . ')';
            $db->query($sql);

            $message = 'Відповідального(' . $info_title . ') по справах було змінено.';
            $Log->add('confirm', $message);
		}

        header('Location: index.php?do=Accidents|show&product_types_id=' . $data['product_types_id']);
        exit;
    }

    function showCarServicesCompensation($data, $limit=true, $excel=false){
        global $db, $Authorization;

        if (!$data['from']) {
            $data['from'] = date('d.m.Y', mktime(0, 0, 0, date('m'), 1, date('Y')));
        }

        $hidden['do'] = 'Accidents|showCarServicesCompensation';

        $conditions[] = 'accidents_calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION;
        $conditions[] = 'accidents_calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE;
        $conditions[] = 'accidents_calendar.payment_statuses_id <> ' . PAYMENT_STATUSES_NOT;
        $conditions[] = 'accidents.product_types_id IN(' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ')';

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $conditions[] = 'accidents_calendar.recipients_id = ' . $Authorization->data['car_services_id'];
                break;
            case ROLES_MANAGER:
                if (sizeof($Authorization->data['account_groups_id']) == 1 && in_array(ACCOUNT_GROUPS_SERVICE_DEPARTMENT, $Authorization->data['account_groups_id'])) {
                    if (is_array($Authorization->data['service_department_car_services_id']) && sizeof($Authorization->data['service_department_car_services_id'])) {
                        $conditions[] = 'accidents_calendar.recipients_id IN( ' . implode(', ', $Authorization->data['service_department_car_services_id']) . ')';
                    } else {
                        $conditions[] = '0';
                    }
                }
                break;
        }

        if ($data['owner']) {
            $conditions[] = '(policies_kasko.owner_lastname LIKE \'%' . $data['owner'] . '%\' OR ' .
                            'policies_kasko.owner_company LIKE \'%' . $data['owner'] . '%\' OR ' .
                            'accidents_go.owner_lastname LIKE \'%' . $data['owner'] . '%\')';
            $hidden['owner'] = $data['owner'];
        }

        if ($data['sign']) {
            $conditions[] = '(kasko_items.sign LIKE \'%' . $data['sign'] . '%\' OR accidents_go.owner_sign LIKE \'%' . $data['sign'] . '%\')';
            $hidden['sign'] = $data['sign'];
        }

        if ($data['shassi']) {
            $conditions[] = '(kasko_items.shassi LIKE \'%' . $data['shassi'] . '%\' OR accidents_go.owner_shassi LIKE \'%' . $data['shassi'] . '%\')';
            $hidden['sign'] = $data['sign'];
        }

        if ($data['from']) {
            $conditions[] = 'accidents_calendar.payment_date >= ' . $db->quote(date('Y-m-d', strtotime($data['from'])));
            $hidden['from'] = $data['from'];
        }

        if ($data['to']) {
            $conditions[] = 'accidents_calendar.payment_date <= ' . $db->quote(date('Y-m-d', strtotime($data['to'])));
            $hidden['to'] = $data['to'];
        }

        if ($data['car_services_id']) {
            $conditions[] = 'accidents_calendar.recipients_id = ' . intval($data['car_services_id']);
            $hidden['car_services_id'] = $data['car_services_id'];
        }

        $sql = 'SELECT accidents.number as accidents_number, accidents.id as accidents_id, accidents.product_types_id, ' .
                        'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', CONCAT(kasko_items.brand, \' \', kasko_items.model), CONCAT(accidents_go.owner_brand, \' \', accidents_go.owner_model)) as item, ' .
                        'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', kasko_items.sign, accidents_go.owner_sign) as sign, ' .
                        'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', kasko_items.shassi, accidents_go.owner_shassi) as shassi, ' .
                        'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', IF(policies_kasko.owner_person_types_id = 1, CONCAT(policies_kasko.owner_lastname, \' \', policies_kasko.owner_firstname, \' \', policies_kasko.owner_patronymicname), policies_kasko.owner_company), IF(accidents_go.owner_person_types_id = 1, CONCAT(accidents_go.owner_lastname, \' \', accidents_go.owner_firstname, \' \', accidents_go.owner_patronymicname), accidents_go.owner_lastname)) as owner, ' .
                        'car_services.title as recipient, ' .
                        'IF(car_services.ukravto = 1, \'так\', \'ні\') as ukravto, ' .
                        'accidents_calendar.basis as payments_basis, ' .
                        'CASE accidents.product_types_id WHEN ' . PRODUCT_TYPES_KASKO . ' THEN kasko_acts.amount_details + kasko_acts.amount_work + kasko_acts.amount_material WHEN ' . PRODUCT_TYPES_GO . ' THEN go_acts.amount_details + go_acts.amount_work + go_acts.amount_material END as total_amount, ' .
                        'getRepairAmountByPreviousAct(accidents_calendar.acts_id) as previous_total_amount, ' .
                        'accidents_calendar.amount as payments_amount, ' .
                        'getDiffRepairTotal(accidents_calendar.acts_id) as diff_amount, ' .
                        'date_format(accidents_calendar.payment_date, \'%d.%m.%Y\') as paymet_dateFormat, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', policies_kasko.insurer_phone, policies_go.insurer_phone) as insurer_phone ' .
                'FROM ' . PREFIX . '_accident_payments_calendar as accidents_calendar ' .
                'JOIN ' . PREFIX . '_accidents as accidents ON accidents_calendar.accidents_id = accidents.id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id ' .
				'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_kasko_acts as kasko_acts ON accidents_calendar.acts_id = kasko_acts.accidents_acts_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_go_acts as go_acts ON accidents_calendar.acts_id = go_acts.accidents_acts_id ' .
                'JOIN ' . PREFIX . '_car_services as car_services ON accidents_calendar.recipients_id = car_services.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY accidents_calendar.payment_date DESC';

        $total = $db->getOne(transformToGetCount($sql));

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

        if ($excel) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));
            include $this->objectTitle . '/excelCarServicesCompensation.php';
            exit;
        }

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_services ' .
               'WHERE ukravto = 1 ' .
               'ORDER BY title';
        $car_services_ukravto = $db->getAll($sql);

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_services ' .
               'WHERE ukravto = 0 ' .
               'ORDER BY title';
        $car_services_not_ukravto = $db->getAll($sql);

        include_once $this->objectTitle . '/showCarServicesCompensation.php';
    }

    function exportCarServicesCompensationInWindow($data) {
        $this->showCarServicesCompensation($data, false, true);
    }

    function getNumber($id) {
        global $db;

        $sql = 'SELECT number ' .
               'FROM ' . PREFIX . '_accidents ' .
               'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }

    function getPolicyPaymentsCalendar($policies_number, $policies_id, $product_types_id) {
        global $db;

        switch ($product_types_id) {
            case PRODUCT_TYPES_KASKO:
            case PRODUCT_TYPES_GO:
                $sql = 'SELECT CONCAT(policies.number, IF(policies.sub_number > 0, CONCAT(\'-\', policies.sub_number), \'\')) as policies_full_number, policies.begin_datetime, policies.end_datetime, policies.id, calendar.statuses_id, 
							calendar.date, getEndInsurancePeriod(policies.id, calendar.date, 2) as end, calendar.amount, SUM(calendar_payments.amount) as payed_amount, policies.agreement_types_id ' .
                       'FROM ' . PREFIX . '_policies AS policies ' .
                       'JOIN ' . PREFIX . '_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id  ' .
                       'LEFT JOIN ' . PREFIX . '_policy_payments_policy_payments_calendar AS calendar_payments ON calendar.id = calendar_payments.policy_payments_calendar_id ' .
                       'WHERE calendar.date <= policies.interrupt_datetime AND policies.number = ' . $db->quote($policies_number) . ' ' .
                       'GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 2) ' .
                       'ORDER BY calendar.date ASC';
                $result['payments_calendar'] = $db->getAll($sql);
                break;
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                $sql = 'SELECT CONCAT(number, IF(sub_number > 0, CONCAT(\'-\', sub_number), \'\')) as policies_full_number, id, payment_statuses_id, begin_datetime, end_datetime, begin_datetime as date, end_datetime as end, amount ' .
                       'FROM ' . PREFIX . '_policies ' .
                       'WHERE id = ' . $db->quote($policies_id);
                $result['payments_calendar'] = $db->getAll($sql);
                if ($result['payments_calendar'][0]['payment_statuses_id'] == PAYMENT_STATUSES_OVER) {
                    $result['total_amount'] = $result['payments_calendar'][0]['amount'] + 0.01;
                } elseif ($result['payments_calendar'][0]['payment_statuses_id'] == PAYMENT_STATUSES_PAYED) {
                    $result['total_amount'] = $result['payments_calendar'][0]['amount'];
                } elseif ($result['payments_calendar'][0]['payment_statuses_id'] == PAYMENT_STATUSES_PARTIAL) {
                    $result['total_amount'] = $result['payments_calendar'][0]['amount'] - 0.01;
                } else {
                    $result['total_amount'] = 0.00;
                }
                break;
        }

        return $result;
    }

    function getAccidentsDateValues($accidents_id) {
        global $db;

        $sql = 'SELECT date_format(datetime, \'%d\') as day, date_format(datetime, \'%m\') as month, date_format(datetime, \'%Y\') as year ' .
               'FROM ' . PREFIX . '_accidents ' .
               'WHERE id = ' . intval($accidents_id);
        return $db->getRow($sql);
    }

    function updateReportHistory() {
        global $db;
		
		$sql = 'SELECT history.accidents_id ' .
			   'FROM qlickview_accidents as history ' .
			   'JOIN ' . PREFIX . '_accidents_go as accidents_go ON history.accidents_id = accidents_go.accidents_id ' .
			   'WHERE accidents_go.owner_types_id = 1 ' .
			   'GROUP BY history.accidents_id';
		$list = $db->getCol($sql);
		$sql = 'DELETE FROM qlickview_accidents WHERE accidents_id IN (' . (sizeof($list) ? implode(', ', $list) : '0') . ')';
		$db->query($sql);

		$sql = 'SELECT MAX(modified) FROM qlickview_accidents';
		$max_date = $db->getOne($sql);
		if ($max_date == NULL) $max_date = '0000-00-00';
		
		$sql = 'SELECT id FROM insurance_accidents WHERE modified > ' . $db->quote($max_date) . ' AND product_types_id IN (3, 4)';
		$list_accidents = $db->getCol($sql);
		
		if (!sizeof($list_accidents)) return;

		$sql = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_accident_repair_info ' . 
			   'SELECT calendar.accidents_id, repair_info.* ' .
			   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
			   'JOIN ' . PREFIX . '_accident_repair_info as repair_info ON calendar.id = repair_info.payments_calendar_id ' .
			   'JOIN ( ' .
					'SELECT MAX(last_date_exchange) as last_date, payments_calendar_id ' .
					'FROM ' . PREFIX . '_accident_repair_info ' .
					'GROUP BY payments_calendar_id' .
			   ') as repair_info_last ON repair_info.payments_calendar_id = repair_info_last.payments_calendar_id ' .
			   'WHERE repair_info_last.last_date = repair_info.last_date_exchange AND repair_info.last_date_exchange > ' . $db->quote($max_date);
		$db->query($sql);

		$sql = 'SELECT a.id as accidents_id, accidents_go.owner_types_id, getArchiveStatusesId(a.id) as archive_statuses_id, getResolvedDate(a.id, 0) as resolved_date, a.number, a.date, a.datetime, a.insurance,a.accident_sections_id, a.product_types_id, a.accident_statuses_id, amount_rough, SUM(y.amount) as acts_amount,

		a.compromise as compromise, a.compromise_violation as compromise_violation, a.compromise_date as compromise_date,

		b.id as car_services_id, b.ukravto as car_services_ukravto, b.title as car_services_title, d.title as accicent_sections_title, a.repair_classifications_id, e.title as accident_statuses_title, w2.id as financial_institutions_id,  w2.title as financial_institutions_title, p2.title as car_services_title, car_services_amount,

		z1.application_created as application_created, WEEKDAY(application_created)+1 as application_weekday, ROUND(application_duration/3600,2) as application_duration, application_responsible, classification_responsible as application_end_responsible,
		classification_created, WEEKDAY(classification_created)+1 as classification_weekday, ROUND(classification_duration/3600,2) as classification_duration, investigation_responsible as classification_responsible,
		investigation_created, WEEKDAY(investigation_created)+1 as investigation_weekday, ROUND(investigation_duration/3600,2) as investigation_duration, approval_responsible as investigation_responsible, messages_created, messages_solved,
		approval_created, WEEKDAY(approval_created)+1 as approval_weekday, ROUND(approval_duration/3600,2) as approval_duration, payment_responsible as approval_responsible,
		payment_created, WEEKDAY(payment_created)+1 as payment_weekday, ROUND(payment_duration/3600,2) as payment_duration, resolved_responsible as payment_responsible,
		resolved_created, WEEKDAY(resolved_created)+1 as resolved_weekday, ROUND(resolved_duration/3600,2) as resolved_duration, resolved_responsible, closed_created, ROUND(closed_duration/3600,2) as closed_duration, reset_responsible,
		reset_created, WEEKDAY(reset_created)+1 as reset_weekday, ROUND(reset_duration/3600,2) as reset_duration, reinvestigation_responsible,
		reinvestigation_created, WEEKDAY(reinvestigation_created)+1 as reinvestigation_weekday, ROUND(reinvestigation_duration/3600,2) as reinvestigation_duration, defects_responsible,
		defects_created, WEEKDAY(defects_created)+1 as defects_weekday, ROUND(defects_duration/3600,2) as defects_duration, defects_responsible,
		suspended_created, WEEKDAY(suspended_created)+1 as suspended_weekday, ROUND(suspended_duration/3600,2) as suspended_duration, suspended_responsible,
		accident_sections_change_created, WEEKDAY(accident_sections_change_created)+1 as accident_sections_change_created_weekday, ROUND(accident_section_change_duration/3600,2) as accident_section_change_duration, accident_sections_change_responsible,
		p2.ukravto, p4.title as accident_expert_organizations, p3.expertises_amount, p5.other_amount,
		z12.average_first_task_created, z13.average_last_task_closed,
		z15.compromise_agreement_created as compromise_agreement_created, ROUND(compromise_agreement_duration/3600,2) as compromise_agreement_duration, compromise_agreement_responsible,
		z16.compromise_continue_created as compromise_continue_created, ROUND(compromise_continue_duration/3600,2) as compromise_continue_duration, compromise_continue_responsible,

		getAccidentsDeductible(a.id) as deductibles_amount,
		getAmountAccidents(a.number, a.id, 1) as amount_compensation,
		getAmountAccidents(a.number, a.id, 2) as amount_vz,
		getAmountAccidents(a.number, a.id, 3) as amount_act,
		getAmountAccidents(a.number, a.id, 4) as amount_addition,
		getAmountAccidents(a.number, a.id, 5) as amount_experts,
		getRecipientAccidents(a.number, a.id, 3) as recipient_act,
		getRecipientAccidents(a.number, a.id, 4) as recipient_addition,
		getRecipientAccidents(a.number, a.id, 5) as recipient_experts,
		getPaymentDateAccidents(a.number, a.id, 3) as act_payments_date,
		getPaymentDateAccidents(a.number, a.id, 4) as addition_payments_date, ' .

		/*GROUP_CONCAT(date_format(repair_info.document_date, \'%d.%m.%Y\') SEPARATOR \'<br>\') as document_date_tis,
		GROUP_CONCAT(REPLACE(repair_info.amount, \'.\', \',\') SEPARATOR \'<br>\') as amount_tis,
		GROUP_CONCAT(IF(repair_info.order_parts_date = \'0000-00-00\', \'-\', date_format(repair_info.order_parts_date, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as order_parts_date_tis,
		GROUP_CONCAT(IF(repair_info.order_outfit_begin_date = \'0000-00-00\', \'-\', date_format(repair_info.order_outfit_begin_date, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as order_outfit_begin_date_tis,
		GROUP_CONCAT(REPLACE(repair_info.order_outfit_begin_amount, \'.\', \',\') SEPARATOR \'<br>\') as order_outfit_begin_amount_tis,
		GROUP_CONCAT(repair_info.order_outfit_begin_author SEPARATOR \'<br>\') as order_outfit_begin_author_tis,
		GROUP_CONCAT(IF(repair_info.order_outfit_end_date = \'0000-00-00\', \'-\', date_format(repair_info.order_outfit_end_date, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as order_outfit_end_date_tis,
		GROUP_CONCAT(REPLACE(repair_info.order_outfit_end_amount, \'.\', \',\') SEPARATOR \'<br>\') as order_outfit_end_amount_tis,
		GROUP_CONCAT(repair_info.order_outfit_end_author SEPARATOR \'<br>\') as order_outfit_end_author_tis,
		GROUP_CONCAT(REPLACE(repair_info.deductible_amount, \'.\', \',\') SEPARATOR \'<br>\') as deductible_amount_tis,
		GROUP_CONCAT(IF(repair_info.last_date_exchange = \'0000-00-00\', \'-\', date_format(repair_info.last_date_exchange, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as last_date_exchange_tis,*/
		
		'IF(a.risks_id>0,a.risks_id,a.application_risks_id) as risk,
		
		isAccidentsTotal(a.id) as total,
		REPLACE(REPLACE(REPLACE(getPaymentNotesAccidents(a.id), \'Previous\', \'Попередньо було перераховано\' COLLATE utf8_unicode_ci), \'grn\', \'грн\' COLLATE utf8_unicode_ci), \'Denial\', \'Було відмовлено\' COLLATE utf8_unicode_ci) as notes,
		
		REPLACE(REPLACE(REPLACE(REPLACE(getRecipientSignAccidents(a.number, a.id, 3), \'1\', \'УкрАВТО\' COLLATE utf8_unicode_ci), \'0\', \'не УкрАВТО\' COLLATE utf8_unicode_ci), \'2\', \'Банк\' COLLATE utf8_unicode_ci), \'3\', \'Фізична особа\' COLLATE utf8_unicode_ci) as sign_recipient_act,
		REPLACE(REPLACE(REPLACE(REPLACE(getRecipientSignAccidents(a.number, a.id, 4), \'1\', \'УкрАВТО\' COLLATE utf8_unicode_ci), \'0\', \'не УкрАВТО\' COLLATE utf8_unicode_ci), \'2\', \'Банк\' COLLATE utf8_unicode_ci), \'3\',	 \'Фізична особа\' COLLATE utf8_unicode_ci) as sign_recipient_addition,

		a.comment_closed

		FROM insurance_accidents AS a
		LEFT JOIN insurance_accidents_go as accidents_go ON a.id = accidents_go.accidents_id
		LEFT JOIN temp_accident_repair_info as repair_info ON a.id = repair_info.accidents_id
		LEFT JOIN insurance_car_services AS b ON a.car_services_id=b.id
		LEFT JOIN insurance_product_types AS c ON a.product_types_id=c.id
		LEFT JOIN insurance_accident_sections AS d ON a.accident_sections_id = d.id
		LEFT JOIN insurance_accident_statuses AS e ON a.accident_statuses_id = e.id

		LEFT JOIN insurance_accidents_acts AS y ON a.id = y.accidents_id

		LEFT JOIN insurance_policies_kasko AS w1 ON a.policies_id = w1.policies_id
		LEFT JOIN insurance_financial_institutions AS w2 ON w1.financial_institutions_id = w2.id

		LEFT JOIN (SELECT SUM(amount) as car_services_amount, accidents_id, recipients_id FROM insurance_accident_payments_calendar WHERE recipient_types_id = 5 GROUP BY accidents_id) AS p1 ON a.id = p1.accidents_id

		LEFT JOIN insurance_car_services AS p2 ON p2.id = p1.recipients_id

		LEFT JOIN (SELECT SUM(amount) as  expertises_amount, accidents_id, recipients_id FROM insurance_accident_payments_calendar WHERE recipient_types_id = 3 GROUP BY accidents_id) AS p3 ON a.id = p3.accidents_id

		LEFT JOIN insurance_expert_organizations AS p4 ON p4.id = p3.recipients_id

		LEFT JOIN (SELECT SUM(amount) as  other_amount, accidents_id, recipients_id FROM insurance_accident_payments_calendar WHERE payment_types_id NOT IN (1,5,6) GROUP BY accidents_id) AS p5 ON a.id = p5.accidents_id

		LEFT JOIN (SELECT MIN(created) as messages_created, accidents_id, authors_id FROM insurance_accident_messages WHERE message_types_id<>1 GROUP BY accidents_id) AS x1 ON a.id = x1.accidents_id AND a.average_managers_id = x1.authors_id

		LEFT JOIN (SELECT MAX(created) as messages_solved, accidents_id, authors_id FROM insurance_accident_messages WHERE message_types_id<>1 AND statuses_id = 2 GROUP BY accidents_id) AS x2 ON a.id = x2.accidents_id AND a.average_managers_id = x2.authors_id

		LEFT JOIN (SELECT MIN( created ) AS application_created, SUM( duration ) AS application_duration, accounts_title as application_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =1 GROUP BY accidents_id) AS z1 ON a.id = z1.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS classification_created, SUM( duration ) AS classification_duration, accounts_title as classification_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =2 GROUP BY accidents_id) AS z2 ON a.id = z2.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS investigation_created, SUM( duration ) AS investigation_duration, accounts_title as investigation_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =3 GROUP BY accidents_id) AS z3 ON a.id = z3.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS approval_created, SUM( duration ) AS approval_duration, accounts_title as approval_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =4 GROUP BY accidents_id) AS z4 ON a.id = z4.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS payment_created, SUM( duration ) AS payment_duration, accounts_title as payment_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =5 GROUP BY accidents_id) AS z5 ON a.id = z5.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS resolved_created, SUM( duration ) AS resolved_duration, accounts_title as resolved_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =6 GROUP BY accidents_id) AS z6 ON a.id = z6.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS reset_created, SUM( duration ) AS reset_duration, accounts_title as reset_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =7 GROUP BY accidents_id) AS z7 ON a.id = z7.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS reinvestigation_created, SUM( duration ) AS reinvestigation_duration, accounts_title as reinvestigation_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =8 GROUP BY accidents_id) AS z8 ON a.id = z8.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS defects_created, SUM( duration ) AS defects_duration, accounts_title as defects_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =9 GROUP BY accidents_id) AS z9 ON a.id = z9.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS suspended_created, SUM( duration ) AS suspended_duration, accounts_title as suspended_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =10 GROUP BY accidents_id) AS z10 ON a.id = z10.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS closed_created, SUM( duration ) AS closed_duration, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id = 11 GROUP BY accidents_id) AS z14 ON a.id = z14.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS compromise_agreement_created, SUM( duration ) AS compromise_agreement_duration, accounts_title as compromise_agreement_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =13 GROUP BY accidents_id) AS z15 ON a.id = z15.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS compromise_continue_created, SUM( duration ) AS compromise_continue_duration, accounts_title as compromise_continue_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =14 GROUP BY accidents_id) AS z16 ON a.id = z16.accidents_id

		LEFT JOIN (SELECT MIN( created ) AS accident_sections_change_created, SUM( duration ) AS accident_section_change_duration, accounts_title as accident_sections_change_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =-1 GROUP BY accidents_id) AS z11 ON a.id = z11.accidents_id

		LEFT JOIN (SELECT MIN(a.created) as average_first_task_created, a.accidents_id FROM insurance_accident_messages as a JOIN insurance_accidents as b ON a.authors_id = b.average_managers_id GROUP BY a.accidents_id) as z12 ON a.id = z12.accidents_id

		LEFT JOIN (SELECT MAX(a.decision) as average_last_task_closed, a.accidents_id FROM insurance_accident_messages as a JOIN insurance_accidents as b ON a.authors_id = b.average_managers_id WHERE a.statuses_id = 2 GROUP BY a.accidents_id) as z13 ON a.id = z13.accidents_id ' .

		//'WHERE a.modified > ' . $db->quote($max_date) . ' AND a.product_types_id IN (3,4) ' .
		'WHERE a.id IN (' . implode(', ', $list_accidents) . ')' .

		'GROUP BY a.id
		ORDER BY datetime ASC';
		//WHERE TO_DAYS(NOW()) - TO_DAYS(a.modified) <= 1
		$new = $db->getAll($sql);

		$sql = 'SHOW COLUMNS FROM qlickview_accidents';
			$columns = $db->getAll($sql);
			$columns_names = array();

			foreach($columns as $column){
				$columns_names[] = $column['Field'];
			}

		unset($columns_names[array_search('created', $columns_names)]);//убираем поле created
		unset($columns_names[array_search('modified', $columns_names)]);//убираем поле modified для ручной вставки в запрос

		$diff = array();
		$log = array();
		foreach($new as $new_item){
			if ($new_item['product_types_id'] == PRODUCT_TYPES_GO && $new_item['owner_types_id'] == 1) continue;
			$sql = 'SELECT * FROM qlickview_accidents WHERE accidents_id = ' . $new_item['accidents_id'] . ' ORDER BY created desc LIMIT 1';
			$old = $db->getRow($sql);
			//если запись новая, то сразу добавляем её в запрос
			if(!$old){
				$diff[] = $new_item;
			}
			else{//проверка на совпадение значений полей, если не совпадают, то пишем в таблицу
				unset($old['created']);
				unset($old['modified']);
				foreach($columns_names as $name){
					if($new_item[$name] != $old[$name]) {
						$diff[] = $new_item;
						$log[]['accidents_id']  = $new_item['accidents_id'];
						$log[]['name']          = $name;
						break;
					}
				}
			}
		}
		if(sizeof($diff)){
		$sql = 'INSERT INTO qlickview_accidents (created, modified, ' . implode(', ',$columns_names) . ')' .
					'VALUES ';

			foreach($diff as $item){
				$sql .= '(NOW(), NOW(), ';
				foreach($columns_names as $name){
					$sql .= $db->quote($item[$name]) . ',';
				}
				$sql = rtrim($sql, ',');
				$sql .='),';
			}
			$sql = rtrim($sql, ',');

			$db->query($sql);
		}
    }

    function xfgetcsv($f='', $x='', $s=';'){
        if($str=fgets($f)){ $data=split($s, trim($str)); return $data; }else{ return FALSE; }
    }

    function importAccidentRepairInfo($data) {
        global $db, $Log;

        if ((is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.csv', $_FILES['file']['name']) && $data['mode'] == 1) || $data['mode'] == 2){
            $params = array('Файл', $languageDescription);
            if (!is_uploaded_file($_FILES['file']['tmp_name']) && $data['mode'] == 1) {
                $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
            } elseif (!ereg('\.csv', $_FILES['file']['name']) && $data['mode'] == 1) {
                $Log->add('error', 'Невірний формат файлу, підтримується формат csv.', $params);
            }

            if ($data['mode'] == 1) {
                $file = fopen($_FILES['file']['tmp_name'], "r");
            } elseif ($data['mode'] == 2 && is_file($_SERVER['DOCUMENT_ROOT'] . '/temp/temp.csv')) {
                $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/temp/temp.csv', "r");
            } else {
                exit;
            }

            $columns = $this->xfgetcsv($file,1000,";");

            $i = 0;
            foreach($columns as $column) {
                $column = iconv('Windows-1251', 'utf-8', $column);
                switch ($column) {
                    case 'Фирма':
                    case 'Марка':
                    case 'ГосНомер':
                    case 'Вин':
                    case 'Владелец':
                    case 'НомерДелаAudaNet':
                    case 'ДатаДела':
                    case 'СуммаДела':
                    case 'ДатаИЗП':
                    case 'ДатаЗН':
                    case 'СуммаЗН':
                    case 'АвторЗН':
                    case 'ДатаЗА':
                    case 'СуммаЗА':
                    case 'Франшиза':
                    case 'АвторЗА':
                    case 'ДатаПоследнегоОбмена':
                    case 'Марка':
                    case 'ГосНомер':
                    case 'Вин':
                    case 'Владелец':
                        $cols[$column] = $i;
                        break;
                    case '':
                        break;
                    default:
                        $Log->add('error', 'Перелік колонок не відповідає встановленому формату, "'  . $i . '  !!!  ' . $column . '"');
                        break;
                }
                $i++;
            }

            if ($Log->isPresent() && $data['mode'] == 1) {
                $Log->showSystem();
                include_once $this->object . '/importRepairInfo.php';
                return;
            }

            $inserted = 0;
            $updated = 0;
            $identified = 0;
            $errors = 0;
            $total = 0;

            $result = '
                <tr>
                    <td><b>СТО</b></td>
                    <td><b>Фирма, ЄДРПОУ</b></td>
                    <td><b>Марка</b></td>
                    <td><b>ГосНомер</b></td>
                    <td><b>Вин</b></td>
                    <td><b>Владелец</b></td>
                    <td><b>НомерДелаAudaNet</b></td>
                    <td><b>ДатаДела</b></td>
                    <td><b>СуммаДела</b></td>
                    <td><b>ДатаИЗП</b></td>
                    <td><b>ДатаЗН</b></td>
                    <td><b>СуммаЗН</b></td>
                    <td><b>АвторЗН</b></td>
                    <td><b>ДатаЗА</b></td>
                    <td><b>СуммаЗА</b></td>
                    <td><b>Франшиза</b></td>
                    <td><b>АвторЗА</b></td>
                    <td><b>ДатаПоследнегоОбмена</b></td>
                    <td><b>Статус</b></td>
                    <td><b>Опис</b></td>
                </tr>';

            for ($i=1; $columns = $this->xfgetcsv($file,1000,";"); $i++) {
                $status = array();
                $fields = array();
                $values = array();
                $error = false;
                $values['car_services_edrpou'] = trim(iconv('Windows-1251', 'utf-8', $columns[$cols['Фирма']]));
                $values['number_audanet'] = trim(iconv('Windows-1251', 'utf-8', $columns[$cols['НомерДелаAudaNet']]));
                $values['document_date'] = ($columns[$cols['ДатаДела']] != '') ? trim(iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаДела']])) : '';
                $values['amount'] = str_replace(',', '.' , trim(iconv('Windows-1251', 'utf-8', $columns[$cols['СуммаДела']])));
                $values['order_parts_date'] = ($columns[$cols['ДатаИЗП']] != '') ? trim(iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаИЗП']])) : '';
                $values['order_outfit_begin_date'] = ($columns[$cols['ДатаЗН']] != '') ? trim(iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаЗН']])) : '';
                $values['order_outfit_begin_amount'] = str_replace(',', '.', trim(iconv('Windows-1251', 'utf-8', $columns[$cols['СуммаЗН']])));
                $values['order_outfit_begin_author'] = trim(iconv('Windows-1251', 'utf-8', $columns[$cols['АвторЗН']]));
                $values['order_outfit_end_date'] = ($columns[$cols['ДатаЗА']] != '') ? trim(iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаЗА']])) : '';
                $values['order_outfit_end_amount'] = str_replace(',', '.', trim(iconv('Windows-1251', 'utf-8', $columns[$cols['СуммаЗА']])));
                $values['deductible_amount'] = str_replace(',', '.', trim(iconv('Windows-1251', 'utf-8', $columns[$cols['Франшиза']])));
                $values['order_outfit_end_author'] = trim(iconv('Windows-1251', 'utf-8', $columns[$cols['АвторЗА']]));
                $values['last_date_exchange'] = ($columns[$cols['ДатаПоследнегоОбмена']] != '') ? trim(iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаПоследнегоОбмена']])) : '';
                $values['created'] = 'NOW()';
                $values['modified'] = 'NOW()';
                $values['payments_calendar_id'] = $this->getPaymentsCalendarIdRepairInfo($values['car_services_edrpou'], $values['number_audanet']);

                foreach($values as $key => $value) {
                    if (($value == '' || (str_replace(' ', '', $value) == '..' && in_array($key, array('order_parts_date', 'order_outfit_begin_date', 'order_outfit_end_date')))) && !in_array($key, array('car_services_edrpou', 'number_audanet', 'document_date', 'last_date_exchange', 'payments_calendar_id'))) {
                        unset($values[$key]);
                    } else {
                        $fields[$key] = $key;
                    }
                }

                $messages = $this->checkFieldsRepairInfo($values, $fields);

                if (is_array($messages) && sizeof($messages)) {
                    $errors++;
                    $error = true;
                    $status['title'] = 'Помилка';
                    $status['details'] = implode('<br>', $messages);
                }

                if($this->isFindRepairInfo($values['car_services_edrpou'], $values['number_audanet'], $values['last_date_exchange']) && !$error) {
                    $this->prepareFieldsRepairInfo($values, $fields);

                    unset($fields['car_services_edrpou']);
                    unset($fields['number_audanet']);
                    unset($fields['created']);
                    unset($fields['last_date_exchange']);

                    $sql = 'UPDATE ' . PREFIX . '_accident_repair_info SET ';
                    $pairs = array();
                    foreach($fields as $field) {
                        $pairs[] = $field . ' = ' . $values[$field];
                    }
                    $sql .= implode(', ', $pairs);
                    $sql .= ' WHERE car_services_edrpou = ' . $values['car_services_edrpou'] . ' AND number_audanet = ' . $values['number_audanet'] . ' AND last_date_exchange = ' . $values['last_date_exchange'];
                    if ($db->query($sql)) {
                        $updated++;
                        $status['title'] = 'Редаговано';
                        if ($values['payments_calendar_id']) {
                            $identified++;
                        }
                    } else {
                        $status['title'] = 'Помилка';
                        $status['details'] = 'Невідома помилка редагування';
                        $errors++;
                    }
                } elseif (!$error) {
                    $this->prepareFieldsRepairInfo($values, $fields);

                    $sql = 'INSERT INTO ' . PREFIX . '_accident_repair_info ' .
                           '(' . implode(', ', $fields) . ') ' .
                           'VALUES (' . implode(', ', $values) . ')';
                    if ($db->query($sql)) {
                        $inserted++;
                        $status['title'] = 'Створено';
                        if ($values['payments_calendar_id']) {
                            $identified++;
                        }
                    } else {
                        $status['title'] = 'Помилка';
                        $status['details'] = 'Невідома помилка створення';
                        $errors++;
                    }
                }

                $result .= '<tr>
                                <td>' . $db->getOne('SELECT title FROM ' . PREFIX . '_car_services WHERE edrpou = ' . $db->quote(trim(iconv('Windows-1251', 'utf-8', $columns[$cols['Фирма']])))) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['Фирма']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['Марка']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['ГосНомер']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['Вин']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['Владелец']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['НомерДелаAudaNet']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаДела']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['СуммаДела']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаИЗП']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаЗН']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['СуммаЗН']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['АвторЗН']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаЗА']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['СуммаЗА']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['Франшиза']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['АвторЗА']]) . '</td>
                                <td>' . iconv('Windows-1251', 'utf-8', $columns[$cols['ДатаПоследнегоОбмена']]) . '</td>
                                <td>' . $status['title'] . '</td>
                                <td>' . $status['details'] . '</td>
                            </tr>';

                $total++;
            }

            $result='<table border="1">'.$result.'</table>';
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/temp/tis_log.xls');
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/temp/tis_log.xls', '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet>' . $result . '</body></html>');

            $headers  = 'MIME-Version: 1.0' . "\r\n";
	        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	        $headers .= 'From: Express group <support@e-insurance.in.ua>' . "\r\n";
            $subject = 'Звіт про імпорт інформації по ТіС';
            $txt='<table><tr><td>Створено:</td><td align="right">' . $inserted . '</td></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr><td>Ідентифіковано:</td><td align="right">' . $identified . '</td></tr><tr><td>Помилки:</td><td align="right">' . $errors . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table>';
            $files = array(
                array(
                    'data'  => $result,
                    'name'  => 'tis_log.xls'));
            $emails = array();
            $emails[] = 'm.marchuk@express-group.com.ua';
            $emails[] = 'mail4mike@ukr.net';
            $emails[] = 'd.petrenko@express-group.com.ua';
            $Templates = Templates::factory($data, 'Mail');
            $Templates->send(implode(', ', $emails), null, $template = null, $subject, $txt, 'Express group', 'support@e-insurance.in.ua', false, $files);

            if ($data['mode'] == 1) {
                $Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr><td>Створено:</td><td align="right">' . $inserted . '</td></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr><td>Ідентифіковано:</td><td align="right">' . $identified . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $errors . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="/temp/tis_log.xls">Скачати файл змін</a>' , $params);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Reports|getRepairInfo');
            }
            exit;
        }

        $Log->showSystem();
        include_once $this->object . '/importRepairInfo.php';
    }

    function isFindRepairInfo($edrpou, $audanet, $last_date_exchange) {
        global $db;

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_accident_repair_info ' .
               'WHERE car_services_edrpou = ' . $db->quote($edrpou) . ' AND number_audanet = ' . $db->quote($audanet) . ' AND last_date_exchange = ' . $db->quote(date('Y-m-d', strtotime($last_date_exchange)));
        return $db->getOne($sql);
    }

    function getPaymentsCalendarIdRepairInfo($edrpou, $audanet) {
        global $db;

        $sql = 'SELECT calendar.id ' .
               'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
               'JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .
               'WHERE calendar.audatex_code = ' . $db->quote($audanet) . ' AND car_services.edrpou = ' . $db->quote($edrpou);
        return $db->getOne($sql);
    }

    function prepareFieldsRepairInfo(&$values, $fields) {
        global $db;

        foreach ($fields as $field) {
            switch ($field) {
                case 'car_services_edrpou':
                case 'number_audanet':
                case 'order_outfit_begin_author':
                case 'order_outfit_end_author':
                    $values[$field] = $db->quote($values[$field]);
                    break;
                case 'document_date':
                case 'last_date_exchange':
                case 'order_parts_date':
                case 'order_outfit_begin_date':
                case 'order_outfit_end_date':
                    $values[$field] = $db->quote(date('Y-m-d', strtotime($values[$field])));
                    break;
            }
        }
    }

    function checkFieldsRepairInfo($values, $fields){
        global $db;

        $messages = array();

        $titles = array(
            'car_services_edrpou'       =>  'ЄДРПОУ',
            'number_audanet'            =>  'Код AUDATEX',
            'document_date'             =>  'Дата документу',
            'last_date_exchange'        =>  'Дата останнього оновлення',
            'amount'                    =>  'Сума калькуляції',
            'order_outfit_begin_amount' =>  'Сума заказ-наряду (початкова)',
            'order_outfit_end_amount'   =>  'Сума заказ-наряду (кінцева)',
            'deductible_amount'         =>  'Сума франшизи',
            'order_parts_date'          =>  'Дата замовлення ЗЧ',
            'order_outfit_begin_date'   =>  'Дата заказ-наряду (початкова)',
            'order_outfit_end_date'     =>  'Дата заказ-наряду (кінцева)',
            'payments_calendar_id'      =>  'Дата останнього обміну'
        );

        foreach ($fields as $field) {
            switch ($field) {
                case 'car_services_edrpou':
                    if (!strlen($values[$field])) {
                        $messages[] = 'Відсутнє поле: ' . $titles[$field];
                    } else {
                        $sql = 'SELECT id FROM ' . PREFIX . '_car_services WHERE edrpou = ' . $db->quote($values[$field]);
                        if (!$db->getOne($sql)) {
                            $messages[] = 'СТО з таким ЄДРПОУ не знайдено';
                        }
                    }
                    break;
                case 'number_audanet':
                    if (!strlen($values[$field])) {
                        $messages[] = 'Відсутнє поле: ' . $titles[$field];
                    }
                    break;
                case 'document_date':
                case 'last_date_exchange':
                    if (!strlen($values[$field]) || str_replace(' ', '', $values[$field]) == '..') {
                        $messages[] = 'Відсутнє поле: ' . $titles[$field];
                    } elseif (!checkdate(substr($values[$field], 3, 2), substr($values[$field], 0, 2), substr($values[$field], 6, 2))) {
                        $messages[] = 'Невірний формат: ' . $titles[$field];
                    }
                    break;
                case 'amount':
                    if (round($values[$field], 2) < 0) {
                        $messages[] = 'Невірний формат: ' . $titles[$field];
                    }
                    break;
                case 'order_outfit_begin_amount':
                case 'order_outfit_end_amount':
                case 'deductible_amount':
                    if (strlen($values[$field]) && round($values[$field], 2) < 0) {
                        $messages[] = 'Невірний формат: ' . $titles[$field];
                    }
                    break;
                case 'order_parts_date':
                case 'order_outfit_begin_date':
                case 'order_outfit_end_date':
                    if (strlen($values[$field]) && str_replace(' ', '', $values[$field]) != '..' && !checkdate(substr($values[$field], 3, 2), substr($values[$field], 0, 2), '20' . substr($values[$field], 6, 2))) {
                        $messages[] = 'Невірний формат: ' . $titles[$field];
                    }
                    break;
                case 'payments_calendar_id':
                    if (!$values[$field]) {
                        $messages[] = 'Помилка ідентифікування';
                    }
                    break;
            }
        }

        return $messages;
    }

    function getCarServicesId($accidents_id) {
        global $db;

        return $db->getOne('SELECT car_services_id ' .
                           'FROM ' . PREFIX . '_accidents ' .
                           'WHERE id = ' . intval($accidents_id));
    }
	
	function getAmountRough($accidents_id) {
		global $db;
		
		return $db->getOne('SELECT amount_rough ' .
						   'FROM ' . PREFIX . '_accidents ' . 
						   'WHERE id = ' . intval($accidents_id));
	}
	
	function checkCompromise($accidents_id, $mode) {
		global $db;
		
		$res = false;
		
		switch ($mode) {
			case 1://перевірка ознаки компромісної справи
				$sql = 'SELECT compromise, compromise_date ' .
					   'FROM ' . PREFIX . '_accidents ' .
					   'WHERE id = ' . intval($accidents_id);
				$compromise_info = $db->getRow($sql);
				if ($compromise_info['compromise'] == 1) {
					$res = true;
				}
				break;
			case 2://перевірка дати прийняття компромісного рішення
				$sql = 'SELECT compromise, compromise_date ' .
					   'FROM ' . PREFIX . '_accidents ' .
					   'WHERE id = ' . intval($accidents_id);
				$compromise_info = $db->getRow($sql);
				if ($compromise_info['compromise'] == 1 && $compromise_info['compromise_date'] != NULL && $compromise_info['compromise_date'] != '0000-00-00') {
					$res = true;
				}
				break;
			default:
				$res = false;
				break;
		}
		
		return $res;
	}

    function getImportantPerson($policies_id){
        global $db;

        $sql = 'SELECT clients.important_person ' .
               'FROM ' . PREFIX . '_clients as clients ' .
               'JOIN ' . PREFIX . '_policies as policies ON clients.id = policies.clients_id ' .
               'WHERE policies.id = ' . intval($policies_id);
        return $db->getOne($sql);
    }
	
	function loadStateInExpress($data) {
        global $db;

        $this->checkPermissions('inExpress', $data);

        include_once $this->object . '/inExpress.php';
    }

    function setStateInExpress($id, $state_in_express_id, $accident_statuses_id = null) {
        global $db;

		$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
				'in_express = ' . intval($state_in_express_id) . ', ' .
				'modified = NOW() ' .
				'WHERE id = ' . intval($id);
		$db->query($sql);
    }

    function updateStateInExpress($data) {
        global $db, $Log;

        $this->checkPermissions('inExpress', $data);

        if (is_array($data['id']) && sizeof($data['id'])) {
            $accident_statuses = array();
            $accidents_confirm = array();
            $accidents_error = array();
            foreach($data['id'] as $id) {
				$this->setStateInExpress($id, $data['in_express'], $statuses_id);
            }
        }

        header('Location: index.php?do=Accidents|show&product_types_id=' . $data['product_types_id']);
        exit;
    }
	
	function getStateInExpress($id) {
		global $db;
		
		$sql = 'SELECT in_express ' . 
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getProductTypesId($id){
		global $db;
		
		$sql = 'SELECT product_types_id ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' .intval($id);
		return $db->getOne($sql);
	}
	
	function getRepairClassificationsId($id) {
		global $db;
		
		$sql = 'SELECT repair_classifications_id ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getPreviousStatuses($id) {
		global $db;
		
		$sql = 'SELECT * ' .
			   'FROM ' . PREFIX . '_accident_status_changes ' .
			   'WHERE accident_statuses_id <> -1 AND accidents_id = ' . intval($id) . ' ' .
			   'ORDER BY created DESC ' .
			   'LIMIT 2';
		$list = $db->getAll($sql);
		
		return $list[1];
	}	
	
	function getAccidentStatusesTitle($accident_statuses_id) {
		global $db;
		
		$sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_accident_statuses ' .
			   'WHERE id = ' . intval($accident_statuses_id);
		return $db->getOne($sql);
	}
	
	function getApplicationRisksId($accidents_id) {
		global $db;
		
		$sql = 'SELECT application_risks_id ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($accidents_id);
		return $db->getOne($sql);
	}
	
}

?>