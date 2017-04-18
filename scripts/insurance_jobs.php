<?

require_once '../include/collector.inc.php';

function setValid($top) {
	global $db;
	
	if (intval($top)) {	
		$sql = 'SELECT calendar.id ' .
				'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
				'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
				'WHERE policies.top = ' . intval($top);
		$calendar_idx = $db->getCol($sql);
		
		foreach ($calendar_idx as $calendar_id) {
			$sql = 'SELECT IF(calendar.date > policies.interrupt_datetime, 0, 1) ' .
				   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
				   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
				   'WHERE calendar.id = ' . intval($calendar_id);

			$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
				   'SET valid = ' . intval($db->getOne($sql)) . ' ' .
				   'WHERE id = ' . intval($calendar_id);
			$db->query($sql);
_dump($sql);
		}
	}
}

function setEndDate($top) {
	global $db;
	
	if (intval($top)) {
		$sql = 'SELECT calendar.id ' .
				'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
				'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
				'WHERE policies.top = ' . intval($top);
		$calendar_idx = $db->getCol($sql);
	
		foreach ($calendar_idx as $calendar_id) {
			$sql = 'SELECT policies_id, date ' .
				   'FROM ' . PREFIX . '_policy_payments_calendar ' .
				   'WHERE id = ' . intval($calendar_id);
			$row = $db->getRow($sql);

			$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
				   'SET end_date = getEndInsurancePeriod(' . intval($row['policies_id']) . ', ' . $db->quote($row['date']) . ', 1) ' .
				   'WHERE id = ' . intval($calendar_id);
			$db->query($sql);
		}
	}
}

function setNumberOfProlongation($top) {
	global $db;

	$number_prolongation = 0;
	
	$sql = 'SELECT calendar.id as calendar_id, ' .
				   'calendar.date as begin, ' .
				   'getEndInsurancePeriod(policies.id, calendar.date, 1) as end, ' .
				   'policies_kasko.financial_institutions_id as fid, ' .
				   'policies.id as policies_id ' .
		   'FROM ' . PREFIX . '_policies AS policies ' .
		   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id ' .
		   'WHERE calendar.date <= policies.interrupt_datetime AND policies.top = ' . $top . ' AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND policies.policy_statuses_id <> 1 ' .
		   'GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
	$calendar = $db->getAll($sql);

	$p_begin = $p_end = $p_policies_id = $p_agr_type = $p_number_insurance_year = null;	

	foreach ($calendar as $row) {
		if ($p_policies_id == null) {
			$number_prolongation = 0;
		} else {
			if (strtotime($row['begin']) >= strtotime($p_end) && $row['fid']) {
				$number_prolongation++;
			} elseif (strtotime($row['begin']) >= strtotime($p_end) && !$row['fid'] && strtotime($p_end, '+ 3 month') > strtotime($row['begin'])) {
				$number_prolongation++;
			} elseif (strtotime($row['begin']) >= strtotime($p_end) && !$row['fid']) {
				$number_prolongation = 1;
			}
		}
			
		$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
				'SET number_prolongation = ' . intval($number_prolongation) . ' ' .
				'WHERE id = ' . intval($row['calendar_id']);
		$db->query($sql);
		
		$p_begin = $row['begin'];
		$p_end = $row['end'];
		$p_policies_id = $row['policies_id'];
	}
}

