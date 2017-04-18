<?

require_once '../include/collector.inc.php';

$month = 1;
$begin_date = date('Y-m-d', mktime(0, 0, 0, $month, 1, 2013));
$end_date = date('Y-m-d', mktime(0, 0, 0, $month+1, 0, 2013));

$amount_month = 0;
$amount_total = 0;
$count_month = 0;
$count_total = 0;

while (strtotime($begin_date) < strtotime('2013-07-01')) {
	$amount_month = 0;
	$count_month = 0;
	$sql = 'SELECT c.id, c.number, a.datetime, a.amount ' .
		   'FROM insurance_policy_payments AS a ' .
		   'JOIN insurance_policies as c ON a.policies_id = c.id ' .
		   'LEFT JOIN insurance_test_cash_flow AS b ON c.number = b.act_number AND (a.datetime = b.date OR a.amount = b.sum) ' .   
		   'WHERE a.datetime BETWEEN ' . $db->quote($begin_date) . ' AND ' . $db->quote($end_date) . ' AND b.policies_id IS NULL';
	$list = $db->getAll($sql);
	echo date('d.m.Y', strtotime($begin_date)) . ' - ' . date('d.m.Y', strtotime($end_date)) . '<br>';
	echo '<table border="2">';
	if (sizeof($list)) echo '<tr><td>Policies_ID</td><td>Policies_Number</td><td>Payment Date</td><td>Amount</td></tr>';
	foreach ($list as $row) {
		echo '<tr>';
		echo '<td>' . $row['id'] . '</td>';
		echo '<td>' . $row['number'] . '</td>';
		echo '<td>' . date('d.m.Y', strtotime($row['datetime'])) . '</td>';
		echo '<td>' . $row['amount'] . '</td>';
		echo '</tr>';
		$amount_month += $row['amount'];
		$amount_total += $row['amount'];
		$count_month+=1;
		$count_total+=1;
	}
	echo '</table>';
	echo 'Month amount: ' . $amount_month . '. Month count: ' . $count_month . '<br><br>';
	$month+=1;
	$begin_date = date('Y-m-d', mktime(0, 0, 0, $month, 1, 2013));
	if ($month==6) {
		$end_date = date('Y-m-d', mktime(0, 0, 0, $month, 27, 2013));
	} else {
		$end_date = date('Y-m-d', mktime(0, 0, 0, $month+1, 0, 2013));
	}
}

echo 'Total amount: ' . $amount_total . '. Total count: ' . $count_total . '<br>';

?>