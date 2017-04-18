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
<?
function printPayments($row)
{
	$result='';
	for($i=0;$i<10;$i++)
	{
		$result.='<td '.($row['payments'][$i] && $row['payments'][$i]['statuses_id']==3 ? ' bgcolor="#66ff66"' : '').'>';
		if ($row['payments'][$i])
			$result.=date('d.m.Y',smarty_make_timestamp($row['payments'][$i]['date']));
		$result.='</td>';
		$result.='<td '.($row['payments'][$i] && $row['payments'][$i]['statuses_id']==3 ? ' bgcolor="#66ff66"' : '').'>';
		if ($row['payments'][$i])
			$result.=str_replace('.', ',',$row['payments'][$i]['amount']);
		$result.='</td>';
	}
	return $result;
}
?>
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
	<?=$this->getColumnTitles(true)?>
	<td>Агент</td>
	<td>Дата1</td>
	<td>Сумма1</td>
	<td>Дата2</td>
	<td>Сумма2</td>
	<td>Дата3</td>
	<td>Сумма3</td>
	<td>Дата4</td>
	<td>Сумма4</td>
	<td>Дата5</td>
	<td>Сумма5</td>
	<td>Дата6</td>
	<td>Сумма6</td>
	<td>Дата7</td>
	<td>Сумма7</td>
	<td>Дата8</td>
	<td>Сумма8</td>
	<td>Дата9</td>
	<td>Сумма9</td>
	<td>Дата10</td>
	<td>Сумма10</td>
</tr>
<?
	foreach ($list as $row) {
	$i = 1 - $i;
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
	<?=$this->getRowValuesExcel($data, $row, $hidden, $total)?>
	<td><?=$row['agent']?></td>
	<?=printPayments($row)?>
	

</tr>
<? } ?>
</table>
</body>
</html>