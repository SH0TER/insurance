<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист-запит документів у страхувальника</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	<td align="right">
		<p>ТДВ "Експрес Страхування"</p>
		<p>01004, м. Київ, вул. Велика Васильківська, буд. 15/2</p>
		<p>Тел/факс: 594-87-00/02<p>
	</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 50px 0 100px 0;">
<tr>
	<td width="40%" valign="top" class="small">
		<p>Вих. № ___________________ від "____" __________ ______ р.</p><br />
		<p>Справа № {$values.accidents_number}</p>
	</td>
	<td width="60%" align="right" class="large">
		<p><b>{if $values.policies_insurer_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname|truncate:2:'':true}. {$values.policies_insurer_patronymicname|truncate:2:'':true}.{else}{$values.policies_insurer_company}{/if}</b></p>
		<p><b>{$values.policies_insurer_address}</b></p>
	</td>
</tr>
</table>
<br />
<p align="justify" style="text-indent: 1.5em"><i>Щодо розгляду справи</i></p>
<br /><br />
<p align="justify" style="text-indent: 1.5em">
	ТДВ "Експрес Страхування", розглянувши документи щодо здійснення страхового відшкодування у зв’язку з пошкодженням {$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р. внаслідок події, яка носить ознаки страхового випадку, 
	автомобіля {$values.policies_brand}/{$values.policies_model} {$values.policies_sign} (надалі – Автомобіль), застрахованого за договором добровільного страхування наземних транспортних засобів 
	{$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р. (надалі – Договір страхування), повідомляє наступне.
</p><br />
<p align="justify" style="text-indent: 1.5em">
    Відповідно до умов Договору добровільного страхування наземних транспортних засобів до ТДВ «Експрес Стрування» для подальшого розгляду справи просимо Вас надати наступні документи: 
</p><br />
{foreach name="roll" from=$values.documents item=document}
    {if $smarty.foreach.roll.last}
        <p align="justify" style="text-indent: 1.5em">
            - {$document}.
        </p><br />
    {else}
        <p align="justify" style="text-indent: 1.5em">
            - {$document};
        </p>
    {/if}
{/foreach}
<p align="justify" style="text-indent: 1.5em">
    Після отримання вищезазначених  документів, ТДВ "Експрес Страхування"  повернеться до розгляду даної справи про що Вас буде повідомлено додатково.
</p><br />

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
<tr>
	<td width="50%"><b>
		З повагою,<br />
		Заступник директора<br />
		ТДВ «Експрес Страхування»</b>
	</td>
	<td width="50%" align="right"><b>С.В. Залуцький</b></td>
</tr>
</table>
<br /><br /><br />
<div class="very_small i">
	Виконав: {$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.<br/>
</div>
</body>
</html>