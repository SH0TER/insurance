<?
/*
 * Title: MVS class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';

class MVS extends Form {

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
							'table'				=> 'mvs'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
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
							'orderPosition'		=> 1,
							'table'				=> 'mvs'),
                        array(
                            'name'              => 'regions_id',
                            'description'       => 'Область',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'mvs',
                            'sourceTable'       => 'regions',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'address',
                            'description'       => 'Адреса',
                            'type'              => fldText,
							'maxlength'			=> 100,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
							'orderPosition'		=> 3,
                            'table'             => 'mvs'),
                        array(
                            'name'              => 'edrpou',
                            'description'       => 'ЄДРПОУ',
                            'type'              => fldText,
							'maxlength'			=> 8,
							'validationRule'	=> '^([0-9]{8})$',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 4,
                            'table'             => 'mvs'),
                        array(
                            'name'              => 'bank_account',
                            'description'       => 'Розрахунковий рахунок',
                            'type'              => fldText,
							'maxlength'			=> 14,
							'validationRule'	=> '^([0-9]{12,14})$',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 5,
                            'table'             => 'mvs'),
                        array(
                            'name'              => 'bank',
                            'description'       => 'Банк',
                            'type'              => fldText,
							'maxlength'			=> 50,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 6,
                            'table'             => 'mvs'),
                        array(
                            'name'              => 'bank_mfo',
                            'description'       => 'МФО',
                            'type'              => fldText,
							'maxlength'			=> 6,
							'validationRule'	=> '^([0-9]{6})$',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 7,
                            'table'             => 'mvs'),
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
							'table'				=> 'mvs'),
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
							'orderPosition'		=> 8,
							'width'				=> 100,
							'table'				=> 'mvs')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function MVS($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Органи ДАІ';
		$this->messages['single'] = 'Органи ДАІ';
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
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db;

        $Accidents = Accidents::factory($data, 'KASKO');

        $sql =	'SELECT id ' .
                'FROM ' . $Accidents->tables[1] . ' ' .
                'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $Accidents->messages['plural'] . '</b>.');
			return false;
		}

        return parent::deleteProcess($data, $i, $folder);
    }
	
	function getTitle($id) {
		global $db;
		
		$sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_mvs ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getJSListInWindow($data) {
        global $db;

		$sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_mvs ' .
			   'ORDER BY title';

        $list = $db->getAll($sql);
        $result = 'var mvs_information = new Array();';
        $i = 0;
        foreach ($list as $row) {
            $result .= 'mvs_information[' . $i . '] = {id:' . $row['id'] . ', name:' . $db->quote(htmlspecialchars_decode($row['title'], ENT_QUOTES)) . '};';
            $i++;
        }
        echo $result;
    }
}

?>