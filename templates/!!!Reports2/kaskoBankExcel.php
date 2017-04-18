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
                                        <td rowspan="2">Вигодонабувач</td>
										 <td rowspan="2">ПІБ клієнта</td>
                                        <td rowspan="2">ІПН Клієнта</td>
                                        <td rowspan="2">№ договору страхування </td>
                                        <td rowspan="2">Дата укладання договору</td>
                                        <td rowspan="2">Страхова сума за договором, грн.</td>
                                        <td colspan="2">Період</td>
										<td rowspan="2">Умови за договором (тариф, %)</td>
										<td rowspan="2">Платіж отриманий Страховиком у звітному періоді, грн.</td>
										<td rowspan="2">Продукт</td>
										<td rowspan="2">Бренд</td>
										<td rowspan="2">Агенция</td>
										<td rowspan="2">Пролонг</td>
										<td rowspan="2">Знижка для банкiв</td>
										<td rowspan="2">Компенсацiя банка</td>
										<td rowspan="2">Сума кредиту</td>
										<td rowspan="2">Знижка агента</td>
										<td rowspan="2">Знижка Car man</td>
                                    </tr>
                                    <tr class="columns">
                                       <td>Дата початку</td>
                                       <td>Дата закінчення</td>
                                    </tr>
  <?
                                        if (is_array($list)) {
                                            $i = 0;
                                            foreach ($list as $row) {
                                                $i = 1 - $i;
                                                ?>
                                    <tr>
                                        <td><?=$row['finansialInstitutionTitle']?></td>
										<td><?=$row['insurer']?></td>
										<td><?=$row['insurer_identification_code']?></td>
										<td><?=$row['number']?></td>
										<td><?=$row['dateTimeFormat']?></td>
										<td><?=str_replace('.',',',$row['price'])?></td>
										
										<td><?=$row['begin_datetimeFormat']?></td>
										<td><?=$row['end_datetimeFormat']?></td>
										<td><?=str_replace('.',',',$row['rate'])?></td>
                                        <td><?=str_replace('.',',',$row['pamount'])?></td>
										<td><?=$row['products_title']?></td>
										<td><?=$row['brand']?></td>
										<td><?=$row['agencyTitle']?></td>
										<td><?=($row['states_id']>0 ? 'так' : 'нi' )?></td>
										<td><?=str_replace('.',',',$row['bank_discount_value'])?></td>
										<td><?=str_replace('.',',',$row['bank_commission_value'])?></td>
										<td><?=str_replace('.',',',$row['bankCreditAgreementAmount'])?></td>
										<td><?=str_replace('.',',',$row['discount'])?></td>
										<td><?=str_replace('.',',',$row['cart_discount'])?></td>
                                    </tr>
                                    <?
                                            }
                                        }
                                    ?>
</table>
<? } ?>
</body>
</html>