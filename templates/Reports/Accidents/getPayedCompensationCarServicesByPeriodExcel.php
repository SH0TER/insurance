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
<? if (sizeOf($values['car_services'])) {?>
					<table width="100%" cellpadding="0" cellspacing="0"  border="1">
						<tr class="columns">
							<td rowspan="2">Підприємство</td>
							<? foreach ($periods_format as $period_format) {
								echo '<td colspan="3">Всього ' . $period_format['begin'] . ' по ' . $period_format['end'] . '</td>';
							} ?>
							<td colspan="3">Всього за <?=mb_convert_case($MONTHES[intval($data['month']) - 1], MB_CASE_LOWER, "UTF-8")?> <?=$data['year']?>р.</td>
						</tr>
						<tr class="columns">
							<? foreach ($periods_format as $period_format) {
								echo '<td>Сплачено</td>';
								echo '<td>Франшиза</td>';
								echo '<td>Вартість ВР</td>';
							} 
							echo '<td>Сплачено</td>';
							echo '<td>Франшиза</td>';
							echo '<td>Вартість ВР</td>';
							?>
						</tr>
						<?
							$periods_amount = array();
							foreach ($values['car_services'][1] as $row) {
								$i = 1 - $i;
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
								$global_payed_amount = array();
								$global_deductibles_amount = array();
								$global_repair_amount = array();
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['title']?></td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td>' . getRateFormat($row['periods'][$key]['payed_amount'], 2) . '</td>';
								$total_payed_amount += $row['periods'][$key]['payed_amount'];
								echo '<td>' . getRateFormat($row['periods'][$key]['deductibles_amount'], 2) . '</td>';
								$total_deductibles_amount += $row['periods'][$key]['deductibles_amount'];
								echo '<td>' . getRateFormat($row['periods'][$key]['repair_amount'], 2) . '</td>';
								$total_repair_amount += $row['periods'][$key]['repair_amount'];
								
								$periods_amount[$key]['payed_amount'] += $row['periods'][$key]['payed_amount'];
								$periods_amount[$key]['deductibles_amount'] += $row['periods'][$key]['deductibles_amount'];
								$periods_amount[$key]['repair_amount'] += $row['periods'][$key]['repair_amount'];
							} 
							echo '<td>' . getRateFormat($total_payed_amount, 2) . '</td>';
							echo '<td>' . getRateFormat($total_deductibles_amount, 2) . '</td>';
							echo '<td>' . getRateFormat($total_repair_amount, 2) . '</td>';
							?>
						</tr>
						<?
							}
						?>
						<tr class="columns">
							<td class="paging">Всього по Києву та обл.:</td>
							<? 
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
								foreach ($periods_format as $key => $period_format) {
									echo '<td>' . getRateFormat($periods_amount[$key]['payed_amount'], 2) . '</td>';
									$total_payed_amount += $periods_amount[$key]['payed_amount'];
									echo '<td>' . getRateFormat($periods_amount[$key]['deductibles_amount'], 2) . '</td>';
									$total_deductibles_amount += $periods_amount[$key]['deductibles_amount'];
									echo '<td>' . getRateFormat($periods_amount[$key]['repair_amount'], 2) . '</td>';
									$total_repair_amount += $periods_amount[$key]['repair_amount'];
									
									$global_payed_amount[$key] += $periods_amount[$key]['payed_amount'];
									$global_deductibles_amount[$key] +=  $periods_amount[$key]['deductibles_amount'];
									$global_repair_amount[$key] += $periods_amount[$key]['repair_amount'];
								} 
								echo '<td>' . getRateFormat($total_payed_amount, 2) . '</td>';
								echo '<td>' . getRateFormat($total_deductibles_amount, 2) . '</td>';
								echo '<td>' . getRateFormat($total_repair_amount, 2) . '</td>';
								$global_payed_amount['period'] += $total_payed_amount;
								$global_deductibles_amount['period'] += $total_deductibles_amount;
								$global_repair_amount['period'] += $total_repair_amount;								
							?>						
						</tr>
						
						<?
							$periods_amount = array();
							foreach ($values['car_services'][0] as $row) {
								$i = 1 - $i;
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['title']?></td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td>' . getRateFormat($row['periods'][$key]['payed_amount'], 2) . '</td>';
								$total_payed_amount += $row['periods'][$key]['payed_amount'];
								echo '<td>' . getRateFormat($row['periods'][$key]['deductibles_amount'], 2) . '</td>';
								$total_deductibles_amount += $row['periods'][$key]['deductibles_amount'];
								echo '<td>' . getRateFormat($row['periods'][$key]['repair_amount'], 2) . '</td>';
								$total_repair_amount += $row['periods'][$key]['repair_amount'];
								
								$periods_amount[$key]['payed_amount'] += $row['periods'][$key]['payed_amount'];
								$periods_amount[$key]['deductibles_amount'] += $row['periods'][$key]['deductibles_amount'];
								$periods_amount[$key]['repair_amount'] += $row['periods'][$key]['repair_amount'];
							} 
							echo '<td>' . getRateFormat($total_payed_amount, 2) . '</td>';
							echo '<td>' . getRateFormat($total_deductibles_amount, 2) . '</td>';
							echo '<td>' . getRateFormat($total_repair_amount, 2) . '</td>';
							?>
						</tr>
						<?
							}
						?>
						<tr class="columns">
							<td class="paging">Всього по регіонам:</td>
							<? 
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
								foreach ($periods_format as $key => $period_format) {
									echo '<td>' . getRateFormat($periods_amount[$key]['payed_amount'], 2) . '</td>';
									$total_payed_amount += $periods_amount[$key]['payed_amount'];
									echo '<td>' . getRateFormat($periods_amount[$key]['deductibles_amount'], 2) . '</td>';
									$total_deductibles_amount += $periods_amount[$key]['deductibles_amount'];
									echo '<td>' . getRateFormat($periods_amount[$key]['repair_amount'], 2) . '</td>';
									$total_repair_amount += $periods_amount[$key]['repair_amount'];
									
									$global_payed_amount[$key] += $periods_amount[$key]['payed_amount'];
									$global_deductibles_amount[$key] += $periods_amount[$key]['deductibles_amount'];
									$global_repair_amount[$key] += $periods_amount[$key]['repair_amount'];
								} 
								echo '<td>' . getRateFormat($total_payed_amount, 2) . '</td>';
								echo '<td>' . getRateFormat($total_deductibles_amount, 2) . '</td>';
								echo '<td>' . getRateFormat($total_repair_amount, 2) . '</td>';
								$global_payed_amount['period'] += $total_payed_amount;
								$global_deductibles_amount['period'] += $total_deductibles_amount;
								$global_repair_amount['period'] += $total_repair_amount;
							?>						
						</tr>
						
						<?
							$periods_amount = array();
							foreach ($values['clients'][1] as $row) {
								$i = 1 - $i;
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['title']?></td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td>' . getRateFormat($row['periods'][$key]['payed_amount'], 2) . '</td>';
								$total_payed_amount += $row['periods'][$key]['payed_amount'];
								echo '<td>' . getRateFormat($row['periods'][$key]['deductibles_amount'], 2) . '</td>';
								$total_deductibles_amount += $row['periods'][$key]['deductibles_amount'];
								echo '<td>' . getRateFormat($row['periods'][$key]['repair_amount'], 2) . '</td>';
								$total_repair_amount += $row['periods'][$key]['repair_amount'];
								
								$periods_amount[$key]['payed_amount'] += $row['periods'][$key]['payed_amount'];
								$periods_amount[$key]['deductibles_amount'] += $row['periods'][$key]['deductibles_amount'];
								$periods_amount[$key]['repair_amount'] += $row['periods'][$key]['repair_amount'];
							} 
							echo '<td>' . getRateFormat($total_payed_amount, 2) . '</td>';
							echo '<td>' . getRateFormat($total_deductibles_amount, 2) . '</td>';
							echo '<td>' . getRateFormat($total_repair_amount, 2) . '</td>';							
							?>
						</tr>
						<?
							}
						?>
						<tr class="columns">
							<td class="paging">Всього по корпоративним Клієнтам:</td>
							<? 
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
								foreach ($periods_format as $key => $period_format) {
									echo '<td>' . getRateFormat($periods_amount[$key]['payed_amount'], 2) . '</td>';
									$total_payed_amount += $periods_amount[$key]['payed_amount'];
									echo '<td>' . getRateFormat($periods_amount[$key]['deductibles_amount'], 2) . '</td>';
									$total_deductibles_amount += $periods_amount[$key]['deductibles_amount'];
									echo '<td>' . getRateFormat($periods_amount[$key]['repair_amount'], 2) . '</td>';
									$total_repair_amount += $periods_amount[$key]['repair_amount'];
									
									$global_payed_amount[$key] += $periods_amount[$key]['payed_amount'];
									$global_deductibles_amount[$key] += $periods_amount[$key]['deductibles_amount'];
									$global_repair_amount[$key] += $periods_amount[$key]['repair_amount'];
								} 
								echo '<td>' . getRateFormat($total_payed_amount, 2) . '</td>';
								echo '<td>' . getRateFormat($total_deductibles_amount, 2) . '</td>';
								echo '<td>' . getRateFormat($total_repair_amount, 2) . '</td>';
								$global_payed_amount['period'] += $total_payed_amount;
								$global_deductibles_amount['period'] += $total_deductibles_amount;
								$global_repair_amount['period'] += $total_repair_amount;
							?>						
						</tr>
						<tr class="columns">
							<td class="paging">Всього загалом:</td>
							<? 
								$total_payed_amount = 0;
								$total_deductibles_amount = 0;
								$total_repair_amount = 0;
								foreach ($periods_amount as $key => $period_amount) {
									echo '<td>' . getRateFormat($global_payed_amount[$key], 2) . '</td>';
									echo '<td>' . getRateFormat($global_deductibles_amount[$key], 2) . '</td>';
									echo '<td>' . getRateFormat($global_repair_amount[$key], 2) . '</td>';
								} 
								echo '<td>' . getRateFormat($global_payed_amount['period'], 2) . '</td>';
								echo '<td>' . getRateFormat($global_deductibles_amount['period'], 2) . '</td>';
								echo '<td>' . getRateFormat($global_repair_amount['period'], 2) . '</td>';
							?>	
						</tr>
					</table>
					<? } ?>
</body>
</html>