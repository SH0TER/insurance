    <table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
	{if $values.agreement_types_id>0}
		<h1>Додаткова угода № {$values.sub_number} до договору страхування наземних транспортних засобів {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h1>
	{else}
        <h1>Договір добровільного страхування наземних транспортних засобів  </h1>
		
		<p><h1>Частина "А" Договору страхування</h1></p>
	{/if}	
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
{elseif ($values.agencies_id==1469 || $values.agencies_id==1496 || $values.agencies_id==1497 || $values.agencies_id==1498) && $values.seller_agencies_id==0}
Цей Договір добровільного страхування наземних транспортних засобів (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2}, що діє на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{elseif $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou && $values.agencies_id!=560 && $values.agencies_id!=1486 && $values.agencies_id!=1469111}
	<p>
	Цей Договір добровільного страхування наземних транспортних засобів (далі - Договір)  укладений {$values.agencies_title} (далі - Страховик), ліцензії серія АВ №429899 від 04.11.2008 р., в особі {$values.director2} та {$values.findirector2}, що діють на підставі {$values.ground_kasko} від імені та в інтересах ТДВ «Експрес Страхування». Договір укладено відповідно до Закону України «Про страхування» та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р.  (далі - Правила).
{else}
   <p>Цей Договір добровільного страхування наземних транспортних засобів  (далі - Договір) укладений ТДВ "Експрес Страхування" (далі - Страховик), 
	{if $values.new_director == 1}
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
{/if}
<br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>1. Страховик</b></br>з однієї сторони</td>
	<td class="top right left" colspan="4"><b>ТДВ "Експрес Страхування". Адреса: Україна, 01004, м. Київ, вул.Велика Васильківська, 15/2 </b></td>
</tr>
{if $values.insurer_person_types_id==1}
<tr>
	<td width="20%"><b>2. Страхувальник</b></br>з другої сторони, разом надалі - Сторони</td>
	<td class="all">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
	<td width="10%" class="top right bottom" nowrap>{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.н.</td>
</tr>
{/if}
{if $values.insurer_person_types_id==2}
<tr>
	<td width="20%"><b>2. Страхувальник</b></br>з другої сторони, разом надалі - Сторони</td>
	<td class="left top bottom">назва</td>
	<td colspan="3" class="all">{$values.insurer_company}</td>
</tr>
<tr>
	<td></td>
	<td class="left bottom">в особі</td>
	<td width="25%" class="left right bottom">{$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname} {if $values.insurer_lastname1} та {$values.insurer_position1} {$values.insurer_lastname1} {$values.insurer_firstname1} {$values.insurer_patronymicname1}{/if}</td>
	<td class="right bottom">{if $values.insurer_lastname1}якi діють{else} що діє{/if} на підставі</td>
	<td class="right bottom" width="25%">{$values.insurer_ground}</td>
</tr>
{/if}
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Адреса, телефон</td>
	<td class="left right bottom"  colspan="7">{$values.insurer_address}</td>
</tr>
<tr>
	<td colspan=9>з другої сторони, разом надалі – Сторони</td>
</tr>
<tr>
	<td><b>3. Вигодонабувач</b></td>
	<td class="left right top" colspan="7">
		згідно з законодавством України<br />
		<!--<br />{$values.assured_title}, {$values.assured_identification_code}, {$values.assured_address}-->
	</td>
</tr>

	<td><b>4. Водій</b></td>
	<td class="left right bottom top" colspan="7">
		будь-яка особа, яка керує ТЗ на законних підставах 
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">

<tr>
	<td><b>5. Транспортний засіб<br> (надалі ТЗ)</b></td>
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
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%" valign="top"><b>6. Перелік додаткового обладнання (надалі-ДО)</b></td>
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


<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>7. Перелік страхових випадків</b> </td>
	<td class="all">
	<b>Дорожньо-транспортна пригода (ДТП):</b> пошкодження та/або знищення застрахованого ТЗ та/або ДО внаслідок події, що сталася під час руху застрахованого ТЗ або іншого ТЗ – учасника події, внаслідок якої загинули або поранені люди чи завдані матеріальні збитки, а саме:
	зіткнення застрахованого ТЗ з іншим ТЗ або наїзд застрахованого ТЗ на інший ТЗ;
	наїзд іншого ТЗ на застрахований ТЗ.
	</td>
</tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td rowspan=2><b>8. Безумовна франшиза</b><div class="small">(у % від страхової суми)</div></td>
	<td class="left bottom right center top">при пошкодженнях ТЗ</td>
	<td class="right bottom center top">5% (але не менше 4 000,00 грн.)</td>
</tr>
<tr>
	<td class="left bottom right center">при конструктивній загибелі ТЗ</td>
	<td class="right bottom center">7%</td>
</tr>

</table><br />

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%" rowspan="4"><b>9. Страхова сума, страховий тариф, страховий платіж</b></td>
	<td>&nbsp;</td>
	<td class="all center"><b>Страхова сума, грн.</b></td>
	<td class="top right bottom center"><b>Страховий тариф, %</b></td>
	<td class="top right bottom center"><b>Страховий платіж, грн.</b></td>
</tr>
<tr>
	<td class="top bottom left" align="right">по ТЗ:</td>
	<td class="right bottom left" align="right">{$values.car_price|moneyformat:-1}</td>
	<td class="right bottom" align="right">{$values.rate_kasko}</td>
	<td class="right bottom" align="right">{$values.amount_kasko|moneyformat:-1}</td>
</tr>
<tr>
	<td class="bottom left" align="right">по ДО:</td>
	<td class="right bottom left" align="right">{if $values.amount_equipment>0}{$values.price_equipment|moneyformat:-1}{else}X{/if}</td>
	<td class="right bottom" align="right">{if $values.amount_equipment>0}{$values.rate_equipment}{else}X{/if}</td>
	<td class="right bottom" align="right">{if $values.amount_equipment>0}{$values.amount_equipment|moneyformat:-1}{else}X{/if}</td>
</tr>
<tr>
	<td class="bottom left" align="right">РАЗОМ:</td>
	<td class="right bottom left" align="right">{assign var=totalPrice value=`$values.car_price+$values.price_equipment`}{$totalPrice|moneyformat:-1}</td>
	<td class="right bottom" align="right">X</td>
	<td class="right bottom" align="right">{assign var=totalAmount value=`$values.amount_kasko+$values.amount_equipment`}{$totalAmount|moneyformat:-1}</td>
</tr>
</table><br />

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>10. Строк дії Договору</b></td>
	<td class="all">
		з 00.00 год {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по 24.00 год {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
	</td>
</tr>
</table>
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>11. Місце дії Договору</b></td>
	<td class="all">{$values.zones_title}</td>
</tr>
</table> 



 


<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td width="20%"><b>12. Порядок сплати страхового платежу</b></td>
	<td>
		Страховий платіж за Договором сплачується одноразово у розмірі 100% такого платежу в день укладання Договору. Якщо страховий платіж не надійшов на поточний рахунок Страховика або надійшов не в повному обсязі, то Договір вважається таким, що не набув чинності.  
	</td>
</tr>
 
</table> 

<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%"><b>13. Пріорітет виплат</b></td>
        <td class="all" width="40%" align="center">{if $values.priority_payments_id >1}<s>{/if}СТО{if $values.priority_payments_id >1}</s>{/if}</td>
        <td class="right top bottom" width="40%" align="center">{if $values.priority_payments_id <=1}<s>{/if}експертиза{if $values.priority_payments_id <=1}</s>{/if}</td>
    </tr>
</table><br />
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%" rowspan="11" valign="top"><b>14. Додаткові опції</b></td>
        <td class="all" width="70%">неагрегатна страхова сума</td>
        <td class="right top bottom" width="10%">{if $values.options_agregate_no}так{else}ні{/if}</td>
    </tr>
    <tr>
        <td class="left right bottom" width="70%">фізичний знос не вираховується</td>
        <td class="right bottom" width="10%">{if $values.options_deterioration_no}так{else}ні{/if}</td>
    </tr>
    <tr>
        <td class="left right bottom" width="70%">страхування таксі</td>
        <td class="right bottom" width="10%">{if $values.options_taxy}так{else}ні{/if}</td>
    </tr>
	 
	 
	{if  $values.agreement_types_id==0}
	 
	 
	<tr>
		<td class="right bottom left">виплата страхового відшкодування без надання довідок компетентних органів</td>
		<td class="right bottom">нi</td>
	</tr>
	<tr>
		<td class="right bottom left">при пошкодженні тільки скляних поверхонь франшиза – 0%</td>
		<td class="right bottom">нi</td>
	</tr>
	<tr>
		<td class="right bottom left">грубі порушення ПДР, зазначені в п.13.1.14. частини Б Договору, як причина відмови у виплаті страхового відшкодування</td>
		<td class="right bottom">так</td>
	</tr>
	<tr>
		<td class="right bottom left">відшкодування вартості витрат на евакуацію (транспортування) ТЗ, на одне завантаження, розвантаження та перевезення, в межах 500 грн. за кожним страховим випадком</td>
		<td class="right bottom">так</td>
	</tr>
	{/if}
</table><br />

<table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td width="20%"><b>15. Місце реєстрації ТЗ</b></td>
		<td class="all">{$values.registration_cities_title}</td>
	</tr>
</table> 

 


{if $values.agreement_types_id>0}

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		<td width="20%"><b>16. Кількість осіб,<br />допущених до керування</b></td>
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
<p>Страхувальник здійснює доплату страхового платежу за внесення змін в Договір у розмірі {$values.amount|moneyformat:1} у строк до {$values.begin_datetime_add_agreement|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
																															
																															
<p>Всі інші умови Договору № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. залишаються без змін.
																															
<p>Ця Додаткова угода є невід’ємною частиною Договору № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. і набуває чинності з моменту її підписання Сторонами.
<p> Додаткову угоду укладено у 2 (двох)  примірниках по 1 (одному) для кожної зі Сторін.


{else}
<p>Договір складається з:</p>
<p>1.	Даних особливих умов страхування, підписаних Страховиком та Страхувальником (частина А Договору). Особливі умови страхування підписуються у 2 (двох) примірниках, що мають однакову юридичну силу, по одному для Страховика та Страхувальника.
<p>2.	Двох примірників загальних умов страхування (частина Б Договору), що мають однакову юридичну силу, по одному для Страховика та Страхувальника.
<p>3.	Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений Договір. Оригінал заяви зберігається у Страховика.
<p>4.	Договір є дійсним при наявності всіх частин. Страхувальник має право отримати дублікат Договору або його частин у випадку втрати. Відсутність хоча б однієї з частин свідчить про недійсність Договору.
{/if}
<br />
<br />
<table cellpadding="2" cellspacing="4" width="100%">
<tr>
	<td width="33%" align="center"><b>СТРАХОВИК</b></td>
	{if $values.agencies_id==560111 || $values.agencies_id==1469111}
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
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}<br><br><br><br></td>
	{if $values.agencies_id==560111}<td>Турчина Н.М.</td>{/if}
	{if $values.agencies_id==1469111}<td>Поліщук М. О.</td>{/if}
	<td height="30">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.<br><br><br></td>
</tr>
<tr>
			<td width="50%">{if $values.ukravto == 1 && $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou   && $values.agencies_id!=1469111}{$values.findirector1}{else} {/if}<br><br><br></td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.agencies_id==560111 || $values.agencies_id==1469111}<td class="top center">(П.І.Б., підпис)</td>{/if}
	<td class="top center">(П.І.Б., підпис)</td>
</tr>
</table><br />



{if $values.insurer_position1}
<table cellpadding="2" cellspacing="4" width="100%">

<tr>
	<td height="30" width="33%" ></td>
	<td height="30" width="33%" >{if $values.insurer_position1}{$values.insurer_position1} {$values.insurer_company} {/if}{$values.insurer_lastname1} {$values.insurer_firstname1|truncate:2:'':true}. {$values.insurer_patronymicname1|truncate:2:'':true}.<br><br><br></td>
</tr>
<tr>
	<td></td>
	<td class="top center">(П.І.Б., підпис)</td>
</tr>
</table><br />
{/if}
<div style="page-break-after: always"></div>