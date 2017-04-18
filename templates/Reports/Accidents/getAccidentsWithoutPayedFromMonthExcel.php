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

	<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
		<table width="100%" cellpadding="0" cellspacing="0" border="1">
			<tr class="columns">
				<td>Номер справи</td>
				<td>Страхувальник</td>
				<td>Номер договору</td>
				<td>Дата договору</td>
				<td>Об'єкт страхування</td>
				<td>Державний номер</td>
				<? if($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
				<td>Потерпілий</td>
				<td>ТЗ потерпілого</td>
				<td>Держ. номер ТЗ потерпілого</td>
				<? } ?>
				<td>Дата події</td>
				<td>Дата заяви</td>
				<td>Орієнтовний збиток, грн.</td>
				<td>Дата закриття</td>
				<td>Вигодонабувач</td>
				<td>Аварійний комісар</td>				
				<!--td>Причини</td-->
			</tr>
			<?
				$i = 0;
				$amount = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
			?>
				<tr>
					<td style='mso-number-format:"\@";'><?=$row['accidents_number']?></td>
					<td><?=$row['insurer']?></td>
					<td><?=$row['policies_number']?></td>
					<td><?=$row['policies_date']?></td>
					<td><?=$row['item']?></td>
					<td><?=$row['item_sign']?></td>
					<? if($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
					<td><?=$row['owner']?></td>
					<td><?=$row['owner_item']?></td>
					<td><?=$row['owner_sign']?></td>
					<? } ?>
					<td><?=$row['accidents_datetime']?></td>
					<td><?=$row['accidents_date']?></td>
					<td style='mso-number-format:"0\.00"'><?=getRateFormat($row['amount_rough'], 2)?></td>
					<td><?=$row['accidents_acts_date']?></td>
					<td><?=$row['assured_title']?></td>
					<td><?=$row['average_manager']?></td>					
					<!--td><?=$row['reason_not_payment']?></td-->
				</tr>
			<?
					$amount = $amount + $row['amount_rough'];
				}
			?>
			<tr class="columns">
				<td class="paging">Всього: <?=(sizeof($list))?></td>
				<td colspan="<?=($data['product_types_id'] == PRODUCT_TYPES_GO ? '10' : '8')?>">&nbsp;</td>
				<td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	<? } ?>
	
	<? if ($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) { ?>
		<table width="100%" cellpadding="0" cellspacing="0" border="1">
			<tr class="columns">
				<td>Номер справи</td>
				<td>Страхувальник</td>
				<td>Номер договору</td>
				<td>Дата договору</td>
				<td>Об'єкт страхування</td>
				<td>Дата події</td>
				<td>Дата заяви</td>
				<td>Орієнтовний збиток, грн.</td>
				<td>Дата закриття</td>	
				<td>Аварійний комісар</td>				
			</tr>
			<?
				$i = 0;
				$amount = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
			?>
				<tr>
					<td style='mso-number-format:"\@";'><?=$row['accidents_number']?></td>
					<td><?=$row['insurer']?></td>
					<td><?=$row['policies_number']?></td>
					<td><?=$row['policies_date']?></td>
					<td><?=$row['property_objects_title']?></td>
					<td><?=$row['accidents_datetime']?></td>
					<td><?=$row['accidents_date']?></td>
					<td style='mso-number-format:"0\.00"'><?=getRateFormat($row['amount_rough'], 2)?></td>
					<td><?=$row['accidents_acts_date']?></td>
					<td><?=$row['average_manager']?></td>
					<!--td><?=$row['reason_not_payment']?></td-->
				</tr>
			<?
					$amount = $amount + $row['amount_rough'];
				}
			?>
			<tr class="columns">
				<td class="paging">Всього: <?=(sizeof($list))?></td>
				<td colspan="6">&nbsp;</td>
				<td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
				<td>&nbsp;</td>
			</tr>
	<? } ?>
	
	<? if ($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE) { ?>
		<table width="100%" cellpadding="0" cellspacing="0" border="1">
			<tr class="columns">
				<td>Номер справи</td>
				<td>Страхувальник</td>
				<td>Номер договору</td>
				<td>Номер сертифікату</td>
				<td>Дата договору</td>
				<td>Ідентифікатор</td>
				<td>Дата події</td>
				<td>Дата заяви</td>
				<td>Орієнтовний збиток, грн.</td>
				<td>Дата закриття</td>
				<td>Аварійний комісар</td>
			</tr>
			<?
				$i = 0;
				$amount = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
			?>
				<tr>
					<td style='mso-number-format:"\@";'><?=$row['accidents_number']?></td>
					<td><?=$row['insurer']?></td>
					<td><?=$row['policies_number']?></td>
					<td><?=$row['certificates_number']?></td>
					<td><?=$row['policies_date']?></td>
					<td><?=($row['item_types_id'] == 2 ? $row['item'] : $item_types_titles[$row['item_types_id']])?></td>
					<td><?=$row['accidents_datetime']?></td>
					<td><?=$row['accidents_date']?></td>
					<td style='mso-number-format:"0\.00"'><?=getRateFormat($row['amount_rough'], 2)?></td>
					<td><?=$row['accidents_acts_date']?></td>
					<td><?=$row['average_manager']?></td>
					<!--td><?=$row['reason_not_payment']?></td-->
				</tr>
			<?
					$amount = $amount + $row['amount_rough'];
				}
			?>
			<tr class="columns">
				<td class="paging">Всього: <?=(sizeof($list))?></td>
				<td colspan="7">&nbsp;</td>
				<td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
				<td>&nbsp;</td>
			</tr>
	<? } ?>
	
<? } ?>
</body>
</html>