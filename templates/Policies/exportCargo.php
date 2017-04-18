<?
foreach ($list as $i=>$row) {
	$list[$i]['items'] = $db->getAll('SELECT * FROM '.PREFIX.'_policies_cargo_items WHERE policies_id='.intval($row['id']));
}
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>Экспорт Сертифікати добровільного страхування вантажів та багажу (вантажобагажу)</title>
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
        <table width="100%" cellpadding="0" cellspacing="0" border=1>
			<? if ($data['special_form'] == 1) { ?>
				<tr class="columns">
					<td colspan="19" align="center">
						Реєстр Страхових сертифікатів згідно Договору страхування № <?=$data['number']?> від <?=date('d.m.Y', strtotime($data['insurer_info']['policies_date']))?> за період <?=$data['frombegin_datetime']?> до <?=$data['tobegin_datetime']?>
					</td>
				</tr>
			<? } ?>
            <tr class="columns">
				<td>№ </td>
				<td>Дата сертифiкату</td>
				<td>Дата початку</td>
				<td>Дата закiнчення</td>
				<td>Номер авто</td>
                <td>№ наказу,ТТН, АПП</td>
                <td>Дата наказу,ТТН, АПП</td>
				<td>Найменування вантажу</td>
				<td>№ замовлення/№ кузова</td>
				<td>Пункт вибуття</td>
				<td>Пункт призначення</td>
				<td>Відправник</td>
				<td>Отримувач</td>
				<td>Вартість ТЗ/Страхова сума, грн.</td>
				<td>Страховий тариф, %</td>
				<td>Страхова премія, грн.</td>
				<td>Клієнт</td>
                <td>Вид транспортування</td>
				<td>Експедитор, перевізник</td>
				<td>Умови поставки</td>
                <td>Коментар</td>
            </tr>
            <?
				$total = array();
				foreach ($list as $row) {
					$total['count']++;
					$total['price'] += $row['price'];
					$total['amount'] += $row['amount'];
					$i = 1 - $i;
            ?>
            <tr>
                <td rowspan=<?=sizeof($row['items'])?>><?=$row['number']?></td>
				<td rowspan=<?=sizeof($row['items'])?>><?=$row['date_format']?></td>
				<td rowspan=<?=sizeof($row['items'])?>><?=$row['begin_datetime_format']?></td>
				<td rowspan=<?=sizeof($row['items'])?>><?=$row['interrupt_datetime_format']?></td>
				<td rowspan=<?=sizeof($row['items'])?>><?=$row['sign_car']?></td>
				<?
					foreach ($row['items'] as $j=>$item) {
						if ($j > 0) echo '<tr>';
				?>
                <td><?=$item['document_number']?></td>
                <td><?=date('d.m.Y',smarty_make_timestamp($item['document_date']))?></td>
                <td><?=($item['brand'] ? $item['brand'].'/'.$item['model'] : 'Автомобільні запчастини, масла, аксесуари')?></td>
                <td><?=$item['shassi']?></td>
                <td><?=$item['send']?></td>
                <td><?=$item['destination']?></td>
				<td><?=$item['sender']?></td>
				<td><?=$item['recipient']?></td>
				<? 
						if ($j == 0) {
							$rate = doubleval($row['amount'] / $row['price'] * 100);
				?>
				<td  rowspan=<?=sizeof($row['items'])?> align="right"><?=str_replace('.', ',', $row['price'])?></td>
				<td  rowspan=<?=sizeof($row['items'])?> align="right"><?=number_format ($row['rate'], 3, ',' , '')?></td>
				<td  rowspan=<?=sizeof($row['items'])?> align="right"><?=str_replace('.', ',', $row['amount'])?></td>
				<?
						}
						echo '<td>'.$row['client_contacts_id'].'</td>';
                        echo '<td>'.$row['delivery_ways_title'].'</td>';
						echo '<td>'.$row['transportation_company'].'</td>';
						echo '<td>'.$row['shipping'].'</td>';
                        echo '<td>'.$row['comment'].'</td>';
						echo '</tr>';
					}
				}
				?>
				<tr>
					<td colspan="13">Всього: <?=$total['count']?></td>
					<td align="left"><?=str_replace('.', ',', $total['price'])?></td>
					<td></td>
					<td align="left"><?=str_replace('.', ',', $total['amount'])?></td>
				</tr>
        </table>
		<table>
			<? if ($data['special_form'] == 1) { ?>
			<tr>
				<td colspan="13">
					СТРАХОВИК<br />			
					ТДВ "ЕКСПРЕС СТРАХУВАННЯ"<br />
					01004, м. Київ, вул. Велика Васильківська, 15/2<br />
					Р/р 265073011592 в АТ «ОЩАДБАНК»<br />
					МФО 300465, Код ЄДРПОУ 36086124<br />
					<br />
					Директор<br />
					<br />
					<br />
					____________________________ Щучьєва Т.А.<br />
								М.П.			
				</td>
				<td colspan="6">
					Юридична адреса:<br />
					<?=str_replace('Публічне акціонерне товариство', 'ПАТ', $data['insurer_info']['company'])?><br />
					м. <?=$data['insurer_info']['registration_city']?>, <?=$data['insurer_info']['registration_street_types_title']?> <?=$data['insurer_info']['registration_street']?>, <?=$data['insurer_info']['registration_house']?><br />
					Фактична адреса:<br />
					м. <?=$data['insurer_info']['habitation_city']?>, <?=$data['insurer_info']['habitation_street_types_title']?> <?=$data['insurer_info']['habitation_street']?>, <?=$data['insurer_info']['habitation_house']?><br />
					тел. <?=$data['insurer_info']['habitation_phone']?><br />
					Код ЄДРПОУ <?=$data['insurer_info']['identification_code']?><br />
					Р/р <?=$data['insurer_info']['bank_account']?> в <?=$data['insurer_info']['bank']?><br />
					МФО <?=$data['insurer_info']['bank_mfo']?><br />
					<?=$data['insurer_info']['position']?><br />
					<br />
					<br />
					____________________________ <?=$data['insurer_info']['lastname']?> <?=substr($data['insurer_info']['firstname'], 0, 2)?>. <?=substr($data['insurer_info']['patronymicname'], 0, 2)?>
				</td>
			</tr>
			<? } ?>
		</table>
    </body>
</html>