function setNumberInsuranceYearAndIsAgr ($top) {
	global $db;

	$sql = 'SELECT calendar.id as calendar_id, calendar.date as begin, subdate(adddate(calendar.date, INTERVAL 1 YEAR), interval 1 day) as end, getPolicyDate(policies.number, 3) as interrupt, policies_kasko.financial_institutions_id as fid, policies.id as policies_id, policies.agreement_types_id as agr_type ' .
			'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
			'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
			'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
			'WHERE calendar.valid = 1 AND policies.top = ' . intval($top) . ' AND policies.policy_statuses_id <> 1 AND policies.payment_statuses_id > 2';
	$calendar = $db->getAll($sql);

	$number_insurance_year = 0;
	$is_agr = null;
	$p_begin = $p_end = $p_policies_id = $p_agr_type = $p_number_insurance_year = null;
      
	foreach ($calendar as $row) {
		$is_agr = null;
		if ($number_insurance_year == 0) {
			$number_insurance_year = 1;
		} else {
			if (strtotime($row['begin']) >= strtotime($p_end) && $row['fid']) {
				$number_insurance_year++;
			} elseif (strtotime($row['begin']) >= strtotime($p_end) && !$row['fid'] && strtotime($p_end, '+ 3 month') > strtotime($row['begin'])) {
				$number_insurance_year++;
			} elseif (strtotime($row['begin']) >= strtotime($p_end) && !$row['fid']) {
				$number_insurance_year = 1;
			}
		}
		
		if ($row['policies_id'] != $p_policies_id && in_array($row['agr_type'], array(1, 3))) {
			$is_agr = 1;
		}
		
		$sql = 'UPDATE ' . PREFIX . '_policy_payments_calendar ' .
				'SET number_insurance_year = ' . intval($number_insurance_year) . ', is_agr = ' . intval($is_agr) . ' ' .
				'WHERE id = ' . intval($row['calendar_id']);
		$db->query($sql);
		
		$p_begin = $row['begin'];
		if ($p_number_insurance_year != $number_insurance_year)	
			$p_end = $row['end'];
		$p_policies_id = $row['policies_id'];
		$p_agr_type = $row['agr_type'];
		$p_number_insurance_year = $number_insurance_year;
	}
}

