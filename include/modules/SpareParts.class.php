<?
/*
 * Title: Profiles class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
 
 require_once 'SparePartGroups.class.php';
 require_once 'CarTypes.class.php';
 require_once 'CarBrands.class.php';
 require_once 'CarModels.class.php';
 require_once 'CarServices.class.php';

class SpareParts extends Form {

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
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'spare_part_groups_id',
							'description'		=> 'Група запчастин',
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
							'sourceTable'		=> 'spare_part_groups',
							'orderField'		=> 'id',
							'selectField'		=> 'title',
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'car_types_id',
							'description'		=> 'Тип ТЗ',
					        'type'				=> fldInteger,
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
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'brands_id',
							'description'		=> 'Марка ТЗ',
					        'type'				=> fldInteger,
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
							'orderPosition'		=> 3,
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'models_id',
							'description'		=> 'Модель ТЗ',
					        'type'				=> fldInteger,
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
							'orderPosition'		=> 4,
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'year',
							'description'		=> 'Рік випуску',
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
							'orderPosition'     => 5,
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'price',
							'description'		=> 'Ціна',
					        'type'				=> fldMoney,
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
							'orderPosition'     => 6,
							'table'				=> 'spare_parts'),
						array(
							'name'				=> 'notice',
							'description'		=> 'Опис',
					        'type'				=> fldNote,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'     => 7,
							'table'				=> 'spare_parts'),
						array(
							'name'             => 'car_services_id',
							'description'      => 'СТО',
							'type'             => fldInteger,
							'display'          =>
								array(
									'show'     => true,
									'insert'   => true,
									'view'     => true,
									'update'   => true
								),
							'verification'     =>
								array(
									'canBeEmpty'    => false
								),
							'orderPosition'     => 8,
							'table'            => 'spare_parts'),
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
							'orderPosition'		=> 9,
                            'width'             => 100,
							'table'				=> 'spare_parts'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 10,
                            'width'             => 100,
                            'table'             => 'spare_parts')
						
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function SpareParts($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Запчастини';
		$this->messages['single'] = 'Запчастини';
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
					'view'	    => true,
                    'export'    => true);
				break;
			case ROLES_MASTER:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> false,
					'delete'	=> false,
					'view'	    => true,
                    'export'    => false);
				break;
		}
	}
	
	function uploadFiles($data) {
		global $db;
		
		$files = array();
		
		if (eregi('update', $data['do'])) {
			$sql = 'SELECT files ' . 
				   'FROM ' . PREFIX . '_spare_parts ' .
				   'WHERE id = ' . intval($data['id']);
			$files_db = unserialize($db->getOne($sql));
			
			foreach ($files_db as $i => $file_db) {
				if (in_array($i, $data['del_db'])) {continue;
					$this->unlink($file_db['name_sys']);
				} else {
					$files[] = $file_db;
				}
			}
		}
			
		foreach ($_FILES['file']['tmp_name'] as $i => $tmp_name) {	
			if (!strlen($tmp_name)) continue;
			
			$name_sys = $this->uploadFileToServer('/files' . $Authorization->data['folder'] . '/' . $this->object, $i);

			if ($name_sys != false) {

				$file = array('name_sys' => $name_sys, 'name_load' => $_FILES['file']['name'][$i]);
				
				$files[] = $file;
			}
		}

		$sql = 'UPDATE ' . PREFIX . '_spare_parts SET files = ' . $db->quote(serialize($files)) . ' WHERE id = ' . intval($data['id']);
		$db->query($sql);
		
	}
	
	function unlink($filename) {
        global $Authorization;

        return ($filename != '')
        ? unlink($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $filename)
        : false;
    }
	
	function uploadFileToServer($path, $i, $nameType=null) {
        $path = $_SERVER['DOCUMENT_ROOT'] . $path;

        if (is_file($_FILES['file']['tmp_name'][$i])) {
            $filename = $this->generateFilename($_FILES['file']['name'][$i], $nameType);
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $path . '/' . $filename) ? 1 : 2;
			
			chmod($path . '/' . $filename, 0664);

			return $filename;
        } else {
			return false;
		}        
    }
	
	function getFiles($id) {
		global $db;
		
		$sql = 'SELECT files ' .
			   'FROM ' . PREFIX . '_spare_parts ' .
			   'WHERE id = ' . intval($id);
		
		return unserialize($db->getOne($sql));
	}
	
	function downloadFileInWindow($data) {
        global $db;

        $file = unserialize($data['file']);

        if (is_file($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $file['name_sys'])) {

            $result = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $file['name_sys']);

            header('Content-Disposition: attachment; filename="' . $file['name_sys'] . '"');
            header('Content-Type: ' . $this->getContentType($file['name_sys']));
            header('Content-Length: ' . strlen($result));

            echo $result;
            exit;
        }
    }
	
	function insert($data) {
		global $Log, $db;
	
		$data['id'] = parent::insert(&$data, false, true);
		
		$params['title']    = $this->messages['single'];
		$params['id']       = $data['id'];
		$params['storage']  = $this->tables[0];
		
		if($data['id'] > 0) {
			$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			header("Location: /index.php?do=SpareParts|show");
			exit;
		}		
	}
	
	function update($data) {
		global $Log, $db;

		$data['id'] = parent::update(&$data, false, true);
		
		$params['title']    = $this->messages['single'];
		$params['id']       = $data['id'];
		$params['storage']  = $this->tables[0];
		
		if($data['id'] > 0) {
			$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			header("Location: /index.php?do=SpareParts|show");
			exit;
		}		
	}
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='SpareParts/show.php', $limit=true) {
		global $db, $Authorization;
		
		if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['permissions']['SpareParts']['show']) {
			$SparePartGroups = new SparePartGroups($data);
			$SparePartGroups->show($data);
		}
		
		$conditions[] = '1';
		
		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$conditions[] = PREFIX . '_spare_parts.spare_part_groups_id = ' . intval($data['spare_part_groups_id']);
		}
		
		if (intval($data['spare_part_groups_id'])) {
			$conditions[] = PREFIX . '_spare_parts.car_services_id = ' . intval($Authorization->data['car_services_id']);
		}
		
		$sql = 'SELECT ' . PREFIX . '_spare_parts.id as id, ' . PREFIX . '_spare_part_groups.title as spare_part_groups_id, ' . PREFIX . '_car_types.title as car_types_id, ' . PREFIX . '_car_brands.title as brands_id, ' .
					PREFIX . '_car_models.title as models_id, ' . PREFIX . '_spare_parts.year, ' . PREFIX . '_spare_parts.price, ' . PREFIX . '_spare_parts.notice, ' .
					PREFIX . '_car_services.title as car_services_id, ' .
					'date_format(' . PREFIX . '_spare_parts.modified, \'%d.%m.%Y\') as modified_format, date_format(' . PREFIX . '_spare_parts.created, \'%d.%m.%Y\') as created_format ' .
				'FROM ' . PREFIX . '_spare_parts ' .
				'JOIN ' . PREFIX . '_spare_part_groups ON ' . PREFIX . '_spare_parts.spare_part_groups_id = ' . PREFIX . '_spare_part_groups.id ' .
				'JOIN ' . PREFIX . '_car_types ON ' . PREFIX . '_spare_parts.car_types_id = ' . PREFIX . '_car_types.id ' .
				'JOIN ' . PREFIX . '_car_brands ON ' . PREFIX . '_spare_parts.brands_id = ' . PREFIX . '_car_brands.id ' .
				'JOIN ' . PREFIX . '_car_models ON ' . PREFIX . '_spare_parts.models_id = ' . PREFIX . '_car_models.id ' .
				'JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_spare_parts.car_services_id = ' . PREFIX . '_car_services.id ' .
				'WHERE ' . implode(' AND ', $conditions);

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
	
	function view($data) {
		parent::view($data, null, null, $template='form.php', $showForm=true);
	}

    function exportInWindow($data) {
        global $db, $Log;
		
		$this->setTables('show');
        $this->setShowFields();

        $conditions[] = '1';
		
		if (intval($data['spare_part_groups_id'])) {
			$conditions[] = PREFIX . '_spare_parts.spare_part_groups_id = ' . intval($data['spare_part_groups_id']);
		}
		
		$sql = 'SELECT ' . PREFIX . '_spare_parts.id as id, ' . PREFIX . '_spare_part_groups.title as spare_part_groups_id, ' . PREFIX . '_car_types.title as car_types_id, ' . PREFIX . '_car_brands.title as brands_id, ' .
					PREFIX . '_car_models.title as models_id, ' . PREFIX . '_spare_parts.year, ' . PREFIX . '_spare_parts.price, ' . PREFIX . '_spare_parts.notice, ' .
					'date_format(' . PREFIX . '_spare_parts.modified, \'%d.%m.%Y\') as modified_format, date_format(' . PREFIX . '_spare_parts.created, \'%d.%m.%Y\') as created_format ' .
				'FROM ' . PREFIX . '_spare_parts ' .
				'JOIN ' . PREFIX . '_spare_part_groups ON ' . PREFIX . '_spare_parts.spare_part_groups_id = ' . PREFIX . '_spare_part_groups.id ' .
				'JOIN ' . PREFIX . '_car_types ON ' . PREFIX . '_spare_parts.car_types_id = ' . PREFIX . '_car_types.id ' .
				'JOIN ' . PREFIX . '_car_brands ON ' . PREFIX . '_spare_parts.brands_id = ' . PREFIX . '_car_brands.id ' .
				'JOIN ' . PREFIX . '_car_models ON ' . PREFIX . '_spare_parts.models_id = ' . PREFIX . '_car_models.id ' .
				'WHERE ' . implode(' AND ', $conditions);
		
		$list = $db->getAll($sql);

        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));

        include_once $this->object . '/excel.php';
        exit;
    }

}

?>