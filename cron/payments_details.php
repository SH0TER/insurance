0<?

include '../include/collector.inc.php';

$limit = 30000;

function reportRowInsertUpdate($row) {
	global $db;

	$sql = 'SELECT id FROM insurance_report_payments_details WHERE payments_calendar_id = ' . intval($row['payments_calendar_id']);

	$begin_sql = '';						
	$end_sql = '';
			
	if (intval($db->getOne($sql))) {			
		$sql = 'UPDATE insurance_report_payments_details 						
				SET insurer = ' . $db->quote($row['insurer']) . ', 
					insurer_code = ' . $db->quote($row['insurer_code']) . ',
					policies_number = ' . $db->quote($row['number']) . ',
					policies_date = getPolicyDate(' . $db->quote($row['number']) . ', 1),
					policies_item = ' . $db->quote($row['item']) . ',
					product_types_id = ' . intval($row['product_types_id']) . ',
					begin_insurance_period_date = ' . $db->quote($row['date']) . ',
					end_insurance_period_date = ' . $db->quote($row['end_insurance_period_date']) . ',
					prolongation = ' . intval($row['prolongation']) . ',
					insurance_year = getNumberInsuranceYear(payments_calendar_id),
					insurance_price = ' . floatval($row['insurance_price']) . ',
					policy_payments_amount = ' . floatval($row['policy_payment_amount']) . ',
					payments_date = ' . $db->quote($row['payment_date_report']) . ',
					accident_payments_amount = ' . floatval($row['accidents_payment_amount']) . ',
					part_premium_payments_amount = ' . floatval($row['part_premium_payments_amount']) . ',
					reserve_payments_amount = ' . floatval($row['reserve_payment_amount']) . ',
					assured_title = ' . $db->quote($row['assured_title']) . ',
					agencies_id = ' . intval($row['agencies_id']) . ',
					financial_institutions_id = ' . intval($row['financial_institutions_id']) . ',
					modified = NOW() 
				WHERE payments_calendar_id = ' . intval($row['payments_calendar_id']);			
	} else {			
		$sql = 'INSERT INTO insurance_report_payments_details 
				SET payments_calendar_id = ' . intval($row['payments_calendar_id']) . ',
					insurer = ' . $db->quote($row['insurer']) . ', 
					insurer_code = ' . $db->quote($row['insurer_code']) . ',
					policies_number = ' . $db->quote($row['number']) . ',
					policies_date = getPolicyDate(' . $db->quote($row['number']) . ', 1),
					policies_item = ' . $db->quote($row['item']) . ',
					product_types_id = ' . intval($row['product_types_id']) . ',
					begin_insurance_period_date = ' . $db->quote($row['date']) . ',
					end_insurance_period_date = ' . $db->quote($row['end_insurance_period_date']) . ',
					prolongation = ' . intval($row['prolongation']) . ',
					insurance_year = getNumberInsuranceYear(' . intval($row['payments_calendar_id']) . '),
					insurance_price = ' . floatval($row['insurance_price']) . ',
					policy_payments_amount = ' . floatval($row['policy_payment_amount']) . ',
					payments_date = ' . $db->quote($row['payment_date_report']) . ',
					accident_payments_amount = ' . floatval($row['accidents_payment_amount']) . ',
					part_premium_payments_amount = ' . floatval($row['part_premium_payments_amount']) . ',
					reserve_payments_amount = ' . floatval($row['reserve_payment_amount']) . ',
					assured_title = ' . $db->quote($row['assured_title']) . ',
					agencies_id = ' . intval($row['agencies_id']) . ',
					financial_institutions_id = ' . intval($row['financial_institutions_id']) . ',
					created = NOW(), modified = NOW()';			
	}
	$db->query($sql);
	
}

$sql = 'DELETE FROM insurance_report_payments_details WHERE payments_calendar_id NOT IN (SELECT id  FROM insurance_policy_payments_calendar)';
$db->query($sql);

$sql = 'SELECT calendar.id FROM insurance_report_payments_details as report JOIN insurance_policy_payments_calendar as calendar ON report.payments_calendar_id = calendar.id
	WHERE calendar.statuses_id < 3 OR calendar.second_fifty_fifty = 1';
$idx = $db->getCol($sql);
if (sizeof($idx)) {
	$sql = 'DELETE FROM insurance_report_payments_details WHERE payments_calendar_id IN (' . implode(', ', $idx) . ')';
	_dump($sql);
	$db->query($sql);
}

//КАСКО
$sql = 'SELECT MAX(modified) FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_KASKO;
//$sql = 'SELECT NULL FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_KASKO;
$max_modified = $db->getOne($sql);
//$max_modified='2014-07-07';
$max_calendar_id = 0;

