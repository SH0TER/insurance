<!-- На Укргаз банк скидка 35% --> 
<h1 align="center">
ДОДАТКОВА УГОДА № {$values.sub_number}<br>
до Договору добровільного страхування наземних <br>
транспортних засобів, які є предметом застави <br>
№ {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
</h1>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50%"  class="l l1">м. Київ</td>
	<td  width="50%" align="right"  class="l">{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table>
<p  class="l l1">Товариство з додатковою відповідальністю “Експрес Страхування”, в особі Директора Щучьєвої Тетяни Андріївни, яка діє на підставі Статуту від імені та в інтересах ТДВ «Експрес Страхування», далі «Страховик», з однієї Сторони,
та {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}, паспорт серії {$values.insurer_passport_series} № {$values.insurer_passport_number} 
виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}), адреса реєстрації: {$values.insurer_address}, далі за текстом "Страхувальник", з другої Сторони, 
а разом – Сторони, уклали цю Додаткову Угоду № {$values.sub_number} до Договору добровільного страхування наземних транспортних засобів № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. (надалі – Договір страхування) про наступне:
<br><br>
<p><p>
<p  class="l l1">1.	Внести зміни до розділу «Страхова сума, страховий тариф, страхова премія за секцією 1» Договору страхування, виклавши його в наступній редакції:
<br><br>

<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td>&nbsp;</td>
	<td class="all center">Страхова сума, грн.</td>
	<td class="top right bottom center">Страховий тариф, %</td>
	<td class="top right bottom center">Страхова премія, грн.</td>
</tr>
<tr>
	<td class="top bottom left" align="right">На ТЗ:</td>
	<td class="right bottom left" align="right">{$values.car_price|moneyformat:-1}</td>
	<td class="right bottom" align="right">{$values.rate_kasko}</td>
	<td class="right bottom" align="right">{$values.amount_kasko|moneyformat:-1}</td>
</tr>
<tr>
	<td class="bottom left" align="right">На додаткове обладнання ТЗ:</td>
	<td class="right bottom left" align="right">{if $values.amount_equipment>0}{$values.price_equipment|moneyformat:-1}{else}X{/if}</td>
	<td class="right bottom" align="right">{if $values.amount_equipment>0}{$values.rate_equipment}{else}X{/if}</td>
	<td class="right bottom" align="right">{if $values.amount_equipment>0}{$values.amount_equipment|moneyformat:-1}{else}X{/if}</td>
</tr>
<tr>
	<td class="bottom left" align="right">Разом:</td>
	<td class="right bottom left" align="right">{assign var=totalPrice value=`$values.car_price+$values.price_equipment`}{$totalPrice|moneyformat:-1}</td>
	<td class="right bottom" align="right">X</td>
	<td class="right bottom" align="right">{assign var=totalAmount value=`$values.amount_kasko+$values.amount_equipment`}{$totalAmount|moneyformat:-1}</td>
</tr>
</table><br />
		
		<br><br>
<p   class="l l1">2.	Внести зміни до розділу «Порядок сплати страхової премії за Секцією 1» Договору страхування, виклавши його в наступній редакції:

<br><br>
{section name="roll" loop=$values.payments}
{if $smarty.section.roll.first}
{if $smarty.section.roll.total == 1}
{assign var=end_datetime value=$values.end_datetime}
{assign var=amount_accident value=$values.amount_accident}
{else}
{assign var=end_datetime value=$values.payments[roll.index_next].lastdate}
{assign var=amount_accident value=$values.amount_accident/$smarty.section.roll.total}
{/if}
{if $smarty.section.roll.first}
		{assign var=end_datetime2 value=$end_datetime}
		{assign var=amount_kasko value=$values.payments[roll].amount-$amount_accident}
		{assign var=lastdate2 value=$values.payments[roll].lastdate}
{/if}
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
	<td class="top right bottom center left" width="33%">Страхова премія, грн.</td>
	<td class="top right bottom center" width="33%">Строк сплати страхової премії, до (включно):</td>
	<td class="top right bottom center">Строк дії Договору (за умови сплати страхової премії в повному обсязі) з 00.00 год. дати, наступної за датою надходження страхової премії в повному обсязі на поточний рахунок Страховика)</td>
