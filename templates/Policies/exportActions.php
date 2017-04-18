<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <title>Экспорт полісів</title>
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
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
    <td rowspan="2">Номер полісу</td>
	<td rowspan="2">Дата</td>
    <td rowspan="2">Страхувальник</td>
    <td rowspan="2">Автомобіль</td>
    <td rowspan="2">Статус полісу</td>
    <td colspan="2">Документи</td>
    <td colspan="2">Комісія</td>
	<td rowspan="2">Коментар</td>
</tr>
<tr class="columns">
    <td>Дата</td>
    <td>Користувач</td>
    <td>Дата</td>
    <td>Користувач</td>
</tr>
<?
    foreach ($list as $row) {
        $i = 1 - $i;
?>
<tr>
    <td><?=$row['number']?></td>
	<td><?=$row['date']?></td>
    <td><?=$row['insurer']?></td>
    <td><?=$row['item']?></td>
    <td><?=$row['policy_statuses_title']?></td>
    <td><?=$row['documents_date_format']?></td>
    <td><?=$row['documents_accounts_title']?></td>
    <td><?=$row['commission_date_format']?></td>
    <td><?=$row['commission_accounts_title']?></td>
	<td><?=$row['policy_comment']?></td>
</tr>
<?
    }
?>
</table>
</body>
</html>