$sql = 'SELECT payments_calendar_id FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_KASKO;
$payments_calendars_idx = $db->getCol($sql); 

while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, policies.insurer, IF(policies_kasko.insurer_person_types_id = 1, 
			policies_kasko.insurer_identification_code, policies_kasko.insurer_edrpou) as insurer_code, policies.number, policies.product_types_id, calendar.date, 
			policies.price, calendar.payment_date_report, policies_kasko.assured_title, policies.agencies_id, policies_kasko.financial_institutions_id, 
			policies_kasko.terms_years_id, policies.agreement_types_id, policies.states_id, policies.top 
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id 
		LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE '.
		'	policies.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (
			calendar.id NOT IN (' . implode(', ', $payments_calendars_idx) . ') OR
			calendar.modified > ' . $db->quote($max_modified) . ' OR 
			accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND 
		calendar.id > ' . intval($max_calendar_id) . ' AND calendar.amount <> 0 AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.second_fifty_fifty = 0 '.
        
        //' and policies.id IN (273014) '.
		'GROUP BY calendar.id 
		ORDER BY calendar.id 
		LIMIT ' . $limit;
//policies.modified > ' . $db->quote($max_modified) . ' OR 
	$list = $db->query($sql);
//_dump($sql);exit;
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
		
		if (intval($row['top']) == 0) {
			$row['top'] = $row['policies_id'];
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, getEndInsurancePeriod(policies.id, calendar.date, 1) as end, policies.states_id FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND policies.top = ' . $row['top'] . ' AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
		$calendars = $db->getAll($sql);
		for ($i=0; $i<sizeof($calendars); $i++) {
			if (intval($calendars[$i]['id']) == intval($row['payments_calendar_id'])) {
				
				$sql = 'SELECT getEndInsurancePeriod(' . intval($row['policies_id']) . ', ' . $db->quote($row['date']) . ', 1)';
				$row['end_insurance_period_date'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(calendar.amount) FROM insurance_policy_payments_calendar as calendar JOIN insurance_policies as policies ON calendar.policies_id = policies.id WHERE calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies.number = ' . $db->quote($row['number']);
				$row['policy_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id JOIN insurance_accidents_kasko_acts as accidents_kasko_acts ON accidents_acts.id = accidents_kasko_acts.accidents_acts_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')) AND accidents_kasko_acts.not_proportionality = 0';
				$row['accidents_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accident_payments_calendar.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id JOIN insurance_accidents_kasko_acts as accidents_kasko_acts ON accidents_acts.id = accidents_kasko_acts.accidents_acts_id JOIN insurance_accident_payments_calendar as accident_payments_calendar ON accidents_kasko_acts.accidents_acts_id = accident_payments_calendar.acts_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')) AND accidents_kasko_acts.not_proportionality = 0 AND accident_payments_calendar.payment_types_id = ' . PAYMENT_TYPES_PART_PREMIUM;
				$row['part_premium_payments_amount'] = $db->getOne($sql);	
		
				$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
				$row['reserve_payment_amount'] = $db->getOne($sql);
				
				if ($row['terms_years_id'] == 1) {
					if ($row['agreement_types_id'] == 0 || $row['agreement_types_id']==2) {
						$sql = 'SELECT price FROM insurance_policies WHERE id = ' . intval($row['policies_id']);
					} else {
						$sql = 'SELECT price FROM insurance_policies WHERE number = ' . $db->quote($row['number']) . ' AND (sub_number = 0 OR sub_number IS NULL)';
					}
				} else {
					$sql = 'SELECT items_id FROM insurance_policies_kasko_item_years_payments WHERE policies_id = ' . intval($row['policies_id']) . ' GROUP BY date';
					if (is_array($db->getCol($sql))) {
						$sql = 'SELECT item_price FROM insurance_policies_kasko_item_years_payments WHERE policies_id = ' . intval($row['policies_id']) . ' AND date <= ' . $db->quote($row['date']).' ORDER BY date DESC limit 1';
					} else {
						if ($row['agreement_types_id'] == 0 || $row['agreement_types_id']==2) {
							$sql = 'SELECT price FROM insurance_policies WHERE id = ' . intval($row['policies_id']);
						} else {
							$sql = 'SELECT price FROM insurance_policies WHERE number = ' . $db->quote($row['number']) . ' AND (sub_number = 0 OR sub_number IS NULL)';
						}
					}
				}
				$row['insurance_price'] = $db->getOne($sql);

				$counter = 0;
				$prev_statuses_id = -1;
				$prev_end_date = null;
				for ($j=0; $j<sizeof($calendars); $j++) {
					if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
						break; 
					}
					if ($prev_statuses_id == -1) {
						$prev_statuses_id = $calendars[$j]['statuses_id'];
						$prev_end_date = $calendars[$j]['end'];
						continue;
					}
					if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
						$counter++;
					} else {
						$counter = 0;
					}
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
				}
				$row['prolongation'] = $counter;

				$sql = 'SELECT IF(locate(\'/\', item), left(item, locate(\'/\', item)-1), item) FROM insurance_policies WHERE id = ' . intval($row['policies_id']);
				$row['item'] = $db->getOne($sql);
				
				reportRowInsertUpdate($row);
				
			}
		}
	}
}
//exit;
//Вантажі, генеральні
//$sql = 'SELECT date_format(MAX(modified), \'%Y-%m-%d\') FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_CARGO_GENERAL;
/*$sql = 'SELECT NULL FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_CARGO_GENERAL;
$max_modified = $db->getOne($sql);
$max_calendar_id = 148299;

//while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, CONCAT_WS(\' \', policies_cargo_general.lastname, policies_cargo_general.firstname, 
			policies_cargo_general.patronymicname) as insurer, policies.number, policies.product_types_id, calendar.date, calendar.payment_date as payment_date_report, 
			policies.agencies_id, policies.states_id, policies.top 
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_cargo_general as policies_cargo_general ON policies.id = policies_cargo_general.policies_id 
		JOIN insurance_policies_cargo as policies_cargo ON policies.id = policies_cargo.policies_general_id 
		LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE policies.product_types_id = ' . PRODUCT_TYPES_CARGO_GENERAL . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (
			calendar.modified > ' . $db->quote($max_modified) . ' OR 
			accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND 
		calendar.id > ' . intval($max_calendar_id) . ' AND calendar.id IS NOT NULL 
		ORDER BY calendar.id 
		LIMIT ' . $limit;
//policies.modified > ' . $db->quote($max_modified) . ' OR 
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
		
		if (intval($row['top']) == 0) {
			$row['top'] = $row['policies_id'];
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, getEndInsurancePeriod(policies.id, calendar.date, 1) as end, policies.states_id FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND policies.top = ' . $row['top'] . ' AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
		$calendars = $db->getAll($sql);
		
		for ($i=0; $i<sizeof($calendars); $i++) {
			if (intval($calendars[$i]['id']) == intval($row['payments_calendar_id'])) {
				
				$sql = 'SELECT getEndInsurancePeriod(' . intval($row['policies_id']) . ', ' . $db->quote($row['date']) . ', 1)';
				$row['end_insurance_period_date'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(amount) FROM insurance_policy_payments_calendar WHERE statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
				$row['policy_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
				$row['accidents_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
				$row['reserve_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(policies_cargo_items.price) FROM insurance_policies as policies JOIN insurance_policy_payments_calendar as calendar ON policies.id = calendar.policies_id JOIN insurance_policies_cargo as policies_cargo ON calendar.id = policies_cargo.payments_id JOIN insurance_policies_cargo_items as policies_cargo_items ON policies_cargo.policies_id = policies_cargo_items.policies_id WHERE calendar.date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies.number = ' . $db->quote($row['number']);
				$row['insurance_price'] = $db->getOne($sql);
				$row['item'] = 'Автопарк';

				$counter = 0;
				$prev_statuses_id = -1;
				$prev_end_date = null;
				for ($j=0; $j<sizeof($calendars); $j++) {
					if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
						break; 
					}
					if ($prev_statuses_id == -1) {
						$prev_statuses_id = $calendars[$j]['statuses_id'];
						$prev_end_date = $calendars[$j]['end'];
						continue;
					}
					if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
						$counter++;
					} else {
						$counter = 0;
					}
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
				}
				$row['prolongation'] = $counter;
				
				reportRowInsertUpdate($row);			
			}
		}
	}
//}
exit;*/
//Перегони, генеральні, та Берлін, КАСКО, генеральні
//$sql = 'SELECT date_format(MAX(modified), \'%Y-%m-%d\') FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_DRIVE_GENERAL;
/*$sql = 'SELECT NULL FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_DRIVE_GENERAL;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;

//while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, policies.number, policies.product_types_id, calendar.date, 
			calendar.payment_date as payment_date_report, policies.agencies_id, policies.states_id, policies.top 	
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_drive_general as policies_drive_general ON policies.id = policies_drive_general.policies_id 
		JOIN insurance_policies_drive as policies_drive ON policies.id = policies_drive.policies_general_id 
		LEFT JOIN insurance_accidents as accidents ON policies_drive.policies_id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE policies.product_types_id = ' . PRODUCT_TYPES_DRIVE_GENERAL . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (
			calendar.modified > ' . $db->quote($max_modified) . ' OR 
			accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND 
			calendar.id > ' . intval($max_calendar_id) . ' 
		GROUP BY calendar.id 
		ORDER BY calendar.id 
		LIMIT ' . $limit;
//policies.modified > ' . $db->quote($max_modified) . ' OR 
	$list = $db->query($sql);

	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
		
		if (intval($row['top']) == 0) {
			$row['top'] = $row['policies_id'];
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, policies.interrupt_datetime as end, policies.states_id FROM insurance_policy_payments_calendar AS calendar JOIN insurance_policies_drive as policies_drive ON calendar.id = policies_drive.payments_id JOIN insurance_policies as policies ON policies_drive.policies_id = policies.id JOIN insurance_policies as policies2 ON calendar.policies_id = policies2.id WHERE calendar.date <= policies.interrupt_datetime AND policies2.top = ' . $row['top'] . ' AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' GROUP BY policies.interrupt_datetime';
		$calendars = $db->getAll($sql);
		
		$sql = 'SELECT policies_kasko.insurer_edrpou FROM insurance_policies_kasko as policies_kasko JOIN insurance_policies_drive as policies_drive ON policies_kasko.policies_id = policies_drive.policies_id WHERE policies_drive.policies_general_id = ' . intval($row['policies_id']) . ' GROUP BY policies_drive.policies_general_id';
		$row['insurer_code'] = $db->getOne($sql);
		
		$sql = 'SELECT policies.insurer FROM insurance_policies as policies JOIN insurance_policies_drive as policies_drive ON policies.id = policies_drive.policies_id WHERE policies_drive.policies_general_id = ' . intval($row['policies_id']) . ' GROUP BY policies_drive.policies_general_id';
		$row['insurer'] = $db->getOne($sql);
		
		for ($i=0; $i<sizeof($calendars); $i++) {
			if (intval($calendars[$i]['id']) == intval($row['payments_calendar_id'])) {
				
				$row['end_insurance_period_date'] = $calendars[$i]['end'];
				
				$sql = 'SELECT SUM(calendar.amount) FROM insurance_policy_payments_calendar as calendar JOIN insurance_policies as policies ON calendar.policies_id = policies.id WHERE calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies.number = ' . $db->quote($row['number']);
				$row['policy_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_policies_drive as policies_drive ON policies.id = policies_drive.policies_general_id JOIN insurance_accidents as accidents ON policies_drive.policies_id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
				$row['accidents_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accident_payments_calendar.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id JOIN insurance_accidents_kasko_acts as accidents_kasko_acts ON accidents_acts.id = accidents_kasko_acts.accidents_acts_id JOIN insurance_accident_payments_calendar as accident_payments_calendar ON accidents_kasko_acts.accidents_acts_id = accident_payments_calendar.acts_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')) AND accidents_kasko_acts.not_proportionality = 0 AND accident_payments_calendar.payment_types_id = ' . PAYMENT_TYPES_PART_PREMIUM;
				$row['part_premium_payments_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_policies_drive as policies_drive ON policies.id = policies_drive.policies_general_id JOIN insurance_accidents as accidents ON policies_drive.policies_id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
				$row['reserve_payment_amount'] = $db->getOne($sql);

				$sql = 'SELECT SUM(policies_kasko_items.car_price) FROM insurance_policies as policies JOIN insurance_policy_payments_calendar as calendar ON policies.id = calendar.policies_id JOIN insurance_policies_drive as policies_drive ON calendar.id = policies_drive.payments_id JOIN insurance_policies_kasko_items as policies_kasko_items ON policies_drive.policies_id = policies_kasko_items.policies_id WHERE calendar.date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies.number = ' . $db->quote($row['number']);
				$row['insurance_price'] = $db->getOne($sql);
				$row['item'] = 'Автопарк';
			
				$counter = 0;
				$prev_statuses_id = -1;
				$prev_end_date = null;
				for ($j=0; $j<sizeof($calendars); $j++) {
					if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
						break; 
					}
					if ($prev_statuses_id == -1) {
						$prev_statuses_id = $calendars[$j]['statuses_id'];
						$prev_end_date = $calendars[$j]['end'];
						continue;
					}
					if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
						$counter++;
					} else {
						$counter = 0;
					}
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
				}
				$row['prolongation'] = $counter;
				
				reportRowInsertUpdate($row);
			}
		}
	}
//} 
exit;*/
//ЦВ
$sql = 'SELECT date_format(MAX(modified), \'%Y-%m-%d\') FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_GO;
//$sql = 'SELECT NULL FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_GO;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;

