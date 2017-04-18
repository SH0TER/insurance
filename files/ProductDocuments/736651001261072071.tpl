<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Страховой акт, ЦВ</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	{if $values.euassist == 1 && $values.acts_id != 11062}
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
		{if $values.director == 1}
			<p>"ЗАТВЕРДЖЕНО"<br />Директор ТДВ "Експрес Страхування"</p><br />
			<p>Щучьєва Т. А.<br /><br />"___" __________ ______ р.</p>
		{else}
			<p>"ЗАТВЕРДЖЕНО"<br />Заступник директора ТДВ "Експрес Страхування"</p><br />
			<p>Залуцький С.В.<br /><br />"___" __________ ______ р.</p>			
		{/if}
	</td>
</tr>
</table>
<h1>СТРАХОВИЙ АКТ № {$values.acts_number}</h1>
<h2>1. Вихідні дані</h2>
<table width="100%" cellspacing="0" cellpadding="3">
{if $values.euassist == 1}
<tr>
	<td class="top right left">1.1.</td>
	<td class="top right">Cтраховик:</td>
	<td class="top right" colspan="3">ТДВ "Експрес Страхування"</td>
</tr>
{/if}
<tr>
	<td class="top right bottom left">{if $values.euassist == 1}1.2.{else}1.1.{/if}</td>
	<td class="top right bottom">Страхувальник:</td>
	<td class="top right bottom" colspan="3">{if $values.policies_person_types_id == 1}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}{else}{$values.policies_insurer_lastname}{/if}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.3.{else}1.2.{/if}</td>
	<td class="right bottom">Потерпіла сторона:</td>
	<td class="right bottom" colspan="3">{$values.owner_lastname} {$values.owner_firstname} {$values.owner_patronymicname}; ІПН(ЄДРПОУ) {$values.owner_identification_code}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.4.{else}1.3.{/if}</td>
	<td class="right bottom">Забезпечений ТЗ:</td>
	<td class="right bottom" colspan="3">Автомобіль {$values.insurer_brand} {$values.insurer_model}{if $values.insurer_sign}, д.н. {$values.insurer_sign}{/if}{if $values.insurer_shassi}, № шасі (кузов, рама) {$values.insurer_shassi}{/if}</td>
