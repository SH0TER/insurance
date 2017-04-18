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
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
    <td>
        <table width="100%" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <?=$this->getColumnTitles(true)?>
			<td>Банк</td>
        </tr>
        <?
            foreach ($list as $row) {
                $i = 1 - $i;
        ?>
        <tr>
            <td><?=$row['date_format']?></td>
            <td><?=$row['task_types_title']?></td>
            <td>
                <?=$row['policies_insurer']?>
                <?=($row['important_person'] == 1) ? '<b style="color: red;">VIP</b>' : ''?>
                <?=($row['important_person'] == 1 && $row['important_person_groups_id'] == 1) ? '<b style="color: red;">Укравто</b>' : ''?>
            </td>
            <td><?=$row['policies_number']?></td>
			<td><?=$row['begin_datetime_format']?></td>
			<td><?=$row['interrupt_datetime_format']?></td>
            <td><?=$row['accidents_number']?></td>
            <td><?=$row['acts_number']?></td>
            <td><?=$row['payment_date']?></td>
            <td><?=$row['task_statuses_call_title']?></td>
            <td><?=$row['task_statuses_title']?></td>
            <td><?=$row['performers_id']?></td>
            <td><?=$row['comment']?></td>
            <td><?=$row['created_format']?></td>
            <td><?=$row['modified_format']?></td>
            <td><?=$row['financial_institutions_title']?></td>
        </tr>
            <? } ?>
        </table>
    </td>
</tr>
</table>
</body>
</html>