<?

require_once '../include/collector.inc.php';

$sql = 'select policies.number as policies_number, date_format(policies.date, \'%d.%m.%Y\') as policies_date, date_format(calendar.date, \'%d.%m.%Y\') as begin, date_format(calendar.end_date, \'%d.%m.%Y\') as end, calendar.amount as amount_calendar, SUM(relation.amount) as amount_fact
		from insurance_policies as policies
		join insurance_policy_payments_calendar as calendar on policies.id = calendar.policies_id
		join insurance_policy_payments_policy_payments_calendar as relation on calendar.id = relation.policy_payments_calendar_id
		where policies.product_types_id = 3 and calendar.statuses_id in (2) and calendar.date < now() and calendar.end_date > now() and policies.interrupt_datetime > now()
		group by calendar.id';
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

?>

<table border=1>
	<tr class="columns">
		<td colspan="2">Договір</td>
		<td colspan="4">Період</td>
	</tr>
	<tr class="columns">
		<td>Номер</td>
		<td>Дата</td>
		<td>Початок</td>
		<td>Кінець</td>
		<td>Сума, грн.</td>
		<td>Фактично сплачено, грн.</td>
	</tr>
	
	<?
		foreach ($list as $row){
			echo '<tr>';
			echo '<td>' . $row['policies_number'] . '</td>';
			echo '<td>' . $row['policies_date'] . '</td>';
			echo '<td>' . $row['begin'] . '</td>';
			echo '<td>' . $row['end'] . '</td>';
			echo '<td>' . getMoneyFormat($row['amount_calendar'],-1) . '</td>';
			echo '<td>' . getMoneyFormat($row['amount_fact'],-1) . '</td>';
			echo '</tr>';
		}
	?>
	
</table>