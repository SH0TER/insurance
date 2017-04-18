<?
/*
 * Title: administrator class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Policies.class.php';

class Administrators extends Users {

    var $roles_id = ROLES_ADMINISTRATOR;

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              	=> 'id',
                            'type'              	=> fldIdentity,
                            'display'				=>
                                array(
                                    'show'      	=> true,
                                    'insert'    	=> false,
                                    'view'      	=> true,
                                    'update'    	=> true
                                ),
                            'verification'      	=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             	=> 'accounts'),
                        array(
                            'name'              	=> 'login',
                            'description'       	=> 'Логін',
                            'type'              	=> fldLogin,
                            'maxlength'         	=> 15,
                            'display'           	=>
                                array(
                                    'show'      	=> false,
                                    'insert'    	=> true,
                                    'view'      	=> false,
                                    'update'    	=> true
                                ),
                            'verification'      	=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             	=> 'accounts'),
                        array(
                            'name'                  => 'password',
                            'description'           => 'Пароль',
                            'additionalDescription'	=> 'Ще раз',
                            'type'                  => fldPassword,
                            'maxlength'            	=> 10,
                            'display'               =>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'lastname',
                            'description'        	=> 'Прізвище',
                            'type'                	=> fldText,
                            'maxlength'            	=> 50,
                            'display'            	=>
                                array(
                                    'show'       	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 1,
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'firstname',
                            'description'        	=> 'Ім\'я',
                            'type'                	=> fldText,
                            'maxlength'            	=> 50,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'   	 	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 2,
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'patronymicname',
                            'description'        	=> 'По батькові',
                            'type'                	=> fldText,
                            'maxlength'            	=> 50,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 3,
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'email',
                            'description'        	=> 'E-mail',
                            'type'                	=> fldEmail,
                            'maxlength'            	=> 50,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'       	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'screen_resolutions_id',
                            'description'        	=> 'Роздільча здатність',
                            'type'                	=> fldSelect,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'accounts',
                            'sourceTable'        	=> 'screen_resolutions',
                            'selectField'        	=> 'title',
                            'orderField'        	=> 'title'),
                        array(
                            'name'                	=> 'records_per_page',
                            'description'        	=> 'Записів на сторінку',
                            'type'                	=> fldInteger,
                            'validationRule'    	=> '^([0-9]{1,3})$',
                            'maxlength'            	=> 2,
                            'width'                	=> 30,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'roles_id',
                            'description'        	=> 'Роль',
                            'type'                	=> fldConst,
                            'value'                	=> ROLES_ADMINISTRATOR,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'active',
                            'description'        	=> 'Активний',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true,
                                    'change'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        	=> 4,
                            'width'                	=> 100,
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'created',
                            'description'        	=> 'Створено',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 5,
                            'width'             	=> 100,
                            'table'                	=> 'accounts'),
                        array(
                            'name'                	=> 'modified',
                            'description'        	=> 'Редаговано',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'accounts')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    	=> 5,
                        'defaultOrderDirection'    	=> 'desc',
                        'titleField'            	=> 'login'
                    )
            );

    function Administrators($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Адміністратори';
        $this->messages['single'] = 'Адміністратор';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      				=> true,
                    'insert'    				=> false,
                    'update'	    			=> true,
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true,
                    'view'      				=> false,
                    'change'   					=> true,
                    'delete'    				=> true,
                    'export'    				=> true);
                break;
        }
    }

    function show($data) {

        $conditions[] = 'id <> 1';
        parent::show($data, $fields, $conditions);
    }

    function isLoginExists($field, $login, $id=null) {
        return parent::isLoginExists($field, $login, ROLES_ADMINISTRATOR, $id);
    }

    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_accounts';
        $list = $db->getAll($sql);

        $Smarty->assign('list', $list);

        $result = $Smarty->fetch($this->object . '/export.tpl');

        header('Content-Disposition: attachment; filename="administrators.xls"');
        header('Content-Type: ' . $this->getContentType('administrators.xls'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

    function showDesktop($i = 1) {
        global $data;

        $data['do'] = 'Policies|show';

        $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        $Policies = Policies::factory($data, 'KASKO');

        $Policies->objectTitle = 'Policies_KASKO';
        $Policies->show($data, $fields, $conditions, $sql);
/*
        $data['product_types_id'] = PRODUCT_TYPES_GO;
        $Policies = Policies::factory($data, 'GO');

        $Policies->objectTitle = 'Policies_GO';
        $Policies->show($data, $fields, $conditions, $sql);

        $data['product_types_id'] = PRODUCT_TYPES_DGO;
        $Policies = Policies::factory($data, 'DGO');

        $Policies->objectTitle = 'Policies_DGO';
        $Policies->show($data, $fields, $conditions, $sql);

        $data['product_types_id'] = PRODUCT_TYPES_DSKV;
        $Policies = Policies::factory($data, 'DSKV');

        $Policies->objectTitle = 'Policies_DSKV';
        $Policies->show($data, $fields, $conditions, $sql);

		$data['product_types_id'] = PRODUCT_TYPES_PROPERTY;
		$Policies = Policies::factory($data, 'Property');

		$Policies->objectTitle = 'Policies_Property';
		$Policies->show($data, $fields, $conditions, $sql);

		$data['product_types_id'] = PRODUCT_TYPES_NS;
		$Policies = Policies::factory($data, 'NS');

		$Policies->objectTitle = 'Policies_NS';
		$Policies->show($data, $fields, $conditions, $sql);
*/
//        echo News::getRoll($data);
    }
}

?>