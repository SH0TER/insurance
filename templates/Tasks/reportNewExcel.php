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
    <table cellpadding="5" cellspacing="0" border="1">
        <tr class="columns">
			<td colspan="15">Основний блок</td>
			<td colspan="8">Дзвінки</td>
        </tr>
		<tr class="columns">
			<td>Номер справи</td>
			<td>Страхувальник</td>
			<td>Прийом заяви, СТО</td>
			<td>Номер договору</td>
			<td>Об'єкт</td>
			<td>Д.н.з або VIN</td>
			<td>Дата події</td>
			<td>Дата заяви</td>
			<td>Дата закриття справи</td>
			<td>Сума відшкодування</td>
			<td>Сплачено на Р/р</td>
			<td>Платіжне доручення</td>
			<td>Клас ремонту</td>
			<td>Регіон</td>
			<td>Кількість дзвінків</td>
			
			<td>Дата дзвінка клієнту оператором КЦ</td>
			<td>Результат дзвінка</td>
			<td>Дзвінок клієнту з СТО</td>
			<td>Дата постановки ТЗ на ремонт</td>
			<td>Причина заїзду</td>
			<td>Причина не постановки ТЗ на ремонт</td>
			<td>Стан ремонту</td>
			<td>Коментар</td>
		</tr>
		
		<?
			foreach ($list as $accident) {
				echo '<tr>';
				
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['accidents_number'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['insurer'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['car_services_accidents_title'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['policies_number'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['item'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['sign_or_shassi'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['accidents_datetime'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['accidents_date'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['payment_date'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['calendar_amount'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['calendar_recipient'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['number_payment_order'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['repair_classifications_id'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . $accident['region'] . '</td>';
				echo '<td rowspan="' . sizeOf($accident['tasks']) . '">' . sizeOf($accident['tasks']) . '</td>';
				
				$first = true;
				foreach ($accident['tasks'] as $task) {
					if (!$first) echo '</tr><tr>';
					
					echo '<td>' . $task['tasks_date'] . '</td>';
					echo '<td>' . $task['task_statuses_call_title'] . '</td>';
					echo '<td>' . $task['sto_call'] . '</td>';
					echo '<td>' . $task['date_begin_repair'] . '</td>';
					echo '<td>' . $task['no_begin_repair_reason'] . '</td>';
					echo '<td>' . $task['no_repair_reason'] . '</td>';
					echo '<td>' . $task['repair_state'] . '</td>';
					echo '<td>' . $task['comment'] . '</td>';
					
					$first = false;
				}
				
				echo '</tr>';
			}
		?>
		
    </table>
</body>
</html>