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
	<td rowspan="2">Агенцiя</td>
	<td colspan="2">Каско, УкрАВТО</td>
	<td colspan="2">Каско, кредит без розбивки</td>
	<td colspan="2">Каско, кредит з розбивкою</td>
	<td colspan="2">Каско, лізинг без розбивки</td>
	<td colspan="2">Каско, лізинг з розбивкою</td>
	<td colspan="2">Каско, готівка без розбивки</td>
	<td colspan="2">Каско, готівка з розбивкою</td>
	<td colspan="2">ЦВ, створені</td>
	<td colspan="2">ЦВ, сплачені</td>
	<td colspan="2">ДСЦВ</td>
</tr>
<tr class="columns" align="center">
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
	<td>шт.</td>
	<td>грн.</td>
</tr>
<?
	$i = 0;
	$result['kasko_ukrauto']['quantity'] = 0;
	$result['kasko_ukrauto']['amount'] = 0;
	$result['kasko_bank_one']['quantity'] = 0;
	$result['kasko_bank_one']['amount'] = 0;
	$result['kasko_bank_many']['quantity'] = 0;
	$result['kasko_bank_many']['amount'] = 0;

	$result['kasko_leasing_one']['quantity'] = 0;
	$result['kasko_leasing_one']['amount'] = 0;
	$result['kasko_leasing_many']['quantity'] = 0;
	$result['kasko_leasing_many']['amount'] = 0;

	$result['kasko_cash_one']['quantity'] = 0;
	$result['kasko_cash_one']['amount'] = 0;
	$result['kasko_cash_many']['quantity'] = 0;
	$result['kasko_cash_many']['amount'] = 0;

	$result['go_created']['quantity'] = 0;
	$result['go_created']['amount'] = 0;

	$result['go_payed']['quantity'] = 0;
	$result['go_payed']['amount'] = 0;

	$result['dgo']['quantity'] = 0;
	$result['dgo']['amount'] = 0;

	foreach ($list as $id => $row) {
		$i = 1 - $i;

		$result['kasko_ukrauto']['quantity'] += $row['kasko_ukrauto']['quantity'];
		$result['kasko_ukrauto']['amount'] += $row['kasko_ukrauto']['amount'];

		$result['kasko_bank_one']['quantity'] += $row['kasko_bank_one']['quantity'];
		$result['kasko_bank_one']['amount'] += $row['kasko_bank_one']['amount'];
		$result['kasko_bank_many']['quantity'] += $row['kasko_bank_many']['quantity'];
		$result['kasko_bank_many']['amount'] += $row['kasko_bank_many']['amount'];

		$result['kasko_leasing_one']['quantity'] += $row['kasko_leasing_one']['quantity'];
		$result['kasko_leasing_one']['amount'] += $row['kasko_leasing_one']['amount'];
		$result['kasko_leasing_many']['quantity'] += $row['kasko_leasing_many']['quantity'];
		$result['kasko_leasing_many']['amount'] += $row['kasko_leasing_many']['amount'];

		$result['kasko_cash_one']['quantity'] += $row['kasko_cash_one']['quantity'];
		$result['kasko_cash_one']['amount'] += $row['kasko_cash_one']['amount'];
		$result['kasko_cash_many']['quantity'] += $row['kasko_cash_many']['quantity'];
		$result['kasko_cash_many']['amount'] += $row['kasko_cash_many']['amount'];

		$result['go_created']['quantity'] += $row['go_created']['quantity'];
		$result['go_created']['amount'] += $row['go_created']['amount'];
		$result['go_payed']['quantity'] += $row['go_payed']['quantity'];
		$result['go_payed']['amount'] += $row['go_payed']['amount'];

		$result['dgo']['quantity'] += $row['dgo']['quantity'];
		$result['dgo']['amount'] += $row['dgo']['amount'];

		echo '<tr class="' . $this->getRowClass($row, $i) . '">';
		echo '<td>' . $row['title'] . '</td>';

		echo '<td align="right">' . intval($row['kasko_ukrauto']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_ukrauto']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['kasko_bank_one']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_bank_one']['amount'], -1) . '</td>';
		echo '<td align="right">' . intval($row['kasko_bank_many']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_bank_many']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['kasko_leasing_one']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_leasing_one']['amount'], -1) . '</td>';
		echo '<td align="right">' . intval($row['kasko_leasing_many']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_leasing_many']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['kasko_cash_one']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_cash_one']['amount'], -1) . '</td>';
		echo '<td align="right">' . intval($row['kasko_cash_many']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_cash_many']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['go_created']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['go_created']['amount'], -1) . '</td>';
		echo '<td align="right">' . intval($row['go_payed']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['go_payed']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['dgo']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['dgo']['amount'], -1) . '</td>';
		
		echo '</tr>';
	}
?>
<tr class="navigation" style="font-weight: bold;">
	<td class="paging"><b>Всього:</b></td>
<?
	echo '<td align="right">' . intval($result['kasko_ukrauto']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_ukrauto']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['kasko_bank_one']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_bank_one']['amount'], -1) . '</td>';
	echo '<td align="right">' . intval($result['kasko_bank_many']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_bank_many']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['kasko_leasing_one']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_leasing_one']['amount'], -1) . '</td>';
	echo '<td align="right">' . intval($result['kasko_leasing_many']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_leasing_many']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['kasko_cash_one']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_cash_one']['amount'], -1) . '</td>';
	echo '<td align="right">' . intval($result['kasko_cash_many']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_cash_many']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['go_created']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['go_created']['amount'], -1) . '</td>';
	echo '<td align="right">' . intval($result['go_payed']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['go_payed']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['dgo']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['dgo']['amount'], -1) . '</td>';
?>
</tr>
</table>
</body>
</html>