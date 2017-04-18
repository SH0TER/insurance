<?
/*
 * Title: account group class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class AccountGroups extends Form {

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
							'table'				=> 'account_groups'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 500,
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
							'table'				=> 'account_groups'),
						array(
							'name'				=> 'account_permissions_id',
							'description'		=> 'Повноваження',
					        'type'				=> fldMultipleSelect,
							'size'				=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'account_group_permissions',
							'sourceTable'		=> 'account_permissions',
							'selectField'		=> 'CONCAT(object, \' / \', method, \' / \', title)',
							'orderField'		=> 'CONCAT(object, \' / \', method, \' / \', title)'),
						array(
							'name'				=> 'accounts_id',
							'description'		=> 'Менеджери',
					        'type'				=> fldMultipleSelect,
							'size'				=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'account_groups_managers_assignments',
							'sourceTable'		=> 'accounts',
							'selectField'		=> 'CONCAT(lastname, \' / \', firstname)',
							'orderField'		=> 'CONCAT(lastname, \' / \', firstname)'),
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
							'orderPosition'		=> 2,
							'table'				=> 'account_groups'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
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
							'orderPosition'		=> 3,
							'width'				=> 100,
							'table'				=> 'account_groups')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function AccountGroups($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Посади користувачів';
		$this->messages['single'] = 'Посада користувачів';
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
					'delete'	=> true);
				break;
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$sql =	'SELECT accounts_id ' . 
				'FROM ' . PREFIX . '_account_groups_managers_assignments ' .
				'WHERE account_groups_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $Managers->messages['plural'] . '</b>.');
			return false;
		}

		$sql =	'DELETE FROM ' . PREFIX . '_account_group_permissions ' .
				'WHERE account_groups_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql = 'DELETE FROM ' . PREFIX . '_account_groups ' .
			   'WHERE id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);
	}

    function getRecipientOrganization($id){
         global $db;

         $sql = 'SELECT recipient_organization ' .
				'FROM ' . PREFIX . '_account_groups ' .
                'WHERE id = ' . intval($id);
		return  $db->getOne($sql, 30*60);
    }

	function getRecipientOrganizations() {
        global $db;

        $sql =	'SELECT id, recipient_organization AS title ' .
				'FROM ' . PREFIX . '_account_groups ' .
				'WHERE recipient_organization <> \'\' ' .
				'ORDER BY recipient_organization';
		return $db->getAll($sql, 30*60);
    }
	
	function setListValues($data, $actionType) {
		global $db;
		
		$this->formDescription['fields'][ $this->getFieldPositionByName('accounts_id') ]['list'] = $this->getListValue($this->formDescription['fields'][ $this->getFieldPositionByName('accounts_id') ], $data);

		parent::setListValues($data, $actionType);
	}
	
	function getListValue($field, $data) {
		global $db;
		
		switch ($field['name']) {
			case 'accounts_id':
				$sql = 'SELECT id, CONCAT_WS(\' \', lastname, firstname) as title ' .
					   'FROM ' . PREFIX . '_accounts ' .
					   'WHERE active = 1 AND roles_id = ' . ROLES_MANAGER . ' ' .
					   'ORDER BY lastname, firstname';
				$list = $db->getAll($sql);
				break;
			default:
				$list = array();
				break;
		}

		foreach ($list as $row) {
			$options[ $row['id'] ] = array(
                            'title' => $row['title'],
                            'obligatory' => $row['obligatory']);
		}
		
		if (!intval(sizeof($list))) {
			return parent::getListValue($field, $data);
		} else {
			return $options;
		}
	}
}

?>