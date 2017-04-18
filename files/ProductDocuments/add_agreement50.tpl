<!-- На опцию 50 50 для альфабанка --> 
<h1 align="center">
ДОДАТКОВА УГОДА № {$values.sub_number}<br>
до Договору добровільного страхування наземних <br>
транспортних засобів, які є предметом застави <br>
№ {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
</h1>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50%" >м. Київ</td>
	<td  width="50%" align="right" >{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table>
<p class="l1">Товариство з додатковою відповідальністю “Експрес Страхування”, в особі Директора Щучьєвої Тетяни Андріївни, яка діє на підставі Статуту. від імені та в інтересах ТДВ «Експрес Страхування», далі «Страховик», з однієї Сторони,
та {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}, паспорт серії {$values.insurer_passport_series} № {$values.insurer_passport_number} 
виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}), адреса реєстрації: {$values.insurer_address}, далі за текстом "Страхувальник", з другої Сторони, 
а разом – Сторони, уклали цю Додаткову Угоду № {$values.sub_number} до Договору добровільного страхування наземних транспортних засобів № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. (надалі – Договір страхування) про наступне:
<br><br>
<p><p>
<p >1.	Викласти п. 11 частини А Договору страхування «Строк дії періодів страхування за Договором. Страхова сума. Страховий тариф. Страховий платіж та строк його сплати» в наступній редакції:
<br><br>

