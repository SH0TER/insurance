<?
/*
 * Title: accident payments calendar class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ExpertOrganizations.class.php';
require_once 'CarServices.class.php';
require_once 'AccidentDocuments.class.php';
require_once 'Accidents.class.php';

class AccidentPaymentsCalendar extends Form {

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
							'table'				=> 'accident_payments_calendar'),
                        array(
                            'name'              => 'accounts_id',
                            'description'       => 'Менеджер',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 8,
                            'table'             => 'accident_payments_calendar',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
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
							'table'				=> 'accident_payments_calendar'),
						array(
							'name'				=> 'acts_id',
							'description'		=> 'Акт',
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
							'orderPosition'		=> -2,
							'table'				=> 'accident_payments_calendar'),
                        array(
                            'name'                	=> 'audatex_code',
                            'description'        	=> 'Код AUDATEX',
                            'type'                	=> fldText,
                            'maxlength'				=> 10,
                            //'validationRule'        => '/^[0-9]{3,10}$/',
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                	=> 'accident_payments_calendar'),
                        array(
                            'name'              => 'policies_number',
                            'description'       => 'Номер договору',
                            'type'              => fldText,
                            'maxlenght'         => 20,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accident_payments_calendar'),
						array(
                            'name'              => 'number',
                            'description'       => 'Бух код 1С',
                            'type'              => fldText,
                            'maxlenght'         => 20,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'accident_payments_calendar'),	
                        array(
                            'name'              => 'amount',
                            'description'       => 'Сума, грн.',
                            'type'              => fldMoney,
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
                            'orderPosition'     => 4,
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_types_id',
                            'description'       => 'Призначення',
                            'type'              => fldRadio,
							'list'				=> array(
													1 => 'Експертиза',
													2 => 'Евакуатор',
													3 => 'Компетентні органи',
													4 => 'Стоянка',
													5 => 'Частина страхової премії',
													6 => 'Страхове відшкодування',
													7 => 'Інші витрати'),
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_bank_card_number',
                            'description'       => 'СКР',
                            'type'              => fldText,
							'maxlength'			=> 19,
//							'validationRule'	=> '[0-9]{16}',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_bank_account',
                            'description'       => 'Рахунок',
                            'type'              => fldText,
							'maxlength'			=> 20,
//							'validationRule'	=> '[0-9]{9,14}',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_bank_mfo',
                            'description'       => 'МФО',
                            'type'              => fldText,
							'maxlength'			=> 6,
							'validationRule'	=> '[0-9]{6}',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'bank_edrpou',
                            'description'       => 'ЄДРПОУ, банк',
                            'type'              => fldText,
							'maxlength'			=> 8,
							'validationRule'	=> '^[0-9]{8}$',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_bank',
                            'description'       => 'Банк',
                            'type'              => fldText,
							'maxlength'			=> 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_recipient',
                            'description'       => 'Одержувач1',
                            'type'              => fldText,
							'maxlength'			=> 100,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_identification_code',
                            'description'       => 'ІПН (ЄДРПОУ)',
                            'type'              => fldText,
							'maxlength'			=> 10,
							'validationRule'	=> '^([0-9]{8}|[0-9]{10})$',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'recipient_types_id',
                            'description'       => 'Одержувач2',
                            'type'              => fldRadio,
							'list'				=> array(
													1 => 'Власник',
													2 => 'Вигодонабувач',
													3 => 'Експерт',
													4 => 'Страхувальник',
													5 => 'СТО',
													6 => 'Страховик',
													7 => 'Фізична особа'),
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'recipients_id',
                            'description'       => 'Одержувач3',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'recipient',
                            'description'       => 'Одержувач',
                            'type'              => fldText,
							'maxlength'			=> 100,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 3,
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'recipient_identification_code',
                            'description'       => 'ІПН (ЄДРПОУ)',
                            'type'              => fldText,
							'maxlength'			=> 10,
							'validationRule'	=> '^([0-9]{8}|[0-9]{10})$',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'basis',
                            'description'       => 'Згідно',
                            'type'              => fldNote,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_basis',
                            'description'       => 'Згідно, скорочено',
                            'type'              => fldText,
							'maxlength'			=> 160,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_payments_calendar'),
                        array(
                            'name'              => 'payment_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 5,
                            'table'             => 'accident_payments_calendar',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'payment_date',
                            'description'       => 'Оплата',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 6,
                            'table'             => 'accident_payments_calendar'),
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
							'orderPosition'		=> 7,
							'table'				=> 'accident_payments_calendar'),
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
							'orderPosition'		=> 8,
							'width'				=> 100,
							'table'				=> 'accident_payments_calendar')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 8,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'title'
					)
			);

	function AccidentPaymentsCalendar($data) {
        $this->object = 'AccidentPaymentsCalendar';

		Form::Form($data);

		$this->messages['plural'] = 'Календар платежів';
		$this->messages['single'] = 'Календар платежів';
	}

    function setMode($data) {

        if (is_array($data['id'])) {
            $data['accidents_id'] = $data['id'][0];
        } elseIf (!intval($data['accidents_id']) && $data['id']) {
            $data['accidents_id'] = $data['id'];
        }

        if (ereg('^' . $this->object . '\|(show|add|insert|load|update)|(Accidents\|updatePaymentsCalendar)$', $data['do'])) {
            $this->mode = $_SESSION[ 'Accidents' ][ $data['accidents_id'] ] = 'update';
        } elseif (ereg('^' . $this->object . '\|view|(Accidents\|viewPaymentsCalendar)$', $data['do'])) {
            $this->mode = $_SESSION[ 'Accidents' ][ $data['accidents_id'] ] = 'view';
        } else {
            $this->mode = $_SESSION[ 'Accidents' ][ $data['accidents_id'] ]['mode'];
        }
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
					'delete'	=> true);
				break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				//$this->permissions['update'] = ($this->permissions['update'] && $this->mode == 'update') ? true : false;
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

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

        $result = parent::checkPermissions($action, $data, $redirect);

        switch ($action) {
            case 'update':
                $conditions[] = (is_array($data['id']))
                    ? 'id = ' . intval($data['id'][0])
                    : 'id = ' . intval($data['id']);

                $sql =	'SELECT acts_id, payment_statuses_id ' .
                        'FROM ' . PREFIX . '_accident_payments_calendar ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $row = $db->getRow($sql);

				if (intval($row['acts_id']) && $data['do'] != '' && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR && !in_array(ACCOUNT_GROUPS_SETTLEMENT_EXPRESS, $Authorization->data['account_groups_id'])) {
					//parent::checkPermissions($action, $data, true);
				}

				switch ($row['payment_statuses_id']) {
					case PAYMENT_STATUSES_NOT:

						$Accidents = new Accidents($data);
						$Accidents->setManagers($data['accidents_id']);						

						if (!in_array($Authorization->data['id'], $Accidents->managers)) {
							parent::checkPermissions($action, $data, true);
						}
						break;
					default:
						$Accidents = new Accidents($data);
						$Accidents->setManagers($data['accidents_id']);
                        if($Authorization->data['roles_id'] != ROLES_ADMINISTRATOR && !in_array(ACCOUNT_GROUPS_SETTLEMENT_EXPRESS, $Authorization->data['account_groups_id']) && $Authorization->data['id'] != $Accidents->managers['average_managers_id'])
						    parent::checkPermissions($action, $data, true);
						break;
				}

                break;
        }

        return $result;
    }

    function getRowClass($row, $i) {

        $result = parent::getRowClass($row, $i);

        switch ($row['paymentStatusesId']) {
            case PAYMENT_STATUSES_NOT:
                break;
            case PAYMENT_STATUSES_PARTIAL:
                $result .= ' partial';
                break;
            case PAYMENT_STATUSES_PAYED:
                $result .= ' payed';
                break;
            case PAYMENT_STATUSES_OVER:
                $result .= ' over';
                break;
        }

        return $result;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

		$data['step'] = 4;

		$this->formDescription['fields'][ $this->getFieldPositionByName('accounts_id') ]['type'] = fldSelect;

        $hidden['do'] = $data['do'];

		$fields[] = 'accidents_id';
		$conditions[] = 'accidents_id = ' . intval($data['accidents_id']);

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ', payment_statuses_id AS paymentStatusesId, CONCAT(lastname, \' \', firstname) AS accounts_id FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
        } else {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ', payment_statuses_id AS paymentStatusesId, CONCAT(lastname, \' \', firstname) AS accounts_id FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
        }

        $total	= $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        include $template;
    }

	function getPaymentBasis($basis) {
        $basis = str_replace('Страхове вiдшкодування згiдно договору страхування', 'Страх. вiдшк. зг. дог.', $basis);
		$basis = str_replace('договору', 'дог.', $basis);
        $basis = str_replace('Рахунок-фактура', 'Р/Ф', $basis);
        $basis = str_replace('2011р.', '11р.', $basis);
        $basis = str_replace('2012р.', '12р.', $basis);
        $basis = str_replace('2013р.', '13р.', $basis);
		$basis = str_replace('страхування', 'страх.', $basis);

		return $basis;
	}

    function setConstants(&$data) {
		global $db, $Authorization;

		$data['accounts_id'] = $Authorization->data['id'];

		$data['payment_statuses_id'] = PAYMENT_STATUSES_NOT;

		switch (intval($data['payment_types_id'])) {
			case PAYMENT_TYPES_EXPERTISE:
				$data['basis'] = 'Оплата за експертизу автомобіля  згідно ' . $data['basis'] . ', Без ПДВ.';
				break;
			case PAYMENT_TYPES_PART_PREMIUM://Частина страхової премії
				$fields = array(
					'recipient_types_id',
					'bank_edrpou',
					'payment_bank_card_number',
					'payment_bank_account',
					'payment_bank_mfo',
					'payment_bank',
					'payment_identification_code');

				foreach ($fields as $field) {
					$data[ $field ] = '';
					$this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
				}				
                if($data['policies_number_current'] == $data['policies_number']) {
                    $basis_end = 'вказаному договору';
                }
                else {
                    $basis_end = 'договору страхування ' . $data['policies_number'] . ' від ' . date('d.m.Y', strtotime($data['policies_date_format']));
                }
				    //$data['basis'] = 'Зарахувати згідно договору страхування № ' . $data['policies_number_current'] . ' від ' . $data['policies_date_current_format'] . 'р. в якості оплати страхового платежу по ' . $basis_end;
				break;
			case PAYMENT_TYPES_COMPENSATION:
                if($data['product_types_id'] == PRODUCT_TYPES_GO) {  //дополнительные правки базиса в зависимости от типа страхования (отличия только в ГО)
                     $sql = 'SELECT CONCAT(a.owner_lastname,\' \', a.owner_firstname, \' \', a.owner_patronymicname) as full_name, a.owner_identification_code ' .
                            'FROM ' . PREFIX . '_accidents_go as a '.
                            'WHERE a.accidents_id = ' .intval($data['accidents_id']);
                    $data['owner'] = $db->getRow($sql);
                    $basis_policy = 'полісу';
                    //$data['basis'] = 'Страхове вiдшкодування згiдно '. $basis_policy .'  № ' . $data['policies_number'] . ' від ' . $data['policies_date_format'] . 'р. ' . $data['owner']['full_name'] . '; ';
                }else {
                      //получаем страхователя
                      $sql = 'SELECT IF(a.insurer_person_types_id = 1, CONCAT(a.insurer_lastname,\' \', a.insurer_firstname, \' \', a.insurer_patronymicname), a.insurer_company) as full_name, IF(a.insurer_person_types_id  = 1, a.insurer_identification_code, a.insurer_edrpou) as  insurer_identification_code ' .
                             'FROM ' . PREFIX . '_policies_kasko as a '.
                             'JOIN ' . PREFIX . '_accidents as b ON a.policies_id = b.policies_id ' .
                             'WHERE b.id = ' .intval($data['accidents_id']);
                      $data['insurer'] = $db->getRow($sql);
                      $basis_policy = 'договору';
                      //$data['basis'] = 'Страхове вiдшкодування згiдно '. $basis_policy .' страхування № ' . $data['policies_number'] . ' від ' . $data['policies_date_format'] . 'р. ' . $data['insurer']['full_name'] . '; ';
                }

				switch ( $data['recipient_types_id'] ) {
					case RECIPIENT_TYPES_CAR_SERVICE:
						//$data['basis'] .= ' та згiдно ' . $data['payment_document_number'] . ' вiд ' . $data['payment_document_date'] . 'р.,';

                        //считаем ПДВ
                        //$PDV = number_format($data['amount'] - $data['amount'] * 5 / 6, 2, '.', '');
                        //$data['basis'] .= 'у т.ч ПДВ - ' . $PDV . ' грн.';
						break;
					default:
                        if($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
						    //$data['basis'] .= ' ІПН(ЄДРПОУ): ' . $data['insurer']['insurer_identification_code'] . '; ';
                        }
                        elseif($data['product_types_id'] == PRODUCT_TYPES_GO) {
                            //$data['basis'] .= ' ІПН: ' . $data['owner']['owner_identification_code'] . '; ';
                        }
						if ( $data['payment_bank_card_number'] != '' ) {
							//$data['basis'] .= 'СКР: ' . $data['payment_bank_card_number'];
						} else if ( strlen($data['recipient_identification_code']) > 8 ) {
							//$data['basis'] .= 'Без ПДВ';					
						}
						break;
				}
				break;
                $data['basis'] = explode('Оплата за автоекспертизу зг. ', $data['basis']);
                $data['basis'] = implode(' Без ПДВ.', $data['basis']);
                break;
		}

		if ($data['payment_bank_card_number'] != '' && !in_array(intval($data['payment_types_id']),array(PAYMENT_TYPES_EXPERTISE, PAYMENT_TYPES_PART_PREMIUM)) && strripos($data['payment_bank'], 'Аваль') == FALSE && $data['recipient_types_id'] != RECIPIENT_TYPES_OTHER && substr($data['payment_bank_account'], 0, 3) != '262') {
			$data['payment_recipient'] = $data['payment_bank'];
			$data['payment_identification_code'] = $data['bank_edrpou'];
		} else {
			$data['payment_recipient'] = $data['recipient'];
			$data['payment_identification_code'] = $data['recipient_identification_code'];
		}

		switch (intval($data['recipient_types_id'])) {
			case RECIPIENT_TYPES_EXPERT:
			case RECIPIENT_TYPES_CAR_SERVICE:
				break;
			default:
				$data['recipients_id'] = 0;
				$this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]['verification']['canBeEmpty'] = true;
				break;
		}

		$data['payment_basis'] = $this->getPaymentBasis($data['basis']);

		return parent::setConstants($data);
	}

	function generateDocuments($action, $payment_types_id, $accidents_id, $id, $acts_id=0) {
		global $db;
		if ($action == 'update') {
			Accidents::removeDocuments($accidents_id, $id, 0, array(DOCUMENT_TYPES_ACCIDENT_NOTE_EVACUATE));
		}

		switch ($payment_types_id) {
			case '1'://Експертиза
			case '7'://Інші витрати
				Accidents::generateDocuments($accidents_id, 0, $id, $acts_id, array(DOCUMENT_TYPES_ACCIDENT_NOTE_EXPERTIZE));
				break;
			case '2'://Евакуатор
				Accidents::generateDocuments($accidents_id, 0, $id, $acts_id, array(DOCUMENT_TYPES_ACCIDENT_NOTE_EVACUATE));
				break;
			case '3'://Довідка на оплату послуг компетентних органів
				Accidents::generateDocuments($accidents_id, 0, $id, $acts_id, array(DOCUMENT_TYPES_ACCIDENT_COMPETENT_AUTHORITIES));
				break;
			case '4'://Стоянка
				Accidents::generateDocuments($accidents_id, 0, $id, $acts_id, array(DOCUMENT_TYPES_ACCIDENT_NOTE_EVACUATE));
				break;
            case '6'://Страхове відшкодування
                if($action ==  'update') {
                    Accidents::generateDocuments($accidents_id, 0, $id, $acts_id , array(DOCUMENT_TYPES_ACCIDENT_NOTE_PAYMENT));
				}
                break;
		}
	}

    function insert($data, $redirect=true) {
        global $Log,$db;

        $data['id'] = parent::insert($data, false);

        if ($data['id']) {
			//проставить уникальный номер платежа
			if ($data['payment_types_id'] != PAYMENT_TYPES_PART_PREMIUM) {//Не Частина страхової премії
				if(Accidents::getProductTypesId($data['accidents_id']) == PRODUCT_TYPES_GO) {
					$next_number = $db->getOne('SELECT COUNT(*)+1 FROM ' . PREFIX . '_accident_payments_calendar as calendar JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id WHERE accidents.number = ' . $db->quote(Accidents::getNumber($data['accidents_id'])) . ' AND LENGTH(calendar.number)>1');
				} else {
					$next_number = $db->getOne('SELECT COUNT(*)+1 FROM ' . PREFIX . '_accident_payments_calendar WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND LENGTH(number)>1');
				}

				if (intval($data['acts_id'])>0) {
					$number = $db->getOne('SELECT number FROM ' . PREFIX . '_accidents_acts WHERE id=' . intval($data['acts_id']));
				} else {
					$number = $db->getOne('SELECT number FROM ' . PREFIX . '_accidents WHERE id=' . intval($data['accidents_id']));
				}

				$number.='-'.$next_number;

				$db->query('UPDATE ' . PREFIX . '_accident_payments_calendar SET number = ' . $db->quote($number) . ' WHERE id = ' . intval($data['id']));
			}

			$this->generateDocuments('insert', $data['payment_types_id'], $data['accidents_id'], $data['id']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
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

    function update($data, $redirect=true) {
        global $Log, $db;

        $data['id'] = parent::update($data, false);

        if ($data['id']) {
			$this->generateDocuments('update', $data['payment_types_id'], $data['accidents_id'], $data['id'], $data['acts_id']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
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

	//фиксируем платежи по акту
	function changeActPayments($acts_id, $data) {
		global $db;

		if (is_array($data['payments_calendar'])) {

			$sql =	'SELECT a.id ' .
					'FROM ' . PREFIX . '_accident_payments_calendar AS a ' .
					'LEFT JOIN ' . PREFIX . '_accident_payments AS b ON a.id = b.payments_calendar_id ' .
					'WHERE a.acts_id = ' . intval($data['id']) . ' ' .
					'GROUP BY a.id ' .
					'HAVING SUM(b.amount) > 0';
			$ids = $db->getCol($sql);

            //Добавляем или обновляем платежи по акту
			foreach ($data['payments_calendar'] as $payment) {
				if (!in_array($payment['id'], $ids)) {

                     //определяем дату договора в зависимости от типа платежа (функционал предназначен для Взаимозачета)
                    if($payment['payment_types_id'] == PAYMENT_TYPES_PART_PREMIUM) {
                        $sql  =  'SELECT date '.
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE number = ' . $db->quote($payment['policies_number']);
                        $payment['policies_date_format'] = $db->getOne($sql);
                        //Запоминаем текущие параметры полиса для формирования строки "Призначення платежу" для взаимозачета, так как учёт может идти в другой договор, используется в setConstants
                        $payment['policies_number_current']        = $data['policies_number'];
                        $payment['policies_date_current_format']   = $data['policies_date_format'];

                    }
                    else {
                        $payment['policies_number']     = $data['policies_number'];
                        $payment['policies_date_format']= $data['policies_date_format'];
                    }
					$payment['accidents_id']			= $data['accidents_id'];
					$payment['acts_id']					= $data['id'];
                    $payment['payment_document_number'] = $data['payment_document_number'];
                    $payment['payment_document_date']   = $data['payment_document_date'];

					$id[] = ($payment['id'] > 0) ? $this->update($payment, false) : $this->insert($payment, false);
				}
			}
		}

		//удаляем неоплаченные платежи по акту
		$conditions[] = 'acts_id = ' . intval($acts_id);

		if (is_array($id)) {
			$conditions[] = PREFIX . '_accident_payments_calendar.id NOT IN(' . implode(', ', $id) . ')';
		}

		$sql =	'DELETE ' . PREFIX . '_accident_payments_calendar ' .
				'FROM ' . PREFIX . '_accident_payments_calendar ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments ON ' . PREFIX . '_accident_payments_calendar.id = ' . PREFIX . '_accident_payments.payments_calendar_id ' .
				'WHERE ISNULL(' . PREFIX . '_accident_payments.payments_calendar_id) AND ' . implode(' AND ', $conditions);
		$db->query($sql);
	}

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        $sql =	'SELECT id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE id IN(' . implode(', ', $data['id']) . ') AND payment_statuses_id = ' . PAYMENT_STATUSES_NOT;
        $row['id'] = $db->getCol($sql);

		if (is_array($row['id']) && sizeOf($row['id'])) {
			$AccidentDocuments = new AccidentDocuments($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentDocuments->tables[0] . ' ' .
					'WHERE payments_calendar_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentDocuments->delete($toDelete, false, false);
		}

		if (sizeOf($data['id']) != sizeOf($row['id'])) {
			$Log->add('error', 'Вилучати можливо тільке не оплаченні витрати.');
			return;
		}

        return parent::deleteProcess($data, $i, $folder);
    }

	function downloadFileInWindow($data) {
		global $db;

		$data['file'] = unserialize($data['file']);

        $this->checkPermissions('view', $data['file']);

		$conditions[] = 'payments_calendar_id = ' . intval($data['file']['id']);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_accident_documents ' .
				'WHERE ' . implode(' AND ', $conditions);
		$data['file'] = $db->getRow($sql);

		$data['file'] = serialize( $data['file'] );

		$AccidentDocuments = new AccidentDocuments($data);
		$AccidentDocuments->downloadFileInWindow($data);
	}

	function getAmount($accidents_id, $payment_types_id) {
		global $db;

		$conditions[] = 'accidents_id = ' . intval($accidents_id);
		$conditions[] = 'payment_types_id = ' . intval($payment_types_id);

		$sql =	'SELECT SUM(amount) AS amount ' .
				'FROM ' . PREFIX . '_accident_payments_calendar ' .
				'WHERE ' . implode(' AND ', $conditions);
		$amount = $db->getOne($sql);

		return ($amount > 0) ? $amount : 0;
	}

    function checkFields($data, $action){
        global $Log;

        parent::checkFields($data, $action);
		
		if ($data['recipient_types_id'] == RECIPIENT_TYPES_OTHER && strlen($data['recipient_identification_code']) != 10) {
			//$Log->add('error', 'ІНН повинен складатися з 10 цифр');
		}

        if($data['car_services_tis'] == 1 && strlen($data['audatex_code']) == 0){
            $Log->add('error', 'Для СТО <b>%s</b>%s потрібно ввести код AUDATEX', array($data['recipient'], ''));
        }elseif($data['car_services_tis'] == 1){
            if(!$this->isAudatexCodeUnique($data['id'], $data['audatex_code'], $data['recipients_id'])){
                $Log->add('error', 'Для СТО <b>%s</b>%s уже існує виплата за таким кодом AUDATEX', array($data['recipient'], ''));
            }
            /*if(!preg_match('/^[0-9]{3,10}$/', $data['audatex_code'])){
                $Log->add('error', 'Для СТО <b>%s</b>%s код AUDATEX має не вірний формат', array($data['recipient'], ''));
            }*/
        }
    }

    function isAudatexCodeUnique($id, $code, $recipients_id){
        global $db;

        $sql = 'SELECT COUNT(*) ' .
               'FROM ' . PREFIX . '_accident_payments_calendar ' .
               'WHERE audatex_code = ' . $db->quote($code) . ' AND recipients_id = ' . intval($recipients_id) . ' AND id <> ' . intval($id);
        $count = intval($db->getOne($sql));
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }
	
	function setRealLimitPaymentDateInWindow($data) {
		global $db;
		
		$sql = 'SELECT acts_id ' .
			   'FROM ' . PREFIX . '_accident_payments_calendar ' .
			   'WHERE id = ' . intval($data['id']);
		$acts_id = $db->getOne($sql);
		
		$sql = 'SELECT id ' . 
			   'FROM ' . PREFIX . '_accident_payments_calendar ' .
			   'WHERE acts_id = ' . intval($acts_id);
		$payments_calendar_idx = $db->getCol($sql);
		
		$sql = 'SELECT accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory, ' .
					'date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_old, ' . $db->quote($data['date']) . ' as real_new ' .
			   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
			   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id ' .
			   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
			   'WHERE calendar.id IN (' . implode(', ', $payments_calendar_idx) . ')';
		$list = $db->getAll($sql);
		
		$sql = 'UPDATE ' . PREFIX . '_accident_payments_calendar ' .
			   'SET real_limit_payment_date = ' . $db->quote(substr($data['date'], 6, 4) . '-' . substr($data['date'], 3, 2) . '-' . substr($data['date'], 0, 2)) . ' ' .
			   'WHERE id IN (' . implode(', ', $payments_calendar_idx) . ')';
		$db->query($sql);	

		$html = '<table>
					<tr class="columns">
						<td>Номер справи</td>
						<td>Номер договору/полісу</td>
						<td>Страхувальник</td>
						<td>Отримувач</td>
						<td>Сума</td>
						<td>Гранична дата виплати</td>
						<td>Страра планова дата</td>
						<td>Нова планова дата</td>
					</tr>';
		
		foreach ($list as $row) {
			$html .= '<tr>';
			foreach ($row as $el) {
				$html .= '<td>' . $el . '</td>';
			}
			$html .= '</tr>';
		}
		$html .= '</table>';
		
		$result['idx'] = $payments_calendar_idx;
		$result['html'] = $html;
		echo json_encode($result);
	}
}

?>