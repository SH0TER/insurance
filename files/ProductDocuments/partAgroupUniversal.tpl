{if $values.agreement_types_id==3}
{include file = '../files/ProductDocuments/add_agreement_restore_amount.tpl'}
{/if}
{if $values.agreement_types_id>0 && $values.agreement_types_id!=3}
{include file = '../files/ProductDocuments/add_agreement_start_new.tpl'}
{/if}

{if $values.agreement_types_id>0}
<div align=right>
Додаток 1<br> 
до Додаткової угоди № {$values.sub_number}<br> 
від  {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br> <br> 
</div>
{/if}

<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
 
        <h1>Договір добровільного страхування наземних транспортних засобів, які є предметом застави</h1>
		<p><h1>Частина "А" Договору страхування</h1></p>
 
		<h1>Особливі умови страхування</h1>
	</td>
	<td width="220" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
</tr>
<tr>
    <td align="right" colspan="3">
	{if $values.agreement_types_id==0}
		<p>№ {$values.number}</p>
		<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	{/if}	
	</td>
</tr>
</table><br />

{if $values.agreement_types_id>0}
Сторони Договору страхування наземних транспортних засобів № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.  (надалі - "Договір страхування") уклали цю Додаткову угоду про внесення змін до Договору  страхування та домовилися викласти з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. частину А Договору страхування в наступній редакції:
{else}
{if $values.top_agency_id==557}
	<p>
	Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір) укладений ПАТ «Универсал Банк»,  
	в особі <br><br>______________________________________________________________________________________________________________________________________________________________________________________________,
	<br><br> що діє на підставі _________________________________________________________________________________________________________________________________________________________________________,
	<br><br> та ___________________________________________________________________________________________________________________________________________________________________________________________,
	<br><br> що діє на підставі _________________________________________________________________________________________________________________________________________________________________________
	<br><br> від імені та в інтересах ТДВ «Експрес Страхування» (далі - Страховик), відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).

{elseif ($values.agencies_id == 1469 && $values.seller_agencies_id == 0) || $values.agencies_id == 1496 || $values.agencies_id == 1497 || $values.agencies_id == 1498}
Цей Договір добровільного страхування наземних транспортних засобів (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2}, що діє на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{elseif $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou && $values.agencies_id!=560 && $values.agencies_id!=1486 && $values.agencies_id!=1469111}
	<p>
	Цей Договір добровільного страхування наземних транспортних засобів (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2} та {$values.findirector2}, що діють на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).

{else}
    {if $values.new_director == 1}
        <p>Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір) укладений ТДВ "Експрес Страхування" (далі - Страховик), в особі Директора Щучьєвої Тетяни Андріївни, що діє на підставі Статуту, відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р. (далі - Правила)</p>
    {else}
	    <p>Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір) укладений ТДВ "Експрес Страхування" (далі - Страховик), в особі Директора Скрипника Олександра Олексійовича, що діє на підставі Статуту, відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р. (далі - Правила)</p>
    {/if}
{/if}

{/if}


<br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>1. Страховик (з однієї сторони)</b></td>
	<td class="top right left" colspan="2"><b>ТДВ "Експрес Страхування". Адреса: Україна, 01004, м. Київ, вул.Велика Васильківська, 15/2</b></td>
