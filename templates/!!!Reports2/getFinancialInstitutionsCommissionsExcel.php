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
<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<tr class="columns">
		<?
			foreach($fields as $key => $attr) {
				if ($attr['alias'][$data['product_types_id']]) {
					echo '<td>' . $attr['title'] . '</td>';
				}
			}
		?>
	</tr>
	<?
		$i = 0;
		$totals_amount = array();
		foreach ($totals as $total) {
			$totals_amount[$total] = 0;
		}
		foreach ($list as $row) {
			$i = 1 - $i;
	?>
	<tr class="<?=Form::getRowClass($row, $i)?>">
		<?
			foreach($fields as $key => $attr) {
				if ($attr['alias'][$data['product_types_id']]) {
					echo '<td>' . $row[$key] . '</td>';
					if (in_array($key, $totals)) {
						$totals_amount[$key] += str_replace(',', '.', $row[$key]);
					}
				}
			}
		?>
	</tr>
	<?
		}
	?>
	<tr class="columns">
		<?
			$first = true;
			$count = 0;
			foreach($fields as $key => $attr) {
				if ($first) {
					echo '<td class="paging">Всьго: ' . sizeof($list) . '</td>';
					$first = false;
					continue;
				}
				if ($attr['alias'][$data['product_types_id']]) {
					if (in_array($key, $totals)) {
						if ($count) {
							echo '<td colspan="' . $count . '"> </td>';
						}
						$count = 0;
						echo '<td class="paging">' . getRateFormat($totals_amount[$key], 2) . '</td>';
					} else {
						$count++;
						//echo '<td> </td>';
					}
				}
			}
		?>
	</tr>
</table>
</body>
</html>