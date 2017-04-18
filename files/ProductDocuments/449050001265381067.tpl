﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на оплату евакуатора, КАСКО/ГО</title>
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
	<td width="50%" valign="top" class="small">
		<p>Вих. № __________________________________</p><br />
		<p>№ ___________ від "____" __________ ______ р.</p>
	</td>
	<td width="50%" align="right" class="large">
		<p>Директору</p>
		<p>ТДВ "Експрес Страхування"</p>
		<p>Щучьєвій Т. А.</p>
	</td>
</tr>
</table>

<h1>СЛУЖБОВА ЗАПИСКА</h1>
<h2>на оплату послуг евакуатора по справі № {$values.accidents_number}</h2><br /><br /><br />

<p>Прошу оплатити послуги евакуатора по договору {if $values.product_types_id==4}ЦВ{else}КАСКО{/if} № {$values.policies_number} № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. в розмірі:</p>
<p>&nbsp;</p>
<p><b>{$values.payments_calendar_amount|moneyformat} ({$values.payments_calendar_amount|moneyformat:1:true})</b></p>
<p>&nbsp;</p>
<p>згідно <b>{$values.payments_calendar_basis}</b> за такими реквизитами:</p><br />

<ul>
	<li>р/р {$values.payments_calendar_payment_bank_account}</li>
	<li>в {$values.payments_calendar_payment_bank}</li>
	<li>МФО {$values.payments_calendar_payment_bank_mfo}</li>
	<li>Код ЄДРПОУ {$values.payments_calendar_recipient_identification_code}</li>
	<li>Одержувач – {$values.payments_calendar_recipient}.</li>
</ul>

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
<tr>
	<td width="33%">
		Заступник Директора департаменту врегулювання збитків та обслуговування клієнтів,<br />
		ТДВ "Експрес страхування"
	</td>
	<td class="bottom">&nbsp;</td>
	<td width="33%" align="right">Петренко Д. М.</td>
</tr>
</table>
</body>
</html>