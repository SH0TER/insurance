<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт, прийому-передачі бланків суворої звітності ОСЦПВ</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
        <h1>АКТ № {$values.number}</h1><br />
        <table cellspacing=0 cellpadding=0 width="100%">
        <tr>
	        <td align="center">
		        <h3>прийому-передачі бланків суворої звітності<br /><p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h3>
	        </td>
        </tr>
        </table>
    </td>
</tr>
</table>


<p><b>Товариство з додатковою відповідальністю "Експрес страхування"</b> (надалі - Довіритель), в особі  <!--Директора <!--<b>Щучьєвої Тетяни Андріївни</b>, яка діє на підставі Статуту-->начальника відділу обліку договорів  Карети Ірини Григорівни, яка діє на підставі Довіреності № 252/17 від 10.03.2017р., з однієї сторони, та
{if $values.director_fop_id>0}
<b>{$values.lastname} {$values.firstname} {$values.patronymicname}</b>, (надалі - Повірений), з іншої сторони, підписали цей Акт про те, що {if $values.types_id == 1}Довіритель передав, а Повірений прийняв{else}Повірений передав, а Довіритель прийняв{/if}:</p><br />
{else}
<b>{$values.title}</b>, в особі <b>{$values.director2}</b>, який діє на підставі {$values.ground_akt}, (надалі - Повірений), з іншої сторони, підписали цей Акт про те, що {if $values.types_id == 1}Довіритель передав, а Повірений прийняв{else}Повірений передав, а Довіритель прийняв{/if}:</p><br />
{/if}

<table border="1" cellspacing="0" cellpadding="5" width="100%">
<tr align="center">
	<td width="50" rowspan="2"><b>№ &nbsp;п/п</b></td>
	<td rowspan="2"><b>Вид бланку</b></td>
	<td rowspan="2"><b>Серія</b></td>
	<td colspan="2"><b>Номер полісу</b></td>
    <td rowspan=2><b>Статус</b></td>
	<td rowspan="2" width="100"><b>Кількість, шт.</b></td>
</tr>
<tr>
    <td align="center">з</td>
    <td align="center">по</td>
</tr>
<tr>
    <td align="center">1</td>
    <td>Поліс ОСЦПВ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
{assign var="total" value=0}
{section name="roll" loop=$list}
<tr>
    <td>&nbsp;</td>
	<td>1.{$smarty.section.roll.iteration}</td>
	<td>{$list[roll].series}</td>
    <td>{$list[roll].number_from}</td>
    <td>{$list[roll].number_to}</td>
    <td>{$list[roll].blank_statuses_title}</td>
    <td align="center">{$list[roll].count}</td>
    {assign var="total" value=$total+$list[roll].count}
</tr>
{/section}
<tr>
    <td colspan="6" align="right">Всього:</td>
    <td align="center">{$total}</td>
</tr>
<tr>
    <td align="center">2</td>
    <td>Стікер ОСЦПВ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
{section name="roll" loop=$list}
<tr>
    <td>&nbsp;</td>
	<td>2.{$smarty.section.roll.iteration}</td>
	<td>{$list[roll].series}</td>
    <td>{$list[roll].number_from}</td>
    <td>{$list[roll].number_to}</td>
    <td>{$list[roll].blank_statuses_title}</td>
    <td align="center">{$list[roll].count}</td>
</tr>
{/section}
<tr>
    <td colspan="6" align="right">Всього:</td>
    <td align="center">{$total}</td>
</tr>
<tr>
    <td colspan="6" align="right"><b>ВСЬОГО БЛАНКІВ:</b></td>
    <td align="center">{$total*2}</td>
</tr>
</table><br /><br />

<div align="center"><b>Підписи Сторін</b></div>

