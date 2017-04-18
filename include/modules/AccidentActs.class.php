<?
/*
 * Title: accident acts class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';
require_once 'AccidentDocuments.class.php';
require_once 'AccidentPayments.class.php';
require_once 'AccidentPaymentsCalendar.class.php';
require_once 'AccidentsActsTransfer.class.php';

class AccidentActs extends Form {

	var $documentsDelimiter = '	';

    function AccidentActs($data) {

        $this->object = 'AccidentActs';
        $this->objectTitle = 'AccidentActs';

        Form::Form($data);
      
    }

    function setMode($data) {
		global $Authorization;

        if (is_array($data['id'])) {
            $data['accidents_id'] = $data['id'][0];
        } elseIf (!intval($data['accidents_id']) && $data['id']) {
            $data['accidents_id'] = $data['id'];
        }

        if (ereg('^' . $this->object . '\|(add|create|insert|load|update)', $data['do'])) {
            $this->mode = 'update';
			$_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'] = 'update';
        } elseif (ereg('^' . $this->object . '\|view', $data['do'])) {
            $this->mode = 'view';
			$_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'] = 'view';
        } else {
            $this->mode = $_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'];
        }

		$this->formDescription = $this->investigationFormDescription;
    }

    function setPermissions($data) {
        global $Authorization;
        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'    		=> true,
                    'update'    		=> true,
					'updateApproval'	=> true,
                    'view'      		=> true,
                    'change'            => true,
                    'delete'    		=> true,
                    'assignMonitorUser' => true);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
                break;
            case ROLES_AGENT:
                if ($Authorization->data['agencies_id'] == SELLER_AGENCIES_ID) {
                    $this->permissions = array(
                        'show'      	            => true,
                        'view'			            => true);
                    break;
                }
                break;
        }
    }

    function checkActsByItems($data){
        global $db, $Authorization;
        
         //проверяем есть ли дела по данному договору и конкретному авто, в которых есть акты не переведенные на финальные стадии (Оплата и урегулировано), если есть - запрещаем добавление акта

         $sql = 'SELECT items_id FROM ' . PREFIX . '_accidents_kasko WHERE accidents_id = ' .intval($data['accidents_id']);
         $items_id = $db->getOne($sql);

         //определяем ограничения для выборки существующих актов по выбраному авто договора
         $conditions[] = 'a.act_statuses_id NOT IN (' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';
         $conditions[] = 'b.items_id = ' . $items_id; // ограничение по конкретному авто
         $conditions[]= 'a.accidents_id <> '.intval($data['accidents_id']); //не учитываем текущее дело

         $sql = 'SELECT a.id, a.accidents_id, a.act_statuses_id, ' .
                         'b.accidents_id, b.items_id ' .
                         'FROM ' . PREFIX . '_accidents_acts as a ' .
                         'JOIN ' . PREFIX . '_accidents_kasko as b ON a.accidents_id = b.accidents_id ' .
                         'WHERE ' . implode(' AND ', $conditions );

         $previous = $db->getAll($sql);

        if(!empty($previous) && $Authorization->data['roles_id'] == ROLES_MANAGER)
            return false;
        else
            return true;
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

		$result = parent::checkPermissions($action, $data, $redirect);

       // $this->permissions['insert'] = $this->checkActsByItems($data);

		switch ($action) {
			case 'update':
			case 'updateApproval':

				if (is_array($data['id'])) {
					$data['id'] = $data['id'][ 0 ];
				}

				$conditions[] = 'a.id = ' . intval($data['id']);

				$sql =	'SELECT a.act_statuses_id, b.estimate_managers_id, b.average_managers_id ' .
						'FROM ' . $this->tables[0] . ' AS a ' .
						'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
						'WHERE ' . implode(' AND ', $conditions);
				$row = $db->getRow($sql);

				$act_statuses = array();
                    
				switch ($Authorization->data['roles_id']) {
					case ROLES_MANAGER:
						if ($Authorization->data['permissions']['Accidents_KASKO']['updateActs'] && (in_array($row['average_managers_id'], $Authorization->data['managers']))) {//аварком
							$act_statuses[] = ACCIDENT_STATUSES_INVESTIGATION;
                            $act_statuses[] = ACCIDENT_STATUSES_COORDINATION;
                            $act_statuses[] = ACCIDENT_STATUSES_SUSPENDED;
							if ($data['partial_return']) {
								$act_statuses[] = ACCIDENT_STATUSES_RESOLVED;
							}
						}
                        if ($Authorization->data['permissions']['Accidents_KASKO']['updateActsAll']) { //начальник аваркомов
							$act_statuses[] = ACCIDENT_STATUSES_INVESTIGATION;
							$act_statuses[] = ACCIDENT_STATUSES_COORDINATION;
                            $act_statuses[] = ACCIDENT_STATUSES_SUSPENDED;
						}
						if ($Authorization->data['permissions']['AccidentActs']['updateApproval']) {
							$act_statuses[] = ACCIDENT_STATUSES_INVESTIGATION;
							$act_statuses[] = ACCIDENT_STATUSES_COORDINATION;
							$act_statuses[] = ACCIDENT_STATUSES_APPROVAL;
                            $act_statuses[] = ACCIDENT_STATUSES_SUSPENDED;
							if ($data['partial_return']) {
								$act_statuses[] = ACCIDENT_STATUSES_RESOLVED;
							}
						}
						/*if ($Authorization->data['permissions']['AccidentActs']['getAccidentActs']) {
							$act_statuses[] = ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY;
						}*/
						break;
					case ROLES_ADMINISTRATOR:
						$act_statuses = array(
							ACCIDENT_STATUSES_INVESTIGATION,
							//ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY,
							ACCIDENT_STATUSES_COORDINATION,
							ACCIDENT_STATUSES_APPROVAL,
							ACCIDENT_STATUSES_PAYMENT,
                            ACCIDENT_STATUSES_RESOLVED,
							ACCIDENT_STATUSES_SUSPENDED,
							ACCIDENT_STATUSES_DEFECTS);
						break;
				}

				if (!in_array($row['act_statuses_id'], $act_statuses)) {
					$result = parent::checkPermissions($action, $data, true);
				}

				break;			
		}

        return $result;
    }

    function factory($data, $type=null) {

        if (!$type) {
            $type = ProductTypes::get($data['product_types_id']);
        }

        if($data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE)
            $type = 'KASKO';
			
		if($data['product_types_id'] == PRODUCT_TYPES_PRODUCT_TYPES_ONE_SHIPPING || $type == 'OneShipping'){
            $type = 'Cargo';
        }

        require_once 'AccidentActs/' . $type . '.class.php';

        $class = 'AccidentActs_' . $type;

        $obj =& new $class($data);

        return $obj;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

		unset($this->formDescription['fields'][ $this->getFieldPositionByName('description_average') ]);

        $hidden['do'] = $data['do'];

        $this->setTables('show');
        $this->setShowFields();

		$fields[] = 'step';
		$fields[] = 'product_types_id';

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }
		
		$add_fields = array();
		$add_fields[] = PREFIX . '_accidents_acts.accidents_acts_transfer_id';
		$add_fields[] = PREFIX . '_accidents_acts_transfer.number as transfer_number';
		
		$tables_count = $this->tables;
		$this->tables[] = PREFIX . '_accidents_acts_transfer' ;
		$conditions_count = $conditions;
		$conditions[] = 'IF(' . PREFIX . '_accidents_acts.accidents_acts_transfer_id > 0, ' . PREFIX . '_accidents_acts_transfer.id = ' . PREFIX . '_accidents_acts.accidents_acts_transfer_id, 1)';
		
        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' . implode(', ', $add_fields) . ' FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' GROUP BY ' . PREFIX . '_accidents_acts.id ORDER BY ';
			$sql_count    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $tables_count) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions_count) . ' GROUP BY ' . PREFIX . '_accidents_acts.id ORDER BY ';
        } else {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' . implode(', ', $add_fields) . ' FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' GROUP BY ' . PREFIX . '_accidents_acts.id ORDER BY ';
        }

        $total = $db->getOne(transformToGetCount($sql_count));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

		$list = $db->getAll($sql);

        $this->changePermissions($total);
		
		include $template;
    }

    function getReadonly($select, $close=false) {
        return ($this->mode == 'update' && !$close)
			? ''
			: (($select) ? 'disabled' : 'readonly') . ' style="color: #666666; background-color: #f5f5f5;"';
    }

    function getListValue($field, $data) {

        return Accidents::getListValue($field, $data);
	}

	function create($data) {
        global $db;

        $data = array_merge($data, array(AccidentMessages::getAnswerValues($data['id'])));
		
		$data['accident_messages_id'] = $data['id'];

		$data['step'] = 4;

        $sql = 'SELECT acts.id, acts.amount, acts.act_statuses_id ' .
               'FROM ' . PREFIX . '_accidents_acts as acts ' .
               'JOIN ' . PREFIX . '_accidents_acts as acts2 ON acts.accidents_id = acts2.accidents_id ' .
               'WHERE acts.id = acts2.id AND acts2.accidents_id = ' . intval($data['accidents_id']) . ' AND acts2.act_statuses_id IN(' . ACCIDENT_STATUSES_INVESTIGATION . ',' . ACCIDENT_STATUSES_COORDINATION . ')';// .
               //'HAVING MAX(acts2.id) = acts.id';
        $last_act = $db->getRow($sql);

        if (sizeof($last_act)) {
            $data['not_this_acts_id'] = $last_act['id'];
        }

		if (strlen($data[0]['payment_document_date'])) {
			$data['payment_document_number'] = $data['payment_document_number'] . ' від ' . date('d.m.Y', strtotime($data[0]['payment_document_date'])) . ' ' . 
				(intval($data['calculation_car_services_id']) ? CarServices::getTitle($data['calculation_car_services_id']) : CarServices::getTitle($data['result_calculation_car_services_id']));
		} else {
			$data['payment_document_number'] = $data['payment_document_number'] . ' ' .  
				(intval($data['calculation_car_services_id']) ? CarServices::getTitle($data['calculation_car_services_id']) : CarServices::getTitle($data['result_calculation_car_services_id']));;
		}
        $data = $this->getPreviousActsValues($data);

		$data['amount_residual'] = $data[0]['amount_residual'];

        if (/*$last_act['amount'] == 0 && */(in_array($last_act['act_statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_COORDINATION)))) {
            $data['id'] = $last_act['id'];
            $data['step'] = 5;
            $data['extent_damage_percent'] = '';
            $data['message'] = 1;
            if(!$data['extent_damage_percent']) $data['extent_damage_percent'] = 70;
			$this->load($data);
        } else {
            $data['step'] = 5;
			$data['message'] = 1;
            $data['extent_damage_percent'] = 70;
			$this->add($data);
        }
	}

	function setConstants(&$data) {

		parent::setConstants($data);

		$accident_statuses_id = $data['accident_statuses_id'];
		$data = array_merge($data, $this->getPolicyValues($data['accidents_id']));

		if ($accident_statuses_id) {
			$data['accident_statuses_id'] = $accident_statuses_id;
		}

		$data['estimate_managers_id']	= Accidents::getManagersId();
		$data['average_managers_id']	= Accidents::getManagersId();

		$data['accident_statuses_id']	= ACCIDENT_STATUSES_INVESTIGATION;

		if (is_array($data['document'])) {
			foreach ($data['document'] as $key => $value) {
				$data['document'][ $key ] = htmlspecialchars($this->replaceTags(trim($value)));
			}
		}

		$data['documents'] = (is_array($data['document'])) ? implode($this->documentsDelimiter, $data['document']) : '';

		$data['payment_statuses_id'] = PAYMENT_STATUSES_NOT;
	}

    function showForm($data, $action, $actionType=null, $template=null) {
		$Accidents = Accidents::factory($data, ProductTypes::get($data['product_types_id']));

		$Accidents->header($data);

        parent::showForm($data, $action, $actionType, $template);

        //$Accidents->footer($data);
    }

    //формируем номера страхового акта
    function setNumber($accidents_id, $id, $data=null) {
        global $db;

        $sql =  'SELECT COUNT(*) ' .
                'FROM ' . PREFIX . '_accidents_acts ' .
                'WHERE accidents_id = ' . intval($accidents_id) . ' AND id <= ' . intval($id);
        $number = $db->getOne($sql);

        $conditions[] = 'a.accidents_id = ' . intval($accidents_id);

        $sql = 'SELECT a.act_type, a.insurance, b.subNumber,a.act_statuses_id ' .
               'FROM ' . PREFIX . '_accidents_acts as a ' .
               'JOIN ' . PREFIX . '_accidents as b ON a.accidents_id = b.id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'ORDER BY a.id DESC LIMIT 2';
        $list = $db->getAll($sql);//выбираем текущий и пердыдущий акт

        if(in_array($list[1]['insurance'], array(2,3)) && $list[0]['insurance'] == 1 && $list[1]['act_statuses_id'] == ACCIDENT_STATUSES_RESOLVED && $number-1 > $list[0]['subNumber']) {  //если последний акт с отказом, а текущий с выплатой, то используем subNumber для установки номера акта
            $this->setSubNumber($accidents_id, $list[0]['subNumber']);
        }

        //проверка на учет в резерв (для бухгалтерии)
        if($list[0]['act_type'] == 2) {
            $number .= '-B';
        }elseif($list[0]['act_type'] == 3) {
            $number .= '-O';
        }elseif($list[0]['act_type'] == 4) {
			$sql =  'SELECT COUNT(*) ' .
					'FROM ' . PREFIX . '_accidents_acts ' .
					'WHERE accidents_id = ' . intval($accidents_id) . ' AND id <= ' . intval($data['old_acts_id']);
			$number = $db->getOne($sql) . '-' . $number . '-C';
		}

        $sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
               'SET ' .
               'number = ' .
                    '(SELECT IF(subNumber IS NULL, CONCAT(number, \'-\', ' . $db->quote($number) . '), CONCAT(number,\'/\',subNumber, \'-\', ' . $db->quote($number) . ')) ' .
                    'FROM ' . PREFIX . '_accidents WHERE id = '. $accidents_id . ') ' .
               'WHERE id = ' . intval($id);
        $db->query($sql);
    }

	function getDocumentTypes($data) {
		global $db;

        $conditions[] = 'product_types_id IN( ' . $this->product_types_id.',1)';
        $conditions[] = 'id <> ' . DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT;
		$conditions[] = 'declaration & 8';

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

	function updateDocumentTypes($id, $data) {
		global $db;

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_accident_act_document_type_assignments ' .
				'WHERE acts_id = ' . intval($id);
		$db->query($sql);

		if (is_array($data['product_document_types'])) {
			foreach ($data['product_document_types'] as $product_document_types_id) {
				$sql =	'INSERT INTO ' . PREFIX . '_accident_act_document_type_assignments SET ' .
						'acts_id = ' . intval($id) . ', ' .
						'product_document_types_id = ' . intval($product_document_types_id) . ', ' .
						'created = NOW()';
				$db->query($sql);
			}
		}
	}

    function prepareFields($action, &$data) {
        $data = parent::prepareFields($action, $data);

		$data = array_merge($data, $this->getPolicyValues($data['accidents_id']));

		$this->loadDocuments($data, $data['accidents_id'], $data['id']);

		$data['step'] = 4;

        return $data;
    }

    function getSumAmounts($accidents_id) {
        global $db;

        $sql = 'SELECT SUM(amount) FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE accidents_id = ' . $accidents_id . ' ' .
               'GROUP BY id';
        return $db->getOne($sql);
    }

    function getCount($accidents_id) {
        global $db;

        $sql = 'SELECT COUNT(id) FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE accidents_id = ' . intval($accidents_id);
        return $db->getOne($sql);
    }

    function loadApproval($data) {
        global $db, $Log, $Authorization;

		if (is_array($data['id'])) $data['id'] = $data['id'][0];
		
		$sql = 'SELECT * FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($data['id']);
		$act = $db->getRow($sql);
		
		if (intval($act['request_id'])) {
			$sql = 'SELECT * FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($act['request_id']);
			$message = $db->getRow($sql);
			
			if ($message['statuses_id'] != ACCIDENT_MESSAGE_STATUSES_ANSWER) {
				$Log->add('error', 'Поставка ЗЧ не підтверджена.');			
				$redirect = ($_SERVER['HTTP_REFERER'] && !eregi('index\.php$', $_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
				header('Location: ' . $redirect);
				exit;
			}
		}

		/*if ($this->getActStatusesId($data['id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY && !$this->isAccidentsActsInTransfer($data['id'])) {
			$Log->add('error', 'Акт не включено до реєстру.');			
			$redirect = ($_SERVER['HTTP_REFERER'] && !eregi('index\.php$', $_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
            header('Location: ' . $redirect);
            exit;
		}
		if ($this->getActStatusesId($data['id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY && AccidentsActsTransfer::getStatuses($this->getAccidentsActsTransferId($data['id'])) < 3) {
			$Log->add('error', 'Реєстр, до якого включений акт, необхідно перевести в статус <b>\'Відзвітований\'</b> або <b>\'Закритий\'</b>.');			
			$redirect = ($_SERVER['HTTP_REFERER'] && !eregi('index\.php$', $_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
            header('Location: ' . $redirect);
            exit;
		}*/
		
		/*if ($this->permissions['getAccidentActs'] && $this->getActStatusesId($data['id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY) {
			$this->permissions['updateApproval'] = true;
		}*/
        $this->checkPermissions('updateApproval', $data);

		$this->formDescription = $this->approvalFormDescription;
		$this->permissions['update'] = true;

		return $this->load($data, true, 'updateApproval', 'update', 'approval.php');
    }

	function updateApproval($data) {
		global $db, $Log, $Authorization;

		/*if ($this->permissions['getAccidentActs'] && $this->getActStatusesId($data['id']) == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY) {
			$this->permissions['updateApproval'] = true;
		}*/
		$this->checkPermissions('updateApproval', $data);

        $this->formDescription = $this->approvalFormDescription;
		//if (in_array($data['act_statuses_id'], array(ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY))) {
		if (in_array($data['act_statuses_id'], array(ACCIDENT_STATUSES_COORDINATION, ACCIDENT_STATUSES_APPROVAL))) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('date') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('sign_suspended') ]['display']['update'] = false;
		}

        if ($_POST['do'] == $this->object . '|updateApproval') {

			$this->permissions['update'] = true;

			switch (intval($data['accident_statuses_id'])) {
				case ACCIDENT_STATUSES_SUSPENDED:
					$data['accident_statuses_id'] = ACCIDENT_STATUSES_SUSPENDED;
					$data['act_statuses_id'] = ACCIDENT_STATUSES_RESOLVED;
					break;
				default:
					$data['accident_statuses_id'] = $data['act_statuses_id'];
			}
            if (Accidents::getAccidentStatusesId($data['accidents_id']) == $data['accident_statuses_id'] || Accidents::getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT && $data['accident_statuses_id'] == ACCIDENT_STATUSES_INVESTIGATION) {
			    $Log->add('error', 'Справа вже знаходиться в статусі в якій Ви хочете перевести.');
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Accidents|' . $this->mode .'Acts&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
		    } else {//_dump($data);exit;
				$sql = 'SELECT act_statuses_id FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($data['id']);
				if (intval($db->getOne($sql)) == ACCIDENT_STATUSES_SUSPENDED) {
					$this->formDescription['fields'][ $this->getFieldPositionByName('date') ]['display']['update'] = false;
				}
				
				if ($data['accident_statuses_id'] == ACCIDENT_STATUSES_SUSPENDED) {
					$this->formDescription['fields'][ $this->getFieldPositionByName('sign_suspended') ]['display']['update'] = true;
					$data['sign_suspended'] = 1;
				}
				
				if (Accidents::checkCompromise($data['accidents_id'], 1) && !Accidents::checkCompromise($data['accidents_id'], 2)) {
					$Log->add('error', 'Для компромісних справ необхідно проставити <b>Дату компромісного рішення</b>');
					header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Accidents|' . $this->mode .'Acts&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
					exit;
				}				
                if (Form::update($data, false, false)) {				
					if ($data['act_statuses_id'] == ACCIDENT_STATUSES_RESOLVED && $data['act_type'] == ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL) {
						$sql = 'SELECT payments.date, calendar2.amount, calendar2.id as calendar_id ' .
							   'FROM ' . PREFIX . '_accident_payments as payments ' .
							   'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON payments.payments_calendar_id = calendar.id ' .
							   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
							   'JOIN ' . PREFIX . '_accident_payments_calendar as calendar2 ON acts.new_acts_id = calendar2.acts_id ' .
							   'WHERE acts.new_acts_id = ' . intval($data['id']);
							   //_dump($sql);
						$payment = $db->getRow($sql);
						
						$sql = 'INSERT INTO ' . PREFIX . '_accident_payments ' .
							   'SET date = ' . $db->quote($payment['date']) . ', ' .
									'amount = ' . $db->quote($payment['amount']) . ', ' .
									'payments_calendar_id = ' . intval($payment['calendar_id']) . ', ' .
									'accidents_id = ' . intval($data['accidents_id']) . ', ' .
									'modified = NOW(), created = NOW()';
						$db->query($sql);

						Accidents::setPaymentStatus($data['accidents_id']);
					}
					
					if ($data['act_statuses_id'] == ACCIDENT_STATUSES_PAYMENT) {

                        //формируем восстановительный ремонт
                        $sql =	'SELECT b.id, b.acts_id, b.payment_types_id, b.number, b.payment_statuses_id, c.act_type, b.recipient_types_id, b.recipients_id ' .
                                'FROM ' . PREFIX . '_accident_payments_calendar AS b ' .
                                'LEFT JOIN ' . PREFIX . '_accident_payments AS a ON a.payments_calendar_id = b.id ' .
                                'LEFT JOIN ' . PREFIX . '_accidents_acts AS c ON b.acts_id = c.id ' .
                                'WHERE b.accidents_id = ' . intval($data['accidents_id']);
                        $list = $db->getAll($sql);

                        foreach($list as $row) {
                            if (in_array($row['payment_types_id'], array(PAYMENT_TYPES_COMPENSATION, PAYMENT_TYPES_PART_PREMIUM)) && $row['payment_statuses_id'] == PAYMENT_STATUSES_NOT && $row['act_type'] != ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL) {
                                if ($row['payment_types_id'] == PAYMENT_TYPES_COMPENSATION && $row['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE) {
                                    RecoveryRepairs::checkAndGenerate($row['id'], $row['recipients_id']);
								}
                            }
                        }
                        //конец формирования восстановительного ремонта

						Accidents::updateMonitoring(array('accidents_id' => $data['accidents_id'], 'monitoring_managers_id' => 4427));
						Accidents::insertAccidentsComment(array('accidents_id' => $data['accidents_id'], 'monitoring_managers_id' => 4427));
					}
				
					$sql = 'UPDATE ' . PREFIX . '_accidents SET resolved_date = getResolvedDate(' . intval($data['accidents_id']) . ', 0) WHERE id = ' . intval($data['accidents_id']);
					$db->query($sql);

                    $sql = 'SELECT SUM(act_statuses_id)/count(id) as degree ' .
                           'FROM ' . PREFIX . '_accidents_acts ' .
                           'WHERE accidents_id = ' . intval($data['accidents_id']);
                    $degree = $db->getOne($sql);
                    if(intval($degree) == ACCIDENT_STATUSES_RESOLVED || $data['act_statuses_id'] != ACCIDENT_STATUSES_RESOLVED) {
                        $Accidents = new Accidents($data);
                        $Accidents->changeAccidentStatus($data['accidents_id'], $data['accident_statuses_id']);
                    }
					
					$this->closedTransferList($data['id']);

					$date = $db->getOne('SELECT date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($data['id']));
					if ($date != '0000-00-00') $this->setTheoryLimitPaymentDate($data['id'], 1);
					else $this->setTheoryLimitPaymentDate($data['id'], 2);
					
					if ($data['act_statuses_id'] == ACCIDENT_STATUSES_COORDINATION && $data['product_types_id'] == PRODUCT_TYPES_KASKO) {	
						$this->setCarServicesRequest($data['id'], $data);
					}

                    $params['title']    = $this->messages['single'];
                    $params['id']       = $data['id'];
                    $params['storage']  = $this->tables[0];

                    $Log->add('confirm', 'Страховий акт змінено.' , $params);

                    header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Accidents|' . $this->mode .'Acts&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                    exit;
                }
            }
                $data = $this->replaceSpecialChars($data, 'update');

        } else {
			$data = $this->load($data, false, 'updateApproval');
        }

		$data = $this->load($data, false, 'updateApproval');
        return $this->showForm($data, 'updateApproval', 'update', 'approval.php');
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

        $sql =  'SELECT id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE id IN(' . implode(', ', $data['id']) . ') AND payment_statuses_id = ' . PAYMENT_STATUSES_NOT . ' AND act_statuses_id < ' . ACCIDENT_STATUSES_COORDINATION;
        $data['id'] = $db->getCol($sql);

		if (is_array($data['id']) && sizeOf($data['id'])) {
			//удаляем ссылки на документы
			$sql =	'DELETE ' .
					'FROM ' . PREFIX . '_accident_act_document_type_assignments ' .
					'WHERE acts_id IN(' . implode(', ', $data['id']) . ')';
			$db->query($sql);

			$AccidentDocuments = new AccidentDocuments($data);
			$AccidentDocuments->permissions['delete'] = true;

			//удаляем документы
			$sql =	'SELECT id ' .
					'FROM ' . $AccidentDocuments->tables[0] . ' ' .
					'WHERE acts_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentDocuments->delete($toDelete, false, false);

            //удаляем платежи
            $AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
					'WHERE acts_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentPaymentsCalendar->delete($toDelete, false, false);

			return parent::deleteProcess($data, $i, $folder);
		}
	}

	function downloadFileInWindow($data) {
		global $db;

		$data['file'] = unserialize($data['file']);

        $this->checkPermissions('view', $data['file']);

		$conditions[] = 'product_document_types_id = ' . DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT;
		$conditions[] = 'acts_id = ' . intval($data['file']['id']);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_accident_documents ' .
				'WHERE ' . implode(' AND ', $conditions);
		$data['file'] = $db->getRow($sql);

		$data['file'] = serialize( $data['file'] );

		$AccidentDocuments = new AccidentDocuments($data);
		$AccidentDocuments->downloadFileInWindow($data);
	}

    function setSubNumber($accidents_id, $subNumber = null) {
        global $db;

        $subNumber++;
        if(is_null($subNumber)) {
            $sql = 'UPDATE '.PREFIX.'_accidents ' .
                   'SET subNumber = 1 ' .
                   'WHERE id = '. $accidents_id;
        } else {
            $sql = 'UPDATE '.PREFIX.'_accidents ' .
                   'SET subNumber = ' . $subNumber . ' ' .
                   'WHERE id = '. $accidents_id;
        }
        $db->query($sql);
    }

    function getPreviousActsValues($data){
        global $db, $Authorization;
        switch($data['product_types_id']){
            case PRODUCT_TYPES_KASKO:
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                $suffix = 'kasko';
                $condition = ' AND ' . $suffix . '_acts.not_proportionality = 0 ';
                break;
            case PRODUCT_TYPES_GO:
                $suffix = 'go';
                $condition = ' ';
                break;
			case PRODUCT_TYPES_PROPERTY:
				$suffix = 'property';
				$condition = ' ';
				break;
			case PRODUCT_TYPES_CARGO_CERTIFICATE:
			case PRODUCT_TYPES_ONE_SHIPPING:
				$suffix = 'cargo';
				$condition = ' ';
				break;


        }

        $sql = 'SELECT acts.id, ' .
                    //'CONVERT(GROUP_CONCAT(acts.payment_document_number) using utf8) as payment_document_number, ' .
                    //'SUM(' . $suffix . '_acts.amount_details) as amount_details, ' .
                    //'SUM(' . $suffix . '_acts.amount_work) as amount_work, ' .
                    //'SUM(' . $suffix . '_acts.amount_material) as amount_material ' .
					'acts.payment_document_number as payment_document_number, ' .
					$suffix . '_acts.amount_details as amount_details, ' .
                    $suffix . '_acts.amount_work as amount_work, ' .
                    $suffix . '_acts.amount_material as amount_material ' .
               'FROM ' . PREFIX . '_accidents_acts as acts ' .
               'JOIN ' . PREFIX . '_accidents_' . $suffix . '_acts as ' . $suffix . '_acts ON acts.id = ' . $suffix . '_acts.accidents_acts_id ' .
               'WHERE acts.accidents_id = ' . intval($data['accidents_id']) . ' AND acts.id <> ' . intval($data['not_this_acts_id']) . $condition .
               ' ORDER BY acts.id DESC LIMIT 1';
        $values = $db->getRow($sql);

        if($values){
            $data['payment_document_number'] = htmlspecialchars_decode(str_replace('&quot;', '"', $values['payment_document_number'])) . ', ' . $data['payment_document_number'];
            $data['amount_details'] = $values['amount_details'] + $data['amount_details'];
            $data['amount_work'] = $values['amount_work'] + $data['amount_work'];
            $data['amount_material'] = $values['amount_material'] + $data['amount_material'];
			
			$data['amount_details_previous'] = $values['amount_details'];
			$data['amount_work_previous'] = $values['amount_work'];
			$data['amount_material_previous'] = $values['amount_material'];
        }
        return $data;
    }

    function roundNumber($number, $decimal) {
        $parts = explode('.', $number);
        if (strlen($parts[1]) > $decimal) {
            $number = $this->roundNumber(round($number, strlen($parts[1]) - 1), $decimal);
        }
        return $number;
    }
	
	function getNumber($id) {
		global $db;
		
		$sql = 'SELECT number FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id);
		
		return $db->getOne($sql);
	}
	
	function changeInRepairInWindow($data) {
		global $db;
		
		$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
			   'SET in_repair = ' . intval($data['value']) . ' ' .
			   'WHERE id = ' . intval($data['id']);
		$db->query($sql);
		
		/*if (intval($data['value'])) {
			Accidents::insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Акт номер: </label>' . $this->getNumber($data['id']) . '</b> не "В ремонті"'));
		} else {
			Accidents::insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Акт номер: </label>' . $this->getNumber($data['id']) . '</b> "В ремонті"'));
		}*/
		echo '{"value" : "' . $data['value'] . '", "number" : "' . $this->getNumber($data['id']) . '"}';
	}
	
	function getAccidentsId($id) {
		global $db;
		
		$sql = 'SELECT accidents_id ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		
		return intval($db->getOne($sql));
	}
	
	function closedTransferList($acts_id) {
		global $db;
		
		$sql = 'SELECT accidents_acts_transfer_id FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($acts_id);
		$transfer_id = $db->getOne($sql);
		
		if (intval($transfer_id)) {
			$sql = 'SELECT COUNT(*) ' .
				   'FROM ' . PREFIX . '_accidents_acts ' .
				   'WHERE act_statuses_id IN(' . ACCIDENT_STATUSES_INVESTIGATION . ', ' . ACCIDENT_STATUSES_COORDINATION . ', ' . ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY . ') AND accidents_acts_transfer_id = ' . intval($transfer_id);
			$count = $db->getOne($sql);
			
			if (intval($count) == 0) {
				$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer SET statuses_id = 4, closed_date = NOW() WHERE id = ' . intval($transfer_id);
				$db->query($sql);
			}
		}
	}
	
	function getActStatusesId($id) {
		global $db;
		
		$sql = 'SELECT act_statuses_id ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function isAccidentsActsInTransfer($id) {
		global $db;
		
		$sql = 'SELECT accidents_acts_transfer_id ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		if (intval($db->getOne($sql))) {
			return true;
		} else {
			return false;
		}
	}
	
	function getAccidentsActsTransferId($id) {
		global $db;
		
		$sql = 'SELECT accidents_acts_transfer_id ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
		return $db->getOne($sql);
	}

	function setDateInWindow($data) {
		global $db;
		
		$sql = 'SELECT date ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($data['id']);
		$old_date = $db->getOne($sql);
		
		$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
			   'SET date = ' . $db->quote($data['date']) . 
			   'WHERE id = ' . intval($data['id']);
		$db->query($sql);
		
		if ($data['date'] == '0000-00-00') $type = 2;
		else $type = 1;
		
		Accidents::insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label>Дату акту змінено з <b>' . date('d.m.Y', strtotime($old_date)) . '</b> на <b>' . date('d.m.Y', strtotime($data['date'])) . '</b></label>'));
		
		$this->setTheoryLimitPaymentDate($data['id'], $type);
	}	
	
	function getActType($id) {
		global $db;
		
		$sql = 'SELECT act_type ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getActAmount($id) {
		global $db;
		
		$sql = 'SELECT amount ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
}

?>