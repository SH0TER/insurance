<?

require_once '../include/collector.inc.php';
require_once '../include/lib/Excel/reader.php';
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);
$Excel->read('clients3.xls');

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table><tr>';

echo '<td>Номер договору КАСКО</td>';
echo '<td>Поліс ОСЦПВ</td>';
echo '<td>№</td>';
echo '<td>Дата документа</td>';
echo '<td>Вид номенклатуры</td>';
echo '<td>Модель</td>';
echo '<td>Серийный номер</td>';
echo '<td>Название банка для печати</td>';
echo '<td>Код менеджера</td>';
echo '<td>Способ оплаты</td>';
echo '<td>Номер партии</td>';
echo '<td>Цена без НДС</td>';
echo '<td>НДС</td>';
echo '<td>Цена с НДС</td>';
echo '<td>Тип клиента</td>';
echo '<td>Телефон</td>';
echo '<td>Название</td>';
echo '<td>Дата рождения</td>';
echo '<td>Регион</td>';
echo '<td>Город</td>';
echo '<td>Адрес</td>';

echo '</tr>';

for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
    $number = '';
    $vin = $db->quote($Excel->sheets[0]['cells'][$i][5]);

    $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
            from insurance_policy_payments_calendar a
            join insurance_policies b on a.policies_id = b.id
            join insurance_policies_kasko_items c on b.id = c.policies_id and c.shassi = ' . $vin . '
            where now() between a.date and a.end_date and a.valid = 1 and b.product_types_id = 3 and b.item <> \'Автопарк\' and datediff(a.end_date, a.date) <= 366';
    $list_first = $db->getAll($sql);

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
        $number = $item['policies_number'];
    }



    echo '<tr>';

    $sql = 'SELECT a.number FROM insurance_policies a JOIN insurance_policies_go b ON a.id = b.policies_id WHERE now() between a.begin_datetime and a.interrupt_datetime AND a.payment_statuses_id > 2 AND a.policy_statuses_id IN (10,15,17) AND b.shassi = ' . $vin;
    $policy = $db->getOne($sql);

    echo '<td>' . $number . '</td>';
    echo '<td>' . $policy . '</td>';

    for ($j=1; $j<=19; $j++) {
        if ($j==2 || $j==16) {
            $date = substr($Excel->sheets[0]['cells'][$i][$j], 0, 2) . '.' . substr($Excel->sheets[0]['cells'][$i][$j], 3, 2) . '.' . substr($Excel->sheets[0]['cells'][$i][$j], 6, 4);
            echo '<td>' . date('d.m.Y', mktime(0,0,0, substr($Excel->sheets[0]['cells'][$i][$j], 3, 2), substr($Excel->sheets[0]['cells'][$i][$j], 0, 2) - 1, substr($Excel->sheets[0]['cells'][$i][$j], 6, 4))) . '</td>';
        } elseif ($j==10 || $j==11 || $j==12) {
            echo '<td>' . str_replace('.', ',', $Excel->sheets[0]['cells'][$i][$j]) . '</td>';
        } else {
            echo '<td>' . $Excel->sheets[0]['cells'][$i][$j] . '</td>';
        }
    }

    echo '</tr>';

}

echo '</table>';

?>