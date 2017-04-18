<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title> Повідомлення про виплату страхового відшкодування</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	
{literal}
<style>
*, P {
	font-size: 20px;
	line-height: 20px;
	text-align:justify;
}
H1 {
	font-size: 26px;
	font-weight: bold;
	text-align: center;
}
H2 {
	font-size: 24px;
	font-weight: bold;
	text-align: center;
}
.small P, .small {
	font-size: 16px;
	line-height: 20px;
}
.large P, .large {
	font-size: 26px;
}
.very_small P, .very_small {
	font-size: 6px;
}
</style>
{/literal}	
	
</head>
<body>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td width=50%>
	<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
	</td>
	<td width=50%>
		<b>ТДВ «Експрес Страхування»<br />
		01004, Київ, Україна<br />
		вул. Велика Васильківська 15/2<br />
		Телефон: +38 (044) 594-87-00, факс: +38 (044) 594-87-02</b>
	</td>
</tr>
</table><br />
Вих. № ____________ від "____" _____________		.<br /><br />
Справа № {$values.accidents_number}

<table>
	<tr>
		<td width=60%></td>
		<td>
			<p style="text-align: left;">{if $values.owner_person_types_id == 1}{$values.owner_lastname} {$values.owner_firstname|truncate:2:'':true}. {$values.owner_patronymicname|truncate:2:'':true}.{else}{$values.owner_lastname}{/if}</p><br />
			<p style="text-align: left;">{if $values.owner_zip_code}{$values.owner_zip_code}, {/if}{$values.owner_address}</p>
		</td>
	<tr>
</table>

{assign var="payment_amount" value=`$values.total_amount-$values.deductibles_amount`}

<br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br />
<h2>Повідомлення</h2></p>
<br /><br />
<p style="text-indent: 2em; text-align: justify; line-height: 120%">
	Цим листом ТДВ «Експрес Страхування» інформує, що за заявленою Вами подією, а саме – дорожньо-транспортною пригодою, яка сталась {$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} за участю автомобіля {$values.owner_brand} {$values.owner_model}, д/н {$values.owner_sign} прийнято рішення щодо сплати страхового відшкодування за вирахуванням безумовної франшизи {$values.deductibles_amount} грн., передбаченої Полісом страхування {$values.policies_number}, та встановлено у сумі {$values.amount} грн., яке буде перераховано на вказані Вами реквізити, найближчим часом.
</p><br /><br />

{if $values.deductibles_amount > 0}
	<p style="text-indent: 2em; text-align: justify; line-height: 120%">
		Крім того, відповідно до пункту 6 статті 36 Закону України «Про обов'язкове страхування цивільно-правової відповідальності власників наземних транспортних засобів» Страхувальником або особою, відповідальною за завдані збитки, має бути компенсована сума франшизи, якщо вона була передбачена договором страхування.
	</p>
{/if}
<br /><br /><br /><br /><br /><br />
<table width="100%">
<tr>
	<td width="75%" align="left">
		{if $values.director == 1}
			<p><b style="line-height: 120%">З повагою,<br />
				Директор<br />
				ТДВ «Експрес Страхування»</b></p>
		{else}		
			<p><b style="line-height: 120%">З повагою,<br />
				Заступник Директора<br />
				ТДВ «Експрес Страхування»</b></p>
		{/if}
	</td>
	<td width="25%" align="right">		
		{if $values.director == 1}
			<p><b>Т.А. Щучьєва<p><b>
		{else}		
			<p><b>С.В. Залуцький</b></p>
		{/if}
	</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
	<tr>
		<td>
			<p class="very_small">
				<i>Вик.: {$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.</i><br/>
			</p>
		</td>
		<td></td>
	</tr>
</table>
</body>
</html>