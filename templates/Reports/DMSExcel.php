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
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr class="columns">
	<td>Номер полиса</td>
	<td>Дата полиса</td>
	<td>ФИО Страхователя</td>
	<td>Сумма страхового платежа, грн</td>
	<td>Дата оплаты страхового платежа</td>
	<td>Номер САР</td>
	<td>Дата САР</td>
	<td>Номер калькуляции</td>
	<td>Категория услуг</td>
	<td>Название услуги</td>
	<td>Количество услуг</td>
	<td>Стоимость услуги, грн</td>
</tr>
<?
	$i = 0;
	foreach ($list as $row) {
		$i = 1 - $i;
		$rowspan = sizeOf($row['services']);
?>
	<tr>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['policies_number']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['policies_date']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['insurer']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['payment_amount']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['payment_date']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['act_number']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['act_date']?></td>
		<td rowspan="<?php echo $rowspan;?>"><?=$row['calculation_number']?></td>
		<?php
			foreach ($row['services'] as $i => $service) {
				if ($i != 0) echo '<tr>';

				echo '<td>' . $service['category_title'] . '</td>';
				echo '<td>' . $service['service_title'] . '</td>';
				echo '<td>' . $service['count'] . '</td>';
				echo '<td>' . $service['price'] . '</td>';

				echo '</tr>';
			}
		?>
<?
	}
?>
</table>
</body>
</html>