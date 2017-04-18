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
		<td rowspan="2">Агенція</td>
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
		if (sizeOf($regions)) {
			$i = 0;
			$plan_amount = 0;
			$plan_quantity = 0;
			$fact_amount = 0;
			$fact_quantity = 0;
			foreach ($regions as $row) {
				$i = 1 - $i;
	?>
	<tr class="<?=Form::getRowClass($row, $i)?>">
		<td><?=$list[ $row['regions_id'] ][ $row['agencies_id'] ]['regions_title']?></td>
		<td><?=$list[ $row['regions_id'] ][ $row['agencies_id'] ]['agencies_title']?></td>

		<td align="right"><?=intval($list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_quantity'])?></td>
		<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_amount'], -1)?></td>

		<td align="right"><?=intval($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_quantity'])?></td>
		<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_amount'], -1)?></td>

		<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_quantity'] / $list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_quantity'] * 100, -1)?></td>
		<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_amount'] / $list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_amount'] * 100, -1)?></td>
	</tr>
	<?
			}
		}
	?>
</table>
</body>
</html>