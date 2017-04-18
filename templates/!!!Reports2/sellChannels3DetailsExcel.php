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
	<td>Агенцiя</td>
	<td>Номер полiсу</td>
	<td>Страхувальник</td>
	<td>Авто</td>
	<td>Цiна</td>
	<td>Премiя</td>
	<td>Платiж</td>
	<td>Комiсiя агент %</td>
	<td>Комiсiя агент грн</td>
	<td>Комiсiя директор %</td>
	<td>Комiсiя директор грн</td>
	<td>Комiсiя заступник %</td>
	<td>Комiсiя заступник грн</td>
	<td>Тип</td>
</tr>
<?
	$i = 0;
	 

	foreach ($list as $id => $row) {
		$i = 1 - $i;

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td>' . $row['title'] . '</td>';
								echo '<td>' . $row['number'] . '</td>';
								echo '<td>' . $row['insurer'] . '</td>';
								echo '<td>' . $row['item'] . '</td>';
								
								echo '<td align="right">' . getMoneyFormat($row['price'], -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['amount'], -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['payment_amount'], -1) . '</td>';
								
								echo '<td align="right">' . getMoneyFormat(round($row['commission_agent_amount']*100/$row['payment_amount'],2), -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['commission_agent_amount'], -1) . '</td>';
								
								echo '<td align="right">' . getMoneyFormat(round($row['commission_director1_amount']*100/$row['payment_amount'],2), -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['commission_director1_amount'], -1) . '</td>';
								
								echo '<td align="right">' . getMoneyFormat(round($row['commission_director2_amount']*100/$row['payment_amount'],2), -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['commission_director2_amount'], -1) . '</td>';

								
								echo '<td align="right">' . $row['type'] . '</td>';
								
								echo '</tr>';
	}
?>

</table>
</body>
</html>