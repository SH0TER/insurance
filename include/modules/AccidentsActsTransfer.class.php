<?
/*
 * Title: accident payments class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';
require_once 'AccidentActs.class.php';

class AccidentsActsTransfer extends Form {

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
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер',
					        'type'				=> fldText,
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
							'orderPosition'		=> 1,
							'orderName'			=> 'transfer.id',
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'types_id',
							'description'		=> 'Тип',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'statuses_id',
							'description'		=> 'Статус',
					        'type'				=> fldInteger,
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
							'orderPosition'		=> 2,
							'orderName'			=> 'transfer.statuses_id',
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата формування',
					        'type'				=> fldDate,
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
							'orderPosition'		=> 3,
							'orderName'			=> 'transfer.date',
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'formed_accounts_id',
							'description'		=> 'Виконавець, формування',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'CONCAT_WS(\' \', accounts_formed.lastname, accounts_formed.firstname) as acconts_formed_title',
							'description'		=> 'Виконавець, формування',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'withoutTable'		=> true,
							'orderPosition'		=> 4,
							'orderName'			=> 'accounts_formed.lastname, accounts_formed.firstname',
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'received_date',
							'description'		=> 'Дата отримання СК',
					        'type'				=> fldDate,
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
							'orderPosition'		=> 5,
							'orderName'			=> 'transfer.received_date',
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'received_accounts_id',
							'description'		=> 'Виконавець, отримання',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'CONCAT_WS(\' \', accounts_received.lastname, accounts_received.firstname) as acconts_received_title',
							'description'		=> 'Виконавець, отримання',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'withoutTable'		=> true,
							'orderPosition'		=> 6,
							'orderName'			=> 'accounts_received.lastname, accounts_received.firstname',
							'table'				=> 'accidents_acts_transfer'),	
						array(
							'name'				=> 'closed_date',
							'description'		=> 'Дата закриття СК',
					        'type'				=> fldDate,
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
							'orderName'			=> 'transfer.closed_date',
							'table'				=> 'accidents_acts_transfer'),						
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
							'orderPosition'		=> 8,
							'orderName'			=> 'transfer.created',
                            'width'             => 100,
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'CONCAT_WS(\' \', accounts_created.lastname, accounts_created.firstname) as accounts_created_title',
							'description'		=> 'Виконавець, створення',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'withoutTable'		=> true,
							'orderPosition'		=> 9,
							'orderName'			=> 'accounts_created.lastname, accounts_created.firstname',
							'table'				=> 'accidents_acts_transfer'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
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
							'orderPosition'		=> 10,
							'orderName'			=> 'transfer.modified',
                            'width'             => 100,
							'table'				=> 'accidents_acts_transfer'),
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'number'
					)
			);

	function AccidentsActsTransfer($data) {
		Form::Form($data);
		
		switch ($data['types_id']) {
			case '1':
				$this->messages['plural'] = 'Реєстри передачі страхових актів';
				$this->messages['single'] = 'Реєстр передачі страхових актів';
				break;
			case '2':
				$this->messages['plural'] = 'Акти оплати за надання послуг';
				$this->messages['single'] = 'Акт оплати за надання послуг';
				break;
			case '3':
				$this->messages['plural'] = 'Реєстри передачі експертиз, Асістанс';
				$this->messages['single'] = 'Реєстр передачі експертих, Асістанс';
				break;
			case '4':
				$this->messages['plural'] = 'Реєстри передачі експертиз, інші';
				$this->messages['single'] = 'Реєстр передачі експертих, інші';
				break;
		}		
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'			=> true,
					'update'		=> true,
					'insert'		=> false,
					'generated'		=> true,
					'view'			=> true,
					'formed'		=> true,
					'received'		=> true,
					'comment'		=> true,
					'export'		=> true,
					'exportAll'	=> true);
				break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db, $Authorization;
		
		$this->checkPermissions('show');
	
		$this->setTables('show');
        $this->setShowFields();
		
		$hidden['do'] = 'AccidentsActsTransfer|show';
		$hidden['types_id'] = intval($data['types_id']);
		
		$conditions[] = '1';
		
		$conditions[] = 'transfer.types_id = '. intval($data['types_id']);
		
		if (is_array($data['statuses_id']) && sizeof($data['statuses_id'])) {
			$conditions[] = 'transfer.statuses_id IN(' . implode(', ', $data['statuses_id']) . ')';
		}
		
		if ($data['dateFrom']) {
			$conditions[] = 'transfer.statuses_id > 1 AND transfer.date >= ' . $db->quote(date('Y-m-d', strtotime($data['dateFrom'])) . ' ' . '00:00:00');
		}
		
		if ($data['dateTo']) {
			$conditions[] = 'transfer.statuses_id > 1 AND transfer.date IS NOT NULL AND transfer.date <= ' . $db->quote(date('Y-m-d', strtotime($data['dateTo'])) . ' ' . '23:59:59');
		}
		
		if ($data['receivedDateFrom']) {
			$conditions[] = 'transfer.statuses_id > 2 AND transfer.received_date >= ' . $db->quote(date('Y-m-d', strtotime($data['receivedDateFrom'])) . ' ' . '00:00:00');
		}
		
		if ($data['receivedDateTo']) {
			$conditions[] = 'transfer.statuses_id > 2 AND transfer.received_date <= ' . $db->quote(date('Y-m-d', strtotime($data['receivedDateTo'])) . ' ' . '23:59:59');
		}
		
		if ($data['closedDateFrom']) {
			$conditions[] = 'transfer.statuses_id > 3 AND transfer.closed_date >= ' . $db->quote(date('Y-m-d', strtotime($data['closedDateFrom'])) . ' ' . '00:00:00');
		}
		
		if ($data['closedDateTo']) {
			$conditions[] = 'transfer.statuses_id > 3 AND transfer.closed_date <= ' . $db->quote(date('Y-m-d', strtotime($data['closedDateTo'])) . ' ' . '23:59:59');
		}
	
		$sql = 'SELECT transfer.id as id, transfer.number as number, transfer.types_id as types_id, transfer.statuses_id as statuses_id, accidents_acts_transfer_statuses.title as statuses_title, date_format(transfer.date, \'%d.%m.%Y\') as date_format, ' .
					'transfer.formed_accounts_id as formed_accounts_id, CONCAT_WS(\' \', accounts_formed.lastname, accounts_formed.firstname) as formed_accounts_name, ' .
					'transfer.received_accounts_id as received_accounts_id, CONCAT_WS(\' \', accounts_received.lastname, accounts_received.firstname) as received_accounts_name, ' .
					'transfer.created_accounts_id as created_accounts_id, CONCAT_WS(\' \', accounts_created.lastname, accounts_created.firstname) as created_accounts_name, ' .
					'date_format(transfer.received_date, \'%d.%m.%Y\') as received_date_format, date_format(transfer.closed_date, \'%d.%m.%Y\') as closed_date_format, date_format(transfer.created, \'%d.%m.%Y\') as created_format, date_format(transfer.modified, \'%d.%m.%Y\') as modified_format ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer as transfer ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_formed ON transfer.formed_accounts_id = accounts_formed.id ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_received ON transfer.received_accounts_id = accounts_received.id ' .
			   'JOIN ' . PREFIX . '_accounts as accounts_created ON transfer.created_accounts_id = accounts_created.id ' .
			   'JOIN ' . PREFIX . '_accidents_acts_transfer_statuses as accidents_acts_transfer_statuses ON transfer.statuses_id = accidents_acts_transfer_statuses.id ' .
			   'WHERE ' . implode(' AND ', $conditions);

		$total	= $db->getOne(transformToGetCount($sql));
		
		$sql .= ' ORDER BY ' . $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

		$list = $db->getAll($sql);
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer_statuses ' .
			   'ORDER BY id ASC';
		$statuses = $db->getAll($sql);
		
		$types = array(
			1	=>	'Страхові акти',
			3	=>	'Експертизи, Асістанс',
			4	=>	'Експертизи, інші'
		);

		include $this->objectTitle . '/' . $template;	
	}
	
	function generate($data) {
		global $db, $Log;
			
		$this->checkPermissions('generated');		
		
		$conditions = array();
		$joins = array();
		
		switch ($data['types_id']) {
			case '1':
				$field = 'accidents_acts_transfer_id';
				$table = PREFIX . '_accidents_acts';
				$title = 'Реєстр передачі страхових актів';
				$obj_mess = 'страхові акти';
				$part_mess = 'передачі';
				$conditions[] = 'a.act_statuses_id = ' . ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY;
				$conditions[] = 'a.accidents_acts_transfer_id = 0';
				break;
			case '2':
				$field = 'accidents_acts_payment_id';
				$table = PREFIX . '_accidents_acts';
				$title = 'Акт оплати за надання послуг';
				$obj_mess = 'страхові акти';
				$part_mess = 'оплати';
				$conditions[] = 'a.accidents_acts_transfer_id > 0';
				$conditions[] = 'a.sign_payment = 1';
				//$conditions[] = 'acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED;
				$conditions[] = 'b.statuses_id IN(3, 4)';
				$conditions[] = 'a.accidents_acts_payment_id = 0';
				$conditions[] = 'b.date <= ' . $db->quote(date('Y-m-d H:i:s', mktime(23, 59, 59, $data['month']+1, 0, $data['year'])));
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts_transfer as b ON a.accidents_acts_transfer_id = b.id';
				break;
			case '3':
				$field = 'expertise_transfers_id';
				$table = PREFIX . '_accident_payments_calendar';
				$title = 'Реєстр передачі експертиз, Асістанс';
				$obj_mess = 'експертизи (асістанс)';
				$part_mess = 'передачі';
				$conditions[] = 'a.expertise_transfers_id = 0';
				$conditions[] = 'a.payment_types_id = ' . PAYMENT_TYPES_EXPERTISE;
				$conditions[] = 'a.recipient_types_id = ' . RECIPIENT_TYPES_EXPERT;
				$conditions[] = 'a.recipients_id = 53';
				$conditions[] = 'a.created >= \'2013-11-01\'';
				break;
			case '4':
				$field = 'expertise_transfers_id';
				$table = PREFIX . '_accident_payments_calendar';
				$title = 'Реєстр передачі експертиз, інші';
				$obj_mess = 'експертизи (інші)';
				$part_mess = 'передачі';
				$conditions[] = 'a.expertise_transfers_id = 0';
				$conditions[] = 'a.payment_types_id = ' . PAYMENT_TYPES_EXPERTISE;
				$conditions[] = 'a.recipient_types_id = ' . RECIPIENT_TYPES_EXPERT;
				$conditions[] = 'a.recipients_id <> 53';
				$conditions[] = 'a.created >= \'2013-11-01\'';
				break;
		}
		
		if (!sizeof($conditions)) {
			header('Location: /index.php?do=AccidentsActsTransfer|show&types_id=' . intval($data['types_id']));
			exit;
		}
		
		$transfer_list = $this->getTransferListIdInCreated($data['types_id']);
		
		$sql = 'SELECT a.id ' .
			   'FROM ' . $table . ' as a ' .
			   implode(' ', $joins) . ' ' .
			   'WHERE ' . implode(' AND ', $conditions);
		$list_acts_id = $db->getCol($sql);

		if (intval($transfer_list['id']) && is_array($list_acts_id) && sizeof($list_acts_id) && (in_array($data['types_id'], array(1, 3, 4)) || $data['types_id'] == 2 && ($data['month'] . '-' . $data['year']) == $transfer_list['sub_number'])) {
			$sql = 'UPDATE ' . $table . ' ' .
				   'SET ' . $field . ' = ' . intval($transfer_list['id']) . ' ' .
				   'WHERE id IN(' . implode(', ', $list_acts_id) . ')';
			$db->query($sql);
			$Log->add('confirm', $title . ' № ' . $transfer_list['number'] . ' змінено.');
		} elseif (is_array($list_acts_id) && sizeof($list_acts_id) && (in_array($data['types_id'], array(1, 3, 4)) || $data['types_id'] == 2 && !intval($transfer_list['id']))) {
			$id = $this->generated($data);
			if (intval($id)) {
				$sql = 'UPDATE ' . $table . ' ' .
					   'SET ' . $field . ' = ' . intval($id) . ' ' .
					   'WHERE id IN(' . implode(', ', $list_acts_id) . ')';
				$db->query($sql);
				$number = $this->setNumber($id);
			
				$Log->add('confirm', $title . ' № ' . $number . ' створено.');
			} else {
				$Log->add('error', $title . ' не створено.');
			}
		} elseif (is_array($list_acts_id) && sizeof($list_acts_id) && $data['types_id'] == 2 && intval($transfer_list['id'])) {
			$Log->add('error', 'Попередній акт ще не сформований.');
		} else {
			$Log->add('confirm', 'Нові ' . $obj_mess . ' для ' . $part_mess . ' відсутні.');
		}
		
		header('Location: /index.php?do=AccidentsActsTransfer|show&types_id=' . intval($data['types_id']));
		exit;
	}
	
	function generated($data) {
		global $db, $Authorization;
		
		$this->checkPermissions('generated');
		
		if ($data['types_id'] == 2) {
			$sql = 'SELECT id ' .
				   'FROM ' . PREFIX . '_accidents_acts_transfer ' .
				   'WHERE sub_number = ' . $db->quote($data['month'] . '-' . $data['year']);
			if (intval($db->getOne($sql))) {
				return 0;
			}
			$sub_number = $data['month'] . '-' . $data['year'];
		}
		
		$sql = 'INSERT INTO ' . PREFIX . '_accidents_acts_transfer ' .
			   'SET types_id = ' . intval($data['types_id']) . ', statuses_id = 1, created = NOW(), modified = NOW(), created_accounts_id = ' . intval($Authorization->data['id']) . ', sub_number = ' . $db->quote($sub_number);
		$db->query($sql);
		
		return mysql_insert_id();
	}
	
	function setNumber($id) {
		global $db;
		
		$sql = 'SELECT COUNT(*) ' . 
			   'FROM ' . PREFIX . '_accidents_acts_transfer ' .
			   'WHERE types_id = ' . intval($this->getTypesId($id));
		$count = $db->getOne($sql);

		$length = strlen(intval($count));
		
		$number = '';
		for ($i=0; $i < 5 - $length; $i++) {
			$number .= '0';
		}
		$number .= ($count);

		$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer ' .
			   'SET number = ' . $db->quote($number) . ' ' .
			   'WHERE id = ' . intval($id);
		$db->query($sql);
		
		return $number;
	}
	
	function view($data, $action='view') {
		global $db;	
		
		$this->checkPermissions('view');
		
		if (is_array($data['id'])) {
			$data['id'] = $data['id'][0];
		}

		$fields = array();
		$joins = array();
		
		switch ($data['types_id']) {
			case '1':
				$template = 'getTransferAccidentsActsList.php';
			
				$field = 'accidents_acts_transfer_id';
				$alias = 'accidents_acts';
				
				$fields[] = 'accidents_acts.id as id';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accidents_acts.number as accidents_acts_number';
				$fields[] = 'CASE accidents_acts.insurance
								WHEN 1 THEN \'виплата\'
								ELSE IF(accidents_acts.sign_suspended = 1, \'призупинено\', \'відмова\')
							END as insurance_title';
				$fields[] = 'accidents_acts.amount as amount';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accident_statuses.title as act_statuses_title';
				$fields[] = 'accidents_acts.reason as reason';
				$fields[] = 'date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date';
				$fields[] = 'accidents_acts.transfer_comment';
				$fields[] = 'IF(accidents_acts.sign_payment = 1, \'оплата\', \'не оплата\') as notes';
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id';
				$joins[] = 'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents_acts.act_statuses_id = accident_statuses.id';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ')';
				$conditions[] = $alias . '.' . $field . ' = ' . intval($data['id']);
				
				$groupby = 'accidents_acts.id';
				$orderby = 'accidents.number';
				break;
			case '2':
				$template = 'getTransferAccidentsActsList.php';
				
				$field = 'accidents_acts_payment_id';
				$alias = 'accidents_acts';
				
				$fields[] = 'accidents_acts.id as id';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accidents_acts.number as accidents_acts_number';
				$fields[] = 'CASE accidents_acts.insurance
								WHEN 1 THEN \'виплата\'
								ELSE IF(accidents_acts.sign_suspended = 1, \'призупинено\', \'відмова\')
							END as insurance_title';
				$fields[] = 'accidents_acts.amount as amount';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accident_statuses.title as act_statuses_title';
				$fields[] = 'accidents_acts.reason as reason';
				$fields[] = 'date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date';
				$fields[] = 'transfer.id as transfer_id';
				$fields[] = 'IF(accidents_acts.sign_payment = 1, \'оплата\', \'не оплата\') as notes';
				$fields[] = 'CONCAT_WS(\' / \', transfer.number, date_format(transfer.date, \'%d.%m.%Y\')) as transfer_info';
				$fields[] = 'accidents_acts.transfer_comment';
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id';
				$joins[] = 'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents_acts.act_statuses_id = accident_statuses.id';
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts_transfer as transfer ON accidents_acts.accidents_acts_transfer_id = transfer.id';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ')';
				$conditions[] = $alias . '.' . $field . ' = ' . intval($data['id']);
				
				$groupby = 'accidents_acts.id';
				$orderby = 'transfer.number';
				break;
			case '3':
			case '4':
				$template = 'getTransferExpertisesList.php';
			
				$field = 'expertise_transfers_id';
				$alias = 'payments_calendar';
				
				$fields[] = 'payments_calendar.id as id';
				$fields[] = 'CASE accidents.product_types_id
								WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(kasko_items.brand, \' \', kasko_items.model)
								WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(policies_go.brand, \' \', policies_go.model)
							END as policies_item';
				$fields[] = 'CASE accidents.product_types_id
								WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(LENGTH(kasko_items.sign) > 0, kasko_items.sign, kasko_items.shassi)
								WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(LENGTH(policies_go.sign) > 0, policies_go.sign, policies_go.shassi)
							END as policies_item_sign';
				$fields[] = 'date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_datetime';
				$fields[] = 'date_format(accidents.date, \'%d.%m.%Y\') as accidents_date';
				$fields[] = 'payments_calendar.recipient as expert_organizations_title';
				$fields[] = 'payments_calendar.amount as expertise_amount';
				
				$joins[] = 'JOIN ' . PREFIX . '_accident_payments_calendar as payments_calendar ON accidents.id = payments_calendar.accidents_id';
				$joins[] = 'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id';
				$joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ')';
				$conditions[] = $alias . '.' . $field . ' = ' . intval($data['id']);
				
				$groupby = 'payments_calendar.id';
				$orderby = 'accidents.number';
				break;
		}
		
		$sql = 'SELECT transfer.id as id, transfer.id as number, transfer.types_id as types_id, transfer.statuses_id as statuses_id, accidents_acts_transfer_statuses.title as statuses_title, date_format(transfer.date, \'%d.%m.%Y\') as date_format, ' .
					'transfer.formed_accounts_id as formed_accounts_id, CONCAT_WS(\' \', accounts_formed.lastname, accounts_formed.firstname) as formed_accounts_name, ' .
					'transfer.received_accounts_id as received_accounts_id, CONCAT_WS(\' \', accounts_received.lastname, accounts_received.firstname) as received_accounts_name, ' .
					'transfer.created_accounts_id as created_accounts_id, CONCAT_WS(\' \', accounts_created.lastname, accounts_created.firstname) as created_accounts_name, ' .
					'date_format(transfer.received_date, \'%d.%m.%Y\') as received_date_format, date_format(transfer.closed_date, \'%d.%m.%Y\') as closed_date_format, date_format(transfer.created, \'%d.%m.%Y\') as created_format, date_format(transfer.modified, \'%d.%m.%Y\') as modified_format ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer as transfer ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_formed ON transfer.formed_accounts_id = accounts_formed.id ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_received ON transfer.received_accounts_id = accounts_received.id ' .
			   'JOIN ' . PREFIX . '_accounts as accounts_created ON transfer.created_accounts_id = accounts_created.id ' .
			   'JOIN ' . PREFIX . '_accidents_acts_transfer_statuses as accidents_acts_transfer_statuses ON transfer.statuses_id = accidents_acts_transfer_statuses.id ' .
			   'WHERE transfer.id = ' . intval($data['id']);
		$data = $db->getRow($sql);
		
		$sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, accidents.product_types_id as product_types_id, product_types.title as product_types_title, policies.number as policies_number, ' .
					'CASE accidents.product_types_id
						WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company)
						WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname)
						WHEN ' . PRODUCT_TYPES_PROPERTY . ' THEN IF(policies_property.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_property.insurer_lastname, policies_property.insurer_firstname, policies_property.insurer_patronymicname), policies_property.insurer_company)
					END as insurer, ' .
					'CONCAT_WS(\' \', accidents_go.owner_lastname, accidents_go.owner_firstname, accidents_go.owner_patronymicname) as owner ' .
					(sizeof($fields) ? ', ' . implode(', ', $fields) . ' ' : ' ') .
				'FROM ' . PREFIX . '_accidents as accidents ' .
				'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				//'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_property as policies_property ON accidents.policies_id = policies_property.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
				'JOIN ' . PREFIX . '_product_types as product_types ON accidents.product_types_id = product_types.id ' .
				(sizeof($joins) ? implode(' ', $joins) . ' ' : '') .
				//'WHERE accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ') AND ' . $alias . '.' . $field . ' = ' . intval($data['id']) . ' ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'GROUP BY ' . $groupby . ' ' . 
				'ORDER BY ' . $orderby;
		$list = $db->getAll($sql);
		
        include_once $this->object . '/' . $template;

	}
	
	function viewActsList($data) {
		
	}
	
	function load($data, $action='update') {
		global $db;	
		
		if (is_array($data['id'])) {
			$data['id'] = $data['id'][0];
		}
		
		$fields = array();
		$joins = array();
		$conditions = array();
		
		switch ($data['types_id']) {
			case '1':
				$template = 'getTransferAccidentsActsList.php';
			
				$field = 'accidents_acts_transfer_id';
				$alias = 'accidents_acts';
				
				$fields[] = 'accidents_acts.id as id';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accidents_acts.number as accidents_acts_number';
				$fields[] = 'CASE accidents_acts.insurance
								WHEN 1 THEN \'виплата\'
								ELSE IF(accidents_acts.sign_suspended = 1, \'призупинено\', \'відмова\')
							END as insurance_title';
				$fields[] = 'accidents_acts.amount as amount';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accident_statuses.title as act_statuses_title';
				$fields[] = 'accidents_acts.reason as reason';
				$fields[] = 'date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date';
				$fields[] = 'accidents_acts.transfer_comment';
				$fields[] = 'IF(accidents_acts.sign_payment = 1, \'оплата\', \'не оплата\') as notes';
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id';
				$joins[] = 'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents_acts.act_statuses_id = accident_statuses.id';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ')';
				$conditions[] = $alias . '.' . $field . ' = ' . intval($data['id']);
				
				$groupby = 'accidents_acts.id';
				$orderby = 'accidents.number';
				break;
			case '2':
				$template = 'getTransferAccidentsActsList.php';
				
				$field = 'accidents_acts_payment_id';
				$alias = 'accidents_acts';
				
				$fields[] = 'accidents_acts.id as id';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accidents_acts.number as accidents_acts_number';
				$fields[] = 'CASE accidents_acts.insurance
								WHEN 1 THEN \'виплата\'
								ELSE IF(accidents_acts.sign_suspended = 1, \'призупинено\', \'відмова\')
							END as insurance_title';
				$fields[] = 'accidents_acts.amount as amount';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accident_statuses.title as act_statuses_title';
				$fields[] = 'accidents_acts.reason as reason';
				$fields[] = 'date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date';
				$fields[] = 'transfer.id as transfer_id';
				$fields[] = 'IF(accidents_acts.sign_payment = 1, \'оплата\', \'не оплата\') as notes';
				$fields[] = 'CONCAT_WS(\' / \', transfer.number, date_format(transfer.date, \'%d.%m.%Y\')) as transfer_info';
				$fields[] = 'accidents_acts.transfer_comment';
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id';
				$joins[] = 'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents_acts.act_statuses_id = accident_statuses.id';
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts_transfer as transfer ON accidents_acts.accidents_acts_transfer_id = transfer.id';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ')';
				$conditions[] = $alias . '.' . $field . ' = ' . intval($data['id']);
				
				$groupby = 'accidents_acts.id';
				$orderby = 'transfer.number';
				break;
			case '3':
			case '4':
				$template = 'getTransferExpertisesList.php';
			
				$field = 'expertise_transfers_id';
				$alias = 'payments_calendar';
				
				$fields[] = 'payments_calendar.id as id';
				$fields[] = 'CASE accidents.product_types_id
								WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(kasko_items.brand, \' \', kasko_items.model)
								WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(policies_go.brand, \' \', policies_go.model)
							END as policies_item';
				$fields[] = 'CASE accidents.product_types_id
								WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(LENGTH(kasko_items.sign) > 0, kasko_items.sign, kasko_items.shassi)
								WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(LENGTH(policies_go.sign) > 0, policies_go.sign, policies_go.shassi)
							END as policies_item_sign';
				$fields[] = 'date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_datetime';
				$fields[] = 'date_format(accidents.date, \'%d.%m.%Y\') as accidents_date';
				$fields[] = 'payments_calendar.recipient as expert_organizations_title';
				$fields[] = 'payments_calendar.amount as expertise_amount';
				
				$joins[] = 'JOIN ' . PREFIX . '_accident_payments_calendar as payments_calendar ON accidents.id = payments_calendar.accidents_id';
				$joins[] = 'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id';
				$joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ')';
				$conditions[] = $alias . '.' . $field . ' = ' . intval($data['id']);
				
				$groupby = 'payments_calendar.id';
				$orderby = 'accidents.number';
				break;
		}
		
		$sql = 'SELECT transfer.id as id, transfer.id as number, transfer.types_id as types_id, transfer.statuses_id as statuses_id, accidents_acts_transfer_statuses.title as statuses_title, date_format(transfer.date, \'%d.%m.%Y\') as date_format, ' .
					'transfer.formed_accounts_id as formed_accounts_id, CONCAT_WS(\' \', accounts_formed.lastname, accounts_formed.firstname) as formed_accounts_name, ' .
					'transfer.received_accounts_id as received_accounts_id, CONCAT_WS(\' \', accounts_received.lastname, accounts_received.firstname) as received_accounts_name, ' .
					'transfer.created_accounts_id as created_accounts_id, CONCAT_WS(\' \', accounts_created.lastname, accounts_created.firstname) as created_accounts_name, ' .
					'date_format(transfer.received_date, \'%d.%m.%Y\') as received_date_format, date_format(transfer.closed_date, \'%d.%m.%Y\') as closed_date_format, date_format(transfer.created, \'%d.%m.%Y\') as created_format, date_format(transfer.modified, \'%d.%m.%Y\') as modified_format ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer as transfer ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_formed ON transfer.formed_accounts_id = accounts_formed.id ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_received ON transfer.received_accounts_id = accounts_received.id ' .
			   'JOIN ' . PREFIX . '_accounts as accounts_created ON transfer.created_accounts_id = accounts_created.id ' .
			   'JOIN ' . PREFIX . '_accidents_acts_transfer_statuses as accidents_acts_transfer_statuses ON transfer.statuses_id = accidents_acts_transfer_statuses.id ' .
			   'WHERE transfer.id = ' . intval($data['id']);
		$data = $db->getRow($sql);

		$sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, accidents.product_types_id as product_types_id, product_types.title as product_types_title, policies.number as policies_number, ' .
					'CASE accidents.product_types_id
						WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company)
						WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname)
						WHEN ' . PRODUCT_TYPES_PROPERTY . ' THEN IF(policies_property.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_property.insurer_lastname, policies_property.insurer_firstname, policies_property.insurer_patronymicname), policies_property.insurer_company)
					END as insurer, ' .
					'CONCAT_WS(\' \', accidents_go.owner_lastname, accidents_go.owner_firstname, accidents_go.owner_patronymicname) as owner ' .
					(sizeof($fields) ? ', ' . implode(', ', $fields) . ' ' : ' ') .
				'FROM ' . PREFIX . '_accidents as accidents ' .
				'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_property as policies_property ON accidents.policies_id = policies_property.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
				'JOIN ' . PREFIX . '_product_types as product_types ON accidents.product_types_id = product_types.id ' .
				(sizeof($joins) ? implode(' ', $joins) . ' ' : '') .
				//'WHERE accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ') AND ' . $alias . '.' . $field . ' = ' . intval($data['id']) . ' ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'GROUP BY ' . $groupby . ' ' . 
				'ORDER BY ' . $orderby;
		$list = $db->getAll($sql);

        include_once $this->object . '/' . $template;

	}

	function exportInWindow($data) {
		global $db, $MONTHES;
		
		$fields = array();
		$joins = array();
		
		switch ($data['types_id']) {
			case '1':
				$template = 'getTransferAccidentsActsList.php';
			
				$field = 'accidents_acts_transfer_id';
				$alias = 'accidents_acts';
				
				$fields[] = 'accidents_acts.id as id';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accidents_acts.number as accidents_acts_number';
				$fields[] = 'CASE accidents_acts.insurance
								WHEN 1 THEN \'виплата\'
								ELSE IF(accidents_acts.sign_suspended = 1, \'призупинено\', \'відмова\')
							END as insurance_title';
				$fields[] = 'accidents_acts.amount as amount';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accident_statuses.title as act_statuses_title';
				$fields[] = 'accidents_acts.reason as reason';
				$fields[] = 'date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date';
				$fields[] = 'accidents_acts.transfer_comment';
				$fields[] = 'IF(accidents_acts.sign_payment = 1, \'оплата\', \'не оплата\') as notes';
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id';
				$joins[] = 'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents_acts.act_statuses_id = accident_statuses.id';
				
				$groupby = 'accidents_acts.id';
				$orderby = 'accidents.number';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ')';
				break;
			case '2':
				$template = 'getTransferAccidentsActsList.php';
				
				$field = 'accidents_acts_payment_id';
				$alias = 'accidents_acts';
				
				$fields[] = 'accidents_acts.id as id';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accidents_acts.number as accidents_acts_number';
				$fields[] = 'CASE accidents_acts.insurance
								WHEN 1 THEN \'виплата\'
								ELSE IF(accidents_acts.sign_suspended = 1, \'призупинено\', \'відмова\')
							END as insurance_title';
				$fields[] = 'accidents_acts.amount as amount';
				$fields[] = 'accidents_acts.act_statuses_id as act_statuses_id';
				$fields[] = 'accident_statuses.title as act_statuses_title';
				$fields[] = 'accidents_acts.reason as reason';
				$fields[] = 'date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date';
				$fields[] = 'transfer.id as transfer_id';
				$fields[] = 'IF(accidents_acts.sign_payment = 1, \'оплата\', \'не оплата\') as notes';
				$fields[] = 'CONCAT_WS(\' / \', transfer.number, date_format(transfer.date, \'%d.%m.%Y\')) as transfer_info';
				$fields[] = 'accidents_acts.transfer_comment';
				
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id';
				$joins[] = 'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents_acts.act_statuses_id = accident_statuses.id';
				$joins[] = 'JOIN ' . PREFIX . '_accidents_acts_transfer as transfer ON accidents_acts.accidents_acts_transfer_id = transfer.id';
				
				$groupby = 'accidents_acts.id';
				$orderby = 'transfer.number';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ', ' . PRODUCT_TYPES_PROPERTY . ')';
				break;
			case '3':
			case '4':
				$template = 'getTransferExpertisesList.php';
			
				$field = 'expertise_transfers_id';
				$alias = 'payments_calendar';
				
				$fields[] = 'payments_calendar.id as id';
				$fields[] = 'CASE accidents.product_types_id
								WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(kasko_items.brand, \' \', kasko_items.model)
								WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(policies_go.brand, \' \', policies_go.model)
							END as policies_item';
				$fields[] = 'CASE accidents.product_types_id
								WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(LENGTH(kasko_items.sign) > 0, kasko_items.sign, kasko_items.shassi)
								WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(LENGTH(policies_go.sign) > 0, policies_go.sign, policies_go.shassi)
							END as policies_item_sign';
				$fields[] = 'date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_datetime';
				$fields[] = 'date_format(accidents.date, \'%d.%m.%Y\') as accidents_date';
				$fields[] = 'payments_calendar.recipient as expert_organizations_title';
				$fields[] = 'payments_calendar.amount as expertise_amount';
				
				$joins[] = 'JOIN ' . PREFIX . '_accident_payments_calendar as payments_calendar ON accidents.id = payments_calendar.accidents_id';
				$joins[] = 'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id';
				$joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id';
				
				$groupby = 'payments_calendar.id';
				$orderby = 'accidents.number';
				
				$conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ')';
				break;
		}		
		
		if ($data['transfer_statuses_id'] == 1 && is_array($data['id']) && sizeof($data['id'])) {
			$conditions[] = $alias . '.id IN(' . implode(', ', $data['id']) . ')';
		} elseif ($data['transfer_statuses_id'] == 1 && (!is_array($data['id']) || !sizeof($data['id']))) {
			$conditions[] = $alias . '.' . $field . ' = ' . intval($data['transfer_id']);
		} elseif ($data['transfer_statuses_id'] > 1) {
			$conditions[] = $alias . '.' . $field . ' = ' . intval($data['transfer_id']);
		}
		
		$sql = 'SELECT transfer.id, transfer.number, transfer.sub_number, date_format(transfer.date, \'%d.%m.%Y\') as date_format, CONCAT(accounts.lastname, \' \', SUBSTRING(accounts.firstname, 1, 1), \'. \', SUBSTRING(accounts.patronymicname, 1, 1), \'.\') as formed_accounts_name ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer as transfer ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts ON transfer.formed_accounts_id = accounts.id ' .
			   'WHERE transfer.id = ' . intval($data['transfer_id']);
		$transfer = $db->getRow($sql);
		
		$transfer['period'] = explode('-', $transfer['sub_number']);
		$transfer['month'] = $MONTHES[$transfer['period'][0]-1];
		$transfer['year'] = $transfer['period'][1];
		
		$sql = $sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, accidents.product_types_id as product_types_id, product_types.title as product_types_title, policies.number as policies_number, ' .
					'CASE accidents.product_types_id
						WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company)
						WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname)
						WHEN ' . PRODUCT_TYPES_PROPERTY . ' THEN IF(policies_property.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_property.insurer_lastname, policies_property.insurer_firstname, policies_property.insurer_patronymicname), policies_property.insurer_company)
					END as insurer, ' .
					'CONCAT_WS(\' \', accidents_go.owner_lastname, accidents_go.owner_firstname, accidents_go.owner_patronymicname) as owner ' .
					(sizeof($fields) ? ', ' . implode(', ', $fields) . ' ' : ' ') .
				'FROM ' . PREFIX . '_accidents as accidents ' .
				'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				//'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_property as policies_property ON accidents.policies_id = policies_property.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
				'JOIN ' . PREFIX . '_product_types as product_types ON accidents.product_types_id = product_types.id ' .
				(sizeof($joins) ? implode(' ', $joins) . ' ' : '') .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'GROUP BY ' . $groupby . ' ' . 
				'ORDER BY ' . $orderby;
		$list = $db->getAll($sql);

		header('Content-Disposition: attachment; filename="report.xls"');
		header('Content-Type: ' . Form::getContentType('report.xls'));
		
		switch ($data['types_id']) {
			case '1':
				include_once $this->object . '/getTransferAccidentsActsListExcel.php';
				break;
			case '2':
				include_once $this->object . '/getPaymentAccidentsActsListExcel.php';
				break;
			case '3':
			case '4':
				include_once $this->object . '/getTransferExpertisesListExcel.php';
				break;
		}
		
		exit;
	}
	
	function exportAllInWindow($data) {
		global $db;
		
		$conditions[] = '1';
		
		$conditions[] = 'transfer.types_id = ' . intval($data['types_id']);
		
		if (is_array($data['statuses_id']) && sizeof($data['statuses_id'])) {
			$conditions[] = 'transfer.statuses_id IN(' . implode(', ', $data['statuses_id']) . ')';
		}
		
		if ($data['dateFrom']) {
			$conditions[] = 'transfer.statuses_id > 1 AND transfer.date >= ' . $db->quote(date('Y-m-d', strtotime($data['dateFrom'])) . ' ' . '00:00:00');
		}
		
		if ($data['dateTo']) {
			$conditions[] = 'transfer.statuses_id > 1 AND transfer.date IS NOT NULL AND transfer.date <= ' . $db->quote(date('Y-m-d', strtotime($data['dateTo'])) . ' ' . '23:59:59');
		}
		
		if ($data['receivedDateFrom']) {
			$conditions[] = 'transfer.statuses_id > 2 AND transfer.received_date >= ' . $db->quote(date('Y-m-d', strtotime($data['receivedDateFrom'])) . ' ' . '00:00:00');
		}
		
		if ($data['receivedDateTo']) {
			$conditions[] = 'transfer.statuses_id > 2 AND transfer.received_date <= ' . $db->quote(date('Y-m-d', strtotime($data['receivedDateTo'])) . ' ' . '23:59:59');
		}
		
		if ($data['closedDateFrom']) {
			$conditions[] = 'transfer.statuses_id > 3 AND transfer.closed_date >= ' . $db->quote(date('Y-m-d', strtotime($data['closedDateFrom'])) . ' ' . '00:00:00');
		}
		
		if ($data['closedDateTo']) {
			$conditions[] = 'transfer.statuses_id > 3 AND transfer.closed_date <= ' . $db->quote(date('Y-m-d', strtotime($data['closedDateTo'])) . ' ' . '23:59:59');
		}
	
		$sql = 'SELECT transfer.id as id, transfer.number as number, transfer.types_id as types_id, transfer.statuses_id as statuses_id, accidents_acts_transfer_statuses.title as statuses_title, date_format(transfer.date, \'%d.%m.%Y\') as date_format, ' .
					'transfer.formed_accounts_id as formed_accounts_id, CONCAT_WS(\' \', accounts_formed.lastname, accounts_formed.firstname) as formed_accounts_name, ' .
					'transfer.received_accounts_id as received_accounts_id, CONCAT_WS(\' \', accounts_received.lastname, accounts_received.firstname) as received_accounts_name, ' .
					'transfer.created_accounts_id as created_accounts_id, CONCAT_WS(\' \', accounts_created.lastname, accounts_created.firstname) as created_accounts_name, ' .
					'date_format(transfer.received_date, \'%d.%m.%Y\') as received_date_format, date_format(transfer.closed_date, \'%d.%m.%Y\') as closed_date_format, date_format(transfer.created, \'%d.%m.%Y\') as created_format, date_format(transfer.modified, \'%d.%m.%Y\') as modified_format ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer as transfer ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_formed ON transfer.formed_accounts_id = accounts_formed.id ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_received ON transfer.received_accounts_id = accounts_received.id ' .
			   'JOIN ' . PREFIX . '_accounts as accounts_created ON transfer.created_accounts_id = accounts_created.id ' .
			   'JOIN ' . PREFIX . '_accidents_acts_transfer_statuses as accidents_acts_transfer_statuses ON transfer.statuses_id = accidents_acts_transfer_statuses.id ' .
			   'WHERE ' . implode(' AND ', $conditions) . ' ' .
			   'ORDER BY transfer.number';
		$list = $db->getAll($sql);
		
		header('Content-Disposition: attachment; filename="report.xls"');
		header('Content-Type: ' . Form::getContentType('report.xls'));

		include_once $this->object . '/exportAll.php';
		exit;
	}
	
	function changeStatusesIdInWindow($data) {
		global $db, $Authorization;

		if ($this->getStatuses($data['id']) == intval($data['value'])) {
			$result = '{message : "Реєстр уже знаходиться в статусі, в який Ви хочете перевести."}';
		} else {
			$set_fields = array();
			switch ($data['types_id']) {
			case '1':
				$set_fields[] = 'accidents_acts_transfer_id = 0';
				$set_fields[] = 'sign_payment = 0';
				break;
			case '2':
				$set_fields[] = 'accidents_acts_payment_id = 0';
				break;
			}
			
			switch ($data['value']) {
				case '2':
					if (is_array($data['acts_id']) && sizeof($data['acts_id'])) {
						$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
							   'SET ' . implode(', ', $set_fields) . ' ' . 
							   'WHERE id IN(' . implode(', ', $data['acts_id']) . ')';
						$db->query($sql);
					}
					$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer ' . 
						   'SET statuses_id = ' . intval($data['value']) . ', date = NOW(), formed_accounts_id = ' . intval($Authorization->data['id']) . ' ' .
						   'WHERE id = ' . intval($data['id']);
					$result = '{message : "Статус реєстру змінено на \'Сформований\'."}';
					break;
				case '3':
					$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer ' . 
						   'SET statuses_id = ' . intval($data['value']) . ', received_date = NOW(), received_accounts_id = ' . intval($Authorization->data['id']) . ' ' .
						   'WHERE id = ' . intval($data['id']);
					$result = '{message : "Статус реєстру змінено на \'Відзвітований\'."}';
					break;
				case '4':
					$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer ' . 
						   'SET statuses_id = ' . intval($data['value']) . ', closed_date = NOW() ' .
						   'WHERE id = ' . intval($data['id']);
					$result = '{message : "Статус реєстру змінено на \'Закритий\'."}';
					break;
				default:
					$result = '{message : "Статус реєстра не змінено."}';
					break;
			}
			
			if ($sql) {
				$db->query($sql);
			}
		}
		
		echo $result;
		exit;
	}
	
	function getTransferListIdInCreated($types_id) {
		global $db;
		
		$sql = 'SELECT id, number, sub_number ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer ' .
			   'WHERE statuses_id = 1 AND types_id = ' . intval($types_id);
		
		return $db->getRow($sql);
	}
	
	function getStatuses($id) {
		global $db;
		
		$sql = 'SELECT statuses_id ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer ' .
			   'WHERE id = ' . intval($id);
		return intval($db->getOne($sql));
		
	}
	
	function setCommentInWindow($data) {
		global $db, $Log, $Authorization;


		if (!$Log->isPresent()) {
			$Accidents = new Accidents($data);
			$Accidents->insertAccidentsComment(array('accidents_id'=> AccidentActs::getAccidentsId($data['id']), 'monitoring_comment' => $data['transfer_comment']));
		
			$sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
					'transfer_comment = ' . $db->quote(htmlspecialchars($this->replaceTags(trim($data['transfer_comment'])))) . ' ' .
					'WHERE id=' . intval($data['id']);
			$db->query($sql);
			
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer ' .
				   'SET statuses_id = 3 ' .
				   'WHERE id = ' . intval($data['transfer_id']);
			$db->query($sql);			

			$Log->add('confirm', 'Коментар було встановлено.');
			
			$this->send($data, 'TransferComment');
		}

		$result = $Log->get();

		echo '{"type":"' . $result[ 0 ]['type'] . '","text":"' . $result[ 0 ]['text'] . '"}';
		exit;
	}
	
	function backToRiskInWindow($data) {
		global $db, $Log, $Authorization;


		if (!$Log->isPresent()) {
			$Accidents = new Accidents($data);
			$Accidents->changeAccidentStatus(AccidentActs::getAccidentsId($data['id']), ACCIDENT_STATUSES_REINVESTIGATION);
			$Accidents->insertAccidentsComment(array('accidents_id'=> AccidentActs::getAccidentsId($data['id']), 'monitoring_comment' => 'Справу переведено на \'Повторний розгляд\'.'));

			$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
				   'SET act_statuses_id = ' . ACCIDENT_STATUSES_INVESTIGATION . ' ' .
				   'WHERE id = ' . intval($data['id']);
			$db->query($sql);
			
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts_transfer ' .
				   'SET statuses_id = 3 ' .
				   'WHERE id = ' . intval($data['transfer_id']);
			$db->query($sql);

			$Log->add('confirm', 'Справу переведено на \'Повторний розгляд\'.');
			
			$this->send($data, 'TransferBackToRisk');
		}

		$result = $Log->get();

		echo '{"type":"' . $result[ 0 ]['type'] . '","text":"' . $result[ 0 ]['text'] . '"}';
		exit;
	}
	
	function send($data, $template) {
		global $db, $Templates;
		
		$sql = 'SELECT a.email as email ' .
			   'FROM ' . PREFIX . '_accounts as a ' .
			   'JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id ' .
			   'WHERE b.account_groups_id = 45';
		$recipients = $db->getAll($sql);
		
		$sql = 'SELECT a.email as email ' . 
			   'FROM ' . PREFIX . '_accounts as a ' .
			   'JOIN ' . PREFIX . '_accidents as b ON a.id = b.average_managers_id ' .
			   'WHERE b.id = ' . intval(AccidentActs::getAccidentsId($data['id']));
		$recipients[] = $db->getRow($sql);
		
		/*$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
		$recipients[] = array('email' => 'o.gorobets@express-group.com.ua');*/
		
		$data['accidents_id'] = AccidentActs::getAccidentsId($data['id']);
		$data['accidents_number'] = Accidents::getNumber($data['accidents_id']);
		$data['product_types_id'] = Accidents::getProductTypesId($data['accidents_id']);
	
		if (is_array($recipients) && sizeOf($recipients)) {
            foreach($recipients as $recipient) {
				$Templates->send($recipient['email'], $data, $template, null);
            }
		}
	}
	
	function getTypesId($id) {
		global $db;
		
		$sql = 'SELECT types_id ' .
			   'FROM ' . PREFIX . '_accidents_acts_transfer ' . 
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
		
}

?>