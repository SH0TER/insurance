<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на проведення автотоварознавчого дослідження, КАСКО</title>
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
    <td><b>Проведення автотоварознавчого дослідження</b></td>
</tr>
</table><br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td>Необходні дані:</td>
</tr>
</table><br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td>Дані учасників:</td>
</tr>
<tr>
	<td>1. Страхувальник: {$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}, {$values.policies_insurer_address}</td>
</tr>
<tr>
	<td>2. Представник страхувальника: {$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname}, {$values.applicant_address}</td>
</tr>
{foreach name="roll" from=$values.question.participant item=participant}
<tr>
	<td>{$smarty.foreach.roll.iteration+2}. Винна сторона: {$participant}</td>
</tr>
{/foreach}
<tr>
    <td><b>Коментар:</b></td>
</tr>
<tr>
    <td>{$values.question.comment_question}</td>
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
	<td align="left">{$values.recipient.lastname} {$values.recipient.firstname|truncate:2:'':true}. {$values.recipient.patronymicname|truncate:2:'':true}</td>
</tr>
</table>
</body>
</html>