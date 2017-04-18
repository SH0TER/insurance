<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист Дельтабанк,Кредобанк</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<br><br><br><br><br>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 50px 0 20px 0;">
<tr>
	<td width="50%" valign="top" class="small">
		<p>Вих. № __________________________________</p><br />
		від "____" __________ ______ р.</p>
	</td>
</tr>
</table>
<br><br>
<table cellspacing=0 cellpadding=0 width="100%"  style="margin-top: 10px">
<tr>
	<td width="220">
	<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
	</td>
	<td align="center" width="220">
 		&nbsp;
	</td>
	<td width="220" align="right" style="padding-right:20px">
	{if $values.financial_institutions_id==59}
		<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/delta-bank.jpg" width="105" height="105" />
	{/if}
	{if $values.financial_institutions_id==55}
		<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo_kredo.gif" width="269" height="69" />
	{/if}
	{if $values.financial_institutions_id==25}
		<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/idea-bank-logo.jpg" width="185" height="108" />
	{/if}	 
	</td>
</tr>
</table>
<br><br>
<p align="center"><b  style="font-size:18px;">Шановний (-а), {$values.insurer_firstname}  {$values.insurer_patronymicname}!</b></p>
<br/>
<p style="text-indent: 2em;font-size:18px; text-align: justify;">
	Товариство з додатковою відповідальністю «Експрес Страхування» щиро вдячне Вам за вибір нашої Компанії при страхуванні Вашого автомобіля.
</p>
<br/>

<p style="text-indent: 2em;font-size:18px; text-align: justify;">
Повідомляємо Вам, що ТДВ «Експрес Страхування» є акредитованою страховою компанією в    
{if $values.financial_institutions_id==59}
ПАТ «Дельта Банк».
{/if}
{if $values.financial_institutions_id==55}
ПАТ «Кредо Банк».
{/if}
{if $values.financial_institutions_id==25}
ПАТ «Ідея Банк».
{/if}
</p>
<br/>

<p style="text-indent: 2em;font-size:18px; text-align: justify;">
Ми пропонуємо Вам надійність та впевненість у страховому захисті Вашого транспортного засобу та гарантуємо своєчасне врегулювання страхових випадків.
</p>
<br/>

<p style="text-indent: 2em;font-size:18px; text-align: justify;">
<b>Нагадуємо Вам, що Договір добровільного страхування  наземних транспортних засобів   № {$values.parent.number}  (далі – Договір страхування) закінчує свою дію  {$values.endPaymentDate|date_format:$smarty.const.DATE_FORMAT_SMARTY} року.</b>
</p>
<br/>
<p style="text-indent: 2em;font-size:18px; text-align: justify;">
Враховуючи позитивний досвід нашої співпраці, <b>пропонуємо Вам подовжити дію договору страхування на <u>СПЕЦІАЛЬНИХ</u> умовах.</b>
</p>
<!--<br/>

<table width=100% cellpadding=2 cellspacing=2 border=1>
<tr>
<td align=center style="font-size:18px;"><b>Розрахункова ринкова вартість транспортного засобу</b></td>
<td align=center style="font-size:18px;" ><b>Тариф страхування</b></td>
<td align=center style="font-size:18px;" ><b>Страховий платіж <br> за 6 міс.</b></td>
<td align=center  style="font-size:18px;"><b>Страховий платіж <br>за  12 міс.</b></td>
</tr>
 
<tr>
<td align=center style="font-size:18px;">{$values.market_price|moneyformat}</td>
<td align=center style="font-size:18px;"><b>{$values.rate_kasko}%</b></td>
<td align=center style="font-size:18px;"><b>{$values.payment6month|moneyformat}</b></td>
<td align=center style="font-size:18px;">{$values.payment12month|moneyformat}</td>
</tr>

</table>

<br><br><br>
<p style="text-indent: 2em;font-size:18px; text-align: justify;">
<b style="font-size:18px;">Просимо Вас обрати зручний варіант платежу (на 6 або 12 міс.) та своєчасно подовжити дію Договору страхування, а саме сплатити обраний страховий платіж у термін до {$values.endPaymentDate|date_format:$smarty.const.DATE_FORMAT_SMARTY} року., щоб запобігти порушенню умов кредитної угоди.</b>
За умов вибору оплати страхового платежу за 6 місяців, Ваш черговий страховий платіж (за наступні 6 місяців)  складатиме - {$values.payment6month2|moneyformat} 
</p>
<br/>-->

<br/>
<br/>
<p style="text-indent: 2em;font-size:18px; text-align: justify;">
<b>Детальну інформацію</b>, щодо СПЕЦІАЛЬНИХ умов страхування на новий термін дії договору страхування
<b>можливо отримати у Вашого персонального менеджера нашої страхової компанії 
–  {$values.lastname} {$values.firstname} {if $values.patronymicname}{$values.patronymicname}{/if}, тел. {$values.agentphone}. </b>
</p>
<br/>
<p style="text-indent: 2em;font-size:18px; text-align: justify;">
Дякуємо за співпрацю!
</p>
<br>
<br><br>










 
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="50%">
		<b style="font-size:18px;">З повагою до Вас,</b><br><br><br>
	</td>
	<td width="50%" align="right"> &nbsp;</td>
</tr>
<tr>
	<td width="50%">
		<b><b style="font-size:18px;">ТДВ «Експрес Страхування»</b></b>
	</td>
	<td width="50%"  >&nbsp;</td>
