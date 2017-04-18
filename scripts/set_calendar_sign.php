<?

require '../include/collector.inc.php';

$sql = 'SELECT a.id FROM insurance_accidents as a JOIN insurance_accidents_acts as b ON a.id = b.accidents_id';
$accidents_list = $db->getCol($sql);
//_dump($accidents_list);exit;

foreach ($accidents_list as $accidents_id) {
//_dump($accidents_id);exit;
	$sql = 'SELECT a.id, a.amount, a.act_type
			FROM insurance_accidents_acts as a
			JOIN insurance_accident_payments_calendar as b ON a.id = b.acts_id
			WHERE a.payment_statuses_id > 1 AND a.accidents_id = ' . intval($accidents_id) . ' 
			ORDER BY a.id DESC';
	$acts_list = $db->getAll($sql);
	
	$prev_act_type = 0;
	foreach ($acts_list as $act) {
		if ($prev_act_type == 2 || $prev_act_type == 3) {
			$sql = 'UPDATE insurance_accident_payments_calendar SET is_return = 1 WHERE acts_id = ' . intval($act['id']);
			$db->query($sql);
		}
		$prev_act_type = $act['act_type'];
	}
}

?>