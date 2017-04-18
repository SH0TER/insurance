<?
/*
 * Title: delivery way class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class DeliveryWays extends Form {
	var $delimiter = '/';

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
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'delivery_ways'),
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
							'table'				=> 'delivery_ways'),
						array(
							'name'				=> 'title_en',
							'description'		=> 'Назва (англійська)',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'table'				=> 'delivery_ways'),
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
							'table'				=> 'delivery_ways'),
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
							'table'				=> 'delivery_ways')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function DeliveryWays($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Види транспортування';
		$this->messages['single'] = 'Вид транспортування';
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
					'delete'	=> false);
				break;
		}
	}

	function insert($data) {
		$data['id'] = getDoubleId($this->tables[0]);
		parent::insert($data);
	}

	function getTitles($id,$languageCode='') {
		global $db;
		if (strlen($languageCode)>0) $languageCode='_'.strtolower($languageCode);
		$sql =	'SELECT title' .$languageCode.' '.
				'FROM ' . PREFIX . '_delivery_ways ' .
				'WHERE id & ' . intval($id);
		$list =	$db->getCol($sql);

		return implode('/', $list);
	}
}

?>