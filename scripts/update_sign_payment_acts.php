<?

require_once '../include/collector.inc.php';

$sql = 'SELECT id, accidents_id, sign_suspended FROM insurance_accidents_acts WHERE accidents_acts_transfer_id > 0 ORDER BY id ASC';
$list = $db->getAll($sql);

foreach($list as $row) {
	$count = intval($db->getOne('SELECT COUNT(*) FROM insurance_accidents_acts WHERE accidents_id = ' . intval($row['accidents_id']) . ' AND act_statuses_id = 6 AND sign_suspended = 0 AND id < ' . intval($row['id'])));
	
	if ($count == 0 && $row['sign_suspended'] == 0) {
		$sql = 'UPDATE insurance_accidents_acts SET sign_payment = 1 WHERE id = ' . intval($row['id']);
		$db->query($sql);
	}
}

?>