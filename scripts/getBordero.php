<?
require_once '../include/collector.inc.php';

$sql = 'SELECT policies.number,
                date_format((SELECT a.begin_datetime FROM insurance_policies as a WHERE a.sub_number = 0 and a.number = policies.number), \'%d.%m.%Y\') as begin_datetime,
                IF(policies_kasko.terms_years_id = 1, date_format(policies.interrupt_datetime, \'%d.%m.%Y\'), date_format((SELECT a.begin_datetime FROM insurance_policies as a WHERE a.sub_number = 0 and a.number = policies.number) + INTERVAL policies_kasko.terms_years_id YEAR - INTERVAL  1 day , \'%d.%m.%Y\')) as interrupt_datetime,
                IF(policies_kasko.terms_years_id = 1, (SELECT a.begin_datetime FROM insurance_policies as a WHERE a.sub_number = 0 and a.number = policies.number),  payments_calendar.date) as begin_period,
                IF(policies_kasko.terms_years_id = 1, policies.interrupt_datetime,  payments_calendar.date + INTERVAL 1 YEAR - INTERVAL 1 DAY) as end_period,
                policies_kasko.terms_years_id as terms_years_id, policies.interrupt_datetime as interrupt_datetime_for_one_year,
                MIN(years_payments.date) + INTERVAL policies_kasko.terms_years_id YEAR - INTERVAL  1 day as years_payments_date,
                CONCAT(kasko_items.brand, \'/\', kasko_items.model) as items, policies_kasko.card_assistance, policies.insurer, policies_kasko.owner_phone as phone, kasko_items.shassi
        FROM insurance_policies as policies
        LEFT JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id
        LEFT JOIN insurance_policies_kasko_items as kasko_items ON policies.id = kasko_items.policies_id
        LEFT JOIN insurance_policy_payments_calendar as payments_calendar ON payments_calendar.policies_id = policies.id and NOW() between payments_calendar.date AND (payments_calendar.date + INTERVAL 1 YEAR)
		LEFT JOIN insurance_policies_kasko_item_years_payments as years_payments ON kasko_items.id = years_payments.items_id AND policies.id = years_payments.policies_id AND payments_calendar.date between years_payments.date AND (years_payments.date + INTERVAL 1 YEAR)
        WHERE product_types_id = 3 and payments_calendar.statuses_id IN (3, 4)
        GROUP BY policies.id
        HAVING NOW() between  begin_period and end_period and end_period < \'2014-08-01\'';
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));
?>

<html>

    <head>
        <title>отчет</title>
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
                border-right: 1px solid #FFFFFF;
                border-top: 1px solid #FFFFFF;
                border-bottom: 1px solid #FFFFFF;
                background-color: #008575;
            }
            td.number {
                mso-number-format:"\@";
            }
        </style>
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border=1>
            <tr class="columns">
                <td>Номер</td>
                <td>Початок дії</td>
                <td>Кінець дії</td>
                <td>Страхувальник</td>
                <td>Телефон</td>
                <td>Марка/модель</td>
                <td>Номер кузова</td>
                <td>Номер картки Експресс Ассістанс</td>
            </tr>
            <?
                foreach ($list as $row) {
            ?>
            <tr>
                <td align="left"><?=$row['number']?></td>
                <td align="left"><?=$row['begin_datetime']?></td>
                <td align="left"><?=$row['interrupt_datetime']?></td>
                <td align="left"><?=$row['insurer']?></td>
                <td align="left"><?=$row['phone']?></td>
                <td align="left"><?=$row['items']?></td>
                <td align="left"><?=$row['shassi']?></td>
                <td align="left"><?=$row['card_assistance']?></td>
            </tr>
            <? } ?>
        </table>
    </body>
</html>