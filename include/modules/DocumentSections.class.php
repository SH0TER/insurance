<?
/*
 * Title: document class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Documents.class.php';

class DocumentSections extends Form {

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
							'table'				=> 'document_sections'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
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
							'table'				=> 'document_sections'),
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
							'table'				=> 'document_sections'),
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
                            'width'             => 100,
							'table'				=> 'document_sections')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function DocumentSections($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Розділи';
		$this->messages['single'] = 'Розділ';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'   	=> true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_MASTER:
				$this->permissions = array(
					'show'		=> true,
					'view'		=> true);
				break;
		}
	}

	function view($data) {
		if (intval($data['sections_id'])) {
			$data['id'] = $data['sections_id'];
		}

		$row = parent::view($data);

		$data['sections_id'] = $row['id'];

		$fields		= array('sections_id');
		$conditions	= array('sections_id = ' . intval($data['sections_id']));

		$Documents = new Documents($data);
		$Documents->show($data, $fields, $conditions);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$Documents = new Documents($data);

		$sql =	'SELECT id ' . 
				'FROM ' . $Documents->tables[0] . ' ' .
				'WHERE sections_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $Documents->messages['plural'] . '</b>.');
			return false;
		}

		return parent::deleteProcess($data, $i, $folder);
	}
}

?>