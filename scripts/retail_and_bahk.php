<?

require_once '../include/collector.inc.php';

$sql = 'select a.shassi
        from insurance_policies_kasko_items a
        join insurance_policies_kasko b on a.policies_id = b.policies_id
        join insurance_policies c on b.policies_id = c.id
        where b.financial_institutions_id > 0 and length(a.shassi) > 5 and c.product_types_id = 3
        group by a.shassi';
$bank_shassi = $db->getCol($sql);

$sql = 'select a.shassi
        from insurance_policies_kasko_items a
        join insurance_policies_kasko b on a.policies_id = b.policies_id
        join insurance_policies c on b.policies_id = c.id
        where b.financial_institutions_id = 0 and length(a.shassi) > 5 and c.product_types_id = 3
        group by a.shassi';
$retail_shassi = $db->getCol($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table border="2">';
echo '<tr>';

echo '<td>Номер КАСКО Банк</td>';
echo '<td>ИНН</td>';
echo '<td>Название продукта</td>';
echo '<td>Период действия</td>';
echo '<td>СС</td>';
echo '<td>тариф</td>';

echo '<td>Номер КАСКО Ритейл</td>';
echo '<td>ИНН</td>';
echo '<td>Название продукта</td>';
echo '<td>Период действия</td>';
echo '<td>Автосалон</td>';
echo '<td>СС</td>';
echo '<td>тариф</td>';
echo '<td>ФИО менеджера</td>';
echo '<td>ФИО клиента</td>';

echo '<td>VIN-код</td>';

echo '</tr>';

$number = 0;
foreach ($retail_shassi as $retail_shassi_row) {
    if (in_array($retail_shassi_row, $bank_shassi)) {
        $number++;

        $sql = 'select a.number as policies_number, b.products_title, concat_ws(\' - \', date_format(a.begin_datetime, \'%d.%m.%Y\'), date_format(a.end_datetime, \'%d.%m.%Y\')) as period, b.car_price, b.rate_kasko,
                    if (c.insurer_person_types_id = 1, c.insurer_identification_code, c.insurer_edrpou) as inn
                from insurance_policies a
                join insurance_policies_kasko_items b on a.id = b.policies_id
                join insurance_policies_kasko c on a.id = c.policies_id and c.financial_institutions_id > 0
                where a.sub_number = 0 and b.shassi = ' . $db->quote($retail_shassi_row);
        $bank_policies = $db->getAll($sql);

        $sql = 'select a.number as policies_number, b.products_title, concat_ws(\' - \', date_format(a.begin_datetime, \'%d.%m.%Y\'), date_format(a.end_datetime, \'%d.%m.%Y\')) as period, b.car_price, b.rate_kasko,
                    d.title as agencies_title, concat_ws(\' \', e.lastname, e.firstname, e.patronymicname) as manager,
                    if (c.insurer_person_types_id = 1, concat_ws(\' \', c.insurer_lastname, c.insurer_firstname, c.insurer_patronymicname), c.insurer_company) as client,
                    if (c.insurer_person_types_id = 1, c.insurer_identification_code, c.insurer_edrpou) as inn
                from insurance_policies a
                join insurance_policies_kasko_items b on a.id = b.policies_id
                join insurance_policies_kasko c on a.id = c.policies_id and c.financial_institutions_id = 0
                join insurance_agencies d on a.agencies_id = d.id
                left join insurance_accounts e on a.manager_id = e.id
                where a.sub_number = 0 and b.shassi = ' . $db->quote($retail_shassi_row);
        $retail_policies = $db->getAll($sql);

        $k = 0;
        while ($k < sizeof($bank_policies) || $k < sizeof($retail_policies)) {
            echo '<tr>';

            echo '<td>&nbsp;' . $bank_policies[$k]['policies_number'] . '</td>';
            echo '<td>&nbsp;' . $bank_policies[$k]['inn'] . '</td>';
            echo '<td>&nbsp;' . $bank_policies[$k]['products_title'] . '</td>';
            echo '<td>&nbsp;' . $bank_policies[$k]['period'] . '</td>';
            echo '<td>&nbsp;' . $bank_policies[$k]['car_price'] . '</td>';
            echo '<td>&nbsp;' . $bank_policies[$k]['rate_kasko'] . '</td>';

            echo '<td>&nbsp;' . $retail_policies[$k]['policies_number'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['inn'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['products_title'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['period'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['agencies_title'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['car_price'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['rate_kasko'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['manager'] . '</td>';
            echo '<td>&nbsp;' . $retail_policies[$k]['client'] . '</td>';

            if ($k == 0) {
                echo '<td rowspan="' . (sizeof($bank_policies) > sizeof($retail_policies) ? sizeof($bank_policies) : sizeof($retail_policies)) . '">' . $retail_shassi_row . '</td>';
            }

            echo '</tr>';

            $k++;
        }
    }
}

echo '</table>';

?>