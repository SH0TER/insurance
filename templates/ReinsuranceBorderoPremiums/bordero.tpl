<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Бордеро премий, КАСКО</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
{literal}
<style>
* {
	font-size: 9px;
}
</style>
{/literal}
</head>
<body>

<table cellspacing=0 cellpadding=0 width="1588">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1>Рахунок бордеро премій № {$agreement.number} від {$agreement.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h1>
		<p>до договору {$agreement.agreementsNumber} облігаторного перестрахування наземних транспортних засобів від {$agreement.agreementsDate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table><br />

<table width="1588" cellpadding="2" cellspacing="0" border="1">
<tr class="columns">
	<td rowspan="2" align="center" nowrap><b>№ з/п</b></td>
	<td colspan="2" align="center" nowrap><b>Договір страхування</b></td>
	<td rowspan="2" nowrap><b>Страхувальник</b></td>
	<td rowspan="2" nowrap><b>Застрахований<br />транспортний<br />засіб</b></td>
	<td rowspan="2" nowrap><b>Номер кузова/шассі</b></td>
	<td rowspan="2"><b>Державний<br />реєстраційний<br />номер</b></td>
	<td colspan="2" align="center"><b>Період страхування</b></td>
	<td rowspan="2"><b>Страхова сума, грн.</b></td>
	<td rowspan="2"><b>Страхова випадки</b></td>
	<td rowspan="2"><b>Рік випуску</b></td>
	<td colspan="2" align="center"><b>Франшиза</b></td>
	<td rowspan="2" nowrap><b>Відповідальність<br />Перестрахувальника, грн.</b></td>
	<td rowspan="2" nowrap><b>Відповідальність<br />Перестраховика, грн.</b></td>
	<td rowspan="2"><b>Перестраховий тариф, річний, %</b></td>
	<td rowspan="2"><b>Загальна перестрахова премія, грн.</b></td>
	<td rowspan="2"><b>Перестрахова премія за звітний період, грн.</b></td>
	<td rowspan="2"><b>Дата<br />наступного<br />платежу</b></td>
	<td rowspan="2"><b>Сума наступного платежу, грн.</b></td>
	<td rowspan="2"><b>Застраховано з врахуванням зносу</b></td>
</tr>
<tr>
	<td><b>№</b></td>
	<td><b>Дата</b></td>
	<td align="center"><b>з</b></td>
	<td align="center"><b>до</b></td>
	<td width="60" align="center" nowrap><b>Викр.%</b></td>
	<td width="60" align="center" nowrap><b>Пош.%</b></td>
</tr>
<tr>
	<td align="center">1</td>
	<td align="center">2</td>
	<td align="center">3</td>
	<td align="center">4</td>
	<td align="center">5</td>
	<td align="center">6</td>
	<td align="center">7</td>
	<td align="center">8</td>
	<td align="center">9</td>
	<td align="center">10</td>
	<td align="center">11</td>
	<td align="center">12</td>
	<td align="center">13</td>
	<td align="center">14</td>
	<td align="center">15</td>
	<td align="center">16</td>
	<td align="center">17</td>
	<td align="center">18</td>
	<td align="center">19</td>
	<td align="center">20</td>
	<td align="center">21</td>
	<td align="center">22</td>
</tr>
{assign var="totalItemsPrice" value=0}
{assign var="totalInsurerPrice" value=0}
{assign var="totalPrice" value=0}
{assign var="totalTotalAmount" value=0}
{assign var="totalAmount" value=0}
{section name="roll" loop=$list}
<tr>
	<td align="center" nowrap>{$smarty.section.roll.iteration}</td>
	<td nowrap>{$list[roll].policiesNumber}</td>
	<td nowrap>{$list[roll].policiesDate}</td>
	<td>{$list[roll].policiesInsurer}</td>
	<td>{$list[roll].item}</td>
	<td nowrap>{$list[roll].shassi}</td>
	<td nowrap>{$list[roll].sign}</td>
	<td nowrap>{$list[roll].policiesbegin_datetime}</td>
	<td nowrap>{$list[roll].policiesinterrupt_datetime}</td>
	<td align="right" nowrap>{$list[roll].itemsPrice|moneyformat:-1}</td>
	<td>{$list[roll].borderoRisks|risksformat}</td>
	<td nowrap>{$list[roll].year}</td>
	<td align="right" nowrap>{$list[roll].deductibles_value1}</td>
	<td align="right" nowrap>{$list[roll].deductibles_value0}</td>
	<td align="right" nowrap>{$list[roll].insurerPrice|moneyformat:-1}</td>
	<td align="right" nowrap>{$list[roll].price|moneyformat:-1}</td>
	<td align="right" nowrap>{$list[roll].rate}</td>
	<td align="right" nowrap>{$list[roll].totalAmount|moneyformat:-1}</td>
	<td align="right" nowrap>{$list[roll].amount|moneyformat:-1}</td>
	<td align="right" nowrap>{if $list[roll].nextPaymentAmount > 0}{$list[roll].nextPaymentDate}{else}немає{/if}</td>
	<td align="right" nowrap>{if $list[roll].nextPaymentAmount > 0}{$list[roll].nextPaymentAmount|moneyformat:-1}{else}немає{/if}</td>
	<td>{if $list[roll].options_deterioration_no == 0} так {else} ні{/if}</td>
</tr>
{assign var="totalItemsPrice" value=$totalItemsPrice+$list[roll].itemsPrice}
{assign var="totalInsurerPrice" value=$totalInsurerPrice+$list[roll].insurerPrice}
{assign var="totalPrice" value=$totalPrice+$list[roll].price}
{assign var="totalTotalAmount" value=$totalTotalAmount+$list[roll].totalAmount}
{assign var="totalAmount" value=$totalAmount+$list[roll].amount}
{/section}
<tr>
	<td colspan="9" nowrap>&nbsp;</td>
	<td align="right" nowrap><b>{$totalItemsPrice|moneyformat:-1}</b></td>
	<td colspan="4">&nbsp;</td>
	<td align="right" nowrap><b>{$totalInsurerPrice|moneyformat:-1}</b></td>
	<td align="right" nowrap><b>{$totalPrice|moneyformat:-1}</b></td>
	<td>&nbsp;</td>
	<td align="right" nowrap><b>{$totalTotalAmount|moneyformat:-1}</b></td>
	<td align="right" nowrap><b>{$totalAmount|moneyformat:-1}</b></td>
	<td colspan="3">&nbsp;</td>
</tr>
</table><br /><br />

<table width="100%">
<tr>
	<td width="30%" valign="top">
		<div align="center"><b>СТРАХОВИК</b></div><br />
		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул. Велика Васильківська, 15/2<br />
		Р/р 26507620526463 в ПАТ "Промінвестбанк"<br />
		МФО 300012, Код ЄДРПОУ 36086124<br /><br /><br />
		Директор Скрипник О.О.________________________
	</td>
	<td width="40%">&nbsp;</td>
	<td width="30%" valign="top">
		<div align="center"><b>ПЕРЕСТРАХОВИК</b></div><br />
		{$company.title}<br />
		{$company.address}<br />
		Тел. {$company.phones}<br />
		{$company.banking_details}<br />
		ЄДРПОУ {$company.edrpou}<br /><br /><br />
		{$company.position} {$company.director1} ________________________
	</td>
</tr>
</table>
</body>
</html>