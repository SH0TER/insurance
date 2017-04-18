<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Заявление Дженерали</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/generali.png" width="226" height="43" /></td>
	<td align="center">
		<h1 align="center">ЗАЯВА</h1>
		<h2 align="center">на страхування транспортного засобу</h2><br /><br />
		<p>Прошу укласти договір страхування транспортного засобу (ТЗ) на основі інформації наведеної нижче:</p>
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
	<td width="20%">Ідент. код (код ЄДРПОУ)</td>
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
{if $values.insurer_person_types_id == 2}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">ПІБ керівника/уповноваженої особи, посада, на підставі чого діє</td>
	<td class="all">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{if $values.insurer_position}, {$values.insurer_position}{/if}{if $values.insurer_ground}, {$values.insurer_ground}{/if}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Рахунок</td>
	<td>№</td>
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
</table> 

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
				<td class="right bottom">{$values.race}</td>
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
				<td rowspan="2" class="top right bottom" align="right">Вантажопідйомність,<br />кількість місць - для автобусів</td>
				<td rowspan="2" class="top right bottom">----</td>
				<td rowspan="2" class="top right bottom" align="right">Кількість ключів запалювання, шт</td>
				<td rowspan="2" class="top right bottom">----</td>
				<td rowspan="2" class="top right bottom" align="right">КПП</td>
				<td class="top right bottom" align="right">автомат</td>
				<td class="top right bottom" align="center">{if $values.transmissions_id == 2}Так{else}----{/if}</td>
			</tr>
			<tr>
				<td class="right bottom" align="right">механіка</td>
				<td class="right bottom" align="center">{if $values.transmissions_id == 1}Так{else}----{/if}</td>
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=5 width="100%">
			<tr>
				<td width="25%" align="right">колір</td>
				<td width="25%" class="top right bottom left">{$values.colors_title}</td>
				<td width="25%" class="top right bottom" align="right">дійсна вартість ТЗ, грн.</td>
				<td width="25%" class="top right bottom">{$values.car_price|moneyformat:-1}</td>
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
						<td class="right bottom left">доручення</td>
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
						<td class="right bottom center">{if !$values.options_taxy}X{else}----{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">в робочих цілях</td>
						<td class="right bottom center">----</td>
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
						<td rowspan="4">Засоби захисту </td>
						<td class="all">Mul-T-Lock</td>
						<td class="top right bottom center">{if $values.protection_multlock}так{else}ні{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">Immobilaser</td>
						<td class="right bottom center">{if $values.protection_immobilaser}так{else}ні{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">Механічна</td>
						<td class="right bottom center">{if $values.protection_manual}так{else}ні{/if}</td>
					</tr>
					<tr>
						<td class="right bottom left">Сигналізація</td>
						<td class="right bottom center">{if $values.protection_signalling}так{else}ні{/if}</td>
					</tr>
					</table>
				</td>
				<td width="4%">&nbsp;</td>
				<td>
					<table cellspacing=0 cellpadding=5 width="100%">
					<tr>
						<td rowspan="4">Додаткове<br />обладнання</td>
						<td class="all" nowrap>Найменування</td>
						<td class="top right bottom" nowrap>Марка/модель</td>
						<td class="top right bottom">Вартість ДО / страхова сума, грн.</td>
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
				<td width="115">Місце реєстрації</td>
				<td class="all">{$values.registration_cities_title} ({$values.registration_regions_title})</td>
			</tr>
			</table>
		</td>
	</tr>
</table> 


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>4. Перелік страхових випадків</b><div class="small">(непотрібне закреслити)</div></td>
	<td>
		<p>4.1. при страхуванні ТЗ:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left center {if $values.dtp == 0}u{/if}">1. ДТП</td>
			<td class="top right bottom center {if $values.pdto == 0}u{/if}">2. ПДТО</td>
			<td class="top right bottom center {if $values.actofgod == 0}u{/if}">3. Стихійні<br />явища</td>
			<td class="top right bottom center {if $values.downfall <= 0}u{/if}">4. Падіння літальних апаратів або їх частин, дерев,<br />інших предметів, тіл космічного походження</td>
			<td class="top right bottom center {if $values.animal == 0}u{/if}">5. Напад тварин</td>
			<td class="top right bottom center {if $values.fire == 0}u{/if}">6. Пожежа, вибух,<br />самозаймання ТЗ</td>
			<td class="top right bottom center {if $values.hijacking == 0}u{/if}">7. Незаконне<br />заволодіння</td>
		</tr>
		</table> 

	</td>
</tr>
</table> 

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
</table> 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>6. Строк страхування</b></td>
	<td>з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table> 

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>7. Додаткові умови договору страхування</b></td>
	<td>
		<p>7.1. Варіант франшизи (за ризиками 4.1.1. - 4.1.6. та окремо за ризиком 4.1.7.):</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="top right bottom left">за ризиками 4.1.1. - 4.1.6.: {$values.deductibles_value0|sign:$values.deductibles_absolute0}; за ризиком 4.1.7.: {$values.deductibles_value1|sign:$values.deductibles_absolute1}</td>
		</tr>
		</table><br />

		<p>7.2. Умови внесення страхового платежу:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="all{if $values.paymentsCount > 1} u{/if}">7.2.1. одноразово 100% платежу</td>
			<td class="top right bottom{if $values.paymentsCount != 2} u{/if}">7.2.2. 50%/50%</td>
			<td class="top right bottom u">7.2.3. 40%/20%/20%/20%</td>
			<td class="top right bottom{if $values.paymentsCount != 4} u{/if}">7.2.4. 25%/25%/25%/25%</td>
		</tr>
		</table><br />
		<p>7.3. Пріорітет виплати:</p>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td class="all{if $values.priority_payments_id > 1} u{/if}">7.3.1. СТО</td>
			<td class="top right bottom{if $values.priority_payments_id <=1} u{/if}">7.3.2. експертиза</td>
			
		</tr>
		</table><br />

		
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td rowspan="1" width="20%"><b>8. Додаткові опції</b></td>
	<td class="right bottom left top">страхування з вирахуванням зносу</td>
	<td class="right bottom top">{if !$values.options_deterioration_no}так{else}ні{/if}</td>
</tr>

</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td><b>9. Договір страхування прошу укласти на користь Вигодонабувача - {if $values.assured_title}ТАК{else}НІ{/if}</b></td>
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
	<td align="center" class="small">прізвище, ім'я, по батькові (назва організації), реквізити Вигодонабувача</td>
</tr>
<tr>
	<td>Адреса, телефон</td>
	<td class="all" valign="top">{$values.assured_address} {$values.assured_phone}</td>
</tr>
</table><br />
{/if}

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>10. Декларація Страхувальника</b></td>
	<td class="all">
		З Правилами страхування ознайомлений(а) та згоден(на). При цьому заявляю, що транспортний засіб, який мною страхується не застрахований в інших страхових компаніях за тими ж видами ризиків і знаходиться у технічно справному стані і що до керування ним не будуть допущені особи, які не мають на це законного права. Мене поінформовано про те, що у разі подання мною неправильних даних у цій заяві або при наданні таких Страховику при заповненні страхового поліса, а також у випадку допущення мною умисного перекручення інформації після настання страхового випадку, мене може бути позбавлено права на отримання страхового відшкодування.
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
	<td class="bottom">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}Директор Щучьєва Т.А.{/if}</td>
	<!--{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}-->
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td  >&nbsp;</td>
</tr>
</table>
</body>
</html>