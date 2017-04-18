<?
/*
 * Title: car type class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class CarTypes extends Form {

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
							'table'				=> 'car_types'),
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
							'table'				=> 'car_types'),
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
							'table'				=> 'car_types'),
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
							'table'				=> 'car_types')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function CarTypes($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Типи транспортних засобів';
		$this->messages['single'] = 'Тип транспортних засобів';
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
					'change'	=> false,
					'delete'	=> false);
				break;
		}
	}

    function getList($data) {
        global $db;

        $conditions[] = 'parent_id = ' . PRODUCT_TYPES_AUTO;

        $sql =  'SELECT a.id, a.title, b.id as car_types_id, IF(ISNULL(b.code), b.title, CONCAT(b.title, \' \', b.code)) as car_typesTitle ' .
                'FROM ' . PREFIX . '_product_types as a ' .
                'JOIN ' . PREFIX . '_car_types as b ON a.id = b.product_types_id ' .
                'ORDER BY a.order_position, b.order_position';
        $list = $db->getAll($sql);

        $result = '';

        if (sizeOf($list)) {

            $i = 0;
            $size = sizeOf($list);

            while ($i < $size) {
                if ($id != $list[ $i ]['id']) {
                    $result .= '<tr><td class="label">Тип ТЗ. ' . $list[ $i ]['title'] . ':</td><td><select name="car_types_id[' . $list[ $i ]['id'] . ']" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'"><option value="">...</option>';
                    $id = $list[ $i ]['id'];
                }

                $result .= '<option value="' . $list[ $i ]['car_types_id'] . '" ' . ( ($data['car_types_id'][ $list[ $i ]['id'] ] == $list[ $i ]['car_types_id']) ? 'selected' : '') . '>' . $list[ $i ]['car_typesTitle'] . '</option>';

                $i++;

                if ($i == $size || $id != $list[ $i ]['id']) {
                    $result .= '</select></td></tr>';
                }

            }
        }

        return $result;
    }

    function getJavaScriptInWindow($data){
        global $db;

        $sql =  'SELECT id, title, 0 AS obligatory ' .
                'FROM ' . PREFIX . '_car_types ' .
                'WHERE product_types_id = ' . $data['product_types_id'] . ' ' .
                'ORDER BY order_position';
        $res = $db->query($sql);

        $result = "var types = new Array();\r\n";

        $i = 0;
        while ($res->fetchInto($row)) {
            $result .= "types[" . $i . "] = new Array('" . $row['id'] . "', '" . $row['title'] . "');\r\n";
            $i++;
        }

        echo $result;
        //exit;
    }
	
	function getListForHTML($data) {
		global $db;
		
		$conditions[] = '1';
		if ($data['product_types_id']) {
			if (is_array($data['product_types_id'])) {
				$conditions[] = 'product_types_id IN (' . implode(', ', $data['product_types_id']) . ')';
			} else {
				$conditions[] = 'product_types_id = ' . intval($data['product_types_id']);
			}
		}
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_car_types ' .
			   'WHERE ' . implode(' AND ', $conditions);
		$list = $db->getAll($sql);
		
		$result = '<select name="car_types_id[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';
		foreach ($list as $row) {
			$result .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['car_types_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
		}
		$result .= '</select>';
		
		return $result;
	}
	
	function getTitle($id) {
		global $db;
		
		$sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_car_types ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getListArray($data) {
		global $db;
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_car_types ' .
			   'WHERE ' . (isset($data['conditions']) ? $data['conditions'] : '1') . ' ' .
			   'ORDER BY order_position';
		return $db->getAll($sql);
		
	}
}

?>