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
<table width="100%" cellpadding="2" cellspacing="0" border="1">
					<tr class="columns" align="center">
						<td colspan="7">Договір</td>
						<td colspan="5">Об'єкт</td>
						<td colspan="12">Періоди</td>
						<td colspan="6">Страхові випадки</td>
					</tr>
					<tr class="columns" align="center">
						<td>№ договору</td>
						<td>Страхувальник</td>
						<td>ІПН / код ЄДРПОУ</td>
						<td>Дата укладання</td>
						<td>Дата початку</td>
						<td>Дата закінчення</td>
						<td>Статус договору</td>
						
						<td>Марка</td>
						<td>Модель</td>
						<td>Тип ТЗ</td>
						<td>Державний № ТЗ</td>
						<td>Шасі / VIN</td>
						
						<td>Дата початку</td>
						<td>Дата закінчення</td>
						<td>Пролонгація</td>
						<td>Страхова сума</td>
						<td>Нарахована премія, грн.</td>
						<td>Оплачена премія, грн.</td>
						<td>Страховий тариф, %</td>
						<td>Франшиза (за ризиком НЗ), грн.</td>
						<td>Франшиза (за іншими ризиками), грн.</td>
						<!--td>Компенсація банку</td>
						<td>Знижка банку</td-->
						<td>Комісія агенту</td>
						<td>Комісія директора</td>
						<td>Комісія заст. директора</td>
						
						<td>№ справи</td>
						<td>Дата повідомлення</td>
						<td>Дата випадку</td>
						<td>Ризик</td>
						<td>Орієнтовний збиток, грн.</td>
						<td>Сума врегульованих збитків, грн.</td>
					</tr>
				<?
					$i = 0;
					$counter = 0;
					$items_id = -1;
					$policies_number = '';
					$shassi = '';
					$item = '';
					
					$items = array();
					$periods_id = array();
					$periods = array();
					$accidents_id = array();
					$accidents = array();
					$accidents_count = 0;
					foreach ($list as $row) {
						$counter++;
						$i = 1 - $i;
						
						if ($shassi != $row['item_shassi']) {
							if ($shassi != '') {						
								$previous_periods_id = 0;
								foreach ($items as $item) {
									echo '<tr>';
									if ($previous_periods_id == 0) {
									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['policies_number'];
										echo '</td>';									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['insurer'];
										echo '</td>';									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['insurer_code'];
										echo '</td>';									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['policies_date'];
										echo '</td>';									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['policies_begin_date'];
										echo '</td>';									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['policies_end_date'];
										echo '</td>';									
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['policy_statuses_title'];
										echo '</td>';									
										
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['item_brand'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['item_model'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['car_types_title'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['item_sign'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['item_shassi'];
										echo '</td>';
										
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['period_begin_date'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['period_end_date'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['prolongation'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['car_price']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['item_payments_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['item_payments_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['car_rate']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['deductibles_amount_max']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['deductibles_amount_min']);
										echo '</td>';
										/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['commission_financial_institution_amount'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo '-1000';
										echo '</td>';*/
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['commission_agent_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['commission_director1_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['commission_director2_amount']);
										echo '</td>';
										
										echo '<td>';
											echo $item['accidents_number'];
										echo '</td>';
										echo '<td>';
											echo $item['accidents_date'];
										echo '</td>';
										echo '<td>';
											echo $item['accidents_datetime'];
										echo '</td>';
										echo '<td>';
											echo $item['parameters_risks_title'];
										echo '</td>';
										echo '<td>';
											echo str_replace('.', ',', $item['amount_rough']);
										echo '</td>';
										echo '<td>';
											echo (intval($item['accidents_id'])) ? str_replace('.', ',', $item['accident_compensation']) : '';
										echo '</td>';
										
										echo '</tr>';
										$previous_periods_id = $item['periods_id'];
										continue;
									} 
									
									if ($item['periods_id'] != $previous_periods_id) {
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['period_begin_date'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['period_end_date'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['prolongation'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['car_price']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['item_payments_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['item_payments_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['car_rate']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['deductibles_amount_max']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['deductibles_amount_min']);
										echo '</td>';
										/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['commission_financial_institution_amount'];
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo '-1000';
										echo '</td>';*/
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['commission_agent_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['commission_director1_amount']);
										echo '</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo str_replace('.', ',', $item['commission_director2_amount']);
										echo '</td>';
										
										echo '<td>';
											echo $item['accidents_number'];
										echo '</td>';
										echo '<td>';
											echo $item['accidents_date'];
										echo '</td>';
										echo '<td>';
											echo $item['accidents_datetime'];
										echo '</td>';
										echo '<td>';
											echo $item['parameters_risks_title'];
										echo '</td>';
										echo '<td>';
											echo str_replace('.', ',', $item['amount_rough']);
										echo '</td>';
										echo '<td>';
											echo (intval($item['accidents_id'])) ? str_replace('.', ',', $item['accident_compensation']) : '';
										echo '</td>';
										
										echo '</tr>';
										$previous_periods_id = $item['periods_id'];
										continue;
									}
									
									echo '<td>';
										echo $item['accidents_number'];
									echo '</td>';
									echo '<td>';
										echo $item['accidents_date'];
									echo '</td>';
									echo '<td>';
										echo $item['accidents_datetime'];
									echo '</td>';
									echo '<td>';
										echo $item['parameters_risks_title'];
									echo '</td>';
									echo '<td>';
										echo str_replace('.', ',', $item['amount_rough']);
									echo '</td>';
									echo '<td>';
										echo (intval($item['accidents_id'])) ? str_replace('.', ',', $item['accident_compensation']) : '';
									echo '</td>';
									
									echo '</tr>';
									$previous_periods_id = $item['periods_id'];
								}					
							}
							$shassi = $row['item_shassi'];
							$items = array();
							$periods_id = array();
							$periods = array();
							$accidents_id = array();
							$accidents = array();	
							$items[] = $row;
							$periods_id[] = $row['periods_id'];
							$periods[$row['periods_id']] = array(
								'period_begin_date' 						=> $row['period_begin_date'], 
								'period_end_date' 							=> $row['period_end_date'],
								'prolongation'								=> $row['prolongation'],
								'car_price'									=> $row['car_price'],
								'item_payments_amount'						=> $row['item_payments_amount'],
								'car_rate'									=> $row['car_rate'],
								'deductibles_amount_max'					=> $row['deductibles_amount_max'],
								'deductibles_amount_min'					=> $row['deductibles_amount_min'],
								'commission_financial_institution_amount'	=> $row['commission_financial_institution_amount'],
								'commission_agent_amount'					=> $row['commission_agent_amount'],
								'commission_director1_amount'				=> $row['commission_director1_amount'],
								'commission_director2_amount'				=> $row['commission_director2_amount']);						
							$accidents_id[$row['periods_id']][] = $row['accidents_id'];
							$accidents[$row['periods_id']][$row['accidents_id']] = array(
								'accidents_number'									=> $row['accidents_number'],
								'accidents_date'									=> $row['accidents_date'],
								'accidents_datetime'								=> $row['accidents_datetime'],
								'parameters_risks_title'							=> $row['parameters_risks_title'],
								'amount_rough'										=> $row['amount_rough'],
								'accident_compensation'								=> $row['accident_compensation']);
							$accidents_count++;
						} else {
							$items[] = $row;
							if (!in_array($row['periods_id'], $periods_id)) {
								$periods_id[] = $row['periods_id'];
								$periods[$row['periods_id']] = array(
									'period_begin_date' 						=> $row['period_begin_date'], 
									'period_end_date' 							=> $row['period_end_date'],
									'prolongation'								=> $row['prolongation'],
									'car_price'									=> $row['car_price'],
									'item_payments_amount'						=> $row['item_payments_amount'],
									'car_rate'									=> $row['car_rate'],
									'deductibles_amount_max'					=> $row['deductibles_amount_max'],
									'deductibles_amount_min'					=> $row['deductibles_amount_min'],
									'commission_financial_institution_amount'	=> $row['commission_financial_institution_amount'],
									'commission_agent_amount'					=> $row['commission_agent_amount'],
									'commission_director1_amount'				=> $row['commission_director1_amount'],
									'commission_director2_amount'				=> $row['commission_director2_amount']);
								}
							if (!in_array($row['accidents_id'], $accidents_id[$row['periods_id']])) {
								$accidents_id[$row['periods_id']][] = $row['accidents_id'];
								$accidents[$row['periods_id']][$row['accidents_id']] = array(
									'accidents_number'									=> $row['accidents_number'],
									'accidents_date'									=> $row['accidents_date'],
									'accidents_datetime'								=> $row['accidents_datetime'],
									'parameters_risks_title'							=> $row['parameters_risks_title'],
									'amount_rough'										=> $row['amount_rough'],
									'accident_compensation'								=> $row['accident_compensation']);
								$accidents_count++;
							}
						}						
					}
					
					if ($shassi != '') {						
						$previous_periods_id = 0;
						foreach ($items as $item) {
							echo '<tr>';
							if ($previous_periods_id == 0) {
							
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['policies_number'];
								echo '</td>';									
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['insurer'];
								echo '</td>';									
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['insurer_code'];
								echo '</td>';									
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['policies_date'];
								echo '</td>';									
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['policies_begin_date'];
								echo '</td>';									
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['policies_end_date'];
								echo '</td>';									
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['policy_statuses_title'];
								echo '</td>';									
								
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['item_brand'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['item_model'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['car_types_title'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['item_sign'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['item_shassi'];
								echo '</td>';
								
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['period_begin_date'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['period_end_date'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['prolongation'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['car_price']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['item_payments_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['item_payments_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['car_rate']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['deductibles_amount_max']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['deductibles_amount_min']);
								echo '</td>';
								/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['commission_financial_institution_amount'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo '-1000';
								echo '</td>';*/
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['commission_agent_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['commission_director1_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['commission_director2_amount']);
								echo '</td>';
								
								echo '<td>';
									echo $item['accidents_number'];
								echo '</td>';
								echo '<td>';
									echo $item['accidents_date'];
								echo '</td>';
								echo '<td>';
									echo $item['accidents_datetime'];
								echo '</td>';
								echo '<td>';
									echo $item['parameters_risks_title'];
								echo '</td>';
								echo '<td>';
									echo str_replace('.', ',', $item['amount_rough']);
								echo '</td>';
								echo '<td>';
									echo (intval($item['accidents_id'])) ? str_replace('.', ',', $item['accident_compensation']) : '';
								echo '</td>';
								
								echo '</tr>';
								$previous_periods_id = $item['periods_id'];
								continue;
							} 
							
							if ($item['periods_id'] != $previous_periods_id) {
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['period_begin_date'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['period_end_date'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['prolongation'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['car_price']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['item_payments_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['item_payments_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['car_rate']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['deductibles_amount_max']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['deductibles_amount_min']);
								echo '</td>';
								/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['commission_financial_institution_amount'];
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo '-1000';
								echo '</td>';*/
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['commission_agent_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['commission_director1_amount']);
								echo '</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo str_replace('.', ',', $item['commission_director2_amount']);
								echo '</td>';
								
								echo '<td>';
									echo $item['accidents_number'];
								echo '</td>';
								echo '<td>';
									echo $item['accidents_date'];
								echo '</td>';
								echo '<td>';
									echo $item['accidents_datetime'];
								echo '</td>';
								echo '<td>';
									echo $item['parameters_risks_title'];
								echo '</td>';
								echo '<td>';
									echo str_replace('.', ',', $item['amount_rough']);
								echo '</td>';
								echo '<td>';
									echo (intval($item['accidents_id'])) ? str_replace('.', ',', $item['accident_compensation']) : '';
								echo '</td>';
								
								echo '</tr>';
								$previous_periods_id = $item['periods_id'];
								continue;
							}
							
							echo '<td>';
								echo $item['accidents_number'];
							echo '</td>';
							echo '<td>';
								echo $item['accidents_date'];
							echo '</td>';
							echo '<td>';
								echo $item['accidents_datetime'];
							echo '</td>';
							echo '<td>';
								echo $item['parameters_risks_title'];
							echo '</td>';
							echo '<td>';
								echo str_replace('.', ',', $item['amount_rough']);
							echo '</td>';
							echo '<td>';
								echo (intval($item['accidents_id'])) ? str_replace('.', ',', $item['accident_compensation']) : '';
							echo '</td>';
							
							echo '</tr>';
							$previous_periods_id = $item['periods_id'];
						}					
					}
				?>
				</table>
<? } ?>
</body>
</html>