</tr>
</table>






<!--
<div style="page-break-after: always"></div>
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		Товариство з додатковою відповідальністю<br />
		«ЕКСПРЕС СТРАХУВАННЯ»<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»,<br />
		МФО 300465, Код ЄДРПОУ 36086124
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Одержувач:</b></td>
	<td>той самий</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Платник:</b></td>
	<td>{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer_company}{/if}</td>
</tr>
</table> 

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
		<b>Рахунок-фактура № &nbsp; {$values.number}/1<br />
		від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b>
	</td>
</tr>
</table>

<table width=99% cellpadding=5 cellspacing=0 border=1>
<tr>
	<th>Товар</th>
	<th width=100>&nbsp;</th>
	<th width=120>Сума, грн.</th>
</tr>
<tr>
	<td>
		{$values.number},
		{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}.{$values.insurer_patronymicname|truncate:2:'':true}.{else}{$values.insurer}{/if},
		{if $values.insurer_person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if},
		{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}
		Страховий платіж згідно договору(полісу) без ПДВ
	</td>
	<td>БЕЗ ПДВ</td>
	<td align=right>{$values.payment6month|moneyformat:-1}</td>
</tr>
</table> 

Всього на суму: {$values.payment6month|moneyformat:1:true}<br />
Без ПДВ: {$values.payment6month|moneyformat:1:true}<br /><br />
Строк сплати страхового платежу до (включно): {$values.payment6monthdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}<br /><br />
<table width=300 cellpadding=0 cellspacing=0 style="margin-top: 10px;">
<tr>
	<td align=left>Виписав(ла):</td>
</tr>
</table>
<div style="font-weight: bold; font-size: 20px; margin-top: 20px;">при наборі платежу, будь ласка , ставте відповідні розділові знаки!!!!</div>


<br><br>
<hr>

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		Товариство з додатковою відповідальністю<br />
		«ЕКСПРЕС СТРАХУВАННЯ»<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»,<br />
		МФО 300465, Код ЄДРПОУ 36086124
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Одержувач:</b></td>
	<td>той самий</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Платник:</b></td>
	<td>{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer_company}{/if}</td>
</tr>
</table> 

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
		<b>Рахунок-фактура № &nbsp; {$values.number}/1<br />
		від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b>
	</td>
</tr>
</table>

<table width=99% cellpadding=5 cellspacing=0 border=1>
<tr>
	<th>Товар</th>
	<th width=100>&nbsp;</th>
	<th width=120>Сума, грн.</th>
</tr>
<tr>
	<td>
		{$values.number},
		{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}.{$values.insurer_patronymicname|truncate:2:'':true}.{else}{$values.insurer}{/if},
		{if $values.insurer_person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if},
		{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}
		Страховий платіж згідно договору(полісу) без ПДВ
	</td>
	<td>БЕЗ ПДВ</td>
	<td align=right>{$values.payment6month2|moneyformat:-1}</td>
</tr>
</table> 

Всього на суму: {$values.payment6month2|moneyformat:1:true}<br />
Без ПДВ: {$values.payment6month2|moneyformat:1:true}<br /><br />
Строк сплати страхового платежу до (включно): {$values.payment6monthdate2|date_format:$smarty.const.DATE_FORMAT_SMARTY}<br /><br />
<table width=300 cellpadding=0 cellspacing=0 style="margin-top: 10px;">
<tr>
	<td align=left>Виписав(ла):</td>
</tr>
</table>
<div style="font-weight: bold; font-size: 20px; margin-top: 20px;">при наборі платежу, будь ласка , ставте відповідні розділові знаки!!!!</div>


 
<hr>
 
<br><br>
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		Товариство з додатковою відповідальністю<br />
		«ЕКСПРЕС СТРАХУВАННЯ»<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»,<br />
		МФО 300465, Код ЄДРПОУ 36086124
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Одержувач:</b></td>
	<td>той самий</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Платник:</b></td>
	<td>{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer_company}{/if}</td>
</tr>
</table> 

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
		<b>Рахунок-фактура № &nbsp; {$values.number}/1<br />
		від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b>
	</td>
</tr>
</table>

<table width=99% cellpadding=5 cellspacing=0 border=1>
<tr>
	<th>Товар</th>
	<th width=100>&nbsp;</th>
	<th width=120>Сума, грн.</th>
</tr>
<tr>
	<td>
		{$values.number},
		{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}.{$values.insurer_patronymicname|truncate:2:'':true}.{else}{$values.insurer}{/if},
		{if $values.insurer_person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if},
		{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}
		Страховий платіж згідно договору(полісу) без ПДВ
	</td>
	<td>БЕЗ ПДВ</td>
	<td align=right>{$values.payment12month|moneyformat:-1}</td>
</tr>
</table> 

Всього на суму: {$values.payment12month|moneyformat:1:true}<br />
Без ПДВ: {$values.payment12month|moneyformat:1:true}<br /><br />
Строк сплати страхового платежу до (включно): {$values.payment6monthdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}<br /><br />
<table width=300 cellpadding=0 cellspacing=0 style="margin-top: 10px;">
<tr>
	<td align=left>Виписав(ла):</td>
</tr>
</table>
<div style="font-weight: bold; font-size: 20px; margin-top: 20px;">при наборі платежу, будь ласка , ставте відповідні розділові знаки!!!!</div>
-->

</body>
</html>