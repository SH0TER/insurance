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
<? if(!intval($data['types_id'])) { ?>
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
			<td>Головна агенція</td>
			<td>Агенція</td>
			<td>Область</td>
			<td>Банк</td>
			<td>Кузов</td>
			<td>Держ номер</td>
			<td>Пролонгація</td>
			<td>Рік страхування</td>
			<td>Додаткова угода</td>
			<td>Другий платіж "50/50"</td>
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
			<td><?=$row['policies_number']?></td>
			<td><?=$row['policies_date']?></td>
			<td><?=$row['insurer']?></td>
			<td><?=$row['insurer_identification']?></td>
			<td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td><?=$row['item']?></td>
			<td><?=$row['insurer_phone']?></td>
			<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td align="right"><?=getRateFormat($row['rate'])?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
			<td><?=$row['payments_date'];?></td>
			<td><?=$row['begin_datetime_format']?></td>
			<td><?=$row['interrupt_datetime_format']?></td>
			<td><?=$row['long_term']?></td>
			<td><?=$row['number_part_payment']?></td>
			<td><?=$row['agencies_parent_title']?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['regions_title']?></td>
			<td><?=$row['financial_institutions_title']?></td>
			<td><?=$row['shassi']?></td>
			<td><?=$row['sign']?></td>
			<td><?=$row['prolongation_number']?></td>
			<td><?=$row['number_insurance_year']?></td>
			<td><?=$row['is_agr_title']?></td>
			<td><?=$row['second_fifty_fifty_title']?></td>
			<td><?=$row['agency_types_title']?></td>
			<td><?=$row['seller']?></td>
			<td><?=$row['card_assistance']?></td>
		</tr>
		<?
				}
			}
		?>
	</table>
<? } else { ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td rowspan="3"></td>
			<td colspan="6">Банк</td>
			<td colspan="6">Рітейл</td>
		</tr>
		<tr class="columns">
			<td colspan="2">Новий</td>
			<td colspan="2">Пролонгація</td>
			<td colspan="2">Додаткова угода<br/>Другий платіж "50/50"</td>
			<td colspan="2">Новий</td>
			<td colspan="2">Пролонгація</td>
			<td colspan="2">Додаткова угода<br/>Другий платіж "50/50"</td>
		</tr>
		<tr class="columns">
			<td>шт.</td>
			<td>грн.</td>
			<td>шт.</td>
			<td>грн.</td>
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
			if (sizeOf($values)) {
				foreach ($values as $row) {
		?>
		<tr>
			<td><?=$row['title']?></td>
			<td><?=intval($row['data']['bank']['new']['count'])?></td>
			<td><?=getMoneyFormat($row['data']['bank']['new']['amount'], -1)?></td>
			<td><?=intval($row['data']['bank']['prolong']['count'])?></td>
			<td><?=getMoneyFormat($row['data']['bank']['prolong']['amount'], -1)?></td>
			<td><?=intval($row['data']['bank']['agr']['count'])?></td>
			<td><?=getMoneyFormat($row['data']['bank']['agr']['amount'], -1)?></td>
			<td><?=intval($row['data']['retail']['new']['count'])?></td>
			<td><?=getMoneyFormat($row['data']['retail']['new']['amount'], -1)?></td>
			<td><?=intval($row['data']['retail']['prolong']['count'])?></td>
			<td><?=getMoneyFormat($row['data']['retail']['prolong']['amount'], -1)?></td>
			<td><?=intval($row['data']['retail']['agr']['count'])?></td>
			<td><?=getMoneyFormat($row['data']['retail']['agr']['amount'], -1)?></td>
		</tr>
		<?
				}
			}
		?>
	</table>
<? } ?>
</body>
</html>