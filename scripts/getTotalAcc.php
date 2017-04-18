<?

require_once '../include/collector.inc.php';

$sql = 'select accidents.id, accidents.number, if(years_payments.policies_id > 0, years_payments.item_price, items.car_price) as price, accident_statuses.title as accident_statuses_title
		from insurance_accidents as accidents
		join insurance_accidents_kasko as accidents_kasko on accidents.id = accidents_kasko.accidents_id
		join insurance_accident_statuses as accident_statuses on accidents.accident_statuses_id = accident_statuses.id
		join insurance_policies_kasko_items as items on accidents_kasko.items_id = items.id
		left join insurance_policies_kasko_item_years_payments as years_payments on accidents_kasko.items_id = years_payments.items_id and accidents.datetime between years_payments.date and adddate(years_payments.date, interval 1 year)
		where accidents.product_types_id = 3 and accidents.date between \'2013-01-01\' and \'2014-09-05\' and isAccidentsTotal(accidents.id) = 1';
$accidents = $db->getAll($sql);

$values = array();

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table>
		<tr class="columns">
			<td>Номер справи</td>
			<td>Статус</td>
			<td>Страхова сума</td>
			<td>Сума</td>
			<td>Дата</td>
		</tr>';

foreach($accidents as $accident) {
	$sql = 'select acts.amount, max(calendar.payment_date) as payment_date
			from insurance_accidents_acts as acts
			join insurance_accident_payments_calendar as calendar on acts.id = calendar.acts_id
			where acts.accidents_id = ' . intval($accident['id']);
	$acts = $db->getRow($sql);
	
	echo '<tr>
			<td>' . $accident['number'] . '</td>
			<td>' . $accident['accident_statuses_title'] . '</td>
			<td>' . $accident['price'] . '</td>
			<td>' . $acts['amount'] . '</td>
			<td>' . $acts['payment_date'] . '</td>
		</tr>';	
}

echo '</table>';

?>