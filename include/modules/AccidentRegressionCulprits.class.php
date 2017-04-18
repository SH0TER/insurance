<?
/*
 * Title: accident regressions class
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassy@gmail.com
 * @version 3.0
 */

require_once 'AccidentRegressionPayments.class.php';
 
class AccidentRegressionCulprits extends Form {

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
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'accidents_number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 1,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'accidents_date_format',
                            'description'       => 'Подія',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 2,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'date_format',
                            'description'       => 'Передача',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 3,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'person_types_id',
                            'description'       => 'Особа',
                            'type'              => fldInteger,
                            'list'				=> array(
                                                    1 => 'Фізична',
                                                    2 => 'Юридична'),
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'accident_regression_culprits'),
						array(
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Страхова компанія',
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
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_regression_culprits',
                            'sourceTable'       => 'companies_mtsbu',
                            'selectField'       => 'title',
							'condition'			=> 'id > 0',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'title',
                            'description'       => 'Інша сторона',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 5,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),

                        array(
                            'name'              => 'pretension_date',
                            'description'       => 'Претензія, дата',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 6,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'pretension_number',
                            'description'       => 'Претензія, номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 7,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'pretension_amount',
                            'description'       => 'Претензія, сума грн.',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 8,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'pretension_comment',
                            'description'       => 'Претензія, коментар',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 9,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'retension_perfmormers_title',
                            'description'       => 'Претензія, виконавець',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 10,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_date',
                            'description'       => 'Позов, дата',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 11,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_number',
                            'description'       => 'Позов, номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 12,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_amount',
                            'description'       => 'Позов, сума грн.',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 13,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_comment',
                            'description'       => 'Позов, коментар',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 14,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_perfmormers_title',
                            'description'       => 'Позов, виконавець',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 15,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
						array(
                            'name'              => 'regression_statuses_id',
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
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 12,
                            'table'             => 'accident_regression_culprits',
                            'sourceTable'       => 'accident_regression_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'orderPosition'     => 16,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'orderPosition'     => 17,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 17,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'modified'
                    )
            );

    function AccidentRegressionCulprits($data) {

        $this->object = 'AccidentRegressionCulprits';
        $this->objectTitle = 'AccidentRegressionCulprits';

        Form::Form($data);

        $this->messages['plural'] = 'Регреси';
        $this->messages['single'] = 'Регрес';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'   => true,
                    'insert' => true,
                    'update' => true,
                    'delete' => true,
					'view'	 => true,
					'export' => true
				);
                break;
        }
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db;

		$conditions[] = '1';

		if (isset($data['accidents_number'])) {
			$conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote('%' . $data['accidents_number'] . '%');
		}
		
		if (isset($data['title'])) {
			$conditions[] = PREFIX . '_accident_regression_culprits.title LIKE ' . $db->quote('%' . $data['title'] . '%');
		}

		if (intval($data['person_types_id'])) {
			$conditions[] = PREFIX . '_accident_regression_culprits.person_types_id = ' . intval($data['person_types_id']);
		}
		
		if (intval($data['insurance_companies_id'])) {
			$conditions[] = PREFIX . '_accident_regression_culprits.insurance_companies_id = ' . intval($data['insurance_companies_id']);
		}

		if (!is_array($data['regression_statuses_id'])) {
			$data['regression_statuses_id'] = array(0);
		}
		
		if (is_array($data['regression_statuses_id']) && sizeOf($data['regression_statuses_id'])) {
			$conditions[] = PREFIX . '_accident_regression_culprits.regression_statuses_id IN (' . implode(', ', $data['regression_statuses_id']) . ')';
		}
		
		$data['pretension_conditions'][] = 'types_id = 1';
		$data['claim_conditions'][] = 'types_id = 2';
		
		if (intval($data['export']) && $data['from_payed_date']) {
			$data['pretension_conditions'][] = 'date >= ' . $db->quote( substr($data['from_payed_date'], 6, 4) . '-' . substr($data['from_payed_date'], 3, 2) . '-' . substr($data['from_payed_date'], 0, 2) );
			$data['claim_conditions'][] = 'date >= ' . $db->quote( substr($data['from_payed_date'], 6, 4) . '-' . substr($data['from_payed_date'], 3, 2) . '-' . substr($data['from_payed_date'], 0, 2) );
		}
		
		if (intval($data['export']) && $data['to_payed_date']) {
			$data['pretension_conditions'][] = 'date <= ' . $db->quote( substr($data['to_payed_date'], 6, 4) . '-' . substr($data['to_payed_date'], 3, 2) . '-' . substr($data['to_payed_date'], 0, 2) );
			$data['claim_conditions'][] = 'date <= ' . $db->quote( substr($data['to_payed_date'], 6, 4) . '-' . substr($data['to_payed_date'], 3, 2) . '-' . substr($data['to_payed_date'], 0, 2) );
		}

        $sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_companies_mtsbu ' .
				'ORDER BY title';
        $data['insurance_companies'] = $db->getAll($sql);

		$person_types = $this->getFieldPositionByName('person_types_id');
		$data['person_types'] = $person_types['list'];

        $sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_accident_regression_statuses ' .
				'ORDER BY id';
        $data['regression_statuses'] = $db->getAll($sql);

		$sql =	'SELECT ' . PREFIX . '_accidents.number AS accidents_number, date_format(' . PREFIX . '_accidents.datetime, \'%d.%m.%Y\') AS accidents_date_format, date_format(' . PREFIX . '_accident_regressions.date, \'%d.%m.%Y\') AS date_format, ' . PREFIX . '_accident_regression_culprits.person_types_id, ' . PREFIX . '_accident_regression_culprits.title, ' .
				'date_format(pretension_date, \'%d.%m.%Y\') AS pretension_date_format, pretension_number, pretension_amount, pretension_comment, CONCAT(d.lastname, \' \', d.firstname) AS pretension_perfmormers_title, ' .
				
				'date_format(claim_date, \'%d.%m.%Y\') AS claim_date_format, claim_number, claim_amount, claim_comment, CONCAT(e.lastname, \' \', e.firstname) AS claim_perfmormers_title, ' .
				
				PREFIX . '_accident_regression_statuses.title AS regressions_statuses_title, ' . PREFIX . '_accident_regressions.comment, date_format(' . PREFIX . '_accident_regression_culprits.created, \'%d.%m.%Y\') AS created_format, date_format(' . PREFIX . '_accident_regression_culprits.modified, \'%d.%m.%Y\') AS modified_format, ' .
				PREFIX . '_accident_regression_culprits.id ' .
				'FROM ' . PREFIX . '_accident_regressions ' .
				'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_regressions.accidents_id = ' . PREFIX . '_accidents.id ' .
				'LEFT JOIN ' . PREFIX . '_accident_regression_culprits ON ' . PREFIX . '_accident_regressions.id = ' . PREFIX . '_accident_regression_culprits.regressions_id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS d ON ' . PREFIX . '_accident_regression_culprits.pretension_perfmormers_id = d.id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS e ON ' . PREFIX . '_accident_regression_culprits.claim_perfmormers_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_accident_regression_statuses ON ' . PREFIX . '_accident_regression_culprits.regression_statuses_id = ' . PREFIX . '_accident_regression_statuses.id ' .
				'WHERE ' . implode(' AND ', $conditions);
