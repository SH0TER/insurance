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
    <table width="100%" cellpadding="5" cellspacing="0">
		<tr class="columns">
			<td></td>
			<? 
				foreach ($days as $day) {
					echo '<td>' . $day . '</td>';
				}
			?>
		</tr>
		<?
			$totals = array();
		
			foreach ($values as $id => $product_type) {								
				$count_total = 0;
				$amount_total = 0;
				
				foreach ($product_type['list'] as $recipient => $type) {
					if (!sizeof($type['list'])) continue;

					foreach ($days as $day) {
						$count[$day] = 0;
						$amount[$day] = 0;
						
						if ($recipient == 'car_services_ukravto') {
							foreach ($type['list'] as $recipients_id => $recipients_id_data) {
								foreach ($recipients_id_data['list'][date('Y-m-d', strtotime($day))] as $row) {
									$totals[$id][$recipient][$recipients_id][$day]['count']++;
									$totals[$id][$recipient][$recipients_id][$day]['amount'] += $row['amount'];
									
									$count[$day]++;
									$amount[$day] += $row['amount'];
								}
							}
						} else {
							foreach ($type['list'][date('Y-m-d', strtotime($day))] as $row) {
								$count[$day]++;
								$amount[$day] += $row['amount'];
							}
						}
					}
					
					foreach ($days as $day) {
						$totals[$id][$recipient][$day]['count'] = $count[$day];
						$totals[$id][$recipient][$day]['amount'] = $amount[$day];
						
						$totals[$id][$day]['count'] += $count[$day];
						$totals[$id][$day]['amount'] += $amount[$day];
					}
				}
				
				foreach ($days as $day) {
					
				}
			}
		
			foreach ($values as $id => $product_type) {
				echo '<tr class="columns">
						<td>' . $product_type['title'] . '</a></td>';
				foreach ($days as $day) {
					echo '<td>' . intval($totals[$id][$day]['count']) .  ' шт. - ' . (float)$totals[$id][$day]['amount'] . ' грн.</td>';
				}
				echo '</tr>';
				
				$count_total = 0;
				$amount_total = 0;
				
				foreach ($product_type['list'] as $recipient => $type) {
					if (!sizeof($type['list'])) continue;
					
					echo '<tr bgcolor="808080" class="rows' . $id . '">
							<td valign="top" nowrap>' . $type['title'] . '</a></td>';
					foreach ($days as $day) {
						echo '<td>' . intval($totals[$id][$recipient][$day]['count']) .  ' шт. - ' . (float)$totals[$id][$recipient][$day]['amount'] . ' грн.</td>';
					}
					echo '</tr>';
					
					if ($recipient == 'car_services_ukravto') {													
						$prev_recipients_id = 0;
						foreach ($type['list'] as $recipients_id => $recipients_id_data) {
							echo '<tr bgcolor="cccccc"><td valign="top" nowrap>' . $recipients_id_data['title'] . '</td>';
							foreach ($days as $day) {
								echo '<td>' . intval($totals[$id][$recipient][$recipients_id][$day]['count']) .  ' шт. - ' . (float)$totals[$id][$recipient][$recipients_id][$day]['amount'] . ' грн.</td>';
							}
							echo '</tr>';
							echo '<tr><td></td>';
							foreach ($days as $day) {
								echo '<td nowrap valign="top">';
								foreach ($recipients_id_data['list'][date('Y-m-d', strtotime($day))] as $row) {
									echo $row['accidents_number'] . ' ' . $row['amount'] . '<br/>';
								}
								echo '</td>';
							}
						}
						
					} else {
						echo '<tr><td></td>';
						foreach ($days as $day) {
							echo '<td nowrap valign="top">';
							foreach ($type['list'][date('Y-m-d', strtotime($day))] as $row) {
								echo $row['accidents_number'] . ' ' . $row['amount'] . '<br/>';
							}
							echo '</td>';
						}
					}
					
					echo '</tr>';
				}
			}
			
			echo '<tr class="navigation">';
			echo '<td>Всього: </td>';
			foreach ($days as $day) {
				$count = 0;
				$amount = 0;
				foreach ($product_types_idx as $product_types_id => $title) {
					$count += $totals[$product_types_id][$day]['count'];
					$amount += $totals[$product_types_id][$day]['amount'];
				}
				echo '<td>' . intval($count) .  ' шт. - ' . (float)$amount . ' грн.</td>';
			}
			echo '</tr>';
		?>
	</table>
</body>
</html>