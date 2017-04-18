<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист узгодження Майно</title>
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
	<!--td align="right"><b>Клас ремонту:{if $values.repair_classifications_id}{$values.repair_classifications_id}{/if}</b></td-->
</tr>
<tr>
	{if $values.euassist == 1}
		<td width="227" id="company5"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	{else}
		<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	{/if}
	<td align="center">
		<h1>ЛИСТ УЗГОДЖЕННЯ</h1>
		<h2>Cправа № {$values.accidents_number}</h2>
		<h2>Страхувальник: {if $values.policies_insurer_company}{$values.policies_insurer_company}, {/if}{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}</h2>
		<h2>Застраховане майно: {$values.insurance_object}</h2>
	</td>
	<td width="227">&nbsp;</td>
</tr>
</table><br />

<p><b>Обставини пригоди:</b><br />{$values.description_average}</p>

<table width="100%" cellspacing="10" style="margin-top: 20px;">
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td width="33%">
		Начальник відділу експертів
	</td>
	<td class="bottom">&nbsp;</td>
	<td width="33%" align="right">
		Публічук Р.В.
	</td>
</tr>
</table>

<table width="100%" cellspacing="10" style="margin-top: 20px;">
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>

<tr>
	<td width="33%">
		Начальник Відділу врегулювання збитків
	</td>
	<td class="bottom">&nbsp;</td>
	<td width="33%" align="right">&nbsp;</td>
</tr>
</table>

<table width="100%" cellspacing="10" style="margin-top: 20px;">
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td width="33%">
		{if $values.euassist == 1}
			Начальник юридичного відділу
		{else}
			Начальник юридичного відділу,<br />
			ТДВ "Експрес страхування"
		{/if}
	</td>
	<td class="bottom">&nbsp;</td>
	<td width="33%" align="right">{if $values.euassist == 1}Скоповська Х. М.{/if}</td>
</tr>
</table>

<table width="100%" cellspacing="10" style="margin-top: 20px;">
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" style="height: 50px;" class="bottom">&nbsp;</td>
</tr>
<tr>
	<td width="33%">Виконав</td>
	<td class="bottom">&nbsp;</td>
	<td width="33%" align="right">{$values.average_managers_lastname} {$values.average_managers_firstname|truncate:2:'':true}. {$values.average_managers_patronymicname|truncate:2:'':true}.</td>
</tr>
</table>
</body>
</html>