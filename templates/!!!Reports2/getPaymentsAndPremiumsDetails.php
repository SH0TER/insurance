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
<table width="100%" cellpadding="0" cellspacing="0">
	<tr class="columns">
		<td>Договір / Поліс</td>
		<td>Сума</td>
		<td>Дата</td>
	</tr>
	<?
		$total_amount = 0;
		foreach ($list as $row) {
	?>
	<tr>
		<td><?=$row['policies_number']?></td>
		<td><?=str_replace('.', ',', $row['payments_amount'])?></td>
		<td><?=$row['payments_date']?></td>
	</tr>
	<?
		$total_amount += $row['payments_amount'];
		}
	?>

	<tr class="navigation">
		<td>Всього: <?=sizeof($list)?></td>
		<td><?=getMoneyFormat($total_amount, -1)?></td>
		<td>&nbsp;</td>
	</tr>
</table>                           
</body>
</html>