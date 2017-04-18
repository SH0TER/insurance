<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>КАСКО. Бордеро премій</title>
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
        </style>
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border=1>
            <tr class="columns">
                <td colspan="3">Договір страхування</td>
                <td rowspan="2">Страхувальник</td>
                <td rowspan="2">Об'єкт</td>
                <td rowspan="2">Номер шассі/кузова</td>
                <td rowspan="2">Держ. номер</td>
                <td colspan="2">Період страхування</td>
                <td rowspan="2">Страхова сума, грн.</td>
                <td colspan="3">Оплати</td>
                <td rowspan="2" width="60">Страхові випадки</td>
                <td rowspan="2">Рік</td>
                <td colspan="2">Франшиза</td>
                <td rowspan="2">Ризики</td>
                <td rowspan="2">Без врахування зносу</td>
                <td rowspan="2">Вигодонабувач</td>
            </tr>
            <tr class="columns">
                <td>№</td>
                <td>Дата</td>
                <td>Платіж</td>
                <td>з</td>
                <td>до</td>
                <td>Кiльк.</td>
                <td>Дата</td>
                <td>Статус</td>
                <td width="60">Викр.</td>
                <td width="60">Пош.</td>
            </tr>
            <?
            foreach ($list as $row) {
                $i = 1 - $i;
                ?>
            <tr class="<?=Form::getRowClass($row, $i)?>">
                <td><?=$row['number']?></td>
                <td><?=$row['date_format']?></td>
                <td><?=$row['datetimeLastFormat']?></td>
                <td><?=$row['insurer'] ?></td>
                <td><?=$row['item']?></td>
                <td><?=$row['shassi']?></td>
                <td><?=$row['sign']?></td>
                <td><?=$row['begin_datetimeFormat']?></td>
                <td><?=$row['end_datetimeFormat']?></td>
                <td style="text-align: right;"><?=getMoneyFormat($row['price'], -1)?></td>
                <td>
                    <?
                        switch ($row['payment_brakedown_id']) {
                            case 1:
                                echo '1';
                                break;
                            case 2:
                                echo '2';
                                break;
                            case 3:
                                echo '4';
                                break;
                        }
                    ?>
                </td>
                <td>
                    <?
                        foreach ($row['payments'] as $payment) {
                            if ($payment['statuses_id'] >=PAYMENT_STATUSES_PAYED) echo '<b>';
                            echo date('d.m.Y',smarty_make_timestamp($payment['date']));
                            if ($payment['statuses_id'] >=PAYMENT_STATUSES_PAYED) echo '</b>';
                            echo '<br>';
                        }
                    ?>
                </td>
				<td>
                    <?
                        foreach ($row['payments'] as $payment) {
                            echo $payment['paymentStatusesTitle'] . '<br />';
                        }
                    ?>
                </td>
                <td align="center"><?=$row['eventsNumber']?></td>
                <td><?=$row['year']?></td>
                <td align="right"><?=($row['deductibles_absolute1']) ? str_replace('.',',',$row['deductibles_value1']) : $row['deductibles_value1'] . ' %'?></td>
                <td align="right"><?=($row['deductibles_absolute0']) ? str_replace('.',',',$row['deductibles_value0']) : $row['deductibles_value0'] . ' %'?></td>
                <td><?=implode('; ', $row['risks'])?></td>
                <td><?=(($row['options_deterioration_no'] == 1) ? 'так' : 'ні')?></td>
                <td><?=$row['assured_title']?></td>
            </tr>
            <? } ?>
        </table>
    </body>
</html>