function setNumberPartPayment($number) {
	global $db;
	
	$sql = 'SELECT calendar.id as calendar_id, calendar.number_insurance_year ' .
		   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
		   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
		   'WHERE calendar.valid = 1 AND policies.number = ' . $db->quote($number) . ' ' .
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

function setRalation($plan_payment, $fact_payments) {
	global $db;
	
	$count_remove = 0;
	for($i = 0; $i < sizeof($fact_payments); $i++) {
		$fact_payment = $fact_payments[$i];
		if ((string)$plan_payment['amount'] > (string)$fact_payment['amount']) {
			$count_remove++;
			addRow($fact_payment['id'], $plan_payment['id'], $fact_payment['amount']);
			$plan_payment['amount'] -= $fact_payment['amount'];
		} elseif ((string)$plan_payment['amount'] == (string)$fact_payment['amount']) {
			$count_remove++;
			addRow($fact_payment['id'], $plan_payment['id'], $fact_payment['amount']);
			break;
		} else {           _dump(2);
			addRow($fact_payment['id'], $plan_payment['id'], $plan_payment['amount']);
			$fact_payments[$i]['amount'] -= $plan_payment['amount'];
			if (intval($fact_payments[$i]['amount'] * 100) == 0) $count_remove++;
			break;
		}
	}
	
	while ($count_remove > 0) {
		array_shift($fact_payments);
		$count_remove--;
	}
	
	return $fact_payments;
}

function addRow($policy_payments_id, $policy_payments_calendar_id, $amount) {
	global $db;
	
	$sql = 'INSERT INTO ' . PREFIX . '_policy_payments_policy_payments_calendar ' .
		   'SET policy_payments_id = ' . intval($policy_payments_id) . ', ' .
				'policy_payments_calendar_id = ' . intval($policy_payments_calendar_id) . ', ' .
				'amount = ' . $amount;
	$db->query($sql);
}

$sql = 'SELECT jobs.policies_id ' .
		'FROM ' . PREFIX . '_jobs as jobs ' .
		'JOIN ' . PREFIX . '_policies as policies ON jobs.policies_id = policies.id ' .
		'WHERE policies.product_types_id = 3 ' .
		'GROUP BY policies_id';
//$sql = 'SELECT top FROM insurance_policies WHERE product_types_id = 3 AND top > 0 GROUP BY top';
//$tops = $db->getCol($sql);

$sql = 'SELECT policy_payments_id FROM ' . PREFIX . '_policy_payments_policy_payments_calendar';
$pp = $db->getCol($sql);

if (sizeof($pp)) {
	$sql = 'SELECT policies_id FROM insurance_policy_payments WHERE id NOT IN (' . implode(', ', $pp) . ')';
	$idx = $db->getCol($sql);
}
_dump($idx);
foreach($idx as $id) {
			$sql = 'SELECT id FROM ' . PREFIX . '_policy_payments WHERE policies_id = ' . intval($id);
			$payments_id = $db->getCol($sql);
			$sql = 'DELETE FROM ' . PREFIX . '_policy_payments_policy_payments_calendar WHERE policy_payments_id IN (' . implode(', ', $payments_id) . ')';
			if (sizeof($payments_id)) $db->query($sql);
			
			$sql = 'SELECT id FROM ' . PREFIX . '_policy_payments_calendar WHERE policies_id = ' . intval($id);
			$calendars_idx = $db->getCol($sql);
			$sql = 'DELETE FROM ' . PREFIX . '_policy_payments_policy_payments_calendar WHERE policy_payments_calendar_id IN (' . implode(', ', $calendars_idx) . ')';
			if (sizeof($calendars_idx)) $db->query($sql);

			$sql = 'SELECT id, amount ' .
				   'FROM ' . PREFIX . '_policy_payments_calendar ' .
				   'WHERE policies_id = ' . intval($id) . ' ' .
				   'ORDER BY date';
			$plan_payments = $db->getAll($sql);
		
			$sql = 'SELECT id, amount ' . 
				   'FROM ' . PREFIX . '_policy_payments ' . 
				   'WHERE policies_id = ' . intval($id) . ' ' .
				   'ORDER BY datetime';
			$fact_payments = $db->getAll($sql);
		
			$last_plan_payments_id = null;

			foreach($plan_payments as $plan_payment) {
				if (sizeof($fact_payments) == 0) break;
				$fact_payments = setRalation($plan_payment, $fact_payments);
				$last_plan_payments_id = $plan_payment['id'];
			}

			if (sizeof($fact_payments)) {
				foreach ($fact_payments as $fact_payment) {
					addRow($fact_payment['id'], $last_plan_payments_id, $fact_payment['amount']);
				}
			}
		}
exit;
if (is_array($tops) && sizeof($tops)) {
	/*foreach ($tops as $top) {
//_dump('1: ' . $top);
		setValid($top);
		setEndDate($top);
	}
        
	foreach ($tops as $top) {
//_dump('2: ' . $top);
		setNumberOfProlongation($top);
		setNumberInsuranceYearAndIsAgr($top);
	}
//exit;
	foreach ($tops as $top) {
//_dump('3: ' . $top);
		$sql = 'SELECT number FROM ' . PREFIX . '_policies WHERE top = ' . intval($top);
		$number = $db->getOne($sql);
		setNumberPartPayment($number);
	}
//exit;*/
	foreach ($tops as $top) {
		$sql = 'SELECT id FROM ' . PREFIX . '_policies WHERE top = ' . intval($top);
		$idx = $db->getCol($sql);
		
		foreach($idx as $id) {
			$sql = 'SELECT id FROM ' . PREFIX . '_policy_payments WHERE policies_id = ' . intval($id);
			$payments_id = $db->getCol($sql);
			$sql = 'DELETE FROM ' . PREFIX . '_policy_payments_policy_payments_calendar WHERE policy_payments_id IN (' . implode(', ', $payments_id) . ')';
			if (sizeof($payments_id)) $db->query($sql);
			
			$sql = 'SELECT id FROM ' . PREFIX . '_policy_payments_calendar WHERE policies_id = ' . intval($id);
			$calendars_idx = $db->getCol($sql);
			$sql = 'DELETE FROM ' . PREFIX . '_policy_payments_policy_payments_calendar WHERE policy_payments_calendar_id IN (' . implode(', ', $calendars_idx) . ')';
			if (sizeof($calendars_idx)) $db->query($sql);

			$sql = 'SELECT id, amount ' .
				   'FROM ' . PREFIX . '_policy_payments_calendar ' .
				   'WHERE policies_id = ' . intval($id) . ' ' .
				   'ORDER BY date';
			$plan_payments = $db->getAll($sql);
		
			$sql = 'SELECT id, amount ' . 
				   'FROM ' . PREFIX . '_policy_payments ' . 
				   'WHERE policies_id = ' . intval($id) . ' ' .
				   'ORDER BY datetime';
			$fact_payments = $db->getAll($sql);
		
			$last_plan_payments_id = null;

			foreach($plan_payments as $plan_payment) {
				if (sizeof($fact_payments) == 0) break;
				$fact_payments = setRalation($plan_payment, $fact_payments);
				$last_plan_payments_id = $plan_payment['id'];
			}

			if (sizeof($fact_payments)) {
				foreach ($fact_payments as $fact_payment) {
					addRow($fact_payment['id'], $last_plan_payments_id, $fact_payment['amount']);
				}
			}
		}
	}

	$sql = 'DELETE FROM ' . PREFIX . '_jobs WHERE policies_id IN (' . implode(', ', $tops) . ')';
	//$db->query($sql);
}

?>