<head>
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
            border-right: 1px solid #4F5D75;
            border-top: 1px solid #4F5D75;
            border-bottom: 1px solid #4F5D75;
            background-color: #008575;
        }
        .grey {
            background-color: #CCCCCC;
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" border="1">
        <tr class="columns">
            <td rowspan="3">Вигодонабувач</td>
            <td rowspan="3">ПІБ Клієнта</td>
            <td rowspan="3">ІПН Клієнта</td>
            <td rowspan="3">№ договору страхування</td>
            <td rowspan="3">Дата укладання договору</td>
            <td rowspan="3">Страхова сума за договором, грн.</td>
            <td rowspan="2" colspan="2">Термін дії договору</td>
			<td rowspan="2" colspan="2">Умови за договором</td>
            <td rowspan="3">Платіж отриманий Страховиком у звітному періоді, грн.</td>
			<td rowspan="3">Спосіб оплати</td>
            <td colspan="2">Комісійна винагорода</td>
            <td rowspan="3">Регіональна філія СК "Х"</td>
            <td rowspan="3">Примітка</td>
        </tr>
        <tr class="columns">
            <td colspan="2">Х - по факту отримання платежу</td>
        </tr>
        <tr class="columns">
            <td>з</td>
            <td>по</td>
			<td>%</td>
			<td>грн.</td>
            <td>за консультації,%</td>
            <td>cума винагороди, грн.</td>
        </tr>
        <?
            if (is_array($list)) {
                foreach ($list as $row) {
        ?>
        <tr class="<?=Form::getRowClass($row, $i)?>">
            <td><?=$row['financial_institutions_title']?></td>
            <td><?=$row['insurer_lastname'] . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname']?></td>
            <td><?=$row['insurer_identification_code']?></td>
            <td><?=$row['number']?></td>
            <td><?=$row['date_format']?></td>
            <td><?=getMoneyFormat($row['price'], -1)?></td>
            <td><?=$row['begin_datetimeFormat']?></td>
            <td><?=$row['end_datetimeFormat']?></td>
            <td><?=getRateFormat($row['rate'])?></td>
            <td><?=getMoneyFormat($row['policiesAmount'], -1)?></td>
            <td><?=getMoneyFormat($row['amount'], -1)?></td>
			<td><?=$row['paymentsTitle']?></td>
            <td><?=getRateFormat($row['commission_financial_institution_percent'])?></td>
            <td><?=getMoneyFormat($row['commission_financial_institution_amount'], -1)?></td>
            <td><?=$row['agencies_title']?></td>
            <td>&nbsp;</td>
        </tr>
        <?
                }
            }
        ?>
    </table>
</body>
</html>