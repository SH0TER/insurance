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
<? if (is_array($list)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
        <td>Номер договору</td>
		<td>Дата початку дії</td>
		<td>Дата закінчення дії</td>
		<td>Страхувальник</td>
		<td>Бренд</td>
		<td>Держ. номер</td>
		<td>Страхова сума по договору</td>
		<td>Тариф по договору</td>
		<td>Страхова премія по договору</td>
		<td>Отримано по договору</td>
		<td>Дата сплати</td>
		<td>Продукт</td>
		<td>Банк</td>
		<td>Тариф по об'єкту</td>
		<td>Премія по об'єкту</td>
		<td>Компенсація банку</td>
		<td>Знижка для банків</td>
		<td>Комісія агента, %</td>
		<td>Комісія директор, грн.</td>
		<td>Комісія заступника, грн.</td>
		<td>Кількість заявлених збитків</td>
		<td>Сума заявлених збитків</td>
		<td>Кількість сплачених збитків</td>
		<td>Сума оплачених збитків</td>
    </tr>
    <?
        $i = 0;
		$amount = 0;
        foreach ($list as $row) {
            $i = 1 - $i;
    ?>
        <tr>
            <td><?=$row['policies_number']?></td>
			<td><?=$row['begin']?></td>
			<td><?=$row['end']?></td>
			<td><?=$row['insurer']?></td>
			<td><?=$row['brand']?></td>
			<td><?=$row['sign']?></td>
			<td><?=getRateFormat($row['policies_insurance_price'], 2)?></td>
			<td style='mso-number-format:"0\.000"'><?=$row['policies_rate']?></td>
			<td><?=getRateFormat($row['policies_amount'], 2)?></td>
			<td><?=getRateFormat($row['calendar_amount'], 2)?></td>
			<td><?=$row['payment_date']?></td>
			<td><?=$row['products_title']?></td>
			<td><?=$row['financtial_institutions_title']?></td>
			<td style='mso-number-format:"0\.000"'><?=$row['item_rate']?></td>
			<td><?=getRateFormat($row['item_amount'], 2)?></td>
			<td style='mso-number-format:"0\.000"'><?=$row['bank_commission_value']?></td>
			<td style='mso-number-format:"0\.000"'><?=$row['bank_discount_value']?></td>
			<td style='mso-number-format:"0\.000"'><?=$row['commission_agent_percent']?></td>
			<td><?=getRateFormat($row['commission_director1_amount'], 2)?></td>
			<td><?=getRateFormat($row['commission_director2_amount'], 2)?></td>
			<td><?=intval($row['accidents_count'])?></td>
			<td><?=getRateFormat($row['accidents_amount_rough'], 2)?></td>
			<td><?=intval($row['accidents_resolved_count'])?></td>
			<td><?=getRateFormat($row['accidents_amount_payment'], 2)?></td>
        </tr>
    <?
        }
    ?>
	<tr class="columns">
		<td class="paging">Всього: <?=(sizeof($list))?></td>
		<td colspan="23">&nbsp;</td>
	</tr>
</table>
<? } ?>
</body>
</html>