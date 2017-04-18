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
    <table width="600" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <td align="center">Номер справи</td>
			<td>Номер СА</td>
			<td>Страхувальник</td>
			<td>Вигодонабувач</td>
			<td>Пункт прийому заяви</td>
			<td>Номер договору страхування</td>
			<td>Дата початку дії договору</td>
			<td>Дата закінчення дії договору</td>
			<td>Агенція</td>
			<td>Застрахований ТЗ</td>
			<td>Державний реєстраційний номер</td>
			<td>Шассі</td>
			<td>Страхова сума</td>
			<td>Ринкова вартість</td>
			<td>Страховий платіж</td>
			<td>Франшиза</td>
			<td>Дата та час події</td>
			<td>Орієнтовний збиток</td>
			<td>Випадок</td>
			<td>Ризик</td>
			<td>Обставини</td>
			<td>Пошкодження</td>
			<td>Статус справи</td>
			<td>Тотал</td>
			<td>Регрес</td>
			<td>Компроміс</td>
			<td>Умови договору, що порушені</td>
			<td>Рахунок з СТО</td>
			<td>№ рахунку</td>
			<td>Рахунок з СТО,грн</td>
			<td>Відшкодування,грн</td>
			<td>Взаємозалік,грн</td>
			<td>Фактично сплачено,грн</td>
			<td>Сплачено на Р/р,фактично сплачено</td>
			<td>Ознака контрагента (фактично сплачено)</td>
			<td>Категорія справи</td>
			<td>Клас ремонту</td>
			<td>Кількість днів на ремонт</td>
			<td>Клас поставки ЗЧ</td>
			<td>Кількість днів на поставку ЗЧ</td>
			<td>Дата прийому заяви</td>
			<td>Дата постановки задачі СТО для сворення РФ</td>
			<td>Дата закриття задачі експертом</td>
			<td>Дата створення СА</td>
			<td>Дата затвердження СА</td>
			<td>Дата виплати,фактично сплачено</td>
			<td>Дата закриття справи</td>
			<td>Термін врегулювання справи</td>
			<td>Аварійний комісар</td>
        </tr>
        <?
            foreach ($list as $row) {
			
				//інформація з задачі "Розрахунок суми відновлювального ремонту"
				$sql = 'SELECT answer, question, date_format(created, \'%d.%m.%Y\') as created, date_format(decision, \'%d.%m.%Y\') as closed ' .
					   'FROM ' . PREFIX . '_accident_messages ' .
					   'WHERE id = ' . intval($row['accident_messages_id']);
				$message = $db->getRow($sql);
				$message['answer'] = unserialize($message['answer']);
				$message['question'] = unserialize($message['question']);
				$row['calc_created'] = $message['created'];
				$row['calc_closed'] = $message['closed'];
				$row['calc_car_services_title'] = intval($message['answer']['result_calculation_car_services_id']) ?
					CarServices::getTitle($message['answer']['result_calculation_car_services_id']) :
					CarServices::getTitle($message['question']['calculation_car_services_id']);
				$row['calc_number'] = (isset($message['answer']['payment_document_title']) ? $message['answer']['payment_document_title'] . ' ' : '') .
					(isset($message['answer']['payment_document_number']) ? $message['answer']['payment_document_number'] : '');
				$row['calc_amount'] = floatval($message['answer']['amount_details'] + $message['answer']['amount_material'] + $message['answer']['amount_work']);
				$row['repair_parts_class_id'] = $message['answer']['parts_classifications_id'];
				$row['repair_days'] = $message['answer']['repair_days'];
				$row['parts_days'] = $message['answer']['parts_days'];
				
				//ознака контрагента
				if (intval($row['accident_payments_calendar_id'])) {
					$sql = 'SELECT IF(
										b.ukravto = 1 OR a.payment_types_id = 5, 
										\'1\', 
										CASE a.recipient_types_id 
											WHEN 1 THEN 3
											WHEN 2 THEN 2
											WHEN 4 THEN 3
											WHEN 5 THEN 0
											WHEN 7 THEN 3
										END
									) ' .
						   'FROM ' . PREFIX . '_accident_payments_calendar as a ' .
						   'LEFT JOIN ' . PREFIX . '_car_services as b ON a.recipients_id = b.id AND a.recipient_types_id = 5 ' .
						   'WHERE a.id = ' . intval($row['accident_payments_calendar_id']);
					$row['recipient_sign'] = $recipient_sign[ $db->getOne($sql) ];
				} else {
					$row['recipient_sign'] = '&nbsp;';
				}
				
				//дата закриття справи
				$sql = 'SELECT date_format(created, \'%d.%m.%Y\') ' .
					   'FROM ' . PREFIX . '_accident_status_changes ' .
					   'WHERE created > ' . $db->quote(date('Y-m-d', strtotime($row['acts_date']))) . ' AND accident_statuses_id IN (8, 10, 11) ' .
					   'ORDER BY created ' .
					   'LIMIT 1';
				$row['accidents_closed'] = $db->getOne($sql);
				
				//річна страхова премія
				$sql = 'SELECT number_insurance_year ' .
					   'FROM ' . PREFIX . '_policy_payments_calendar ' .
					   'WHERE policies_id = ' . intval($row['policies_id']) . ' AND date < ' . $db->quote(date('Y-m-d', strtotime($row['accidents_datetime']))) . ' ' .
					   'ORDER BY date DESC ' .
					   'LIMIT 1';
				$number_insurance_year = $db->getOne($sql);
				$sql = 'SELECT SUM(a.amount) ' .
					   'FROM ' . PREFIX . '_policy_payments_calendar a ' .
					   'JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id ' .
					   'WHERE b.number = ' . $db->quote($row['policies_number']) . ' AND number_insurance_year = ' . intval($number_insurance_year) . ' AND a.valid = 1';
				$row['insurance_premium'] = $db->getOne($sql);
        ?>
        <tr>
            <td x:str align="center"><?=$row['accidents_number']?></td>
			<td align="center"><?=$row['acts_number']?></td>
			<td align="center"><?=$row['insurer']?></td>
            <td align="center"><?=$row['assured_title']?></td>
			<td align="center"><?=$row['car_services_title']?></td>
			<td align="center"><?=$row['policies_number']?></td>
			<td align="center"><?=$row['policies_begin_date']?></td>
			<td align="center"><?=$row['policies_end_date']?></td>
			<td align="center"><?=$row['agency_title']?></td>
			<td align="center"><?=$row['item']?></td>
			<td align="center"><?=$row['sign']?></td>
			<td align="center"><?=$row['shassi']?></td>
			<td align="center"><?=getRateFormat($row['insurance_price'], 2)?></td>
			<td align="center"><?=getRateFormat($row['market_price'], 2)?></td>
			<td align="center"><?=getRateFormat($row['insurance_premium'], 2)?></td>
			<td align="center"><?=getRateFormat($row['deductibles_amount'], 2)?></td>
			<td align="center"><?=$row['accidents_datetime']?></td>
			<td align="center"><?=getRateFormat($row['amount_rough'], 2)?></td>
			<td align="center"><?=$insurance[ $row['insurance'] ]?></td>
			<td align="center"><?=$row['risks_title']?></td>
			<td align="center"><?=$row['description_average']?></td>
			<td align="center"><?=$row['damage']?></td>
			<td align="center"><?=$row['accident_statuses_title']?></td>
			<td align="center"><?=$yesno[ $row['total'] ]?></td>
			<td align="center"><?=$yesno[ $row['regres'] ]?></td>
			<td align="center"><?=$yesno[ $row['compromise'] ]?></td>
			<td align="center"><?=$row['compromise_violation']?></td>
			<td align="center"><?=$row['calc_car_services_title']?></td>
			<td align="center"><?=$row['calc_number']?></td>
			<td align="center"><?=getRateFormat($row['calc_amount'], 2)?></td>
			<td align="center"><?=getRateFormat($row['compensation'], 2)?></td>
			<td align="center"><?=getRateFormat(($row['payment_types_id'] == 5 ? $row['payment_amount'] : 0.00), 2)?></td>
			<td align="center"><?=getRateFormat(($row['payment_types_id'] == 6 ? $row['payment_amount'] : 0.00), 2)?></td>
			<td align="center"><?=$row['recipient']?></td>
			<td align="center"><?=$row['recipient_sign']?></td>
			<td align="center"><?=$row['accident_sections_title']?></td>
			<td align="center"><?=$row['repair_classifications_id']?></td>
			<td align="center"><?=$row['repair_days']?></td>
			<td align="center"><?=$row['repair_parts_class_id']?></td>
			<td align="center"><?=$row['parts_days']?></td>
			<td align="center"><?=$row['accidents_date']?></td>
			<td align="center"><?=$row['calc_created']?></td>
			<td align="center"><?=$row['calc_closed']?></td>
			<td align="center"><?=$row['acts_created']?></td>
			<td align="center"><?=$row['acts_date']?></td>
			<td align="center"><?=$row['payment_date']?></td>
			<td align="center"><?=$row['accidents_closed']?></td>
			<td align="center"><?=$row['term']?></td>
			<td align="center"><?=$row['average_manager']?></td>
        </tr>
        <?
            }
        ?>
    </table>
</body>
</html>