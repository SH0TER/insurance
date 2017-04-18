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
		<td rowspan="2">Дата</td>
		<td colspan="2">Рітейл</td>
		<td colspan="2">Укравтолізинг</td>
		<td colspan="2">Банк</td>
		<td colspan="2">Всього</td>
	</tr>
	<tr class="columns">
		<td>Кількість, шт.</td>
		<td>Сума, грн.</td>
		<td>Кількість, шт.</td>
		<td>Сума, грн.</td>
		<td>Кількість, шт.</td>
		<td>Сума, грн.</td>
		<td>Кількість, шт.</td>
		<td>Сума, грн.</td>
	</tr>
	<?
		$total['quantityRetail'] = 0;
		$total['amountRetail'] = 0;

		$total['amountLeasing'] = 0;
		$total['quantityLeasing'] = 0;

		$total['quantityBank'] = 0;
		$total['amountBank'] = 0;

		$total['quantity'] = 0;
		$total['amount'] = 0;

		if (sizeOf($list)) {
			$i = 0;
			foreach ($list as $row) {
				$i = 1 - $i;
	?>
	<tr class="<?=Form::getRowClass($row, $i)?>">
		<td><?=$row['datetimeFormat']?></td>
		<td align="right"><?=intval($row['quantityRetail'])?></td>
		<td align="right"><?=getMoneyFormat($row['amountRetail'], -1)?></td>
		<td align="right"><?=intval($row['quantityLeasing'])?></td>
		<td align="right"><?=getMoneyFormat($row['amountLeasing'], -1)?></td>
		<td align="right"><?=intval($row['quantityBank'])?></td>
		<td align="right"><?=getMoneyFormat($row['amountBank'], -1)?></td>
		<td align="right"><?=intval($row['quantity'])?></td>
		<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
	</tr>
	<?
			$total['quantityRetail'] += $row['quantityRetail']; 
			$total['amountRetail'] += $row['amountRetail'];

			$total['amountLeasing'] += $row['amountLeasing'];
			$total['quantityLeasing'] += $row['quantityLeasing'];

			$total['quantityBank'] += $row['quantityBank'];
			$total['amountBank'] += $row['amountBank'];

			$total['quantity'] += $row['quantity']; 
			$total['amount'] += $row['amount'];
			}
		}
	?>
	<tr class="navigation">
		<td class="paging">Всьго:</td>
		<td class="paging" align="right"><?=$total['quantityRetail']?></td>
		<td class="paging" align="right"><?=getMoneyFormat($total['amountRetail'], -1)?></td>
		<td class="paging" align="right"><?=$total['quantityLeasing']?></td>
		<td class="paging" align="right"><?=getMoneyFormat($total['amountLeasing'], -1)?></td>
		<td class="paging" align="right"><?=$total['quantityBank']?></td>
		<td class="paging" align="right"><?=getMoneyFormat($total['amountBank'], -1)?></td>
		<td class="paging" align="right"><?=$total['quantity']?></td>
		<td class="paging" align="right"><?=getMoneyFormat($total['amount'], -1)?></td>
	</tr>
</table>
</body>
</html>