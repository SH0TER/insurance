<?

require_once '../include/collector.inc.php';

function setValid($id) {
	global $db;
	
	$sql = 'SELECT IF(calendar.date > policies.interrupt_datetime, 0, 1) ' .
		   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
		   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
		   'WHERE calendar.id = ' . intval($id);

	$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
		   'SET valid = ' . intval($db->getOne($sql)) . ' ' .
		   'WHERE id = ' . intval($id);
	$db->query($sql);
}

function setEndDate($id) {
	global $db;
	
	$sql = 'SELECT policies_id, date ' .
		   'FROM ' . PREFIX . '_policy_payments_calendar ' .
		   'WHERE id = ' . intval($id);
	$row = $db->getRow($sql);

	$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
		   'SET end_date = getEndInsurancePeriod(' . intval($row['policies_id']) . ', ' . $db->quote($row['date']) . ', 1) ' .
		   'WHERE id = ' . intval($id);
	$db->query($sql);
}

function setNumberOfInsuranceYear($id) {
	global $db;
	
	$sql = 'SELECT policies.top '.
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
		   'WHERE calendar.id = ' . intval($id);
	$top = $db->getOne($sql);
	
	if (intval($top)) {
	$number_insurance_year = 0;

    $sql = 'SELECT calendar.id as calendar_id, calendar.date as begin, getEndInsuranceYear(calendar.date, policies.number) as end, policies_kasko.financial_institutions_id as fid, policies.id as policies_id ' .
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
		   'WHERE calendar.valid = 1 AND policies.top = ' . $top . ' AND policies.policy_statuses_id <> 1 ' . //AND policies.payment_statuses_id > 2 AND calendar.statuses_id > 2 ' .
		   //'GROUP BY getEndInsuranceYear(calendar.date, policies.number)';
		'GROUP BY calendar.end_date';
	$calendar = $db->getAll($sql);

    $previuos_end_year = null;      
	$previuos_fid = null;
	$next_begin = false;
	  
    $sql = 'SELECT date FROM ' . PREFIX . '_policy_payments_calendar WHERE id = ' . intval($id);
	$calendar_date = $db->getOne($sql);

	for ($i = 0; $i< sizeof($calendar); $i++) {
		$row = $calendar[$i];
		if ($previuos_end_year == null) {
			$number_insurance_year = 1;
		} else {
			if (strtotime($calendar_date) >= strtotime($row['begin']) && $row['fid']) {
				$number_insurance_year++;
			} elseif (strtotime($calendar_date) >= strtotime($row['begin']) && !$row['fid'] && strtotime($previuos_end_year, '+ 3 month') > strtotime($row['begin'])) {
				$number_insurance_year++;
			} elseif (strtotime($calendar_date) >= strtotime($row['begin']) && !$row['fid']) {
				$number_insurance_year = 1;
			} else {
				$next_begin = $row['begin'];
				break;
			}
		}
		$previuos_end_year = $row['end'];
		$previuos_fid = $row['fid'];
	}
	
	$sql = 'SELECT calendar.id as calendar_id ' .
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
		   'WHERE policies.policy_statuses_id <> 1 AND calendar.valid = 1 AND policies.top = ' . intval($top) . ' AND calendar.date >= ' . $db->quote($calendar_date) . ($next_begin ? ' AND calendar.date < ' . $db->quote($next_begin) . ' ' : ' ');// .
		   //'GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
	$calendar_idx = $db->getCol($sql);

	if (is_array($calendar_idx) && sizeof($calendar_idx)) {
		$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
			   'SET number_insurance_year = ' . intval($number_insurance_year) . ' ' .
			   'WHERE id IN (' . implode(', ', $calendar_idx) . ')';
		$db->query($sql);
	}
	}
}

function setNumberOfProlongation($id) {
	global $db;
	
	$sql = 'SELECT policies.top '.
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
		   'WHERE calendar.id = ' . intval($id);
	$top = $db->getOne($sql);

	if (intval($top)) {
	$number_prolongation = 0;
		
	$sql = 'SELECT calendar.id as calendar_id, ' .
				   'calendar.date as begin, ' .
				   'getEndInsurancePeriod(policies.id, calendar.date, 1) as end, ' .
				   'policies_kasko.financial_institutions_id as fid, ' .
				   'policies.id as policies_id ' .
		   'FROM ' . PREFIX . '_policies AS policies ' .
		   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id ' .
		   'WHERE calendar.date <= policies.interrupt_datetime AND policies.top = ' . intval($top) . ' AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND policies.policy_statuses_id <> 1 ' .
		   'GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
	$calendar = $db->getAll($sql);
	$sql = 'SELECT date FROM ' . PREFIX . '_policy_payments_calendar WHERE id = ' . intval($id);
	$calendar_date = $db->getOne($sql);
	for ($i = 0; $i< sizeof($calendar); $i++) {
		$row = $calendar[$i];
		if ($previuos_end_year == null) {
			$number_prolongation = 0;
		} else {
			if (strtotime($calendar_date) >= strtotime($row['begin']) && $row['fid']) {
				$number_prolongation++;
			} elseif (strtotime($calendar_date) >= strtotime($row['begin']) && !$row['fid'] && strtotime($previuos_end_year, '+ 3 month') >= strtotime($row['begin'])) {
				$number_prolongation++;
			} elseif (strtotime($calendar_date) >= strtotime($row['begin']) && !$row['fid']) {
				$number_prolongation = 0;
			} else {
				break;
			}
		}
		$previuos_end_year = $row['end'];
	}
	
	$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
		   'SET number_prolongation = ' . intval($number_prolongation) . ' ' .
		   'WHERE id =' . intval($id);
	$db->query($sql);
	}
}

function setNumberPartPayment($number) {
	global $db;
	
	$sql = 'SELECT calendar.id as calendar_id, calendar.number_insurance_year ' .
		   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
		   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
		   'WHERE policies.product_types_id = 3 AND calendar.valid = 1 AND policies.number = ' . $db->quote($number) . ' ' .
		   'GROUP BY calendar.end_date';
	$list = $db->getAll($sql);
	
	$number_part_payment = 1;
	$previous_number_insurance_year = 0;
	foreach ($list as $row) {
		if ($row['number_insurance_year'] != $previous_number_insurance_year) $number_part_payment = 1;
		$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
			   'SET number_part_payment = ' . intval($number_part_payment) . ' ' .
			   'WHERE id = ' . intval($row['calendar_id']);
		$db->query($sql);
		$previous_number_insurance_year = $row['number_insurance_year'];
		$number_part_payment++;
	}
}
/*$maxid = 529544;
$sql = 'SELECT calendar.id ' . 
	   'FROM ' . PREFIX . '_policies as policies ' .
	   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
	   'WHERE policies.top <> 0 AND calendar.id > ' . intval($maxid) . ' AND policies.policy_statuses_id <> 0 ORDER BY calendar.id ASC LIMIT 100000';
$col = $db->getCol($sql);

foreach ($col as $id) {
_dump($id);
	//setValid($id);
	//setEndDate($id);
	setNumberOfInsuranceYear($id);
	//setNumberOfProlongation($id);
}
exit;*/
$sql = 'SELECT number, id ' .
	   'FROM ' . PREFIX . '_policies ' .
	   'WHERE id > 230722 AND LENGTH(number) > 0 ' .
	   'GROUP BY number ORDER BY id ASC ' . 
	   'LIMIT 100000';
$col1 = $db->getAll($sql);

foreach ($col1 as $id) {
	_dump($id['id']);
	setNumberPartPayment($id['number']);
}

?>