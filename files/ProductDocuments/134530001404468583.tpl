<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Тест драйв Тип 4 Заявление</title>
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
		за програмою "КАСКО ТЕСТ ДРАЙВ. ТИП 4"
		</h2><br /><br />
		
		
		<p>Прошу укласти договір страхування транспортного засобу (ТЗ) згідно наведеної нижче інформації.</p>
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
					<td align="right">рік випуску</td>
					<td class="top right bottom left">{$values.year}</td>
					<td align="right">колір</td>
					<td class="top right bottom left">{$values.colors_title}</td>
					<td class="top right bottom" align="right">дійсна вартість ТЗ, грн.</td>
					<td class="top right bottom">{$values.car_price|moneyformat:-1}</td>
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
			</tr>
			</table><br />

			<table cellspacing=0 cellpadding=0 width="100%">
			<tr>
				<td width=50%>
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
				 
				<td  width=50%>
					&nbsp;
				</td>
			</tr>
			</table><br />
		</td>
	</tr>
</table><br />



<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>4. Перелік страхових випадків</b><div class="small">(непотрібне закреслити)</div></td>
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
			<td class="right bottom">
			будь-яка особа, яка керує ТЗ на законних підставах{if $values.products_id==$smarty.const.PRODUCT_KASKO_TESTDRIVE1}, зі стажем водіння більше двох років{/if}
			</td>
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
		<td width="20%"><b>8. Прошу дозволити сплату страхового платежу (непотрібне закреслити)</b></td>
		<td class="all{if $values.paymentsCount > 1} u{/if}">одним платежем</td>
		<td class="top right bottom{if $values.paymentsCount != 2} u{/if}">двома платежами</td>
		<td class="top right bottom{if $values.paymentsCount != 4} u{/if}">чотирма платежами</td>
	</tr>
</table><br />
	
<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>9. Додаткова інформація</b></td>
		<td class="top right bottom left">Варіант франшизи: за ризиками 4.1. - 4.6.: {$values.deductibles_value0|sign:$values.deductibles_absolute0}; за ризиком 4.7.: {$values.deductibles_value1|sign:$values.deductibles_absolute1}</td>
	</tr>
</table><br />
	
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td>договір страхування прошу укласти на користь Вигодонабувача - {if $values.assured_title}ТАК{else}НІ{/if}</td>
</tr>
</table>
{if $values.assured_title}
	<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%">ПІБ (назва), реквізити Вигодонабувача</td>
		<td class="all">{$values.assured_title}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Адреса, телефон Вигодонабувача</td>
		<td class="all" valign="top">{$values.assured_address} {$values.assured_phone}</td>
	</tr>
	</table><br />
{/if}
	
	

<table cellspacing=0 cellpadding=5 width="100%">
 
	<tr>
		<td rowspan="5" width="20%" valign="top"><b>10. Додаткові опції</b></td>
		<td class="right bottom left top">Витрати на отримання довідок з відповідних компетентних органів при настанні страхового випадку</td>
		<td class="right bottom top">так</td>
	</tr>
	<tr>
		<td class="right bottom left">Витрати на евакуацію (транспортування) пошкодженого ТЗ до СТО за умови неможливості пересування ТЗ дорогами загального користування власним ходом після настання страхового випадку, на одне завантаження, розвантаження та перевезення ТЗ в межах 500 грн. за кожним страховим випадком</td>
		<td class="right bottom">так</td>
	</tr>
 
	
	<tr>
		<td class="right bottom left">Страхування без вирахування зносу</td>
		<td class="right bottom">так</td>
	</tr>
	<tr>
		<td class="right bottom left">Виплата страхового відшкодування без довідки ДАІ у разі настання ризиків "ДТП" або "ПДТО" у випадку, якщо вартість відновлювального  ремонту пошкодженого ТЗ не перевищує 15 000 (п'ятнадцять тисяч) гривень, один раз по кожному застрахованому ТЗ протягом строку дії Договору</td>
		<td class="right bottom">так</td>
	</tr>
	 
</table><br />

	
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>11. Декларація Страхувальника</b></td>
	<td class="all">
		<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ "Експрес Страхування". Всі приведені вище твердження і свідчення являються правдивими і ніяка інформація щодо об'єкту страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору (полісу сертифікату) страхування і буде його невід’ємною частиною.</p><br />
		<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про об’єкт страхування, надана в цій заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.</p>
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
	<td width="20%"  >&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}Директор Щучьєва Т.А.{/if}</td>
	<!--{if $values.ground_kasko11}{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}{else}Щучьєва Т.А.{/if}-->
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td  >&nbsp;</td>
</tr>
</table>
</body>
</html>