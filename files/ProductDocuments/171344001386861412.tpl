﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Заявление Сезон +</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>

<table cellspacing=0 cellpadding=0 width="100%">
	<tr>
		<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
		<td align="center">
			<h1 align="center">ЗАЯВА</h1>
			<h2 align="center">на страхування транспортного засобу
			на добровільне комплексне страхування наземних транспортних засобів 
			</h2><br /><br />		
			<p><b>Прошу укласти договір страхування транспортного засобу (ТЗ) згідно наведеної нижче інформації.<b></p>
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
		<td align="center" class="small">прізвище, ім'я, по батькові (назва організації)</td>
	</tr>
	<tr>
		<td>Адреса:</td>
		<td class="all">{$values.insurer_address}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">{if $values.retail}Ідент. код (код ЄДРПОУ){else}Ідентифікаційний код{/if}</td>
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

{if $values.insurer_person_types_id == 1}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="100%"><b>Ідентифікація Заявника</b></td>
	</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td rowspan="3" class="all"  width="150">Я є фізичною особою-підприємцем</td>
		<td rowspan="3" class="top bottom right"  width="30">{if $values.fop}так{else}ні{/if}</td>
		<td rowspan="3" class="top bottom right"  width="250">Подаю виписку або витяг з Єдиного державного реєстру юридичних осіб та фізичних осіб - підприємців</td>
		<td rowspan="3" class="top bottom right"  width="30">{if $values.give_a_statement}так{else}ні{/if}</td>
		<td rowspan="3" class="top bottom right" width="200">Характер та зміст діяльності</td>
		<td class="top bottom right" width="30">{if $values.give_a_statement}X{else}---{/if}</td>
		<td class="top bottom right">згідно виписки</td>
	</tr>
	<tr>
		<td rowspan="2"  class="bottom right">&nbsp;</td>
		<td  class="bottom right"  width="200">інше (вказати)</td>
	</tr>
	<tr>
		<td  class="bottom right">&nbsp;</td>
	</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td colspan="3" class="left bottom right">Я є особою, яка обіймає посаду державного службовця, службовця органу місцевого самоврядування першої або другої категорії, претендую на зайняття чи займаю виборну посаду в органах влади та додаю декларацію про майновий стан і доходи (або податкову декларацію) встановленого зразка або заповнюю додаток до цієї Заяви (якщо так, вказати «додаю» або «заповнюю», якщо не відноситесь до таких осіб, вказати «ні»).</td>
	</tr>
	<tr align="center">
		<td width="33%" class="left bottom right {if $values.civil_servant != 1}u{/if}">додаю</td>
		<td width="33%" class="bottom right {if $values.civil_servant != 2}u{/if}">заповнюю</td>
		<td class="bottom right {if $values.civil_servant != 0}u{/if}">ні</td>
	</tr>
	<tr>
		<td colspan="3" class="left bottom right">Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий стан відкритою та додаю податкову декларацію встановленого зразка
	або заповнюю додаток до цієї Заяви добровільно (якщо так, вказати «додаю» або «заповнюю», якщо вважаєте цю інформацію конфіденційною, вказати «ні»</td>
	</tr>
	<tr align="center">
		<td class="left bottom right {if $values.not_civil_servant != 1}u{/if}">додаю</td>
		<td class="bottom right {if $values.not_civil_servant != 2}u{/if}">заповнюю</td>
		<td class="bottom right {if $values.not_civil_servant != 0}u{/if}">ні</td>
	</tr>
	<tr>
	<td colspan="2" class="left bottom right">Я є публічним діячем* або пов'язаною з ними особою** або особою, що діє від його імені (якщо так, вказати відношення до публічного діяча, дані про публічного діяча та додати офіційні документи, що дають можливість з'ясувати джерела походження коштів і вказати назву та реквізити цих документів, якщо не відноситесь до таких осіб, вказати «ні»):</td>
	<td class="bottom right">{if $values.public_figure}додаю{else}ні{/if}</td>
	</tr>
	<tr>
		<td colspan="3" class="small left right bottom">
		* фізичні особи, які виконують або виконували визначені публічні функцїї в іноземних державах, а саме: глава держави, керівник уряду, міністри та їх заступники; депутати парламенту; члени верховного суду, конституційного суду або інших судових органів високого рівня, рішення яких не підлягають оскарженню, крім як за виняткових обставин; члени суду аудиторів або правлінь центральних банків; надзвичайні та повноважні посли, повірені у справах та високі посадовці збройних сил; члени адміністративних, управлінських чи наглядових органів державних підприємств, що мають стратегічне значення; <br>
		** особи, пов'язані з публічними діячами, є членами сім'ї та інші близькі родичі.
		</td>
	</tr>	
