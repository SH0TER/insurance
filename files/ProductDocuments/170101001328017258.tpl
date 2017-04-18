<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Майно. Заявление</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1 align="center">ЗАЯВА-ОПИТУВАЛЬНИК</h1>
		<h2 align="center">на страхування майна юридичних осіб</h2><br /><br />
		
		
		<p>На підставі наданих мені повноважень прошу укласти Договір добровільного страхування майна юридичних осіб на основі інформації, наведеної нижче:</p>
	</td>
	<td width="230" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
	<td align="right">
		<p>№ {$values.number}</p>
		<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>
<h1 align="center">I. ЗАГАЛЬНІ ВІДОМОСТІ</h1>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>1. Заявник/Страхувальник</b></td>
	<td class="all">{$values.insurerTitle}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">назва організації</td>
</tr>
<tr>
	<td>Юридична адреса:</td>
	<td class="all">{$values.insurer_address}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%">Ідент. код (код ЄДРПОУ)</td>
	<td width="44%" class="all">{if $values.person_types_id == 1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if}</td>
	<td width="9%" align="center">Тел./факс</td>
	<td class="all">{$values.insurer_phone}</td>
</tr>
</table><br />

{if $values.person_types_id == 2}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%">ПІБ керівника/уповноваженої особи, посада, на підставі чого діє</td>
	<td class="all">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{if $values.insurer_position}, {$values.insurer_position}{/if}{if $values.insurer_ground}, {$values.insurer_ground}{/if}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>				 
	<td width="25%">Банківські реквізити</td>
	<td>Рахунок №</td>
	<td class="all">{if $values.insurer_bank_account}{$values.insurer_bank_account}{else}----{/if}</td>
	<td align="center">відкритий в</td>
	<td class="all">{if $values.insurer_bank}{$values.insurer_bank}{else}----{/if}</td>
	<td align="center">МФО</td>
	<td class="all">{if $values.insurer_bank_mfo}{$values.insurer_bank_mfo}{else}----{/if}</td>
</tr>
</table><br />
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>2. Вигодонабувач</b></td>
	<td class="all">{$values.assured_title}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">прізвище, ім'я, по батькові (назва організації)</td>
</tr>
<tr>
	<td>Юридична адреса:</td>
	<td class="all">{$values.assured_address}</td>
