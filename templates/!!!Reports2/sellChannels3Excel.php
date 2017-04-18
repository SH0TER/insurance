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
	<td colspan="2">Каско, кредит</td>
	<td colspan="2">Каско, не кредит</td>
	<td colspan="2">Каско, Пролонгацiя</td>
	<td colspan="2">ЦВ</td>
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
</tr>
<?
	$i = 0;
	$result['kasko_bank']['quantity'] = 0;
	$result['kasko_bank']['amount'] = 0;
	$result['kasko_not_bank']['quantity'] = 0;
	$result['kasko_not_bank']['amount'] = 0;
	$result['kasko_continued']['quantity'] = 0;
	$result['kasko_continued']['amount'] = 0;

	$result['go']['quantity'] = 0;
	$result['go']['amount'] = 0;

	foreach ($list as $id => $row) {
		$i = 1 - $i;

		$result['kasko_bank']['quantity'] += $row['kasko_bank']['quantity'];
		$result['kasko_bank']['amount'] += $row['kasko_bank']['amount'];

		$result['kasko_not_bank']['quantity'] += $row['kasko_not_bank']['quantity'];
		$result['kasko_not_bank']['amount'] += $row['kasko_not_bank']['amount'];
		$result['kasko_continued']['quantity'] += $row['kasko_continued']['quantity'];
		$result['kasko_continued']['amount'] += $row['kasko_continued']['amount'];

		$result['go']['quantity'] += $row['go']['quantity'];
		$result['go']['amount'] += $row['go']['amount'];

		echo '<tr class="' . $this->getRowClass($row, $i) . '">';
		echo '<td>' . $row['title'] . '</td>';

		echo '<td align="right">' . intval($row['kasko_bank']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_bank']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['kasko_not_bank']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_not_bank']['amount'], -1) . '</td>';
		echo '<td align="right">' . intval($row['kasko_continued']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['kasko_continued']['amount'], -1) . '</td>';

		echo '<td align="right">' . intval($row['go']['quantity']) . '</td>';
		echo '<td align="right">' . getMoneyFormat($row['go']['amount'], -1) . '</td>';
		
		echo '</tr>';
	}
?>
<tr class="navigation" style="font-weight: bold;">
	<td class="paging"><b>Всього:</b></td>
<?
	echo '<td align="right">' . intval($result['kasko_bank']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_bank']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['kasko_not_bank']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_not_bank']['amount'], -1) . '</td>';
	echo '<td align="right">' . intval($result['kasko_continued']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['kasko_continued']['amount'], -1) . '</td>';

	echo '<td align="right">' . intval($result['go']['quantity']) . '</td>';
	echo '<td align="right">' . getMoneyFormat($result['go']['amount'], -1) . '</td>';
?>
</tr>
</table>
</body>
</html>