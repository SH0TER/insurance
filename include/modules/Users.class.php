<?
/*
 * Title: base user's class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Form.class.php';

class Users extends Form {

    var $roles_id		= null;
    var $passwordLength	= 10;

    var $passwordFormDescription =
        array(
            'fields' =>
                array(
                    array(
                        'name'					=> 'id',
                        'type'					=> fldIdentity,
                        'verification'			=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'display'				=>
                            array(
                                'update'		=> true
                            ),
                        'table'					=> 'accounts'),
                    array(
                        'name'					=> 'password',
                        'description'			=> 'Пароль',
                        'additionalDescription'	=> 'Ще раз',
                        'type'					=> fldPassword,
                        'maxlength'				=> 10,
                        'display'				=>
                            array(
                                'update'		=> true
                            ),
                        'verification'			=>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'			=> 'accounts')
                )
        );

        var $passwordMessages =
            array(
                'load'      => 'Зміна паролю',
                'update'    =>
                    array(
                        'confirm'   =>	'Пароль було успішно змінено.',
                        'error'     =>  'Пароль не було змінено. Виникла помилка.')
            );

        var $screenResolutionsFormDescription =
            array(
                'fields' =>
                    array(
                        array(
                            'name'                  => 'id',
                            'type'                  => fldIdentity,
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'accounts'),
                        array(
                            'name'                  => 'screen_resolutions_id',
                            'description'           => 'Роздільча здатність',
                            'type'                  => fldSelect,
                            'display'               =>
                                array(
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false,
                                    'canByZero'     => false,
                                ),
                            'table'                 => 'accounts',
                            'sourceTable'           => 'screen_resolutions',
                            'selectField'           => 'title',
                            'orderField'            => 'id')
                    )
                );

		var $screenResolutionsMessages =
			array(
				'load'		=> 'Зміна роздільчої здатності',
				'update'    =>
					array(
						'confirm'	=>  'Роздільчу здатність було успішно змінено.',
						'error'		=>  'Роздільчу здатність не було змінено. Виникла помилка.')
			);

		var $recordsPerPageFormDescription =
			array(
				'fields' =>
					array(
						array(
							'name'					=> 'id',
							'type'					=> fldIdentity,
							'verification'			=>
								array(
									'canBeEmpty'	=> false
								),
							'table'					=> 'accounts'),
						array(
							'name'					=> 'records_per_page',
							'description'			=> 'Записів на сторінку',
							'type'					=> fldInteger,
							'validationRule'		=> '^([0-9]{1,3})$',
							'maxlength'				=> 2,
							'width'					=> 30,
							'display'				=>
								array(
									'update'		=> true
								),
							'verification'			=>
								array(
									'canBeEmpty'	=> false,
								),
							'table'					=> 'accounts')
					)
			);

                var $recordsPerPageMessages =
                    array(
                        'load'      =>  'Зміна кількості записів на сторінку',
                        'update'	=>
                            array(
                                'confirm'   =>  'Кількість записів на сторінку було успешно змінено.',
                                'error'     =>  'Кількість записів на сторінку не було змінено. Виникла помилка.')
                    );

    function Users($data) {
    }

    function factory($data, $type = 'Administrators') {
        require_once 'Users/' . $type . '.class.php';

        $class = $type;
        @$obj =& new $class($data);

        $obj->object		= $type;
        $obj->objectTitle	= $type;

        return $obj;
    }

    function getLoginField() {
        if (is_array($this->formDescription['fields'])) {
            foreach ($this->formDescription['fields'] as $field) {
                if ($field['type'] == fldLogin)
                    return PREFIX . '_' . $field['table'] . '.' . $field['name'];
            }
        }
    }

    function isLoginExists($field, $login, $roles_id, $id=null) {
        global $db;

        if ($id) {
            $conditions[] = 'id <> ' . intval($id);
        }

        $conditions[]	= $field['name'] . '=' . $db->quote($login);

        $sql =	'SELECT count(*) ' .
                'FROM ' . PREFIX . '_' . $field['table'] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $count = $db->getOne($sql);

        return ($count != 0) ? true : false;
    }

    function getIdByLogin($login) {
        global $db;
        return $db->getOne('SELECT id FROM ' . $this->tables[0] . ' WHERE login = ' . $db->quote($login));
    }

    function showDesktop($i = 1) {
        global $MENU, $Authorization;

        $panel = $Authorization->getMenu();

        if (!$panel) {
            $panel = 'main';
        }

        if (is_array($MENU[ $panel ])) {
            $y = 1;
            foreach ($MENU[ $panel ] as $item) {
                if (intval($item['permissions']) & intval($Authorization->data['roles_id'])) {
                    if ($i == $y) {
                        header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $item['class'] . '|show&menu=' . $panel . '&subMenu=' . $item['button']);
                        exit;
                    } else {
                        $y++;
                    }
                }
            }
        }

        $Authorization->logout();
    }

	function checkFields(&$data, $action) {
        global $Log, $Authorization,$db;

		if (strlen($data['password'])) {
			$pwd = $data['password'];

			if( strlen($pwd) < 6 ) {
				$error .= "Пароль слишком короткий, минимальная длинна 6 знаков! <br />";
			}

			if( strlen($pwd) > 10 ) {
				$error .= "Пароль слишком длинный, максимальная длинна 10 знаков! <br />";
			}


			if( !preg_match("#[0-9]+#", $pwd) ) {
				$error .= "Пароль должен содержать хотябы одну цифру! <br />";
			}


			if( !preg_match("#[a-z]+#", $pwd) ) {
				$error .= "Пароль должен содержать хотябы одну букву! <br />";
			}


			if( !preg_match("#[A-Z]+#", $pwd) ) {
				$error .= "Пароль должен содержать хотябы одну букву в верхнем регистре <br />";
			}


			if($error){
				$Log->add('error', 'Пароль слишком слабый: ' .$error );
			} 
		}
		parent::checkFields($data, $action);
	}
    /*	
    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php') {

        $this->setTables('show');
        $this->setShowFields();

        $conditions[] = $this->tables[0] . '.id = ' . $this->tables[1] . '.accounts_id';

        $sql =	'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
                'FROM ' . $this->tables[0] . ', ' . $this->tables[1] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);

        parent::show($data, $fields, $conditions, $sql, $template);
    }
    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

		$this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[1] . '.* ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . $this->tables[1] . ' ON ' . $this->tables[0] . '.id = ' . $this->tables[1] . '.accounts_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields('update', $data);

        $this->showForm($data, $action, $actionType);
    }

    function deleteProcess($data, $i = 0) {
        global $db;

        $db->query('DELETE FROM ' . $this->tables[1] . ' WHERE accounts_id IN (' . implode(', ', $data['id']) . ')');
        $db->query('DELETE FROM ' . $this->tables[0] . ' WHERE id IN(' . implode(', ', $data['id']) . ')');
    }
*/
    function loadScreenResolutions($data) {

		$this->checkPermissions('updateScreenResolutions', $data);

        $this->permissions['update'] = true;

        $this->formDescription	= $this->screenResolutionsFormDescription;
        $this->messages         = $this->screenResolutionsMessages;

        $this->setTables('update');

        $data['id'] = $_SESSION['auth']['id'];
        parent::load($data, true, 'updateScreenResolutions', 'update');
    }

    function updateScreenResolutions($data) {
        global $db, $Log, $Authorization;

		$this->checkPermissions('updateScreenResolutions', $data);

        $this->permissions['update'] = true;

        $this->formDescription	= $this->screenResolutionsFormDescription;
        $this->messages         = $this->screenResolutionsMessages;

        $this->setTables('update');

        $data['id'] = $_SESSION['auth']['id'];

        $id = parent::update($data, false);

        if ($id) {
            $_SESSION['auth']['width_pixel'] = $db->getOne('SELECT width_pixel FROM ' . PREFIX . '_screen_resolutions WHERE id='.intval($data['screen_resolutions_id']));

            $params['title'] = $this->messages['single'];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

            header('Location: ' . $_SERVER['PHP_SELF'].'?do=preferences&menu=preferences');
            exit;
        }
    }

    function loadRecordsPerPage($data) {
		$this->checkPermissions('updateRecordsPerPage', $data);

        $this->permissions['update'] = true;

        $this->formDescription  = $this->recordsPerPageFormDescription;
        $this->messages         = $this->recordsPerPageMessages;

        $this->setTables('update');

        $data['id'] = $_SESSION['auth']['id'];

        parent::load($data, true, 'updateRecordsPerPage', 'update');
    }

    function updateRecordsPerPage($data) {
        global $Log;

		$this->checkPermissions('updateRecordsPerPage', $data);

        $this->permissions['update'] = true;

        $this->formDescription  = $this->recordsPerPageFormDescription;
        $this->messages         = $this->recordsPerPageMessages;

        $this->setTables('update');

        $data['id'] = $_SESSION['auth']['id'];

        if (parent::update($data, false)) {

            $_SESSION['auth']['records_per_page'] = $data['records_per_page'];

            $params['title'] = $this->messages['single'];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=preferences&menu=preferences');
            exit;
        }
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $Authorization;

        if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR && $data['id'] <> 1) {
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('domenTitle') ]);
        }

        return parent::showForm($data, $action, $actionType, $template);
    }

    function loadProfile($data) {
        global $Authorization;
		if($Authorization->data['roles_id'] == ROLES_AGENT) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('login') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_number') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_date') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_number_generali') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_date_generali') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('go_discount') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('ankets') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('seller') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('service') ]);
		}
		
		$this->checkPermissions('updateProfile', $data);

        $this->permissions['update'] = true;

        $data['id'] = $Authorization->data['id'];

        if ($Authorization->data['id'] != 1) {
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('ip') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('active') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('account_groups_id') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('managers_id') ]);
        }

        $this->load($data, true, 'updateProfile', 'update');
    }

    function updateProfile($data) {
        global $Authorization, $Log;

		if($Authorization->data['roles_id'] == ROLES_AGENT) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('login') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_number') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_date') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_number_generali') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_date_generali') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('go_discount') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('ankets') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('seller') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('service') ]);
		}
		
		$this->checkPermissions('updateProfile', $data);

        $this->permissions['update'] = true;

        $data['id'] = $_SESSION['auth']['id'];

        if ($Authorization->data['id'] != 1) {
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('ip') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('active') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('groups_id') ]);
        }

        if ($this->update($data, false)) {
            $_SESSION['auth']['firstname']	= $data['firstname'];
            $_SESSION['auth']['lastname']	= $data['lastname'];

            $params['title'] = $this->messages['single'];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

            header('Location: ' . $_SERVER['PHP_SELF'].'?do=preferences&menu=preferences');
            exit;
        }
    }

    function loadPassword($data) {
        global $Authorization;

		$this->checkPermissions('updatePassword', $data);

        $this->permissions['update'] = true;

        $this->formDescription	= $this->passwordFormDescription;
        $this->messages			= $this->passwordMessages;

        $this->setTables('update');

        if (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        $this->showForm($data, 'updatePassword', 'update');
    }

    function updatePassword($data) {
    	global $db, $Log;

		$this->checkPermissions('updatePassword', $data);

        $this->permissions['update'] = true;

        $this->formDescription	= $this->passwordFormDescription;
        $this->messages         = $this->passwordMessages;

        $this->setTables('update');

        if (!intval($data['id'])) {
            $data['id'] = $_SESSION['auth']['id'];
        }

        $id = parent::update($data, false);

        if ($id) {
			$sql =	'UPDATE ' . PREFIX . '_accounts SET ' .
					'expired = NOW( ) + INTERVAL 2 WEEK ' .
					'WHERE id = ' . intval($_SESSION['auth']['id']);
        	$db->query($sql);

        	$_SESSION['auth']['expired'] = 0;

        	$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
        	header('Location: ' . $data['redirect']);
            exit;
        }

        return $id;
    }

    function generatePassword() {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz0123456789';

        mt_srand((double)microtime()*1000000);

        $password = '';

        for($i = 0; $i < $this->passwordLength; $i++) {
            $password .= $characters[ mt_rand(0, strlen($characters) - 1) ];
        }

        return $password;
    }

    function recoveryPasswordInWindow($data) {
        include_once 'recoveryPassword.php';
        exit;
    }

    function sendPasswordInWindow($data) {
        global $db, $Log, $Templates;

        $conditions[] = 'email = ' . $db->quote($data['email']);
//        $conditions[] = $db->quote($_SERVER['REMOTE_ADDR']) . ' REGEXP BINARY IP';

        $sql =	'SELECT * ' .
                'FROM ' . PREFIX . '_accounts ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        if ($list && strlen($data['email'])>0) {
            /*foreach ($list as $i => $row) {
                $list[ $i ]['password'] = $this->generatePassword();

                $sql =  'UPDATE ' . PREFIX . '_accounts SET ' .
                        //'password = PASSWORD(' . $db->quote($list[ $i ]['password']) . ') ' .
                        'password = ' . $db->quote($list[ $i ]['password']) . ' ' .
                        'WHERE id = ' . intval($row['id']);
                $db->query($sql);
            }*/

            $Templates->send($data['email'], $list, 'Users. Forgot password');

            $Log->add('confirm', 'Логін та пароль були відправлені за адресою <b>%s</b>.', array($data['email']));
        } else {
            $Log->add('error', 'Логін та пароль не були відправлені .<br />E-mail не вірний.');
        }

        include_once 'sendPasswordConfirmation.php';
        exit;
    }

    function getRolesIdById($id) {
        global $db;

        $sql =	'SELECT roles_id ' .
                'FROM ' . PREFIX . '_accounts ' .
                'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }

    function getTitle($id) {
        global $db;

		$sql =	'SELECT lastname, firstname ' .
				'FROM ' . PREFIX . '_accounts ' .
				'WHERE id = ' . intval($id);
        $row = $db->getRow($sql);

        return $row['lastname'] . ' ' . $row['firstname'];
    }

    function getOrganization($id) {
        global $db;

        switch ($this->getRolesIdById($id)) {
            case ROLES_ADMINISTRATOR:
                return 'Адміністратор';
                break;
            case ROLES_MANAGER:
                return 'ТДВ "Експрес страхування"';
                break;
            case ROLES_AGENT:
                $sql =	'SELECT title ' .
                        'FROM ' . PREFIX . '_agencies as a ' .
                        'JOIN ' . PREFIX . '_agents as b ON a.id = b.agencies_id ' .
                        'WHERE b.accounts_id = ' . intval($id);
                return $db->getOne($sql);
                break;
            case ROLES_CLIENT_CONTACT:
                $sql =	'SELECT company ' .
                        'FROM ' . PREFIX . '_clients as a ' .
                        'JOIN ' . PREFIX . '_client_contacts as b ON a.id = b.clients_id ' .
                        'WHERE b.accounts_id = ' . intval($id);
                return $db->getOne($sql);
                break;
            case ROLES_MASTER:
                $sql =	'SELECT title ' .
                        'FROM ' . PREFIX . '_car_services as a ' .
                        'JOIN ' . PREFIX . '_masters as b ON a.id = b.car_services_id ' .
                        'WHERE b.accounts_id = ' . intval($id);
                return $db->getOne($sql);
                break;
             case ROLES_EXPERT:
                $sql =	'SELECT title ' .
                        'FROM ' . PREFIX . '_expert_organizations as a ' .
                        'JOIN ' . PREFIX . '_experts as b ON a.id = b.expert_organizations_id ' .
                        'WHERE b.accounts_id = ' . intval($id);
                return $db->getOne($sql);
        }
    }

    function getListByGroup($accounts_groups_id, $accounts=null){
        global $db;

		if (is_array($accounts) && sizeof($accounts)) {
			$accounts_cond = 'a.id IN (' . implode(', ', $accounts) . ')';
		} else {
			$accounts_cond = 'a.id IN (0)';
		}
		
        $sql = 'SELECT a.id, a.lastname, a.firstname, IF(LOCATE(\'euassist.com.ua\', a.email), 0, 1) as express FROM ' . PREFIX . '_accounts as a ' .
               'JOIN ' . PREFIX . '_account_groups_managers_assignments as b ' .
               'ON a.id = b.accounts_id ' .
               'WHERE (a.active = 1 OR ' . $accounts_cond . ') AND account_groups_id IN (' . implode(', ',$accounts_groups_id) . ') ' .
               'GROUP BY a.email ORDER BY a.lastname';

        return $db->getAll($sql);
    }

    function getListByRolesId($roles_id){
        global $db;

        $sql = 'SELECT a.id, CONCAT(a.lastname,\' \', a.firstname) FROM ' . PREFIX . '_accounts as a ' .
               'WHERE roles_id IN (' . implode(', ',$roles_id) . ') ' .
               'ORDER BY a.lastname';

        return $db->getAssoc($sql);
    }

    function getContactInWindow($data) {
        global $db;

        $result = '';

        if (eregi($_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER']) || true) {

            switch ($this->getRolesIdById($data['usersId'])) {
                case ROLES_ADMINISTRATOR:
                    $sql =  'SELECT email, title as rolesTitle ' .
                            'FROM ' . PREFIX . '_accounts as a ' .
                            'JOIN ' . PREFIX . '_administrators as b ON a.id = b.accounts_id ' .
                            'JOIN ' . PREFIX . '_roles as c ON a.roles_id = c.id ' .
                            'WHERE a.id = ' . intval($data['usersId']);
                    break;
                case ROLES_MANAGER:
                    $sql =  'SELECT phone, fax, mobile, a.email, c.title as rolesTitle ' .
                            'FROM ' . PREFIX . '_accounts as a ' .
                            'JOIN ' . PREFIX . '_managers as b ON a.id = b.accounts_id ' .
                            'JOIN ' . PREFIX . '_roles as c ON a.roles_id = c.id ' .
                            'WHERE a.id = ' . intval($data['usersId']);
                    break;
                case ROLES_MASTER:
                    $sql =  'SELECT phone, fax, mobile, email, c.title as rolesTitle, d.title as car_servicesTitle ' .
                            'FROM ' . PREFIX . '_accounts as a ' .
                            'JOIN ' . PREFIX . '_car_services as b ON a.id = b.accounts_id ' .
                            'JOIN ' . PREFIX . '_roles as c ON a.roles_id = c.id ' .
                            'JOIN ' . PREFIX . '_car_services as d ON b.car_services_id = d.id ' .
                            'WHERE a.id = ' . intval($data['usersId']);
                    break;
                case ROLES_CLIENT_CONTACT:
                    $sql =  'SELECT b.phone, b.fax, b.mobile, a.email, c.title as rolesTitle, d.company as clientsCompany ' .
                            'FROM ' . PREFIX . '_accounts as a ' .
                            'JOIN ' . PREFIX . '_client_contacts as b ON a.id = b.accounts_id ' .
                            'JOIN ' . PREFIX . '_roles as c ON a.roles_id = c.id ' .
                            'JOIN ' . PREFIX . '_clients as d ON b.clients_id = d.id ' .
                            'WHERE a.id = ' . intval($data['usersId']);
                    break;
            }

            $row = $db->getRow($sql);

            $result =
                '<table width="100%" cellspacing="0" cellpadding="0">
<tr class="row0">
	<td class="label grey"><b>Роль:</b></td>
	<td>' . $row['rolesTitle'] . '</td>
</tr>';

            if ($row['car_servicesTitle']) {
                $result .=
                    '<tr class="row0">
	<td class="label grey"><b>СТО</b>:</td>
	<td>' . $row['car_servicesTitle'] . '</td>
</tr>';
            }

            if ($row['clientsTitle']) {
                $result .=
                    '<tr class="row0">
	<td class="label grey"><b>Компанія</b>:</td>
	<td>' . $row['clientsCompany'] . '</td>
</tr>';
            }

            $result .=
                '<tr class="row0">
	<td class="label grey"><b>Телефон:</b></td>
	<td>' . $row['phone'] . '</td>
</tr>
<tr class="row0">
	<td class="label grey"><b>Мобільний:</b></td>
	<td>' . $row['mobile'] . '</td>
</tr>
<tr class="row0">
	<td class="label grey"><b>Факс:</b></td>
	<td>' . $row['fax'] . '</td>
</tr>
<tr class="row0">
	<td class="label grey"><b>E-mail:</b></td>
	<td>' . $row['email'] . '</td>
</tr>
</table>';
        }

        echo $result;
    }

    function getList() {
        global $db;

        $result[1] = 'Portal';

        return $result;
    }

    function getEmailById($id) {
        global $db;

        $sql =	'SELECT email ' .
                'FROM ' . PREFIX . '_accounts ' .
                'WHERE id = ' . intval($id);

        return $db->getOne($sql);
    }

    function workInWindow($data) {
        echo 'Ok';
        exit;
    }
}

?>