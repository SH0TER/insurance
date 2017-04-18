<?
/*
 * Title: account permission class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class AccountPermissions extends Form {

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
							'table'				=> 'account_permissions'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 100,
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
							'table'				=> 'account_permissions'),
						array(
							'name'				=> 'object',
							'description'		=> 'Об\'єкт',
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
							'table'				=> 'account_permissions'),
						array(
							'name'				=> 'method',
							'description'		=> 'Метод',
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
							'table'				=> 'account_permissions'),
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
							'orderPosition'		=> 4,
							'table'				=> 'account_permissions'),
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
							'orderPosition'		=> 5,
							'width'				=> 100,
							'table'				=> 'account_permissions')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function AccountPermissions($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Повноваження';
		$this->messages['single'] = 'Повноваження';
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
			default:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> false,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> false);
				break;
		}
	}

    function show($data, $fields=null, $conditions=null, $sql, $template='show.php') {
		global $db;

		if ($data['object']) {
			$fields[] = 'object';
			$conditions[] = 'object = ' . $db->quote($data['object']);
		}

        $data['objects'] = $db->getCol('SELECT DISTINCT object FROM ' . PREFIX . '_account_permissions ORDER BY object');

        Form::show($data, $fields, $conditions, $sql, $this->object . '/' . $template);
    }

	function checkFields($data, $action) {
		global $db, $Log;

		parent::checkFields($data, $action);

		if ($data['object'] && $data['method']) {

			$conditions[] = 'object = ' . $db->quote($data['object']);
			$conditions[] = 'method = ' . $db->quote($data['method']);
			$conditions[] = 'id <> ' . intval($data['id']);

			$sql =	'SELECT id ' .
					'FROM ' . $this->tables[0] . ' ' .
					'WHERE ' . implode(' AND ', $conditions);
			$id = $db->getOne($sql);

			if ($id) {
				$params = array('Об\'єкт/клас', '');
				$Log->add('error', 'The record with <b>%s</b>%s already exists.', $params);
			}
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_account_group_permissions ' .
				'WHERE account_permissions_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}
}

?>