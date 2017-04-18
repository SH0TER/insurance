<?
require_once '../include/collector.inc.php';

$sql = 'SELECT getNumber(car_sales.shassi, 2) as policies_number_kasko, getNumber(car_sales.shassi, 1) as policies_number_go, date_format(getBeginDatetime(car_sales.shassi, 2), \'%d.%m.%Y\') as policies_datetime_kasko,
        date_format(getBeginDatetime(car_sales.shassi, 1), \'%d.%m.%Y\') as policies_datetime_go, car_sales.*, date_format(car_sales.date, \'%d.%m.%Y\') as date
            FROM car_sales';
$list=$db->getAll($sql);

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
                <td>Номер КАСКО</td>
                <td>дата початку дії КАСКО</td>
                <td>Номер ОСЦПВ</td>
                <td>дата початку дії ОСЦПВ</td>
                <td>Марка</td>
                <td>Модель</td>
                <td>Серійний номер</td>
                <td>Дата продажу</td>
                <td>Код ділера</td>
                <td>Назва ділера</td>
            </tr>
            <?
                foreach ($list as $row) {
            ?>
            <tr>
                <td align="left"><?=$row['policies_number_kasko']?></td>
                <td align="left"><?=$row['policies_datetime_kasko']?></td>
                <td align="left"><?=$row['policies_number_go']?></td>
                <td align="left"><?=$row['policies_datetime_go']?></td>
                <td align="left"><?=$row['brand']?></td>
                <td align="left"><?=$row['model']?></td>
                <td align="left"><?=$row['shassi']?></td>
                <td align="left"><?=$row['date']?></td>
                <td align="left"><?=$row['code']?></td>
                <td align="left"><?=$row['title']?></td>
            </tr>
            <? } ?>
        </table>
    </body>
</html>