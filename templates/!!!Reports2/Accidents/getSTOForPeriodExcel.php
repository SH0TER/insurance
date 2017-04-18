<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Звіт по СТО/Банках за період</title>
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
        <td align="center" <?if(isset($data['is_financial_institutions'])){?>colspan="14"<?} else {?> colspan="10"<?}?> >
            <?if(!isset($data['is_financial_institutions'])){?><b>Справи <?=$car_services_title?> за період часу за
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
            </b><?} else {?>
            <b>Справи <?=$financial_institutions_title?> за період часу за
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
            </b><?}?>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="1">
            <tr class="columns">
                <td>№ справи</td>
                <td>Страхувальник</td>
                <td>Об'єкт</td>
                <td>Vin</td>
                <?if(isset($data['is_financial_institutions'])){?><td>Сума об'єкту страхування</td><?}?>
                <?if(isset($data['is_financial_institutions'])){?><td>Страховий випадок</td><?}?>
                <?if(isset($data['is_financial_institutions'])){?><td>Дата події</td><?}?>
                <?if(!isset($data['is_financial_institutions'])){?><td>Франшиза</td><?}?>
                <td>Дата заяви</td>
                <?if(isset($data['is_financial_institutions'])){?><td>Сума збитку, заявлена страхувальником</td><?}?>
                <?if(isset($data['is_financial_institutions'])){?><td>Сума збитку, згідно з висновком СК</td><?}?>
                <?if(isset($data['is_financial_institutions'])){?><td>СК прийнято рішення про виплату:</td><?}?>
                <?if(isset($data['is_financial_institutions'])){?><td>Кошти фактично виплачені</td><?}?>
                <?if(isset($data['is_financial_institutions'])){?><td>ПІБ куратора</td><?}?>
                 <?if(!isset($data['is_financial_institutions'])){?><td>Статус справи</td><?}?>
                <td>Фактично сплачено</td>
                 <?if(!isset($data['is_financial_institutions'])){?><td>Призначення платежу</td><?}?>
                 <?if(!isset($data['is_financial_institutions'])){?><td>Примітки</td><?}?>
            </tr>
            <?
                $color = 0;
                foreach ($list as $row) {
                    echo '<tr>';
                    $color = 1 - $color;
                    echo '<td>' . $row['number'] . '</td>';
                    echo '<td>' . $row['insurer'] . '</td>';
                    echo '<td>' . $row['item'] . '</td>';
                    if($row['sign']!='') echo '<td>' . $row['sign'] .  '</td>'; else echo '<td>-</td>';
                     if(isset($data['is_financial_institutions'])){echo '<td>' . $row['policies_price'] . '</td>';}
                     if(isset($data['is_financial_institutions'])){echo '<td>' . $row['risk_title'] . '</td>';}
                     if(isset($data['is_financial_institutions'])){echo '<td>' . $row['datetime'] . '</td>';}
                    if(!isset($data['is_financial_institutions'])){if($row['deductibles_amount']!='') echo '<td>' . $row['deductibles_amount'] .  '</td>'; else echo '<td>0,00</td>';}
                    echo '<td>' . $row['date'] . '</td>';
                    if(isset($data['is_financial_institutions'])){echo '<td>' . $row['amount_rough'] . '</td>';}
                    if(isset($data['is_financial_institutions'])){echo '<td>' . $row['amount_rough'] . '</td>';}
                    if(isset($data['is_financial_institutions'])){if($row['insurance']==1) echo '<td>Так</td>'; elseif($row['insurance']==2 || $row['insurance']==3)echo '<td>Ні</td>'; else echo '<td>--</td>';}
                    if(isset($data['is_financial_institutions'])){echo '<td>' . $row['payment_statuses_title'] . '</td>';}
                    if(isset($data['is_financial_institutions'])){echo '<td>Базічев Я.О.</td>';}
                    if(!isset($data['is_financial_institutions'])){if($row['insurance']==1) $row['insurance'] = 'страховий з виплатою'; elseif($row['insurance']==2) $row['insurance'] = 'страховий без виплати'; else $row['insurance'] = 'не страховий'; echo '<td>' . $row['status'] . ', ' . $row['insurance'] . '</td>';}
                    if($row['amount']!='') echo '<td>' . $row['amount'] .  '</td>'; else echo '<td>0,00</td>';
                    if(!isset($data['is_financial_institutions'])){if($row['assignment_payments']!='') echo '<td>' . $row['assignment_payments'] .  '</td>'; else echo '<td>-</td>';}
                    if(!isset($data['is_financial_institutions'])){echo '<td></td>';}
                    echo '</tr>';
                }
            ?>
    <tr class="navigation">
        <td class="paging">Всього: <?=(sizeof($list))?></td>
    </tr>
</table>
</body>
</html>