<?

require_once '../include/collector.inc.php';

$sql = 'select id
        from insurance_policies
        where product_types_id = 3 and child_id = 0 and item <> \'Автопарк\' and interrupt_datetime <> \'1970-01-01\'';
$policies_idx = $db->getCol($sql);

$sql = 'select policies_id, max(end_date) as end_date
        from insurance_policy_payments_calendar
        where valid = 1 and statuses_id > 1 and policies_id in (' . implode(', ', $policies_idx) . ')
        group by policies_id';
$calendars_data = $db->getAll($sql);

$values = array();

foreach ($calendars_data as $calendar_data) {
    if (strtotime($calendar_data['end_date']) >= strtotime('2014-01-01')) continue;

    $sql = 'select d.id as calendars_id, a.number as policies_number, h.title as bank_title, if(b.terms_years_id > 1, \'так\', \'ні\') as multi_year, if(b.options_test_drive = 1, \'так\', \'ні\') as test_drive,
                if(b.options_race = 1, \'так\', \'ні\') as race,
                if (b.insurer_person_types_id = 1, concat_ws(\' \', b.insurer_lastname, b.insurer_firstname, b.insurer_patronymicname), b.insurer_company) as insurer,
                if (b.insurer_person_types_id = 1, b.insurer_identification_code, b.insurer_edrpou) as insurer_code,
                getInsurerAddressByPoliciesId(a.id) as insurer_address, b.insurer_phone, concat_ws(\'/\', c.brand, c.model) as item, c.shassi, c.engine_size, c.year, c.products_title, c.car_price, c.rate_kasko, c.amount_kasko, 0 as amount_payed,
                date_format(d.payment_date, \'%d.%m.%Y\') as payment_date, date_format(d.date, \'%d.%m.%Y\') as begin, \'\' as end, d.number_prolongation, f.title as agencies_title, g.title as insurer_regions_title
            from insurance_policies a
            join insurance_policies_kasko b on a.id = b.policies_id
            join insurance_policies_kasko_items c on b.policies_id = c.policies_id
            join insurance_policy_payments_calendar d on c.policies_id = d.policies_id and valid = 1 and d.end_date = ' . $db->quote($calendar_data['end_date']) . '
            join insurance_agencies e on a.agencies_id = e.id
            join insurance_agencies f on e.top = f.id
            join insurance_regions g on b.insurer_regions_id = g.id
            left join insurance_financial_institutions h on b.financial_institutions_id = h.id
            where a.id = ' . intval($calendar_data['policies_id']);
    $row = $db->getRow($sql);

    $row['end'] = date('d.m.Y', strtotime($calendar_data['end_date']));

    $sql = 'select sum(amount)
            from insurance_policy_payments_policy_payments_calendar
            where policy_payments_calendar_id = ' . intval($row['calendars_id']);
    $row['amount_payed'] = doubleval($db->getOne($sql));

    $row['insurer_address'] = str_replace('region', 'район', str_replace('flat', 'кв.', str_replace('house', 'буд.', $row['insurer_address'])));

    unset($row['calendars_id']);

    $values[] = $row;
}

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table border="2">';
foreach ($values as $row) {
    echo '<tr>';
    foreach ($row as $val) {
        echo '<td>&nbsp;' . $val . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

//_dump($values);

?>