<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на оплату справки ГАИ, КАСКО</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/events.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="right">
		<p>ТДВ "Експрес Страхування"</p>
		<p>01004, м. Київ, вул. Велика Васильківська, буд. 15/2</p>
		<p>Тел/факс: 206-88-69/70<p>
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
		<p>Скрипнику О.О.</p>
	</td>
</tr>
</table>

<h1>СЛУЖБОВА ЗАПИСКА</h1>
<h2>на оплату справки ДАІ по справі № {$values.number}</h2><br /><br /><br />

<p>Прошу оплатити справку ДАІ по договору КАСКО № {$values.policiesNumber} від {$values.policiesDate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. в розмірі:</p>
<p>&nbsp;</p>
<p><b>{$values.extra_chargesAmount|moneyformat} ({$values.extra_chargesAmount|moneyformat:1:true})</b></p>
<p>&nbsp;</p>
<p>згідно <b>{$values.extra_chargesBasis}</b> за такими реквизитами:</p><br />

<ul>
	<li>р/р {$values.extra_chargesBankAccount}</li>
	<li>в {$values.extra_chargesBank}</li>
	<li>МФО {$values.extra_chargesBankMFO}</li>
	<li>Код ЄДРПОУ {$values.extra_chargesIdentificationCode}</li>
	<li>Одержувач – {$values.extra_chargesRecipient}.</li>
</ul>

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
<tr>
	<td width="50%">
		З повагою,<br />
		начальник відділу відшкодування збитків
	</td>
	<td width="50%" align="right">Бондарчук А.В.</td>
</tr>
</table>
</body>
</html>