</table>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td rowspan="3" class="left bottom right">Мета та характер (перелік послуг, які клієнт бажає отримати, одноразова операція, постійні відносини тощо) майбутніх ділових відносин:</td>
		<td class="bottom right">X</td>
		<td class="bottom right">захист майнових інтересів шляхом отримання послуг зі страхування</td>
	</tr>
	<tr>
		<td rowspan="2" class="bottom right">&nbsp;</td>
		<td class="bottom right">інше (вказати)</td>
	</tr>
	<tr>
		<td class="bottom right">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" class="bottom right left">
			Для проведення ідентифікації фізичної особи, разом з цим подают оригінали або копії документів, що засвідчені нотаріально чи підприємством (установою, організацією), яке їх видало, що підтверджують інформацію наведену вище;<br>
			Приймаю на себе зобов'язання, у разі зміни інформації, наведеної в цій Заяві, або закінчення строку дії документів, на підставі яких вона заповнювалася, протягом десяти робочих днів з дня настання вказаних подій надати нову інформацію та передбачені документи за першою вимогою.
		</td>
	</tr>
</table><br>

{/if}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>2. Власник</b></td>
		<td class="all">{$values.ownerTitle}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center" class="small">прізвище, ім'я, по батькові (назва організації)</td>
	</tr>
	<tr>
		<td>Адреса:</td>
		<td class="all">{$values.ownerAddress}</td>
	</tr>
</table><br />
<h1  >3. Секція 1 - страхування КАСКО (на період з 01 квітня до 30 листопада поточного року, але в межах строку дії Договору страхування)</h1>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" valign="top"><b>3.1 Ідентифікація ТЗ</b></td>
		<td>
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td align="right">марка</td>
					<td class="all">{$values.brand}</td>
					<td align="right">№ кузова/шасі</td>
					<td colspan="3" class="all">{$values.shassi}</td>
				</tr>
				<tr>
					<td align="right">модель</td>
					<td class="right bottom left">{$values.model}</td>
					<td align="right">держ. №</td>
					<td class="left bottom right">{$values.sign}</td>
					<td class="right bottom" align="right">пробіг, тис. км</td>
					<td class="right bottom">{$values.race}</td>
				</tr>
				<tr>
					<td align="right">Модифікація</td>
					<td class="right bottom left">&nbsp;{$values.car_body_title}</td>
					<td align="right">об'єм двигуна</td>
					<td class="right bottom left">{$values.engine_size}</td>
					<td class="right bottom" align="right">рік випуску</td>
					<td class="right bottom">{$values.year}</td>
				</tr>
				<tr>
					<td align="right">Тип ТЗ</td>
					<td class="right bottom left">{if $values.car_types_id==8}легковий{/if}{if $values.car_types_id==9}вантажний{/if}{if $values.car_types_id==10}вантажний{/if}{if $values.car_types_id==11}мікроавтобус{/if}{if $values.car_types_id==12}пасажирський автобус{/if}{if $values.car_types_id==13}пасажирський автобус{/if}{if $values.car_types_id==14}причеп{/if}{if $values.car_types_id==15}спеціальний автомобіль{/if}{if $values.car_types_id==16}сільськогосподарський ТЗ{/if}</td>
					<td width="15%" align="right">колір</td>
					<td width="15%" class="right bottom left">{$values.colors_title}</td>
					<td class="right bottom" align="right">Тип пального</td>
					<td class="right bottom">&nbsp;{$values.car_engine_type_title}</td>
				</tr>
				<tr>
					<td align="right">КПП</td>
					<td class="right bottom left">&nbsp;{$values.transmissions_title}</td>
					<td align="right">Дійсна вартість ТЗ, грн.</td>
					<td colspan="3" class="right bottom left">{$values.market_price|moneyformat:-1}</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td class="right bottom left"></td>
					<td align="right">Страхова сума ТЗ, грн.</td>
					<td colspan="3" class="right bottom left">{$values.car_price|moneyformat:-1}</td>
				</tr>
			</table><br />
			<br />
		</td>
	</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Місце реєстрації ТЗ</td>
		<td class="all" align="center" width="80%">{$values.registration_cities_title}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" valign="top"><b>3.2 Інформація про ТЗ</b></td>
		<td width="32%">
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td rowspan="4" width="45%">Розпорядження (користування) ТЗ на підставі (відмітити Х)</td>
					<td width="45%" class="all">права власності</td>
					<td width="10%" class="top right bottom center">{if $values.order_basis_car_id==1}X{/if}</td>
				</tr>
				<tr>
					<td class="right bottom left">оренди</td>
					<td class="right bottom center">{if $values.order_basis_car_id==2}X{/if}</td>
				</tr>
				<tr>
					<td class="right bottom left">доручення</td>
					<td class="right bottom center">{if $values.order_basis_car_id==3}X{/if}</td>
				</tr>
				<tr>
					<td class="right bottom left">лізингу</td>
					<td class="right bottom center">{if $values.order_basis_car_id==4}X{/if}</td>
				</tr>
			</table>
		</td>
		<td width="2%">&nbsp;</td>
		<td width="32%">
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td rowspan="4" width="45%">Використання ТЗ в якості</td>
					<td width="45%" class="all">таксі</td>
					<td width="10%" class="top right bottom center">{if $values.options_taxy}X{else}----{/if}</td>
				</tr>
				<tr>
					<td class="right bottom left">в особистих цілях</td>
					<td class="right bottom center">{if $values.use_as_car_private}X{else}----{/if}</td>
				</tr>
				<tr>
					<td class="right bottom left">в робочих цілях</td>
					<td class="right bottom center">{if $values.use_as_car_work}X{else}----{/if}</td>
				</tr>
				<tr>
					<td class="right bottom left">оренда, лізинг</td>
					<td class="right bottom center">{if $values.use_as_car_leasing}X{else}----{/if}</td>
				</tr>
			</table>
		</td>
		<td width="2%">&nbsp;</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Місце зберігання ТЗ у нічний час (з 00:00 до 06:00)</td>
	<td class="all">{if $values.residences_id==1}стоянка, що знаходиться під охороною або гараж (у нічний час: з 00:00 до 06:00){else}будь-яке місце{/if}</td>
