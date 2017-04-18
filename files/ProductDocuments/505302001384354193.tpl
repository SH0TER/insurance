<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Службова записка на визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline</title>
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
	{if $values.product_types_id == 3}
		<td><b>Категорія:</b></td>
		<td>{$values.sections_title}</td>
	{/if}
	{if $values.product_types_id == 3}
		<td><b>Страхувальник:</b></td>
		<td colspan="2">{if $values.policies_insurer_company}{$values.policies_insurer_company}, {/if}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}</td>
	{/if}
	{if $values.product_types_id == 4}
		<td><b>Потерпілий:</b></td>
		<td colspan="2">{if $values.owner_company}{$values.owner_company}, {/if}{$values.owner_lastname} {$values.owner_firstname} {$values.owner_patronymicname}</td>
	{/if}
</tr>
</table><br />

<table cellspacing="0" cellpadding="5">
<tr>
	{if $values.product_types_id == 3}
		<td><b>Автомобіль:</b></td>
		<td>{$values.policies_brand} {$values.policies_model}</td>
		<td><b>Д.Р.З.:</b></td>
		<td>{$values.policies_sign}</td>
		<td><b>Страхова сума:</b></td>
		<td>{$values.policies_price|moneyformat:-1}</td>
	{/if}
	{if $values.product_types_id == 4}
		<td><b>Автомобіль:</b></td>
		<td>{$values.owner_brand} {$values.owner_model}</td>
		<td><b>Д.Р.З.:</b></td>
		<td>{$values.owner_sign}</td>
		<td><b>Страхова сума:</b></td>
		<td>{$values.owner_price|moneyformat:-1}</td>
	{/if}
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td><b>Визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline.</b></td>
</tr>
</table><br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td>Необходні дані:</td>
</tr>
</table><br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td><b>Виконати:</b></td>
</tr>
</table><br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
    <td>Визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline.</td>
</tr>
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
	<td align="left"></td>
</tr>
</table>
</body>
</html>