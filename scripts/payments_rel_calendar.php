<?

require_once '../include/collector.inc.php';

function setRalation($plan_payment, $fact_payments) {
	global $db;
	
	$count_remove = 0;
	//_dump($fact_payments);
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
		//_dump($plan_payment);
	}
	
	while ($count_remove > 0) {
		array_shift($fact_payments);
		$count_remove--;
	}
	
	return $fact_payments;
}

function addRow($policy_payments_id, $policy_payments_calendar_id, $amount) {
	global $db;
//_dump(1);
	
	$sql = 'INSERT INTO ' . PREFIX . '_policy_payments_policy_payments_calendar ' .
		   'SET policy_payments_id = ' . intval($policy_payments_id) . ', ' .
				'policy_payments_calendar_id = ' . intval($policy_payments_calendar_id) . ', ' .
				'amount = ' . $amount;
	$db->query($sql);
}

$max_pid = 0;
$sql = 'SELECT id ' .
	   'FROM ' . PREFIX . '_policies ' .
	   'WHERE modified > \'2014-05-21\' AND id > ' . intval($max_pid) . ' ' .
	   'ORDER BY id';
$idx = $db->getCol($sql);
//$idx = array(1);
foreach($idx as $id) {
	_dump($id);
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
	/*$plan_payments = array(
		array('id' => 11, 'amount' => 100),
		array('id' => 12, 'amount' => 100),
		array('id' => 13, 'amount' => 100)
	);*/
//_dump($plan_payments);	
	$sql = 'SELECT id, amount ' . 
		   'FROM ' . PREFIX . '_policy_payments ' . 
		   'WHERE policies_id = ' . intval($id) . ' ' .
		   'ORDER BY datetime';
	$fact_payments = $db->getAll($sql);
	/*$fact_payments = array(
		array('id' => 21, 'amount' => 150),
		array('id' => 22, 'amount' => 30),
		array('id' => 23, 'amount' => 20),
		array('id' => 24, 'amount' => 30),
		array('id' => 25, 'amount' => 30),
		array('id' => 26, 'amount' => 30),
		array('id' => 27, 'amount' => 30),
		array('id' => 28, 'amount' => 30),
		array('id' => 29, 'amount' => 30)
	);*/
//_dump($fact_payments);	
	$last_plan_payments_id = null;
//_dump($plan_payments);	
//_dump($fact_payments);
//exit;
	foreach($plan_payments as $plan_payment) {
		if (sizeof($fact_payments) == 0) break;
		$fact_payments = setRalation($plan_payment, $fact_payments);
		$last_plan_payments_id = $plan_payment['id'];
	}
//_dump($fact_payments);	
	if (sizeof($fact_payments)) {
		foreach ($fact_payments as $fact_payment) {
			addRow($fact_payment['id'], $last_plan_payments_id, $fact_payment['amount']);
		}
	}
}

?>