</tr>
{/if}
<tr>
	
	<td class="bottom right center left">{$values.payments[roll].amount-$amount_accident|moneyformat:-1}</td>
	<td class="bottom right center">до {$values.payments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td class="right bottom center">
		{if $smarty.section.roll.last}
		{assign var=end_datetime value=$values.end_datetime}
		{else}
		{assign var=end_datetime value=$values.payments[roll.index_next].lastdate}
		{/if}
		з 00.00 год {if $smarty.section.roll.first}{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}{$values.payments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}р.<br />
		по 24.00 год {$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
	</td>
</tr>
{/section}
</table>
<br>

<br><br>
<p  class="l l1">3.	Інші умови Договору страхування залишаються без змін.
<p  class="l l1">4.	Ця Додаткова Угода є невід’ємною частиною Договору страхування та набуває чинності з моменту її підписання Сторонами, але не раніше дати, наступної за датою надходження страхової премії, передбаченої п.2 цієї Додаткової угоди, на поточний рахунок Страховика в повному обсязі.
<p  class="l l1">5.	У випадку надходження страхової премії, передбаченої п.2 цієї Додаткової угоди, після дати, зазначеної в п.2 цієї Додаткової угоди як кінцева дата її сплати, ця Додаткова угода набуває чинності виключно після надання Страховику застрахованого ТЗ для огляду та складання Сторонами акту огляду ТЗ.

<br>		<br><br>
<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td width="45%" valign=top>
		<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 align="center"><b class="l">СТРАХОВИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b class="l">ТДВ "Експрес Страхування"</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">01004, м. Київ, вул. Велика Васильківська, 15/2</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">{if $values.bill_bank_account}{$values.bill_bank_account}{else}Р/р 265073011592 в АТ «ОЩАДБАНК»{/if}</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">{if $values.bill_bank_mfo}{$values.bill_bank_mfo}{else}МФО 300465, Код ЄДРПОУ 36086124{/if}</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" class="l">Щучьєва Т.А./td>
				<td class="bottom">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="45%" align=right valign=top>
		<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 align=center><b class="l">СТРАХУВАЛЬНИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b class="l">{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">Адреса реєстрації: {$values.insurer_address}</td>
			</tr>
			<tr>
				{if $values.insurer_id_card == 1}<td colspan=2 class="bottom" class="l">ID-карта: № {$values.insurer_newpassport_number},<br />Орган, що видав: {$values.insurer_newpassport_place} ({$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{else}<td colspan=2 class="bottom" class="l">Паспорт: {$values.insurer_passport_series} {$values.insurer_passport_number},<br />виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{/if}
			</tr>
			<tr>
				<td colspan=2 class="bottom" class="l">ІПН: {$values.insurer_identification_code}</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">&nbsp;</td>
				<td class="bottom">&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 class="l">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
			</tr>
		
		</table>
	
	</td>
</tr>
</table>

<div style="page-break-after: always"></div>
{literal}
<style>
.letter {
	font-size: 20px;
	text-align : justify;
}
.letter1 {
	font-size: 20px;

}
</style>
{/literal}
<br><br>
<br><br><br><br>
<br>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="30%">
            <br/><br/>
            <br/><br/>
            <p style="font-size: 14px;">
                Вих. № _____________________ <br/><br/>
                від __________________ {$smarty.now|date_format:"%Y"}р.
		    </p>
        </td>
        <td width="40%">
        </td>
        <td width="30%" valign="top" align="right">
            
        </td>
    </tr>
</table>
<br/><br/><br/>		
<div style="width: 1000px;padding-left:50px">

<p align="center" > <b class="letter1"> Шановний (-на) {$values.insurer_firstname} {$values.insurer_patronymicname}!</b> </p>
<br><br>
<p class="letter" style="text-indent: 2em;">Товариство з додатковою відповідальністю «Експрес Страхування» щиро вдячне Вам за вибір нашої Компанії при страхуванні Вашого автомобіля {$values.brand} {$values.model},  д/н {$values.sign}.
<p class="letter" style="text-indent: 2em;">Ми пропонуємо Вам надійність та впевненість у страховому захисті Вашого авто та гарантуємо своєчасне врегулювання страхових випадків.
<p class="letter" style="text-indent: 2em;">Між Вами та ТДВ «Експрес Страхування» {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. було укладено Договір   №{$values.original.number}  добровільного страхування  наземних транспортних засобів (далі – Договір страхування),  строк дії якого закінчується {$values.original.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.

<p class="letter" style="text-indent: 2em;">Враховуючи позитивний досвід нашої попередньої співпраці та розраховуючи на подальші довготривалі та плідні ділові взаємини пропонуємо Вам подовжити дію Договору страхування на наступний рік на більш вигідних умовах, зменшивши розмір страхового тарифу та, відповідно, розмір страхового платежу:
<ul>
<li class="letter1">у поточному році:<br> страховий тариф - {$values.original.rate} %; страховий платіж - {$values.original.amount|moneyformat:-1} грн.
<li class="letter1">пропонується на наступний рік:<br>страховий тариф - {$values.rate}%; страховий платіж - {$values.amount|moneyformat:-1}
</ul>

<p class="letter" style="text-indent: 2em;">У випадку Вашої згоди на подовження дії Договору страхування на наступний період на умовах, що пропонуються, Вам належить

<ul>
<li class="letter">підписати Договір страхування та направити 1 примірник договору Страховику;
<li class="letter">оплатити Рахунок-фактуру, що додається, в будь-якому відділенні банківської установи.
</ul>

<p class="letter" style="text-indent: 2em;">За умови оплати рахунку в строк до  {$lastdate2|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.(включно), пропозиція щодо подовження дії Договору страхування на наступний період на запропонованих умовах вважається акцептованою, а строк дії Договору страхування вважається подовженим на строк з  00.00  {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по 24.00 {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
<p class="letter" style="text-indent: 2em;">Просимо Вас своєчасно подовжити дію Договору страхування, щоб запобігти порушенню умов кредитної угоди. 
<p class="letter" style="text-indent: 2em;">Підписаний договір, а також Рахунок з відміткою банку або квитанція про його сплату підлягають зберіганню протягом всього строку дії Договору страхування.
<p class="letter" style="text-indent: 2em;">У випадку надходження страхової премії, передбаченої в пункті «порядок сплати страхової премії за Секцією 1» Договору страхування, після дати, зазначеної в пункті «порядок сплати страхової премії за Секцією 1» Договору страхування як кінцева дата її сплати, цей Договір набуває чинності виключно після надання Страховику застрахованого ТЗ для огляду та складання Сторонами акту огляду ТЗ.
<p class="letter" style="text-indent: 2em;">При виникненні будь-яких питань, Вас проконсультують спеціалісти нашої компанії за тел.(044)594-87-00.
<p class="letter" style="text-indent: 2em;">Дякуємо за співпрацю!
<br><br>
<table width="100%">
<tr>
    <td><b  class="letter1">З повагою,<br /><br />Директор<br />ТДВ «Експрес Страхування»</b> </td>
    <td align="right"><b  class="letter1">Т. А. Щучьєва</b></td>
</tr>
</table>
</div>
<br/><br/><br/>
<br/><br/><br/><br/><br/><br/>
<br/><hr/>
<table width=100% cellpadding=3 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
	<td align=right valign=top><b>Постачальник:</b></td>
	<td>
		Товариство з додатковою відповідальністю «ЕКСПРЕС СТРАХУВАННЯ»<br />
		Адреса: 01004, м. Київ, вул. Велика Васильківська 15/2.<br />
        Р/р 265073011592 в АТ «ОЩАДБАНК»,
		МФО 300465, Код ЄДРПОУ 36086124
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Одержувач:</b></td>
	<td>той самий</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align=right><b>Платник:</b></td>
	<td>{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}{else}{$values.insurer}{/if}</td>
</tr>
</table><br />

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
		<b>Рахунок-фактура № &nbsp; б/н<br />
		від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b>
	</td>
</tr>
</table>

<table width=99% cellpadding=5 cellspacing=0 border=1>
<tr>
	<th>Товар</th>
	<th width=100>&nbsp;</th>
	<th width=120>Сума, грн.</th>
</tr>
<tr>
	<td>
		{$values.number},
		{if $values.insurer_person_types_id==1}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}.{$values.insurer_patronymicname|truncate:2:'':true}.{else}{$values.insurer}{/if},
		{if $values.insurer_person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if},
		{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}
		Страховий платіж згідно договору(полісу) без ПДВ
	</td>
	<td>БЕЗ ПДВ</td>
	<td align=right>{$amount_kasko|moneyformat:-1}</td>
</tr>
</table><br /><br />

Всього на суму: {$amount_kasko|moneyformat:1:true}<br />
Без ПДВ: {$amount_kasko|moneyformat:1:true}