while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.begin_datetime as policies_begin_datetime, policies.id as policies_id, policies_go.terms_id as terms_id, 
			policies_go.shassi, policies_go.car_types_id as car_types_id, policies_go.blank_series_parent as blank_series_parent, policies.insurer, 
			policies_go.person_types_id as person_types_id, IF(policies_go.person_types_id = 1, policies_go.insurer_identification_code, policies_go.insurer_edrpou) as insurer_code, 
			policies.number, policies.product_types_id, calendar.date, policies.price, calendar.payment_date as payment_date_report, policies.agencies_id, 
			policies.top 
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_go as policies_go ON policies.id = policies_go.policies_id 
		LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE policies.product_types_id = ' . PRODUCT_TYPES_GO . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (
			calendar.modified > ' . $db->quote($max_modified) . ' OR 
			accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND 
			calendar.id > ' . intval($max_calendar_id) . ' AND policies.insurance_companies_id = 4 
		GROUP BY calendar.id 
		ORDER BY calendar.id 
		LIMIT ' . $limit;
//policies.modified > ' . $db->quote($max_modified) . ' OR 
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, policies.interrupt_datetime as end FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND calendar.id = ' . $row['payments_calendar_id'];
		$calendars = $db->getRow($sql);
		
		if ($calendars) {
			$row['date'] = $calendars['begin'];
			$row['end_insurance_period_date'] = $calendars['end'];
//		
			$sql = 'SELECT SUM(amount) FROM insurance_policy_payments_calendar WHERE statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND date BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
			$row['policy_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
			$row['accidents_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accident_payments_calendar.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id JOIN insurance_accident_payments_calendar as accident_payments_calendar ON accidents_acts.id = accident_payments_calendar.acts_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')) AND accident_payments_calendar.payment_types_id = ' . PAYMENT_TYPES_PART_PREMIUM;
			$row['part_premium_payments_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
			$row['reserve_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT IF(locate(\'/\', item), left(item, locate(\'/\', item)-1), item) FROM insurance_policies WHERE id = ' . intval($row['policies_id']);
			$row['item'] = $db->getOne($sql);
			
//			$row['prolongation'] = 0;
			$row['insurance_price'] = 150000.00;
			$row['assured_title'] = '';
			$row['financial_institutions_id'] = 0;	

			if ($row['person_types_id'] == 1 && $row['blank_series_parent'] == '' && ($row['terms_id'] == 25 || ($row['terms_id'] >= 19 && $row['car_types_id'] == 3))) {
				$sql = 'SELECT shassi, brands_id, models_id, IF(insurer_identification_code IS NULL, \'\', insurer_identification_code) as insurer_identification_code, IF(insurer_passport_series IS NULL, \'\', insurer_passport_series) as insurer_passport_series, IF(insurer_passport_number IS NULL, \'\', insurer_passport_number) as insurer_passport_number FROM insurance_policies_go WHERE policies_id = ' . intval($row['policies_id']);
				$item = $db->getRow($sql);
				
				if (strlen($item['shassi']) < 17) {
					$sql = 'SELECT COUNT(*) ' .
					   'FROM insurance_policies as policies ' .
					   'JOIN insurance_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
					   'WHERE policies.insurance_companies_id = 4 AND policies_go.terms_id = 25 AND policies.payment_statuses_id > 1 AND policies_go.blank_series_parent = \'\' AND policies_go.insurer_identification_code = ' . $db->quote((strlen($item['insurer_identification_code']) ? $item['insurer_identification_code'] : '')) . ' AND policies.begin_datetime < ' . $db->quote($row['policies_begin_datetime']) . ' AND policies_go.insurer_passport_series = ' . $db->quote((strlen($item['insurer_passport_series']) ? $item['insurer_passport_series'] : '')) . ' AND policies_go.insurer_passport_number = ' . $db->quote((strlen($item['insurer_passport_number']) ? $item['insurer_passport_number'] : '')) . ' AND policies_go.brands_id = ' . intval($item['brands_id']) . ' AND policies_go.models_id = ' . intval($item['models_id']);
					$row['prolongation'] = $db->getOne($sql);											
				} else {        
					$sql = 'SELECT COUNT(*) ' .
					   'FROM insurance_policies as policies ' .
					   'JOIN insurance_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
					   'WHERE policies.insurance_companies_id = 4 AND policies_go.terms_id = 25 AND policies.payment_statuses_id > 1 AND policies_go.blank_series_parent = \'\' AND policies_go.shassi = ' . $db->quote($item['shassi']) . ' AND policies.begin_datetime < ' . $db->quote($row['policies_begin_datetime']);
					$row['prolongation'] = $db->getOne($sql);						
				}

				
			}
			reportRowInsertUpdate($row);
		}
		
	}
}
//exit;
//ДСЦВ
/*$sql = 'SELECT MAX(modified) FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_DGO;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;

while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, policies.insurer, IF(policies_dgo.person_types_id = 1, policies_dgo.insurer_identification_code, policies_dgo.insurer_edrpou) as insurer_code, policies.number, policies.product_types_id, calendar.date, policies.price, calendar.payment_date as payment_date_report, policies.agencies_id, policies_dgo.financial_institutions_id, policies.top FROM insurance_policy_payments_calendar as calendar JOIN insurance_policies as policies ON calendar.policies_id = policies.id JOIN insurance_policies_dgo as policies_dgo ON policies.id = policies_dgo.policies_id LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.product_types_id = ' . PRODUCT_TYPES_DGO . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (calendar.modified > ' . $db->quote($max_modified) . ' OR accidents.modified > ' . $db->quote($max_modified) . ' OR accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND calendar.id > ' . intval($max_calendar_id) . ' GROUP BY calendar.id ORDER BY calendar.id LIMIT ' . $limit;
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, policies.interrupt_datetime as end FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND calendar.id = ' . $row['payments_calendar_id'];
		$calendars = $db->getRow($sql);
		
		if ($calendars) {
			$row['date'] = $calendars['begin'];
			$row['end_insurance_period_date'] = $calendars['end'];
			$row['prolongation'] = 0;
			$row['insurance_price'] = $row['price'];
			$row['assured_title'] = '';
		
			$sql = 'SELECT SUM(amount) FROM insurance_policy_payments_calendar WHERE statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND date BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
			$row['policy_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
			$row['accidents_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
			$row['reserve_payment_amount'] = $db->getOne($sql);
			
			reportRowInsertUpdate($row);
		}		
	}
}*/

