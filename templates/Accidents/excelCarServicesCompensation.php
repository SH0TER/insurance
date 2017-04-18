<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Звіт МТСБУ по полісам ЦВ</title>
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

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
    <td>
        <table width="100%" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <td>Номер справи</td>
            <td>Марка, модель</td>
            <td>Державний номер</td>
            <td>Номер кузова</td>
            <td>Власник ТЗ</td>
            <td>СТО отримувач</td>
            <td>УкрАВТО</td>
            <td>Призначення платежу</td>
            <td>Попередньо погоджена вартість ВР, грн</td>
            <td>Вартість ВР, включаючи приховані пошкодження, грн</td>
            <td>Сума відшкодування, грн</td>
            <td>Різниця, що має бути сплачена страхувальником, грн</td>
            <td>Дата оплати</td>
			<td>Телефон</td>
        </tr>
        <? foreach ($list as $i => $row) { ?>
                <tr>
                <td><?=$row['accidents_number']?></td>
                <td><?=$row['item']?></td>
                <td><?=$row['sign']?></td>
                <td><?=$row['shassi']?></td>
                <td><?=$row['owner']?></td>
                <td><?=$row['recipient']?></td>
                <td><?=$row['ukravto']?></td>
                <td><?=$row['payments_basis']?></td>
                <td><?=$row['total_amount']?></td>
                <td><?=$row['previous_total_amount']?></td>
                <td><?=$row['payments_amount']?></td>
                <td><?=$row['diff_amount']?></td>
                <td><?=$row['paymet_dateFormat']?></td>
				<td><?=$row['insurer_phone']?></td>
                </tr>
        <? } ?>
		</table>
    </td>
</tr>
</table>
</body>
</html>