<table width="100%">
<tr>
	<td width="50%">
		<div align="center"><b>Від імені Довірителя</b></div><br />

		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул.. Велика Васильківська, 15/2<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»<br />
		МФО 300465, Код ЄДРПОУ 36086124<br /><br /><br /><br />
		_________________________________ / _________________
	</td>
	<td width="50%">
		<div align="center"><b>Від імені Повіреного</b></div><br />
        {if $values.director_fop_id>0}
            {$values.lastname} {$values.firstname} {$values.patronymicname}<br />
            Адреса реєстрації: {$values.address}<br />
            Паспорт: {$values.passport_series} №&nbsp; {$values.passport_number},<br />
            виданий {$values.passport_place} {$values.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
            Iдентифікаційний код {$values.identification_code}<br />
        {else}
		    {$values.title}<br />
		    Адреса: {$values.address}<br />
		    {$values.bank}<br />
		    Код ЄДРПОУ {$values.edrpou}<br />
            Р/р {$values.bank_account} МФО {$values.bank_mfo}
        {/if}
        <br /><br /><br /><br />
		_________________________________ / _________________
	</td>
</tr>
</table>


<div style="page-break-after: always"></div>
















<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
        <h1>АКТ </h1><br />
        <table cellspacing=0 cellpadding=0 width="100%">
        <tr>
	        <td align="center">
		        <h3>Інвентаризації бланків полісів ОСЦПВВНТЗ від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h3>
	        </td>
        </tr>
        </table>
    </td>
</tr>
</table>


<p><b>Інвентаризація проведена відповідно до пункту 2.2.14 до Договору доручення № {$values.agreement_number} від {$values.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
<br><br>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
<tr align="center">
	<td width="50" rowspan="2"><b>№ &nbsp;п/п</b></td>
	<td rowspan="2"><b>Вид бланку</b></td>
	<td rowspan="2"><b>Серія</b></td>
	<td colspan="2"><b>Номер полісу</b></td>
    <td rowspan=2><b>Статус</b></td>
	<td rowspan="2" width="100"><b>Кількість, шт.</b></td>
</tr>
<tr>
    <td align="center">з</td>
    <td align="center">по</td>
</tr>
<tr>
    <td align="center">1</td>
    <td>Поліс ОСЦПВ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
{assign var="total" value=0}
{section name="roll" loop=$invent_list}
<tr>
    <td>&nbsp;</td>
	<td>1.{$smarty.section.roll.iteration}</td>
	<td>{$invent_list[roll].series}</td>
    <td>{$invent_list[roll].number_from}</td>
    <td>{$invent_list[roll].number_to}</td>
    <td>{$invent_list[roll].blank_statuses_title}</td>
    <td align="center">{$invent_list[roll].count}</td>
    {assign var="total" value=$total+$invent_list[roll].count}
</tr>
{/section}
<tr>
    <td colspan="6" align="right">Всього:</td>
    <td align="center">{$total}</td>
</tr>
<tr>
    <td align="center">2</td>
    <td>Стікер ОСЦПВ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
{section name="roll" loop=$invent_list}
<tr>
    <td>&nbsp;</td>
	<td>2.{$smarty.section.roll.iteration}</td>
	<td>{$invent_list[roll].series}</td>
    <td>{$invent_list[roll].number_from}</td>
    <td>{$invent_list[roll].number_to}</td>
    <td>{$invent_list[roll].blank_statuses_title}</td>
    <td align="center">{$invent_list[roll].count}</td>
</tr>
{/section}
<tr>
    <td colspan="6" align="right">Всього:</td>
    <td align="center">{$total}</td>
</tr>
<tr>
    <td colspan="6" align="right"><b>ВСЬОГО БЛАНКІВ:</b></td>
    <td align="center">{$total*2}</td>
</tr>
</table><br /><br />

<p><b>Цим підписом підтверджую, що ознайомлений з обов’язками повіреного відповідно до умов Договору доручення № {$values.agreement_number} від {$values.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. <br>
Наслідками із наданням недостовірної інформації про результати продажів та несвоєчасним поданням звітності</b>

<br><br>
<div align="center"><b>Підписи Сторін</b></div>

<table width="100%">
<tr>
	<td width="50%">
		<div align="center"><b>Від імені Довірителя</b></div><br />

		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул.. Велика Васильківська, 15/2<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»<br />
		МФО 300465, Код ЄДРПОУ 36086124<br /><br /><br /><br />
		_________________________________ / _________________
	</td>
	<td width="50%">
		<div align="center"><b>Від імені Повіреного</b></div><br />
        {if $values.director_fop_id>0}
            {$values.lastname} {$values.firstname} {$values.patronymicname}<br />
            Адреса реєстрації: {$values.address}<br />
            Паспорт: {$values.passport_series} №&nbsp; {$values.passport_number},<br />
            виданий {$values.passport_place} {$values.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
            Iдентифікаційний код {$values.identification_code}<br />
        {else}
		    {$values.title}<br />
		    Адреса: {$values.address}<br />
		    {$values.bank}<br />
		    Код ЄДРПОУ {$values.edrpou}<br />
            Р/р {$values.bank_account} МФО {$values.bank_mfo}
        {/if}
        <br /><br /><br /><br />
		_________________________________ / _________________
	</td>
</tr>
</table>
</body>
</html>