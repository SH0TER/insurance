<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Запит до суду</title>
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
		<p>Вих. № ___________________ від "____" __________ ______ р.</p><br />
		<p>Справа № {$values.accidents_number}</p>
	</td>
	<td width="50%" align="right" class="large">
		<p><b>{$values.question.courts_title}</b></p>
		<p><b>{$values.question.courts_address}</b></p>
	</td>
</tr>
</table>
<br />
<h1>Запит</h1>
<br /><br />
<p align="justify" style="text-indent: 1.5em">
{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р., за адресою {$values.address}, трапилась дорожньо-транспортна пригода за участю забезпеченого транспортного засобу {$values.insurer_brand}/{$values.insurer_model}, 
д.р.н. {$values.insurer_sign}, яким керував {$values.insurer_driver_lastname} {$values.insurer_driver_firstname} {$values.insurer_driver_patronymicname}, цивільно-правову відповідальність якого застраховано відповідно до полісу {$values.policies_number} 
від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.
</p><br />
<p align="justify" style="text-indent: 1.5em">
Згідно з довідкою {$values.mvs_title}, особою винною в настанні вищезазначеної дорожньо-транспортної пригоди є {$values.insurer_driver_lastname} {$values.insurer_driver_firstname} {$values.insurer_driver_patronymicname}, про що було складено протокол 
про адміністративне правопорушення відповідно дост. 124 КУпАП та направлено для прийняття рішення про притягнення до адміністративної відповідальності в {$values.question.courts_title}, {$values.question.courts_address}.
</p><br />
<p align="justify" style="text-indent: 1.5em">
В зв’язку з необхідністю вирішення питання про виплату страхового відшкодування та відповідно до ст. 25 Закону України «Про страхування» та ст. 33-1.2 Закону України «Про обов’язкове страхування цивільно-правової відповідальності власників наземних 
транспортних засобів» ТДВ «Експрес Страхування» просить, після прийняття рішення, направити на нашу адресу копію постанови про притягнення до адміністративної відповідальності особи, винної в настанні вищезазначеної дорожньо-транспортної пригоди.
</p><br />
<p>
Заздалегідь вдячні за співпрацю.
</p>
<br />
Додаток<br />
-	копія полісу {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р. – 1 арк.

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
	Виконав: {$values.authors_lastname} {$values.authors_firstname|truncate:2:'':true}.<br/>
</div>
</body>
</html>