//Нещасні випадки
$sql = 'SELECT date_format(MAX(modified), \'%Y-%m-%d\') FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_NS;
//$sql = 'SELECT NULL FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_NS;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;
//$max_modified='0000-00-00';

while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, CONCAT_WS(\' \', policies_ns.insurer_lastname, policies_ns.insurer_firstname, 
			policies_ns.insurer_patronymicname) as insurer, policies_ns.insurer_identification_code as insurer_code, policies.number, policies.product_types_id, 
			calendar.date, policies.price, calendar.payment_date as payment_date_report, policies.agencies_id, policies_ns.financial_institutions_id, 
			policies_ns.assured_title, policies.top 
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_ns as policies_ns ON policies.id = policies_ns.policies_id 
		LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE policies.product_types_id = ' . PRODUCT_TYPES_NS . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (
			calendar.modified > ' . $db->quote($max_modified) . ' OR accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND 
			calendar.id > ' . intval($max_calendar_id) . ' 
		GROUP BY calendar.id 
		ORDER BY calendar.id 
		LIMIT ' . $limit;
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, policies.interrupt_datetime as end FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND calendar.id = ' . $row['payments_calendar_id'];
		$calendars = $db->getRow($sql);
		
		if ($calendars) {
			$row['date'] = $calendars['begin'];
			$row['end_insurance_period_date'] = $calendars['end'];
			$row['insurance_price'] = $row['price'];
		
			$sql = 'SELECT SUM(amount) FROM insurance_policy_payments_calendar WHERE statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND date BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
			$row['policy_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
			$row['accidents_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
			$row['reserve_payment_amount'] = $db->getOne($sql);
			
			$counter = 0;
			$prev_statuses_id = -1;
			$prev_end_date = null;
			for ($j=0; $j<sizeof($calendars); $j++) {
				if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
					break; 
				}
				if ($prev_statuses_id == -1) {
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
					continue;
				}
				if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
					$counter++;
				} else {
					$counter = 0;
				}
				$prev_statuses_id = $calendars[$j]['statuses_id'];
				$prev_end_date = $calendars[$j]['end'];
			}
			$row['prolongation'] = $counter;
			
			reportRowInsertUpdate($row);
		}
		
	}
}
//exit;
//Квартира та відповідальність
/*$sql = 'SELECT MAX(modified) FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_DSKV;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;

while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, CONCAT_WS(\' \', policies_dskv.insurer_lastname, policies_dskv.insurer_firstname, policies_dskv.insurer_patronymicname) as insurer, policies_dskv.insurer_identification_code as insurer_code, policies.number, policies.product_types_id, calendar.date, policies.price, calendar.payment_date as payment_date_report, policies.agencies_id, policies_dskv.assured_title, policies.top FROM insurance_policy_payments_calendar as calendar JOIN insurance_policies as policies ON calendar.policies_id = policies.id JOIN insurance_policies_dskv as policies_dskv ON policies.id = policies_dskv.policies_id LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.product_types_id = ' . PRODUCT_TYPES_DSKV . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (calendar.modified > ' . $db->quote($max_modified) . ' OR accidents.modified > ' . $db->quote($max_modified) . ' OR accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND calendar.id > ' . intval($max_calendar_id) . ' GROUP BY calendar.id ORDER BY calendar.id LIMIT ' . $limit;
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, policies.interrupt_datetime as end FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND calendar.id = ' . $row['payments_calendar_id'];
		$calendars = $db->getRow($sql);
		
		if ($calendars) {
			$row['date'] = $calendars['begin'];
			$row['end_insurance_period_date'] = $calendars['end'];
			$row['insurance_price'] = $row['price'];
		
			$sql = 'SELECT SUM(amount) FROM insurance_policy_payments_calendar WHERE statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND date BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
			$row['policy_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
			$row['accidents_payment_amount'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($calendars['begin']) . ' AND ' . $db->quote($calendars['end']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
			$row['reserve_payment_amount'] = $db->getOne($sql);
			
			$counter = 0;
			$prev_statuses_id = -1;
			$prev_end_date = null;
			for ($j=0; $j<sizeof($calendars); $j++) {
				if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
					break; 
				}
				if ($prev_statuses_id == -1) {
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
					continue;
				}
				if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
					$counter++;
				} else {
					$counter = 0;
				}
				$prev_statuses_id = $calendars[$j]['statuses_id'];
				$prev_end_date = $calendars[$j]['end'];
			}
			$row['prolongation'] = $counter;
			
			$sql = 'SELECT id FROM insurance_report_payments_details WHERE payments_calendar_id = ' . intval($row['payments_calendar_id']);
			
			reportRowInsertUpdate($row);
		}
		
	}
}*/

