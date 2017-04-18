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
<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<tr class="columns">
		<td rowspan="2">Номер</td>
		<td rowspan="2">Підприємство УкрАВТО</td>
		<td rowspan="2">Виплата, де Страхувальник - СТО УкрАВТО</td>
		<td colspan="3">Виплати на СТО без тих, де Страхувальник СТО</td>
		<td colspan="4">Страхові платежі (отримані) за період з</td>
		<td colspan="3">Питома вага платежів до виплат на СТО, %</td>
	</tr>
	<tr class="columns">
		<td>КАСКО</td>
		<td>ЦВ</td>
		<td>Всього</td>
		<td>КАСКО</td>
		<td>ЦВ</td>
		<td>інші види</td>
		<td>Всього</td>
		<td>КАСКО</td>
		<td>ЦВ</td>
		<td>Всьго</td>
	</tr>
	<?
		$i = 0;
		$amount_compensation_car_services_kiev = 0;
		$amount_compensation_kasko_kiev = 0;
		$amount_compensation_go_kiev = 0;
		$amount_premium_kasko_kiev = 0;
		$amount_premium_go_kiev = 0;
		$amount_premium_other_kiev = 0;
		foreach ($list_car_services_agency_kiev as $row) {
			++$i;
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row['title']?></td>
		<td align="right"><?=($row['amount_compensation_car_services'] == '' || $row['amount_compensation_car_services'] == 0) ? '0.00' : $row['amount_compensation_car_services']?></td>
		<td align="right"><?=($row['amount_compensation_kasko'] == '' || $row['amount_compensation_kasko'] == 0) ? '0.00' : $row['amount_compensation_kasko']?></td>
		<td align="right"><?=($row['amount_compensation_go'] == '' || $row['amount_compensation_go'] == 0) ? '0.00' : $row['amount_compensation_go']?></td>
		<td align="right"><?=(($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == '' || ($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == 0) ? '0.00' :($row['amount_compensation_kasko'] + $row['amount_compensation_go'])?></td>
		<td align="right"><?=$row['amount_premium_kasko']?></td>
		<td align="right"><?=$row['amount_premium_go']?></td>
		<td align="right"><?=$row['amount_premium_other']?></td>
		<td align="right"><?=($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other'])?></td>
		<td align="right"><?=calcRatio($row['amount_premium_kasko'], $row['amount_compensation_kasko'], 2)?></td>
		<td align="right"><?=calcRatio($row['amount_premium_go'], $row['amount_compensation_go'], 2)?></td>
		<td align="right"><?=calcRatio(($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other']), ($row['amount_compensation_kasko'] + $row['amount_compensation_go'] + $row['amount_compensation_car_services']), 2)?></td>
	</tr>
	<?
			$amount_compensation_car_services_kiev += $row['amount_compensation_car_services'];
			$amount_compensation_kasko_kiev += $row['amount_compensation_kasko'];
			$amount_compensation_go_kiev += $row['amount_compensation_go'];
			$amount_premium_kasko_kiev += $row['amount_premium_kasko'];
			$amount_premium_go_kiev += $row['amount_premium_go'];
			$amount_premium_other_kiev += $row['amount_premium_other'];
		}
	?>
	<tr class="navigation">
		<td class="paging" colspan="2">Всього по Київським підприємствам:</td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_car_services_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_go_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev + $amount_compensation_go_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_go_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_other_kiev, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev + $amount_premium_go_kiev + $amount_premium_other_kiev, -1)?></td>
		<td class="paging" align="right"><?=calcRatio($amount_premium_kasko_kiev, $amount_compensation_kasko_kiev, 2)?></td>
		<td class="paging" align="right"><?=calcRatio($amount_premium_go_kiev, $amount_compensation_go_kiev, 2)?></td>
		<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko_kiev + $amount_premium_go_kiev + $amount_premium_other_kiev), ($amount_compensation_kasko_kiev + $amount_compensation_go_kiev + $amount_compensation_car_services_kiev), 2)?></td>
</tr>

	<?
		$amount_compensation_car_services = 0;
		$amount_compensation_kasko = 0;
		$amount_compensation_go = 0;
		$amount_premium_kasko = 0;
		$amount_premium_go = 0;
		$amount_premium_other = 0;
		foreach ($list_car_services_agency_other as $row) {
			++$i;
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row['title']?></td>
		<td align="right"><?=($row['amount_compensation_car_services'] == '' || $row['amount_compensation_car_services'] == 0) ? '0.00' : $row['amount_compensation_car_services']?></td>
		<td align="right"><?=($row['amount_compensation_kasko'] == '' || $row['amount_compensation_kasko'] == 0) ? '0.00' : $row['amount_compensation_kasko']?></td>
		<td align="right"><?=($row['amount_compensation_go'] == '' || $row['amount_compensation_go'] == 0) ? '0.00' : $row['amount_compensation_go']?></td>
		<td align="right"><?=(($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == '' || ($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == 0) ? '0.00' :($row['amount_compensation_kasko'] + $row['amount_compensation_go'])?></td>
		<td align="right"><?=$row['amount_premium_kasko']?></td>
		<td align="right"><?=$row['amount_premium_go']?></td>
		<td align="right"><?=$row['amount_premium_other']?></td>
		<td align="right"><?=($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other'])?></td>
		<td align="right"><?=calcRatio($row['amount_premium_kasko'], $row['amount_compensation_kasko'], 2)?></td>
		<td align="right"><?=calcRatio($row['amount_premium_go'], $row['amount_compensation_go'], 2)?></td>
		<td align="right"><?=calcRatio(($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other']), ($row['amount_compensation_kasko'] + $row['amount_compensation_go'] + $row['amount_compensation_car_services']), 2)?></td>
	</tr>
	<?
			$amount_compensation_car_services += $row['amount_compensation_car_services'];
			$amount_compensation_kasko += $row['amount_compensation_kasko'];
			$amount_compensation_go += $row['amount_compensation_go'];
			$amount_premium_kasko += $row['amount_premium_kasko'];
			$amount_premium_go += $row['amount_premium_go'];
			$amount_premium_other += $row['amount_premium_other'];
		}
	?>
	<tr class="navigation">
		<td class="paging" colspan="2">Всього по регіональним підприємствам:</td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_car_services, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_go, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko + $amount_compensation_go, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_go, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_other, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko + $amount_premium_go + $amount_premium_other, -1)?></td>
		<td class="paging" align="right"><?=calcRatio($amount_premium_kasko, $amount_compensation_kasko, 2)?></td>
		<td class="paging" align="right"><?=calcRatio($amount_premium_go, $amount_compensation_go, 2)?></td>
		<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko + $amount_premium_go + $amount_premium_other), ($amount_compensation_kasko + $amount_compensation_go + $amount_compensation_car_services), 2)?></td>
	</tr>
	<tr class="navigation">
		<td class="paging"  colspan="2">Всього:</td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_car_services_kiev + $amount_compensation_car_services, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev + $amount_compensation_kasko, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_go_kiev + $amount_compensation_go, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev + $amount_compensation_go_kiev + $amount_compensation_kasko + $amount_compensation_go, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev + $amount_premium_kasko, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_go_kiev + $amount_premium_go, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_other_kiev + $amount_premium_other, -1)?></td>
		<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev + $amount_premium_kasko + $amount_premium_go_kiev + $amount_premium_go + $amount_premium_other_kiev + $amount_premium_other, -1)?></td>
		<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko_kiev + $amount_premium_kasko), ($amount_compensation_kasko_kiev + $amount_compensation_kasko), 2)?></td>
		<td class="paging" align="right"><?=calcRatio(($amount_premium_go_kiev + $amount_premium_go), ($amount_compensation_go_kiev + $amount_compensation_go), 2)?></td>
		<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko_kiev + $amount_premium_kasko + $amount_premium_go_kiev + $amount_premium_go + $amount_premium_other_kiev + $amount_premium_other), ($amount_compensation_kasko_kiev + $amount_compensation_go_kiev + $amount_compensation_kasko + $amount_compensation_go + $amount_compensation_car_services_kiev + $amount_compensation_car_services), 2)?></td>
	</tr>
</table>
</body>
</html>