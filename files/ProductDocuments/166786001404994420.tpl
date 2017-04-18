<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Заявление несколько ТС Тест драйв Тип 4</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>
{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE1 || 
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE2 ||
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE3}
			{assign var=testdrive value=1}
{else}
			{assign var=testdrive value=0}
{/if}			
{section name="roll" loop=$values.items}
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1 align="center">ЗАЯВА</h1>
		<h2 align="center">на страхування транспортного засобу
		{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE1 || 
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE2 ||
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE3 ||
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE4
			}
		за програмою "КАСКО ТЕСТ ДРАЙВ. ТИП {if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE1}1{/if}{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE2}2{/if}{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE3}3{/if}{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE4}4{/if}"
		{/if}
		</h2><br /><br />
		<p>Прошу укласти Генеральний договiр страхування транспортного засобу (ТЗ) згiдно наведеної нижче iнформацiї.</p>
	</td>
	<td width="230" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
	<td align="right">
		<p>№ {$values.number}</p>
		<p>вiд {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
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
	<td align="center" class="small">прiзвище, iм'я, по батьковi (назва органiзацiї)</td>
</tr>
<tr>
	<td>Адреса:</td>
	<td class="all">{$values.insurer_address}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Iдент. код (код ЄДРПОУ)</td>
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
	<td width="20%">Паспортнi данi:</td>
	<td>серiя, №</td>
	<td class="all">{$values.insurer_passport_series} {$values.insurer_passport_number}</td>
	<td align="center">вiд</td>
	<td class="all">{$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>виданий</td>
	<td width="50%" class="all">{$values.insurer_passport_place}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Посвiдчення водiя</td>
	<td>серiя, №</td>
	<td class="all">{$values.insurer_driver_licence_series} {$values.insurer_driver_licence_number}</td>
	<td align="center">вiд</td>
	<td class="all">{$values.insurer_driver_licence_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td width="50%">&nbsp;</td>
</tr>
</table><br />
{/if}
{if $values.insurer_person_types_id == 2}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">ПIБ керiвника/уповноваженої особи, посада, на пiдставi чого дiє</td>
	<td class="all">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{if $values.insurer_position}, {$values.insurer_position}{/if}{if $values.insurer_ground}, {$values.insurer_ground}{/if}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Рахунок</td>
	<td>№</td>
	<td class="all">{if $values.insurer_bank_account}{$values.insurer_bank_account}{else}----{/if}</td>
	<td align="center">вiдкритий в</td>
	<td class="all">{if $values.insurer_bank}{$values.insurer_bank}{else}----{/if}</td>
	<td align="center">МФО</td>
	<td class="all">{if $values.insurer_bank_mfo}{$values.insurer_bank_mfo}{else}----{/if}</td>
</tr>
</table><br />
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>2. Власник</b></td>
	<td class="all">{$values.ownerTitle}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">прiзвище, iм'я, по батьковi (назва органiзацiї)</td>
</tr>
<tr>
	<td>Адреса:</td>
	<td class="all">{$values.ownerAddress}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" valign="top"><b>3. Iдентифiкацiя ТЗ</b></td>
		<td>
			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td align="right">марка</td>
				<td class="all">{$values.items[roll].brand}</td>
				<td align="right">№ кузова/шасi</td>
				<td colspan="3" class="all">{$values.items[roll].shassi}</td>
			</tr>
			<tr>
				<td align="right">модель</td>
				<td class="right bottom left">{$values.items[roll].model}</td>
				<td align="right">держ. №</td>
				<td class="left bottom right">{if $testdrive==0}{$values.items[roll].sign}{else}---{/if}</td>
				<td class="right bottom" align="right">пробiг, тис. км</td>
				<td class="right bottom">{if $testdrive==0}{$values.items[roll].race}{else}---{/if}</td>
			</tr>
			<tr>
				<td align="right">Тип ТЗ</td>
				<td class="right bottom left">{if $values.items[roll].car_types_id==8}легковий{/if}{if $values.items[roll].car_types_id==9}вантажний{/if}{if $values.items[roll].car_types_id==10}вантажний{/if}{if $values.items[roll].car_types_id==11}мiкроавтобус{/if}{if $values.items[roll].car_types_id==12}пасажирський автобус{/if}{if $values.items[roll].car_types_id==13}пасажирський автобус{/if}{if $values.items[roll].car_types_id==14}причеп{/if}{if $values.items[roll].car_types_id==15}спецiальний автомобiль{/if}{if $values.items[roll].car_types_id==16}сiльськогосподарський ТЗ{/if}</td>
				<td align="right">об'єм двигуна</td>
				<td class="right bottom left" colspan="3">{if $testdrive==0}{$values.items[roll].engine_size}{else}---{/if}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td rowspan="2" align="right">рiк випуску</td>
				<td rowspan="2" class="top right bottom left">{$values.items[roll].year}</td>
				<td rowspan="2" class="top right bottom" align="right">Вантажопiдйомнiсть,<br />кiлькiсть мiсць - для автобусiв</td>
				<td rowspan="2" class="top right bottom">----</td>
				<td rowspan="2" class="top right bottom" align="right">Кiлькiсть ключiв запалювання, шт</td>
				<td rowspan="2" class="top right bottom">----</td>
				<td rowspan="2" class="top right bottom" align="right">КПП</td>
				<td class="top right bottom" align="right">автомат</td>
				<td class="top right bottom" align="center">{if $values.items[roll].transmissions_id == 2}Так{else}----{/if}</td>
			</tr>
			<tr>
				<td class="right bottom" align="right">механiка</td>
				<td class="right bottom" align="center">{if $values.items[roll].transmissions_id == 1}Так{else}----{/if}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td width="25%" align="right">колiр</td>
				<td width="25%" class="top right bottom left">{$values.items[roll].colors_title}</td>
				<td width="25%" class="top right bottom" align="right">дiйсна вартiсть ТЗ, грн.</td>
				<td width="25%" class="top right bottom">{$values.items[roll].car_price|moneyformat:-1}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=0 width="100%">
			<tr>
				<td width="32%">
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="4" width="45%">Розпорядження (користування) ТЗ на пiдставi (вiдмiтити Х)</td>
						<td width="45%" class="all">права власностi</td>
						<td width="10%" class="top right bottom center">X</td>
					</tr>
					<tr>
						<td class="right bottom left">оренди</td>
						<td class="right bottom center">----</td>
					</tr>
					<tr>
						<td class="right bottom left">доручення</td>
						<td class="right bottom center">----</td>
					</tr>
					<tr>
						<td class="right bottom left">лiзингу</td>
						<td class="right bottom center">----</td>
					</tr>
					</table>
				</td>
				<td width="2%">&nbsp;</td>
				<td width="32%">
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="4" width="45%">Використання ТЗ в якостi</td>
						<td width="45%" class="all">таксi</td>
						<td width="10%" class="top right bottom center">{if $values.options_taxy}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">в особистих цілях</td>
						<td class="right bottom center">{if !$values.options_taxy && $values.insurer_person_types_id == 1}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">в робочих цілях</td>
						<td class="right bottom center">{if $values.insurer_person_types_id == 2}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">оренда, лiзинг</td>
						<td class="right bottom center">----</td>
					</tr>
					</table>
				</td>
				<td width="2%">&nbsp;</td>
				<td width="32%">
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="2" width="45%">Умови зберігання</td>
						<td width="45%" class="all">стоянка, що охороняється</td>
						<td width="10%" class="top right bottom center">{if $values.residences_id==1}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">будь-яке місце</td>
						<td class="right bottom center">{if $values.residences_id==2}X{else}----{/if}</td>
					</tr>
					
					</table>
				</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=0 width="100%">
			<tr>
				<td>
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td class="all" rowspan="4">Засоби захисту </td>
						<td class="top right bottom">Mul-T-Lock</td>
						<td class="top right bottom center">{if $values.items[roll].protection_multlock}так{else}нi{/if}</td>
					</tr>
					<tr>
						<td class="right bottom">Immobilaser</td>
						<td class="right bottom center">{if $values.items[roll].protection_immobilaser}так{else}нi{/if}</td>
					</tr>
					<tr>
						<td class="right bottom">Механiчна</td>
						<td class="right bottom center">{if $values.items[roll].protection_manual}так{else}нi{/if}</td>
					</tr>
					<tr>
						<td class="right bottom">Сигналiзацiя</td>
						<td class="right bottom center">{if $values.items[roll].protection_signalling}так{else}нi{/if}</td>
					</tr>
					</table>
				</td>
				<td width="4%">&nbsp;</td>
				<td>
				{if $testdrive==0}
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="4" class="all">Додаткове<br />обладнання</td>
						<td class="top right bottom" nowrap>Найменування</td>
						<td class="top right bottom" nowrap>Марка/модель</td>
						<td class="top right bottom">Вартiсть ДО / страхова сума, грн.</td>
					</tr>
					<tr>
						<td class="right bottom center">{if $values.equipment.0.title}{$values.equipment.0.title}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.0.title}{$values.equipment.0.brand}/{$values.equipment.0.model}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.0.title}{$values.equipment.0.price|moneyformat:-1}{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom center">{if $values.equipment.1.title}{$values.equipment.1.title}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.1.title}{$values.equipment.1.brand}/{$values.equipment.1.model}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.1.title}{$values.equipment.1.price|moneyformat:-1}{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom center">{if $values.equipment.2.title}{$values.equipment.2.title}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.2.title}{$values.equipment.2.brand}/{$values.equipment.2.model}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.2.title}{$values.equipment.2.price|moneyformat:-1}{else}----{/if}</td>
					</tr>
					</table>
				{/if}	
				</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=5 width="100%">
			{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE1 || 
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE2 ||
			$values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE3}
			<tr>
				<td width="115">Територія дії Договору страхування </td>
				<td class="all">
				{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE1}
				згідно затверджених маршрутів автосалону та/або дилерського підприємства, а також в радіусі трьох км від затвердженого маршруту, та при виїздному тест-драйві -  в радіусі трьох км від адреси, куди доставлявся ТЗ для проведення тест-драйву 																							
				{else}
				{$values.registration_cities_title} ({$values.registration_regions_title})
				{/if}
				</td>
			</tr>
			{else}
			<tr>
				<td width="115">Місце реєстрації</td>
				<td class="all">{$values.registration_cities_title} ({$values.registration_regions_title})</td>
			</tr>
			{/if}
			</table>
		</td>
	</tr>
