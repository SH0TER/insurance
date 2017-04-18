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
	<td rowspan="3">Агенцiя, код</td>
	<td rowspan="3">Агенцiя, назва</td>
	<?
		$monthes = 0;
		$date = $startDate;
		while($date < $endDate) {
			$monthes++;
			echo '<td colspan="4">' . date('m.Y', $date) . '</td>';
			$date = getdate($date);
			$date = mktime(0, 0, 0, $date['mon'] + 1, $date['mday'], $date['year']);
		}
	?>
</tr>
<tr class="columns">
	<?
		for($i=0; $i < $monthes; $i++) {
			echo '<td colspan="2">КАСКО</td><td colspan="2">ЦВ</td>';
		}
	?>
</tr>
<tr class="columns">
	<?
		for($i=0; $i < $monthes; $i++) {
			echo '<td>шт.</td><td>грн.</td><td>шт.</td><td>грн.</td>';
		}
	?>
</tr>
<?
	$i = 0;
	foreach ($list as $id => $row) {
		$i = 1 - $i;

		echo '<tr class="' . $this->getRowClass($row, $i) . '">';
        echo '<td>' . $row['code'] . '</td>';
		echo '<td>' . $row['title'] . '</td>';

		$date = $startDate;
		while($date < $endDate) {
			echo '<td align="right">' . intval($row[ date('m.Y', $date) ]['kasko']['quantity']) . '</td>';
			echo '<td align="right">' . getMoneyFormat($row[ date('m.Y', $date) ]['kasko']['amount'], -1) . '</td>';			
			echo '<td align="right">' . intval($row[ date('m.Y', $date) ]['go']['quantity']) . '</td>';
			echo '<td align="right">' . getMoneyFormat($row[ date('m.Y', $date) ]['go']['amount'], -1) . '</td>';			

			$total[ date('m.Y', $date) ]['kasko']['quantity'] += intval($row[ date('m.Y', $date) ]['kasko']['quantity']);
			$total[ date('m.Y', $date) ]['kasko']['amount'] += $row[ date('m.Y', $date) ]['kasko']['amount'];
			$total[ date('m.Y', $date) ]['go']['quantity'] += intval($row[ date('m.Y', $date) ]['go']['quantity']);
			$total[ date('m.Y', $date) ]['go']['amount'] += $row[ date('m.Y', $date) ]['go']['amount'];

			$date = getdate($date);
			$date = mktime(0, 0, 0, $date['mon'] + 1, $date['mday'], $date['year']);
		}
		echo '</tr>';
	}
?>
<tr class="navigation">
	<td class="paging" colspan="2"><b>Всього:</b></td>
	<?
		$date = $startDate;
		while($date < $endDate) {
			echo '<td align="right"><b>' . intval($total[ date('m.Y', $date) ]['kasko']['quantity']) . '</b></td>';
			echo '<td align="right"><b>' . getMoneyFormat($total[ date('m.Y', $date) ]['kasko']['amount'], -1) . '</b></td>';
			echo '<td align="right"><b>' . intval($total[ date('m.Y', $date) ]['go']['quantity']) . '</b></td>';
			echo '<td align="right"><b>' . getMoneyFormat($total[ date('m.Y', $date) ]['go']['amount'], -1) . '</b></td>';

			$date = getdate($date);
			$date = mktime(0, 0, 0, $date['mon'] + 1, $date['mday'], $date['year']);
		}
	?>
</tr>
</table>
</body>
</html>