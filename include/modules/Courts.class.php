<?
/*
 * Title: financial institution class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Courts extends Form {

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
							'table'				=> 'courts'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 150,
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
							'table'				=> 'courts'),
						array(
							'name'				=> 'zip_code',
							'description'		=> 'Поштовий індекс',
					        'type'				=> fldText,
					        'maxlength'			=> 6,
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
							'table'				=> 'courts'),
						array(
							'name'				=> 'region',
							'description'		=> 'Область',
					        'type'				=> fldText,
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
							'table'				=> 'courts'),
						array(
							'name'				=> 'area',
							'description'		=> 'Район',
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
							'table'				=> 'courts'),
						array(
							'name'				=> 'city',
							'description'		=> 'Населений пункт',
					        'type'				=> fldText,
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
							'table'				=> 'courts'),
						array(
							'name'				=> 'street',
							'description'		=> 'Вулиця',
					        'type'				=> fldText,
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
							'table'				=> 'courts'),
						array(
							'name'				=> 'house',
							'description'		=> 'Номер будинку',
					        'type'				=> fldText,
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
							'table'				=> 'courts'),
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
							'table'				=> 'courts'),
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
							'table'				=> 'courts')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Courts($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Суди';
		$this->messages['single'] = 'Суд';
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
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

	function view($data) {
		if (intval($data['courts_id'])) {
			$data['id'] = $data['courts_id'];
		}

		$row = parent::view($data);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		return parent::deleteProcess($data, $i, $folder);
	}
	
	function getList($data) {
		global $db;
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_courts ' .
			   'ORDER BY title';
		return $db->getAll($sql);
	}
	
	function getTitle($id) {
		global $db;
		
		$sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_courts ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getAddress($id) {
		global $db;
		
		$sql = 'SELECT * ' .
			   'FROM ' . PREFIX . '_courts ' .
			   'WHERE id = ' . intval($id);
		$court = $db->getRow($sql);
		
		return $court['zip_code'] . ', ' . (strlen($court['region']) ? $court['region'] . ' обл., ' : '') . (strlen($court['area']) ? $court['area'] . ' район, ' : '') . $court['city'] . ', вул. ' . $court['street'] . ', буд. ' . $court['house'];
	}
}

?>