</tr>
{if $values.insurer_person_types_id==1}
<tr>
	<td width="20%"><b>2. Страхувальник</b></td>
	<td class="all">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
	<td width="10%" class="top right bottom" nowrap>{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.н.</td>
</tr>
{/if}
{if $values.insurer_person_types_id==2}
<tr>
	<td width="20%"><b>2. Страхувальник</b></td>
	<td class="left top bottom">назва</td>
	<td colspan="3" class="all">{$values.insurer_company}</td>
</tr>
<tr>
	<td></td>
	<td class="left bottom">в особі</td>
	<td width="25%" class="left right bottom">{$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
	<td class="right bottom">що діє на підставі</td>
	<td class="right bottom" width="25%">{$values.insurer_ground}</td>
</tr>
{/if}
</table>
<!--
{if $values.insurer_person_types_id==1}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>фiзична особа</b></td>
	<td class="all">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
	<td width="10%" class="top right bottom" nowrap>{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.н.</td>
</tr>
</table>
{/if}
{if $values.insurer_person_types_id==2}
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>юридична особа</b></td>
	<td class="left top bottom">назва</td>
	<td colspan="3" class="all">{$values.insurer_company}</td>
</tr>
<tr>
	<td></td>
	<td class="left bottom">в особі</td>
	<td width="25%" class="left right bottom">{$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
	<td class="right bottom">що діє на підставі</td>
	<td class="right bottom" width="25%">{$values.insurer_ground}</td>
</tr>
</table>
{/if}
-->
<table cellspacing=0 cellpadding=5 width="100%">	
<tr>
	<td width="20%">Адреса, телефон</td>
	<td class="left right bottom"  colspan="7">{$values.insurer_address}</td>
</tr>
<tr>
	<td colspan=9>з другої сторони, разом надалі – Сторони, та</td>
</tr>
<tr>
	<td><b>3. Вигодонабувач</b></td>
	<td class="left right top" colspan="7">
		  {$values.assured_title}. ІПН (ЄРДПОУ): {$values.assured_identification_code}, 04114, м. Київ, вул. Автозаводська, 54/19, тел. (044) 391-57-02 <br />
	 
	</td>
</tr>

<tr>
	<td><b>4. Водій</b></td>
	<td class="left right bottom top" colspan="7">
		особа, зазначена в Заяві на страхування, яка керує ТЗ на законних підставах (без обмежень в залежності від стажу керування ТЗ та віку)
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
 
<tr>
	<td><b>5. Транспортний засіб</b></td>
	<td>
		<table width="100%">
		<tr>
			<td>{$values.brand} / {$values.model} {if $values.modification}/ {$values.modification}{/if}</td>
		</tr>
		<tr>
			<td class="top small">марка, модель, модифікація</td>
		</tr>
		<tr>
			<td>
				<table width="100%">
				<tr>
					<td width="25%">{if $values.car_types_id==8}легковий{/if}{if $values.car_types_id==9}вантажний{/if}{if $values.car_types_id==10}вантажний{/if}{if $values.car_types_id==11}мікроавтобус{/if}{if $values.car_types_id==12}пасажирський автобус{/if}{if $values.car_types_id==13}пасажирський автобус{/if}{if $values.car_types_id==14}причеп{/if}{if $values.car_types_id==15}спеціальний автомобіль{/if}{if $values.car_types_id==16}сільськогосподарський ТЗ{/if}</td>
					<td>&nbsp;</td>
					<td>{$values.year}</td>
					<td>&nbsp;</td>
					<td>{$values.sign}</td>
					<td>&nbsp;</td>
					<td>{$values.shassi}</td>
				</tr>
				<tr>
					<td class="top small">тип транспортного засобу</td>
					<td>&nbsp;</td>
					<td class="top small">рік випуску</td>
					<td>&nbsp;</td>
					<td class="top small">державний номер </td>
					<td>&nbsp;</td>
					<td class="top small">номер кузова/шасі</td>
				</tr>
				<tr>
					<td>{$values.engine_size}</td>
					<td>&nbsp;</td>
					<td>{$values.colors_title}</td>
					<td>&nbsp;</td>
					<td>{$values.race}</td>
					<td>&nbsp;</td>
					<td>{$values.car_engine_type_title}</td>
				</tr>
				<tr>
					<td class="top small">об'єм двигуна </td>
					<td>&nbsp;</td>
					<td class="top small">колір</td>
					<td>&nbsp;</td>
					<td class="top small">пробіг, тис. км.</td>
					<td>&nbsp;</td>
					<td class="top small">тип пального</td>
				</tr>
				<tr>
					<td>{$values.transmissions_title}</td>
					<td>&nbsp;</td>
					<td></td>
					<td>&nbsp;</td>
					<td></td>
					<td>&nbsp;</td>
					<td>{$values.market_price|moneyformat:-1}</td>
				</tr>
				<tr>
					<td class="top small">КПП </td>
					<td>&nbsp;</td>
					<td class="top small"></td>
					<td>&nbsp;</td>
					<td class="top small"></td>
					<td>&nbsp;</td>
					<td class="top small">ринкова (дійсна) вартість, грн.</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>


{assign var=equipment_count value=0}
{assign var=equipment_price value=0}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>6. Перелік додаткового обладнання<br />(надалі-ДО)</b></td>
	<td>
		<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td class="all">Найменуванння</td>
			<td class="top right bottom">марка/модель</td>
			<td class="top right bottom">Вартість ДО, грн./страхова сума, грн.</td>
		</tr>
{section name="roll" loop=$values.equipment}
		<tr>
			<td class="right bottom left">{$values.equipment[roll].title}</td>
			<td class="right bottom">{$values.equipment[roll].brand}/{$values.equipment[roll].model}</td>
			<td class="right bottom" align=right>{$values.equipment[roll].price|moneyformat:-1}</td>
		</tr>
		{assign var=equipment_count value=$equipment_count+1}
        {assign var=equipment_price value=$equipment_price+$values.equipment[roll].price}
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


<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>7. Перелік страхових випадків</b><br /></td>
	<td class="all center {if $values.dtp == 0}u{/if}">1.ДТП</td>
	<td class="top right bottom center {if $values.pdto == 0}u{/if}">2.ПДТО</td>
	<td class="top right bottom center {if $values.actofgod == 0}u{/if}">3.Стихійні<br />явища</td>
	<td class="top right bottom center {if $values.downfall <= 0}u{/if}">4.Падіння літальних апаратів або їх частин, дерев,<br />інших предметів, тіл космічного походження</td>
	<td class="top right bottom center {if $values.animal == 0}u{/if}">5.Напад тварин</td>
	<td class="top right bottom center {if $values.fire == 0}u{/if}">6.Пожежа, вибух</td>
	<td class="top right bottom center {if $values.hijacking == 0}u{/if}">7.Незаконне<br />заволодіння</td>
</tr>
<tr>
	<td><b>8. Безумовна франшиза</b><div class="small">(у % від страхової суми)</div></td>
	<td class="left bottom right center">{if $values.dtp != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.pdto != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}-----{/if}</td>
	<td class="right bottom center">{if $values.actofgod != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.downfall != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.animal != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.fire != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.hijacking != 0}{$values.deductibles_value1|sign:$values.deductibles_absolute1}{else}------{/if}</td>
</tr>
</table> 
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"></td>
	<td>8.1. У випадку повної конструктивної загибелі ТЗ франшиза дорівнює франшизі за ризиком «незаконне заволодіння».</td>
</tr>	
</table>	

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>9. Строк дії Договору:</b></td>
	<td class="all">
		з 00.00 год {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		по 24.00 год {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
		<br>
		Строк дії Договору відповідає строку дії періодів страхування, зазначених в п.11 частини А Договору, за умови сплати Страхувальником кожного наступного страхового платежу
	</td>
</tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>10. Місце дії Договору</b></td>
	<td class="all">{$values.zones_title}</td>
</tr>
</table><br />

{assign var=totalPrice value=`$values.car_price+$values.price_equipment`}
{assign var=totalAmount value=`$values.amount_kasko+$values.amount_equipment`}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>11. Періоди  страхування за Договором . Страхова сума. Страховий тариф. Страховий платіж та термін його сплати</b></td>
	<td>
	
		{section name="roll" loop=$values.yearsPayments}
		{if $smarty.section.roll.first}
		{if $smarty.section.roll.total == 1}
		{assign var=end_datetime value=$values.end_datetime}
		{else}
		{assign var=end_datetime value=$values.yearsPayments[roll.index_next].lastdate}
		{/if}

		{if $smarty.section.roll.first}
		{assign var=end_datetime2 value=$end_datetime}
		{assign var=amount_kasko value=$values.yearsPayments[roll].amount_kasko}
		{assign var=lastdate2 value=$values.yearsPayments[roll].lastdate}
		{/if}
		<table cellpadding="5" cellspacing="0" width="100%" border="1">

		<tr>
			<td width="10%" rowspan="2">№  періоду страхування</td>
			<td colspan="2">Строк дії періоду страхування</td>
			<td rowspan="2" width="20%">Загальна страхова сума (ДО+ТЗ), грн{if $values.financial_institutions_id==44}*{/if}</td>
			<td rowspan="2">Страховий тариф, %</td>
			<td rowspan="2">Стаховий платіж, грн</td>
			<td rowspan="2">термін сплати страхового платежу до</td>
			
		</tr>
		<tr>
			<td>дата початку </td>
			<td>дата закінчення</td>
		</tr>
		{/if}
		<tr>
				{if $smarty.section.roll.last}
				{assign var=end_datetime value=$values.end_datetime}
				{else}
				{assign var=end_datetime value=$values.payments[roll.index_next].lastdate}
				{/if}

			<td>{$smarty.section.roll.iteration}.</td>
			<td>{if $smarty.section.roll.first}{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}{$values.yearsPayments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}р.</td>
			<td>{$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			
			{if $values.financial_institutions_id==33 && $values.paymentsCount==2 && $values.agreement_types_id!=3}
				{if $smarty.section.roll.first}
				<td align="right" {if $smarty.section.roll.first || $values.paymentsCount==2} rowspan="{$values.paymentsCount}"{/if}>{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
				<td align="right" {if $smarty.section.roll.first || $values.paymentsCount==2} rowspan="{$values.paymentsCount}"{/if}>{$values.yearsPayments[roll].rate_kasko}</td>
				{/if}
			{else}	
				{if !$skip || !$values.yearsPayments[roll].rowspan}
				<td align="right" {if $values.yearsPayments[roll].rowspan>0}rowspan="{$values.yearsPayments[roll].rowspan}"{/if}>{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
				<td align="right" {if $values.yearsPayments[roll].rowspan>0}rowspan="{$values.yearsPayments[roll].rowspan}"{/if}>{$values.yearsPayments[roll].rate_kasko}</td>
				{/if}
				{if $values.yearsPayments[roll].rowspan>0}{assign var=skip value=1}{/if}
			{/if}	
			<td align="right">{$values.yearsPayments[roll].amount_kasko|moneyformat:-1}{if $values.yearsPayments[roll].doplata}**{/if}{if $values.yearsPayments[roll].doplata2}***{assign var=doplata2 value=1}{/if}</td>
			<td>до {$values.yearsPayments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		</tr>
		{/section}
		{if $smarty.section.roll.last}</table>{/if}
		{if $values.agreement_types_id==3}
		<br>* Але не раніше 00 год. 00 хв дати, наступної за датою надходження додаткового платежу <br>
		** Додатаковий страховий платіж
		{if $doplata2==1}<br>*** Обчислено з урахуванням Додаткового страхового платежу {/if}
		{/if}
	 
</td>
</tr>
</table>


<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>12. Порядок визначення страхових сум, страхових тарифів та страхових платежів на 2-й та кожний наступний рік дії Договору страхування</b></td>
	<td>
<p>Страховий платіж за перший період страхування за Договором сплачується одноразово 100% платежу в день укладання Договору. Страхова сума на 2-й та кожний наступний період (рік) страхування зменшується відносно страхової суми встановленої в попередньому періоді страхування на 10 (десять) відсотків до 5-го періоду(року) страхування включно та на 5% на 6, 7й період(рік) страхування. При цьому страховий тариф на 2-й та кожний наступний період (рік) страхування визначається під час укладання даного Договору залежно від обраних Страхувальником умов страхування на перший період (рік) дії Договору. Страховий платіж за 2-й та кожний наступний період (рік)  страхування визначається як добуток тарифу відповідного періоду (року)  на страхову суму відповідного періоду (року).  
<p>Сторони Договору мають право на 2-й та кожний наступний період (рік) змінити страхову суму у зв'язку зі зміною ринкової вартості ТЗ, що визначена цим Договором, шляхом укладання Додаткової угоди до Договору, за умови попереднього письмового погодження змін цієї умови страхування з Вигодонабувачем. Така додаткова угода укладається між Сторонами не пізніше ніж за 30 (тридцять) календарних днів до закінчення відповідного періоду (року) дії Договору (відповідної дати, яку зазначено в п. 11 Частини А Договору). Страховик зобов’язаний не пізніше ніж за 30 календарних днів до закінчення відповідного періоду (року) письмово повідомити Страхувальника та Вигодонабувача про необхідність укладення такої Додаткової угоди. Страхувальник зобов’язаний сплатити страховий платіж не пізніше ніж за 15 (п’ятнадцять) календарних днів до відповідної дати, вказаної в п. 11 Частини А Договору як термін сплати відповідного страхового платежу.
<p>Страховик має право, з письмовим обгрунтуванням причин та письмовою згодою Вигодонабувача, вимагати зміни страхової суми у зв'язку зі зміною ринкової вартості ТЗ на 2-й та кожний наступний рік страхування за цим Договором залежно від віку ТЗ, пробігу, вищого за нормативний, тощо.
	</td>
</tr>

</table> 
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%"><b>13. Пріоритет виплат</b></td>
        <td class="all" width="40%" align="center">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}</s>{/if}</td>
        <td class="right top bottom" width="40%" align="center">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
    </tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%" rowspan="5" valign="top"><b>14. Додаткові опції</b></td>
        <td class="all" width="70%">без франшизи на вітрові стекла</td>
        <td class="right top bottom" width="10%">{if $values.options_deductible_glass_no}так{else}ні{/if}</td>
    </tr>
    <tr>
        <td class="left right bottom" width="70%">неагрегатна страхова сума</td>
        <td class="right bottom" width="10%">{if $values.options_agregate_no}так{else}ні{/if}</td>
    </tr>
    <tr>
        <td class="left right bottom" width="70%">фізичний знос не вираховується</td>
        <td class="right bottom" width="10%">{if $values.options_deterioration_no}так{else}ні{/if}</td>
    </tr>
    <tr>
        <td class="left right bottom" width="70%">страхування таксі</td>
        <td class="right bottom" width="10%">{if $values.options_taxy}так{else}ні{/if}</td>
    </tr>
	<tr>
		<td class="right bottom left">страхування без встановленого протиугінного пристрою</td>
		<td class="right bottom">{if $values.no_immobiliser}так{else}ні{/if}</td>
	</tr>
</table><br />
 
{if $values.agreement_types_id>0}

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>15. Кількість осіб,<br />допущених до керування</b></td>
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
				<td class="right bottom">Будь-яка особа на законних підставах</td>
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
{/if}

<p>Договір складається з:</p>
<p>1.	Даних особливих умов страхування, підписаних Страховиком та Страхувальником (частина А Договору). Особливі умови страхування підписуються у 3 (трьох) примірниках, що мають однакову юридичну силу, по одному з примірників для Страховика, Страхувальника та Вигодонабувача.
<p>2.	Трьох примірників загальних умов страхування (частина Б Договору), що мають однакову юридичну силу, по одному з примірників для Страховика, Страхувальника та Вигодонабувача.
<p>3.	Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений Договір. Оригінал заяви зберігається у Страховика.
<p>4.	Договір є дійсним при наявності всіх частин. Страхувальник має право отримати дублікат Договору або його частин у випадку втрати. Відсутність хоча б однієї з частин свідчить про недійсність Договору.

{if $values.agreement_types_id>0}
{include file = '../files/ProductDocuments/add_agreement_finish_new.tpl'}
<br /><br />
{/if}
 

<br />
<br />
<table cellpadding="2" cellspacing="4" width="100%">
<tr>
	<td width="33%" align="center"><b>СТРАХОВИК</b></td>
	{if $values.agencies_id==560111 ||$values.agencies_id==1486111 || $values.agencies_id==1469111}
	<td width="33%" align="center"><b>СТРАХОВИЙ АГЕНТ</b></td>
	{/if}
	<td width="33%" align="center"><b>СТРАХУВАЛЬНИК</b></td>
</tr>
<tr>
	<td>М.П.</td>
	{if $values.agencies_id==560111 || $values.agencies_id==1469111}<td></td>{/if}
	<td align="center"><b>З Правилами ознайомлений, з умовами Договору ознайомлений та згодний.</b></td>
</tr>
<tr>
	<td height="30">{if $values.top_agency_id==557}&nbsp;&nbsp;&nbsp;{elseif $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou  && $values.agencies_id!=1469111}{$values.director1 }{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}</td>
	{if $values.agencies_id==560111}<td>Турчина Н.М.</td>{/if}
	{if $values.agencies_id==1486111}<td>Турчин М.К.</td>{/if}
	{if $values.agencies_id==1469111}<td>Поліщук  М.О.</td>{/if}
	<td height="30">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.agencies_id==560111 || $values.agencies_id==1486111 || $values.agencies_id==1469111}<td class="top center">(П.І.Б., підпис)</td>{/if}
	<td class="top center">(П.І.Б., підпис)</td>
</tr><tr>
			<td width="50%">{if $values.ukravto == 1 && $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou   && $values.agencies_id!=1469111}{$values.findirector1}{else} {/if}<br><br><br></td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.agencies_id==560111 || $values.agencies_id==1486111 || $values.agencies_id==1469111}<td></td>{/if}
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
</tr>
{if $values.top_agency_id==557}
<tr>
	<td></td>
	<td></td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td></td>
</tr>
{/if}
</table><br />
