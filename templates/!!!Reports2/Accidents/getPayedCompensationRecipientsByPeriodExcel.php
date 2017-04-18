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
<? if (sizeOf($values)) {?>
					<table width="100%" cellpadding="0" cellspacing="0"  border="1">
						<tr class="columns">
							<td>Контрагенти</td>
							<? foreach ($periods_format as $period_format) {
								echo '<td>Всього ' . $period_format['begin'] . ' по ' . $period_format['end'] . '</td>';
							} ?>
							<td>Всього за <?=mb_convert_case($MONTHES[intval($data['month']) - 1], MB_CASE_LOWER, "UTF-8")?> <?=$data['year']?>р.</td>
						</tr>
						<?
							$total_payed_amount_periods = array();
							foreach ($values as $alias => $row) {
								$total_payed_amount_recipient = 0;																
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['title']?></td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td align="right">' . getRateFormat($row[$key]['payed_amount'], 2) . '</td>';
								$total_payed_amount_recipient += $row[$key]['payed_amount'];
								if ($alias != 'ukravto_total') {									
									$total_payed_amount_periods[$key] += $row[$key]['payed_amount'];
								}
							} 
							echo '<td align="right">' . getRateFormat($total_payed_amount_recipient, 2) . '</td>';
							if ($alias != 'ukravto_total') {
								$total_payed_amount_periods[-1] += $total_payed_amount_recipient;
							}
							?>
						</tr>
						<?
							}
						?>
						<tr class="columns">
							<td>Всього</td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td align="right">' . getRateFormat($total_payed_amount_periods[$key], 2) . '</td>';
							} ?>
							<td align="right"><?=getRateFormat($total_payed_amount_periods[-1], 2)?></td>
						</tr>
					</table>
					<? } ?>
</body>
</html>