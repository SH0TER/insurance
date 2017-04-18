<?
/*
 * Title: client contact class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Policies.class.php';

class ClientContacts extends Users {

    var $roles_id = ROLES_CLIENT_CONTACT;

    var $formDescription =
        array(
            'fields'     =>
                array(
                    array(
                        'name'          => 'id',
                        'type'          => fldIdentity,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'login',
                        'description'   => 'Логін',
                        'type'          => fldLogin,
                        'maxlength'     => 15,
                        'display'       =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => false,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                                    ),
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'password',
                        'description'   => 'Пароль',
                        'additionalDescription' => 'Ще раз',
                        'type'          => fldPassword,
                        'maxlength'     => 10,
                        'display'                =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'clients_id',
                        'description'   => 'Клієнт',
                        'type'          => fldHidden,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'client_contacts'),
                    array(
                        'name'          => 'lastname',
                        'description'   => 'Прізвище',
                        'type'          => fldText,
                        'maxlength'     => 50,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition' => 1,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'firstname',
                        'description'   => 'Ім\'я',
                        'type'          => fldText,
                        'maxlength'     => 50,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition' => 2,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'patronymicname',
                        'description'   => 'По батьковi',
                        'type'          => fldText,
                        'maxlength'     => 50,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition' => 3,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'phone',
                        'description'   => 'Телефон',
                        'type'          => fldText,
                        'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
                        'maxlength'     => 15,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition' => 4,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'fax',
                        'description'   => 'Факс',
                        'type'          => fldText,
                        'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
                        'maxlength'     => 15,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition' => 5,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'mobile',
                        'description'   => 'Мобільний',
                        'type'          => fldText,
                        'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
                        'maxlength'     => 15,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition' => 6,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'email',
                        'description'   => 'E-mail',
                        'type'          => fldEmail,
                        'maxlength'     => 50,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition' => 7,
                        'table'         => 'accounts'),
/*
                    array(
                        'name'          => 'ip',
                        'description'   => 'IP',
                        'type'          => fldText,
                        'maxlength'     => 15,
                        'display'       =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'accounts'),
*/
                    array(
                        'name'          => 'screen_resolutions_id',
                        'description'   => 'Роздільча здатність',
                        'type'          => fldSelect,
                        'display'       =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'accounts',
                        'sourceTable'   => 'screen_resolutions',
                        'selectField'   => 'title',
                        'orderField'    => 'title'),
                    array(
                        'name'          => 'records_per_page',
                        'description'   => 'Записів на сторінку',
                        'type'          => fldInteger,
                        'validationRule'    => '^([1-4][0-9]|[1-9]|50)$',
                        'maxlength'     => 2,
                        'width'         => 30,
                        'display'       =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'roles_id',
                        'description'   => 'Роль',
                        'type'          => fldConst,
                        'value'         => ROLES_CLIENT_CONTACT,
                        'display'       =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'active',
                        'description'   => 'Активний',
                        'type'          => fldBoolean,
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true,
                                'change'    => true
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition' => 8,
                        'width'         => 100,
                        'table'         => 'accounts'),
                    array(
                        'name'          => 'created',
                        'description'   => 'Створено',
                        'type'          => fldDate,
                        'value'         => 'NOW()',
                        'display'       =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'  =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition' => 10,
                        'width'         => 100,
                        'table'         => 'accounts'),
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
            'common'    =>
                array(
                    'defaultOrderPosition'  => 1,
                    'defaultOrderDirection' => 'asc',
                    'titleField'            => 'login'
               )
        );

    function ClientContacts($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Клієнти, контакти';
        $this->messages['single'] = 'Клієнти, контакт';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'      => true);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'      				=> true,
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true,
                    'view'      				=> true,
                    'delete'    				=> false);
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      				=> true,
                    'insert'    				=> true,
                    'update'    				=> true,
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true,
                    'view'      				=> false,
                    'change'    				=> true,
                    'delete'    				=> true,
                    'export'    				=> true);
                break;
        }
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		if (intval($data['clients_id'])) {
			$conditions[] = 'clients_id = ' . intval($data['clients_id']);
		}
        $this->setTables('show');
        $this->setShowFields();

        $conditions[] = $this->tables[0] . '.id = ' . $this->tables[1] . '.accounts_id';

        $sql =	'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
                'FROM ' . $this->tables[0] . ', ' . $this->tables[1] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);

        parent::show($data, $fields, $conditions, $sql, $template);

	}

    function isLoginExists($field, $login, $id=null) {
        return parent::isLoginExists($field, $login, ROLES_CLIENT_CONTACT, $id);
    }

    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $conditions[] = '1';

        if (intval($data['clients_id'])) {
            $conditions[] = 'clients_id = ' . intval($data['clients_id']);
        }

        $sql =  'SELECT a.*, b.*, c.company  as clientsCompany ' .
                'FROM ' . PREFIX . '_accounts as a ' .
                'JOIN ' . PREFIX . '_client_contacts as b ON a.id = b.accounts_id ' .
                'JOIN ' . PREFIX . '_clients as c ON b.clients_id = c.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY c.company, a.lastname, a.firstname';
        $list = $db->getAll($sql);

        $Smarty->assign('list', $list);

        $result = $Smarty->fetch($this->object . '/export.tpl');

        header('Content-Disposition: attachment; filename="client_contacts.xls"');
        header('Content-Type: ' . $this->getContentType('client_contacts.xls'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

    function showDesktop($i = 1) {
        global $data, $Authorization;

        $data['do']     = 'Policies|show';

        $PolicyMessages = new PolicyMessages($data);
        $PolicyMessages->permissions['insert'] = false;
        $PolicyMessages->show($data, $fields, $conditions);

        $data['product_types_id'] = PRODUCT_TYPES_CARGO_CERTIFICATE;
        $Policies = Policies::factory($data, 'Cargo');

        $Policies->objectTitle = 'Policies_Cargo';
        $Policies->show($data, $fields, $conditions, $sql);

        $data['product_types_id'] = PRODUCT_TYPES_DRIVE_CERTIFICATE;
        $Policies = Policies::factory($data, 'Drive');

        $Policies->objectTitle = 'Policies_Drive';
        $Policies->show($data, $fields, $conditions, $sql);

        echo News::getRoll($data);
    }
}

?>