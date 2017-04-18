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
 

<? if (is_array($list)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr class="columns">
						<td>ПIБ продавець</td>
						<td>Номер договору</td>
						<td>Рiтейл</td>
						<td>Дата договору</td>
						<td>ПIБ страхувальника</td>
						<td>Об'єкт</td>
						<td>Страх сума, грн</td>
						<td>Тариф %</td>
						<td>Страх премiя, грн</td>
						<td>Статус договору</td>
						<td>Оплата</td>
						<td>Дата сплати</td>
						<td>Автосалон</td>
						<td>Агент</td>
						<td>Банк</td>
					</tr>
<?
	if (sizeOf($list)) {
		foreach ($list as $row) {

		 
?>
<tr >
	<td><?=$row['seller']?></td>
					<td><?=$row['number']?></td>
					<td><?=($row['ritale']>0 ? 'Так':'Нi')?></td>
					<td><?=$row['policydate']?></td>
					<td><?=$row['insurer']?></td>
					<td><?=$row['item']?></td>
					<td><?=str_replace(',', '.',$row['price'])?></td>
					<td><?=str_replace(',', '.',$row['rate'])?></td>
					<td><?=str_replace(',', '.',$row['amount'])?></td>
					<td><?=$row['policystate']?></td>
					<td><?=$row['paymenttitle']?></td>
					<td><?=$row['paymentdate']?></td>
					<td><?=$row['agency']?></td>
					<td><?=$row['agent']?></td>
					<td><?=$row['bank']?></td>
</tr>
<?
		}
	}
?>
</table>
<? } ?>
</body>
</html>