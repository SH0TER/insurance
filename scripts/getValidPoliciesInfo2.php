<?

require_once '../include/collector.inc.php';
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

//ніби діючі періоди
$sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
        from insurance_policy_payments_calendar a
        join insurance_policies b on a.policies_id = b.id
        join insurance_policies_kasko c on b.id = c.policies_id
        where c.insurer_person_types_id = 2 and now() between a.date and a.end_date and a.valid = 1 and b.product_types_id = 3 and datediff(a.end_date, a.date) <= 366';//b.item <> \'Автопарк\' and 
$list_first = $db->getAll($sql);
//_dump($list_first);exit;

$list_second = array();
$policies = array();
foreach ($list_first as $row_first) {
	//_dump('start');
	//_dump($row_first);
    if ($row_first['is_agr'] == 1) {
        //запис календаря, що визначає початок страхового періоду
        $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
                from insurance_policy_payments_calendar a
                join insurance_policies b on a.policies_id = b.id
                where b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.is_agr = 0 and a.valid = 1
                order by date asc
                limit 1';
        $valid = $db->getRow($sql);

        //запис календаря - точно діючий
        $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
                from insurance_policy_payments_calendar a
                join insurance_policies b on a.policies_id = b.id
                where b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.statuses_id > 2 and a.valid = 1
                order by date asc
                limit 1';
        $last_payment = $db->getRow($sql);

        if (!intval($last_payment['id'])) continue;

        //дані
        $sql = 'select a.number as policies_number,
					   b.insurer_company as insurer,
                       concat_ws(\'/\', c.brand, c.model) as item,
                       e.title as bank,					   
					   if(f.id > 0, f.item_price, c.car_price) as price,
                       if(f.id > 0, f.amount_kasko, c.amount_kasko) as premium,
					   d.title as agency,
					   getPolicyDate(a.number,2) as begin,
                       getPolicyDate(a.number,3) as end
                       
                from insurance_policies a
                join insurance_policies_kasko b on a.id = b.policies_id
                join insurance_policies_kasko_items c on b.policies_id = c.policies_id
                left join insurance_policies_kasko_item_years_payments f on c.id = f.items_id and now() between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
				left join insurance_financial_institutions e on b.financial_institutions_id = e.id
				join insurance_agencies d on a.agencies_id = d.id
                where a.id = ' . intval($last_payment['policies_id']);
        $policy = $db->getRow($sql);

    } elseif ($row_first['statuses_id'] > 2) {
        //точно діючий запис календаря - дані
        $sql = 'select a.number as policies_number,
					   b.insurer_company as insurer,
                       concat_ws(\'/\', c.brand, c.model) as item,
                       e.title as bank,					   
					   if(f.id > 0, f.item_price, c.car_price) as price,
                       if(f.id > 0, f.amount_kasko, c.amount_kasko) as premium,
					   d.title as agency,
					   getPolicyDate(a.number,2) as begin,
                       getPolicyDate(a.number,3) as end
                       
                from insurance_policies a
                join insurance_policies_kasko b on a.id = b.policies_id
                join insurance_policies_kasko_items c on b.policies_id = c.policies_id
                left join insurance_policies_kasko_item_years_payments f on c.id = f.items_id and now() between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
				left join insurance_financial_institutions e on b.financial_institutions_id = e.id
				join insurance_agencies d on a.agencies_id = d.id
                where a.id = ' . intval($row_first['policies_id']);
        $policy = $db->getRow($sql);

    } else {
        continue;
    }

	if ($policy != null) $policies[] = $policy;
	
	
	//_dump($policy);
	//_dump('finish');
	
    /*$sql = 'insert into axapta_kasko_vin_cur set vin = ' . $db->quote($policy['shassi']) . ', sign = ' . $db->quote($policy['sign']);
    $db->query($sql);*/
}
//exit;
header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table><tr>';

echo '<td>Договір</td>';
echo '<td>Назва</td>';
echo '<td>Марка / модель</td>';
echo '<td>Банк</td>';
echo '<td>СС</td>';
echo '<td>СП</td>';
echo '<td>Дата початку дії договору</td>';
echo '<td>Дата закінчення дії договору</td>';
echo '<td>Агенція</td>';

echo '</tr>';

foreach ($policies as $policy) {
    echo '<tr>';

    echo '<td>' . $policy['policies_number'] . '</td>';
    echo '<td>' . $policy['insurer'] . '</td>';
    echo '<td>' . $policy['item'] . '</td>';
    echo '<td>' . $policy['bank'] . '</td>';
    echo '<td>' . getRateFormat($policy['price'], 2) . '</td>';
    echo '<td>' . getRateFormat($policy['premium'], 2) . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($policy['begin'])) . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($policy['end'])) . '</td>';
	echo '<td>' . $policy['agency'] . '</td>';

    echo '</tr>';
}

echo '</table>';

?>