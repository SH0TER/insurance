<?
/*
 * Title: city class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Cities extends Form {
 
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
							'table'				=> 'cities'),
						array(
							'name'				=> 'regions_id',
							'description'		=> 'Терирорія переважного використання траспортного засобу, КАСКО',
					        'type'				=> fldSelect,
                            'condition'         => 'product_types_id = 1',//заточил под все кроме ГО
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
							'table'				=> 'cities',
							'sourceTable'		=> 'parameters_regions',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'regions_go_id',
							'description'		=> 'Терирорія переважного використання траспортного засобу, ЦВ',
					        'type'				=> fldSelect,
                            'condition'         => 'product_types_id = 4',//заточил под го
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
							'table'				=> 'cities',
							'sourceTable'		=> 'parameters_regions',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'regions_kasko_retail_id',
							'description'		=> 'Терирорія переважного використання траспортного засобу, КАСКО ритейл',
					        'type'				=> fldSelect,
                            'condition'         => 'product_types_id = 3',//заточил под КАСКО
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
							'table'				=> 'cities',
							'sourceTable'		=> 'parameters_regions',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),	
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
							'table'				=> 'cities'),
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
							'table'				=> 'cities'),
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
							'orderPosition'		=> 4,
                            'width'             => 100,
							'table'				=> 'cities')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Cities($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Міста';
		$this->messages['single'] = 'Місто';
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
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;

		}
	}

	function isExists($table, $field, $value, $id = 0, $data = null) {
		global $db;

		$sql =	'SELECT count(*) ' .
				'FROM ' . PREFIX . '_cities ' .
				'WHERE title = ' . $db->quote($value) . ' AND id <> ' . intval($id);
		$count = $db->getOne($sql);

		return ($count != 0);
	}

    function getRegionsId($id, $field='regions_go_id') {
        global $db;

        $sql =  'SELECT ' . $field . ' ' .
                'FROM ' . PREFIX . '_cities ' .
                'WHERE id = ' . intval($id);
        return $db->getOne($sql, 30*60);
    }

    function getCitiesListInWindow($data) {
        global $db;

        if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
            $sql = 'SELECT id, regions_go_id, title ' .
                   'FROM ' . PREFIX . '_cities ' .
                   'WHERE regions_go_id > 0 ' .
                   'ORDER BY title';
        }

        $list = $db->getAll($sql);

        $result = 'var cities = new Array();';
        $i = 0;
        foreach ($list as $row) {
            $result .= 'cities[' . $i . '] = {id:' . $row['id'] . ', name:' . $db->quote($row['title']) . ', regions_go_id:' . $row['regions_go_id'] . '};';
            $i++;
        }
        echo $result;
    }
}

?>