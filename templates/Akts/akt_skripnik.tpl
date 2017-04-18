<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт, КАСКО+ГО+ДГО, физ. лицо</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	{if $data.person_types_id==5}
	<td align="center"><h1>Акт виконаних робіт № {$row.aktnumber}</h1>
	<div align="center">до договору доручення № {$row.agreement_number} від {$row.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. </div>
	<br>
	за період з {$row.firstday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
	</td>
	</tr>
	<tr><td>м. Київ<br><br></td><td align="right">{$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	{else}
	<td align="center"><h1>АКТ наданих послуг</h1></td>
	<td align="right">
		<p>№ {$row.aktnumber}</p>
		вiд {$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
		<br>м. Київ
	</td>
	{/if}
</tr>
</table>

	<p>Ми, що нижче підписалися, Товариство з додатковою відповідальністю "Експрес страхування" (надалі-Страховик),
	в особі Директора <b>Скрипника Олександра Олексійовича</b>, який діє на підставі Статуту, з однієї сторони,  
	{if $data.person_types_id==5}
	та <b>{$row.title}</b>, в особі <b>{$row.director2}</b>, 
	який діє на підставі {$row.ground_kasko_express}, що надалі іменується Повірений, з другої сторони, уклали цей Акт про наступне:
	{else}
	та <b>{if $row.fop.title}{$row.fop.title}{else}{$row.lastname} {$row.firstname} {$row.patronymicname}{/if}</b>, місце проживання: <b>{$row.address}</b>
	(паспорт серія <b>{$row.passport_series} № {$row.passport_number}</b> виданий {$row.passport_place} 
	{$row.passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.; ідентифікаційний код {$row.identification_code}), 
	(надалі - Агент), з іншої сторони, склали Акт про те, що за {$row.aktdate}р. Агентом відповідно 
	до умов Агентського договору № {$row.agreement_number} від {$row.agreement_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. 
	наданi послуги в наступному обсязі:</p>
	{/if}
	<br />
	

<p>
<!-- КАСКО стандарт-->
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$row.policies}
{if $row.policies[roll].product_types_id!=4 && $row.policies[roll].product_types_id!=999 && $row.policies[roll].statuses_id>=3 && $row.policies[roll].commission_amount_white>0}

{if $first==1}
{if $data.person_types_id==2}
<p>Проведення пошуку юридичних та фізичних осіб з метою укладання з ними договорів страхування:</p><br />
{elseif $data.person_types_id==3}<!-- ЗАМ -->
<p>Пропонування страхувальникам форм та видів страхування:</p><br />
{elseif $data.person_types_id==5}
<p>Надання послуг по укладанню наступних договорів Страхування:
{else}
<p>Надання послуг по консультуванню з питань укладання договорів страхування:</p><br />
{/if}

<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center" rowspan="2"><b>№ &nbsp;п/п</b></td>
	<td  rowspan="2"><b>Серія, номер договору страхування</b></td>
	<td colspan="2"><b>Строк дії договору страхування</b></td>
	<td rowspan="2"><b>ПIБ страхувальника</b></td>
	<td rowspan="2"><b>Сума премій за договором страхування, грн.</b></td>
	<td rowspan="2"><b>Фактично сплачена страхова премія, грн</b></td>
	<td rowspan="2"><b>Дата сплати страхового платежу</b></td>
	<td rowspan="2"><b>% вiд страхового платежу</b></td>
	<td rowspan="2"><b>Агенська винагорода, грн.</b></td>
</tr>
<tr>
<td>з</td>
<td>по</td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$row.policies[roll].number}</td>
	<td>{$row.policies[roll].begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$row.policies[roll].end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$row.policies[roll].fio}</td>
	<td>{$row.policies[roll].amount|moneyformat:-1}</td>
	<td>{$row.policies[roll].payment_amount|moneyformat:-1}</td>
	<td>{$row.policies[roll].payment_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$row.policies[roll].commission_percent_white|moneyformat:-1}</td>
	<td>{$row.policies[roll].commission_amount_white|moneyformat:-1}</td>
</tr>
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="9" align="right">РАЗОМ</td>
	<td>{$total|moneyformat:-1}</td>
</tr>
</table><br /><br />
{/if}
{/section}


<!-- ГО стандарт-->
{assign var="first" value=1}
{assign var="totalGO" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$row.policies}
{if $row.policies[roll].product_types_id==4 && $row.policies[roll].statuses_id>=3 && $row.policies[roll].commission_amount_white>0}

{if $first==1}
{if $data.person_types_id==2}
<p>Проведення пошуку юридичних та фізичних осіб з метою укладання з ними договорів страхування:</p><br />
{elseif $data.person_types_id==3}
<p>Пропонування страхувальникам форм та видів страхування:</p><br />
{elseif $data.person_types_id==5}
<p>Надання послуг по укладанню наступних договорів Страхування:
{else}
<p>Надання послуг по консультуванню з питань укладання договорів страхування:</p><br />
{/if}
<br>
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center" rowspan="2"><b>№ &nbsp;п/п</b></td>
	<td  rowspan="2"><b>Серія, номер договору страхування</b></td>
	<td colspan="2"><b>Строк дії договору страхування</b></td>
	<td rowspan="2"><b>ПIБ страхувальника</b></td>
	<td rowspan="2"><b>Сума премій за договором страхування, грн.</b></td>
	<td rowspan="2"><b>Фактично сплачена страхова премія, грн</b></td>
	<td rowspan="2"><b>Дата сплати страхового платежу</b></td>
	<td rowspan="2"><b>% вiд страхового платежу</b></td>
	<td rowspan="2"><b>Агенська винагорода, грн.</b></td>
</tr>
<tr>
<td>з</td>
<td>по</td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$row.policies[roll].number}</td>
	<td>{$row.policies[roll].begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$row.policies[roll].end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$row.policies[roll].fio}</td>
	<td>{$row.policies[roll].amount|moneyformat:-1}</td>
	<td>{$row.policies[roll].payment_amount|moneyformat:-1}</td>
	<td>{$row.policies[roll].payment_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$row.policies[roll].commission_percent_white|moneyformat:-1}</td>
	<td>{$row.policies[roll].commission_amount_white|moneyformat:-1}</td>
</tr>
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="totalGO" value=$totalGO+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="9" align="right">РАЗОМ</td>
	<td>{$totalGO|moneyformat:-1}</td>
</tr>
</table><br /><br />
{/if}
{/section}

<!--ГО как консультации с ЭК -->

{assign var="counter" value=1}
{assign var="first" value=1}
{assign var="totalGO" value=0}
{section name="roll" loop=$row.policies}
{if $row.policies[roll].commission_amount_white > 0 && $row.policies[roll].product_types_id==999 && $row.policies[roll].statuses_id>=3}
{if $first==1}
{if $data.person_types_id==2}
<p>Проведення пошуку юридичних та фізичних осіб з метою укладання з ними договорів страхування:
{elseif $data.person_types_id==3}
<p>Пропонування страхувальникам форм та видів страхування:
{elseif $data.person_types_id==5}
<p>Надання послуг по консультуванню з питань укладання договорів страхування:
{else}
<p>Надання послуг по консультуванню з питань укладання договорів страхування:
{/if}
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center"><b>№ п/п</b></td>
	<td><b>ПIБ страхувальника</b></td>
	<td><b>Транспортний засiб</b></td>
	<td><b>Номер кузова</b></td>
	<td><b>Агенська винагорода, грн.</b></td>
</tr>
{assign var="first" value=0}
{/if}
<tr>
	<td align="center">{$counter}</td>
	<td {if $row.policies[roll].additional==1}class="additional"{/if}>{$row.policies[roll].fio}</td>
	<td {if $row.policies[roll].additional==1}class="additional"{/if}>{$row.policies[roll].item}</td>
	<td {if $row.policies[roll].additional==1}class="additional"{/if}>{$row.policies[roll].shassi}</td>
	<td {if $row.policies[roll].additional==1}class="additional"{/if} align=right>{$row.policies[roll].commission_amount_white|moneyformat:-1}</td>
</tr>
{assign var="total" value=$total+$row.policies[roll].commission_amount_white}
{assign var="totalGO" value=$totalGO+$row.policies[roll].commission_amount_white}
{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="4" align="right">РАЗОМ:</td>
	<td align=right>{$totalGO|moneyformat:-1}</td>
</tr>
</table><br />
{/if}
{/section}



За оформлення договорів страхування {$total|moneyformat:-1} грн. ({$total|moneyformat:1:true})<br><br>
1.	Сума винагороди  за цим Актом складає {$total|moneyformat:-1} грн. ({$total|moneyformat:1:true}) без ПДВ.<br>
2.	Цей Акт є достатньою підставою для фіксації факту укладання договорів страхування та розміру отриманих платежів і проведення розрахунків 
	з {$row.firstday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br>
3.	Даний Акт складено у двох примірниках, які зберігаються у Сторін за вищевказаним Договором і мають однакову юридичну силу.<br>
4.	Сторони одна до одної претензій не мають.<br>
{if !$row.fop.title && $data.person_types_id!=5}
<p>Довідково <br>
З суми винагороди утримуються наступні податки: <br>
ПДФО 15-17% - згідно розділу IV Податкового кодексу України<br>
ЄСВ 2,6% Згідно ЗУ "Про збір та облік єдиного внеску на загальнообов’язкове<br>
державне соціальне страхування" № 2464- VI<br>
{/if}

<table width="100%">
<tr>
	<td width="40%" valign="top">
		<div align="center"><b>СТРАХОВИК</b></div><br />
		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул.. Велика Васильківська, 15/2<br />
		Р/р 265000464000 в АТ «БрокБізнесБанк» м. Києва<br />
		МФО 300249, Код ЄДРПОУ 36086124<br /><br /><br />
		Директор Скрипник О.О.________________________
	</td>
	<td width="60%" valign="top">
		<div align="center"><b>АГЕНТ</b></div><br />
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
		{if !$row.recipient || !$row.zkpo || !$row.mfo || !$row.bank_account || true}<br /><br />*В разі не надання агентом-фізичною особою в СК «Експрес-страхування» банківських реквізитів  для перерахування агентської винагороди – при роздруковуванні акту необхідно їх внести вручну!!!!!!!!!!!{/if}
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


{if $data.person_types_id==2}
<div style="page-break-after: always"></div>

<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center"><h1>АКТ виконаних послуг</h1></td>
	<td align="right">
		<p>№ {$row.agency.aktnumber}</p>
		<p>від {$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
		за період з {$row.firstday} р. по {$row.lastday}р.
	</td>
</tr>
</table>

		<p>

	Товариство з додатковою відповідальністю "Експрес страхування", в особі Директора <b>Скрипника Олександра Олексійовича</b>, що діє на підставі Статуту , далі  іменується  " Страховик ", з  однієї  сторони, та {$row.agency.title}, в особі <b>{$row.agency.director2}</b>  іменується "Агент", спільно за текстом іменуються – "Сторони", склали цей  Акт виконаних робіт про наступне:
	<p><p>

	<p>1.Виконавець надав, а Замовник прийняв та оплатив наступні послуги за Договором:
<p>1.1.	 Послуги зі сприяння в укладанні договорів страхування за {$row.aktdate}р.
<p>2.	Сума винагороди  за цим Актом складає 100.00  грн. ( Сто грн. 00 коп.) без ПДВ.
<p>3.	Даний Акт складено у двох примірниках, які зберігаються у Сторін за вищевказаним Договором і мають однакову юридичну силу.
<p>4.	Сторони одна до одної претензій не мають.


<table width="100%">
<tr>
	<td width="50%">
		<div align="center"><b>СТРАХОВИК</b></div><br />

		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул.. Велика Васильківська, 15/2<br />
		Р/р 265000464000 в АТ "БрокБізнесБанк" м. Києва<br />
		МФО 300249, Код ЄДРПОУ 36086124<br /><br /><br />
		Директор Скрипник О.О.________________________
	</td>
	<td width="50%">
		<div align="center"><b>АГЕНТ</b></div><br />


		{$row.agency.title} <br />
		Адреса: {$row.agency.address}<br />
		{$row.agency.bank}<br />
		МФО {$row.agency.bank_mfo} Р/р {$row.agency.bank_account}
		<br>
		Код ЄДРПОУ:{$row.agency.edrpou} <br /><br /><br />
		{$row.agency.director1} __________________

	</td>
</tr>
</table>

{/if}



<div style="page-break-after: always"></div>
<!-- ******************************************-->

<h2>1.Факт виконання по КАСКО БАНК</h2>
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$plan}
{if $plan[roll].types_id==1}

{if $first==1}
<p>Кредитнi авто згiдно плану: {$data.credit_cars}
<p>
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center"  ><b>№ &nbsp;п/п</b></td>
	<td ><b>Номер договору страхування</b></td>
	<td  ><b>Объект страхування</b></td>
	<td  ><b>ПIБ страхувальника</b></td>
	<td  ><b>Банк</b></td>
	<td  ><b>Менеджер</b></td>
	<td  ><b>Дата сплати страхового платежу</b></td>
	<td  ><b>Дата рег авто</b></td>
	<td  ><b>Дата согл с банком</b></td>
</tr>

{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$plan[roll].number}</td>
	<td>{$plan[roll].item}</td>
	<td>{$plan[roll].insurer}</td>
	<td>{$plan[roll].financial_institutionstitle}</td>
	<td>{$plan[roll].fiomanager}</td>
	<td>{$plan[roll].datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$plan[roll].register_car_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	<td>{$plan[roll].bank_akt_payment_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
</tr>

{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="6" align="right">РАЗОМ</td>
	<td>{$counter-1}</td>
</tr>
</table><br /><br />
{/if}
{/section}

<!-- ******************************************-->

<h2>2.Факт виконання по КАСКО РIТЕЙЛ</h2>
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$plan}
{if $plan[roll].types_id==2}

{if $first==1}
<p>Не кредитнi авто згiдно плану: {$data.not_credit_cars}
<p>
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center"  ><b>№ &nbsp;п/п</b></td>
	<td ><b>Номер договору страхування</b></td>
	<td  ><b>Объект страхування</b></td>
	<td  ><b>ПIБ страхувальника</b></td>
	<td  ><b>Банк</b></td>
	<td  ><b>Менеджер</b></td>
	<td  ><b>Дата сплати страхового платежу</b></td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$plan[roll].number}</td>
	<td>{$plan[roll].item}</td>
	<td>{$plan[roll].insurer}</td>
	<td>{$plan[roll].financial_institutionstitle}</td>
	<td>{$plan[roll].fiomanager}</td>
	<td>{$plan[roll].datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
</tr>

{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="6" align="right">РАЗОМ</td>
	<td>{$counter-1}</td>
</tr>
</table><br /><br />
{/if}
{/section}


<!-- *******************ГО***********************-->

<h2>3.Факт виконання по ЦВ</h2>
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$plan}

{if $plan[roll].types_id==4}
{if $first==1}
<p>ЦВ авто згiдно плану: {$data.go_cars}
<p>
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center"  ><b>№ &nbsp;п/п</b></td>
	<td ><b>Номер договору страхування</b></td>
	<td  ><b>Объект страхування</b></td>
	<td  ><b>ПIБ страхувальника</b></td>
	<td  ><b>Менеджер</b></td>
	<td  ><b>Дата сплати страхового платежу</b></td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$plan[roll].number}</td>
	<td>{$plan[roll].item}</td>
	<td>{$plan[roll].insurer}</td>
	<td>{$plan[roll].fiomanager}</td>
	<td>{$plan[roll].datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
</tr>

{assign var="counter" value=$counter+1}
{/if}
{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="5" align="right">РАЗОМ</td>
	<td>{$counter-1}</td>
</tr>
</table><br /><br />
{/if}

{/section}




<!-- *******************Скоринг***********************-->

<h2>4.Факт виконання пре-скорінг</h2>
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$scoring}


{if $first==1}
<p>
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center"  ><b>№ &nbsp;п/п</b></td>
	<td ><b>№ анкети</b></td>
	<td  ><b>Транспортний засіб</b></td>
	<td  ><b>ПІБ Клієнта</b></td>
    <td  ><b>Комiciя</b></td>
	<td  ><b>Менеджер</b></td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$scoring[roll].number}</td>
	<td>{$scoring[roll].cars_title}</td>
	<td>{$scoring[roll].client}</td>
    <td>{$scoring[roll].commission_amount_white|moneyformat:-1}</td>
	<td>{$row.lastname} {$row.firstname} {$row.patronymicname}<!--{$scoring[roll].manager}--></td>
</tr>

{assign var="counter" value=$counter+1}

{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="4" align="right">РАЗОМ</td>
	<td>{$counter-1}</td>
</tr>
</table><br /><br />
{/if}

{/section}


<!-- *******************Экспресс кредит***********************-->

<h2>5.Продаж кредитних авто</h2>
{assign var="first" value=1}
{assign var="total" value=0}
{assign var="counter" value=1}
{section name="roll" loop=$ek}


{if $first==1}
<p>
<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="50" align="center"  ><b>№ &nbsp;п/п</b></td>
	<td ><b>№ анкети</b></td>
	<td  ><b>Транспортний засіб</b></td>
	<td  ><b>ПІБ Клієнта</b></td>
	<td  ><b>Сума кредиту, грн</b></td>
	<td  ><b>Комiciя, %</b></td>
    <td  ><b>Комiciя, грн</b></td>
</tr>
{assign var="first" value=0}
{/if}

<tr>
	<td align="center" >{$counter}</td>
	<td>{$ek[roll].number}</td>
	<td>{$ek[roll].cars_title}</td>
	<td>{$ek[roll].client}</td>
	<td>{$ek[roll].credit_amount|moneyformat:-1}</td>
	<td>{$ek[roll].commission_percent_white|moneyformat:-1}</td>
    <td>{$ek[roll].commission_amount_white|moneyformat:-1}</td>
</tr>

{assign var="counter" value=$counter+1}

{if $smarty.section.roll.last && $first==0}
<tr>
	<td colspan="6" align="right">РАЗОМ</td>
	<td>{$counter-1}</td>
</tr>
</table><br /><br />
{/if}

{/section}
</body>
</html>