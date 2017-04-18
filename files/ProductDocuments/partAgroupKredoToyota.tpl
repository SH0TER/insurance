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
		<h1>Програма "TOYOTA PREMIUM"</h1>
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
	{if $values.agreement_types_id>0}
		<p>№ {$values.original.number}</p>
		<p>від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	{/if}	
	</td>
</tr>
</table><br />


{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou && $values.agencies_id!=560 && $values.agencies_id!=1486 && $values.agencies_id!=1469111}
	<p>
	Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір) укладений {$values.agencies_title}, в особі {$values.director2} та {$values.findirector2}, які діють на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування» (далі - Страховик), відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{else}
    {if $values.new_director == 1}
        <p>Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір) укладений ТДВ "Експрес Страхування" (далі - Страховик), 

		{if $values.agencies_id==560 || $values.agencies_id==1486}
		{if $values.agencies_id==560}
		в особі ФО-П Турчини Надії Миколаївни , яка діє на підставі Довіреності №10/АС від 23.11.2012р. та Договору доручення №10/АС від 23.11.2012р. (далі - Страховик) відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ «Експрес Страхування» добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу) та додатків до них, зареєстрованих  Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008 р. (далі - Правила),
		{/if}
		{if $values.agencies_id==1486}
		в особі ФО-П Турчина Максима Костянтиновича , який діє на підставі Довіреності № 137/Д от 10.07.2014 р. та Договору доручення №4/АС от 10.07.2014 р. (далі - Страховик) відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ «Експрес Страхування» добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу) та додатків до них, зареєстрованих  Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008 р. (далі - Правила),
		{/if}

		{else}

		{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}
		в особі {$values.director2} та {$values.findirector2}, які діють на підставі {$values.ground_kasko}
		{else} 
		в особі Директора Щучьєвої Тетяни Андріївни, що діє на підставі Статуту,
		{/if}

		{/if}

		
		{if $values.agencies_id==560111}
		та за посередництвом страхового агента ФОП Турчина Надія Миколаївна, яка діє згідно з Договором доручення № 10/АС від 23.11.2012 р., 
		{/if}
		{if $values.agencies_id==1486111}
		та за посередництвом страхового агента ФО-П Турчин Максим Костянтинович, який діє згідно з Договором доручення № 14/АС від 10.07.2014 р.,
		{/if}
		{if $values.agencies_id==1469111}
		та за посередництвом страхового агента ФОП Поліщук Михайло Олександрович, яка діє згідно з Договором доручення № 15/АС від 08.08.2014 р., 
		{/if}
		відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р. (далі - Правила)</p>
    {else}
	    <p>Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір) укладений ТДВ "Експрес Страхування" (далі - Страховик), в особі Директора Скрипника Олександра Олексійовича, що діє на підставі Статуту, відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р. (далі - Правила)</p>
    {/if}
{/if}

<br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>1. Страховик (з однієї сторони)</b></td>
	<td class="top right left" colspan="2"><b>ТДВ "Експрес Страхування". Адреса: Україна, 01004, м. Київ, вул. Велика Васильківська, 15/2</b></td>
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
		  {if $values.financial_institutions_id==18}
		  ПАТ "Альфа-Банк" ЄРДПОУ: 23494714 МФО: 300346<br />
		  {else}
		  {$values.assured_title}. ІПН (ЄРДПОУ): {$values.assured_identification_code}.<br />
		  {/if}
	</td>
