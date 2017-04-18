<?

if (isset($data['InWindow'])) {
	require_once 'include/collector.inc.php';
} else {
	require_once '../include/collector.inc.php';
}

//require_once 'http://e-insurance.in.ua/include/collector.inc.php';

function getEndDate($policies_id, $calendar_date) {
	global $db;
	
	$sql = 'select if(subdate(a.date, interval 1 day) > b.interrupt_datetime, b.interrupt_datetime, subdate(a.date, interval 1 day))
			from insurance_policy_payments_calendar a
			join insurance_policies b on a.policies_id = b.id
			where a.policies_id = ' . intval($policies_id) . ' and a.date > ' . $db->quote($calendar_date) . ' and a.second_fifty_fifty = 0
			limit 1';
	$end_date = $db->getOne($sql);
	
	if ($end_date == null) {
		$sql = 'select interrupt_datetime 
				from insurance_policies 
				where id = ' . intval($policies_id);
		$end_date = $db->getOne($sql);
	}
	
	return $db->quote($end_date);
}

function setNumberInsuranceYearAndProlongation($policies_id, $last, $product_types_id) {
	global $db;
	
	if (is_array($last)) {
		$previous_end_period = $last['end_period'];
		$previous_end_year = $last['end_period'];
		$number_insurance_year = $last['number_insurance_year'];
		$number_prolongation = $last['number_prolongation'];		
	} else {
		$previous_end_period = null;
		$previous_end_year = null;
		$number_insurance_year = 1;
		$number_prolongation = 0;
	}	
	
	switch ($product_types_id) {
		case 3:
			//$join = 'join insurance_policies_kasko as c on b.id = c.policies_id ';
			/*if(subdate(adddate(a.date, interval 1 year), interval 1 day) > b.end_datetime,
							b.end_datetime,
							if (subdate(adddate(a.date, interval 1 year), interval 1 day) > a.end_date, a.end_date, subdate(adddate(a.date, interval 1 year), interval 1 day))
						)as end_year,*/
			$sql = 'select a.id as calendar_id, a.date as begin, a.end_date as end_period, 
						 getEndYear(a.date, a.policies_id) as end_year,
						c.financial_institutions_id as fid, 
						b.agreement_types_id as agr_type,
						a.second_fifty_fifty
					from insurance_policy_payments_calendar as a 
					join insurance_policies as b on a.policies_id = b.id 
					join insurance_policies_kasko as c on b.id = c.policies_id 
					where a.policies_id = ' . intval($policies_id) . ' 
					order by a.date';
			break;
		case 12:
			//$join = 'join insurance_policies_property as c on b.id = c.policies_id ';
			$sql = 'select a.id as calendar_id, a.date as begin, a.end_date as end_period, 
						if(subdate(adddate(a.date, interval 1 year), interval 1 day) > b.end_datetime,
							b.end_datetime,
							subdate(adddate(a.date, interval 1 year), interval 1 day)
						)as end_year, 
						c.financial_institutions_id as fid, 
						b.agreement_types_id as agr_type,
						a.second_fifty_fifty
					from insurance_policy_payments_calendar as a 
					join insurance_policies as b on a.policies_id = b.id 
					join insurance_policies_property as c on b.id = c.policies_id 
					where a.policies_id = ' . intval($policies_id) . ' 
					order by a.date';
			break;
		case 13:
			//$join = 'join insurance_policies_ns as c on b.id = c.policies_id ';
			$sql = 'select a.id as calendar_id, a.date as begin, a.end_date as end_period, 
						if(subdate(adddate(a.date, interval 1 year), interval 1 day) > b.end_datetime,
							b.end_datetime,
							subdate(adddate(a.date, interval 1 year), interval 1 day)
						)as end_year, 
						c.financial_institutions_id as fid, 
						b.agreement_types_id as agr_type,
						a.second_fifty_fifty
					from insurance_policy_payments_calendar as a 
					join insurance_policies as b on a.policies_id = b.id 
					join insurance_policies_ns as c on b.id = c.policies_id 
					where a.policies_id = ' . intval($policies_id) . ' 
					order by a.date';
			break;
		case 15:
			//$join = 'join insurance_policies_mortage as c on b.id = c.policies_id ';
			$sql = 'select a.id as calendar_id, a.date as begin, a.end_date as end_period, 
						if(subdate(adddate(a.date, interval 1 year), interval 1 day) > b.end_datetime,
							b.end_datetime,
							subdate(adddate(a.date, interval 1 year), interval 1 day)
						)as end_year, 
						b.agreement_types_id as agr_type,
						a.second_fifty_fifty
					from insurance_policy_payments_calendar as a 
					join insurance_policies as b on a.policies_id = b.id 
					where a.policies_id = ' . intval($policies_id) . ' 
					order by a.date';
			break;
	}

	/*$sql = 'select a.id as calendar_id, a.date as begin, a.end_date as end_period, 
				if(subdate(adddate(a.date, interval 1 year), interval 1 day) > b.end_datetime,
					b.end_datetime,
					subdate(adddate(a.date, interval 1 year), interval 1 day)
				)as end_year, 
				c.financial_institutions_id as fid, 
				b.agreement_types_id as agr_type,
				a.second_fifty_fifty
			from insurance_policy_payments_calendar as a 
			join insurance_policies as b on a.policies_id = b.id '.
			//join insurance_policies_kasko as c on b.id = c.policies_id 
			$join .
			'where a.policies_id = ' . intval($policies_id) . ' 
			order by a.date';*/
	$calendars = $db->getAll($sql);

	/*_dump('calendars');
	_dump($calendars);*/
	
	$first = true;
	foreach ($calendars as $calendar) {
		$is_agr = 0;
		
		if ($previous_end_period != null && $previous_end_year != null) {
			if (intval($calendar['fid'])) {
				$number_prolongation++;
			} elseif (strtotime($previous_end_period . '+ 3 month') > strtotime($calendar['begin'])) {
				$number_prolongation++;
			} else {
				$number_prolongation = 0;
			}

			if (intval($calendar['fid']) && strtotime($calendar['begin']) > strtotime($previous_end_year)) {
				$number_insurance_year++;
			} elseif (strtotime($previous_end_year . '+ 3 month') > strtotime($calendar['begin']) && strtotime($calendar['begin']) > strtotime($previous_end_year)) {
				$number_insurance_year++;
			} elseif (strtotime($calendar['begin']) > strtotime($previous_end_year)) {
				$number_insurance_year = 1;
			}
		}
		
		if (in_array($calendar['agr_type'], array(1,3)) && $first) {
			$is_agr = 1;
		}
		
		if (in_array($calendar['agr_type'], array(1,3)) && $first && $number_insurance_year > 1) {
			$number_prolongation--;
            $number_insurance_year--;
		}
		
//_dump($number_insurance_year);
		$sql = 'update insurance_policy_payments_calendar 
				set number_insurance_year = ' . intval($number_insurance_year) . ', 
					number_prolongation = ' . ((in_array($calendar['agr_type'], array(1,3)) && $first || $calendar['second_fifty_fifty']) ? 0 : intval($number_prolongation)) . ', 
					is_agr = ' . intval($is_agr) . ' 
				where id = ' . intval($calendar['calendar_id']);
		$db->query($sql);
		
		$previous_end_period = $calendar['end_period'];
		if ($previous_number_insurance_year != $number_insurance_year)  {
			$previous_end_year = $calendar['end_year'];
		}
		$previous_number_insurance_year = $number_insurance_year;
		$first = false;		
	}
}

