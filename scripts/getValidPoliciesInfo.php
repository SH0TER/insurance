<?

require_once '../include/collector.inc.php';
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

//ніби діючі періоди
$sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
        from insurance_policy_payments_calendar a
        join insurance_policies b on a.policies_id = b.id
        join insurance_policies_kasko c on b.id = c.policies_id
        where now() between a.date and a.end_date and a.valid = 1 and b.product_types_id = 3 and b.item <> \'Автопарк\' and datediff(a.end_date, a.date) <= 366';
$list_first = $db->getAll($sql);
//_dump($list_first);

$list_second = array();
$policies = array();
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
        $sql = 'select concat_ws(\' \', b.insurer_lastname, b.insurer_firstname, b.insurer_patronymicname) as insurer,
                       getInsurerAddressByPoliciesId(a.id) as address,
                       concat_ws(\'/\', c.brand, c.model) as item,
                       a.number as policies_number,
                       if(f.id > 0, f.amount_kasko, c.amount_kasko) as premium,
                       getPolicyDate(a.number,2) as begin,
                       getPolicyDate(a.number,3) as end,
                       c.shassi, c.sign
                from insurance_policies a
                join insurance_policies_kasko b on a.id = b.policies_id
                join insurance_policies_kasko_items c on b.policies_id = c.policies_id
                left join insurance_policies_kasko_item_years_payments f on c.id = f.items_id and now() between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
                where a.id = ' . intval($last_payment['policies_id']);
        $policy = $db->getRow($sql);

        //інші дані
        /*$sql = 'select id
                from insurance_policy_payments_calendar
                where valid = 1 and policies_id = ' . intval($last_payment['policies_id']) . ' and number_insurance_year = ' . intval($last_payment['number_insurance_year']);
        $policy_calendars_idx = $db->getCol($sql);

        $sql = 'select sum(amount)
                from insurance_policy_payments_policy_payments_calendar
                where policy_payments_calendar_id IN (' . implode(', ', $policy_calendars_idx) . ')';
        $policy['premium_payed'] = $db->getOne($sql);*/

    } elseif ($row_first['statuses_id'] > 2) {
        //точно діючий запис календаря - дані
        $sql = 'select concat_ws(\' \', b.insurer_lastname, b.insurer_firstname, b.insurer_patronymicname) as insurer,
                       getInsurerAddressByPoliciesId(a.id) as address,
                       concat_ws(\'/\', c.brand, c.model) as item,
                       a.number as policies_number,
                       if(f.id > 0, f.amount_kasko, c.amount_kasko) as premium,
                       getPolicyDate(a.number,2) as begin,
                       getPolicyDate(a.number,3) as end,
                       c.shassi, c.sign
                from insurance_policies a
                join insurance_policies_kasko b on a.id = b.policies_id
                join insurance_policies_kasko_items c on b.policies_id = c.policies_id
                left join insurance_policies_kasko_item_years_payments f on c.id = f.items_id and now() between f.date and subdate(adddate(f.date, interval 1 year), interval 1 day)
                where a.id = ' . intval($row_first['policies_id']);
        $policy = $db->getRow($sql);

        //інші дані
        /*$sql = 'select id
                from insurance_policy_payments_calendar
                where valid = 1 and policies_id = ' . intval($row_first['policies_id']) . ' and number_insurance_year = ' . intval($row_first['number_insurance_year']);
        $policy_calendars_idx = $db->getCol($sql);

        $sql = 'select sum(amount)
                from insurance_policy_payments_policy_payments_calendar
                where policy_payments_calendar_id IN (' . implode(', ', $policy_calendars_idx) . ')';
        $policy['premium_payed'] = $db->getOne($sql);*/

    } else {
        continue;
    }

    $policies[] = $policy;

    $sql = 'insert into axapta_kasko_vin_cur set vin = ' . $db->quote($policy['shassi']) . ', sign = ' . $db->quote($policy['sign']);
    $db->query($sql);
}
exit;
header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table><tr>';

echo '<td>ПІБ</td>';
echo '<td>Адреса</td>';
echo '<td>Марка / модель</td>';
echo '<td>Номер договору</td>';
echo '<td>Сума річного страхового платежу</td>';
echo '<td>Сума сплаченого річного платежу</td>';
echo '<td>Дата початку дії договору</td>';
echo '<td>Дата закінчення дії договору</td>';

echo '</tr>';

foreach ($policies as $policy) {
    echo '<tr>';

    echo '<td>' . $policy['insurer'] . '</td>';
    echo '<td>' . str_replace('region', 'район', str_replace('flat', 'кв.', str_replace('house', 'буд.', $policy['address']))) . '</td>';
    echo '<td>' . $policy['item'] . '</td>';
    echo '<td>' . $policy['policies_number'] . '</td>';
    echo '<td>' . getRateFormat($policy['premium'], 2) . '</td>';
    echo '<td>' . getRateFormat($policy['premium_payed'], 2) . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($policy['begin'])) . '</td>';
    echo '<td>' . date('d.m.Y', strtotime($policy['end'])) . '</td>';

    echo '</tr>';
}

echo '</table>';

?>