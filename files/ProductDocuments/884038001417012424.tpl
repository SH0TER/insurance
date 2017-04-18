<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист погодження компромісу, Майно</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	<td width="50%">&nbsp;</td>
	<td width="327" style="line-height: 30px; font-size: 18px;">
		Директор <br/>
		ТДВ "Експрес Страхування"<br/>
		Щучьєва Т.А.<br/>
		Прийнято рішення по справі<br/>
		________________________________________<br/>
		________________________________________<br/>
		________________________________________<br/>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td></td>
	<td align="center"><h1 style="font-size: 18px;">ЛИСТ ПОГОДЖЕННЯ КОМПРОМІСУ</h1></td>
	<td></td>
</tr>
</table><br /><br />
<table cellspacing="5" cellpadding="5">
	<tr><td style="font-size: 18px;">Обставини пригоди: {$values.description}</tr></td>
</table>
<br /><br />
<table cellspacing="5" cellpadding="5">
	<tr><td style="font-size: 18px;">1. Номер справи: {$values.accidents_number}, договір № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</tr></td>
	<tr><td style="font-size: 18px;">2. Вигодонабувач: {if $values.financial_institutions_id > 0}{$values.policies_assured_title}{else}згідно з законодавством України{/if}</tr></td>
    {if $values.policies_insurer_person_types_id == 2}
        <tr><td style="font-size: 18px;">3. Тип об'єкту страхування: {$values.object_types_title}.</tr></td>
        <tr><td style="font-size: 18px;">4. Назва об'єкту страхування: {$values.property_objects_title}.</tr></td>
    {else}
        <tr><td style="font-size: 18px;">3. Об'єкт страхування: {$values.values_id_title}.</tr></td>
        <tr><td style="font-size: 18px;">4. Місце страхування: {$values.object_location}.</tr></td>
    {/if}
	<tr><td style="font-size: 18px;">5. Дата події: {$values.datetime_average|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</tr></td>
	<tr><td style="font-size: 18px;">6. Сума платежу по договору страхування: {$values.policy_payments_amount|moneyformat}</tr></td>
	<tr><td style="font-size: 18px;">7. Орієнтовна сума збитку: {$values.amount_rough|moneyformat}</tr></td>
	<tr><td style="font-size: 18px;">8. Наявність попередніх подій по даному договору: {if $values.policies_previous_accidents.accidents_list}{$values.policies_previous_accidents.accidents_list}{else}жодної{/if}.</tr></td>
	<tr><td style="font-size: 18px;">9. Сума виплачених відшкодувань по попередніх справах по даному договору: {$values.policies_previous_accidents.payments_amount|moneyformat}</tr></td>
	<tr><td style="font-size: 18px;">10. Наявність інших договорів страхування по даному клієнту: {if $values.all_policies_insurer.policies_list}{$values.all_policies_insurer.policies_list}{else}жодного{/if}.</tr></td>
	<tr><td style="font-size: 18px;">11. Сума платежів по інших договорах страхування по даному клієнту: {$values.all_policies_insurer.payments_amount|moneyformat}</tr></td>
	<tr><td style="font-size: 18px;">12. Сума виплачених відшкодувань по інших договорах страхування по даному клієнту: {$values.all_policies_insurer_accidents.payments_amount|moneyformat}</tr></td>
	<tr><td style="font-size: 18px;">13. Умови договору, що порушені: {$values.compromise_info.compromise_violation_list}.</tr></td>
	<tr><td style="font-size: 18px;">14. Франшиза: {$values.compromise_deductibles|moneyformat}</tr></td>
	<tr><td style="font-size: 18px;">15. Рішення по справі: ______________________________.</tr></td>
	<tr><td style="font-size: 18px;">16. Дата прийняття рішення: ______________________ р.</tr></td>
	<tr><td style="font-size: 18px;">17. Коментарій: {$values.compromise_comment}</tr></td>
</table>
<br/><br/><br/><br/>
<br/><br/><br/><br/>
<br/><br/><br/><br/>

<table width="100%" cellspacing="10" style="margin-top: 20px;">
<tr>
	<td width="33%" style="font-size: 18px;">Виконав</td>
	<td class="bottom" style="font-size: 18px;">&nbsp;</td>
	<td width="33%" align="right" style="font-size: 18px;">{$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.</td>
</tr>
</table>
</body>
</html>