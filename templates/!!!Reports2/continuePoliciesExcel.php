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
		<td>Номер</td>
		<td>Дата</td>
		<td>Страхувальник</td>
        <td>ІПН/ЄДРПОУ</td>
        <td>Адреса</td>
		<td>Об'єкт</td>
		<td>Телефон</td>
		<td>Сума, грн.</td>
		<td>Тариф, %</td>
		<td>Премія, грн.</td>
		<td>Сплата</td>
		<td>Початок</td>
		<td>Закінчення</td>
        <td>Багаторічний</td>
		<td>Номер платежу (розбивка)</td>
		<td>Агенція</td>
		<td>Область</td>
		<td>Банк</td>
		<td>Кузов</td>
		<td>Держ номер</td>
		<td>Пролонгація</td>
		<td>Картка Експрес Асістанс</td>
	</tr>
	<?
		if (sizeOf($list)) {
			$i = 0;
			foreach ($list as $row) {
				$i = 1 - $i;
	?>
	<tr class="<?=Form::getRowClass($row, $i)?>">
		<td><?=$row['number']?></td>
		<td><?=$row['date_format']?></td>
		<td><?=$row['insurer']?></td>
        <td><?=$row['insurer_identification']?></td>
        <td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
		<td><?=$row['item']?></td>
		<td><?=$row['insurer_phone']?></td>
		<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
		<td align="right"><?=getRateFormat($row['rate'])?></td>
		<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
		<td><?=$row['payments_datetime_format'];?></td>
		<td><?=$row['begin_datetime_format']?></td>
		<td><?=$row['interrupt_datetime_format']?></td>
        <td><?=$row['long_term']?></td>
		<td><?=$row['number_payment_year']?></td>
		<td><?=$row['agencies_title']?></td>
		<td><?=$row['regions_title']?></td>
		<td><?=$row['financial_institutions_title']?></td>
		<td><?=$row['shassi']?></td>
		<td><?=$row['sign']?></td>
		<td><?=$row['prolongation_number']?></td>
		<td><?=$row['card_assistance']?></td>
	</tr>
	<?
			}
		}
	?>
</table>
</body>
</html>