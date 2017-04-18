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

.text {
	mso-number-format:"\@";
}
</style>
</head>
<body>
    <table width="100%" cellpadding="5" cellspacing="0">
		<tr class="columns">
			<td></td>
			<td align="center">Справа</td>
			<td align="center">Статус</td>
			<td align="center">Договір/поліс</td>
			<td align="center">Страхувальник</td>
			<td align="center">Отримувач</td>
			<td align="center">Сума</td>
			<td align="center">К-сть днів від ДТП</td>
			<td align="center">Гранична дата прийняття рішення</td>
			<td align="center">Дата виплати</td>
			<td align="center">Гранична дата виплати</td>
			
			<? if ($data['payment_statuses_id'] == 1) { ?>
				<td>Планова дата виплати</td>
			<? } ?>
			<td align="center">Ринкова вартiсть</td>
			<td align="center">Тотальний збиток, %</td>
			<td align="center">Залишки, грн</td>
			<td align="center">Категорія</td>
			<td align="center">Дата заяви</td>
			<td align="center">Головна агенція</td>
			<td align="center">Канал</td>
			<td align="center">Аварійний комісар</td>
			
			<td align="center">ІПН Страхувальника</td>
			<td align="center">ІПН Отримувача</td>
			<td align="center">Потерпілий</td>
			<td align="center">ІПН Потерпілого</td>
		</tr>
		<?
			$total = array();
		
			foreach ($values as $id => $product_type) {			
				$count_total = 0;
				$amount_total = 0;
				
				foreach ($product_type['list'] as $recipient => $type) {
					if (!sizeof($type['list'])) continue;
					
					$count = 0;
					$amount = 0;
					
					foreach ($type['list'] as $row) {
						$count++;
						$amount += $row['amount'];
					}
					$count_total += $count;
					$amount_total += $amount;
					
					$total[$id][$recipient]['count'] = $count;
					$total[$id][$recipient]['amount'] = $amount;
				}
				
				$total[$id]['total']['count'] = $count_total;
				$total[$id]['total']['amount'] = $amount_total;
				
				$total['count'] += $count_total;
				$total['amount'] += $amount_total;
			}
		
			foreach ($values as $id => $product_type) {
				if ($data['payment_statuses_id'] == 1) {
					echo '<tr class="columns"><td>' . $product_type['title'] . '</td><td colspan="11">Всього: ' . $total[$id]['total']['count'] .  ' шт. на суму ' . $total[$id]['total']['amount'] . ' грн.</td></tr>';
				} else {
					echo '<tr class="columns"><td>' . $product_type['title'] . '</td><td colspan="10">Всього: ' . $total[$id]['total']['count'] .  ' шт. на суму ' . $total[$id]['total']['amount'] . ' грн.</td></tr>';
				}											
				
				foreach ($product_type['list'] as $recipient => $type) {
					if (!sizeof($type['list'])) continue;
					
					if ($data['payment_statuses_id'] == 1) {
						echo '<tr bgcolor="1c94e4"><td valign="top" >' . $type['title'] . '</td><td colspan="11">Всього: ' . $total[$id][$recipient]['count'] .  ' шт. на суму ' . $total[$id][$recipient]['amount'] . ' грн.</td></tr>';
					} else {
						echo '<tr bgcolor="1c94e4"><td valign="top" >' . $type['title'] . '</td><td colspan="10">Всього: ' . $total[$id][$recipient]['count'] .  ' шт. на суму ' . $total[$id][$recipient]['amount'] . ' грн.</td></tr>';
					}
					
					foreach ($type['list'] as $row) {
						echo '<tr>';
						echo '<td></td>';
						echo '<td class="text">' . $row['accidents_number'] . '</td>';
						echo '<td>' . $row['statuses_title'] . '</td>';
						echo '<td>' . $row['policies_number'] . '</td>';
						echo '<td>' . $row['insurer'] . '</td>';
						echo '<td>' . $row['recipient'] . '</td>';
						echo '<td>' . $row['amount'] . '</td>';
						echo '<td>' . $row['term'] . '</td>';
						echo '<td>' . $row['limit_acts_date'] . '</td>';
						echo '<td>' . $row['payment_date'] . '</td>';
						echo '<td>' . $row['theory_limit_payment_date'] . '</td>';
						if ($data['payment_statuses_id'] == 1) {
							echo '<td width="110">
									' . $row['real_limit_payment_date'] . '
								  </td>';
						}
						echo '<td>' . $row['market_price'] . '</td>';
						echo '<td>' . $row['extent_damage_percent'] . '</td>';
						echo '<td>' . $row['amount_residual'] . '</td>';
						echo '<td>' . $row['sections_title'] . '</td>';
						echo '<td>' . $row['accidents_date'] . '</td>';
						echo '<td>' . $row['agencies_parent_title'] . '</td>';
						echo '<td>' . $row['agency_types_title'] . '</td>';
						echo '<td>' . $row['average_manager'] . '</td>';

						echo '<td>' . $row['clients_identification_code'] .'</td>';
						echo '<td>' . $row['recipient_identification_code'] . '</td>';
						echo '<td>' . $row['owner_name'] .'</td>';
						echo '<td>' . $row['owner_identification_code'] . '</td>';

						echo '</tr>';
					}
				}
			}
			
			if ($data['payment_statuses_id'] == 1) {
				echo '<tr class="navigation"><td valign="top" >Всього: ' . $total['count'] .  ' шт. на суму ' . $total['amount'] . ' грн.</td><td colspan="11"></td></tr>';
			} else {
				echo '<tr class="navigation"><td valign="top" >Всього: ' . $total['count'] .  ' шт. на суму ' . $total['amount'] . ' грн.</td><td colspan="10"></td></tr>';
			}
		?>
	</table>
</body>
</html>