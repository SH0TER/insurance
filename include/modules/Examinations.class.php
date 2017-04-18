<?
/*
 * Title: examination class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

class Examinations extends Form {

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
							'table'				=> 'examinations'),
						array(
							'name'				=> 'expertsId',
							'description'		=> 'Експерт',
					        'type'				=> fldSelect,
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
							'table'				=> 'examinations',
							'sourceTable'		=> 'experts',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
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
							'table'				=> 'examinations'),
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
							'width'				=> 100,
							'table'				=> 'examinations')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Examinations($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Експертизи';
		$this->messages['single'] = 'Експертиза';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'add'		=> true,
					'edit'		=> true,
					'view'		=> true,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = array(
					'show'		=> true,
					'add'		=> ($Authorization->data['settlement']) ? true : false,
					'edit'		=> ($Authorization->data['settlement']) ? true : false,
					'view'		=> true,
					'delete'	=> ($Authorization->data['settlement']) ? true : false);
				break;
		}
	}
}

?>