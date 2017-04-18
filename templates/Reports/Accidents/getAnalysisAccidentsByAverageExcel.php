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
.month TD {
	background-color: #00CCCC;
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
    <table width="600" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <td>&nbsp;</td>
			<td>Залишок на початок звітнього періоду, шт.</td>
			<td>Отримано в звітній період, шт.</td>
			<td>Врегульовано (виплата), шт.</td>										
			<td>Врегульовано (відмова, без виплати), шт.</td>
			<td>Призупинені, шт.</td>
			<td>Врегульовано, шт.</td>
			<td>Середній термін врегулювання справи, дн.</td>
			<td>Оборотність справ, %</td>
			<td>Залишок на кінець звітнього періоду, шт.</td>
        </tr>
        <?
            $total = array();
			$divisor = 24 * 60 * 60;
			foreach ($list as $key => $month) {
				foreach ($month as $row) {
					foreach ($fields as $field) {
						switch ($field) {
							case 'reversibility':
								break;
							default:
								$total[$key][$field] += $row[$field];
								break;
						}
					}
				}
				foreach ($fields as $field) {
					switch ($field) {
						case 'reversibility':
							break;
						default:
							$total[0][$field] += $total[$key][$field];
							break;
					}
				}
			}

			foreach ($list as $key => $month) {
				echo '<tr class="month">';
				echo '<td align="right"><b>' . $MONTHES[$key-1] . ' ' . $data['year'] . '</b></td>';
				foreach ($fields as $field) {
					switch ($field) {
						case 'reversibility':
							echo '<td align="right">' . roundNumber(($total[$key]['resolved_total'] / $total[$key]['new']) * 100, 2) . '</td>';
							break;
						case 'term':
							echo '<td align="right">' . intval(roundNumber(($total[$key][$field] / $divisor) / $total[$key]['resolved_total'], 2)) . 'дн.' . 
								roundNumber((roundNumber(($total[$key][$field] / $divisor) / $total[$key]['resolved_total'], 2) - intval(roundNumber(($total[$key][$field] / $divisor) / $total[$key]['resolved_total'], 2))) * 24, 0) . 'год.' . '</td>';
							break;
						default:
							echo '<td align="right">' . $total[$key][$field] . '</td>';
							break;
					}				
				}
				echo '</tr>';
				foreach ($month as $row) {
					echo '<tr>';
					echo '<td align="right"><i>' . $row['average_managers_name'] . '</i></td>';
					foreach ($fields as $field) {
						switch ($field) {
							case 'reversibility':
								echo '<td align="right"><i>' . roundNumber(($row['resolved_total'] / $row['new']) * 100, 2) . '</i></td>';
								break;
							case 'term':
								echo '<td align="right"><i>' . 
									intval(roundNumber(($row[$field] / $divisor) / $row['resolved_total'], 2)) . 'дн.' . 
									roundNumber((roundNumber(($row[$field] / $divisor) / $row['resolved_total'], 2) - intval(roundNumber(($row[$field] / $divisor) / $row['resolved_total'], 2))) * 24, 0) . 'год.' . 
									'</i></td>';
								break;
							default:
								echo '<td align="right"><i>' . $row[$field] . '</i></td>';
								break;
						}
					}
					echo '</tr>';
				}
			}
			echo '<tr class="columns">';
			if (sizeof($list) && is_array($list)) {
				echo '<td class="paging" align="right">Підсумок:</td>';
				foreach ($fields as $field) {
					switch ($field) {
						case 'begin_balance':
							echo '<td class="paging" align="right">' . $total[$data['monthes'][0]][$field] . '</td>';
							break;
						case 'end_balance':
							echo '<td class="paging" align="right">' . $total[$data['monthes'][sizeof($data['monthes']) - 1]][$field] . '</td>';
							break;
						case 'reversibility':
							echo '<td class="paging" align="right">' . roundNumber(($total[0]['resolved_total'] / $total[0]['new']) * 100, 2) . '</td>';
							break;
						case 'term':
							echo '<td class="paging" align="right">' . 
							intval(roundNumber(($total[0][$field] / $divisor) / $total[0]['resolved_total'], 2)) . 'дн.' . 
							roundNumber((roundNumber(($total[0][$field] / $divisor) / $total[0]['resolved_total'], 2) - intval(roundNumber(($total[0][$field] / $divisor) / $total[0]['resolved_total'], 2))) * 24, 0) . 'год.' . 
							'</td>';
							break;
						default:
							echo '<td class="paging" align="right">' . $total[0][$field] . '</td>';
							break;
					}
				}
				echo '</tr>';
			}
        ?>
    </table>
</body>
</html>