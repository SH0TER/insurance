﻿{if $values.agreement_types_id==3}
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
		<p>Частина "А" Договору страхування</p>
		<h1>Особливі умови страхування</h1>
	</td>
	<td width="220" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
	<td align="right">
		{if $values.agreement_types_id==0}
			<p>№ {$values.number}</p>
			<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
		{/if}	
		{if $values.agreement_types_id==3}
			<p>№ {$values.original.number}</p>
			<p>від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
		{/if}	
	</td>
</tr>
</table>

{if ($values.agencies_id == 1469 && $values.seller_agencies_id == 0) || $values.agencies_id == 1496 || $values.agencies_id == 1497 || $values.agencies_id == 1498}
Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2}, що діє на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{elseif $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou && $values.agencies_id!=560 && $values.agencies_id!=1486 && $values.agencies_id!=1469111}
	<p>
	Цей Договір добровільного страхування наземних транспортних засобів, які є предметом застави (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2} та {$values.findirector2}, що діють на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
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
	<td width="20%"><b>1. Страхувальник</b></td>
	<td>&nbsp;</td>
</tr>
</table>

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

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Адреса, телефон</td>
	<td class="left right bottom">{$values.insurer_address}</td>
</tr>
<tr>
	<td><b>2. Вигодонабувач</b></td>
	<td class="left right bottom">
		 {$values.assured_title}. ІПН (ЄРДПОУ): {$values.assured_identification_code}.<br />
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
 
<tr>
	<td><b>3. Транспортний засіб</b></td>
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
</table>

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>4. Список додаткового обладнання<br />(надалі-ДО)</b></td>
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
{/section}		

		</table>
	</td>
</tr>
</table><br />



<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>5. Перелік страхових випадків</b><br /></td>
	<td class="all center {if $values.dtp == 0}u{/if}">1.ДТП</td>
	<td class="top right bottom center {if $values.pdto == 0}u{/if}">2.ПДТО</td>
	<td class="top right bottom center {if $values.actofgod == 0}u{/if}">3.Стихійні<br />явища</td>
	<td class="top right bottom center {if $values.downfall <= 0}u{/if}">4.Падіння літальних апаратів або їх частин, дерев,<br />інших предметів, тіл космічного походження</td>
	<td class="top right bottom center {if $values.animal == 0}u{/if}">5.Напад тварин</td>
	<td class="top right bottom center {if $values.fire == 0}u{/if}">6.Пожежа, вибух,<br />самозаймання ТЗ</td>
	<td class="top right bottom center {if $values.hijacking == 0}u{/if}">7.Незаконне<br />заволодіння</td>
</tr>
<tr>
	<td><b>6. Безумовна франшиза, % або грн.</b><div class="small">(для кожного страхового випадку)</div></td>
	<td class="left bottom right center">{if $values.dtp != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.pdto != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}-----{/if}</td>
	<td class="right bottom center">{if $values.actofgod != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.downfall != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.animal != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.fire != 0}{$values.deductibles_value0|sign:$values.deductibles_absolute0}{else}------{/if}</td>
	<td class="right bottom center">{if $values.hijacking != 0}{$values.deductibles_value1|sign:$values.deductibles_absolute1}{else}------{/if}</td>
