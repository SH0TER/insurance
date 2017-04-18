<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Заявление</title>
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
			{if $values.products_id==89} в рамках акції "Щаслива п'ятірка"{/if}
			{if $values.products_id==110 || $values.products_id==192}за Програмою "КОМФОРТ"{/if}
			{if $values.products_id==684}ПРОГРАМА "КАСКО Mini"{/if}
			</h2><br /><br />		
			<p><b>Прошу укласти договір страхування транспортного засобу (ТЗ) згідно наведеної нижче інформації.<b></p>
		</td>
		<td width="230" align="center">
			<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
			{$values.filename}
		</td>
		<td align="right"  width="150">
			<p>№ {$values.number}</p>
			<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
		</td>
	</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>1. Заявник</b></td>
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

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Посвідчення водія</td>
		<td>серія, №</td>
		<td class="all">{$values.insurer_driver_licence_series} {$values.insurer_driver_licence_number}</td>
		<td align="center">від</td>
		<td class="all">{if $values.insurer_driver_licence_date!='0000-00-00'}{$values.insurer_driver_licence_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}</td>
		<td width="50%">&nbsp;</td>
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

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" valign="top"><b>3. Ідентифікація ТЗ</b></td>
		<td>
			{if  $values.financial_institutions_id == 28 || $values.financial_institutions_id == 39 || $values.financial_institutions_id == 46}
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
					<td align="right">Тип ТЗ</td>
					<td class="right bottom left">{if $values.car_types_id==8}легковий{/if}{if $values.car_types_id==9}вантажний{/if}{if $values.car_types_id==10}вантажний{/if}{if $values.car_types_id==11}мікроавтобус{/if}{if $values.car_types_id==12}пасажирський автобус{/if}{if $values.car_types_id==13}пасажирський автобус{/if}{if $values.car_types_id==14}причеп{/if}{if $values.car_types_id==15}спеціальний автомобіль{/if}{if $values.car_types_id==16}сільськогосподарський ТЗ{/if}</td>
					<td align="right">об'єм двигуна</td>
					<td class="right bottom left">{$values.engine_size}</td>
					<td class="right bottom" align="right">рік випуску</td>
					<td class="right bottom">{$values.year}</td>
				</tr>
				<tr>
					<td width="15%" align="right">колір</td>
					<td width="15%" class="right bottom left">{$values.colors_title}</td>
					<td width="15%" align="right">Страхова сума ТЗ, грн.</td>
					<td width="15%" class="left right bottom" colspan="3">{$values.car_price|moneyformat:-1}</td>
				</tr>
			</table><br />
			{else}
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
					<td align="right">{if $values.products_id!=684}Дійсна вартість ТЗ, грн.{/if}</td>
					<td colspan="3" class="right bottom left">{if $values.products_id!=684}{$values.market_price|moneyformat:-1}{/if}</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td class="right bottom left"></td>
					<td align="right">Страхова сума ТЗ, грн.</td>
					<td colspan="3" class="right bottom left">{$values.car_price|moneyformat:-1}</td>
				</tr>
			</table><br />
			{/if}
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
		<td width="20%" valign="top"><b>4. Інформація про ТЗ</b></td>
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
	<td width="20%">Місце зберігання ТЗ</td>
	<td class="all">{if $values.residences_id==1}стоянка, що знаходиться під охороною або гараж (у нічний час: з 00:00 до 06:00){else}будь-яке місце{/if}</td>
</tr>
</table><br />

{if $values.products_id!=684}
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

