<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт, КАСКО, юр. лицо</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.akt}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/debt.gif)"{/if} {if $values.payed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/payed.gif)"{/if}>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center"><h1>АКТ виконаних послуг</h1></td>
	<td align="right">
		<p>№ {$values.aktnumber}</p>
		<p>від {$values.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>
{if $values.akt}
	{if $values.policies.0.agencies_id==20}
		<p>Ми, що нижче підписалися, Товариство з додатковою відповідальністю "Експрес страхування" (надалі-Страховик), в особі Директора <b>Скрипника Олександра Олексійовича</b>, який діє на підставі Статуту, з однієї сторони, та АКЦІОНЕРНЕ ТОВАРИСТВО "УКРАЇНСЬКА АВТОМОБІЛЬНА КОРПОРАЦІЯ" в особі Директора Козюби Павла Петровича філії "АВТОЦЕНТР НА КІЛЬЦЕВІЙ", який діє на підставі 49/д, (надалі - Агент), з іншої сторони, склали Акт про те, що за {$values.aktdate}р. Агентом відповідно до умов Агентського договору № {$values.agreement_number} від {$values.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. наданi послуги в наступному обсязі:</p><br />
	{else}
		<p>Ми, що нижче підписалися, Товариство з додатковою відповідальністю "Експрес страхування" (надалі-Страховик), в особі Директора <b>Скрипника Олександра Олексійовича</b>, який діє на підставі Статуту, з однієї сторони, та <b>{if $values.aktnumber == '87/д.02.10'}Філія "Автоцентр на Борщагівці" АТ "Українська Автомобільна Корпорація"{else}{$values.title}{/if}</b>, в особі <b>{$values.director2}</b>, який діє на підставі {$values.ground_akt}, (надалі - Агент), з іншої сторони, склали Акт про те, що за {$values.aktdate}р. Агентом відповідно до умов  Агентського договору № {$values.agreement_number} від {$values.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. наданi послуги в наступному обсязі:</p><br />
	{/if}
	<p>Здійснення послуг по укладанню наступних договорів Страхування:</p><br />
{else}
	<h1>ЗАБОРГОВАНIСТЬ ЗА АКТОМ</h1>
{/if}
<table border=1 cellspacing=0 cellpadding=5 width="100%" align="center">
<tr>
	<td width="50"><b>№ &nbsp;п/п</b></td>
	<td><b>Серія, номер договору страхування</b></td>
	<td><b>Дата договору страхування</b></td>
	<td><b>ПIБ страхувальник</b>а</td>
	<td><b>Страхова премія, грн.</b></td>
	<td><b>Страховий платіж, грн.</b></td>
	<td><b>% вiд страхового платежу</b></td>
	<td><b>Агенська винагорода, грн.</b></td>
</tr>
{assign var="total" value=0}
{section name="roll" loop=$policies}
<tr>
	<td align="center">{$smarty.section.roll.iteration}</td>
	<td>{$policies[roll].number}</td>
	<td>{$policies[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$policies[roll].insurer}</td>
	<td>{$policies[roll].amount|moneyformat:-1}</td>
	<td>{$policies[roll].amountPaid|moneyformat:-1}</td>
	<td>{$policies[roll].commission_agency_percent|moneyformat:-1}</td>
	<td>{$policies[roll].commission_agency_amount|moneyformat:-1}</td>
</tr>
{assign var="total" value=$total+$policies[roll].commission_agency_amount}
{/section}
<tr>
	<td colspan="7" align="right">РАЗОМ</td>
	<td>{$total|moneyformat:-1}</td>
</tr>
</table><br /><br />

{if $values.akt}
<p>{if $values.id == 37}Страхові агентські послуги згідно Агентського договору складають{else}Агентська винагорода згідно Агентського договору складає{/if} {$total|moneyformat:-1} грн. ({$total|moneyformat:1:true})</p>

<h2>РАЗОМ ПО АКТУ</h2>
<p>Загальна {if $values.id == 37}сума страхових агентських послуг{else}агентська винагорода{/if} по акту складає {$total|moneyformat:-1} грн. ({$total|moneyformat:1:true})</p>
<p>Загальна сума до перерахування Агенту по акту складає {$total|moneyformat:-1} грн.</p>
<p>Акт набирає чинності з моменту його підписання і є невід'ємною частиною Агентського договору  №&nbsp;{$values.agreement_number} від {$values.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
<p>Акт складений у двох примірниках, кожний із який має однакову юридичну чинність.</p><br /><br />

<table width="100%">
<tr>
	<td width="50%">
		<div align="center"><b>СТРАХОВИК</b></div><br />

		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул.. Велика Васильківська, 15/2<br />
		Р/р 265000464000 в АТ "БрокБізнесБанк" м. Києва<br />
		МФО 300249, Код ЄДРПОУ 36086124<br /><br /><br />
		Директор Скрипник О.О.________________________
	</td>
	<td width="50%">
		<div align="center"><b>АГЕНТ</b></div><br />
		
		{if $policies.0.agencies_id==20}
		АКЦІОНЕРНЕ ТОВАРИСТВО "УКРАЇНСЬКА АВТОМОБІЛЬНА КОРПОРАЦІЯ"<br />
		ФІЛІЯ "АВТОЦЕНТР НА КІЛЬЦЕВІЙ"<br />
		Адреса: {$values.address}<br />
		{$values.bank}<br />
		Код ЄДРПОУ:{$values.edrpou}<br /><br /><br />
		{$values.director1} __________________
		{else}
		{$values.title} <br />
		Адреса: {$values.address}<br />
		{$values.bank}<br />
		Код ЄДРПОУ:{$values.edrpou}<br /><br /><br />
		{$values.director1} __________________
		{/if}
	</td>
</tr>
</table>
{/if}
</body>
</html>