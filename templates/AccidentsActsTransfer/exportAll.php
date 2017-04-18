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
<table width="100%" cellpadding="0" cellspacing="0">
	<tr class="columns">
		<td>Номер</td>
		<td>Статус</td>
		<td>Дата формування</td>
		<td>Виконавець, формування</td>
		<td>Дата отримання</td>
		<td>Виконавець, отримання</td>
		<td>Дата закриття</td>
		<td>Дата створення</td>
		<td>Виконавець, створення</td>
		<td>Дата редагування</td>
	</tr>
	<?
	foreach ($list as $row) {
	$i = 1 - $i;
	?>
	<tr class="<?=$this->getRowClass($row, $i)?>">
		<td style='mso-number-format:"\@";'><?=$row['number']?></td>
		<td><?=$row['statuses_title']?></td>
		<td align="right"><?=$row['date_format']?></td>
		<td><?=$row['formed_accounts_name']?></td>
		<td align="right"><?=$row['received_date_format']?></td>
		<td><?=$row['received_accounts_name']?></td>
		<td align="right"><?=$row['closed_date_format']?></td>
		<td align="right"><?=$row['created_format']?></td>
		<td><?=$row['created_accounts_name']?></td>
		<td align="right"><?=$row['modified_format']?></td>
	</tr>
<? } ?>
</table>
</body>
</html>