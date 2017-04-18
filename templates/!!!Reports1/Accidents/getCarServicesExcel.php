<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>КАСКО. Бордеро премій</title>
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
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
    <td>
         <table width="100%" cellpadding="0" cellspacing="0">
            <tr class="columns">
                <td>Назва СТО</td>
                <?if(in_array('edrpou', $data['fields'])){?><td>ЄДРПОУ</td><?}?>
                <?if(in_array('regions_title', $data['fields'])){?><td>Регіон</td><?}?>
                <?if(in_array('count_accidents', $data['fields'])){?><td>Кількість заяв</td><?}?>
                <?if(in_array('amount_rough', $data['fields'])){?><?if(intval($data['is_ukravto']) == 1){?><td>Орієнтовний збиток</td><?}?><?}?>
                <?if(in_array('count_payment', $data['fields'])){?><td>Кількість справ з виплатою</td><?}?>
                <?if(in_array('count_not_payment', $data['fields'])){?><td>Кількість справ без виплати</td><?}?>
                <?if(in_array('deductibles_amount', $data['fields'])){?><td>Сума франшиз по справ з виплатою</td><?}?>
                <?if(in_array('payments_amount', $data['fields'])){?><td>Сума до сплати по справам з виплатою</td><?}?>
            </tr>
            <?
            $sum_amount_rough = 0;
            $count_accidents = 0;
            $count_insurance1 = 0;
            $count_insurance2 = 0;

            $sum_amount_rough_others = 0;
            $count_accidents_others = 0;
            $count_insurance1_others = 0;
            $count_insurance2_others = 0;
            foreach ($car_services_kiev as $car_service_kiev){
                $i = 1 - $i;
            ?>
            <tr class="row<?=$i?>">
                <td><?=$car_service_kiev['car_services_title']?></td>
                <?if(in_array('edrpou', $data['fields'])){?><td><?=$car_service_kiev['edrpou']?></td><?}?>
                <?if(in_array('regions_title', $data['fields'])){?><td align="center"><?=$car_service_kiev['regions_title']?></td><?}?>
                <?if(in_array('count_accidents', $data['fields'])){?><td align="center"><?=intval($counts_kiev[ $car_service_kiev['id'] ][0])?></td><?}?>
                <?if(in_array('amount_rough', $data['fields'])){?><?if(intval($data['is_ukravto']) == 1){?><td align="center"><?=floatval($counts_kiev[ $car_service_kiev['id'] ][3])?></td><?}?><?}?>
                <?if(in_array('count_payment', $data['fields'])){?><td align="center"><?=intval($counts_kiev[ $car_service_kiev['id'] ][1])?></td><?}?>
                <?if(in_array('count_not_payment', $data['fields'])){?><td align="center"><?=intval($counts_kiev[ $car_service_kiev['id'] ][2])?></td><?}?>
                <?if(in_array('deductibles_amount', $data['fields'])){?><td align="center"><?=floatval($amounts_kiev[ $car_service_kiev['id'] ][0])?></td><?}?>
                <?if(in_array('payments_amount', $data['fields'])){?><td align="center"><?=floatval($amounts_kiev[ $car_service_kiev['id'] ][1])?></td><?}?>
                <?
                    $count_accidents = $count_accidents + intval($counts_kiev[ $car_service_kiev['id'] ][0]);
                    $sum_amount_rough = $sum_amount_rough + floatval($counts_kiev[ $car_service_kiev['id'] ][3]);
                    $count_insurance1 = $count_insurance1 + intval($counts_kiev[ $car_service_kiev['id'] ][1]);
                    $count_insurance2 = $count_insurance2 + intval($counts_kiev[ $car_service_kiev['id'] ][2]);
                ?>
            <? } ?>
            </tr>
            <?if(sizeof($car_services_kiev)>0){?>
                <tr class="navigation">
                    <td class="paging">Всього по Києву та області: <?=(sizeof($car_services_kiev))?></td>
					<?if(in_array('edrpou', $data['fields'])){?><td>&nbsp;</td><?}?>
					<?if(in_array('regions_title', $data['fields'])){?><td>&nbsp;</td><?}?>
                    <?if(in_array('count_accidents', $data['fields'])){?><td class="paging">Всього по Києву та області: <?=$count_accidents?></td><?}?>
                    <?if(in_array('amount_rough', $data['fields'])){?><?if(intval($data['is_ukravto']) == 1){?><td class="paging">Сума по Києву та області: <?=$sum_amount_rough?></td><?}?><?}?>
                    <?if(in_array('count_payment', $data['fields'])){?><td class="paging">Всього по Києву та області: <?=$count_insurance1?></td><?}?>
                    <?if(in_array('count_not_payment', $data['fields'])){?><td class="paging">Всього по Києву та області: <?=$count_insurance2?></td><?}?>
					<?if(in_array('deductibles_amount', $data['fields'])){?><td>&nbsp;</td><?}?>
					<?if(in_array('payments_amount', $data['fields'])){?><td>&nbsp;</td><?}?>
                </tr>
            <?}?>
            <?
            foreach ($car_services_others as $car_service_others){
                $i = 1 - $i;
            ?>
            <tr class="row<?=$i?>">
                <td><?=$car_service_others['car_services_title']?></td>
                <?if(in_array('edrpou', $data['fields'])){?><td><?=$car_service_others['edrpou']?></td><?}?>
                <?if(in_array('regions_title', $data['fields'])){?><td align="center"><?=$car_service_others['regions_title']?></td><?}?>
                <?if(in_array('count_accidents', $data['fields'])){?><td align="center"><?=intval($counts_others[ $car_service_others['id'] ][0])?></td><?}?>
                <?if(in_array('amount_rough', $data['fields'])){?><?if(intval($data['is_ukravto']) == 1){?><td align="center"><?=floatval($counts_others[ $car_service_others['id'] ][3])?></td><?}?><?}?>
                <?if(in_array('count_payment', $data['fields'])){?><td align="center"><?=intval($counts_others[ $car_service_others['id'] ][1])?></td><?}?>
                <?if(in_array('count_not_payment', $data['fields'])){?><td align="center"><?=intval($counts_others[ $car_service_others['id'] ][2])?></td><?}?>
                <?if(in_array('deductibles_amount', $data['fields'])){?><td align="center"><?=floatval($amounts_others[ $car_service_others['id'] ][0])?></td><?}?>
                <?if(in_array('payments_amount', $data['fields'])){?><td align="center"><?=floatval($amounts_others[ $car_service_others['id'] ][1])?></td><?}?>
                <?
                    $count_accidents_others = $count_accidents_others + intval($counts_others[ $car_service_others['id'] ][0]);
                    $sum_amount_rough_others = $sum_amount_rough_others + floatval($counts_others[ $car_service_others['id'] ][3]);
                    $count_insurance1_others = $count_insurance1_others + intval($counts_others[ $car_service_others['id'] ][1]);
                    $count_insurance2_others = $count_insurance2_others + intval($counts_others[ $car_service_others['id'] ][2]);
                ?>
            <? } ?>
            </tr>
            <?if(sizeof($car_services_others)>0){?>
                <tr class="navigation">
                    <td class="paging">Всього по іншим регіонам: <?=(sizeof($car_services_others))?></td>
					<?if(in_array('edrpou', $data['fields'])){?><td>&nbsp;</td><?}?>
					<?if(in_array('regions_title', $data['fields'])){?><td>&nbsp;</td><?}?>
                    <?if(in_array('count_accidents', $data['fields'])){?><td class="paging">Всього по іншим регіонам: <?=$count_accidents_others?></td><?}?>
                    <?if(in_array('amount_rough', $data['fields'])){?><?if(intval($data['is_ukravto']) == 1){?><td class="paging">Сума по іншим регіонам: <?=$sum_amount_rough_others?></td><?}?><?}?>
                    <?if(in_array('count_payment', $data['fields'])){?><td class="paging">Всього по іншим регіонам: <?=$count_insurance1_others?></td><?}?>
                    <?if(in_array('count_not_payment', $data['fields'])){?><td class="paging">Всього по іншим регіонам: <?=$count_insurance2_others?></td><?}?>
					<?if(in_array('deductibles_amount', $data['fields'])){?><td>&nbsp;</td><?}?>
					<?if(in_array('payments_amount', $data['fields'])){?><td>&nbsp;</td><?}?>
                </tr>
            <?}?>
            <tr class="navigation">
                <td class="paging">Всього: <?=sizeof($car_services_others) + sizeof($car_services_kiev)?></td>
				<?if(in_array('edrpou', $data['fields'])){?><td>&nbsp;</td><?}?>
				<?if(in_array('regions_title', $data['fields'])){?><td>&nbsp;</td><?}?>
                <?if(in_array('count_accidents', $data['fields'])){?><td class="paging">Всього: <?=$count_accidents + $count_accidents_others?></td><?}?>
                <?if(in_array('amount_rough', $data['fields'])){?><?if(intval($data['is_ukravto']) == 1){?><td class="paging">Сума: <?=$sum_amount_rough + $sum_amount_rough_others?></td><?}?><?}?>
                <?if(in_array('count_payment', $data['fields'])){?><td class="paging">Всього: <?=$count_insurance1 + $count_insurance1_others?></td><?}?>
                <?if(in_array('count_not_payment', $data['fields'])){?><td class="paging">Всього: <?=$count_insurance2 + $count_insurance2_others?></td><?}?>
				<?if(in_array('deductibles_amount', $data['fields'])){?><td>&nbsp;</td><?}?>
				<?if(in_array('payments_amount', $data['fields'])){?><td>&nbsp;</td><?}?>
            </tr>
        </table>
    </td>
</tr>
</table>
</body>
</html>