<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на проведення автотоварознавчого дослідження, ОСЦПВ</title>
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
    <td><b>Потерпілий:</b></td>
    <td colspan="2">{if $values.owner_person_types_id == 2}{$values.owner_lastname} {/if}{$values.owner_lastname} {$values.owner_firstname} {$values.owner_patronymicname} {if $values.owner_phone}, тел. {$values.owner_phone}{/if}</td>
</tr>
</table><br />

<table cellspacing="0" cellpadding="5">
<tr>
    <td><b>Автомобіль:</b></td>
    <td>{$values.owner_brand} {$values.owner_model}</td>
    <td><b>Д.Р.З.:</b></td>
    <td>{$values.owner_sign}</td>
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
	<td>1. Потерпілий: {if $values.owner_person_types_id == 2}{$values.owner_lastname} {/if}{$values.owner_lastname} {$values.owner_firstname} {$values.owner_patronymicname}, {$values.owner_address}</td>
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