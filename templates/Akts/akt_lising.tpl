 
 
 
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$row.policies}
{if $row.policies[roll].product_types_id!=4 && $row.policies[roll].product_types_id!=999 && $row.policies[roll].statuses_id>=3 && $row.policies[roll].commission_amount_white>0}

{if $first==1}
 

 
{assign var="first" value=0}
{/if}

 
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
 
{/if}
{/section}


 
{assign var="first" value=1}
{assign var="totalGO" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$row.policies}
{if $row.policies[roll].product_types_id==4 && $row.policies[roll].statuses_id>=3 && $row.policies[roll].commission_amount_white>0}

{if $first==1}
 
<br>
 
{assign var="first" value=0}
{/if}

 
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="totalGO" value=$totalGO+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
 
{/if}
{/section}

<!--ГО как консультации с ЭК -->

{assign var="counter" value=1}
{assign var="first" value=1}
{assign var="totalGO" value=0}
{section name="roll" loop=$row.policies}
{if $row.policies[roll].commission_amount_white > 0 && $row.policies[roll].product_types_id==999 && $row.policies[roll].statuses_id>=3}
{if $first==1}
 
 
{assign var="first" value=0}
{/if}
 
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="totalGO" value=$totalGO+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
 
{/if}
{/section}


{assign var="totalAkt" value=$total}












<!-- Акт для выплаты по Укравтолизинг-->
<div style="page-break-after: always"></div>

