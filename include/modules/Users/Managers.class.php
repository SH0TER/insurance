<?
/*
 * Title: manager class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Policies.class.php';

class Managers extends Users {

    var $roles_id = ROLES_MANAGER;

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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'login',
							'description'		=> 'Логін',
					        'type'				=> fldLogin,
					        'maxlength'			=> 15,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'accounts'),
						array(
							'name'					=> 'password',
							'description'			=> 'Пароль',
							'additionalDescription'	=> 'Ще раз',
					        'type'					=> fldPassword,
					        'maxlength'			=> 10,
							'display'				=> 
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'lastname',
							'description'		=> 'Прізвище',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'firstname',
							'description'		=> 'Ім\'я',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'patronymicname',
							'description'		=> 'По батькові',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'orderPosition'		=> 3,
							'table'				=> 'accounts'),
						array(
							'name'				=> 'phone',
							'description'		=> 'Телефон',
					        'type'				=> fldText,
					        'validationRule'	=> '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
					        'maxlength'			=> 15,
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
							'orderPosition'		=> 4,
							'table'				=> 'accounts'),
						array(
							'name'				=> 'fax',
							'description'		=> 'Факс',
					        'type'				=> fldText,
					        'validationRule'	=> '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
					        'maxlength'			=> 15,
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'mobile',
							'description'		=> 'Мобільний',
					        'type'				=> fldText,
					        'validationRule'	=> '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
					        'maxlength'			=> 15,
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
							'orderPosition'		=> 5,
							'table'				=> 'accounts'),
						array(
							'name'				=> 'email',
							'description'		=> 'E-mail',
					        'type'				=> fldEmail,
					        'maxlength'			=> 50,
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'screen_resolutions_id',
							'description'		=> 'Роздільча здатність',
					        'type'				=> fldSelect,
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
							'table'				=> 'accounts',
							'sourceTable'		=> 'screen_resolutions',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'records_per_page',
							'description'		=> 'Записів на сторінку',
					        'type'				=> fldInteger,
							'validationRule'	=> '^([0-9]{1,3})$',
					        'maxlength'			=> 2,
					        'width'				=> 30,
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'roles_id',
							'description'		=> 'Роль',
					        'type'				=> fldConst,
							'value'				=> ROLES_MANAGER,
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
							'table'				=> 'accounts'),
						array(
							'name'				=> 'account_groups_id',
							'description'		=> 'Посада',
					        'type'				=> fldMultipleSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 7,
							'table'				=> 'account_groups_managers_assignments',
							'sourceTable'		=> 'account_groups',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
                        array(
							'name'				=> 'car_services_id',
							'description'		=> 'Список СТО',
					        'type'				=> fldMultipleSelect,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 7,
							'table'				=> 'car_services_service_department_assignments',
							'sourceTable'		=> 'car_services',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'managers_id',
							'description'		=> 'Менеджери',
					        'type'				=> fldMultipleSelect,
							'condition'			=> 'roles_id = 2',
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'manager_manager_assignments',
							'sourceTable'		=> 'accounts',
							'selectField'		=> 'CONCAT(lastname, \' \', firstname)',
							'orderField'		=> 'CONCAT(lastname, \' \', firstname)'),
						array(
							'name'				=> 'active',
							'description'		=> 'Активний',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 8,
							'width'				=> 100,
							'table'				=> 'accounts'),
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
							'orderPosition'		=> 9,
                            'width'             => 100,
							'table'				=> 'accounts'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
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
							'table'				=> 'accounts')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'login'
					)
			);

    function Managers($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Менеджери';
        $this->messages['single'] = 'Менеджер';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'						=> true,
                    'insert'					=> true,
                    'update'					=> true,
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true,
                    'view'						=> false,
                    'change'					=> true,
                    'delete'					=> true,
                    'export'					=> true);
                break;
        }
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='Managers/show.php') {
		global $db;

		$conditions[] = 'roles_id = ' . $this->roles_id;
		if($data['lastname']){
			$conditions[] = 'lastname LIKE ' . $db->quote('%' . $data['lastname'] . '%');
		}
		
		if (is_array($data['active_state']) && sizeof($data['active_state'])) {
			$conditions[] = 'active IN(' . implode(', ', $data['active_state']) . ')';
		} else {
			$data['active_state'][] = '1';
			$conditions[] = 'active IN(1)';
		}

		return  parent::show($data, $fields, $conditions, $sql, $template);
	}

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        if ($data['showMode'] != 27) {
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('car_services_id') ]);
        }

        return  parent::load($data, $showForm, $action, $actionType, $template);
    }

	/*function show($data, $fields=null, $conditions=null, $template='show.php') {

        $this->setTables('show');
        $this->setShowFields();

        $conditions[] = $this->tables[0] . '.id = ' . $this->tables[1] . '.accounts_id';
        $conditions[] = $this->tables[0] . '.account_groups_id = ' . $this->tables[2] . '.id';

		if (is_array($data['account_groups_id'])) {
			$conditions[] = 'account_groups_id IN(' . implode(', ', $data['account_groups_id']) . ')';
		}

        $sql =	'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
                'FROM ' . $this->tables[0] . ', ' . $this->tables[1] . ', ' . $this->tables[2] . ' '.
                'WHERE ' . implode(' AND ', $conditions);

		$fields['account_groups_id']				= $this->formDescription['fields'][ $this->getFieldPositionByName('account_groups_id') ];
		$fields['account_groups_id']['list']    	= $this->getListValue($fields['account_groups_id'], $data);
		$fields['account_groups_id']['object'] 	= $this->buildSelect($fields['account_groups_id'], $data['account_groups_id'], $data['languageCode'], 'multiple size="3"', null, $data);

        Form::show($data, $fields, $conditions, $sql, $this->object . '/' . $template);
    }*/

    function isLoginExists($field, $login, $id=null) {
        return parent::isLoginExists($field, $login, ROLES_MANAGER, $id);
    }

    function exportInWindow($data) {
        global $db, $Authorization, $Smarty;

        $this->checkPermissions('export', $data);

        if(!$this->checkPermissionsBooleanResult("export", "Managers"))
        	$Log->add('error', translate('You doesn\'t have enought permissions.') . ' ' . $this->object . '|' . $action);

        $sql =	'SELECT a.* ' .
                'FROM ' . PREFIX . '_accounts a where roles_id = 2 ' .
                'ORDER BY lastname, firstname';
        $list = $db->getAll($sql);

        $Smarty->assign('list', $list);

        $result = $Smarty->fetch($this->object . '/export.tpl');

        header('Content-Disposition: attachment; filename="managers.xls"');
        header('Content-Type: ' . $this->getContentType('managers.xls'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

    function showDesktop($i = 1) {
        global $data, $Authorization, $MENU;

        if ($Authorization->data['permissions']['Policies']['show']) {
            $data['do'] = 'Policies|show';
    		$data['product_types_id'] = PRODUCT_TYPES_KASKO;
		    $Policies = Policies::factory($data, 'KASKO');

		    $Policies->objectTitle = 'Policies_KASKO';
		    $Policies->show($data);
        } else {
            foreach ($MENU['main'] as $i => $row) {
                if ($Authorization->data['permissions'][$MENU['main'][$i]['class']]['show']) {
                    header('Location: index.php?do=' . $MENU['main'][$i]['class'] . '|show');
                    exit;
                }
            }
        }
/*
		if ($Authorization->data['permissions']['Policies_KASKO']['show']) {
			$data['product_types_id'] = PRODUCT_TYPES_KASKO;
			$Policies = Policies::factory($data, 'KASKO');

			$Policies->objectTitle = 'Policies_KASKO';
			$Policies->show($data);
		}

		if ($Authorization->data['permissions']['Policies_GO']['show']) {
			$data['product_types_id'] = PRODUCT_TYPES_GO;
			$Policies = Policies::factory($data, 'GO');

			$Policies->objectTitle = 'Policies_GO';
			$Policies->show($data);
		}

		if ($Authorization->data['permissions']['Policies_DGO']['show']) {
			$data['product_types_id'] = PRODUCT_TYPES_DGO;
			$Policies = Policies::factory($data, 'DGO');

			$Policies->objectTitle = 'Policies_DGO';
			$Policies->show($data);
		}

		if ($Authorization->data['permissions']['Policies_Property']['show']) {
			$data['product_types_id'] = PRODUCT_TYPES_PROPERTY;
			$Policies = Policies::factory($data, 'Property');

			$Policies->objectTitle = 'Policies_Property';
			$Policies->show($data);
		}

		if ($Authorization->data['permissions']['Policies_DSKV']['show']) {
			$data['product_types_id'] = PRODUCT_TYPES_DSKV;
			$Policies = Policies::factory($data, 'DSKV');

			$Policies->objectTitle = 'Policies_DSKV';
			$Policies->show($data);
		}
        if ($Authorization->data['permissions']['Policies_NS']['show']) {
			$data['product_types_id'] = PRODUCT_TYPES_NS;
		    $Policies = Policies::factory($data, 'NS');

		    $Policies->objectTitle = 'Policies_NS';
		    $Policies->show($data, $fields, $conditions, $sql);
		}
*/
        
        echo News::getRoll($data);
    }

    function showServiceDepartment($data, $fields=null, $template='Managers/show.php', $limit=true) {
        global $db, $Authorization;

        $this->messages['plural'] = 'Менеджери Департаменту сервісу';
        $this->messages['single'] = 'Менеджер Департаменту сервісу';

        $this->checkPermissions('show', $data);

		$this->mode = 'update';

        $hidden['do'] = $data['do'];
        $fields[] = 'showMode';
        $data['showMode'] = ACCOUNT_GROUPS_SERVICE_DEPARTMENT;

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $conditions[] = PREFIX . '_accounts.roles_id = ' . $this->roles_id;
        $conditions[] = PREFIX . '_account_groups_managers_assignments.account_groups_id = ' . ACCOUNT_GROUPS_SERVICE_DEPARTMENT;

        $sql = 'SELECT ' . PREFIX . '_accounts.id, ' . PREFIX . '_accounts.lastname, ' . PREFIX . '_accounts.firstname, ' . PREFIX . '_accounts.mobile, ' . PREFIX . '_accounts.email, ' .
                       PREFIX . '_accounts.active, date_format(' . PREFIX . '_accounts.created, \'%d.%m.%Y\') as created_format ' .
               'FROM ' . PREFIX . '_accounts ' .
               'JOIN ' . PREFIX . '_account_groups_managers_assignments ON ' . PREFIX . '_accounts.id = ' . PREFIX . '_account_groups_managers_assignments.accounts_id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'ORDER BY ';

        $total	= $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        include $template;
    }
	
	function getList($data) {
		global $db;
		
		$conditions[] = 'accounts.roles_id = ' . ROLES_MANAGER;
		
		if (is_array($data['account_groups_id']) && sizeof($data['account_groups_id'])) {
			$conditions[] = 'account_groups_managers_assignments.account_groups_id IN(' . implode(', ', $data['account_groups_id']) . ')';
		}
		
		$sql = 'SELECT accounts.id as accounts_id, CONCAT_WS(\' \', accounts.lastname, accounts.firstname) as accounts_name ' . 
			   'FROM ' . PREFIX . '_accounts as accounts ' .
			   'JOIN ' . PREFIX . '_account_groups_managers_assignments as account_groups_managers_assignments ON accounts.id = account_groups_managers_assignments.accounts_id ' .
			   'WHERE ' . implode(' AND ', $conditions) . ' ' .			   
			   'GROUP BY accounts.id ' .
			   'ORDER BY accounts.lastname, accounts.firstname ASC';
		return $db->getAll($sql);
	}
	
	function getName($data) {
		global $db;
		
		if(is_array($data['id'])) $data['id'] = $data['id'][0];
		
		if (intval($data['id']) < 1) {
			return null;
		}
		
		$conditions[] = 'id = ' . intval($data['id']);
		
		$sql = 'SELECT CONCAT_WS(\' \', lastname, firstname) ' . 
			   'FROM ' . PREFIX . '_accounts ' .
			   'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}

}

?>