{section name="roll" loop=$values.yearsPayments}
		{if $smarty.section.roll.first}
		{if $smarty.section.roll.total == 1}
		{assign var=end_datetime value=$values.end_datetime}
		{else}
		{assign var=end_datetime value=$values.yearsPayments[roll.index_next].lastdate}
		{/if}


		<table cellpadding="5" cellspacing="0" width="100%" border="1">

		<tr>
			<td width="10%" rowspan="2" >№ строку дії періоду страхування</td>
			<td colspan="2" >Строк дії періоду страхування</td>
			<td rowspan="2" width="20%" >Загальна страхова сума (ДО+ТЗ), грн{if $values.financial_institutions_id==44}*{/if}</td>
			<td rowspan="2" >Страховий тариф, %</td>
			<td rowspan="2" >Стаховий платіж, грн</td>
			<td rowspan="2" >Строк сплати страхового платежу до (включно)</td>
			
		</tr>
		<tr>
			<td >дата початку </td>
			<td >дата закінчення</td>
		</tr>
		{/if}
		<tr>
				{if $smarty.section.roll.last}
				{assign var=end_datetime value=$values.end_datetime}
				{else}
				{assign var=end_datetime value=$values.payments[roll.index_next].lastdate}
				{/if}
				{if $smarty.section.roll.first}
				{assign var=end_datetime2 value=$end_datetime}
				{assign var=amount_kasko value=$values.yearsPayments[roll].amount_kasko}
					{if !$smarty.section.roll.last}
						{assign var=end_datetime2 value=$values.payments[roll.index_next].lastdate}
					{else}	
						{assign var=end_datetime2 value=$values.end_datetime}
					{/if}
				{/if}

			<td >{$smarty.section.roll.iteration}.</td>
			<td >{if $smarty.section.roll.first}{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}{$values.yearsPayments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}р.</td>
			<td >{$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			
			{if $values.terms_years_id==1 &&  $values.paymentsCount==2 && $values.agreement_types_id!=3}
				{if $smarty.section.roll.first}
				<td  align="right" {if $smarty.section.roll.first || $values.paymentsCount==2} rowspan="{$values.paymentsCount}"{/if}>{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
				<td  align="right" {if $smarty.section.roll.first || $values.paymentsCount==2} rowspan="{$values.paymentsCount}"{/if}>{$values.yearsPayments[roll].rate_kasko}</td>
				{/if}
			{else}	
				<td  align="right">{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
				<td  align="right">{$values.yearsPayments[roll].rate_kasko}</td>
			{/if}	
			<td  align="right">{$values.yearsPayments[roll].amount_kasko|moneyformat:-1}</td>
			<td >до {$values.yearsPayments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			{if $smarty.section.roll.first}
			{assign var=lastdate2 value=$values.yearsPayments[roll].lastdate}
			{/if}
		</tr>
		
		{/section}
		{if $smarty.section.roll.last}</table>{/if}
		
		<br><br>
<p class="l1">2.	Доповнити п.12 частини А Договору «Порядок сплати страхового платежу»:
<table border=0  width="100%" cellpadding="5">
<tr>
		<td class="right bottom left top">12.1. Порядок сплати страхового платежу при використанні опції «50/50»</td>
		<td class="right bottom top">У випадку застосування опції «50/50», додатковий страховий платіж за Договором сплачується на умовах та в розмірі, зазначених в п.17.1. частини Б Договору</td>
	</tr>
</table>	
<p class="l1">3.	Доповнити п.14 частини А Договору «Додаткові опції»:
<table border=0 width="100%" cellpadding="5">
<tr>
		<td class="right bottom left top" width="80%">опція страхування «50/50»</td>
		<td class="right bottom top">так</td>
	</tr>
</table>
<p class="l1">4.	Доповнити п.8.3. частини Б Договору «Страхувальник зобов'язаний»:
<p class="l1">«п.8.3.21. При укладанні Договору страхування з застосуванням опції страхування «50/50», сплатити додатковий страховий платіж у розмірі, зазначеному в п.17.1. частини Б Договору, у випадку звернення до Страховика з Заявою про виплату страхового відшкодування, протягом 15 календарних днів з дати звернення».
<p class="l1">5.	Доповнити п.13.1. частини Б Договору «Підставою для відмови Страховика у виплаті страхового відшкодування є»:
<p class="l1">«п.13.1.15. Несплата страхового платежу, передбаченого п.17.1. Частини Б Договору страхування, протягом 15 календарних днів з дати подання Страховику Заяви про виплату страхового відшкодування, у разі застосування опції страхування «50/50»
<p class="l1">6.	Доповнити частину Б Договору розділом 17 «Додаткові опції страхування»:
<p class="l1">«17.1.	При застосуванні опції страхування «50/50»: 
<p class="l1">17.1.1.	Договір набуває чинності з 00 год. 00 хв. дати, зазначеної в частині А Договору як дата початку дії Договору, але не раніше дати, наступної за датою надходження страхового платежу, зазначеного в п.11 частини А Договору, на поточний рахунок Страховика.  
<p class="l1">17.1.2.	Страхувальник, у випадку звернення до Страховика з Заявою про виплату страхового відшкодування, незалежно від розміру та характеру пошкоджень ТЗ, сплачує на поточний рахунок Страховика додатковий страховий платіж, який дорівнює страховому платежу, зазначеному в п.11 частини А Договору, та страхові платежі згідно зі всіма додатковими угодами, які укладено до Договору на дату звернення (незалежно від того, чи настав строк сплати таких платежів),  протягом 15 (п’ятнадцяти) календарних днів з дати звернення. Невиконання цієї умови є підставою для Страховика відмовити у виплаті страхового відшкодування по поданій Заяві про виплату страхового відшкодування. При цьому дія Договору не припиняється.
<p class="l1">17.1.3.	Страховик несе відповідальність щодо виплати страхового відшкодування по застрахованому ТЗ в повному обсязі після сплати Страхувальником страхових платежів в розмірі та в строк, зазначений в п.16.1.2. частини Б Договору.
<p class="l1">17.1.4.	Якщо протягом дії Договору Страхувальник не звертається до Страховика з Заявою про виплату страхового відшкодування, додатковий страховий платіж, зазначений в п.16.1.2. частини Б Договору, не підлягає сплаті Страховику. 
<p class="l1">17.1.5.	Дія Договору закінчується о 24 год. 00 хв. дати, зазначеної в частині А Договору як дата закінчення дії Договору.
<p class="l1">7.	Інші умови Договору страхування залишаються без змін.
<p class="l1">8.	Ця Додаткова Угода є невід’ємною частиною Договору страхування та набуває чинності з моменту її підписання Сторонами, але не раніше дати, наступної за датою надходження страхового платежу за строк дії другого періоду страхування за Договором, передбаченого п.1 цієї Додаткової угоди, на поточний рахунок Страховика в повному обсязі.
<p class="l1">9.	У випадку надходження страхового платежу за строк дії другого періоду страхування за Договором після дати, зазначеної в п.1 цієї Додаткової угоди як кінцева дата його сплати, ця Додаткова угода набуває чинності виключно після надання Страховику застрахованого ТЗ для огляду та складання Сторонами акту огляду ТЗ.

		
<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td width="45%" valign=top>
		<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 align="center"><b >СТРАХОВИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b >ТДВ "Експрес Страхування"</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" >01004, м. Київ, вул. Велика Васильківська, 15/2</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" >{if $values.bill_bank_account}{$values.bill_bank_account}{else}Р/р 265073011592 в АТ «ОЩАДБАНК»{/if}</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" >{if $values.bill_bank_mfo}{$values.bill_bank_mfo}{else}МФО 300465, Код ЄДРПОУ 36086124{/if}</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" >&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" >&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" >Щучьєва Т.А.</td>
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
				<td colspan=2 align=center><b >СТРАХУВАЛЬНИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b >{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom" >Адреса реєстрації: {$values.insurer_address}</td>
			</tr>
			<tr>
				{if $values.insurer_id_card == 1}<td colspan=2 class="bottom">ID-карта: № {$values.insurer_newpassport_number},<br />Орган, що видав: {$values.insurer_newpassport_place} ({$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{else}<td colspan=2 class="bottom">Паспорт: {$values.insurer_passport_series} {$values.insurer_passport_number},<br />виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{/if}
			</tr>
			<tr>
				<td colspan=2 class="bottom" >ІПН: {$values.insurer_identification_code}</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">&nbsp;</td>
				<td class="bottom">&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 >{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
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
<p class="letter" style="text-indent: 2em;">ТДВ «Експрес Страхування» щиро вдячне Вам за вибір нашої компанії при страхуванні Вашого автомобіля {$values.brand} {$values.model},  д/н {$values.sign}.
<p class="letter" style="text-indent: 2em;">Ми пропонуємо Вам надійність та впевненість у страховому захисті Вашого авто та гарантуємо своєчасне врегулювання страхових випадків.
<p class="letter" style="text-indent: 2em;">Між Вами та ТДВ «Експрес Страхування» {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. було укладено Договір   №{$values.original.number}  добровільного страхування  наземних транспортних засобів (далі – Договір страхування), строк дії поточного періоду страхування за яким закінчується  {$values.original.second_year.lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.

<p class="letter" style="text-indent: 2em;">Враховуючи позитивний досвід нашої попередньої співпраці та розраховуючи на подальші довготривалі та плідні ділові взаємини, які дуже важливі для нас, пропонуємо Вам в наступному періоді дії Договору страхування заощадити половину вартості страховки КАСКО, обравши опцію «50/50». 
<p class="letter" style="text-indent: 2em;">Опція «50/50» дозволяє Вам сплатити тільки половину страхового платежу за наступний рік страхування. Другу половину Ви сплачуєте тільки у випадку звернення до нашої Компанії за виплатою страхового відшкодування. Якщо протягом року з Вашим автомобілем нічого не трапиться, друга частина страхового платежу залишається Вам!  
<p class="letter" style="text-indent: 2em;">Можливість застосування опції «50/50» в наступному періоді дії Договору страхування погоджена з Вашим банком-кредитором - ПАТ «Альфа Банк». 
<p class="letter" style="text-indent: 2em;">У випадку Вашої згоди на подовження Договору страхування у наступному періоді з застосуванням опції «50/50», Вам належить:
<ul>
<li class="letter">підписати Додаткову угоду, що знаходиться на зворотній стороні цього листа та містить умови опції «50/50», які підлягають внесенню в Договір страхування;</li>
<li class="letter">оплатити Рахунок-фактуру, що додається, в будь-якому відділенні банківської установи.</li>
</ul>
<p class="letter" style="text-indent: 2em;">Цей лист є акційною пропозицією, щодо зменшення страхового тарифу та страхової премії за договором страхування №{$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.,
 при цьому інші умови договору страхування не змінюються.   
<p class="letter" style="text-indent: 2em;">Для зменшення розміру платежу, пропонуємо Вам підписати додаткову угоду та оплатити рахунок в будь-якому відділенні банківської установи (документи додаються). 

<p class="letter">&nbsp;&nbsp;&nbsp;За умови оплати рахунку в строк до  {$lastdate2|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.(включно), 
пропозиція щодо застосування в Договорі страхування на наступний період страхування опції «50/50» вважається акцептованою, а строк дії Договору страхування вважається подовженим на строк з 00.00  {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по 24.00 {$end_datetime2|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
<p class="letter" style="text-indent: 2em;">Просимо Вас своєчасно подовжити дію Договору страхування, щоб запобігти порушенню умов кредитної угоди. 
<p class="letter" style="text-indent: 2em;">Цей лист з підписаною Додатковою угодою, а також Рахунок з відміткою банку або квитанція про сплату є невід’ємними частинами Договору страхування та підлягають зберіганню разом з Договором страхування.
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