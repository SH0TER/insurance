<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ЗАЯВА на  страхування  від  нещасних  випадків, СТАНДАРТ</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1>ЗАЯВА</h1
		<h1>на  страхування  від  нещасних  випадків</h1>
	</td>
	<td width="220" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
	<td align="right">
		<p>№ {$values.number}</p>
		<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>
<br />
<br />
<br />
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td><b>1. Страхувальник/Застрахована особа (ПІБ):</b></td>
	<td width="600" class="all">{$values.insurer_title}</td>
	<td><b>2. Дата народження:</b></td>
	<td class="all">{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table><br />

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td>3. Домашня адреса:</td>
	<td width="1000" class="all">{$values.insurer_address}</td>
</tr>
</table><br />

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td>4. Місце роботи: </td>
	<td width="250" class="all">{$values.insurer_company}</td>
	<td>5. Посада:</td>
	<td width="200" class="all">{$values.insurer_position}</td>
	<td>6. Заняття активними видами спорту:</td>
	<td width="200" class="all">{$values.insurer_sport}</td>
</tr>
</table><br />

<p><b>7. Страхувальник/Застрахована особа бажає отримати страховий захист за наступними страховими випадками (необхідне відмітити Х):</b></p>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td>Смерть, яка настала внаслідок нещасного випадку</td>
	<td class="all" width="10%">{if $values.ns_death}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td>Встановлення І групи інвалідності, яка настала внаслідок нещасного випадку</td>
	<td class="right bottom left">{if $values.invalid1}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td>Встановлення ІІ групи інвалідності, яка настала внаслідок нещасного випадку</td>
	<td class="right bottom left">{if $values.invalid2}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td>Встановлення ІІI групи інвалідності, яка настала внаслідок нещасного випадку</td>
	<td class="right bottom left">{if $values.invalid3}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td>Тимчасова втрата загальної працездатності</td>
	<td class="right bottom left">{if $values.ns_temp}Так{else}Ні{/if}</td>
</tr>
</table><br />

<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td><b>8. Страхова сума:</b></td>
	<td width="200" class="all">{$values.price|moneyformat:-1}</td>
	<td><b>9. Період  страхування:</b></td>
	<td width="200" class="all">з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td><b>10. Дія страхового захисту продовж доби:</b></td>
	<td width="200" class="all">{$values.correct_factors.3}</td>
</tr>
</table><br />

<p><b>11. Існуючі Договори страхування від нещасних випадків:</b></p>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="25%" class="all"><b>Назва страхової компанії</b></td>
	<td width="25%" class="top right bottom"><b>Вид страхування</b></td>
	<td width="25%" class="top right bottom"><b>Страхова сума, грн.</b></td>
	<td width="25%" class="top right bottom"><b>Дата заключення Договору</b></td>
</tr>
{section name="roll" loop=$values.agreements}
<tr>
	<td class="left right bottom">{$values.agreements[roll].company}</td>
	<td class="right bottom">{$values.agreements[roll].kind}</td>
	<td class="right bottom">{$values.agreements[roll].price|moneyformat:-1}</td>
	<td class="right bottom">{$values.agreements[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
{sectionelse}
<tr>
	<td align="center" colspan="4" class="left right bottom">немає</td>
</tr>
{/section}
</table><br />

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
	<td>Назва, реквізити Вигодонабувача: </td>
   <td width="1000" class="all">Згідно чинного законодавства України</td>
	<!--<td width="1000" class="all">{$values.assured_title}, {if $values.financial_institutions_id == 0}ІПН: {else}ЄДРПОУ: {/if}{$values.assured_identification_code}, Адреса: {$values.assured_address}, Телефон:{$values.assured_phone}</td>-->
</tr>
<tr>
	<td colspan="2">
		<p>Інформація, щодо:
		<ul>
		<li>страхової послуги, вартості цієї послуги для мене;</li>
		<li>умов надання додаткових страхових послуг та їх вартість;</li>
		<li>порядку сплати податків і зборів за мій рахунок в результаті отримання страхової послуги;</li>
		<li>правових наслідків та порядку здійснення розрахунків зі мною внаслідок дострокового припинення Договору страхування;
		<li>механізму захисту Страховиком прав споживачів та порядку урегулювання спірних питань, що виникають у процесі надання послуги зі страхування;</li>
		<li>реквізитів органу, який здійснює державне регулювання ринків фінансових послуг (адреса, номер телефону тощо), а також реквізитів органів з питань захисту прав споживачів;</li>
		<li>розміру винагороди фінансової установи у разі, коли вона пропонує страхові послуги, що надаються іншими фінансовими установами,</li>
		</ul>
		<p>надана мені  до укладання Договору страхування та мені зрозуміла.
	</td>
</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" align="right">Заяву заповнив&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="30%" class="bottom">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	<td width="7%" align="center">&nbsp;/&nbsp;</td>
	<td width="10%" class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="20%" >&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom"><!--{if $values.ground_kasko}{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}{else}Скрипник О.О.{/if}-->{$values.director1}</td>
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>&nbsp;</td>
</tr>
{if $values.agencies_id != 1469 && $values.agencies_id != 1496 && $values.agencies_id != 1497 && $values.agencies_id != 1498}
		<tr>
			<td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td class="bottom">{$values.findirector1}</td>
			<td align="center">&nbsp;/&nbsp;</td>
			<td class="bottom">&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
{else}{/if}
</table>
</body>
</html>