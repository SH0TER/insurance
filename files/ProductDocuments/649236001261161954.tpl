<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на оплату страхового відшкодування, КАСКО</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
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
<h2>по страховому акту № {$values.acts_number}</h2><br /><br /><br />
{if $values.rest_amount > 0}<p>Прошу страхове відшкодування, в розмірі <b>{if $values.rest_amount > $values.amount}{$values.amount|moneyformat} ({$values.amount|moneyformat:1:true}){else}{$values.rest_amount|moneyformat} ({$values.rest_amount|moneyformat:1:true}){/if}</b> зарахувати згідно договору страхування № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. в якості оплати страхового платежу по вказаному договору.</p><br />{/if}

{assign var=amount value=$values.amount-$values.rest_amount}

{if $values.payments_calendar_amount > 0}
<p>Прошу страхове відшкодування, в розмірі <b>{$values.payments_calendar_amount|moneyformat} ({$values.payments_calendar_amount|moneyformat:1:true})</b> виплатити згідно Договору страхування № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p><br />
<ul>
	<li>р/р {$values.payments_calendar_payment_bank_account}</li>
	<li>в {$values.payments_calendar_payment_bank}</li>
	<li>МФО {$values.payments_calendar_payment_bank_mfo}</li>
	<li>Код ЄДРПОУ(ІПН) {if $values.recipient_types_id == 1 && $values.payments_calendar_payment_bank_card_number}{$values.recipient_bank_edrpou}{else}{$values.payments_calendar_recipient_identification_code}{/if}</li>
	<li>Одержувач: {if $values.payments_calendar_payment_bank_card_number}{$values.payments_calendar_payment_bank}{else}{$values.payments_calendar_recipient}{/if}</li>
    <li>{if $values.payments_calendar_payment_bank_card_number}СКР: {$values.payments_calendar_payment_bank_card_number}{/if}</li>
</ul>
<br />
<p><b>Призначення платежу:</b> Страхове вiдшкодування згiдно договору страхування № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.;
<!-- физ лицу -->
{if $values.recipient_types_id==1} {if $values.policies_insurer_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}{else}{$values.policies_insurer_company}{/if}; ІПН: {$values.policies_insurer_identification_code} {if $values.recipient_card_number}; СКР:{$values.recipient_card_number}{/if}{ /if}
<!-- СТО -->
{if $values.recipient_types_id==2} {if $values.policies_insurer_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}{else}{$values.policies_insurer_company}{/if}; та згiдно {$values.payment_document_number} вiд {$values.payment_document_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{/if}
<!-- Банк -->
{if $values.recipient_types_id==3} {if $values.policies_insurer_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}{else}{$values.policies_insurer_company}{/if}; ІПН: {$values.policies_insurer_identification_code}; Без ПДВ{/if}
</p>
{/if}
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
<tr>
	<td width="50%">
		З повагою,<br />
		начальник відділу відшкодування збитків
	</td>
	<td width="50%" align="right">______________________</td>
</tr>
</table>
</body>
</html>