<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
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
    <table width="600" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <td align="center">Справа</td>
                <td align="center">Власник</td>
                <td align="center">ТЗ</td>
                <td align="center">Держ. номер</td>
                <td align="center">VIN</td>
                <td align="center">СТО, назва</td>
                <td align="center">СТО, ЄДРПОУ</td>
                <td align="center">Номер калькуляції (AUDATEX)</td>
                <td align="center">Дата калькуляції</td>
                <td align="center">Сума калькуляції</td>
                <td align="center">Дата замовлення ЗЧ</td>
                <td align="center">Дата заказ-наряду (початкова)</td>
                <td align="center">Сума заказ-наряду (початкова)</td>
                <td align="center">Автор заказ-наряду (початкового)</td>
                <td align="center">Дата заказ-наряду (кінцева)</td>
                <td align="center">Сума заказ-наряду (кінцева)</td>
                <td align="center">Франшиза</td>
                <td align="center">Автор заказ-наряду (початкового)</td>
                <td align="center">Дата останнього обміну</td>
                <td align="center">Створено</td>
        </tr>
        <?
            foreach ($list as $row) {
        ?>
        <tr>
            <td align="center" x:str><?=$row['accidents_number']?></td>
            <td align="center"><?=$row['insurer']?></td>
            <td align="center"><?=$row['item']?></td>
            <td align="center"><?=$row['sign']?></td>
            <td align="center" x:str><?=$row['shassi']?></td>
            <td align="center"><?=$row['car_services_title']?></td>
            <td align="center" x:str><?=$row['car_services_edrpou']?></td>
            <td align="center" x:str><?=$row['number_audanet']?></td>
            <td align="center"><?=$row['document_date_format']?></td>
            <td align="center"><?=str_replace('.', ',', $row['amount'])?></td>
            <td align="center"><?=$row['order_parts_date_format']?></td>
            <td align="center"><?=$row['order_outfit_begin_date_format']?></td>
            <td align="center"><?=str_replace('.', ',', $row['order_outfit_begin_amount'])?></td>
            <td align="center"><?=$row['order_outfit_begin_author']?></td>
            <td align="center"><?=$row['order_outfit_end_date_format']?></td>
            <td align="center"><?=str_replace('.', ',', $row['order_outfit_end_amount'])?></td>
            <td align="center"><?=str_replace('.', ',', $row['deductible_amount'])?></td>
            <td align="center"><?=$row['order_outfit_end_author']?></td>
            <td align="center"><?=$row['last_date_exchange_format']?></td>
            <td align="center"><?=$row['created_format']?></td>
        </tr>
        <?
            }
        ?>
    </table>
</body>
</html>