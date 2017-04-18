<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт, по мастерам приемщикам</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/euassist_logo.gif" width="227" height="105" /></td>
	<td align="center"><h1>Акт про надання послуг № {$row.aktnumber}</h1><h2>до договору № {$data.agreement_number} від {$row.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h2></td>
	<td align="right">
		<p>Складено: {$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br>м. Київ</p>
	</td>
</tr>
</table>

	<p><b>«Товариство з обмеженою відповідальністю «ЄвроАсистанс»</b>, надалі <b>«Замовник»</b>, 
	в особі Генерального Директора <b>Залуцького Сергія Владиславовича</b> та Заступника Генерального Директора – Головного бухгалтера <b>Бобрік Лариси Володимирівни</b>, які діють на підставі Статуту, з однієї сторони,  
	та <b>{$row.lastname} {$row.firstname} {$row.patronymicname}</b>
	,  
    <!--місце проживання: <b>{$row.address}</b>
	(паспорт серія <b>{$row.passport_series} № {$row.passport_number}</b> виданий {$row.passport_place} 
	{$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.; ідентифікаційний код {$row.identification_code}), -->
	далі  ВИКОНАВЕЦЬ, з іншої сторони, склали даний Акт про надання послуг про наступне:<br><br>
    <p>В рамках дії Договору №  {$data.agreement_number} від {$row.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. (надалі - Договір)
    Замовник прийняв, а Виконавець надав послуги згідно п. 1.1 Договору у відношенні даних договорів страхування:</p><br />
	

<p>
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="totalall" value=0}
{assign var="counter" value=1}
{assign var="prev_product_types_id" value=0}
{section name="roll" loop=$row.policies}
	{if $row.policies[roll].product_types_id!=$prev_product_types_id}
	{assign var="first" value=1}
	{/if}


{if $first==1}
{if $prev_product_types_id>0}
<tr>
	<td colspan="8" align="right">Всього:</td>
	<td>{$total|moneyformat:-1}</td>
</tr>
</table><br /><br />
{assign var="total" value=0}
{/if}
{if $row.policies[roll].product_types_id==3}
Подія за договорами добровільного страхування наземних транспортних засобів КАСКО
{/if}
{if $row.policies[roll].product_types_id==4}
Подія за договорами обов’язкового страхування ЦВВНТЗ
{/if}

<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr align="center">
	<td width="50" align="center"><b>№ &nbsp;п/п</b></td>
	<td><b>№ справи</b></td>
	<td><b>№ договору страхування</b></td>
	<td><b>Страхувальник</b></td>
	<td><b>Марка ТЗ</b></td>
	<td><b>Держ номер</b></td>
	<td><b>ПІБ заявника</b></td>
	<td><b>Перелік документів<br> (Заява/ огляд)</b></td>
	<td><b>Сума винагороди Виконавця, грн.</b></td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$row.policies[roll].accident_number}</td>
	<td>{$row.policies[roll].number}</td>
	<td>{$row.policies[roll].fio}</td>
	<td>{$row.policies[roll].item}</td>
	<td>{$row.policies[roll].sign}</td>
	
	<td>{$row.policies[roll].applicant_fio}</td>
	
	
	<td>({if $row.policies[roll].comission_master}+{else}-{/if})/({if $row.policies[roll].comission_investigation}+{else}-{/if})</td>
	<td>{$row.policies[roll].commission_amount_white|moneyformat:-1}</td>
</tr>
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="totalall" value=$totalall+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="8" align="right">Всього:</td>
	<td>{$total|moneyformat:-1}</td>
</tr>
</table><br /><br />
{/if}
{assign var="prev_product_types_id" value=$row.policies[roll].product_types_id}
{/section}
<p>
<b>Всього за актом:</b> <b>{$totalall|moneyformat:-1} грн.</b> ({$totalall|moneyformat:1:true})
<p>Довідково <br>
З суми винагороди утримуються наступні податки: <br>
ПДФО 15-17% - згідно розділу IV Податкового кодексу України<br>
ЄСВ 2,6% Згідно ЗУ "Про збір та облік єдиного внеску на загальнообов’язкове<br>
державне соціальне страхування" № 2464 - VI<br><br>
<p>Після перерахування Виконавцю належної йому винагороди, сторони претензій одна до одної мати не будуть.
<p>Даний Акт складено у двох примірниках українською мовою, які мають однакову юридичну силу, по одному для кожної із Сторін.
<p>
<table width="100%">
<tr>
	<td width="40%" valign="top">
		<div align="center"><b>ЗАМОВНИК</b></div><br />
		<b>ТОВ «ЄвроАсистанс»</b><br />
		04655, Україна,<br/>
		м. Київ, пр-т Московський, 22<br/>
		Р/р 265073011592 в АТ «ОЩАДБАНК»<br/>
		МФО 300465, Код ЄДРПОУ 34484756<br/>
		ІПН 344847526585, <br/>
		Свідоцтво 200108296<br/><br/><br/><br/><br/><br/>
		Генеральний Директор_______________________/ Залуцький С.В./<br/><br/>
		Заступник Генерального Директора – <br/>Головний бухгалтер_________________________/Бобрік Л.В./
	</td>
	<td width="60%" valign="top">
		<div align="center"><b>ВИКОНАВЕЦЬ</b></div><br />
		{$row.lastname} {$row.firstname} {$row.patronymicname}<br />
		Адреса реєстрації:{$row.address}<br />
		Паспорт: {$row.passport_series} №&nbsp; {$row.passport_number},<br />
		виданий {$row.passport_place} {$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		Iдентифікаційний код {$row.identification_code}<br />
		Банк отримувача: {$row.recipient}<br />
		Код ЗКПО {$row.zkpo}<br />
		МФО {$row.mfo}<br />
		Номер рахунку {$row.bank_account}<br />
		Призначення платежу: {$row.bank_reference}<br /><br />
		{$row.lastname} {$row.firstname} {$row.patronymicname} ________________________<br />
	</td>
</tr>
</table>

</body>
</html>