<?
/*
 * Title: DMS service class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class DMSServices extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                	=> 'id',
                            'type'                	=> fldIdentity,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'                	=> 'dms_services'),
                        array(
                            'name'                	=> 'title',
                            'description'        	=> 'Назва',
                            'type'                	=> fldUnique,
                            'maxlength'            	=> 150,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 1,
                            'table'                	=> 'dms_services'),
  						array(
							'name'				    => 'price',
							'description'		    => 'Вартість',
					        'type'				    => fldMoney,
							'display'			    => 
								array(
									'show'		    => false,
									'insert'	    => true,
									'view'		    => true,
									'update'	    => true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				    => 'dms_services'),
                        array(
                            'name'                	=> 'parent_id',
                            'description'        	=> 'Тип',
                            'type'                	=> fldHidden,
                            'structure'            	=> 'tree',
                            'condition'            	=> 'parent_id=0',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                	=> 'dms_services'),
                        array(
                            'name'                	=> 'created',
                            'description'        	=> 'Створено',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'dms_services'),
                        array(
                            'name'                	=> 'modified',
                            'description'        	=> 'Редаговано',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 2,
                            'width'             	=> 100,
                            'table'                	=> 'dms_services')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    	=> 1,
                        'defaultOrderDirection'    	=> 'asc',
                        'titleField'            	=> 'title'
                    )
            );

    function DMSServices($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Послуги';
        $this->messages['single'] = 'Послуга';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'    	=> true,
                    'insert'    => true,
                    'update'    => true,
                    'view'    	=> true,
                    'change'    => false,
                    'delete'    => false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_AGENT:                
				if(in_array($Authorization->data['agencies_id'], array(AGENCY_SATIS, 556))) {
					$this->permissions = array(
						'insert'	=> true,
						'update'	=> true,
						'view'		=> true,
						'change'	=> false);
				}
				$this->permissions['show'] = true;
                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

        $fields     = array('parent_id');
        $conditions = array('parent_id = ' . intval($data['parent_id']));

        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }

    function view($data) {
		global $Authorization;

        $row = parent::view($data);

        if (!intval($row['parent_id'])) {
            $data['parent_id'] = $row['id'];
            $this->setObjectTitle('sub' . $this->objectTitle);

            $this->show($data);
        }
    }

    function deleteProcess($data, $i=0) {
        global $db, $Log;

        $sql =  'SELECT id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE parent_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $this->messages['plural'] . '</b>.');
            return false;
        }

        parent::deleteProcess($data);
    }
}

?>