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
							<td colspan="3">Каско, кредит</td>
							<td colspan="3">Каско, рiтейл</td>
							<td rowspan="2">Каско, не кредит</td>
							<td rowspan="2">Каско, Пролонгацiя</td>
							<td colspan="3">ЦВ</td>
						</tr>
						<tr class="columns" align="center">
						<td>план</td>
						<td>факт</td>
						<td>% вик</td>
						<td>план</td>
						<td>факт</td>
						<td>% вик</td>
						<td>план</td>
						<td>факт</td>
						<td>% вик</td>
						</tr>
<?
	$i = 0;
	$result['kasko_bank']['quantity'] = 0;
							$result['kasko_not_bank']['quantity'] = 0;
							$result['kasko_continued']['quantity'] = 0;
							$result['go']['quantity'] = 0;



							foreach ($list as $id => $row) {
								$i = 1 - $i;

								$result['kasko_bank']['quantity'] += $row['kasko_bank']['quantity'];

								$result['kasko_not_bank']['quantity'] += $row['kasko_not_bank']['quantity'];
								$result['kasko_continued']['quantity'] += $row['kasko_continued']['quantity'];
								$result['go']['quantity'] += $row['go']['quantity'];
								
								$result['kasko_not_bank_plan']['quantity'] += $plans[$id][0];
								$result['kasko_continued_plan']['quantity'] += $plans[$id][1];
								$result['go_plan']['quantity'] += $plans[$id][2];

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td>' . $row['title'] . '</td>';

								echo '<td align="right">' . intval($plans[$id][0]) . '</td>';
								echo '<td align="right">' . intval($row['kasko_bank']['quantity']) . '</td>';
								echo '<td align="right">' . str_replace('.',',',round(intval($row['kasko_bank']['quantity'])*100/intval($plans[$id][0]),2)) . '</td>';
								
								echo '<td align="right">' . intval($plans[$id][1]) . '</td>';
								echo '<td align="right">' .  (intval($row['kasko_not_bank']['quantity'])+intval($row['kasko_continued']['quantity'])) . '</td>';
								echo '<td align="right">' .  str_replace('.',',',round((intval($row['kasko_not_bank']['quantity'])+intval($row['kasko_continued']['quantity']))*100/intval($plans[$id][1]),2)) . '</td>';
								
								echo '<td align="right">' .  intval($row['kasko_not_bank']['quantity']) . '</td>';
								echo '<td align="right">' .  intval($row['kasko_continued']['quantity'])  . '</td>';
								
								echo '<td align="right">' . intval($plans[$id][2]) . '</td>';
								echo '<td align="right">' . intval($row['go']['quantity']) . '</td>';
								echo '<td align="right">' . str_replace('.',',',round(intval($row['go']['quantity'])*100/intval($plans[$id][2]),2)) . '</td>';
								
								echo '</tr>';
							}
?>

</table>
</body>
</html>