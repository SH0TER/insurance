<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на розрахунок вартості відновлювального ремонту</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table cellspacing="0" cellpadding="5">
<tr>
    <td><b>Відповідальний аварійний комісар:</b></td>
    <td>{$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}</td>
</tr>
</table><br />

<table cellspacing="0" cellpadding="5">
<tr>
    <td><b>Справа №:</b></td>
    <td>{$values.accidents_number}</td>
    <td><b>Категорія:</b></td>
    <td>{$values.sections_title}</td>
    <td><b>Страхувальник:</b></td>
    <td colspan="2">{if $values.policies_insurer_company}{$values.policies_insurer_company}, {/if}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}</td>
</tr>
</table><br />

<table cellspacing="0" cellpadding="5">
<tr>
    <td><b>Автомобіль:</b></td>
    <td>{$values.policies_brand} {$values.policies_model}</td>
    <td><b>Д.Р.З.:</b></td>
    <td>{$values.policies_sign}</td>
    <td><b>Страхова сума:</b></td>
    <td>{$values.policies_price|moneyformat:-1}</td>
    <td><b>Франшиза:</b></td>
    <td>{$values.deductibles_percent}%</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td>Розрахунок суми страхового відшкодування. Необходні дані:</td>
</tr>
</table><br />
<table cellspacing="0" cellpadding="5">
<tr>
	<td><b>Провести огляд автомобіля:</b></td>
	{if $values.question.car_review == 0}
		<td>Ні</td>
	{else}
		<td>Так</td>
	{/if}
</tr>
</table>
{if $values.question.car_review == 1}
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td width="10%"><b>за адресою:</b></td>
	<td>{$values.question.car_address}</td>
	<td width="15%"><b>Контактна особа:</b>
	<td>{$values.question.car_contact}</td>
	<td width="5%"><b>тел:</b></td>
	<td>{$values.question.car_phone}</td>
</tr>
</table><br />
{/if}
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td align="right"><b>Виконати:</b></td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td align="right">1.</td>
	<td colspan="2">Разрахунок ПК "АУДАТЕКС"</td>
	<td align="center">{if $values.question.perform_audatex == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">2.</td>
	<td colspan="2">Розрахунок фізичного зносу, згідно методики</td>
	<td align="center">{if $values.question.perform_deterioration_method == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">3.</td>
	<td colspan="2">Розрахунок фізичного зносу, згідно умов договору страхування</td>
	<td align="center">{if $values.question.perform_deterioration_agreement == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">4.</td>
	<td colspan="2">Розрахунок вартості транспортного засобу на момент страхування</td>
	<td align="center">{if $values.question.perform_car_price == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">5.</td>
	<td colspan="2">Розрахунок вартості пошкодженого транспортного засобу</td>
	<td align="center">{if $values.question.perform_car_price_damaged == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">6.</td>
	<td colspan="2">Визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline</td>
	<td align="center">{if $values.question.perform_car_price_damaged_auction == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">7.</td>
	<td colspan="2">Провести товарознавчу експертизу</td>
	<td align="center">{if $values.question.perform_check_research == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right"><b>Узгодити:</b></td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td align="right">8.</td>
	<td>Рахунок з СТО: {$values.question.calculation_car_services_title}</td>
	<td></td>
	<td align="center">{if $values.question.calculation_car_services_title}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td align="right">9.</td>
	<td>Протокол огляду</td>
	<td>&nbsp;</td>
	<td align="center">{if $values.question.report_survey == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">10.</td>
	<td>Фото пошкодженого автомобіля</td>
	<td>&nbsp;</td>
	<td align="center">{if $values.question.car_photo == 0}Ні{else}Так{/if}</td>
</tr>
</tr>
	<td align="right">11.</td>
	<td colspan="2">Узгодити висновок експерта</td>
	<td align="center">{if $values.question.conclusion_expert == 0}Ні{else}Так{/if}</td>
</tr>
<tr>
	<td align="right">12.</td>
	<td colspan="2">Попередні справи: {section name="roll" loop=$values.accidents}{$values.accidents[roll].number}; {sectionelse}немає{/section}</td>
</tr>
<tr>
    <td align="right"><b>Коментар:</b></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td align="right"></td>
    <td>{$values.question.comment_question}</td>
    <td></td>
    <td align="center"></td>
</tr>

</table><br /><br /><br />

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td width="60%">Дата: {$values.question.created|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
    <td width="20%">&nbsp;</td>
	<td align="left">{$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}</td>
</tr>
<tr><td>&nbsp;<td></tr>
 <tr>
	<td>Дата: __________</td>
    <td>&nbsp;</td>
	<td align="left">{$values.expert_managers_lastname} {$values.expert_managers_firstname|truncate:2:'':true}. {$values.expert_managers_patronymicname|truncate:2:'':true}</td>
</tr>
</table>
</body>
</html>