{/if}

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>5. Перелік страхових випадків</b><div class="small">(непотрібне закреслити)</div></td>
	<td>
		{if $values.products_id==684}
		
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center {if $values.dtp == 0}u{/if}">1. ДТП</td>
		</tr>
		</table>
		{else}
		{if $values.yearsPaymentsCount==0  || $values.financial_institutions_id==35}<p>5.1. при страхуванні ТЗ:</p>{/if}
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
		{if ($values.yearsPaymentsCount==0 && $values.financial_institutions_id!=54) || $values.financial_institutions_id==35}
		<p>5.2.при страхуванні від нещасного випадку:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td class="top right bottom left center {if $values.amount_accident == 0}u{/if}">1. Тимчасова втрата застрахованою особою загальної працездатності</td>
				<td class="top right bottom center {if $values.amount_accident == 0}u{/if}">2. Стійка втрата застрахованою особою загальної працездатності (встановлення групи інвалідності)</td>
				<td class="top right bottom center {if $values.amount_accident == 0}u{/if}">3. Смерть застрахованої особи внаслідок нещасного випадку</td>
			</tr>
			</table><br>
			{if $values.financial_institutions_id!=35}
			<p>5.3.страхова сума при страхуванні від нещасного випадку:</p>
			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td class="top right left center">водія (в том числі будь-яка із осіб, допущених до керування застрахованим ТЗ), грн.</td>
				<td class="top right center">пасажирів за системою місць, грн.</td>
			</tr>
			<tr>
				<td class="top right bottom left center">{if $values.amount_accident>0}{$values.price_accidentDriver|moneyformat:-1}{else}----{/if}</td>
				<td class="top right bottom center">{if $values.amount_accident>0}{$values.price_accidentPassengers|moneyformat:-1}{else}----{/if}</td>
			</tr>
		</table>
		{/if}
		{/if}
{/if}		
	</td>
</tr>
</table>

