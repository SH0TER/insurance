<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Страховой акт, Вантаж</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	{if $values.euassist == 1}
		<td width="227" id="company5"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	{else}
		<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	{/if}
	<td class="small">
		<p>бухгалтерії про сплату страхового відшкодування.</p>
		<p>Страхове відшкодування сплачено:</p>
		<p>Перераховане пл.дор. № _____ від "____" __________ ______ р.</p>
		<p>№ __________________________ від "____" __________ ______ р.</p>
	</td>
	<td align="right" valign="bottom" class="large">
		{if $values.euassist == 1}
			<p>"ЗАТВЕРДЖЕНО"<br />Генеральний директор ТОВ  «ЄвроАсистанс»</p><br />
			<p>Залуцький С.В.<br /><br />"___" __________ ______ р.</p>
		{else}
			<p>"ЗАТВЕРДЖЕНО"<br />Заступник директора ТДВ "Експрес Страхування"</p><br />
			<p>Залуцький С.В.<br /><br />"___" __________ ______ р.</p>
			<!--p>"ЗАТВЕРДЖЕНО"<br />Директор ТДВ "Експрес Страхування"</p><br />
			<p>Щучьєва Т. А.<br /><br />"___" __________ ______ р.</p-->
		{/if}
	</td>
</tr>
</table>
<h1>СТРАХОВИЙ АКТ № {$values.acts_number}</h1>
<h2>1. Вихідні дані</h2>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
	<td class="top right left">1.1.</td>
	<td class="top right">Cтраховик:</td>
	<td class="top right" colspan="3">ТДВ "Експрес Страхування"</td>
</tr>
<tr>
	<td class="top right bottom left">1.2.</td>
	<td class="top right bottom">Страхувальник:</td>
	<td class="top right bottom" colspan="3">{if $values.policies_insurer_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}{else}{$values.policies_insurer_company}{/if}</td>
</tr>
<tr>
	<td class="right bottom left">1.3.</td>
	<td class="right bottom">Вигодонабувач:</td>
	<td class="right bottom" colspan="3">{$values.assured}</tв>
</tr>
<tr>
    <td class="right bottom left">1.4.</td>
    <td class="right bottom">Об’єкт страхування:</td>
    <td class="right bottom" colspan="3">{if $values.policies_brands_id > 0}Автомобіль {$values.policies_brand} {$values.policies_model}, № шасі (кузов, рама) {$values.policies_shassi}{else}{$values.item_types_id_title[$values.item_types_id]}{/if}</td>