</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%">Банківські реквізити</td>
	<td width="25%">Рахунок №</td>
	<td class="all">{if $values.assured_bank_account}{$values.assured_bank_account}{else}----{/if}</td>
	<td align="center">відкритий в</td>
	<td class="all">{if $values.assured_bank}{$values.assured_bank}{else}----{/if}</td>
	<td align="center">МФО</td>
	<td class="all">{if $values.assured_bank_mfo}{$values.assured_bank_mfo}{else}----{/if}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%">Договір про заставу</td>
	<td width="25%">Рахунок №</td>
	<td class="all">{if $values.pawn_agreement_number}{$values.pawn_agreement_number}{else}----{/if}</td>

	<td align="center">від</td>
	<td class="all">{if $values.pawn_agreement_number}{$values.pawn_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{else}----{/if}</td>
</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%">Кредитний договір</td>
	<td width="25%">Рахунок №</td>
	<td class="all">{if $values.credit_agreement_number}{$values.credit_agreement_number}{else}----{/if}</td>
	<td align="center">від</td>
	<td class="all">{if $values.credit_agreement_number}{$values.credit_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{else}----{/if}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>3. Територія дії Договору</b></td>
	<td class="all">{$values.zones_title}</td>
</tr>
</table><br />


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>4. Період дії Договору / Строк страхування</b></td>
	<td>з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table>
{section name="roll" loop=$values.objects}
{assign var=object value=$values.objects[roll]}
<h1 align="center">II. ОБ'ЄКТ СТРАХУВАННЯ</h2>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>5. Об'єкт страхування</b></td>
<td>
		<table cellspacing=0 cellpadding=2 width="100%">
		<tr>{if $object.object_type==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Будинки, споруди, приміщення: </td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		{if $object.object_type==1}
		<tr>{if $object.construction_types_id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">тільки контрукція</td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.construction_types_id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">конструкції з невід'ємним комунікаціями</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.construction_types_id==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">конструкції з невід'ємним комунікаціями + оздоблення</td><td>{$txt|output_propertfield}</td>
		</tr>
		{/if}
		<tr>{if $object.object_type==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Обладнання</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_type==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Товарно-матеріальні цінності</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_type==4}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Вміст</td><td>{$txt|output_propertfield}</td>
		</tr>
		</table>
</td>
</tr>
</table>
{assign var=sklad value=0}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>6. Тип об'єкта страхування</b></td>
<td>
		<table cellspacing=0 cellpadding=2 width="100%">
		{if $object.object_type==1}
		<tr>
		<td><b>Будинки, споруди, приміщення:</b> </td><td></td>
		</tr>
		<tr>{if $object.houses_types_id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Адміністративне</td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.houses_types_id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Промислове</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.houses_types_id==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Житлове</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.houses_types_id==4}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Торгове</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.houses_types_id==5}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Торгово-розважальне</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.houses_types_id==6}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Розважальне</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.houses_types_id==7}{assign var=txt value='Так'}{assign var=sklad value=1}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Склад</td><td>{$txt|output_propertfield}</td>
		</tr>
		{/if}
		
		{if $object.object_type==2}
		<tr> 
		<td><b>Обладнання:</b> </td><td></td>
		</tr>
		<tr>{if $object.equipments_types_id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Виробниче</td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.equipments_types_id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Технологічне</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.equipments_types_id==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Торгівельне</td><td>{$txt|output_propertfield}</td>
		</tr>
		{/if}
		{if $object.object_type==3}
		<tr>
		<td><b>ТМЦ:</b> </td><td></td>
		</tr>
		<tr>{if $object.tmc_types_Id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Сировина</td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.tmc_types_Id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Готова продукція</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.tmc_types_Id==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Матеріали</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.tmc_types_Id==4}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Запаси товарів</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.tmc_types_Id==5}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Напівфабрикати</td><td>{$txt|output_propertfield}</td>
		</tr>
		{/if}
		{if $object.object_type==4}
		<tr>
		<td><b>ВМІСТ:</b> </td><td></td>
		</tr>
		<tr>{if $object.contents_types_id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">електронно-обчислювальна техніка, пристрої передачі інформації, оргтехніка</td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.contents_types_id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">предмети інтер'єру, офісне обладнання, меблі, інвентар, технологічне оснащення</td><td>{$txt|output_propertfield}</td>
		</tr>
		{/if}
		</table>
</td>
</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>7. Вид діяльності організації</b></td>
	<td class="all">{if $values.organizationTypesTitle}{$values.organizationTypesTitle}{else}{$values.organization_types_other}{/if}</td>
</tr>
</table><br>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>8. Назва об'єкта страхування </b></td>
	<td class="all">{$object.title}</td>
</tr>
</table>
<br>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>9. Призначення об'єкта страхування</b></td>
	<td class="all">{$object.object_purpose}</td>
</tr>
</table>
<br>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" valign="top"><b>10. Тип будівлі/споруди, де знаходиться об'єкт страхування</b></td>
<td>
		{if $object.object_type==2 || $object.object_type==3 || $object.object_type==4}
		<table cellspacing=0 cellpadding=2 width="100%">
		<tr>{if $object.object_houses_types_id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Адміністративне</td><td width="100">{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_houses_types_id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Промислове</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_houses_types_id==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Житлове</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_houses_types_id==4}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Торгове</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_houses_types_id==5}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Торгово-розважальне</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_houses_types_id==6}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Розважальне</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.object_houses_types_id==7}{assign var=txt value='Так'}{assign var=sklad value=1}{else}{assign var=txt value='Нi'}{/if}
		<td style="padding-left:20px">Склад</td><td>{$txt|output_propertfield}</td>
		</tr>
		</table>
		{else}
		---
		{/if}
