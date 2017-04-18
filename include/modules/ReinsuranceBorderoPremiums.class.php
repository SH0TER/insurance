<?
/*
 * Title: reinsurance KASKO bordero premiums class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ReinsuranceAgreements.class.php';

class ReinsuranceBorderoPremiums extends Form {

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
							'table'				=> 'reinsurance_bordero_premiums'),
							
						array(
							'name'				=> 'number',
							'description'		=> 'Номер',
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
							'table'				=> 'reinsurance_bordero_premiums'),
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
							'table'				=> 'reinsurance_bordero_premiums'),
						 array(
                            'name'              => 'share',
                            'description'       => 'Відповідальність перестраховика, %',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'reinsurance_bordero_premiums'),
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
							'table'				=> 'reinsurance_bordero_premiums',
							'sourceTable'		=> 'reinsurance_agreements',
							'selectField'		=> 'number',
							'orderField'		=> 'number'),
                        array(
                            'name'              => 'payment_statuses_id',
                            'description'       => 'Оплата',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'reinsurance_bordero_premiums',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
							'orderPosition'		=> 5,
							'table'				=> 'reinsurance_bordero_premiums'),
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
                            'table'             => 'reinsurance_bordero_premiums'),
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
                            'orderPosition'     => 6,
                            'width'             => 100,
                            'table'             => 'reinsurance_bordero_premiums')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 6,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
            );

    function ReinsuranceBorderoPremiums($data) {
        Form::Form($data);

        $this->messages['plural'] = 'КАСКО, бордеро премiй';
        $this->messages['single'] = 'КАСКО, бордеро премiй';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => false,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true,
					'export'	=> true);
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
				'c.car_price + c.price_equipment AS itemsPrice, i.policyRisks, c.year, c.deductibles_value0, c.deductibles_value1, ' .
				'c.car_price + c.price_equipment - SUM(j.price) AS insurerPrice, b.price, b.rate, round( b.price * b.rate / 100, 2) AS totalAmount, b.amount, ' .
				'date_format( getPolicyPaymentsCalendarNextDate(f.id), ' . $db->quote(DATE_FORMAT) . ') AS nextPaymentDate, ROUND( getPolicyPaymentsCalendarNextAmount(f.id) / e.amount * (c.car_price + c.price_equipment) * b.rate/100 * a.share/100, 2) AS nextPaymentAmount, ' .
				'd.options_deterioration_no AS policiesOptionsDeteriorationNo ' .
				'FROM ' . PREFIX . '_reinsurance_bordero_premiums AS a ' .
				'JOIN ' . PREFIX . '_reinsurance_bordero_premium_items AS b ON a.id = b.bordero_premiums_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS c ON b.policy_items_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_kasko AS d ON c.policies_id = d.policies_id ' .
				'JOIN ' . PREFIX . '_policies AS e ON c.policies_id = e.id ' .
				'JOIN ' . PREFIX . '_policy_payments_calendar AS f ON c.policies_id = f.policies_id AND b.policy_payments_calendar_id = f.id ' .
				'JOIN (SELECT GROUP_CONCAT(risks_id ORDER BY risks_id ASC SEPARATOR \',\') AS policyRisks, bordero_items_id FROM ' . PREFIX . '_reinsurance_bordero_premium_item_risks GROUP BY bordero_items_id) AS i ON b.id = i.bordero_items_id ' .
				'LEFT JOIN ' . PREFIX . '_reinsurance_bordero_premium_items AS j ON b.policy_payments_calendar_id = j.policy_payments_calendar_id ' .
				'WHERE a.id = ' . intval($id) . ' ' .
				'GROUP BY b.id';
		return $db->getAll($sql);
	}

	function showForm($data, $action, $actionType=null, $template=null) {
		global $db;

		$sql =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_financial_institutions ' .
                'ORDER BY title';
        $data['financial_institutions'] = $db->getAll($sql, 30 * 60);

		$data['agreements_id'] = $data['id'];

		if ($action == 'view') {
			$data['list'] = $this->getItems($data['id']);
		}

        return parent::showForm($data, $action, $actionType, 'form.php');
    }

	function setConstants(&$data) {
        $agreement = ReinsuranceAgreements::get($data['agreements_id']);

		$data['number']					= $agreement['number'] . '-' . date('y/m', mktime(0, 0, 0, $data['date_month']-1, $data['date_day'], $data['date_year']));
		$data['share']					= $agreement['share'];
		$data['payment_statuses_id']	= PAYMENT_STATUSES_NOT;
		$data['file']				= 1;

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
							'JOIN ' . PREFIX . '_reinsurance_bordero_premium_items AS k2 ON k1.id = k2.bordero_premiums_id ' .
							'WHERE k1.agreements_id = ' . intval($agreements_id) . ')';

		$sql =	'SELECT a.id, a.product_types_id, a.number AS policiesNumber, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') AS policiesDate, date_format(d.payment_date, ' . $db->quote(DATE_FORMAT) . ') AS payment_date, ' .
				'IF(insurer_person_types_id = 1, CONCAT(insurer_lastname, \' \', SUBSTRING(insurer_firstname, 1, 1), \'.\', SUBSTRING(insurer_patronymicname, 1, 1), \'.\'), insurer_company) AS policiesInsurer, a.amount AS policiesAmount, ' .
				'c.id AS policy_items_id, CONCAT(c.brand, \'/\', c.model) AS item, c.shassi, c.sign, ' .
				'date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policiesbegin_datetime, date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policiesinterrupt_datetime, ' .
				'c.car_price + c.price_equipment AS itemsPrice, e.policyRisks, ' .
				'c.year, c.deductibles_value1, c.deductibles_value0, c.car_price + c.price_equipment - IF(ISNULL(f.bordero_premiumsPrice), 0, f.bordero_premiumsPrice) AS insurerPrice, ' .
				'b.options_deterioration_no, b.assured_title, f.bordero_premiumsNumbers, ' .
				'd.id AS policy_payments_calendar_id, d.amount AS payments_calendarAmount, c.car_types_id, i.sng ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.id = c.policies_id ' .
				'JOIN ' . PREFIX . '_policy_payments_calendar AS d ON a.id = d.policies_id ' .
				'JOIN (SELECT GROUP_CONCAT(risks_id ORDER BY risks_id ASC SEPARATOR \',\') AS policyRisks, policies_id FROM ' . PREFIX . '_policy_risks GROUP BY policies_id) AS e ON a.id = e.policies_id ' .
				'LEFT JOIN (' .
					'SELECT SUM(price) AS bordero_premiumsPrice, GROUP_CONCAT(number ORDER BY number ASC SEPARATOR \'<br />\') AS bordero_premiumsNumbers, policy_items_id, policy_payments_calendar_id ' .
					'FROM ' . PREFIX . '_reinsurance_bordero_premium_items AS f1 ' .
					'JOIN ' . PREFIX . '_reinsurance_bordero_premiums AS f2 ON f1.bordero_premiums_id = f2.id ' .
					'GROUP BY policy_items_id, policy_payments_calendar_id) AS f ON c.id = f.policy_items_id AND d.id = f.policy_payments_calendar_id ' .
				'JOIN ' . PREFIX . '_car_brands AS i ON c.brands_id = i.id ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'GROUP BY c.id, d.id';
		return $db->getAll($sql);
	}

	function loadItemsInWindow($data) {
		$share = ReinsuranceAgreements::getShare($data['agreements_id']);

		$list = $this->getItemsToProcess($data['date'], $data['financial_institutions_id'], $data['itemsPrice'], $data['agreements_id']);

		include_once $this->object . '/borderoItemsInWindow.php'; 
	}

	function setAdditionalFields($data) {
		global $db;

		//вытаскиваем объекты к перестрахованию
		$list = $this->getItemsToProcess($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'], $data['financial_institutions_id'], $data['itemsPrice'], $data['agreements_id']);

		$agreementRisks = ReinsuranceAgreements::getRisks($data['agreements_id']);

		foreach ($list as $row) {

			$policyRisks = explode(',', $row['policyRisks']);

			//получаем тариф
			$sql =	'SELECT ' . (in_array(RISKS_HIJACKING1, $policyRisks) ? 'value_hijacking' : 'value_other') . ' AS rate ' .
					'FROM ' . PREFIX . '_reinsurance_agreement_deductibles ' . 
				  	'WHERE value0 >= ' . $row['deductibles_value0'] . ' AND value1 >= ' . $row['deductibles_value1'] . ' AND agreements_id = ' . intval($data['agreements_id']) . ' AND sng = ' . $row['sng'] . ' AND car_types_id = ' . $row['car_types_id'] . ' ' .
					'ORDER BY value0, value1 ' .
					'LIMIT 1';
			$rate = $db->getOne($sql, 30 * 60);

			//корректируем тариф, если по договору перестрахования тариф зависит от набора рисков
			if (is_array($agreementRisks) && sizeOf($agreementRisks) > 0) {
				$total = 0;
				foreach ($agreementRisks as $risk) {
					if (in_array($risk['risks_id'], $policyRisks)) {
						$total += $risk['value'];
					}
				}

				$rate = $rate * $total / 100;
			}

			//если машина застрахована без износа, корректируем тариф
			if (intval($row['options_deterioration_no'])) {//задействуем таблицу по годам
				$rate = $rate * ReinsuranceAgreementCarYears::getValue($data['agreements_id'], $row['car_types_id'], $row['year']);
			}

			$price	= ($row['itemsPrice'] * $data['share'] / 100 > $row['insurerPrice']) ? $row['insurerPrice'] : round( $row['itemsPrice'] * $data['share'] / 100, 2);
			$rate	= round($rate, 2);
			$amount	= round($row['payments_calendarAmount'] / $row['policiesAmount'] * $price * $rate / 100, 2);
	
			//сохраняем объекты
			$sql =	'INSERT INTO ' . PREFIX . '_reinsurance_bordero_premium_items SET ' .
				 	'bordero_premiums_id = ' . $data['id'] . ', ' .
				 	'policies_id = ' . $row['id'] . ', ' .
				 	'policy_items_id = ' . $row['policy_items_id'] . ', ' .
				 	'policy_payments_calendar_id = ' . $row['policy_payments_calendar_id'] . ', ' .
				 	'rate = ' . $db->quote( $rate ) . ', ' .
				 	'price = ' . $db->quote ( $price ) . ', ' .
				 	'amount = ' . $db->quote( $amount );
			$db->query($sql);

			$id = mysql_insert_id();

			//сохраняем риски перестрахованные по объекту
			foreach ($policyRisks as $risks_id) {
				$sql =	'INSERT INTO ' . PREFIX . '_reinsurance_bordero_premium_item_risks SET ' .
					  	'bordero_items_id = ' . $id . ', ' .
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

		$sql =	'SELECT a.number, a.date, b.companies_id, b.number AS agreementsNumber, b.date AS agreementsDate ' .
				'FROM ' . PREFIX . '_reinsurance_bordero_premiums AS a ' .
				'JOIN ' . PREFIX . '_reinsurance_agreements AS b ON a.agreements_id = b.id ' .
				'WHERE a.id = ' . intval($data['id']);
		$agreement = $db->getRow($sql);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_companies ' .
				'WHERE id = ' . intval($agreement['companies_id']);
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