</tr>
<tr>
	<td class="right bottom left">1.5.</td>
	<td class="right bottom">Договір страхування:</td>
	{if $values.policies_product_types_id == 9}
		<td class="right bottom" colspan="3">Сертифікат № {$values.certificates_number} від {$values.certificates_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.; діє з {$values.certificates_begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.certificates_interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	{else}
		<td class="right bottom" colspan="3">Договір № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.; діє з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	{/if}
</tr>
<tr>
	<td class="right bottom left">1.6.</td>
	<td class="right bottom">Дата настання події:</td>
	<td class="right bottom">{$values.datetime_average|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td class="right bottom">Дата заяви про подію:</td>
	<td class="right bottom">{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
<tr>
	<td class="right bottom left">1.7.</td>
	<td class="right bottom">Чи заявлялося в органи ДАІ (міліцію), якщо ні то по якій причині:</td>
	<td class="right bottom" colspan="3">{if $values.accidents_cargo_mvs > 0}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td class="right bottom left">1.8.</td>
	<td class="right bottom">Опис обставин події:</td>
	<td class="right bottom" colspan="3">{$values.description_average}</td>
</tr>
<tr>
	<td class="right bottom left">1.9.</td>
	<td class="right bottom">Ризик:</td>
	<td class="right bottom">{$values.risks_title}</td>
	<td class="right bottom">Франшиза (безумовна):</td>
	<td class="right bottom">{$values.deductibles_amount|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">1.10.</td>
	<td class="right bottom">Страхова сума:</td>
	<td class="right bottom">{$values.policies_price}</td>
	<td class="right bottom">Ринкова сума:</td>
	<td class="right bottom">{$values.market_price|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">1.11.</td>
	<td class="right bottom">Попередні виплати за Договором/Сертифікатом:</td>
	<td class="right bottom" >{$values.amount_previous_accidents|moneyformat}</td>
	<td class="right bottom">Страхова сума на дату події:</td>
	<td class="right bottom">{$values.policies_price}</td>
</tr>
<tr>
	<td class="right bottom left">1.12.</td>
	<td class="right bottom">Кримінальна справа:</td>
	<td class="right bottom">{if $values.criminal == 0}не порушена{elseif $values.criminal == 1}порушена{else}призупинена{/if}</td>
	<td class="right bottom">Наявність підстав для регресного позову:</td>
	<td class="right bottom">{if $values.regres == 1}є{else}немає{/if}</td>
</tr>
</table>

<h2>2. Висновки</h2>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
	<td class="all">2.1.</td>
	<td class="top right bottom">Вказана пригода (є страховим випадком/не є страховим випадком):</td>
	<td class="top right bottom" colspan="3">Дослідження наявних документів дає підстави вважати дану пригоду {if $values.acts_insurance != 3}<b>страховим випадком</b> за ризиком {$values.risks_title}{else}<b>НЕ страховим випадком</b>{/if}</td>
</tr>
{if $values.acts_insurance == 1}
	{if $values.policies_brands_id > 0}
		<tr>
			<td class="right bottom left" rowspan="3">2.2.</td>
			<td class="right bottom" rowspan="3">Вартість відновлювального ремонту згідно {$values.payment_document_number}</td>
			<td class="right bottom">Сс = {$values.amount_details|moneyformat}</td>
<td class="right bottom" colspan=2 rowspan=3>Свр = {$values.amount_vr|moneyformat}</td>
		</tr>
		<tr>
			<td class="right bottom">См = {$values.amount_material|moneyformat}</td>
			
		</tr>
		<tr>
			<td class="right bottom">Ср = {$values.amount_work|moneyformat}</td>

		</tr>
	{else}
		<tr>
			<td class="right bottom left">2.2.</td>
			<td class="right bottom">Розмір матеріального збитку:</td>
			<td class="right bottom" colspan="3">{$values.amount_start|moneyformat}</td>
		</tr>
	{/if}
	<td class="right bottom left">2.3.</td>
	<td class="right bottom">Попередні виплати по справі:</td>
	<td class="right bottom" colspan="3">{$values.amount_previous_acts|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">2.4.</td>
	<td class="right bottom">Додаткові витрати:</td>
	<td class="right bottom">Вартість експертизи: {$values.amount_expertize|moneyformat}</td>
	<td class="right bottom">Інші витрати: {$values.amount_other|moneyformat}</td>
	<td class="right bottom">Евакуатор: {$values.amount_evacuate|moneyformat}</td>
</tr>
</tr>
<tr>
	<td class="right bottom left">2.5.</td>
	<td class="right bottom">На підставі умов Генерального Договору страхування вантажів № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.:</td>
	<td class="right bottom" colspan="3">
		{if $values.amount > 0}
            підлягає страхове відшкодування в розмірі
            {if $values.discount > 0}
                (
            {/if}
            {$values.amount_start|moneyformat:-1}
            {if $values.amount_previous_acts > 0}
                - {$values.amount_previous_acts|moneyformat:-1} (передплата)
            {/if}
            - {$values.deductibles_amount|moneyformat:-1}(франшиза)
            {if $values.discount > 0}
                )*(100 - {$values.discount})
            {/if}
            = <b>{$values.amount|moneyformat:-1}</b>
            ({$values.amount|moneyformat:1:true})
		{else}
			без виплати, франшиза більша збитку
		{/if}
	</td>
</tr>
{elseif $values.acts_insurance == 2}
<tr>
	<td class="right bottom left">2.2.</td>
	<td class="right bottom">На підставі умов Генерального Договору страхування вантажів № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.:</td>
	<td class="right bottom">без виплати, згідно {$values.reason}</td>
</tr>
{/if}
</table>

{foreach name="roll" from=$values.payments_calendar item=payment_calendar}
{if $smarty.foreach.roll.first}
<h2>3. Розпорядження про виплату страхового відшкодування</h2>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
	<td class="all" rowspan="2">3.{$smarty.foreach.roll.iteration}.</td>
	<td class="top right bottom">{$payment_calendar.basis}</td>
	<td class="top right bottom"><b>{$payment_calendar.amount|moneyformat:-1}</b> {$payment_calendar.amount|moneyformat:1:true}</td>
</tr>
<tr>
	<td class="right bottom" colspan="2">
		{if $payment_calendar.payment_bank_account != ''}p/p <b>{$payment_calendar.payment_bank_account}</b>;{/if}
		{if $payment_calendar.payment_bank != ''} {$payment_calendar.payment_bank};{/if}
		{if $payment_calendar.payment_bank_mfo != ''} МФО: <b>{$payment_calendar.payment_bank_mfo}</b>;{/if}
		{if $payment_calendar.payment_bank_card_number != ''} СКР: <b>{$payment_calendar.payment_bank_card_number}</b>;{/if}
		Отримувач: <b>{$payment_calendar.payment_recipient};</b> ІПН(ЄДРПОУ): <b>{$payment_calendar.payment_identification_code}</b>
	</td>
</tr>
{else}
<tr>
	<td class="left right bottom" rowspan="2">3.{$smarty.foreach.roll.iteration}.</td>
	<td class="right bottom">{$payment_calendar.basis}</td>
	<td class="right bottom"><b>{$payment_calendar.amount|moneyformat:-1}</b> {$payment_calendar.amount|moneyformat:1:true}</td>
</tr>
<tr>
	<td class="right bottom" colspan="2">
		{if $payment_calendar.payment_bank_account != ''}р/р <b>{$payment_calendar.payment_bank_account}</b>; {/if}
		{if $payment_calendar.payment_bank != ''}Банк: <b>{$payment_calendar.payment_bank}</b>; {/if}
		{if $payment_calendar.payment_bank_mfo != ''}МФО: <b>{$payment_calendar.payment_bank_mfo}</b>; {/if}
		{if $payment_calendar.payment_bank_card_number != ''}СКР: <b>{$payment_calendar.payment_bank_card_number}</b>; {/if}
		{if $payment_calendar.payment_recipient != ''}Отримувач: <b>{$payment_calendar.payment_recipient}</b>; {/if}
		{if $payment_calendar.payment_identification_code != ''}ІПН(ЄДРПОУ): <b>{$payment_calendar.payment_identification_code}</b> {/if}
	</td>
</tr>
{/if}
{if $smarty.foreach.roll.last}</table>{/if}
{/foreach}

{foreach name="roll" from=$values.documents item=document}
{if $smarty.foreach.roll.first}
<h2>{if $values.amount > 0}4{else}3{/if}. Перелік документів, використаних для складання акту</h2>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
	<td class="all">{if $values.amount > 0}4{else}3{/if}.{$smarty.foreach.roll.iteration}.</td>
	<td class="top right bottom">{$document}</td>
</tr>
{else}
<tr>
	<td class="right bottom left">{if $values.amount > 0}4{else}3{/if}.{$smarty.foreach.roll.iteration}.</td>
	<td class="right bottom">{$document}</td>
</tr>
{/if}
{if $smarty.foreach.roll.last}</table>{/if}
{/foreach}

<table width="100%" cellspacing="0" cellpadding="10" style="margin-top: 10px;">
{if $values.euassist == 1}
<tr>
	<td>Виконав</td>
	<td align="right">______________________________ {$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.</td>
</tr>
<tr>
	<td>
		Начальник Відділу врегулювання збитків за договорами КАСКО<br />
        та інших видів страхування.
	</td>
	<td align="right">______________________________ Власенко Г. М.</td>
</tr>
{else}
<tr>
	<!--td>
		Начальник відділу врегулювання збитків за договорами КАСКО та інших видів страхування<br />
		Департаменту врегулювання збитків та обслуговування клієнтів,<br />
		ТДВ "Експрес страхування"
	</td-->
	<td width="60%">&nbsp;</td>
	<td align="left">______________________________ </td>
</tr>
<tr>
	<td>Виконав</td>
	<td align="left">______________________________ {$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.</td>
</tr>
{/if}
<tr>
	<td>{$values.acts_created|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>&nbsp;</td>
</tr>
</table>
</body>
</html>