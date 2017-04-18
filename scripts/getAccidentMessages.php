<?

require_once '../include/collector.inc.php';

$conditions[] = 'accident_messages.decision between \'2014-01-01 00:00:00\' and \'2014-05-31 23:59:59\'';
$conditions[] = 'accident_messages.message_types_id in(5)';

$sql = 'select accidents.number as accidents_number, policies.insurer as insurer, if(accidents.product_types_id = 3, concat_ws(\' \', items.brand, items.model), concat_ws(\' \', policies_go.brand, policies_go.model)) as item, 
			if(accidents.product_types_id = 3, items.sign, policies_go.sign) as sign, concat_ws(\' \', account_average_managers.lastname, account_average_managers.firstname) as average_manager,
			concat_ws(\' \', account_estimate_managers.lastname, account_estimate_managers.firstname) as estimate_manager, accident_messages.answer,
			date_format(accident_messages.created, \'%d.%m.%Y\') as created, date_format(accident_messages.decision, \'%d.%m.%Y\') as decision, date_format(accident_messages.modified, \'%d.%m.%Y\') as modified
		from insurance_accidents as accidents
		join insurance_policies as policies on accidents.policies_id = policies.id
		left join insurance_accidents_kasko as accidents_kakso on accidents.id = accidents_kakso.accidents_id
		join insurance_accident_messages as accident_messages on accidents.id = accident_messages.accidents_id
		left join insurance_policies_kasko_items as items on accidents.policies_id = items.policies_id and accidents_kakso.items_id = items.id
		left join insurance_policies_go as policies_go on accidents.policies_id = policies_go.policies_id
		join insurance_accounts as account_average_managers on accidents.average_managers_id = account_average_managers.id
		join insurance_accounts as account_estimate_managers on accidents.estimate_managers_id = account_estimate_managers.id
		where ' . implode(' AND ', $conditions);
$list = $db->getAll($sql);

$sql = 'select id, title from insurance_car_services';
$temp = $db->getAll($sql);

$car_services = array();
foreach ($temp as $t) $car_services[$t['id']] = $t['title'];


header('Content-Disposition: attachment; filename="accident_messages_5.xls"');
header('Content-Type: ' . Form::getContentType('accident_messages_5.xls'));

?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
<style>
* {
	font-size: 11px;
	font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
}
.columns TD {
	height: 25px;
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background-color: #008575;
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td>Номер справи</td>
			<td>Страхувальник</td>
			<td>ТЗ</td>
			<td>Держ. номер</td>
			<td>Аварійний комісар</td>
			<td>Експерт</td>
			<td>Клас ремонту</td>
			<td>Ринкова вартість</td>
			<td>Залишки</td>
			<td>Коефіцієнт зносу</td>
			<td>СТО</td>
			<td>Сума</td>
			<td>Коментар</td>			
			<td>Створено</td>
			<td>Рішення</td>
			<td>Редаговано</td>
		</tr>
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
					$answer = unserialize($row['answer']);
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['accidents_number']?></td>
			<td><?=$row['insurer']?></td>
			<td><?=$row['item']?></td>
			<td><?=$row['sign']?></td>
			<td><?=$row['average_manager']?></td>
			<td><?=$row['estimate_manager']?></td>
			<td><?=$answer['repair_classifications_id'];?></td>
			<td><?=$answer['market_price']?></td>
			<td><?=$answer['amount_residual']?></td>
			<td><?=$answer['deterioration_value']?></td>
			<td><?=$car_services[$answer['result_calculation_car_services_id']]?></td>
			<td><?=($answer['amount_details'] + $answer['amount_material'] + $answer['amount_work'])?></td>
			<td><?=$answer['comment_answer']?></td>
			<td><?=$row['created']?></td>
			<td><?=$row['decision']?></td>
			<td><?=$row['modified']?></td>			
		</tr>
		<?
				}
			}
		?>
	</table>
</body>
</html>