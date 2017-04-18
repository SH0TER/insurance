<?
/*
 * Title: master class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Accidents.class.php';

class Masters extends Users {

	var $roles_id = ROLES_MASTER;

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
									'update'	=> false
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
					        'maxlength'			=> 20,
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
							'name'				=> 'car_services_id',
							'description'		=> 'СТО',
					        'type'				=> fldHidden,
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
							'table'				=> 'masters'),
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
									'show'		=> true,
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
									'show'		=> true,
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
							'orderPosition'		=> 6,
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
							'orderPosition'		=> 7,
							'table'				=> 'accounts'),
                         array(
                            'name'                => 'passport_series',
                            'description'        => 'Паспорт. Cерія',
                            'type'                => fldText,
                            'maxlength'            => 2,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'passport_number',
                            'description'        => 'Паспорт. Номер',
                            'type'                => fldText,
                            'maxlength'            => 6,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'passport_date',
                            'description'        => 'Паспорт. Дата видачі',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'passport_place',
                            'description'        => 'Паспорт. Місце видачі',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'identification_code',
                            'description'        => 'ІПН',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'address',
                            'description'        => 'Адреса',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'agreement_number',
                            'description'        => 'Номер агенського договору ЭС',
                            'type'                => fldText,
                            'maxlength'            => 20,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'agreement_date',
                            'description'        => 'Дата агенського договору ЭС',
                            'type'                => fldDate,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'recipient',
                            'description'        => 'Отримувач',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'mfo',
                            'description'        => 'МФО',
                            'type'                => fldText,
                            'maxlength'            => 6,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'zkpo',
                            'description'        => 'ЗКПО',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'bank_account',
                            'description'        => 'Рахунок',
                            'type'                => fldText,
                            'maxlength'            => 14,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
                        array(
                            'name'                => 'bank_reference',
                            'description'        => 'Призначення платежу',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'masters'),
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
   							'validationRule'	=> '^([1-4][0-9]|[1-9]|50)$',
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
							'value'				=> ROLES_MASTER,
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
							'name'				=> 'spam',
							'description'		=> 'Спам',
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
							'orderPosition'		=> 9,
							'width'				=> 100,
							'table'				=> 'accounts'),
						array(
							'name'				=> 'showWorker',
							'description'		=> 'Приймає дзвінки',
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
							'orderPosition'		=> 10,
							'width'				=> 100,
							'table'				=> 'masters'),
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
							'table'				=> 'accounts'),
                         array(
							'name'				=> 'car_service',
							'description'		=> 'СТО',
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
							'table'				=> 'master_car_services_assignments',
							'sourceTable'		=> 'car_services',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'login'
					)
			);

	function Masters($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Мастера';
		$this->messages['single'] = 'Мастер';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
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
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
			case ROLES_MASTER:
				$this->permissions = array(
					'show'						=> false,
					'insert'					=> false,
					'update'					=> false,
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true,
					'view'						=> false,
					'change'					=> false,
					'delete'					=> false,
					'export'					=> false);
				break;
		}
	}

    function show($data, $fields=null, $conditions=null, $template='show.php') {

        $this->setTables('show');
        $this->setShowFields();

		$conditions[] = 'roles_id = ' . intval($this->roles_id);

        $sql =	'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
				'JOIN ' . PREFIX . '_masters ON ' . $this->tables[0] . '.id = ' . PREFIX . '_masters.accounts_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        return Form::show($data, $fields, $conditions, $sql, $template);
    }

	function isLoginExists($field, $login, $id=null) {
		return parent::isLoginExists($field, $login, ROLES_MASTER, $id);
	}

	function exportInWindow($data) {
		global $db, $Smarty;

		$this->checkPermissions('export', $data);

		$conditions[] = '1';

		if (intval($data['car_services_id'])) {
			$conditions[] = 'car_services_id = ' . intval($data['car_services_id']);
		}

		$sql =	'SELECT a.*, b.*, c.code AS car_services_code, c.title AS car_services_title ' .
				'FROM ' . PREFIX . '_accounts AS a ' .
				'JOIN ' . PREFIX . '_masters AS b ON a.id = b.accounts_id ' .
				'JOIN ' . PREFIX . '_car_services AS c ON b.car_services_id = c.id ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY CAST(c.code AS UNSIGNED), a.lastname, a.firstname';
		$list = $db->getAll($sql);

		$Smarty->assign('list', $list);

		$result = $Smarty->fetch($this->object . '/export.tpl');

		header('Content-Disposition: attachment; filename="masters.xls"');
		header('Content-Type: ' . $this->getContentType('masters.xls'));
		header('Content-Length: ' . strlen($result));

		echo $result;
		exit;
	}
	
	 function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[1] . '.*,  ' .
                'date_format(passport_date, \'%d\') as passport_date_day, date_format(passport_date, \'%m\') as passport_date_month, date_format(passport_date, \'%Y\') as passport_date_year, ' .
                'date_format(agreement_date, \'%d\') as agreement_date_day, date_format(agreement_date, \'%m\') as agreement_date_month, date_format(agreement_date, \'%Y\') as agreement_date_year ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . $this->tables[1] . ' ON ' . $this->tables[0] . '.id = ' . $this->tables[1] . '.accounts_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields('update', $data);

        $this->showForm($data, $action, $actionType);
    }
	

	function showDesktop($i = 1) {
		global $data;

		//$data['product_types_id'] = PRODUCT_TYPES_KASKO;
		$Accidents = new Accidents($data);//::factory($data, 'KASKO');
		$Accidents->show($data, $fields, $conditions, $sql);

//		echo News::getRoll($data);
	}
	
	function getMastersByCarServicesIdInWindow($data) {
		global $db;
		
		$sql = 'SELECT masters.accounts_id as masters_id, CONCAT_WS(\' \', accounts.lastname, accounts.firstname) as masters_name ' .
			   'FROM ' . PREFIX . '_masters as masters ' .
			   'JOIN ' . PREFIX . '_accounts as accounts ON masters.accounts_id = accounts.id ' .
			   'WHERE car_services_id = ' . $data['car_services_id'] . ' ' .
			   'ORDER BY accounts.lastname, accounts.firstname';
		$list = $db->query($sql);		
		
		$result = '<a href="javascript: getListBySearch(' . $db->quote($data['elem']) . ')">До вибору СТО</a><br/><br/>';

        while($list->fetchInto($row)) {
            //$result .= '<a href="javascript: setMaster(\'' . $row['masters_id'] . '\', \'' . $row['masters_name'] . '\')"><strong>' . $row['masters_name'] . '</strong></a><br />';
			$result .= '<a href="javascript: setMaster(\'' . $row['masters_id'] . '\')"><strong>' . $row['masters_name'] . '</strong></a><br />';
        }
		
        echo $result;
	}
	
	function getNameInWindow($data) {
		global $db;
		
		$sql = 'SELECT CONCAT_WS(\' \', lastname, firstname) ' . 
			   'FROM ' . PREFIX . '_accounts ' .
			   'WHERE id = ' . intval($data['id']);
		
		$result['name'] = $db->getOne($sql);
		
		echo json_encode($result);
		exit;
	}
}

?>