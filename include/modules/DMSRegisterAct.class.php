<?
/*
 * Title: DMS service class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
 
require_once 'DMSCalculation.class.php';

class DMSRegisterAct extends Form {

	var $statuses = array(
		1	=>	'створено',
		2	=>	'передано',
		3	=>	'оплачено'
	);

	var $calculations = null;

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
                            'table'                	=> 'dms_register_act'),
						array(
                            'name'                	=> 'date',
                            'description'        	=> 'Дата',
                            'type'                	=> fldDate,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'			=> 1,
                            'table'                	=> 'dms_register_act'),
  						array(
							'name'				    => 'status',
							'description'		    => 'Статус',
					        'type'				    => fldInteger,
							'display'			    => 
								array(
									'show'		    => true,
									'insert'	    => false,
									'view'		    => true,
									'update'	    => true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'			=> 2,
							'table'				    => 'dms_register_act'),  
						array(
							'name'                  => 'file',
							'description'           => 'Файл',
							'type'                  => fldFile,
							'format'                => '.*\.(jpg|jpeg|gif|png|doc|xls|zip|pdf|txt|docx|xlsx|7z|rar|tif|bmp|rtf)$',
							'display'               =>
								array(
									'show'          => true,
									'insert'        => false,
									'view'          => false,
									'update'        => false
								),
							'verification'          =>
								array(
									'canBeEmpty'    => false
								),
							'orderPosition'         => 3,
							'table'                 => 'dms_register_act'),
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
                            'table'                	=> 'dms_register_act'),
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
                            'orderPosition'        	=> 4,
                            'width'             	=> 100,
                            'table'                	=> 'dms_register_act')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    	=> 1,
                        'defaultOrderDirection'    	=> 'asc',
                        'titleField'            	=> 'date'
                    )
            );

    function DMSRegisterAct($data) {
        Form::Form($data);
		
		$this->object = 'DMSRegisterAct';
		$this->objectTitle = 'DMSRegisterAct';

        $this->messages['plural'] = 'Акти';
        $this->messages['single'] = 'Акт';
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
                    'delete'    => true);
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

    function show($data, $fields=null, $conditions=null, $sql=null, $template='DMSRegisterAct/show.php', $limit=true) {
	
		if (!$this->permissions['show']) return;

        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }

    function view($data, $showForm=true, $action='view', $actionType='view', $template='form.php') {
        global $db;

        $this->mode = 'view';

        if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

        $this->setTables('view');
        $this->getFormFields('view');

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);
		
		$this->calculations = DMSCalculation::getCalculationsByRegisterActId($data['id']);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }
	
	function insert($data) {
		global $db, $Log;
		
		$data['registerActId'] = parent::insert(&$data, false, true);

        if ($data['registerActId']) {
		
			$this->setRelation($data['registerActId']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|show&product_types_id=' . PRODUCT_TYPES_DMS);
            exit;
        }
    }
	
	function setRelation($id) {
		global $db;
		
		$sql = 'UPDATE ' . PREFIX . '_dms_calculation ' .
			   'SET register_act_id = ' . intval($id) . ' ' .
			   'WHERE id IN (' . implode(', ', $this->calculations) . ')';
		$db->query($sql);
	}
	
	function checkFields(&$data, $action) {
		global $db, $Log;
		
		parent::checkFields($data, $action);
		if ($Log->isPresent()) return;
		
		$date = $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'];
		$this->calculations = DMSCalculation::getCalculationsByDate($date);
		
		if ((!is_array($this->calculations) || !sizeOf($this->calculations)) && $action == 'insert') {
			$Log->add('error', 'На вказану дату калькуляцій не знайдено');
		}
		
		if (!intval($data['status']) && $action == 'update') $Log->add('error', 'Виберіть статус');
	}

    function deleteProcess($data, $i=0) {
        global $db, $Log;

		$statusMessage = 'confirm';
		$textMessage = 'Усі акти вилучено';
		foreach($data['id'] as $id) {
			$sql = 'SELECT status FROM ' . PREFIX . '_dms_register_act WHERE id = ' . intval($id);
			$status = $db->getOne($sql);
			
			if (intval($status) == 1) {
				$sql = 'DELETE FROM ' . PREFIX . '_dms_register_act WHERE id = ' . intval($id);
				$db->query($sql);
				
				$sql = 'UPDATE ' . PREFIX . '_dms_calculation ' .
					   'SET register_act_id = 0 ' .
					   'WHERE register_act_id = ' . intval($id);
				$db->query($sql);
			} else {
				$statusMessage = 'error';
				$textMessage = 'Вилучено не усі акти';
			}
		}

        $Log->add($statusMessage, $textMessage);
		header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|show&product_types_id=' . PRODUCT_TYPES_DMS);
		exit;
    }
	
	function downloadFileInWindow($data) {
		global $db, $Smarty;
		
		$file = unserialize($data['file']);
		
		$sql = 'SELECT * FROM ' . PREFIX . '_dms_register_act WHERE id = ' . intval($file['id']);
		$registerAct = $db->getRow($sql);
		
		$sql = 'SELECT date_input as calculationDate, a.amount as calculationAmount, b.number as policiesNumber, CONCAT_WS(\' \', c.insured_lastname, c.insured_firstname, c.insured_patronymicname) as insured, ' .
					'b.price as insurancePrice, date_format(b.begin_datetime, \'%d.%m.%Y\') as policiesBeginDate, date_format(b.interrupt_datetime, \'%d.%m.%Y\') as policiesEndDate ' .
			   'FROM ' . PREFIX . '_dms_calculation a ' .
			   'JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id ' .
			   'JOIN ' . PREFIX . '_policies_dms c ON b.id = c.policies_id ' .
			   'WHERE a.register_act_id = ' . intval($file['id']);
		$calculations = $db->getAll($sql);
				
		$Smarty->assign('registerAct', $registerAct);
		$Smarty->assign('calculations', $calculations);
		
		$file['name'] 		= 'dms_register_act_' . $registerAct['date'];
		$file['content']    = $Smarty->fetch('../files/ProductDocuments/dms_register_act.tpl');
		
		//echo $file['content'];exit;
		html2pdf($file);
		
	}
	
	
	function getXML($data) {
		global $db, $Smarty;

		if ($data['number']) {
			$data['number'] = str_replace('1011-','',$data['number']);
			
            $conditions[] = 'a.date = ' . $db->quote($data['number']);

			$sql =	'SELECT a.date, concat(\'1011-\',a.date) as number, b.amount as act_amount , c.number as policy_number,d.insured_passport_series,d.insured_passport_number,d.insured_passport_place,d.insurer_passport_date,d.insured_lastname,d.insured_firstname,d.insured_patronymicname  ' .
					'FROM  insurance_dms_register_act AS a ' .
                    'JOIN insurance_dms_calculation as b ON b.register_act_id= a.id ' .
					'JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
					'JOIN insurance_policies_dms d ON d.policies_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions);
		    $list = $db->getAll($sql);

			
        } else {
			$list= array();
		}

        $Smarty->assign('list', $list);

        return $Smarty->fetch($this->object . '/act_dms.xml');
	}
	
}

?>