</tr>
</table><br />

{if $values.protection_multlock || $values.protection_immobilaser || $values.protection_manual || $values.protection_signalling}
{assign var=alarm value=1}
{else}
{assign var=alarm value=0}
{/if}
{if $values.insurer_person_types_id == 1}
<div style="page-break-after: always"></div>
{/if}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" rowspan="5" valign="top">Наявність протиугінного пристрою</td>
		<td class="top left right" align="center" width="40%" colspan=2>{if !$alarm}<s>{/if}Є протиугінний пристрій, а саме{if !$alarm}</s>{/if}</td>		
		<td class="top right bottom" align="center" width="40%">{if $alarm}<s>{/if}не встановлено протиугінний пристрій{if $alarm}</s>{/if}</td>
	</tr>
	<tr>
		<td class="all">Mul-T-Lock</td>
		<td class="top right bottom center">{if $values.protection_multlock}так{else}ні{/if}</td>
		<td width="5%"></td>
	</tr>
	<tr>
		<td class="right bottom left">Immobilaser</td>
		<td class="right bottom center">{if $values.protection_immobilaser}так{else}ні{/if}</td>
		<td></td>
	</tr>
	<tr>
		<td class="right bottom left">Механічна</td>
		<td class="right bottom center">{if $values.protection_manual}так{else}ні{/if}</td>
		<td></td>
	</tr>
	<tr>
		<td class="right bottom left">Сигналізація</td>
		<td class="right bottom center">{if $values.protection_signalling}так{else}ні{/if}</td>
		<td></td>
	</tr>
</table><br />

