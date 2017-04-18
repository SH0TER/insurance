<?

require_once '../include/collector.inc.php';
require_once 'Policies.class.php';

$sql = 'SELECT a.policies_id, a.datetime, a.date, c.number, b.items_id
		FROM insurance_accidents a
		JOIN insurance_accidents_kasko b on a.id = b.accidents_id
		JOIN insurance_policies c on a.policies_id = c.id
		JOIN insurance_policies_kasko d on c.id = d.policies_id
		WHERE d.options_fifty_fifty = 1';
		
$list = $db->getAll($sql);

$num = 0;
foreach ($list as $row) {

	_dump($row);
	
	$sql = 'SELECT IF(years_payments.id > 0, years_payments.date, policies.begin_datetime) ' .
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policies_kasko_items as items ON policies.id = items.policies_id ' .
		   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND years_payments.date <= policies.interrupt_datetime AND years_payments.f = 0 AND ' . 
																							$db->quote($row['datetime']) . ' > years_payments.date AND ' .
																							'years_payments.items_id = ' . intval($row['items_id']) . ' ' .
		   'WHERE policies.number = ' . $db->quote($row['number']) . ' ' .
		   'ORDER BY years_payments.date DESC LIMIT 1';
	$begin = $db->getOne($sql);
	_dump('begin: ' . $begin);
	
	$sql = 'SELECT SUBDATE(years_payments.date, INTERVAL 1 DAY) as end_year ' .
		   'FROM ' . PREFIX . '_policies as policies ' .
		   'JOIN ' . PREFIX . '_policies_kasko_items as items ON policies.id = items.policies_id ' .
		   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND years_payments.f = 0 ' .
		   'WHERE policies.number = ' . $db->quote($row['number']) . ' AND years_payments.date <= policies.interrupt_datetime AND years_payments.date > ' . $db->quote($begin) . ' ' .
		   'ORDER BY years_payments.date ' . 
		   'LIMIT 1';
	$end = $db->getOne($sql);
	
	if (!strlen($end)) {
		$sql = 'SELECT interrupt_datetime ' .
			   'FROM ' . PREFIX . '_policies ' .
			   'WHERE number = ' . $db->quote($row['number']) . ' ' .
			   'ORDER BY date DESC ' .
			   'LIMIT 1';
		$end = $db->getOne($sql);
	}
	_dump('end: ' . $end);
	
	$sql = 'SELECT COUNT(calendar.id) ' .
		   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
		   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
		   'WHERE calendar.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ' AND policies.number = ' . $db->quote($row['number']) . ' AND calendar.second_fifty_fifty = 1';
	$count = $db->getOne($sql);
	
	_dump('count: ' . $count);
	
	if ($count == 0) {
		$sql = 'SELECT calendar.amount ' .
			   'FROM ' . PREFIX . '_policies as policies ' .
			   'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
			   'WHERE policies.number = ' . $db->quote($row['number']) . ' AND calendar.date = ' . $db->quote($begin) . ' AND calendar.valid = 1';
		$amount = $db->getOne($sql);
	
		$sql = 'INSERT INTO ' . PREFIX . '_policy_payments_calendar ' .
			   'SET ' .
					'policies_id = ' . intval($row['policies_id']) . ', ' .
					'amount = ' . $amount . ', ' .
					'date = ' . $db->quote($end) . ', ' .
					'file = 1, statuses_id = ' . PAYMENT_STATUSES_NOT . ', ' .
					'second_fifty_fifty = 1, created = NOW(), modified = NOW()';
		$db->query($sql);
		_dump(++$num . '.	' . $sql);

		Policies::setPaymentStatus($row['policies_id']);
	}
	
}

?>