<style>
.columns TD {
	height: 25px;
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold !important;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background: #008575 url(../images/administration/tabBorder.gif);
}
</style>

<?

require_once '../include/collector.inc.php';

$sql = 'create temporary table temp_list
		select a.id as id, max(a.date) as date, a.policies_id, a.number
		from insurance_policy_payments_calendar a
		join insurance_policies b on a.policies_id = b.id
		where a.date <= now() and a.end_date >= now() and b.interrupt_datetime >= now() and b.product_types_id = 3 and a.statuses_id > 2 and a.amount > 0 and datediff(a.end_date, a.date) < 366 and a.valid = 1
		group by a.policies_id ';
$db->query($sql);

$sql = 'select c.number, a.date, b.end_date, f.item_price, b.amount, e.brand, e.model, e.year, e.engine_size, getCarParameters(3, e.car_engine_type_id) as car_engine_type_id, getCarParameters(1, e.car_body_id) as car_body_id,
			e.modification, concat_ws(\' \', g.lastname, g.firstname) as expert
		from temp_list a
		join insurance_policy_payments_calendar b on a.id = b.id
		join insurance_policies c on b.policies_id = c.id
		join insurance_policies_kasko d on c.id = d.policies_id
		join insurance_policies_kasko_items e on d.policies_id = e.policies_id
		join insurance_policies_kasko_item_years_payments f on e.policies_id = f.policies_id and e.id = f.items_id and a.date between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
		left join insurance_accounts g on e.expert_id = g.id
		order by b.date';
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата початку періоду</td>
			<td>Дата закінчення періоду</td>
			<td>Страхова сума за період</td>
			<td>Премія за період</td>
			<td>Марка</td>
			<td>Модель</td>
			<td>Рік випуску</td>
			<td>Об\'єм двигуна</td>
			<td>Пальне</td>
			<td>Кузов</td>
			<td>Модифікація</td>
			<td>Експерт</td>
		</tr>';

foreach ($list as $row) {

	echo '<tr>';
	foreach ($row as $key => $val){
		if (in_array($key, array('item_price', 'amount'))) echo '<td align="right">' . getMoneyFormat(floatval($val), -1) . '</td>';
		else echo '<td align="left">' . $val . '</td>';
	}
	echo '</tr>';
}

echo '</table>';

/*$sql = 'select b.number, date_format(getPolicyDate(b.number, 1), \'%d.%m.%Y\') as date, date_format(getPolicyDate(b.number, 2), \'%d.%m.%Y\') as begin, date_format(getPolicyDate(b.number, 3), \'%d.%m.%Y\') as end,
			if(c.insurer_person_types_id = 1, \'Ф\', \'Ю\') as person_types_id,
			if(c.insurer_person_types_id = 1, concat_ws(\' \', c.insurer_lastname, c.insurer_firstname, c.insurer_patronymicname), c.insurer_lastname) as insuerer,
			if(c.insurer_person_types_id = 1, c.insurer_identification_code, c.insurer_edrpou) as code
		from temp_list a
		join insurance_policies b on a.policies_id = b.id
		join insurance_policies_kasko c on b.id = c.policies_id
		order by b.date asc';
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата полісу</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Тип особи</td>
			<td>Страхувальник</td>
			<td>ІПН / ЄДРПОУ</td>
			<td>План</td>
			<td>Факт</td>
		</tr>';

foreach ($list as $row) {

	$sql = 'select sum(a.amount)
			from insurance_policy_payments_calendar a
			join insurance_policies b on a.policies_id = b.id
			where a.date between \'2014-01-01\' and now() and a.valid = 1 and b.number = ' . $db->quote($row['number']);
	$row['plan'] = $db->getOne($sql);
	
	$sql = 'select sum(a.amount)
			from insurance_policy_payments a
			join insurance_policies b on a.policies_id = b.id
			where a.datetime between \'2014-01-01\' and now() and b.number = ' . $db->quote($row['number']);
	$row['fact'] = $db->getOne($sql);

	echo '<tr>';
	foreach ($row as $key => $val){
		if (in_array($key, array('fact', 'plan'))) echo '<td>' . getMoneyFormat(floatval($val), -1) . '</td>';
		else echo '<td>' . $val . '</td>';
	}
	echo '</tr>';
}

echo '</table>';*/
	
?>