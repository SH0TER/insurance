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
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
	<td rowspan="2">Номер</td>
	<td rowspan="2">Дата та час випадку</td>
	<td rowspan="2">Дата та час реєстрації</td>
	<td rowspan="2">Вид страхування</td>
	<td rowspan="2">Номер</td>
	<td rowspan="2">Марка</td>
	<td rowspan="2">Модель</td>
	<td rowspan="2">Держ. номер</td>
	<td rowspan="2">Головна агенція</td>
	<td rowspan="2">Пункт обслуговування</td>
	<td rowspan="2">Коментар</td>
	<td rowspan="2">Заявник</td>
	<td rowspan="2">Телефон</td>
	<td rowspan="2">Місце випадку</td>
	<td rowspan="2">Дзвінок з місця/не з місця випадку</td>
	<td colspan="2">Страхувальник</td>
	<td colspan="2">Водій</td>
</tr>
<tr class="columns">
	<td>Страхувальник</td>
	<td>Телефон</td>
	<td>Водій</td>
	<td>Телефон</td>
</tr>
<?
	foreach ($list as $row) {
	$i = 1 - $i;
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
	<td style='mso-number-format:"\@"'><?=$row['number']?></a></td>
	<td style='mso-number-format:"\@"'><?=$row['datetime_format']?></td>
	<td style='mso-number-format:"\@"'><?=$row['created']?></td>
	<td style='mso-number-format:"\@"'><?=(intval($row['kasko_id']) ? 'КАСКО' : 'ЦВ')?></td>
	<td style='mso-number-format:"\@"'><?=(intval($row['kasko_id']) ? $row['policies_kasko_number'] : $row['policies_go_number'])?></td>
	<td style='mso-number-format:"\@"'><?=$row['car_brands_id']?></td>	
	<td style='mso-number-format:"\@"'><?=$row['car_models_id']?></td>
	<td style='mso-number-format:"\@"'><?=(intval($row['kasko_id']) ? $row['kasko_sign'] : $row['go_sign'])?></td>
	<td style='mso-number-format:"\@"'><?=$row['generalAgencie_title']?></td>
	<td style='mso-number-format:"\@"'><?=$row['car_services_title']?></td>
	<td style='mso-number-format:"\@"'><?=$row['comment']?></td>
	<td style='mso-number-format:"\@"'><?=$row['applicant']?></td>
	<td style='mso-number-format:"\@"'><?=$row['applicant_phone']?></td>
	<td style='mso-number-format:"\@"'><?=$row['address']?></td>
	<td style='mso-number-format:"\@"'><?=(intval($row['place']) == 1 ? 'так' : 'ні')?></td>
	<td style='mso-number-format:"\@"'><?=(intval($row['kasko_id']) ? $row['insurer_kasko'] : $row['insurer_go'])?></td>
	<td style='mso-number-format:"\@"'><?=(intval($row['kasko_id']) ? $row['insurer_phone_kasko'] : $row['insurer_phone_go'])?></td>
	<td style='mso-number-format:"\@"'><?=$row['driver']?></td>
	<td style='mso-number-format:"\@"'><?=$row['driver_phone']?></td>
</tr>
<? } ?>
</table>
</body>
</html>