<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>КАСКО. Бордеро премій</title>
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
<tr class="columns">
	
	<td rowspan="2">ПІБ клієнта</td>
	<td rowspan="2">Номер</td>
	<td rowspan="2">Марка ТЗ</td>
	<td rowspan="2">Модель ТЗ</td>
	<td rowspan="2">Номер кузова (шасі)</td>
	<td rowspan="2">Номер Сервісної картки</td>
	<td colspan="2">Період обслуговування</td>
	<td rowspan="2">Тип договору КАСКО</td>

</tr>
<tr class="columns">
   <td>Дата початку</td>
   <td>Дата закінчення</td>
</tr>
	<?
	if (is_array($list)) {
		$i = 0;
		foreach ($list as $row) {
			$i = 1 - $i;
			?>
<tr class="<?=Form::getRowClass($row, $i)?>">
	<td><?=$row['insurer']?></td>
	<td><?=$row['number']?></td>
	<td><?=$row['brand']?></td>
	<td><?=$row['model']?></td>
	<td><?=$row['shassi']?></td>
	<td x:str><?=$row['card_assistance']?></td>
	<td><?=$row['begin_datetimeFormat']?></td>
	<td><?=$row['end_datetimeFormat']?></td>
   	<td><?=$row['products_title']?></td>
</tr>
<?
		}
	}
?>
</table>
</body>
</html>