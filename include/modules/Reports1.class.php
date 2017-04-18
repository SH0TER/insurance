<?
/*
 * Title: report class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Products.class.php';
require_once 'Policies.class.php';
require_once 'CarServices.class.php';
require_once 'CarTypes.class.php';
require_once 'CarBrands.class.php';
require_once 'ParametersRisks.class.php';
require_once 'ReportBuilder.class.php';
require_once 'Users.class.php';
require_once 'AccidentMessages.class.php';
require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');
require_once 'BankDay.php';

class Reports1 extends Form {

    function Reports1($data) {
        global $Authorization;

        $this->object = $this->objectTitle = 'Reports1';

        $this->messages['plural'] = 'Звіти';
        $this->messages['single'] = 'Звіт';
    }

    function show($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
            case ROLES_ADMINISTRATOR:
                include_once $this->object . '/showAdministrator.php';
                break;
            case ROLES_AGENT:
                include_once $this->object . '/showAgent.php';
                break;
            default:
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
        }
    }

    function showReinsuranceReport() {
        global $Authorization;

        include $this->object . '/Reinsurance/show.php';
    }

	 function checkPermissions($action, $data, $redirect=false) {
		return true;
	}
    //reinsurance
    function getCargoBordero($data, $excel=false) {
        global $db, $Smarty;

        $this->checkPermissions('getCargoBordero', $data);

        $conditions[] = 'policy_statuses_id = ' . POLICY_STATUSES_GENERATED;

        $conditions[] = 'item_types_id = 2';

        if (!intval($data['brands_id'])) {
            $data['brands_id'] = 13;
        }

        if (intval($data['brands_id'])) {
            $fields[] = 'brands_id';
            $conditions[] = 'brands_id = ' . intval($data['brands_id']);
        }

        if (!intval($data['clients_id'])) {
            $data['clients_id'] = CLIENTS_AUTOCAPITAL;
        }

        $fields[] = 'clients_id';
        $conditions[] = 'clients_id = ' . intval($data['clients_id']);

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ') <= TO_DAYS(date)';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] = 'TO_DAYS(date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if ($data['beginFrom']) {
            $fields[] = 'beginFrom';
            $conditions[] = 'TO_DAYS(' . $db->quote( substr($data['beginFrom'], 6, 4) . substr($data['beginFrom'], 3, 2) . substr($data['beginFrom'], 0, 2) ) . ') <= TO_DAYS(begin_datetime)';
        }

        if ($data['beginTo']) {
            $fields[] = 'beginTo';
            $conditions[] = 'TO_DAYS(date) <= TO_DAYS(' . $db->quote( substr($data['beginTo'], 6, 4) . substr($data['beginTo'], 3, 2) . substr($data['beginTo'], 0, 2) ) . ')';
        }
		
		if (!isset($_POST['InWindow'])) {
		  include_once $this->object . '/Reinsurance/cargoBordero.php';
		  return;
		 }

        $sql =  'SELECT a.product_types_id, ' .
                'a.number, ' .
                'date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, ' .
                'c.document_number, ' .
                'date_format(c.document_date, ' . $db->quote(DATE_FORMAT) . ') as document_date_format, ' .
                'c.model, ' .
                'c.shassi, ' .
                'c.price ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_cargo AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_cargo_items AS c ON a.id = c.policies_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.date DESC';
        $list = $db->getAll($sql, 30 * 60);

        $total = sizeOf($list);

        $sql =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_car_brands ' .
                'ORDER BY title';
        $brands = $db->getAll($sql, 30 * 60);

        $sql =	'SELECT id, company ' .
                'FROM ' . PREFIX . '_clients ' .
                'ORDER BY company';
        $clients = $db->getAll($sql, 30 * 60);

 
            header('Content-Disposition: attachment; filename="reports.xls"');
            header('Content-Type: ' . Form::getContentType('reports.xls'));
            include_once $this->object . '/Reinsurance/cargoBorderoExcel.php';
 
    }

    function getCargoBorderoInWindow($data) {
        $this->getCargoBordero($data, true);
    }

    function getPolicies($data, $excel=false) {
        global $db, $Authorization;

        $this->checkPermissions('getPolicies', $data);

		switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
				$data['candelete'] = true;
				break;
			case ROLES_MANAGER:
				$data['candelete'] = ($Authorization->data['payments']) ? true : false;
				break;
        }
		
        if (!intval($data['product_types_id'])) {
            $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        }
		
		if (intval($data['insurance_companies_id'])) {
            $conditions[] = 'a.insurance_companies_id = ' . intval($data['insurance_companies_id']);
        }

        $conditions[] = 'a.product_types_id = '.intval($data['product_types_id']);

		if ($data['service']) {
			$conditions[] = 'a.commission_service_percent > 0';
		}

        if ($Authorization->data['roles_id'] == ROLES_AGENT) {
				$data['agencies_id'] = $Authorization->data['agencies_id'];
        }

        if (intval($data['agencies_id'])) {
			$Agencies = new Agencies($data);
			$agencies_id = array($data['agencies_id']);
			$Agencies->getSubId(&$agencies_id, $data['agencies_id']);

			$fields[] = 'agencies_id';
			$conditions[] =   'a.agencies_id IN(' . implode(', ', $agencies_id) . ')';
		}

        if ($Authorization->data['roles_id'] == ROLES_AGENT && $Authorization->data['types_id'] != 1) {
            $conditions[] = 'a.agents_id = ' . intval($Authorization->data['id']);
        }

		if (!$data['fromWaitingPaymentDate'] && !$data['fromPaymentDate']) {
			$data['fromWaitingPaymentDate'] = date('01.m.Y', mktime(0, 0, 0, date('m')-1, 1, date('Y')));
		}

		if ($data['fromWaitingPaymentDate']) {
			$conditions[] = $db->quote(substr($data['fromWaitingPaymentDate'], 6, 4) .'-'. substr($data['fromWaitingPaymentDate'], 3, 2) .'-'. substr($data['fromWaitingPaymentDate'], 0, 2) . ' 00:00:00') . ' <= b.date';
		}

        if (!$data['toWaitingPaymentDate'] && !$data['toPaymentDate']) {
            $data['toWaitingPaymentDate'] = date('d.m.Y', mktime(0, 0, 0, date('m')+1, 0, date('Y')));
		}

		if ($data['toWaitingPaymentDate']) {
			$conditions[] = 'b.date <= ' . $db->quote(substr($data['toWaitingPaymentDate'], 6, 4) .'-'. substr($data['toWaitingPaymentDate'], 3, 2) .'-'. substr($data['toWaitingPaymentDate'], 0, 2) . ' 23:59:59');
        }

		if ($data['fromPaymentDate']) {
			$conditions[] = $db->quote(substr($data['fromPaymentDate'], 6, 4) .'-'. substr($data['fromPaymentDate'], 3, 2) .'-'. substr($data['fromPaymentDate'], 0, 2) . ' 00:00:00') . ' <= b.payment_date';
		}

        if ($data['toPaymentDate']) {
			$conditions[] = 'b.payment_date <= ' . $db->quote(substr($data['toPaymentDate'], 6, 4) .'-'. substr($data['toPaymentDate'], 3, 2) .'-'. substr($data['toPaymentDate'], 0, 2) . ' 23:59:59');
        }

        if ($data['number']) {
            $conditions[] = 'a.number LIKE ' . $db->quote($data['number'] . '%');
        }

        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO && intval($data['financial_institutions_id'])) {
            $conditions[] = 'e.financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }
		
		if (is_array($data['policy_statuses_id'])) {
				$fields[] = 'policy_statuses_id';
				$conditions[] = 'a.policy_statuses_id IN(' . implode(', ', $data['policy_statuses_id']) . ')';
			}

		switch ($data['product_types_id']) {
			case PRODUCT_TYPES_KASKO:
				$sql =	'SELECT a.id, a.product_types_id, a.documents, b.statuses_id as payment_statuses_id, c.title as agencies_title, IF(c1.id>0,c1.id,c.id) as agencies_id, a.agents_id, CONCAT(d.lastname, \' \', d.firstname) as agent, a.insurer, a.item, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date, j.title as policy_statusesTitle, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime, a.amount, ' .
						'date_format(b.date, ' . $db->quote(DATE_FORMAT) . ') as waitingPaymentDate, date_format(b.payment_date, ' . $db->quote(DATE_FORMAT) . ') as payment_date, b.amount as paymentsAmount, ' .
						'a.commission_agency_percent, b.commission_agency_amount, ' .
						'a.commission_agent_percent, b.commission_agent_amount,  ' .
						'a.commission_service_percent, b.commission_service_amount,  date_format(b.payment_date_service, ' . $db->quote(DATE_FORMAT) . ') as payment_date_service, ' .
						'e.service_person,date_format(a.bank_akt_payment_date, ' . $db->quote(DATE_FORMAT) . ') as bank_akt_payment_date, ' .
						'f.title as financial_institutions_title, a.commission_financial_institution_percent, b.commission_financial_institution_amount,  ' .
						'IF(e.financial_institutions_id > 0 AND (a.solutions_id=0 OR a.states_id=1  OR a.states_id=2),1,0) as prolong,a.rate '.
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
						'LEFT JOIN ' . PREFIX . '_agencies AS c1 ON c1.id = c.parent_id ' .
						'JOIN ' . PREFIX . '_accounts AS d ON a.agents_id = d.id ' .
						'JOIN ' . PREFIX . '_policies_kasko AS e ON a.id = e.policies_id ' .
						'LEFT JOIN ' . PREFIX . '_financial_institutions AS f ON e.financial_institutions_id = f.id ' .
						'JOIN ' . PREFIX . '_policy_statuses AS j ON a.policy_statuses_id=j.id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.insurer';
				break;
			case PRODUCT_TYPES_GO:
				$sql =	'SELECT a.id, a.product_types_id, a.documents, b.statuses_id as payment_statuses_id, c.title as agencies_title, IF(c1.id>0,c1.id,c.id) as agencies_id, a.agents_id, CONCAT(d.lastname, \' \', d.firstname) as agent, a.insurer, a.item, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date, j.title as policy_statusesTitle, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime, a.amount, ' .
						'date_format(b.date, ' . $db->quote(DATE_FORMAT) . ') as waitingPaymentDate, date_format(b.payment_date, ' . $db->quote(DATE_FORMAT) . ') as payment_date, b.amount as paymentsAmount, ' .
						'a.commission_agency_percent, b.commission_agency_amount,  ' .
						'a.commission_agent_percent, b.commission_agent_amount,  ' .
						'a.commission_service_percent, b.commission_service_amount,  date_format(b.payment_date_service, ' . $db->quote(DATE_FORMAT) . ') as payment_date_service, ' .
						'a.commission_financial_institution_percent, b.commission_financial_institution_amount,   ' .
						'e.service_person ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
						'LEFT JOIN ' . PREFIX . '_agencies AS c1 ON c1.id = c.parent_id ' .
						'JOIN ' . PREFIX . '_accounts AS d ON a.agents_id = d.id ' .
						'JOIN ' . PREFIX . '_policies_go AS e ON a.id = e.policies_id ' .
						'JOIN ' . PREFIX . '_policy_statuses AS j ON a.policy_statuses_id=j.id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.insurer';
				break;
			case PRODUCT_TYPES_DGO:
				$sql =	'SELECT a.id, a.product_types_id, a.documents, b.statuses_id as payment_statuses_id, c.title as agencies_title, IF(c1.id>0,c1.id,c.id) as agencies_id, a.agents_id, CONCAT(d.lastname, \' \', d.firstname) as agent, a.insurer, a.item, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date, j.title as policy_statusesTitle, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime, a.amount, ' .
						'date_format(b.date, ' . $db->quote(DATE_FORMAT) . ') as waitingPaymentDate, date_format(b.payment_date, ' . $db->quote(DATE_FORMAT) . ') as payment_date, b.amount as paymentsAmount, ' .
						'a.commission_agency_percent, b.commission_agency_amount,   ' .
						'a.commission_agent_percent, b.commission_agent_amount, ' .
						'a.commission_service_percent, b.commission_service_amount,  date_format(b.payment_date_service, ' . $db->quote(DATE_FORMAT) . ') as payment_date_service, ' .
						'e.service_person ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
						'LEFT JOIN ' . PREFIX . '_agencies AS c1 ON c1.id = c.parent_id ' .
						'JOIN ' . PREFIX . '_accounts AS d ON a.agents_id = d.id ' .
						'JOIN ' . PREFIX . '_policies_dgo AS e ON a.id = e.policies_id ' .
						'JOIN ' . PREFIX . '_policy_statuses AS j ON a.policy_statuses_id=j.id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.insurer';
				break;
			default:
				$sql =	'SELECT a.id, a.product_types_id, a.documents, b.statuses_id as payment_statuses_id, c.title as agencies_title, IF(c1.id>0,c1.id,c.id) as agencies_id, a.agents_id, CONCAT(d.lastname, \' \', d.firstname) as agent, a.insurer, a.item, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date, j.title as policy_statusesTitle, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime, a.amount, ' .
						'date_format(b.date, ' . $db->quote(DATE_FORMAT) . ') as waitingPaymentDate, date_format(b.payment_date, ' . $db->quote(DATE_FORMAT) . ') as payment_date, b.amount as paymentsAmount, ' .
						'a.commission_agency_percent, b.commission_agency_amount,   ' .
						'a.commission_agent_percent, b.commission_agent_amount,  ' .
						'a.commission_service_percent, b.commission_service_amount,  date_format(b.payment_date_service, ' . $db->quote(DATE_FORMAT) . ') as payment_date_service ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policy_payments_calendar AS b ON a.id = b.policies_id ' .
						'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
						'LEFT JOIN ' . PREFIX . '_agencies AS c1 ON c1.id = c.parent_id ' .
						'JOIN ' . PREFIX . '_accounts AS d ON a.agents_id = d.id ' .
						'JOIN ' . PREFIX . '_policy_statuses AS j ON a.policy_statuses_id=j.id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.insurer';
				break;
		}

		$list =	$db->getAll($sql);

        $sql =	'SELECT DISTINCT a.id, a.title ' .
                'FROM ' . PREFIX . '_product_types as a ' .
                'JOIN ' . PREFIX . '_products as b ON a.id=b.product_types_id ' .
                'WHERE num_l = num_r ' .
                'ORDER BY num_l';
        $product_types = $db->getAll($sql);

        $sql =	'SELECT id, code, title, level ' .
                        'FROM ' . PREFIX . '_agencies ' .
                        'ORDER BY CAST(code as UNSIGNED), num_l';
        $agencies = $db->getAll($sql, 60 * 60);

        $sql =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_financial_institutions ' .
                'ORDER BY title';
        $financial_institutions = $db->getAll($sql, 30 * 60);
		
		$sql =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_policy_statuses ' .
                'ORDER BY id';
        $policiy_statuses = $db->getAll($sql, 30 * 60);
		

        if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR
            || $Authorization->data['roles_id'] == ROLES_MANAGER
            || $Authorization->data['types_id'] == 1) {
            $showcomissions = true;
        }

        if ($excel) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/policiesExcel.php';
            exit;
        } else {
            include_once $this->object . '/policies.php';
            exit;
        }
    }
	

	function getInsuranceActivityInWindow($data) {
        global $db, $Authorization;

        if (!$data['to']) {
			$data['to'] = date('d.m.Y');
		}

        $to = $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');

    	 if (!$data['from']) {
			$data['from'] = date('01.m.Y');
		}

        $from = $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 23:59:59');

		$sql =	'SELECT a.id, b.product_types_id, count( b.id ) AS policesCount, IF( financial_institutions_id >0, IF(financial_institutions_id=35,35,1), 0 ) AS financial_institutions_id
				FROM insurance_agencies AS a
				JOIN insurance_policies AS b ON a.id = b.agencies_id
				LEFT JOIN insurance_policies_kasko AS d ON b.id = d.policies_id
				JOIN (
				SELECT policies_id, min( datetime ) AS period
				FROM insurance_policy_payments
				GROUP BY policies_id
				) AS c ON b.id = c.policies_id
				WHERE c.period
				BETWEEN ' . $from . ' AND ' . $to . ' 
				GROUP BY a.id, b.product_types_id, IF( financial_institutions_id >0, IF(financial_institutions_id=35,35,1), 0 )
				ORDER BY a.id, b.product_types_id';
        $list = $db->getAll($sql);

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<resultset>';
		$curid=0;
        foreach ($list as $i => $row) {
			 if ($row['id']!=$curid) {
				if ($curid>0) echo '</agency>';
	            echo '<agency>';
	            echo '<agencycode>'.$row['id'].'</agencycode>';
			 }	
			 if ($row['product_types_id']==3 && $row['financial_institutions_id']>0 && $row['financial_institutions_id']!=35)
	             echo '<kaskoBankCount>'.$row['policesCount'].'</kaskoBankCount>';
			 if ($row['product_types_id']==3 && $row['financial_institutions_id']>0 && $row['financial_institutions_id']==35)
	             echo '<kaskoLeasingCount>'.$row['policesCount'].'</kaskoLeasingCount>';
			 if ($row['product_types_id']==3 && $row['financial_institutions_id']==0)
	             echo '<kaskoCount>'.$row['policesCount'].'</kaskoCount>';
			 if ($row['product_types_id']==4)
	             echo '<goCount>'.$row['policesCount'].'</goCount>';
			 if ($row['product_types_id']==7)
	             echo '<dgoCount>'.$row['policesCount'].'</dgoCount>';	 
			$curid=$row['id'];
        }
		if ($curid>0) echo '</agency>';
        echo '</resultset>';

		exit;
    }

	function getCertificateCargoObjects($data) {
		global $db;

        $this->checkPermissions('getCertificateCargoObjects', $data);

        if (isset($_POST['InWindow'])) {

            if (intval($data['clients_id'])) {
                $conditions[] = 'a.clients_id = ' . intval($data['clients_id']);
            }

            if ($data['number']) {
                $conditions[] = 'a.number LIKE ' . $db->quote($data['number']);
            }

            if (!$data['from']) {
                $data['from'] = date('d.m.Y', mktime(0, 0, 0, date('m')-1, 1, date('Y')));
            }

            if (!$data['to']) {
                $data['to'] = date('d.m.Y', mktime(0, 0, 0, date('m'), 0, date('Y')));
            }

            $from	= $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
            $to		= $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');

            $conditions[] = 'a.date BETWEEN ' . $from . ' AND ' . $to;

            $sql =	'SELECT f.company, a.product_types_id, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') AS date, IF(item_types_id = 2, CONCAT(brand, \'/\', model), CONCAT(quantity, \'/\', packing, \'/\', weight)) AS object, c.price, a.rate, ROUND(c.price * a.rate / 100, 2) AS amount, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') AS end_datetime, d.title AS policy_statusesTitle, e.title AS payment_statusesTitle, date_format(a.created, ' . $db->quote(DATE_FORMAT) . ') AS created, date_format(a.modified, ' . $db->quote(DATE_FORMAT) . ') AS modified ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_cargo AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_cargo_items AS c ON a.id = c.policies_id ' .
                    'JOIN ' . PREFIX . '_policy_statuses AS d ON a.policy_statuses_id = d.id ' .
                    'JOIN ' . PREFIX . '_payment_statuses AS e ON a.payment_statuses_id = e.id ' .
                    'JOIN ' . PREFIX . '_clients AS f ON a.clients_id = f.id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'ORDER BY a.date DESC ' .
                    'LIMIT 1000';
            $list =	$db->getAll($sql);

            header('Content-Disposition: attachment; filename="reports.xls"');
            header('Content-Type: ' . Form::getContentType('reports.xls'));

            include_once $this->object . '/Reinsurance/certificateCargoObjectsExcel.php';
        } else {

            $sql =	'SELECT DISTINCT b.id, b.company ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_clients AS b ON a.clients_id = b.id ' .
                    'WHERE product_types_id = ' . PRODUCT_TYPES_CARGO_GENERAL . ' ' .
                    'ORDER BY company';
            $clients = $db->getAll($sql, 30 * 60);

            include_once $this->object . '/Reinsurance/certificateCargoObjects.php';
        }
        exit;
	}

    function exportInWindow($data) {

        switch ($data['report']) {
            case 'getPolicies':
                $this->getPolicies($data, true);
                break;
        }
    }

    //reinsurance
	function getKASKOBordero($data) {
        global $db, $Smarty;

        $this->checkPermissions('getKASKOBordero', $data);

        if (isset($_POST['InWindow'])) {

            if (!$data['from'] && !$data['from2']) {
                $data['from'] = date('d.m.Y', mktime(0, 0, 0, date('m') - 1, 1, date('Y')));
            }

            if (!$data['to'] && !$data['to2']) {
                $data['to'] = date('d.m.Y', mktime(0, 0, 0, date('m'), 0, date('Y')));
            }

            $conditions[] = 'a.product_types_id = ' . intval($data['product_types_id']);
            $conditions2[] = 'a2.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE;

            $conditions[] = 'a.payment_statuses_id <> ' . PAYMENT_STATUSES_NOT;
            $conditions2[] = 'a2.payment_statuses_id <> ' . PAYMENT_STATUSES_NOT;

            $conditions[] = ($data['number'])
                ? 'a.number='.$db->quote($data['number'])
                : ($data['from'] && $data['to']) ? 'TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ') <= TO_DAYS(d.datetimeFirst) AND TO_DAYS(d.datetimeFirst) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')' : '1';
            $conditions2[] = ($data['number'])
                ? 'a2.number='.$db->quote($data['number'])
                : ($data['from'] && $data['to']) ? 'TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ') <= TO_DAYS(e2.payment_date) AND TO_DAYS(e2.payment_date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')' : '1';

            if (!$data['number']) {
                if ($data['from1']) {
                    $from1	= $db->quote(substr($data['from1'], 6, 4) .'-'. substr($data['from1'], 3, 2) .'-'. substr($data['from1'], 0, 2) . ' 00:00:00');
                    $conditions[] = 'a.date>=' . $from1;
                    $conditions2[] = 'a2.date>=' . $from1;
                }
                if ($data['to1']) {
                    $to1		= $db->quote(substr($data['to1'], 6, 4) .'-'. substr($data['to1'], 3, 2) .'-'. substr($data['to1'], 0, 2) . ' 23:59:59');
                    $conditions[] = 'a.date<=' . $to1;
                    $conditions2[] = 'a2.date<=' . $to1;
                }
            }

            if ($data['from2']) {
                $conditions[] = 'TO_DAYS(' . $db->quote( substr($data['from2'], 6, 4) . substr($data['from2'], 3, 2) . substr($data['from2'], 0, 2) ) . ') <= TO_DAYS(e.date)';
                $conditions[] = 'e.statuses_id <> 1';
                $conditions2[] = 'TO_DAYS(' . $db->quote( substr($data['from2'], 6, 4) . substr($data['from2'], 3, 2) . substr($data['from2'], 0, 2) ) . ') <= TO_DAYS(e2.date)';
                $conditions2[] = 'e2.statuses_id <> 1';
            }

            if ($data['to2']) {
                $conditions[] =  'TO_DAYS(e.date) <= TO_DAYS(' . $db->quote( substr($data['to2'], 6, 4) . substr($data['to2'], 3, 2) . substr($data['to2'], 0, 2) ) . ')';
                $conditions[] = 'e.statuses_id <> 1';
                $conditions2[] =  'TO_DAYS(e2.date) <= TO_DAYS(' . $db->quote( substr($data['to2'], 6, 4) . substr($data['to2'], 3, 2) . substr($data['to2'], 0, 2) ) . ')';
                $conditions2[] = 'e2.statuses_id <> 1';
            }

            if ($data['from2'] || $data['to2']) {
                $conditions[] = 'e.date BETWEEN a.begin_datetime AND a.interrupt_datetime';
                $conditions2[] = 'e2.date BETWEEN a2.begin_datetime AND a2.interrupt_datetime';
            }

            $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;

            $sql =	'SELECT CONCAT(i.shassi,a.id) as id, i.policies_id,a.product_types_id, ' .
                    'a.number, ' .
                    'date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, ' .
                    'date_format(d.datetimeLast, ' . $db->quote(DATE_FORMAT) . ') as datetimeLastFormat, ' .
                    'a.insurer, ' .
                    'CONCAT(i.brand,\'/\',i.model) as item, ' .
                    'i.shassi, ' .
                    'i.sign, ' .
                    'date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, ' .
                    'date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetimeFormat, ' .
                    'i.car_price as price, ' .
                    'i.year, ' .
                    'h.title as risksTitle, ' .
                    'i.deductibles_value0, i.deductibles_absolute0, ' .
                    'i.deductibles_value1, i.deductibles_absolute1, ' .
                    'b.assured_title, ' .
                    'e.date, ' .
                    'e.statuses_id, ' .
                    'k.title as paymentStatusesTitle, ' .
                    'b.payment_brakedown_id, ' .
                    'b.options_deterioration_no ' .
                    'FROM ' . PREFIX . '_policies as a ' .
                    'LEFT JOIN ' . PREFIX . '_policies_kasko as b ON a.id = b.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_policies_kasko_items as i ON a.id = i.policies_id ' .
                    'LEFT JOIN (' .
                    'SELECT policies_id, MAX(datetime) AS datetimeFirst, MAX(datetime) AS datetimeLast ' .
                    'FROM ' . PREFIX . '_policy_payments ' .
                    'GROUP BY policies_id ' .
                    ') as d ON a.id = d.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_payments_calendar as e ON a.id = e.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_risks as f ON a.id = f.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_parameters_risks as h ON a.product_types_id = h.product_types_id AND f.risks_id = h.id ' .
                    'LEFT JOIN ' . PREFIX . '_payment_statuses as k ON e.statuses_id = k.id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'GROUP BY a.number, e.date, e.statuses_id, h.title,i.shassi ' .
                    'ORDER BY a.date ASC, id, i.shassi, e.date, d.datetimeLast ASC, h.order_position';
            $list1 = $db->getAll($sql);

            $sql = 'SELECT CONCAT(i2.shassi, a2.id) as id, i2.policies_id, a2.product_types_id, ' .
                    'LEFT(a2.number, LOCATE(\'-\', a2.number) - 1) as number, ' .
                    'date_format(a2.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, ' .
                    'date_format(e2.payment_date, ' . $db->quote(DATE_FORMAT) . ') as datetimeLastFormat, ' .
                    'a2.insurer, ' .
                    'CONCAT(i2.brand, \'/\', i2.model) as item, ' .
                    'i2.shassi, ' .
                    'i2.sign, ' .
                    'date_format(a2.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, ' .
                    'date_format(a2.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetimeFormat, ' .
                    'i2.car_price as price, ' .
                    'i2.year, ' .
                    'h2.title as risksTitle, ' .
                    'i2.deductibles_value0, i2.deductibles_absolute0, ' .
                    'i2.deductibles_value1, i2.deductibles_absolute1, ' .
                    'b2.assured_title, ' .
                    'e2.date, ' .
                    'e2.statuses_id, ' .
                    'k2.title as paymentStatusesTitle, ' .
                    'b2.payment_brakedown_id, ' .
                    'b2.options_deterioration_no ' .
                    'FROM ' . PREFIX . '_policies as a2 ' .
                    'JOIN ' . PREFIX . '_policies_kasko as b2 ON a2.id = b2.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_drive as b0 ON a2.id = b0.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as i2 ON a2.id = i2.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_payments_calendar as e2 ON b0.payments_id = e2.id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_risks as f2 ON a2.id = f2.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_parameters_risks as h2 ON h2.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND f2.risks_id = h2.id ' .
                    'LEFT JOIN ' . PREFIX . '_payment_statuses as k2 ON e2.statuses_id = k2.id ' .
                    'WHERE ' . implode(' AND ', $conditions2) . ' ' .
                    'GROUP BY a2.number, e2.date, e2.statuses_id, h2.title, i2.shassi ' .
                    'ORDER BY a2.date ASC, id, i2.shassi, e2.date, e2.payment_date ASC, h2.order_position';
            $list1 = array_merge($list1, $db->getAll($sql));

            $list = array();
            if (is_array($list1) && sizeof($list1)>0) {//группируем по рискам и датам оплат
                $i = 0;
                foreach($list1 as $row) {

                    if ($i>0 && $list[ $i - 1 ]['id'] == $row['id']) {

                        if (!in_array($row['risksTitle'], $list[ $i - 1 ]['risks'])) {
                            $list[ $i - 1 ]['risks'][] = $row['risksTitle'];
                        }

                        if (!in_array($row['date'], $payments)) {
                            $payments[] = $row['date'];
                            $list[ $i - 1 ]['payments'][] = array(
                                'date' => $row['date'],
                                'statuses_id' => $row['statuses_id'],
                                'paymentStatusesTitle' => $row['paymentStatusesTitle']);
                        }
                    } else {
                        $row['eventsNumber'] = $db->getOne('SELECT IF (COUNT(*), \'так\', \'ні\') FROM ' . PREFIX . '_accidents WHERE policies_id = ' . $row['policies_id']);
                        $list[ $i ] = $row;
                        $payments = array($row['date']);
                        $list[ $i ]['risks'] = array($row['risksTitle']);
                        $list[ $i ]['payments'][] = array(
                            'date' => $row['date'],
                            'statuses_id' => $row['statuses_id'],
                            'paymentStatusesTitle' => $row['paymentStatusesTitle']);
                        $i++;
                    }
                }
            }

            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Reinsurance/kaskoBorderoExcel.php';
        } else {
            include_once $this->object . '/Reinsurance/kaskoBordero.php';
        }
        exit;
    }

    //Отчеты по урегулированию
    function getCreatedActsByAvarage($data, $excel=false) {
		global $db, $Authorization;

		if ($data['from'] && $data['to']) {

			//Формируем массив, елементы которого - результат разбиения промежутка времени по одному дню в формате d.m.Y
			$date_title = array();
			$date_start = strtotime($data['from']);
			$date_end = strtotime($data['to']);

			while($date_start <= $date_end){
			   $date_title[] = date("d.m.Y",$date_start);
			   $date_start = mktime(0, 0, 0, date("m",$date_start), date("d", $date_start)+1, date("Y", $date_start));
			}

			//Выбираем всех аваркомов
			$sql =	'SELECT a.id as id, CONCAT(a.firstname, " ", a.lastname) AS fio ' .
					'FROM ' . PREFIX . '_accounts AS a ' .
					'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id AND account_groups_id = ' . ACCOUNT_GROUPS_AVERAGE;
			$avarage_managers = $db->getAll($sql);

			//Выбираем кол-во актов созданых аваркомами за каждый день входящий в выбраный промежуто data[from] - data[to]
			$sql =	'SELECT count(a.id) as count_acts,a.average_managers_id, CONCAT(CONCAT(c.firstname," ",c.lastname),"/",DATE_FORMAT(a.created,"%d.%m.%Y")) AS const_key, a.created ' .
					'FROM ' . PREFIX . '_accidents_acts AS a ' .
					'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.average_managers_id = b.accounts_id AND b.account_groups_id =' . ACCOUNT_GROUPS_AVERAGE . ' ' .
					'JOIN ' . PREFIX . '_accounts as c ON a.average_managers_id = c.id ' .
					'WHERE DATE(a.created) BETWEEN "' . date('Y-m-d',strtotime($data['from'])) . '" AND "' . date('Y-m-d', strtotime($data['to'])) . '" '.
					'GROUP BY a.average_managers_id, DATE(a.created)';
			$list = $db->getAll($sql, 30*60);

			//заполняем массив, где ключ-значение array[Имя Фамилия/Дата одного дня из промежутка] = кол-во созданых актов
			$average_counts_acts = array();
			foreach($list as $value){
				$average_counts_acts[$value['const_key']] = $value['count_acts'];
			}
		}

		if ($_POST['do']) {
			header('Content-Disposition: attachment; filename="report.xls"');
			header('Content-Type: ' . Form::getContentType('report.xls'));

			include_once $this->object . '/Accidents/getCreatedActsByAvarageExcel.php';
		} else {
			include_once $this->object . '/Accidents/getCreatedActsByAvarage.php';
		}
        exit;
	}

    function getCarServicesInWindow($data) {
        $this->getCarServices($data, true);
    }

    function getCarServices($data, $excel=false){
        global $db, $Log;	
        if(intval($data['is_ukravto']) == 1){
            $conditions[] = 'ukravto = 1';
            $i=0;
            $conditions2[] = '(';
            for($i=0; $i< sizeof($data['month']) - 1; $i++){
                $conditions2[] = 'b.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]) + 1, 0, intval($data['year'])))) . ' OR ';
            }
            $conditions2[] = 'b.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]) + 1, 0, intval($data['year'])))) . ')';

        }
        else{
            $conditions[] = '1';
            $i=0;
            $conditions2[] = '(';
            for($i=0; $i< sizeof($data['month']) - 1; $i++){
                $conditions2[] = 'b.created BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]) + 1, 0, intval($data['year'])))) . ' OR ';
            }
            $conditions2[] = 'b.created BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]) + 1, 0, intval($data['year'])))) . ')';
        }

        $i=0;
        $conditions3[] = '(';
        for($i=0; $i< sizeof($data['month']) - 1; $i++){
            $conditions3[] = 'DATE(created) BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]) + 1, 0, intval($data['year'])))) . ' OR ';
        }
        $conditions3[] = 'DATE(created) BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]) + 1, 0, intval($data['year'])))) . ')';

        $conditions4[] = 'b.product_types_id IN (' . PRODUCT_TYPES_KASKO . ')';

        //if($_POST['do']){
            if(!$data['month']){
                $Log->add('error', 'Виберіть місяць');
            }
            else{
                //Выбираем все СТО с сортировкой по регионам
                $sql =    'SELECT a.id, a.title as car_services_title, a.regions_id, b.title as regions_title, c.bank_edrpou as edrpou ' .
                        'FROM ' . PREFIX . '_car_services AS a ' .
                        'JOIN ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
                        'JOIN ' . PREFIX . '_car_services_banking_details as c ON c.car_services_id = a.id '  .
                        'WHERE ' . implode(' AND ', $conditions) . ' and b.id IN (10, 26) ' .
                        'GROUP BY c.id ' .
                        'ORDER BY b.order_position DESC, a.title';
                $car_services_kiev = $db->getAll($sql, 30 * 60);

                $sql =    'SELECT a.id, a.title as car_services_title, a.regions_id, b.title as regions_title, c.bank_edrpou as edrpou ' .
                        'FROM ' . PREFIX . '_car_services AS a ' .
                        'JOIN ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
                        'JOIN ' . PREFIX . '_car_services_banking_details as c ON c.car_services_id = a.id '  .
                        'WHERE ' . implode(' AND ', $conditions) . ' and b.id NOT IN (10, 26) ' .
                        'GROUP BY c.id ' .
                        'ORDER BY b.order_position DESC, a.title';
                $car_services_others = $db->getAll($sql, 30 * 60);

                $sql =    'SELECT a.id, COUNT(a.id) as count_accidents, d.count_insurance1, e.count_insurance2, SUM(b.amount_rough) as amount_rough ' .
                        'FROM ' . PREFIX . '_car_services AS a ' .
                        'LEFT JOIN ' . PREFIX . '_accidents AS b ON a.id = b.car_services_id ' .
                        'JOIN  ' . PREFIX . '_regions AS c ON c.id = a.regions_id ' .
                        'LEFT JOIN (SELECT car_services_id, count(id) AS count_insurance1 FROM ' . PREFIX . '_accidents WHERE ' . implode(' ', $conditions3) . ' and insurance = 1 GROUP BY car_services_id) AS d ON a.id = d.car_services_id ' .
                        'LEFT JOIN (SELECT car_services_id, count(id) AS count_insurance2 FROM ' . PREFIX . '_accidents WHERE ' . implode(' ', $conditions3) . ' and insurance = 2 GROUP BY car_services_id) AS e ON a.id = e.car_services_id ' .
                        'WHERE ' . implode(' ', $conditions2) . ' and ' . implode(' and ', $conditions4) . ' and c.id IN (10, 26) ' .
                        'GROUP BY a.id';
                $counts_kiev = $db->getAssoc($sql, 30 * 60);

                $sql =    'SELECT a.id, COUNT(a.id) as count_accidents, d.count_insurance1, e.count_insurance2, SUM(b.amount_rough) as amount_rough ' .
                        'FROM ' . PREFIX . '_car_services AS a ' .
                        'LEFT JOIN ' . PREFIX . '_accidents AS b ON a.id = b.car_services_id ' .
                        'JOIN  ' . PREFIX . '_regions AS c ON c.id = a.regions_id ' .
                        'LEFT JOIN (SELECT car_services_id, count(id) AS count_insurance1 FROM ' . PREFIX . '_accidents WHERE ' . implode(' ', $conditions3) . ' and insurance = 1 GROUP BY car_services_id) AS d ON a.id = d.car_services_id ' .
                        'LEFT JOIN (SELECT car_services_id, count(id) AS count_insurance2 FROM ' . PREFIX . '_accidents WHERE ' . implode(' ', $conditions3) . ' and insurance = 2 GROUP BY car_services_id) AS e ON a.id = e.car_services_id ' .
                        'WHERE ' . implode(' ', $conditions2) . ' and ' . implode(' and ', $conditions4) . ' and c.id NOT IN (10, 26) ' .
                        'GROUP BY a.id';
                $counts_others = $db->getAssoc($sql, 30 * 60);

                $sql =    'SELECT c.id , SUM(getAccidentsDeductible(b.id)) AS amount_deductibles, SUM(getCompensation(b.id, 0)) AS amount_amount ' .
                        //'FROM ' . PREFIX . '_accidents_kasko_acts as a ' .
                        //'JOIN ' . PREFIX . '_accidents_acts as aa ON a.accidents_acts_id = aa.id ' .
                        'FROM ' . PREFIX . '_accidents as b ' .
                        'JOIN ' . PREFIX . '_car_services as c ON b.car_services_id = c.id ' .
                        'JOIN  ' . PREFIX . '_regions AS d ON d.id = c.regions_id ' .
                        'WHERE ' . implode(' ', $conditions2) . ' and ' . implode(' and ', $conditions4) . ' AND b.insurance = 1 and d.id IN (10, 26) ' .
                        'GROUP BY c.id';
                $amounts_kiev = $db->getAssoc($sql, 30 * 60);

                $sql =    'SELECT c.id , SUM(getAccidentsDeductible(b.id)) AS amount_deductibles, SUM(getCompensation(b.id, 1)) AS amount_amount ' .
                        //'FROM ' . PREFIX . '_accidents_kasko_acts as a ' .
                        //'JOIN ' . PREFIX . '_accidents_acts as aa ON a.accidents_acts_id = aa.id ' .
                        'FROM ' . PREFIX . '_accidents as b ' .
                        'JOIN ' . PREFIX . '_car_services as c ON b.car_services_id = c.id ' .
                        'JOIN  ' . PREFIX . '_regions AS d ON d.id = c.regions_id ' .
                        'WHERE ' . implode(' ', $conditions2) . ' and ' . implode(' and ', $conditions4) . ' AND b.insurance = 1 and d.id NOT IN (10, 26) ' .
                        'GROUP BY c.id';
                $amounts_others = $db->getAssoc($sql, 30 * 60);
            }
        //}
        if ($_POST['do']) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));
            include_once $this->object . '/Accidents/getCarServicesExcel.php';
            exit;
        }
        else{
            include_once $this->object . '/Accidents/getCarServices.php';
            exit;
        }
    }

    function getPolicyBlanks($data, $excel=false) {
        global $db, $Authorization;

        $this->checkPermissions('getPolicyBlanks', $data);

        if (isset($_POST['InWindow'])) {

            if ($Authorization->data['roles_id'] == ROLES_AGENT) {
                $data['agencies_id'] = $Authorization->data['agencies_id'];
            }

            if (intval($data['agencies_id'])) {
                $Agencies = new Agencies($data);
                $agencies_id = array($data['agencies_id']);
                $Agencies->getSubId(&$agencies_id, $data['agencies_id']);

                $fields[] = 'agencies_id';
                $conditions[] =   'a.agencies_id IN(' . implode(', ', $agencies_id) . ')';
            }

            $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;

            $conditions[] = 'insurance_companies_id = ' . intval($data['insurance_companies_id']);

            if (!intval($data['product_types_id'])) {
                $data['product_types_id'] = PRODUCT_TYPES_GO;
            }

            $conditions[] = 'product_types_id = ' . intval($data['product_types_id']);

            //реализация в текущем месяце
            $conditions1[] = 'a1.insurance_companies_id = ' . intval($data['insurance_companies_id']);
            $conditions1[] = 'a1.product_types_id = ' . intval($data['product_types_id']);
            $conditions1[] = 'c1.product_types_id = ' . PRODUCT_TYPES_GO;

            if (intval($data['product_types_id']) == PRODUCT_TYPES_GO) {
                $conditions1[] = 'begin_datetime >= ' . $db->quote( date('Y.m.d H:i:s', mktime(0, 0, 0, date('m'), 1, date('Y'))) );
                $conditions1[] = 'begin_datetime <= ' . $db->quote( date('Y.m.d H:i:s', mktime(23, 59, 59, date('m')+1, 0, date('Y'))) );
            }

            $conditions3[] = 'a1.insurance_companies_id = ' . intval($data['insurance_companies_id']);
            $conditions3[] = 'a1.product_types_id = ' . intval($data['product_types_id']);

            if (intval($data['product_types_id']) == PRODUCT_TYPES_GO) {
                $conditions3[] = 'mtsbu_date = ' . $db->quote( '0000-00-00 00:00:00' );
            }

            //реализация в предыдущем месяце
            $conditions2[] = 'a2.insurance_companies_id = ' . intval($data['insurance_companies_id']);
            $conditions2[] = 'a2.product_types_id = ' . intval($data['product_types_id']);
            $conditions2[] = 'c2.product_types_id = ' . PRODUCT_TYPES_GO;

            if (intval($data['product_types_id']) == PRODUCT_TYPES_GO) {
                $conditions2[] = 'begin_datetime >= ' . $db->quote( date('Y.m.d H:i:s', mktime(0, 0, 0, date('m')-1, 1, date('Y'))) );
                $conditions2[] = 'begin_datetime <= ' . $db->quote( date('Y.m.d H:i:s', mktime(23, 59, 59, date('m'), 0, date('Y'))) );
            }

            switch (intval($data['product_types_id'])) {
                case PRODUCT_TYPES_KASKO:
                    $sql =	'SELECT a.code, a.title, ' .
                            'SUM(IF(b.blank_statuses_id = 1, 1, 0)) AS clear_quantity, ' .
                            'c.use_quantity, ' .
                            'c.spoiled_quantity, ' .
                            'c1.lost_quantity, ' .
                            'd.used_quantity ' .
                            'FROM ' . PREFIX . '_agencies AS a ' .
                            'JOIN ' . PREFIX . '_policy_blanks AS b ON a.id = b.agencies_id ' .
                            'LEFT JOIN ' . PREFIX . '_agencies AS z ON a.parent_id = z.id ' .
                            'LEFT OUTER JOIN ( ' .
                                'SELECT
                                     SUM(IF(blank_statuses_id = 4, 1, 0)) AS lost_quantity ,
                                     a1.agencies_id
                                FROM ' . PREFIX . '_policy_blanks AS a1
                                JOIN ' . PREFIX . '_policies AS c1 ON a1.number = c1.certificate
                                WHERE ' . implode(' AND ', $conditions1) . '
                                GROUP BY agencies_id) AS c1 ON a.id = c1.agencies_id ' .
                            'LEFT OUTER JOIN ( ' .
                                'SELECT
                                     SUM(IF(blank_statuses_id = 2, 1, 0)) AS use_quantity,
                                     SUM(IF(blank_statuses_id = 3, 1, 0)) AS spoiled_quantity,
                                     a1.agencies_id
                                FROM ' . PREFIX . '_policy_blanks AS a1
                                JOIN ' . PREFIX . '_policies AS c1 ON a1.number = c1.certificate
                                WHERE ' . implode(' AND ', $conditions1) . '
                                GROUP BY agencies_id) AS c ON a.id = c.agencies_id ' .
                            'LEFT OUTER JOIN (
                                SELECT COUNT(a2.id) AS used_quantity, a2.agencies_id
                                FROM ' . PREFIX . '_policy_blanks AS a2
                                JOIN ' . PREFIX . '_policies AS c2 ON a2.number = c2.certificate
                                WHERE ' . implode(' AND ', $conditions2) . '
                                GROUP BY agencies_id) AS d ON a.id = d.agencies_id ' .
                            'WHERE ' . implode(' AND ', $conditions) . ' AND IF(z.id > 0, z.orderposition_report, a.orderposition_report) > 0 ' .
                            'GROUP BY b.agencies_id, c.agencies_id, c1.agencies_id,d.agencies_id ' .
                            'ORDER BY IF(z.id > 0, z.orderposition_report, a.orderposition_report)';
                    $list =	$db->getAll($sql, 30 * 60);
                    break;
                case PRODUCT_TYPES_GO:

                    $sql =	'SELECT a.code, a.title, ' .
                            'SUM(IF(b.blank_statuses_id = 1, 1, 0)) AS clear_quantity, ' .
                            'c.use_quantity, ' .
                            'c.spoiled_quantity, ' .
                            'c1.lost_quantity, ' .
                            'd.used_quantity ' .
                            'FROM ' . PREFIX . '_agencies AS a ' .
                            'JOIN ' . PREFIX . '_policy_blanks AS b ON a.id = b.agencies_id ' .
                            'LEFT JOIN ' . PREFIX . '_agencies AS z ON a.parent_id = z.id ' .
                            'LEFT OUTER JOIN ( ' .
                                'SELECT
                                     SUM(IF(blank_statuses_id = 4, 1, 0)) AS lost_quantity ,
                                      a1.agencies_id
                                FROM ' . PREFIX . '_policy_blanks AS a1
                                WHERE ' . implode(' AND ', $conditions3) . '
                                GROUP BY agencies_id) AS c1 ON a.id = c1.agencies_id ' .
                            'LEFT OUTER JOIN ( ' .
                                'SELECT
                                     SUM(IF(blank_statuses_id = 2, 1, 0)) AS use_quantity,
                                     SUM(IF(blank_statuses_id = 3, 1, 0)) AS spoiled_quantity,
                                     a1.agencies_id
                                FROM ' . PREFIX . '_policy_blanks AS a1
                                JOIN ' . PREFIX . '_policies_go AS b1 ON a1.series = b1.blank_series AND a1.number = b1.blank_number
                                JOIN ' . PREFIX . '_policies AS c1 ON b1.policies_id = c1.id
                                WHERE ' . implode(' AND ', $conditions1) . '
                                GROUP BY agencies_id) AS c ON a.id = c.agencies_id ' .
                            'LEFT OUTER JOIN (
                                SELECT COUNT(a2.id) AS used_quantity, a2.agencies_id
                                FROM ' . PREFIX . '_policy_blanks AS a2
                                JOIN ' . PREFIX . '_policies_go AS b2 ON a2.series = b2.blank_series AND a2.number = b2.blank_number
                                JOIN ' . PREFIX . '_policies AS c2 ON b2.policies_id = c2.id
                                WHERE ' . implode(' AND ', $conditions2) . '
                                GROUP BY agencies_id) AS d ON a.id = d.agencies_id ' .
                            'WHERE ' . implode(' AND ', $conditions) . ' AND IF(z.id > 0, z.orderposition_report, a.orderposition_report) > 0 ' .
                            'GROUP BY b.agencies_id, c.agencies_id,c1.agencies_id, d.agencies_id ' .
                            'ORDER BY IF(z.id > 0, z.orderposition_report, a.orderposition_report)';
                    $list =	$db->getAll($sql, 30 * 60);
                    break;
            }

            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/policyBlanksExcel.php';
            exit;
        } else {
            $sql =	'SELECT id, code, title, level ' .
                    'FROM ' . PREFIX . '_agencies ' .
                    'ORDER BY CAST(code as UNSIGNED), num_l';
            $agencies = $db->getAll($sql, 60 * 60);

            include_once $this->object . '/policyBlanks.php';
            exit;
        }
    }

    function getAccidentsActsSTO($data, $excel=false){
        global $db, $Authorization;

        if (!isset($data['ukravto'])) {
            $data['ukravto'] = 1;
        }

        if (!$data['from']) {
            $data['from'] = date('d.m.Y', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        }

        if (!$data['to']) {
            $data['to'] = date('d.m.Y', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        }

        $conditions = array();

        $conditions[] = 'accidents.companies_id = ' . INSURANCE_COMPANIES_EXPRESS;

        $conditions[] = 'accidents.product_types_id = ' . PRODUCT_TYPES_KASKO;

        if (sizeof($data['car_services_id']) > 0){
            $conditions[] = 'accidents.car_services_id IN (' . implode(',', $data['car_services_id']) . ')';
        }

        if ($data['ukravto'] >= 0) {
            $conditions[] = 'car_services.ukravto = ' . $data['ukravto'];
        }
		
		$conditions[] = 'accidents_acts.in_repair = 1';

        $from   = $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
        $to		= $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');

        $conditions[] = 'accidents_acts.created BETWEEN ' . $from  . ' AND ' . $to;

        if (sizeof($Authorization->data['account_groups_id']) == 1 && in_array(ACCOUNT_GROUPS_SERVICE_DEPARTMENT, $Authorization->data['account_groups_id'])) {
            if(is_array($Authorization->data['service_department_car_services_id']) && sizeof($Authorization->data['service_department_car_services_id'])) {
                $cond = ' AND recipients_id IN( ' . implode(', ', $Authorization->data['service_department_car_services_id']) . ')';
            } else {
                $cond = ' AND 0';
            }
        }

        $sql = 'SELECT id, title FROM ' . PREFIX . '_car_services WHERE ukravto = 1 ORDER BY title';
        $car_services_ukravto = $db->getAll($sql);

        $sql = 'SELECT id, title FROM ' . PREFIX . '_car_services WHERE ukravto = 0 ORDER BY title';
        $car_services_no_ukravto = $db->getAll($sql);

        $sql = 'SELECT accidents.number as accidents_number, date_format(accidents.date, \'%d.%m.%Y\') AS accidents_date, ' .
                       'IF(policies_kasko.insurer_person_types_id = 2, policies_kasko.insurer_company, CONCAT(policies_kasko.insurer_lastname, \' \', policies_kasko.insurer_firstname)) as insurer, ' .
                       'CONCAT(policies_kasko_items.brand, \' \', policies_kasko_items.model) AS item, ' .
                       'policies_kasko_items.sign, accidents.repair_classifications_id, payment_statuses.title AS payment_statuses_id, ' .
                       'accidents_acts.number as accidents_acts_number, date_format(accident_payments_calendar.payment_date, \'%d.%m.%Y\') as payments_date, ' .
                       'accidents_acts.amount as compensation, car_services.title as auto_services_id ' .
               'FROM ' . PREFIX . '_accidents_acts as accidents_acts ' .
               'JOIN ' . PREFIX . '_accidents as accidents ON accidents_acts.accidents_id = accidents.id ' .
               'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
               'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as policies_kasko_items ON policies.id = policies_kasko_items.policies_id ' .
               'JOIN ' . PREFIX . '_payment_statuses as payment_statuses ON accidents_acts.payment_statuses_id = payment_statuses.id ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as accident_payments_calendar ON accidents_acts.id = accident_payments_calendar.acts_id ' .
               'JOIN ' . PREFIX . '_car_services as car_services ON accidents.car_services_id = car_services.id ' .
               'JOIN (
                    SELECT acts_id, recipients_id, amount, payment_date
                    FROM ' . PREFIX . '_accident_payments_calendar
                    WHERE payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . $cond . ' GROUP BY accidents_id) as calendar ON accidents_acts.id = calendar.acts_id AND calendar.recipients_id = accidents.car_services_id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' AND getStateInRepair(accidents.id) = 1 ' .
               'GROUP BY accidents_acts.id ' .
               'ORDER BY accidents.number';
        $list = $db->getAll($sql);

        if ($_POST['do']) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getAccidentsActsSTOExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getAccidentsActsSTO.php';
            exit;
        }
    }

    function getAccidentsActsSTOInWindow($data){
        $this->getAccidentsActsSTO($data, true);
    }

    function getAccidentMessagesReport($data, $excel=false){
        global $db, $Authorization;
		
		$hidden['do'] = $data['do'];

        $sql = 'SELECT id, CONCAT_WS(\' \', lastname, firstname) as title ' .
               'FROM ' . PREFIX . '_accounts ' .
               'WHERE active = 1 AND roles_id = ' . ROLES_MANAGER . ' ' .
               'ORDER BY lastname, firstname';
        $recipients = $authors = $db->getAll($sql);

        $sql = 'SELECT account_groups.id, account_groups.recipient_organization as title ' .
               'FROM ' . PREFIX . '_account_groups as account_groups ' .
               'JOIN ' . PREFIX . '_accident_messages as messages ON account_groups.id = messages.recipient_organizations_id ' .
               'WHERE LENGTH(account_groups.recipient_organization) > 0 ' .
               'GROUP BY account_groups.id ' .
               'ORDER BY account_groups.recipient_organization';
        $recipient_organizations = $db->getAll($sql);

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_accident_message_types ' .
               //'WHERE id NOT IN(' . ACCIDENT_MESSAGE_TYPES_MESSAGE . ', ' . ACCIDENT_MESSAGE_TYPES_ACCIDENT_NUMBER_CALL . ') ' .
               'ORDER BY title';
        $message_types = $db->getAll($sql);

        $conditions = array();

        //$conditions[] = 'message_types_id NOT IN(' . ACCIDENT_MESSAGE_TYPES_MESSAGE . ', ' . ACCIDENT_MESSAGE_TYPES_ACCIDENT_NUMBER_CALL . ')';
		
		$conditions[] = '1';

        if (is_array($data['statuses_id']) && sizeof($data['statuses_id'])) {
			$hidden['statuses_id'] = $data['statuses_id'];
            $conditions[] = 'statuses_id IN(' . implode(', ', $data['statuses_id']) . ')';
        }

        if (is_array($data['recipients_id']) && sizeof($data['recipients_id'])) {
			$hidden['recipients_id'] = $data['recipients_id'];
            $conditions[] = 'recipients_id IN(' . implode(', ', $data['recipients_id']) . ')';
        }

        if (is_array($data['authors_id']) && sizeof($data['authors_id'])) {
			$hidden['authors_id'] = $data['authors_id'];
            $conditions[] = 'authors_id IN(' . implode(', ', $data['authors_id']) . ')';
        }

        if (is_array($data['message_types_id']) && sizeof($data['message_types_id'])) {
			$hiiden['message_types_id'] = $data['message_types_id'];
            $conditions[] = 'message_types_id IN(' . implode(', ', $data['message_types_id']) . ')';
        }

        if ($data['accidents_number']) {
			$hidden['accidents_number'] = $data['accidents_number'];
            $conditions[] = 'number LIKE \'%' . $data['accidents_number'] . '%\'';
        }

        if (is_array($data['recipient_organizations_id']) && sizeof($data['recipient_organizations_id'])) {
			$hidden['recipient_organizations_id'] = $data['recipient_organizations_id'];
            $conditions[] = 'messages.recipient_organizations_id IN(' . implode(', ', $data['recipient_organizations_id']) . ')';
        }
		
		if (is_array($data['product_types_id']) && sizeof($data['product_types_id'])) {
			$hidden['product_types_id'] = $data['product_types_id'];
            $conditions[] = 'accidents.product_types_id IN(' . implode(', ', $data['product_types_id']) . ')';
        }

        $sql = 'SELECT accidents.number as accidents_number, CONCAT_WS(\' \', account_average.lastname, account_average.firstname) as average_manager, accident_statuses.title as accident_statuses_title, message_types.title as message_types_title, messages.author, messages.recipient, messages.recipient_organization, date_format(MIN(status_changes.created), \'%d.%m.%Y\') as investigated_date, ' .
                      'date_format(messages.created, \'%d.%m.%Y\') as created_date, date_format(messages.decision, \'%d.%m.%Y\') as decision_date, TO_DAYS(messages.decision) - TO_DAYS(messages.created) as days, ' .
                      'CASE messages.statuses_id ' .
                            'WHEN ' . ACCIDENT_MESSAGE_STATUSES_QUESTION . ' THEN \'задача\' ' .
                            'WHEN ' . ACCIDENT_MESSAGE_STATUSES_ANSWER . ' THEN \'рішення\' ' .
                            'WHEN ' . ACCIDENT_MESSAGE_STATUSES_ERROR . ' THEN \'помилки\' ' .
                            'WHEN ' . ACCIDENT_MESSAGE_STATUSES_INTERRUPTED . ' THEN \'перервано\' ' .
                      'END as statuses ' .
               'FROM ' . PREFIX . '_accident_messages as messages ' .
               'JOIN ' . PREFIX . '_accidents as accidents ON messages.accidents_id = accidents.id ' .
               'JOIN ' . PREFIX . '_accident_message_types as message_types ON messages.message_types_id = message_types.id ' .
			   'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents.accident_statuses_id = accident_statuses.id ' .
               'LEFT JOIN ' . PREFIX . '_accident_status_changes as status_changes ON messages.accidents_id = status_changes.accidents_id AND status_changes.accident_statuses_id = ' . ACCIDENT_STATUSES_INVESTIGATION . ' ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as account_average ON accidents.average_managers_id = account_average.id ' .
               'WHERE ' . implode(' AND ', $conditions);      
		
		$total = $db->getOne(transformToGetCount($sql));
		
		$sql .= ' GROUP BY messages.id ORDER BY messages.id';  
		
		 
		
		

        if (isset($_POST['do'])) {
			$list = $db->getAll($sql);
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getAccidentMessagesReportExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getAccidentMessagesReport.php';
            exit;
        }
    }

    function getAccidentMessagesReportInWindow($data){
        $this->getAccidentMessagesReport($data, true);
    }

    function getProlongationPolicies($data){
        global $db;

        $from   = $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
        $to		= $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');

        $conditions = array();

        if (intval($data['agencies_id'])) {
            $Agencies = new Agencies($data);
            $agencies_id = array($data['agencies_id']);
            $Agencies->getSubId(&$agencies_id, $data['agencies_id']);
            $fields[] = 'agencies_id';
            //$conditions[] =   'policies.agencies_id IN(' . implode(', ', $agencies_id) . ')';
        }

        if (intval($data['financial_institutions_id'])) {
            //$conditions[] = 'policies_kasko.financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }
        if (intval($data['person_types_id'])) {
            $conditions[] = 'policies_kasko.insurer_person_types_id = ' . intval($data['person_types_id']);
        }
        $conditions[] = 'policies.product_types_id = ' . PRODUCT_TYPES_KASKO;
        $conditions[] = 'policies.insurance_companies_id = ' . $data['insurance_companies_id'];

        if (intval($data['advanced'])) {//розширений
            $from_date = 'DATE_SUB(' . $from . ', INTERVAL ' . POLICY_CONTINUE_PERIOD . ')';
            $to_date = 'DATE_ADD(' . $to . ', INTERVAL 1 MONTH)';
        } else {
            $from_date = $from;
            $to_date = $to;
        }

        $mode = 0;

        if (!intval($data['mode']) && intval($data['strong'])) {//виключно, факт
			//$conditions[] = 'calendar.payment_date BETWEEN ' . $db->quote($from_date) . ' AND ' . $db->quote($to_date);
            $mode = 3;
        } elseif (intval($data['mode']) && !intval($data['strong'])) {//план
			//$conditions[] = 'calendar.date BETWEEN ' . $db->quote($from_date) . ' AND ' . $db->quote($to_date);
            $mode = 1;
        } elseif (!intval($data['mode']) && !intval($data['strong'])) {//факт
			//$conditions[] = 'calendar.payment_date BETWEEN ' . $db->quote($from_date) . ' AND ' . $db->quote($to_date);
            $mode = 2;//old 2
        }

        if ($mode > 0) {
            $result = array();

            $sql = 'SELECT getProlongationPoliciesId(policies.top, ' . $from_date . ', ' . $to_date . ', ' . $mode .  ') as id ' .
                   'FROM insurance_policies as policies ' .
                   'JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
				   'JOIN insurance_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
                   'WHERE ' . implode(' AND ', $conditions) . ' ' .
                   'GROUP BY policies.top ' .
                   'HAVING id > 0';

            $res = $db->getCol($sql);

            if (sizeof($res) > 0) {
                $result[] = 'a.id IN(' . implode(', ', $res) . ')';

		if (intval($data['agencies_id'])) {
                	$Agencies = new Agencies($data);
		        $agencies_id = array($data['agencies_id']);
		        $Agencies->getSubId(&$agencies_id, $data['agencies_id']);
                    	$fields[] = 'agencies_id';
                    	$result[] =   'a.agencies_id IN(' . implode(', ', $agencies_id) . ')';
	        }
        	if (intval($data['financial_institutions_id'])) {
                    	$result[] = 'b.financial_institutions_id = ' . intval($data['financial_institutions_id']);
	        }
        	if (intval($data['person_types_id'])) {
                	$result[] = 'b.insurer_person_types_id = ' . intval($data['person_types_id']);
	        }
       		$result[] = 'a.product_types_id = ' . PRODUCT_TYPES_KASKO;
	        $result[] = 'a.insurance_companies_id = ' . $data['insurance_companies_id'];
            } else {
                $result[] = 'a.id IN (0)';
            }

            if ($data['prolonged']) {

                $sql = 'SELECT getProlongationPoliciesId(policies.id, ' . $from_date . ', ' . $to_date . ', 4) as id ' .
                       'FROM insurance_policies as policies ' .
                       'JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
                       'WHERE ' . implode(' AND ', $conditions) . ' ' .
                       'GROUP BY policies.top ' .
                       'HAVING id > 0';
                
                $res = $db->getCol($sql);

                if (sizeof($res) > 0) {
                    $result[] = 'a.id NOT IN(' . implode(', ', $res) . ')';

			if (intval($data['agencies_id'])) {
                    		$Agencies = new Agencies($data);
		                $agencies_id = array($data['agencies_id']);
		                $Agencies->getSubId(&$agencies_id, $data['agencies_id']);
                    		$fields[] = 'agencies_id';
                    		$result[] =   'a.agencies_id IN(' . implode(', ', $agencies_id) . ')';
	                }
        	        if (intval($data['financial_institutions_id'])) {
                	    	$result[] = 'b.financial_institutions_id = ' . intval($data['financial_institutions_id']);
	                }
        	        if (intval($data['person_types_id'])) {
                    		$result[] = 'b.insurer_person_types_id = ' . intval($data['person_types_id']);
	                }
       		        $result[] = 'a.product_types_id = ' . PRODUCT_TYPES_KASKO;
	                $result[] = 'a.insurance_companies_id = ' . $data['insurance_companies_id'];
                } else {
                    $result[] = 'a.id NOT IN (0)';
                }
            }
        } else {
            $result[] = 'a.id IN (0)';
        }

        return $result;
    }


    function getRepairInfo($data, $excel=false) {
        global $db, $Authorization;
		
		$hidden['do'] = $data['do'];

        $car_services = CarServices::getAllCarServices();

        $conditions[] = '1';

        if ($data['accidents_number']) {
			$hidden['accidents_number'] = $data['accidents_number'];
            $conditions[] = 'accidents.number LIKE ' . $db->quote('%' . $data['accidents_number'] . '%');
        }

        if ($data['owner']) {
			$hidden['owner'] = $data['owner'];
            $conditions[] = 'policies_kasko.owner_lastname LIKE ' . $db->quote('%' . $data['owner'] . '%');
        }

        if ($data['shassi']) {
			$hidden['shassi'] = $data['shassi'];
            $conditions[] = 'policies_kasko_items.shassi LIKE ' . $db->quote('%' . $data['shassi'] . '%');
        }

        if ($data['car_services_id']) {
			$hidden['car_services_id'] = $data['car_services_id'];
            $conditions[] = 'car_services.id = ' . intval($data['car_services_id']);
        }

        if ($data['audatex_number']) {
			$hidden['audatex_number'] = $data['audatex_number'];
            $conditions[] = 'repair_info.number_audanet LIKE ' . $db->quote('%' . $data['audatex_number'] . '%');
        }
		
		if ($data['from_calc']) {
			$hidden['from_calc'] = $data['from_calc'];
            $conditions[] = 'TO_DAYS(repair_info.document_date) >= TO_DAYS(' . $db->quote(substr($data['from_calc'], 6, 4) . '-' . substr($data['from_calc'], 3, 2) . '-' . substr($data['from_calc'], 0, 2)) . ')';
        }

        if ($data['to_calc']) {
			$hidden['to_calc'] = $data['to_calc'];
            $conditions[] = 'TO_DAYS(repair_info.document_date) <= TO_DAYS(' . $db->quote(substr($data['to_calc'], 6, 4) . '-' . substr($data['to_calc'], 3, 2) . '-' . substr($data['to_calc'], 0, 2)) . ')';
        }

        if ($data['from_exchange']) {
			$hidden['from_exchange'] = $data['from_exchange'];
            $conditions[] = 'TO_DAYS(repair_info.last_date_exchange) >= TO_DAYS(' . $db->quote(substr($data['from_exchange'], 6, 4) . '-' . substr($data['from_exchange'], 3, 2) . '-' . substr($data['from_exchange'], 0, 2)) . ')';
        }

        if ($data['to_exchange']) {
			$hidden['to_exchange'] = $data['to_exchange'];
            $conditions[] = 'TO_DAYS(repair_info.last_date_exchange) <= TO_DAYS(' . $db->quote(substr($data['to_exchange'], 6, 4) . '-' . substr($data['to_exchange'], 3, 2) . '-' . substr($data['to_exchange'], 0, 2)) . ')';
        }

		$join = '';
		
		if ($data['groupby']) {
			$join = 'JOIN (
						SELECT payments_calendar_id, MAX(info.last_date_exchange) as last_date
						FROM insurance_accident_repair_info as info 
						GROUP BY payments_calendar_id) as last_exchange ON repair_info.payments_calendar_id = last_exchange.payments_calendar_id AND repair_info.last_date_exchange = last_exchange.last_date ';
			
		}
		
        $sql = 'SELECT IF(payments_calendar.id IS NULL, \'Не ідентифіковано\', accidents.number) as accidents_number, ' .
                    'IF(payments_calendar.id IS NULL, \'Не ідентифіковано\', IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company), IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname))) as insurer, ' .
                    'IF(payments_calendar.id IS NULL, \'Не ідентифіковано\', IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', CONCAT_WS(\' \', policies_kasko_items.brand, policies_kasko_items.model), CONCAT_WS(\' \', policies_go.brand, policies_go.model))) as item, ' .
                    'IF(payments_calendar.id IS NULL, \'Не ідентифіковано\', IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', policies_kasko_items.sign, policies_go.sign)) as sign, ' .
                    'IF(payments_calendar.id IS NULL, \'Не ідентифіковано\', IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', policies_kasko_items.shassi, policies_go.shassi)) as shassi, ' .
                    'IF(payments_calendar.id IS NULL, \'Не ідентифіковано\', car_services.title) as  car_services_title, ' .
                    'repair_info.car_services_edrpou, repair_info.number_audanet, date_format(repair_info.document_date, \'%d.%m.%Y\') as document_date_format, ' .
                    'repair_info.amount, date_format(repair_info.order_parts_date, \'%d.%m.%Y\') as order_parts_date_format, date_format(repair_info.order_outfit_begin_date, \'%d.%m.%Y\') as order_outfit_begin_date_format, ' .
                    'repair_info.order_outfit_begin_amount, repair_info.order_outfit_begin_author, date_format(repair_info.order_outfit_end_date, \'%d.%m.%Y\') as order_outfit_end_date_format, ' .
                    'repair_info.order_outfit_end_amount, repair_info.deductible_amount, repair_info.order_outfit_end_author, ' .
                    'date_format(repair_info.last_date_exchange, \'%d.%m.%Y\') as last_date_exchange_format,  date_format(repair_info.created, \'%d.%m.%Y\') as created_format ' .
               'FROM ' . PREFIX . '_accident_repair_info as repair_info ' .
               'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as payments_calendar ON repair_info.payments_calendar_id = payments_calendar.id ' .
               'LEFT JOIN ' . PREFIX . '_car_services as car_services ON payments_calendar.recipients_id = car_services.id ' .
               'LEFT JOIN ' . PREFIX . '_accidents as accidents ON payments_calendar.accidents_id = accidents.id ' .
               'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'LEFT JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_items as policies_kasko_items ON accidents_kasko.items_id = policies_kasko_items.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
			   $join .
               'WHERE ' . implode(' AND ', $conditions);
			   
		$total = $db->getOne(transformToGetCount($sql));
		

        if (isset($_POST['do'])) {
			$list = $db->getAll($sql);
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getRepairInfoReportExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getRepairInfoReport.php';
            exit;
        }
    }

    function getRepairInfoInWindow($data) {
        $this->getRepairInfo($data, true);
    }
	
	function getPaymentsAndPremiums($data, $excel=false) {
		global $db;
		
		if (!$data['from']) {
			$data['from'] = date('d.m.Y', mktime(0, 0, 0, date('m'), 1, date('Y')));
		}
		
		if (!$data['to']) {
			$data['to'] = date('d.m.Y', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
		}
		
		if ($data['from']) {
			$hidden['from'] = $data['from'];
			$from = substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2);
            $conditions_accidents[] = 'TO_DAYS(accident_payments.date) >= TO_DAYS(' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2)) . ')';
			$conditions_policies[] = 'TO_DAYS(policy_payments.date) >= TO_DAYS(' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2)) . ')';
        }

        if ($data['to']) {
			$hidden['to'] = $data['to'];
			$to = substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2);
            $conditions_accidents[] = 'TO_DAYS(accident_payments.date) <= TO_DAYS(' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2)) . ')';
			$conditions_policies[] = 'TO_DAYS(policy_payments.date) <= TO_DAYS(' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2)) . ')';
        }
		if (!isset($_POST['InWindow'])) {
			include_once $this->object . '/getPaymentsAndPremiums.php';
			return;
		}
		$sql = 'SELECT agencies.top as agencies_id, agencies.title, getAmount(agencies.top, 0, 0, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_compensation_car_services, ' .
			   'getAmount(agencies.top, 1, 1, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_compensation_kasko, ' .
			   'getAmount(agencies.top, 1, 2, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_compensation_go, ' .
			   'getAmount(agencies.top, 2, 1, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_premium_kasko, ' .
			   'getAmount(agencies.top, 2, 2, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_premium_go, ' .
			   'getAmount(agencies.top, 2, 3, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_premium_other ' .
			   'FROM ' . PREFIX . '_agencies AS agencies ' .
			   'LEFT JOIN ' . PREFIX . '_car_services AS car_services ON agencies.top = car_services.agencies_id ' .
			   'WHERE agencies.regions_id IN (10, 26) AND agencies.id <> 1 AND agencies.ukravto = 1 ' .
			   'GROUP BY agencies.top';
		$list_car_services_agency_kiev = $db->getAll($sql);
		
		$sql = 'SELECT agencies.top as agencies_id, agencies.title, getAmount(agencies.top, 0, 0, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_compensation_car_services, ' .
			   'getAmount(agencies.top, 1, 1, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_compensation_kasko, ' .
			   'getAmount(agencies.top, 1, 2, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_compensation_go, ' .
			   'getAmount(agencies.top, 2, 1, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_premium_kasko, ' .
			   'getAmount(agencies.top, 2, 2, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_premium_go, ' .
			   'getAmount(agencies.top, 2, 3, ' . $db->quote($from) . ', ' . $db->quote($to) . ') as amount_premium_other ' .
			   'FROM ' . PREFIX . '_agencies AS agencies ' .
			   'LEFT JOIN ' . PREFIX . '_car_services AS car_services ON agencies.top = car_services.agencies_id ' .
			   'WHERE agencies.regions_id NOT IN (10, 26) AND agencies.ukravto = 1 ' .
			   'GROUP BY agencies.top';
		$list_car_services_agency_other = $db->getAll($sql);
		
 
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/getPaymentsAndPremiumsExcel.php';
            exit;
 	}
	
	function getPaymentsAndPremiumsInWindow($data) {
		$this->getPaymentsAndPremiums($data, true);
	}
	
	function getPaymentsAndPremiumsDetailsInWindow($data) {
		global $db;
		
		if (!$data['from']) {
			$data['from'] = date('d.m.Y', mktime(0, 0, 0, date('m'), 1, date('Y')));
		}
		
		if (!$data['to']) {
			$data['to'] = date('d.m.Y', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
		}
		
		if ($data['from']) {
			$from = substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2);
        }

        if ($data['to']) {
			$to = substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2);
        }
		
		switch($data['type']) {
			case '0':
				$sql = 'SELECT a.id as policies_id, a.number as policies_number, e.amount as payments_amount, date_format(e.date, \'%d.%m.%Y\') as  payments_date ' .
					   'FROM ' . PREFIX . '_policies as a ' .
					   'LEFT JOIN ' . PREFIX . '_policies_go as b ON a.id = b.policies_id ' .
					   'LEFT JOIN ' . PREFIX . '_policies_kasko as b1 ON a.id = b1.policies_id ' .
					   'JOIN ' . PREFIX . '_accidents as c ON a.id = c.policies_id ' .
					   'JOIN ' . PREFIX . '_accident_payments_calendar as d ON c.id = d.accidents_id AND d.recipient_types_id = 5 AND d.recipients_id IN (SELECT id FROM ' . PREFIX . '_car_services WHERE agencies_id = ' . intval($data['id']) . ' AND ukravto = 1) ' .
					   'JOIN ' . PREFIX . '_accident_payments as e ON d.id = e.payments_calendar_id AND e.is_return = 0 AND e.date BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
					   'WHERE (b.person_types_id = 2 AND (b.insurer_edrpou IN (SELECT edrpou FROM insurance_agencies GROUP BY edrpou) OR b.insurer_edrpou IN (SELECT edrpou FROM insurance_car_services WHERE ukravto = 1 GROUP BY edrpou))) OR (b1.insurer_person_types_id = 2 AND (b1.insurer_edrpou IN (SELECT edrpou FROM insurance_agencies GROUP BY edrpou) OR b1.insurer_edrpou IN (SELECT edrpou FROM insurance_car_services WHERE ukravto = 1 GROUP BY edrpou)))';
				$list = $db->getAll($sql);
				break;
			case '1':
				if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, e.amount as payments_amount, date_format(e.date, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'JOIN ' . PREFIX . '_policies_kasko as b ON a.id = b.policies_id ' .
						   'JOIN ' . PREFIX . '_accidents as c ON b.policies_id = c.policies_id ' .
						   'JOIN ' . PREFIX . '_accident_payments_calendar as d ON c.id = d.accidents_id AND d.recipient_types_id = 5 AND d.recipients_id IN (SELECT id FROM ' . PREFIX . '_car_services WHERE agencies_id = ' . intval($data['id']) . ' AND ukravto = 1) ' .
						   'JOIN ' . PREFIX . '_accident_payments as e ON d.id = e.payments_calendar_id AND e.is_return = 0 AND e.date BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'WHERE b.insurer_person_types_id = 1 OR (b.insurer_edrpou NOT IN (SELECT edrpou FROM ' . PREFIX . '_agencies GROUP BY edrpou) AND b.insurer_edrpou NOT IN (SELECT edrpou FROM ' . PREFIX . '_car_services WHERE ukravto = 1 GROUP BY edrpou))';
					$list = $db->getAll($sql);
				}
				if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, e.amount as payments_amount, date_format(e.date, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'JOIN ' . PREFIX . '_policies_go as b ON a.id = b.policies_id ' .
						   'JOIN ' . PREFIX . '_accidents as c ON b.policies_id = c.policies_id ' .
						   'JOIN ' . PREFIX . '_accident_payments_calendar as d ON c.id = d.accidents_id AND d.recipient_types_id = 5 AND d.recipients_id IN (SELECT id FROM ' . PREFIX . '_car_services WHERE agencies_id = ' . intval($data['id']) . ' AND ukravto = 1) ' .
						   'JOIN ' . PREFIX . '_accident_payments as e ON d.id = e.payments_calendar_id AND e.is_return = 0 AND e.date BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'WHERE b.person_types_id = 1 OR (b.insurer_edrpou NOT IN (SELECT edrpou FROM ' . PREFIX . '_agencies GROUP BY edrpou) AND b.insurer_edrpou NOT IN (SELECT edrpou FROM ' . PREFIX . '_car_services WHERE ukravto = 1 GROUP BY edrpou))';
					$list = $db->getAll($sql);
				}
				if ($data['product_types_id'] == 0) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, e.amount as payments_amount, date_format(e.date, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'LEFT JOIN ' . PREFIX . '_policies_go as b ON a.id = b.policies_id ' .
						   'LEFT JOIN ' . PREFIX . '_policies_kasko as b1 ON a.id = b1.policies_id ' .
						   'JOIN ' . PREFIX . '_accidents as c ON a.id = c.policies_id ' .
						   'JOIN ' . PREFIX . '_accident_payments_calendar as d ON c.id = d.accidents_id AND d.recipient_types_id = 5 AND d.recipients_id IN (SELECT id FROM ' . PREFIX . '_car_services WHERE agencies_id = ' . intval($data['id']) . ' AND ukravto = 1) ' .
						   'JOIN ' . PREFIX . '_accident_payments as e ON d.id = e.payments_calendar_id AND e.is_return = 0 AND e.date BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'WHERE (IF(a.product_types_id = ' . PRODUCT_TYPES_GO . ', b.person_types_id = 1, 1) AND IF(a.product_types_id = ' . PRODUCT_TYPES_KASKO . ', b1.insurer_person_types_id = 1, 1)) OR (b.insurer_edrpou NOT IN (SELECT edrpou FROM ' . PREFIX . '_agencies GROUP BY edrpou) AND b.insurer_edrpou NOT IN (SELECT edrpou FROM ' . PREFIX . '_car_services WHERE ukravto = 1 GROUP BY edrpou))';
					$list = $db->getAll($sql);
				}
				break;
			case '2':
				if ($data['product_types_id'] == -1) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, b.amount as payments_amount, date_format(b.datetime, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'JOIN ' . PREFIX . '_policy_payments as b ON a.id = b.policies_id AND b.datetime BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'JOIN ' . PREFIX . '_agencies as c ON a.agencies_id = c.id ' .
						   'WHERE c.top = ' . intval($data['id']);
					$list = $db->getAll($sql);
				}
				if ($data['product_types_id'] == 0) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, b.amount as payments_amount, date_format(b.datetime, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'JOIN ' . PREFIX . '_policy_payments as b ON a.id = b.policies_id AND b.datetime BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'JOIN ' . PREFIX . '_agencies as c ON a.agencies_id = c.id ' .
						   'WHERE c.top = ' . intval($data['id']) . ' AND a.product_types_id NOT IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ')';
					$list = $db->getAll($sql);
				}
				if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, b.amount as payments_amount, date_format(b.datetime, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'JOIN ' . PREFIX . '_policy_payments as b ON a.id = b.policies_id AND b.datetime BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'JOIN ' . PREFIX . '_agencies as c ON a.agencies_id = c.id ' .
						   'WHERE c.top = ' . intval($data['id']) . ' AND a.product_types_id = ' . PRODUCT_TYPES_KASKO;
					$list = $db->getAll($sql);
				}
				if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
					$sql = 'SELECT a.id as policies_id, a.number as policies_number, b.amount as payments_amount, date_format(b.datetime, \'%d.%m.%Y\') as  payments_date ' .
						   'FROM ' . PREFIX . '_policies as a ' .
						   'JOIN ' . PREFIX . '_policy_payments as b ON a.id = b.policies_id AND b.datetime BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
						   'JOIN ' . PREFIX . '_agencies as c ON a.agencies_id = c.id ' .
						   'WHERE c.top = ' . intval($data['id']) . ' AND a.product_types_id = ' . PRODUCT_TYPES_GO;
					$list = $db->getAll($sql);
				}
				break;
		}
		
		header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));
			
		include_once $this->object . '/getPaymentsAndPremiumsDetails.php';
		exit;
	}
	
	function getHistoryAccidents($data, $excel=false){
		global $db, $Authorization;

		$method = 'getHistoryAccidents';
		
		$data['report'] = $db->getRow('SELECT * FROM '.PREFIX.'_reports WHERE id=25');
		$data['inputparameters'] = $db->getAll('SELECT * FROM '.PREFIX.'_reports_input_parameters WHERE reports_id=25 order by order_position');
		$data['outputparameters'] = $db->getAll('SELECT * FROM '.PREFIX.'_reports_output_parameters WHERE reports_id=25 order by order_position');

		if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
			foreach ($data['outputparameters'] as $index => $parameter) {
				if (in_array($parameter['alias'], array('financial_institutions_id', 
														'repair_classifications_id', 
														'accident_sections_id',
														'accident_sections_change_created', 
														'accident_sections_change_responsible',
														'compromise',
														'compromise_violation',
														'compromise_date',
														'compromise_agreement_created',
														'compromise_agreement_duration',
														'compromise_agreement_responsible',
														'compromise_continue_created',
														'compromise_continue_duration',
														'compromise_continue_responsible',
														'total'))) {
					unset($data['outputparameters'][$index]);
				}
			}
		}		
		
		if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
			foreach ($data['outputparameters'] as $index => $parameter) {
				if (in_array($parameter['alias'], array('victim', 
														'victim_item', 
														'victim_sign'))) {
					unset($data['outputparameters'][$index]);
				}
			}
		}
		
		if (in_array($Authorization->data['id'], array(1, 11456, 9698))) {//kuznetsova
			foreach ($data['outputparameters'] as $index => $parameter) {
				if ($parameter['alias'] == 'sign') {
					array_splice($data['outputparameters'], $index + 1, 0, array(array('alias' => 'shassi', 'types_id' => 3, 'title' => 'VIN')));
				}
			}
		}
		
		if (intval($data['runquery']) == 1) {

			Accidents::updateReportHistory();	
		
			$conditions = array();
			$conditions[] = '1';
			if($data['accidents_date_from']) {
				$accidents_date_from = substr($data['accidents_date_from'], 6, 4) .'-'. substr($data['accidents_date_from'], 3, 2) .'-'. substr($data['accidents_date_from'], 0, 2);
				$conditions2[] = 'date >= ' . $db->quote($accidents_date_from);
			}
			if($data['accidents_date_to']) {
				$accidents_date_to = substr($data['accidents_date_to'], 6, 4) .'-'. substr($data['accidents_date_to'], 3, 2) .'-'. substr($data['accidents_date_to'], 0, 2);
				$conditions2[] = 'date <= ' . $db->quote($accidents_date_to);
			}
			
			$conditions2[] = 'qlickview_accidents.modified = last.last_modified';
			if($data['last_payment_date_from']) {
				$last_payment_date_from = substr($data['last_payment_date_from'], 6, 4) .'-'. substr($data['last_payment_date_from'], 3, 2) .'-'. substr($data['last_payment_date_from'], 0, 2);
				$conditions2[] = 'calendar.max_payment_date >= ' . $db->quote($last_payment_date_from);
			}
			if($data['last_payment_date_to']) {
				$last_payment_date_to = substr($data['last_payment_date_to'], 6, 4) .'-'. substr($data['last_payment_date_to'], 3, 2) .'-'. substr($data['last_payment_date_to'], 0, 2);
				$conditions2[] = 'calendar.max_payment_date <= ' . $db->quote($last_payment_date_to);
			}		
			if($data['begin_resolved_date']) {
				$begin_resolved_date = substr($data['begin_resolved_date'], 6, 4) .'-'. substr($data['begin_resolved_date'], 3, 2) .'-'. substr($data['begin_resolved_date'], 0, 2);
				$conditions2[] = 'qlickview_accidents.resolved_date >= ' . $db->quote($begin_resolved_date);
			}
			if($data['end_resolved_date']) {
				$end_resolved_date = substr($data['end_resolved_date'], 6, 4) .'-'. substr($data['end_resolved_date'], 3, 2) .'-'. substr($data['end_resolved_date'], 0, 2);
				$conditions2[] = 'qlickview_accidents.resolved_date <= ' . $db->quote($end_resolved_date);
			}
		
			$sql = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_history_accidents ' . 
					'SELECT qlickview_accidents.* ' .
					'FROM qlickview_accidents ' . 
					'JOIN ( ' .
						'SELECT MAX(modified) as last_modified, accidents_id ' .
						'FROM qlickview_accidents ' .
						//'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'GROUP BY accidents_id' .
					') as last ON qlickview_accidents.accidents_id = last.accidents_id AND qlickview_accidents.modified = last.last_modified ' .
					'LEFT JOIN ( ' .
						'SELECT accidents_id, MAX(payment_date) as max_payment_date ' .
						'FROM ' . PREFIX . '_accident_payments_calendar ' .
						'WHERE payment_types_id = 6 OR payment_types_id = 5 ' .
						'GROUP BY accidents_id' .
					') as calendar ON qlickview_accidents.accidents_id = calendar.accidents_id ' .
					'WHERE ' . implode(' AND ', $conditions2);
			$db->query($sql);		

			$sql = 'SELECT 					
					CASE history.archive_statuses_id
						WHEN 1 THEN \'в роботі\'
						WHEN 2 THEN \'врегульовано\'
						WHEN 3 THEN \'закрито\'
					END as archive_statuses_id,
					CASE history.total
						WHEN 1 THEN \'так\'
						WHEN 0 THEN \'ні\'
					END as total,
					history.number as number,
					history.datetime as datetime,
					policies.number as policies_number,
					IF(agencies.parent_id > 0, agencies_parent.title, agencies.title) as agencies_parent_title,
					policies.date as policies_date,
					CASE history.product_types_id
						WHEN 3 THEN IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company)
						WHEN 4 THEN IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname)
					END as insurer,
					CASE history.product_types_id
						WHEN 3 THEN CONCAT_WS(\'/\', kasko_items.brand, kasko_items.model)
						WHEN 4 THEN CONCAT_WS(\'/\', policies_go.brand, policies_go.model)
					END as item,
					IF (history.risk = 1, 
						CASE accidents_go.property_types_id
							WHEN 1 THEN CONCAT_WS(\'/\', accidents_go.owner_brand, accidents_go.owner_model)
							WHEN 2 THEN accidents_go.property
						END
						, \'\') as victim_item,
					accidents_go.owner_sign as victim_sign,
					IF (accidents_go.owner_person_types_id = 1, CONCAT_WS(\' \', accidents_go.owner_lastname, accidents_go.owner_firstname, accidents_go.owner_patronymicname), accidents_go.owner_lastname) as victim,
					CASE history.product_types_id
						WHEN 3 THEN kasko_items.shassi						
						WHEN 4 THEN policies_go.shassi
					END as shassi,
					CASE history.product_types_id
						WHEN 3 THEN kasko_items.sign
						WHEN 4 THEN policies_go.sign
					END as sign,
					policies.begin_datetime as policies_begin_date,
					policies.end_datetime as policies_end_date,
						CASE history.product_types_id
						WHEN 3 THEN kasko_items.car_price
						WHEN 4 THEN policies.price
					END as insurance_price,
					history.created as created,
					history.date as date,
					CASE history.insurance
						WHEN 0 THEN \'не визначено\'
						WHEN 1 THEN \'страховий, з виплатою\'
						WHEN 2 THEN \'страховий, без виплати\'
						WHEN 3 THEN \'не страховий\'
					END as insurance,
					CASE accidents.regres 
						WHEN 0 THEN \'ні\'
						WHEN 1 THEN \'так\'
					END as regress,
					history.sign_recipient_act,
					history.sign_recipient_addition,
					history.notes,
					history.amount_rough as amount_rough, 
					history.deductibles_amount,
					history.amount_compensation,
					history.amount_vz,
					history.amount_act,
					history.amount_addition,
					history.amount_experts,
					history.recipient_act,
					history.recipient_addition,
					history.recipient_experts,
					history.act_payments_date,
					history.addition_payments_date,
					history.acts_amount as acts_amount,
					history.accident_expert_organizations as accident_expert_organizations,
					history.expertises_amount as expertises_amount,
					history.other_amount as other_amount,
					history.points_id as points_id,
					history.last_resolved_date,
					product_types.title as product_types_id,
					accident_sections.title as accident_sections_id,
					repair_classifications.title as repair_classifications_id,
					accident_statuses.title as accident_statuses_id,
					financial_institutions.title as financial_institutions_id,
					car_services.title as car_services_id,
					CASE history.car_services_ukravto
						WHEN 0 THEN \'не УкрАВТО\'
						WHEN 1 THEN \'УкрАВТО\'
					END as car_services_ukravto,
					history.application_created as application_created,
					CONCAT(TRUNCATE(history.application_duration/24,0),\' дн. \',ROUND(history.application_duration-TRUNCATE(history.application_duration/24,0)*24,0), \' год.\') as application_duration,
					history.application_responsible as application_responsible,
					history.application_end_responsible as application_end_responsible,
					history.classification_created as classification_created,
					CONCAT(TRUNCATE(history.classification_duration/24,0),\' дн. \',ROUND(history.classification_duration-TRUNCATE(history.classification_duration/24,0)*24,0), \' год.\') as classification_duration,
					history.classification_responsible as classification_responsible,
					history.accident_sections_change_created as accident_sections_change_created,
					history.accident_sections_change_responsible as accident_sections_change_responsible,
					history.investigation_created as investigation_created,
					CONCAT(TRUNCATE(history.investigation_duration/24,0),\' дн. \',ROUND(history.investigation_duration-TRUNCATE(history.investigation_duration/24,0)*24,0), \' год.\') as investigation_duration,
					history.investigation_responsible as investigation_responsible,
					history.investigation_responsible as investigation_responsible,
					history.compromise,
					GROUP_CONCAT(accidents_compromise_violation.title SEPARATOR \', \') as compromise_violation,
					history.compromise_date,
					history.average_first_task_created as average_first_task_created,
					history.average_last_task_closed as average_last_task_closed,
					history.approval_created as approval_created,
					CONCAT(TRUNCATE(history.approval_duration/24,0),\' дн. \',ROUND(history.approval_duration-TRUNCATE(history.approval_duration/24,0)*24,0), \' год.\') as approval_duration,
					history.approval_responsible as approval_responsible,
					history.reset_created as reset_created,
					CONCAT(TRUNCATE(history.reset_duration/24,0),\' дн. \',ROUND(history.reset_duration-TRUNCATE(history.reset_duration/24,0)*24,0), \' год.\') as reset_duration,
					history.reset_responsible as reset_responsible,
					history.defects_created as defects_created,
					CONCAT(TRUNCATE(history.defects_duration/24,0),\' дн. \',ROUND(history.defects_duration-TRUNCATE(history.defects_duration/24,0)*24,0), \' год.\') as defects_duration,
					history.defects_responsible as defects_responsible,
					history.reinvestigation_created as reinvestigation_created,
					CONCAT(TRUNCATE(history.reinvestigation_duration/24,0),\' дн. \',ROUND(history.reinvestigation_duration-TRUNCATE(history.reinvestigation_duration/24,0)*24,0), \' год.\') as reinvestigation_duration,
					history.reinvestigation_responsible as reinvestigation_responsible,
					history.suspended_created as suspended_created,
					CONCAT(TRUNCATE(history.suspended_duration/24,0),\' дн. \',ROUND(history.suspended_duration-TRUNCATE(history.suspended_duration/24,0)*24,0), \' год.\') as suspended_duration,
					history.suspended_responsible as suspended_responsible,
					history.payment_created as payment_created,
					CONCAT(TRUNCATE(history.payment_duration/24,0),\' дн. \',ROUND(history.payment_duration-TRUNCATE(history.payment_duration/24,0)*24,0), \' год.\') as payment_duration,
					MAX(payments_calendar.payment_date) as last_payment_date,
					history.payment_responsible as payment_responsible,
					history.resolved_created as resolved_created,
					CONCAT(TRUNCATE(history.resolved_duration/24,0),\' дн. \',ROUND(history.resolved_duration-TRUNCATE(history.resolved_duration/24,0)*24,0), \' год.\') as resolved_duration,
					history.resolved_responsible as resolved_responsible,
					history.closed_created as closed_created,
					CONCAT(TRUNCATE(history.closed_duration/24,0),\' дн. \',ROUND(history.closed_duration-TRUNCATE(history.closed_duration/24,0)*24,0), \' год.\') as closed_duration,
					history.compromise_agreement_created as compromise_agreement_created,
					CONCAT(TRUNCATE(history.compromise_agreement_duration/24,0),\' дн. \',ROUND(history.compromise_agreement_duration-TRUNCATE(history.compromise_agreement_duration/24,0)*24,0), \' год.\') as compromise_agreement_duration,
					history.compromise_agreement_responsible as compromise_agreement_responsible,
					history.compromise_continue_created as compromise_continue_created,
					CONCAT(TRUNCATE(history.compromise_continue_duration/24,0),\' дн. \',ROUND(history.compromise_continue_duration-TRUNCATE(history.compromise_continue_duration/24,0)*24,0), \' год.\') as compromise_continue_duration,
					history.compromise_continue_responsible as compromise_continue_responsible,
					history.modified as modified,
					CASE history.product_types_id
						WHEN 3 THEN parameters_risks.title
						WHEN 4 THEN
							CASE history.risk
								WHEN 1 THEN \'майно\'
								WHEN 2 THEN
									CASE accidents_go.damage_extent_id
										WHEN 1 THEN \'Тимчасова втрата працездатності(травма)\'
										WHEN 2 THEN \'Стійка втрата працездатності(інвалідність 1 групи)\'
										WHEN 3 THEN \'Стійка втрата працездатності(інвалідність 2 групи)\'
										WHEN 4 THEN \'Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)\'
										WHEN 5 THEN \'Смерть\'
										WHEN 6 THEN \'Моральна шкода\'
									END
								ELSE \'\'
							END
					END as risk,
					CONCAT(accounts.lastname, \' \', accounts.firstname)  as average_managers_title,
					history.comment_closed
					FROM temp_history_accidents as history 
					LEFT JOIN insurance_accidents_compromise_violation as accidents_compromise_violation ON accidents_compromise_violation.value & history.compromise_violation <> 0 ' .
					'JOIN insurance_accidents as accidents ON history.accidents_id = accidents.id 
					JOIN insurance_policies as policies ON accidents.policies_id = policies.id
					JOIN insurance_agencies as agencies ON policies.agencies_id = agencies.id
					LEFT JOIN insurance_agencies as agencies_parent ON agencies.parent_id = agencies_parent.id
					LEFT JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id
					LEFT JOIN insurance_policies_go as policies_go ON policies.id = policies_go.policies_id
					LEFT JOIN insurance_accident_payments_calendar as payments_calendar ON history.accidents_id = payments_calendar.accidents_id AND payments_calendar.payment_types_id IN (5,6)
					LEFT JOIN (
						SELECT accidents_id, recipients_id
						FROM insurance_accident_payments_calendar
						WHERE payment_types_id = 6 AND recipient_types_id = 5
						GROUP BY accidents_id
						) as calendar ON history.accidents_id = calendar.accidents_id
					LEFT JOIN insurance_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id
					LEFT JOIN insurance_accidents_go as accidents_go ON history.accidents_id = accidents_go.accidents_id AND accidents_go.owner_types_id = 2
					LEFT JOIN insurance_policies_kasko_items as kasko_items ON kasko_items.id = accidents_kasko.items_id
					LEFT JOIN insurance_product_types as product_types ON history.product_types_id = product_types.id
					LEFT JOIN insurance_accident_sections as accident_sections ON history.accident_sections_id = accident_sections.id
					LEFT JOIN insurance_repair_classifications as repair_classifications ON history.repair_classifications_id = repair_classifications.id
					LEFT JOIN insurance_accident_statuses as accident_statuses ON history.accident_statuses_id = accident_statuses.id
					LEFT JOIN insurance_financial_institutions as financial_institutions ON history.financial_institutions_id = financial_institutions.id
					LEFT JOIN insurance_car_services as car_services ON history.car_services_id = car_services.id
					LEFT JOIN insurance_parameters_risks as parameters_risks ON parameters_risks.id=history.risk
					LEFT JOIN insurance_accounts as accounts ON accidents.average_managers_id = accounts.id
					WHERE IF(@archive_statuses_id=0,history.archive_statuses_id>=0,history.archive_statuses_id=@archive_statuses_id)
					AND IF(0 IN (@insurance),0,history.insurance) IN (@insurance)
					AND IF(0 IN (@car_services_id),0,history.car_services_id) IN (@car_services_id)
					AND history.product_types_id = @product_types_id
					AND IF(0 IN (@accident_sections_id),0,history.accident_sections_id) IN (@accident_sections_id)
					AND IF(0 IN (@repair_classifications_id),0,history.repair_classifications_id) IN (@repair_classifications_id)
					AND IF(0 IN (@accident_statuses_id),0,history.accident_statuses_id) IN (@accident_statuses_id)
					AND IF(0 IN (@financial_institutions_id),0,history.financial_institutions_id) IN (@financial_institutions_id)
					AND IF(0 IN (@average_managers_id),0,accidents.average_managers_id) IN (@average_managers_id)
					AND IF(0 IN (@car_services_recipients_id),0,calendar.recipients_id) IN (@car_services_recipients_id)
					AND IF(@car_services_ukravto=0,history.car_services_ukravto>=0,(history.car_services_ukravto+1)=@car_services_ukravto)
					AND IF(@is_accident_sections_change=0,IF(history.accident_sections_change_created >= \'0000-00-00\', 1, 0)>=0,(IF(history.accident_sections_change_created >= \'0000-00-00\', 1, 0)+1)=@is_accident_sections_change)
					AND IF(0 IN (@brands_id),0,kasko_items.brands_id) IN (@brands_id)
					AND IF(\'@insurer\' = \'\', 1, policies.insurer LIKE \'%@insurer%\')
					AND LENGTH(history.number) > 0
					GROUP BY history.accidents_id
					ORDER BY history.created DESC';
		}

		for($i=0; $i<sizeof($data['outputparameters']); $i++){
			if($data['outputparameters'][$i]['types_id'] == 3){
				$data['outputparameters'][$i]['style'] = 'x:str';
			}
		}

		if (is_array($data['inputparameters']) && $data['runquery']) {
			foreach($data['inputparameters'] as $parameter) {
				$alias = $parameter['alias'];
				$val = $data[$alias];
				switch 	($parameter['types_id']) {
					case 1://Число
					case 3://Булево
						$val = intval($val);
						$sql = str_replace('@'.$alias, $val, $sql);
						break;
					case 2://Дата
						$val = substr($val, 6, 4) .'-'. substr($val, 3, 2) .'-'. substr($val, 0, 2);
						$sql = str_replace('@'.$alias, $val, $sql);
						break;
					case 4://Текст
						$val = trim($val);
						$sql = str_replace('@' . $alias, $val , $sql);
						break;
					case 7://Банк
					case 15://архив
					case 19://УкрАвто
					case 20://Зміна категорії
						$val = intval($val);
						$sql = str_replace ('@' . $alias, $val, $sql);
						break;
					case 5://Страхова компания
					case 8://Марка
					case 9://да - нет
					case 11://Ризик
					case 12://Статус
					case 13://Тип справи
					case 14://Менеджер
					case 16://Категорія справи
					case 17://Клас ремонту
					case 18://тип(вид) страхування
					case 21://стату оплаты
					case 22://стан справи
						if (is_array($val)) {
							$val=  implode(', ', $val) ;
						} else {
							$val=intval($val);
						}

						if (strlen($val) == 0) $val='0';
						$sql = str_replace('@'.$alias, $val, $sql);
						break;
					case 10://сто
						if ($Authorization->data['roles_id'] == ROLES_MASTER) {
						   $val = intval($Authorization->data['car_services_id']);
						}
						if (intval($val)) {
							$CarServices = new CarServices($data);
							$car_services = array($val);
							$CarServices->getSubId(&$car_services, $val);
							$val = implode(', ', $car_services) ;
						} else {
							$val = intval($val);
						}

						$sql = str_replace('@'.$alias, $val, $sql);
						break;
					case 6://Агенция
						if (intval($val)) {
							$Agencies = new Agencies($data);
							$agencies_id = array($val);
							$Agencies->getSubId(&$agencies_id, $val);
							$val = implode(', ', $agencies_id) ;
						} else {
							$val = intval($val);
						}

						$sql = str_replace('@'.$alias, $val, $sql);
						break;	
				}
			}
		}

		if ($sql) $res = $db->query($sql);
		
		$fields = array(
						'amount_compensation' => array('types_id' => 2, 'style' => ''),
						'amount_vz' => array('types_id' => 2, 'style' => ''),
						'amount_act' => array('types_id' => 2, 'style' => ''),
						'amount_addition' => array('types_id' => 2, 'style' => ''),
						'amount_experts' => array('types_id' => 2, 'style' => ''),
						'recipient_act' => array('types_id' => 3, 'style' => ''),
						'recipient_addition' => array('types_id' => 3, 'style' => ''),
						'recipient_experts' => array('types_id' => 3, 'style' => ''),
						'act_payments_date' => array('types_id' => 4, 'style' => ''),
						'addition_payments_date' => array('types_id' => 4, 'style' => ''),
						'sign_recipient_act' => array('types_id' => 3, 'style' => ''),
						'sign_recipient_addition' => array('types_id' => 3, 'style' => ''));

		if (intval($data['InWindow'])) {
			header('Content-Disposition: attachment; filename="report.xls"');
			header('Content-Type: ' . Form::getContentType('report.xls'));
			include_once $this->object . '/generateExcel.php';
			exit;
		}
	
		include_once $this->object . '/generate.php';
	}
	
	function getHistoryAccidentsInWindow($data){
		$this->getHistoryAccidents($data, true);
	}
	
	function showAccidentsReport() {
		global $Authorization;
		
		include $this->object . '/Accidents/show.php';
	}
	
	function getApplicationAccidents($data, $excel=false) {
		global $db, $MONTHES;
		
		$conditions = array();
		
		$time = time();
		
		if ($data['from']) {
			$from_period = substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2);
			$from_month = date('Y-m-d', mktime(0, 0, 0, substr($data['from'], 3, 2), 1, substr($data['from'], 6, 4)));
			$from_year = date('Y-m-d', mktime(0, 0, 0, 1, 1, substr($data['from'], 6, 4)));
		}
		
		if ($data['to']) {
			$to_period = substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2);
			$to_month = date('Y-m-d', mktime(0, 0, 0, substr($data['from'], 3, 2) + 1, 0, substr($data['from'], 6, 4)));
			$to_year = date('Y-m-d', mktime(0, 0, 0, 1, 0, substr($data['from'], 6, 4) + 1));
		}
		
		if (!$from_period || !$to_period) {
			include_once 'header.php';
			include_once $this->object . '/Accidents/getApplicationAccidents.php';
			exit;
		}

		/*$sql = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_accidents_resolved_date ' .
			   'SELECT accidents.id, getResolvedDate(accidents.id, 0) AS date  ' .
			   'FROM insurance_accidents as accidents ' .
			   'JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
			   ((intval($data['product_types_id'] == PRODUCT_TYPES_GO)) ? 'JOIN insurance_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id AND accidents_go.owner_types_id = 2 ' : '') .
			   'WHERE accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
			   'GROUP BY accidents.id';
		_dump($sql);
		$db->query($sql);*/
		
		/*$values['count_application_accidents_by_year'] = 'SELECT getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, -1, 0)';
		$values['count_application_accidents_by_month'] = 'SELECT getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, -1, 0)';
		$values['count_application_accidents_by_period'] = 'SELECT getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, -1, 0)';
		_dump(time()-$time);
		if (intval($data['product_types_id']) == PRODUCT_TYPES_GO) {
		
		}*/
		
		Accidents::updateReportHistory();
	
		$sql = 'SELECT ' . 
					  ((intval($data['product_types_id']) == PRODUCT_TYPES_KASKO) ?
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, -1, 0) as count_application_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, -1, 0) as count_application_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, -1, 0) as count_application_accidents_by_period, '
					  : '') .
					  ((intval($data['product_types_id']) == PRODUCT_TYPES_GO) ?
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 2, -1, 0) as count_application_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 2, -1, 0) as count_application_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 2, -1, 0) as count_application_accidents_by_period, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 1, -1, 0) as count_application_insurer_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 1, -1, 0) as count_application_insurer_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 1, -1, 0) as count_application_insurer_accidents_by_period, '
					  : '') .
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, 0, 0) as count_resolved_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, 0, 0) as count_resolved_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, 0, 0) as count_resolved_accidents_by_period, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, 1, 0) as count_insurance1_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, 1, 1) as count_compromise_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, 1, 0) as count_insurance1_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, 1, 1) as count_compromise_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, 1, 0) as count_insurance1_accidents_by_period, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, 1, 1) as count_compromise_accidents_by_period, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, 2, 0) as count_insurance2_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, 2, 0) as count_insurance2_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, 2, 0) as count_insurance2_accidents_by_period, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', ' . intval($data['product_types_id']) . ', 0, 3, 0) as count_insurance3_accidents_by_year, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', ' . intval($data['product_types_id']) . ', 0, 3, 0) as count_insurance3_accidents_by_month, ' .
					  'getCountAccidentsByPeriod(' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', ' . intval($data['product_types_id']) . ', 0, 3, 0) as count_insurance3_accidents_by_period, ' .
					  'SUM(getPayedCompensation(id, 0, 0, 1, ' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', 0)) as payed_compensation_by_year, ' .
					  'SUM(getPayedCompensation(id, 1, 0, 1, ' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', 0)) as payed_compensation_compromise_by_year, ' .
					  'SUM(getPayedCompensation(id, 0, 0, 1, ' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', 0)) as payed_compensation_by_month, ' .
					  'SUM(getPayedCompensation(id, 1, 0, 1, ' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', 0)) as payed_compensation_compromise_by_month, ' .
					  'SUM(getPayedCompensation(id, 0, 0, 1, ' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', 0)) as payed_compensation_by_period, ' .
					  'SUM(getPayedCompensation(id, 1, 0, 1, ' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', 0)) as payed_compensation_compromise_by_period, ' .
					  'SUM(getPayedCompensation(id, 0, 1, 1, ' . $db->quote($from_year) . ', ' . $db->quote($to_year) . ', 0)) as payed_compensation_ukrauto_by_year, ' .
					  'SUM(getPayedCompensation(id, 0, 1, 1, ' . $db->quote($from_month) . ', ' . $db->quote($to_month) . ', 0)) as payed_compensation_ukrauto_by_month, ' .
					  'SUM(getPayedCompensation(id, 0, 1, 1, ' . $db->quote($from_period) . ', ' . $db->quote($to_period) . ', 0)) as payed_compensation_ukrauto_by_period, ' .
					  'getCountAccidentsByStatus(0, 0, 0, ' . intval($data['product_types_id']) . ') as count_accidents_in_work, ' .
					  'getCountAccidentsByStatus(0, 0, 1, ' . intval($data['product_types_id']) . ') as count_accidents_express_in_work, ' .
					  'getCountAccidentsByStatus(5, 0, 0, ' . intval($data['product_types_id']) . ') as count_accidents_in_payment, ' .
					  'getCountAccidentsByStatus(5, 0, 1, ' . intval($data['product_types_id']) . ') as count_accidents_express_in_payment, ' .
					  'getCountAccidentsByStatus(4, 1, 0, ' . intval($data['product_types_id']) . ') as count_accidents_in_approval, ' .
					  'getCountAccidentsByStatus(4, 1, 1, ' . intval($data['product_types_id']) . ') as count_accidents_express_in_approval, ' .
					  'getCountAccidentsByStatus(4, 2, 0, ' . intval($data['product_types_id']) . ') + getCountAccidentsByStatus(4, 3, 0, ' . intval($data['product_types_id']) . ') as count_accidents_insurance23_in_approval, ' .
					  'getCountAccidentsByStatus(4, 2, 1, ' . intval($data['product_types_id']) . ') + getCountAccidentsByStatus(4, 3, 1, ' . intval($data['product_types_id']) . ') as count_accidents_express_insurance23_in_approval, ' .
					  'getAmountAccidentsByStatus(0, 0, 0, ' . intval($data['product_types_id']). ') as amount_rough_in_work, ' .
					  'getAmountAccidentsByStatus(5, 1, 0, ' . intval($data['product_types_id']) . ') as amount_in_payment, ' .
					  'getAmountAccidentsByStatus(5, 1, 1, ' . intval($data['product_types_id']) . ') as amount_express_in_payment, ' .
					  'getAmountAccidentsByStatus(4, 1, 0, ' . intval($data['product_types_id']) . ') as amount_in_approval, ' .
					  'getAmountAccidentsByStatus(4, 1, 1, ' . intval($data['product_types_id']) . ') as amount_express_in_approval, ' .
					  'getAmountAccidentsByStatus(4, 2, 0, ' . intval($data['product_types_id']) . ') + getAmountAccidentsByStatus(4, 3, 0, ' . intval($data['product_types_id']) . ') as amount_insurance23_in_approval, ' .
					  'getAmountAccidentsByStatus(4, 2, 1, ' . intval($data['product_types_id']) . ') + getAmountAccidentsByStatus(4, 3, 1, ' . intval($data['product_types_id']) . ') as amount_express_insurance23_in_approval ' .
				'FROM ' . PREFIX . '_accidents ' .
				'WHERE product_types_id = ' . intval($data['product_types_id']);
			//_dump($sql);exit;
			$values = $db->getRow($sql);
			//_dump(time()-$time);
		
			header('Content-Disposition: attachment; filename="report.xls"');
			header('Content-Type: ' . Form::getContentType('report.xls'));
			
			include_once $this->object . '/Accidents/getApplicationAccidentsExcel.php';
			exit;
 
	}	
	
	function getApplicationAccidentsInWindow($data) {
		$this->getApplicationAccidents($data, true);
	}
	
	function getAccidentsWithoutPayedFromMonth($data, $excel=false) {
		global $db;
		
		$conditions = array();
		
		$conditions[] = 'accidents.product_types_id = ' . intval($data['product_types_id']);
		$conditions[] = 'accidents_acts.date <> ' . $db->quote('0000-00-00');
		
		if ($data['insurance']) {
			$conditions[] = 'accidents_acts.insurance = ' . intval($data['insurance']);
		}
		
		if ($data['from']) {
			$conditions[] = 'accidents_acts.date >= ' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2));
		}
		
		if ($data['to']) {
			$conditions[] = 'accidents_acts.date <= ' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2));
		}
		
		/*if ($data['month'] && $data['year']) {
			$conditions[] = 'accidents_acts.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month']), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month']) + 1, 0, intval($data['year']))));
		}*/
		
		if (!sizeof($conditions) || !isset($_POST['InWindow'])) {
			include_once $this->object . '/Accidents/getAccidentsWithoutPayedFromMonth.php';
			exit;
		}
		
		$sql = 'SELECT accidents.number as accidents_number, policies.insurer as insurer, policies.number as policies_number, date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as policies_date, ' .
				'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', CONCAT(kasko_items.brand, \' \', kasko_items.model), CONCAT(policies_go.brand, \' \', policies_go.model)) as item, ' .
				'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', kasko_items.sign, policies_go.sign) as item_sign, ' .
				'IF(accidents_go.owner_person_types_id = 1, CONCAT(accidents_go.owner_lastname, \' \', accidents_go.owner_firstname), accidents_go.owner_lastname) as owner, ' .
				'CONCAT(accidents_go.owner_brand, \' \', accidents_go.owner_model) as owner_item, accidents_go.owner_sign as owner_sign, ' .
				'date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_datetime, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, accidents.amount_rough, date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date ' .
			   'FROM ' . PREFIX . '_accidents as accidents ' .
			   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
			   'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
			   'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
			   'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id ' .
			   'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
			   'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id AND accidents_acts.insurance = getResolvedInsuranceType(accidents.id) ' .
			   'WHERE ' . implode(' AND ', $conditions) . ' ORDER BY accidents_acts.date';
		//_dump($sql);
		$list = $db->getAll($sql);			
		//_dump($list);		
		
 
			header('Content-Disposition: attachment; filename="report.xls"');
			header('Content-Type: ' . Form::getContentType('report.xls'));
			
			include_once $this->object . '/Accidents/getAccidentsWithoutPayedFromMonthExcel.php';
			exit;
 
	}
	
	function getAccidentsWithoutPayedFromMonthInWindow($data) {
		$this->getAccidentsWithoutPayedFromMonth($data, true);
	}
	
	function getSTOForPeriodInWindow($data){
        $this->getSTOForPeriod($data, true);
    }

    function getSTOForPeriod($data, $excel=false){
        global $db, $Log, $Authorization;

        if(!isset($data['is_financial_institutions'])){
            $conditions[] = 'car_services.id = ' . $data['car_services_id'];
            $conditions[] = 'if(accidents.resolved_date is null, accidents.date <= NOW(), 1) ';
            $i=0;
            $condition[] = '(';
            for($i=0; $i< sizeof($data['month']) - 1; $i++){
                $condition[] = 'if(accidents.resolved_date, ' .
                              'accidents.resolved_date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]), 1, intval($data['year'])))) . ' AND ' .
                               $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]) + 1, 0, intval($data['year'])))) .
                               ', 1) OR ';
            }
            $condition[] = 'if(accidents.resolved_date, accidents.resolved_date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]) + 1, 0, intval($data['year'])))) . ', 1)) ';

        }
        else{
            $conditions[] = 'policies_kasko.financial_institutions_id = ' . $data['financial_institutions_id'];
            $i=0;
            $condition[] = '(';
            for($i=0; $i< sizeof($data['month']) - 1; $i++){
                $condition[] = 'accidents.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]) + 1, 0, intval($data['year'])))) . ' OR ';
            }
            $condition[] = 'accidents.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]) + 1, 0, intval($data['year'])))) . ')';

        }
        $conditions[] = 'accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ')';
        $conditions[] = 'IF(accidents.product_types_id = ' . PRODUCT_TYPES_GO . ', accidents_go.owner_types_id = 2, 1) ';

        if($_POST['do']){
            if(($data['is_financial_institutions'] && empty($data['financial_institutions_id'])) || (!$data['is_financial_institutions'] && empty($data['car_services_id']))){
                $Log->add('error', 'Не вибрано СТО або банк');
            }
            elseif(!$data['month']){
                $Log->add('error', 'Виберіть місяць');
            }
            else{
                $sql = 'SELECT accidents.id, accidents.number, date_format(accidents.date, \'%d.%m.%Y\') as date, accident_statuses.title as status, policies.insurer as insurer, ' .
                                'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', CONCAT(kasko_items.brand, \' / \', kasko_items.model), CONCAT(policies_go.brand, \' / \', policies_go.model)) AS item, ' .
                                'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', kasko_items.sign, policies_go.sign) AS sign, ' .
                                'getAmountAccidents(accidents.number, accidents.id, 3) as amount, ' .
                                'IF(accidents.product_types_id = ' . PRODUCT_TYPES_GO . ', accidents_go_acts.deductibles_amount, getAccidentsDeductible(accidents.id)) as  deductibles_amount, ' .
                                'getRecipientAccidents(accidents.number, accidents.id, 3) as assignment_payments, ' .
                                'accidents.amount_rough, accidents_kasko.financial_institutions_amount_rough, date_format(accidents.datetime, \'%d.%m.%Y\') as datetime, accidents_acts.insurance_price, ' .
                                'parameters_risks.title as risk_title, IF(years_payments.item_price, years_payments.item_price, kasko_items.car_price + kasko_items.price_equipment) AS policies_price, ' .
                                'accidents.insurance, payment_statuses.title as payment_statuses_title ' .
                        'FROM insurance_accidents as accidents ' .
                        'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents.policies_id = kasko_items.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
                        'JOIN ' . PREFIX . '_car_services as car_services ON accidents.car_services_id = car_services.id ' .
                        'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents.accident_statuses_id = accident_statuses.id ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_go_acts as accidents_go_acts ON accidents_acts.id = accidents_go_acts.accidents_acts_id ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                        'JOIN ' . PREFIX . '_parameters_risks as parameters_risks ON accidents.application_risks_id = parameters_risks.id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments AS years_payments ON accidents_kasko.items_id = years_payments.items_id AND accidents.date BETWEEN years_payments.date AND ADDDATE(years_payments.date, INTERVAL 1 YEAR) ' .
                        'JOIN ' . PREFIX . '_payment_statuses as payment_statuses ON accidents.payment_statuses_id = payment_statuses.id ' .
                        'WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' ', $condition) . ' ' .
                        'GROUP BY  accidents.number';
               
				
				 
                $list = $db->getAll($sql);
                if($data['car_services_id']){
                    $sql = 'SELECT title FROM ' . PREFIX . '_car_services WHERE id = ' . $data['car_services_id'];
                    $data['car_services_title'] = $db->getOne($sql);
                }
                if($data['financial_institutions_id']){
                    $sql = 'SELECT title FROM ' .PREFIX . '_financial_institutions WHERE id = ' . $data['financial_institutions_id'];
                    $data['financial_institutions_title'] = $db->getOne($sql);
                }
            }
        }

        
        
		if (!isset($_POST['InWindow']) || $Log->isPresent()) {
			include_once 'header.php';
            include_once $this->object . '/Accidents/getSTOForPeriod.php';
            exit;
        }
		header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));

        include_once $this->object . '/Accidents/getSTOForPeriodExcel.php';
        exit;

    }
	
	function getFinancialInstitutionsOrCarServicesInWindow($data) {
        global $db;

        if($data['institution_type'] == 2){
            $sql = 'SELECT id, title ' .
                   'FROM ' . PREFIX . '_car_services ' .
                   'ORDER BY title';
        }
        if($data['institution_type'] == 1){
            $sql = 'SELECT id, title ' .
                   'FROM ' . PREFIX . '_financial_institutions ' .
                   'ORDER BY title';
        }
        $list = $db->getAll($sql);
        $result = 'var institutions_information = new Array();';
        $i = 0;
        foreach ($list as $row) {
            $result .= 'institutions_information[' . $i . '] = {id:' . $row['id'] . ', name:' . $db->quote(htmlspecialchars_decode($row['title'], ENT_QUOTES)) . '};';
            $i++;
        }
        echo $result;
    }

    function getDeclaredInsuranceCasesInWindow($data){
        $this->getDeclaredInsuranceCases($data, true);
    }

    function getDeclaredInsuranceCases($data, $excel=false){
        global $db, $Log;

        $i=0;
        $condition[] = '(';
        for($i=0; $i< sizeof($data['month']) - 1; $i++){
            $condition[] = 'accidents.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][$i]) + 1, 0, intval($data['year'])))) . ' OR ';
        }
        $condition[] = 'accidents.date BETWEEN ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]), 1, intval($data['year'])))) . ' AND ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month'][sizeof($data['month']) - 1]) + 1, 0, intval($data['year'])))) . ')';

        $conditions[] = 'accidents.product_types_id = ' . intval($data['product_types_id']);
                               
        if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
            $conditions[] = 'accidents_go.owner_types_id = 2';
        }

        if($_POST['do']){
            if(!$data['month']){
                $Log->add('error', 'Виберіть місяць');
            }
            else{
                if(intval($data['product_types_id']) == PRODUCT_TYPES_KASKO || intval($data['product_types_id']) == PRODUCT_TYPES_GO){
                    $sql = 'SELECT  accidents.number as accidents_number, policies.insurer as insurer, policies.number as policies_number, date_format(policies.date, ' . $db->quote(DATE_FORMAT) . ') as policies_date, ' .
                           'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', CONCAT(kasko_items.brand, \' / \', kasko_items.model), CONCAT(policies_go.brand, \' / \', policies_go.model)) AS item, ' .
                           'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', kasko_items.sign, policies_go.sign) AS sign, ' .
                           'IF(accidents_go.owner_person_types_id = 1, CONCAT(accidents_go.owner_lastname, \' \', accidents_go.owner_firstname), accidents_go.owner_lastname) as owner, ' .
                           'CONCAT(accidents_go.owner_brand, \' \', accidents_go.owner_model) as owner_item, accidents_go.owner_sign as owner_sign, ' .
						   'IF(accidents.product_types_id = 3,
								parameters_risks.title,
								IF(accidents.application_risks_id = 1,
									IF(accidents_go.property_types_id = 1,
										\'ТЗ\',
										\'Майно, крім ТЗ\'
									)
								,
								"Здоров\'я"
								)
							) as risks_title, ' .
                           'date_format(accidents.datetime, ' . $db->quote(DATE_FORMAT) . ') as datetime, date_format(accidents.date, ' . $db->quote(DATE_FORMAT) . ') as accidents_date, accidents.amount_rough, ' .
                           'getAmountAccidents(accidents.number, accidents.id, 3) as amount, date_format(changes.created, ' . $db->quote(DATE_FORMAT) . ') as created, accidents.regres,  ' .
						   'date_format(accidents.created, ' . $db->quote(DATE_FORMAT) . ') as accidents_created ' . 
                            'FROM insurance_accidents as accidents ' .
                            'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                            'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
                            'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                            'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id ' .
                            'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
                            'LEFT JOIN (SELECT accidents_id, MAX(created) as created FROM ' . PREFIX . '_accident_status_changes WHERE accident_statuses_id = 11 GROUP BY accidents_id) as changes ON changes.accidents_id = accidents.id ' .
							'LEFT JOIN ' . PREFIX . '_parameters_risks as parameters_risks ON accidents.application_risks_id = parameters_risks.id ' .
							'WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' ', $condition) . ' ' .
                            'GROUP BY  accidents.number ' .
                            'ORDER BY accidents.date';
                    $list = $db->getAll($sql);
                }
                else{
                    $sql = 'SELECT accidents.number as accidents_number, policies.insurer as insurer, policies.number as policies_number, date_format(policies.date, ' . $db->quote(DATE_FORMAT) . ') as policies_date, ' .
                            'property_objects_items.title as item, accidents.damage as sign, accidents.regres, ' .
                            'SUM(payments.amount) as amount, (SELECT MIN(date_format(date, ' . $db->quote(DATE_FORMAT) . ')) as date FROM insurance_accident_payments WHERE accidents_id = accidents.id and is_return = 0) as first_recovery_date, ' .
                            'date_format(accidents.datetime, ' . $db->quote(DATE_FORMAT) . ') as datetime, date_format(accidents.date, ' . $db->quote(DATE_FORMAT) . ') as accidents_date, accidents.amount_rough, ' .
                            'IF(accidents.insurance IN (2, 3), date_format(getMinSetAccidentsStatusesDate(accidents.id, ' . ACCIDENT_STATUSES_RESOLVED . '), ' . $db->quote(DATE_FORMAT) . '), \'\') as date_no, date_format(changes.created, ' . $db->quote(DATE_FORMAT) . ') as created  ' .
                            'FROM insurance_accidents as accidents ' .
                            'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                            'JOIN ' . PREFIX . '_policies_property AS policies_property ON accidents.policies_id = policies_property.policies_id ' .
                            'JOIN ' . PREFIX . '_policies_property_objects AS property_objects ON policies.id = property_objects.policies_id ' .
                            'JOIN ' . PREFIX . '_policies_property_objects_items AS property_objects_items ON property_objects.id = property_objects_items.objects_id ' .
                            'LEFT JOIN ' . PREFIX . '_accidents_acts as acts ON accidents.id = acts.accidents_id ' .
                            'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id and acts.id = calendar.acts_id '  .
                            'LEFT JOIN ' . PREFIX . '_accident_payments as payments ON accidents.id = payments.accidents_id and calendar.id = payments.payments_calendar_id and payments.is_return = 0 ' .
                            'LEFT JOIN (SELECT accidents_id, MAX(created) as created FROM ' . PREFIX . '_accident_status_changes WHERE accident_statuses_id = 11 GROUP BY accidents_id) as changes ON changes.accidents_id = accidents.id ' .
							'WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' ', $condition) . ' ' .
                            'GROUP BY  accidents.number ' .
                            'ORDER BY accidents.date';
                    $list = $db->getAll($sql);
                }
            }
        }
		
		if($Log->isPresent() || !$_POST['do']){
            include_once $this->object . '/Accidents/getDeclaredInsuranceCases.php';
            exit;
        }
 
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getDeclaredInsuranceCasesExcel.php';
            exit;
 
    }
	
	function getPayedCompensationCarServicesByPeriodInWindow($data){
        $this->getPayedCompensationCarServicesByPeriod($data, true);
    }

	function getPayedCompensationCarServicesByPeriod($data, $excel=false) {
		global $db, $MONTHES;

		$periods = array();
		$periods_format = array();

		if ($data['month'] && $data['year']) {
			$from_month = $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month']), 1, intval($data['year']))));
			$to_month = $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month']) + 1, 0, intval($data['year']))));
		} else {
			include_once $this->object . '/Accidents/getPayedCompensationCarServicesByPeriod.php';
            exit;
		}
		
		$day = 1;
		$last_day = 0;//date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])));
		$number_period = 1;
		while(mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])) <= mktime(0, 0, 0, intval($data['month']) + 1, 0, intval($data['year']))) {
			if (!in_array(date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year']))), array(6, 0))) {
				if (date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year']))) == 1 || $day == 1) {
					$periods[$number_period]['begin'] = date('Y-m-d', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])));
					$periods_format[$number_period]['begin'] = date('d.m.Y', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])));
				}
			} else {
				if (date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year']))) == 6 && $day != 1) {
					$periods[$number_period]['end'] = date('Y-m-d', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
					$periods_format[$number_period]['end'] = date('d.m.Y', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
					$number_period++;
				}
			}
			$day++;
		}
		if (!in_array(date('w', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year']))), array(6, 0))) {
			$periods[$number_period]['end'] = date('Y-m-d', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
			$periods_format[$number_period]['end'] = date('d.m.Y', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
		}
		
		$sql = 'SELECT id, title, regions_id, ukravto ' .
			   'FROM ' . PREFIX . '_car_services ' .
			   'WHERE active = 1 AND ukravto = 1 ' .
			   'ORDER BY title ASC';
		$car_services = $db->getAll($sql);
		
		foreach ($car_services as $car_service) {
			$values['car_services'][(in_array($car_service['regions_id'], array(26,10)) ? 1 : 0)][$car_service['id']] = array('title' => $car_service['title'], 'regions_id' => $car_service['regions'], 'ukravto' => $car_service['ukravto']);
		}
		
		if (intval($data['product_types_id'])) {
			$product_types_id[] = $data['product_types_id'];
		} else {
			$product_types_id[] = PRODUCT_TYPES_KASKO;
			$product_types_id[] = PRODUCT_TYPES_GO;
		}

		foreach ($periods as $key => $period) {
			$sql = 'SELECT car_services.id as id, car_services.regions_id as regions_id, SUM(calendar.amount) as payed_amount, SUM(getDeductibleByActsId(calendar.acts_id)) as deductibles_amount ' .
				   'FROM ' . PREFIX . '_car_services as car_services ' .
				   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON car_services.id = calendar.recipients_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']) . ' ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id ' .
				   'WHERE car_services.active = 1 AND car_services.ukravto = 1 AND accidents.product_types_id IN (' . implode(',', $product_types_id) . ') ' .
				   'GROUP BY car_services.id';
			$list = $db->getAll($sql);

			foreach ($list as $row) {
				$values['car_services'][(in_array($row['regions_id'], array(26,10)) ? 1 : 0)][$row['id']]['periods'][$key]['payed_amount'] = ($row['payed_amount'] > 0 ? $row['payed_amount'] : 0);
				$values['car_services'][(in_array($row['regions_id'], array(26,10)) ? 1 : 0)][$row['id']]['periods'][$key]['deductibles_amount'] = ($row['deductibles_amount'] > 0 ? $row['deductibles_amount'] : 0);
				$values['car_services'][(in_array($row['regions_id'], array(26,10)) ? 1 : 0)][$row['id']]['periods'][$key]['repair_amount'] = ($row['payed_amount'] > 0 ? $row['payed_amount'] : 0) + ($row['deductibles_amount'] > 0 ? $row['deductibles_amount'] : 0);
			}
		}
		
		$clients_id = array(4, 14224, 4462, 15089, 14225, 14229);
		
		$sql = 'SELECT id, company ' .
			   'FROM ' . PREFIX . '_clients ' .
			   'WHERE id IN(' . implode(', ', $clients_id) . ') ' .
			   'ORDER BY company ASC';
		$clients = $db->getAll($sql);
		
		foreach ($clients as $client) {
			$values['clients'][1][$client['id']] = array('title' => $client['company']);
		}
		
		foreach ($periods as $key => $period) {
			$sql = 'SELECT clients.id as id, SUM(calendar.amount) as payed_amount, SUM(getDeductibleByActsId(calendar.acts_id)) as deductibles_amount ' .
				   'FROM ' . PREFIX . '_clients as clients ' .
				   'LEFT JOIN ' . PREFIX . '_policies as policies ON clients.id = policies.clients_id ' .
				   'LEFT JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id ' .
				   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_INSURER . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']) . ' ' .
				   'WHERE clients.id IN(' . implode(', ', $clients_id) . ') AND accidents.product_types_id IN (' . implode(',', $product_types_id) . ') ' .
				   'GROUP BY clients.id';
			$list = $db->getAll($sql);

			foreach ($list as $row) {
				$values['clients'][1][$row['id']]['periods'][$key]['payed_amount'] = ($row['payed_amount'] > 0 ? $row['payed_amount'] : 0);
				$values['clients'][1][$row['id']]['periods'][$key]['deductibles_amount'] = ($row['deductibles_amount'] > 0 ? $row['deductibles_amount'] : 0);
				$values['clients'][1][$row['id']]['periods'][$key]['repair_amount'] = ($row['payed_amount'] > 0 ? $row['payed_amount'] : 0) + ($row['deductibles_amount'] > 0 ? $row['deductibles_amount'] : 0);
			}
		}
		
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getPayedCompensationCarServicesByPeriodExcel.php';
            exit;
	}
	
	function getFinancialInstitutionsCommissionsInWindow($data) {
		$this->getFinancialInstitutionsCommissions($data, true);
	}
	
	function getFinancialInstitutionsCommissions($data, $excel=false) {
		global $db;
		
		$conditions = array();
		
		$conditions[] = '1';
		
		if (intval($data['product_types_id'])) {
			$conditions[] = 'report.product_types_id = ' . intval($data['product_types_id']);
		}		

		if ($data['from']) {
			$conditions[] = 'report.payments_date >= ' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2));
			//$conditions[] = 'policy_payments.datetime >= ' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2)) . ' 00:00:00';
		}
		
		if ($data['to']) {
			$conditions[] = 'report.payments_date <= ' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2));
			//$conditions[] = 'policy_payments.datetime <= ' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2)) . ' 23:59:59';
		}		
		
		if ((sizeof($conditions) < 3 && is_array($conditions)) || !isset($_POST['InWindow'])  )  {
			include_once 'header.php';
			include_once $this->object . '/getFinancialInstitutionsCommissions.php';
			return;
		}
		//$conditions[] = 'report.policies_number=\'202.13.2205768\'';
		include 'cron/payments_details.php';
		
		$sql = 'CREATE TEMPORARY TABLE insurance_policy_status_changes_temp SELECT policies_id FROM insurance_policy_status_changes WHERE policy_statuses_id = 5 GROUP BY policies_id';
		$db->query($sql);
		
		$fields = array(
			'policies_number'						=>	array(
				'title' => 'Номер договру', 
				'alias' => array(
					PRODUCT_TYPES_KASKO 	=> 'report.policies_number',
					PRODUCT_TYPES_NS	 	=> 'report.policies_number',
					PRODUCT_TYPES_GO 		=> 'report.policies_number',
					PRODUCT_TYPES_MORTAGE	=> 'report.policies_number',
					PRODUCT_TYPES_PROPERTY	=> 'report.policies_number',
				)
			),
			'policies_date'							=>	array(
				'title' => 'Дата договору', 
				'alias' => array(
					PRODUCT_TYPES_KASKO 	=> 'date_format(report.policies_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_NS	 	=> 'date_format(report.policies_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_GO 		=> 'date_format(report.policies_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_MORTAGE	=> 'date_format(report.policies_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_PROPERTY	=> 'date_format(report.policies_date, \'%d.%m.%Y\')'
				)
			),
			'insurer'								=>	array(
				'title' => 'Страхувальник', 
				'alias' => array(
					PRODUCT_TYPES_KASKO 	=> 'IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company)',
					PRODUCT_TYPES_NS	 	=> 'CONCAT_WS(\' \', policies_ns.insurer_lastname, policies_ns.insurer_firstname, policies_ns.insurer_patronymicname)',
					PRODUCT_TYPES_GO 		=> 'IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname)',
					PRODUCT_TYPES_MORTAGE	=> 'IF(policies_mortage.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_mortage.insurer_lastname, policies_mortage.insurer_firstname, policies_mortage.insurer_patronymicname), policies_mortage.insurer_company)',
					PRODUCT_TYPES_PROPERTY	=> 'IF(policies_property.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_property.insurer_lastname, policies_property.insurer_firstname, policies_property.insurer_patronymicname), policies_property.insurer_company)'
				)
			),
			'insurer_code'							=>	array(
				'title' => 'ІПН / Код ЄДРПОУ', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'report.insurer_code',
					PRODUCT_TYPES_NS		=>	'report.insurer_code',
					PRODUCT_TYPES_GO		=>	'report.insurer_code',
					PRODUCT_TYPES_MORTAGE	=>	'report.insurer_code',
					PRODUCT_TYPES_PROPERTY	=>	'report.insurer_code'
				)
			),
			'brand'							=>	array(
				'title' => 'Марка ТЗ', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'policies_kasko_items.brand',
					PRODUCT_TYPES_GO		=>	'policies_go.brand'
				)
			),
			'sign'							=>	array(
				'title' => 'Державний номер', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'policies_kasko_items.sign',
					PRODUCT_TYPES_GO		=>	'policies_go.sign'
				)
			),
			'begin'									=>	array(
				'title' => 'Дата початку', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'date_format(report.begin_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_NS		=>	'date_format(report.begin_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_GO		=>	'date_format(report.begin_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_MORTAGE	=>	'date_format(report.begin_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_PROPERTY	=>	'date_format(report.begin_insurance_period_date, \'%d.%m.%Y\')'
				)
			),
			'end'									=>	array(
				'title' => 'Дата закінчення', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'date_format(report.end_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_NS		=>	'date_format(report.end_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_GO		=>	'date_format(report.end_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_MORTAGE	=>	'date_format(report.end_insurance_period_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_PROPERTY	=>	'date_format(report.end_insurance_period_date, \'%d.%m.%Y\')'
				)
			),
			'payments_date'							=>	array(
				'title' => 'Дата платежу', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'date_format(report.payments_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_NS		=>	'date_format(report.payments_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_GO		=>	'date_format(report.payments_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_MORTAGE	=>	'date_format(report.payments_date, \'%d.%m.%Y\')',
					PRODUCT_TYPES_PROPERTY	=>	'date_format(report.payments_date, \'%d.%m.%Y\')'
				)
			),	
			'agencies_id'							=>	array(
				'title' => 'Агенція', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'agencies.title',
					PRODUCT_TYPES_NS		=>	'agencies.title',
					PRODUCT_TYPES_GO		=>	'agencies.title',
					PRODUCT_TYPES_MORTAGE	=>	'agencies.title',
					PRODUCT_TYPES_PROPERTY	=>	'agencies.title'
				)
			),
			'agencies_top_id'							=>	array(
				'title' => 'Головна агенція', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'agencies_top.title',
					PRODUCT_TYPES_NS		=>	'agencies_top.title',
					PRODUCT_TYPES_GO		=>	'agencies_top.title',
					PRODUCT_TYPES_MORTAGE	=>	'agencies_top.title',
					PRODUCT_TYPES_PROPERTY	=>	'agencies_top.title'
				)
			),
			'financial_institutions_id'				=>	array(
				'title' => 'Вигодонабувач', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'IF(financial_institutions.id > 0, financial_institutions.title, policies_kasko.assured_title)',
					PRODUCT_TYPES_NS		=>	'financial_institutions.title',
					PRODUCT_TYPES_MORTAGE	=>	'financial_institutions.title',
					PRODUCT_TYPES_PROPERTY	=>	'financial_institutions.title'
				)
			),
			'insurance_products_id'					=>	array(
				'title' => 'Страховий продукт', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'products.title',
					PRODUCT_TYPES_NS		=>	'products.title',
				)
			),
			'financial_institutions_compensation'	=>	array(
				'title' => 'Знижка для банку', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(products_kasko.bank_discount_value, \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'IF(policies_ns.bank_discount_value = 0 OR policies_ns.bank_discount_value IS NULL, REPLACE(products_ns.bank_discount_value, \'.\', \',\'), REPLACE(policies_ns.bank_discount_value, \'.\', \',\'))'
				)
			),
			'financial_institutions_commission'		=>	array(
				'title' => 'Компенсація банку', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(products_kasko.bank_commission_value, \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'IF(policies_ns.bank_commission_value = 0 OR policies_ns.bank_commission_value IS NULL, REPLACE(products_ns.bank_commission_value, \'.\', \',\'), REPLACE(policies_ns.bank_commission_value, \'.\', \',\'))'
				)
			),
			'agents_commission'						=>	array(
				'title' => 'Комісія агента, нарахована', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(policy_payments_calendar.commission_agent_amount, \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'REPLACE(policy_payments_calendar.commission_agent_amount, \'.\', \',\')',
					PRODUCT_TYPES_GO		=>	'REPLACE(policy_payments_calendar.commission_agent_amount, \'.\', \',\')'
				)
			),
			'agents_commission_payed'				=>	array(
				'title' => 'Комісія агента, сплачена', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(getCommissionAmount(report.payments_calendar_id, 1), \'.\', \',\')'
				)
			),
			'agents_discount'						=>	array(
				'title' => 'Знижка агента', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(policies_kasko.discount, \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'REPLACE(policies_ns.discount, \'.\', \',\')'
				)
			),
			'product_types_id'						=>	array(
				'title' => 'Вид страхування', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'product_types.title',
					PRODUCT_TYPES_GO		=>	'product_types.title',
					PRODUCT_TYPES_NS		=>	'product_types.title',
					PRODUCT_TYPES_MORTAGE	=>	'product_types.title',
					PRODUCT_TYPES_PROPERTY	=>	'product_types.title'
				)
			),
			'policy_payments_amount'				=>	array(
				'title' => 'Сума по договору', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(report.policy_payments_amount, \'.\', \',\')',
					PRODUCT_TYPES_GO		=>	'REPLACE(report.policy_payments_amount, \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'REPLACE(report.policy_payments_amount, \'.\', \',\')',
					PRODUCT_TYPES_MORTAGE	=>	'REPLACE(report.policy_payments_amount, \'.\', \',\')',
					PRODUCT_TYPES_PROPERTY	=>	'REPLACE(report.policy_payments_amount, \'.\', \',\')'
				)
			),
			'policy_payments_fact_amount'			=>	array(
				'title' => 'Фактично сплачено', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(SUM(policy_payments.amount), \'.\', \',\')',
					PRODUCT_TYPES_GO		=>	'REPLACE(SUM(policy_payments.amount), \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'REPLACE(SUM(policy_payments.amount), \'.\', \',\')',
					PRODUCT_TYPES_MORTAGE	=>	'REPLACE(SUM(policy_payments.amount), \'.\', \',\')',
					PRODUCT_TYPES_PROPERTY	=>	'REPLACE(SUM(policy_payments.amount), \'.\', \',\')'
				)
			),
			'rate'									=>	array(
				'title'	=>  'Тариф',
				'alias'	=>	array(
					PRODUCT_TYPES_KASKO		=>	'getCarRateByShassiForPeriod(policies_kasko_items.shassi, report.begin_insurance_period_date, report.end_insurance_period_date)',
					PRODUCT_TYPES_GO		=>	'policies.rate',
					PRODUCT_TYPES_NS		=>	'policies.rate',
					PRODUCT_TYPES_MORTAGE	=>	'policies.rate',
					PRODUCT_TYPES_PROPERTY	=>	'policies.rate'
				)
			),
			'prolongation'				=>	array(
				'title' => 'Пролонгація', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'IF(report.prolongation > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_GO		=>	'IF(report.prolongation > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_NS		=>	'IF(report.prolongation > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_MORTAGE	=>	'IF(report.prolongation > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_PROPERTY	=>	'IF(report.prolongation > 0, \'так\', \'ні\')'
				)
			),
			'policy_statuses_quote'				=>	array(
				'title' => 'Котирування', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'IF(policy_status_changes_temp.policies_id > 0, \'так\', \'ні\')',
					//PRODUCT_TYPES_GO		=>	'IF(policy_status_changes.policies_id > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_NS		=>	'IF(policy_status_changes_temp.policies_id > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_MORTAGE	=>	'IF(policy_status_changes_temp.policies_id > 0, \'так\', \'ні\')',
					PRODUCT_TYPES_PROPERTY	=>	'IF(policy_status_changes_temp.policies_id > 0, \'так\', \'ні\')'
				)
			),
			'insurance_price'						=>	array(
				'title' => 'Страхова сума', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'REPLACE(report.insurance_price, \'.\', \',\')',
					PRODUCT_TYPES_NS		=>	'REPLACE(report.insurance_price, \'.\', \',\')',
					PRODUCT_TYPES_GO		=>	'REPLACE(report.insurance_price, \'.\', \',\')',
					PRODUCT_TYPES_MORTAGE	=>	'REPLACE(report.insurance_price, \'.\', \',\')',
					PRODUCT_TYPES_PROPERTY	=>	'REPLACE(report.insurance_price, \'.\', \',\')'
				)
			),
			'questionnaires_number'					=>	array(
				'title' => 'Номер анкети', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'questionnaires.number',
					PRODUCT_TYPES_NS		=>	'questionnaires.number'
				)
			),
			'creditRequest_dateTime'				=>	array(
				'title' => 'Дата кредитної угоди', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'date_format(questionnaire_solutions.creditRequest_dateTime, \'%d.%m.%Y\')',
					PRODUCT_TYPES_NS		=>	'date_format(questionnaire_solutions.creditRequest_dateTime, \'%d.%m.%Y\')'
				)
			),
			'credit_amount'							=>	array(
				'title' => 'Сума кредиту', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'questionnaire_solutions.bankCreditAgreementAmount',
					PRODUCT_TYPES_NS		=>	'questionnaire_solutions.bankCreditAgreementAmount'
				)
			),
			'expert_period'							=>	array(
				'title' => 'Термін кредитування', 
				'alias' => array(
					PRODUCT_TYPES_KASKO		=>	'questionnaire_solutions.expert_period',
					PRODUCT_TYPES_NS		=>	'questionnaire_solutions.expert_period'
				)
			),
			'credit_initialInstalmentAmount'		=>	array(
				'title'	=>	'Сума авансу',
				'alias'	=>	array(
					PRODUCT_TYPES_KASKO		=>	'questionnaire_solutions.sellAgreement_initialInstalmentAmount',
					PRODUCT_TYPES_NS		=>	'questionnaire_solutions.sellAgreement_initialInstalmentAmount'
				)
			),
			'expert_initialInstalment'				=>	array(
				'title'	=>	'Аванс, %',
				'alias'	=>	array(
					PRODUCT_TYPES_KASKO		=>	'questionnaire_solutions.expert_initialInstalment'
				)
			)
		);
		
		$joins = array(
			array(
				'name' => 'agencies', 
				'alias'=> 'agencies', 
				'type' => '', 
				'conditions' => array('report.agencies_id = agencies.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO, PRODUCT_TYPES_NS, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'agencies', 
				'alias'=> 'agencies_top', 
				'type' => '', 
				'conditions' => array('agencies.top = agencies_top.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO, PRODUCT_TYPES_NS, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'financial_institutions', 
				'alias'=> 'financial_institutions', 
				'type' => 'LEFT ', 
				'conditions' => array('report.financial_institutions_id = financial_institutions.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_NS, PRODUCT_TYPES_MORTAGE)
			),
			array(
				'name' => 'financial_institutions', 
				'alias'=> 'financial_institutions', 
				'type' => 'LEFT ', 
				'conditions' => array('report.financial_institutions_id = financial_institutions.id'),
				'product_types_id' => array(PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'policy_payments_calendar', 
				'alias'=> 'policy_payments_calendar', 
				'type' => '', 
				'conditions' => array('report.payments_calendar_id = policy_payments_calendar.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO, PRODUCT_TYPES_NS, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'policies_kasko', 
				'alias'=> 'policies_kasko', 
				'type' => '', 
				'conditions' => array('policy_payments_calendar.policies_id = policies_kasko.policies_id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO)
			),
			array(
				'name' => 'policies_ns', 
				'alias'=> 'policies_ns', 
				'type' => '', 
				'conditions' => array('policy_payments_calendar.policies_id = policies_ns.policies_id'),
				'product_types_id' => array(PRODUCT_TYPES_NS)
			),
			array(
				'name' => 'policies_go', 
				'alias'=> 'policies_go', 
				'type' => '', 
				'conditions' => array('policy_payments_calendar.policies_id = policies_go.policies_id'),
				'product_types_id' => array(PRODUCT_TYPES_GO)
			),
			array(
				'name' => 'policies_mortage', 
				'alias'=> 'policies_mortage', 
				'type' => '', 
				'conditions' => array('policy_payments_calendar.policies_id = policies_mortage.policies_id'),
				'product_types_id' => array(PRODUCT_TYPES_MORTAGE)
			),
			array(
				'name' => 'policies_property', 
				'alias'=> 'policies_property', 
				'type' => '', 
				'conditions' => array('policy_payments_calendar.policies_id = policies_property.policies_id'),
				'product_types_id' => array(PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'policies_kasko_items', 
				'alias'=> 'policies_kasko_items', 
				'type' => '', 
				'conditions' => array('policy_payments_calendar.policies_id = policies_kasko_items.policies_id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO)
			),
			array(
				'name' => 'products', 
				'alias'=> 'products', 
				'type' => '', 
				'conditions' => array('policies_kasko_items.products_id = products.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO)
			),
			array(
				'name' => 'products', 
				'alias'=> 'products', 
				'type' => '', 
				'conditions' => array('policies_ns.products_id = products.id'),
				'product_types_id' => array(PRODUCT_TYPES_NS)
			),
			array(
				'name' => 'products_kasko', 
				'alias'=> 'products_kasko', 
				'type' => '', 
				'conditions' => array('products.id = products_kasko.products_id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO)
			),
			array(
				'name' => 'products_ns', 
				'alias'=> 'products_ns', 
				'type' => '', 
				'conditions' => array('products.id = products_ns.products_id'),
				'product_types_id' => array(PRODUCT_TYPES_NS)
			),
			array(
				'name' => 'product_types', 
				'alias'=> 'product_types', 
				'type' => '', 
				'conditions' => array('report.product_types_id = product_types.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO, PRODUCT_TYPES_NS, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'policies', 
				'alias'=> 'policies', 
				'type' => '', 
				'conditions' => array('report.policies_number = policies.number', '(policies.sub_number = 0 OR policies.sub_number IS NULL)'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_NS, PRODUCT_TYPES_GO, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'policies', 
				'alias'=> 'policies_fact_payments', 
				'type' => '', 
				'conditions' => array('policies.number = policies_fact_payments.number'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_NS, PRODUCT_TYPES_GO, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'policy_payments', 
				'alias'=> 'policy_payments', 
				'type' => '', 
				'conditions' => array(
					'policies_fact_payments.id = policy_payments.policies_id', 
					($data['from']) ? 'policy_payments.datetime >= ' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2) . ' 00:00:00') : null,
					($data['to']) ? 'policy_payments.datetime <= ' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2) . ' 23:59:59') : null
				),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_NS, PRODUCT_TYPES_GO, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			),
			array(
				'name' => 'questionnaire_solutions', 
				'alias'=> 'questionnaire_solutions', 
				'type' => 'LEFT ', 
				'conditions' => array('policies.solutions_id = questionnaire_solutions.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO)
			),	
			array(
				'name' => 'questionnaire_solutions', 
				'alias'=> 'questionnaire_solutions', 
				'type' => 'LEFT ', 
				'conditions' => array('policy_payments_calendar.policies_id = questionnaire_solutions.insurance_ns_policiesId'),
				'product_types_id' => array(PRODUCT_TYPES_NS)
			),
			array(
				'name' => 'questionnaires', 
				'alias'=> 'questionnaires', 
				'type' => 'LEFT ', 
				'conditions' => array('questionnaire_solutions.questionnairesId = questionnaires.id'),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_NS)
			),
			array(
				'name' => 'policy_status_changes_temp', 
				'alias'=> 'policy_status_changes_temp', 
				'type' => 'LEFT ', 
				'conditions' => array('policy_payments_calendar.policies_id = policy_status_changes_temp.policies_id'/*, 'policy_status_changes.policy_statuses_id = ' . POLICY_STATUSES_REQUEST_QUOTE*/),
				'product_types_id' => array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_NS, PRODUCT_TYPES_MORTAGE, PRODUCT_TYPES_PROPERTY)
			)
		);
		
		$totals = array('agents_commission', 'policy_payments_amount', 'credit_amount', 'credit_initialInstalmentAmount', 'insurance_price');
		
		$sql = 'SELECT ';
		$first = true;
		foreach ($fields as $key => $attr) {
			if (!$first && $attr['alias'][$data['product_types_id']]) $sql .= ', ';
			$first = false;
			$sql .= (($attr['alias'][$data['product_types_id']]) ? ($attr['alias'][$data['product_types_id']] . ' as ' . $key) : '');
		}
		$sql .= ' FROM ' . PREFIX . '_report_payments_details as report ';		
		foreach ($joins as $join) {
			if (in_array($data['product_types_id'], $join['product_types_id'])) {
				$sql .= $join['type'] . 'JOIN ' . PREFIX . '_' . $join['name'] . ' as ' . $join['alias'] . ' ON ' . implode(' AND ', $join['conditions']) . ' ';
			}
		}
		$sql .= 'WHERE ' . implode(' AND ', $conditions) . ' GROUP BY report.payments_calendar_id';
		$list = $db->getAll($sql);
		//_dump($sql);
		
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/getFinancialInstitutionsCommissionsExcel.php';
            exit;
	}
	
	function getTransferAccidentsActsList($data, $excel=false) {
		global $db;
		
		$sql = 'SELECT accidents.number as accidents_number, product_types.title as product_types_title, policies.number as policies_number, ' .
					'CASE accidents.product_types_id
						WHEN ' . PRODUCT_TYPES_KASKO . ' THEN IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), insurer_company)
						WHEN ' . PRODUCT_TYPES_GO . ' THEN IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname)
					END as insurer, ' .
					'CONCAT_WS(\' \', accidents_go.owner_lastname, accidents_go.owner_firstname, accidents_go.owner_patronymicname) as owner, ' .
					'accidents_acts.number as accidents_acts_number, ' .
					'CASE accidents_acts.insurance
						WHEN 1 THEN \'виплата\'
						ELSE \'відмова\'
					END as insurance_title, ' .
					'calendar.amount as amount, ' .
					'calendar.recipient as recipient, ' .
					'accidents_acts.reason as reason, date_format(accidents_acts.date, \'%d.%m.%Y\') as accidents_acts_date ' .
				'FROM ' . PREFIX . '_accidents as accidents ' .
				'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents_acts.id = calendar.acts_id ' .
				'JOIN ' . PREFIX . '_product_types as product_types ON accidents.product_types_id = product_types.id ' .
				'WHERE accidents.product_types_id IN (' . PRODUCT_TYPES_KASKO . ', ' . PRODUCT_TYPES_GO . ') AND accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY;
		$list = $db->getAll($sql);
				
		if ($excel) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getTransferAccidentsActsListExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getTransferAccidentsActsList.php';
            exit;
        }
	}
	
	function getTransferAccidentsActsListInWindow($data) {
		$this->getTransferAccidentsActsList($data, true);
	}
	
	function getCompromisesInWindow($data){
        $this->getCompromises($data, true);
    }

    function getCompromises($data, $excel=false){
        global $db, $Log, $Authorization;

        if(!checkdate(substr($data['from'], 3, 2), substr($data['from'], 0, 2), substr($data['from'], 6, 4)) && isset($_POST['do'])){
            $Log->add('error', 'Дата початку звітного періоду не вірна');
        }

        if(!checkdate(substr($data['to'], 3, 2), substr($data['to'], 0, 2), substr($data['to'], 6, 4)) && isset($_POST['do'])){
            $Log->add('error', 'Дата закінчення звітного періоду не вірна');
        }
        if(!$Log->isPresent() && $data['from'] && $data['to']){
            $start = microtime(true);
            if($data['register'] == 1){
                $conditions[] = 'accidents.accident_statuses_id = ' . ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
                $conditions[] = '(compromise_date = \'0000-00-00\' OR ISNULL(compromise_date))';
                $conditions[] = 'compromise_violation <> 2';
            }
            else{
                $conditions[] = 'accidents.compromise = 1 ';
            }

            $conditions[] = 'getMaxSetAccidentsStatusesDate(accidents.id, ' . ACCIDENT_STATUSES_COMPROMISE_AGREEMENT . ') between ' . $db->quote(substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2) . ' 00:00:00') . ' AND ' . $db->quote(substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2) . ' 23:59:59');
			
            $sql = 'SELECT accidents.id ' . 
							', accidents.number as accidents_number, policies.number as policies_number, date_format(policies.date, ' . $db->quote(DATE_FORMAT) . ') as policies_date, policies.insurer, ' .
                            'CONCAT(kasko_items.brand, \' / \', kasko_items.model) as items, kasko_items.sign, kasko_items.shassi, date_format(accidents.datetime, ' . $db->quote(DATE_FORMAT) . ') as accidents_datetime, ' .
                            'accidents.amount_rough, accidents.compromise_comment, accidents.description, accidents.insurance, ' .
							'IF(kasko_items.deductibles_absolute0 = 1, kasko_items.deductibles_value0, kasko_items.deductibles_value0 * kasko_items.car_price / 100) as deductibles_amount, ' .
                            'date_format(accidents.compromise_date, ' . $db->quote(DATE_FORMAT) . ') as compromise_date, getRecipientAccidents(accidents.number, accidents.id, 3) as recipient, ' .
                            'getPaymentDateAccidents(accidents.number, accidents.id, 3) as payment_date, ' .
                            'getCompensation(accidents.id, accidents.product_types_id) as payment_amount, ' .
                            'IF(accidents.insurance IN (2, 3), date_format(getMaxSetAccidentsStatusesDate(accidents.id, ' . ACCIDENT_STATUSES_RESOLVED . '), ' . $db->quote(DATE_FORMAT) . '), \'\') as date_no, ' . 'getCompensationInfo(accidents.id, 1) as compensations, car_services.title as car_services_title, ' .
                            'getCompensationInfo(accidents.id, 2) as policies_previous_accidents_list, ' .
                            'getCompensationInfo(accidents.id, 3) as policies_previous_accidents_amount, ' .
                            'getCompensationInfo(accidents.id, 4) as previous_policies_item_list, ' .
                            'getCompensationInfo(accidents.id, 5) as previous_policies_item_amount, ' .
                            'getCompensationInfo(accidents.id, 6) as previous_policies_item_accidents_amount, ' .
                            'getCompensationInfo(accidents.id, 7) as all_policies_insurer_list, ' .
                            'getCompensationInfo(accidents.id, 8) as all_policies_insurer_amount, ' .
                            'getCompensationInfo(accidents.id, 9) as all_policies_insurer_accidents_amount, ' .
                            'getCompensationInfo(accidents.id, 10) as compromises_title ' .
                    'FROM ' . PREFIX . '_accidents as accidents ' .
                    'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents.policies_id = kasko_items.policies_id and accidents_kasko.items_id = kasko_items.id ' .
                    'JOIN ' . PREFIX . '_car_services as car_services ON accidents.car_services_id = car_services.id ' .
                    'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id and calendar.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION . ', ' . PAYMENT_TYPES_PART_PREMIUM . ')' .
                    'WHERE ' . implode(' AND ' , $conditions) . ' ' .
                    'GROUP BY accidents.id';
            $list = $db->getAll($sql);

            $time = microtime(true) - $start;
        }
        if (!$Log->isPresent() && isset($_POST['do'])) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getCompromisesExcel.php';
            exit;
        } else {
			if (isset($_POST['do']))  include_once 'header.php';
            include_once $this->object . '/Accidents/getCompromises.php';
            exit;
        }
    }
	
	function getPayedCompensationRecipientsByPeriodInWindow($data){
        $this->getPayedCompensationRecipientsByPeriod($data, true);
    }

	function getPayedCompensationRecipientsByPeriod($data, $excel=false) {
		global $db, $MONTHES;

		$periods = array();
		$periods_format = array();

		if ($data['month'] && $data['year']) {
			$from_month = $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month']), 1, intval($data['year']))));
			$to_month = $db->quote(date('Y-m-d', mktime(0, 0, 0, intval($data['month']) + 1, 0, intval($data['year']))));
		} else {
			include_once $this->object . '/Accidents/getPayedCompensationRecipientsByPeriod.php';
            exit;
		}
		
		$day = 1;
		$last_day = 0;//date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])));
		$number_period = 1;
		while(mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])) <= mktime(0, 0, 0, intval($data['month']) + 1, 0, intval($data['year']))) {
			if (!in_array(date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year']))), array(6, 0))) {
				if (date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year']))) == 1 || $day == 1) {
					$periods[$number_period]['begin'] = date('Y-m-d', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])));
					$periods_format[$number_period]['begin'] = date('d.m.Y', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year'])));
				}
			} else {
				if (date('w', mktime(0, 0, 0, intval($data['month']), $day, intval($data['year']))) == 6 && $day != 1) {
					$periods[$number_period]['end'] = date('Y-m-d', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
					$periods_format[$number_period]['end'] = date('d.m.Y', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
					$number_period++;
				}
			}
			$day++;
		}
		if (!in_array(date('w', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year']))), array(6, 0))) {
			$periods[$number_period]['end'] = date('Y-m-d', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
			$periods_format[$number_period]['end'] = date('d.m.Y', mktime(0, 0, 0, intval($data['month']), $day - 1, intval($data['year'])));
		}
		
		$clients_id = array(4, 14224, 4462, 15089, 14225, 14229);
		
		$values = array();
		
		$values['ukravto_total']['title'] = 'Всього по Корпорації "УкрАВТО":';
		$values['company_ukravto']['title'] = ' - з них на Компанії "УкрАВТО"';
		$values['car_services_ukravto']['title'] = ' - з них на СТО "УкрАВТО"';
		$values['insurer']['title'] = 'Страхувальник';
		$values['assured']['title'] = 'На погашення кредитної заборгованості';
		$values['car_services_others']['title'] = 'Інше СТО';
		$values['part_premium']['title'] = 'Взаємозалік';
		
		foreach ($periods as $key => $period) {
			$sql = 'SELECT SUM(calendar.amount) as payed_amount ' .
				   'FROM ' . PREFIX . '_car_services as car_services ' .
				   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON car_services.id = calendar.recipients_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']) . ' ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
				   'WHERE car_services.ukravto = 1';
			$values['car_services_ukravto'][$key]['payed_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(calendar.amount) as payed_amount ' .
				   'FROM ' . PREFIX . '_clients as clients ' .
				   'LEFT JOIN ' . PREFIX . '_policies as policies ON clients.id = policies.clients_id ' .
				   'LEFT JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id AND accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
				   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_INSURER . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']) . ' ' .
				   'WHERE clients.id IN(' . implode(', ', $clients_id) . ')';
			$values['company_ukravto'][$key]['payed_amount'] = $db->getOne($sql);
			
			$values['ukravto_total'][$key]['payed_amount'] = $values['car_services_ukravto'][$key]['payed_amount'] + $values['company_ukravto'][$key]['payed_amount'];
			
			$sql = 'SELECT SUM(calendar.amount) as payed_amount ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
				   'WHERE calendar.recipient_types_id IN(' . RECIPIENT_TYPES_INSURER . ', ' . RECIPIENT_TYPES_OTHER .  ', ' . RECIPIENT_TYPES_OWNER . ') AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']);
			$values['insurer'][$key]['payed_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(calendar.amount) as payed_amount ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
				   'WHERE calendar.recipient_types_id = ' . RECIPIENT_TYPES_ASSURED . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']);
			$values['assured'][$key]['payed_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(calendar.amount) as payed_amount ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'LEFT JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .				   
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
				   'WHERE (car_services.ukravto = 0 OR car_services.id IS NULL) AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']);
			$values['car_services_others'][$key]['payed_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(calendar.amount) as payed_amount ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($data['product_types_id']) . ' ' .
				   'WHERE (calendar.payment_types_id = ' . PAYMENT_TYPES_PART_PREMIUM . ' OR accidents.product_types_id = ' . PRODUCT_TYPES_GO . ' AND calendar.recipient_types_id = 6 AND calendar.payment_types_id = 6) AND calendar.payment_statuses_id <> 1 AND calendar.payment_date BETWEEN ' . $db->quote($period['begin']) . ' AND ' . $db->quote($period['end']);
			$values['part_premium'][$key]['payed_amount'] = $db->getOne($sql);
		}
 
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getPayedCompensationRecipientsByPeriodExcel.php';
            exit;
       
	}
	
	function getAccidentsResolvedTermsInWindow($data) {
		$this->getAccidentsResolvedTerms($data, true);
	}
	
	function getAccidentsResolvedTerms($data, $excel=false) {
		global $db;
		
		$this->checkPermissions('getAccidentsResolvedTerms', $data);
		
		$fields = array(
			'accidents_number'							=>	array(
				'title'		=>	'Номер справи',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	'mso-number-format:"\@"'
			),
			'accidents_date'							=>	array(
				'title'		=>	'Дата події',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'accidents_amount_rough'					=>	array(
				'title'		=>	'Орієнтовний збиток',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	'mso-number-format:"0\,00"'
			),
			'accidents_acts_amount'						=>	array(
				'title'		=>	'Фактичний збиток',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	'mso-number-format:"0\,00"'
			),
			'get_express_date'							=>	array(
				'title'		=>	'Дата передачі справи в СК',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'accidents_payment_date'					=>	array(
				'title'		=>	'Дата виплати СВ',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'accidents_payment_recipient'				=>	array(
				'title'		=>	'Отримувач СВ',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'average_managers_name'						=>	array(
				'title'		=>	'Відповідальний <br/>(аварком)',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'estimate_managers_name'					=>	array(
				'title'		=>	'Відповідальний <br/>(експерт)',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'duration_to_classification'				=>	array(
				'title'		=>	'Кількість днів з моменту внесення заяви в базу до моменту класифікації',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_classification_current'			=>	array(
				'title'		=>	'Кількість днів справа знаходиться в класифікації на момент формування звіту (' . date('d.m.Y') . ')',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_classification'					=>	array(
				'title'		=>	'Кількість днів з моменту класифікації до статусу "розгляд"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'classification_responsible'				=>	array(
				'title'		=>	'Відповідальний за класифікацію',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_expert_messages'					=>	array(
				'title'		=>	'Експертна робота',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_classification_to_transfer'		=>	array(
				'title'		=>	'Кількість днів на розгляді від статусу «класифікація» до статусу "передано в СК"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_investigation_current'			=>	array(
				'title'		=>	'Кількість днів справа знаходиться у розгляді на момент формування звіту (' . date('d.m.Y') . ')',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_investigation'					=>	array(
				'title'		=>	'Кількість днів на розгляді з моменту класифікації (статус "розгляд") до переведення справи у статус "затвердження"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_approval_current'					=>	array(
				'title'		=>	'Кількість днів справа знаходиться в затвердженні на момент формування звіту (' . date('d.m.Y') . ')',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_approval'							=>	array(
				'title'		=>	'Кількість днів з моменту розгляду (статус "затвердження") до переведення справи у статус "передача в СК"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_transfer'							=>	array(
				'title'		=>	'Кількість днів від переведення справи в статус "передача в СК" до статусу "оплата" чи "врегульовано"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_between_create_transfer_plus'		=>	array(
				'title'		=>	'Кількість днів від переведення справи в статус "прийом заяви" до статусу "оплата" чи "врегульовано"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_payments'							=>	array(
				'title'		=>	'Кількість днів в статусі "оплата"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'duration_resolved'							=>	array(
				'title'		=>	'Кількість днів з моменту внесення заяви в базу до статусу "врегулювання"',
				'visible'	=>	true,
				'row'		=>	false,
				'style'		=>	'mso-number-format:"0\.00"'
			),
			'accident_statuses_title'					=>	array(
				'title'		=>	'Статус справи',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			),
			'accident_sections_title'					=>	array(
				'title'		=>	'Категорія справи',
				'visible'	=>	true,
				'row'		=>	true,
				'style'		=>	''
			)
		);
		
		$evarage_managers = Users::getListByGroup(array(ACCOUNT_GROUPS_AVERAGE, ACCOUNT_GROUPS_AVERAGE_HEAD));
		
		$sql = 'SELECT id, title ' .
			   'FROM ' . PREFIX . '_accident_statuses ' .
			   'WHERE order_position <> 0 ' .
			   'ORDER BY order_position';
		$accident_statuses = $db->getAll($sql);
		
		$conditions = array();
		$joins = array();
		
		$conditions[] = 'IF(accidents.product_types_id = 4, accidents_go.owner_types_id <> 1, 1)';
		
		if (is_array($data['product_types_id']) && sizeof($data['product_types_id'])) {
			$conditions[] = 'accidents.product_types_id IN (' . implode(', ', $data['product_types_id']) . ')';
		}		
		
		if (is_array($data['average_managers_id']) && sizeof($data['average_managers_id'])) {
			$conditions[] = 'accidents.average_managers_id IN (' . implode(', ', $data['average_managers_id']) . ')';
		}
		
		if (is_array($data['accident_statuses_id']) && sizeof($data['accident_statuses_id'])) {
			$conditions[] = 'accidents.accident_statuses_id IN (' . implode(', ', $data['accident_statuses_id']) . ')';
		}
		
		if ($data['fromAccidentsDate']) {
			$conditions[] = 'accidents.date >= ' . $db->quote(substr($data['fromAccidentsDate'], 6, 4) . '-' . substr($data['fromAccidentsDate'], 3, 2) . '-' . substr($data['fromAccidentsDate'], 0, 2));
		}
		
		if ($data['toAccidentsDate']) {
			$conditions[] = 'accidents.date <= ' . $db->quote(substr($data['toAccidentsDate'], 6, 4) . '-' . substr($data['toAccidentsDate'], 3, 2) . '-' . substr($data['toAccidentsDate'], 0, 2));
		}
		
		if ($data['fromResolvedDate']) {
			$conditions[] = 'changes_resolved.created >= ' . $db->quote(substr($data['fromResolvedDate'], 6, 4) . '-' . substr($data['fromResolvedDate'], 3, 2) . '-' . substr($data['fromResolvedDate'], 0, 2));
		}
		
		if ($data['toResolvedDate']) {
			$conditions[] = 'changes_resolved.created <= ' . $db->quote(substr($data['toResolvedDate'], 6, 4) . '-' . substr($data['toResolvedDate'], 3, 2) . '-' . substr($data['toResolvedDate'], 0, 2));
		}
		
		if (intval($data['only_berlin'])) {
			$joins[] = 'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id AND policies.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ' ';
		}
		
		if (sizeof($conditions) < 2) {
			include_once 'header.php';
			include_once $this->object . '/Accidents/getAccidentsResolvedTerms.php';
			exit;
		}
		
		$sql = 'SELECT accidents.number as accidents_number, CONCAT_WS(\' \', accounts.lastname, accounts.firstname) as average_managers_name, CONCAT_WS(\' \', accounts2.lastname, accounts2.firstname) as estimate_managers_name, accident_statuses.title as accident_statuses_title, accident_sections.title as accident_sections_title, accidents.accident_sections_id as accident_sections_id, ' .
					'UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 2)) - UNIX_TIMESTAMP(accidents.created) as duration_to_classification, ' .
					'changes_classification.accounts_title as classification_responsible, ' .
					'IF(getMinSetAccidentsStatusesDate(accidents.id, 3) IS NULL, UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 2)), UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 3)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 2))) as duration_classification_current, ' .
					'UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 3)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 2)) as duration_classification, ' .
					'UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 15)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 2)) as duration_classification_to_transfer, ' .
					'IF(getMinSetAccidentsStatusesDate(accidents.id, 4) IS NULL, UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 3)), UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 4)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 3))) as duration_investigation_current, ' .
					'UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 4)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 3)) as duration_investigation, ' .
					'IF(getMinSetAccidentsStatusesDate(accidents.id, 15) IS NULL, UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 4)), UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 15)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 4))) as duration_approval_current, ' .
					'UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 15)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 4)) as duration_approval, ' .
					'IF(UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)) <= UNIX_TIMESTAMP(changes_resolved.created), UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 15)), UNIX_TIMESTAMP(changes_resolved.created) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 15))) as duration_transfer, ' .
					'IF(UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)) <= UNIX_TIMESTAMP(changes_resolved.created), UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)) - UNIX_TIMESTAMP(accidents.created), UNIX_TIMESTAMP(changes_resolved.created) - UNIX_TIMESTAMP(accidents.created)) as duration_between_create_transfer_plus, ' .
					'IF(UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)) <= UNIX_TIMESTAMP(changes_resolved.created), UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 6)) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)), 0) as duration_payments, ' .
					'SUM(UNIX_TIMESTAMP(accident_messages.decision) - UNIX_TIMESTAMP(accident_messages.created)) / COUNT(accident_messages.id) as expert_time, ' .
					'IF(COUNT(accident_messages.id) > 0, CONVERT(GROUP_CONCAT(accident_messages.id SEPARATOR \',\') USING utf8), 0) as messages_list, ' .
					'UNIX_TIMESTAMP(changes_resolved.created) - UNIX_TIMESTAMP(accidents.created) as duration_resolved, ' .
					'date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_date, accidents.amount_rough as accidents_amount_rough, accidents_acts.amount as accidents_acts_amount, ' .
					'IF(UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, 5)) <= UNIX_TIMESTAMP(changes_resolved.created), date_format(getMinSetAccidentsStatusesDate(accidents.id, 5), \'%d.%m.%Y\'), date_format(changes_resolved.created, \'%d.%m.%Y\')) as get_express_date, ' .
					'date_format(MIN(calendar.payment_date), \'%d.%m.%Y\') as accidents_payment_date, CONVERT(GROUP_CONCAT(calendar.recipient) USING \'utf8\') as accidents_payment_recipient ' .
			   'FROM ' . PREFIX . '_accidents as accidents ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts ON accidents.average_managers_id = accounts.id ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts2 ON accidents.estimate_managers_id = accounts2.id ' .
			   'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
			   'LEFT JOIN (SELECT accidents_id, accounts_title FROM ' . PREFIX . '_accident_status_changes WHERE accident_statuses_id = 3 GROUP BY accidents_id) as changes_classification ON accidents.id = changes_classification.accidents_id ' .
			   'LEFT JOIN (SELECT accidents_id, MIN(created) as created FROM ' . PREFIX . '_accident_status_changes WHERE accident_statuses_id IN (6, 10) GROUP BY accidents_id) as changes_resolved ON accidents.id = changes_resolved.accidents_id ' .
			   'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents.accident_statuses_id = accident_statuses.id ' .
			   'LEFT JOIN ' . PREFIX . '_accident_sections as accident_sections ON accidents.accident_sections_id = accident_sections.id ' .
			   'LEFT JOIN ' . PREFIX . '_accident_messages as accident_messages ON accidents.id = accident_messages.accidents_id AND (accident_messages.created BETWEEN accidents.created AND getMinSetAccidentsStatusesDate(accidents.id, 4) AND accident_messages.decision BETWEEN accidents.created AND getMinSetAccidentsStatusesDate(accidents.id, 4) OR getMinSetAccidentsStatusesDate(accidents.id, 4) IS NULL) AND accident_messages.message_types_id IN (5,9,11,16) AND accident_messages.statuses_id IN (2,4) ' .
			   'LEFT JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id AND accidents_acts.number = CONCAT(accidents.number, \'-1\') ' .
			   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents_acts.id = calendar.acts_id ' .
				(sizeof($joins) ? implode('', $joins) : '') .
			   'WHERE ' . implode (' AND ', $conditions) . ' ' .
			   'GROUP BY accidents.id ' .
			   'ORDER BY accidents.date';
		$list = $db->getAll($sql);
		
		if ($excel) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getAccidentsResolvedTermsExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getAccidentsResolvedTerms.php';
            exit;
        }
	}
	
	function getServicesAttorneysInWindow($data) {
		$this->getServicesAttorneys($data, true);
	}
	
	function getServicesAttorneys($data, $excel=false) {
		global $db;
		
		$this->checkPermissions('getServicesAttorneys', $data);
		
		$conditions[] = 'akts.person_types_id = 6';
		$conditions[] = 'akts.date >= \'2013-11-01\'';
		
		if ($data['month'] != '00' && intval($data['month'])) {
			$conditions[] = 'date_format(akts.date, \'%m\') = ' . $data['month'];
		}
		if (intval($data['year'])) {
			$conditions[] = 'date_format(akts.date, \'%Y\') = ' . $data['year'];
		}
		
		$sql = 'SELECT CONCAT_WS(\' \', accounts.lastname, accounts.firstname, accounts.patronymicname) as master_name, car_services.title as car_services_title, 
					SUM(IF(masters.accounts_id = accidents.masters_id, akts_contents.comission_master, 0)) as count_application,
					SUM(IF(accidents_kasko.accidents_id > 0 OR accidents_go.accidents_id > 0, akts_contents.comission_investigation, 0)) as count_inspection,  
					30 * (SUM(IF(masters.accounts_id = accidents.masters_id, akts_contents.comission_master, 0)) + SUM(IF(accidents_kasko.accidents_id > 0 OR accidents_go.accidents_id > 0, akts_contents.comission_investigation, 0))) as total_amount ' .
			   'FROM insurance_akts as akts ' .
			   'JOIN insurance_akts_contents as akts_contents ON akts.id = akts_contents.akts_id ' .
			   'JOIN insurance_masters as masters ON akts.agreement_number = masters.agreement_number ' .
			   'JOIN insurance_accounts as accounts ON masters.accounts_id = accounts.id ' .
			   'JOIN insurance_accidents as accidents ON akts_contents.accidents_id = accidents.id ' .
			   'JOIN insurance_car_services as car_services ON masters.car_services_id = car_services.id ' .
			   'LEFT JOIN insurance_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id AND accidents_kasko.inspecting_account_id = masters.accounts_id ' . 
			   'LEFT JOIN insurance_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id AND accidents_go.inspecting_account_id = masters.accounts_id ' .
			   'WHERE ' . implode(' AND ', $conditions) .  ' ' .
			   'GROUP BY masters.accounts_id, masters.car_services_id ' . 
			   'HAVING count_application > 0 OR count_inspection > 0 ' .
			   'ORDER BY accounts.lastname, accounts.firstname, accounts.patronymicname ASC';
		$list = $db->getAll($sql);

		if ($_POST['do']) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getServicesAttorneysExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getServicesAttorneys.php';
            exit;
        }
	}
	
	function getAnalysisAccidentsByAverageInWindow($data) {
		$this->getAnalysisAccidentsByAverage($data, true);
	}
	
	function getAnalysisAccidentsByAverage($data, $excel=false) {
		global $db, $Log, $MONTHES;
		
		$this->checkPermissions('getAnalysisAccidentsByAverage', $data);
		
		//$data['product_types_id'] = PRODUCT_TYPES_KASKO;
		
		if (!intval($data['year'])) {
			include_once 'header.php';
			include_once $this->object . '/Accidents/getAnalysisAccidentsByAverage.php';
			exit;
		}
		
		$fields = array(
			'begin_balance',
			'new',
			'resolved_1',
			'resolved_23',
			'resolved_0',
			'resolved_total',
			'term',
			'reversibility',
			'end_balance'
		);
		
		$average_managers_id = array(
			9686,
			6671,
			5699,
			6560,
			12454,
			12024
		);
		
		//$conditions[] = 'product_types_id = ' . intval($data['product_types_id']);
		if (is_array($data['product_types_id']) && sizeof($data['product_types_id'])) {
			$conditions[] = 'product_types_id IN(' . implode(', ', $data['product_types_id']) . ')';
		} else {
			$conditions[] = 'product_types_id IN(0)';
		}
					
		if($data['is_all'] == NULL){
		    $conditions[] = 'average_managers_id IN (' . implode(', ', $average_managers_id) . ')';
		}		

		$sql = 'CREATE TEMPORARY TABLE ' . PREFIX . '_accidents_temp ' .
			   'SELECT * FROM ' . PREFIX . '_accidents WHERE ' . implode(' AND ', $conditions);
		$db->query($sql);

		$accidents = $db->getCol('SELECT id FROM ' . PREFIX . '_accidents_temp');
		if (!sizeof($accidents)) {
			$accidents = array();
			$accidents[] = 0;
		}
		
		foreach ($data['monthes'] as $month) {
			$begin = date('Y-m-d H:i:s', mktime(0, 0, 0, intval($month), 1, intval($data['year'])));
			$end = date('Y-m-d H:i:s', mktime(23, 59, 59, intval($month) + 1, 0, intval($data['year'])));
		
			$sql = 'SELECT accounts.id, CONCAT_WS(\' \', accounts.lastname, accounts.firstname) as average_managers_name, ' . 
						'SUM(IF(statuses3.accidents_id > 0 AND date_format(accidents.created, \'%Y\') >= 2013 AND statuses3.date < ' . $db->quote($begin) . ' AND (statuses4.accidents_id IS NULL OR statuses4.date >= ' . $db->quote($begin) . '), 1, 0)) as begin_balance, ' .
						'SUM(IF(statuses3.accidents_id > 0 AND statuses3.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0)) as new, ' .
						'SUM(IF(accidents_acts.insurance = 1 AND statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0)) as resolved_1, ' .
						'SUM(IF(accidents_acts.insurance IN (2, 3) AND accidents_acts.sign_suspended <> 1 AND statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0)) as resolved_23, ' .
						'SUM(IF(accidents_acts.insurance IN (2, 3) AND accidents_acts.sign_suspended = 1 AND statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0)) as resolved_0, ' .
						'SUM(IF(statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', UNIX_TIMESTAMP(statuses4.date) - UNIX_TIMESTAMP(statuses3.date), 0)) as term, ' .
						'(
							SUM(IF(accidents_acts.insurance = 1 AND statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0)) + 
							SUM(IF(accidents_acts.insurance IN (2, 3) AND accidents_acts.sign_suspended <> 1 AND statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0)) + 
							SUM(IF(accidents_acts.insurance IN (2, 3) AND accidents_acts.sign_suspended = 1 AND statuses4.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ', 1, 0))
							) as resolved_total, ' .
						'SUM(IF(statuses3.date <= ' . $db->quote($end) . ' AND date_format(accidents.created, \'%Y\') >= 2013 AND (statuses4.accidents_id IS NULL OR statuses4.date > ' . $db->quote($end) . '), 1, 0)) as end_balance ' .
				   'FROM ' . PREFIX . '_accounts as accounts ' .
				   'JOIN ' . PREFIX . '_accidents_temp as accidents ON accounts.id = accidents.average_managers_id ' .
				   'LEFT JOIN (SELECT accidents_id, MIN(created) as date FROM ' . PREFIX . '_accident_status_changes WHERE accident_statuses_id = 3 AND accidents_id IN (' . implode(', ', $accidents) . ') GROUP BY accidents_id) as statuses3 ON accidents.id = statuses3.accidents_id ' .
				   'LEFT JOIN (SELECT accidents_id, MIN(created) as date FROM ' . PREFIX . '_accident_status_changes WHERE accident_statuses_id = 4 AND accidents_id IN (' . implode(', ', $accidents) . ') GROUP BY accidents_id) as statuses4 ON accidents.id = statuses4.accidents_id ' .
				   'LEFT JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id AND CONCAT_WS(\'-\', accidents.number, 1) = accidents_acts.number ' .
				   'GROUP BY accounts.id ' .
				   'ORDER BY accounts.lastname, accounts.firstname';
			$list[$month] = $db->getAll($sql);
		}
		
		if ($_POST['do']) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getAnalysisAccidentsByAverageExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getAnalysisAccidentsByAverage.php';
            exit;
        }
	}
	
	function getAccidentsPaymentsInWindow($data) {
		$this->getAccidentsPayments($data, true);
	}
	
	function getAccidentsPayments($data, $excel=false) {
		global $db, $Authorization;
		
		$this->checkPermissions('getAccidentsPayments', $data);

		$conditions = array();
		
		if ($data['from'] && $data['to']) {
			$from = substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2);
			$to = substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2);
		} else {
			include_once $this->object . '/Accidents/getAccidentsPayments.php';
            exit;
		}
		
		if ($data['payment_statuses_id'] == 1) {
			$payment_statuses_id_cond = 'calendar.payment_statuses_id = 1';
			$fields[1] = 'calendar.theory_limit_payment_date';
		} elseif ($data['payment_statuses_id'] == 2) {
			$payment_statuses_id_cond = 'calendar.payment_statuses_id <> 1';
			$fields[1] = 'calendar.payment_date';
		} else {
			$payment_statuses_id_cond = 'calendar.payment_statuses_id = 0';
		}
		if (!$_POST['do']) {
			include_once $this->object . '/Accidents/getAccidentsPayments.php';
            exit;
		}
		
		$clients_id = array(4, 14224, 4462, 15089, 14225, 14229);
		
		$product_types_idx = array(PRODUCT_TYPES_KASKO => 'КАСКО', PRODUCT_TYPES_GO => 'ОСЦПВ', PRODUCT_TYPES_PROPERTY => 'Майно');
		
		$values = array();
		
		foreach ($product_types_idx as $product_types_id => $title) {
			$values[$product_types_id]['title'] = $title;
			
			switch ($product_types_id) {
				case PRODUCT_TYPES_KASKO:
					$term = 'acts.payment_term';
					$fields[0] = 'acts.date';					
					break;
				case PRODUCT_TYPES_GO:
					$term = 90;
					$fields[0] = 'acts.documents_date';
					break;
				case PRODUCT_TYPES_PROPERTY:
					$term = 'acts.payment_term';
					$fields[0] = 'acts.date';
			}
		
			$sql = 'SELECT calendar.id as calendar_id, accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
						'date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory_limit_payment_date, date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_limit_payment_date, statuses.title as statuses_title, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', date_format(getDateOrDaysWithoutWeekEnds(acts.documents_date, NULL, acts.approval_term), \'%d.%m.%Y\'), \'\') as limit_acts_date ' .
				   'FROM ' . PREFIX . '_car_services as car_services ' .
				   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON car_services.id = calendar.recipients_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND ' . $payment_statuses_id_cond . ' AND ' . $fields[1] . ' BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
				   'JOIN ' . PREFIX . '_accident_statuses as statuses ON acts.act_statuses_id = statuses.id ' .
				   'WHERE car_services.ukravto = 1';
			$values[$product_types_id]['list']['car_services_ukravto']['list'] = $db->getAll($sql);
			$values[$product_types_id]['list']['car_services_ukravto']['title'] = 'СТО "УкрАВТО"';
				
			$sql = 'SELECT calendar.id as calendar_id, accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
						'date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory_limit_payment_date, date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_limit_payment_date, statuses.title as statuses_title, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', date_format(getDateOrDaysWithoutWeekEnds(acts.documents_date, NULL, acts.approval_term), \'%d.%m.%Y\'), \'\') as limit_acts_date ' .
				   'FROM ' . PREFIX . '_clients as clients ' .
				   'LEFT JOIN ' . PREFIX . '_policies as policies ON clients.id = policies.clients_id ' .
				   'LEFT JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
				   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_INSURER . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND ' . $payment_statuses_id_cond . ' AND ' . $fields[1] . ' BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to) . ' ' .
				   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
				   'JOIN ' . PREFIX . '_accident_statuses as statuses ON acts.act_statuses_id = statuses.id ' .
				   'WHERE clients.id IN(' . implode(', ', $clients_id) . ')';
			$values[$product_types_id]['list']['company_ukravto']['list'] = $db->getAll($sql);
			$values[$product_types_id]['list']['company_ukravto']['title'] = 'Компанії "УкрАВТО"';
				
			$sql = 'SELECT calendar.id as calendar_id, accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
						'date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory_limit_payment_date, date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_limit_payment_date, statuses.title as statuses_title, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', date_format(getDateOrDaysWithoutWeekEnds(acts.documents_date, NULL, acts.approval_term), \'%d.%m.%Y\'), \'\') as limit_acts_date ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
				   'JOIN ' . PREFIX . '_accident_statuses as statuses ON acts.act_statuses_id = statuses.id ' .
				   'WHERE calendar.recipient_types_id IN(' . RECIPIENT_TYPES_INSURER . ', ' . RECIPIENT_TYPES_OTHER .  ', ' . RECIPIENT_TYPES_OWNER . ') AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND ' . $payment_statuses_id_cond . ' AND ' . $fields[1] . ' BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to);
			$values[$product_types_id]['list']['insurer']['list'] = $db->getAll($sql);
			if ($product_types_id == PRODUCT_TYPES_GO) {
				$values[$product_types_id]['list']['insurer']['title'] = 'Потерпілий';
			} else {
				$values[$product_types_id]['list']['insurer']['title'] = 'Страхувальник';
			}
			
			$sql = 'SELECT calendar.id as calendar_id, accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
						'date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory_limit_payment_date, date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_limit_payment_date, statuses.title as statuses_title, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', date_format(getDateOrDaysWithoutWeekEnds(acts.documents_date, NULL, acts.approval_term), \'%d.%m.%Y\'), \'\') as limit_acts_date ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
				   'JOIN ' . PREFIX . '_accident_statuses as statuses ON acts.act_statuses_id = statuses.id ' .
				   'WHERE calendar.recipient_types_id = ' . RECIPIENT_TYPES_ASSURED . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND ' . $payment_statuses_id_cond . ' AND ' . $fields[1] . ' BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to);
			$values[$product_types_id]['list']['assured']['list'] = $db->getAll($sql);
			$values[$product_types_id]['list']['assured']['title'] = 'На погашення кредитної заборгованості';
			
			$sql = 'SELECT calendar.id as calendar_id, accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
						'date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory_limit_payment_date, date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_limit_payment_date, statuses.title as statuses_title, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', date_format(getDateOrDaysWithoutWeekEnds(acts.documents_date, NULL, acts.approval_term), \'%d.%m.%Y\'), \'\') as limit_acts_date ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'LEFT JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .				   
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
				   'JOIN ' . PREFIX . '_accident_statuses as statuses ON acts.act_statuses_id = statuses.id ' .
				   'WHERE (car_services.ukravto = 0 OR car_services.id IS NULL) AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND ' . $payment_statuses_id_cond . ' AND ' . $fields[1] . ' BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to);
			$values[$product_types_id]['list']['car_services_others']['list'] = $db->getAll($sql);
			$values[$product_types_id]['list']['car_services_others']['title'] = 'Інше СТО';
			
			$sql = 'SELECT calendar.id as calendar_id, accidents.number as accidents_number, policies.number as policies_number, policies.insurer as insurer, calendar.recipient as recipient, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
						'date_format(calendar.theory_limit_payment_date, \'%d.%m.%Y\') as theory_limit_payment_date, date_format(calendar.real_limit_payment_date, \'%d.%m.%Y\') as real_limit_payment_date, statuses.title as statuses_title, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', date_format(getDateOrDaysWithoutWeekEnds(acts.documents_date, NULL, acts.approval_term), \'%d.%m.%Y\'), \'\') as limit_acts_date ' .
				   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
				   'JOIN ' . PREFIX . '_accident_statuses as statuses ON acts.act_statuses_id = statuses.id ' .
				   'WHERE (calendar.payment_types_id = ' . PAYMENT_TYPES_PART_PREMIUM . ' OR accidents.product_types_id = ' . PRODUCT_TYPES_GO . ' AND calendar.recipient_types_id = 6 AND calendar.payment_types_id = 6) AND ' . $payment_statuses_id_cond . ' AND ' . $fields[1] . ' BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to);
			$values[$product_types_id]['list']['part_premium']['list'] = $db->getAll($sql);
			$values[$product_types_id]['list']['part_premium']['title'] = 'Взаємозалік';
		}

		if ($_POST['do']) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getAccidentsPaymentsExcel.php';
            exit;
        }  
	}
	
	function getAccidentsPaymentsCalendarInWindow($data) {
		$this->getAccidentsPaymentsCalendar($data, true);
	}
	
	function getAccidentsPaymentsCalendar($data, $excel=false) {
		global $db;
		
		if ($data['from'] && $data['to'] && strtotime($data['to']) >= strtotime($data['from'])) {
			$from['full'] = substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2);
			$from['day'] = substr($data['from'], 0, 2);
			$from['month'] = substr($data['from'], 3, 2);
			$from['year'] = substr($data['from'], 6, 4);
			
			$to['full'] = substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2);
			$to['day'] = substr($data['to'], 0, 2);
			$to['month'] = substr($data['to'], 3, 2);
			$to['year'] = substr($data['to'], 6, 4);
		} else {
			include_once $this->object . '/Accidents/getAccidentsPaymentsCalendar.php';
            exit;
		}
		
		$current['full'] = $from['full'];
		$current['day'] = $from['day'];
		$current['month'] = $from['month'];
		$current['year'] = $from['year'];

		$values = array();
		$days = array();
		$product_types_idx = array(PRODUCT_TYPES_KASKO => 'КАСКО', PRODUCT_TYPES_GO => 'ОСЦПВ', PRODUCT_TYPES_PROPERTY => 'Майно');
		$clients_id = array(4, 14224, 4462, 15089, 14225, 14229);

		while (strtotime($current['full']) <= strtotime($to['full'])) {
			if (date('w', strtotime($current['full'])) == 0 || date('w', strtotime($current['full'])) == 6) {
				$current['full'] = date('Y-m-d', mktime(0, 0, 0, $current['month'], $current['day'] + 1, $current['year']));
				$current['day'] = date('d', strtotime($current['full']));
				$current['month'] = date('m', strtotime($current['full']));
				$current['year'] = date('Y', strtotime($current['full']));
				continue;
			}
		
			$days[] = $current['day'] . '.' . $current['month'] . '.' . $current['year'];
			
			foreach ($product_types_idx as $product_types_id => $title) {
				if (!isset($values[$product_types_id])) $values[$product_types_id]['title'] = $title;
				
				$sql = 'SELECT accidents.number as accidents_number, calendar.amount as amount, calendar.recipients_id as recipients_id, car_services.title as car_services_title ' .
					   'FROM ' . PREFIX . '_car_services as car_services ' .
					   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON car_services.id = calendar.recipients_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id = 1 AND IF(calendar.real_limit_payment_date <> \'0000-00-00\', calendar.real_limit_payment_date = ' . $db->quote($current['full']) .  ', calendar.theory_limit_payment_date = ' . $db->quote($current['full']) . ') ' .
					   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
					   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
					   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
					   'WHERE car_services.ukravto = 1 ORDER BY car_services.title ASC';
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					//$values[$product_types_id]['list']['car_services_ukravto']['list'][$current['full']] = $list;
					foreach ($list as $row) {
						$values[$product_types_id]['list']['car_services_ukravto']['list'][$row['recipients_id']]['title'] = $row['car_services_title'];
						$values[$product_types_id]['list']['car_services_ukravto']['list'][$row['recipients_id']]['list'][$current['full']][] = $row;
					}					
				}
				$values[$product_types_id]['list']['car_services_ukravto']['title'] = 'СТО "УкрАВТО"';
					
				$sql = 'SELECT accidents.number as accidents_number, calendar.amount as amount ' .
					   'FROM ' . PREFIX . '_clients as clients ' .
					   'LEFT JOIN ' . PREFIX . '_policies as policies ON clients.id = policies.clients_id ' .
					   'LEFT JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
					   'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_INSURER . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id = 1 AND IF(calendar.real_limit_payment_date <> \'0000-00-00\', calendar.real_limit_payment_date = ' . $db->quote($current['full']) .  ', calendar.theory_limit_payment_date = ' . $db->quote($current['full']) . ') ' .
					   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
					   'WHERE clients.id IN(' . implode(', ', $clients_id) . ')';
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					$values[$product_types_id]['list']['company_ukravto']['list'][$current['full']] = $list;
				}
				$values[$product_types_id]['list']['company_ukravto']['title'] = 'Компанії "УкрАВТО"';
					
				$sql = 'SELECT accidents.number as accidents_number, calendar.amount as amount ' .
					   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
					   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
					   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
					   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
					   'WHERE calendar.recipient_types_id IN(' . RECIPIENT_TYPES_INSURER . ', ' . RECIPIENT_TYPES_OTHER .  ', ' . RECIPIENT_TYPES_OWNER . ') AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id = 1 AND IF(calendar.real_limit_payment_date <> \'0000-00-00\', calendar.real_limit_payment_date = ' . $db->quote($current['full']) .  ', calendar.theory_limit_payment_date = ' . $db->quote($current['full']) . ')';
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					$values[$product_types_id]['list']['insurer']['list'][$current['full']] = $list;
				}
				if ($product_types_id == PRODUCT_TYPES_GO) {
					$values[$product_types_id]['list']['insurer']['title'] = 'Потерпілий';
				} else {
					$values[$product_types_id]['list']['insurer']['title'] = 'Страхувальник';
				}
				
				$sql = 'SELECT accidents.number as accidents_number, calendar.amount as amount ' .
					   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
					   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
					   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
					   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
					   'WHERE calendar.recipient_types_id = ' . RECIPIENT_TYPES_ASSURED . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id = 1 AND IF(calendar.real_limit_payment_date <> \'0000-00-00\', calendar.real_limit_payment_date = ' . $db->quote($current['full']) .  ', calendar.theory_limit_payment_date = ' . $db->quote($current['full']) . ')';
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					$values[$product_types_id]['list']['assured']['list'][$current['full']] = $list;
				}
				$values[$product_types_id]['list']['assured']['title'] = 'На погашення кредитної заборгованості';
				
				$sql = 'SELECT accidents.number as accidents_number, calendar.amount as amount ' .
					   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
					   'LEFT JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .				   
					   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
					   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
					   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
					   'WHERE (car_services.ukravto = 0 OR car_services.id IS NULL) AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' AND calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION . ' AND calendar.payment_statuses_id = 1 AND IF(calendar.real_limit_payment_date <> \'0000-00-00\', calendar.real_limit_payment_date = ' . $db->quote($current['full']) .  ', calendar.theory_limit_payment_date = ' . $db->quote($current['full']) . ')';
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					$values[$product_types_id]['list']['car_services_others']['list'][$current['full']] = $list;
				}
				$values[$product_types_id]['list']['car_services_others']['title'] = 'Інше СТО';
				
				$sql = 'SELECT accidents.number as accidents_number, calendar.amount as amount ' .
					   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
					   'JOIN ' . PREFIX . '_accidents as accidents ON calendar.accidents_id = accidents.id AND accidents.product_types_id = ' . intval($product_types_id) . ' ' .
					   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
					   'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
					   'WHERE (calendar.payment_types_id = ' . PAYMENT_TYPES_PART_PREMIUM . ' OR accidents.product_types_id = ' . PRODUCT_TYPES_GO . ' AND calendar.recipient_types_id = 6 AND calendar.payment_types_id = 6) AND calendar.payment_statuses_id = 1 AND IF(calendar.real_limit_payment_date <> \'0000-00-00\', calendar.real_limit_payment_date = ' . $db->quote($current['full']) .  ', calendar.theory_limit_payment_date = ' . $db->quote($current['full']) . ')';
				$list = $db->getAll($sql);
				if (is_array($list) && sizeof($list)) {
					$values[$product_types_id]['list']['part_premium']['list'][$current['full']] = $list;
				}
				$values[$product_types_id]['list']['part_premium']['title'] = 'Взаємозалік';
			}
			
			$current['full'] = date('Y-m-d', mktime(0, 0, 0, $current['month'], $current['day'] + 1, $current['year']));
			$current['day'] = date('d', strtotime($current['full']));
			$current['month'] = date('m', strtotime($current['full']));
			$current['year'] = date('Y', strtotime($current['full']));
		}

		if ($_POST['do']) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getAccidentsPaymentsCalendarExcel.php';
            exit;
        } else {
            include_once $this->object . '/Accidents/getAccidentsPaymentsCalendar.php';
            exit;
        }
	}

	function getInsurancePeriods($data) {
		global $db;
		
		if ($data['InWindow']) {
			
			require 'scripts/new_set.php';
		
			$date_types_id = array(
				1 => array(
					'date'		=> PREFIX . '_policies.date', 
					'groupby'	=> PREFIX . '_policies.id'
				),
				2 => array(
					'date'		=> PREFIX . '_policy_payments_calendar.payment_date',
					'groupby'	=> PREFIX . '_policies.id, ' . PREFIX . '_policy_payments_calendar.id'
				),
				3 => array(
					'date'		=> 'end_date',
					'groupby'	=> PREFIX . '_policies.id, ' . PREFIX . '_policy_payments_calendar.id'
				)
			);
			
			switch ($data['types_id']) {
				case 1:
					$order = PREFIX . '_agencies.agency_types_id ASC';
					$outputTypes = 1;
					break;
				case 2:
					$order = PREFIX . '_agencies.id ASC';
					$outputTypes = 1;
					break;
				case 3:
					$order = PREFIX . '_policies_kasko.financial_institutions_id ASC';
					$outputTypes = 1;
					break;
				default;
					$order = PREFIX . '_policies.date ASC';
					$outputTypes = 0;
					break;
			}

            if (!$data['from']) {
                $data['from'] = date('d.m.Y');
            }

            if (!$data['to']) {
                $data['to'] = date('d.m.Y');
            }

            $from	= $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
            $to		= $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');
			
			$conditions[] = '1';

            if (intval($data['agencies_id'])) {
                $conditions[] = PREFIX . '_policies.agencies_id = ' . intval($data['agencies_id']);
            }
			
			if (intval($data['agency_types_id'])) {
                $conditions[] = PREFIX . '_agencies.agency_types_id = ' . intval($data['agency_types_id']);
            }
			
			if (intval($data['financial_institutions_id'])) {
                $conditions[] = PREFIX . '_policies_kasko.financial_institutions_id = ' . intval($data['financial_institutions_id']);
            }
			
			if (intval($data['insurer_person_types_id'])) {
                $conditions[] = PREFIX . '_policies_kasko.insurer_person_types_id = ' . intval($data['insurer_person_types_id']);
            }

			if (intval($data['product_types_id']) == PRODUCT_TYPES_KASKO) {
			
				if (intval($data['date_types_id']) == 3) {
				
					$join_conditions[] = $date_types_id[ $data['date_types_id'] ]['date'] . ' BETWEEN ' . $from . ' AND ' . $to;

					$sql = 'SELECT ' . PREFIX . '_policies.number as policies_number, date_format(' . PREFIX . '_policies.date, \'%d.%m.%Y\') as policies_date, ' .
								'IF(' . PREFIX . '_policies_kasko.insurer_person_types_id = 1, ' .
									'CONCAT(' . PREFIX . '_policies_kasko.insurer_lastname, \' \', ' . PREFIX . '_policies_kasko.insurer_firstname, \' \', ' . PREFIX . '_policies_kasko.insurer_patronymicname), ' .
									PREFIX . '_policies_kasko.insurer_company' .
								') AS insurer, IF(' . PREFIX . '_policies_kasko.insurer_person_types_id = 1, ' . PREFIX . '_policies_kasko.insurer_identification_code, ' . PREFIX . '_policies_kasko.insurer_edrpou) as insurer_identification, ' .
								'getInsurerAddressByPoliciesId(' . PREFIX . '_policies.id) as address, ' . PREFIX . '_policies.item as item, ' . PREFIX . '_policies_kasko.insurer_phone, ' .
								'IF(' . PREFIX . '_policies_kasko.terms_years_id > 1, ' .
									'SUM(' . PREFIX . '_policies_kasko_item_years_payments.item_price), ' .
									PREFIX . '_policies.price ' .
								') as price, ' .
								'IF(' . PREFIX . '_policies_kasko.terms_years_id > 1, ' .
									PREFIX . '_policies_kasko_item_years_payments.rate_kasko, ' .
									PREFIX . '_policies.rate ' .
								') as rate, ' .
								'IF(' . PREFIX . '_policies_kasko.terms_years_id > 1, ' .
									'SUM(' . PREFIX . '_policies_kasko_item_years_payments.amount_kasko), ' .
									PREFIX . '_policy_payments_calendar.amount ' .
								') as amount, ' .
								'date_format(' . PREFIX . '_policy_payments_calendar.payment_date, \'%d.%m.%Y\') as payments_date, ' .
								'date_format(' . PREFIX . '_policy_payments_calendar.date, \'%d.%m.%Y\') as begin_datetime_format, ' .
								'date_format(' . PREFIX . '_policy_payments_calendar.end_date, \'%d.%m.%Y\') as interrupt_datetime_format, ' .
								'IF(' . PREFIX . '_policies_kasko.terms_years_id > 1, \'так\', \'ні\') as long_term, ' . PREFIX . '_policy_payments_calendar.number_part_payment as number_part_payment, ' .
								PREFIX . '_agencies.title as agencies_title, ' . PREFIX . '_regions.title as regions_title, ' . PREFIX . '_financial_institutions.title as financial_institutions_title, ' .
								PREFIX . '_policies_kasko_items.shassi, ' . PREFIX . '_policies_kasko_items.sign, ' . PREFIX . '_policy_payments_calendar.number_prolongation as prolongation_number, ' .
								PREFIX . '_policy_payments_calendar.number_insurance_year as number_insurance_year, ' . PREFIX . '_agency_types.title as agency_types_title, ' . 
								'IF(' . PREFIX . '_policy_payments_calendar.is_agr = 1, \'так\', \'ні\') as is_agr_title, ' . PREFIX . '_policy_payments_calendar.is_agr as is_agr, ' .
								'CONCAT_WS(\' \', ' . PREFIX . '_accounts.lastname, ' . PREFIX . '_accounts.firstname, ' . PREFIX . '_accounts.patronymicname) as seller, ' . PREFIX . '_policies_kasko.card_assistance as card_assistance, ' . 
								PREFIX . '_policies_kasko.financial_institutions_id as financial_institutions_id, ' . PREFIX . '_policies.agencies_id, ' . PREFIX . '_agencies.agency_types_id, ' . PREFIX . '_agencies.top as agencies_top, IF(agencies_parent.id > 0, agencies_parent.title, ' . PREFIX . '_agencies.title) as agencies_parent_title ' .
							'FROM ' . PREFIX . '_policies ' . 
							'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko.policies_id ' .
							'JOIN ' . PREFIX . '_policy_payments_calendar ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policy_payments_calendar.policies_id ' .
							'JOIN (' .
								'SELECT policies_id, MAX(date) as date ' .
								'FROM ' . PREFIX . '_policy_payments_calendar ' .
								'WHERE ' . implode(' AND ', $join_conditions) . ' AND statuses_id > 1 AND second_fifty_fifty = 0 AND valid = 1 ' .
								'GROUP BY policies_id, end_date' .
							') as last ON ' . PREFIX . '_policy_payments_calendar.policies_id = last.policies_id AND ' . PREFIX . '_policy_payments_calendar.date = last.date ' .
							'JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko_items.policies_id ' .
							'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments ON ' . PREFIX . '_policies_kasko_item_years_payments.policies_id = ' . PREFIX . '_policies.id AND ' . PREFIX . '_policy_payments_calendar.date BETWEEN ' . PREFIX . '_policies_kasko_item_years_payments.date AND ' . PREFIX .  '_policy_payments_calendar.end_date ' .
							'JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_agencies.id = ' . PREFIX . '_policies.agencies_id ' .
							'LEFT JOIN ' . PREFIX . '_agencies as agencies_parent ON ' . PREFIX . '_agencies.parent_id = agencies_parent.id ' .
							'LEFT JOIN ' . PREFIX . '_agency_types ON ' . PREFIX . '_agencies.agency_types_id = ' . PREFIX . '_agency_types.id ' .
							'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accounts.id = ' . PREFIX . '_policies.agents_id ' .
							'LEFT JOIN ' . PREFIX . '_regions ON ' . PREFIX . '_regions.id = ' . PREFIX . '_agencies.regions_id ' .
							'LEFT JOIN ' . PREFIX . '_financial_institutions ON ' . PREFIX . '_financial_institutions.id = ' . PREFIX . '_policies_kasko.financial_institutions_id ' .
							'WHERE ' . implode(' AND ', $conditions) . ' ' .
							'GROUP BY ' . $date_types_id[ $data['date_types_id'] ]['groupby'] . ' ' .
							'ORDER BY ' . $order;
					
					$list = $db->getAll($sql);
				
				} else {
				
					$conditions[] = $date_types_id[ $data['date_types_id'] ]['date'] . ' BETWEEN ' . $from . ' AND ' . $to;
			
					$sql = 'SELECT IF(' . PREFIX . '_policies.sub_number > 0, CONCAT_WS(\'-\', ' . PREFIX . '_policies.number, ' . PREFIX . '_policies.sub_number), ' . PREFIX . '_policies.number) as policies_number, ' .
								'date_format(' . PREFIX . '_policies.date, \'%d.%m.%Y\') as policies_date, ' .
								'IF(' . PREFIX . '_policies_kasko.insurer_person_types_id = 1, ' .
									'CONCAT(' . PREFIX . '_policies_kasko.insurer_lastname, \' \', ' . PREFIX . '_policies_kasko.insurer_firstname, \' \', ' . PREFIX . '_policies_kasko.insurer_patronymicname), ' .
									PREFIX . '_policies_kasko.insurer_company' .
								') AS insurer, IF(' . PREFIX . '_policies_kasko.insurer_person_types_id = 1, ' . PREFIX . '_policies_kasko.insurer_identification_code, ' . PREFIX . '_policies_kasko.insurer_edrpou) as insurer_identification, ' .
								'getInsurerAddressByPoliciesId(' . PREFIX . '_policies.id) as address, ' . PREFIX . '_policies.item as item, ' . PREFIX . '_policies_kasko.insurer_phone, ' .
								PREFIX . '_policies.price as price, ' . PREFIX . '_policies.rate as rate, ' . PREFIX . '_policy_payments_calendar.amount as amount, ' .
								'date_format(' . PREFIX . '_policy_payments_calendar.payment_date, \'%d.%m.%Y\') as payments_date, ' .
								'date_format(' . PREFIX . '_policy_payments_calendar.date, \'%d.%m.%Y\') as begin_datetime_format, ' .
								'date_format(' . PREFIX . '_policy_payments_calendar.end_date, \'%d.%m.%Y\') as interrupt_datetime_format, ' .
								'IF(' . PREFIX . '_policies_kasko.terms_years_id > 1, \'так\', \'ні\') as long_term, ' . PREFIX . '_policy_payments_calendar.number_part_payment as number_part_payment, ' .
								PREFIX . '_agencies.title as agencies_title, ' . PREFIX . '_regions.title as regions_title, ' . PREFIX . '_financial_institutions.title as financial_institutions_title, ' .
								PREFIX . '_policies_kasko_items.shassi, ' . PREFIX . '_policies_kasko_items.sign, ' . PREFIX . '_policy_payments_calendar.number_prolongation as prolongation_number, ' .
								'IF(' . PREFIX . '_policy_payments_calendar.second_fifty_fifty = 1, \'так\', \'ні\') as second_fifty_fifty_title, ' . PREFIX . '_policy_payments_calendar.second_fifty_fifty as second_fifty_fifty, ' .
								PREFIX . '_policy_payments_calendar.number_insurance_year as number_insurance_year, ' . PREFIX . '_agency_types.title as agency_types_title, ' . 
								'IF(' . PREFIX . '_policy_payments_calendar.is_agr = 1, \'так\', \'ні\') as is_agr_title, ' . PREFIX . '_policy_payments_calendar.is_agr as is_agr, ' .
								'CONCAT_WS(\' \', ' . PREFIX . '_accounts.lastname, ' . PREFIX . '_accounts.firstname, ' . PREFIX . '_accounts.patronymicname) as seller, ' . PREFIX . '_policies_kasko.card_assistance as card_assistance, ' . 
								PREFIX . '_policies_kasko.financial_institutions_id as financial_institutions_id, ' . PREFIX . '_policies.agencies_id, ' . PREFIX . '_agencies.agency_types_id, ' . PREFIX . '_agencies.top as agencies_top, IF(agencies_parent.id > 0, agencies_parent.title, ' . PREFIX . '_agencies.title) as agencies_parent_title ' .
							'FROM ' . PREFIX . '_policies ' . 
							'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko.policies_id ' .
							'JOIN ' . PREFIX . '_policy_payments_calendar ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policy_payments_calendar.policies_id AND ' . PREFIX . '_policy_payments_calendar.second_fifty_fifty = 0 AND ' . PREFIX . '_policy_payments_calendar.valid = 1 ' .
							'JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko_items.policies_id ' .
							'JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_agencies.id = ' . PREFIX . '_policies.agencies_id ' .
							'LEFT JOIN ' . PREFIX . '_agencies as agencies_parent ON ' . PREFIX . '_agencies.parent_id = agencies_parent.id ' .
							'LEFT JOIN ' . PREFIX . '_agency_types ON ' . PREFIX . '_agencies.agency_types_id = ' . PREFIX . '_agency_types.id ' .
							'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accounts.id = ' . PREFIX . '_policies.agents_id ' .
							'LEFT JOIN ' . PREFIX . '_regions ON ' . PREFIX . '_regions.id = ' . PREFIX . '_agencies.regions_id ' .
							'LEFT JOIN ' . PREFIX . '_financial_institutions ON ' . PREFIX . '_financial_institutions.id = ' . PREFIX . '_policies_kasko.financial_institutions_id ' .
							'WHERE ' . implode(' AND ', $conditions) . ' ' .
							'GROUP BY ' . $date_types_id[ $data['date_types_id'] ]['groupby'] . ' ' .
							'ORDER BY ' . $order;
					$list = $db->getAll($sql, 30 * 60);
					
				}
			}         

			if (intval($data['types_id'])) {
				$values = array();
				
				if ($data['types_id'] == 1) {
					foreach ($list as $row) {	
						$values[ $row['agency_types_id'] ]['title'] = $row['agency_types_title'];
						if (intval($row['financial_institutions_id'])) {
							if (intval($row['prolongation_number'])) {
								$values[ $row['agency_types_id'] ]['data']['bank']['prolong']['count']++;
								$values[ $row['agency_types_id'] ]['data']['bank']['prolong']['amount'] += $row['amount'];
							} elseif (intval($row['is_agr']) || intval($row['second_fifty_fifty'])) {
								$values[ $row['agency_types_id'] ]['data']['bank']['agr']['count']++;
								$values[ $row['agency_types_id'] ]['data']['bank']['agr']['amount'] += $row['amount'];
							} else {
								$values[ $row['agency_types_id'] ]['data']['bank']['new']['count']++;
								$values[ $row['agency_types_id'] ]['data']['bank']['new']['amount'] += $row['amount'];
							}
						} else {
							if (intval($row['prolongation_number'])) {
								$values[ $row['agency_types_id'] ]['data']['retail']['prolong']['count']++;
								$values[ $row['agency_types_id'] ]['data']['retail']['prolong']['amount'] += $row['amount'];
							} elseif (intval($row['is_agr']) || intval($row['second_fifty_fifty'])) {
								$values[ $row['agency_types_id'] ]['data']['retail']['agr']['count']++;
								$values[ $row['agency_types_id'] ]['data']['retail']['agr']['amount'] += $row['amount'];
							} else {
								$values[ $row['agency_types_id'] ]['data']['retail']['new']['count']++;
								$values[ $row['agency_types_id'] ]['data']['retail']['new']['amount'] += $row['amount'];
							}
						}
					}
				}
				if ($data['types_id'] == 2) {
					$sql = 'SELECT * FROM ' . PREFIX . '_agencies_report ORDER BY order_position';
					$res =	$db->query($sql);
					while ($res->fetchInto($row)) {
						$values[ $row['id'] ]['title']  = $row['title'];
					}
					
					foreach ($list as $row) {		
						if (intval($row['financial_institutions_id'])) {
							if (intval($row['prolongation_number'])) {
								$values[ $row['agencies_top'] ]['data']['bank']['prolong']['count']++;
								$values[ $row['agencies_top'] ]['data']['bank']['prolong']['amount'] += $row['amount'];
							} elseif (intval($row['is_agr']) || intval($row['second_fifty_fifty'])) {
								$values[ $row['agencies_top'] ]['data']['bank']['agr']['count']++;
								$values[ $row['agencies_top'] ]['data']['bank']['agr']['amount'] += $row['amount'];
							} else {
								$values[ $row['agencies_top'] ]['data']['bank']['new']['count']++;
								$values[ $row['agencies_top'] ]['data']['bank']['new']['amount'] += $row['amount'];
							}
						} else {
							if (intval($row['prolongation_number'])) {
								$values[ $row['agencies_top'] ]['data']['retail']['prolong']['count']++;
								$values[ $row['agencies_top'] ]['data']['retail']['prolong']['amount'] += $row['amount'];
							} elseif (intval($row['is_agr']) || intval($row['second_fifty_fifty'])) {
								$values[ $row['agencies_top'] ]['data']['retail']['agr']['count']++;
								$values[ $row['agencies_top'] ]['data']['retail']['agr']['amount'] += $row['amount'];
							} else {
								$values[ $row['agencies_top'] ]['data']['retail']['new']['count']++;
								$values[ $row['agencies_top'] ]['data']['retail']['new']['amount'] += $row['amount'];
							}
						}
					}
				}
				if ($data['types_id'] == 3) {
					foreach ($list as $row) {
						if (!intval($row['financial_institutions_id'])) continue;
						$values[ $row['financial_institutions_id'] ]['title'] = $row['financial_institutions_title'];
						if (intval($row['financial_institutions_id'])) {
							if (intval($row['prolongation_number'])) {
								$values[ $row['financial_institutions_id'] ]['data']['bank']['prolong']['count']++;
								$values[ $row['financial_institutions_id'] ]['data']['bank']['prolong']['amount'] += $row['amount'];
							} elseif (intval($row['is_agr']) || intval($row['second_fifty_fifty'])) {
								$values[ $row['financial_institutions_id'] ]['data']['bank']['agr']['count']++;
								$values[ $row['financial_institutions_id'] ]['data']['bank']['agr']['amount'] += $row['amount'];
							} else {
								$values[ $row['financial_institutions_id'] ]['data']['bank']['new']['count']++;
								$values[ $row['financial_institutions_id'] ]['data']['bank']['new']['amount'] += $row['amount'];
							}
						} 
					}
				}
			}

            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/getInsurancePeriodsExcel.php';
        } else {

            $sql =  'SELECT id, title ' .
                    'FROM ' . PREFIX . '_product_types ' .
                    'WHERE level = 2 AND id NOT IN (9, 11) ' .
                    'ORDER BY title';
            $product_types = $db->getAll($sql);

            $sql =	'SELECT id, code, title, level ' .
                    'FROM ' . PREFIX . '_agencies ' .
                    'WHERE parent_id = 0';
            $agencies = $db->getAll($sql, 60 * 60);

            $sql =	'SELECT id, title ' .
                    'FROM ' . PREFIX . '_financial_institutions ' .
                    'ORDER BY title';
            $financial_institutions = $db->getAll($sql, 30 * 60);
			
			$sql =	'SELECT id, title ' .
                    'FROM ' . PREFIX . '_agency_types ' .
                    'ORDER BY title';
            $agency_types = $db->getAll($sql, 30 * 60);

            include_once $this->object . '/getInsurancePeriods.php';
        }
        exit;
	}
	
	function getSalesInOutFlows($data) {
        global $db;

        if ($data['InWindow']) {
		
			require 'scripts/new_set.php';

            if (intval($data['product_types_id'])) {
                $conditions[] = PREFIX . '_policies.product_types_id = ' . intval($data['product_types_id']);
            }

            if (intval($data['agencies_id'])) {
                $conditions[] = PREFIX . '_policies.agencies_id = ' . intval($data['agencies_id']);
            }

            if (!$data['from']) {
                $data['from'] = date('d.m.Y');
            }

            if (!$data['to']) {
                $data['to'] = date('d.m.Y');
            }

            $from	= $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
            $to		= $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');

            $conditions[] = PREFIX . '_policy_payments.datetime BETWEEN ' . $from . ' AND ' . $to;

            $sql =  'SELECT date_format(' . PREFIX . '_policy_payments.datetime, ' . $db->quote(DATE_FORMAT) . ') AS policy_payments_datetime, ' . PREFIX . '_policy_payments.amount AS policy_payments_amount, ' .

                    PREFIX . '_policy_payments_policy_payments_calendar.amount AS policy_payments_policy_payments_calendar_amount,  ' .

                    PREFIX . '_product_types.title AS product_types_title, ' .

                    PREFIX . '_policies.number AS policies_number, date_format(' . PREFIX . '_policies.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date, ' . PREFIX . '_policies.insurer AS policies_insurer, ' . PREFIX . '_policies.item AS policies_item, ' .
					'IF(LOCATE(\'/\', ' . PREFIX . '_policies.item) = 0, ' . PREFIX . '_policies.item, SUBSTRING(' . PREFIX . '_policies.item, 1, LOCATE(\'/\', ' . PREFIX . '_policies.item) - 1)) as brand, ' .

                    PREFIX . '_agencies.title AS agencies_title, ' .

                    PREFIX . '_agency_types.title AS agency_types_title, ' .

                    'date_format(' . PREFIX . '_policy_payments_calendar.date, ' . $db->quote(DATE_FORMAT) . ') AS policy_payments_calendar_date, date_format(' . PREFIX . '_policy_payments_calendar.end_date, ' . $db->quote(DATE_FORMAT) . ') AS policy_payments_calendar_end_date, ' .
                    PREFIX . '_policy_payments_calendar.amount AS policy_payments_calendar_amount, date_format(' . PREFIX . '_policy_payments_calendar.payment_date, ' . $db->quote(DATE_FORMAT) . ') AS policy_payments_calendar_payment_date, ' .
					PREFIX . '_payment_statuses.title as payment_statuses_title, ' .
                    PREFIX . '_policy_payments_calendar.number_prolongation AS policy_payments_calendar_number_prolongation, ' . PREFIX . '_policy_payments_calendar.number_insurance_year AS policy_payments_calendar_number_insurance_year, ' .
					'IF(' . PREFIX . '_policy_payments_calendar.is_agr = 1, \'так\', \'ні\') as is_agr_title, ' .
					
					'IF(' . PREFIX . '_policy_payments_calendar.second_fifty_fifty = 1, \'так\', \'ні\') AS second_fifty_fifty, ' .

                    PREFIX . '_financial_institutions.title AS financial_institutions_title, ' .

					PREFIX . '_policy_payments_policy_payments_calendar.policy_payments_id as payments_id ' .

                    'FROM ' . PREFIX . '_policy_payments ' .
                    'JOIN ' . PREFIX . '_policy_payments_policy_payments_calendar ON ' . PREFIX . '_policy_payments.id = ' . PREFIX . '_policy_payments_policy_payments_calendar.policy_payments_id ' .
                    'JOIN ' . PREFIX . '_policy_payments_calendar ON ' . PREFIX . '_policy_payments_policy_payments_calendar.policy_payments_calendar_id = ' . PREFIX . '_policy_payments_calendar.id ' .
                    'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_policy_payments_calendar.statuses_id = ' . PREFIX . '_payment_statuses.id ' .
                    'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policy_payments_calendar.policies_id = ' . PREFIX . '_policies.id ' .
                    'JOIN ' . PREFIX . '_product_types ON ' . PREFIX . '_policies.product_types_id = ' . PREFIX . '_product_types.id ' .
                    'JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_policies.agencies_id = ' . PREFIX . '_agencies.id ' .
                    'JOIN ' . PREFIX . '_agency_types ON ' . PREFIX . '_agencies.agency_types_id = ' . PREFIX . '_agency_types.id ' .
                    'LEFT JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko.policies_id OR ISNULL(' . PREFIX . '_policies_kasko.policies_id) ' .
                    'LEFT JOIN ' . PREFIX . '_financial_institutions ON ' . PREFIX . '_policies_kasko.financial_institutions_id = ' . PREFIX . '_financial_institutions.id ' .

                    'WHERE ' . implode(' AND ', $conditions);
            $list = $db->getAll($sql, 30 * 60);

            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/InOutFlowsExcel.php';
        } else {

            $sql =  'SELECT id, title ' .
                    'FROM ' . PREFIX . '_product_types ' .
                    'WHERE level = 2 AND id NOT IN (9, 11) ' .
                    'ORDER BY title';
            $product_types = $db->getAll($sql);

            $sql =	'SELECT id, code, title, level ' .
                    'FROM ' . PREFIX . '_agencies ' .
                    'WHERE parent_id = 0';
            $agencies = $db->getAll($sql, 60 * 60);

            $sql =	'SELECT id, title ' .
                    'FROM ' . PREFIX . '_financial_institutions ' .
                    'ORDER BY title';
            $financial_institutions = $db->getAll($sql, 30 * 60);

            include_once $this->object . '/InOutFlows.php';
        }
        exit;
    }
	
	
	function getTermsInsuranceAccidents($data) {
        global $db;

        if ($data['InWindow']) {

            if (intval($data['product_types_id'])) {
                $conditions[] = 'accidents.product_types_id = ' . intval($data['product_types_id']);
            }

            if (!$data['from']) {
                $data['from'] = date('d.m.Y');
            }

            if (!$data['to']) {
                $data['to'] = date('d.m.Y');
            }

            $from	= $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
            $to		= $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');

            $sql = 'SELECT COUNT(investigated.accidents_id) as investigated_count, SUM(UNIX_TIMESTAMP(investigated.date) - UNIX_TIMESTAMP(accidents.created)) as investigated_term ' .						
					'FROM ' . PREFIX . '_accidents as accidents ' .
					'JOIN (' .
						'SELECT accidents_id, MIN(created) as date ' .
						'FROM ' . PREFIX . '_accident_status_changes ' .
						'WHERE accident_statuses_id = ' . ACCIDENT_STATUSES_INVESTIGATION .  ' ' .
						'GROUP BY accidents_id' .
					') as investigated ON accidents.id = investigated.accidents_id ' .
					'WHERE investigated.date BETWEEN ' . $from . ' AND ' . $to . ' AND ' . implode(' AND ', $conditions);
			$values['investigated_created'] = $db->getRow($sql);
			
			$sql = 'SELECT COUNT(approval.accidents_id) as approval_count, SUM(UNIX_TIMESTAMP(approval.date) - UNIX_TIMESTAMP(accidents.created)) as approval_created_term, SUM(UNIX_TIMESTAMP(approval.date) - UNIX_TIMESTAMP(approval.created)) as approval_acts_term ' .
					'FROM ' . PREFIX . '_accidents as accidents ' .
					'JOIN (' .
						'SELECT accidents.id as accidents_id, accidents_acts.date as date, accidents_acts.created as created ' .
						'FROM ' . PREFIX . '_accidents as accidents ' .
						'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id AND CONCAT_WS(\'-\', accidents.number, 1) = accidents_acts.number ' .
						'WHERE accidents_acts.act_statuses_id NOT IN (' . ACCIDENT_STATUSES_INVESTIGATION . ', ' . ACCIDENT_STATUSES_COORDINATION . ')' .
					') as approval ON accidents.id = approval.accidents_id ' .
					'WHERE approval.date BETWEEN ' . $from . ' AND ' . $to . ' AND ' . implode(' AND ', $conditions); 
			$values['approval'] = $db->getRow($sql);
			
			$sql = 'SELECT COUNT(payment.accidents_id) as payment_count, 
							SUM(UNIX_TIMESTAMP(payment.date) - UNIX_TIMESTAMP(accidents.created)) as payment_created_term, 
							SUM(UNIX_TIMESTAMP(payment.date) - UNIX_TIMESTAMP(payment.acts_date)) as payment_approval_term ' .
					'FROM ' . PREFIX . '_accidents as accidents ' .
					'JOIN (' .
						'SELECT accidents.id as accidents_id, MAX(accident_payments_calendar.payment_date) as date, accidents_acts.date as acts_date ' .
						'FROM ' . PREFIX . '_accidents as accidents ' .
						'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id AND CONCAT_WS(\'-\', accidents.number, 1) = accidents_acts.number ' .
						'JOIN ' . PREFIX . '_accident_payments_calendar as accident_payments_calendar ON accidents_acts.id = accident_payments_calendar.acts_id ' .
						'GROUP BY accidents_id' .
					') as payment ON accidents.id = payment.accidents_id ' .
					'WHERE payment.date BETWEEN ' . $from . ' AND ' . $to . ' AND ' . implode(' AND ', $conditions); 
			$values['payment'] = $db->getRow($sql);
			
			$sql = 'SELECT COUNT(created_acts.accidents_id) as created_acts_count, SUM(UNIX_TIMESTAMP(created_acts.date) - UNIX_TIMESTAMP(getMinSetAccidentsStatusesDate(accidents.id, ' . ACCIDENT_STATUSES_INVESTIGATION . '))) as created_acts_term ' .
					'FROM ' . PREFIX . '_accidents as accidents ' .
					'JOIN (' .
						'SELECT accidents_id, MIN(created) as date ' .
						'FROM ' . PREFIX . '_accidents_acts ' .
						'GROUP BY accidents_id' .
					') as created_acts ON accidents.id = created_acts.accidents_id ' .
					'WHERE created_acts.date BETWEEN ' . $from . ' AND ' . $to . ' AND ' . implode(' AND ', $conditions);
			$values['created_acts'] = $db->getRow($sql);

            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/Accidents/getTermsInsuranceAccidentsExcel.php';
        } else {
            include_once $this->object . '/Accidents/getTermsInsuranceAccidents.php';
        }
        exit;
    }
	
	function getCarServicesCalculationByAccidentMessages($data) {
		global $db;

		if ($data['InWindow']) {
			$conditions = array('1');
			$conditions[] = 'accident_messages.message_types_id IN(' . ACCIDENT_MESSAGE_TYPES_CALCULATION . ')';
			$conditions[] = 'accident_messages.statuses_id IN(' . ACCIDENT_MESSAGE_STATUSES_ANSWER . ')';
		
			if ($data['fromCreated']) {
				$conditions[] = 'accident_messages.created >= ' . $db->quote(substr($data['fromCreated'], 6, 4) .'-'. substr($data['fromCreated'], 3, 2) .'-'. substr($data['fromCreated'], 0, 2) . ' 00:00:00');
			}
			if ($data['toCreated']) {
				$conditions[] = 'accident_messages.created <= ' . $db->quote(substr($data['toCreated'], 6, 4) .'-'. substr($data['toCreated'], 3, 2) .'-'. substr($data['toCreated'], 0, 2) . ' 23:59:59');
			}
			
			if ($data['fromDecision']) {
				$conditions[] = 'accident_messages.decision >= ' . $db->quote(substr($data['fromDecision'], 6, 4) .'-'. substr($data['fromDecision'], 3, 2) .'-'. substr($data['fromDecision'], 0, 2) . ' 00:00:00');
			}
			if ($data['toDecision']) {
				$conditions[] = 'accident_messages.decision <= ' . $db->quote(substr($data['toDecision'], 6, 4) .'-'. substr($data['toDecision'], 3, 2) .'-'. substr($data['toDecision'], 0, 2) . ' 23:59:59');
			}
			
			//спочатку вибираємо перелік задач по даті створення і рішення
			$sql = 'SELECT id, accidents_id, answer, created, decision ' .
				   'FROM ' . PREFIX . '_accident_messages as accident_messages ' .
				   'WHERE ' . implode(' AND ', $conditions);
			$accident_messages = $db->getAll($sql);
			
			//тимчасова таблиця з розпарсеним полем answer
			$sql = 'CREATE TABLE IF NOT EXISTS accident_messages_temp ' .
						'(' .
							'id INT, accidents_id INT, start DATE, end DATE, car_services_id INT, repair_classifications_id INT, repair_parts INT, repair_parts_delivery_days INT, market_price DECIMAL(10,2), amount_residual DECIMAL(10,2), first_repair_amount DECIMAL(10,2), ' .
							'deterioration_value DECIMAL(10, 4), amount_details DECIMAL(10,2), amount_material DECIMAL(10,2), amount_work DECIMAL(10,2), comment VARCHAR(200), created DATE, decision DATE, KEY accidents_id (`accidents_id`), KEY car_services_id (`car_services_id`)' .
						')';
			$db->query($sql);
			
			$values_array = array();
			foreach ($accident_messages as $accident_message) {
				$answer = unserialize($accident_message['answer']);
				$values_array[] = '(' . intval($accident_message['id']) . ', ' . 
										intval($accident_message['accidents_id']) . ', ' . 
										($answer['account_request_date'] ? $db->quote($answer['account_request_date']) : $db->quote('0000-00-00')) . ', ' . 
										($answer['account_answer_date'] ? $db->quote($answer['account_answer_date']) : $db->quote('0000-00-00')) . ', ' .
										intval($answer['result_calculation_car_services_id']) . ', ' .
										intval($answer['repair_classifications_id']) . ', ' .
										($answer['repair_parts'] == 'on' ? 1 : 0) . ', ' .
										intval($answer['repair_parts_delivery_days']) . ', ' .
										$db->quote($answer['market_price']) . ', ' .
										$db->quote($answer['amount_residual']) . ', ' .
										$db->quote($answer['first_repair_amount']) . ', ' .
										$db->quote($answer['deterioration_value']) . ', ' .
										$db->quote($answer['amount_details']) . ', ' .
										$db->quote($answer['amount_material']) . ', ' .
										$db->quote($answer['amount_work']) . ', ' .
										$db->quote($answer['comment']) . ', ' .
										$db->quote($accident_message['created']) . ', ' .
										$db->quote($accident_message['decision']) .
									')';
			}
			
			if (sizeOf($values_array)) {
				$sql = 'INSERT INTO accident_messages_temp VALUES ' . implode(', ', $values_array);
				$db->query($sql);
			}

			$conditions = array('1');
			
			if ($data['fromAccountRequestDate']) {
				$conditions[] = 'amt.start >= ' . $db->quote(substr($data['fromAccountRequestDate'], 6, 4) .'-'. substr($data['fromAccountRequestDate'], 3, 2) .'-'. substr($data['fromAccountRequestDate'], 0, 2) . ' 00:00:00');
			}
			if ($data['toAccountRequestDate']) {
				$conditions[] = 'amt.start <= ' . $db->quote(substr($data['toAccountRequestDate'], 6, 4) .'-'. substr($data['toAccountRequestDate'], 3, 2) .'-'. substr($data['toAccountRequestDate'], 0, 2) . ' 23:59:59');
			}
			
			if ($data['fromAccountAnswerDate']) {
				$conditions[] = 'amt.end >= ' . $db->quote(substr($data['fromAccountAnswerDate'], 6, 4) .'-'. substr($data['fromAccountAnswerDate'], 3, 2) .'-'. substr($data['fromAccountAnswerDate'], 0, 2) . ' 00:00:00');
			}
			if ($data['toAccountAnswerDate']) {
				$conditions[] = 'amt.end <= ' . $db->quote(substr($data['toAccountAnswerDate'], 6, 4) .'-'. substr($data['toAccountAnswerDate'], 3, 2) .'-'. substr($data['toAccountAnswerDate'], 0, 2) . ' 23:59:59');
			}
			
			if (intval($data['car_services_id'])) {
				$conditions[] = 'amt.car_services_id = ' . intval($data['car_services_id']);
			}
			
			$sql = 'SELECT accidents.number as accidents_number, policies.insurer as insurer, application_car_services.title as application_car_services_title, policies.number as policies_number, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', CONCAT_WS(\'/\', policies_kasko_items.brand, policies_kasko_items.model), CONCAT_WS(\'/\', policies_go.brand, policies_go.model)) as item, ' .
						'IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', policies_kasko_items.sign, policies_go.sign) as sign, IF(accidents.product_types_id = ' . PRODUCT_TYPES_KASKO . ', policies_kasko_items.shassi, policies_go.shassi) as shassi, ' .
						'date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_datetime, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, amt.repair_classifications_id as repair_classifications_id, IF(amt.repair_parts = 1, \'так\', \'ні\') as repair_parts, ' .
						'amt.repair_parts_delivery_days as repair_parts_delivery_days, date_format(amt.created, \'%d.%m.%Y\') as accident_messages_created, date_format(amt.decision, \'%d.%m.%Y\') as accident_messages_decision, ' .
						'getDateOrDaysWithoutWeekEnds(amt.created, amt.decision, NULL) as decision_duration, date_format(amt.start, \'%d.%m.%Y\') as account_request_date, date_format(amt.end, \'%d.%m.%Y\') as account_answer_date, ' .
						'getDateOrDaysWithoutWeekEnds(amt.start, amt.end, NULL) as request_duration, amt.market_price as market_price, amt.amount_residual as amount_residual, amt.first_repair_amount as first_repair_amount, amt.deterioration_value as deterioration_value, ' .
						'calculation_car_services.title as calculation_car_services_title, (amt.amount_details + amt.amount_material + amt.amount_work) as amount_total, amt.comment as comment, ' .
						'CONCAT_WS(\' \', accounts_average_manager.lastname, accounts_average_manager.firstname) as avarage_manager, CONCAT_WS(\' \', accounts_estimate_manager.lastname, accounts_estimate_manager.firstname) as estimate_manager ' .
				   'FROM accident_messages_temp as amt ' .
				   'JOIN ' . PREFIX . '_accidents as accidents ON amt.accidents_id = accidents.id ' .
				   'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'LEFT JOIN ' . PREFIX . '_policies_kasko_items as policies_kasko_items ON accidents_kasko.items_id = policies_kasko_items.id ' .
				   'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id ' .
				   'LEFT JOIN ' . PREFIX . '_accounts as accounts_average_manager ON accidents.average_managers_id = accounts_average_manager.id ' .
				   'LEFT JOIN ' . PREFIX . '_accounts as accounts_estimate_manager ON accidents.estimate_managers_id = accounts_estimate_manager.id ' .
				   'LEFT JOIN ' . PREFIX . '_car_services as application_car_services ON accidents.car_services_id = application_car_services.id ' .
				   'LEFT JOIN ' . PREFIX . '_car_services as calculation_car_services ON amt.car_services_id = calculation_car_services.id ' .
				   'WHERE ' . implode(' AND ', $conditions);
			$list = $db->getAll($sql);
			
			$sql = 'DROP TABLE accident_messages_temp';
			$db->query($sql);
		
			header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));
		
			include_once $this->object . '/Accidents/getCarServicesCalculationByAccidentMessagesExcel.php';
		} else {
			include_once $this->object . '/Accidents/getCarServicesCalculationByAccidentMessages.php';
		}
	}
}

?>
