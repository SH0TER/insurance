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
		<td>Група запчастин</td>
		<td>Тип ТЗ</td>
		<td>Марка ТЗ</td>
		<td>Модель ТЗ</td>
		<td>Рік випуску</td>
		<td>Ціна</td>
		<td>Опис</td>
	</tr>
	<?
		foreach ($list as $row) {
	?>
	<tr>
		<td><?=$row['spare_part_groups_id']?></td>
		<td><?=$row['car_types_id']?></td>
		<td><?=$row['brands_id']?></td>
		<td><?=$row['models_id']?></td>
		<td><?=$row['year']?></td>
		<td><?=getRateFormat($row['price'], 2)?></td>
		<td><?=$row['notice']?></td>
	</tr>
	<? } ?>
</table>
</body>
</html>