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
<? if (!intval($data['types_id'])) { ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Страхувальник</td>
			<td>ІПН/ЄДРПОУ</td>
			<td>Адреса</td>
			<td>Об'єкт</td>
			<td>Телефон</td>
			<td>Сума, грн.</td>
			<td>Тариф, %</td>
			<td>Премія, грн.</td>
			<td>Сплата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Багаторічний</td>
			<td>Номер платежу (розбивка)</td>			
			<td>Агенція</td>
			<td>Область</td>
			<td>Банк</td>
			<td>Кузов</td>
			<td>Держ номер</td>
			<td>Пролонгація</td>
			<td>Рік страхування</td>
			<td>Канал продажів</td>
			<td>Продавець</td>
			<td>Картка Експрес Асістанс</td>
		</tr>
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['number']?></td>
			<td><?=$row['date_format']?></td>
			<td><?=$row['insurer']?></td>
			<td><?=$row['insurer_identification']?></td>
			<td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td><?=$row['item']?></td>
			<td><?=$row['insurer_phone']?></td>
			<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td align="right"><?=getRateFormat($row['rate'])?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
			<td><?=$row['payments_datetime_format'];?></td>
			<td><?=$row['begin_datetime_format']?></td>
			<td><?=$row['interrupt_datetime_format']?></td>
			<td><?=$row['long_term']?></td>
			<td><?=$row['number_payment_year']?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['regions_title']?></td>
			<td><?=$row['financial_institutions_title']?></td>
			<td><?=$row['shassi']?></td>
			<td><?=$row['sign']?></td>
			<td><?=$row['prolongation_number']?></td>
			<td><?=$row['number_insurance_year']?></td>
			<td><?=$row['agency_types_title']?></td>
			<td><?=$row['seller']?></td>
			<td><?=$row['card_assistance']?></td>
		</tr>
		<?
				}
			}
		?>
	</table>
<? } elseif (intval($data['types_id']) == 1) { ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td rowspan="2">Дата</td>
			<td colspan="2">Рітейл</td>
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
		</tr>
		<?
			$total['quantityRetail'] = 0;
			$total['amountRetail'] = 0;

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
			<td align="right"><?=intval($row['quantityBank'])?></td>
			<td align="right"><?=getMoneyFormat($row['amountBank'], -1)?></td>
			<td align="right"><?=intval($row['quantity'])?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
		</tr>
		<?
				$total['quantityRetail'] += $row['quantityRetail']; 
				$total['amountRetail'] += $row['amountRetail'];

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
			<td class="paging" align="right"><?=$total['quantityBank']?></td>
			<td class="paging" align="right"><?=getMoneyFormat($total['amountBank'], -1)?></td>
			<td class="paging" align="right"><?=$total['quantity']?></td>
			<td class="paging" align="right"><?=getMoneyFormat($total['amount'], -1)?></td>
		</tr>
	</table>
<? } elseif ($data['types_id'] == 2) { ?>
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
<? } else { ?>
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
<? } ?>
</body>
</html>