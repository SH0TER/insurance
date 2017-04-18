<?

$transmissions = array(
	0	=>	'',
	1	=>	'Автомат',
	2	=>	'Ручна / Механіка',
	3	=>	'Адаптивна',
	4	=>	'Варіатор',
	5	=>	'Типтронік'
);

require_once '../include/collector.inc.php';
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

$sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation, getPolicyDate(b.number, 1) as p_date, getPolicyDate(b.number, 2) as p_begin, 
				getPolicyDate(b.number, 3) as p_end, b.agreement_types_id, b.begin_datetime as policiesBeginDateTime
        from insurance_policy_payments_calendar a
        join insurance_policies b on a.policies_id = b.id
        join insurance_policies_kasko c on b.id = c.policies_id
        where now() between a.date and a.end_date and a.valid = 1 and a.statuses_id > 1 and b.product_types_id = 3 and datediff(a.end_date, a.date) <= 366';//b.item <> \'Автопарк\' and 
$list = $db->getAll($sql);

$values = array();
foreach ($list as $row) {

	switch($row['agreement_types_id']) {
		case 1:
			$row['policiesType'] = 'Зміна умов страхування';
			break;
		case 2:			
			$row['policiesType'] = 'Пролонгація';
			break;
		case 3:
		case 4:
			$row['policiesType'] = 'Відновлення СС';
			break;
		default:
			$row['policiesType'] = 'Договір';
			break;
	}

	$sql = 'select b.full_title as taskTitle, a.date as taskDate
			from insurance_tasks a
			join  insurance_task_statuses b on a.task_statuses_id = b.id
			where a.task_types_id = 5 and a.policies_id = ' . intval($row['policies_id']) . '
			order by date desc limit 1';
	$task = $db->getRow($sql);

	$sql = 'select id, brand, model, market_price as marketPrice, car_price as itemPrice, year as itemYear, engine_size as engineSize, transmissions_id as itemTransmissionsId
			from insurance_policies_kasko_items
			where policies_id = ' . intval($row['policies_id']);
	$policiesItems = $db->getAll($sql);
	
	$sql = 'select title
			from insurance_payment_statuses
			where id = ' . intval($row['statuses_id']);
	$paymentStatus = $db->getOne($sql);
	
	foreach ($policiesItems as $policyItem) {
		$item = $policyItem;
		$sql = 'select item_price as itemPrice, date as dateYear
				from insurance_policies_kasko_item_years_payments
				where date <= ' . $db->quote($row['date']) . ' and items_id = ' . intval($policyItem['id']) . '
				order by date desc limit 1';
		$itemInfo = $db->getRow($sql);
		
		if ($itemInfo) {
			$item['itemPrice'] = $itemInfo['itemPrice'];
			
			$sql = 'select sum(getCompensation(a.id, 3)) 
					from insurance_accidents a
					join insurance_accidents_kasko b on a.id = b.accidents_id
					where b.items_id = ' . intval($policyItem['id']) . ' and a.datetime >= ' . $db->quote($itemInfo['dateYear']);
			$compensation = floatval($db->getOne($sql));
			
		} else {
			$item['itemPrice'] = $policyItem['itemPrice'];
			
			$sql = 'select sum(getCompensation(a.id, 3)) 
					from insurance_accidents a
					join insurance_accidents_kasko b on a.id = b.accidents_id
					where b.items_id = ' . intval($policyItem['id']) . ' and a.datetime >= ' . $db->quote($row['policiesBeginDateTime']);
			$compensation = floatval($db->getOne($sql));
		}
				
		$item['taskTitle'] = $task['taskTitle'];
		$item['taskDate'] = $task['taskDate'];
		$item['paymentStatus'] = $paymentStatus;
		$item['policiesNumber'] = $row['number'];
		$item['policiesDate'] = $row['p_date'];
		$item['policiesBegin'] = $row['p_begin'];
		$item['policiesEnd'] = $row['p_end'];
		$item['policiesType'] = $row['policiesType'];
		$item['compensation'] = $compensation;
		
		$values[] = $item;
	}
	
}

//header('Content-Disposition: attachment; filename="report.xls"');
//header('Content-Type: ' . Form::getContentType('report.xls') . '; charset=utf-8');

echo '<table><tr>';

echo '<td>Договір</td>';
echo '<td>Тип</td>';
echo '<td>Дата</td>';
echo '<td>Початок</td>';
echo '<td>Кінець</td>';
echo '<td>ID ТЗ</td>';
echo '<td>Марка</td>';
echo '<td>Модель</td>';
echo '<td>Рік ТЗ</td>';
echo '<td>Об\'єм двигуна</td>';
echo '<td>Вид трансмісії</td>';
echo '<td>СС</td>';
echo '<td>РВ</td>';
echo '<td>Дата задачі</td>';
echo '<td>Статус задачі</td>';
echo '<td>Статус оплати (поточний період)</td>';
echo '<td>Відшкодування</td>';

echo '</tr>';

foreach ($values as $row) {
    echo '<tr>';

    echo '<td>' . $row['policiesNumber'] . '</td>';
	echo '<td>' . $row['policiesType'] . '</td>';
    echo '<td>' . $row['policiesDate'] . '</td>';
    echo '<td>' . $row['policiesBegin'] . '</td>';
    echo '<td>' . $row['policiesEnd'] . '</td>';
	echo '<td>' . $row['id'] . '</td>';
	echo '<td>' . $row['brand'] . '</td>';
	echo '<td>' . $row['model'] . '</td>';
	echo '<td>' . $row['itemYear'] . '</td>';
	echo '<td>' . $row['engineSize'] . '</td>';
	echo '<td>' . $transmissions[ $row['itemTransmissionsId'] ] . '</td>';
	echo '<td>' . getRateFormat($row['itemPrice'], 2) . '</td>';
    echo '<td>' . getRateFormat($row['marketPrice'], 2) . '</td>';
	echo '<td>' . $row['taskDate'] . '</td>';
	echo '<td>' . $row['taskTitle'] . '</td>';
    echo '<td>' . $row['paymentStatus'] . '</td>';
	echo '<td>' . getRateFormat($row['compensation'], 2) . '</td>';

    echo '</tr>';
}

echo '</table>';

?>