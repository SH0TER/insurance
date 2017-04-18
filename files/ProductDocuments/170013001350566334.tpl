<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Заявление 104 КАСКО. Кредит. Ідея Банк (2-й г)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1 align="center">ЗАЯВА</h1>
		<h2 align="center">на страхування транспортного засобу{if $values.products_id==89} в рамках акції "Щаслива п'ятірка"{/if}</h2><br /><br />
		
		
		<p><b>Прошу укласти договір страхування транспортного засобу (ТЗ) згідно наведеної нижче інформації.<b></p>
	</td>
	<td width="230" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
	<td align="right" width="170">
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
	<td class="all">----</td>
	<td align="center">МФО</td>
	<td class="all">----</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>2. Власник</b></td>
	<td class="all">{$values.ownerTitle}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">прізвище, ім'я, по батькові (назва організації)</td>
</tr>
</table><br />


<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%" valign="top"><b>3. Ідентифікація ТЗ</b></td>
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
				<td class="right bottom">{if $values.race==0}---{else}{$values.race}{/if}</td>
			</tr>
			<tr>
				<td align="right">Тип ТЗ</td>
				<td class="right bottom left">{if $values.car_types_id==8}легковий{/if}{if $values.car_types_id==9}вантажний{/if}{if $values.car_types_id==10}вантажний{/if}{if $values.car_types_id==11}мікроавтобус{/if}{if $values.car_types_id==12}пасажирський автобус{/if}{if $values.car_types_id==13}пасажирський автобус{/if}{if $values.car_types_id==14}причеп{/if}{if $values.car_types_id==15}спеціальний автомобіль{/if}{if $values.car_types_id==16}сільськогосподарський ТЗ{/if}</td>
				<td align="right">об'єм двигуна</td>
				<td class="right bottom left" colspan="3">{$values.engine_size}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td rowspan="2" align="right">рік випуску</td>
				<td rowspan="2" class="top right bottom left">{$values.year}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td width="15%" align="right">колір</td>
				<td width="15%" class="top right bottom left">{$values.colors_title}</td>
				<td width="15%" class="top right bottom" align="right">Страхова сума ТЗ, грн.</td>
				<td width="15%" class="top right bottom">{$values.car_price|moneyformat:-1}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=0 width="100%">
			<tr>
				<td width="32%">
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="4" width="45%">Розпорядження (користування) ТЗ на підставі (відмітити Х)</td>
						<td width="45%" class="all">права власності</td>
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
						<td class="right bottom left">лізингу</td>
						<td class="right bottom center">----</td>
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
						<td class="right bottom center">{if !$values.options_taxy && $values.insurer_person_types_id == 1}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">в робочих цілях</td>
						<td class="right bottom center">{if $values.insurer_person_types_id == 2}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">оренда, лізинг</td>
						<td class="right bottom center">----</td>
					</tr>
					</table>
				</td>
				<td width="2%">&nbsp;</td>
				<td width="32%">
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="2" width="45%">Місце зберігання</td>
						<td width="45%" class="all">{if $values.financial_institutions_id!=44}стоянка, що знаходиться під охороною або гараж(у нічний час з 00:00 до 06:00){else}стоянка, що знаходиться під охороною або гараж (у нічний час з 00:00 до 06:00{/if}</td>
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
			{if $values.protection_multlock || $values.protection_immobilaser || $values.protection_manual || $values.protection_signalling}
			{assign var=alarm value=1}
			{else}
			{assign var=alarm value=0}
			{/if}
			<table cellspacing=0 cellpadding=0 width="100%">
			<tr>

				<td>
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="4">Додаткове<br />обладнання</td>
						<td class="all" nowrap>Найменування</td>
						<td class="top right bottom" nowrap>Марка/модель</td>
						<td class="top right bottom">{if $values.financial_institutions_id!=44}Вартість ДО / страхова сума, грн.{else}Страхова сума{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">{if $values.equipment.0.title}{$values.equipment.0.title}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.0.title}{$values.equipment.0.brand}/{$values.equipment.0.model}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.0.title}{$values.equipment.0.price|moneyformat:-1}{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">{if $values.equipment.1.title}{$values.equipment.1.title}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.1.title}{$values.equipment.1.brand}/{$values.equipment.1.model}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.1.title}{$values.equipment.1.price|moneyformat:-1}{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">{if $values.equipment.2.title}{$values.equipment.2.title}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.2.title}{$values.equipment.2.brand}/{$values.equipment.2.model}{else}----{/if}</td>
						<td class="right bottom center">{if $values.equipment.2.title}{$values.equipment.2.price|moneyformat:-1}{else}----{/if}</td>
					</tr>
					</table>
				</td>
			</tr>
			</table><br />


            <table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td width="20%">Пріоритет виплати</td>
				<td class="all" align="center" width="40%">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}<s>{/if}</td>
                <td class="top right bottom" align="center" width="40%">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
			</tr>
			</table><br />
			<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">Місце реєстрації ТЗ</td>
		<td class="all" align="center" width="80%">{$values.registration_cities_title}</td>
	</tr>
</table><br />
		</td>
	</tr>