</table><br />
{if $testdrive==0}
<!--p>Додатково прошу застрахувати водiя та пасажирiв ТЗ вiд нещасного випадку на транспортi - <b>{if $values.amount_accident>0}ТАК{else}НI{/if}</b></p-->
{/if}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>4. Перелiк страхових випадкiв</b><div class="small">(непотрiбне закреслити)</div></td>
	<td>
		<!--p>4.1. при страхуваннi ТЗ:</p-->
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center {if $values.dtp == 0}u{/if}">1. ДТП</td>
			<td class="top right bottom center {if $values.pdto == 0}u{/if}">2. ПДТО</td>
			<td class="top right bottom center {if $values.actofgod == 0}u{/if}">3. Стихiйнi<br />явища</td>
			<td class="top right bottom center {if $values.downfall <= 0}u{/if}">4. Падiння лiтальних апаратiв або їх частин, дерев,<br />iнших предметiв, тiл космiчного походження</td>
			<td class="top right bottom center {if $values.animal == 0}u{/if}">5. Напад тварин</td>
			<td class="top right bottom center {if $values.fire == 0}u{/if}">6. Пожежа, вибух,<br />самозаймання ТЗ</td>
			<td class="top right bottom center {if $values.hijacking == 0}u{/if}">7. Незаконне<br />заволодiння</td>
		</tr>
		</table><br />
{if $testdrive==0}
		<!--p>4.2.при страхуваннi вiд нещасного випадку:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center {if $values.amount_accident == 0}u{/if}">1. Тимчасова втрата застрахованою особою загальної працездатностi</td>
			<td class="top right bottom center {if $values.amount_accident == 0}u{/if}">2. Стiйка втрата застрахованою особою загальної працездатностi (встановлення групи iнвалiдностi)</td>
			<td class="top right bottom center {if $values.amount_accident == 0}u{/if}">3. Смерть застрахованої особи внаслiдок нещасного випадку</td>
		</tr>
		</table><br>

		<p>4.3.страхова сума при страхуваннi вiд нещасного випадку:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right left center">водiя (в том числi будь-яка iз осiб, допущених до керування застрахованим ТЗ), грн.</td>
			<td class="top right center">пасажирiв за системою мiсць, грн.</td>
		</tr>
		<tr>
			<td class="top right bottom left center">{if $values.amount_accident>0}{$values.price_accidentDriver|moneyformat:-1}{else}----{/if}</td>
			<td class="top right bottom center">{if $values.amount_accident>0}{$values.price_accidentPassengers|moneyformat:-1}{else}----{/if}</td>
		</tr>
		</table-->
{/if}		
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>5. Кiлькiсть осiб,<br />допущених до керування</b></td>
	<td>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center">№ п/п</td>
			<td class="top right bottom center">Прiзвище, iм'я, по батьковi</td>
			<td class="top right bottom center">Вiк</td>
			<td class="top right bottom center">Серiя та №<br />посвiдчення водiя</td>
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
			<td class="right bottom">Будь-яка особа на законних підставах</td>
			<td class="right bottom center">----</td>
			<td class="right bottom center">----</td>
			<td class="right bottom center">----</td>
		</tr>
		{/if}
		{section name=personroll loop=$values.persons}
		<tr>
			<td class="right bottom left center">{cycle values="2,3,4,5"}</td>
			<td class="right bottom">{$values.persons[personroll].lastname} {$values.persons[personroll].firstname} {$values.persons[personroll].patronymicname}</td>
			<td class="right bottom">{$values.persons[personroll].driver_ages_title}</td>
			<td class="right bottom">{$values.persons[personroll].driver_licence_series} {$values.persons[personroll].driver_licence_number}</td>
			<td class="right bottom">{$values.persons[personroll].driver_licence_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		</tr>
		{/section}
		</table>
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>6. Строк страхування</b></td>
	<td>з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" rowspan=3 valign=top><b>7. Територія дії Договору</b></td>
		<td class="top right bottom left" colspan=4>Україна, згідно наступному маршруту руху ТЗ:</td>
	</tr>
	<tr>
	<td  class="left bottom">Пункт відправки</td>
	<td class="left bottom">{$values.startplace}</td>
	<td class="left bottom">Пункт прибуття</td>
	<td class="left bottom right">{$values.endplace}</td>
	</tr>
	<tr>
	<td  class="left bottom">Автомобільна траса</td>
	<td  class="left bottom">{$values.testdriveroad}</td>
	<td  class="left bottom">Міста, розташовані за маршрутом руху</td>
	<td  class="left bottom right">{$values.testdrivecities}</td>
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"  valign=top><b>8. Додатковi умови договору страхування</b></td>
	<td>
		<p>8.1. Варiант франшизи (за ризиками 4.1. - 4.6. та окремо за ризиком 4.7.):</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left">за ризиками 4.1. - 4.6.: {$values.items[roll].deductibles_value0|sign:$values.items[roll].deductibles_absolute0}; за ризиком 4.7.: {$values.items[roll].deductibles_value1|sign:$values.items[roll].deductibles_absolute1}</td>
		</tr>
		</table><br />

		<p>8.2. Умови внесення страхового платежу:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="all{if $values.paymentsCount > 1} u{/if}">8.2.1. одноразово 100% платежу</td>
			<td class="top right bottom{if $values.paymentsCount != 2} u{/if}">8.2.2. 50%/50%</td>
			<td class="top right bottom u">8.2.3. 40%/20%/20%/20%</td>
			<td class="top right bottom{if $values.paymentsCount != 4} u{/if}">8.2.4. 25%/25%/25%/25%</td>
		</tr>
		</table><br />
		<p>8.3. Пріорітет виплати:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="all{if $values.priority_payments_id > 1} u{/if}">8.3.1. СТО</td>
			<td class="top right bottom{if $values.priority_payments_id <=1} u{/if}">8.3.2. експертиза</td>
			
		</tr>
		</table><br />

		<p>8.4. Територія дії договору страхування:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left">{$values.zones_title}</td>
		</tr>
		</table>
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td rowspan="5" width="20%"><b>9. Додатковi опцiї</b></td>
	<td class="right bottom left top">страхування з вирахуванням зносу</td>
	<td class="right bottom top">{if !$values.options_deterioration_no}так{else}нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">страхування таксі</td>
	<td class="right bottom">{if  $values.options_taxy}так{else}нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">неагрегатна страхова сума</td>
	<td class="right bottom">{if $values.options_agregate_no}так{else}нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">страхування без встановленого протиугінного пристрою</td>
	<td class="right bottom">{if !$values.protection_signalling}так{else}нi{/if}</td>
</tr>
<tr>
	<td class="right bottom left">Виплата страхового відшкодування без довідки ДАІ у разі настання ризиків "ДТП" або "ПДТО" у випадку, якщо вартість відновлювального  ремонту пошкодженого ТЗ не перевищує 15 000 (п'ятнадцять тисяч) гривень, один раз по кожному застрахованому ТЗ протягом строку дії Договору</td>
	<td class="right bottom">так</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td><b>10. Договiр страхування прошу укласти на користь Вигодонабувача - {if $values.assured_title}ТАК{else}НI{/if}</b></td>
</tr>
</table>
{if $values.assured_title}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Вигодонабувач</td>
	<td class="all">{$values.assured_title}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">прiзвище, iм'я, по батьковi (назва органiзацiї), реквiзити Вигодонабувача</td>
</tr>
<tr>
	<td>Адреса, телефон</td>
	<td class="all" valign="top">{$values.assured_address} {$values.assured_phone}</td>
</tr>
</table><br />
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>10. Декларацiя Страхувальника</b></td>
	<td class="all">
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «Експрес Страхування». Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору і буде його невід’ємною частиною.</p>
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.</p>
		<p>Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання моїх персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки. Я проінформований про те, що якщо при укладанні Договору страхова сума по ТЗ буде меншою за ринкову (дійсну) вартість ТЗ більше, ніж на 10%, то при настанні страхового випадку Страховик здійснює виплату страхового відшкодування пропорційно співвідношенню страхової суми до ринкової (дійсної) вартості ТЗ на дату укладання Договору.</p>
		<p>Інформація, щодо:</p>
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
	<td width="20%"  >&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}{else}{if $values.new_director == 1}Щучьєва Т.А.{else}Скрипник О.О.{/if}{/if}</td>
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td  >&nbsp;</td>
</tr>
</table>
<div style="page-break-after: always"></div>
{/section}
</body>
</html>