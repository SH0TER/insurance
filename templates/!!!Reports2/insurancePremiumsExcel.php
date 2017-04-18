<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Страхові премії</title>
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
			border-right: 1px solid #FFFFFF;
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #FFFFFF;
			background-color: #008575;
		}
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="3">
<tr class="columns">
                            <td>Страхувальник</td>
							<td colspan="4">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td colspan="4">Поліс</td>
                                    </tr>
                                    <tr>
                                        <td>Номер</td>
                                        <td>Дата початку</td>
                                        <td>Дата закінчення</td>
                                        <td>Статус</td>
                                    </tr>
                                </table>
							</td>
							<td>Назва продукту</td>
							<td>Код продукту</td>
                            <td>Сума</td>
                            <td>Дата</td>
							<td>Взаємозалік</td>
                            <td>
                                <table cellpadding="0" cellspacing="0">
                                    <tr class="columns">
                                        <td colspan="2">Повернення платежів</td>
                                    </tr>
                                    <tr class="columns">
                                        <td>Сума</td>
                                        <td>Дата</td>
                                    </tr>
                                </table>
							</td>
                            <td>Агенція</td>
                            <td>Код агенції</td>
                            <td>Відповідальний оператор</td>
                            <td>Код оператора</td>
                            <td>Банк</td>
                            <td>Код банку</td>
                            <td>Об'єкт страхування</td>
                            <td>Марка транспорту</td>
                            <td>Страхова сума</td>
                            <td>Тариф, %</td>
                            <td>Комісія агента, %</td>
                            <td>Комісія банку, %</td>
                            <td>Фізична/юридична особа (страхувальник)</td>
                            <td>Код страхувальника</td>
                        </tr>
<?
	if (sizeOf($list )) {
		foreach ($list as $row) {
            $payments = $db->getAll('SELECT amount, DATE_FORMAT(datetime, \'%d.%m.%Y\') as datetime_format, IF(LOCATE(\'вз\', doc_number), 1 , 0) as type FROM ' . PREFIX . '_policy_payments WHERE policies_id = ' . $row['policies_id'] . ' ORDER BY datetime ASC');
            foreach($payments as $payment){
?>
<tr>
    <td><?=$row['insurer_name']?></td>
    <td><?=$row['policies_number']?></td>
    <td><?=$row['policies_begin_datetime']?></td>
    <td><?=$row['policies_end_datetime']?></td>
    <td><?=$row['policies_statuses_title']?></td>
    <td><?=$row['products_title']?></td>
    <td><?=$row['products_code']?></td>
    <td><?=$payment['amount']?></td>
    <td><?=$payment['datetime_format']?></td>
    <td><?=$payment['type']?></td>
    <td>-</td>
    <td><?=$row['agencies_title']?></td>
    <td><?=$row['agencies_code']?></td>
    <td><?=$row['agents_name']?></td>
    <td><?=$row['agents_code']?></td>
    <td><?=$row['financial_institutions_title']?></td>
    <td><?=$row['financial_institutions_code']?></td>
    <td><?=$row['insured_object']?></td>
    <td><?=$row['insured_brand_auto']?></td>
    <td><?=$row['insured_amount']?></td>
    <td><?=$row['rate']?></td>
    <td><?=$row['agent_percent']?></td>
    <td><?=$row['financial_institution_commissions_percent']?></td>
    <td><?=$row['insurer_type_id']?></td>
    <td><?=$row['insurer_code']?></td>
</tr>
<? } } } ?>
</table>
</body>
</html>