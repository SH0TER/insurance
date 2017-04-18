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
			<td align="center">Дата заяви</td>
			<td align="center">Страхувальник</td>
            <td align="center">ТЗ</td>
            <td align="center">Держ. номер</td>
            <td align="center">Клас ВР</td>
            <td align="center">Статус оплати</td>
            <td align="center">Номер акту</td>
            <td align="center">Дата оплати</td>
            <td align="center">Відшкодування</td>
            <td align="center">СТО</td>
        </tr>
        <?
            foreach ($list as $row) {
        ?>
        <tr>
            <td x:str align="center"><?=$row['accidents_number']?></td>
			<td align="center"><?=$row['accidents_date']?></td>
			<td align="center"><?=$row['insurer']?></td>
            <td align="center"><?=$row['item']?></td>
            <td align="center"><?=$row['sign']?></td>
            <td align="center"><?=$row['repair_classifications_id']?></td>
            <td align="center"><?=$row['payment_statuses_id']?></td>
            <td align="center"><?=$row['accidents_acts_number']?></td>
            <td align="center"><?=$row['payments_date']?></td>
            <td align="center"><?=$row['compensation']?></td>
            <td align="center"><?=$row['auto_services_id']?></td>
        </tr>
        <?
            }
        ?>
    </table>
</body>
</html>