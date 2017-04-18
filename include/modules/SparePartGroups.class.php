<?
/*
 * Title: ProfileQuestions class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */


class SparePartGroups extends Form {

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
							'table'				=> 'spare_part_groups'),
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
							'table'				=> 'spare_part_groups'),
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
                            'width'             => 100,
							'table'				=> 'spare_part_groups'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 3,
                            'width'             => 100,
                            'table'             => 'spare_part_groups')
						
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function SparePartGroups($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Групи запчастин';
		$this->messages['single'] = 'Група запчастин';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];				
				
				break;
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'delete'	=> true,
					'change'	=> true);
				break;
		}
	}
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
	
	function getList() {
		global $db;
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_spare_part_groups';
		return $db->getAll($sql);
	}

}

?>