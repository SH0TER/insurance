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
<? if (sizeOf($values)) {?>
	<table width="100%" cellpadding="0" cellspacing="0"  border="1">
		<tr class="columns">
			<td rowspan="2"></td>
			<? foreach ($periods_format as $period_format) {
				echo '<td style=\'mso-number-format:"\@"\' colspan="2" align="center">' . date('d', strtotime($period_format['begin'])) . ' - ' . date('d.m', strtotime($period_format['end'])) . '</td>';
			} ?>
			<td colspan="2">Всього за <?=mb_convert_case($MONTHES[intval($data['month']) - 1], MB_CASE_LOWER, "UTF-8")?> <?=$data['year']?>р.</td>
		</tr>
		
		<tr class="columns">
			<? foreach ($periods_format as $period_format) {
				echo '<td>КАСКО</td>';
				echo '<td>ОСЦПВ</td>';
			} ?>
			<td>КАСКО</td>
			<td>ОСЦПВ</td>
		</tr>
		
		<tr class="columns">
			<td>Направлені</td>
			<td colspan="<?=(sizeOf($periods_format) * 2 + 2)?>"></td>
		</tr>
		
		<?	
			$total_by_period = array();
			$total_by_sto = array();
			$total = array();
			foreach ($values as $id => $row) {				
		?>
		<tr>
			<td><?=$row['title']?></td>
			<? foreach ($periods_format as $key => $period_format) {
				echo '<td align="right">' . intval($row['data']['sent'][$key]['kasko']['count']) . '</td>';
				echo '<td align="right">' . intval($row['data']['sent'][$key]['go']['count']) . '</td>';
				
				$total_by_period[$key]['kasko'] += intval($row['data']['sent'][$key]['kasko']['count']);
				$total_by_period[$key]['go'] += intval($row['data']['sent'][$key]['go']['count']);
				
				$total_by_sto[$id]['kasko'] += intval($row['data']['sent'][$key]['kasko']['count']);
				$total_by_sto[$id]['go'] += intval($row['data']['sent'][$key]['go']['count']);
			} 
			?>
			
			<td><?=$total_by_sto[$id]['kasko']?></td>
			<td><?=$total_by_sto[$id]['go']?></td>
			
			<?
			
				$total['kasko'] += $total_by_sto[$id]['kasko'];
				$total['go'] += $total_by_sto[$id]['go'];
			
			?>
			
		</tr>
		<?
			}
		?>
		<tr class="columns">
			<td>Всього</td>
			<? foreach ($periods_format as $key => $period_format) {
				echo '<td align="right">' . $total_by_period[$key]['kasko'] . '</td>';
				echo '<td align="right">' . $total_by_period[$key]['go'] . '</td>';
			} ?>
			<td align="right"><?=$total['kasko']?></td>
			<td align="right"><?=$total['go']?></td>
		</tr>
		
		<tr><td colspan="<?=(sizeOf($periods_format) * 2 + 3)?>"></td></tr>
		
		<tr class="columns">
			<td>Прийняті</td>
			<td colspan="<?=(sizeOf($periods_format) * 2 + 2)?>"></td>
		</tr>
		
		<?	
			$total_by_period = array();
			$total_by_sto = array();
			$total = array();
			foreach ($values as $id => $row) {				
		?>
		<tr>
			<td><?=$row['title']?></td>
			<? foreach ($periods_format as $key => $period_format) {
				echo '<td align="right">' . intval($row['data']['accepted'][$key]['kasko']['count']) . '</td>';
				echo '<td align="right">' . intval($row['data']['accepted'][$key]['go']['count']) . '</td>';
				
				$total_by_period[$key]['kasko'] += intval($row['data']['accepted'][$key]['kasko']['count']);
				$total_by_period[$key]['go'] += intval($row['data']['accepted'][$key]['go']['count']);
				
				$total_by_sto[$id]['kasko'] += intval($row['data']['accepted'][$key]['kasko']['count']);
				$total_by_sto[$id]['go'] += intval($row['data']['accepted'][$key]['go']['count']);
			} 
			?>
			
			<td><?=$total_by_sto[$id]['kasko']?></td>
			<td><?=$total_by_sto[$id]['go']?></td>
			
			<?
			
				$total['kasko'] += $total_by_sto[$id]['kasko'];
				$total['go'] += $total_by_sto[$id]['go'];
			
			?>
			
		</tr>
		<?
			}
		?>
		<tr class="columns">
			<td>Всього</td>
			<? foreach ($periods_format as $key => $period_format) {
				echo '<td align="right">' . $total_by_period[$key]['kasko'] . '</td>';
				echo '<td align="right">' . $total_by_period[$key]['go'] . '</td>';
			} ?>
			<td align="right"><?=$total['kasko']?></td>
			<td align="right"><?=$total['go']?></td>
		</tr>
	</table>
<? } ?>
</body>
</html>