//Майно
$sql = 'SELECT MAX(modified) FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_PROPERTY;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;

$sql = 'SELECT payments_calendar_id FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_PROPERTY;
$payments_calendars_idx = $db->getCol($sql);

while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, policies.insurer, IF(policies_property.insurer_person_types_id = 1, 
			policies_property.insurer_identification_code, policies_property.insurer_edrpou) as insurer_code, policies.number, policies.product_types_id, 
			calendar.date, policies.price, calendar.payment_date as payment_date_report, policies_property.assured_title, policies.agencies_id, 
			policies_property.financial_institutions_id, policies.agreement_types_id, policies.states_id, policies.top 
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_property as policies_property ON policies.id = policies_property.policies_id 
		LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE policies.product_types_id = ' . PRODUCT_TYPES_PROPERTY . ' AND 
		calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND 
		(
			calendar.id NOT IN (' . implode(', ', $payments_calendars_idx) . ') OR
			calendar.modified > ' . $db->quote($max_modified) . ' OR
			accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR 
			' . $db->quote($max_modified) . ' IS NULL) AND calendar.id > ' . intval($max_calendar_id) . ' GROUP BY calendar.id ORDER BY calendar.id LIMIT ' . $limit;
//_dump($sql);
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
		
		if (intval($row['top']) == 0) {
			$row['top'] = $row['policies_id'];
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, getEndInsurancePeriod(policies.id, calendar.date, 1) as end, policies.states_id 
			FROM insurance_policies AS policies 
			JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id 
			WHERE calendar.date <= policies.interrupt_datetime AND policies.top = ' . $row['top'] . ' GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
		$calendars = $db->getAll($sql);

		for ($i=0; $i<sizeof($calendars); $i++) {
			if (intval($calendars[$i]['id']) == intval($row['payments_calendar_id'])) {
				
				$row['end_insurance_period_date'] = $calendars[$i]['end'];
				
				$sql = 'SELECT SUM(calendar.amount) FROM insurance_policy_payments_calendar as calendar JOIN insurance_policies as policies ON calendar.policies_id = policies.id WHERE calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies.number = ' . $db->quote($row['number']);
				$row['policy_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
				$row['accidents_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
				$row['reserve_payment_amount'] = $db->getOne($sql);
			
				$counter = 0;
				$prev_statuses_id = -1;
				$prev_end_date = null;
				for ($j=0; $j<sizeof($calendars); $j++) {
					if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
						break; 
					}
					if ($prev_statuses_id == -1) {
						$prev_statuses_id = $calendars[$j]['statuses_id'];
						$prev_end_date = $calendars[$j]['end'];
						continue;
					}
					if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
						$counter++;
					} else {
						$counter = 0;
					}
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
				}
				$row['prolongation'] = $counter;
				$row['insurance_price'] = $row['price'];
				
				reportRowInsertUpdate($row);
			}
		}	
	}
}

