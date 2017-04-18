<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Лист</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
    <link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td width="30%" style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo_express_transparent.gif) no-repeat 0 0;"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
        <td width="30%">&nbsp;</td>
        <td align="left" valign="bottom" class="large" style="font-size: 22px;">
            <p><b><i>Директору ТДВ «Експрес Страхування»</i></b></p>
            <p><b><i>Щучьєвій Т. А.</i></b></p>
        </td>
    </tr>
</table>

<table width="100%" cellspacing="0" cellpadding="3">
    <tr>
        <td width="30%"></td>
        <td width="30%">&nbsp;</td>
        <td style="vertical-align: top;">
            <table width="100%">
                <tr>
                    <td class="bottom">&nbsp;</td>
                </tr>
                <tr>
                    <td class="sub">(П.І.Б заявника)</td>
                </tr>
                <tr>
                    <td class="bottom">&nbsp;</td>
                </tr>
                <tr>
                    <td class="sub">(адреса заявника)</td>
                </tr>
                <tr>
                    <td class="bottom">&nbsp;</td>
                </tr>
                <tr>
                    <td class="sub">(телефон заявника)</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<p align="center" style="font-size: 24px; font-weight: bold; font-style: italic; line-height: 28px;">Заява</p>
<br/><br/><br/>
<p style="text-indent: 2em; text-align: justify; font-weight: bold; font-style: italic; font-size: 22px; line-height: 30px;">
    По події що трапилась {$values.datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. з автомобілем {$values.item} д/н {$values.sign} застрахованого за договором № {$values.policies_number}
    від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. прошу виплатити страхове відшкодування
    {if $data.payment_type == 1}
        згідно погодженої калькуляції за вирахуванням безумовної франшизи в розмірі {$values.deductible} грн.</p>
        <table width="66%" cellpadding="5">
            <tr>
                <td width="15" style="font-weight: bold; font-style: italic; font-size: 22px;">р/р</td><td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td width="15" style="font-weight: bold; font-style: italic; font-size: 22px;">в</td><td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td width="15" style="font-weight: bold; font-style: italic; font-size: 22px;">МФО</td><td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td width="15" style="font-weight: bold; font-style: italic; font-size: 22px;">код</td><td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td width="15" style="font-weight: bold; font-style: italic; font-size: 22px;">отримувач</td><td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td width="15" style="font-weight: bold; font-style: italic; font-size: 22px;">СКР</td><td class="bottom">&nbsp;</td>
            </tr>
        </table>
    {elseif $data.payment_type == 2}
        для відновлення автомобіля на розрахунковий рахунок СТО {$values.car_services_title}, ЄДРПОУ {$values.car_services_edrpou}.</p>
        <p style="text-indent: 2em; text-align: justify; font-weight: bold; font-style: italic; font-size: 22px; line-height: 30px;">
            За вирахуванням безумовної франшизи в розмірі {$values.deductible} грн.
        </p>
    {elseif $data.payment_type == 3}
        в якості погашення кредитної заборгованності на вказані реквізити вигодонабувача</p>
        <table width="100%" cellpadding="5">
            <tr>
                <td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td class="bottom">&nbsp;</td>
            </tr>
            <tr>
                <td class="bottom">&nbsp;</td>
            </tr>
        </table>
        <p style="text-indent: 2em; text-align: justify; font-weight: bold; font-style: italic; font-size: 22px; line-height: 30px;">
            За вирахуванням безумовної франшизи в розмірі {$values.deductible} грн.
        </p>
    {/if}


<br/><br/><br/><br/>
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td width="50%" style="font-weight: bold; font-style: italic; font-size: 22px; line-height: 26px;">
            "____" ________________ 20____ року.
        </td>
        <td width="10%" class="bottom">&nbsp;</td>
        <td width="5%" ></td>
        <td align="right">/</td>
        <td width="25%" class="bottom">&nbsp;</td>
        <td width="5%" >/</td>
    </tr>
    <tr>
        <td width="50%">&nbsp;</td>
        <td width="10%" class="sub">(підпис)</td>
        <td width="5%" ></td>
        <td></td>
        <td width="25%" class="sub">(ПІБ)</td>
        <td></td>
    </tr>
</table>
</body>
</html>