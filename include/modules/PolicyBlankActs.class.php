<?
/*
 * Title: PolicyBlanks class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Agencies.class.php';
require_once 'PolicyBlanks.class.php';
require_once 'PolicyBlankActItems.class.php';

class PolicyBlankActs extends Form {

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
							'table'				=> 'policy_blank_acts'),
						array(
							'name'				=> 'agencies_id',
							'description'		=> 'Агенція',
					        'type'				=> fldSelect,
                            'condition'         => 'parent_id = 0',
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
							'table'				=> 'policy_blank_acts',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=> true
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'policy_blank_acts'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата',
					        'type'				=> fldHidden,
					        'input'				=> true,
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
							'orderPosition'		=> 3,
							'table'				=> 'policy_blank_acts'),
						array(
							'name'				=> 'types_id',
							'description'		=> 'Тип',
					        'type'				=> fldHidden,
							'list'				=> array(
													1 => 'Видача',
													2 => 'Списання',
													3 => 'Переміщення'),
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
							'table'				=> 'policy_blank_acts'),
						array(
							'name'				=> 'act_statuses_id',
							'description'		=> 'Статус',
					        'type'				=> fldHidden,
					        'list'				=> array(
													1	=> 'Створено',
													2	=> 'Передано'),
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
							'orderPosition'		=> 5,
							'table'				=> 'policy_blank_acts'),
						array(
							'name'				=> 'posted_number',
							'description'		=> 'Видано, шт.',
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
							'orderPosition'		=> 6,
							'table'				=> 'policy_blank_acts'),
						array(
							'name'				=> 'received_number',
							'description'		=> 'Вітзвітовано, шт.',
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
							'orderPosition'		=> 7,
							'table'				=> 'policy_blank_acts'),
                        array(
                            'name'              => 'file',
                            'description'       => 'Акт',
                            'type'              => fldFile,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 8,
                            'table'             => 'policy_blank_acts'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
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
							'table'				=> 'policy_blank_acts'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 9,
                            'width'             => 100,
                            'table'             => 'policy_blank_acts'),
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 9,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'number'
					)
			);

	function PolicyBlankActs($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Акти пройому/передачі бланкiв суворої звітності';
		$this->messages['single'] = 'Акт пройому/передачі бланкiв суворої звітності';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		            => true,
					'insert'	            => true,
                    'insertVidacha'         => true,
                    'insertSpisanie'        => true,
                    'insertPeremeschenie'   => true,
					'update'                => true,
					'changeStatus'          => true,
					'view'		            => true,
					'change'	            => false,
					'export'	            => true,
					'delete'	            => true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_AGENT:
				$this->permissions = array(
					'show'		            => true,
					'insert'	            => false,
                    'insertSpisanie'        => true,
					'update'                => true,
					'view'		            => true,
					'change'	            => false);
				break;
		}
	}

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Log, $Authorization;

        switch ($action) {
            case 'update':
                $id = (is_array($data['id'])) ? $data['id'][ 0 ] : $data['id'];

                $sql =  'SELECT agencies_id, types_id, act_statuses_id ' .
                        'FROM ' . $this->tables[ 0 ] . ' ' .
                        'WHERE id = ' . intval($id);
                $row =  $db->getRow($sql);

                if ($row['types_id'] == 1) {
                    $Log->add('error', 'Коррегувати дозволяється акти <b>Видачі</b>.');

                    $result = parent::checkPermissions($action, $data, true);
                } elseif ($row['act_statuses_id'] != 1) {
                    $Log->add('error', 'Коррегувати дозволяється акти в статусі <b>Створено</b>.');

                    $result = parent::checkPermissions($action, $data, true);
                } elseif ($row['agencies_id'] != $Authorization->data['agencies_id']) {
                    $Log->add('error', 'Коррегувати дозволяється тільки акти своєї агенції.');

                    $result = parent::checkPermissions($action, $data, true);
                }
                break;
        }

        return $result;
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db, $Authorization;

		$this->checkPermissions('show', $data);

        $this->formDescription['fields'][ $this->getFieldPositionByName('number') ]['type'] = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('date') ]['type'] = fldDate;
        $this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ]['type'] = fldRadio;
        $this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['type'] = fldRadio;

		if (intval($data['agencies_id'])) {
			$Agencies = new Agencies($data);
			$agencies_id = array($data['agencies_id']);
			$Agencies->getSubId(&$agencies_id, $data['agencies_id']);

			$fields[] = 'agencies_id';
			$conditions[] = $this->tables[0] . '.agencies_id IN(' . implode(', ', $agencies_id) . ')';
		}

        if ($data['number'] != '') {
			$fields[] = 'number';
			$conditions[] = $this->tables[0] . '.number like '.$db->quote($data['number']);
		}

        $conditions1[] = '1';

        if (intval($data['types_id'])) {
			$fields[] = 'types_id';
			$conditions1[] = $this->tables[0] . '.types_id = ' . intval($data['types_id']);
		}

        if (intval($data['act_statuses_id'])) {
			$fields[] = 'act_statuses_id';
			$conditions1[] = $this->tables[0] . '.act_statuses_id = ' . intval($data['act_statuses_id']);
		}

        if ($data['from']) {
            $fields[] = 'from';
            $conditions1[] = 'TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ') <= TO_DAYS(' . PREFIX . '_policy_blank_acts.date)';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions1[] = 'TO_DAYS(' . PREFIX . '_policy_blank_acts.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if (intval($data['policy_blanks_id'])) {
            $fields[] = 'policy_blanks_id';
            $conditions[] = PREFIX . '_policy_blank_act_items.policy_blanks_id = ' . intval($data['policy_blanks_id']);
        }

        $hidden['do'] = $data['do'];

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $conditions[] = PREFIX . '_agencies.parent_id = 0';

        $sql =  'SELECT ' . PREFIX . '_agencies.title AS agencies_id, ' .
                PREFIX . '_policy_blank_acts.number, date_format(' . PREFIX . '_policy_blank_acts.date, ' . $db->quote(DATE_FORMAT) . ') AS date_format, ' .
                'COUNT(' . PREFIX . '_policy_blank_act_items.policy_blanks_id) AS posted_number, ' .
                'SUM(' . PREFIX . '_policies.documents) AS received_number, ' .
				PREFIX . '_policy_blank_acts.id, ' . PREFIX . '_policy_blank_acts.types_id, ' . PREFIX . '_policy_blank_acts.act_statuses_id, file, date_format(' . PREFIX . '_policy_blank_acts.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified_format ' .
                'FROM ' . PREFIX . '_agencies ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_acts ON ' . PREFIX . '_agencies.id = ' . PREFIX . '_policy_blank_acts.agencies_id AND ' . implode(' AND ', $conditions1) . ' ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_act_items ON ' . PREFIX . '_policy_blank_acts.id = ' . PREFIX . '_policy_blank_act_items.acts_id ' .
                'LEFT JOIN ' . PREFIX . '_policy_blanks ON ' . PREFIX . '_policy_blank_act_items.policy_blanks_id = ' . PREFIX . '_policy_blanks.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_policy_blanks.series = ' . PREFIX . '_policies_go.blank_series AND ' . PREFIX . '_policy_blanks.number = ' . PREFIX . '_policies_go.blank_number ' .
                'LEFT JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policies_go.policies_id = ' . PREFIX . '_policies.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'GROUP BY ' . PREFIX . '_agencies.id, ' . PREFIX . '_policy_blank_acts.id ' .
                'ORDER BY ';

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
//_dump($sql);

		$sql = str_replace( 'insurance_policy_blank_acts.received_number' , 'received_number' , $sql );
		$sql = str_replace( 'insurance_policy_blank_acts.posted_number' , 'posted_number' , $sql );
		
        $list = $db->getAll($sql);

        $sql =  'SELECT DISTINCT insurance_agencies.id, insurance_policy_blank_acts.id ' .
                'FROM ' . PREFIX . '_agencies ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_acts ON ' . PREFIX . '_agencies.id = ' . PREFIX . '_policy_blank_acts.agencies_id AND ' . implode(' AND ', $conditions1) . ' ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_act_items ON ' . PREFIX . '_policy_blank_acts.id = ' . PREFIX . '_policy_blank_act_items.acts_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $total = sizeOf( $db->getAll($sql) );

        $this->changePermissions($total);

		$sql =	'SELECT id, code, title, level ' .
				'FROM ' . PREFIX . '_agencies ' .
				'ORDER BY top, num_l';
        $data['agencies'] = $db->getAll($sql, 60 * 60);

		include $this->object . '/' . $template;
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $data['agencies_id'] = $Authorization->data['agencies_id'];
                $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]['type'] = fldHidden;

                $data['act_statuses_id'] = 1;
                $this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['type'] = fldHidden;
                break;
        }

        return parent::showForm($data, $action, $actionType, $template);
    }

    function addVidacha($data) {

        $this->checkPermissions('insertVidacha', $data);

        $this->permissions['insert'] = true;

        $data['types_id'] = 1;
        $this->add($data);
    }

    function addSpisanie($data) {
        global $Authorization;

        $this->checkPermissions('insertSpisanie', $data);

        $this->permissions['insert'] = true;

        $data['types_id'] = 2;
        $data['agencies_id'] = (intval($Authorization->data['agencies_id'])) ? $Authorization->data['agencies_id'] : 1;

        $this->add($data);
    }

    function addPeremeschenie($data) {
        global $Authorization;

        $this->checkPermissions('insertPeremeschenie', $data);

        $this->permissions['insert'] = true;

        $data['types_id'] = 3;
        $data['agencies_id'] = (intval($Authorization->data['agencies_id'])) ? $Authorization->data['agencies_id'] : 1;

        $this->add($data);
    }

    function setConstants(&$data) {
        global $db;

        if (!intval($data['id'])) {
            $data['date'] = date('Ymd');

            $data['date_year']  = date('Y');
            $data['date_month'] = date('m');
            $data['date_day']   = date('d');

            $data['act_statuses_id'] = 1;
        }

        parent::setConstants($data);

        $sql =  'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_agencies ' .
                'WHERE id = ' . intval($data['agencies_id']);
        $agreement_number = $db->getOne($sql);

        $data['number'] = $agreement_number . '.' . PRODUCT_TYPES_GO . '.' . substr($data['date_year'], 2, 2) . $data['date_month'] . $data['date_day'] . '/' . $data['types_id'];
    }

    function checkFields(&$data, $action) {
        global $db, $Log;

        parent::checkFields($data, $action);

        $sql =  'SELECT COUNT(*) ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE number = ' . $db->quote($data['number']) . ' AND id <> ' . intval($data['id']);
        $count = $db->getOne($sql);

        if ($count > 0) {
            $Log->add('error', 'Акт з номером <b>%s</b> вже існує.', array($data['number']));
        }

        PolicyBlankActItems::checkFields($data);
    }

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $sql =  'SELECT date_format(date, \'%d\') AS date_day, date_format(date, \'%m\') AS date_month, date_format(date, \'%Y\') AS date_year ' .
                'FROM ' . $this->tables[ 0 ] . ' ' .
                'WHERE id = ' . intval($data['id']);
        $row =  $db->getRow($sql);

        $data = array_merge($data, $row);

        $data['policy_blanks'] = PolicyBlankActItems::getPolicyBlanksIdByActsId($data['id']);

        return $data;
    }

    function insert($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'insert');

        $data['id'] = parent::insert($data, false);

        if (intval($data['id'])) {

            PolicyBlankActItems::setValues($data);

            $params['title']	= $this->messages['single'];
            $params['id']       = $data['products_id'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: index.php?do=PolicyBlanks|show');
				exit;
            } else {
                return $params['id'];
            }
        }
    }

    function update($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'update');

        $data['id'] = parent::update($data, false);

        if (intval($data['id'])) {

			PolicyBlankActItems::setValues($data);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['products_id'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: index.php?do=PolicyBlanks|show');
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function loadStatus($data) {
        global $db, $Log;

        $this->checkPermissions('changeStatus', $data);

        if (is_array($data['id'])) {
            $sql =  'SELECT DISTINCT act_statuses_id ' .
                    'FROM ' . PREFIX . '_policy_blank_acts ' .
                    'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $statuses = $db->getAll($sql);

            switch (sizeOf($statuses)) {
                case 0:

                    $Log->add('error', 'Не вибрали жодного акту.');

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                    break;
                case 1:
                    break;
                default:
                    $Log->add('error', 'Змінювати стутус актів одночасно можливо лише у тому випадку, якщо їх поточний статус однаковий.');

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
            }

        } else {
            $data['id'] = array($data['acts_id']);
        }

        $sql =	'SELECT  act_statuses_id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE id = ' . intval($data['id'][ 0 ]);
        $row =  $db->getRow($sql);

        $data = array_merge($data, $row);

        $this->showForm($data, 'updateStatus', 'changeStatus', 'changeStatus.php');
    }

    function updateStatus($data) {
        global $db, $Log;

        $data['id'] = unserialize(htmlspecialchars_decode($data['id']));

        $this->checkPermissions('changeStatus', $data);

        if (!intval($data['act_statuses_id'])) {
            $params = array(translate($this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['description']), '');
            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);

            $this->loadStatus($data);
        } else {

            $fields[] = 'act_statuses_id = ' . intval($data['act_statuses_id']);
            $fields[] = 'modified = NOW()';

            $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                    implode(', ', $fields) . ' ' .
                    'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $db->query($sql);
			if ($data['act_statuses_id']==2 && is_array($data['id']))  //Передано
			{
				foreach($data['id'] as $i)
				{
					$types_id = $db->getOne('SELECT types_id FROM insurance_policy_blank_acts WHERE id='.intval($i));
					if ($types_id!=2) continue;
					$items = $db->getAll('SELECT a.policy_blanks_id,a.blank_statuses_id,b.number,b.series,b.agencies_id FROM insurance_policy_blank_act_items a JOIN insurance_policy_blanks b ON b.id=a.policy_blanks_id WHERE  acts_id='.intval($i));
					if (is_array($items))
					{
						foreach($items as $item) {
							if ($item['blank_statuses_id']==1 && intval($item['agencies_id'])>0) //чистый проверить если нету в закладкее в работе то вытереть агенцию идет как возврат на склад
							{
								$policies_id = intval($db->getOne('SELECT policies_id FROM insurance_policies_go  WHERE blank_series='.$db->quote($item['series']).' AND blank_number='.$db->quote($item['number']) .' '));
								if ($policies_id==0) //нету полиса в закладке в работе значит возращаем на склад его
								{
									$db->query('UPDATE insurance_policy_blanks SET agencies_id=0 WHERE id='.intval($item['policy_blanks_id']));
								}
								
							}
						}
					}
				}
			}

            $Log->add('confirm', 'Статус акту(iв) був успішно змінений.', null, null, true);

            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
            exit;
        }
    }

    function delete($data, $redirect=true, $generateMessage=true, $folder=null) {
        global $db, $Log;

        if (sizeOf($data['id']) != 1) {
            $Log->add('error', 'Вилучати акти можливо тільки по одному.', array());
        } else {

            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_policy_blank_acts ' .
                    'WHERE id = ' . intval($data['id'][ 0 ]);
            $act =  $db->getRow($sql);

            if ($act['act_statuses_id'] != 1) {
                $Log->add('error', 'Вилучати акти можливо тільки в статусі <b>Створено</b>.', array());
            } else {

                //проверяем на вхождение бланка в другие акты, более поздние
                $sql =  'SELECT a.number as act_number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') AS date_format, c.series, c.number ' .
                        'FROM ' . PREFIX . '_policy_blank_acts AS a ' .
                        'JOIN ' . PREFIX . '_policy_blank_act_items AS b ON a.id = b.acts_id ' .
                        'JOIN ' . PREFIX . '_policy_blanks AS c ON b.policy_blanks_id = c.id ' .
                        'WHERE TO_DAYS(a.date) > TO_DAYS(' . $db->quote($act['date']) . ') AND b.policy_blanks_id IN(SELECT policy_blanks_id FROM ' . PREFIX . '_policy_blank_act_items WHERE acts_id = ' . intval($act['id']) . ')';
                $list = $db->getAll($sql);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $Log->add('error', 'Бланк <b>' . $row['series'] . ' ' . $row['number'] . '</b> включено до акту <b>' . $row['act_number'] . ' від ' . $row['act_date'] . '</b> .', array());
                    }
                }
            }
        }

        if ($Log->isPresent()) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
            exit;
        } else {
            return parent::delete($data, $redirect, $generateMessage, $folder);
        }
    }

	function exportInWindow($data) {
        $this->checkPermissions('export', $data);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'excel.php', false);
        exit;
    }

    function downloadFileInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('view', $data);

        $data = unserialize($data['file']);

        $sql =  'SELECT *, a.id, DATE_FORMAT(date,\'%y%m%d\') AS date_format ' .
                'FROM ' . PREFIX . '_policy_blank_acts AS a ' .
                'JOIN ' . PREFIX . '_agencies AS b ON a.agencies_id = b.id ' .
                'WHERE a.id = ' . intval($data['id']);
        $values = $db->getRow($sql);

        if (intval($values['director_fop_id'])) {
            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_accounts AS a ' .
                    'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
                    'WHERE a.id = ' . intval($values['director_fop_id']);
            $agent = $db->getRow($sql);

            //затирает типом агента
            unset($agent['types_id']);

            $values = array_merge($values, $agent);
        }

/*
        $sql =  'SELECT series, number, IF(' . $values['types_id'] . ' != 1, c.title, 1) AS blank_statuses_id, IF(' . $values['types_id'] . ' != 1, c.title, \'чистий\') AS blank_statuses_title ' .
                'FROM ' . PREFIX . '_policy_blank_act_items AS a ' .
			    'JOIN ' . PREFIX . '_policy_blanks AS b ON a.policy_blanks_id = b.id ' .
			    'JOIN ' . PREFIX . '_policy_blank_statuses AS c ON b.blank_statuses_id = c.id ' .
                'WHERE acts_id = ' . intval($data['id']) . ' ' .
                'ORDER BY number';
        $list = $db->getAll($sql);
*/

        $sql =  'SELECT b.series, b.number, a.blank_statuses_id, c.title AS blank_statuses_title ' .
                'FROM ' . PREFIX . '_policy_blank_act_items AS a ' .
			    'JOIN ' . PREFIX . '_policy_blanks AS b ON a.policy_blanks_id = b.id ' .
			    'JOIN ' . PREFIX . '_policy_blank_statuses AS c ON a.blank_statuses_id = c.id ' .
                'WHERE acts_id = ' . intval($data['id']) . ' ' .
                'ORDER BY number';
        $list = $db->getAll($sql);

		$list = PolicyBlankActItems::convert($list);
		
		
		 $sql =  'SELECT b.series, b.number, b.blank_statuses_id, c.title AS blank_statuses_title ' .
			    'FROM ' . PREFIX . '_policy_blanks AS b ' .
			    'JOIN ' . PREFIX . '_policy_blank_statuses AS c ON b.blank_statuses_id = c.id ' .
                'WHERE b.agencies_id='.$values['agencies_id'].' AND insurance_companies_id=4 AND product_types_id=4 AND  b.id NOT IN (SELECT policy_blanks_id FROM insurance_policy_blank_act_items aa JOIN insurance_policy_blank_acts bb ON aa.acts_id=bb.id WHERE bb.types_id<>1 AND bb.agencies_id='.$values['agencies_id'].') ' .
                'ORDER BY b.number';
        $invent_list = $db->getAll($sql);
		$invent_list = PolicyBlankActItems::convert($invent_list);

        $file['name']	= $values['id'] . '_' . $values['date_format'];

		$Smarty->assign('data', $data);
        $Smarty->assign('list', $list);
		$Smarty->assign('invent_list', $invent_list);
		$Smarty->assign('values', $values);

        $file['content'] = $Smarty->fetch($this->object . '/act.tpl');
