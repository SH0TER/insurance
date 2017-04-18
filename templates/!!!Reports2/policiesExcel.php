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
<? if ($_SESSION['auth']['agent_financial_institutions_id']==25) {
$showcomissions = false;
}
?>

<? if (is_array($list)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr class="columns">
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT  || $_SESSION['auth']['agent_financial_institutions_id']==25) {?>
						<td rowspan="2">Агенцiя</td>
						<? }?>
						<td rowspan="2">Менеджер</td>
						<td rowspan="2">Страхувальник</td>
						<td rowspan="2">Об'єкт</td>
						<td colspan="<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {echo '5';} else echo '4'; ?>">Договір</td>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td  rowspan="2">Дата банк</td><? } ?>
						<td colspan="3">Платіж</td>
						<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
						<td colspan="2">Комiciя агента</td>
						<?}?>
					
					 
						<? if (($Authorization->data['roles_id'] != ROLES_AGENT || $Authorization->data['agencies_id']==SELLER_AGENCIES_ID) && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
						<td rowspan=2><? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>Вигодонабувач<? } else { ?>ТДВ "Експрес страхування"<? } ?></td>
						<?}?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td rowspan=2>пролонгация</td><? } ?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td rowspan=2>Тариф</td><? } ?>
						<td rowspan=2>Документи</td>
						<td rowspan=2>Агенція продавець</td>
						<td rowspan=2>Менеджер продавець</td>
						<td rowspan=2>Комисия</td>
					</tr>
					<tr class="columns">
						<td>№</td>
						<td>дата</td>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td>Тариф</td><? } ?>
						<td>премія, грн.</td>
						<td>статус</td>
						<td>термін</td>
						<td>отримано</td>
						<td>грн.</td>
						<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
						<td>%</td>
						<td>грн.</td>
						<?}?>
						 
					 
						
						
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
	<? if ($Authorization->data['roles_id'] != ROLES_AGENT || $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td><?=$row['agencies_title']?></td><?}?>
	<td><?=$row['agent']?></td>
	<td><?=$row['insurer']?></td>
	<td><?=$row['item']?></td>
	<td><?=$row['number']?></td>
	<td><?=$row['date']?></td>
	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td  align="right"><?=getMoneyFormat($row['rate'], -1)?></td><? } ?>
	<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
	<td><?=$row['policy_statusesTitle']?></td>
	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td><?=$row['bank_akt_payment_date']?></td><? } ?>
	<td><?=$row['waitingPaymentDate']?></td>
	<td><?=$row['payment_date']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['paymentsAmount'], -1)?></td>
	
	<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
	<td align="right"><?=getMoneyFormat($row['commission_agent_percent'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['commission_agent_amount'], -1)  ?></td>
	<?}?>
	 
	 
	<? if (($Authorization->data['roles_id'] != ROLES_AGENT || $Authorization->data['agencies_id']==SELLER_AGENCIES_ID) && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?><td align="right"><?=$row['financial_institutions_title']?></td><? } ?>
	
	<?}?>
	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td><?=($row['prolong']>0 ? 'Так' : 'Нi')?></td><? } ?>
	
	<td align="right"><?=($row['documents'] ? 'Так' : 'Нi')?></td>
	<td  ><?=$row['seller_agency_title']?></td>
	<td  ><?=$row['seller_agent']?></td>
	<td align="right"><?=($row['commission'] ? 'Так' : 'Нi')?></td>
	
</tr>
<?
		}
	}
?>
</table>
<? } ?>
</body>
</html>