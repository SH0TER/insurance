{literal}
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

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
        </style>
    </head>
    <body>
        <table border="1" cellpadding=0 cellspacing=0>
            <tr class="columns">
                <td>ФІО</td>
                <td>Авто</td>
                <td>Вартість, грн.</td>
                <td>Термін кредитування</td>
                <td>Мобільний телефон</td>
                <td>Реєстрація, телефон</td>
                <td>Проживання, телефон</td>
                <td>Автосалон</td>
                <td>Банк</td>
                <td>Початок</td>
                <td>Кінець</td>
                <td>Дата кредитного договору</td>
                <td>Призначена дата кредитної угоди</td>
            </tr>
            {/literal}
            {section name="roll" loop=$list}
            <tr>
                <td>{$list[roll].lastname} {$list[roll].firstname} {$list[roll].patronymicname}</td>
                <td>{$list[roll].carsTitle}</td>
                <td>{$list[roll].price}</td>
                <td>{$list[roll].credit_period}</td>
                <td>{$list[roll].mobile_phone}</td>
                <td>{$list[roll].registration_phone}</td>
                <td>{$list[roll].habitation_phone}</td>
                <td>{$list[roll].agencies_id}</td>
                <td>{$list[roll].financial_institutions_title}</td>
                <td>{$list[roll].begin_datetimeFormat}</td>
                <td>{$list[roll].end_datetimeFormat}</td>
                <td>{$list[roll].credit_agreement_dateFormat}</td>
                <td>{$list[roll].credit_set_datetimeFormat}</td>
            </tr>
            {/section}
        </table>
    </body>
</html>