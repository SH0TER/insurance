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
<? if (is_array($list)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr class="columns">
	<td>Точка продажу</td>
										<td>Продукт</td>
                                        <td>Кiльк.</td>
                                        <td>Активний</td>
</tr>
<?
	if (sizeOf($list)) {
		foreach ($list as $row) {
			$i = 1 - $i;
?>
	<tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$row['salonTitle']?></td>
										<td><?=$row['prodTitle']?></td>
										<td align="right"><?=$row['acount']?></td>
                                        <td align="center"><?=($row['publish'] ? 'Так' :'Нi')?></td>
                                    </tr>
<?
		}
	}
?>
</table>
<? } ?>
</body>
</html>