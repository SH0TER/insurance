<?

require_once '../include/collector.inc.php';
//file_get_contents('new_set.php');
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

//ніби діючі періоди
$sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
        from insurance_policy_payments_calendar a
        join insurance_policies b on a.policies_id = b.id
        where now() between a.date and a.end_date and a.valid = 1 and b.product_types_id = 3 and b.item <> \'Автопарк\' and datediff(a.end_date, a.date) <= 366';
$list_first = $db->getAll($sql);
//_dump($list_first);

$list_second = array();
$items = array();
foreach ($list_first as $row_first) {
    if ($row_first['is_agr'] == 1) {
        //запис календаря, що визначає початок страхового періоду
        $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
                from insurance_policy_payments_calendar a
                join insurance_policies b on a.policies_id = b.id
                where b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.is_agr = 0 and a.valid = 1
                order by date asc
                limit 1';
        $valid = $db->getRow($sql);
//_dump($valid);

        //запис календаря - точно діючий
        $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
                from insurance_policy_payments_calendar a
                join insurance_policies b on a.policies_id = b.id
                where b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.statuses_id > 2 and a.valid = 1
                order by date asc
                limit 1';
        $last_payment = $db->getRow($sql);
//_dump($last_payment);

        if (!intval($last_payment['id'])) continue;

        //дані
        $sql = 'select e.title as regions_title, d.title as agencies_title, concat_ws(\'/\', c.brand, c.model) as item, concat_ws(\' \', b.insurer_lastname, b.insurer_firstname, b.insurer_patronymicname) as insurer,
                    getPolicyDate(a.number, 1) as policies_date, a.number as policies_number, b.financial_institutions_id,
                    if(f.id > 0, f.item_price, c.car_price) as item_price, a.id as policies_id
                from insurance_policies a
                join insurance_policies_kasko b on a.id = b.policies_id
                join insurance_policies_kasko_items c on b.policies_id = c.policies_id
                join insurance_agencies d on a.agencies_id = d.id
                join insurance_regions e on d.regions_id = e.id
                left join insurance_policies_kasko_item_years_payments f on c.id = f.items_id and now() between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
                where a.id = ' . intval($last_payment['policies_id']);// . ' and g.id = ' . intval($valid['id']);
        $item = $db->getRow($sql);

        //інші дані
        $item['number_insurance_year'] = $valid['number_insurance_year'];
        $item['number_prolongation'] = $valid['number_prolongation'];
        $item['begin'] = $valid['date'];
        $item['end'] = $row_first['end_date'];

        $sql = 'select date_format(if (b.id > 0, max(b.date), a.begin_datetime), \'%Y-%m-%d\')
                from insurance_policies a
                left join insurance_policies_kasko_item_years_payments b on a.id = b.policies_id and b.date <= now()
                where a.id = ' . intval($valid['policies_id']);
        $item['begin_year'] = $db->getOne($sql);

        $item['end_year'] = $db->getOne('select getEndYear(now(), ' . intval($row_first['policies_id']) . ')');

        //тариф
        $sql = 'select if(c.id > 0, c.rate_kasko, b.rate_kasko)
                from insurance_policies a
                join insurance_policies_kasko_items b on a.id = b.policies_id
                left join insurance_policies_kasko_item_years_payments c on a.id = c.policies_id and now() between c.date and subdate(adddate(c.date, interval 1 year), interval 1 day)
                where a.id = ' . intval($valid['policies_id']);
        $item['rate'] = doubleval($db->getOne($sql));

        //ринкова вартість
        $row_market_price = doubleval($db->getOne('select market_price from insurance_policies_kasko_items where policies_id = ' . intval($row_first['policies_id'])));
        $last_market_price = doubleval($db->getOne('select market_price from insurance_policies_kasko_items where policies_id = ' . intval($last_payment['policies_id'])));
        $item['market_price'] = ($row_market_price ? $row_market_price : $last_market_price);

        //страхові виплати
        $sql = 'select sum(a.amount)
                from insurance_accident_payments_calendar a
                join insurance_accidents b on a.accidents_id = b.id
                where a.payment_types_id in (5,6) and a.payment_date <> \'0000-00-00\' and b.policies_id = ' . intval($last_payment['policies_id']);
        $item['payed_amount'] = doubleval($db->getOne($sql));
    } elseif ($row_first['statuses_id'] > 2) {
        //точно діючий запис календаря - дані
        $sql = 'select e.title as regions_title, d.title as agencies_title, concat_ws(\'/\', c.brand, c.model) as item, concat_ws(\' \', b.insurer_lastname, b.insurer_firstname, b.insurer_patronymicname) as insurer,
                    getPolicyDate(a.number, 1) as policies_date, a.number as policies_number, b.financial_institutions_id,
                    if(f.id > 0, f.item_price, c.car_price) as item_price, a.id as policies_id
                from insurance_policies a
                join insurance_policies_kasko b on a.id = b.policies_id
                join insurance_policies_kasko_items c on b.policies_id = c.policies_id
                join insurance_agencies d on a.agencies_id = d.id
                join insurance_regions e on d.regions_id = e.id
                left join insurance_policies_kasko_item_years_payments f on c.id = f.items_id and now() between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
                where a.id = ' . intval($row_first['policies_id']);// . ' and g.id = ' . intval($row['id']);
        $item = $db->getRow($sql);

        //інші дані
        $item['number_insurance_year'] = $valid['number_insurance_year'];
        $item['number_prolongation'] = $valid['number_prolongation'];
        $item['begin'] = $row_first['date'];
        $item['end'] = $row_first['end_date'];

        $sql = 'select date_format(if (b.id > 0, max(b.date), a.begin_datetime), \'%Y-%m-%d\')
                from insurance_policies a
                left join insurance_policies_kasko_item_years_payments b on a.id = b.policies_id and b.date <= now()
                where a.id = ' . intval($row_first['policies_id']);
        $item['begin_year'] = $db->getOne($sql);

        $item['end_year'] = $db->getOne('select getEndYear(now(), ' . intval($row_first['policies_id']) . ')');

        //тариф
        $sql = 'select if(c.id > 0, c.rate_kasko, b.rate_kasko)
                from insurance_policies a
                join insurance_policies_kasko_items b on a.id = b.policies_id
                left join insurance_policies_kasko_item_years_payments c on a.id = c.policies_id and now() between c.date and subdate(adddate(c.date, interval 1 year), interval 1 day)
                where a.id = ' . intval($row_first['policies_id']);
        $item['rate'] = doubleval($db->getOne($sql));

        //ринкова вартість
        $item['market_price'] = doubleval($db->getOne('select market_price from insurance_policies_kasko_items where policies_id = ' . intval($row_first['policies_id'])));

        //страхові виплати
        $sql = 'select sum(a.amount)
                from insurance_accident_payments_calendar a
                join insurance_accidents b on a.accidents_id = b.id
                where a.payment_types_id in (5,6) and a.payment_date <> \'0000-00-00\' and b.policies_id = ' . intval($row_first['policies_id']);
        $item['payed_amount'] = doubleval($db->getOne($sql));
    } else {
        continue;
    }

    $item['diff_days'] = $db->getOne('select datediff(' . $db->quote($item['end_year']) . ', now()) + 1');
    $item['full_days'] = $db->getOne('select datediff(' . $db->quote($item['end_year']) . ', ' . $db->quote($item['begin_year']) . ') + 1');

    //тип договору
    if (intval($item['number_prolongation']) && intval($item['financial_institutions_id'])) {
        $item['type'] = 'пролонгація / кредит';
    } elseif (intval($item['number_prolongation']) && !intval($item['financial_institutions_id'])) {
        $item['type'] = 'пролонгація / рітейл';
    } elseif (!intval($item['number_prolongation']) && intval($item['financial_institutions_id'])) {
        $item['type'] = 'новий / кредит';
    } else {
        $item['type'] = 'пролонгація / рітейл';
    }

    if ($item['market_price'] > 0) {
        $item['add_premium'] = roundNumber(($item['market_price'] - $item['item_price'] + $item['payed_amount']) * $item['rate'] * ($item['diff_days'] / $item['full_days']) / 100, 2);
    } else {
        $item['add_premium'] = 'Не визначено';
    }

    $items[] = $item;
}