</tr>
</table><br />

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>7. Строк дії Договору (максимальний строк - 1 рік):</b></td>
	<td class="all">
		з 00.00 год {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		по 24.00 год {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
		<br>
		Строк дії Договору відповідає строку дії періодів страхування, зазначених в п.8 частини А Договору, за умови сплати Страхувальником кожного наступного страхового платежу
	</td>
</tr>
</table><br />


{assign var=totalPrice value=`$values.car_price+$values.price_equipment`}
{assign var=totalAmount value=`$values.amount_kasko+$values.amount_equipment`}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>8. Періоди страхування за Договором. Страхова сума. Страховий тариф. Страховий платіж та строк його сплати</b></td>
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
			<td width="10%" rowspan="2">№ періоду страхування </td>
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
			<td align="right">{$values.yearsPayments[roll].amount_kasko|moneyformat:-1}{if $values.yearsPayments[roll].doplata}**{/if}{if $values.yearsPayments[roll].doplata2}***{assign var=doplata2 value=1}{/if}</td>
			<td>до {$values.yearsPayments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
		</tr>
		{/section}
		{if $smarty.section.roll.last}</table>{/if}
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
	<td width="20%" valign="top"><b>9. Порядок сплати страхового платежу</b></td>
	<td>
Страховий платіж за перший період страхування за Договором сплачується одноразово у розмірі 100% такого платежу в день укладання Договору. Якщо страховий платіж за перший період страхування не надійшов, то даний Договір вважається таким, що не набув чинності. Страхові платежі за наступні періоди страхування сплачуються Страхувальником відповідно до графіку, вказаному в п.8 частини А Договору. У випадку несплати Страхувальником страхового платежу за наступні періоди страхування або сплати не в повному обсязі, діють умови п.п.8.4., 8.5. частини Б Договору. 
 
	</td>
</tr>

</table><br />

 
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>10. Територія дії Договору</b></td>
	<td class="all">  {$values.zones_title} </td>
</tr>
</table><br />

<p>Договір страхування складається з:</p>
{if $values.states_id == 0 || $values.agreement_types_id == 2}
<ul>
	<li>Даних особливих умов страхування, підписаних Страховиком та Страхувальником (частина "А").</li>
	<li>Загальних умов страхування, підписаних Страховиком та Страхувальником (частина "Б").</li>
	{if  $values.agreement_types_id != 2}<li>Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений договір страхування . Оригінал заяви зберігається у Страховика.</li>{/if}
	<li>Актів огляду ТЗ, підписаних Страховиком (або його представником) та Страхувальником (у випадках, передбачених Договором). Оригінали актів огляду ТЗ зберігаються у Страховика.</li>
	<li>Договір страхування є дійсним при наявності всіх частин. Страхувальник має право отримати дублікат Договору страхування або його частин у випадку втрати.</li>
</ul>
{else}
<ul>
<li> Даних особливих умов страхування, підписаних Страховиком, Страхувальником та Вигодонабувачем (частина "А"). Особливі умови страхування підписуються у 3 (трьох) примірниках, що мають однакову силу, по одному для Страховика, Страхувальника та Вигодонабувача.</li>
<li> Трьох примірників загальних умов страхування (частина "Б"  {if $values.amount_accident>0}та частина "Б-2"{/if}), що мають однакову юридичну силу, по одному для Страховика, Страхувальника та Вигодонабувача.</li>
<li> Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений Договір . Оригінал заяви зберігається у Страховика. </li>
<li>  Договір страхування є дійсним при наявності всіх частин. Страхувальник має право отримати дублікат Договору страхування або його частин у випадку втрати. Відсутність хоча б однієї з частин свідчить про недійсність Договору страхування. </li>
</ul>
{/if}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%" rowspan="2"><b>11. Додаткові умови Договору страхування</b></td>
	<td class="all"><br /><br /></td>
</tr>
<tr>
	<td class="right bottom left">{if !$values.options_deterioration_no}страхування з вирахуванням зносу{else}страхування без вирахування зносу{/if}</td>
</tr>
</table><br />

<table cellpadding="2" cellspacing="4" width="100%">
<tr>
	<td width="33%" align="center"><b>СТРАХОВИК</b></td>
	<td width="33%" align="center"><b>СТРАХУВАЛЬНИК</b></td>
	{if $values.states_id >0 && $values.agreement_types_id == 0}<td width="33%"><b>ВИГОДОНАБУВАЧ (погоджено):</b></td>{/if}
</tr>
<tr>
	<td>М.П.</td>
	<td align="center"><b>З Правилами страхування ознайомлений, з умовами Договору страхування згоден</b></td>
	{if $values.states_id >0 && $values.agreement_types_id == 0}<td>М.П.</td>{/if}
</tr>
<tr>
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{if $values.agreement_types_id == 0}{$values.director1}{else}Директор Щучьєва Т.А.{/if}{else}Директор Щучьєва Т.А.{/if}</td>
	<td height="30">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	{if $values.states_id >0 && $values.agreement_types_id == 0}<td></td>{/if}
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.states_id>0 && $values.agreement_types_id == 0}<td class="top center">(П.І.Б., підпис)</td>{/if}
</tr>
<tr>
			<td width="50%">{if $values.ukravto == 1 && $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou   && $values.agencies_id!=1469111}{$values.findirector1}{else} {/if}<br><br><br></td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td class="top center"></td>
	{if $values.states_id>0 && $values.agreement_types_id == 0}<td class="top center"></td>{/if}
</tr>
</table><br />
{if $values.ground_kasko}
<p>що діє на підставі Довіреності № {if $values.agreement_types_id > 0}№46/12 від 01.11.2012 р.{else}{$values.ground_kasko}{/if}</p>
{/if}
<p><b>Службова інформація</b> (блок на екземплярі Страховика)</p>