<h1 style="font-size: 17px;" align="center">АКТ  <br />
	Виконаних робіт № &nbsp;{$row.aktnumber}</h1>
	<table width=100% border=0>
	<tr><td>м. Київ</td><td align="right">31.12.2013р.</td></tr>
	</table>
	<br>
	<p>
	Ми, які підписалися нижче, на виконання Договору доручення  № {$row.agreement_number} від 01.01.2013р. (в подальшому - Договір), підтверджуємо наступне:
	ТОВ «Укравтолізинг» (в подальшому іменується «Довіритель») в особі Директора Бортюк Наталії Леонідівни та члена Дирекції - головного бухгалтера Бадрук Олени Петрівни,  які діють на підставі Статуту з однієї сторони, 
	та <b>{$row.lastname} {$row.firstname} {$row.patronymicname}</b> 
	 паспорт: {$row.passport_series} {$row.passport_number} виданий {$row.passport_place} &nbsp;{$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.,	
	(в подальшому іменується «Агент») з іншої сторони, які в подальшому разом іменуються "Сторони", 
	а кожна окремо „Сторона”, склали даний Акт про те, що згідно з умовами Договору доручення про надання агентських послуг, 
	послуги за період з  01.01.2013р. по 31.12.2013р.  
	виконані в повному обсязі. Перелік наведено в реєстрі наданих кредитів № &nbsp;{$row.aktnumber}  від  31.12.2013р.
	<br><br>
	<p><b>Вартість виконаних робіт складає {$totalAkt|moneyformat:-1} грн. ({$totalAkt|moneyformat:1:true}), в т.ч. ПДВ. </b>
<br><br>
	<p>Довідково <br>
	З суми винагороди утримуються наступні податки: <br>
	ПДФО 15-17% - згідно розділу IV Податкового кодексу України<br>
	ЄСВ 2,6% Згідно ЗУ "Про збір та облік єдиного внеску на загальнообов’язкове<br>
	державне соціальне страхування" № 2464- VI<br>
<br><br>
	<p><b>Сторони взаємних претензій не мають.</b>

	<br><br>
	<p>Даний Акт складено у двох оригінальних примірниках, українською мовою, по одному для кожної Сторони. Обидва примірники мають однакову юридичну силу.
<br><br><br>
	<table width="100%">
	<tr>
	<td width="50%" valign="top">

		<div align="center"><b>Довіритель</b></div><br />

		ТОВ «УКРАВТОЛІЗИНГ»<br />
		Адреса: 01004, м. Київ, вул. Черновоармійська, 15/2<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»<br />
		МФО 300465, Код ЄДРПОУ 34240720<br /><br /><br />
		Директор Бортюк Н.Л. ________________________<br><br>
		член Дирекції - головний <br>бухгалтер Бадрук О.П. ________________________<br><br>
	</td>
	<td width="50%" valign="top">

		<div align="center"><b>Агент</b></div><br />

		{if $data.person_types_id==5}
		{$row.title}<br />
        {elseif $row.fop.title}
        {$row.fop.title}<br />
        {else}
		{$row.lastname} {$row.firstname} {$row.patronymicname}<br />
        {/if}
		{if $data.person_types_id!=5}
		Адреса реєстрації:{$row.address}<br />
		Паспорт: {$row.passport_series} №&nbsp; {$row.passport_number},<br />
		виданий {$row.passport_place} {$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		Iдентифікаційний код {$row.identification_code}<br />
		Банк отримувача: {$row.recipient}<br />
		Код ЗКПО {$row.zkpo}<br />
		МФО {$row.mfo}<br />
		Номер рахунку {$row.bank_account}<br />
		Призначення платежу: {$row.bank_reference}<br /><br />
		{$row.lastname} {$row.firstname} {$row.patronymicname} ________________________<br />
		{if !$row.recipient || !$row.zkpo || !$row.mfo || !$row.bank_account || true}<br /><br />*В разі не надання агентом-фізичною особою в ТОВ «УКРАВТОЛІЗИНГ» банківських реквізитів  для перерахування агентської винагороди – при роздруковуванні акту необхідно їх внести вручну!!!!!!!!!!!{/if}
		{else}
		{$row.address}<br>
		Р/р {$row.bank_account} в {$row.bank}<br>
		МФО {$row.bank_mfo}<br>
		Код ЄДРПОУ {$row.edrpou}<br><br>
		
		{$row.director1} ________________________<br />
		{/if}
		
	</td>
</tr>
</table>
	
	
	
	<div style="page-break-after: always"></div>
	
	
	<h1 style="font-size: 17px;" align="center">РЕЄСТР НАДАНИХ КРЕДИТІВ № &nbsp;{$row.aktnumber}</h1>
	
	<table width=100% border=0>
	<tr><td>м. Київ</td><td align="right">31.12.2013р.</td></tr>
	</table>
	<br>
	<br>
	Ми, які підписалися нижче, на виконання  Договору доручення про надання агентських послуг  № {$row.agreement_number} від 01.01.2013р. (в подальшому - Договір), підтверджуємо наступне:
	<br><br>
	<p>1. ТОВ «Укравтолізинг» (в подальшому іменується «Довіритель») в особі Директора Бортюк Наталії Леонідівни та члена Дирекції - головного бухгалтера Бадрук Олени Петрівни,  які діють на підставі Статуту з однієї сторони, та  
	<b>{$row.lastname} {$row.firstname} {$row.patronymicname}</b> 
	паспорт: {$row.passport_series} {$row.passport_number} виданий {$row.passport_place} &nbsp;{$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. (в подальшому іменується «Агент») , 
	з іншої сторони, які в подальшому разом іменуються "Сторони", а кожна окремо „Сторона”,   засвідчують факт надання  Агентом  послуг, згідно з умовами Договору доручення про надання агентських послуг.
	<br><br>
	<p>2. Кількість кредитів наданих Покупцям, за сприянням Агента відповідно до умов Договору доручення становить {$row.creditCount} шт., загальна сума на яку надано кредити Покупцям становить {$row.totalCreditAmount|moneyformat:-1} грн.  
	<br><br>
	<p>3.Перелік укладених кредитних договорів</b>:<br><br>
	
<table border=1 cellspacing=0 cellpadding=5 width="100%" align="center">
<tr>
	<td rowspan="2" width="50" align="center">№ &nbsp;п/п</td>
	<td rowspan="2" align="center">Номер заявки-анкети</td>
	<td rowspan="2" align="center">ІПН позичальника</td>
	<td rowspan="2" align="center">ПІБ позичальника</td>
	<td rowspan="2" align="center">Сума наданого кредиту (перерахованих коштів) грн. </td>
	<td colspan="2" align="center">Винагорода Повіреного</td>
</tr>
<tr>
<td align="center">%</td>
<td align="center">грн.</td>
</tr>
{assign var="total" value=0}

{section name="roll" loop=$row.solutions}
<tr>
	<td align="center">{$smarty.section.roll.iteration}</td>
	<td>{$row.solutions[roll].number}</td>
	<td>{$row.solutions[roll].borrowerIdentificationCode}</td>
	<td>{$row.solutions[roll].fio}</td>
	<td align=right>{$row.solutions[roll].creditAgreement_amount|moneyformat:-1}</td>
	<td align=right>{$row.solutions[roll].percent|moneyformat:-1}</td>
	<td align=right>{$row.solutions[roll].commission|moneyformat:-1}</td>
</tr>

{assign var="total" value=$total+$row.solutions[roll].commission}
 
{/section}
<tr>
	<td colspan="6" align="right">Всього</td>
	<td align=right>{$total|moneyformat:-1}</td>
</tr>
</table>
<br /><br />


4.За виконану роботу в період з 01.01.2013р. по 31.12.2013р.,винагорода Агента становить {$totalAkt|moneyformat:-1} грн. ({$totalAkt|moneyformat:1:true})
<br><br>
<p>Довідково <br>
З суми винагороди утримуються наступні податки: <br>
ПДФО 15-17% - згідно розділу IV Податкового кодексу України<br>
ЄСВ 2,6% Згідно ЗУ "Про збір та облік єдиного внеску на загальнообов’язкове<br>
державне соціальне страхування" № 2464- VI<br>
<br><br>
<p>Даний Реєстр складено у двох оригінальних примірниках, українською мовою, по одному для кожної Сторони. Обидва примірники мають однакову юридичну силу
<br><br>
	<table width="100%">
	<tr>
	<td width="50%" valign="top">

		<div align="center"><b>Довіритель</b></div><br />

		ТОВ «УКРАВТОЛІЗИНГ»<br />
		Адреса: 01004, м. Київ, вул. Черновоармійська, 15/2<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»<br />
		МФО 300465, Код ЄДРПОУ 34240720<br /><br /><br />
		Директор Бортюк Н.Л. ________________________<br><br>
		член Дирекції - головний <br>бухгалтер Бадрук О.П. ________________________<br><br>
	</td>
	<td width="50%" valign="top">

		<div align="center"><b>Агент</b></div><br />

		{if $data.person_types_id==5}
		{$row.title}<br />
        {elseif $row.fop.title}
        {$row.fop.title}<br />
        {else}
		{$row.lastname} {$row.firstname} {$row.patronymicname}<br />
        {/if}
		{if $data.person_types_id!=5}
		Адреса реєстрації:{$row.address}<br />
		Паспорт: {$row.passport_series} №&nbsp; {$row.passport_number},<br />
		виданий {$row.passport_place} {$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		Iдентифікаційний код {$row.identification_code}<br />
		Банк отримувача: {$row.recipient}<br />
		Код ЗКПО {$row.zkpo}<br />
		МФО {$row.mfo}<br />
		Номер рахунку {$row.bank_account}<br />
		Призначення платежу: {$row.bank_reference}<br /><br />
		{$row.lastname} {$row.firstname} {$row.patronymicname} ________________________<br />
		{if !$row.recipient || !$row.zkpo || !$row.mfo || !$row.bank_account || true}<br /><br />*В разі не надання агентом-фізичною особою в ТОВ «УКРАВТОЛІЗИНГ» банківських реквізитів  для перерахування агентської винагороди – при роздруковуванні акту необхідно їх внести вручну!!!!!!!!!!!{/if}
		{else}
		{$row.address}<br>
		Р/р {$row.bank_account} в {$row.bank}<br>
		МФО {$row.bank_mfo}<br>
		Код ЄДРПОУ {$row.edrpou}<br><br>
		
		{$row.director1} ________________________<br />
		{/if}
		
	</td>
</tr>
</table>









</body>
</html>