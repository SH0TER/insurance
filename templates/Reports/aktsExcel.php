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
	<td>Агент</td>
	<td>Акт</td>
	<td>Кількість полісів, шт.</td>
	<td>Сума реалізації, грн.</td>
	<td>Сума винагороди до опадаткування, грн.</td>
	<td>Дата сплати за актом</td>
</tr>
<?
	$policiesCount = 0;
	$policiesAmount = 0;
	$commission_amount = 0;
	if (is_array($list )) {
		foreach ($list as $row) {
			$policiesCount += $row['policiesCount'];
			$policiesAmount += $row['policiesAmount'];
			$commission_amount += $row['commission_amount'];
?>
<tr>
	<td><?=$row['recipient']?></td>
	<td><?=$row['aktNumber']?></td>
    <td><?=$row['policiesCount']?></td>
	<td><?=getMoneyFormat($row['policiesAmount'], -1)?></td>
	<td><?=getMoneyFormat($row['commission_amount'], -1)?></td>
	<td><?=$row['payment_date_format']?></td>
</tr>
<?
		}
	}
?>
<tr class="navigation">
	<td class="paging">Всього:</td>
	<td class="paging"><?=(sizeof($list))?></td>
	<td align="right" class="paging"><?=$policiesCount?> &nbsp;</td>
	<td align="right" class="paging"><?=getMoneyFormat($policiesAmount)?> &nbsp;</td>
	<td align="right" class="paging"><b><?=getMoneyFormat($commission_amount)?></b> &nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
</body>
</html>