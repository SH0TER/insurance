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
    if ($res)
    ?>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <?
                {
                    echo '<table width="100%" cellpadding="0" cellspacing="0">';
                    echo '<tr class="columns" align="center">';
						echo '<td>Страхувальник</td>';
						echo '<td>ІПН/ЄДРПОУ</td>';
						echo '<td>Номер договору/полісу</td>';
						echo '<td>Об\'єкт</td>';
						echo '<td>Вид страхування</td>';
						echo '<td>Початок періоду</td>';
						echo '<td>Кінець періоду</td>';
						echo '<td>Пролонгація</td>';
						echo '<td>Рік</td>';
						echo '<td>Страхова сума</td>';
						echo '<td>Страхова премія</td>';
						echo '<td>Повернута страхова премія</td>';
						echo '<td>Дата сплати</td>';
						echo '<td>Сума СВ</td>';
						echo '<td>Сума ВЗ</td>';
						echo '<td>Сума резервів</td>';
						echo '<td>Вигодонабувач</td>';
						echo '<td>Агенція</td>';
						echo '<td>Банк</td>';
						echo '<td>Канал продажу</td>';						
                    echo '</tr>';
                    //while($res->fetchInto($row)) {
					foreach ($res as $row) {
						if (in_array($row['agencies_id'], array(1, 1469))) {
							$seller = 'ТДВ "Експрес Страхування"';
						} elseif ($row['agencies_top'] == 556) {
							$seller = 'Раєвська Оксана Всеволодівна';
						} elseif ($row['agencies_ukravto'] == 1) {
							$seller = 'УкрАВТО';
						} elseif ($row['agencies_financial_institutions_id'] > 0) {
							$seller = 'Банк';
						} else {
							$seller = 'Інші';
						}
					
                        echo '<tr>';
                            echo '<td x:str>' . $row['insurer'] . '</td>';
							echo '<td x:str>' . $row['insurer_code'] . '</td>';
							echo '<td x:str>' . $row['policies_number'] . '</td>';
							echo '<td x:str>' . $row['policies_item'] . '</td>';
							echo '<td x:str>' . $row['product_types_title'] . '</td>';
							echo '<td x:str>' . $row['begin_period'] . '</td>';
							echo '<td x:str>' . $row['end_period'] . '</td>';
							echo '<td x:str>' . $row['prolongation'] . '</td>';
							echo '<td x:str>' . $row['insurance_year'] . '</td>';
							echo '<td style=\'mso-number-format:"0\.00"\'>' . str_replace('.', ',', $row['insurance_price']) . '</td>';
							echo '<td style=\'mso-number-format:"0\.00"\'>' . str_replace('.', ',', $row['policy_payments_amount']) . '</td>';
							echo '<td style=\'mso-number-format:"0\.00"\'>' . str_replace('.', ',', $row['policy_payments_return_amount']) . '</td>';
							echo '<td x:str>' . $row['payments_date'] . '</td>';
							echo '<td style=\'mso-number-format:"0\.00"\'>' . str_replace('.', ',', $row['accident_payments_amount']) . '</td>';
							echo '<td style=\'mso-number-format:"0\.00"\'>' . str_replace('.', ',', $row['part_premium_payments_amount']) . '</td>';
							echo '<td style=\'mso-number-format:"0\.00"\'>' . str_replace('.', ',', $row['reserve_payments_amount']) . '</td>';
							echo '<td x:str>' . $row['assured_title'] . '</td>';
							echo '<td x:str>' . $row['agencies_title'] . '</td>';
							echo '<td x:str>' . $row['bank'] . '</td>';
							echo '<td x:str>' . $seller . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>