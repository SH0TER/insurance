<?
/*
 * Title: expert class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Accidents.class.php';

class Experts extends Users {

	var $roles_id = ROLES_EXPERT;

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
							'name'				=> 'expert_organizations_id',
							'description'		=> 'Експертна організіція',
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
							'table'				=> 'experts'),
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
                        /* array(
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),
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
                            'table'                => 'experts'),*/
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
							'value'				=> ROLES_EXPERT,
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

	function Experts($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Експерти';
		$this->messages['single'] = 'Експерт';
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
					'view'						=> true,
					'change'					=> true,
					'delete'					=> true,
					'export'					=> true);
				break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
			case ROLES_EXPERT:
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
				'JOIN ' . PREFIX . '_experts ON ' . $this->tables[0] . '.id = ' . PREFIX . '_experts.accounts_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        
        return Form::show($data, $fields, $conditions, $sql, $template);
    }

	function isLoginExists($field, $login, $id=null) {
		return parent::isLoginExists($field, $login, ROLES_EXPERT, $id);
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
				'JOIN ' . PREFIX . '_experts AS b ON a.id = b.accounts_id ' .
				'JOIN ' . PREFIX . '_car_services AS c ON b.car_services_id = c.id ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY CAST(c.code AS UNSIGNED), b.lastname, b.firstname';
		$list = $db->getAll($sql);

		$Smarty->assign('list', $list);

		$result = $Smarty->fetch($this->object . '/export.tpl');

		header('Content-Disposition: attachment; filename="experts.xls"');
		header('Content-Type: ' . $this->getContentType('experts.xls'));
		header('Content-Length: ' . strlen($result));

		echo $result;
		exit;
	}

    function getListByOrganizationId($expert_organization_id){
        global $db;

        $conditions[] = 'expert_organizations_id = ' . intval($expert_organization_id);

        $sql = 'SELECT a.id, CONCAT(a.lastname,\' \', a.firstname) as expert_name, IF(count(c.id) = 0, 0, count(c.id)) as messages_count ' .
               'FROM ' . PREFIX . '_accounts as a ' .
               'JOIN ' . PREFIX . '_experts as b ON b.accounts_id = a.id ' .
               'LEFT JOIN ' . PREFIX . '_accident_messages as c ON c.recipients_id = a.id AND c.statuses_id = ' . intval(ACCIDENT_MESSAGE_STATUSES_QUESTION) . ' ' .
               'WHERE (' . implode(' AND ', $conditions) . ') ' .
               'GROUP BY c.recipients_id ' .
               'ORDER BY a.lastname';

        return $db->getAll($sql);
    }

	function showDesktop($i = 1) {
		global $data;

		$data['product_types_id'] = PRODUCT_TYPES_GO;
		$Accidents = Accidents::factory($data, 'GO');
		$Accidents->show($data, $fields, $conditions, $sql);

		echo News::getRoll($data);
	}
}

?>