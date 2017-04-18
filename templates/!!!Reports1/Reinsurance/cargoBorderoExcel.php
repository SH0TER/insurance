<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>Сертифікати добровільного страхування вантажів та багажу (вантажобагажу). Бордеро премій</title>
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
                <td colspan="3">Сертифікат</td>
                <td rowspan="2">Модель</td>
                <td rowspan="2">Номер кузова(шасі)</td>
                <td rowspan="2">Вартість вантажу, грн.</td>
                <td rowspan="2">Страхова сума, грн.</td>
            </tr>
            <tr class="columns">
                <td>№</td>
                <td>Дата заключення</td>
                <td>№ документу</td>
            </tr>
            <?
                foreach ($list as $row) {
                    $i = 1 - $i;
            ?>
            <tr class="<?=Form::getRowClass($row, $i)?>">
                <td><?=$row['number']?></td>
                <td>&nbsp;<?=$row['date_format']?></td>
                <td>&nbsp;<?=$row['document_number']?> від <?=$row['document_date_format']?></td>
                <td>&nbsp;<?=$row['model'] ?></td>
                <td>&nbsp;<?=$row['shassi']?></td>
                <td style="text-align: right; padding-right: 10px;"><?=getMoneyFormat($row['price'], -1)?></td>
                <td style="text-align: right; padding-right: 10px;"><?=getMoneyFormat($row['price'], -1)?></td>
            </tr>
            <? } ?>
        </table>
    </body>
</html>