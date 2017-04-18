<?
/*
 * Title: Cards class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Agencies.class.php';

class Cards extends Form {

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
							'table'				=> 'cards'),
						array(
							'name'				=> 'agencies_id',
							'description'		=> 'Агенція',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 2,
							'table'				=> 'cards',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер картки',
					        'type'				=> fldText,
					        'maxlength'			=> 7,
					        'validationRule'	=> '^[0-9]{7}$',
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
							'orderPosition'		=> 3,
							'table'				=> 'cards'),
						array(
							'name'				=> 'card_statuses_id',
							'description'		=> 'Статус',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 5,
							'table'				=> 'cards',
							'sourceTable'		=> 'card_statuses',
							'selectField'		=> 'title',
							'orderField'		=> 'id'),
						array(
							'name'				=> 'transaction_date',
							'description'		=> 'Дата транзакції',
					        'type'				=> fldDate,
					        'input'				=> true,
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
							'table'				=> 'cards'),
						array(
							'name'				=> 'realisation_date',
							'description'		=> 'Дата реалізації',
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
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 7,
							'table'				=> 'cards'),
						array(
							'name'				=> 'agents_id',
							'description'		=> 'Агент',
					        'type'				=> fldSelect,
							'condition'			=> 'roles_id = 8',
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
							'table'				=> 'cards',
							'sourceTable'		=> 'accounts',
							'selectField'		=> 'lastname',
							'orderField'		=> 'lastname'),
						array(
							'name'				=> 'clients_id',
							'description'		=> 'Клієнт',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 9,
							'table'				=> 'cards',
							'sourceTable'		=> 'clients',
							'selectField'		=> 'lastname',
							'orderField'		=> 'lastname'),
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
							'orderPosition'		=> 10,
                            'width'             => 100,
							'table'				=> 'cards'),
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 6,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function Cards($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Картки';
		$this->messages['single'] = 'Картка';
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
					'change'	=> false,
					'export'	=> true,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_AGENT:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> false,
					'view'		=> false,
					'change'	=> false,
					'export'	=> true,
					'delete'	=> false);
				break;
		}
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db, $Authorization;

		$this->checkPermissions('show', $data);

		$hidden['do'] = $data['do'];

		switch ($Authorization->data['roles_id']) {
			case ROLES_AGENT:
				$fields[] = 'agencies_id';
				$data['agencies_id'] = $Authorization->data['agencies_id'];
				break;
		}

		if ($data['number']) {
			$fields[] = 'number';
			$conditions[] = $this->tables[0] . '.number LIKE ' . $db->quote($data['number'] . '%');
		}

		if (intval($data['card_statuses_id'])) {
			$fields[] = 'card_statuses_id';
			$conditions[] = 'card_statuses_id = ' . intval($data['card_statuses_id']);
		}

		if ($data['from']) {
			$fields[] = 'from';
			$conditions[] = 'TO_DAYS(' . $this->tables[0] . '.transaction_date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
		}

		if ($data['to']) {
			$fields[] = 'to';
			$conditions[] =  'TO_DAYS(' . $this->tables[0] . '.transaction_date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
		}

		if (intval($data['agencies_id'])) {
			$Agencies = new Agencies($data);
			$agencies_id = array($data['agencies_id']);
			$Agencies->getSubId(&$agencies_id, $data['agencies_id']);

			$fields[] = 'agencies_id';
			$conditions[] = $this->tables[0] . '.agencies_id IN(' . implode(', ', $agencies_id) . ')';
		}

		if (is_array($fields)) {
			foreach($fields as $name) {
				$hidden[ $name ] = $data[ $name ];
			}
		}

		$this->setTables('show');
		$this->setShowFields();

		if (!$sql) {
			$sql = 	'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
					'FROM ' . PREFIX . '_cards ' .
					'JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_cards.agencies_id = ' . PREFIX . '_agencies.id ' .
					'JOIN ' . PREFIX . '_card_statuses ON insurance_cards.card_statuses_id = insurance_card_statuses.id ' .
					'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_cards.agents_id = ' . PREFIX . '_accounts.id ' .
					'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_cards.clients_id = ' . PREFIX . '_clients.id ';

			if (is_array($conditions)) {
				$sql .= 'WHERE ' . implode(' AND ', $conditions);
			}
		}

		$total	= $db->getOne(transformToGetCount($sql));

		$sql .= ' ORDER BY ';

		$sql .= $this->getShowOrderCondition();

		if ($limit) {
			$sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
		}

		$list = $db->getAll($sql);

		$fields['card_statuses_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('card_statuses_id') ];
		$fields['card_statuses_id']['list'] = $this->getListValue($fields['card_statuses_id'], $data);
		$fields['card_statuses_id']['object'] = $this->buildSelect($fields['card_statuses_id'], $data['card_statuses_id'], null, null, $data);

		 $sql =	'SELECT id, code, title, level ' .
                        'FROM ' . PREFIX . '_agencies ' .
                        'ORDER BY CAST(code AS DECIMAL),num_l';				
        $agencies = $db->getAll($sql, 60 * 60);

		include $this->object . '/' . $template;
	}

	function showForm($data, $action, $actionType=null, $template=null) {
		global $Log;

		if (is_null($actionType)) {
			$actionType = $action;
		}

		$this->setListValues($data, $actionType);

		$Log->showSystem();

		if (!is_null($template)) {
			include_once $this->object . '/' . $template;
			return;
		}

		switch ($actionType) {
			case 'view':
				(is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/view.php'))
					? include_once $this->object . '/view.php'
					: include_once 'view.php';
				break;
			case 'previewInWindow':
				(is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/previewInWindow.php'))
					? include_once $this->object . '/previewInWindow.php'
					: include_once 'previewInWindow.php';
				break;
			case 'insert':
				include_once $this->object . '/form.php';
				break;
			case 'update':
				include_once 'form.php';
				break;

		}
	}

	function checkFields($data, $action) {
		global $db, $Log;

		parent::checkFields($data, $action);

		switch ($action) {
			case 'insert':

				$field = $this->formDescription['fields'][ $this->getFieldPositionByName('number') ];

				$params = array('Номер картки з', '');

				if (!ereg($field['validationRule'], $data['from'])) {
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}

				$params = array('Номер картки по', '');

				if (!ereg($field['validationRule'], $data['to'])) {
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}

				if (!$Log->isPresent()) {

					$conditions[] = 'CAST(number AS UNSIGNED) BETWEEN ' . intval($data['from']) . ' AND ' . intval($data['to']);

					$sql =	'SELECT count(*) ' .
							'FROM ' . PREFIX . '_cards ' .
							'WHERE ' . implode(' AND ', $conditions);
					if ($db->getOne($sql)) {
						$Log->add('error', 'Картки вже існують у вказанному діапазоні.', $params);
					}
				}

				break;
		}
	}

	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $db, $Log;

		$this->checkPermissions('insert', $data);

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

			for ($i = $data['from']; $i <= $data['to']; $i++) {
				$sql =	'INSERT INTO ' . PREFIX . '_cards SET ' .
						'agencies_id = ' . intval($data['agencies_id']) . ', ' .
						'number = ' . $db->quote(sprintf('%07s', $i)) . ', ' .
						//'transaction_date = ' . $db->quote($data['transaction_date_year'] . '-' . $data['transaction_date_month'] . '-' . $data['transaction_date_day']) . ', ' .
						'card_statuses_id = ' . intval($data['card_statuses_id']) . ', ' .
						'created = NOW(), ' .
						'modified = NOW()';
				$db->query($sql);
			}

			if ($redirect) {

				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return true;
			}
		}
	}

	function isValid($number, $clients_id=0) {
		global $db;

		$conditions[] = 'clients_id = ' . intval($clients_id);
		$conditions[] = 'number = ' . $db->quote($number);

		$sql =	'SELECT card_statuses_id ' .
				'FROM ' . PREFIX . '_cards ' .
				'WHERE ' . implode(' AND ', $conditions);
		$card_statuses_id =	$db->getOne($sql);

		return ($card_statuses_id) ? true : false;
	}

	function get($number) {
		global $db;

		$conditions[] = 'number = ' . $db->quote($number);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_cards ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getRow($sql);
	}
	
	function exportInWindow($data) {

		$this->checkPermissions('export', $data);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'excel.php', false);
        exit;
    }
}

?>