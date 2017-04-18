<?
/*
 * Title: paymnets class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
require_once 'Payments.class.php';

class PaymentsCalendar extends Form {

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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер',
					        'type'				=> fldUnique,
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'contragent',
							'description'		=> 'Отримувач',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 2,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'policy_number',
							'description'		=> 'Номер полiсу',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'payment_types_id',
							'description'		=> 'Тип платежа',
					        'type'				=> fldRadio,
					        'list'				=> array(
					        						1 => 'Акт Каско',
					        						2 => 'Акт ГО',
													//3 => 'Акт ДГО',
													//4 => 'Cтрах. акт вiдшкодування КАСКО',
													5 => 'Каско/ГО/ДГО',
                                                    6 => 'Мастер СТО'
													),
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
							'orderPosition'		=> 4,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'person_types_id',
							'description'		=> 'Тип контрагента',
					        'type'				=> fldRadio,
					        'list'				=> array(
					        						1 => 'фiз особа',
					        						2 => 'юр особа'),
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
							'table'				=> 'payments_calendar'),
						
						array(
							'name'				=> 'code',
							'description'		=> 'ЕДРПОУ/IПН',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 5,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'account_number',
							'description'		=> 'Рахунок',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 6,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'mfo',
							'description'		=> 'МФО',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 7,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'bank',
							'description'		=> 'Банк',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 8,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'amount',
							'description'		=> 'Сума платежу',
					        'type'				=> fldMoney,
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
							'orderPosition'		=> 9,
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'akt_amount',
							'description'		=> 'Сума по акту',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'payments_calendar'),	
						 array(
                            'name'              => 'payment_statuses_id',
                            'description'       => 'Оплата',
                            'type'              => fldSelect,
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
                            'orderPosition'     => 10,
                            'table'             => 'payments_calendar',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
						array(
							'name'				=> 'agents_lastname',
							'description'		=> 'Агент Призвiще',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'agents_firstname',
							'description'		=> 'Агент Iмя',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'agents_patronymicname',
							'description'		=> 'Агент По батьковi',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'agents_identification_code',
							'description'		=> 'Агент ИНН',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'agreement_number',
							'description'		=> '№ договору',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'agreement_date',
							'description'		=> 'Дата агенського договору',
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
							'table'				=> 'payments_calendar'),	
						array(
							'name'				=> 'agencies_name',
							'description'		=> 'Агенцiя назва',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'agencies_edrpou',
							'description'		=> 'Агенцiя ЕДРПОУ',
					        'type'				=> fldText,
							'maxlength'			=> 8,
							'validationRule'	=> '^([0-9]{8})$',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'akt_date',
							'description'		=> 'Дата акту',
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
							'table'				=> 'payments_calendar'),
						array(
							'name'				=> 'comment',
							'description'		=> 'Призначення платежу',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 11,
							'table'				=> 'payments_calendar'),
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
							'orderPosition'		=> 12,	
							'table'				=> 'payments_calendar'),
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
							'orderPosition'		=> 13,
                            'width'             => 100,
							'table'				=> 'payments_calendar')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 13,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'contragent'
					)
			);

	function PaymentsCalendar($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Платежі';
		$this->messages['single'] = 'Платіж';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'    => true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
		}
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db, $PAYMENT_STATUSES;

		$this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];
		
		$fields['payment_statuses_id']				= $this->formDescription['fields'][ $this->getFieldPositionByName('payment_statuses_id') ];
        $fields['payment_statuses_id']['type']   	= fldMultipleSelect;
        $fields['payment_statuses_id']['list']   	= $PAYMENT_STATUSES;
        $fields['payment_statuses_id']['object'] 	= $this->buildSelect($fields['payment_statuses_id'], $data['payment_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);

		$fields['payment_types_id']				= $this->formDescription['fields'][ $this->getFieldPositionByName('payment_types_id') ];
        $fields['payment_types_id']['type']   	= fldMultipleSelect;
        $fields['payment_types_id']['list']   	= $this->formDescription['fields'][ $this->getFieldPositionByName('payment_types_id') ]['list'];
        $fields['payment_types_id']['object'] 	= $this->buildSelect($fields['payment_types_id'], $data['payment_types_id'], $data['languageCode'], 'multiple size="3"', null, $data);

		//$conditions[] = $this->tables[0] . '.valid = 1';

		if (strlen($data['contragent'])>0) {
			$search_str=trim($data['contragent']);
			$conditions[] = $this->tables[0] . '.contragent like ' . $db->quote($search_str);
		}
		
		if (strlen($data['number'])>0) {
			$search_str=trim($data['number']);
			$conditions[] = $this->tables[0] . '.number like ' . $db->quote($search_str);
		}
		
		if (strlen($data['code'])>0) {
			$search_str=trim($data['code']);
			$conditions[] = $this->tables[0] . '.code like ' . $db->quote($search_str);
		}
		
		 if (is_array($data['payment_statuses_id'])) {
            $fields[] = 'payment_statuses_id';
            $conditions[] = 'payment_statuses_id IN(' . implode(', ', $data['payment_statuses_id']) . ')';
        }
		if (is_array($data['payment_types_id'])) {
            $fields[] = 'payment_types_id';
            $conditions[] = 'payment_types_id IN(' . implode(', ', $data['payment_types_id']) . ')';
        }
		if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.created) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.created) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }
		
		return parent::show($data, $fields, $conditions, $sql, $this->object . '/show.php', $limit);
	}

	function showForm($data, $action, $actionType=null, $template=null) {
		global $db;

		$product_types = array(PRODUCT_TYPES_AUTO,
			PRODUCT_TYPES_KASKO,
			PRODUCT_TYPES_GO,
			PRODUCT_TYPES_DGO);

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_product_types ' .
				'WHERE id IN (' . implode(', ', $product_types) . ') ' .
				'ORDER BY id';
		$data['types'] = $db->getAssoc($sql);

        return parent::showForm($data, $action, $actionType, 'form.php');
    }

	function setValues($data) {
        global $db;

		$sql =  'DELETE FROM ' . PREFIX . '_payments_amounts ' .
				'WHERE payments_id = ' . intval($data['payments_id']) . '  ';
		$db->query($sql);

		if (is_array($data['prod_types'])) {
            foreach ($data['prod_types'] as $id => $row) {
				$sql =  'INSERT INTO ' . PREFIX . '_payments_amounts SET ' .
						'payments_id = ' . intval($data['payments_id']) . ', ' .
						'product_types_id = ' . intval($row['product_types_id']) . ', ' .
						'value = ' . $db->quote($row['value']);
				$db->query($sql);
            }
		}
    }

	function insert($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'insert');

        $data['payments_id'] = parent::insert($data, false);

        if (!$Log->isPresent() && intval($data['payments_id'])) {

            $params['title']		= $this->messages['single'];
            $params['id']           = $data['products_id'];
            $params['storage']      = $this->tables[0];

			$this->setValues($data);

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

	function view($data) {

		$row = parent::view($data);

		$data['payments_id'] = $row['id'];
		
		$fields[]       = 'payments_id';
        $conditions[]   = 'payments_id=' . intval($data['id']);
		
		$Payments = new Payments($data);
        $Payments->show($data, $fields, $conditions);
	}		

	function update($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'update');

        $data['payments_id'] = parent::update($data, false);

        if (!$Log->isPresent() && $data['payments_id']) {

            $params['title']        = $this->messages['single'];
            $params['id']            = $data['payments_id'];
            $params['storage']        = $this->tables[0];

			$this->setValues($data);

            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            }

            return $params['id'];
        }
    }

	/*function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log, $Authorization;

        $sql =	'SELECT id ' .
                'FROM ' . PREFIX . '_payments ' .
                'WHERE payments_id  IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>Отриманні платежі</b>.');
            return false;
        }

        return parent::deleteProcess($data, $i, $folder);
    }*/

	function setPaymentStatus($id) {
        global $db;
	
		$sql =	'SELECT amount ' .
				'FROM ' . PREFIX . '_payments_calendar ' .
				'WHERE id = ' . intval($id);
		$totalAmount = doubleval($db->getOne($sql));

		$sql =	'SELECT SUM(amount) ' .
				'FROM ' . PREFIX . '_payments ' .
				'WHERE payments_id = ' . intval($id);
		$amount = doubleval($db->getOne($sql));

		if ($amount>0) {
			if ($totalAmount > $amount) {
				$payment_statuses_id = PAYMENT_STATUSES_PARTIAL;
			} else if ($totalAmount < $amount) {
				$payment_statuses_id = PAYMENT_STATUSES_OVER;
			} else {
				$payment_statuses_id = PAYMENT_STATUSES_PAYED;
			}
		} else {
			$payment_statuses_id = PAYMENT_STATUSES_NOT;
		}

        $sql =	'UPDATE ' . PREFIX . '_payments_calendar SET ' .
                'payment_statuses_id = ' . intval($payment_statuses_id) . ' ' .
                'WHERE id=' . intval($id);
        $db->query($sql);

    }	

	function createPayment($number, $product_types_id, $id, $person_types_id, $data=null) {
		global $db, $MONTHES;

		$sql =	'SELECT id, payment_statuses_id ' .
				'FROM ' . PREFIX . '_payments_calendar ' .
				'WHERE number = ' . $db->quote($number);
		$row = $db->getRow($sql);

		if (is_array($row) && $row['payment_statuses_id']>PAYMENT_STATUSES_NOT) {
			return; //есть платеж и уже были движения денег
		}

		if ($data['payment_types_id']) {
			$payment_types_id = $data['payment_types_id'];
		} else {
			switch ($product_types_id) {
				case 1:
					$payment_types_id = 5;
					break;
				case PRODUCT_TYPES_KASKO:
					$payment_types_id = 1;
					break;
				case PRODUCT_TYPES_GO:
					$payment_types_id = 2;
					break;
				case PRODUCT_TYPES_DGO:
					$payment_types_id = 3;
					break;
			}
		}
			
		if (($product_types_id==PRODUCT_TYPES_KASKO || $product_types_id==PRODUCT_TYPES_GO  || $product_types_id==PRODUCT_TYPES_DGO  || $product_types_id=1) && $person_types_id == 1 && $payment_types_id != 4) {
			//КАСКО + ГО + ДГО физ лица выплата по АКТу
			$sql =	'SELECT SUM(commission_agent_amount) ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' .
					'WHERE agents_akt_number = ' . $db->quote($number);
			$amount = $db->getOne($sql);

			if (intval($id)==0) {
				$sql = 	'SELECT agents_id ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN '.PREFIX.'_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'WHERE agents_akt_number = ' . $db->quote($number) . ' ' .
						'LIMIT 1';
				$id = $db->getOne($sql);
			}

			if ($amount>0) {
				//загружаем данные физ лица
				$sql =	'SELECT *, date_format(agreement_date, ' . $db->quote('%d.%m.%y') . ') AS agreement_date_date_format ' .
						'FROM ' . PREFIX . '_agents ' .
						'WHERE accounts_id = ' . intval($id);
			  $agent = $db->getRow($sql);

			  if ($product_types_id == 1) //общий акт

				$amount = 0;

				$sql =	'SELECT b.product_types_id, SUM(a.commission_agent_amount) AS amount ' .
						'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
						'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
						'WHERE a.agents_akt_number = ' . $db->quote($number) . ' ' .
						'GROUP BY b.product_types_id';
				$amounts = $db->getAssoc($sql);

				//округлить для ГО
				if ($amounts[PRODUCT_TYPES_GO]) {
					$amounts[PRODUCT_TYPES_GO] = round(intval($amounts[PRODUCT_TYPES_GO]) / 10) * 10;
				}

				foreach ($amounts as $a) $amount += $a;
			}

			if ($product_types_id == PRODUCT_TYPES_GO) {
				$amount = round(intval($amount) / 10) * 10;
			}

			$aktamount = $amount;
			$esv = $aktamount>18241 ?  18241*0.026 : $aktamount*0.026;
			$esv = round($esv, 2);
			$amount1 = $amount-$esv;
			$ndfl = $amount1 > 10730 ? ($amount1-10730)*0.17 + 10730*0.15 : $amount1*0.15;
			$ndfl= round($ndfl, 2);

			$amount = $amount-$ndfl-$esv;

			ereg('(.+)\.([0-9]{1,2})\.([0-9]{1,2})$', $number, $regs);

			$date['month']    =    intval($regs[2]);
			$date['year']    =    '20' . $regs[3];

			$row['aktdate']		= $MONTHES[ $date['month'] - 1 ] . ' ' . $date['year'];
			$row['aktnumber']	= $data['aktnumber'];
			$row['lastday']		= date('d.m.y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
			$akt_date = date('Y-m-d', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));

			$agent['bank_reference'] = str_replace ( '(поповнення рахунку)' , '' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'Перерахування' , 'Перерах' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'подальшим' , 'подал.' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'зарахуванням' , 'зарах.' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'рахунку' , 'рах.' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'поповнення' , 'попов.' , $agent['bank_reference'] );
			$comment='Ком.винаг. з-но дог.№'.$agent['agreement_number'].' від '.$agent['agreement_date_date_format'].'р. акт№'.$number.'від '.$row['lastday'].'р '.$agent['bank_reference'].' Без ПДВ';

			$sql= ($row['id'] ? ' UPDATE ' : ' INSERT INTO ').PREFIX.'_payments_calendar SET '.
				 'number =' . $db->quote($number) . ', ' .
				 'contragent = ' . $db->quote($agent['recipient']) . ', ' .
				 'person_types_id = 2, ' .
				 'account_number = ' . $db->quote($agent['bank_account']) . ', ' .
				 'mfo = ' . $db->quote($agent['mfo']) . ', ' .
				 'bank = ' . $db->quote($agent['recipient']) . ', ' .
				 'code = ' . $db->quote($agent['zkpo']) . ', ' .
				 'agents_lastname = ' . $db->quote($agent['lastname']) . ', ' .
				 'agents_firstname = ' . $db->quote($agent['firstname']) . ', ' .
				 'agents_patronymicname = ' . $db->quote($agent['patronymicname']) . ', ' .
				 'agents_identification_code = ' . $db->quote($agent['identification_code']) . ', ' .
				 'agreement_number = ' . $db->quote($agent['agreement_number']) . ', ' .
				 'agreement_date = ' . $db->quote($agent['agreement_date']) . ', ' .
				 'akt_date = ' . $db->quote($akt_date) . ', ' .
				 'akt_amount = ' . $db->quote($aktamount) . ', ' .
				 'payment_statuses_id = 1, ' .
				 'payment_types_id = ' . intval($payment_types_id) . ', ' .
				 'modified = NOW(), '.
				 ($row['id'] ? ' ' : ' created=NOW(), ') .
				 'comment = ' . $db->quote($comment) . ', ' .
				 'amount = ' . $db->quote($amount) . ' ' .
				 ($row['id'] ? ' WHERE id = ' . intval($row['id']) : '');
			$db->query($sql);

			if (!intval($row['id'])) $row['id'] = mysql_insert_id();

			$sql =	'DELETE FROM ' . PREFIX . '_payments_amounts ' .
					'WHERE payments_id = ' . intval($row['id']);
			$db->query($sql);

			if (is_array($amounts)) {
				foreach ($amounts as $prodid => $amount) {
					$sql =	'INSERT INTO ' . PREFIX . '_payments_amounts SET ' .
							'payments_id = ' . intval($row['id']) . ', ' .
							'product_types_id = ' . intval($prodid) . ', ' .
							'value = ' . $db->quote($amount);
					$db->query($sql);
				}
			}
		} 
		elseif ($product_types_id=1 && $person_types_id == 3 && $payment_types_id != 4) {//выплата директорам и замам
		
			$sql =	'SELECT SUM(commission_director1_amount) ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' .
					'WHERE direktor1_akt_number = ' . $db->quote($number);
			$amount = $db->getOne($sql);

			if (intval($id)==0 && $amount>0) {
				$sql = 	'SELECT d1.accounts_id as agents_id ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN '.PREFIX.'_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'JOIN ' . PREFIX . '_agencies  AS f1 ON a.agencies_id = f1.id ' .
						'LEFT JOIN ' . PREFIX . '_agencies  AS f2 ON f2.id = f1.parent_id ' .
						'JOIN ' . PREFIX . '_agents d1 on IF(f2.id>0,f2.director1_id,f1.director1_id)=d1.accounts_id '.
						'WHERE direktor1_akt_number = ' . $db->quote($number) . ' ' .
						'LIMIT 1';
				$id = $db->getOne($sql);
				$direktor = true;
			}
			else
			{
				$sql =	'SELECT SUM(commission_director2_amount) ' .
						'FROM ' . PREFIX . '_policy_payments_calendar ' .
						'WHERE direktor2_akt_number = ' . $db->quote($number);
				$amount = $db->getOne($sql);
				if (intval($id)==0 && $amount>0) {
					$sql = 	'SELECT d1.accounts_id as agents_id ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN '.PREFIX.'_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'JOIN ' . PREFIX . '_agencies  AS f1 ON a.agencies_id = f1.id ' .
						'LEFT JOIN ' . PREFIX . '_agencies  AS f2 ON f2.id = f1.parent_id ' .
						'JOIN ' . PREFIX . '_agents d1 on IF(f2.id>0,f2.director1_id,f1.director1_id)=d1.accounts_id '.
						'WHERE direktor2_akt_number = ' . $db->quote($number) . ' ' .
						'LIMIT 1';
					$id = $db->getOne($sql);
				}	
			}

			if ($amount>0) {
				//загружаем данные физ лица
				$sql =	'SELECT *, date_format(agreement_date, ' . $db->quote('%d.%m.%y') . ') AS agreement_date_date_format ' .
						'FROM ' . PREFIX . '_agents ' .
						'WHERE accounts_id = ' . intval($id);
			  $agent = $db->getRow($sql);

			  if ($product_types_id == 1) //общий акт

				$amount = 0;

				$sql =	'SELECT b.product_types_id, SUM(a.commissionDirector'.($direktor ? '1':'2').'Amount) AS amount ' .
						'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
						'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
						'WHERE a.direktor'.($direktor ? '1':'2').'AktNumber = ' . $db->quote($number) . ' ' .
						'GROUP BY b.product_types_id';
				$amounts = $db->getAssoc($sql);

				//округлить для ГО
				if ($amounts[PRODUCT_TYPES_GO]) {
					$amounts[PRODUCT_TYPES_GO] = round(intval($amounts[PRODUCT_TYPES_GO]) / 10) * 10;
				}

				foreach ($amounts as $a) $amount += $a;
			}

			if ($product_types_id == PRODUCT_TYPES_GO) {
				$amount = round(intval($amount) / 10) * 10;
			}

			$aktamount = $amount;
			$esv = $aktamount>18241 ?  18241*0.026 : $aktamount*0.026;
			$esv = round($esv, 2);
			$amount1 = $amount;//-$esv;
			$ndfl = $amount1 > 10730 ? ($amount1-10730)*0.17 + 10730*0.15 : $amount1*0.15;
			$ndfl= round($ndfl, 2);

			$amount = $amount-$ndfl-$esv;

			ereg('(.+)\.([0-9]{1,2})\.([0-9]{1,2})$', $number, $regs);

			$date['month']    =    intval($regs[2]);
			$date['year']    =    '20' . $regs[3];

			$row['aktdate']		= $MONTHES[ $date['month'] - 1 ] . ' ' . $date['year'];
			$row['aktnumber']	= $data['aktnumber'];
			$row['lastday']		= date('d.m.y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
			$akt_date = date('Y-m-d', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));

			$agent['bank_reference'] = str_replace ( '(поповнення рахунку)' , '' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'Перерахування' , 'Перерах' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'подальшим' , 'подал.' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'зарахуванням' , 'зарах.' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'рахунку' , 'рах.' , $agent['bank_reference'] );
			$agent['bank_reference'] = str_replace ( 'поповнення' , 'попов.' , $agent['bank_reference'] );
			$comment='Ком.винаг. з-но дог.№'.$agent['agreement_number'].' від '.$agent['agreement_date_date_format'].'р. акт№'.$number.'від '.$row['lastday'].'р '.$agent['bank_reference'].' Без ПДВ';

			$sql= ($row['id'] ? ' UPDATE ' : ' INSERT INTO ').PREFIX.'_payments_calendar SET '.
				 'number =' . $db->quote($number) . ', ' .
				 'contragent = ' . $db->quote($agent['recipient']) . ', ' .
				 'person_types_id = 2, ' .
				 'account_number = ' . $db->quote($agent['bank_account']) . ', ' .
				 'mfo = ' . $db->quote($agent['mfo']) . ', ' .
				 'bank = ' . $db->quote($agent['recipient']) . ', ' .
				 'code = ' . $db->quote($agent['zkpo']) . ', ' .
				 'agents_lastname = ' . $db->quote($agent['lastname']) . ', ' .
				 'agents_firstname = ' . $db->quote($agent['firstname']) . ', ' .
				 'agents_patronymicname = ' . $db->quote($agent['patronymicname']) . ', ' .
				 'agents_identification_code = ' . $db->quote($agent['identification_code']) . ', ' .
				 'agreement_number = ' . $db->quote($agent['agreement_number']) . ', ' .
				 'agreement_date = ' . $db->quote($agent['agreement_date']) . ', ' .
				 'akt_date = ' . $db->quote($akt_date) . ', ' .
				 'akt_amount = ' . $db->quote($aktamount) . ', ' .
				 'payment_statuses_id = 1, ' .
				 'payment_types_id = ' . intval($payment_types_id) . ', ' .
				 'modified = NOW(), '.
				 ($row['id'] ? ' ' : ' created=NOW(), ') .
				 'comment = ' . $db->quote($comment) . ', ' .
				 'amount = ' . $db->quote($amount) . ' ' .
				 ($row['id'] ? ' WHERE id = ' . intval($row['id']) : '');
			$db->query($sql);

			if (!intval($row['id'])) $row['id'] = mysql_insert_id();

			$sql =	'DELETE FROM ' . PREFIX . '_payments_amounts ' .
					'WHERE payments_id = ' . intval($row['id']);
			$db->query($sql);

			if (is_array($amounts)) {
				foreach ($amounts as $prodid => $amount) {
					$sql =	'INSERT INTO ' . PREFIX . '_payments_amounts SET ' .
							'payments_id = ' . intval($row['id']) . ', ' .
							'product_types_id = ' . intval($prodid) . ', ' .
							'value = ' . $db->quote($amount);
					$db->query($sql);
				}
			}
		
		}
		elseif (($product_types_id == PRODUCT_TYPES_KASKO  || $product_types_id == PRODUCT_TYPES_DGO) && $person_types_id == 2 && $payment_types_id != 4) {//Юр лица выплата по АКТу
			$sql =	'SELECT SUM(commission_agency_amount) ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' .
					'WHERE agencies_akt_number = ' . $db->quote($number);
			$aktamount = $amount = $db->getOne($sql);

			if ($amount > 0) {
			
				$sql =	'SELECT *, date_format(agreement_date, ' . $db->quote(DATE_FORMAT) . ') AS agreement_date_date_format ' .
						'FROM ' . PREFIX . '_agencies ' .
						'WHERE id = ' . intval($id);
				$agency = $db->getRow($sql);

				ereg ('(.+)\.([0-9]{1,2})\.([0-9]{1,2})$', $number, $regs); 
				$date['month']	= intval($regs[2]);
				$date['year']	= '20' . $regs[3];

				$values['aktdate']		= $MONTHES[ $date['month'] - 1 ] . ' ' . $date['year'];
				$values['aktnumber']	= $data['aktnumber'];
				$values['lastday']		= date('d.m.Y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
				$akt_date = date('Y-m-d', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));

				$comment = 'Агентська винагорода за '.mb_strtolower(  $MONTHES[ $date['month'] - 1 ] , 'UTF-8'  ).' '.$regs[3].'р. зг.договору № '.$agency['agreement_number'].' від '.$agency['agreement_date_date_format'].'р., акт вик. робіт № '.$number.' від '.$values['lastday'].'р. Без ПДВ';

				$sql = ($row['id'] ? ' UPDATE ' : ' INSERT INTO ').PREFIX.'_payments_calendar SET ' .
					'number = ' . $db->quote($number) . ', ' .
					'contragent = ' . $db->quote($agency['title']) . ', ' .
					'person_types_id = 2, ' .
					'account_number = ' . $db->quote($agency['bank_account']) . ', ' .
					'mfo = ' . $db->quote($agency['bank_mfo']) . ', ' .
					'bank = ' . $db->quote($agency['bank']) . ', ' .
					'code = ' . $db->quote($agency['edrpou']) . ', ' .
					'payment_statuses_id = 1, ' .
					'agreement_number ='.$db->quote($agency['agreement_number']).', '.
					'agreement_date ='.$db->quote($agency['agreement_date']).', '.
					'agencies_name ='.$db->quote($agency['title']) . ', ' .
					'agencies_edrpou ='.$db->quote($agency['edrpou']) . ', ' .
					'akt_date ='.$db->quote($akt_date) . ', ' .
					'akt_amount = ' . $db->quote($aktamount) . ', ' .
					'payment_types_id = '.intval($payment_types_id) . ', ' .
					'modified = NOW(), '.
					($row['id'] ? ' ' : 'created=NOW(), ') .
					'comment = ' . $db->quote($comment) . ', ' .
					'amount = ' . $db->quote($amount) . ' ' .
					($row['id'] ? ' WHERE id = ' . intval($row['id']) : '');
				$db->query($sql);
			}
		} elseif($data['payment_types_id'] == 4) {//выплата по страховому акту

			$sql =	'SELECT d.insurer_lastname AS policiesInsurerLastname, d.insurer_firstname AS policiesInsurerFirstname, d.insurer_patronymicname AS policiesInsurerPatronymicname, e.number AS policyNumber, date_format(e.date, ' . $db->quote(DATE_FORMAT) . ') AS policyDate_date_format, f.paymentDocumentNumber, date_format(f.paymentDocumentDate, ' . $db->quote(DATE_FORMAT) . ') AS paymentDocumentDate_date_format ' .
					'FROM ' . PREFIX . '_events_kasko_akts AS a ' .
					'JOIN ' . PREFIX . '_events_kasko AS b ON a.eventsId = b.eventsId ' .
					'JOIN ' . PREFIX . '_events AS c ON a.eventsId = c.id ' .
					'JOIN ' . PREFIX . '_policies_kasko AS d ON c.policies_id = d.policies_id ' .
					'JOIN ' . PREFIX . '_policies AS e ON d.policies_id = e.id ' .
					'JOIN ' . PREFIX . '_events_kasko_akts AS f ON a.eventsId = f.eventsId ' .
					'WHERE a.id = ' . intval($id);
			$event = $db->getRow($sql);

			if ($event) {
				$comment = 'Страх вiдшк зг дог страх №'.$event['policyNumber'].' вiд '.$event['policyDate_date_format'].' '.$event['policiesInsurerLastname'].' '.$event['policiesInsurerFirstname'].' '.$event['policiesInsurerPatronymicname'].( $event['paymentDocumentNumber'] ? ';та зг. рах. '.$event['paymentDocumentNumber'].' вiд '.$event['paymentDocumentDate_date_format'] :'');

				if ($data['recipientPersonTypesId'] == 1) {//получатель физ лицо платить через карточный счет в банк
					$contragent=$data['recipientBank'];
					$code=$data['recipientBankEDRPOU'];
				} else {
					$contragent	= $data['recipient'];
					$code		= $data['recipientIdentificationCode'];
				}

				$sql= ($row['id'] ? ' UPDATE ' : ' INSERT INTO ').PREFIX.'_payments_calendar SET '.
					'number = ' . $db->quote($number) . ', ' .
					'contragent = ' . $db->quote($contragent) . ', ' .
					'person_types_id = 2, ' .
					'policy_number = ' . $db->quote($event['policyNumber']) . ', ' .
					'account_number = ' . $db->quote($data['recipientBankAccount']) . ', ' .
					'mfo = ' . $db->quote($data['recipientBankMFO']) . ', ' .
					'bank = ' . $db->quote($data['recipientBank']) . ', ' .
					'code = ' . $db->quote($code) . ', ' .
					'payment_statuses_id = 1, ' .
					'payment_types_id = ' . intval($data['payment_types_id']) . ', ' .
					'modified = NOW(), ' .
					($row['id'] ? ' ' : ' created=NOW(), ') .
					'comment = ' . $db->quote($comment) . ', ' .
					'amount = ' . $db->quote($data['amount']) . ' ' .
					($row['id'] ? ' WHERE id='.intval($row['id']) : '');
				$db->query($sql);
			}
		}
	}

	function getList($data) {
        global $db;

		$product_types = array(PRODUCT_TYPES_AUTO,
			PRODUCT_TYPES_KASKO,
			PRODUCT_TYPES_GO,
			PRODUCT_TYPES_NS,
			PRODUCT_TYPES_DGO);

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_product_types ' .
				'WHERE id IN (' . implode(', ', $product_types) . ') ' .
				'ORDER BY id';
		$prod_types = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><b>ПО ВИДАМ СТРАХУВАННЯ:</b></td></tr>';

		$result .= '<tr><td>&nbsp;</td><td><table id="producttypes" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;;">';
		$result .= '<tr class="columns"><td>Вид</td><td>Сума</td><td style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addProdTypes(this)" /></td></tr>';

		if (!is_array($data['prod_types'])) {
			$conditions[] = 'payments_id = ' . intval($data['id']);
			$sql =  'SELECT * ' .
					'FROM ' . PREFIX . '_payments_amounts  ' .
					'WHERE ' . implode(' AND ', $conditions);
			$data['prod_types'] = $db->getAll($sql);
		}

		$i = 0;
		if (is_array($data['prod_types'])) {
			foreach ($data['prod_types'] as $i=>$row) {

				if ($row['id'] == NULL) $row['id'] = $i;

				$result .=
					'<tr>' .
						'<td><select name="prod_types[' . $row['id'] . '][product_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';
				foreach ($prod_types as $j=>$prod_type) {
						$result .='<option value="'.$j.'" '.($row['product_types_id']==$j ? 'SELECTED': '').'>'.$prod_type.'</option>';
				}

				$result .='</select></td>'.
						'<td><input type="text" name="prod_types[' . $row['id'] . '][value]" value="' . $row['value'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
						'<td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteProdTypes(this)" /></td>' .
					 '</tr>';
			}		 
		} 

		$result .= '</table>';

        return $result;
    }
}

?>