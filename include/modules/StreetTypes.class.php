<?
/*
 * Title: street type class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class StreetTypes extends Form {

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
							'table'				=> 'street_types'),
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
							'table'				=> 'street_types'),
						array(
							'name'				=> 'order_position',
							'description'		=> 'Порядок виводу',
					        'type'				=> fldOrderPosition,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'street_types'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
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
							'table'				=> 'street_types'),
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
							'table'				=> 'street_types')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function StreetTypes($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Типи вулиць';
		$this->messages['single'] = 'Тип вулиці';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> false);
				break;
		}
	}

	function getTitle($id, $languageCode=null) {
		global $db;
		if (strlen($languageCode)>0) $languageCode='_'.strtolower($languageCode);
		$sql = 'SELECT title' . $languageCode . ' FROM ' . PREFIX . '_street_types WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}

	function getAll() {
		global $db;

		$sql =	'SELECT * ' . 
				'FROM ' . PREFIX . '_street_types ' .
				'ORDER BY order_position';
		$list =	$db->getAll($sql, 24 * 60 * 60);

		if (is_array($list) && sizeOf($list)) {
			$result = array();
			foreach ($list as $row) {
				$result[ $row['id'] ] = $row['title'];
			}
		}

		return $result;
	}
}

?>