<?

$engineTypes = array(
	0	=>	'',
	1	=>	'Бензин',
	2	=>	'Дизель',
	3	=>	'Газ',
	4	=>	'Газ/бензин',
	5	=>	'Гібрид',
	6	=>	'Електро'
);

$transmissions = array(
	0	=>	'',
	1	=>	'Автомат',
	2	=>	'Ручна / Механіка',
	3	=>	'Адаптивна',
	4	=>	'Варіатор',
	5	=>	'Типтронік'
);

$bodyTypes = array(
	0	=>	'',
	1	=>	'Седан',
	2	=>	'Універсал',
	3	=>	'Позашляхових / Кроссовер',
	4	=>	'Хетчбек',
	5	=>	'Кабріолет',
	6	=>	'Купе',
	7	=>	'Лімузин',
	8	=>	'Мікроавтобус',
	9	=>	'Мінівен',
	10	=>	'Пікап',
	11	=>	'Фургон'
);

require_once '../include/collector.inc.php';
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

$sql = 'select b.id as policiesId, a.id as paymentCalendarId, b.number as policiesNumber, date_format(getPolicyDate(b.number, 1), \'%d.%m.%Y\') as policiesDate, c.financial_institutions_id as financialInsitutionsId,
			c.terms_years_id as termsYearsId
        from insurance_policy_payments_calendar a
        join insurance_policies b on a.policies_id = b.id
        join insurance_policies_kasko c on b.id = c.policies_id
        where now() between a.date and a.end_date and a.valid = 1 and a.statuses_id > 1 and b.product_types_id = 3 and datediff(a.end_date, a.date) <= 366';//b.item <> \'Автопарк\' and 
$list = $db->getAll($sql);

$values = array();
foreach ($list as $row) {

	$sql = 'select id as itemsId, brand as itemsBrand, model as itemsModel, year as itemsYear, transmissions_id as itemTransmissionsId, engine_size as itemEngineSize, car_engine_type_id as itemEngineTypesId,
				car_body_id as itemBodyId, modification as itemModification, market_price_expert as itemMarketPrice, expert_id as expertId, date_format(expert_date, \'%d.%m.%Y\') as expertDate, shassi as itemShassi
			from insurance_policies_kasko_items
			where policies_id = ' . intval($row['policiesId']);
	$policiesItems = $db->getAll($sql);
	
	foreach ($policiesItems as $policyItem) {
		$item = $policyItem;
		$item = array_merge($item, $row);
		
		$sql = 'select item_price 
				from insurance_policies_kasko_item_years_payments
				where date <= now() and items_id = ' . intval($policyItem['itemsId']) . '
				order by date desc limit 1';
		$item['itemPrice'] = floatval($db->getOne($sql));
		
		$sql = 'select date_format(date_sub(date, interval 1 day), \'%d.%m.%Y\')
				from insurance_policies_kasko_item_years_payments
				where date > now() and items_id = ' . intval($policyItem['itemsId']) . '
				order by date asc limit 1';
		$item['endYear'] = $db->getOne($sql);
		
		if ($item['itemPrice'] == 0.00) {
			$sql = 'select car_price 
					from insurance_policies_kasko_items
					where id = ' . intval($policyItem['itemsId']);
			$item['itemPrice'] = floatval($db->getOne($sql));
		}
		
		if (!$item['endYear']) {
			$sql = 'select date_format(getPolicyDate(' . $db->quote($row['policiesNumber']) . ', 3), \'%d.%m.%Y\')';
			$item['endYear'] = $db->getOne($sql);
		}
		
		$sql = 'select concat(lastname, \' \', firstname)
				from insurance_accounts
				where id = ' . intval($policyItem['expertId']);
		$item['expertName'] = $db->getOne($sql);
		
		$sql = 'select title 
				from insurance_financial_institutions
				where id = ' . intval($item['financialInsitutionsId']);
		$item['financialInsitution'] = $db->getOne($sql);
		
		$item['multiYear'] = ($item['termsYearsId'] > 1 ? 'так' : 'ні');

		$values[] = $item;
	}
	
}

//header('Content-Disposition: attachment; filename="report.xls"');
//header('Content-Type: ' . Form::getContentType('report.xls') . '; charset=utf-8');

echo '<table><tr>';

echo '<td>Договір</td>';
echo '<td>Дата</td>';
echo '<td>Марка</td>';
echo '<td>Модель</td>';
echo '<td>Рік</td>';
echo '<td>КПП</td>';
echo '<td>Об\'єм двигуна</td>';
echo '<td>Паливо</td>';
echo '<td>Кузов</td>';
echo '<td>Шасі</td>';
echo '<td>Модифікація</td>';
echo '<td>СС</td>';
echo '<td>Ринкова сума</td>';
echo '<td>Експерт</td>';
echo '<td>Коли визначена</td>';
echo '<td>items_id</td>';
echo '<td>policies_id</td>';
echo '<td>payment_calendar_id</td>';
echo '<td>Дата закінчення річного періоду</td>';
echo '<td>Банк</td>';
echo '<td>Багаторічний</td>';

echo '</tr>';

foreach ($values as $row) {
    echo '<tr>';

    echo '<td>' . $row['policiesNumber'] . '</td>';
    echo '<td>' . $row['policiesDate'] . '</td>';
	echo '<td>' . $row['itemsBrand'] . '</td>';
	echo '<td>' . $row['itemsModel'] . '</td>';
	echo '<td>' . $row['itemsYear'] . '</td>';
	echo '<td>' . $transmissions[ $row['itemTransmissionsId'] ] . '</td>';
	echo '<td>' . $row['itemEngineSize'] . '</td>';
	echo '<td>' . $engineTypes[ $row['itemEngineTypesId'] ] . '</td>';
	echo '<td>' . $bodyTypes[ $row['itemBodyId'] ] . '</td>';
	echo '<td>' . $row['itemShassi'] . '</td>';
	echo '<td>' . $row['itemModification'] . '</td>';
	echo '<td>' . $row['itemPrice'] . '</td>';
	echo '<td>' . $row['itemMarketPrice'] . '</td>';
	echo '<td>' . $row['expertName'] . '</td>';
	echo '<td>' . $row['expertDate'] . '</td>';
	echo '<td>' . $row['itemsId'] . '</td>';
	echo '<td>' . $row['policiesId'] . '</td>';
	echo '<td>' . $row['paymentCalendarId'] . '</td>';
	echo '<td>' . $row['endYear'] . '</td>';
	echo '<td>' . $row['financialInsitution'] . '</td>';
	echo '<td>' . $row['multiYear'] . '</td>';

    echo '</tr>';
}

echo '</table>';

?>