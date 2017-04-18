<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Заява на розірвання договору ДМС</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
{literal}
<style>
*, P {
	font-size: 18px;
	line-height: 24px;
}
H1 {
	font-size: 20px;
	font-weight: bold;
	text-align: center;
	margin: 0px;
}
H2 {
	margin-top: 0px;
	font-size: 18px;
	font-weight: bold;
	text-align: center;
}
.small P {
	font-size: 18px;
	line-height: 20px;
}
.large P {
	font-size: 20px;
}
</style>
{/literal}
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 50px 0 100px 0;">
<tr>
	<td width="60%">&nbsp;</td>
	<td align="left">
		{if $values.insurance_companies_id == 4}
			Директору ТДВ "Експрес Страхування"<br/>
			Щучьєвій Т.А.
		{else}
			Генеральному  директору<br/>
			ПрАТ "СК "Сатіс" Яхниці І.О.
		{/if}<br/>
		<br/>
		{$values.insurer3}<br/>
		паспорт серія {$values.insurer_passport_series} № {$values.insurer_passport_number}<br/>
		<br/>
		ким виданий {$values.insurer_passport_place}<br/>
		<br/>
		коли виданий {$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}
	</td>
</tr>
</table>

<p align="center" class="large"><b>ЗАЯВА</b></p>
<p align="center"><b>про розірвання Договору добровільного медичного страхування</b></p>
<br/>
<p style="text-indent: 2em; text-align: justify;">Прошу розірвати зі мною Договір добровільного медичного страхування
	{if $values.insurance_companies_id == 4} № {$values.policies_number}{else} Серія  54 – 33 – Т № 02 – {$values.policies_id}{/if}
	від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. з {$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
<p>Належну мені суму прошу перерахувати та повернути.</p>

<br/>
<table width="100%">
	<tr>
		<td width="20%" align="center">{$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		<td width="70%">&nbsp;</td>
		<td width="10%" class="bottom"></td>
	</tr>
	<tr>
		<td width="20%" class="small" align="center">(дата складання заяви)</td>
		<td width="70%">&nbsp;</td>
		<td width="10%" class="small" align="center">(підпис)</td>
	</tr>
</table>

<p class="small" align="center">(заповнюється Страхувальником)</p>
<br/>
<hr size="1" color="black" />
<p>Не заперечую проти розірвання договору.</p>

<table width="100%" cellspacing=0>

	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" align="center">{$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		<td width="40%">&nbsp;</td>
		<td width="25%" class="bottom">{$values.insured}</td>
		<td width="5%">&nbsp;</td>
		<td width="10%" class="bottom"></td>
	</tr>
	<tr>
		<td width="20%" class="small" align="center">(дата)</td>
		<td width="40%">&nbsp;</td>
		<td width="25%" class="small" align="center">(ПІБ)</td>
		<td width="5%">&nbsp;</td>
		<td width="10%" class="small" align="center">(підпис)</td>
	</tr>
</table>

<p class="small" align="center">(заповнюється Застрахованою особою)</p>
<br/>
<p align="center" class="large"><b>РОЗРАХУНОК</b></p>
<p align="center"><b>на повернення частини страхової премії</b></p>
<table width="100%" cellspacing=0>
	<tr>
		<td class="bottom">{$values.insurer}</td>
	</tr>
</table>
<br/>
<p>за договором ДМС {if $values.insurance_companies_id == 4} № {$values.policies_number}{else} Серія  54 – 33 – Т № 02 – {$values.policies_id}{/if}
	від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
<br/>
<table width="100%" cellspacing=0>
	<tr align="center">
		<td width="20%" class="left top bottom right"></td>
		<td width="20%" class="top bottom right">Страхова премія</td>
		<td width="20%" class="top bottom right">Фактичні витрати</td>
		<td width="20%" class="top bottom right">Утримано на ведення справи (%)</td>
		<td width="20%" class="top bottom right">Належить до виплати</td>
	</tr>
	<tr align="center">
		<td class="left bottom right"></td>
		<td class="bottom right"><b>1</b></td>
		<td class="bottom right"><b>2</b></td>
		<td class="bottom right"><b>3</b></td>
		<td class="bottom right"><b>4</b></td>
	</tr>
	<tr align="center" height="50">
		<td class="left bottom right">ДМС</td>
		<td class="bottom right">{$values.amount|moneyformat}</td>
		<td class="bottom right">0,00</td>
		<td class="bottom right">0,00</td>
		<td class="bottom right">{$values.amount|moneyformat}</td>
	</tr>	
</table>
<br/><br/>
<table width="100%">
	<tr>
		<td width="5%"></td>
		<td class="bottom"></td>
		<td width="5%"></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td class="small" align="center">(сума прописом)</td>
		<td width="5%"></td>
	</tr>
</table>

{if $values.insurance_companies_id == 4}
<p>Належну суму до виплати повернено за платіжним дорученням № ________________________ від ____.____.________ р.</p>
{else}
<p>Належну суму до виплати повернено за квитанцією № ________________________ від ____.____.________ р.</p>
{/if}
<br/>
<table width="100%">
	<tr>
		<td width="30%">Розрахунок склав:</td>
		<td width="10%"></td>
		<td width="10%" class="bottom"></td>
		<td width="15%"></td>
		<td width="25%" class="bottom">{$values.agents_lastname} {$values.agents_firstname|truncate:2:'':true}.{$values.agents_patronymicname|truncate:2:'':true}.</td>
		<td width="10%"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td class="small" align="center">(підпис)</td>
		<td></td>
		<td class="small" align="center">(П.І.Б.)</td>
		<td></td>
	</tr>
	<tr>
		<td width="30%">Розрахунок складено вірно:</td>
		<td width="10%"></td>
		<td width="10%" class="bottom"></td>
		<td width="15%"></td>
		<td width="25%" class="bottom"></td>
		<td width="10%"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td class="small" align="center">(підпис)</td>
		<td></td>
		<td class="small" align="center">(П.І.Б.)</td>
		<td></td>
	</tr>
</table>

</body>
</html>