foreach ($items as $item) {
	$sql = 'insert into `!diff_premium` set
				policies_id = ' . intval($item['policies_id']) . ',
				regions_title = ' . $db->quote($item['regions_title']) . ',
				agencies_title = ' . $db->quote($item['agencies_title']) . ',
				item = ' . $db->quote($item['item']) . ',
				insurer = ' . $db->quote($item['insurer']) . ',
				policies_date = ' . $db->quote(date('Y-m-d', strtotime($item['policies_date']))) . ',
				policies_number = ' . $db->quote($item['policies_number']) . ',
				item_price = ' . $db->quote($item['item_price']) . ',
				item_price_valid = ' . $db->quote(roundNumber($item['item_price'] - $item['payed_amount'], 2)) . ',
				market_price = ' . $db->quote($item['market_price']) . ',
				rate = ' . $db->quote($item['rate']) . ',
				add_premium = ' . $db->quote($item['add_premium']) . ',
				number_prolongation = ' . intval($item['number_prolongation']) . ',
				begin = ' . $db->quote(date('Y-m-d', strtotime($item['begin']))) . ',
				end = ' . $db->quote(date('Y-m-d', strtotime($item['end']))) . ',
				type = ' . $db->quote($item['type']);
	$db->query($sql);
}

exit;

//_dump($items);exit;

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table><tr>';

echo '<td>Регіон</td>';
echo '<td>Дилер</td>';
echo '<td>Марка / модель</td>';
echo '<td>Страхувальник</td>';
echo '<td>Дата договору</td>';
echo '<td>Номер договору</td>';
echo '<td>Страхова сума</td>';
echo '<td>Залишкова страхова сума</td>';
echo '<td>Ринкова вартість</td>';
echo '<td>Тариф</td>';
echo '<td>Додаткова премія</td>';
echo '<td>Пролонгація</td>';
echo '<td>Початок</td>';
echo '<td>Кінець</td>';
echo '<td>Тип договору</td>';

echo '</tr>';

foreach ($items as $item) {
    echo '<tr>';

    echo '<td>' . $item['regions_title'] . '</td>';
    echo '<td>' . $item['agencies_title'] . '</td>';
    echo '<td>' . $item['item'] . '</td>';
    echo '<td>' . $item['insurer'] . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($item['policies_date'])) . '</td>';
    echo '<td>' . $item['policies_number'] . '</td>';
    echo '<td>' . getRateFormat($item['item_price'], 2) . '</td>';
    echo '<td>' . getRateFormat(roundNumber($item['item_price'] - $item['payed_amount'], 2), 2) . '</td>';
    echo '<td>' . getRateFormat($item['market_price'], 2) . '</td>';
    echo '<td>' . getRateFormat($item['rate'], 3) . '</td>';
    echo '<td>' . getRateFormat($item['add_premium'], 2) . '</td>';
    echo '<td>' . $item['number_prolongation'] . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($item['begin'])) . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($item['end'])) . '</td>';
    echo '<td>' . $item['type'] . '</td>';

    echo '</tr>';
}

echo '</table>';

?>