{assign var=equipment_count value=0}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>Додаткове обладнання</b></td>
	<td>
		<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td class="all">Найменуванння</td>
			<td class="top right bottom">Марка/модель</td>
			<td class="top right bottom">Вартість ДО, грн./страхова сума, грн.</td>
		</tr>
{section name="roll" loop=$values.equipment}
		<tr>
			<td class="right bottom left">{$values.equipment[roll].title}</td>
			<td class="right bottom">{$values.equipment[roll].brand}/{$values.equipment[roll].model}</td>
			<td class="right bottom" align=right>{$values.equipment[roll].price|moneyformat:-1}</td>
		</tr>
		{assign var=equipment_count value=$equipment_count+1}
{/section}		
		{if $equipment_count==0}
			<tr>
				<td class="right bottom left" align="center">---</td>
				<td class="right bottom" align="center">---</td>
				<td class="right bottom" align=center>---</td>
			</tr>
		{/if}
		</table>
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>3.3. Перелік страхових випадків</b><div class="small">(непотрібне закреслити)</div></td>
	<td>
		 
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center {if $values.dtp == 0}u{/if}">1. ДТП</td>
			<td class="top right bottom center {if $values.pdto == 0}u{/if}">2. ПДТО</td>
			<td class="top right bottom center {if $values.actofgod == 0}u{/if}">3. Стихійні<br />явища</td>
			<td class="top right bottom center {if $values.downfall <= 0}u{/if}">4. Падіння літальних апаратів або їх частин, дерев,<br />інших предметів, тіл космічного походження</td>
			<td class="top right bottom center {if $values.animal == 0}u{/if}">5. Напад тварин</td>
			<td class="top right bottom center {if $values.fire == 0}u{/if}">6. Пожежа, вибух</td>
			<td class="top right bottom center {if $values.hijacking == 0}u{/if}">7. Незаконне<br />заволодіння</td>
		</tr>
		</table><br />
		 		
	</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>3.4. Франшиза безумовна,</b> % від страхової суми по будь-якому та кожному страховому випадку</td>
	<td>
		 
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center">{$values.deductibles_value0|sign:$values.deductibles_absolute0}</td><td class="top right bottom">за подіями згідно з п.п. 3.3.1. - 3.3.6. цієї Заяви</td>
		</tr>
		<tr>
			<td class="right bottom center  left">{$values.deductibles_value1|sign:$values.deductibles_absolute1}</td><td class="bottom right">за подією згідно з п.3.3.7. цієї Заяви та у випадку повної конструктивної загибелі ТЗ  </td>
		</tr>
		</table><br />
		 		
	</td>
</tr>
</table>

 
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>3.5. Водій</b></td>
		<td class="all">
			будь-яка особа, яка керує ТЗ на законних підставах
		</td>
	</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>3.6. Пріоритет виплати        </b></td>
		<td class="all" align="center" width="40%">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}<s>{/if}</td>
		<td class="top right bottom" align="center" width="40%">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>3.7. Додаткові опції      </b></td>
<td  align="center">
	<table cellpadding="5" cellspacing="0" width="100%">
		<tr>
			<td class="left right bottom top" width="70%">фізичний знос не вираховується</td>
			<td class="right bottom top" width="10%">{if $values.options_deterioration_no}так{else}ні{/if}</td>
		</tr>
		<tr>
			<td class="right bottom left">страхування без встановленого протиугінного пристрою</td>
			<td class="right bottom">{if $values.no_immobiliser}так{else}ні{/if}</td>
		</tr>
	</table><br />
</td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>3.8. Територія дії Договору страхування за Секцією 1</b></td>
		<td class="all">{$values.zones_title}</td>
	</tr>
</table>

<h1 >4. Секція 2 - страхування майна (на період з 01 грудня поточного року до 31 березня наступного року, але в межах строку дії Договору страхування)</h1>



<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>4.1. Перелік страхових випадків</b></td>
	<td>
		 
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center">1. Пожежа                        (пожежа, вибух, удар блискавки)</td>
			<td class="top right bottom center" >2. Стихійні явища</td>
			<td class="top right bottom center" >3. Вплив води</td>
			<td class="top right bottom center" >4. Протиправні дії третіх осіб (ПДТО)</td>
			<td class="top right bottom center" >5. Транспортна шкода</td>
			
		</tr>
		</table><br />
		 		
	</td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>4.2. Франшиза безумовна</b></td>
	<td class="all">
		 
		 1% від страхової суми по будь-якому та кожному страховому випадку
		 		
	</td>
</tr>
</table>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>4.3. Територія дії Договору страхування за Секцією 2</b></td>
	<td class="all">
		 
	  {$values.propertyplace}
		 		
	</td>
</tr>
</table>	
	
