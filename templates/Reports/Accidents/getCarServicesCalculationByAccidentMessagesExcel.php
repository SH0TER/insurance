<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Калькуляції по страховим справам</title>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
	<style>
		* {
			font-size: 11px;
			font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
		}
		.columns TD {
            width: 300px;
			height: 25px;
			color: #FFFFFF;
			padding-left: 4px;
			font-weight: bold;
			border-right: 1px solid #FFFFFF;
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #FFFFFF;
			background-color: #008575;
		}
        tr.columns {
            height: 50px;
        }
        td.row {
            width: 100px;
        }
        td.neither_big_no_small {
            width: 200px;
        }
        td.big_row{
           width: 450px;
        }
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<tr class="columns">
		<td>Номер справи</td>
		<td>Страхувальник</td>
		<td>СТО, прийом заяви</td>
		<td>Номер договору</td>
		<td>Об'єкт</td>
		<td>Державний номер або шасі</td>
		<td>Дата події</td>
		<td>Дата заяви</td>
		<td>Клас ремонту</td>
		<td>Тривалість ремонту</td>
		<td>К-сть днів на поставку ЗЧ</td>
		<td>Запасні частини</td>
		<td>Дата заявки експерту</td>
		<td>Дата погодження заявки</td>
		<td>Тривалість погодження</td>
		<td>Дата запиту рахунку</td>
		<td>Дата отримання рахунку</td>
		<td>Тривалість отримання рахунку</td>
		<td>Ринкова вартість ТЗ, грн.</td>
		<td>Залишки, грн.</td>
		<td>Сума первинного рахунку, грн.</td>
		<td>Коефіцієнт зносу</td>
		<td>СТО, калькуляція</td>
		<td>Рахунок з СТО</td>
		<td>Всього, грн.</td>
		<td>Різниця, грн.</td>
		<td>Коментар</td>
		<td>Моніторинг</td>
		<td>Експерт</td>
		<td>Аварійний комісар</td>
		<td>Куратор</td>
	</tr>
	<? foreach($list as $row) { 
		$monitoring = unserialize($row['monitoring']);
		$monitoringOutput = '';
		foreach ($monitoring as $line) {
			$monitoringOutput .= implode("\t", $line) . '<br/>';
		}
	?>
			<tr>
				<td style='mso-number-format:"\@"'><?=$row['accidents_number']?></td>
				<td><?=$row['insurer']?></td>
				<td><?=$row['application_car_services_title']?></td>
				<td><?=$row['policies_number']?></td>
				<td><?=$row['item']?></td>
				<td><?=($row['sign'] ? $row['sign'] : $row['shassi'])?></td>
				<td><?=$row['accidents_datetime']?></td>
				<td><?=$row['accidents_date']?></td>
				<td><?=$row['repair_classifications_id']?></td>
				<td><?=$row['repair_days']?></td>
				<td><?=$row['parts_days']?></td>
				<td><?=(intval($row['repair_parts']) ? 'так' : 'ні')?></td>
				<td><?=$row['accident_messages_created']?></td>
				<td><?=$row['accident_messages_decision']?></td>
				<td><?=$row['decision_duration']?></td>
				<td><?=$row['account_request_date']?></td>
				<td><?=$row['account_answer_date']?></td>
				<td><?=$row['request_duration']?></td>
				<td style='mso-number-format:"\#\,\#\#0\.00"'><?=$row['market_price']?></td>
				<td style='mso-number-format:"\#\,\#\#0\.00"'><?=$row['amount_residual']?></td>
				<td style='mso-number-format:"\#\,\#\#0\.00"'><?=$row['first_repair_amount']?></td>
				<td style='mso-number-format:"\#\,\#\#0\.0000"'><?=$row['deterioration_value']?></td>
				<td><?=$row['calculation_car_services_title']?></td>
				<td><?=$row['request_car_services_title']?></td>
				<td style='mso-number-format:"\#\,\#\#0\.00"'><?=$row['amount_total']?></td>
				<td style='mso-number-format:"\#\,\#\#0\.00"'><?=($row['first_repair_amount'] - $row['amount_total'])?></td>
				<td><?=$row['comment']?></td>
				<td><?=$monitoringOutput?></td>
				<td><?=$row['estimate_manager']?></td>
				<td><?=$row['avarage_manager']?></td>
				<td><?=$row['curator']?></td>
			</tr>
	<? } ?>
</table>
</body>
</html>