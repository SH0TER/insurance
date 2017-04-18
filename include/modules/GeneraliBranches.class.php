<?
/*
 * Title: GeneraliBranches class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class GeneraliBranches extends Form {

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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 200,
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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'edrpou',
							'description'		=> 'Код ЄДРПОУ:',
					        'type'				=> fldUnique,
					        'maxlength'			=> 8,
							'validationRule'	=> '^[0-9]{8}$',
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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'director1',
							'description'		=> 'Посада, ПІБ у називному відмінку',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'director2',
							'description'		=> 'Посада, ПІБ у родовому відмінку',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'address',
							'description'		=> 'Адреса',
					        'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'phones',
							'description'		=> 'Телефони',
					        'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'generali_branches'),
						array(
							'name'				=> 'banking_details',
							'description'		=> 'Банківські реквизити',
					        'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'generali_branches'),				
						array(
							'name'				=> 'ground_akt',
							'description'		=> 'Акт, діє на підставі',
					        'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'generali_branches'),
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
							'table'				=> 'generali_branches'),
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
							'orderPosition'		=> 2,
							'width'				=> 120,
							'table'				=> 'generali_branches')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function GeneraliBranches($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Філії "Гарант-Авто"';
		$this->messages['single'] = 'Філія "Гарант-Авто"';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> true,
					'change'	=> true,
					'delete'	=> true,
					'export'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}
	
	function view($data) {
		if (intval($data['branches_id'])) {
			$data['id'] = $data['branches_id'];
		}

		$row = parent::view($data);

		$data['branches_id'] = $row['id'];

		$fields		= array('branches_id');
		$conditions	= array('branches_id = ' . intval($data['branches_id']));

		$GeneraliManagers = Users::factory($data, 'GeneraliManagers');
		$GeneraliManagers->show($data, $fields, $conditions);
	}
	
	function exportInWindow($data) {
		global $db, $Smarty;

		$this->checkPermissions('export', $data);

		$sql =	'SELECT a.* ' .
				'FROM ' . $this->tables[0] . ' as a ' .
				'ORDER BY  a.title';
		$list = $db->getAll($sql, 3600);

		$Smarty->assign('list', $list);

		$result = $Smarty->fetch($this->object . '/export.tpl');

		header('Content-Disposition: attachment; filename="branches.xls"');
		header('Content-Type: ' . $this->getContentType('branches.xls'));
		header('Content-Length: ' . strlen($result));

		echo $result;
		exit;
	}
}

?>