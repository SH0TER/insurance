<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Звіт по заявлених страхових випадках за період</title>
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

<table width="100%" cellpadding="0" cellspacing="0" >
    <tr style="height: 30px;">
        <td align="center" colspan="10">
            <b>Заявлені страхові справи за</b>
        <?
            for($i=0; $i< sizeof($data['month']) - 1; $i++){
                if($data['month'][$i] < 10){
                    echo '<b>' .  '0' . $data['month'][$i] .  '.' . $data['year'] . ', ' . '</b>';
                }
                else{
                    echo '<b>' . $data['month'][$i] .  '.' . $data['year'] . ', ' . '</b>';
                }
            }
            if($data['month'][$i] < 10){
                echo '<b>' .  '0' . $data['month'][sizeof($data['month']) - 1] .  '.' . $data['year']. '</b>';
            }
            else{
                echo '<b>' . $data['month'][sizeof($data['month']) - 1] .  '.' . $data['year']. '</b>';
            }
        ?>
        </td>
    </tr>
</table>

<? if ($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE) { ?>

	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td>№ справи</td>
			<td>Страхувальник</td>
			<td>Номер договору</td>
			<td>Номер сертифікату</td>
			<td>Дата договору</td>
			<td>Ідентифікатор</td>
			<td>Дата події</td>
			<td>Дата заяви</td>
			<td>Орієнтований збиток</td>
			<td>Фактично сплачено</td>
			<td>Дата закриття справи</td>
			<td>Регрес</td>
			<td>Дата створення справи</td>
			
		</tr>
		<?
			foreach ($list as $row) {
				echo '<tr>';
				echo '<td>' . $row['accidents_number'] . '</td>';
				echo '<td>' . $row['insurer'] . '</td>';
				echo '<td>' . $row['policies_number'] . '</td>';
				echo '<td>' . $row['certificates_number'] . '</td>';
				echo '<td>' . $row['policies_date'] .  '</td>';
				echo '<td>' . ($row['item_types_id'] == 2 ? $row['item'] : $item_types_titles[$row['item_types_id']]) . '</td>';
				echo '<td>' . $row['datetime'] .  '</td>';
				echo '<td>' . $row['accidents_date'] .  '</td>';
				echo '<td>' . getRateFormat($row['amount_rough'], 2) .  '</td>';
				if($row['amount']!='') echo '<td>' . $row['amount'] .  '</td>'; else echo '<td>-</td>';
				if($row['created']!='') echo '<td>' . $row['created'] .  '</td>'; else echo '<td>-</td>';
				if($row['regres']==0) echo '<td>Ні</td>'; else echo '<td>Так</td>';
				if($row['accidents_created']!='') echo '<td>' . $row['accidents_created'] .  '</td>'; else echo '<td>-</td>';

				echo '</tr>';
				$amount_rough = $amount_rough + $row['amount_rough'];

				if($row['amount'] != '' ){
					$amounts_str = explode('<br>', $row['amount']);
					for($i=0; $i<sizeof($amounts_str); $i++){
					   $amount += str_replace(',', '.', $amounts_str[$i]);
					}
				}
			}
		?>
		<tr class="navigation">
			<td class="paging">Всьго: <?=(sizeof($list))?></td>
			<td colspan="7">&nbsp;</td>
			<td class="paging" align="right"><?=getMoneyFormat($amount_rough)?></td>
			<td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
		
<? } else { ?>

	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td>№ справи</td>
			<td>Страхувальник</td>
			<td>Номер договору</td>
			<td>Дата договору</td>
			<td>Об'єкт страхування</td>
			<? if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) { ?>
				<td>Майно</td>
			<?}else{?>
				<td>Державний номер</td>
			<?}?>
			<? if($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
			<td>Потерпілий</td>
			<td>ТЗ потерпілого</td>
			<td>Держ. номер ТЗ потерпілого</td>
			<? } ?>
			<? if (in_array($data['product_types_id'], array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO))) { ?>
				<td>Ризик</td>
			<? } ?>
			<td>Дата події</td>
			<td>Дата заяви</td>
			<td>Орієнтований збиток</td>
			<td>Фактично сплачено</td>
			<? if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) { ?>
				<td>Дата відмови</td>
				<td>Остання дата страхового відшкодування</td>
			<?}?>
			<td>Дата закриття справи</td>
			<td>Регрес</td>
			<td>Дата створення справи</td>
			<td>Аварком</td>
			<td>Адрес</td>
		</tr>
		<?
			foreach ($list as $row) {
				echo '<tr>';
				echo '<td>' . $row['accidents_number'] . '</td>';
				echo '<td>' . $row['insurer'] . '</td>';
				echo '<td>' . $row['policies_number'] . '</td>';
				echo '<td>' . $row['policies_date'] .  '</td>';
				echo '<td>' . $row['item'] . '</td>';
				if($row['sign']!='') echo '<td>' . $row['sign'] .  '</td>'; else echo '<td>-</td>';
				if($data['product_types_id'] == PRODUCT_TYPES_GO) {
					echo '<td>' . $row['owner'] . '</td>';
					echo '<td>' . $row['owner_item'] . '</td>';
					echo '<td>' . $row['owner_sign'] . '</td>';
				}
				if (in_array($data['product_types_id'], array(PRODUCT_TYPES_KASKO, PRODUCT_TYPES_GO))) {
					echo '<td>' . $row['risks_title'] .  '</td>';
				}
				echo '<td>' . $row['datetime'] .  '</td>';
				echo '<td>' . $row['accidents_date'] .  '</td>';
				echo '<td>' . getRateFormat($row['amount_rough'], 2) .  '</td>';
				if($row['amount']!='') echo '<td>' . $row['amount'] .  '</td>'; else echo '<td>-</td>';
				if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) {
					if($row['date_no']!='') echo '<td>' . $row['date_no'] .  '</td>'; else echo '<td>-</td>';
					if($row['first_recovery_date']!='') echo '<td>' . $row['first_recovery_date'] .  '</td>'; else echo '<td>-</td>';
				}
				if($row['created']!='') echo '<td>' . $row['created'] .  '</td>'; else echo '<td>-</td>';
				if($row['regres']==0) echo '<td>Ні</td>'; else echo '<td>Так</td>';
				if($row['accidents_created']!='') echo '<td>' . $row['accidents_created'] .  '</td>'; else echo '<td>-</td>';
								echo '<td>' . $row['average_manager'] .  '</td>';
								echo '<td>' . $row['accident_kasko_address'] .  $row['accident_go_address'] . '</td>';
				echo '</tr>';
				$amount_rough = $amount_rough + $row['amount_rough'];

				if($row['amount'] != '' ){
					$amounts_str = explode('<br>', $row['amount']);
					for($i=0; $i<sizeof($amounts_str); $i++){
					   $amount += str_replace(',', '.', $amounts_str[$i]);
					}
				}
			}
		?>
		<tr class="navigation">
			<td class="paging">Всьго: <?=(sizeof($list))?></td>
			<td colspan="<?=($data['product_types_id'] == PRODUCT_TYPES_GO ? '10' : '7')?>">&nbsp;</td>
			<td class="paging" align="right"><?=getMoneyFormat($amount_rough)?></td>
			<td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
			<?if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY){?>
				<td colspan="2">&nbsp;</td>
			<?}?>
		</tr>
	</table>
	
<? } ?>	
</body>
</html>