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
                <td>Назва</td>
                <td>Область</td>
				<td>Адреса</td>
				<td>ЄДРПОУ</td>
				<td>Розрахунковий рахунок</td>
				<td>Банк</td>
				<td>МФО</td>
				<td>Корпорація "УкрАВТО"</td>
                <td>Активний</td>
            </tr>
            {/literal}
            {section name="roll" loop=$list}
            <tr>
                <td x:str>{$list[roll].code}</td>
                <td>{$list[roll].title}</td>
                <td>{$list[roll].regionsTitle}</td>
                <td>{$list[roll].address}</td>
                <td x:str>{$list[roll].edrpou}</td>
                <td x:str>{$list[roll].bank_account}</td>
				<td>{$list[roll].bank}</td>
				<td x:str>{$list[roll].bank_mfo}</td>
                <td>{if $list[roll].ukravto}так{else}ні{/if}</td>
                <td>{if $list[roll].active}так{else}ні{/if}</td>
            </tr>
            {/section}
        </table>
    </body>
</html>