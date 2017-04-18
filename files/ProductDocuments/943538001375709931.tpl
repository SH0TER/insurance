<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Майно ипотека. Заявление</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>

<table cellspacing=0 cellpadding=0 width="100%">
	<tr>
		<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
		<td align="center">
			<h1 align="center">ЗАЯВА</h1>
			<h2 align="center">на страхування предмета іпотеки </h2><br /><br />		
			<p><b>Прошу укласти Договір обовязкового страхування нерухомого майна (нерухомості), що є предметом іпотеки, від ризків випадкового знищення, випадкового пошкодження або псування, на основі інформації, наведеної нижче:<b></p>
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

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>1. Заявник/Страхувальник</b></td>
		<td class="all">{$values.insurerTitle}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center" class="small">прізвище, ім'я, по батькові / повне найменування для юридичної особи</td>
	</tr>
	<tr>
		<td>Адреса проживання / юридична адреса:</td>
		<td class="all">{$values.insurer_address}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"> Ідент. код (код ЄДРПОУ) </td>
		<td width="44%" class="all">{if $values.insurer_person_types_id == 1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if}</td>
		<td width="9%" align="center">Тел./факс</td>
		<td class="all">{$values.insurer_phone}</td>
	</tr>
</table><br />

{if $values.insurer_person_types_id == 1}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Дата народження:</td>
		<td width="44%" class="all">{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td width="9%" align="center">E-mail</td>
		<td class="all">{if $values.insurer_email}{$values.insurer_email}{else}----{/if}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		{if $values.insurer_id_card == 1}
		<td width="20%">Дані ID-карти:</td>
		<td>№</td>
		<td class="all">{$values.insurer_newpassport_number}</td>
		<td align="center">від</td>
		<td class="all">{$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td align="center">дійсний до</td>
		<td class="all">{$values.insurer_newpassport_dateEnd|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td>орган що видав</td>
		<td class="all">{$values.insurer_newpassport_place}</td>
		<td>запис №</td>
		<td class="all">{$values.insurer_newpassport_reestr}</td>
		{else}
		<td width="20%">Паспортні дані:</td>
		<td>серія, №</td>
		<td class="all">{$values.insurer_passport_series} {$values.insurer_passport_number}</td>
		<td align="center">від</td>
		<td class="all">{$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td>виданий</td>
		<td width="50%" class="all">{$values.insurer_passport_place}</td>
		{/if}
	</tr>
</table><br />

 
{/if}
{if $values.insurer_person_types_id == 2}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">ПІБ керівника/уповноваженої особи, посада, на підставі чого діє</td>
		<td class="all">{if $values.insurer_person_types_id != 1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{if $values.insurer_position}, {$values.insurer_position}{/if}{if $values.insurer_ground}, {$values.insurer_ground}{/if}{else}---{/if}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Рахунок (для юр. особи)</td>
		<td>№</td>
		<td class="all">{if $values.insurer_bank_account}{$values.insurer_bank_account}{else}----{/if}</td>
		<td align="center">відкритий в</td>
		<td class="all">{if $values.insurer_bank}{$values.insurer_bank}{else}----{/if}</td>
		<td align="center">МФО</td>
		<td class="all">{if $values.insurer_bank_mfo}{$values.insurer_bank_mfo}{else}----{/if}</td>
	</tr>
</table><br />
{/if}


 
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="25%"><b>2. Вигодонабувач</b></td>
	<td class="all">{$values.assured_title}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">прізвище, ім'я, по батькові / повне найменування для юридичної особи</td>
</tr>
<tr>
	<td>Адреса проживання / Юридична адреса:</td>
	<td class="all">{$values.assured_address}</td>
</tr>
{if $values.assured_person_types_id == 1}
<tr>
		<td >Дата народження:</td>
		<td   class="left right bottom">{$values.assured_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
</tr>
{/if}
</table><br />
{if $values.financial_institutions_id==0}
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="25%">Банківські реквізити</td>
	<td width="10%">Рахунок №</td>
	<td class="all" width="30%">{if $values.assured_bank_account}{$values.assured_bank_account}{else}----{/if}</td>
	<td align="center">відкритий в</td>
	<td class="all">{if $values.assured_bank}{$values.assured_bank}{else}----{/if}</td>
	<td align="center">МФО</td>
	<td class="all">{if $values.assured_bank_mfo}{$values.assured_bank_mfo}{else}----{/if}</td>
</tr>
</table><br />
{/if}



<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Договір іпотеки № </td>
		<td class="all" width="20%">&nbsp;{$values.mortage_agreement_number}</td>
		<td width="5%" align="center"> від </td>
		<td class="all" width="10%">&nbsp;{if $values.mortage_agreement_number && $values.mortage_agreement_date}{$values.mortage_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}</td>
		<td></td>
	</tr>
</table><br />

 
 <table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>3. Місцезнаходження застрахованого майна</b></td>
		<td class="all">{$values.mortage_place}</td>
	</tr>
</table>
 <br>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>4. Строк страхування</b></td>
		<td class="all">з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	</tr>
</table>
<br>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"  rowspan="6"><b>5. Застраховане майно</b></td>
		<td class="all">
		 Будівля
		</td>
		<td class="right bottom top" width="30">{if $values.mortage_groups_id==1}Так{else}Нi{/if}</td>
	</tr>
	<tr>
	<tr>
	<td class="left bottom right">
	 Господарська будівля 
	</td>
	<td class="right bottom">{if $values.mortage_groups_id==3}Так{else}Нi{/if}</td>
	</tr>
	<tr>
	<td class="left bottom right">
		 Об’єкт незавершеного будівництва 
	</td>
	<td class="right bottom">{if $values.mortage_groups_id==4}Так{else}Нi{/if}</td>
	</tr>
	<tr>
	<td class="left bottom right">
	 Квартира 
	</td>
	<td class="right bottom">{if $values.mortage_groups_id==5}Так{else}Нi{/if}</td>
	</tr>
	<tr>
	<td class="left bottom right">
	 Земельна ділянка 
	</td>
	<td class="right bottom">{if $values.mortage_groups_id==6}Так{else}Нi{/if}</td>
	</tr>
 </table>

<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="20%" rowspan="3"><b>5.1. На страхування приймаються:</b></td>
	<td class="all">конструктивні елементи</td>
	<td width="30" class="top right bottom">{if $values.values.1}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">конструктивні елементи+інженерно-комунікаційні системи </td>
	<td class="right bottom">{if $values.values.2}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">конструктивні елементи+інженерно-комунікаційні системи+ внутрішнє оздоблення</td>
	<td class="right bottom">{if $values.values.3}Так{else}Нi{/if}</td>
</tr>
 <br>
</table><br>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>6. Страхова сума</b></td>
		<td class="all">{$values.price|moneyformat:-1} грн.</td>
	</tr>
</table><br>

<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="20%" rowspan="3"><b>7.  Регіон розташування застрахованого майна  :</b></td>
	<td class="all">АР Крим, Закарпатська, Одеська обл.</td>
	<td width="30" class="top right bottom">{if $values.values.4}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">Вінницька, Ів-Франківська, Кіровоградська, Львівська, Миколаївська, Тернопільська, Хмельницька, Чернівецька обл. </td>
	<td class="right bottom">{if $values.values.5}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">Інші області, крім зазначених вище</td>
	<td class="right bottom">{if $values.values.6}Так{else}Нi{/if}</td>
</tr>
 
</table>
<br>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>8. Рік побудови застрахованого майна</b></td>
		<td class="all">{$values.year} рік</td>
	</tr>
</table>

<br>

<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="20%" rowspan="6"><b>9.  Матеріал стін застрахованого майна</b></td>
	<td class="all">Залізобетон</td>
	<td width="30" class="top right bottom">{if $values.values.7}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">Металоконструкція</td>
	<td class="right bottom">{if $values.values.9}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left">Цегла</td>
	<td class="right bottom">{if $values.values.10}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left">Змішанний (дерево+цегла, дерево+метал)</td>
	<td class="right bottom">{if $values.values.11}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left">Дерево</td>
	<td class="right bottom">{if $values.values.12}Так{else}Нi{/if}</td>
</tr>
</table>
<br>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" colspan=2><b>10. Засоби пожежної безпеки </b></td>
		<td class=all width="30%">Наявність вогнегасників {if $values.fire_extinguishers_counts>0}- Так </td><td class="top right bottom">Кількість - {$values.fire_extinguishers_counts}{else}Нi{/if}</td>
	</tr>
</table>

<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="20%" rowspan="7"> &nbsp;</td>
	<td class="all">Наявність автоматичної системи пожежогасіння</td>
	<td width="30" class="top right bottom">{if $values.values.13 || $values.values.14 || $values.values.15 || $values.values.16 || $values.values.17}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left"> &nbsp; &nbsp; газова система</td>
	<td class="right bottom">{if $values.values.13}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left"> &nbsp; &nbsp; водна, пінна і водно-пінна система</td>
	<td class="right bottom">{if $values.values.14}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left"> &nbsp; &nbsp; порошкова система</td>
	<td class="right bottom">{if $values.values.15}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left"> &nbsp; &nbsp; аерозольна система</td>
	<td class="right bottom">{if $values.values.16}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left"> &nbsp; &nbsp; комбінована система</td>
	<td class="right bottom">{if $values.values.17}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left">Наявність протипожежної сигналізації</td>
	<td class="right bottom">{if $values.values.18}Так{else}Нi{/if}</td>
</tr>
</table>

<br><br>
<div style="page-break-after: always"></div>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td width="20%" rowspan="6"><b>11. Захист від протиправних дій</b></td>
	<td class="all">Наявність охоронної сигналізації</td>
	<td width="30" class="top right bottom">{if $values.values.19}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">Наявність системи відеоспостереження</td>
	<td class="right bottom">{if $values.values.20}Так{else}Нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left" colspan=2>Наявність засобів захисту</td>
</tr>
 <tr>
	<td class="right bottom left">&nbsp; &nbsp;Два і більше засобів захисти з переліку: грати, металеві двері, відеокамери, кодові замки</td>
	<td class="right bottom">{if $values.values.21}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left">&nbsp; &nbsp;Один засіб захисту з переліку: грати, металеві двері, відеокамери, кодові замки</td>
	<td class="right bottom">{if $values.values.22}Так{else}Нi{/if}</td>
</tr>
 <tr>
	<td class="right bottom left">&nbsp; &nbsp;Відсутність засобів захисту</td>
	<td class="right bottom">{if $values.values.23}Так{else}Нi{/if}</td>
</tr>
</table>
<br><br>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" rowspan=11><b>12. Перелік страхових ризиків: </b></td>
	<td class="right bottom left top">стихійне лихо</td>
</tr>
 
 <tr>
	<td class="right bottom left">пожежа</td>
</tr>
 
 <tr>
	<td class="right bottom left">вибух</td>
</tr>
 
 <tr>
	<td class="right bottom left">пошкодження димом</td>
</tr>


<tr>
	<td class="right bottom left">проведення робіт, пов'язаних з будівництвом/реконструкцією об'єктів нерухомості, розміщених поряд із застрахованим майном, або сусідніх приміщень, які не належать Страхувальнику</td>
</tr>
 
 <tr>
	<td class="right bottom left">падіння пілотованих літальних об'єктів, їх частин, вантажу та багажу, що ними перевозяться, а також розливання палива</td>
</tr>

<tr>
	<td class="right bottom left">зіткнення із застрахованим майном або наїзд на це майно технічних засобів, що рухаються під керуванням чи без керування людини та використовують для пересування будь-який вид енергії</td>
</tr>
 
 <tr>
	<td class="right bottom left">аварії в системах тепло-, водо-, газопостачання, в електричних мережах, виробничі аварії (зокрема, викид перегрітих мас, розповсюдження хвилі токсичних газів і парів, витікання агресивних речовин); </td>
</tr>

<tr>
	<td class="right bottom left">падіння стовпів, щогл освітлення, інших конструкцій, за винятком тих випадків, що виникли внаслідок їх неправильної установки або монтажу</td>
</tr>
 
 <tr>
	<td class="right bottom left">протиправні дії третіх осіб: хуліганство, крадіжка, грабіж, розбій, умисне знищення або пошкодження майна (вандалізм, підпал, підрив), за винятком зазначених дій, що сталися під час громадянської війни, народного хвилювання, страйку або внаслідок терористичного акту</td>
</tr>

 <tr>
	<td class="right bottom left">вплив води та/або інших рідин у разі виникнення аварії (в тому числі пошкодження, розрив, замерзання) систем водопостачання, каналізації, опалювальних систем і систем пожежогасіння та/або проникнення води та/або інших рідин із сусідніх приміщень</td>
</tr>


</table>



<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="100%"><b>13. До заяви додаються: </b></td>
	</tr>
<tr>
<td width="100%">
13.1. копія акту оцінки майна/звіту про оцінку майна (у разі наявності);																															
</td>
</tr>
<tr>
<td width="100%">
13.2. копія іпотечного договору;																															
</td>
</tr>
<tr>
<td width="100%">
13.3. копії правовстановлюючих та технічних документів на майно, що підлягає страхуванню.																															
</td>
</tr>
</table>








<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>14. Декларація Страхувальника</b></td>
	<td class="all">
	Я заявляю, що ознайомлений з умовами Порядку і правил обов'язкового страхуdання предмету іпотеки від ризиків випадкового знищення, випадкового пошкодження або псування, затверджених Постановою Кабінету Міністрів України від 06.04.2011 р. №358. Всі приведені вище твердження і свідчення являються правдивими і ніяка інформація щодо об'єкту страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору страхування і буде його невід’ємною частиною.
	<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про об’єкт страхування, надана в цій заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
	<p>Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання моїх персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки.                                                                                                                 У разі укладання Договору я надаю свою згоду на договір не списання коштів у випадку ненадходження страхового платежу в зазначені в Договорі строки та терміни.
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%" border=0>
	<tr>
		<td width="15%" align="left">Заяву заповнив&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td width="30%" class="bottom">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
		<td width="7%" align="center">&nbsp;/&nbsp;</td>
		<td width="10%" class="bottom">&nbsp;</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td width="20%" >&nbsp;</td>
	</tr>
	<tr><td colspan="6">&nbsp;</td></tr>
	<tr>
		<td align="left">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td class="bottom">{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}</td>
		<td align="center">&nbsp;/&nbsp;</td>
		<td class="bottom">&nbsp;</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td  >&nbsp;</td>
	</tr>
</table>

</body>
</html>