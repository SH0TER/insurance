<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Звіт по компромісним рішенням</title>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
	<style>
		* {
			font-size: 11px;
			font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
		}
		.columns TD {
            width: 300px;
			height: 25px;
			color: #FFFFFF;
			padding-left: 4px;
			font-weight: bold;
			border-right: 1px solid #FFFFFF;
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #FFFFFF;
			background-color: #008575;
		}
        tr.columns {
            height: 50px;
        }
        td.row {
            width: 100px;
        }
        td.neither_big_no_small {
            width: 200px;
        }
        td.big_row{
           width: 450px;
        }
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
            <tr class="columns">
                <td class="row">Номер справи</td>
                    <?if($data['register']==2){?><td class="row">Номер договору</td><?}?>
                    <td class="row">Дата договору</td>
                    <td class="row">Марка/модель</td>
                    <?if($data['register']==2){?>
                        <td class="neither_big_no_small">Страхувальник</td>
                        <td class="row">Державний номер</td>
                        <td class="row">Номер кузова</td>
                        <td class="row">СТО</td>
                    <?}?>
                    <td class="row">Дата події</td>
                    <td class="row">Сума платежу</td>
                    <td class="row">Орієнтований збиток</td>
                    <td class="row">Франшиза</td>
                    <td class="row">Попередні події по договору</td>
                    <td class="row">Сума виплачених відшкодувань по попередніх справах по договору</td>
                    <td class="row">Попередні договори по авто</td>
                    <td class="row">Сума платежів по попередніх договорах по авто</td>
                    <td class="row">Сума виплачених відшкодувань по попередніх договорах по авто</td>
                    <?if($data['register']==2){?>
                        <td class="row">Інші договори по клієнту</td>
                        <td class="row">Сума платежиів по інших договорах по клієнту</td>
                        <td class="row">Сума виплачених відшкодувань по інших договорах по клієнту</td>
                        <td class="row">Випадок</td>
                        <td class="row">Дата прийняття компромісного рішення</td>
                        <td class="row">Дата відмови</td>
                        <td class="row">Дата сплати</td>
                        <td class="row">Відшкодування</td>
                        <td class="neither_big_no_small">Отримувач</td>
                    <?}?>
                    <td class="big_row">Опис події, що відбулась</td>
                    <td class="neither_big_no_small">Умови договору, що порушені</td>
                    <td class="big_row">Коментар</td>
            </tr>
            <?
                foreach($list as $row) {
                    echo '<tr>';
                        echo '<td>' . $row['accidents_number'] . '</td>';
                        if($data['register']==2){ echo '<td>' . $row['policies_number'] . '</td>';}
                        echo '<td>' . $row['policies_date'] . '</td>';
                        echo '<td>' . $row['items'] . '</td>';
                        if($data['register']==2){
                            echo '<td>' . $row['insurer'] . '</td>';
                            if($row['sign'] != ''){ echo '<td>' . $row['sign'] . '</td>';} else {echo '<td>-</td>';};
                            echo '<td>' . $row['shassi'] . '</td>';
                            echo '<td>' . $row['car_services_title'] . '</td>';
                        }
                        echo '<td>' . $row['accidents_datetime'] . '</td>';
                        echo '<td>' . getRateFormat($row['compensations'], 2) . '</td>';
                        echo '<td>' . getRateFormat($row['amount_rough'], 2) . '</td>';
                        echo '<td>' . getRateFormat($row['deductibles_amount'], 2) . '</td>';
                        if($row['policies_previous_accidents_list'] != ''){ echo '<td>' . $row['policies_previous_accidents_list'] . '</td>';} else {echo '<td>Немає</td>';};
                        if($row['policies_previous_accidents_amount'] != ''){ echo '<td>' . getRateFormat($row['policies_previous_accidents_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                        if($row['previous_policies_item_list'] != ''){ echo '<td>' . $row['previous_policies_item_list'] . '</td>';} else {echo '<td>Немає</td>';};
                        if($row['previous_policies_item_amount'] != ''){ echo '<td>' . getRateFormat($row['previous_policies_item_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                        if($row['previous_policies_item_accidents_amount'] != ''){ echo '<td>' . getRateFormat($row['previous_policies_item_accidents_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                        if($data['register']==2){
                            if($row['all_policies_insurer_list'] != ''){ echo '<td>' . $row['all_policies_insurer_list'] . '</td>';} else {echo '<td>Немає</td>';};
                            if($row['all_policies_insurer_amount'] != ''){ echo '<td>' . getRateFormat($row['all_policies_insurer_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                            if($row['all_policies_insurer_accidents_amount'] != ''){ echo '<td>' . getRateFormat($row['all_policies_insurer_accidents_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                            if($row['insurance'] == 1){ echo '<td>сплатити</td>';} elseif($row['insurance'] == 2){echo '<td>без виплати</td>';} elseif($row['insurance'] == 3){echo '<td>відмова</td>';}else {echo '<td>-</td>';};
                            if($row['compromise_date'] != '00.00.0000'){ echo '<td>' . $row['compromise_date'] . '</td>';} else {echo '<td>-</td>';};
                            if($row['date_no'] != '00.00.0000' && $row['date_no'] != ''){ echo '<td>' . $row['date_no'] . '</td>';} else {echo '<td>-</td>';};
                            if($row['payment_date'] != '00.00.0000'  && $row['payment_date']!= ''){ echo '<td>' . $row['payment_date'] . '</td>';} else {echo '<td>-</td>';};
                            if($row['payment_amount'] != ''){ echo '<td>' . $row['payment_amount'] . '</td>';} else {echo '<td>-</td>';};
                            if($row['recipient'] != ''){ echo '<td>' . $row['recipient'] . '</td>';} else {echo '<td>-</td>';};

                        }
                        if($row['description'] != ''){ echo '<td>' . $row['description']. '</td>';} else {echo '<td>-</td>';};
                        if($row['compromises_title'] != ''){ echo '<td>' . $row['compromises_title'] . '</td>';} else {echo '<td>-</td>';};
                        if($row['compromise_comment'] != ''){ echo '<td>' . $row['compromise_comment']. '</td>';} else {echo '<td>-</td>';};
                    echo '</tr>';
                }
            ?>
    <tr class="navigation">
        <td class="paging">Всього: <?=(sizeof($list))?></td>
    </tr>
</table>
</body>
</html>