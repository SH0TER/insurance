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
Цей Договір добровільного страхування наземних транспортних засобів (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2}, що діє на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{elseif $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou && $values.agencies_id!=560 && $values.agencies_id!=1486 && $values.agencies_id!=1469111}
	<p>
	Цей Договір добровільного страхування наземних транспортних засобів (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2} та {$values.findirector2}, що діють на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{else}
	{if $values.new_director == 1}
		<p>Цей договір добровільного страхування наземних транспортних засобів /далі - Договір/ укладений ТДВ "Експрес Страхування" (надалі - Страховик), в особі Директора Щучьєвої Тетяни Андріївни, яка діє на підставі Статуту, укладений відповідно до Закону України "Про страхування", Ліцензії серії АВ № 429899 від 04.11.2008р. та Правил ТДВ "Експрес Cтрахування" добровільного страхування наземного транспорту (крім залізничного) від 13.10.2008р., Ліцензії серії АВ № 429898 від 23.10.2008р. та Правил ТДВ "Експрес Страхування" добровільного страхування від нещасних випадків від 13.10.2008р.</p>
	{else}
		<p>Цей договір добровільного страхування наземних транспортних засобів /далі - Договір/ укладений ТДВ "Експрес Страхування" (надалі - Страховик), в особі Директора Скрипника Олександра Олексійовича, який діє на підставі Статуту, укладений відповідно до Закону України "Про страхування", Ліцензії серії АВ № 429899 від 04.11.2008р. та Правил ТДВ "Експрес Cтрахування" добровільного страхування наземного транспорту (крім залізничного) від 13.10.2008р., Ліцензії серії АВ № 429898 від 23.10.2008р. та Правил ТДВ "Експрес Страхування" добровільного страхування від нещасних випадків від 13.10.2008р.</p>
	{/if}
{/if}
 
<br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>Страховик</b></td>
	<td>ТДВ "ЕКСПРЕС СТРАХУВАННЯ". Адреса: 01004, м. Київ, вул.Велика Васильківська, 15/2 </td>
</tr>
</table>


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
	<td class="left right bottom">ПАТ «Креді Агріколь Банк», МФО 300614. Адреса: 01004, Київ, вул. Пушкінська, 42/4. Зазначений Вигодонабувач є єдиним Вигодонабувачем за Договором і не може бути змінений без його письмового погодження.</td>
