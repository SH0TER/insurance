<?

require_once '../include/collector.inc.php';

$idx = array (175765,230265,175919,228870);

$policies = $db->getAll('SELECT id, top, date FROM insurance_policies WHERE id IN(' . implode(', ', $idx) . ') ORDER BY date');

foreach ($policies as $policy) {
	$number_prolongation = 0;
_dump($policy);	
	$sql = 'SELECT calendar.id as calendar_id, ' .
				   'calendar.date as begin, ' .
				   'subdate(adddate(calendar.date, interval 1 year), interval 1 day) as end, ' .
				   'policies_kasko.financial_institutions_id as fid, ' .
				   'policies.id as policies_id ' .
		   'FROM ' . PREFIX . '_policies AS policies ' .
		   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
		   'JOIN ' . PREFIX . '_policy_payments_calendar AS calendar ON policies.id = calendar.policies_id ' .
		   'WHERE policies.top = ' . intval($policy['top']) . ' AND policies.date <= ' . $db->quote($policy['date']);
	$calendar = $db->getAll($sql);
_dump($sql);
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

?>