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
<tr class="columns" align="center">
	<td>Месяц</td>
	<td>Заявленные</td>
	<td>Оплаченные</td>
	<td>Отказ</td>
	<td>Регрес</td>
	<td>Виплати, грн.</td>
</tr>
<?
	$i = 0;
	$declared	= 0;
	$payed		= 0;
	$rejected	= 0;
	$regres		= 0;
	$amount		= 0;
	foreach ($list as $id => $row) {
		$i = 1 - $i;

		$declared	+= $row['declared'];
		$payed		+= $row['payed'];
		$rejected	+= $row['rejected'];
		$regres		+= $row['regres'];
		$amount		+= $row['amount'];

		echo '<tr class="' . $this->getRowClass($row, $i) . '">';
		echo '<td>' . $row['date'] . '</td>';
		echo '<td>' . $row['declared'] . '</td>';
		echo '<td>' . $row['payed'] . '</td>';
		echo '<td>' . $row['rejected'] . '</td>';
		echo '<td>' . $row['regres'] . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['amount'], -1) . '</td>';
		echo '</tr>';
	}
?>
<tr class="navigation">
	<td class="paging"><b>Всього:</b></td>
	<td><b><?=$declared?></b></td>
	<td><b><?=$payed?></b></td>
	<td><b><?=$rejected?></b></td>
	<td><b><?=$regres?></b></td>
	<td align="right"><b><?=getMoneyFormat($amount, -1)?></b></td>
</tr>
</table>
</body>
</html>