{if $values.yearsPaymentsCount==0 && $values.financial_institutions_id!=54}
	<p>Додатково прошу застрахувати водія та пасажирів ТЗ від нещасного випадку на транспорті - <b>{if $values.amount_accident>0}ТАК{else}НІ{/if}</b></p>
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>6. Кількість осіб,<br />допущених до керування</b></td>
		<td>
			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td class="top right bottom left center">№ п/п</td>
				<td class="top right bottom center">Прізвище, ім'я, по батькові</td>
				<td class="top right bottom center">Вік</td>
				<td class="top right bottom center">Серія та №<br />посвідчення водія</td>
				<td class="top right bottom center">Стаж</td>
			</tr>
			{if $values.drivers_id != 7}
			<tr>
				<td class="right bottom left center">1</td>
				<td class="right bottom">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
				<td class="right bottom">{$values.driver_ages_title}</td>
				<td class="right bottom">{$values.insurer_driver_licence_series} {$values.insurer_driver_licence_number}</td>
				<td class="right bottom">{$values.insurer_driver_licence_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			</tr>
			{else}
			<tr>
				<td class="right bottom left center">1</td>
				<td class="right bottom">{if $values.options_workers_list}Водії підприємства згідно Наказу{else}Будь-яка особа на законних підставах{/if}</td>
				<td class="right bottom center">----</td>
				<td class="right bottom center">----</td>
				<td class="right bottom center">----</td>
			</tr>
			{/if}
			{section name=roll loop=$values.persons}
			<tr>
				<td class="right bottom left center">{cycle values="2,3,4,5"}</td>
				<td class="right bottom">{$values.persons[roll].lastname} {$values.persons[roll].firstname} {$values.persons[roll].patronymicname}</td>
				<td class="right bottom">{$values.persons[roll].driver_ages_title}</td>
				<td class="right bottom">{$values.persons[roll].driver_licence_series} {$values.persons[roll].driver_licence_number}</td>
				<td class="right bottom">{$values.persons[roll].driver_licence_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			</tr>
			{/section}
			</table>
		</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>7. Строк дії Договору</b></td>
		<td>з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	</tr>
</table>

{if $values.retail}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>Протягом строку дії Договору прошу встановити таку кількість періодів страхування, з можливістю сплати страхового платежу за кожний період страхування окремо (непотрібне закреслити)</b></td>
		<td class="all{if ($values.paymentsCount > 1 || $values.options_month500) && !$values.options_fifty_fifty} u{/if}">  1 період страхування</td>
		<td class="top right bottom{if ($values.paymentsCount != 2 && !$values.options_month500)  || $values.options_month500 || $values.options_fifty_fifty} u{/if}">  2 періоди страхування</td>
		<td class="top right bottom{if $values.paymentsCount != 4  || $values.options_month500 || $values.options_fifty_fifty} u{/if}">  4 періоди страхування</td>
		{if $values.retail}<td class="top right bottom{if !$values.options_month500} u{/if}">  використати опцію "перший місяць страхування за 500 грн."</td>{/if}
		{if $values.retail}<td class="top right bottom{if !$values.options_fifty_fifty} u{/if}">  застосувати опцію "50/50"</td>{/if}
	</tr>
</table><br />
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>8. Пріоритет виплати</b></td>
		<td class="all" align="center" width="40%">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}<s>{/if}</td>
		<td class="top right bottom" align="center" width="40%">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" valign="top"><b>9. Додаткова інформація</b></td>
		<td>
			<p>Варіант франшизи:</p>
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td class="top right bottom left">
					{if $values.products_id!=684}
					за ризиками 5.1. - 5.6.: {$values.deductibles_value0|sign:$values.deductibles_absolute0} {if $values.products_id==599}(але не менше 4 000,00 грн.){/if}; 
					за ризиком 5.7.: {$values.deductibles_value1|sign:$values.deductibles_absolute1}
					{else}
						{if $values.car_price=='10000.00'}
						2 500,00 грн.
						{/if}
						{if $values.car_price=='20000.00'}
						4 000,00 грн.
						{/if}
						{if $values.car_price=='50000.00'}
						8 000,00 грн.
						{/if}
					{/if}
					</td>
				</tr>
			</table><br />
			<p>Місце дії Договору страхування:</p>
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td class="top right bottom left">{$values.zones_title}</td>
				</tr>
			</table>
			
			<!--{if $values.yearsPaymentsCount==0}<p>7.2. Умови внесення страхового платежу:</p>
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td class="all{if $values.paymentsCount > 1} u{/if}">7.2.1. одноразово 100% платежу</td>
					<td class="top right bottom{if $values.paymentsCount != 2} u{/if}">7.2.2. 50%/50%</td>
					<td class="top right bottom u">7.2.3. 40%/20%/20%/20%</td>
					<td class="top right bottom{if $values.paymentsCount != 4} u{/if}">7.2.4. 25%/25%/25%/25%</td>
				</tr>
			</table><br />
			{/if}
			
			<p>{if $values.yearsPaymentsCount==0}7.3.{else}7.2.{/if} Пріорітет виплати:</p>
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td class="all{if $values.priority_payments_id > 1} u{/if}">{if $values.yearsPaymentsCount==0}7.3.1.{else}7.2.1.{/if} СТО</td>
					<td class="top right bottom{if $values.priority_payments_id <=1} u{/if}">{if $values.yearsPaymentsCount==0}7.3.2.{else}7.2.1.{/if} експертиза</td>
					
				</tr>
			</table><br />

			<p>{if $values.yearsPaymentsCount==0}7.4.{else}7.3.{/if} Територія дії Договору:</p>
			<table cellspacing=0 cellpadding=5 width="100%">
				<tr>
					<td class="top right bottom left">{$values.zones_title}</td>
				</tr>	
			</table>
		</td>
	</tr>-->
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Наявність інших договорів страхування страхування щодо цього ТЗ</td>
		<td class="all {if $values.other_policies} u{/if}">інші договори відсутні</td>
		<td class="top right bottom{if !$values.other_policies} u{/if}">{$values.other_policies}</td>
	</tr>
</table><br />

{if $values.products_id==737 || $values.products_id==738 || $values.products_id==739}
	<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td rowspan="15" width="20%" valign="top"><b>10. Додаткові опції</b></td>
			<td class="right bottom left top">при пошкодженні тільки скляних деталей ТЗ (вітрового та заднього скла, скла дверей, фар, приладів зовнішнього освітлення, дзеркал), при відсутності інших пошкоджень ТЗ внаслідок настання страхового випадку, франшиза – 0%</td>
			<td class="right bottom top">так</td>
		</tr>
		<tr>
			<td class="right bottom left">неагрегатна страхова сума</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">фізичний знос не вираховується</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">страхування таксі</td>
			<td class="right bottom">{if $values.options_taxy}так{else}ні{/if}</td>
		</tr>
		<tr>
			<td class="right bottom left">страхування без встановленого протиугінного пристрою</td>
			<td class="right bottom">{if $values.no_immobiliser}так{else}ні{/if}</td>
		</tr>
		<tr>
			<td class="right bottom left">виплата страхового відшкодування без надання довідок компетентних органів, два рази протягом строку дії Договору, в межах 5% страхової суми ТЗ, але не більше 50 000,00 гривень вартості відновлювального ремонту ТЗ</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">виплата страхового відшкодування без надання довідок компетентних органів при пошкодженні тільки скляних деталей ТЗ (вітрового та заднього скла, скла дверей, фар, приладів зовнішнього освітлення, дзеркал), при відсутності інших пошкоджень ТЗ внаслідок настання страхового випадку, без обмежень кількості разів протягом строку дії Договору та суми вартості відновлювального ремонту</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">виплата страхового відшкодування без надання довідок ДАІ, при настанні страхового випадку за ризиком «ДТП», якщо розмір збитків складає не більше 50 000 грн., за умови наявності учасників події - третіх осіб, якщо всі учасники ДТП мають діючі внутрішні Поліси  ОСЦПВВНТЗ та заповнили та підписали «Повідомлення про дорожньо-транспортну пригоду» затвердженого МТСБУ зразка</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">порушення ПДР, зазначене в п.13.1.15. частини Б Договору, як причина відмови у виплаті страхового відшкодування</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">відшкодування вартості витрат на евакуацію (транспортування) ТЗ, на одне завантаження, розвантаження та перевезення, в межах 1 000 грн. за кожним страховим випадком</td>
			<td class="right bottom">так</td>
		</tr>
	</table><br />
{else}
	<table cellspacing=0 cellpadding=5 width="100%">
		{if $values.products_id==110 || $values.products_id==192 || $values.products_id==673}
		<tr>
			<td rowspan="15" width="20%" valign="top"><b>10. Додаткові опції</b></td>
			<td class="right bottom left top">неагрегатна страхова сума</td>
			<td class="right bottom top">{if $values.options_agregate_no}так{else}ні{/if}</td>
		</tr>
		{else}
		<tr>
			<td rowspan="15" width="20%" valign="top"><b>10. Додаткові опції</b></td>
			<td class="right bottom left top">без франшизи на вітрові стекла</td>
			<td class="right bottom top">{if $values.options_deductible_glass_no}так{else}ні{/if}</td>
		</tr>
		{if $values.products_id!=684 && $values.products_id!=673}
		<tr>
			<td class="right bottom left">неагрегатна страхова сума</td>
			<td class="right bottom">{if $values.options_agregate_no}так{else}ні{/if}</td>
		</tr>
		{/if}
		{/if}
		<tr>
			<td class="right bottom left">фізичний знос не вираховується</td>
			<td class="right bottom">{if $values.products_id!=684}{if $values.options_deterioration_no}так{else}ні{/if}{else}ні{/if}</td>
		</tr>

		<tr>
			<td class="right bottom left">страхування таксі</td>
			<td class="right bottom">{if $values.options_taxy}так{else}ні{/if}</td>
		</tr>
		{if $values.products_id!=599 && $values.products_id!=684}
		<tr>
			<td class="right bottom left">страхування без встановленого протиугінного пристрою</td>
			<td class="right bottom">{if $values.no_immobiliser}так{else}ні{/if}</td>
		</tr>
		{/if}
		{if $values.products_id==684}
		<tr>
			<td class="right bottom left">страхування додаткового обладнання (ДО)</td>
			<td class="right bottom">ні</td>
		</tr>
		{/if}
	{if $values.products_id!=684}
	{if $values.retail || $values.financial_institutions_id==2 ||  $values.financial_institutions_id==25 ||  $values.financial_institutions_id==59}
		<tr>
			<td class="right bottom left">{if $values.financial_institutions_id==25 || $values.financial_institutions_id==59}опція страхування "Розумне КАСКО"{else}опція страхування "50/50"{/if}</td>
			<td class="right bottom">{if $values.options_fifty_fifty}так{else}ні{/if}</td>
		</tr>
	{/if}	
	{if $values.retail}	
		<tr>
			<td class="right bottom left">опція страхування "перший місяць страхування за 500 грн."</td>
			<td class="right bottom">{if $values.options_month500}так{else}ні{/if}</td>
		</tr>
	{/if}
	{/if}


	{if (($values.retail ||  $values.products_id==599) && $values.agreement_types_id==0)}
		{if $values.products_id!=599 && $values.products_id!=684}
		<tr>
			<td class="right bottom left">
			{if $values.products_id!=673}
			виплата страхового відшкодування без надання довідок компетентних органів, один раз протягом строку дії Договору, в межах 5% страхової суми ТЗ, але не більше: 
											• 7 500,00 гривень вартості відновлювального ремонту для ТЗ зі страховою сумою до 150 000,00 гривень (включно);
											• 25 000,00 гривень вартості відновлювального ремонту для ТЗ зі страховою сумою більше 150 000,00 гривень.
			{else}
			виплата страхового відшкодування без надання довідок компетентних органів, два рази протягом строку дії Договору, в межах   100 000,00 гривень вартості відновлювального ремонту, виключно шляхом перерахування коштів на рахунок СТО, що підтримує гарантійні зобов’язання виробника (імпортера/офіційного дилера) застрахованого ТЗ та яка письмово погоджена зі Страховиком
			{/if}
			</td>
											
											
			<td class="right bottom">так</td>
		</tr>
		{/if}
		{if $values.products_id==684}
		<tr>
			<td class="right bottom left">виплата страхового відшкодування без надання довідок компетентних органів</td>
			<td class="right bottom">нi</td>
		</tr>
		{/if}
		
		<tr>
			<td class="right bottom left">при пошкодженні тільки скляних поверхонь франшиза – 0%</td>
			<td class="right bottom">{if $values.products_id==599 || $values.products_id==684}нi{else}так{/if}</td>
		</tr>
		{if $values.products_id==673}
		<tr>
			<td class="right bottom left">виплата страхового відшкодування без надання довідок компетентних органів при пошкодженнях тільки скляних деталей ТЗ (вітрового та заднього скла, скла дверей, фар, приладів зовнішнього освітлення, дзеркал), за умов відсутності інших пошкоджень ТЗ</td>
			<td class="right bottom">{if $values.products_id==599}нi{else}так{/if}</td>
		</tr>
		{/if}
		{if $values.products_id!=684}
		<tr>
			<td class="right bottom left">виплата страхового відшкодування без надання довідок поліції, при настанні страхового випадку за ризиком «ДТП», якщо розмір збитків складає не більше 50 000 грн., за умови наявності учасників події - третіх осіб, якщо всі учасники ДТП мають діючі внутрішні Поліси  ОСЦПВВНТЗ та заповнили та підписали «Повідомлення про дорожньо-транспортну пригоду» затвердженого МТСБУ зразка</td>
			<td class="right bottom">{if $values.products_id==599}нi{else}так{/if}</td>
		</tr>
		{/if}
		<tr>
			<td class="right bottom left">грубі порушення ПДР, зазначені в {if $values.products_id==684 || $values.products_id==673}13.1.14. {else}п.13.1.15.{/if} частини Б Договору, як причина відмови у виплаті страхового відшкодування</td>
			<td class="right bottom">так</td>
		</tr>
		<tr>
			<td class="right bottom left">відшкодування вартості витрат на евакуацію (транспортування) ТЗ, на одне завантаження, розвантаження та перевезення, в межах  {if $values.products_id==673}1000{else}500{/if} грн. за {if $values.products_id!=684}кожним{/if} страховим випадком</td>
			<td class="right bottom">так</td>
		</tr>
	{/if}
	</table><br />
{/if}


<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">договір страхування прошу укласти на користь Вигодонабувача</td>
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
{if $values.products_id!=110 && $values.products_id!=192}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Кредитний договір № </td>
		<td class="all" width="20%">&nbsp;{$values.credit_agreement_number}</td>
		<td width="5%" align="center"> від </td>
		<td class="all" width="10%">&nbsp;{if $values.credit_agreement_number}{$values.credit_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}</td>
		<td></td>

	</tr>
<table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Договір застави № </td>
		<td class="all" width="20%">&nbsp;{$values.pawn_agreement_number}</td>
		<td width="5%" align="center"> від </td>
		<td class="all" width="10%">&nbsp;{if $values.pawn_agreement_date && $values.pawn_agreement_number}{$values.pawn_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}</td>
		<td></td>
	</tr>
</table><br />
{/if}

{if $values.financial_institutions_id!=35 && $values.financial_institutions_id>0}
<table cellspacing=0 cellpadding=5 width="100%">
    <tr>
        <td width="20%">Рахунок (для договірного списання коштів)</td>
        <td width="5&">№</td>
        <td class="all" width="20%">&nbsp;{$values.bank_account_number}</td>
        <td width="10%" align="center">відкритий в</td>
        <td class="all">{$values.bank_account_title}</td>
    </tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
    <tr>
        <td width="20%"></td>
        <td width="10%">МФО</td>
        <td class="all" width="20%">{$values.bank_account_mfo}</td>
        <td></td>

    </tr>
    <tr>
        <td width="20%"></td>
        <td width="10%">ЄДРПОУ</td>
        <td class="right left bottom" width="20%">{$values.bank_account_edrpou}</td>
        <td></td>
    </tr>
</table><br />
{/if}

{if $values.financial_institutions_id==35}
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>Додатково прошу застрахувати водія та пасажирів ТЗ від нещасного випадку на транспорті</b></td>
		<td class="all">{if $values.amount_accident>0}ТАК{else}НІ{/if}</td>
	</tr>
</table><br />
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>11. Особливі умови</b></td>
		<td class="all" width="80%">{$values.comment}</td>
	</tr>
</table><br />
{if $values.insurer_person_types_id == 1 && $values.products_id!=684}
<div style="page-break-after: always"></div>
{/if}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>12. Декларація Страхувальника</b></td>
	<td class="all">
		{if $values.retail}
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «Експрес Страхування». Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору і буде його невід’ємною частиною.
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
		<p>Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання моїх персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки.
		<p>У випадку укладання Договору страхування з використанням опції страхування "50/50", зобов`язуюся доплатити другу частину страхового платежу у розмірі 50% у випадку звернення до Страховика з Заявою про виплату страхового відшкодування  протягом 15 календарних днів з дати звернення. Я проінформований про те, що невиконання мною даної умови є підставою для Страховика відмовити у виплаті страхового відшкодування. Я проінформований про те, що якщо при укладанні Договору страхова сума по ТЗ буде меншою за ринкову (дійсну) вартість ТЗ більше, ніж на 10%, то при настанні страхового випадку Страховик здійснює виплату страхового відшкодування пропорційно співвідношенню страхової суми до ринкової (дійсної) вартості ТЗ на дату укладання Договору.
		<p>У разі укладання Договору я надаю свою згоду на договірне списання коштів у випадку ненадходження страхового платежу в зазначених
        в Договорі строки та терміни.
		<p>Я поінформований, що моє усне повідомлення Страховика про подію, що має ознаки страхового випадку, може бути записане та надаю згоду на здійснення такого запису та його подальше використання, в тому числі у суді.
		{else}
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «Експрес Страхування». Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору і буде його невід’ємною частиною.
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
		<p>Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання моїх персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки.
		<p>У разі укладання Договору, я надаю свою згоду на договірне списання коштів у випадку ненадходження страхового платежу в зазначені в Договорі строки. Я проінформований про те, що якщо при укладанні Договору страхова сума по ТЗ буде меншою за ринкову (дійсну) вартість ТЗ, то при настанні страхового випадку Страховик здійснює виплату страхового відшкодування пропорційно співвідношенню страхової суми до ринкової (дійсної) вартості ТЗ на дату укладання Договору.    
		<p>Я поінформований, що моє усне повідомлення Страховика про подію, що має ознаки страхового випадку, може бути записане та надаю згоду на здійснення такого запису та його подальше використання, в тому числі у суді.  
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
		<td class="bottom">
			{if $values.agencies_id==1469 && $values.seller_agencies_id==0}
				Поліщук М.О.
			{else}
				{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}Директор Щучьєва Т.А.{/if}
				<!--{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}-->
			{/if}		
		</td>
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