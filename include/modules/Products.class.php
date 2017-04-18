<?
/*
 * Title: product class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ParametersRisks.class.php';
require_once 'ParametersTerms.class.php';
require_once 'ParametersZones.class.php';
require_once 'ParametersScopes.class.php';
require_once 'ParametersDrivers.class.php';
require_once 'ParametersRegions.class.php';
require_once 'ParametersCarTypes.class.php';
require_once 'ParametersCarPrices.class.php';
require_once 'ParametersCarYears.class.php';
require_once 'ParametersCarNumbers.class.php';
require_once 'ParametersCarWeights.class.php';
require_once 'ParametersPassengers.class.php';
require_once 'ParametersDriverAges.class.php';
require_once 'ParametersPriceRanges.class.php';
require_once 'ParametersEngineSizes.class.php';
require_once 'ParametersDeductibles.class.php';
require_once 'ParametersDriverStandings.class.php';
require_once 'ParametersPropertySections.class.php';
require_once 'ParametersPaymentBreakdowns.class.php';
require_once 'ParametersProperty.class.php';
require_once 'ParametersNS.class.php';

class Products extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'products'),
                        array(
                            'name'              => 'product_types_id',
                            'description'       => 'Тип',
                            'type'              => fldHidden,
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
                            'table'             => 'products'),
                        array(
                            'name'              => 'code',
                            'description'       => 'Код',
                            'type'              => fldUnique,
                            'maxlength'         => 20,
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
                            'orderPosition'     => 1,
                            'table'             => 'products'),
                        array(
                            'name'              => 'publish',
                            'description'       => 'Активний',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'products'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'products'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 2,
                            'width'             => 100,
                            'table'             => 'products')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'title'
                    )
            );

    function Products($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Страхові продукти';
        $this->messages['single'] = 'Страховий продукт';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'copy'      => true,
                    'update'    => true,
                    'view'      => true,
                    'change'    => true,
                    'delete'    => true,
                    'export'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
        }
    }

    function factory($data, $type=null) {
        if (!$type) {
            $type = ProductTypes::get($data['product_types_id']);
        }

		if ($type) {
			require_once 'Products/' . $type . '.class.php';

			$class = 'Products_' . $type;

			@$obj =& new $class($data);
		} else {
			@$obj =& new Products($data);
		}

        return $obj;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db;
		
		if($data['title']){
			$conditions[] = 'title LIKE ' . $db->quote('%' . $data['title'] . '%');
			$limit = false;
		}
        parent::show($data, $fields, $conditions, $sql, $this->object . '/show.php', $limit);
    }

	function copy($data) {
        $this->checkPermissions('copy', $data);

        $data = $this->load($data, false);
        $this->add($data);
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        $this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[1] . '.* ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . $this->tables[1] . ' ON ' . $this->tables[0] . '.id = ' . $this->tables[1] . '.products_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields('update', $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType);
        } else {
            return $data;
        }
    }

    function view($data, $conditions=null, $sql=null, $template=null, $showForm=true) {
        global $db;

        $this->checkPermissions('view', $data);

        $action     = 'view';
        $actionType = ($data['do'] == $this->object . '|previewInWindow') ? 'previewInWindow' : 'view';

        if (!$sql) {
            if (is_array($data['id'])) $data['id'] = $data['id'][0];

            $this->setTables('view');
            $this->getFormFields('view');

            $identityField = $this->getIdentityField();

            $prefix = ($conditions) ? implode(' AND ', $conditions) : '';

            $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[1] . '.* ' .
                    'FROM ' . implode(', ', $this->tables) . ' ' .
                    'WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        }

        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        }

        return $data;
    }

    function updateCommissions($data) {
        global $db, $Log;

        $this->checkPermissions('update', $data);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (is_array($data['agencies'])) {

                foreach ($data['agencies'] as $id => $row) {

                    //проверяем комиссию агенции
                     if ($row['agency_percent'] > 0) {
                        if (!$this->isValidPercent($row['agency_percent'])) {
                            $params = array('Агенція. Розмір комісії, %', '');
                            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                        }
						$data['agencies'][ $id ]['agency_amount'] = 0;
                    }  

                    //проверяем комиссию агента
                    if ($row['agent_percent'] > 0) {
                        if (!$this->isValidPercent($row['agent_percent'])) {
                            $params = array('Агент. Розмір комісії, %', '');
                            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                        }
                       
                    }  
                }
            }

            if (is_array($data['financial_institutions'])) {

                foreach ($data['financial_institutions'] as $id => $row) {

                    //проверяем комиссию банка
                    if ($row['percent'] > 0  ) {
                        if (!$this->isValidPercent($row['percent'])) {
                            $params = array('Розмір комісії, %', '');
                            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                        }
                    } 
                }
            }

            if (!$Log->isPresent()) {
                if (is_array($data['agencies'])) {
                    foreach ($data['agencies'] as $id => $row) {
                        $sql =  'REPLACE INTO ' . PREFIX . '_agency_commissions SET ' .
                                'agencies_id = ' . intval($id) . ', ' .
                                'date = ' . $db->quote($row['date']) . ', ' .
                                'products_id = ' . $db->quote($data['products_id']) . ', ' .
                                'agency_percent = ' . $db->quote($row['agency_percent']) . ', ' .
                                'agent_percent = ' . $db->quote($row['agent_percent']) . ', ' .
                                'modified = NOW()';
                        $db->query($sql);
                    }
                }

                if (is_array($data['financial_institutions'])) {
                    foreach ($data['financial_institutions'] as $id => $row) {
                        $sql =  'REPLACE INTO ' . PREFIX . '_financial_institution_commissions SET ' .
                                'financial_institutions_id = ' . intval($id) . ', ' .
                                'date = ' . $db->quote($row['date']) . ', ' .
                                'products_id = ' . $db->quote($data['products_id']) . ', ' .
                                'percent = ' . $db->quote($row['percent']) . ', ' .
                                'base = ' . intval($row['base']) . ', ' .
                                'amount = ' . $db->quote($row['amount']) . ', ' .
                                'modified = NOW()';
                        $db->query($sql);
                    }
                }

                $Log->add('confirm', 'Розмір комісії було встановлено.');

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=ProductTypes|view&id=' . $data['product_types_id']);
                exit;
            }
        } else {
            $data['products_title'] = $this->getTitle($data['products_id']);

            $sql =  'SELECT a.id as agencies_id, a.title as agencies_title, IF(ISNULL(c.date), \'2008-01-01\', c.date) as date, c.agency_percent,   c.agent_percent  ' .
                    'FROM ' . PREFIX . '_agencies as a ' .
                    'JOIN ' . PREFIX . '_product_agency_assignments as b ON a.id=b.agencies_id AND b.products_id=' . ($data['copyprod'] ? intval($data['copyprod']) : intval($data['products_id'])) . ' ' .
                    'LEFT JOIN ' . PREFIX . '_agency_commissions as c ON b.agencies_id = c.agencies_id AND b.products_id=c.products_id ' .
                    'LEFT JOIN (SELECT MAX(date) as date, agencies_id FROM ' . PREFIX . '_agency_commissions GROUP BY agencies_id) as d ON c.agencies_id=d.agencies_id AND c.date=d.date ' .
                    'GROUP BY a.id ' .
                    'ORDER BY agencies_title';
            $res = $db->query($sql);

            while ($res->fetchInto($row)) {
                $data['agencies'][ $row['agencies_id'] ] = array(
                    'title'         => $row['agencies_title'],
                    'date'          => $row['date'] ? '2008-01-01' : '',
                    'agency_percent' => $row['agency_percent'],
                    'agent_percent'  => $row['agent_percent']);
            }

            $sql =  'SELECT a.id as financial_institutions_id, a.title as financial_institutions_title, IF(ISNULL(c.date), \'2008-01-01\', c.date) as date, c.percent, c.base, c.amount ' .
                    'FROM ' . PREFIX . '_financial_institutions as a ' .
                    'JOIN ' . PREFIX . '_product_financial_institution_assignments as b ON a.id=b.financial_institutions_id AND b.products_id=' . intval($data['products_id']) . ' ' .
                    'LEFT JOIN ' . PREFIX . '_financial_institution_commissions as c ON b.financial_institutions_id = c.financial_institutions_id AND b.products_id=c.products_id ' .
                    'LEFT JOIN (SELECT MAX(date) as date, financial_institutions_id FROM ' . PREFIX . '_financial_institution_commissions GROUP BY financial_institutions_id) as d ON c.financial_institutions_id=d.financial_institutions_id AND c.date=d.date ' .
                    'GROUP BY a.id ' .
                    'ORDER BY financial_institutions_title';
            $res = $db->query($sql);

            while ($res->fetchInto($row)) {
                $data['financial_institutions'][ $row['financial_institutions_id'] ] = array(
                    'title'     => $row['financial_institutions_title'],
                    'date'      => $row['date'] ? '2008-01-01' : '',
                    'percent'   => $row['percent'],
                    'base'      => $row['base'],
                    'amount'    => $row['amount']);
            }
        }

        include_once $this->object . '/commissions.php';
    }

    function getPaymentBreakdownTitleById($payment_brakedown_id) {
        switch ($payment_brakedown_id) {
            case 1://1 платеж
                return 12;
                break;
            case 2://2 платежа
                return 6;
                break;
            case 3:
                return 3;
                break;
        }
    }

	//получаем размеры комиссионных вознаграждений
    function getCommissions($products_id, $date, $agencies_id, $discount=0, $financial_institutions_id=null) {
		global $db;

		$conditions[] = 'b.agencies_id = ' . intval($agencies_id);
		$conditions[] = 'c.products_id = ' . intval($products_id);

		//!!! Внимание, база сейчас одна для начисления комиссии агенту и агенции, править вместе с методом Products->getDiscountInWindow
		$sql =  'SELECT a.agency_commission as commission_agency_percent,
				 a.agent_commission as commission_agent_percent, 
				 0.00 AS commission_financial_institution_percent,
				 0.00 AS commission_financial_institution_amount,
				 director1_commission as director1_commission_percent,director2_commission  as director2_commission_percent,
				 manager_commission as commission_manager_percent,
				 seller_agents_commission	 as commission_seller_agents_percent	 ' .
				 'FROM ' . PREFIX . '_commissions  AS a '.
				 'JOIN ' . PREFIX . '_commissions_agency_assignments b on b.commissions_id =a.id ' .
				 'JOIN ' . PREFIX . '_commissions_product_assignments c on c.commissions_id =a.id ' .
				 'WHERE ' . implode(' AND ', $conditions) . ' ' .
				 'LIMIT 1';


		$row = $db->getRow($sql);
//_dump($sql);

		$row['commission'] = $row['commission_agency_percent'] + $row['commission_agent_percent'];

		//установка комиссионного вознаграждения для АГЕНСТВА с учетом выданной скидки для конкретной машины
		$agency_percent = ($row['commission_agency_percent'] + $row['commission_agent_percent']) ? $row['commission_agency_percent'] - $discount / ($row['commission_agency_percent'] + $row['commission_agent_percent']) * $row['commission_agency_percent'] : 0;

        //установка комиссионного вознаграждения для АГЕНТА с учетом выданной скидки для конкретной машины
        $agent_percent = ($row['commission_agency_percent'] + $row['commission_agent_percent']) ? $row['commission_agent_percent'] - $discount / ($row['commission_agency_percent'] + $row['commission_agent_percent']) * $row['commission_agent_percent'] : 0;
		if ($agent_percent<0) $agent_percent = 0;

		$row['commission_agency_percent']	= $agency_percent;
		$row['commission_agent_percent']	= $agent_percent;

		return $row;
	}

    function getCommissionsInWindow($data) {
        global $db, $Authorization;

		$result = '';

		if ($Authorization->data['roles_id'] == ROLES_AGENT) {
			$data['agencies_id'] = $Authorization->data['agencies_id'];
		}

		$values = $this->getCommissions($data['products_id'], $data['date'], $data['agencies_id'], $data['discount'], $data['financial_institutions_id']);

		$commissions = array(
			'commission_agency_percent',
			'commission_agent_percent',
		);

		if ($Authorization->data['roles_id'] != ROLES_AGENT) {//выдаем банковскую комиссию, если запросил не агент
			$commissions[] = 'commission_financial_institution_percent';
		}

		foreach ($commissions as $commission) {
			$result[] = '"' . $commission . '":"' . floatval($values[ $commission ]) . '"';
		}

		echo '{' . implode(',', $result) . '}';
        exit;
    }

	function getCartDiscount($id) {
        global $db;

		$conditions[] = 'id IN (' . implode(', ', $id) . ')';

		$sql =  'SELECT MIN(cart_discount) ' .
				'FROM ' . PREFIX . '_products ' .
				'WHERE ' . implode(' AND ', $conditions) ;
		return $db->getOne($sql, 30 * 60);
    }

	function getMaxDiscount($id) {
        global $db;

		if (strlen(implode(', ', $id))>0) {
			$conditions[] = 'id IN (' . implode(', ', $id) . ')';

			$sql =  'SELECT MIN(max_discount) ' .
					'FROM ' . PREFIX . '_products ' .
					'WHERE ' . implode(' AND ', $conditions) ;
			return $db->getOne($sql, 30 * 60);
		}
		else return 0;
    }

    function getDiscountInWindow($data) {
        global $db, $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_AGENT) {
			$data['agencies_id'] = $Authorization->data['agencies_id'];
		}

        if (is_array($data['products_id'])) {

			$conditions[] = 'b.agencies_id = ' . intval($data['agencies_id']);
			$conditions[] = 'c.products_id IN (' . implode(', ', $data['products_id']) . ')';

			$sql =  'SELECT a.agency_commission + a.agent_commission AS discount '.
					'FROM ' . PREFIX . '_commissions AS a '.
					'JOIN ' . PREFIX . '_commissions_agency_assignments AS b ON a.id = b.commissions_id ' .
					'JOIN ' . PREFIX . '_commissions_product_assignments AS c ON a.id = c.commissions_id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'LIMIT 1';
			$row =	$db->getRow($sql);

			$row['cart_discount']	= intval($data['financial_institutions_id'])>0 ? 0 : $this->getCartDiscount($data['products_id']);

			if (intval($data['financial_institutions_id'])>0)$row['cart_discount']	=0;//если выбран Банк то кармен анулируеться
			
			$row['max_discount']	= $this->getMaxDiscount($data['products_id']);

			$row['discount'] = ($row['max_discount'] < $row['discount']) ? $row['max_discount'] : $row['discount'];
			if (is_array($data['products_id']) && in_array( 301 , $data['products_id'])) $row['discount'] = $row['max_discount'];
			/*if (ereg('^ЕС[0-9]{4}$', $data['card_car_man_woman'])) {
				$row['cart_discount'] = 20;
			}*/

        }
		echo '{"discount":"' . intval($row['discount']) . '", "cart_discount":"' . intval($row['cart_discount']) . '"}';
        exit;
    }
}

?>