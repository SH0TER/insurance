<html>
<head>
	<title>Certificate. Bill</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 13px;
			font-family: Arial, Geneva, Helvetica, sans-serif;
		}
		TH {
			background-color: #eeeeee;
		}
	</style>
	{/literal}
</head>
<body {if $values.payed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/payed.gif)"{/if}>
{if $values.client_contacts_id >= 0}
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
    <td>
        <b>Страховик:</b> 
        ТДВ «ЕКСПРЕС СТРАХУВАННЯ»<br />
        <!--Р/р 26507620526463 в ПАТ "Промінвестбанк"
        МФО 300012, ЄДРПОУ 36086124
		-->
		Р/р 265073011592  в АТ "ОЩАДБАНК"
        МФО 300465, ЄДРПОУ 36086124
		<br />
        Страхова компанія є платником податку на прибуток згідно умов п.7.2. статті 7 Закону України "Про оподаткування прибутку підприємств"<br />
        Тел: (044) 594 87 00; факс: (044) 594 87 02
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td colspan="2">
        <b>Страхувальник:</b> 
        {$values.insurer}<br />
        <b>Платник:</b> той же
    </td>
</tr>
</table>

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
        <b>РАХУНОК-ФАКТУРА</b><br /> 
        №&nbsp; {$values.number}<br />
        від {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br /><br />
    </td>
</tr>
</table>

<table width="100%" cellpadding=3 cellspacing=0>
<tr>
    <th class="all">Призначення платежу</th>
    <th class="top right bottom">Сертифікат</th>
    <th class="top right bottom">Сума до перерахування, грн.</th>
</tr>
{section name="roll" loop=$values.certificates}
<tr>
    {if $smarty.section.roll.first}<td class="left right" rowspan="{$smarty.section.roll.total}" valign="top">Страховий платіж {$values.period}р.<br />згідно Договору № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>{/if}
    <td class="right bottom">№&nbsp; {$values.certificates[roll].number} від {$values.certificates[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
    <td class="right bottom" align=right>{$values.certificates[roll].amount|moneyformat:-1}</td>
</tr>
{/section}
<tr>
    <td class="top bottom left">&nbsp;</td>
    <td class="right bottom" align=right><b>Разом:</b></td>
    <td class="right bottom" align=right><b>{$values.bill_amount|moneyformat:-1}</b></td>
</tr>
</table><br /><br />
<b>Всього:</b> (ПДВ зі страхових премій не стягується): {$values.bill_amount|moneyformat:1:true}<br /><br /><br /><br />

<pre>________________/Щучьєва Т.А.</pre>

{else}

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align=center>
        <b>Додаток № {$values.bill_number} від {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</b><br />
        до Генерального договору добровільного страхування наземного транспорту № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
    </td>
	<td>м. Київ</td>
</tr>
</table>
<p>1. Перелік застрахованих транспортних засобів</p>
<table width="100%" cellpadding=3 cellspacing=0 border="1">
<tr>
    <th>№ п/п</th>
    <th>Тип, марка, модель транспортного засобу</th>
    <th>Рік випуску</th>
    <th>Реєстраційний номер</th>
    <th>Номер кузова</th>
    <th>Робочий об'єм двигуна</th>
    <th>Дійсна вартість, грн.</th>
    <th>Строк дії періоду страхування</th>
    <th>Кількість днів</th>
    <th>Страхова сума, грн.</th>
    <th>Страховий тариф, %</th>
    <th>Сума страхового платежу за період, грн.</th>
</tr>
{section name="roll" loop=$values.items}
<tr>
    <td>{$smarty.section.roll.iteration}
    <td>{$values.items[roll].item}</td>
    <td>{$values.items[roll].year}</td>
    <td>{$values.items[roll].sign}</td>
    <td>{$values.items[roll].shassi}</td>
    <td>{$values.items[roll].engine_size}</td>
    <td>{$values.items[roll].car_price}</td>
    <td>{$values.items[roll].begin_datetime_certificate_police|date_format:$smarty.const.DATE_FORMAT_SMARTY} - {$values.items[roll].end_datetime_certificate_police|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
    <td>{$values.items[roll].days}</td>
    <td align=right>{$values.items[roll].price}</td>
    <td>{$values.items[roll].rate}</td>
    <td align=right>{$values.items[roll].amount}</td>
</tr>
{/section}
<tr>
    <td colspan="11" align=right><b>Разом:</b></td>
    <td align=right><b>{$values.bill_amount|moneyformat:-1}</b></td>
</tr>
</table><br /><br />
<p>2. Страховий платіж за строк дії періоду страхування згідно з цим Додатком в розмірі {$values.bill_amount|moneyformat} грн. сплачується Страхувальником на поточний рахунок Страховика одним платежем в строк до {$values.bill_payment_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. включно.</p>
<br />
<p>3. Цей Додаток набуває чинності {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р., за умови сплати Страхувальником страхового платежу на поточний рахунок Страховика в розмірі і строк, зазначені в п.2 цього Додатку.</p>
<br /><br />

<table width="100%">
<tr>
    <td><pre>________________/Щучьєва Т.А.</pre></td>
    <td><pre>________________/{$values.items.0.insurer_lastname} {$values.items.0.insurer_firstname|truncate:2:'':true}.{$values.items.0.insurer_patronymicname|truncate:2:'':true}.</pre></td>
</tr>
</table>
{/if}

</body>
</html>