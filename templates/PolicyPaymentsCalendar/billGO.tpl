<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>GO. Bill. Generali</title>
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

{if $values.blank_series && $values.blank_number}

<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
	{if $values.agencies_id==1492}
		ПАТ «Українська автомобільна корпорація»<br> АФ «Зіп-Авто»<br />
		Адреса: 01004, м. Київ, вул. Червоноармійська 15/2.<br />
		Р/р 2600411142 в ПАТ «ПУМБ»<br>
        МФО 334851, ЄДРПОУ 25662015
	{else}
		Товариство з додатковою відповідальністю<br />
		«ЕКСПРЕС СТРАХУВАННЯ»<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
		
		Р/р 265073011592  в АТ "ОЩАДБАНК"<br>
        МФО 300465, ЄДРПОУ 36086124
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
	<td>{if $values.person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer_lastname}{/if}</td>
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
		<!--старая строка {literal}#{/literal}{$values.blank_series}/{$values.blank_number}{literal}#~{/literal}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{literal}~{/literal}{if $values.person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if}{literal}~{/literal}Страховий платіж згідно договору(полісу) без ПДВ -->
		Страховий платіж; ГО; Н; {$values.blank_series}/{$values.blank_number}; {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}; 0,11%; {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}; {if $values.person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if}; 26-ГУ  Страховий платіж згідно договору(полісу) без ПДВ
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
<div style="font-weight: bold; font-size: 24px; margin-top: 50px;">При наборі платежу, будь ласка , ставте відповідні розділові знаки!!!!</div>

{/if}
</body>
</html>