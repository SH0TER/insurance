<?
/*
 * Title: currency rate class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'CurrenciesImport.class.php';

class CurrencyRates extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'currencies_id',
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
							'table'				=> 'currency_rates'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата',
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
							'orderPosition'		=> 1,
							'table'				=> 'currency_rates'),
						array(
							'name'				=> 'rate',
							'description'		=> 'Курс',
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
									'canBeEmpty'	=> false
								),
							'table'				=> 'currency_rates')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'date_format(date, \'%d.%m.%Y\')',
					)
			);

	function CurrencyRates($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Курси';
		$this->messages['single'] = 'Курс';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'import'	=> true,
					'update'	=> true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> true);
				break;
			default:
				$this->permissions = array(
					'show'		=> false,
					'insert'	=> false,
					'import'	=> true,
					'update'	=> false,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> false);
				break;
		}
	}

	function show($data, $fields=null, $conditions=null) {
		global $db;

		$this->checkPermissions('show', $data);

		$hidden['do'] = $data['do'];

		if (is_array($fields)) {
			foreach($fields as $name) {
				$hidden[ $name ] = $data[ $name ];
			}
		}

		$this->setTables('show');
		$this->setShowFields();

		if (is_array($conditions)) {
			$sql = 'SELECT DISTINCT date, date_format(date, \'' . DATE_FORMAT . '\') as date_format FROM ' . implode(', ', $this->tables) . ' WHERE ' . implode(' AND ', $conditions) . ' ORDER BY ';
		} else {
			$sql = 'SELECT DISTINCT date, date_format(date, \'' . DATE_FORMAT . '\') as date_format FROM ' . implode(', ', $this->tables) . ' ORDER BY ';
		}

		$total	= $db->getOne(transformToGetCount($sql));

		$direction = (ereg('^(asc|desc)$', $_COOKIE[ $this->object ]['orderDirection']))
			? $_COOKIE[ $this->object ]['orderDirection']
			: $this->formDescription['common']['defaultOrderDirection'];

		$sql .= ($this->getFieldNameByOrderPosition($_COOKIE[$this->object]['orderPosition']))
			? $this->getFieldNameByOrderPosition($_COOKIE[$this->object]['orderPosition']) . ' ' . $direction
			: $this->getFieldNameByOrderPosition($this->formDescription['common']['defaultOrderPosition']) . ' ' . $direction;

		if ($limit) {
			$sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($_SESSION['auth']['records_per_page']);
		}

		$list = $db->getAll($sql);

		$this->changePermissions($total);

		include $this->object . '/show.php';
	}

	function buildFieldsPart($data, $action) {
		$result = '';

		switch ($action) {
			case 'view':
				$result = '<tr><td class="label">Дата:</td><td>' . $data['date_format'] . '</td></tr>';
				while ($data['res']->fetchInto($row)) {
					$result .= '<tr><td class="label">Курс (' . $row['code'] . ') :</td><td>' . $data['rate'][ $row['currencies_id'] ]['value'] . '</td></tr>';
				}
				break;
			default:
				$result = '<tr><td class="label">*Дата:</td><td>' . $this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['yeardate'], $data['monthdate'], $data['daydate'], 'date') . '</td></tr>';
				while ($data['res']->fetchInto($row)) {
					$result .= '<tr>
						<td class="label">*Курс (' . $row['code'] . ') :</td>
							<td>
								<input type="text" id="rate[' . $row['currencies_id'] . '][value]" name="rate[' . $row['currencies_id'] . '][value]" value="' . $data['rate'][ $row['currencies_id'] ]['value'] . '" maxlength="7" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />
								<input type="hidden" name="rate[' . $row['currencies_id'] . '][title]" value="' . $row['code'] . '" />
							</td>
						</tr>';
				}
		}
		return $result;
	}

	function showForm($data, $action, $actionType=null) {
		global $db, $Log;

		$conditions[] = 'import = 1';

		$sql =	'SELECT id as currencies_id, code ' .
				'FROM ' . PREFIX . '_currencies ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY order_position';
		$data['res'] =	$db->query($sql);

		parent::showForm($data, $action, $actionType);
	}

	function insert($data, $redirect=true, $action='insert') {
		global $db, $Log;

		switch ($action) {
			case 'insert':
			case 'update':
				$this->checkPermissions($action, $data);
				break;
		}

		$params = array('Дата', '');

		if (!checkdate($data['date_month'], $data['date_day'], $data['date_year'])) {
			$Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
		}

		if (is_array($data['rate'])) {

			foreach ($data['rate'] as $currencies_id => $row) {

				$params = array('Курс', ' (' . $row['title'] . ')');

				if (!$row['value']) {
					$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
				} elseif (!$this->isValidMoney($row['value'])) {
					$Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
				}
			}
		}

		if ($Log->isPresent()) {
			$this->showForm($data, $GLOBALS['method'], $action);
		} else {
			if (is_array($data['rate'])) {
				foreach ($data['rate'] as $currencies_id => $row) {
					$sql =	'REPLACE INTO ' . $this->tables[0] . ' SET ' .
							'currencies_id = ' . intval($currencies_id) . ', ' .
							'date = ' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) . ', ' . 
							'rate = ' . $db->quote($row['value']);
					$db->query($sql);
				}
			}

			$params['title']	= $this->messages['single'];
			$params['storage']	= $this->tables[0];

			if ($redirect) {
				$Log->add('confirm', $this->messages[$action]['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return true;
			}
		}
	}

	function getIdentityField() {
		return $this->formDescription['fields'][ $this->getFieldPositionByName('date') ];
	}

	function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
		global $db;

		$this->checkPermissions('update', $data);

		if (is_array($data['id'])) $data['id'] = $data['id'][0];

		$this->setTables('load');
		$this->getFormFields('update');

		$identityField = $this->getIdentityField();

		$sql =	'SELECT *, date_format(date, \'%Y\') as yeardate, date_format(date, \'%m\') as monthdate, date_format(date, \'%d\') as daydate, date_format(date, ' . $db->quote(DATE_FORMAT) . ') as date_format ' .
				'FROM ' . implode(', ', $this->tables) . ' ' .
				'WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . $db->quote($data['id']);
		$res = $db->query($sql);

		while ($res->fetchInto($row)) {

			$data['yeardate']	= $row['yeardate'];
			$data['monthdate']	= $row['monthdate'];
			$data['daydate']	= $row['daydate'];

			$data['rate'][ $row['currencies_id'] ]['value'] = $row['rate'];
		}

		if ($showForm) {
			$this->showForm($data, $action, $actionType, $template);
		} else {
			return $data;
		}
	}

	function view($data) {
		global $db;

		$this->checkPermissions('view', $data);

		$action		= 'view';
		$actionType = 'view';

		if (is_array($data['id'])) $data['id'] = $data['id'][0];

		$this->setTables('view');
		$this->getFormFields('view');

		$identityField = $this->getIdentityField();

		$prefix = ($conditions) ? implode(' AND ', $conditions) : '';

		$sql = 'SELECT *, date_format(date, \'' . DATE_FORMAT . '\') as date_format FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . $db->quote($data['id']);
		$res = $db->query($sql);

		while ($res->fetchInto($row)) {
			$data['date_format'] = $row['date_format'];
			$data['rate'][ $row['currencies_id'] ]['value'] = $row['rate'];
		}

		$this->showForm($data, $action, $actionType);

		return $data;
	}

	function update($data, $redirect=true) {
		$this->insert($data, $redirect, 'update');
	}

	function deleteProcess($data) {
		global $db;

		$conditions[] = '(date=\'' . implode('\' OR date=\'', $data['id']) . '\')';

		$sql =	'DELETE ' . 
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE ' . implode(' AND ', $conditions);
		$db->query($sql);

		return true;
	}

	function import($data, $redirect=true) {
		global $db, $Log;

		$this->checkPermissions('import', $data);

		$CurrenciesImport =& new CurrenciesImport($data);

		$parser =& new XML_HTMLSax3();
		$parser->set_object($CurrenciesImport);
		$parser->set_element_handler('openHandler', 'closeHandler');
		$parser->set_data_handler('dataHandler');

		$contents = file_get_contents(URLS_IMPORT_CURRENCIES);
		$parser->parse($contents);

		$params['title']		= $this->messages['single'];
		$params['storage']		= $this->tables[0];

		if (is_array($CurrenciesImport->data)) {
			foreach ($CurrenciesImport->data as $currencies_id => $row) {
				$sql =	'REPLACE INTO ' . $this->tables[0] . ' SET ' .
						'currencies_id = ' . intval($currencies_id) . ', ' .
						'date = ' . $db->quote($CurrenciesImport->date) . ', ' .
						'rate = ' . $db->quote($row[5] / $row[3]);
				$db->query($sql);
			}

			$Log->add('confirm', $this->messages['importProcess']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
		} else {
			$Log->add('confirm', $this->messages['importProcess']['error'], $params, $data[$this->formDescription['common']['titleField']], true);			
		}

		if ($redirect) {
			header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
			exit;
		}
	}

	function importInWindow($data) {
		$this->import($data, false);

		echo 'Currency rates: imported<br />';
		exit;
	}
}

?>