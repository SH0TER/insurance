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
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="columns">
    <td>Сума платежу, грн.</td>
    <td>Дата платежу</td>

    <td>Рознесенна сума, грн.</td>

    <td>Вид страхування</td>

    <td>Номер договору/полісу</td>
    <td>Дата договору</td>
    <td>Страхувальник</td>
    <td>Об'єкт</td>
	<td>Марка</td>

    <td>Агенція</td>
	<td>Головна агенція</td>
	<td>Агенція продавець</td>
	<td>Головна Агенція продавець</td>

    <td>Канал продажів</td>

    <td>Початок періоду</td>
    <td>Кінець періоду</td>
    <td>Страхова премія</td>
    <td>Сплачено</td>
    <td>Дата повної сплати періоду</td>
    <td>Пролонгація</td>
    <td>Рік</td>
	<td>Додаткова угода</td>
	<td>Другий платіж 50/50</td>
    <td>Рітейл/банк</td>
	<td>Страхова сума</td>
	<td>Тип особи</td>
	<td>Сервіс</td>

    <td>Номер платежу</td>
</tr>
<?
	$i = 0;
    foreach ($list as $y => $row) {
		$flag = false;
		while (sizeOf($list) > $y + $i && $list[ $y ]['payments_id'] == $list[ $y + $i ]['payments_id']) {
			$i++;
			$flag = true;
		}

        echo '<tr>';
			if ($flag) {
				echo '<td rowspan="' . $i  . '" style=\'mso-number-format:"0\.00"\'>' . $row['policy_payments_amount'] . '</td>';
				echo '<td rowspan="' . $i . '" x:str>' . $row['policy_payments_datetime'] . '</td>';
				$flag = false;
			}
			$i--;

			echo '<td x:str>' . $row['policy_payments_policy_payments_calendar_amount'] . '</td>';

            echo '<td x:str>' . $row['product_types_title'] . '</td>';

            echo '<td x:str>' . $row['policies_number'] . '</td>';
            echo '<td x:str>' . $row['policies_date'] . '</td>';
            echo '<td x:str>' . $row['policies_insurer'] . '</td>';
            echo '<td x:str>' . $row['policies_item'] . '</td>';
			echo '<td x:str>' . $row['brand'] . '</td>';

            echo '<td x:str>' . $row['agencies_title'] . '</td>';
			echo '<td x:str>' . $row['top_agencies_title'] . '</td>';
			echo '<td x:str>' . $row['seller_agencies_title'] . '</td>';
			echo '<td x:str>' . $row['top_seller_agencies_title'] . '</td>';

            echo '<td x:str>' . $row['agency_types_title'] . '</td>';

            echo '<td x:str>' . $row['policy_payments_calendar_date'] . '</td>';
            echo '<td x:str>' . $row['policy_payments_calendar_end_date'] . '</td>';
            echo '<td x:str>' . $row['policy_payments_calendar_amount'] . '</td>';
            echo '<td x:str>' . $row['payment_statuses_title'] . '</td>';
            echo '<td x:str>' . $row['policy_payments_calendar_payment_date'] . '</td>';

            echo '<td x:str>' . $row['policy_payments_calendar_number_prolongation'] . '</td>';
            echo '<td x:str>' . $row['policy_payments_calendar_number_insurance_year'] . '</td>';
			echo '<td x:str>' . $row['is_agr_title'] . '</td>';
			echo '<td x:str>' . $row['second_fifty_fifty'] . '</td>';
            echo '<td x:str>' . $row['financial_institutions_title'] . '</td>';
			echo '<td x:str>' . $row['insurance_price'] . '</td>';
			echo '<td x:str>' . $row['insurer_person_types_id'] . '</td>';
			echo '<td x:str>' . (intval($row['service']) ? 'так' : 'ні') . '</td>';

            echo '<td style="mso-number-format:General">' . $row['number_part_payment'] . '</td>';
        echo '</tr>';
    }
?>
</table>
</body>
</html>