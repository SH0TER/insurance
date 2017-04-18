<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

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
                <td>ФІО</td>
                <td>Місце реєстрації</td>
                <td>Ідентифікаційний код</td>
                <td>Номер та серія паспорта</td>
                <td>Ким виданий паспорт</td>
                <td>Коли виданий паспорт</td>
                <td>Банк отримувач</td>
                <td>МФО</td>
                <td>Код ЗКПО</td>
                <td>Номер рахунку</td>
                <td>Призначення платежу</td>
            </tr>
            <?
                foreach ($list as $row) {
            ?>
            <tr>
                <td align="left"><?=$row['master']?></td>
                <td align="left"><?=$row['address']?></td>
                <td align="left"><?=$row['identification_code']?></td>
                <td align="left"><?=$row['passport_number']?></td>
                <td align="left"><?=$row['passport_place']?></td>
                <td align="left"><?=$row['passport_date']?></td>
                <td align="left"><?=$row['recipient']?></td>
                <td align="left"><?=$row['mfo']?></td>
                <td align="left"><?=$row['zkpo']?></td>
                <td align="left" class='number''><?=$row['bank_account']?></td>
                <td align="left"><?=$row['bank_reference']?></td>
            </tr>
            <? } ?>
        </table>
    </body>
</html>