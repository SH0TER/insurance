<?

class DMSCalculation extends Form {

	var $formDescription = array(
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
					'table'				=> 'dms_calculation'),
				array(
					'name'				=> 'policies_id',
					'description'		=> 'Договір',
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
					'orderPosition'		=> -1,
					'table'				=> 'dms_calculation'),
				array(
					'name'				=> 'date_input',
					'description'		=> 'Дата',
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
					'table'				=> 'dms_calculation'),
				array(
					'name'				=> 'clinik',
					'description'		=> 'Клініка',
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
					'table'				=> 'dms_calculation'),
				array(
					'name'				=> 'diagnos',
					'description'		=> 'Діагноз',
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
					'table'				=> 'dms_calculation'),
				array(
					'name'				=> 'amount',
					'description'		=> 'Сума калькуляції',
					'type'				=> fldAmount,
					'input'				=> true,
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
					'table'				=> 'dms_calculation'),
				array(
					'name'				=> 'date',
					'description'		=> 'Дата калькуляції',
					'type'				=> fldDate,
					'input'				=> true,
					'display'			=> 
						array(
							'show'		=> true,
							'insert'	=> true,
							'view'		=> false,
							'update'	=> false
						),
					'verification'		=>
						array(
							'canBeEmpty'	=> false
						),
					'orderPosition'		=> 2,
					'table'				=> 'dms_calculation'),
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
					'table'                 => 'dms_calculation'),
				array(
					'name'             => 'content',
					'description'      => 'Перелік позицій',
					'type'             => fldHidden,
					'display'          =>
						array(
							'show'     => false,
							'insert'   => true,
							'view'     => true,
							'update'   => true
						),
					'verification'     =>
						array(
							'canBeEmpty'    => false
						),
					'orderPosition'		=> -2,
					'table'            => 'dms_calculation'),
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
					'orderPosition'		=> 4,
					'table'				=> 'dms_calculation'),
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
					'orderPosition'		=> 5,
					'table'				=> 'dms_calculation'),
			),
		'common'	=>
			array(
				'defaultOrderPosition'	=> 1,
				'defaultOrderDirection'	=> 'desc',
				'titleField'			=> 'date'
			)
	);
	
	function DMSCalculation($data) {
		Form::Form($data);
		
		$this->objectTitle = 'DMSCalculation';

		$this->messages['plural'] = 'Калькуляції';
		$this->messages['single'] = 'Калькуляція';
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
					'delete'	=> true,
					'change'	=> true);
				break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				$this->permissions['show'] = true;
				$this->permissions['view'] = true;
				break;
            case ROLES_AGENT:                
				if(in_array($Authorization->data['agencies_id'], array(AGENCY_SATIS, 556))) {
					$this->permissions = array(
						'insert'	=> true,
						'update'	=> true,
						'view'		=> true,
						'change'	=> false,
						'delete'	=> true);
				}
				$this->permissions['show'] = true;
                break;
		}
	}
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='DMSCalculation/show.php', $limit=true) {

		$conditions[] = 'policies_id = ' . intval($data['policies_id']);

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
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

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }
	
	function add($data) {
		parent::showForm($data, 'insert');
	}
	
	function setConstants(&$data) {
		
		if (!intval($data['id'])) {
			$data['date'] = date('Y-m-d');
			$data['date_day'] = date('d');
			$data['date_month'] = date('m');
			$data['date_year'] = date('Y');
		}
		
		$content = array();
		$amount = 0;
		foreach($data['positions'] as $position) {
			$position["price"] = str_replace(",", ".", $position["price"]);
			$content[] = array(
				'category'	=>	$position['category'],
				'service'	=>	$position['service'],
				'count'		=>	$position['count'],
				'price'		=>	$position['price']
			);
			
			$amount += floatval($position['price'] * $position['count']);
		}
		
		$data['content'] = json_encode($content);
		$data['amount'] = $amount;
		
	}
	
	function getServicePrice($id) {
		global $db;
		
		$sql = 'SELECT price FROM ' . PREFIX . '_dms_services WHERE id = ' . intval($id);
		return floatval($db->getOne($sql));
	}
	
	function prepareFields($action, $data) {
		$data = parent::prepareFields($action, $data);
	
        $data['positions'] = json_decode($data['content']);

        return $data;
    }
	
	function checkFields(&$data, $action) {
		global $Log;

        parent::checkFields($data, $action);
		
		$i = 1;
		foreach($data['positions'] as $position) {
			
			if (intval($position['category']) == - 1) $Log->add('error', 'Позиція ' . $i . ': поле <b>Категорія</b> обов\'язкове для заповнення');
			if (intval($position['service']) == -1) $Log->add('error', 'Позиція ' . $i . ': поле <b>Назва</b> обов\'язкове для заповнення');
			if (!floatval($position['price']) || floatval($position['price']) <= 0) $Log->add('error', 'Позиція ' . $i . ': поле <b>Вартість</b> обов\'язкове для заповнення');
			if (!intval($position['count']) || intval($position['count']) <= 0) $Log->add('error', 'Позиція ' . $i . ': поле <b>Кількість</b> обов\'язкове для заповнення');
			$i++;
		}
	}
	
	function insert($data) {
		global $db, $Log;
		
		$data['calculationId'] = parent::insert(&$data, false, true);

        if ($data['calculationId']) {

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|view&product_types_id=' . PRODUCT_TYPES_DMS . '&id=' . intval($data['policies_id']));
            exit;
        }
    }
	
	function getServicesInWindow($data) {
		global $db;
		
		$orderBy = array();
		
		$services = array();
		
		$sql = 'SELECT id, title, parent_id, price ' .
			   'FROM ' . PREFIX . '_dms_services ' .
			   'ORDER BY parent_id, title ASC';
		$list = $db->getAll($sql);
		
		$order = 0;
		foreach($list as $row) {
			
			if (intval($row['parent_id'])) {
				$services[ $orderBy[ $row['parent_id'] ] ]['list'][ ] = array(
					'id'	=>	$row['id'],
					'title'	=>	$row['title'],
					'price'=>	$row['price']
				);
			} else {
				$services[ $order ] = array();
				$services[ $order ]['id'] = $row['id'];
				$services[ $order ]['title'] = $row['title'];
				$services[ $order ]['list'] = array();
				$orderBy[ $row['id'] ] = $order;
				$order++;
			}
			
		}
		
		echo json_encode($services);
		exit;
	}
	
	function downloadFileInWindow($data) {
		global $db, $Smarty;
		
		require_once 'NCLNameCase/NCL.NameCase.ua.php';
		$nc = new NCLNameCaseUa();
		
		$file = unserialize($data['file']);
		
		$sql = 'SELECT * FROM ' . PREFIX . '_dms_calculation WHERE id = ' . intval($file['id']);
		$calculation = $db->getRow($sql);
		
		$calculation['positions'] = array();
		
		$positions = json_decode($calculation['content']);
		
		$i = 1;
		foreach($positions as $key => $position) {
			$position = (array) $position;
			
			$sql = 'SELECT title, price FROM ' . PREFIX . '_dms_services WHERE id = ' . intval($position['service']);
			$service = $db->getRow($sql);
			
			$calculation['positions'][] = array(
				'num'	=>	$i,
				'name'	=>	$service['title'],
				'count'	=>	$position['count'],
				'amount'=>	floatval($position['count'] * $position['price'])
			);
			$i++;
		}

		$sql = 'SELECT b.number as policiesNumber, c.insured_lastname as insured_lastname, c.insured_firstname as insured_firstname, c.insured_patronymicname as insured_patronymicname ' .
			   'FROM ' . PREFIX . '_dms_calculation a ' .
			   'JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id ' .
			   'JOIN ' . PREFIX . '_policies_dms c ON b.id = c.policies_id ' .
			   'WHERE a.id = ' . intval($file['id']);
		$policy = $db->getRow($sql);
		
		$policy['insured'] = $nc->qFullName($policy['insured_lastname'], $policy['insured_firstname'], $policy['insured_patronymicname'], null, NCL::$UaRodovyi);
		
		$Smarty->assign('calculation', $calculation);
		$Smarty->assign('policy', $policy);
		
		$file['name'] 		= 'dms_calculation_' . $calculation['policies_id'] . '_' . $calculation['id'];
		$file['content']    = $Smarty->fetch('../files/ProductDocuments/dms_calculation.tpl');
		
//		echo $file['content'];exit;
		html2pdf($file);
		
	}
	
	function getCalculationsByDate($date) {
		global $db;
		
		$sql = 'SELECT a.id ' .
			   'FROM ' . PREFIX . '_dms_calculation a ' .
			   'JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id ' .
			   'WHERE a.date <= ' . $db->quote($date) . ' AND b.payment_statuses_id > 1 AND a.register_act_id = 0';
		return $db->getCol($sql);
	}
	
	function getCalculationsByRegisterActId($id) {
		global $db;
		
		$sql = 'SELECT b.number, concat_ws(\' \', c.insured_lastname, c.insured_firstname, c.insured_patronymicname) as insured, date_format(a.date, \'%d.%m.%Y\') as date, a.amount ' .
			   'FROM ' . PREFIX . '_dms_calculation a ' .
			   'JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id ' .
			   'JOIN ' . PREFIX . '_policies_dms c ON b.id = c.policies_id ' .
			   'WHERE a.register_act_id = ' . intval($id);
		return $db->getAll($sql);
	}

}

?>