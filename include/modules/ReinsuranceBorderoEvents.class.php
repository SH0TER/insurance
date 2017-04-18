<?
/*
 * Title: reinsurance KASKO bordero events class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ReinsuranceBorderoEvents extends Form {

    var $formDescription =
            array(
                'fields'     =>
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
							'table'				=> 'reinsurance_bordero_events'),
						array(
							'name'				=> 'number',
							'description'		=> 'Бордеро',
					        'type'				=> fldUnique,
					        'maxlength'			=> 20,
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
							'table'				=> 'reinsurance_bordero_events'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата',
					        'type'				=> fldDate,
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
							'orderPosition'		=> 2,
							'table'				=> 'reinsurance_bordero_events'),
						array(
							'name'				=> 'agreements_id',
							'description'		=> 'Договір',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> false,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 3,
							'table'				=> 'reinsurance_bordero_events',
							'sourceTable'		=> 'reinsurance_agreements',
							'selectField'		=> 'number',
							'orderField'		=> 'number'),
						array(
							'name'				=> 'file',
							'description'		=> 'Файл',
					        'type'				=> fldFile,
							'format'			=> '.*\.(jpg|jpeg|gif|png|doc|xls|zip|pdf)$',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 4,
							'table'				=> 'reinsurance_bordero_events'),	
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
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
                            'table'             => 'reinsurance_bordero_events'),
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
                            'orderPosition'     => 5,
                            'width'             => 100,
                            'table'             => 'reinsurance_bordero_events')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 5,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
            );

    function ReinsuranceBorderoEvents($data) {
        Form::Form($data);

        $this->messages['plural'] = 'КАСКО, бордеро збитків';
        $this->messages['single'] = 'КАСКО, бордеро збитків';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
					'export'    => true,
                    'delete'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ 'ReinsuranceAgreements' ];
				break;
        }
    }

	function getItems($id) {
		global $db;

		$sql =	'SELECT e.number AS policiesNumber, date_format(e.date, ' . $db->quote(DATE_FORMAT) . ') AS policiesDate, IF(insurer_person_types_id = 1, CONCAT(insurer_lastname, \' \', SUBSTRING(insurer_firstname, 1, 1), \'.\', SUBSTRING(insurer_patronymicname, 1, 1), \'.\'), insurer_company) AS policiesInsurer, ' .
				'CONCAT(c.brand, \'/\', c.model) AS item, c.shassi, c.sign, date_format(e.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policiesbegin_datetime, date_format(e.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policiesinterrupt_datetime, ' .
				'c.car_price + c.price_equipment AS itemsPrice, GROUP_CONCAT(i.risks_id ORDER BY risks_id ASC SEPARATOR \', \') AS risks, c.year, c.deductibles_value0, c.deductibles_value1, ' .
				'c.car_price + c.price_equipment - SUM(j.price) AS insurerPrice, b.price, b.rate, round( (c.car_price + c.price_equipment) / b.price * b.rate / 100, 2) AS totalAmount, b.amount, ' .
				'date_format( getPolicyPaymentsCalendarNextDate(f.id), ' . $db->quote(DATE_FORMAT) . ') AS nextPaymentDate, ROUND( getPolicyPaymentsCalendarNextAmount(f.id) / e.amount * (c.car_price + c.price_equipment) * b.rate/100 * a.share/100, 2) AS nextPaymentAmount, ' .
				'd.options_deterioration_no AS policiesOptionsDeteriorationNo ' .
				'FROM ' . PREFIX . '_reinsurance_bordero_premiums AS a ' .
				'JOIN ' . PREFIX . '_reinsurance_bordero_premiums_items AS b ON a.id = b.reinsurance_bordero_premiums_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS c ON b.items_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_kasko AS d ON c.policies_id = d.policies_id ' .
				'JOIN ' . PREFIX . '_policies AS e ON c.policies_id = e.id ' .
				'JOIN ' . PREFIX . '_policy_payments_calendar AS f ON c.policies_id = f.policies_id AND b.policy_payments_calendar_id = f.id ' .
				'JOIN ' . PREFIX . '_reinsurance_bordero_premiums_item_risks AS i ON b.id = i.reinsurance_items_id ' .
				'LEFT JOIN ' . PREFIX . '_reinsurance_bordero_premiums_items AS j ON b.policy_payments_calendar_id = j.policy_payments_calendar_id AND b.id <> j.id ' .
				'WHERE a.id = ' . intval($id) . ' ' .
				'GROUP BY b.id';
		return $db->getAll($sql);
	}

	function showForm($data, $action, $actionType=null, $template=null) {
		global $db;

		$data['agreements_id'] = $data['id'];

		if ($action == 'view') {
			$data['list'] = $this->getItems($data['id']);
		}

        return parent::showForm($data, $action, $actionType, 'form.php');
    }

	function setConstants(&$data) {
        $agreement = ReinsuranceAgreements::get($data['agreements_id']);

		$data['number']					= $agreement['number'] . '-' . date('y/m', mktime(0, 0, 0, $data['date_month']-1, $data['date_day'], $data['date_year']));
		$data['payment_statuses_id']	= PAYMENT_STATUSES_NOT;
		$data['file']					= 1;

		$this->formDescription['fields'][ $this->getFieldPositionByName('file') ]['type'] = fldText;

		parent::setConstants($data);
    }

	function getItemsToProcess($date, $financial_institutions_id, $itemsPrice, $agreements_id) {
		global $db;

		$conditions[] = 'a.interrupt_datetime > ' . $db->quote($date);
		$conditions[] = 'b.financial_institutions_id IN(' . implode(', ', $financial_institutions_id) . ')';
		$conditions[] = 'c.car_price + c.price_equipment >= ' . doubleval($itemsPrice);
		$conditions[] = 'd.statuses_id IN(' . PAYMENT_STATUSES_PAYED . ', ' . PAYMENT_STATUSES_OVER . ')';

		//выбрасываем уже перестрахованные
		$conditions[] = 'd.id NOT IN(' .
							'SELECT policy_payments_calendar_id ' .
							'FROM ' . PREFIX . '_reinsurance_bordero_premiums AS k1 ' .
							'JOIN ' . PREFIX . '_reinsurance_bordero_premiums_items AS k2 ON k1.id = k2.reinsurance_bordero_premiums_id ' .
							'WHERE k1.agreements_id = ' . intval($agreements_id) . ')';

		$sql =	'SELECT a.id, a.product_types_id, a.number AS policiesNumber, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') AS policiesDate, date_format(d.payment_date, ' . $db->quote(DATE_FORMAT) . ') AS payment_date, ' .
				'IF(insurer_person_types_id = 1, CONCAT(insurer_lastname, \' \', SUBSTRING(insurer_firstname, 1, 1), \'.\', SUBSTRING(insurer_patronymicname, 1, 1), \'.\'), insurer_company) AS policiesInsurer, ' .
				'c.id AS items_id, CONCAT(c.brand, \'/\', c.model) AS item, c.shassi, c.sign, ' .
				'date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policiesbegin_datetime, date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policiesinterrupt_datetime, ' .
				'c.car_price + c.price_equipment AS itemsPrice, ' .
				'getPolicyRisksIds(a.id) AS policyRisksIds, ' .
				'c.year, c.deductibles_value1, c.deductibles_value0, c.car_price + c.price_equipment - SUM(e.price) AS insurerPrice, ' .
				'b.options_deterioration_no, b.assured_title, ' .
				'GROUP_CONCAT(f.number ORDER BY f.number ASC SEPARATOR \'<br />\') AS borderoNumbers, ' .
				'd.id AS policy_payments_calendar_id, c.car_types_id, h.sng ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.id = c.policies_id ' .
				'JOIN ' . PREFIX . '_policy_payments_calendar AS d ON a.id = d.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_reinsurance_bordero_premiums_items AS e ON c.id = e.items_id AND d.id = e.policy_payments_calendar_id ' .
				'JOIN ' . PREFIX . '_reinsurance_bordero_premiums AS f ON e.reinsurance_bordero_premiums_id = f.id ' .
				'JOIN ' . PREFIX . '_car_brands AS h ON c.brands_id = h.id ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'GROUP BY c.id, d.id';

		return $db->getAll($sql);
	}

	function loadItemsInWindow($data) {
		$share = ReinsuranceAgreements::getShare($data['agreements_id']);

		$list = $this->getItemsToProcess($data['date'], $data['financial_institutions_id'], $data['itemsPrice'], $data['agreements_id']);

		include_once $this->object . '/itemsInWindow.php'; 
	}

	function setAdditionalFields($data) {
		global $db;

		//вытаскиваем объекты к перестрахованию
		$list = $this->getItemsToProcess($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'], $data['financial_institutions_id'], $data['itemsPrice'], $data['agreements_id']);

		$agreementRisks = ReinsuranceAgreements::getRisks($data['agreements_id']);

		foreach ($list as $row) {

			$policyRisksIds = explode(',', $row['policyRisksIds']);

			//получаем тариф
			$sql =	'SELECT ' . (in_array(RISKS_HIJACKING1, $policyRisksIds) ? 'value_hijacking' : 'value_other') . ' AS rate ' .
					'FROM ' . PREFIX . '_reinsurance_agreement_deductibles ' . 
				  	'WHERE value0 >= ' . $row['deductibles_value0'] . ' AND value1 >= ' . $row['deductibles_value1'] . ' AND agreements_id = ' . intval($data['agreements_id']) . ' AND sng = ' . $row['sng'] . ' AND car_types_id = ' . $row['car_types_id'] . ' ' .
					'ORDER BY value0, value1 ' .
					'LIMIT 1';
			$rate = $db->getOne($sql, 30 * 60);

			//корректируем тариф, если по договору перестрахования тариф зависит от набора рисков
			if (is_array($agreementRisks) && sizeOf($agreementRisks) > 0) {
				$total = 0;
				foreach ($agreementRisks as $risk) {
					if (in_array($risk['risks_id'], $policyRisksIds)) {
						$total += $risk['value'];
					}
				}

				$rate = $rate * $total / 100;
			}

			//если машина застрахована без износа, корректируем тариф
			if (intval($row['options_deterioration_no'])) {//задействуем таблицу по годам
				$rate = $rate * ReinsuranceAgreementCarYears::getValue($data['agreements_id'], $row['car_types_id'], $row['year']);
			}

			//сохраняем объекты
			$sql =	'INSERT INTO ' . PREFIX . '_reinsurance_bordero_premiums_items SET ' . 
				 	'reinsurance_bordero_premiums_id = ' . $data['id'] . ', ' .
				 	'policies_id = ' . $row['id'] . ', ' .
				 	'items_id = ' . $row['items_id'] . ', ' .
				 	'policy_payments_calendar_id = ' . $row['policy_payments_calendar_id'] . ', ' .
				 	'risks = ' . $db->quote($row['policyRisksIds']) . ', ' .
				 	'rate = ' . $db->quote( round($rate, 2) ) . ', ' .
				 	'price = ' . $db->quote ( round( $row['itemsPrice'] * $data['share'] / 100, 2) ) . ', ' .
				 	'amount = ' . $db->quote( round( $row['payments_calendarAmount'] / $row['policiesAmount'] * $row['itemsPrice'] * $rate / 100 * $data['share'] / 100, 2) );
			$db->query($sql);

			$id = mysql_insert_id();

			//сохраняем риски перестрахованные по объекту
			foreach ($policyRisksIds as $risks_id) {
				$sql =	'INSERT INTO ' . PREFIX . '_reinsurance_bordero_premiums_item_risks SET ' .
					  	'reinsurance_items_id = ' . $id . ', ' .
					  	'risks_id = ' . $risks_id;
				$db->query($sql);
			}
		}
	}

	function insert($data, $redirect=true) {
		global $Log;

		$data['id'] = parent::insert(&$data, false);

		if ($data['id']) {

			$this->setAdditionalFields($data);

			if ($redirect) {
				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $data['id'];
			}
		}
	}

	function downloadFileInWindow($data) {
		global $db, $Smarty;

		$file = unserialize($data['file']);

		$data['id'] = $file['id'];

		$sql =	'SELECT a.number, a.date, b.insurance_companies_id, b.number AS agreementsNumber, b.date AS agreementsDate ' .
				'FROM ' . PREFIX . '_reinsurance_bordero_premiums AS a ' .
				'JOIN ' . PREFIX . '_reinsurance_agreements AS b ON a.agreements_id = b.id ' .
				'WHERE a.id = ' . intval($data['id']);
		$agreement = $db->getRow($sql);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_companies ' .
				'WHERE id = ' . intval($agreement['insurance_companies_id']);
		$company = $db->getRow($sql);
        
		$Smarty->assign('company', $company);
		$Smarty->assign('agreement', $agreement);
		$Smarty->assign('list', $this->getItems($data['id']));

		$file['name']		= $agreement['number'];
        $file['content']	= $Smarty->fetch($this->object . '/bordero.tpl');

        html2pdf($file, array('--orientation' => 'Landscape'));
        exit;
	}

	function exportInWindow($data) {
        global $db, $Smarty;

		if (is_array($data['id'])) $data['id'] = $data['id'][0];

		$data['list'] = $this->getItems($data['id']); 

		header('Content-Disposition: attachment; filename="bordero.xls"');
        header('Content-Type: ' . Form::getContentType('bordero.xls'));

		include_once $this->object . '/borderoExcel.php'; 
		exit;
	}	
}

?>