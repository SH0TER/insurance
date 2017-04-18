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
			<td align="center">Статус</td>
			<td align="center">Аварійний комісар</td>
            <td align="center">Тип</td>
            <td align="center">Статус</td>
            <td align="center">Автор</td>
            <td align="center">Виконавець</td>
            <td align="center">Виконавець, організація</td>
            <td align="center">Дата переведення справи в "Розгляд"</td>
            <td align="center">Дата постановки задачі</td>
            <td align="center">Дата рішення задачі</td>
            <td align="center">Тривалість виконання</td>
        </tr>
        <?
            foreach ($list as $row) {
        ?>
        <tr>
            <td x:str align="center"><?=$row['accidents_number']?></td>
			<td align="center"><?=$row['accident_statuses_title']?></td>
			<td align="center"><?=$row['average_manager']?></td>
            <td align="center"><?=$row['message_types_title']?></td>
            <td align="center"><?=$row['statuses']?></td>
            <td align="center"><?=$row['author']?></td>
            <td align="center"><?=$row['recipient']?></td>
            <td align="center"><?=$row['recipient_organization']?></td>
            <td align="center"><?=$row['investigated_date']?></td>
            <td align="center"><?=$row['created_date']?></td>
            <td align="center"><?=$row['decision_date']?></td>
            <td align="center"><?=$row['days']?></td>
        </tr>
        <?
            }
        ?>
    </table>
</body>
</html>