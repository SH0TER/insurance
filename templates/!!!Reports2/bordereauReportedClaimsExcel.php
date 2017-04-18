<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Бордеро заявлених збитків</title>
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
			border-right: 1px solid #FFFFFF;
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #FFFFFF;
			background-color: #008575;
		}
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr class="columns">
	<td colspan="2">Договір страхування</td>
	<td rowspan="2">Страхувальник</td>
	<td rowspan="2">Транспортний засіб</td>
	<td rowspan="2">Номер кузова/шасі</td>
	<td rowspan="2">Державний реєстраційний номер</td>
	<td colspan="2">Період страхування</td>
	<td rowspan="2">Страхова сума, грн.</td>
	<td rowspan="2">Дата випадку</td>
	<td rowspan="2">Ризик</td>
	<td rowspan="2">Сплачено відшкодування, грн.</td>
	<td rowspan="2">Орієнтовний збиток, грн.</td>
	<td rowspan="2">Регрес</td>
</tr>
<tr class="columns">
	<td>№</td>
	<td>Дата</td>
	<td>з</td>
	<td>до</td>
</tr>
<?
	if (sizeOf($list )) {
		foreach ($list as $row) {
			$i = 1 - $i;
?>
<tr>
	<td><?=$row['number']?></td>
	<td><?=$row['policiesDate']?></td>
	<td><?=$row['insurer']?></td>
	<td><?=$row['brand']?> <?=$row['model']?></td>
	<td><?=$row['shassi']?></td>
	<td><?=$row['sign']?></td>
	<td><?=$row['begin_datetimeFormat']?></td>
	<td><?=$row['interrupt_datetimeFormat']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['car_price'], -1)?></td>
	<td><?=$row['eventsDateTime']?></td>
	<td><?=$row['risksTitle']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['estimatesAmount'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['amountRough'], -1)?></td>
	<td><?=($row['regres']) ? 'так' : 'ні'?></td>
</tr>
<?
		}
	}
?>
</table>
</body>
</html>