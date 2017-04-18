<?
/*
 * Title: policy class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Cards.class.php';
require_once 'Clients.class.php';
require_once 'Agencies.class.php';
require_once 'Products.class.php';
require_once 'Payments.class.php';
require_once 'Accidents.class.php';
require_once 'ClientCars.class.php';
require_once 'ProductTypes.class.php';
require_once 'PolicyQuotes.class.php';
require_once 'PolicyPayments.class.php';
require_once 'PolicyMessages.class.php';
require_once 'PolicyDocuments.class.php';
require_once 'PolicyPaymentsCalendar.class.php';

class Policies extends Form {

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
							'table'				=> 'policies'),
						array(
							'name'				=> 'agencies_id',
							'description'		=> 'Агенція',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 15,
							'table'				=> 'policies',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'title',
							'orderField'		=> 'id'),
						array(
							'name'				=> 'agents_id',
							'description'		=> 'Агент',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 16,
							'table'				=> 'policies',
							'sourceTable'		=> 'accounts',
							'selectField'		=> 'lastname',
							'orderField'		=> 'id'),
						array(
							'name'				=> 'cons_agents_id',
							'description'		=> 'Агент консультация',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'policies',
							'sourceTable'		=> 'accounts',
							'selectField'		=> 'lastname',
							'orderField'		=> 'id'),	
						array(
							'name'				=> 'clients_id',
							'description'		=> 'clients_id',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'policies'),
						array(
							'name'				=> 'product_types_id',
							'description'		=> 'Тип',
					        'type'				=> fldSelect,
					        'structure'			=> 'tree',
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
							'orderPosition'		=> 1,
							'table'				=> 'policies',
							'sourceTable'		=> 'product_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер',
					        'type'				=> fldText,
					        'maxlenght'			=> 14,
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
							'orderPosition'		=> 2,
							'table'				=> 'policies'),
						array(
							'name'				=> 'sub_number',
							'description'		=> 'Адендум',
					        'type'				=> fldText,
					        'maxlenght'			=> 3,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 2,
							'table'				=> 'policies'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата',
					        'type'				=> fldDate,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false,
								),
							'orderPosition'		=> 3,
							'table'				=> 'policies'),
						array(
							'name'				=> 'item',
							'description'		=> 'Об\'єкт',
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
							'orderPosition'		=> 4,
							'table'				=> 'policies'),
						array(
							'name'				=> 'price',
							'description'		=> 'Сума, грн.',
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
							'orderPosition'		=> 5,
							'table'				=> 'policies'),
						array(
							'name'				=> 'amount',
							'description'		=> 'Премія, грн.',
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
							'orderPosition'		=> 6,
							'table'				=> 'policies'),
						array(
							'name'				=> 'rate',
							'description'		=> 'Тариф, %',
					        'type'				=> fldPercent,
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
							'orderPosition'		=> 7,
							'table'				=> 'policies'),
						array(
							'name'				=> 'begin_datetime',
							'description'		=> 'Початок',
					        'type'				=> fldDate,
					        'input'				=> true,
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
							'table'				=> 'policies'),
                        array(
                            'name'              => 'interrupt_datetime',
                            'description'       => 'Закінчення',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 9,
                            'table'             => 'policies'),
						array(
							'name'				=> 'policy_statuses_id',
							'description'		=> 'Статус',
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
							'orderPosition'		=> 10,
							'table'				=> 'policies',
							'sourceTable'		=> 'policy_statuses',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'payment_statuses_id',
							'description'		=> 'Оплата',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 11,
							'table'				=> 'policies',
							'sourceTable'		=> 'payment_statuses',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						 array(
                            'name'              => 'documents',
                            'description'       => 'Документи',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 12,
                            'table'             => 'policies'),	
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
							'orderPosition'		=> 13,
                            'width'             => 100,
							'table'				=> 'policies'),
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
							'orderPosition'		=> 14,
                            'width'             => 100,
							'table'				=> 'policies'),
						
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 14,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'number'
					)
				);

    function Policies($data) {
		global $db;

        $this->object = 'Policies';

        Form::Form($data);

        $this->messages['plural'] = 'Поліси';
        $this->messages['single'] = 'Поліс';

        $this->messages['changeStatus'] = '%. Зміна статусу';

        $this->setSubMode($data);

		//массив сравнения полисов
		$this->values = array();

		$id = (is_array($data['id'])) ? $data['id'][0] : $data['id'];

		if (intval($id) && !intval($data['next_policy_statuses_id'])) {
			$row = $db->getRow('SELECT next_policy_statuses_id FROM ' . PREFIX . '_policies WHERE id = ' . intval($id));
			$data = array_merge($data, $row);
		}
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'		=> true,
                    'insert'	=> false,
                    'update'	=> false,
                    'view'		=> true,
                    'change'	=> false,
                    'delete'	=> true);
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'		=> true,
                    'insert'	=> false,
                    'update'	=> false,
                    'view'		=> true,
                    'change'	=> false,
                    'delete'	=> false);
                break;
            case ROLES_MASTER:
                $this->permissions = array(
                    'view'		=> true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Log, $Authorization, $POLICY_STATUSES_SCHEMA;
 
		$result = parent::checkPermissions($action, $data, $redirect);

        switch ($action) {
            case 'update':
			case 'spoilPolicy':
			case 'copyPolicy':
			case 'renewPolicy':
			case 'continuePolicy':
			case 'cancelPolicy':
			case 'view':

                $conditions[] = (is_array($data['id']))
                    ? 'a.id = ' . intval($data['id'][0])
                    : 'a.id = ' . intval($data['id']);

                //ограничение по точке продаж или клиентом
                switch ($Authorization->data['roles_id']) {
                    case ROLES_AGENT:
						
					    if ($Authorization->data['top_agencies_id'] == 422 && $action=='view') {//астрабанк видит все свои полиса
							$conditions[] = 'financial_institutions_id = 33'; 
						}
						elseif(ereg('KASKO', $this->objectTitle)&& $action=='view' && $_SESSION['auth']['agent_financial_institutions_id']==25 && $Authorization->data['agencies_id'] == 561) //идея
						{
							$conditions[] = 'financial_institutions_id = 25';
						}
						elseif(($Authorization->data['agencies_id']==SELLER_AGENCIES_ID || $Authorization->data['agencies_id']==236) && ($action=='view' || $action=='cancelPolicy' || $action=='copyPolicy' || $action=='renewPolicy')) {
							//со спец агенции может видеть все полиса и расторгать
							$Authorization->data['quote_police'] = true;
						}
						elseif ($Authorization->data['id'] == 8900) //Колесников	Дмитрий Правекс
						{
			
							$Agencies = new Agencies($data);
							$agencies_id = array($Authorization->data['agencies_id']);
							$Agencies->getSubId(&$agencies_id, $Authorization->data['agencies_id']);
							$conditions[] =	'a.agencies_id IN (' . implode(', ', $agencies_id).')' ;
						}
						else
						{
							$Agencies = new Agencies($data);
							$agencies_id = array(intval($Authorization->data['agencies_id']));
							if ($action=='view' || $action=='renewPolicy') $Agencies->getSubId(&$agencies_id, intval($Authorization->data['agencies_id']));
							
							if ($Authorization->data['id'] == 11409 && $data['product_types_id'] == 22) {
								$agencies_id[] = AGENCY_SATIS;
							}
							if (($Authorization->data['id'] == 13723 || $Authorization->data['id'] == 13740) && $data['product_types_id'] == 22) {
								$agencies_id[] = 556;
								$agencies_id[] = 1;
							}
					
							$conditions[] = is_array($Authorization->data['subAgenciesId']) ? 
								'(  a.agencies_id IN (' . implode(', ', $Authorization->data['subAgenciesId']).') OR  a.seller_agencies_id IN (' . implode(', ', $Authorization->data['subAgenciesId']).') )' :
								'(  a.agencies_id   IN(' . implode(', ', $agencies_id) . ')  OR a.seller_agencies_id = ' . intval($Authorization->data['agencies_id']).')';
						}
						if ($action == 'update' && !$Authorization->data['ankets'] && !$Authorization->data['agencies_id']==1492) {
							$conditions[] =' a.policy_statuses_id ='.POLICY_STATUSES_CONSULTATION;
						}
						
                        break;
                    case ROLES_CLIENT_CONTACT:
                        $conditions[] = 'a.clients_id = ' . intval($Authorization->data['clients_id']);
                        break;
                }

                $sql =	'SELECT a.types_id, a.product_types_id, a.policy_statuses_id, TO_DAYS(b.buh_date) AS buh_days, TO_DAYS(c.mtsbu_date) AS mtsbu_days ' .
                        'FROM ' . $this->tables[0] . ' AS a ' .
                        'LEFT JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policy_blanks AS c ON b.blank_series = c.series AND b.blank_number = c.number ' .
						'LEFT JOIN ' . PREFIX . '_policies_kasko AS d ON a.id = d.policies_id ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $row = $db->getRow($sql);
				//_dump($sql);exit;

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['permissions']['PolicyQuotes']['insert']) {
					$data['checkPermissions'] = 1;
				}

				if (!is_array($row) && $data['checkPermissions'] != 1) {
					return parent::checkPermissions($action, $data, true);
				} elseif ($action!='view' && $action!='cancelPolicy' && $action!='copyPolicy' && $_POST['do']!='Policies|copyPolicy' && $_POST['do']!='Policies|renewPolicy' && $_GET['do']!='Policies|renewPolicy' && $row['product_types_id'] == PRODUCT_TYPES_GO && ($row['buh_days'] || $row['mtsbu_days']) && $_POST['do']!='Policies|loadPolicy' && $data['checkPermissions'] != 1) {
					$Log->add('error', 'Будь які зміни з полісом заборонені. Інформація передана до бухгалтерії або МТСБУ.');
                    return parent::checkPermissions($action, $data, true);
                }

                $product_types = array(PRODUCT_TYPES_CARGO_GENERAL, PRODUCT_TYPES_DRIVE_GENERAL);

				if ($data['checkPermissions'] != 1 && $action!='view' &&  !in_array($row['product_types_id'], $product_types)) {
					$actions = array('spoilPolicy', 'copyPolicy', 'renewPolicy', 'continuePolicy', 'cancelPolicy');

					$Authorization->data['quote_police'] = $Authorization->data['permissions']['PolicyQuotes']['insert'];
					if (sizeOf($POLICY_STATUSES_SCHEMA[ $row['policy_statuses_id'] ]) == 1 && !in_array($action, $actions) || ($Authorization->data['roles_id'] == ROLES_MANAGER && $row['types_id'] == 2 && !$Authorization->data['quote_police'])) {

						return parent::checkPermissions($action, $data, true);
					}
				}
                break;
        }

        return $result;
    }

    function factory($data, $type=null) {

        if (!$type) {
            $type = ProductTypes::get($data['product_types_id']);
        }

        require_once 'Policies/' . $type . '.class.php';

        $class = 'Policies_' . $type;

        @$obj =& new $class($data);

        if (!ereg('show|exportInWindow$', $data['do'])) {
            $obj->formDescription['fields'][ $obj->getFieldPositionByName('agents_id') ]['type'] = fldHidden;
            //$obj->formDescription['fields'][ $obj->getFieldPositionByName('client_contacts_id') ]['type'] = fldHidden;
        }

        return $obj;
    }

    function setMode($data) {
        if ($data['policies_id']) {
            $data['id'] = $data['policies_id'];
        } elseif (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        if (ereg('^(' . $this->object . '|Policies|PolicyMessages)\|view$', $data['do'])) {
            $this->mode = $_SESSION['Policies'][ $data['id'] ]['mode'] = 'view';
        } elseif (ereg('^(' . $this->object . '|Policies|PolicyMessages)\|(add|quote|insert|copy|load|update|spoilPolicy|copyPolicy|renewPolicy|continuePolicy|loadPolicy)$', $data['do'])) {
            $this->mode = $_SESSION['Policies'][ $data['id'] ]['mode'] = 'update';
        } else {
            $this->mode = $_SESSION['Policies'][ $data['id'] ]['mode'];
        }
    }

    function getMode($id) {
        return $_SESSION['Policies'][ $id ]['mode'];
    }

    //установка режима расчета страхового тарифа
    //calculate - расчитать страховой тариф
    //set - установка страховых параметров на основании переданных
    function setSubMode($data) {
        global $db, $UNDERWRITING_POLICY_STATUSES;

        if ($data['policies_id']) {
            $data['id'] = $data['policies_id'];
        } elseif (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        switch ($data['do']) {
            case $this->object . '|add':
            case $this->object . '|insert':
            case $this->object . '|copy':
                $this->subMode = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|load':

                $sql =	'SELECT types_id, policy_statuses_id ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE id = ' . intval($data['id']);
                $row =	$db->getRow($sql);

                $this->subMode = ( ($row['policy_statuses_id'] == POLICY_STATUSES_CREATED && $row['types_id'] == POLICY_TYPES_QUOTE) || in_array($row['policy_statuses_id'], $UNDERWRITING_POLICY_STATUSES) || $data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|update':
                $this->subMode = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|renewPolicy':
            case $this->object . '|continuePolicy':
            case $this->object . '|cancelPolicy':
            case $this->object . '|loadPolicy':
                $this->subMode = 'calculate';
                break;
        }

        if ($this->subMode) {
            $_SESSION[ 'Policies' ][ $data['id'] ]['subMode'] = $this->subMode;
        }
    }

    function getSubMode($id) {
        return ($_SESSION[ 'Policies' ][ $id ]['subMode']) ? $_SESSION[ 'Policies' ][ $id ]['subMode'] : 'calculate';
    }

    function getReadonly($select, $close=false) {
        return ($this->mode == 'update' && !$close)
			? ''
			: (($select) ? 'disabled' : 'readonly') . ' style="color: #666666; background-color: #f5f5f5;"';
    }

    function copy($data) {
        $this->checkPermissions('copy', $data);
		$data['checkPermissions'] = 1;
        $data = $this->load($data, false);
		unset($data['checkPermissions']);
        unset($data['types_id']);
        unset($data['policy_statuses_id']);
        unset($data['id']);
		unset($data['parent_id']);
		unset($data['top']);
        unset($data['number']);
        unset($data['begin_datetime_year']);
        unset($data['begin_datetime_month']);
        unset($data['begin_datetime_day']);
        unset($data['end_datetime_year']);
        unset($data['end_datetime_month']);
        unset($data['end_datetime_day']);
        unset($data['date_day']);
        unset($data['date_month']);
        unset($data['date_year']);
		unset($data['card_assistance']);
		unset($data['payment_datetime_day']);
		unset($data['payment_datetime_month']);
		unset($data['payment_datetime_year']);
		unset($data['blank_series']);
		unset($data['blank_number']);
		unset($data['stiker_series']);
		unset($data['stiker_number']);
		unset($data['manager_id']);
		
		
 
		unset($data['payment_number']);
		
        $this->add($data);
    }

    function getFormFields($action) {
        $indexFieldTable = $this->getIdentityFieldTable();

        foreach($this->formDescription['fields'] as $field) {
            if ($field['display'][ $action ] && (PREFIX . '_' . $field['table'] == $this->tables[0] || PREFIX . '_' . $field['table'] == $this->tables[1])) {
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

    function getRowClass($row, $i) {

        $result = parent::getRowClass($row, $i);

        switch ($row['payment_statusesid']) {
            case PAYMENT_STATUSES_NOT:
                $result .= ($row['commission'] && isset($row['commission'])) ? ' documents' : '';
                break;
            case PAYMENT_STATUSES_PARTIAL:
                $result .= ($row['commission'] || !isset($row['commission'])) ? ' partial' : ' partial commission';
                break;
            case PAYMENT_STATUSES_PAYED:
                $result .= ($row['commission'] || !isset($row['commission'])) ? ' payed' : ' payed commission bold';
                break;
            case PAYMENT_STATUSES_OVER:
                $result .= ($row['commission'] || !isset($row['commission'])) ? ' over' : ' over commission bold';
                break;
        }
		
		$result .= ($row['policy_comment'] && isset($row['policy_comment'])) ? ' comment' : '';

        switch ($row['statuses_id']) {
            case POLICY_STATUSES_CREATED:
                $result .= ' created';
                break;
            case POLICY_STATUSES_ERROR:
                $result .= ' error';
                break;
        }

        if ($row['manual']) {
            $result .= ' manual';
        }

        if ($row['is_bank']) {
            $result .= ' is_bank';
        }

        return $result;
    }

    function getShowFieldsSQLString() {
        $result = ' SQL_CALC_FOUND_ROWS '.parent::getShowFieldsSQLString();

        $result .= ', policy_statuses_id as statuses_id, fotos,policy_comment,comment_user ';

        return $result;
    }

    function getRowValues($data, $row, $hidden, $total, $object=null) {

        if (intval($row['fotos'])) {
            $row['number'] .= '&nbsp;<img src="/images/photo.jpg" width="13" height="9" alt="Файли приєднані до полісу" />&nbsp;';
        }
		
		if (intval($row['message'])) {
			$row['number'] .= '&nbsp;<img src="/images/message.gif" width="19" height="19" alt="Нові повідомлення" />&nbsp;';
		}

        if (intval($row['new'])) {
            $row['number'] .= '&nbsp;<img src="/images/message.gif"  alt="Не прочитані ручні повідомлення" />&nbsp;';
        }

        return parent::getRowValues($data, $row, $hidden, $total, $object);
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization, $PAYMENT_STATUSES, $POLICY_STATUSES_SCHEMA;

        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];

		$working_banks = array(1,34,25,39,19,46,28,40);//банки которые работают со своей базой 
			//УкрсоцБанк Правекс Банк Идея Банк Универсал Банк ВБР Банк УкргазБанк
			
        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
				if ($Authorization->data['agencies_id'] == AGENCY_SATIS && $data['product_types_id'] != 22) {
					header('Location: /index.php');
					exit;
				}
			
                //$fields[] = 'agencies_id';
				if ($Authorization->data['agencies_id']!=SELLER_AGENCIES_ID ) {
					$data['agencies_id'] = $Authorization->data['agencies_id'];
					if (is_array($Authorization->data['subAgenciesId']))  $data['agencies_id'] = $Authorization->data['subAgenciesId'];
					if ($Authorization->data['agencies_id']!=SELLER_AGENCIES_ID) unset($this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]);
					unset($this->formDescription['fields'][ $this->getFieldPositionByName('mtsbu_date') ]);
					
					if ($Authorization->data['specialAgent']) $data['specialAgent'] = true;
					
					
					if ($data['product_types_id'] == PRODUCT_TYPES_KASKO && (intval($_SESSION['auth']['agent_financial_institutions_id']) == 0 || intval($_SESSION['auth']['agent_financial_institutions_id'])==40)) {
						//тут ограничения на агентов сети не банков
						$agencies_id = intval($_SESSION['auth']['agencies_id']);
						if ($agencies_id==1 || $agencies_id==SELLER_AGENCIES_ID) {
							//Экспресс страхование или Отдел продаж ограничений на видимость КАСКО нету
						} else {
						/*
							4.	Остальные агенции (СКС дилерской сети Корпорации):
							4.1.	КАСКО Ритейл: могут видеть свою базу и работать с ней 
							4.2.	КАСКО Банк: не видят базу, не имеют права пролонгировать. Исключения:
								•	видят договора, по которым отсутствуют индификаторы «Комісія», «Оплата» (в случае, когда договор учитывает разбивку платежа – видимость сохраняется до подтверждения оплаты по последнему платежу согласно графика)
								•	видят договора «створені» Відділом продажу ТДВ "Експрес Страхування" и имеют доступ к их доработке
						*/
							$addtional= ' ';
							if ($data['number']) {
								$addtional = ' OR '.$this->tables[1] . '.financial_institutions_id IN (1,34,25,39,19,40) ';
							}
							$conditions[] = '
								IF('.$this->tables[1] . '.financial_institutions_id =0 OR '.$this->tables[1] . '.akt_date IS NULL  OR '.$this->tables[0] . '.payment_statuses_id=1 OR '.$this->tables[0] . '.commission=0 '.$addtional.' ,1,0)
							';
						}
								/*$conditions[] = 'IF (
													' . $this->tables[1] . '.financial_institutions_id IN (34, 40, 25, 39), 
														IF (
															CONCAT_WS(\'-\', date_format(ADDDATE(NOW(), INTERVAL 45 DAY), \'%Y\'), date_format(' . $this->tables[0] . '.interrupt_datetime, \'%m\'), date_format(' . $this->tables[0] . '.interrupt_datetime, \'%d\')) BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL 45 DAY) AND CONCAT_WS(\'-\', date_format(ADDDATE(NOW(), INTERVAL 45 DAY), \'%Y\'), date_format(' . $this->tables[0] . '.interrupt_datetime, \'%m\'), date_format(' . $this->tables[0] . '.interrupt_datetime, \'%d\')) > ' . $this->tables[0] . '.begin_datetime,
															0,
															1
														),
														1
												)';
								*/
					}
				}	
                break;
            case ROLES_MANAGER:
                if (!isset($Authorization->data['permissions']['Policies_GO']['mtsbu_date']))
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('mtsbu_date') ]);
                break;
            default:
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]);
                break;
        }

		if (intval($data['top'])) {
			$fields[] = 'child_id';
			unset($data['number']);
			unset($data['insurer']);
			$conditions[] = $this->tables[0] . '.top = '.intval($data['top']);
        } else if ($data['product_types_id'] == PRODUCT_TYPES_DRIVE_GENERAL) {
			$conditions[] = $this->tables[0] . '.id = ' . $this->tables[0] . '.top';
		} elseif (!$data['number'] && !$data['shassi'] && !$data['insurer'] && !$data['from'] && !$data['to'] && $data['product_types_id']<>4 && !$data['clients_id']) {
			$conditions[] = $this->tables[0] . '.child_id = 0';
		}

		if (!$data['ECmode(']) {
			if ($data['number'] && intval($data['top'])==0) {
				$fields[] = 'number';
				$conditions[] = $this->tables[0] . '.number LIKE ' . $db->quote(trim($data['number']) . '%');
			}

			if ($data['insurer'] && intval($data['top'])==0) {
				$fields[] = 'insurer';
				$conditions[] = $this->tables[0] . '.insurer LIKE ' . $db->quote($data['insurer'] . '%');
			}


            if ($data['policy_comment'] && intval($data['top'])==0) {
				$fields[] = 'policy_comment';
				$conditions[] = $this->tables[0] . '.policy_comment LIKE ' . $db->quote($data['policy_comment'] . '');
			}

			if (intval($data['product_types_id'])) {
				$fields[] = 'product_types_id';

				$ProductTypes = new ProductTypes($data);
				$product_types = array($data['product_types_id']);
				$ProductTypes->getSubId(&$product_types, $data['product_types_id']);

				$conditions[] = $this->tables[0] . '.product_types_id IN(' . implode(', ', $product_types) . ')';
			}

			if ($data['year']) {
				$fields[] = 'year';
				$conditions[] = $this->tables[0] . '.id IN (SELECT  policies_id FROM insurance_policies_kasko_items WHERE year= ' . $db->quote($data['year']).')';
			}

			if ($data['shassi']) {
				$fields[] = 'shassi';
				if($data['product_types_id'] == PRODUCT_TYPES_KASKO)
                    $conditions[] = $this->tables[0] . '.id IN (SELECT  policies_id FROM insurance_policies_kasko_items WHERE shassi LIKE ' . $db->quote($data['shassi'].'%').')';
                if($data['product_types_id'] == PRODUCT_TYPES_GO)
                    $conditions[] = $this->tables[0] . '.id IN (SELECT  policies_id FROM insurance_policies_go WHERE shassi LIKE ' . $db->quote($data['shassi'].'%').')';
			}

			if ($data['sign']) {
				$fields[] = 'shassi';
				if($data['product_types_id'] == PRODUCT_TYPES_KASKO)
                    $conditions[] = $this->tables[0] . '.id IN (SELECT  policies_id FROM insurance_policies_kasko_items WHERE sign LIKE ' . $db->quote('%' .$data['sign'].'%').')';
                if($data['product_types_id'] == PRODUCT_TYPES_GO)
                    $conditions[] = $this->tables[0] . '.id IN (SELECT  policies_id FROM insurance_policies_go WHERE sign LIKE ' . $db->quote($data['sign'].'%').')';
			}
			
			if ($data['options_test_drive']) {
				$fields[] = 'options_test_drive';
				$conditions[] = $this->tables[1] . '.options_test_drive =1';
			}

			if ($data['options_race']) {
				$fields[] = 'options_race';
				$conditions[] = $this->tables[1] . '.options_race =1';
			}

			if ($data['special']) {
				$fields[] = 'special';
				$conditions[] = $this->tables[1] . '.special =1';
			}

			if (is_array($data['policy_statuses_id'])) {
				$fields[] = 'policy_statuses_id';
				$conditions[] = 'policy_statuses_id IN(' . implode(', ', $data['policy_statuses_id']) . ')';
			}

			if (is_array($data['payment_statuses_id'])) {
				$fields[] = 'payment_statuses_id';
				$conditions[] = 'payment_statuses_id IN(' . implode(', ', $data['payment_statuses_id']) . ')';
			}

			if ($_SESSION['auth']['agent_financial_institutions_id']>0 && in_array($_SESSION['auth']['agent_financial_institutions_id'], $working_banks)) {//банки которые работают со своей базой
				$data['financial_institutions_id'] = $_SESSION['auth']['agent_financial_institutions_id'];
			}

			if (intval($data['financial_institutions_id']) && ereg('KASKO|Property|NS|Mortage', $this->objectTitle)) {
				$fields[] = 'financial_institutions_id';
                switch($data['product_types_id']){
                    case 3:
                        $suffix = 'kasko';
                        break;
                    case 12:
                        $suffix = 'property';
                        break;
					case 13:
                        $suffix = 'ns';
                        break;	
					case 15:
						$suffix = 'mortage';
						break;
                }
				$conditions[] = 'insurance_policies_' . $suffix . '.financial_institutions_id = ' . intval($data['financial_institutions_id']);
			}

			if ($data['from']) {
				$fields[] = 'from';
				$conditions[] = 'TO_DAYS(' . $this->tables[0] . '.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
			}

			if ($data['to']) {
				$fields[] = 'to';
				$conditions[] =  'TO_DAYS(' . $this->tables[0] . '.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
			}

			if ($data['frombegin_datetime']) {
				$fields[] = 'frombegin_datetime';
				$conditions[] = 'TO_DAYS(' . $this->tables[0] . '.begin_datetime) >= TO_DAYS(' . $db->quote( substr($data['frombegin_datetime'], 6, 4) . substr($data['frombegin_datetime'], 3, 2) . substr($data['frombegin_datetime'], 0, 2) ) . ')';
			}

			if ($data['tobegin_datetime']) {
				$fields[] = 'tobegin_datetime';
				$conditions[] =  'TO_DAYS(' . $this->tables[0] . '.begin_datetime) <= TO_DAYS(' . $db->quote( substr($data['tobegin_datetime'], 6, 4) . substr($data['tobegin_datetime'], 3, 2) . substr($data['tobegin_datetime'], 0, 2) ) . ')';
			}

			if (intval($data['agencies_id']) && !is_array($data['agencies_id'])) {
			
				if(ereg('KASKO', $this->objectTitle) && $_SESSION['auth']['agent_financial_institutions_id']>0 && in_array($_SESSION['auth']['agent_financial_institutions_id'], $working_banks)) {//банки которые работают со своей базой
				    //нету ограничения по агенции для КАСКО но есть ограничение по банку выше
				} else {
					$fields[] = 'agencies_id';
					
					$Agencies = new Agencies($data);
					$agencies_id = array($data['agencies_id']);
					$Agencies->getSubId(&$agencies_id, $data['agencies_id']);
					
					if ($Authorization->data['id'] == 11409 && $data['product_types_id'] == 22) {
						$agencies_id[] = AGENCY_SATIS;
					}
					if (($Authorization->data['id'] == 13723 || $Authorization->data['id'] == 13740) && $data['product_types_id'] == 22) {
						$agencies_id[] = 556;
						$agencies_id[] = 1;
					}

					$conditions[] = 
    					'('.
        					$this->tables[0] . '.agencies_id IN(' . implode(', ', $agencies_id) . ') OR '.
	        				$this->tables[0] . '.seller_agencies_id IN(' . implode(', ', $agencies_id) . ') '.
			    		')';
				}
			}
					
			if (is_array($data['agencies_id']) && sizeof($data['agencies_id'])>0) {
				
				if(ereg('KASKO', $this->objectTitle) && $_SESSION['auth']['agent_financial_institutions_id']>0 && in_array($_SESSION['auth']['agent_financial_institutions_id'], $working_banks)) {//банки которые работают со своей базой
                    $conditions[] = 'IF(policy_statuses_id=1 ,'.$this->tables[0] . '.agencies_id IN (' . implode(', ', $data['agencies_id']).'), 1)';
				} else {
					$fields[] = 'agencies_id';
					if ($data['specialAgent']) {
						$conditions[] = '('.$this->tables[0] . '.agencies_id='.intval($_SESSION['auth']['agencies_id']).' OR '.$this->tables[0] . '.seller_agencies_id='.intval($_SESSION['auth']['agencies_id']).' OR ( '.$this->tables[0] . '.agencies_id IN (' . implode(', ', $data['agencies_id']).') AND '.$this->tables[0] . '.end_datetime BETWEEN  DATE_SUB(NOW(),INTERVAL 2 MONTH) AND DATE_ADD(NOW(),INTERVAL 2 MONTH)))';
                    } else {
						$conditions[] =
					    	'('.
						        $this->tables[0] . '.agencies_id IN (' . implode(', ', $data['agencies_id']).') OR '.
						        $this->tables[0] . '.seller_agencies_id IN (' . implode(', ', $data['agencies_id']).') '.
						    ')';
                    }
				}
			}

			if (intval($data['insurance_companies_id'])) {
				$fields[] = 'insurance_companies_id';
				$conditions[] = $this->tables[0] . '.insurance_companies_id = ' . intval($data['insurance_companies_id']);
			}

			if ($data['clients_id']) {
				$fields[] = 'clients_id';
				$conditions[] = $this->tables[0] . '.clients_id = ' . intval($data['clients_id']);
			}
		}

        $fields[] = 'manual';

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } else {

			$mes = '';
			$join = $this->getJoinConditions('show' );
			if ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO) {
				$mes =' ,IF(' . PREFIX . '_policy_messages.policies_id, 1, 0) as new ';
				$this->tables[] =   PREFIX . '_policy_messages';
				if ($Authorization->data['roles_id']==ROLES_AGENT) {
					$join.=  ' LEFT JOIN '. PREFIX . '_policy_messages ON '.	$this->tables[0] . '.id = ' . PREFIX . '_policy_messages.policies_id AND ' . PREFIX . '_policy_messages.manual=1 AND ' . PREFIX . '_policy_messages.recipient_roles_id=8 AND ' . PREFIX . '_policy_messages.id NOT IN (SELECT messages_id FROM ' . PREFIX . '_policy_message_views WHERE accounts_id ='.$Authorization->data['id'].')';
				}
				else {
					$join.=  ' LEFT JOIN '. PREFIX . '_policy_messages ON '.	$this->tables[0] . '.id = ' . PREFIX . '_policy_messages.policies_id AND ' . PREFIX . '_policy_messages.manual=1 AND ' . PREFIX . '_policy_messages.recipient_roles_id=2 AND ' . PREFIX . '_policy_messages.id NOT IN (SELECT messages_id FROM ' . PREFIX . '_policy_message_views WHERE accounts_id IN (' . implode(', ', $Authorization->data['managers']) . '))';
				}

			}
		 
			$sql = ($this->getFieldPositionByName('payment_statuses_id')>0)
				? 'SELECT DISTINCT ' . $this->getShowFieldsSQLString() . ', ' . PREFIX . '_payment_statuses.id as payment_statusesid, ' . PREFIX . '_policies.product_types_id AS productTypesId '.$mes.' FROM  '. $this->tables[0] . ' '
				: 'SELECT DISTINCT ' . $this->getShowFieldsSQLString() . ', ' . PREFIX . '_policies.product_types_id AS productTypesId '.$mes.' FROM ' . $this->tables[0] . ' ';
		 
		
			

            if (is_array($conditions)) {
                $sql .= '  ' . $join . ' WHERE ' . implode(' AND ', $conditions) . ' ORDER BY ';
            } else {
                $sql .= $join . ' ORDER BY ';
            }
        }

        $sql = str_replace('_agents.id', '_agents.accounts_id', $sql);
        $sql = str_replace('_client_contacts.id', '_client_contacts.accounts_id', $sql);

		if ($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE) { //домножаем на 110% от стоимости багажа
			$sql = str_replace(PREFIX.'_policies.price', 'ROUND((' .PREFIX. '_policies.price* ' .PREFIX.'_policies_cargo.price_percent) / 100, 2) as price ', $sql);
		}


        switch ($Authorization->data['roles_id']) {
            case ROLES_CLIENT_CONTACT:
                $data['total'] = $db->getRow(str_replace('count(*)', 'SUM(price) as price, SUM(amount) as amount', transformToGetCount($sql)));
                break;
        }

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
//_dump($sql);
        $list = $db->getAll($sql);
		$total = $db->getOne('SELECT FOUND_ROWS()');

        if ($template != 'showGeneral.php') {
            $fields['policy_statuses_id']            	= $this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ];
            if (intval($data['product_types_id'])) {
                $fields['policy_statuses_id']['condition']	= 'id IN(' . implode(', ', array_keys($POLICY_STATUSES_SCHEMA)) . ')';
            }
            $fields['policy_statuses_id']['list']    	= $this->getListValue($fields['policy_statuses_id'], $data);
            $fields['policy_statuses_id']['object']  	= $this->buildSelect($fields['policy_statuses_id'], $data['policy_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);
        }

        $fields['payment_statuses_id']				= $this->formDescription['fields'][ $this->getFieldPositionByName('payment_statuses_id') ];
        $fields['payment_statuses_id']['type']   	= fldMultipleSelect;
        $fields['payment_statuses_id']['list']   	= $PAYMENT_STATUSES;
        $fields['payment_statuses_id']['object'] 	= $this->buildSelect($fields['payment_statuses_id'], $data['payment_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);

	    $sql =	'SELECT id, code, title, level ' .
                'FROM ' . PREFIX . '_agencies ' .
                'ORDER BY CAST(code AS UNSIGNED),num_l';				
        $agencies = $db->getAll($sql, 60 * 60);

        $sql =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_financial_institutions  ' .
                'ORDER BY title';
        $financial_institutions = $db->getAll($sql, 60 * 60);

        $sql =	'SELECT id, company ' .
                'FROM ' . PREFIX . '_clients ' .
				'WHERE client_groups_id = 1 AND person_types_id<>1 ' .
                'ORDER BY company';
        $clients = $db->getAll($sql, 60 * 60);

		include 'Policies/' . $template;
    }

	
	function getJoinConditions($action ) {
        foreach($this->formDescription['fields'] as $field) {

            if (!isset($index)) {
                $index = $field;
                $tables = array();
            }

            if ($field['sourceTable'] && $field['display'][ $action ] && $field['type'] != fldMultipleSelect) {
                $conditions[] = ' JOIN '.PREFIX . '_' . $field['sourceTable']. ' ON '.PREFIX . '_' . $field['table'] . '.' . $field['name'] . '=' . PREFIX . '_' . $field['sourceTable'] . '.id';
            } elseif ($field['type'] != fldMultipleSelect && $field['table'] != $index['table'] && !in_array($index['table'], $tables)) {
                $conditions[] = ' JOIN '.PREFIX . '_' . $field['table'].' ON '.PREFIX . '_' . $index['table'] . '.' . $index['name'] . '=' . PREFIX . '_' . $field['table'] . '.' . $index['table'] . '_id';
                $tables[] = $index['table'];
            }
        }

        if ($conditions) {
            return   implode(' ', $conditions)  ;
        }
		return ' ';
    }
	
    function getListValue($field, $data) {
        global $db;

		if ($field['name'] == 'sign_agents_id') {
			$options = array();

			$conditions[] = 'roles_id = ' . ROLES_AGENT;
			$conditions[] = ' ((LENGTH(director1) > 0 AND LENGTH(director2) > 0 AND a.active=1) OR a.id='.intval($data['sign_agents_id']).') ';
			$conditions[] = '(agencies_id = ' . intval($data['agencies_id']) . ' OR agencies_id IN (SELECT parent_id FROM ' . PREFIX . '_agencies WHERE id =' . intval($data['agencies_id']) . '))';

			$sql =	'SELECT id, CONCAT(lastname, \' \', firstname,\' \', patronymicname) AS title ' .
					'FROM ' . PREFIX . '_accounts AS a ' .
					'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'ORDER BY lastname, firstname';
			$list = $db->getAll($sql, 300);
			$options = array('0' => '...');
			if (is_array($list)) {
				foreach ($list as $row) {
					$options[ $row['id'] ] = array(
						'title' => $row['title'],
						'obligatory' => $row['obligatory']);
				}
			}
			if ($data['seller_agencies_id']>0)  {
				$conditions=array();
				$conditions[] = 'roles_id = ' . ROLES_AGENT;
				$conditions[] = 'LENGTH(director1) > 0 AND LENGTH(director2) > 0';
				$conditions[] = '(agencies_id = ' . intval($data['seller_agencies_id']) . ' OR agencies_id IN (SELECT parent_id FROM ' . PREFIX . '_agencies WHERE id =' . intval($data['seller_agencies_id']) . '))';

				$sql =	'SELECT id, CONCAT(lastname, \' \', firstname,\' \', patronymicname) AS title ' .
						'FROM ' . PREFIX . '_accounts AS a ' .
						'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY lastname, firstname';
				$list = $db->getAll($sql, 300);
				if (is_array($list)) {
					foreach ($list as $row) {
						$options[ $row['id'] ] = array(
							'title' => $row['title'],
							'obligatory' => $row['obligatory']);
					}
				}
			}

			return $options;
		} 
		elseif ($field['name'] == 'manager_id') {
			$options = array();

			$conditions[] = 'roles_id = ' . ROLES_AGENT;
			if ($data['id']>0) {
				$current_agent = intval($db->getOne('SELECT manager_id FROM insurance_policies WHERE id = '.intval($data['id']).' '));
				$conditions[] = '(active=1 OR id='.$current_agent.')';
			}
			else
				$conditions[] = 'active=1';
			$conditions[] = '(agencies_id = ' . intval($data['agencies_id']) . ' OR agencies_id IN (SELECT parent_id FROM ' . PREFIX . '_agencies WHERE id =' . intval($data['agencies_id']) . ') OR agencies_id IN (SELECT id FROM ' . PREFIX . '_agencies WHERE parent_id =' . intval($data['agencies_id']) . '))';

			if ($data['id']>0 &&  intval($data['solutions_id'])==0) //полис уже создан машина не из ЭК
			{
				$agent = $db->getRow('SELECT b.ankets,b.seller,a.agencies_id FROM insurance_policies a JOIN  insurance_agents b  ON a.agents_id=b.accounts_id WHERE a.id = '.intval($data['id']).' ');
				if ($agent && $agent['ankets']) $conditions[] = '(b.seller=1 OR b.service=1)';
				elseif($agent && $agent['seller'] && $agent['agencies_id'] !=15) $conditions[] = '(b.ankets=1 OR b.service=1)'; 
			}
			elseif(intval($data['solutions_id'])==0 && $_SESSION['auth']['roles_id']==ROLES_AGENT) //полис не создан и это агент
			{
				$agent = $db->getRow('SELECT b.ankets,b.seller,b.agencies_id FROM  insurance_agents b  WHERE b.accounts_id = '.intval($_SESSION['auth']['id']).' ');
				if ($agent && $agent['ankets']) $conditions[] = '(b.seller=1 OR b.service=1)';
				elseif($agent && $agent['seller'] && $agent['agencies_id'] !=15) $conditions[] = '(b.ankets=1 OR b.service=1)'; 
			}
			$sql =	'SELECT id, CONCAT(lastname, \' \', firstname,\' \', patronymicname) AS title ' .
					'FROM ' . PREFIX . '_accounts AS a ' .
					'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'ORDER BY lastname, firstname';
			$list = $db->getAll($sql, 300);
			$options = array('0' => '...');
			if (is_array($list)) {
				foreach ($list as $row) {
					$options[ $row['id'] ] = array(
						'title' => $row['title'],
						'obligatory' => $row['obligatory']);
				}
			}

			return $options;
		}
		else {
			return parent::getListValue($field, $data);
		}

        reset($this->languages);

        $languageCode = ($field['multiLanguages'])
            ? $this->languageCode
            : '';

        $options = (($field['verification']['canBeEmpty']) && $field['type'] == fldSelect) ? array('0' => '...') : array();

        switch ($field['structure']) {
            case 'tree':
                $this->getOptions($field, $languageCode, $options);
                break;
            default:
                if ($field['condition']) {
                    $where = ' WHERE ' . $field['condition'];
                }

                if (!$field['selectId']) {
                    $field['selectId'] = 'id';
				}

                $field['orderField'] = ($field['selectField'] == $field['orderField'])
                    ? $field['orderField'] . $languageCode
                    : $field['orderField'];

                $sql =	'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title ' .
						'FROM ' . PREFIX . '_' . $field['sourceTable'] . $where . ' ' .
						'ORDER BY ' . $field['orderField'];
                $list = $db->getAll($sql, 300);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title' => $row['title'],
                            'obligatory' => $row['obligatory']);
                    }
                }
        }

        return $options;
    }

    function changeStep($data) {
        switch ($data['step']) {
            case 1:
                $action = ($this->mode == 'update') ? 'load' : 'view';
                header('Location: /?do=' . $this->object . '|' . $action . '&id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 2:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'Documents&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 3:
                header('Location: /?do=' . $this->object . '|loadStatus&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            default:
                header('Location: /?do=' . $this->object . '|show');
                exit;
                break;
        }
    }

    function updateStep($id, $step) {
        global $db;

        $sql =	'UPDATE ' . $this->tables[0] . ' ' .
                'SET step = ' . intval($step) . ' ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);
    }

    function showAgenda($data) {
        $type = '';
        switch ($data['product_types_id']) {
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                $type = 'Certificate';
                break;
			 case PRODUCT_TYPES_PROPERTY:
                $type = 'Property';
                break;
        }

        include_once ($_SESSION['Policies'][ $data['policies_id'] ]['mode'] == 'update')
            ? 'Policies/agenda' . $type . 'Update.php'
            : 'Policies/agenda' . $type . 'View.php';
    }

    function header($data) {
        include_once 'Policies/header.php';
    }

    function footer($data, $showNavigation = true, $form=null) {
        global $Authorization;
        if (is_null($form)) {
            $form = $this->objectTitle;
        }

        switch ($data['product_types_id']) {
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                $showNavigationBack         = true;
                $showNavigationNext         = true;
                $showNavigationBackToList	= true;
                break;
            case PRODUCT_TYPES_PROPERTY:
                $showNavigationBack         = true;
                $showNavigationNext         = true;
                $showNavigationBackToList	= true;
                break;
            default:
                $showNavigationSave         = ($this->mode == 'update') ? true : false;
        }
		if ($Authorization->data['agencies_id']==228) {
            $showNavigationSave = false;
        }

        include 'Policies/footer.php';
    }

    function getPolicyStatusesId($id) {
        global $db;

        $conditions[] = 'id = ' . intval($id);

        $sql =  'SELECT policy_statuses_id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getOne($sql);
    }

    function getpayment_statuses_id($id) {
        global $db;

        $sql = 'SELECT statuses_id ' .
               'FROM ' . PREFIX . '_policy_payments_calendar ' .
               'WHERE policies_id = ' . intval($id) . ' ' .
               'ORDER BY date ASC LIMIT 1';
        return $db->getOne($sql);

        //вынимаю ближайщий меньший по отношению к текущей дате
        /*$sql =  'SELECT statuses_id ' .
                'FROM ' . PREFIX . '_policy_payments_calendar ' .
                'WHERE policies_id = ' . intval($id) . ' AND TO_DAYS(date) <= TO_DAYS(NOW()) ' .
                'ORDER BY date DESC';
        $prev = $db->getRow($sql);

        if (!is_array($prev)) {
			//вынимаю ближайщий больший по отношению к текущей дате
			$sql =  'SELECT statuses_id ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' .
					'WHERE policies_id = ' . intval($id) . ' AND TO_DAYS(date) >= TO_DAYS(NOW()) ' .
					'ORDER BY date ASC';
			$next = $db->getRow($sql);

            return $next['statuses_id'];
        } else {
            return $prev['statuses_id'];
        }*/
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $Authorization, $POLICY_STATUSES_SCHEMA;

		$data['showCommission']						= false;
		$data['showCommissionFinancialInstitution'] = false;

		switch ($Authorization->data['roles_id']) {
			case ROLES_AGENT:
				if ($data['types_id'] == POLICY_TYPES_QUOTE) {
					//$data['showCommission'] = true;
				}
				break;
			default:
				$data['showCommission'] = true;
				$data['showCommissionFinancialInstitution'] = true;
				break;
		}

        if (!intval($data['policies_id'])) {
            $data['policies_id'] = $data['id'];
        }

        if ($this->getFieldPositionByName('policy_statuses_id')) {

            if (!intval($data['policy_statuses_id'])) {
                $data['policy_statuses_id'] = ($data['id']) ? $this->getPolicyStatusesId($data['policies_id']) : POLICY_STATUSES_CREATED;
            }

            $this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ]['condition'] = 'id IN(' . (sizeof($POLICY_STATUSES_SCHEMA[ $data['policy_statuses_id'] ]) ? implode(', ', $POLICY_STATUSES_SCHEMA[ $data['policy_statuses_id'] ]) : '0') . ')';
		}

        switch ($action) {
            case 'view':
                $action = $this->mode . 'Documents';
            case 'insert':
            case 'update':
                $data['step'] = 1;
                break;
            case 'viewDocuments':
            case 'updateDocuments':
                $data['step'] = 3;
                break;
            case 'loadStatus':
            case 'updateStatus':
                $data['step'] = 3;
                break;
        }

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->header($data);
        }

        parent::showForm($data, $action, $actionType, ($template) ? $template : strtolower(ProductTypes::get($data['product_types_id'])) . '.php');

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->footer($data);
        }
    }

	function add($data) {
		global $Authorization,$db;

		if (!ereg('^(' . $this->object . '|Policies)\|(renewPolicy)$', $_GET['do'])) 
			$data['agencies_id'] = $Authorization->data['agencies_id'];

		if (!$data['types_id']) {
			$data['types_id'] = POLICY_TYPES_AGREEMENT;
		}

		if (!$data['policy_statuses_id']) {
			if ($Authorization->data['roles_id'] ==ROLES_AGENT && $Authorization->data['ankets']==0) 
				$data['policy_statuses_id'] = POLICY_STATUSES_CONSULTATION;
			else
				$data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
		}

        if (!isset($data['max_bonus_malus'])) $data['max_bonus_malus'] = 1;
		
		$data['individual_motivation'] = $db->getOne('SELECT individual_motivation FROM insurance_agencies WHERE id='.intval($data['agencies_id']));

		return parent::add($data);
	}

    function change($data, $redirect = true) {
        if (!isset($data['redirect']))
        {
            $data['redirect']='index.php?do=Policies|show&product_types_id='.$data['product_types_id'];
            if ($data['number']) $data['redirect'].='&number='.$data['number'];
            if ($data['insurer']) $data['redirect'].='&insurer='.$data['insurer'];
            if ($data['from']) $data['redirect'].='&from='.$data['from'];
            if ($data['to']) $data['redirect'].='&to='.$data['to'];

            if ($data['insurance_companies_id']) $data['redirect'].='&insurance_companies_id='.$data['insurance_companies_id'];
            if ($data['special']) $data['redirect'].='&special='.$data['special'];
            if ($data['options_test_drive']) $data['redirect'].='&options_test_drive='.$data['options_test_drive'];
            if ($data['options_race']) $data['redirect'].='&options_race='.$data['options_race'];
            if ($data['agencies_id']) $data['redirect'].='&agencies_id='.$data['agencies_id'];
            if ($data['financial_institutions_id']) $data['redirect'].='&financial_institutions_id='.$data['financial_institutions_id'];
        }
        parent::change($data, $redirect );
    }

	function quote($data) {
		$this->checkPermissions('quote', $data);

		$this->permissions['insert'] = true;

		$data['types_id'] = POLICY_TYPES_QUOTE;

		return $this->add($data);
	}

    function checkRisks($data) {
        global $db, $Log;

		if ($data['product_types_id'] != PRODUCT_TYPES_DSKV) {
			return;
		}

        $conditions[] = 'a.product_types_id = ' . intval($data['product_types_id']);
		$conditions[] = 'risks_id IN(' . RISKS_FIRE2 . ', ' . RISKS_HIJACKING2 . ')';

        $sql =  'SELECT a.id, a.title ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql, 30 * 60);

        if (is_array($list)) {
            foreach ($list as $row) {
                if (!in_array($row['id'], $data['risks'])) {
                    $risks[] = '"' . $row['title'] . '"';
                }
            }

            if (is_array($risks)) {
                $Log->add('error', implode(', ', $risks) . ' повинні бути вибрані обов\'язково.');
            }
        }
    }

    function checkFields($data, $action) {
		global $db, $Log;

        parent::checkFields($data, $action);

		if (ereg('^ес[0-9]{4}$', $data['card_car_man_woman'])) {
			$sql =	'SELECT policies_id FROM ' . PREFIX . '_policies_kasko WHERE card_car_man_woman = ' . $db->quote($data['card_car_man_woman']) . ' AND policies_id<> ' . intval($data['id']) . ' ' .
					'UNION ' .
					'SELECT policies_id FROM ' . PREFIX . '_policies_dgo WHERE card_car_man_woman = ' . $db->quote($data['card_car_man_woman']) . ' AND policies_id <> ' . intval($data['id']) . ' ' .
					'UNION ' .
					'SELECT policies_id FROM ' . PREFIX . '_policies_dskv WHERE card_car_man_woman = ' . $db->quote($data['card_car_man_woman']) . ' AND policies_id <> ' . intval($data['id']);
			$id = $db->getCol($sql);

			if (sizeOf($id) > 0) {
				$Log->add('error', 'Карта з номером <b>' . $data['card_car_man_woman'] . '</b> вже використана.');
			}
		}

        $this->checkRisks($data);
    }

    function updateRisks($id, $product_types_id, $risks, $products_id) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policy_risks ' .
                'WHERE policies_id = ' . intval($id);

        $db->query($sql);

        $sql =  'INSERT INTO ' . PREFIX . '_policy_risks (policies_id, risks_id) ' .
                'SELECT ' . intval($id) . ', id  ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'WHERE product_types_id = ' . intval($product_types_id) . ' AND id IN(' . implode(', ', $risks) . ') ';

        $db->query($sql);
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db;

        $data['id'] = parent::insert(&$data, false, $showForm, $checkFieldsAndReturn);

        if ( intval($data['id']) && $data['insurer_identification_code'] && $data['product_types_id']!=11) {
            $sql = 'CALL set_policies_is_bank(' . $db->quote( $data['insurer_identification_code'] ) . ', ' . $data['id'] . ')';
            $db->query($sql);
        }

        return $data['id'];
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db,$Authorization;
        $data['id'] = parent::update(&$data, false, $showForm, $checkFieldsAndReturn);
        if ( intval($data['id']) && $data['insurer_identification_code'] && $data['product_types_id']!=11) {
            $sql = 'CALL set_policies_is_bank(' . $db->quote( $data['insurer_identification_code'] ) . ', ' . $data['id'] . ')';
            $db->query($sql);
        }

        return $data['id'];
    }

    function generateDocuments($id) {
        global $db;

        $conditions[] = 'a.id = ' . intval($id);
        $conditions[] = 'b.sections_id = ' . PRODUCT_DOCUMENT_SECTIONS_SALE;
        $conditions[] = 'b.id NOT IN(' . DOCUMENT_TYPES_POLICY_KASKO_BILL . ', ' . DOCUMENT_TYPES_POLICY_GO_BILL . ',4,5,110,111,173,174,180)';
        $conditions[] = 'c.file <> \'\'';

        $sql =	'SELECT DISTINCT b.id ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_product_document_types as b ON a.product_types_id = b.product_types_id AND b.id<>101 ' .
                'JOIN ' . PREFIX . '_product_documents as c ON b.id = c.product_document_types_id AND a.product_types_id = c.product_types_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $product_document_types = $db->getCol($sql);

        if (is_array($product_document_types)) {

            $PolicyDocuments = new PolicyDocuments($data);

            foreach ($product_document_types as $product_document_types_id) {
                $PolicyDocuments->generate($id, $product_document_types_id);
            }
        }

		$policy_statuses_id = $this->getPolicyStatusesId($id);

		$policy_statuses = array(
			POLICY_STATUSES_GENERATED,
			POLICY_STATUSES_COPY,
			POLICY_STATUSES_CONTINUED,
			POLICY_STATUSES_RENEW);

        if (in_array($policy_statuses_id, $policy_statuses)) {
            PolicyDocuments::generateTemplates($id, null, true);
        }
    }

	function compareValues($data, $quote) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$data[ $key ] = $this->compareValues($value, $quote[ $key ]);
				} else {
					$data[ $key ] = ($data[ $key ] == $quote[ $key ]) ? true : false;
				}
			}
		}

		return $data;
	}

	function isEqual($field) {
		if (!sizeOf($this->values)) {
			return;
		}

		$field = explode('|', $field);

		$value	= $this->values;

		foreach ($field as $key) {
			$value = $value[ $key ];
		}

		return ($value) ? '' : ' notEqual';
	}

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        if ($data['product_types_id'] != PRODUCT_TYPES_GO) {
            $sql =  'SELECT risks_id ' .
                    'FROM ' . PREFIX . '_policy_risks ' .
                    'WHERE policies_id = ' . intval($data['id']);
            $data['risks'] = $db->getCol($sql);
        }

        return $data;
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        $this->checkPermissions('update', $data);

		//сохраняем данные запроса, если таковые есть
		if ($data['quote']) {
			$quote = $data['quote'];
		}

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $allowed_products_id = $data['allowed_products_id'];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        //показывать product_types_id надо для подстановки шаблона согласно типа страхового продукта
        //показывать clients_id для отрисовки шаблона перевозки грузов для Автокапитала
        $sql =	'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[0] . '.parent_id, child_id, ' . $this->tables[0] . '.top, agencies_id,IF(' . PREFIX . '_agencies.parent_id>0,' . PREFIX . '_agencies.parent_id,agencies_id) as top_agencies_id, clients_id, product_types_id, ' . $this->tables[0] . '.number, date_format(date, \'%d\') as date_day, date_format(date, \'%m\') as date_month, date_format(date, \'%Y\') as date_year,individual_motivation ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . $this->tables[1] . ' ON  ' . $this->tables[0] . '.id=' . $this->tables[1] . '.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_agencies ON  ' . PREFIX . '_agencies.id=' . $this->tables[0] . '.agencies_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);

		$data = $db->getRow($sql);

        if ($allowed_products_id) {
            $data['allowed_products_id'] = $allowed_products_id;
        }

        $data = $this->prepareFields($action, $data);

		if ($quote) {
			$this->values = $this->compareValues($data, $quote);
			$data = $quote;
		}

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function view($data, $showForm=true) {
        global $Authorization, $UNDERWRITING_POLICY_STATUSES, $Log, $db;

        $this->checkPermissions('view', $data);

        if ($data['policies_id']) {
            $data['id'] = $data['policies_id'];
        } elseif (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        $this->setTables('view');
        $this->getFormFields('view');

        $identityField = $this->getIdentityField();

		$params['title']	= $this->messages['single'];
		$params['id']		= $data['id'];
		$params['storage']	= $this->tables[0];
		$Log->add('db', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[0] . '.parent_id, child_id, ' . $this->tables[0] . '.top, agencies_id, clients_id, product_types_id,cons_agents_id,individual_motivation ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . $this->tables[1] . ' ON  ' . $this->tables[0] . '.id=' . $this->tables[1] . '.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_agencies ON  ' . PREFIX . '_agencies.id=' . $this->tables[0] . '.agencies_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);

        $row = parent::view($data, null, $sql, null, $showForm);

		if (!$showForm) {
			return $row;
		}
		
		switch ($row['product_types_id']) {
			case PRODUCT_TYPES_CARGO_GENERAL:

				$data['policies_id'] = $row['id'];

				$fields[]       = 'policies_id';
				$conditions[]   = 'policies_id = ' . intval($data['policies_id']);

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['permissions']['PolicyPayments']['show']) {
					$PolicyPayments = new PolicyPayments($data);
					$PolicyPayments->show($data, $fields, $conditions);
				}
				break;					

			case PRODUCT_TYPES_DRIVE_GENERAL:

                if (intval($row['sub_number']) == 0 && strlen($row['sub_number']) < 2) {

                    $data['top'] = $row['id'];

                    $fields       = array('top');
                    $conditions   = array(PREFIX . '_policies.id <> ' . PREFIX . '_policies.top');

                    $Policies = Policies::factory($data, ProductTypes::get($data['product_types_id']));
                    $Policies->setObjectTitle('sub' . $Policies->objectTitle);
                    $Policies->show($data, $fields, $conditions);
                } else {
                    unset($data['top']);
                    $data['product_types_id'] = PRODUCT_TYPES_DRIVE_CERTIFICATE;

                    $fields       = array('policies_general_id');
                    $conditions   = array('policies_general_id = ' . intval($row['id']));

                    $Policies = Policies::factory($data, ProductTypes::get($data['product_types_id']));
                    $Policies->show($data, $fields, $conditions);
                }

				$data['policies_id'] = $row['id'];

				$fields       = array('policies_id');
				$conditions   = array('policies_id = ' . intval($data['policies_id']));

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['permissions']['PolicyPayments']['show']) {
					$PolicyPayments = new PolicyPayments($data);
					$PolicyPayments->show($data, $fields, $conditions);
				}
				break;

			case PRODUCT_TYPES_CARGO_CERTIFICATE:
			case PRODUCT_TYPES_DRIVE_CERTIFICATE:
				$data['policies_id'] = $row['id'];

				$fields[]       = 'policies_id';
				$conditions[]   = 'policies_id=' . intval($data['policies_id']);

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);
				}
				
				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyPayments']['show']) {
						$PolicyPayments = new PolicyPayments($data);
						$PolicyPayments->show($data, $fields, $conditions);
				}

				switch ($row['policy_statuses_id']) {
					case POLICY_STATUSES_GENERATED:
						if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyDocuments']['show'] ) {
							$PolicyDocuments = new PolicyDocuments($data);
							$PolicyDocuments->show($data, $fields, $conditions);
						}
						break;
				}

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['permissions']['PolicyMessages']['show'] ) {
					$PolicyMessages = new PolicyMessages($data);
					$PolicyMessages->show($data, $fields, null);
				}
				break;

			case PRODUCT_TYPES_KASKO:
				$data['policies_id'] = $row['id'];

				$fields[]       = 'policies_id';
				$conditions[]   = 'policies_id=' . intval($data['policies_id']);
				
					
				if (!($row['types_id'] == POLICY_TYPES_QUOTE && $row['policy_statuses_id'] != POLICY_STATUSES_GENERATED&& $row['policy_statuses_id'] != 11) 
					&& $Authorization->data['roles_id'] != ROLES_MASTER 
					&& ($Authorization->data['roles_id'] !=ROLES_MANAGER ||   $Authorization->data['permissions']['PolicyPaymentsCalendar']['show'])) 
				{
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);

					if ($Authorization->data['roles_id'] !=ROLES_MANAGER || $Authorization->data['roles_id'] == ROLES_MANAGER  && $Authorization->data['permissions']['PolicyPayments']['show']) {
						$PolicyPayments = new PolicyPayments($data);
						$PolicyPayments->show($data, $fields, $conditions);
					}
				}

				if ($Authorization->data['permissions']['PolicyDocuments']['show'] || $Authorization->data['roles_id'] != ROLES_MANAGER) {
					$PolicyDocuments = new PolicyDocuments($data);
					$PolicyDocuments->show($data, $fields, $conditions);
				}

				if (  $Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyQuotes']['show']) {
					$PolicyQuotes = new PolicyQuotes($data);
					$PolicyQuotes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] != ROLES_MASTER && 
					($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyMessages']['show'])) {
					$PolicyMessages = new PolicyMessages($data);
					$PolicyMessages->show($data, $fields, null);
				}
				

                if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id'] == ROLES_MANAGER && in_array(ACCOUNT_GROUPS_CONTACT_CENTER, $Authorization->data['account_groups_id']))) {
                    $accidents_info = $db->getAll('SELECT accidents.id as accidents_id, accidents.number ' .
                                                           'FROM ' . PREFIX . '_accidents as accidents ' .
                                                           'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                                                           'JOIN ' . PREFIX . '_accident_messages as messages ON accidents.id = messages.accidents_id ' .
                                                           'WHERE policies.top = ' . intval($row['top']) . ' and messages.message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT);

                    if(sizeof($accidents_info)> 0 ){
                        $data['number'] = '';
                        foreach($accidents_info as $info){
                            $condition_list[] = PREFIX . '_accident_messages.accidents_id = ' . $info['accidents_id'] . ' and ' . PREFIX . '_accidents.number = ' . $db->quote($info['number']);
                        }
                        if(sizeof($condition_list) > 1){
                            $string = '((' . $condition_list[0] . ')';
                            for($i=1; $i<sizeof($condition_list); $i++){
                                $string .= ' OR (' . $condition_list[$i] . ')';
                            }
                            $string .= ')';
                            $condition_messages[] = $string;
                        }else{
                            $condition_messages = $condition_list;
                        }
                        $condition_messages[] = 'message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT . ' OR statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_ANSWER;
                        $AccidentMessages = new AccidentMessages($data);
                        $AccidentMessages->show($data, null, $condition_messages);
                    }
                }

                if (in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) {
                    $Accidents = Accidents::factory($data, ProductTypes::get(PRODUCT_TYPES_KASKO));
                    $Accidents->showAccidentsInfoInPolicy(array('policies_id' => $data['policies_id']));
                }

				break;
			case PRODUCT_TYPES_GO:
				$data['policies_id'] = $row['id'];

				$fields[]       = 'policies_id';
				$conditions[]   = 'policies_id=' . intval($data['policies_id']);

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] !=ROLES_MANAGER ||  $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) 
				{
					$PolicyPayments = new PolicyPayments($data);
					$PolicyPayments->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyDocuments']['show']) {
					$PolicyDocuments = new PolicyDocuments($data);
					$PolicyDocuments->show($data, $fields, $conditions);
				}
				
				if ($Authorization->data['roles_id'] != ROLES_MASTER && 
					($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyMessages']['show'])) {
					$PolicyMessages = new PolicyMessages($data);
					$PolicyMessages->show($data, $fields, null);
				}
				break;
			case PRODUCT_TYPES_PROPERTY:
				$data['policies_id'] = $row['id'];

				$fields[]       = 'policies_id';
				$conditions[]   = 'policies_id=' . intval($data['policies_id']);

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPayments = new PolicyPayments($data);
					$PolicyPayments->show($data, $fields, $conditions);
				}

				$PolicyDocuments = new PolicyDocuments($data);

				if ($Authorization->data['roles_id'] == ROLES_MANAGER) {
					$PolicyDocuments->permissions['update']	= true;
					$PolicyDocuments->permissions['delete']	= true;
				}
	
				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyDocuments']['show']) {
					$PolicyDocuments->show($data, $fields, $conditions);
				}
				break;
			default:
				$data['policies_id'] = $row['id'];

				$fields[]       = 'policies_id';
				$conditions[]   = 'policies_id=' . intval($data['policies_id']);

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyPaymentsCalendar']['show']) {
					$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
					$PolicyPaymentsCalendar->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyPayments']['show']) {
					$PolicyPayments = new PolicyPayments($data);
					$PolicyPayments->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] != ROLES_MANAGER || $Authorization->data['permissions']['PolicyDocuments']['show']) {
					$PolicyDocuments = new PolicyDocuments($data);
					$PolicyDocuments->show($data, $fields, $conditions);
				}
		}
		
		if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies']['showcalculations'])
		{//выплаты по актам
			$akt_payments = $db->getAll('SELECT
								 a.agent_name,sum(commission_amount) as commission_amount
								 FROM 
								 insurance_akts a
								 JOIN insurance_akts_contents b ON b.akts_id=a.id
								 WHERE b.statuses_id=3 AND b.documents=1 AND a.payment_statuses_id=3 AND b.policies_id='.intval($data['policies_id']).' AND a.person_types_id IN(1,2,3,5)
								 GROUP BY  a.agent_name');
			if (is_array($akt_payments) && sizeof($akt_payments)) {
				include $this->object . '/showAktPayments.php';			
			}
			
			if ($row['product_types_id'] == PRODUCT_TYPES_KASKO) {
				$years_payments = $db->getAll('SELECT * FROM 	  insurance_policies_kasko_item_years_payments	 WHERE  policies_id='.intval($data['policies_id']).'  ORDER BY date');
				if (is_array($years_payments) && sizeof($years_payments)) {
					include $this->object . '/showYearsPayments.php';			
				}			
			}
											 
		}

		if ($row['parent_id']) {
			$data['top'] = $row['top'];
			$data['showActions'] = false;
			$this->show($data);
		}
    }

    function updateDocuments($data) {

        $data['step'] = 2;

        $this->updateStep($data['policies_id'], $data['step'] + 1);

        $data['policies'] =& $this;

        $PolicyDocuments = new PolicyDocuments($data);
        $PolicyDocuments->show($data, $fields, $conditions, null, $PolicyDocuments->object . '/show.php');
    }

    function viewDocuments($data) {

        $data['step'] = 2;

        $data['policies'] =& $this;

        $PolicyDocuments = new PolicyDocuments($data);
        $PolicyDocuments->show($data, $fields, $conditions, null, $PolicyDocuments->object . '/show.php');
    }

    //!!! дырка закрыть по пермишинам
    function setCheckedInWindow($data) {
        global $db, $Authorization;

        //получили информацию по полису
        switch ($data['product_types_id']) {
            case PRODUCT_TYPES_GO:
                $sql =  'SELECT documents, commission, TO_DAYS(buh_date) AS buh_date, TO_DAYS(mtsbu_date) AS mtsbu_date ' .
                        'FROM ' . PREFIX . '_policies AS a ' .
                        'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                        'JOIN ' . PREFIX . '_policy_blanks AS c ON b.blank_series = c.series AND b.blank_number = c.number ' .
                        'WHERE a.id = ' . intval($data['id']);
                $policy = $db->getRow($sql);
                break;
            default:
                $sql =  'SELECT documents, commission ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE id = ' . intval($data['id']);
                $policy = $db->getRow($sql);
                break;
        }

        //сохраняем
        $result = array('error', 'При передачі данних виникла помилка.');
        switch ($data['name']) {
            case 'documents':
                if ( intval($data['value']) || (intval($data['value']) == 0 && !intval($policy['commission']) && !intval($policy['buh_date']) && !intval($policy['mtsbu_date'])) ) {

                    $types_id = 1;

                    $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                            'documents = ' . intval($data['value']) . ' ' .
                            'WHERE id = ' . intval($data['id']);

                    $result = array('confirm', 'Наявність оригиналів документів встановлено.');
                } elseif (!intval($data['value'])) {
                    $result = array('error', 'Наявність оригиналів документів не знято. Поліс раніше було додано до переліку полісів за якими повинна бути виплачена комійна винагорода; передано до бухгалтерії або вітзвітовано перед МТСБУ.');
                }
                break;
            case 'commission':
                if ( (intval($data['value']) && intval($policy['documents'])) || intval($data['value']) == 0) {
                    $types_id = 2;

                    $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                            'commission = ' . intval($data['value']) . ' ' .
                            'WHERE id = ' . intval($data['id']);

                    $result = (intval($data['value']) == 0)
                        ? array('confirm', 'Поліс було вилучено з переліку полісів за якими буде виплачена комійна винагорода.')
                        : array('confirm', 'Поліс додано до переліку полісів за якими буде виплачена комійна винагорода.');
                } else {
                    $result = array('error', 'Поліс не було додано до переліку полісів за якими буде виплачена комійна винагорода. Відсутні оригинали документів.');
                }
                break;
        }

        if ($result[ 0 ] == 'confirm') {
            $db->query($sql);

            if ($db->affectedRows()) {
				if ($Authorization->data['roles_id']!= ROLES_AGENT) {
                	$sql =  'INSERT INTO ' . PREFIX . '_policy_actions SET ' .
                        'policies_id = ' . intval($data['id']) . ', ' .
                        'types_id = ' . intval($types_id) . ', ' .
                        'accounts_id = ' . $db->quote( $Authorization->data['id'] ) . ', ' .
                        'accounts_title = ' . $db->quote( $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'] ) . ', ' .
                        'created = NOW()';
	                $db->query($sql);
				}
            }
        }

        echo '{"type": "' . $result[ 0 ] . '", "text": "' . $result[ 1 ] . '"}';
    }

    function exportActionsInWindow($data) {
        global $db;

		$this->checkPermissions('exportActions', $data);

        if (intval($data['product_types_id'])) {
            $conditions[] = 'product_types_id = ' . intval($data['product_types_id']);
        }

        if (intval($data['insurance_companies_id'])) {
            $conditions[] = 'insurance_companies_id = ' . intval($data['insurance_companies_id']);
        }

        if ($data['number']) {
            $conditions[] = 'number = ' . $db->quote($data['number']);
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(a.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(a.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if (intval($data['agencies_id']) && !is_array($data['agencies_id'])) {
            $fields[] = 'agencies_id';

            $Agencies = new Agencies($data);
            $agencies_id = array($data['agencies_id']);
            $Agencies->getSubId(&$agencies_id, $data['agencies_id']);

            $conditions[] = $this->tables[0] . '.agencies_id IN(' . implode(', ', $agencies_id) . ')';
        }

        if (is_array($data['agencies_id']) && sizeof($data['agencies_id'])) {
            $fields[] = 'agencies_id';
            $conditions[] = $this->tables[0] . '.agencies_id IN (' . implode(', ', $data['agencies_id']).')';
        }

        $sql =  'SELECT date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as  date,a.number, a.insurer, a.item, b.title AS policy_statuses_title,a.policy_comment, ' .
                'getPolicyActionsTitle(a.id,1) AS documents_accounts_title, getPolicyActionsDate(a.id,1) AS documents_created, date_format(getPolicyActionsDate(a.id,1), ' . $db->quote(DATE_FORMAT) . ') AS documents_date_format,  ' .
                'getPolicyActionsTitle(a.id,2) AS commission_accounts_title, getPolicyActionsDate(a.id,2) AS commission_created,  date_format(getPolicyActionsDate(a.id,2), ' . $db->quote(DATE_FORMAT) . ') AS commission_date_format ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policy_statuses AS b ON a.policy_statuses_id = b.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' ;
        $list = $db->getAll($sql);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        include_once $this->object . '/exportActions.php';
        exit;
    }

    function finish($data) {
        global $Log;

        $data['step'] = 3;
        unset($_SESSSION['policies_id'][ $data['policies_id'] ]);

        include_once $this->object . '/finish.php';
    }

    function loadStatus($data, $subject=null, $text=null) {
        global $db, $Log;

        $this->checkPermissions('changeStatus', $data);

        if (is_array($data['id'])) {
            $sql =  'SELECT DISTINCT policy_statuses_id ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $statuses = $db->getAll($sql);

            switch (sizeOf($statuses)) {
                case 0:

                    $Log->add('error', 'Не вибрали жодного сертифікату.');

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                    break;
                case 1:
                    break;
                default:
                    $Log->add('error', 'Змінювати стутус серфтифікатів одночасно можливо лише у тому випадку, якщо їх поточний статус однаковий.');

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
            }

            $mode       = 'simple';
        } else {
            $data['id'] = array($data['policies_id']);
            $mode       = $data['mode'];
        }

        $sql =	'SELECT product_types_id, policy_statuses_id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE id = ' . intval($data['id'][ 0 ]);
        $row =  $db->getRow($sql);

        $data = array_merge($data, $row);

        $data['subject']    = $subject;
        $data['text']       = $text;
        $data['mode']       = $mode;

        $this->showForm($data, 'updateStatus', 'changeStatus', 'changeStatus.php');
    }

    function getMessageSubjectByStatusesId($policy_statuses_id) {

        switch ($policy_statuses_id) {
            case POLICY_STATUSES_CREATED:
                $subject = 'Новий поліс був створений';
                break;
			case POLICY_STATUSES_CONSULTATION:
                $subject = 'Нова консультацiя була створена';
                break;	
            case POLICY_STATUSES_SENT:
                $subject = 'Новий поліс направлен на розгляд менеджеру';
                break;
            case POLICY_STATUSES_ERROR:
                $subject = 'Поліс був повернутий на доопрацювання клієнту';
                break;
            case POLICY_STATUSES_RESENT:
                $subject = 'Поліс був повторно направлений на розгляд менеджеру';
                break;
			case POLICY_STATUSES_REQUEST_QUOTE:
                $subject = 'Запит котирування був відправлений андерайтеру';
				break;
			case POLICY_STATUSES_REQUEST_QUOTE_ERROR:
                $subject = 'Помилки в запиті до андерайдера';
				break;
			case POLICY_STATUSES_REQUEST_QUOTE_AGAIN:
				$subject = 'Повторний запит котирування до андерайтера';
				break;
			case POLICY_STATUSES_QUOTE:
				$subject = 'Котирування від андерайдера були відправлені';
				break;
			case POLICY_STATUSES_REQUEST_AGREEMENT:
				$subject = 'Запит полісу страхування було сформовано';
				break;
            case POLICY_STATUSES_GENERATED:
                $subject = 'Поліс був згенерован';
                break;
            case POLICY_STATUSES_DISSOLVED:
                $subject = 'Поліс був припинений';
                break;
			case POLICY_STATUSES_CANCELLED:
                $subject = 'Поліс був анульований';
                break;
			case POLICY_STATUSES_SPOILT:
                $subject = 'Поліс був зіпсований';
                break;

        }

        return $subject;
    }

    function canBeCancelled($id, $number) {
        global $db;

        $conditions[] = 'id = ' . intval($id);
        $conditions[] = 'policy_statuses_id = ' . POLICY_STATUSES_GENERATED;
        $conditions[] = 'begin_datetime > NOW()';

        $sql =  'SELECT number ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE ' . implode(' AND ', $conditions);
        $number = $db->getOne($sql);

        return ($number) ? true : false;
    }

    function updateStatus($data) {
        global $db, $Log;

        $data['id'] = unserialize(htmlspecialchars_decode($data['id']));

        $this->checkPermissions('changeStatus', $data);

        if (!intval($data['policy_statuses_id'])) {
            $params = array(translate($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ]['description']), '');
            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
        } else {
            switch ($data['policy_statuses_id']) {
                case POLICY_STATUSES_CANCELLED:
                    foreach ($data['id'] as $id) {
                        $number = '';
                        if (!$this->canBeCancelled($id, &$number)) {
                            $Log->add('error', 'Сертифікат <b>' . $number .'</b> не можливо анулювати.', $params);
                        }
                    }
                    break;
            }
        }

        if ($Log->isPresent()) {
            $this->loadStatus($data, $data['subject'], $data['text']);
        } else {

            $fields[] = 'policy_statuses_id = ' . intval($data['policy_statuses_id']);
            $fields[] = 'modified = NOW()';

            $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                    implode(', ', $fields) . ' ' .
                    'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $db->query($sql);

            switch ($data['policy_statuses_id']) {
                case POLICY_STATUSES_GENERATED:
                    switch ($data['product_types_id']) {
                        case PRODUCT_TYPES_CARGO_CERTIFICATE:
                            $sql =  'UPDATE ' . PREFIX . '_policies_cargo SET ' .
                                    'certificate = 1 ' .
                                    'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
                            $db->query($sql);
                            break;
                        case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                            $sql =  'UPDATE ' . PREFIX . '_policies_drive SET ' .
                                    'certificate = 1 ' .
                                    'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
                            $db->query($sql);
                            break;
                    }

                    foreach ($data['id'] as $id) {
                        $this->generateDocuments($id);
                    }

                    break;
            }

            foreach ($data['id'] as $id) {
                $data['policies_id'] = $id;

                $PolicyMessages = new PolicyMessages($data);
                $PolicyMessages->insert($data, false);
            }

            $Log->add('confirm', 'Статус полісу(iв) був успішно змінений.', null, null, true);

            switch ($data['mode']) {
                case 'simple':
                    header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
                    break;
                default:
                    header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|finish&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                    break;
            }

            exit;
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log, $Authorization;

        $sql =	'SELECT id ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>Отриманні платежі</b>.');
            return false;
        }

        $PolicyMessages     = new PolicyMessages($data);
        $PolicyDocuments    = new PolicyDocuments($data);

        switch ($data['product_types_id']) {//устанавливаем полномочия для удаления сертификатов для клиентов
			case PRODUCT_TYPES_PROPERTY:
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                switch ($Authorization->data['roles_id']) {
                    case ROLES_MANAGER:
                        $PolicyMessages->permissions['delete']  = true;
                        $PolicyDocuments->permissions['delete'] = true;
                        break;
                }
                break;
        }

        $sql =	'SELECT id ' .
                'FROM ' . $PolicyMessages->tables[0] . ' ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        $PolicyMessages->delete($toDelete, false, false);

        $sql =	'SELECT id ' .
                'FROM ' . $PolicyDocuments->tables[0] . ' ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        $PolicyDocuments->delete($toDelete, false, false);

		//чистим календарь платежей
		$sql =	'DELETE ' .
                'FROM ' . PREFIX . '_policy_payments_calendar ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

        //чистим таблицу смены статусов
        $sql =	'DELETE ' .
                'FROM ' . PREFIX . '_policy_status_changes ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        //чистим таблицу полученных платежей
        $sql =	'DELETE ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        //чистим таблицу рисков
        $sql =	'DELETE ' .
                'FROM ' . PREFIX . '_policy_risks ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

		//чистим таблицу рисков
		$sql =	'DELETE ' .
                'FROM ' . PREFIX . '_policy_quotes ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

		//чистим ссылки по child_id
		$sql =	'UPDATE ' . PREFIX . '_policies ' .
				'SET child_id = 0, ' .
                'interrupt_datetime = end_datetime ' .
                'WHERE child_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }

    function delete($data, $redirect=true, $generateMessage=true, $folder=null) {
        global $db, $Log, $Authorization;

        $_SERVER['HTTP_REFERER'] = '?do=Policies|show&product_types_id=' . $data['product_types_id'];

        switch ($data['product_types_id']) {
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                if ($Authorization->data['roles_id'] == ROLES_CLIENT_CONTACT) {

                    $conditions[] = 'product_types_id = ' . intval($data['product_types_id']);
                    $conditions[] = 'policy_statuses_id <> ' . POLICY_STATUSES_CREATED;
                    $conditions[] = 'id IN(' . implode(', ', $data['id']) . ')';

                    $sql =  'SELECT count(*) ' .
                            'FROM ' . PREFIX . '_policies ' .
                            'WHERE ' . implode(' AND ', $conditions);
                    $count = $db->getOne($sql);

                    if ($count > 0) {

                        $Log->add('error', 'Сертифікати можливо вилучати лише в статусі <b>Створено</b>.');

                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                }
                break;
        }

        parent::delete($data, $redirect, $generateMessage, $folder);
    }

    function exportInWindow($data) {

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'excel.php', false);
        exit;
    }

	function getNumberById($id) {
		global $db;

		$sql =	'SELECT number ' .
				'FROM ' . PREFIX . '_policies ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}

    function getIdByNumber($number, $product_types_id=null) {
        global $db;

        $conditions[] = 'number = ' . $db->quote($number);

        if ($product_types_id) {
            $conditions[] = 'product_types_id = ' . $product_types_id;
        }

        $sql =	'SELECT id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getCol($sql);

        return (sizeOf($list) == 1) ? $list[0] : 0;
    }

    function getProductTypesId($id) {
        global $db;

        $sql =	'SELECT product_types_id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }

    function get($id) {
        $product_types_id = $this->getProductTypesId($id);

        $Policies	= Policies::factory($data, ProductTypes::get($product_types_id));
        return $Policies->get($id);
    }

    function setPaymentStatus($id) {
        global $db;

        PolicyPaymentsCalendar::setPaymentStatuses($id);

        $payment_statuses_id = Policies::getpayment_statuses_id($id);

        if (intval($payment_statuses_id) == 0) {
            $payment_statuses_id = 1;
        }

		$sql = 'SELECT policy_statuses_id FROM ' . PREFIX . '_policies WHERE id=' . intval($id);
		$policy_statuses_id = $db->getOne($sql);
		
		$sql = 'SELECT parent_id,product_types_id FROM ' . PREFIX . '_policies WHERE id=' . intval($id);
		$r = $db->getRow($sql);
		if ($r['parent_id']>0 && $r['product_types_id'] == PRODUCT_TYPES_KASKO && $payment_statuses_id>PAYMENT_STATUSES_NOT && $policy_statuses_id==POLICY_STATUSES_CREATED ) {
			$sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
					' JOIN ' . PREFIX . '_policies AS h ON h.id = a.parent_id SET ' .
				    'h.interrupt_datetime = IF(h.interrupt_datetime >= a.begin_datetime, SUBDATE(a.begin_datetime, INTERVAL 1 DAY), h.interrupt_datetime) '.
                    'WHERE a.id = ' . intval($id);
			$db->query($sql);					
		}

        $sql =	'UPDATE ' . PREFIX . '_policies SET ' .
                'payment_statuses_id = ' . intval($payment_statuses_id) . ' ' .
				($payment_statuses_id>PAYMENT_STATUSES_NOT && $policy_statuses_id==POLICY_STATUSES_CREATED ? ',policy_statuses_id='.POLICY_STATUSES_GENERATED.' ':' ').
                'WHERE id=' . intval($id);
        $db->query($sql);

		//если какие-то деньги оплачены и был статус меньше чем сформован, то перевели в сформован и сгенерить документы
        if ($payment_statuses_id>PAYMENT_STATUSES_NOT && $policy_statuses_id<POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($id);
        }
    }

	function isPayedBypayment_statuses_id($payment_statuses_id) {
		switch ($payment_statuses_id) {
			case PAYMENT_STATUSES_NOT:
				return false;
				break;
			default:
				return true;
				break;
		}
	}

	function isClosedByPolicyStatusesId($policy_statuses_id) {
		switch ($policy_statuses_id) {
			case POLICY_STATUSES_CONSULTATION:
			case POLICY_STATUSES_CREATED:
			case POLICY_STATUSES_SENT:
			case POLICY_STATUSES_ERROR:
			case POLICY_STATUSES_RESENT:
			case POLICY_STATUSES_REQUEST_QUOTE:
			case POLICY_STATUSES_REQUEST_QUOTE_ERROR:
			case POLICY_STATUSES_REQUEST_QUOTE_AGAIN:
			case POLICY_STATUSES_QUOTE:
			case POLICY_STATUSES_REQUEST_AGREEMENT:
				return false;
				break;
			default:
				return true;
				break;
		}
	}

    function updateModified($id) {
        global $db;

        $sql =	'UPDATE ' . PREFIX . '_policies ' .
                'SET modified = NOW() ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);
    }

	function isPayed($id) {
		global $db;

		$sql =	'SELECT count(*) ' .
				'FROM ' . PREFIX . '_policy_payments ' .
				'WHERE policies_id = ' . intval($id);

		return ($db->getOne($sql) > 0) ? true : false;
	}

	function resetPolicyStatus($data) {
        global $db, $Log;
		if (is_array($data['id']))
			$data['id'] = $data['id'][0];
		
		if (!$this->isPayed($data['id'])) {
			if ($this->getPolicyStatusesId($data['id']) == POLICY_STATUSES_CREATED) {
				$Log->add('error', 'Поліс вже знаходиться в статусі "Створено".');
			} else {
				//переводим в створено
				$sql = 'SELECT * FROM ' . PREFIX . '_policy_documents WHERE policies_id=' . intval($data['id']) . ' AND  LENGTH(template)>0 AND file=\'1\'';
				$list = $db->getAll($sql);

				foreach ($list as $i => $row) {
					@unlink($_SERVER['DOCUMENT_ROOT'] .'/files/PolicyDocumentsTemplates/' . $row['template']);
					$db->query('UPDATE ' . PREFIX . '_policy_documents SET template=NULL WHERE id=' . intval($row['id']));
				}

				$db->query('UPDATE ' . PREFIX . '_policies  SET policy_statuses_id=' . POLICY_STATUSES_CREATED . ' WHERE id=' . intval($data['id']));
				
				$sql = 'SELECT parent_id,product_types_id FROM ' . PREFIX . '_policies WHERE id=' . intval($data['id']);
				$r = $db->getRow($sql);
				if ($r['parent_id']>0 && $r['product_types_id'] == PRODUCT_TYPES_KASKO ) {
					$sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
							' JOIN ' . PREFIX . '_policies AS h ON h.id = a.parent_id SET ' .
							'h.interrupt_datetime = h.end_datetime '.
							'WHERE a.id = ' . intval($data['id']);
					$db->query($sql);					
				}

				$data['policies_id'] = $data['id'];
				$data['subject'] = 'Поліс переведено в статус "Створено"';
				
				$sql =	'SELECT product_types_id, policy_statuses_id, agents_id, agencies_id, managers_id, clients_id ' .
						'FROM ' . PREFIX . '_policies ' .
						'WHERE id = ' . intval($data['policies_id']);
				$row =	$db->getRow($sql);
				
				$data['recipients']['agencies'][] = $row['agencies_id'];
				$data['manual'] = 0;
				
				$PolicyMessages = new PolicyMessages($data);
				$PolicyMessages->insert($data, false);
					
				$Log->add('confirm', 'Поліс переведено в статус <b>"Створено"</b>');
			}
		} else {
			$Log->add('error', translate('Поліс не можливо перевести в статус "Створено", клієнтом вже здійснена оплата.'));
		}

        $redirect = ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
        header('Location: ' . $redirect);
        exit;
	}

	function canChangeServicePerson($id) {
		global $db, $Log, $Authorization;

		$result = true;

		if (!$this->checkPermissions('changeServicePerson', array('id' => $id), false)) {
			$Log->add('error', 'У Вас не достатньо повноважень для зміни представника СТО.');
			$result = false;
		} else {

			$conditions[]=1;
			$sql =	'SELECT count(*) ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' .
					'WHERE policies_id = ' . intval($id) . ' AND (' . implode(' OR ', $conditions) . ')';
			$count = $db->getOne($sql);

			/*if ($count != 0) {
				$Log->add('error', 'Зміна представника СТО не можлива, поліс вже включено в акт(и).');
				$result = false;
			}*/
		}

		return $result;
	}

	//end_datetime это время окончания действия старых условий, начиная с этой даты действуют новые условия страхования
	function calculateamount_parent($id, $end_datetime) {//!!! ЭТОТ метод надо переделать на более безопасный, тут реальная дырка получения страховой премии по любому договору по прямому запросу
		global $db;

		$sql =	'SELECT SUM(b.amount) AS amount, ROUND((a.amount + a.amount_parent) * ((TO_DAYS(' . $db->quote($end_datetime) . ') - TO_DAYS(a.begin_datetime)) / (TO_DAYS(a.end_datetime) - TO_DAYS(a.begin_datetime) + 1)), 2) AS used ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policy_payments AS b ON a.id = b.policies_id ' .
				'WHERE a.id = ' . intval($id) . ' ' .
				'GROUP BY b.policies_id';
		$row = $db->getRow($sql);

		return ($row['used'] < 0) ? 0 : (($row['amount'] - $row['used'])<0 ? 0 : $row['amount'] - $row['used']) ;
	}

	function setCommentInWindow($data) {
		global $db, $Log,$Authorization;

		if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) {

			if (!$Log->isPresent()) {
				$sql =	'UPDATE ' . PREFIX . '_policies SET ' .
						'policy_comment = ' . $db->quote(htmlspecialchars($this->replaceTags(trim($data['policy_comment'])))) . ', ' .
						'comment_user = '.$db->quote($Authorization->data['lastname'].' '.$Authorization->data['firstname']).' '.
						'WHERE id=' . intval($data['id']);
				$db->query($sql);

				$Log->add('confirm', 'Коментар було встановлено.');
			}

			$result = $Log->get();

			echo '{"type":"' . $result[ 0 ]['type'] . '","text":"' . $result[ 0 ]['text'] . '"}';
		}
		exit;
	}

	//!!!использую только в заявлении при событии
	function getRisksInWindow($data) {
		global $db;

		$conditions[] = 'policies_id = ' . intval($data['id']);

		$sql =	'SELECT a.risks_id, b.title ' .
				'FROM ' . PREFIX . '_policy_risks AS a ' .
				'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
				'WHERE ' . implode(' AND ', $conditions);
		$list = $db->getAll($sql);

		$this->mode = Accidents::getMode($data['accidents_id']);

		include_once $this->object . '/risksInWindow.php';
		exit;
	}

	function loadPolicy($data) {
		global $db, $Authorization;


		$Policies = Policies::factory($data, ProductTypes::get($data['product_types_id']));

		$values = $data;
		$values['checkPermissions'] = 1;
		$data['checkPermissions'] = 1;
		$values['id'] = $data['parent_id'];

		unset( $Policies->formDescription['fields'][ $Policies->getFieldPositionByName('begin_datetime', $Policies->formDescription) ] );
		unset( $Policies->formDescription['fields'][ $Policies->getFieldPositionByName('end_datetime', $Policies->formDescription) ] );
		unset( $Policies->formDescription['fields'][ $Policies->getFieldPositionByName('date', $Policies->formDescription) ] );
		unset( $Policies->formDescription['fields'][ $Policies->getFieldPositionByName('owner_phone', $Policies->formDescription) ] );
		unset( $Policies->formDescription['fields'][ $Policies->getFieldPositionByName('insurer_phone', $Policies->formDescription) ] );

		$data = $Policies->load($values, false, $data['action'], $data['action']);
		$data['do']=$values['do'];
		$data['types_id'] = POLICY_TYPES_AGREEMENT;
		if ($_SESSION['auth']['agent_financial_institutions_id']==39 && $data['product_types_id'])//универсал майно ипотека через котирование
		{
			$data['types_id'] = 2;
			$this->subMode = 'set';
			$this->setPolicyStatusesSchema(null, &$data);
		}

		unset($data['id']);

		unset($data['date_day']);
		unset($data['date_month']);
		unset($data['date_year']);
		unset($data['payments']);
		unset($data['solutions_id']);
		unset($data['certificate']);
		unset($data['agreement_types_id']);
		unset($data['blank_series']);
		unset($data['blank_number']);
		unset($data['stiker_series']);
		unset($data['stiker_number']);
		unset($data['payment_datetime_day']);
		unset($data['payment_datetime_month']);
		unset($data['payment_datetime_year']);
		unset($data['payment_datetime_hour']);
		unset($data['payment_datetime_minute']);
		unset($data['payment_number']);
		unset($data['next_policy_statuses_id']);
		unset($data['manager_id']);
		unset($data['blank_series_parent']);
		unset($data['blank_number_parent']);
		unset($data['limit_property']);
		unset($data['limit_life']);
		unset($data["items"]["0"]["commission_agency_discount_percent"]);
		unset($data["items"]["0"]["commission_agent_discount_percent"]);
		unset($data["items"]["0"]["director1_commission_discount_percent"]);
		unset($data["items"]["0"]["director2_commission_discount_percent"]);
		unset($data["items"]["0"]["commission_manager_discount_percent"]);
		unset($data["items"]["0"]["commission_seller_agents_discount_percent"]);
		$data["discount"] = 0.00;
		

		if ($data['product_types_id']==PRODUCT_TYPES_NS && $data['products_id']>0) {
			$products[] = $data['products_id'];
			if (is_array($products) && sizeOf($products)) {
				$sql =	'SELECT related_products_id ' .
						'FROM ' . PREFIX . '_products_related ' .
						'WHERE products_id IN (' . implode(', ', $products) . ')';
				$allowed_products_id = $db->getCol($sql);
			}

			if (is_array($allowed_products_id) && sizeOf($allowed_products_id)) {
				$data['allowed_products_id'] = implode(',', $allowed_products_id);
			} else {
				$sql =	'SELECT id ' .
						'FROM ' . PREFIX . '_products ' .
						'WHERE product_types_id = ' . intval($data['product_types_id']) . ' AND publish=1 AND id NOT IN (SELECT related_products_id FROM '.PREFIX.'_products_related )';
				$allowed_products_id = $db->getCol($sql);

				if (is_array($allowed_products_id) && sizeOf($allowed_products_id)) {
					$data['allowed_products_id'] = implode(', ', $allowed_products_id);
				}
			}

		}

		unset($data['products_id']);
		unset($data['sign_agents_id']);
		
		unset($data['seller_agencies_id']);
		unset($data['seller_agents_id']);

		$data['agencies_id'] = $Authorization->data['agencies_id'];
		$data['parent_id'] = $values['id'];
		$data['states_id'] =  POLICY_STATUSES_CONTINUED;
		$data['load_number'] = $data['number'];
		$data['number'] = '';
		$data['expert_period'] = 0;

        if(intval($data['parent_id']) > 0 && intval($values['prolongation']) == 1) {
            $data['cons_agents_id'] = 0;
        }

		$data['policy_statuses_id'] = POLICY_STATUSES_CREATED;

		/*if ($data['clients_id']) {

			$Clients = new Clients($data);
			$client = $Clients->getClient($data);

			if (is_array($client)) {
				$data = array_merge($data, $client);
			}
		}*/

		if (is_array($data['items']) && $data['product_types_id']==PRODUCT_TYPES_KASKO) {

			foreach($data['items'] as $i => $item) {

				unset($data['items'][$i]['rate']);
				unset($data['items'][$i]['amount']);
				$data['items'][$i]['market_price'] = $data['items'][$i]['market_price_expert'] ;

				if (intval($item['products_id'])) {
					$products[] = $item['products_id'];
				}
			}
			if (is_array($products) && sizeOf($products)) {
				$sql =	'SELECT related_products_id ' .
						'FROM ' . PREFIX . '_products_related ' .
						'WHERE products_id IN (' . implode(', ', $products) . ')';
				$allowed_products_id = $db->getCol($sql);
			}

			if (is_array($allowed_products_id) && sizeOf($allowed_products_id)) {
				$data['allowed_products_id'] = implode(',', $allowed_products_id);
			} else {
				$sql =	'SELECT id ' .
						'FROM ' . PREFIX . '_products ' .
						'WHERE product_types_id = ' . intval($data['product_types_id']) . ' AND publish=1 AND id NOT IN (SELECT related_products_id FROM '.PREFIX.'_products_related )';
				$allowed_products_id = $db->getCol($sql);

				if (is_array($allowed_products_id) && sizeOf($allowed_products_id)) {
					$data['allowed_products_id'] = implode(', ', $allowed_products_id);
				}
			}
			
			$data['bonus_malus'] = 0;
			$data['max_bonus_malus'] = 1;
			
			if (sizeof($data['items']) == 1) {

				$d['shassi'] = $data['items'][0]['shassi'];
				$d['insurer_identification_code'] = $data['insurer_identification_code'];
				$d['insurer_edrpou'] = $data['insurer_edrpou'];
				$d['options_agregate_no'] = $data['items'][0]['options_agregate_no'];
				$client = $db->getRow('SELECT * FROM insurance_clients WHERE identification_code =' .(strlen($d['insurer_edrpou'])>=6 ? $db->quote($d['insurer_edrpou']) :  $db->quote($d['insurer_identification_code']) ) );
				$m = 0 ;
				if ($client && $client['important_person']) {
				//проверить на убыточность
					$Products = Products::factory($data, 'KASKO');
					$m = $Products->calculateMalus($d,true);
				}
				if ($m==0) $data['max_bonus_malus'] = $Policies->calculateBonusMalus($d);
				 
			}
		}
		$data['card_assistance']='';
		$this->showForm($data, 'insert');
	}

	//формирование номеров актов по комисиионому вознаграждению КАСКО+ГО агентов все в один акт
	function fillAktNumbersAgents($data) {
		global $db;

		$InsurancePeriods = new InsurancePeriods($data);
		$InsurancePeriods->checkPermissions('akts', $data);
		if (!$data['insurance_companies_id']) $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;

		$aktnumbers=array();
		$buildtime = time();
		$date = getdate($buildtime);
		$date['mon']--;

		if ($date['mon'] == 0) {
			$date['mon'] = 12;
			$date['year']--;
		}
		//КАСКО + ДГО
		//agents
		$conditions[] = 'a.documents  = 1';
		$conditions[] = 'a.product_types_id  IN (3,7) ';
		$conditions[] = 'k.statuses_id IN (' . PAYMENT_STATUSES_PAYED . ', ' . PAYMENT_STATUSES_OVER . ')';
		$conditions[] = 'k.commission_agent_amount > 0';
		$conditions[] = '(k.payment_date_agent IS NULL or k.payment_date_agent=0)';
		$conditions[] = 'a.created<'.$db->quote(date("Y-m-01"));
		
		$conditions[] = 'a.insurance_companies_id='.intval($data['insurance_companies_id']);
		

		if ($data['agencies_id']) {
			$conditions[] = 'a.agencies_id = ' . intval($data['agencies_id']);
		}

		if ($data['agents_id']) {
			$conditions[] = 'a.agents_id = ' . intval($data['agents_id']);
		}

		$sql =	'SELECT a.*, f.agreement_number'.($data['insurance_companies_id']==INSURANCE_COMPANIES_GENERALI ? '_generali':'').' as agreement_number, k.commission_agent_amount ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policy_payments_calendar AS k ON a.id = k.policies_id ' .

				'JOIN ' . PREFIX . '_agents AS f ON a.agents_id = f.accounts_id ' .
				'WHERE ' . implode(' AND ', $conditions) . '  ' .
				' ';
		$list = $db->getAll($sql);
		

		$limits = array();
		foreach($list as $row) {
			$limits[$row['agreement_number']] += $row['commission_agent_amount'];
		}

		foreach($list as $row) {//проставляем номера, если сумма более 100 грн. и есть номер акта у агента
			if ($limits[$row['agreement_number']]>=100 && strlen($row['agreement_number'])>0 ) {

				$aktnumber = $row['agreement_number'] . '.'  . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);

				$sql =	'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
						'agents_akt_number = ' . $db->quote($aktnumber) . ' ' .
						'WHERE statuses_id IN(' . PAYMENT_STATUSES_PAYED . ', ' . PAYMENT_STATUSES_OVER . ') AND (payment_date_agent IS NULL or payment_date_agent=0) AND policies_id=' . intval($row['id']);
				$db->query($sql);
				$aktnumbers[$aktnumber]=1;

				//формирование платежки для оплаты в бухгалтерию
				//PaymentsCalendar::createPayment($aktnumber, PRODUCT_TYPES_KASKO, $row['agents_id'], 1);
			}
		}
		if ($data['insurance_companies_id']!=INSURANCE_COMPANIES_EXPRESS) return;
		//ГО
		$conditions=array();
		$buildtime = time();
		$date=getdate($buildtime);
		$date['mon']--;

		if ($date['mon']==0) {
			$date['mon'] = 12;
			$date['year']--;
		}

		//START agents' akts
		$sql =	'UPDATE ' . PREFIX . '_policy_payments_calendar AS a ' .
				'JOIN ' . PREFIX . '_policies_go AS b ON a.policies_id = b.policies_id '.
				'SET ' .
				'agents_akt_number = \'\' ' .
				'WHERE (payment_date_agent IS NULL OR payment_date_agent = 0)';

		$conditions[] = 'a.documents  = 1';
		$conditions[] = 'k.statuses_id IN (' . PAYMENT_STATUSES_PAYED . ', ' . PAYMENT_STATUSES_OVER . ')';
		$conditions[] = 'k.commission_agent_amount > 0';
		$conditions[] = '(k.payment_date_agent IS NULL OR k.payment_date_agent=0)';
		$conditions[] = 'l.insurance_companies_id  IN (1,2, 3)';

		if ($data['agencies_id']) {
			$conditions[] ='a.agencies_id = ' . intval($data['agencies_id']);
		}
		if ($data['agents_id']) {
			$conditions[] ='a.agents_id = ' . intval($data['agents_id']);
		}

		$sql =	'SELECT a.*, f.agreement_number, k.commission_agent_amount ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_policy_payments_calendar AS k ON a.id = k.policies_id ' .
				'LEFT JOIN (' .
					'SELECT policies_id, MAX(datetime) AS bankDatetime ' .
					'FROM ' . PREFIX . '_policy_payments ' .
					'WHERE datetime <'.$db->quote(date('Y-m-01',$buildtime)).' ' .
					'GROUP BY policies_id ' .
				') as c ON a.id = c.policies_id ' .
				'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
				'JOIN ' . PREFIX . '_agents AS f ON a.agents_id = f.accounts_id ' .
				'JOIN ' . PREFIX . '_policy_blanks  AS l ON l.series=b.blank_series and l.number  = b.blank_number ' .
				'WHERE ' . implode(' AND ', $conditions) . '  ' .
				'ORDER BY c.bankDatetime';
		$list = $db->getAll($sql);

		$limits = array();//рассчитываем сумму акта
		foreach($list as $row) {
			$limits[$row['agreement_number']] += $row['commission_agent_amount'];
		}

		foreach($list as $row) {//проставляем номера, если сумма более 100 грн.  и есть номер акта у агента
			if ($limits[ $row['agreement_number'] ] >= 100 && strlen($row['agreement_number'])>0) {

				$aktnumber = $row['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);

				$sql =	'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
						'agents_akt_number=' . $db->quote($aktnumber) . '	' .
						'WHERE policies_id = ' . intval($row['id']);
				$db->query($sql);
				$aktnumbers[$aktnumber]=1;
				//формирование платежки для оплаты в бухгалтерию
				//PaymentsCalendar::createPayment($aktnumber,$row['product_types_id'],$row['agents_id'],1);
			}
		}
		
		//формирование платежек для оплаты в бухгалтерию
		if (is_array($aktnumbers) && $data['insurance_companies_id']==INSURANCE_COMPANIES_EXPRESS) {
			foreach($aktnumbers	as $aktnumber=>$val) {
				PaymentsCalendar::createPayment($aktnumber,1,0,1);
			}
				
		}
		//exit;
	}

	//смена менеджера / салона
	function loadTransfer($data) {
        global $db;

		$data['id'] = $data['id'][0];
		$this->updateTransfer($data);

		return;
    }

	function loadAgentsInWindow($data) {
		global $db;

		if (!$data['agent_field'])  $data['agent_field'] = 'agents_id';
		
		$sql = 'SELECT a.id,CONCAT(lastname,\' \' , firstname) as name FROM '.PREFIX.'_accounts a JOIN '.PREFIX.'_agents b ON b.accounts_id=a.id WHERE a.active=1 '.($data['isseller'] ? ' AND seller=1 ' : '').' AND b.agencies_id='.intval($data['agencies_id']).' ORDER BY lastname,firstname';
		
		$list = $db->getAll($sql);

		$result = '<select id="'.$data['agent_field'].'" name="'.$data['agent_field'].'"   class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
		$result.='<option '.(0==$data['old_agents_id'] ? 'selected':'').' value="0">...</option>';
		foreach($list as $row) {
			$result.='<option '.($row['id']==$data['old_agents_id'] ? 'selected':'').' value="'.$row['id'].'">'.$row['name'].'</option>';
		}
		$result.='</select>';

		echo $result;
		exit;		
	}
	
	 
	
    function updateTransfer($data) {
        global $db, $Log,$Templates;

		$this->checkPermissions('transfer', $data);
		if ($_POST['do'] != 'Policies|updateTransfer')
			unset($data['agencies_id']);
		
		$conditions[] = 'id = ' . intval($data['id']);

		$sql =	'SELECT a.*,a.agents_id as old_agents_id ' .
                'FROM ' . $this->tables[0] . ' as a ' .
                'WHERE ' . implode(' AND ', $conditions);
				
		$data = array_merge ( $db->getRow($sql),$data);

		foreach ($this->formDescription['fields'] as $i => $field) {
            switch ($field['name']) {
                case 'id':
				case 'agents_id':
                    break;
                case 'agencies_id':
                    $this->formDescription['fields'][ $i ]['type'] = fldSelect;
                    $this->formDescription['fields'][ $i ]['showId'] = 1;
					$this->formDescription['fields'][ $i ]['structure'] = 'tree';
					$this->formDescription['fields'][ $i ]['selectField'] ='CONCAT(code, \' - \', title)';
					$field = $this->formDescription['fields'][ $i ];
                    $this->formDescription['fields'][ $i ]['list'] = $this->getListValue($field);
                    $this->formDescription['fields'][ $i ]['display']['update'] = true;
                    break;
                default:
                    unset($this->formDescription['fields'][ $i ]);
                    break;
            }
        }

		if ($_POST['do'] == 'Policies|updateTransfer') {
			
			
			$data = $this->replaceSpecialChars($data, 'update');
			
			//$this->checkFields($data, 'update');
			
			if (!$Log->isPresent()) {
				$sql =	'UPDATE ' . $this->tables[0] . ' SET ' .
						'agencies_id = ' . intval($data['agencies_id']) . ', ' .
						'agents_id = ' . intval($data['agents_id']) . ' '  .
						'WHERE id = ' . intval($data['id']);
				$db->query($sql);

				
				$Log->add('confirm', 'Менеджера було змiнено');

				header('Location: ' . $data['redirect']);
				exit;
			}
		}	

		unset($this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]);
		$Log->showSystem();
		include_once $this->object . '/transfer.php';
    }

    //проверка на то что полис уже в агенских актах
    function isInAct($id) {
        global $db;
        return doubleval($db->getOne('SELECT count(id) FROM insurance_akts_contents WHERE policies_id='.intval($id)))>0 ? 1 :0;
    }

	function getamount_parentInWindow($data) {
		echo $this->calculateamount_parent($data['id'], $data['end_datetime']);
		exit;
	}

	function fillAktNumbersAgentsInWindow($data) {
		$this->fillAktNumbersAgents($data);
		echo 'Ok';
		exit;
	}

	function fillAktNumbersAgenciesInWindow($data) {
		$this->fillAktNumbersAgencies($data);
		echo 'Ok';
		exit;
	}

	function fillAktNumbersDirektorsInWindow($data) {
		$this->fillAktNumbersDirektors($data);
		echo 'Ok';
		exit;
	}

	function convertDate($date) {
		if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $date, $regs)) {
			$date = date('d.m.Y', mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]) - 86400);
		}
		if (ereg("([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})", $date, $regs)) {
			$date = date('d.m.Y', mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]));
		}
		return $date;
	}
	
	function checkAgreementPoliciesInWindow($data) {
		global $db;
		if ($data['mode'] == 1) {
			$agreement_types_title = array(
											'1' =>	'',
											'2'	=>	'на пролонгацію',
											'3'	=>	'на відновлення страхової суми');
			
			$sql = 'SELECT date_format(policies.date, \'%d.%m.%Y\') as date, policies.agreement_types_id as agreement_types_id, policies.id as policies_id, policy_documents.id as policy_documents_id, policies.product_types_id as product_types_id ' .
				   'FROM ' . PREFIX . '_policies as policies ' .
				   'JOIN ' . PREFIX . '_policies as policies2 ON policies.number = policies2.number ' .
				   'JOIN ' . PREFIX . '_policy_documents as policy_documents ON policies.id = policy_documents.policies_id ' .
				   'WHERE policies2.id = ' . intval($data['id']) . ' AND policies.documents = 0 AND policies.agreement_types_id = 2 AND policy_documents.product_document_types_id = ' . DOCUMENT_TYPES_POLICY_KASKO_AGREEMENT . ' AND policies.id NOT IN(' . (sizeof($_SESSION['master_download_agreements']) ? implode(', ', $_SESSION['master_download_agreements']) : '0') . ') AND policies.master_download_agr <> 1 ' .
				   'ORDER BY policies.date';
			$list = $db->getAll($sql);
			$result = '';
			if (is_array($list) && sizeof($list)) {
				$result .= '<table>';
				foreach ($list as $row) {
					$file = array(
								'id'	=>	$row['policy_documents_id']);
					$result .= '<tr>';
					$result .= '<td><a target="_blank" onclick="checkDownloadAgreement(' . intval($row['policies_id']) . ')" href="' . $_SERVER['PHP_SELF'] . '?do=PolicyDocuments|downloadFileInWindow&file=' . urlencode(serialize($file)) . '&product_types_id=' . $row['product_types_id'] . '&policies_id=' . $row['policies_id'] . '&print=1">Додаткова угода ' . $agreement_types_title[$row['agreement_types_id']] . ' від ' . $row['date'] . ' р. (скачати)</a></td>';
					//$result .= '<td><a href="javascript:checkDownloadAgreement(' . intval($row['policy_documents_id']) . ', ' . $row['policies_id'] . ', ' . $db->quote(urlencode(serialize($file))) . ');">Додаткова угода ' . $agreement_types_title[$row['agreement_types_id']] . ' від ' . $row['date'] . ' р.</a></td>';
					$result .= '</tr>';
					
				}
				$result .= '</table>';
			}
			echo $result;
		}
		
		if ($data['mode'] == 2) {
			if (!isset($_SESSION['master_download_agreements'])) {
				$_SESSION['master_download_agreements'] = array();
			}
			$_SESSION['master_download_agreements'][] = $data['id'];
			$sql = 'UPDATE ' . PREFIX . '_policies SET master_download_agr = 1 WHERE id = ' . intval($data['id']);
			$db->query($sql);
			$sql = 'SELECT date_format(policies.date, \'%d.%m.%Y\') as date, policies.agreement_types_id as agreement_types_id, policies.id as policies_id, policy_documents.id as policy_documents_id, policies.product_types_id as product_types_id ' .
				   'FROM ' . PREFIX . '_policies as policies ' .
				   'JOIN ' . PREFIX . '_policies as policies2 ON policies.number = policies2.number ' .
				   'JOIN ' . PREFIX . '_policy_documents as policy_documents ON policies.id = policy_documents.policies_id ' .
				   'WHERE policies2.id = ' . intval($data['id']) . ' AND policies.documents = 0 AND policies.agreement_types_id <> 0 AND policy_documents.product_document_types_id = ' . DOCUMENT_TYPES_POLICY_KASKO_AGREEMENT . ' AND policies.id NOT IN(' . (sizeof($_SESSION['master_download_agreements']) ? implode(', ', $_SESSION['master_download_agreements']) : '0') . ') AND policies.master_download_agr <> 1 ' .
				   'ORDER BY policies.date';
			if (!sizeof($db->getAll($sql))) {
				echo '{done : 1}';
			} else {
				echo '{done : 0}';
			}
		}
	}
	
	function getApplicationInfoInWindow($data) {
		global $db;
		
		if (intval($data['policies_kasko_id'])) {
			switch ($data['types_id']) {
				case 1:
					$prefix = 'insurer';
					break;
				case 2:
					$prefix = 'owner';
					break;
			}
			
			$sql = 'SELECT ' . $prefix . '_lastname as applicant_lastname, ' . $prefix . '_firstname as applicant_firstname, ' . $prefix . '_patronymicname as applicant_patronymicname, ' . $prefix . '_regions_id as applicant_regions_id, ' .
						$prefix . '_area as applciant_area, ' . $prefix . '_city as applicant_city, ' . $prefix . '_street_types_id as applicant_street_types_id, ' . $prefix . '_house as applicant_house, ' . $prefix . '_flat as applicant_flat, ' . 
						$prefix . '_phone as applicant_phone, ' . $prefix . '_street as applicant_street ' .
				   'FROM ' . PREFIX . '_policies_kasko ' .
				   'WHERE policies_id = ' . intval($data['policies_kasko_id']);
			$row = $db->getRow($sql);
			$row['status'] = 1;
		} elseif (intval($data['policies_go_id']) && $data['types_id'] == 1) {	
			$sql = 'SELECT insurer_lastname as applicant_lastname, insurer_firstname as applicant_firstname, insurer_patronymicname as applicant_patronymicname, insurer_regions_id as applicant_regions_id, ' .
						'insurer_area as applciant_area, insurer_city as applicant_city, insurer_street_types_id as applicant_street_types_id, insurer_house as applicant_house, insurer_flat as applicant_flat, ' . 
						'insurer_phone as applicant_phone, insurer_street as applicant_street ' .
				   'FROM ' . PREFIX . '_policies_go ' .
				   'WHERE policies_id = ' . intval($data['policies_go_id']);
			$row = $db->getRow($sql);
			$row['status'] = 1;
		} else {
			$row['status'] = 0;
		}
		
		echo json_encode($row);
		exit;
	}
	
	function getApplicationRisksInWindow($data) {
		global $db;
		
		$conditions[] = 'policies_id = ' . intval($data['policies_kasko_id']);

		$sql =	'SELECT a.risks_id, b.title ' .
				'FROM ' . PREFIX . '_policy_risks AS a ' .
				'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
				'WHERE ' . implode(' AND ', $conditions);
		$list = $db->getAll($sql);
		
		if (intval($data['policies_go_id'])) {
			unset($list);
			$list[] = array('risks_id' => RISKS_DTP, 'title' => 'ДТП');
		}

		$this->mode = Accidents::getMode($data['accidents_id']);

		include_once $this->object . '/applicationRisksInWindow.php';
		exit;
	}
	
	function getSearchInWindow($data) {
		global $db;
	
		$conditions[] = '1';
		
		if ($data['type'] == 1 && intval($data['policies_kasko_id'])) {
			$conditions_kasko[] = 'policies.id = ' . intval($data['policies_kasko_id']);
			$conditions_kasko[] = 'kasko_items.id = ' . intval($data['policies_kasko_items_id']);
		} elseif ($data['type'] == 1 || !in_array(PRODUCT_TYPES_KASKO, $data['product_types_idx'])) {
			$conditions_kasko[] = '0';
		} else {
			$conditions_kasko[] = '1';
		}
		
		if ($data['type'] == 1 && intval($data['policies_go_id'])) {
			$conditions_go[] = 'policies.id = ' . intval($data['policies_go_id']);
		} elseif ($data['type'] == 1 || !in_array(PRODUCT_TYPES_GO, $data['product_types_idx'])) {
			$conditions_go[] = '0';
		} else {
			$conditions_go[] = '1';
		}

		if ($data['number']) {
           $conditions[] = 'policies.number LIKE \'%' . $data['number'] . '%\'';
        } elseif($data['datetime']) {
           $conditions[] = '\'' .  date('Y-m-d', strtotime($data['datetime'])) . '\' BETWEEN getPolicyDate(policies.number, 2) AND getPolicyDate(policies.number, 3)';
        }
		
        if ($data['insurer_lastname']) {
            $conditions_kasko[] = 'policies_kasko.insurer_lastname LIKE ' . $db->quote('%' . $data['insurer_lastname'] . '%');
			$conditions_go[] = 'policies_go.insurer_lastname LIKE ' . $db->quote('%' . $data['insurer_lastname'] . '%');
        }

        if ($data['insurer_passport_series']) {
            $conditions_kasko[] = 'policies_kasko.insurer_passport_series = ' . $db->quote($data['insurer_passport_series']);
			$conditions_go[] = 'policies_go.insurer_passport_series = ' . $db->quote($data['insurer_passport_series']);
        }

        if ($data['insurer_passport_number']) {
            $conditions_kasko[] = 'policies_kasko.insurer_passport_number = ' . $db->quote($data['insurer_passport_number']);
			$conditions_go[] = 'policies_go.insurer_passport_number = ' . $db->quote($data['insurer_passport_number']);
        }

        if ($data['insurer_identification_code']) {
            $conditions_kasko[] = 'policies_kasko.insurer_identification_code = ' . $db->quote($data['insurer_identification_code']);
			$conditions_go[] = 'policies_go.insurer_identification_code = ' . $db->quote($data['insurer_identification_code']);
        }

        if ($data['shassi']) {
            $conditions_kasko[] = 'kasko_items.shassi LIKE \'%' . $data['shassi'] . '%\'';
			$conditions_go[] = 'policies_go.shassi LIKE \'%' . $data['shassi'] . '%\'';
        }

        if ($data['sign']) {
            $conditions_kasko[] = 'kasko_items.sign LIKE \'%' . $data['sign'] . '%\'';
			$conditions_go[] = 'policies_go.sign LIKE \'%' . $data['sign'] . '%\'';
        }

        if ($data['items_id']){
            $conditions_kasko[] = 'kasko_items.id = ' . intval($data['items_id']);
        }

		if ($data['owner_types_id'] == 2) {
			$conditions_kasko[] = 'policies.id = 0';
		}

		$result = '<style>' . 
					'.columns TD {
						height: 25px;
						color: #FFFFFF;
						padding-left: 4px;
						font-weight: bold !important;
						border-right: 1px solid #4F5D75;
						border-top: 1px solid #4F5D75;
						border-bottom: 1px solid #4F5D75;
						background: #008575 url(../images/administration/tabBorder.gif);
					}' .
				'</style>';
		
		$result .=   '<table border="1" width="100%" cellpadding="0" cellspacing="0">' .
							'<tr class="columns">' .
								'<td>Страхувальник</td>' .
								'<td>Вид страхування</td>' .
								'<td>Номер</td>' .
								'<td>Дата</td>' .
								'<td>Автомобіль</td>' .
								'<td>Шасі</td>' .
								'<td>Номер</td>' .
								'<td>Початок</td>' .
								'<td>Закінчення</td>' .
								($data['action'] == 'update' && $data['statuses_id'] == 2 ? '<td>Статус справи</td>' : '') .
                                ($data['no_select'] == 1 ? '' : '<td></td>') .
							'</tr>';

        if((!$data['datetime'] || !checkdate(substr($data['datetime'], 3, 2), substr($data['datetime'], 0, 2), substr($data['datetime'], 6, 4))) && !intval($data['type'])) {
            $result .= '<tr><td colspan="9" align="center" style="color: red;">Дата події обов\'язкова для заповнення.</td></tr>';
            $result .= '</table>';
            echo $result;
            return;
        }

        if (!$conditions) {
            $result .= '<tr><td colspan="9" align="center" style="color: red;">Не задали жодного критерію пошуку.</td></tr>';
            $result .= '</table>';
            echo $result;
            exit;
        }

        $sql =  'SELECT u.policies_id, u.items_id, u.product_types_id, u.product_types_title, u.insurer, u.number, u.date_format, u.item, u.shassi, u.sign, u.begin_datetime_format, u.interrupt_datetime_format 
				 FROM (
					SELECT ' . ($data['type'] == 1 ? 'policies.id' : 'getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')') . ' as policies_id, kasko_items.id as items_id, policies.product_types_id, \'КАСКО\' as product_types_title,
						IF(policies_kasko.insurer_person_types_id = 1, CONCAT(policies_kasko.insurer_lastname, \' \', policies_kasko.insurer_firstname, \' \', policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) AS insurer, 
						policies.number, date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as date_format, CONCAT(kasko_items.brand, \'/\', kasko_items.model) AS item, kasko_items.shassi, kasko_items.sign,
						date_format(getPolicyDate(policies.number, 2), \'%d.%m.%Y\') as begin_datetime_format,  date_format(getPolicyDate(policies.number, 3), \'%d.%m.%Y\') as interrupt_datetime_format 
					FROM ' . PREFIX . '_policies AS policies
					JOIN ' . PREFIX . '_policies_kasko AS policies_kasko ON policies.id = policies_kasko.policies_id ' . ($data['policies_kasko_id'] ? '' : 'AND policies.id = getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')') . '
					JOIN ' . PREFIX . '_policies_kasko_items AS kasko_items ON policies.id = kasko_items.policies_id ' . ($data['policies_kasko_id'] ? '' : 'AND policies.id = getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')') . '
					WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' AND ', $conditions_kasko) . '
					GROUP BY policies.number, kasko_items.shassi 
				
					UNION
				
					SELECT policies_go.policies_id, 0, policies.product_types_id, \'ОСЦПВ\' as product_types_title,
						IF(policies_go.person_types_id = 1, CONCAT(policies_go.insurer_lastname, \' \', policies_go.insurer_firstname, \' \', policies_go.insurer_patronymicname), policies_go.insurer_lastname) AS insurer,
						policies.number, date_format(policies.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, CONCAT(policies_go.brand, \'/\', policies_go.model) AS item, policies_go.shassi, policies_go.sign,
						date_format(policies.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, date_format(policies.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format
					FROM ' . PREFIX . '_policies AS policies
					JOIN ' . PREFIX . '_policies_go AS policies_go ON policies.id = policies_go.policies_id
					WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' AND ', $conditions_go) . '
				) as u
                ORDER BY u.begin_datetime_format DESC';
				//_dump($sql);exit;
        $list = $db->getAll($sql);

        switch (sizeOf($list)) {
            case 0:
                $result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв пошуку поліс не знайдено.</td></tr>';
                $result .= '</table>';
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
                $this->mode = Accidents::getMode($data['accidents_id']);

                foreach ($list as $row) {
                    $result .=  '<tr class="row' . (($i % 2 == 0) ? '1' : '0') .'">' .
                                    '<!--td align="center"><input type="radio" name="items_id" value="' . $row['items_id'] . '" ' . ( ($row['items_id'] == $data['items_id']) ? 'checked' : '') . ' onclick="choosePolicy(' . $row['policies_id'] . ')" ' . $this->getReadonly(true) . ' /></td-->' .
                                    '<td>' . $row['insurer'] . '</td>' .
									'<td>' . $row['product_types_title'] . '</td>' .
                                    '<td>' . $row['number'] . '</a></td>' .
                                    '<td>' . $row['date_format'] . '</td>' .
                                    '<td>' . $row['item'] . '</td>' .
                                    '<td>' . $row['shassi'] . '</td>' .
                                    '<td>' . $row['sign'] . '</td>' .
                                    '<td>' . $row['begin_datetime_format'] . '</td>'.
                                    '<td>' . $row['interrupt_datetime_format'] . '</td>'.
                                    ($data['no_select'] == 1 ? '' :
                                        '<td><a style="cursor: pointer;" onclick="choosePolicy(' . $row['policies_id'] . ', ' . $row['items_id'] . ', ' . $row['product_types_id'] . ', ' . $db->quote($row['product_types_title']) . ', ' . $db->quote($row['insurer']) . ', ' . $db->quote($row['number']) . ', ' .
                                                $db->quote($row['date_format']) . ', ' . $db->quote($row['item']) . ', ' . $db->quote($row['shassi']) . ', ' . $db->quote($row['sign']) . ', ' .
                                                $db->quote($row['begin_datetime_format']) . ', ' . $db->quote($row['interrupt_datetime_format']) . ');">Вибрати</a></td>') .
                                '</tr>';
                }

                $result .= '</table>';
                break;
            default:
                $result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв знайдено багато полісів. Змініть критерії пошуку.</td></tr>';
                $result .= '</table>';
        }
//_dump($data);exit;
		if ($data['type'] == 1) {
			foreach ($list as $row) {
                if ($data['owner_types_id'] == 1 && !intval($data['policies_kasko_id'])) {
                    $row['statuses'] = '<select name="accident_statuses_insurer_id[' . $row['policies_id'] . ']" onchange="checkStatus()"><option value="0">...</option><option value="4">страхувальник ЦВ</option></select>';
                } elseif ($row['product_types_id'] == PRODUCT_TYPES_GO && $data['owner_types_id'] == 1) {
                    $row['statuses'] = '&nbsp;';
                } else {
				    $row['statuses'] = '<select name="accident_statuses_id[' . $row['policies_id'] . ']" onchange="checkStatus()"><option value="0">...</option><option value="2">класифікація</option><option value="17">відхилено</option></select>';
                }
				$new_list[] = $row;
			}
			$result = json_encode($new_list);
		}

        echo $result;
	}
}

?>