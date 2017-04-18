<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на огляд ТЗ, ОСЦПВ</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table cellspacing="0" cellpadding="5">
<tr>
    <td><b>Номер справи:</b></td>
    <td>{$values.accidents_number}</td>
    {if $values.question.owner_types_id == 1}
        <td><b>Автомобіль:</b></td>
        <td>{$values.insurer_brand} {$values.insurer_model}</td>
        <td><b>Д.Р.З.:</b></td>
        <td>{$values.insurer_sign}</td>
    {else}
        <td><b>Автомобіль:</b></td>
        <td>{$values.owner_brand} {$values.owner_model}</td>
        <td><b>Д.Р.З.:</b></td>
        <td>{$values.owner_sign}</td>
    {/if}
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td><b>Огляд ТЗ</b><br/>Необходні дані:</td>
</tr>
</table><br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td width="25%" align="right"><b>Тип особи:</b></td>
    <td>{if $values.question.owner_types_id == 1}Страхувальник{else}Потерпілий{/if}</td>
</tr>
<tr>
	<td width="25%" align="right"><b>Місце знаходження ТЗ:</b></td>
	<td>{$values.question.car_address}</td>
</tr>
<tr>
	<td width="25%" align="right"><b>Контактна особа:</b>
	<td>{$values.question.car_contact}</td>
</tr>
<tr>
	<td width="25%" align="right"><b>тел:</b></td>
	<td>{$values.question.car_phone}</td>
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
</table><br />

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
	<td align="left"><!--{$values.expert_managers_lastname} {$values.expert_managers_firstname|truncate:2:'':true}. {$values.expert_managers_patronymicname|truncate:2:'':true}--></td>
</tr>
</table>
</body>
</html>