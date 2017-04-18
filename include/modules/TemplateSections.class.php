<?
/*
 * Title: template section class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Templates.class.php';

class TemplateSections extends Form {
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
							'table'				=> 'template_sections'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
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
							'table'				=> 'template_sections'),
						array(
							'name'				=> 'order_position',
							'description'		=> 'Порядок виводу',
					        'type'				=> fldOrderPosition,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 110,
							'orderPosition'		=> 2,
							'table'				=> 'template_sections'),
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
							'width'				=> 70,
							'orderPosition'		=> 3,
							'table'				=> 'template_sections')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function TemplateSections($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Розділи';
		$this->messages['single'] = 'Розділ';
	}

	function setPermissions() {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> false,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> false);
				break;
		}
	}

	function getType($sections_id) {
		switch ($sections_id) {
			case 1:
				$type = 'Page';
				break;
			case 2:
				$type = 'Block';
				break;
			case 3:
				$type = 'Template';
				break;
			case 4:
				$type = 'Mail';
				break;
		}
		return $type;		
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit = true) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$conditions[] = 'id <> 2 AND id <> 3';
				break;
			default:
				$conditions[] = 'id <> 2 AND id <> 3';
				break;
		}

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function view($data) {
		if ($data['sections_id'])
			$data['id'] = $data['sections_id'];

		$row = parent::view($data);

		$data['sections_id']	= $row['id'];

		$Templates = Templates::factory($data, $this->getType($data['sections_id']));

		$fields[]			= 'sections_id';
		$conditions[]		= 'sections_id=' . intval($data['sections_id']);

		$Templates->show($data, $fields, $conditions);
	}

	function deleteProcess($data) {
		global $Log;

		foreach ($data['id'] as $id) {
			$count = $db->getOne('SELECT count(*) FROM ' . PREFIX . '_templates WHERE sections_id=' . intval($id));
			if ($count == 0) {
				$sections['id'] = $id;
				parent::delete($sections, false, false);
				$showSuccessfulMessage = true;
			} else {
				$params['title'] = $this->getTitle($id);
				$Log->add('error', $this->messages['delete']['error'], $params);
			}
		}
	}

}

?>