//echo $file['content'];exit;
        html2pdf($file);
        exit;
     }

 	//Export 1C 7.7
    function getXML($data) {
        global $db, $Smarty;

        if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote($data['number']);
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date) >= TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date) >= TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date) <= TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date) <= TO_DAYS(NOW())';
        }

        $conditions[] = 'a.types_id=' . intval($data['types_id']);

        $conditions[] = 'a.act_statuses_id = 2';

        $sql = 'SELECT a.*, b.title, b.edrpou ' .
               'FROM ' . PREFIX . '_policy_blank_acts AS a ' .
               'JOIN ' . PREFIX . '_agencies AS b ON a.agencies_id = b.id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        if (is_array($list)) {
            foreach($list as $i => $row) {
//				$list[ $i ]['number'].='/3';
				$conditions1=array();
//				$conditions1[]='(b.blank_statuses_id=1)';
$conditions1[]='1';
//				$conditions1[]='b.id not in(166482)';
                $sql =  'SELECT b.*,b.number as number_from,b.number as number_to,b.blank_statuses_id,1 as count ' .
//$sql =  'SELECT b.*,b.number as number_from,b.number as number_to,2 as blank_statuses_id,1 as count ' .
                        'FROM ' . PREFIX . '_policy_blank_act_items a JOIN ' . PREFIX . '_policy_blanks b ON b.id=a.policy_blanks_id ' .
                        'WHERE acts_id = ' . intval($row['id']).' AND '  . implode(' AND ', $conditions1);;
                $list[ $i ]['blanks'] =  $db->getAll($sql) ;
            }
        }

        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/xml.tpl');
    }
}

?>