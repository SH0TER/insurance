<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
{if $values.financial_institutions_id<>28}
<html>
<head>
	<title>KASKO. Bill. EI</title>
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
{if $values.financial_institutions_id!=34 && $values.financial_institutions_id!=25 && $values.products_id !=261}<!--правекс идет в гарант лайф-->
<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
{/if}
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		{if ($values.financial_institutions_id==34 && $values.insurance_companies_id==8) || $values.financial_institutions_id==25 || $values.products_id == 261 || $values.products_id == 376 || $values.products_id == 339 || $values.products_id == 377}<!--правекс идет в гарант лайф-->
				Товариство з додатковою відповідальністю<br />
				ПАТ "УСК "Гарант-ЛАЙФ"<br />
				Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
				{if $values.products_id == 376 || $values.products_id == 339 || $values.products_id == 377}
				Р/р 2650401395391 в Київській філії ПАТ «КРЕДОБАНК»<br />
				МФО 325365, код ЄДРПОУ 31025837
				{else}
				<!--Р/р 26504620526079  в ПАТ "Промінвестбанк"<br>
				МФО 300012, код ЄДРПОУ 31025837-->
				
				Р/р 265073011592  в АТ "ОЩАДБАНК"<br>
				МФО 300465, ЄДРПОУ 36086124
				{/if}
		{else}
				Товариство з додатковою відповідальністю<br />
				«ЕКСПРЕС СТРАХУВАННЯ»<br />
				Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
				{if $values.top_agency == 417}<!-- Для правекса -->
					Р/р 26503700300684  у ПАТКБ "ПРАВЕКС-БАНК"<br />
					МФО 380838, код ЄДРПОУ 36086124
				{elseif $values.products_id == 236}<!-- Для УкрГаз Банка -->
						Р/р 26503112816 у АБ «УкргазБанк» м. Києва<br />
						МФО 320478, код ЄДРПОУ 36086124
				{elseif $values.products_id == 345}	
						Р/р  26507018068013 в ПАТ "Всеукраїнський банк розвитку"<br />
						МФО 380719, Код  ЄДРПОУ 36086124 	
				{elseif $values.products_id == 790}	
						р/р №26504010230976 в ПАТ  "Укрсоцбанк"<br />
						МФО 300023, ЄДРПОУ  36086124
				{elseif $values.products_id == 807}	
						Р/р 2650702386937 в ПАТ "Кредобанк"<br />
						МФО 325365, Код ЄДРПОУ 36086124
				{elseif $values.products_id == 792}	
						Р/р 26508743584718 в АБ "УКРГАЗБАНК"<br />
						МФО 320478, Код ЄДРПОУ 36086124						
				{else}
					 {if $values.financial_institutions_id==7}<!--АКІБ "УкрСиббанк"-->
						Р/р 26507243268800 в ПАТ "Укрсиббанк"<br />
						МФО 351005, Код ЄДРПОУ 36086124
					{elseif $values.products_id == 690 || $values.products_id == 691 || $values.products_id == 692  || $values.products_id == 759}	<!--кредобанк-->
						Р/р 2650702386937   в ПАТ "КРЕДОБАНК"<br />
						МФО 325365, Код ЄДРПОУ 36086124
					 {else}
						<!--Р/р 26507620526463 в ПАТ "Промінвестбанк"<br />
						МФО 300012, Код ЄДРПОУ 36086124-->
						
						Р/р 265073011592  в АТ "ОЩАДБАНК"<br>
						МФО 300465, ЄДРПОУ 36086124
					 {/if}	
				{/if}
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
	<td>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
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
        {$values.number},
		{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}.{$values.insurer_patronymicname|truncate:2:'':true}.,
		{$values.insurer_identification_code},
		{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY} Страховий платіж згідно договору(полісу) без ПДВ
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
{else}
<html>
<head>
	<title>KASKO. Bill. EI</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
			* {
				font-size: 13px;
				font-family: Arial, Geneva, Helvetica, sans-serif;
			}
			BODY {
				width: 1150px;
			}
			H1 {
				font-size: 15px;
				font-weight: bold;
			}
			H2 {
				font-size: 13px;
				font-weight: bold;
				margin-bottom: 0px;
			}
			P {
				font-size: 13px;
				padding-top:0px;
				padding-bottom:0px;
				margin-top: 0px;
				margin-bottom:0px;
			}
			UL, OL {
				margin: 0px;
			}
			.small {
				font-size: 10px;
			}
			.center {
				text-align: center;
			}
			.all {
				border: 1px solid black;
			}
			.left {
				border-left: 1px solid black;
			}
			.top {
				border-top: 1px solid black;
			}
			.right {
				border-right: 1px solid black;
			}
			.bottom {
				border-bottom: 1px solid black;
			}
			.u {
				text-decoration: line-through;
			}
			.grey {
				background-color: #eeeeee;
			}
			.underline {
				border-bottom: 1px solid #000000;
			}
			.bold {
				font-weight: bold;
			}
			.sub {
				font-size: 10px;
				text-align: center;
				font-style: italic;
			}
	</style>
	{/literal}
</head>
<body>
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		ПАТ "УСК "Гарант-ЛАЙФ"<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
		Р/р 26506010104844 у ПАТ «ВТБ Банк» Кредитний центр «Поділ»<br />
		МФО 321767, код ЄДРПОУ 31025837
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
	<td>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
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
	<td>/=01~Страховий платіж~{$values.number}~~{$values.date|date_format:'%d/%m/%Y'}~{$values.insurer_identification_code}~~{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}~~=/</td>
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
{/if}