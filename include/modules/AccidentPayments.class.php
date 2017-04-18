<?
/*
 * Title: accident payments class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';

class AccidentPayments extends Form {

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
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'accidents_id',
							'description'		=> 'Справа',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> -1,
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'payments_calendar_id',
							'description'		=> 'Платiж',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> -1,
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата сплати',
					        'type'				=> fldDate,
					        'input'				=> true,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'amount',
							'description'		=> 'Сума, грн.',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 4,
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер платiжки',
					        'type'				=> fldText,
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
							'orderPosition'		=> 2,
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'number_payment_order',
							'description'		=> 'Номер платіжного доручення',
					        'type'				=> fldText,
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
							'table'				=> 'accident_payments'),
						array(
							'name'				=> 'codEA',
							'description'		=> 'Код 1С',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'accident_payments'),
                        array(
                            'name'              =>  'is_return',
                            'description'       =>  'Повернуто',
                            'type'              =>  fldBoolean,
                            'display'           =>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'change'        => true,
                                    'view'        	=> false,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'			=> 5,
                            'width'				    => 100,
                            'table'                	=> 'accident_payments'),
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
							'orderPosition'		=> 6,
                            'width'             => 100,
							'table'				=> 'accident_payments'),
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function AccidentPayments($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Cплати';
		$this->messages['single'] = 'Cплата';
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
					'delete'	=> true,
					'change'	=> true);
				break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				$this->permissions['show'] = true;
				if (in_array($Authorization->data['id'], array(6556, 8904))) {
                    			$this->permissions['change'] = true;
		                }
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

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		$conditions[] = 'accidents_id = ' . intval($data['accidents_id']);

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
	
	
	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log;
        $this->checkPermissions('insert', $data);
		unset($this->formDescription['fields'][ $this->getFieldPositionByName('payments_calendar_id') ]);
        $data = $this->replaceSpecialChars($data, 'insert');

        $this->setConstants($data);

        $this->checkFields($data, 'insert');

        if ($checkFieldsAndReturn) {
            return;
        }

        if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'insert');
        } else {
			//вызов службы по вставке платежа
			$xml='<resultset>
			<row>
				<docNumber>'.$data['number'].'</docNumber>
				<docDate>'.$data['date_year'].'-'.$data['date_month'].'-'.$data['date_day'].'</docDate>
				<amount>'.doubleval($data['amount']).'</amount>
				<codEA>'.$data['codEA'].'</codEA>
				<paymentType>6</paymentType>
			</row>
			</resultset>';

			try {
	        	$url = 'https://e-insurance.in.ua/synchronization/assistance/payments.php?WSDL';
				$client = new SoapClient($url,array('trace' => 1));
			    $result=$client->addAssistancePayments(array("payments" => $xml));
			    echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
				echo "Response:\n" . $client->__getLastResponse() . "\n";
			} catch (Exception $e) {
				_dump($e);
			}
//exit;
            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
		parent::deleteProcess($data, $i, $folder);

		Accidents::setPaymentStatus($data['accidents_id']);
	}

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;

		if (parent::update($data, false, true)) {

			Accidents::setPaymentStatus($data['accidents_id']);

			if ($redirect) {

				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

	function change($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $db, $Log;
		
		$change = false;

		if ($this->checkNumberPaymentOrder($data, 2) && parent::change($data, false, true)) {
			$change = true;

			Accidents::setPaymentStatus($data['accidents_id']);
			
			$sql = 'SELECT product_types_id ' .
					'FROM ' . PREFIX . '_accidents ' .
					'WHERE id = ' . intval($data['accidents_id']);
			$product_types_id = intval($db->getOne($sql));
			
			if ($product_types_id == PRODUCT_TYPES_GO) {
				$sql = 'SELECT id, payments_calendar_id, is_return, date, amount, mtsbu_date ' .
						'FROM ' . PREFIX . '_accident_payments ' .
						'WHERE accidents_id = ' . intval($data['accidents_id']) . ' ' .
						'ORDER BY date';
				$list = $db->getAll($sql);
				for ($i=1; $i<sizeof($list); $i++) {
					if (intval($list[$i-1]['payments_calendar_id']) == intval($list[$i]['payments_calendar_id']) && intval($list[$i-1]['is_return']) == 1 && (string)$list[$i-1]['amount'] == (string)$list[$i]['amount']) {
						$sql = 'UPDATE ' . PREFIX . '_accident_payments SET mtsbu_date = ' . $db->quote($list[$i-1]['mtsbu_date']) . ' WHERE id = ' . intval($list[$i]['id']);
					} elseif (intval($list[$i-1]['payments_calendar_id']) == intval($list[$i]['payments_calendar_id']) && (string)$list[$i-1]['amount'] == (string)$list[$i]['amount']) {
						$sql = 'UPDATE ' . PREFIX . '_accident_payments SET mtsbu_date = \'0000-00-00\' WHERE id = ' . intval($list[$i]['id']);
					}
					$db->query($sql);
				}
			}			
		}
		
		if ($redirect) {
			$params['title']		= $this->messages['single'];
			$params['id']			= $data['id'];
			$params['storage']		= $this->tables[0];

			if ($change) {
				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			}

			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		} else {
			return $params['id'];
		}
    }
	
	function checkNumberPaymentOrder($data, $mode) {
		global $db, $Log;
		
		switch ($mode) {
			case 1:
				$sql = 'SELECT payments.id, date_format(payments.date, \'%d.%m.%Y\') as date, payments.number, payments.amount, IF(calendar.recipient_types_id = ' . RECIPIENT_TYPES_ASSURED . ', calendar.payment_bank, calendar.recipient) as recipient ' .
					   'FROM ' . PREFIX . '_accident_payments as payments ' .
					   'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON payments.payments_calendar_id = calendar.id ' .
					   'WHERE (payments.number_payment_order IS NULL OR payments.number_payment_order = \'\') AND calendar.payment_types_id = ' .PAYMENT_TYPES_COMPENSATION . ' AND calendar.accidents_id = ' . intval($data['id']);
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					$message = 'Потрібно ввести номер платіжного доручення для: ';
					foreach ($list as $index => $row) {
						if ($index) {
							$message = $message . ', ';
						}
						$message = $message . $row['recipient'] . '(' . $row['date'] . ' р., ' . $row['amount'] . ' грн., ' . $row['number'] . ')';
					}
					$Log->add('error', $message);
					return false;
				} else {
					return true;
				}
				break;
			case 2:
				$payments = array();
				foreach ($data['is_return'] as $id => $key) {
					$sql = 'SELECT date_format(payments.date, \'%d.%m.%Y\') as date, payments.number, payments.amount, IF(calendar.recipient_types_id = ' . RECIPIENT_TYPES_ASSURED . ', calendar.payment_bank, calendar.recipient) as recipient ' .
						   'FROM ' . PREFIX . '_accident_payments as payments ' .
						   'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON payments.payments_calendar_id = calendar.id ' .
						   'JOIN ' . PREFIX . '_accident_payments as payments2 ON calendar.id = payments2.payments_calendar_id ' .
						   'WHERE payments.id <> payments2.id AND payments2.id = ' . intval($id) . ' AND (payments.number_payment_order IS NULL OR payments.number_payment_order = \'\') AND calendar.payment_types_id = ' .PAYMENT_TYPES_COMPENSATION;
					$row = $db->getRow($sql);
					if (is_array($row) && sizeof($row)) {
						$payments[] = $row;
					}
				}
				if (sizeof($payments)) {
					$message = 'Потрібно ввести номер платіжного доручення для: ';
					foreach ($payments as $index => $row) {
						if ($index) {
							$message = $message . ', ';
						}
						$message = $message . $row['recipient'] . '(' . $row['date'] . ' р., ' . $row['amount'] . ' грн., ' . $row['number'] . ')';
					}
					$Log->add('error', $message);
					return false;
				} else {
					return true;
				}
				break;
			default:
				return true;
				break;
		}
	}

}

?>