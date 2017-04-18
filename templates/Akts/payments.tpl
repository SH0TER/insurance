<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Bank payments skr</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 18px;
			font-family: Arial, Geneva, Helvetica, sans-serif;
		}
		.small {
			font-size: 14px;
			font-family: Arial, Geneva, Helvetica, sans-serif;
		}
		h1 {
			font-size: 22px;
		}
		TH {
			background-color: #eeeeee;
		}
	</style>
	{/literal}
</head>
<body >
{assign var=pcount value=0}
{section name=roll loop=$values}
{assign var=pcount value=$pcount+1}
<h1 align=center>Анкета поповнення карткового поточного рахунку</h1>
<br><br>
<table width=100% cellpadding=5 cellspacing=5>
<tr>
	<td class="small" width="30%">Прізвище, ім'я, по батькові<br> Клієнта, що попвнює рахунок</td>
	<td class="bottom">Сидоренко Ирина Станиславовна</td>
</tr>
<tr>
	<td class="small" width="30%">Прізвище, ім'я, по батькові<br> Власника рахунку</td>
	<td class="bottom">{$values[roll].lastname} {$values[roll].firstname} {$values[roll].patronymicname}</td>
</tr>
<tr>
	<td class="small" width="30%">№ картки</td>
	<td class="bottom">{$values[roll].skr}</td>
</tr>
<tr>
	<td class="small" width="30%">Термін дії картки</td>
	<td class="bottom">{$values[roll].cart_date|date_format:'%m/%y'}</td>
</tr>
<tr>
	<td class="small" width="30%">Сума поповнення</td>
	<td class="bottom">{$values[roll].payment_amount|moneyformat:-1}</td>
</tr>

<tr>
	<td class="small" width="30%">Серія та номер паспорту або документа, що його замінює </td>
	<td class="bottom">&nbsp;<!--{$values[roll].passport_series}-{$values[roll].passport_number}  дата видачі  {$values[roll].passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.--></td>
</tr>

<tr>
	<td class="small" width="30%">Ким виданий</td>
	<td class="bottom">&nbsp;<!--{$values[roll].passport_place}--></td>
</tr>
<!--<tr>
	<td class="small" width="30%">Контактний телефон</td>
	<td class="bottom">&nbsp;{$values[roll].phone}</td>
</tr>-->
<tr>
	<td class="small" width="30%">Назва банку</td>
	<td class="bottom">&nbsp;{$values[roll].bank_name}</td>
</tr>
</table><br />

<div> 


<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td > {$values[roll].current_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td align="right">____________/_____________</td>
</tr>
</table>
<br>
Область: {$values[roll].region}
<br />
<hr>

</div>
{if $pcount==3}
<div style="page-break-after: always"></div>
{assign var=pcount value=0}
{/if}
{/section}

</body>
</html>