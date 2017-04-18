<?
/*
 * Title: car service class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'CarServicesBankingDetails.class.php';
require_once 'CarServicesPriority.class.php';

class CarServices extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'					=> 'id',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'code',
                            'description'       	=> 'Код',
                            'type'                	=> fldUnique,
                            'maxlength'            	=> 10,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> true,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 1,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'title',
                            'description'        	=> 'Назва',
                            'type'                	=> fldUnique,
                            'maxlength'            	=> 100,
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
                            'orderPosition'        	=> 2,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'regions_id',
                            'description'        	=> 'Область',
                            'type'                	=> fldSelect,
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
                            'orderPosition'        	=> 3,
                            'table'                	=> 'car_services',
                            'sourceTable'        	=> 'regions',
                            'selectField'        	=> 'title',
                            'orderField'        	=> 'order_position'),
                        array(
                            'name'                	=> 'address',
                            'description'        	=> 'Адреса',
                            'type'                	=> fldText,
							'maxlength'				=> 100,
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'edrpou',
                            'description'        	=> 'ЄДРПОУ',
                            'type'                	=> fldUnique,
							'maxlength'				=> 10,
							'validationRule'		=> '^([0-9]{8,10})$',
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
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'axapta',
                            'description'        	=> 'Axapta',
                            'type'                	=> fldText,
							'maxlength'				=> 3,
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
                            'orderPosition'        	=> 4,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'bank_account_old',
                            'description'        	=> 'Розрахунковий рахунок',
                            'type'                	=> fldText,
							'maxlength'				=> 14,
							'validationRule'		=> '^([0-9]{9,14})$',
                            'display'            	=>
                                array(
                                     'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'bank_old',
                            'description'        	=> 'Банк',
                            'type'                	=> fldText,
							'maxlength'				=> 50,
                            'display'            	=>
                                array(
                                     'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'bank_mfo_old',
                            'description'        	=> 'МФО',
                            'type'                	=> fldText,
							'maxlength'				=> 6,
							'validationRule'		=> '^([0-9]{6})$',
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'ukravto',
                            'description'        	=> 'Корпорація "УкрАВТО"',
                            'type'                	=> fldBoolean,
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
                            'orderPosition'        	=> 5,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'tis',
                            'description'        	=> 'ТіС',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true,
                                    'change'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 6,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'parent_id',
                            'description'        	=> 'СТО',
                            'type'                	=> fldHidden,
                            'structure'            	=> 'tree',
                            'searchType'        	=> 'attribute',
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
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'active',
                            'description'        	=> 'Активний',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true,
                                    'change'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 7,
                            'width'                	=> 100,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'go',
                            'description'        	=> 'ОСЦПВ',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true,
                                    'change'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'width'                	=> 100,
                            'table'                	=> 'car_services'),
                        array(
                            'name'                	=> 'created',
                            'description'        	=> 'Створено',
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
                            'orderPosition'        	=> 8,
                            'table'                	=> 'car_services'),
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
                            'orderPosition'        	=> 9,
                            'width'                	=> 100,
                            'table'                	=> 'car_services')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  	=> 1,
                        'defaultOrderDirection'		=> 'asc',
                        'titleField'				=> 'title'
                    )
            );

    function CarServices($data) {
        Form::Form($data);

        $this->messages['plural'] = 'СТО';
        $this->messages['single'] = 'СТО';

		$this->renumerate = true;
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'    	=> true,
                    'insert'    => true,
                    'update'   	=> true,
                    'view'    	=> true,
                    'change'    => true,
                    'delete'    => true,
                    'export'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

    function setTables($action=null) {
        parent::setTables($action);

        if ($action == 'delete') {
            $this->tables = array($this->tables[0]);
        }
    }

    function getShowOrderCondition() {
        $direction = (ereg('^(asc|desc)$', $_COOKIE[ $this->object ]['orderDirection']))
            ? $_COOKIE[ $this->object ]['orderDirection']
            : $this->formDescription['common']['defaultOrderDirection'];

        $field = $this->getFieldNameByOrderPosition($_COOKIE[$this->object]['orderPosition']);

        if ($field == PREFIX . '_car_services.code') {
            $field = 'CAST(' . PREFIX . '_car_services.code AS UNSIGNED)';
        }

        return ($field)
            ? $field . ' ' . $direction
            : $this->getFieldNameByOrderPosition($this->formDescription['common']['defaultOrderPosition']) . ' ' . $direction;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        $template = $this->objectTitle . '/' . $template;

        $fields[]        = 'parent_id';
        $conditions[]    = 'parent_id = ' . intval($data['parent_id']);
        $conditions[]    = 'insurance_car_services.title LIKE \'%' . $data['title'] . '%\'';

        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }


    function setCode($id, $parent_id) {
        global $db;

        $code = '';

        if ($parent_id != 0) {
            $sql =  'SELECT MAX(CAST(SUBSTRING_INDEX(code, \'.\', -1) AS UNSIGNED)) ' .
                    'FROM ' . $this->tables[0] . ' as a ' .
                    'WHERE parent_id = ' . intval($parent_id);
            $code = $db->getOne($sql);

            $code = ($code > 0) ? $parent_id . '.' . ($code + 1) : $parent_id . '.1';
        } else {
            $code = $id;
        }

        $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                'code = ' . $db->quote($code) . ' ' .
                'WHERE id = ' .intval($id);
        $db->query($sql);
    }

    function insert($data, $redirect=true) {
        global $Log;

        $data['id'] = parent::insert($data, false);

        if ($data['id']) {

            $this->setCode($data['id'], $data['parent_id']);

            if ($redirect) {
                $params['title']	= $this->messages['single'];
                $params['id']		= $data['id'];
                $params['storage']	= $this->tables[0];

				if ($redirect) {
					$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

					header('Location: ' . $data['redirect']);
					exit;
				}
            } else {
                return $params['id'];
            }
        }
    }

    function view($data) {
        if (intval($data['car_services_id'])) {
            $data['id'] = $data['car_services_id'];
        }

        $row = parent::view($data);

		if (!intval($row['parent_id'])) {
			$data['parent_id'] = $row['id'];
			$this->setObjectTitle('sub' . $this->objectTitle);

			$this->show($data);
		}

        $data['car_services_id'] = $row['id'];

        $fields     = array('car_services_id');
        $conditions = array('car_services_id = ' . intval($data['car_services_id']));

        $CarServicesBankingDetails = new  CarServicesBankingDetails($data);
        $CarServicesBankingDetails->show($data, $fields, $conditions);

        $Masters = Users::factory($data, 'Masters');
        $Masters->show($data, $fields, $conditions);

        $CarServicesPriority = new CarServicesPriority($data);
        $CarServicesPriority->show($data, $fields, $conditions);
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_accidents ' .
                'WHERE car_services_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>Випадки</b>.');
            return false;
        }

        $Masters = Users::factory($data, 'Masters');

        $sql =  'SELECT accounts_id ' .
                'FROM ' . $Masters->tables[1] . ' ' .
                'WHERE car_services_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $Masters->messages['plural'] . '</b>.');
            return false;
        }

        return parent::deleteProcess($data, $i, $folder);
    }

    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $sql =  'SELECT a.*, b.title AS regions_title ' .
                'FROM ' . $this->tables[0] . ' AS a ' .
                'JOIN ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
                'ORDER BY CAST(a.code AS UNSIGNED), a.title';
        $list = $db->getAll($sql, 60 * 60);

        $Smarty->assign('list', $list);

        $result = $Smarty->fetch($this->object . '/export.tpl');

        header('Content-Disposition: attachment; filename="car_services.xls"');
        header('Content-Type: ' . $this->getContentType('car_services.xls'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

	function getList() {
		global $db;

		$sql =	'SELECT a.id, CONCAT(a.title,\'-\' , b.bank) as car_services_title, ' .
                'a.edrpou as edrpou, b.bank_edrpou, b.bank as bank, b.bank_mfo as bank_mfo, b.bank_account as bank_account ' .
				'FROM ' . PREFIX . '_car_services as a ' .
                'JOIN ' . PREFIX . '_car_services_banking_details as b ' .
                'ON a.id = b.car_services_id ' .
				'ORDER BY title';
		$list = $db->getAll($sql, 30 * 60);

		echo 'var car_services = new Array();';
		if (is_array($list)) {
			foreach ($list as $i => $row) {
				echo 'car_services[' . $i . '] = new Array(' . $db->quote($row['id']) . ', ' . $db->quote(htmlspecialchars_decode($row['car_services_title'])) . ', ' . $db->quote($row['edrpou']) . ', ' . $db->quote(htmlspecialchars_decode($row['bank'])) . ', ' . $db->quote($row['bank_mfo']) . ', ' . $db->quote($row['bank_edrpou']) . ', ' . $db->quote($row['bank_account']) . ', \'\');';
			}
		}
	}

    function getJavaScriptArray() {
        global $db;

        $conditions[] = 'a.active = 1';
        $conditions[] = 'a.roles_id = ' . ROLES_MASTER;
        $conditions[] = 'c.active = 1';

        $sql =  'SELECT a.id, CONCAT(a.lastname, \' \', a.firstname, \' \', a.patronymicname) AS fio, c.id AS car_services_id ' .
                'FROM ' . PREFIX . '_accounts AS a ' .
                'JOIN ' . PREFIX . '_masters AS b ON a.id = b.accounts_id ' .
                'JOIN ' . PREFIX . '_car_services AS c ON b.car_services_id = c.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY c.title, fio';
        $list =  $db->getAll($sql);

        $result = 'var masters = new Array();' . "\r\n";

        if (is_array($list)) {
            $i = -1;
            foreach($list as $row) {

                if ($car_services_id != $row['car_services_id']) {
                    $j = 0;
                    $i++;
                    $result .= 'masters[' . $i. '] = new Array(' . $db->quote($row['car_services_id']) . ', new Array());' . "\r\n";
                    $car_services_id = $row['car_services_id'];
                }

                $result .= 'masters[' . $i. '][1][' . $j . '] = new Array(' . $db->quote($row['id']) . ', ' . $db->quote($row['fio']) . ');' . "\r\n";
                $j++;
            }
        }

        return $result;
    }

    function getListToChoose($car_services_id, $empty_row=0, $elem=null) {
        global $db;

        $sql =  'SELECT a.id, a.title as car_services_title, CONCAT(a.title,\'-\' , b.bank) as title, ' .
                'a.edrpou as edrpou, b.bank_edrpou as bank_edrpou, b.bank as bank, b.bank_mfo as bank_mfo, b.bank_account as bank_account, a.tis as tis ' .
                'FROM ' . PREFIX . '_car_services as a ' .
                'JOIN ' . PREFIX . '_car_services_banking_details as b ' .
                'ON a.id = b.car_services_id ' .
				'ORDER BY num_l';
        $res = $db->query($sql);

        $result = '<div id="hiddenModalContent' . $elem . '" style="display:none">';		
        $result .= '<input type="text" id="search_title' . $elem . '" name="search_title" />';
        $result .= '<input type="button" id="search_btn' . $elem . '" value="Знайти" onclick="getListBySearch(' . $db->quote($elem) . ')" /><br/>';
		$result .= '<div id="carServicesContent' . $elem . '">';

		if ($empty_row) {
			$result .= '<a href="javascript: setEssentialCarService(0, \'\', \'\', \'\', \'\', \'\', \'\', \'\')" style="margin-left: ' . (($row['level'] - 1) * 20) . 'px;' . (($row['id'] == $car_services_id) ? ' color: #FF0000' : '') . '"><strong>...</strong></a><br />';
		}

        while($res->fetchInto($row)) {
            $result .= '<a href="javascript: setEssentialCarService(\'' . $row['id'] . '\', \'' . $row['car_services_title'] . '\', \'' . $row['edrpou'] . '\', \'' . $row['bank_account'] . '\', \'' . $row['bank_mfo'] . '\', \'' . $row['bank_edrpou'] . '\', \'' . $row['bank'] . '\', \'' . $row['tis'] .  '\', \'' . $elem . '\')" style="margin-left: ' . (($row['level'] - 1) * 20) . 'px;' . (($row['id'] == $car_services_id) ? ' color: #FF0000' : '') . '"><strong>' . $row['title'] . '</strong></a><br />';
        }
		$result .= '</div>';
		$result .= '<div id="mastersContent">';
		$result .= '</div>';
        $result .= '</div>';

        return $result;
    }

    function getListBySearchInWindow($data){
        global $db;

        $conditions[] = '1';

        if ($data['search_title']) {
            $conditions[] = 'a.title LIKE \'%' . $data['search_title'] . '%\'';
        }

        $sql =  'SELECT a.id, a.title as car_services_title, CONCAT(a.title,\'-\' , b.bank) as title, ' .
                'a.edrpou as edrpou, b.bank_edrpou as bank_edrpou, b.bank as bank, b.bank_mfo as bank_mfo, b.bank_account as bank_account, a.tis as tis ' .
                'FROM ' . PREFIX . '_car_services as a ' .
                'JOIN ' . PREFIX . '_car_services_banking_details as b ' .
                'ON a.id = b.car_services_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY num_l';
        $res = $db->query($sql);
		
        $result = '<input type="text" id="search_title" name="search_title" value="' . $data['search_title'] . '" />';
        $result .= '<input type="button" id="search_btn" value="Знайти" onclick="getListBySearch()" /><br/>';
		$result .= '<div id="carServicesContent">';
		
		if ($data['empty_row']) {
			$result .= '<a href="javascript: setEssentialCarService(0, \'\', \'\', \'\', \'\', \'\', \'\', \'\')" style="margin-left: ' . (($row['level'] - 1) * 20) . 'px;' . (($row['id'] == $car_services_id) ? ' color: #FF0000' : '') . '"><strong>...</strong></a><br />';
		}

        while($res->fetchInto($row)) {
            $result .= '<a href="javascript: setEssentialCarService(\'' . $row['id'] . '\', \'' . $row['car_services_title'] . '\', \'' . $row['edrpou'] . '\', \'' . $row['bank_account'] . '\', \'' . $row['bank_mfo'] . '\', \'' . $row['bank_edrpou'] . '\', \'' . $row['bank'] . '\', \'' . $row['tis'] .  '\', \'' . $data['elem'] . '\')" style="margin-left: ' . (($row['level'] - 1) * 20) . 'px;' . (($row['id'] == $car_services_id) ? ' color: #FF0000' : '') . '"><strong>' . $row['title'] . '</strong></a><br />';
        }
		//$result .= '</div>';
		$result .= '<div id="mastersContent">';
		$result .= '</div>';
		//$result .= '</div>';
        echo $result;
    }
	
	function isUkravto($id) {
		global $db;
		
		$sql = 'SELECT ukravto ' .
			   'FROM ' . PREFIX . '_car_services ' .
			   'WHERE id = ' . intval($id);
		return intval($db->getOne($sql));
	}

    function getAllCarServices(){
        global $db;

        $sql =	'SELECT id,title ' .
				'FROM ' . PREFIX . '_car_services ' .
				'ORDER BY title';
        return $db->getAll($sql);
    }
	
	function getActiveCarServices() {
		global $db;
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_car_services ' .
			   'WHERE active = 1 and ukravto = 1 ' .
			   'ORDER BY title';
		return $db->getAll($sql);
	}

    function getUkrAVTOCarServicesInWindow(){
        global $db;

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_services ' .
               'WHERE ukravto = 1 ' .
               'ORDER BY title';
        $list = $db->getAll($sql);

        $result = 'car_services_ukravto = new Array();';

        $i=0;
        foreach($list as $row){
            $result .= 'car_services_ukravto[' . $i . '] = new Array(' . $row['id'] . ',\'' . htmlspecialchars_decode($row['title'], ENT_QUOTES) . '\');';
            $i++;
        }

        $result .= '';

        echo $result;
    }

    function getNotUkrAVTOCarServicesInWindow(){
        global $db;

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_services ' .
               'WHERE ukravto = 0 ' .
               'ORDER BY title';
        $list = $db->getAll($sql);

        $result = 'car_services_not_ukravto = new Array();';

        $i=0;
        foreach($list as $row){
            $result .= 'car_services_not_ukravto[' . $i . '] = new Array(' . $row['id'] . ',\'' . htmlspecialchars_decode($row['title'], ENT_QUOTES) . '\');';
            $i++;
        }

        $result .= '';

        echo $result;
    }

    function getAllCarServicesInWindow(){
        global $db;

        $sql = 'SELECT id, tis ' .
               'FROM ' . PREFIX . '_car_services ' .
               'ORDER BY id';
        $list = $db->getAll($sql);

        $result = 'car_services_list = new Array();';

        foreach($list as $row){
            $result .= 'car_services_list[' . $row['id'] . '] = ' . $row['tis'] . ';';
        }

        echo $result;
    }

    function getTitle($id){
        global $db;

        $sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_car_services ' .
			   'WHERE id =' . intval($id);
	    return $db->getOne($sql);
    }

    function getEDRPOU($id){
        global $db;

        $sql = 'SELECT edrpou ' .
               'FROM ' . PREFIX . '_car_services ' .
               'WHERE id =' . intval($id);
        return $db->getOne($sql);
    }
	
	function getCarServicesInWindow($data) {
        global $db;

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_services ' .
               'ORDER BY title';

        $list = $db->getAll($sql);
        $result = 'var institutions_information = new Array();';
        $i = 0;
        foreach ($list as $row) {
            $result .= 'institutions_information[' . $i . '] = {id:' . $row['id'] . ', name:' . $db->quote(htmlspecialchars_decode($row['title'], ENT_QUOTES)) . '};';
            $i++;
        }
        echo $result;
    }
	
	function getListJsonInWindow($data) {
        global $db;

        $sql = 'SELECT a.id as id, a.title as title ' .
               'FROM ' . PREFIX . '_car_services as a ' .
               'WHERE a.active = 1 ' .
               'ORDER BY a.id ASC';
        $list = $db->getAll($sql);

        foreach ($list as $row) {
            $result[] = array('id' => $row['id'], 'name' => htmlspecialchars_decode($row['title'], ENT_QUOTES));
        }

        echo json_encode($result);
    }
}

?>