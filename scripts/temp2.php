<?

include_once '../include/collector.inc.php';

$sql = 'select a.id as policies_id, b.items_id as items_id, b.id as years_id
		from insurance_policies a
		join insurance_policies_kasko_item_years_payments b on a.id = b.policies_id
		where product_types_id = 3 and subdate(adddate(begin_datetime, interval 1 year), interval 1 day) = end_datetime
		group by b.items_id
		having count(b.id) > 1';
$list = $db->getAll($sql);

foreach ($list as $row) {
	$sql = 'select sum(amount_kasko) as amount_kasko, sum(amount_agent) as amount_agent, sum(commission_agent_amount) as commission_agent_amount
			from insurance_policies_kasko_item_years_payments
			where policies_id = ' . intval($row['policies_id']) . ' and items_id = ' . intval($row['items_id']);
	$amounts = $db->getRow($sql);
	
	$sql = 'update insurance_policies_kasko_item_years_payments
			set 
				amount_kasko = ' . $amounts['amount_kasko'] . ',
				amount_agent = ' . $amounts['amount_agent'] . ',
				commission_agent_amount = ' . $amounts['commission_agent_amount'] . '
			where id = ' . intval($row['years_id']);
	$db->query($sql);
	
	$sql = 'delete from insurance_policies_kasko_item_years_payments
			where policies_id = ' . intval($row['policies_id']) . ' and items_id = ' . intval($row['items_id']) . ' and id <> ' . intval($row['years_id']);
	$db->query($sql);
}

?>