<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт, ГО, юр. лицо, СК "Дженерали"</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if $row.payed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/payed.gif)"{/if} style="background1: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)">
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"> &nbsp;</td>
	<td align="center">
		<h1>

			АКТ виконаних робіт № {$values.aktnumber} від <!--{$values.from|date_format:$smarty.const.DATE_FORMAT_SMARTY}-->19.04.2011р.<br />
			до договору доручення № {$values.agreement_number_generali} від {$values.agreement_date_generali|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
			за період з   <!--{$values.firstday}р. по {$values.lastday}р. --> 01.04.2011р. по 19.04.2011р.
		</h1>
	</td>
	<td align="right">
	
	</td>
</tr>
</table>

<p><b>{$values.title}</b>, надалі - Агент, в особі <b>{$values.director2}</b>, який (яка) діє на підставі {$values.ground} з однієї сторони та <b>ВАТ "УСК "Гарант-Авто"</b> надалі - Страховик, в особі <b> Голови Правління Волковського Сергія Олексійовича</b>, та <b>Заступника Голови Правління з продажу Онищенко Бориса Андрійовича</b> якi діють на підставі статуту з другої сторони, уклали цей Акт про наступне:</p>

<h2>1. За звітній період Агентом були  укладені договори страхування:</h2>
<table width=100% cellspacing=0 cellpadding=2>
<tr>
	<td rowspan="2" class="all"><b>№ п/п</b></td>
	<td rowspan="2" class="top right bottom"><b>Вид страхування</b></td>
	<td rowspan="2" class="top right bottom"><b>Серія та номер<br />договору<br />страхування</b></td>
	<td rowspan="2" class="top right bottom"><b>Страхувальник</b></td>
	<td colspan="2" class="top right bottom"><b>Строк дії<br />договору страхування</b></td>
	<td rowspan="2" class="top right bottom"><b>Нараховано до <br />сплати, грн.</b></td>
	<td rowspan="2" class="top right bottom"><b>Фактично<br />сплачена страхова<br />премія, грн.</b></td>
	<td rowspan="2" class="top right bottom"><b>Дата сплати<br />страхового<br />платежу</b></td>
	<td colspan="2" class="top right bottom"><b>Агентська<br />винагорода</b></td>
</tr>
<tr>
	<td class="right bottom"><b>з</b></td>
	<td class="right bottom"><b>по</b></td>
	<td class="right bottom"><b>%</b></td>
	<td class="right bottom"><b>грн.</b></td>
</tr>

{assign var="totalAmountPaid" value=0}
{assign var="totalcommission_agency_amount" value=0}
{section name="roll" loop=$policies}
{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}
	{assign var="totalAmountPaid" value=$totalAmountPaid+$policies[roll].amountPaid}
	{assign var="totalcommission_agency_amount" value=$totalcommission_agency_amount+$policies[roll].commission_agency_amount}
{/if}
<tr>
	<td align="center" class="right bottom left">{$smarty.section.roll.iteration}</td>
	<td class="right bottom">ОСЦПВВНТЗ</td>
	<td class="right bottom">{$policies[roll].number}</td>
	<td class="right bottom">{$policies[roll].insurer}</td>
	<td class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}-----{/if}</td>
	<td class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}-----{/if}</td>
	<td align="right" class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].amountPaid|moneyformat:-1}{else}0,00{/if}</td>
	<td align="right" class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].amountPaid|moneyformat:-1}{else}0,00{/if}</td>
	<td class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].payment_datetime|date_format:$smarty.const.DATETIME_FORMAT_SMARTY}{else}-----{/if}</td>
	<td align="center" class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].commission_agency_percent|moneyformat:-1}{else}0,00{/if}</td>
	<td align="right" class="right bottom">{if $smarty.const.POLICY_STATUSES_SPOILT != $policies[roll].policy_statuses_id}{$policies[roll].commission_agency_amount|moneyformat:-1}{else}0,00{/if}</td>
</tr>
{/section}
<tr>
	<td colspan="6" align="right" class="right bottom left"><b>ВСЬОГО:</b></td>
	<td align="right" class="right bottom"><b>{$totalAmountPaid|moneyformat:-1}</b></td>
	<td align="right" class="right bottom"><b>{$totalAmountPaid|moneyformat:-1}</b></td>
	<td align="center" class="right bottom"><b>-----</b></td>
	<td align="center" class="right bottom"><b>-----</b></td>
	<td align="right" class="right bottom"><b>{$totalcommission_agency_amount|moneyformat:-1}&nbsp;</b></td>
</tr>
</table>



<h2>2. Сума винагороди за цим Актом складає {$totalcommission_agency_amount|moneyformat} ({$totalcommission_agency_amount|moneyformat:-1:true}) без ПДВ.</h2>
<h2>3. Цей Акт є достатньою підставою для фіксації факту укладання договорів страхування та розміру отриманих платежів і проведення розрахунків за період з  <!--{$values.firstday}р. по {$values.lastday}р. --> 01.04.2011р. по 19.04.2011р.}р.</h2>
<h2>4. Даний Акт складено у двох примірниках, які зберігаються у Сторін за вищевказаним Договором і мають однакову юридичну силу.</h2>
<h2>5. Сторони одна до одної претензій не мають.</h2>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td width=500 align=left valign=top>
		<table width="100%" border=0 cellspacing=0 cellpadding=5>
		<tr>
			<td align="center"><b>СТРАХОВИК:</b></td>
		</tr>
		<tr>
			<td class="bottom"><b>ВАТ "УСК "Гарант-Авто"</b></td>
		</tr>
		<tr>
			<td class="bottom">Адреса: 01004, м. Київ, Велика Васильківська 15/2</td>
		</tr>
		<tr>
			<td class="bottom">ЄДРПОУ: 16467237</td>
		</tr>
		<tr>
			<td class="bottom">п/р №&nbsp; 26509735053020 АТ "БрокБізнесБанк",  МФО: 300249</td>
		</tr>
		<tr>
			<td class="bottom">Голова Правління Волковський  С. О.</td></td>
		</tr>
			<tr>
			<td class="bottom"> &nbsp;</td></td>
		</tr>
			<tr>
			<td class="bottom">Заступник Голови Правління з продажу Онищенко Б. А.</td></td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width=500 align=left valign=top>
		<table width="100%" border=0 cellspacing=0 cellpadding=5>
		<tr>
			<td align="center"><b>АГЕНТ:</b></td>
		</tr>
		<tr>
			<td class="bottom"><b>{$values.title}</b></td>
		</tr>
		<tr>
			<td class="bottom">Адреса: {$values.address}</td>
		</tr>
		<tr>
			<td class="bottom">ЄДРПОУ: {$values.edrpou}</td>
		</tr>
		<tr>
			<td class="bottom">{$values.bank}</td>
		</tr>
		<tr>
			<td class="bottom">{$values.director1}</td>
		</tr>
		</table>
	</td>
</tr>
</table>




</body>
</html>