<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Лист</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
    <link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
{literal}
<style type="text/css">
    .header td {
        font-weight: bold;
        font-size: 18px;
        font-style: italic;
        padding-right: 100px;
    }

    .titleBlock {
        font-style: italic;
        font-weight: bold;
        text-decoration: underline;
    }
</style>
{/literal}
<body>
<table class="header">
    <tr>
        <td>Лист узгодження рішення по справі</td>
        <td>Справа № {$values.accidents_number}</td>
        <td>Класифікація справи: {$values.accident_sections_titles}</td>
		<td>Рішення</td>
    </tr>
</table>

<table width="120%" border="1">
    <tr>
        <td width="30%" style="vertical-align: top; border: solid;" >
            <table width="100%" border="0">
                <tr>
                    <td colspan="2" style="text-align: center;">Дані умов договору страхування</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">{$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
                </tr>
                <tr>
                    <td width="30%">Строк дії</td>
                    <td>{$values.policies_begin_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} по {$values.policies_end_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
                </tr>
                <tr>
                    <td width="30%">Страхувальник</td>
                    <td>{$values.insurer}</td>
                </tr>
                <tr>
                    <td width="30%">Вигодонабувач</td>
                    <td>{$values.assured_title}</td>
                </tr>
                <tr>
                    <td width="30%">Об'єкт страхування</td>
                    <td>{$values.item}</td>
                </tr>
                <tr>
                    <td width="30%">Д.Р.З / VIN</td>
                    <td>{$values.sign} / {$values.shassi}</td>
                </tr>
                <tr>
                    <td width="30%">Територія покриття</td>
                    <td>{$values.zones_id_titles}</td>
                </tr>
            </table>
        </td>
        <td width="30%" style="vertical-align: top; border: solid;">
            <table width="100%" border="0">
                <tr>
                    <td colspan="3" style="text-align: center;">{$values.products_title}</td>
                </tr>
                <tr>
                    <td width="30%">Статус страхувальника</td>
                    <td colspan="2">{$values.insurer_status_titles}</td>
                </tr>
                <tr>
                    <td>Страхова сума</td>
                    <td>{$values.insurance_price}</td>
                    <td>{$values.insurance_price_type}</td>
                </tr>
                <tr>
                    <td>Ринкова вартість</td>
                    <td colspan="2">{$values.market_price}</td>
                </tr>
                <tr>
                    <td>Страхова сума ДО</td>
                    <td colspan="2">{$values.amount_equipment}</td>
                </tr>
            </table>
        </td>
        <td style="vertical-align: top; border: solid;">
            <table width="100%" border="0">
                <tr>
                    <td colspan="5" style="text-align: center;">Історія страхування</td>
                </tr>
                <tr>
                    <td>Договір страхування</td>
                    <td>Дата договору страхування</td>
                    <td>Дата</td>
                    <td>Страхова премія</td>
                    <td>Сплачена страхова премія</td>
                </tr>
				{section name="roll" loop=$values.policies}
                    <tr>
                        <td>{$values.policies[roll].policies_number}</td>
						<td>{$values.policies[roll].policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
						<td>{$values.policies[roll].calendar_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
						<td>{$values.policies[roll].calendar_amount}</td>
						<td>{$values.policies[roll].payed_amount}</td>
                    </tr>
				{/section}
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border: solid;">
            <table cellpadding="5">
                <tr>
                    <td class="titleBlock">Додаткові опції ДС</td>
                    <td style="border: solid 2px;">без франшизи на вітрові стекла: {if $values.options_deductible_glass_no == 1}ТАК{else}ні{/if}</td>
                    <td style="border: solid 2px;">без врахування зносу: {if $values.options_deterioration_no == 1}ТАК{else}ні{/if}</td>
                    <td style="border: solid 2px;">неагрегатна страхова сума: {if $values.options_agregate_no == 1}ТАК{else}ні{/if}</td>
                    <td style="border: solid 2px;">50 на 50: {if $values.options_fifty_fifty == 1}ТАК{else}ні{/if}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="120%" border="1">
    <tr>
        <td width="70%">
            <table cellpadding="5" border=1>
                <tr>
                    <td style="background-color: #fffacd; font-weight: bold; font-style: italic;" nowrap>Дані стосовно події</td>
                    <td nowrap>Дата події</td>
                    <td style="font-weight: bold;">{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
                    <td nowrap>час</td>
                    <td style="font-weight: bold;">{$values.accidents_datetime|date_format:'%H:%M'}</td>
                </tr>
				<tr>
					<td style="font-style: italic; font-weight: bold; text-decoration: underline;">Місце події</td>
                    <td colspan="5" style="font-style: italic; font-weight: bold;">{$values.accidents_address}</td>
				</tr>
                <tr>
                    <td style="font-style: italic; font-weight: bold; text-decoration: underline;">Обставини події</td>
                    <td colspan="5" style="font-style: italic; font-weight: bold;">{$values.description_average}</td>
                </tr>
                <tr>
                    <td style="font-style: italic; font-weight: bold; text-decoration: underline;">Опис пошкоджень:</td>
                    <td colspan="5" style="font-style: italic; font-weight: bold;">{$values.damage}</td>
                </tr>
                <tr>
                    <td>Ризик:</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;">{$values.application_risks_title}</td>
                    <td>Франшиза</td>
                    <td style="font-weight: bold;">{$values.deductible_percent} %  =  {$values.insurance_price*$values.deductible_percent/100|round:"2"} грн.</td>
                    <td>Орієнтовний збиток</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;">{$values.amount_rough}</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-style: italic; font-weight: bold; text-decoration: underline;">Перевірка виконання умов договору страхування:</td>
                </tr>
                <tr>
                    <td>Повідомлення в ГЛ ЕС</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;">{$values.assistance}</td>
                    <td>Письмове повідомлення</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;">{$values.written_sign}</td>
                    <td>Компетентні органи</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;">{$values.mvs_sign}</td>
                </tr>
            </table>            
        </td>
        <td weight="30%" style="vertical-align: top;">
            <table>
				{section name="history" loop=$values.history}
					<tr>
						<td>{$values.history[history].created|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
						<td>{$values.history[history].description} {if $values.history[history].accident_statuses_id == 1}{$values.car_services_title}{/if}</td>
					</tr>
				{/section}
            </table>
            <table>
                <tr><td>Аварійний комісар</td><td>{$values.average_manager_name}</td></tr>
                <tr><td>Експерт</td><td>{$values.estimate_manager_name}</td></tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="1">
	<tr>
		<td colspan="13">Інші страхові випадки{if $values.accidents|@count > 0}&nbsp;{else} - відсутні{/if}</td>
	</tr>
	{if $values.accidents|@count > 0}
	<tr>
		<td>Справа</td>
		<td>Договір</td>
		<td>Дата події</td>
		<td>Пошкодження</td>
		<td>Компроміс</td>
		<td>Статус</td>
		<td>Номер акту</td>
		<td>Рішення</td>
		<td>Причина</td>
		<td>Сума</td>
		<td>Отримувач</td>
		<td>Дата</td>
		<td>Сума</td>
	</tr>
	{/if}
	
	{foreach from=$values.accidents item=accident}
		<tr>
			<td rowspan="{$accident.calendar_length}">{$accident.accidents_number}</td>
			<td rowspan="{$accident.calendar_length}">{$accident.policies_number}</td>
			<td rowspan="{$accident.calendar_length}">{$accident.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
			<td rowspan="{$accident.calendar_length}">{$accident.damage}</td>
			<td rowspan="{$accident.calendar_length}">{$accident.compromise_violation}</td>
			<td rowspan="{$accident.calendar_length}">{$accident.accident_statuses_title}</td>
			
			{assign var="act_count" value=0}
			
			{foreach from=$accident.acts item=act}
				{if $act_count > 0}<tr>{/if}
				<td rowspan="{$act.calendar|@count}">{$act.number}</td>
				<td rowspan="{$act.calendar|@count}">{$act.insurance}</td>
				<td rowspan="{$act.calendar|@count}">{$act.reason_not_payment}</td>
				<td rowspan="{$act.calendar|@count}">{$act.amount}</td>
				
				{assign var="calendar_count" value=0}
				
				{foreach from=$act.calendar item=payment}
					{if $calendar_count > 0}<tr>{/if}
					<td>{$payment.recipient}</td>
					<td>{$payment.payment_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
					<td>{$payment.amount}</td>
					{if $calendar_count > 0}</tr>{/if}
					{assign var="calendar_count" value=$calendar_count+1}
				{/foreach}
				
				{if $act_count > 0}</tr>{/if}
				{assign var="act_count" value=$act_count+1}
			{/foreach}

		</tr>
	{/foreach}
</table>

<table cellpadding="5">
    <tr>
        <td colspan="2" style="font-weight: bold; font-style: italic; text-decoration: underline;">РОЗМІР СТРАХОВОГО ВІДШКОДУВАННЯ</td>
        <td colspan="2">Страхова сума на дату події</td>
        <td colspan="2">{$values.insurance_price-$values.previous_accidents_amount|round:"2"}</td>
    </tr>
    <tr>
        <td>Ринкова вартість на дату події</td>
        <td>&nbsp;<b>{$values.messages[0].market_price}</b></td>
        <td>Коефіцієнт проп Кп</td>
        <td>&nbsp;{if $values.messages[0].market_price > 0}{$values.insurance_price/$values.messages[0].market_price-$values.previous_accidents_amount/$values.messages[0].market_price|round:"4"}{/if}</td>
        <td>Коефіцієнт фіз знос Ез</td>
        <td>&nbsp;{$values.messages[0].deterioration_value}</td>
    </tr>
</table><br/>

<table width="100%">
	{assign var="i" value=0}
	{section name="message" loop=$values.messages}		
		{if $i>0}
        <tr>
            <td width="30%">{$values.messages[message].title}</td>
            <td width="15%">Сс = {$values.messages[message].data.answer.amount_details}</td>
            <td width="15%">См = {$values.messages[message].data.answer.amount_material}</td>
            <td width="15%">Ср = {$values.messages[message].data.answer.amount_work}</td>
            <td width="15%">Свр = {$values.messages[message].data.answer.amount_details * (1 - $values.messages[message].data.answer.deterioration_value) + $values.messages[message].data.answer.amount_material + $values.messages[message].data.answer.amount_work}</td>
        </tr>
		{/if}
		{assign var="i" value=$i+1}
    {/section}
</table>

<table>
    <tr>
        <td>Порядок виплати страхового відшкодування - {$result_calculation_car_services_title}</td>
    </tr>
</table>
<table width="100%">
	<tr>
		<td class="bottom" width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%">&Delta; страхового платежу {$values.compromise_delta_premium} грн.</td>
	</tr>
	<tr>
		<td class="bottom" width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%">&Delta; страхового відшкодування {$values.compromise_delta_compensation} грн.</td>
	</tr>
	<tr>
		<td class="bottom" width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%">Умови договору, що порушені: {$values.compromise_violation_list}</td>
	</tr>
	<tr>
		<td width="40%">Начальник юридичного відділу</td>
		<td width="20%">&nbsp;</td>
		<td width="40%">Коментар: {$values.compromise_comment}</td>
	</tr>
	<tr>
		<td class="bottom" width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%"></td>
	</tr>
	<tr>
		<td class="bottom" width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%"></td>
	</tr>
	<tr>
		<td class="bottom" width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%"></td>
	</tr>
	<tr>
		<td width="40%">Начальник відділу врегулювання збитків</td>
		<td width="20%">&nbsp;</td>
		<td width="40%"></td>
	</tr>
</table>
<br/>
Виконав(-ла): {$values.average_manager_name}

</body>
</html>