//_dump($sql);exit;
		return parent::show($data, $fields, $conditions, $sql, 'AccidentRegressionCulprits/' . $template, $limit);
	}
	
	function insert($data, $redirect=true, $showForm=true) {
		global $db, $Log;
	
		$this->checkPermissions('insert', $data);
		
		$data = $this->replaceSpecialChars($data, 'insert');
		
		$this->setConstants($data);
		
		$this->checkFields($data, 'insert');
		
		if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'insert');

        } else {
			
			$regressions_id = $this->getAccidentRegressionByAccidentsId($data['accidents_id']);
		
			if (!intval($regressions_id)) {
				$sql = 'INSERT INTO ' . PREFIX . '_accident_regressions ' .
					   'SET accidents_id = ' . intval($data['accidents_id']) . ', ' .
							'date = ' . $db->quote($data['date']) . ', ' .
							'comment = ' . $db->quote($data['comment']);
				$db->query($sql);
				
				$regressions_id = mysql_insert_id();
			} else {			
				$sql = 'UPDATE ' . PREFIX . '_accident_regressions ' .
					   'SET date = ' . $db->quote($data['date']) . ' ' .
					   'WHERE id = ' . intval($regressions_id);
				$db->query($sql);
			}
			
			$pretension_set_fields = '';
			$claim_set_fields = '';
			if (intval($data['pretension'])) {
				$pretension_set_fields = 'pretension = 1, ' .
										 'pretension_date = ' . $db->quote($data['pretension_date']) . ', ' .
										 'pretension_number = ' . $db->quote($data['pretension_number']) . ', ' .
										 'pretension_amount = ' . $data['pretension_amount'] . ', ' .
										 'pretension_comment = ' . $db->quote($data['pretension_comment']) . ', ' .
										 'pretension_perfmormers_id = ' . intval($data['pretension_perfmormers_id']) . ', ';
			}
			
			if (intval($data['claim'])) {
				$claim_set_fields = 'claim = 1, ' .
									'claim_date = ' . $db->quote($data['claim_date']) . ', ' .
									'claim_number = ' . $db->quote($data['claim_number']) . ', ' .
									'claim_amount = ' . $data['claim_amount'] . ', ' .
									'claim_comment = ' . $db->quote($data['claim_comment']) . ', ' .
									'claim_perfmormers_id = ' . intval($data['claim_perfmormers_id']) . ', ';
			}
		
			$sql = 'INSERT INTO ' . PREFIX . '_accident_regression_culprits ' .
				   'SET regressions_id = ' . intval($regressions_id) . ', ' .
						'person_types_id = ' . intval($data['person_types_id']) . ', ' .
						'insurance_companies_id = ' . intval($data['insurance_companies_id']) . ', ' .
						'title = ' . $db->quote($data['title']) . ', ' .
						$pretension_set_fields . $claim_set_fields . 
						'created = NOW(), modified = NOW()';
			$db->query($sql);
			
			$params['title']    = $this->messages['single'];
			$params['id']       = mysql_insert_id();
			$params['storage']  = $this->tables[0];
	
			if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            }
		
		}
	
	}
	
	function load($data, $showForm=true, $action='update', $actionType='update', $template='form.php') {
		global $db;
		
		$this->checkPermissions('update', $data);
		
		if (is_array($data['id'])) {
       		$data['id'] = $data['id'][0];
       	}
		
		$sql = 'SELECT ' . PREFIX . '_accident_regressions.accidents_id, ' . PREFIX . '_accidents.number as accidents_number, ' . PREFIX . '_accident_regressions.date, ' . PREFIX . '_accident_regressions.comment, ' . 
					PREFIX . '_accident_regression_culprits.person_types_id, ' . PREFIX . '_accident_regression_culprits.insurance_companies_id, ' . PREFIX . '_accident_regression_culprits.title, ' .
					PREFIX . '_accident_regression_culprits.pretension, ' . PREFIX . '_accident_regression_culprits.pretension_date, ' . PREFIX . '_accident_regression_culprits.pretension_number, ' . PREFIX . '_accident_regression_culprits.pretension_amount, ' .
					PREFIX . '_accident_regression_culprits.pretension_comment, ' . PREFIX . '_accident_regression_culprits.pretension_perfmormers_id, ' .
					PREFIX . '_accident_regression_culprits.claim, ' . PREFIX . '_accident_regression_culprits.claim_date, ' . PREFIX . '_accident_regression_culprits.claim_number, ' . PREFIX . '_accident_regression_culprits.claim_amount, ' .
					PREFIX . '_accident_regression_culprits.claim_comment, ' . PREFIX . '_accident_regression_culprits.claim_perfmormers_id, ' .
					PREFIX . '_accident_regression_culprits.regressions_id, ' . PREFIX . '_accident_regression_culprits.id as id ' .
			   'FROM ' . PREFIX . '_accident_regressions ' .
			   'JOIN ' . PREFIX . '_accident_regression_culprits ON ' . PREFIX . '_accident_regressions.id = ' . PREFIX . '_accident_regression_culprits.regressions_id ' .
			   'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_regressions.accidents_id = ' . PREFIX . '_accidents.id ' .
			   'WHERE ' . PREFIX . '_accident_regression_culprits.id = ' . intval($data['id']);
		$data = $db->getRow($sql);
		
		$data = $this->prepareFields($action, $data);
		
		if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
	}
	
	function update($data, $redirect=true, $showForm=true) {
		global $db, $Log;
		
		$this->checkPermissions('insert', $data);
		
		$data = $this->replaceSpecialChars($data, 'insert');
		
		$this->setConstants($data);
		
		$this->checkFields($data, 'insert');
		
		if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'update');

        } else {
		
			$sql = 'UPDATE ' . PREFIX . '_accident_regressions ' .
				   'SET date = ' . $db->quote($data['date']) . ', ' .
						'comment = ' . $db->quote($data['comment']) . ' ' .
				   'WHERE id = ' . intval($data['regressions_id']);
			$db->query($sql);
		
			$sql = 'UPDATE ' . PREFIX . '_accident_regression_culprits ' .
				   'SET person_types_id = ' . intval($data['person_types_id']) . ', ' .
						'insurance_companies_id = ' . intval($data['insurance_companies_id']) . ', ' .
						'title = ' . $db->quote($data['title']) . ', ' .
						'pretension = ' . intval($data['pretension']) . ', ' .
						'pretension_date = ' . $db->quote($data['pretension_date']) . ', ' .
						'pretension_number = ' . $db->quote($data['pretension_number']) . ', ' .
						'pretension_amount = ' . $db->quote($data['pretension_amount']) . ', ' .
						'pretension_comment = ' . $db->quote($data['pretension_comment']) . ', ' .
						'pretension_perfmormers_id = ' . intval($data['pretension_perfmormers_id']) . ', ' .
						'claim = ' . intval($data['claim']) . ', ' .
						'claim_date = ' . $db->quote($data['claim_date']) . ', ' .
						'claim_number = ' . $db->quote($data['claim_number']) . ', ' .
						'claim_amount = ' . $db->quote($data['claim_amount']) . ', ' .
						'claim_comment = ' . $db->quote($data['claim_comment']) . ', ' .
						'claim_perfmormers_id = ' . intval($data['claim_perfmormers_id']) . ', ' .
						'modified = NOW() ' . 
					'WHERE id = ' . intval($data['id']);
			$db->query($sql);
			
			$params['title']    = $this->messages['single'];
			$params['id']       = mysql_insert_id();
			$params['storage']  = $this->tables[0];
	
			if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            }
		
		}
	}
	
	function view($data, $showForm=true, $action='view', $actionType='view', $template='form.php') {
		global $db;
		
		$this->checkPermissions('update', $data);
		
		if (is_array($data['id'])) {
       		$data['id'] = $data['id'][0];
       	}
		
		$sql = 'SELECT ' . PREFIX . '_accident_regressions.accidents_id, ' . PREFIX . '_accidents.number as accidents_number, ' . PREFIX . '_accident_regressions.date, ' . PREFIX . '_accident_regressions.comment, ' . 
					PREFIX . '_accident_regression_culprits.person_types_id, ' . PREFIX . '_accident_regression_culprits.insurance_companies_id, ' . PREFIX . '_accident_regression_culprits.title, ' .
					PREFIX . '_accident_regression_culprits.pretension, ' . PREFIX . '_accident_regression_culprits.pretension_date, ' . PREFIX . '_accident_regression_culprits.pretension_number, ' . PREFIX . '_accident_regression_culprits.pretension_amount, ' .
					PREFIX . '_accident_regression_culprits.pretension_comment, ' . PREFIX . '_accident_regression_culprits.pretension_perfmormers_id, ' .
					PREFIX . '_accident_regression_culprits.claim, ' . PREFIX . '_accident_regression_culprits.claim_date, ' . PREFIX . '_accident_regression_culprits.claim_number, ' . PREFIX . '_accident_regression_culprits.claim_amount, ' .
					PREFIX . '_accident_regression_culprits.claim_comment, ' . PREFIX . '_accident_regression_culprits.claim_perfmormers_id, ' .
					PREFIX . '_accident_regression_culprits.regressions_id, ' . PREFIX . '_accident_regression_culprits.id as id ' .
			   'FROM ' . PREFIX . '_accident_regressions ' .
			   'JOIN ' . PREFIX . '_accident_regression_culprits ON ' . PREFIX . '_accident_regressions.id = ' . PREFIX . '_accident_regression_culprits.regressions_id ' .
			   'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_regressions.accidents_id = ' . PREFIX . '_accidents.id ' .
			   'WHERE ' . PREFIX . '_accident_regression_culprits.id = ' . intval($data['id']);
		$data = $db->getRow($sql);
		
		$data = $this->prepareFields($action, $data);
		
		if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
	}
	
	function prepareFields($action, $data) {
		$data['date_day'] = date('d', strtotime($data['date']));
		$data['date_month'] = date('m', strtotime($data['date']));
		$data['date_year'] = date('Y', strtotime($data['date']));
		$data['date'] = date('d.m.Y', strtotime($data['date']));
		
		if (intval($data['pretension'])) {
			$data['pretension_date_day'] = date('d', strtotime($data['pretension_date']));
			$data['pretension_date_month'] = date('m', strtotime($data['pretension_date']));
			$data['pretension_date_year'] = date('Y', strtotime($data['pretension_date']));
			$data['pretension_date'] = date('d.m.Y', strtotime($data['pretension_date']));
		}
		
		if (intval($data['claim'])) {
			$data['claim_date_day'] = date('d', strtotime($data['claim_date']));
			$data['claim_date_month'] = date('m', strtotime($data['claim_date']));
			$data['claim_date_year'] = date('Y', strtotime($data['claim_date']));
			$data['claim_date'] = date('d.m.Y', strtotime($data['claim_date']));
		}
		
		return $data;
	}
	
	function setConstants(&$data) {		
		global $db;
		
		$data['date'] = $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'];
		
		if ($data['person_types_id'] == 1) {
			$data['insurance_companies_id'] = 0;
		}
		
		if (intval($data['insurance_companies_id'])) {
			$sql = 'SELECT title ' .
				   'FROM ' . PREFIX . '_companies_mtsbu ' .
				   'WHERE id = ' . intval($data['insurance_companies_id']);
			$data['title'] = $db->getOne($sql);
		}
		
		if (intval($data['pretension'])) {
			$data['pretension_date'] = $data['pretension_date_year'] . '-' . $data['pretension_date_month'] . '-' . $data['pretension_date_day'];
			$data['pretension_amount'] = str_replace(',', '.', $data['pretension_amount']);
		} else {
			$data['pretension_date'] = '';
			$data['pretension_number'] = '';
			$data['pretension_amount'] = '';
			$data['pretension_comment'] = '';
			$data['pretension_perfmormers_id'] = 0;
		}
		
		if (intval($data['claim'])) {
			$data['claim_date'] = $data['claim_date_year'] . '-' . $data['claim_date_month'] . '-' . $data['claim_date_day'];
			$data['claim_amount'] = str_replace(',', '.', $data['claim_amount']);
		} else {
			$data['claim_date'] = '';
			$data['claim_number'] = '';
			$data['claim_amount'] = '';
			$data['claim_comment'] = '';
			$data['claim_perfmormers_id'] = 0;
		}
		
	}
	
	function checkFields($data, $action) {
		global $Log;
		
		if (!intval($data['accidents_id'])) {
			$Log->add('error', 'Справа обов\'язкова для вибору.');
		}
		
		if (!checkdate($data['date_month'], $data['date_day'], intval($data['date_year']))) {
				$Log->add('error', 'Не вірно вказано дату отримання справи в роботу.');
		}
		
		if (!intval($data['person_types_id'])) {
			$Log->add('error', 'Не вказано тип особи.');
		}
		
		if (!strlen($data['title'])) {
			$Log->add('error', 'Не вказано іншу сторону.');
		}
		
		if (intval($data['pretension'])) {
			if (!checkdate($data['pretension_date_month'], $data['pretension_date_day'], intval($data['pretension_date_year']))) {
				$Log->add('error', 'Не вірно вказано дату претензії.');
			}
			
			if (!strlen($data['pretension_number'])) {
				$Log->add('error', 'Не вказано номер претензії.');
			}
			
			if ($data['pretension_amount'] <= 0) {
				$Log->add('error', 'Невірна сума претензії.');
			}
			
			if (!intval($data['pretension_perfmormers_id'])) {
				$Log->add('error', 'Не вказано виконавця претензії.');
			}
		}
		
		if (intval($data['claim'])) {
			if (!checkdate($data['claim_date_month'], $data['claim_date_day'], intval($data['claim_date_year']))) {
				$Log->add('error', 'Не вірно вказано дату позову.');
			}
			
			if (!strlen($data['claim_number'])) {
				$Log->add('error', 'Не вказано номер позову.');
			}
			
			if ($data['claim_amount'] <= 0) {
				$Log->add('error', 'Невірна сума позову.');
			}
			
			if (!intval($data['claim_perfmormers_id'])) {
				$Log->add('error', 'Не вказано виконавця позову.');
			}
		}
	}
	
	function getAccidentRegressionByAccidentsId($accidents_id) {
		global $db;
		
		$sql = 'SELECT id ' .
			   'FROM ' . PREFIX . '_accident_regressions ' .
			   'WHERE accidents_id = ' . intval($accidents_id);
		$id = $db->getOne($sql);
		
		return $id;
	}
	
	/*function getAccidentRegressionByAccidentRegressionCulpritsId($accident_regression_culprits_id) {
		global $db;
		
		$sql = 'SELECT ' . PREFIX . '_accident_regressions.id ' .
			   'FROM ' . PREFIX . '_accident_regressions ' .
			   'JOIN ' . PREFIX . '_accident_regression_culprits ON ' . PREFIX . '_accident_regressions.id = 
	}*/
		
	function findAccidentInWindow($data) {
		global $db;
		
		$sql = 'SELECT id ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE number = ' . $db->quote($data['accidents_number']);
		$id = intval($db->getOne($sql));
		
		echo json_encode($id);
	}
	
	function exportInWindow($data) {
		$this->checkPermissions('export', $data);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

		$data['export'] = 1;
		
        $this->show($data, null, null, null, 'excel.php', false);
        exit;
	}
}

?>