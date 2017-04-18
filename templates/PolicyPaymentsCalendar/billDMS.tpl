﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ДМС. Bill. EI</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 18px;
			font-family: Arial, Geneva, Helvetica, sans-serif;
		}
		TH {
			background-color: #eeeeee;
		}
	</style>
	{/literal}
</head>
<body {if $values.payed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/payed.gif)"{/if}>
{if $values.insurance_companies_id == 4}
<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
{else}
<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/satis.png" width="79" height="32" /></td>
{/if}
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		{if $values.insurance_companies_id == 4}
			Товариство з додатковою відповідальністю<br />
			«ЕКСПРЕС СТРАХУВАННЯ»<br />
			Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
			Р/р 26506056201918 в ПАТ КБ "ПРИВАТБАНК",<br/>
			МФО 380269, Код ЄДРПОУ 36086124
		{else}
			ПрАТ «СК «САТІС»<br/>
			Адреса: м. Київ, вул. Саперно-Слобідська, 22<br />
			Р/р №26507051917600 в ПАТ «УкрСиббанк»,<br/>
			МФО 351005, Код ЄДРПОУ 22963118
		{/if}
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Одержувач:</b></td>
	<td>той самий</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Платник:</b></td>
	<td>{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer_company}{/if}</td>
</tr>
</table><br />

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
		<b>Рахунок-фактура № &nbsp; {$values.bill_number}<br />
		від {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b>
	</td>
</tr>
</table>

<table width=99% cellpadding=5 cellspacing=0 border=1>
<tr>
	<th>Товар</th>
	<th width=100>&nbsp;</th>
	<th width=120>Сума, грн.</th>
</tr>
<tr>
	<td>
		{$values.policies_number},
		{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}.{$values.insurer_patronymicname|truncate:2:'':true}.{else}{$values.insurer}{/if},
		{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}
		Страховий платіж згідно договору(полісу) без ПДВ
	</td>
	<td>БЕЗ ПДВ</td>
	<td align=right>{$values.bill_amount|moneyformat:-1}</td>
</tr>
</table><br /><br />

Всього на суму: {$values.bill_amount|moneyformat:1:true}<br /><br />
Без ПДВ: {$values.bill_amount|moneyformat:1:true}<br /><br />
<table width=300 cellpadding=0 cellspacing=0 style="margin-top: 40px;">
<tr>
	<td align=left>Виписав(ла):</td>
</tr>
</table>
<div style="font-weight: bold; font-size: 24px; margin-top: 50px;">при наборі платежу, будь ласка , ставте відповідні розділові знаки!!!!</div>
</body>
</html>