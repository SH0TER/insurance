<?
/*
 * Title: car brand class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'CarModels.class.php';

class CarBrands extends Form {

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
							'table'				=> 'car_brands'),
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
							'table'				=> 'car_brands'),
						array(
							'name'				=> 'sng',
							'description'		=> 'Виробництво СНГ',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'change'	=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'car_brands'),
						array(
							'name'				=> 'synchronize',
							'description'		=> 'Синхронізувати з ЕК',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'change'	=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 3,
							'table'				=> 'car_brands'),
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
							'table'				=> 'car_brands'),
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
							'width'				=> 120,
							'table'				=> 'car_brands')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function CarBrands($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Марки';
		$this->messages['single'] = 'Марка';
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
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
		}
	}

	function view($data) {
		if (intval($data['car_brands_id'])) {
			$data['id'] = $data['car_brands_id'];
		}

		$row = parent::view($data);

		$data['car_brands_id'] = $row['id'];

		$fields[]		= 'car_brands_id';
		$conditions[]	= 'car_brands_id = ' . intval($data['car_brands_id']);

		$CarModels = new CarModels($data);
		$CarModels->show($data, $fields, $conditions);
	}

	function deleteProcess($data, $i=0, $folder=null) {
		global $db, $Log;

		$CarModels = new CarModels($data);

		$sql =	'SELECT id ' . 
				'FROM ' . $CarModels->tables[0] . ' ' .
				'WHERE car_brands_id IN (' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>Моделі</b>.');
			return false;
		}

		return parent::deleteProcess($data, $i, $folder);
	}

	function synhronize(&$data) {
		global $db, $Log;

		if (E_IX_SYNHRONIZATION != 1) return;

		$Client = new SoapClient(E_IX_URL . 'synchronization/express/index.php?wsdl');

		$type='carbrands';

		$result = $Client->synhronize(
					array(
						'type'	=> $type,
						'data'	=> serialize($data)));
	}

	 function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

		$data['id'] = parent::insert($data, false, $showForm);

        if (intval($data['id'])) {

			$this->synhronize($data);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
                exit;
            } else {
                return $data['id'];
            }
		}
    }

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

		if (parent::update(&$data, false, $showForm)) {

			$this->synhronize($data);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
                exit;
            } else {
                return $data['id'];
            }
		}
    }
	
	function getListForHTML($data) {
		global $db;
		
		$conditions[] = '1';
				
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_car_brands';
		$list = $db->getAll($sql);
		
		$result = '<select name="brands_id[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';
		foreach ($list as $row) {
			$result .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['brands_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
		}
		$result .= '</select>';
		
		return $result;
	}
	
	function getTitle($id) {
		global $db;
		
		$sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_car_brands ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getListJsonInWindow($data) {
        global $db;

        $conditions = array('1');

        if (intval($data['car_types_id'])) {
            $conditions[] = 'types_models.car_types_id = ' . intval($data['car_types_id']);
        }

        $sql = 'SELECT brands.id, brands.title ' .
               'FROM ' . PREFIX . '_car_brands as brands ' .
               'JOIN ' . PREFIX . '_car_models as models ON brands.id = models.car_brands_id ' .
               'JOIN ' . PREFIX . '_car_type_car_model_assignments as types_models ON models.id = types_models.car_models_id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .			   
               'GROUP BY brands.id ' . 
			   'ORDER BY brands.title';
        echo json_encode($db->getAll($sql));
    }
}

?>