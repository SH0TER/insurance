<html>
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
<style>
* {
	font-size: 11px;
	font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
}

.grey {
	background-color: #CCCCCC;
}

td {
	font-size: 20px;
}

.numbers{
	font-weight: bold !important;
	text-align: center !important;
}

.left_col{
	font-weight: bold !important;
	font-style: italic !important;
}

.top_col{
	font-weight: bold !important;
	text-align: center !important;
}
</style>
</head>
<body>
<table width="1000" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td colspan="2" height="105"><img src="http://e-insurance.in.ua/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	</tr>
	<tr>
		<td colspan="2" nowrap style="font-weight: bold; font-style: italic;">
			<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
				Звіт заявлених та врегульованих подій по договорам КАСКО, майно, вантажі, перегони
			<? } ?>
			<? if ($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
				Звіт заявлених та врегульваних подій по договору ОСЦПВ
			<? } ?>
		</td>
	</tr>
	<tr>
		<td>Звітній період:	<?=$data['from']?> по <?=$data['to']?></td>
		<td>Складено: <?=date('d.m.Y')?></td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="1000" border="1">
				<tr class="top_col">
					<td></td>
					<td><?=substr($data['from'], 6, 4)?>р.</td>
					<td>із них, за <?=mb_convert_case($MONTHES[intval(substr($data['from'], 3, 2)) - 1], MB_CASE_LOWER, "UTF-8")?> <?=substr($data['from'], 6, 4)?>р.</td>
					<td>із них, у звітний період</td>
				</tr>
				<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
				<tr>
					<td class="left_col">Кількість заявлених подій (письмове звернення), шт.</td>
					<td class="numbers"><?=$values['count_application_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_application_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_application_accidents_by_period']?></td>
				</tr>
				<? } ?>
				<? if ($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
				<tr>
					<td class="left_col">Кількість заявлених подій (письмове звернення ) від Страхувальників, шт.</td>
					<td class="numbers"><?=$values['count_application_insurer_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_application_insurer_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_application_insurer_accidents_by_period']?></td>
				</tr>
				<tr>
					<td class="left_col">Кількість заявлених подій (письмове звернення ) від Постраждалих, шт.</td>
					<td class="numbers"><?=$values['count_application_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_application_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_application_accidents_by_period']?></td>
				</tr>
				<? } ?>
				<tr>
					<td class="left_col">Кількість врегульованих подій, шт.</td>
					<td class="numbers"><?=$values['count_resolved_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_resolved_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_resolved_accidents_by_period']?></td>
				</tr>
				<tr>
					<td <? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>rowspan="2"<? } ?> class="left_col">Визнано страховими подіями та виплачено відшкодування, шт.<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?><br/>із них кількість компромісних виплат, шт.<? } ?></td>
					<td class="numbers"><?=$values['count_insurance1_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_insurance1_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_insurance1_accidents_by_period']?></td>
				</tr>
				<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
				<tr>
					<td class="numbers"><?=$values['count_compromise_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_compromise_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_compromise_accidents_by_period']?></td>
				</tr>				
				<tr>
					<td class="left_col">Відмовлено у відшкодуванні збитків, шт.</td>
					<td class="numbers"><?=$values['count_insurance3_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_insurance3_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_insurance3_accidents_by_period']?></td>
				</tr>
				<tr>
					<td class="left_col">Закрито без виплати відшкодування (франшиза більше збитку, за згодою зі страхувальником), шт.</td>
					<td class="numbers"><?=$values['count_insurance2_accidents_by_year']?></td>
					<td class="numbers"><?=$values['count_insurance2_accidents_by_month']?></td>
					<td class="numbers"><?=$values['count_insurance2_accidents_by_period']?></td>
				</tr>
				<? } ?>
				<? if ($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
				<tr>
					<td class="left_col">Відмовлено у відшкодуванні збитків, шт.</td>
					<td class="numbers"><?=($values['count_insurance3_accidents_by_year'] + $values['count_insurance2_accidents_by_year'])?></td>
					<td class="numbers"><?=($values['count_insurance3_accidents_by_month'] + $values['count_insurance2_accidents_by_month'])?></td>
					<td class="numbers"><?=($values['count_insurance3_accidents_by_period'] + $values['count_insurance2_accidents_by_period'])?></td>
				</tr>
				<? } ?>
				<tr>
					<td <? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>rowspan="2"<? } ?> class="left_col">Виплачено страхового відшкодування на суму, грн.<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?><br/>із них кількість компромісних виплат, грн.<? } ?></td>
					<td class="numbers"><?=$values['payed_compensation_by_year']?></td>
					<td class="numbers"><?=$values['payed_compensation_by_month']?></td>
					<td class="numbers"><?=$values['payed_compensation_by_period']?></td>
				</tr>
				<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
				<tr>
					<td class="numbers"><?=$values['payed_compensation_compromise_by_year']?></td>
					<td class="numbers"><?=$values['payed_compensation_compromise_by_month']?></td>
					<td class="numbers"><?=$values['payed_compensation_compromise_by_period']?></td>
				</tr>
				<? } ?>
				<tr>
					<td class="left_col">На Корпорацію "УкрАвто" сплачено, грн.</td>
					<td class="numbers"><?=$values['payed_compensation_ukrauto_by_year']?></td>
					<td class="numbers"><?=$values['payed_compensation_ukrauto_by_month']?></td>
					<td class="numbers"><?=$values['payed_compensation_ukrauto_by_period']?></td>
				</tr>
				<tr>
					<td colspan="2" class="left_col">Кількість справ, які знаходяться у проваджені, шт.</td>
					<td colspan="2" class="numbers"><?=$values['count_accidents_in_work']?></td>
				</tr>
				<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
				<tr>
					<td colspan="2" class="left_col">з них експрес - справи, шт.</td>
					<td colspan="2" class="numbers"><?=$values['count_accidents_express_in_work']?></td>
				</tr>
				<? } ?>
				<tr>
					<td colspan="2" class="left_col">Резерв заявлених та не врегульованих подій становить, грн.</td>
					<td colspan="2" class="numbers"><?=$values['amount_rough_in_work']?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">Станом на <?=date('d.m.Y')?> р. <?=$values['count_accidents_in_payment']?> знаходяться в бухгалтерії на суму <?=getRateFormat($values['amount_in_payment'], 2)?> грн.;</td>
	</tr>
	<tr>
		<td colspan="2"><?=$values['count_accidents_in_approval']?> підготовлені для передачі в бухгалтерію на суму <?=getRateFormat($values['amount_in_approval'], 2)?> грн., <? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>з них <?=$values['count_accidents_express_in_approval']?> експрес-справ на суму <?=getRateFormat($values['amount_express_in_approval'], 2)?> грн.<? } ?></td>
	</tr>
	<tr>
		<td colspan="2">також <?=$values['count_accidents_insurance23_in_approval']?> відмов на суму <?=getRateFormat($values['amount_insurance23_in_approval'], 2)?> грн., <? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>з них <?=$values['count_accidents_express_insurance23_in_approval']?> експрес-справ на суму <?=getRateFormat($values['amount_express_insurance23_in_approval'], 2)?> грн.<? } ?></td>
	</tr>
</table>
</body>
</html>