</table><br />
{if $values.yearsPaymentsCount==0 && $values.financial_institutions_id!=54}
<p>Додатково прошу застрахувати водія та пасажирів ТЗ від нещасного випадку на транспорті - <b>{if $values.amount_accident>0}ТАК{else}НІ{/if}</b></p>
{/if}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>4. Перелік страхових випадків</b><div class="small">(непотрібне закреслити)</div></td>
	<td>
		{if $values.yearsPaymentsCount==0  || $values.financial_institutions_id==35}<p>4.1. при страхуванні ТЗ:</p>{/if}
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
		<p>4.2.при страхуванні від нещасного випадку:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center {if $values.amount_accident == 0}u{/if}">1. Тимчасова втрата застрахованою особою загальної працездатності</td>
			<td class="top right bottom center {if $values.amount_accident == 0}u{/if}">2. Стійка втрата застрахованою особою загальної працездатності (встановлення групи інвалідності)</td>
			<td class="top right bottom center {if $values.amount_accident == 0}u{/if}">3. Смерть застрахованої особи внаслідок нещасного випадку</td>
		</tr>
		</table><br>
		{if $values.financial_institutions_id!=35}
		<p>4.3.страхова сума при страхуванні від нещасного випадку:</p>
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
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>5. Кількість осіб,<br />допущених до керування</b></td>
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
			<td class="right bottom">Будь-який водій на законних підставах</td>
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
	<td width="20%"><b>6. Строк дії Договору</b></td>
	<td>з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table><br />
{if $values.retail}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>Протягом строку дії Договору прошу встановити таку кількість періодів страхування з можливістю сплати страхового платежу за кожний період страхування окремо (непотрібне закреслити)</b></td>
	<td>
	
	<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="all{if $values.paymentsCount > 1 || $values.options_month500} u{/if}">  1 період страхування</td>
			<td class="top right bottom{if ($values.paymentsCount != 2 && !$values.options_month500)  || $values.options_month500} u{/if}">  2 періоди страхування</td>
			<td class="top right bottom{if $values.paymentsCount != 4  || $values.options_month500} u{/if}">  4 періоди страхування</td>
			<td class="top right bottom{if !$values.options_month500} u{/if}">  використати опцію "перший місяць страхування за 500 грн."</td>
		</tr>
	</table><br />
	</td>
</tr>
</table>
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" valign="top"><b>7. Додаткова інформація</b></td>
	<td>
		<p>Варіант франшизи:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left">
			
			До моменту огляту ТЗ представником Страховика та складання Акту огляду ТЗ за страховими випадками, вказаними в п.п.1-7 п.4 застосовується безумовна франшиза - 15.00% від страхової суми. Після огляду ТЗ та складання Акту огляду ТЗ застосовується безумовна франшиза за страховими ризиками, вказаними в п.п.1-6 п.4 -  2.00% від страхової суми; за страховим випадком, вказаним в п.п.7 п.4 - 10.00% від страхової суми.    
			</td>
		</tr>
		</table><br />
		
		
		
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td rowspan="4" width="20%"><b>8. Додаткові опції</b></td>
	<td class="right bottom left top">без франшизи на вітрові стекла</td>
	<td class="right bottom top">{if $values.options_deductible_glass_no}так{else}ні{/if}</td>
</tr>
<tr>
	<td class="right bottom left">неагрегатна страхова сума</td>
	<td class="right bottom">{if $values.options_agregate_no}так{else}ні{/if}</td>
</tr>
<tr>
    <td class="right bottom left">фізичний знос не вираховується</td>
	<td class="right bottom">{if $values.options_deterioration_no}так{else}ні{/if}</td>
</tr>
<tr>
    <td class="right bottom left">страхування таксі</td>
    <td class="right bottom">{if $values.options_taxy}так{else}ні{/if}</td>
</tr>
<tr>
	<td class="right bottom left">опція страхування "50/50"</td>
	<td class="right bottom">{if $values.options_fifty_fifty}так{else}ні{/if}</td>
</tr>
</table><br />


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">договір страхування прошу укласти на користь Вигодонабувача</td>
	<td class="all">ТАК</td>
</tr>
<tr>
	<td width="20%">назва, реквізити Вигодонабувача</td>
	<td class="all">
	ПАТ "Ідея Банк"
	</td>
</tr>
<tr>
	<td>Адреса, телефон</td>
	<td class="all" valign="top">79008, м.Львів, вул. Валова, буд. 11, тел. (032) 235-09-38</td>
</tr>
</table><br />
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Кредитний договір № </td>
	<td class="top right left" width="20%">&nbsp;{$values.credit_agreement_number}</td>
    <td width="5%" align="center"> від </td>
    <td class="all" width="10%">&nbsp;{if $values.credit_agreement_date!='0000-00-00'}{$values.credit_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}</td>
    <td></td>

</tr>
<tr>
    <td width="20%">Договір застави № </td>
	<td class="top bottom right left" width="20%">&nbsp;{$values.pawn_agreement_number}</td>
    <td width="5%" align="center"> від </td>
    <td class="bottom right left" width="10%">&nbsp;{if $values.pawn_agreement_date!='0000-00-00'}{$values.pawn_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}</td>
    <td></td>
</tr>
</table><br />
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
	<td width="20%"><b>9. Декларація Страхувальника</b></td>
	<td class="all">
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ «Експрес Страхування». Всі приведені вище твердження і свідчення являються правдивими і ніяка інформація щодо об'єкту страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору і буде його невід’ємною частиною.
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про об’єкт страхування, надана в цій заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.
		<p>Я гарантую,  що маю право на передачу персональних даних фізичних осіб, зазначених в цій Заяві та право надавати згоду на обробку персональних даних від їх імені. Я надаю свою безумовну безстрокову згоду ТДВ «Експрес Страхування» на обробку та використання таких персональних даних, зазначених у Договорі страхування, та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору страхування, в тому числі паспортних  даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною добровільно з метою реалізації цілей обробки.
		<p>Я гарантую, що володію повною та достовірною інформацією про предмет (об'єкт) страхування. 
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
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom">{if $values.ground_kasko}{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}{else}{if $values.new_director == 1}Щучьєва Т.А.{else}Скрипник О.О.{/if}{/if}</td>
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