<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист страхувальнику про тотал</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
    {literal}
	<style type="text/css">
        P {
            text-indent: 2em;
            text-align: justify;
        }
	</style>
	{/literal}
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="30%" >
            <img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /><br/>
            <br/>
            Вих. № _____________________ <br/><br/>
            від __________________ {$smarty.now|date_format:"%Y"}р.<br/><br/>
            Справа № {$values.accidents_number}
        </td>
        <td width="70%" valign="top">
            ТДВ «Експрес Страхування»<br/>
            01004, Київ, Україна<br/>
            вул. Велика Васильківська 15/2<br/>
            Телефон: +38 (044) 594-87-00, факс: +38 (044) 594-87-02<br/>
        </td>
    </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="60%"></td>
        <td width="40%">
            <b>
                {if $values.policies_insurer_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname|truncate:2:'':true}. {$values.policies_insurer_patronymicname|truncate:2:'':true}.{/if}
                {if $values.policies_insurer_person_types_id == 2}{$values.policies_insurer_company}{/if}
            </b><br/>
            {$values.param1}, {if $values.policies_insurer_area != ''}{$values.policies_insurer_area}, {/if}{$values.policies_insurer_city},<br/>
            {if $values.policies_insurer_street_types != ''}{$values.policies_insurer_street_types} {/if}{$values.policies_insurer_street}{if $values.policies_insurer_house != ''}, буд. {$values.policies_insurer_house}{/if}{if $values.policies_insurer_flat != ''}, кв. {$values.policies_insurer_flat}{/if}
        </td>
    </tr>
</table>
<br/>
<br/>
<br/>
Щодо розгляду страхової події
<br/>
<br/>
<br/>
<h1 align="center">Шановний страхувальнику!</h1><br/>
<p>Повідомляємо, що відповідно до умов укладеного з Вами договору страхування № {$values.policies_number}  від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.,
автомобіль {$values.policies_brand} {$values.policies_model}, д.р.н. {$values.policies_sign} вважається конструктивно знищеним, у зв’язку з чим з суми страхового відшкодування вираховується
вартість «залишків» транспортного засобу у пошкодженому стані.
<p>Вартість Автомобіля у пошкодженому стані визначена виходячи з реального ринкового попиту на них та найвищої пропозиції, розміщеної в системі «AUTOonline» і становить {$values.amount_residual|moneyformat}.
<p>На підтвердження реальності ринкового попиту на пошкоджений автомобіль {$values.policies_brand} {$values.policies_model}, д.р.н. {$values.policies_sign} нижче надаємо координати особи,
що підтвердила намір придбати автомобіль за суму не нижче, ніж в пропозиції системи «AUTOonline».</p>
<p>{$values.param2}
<p>При цьому звертаємо увагу, що інформація про пошкоджений автомобіль та його власника згаданій особі страховиком не повідомлялась, і у разі бажання скористатись найвищою ринковою
пропозицією на залишки транспортного засобу Ви маєте право та змогу самостійно зателефонувати за вказаними вище координатами.
<p>Враховуючи викладене, повідомляємо Вам про те, що страхове відшкодування в розмірі {$values.param3}.
<p>Крім того повідомляємо Вам, що розрахунок страхового відшкодування є остаточним та в подальшому перегляду не підлягає.
<br/>
<br/>
<table width="100%">
    <tr>
        <td><b>З повагою,<br /><br />Директор ТДВ «Експрес Страхування»</b></td>
        <td align="right"><b>Т.А. Щучьєва</b></td>
    </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
Виконав: {$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.
</body>
</html>