</tr>
<tr>
    <td class="right bottom left">{if $values.euassist == 1}1.5.{else}1.4.{/if}</td>
    <td class="right bottom">Пошкоджене майно потерпілого:</td>
    <td class="right bottom" colspan="3">
		{if $values.property_types_id == 1}
			Автомобіль {$values.owner_brand} {$values.owner_model}{if $values.owner_sign}, д.н. {$values.owner_sign}{/if}{if $values.owner_shassi}, № шасі (кузов, рама) {$values.owner_shassi}{/if}
		{elseif $values.property_types_id == 2}
			{$values.property}
		{/if}
	</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.6.{else}1.5.{/if}</td>
	<td class="right bottom">Договір(Поліс) страхування:</td>
	<td class="right bottom" colspan="3">№ {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.; діє з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.7.{else}1.6.{/if}</td>
	<td class="right bottom">Дата настання події:</td>
	<td class="right bottom">{$values.datetime_average|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td class="right bottom">Дата заяви про подію:</td>
	<td class="right bottom">{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.8.{else}1.7.{/if}</td>
	<td class="right bottom">Чи заявлялося в органи ДАІ (міліцію), якщо ні то по якій причині:</td>
	<td class="right bottom" colspan="3">{if $values.mvs_title_average}Так, {$values.mvs_title_average}{else}Ні{/if}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.9.{else}1.8.{/if}</td>
	<td class="right bottom">Опис обставин події:</td>
	<td class="right bottom" colspan="3">{$values.description_average}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.10.{else}1.9.{/if}</td>
	<td class="right bottom">Завдано шкоду:</td>
	<td class="right bottom">{if $values.risks_id == 1}Майну{else}Здоров'ю{/if}</td>
	<td class="right bottom">Франшиза (безумовна):</td>
	<td class="right bottom">{$values.deductible|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.11.{else}1.10.{/if}</td>
	<td class="right bottom">Ліміт відповідальності:</td>
	<td class="right bottom">{if $values.accidents_go_mvs != 4 && $values.risks_id == 1}100 000{elseif $values.accidents_go_mvs != 4 && $values.risks_id == 2}100 000{else}100 000{/if} грн.</td>
    <td class="right bottom">Ринкова вартість</td>
    <td class="right bottom">{$values.market_price|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.12.{else}1.11.{/if}</td>
	<td class="right bottom">Попередні виплати за договором(Полісом):</td>
	<td class="right bottom" colspan="4">{$values.amount_previous_accidents|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">{if $values.euassist == 1}1.13.{else}1.12.{/if}</td>
	<td class="right bottom">Наявність підстав для регресного позову:</td>
	<td class="right bottom" colspan="4">{if $values.regres == 1}є{else}немає{/if}</td>
</tr>
</table>

<h2>2. Висновки</h2>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
	<td class="all">2.1.</td>
	<td class="top right bottom">Вказана пригода (є страховим випадком/не є страховим випадком):</td>
	<td class="top right bottom" colspan="2">Дослідження наявних документів дає підстави вважати дану пригоду {if $values.acts_insurance != 3}<b>страховим випадком</b> за ризиком <b>{$values.risks_title}</b>{else}<b>НЕ страховим випадком</b> згідно {$values.reason}{/if}</td>
</tr>
{if $values.acts_insurance == 1}
<tr>
	<td class="right bottom left">2.2.</td>
	<td class="right bottom">Без врахування фізичного зносу:</td>
	<td class="right bottom">{if $values.policies_options_deterioration_no == 1}Так{else}Ні{/if}</td>
	<td class="right bottom">Ез = {$values.deterioration_value}</td>
</tr>
<tr>
	<td class="right bottom left" rowspan="3">2.3.</td>
	<td class="right bottom" rowspan="3">Вартість відновлювального ремонту згідно {$values.payment_document_number}</td> <!--від {$values.payment_document_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.:</td-->
	<td class="right bottom">Сс = {$values.amount_details|moneyformat}</td>
	<td class="right bottom">Ссз = {$values.amount_sz|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom">См = {$values.amount_material|moneyformat}</td>
	<td class="right bottom">Свр = {$values.amount_vr|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom">Ср = {$values.amount_work|moneyformat}</td>
	<td class="right bottom">Сврз = {$values.amount_vrz|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">2.4.</td>
	<td class="right bottom">Попередні виплати по справі:</td>
	<td class="right bottom" colspan="2">{$values.amount_previous_acts|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">2.5.</td>
	<td class="right bottom">Додаткові витрати:</td>
	<td class="right bottom">Вартість експертизи: {$values.amount_expertize|moneyformat}</td>
	<td class="right bottom">Вартість транспортування: {$values.amount_evacuate|moneyformat}</td>
</tr>
<tr>
	<td class="right bottom left">2.6.</td>
	<td class="right bottom">На підставі умов Полісу обов'язкового страхування цивільно-правової відповідальності наземних транспортних засобів № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.:</td>
	<td class="right bottom" colspan="2">
		{if $values.calc_info}
            {$values.calc_info} ({$values.amount|moneyformat:1:true})
        {else}
			{if $values.amount > 0}
				{if $values.accidents_go_mvs == 1 && $values.risks_id == 1 && $values.total_amount > 50000}
					підлягає страхове відшкодування в розмірі: 50 000 - {$values.deductibles_amount} = <b>{$values.amount|moneyformat:-1}</b> ({$values.amount|moneyformat:1:true})
				{elseif $values.accidents_go_mvs == 1 && $values.risks_id == 2 && $values.total_amount > 100000}
					підлягає страхове відшкодування в розмірі: 100 000 - {$values.deductibles_amount} = <b>{$values.amount|moneyformat:-1}</b> ({$values.amount|moneyformat:1:true})
				{elseif $values.accidents_go_mvs == 2 && $values.risks_id == 2 && $values.total_amount > 25000}
					підлягає страхове відшкодування в розмірі: 50 000 - {$values.deductibles_amount} = <b>{$values.amount|moneyformat:-1}</b> ({$values.amount|moneyformat:1:true})
				{elseif $values.amount_vr >= $values.market_price}
					підлягає страхове відшкодування в розмірі {$values.market_price|moneyformat:-1} - {$values.deductibles_amount|moneyformat:-1}(франшиза){if $values.amount_residual > 0} - {$values.amount_residual}(залишки){/if}{if $values.discount > 0} - {$values.amount_discount}(знижка){/if}{if $values.amount_compensation > 0} + {$values.amount_compensation|moneyformat:-1} (евакуатор){/if} = <b>{$values.amount|moneyformat:-1}</b> ({$values.amount|moneyformat:1:true})
				{else}
					підлягає страхове відшкодування в розмірі {$values.amount_details|moneyformat:-1} * (1 - {$values.deterioration_value}) + {$values.amount_material|moneyformat:-1} + {$values.amount_work|moneyformat:-1} {if $values.amount_previous_acts > 0 && $values.act_type == 1}- {$values.amount_previous_acts|moneyformat:-1}(передплата){/if} - {$values.deductibles_amount|moneyformat:-1}(франшиза){if $values.amount_compensation > 0} + {$values.amount_compensation|moneyformat:-1} (евакуатор){/if} = <b>{$values.amount|moneyformat:-1}</b> ({$values.amount|moneyformat:1:true})
				{/if}
			{else}
				без виплати, франшиза більша збитку
			{/if}
		{/if}
	</td>
</tr>
{elseif $values.acts_insurance == 2}
<tr>
	<td class="right bottom left">2.2.</td>
	<td class="right bottom">На підставі умов Договору(Полісу) обов'язкового страхування цивільно-правової відповідальності наземних транспортних засобів № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.:</td>
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
{if $values.euassist == 1 && $values.acts_id != 11062}
<tr>
	<td>Виконав</td>
	<td align="right">________________________________ {$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.</td>
</tr>
<tr>
	<td>
        Начальник відділу врегулювання збитків за договорами ОСЦПВВНТЗ<br />
    </td>
	<td align="right">________________________________ Дерлеменко В.Г.</td>
</tr>
{if $values.change01022014 != 1}
<tr>
	<td>
        Начальник УВКіД<br />
    </td>
	<td align="right">________________________________ Петроє К.І.</td>
</tr>
{/if}
{else}
<tr>
	<!--td>
		Начальник відділу врегулювання збитків<br />
		за договорами КАСКО та інших видів страхування<br />
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