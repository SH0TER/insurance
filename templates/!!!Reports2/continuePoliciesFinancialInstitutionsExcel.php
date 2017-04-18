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
		<td rowspan="2">Область</td>
		<td rowspan="2">Банк</td>
		<td colspan="2">План</td>
		<td colspan="2">Факт</td>
		<td colspan="2">Виконання, %</td>
	</tr>
	<tr class="columns">
		<td>Одиниць</td>
		<td>Сума, грн.</td>
		<td>Одиниць</td>
		<td>Сума, грн.</td>
		<td>Одиниць</td>
		<td>Сума, грн.</td>
	</tr>
	<?
		$i = 0;
		$j = 0;

		$plan_amount = 0;
		$plan_quantity = 0;
		$fact_amount = 0;
		$fact_quantity = 0;

		foreach ($list as $agencies_id => $row1) {
			foreach ($row1 as $financial_institutions_id => $row2) {
			$i = 1 - $i;

	?>
	<tr class="<?=Form::getRowClass($row2, $i)?>">
		<td><?=$list[ $agencies_id ][ $financial_institutions_id ]['regions_title']?></td>
		<td><?=$list[ $agencies_id ][ $financial_institutions_id ]['financial_institutions_title']?></td>

		<td align="right"><?=intval($list[ $agencies_id ][ $financial_institutions_id ]['plan_quantity'])?></td>
		<td align="right"><?=getMoneyFormat($list[ $agencies_id ][ $financial_institutions_id ]['plan_amount'], -1)?></td>

		<td align="right"><?=intval($list[ $agencies_id ][ $financial_institutions_id ]['fact_quantity'])?></td>
		<td align="right"><?=getMoneyFormat($list[ $agencies_id ][ $financial_institutions_id ]['fact_amount'], -1)?></td>

		<td align="right"><?=getMoneyFormat($list[ $agencies_id ][ $financial_institutions_id ]['fact_quantity'] / $list[ $agencies_id ][ $financial_institutions_id ]['plan_quantity'] * 100, -1)?></td>
		<td align="right"><?=getMoneyFormat($list[ $agencies_id ][ $financial_institutions_id ]['fact_amount'] / $list[ $agencies_id ][ $financial_institutions_id ]['plan_amount'] * 100, -1)?></td>
	</tr>
	<?
			$j++;
			$plan_amount = $plan_amount + $list[ $agencies_id ][ $financial_institutions_id ]['plan_amount'];
			$plan_quantity = $plan_quantity + $list[ $agencies_id ][ $financial_institutions_id ]['plan_quantity'];
			$fact_amount = $fact_amount + $list[ $agencies_id ][ $financial_institutions_id ]['fact_amount'];
			$fact_quantity = $fact_quantity + $list[ $agencies_id ][ $financial_institutions_id ]['fact_quantity'];
			}
		}
	?>
<tr class="navigation">
	<td class="paging" colspan="2">Всьго: <?=$j?></td>
	<td class="paging" align="right"><?=$plan_quantity?></td>
	<td class="paging" align="right"><?=getMoneyFormat($plan_amount, -1)?></td>
	<td class="paging" align="right"><?=$fact_quantity?></td>
	<td class="paging" align="right"><?=getMoneyFormat($fact_amount, -1)?></td>
	<td class="paging" align="right"><?=getMoneyFormat($fact_quantity / $plan_quantity * 100, -1)?></td>
	<td class="paging" align="right"><?=getMoneyFormat($fact_amount / $plan_amount * 100, -1)?></td>
</tr>
</table>
</body>
</html>