</tr>
<tr>
	<td><b>3. Водій</b></td>
	<td class="left right bottom">
	{if $values.products_id==674}
	Будь-яка особа, яка керує ТЗ на законних підставах
	{else}
	Особа, зазначена в Заяві на страхування, яка керує ТЗ на законних підставах (без обмежень в залежності від стажу керування ТЗ та віку
	{/if}
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td><b>4. Транспортний засіб</b></td>
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

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>5. Список додаткового обладнання<br />(надалі-ДО)</b></td>
	<td>
		<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td class="all">Найменуванння</td>
			<td class="top right bottom">марка/модель</td>
			<td class="top right bottom">Вартість ДО, грн./страхова сума, грн.</td>
		</tr>
{section name="roll" loop=$values.equipment}
{if $smarty.section.roll.first}

{/if}
		<tr>
			<td class="right bottom left">{$values.equipment[roll].title}</td>
			<td class="right bottom">{$values.equipment[roll].brand}/{$values.equipment[roll].model}</td>
			<td class="right bottom" align=right>{$values.equipment[roll].price|moneyformat:-1}</td>
		</tr>
{if $smarty.section.roll.last}

{/if}
{/section}
		</table>
	</td>
</tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>6. Перелік страхових випадків</b><br /></td>
	<td>
	1.ДТП<br>
	2.ПДТО<br>
	3.Стихійні явища<br>
	4.Падіння літальних апаратів або їх частин, дерев, інших предметів, тіл космічного походження<br>
	5.Напад тварин<br>
	6.Пожежа, вибух{if $values.products_id!=674}, самозаймання ТЗ{/if}
	7.Незаконне заволодіння
	</td>
</tr>
<tr>
	<td><b>7. Безумовна франшиза</td>
	<td>
	по ризикам 1-6: {$values.deductibles_value0|sign:$values.deductibles_absolute0}
	по ризику 7: {$values.deductibles_value1|sign:$values.deductibles_absolute1}
	</td>
</tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td rowspan="2" width="20%"><b>8. Строк дії Договору</b></td>
	<td class="all">
		з 00.00 год {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		по 24.00 год {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
	</td>
</tr>
<tr>
	<td>Строк дії Договору відповідає строку дії його періодів, зазначених в п.10 частини А Договору, за умови сплати Страхувальником кожної наступної страхової премії.</td>
</tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>9. Територія дії Договору</b></td>
	<td class="all">{$values.zones_title}</td>
</tr>
</table><br />

{assign var=totalPrice value=`$values.car_price+$values.price_equipment`}
{assign var=totalAmount value=`$values.amount_kasko+$values.amount_equipment`}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>10. Страховий тариф. Страховий платіж</b></td>
	<td>

		{section name="roll" loop=$values.payments}
		{if $smarty.section.roll.first}
		{if $smarty.section.roll.total == 1}
		{assign var=end_datetime value=$values.end_datetime}
		{else}
		{assign var=end_datetime value=$values.payments[roll.index_next].lastdate}
		{/if}

		{if $smarty.section.roll.first}
		{assign var=end_datetime2 value=$end_datetime}
		{assign var=amount_kasko value=$totalAmount}
		{assign var=lastdate2 value=$values.begin_datetime}
		{/if}
		<table cellpadding="5" cellspacing="0" width="100%" border="1">

		<tr>
			<td width="20%" rowspan="2">№ періоду дії Договру страхування</td>
			<td colspan="2">строк періоду дії Договору страхування</td>
			<td rowspan="2">Загальна страхова сума <br>(ДО+ТЗ), грн</td>
			<td rowspan="2">Страховий тариф, %</td>
			<td rowspan="2">Страхова премія, грн.</td>
			<td rowspan="2">Строк сплати страхової премії до (включно)</td>
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
			<td>{if $smarty.section.roll.first}{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}{$values.payments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}р.</td>
			<td>{$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			<td align="right">{if $smarty.section.roll.first}{$totalPrice|moneyformat:-1}{else}-{/if}</td>
			<td align="right">{if $smarty.section.roll.first}{$values.rate_kasko}{else}-{/if}</td>
			<td align="right">{if $smarty.section.roll.first}{$totalAmount|moneyformat:-1}{else}-{/if}</td>
			<td>{if $smarty.section.roll.first}{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}{$values.payments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}р.</td>
		</tr>
		{/section}
		{if $smarty.section.roll.last}</table>{/if}
		
		{if $values.agreement_types_id==3}
		<br>* Але не раніше 00 год. 00 хв дати, наступної за датою надходження додаткового платежу <br>
		** Додатаковий страховий платіж
		{/if}
</td>
</tr>
</table>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>11. Порядок сплати страхового платежу</b></td>
	<td>
		Страхова премія за перший період дії Договору страхування сплачується одноразово у розмірі 100% такої премії в день укладання Договору. Якщо страхова премія за перший період дії Договору страхування не надійшла, то даний Договір вважається таким, що не набув чинності. Страхові премії за наступні періоди дії Договору страхування сплачуються Страхувальником відповідно до графіку, вказаному в п.10 частини А Договору. У випадку несплати Страхувальником страхової премії за наступні періоди дії Договору страхування або сплати не в повному обсязі, діють умови п.п.8.5., 8.6. частини Б Договору.
	</td>
</tr>
<tr>
</table><br />

{if $values.products_id==674}
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%"><b>12. Пріоритет виплат</b></td>
        <td class="all" width="40%" align="center">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}</s>{/if}</td>
        <td class="right top bottom" width="40%" align="center">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
    </tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%" rowspan="{if $values.products_id==597}8{else}7{/if}" valign="top"><b>13. Додаткові опції</b></td>
        <td class="all" width="70%">без франшизи по пошкодженнях ТЗ</td>
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
        <td class="left right bottom" width="70%">виплата страхового відшкодування без надання довідок компетентних органів, два рази протягом строку дії Договору, у передбачених законодавством України випадках, при пошкодженнях ТЗ внаслідок настання страхового випадку, в межах 1,5% страхової суми ТЗ, але не більше 55 000,00 гривень вартості відновлювального ремонту</td>
        <td class="right bottom" width="10%">так</td>
    </tr>
	<tr>
		<td class="right bottom left">виплата страхового відшкодування без надання довідок ДАІ, при настанні страхового випадку за ризиком «ДТП», якщо розмір збитків складає не більше 50 000 грн., за умови наявності учасників події - третіх осіб, якщо всі учасники ДТП мають діючі внутрішні Поліси  ОСЦПВВНТЗ та заповнили та підписали «Повідомлення про дорожньо-транспортну пригоду» затвердженого МТСБУ зразка </td>
		<td class="right bottom">так</td>
	</tr>
	<tr>
		<td class="right bottom left">відшкодування вартості витрат на евакуацію (транспортування) ТЗ, на одне завантаження, розвантаження та перевезення, в межах 1 000,00 грн. за кожним страховим випадком</td>
		<td class="right bottom">так</td>
	</tr>
	<tr>
		<td class="right bottom left">порушення ПДР як причина відмови у виплаті страхового відшкодування</td>
		<td class="right bottom">нi</td>
	</tr>
	{if $values.products_id==597}
	<tr>
		<td class="right bottom left">виплата страхового відшкодування без надання довідок компетентних органів, два рази протягом строку дії Договору, у передбачених законодавством України випадках, при пошкодженнях ТЗ внаслідок настання страхового випадку, в межах 1,5% </td>
		<td class="right bottom">так</td>
	</tr>
	{/if}
	{if $values.options_fifty_fifty}
	<tr>
		<td class="right bottom left">опція страхування "50/50"</td>
		<td class="right bottom">так</td>
	</tr>
	{/if}
</table><br />
{else}

<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%" valign="top"><b>12. Додаткові опції</b></td>
        <td class="all" width="70%">неагрегатна страхова сума ТЗ</td>
        <td class="right top bottom" width="10%">{if $values.options_agregate_no}так{else}ні{/if}</td>
    </tr>
</table><br />

{/if}


<p>Договір страхування складається з:</p>
<ul>
	<li>Даних особливих умов страхування, підписаних Страховиком та Страхувальником (частина "А").</li>
	<li>Загальних умов страхування, підписаних Страховиком та Страхувальником (частина "Б-1" {if $values.amount_accident>0}та частина "Б-2"{/if}).</li>
	<li>Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений договір страхування . Оригінал заяви зберігається у Страховика.</li>
	<li>Актів огляду ТЗ, підписаних Страховиком (або його представником) та Страхувальником. Оригінали актів огляду ТЗ зберігаються у Страховика.</li>
	<li>Договір страхування є дійсним при наявності всіх частин. Страхувальник має право отримати дублікат Договору страхування або його частин у випадку втрати.</li>
</ul>
{if $values.agreement_types_id>0}
{include file = '../files/ProductDocuments/add_agreement_finish_new.tpl'}
<br /><br />
{/if}

<table cellpadding="2" cellspacing="4" width="100%">
<tr>
	<td width="33%" align="center"><b>СТРАХОВИК</b></td>
	<td width="33%" align="center"><b>СТРАХУВАЛЬНИК</b></td>
	<td width="33%"><b>ВИГОДОНАБУВАЧ:</b></td>
</tr>
<tr>
	<td>М.П.</td>
	<td align="center"><b>З Правилами страхування ознайомлений, з умовами Договору страхування згоден</b></td>
	<td>М.П.</td>
</tr>
<tr>
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}</td>
	<td height="30">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	<td></td>
</tr>
<tr>
			<td width="50%">{if $values.ukravto == 1 && $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou   && $values.agencies_id!=1469111}{$values.findirector1}{else} {/if}<br><br><br></td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td class="top center">(П.І.Б., підпис)</td>
	<td class="top center">(П.І.Б., підпис)</td>
</tr>
</table><br />