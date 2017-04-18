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
	<td>Каско, УкрАВТО</td>
	<td>Каско, кредит</td>
	<td>Каско, лізинг</td>
	<td>Каско, готівка</td>
	<td>ЦВ</td>
	<td>ДСЦВ</td>
</tr>
<?
	$i = 0;
	$result['kasko_ukrauto']['quantity'] = 0;
	$result['kasko_bank_one']['quantity'] = 0;
	$result['kasko_bank_many']['quantity'] = 0;

	$result['kasko_leasing_one']['quantity'] = 0;
	$result['kasko_leasing_many']['quantity'] = 0;

	$result['kasko_cash_one']['quantity'] = 0;
	$result['kasko_cash_many']['quantity'] = 0;

	$result['go']['quantity'] = 0;
	$result['dgo']['quantity'] = 0;

	foreach ($list as $id => $row) {
		$i = 1 - $i;

		$result['kasko_ukrauto']['quantity'] += $row['kasko_ukrauto']['quantity'];

		$result['kasko_bank_one']['quantity'] += $row['kasko_bank_one']['quantity'];
		$result['kasko_bank_many']['quantity'] += $row['kasko_bank_many']['quantity'];

		$result['kasko_leasing_one']['quantity'] += $row['kasko_leasing_one']['quantity'];
		$result['kasko_leasing_many']['quantity'] += $row['kasko_leasing_many']['quantity'];

		$result['kasko_cash_one']['quantity'] += $row['kasko_cash_one']['quantity'];
		$result['kasko_cash_many']['quantity'] += $row['kasko_cash_many']['quantity'];

		$result['go']['quantity'] += $row['go']['quantity'];
		$result['go']['amount'] += $row['go']['amount'];

		$result['dgo']['quantity'] += $row['dgo']['quantity'];
		$result['dgo']['amount'] += $row['dgo']['amount'];

		echo '<tr class="' . $this->getRowClass($row, $i) . '">';
		echo '<td>' . $row['title'] . '</td>';

		echo '<td align="right">' . intval($row['kasko_ukrauto']['quantity']) . '</td>';
		echo '<td align="right">' . (intval($row['kasko_bank_one']['quantity'])+intval($row['kasko_bank_many']['quantity'])) . '</td>';
		echo '<td align="right">' . (intval($row['kasko_leasing_one']['quantity'])+intval($row['kasko_leasing_many']['quantity'])) . '</td>';
		echo '<td align="right">' . (intval($row['kasko_cash_one']['quantity'])+intval($row['kasko_cash_many']['quantity'])) . '</td>';
		echo '<td align="right">' . intval($row['go']['quantity']) . '</td>';
		echo '<td align="right">' . intval($row['dgo']['quantity']) . '</td>';

		echo '</tr>';
	}
?>

</table>
</body>
</html>