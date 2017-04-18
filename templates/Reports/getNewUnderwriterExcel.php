<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
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

<? 

	echo '<table border="2"><tr class="columns">';
	echo '<td>Номер договору</td>';
	echo '<td>Страхувальник</td>';
	
	echo '<td>Марка</td>';
	echo '<td>Модель</td>';
	echo '<td>Держ. номер</td>';
	
	echo '<td>Рік випуску</td>';
	echo '<td>Фр. інші ризики</td>';
	echo '<td>Фр. незаконне заволодіння</td>';
	echo '<td>без врахування зносу</td>';
	echo '<td>неагрегатна страхова сума</td>';
	
	echo '<td>Програма страхування</td>';
	echo '<td>Страхова сума</td>';
	echo '<td>Ринкова вартість</td>';
	echo '<td>Дата підписання</td>';
	echo '<td>Премія підписана</td>';
	echo '<td>Премія сплачена</td>';
	echo '<td>Дата початку</td>';
	echo '<td>Дата закінчення</td>';
	echo '<td>Комісія агент</td>';
	echo '<td>Комісія банк</td>';
	
	echo '<td>Дата події</td>';
	echo '<td>Тип події</td>';
	echo '<td>Орієнтовний збиток</td>';
	echo '<td>Страхове відшкодування</td>';
	
	echo '</tr>';
	
if (sizeOf($list)) { 
	
	foreach ($list as $row) {
 
		if (is_array($row['accidents']) && sizeOf($row['accidents'])) {
			$row_count = sizeOf($row['accidents']);
		} else {
			$row_count = 1;
		}	
	
		echo '<tr>';
		
		echo '<td>'.$row['policies_number'].'</td>';
		echo '<td>'.$row['insurer'].'</td>';
		
		echo '<td>'.$row['brand'].'</td>';
		echo '<td>'.$row['model'].'</td>';
		echo '<td>'.$row['sign'].'</td>';
		echo '<td>'.$row['year'].'</td>';
		echo '<td>'.$row['deductibles_value_other'].'</td>';
		echo '<td>'.$row['deductibles_value_hijacking'].'</td>';
		
		echo '<td>'.($row['options_deterioration_no']>0 ? 'Так' : 'Нi').'</td>';
		echo '<td>'.($row['options_agregate_no']>0 ? 'Так' : 'Нi').'</td>';
		
		echo '<td rowspan="'.$row_count.'">'.$row['products_title'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['car_price'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['market_price'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['policies_date_format'].'</td>';

	 
		echo '<td rowspan="'.$row_count.'">'.$row['amount'].'</td>';
		
		 
		
		echo '<td rowspan="'.$row_count.'">'.$row['payed_amount'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['begin_year_format'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['end_year_format'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['commission_amount'].'</td>';
		echo '<td rowspan="'.$row_count.'">'.$row['bank_commission_amount'].'</td>';
		if (sizeOf($row['accidents'])) {
			$i = 0;
			foreach ($row['accidents'] as $accident) {
				if ($i) {
					echo '</tr><tr>';
					echo '<td>' . $row['policies_number'] . '</td>';
					echo '<td>' . $row['brand'] . '</td>';								
					echo '<td>' . $row['model'] . '</td>';
					echo '<td>' . $row['sign'] . '</td>';
					echo '<td>'.$row['year'].'</td>';
					echo '<td>'.$row['deductibles_value_other'].'</td>';
					echo '<td>'.$row['deductibles_value_hijacking'].'</td>';
					echo '<td>'.($row['options_deterioration_no']>0 ? 'Так' : 'Нi').'</td>';
					echo '<td>'.($row['options_agregate_no']>0 ? 'Так' : 'Нi').'</td>';	
				}
				echo '<td>' . $accident['date'] . '</td>';
				echo '<td>' . $accident['risk'] . '</td>';
				echo '<td>' . $accident['amount_rough'] . '</td>';
				echo '<td>' . $accident['amount'] . '</td>';
				$i++;
			}
		} else {
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
		}
		
		echo '</tr>';
	}
	
echo '</table>';

}
	
?>

</body>
</html>