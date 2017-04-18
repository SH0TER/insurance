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
	<td rowspan="2">Агенцiя</td>
	<? }?>
	<td rowspan="2">Менеджер</td>
	<td rowspan="2">Страхувальник</td>
	<td rowspan="2">Об'єкт</td>
	<td colspan="5">Договір</td>
	<td colspan="3">Платіж</td>
	<td colspan="4">Комiciя агента</td>
	<td colspan="5">Комiciя СТО</td>
	<?if ($showcomissions) {?>
	<td colspan="4">Комiciя підприємства</td>
	<?}?>
	<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
	<td colspan="<?=($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 5 : 4?>"><? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>Вигодонабувач<? } else { ?>ТДВ "Експрес страхування"<? } ?></td>
	<?}?>
</tr>
<tr class="columns">
	<td>№</td>
	<td>дата</td>
	<td>премія, грн.</td>
	<td>статус</td>
	<td>акція</td>
	<td>термін</td>
	<td>отримано</td>
	<td>грн.</td>
	<td>%</td>
	<td>грн.</td>
	<td>акт</td>
	<td>сплачено</td>
	<td>представник</td>
	<td>%</td>
	<td>грн.</td>
	<td>акт</td>
	<td>сплачено</td>
	<?if ($showcomissions) {?>
	<td>%</td>
	<td>грн.</td>
	<td>акт</td>
	<td>сплачено</td>
	<?}?>
	<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) { ?>
	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td>назва</td><? } ?>
	<td>%</td>
	<td>грн.</td>
	<td>акт</td>
	<td>сплачено</td>
	<? } ?>
</tr>
<?
	if (sizeOf($list)) {
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
	<td><?=$row['insurer']?></td>
	<td><?=$row['item']?></td>
	<td><?=$row['number']?></td>
	<td><?=$row['date']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
	<td><?=$row['policy_statusesTitle']?></td>
	<td><?=($row['special']) ? 'так' : 'ні'?></td>
	<td><?=$row['waitingPaymentDate']?></td>
	<td><?=$row['payment_date']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['paymentsAmount'], -1)?></td>
	<td align="right"><?=getMoneyFormat($row['commission_agent_percent'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['commission_agent_amount'], -1)?></td>
	<td><?=$row['agents_akt_number']?></td>
	<td align="center"><?=$row['payment_date_agent']?></td>
	<td><?=$row['service_person']?></td>
	<td align="right"><?=getMoneyFormat($row['commission_service_percent'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['commission_service_amount'], -1)?></td>
	<td><?=$row['service_akt_number']?></td>
	<td align="center"><?=$row['payment_date_service']?></td>
	<?if ($showcomissions) {?>
	<td align="right" nowrap><?=getMoneyFormat($row['commission_agency_percent'], -1)?></td>
	<td align="right"><?=getMoneyFormat($row['commission_agency_amount'], -1)?></td>
	<td><?=$row['agencies_akt_number']?></td>
	<td align="center"><?=$row['payment_date_agency']?></td>
	<?}?>
	<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?><td align="right"><?=$row['financial_institutions_title']?></td><? } ?>
	<td align="right"><?=getMoneyFormat($row['commission_financial_institution_percent'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['commission_financial_institution_amount'], -1)?></td>
	<td><?=$row['financial_institutions_akt_number']?></td>
	<td align="center"><?=$row['payment_date_financial_institution']?></td>
	<?}?>
</tr>
<?
		}
	}
?>
</table>
<? } ?>
</body>
</html>