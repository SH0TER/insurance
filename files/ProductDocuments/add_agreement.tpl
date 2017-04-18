{if $values.agreement_types_id>10}
<div style="page-break-after: always"></div>
{literal}
<style>
.l {
	font-size: 17px;
}
.l1 {
text-align : justify;
}
</style>
{/literal}


{if $values.options_fifty_fifty}<!-- 50/50 для альфы-->
{include file = '../files/ProductDocuments/add_agreement50.tpl'}
{elseif $values.financial_institutions_id==19}
{include file = '../files/ProductDocuments/add_agreement_ukrgaz.tpl'}
{else}

<!-- стандартное письмо-->

<h1 align="center" class="l">
ДОДАТКОВА УГОДА № {$values.sub_number}<br>
до Договору добровільного страхування наземних <br>
транспортних засобів <br>
№ {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
</h1>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50%" class="l">м. Київ</td>
	<td  width="50%" align="right" class="l">{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table>
<p class="l l1">

{$values.agencies_title}, в особі {$values.director2}, що діє на підставі {$values.ground_kasko} 
від імені та в інтересах ТДВ «Експрес Страхування» (далі - Страховик), 
відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. 
та Правил ТДВ "Експрес Страхування" добровільного страхування наземного транспорту (крім залізничного) 
від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України 
 23 жовтня 2008 р.  (далі - Правила),
та {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}, паспорт серії {$values.insurer_passport_series} № {$values.insurer_passport_number} 
виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}), адреса реєстрації: {$values.insurer_address}, далі за текстом "Страхувальник", з другої Сторони, 
а разом – Сторони, уклали цю Додаткову Угоду № {$values.sub_number} до Договору добровільного страхування наземних транспортних засобів № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. (надалі – Договір страхування) про наступне:
<br><br>
<p><p>
<p class="l">1.	Сторони погодили внести зміни до п. 11 частини А до Договору, виклавши його в наступній редакції:
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
			<td width="10%" rowspan="2" class="l">№ строку дії періоду страхування</td>
			<td colspan="2" class="l">Строк дії періоду страхування</td>
			<td rowspan="2" width="20%" class="l">Загальна страхова сума (ДО+ТЗ), грн{if $values.financial_institutions_id==44}*{/if}</td>
			<td rowspan="2" class="l">Страховий тариф, %</td>
			<td rowspan="2" class="l">Стаховий платіж, грн</td>
			<td rowspan="2" class="l">Строк сплати страхового платежу до (включно)</td>
			
		</tr>
		<tr>
			<td class="l">дата початку </td>
			<td class="l">дата закінчення</td>
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
						{assign var=end_datetime2 value=$values.yearsPayments[roll.index_next].lastdate}
					{else}	
						{assign var=end_datetime2 value=$values.end_datetime}
					{/if}
				{/if}

			<td class="l">{$smarty.section.roll.iteration}.</td>
			<td class="l">{if $smarty.section.roll.first}{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}{else}{$values.yearsPayments[roll].date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}р.</td>
			<td class="l">{$end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			
			{if $values.terms_years_id==1 &&  $values.paymentsCount==2 && $values.agreement_types_id!=3}
				{if $smarty.section.roll.first}
				<td class="l" align="right" {if $smarty.section.roll.first || $values.paymentsCount==2} rowspan="{$values.paymentsCount}"{/if}>{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
				<td class="l" align="right" {if $smarty.section.roll.first || $values.paymentsCount==2} rowspan="{$values.paymentsCount}"{/if}>{$values.yearsPayments[roll].rate_kasko}</td>
				{/if}
			{else}	
				<td class="l" align="right">{$values.yearsPayments[roll].item_price+$equipment_price|moneyformat:-1}</td>
				<td class="l" align="right">{$values.yearsPayments[roll].rate_kasko}</td>
			{/if}	
			<td class="l" align="right">{$values.yearsPayments[roll].amount_kasko|moneyformat:-1}</td>
			<td class="l">до {$values.yearsPayments[roll].lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
			{if $smarty.section.roll.first}
			{assign var=lastdate2 value=$values.yearsPayments[roll].lastdate}
			{/if}
		</tr>
		
		{/section}
		{if $smarty.section.roll.last}</table>{/if}
		
		<br><br>
<p class="l l1">2.	Інші умови Договору {$values.original.number}  залишаються без змін.
<p class="l l1">3.	Додаткова Угода № {$values.sub_number} є невід’ємною частиною Договору добровільного страхування наземних транспортних засобів № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. і набуває чинності з моменту її підписання Сторонами, та надходженням страхового платежу , передбаченого п. 11 частини А до Договору, в повному обсязі на рахунок Страховика.
<p class="l l1">4.	У випадку надходження страхової премії після дати, зазначеної як дата сплати страхової премії, ця Угода набирає чинності виключно після надання Страховику застрахованого ТЗ для огляду та складання Сторонами акту огляду ТЗ.
		
		
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
				<td width="50%" class="l">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}</td>
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
<br/><br/><br/>		<br/><br/><br/><br/><br/><br/>
<div style="width: 1000px;padding-left:50px">

<p align="center" > <b class="letter1"> Шановний (-на) {$values.insurer_firstname} {$values.insurer_patronymicname}!</b> </p>
<br><br><br><br>
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ТДВ «Експрес Страхування» щиро вдячне Вам за вибір нашої компанії при страхуванні Вашого автомобіля {$values.brand} {$values.model},  д/н {$values.sign}.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ми пропонуємо Вам надійність та впевненість у страховому захисті Вашого авто та гарантуємо своєчасне врегулювання страхових випадків.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Між Вами та ТДВ «Експрес Страхування» укладено договір страхування  №{$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. строком на 
{$values.original.terms_years_id}
{if $values.original.terms_years_id==1}
роки.
{/if}
{if $values.original.terms_years_id==2}
роки.
{/if}
{if $values.original.terms_years_id==3}
роки.
{/if}
{if $values.original.terms_years_id==4}
роки.
{/if}
{if $values.original.terms_years_id==5}
років.
{/if}
{if $values.original.terms_years_id==6}
років.
{/if}
{if $values.original.terms_years_id==7}
років.
{/if}
Наближається термін сплати чергового страхового платежу в розмірі  {$values.original.second_year.amount_kasko|moneyformat:-1} грн. (до {$values.original.second_year.lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.). 
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Враховуючи попередній досвід нашого  співробітництва та розраховуючи на довготривалу  і плідну співпрацю, яка дуже важлива для нас, а також за результатами діяльності нашої компанії в цьому році, ТДВ «Експрес Страхування» пропонує Вам внести знижений страховий платіж у розмірі 
 {$amount_kasko|moneyformat:-1} грн.
<p class="letter">&nbsp;&nbsp;&nbsp;Цей лист є акційною пропозицією, щодо зменшення страхового тарифу та страхової премії за договором страхування №{$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.,
 при цьому інші умови договору страхування не змінюються.   
<p class="letter">&nbsp;&nbsp;&nbsp;Для зменшення розміру платежу, пропонуємо Вам підписати додаткову угоду та оплатити рахунок в будь-якому відділенні банківської установи (документи додаються). 
<p class="letter">&nbsp;&nbsp;&nbsp;За умови оплати рахунку в строк до  {$lastdate2|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. дана акційна пропозиція вважається акцептованою, 
 а  страховий захист за Договором страхування №{$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. 
 продовженим на термін з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$end_datetime2|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Додаткову угоду та рахунок з відміткою банку про сплату необхідно зберегти з договором страхування, як невід’ємну його частину.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;При виникненні будь-яких питань, Вас проконсультують спеціалісти нашої компанії за тел.(044)594-87-00.
<br><br><br><br>
<table width="100%">
<tr>
    <td><b  class="letter1">З повагою,<br /><br />Директор<br />ТДВ «Експрес Страхування»</b> </td>
    <td align="right"><b  class="letter1">Т. А.  Щучьєва</b></td>
</tr>
</table>
</div>
<br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
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


{/if}




{else}
{if $values.agreement_types_id==3}
<!-- Бумага на восстановление CC-->

{assign var=amount_kasko value=$values.amount}

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
<br/><br/><br/>		<br/><br/><br/><br/><br/><br/>
<div style="width: 1000px;padding-left:50px">

<p align="center" > <b class="letter1">  Шановний (-на) {$values.insurer_firstname} {$values.insurer_patronymicname}!</b> </p>
<br><br><br><br>
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ТДВ «Експрес Страхування» щиро вдячне Вам за вибір нашої компанії при страхуванні Вашого автомобіля {$values.brand} {$values.model},  д/н {$values.sign}.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ми пропонуємо Вам надійність та впевненість у страховому захисті Вашого авто та гарантуємо своєчасне врегулювання страхових випадків.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Між Вами та ТДВ «Експрес Страхування» укладено договір страхування  №{$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. 


<p class="letter">&nbsp;&nbsp;&nbsp;На {$values.original.payed_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}, Вам було виплачено страхове відшкодування в розмірі {$values.original.payed_amount|moneyformat:-1}грн.. Договором передбачена агрегатна страхова сума, тобто, після виплати відшкодування страхова сума за договором зменшується на величину виплати. Після отримання страхового відшкодування, ми пропонуємо Вам відновити розмір страхової суми шляхом сплати додаткового страхового платежу, визначеного з урахуванням страхового тарифу, встановленого за договором.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сума додаткового платежу становить {$amount_kasko|moneyformat:-1} грн., та вказана у рахунку-фактурі.


<p class="letter">&nbsp;&nbsp;&nbsp;Після оплати рахунку, страхова сума буде поновлена до розміру, зазначеного  у договорі страхування.
<p class="letter">&nbsp;&nbsp;Квитанцію банка про сплату страхового платежу необхідно зберегти з договором страхування.
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;При виникненні будь-яких питань, Вас проконсультують спеціалісти нашої компанії за тел. (044) 594-87-00  або  за електронною адресою.

<br><br><br><br>
<table width="100%">
<tr>
    <td><b  class="letter1">З повагою,<br /><br />Директор<br />ТДВ «Експрес Страхування»</b> </td>
    <td align="right"><b  class="letter1">Т. А. Щучьєва</b></td>
</tr>
</table>
</div>
<br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
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
{/if}

{/if}
</body>
</html>