<?
$id = array();
foreach ($list as $i => $row) {
	$id[] = $row['id'];
}
$sql =	'SELECT a.*, b.*, c.shassi ' .
		'FROM ' . PREFIX . '_policies AS a ' .
		'JOIN '.PREFIX.'_policies_drive AS b ON a.id = b.policies_id ' .
		'JOIN '.PREFIX.'_policies_kasko_items AS c ON a.id = c.policies_id ' .
		'WHERE a.id IN(' . implode(', ', $id) . ') ' .
		'ORDER BY date DESC';
$list = $db->getAll($sql);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>Экспорт Сертифікати добровільного страхування наземних транспортних засобів (перегони)</title>
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
                <td>№ наказу,ТТН, АПП</td>
                <td>Дата наказу,ТТН, АПП</td>
				<td>Найменування вантажу</td>
				<td>№ замовлення/№ кузова</td>
				<td>Пункт вибуття</td>
				<td>Пункт призначення</td>
				<td>Вартість ТЗ/Страхова сума, грн.</td>
				<td>Страховий тариф, %</td>
				<td>Страхова премія, грн.</td>
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
                <td><?=$row['number']?></td>
				<td><?=date('d.m.Y',smarty_make_timestamp($row['date']))?></td>
				<td><?=date('d.m.Y',smarty_make_timestamp($row['begin_datetime']))?></td>
				<td><?=date('d.m.Y',smarty_make_timestamp($row['interrupt_datetime']))?></td>
                <td><?=$row['document_number']?></td>
                <td><?=date('d.m.Y',smarty_make_timestamp($row['document_date']))?></td>
                <td><?=$row['item']?></td>
                <td><?=$row['shassi']?></td>
                <td><?=$row['send']?></td>
                <td><?=$row['destination']?></td>
				<td  align="right"><?=str_replace('.',',',$row['price'])?></td>
				<td  align="right"><?=str_replace('.', ',', $row['rate'])?></td>
				<td  align="right"><?=str_replace('.', ',', $row['amount'])?></td>
            <? } ?>
			</tr>
			<tr>
					<td colspan="10">Всього: <?=$total['count']?></td>
					<td align="left"><?=str_replace('.', ',', $total['price'])?></td>
					<td></td>
					<td align="left"><?=str_replace('.', ',', $total['amount'])?></td>
				</tr>
        </table>
		<table>
			<? if ($data['special_form'] == 1) { ?>
			<tr>
				<td colspan="10">
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