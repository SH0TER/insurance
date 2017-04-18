<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Довідка про визначення середньої ринкової ціни КТЗ</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
{section name="roll" loop=$values.items}
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="311" id="express-credit-company"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="311" height="159" style="vertical-align: middle;" /></td>
	<td width="10">&nbsp;</td>
	<td class="green-express-credit">
		<p>ТОВ «УКРАВТОЛІЗІНГ»</p>
		<p>01004, Україна, Київ</p>
		<p>вул. Червоноармійська, 15/2</p>
		<p>Телефон: +38 (044) 5948704</p>
		<p>Факс: +38 (044) 5948705</p>
	</td>
</tr>
</table>

<h1 style="margin-top:40px">Довідка № {$values.number}<br />про визначення середньої ринкової ціни КТЗ<br />{$values.items[roll].brand} {$values.items[roll].model}</h1>
<p align="right">Складено {$values.items[roll].expert_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>

<h2 align="center">ВСТУП</h2>
<p>Оцінку виконано суб`єктом оціночної діяльності ТОВ «УКРАВТОЛІЗІНГ» (Сертифікат суб`єкта оціночної діяльності № 116/16 від 09 лютого 2016 року Фонду державного майна України) на підставі заяви, що є невід'ємною частиною Договору від 01.08.2012 р.</p>
<p>
{if $values.expert_id == 12027}
	Проведення оцінки доручено експерту Публічук Роман Володимирович, який має вищу Освіта, кваліфікацію судового експерта за спеціальністю 12.2 "Визначення вартості дорожніх транспортних засобів, розміру збитку, завданого власнику транспортного засобу", МЮ України свідоцтво №1115 від 25 квітня 2007 року.
{elseif $values.expert_id == 12033}
	Проведення оцінки доручено оцінювачу Кубраку Юрію Валентиновичу, який має вищу освіту, та кваліфікацію аварійного комісара (свідоцтво № 994 від 26 січня  2007 року), кваліфікаційне свідоцтво оцінювача  МФ № 6090 від 07 червня 2006 року, свідоцтво про реєстрацію в Державному реєстрі оцінювачів № 6641 від 02 липня 2008 року та посвідчення про підвищення кваліфікації оцінювача МФ № 054-ПК від 21 червня 2013 року. 
{elseif $values.expert_id == 12032}
	Проведення оцінки доручено оцінювачу Олійнику Юрію Володимировичу, який має вищу освіту, кваліфікацію оцінювача дорожніх транспортних засобів (кваліфікаційне свідоцтво оцінювача ФДМ України МФ № 057-ПК стаж від 08.09 2007 року) стаж роботи оцінювачем 2007 року та стаж роботи за фахом з 2005 року. 
{else}
	!!!!!
{/if}
</p>
<ul>
	<li><b>Об'єкт оцінки:</b> автомобіль {$values.items[roll].brand} {$values.items[roll].model} держномер {$values.items[roll].sign}.
	<li><b>Замовник оцінки:</b> юридична особа - страхова компанія ТДВ "Експрес Страхування".
	<li><b>Мета оцінки:</b> визначення середньої ринкової ціни, КТЗ {$values.items[roll].brand} {$values.items[roll].model} держномер {$values.items[roll].sign}, з метою страхування.
</ul><br />

<h2 align="center">ІДЕНТИФІКАЦІЯ КТЗ</h2>
<p>На підставі ідентифікації транспортного засобу встановлено:</p>
<table width="100%" cellspacing="0" border="1">
<tr>
	<td>КТЗ:</td>
	<td>{$values.items[roll].brand} {$values.items[roll].model}</td>
</tr>
<tr>
	<td>Держномер:</td>
	<td>{$values.items[roll].sign}</td>
</tr>
<tr>
	<td>Рік випуску:</td>
	<td>{$values.items[roll].year}</td>
</tr>
<tr>
	<td>Двигун:</td>
	<td>{$values.items[roll].engine_size}</td>
</tr>
<tr>
	<td>Кузов:</td>
	<td>{$values.items[roll].shassi}</td>
</tr>
<tr>
	<td>Тип пального:</td>
	<td>{$values.items[roll].car_engine_type_title}</td>
</tr>
<tr>
	<td>КПП:</td>
	<td>{$values.items[roll].transmissions_title}</td>
</tr>
<tr>
	<td>Тип кузова:</td>
	<td>{$values.items[roll].car_body_title}</td>
</tr>
</table><br />


<h2 align="center">ВИЗНАЧЕННЯ СЕРЕДНЬОЇ РИНКОВОЇ ЦІНИ КТЗ</h2>
<p>Середня ринкова ціна (Сср) оцінюваного КТЗ базується на довідникових цінових даних продажу на подібне майно. Середня ринкова ціна (Сср) оцінюваного КТЗ визначається на базі середньої ціни продажу (пропозиції) ідентичного КТЗ за такою формулою:</p><br />

<h3 align="center">Сср = Сд х К + М</h3>
<p>де</p>
<ul>
	<li>С - ціна КТЗ, який був у користуванні, з урахуванням строку його експлуатації, за інформацією з довідкової літератури, зокрема  наведеної у переліку рекомендованих нормативно-правових актів, методичної, довідкової літератури та комп'ютерних баз даних з програмним забезпеченням (додаток 8). Якщо в довідковій літературі наводяться ціни продажу і ціни пропозиції, то згідно з принципом заміщення значення СД повинно дорівнювати ціні продажу КТЗ;
	<li>К - коефіцієнт ринку регіону, який враховує відмінність поточних цін продажу та пропозиції до продажу у відповідному регіоні від цін з довідкової літератури. Значення коефіцієнта ринку регіону зазначається згідно з таблицею 3.2 додатка 3;
	<li>М - вартісний еквівалент суми податків, зборів, інших обов'язкових платежів під час митного оформлення згідно з чинним законодавством.
</ul>

<p>Середня ринкова ціна КТЗ (Сср), що перебував у користуванні, становить {$values.items[roll].market_price} грн.</p><br />

<h2 align="center">ВИСНОВОК</h2>
<p>Середня ринкова ціна аналогічного КТЗ {$values.items[roll].brand} {$values.items[roll].model}, складає: {$values.items[roll].market_price|moneyformat} грн. ({$values.items[roll].market_price|moneyformat:1:true}).</p><br /><br />

<table width="100%">
<tr>
	<td>Оцінювач:<br /><br /></td>
	<td align="right">Кубрак Ю.В.<br /><br /></td>
</tr>
</table>
{if $smarty.section.customer.last}
<div style="page-break-after: always"></div>
{/if}
{/section}
</body>
</html>