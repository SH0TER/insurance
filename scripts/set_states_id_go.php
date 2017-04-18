<?

require_once '../include/collector.inc.php';

$sql = 'UPDATE insurance_policies SET states_id2 = 0 WHERE product_types_id = 4';
$db->query($sql);

$sql = 'SELECT a.id as policies_id, a.begin_datetime as policies_begin_datetime, b.shassi as item_shassi, b.insurer_identification_code as insurer_code
	    FROM insurance_policies as a
		JOIN insurance_policies_go as b ON a.id = b.policies_id
		WHERE a.begin_datetime >= \'2013-05-01\' AND a.product_types_id = 4 AND a.insurance_companies_id = 4 AND a.policy_statuses_id IN (1,10,15,17)';
$list = $db->getAll($sql);

foreach($list as $row) {
	$sql = 'SELECT COUNT(*) 
			FROM insurance_policies as a
			JOIN insurance_policies_go as b ON a.id = b.policies_id
			WHERE a.insurance_companies_id = 4 AND a.policy_statuses_id IN (1,10,15,17) AND a.begin_datetime < ' . $db->quote($row['policies_begin_datetime']) . ' AND b.shassi = ' . $db->quote($row['item_shassi']) . ' AND b.insurer_identification_code = ' . $db->quote($row['insurer_code']);
	$count = $db->getOne($sql);
	
	if ($count > 0) {
		$sql = 'UPDATE insurance_policies SET states_id2 = 1 WHERE id = ' . intval($row['policies_id']);
		$db->query($sql);
	}
}

?>