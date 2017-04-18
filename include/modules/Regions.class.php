<?
/*
 * Title: region class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Regions extends Form {

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
							'table'				=> 'regions'),
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
							'table'				=> 'regions'),
						array(
							'name'				=> 'city',
							'description'		=> 'Город',
					        'type'				=> fldText,
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
							'orderPosition'		=> 2,
							'table'				=> 'regions'),	
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
							'orderPosition'		=> 3,
							'table'				=> 'regions'),
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
							'table'				=> 'regions'),
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
							'table'				=> 'regions')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Regions($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Області';
		$this->messages['single'] = 'Область';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
			case ROLES_MANAGER:
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
		$sql = 'SELECT title' . $languageCode . ' FROM ' . PREFIX . '_regions WHERE id = ' . intval($id);
		return $db->getOne($sql, 24 * 60 * 60);
	}

	function getAll() {
		global $db;

		$sql =	'SELECT * ' . 
				'FROM ' . PREFIX . '_regions ' .
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

    function getOneCityIdByRegionId($region_id){
        global $db;

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_cities ' .
               'WHERE regions_go_id = ' . intval($region_id) . ' ' .
               'LIMIT 1';

        return $db->getOne($sql);
    }
}

?>