<h1  >5. Загальні умови страхування (за Секцією 1 та Секцією 2)</h1>
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>5.1. Строк дії Договору страхування </b></td>
		<td>з 00:00 год. {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по 24:00 год. {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	</tr>
</table>
 

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>Протягом строку дії Договору прошу встановити таку кількість періодів страхування, з можливістю сплати страхового платежу за кожний період страхування окремо (непотрібне закреслити)</b></td>
		<td class="all{if ($values.paymentsCount > 1 || $values.options_month500) && !$values.options_fifty_fifty} u{/if}">  1 період страхування</td>
		<td class="top right bottom{if ($values.paymentsCount != 2 && !$values.options_month500)  || $values.options_month500 || $values.options_fifty_fifty} u{/if}">  2 періоди страхування</td>
		<td class="top right bottom{if $values.paymentsCount != 4  || $values.options_month500 || $values.options_fifty_fifty} u{/if}">  4 періоди страхування</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>5.2. Наявність інших чинних договорів страхування щодо цього ТЗ (майна)</b></td>
		<td class="all {if $values.other_policies} u{/if}">інші договори відсутні</td>
		<td class="top right bottom{if !$values.other_policies} u{/if}">{$values.other_policies}</td>
	</tr>
</table><br />


 
 


<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>5.3. Договір страхування прошу укласти на користь Вигодонабувача</b></td>
		<td class="all">{if $values.assured_title}ТАК{else}НІ{/if}</td>
	</tr>
<table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">назва, реквізити Вигодонабувача</td>
		<td class="all">
		 {if $values.financial_institutions_id==18}
			  ПАТ "Альфа-Банк" ЄРДПОУ: 23494714 МФО: 300346 
		{else}
			{if $values.financial_institutions_id==34}<!-- правекс-->
				{$values.assured_title}. ІПН (ЄРДПОУ): {$values.assured_identification_code}. 01021, м.Київ, Кловський узвіз, 9/2.<br />
			{else}
				{$values.assured_title} 
			{/if}
		{/if}
		</td>
	</tr>
<table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Адреса, телефон</td>
		<td class="all" valign="top">{$values.assured_address}{if $values.assured_phone}, тел.{$values.assured_phone}{/if}</td>
	</tr>
</table><br />
 

 

 
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>5.4. Особливі умови</b></td>
		<td class="all" width="80%">{$values.comment}</td>
	</tr>
</table><br />
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>5.5. Декларація Страхувальника</b></td>
	<td class="all">
		{if $values.retail}
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «Експрес Страхування». Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору і буде його невід’ємною частиною.
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
		<p>Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання моїх персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки.
		<p>У випадку укладання Договору страхування з використанням опції страхування "50/50", зобов`язуюся доплатити другу частину страхового платежу у розмірі 50% у випадку звернення до Страховика з Заявою про виплату страхового відшкодування  протягом 15 календарних днів з дати звернення. Я проінформований про те, що невиконання мною даної умови є підставою для Страховика відмовити у виплаті страхового відшкодування. Я проінформований про те, що якщо при укладанні Договору страхова сума по ТЗ буде меншою за ринкову (дійсну) вартість ТЗ більше, ніж на 10%, то при настанні страхового випадку Страховик здійснює виплату страхового відшкодування пропорційно співвідношенню страхової суми до ринкової (дійсної) вартості ТЗ на дату укладання Договору.
		<p>У разі укладання Договору я надаю свою згоду на договірне списання коштів у випадку ненадходження страхового платежу в зазначених
        в Договорі строки та терміни.
		{else}
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «Експрес Страхування». Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору і буде його невід’ємною частиною.
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
		<p>Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання моїх персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки.
		{if $values.financial_institutions_id!=44 && $values.financial_institutions_id!=35 && $values.financial_institutions_id!=1 && $values.financial_institutions_id!=58} 
        <p>У разі укладання Договору я надаю свою згоду на договірне списання коштів у випадку ненадходження страхового платежу в зазначених
        в Договорі строки та терміни.
		{/if}
		Я проінформований про те, що якщо при укладанні Договору страхова сума по ТЗ буде меншою за ринкову (дійсну) вартість ТЗ більше, ніж на 10%, то при настанні страхового випадку Страховик здійснює виплату страхового відшкодування пропорційно співвідношенню страхової суми до ринкової (дійсної) вартості ТЗ на дату укладання Договору.
		{/if}
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
		<td width="30%" class="bottom">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
		<td width="7%" align="center">&nbsp;/&nbsp;</td>
		<td width="10%" class="bottom">&nbsp;</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td width="20%" >&nbsp;</td>
	</tr>
	<!--tr><td colspan="5">&nbsp;</td></tr-->
	<tr>
		<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td class="bottom">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}Директор Щучьєва Т.А.{/if}</td>
		<!--{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}-->
		<td align="center">&nbsp;/&nbsp;</td>
		<td class="bottom">&nbsp;</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td  >&nbsp;</td>
	</tr>
	<tr><td></td>
		<td class="bottom">{if $values.ukravto == 1 && $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou   && $values.agencies_id!=1469111}{$values.findirector1}{else} {/if}</td>
		<td align="center">&nbsp;/&nbsp;</td>
		<td class="bottom">&nbsp;</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td  >&nbsp;</td>
	</tr>
</table>

</body>
</html>