//Іпотека
//$sql = 'SELECT date_format(MAX(modified), \'%Y-%m-%d\') FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_MORTAGE;
$sql = 'SELECT NULL FROM insurance_report_payments_details WHERE product_types_id = ' . PRODUCT_TYPES_MORTAGE;
$max_modified = $db->getOne($sql);
$max_calendar_id = 0;

//while (true) {
	$sql = 'SELECT calendar.id as payments_calendar_id, policies.id as policies_id, policies.insurer, IF(policies_mortage.insurer_person_types_id = 1, 
			policies_mortage.insurer_identification_code, policies_mortage.insurer_edrpou) as insurer_code, policies.number, policies.product_types_id, 
			calendar.date, policies.price, calendar.payment_date as payment_date_report, policies_mortage.assured_title, policies.agencies_id, 
			policies_mortage.financial_institutions_id, policies.agreement_types_id, policies.states_id, policies.top 
		FROM insurance_policy_payments_calendar as calendar 
		JOIN insurance_policies as policies ON calendar.policies_id = policies.id 
		JOIN insurance_policies_mortage as policies_mortage ON policies.id = policies_mortage.policies_id 
		LEFT JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id 
		LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id 
		WHERE policies.product_types_id = ' . PRODUCT_TYPES_MORTAGE . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND (
			calendar.modified > ' . $db->quote($max_modified) . ' OR accidents.modified > ' . $db->quote($max_modified) . ' OR 
			accidents_acts.modified > '  . $db->quote($max_modified) . ' OR ' . $db->quote($max_modified) . ' IS NULL) AND 
			calendar.id > ' . intval($max_calendar_id) . ' 
		GROUP BY calendar.id 
		ORDER BY calendar.id 
		LIMIT ' . $limit;
	$list = $db->query($sql);
	
	if ($list->numRows() == 0) {
		break;
	}	

	while ($list->fetchInto($row)) {
		if (intval($row['payments_calendar_id']) > intval($max_calendar_id)) {
			$max_calendar_id = intval($row['payments_calendar_id']);
		}
		
		if (intval($row['top']) == 0) {
			$row['top'] = $row['policies_id'];
		}
	
		$sql = 'SELECT calendar.id, calendar.statuses_id, calendar.date as begin, getEndInsurancePeriod(policies.id, calendar.date, 1) as end, policies.states_id FROM insurance_policies AS policies JOIN insurance_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id WHERE calendar.date <= policies.interrupt_datetime AND policies.top = ' . $row['top'] . ' GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
		$calendars = $db->getAll($sql);

		for ($i=0; $i<sizeof($calendars); $i++) {
			if (intval($calendars[$i]['id']) == intval($row['payments_calendar_id'])) {
				
				$row['end_insurance_period_date'] = $calendars[$i]['end'];
				
				$sql = 'SELECT SUM(calendar.amount) FROM insurance_policy_payments_calendar as calendar JOIN insurance_policies as policies ON calendar.policies_id = policies.id WHERE calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.date BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND policies.number = ' . $db->quote($row['number']);
				$row['policy_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents_acts.amount) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND (accidents_acts.act_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED . ' OR accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . '))';
				$row['accidents_payment_amount'] = $db->getOne($sql);
				
				$sql = 'SELECT SUM(accidents.amount_rough) FROM insurance_policies as policies JOIN insurance_accidents as accidents ON policies.id = accidents.policies_id LEFT JOIN insurance_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id WHERE policies.number = ' . $db->quote($row['number']) . ' AND accidents.datetime BETWEEN ' . $db->quote($row['date']) . ' AND ' . $db->quote($row['end_insurance_period_date']) . ' AND accidents_acts.act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents.accident_statuses_id NOT IN (' . ACCIDENT_STATUSES_RESOLVED . ', ' . ACCIDENT_STATUSES_CLOSED . ')';
				$row['reserve_payment_amount'] = $db->getOne($sql);
			
				$counter = 0;
				$prev_statuses_id = -1;
				$prev_end_date = null;
				for ($j=0; $j<sizeof($calendars); $j++) {
					if (strtotime($calendars[$j]['begin']) > strtotime($row['date'])) {
						break; 
					}
					if ($prev_statuses_id == -1) {
						$prev_statuses_id = $calendars[$j]['statuses_id'];
						$prev_end_date = $calendars[$j]['end'];
						continue;
					}
					if ($prev_statuses_id > PAYMENT_STATUSES_PARTIAL && (strtotime($calendars[$j]['begin']) - strtotime($prev_end_date)) <= 60 * 60 * 24 * 90) {
						$counter++;
					} else {
						$counter = 0;
					}
					$prev_statuses_id = $calendars[$j]['statuses_id'];
					$prev_end_date = $calendars[$j]['end'];
				}
				$row['prolongation'] = $counter;
				$row['insurance_price'] = $row['price'];
				
				reportRowInsertUpdate($row);
			}
		}	
	}
//}

$sql = 'UPDATE insurance_report_payments_details as report, insurance_policy_payments_calendar as calendar SET report.payments_date = calendar.payment_date WHERE report.payments_calendar_id = calendar.id AND report.payments_date = \'0000-00-00\'';
$db->query($sql);

?>