function setNumberPartPayment($policies_id) {
	global $db;
	
	$sql = 'select id, number_insurance_year, is_agr, second_fifty_fifty  
			from insurance_policy_payments_calendar 
			where policies_id = ' . intval($policies_id);
	$calendars = $db->getAll($sql);
	
	$number_part_payment = 1;
	$previous_number_insurance_year = -1;
	foreach ($calendars as $calendar) {
		if ($calendar['is_agr'] != 1) {
			if ($previous_number_insurance_year == $calendar['number_insurance_year']) {
				$number_part_payment++;
			} else {
				$number_part_payment = 1;
			}
			$previous_number_insurance_year = $calendar['number_insurance_year'];
		}
		
		$sql = 'update insurance_policy_payments_calendar 
				set number_part_payment = ' . ($calendar['is_agr'] || $calendar['second_fifty_fifty'] ? 0 : intval($number_part_payment)) . ' 
				where id = ' . intval($calendar['id']);
		$db->query($sql);			
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
		} else {          
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
	
	$sql = 'insert into insurance_policy_payments_policy_payments_calendar 
			set policy_payments_id = ' . intval($policy_payments_id) . ', 
				policy_payments_calendar_id = ' . intval($policy_payments_calendar_id) . ', 
				amount = ' . $amount;
	$db->query($sql);
}

function getParentId($policies_id) {
	global $db;
	
	$sql = 'select parent_id from insurance_policies where id = ' . intval($policies_id);
	return $db->getOne($sql);
}

function setProlongationGO($policies_id) {
	global $db;
	
	$number_prolongation = 0;
	
	$sql = 'select calendar.id as payments_calendar_id, policies.begin_datetime as policies_begin_datetime, policies.id as policies_id, policies_go.terms_id as terms_id, policies_go.shassi, policies_go.car_types_id as car_types_id, 
				policies_go.blank_series_parent as blank_series_parent, policies.insurer, policies_go.person_types_id as person_types_id, if(policies_go.person_types_id = 1, policies_go.insurer_identification_code, policies_go.insurer_edrpou) as insurer_code, 
				policies.number, policies.product_types_id, calendar.date, policies.price, calendar.payment_date as payment_date_report, policies.agencies_id, policies.top 
			from insurance_policy_payments_calendar as calendar 
			join insurance_policies as policies on calendar.policies_id = policies.id 
			join insurance_policies_go as policies_go on policies.id = policies_go.policies_id 
			where policies.id = ' . intval($policies_id);
	$row = $db->getRow($sql);
	
	if ($row['person_types_id'] == 1 && $row['blank_series_parent'] == '' && ($row['terms_id'] == 25 || ($row['terms_id'] >= 19 && $row['car_types_id'] == 3))) {
		$sql = 'SELECT shassi, brands_id, models_id, IF(insurer_identification_code IS NULL, \'\', insurer_identification_code) as insurer_identification_code, IF(insurer_passport_series IS NULL, \'\', insurer_passport_series) as insurer_passport_series, IF(insurer_passport_number IS NULL, \'\', insurer_passport_number) as insurer_passport_number FROM insurance_policies_go WHERE policies_id = ' . intval($row['policies_id']);
		$item = $db->getRow($sql);

		if (strlen($item['shassi']) < 17) {
			$sql = 'SELECT COUNT(*) ' .
			   'FROM insurance_policies as policies ' .
			   'JOIN insurance_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
			   'WHERE policies.insurance_companies_id = 4 AND policies_go.terms_id = 25 AND policies.payment_statuses_id > 1 AND policies_go.insurer_identification_code = ' . $db->quote((strlen($item['insurer_identification_code']) ? $item['insurer_identification_code'] : '')) . ' AND policies.begin_datetime < ' . $db->quote($row['policies_begin_datetime']) . ' AND policies_go.insurer_passport_series = ' . $db->quote((strlen($item['insurer_passport_series']) ? $item['insurer_passport_series'] : '')) . ' AND policies_go.insurer_passport_number = ' . $db->quote((strlen($item['insurer_passport_number']) ? $item['insurer_passport_number'] : '')) . ' AND policies_go.brands_id = ' . intval($item['brands_id']) . ' AND policies_go.models_id = ' . intval($item['models_id']) . ' GROUP BY begin_datetime';
			$number_prolongation = sizeOf($db->getAll($sql));	
		} else {        
			$sql = 'SELECT COUNT(*) ' .
			   'FROM insurance_policies as policies ' .
			   'JOIN insurance_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
			   'WHERE policies.insurance_companies_id = 4 AND policies_go.terms_id = 25 AND policies.payment_statuses_id > 1 AND policies_go.shassi = ' . $db->quote($item['shassi']) . ' AND policies.begin_datetime < ' . $db->quote($row['policies_begin_datetime'])  . ' GROUP BY begin_datetime';
			$number_prolongation = sizeOf($db->getAll($sql));						
		}
	}
	
	$sql = 'update insurance_policy_payments_calendar 
			set number_prolongation = ' . intval($number_prolongation) . ' 
			where id = ' . intval($row['payments_calendar_id']);
	$db->query($sql);
}

$sql = 'select id, parent_id, date, begin_datetime, interrupt_datetime, 4 as product_types_id, policy_statuses_id
		from insurance_policies 
		where insurance_companies_id = 4 and product_types_id = 4 and date > \'2014-12-23\'
		order by date';
//_dump($sql);
$policies = $db->query($sql);
//_dump($policies);

if (!sizeOf($policies) && !is_array($policies)) {

	$sql = 'check table insurance_jobs_temp';
	$status = $db->getRow($sql);

	if ($status['Msg_type'] == "Error" && $status['Msg_text'] == "Table 'insurance.insurance_jobs_temp' doesn't exist") {
		$sql = 'create table insurance_jobs_temp
				select jobs.policies_id as id, policies.parent_id as parent_id, policies.date as date, policies.begin_datetime as begin_datetime, policies.interrupt_datetime, policies.product_types_id as product_types_id,
					policies.policy_statuses_id
				from insurance_jobs as jobs 
				join insurance_policies as policies ON jobs.policies_id = policies.id 
				order by date';
	} else {
		$sql = 'insert into insurance_jobs_temp
				select jobs.policies_id as id, policies.parent_id as parent_id, policies.date as date, policies.begin_datetime as begin_datetime, policies.interrupt_datetime as interrupt_datetime, 
					policies.product_types_id as product_types_id, policies.policy_statuses_id as policy_statuses_id
				from insurance_jobs as jobs 
				join insurance_policies as policies ON jobs.policies_id = policies.id 
				order by date';
	}
	$db->query($sql);

	//
	/*$sql = 'select * from insurance_jobs';
	_dump($db->getCol($sql));*/
	//

	$sql = 'delete from insurance_jobs';
	$db->query($sql); 

	//
	/*$sql = 'select * from insurance_jobs';
	_dump($db->getCol($sql));*/
	//

	$sql = 'select id, parent_id, date, begin_datetime, interrupt_datetime, product_types_id, policy_statuses_id 
			from insurance_jobs_temp 
			order by date';
	$policies = $db->query($sql);

}

$p_idx = array();
//foreach ($policies as $policy) {
while ($policies->fetchInto($policy)) {
	_dump($policy['date']);
//_dump($policy['id']);

	$sql = 'select id, date 
			from insurance_policy_payments_calendar 
			where policies_id = ' . intval($policy['id']);
	$calendars = $db->getAll($sql);

	foreach ($calendars as $calendar) {
		$sql = 'update insurance_policy_payments_calendar 
				set valid = ' . ($policy['policy_statuses_id'] > 1 ? 1 : 0) . ', end_date = ' . getEndDate($policy['id'], $calendar['date']) . ' 
				where id = ' . intval($calendar['id']);
		$db->query($sql);
	}

	if (intval($policy['product_types_id']) == 3 || intval($policy['product_types_id']) == 12 || intval($policy['product_types_id']) == 13 || intval($policy['product_types_id']) == 15) {
		$last = null;
		
		if (intval($policy['parent_id'])) {
			$parent_id = $policy['parent_id'];
			$end_period = null;//?
			while (true) {
				if ($policy['policy_statuses_id'] > 1) {
					$sql = 'update insurance_policy_payments_calendar set valid = 0 where second_fifty_fifty = 0 and policies_id = ' . intval($parent_id) . ' and date >= ' . $db->quote($policy['begin_datetime']);
					//_dump($sql);
					$db->query($sql);
				}
				
				$sql = 'select end_date as end_period, subdate(adddate(date, interval 1 year), interval 1 day) as end_year, number_insurance_year, number_prolongation, is_agr 
						from insurance_policy_payments_calendar 
						where valid = 1 and ' . /*is_agr = 0 and */ 'policies_id = ' . intval($parent_id) . ' 
						order by date desc limit 1';
				$last = $db->getRow($sql);
				$parent_id = getParentId($parent_id);
				
				//?
				if ($last['is_agr'] == 1) { 
					if ($end_period == null) $end_period = $last['end_period'];
					continue;
				}
				//?
				
				if (is_array($last) && $last['is_agr'] == 0 || !intval($parent_id)) {
					//?
					if ($end_period != null) $last['end_period'] = $end_period;
				
					break;
				}
			}
		}
		
		setNumberInsuranceYearAndProlongation($policy['id'], $last, $policy['product_types_id']);
		setNumberPartPayment($policy['id']);
	} elseif (intval($policy['product_types_id']) == 4 || intval($policy['product_types_id']) == 7) {
		setProlongationGO($policy['id']);
	}
	
	/*$sql = 'delete from insurance_jobs_temp 
			where id = ' . intval($policy['id']);
	$db->query($sql);
	$sql = 'select * from insurance_jobs';

	$p_idx[] = intval($policy['id']);*/
//_dump($db->getCol($sql));
}exit;

$sql = 'drop table insurance_jobs_temp';
$db->query($sql);

$sql = 'select id 
		from insurance_policy_payments';
$pp = $db->getCol($sql);
$sql = 'delete from insurance_policy_payments_policy_payments_calendar
		where policy_payments_id not in(' . implode(', ', $pp) . ')';
$db->query($sql);

$sql = 'select id 
		from insurance_policy_payments_calendar';
$ppc = $db->getCol($sql);
$sql = 'delete from insurance_policy_payments_policy_payments_calendar
		where policy_payments_calendar_id not in(' . implode(', ', $ppc) . ')';
$db->query($sql);

$sql = 'select policy_payments_id from insurance_policy_payments_policy_payments_calendar';
$pp = $db->getCol($sql);

if (sizeof($pp)) {
	$sql = 'select policies_id 
			from insurance_policy_payments 
			where id not in (' . implode(', ', $pp) . ') or policies_id in (' . implode(', ', $p_idx) . ') 
			order by policies_id';
	$idx = $db->getCol($sql);
}

foreach($idx as $id) {
//_dump($id);
	$sql = 'select id 
			from insurance_policy_payments 
			where policies_id = ' . intval($id);
	$payments_id = $db->getCol($sql);
	$sql = 'delete from insurance_policy_payments_policy_payments_calendar 
			where policy_payments_id IN (' . implode(', ', $payments_id) . ')';
	if (sizeof($payments_id)) $db->query($sql);
	
	$sql = 'select id 
			from insurance_policy_payments_calendar 
			where policies_id = ' . intval($id);
	$calendars_idx = $db->getCol($sql);
	$sql = 'delete from insurance_policy_payments_policy_payments_calendar 
			where policy_payments_calendar_id IN (' . implode(', ', $calendars_idx) . ')';
	if (sizeof($calendars_idx)) $db->query($sql);

	$sql = 'select id, amount 
			from insurance_policy_payments_calendar 
			where policies_id = ' . intval($id) . ' 
			order by date';
	$plan_payments = $db->getAll($sql);

	$sql = 'select id, amount 
			from insurance_policy_payments 
			where policies_id = ' . intval($id) . '
			order by datetime';
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
//exit;
?>