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
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
	<td colspan="3">Справа</td>
	<td colspan="2">Інша сторона</td>
	<td colspan="7">Претензія</td>
	<td colspan="7">Позов</td>

	<td rowspan="2">Статус</td>
	<td rowspan="2">Коментар</td>
	<td rowspan="2">Створено</td>
	<td rowspan="2">Редаговано</td>
</tr>
<tr class="columns">
	<td>Номер</td>
	<td>Подія</td>
	<td>Передача</td>

	<td>Особа</td>
	<td>Назва</td>

	<td>Номер</td>
	<td>Дата</td>
	<td>Сума, грн.</td>
	<td>Дата останнього отримання коштів</td>
	<td>Сума, грн.</td>
	<td>Коментар</td>
	<td>Виконавець</td>

	<td>Номер</td>
	<td>Дата</td>
	<td>Сума, грн.</td>
	<td>Дата останнього отримання коштів</td>
	<td>Сума, грн.</td>
	<td>Коментар</td>
	<td>Виконавець</td>
</tr>
<?
	foreach ($list as $row) {
	$i = 1 - $i;
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
	<td><?=$row['accidents_number']?></a></td>
	<td><?=$row['accidents_date_format']?></td>
	<td><?=$row['date_format']?></td>

	<td>
		<?php
			switch (intval($row['person_types_id'])) {
				case 1:
					echo 'Фізична';
					break;
				case 2:
					echo 'Юридична';
					break;
				default:
					echo '&nbsp;';
					break;
			}
		?>
	</td>
	<td><?=$row['title']?></td>

	<?
		$sql = 'SELECT date_format(MAX(date), \'%d.%m.%Y\') as date, SUM(amount) as amount FROM ' . PREFIX . '_accident_regression_payments WHERE ' . implode(' AND ', $data['pretension_conditions']) . ' AND accident_regression_culprits_id = ' . intval($row['id']);
		$pretension_data = $db->getRow($sql);
	?>
	
	<td><?=$row['pretension_number']?></td>
	<td><?=$row['pretension_date_format']?></td>	
	<td><?=$row['pretension_amount']?></td>
	<td><?=$pretension_data['date']?></td>
	<td><?=$pretension_data['amount']?></td>
	<td><?=$row['pretension_comment']?></td>
	<td><?=$row['pretension_perfmormers_title']?></td>
	
	<?
		$sql = 'SELECT date_format(MAX(date), \'%d.%m.%Y\') as date, SUM(amount) as amount FROM ' . PREFIX . '_accident_regression_payments WHERE ' . implode(' AND ', $data['claim_conditions']) . ' AND accident_regression_culprits_id = ' . intval($row['id']);
		$claim_data = $db->getRow($sql);
	?>

	<td><?=$row['claim_number']?></td>
	<td><?=$row['claim_date_format']?></td>	
	<td><?=$row['claim_amount']?></td>
	<td><?=$claim_data['date']?></td>		
	<td><?=$claim_data['amount']?></td>
	<td><?=$row['claim_comment']?></td>
	<td><?=$row['claim_perfmormers_title']?></td>

	<td><?=$row['regres_statuses_title']?></td>
	<td><?=$row['comment']?></td>
	<td><?=$row['created_format']?></td>
	<td><?=$row['modified_format']?></td>
</tr>
<? } ?>
</table>
</body>
</html>