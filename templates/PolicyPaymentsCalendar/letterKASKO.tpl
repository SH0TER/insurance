<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>KASKO. Letter. EI</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 18px;
			font-family: Arial, Geneva, Helvetica, sans-serif;
		}
		TH {
			background-color: #eeeeee;
		}

        P {
            font-size: 18px;
        }

        HR {
            height: 2px;
            color: #000000;
            background-color: black;
            border: 0px;
        }
	</style>
	{/literal}
</head>
<body {if $values.payed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/payed.gif)"{/if}>
<br><br>
<br><br><br><br>
<br>

<p align="center"><b>Шановний (-на) {$values.insurer_firstname} {$values.insurer_patronymicname}!</b></p>
<br/><br/><br/>
<p style="text-indent: 2em;">Страхова компанія ТДВ «Експрес Страхування» щиро вдячна Вам за вибір нашої компанії при страхуванні Вашого автомобіля {$values.brand} {$values.model}, д.н. {$values.sign}.</p><br />
<p style="text-indent: 2em;">Ми пропонуємо Вам надійність та впевненість у страховому захисті Вашого автомобіля та гарантуємо своєчасне врегулювання страхових випадків.</p><br />
<p style="text-indent: 2em;">Між Вами та ТДВ «Експрес Страхування» укладено договір страхування. Термін сплати чергового страхового платежу в розмірі - {$values.bill_amount|moneyformat:-1} грн. до {$values.policy_payments_calendar_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p><br />
<p style="text-indent: 2em;">Для належного виконання своїх обов'язків за договором № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р., Вам необхідно сплатити рахунок, який є частиною даного листа, в будь-якому відділенні банківської установи.</p><br />
<p style="text-indent: 2em;">За умови оплати рахунку до {$values.policy_payments_calendar_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. строк дії договору страхування № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. вважається продовженим на термін з {$values.policy_payments_calendar_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.policy_payments_calendar_end_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p><br />
<p style="text-indent: 2em;">Рахунок з відміткою банку про сплату або квитанцію необхідно зберегти з договором страхування.</p><br />
<p style="text-indent: 2em;"><b>УВАГА! Страхова компанія ТДВ «Експрес Страхування» інформує Вас  і звертає увагу на зміну  реквізитів компанії, за якими Ви здійснюєте оплату страхових платежів:<br />
Р/р 26507620526463 в ПАТ "Промінвестбанк", МФО 300012, Код ЄДРПОУ 36086124</b></p><br />
<p style="text-indent: 2em;">При виникненні будь-яких питань, Вас проконсультують спеціалісти нашої компанії за тел. <b>(044) 594-87-00</b>.</p>
<br/><br/><br/><br/><br/><br/>
<table width="100%">
<tr>
    <td>З повагою,<br /><br />Директор<br />ТДВ «Експрес Страхування»</td>
    <td align="right">Т. А. Щучьєва</td>
</tr>
</table>
<br/><br/><br/><hr/><br/><br/><br/>
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		Товариство з додатковою відповідальністю<br />
		«ЕКСПРЕС СТРАХУВАННЯ»<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
        Р/р 26507620526463 в ПАТ "Промінвестбанк",<br />
		МФО 300012, Код ЄДРПОУ 36086124
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
	<td>{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer}{/if}</td>
</tr>
</table><br />

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
		<b>Рахунок-фактура № &nbsp; {$values.bill_number}<br />
		від {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b>
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
	<td align=right>{$values.bill_amount|moneyformat:-1}</td>
</tr>
</table><br /><br />

Всього на суму: {$values.bill_amount|moneyformat:1:true}<br /><br />
Без ПДВ: {$values.bill_amount|moneyformat:1:true}<br /><br />
<div style="font-weight: bold; font-size: 24px; margin-top: 50px;">при наборі платежу, будь ласка , ставте відповідні розділові знаки!!!!</div>
</body>
</html>