</tr>
<tr>
<td>&nbsp;</td>
					<td class="left top ">кредитний договір</td>
					<td class="top  right">&nbsp;</td>
					<td class="top  right" width="250">{$values.credit_agreement_number} {if $values.credit_agreement_number}вiд {$values.credit_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{/if}</td>
					<td class="top ">&nbsp;</td>
					<td class="top ">договір застави</td>
					<td class="top  right">&nbsp;</td>
					<td class="top  right" width="250">{$values.pawn_agreement_number} {if $values.pawn_agreement_number}вiд {$values.pawn_agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{/if}</td>
				</tr>
<tr>
	<td><b>4. Водій</b></td>
	<td class="left right bottom top" colspan="7">
		особа, зазначена в Заяві на страхування, яка керує ТЗ на законних підставах
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
					<td>{if $values.financial_institutions_id!=55}{$values.market_price|moneyformat:-1}{else}&nbsp;{/if}</td>
				</tr>
				<tr>
					<td class="top small">КПП </td>
					<td>&nbsp;</td>
					<td class="top small"></td>
					<td>&nbsp;</td>
					<td class="top small"></td>
					<td>&nbsp;</td>
					<td class="top small">{if $values.financial_institutions_id!=55}ринкова (дійсна) вартість, грн.{/if}</td>
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
			<td class="all">Найменування</td>
			<td class="top right bottom">марка/модель</td>
			<td class="top right bottom">Вартість ДО/страхова сума, грн.</td>
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
	<td width="20%"><b>7. Перелік страхових випадків</b><br />(непотрібне закреслити)</td>
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
	<td width="20%"><b>11. Періоди  страхування за Договором . Страхова сума. Страховий тариф. Страховий платіж та строк його сплати</b></td>
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
			<td rowspan="2">Строк сплати страхового платежу до (включно)</td>
			
		</tr>
		<tr>
			<td>дата початку </td>
			<td>дата закінчення</td>
		</tr>
		{/if}
		
		{if ($values.financial_institutions_id==25 ||	$values.financial_institutions_id==59)	&& $values.options_fifty_fifty==1 && !$values.yearsPayments[roll].old_agr}
		<!-- Для идея банка дельтабанка разумное КАСКО-->
		
		
		<tr>
				{if $smarty.section.roll.last}
				{assign var=end_datetime value=$values.end_datetime}
				{else}
				{assign var=end_datetime value=$values.yearsPayments[roll.index_next].lastdate}
				{/if}

			<td rowspan=2>{$smarty.section.roll.iteration}.</td>
			<td rowspan=2>{$values.yearsPayments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{if $values.yearsPayments[roll].doplata}*{/if}</td>
			<td rowspan=2>{$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			
			 	
			 
			<td align="right" rowspan=2>{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
			<td align="right">{$values.yearsPayments[roll].rate_kasko}</td>
			<td align="right">{$values.yearsPayments[roll].amount_kasko|moneyformat:-1}</td>
			<td>до {$values.yearsPayments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		</tr>
		<tr>
			<td align="right">{$values.yearsPayments[roll].rate_agent}</td>
			<td align="right">{$values.yearsPayments[roll].amount_agent|moneyformat:-1} * </td>
			<td>згідно п. 16.1 ч. Б Договору</td>
		</tr>
		
		{else}
		
		<tr>
				{if $smarty.section.roll.last}
				{assign var=end_datetime value=$values.end_datetime}
				{else}
				{assign var=end_datetime value=$values.yearsPayments[roll.index_next].lastdate}
				{/if}

			<td>{$smarty.section.roll.iteration}.</td>
			<td>{$values.yearsPayments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{if $values.yearsPayments[roll].doplata}*{/if}</td>
			<td>{$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			
			{if $values.terms_years_id==1 &&  $values.paymentsCount==2 && $values.agreement_types_id!=3}
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
			<td align="right">{$values.yearsPayments[roll].amount_kasko+$equipment_price*$values.yearsPayments[roll].rate_kasko*0.01|moneyformat:-1}{if $values.yearsPayments[roll].doplata}**{/if}{if $values.yearsPayments[roll].doplata2}***{assign var=doplata2 value=1}{/if}</td>
			<td>до {$values.yearsPayments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		</tr>
		
		{/if}
		
		
		
		{/section}
		{if $smarty.section.roll.last}</table>{/if}
		{if ($values.financial_institutions_id==25 || $values.financial_institutions_id==59) && $values.options_fifty_fifty==1}
		* додатковий страховий платіж за Договором сплачується на умовах, зазначених в п.16.1. частини Б Договору
		{/if}
		{if $values.financial_institutions_id==44}
		* - але не менше за дійсну ринкову вартість на дату сплати чергового страхового платежу. Страхова сума на другий період страхування визначається у розмірі 90% від страхової суми першого періоду страхування. Страхова сума на третій та послідуючі періоди встановлюється як 90% від страхової суми визначеної за попередній період.																						
		{/if}
		{if $values.agreement_types_id==3}
		<br>* Але не раніше 00 год. 00 хв дати, наступної за датою надходження додаткового платежу <br>
		** Додатаковий страховий платіж
		{if $doplata2==1}<br>*** Обчислено з урахуванням Додаткового страхового платежу {/if}
		{/if}
</td>
</tr>
</table>
<br>


<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%" valign="top"><b>12. Порядок сплати страхового платежу</b></td>
	<td>
Страховий платіж за перший період страхування за Договором сплачується одноразово у розмірі 100% такого платежу в день укладання Договору. Якщо страховий платіж за перший період страхування не надійшов, то даний Договір вважається таким, що не набув чинності. Страхові платежі за наступні періоди страхування сплачуються Страхувальником відповідно до графіку, вказаному в п.11 частини А Договору. У випадку несплати Страхувальником страхового платежу за наступні періоди страхування або сплати не в повному обсязі, діють умови п.п.7.5., 7.6. частини Б Договору. <br /><br />
{if $values.financial_institutions_id!=44 && $values.financial_institutions_id!=58  && $values.financial_institutions_id!=48  && $values.financial_institutions_id!=54 && $values.financial_institutions_id!=57} 
При договірному списанні коштів: Банківські реквізити для договірного списання коштів в рахунок оплати чергового страхового 
платежу з рахунку Страхувальника: Рахунок №____________________________
 в __________________________________________________, МФО ________________________, ЄДРПОУ __________________________________.
{/if}
	</td>
</tr>

</table><br />


{if $values.options_fifty_fifty && $values.financial_institutions_id!=25 && $values.financial_institutions_id!=59}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%" valign="top"><b>12.1. Порядок сплати страхового платежу при використанні опції "50/50"</b></td>
	<td>
У випадку застосування опції "50/50", додатковий страховий платіж за Договором сплачується на умовах та в розмірі, зазначених в п.16.1. частини Б Договору.
	</td>
</tr>

</table><br />
{/if}

<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%"><b>13. Пріоритет виплат</b></td>
        <td class="all" width="40%" align="center">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}</s>{/if}</td>
        <td class="right top bottom" width="40%" align="center">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
    </tr>
</table><br />

<div style="page-break-after: always"></div>

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td rowspan="15" width="20%" valign="top"><b>14. Додаткові опції</b></td>
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

 
{if $values.agreement_types_id>0}
{if !$values.options_fifty_fifty}
<div style="page-break-after: always"></div>
{/if}
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
<p>1.	Даних особливих умов страхування, підписаних Страховиком та Страхувальником (частина А Договору). Особливі умови страхування підписуються у 2 (двох) примірниках, що мають однакову юридичну силу, по одному для Страховика та Страхувальника.
<p>2.	Двох примірників загальних умов страхування (частина Б Договору), що мають однакову юридичну силу, по одному для Страховика та Страхувальника.
<p>3.	Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений Договір. Оригінал заяви зберігається у Страховика.
<p>4.	Договір є дійсним при наявності всіх частин. Страхувальник має право отримати дублікат Договору або його частин у випадку втрати. Відсутність хоча б однієї з частин свідчить про недійсність Договору.
<br />



{if $values.agreement_types_id>0}
{include file = '../files/ProductDocuments/add_agreement_finish_new.tpl'}
<br /><br />
{/if}
 
 
 
 
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
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}</td>
	{if $values.agencies_id==560111}<td>Турчина Н.М.</td>{/if}
	{if $values.agencies_id==1486111}<td>Турчин М.К.</td>{/if}
	{if $values.agencies_id==1469111}<td>Поліщук  М.О.</td>{/if}

	<td height="30">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.agencies_id==560111 || $values.agencies_id==1486111 || $values.agencies_id==1469111}<td class="top center">(П.І.Б., підпис)</td>{/if}	
	<td class="top center">(П.І.Б., підпис)</td>
</tr>
<tr>
			<td width="50%">{if $values.ukravto == 1 && $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou   && $values.agencies_id!=1469111}{$values.findirector1}{else} {/if}</td><td></td><td></td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.agencies_id==560111 || $values.agencies_id==1486111 || $values.agencies_id==1469111}<td></td>{/if}	
	<td></td>
</tr>
</table><br />