</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>11. Тип складу</b></td>
	<td>
		{if $sklad==1}
		<table width=100%>
		<tr>{if $object.stock_type_id==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td>А. спеціальне виділене та обладнане приміщення</td>
			<td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.stock_type_id==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td>В.відкритий майданчик</td>
			<td>{$txt|output_propertfield}</td>
		</tr>
		</table>
		{else}
		----
		{/if}
	</td>
</tr>
</table>
<br>

{if $sklad==1}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" align=right><b>Якщо В.</b></td>
	<td>
		<table width=100%>

		<tr>
			<td width="50%">Загальна площа території</td>
			<td class="all">{if $object.stock_area}{$object.stock_area}{else}---{/if}</td>
		</tr>
		<tr>
			<td width="50%">Вид огорожі</td>
			<td class="all">{if $object.barrier_type}{$object.barrier_type}{else}---{/if}</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<br>
{/if}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>12. Загальна площа складу</b></td>
	<td class="all">{if $object.total_stock_area}{$object.total_stock_area}{else}---{/if}</td>
</tr>
</table>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>13. Умови зберігання складських запасів</b></td>
<td>
	{if $object.object_type==3}
		<table cellspacing=0 cellpadding=2 width="100%">

		<tr>{if $object.other_person_goods==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td width="50%">Чи зберігаються на триторії складу товари, які належать іншим особам</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>
		<td>Чи обмежено доступ власників таких товарів до товарів, що належать заявнику і яким чином</td><td>{$object.other_person_goods_access|output_propertfield}</td>
		</tr>
		<tr>{if $object.stock_load_unload==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Чи здійснюється на теритоії складу завантаження/розвантаження</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>
		<td>Яким чином здійснюються такі операції</td><td>{$object.stock_load_unload_type|output_propertfield}</td>
		</tr>
		<tr>
		<td>Кількість зовнішніх входів до складських приміщень</td><td>{$object.doors_count|output_propertfield}</td>
		</tr>
		<tr>
		<td>Кількість персоналу, щопрацює на території складу</td><td>{$object.personal_count|output_propertfield}</td>
		</tr>
		<tr>{if $object.fire_substances==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Наявніть на складі вогненебезпечних речовин</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>
		<td>назва речовини</td><td>{$object.substance_name|output_propertfield}</td>
		</tr>
		<tr>
		<td>тип (рідина, газ, тверда)</td><td>{$object.substance_type|output_propertfield}</td>
		</tr>
		<tr>
		<td>кількість</td><td>{$object.substance_amount|output_propertfield}</td>
		</tr>
		<tr>
		<td>спосіб зберігання</td><td>{$object.substance_storing_type|output_propertfield}</td>
		</tr>
		<tr>
		<td>особливі засоби безпеки</td><td>{$object.safety_futures|output_propertfield}</td>
		</tr>
		</table>
	{else}	
	---
	{/if}
</td>
</tr>
</table><br />
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%"><b>14. Характеристика складських приміщень/території, де зберігаються складські запаси</b></td>
<td>
	{if $object.object_type==3}
		<table cellspacing=0 cellpadding=2 width="100%">

		<tr>
		<td width="60%">Висота стелажів</td><td>{$object.racking_height|output_propertfield}</td>
		</tr>
		<tr>
		<td>Ширина проходів</td><td>{$object.passess_width|output_propertfield}</td>
		</tr>
		<tr>
		<td>Загальна площа складу</td><td>{$object.total_stock_area1|output_propertfield}</td>
		</tr>
		<tr>
		<td>Ступінь захисту</td><td>{$object.defense_type|output_propertfield}</td>
		</tr>
		<tr>
		<td>Чи дозволяється особам, які не працюють на складі, перебувати на території складу</td><td>{$object.person_on_stock|output_propertfield}</td>
		</tr>
		
		</table>
	{else}	
	---
	{/if}	
</td>
</tr>
</table> 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>15. Загальна площа будівлі</b></td>
	<td>{$object.total_house_area|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>16.  Площа об'єкта</b></td>
	<td>{$object.object_area|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>17. Площа приміщення, де знаходиться обладнання</b></td>
	<td>{$object.object_equipment_area|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>18. Скільки поверхів у будівлі</b></td>
	<td>{$object.floor_count|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>19. На якому поверсі розташований об'єкт</b></td>
	<td>{$object.object_floor|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>20. Вік будівлі/складу</b></td>
	{assign var=txt value=''}
	{if $object.house_years==1}{assign var=txt value='до 1 року'}{/if}
	{if $object.house_years==2}{assign var=txt value='від 1 до  5 років'}{/if}
	{if $object.house_years==3}{assign var=txt value='від 5 до 20 років'}{/if}
	{if $object.house_years==4}{assign var=txt value='від 20 до 50 років'}{/if}
	{if $object.house_years==5}{assign var=txt value='від 50 років'}{/if}
	<td>{$txt|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>21. Вік обладнання</b></td>
	{assign var=txt value=''}
	{if $object.equipment_years==1}{assign var=txt value='до 1 року'}{/if}
	{if $object.equipment_years==2}{assign var=txt value='від 1 до  5 років'}{/if}
	{if $object.equipment_years==3}{assign var=txt value='від 5 до 20 років'}{/if}
	{if $object.equipment_years==4}{assign var=txt value='від 20'}{/if}
	<td>{$txt|output_propertfield}</td>
</tr>
</table> 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>22. Досвід персоналу, що має доступ до обладнання</b></td>
	<td>{$object.staff_experience|output_propertfield}</td>
</tr>
</table> 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>23. Місцезнаходженния об'єкта страхування</b></td>
	<td>{$object.object_location|output_propertfield}</td>
</tr>
</table> 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>24. Додаткова інформація про об'єкт страхування</b></td>
	<td>{$object.additional_info|output_propertfield}</td>
</tr>
</table>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>25. Сусідні об'єкти</b></td>
	<td> </td>
</tr>
<tr>
	<td width="25%" style="padding-left:10px">відстань до об'єкта страхування</td>
	<td> 
	
		<table width="100%">
		<tr>{if $object.distance_object_lt20==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td>менше 20 м</td>
			<td>{$txt|output_propertfield}</td>
			<td width="80%">{$object.objtype1|output_propertfield}</td>
		</tr>
		<tr>{if $object.distance_object_gt20==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td>більше 20 м</td>
			<td>{$txt|output_propertfield}</td>
			<td>{$object.objtype2|output_propertfield}</td>
		</tr>
		</table>

	
	</td>
</tr>
</table>
 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>26. Матеріал</b></td>
<td>
		<table cellspacing=0 cellpadding=2 width="100%">

		<tr>
		<td width=20%>Стін</td><td>{$object.wallmaterial|output_propertfield}</td>
		</tr>
		<tr>
		<td>Крівлі</td><td>{$object.roofmaterial|output_propertfield}</td>
		</tr>
		<tr>
		<td>Фундаменту</td><td>{$object.footingmaterial|output_propertfield}</td>
		</tr>
		<tr>
		<td>Перекриттів</td><td>{$object.overlapmaterial|output_propertfield}</td>
		</tr>
		<tr>
		<td>Оздоблення</td><td>{$object.decorationmaterial|output_propertfield}</td>
		</tr>
		
		</table>
</td>
</tr>
</table> 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>27. Забезпечуючі системи</b></td>
<td>
		<table width=80%>
		<tr>
			<td>Водопровідна</td>
			{if $object.water_system==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">центральна</td><td>{$txt|output_propertfield}</td>
			{if $object.water_system==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">місцева</td><td>{$txt|output_propertfield}</td>
			{if $object.water_system==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">власна</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>
			<td>Електрична</td>
			{if $object.electric_sytem==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">центральна</td><td>{$txt|output_propertfield}</td>
			{if $object.electric_sytem==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">місцева</td><td>{$txt|output_propertfield}</td>
			{if $object.electric_sytem==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">власна</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>
			<td>Каналізаційна</td>
			{if $object.sewage_system==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">центральна</td><td>{$txt|output_propertfield}</td>
			{if $object.sewage_system==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">місцева</td><td>{$txt|output_propertfield}</td>
			{if $object.sewage_system==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">власна</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>
			<td>Опалювальна</td>
			{if $object.heating_system==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">центральна</td><td>{$txt|output_propertfield}</td>
			{if $object.heating_system==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">місцева</td><td>{$txt|output_propertfield}</td>
			{if $object.heating_system==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
			<td align="right">власна</td><td>{$txt|output_propertfield}</td>
		</tr>
		</table>

</td>
</tr>
</table> 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>28. Вогнестійкість несучих об'ектів</b></td>
<td>
		<table cellspacing=0 cellpadding=2 width="50%">

		<tr>{if $object.fire_objects==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Негорючі</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.fire_objects==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Важкозаймисті</td><td>{$txt|output_propertfield}</td>
		</tr>
		<tr>{if $object.fire_objects==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Легкозаймисті</td><td>{$txt|output_propertfield}</td>
		</tr>
		
		
		</table>
</td>
</tr>
</table> 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
<td width="25%" valign="top"><b>28. Засоби пожежної безпеки</b></td>
<td>
		<table cellspacing=0 cellpadding=2 width="100%">

		<tr>{if $object.extinguisher==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td width="30%">Вогнегасник</td><td width="30%">{$txt|output_propertfield}</td><td width="25%"></td><td width="25%"></td>
		</tr>
		{if $object.extinguisher==1}
		<tr>
		<td>кількість</td><td>{$object.extinguisher_count|output_propertfield}</td><td align="right">марка</td><td>{$object.extinguisher_type|output_propertfield}</td>
		</tr>
		{/if}
		<tr>{if $object.sprinklers==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Спринклери</td><td>{$txt|output_propertfield}</td><td></td><td></td>
		</tr>
		{if $object.sprinklers==1}
		<tr>
		<td>Джерело води для спринклерів</td><td>{$object.sprinklers_source|output_propertfield}</td><td></td><td></td>
		</tr>
		{/if}
		<tr>{if $object.fire_alarm==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td>Протипожежна сигналізація</td><td>{$txt|output_propertfield:135}</td><td></td><td></td>
		</tr>
		{if $object.fire_alarm==1}
		<tr>
		<td> </td><td>тип датчиків</td><td></td><td></td>
		</tr>
		<tr>{if $object.sensor_heat==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td> </td><td style="padding-left:10px">тепло</td><td>{$txt|output_propertfield}</td><td></td>
		
		</tr>
		<tr>{if $object.sensor_smoke==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td> </td><td style="padding-left:10px">дим</td><td>{$txt|output_propertfield}</td><td></td>
		
		</tr>
		<tr>{if $object.sensor_fire==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td> </td><td style="padding-left:10px">вогонь</td><td>{$txt|output_propertfield}</td><td></td>
		
		</tr>
		{/if}
		
		<tr>
		<td> </td><td>Передача сигналу тривоги</td><td></td><td></td>
		</tr>
		<tr>{if $object.signal_remote_state==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td> </td><td style="padding-left:10px">на пульт державної пожежної частини</td><td>{$txt|output_propertfield}</td><td></td>
		
		</tr>
		<tr>{if $object.signal_enterprise==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
		<td> </td><td style="padding-left:10px">на контрольний пункт на підприємстві</td><td>{$txt|output_propertfield}</td><td></td>
		
		</tr>
		
		<tr>
		<td> </td><td>Відстань до державної пожежної частини</td><td>{$object.distance_fire|output_propertfield}</td><td></td>
		</tr>
		<tr>
		<td> </td><td> Час до державної пожежної частини</td><td>{$object.time_fire|output_propertfield}</td><td></td>
		</tr>
		
		<tr>
		<td> Відсутня (вказати причину) </td><td colspan=3> {$object.no_alarm|output_propertfield}</td> 
		</tr>
		
		<tr>
		<td> Інше</td><td colspan=3> {$object.other_alarm|output_propertfield}</td> 
		</tr>
		</table>
</td>
</tr>
</table> 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>{if $object.has_lightning==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>29. Наявність блискавковідводів</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" valign="top"><b>30. Захист від протиправних дій</b></td>
	<td>
	
			<table width=100%>
			<tr>
				<td width="35%">Наявність сигналізації</td>
				{if $object.has_pdto_alarm==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td width="15%">{$txt|output_propertfield}</td>
				<td width="35%" colspan=2>&nbsp;</td>
				<td width="15%" colspan=2>&nbsp;</td>
			</tr>
			{if $object.has_pdto_alarm==1}
			<tr>{if $object.manual_pdto==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td style="padding-left:10px">ручна</td>
				<td>{$txt|output_propertfield}</td>
				<td colspan=2>&nbsp;</td>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>{if $object.automatic_pdto==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td style="padding-left:10px">автоматична</td>
				<td>{$txt|output_propertfield}</td>
				<td colspan=2></td>
				<td colspan=2></td>
			</tr>
				<tr>
				<td><td>&nbsp;</td></td>
				<td></td>
				<td colspan=2></td>
				<td colspan=2></td>
			</tr>
			{/if}
			<tr>
				<td>Наявність охорони</td>
				{if $object.has_protection==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td colspan=2></td>
				<td colspan=2></td>
			</tr>
			{if $object.has_protection==1}
			<tr>
				<td style="padding-left:10px">державна (МВС)</td>
				{if $object.mvs_protection==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td >кількість охоронців на зміні</td>
				<td width=50>{$object.mvs_guards|output_propertfield}</td>
				<td align="right" >кількість обходів</td>
				<td width=100>{$object.mvs_detours|output_propertfield}</td>
			</tr>
			<tr>
				<td style="padding-left:10px">озброєна охорона (ООХР)</td>
				{if $object.ooxp_protection==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td>кількість охоронців на зміні</td>
				<td>{$object.ooxp_guards|output_propertfield}</td>
				<td align="right">кількість обходів</td>
				<td>{$object.ooxp_detours|output_propertfield}</td>
			</tr>
			<tr>
				<td style="padding-left:10px">відомча невоєнізована</td>
				{if $object.nonmilitary_protection==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td>кількість охоронців на зміні</td>
				<td>{$object.nonmilitary_guards|output_propertfield}</td>
				<td align="right">кількість обходів</td>
				<td>{$object.nonmilitary_detours|output_propertfield}</td>
			</tr>
			<tr>
				<td style="padding-left:10px">приватна</td>
				{if $object.private_protection==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td>кількість охоронців на зміні</td>
				<td>{$object.private_guards|output_propertfield}</td>
				<td align="right">кількість обходів</td>
				<td>{$object.private_detours|output_propertfield}</td>
			</tr>
			<tr>
				<td style="padding-left:10px">броньовані вхідні двері</td>
				{if $object.armored_doors==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="padding-left:10px">огорожа, паркан</td>
				{if $object.fense==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>{$txt|output_propertfield}</td>
				<td></td>
				<td></td>
			</tr>
			{/if}
			<tr>
			{if $object.no_protection==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>відсутня</td>
				<td>{$txt|output_propertfield}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="padding-left:20px">вкажіть причину</td>
				<td colspan=3>{$object.no_protection_reason|output_propertfield}</td>

			</tr>
				<tr>
				<td><td>&nbsp;</td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>{if $object.cctvsystem==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Система відеоспостереження</td>
				<td>{$txt|output_propertfield}</td>
				<td></td>
				<td></td>
			</tr>
			{if $object.cctvsystem==1}
			<tr>{if $object.cctv_territory==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td style="padding-left:10px">на території</td>
				<td>{$txt|output_propertfield}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>{if $object.cctvindoors==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td style="padding-left:10px">в приміщенні</td>
				<td>{$txt|output_propertfield}</td>
				<td></td>
				<td></td>
			</tr>
			{/if}
			</table>
	
	
	</td>
</tr>
</table>
<h1 align="center">III. СТРАХОВІ РИЗИКИ</h1>
<h2>ОСНОВНІ РИЗИКИ</h2>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" valign="top"><b>32. Вогневі ризики</b></td>
	<td>
			<table width=100%> 

			<tr>{if $object.risks.15}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>пожежа</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.34}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>удар блискавки</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.35}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>вибух</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.36}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>падіння літальних апаратів та їх уламків</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			</table>
	</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" valign="top"><b>33. Дія води</b></td>
	<td>
			<table width=100%> 

			<tr>{if $object.risks.26}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Витікання води з водопровідних, каналізаційних, опалювальних та протипожежних систем внаслідок їх розриву або переповнення, в тому числі проникнення рідин із сусідніх приміщень з будь-яких причин</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.37}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Помилкове включення автоматичної системи пожежогасіння</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			</table>
	</td>
</tr>
</table>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" valign="top"><b>34. Стихійні лиха</b></td>
	<td>
			<table width=100%> 

			<tr>{if $object.risks.16}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Буря, ураган, шквал, смерч</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.17}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Сильний дощ, сильна злива, тривалі дощі, сильні снігопади</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.18}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Паводок, затоплення, підтоплення</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.19}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Град</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			
			<tr>{if $object.risks.20}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Зсув, обвал</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.21}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Снігове налипання (відкладання снігу)</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.22}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Гірські обвали, схід лавин</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.23}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Землетрус</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.24}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Тиск снігового покрову </td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.risks.25}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Виверження вулкану </td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			</table>
	</td>
</tr>
</table>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>{if $object.risks.38}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>35. Протиправні дії третіх осіб (ПДТО)</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>{if $object.risks.28}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>36. Крадіжка</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>{if $object.risks.29}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>37. Грабіж</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>{if $object.risks.30}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>38. Розбій</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>{if $object.risks.32}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>39.Транспортна шкода</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>

<h2>ДОДАТКОВЕ СТРАХОВНЕ ПОКРИТТЯ</h2>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="35%"><b>40. Витрати, що пов'язані з гасінням пожежі та іншими заходами по ліквідації страхового випадку, спрямовані на зменшення наслідків страхового випадку</b></td>
	{if $object.fire_expenses==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%">{$txt|output_propertfield}</td>
	 <td align="right">Лiмiт</td> <td>{$object.fire_expenses_limit|output_propertfield}</td>
	 <td> </td> <td> </td>
</tr>

<tr>
	<td width="35%"><b>41. Витрати по розчищенню території, зламу і розбору руїн, вивезенню сміття, утилізації залишків майна та ін.</b></td>
	{if $object.cleaning_expenses==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td>{$txt|output_propertfield}</td>
	 <td align="right">Лiмiт</td> <td>{$object.cleaning_expenses_limit|output_propertfield}</td>
	 <td> </td> <td></td>
</tr>

<tr>
	<td width="35%"><b>42. Бій скла , вітрин, вітражів, скляних стін, віконних та дверних рам</b></td>
	{if $object.glasses_expenses==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td>{$txt|output_propertfield}</td>
	 <td align="right">Лiмiт</td> <td>{$object.glasses_expenses_limit|output_propertfield}</td>
	 {if $object.glasses_expenses_deductible}{assign var=txt value="`$object.glasses_expenses_deductible`%"}{else}{assign var=txt value=''}{/if}
	 <td align="right">Франшиза</td> <td>{$txt|output_propertfield}</td>
</tr>

<tr>
	<td width="35%"><b>43. Пошкодження або знищення предметів, закріплених на зовнішній стороні застрахованої будівлі (антени, світлові рекламні установки, плакатні щити, навіси, навіси вітрин і ін.)</b></td>
	{if $object.damage_expenses==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td>{$txt|output_propertfield}</td>
	 <td align="right">Лiмiт</td> <td>{$object.damage_expenses_limit|output_propertfield}</td>
	 {if $object.damage_expenses_deductible}{assign var=txt value="`$object.damage_expenses_deductible`%"}{else}{assign var=txt value=''}{/if}
	 <td align="right">Франшиза</td> <td>{$txt|output_propertfield}</td>

</tr>

<tr>
	<td width="35%"><b>44. Збитки від перерви у виробництві</b></td>
	{if $object.interruption_expenses==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td>{$txt|output_propertfield}</td>
	 <td align="right">Лiмiт</td> <td>{$object.interruption_expenses_limit|output_propertfield}</td>
	 {if $object.interruption_expenses_deductible}{assign var=txt value="`$object.interruption_expenses_deductible`%"}{else}{assign var=txt value=''}{/if}
	 <td align="right">Франшиза</td> <td>{$txt|output_propertfield}</td>

</tr>
</table>
<h1 align="center">IV. Умови страхування</h1>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>45. Метод визначення вартості майна</b></td>
	<td> </td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"> &nbsp; </td>
	<td>
			<table width=100%> 

			<tr>{if $object.method_property_cost==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Дійсна вартість</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.method_property_cost==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Відновлювальна вартість</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.method_property_cost==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Балансова вартість</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.method_property_cost==4}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Оціночна вартість</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			
			<tr>{if $object.method_property_cost==5}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Заявлена вартість</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			
			</table>
	</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>46. Майно приймається на страхування</b></td>
	<td> </td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"> &nbsp; </td>
	<td>
			<table width=100%> 

			<tr>{if $object.property_accepted_type==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td width="60%">В повному обсязі</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.property_accepted_type==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Відновлювальна вартість</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.property_accepted_type==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Вибірково</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.property_accepted_type==4}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Перший ризик</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			
			<tr>
				<td>Страхова сума відповідає (% від вартості майна)</td>
				<td>{$object.insured_responsible_sum|output_propertfield}</td>
			</tr>
			
			</table>
	</td>
</tr>
</table>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>47. Форма власності об'єкту страхування</b></td>
	<td> </td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"> &nbsp; </td>
	<td>
			<table width=100%> 

			<tr>{if $object.property_ownership==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td width="60%">Власний</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.property_ownership==2}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>Орендований</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr>{if $object.property_ownership==3}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
				<td>В лізингу</td>
				<td>{$txt|output_propertfield}</td>
			</tr>
			<tr> 
				<td>Інше</td>
				<td>{$object.property_ownership_other|output_propertfield}</td>
			</tr>
			
			
			
			</table>
	</td>
</tr>
</table>
<table cellspacing=0 cellpadding=2 width="100%">
	<tr align=center>
	<td class="all" nowrap>Об'єкт страхування</td>
	<td class="top right bottom">Вартість об'єкта страхування </td>
	<td class="top right bottom">Страхова сума/<br />(ліміт відповідальності страховика), грн.</td>
	<td class="top right bottom">Безумовна франшиза</td>

	</tr>
{section name="roll1" loop=$object.items}
<tr>
	<td class="right bottom left">{$object.items[roll1].title}</td>
	

	<td class="right bottom" align="right">{$object.items[roll1].cost|moneyformat:-1}</td> 
	
	<td class="right bottom" align="right">{$object.items[roll1].price|moneyformat:-1}</td>
	<td class="right bottom" align="right">{if $object.items[roll1].absolute == 1}{$object.items[roll1].value|moneyformat}{else}{$object.items[roll1].value}%{/if}</td>
</tr>
{/section}
</table>

<h1 align="center">V. Додаткова інформація </h1>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all"> {if $object.additional}{$object.additional}{else}&nbsp;{/if}</td>
</tr>
</table>
<h1 align="center">V. Заключні положення </h1>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>48. Попередній/поточний страховик</b></td>
	<td> {$object.prev_insurer|output_propertfield:205}</td>
</tr>
<tr>{if $object.last5_loses==1}{assign var=txt value='Так'}{else}{assign var=txt value='Нi'}{/if}
	<td width="25%"><b>49. Дані про збитки за останні 5 (п'ять) років</b></td>
	<td>{$txt|output_propertfield}</td>
</tr>
</table>
{if $object.last5_loses==1}
<table cellspacing=0 cellpadding=2 width="100%">
	<tr align=center>
	<td class="all" nowrap>Дата</td>
	<td class="top right bottom">Коротка характеристика</td>
	<td class="top right bottom">Сума збитку, ким виплачено</td>
	</tr>
{section name="roll2" loop=$object.loses}
<tr>
	<td class="right bottom left" align="center">{$object.loses[roll2].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td class="right bottom">{if $object.loses[roll2].text}{$object.loses[roll2].text}{else}&nbsp;{/if}</td> 
	<td class="right bottom" align="right">{$object.loses[roll2].amount|moneyformat:-1}</td> 
</tr>
{/section}
</table>
{/if}
<br>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%"><b>50. Декларація Страхувальника</b></td>
	<td class="all">
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «ЕКСПРЕС СТРАХУВАННЯ». Всі приведені вище твердження і свідчення являються правдивими і ніяка інформація щодо об'єкту страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору (полісу, сертифікату) страхування і буде його невід’ємною частиною.
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про об’єкт страхування, надана в цій заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="25%" align="right">Заяву заповнив&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="30%" class="bottom">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	<td width="7%" align="center">&nbsp;/&nbsp;</td>
	<td width="10%" class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="25%" class="all">&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom">{if $values.ground_kasko}{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}{else}Скрипник О.О.{/if}</td>
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="all">&nbsp;</td>
</tr>
</table>
{/section}

</body>
</html>