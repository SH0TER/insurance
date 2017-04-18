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
	<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
	<td>Агенцiя</td>
	<? }?>
	<td>Менеджер</td>
	<td>Номер</td>
	<td>Страхувальник</td>
	<td>ІПН</td>
	<td>Марка</td>
	<td>Модель</td>
	<td>Рік</td>
	<td>№ шасі (кузов, рама)</td>
	<td>Тип</td>
	<td>Премія</td>
	<td>Дата</td>
	<td>Статус</td>
</tr>
<?
	if (sizeOf($list )) {
		foreach ($list as $row) {

			$i = 1 - $i;

			$showact = true;
			if ($Authorization->data['roles_id'] == ROLES_AGENT &&
				$row['agents_id'] !=$Authorization->data['id']) {
					$showact = false;
			}
?>
<tr class="<?=Policies::getRowClass($row, $i)?>">
	<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?><td><?=$row['agencies_title']?></td><?}?>
	<td><?=$row['agent']?></td>
	<td><?=$row['number']?></td>
	<td><?=$row['insurer']?></td>
	<td><?=$row['insurer_identification_code']?></td>
	<td><?=$row['brand']?></td>
	<td><?=$row['model']?></td>
	<td><?=$row['year']?></td>
	<td><?=$row['shassi']?></td>
	<td><?=$row['types_id']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
	<td><?=$row['date']?></td>
	<td><?=$row['statusesTitle']?></td>
</tr>
<?
		}
	}
?>
</table>
<? } ?>
</body>
</html>