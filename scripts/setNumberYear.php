<?

require_once '../include/collector.inc.php';

$maxid = 0;
/*$sql = 'SELECT calendar.id ' . 
	   'FROM ' . PREFIX . '_policies as policies ' .
	   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
	   'WHERE policies.product_types_id = 3 AND calendar.id > ' . intval($maxid) . ' AND policies.policy_statuses_id <> 1 LIMIT 30000';*/
$sql = 'SELECT top FROM ' . PREFIX . '_policies WHERE product_types_id = 3 AND policy_statuses_id <> 1 AND top > ' . intval($maxid) . '  GROUP BY top ORDER BY top';
$col = $db->getCol($sql);

foreach($col as $top) {
_dump($top);
	/*$sql = 'SELECT policies.top '.
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
		   'WHERE calendar.id = ' . intval($id);
	$top = $db->getOne($sql);*/

	$sql = 'SELECT calendar.id as calendar_id, calendar.date as begin, subdate(adddate(calendar.date, INTERVAL 1 YEAR), interval 1 day) as end, getPolicyDate(policies.number, 3) as interrupt, policies_kasko.financial_institutions_id as fid, policies.id as policies_id, policies.agreement_types_id as agr_type ' .
			'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
			'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
			'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
			'WHERE calendar.valid = 1 AND policies.top = ' . intval($top) . ' AND policies.policy_statuses_id <> 1';
	$calendar = $db->getAll($sql);
_dump($calendar);
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
				'SET number_insurance_year_test = ' . intval($number_insurance_year) . ', is_agr = ' . intval($is_agr) . ' ' .
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

?>