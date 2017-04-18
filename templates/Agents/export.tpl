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
                <td>Код</td>
                <td>Агенція</td>
                <td>Логін</td>
                <td>Пароль</td>
                <td>Прізвище</td>
                <td>Ім'я</td>
                <td>По батькові</td>
                <td>Телефон</td>
                <td>Факс</td>
                <td>Мобільний</td>
                <td>E-mail</td>
                <td>Паспорт. Cерія</td>
                <td>Паспорт. Номер</td>
                <td>Паспорт. Дата видачі</td>
                <td>Паспорт. Місце видачі</td>
                <td>ІПН</td>
                <td>Адреса</td>
                <td>Номер агентського договору</td>
				<td>Дата агентського договору</td>
                <td>Отримувач</td>
                <td>МФО</td>
                <td>ЗКПО</td>
                <td>Рахунок</td>
                <td>Призначення платежу</td>
				
				<td>Номер картки</td>
				<td>Дата дії</td>
				<td>Назва банку</td>
				
                <td>Посада, ПІБ у називному відмінку</td>
                <td>Посада, ПІБ у родовому відмінку</td>
                <td>Договір КАСКО, діє на підставі</td>
				<td>Договір НВ Експрес, діє на підставі</td>
				<td>Договір НВ ГЛ, діє на підставі</td>
				
				<td>Анкети</td>
				<td>Продавець</td>
				<td>СТО</td>
				<td>Акт</td>
				
                <td>Активний</td>
            </tr>
            {/literal}
            {section name="roll" loop=$list}
            <tr>
                <td>{$list[roll].agenciesCode}</td>
                <td>{$list[roll].agencies_title}</td>
                <td x:str>{$list[roll].login}</td>
                <td>{$list[roll].password|escape}</td>
                <td>{$list[roll].lastname}</td>
                <td>{$list[roll].firstname}</td>
                <td>{$list[roll].patronymicname}</td>
                <td>{$list[roll].phone}</td>
                <td>{$list[roll].fax}</td>
                <td>{$list[roll].mobile}</td>
                <td>{$list[roll].email}</td>
                <td>{$list[roll].passport_series}</td>
                <td>{$list[roll].passport_number}</td>
                <td>{$list[roll].passport_date|date_format:$smarty.const.DATE_FORMAT}</td>
                <td>{$list[roll].passport_place}</td>
                <td>{$list[roll].identification_code}</td>
                <td>{$list[roll].address}</td>
                <td>{$list[roll].agreement_number}</td>
				<td>{$list[roll].agreement_date}</td>
                <td>{$list[roll].recipient}</td>
                <td>{$list[roll].mfo}</td>
                <td>{$list[roll].zkpo}</td>
                <td>{$list[roll].bank_account}</td>
                <td>{$list[roll].bank_reference}</td>
				
				<td>{$list[roll].skr}</td>
				<td>{$list[roll].cart_date}</td>
				<td>{$list[roll].bank_name}</td>
				
				
                <td>{$list[roll].director1}</td>
                <td>{$list[roll].director2}</td>
                <td>{$list[roll].ground_kasko_express}</td>
				<td>{$list[roll].ground_ns_express}</td>
				<td>{$list[roll].ground_ns_gl}</td>
				
				<td>{if $list[roll].ankets}так{else}ні{/if}</td>
				<td>{if $list[roll].seller}так{else}ні{/if}</td>
				<td>{if $list[roll].service}так{else}ні{/if}</td>
				<td>{if $list[roll].akt}так{else}ні{/if}</td>
				
                <td>{if $list[roll].active}так{else}ні{/if}</td>
            </tr>
            {/section}
        </table>
    </body>
</html>