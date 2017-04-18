<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ДГО. Заява</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1 align="center">ЗАЯВА</h1>
		<h2 align="center">на добровільне страхування цивільної відповідальності<br />власників наземного транспорту</h2>
	</td>
	<td align="right">
		<p>№ {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td width="20%"><b>1. ЗАЯВНИК (ПІБ/Назва)</b></td>
        <td class="all">{$values.insurerTitle}</td>
    </tr>
</table>
<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        {if $values.insurer_id_card == 1}<td width="20%" valign="top">Паспорт / в особі</td>{else}<td width="20%" valign="top">ID-карта / в особі</td>{/if}
        {if $values.person_types_id == 1}
            {if $values.insurer_id_card == 1}
                <td class="left bottom right">ID-карта: № {$values.insurer_newpassport_number} Орган, що видав: {$values.insurer_newpassport_place} {$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
            {else}
                <td class="left bottom right">{$values.insurer_passport_series} № {$values.insurer_passport_number} виданий {$values.insurer_passport_place} {$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
            {/if}
        {/if}
        {if $values.person_types_id == 2}
            <td class="left bottom right">{if $values.insurer_position}{$values.insurer_position} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
        {/if}
    </tr>
    {if $values.person_types_id == 1}
    <tr>
        <td>&nbsp;</td>
        <td align="center" class="small">(серія, номер, коли і ким виданий)</td>
    </tr>
    {/if}
</table><br />
{if $values.person_types_id == 2}
<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td width="20%">який діє на підставі</td>
        <td>
            <table width="100%">
                <tr>
                    <td class="all" align=center>{if $values.insurer_ground}{$values.insurer_ground}{else}&nbsp;{/if}</td>
                    <td align=center>телефон</td>
                    <td class="all" align=center>{if $values.insurer_phone}{$values.insurer_phone}{else}&nbsp;{/if}</td>
                </tr>
            </table>
        </td>
    </tr>
</table><br />
{/if}
<table cellspacing=0 cellpadding=5 width=100%>
<tr>
	<td width="20%" valign="top">адреса</td>
	<td>
		<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td align=center>країна</td>
			<td class="all" align=center>Україна</td>
			<td align=center>поштовий індекс</td>
			<td class="all" align=center>{$values.insurer_zip}</td>
		</tr>
		</table><br />

		<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td class="all">{$values.insurer_address}</td>
		</tr>
		<tr>
			<td align="center" class="small">(вулиця, будинок №, квартира, населений пункт, область, район)</td>
		</tr>
		</table>
	</td>
</tr>
</table>
{if $values.person_types_id == 2}
<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td width="20%" valign="top">банківські реквізити </td>
        <td class="all">Банк - {$values.insurer_bank}, МФО - {$values.insurer_bank_mfo}, р/р - {$values.insurer_bank_account}</td>
    </tr>
</table><br />
{/if}
<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td width="20%">Дата народження</td>
        <td>
            <table width="100%">
                <tr>
                    <td class="all" align=center>{if $values.person_types_id==1}{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{else}---{/if}</td>
                    <td align=center>Ідентифікаційний № / код ЄДРПОУ</td>
                    <td class="all" align=center>{if $values.person_types_id==1}{$values.insurer_identification_code}{else}{$values.insurer_edrpou}{/if}</td>
                </tr>
            </table>
        </td>
    </tr>
</table><br />

<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td><b>2. ВІДОМОСТІ ПРО ТРАНСПОРТНИЙ ЗАСІБ</b></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=5 width=100%>
  
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td width="40%">Марка,модель - {$values.item}</td>
        <td>Державний реєстраційцний номер - {$values.sign}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Тип ТЗ - {$values.car_type}</td>
        <td>Рік випуску - {$values.year}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>№ кузова(шасі) - {$values.shassi}</td>
        <td>Місце реєстрації - {$values.registration_cities_title}</td>
    </tr>
</table><br />

<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td><b>3. УМОВИ СТРАХУВАННЯ</b></td>
    </tr>
</table>
<table cellspacing="0" cellpadding="5" width="100%">
    <tr>
        <td valign="top" align="center" class="left top right"><b>Загальна страхова сума (агрегатний ліміт відповідальності)</b><br/><i style="text-decoration: underline;">понад ліміт відповідальності по майну за Полісом ОСЦПВВНТЗ, </i>грн.</td>
        <td valign="top" align="center" class="top right"><b>Страховий тариф, </b><br/>% від загальної страхової суми (агрегатного ліміту відповідальності)</td>
        <td valign="top" align="center" class="top right"><b>Страховий платіж, </b>грн.</td>
    </tr>
    {if $values.insurance_price_id == 1}
    <tr>
        <td align="center" class="left top right bottom">50 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
    {if $values.insurance_price_id == 2}
    <tr>
        <td align="center" class="left top right bottom">100 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
    {if $values.insurance_price_id == 3}
    <tr>
        <td align="center" class="left top right bottom">150 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
    {if $values.insurance_price_id == 4}
    <tr>
        <td align="center" class="left top right bottom">200 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
	{if $values.insurance_price_id == 5}
    <tr>
        <td align="center" class="left top right bottom">500 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
	{if $values.insurance_price_id == 6}
    <tr>
        <td align="center" class="left top right bottom">1 000 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
	{if $values.insurance_price_id == 7}
    <tr>
        <td align="center" class="left top right bottom">300 000,00</td>
        <td align="center" class="top right bottom">{$values.rate}</td>
        <td align="center" class="top right bottom">{$values.amount|moneyformat:-1}</td>
    </tr>
    {/if}
</table><br/>
<table cellspacing="0" cellpadding="0" width="100%">
    <tr>
        <td>
            Строк дії Договору страхування: з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.
        </td>
    </tr>
</table><br/>

<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td><b>4. ПОЛІС ОСЦПВВНТЗ, ДО ЯКОГО УКЛАДАЄТЬСЯ ДОГОВІР</b></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=5 width=100%>
    <tr>
        <td>
            Серія {$values.go_series} №{$values.go_number}
        </td>
    </tr>
    <tr>
        <td>
            Строк дії з {$values.go_begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р. по {$values.go_end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.
        </td>
    </tr>
    <tr>
        <td>
            Назва страховика, що видав Поліс: {$values.go_insurance_company}
        </td>
    </tr>
</table><br/>
До Заяви додаю:
<ol>
    {if $values.person_types_id == 1}
	    <li>Копія паспорту</li>
	    <li>Копія ідентифікаційного номеру</li>
    {else}
        <li>Свідоцтво про реєстрацію фізичної особи</li>
    {/if}
	<li>Копії посвідчення водія</li>
	<li>Копія Свідоцтва про реєстрацію ТЗ</li>
	<li>Копія полісу ОСЦПВВНТЗ, до якого укладається Договір страхування</li>
</ol>
<p>Я заявляю, що ознайомлений з умовами та Правилами страхування ТДВ "Експрес-страхування". Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору страхування і буде його невід'ємною частиною.</p>
<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про об'єкт страхування, надана в цій заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.</p><br /><br />
<p>Інформація, щодо:
		<ul>
		<li>страхової послуги, вартості цієї послуги для мене;</li>
		<li>умов надання додаткових страхових послуг та їх вартість;</li>
		<li>порядку сплати податків і зборів за мій рахунок в результаті отримання страхової послуги;</li>
		<li>правових наслідків та порядку здійснення розрахунків зі мною внаслідок дострокового припинення Договору страхування;
		<li>механізму захисту Страховиком прав споживачів та порядку урегулювання спірних питань, що виникають у процесі надання послуги зі страхування;</li>
		<li>реквізитів органу, який здійснює державне регулювання ринків фінансових послуг (адреса, номер телефону тощо), а також реквізитів органів з питань захисту прав споживачів;</li>
		<li>розміру винагороди фінансової установи у разі, коли вона пропонує страхові послуги, що надаються іншими фінансовими установами,</li>
		</ul>
		<p>надана мені  до укладання Договору страхування та мені зрозуміла.<br/><br/>
<table cellspacing=0 cellpadding=5 width=100%>
<tr>
	<td width="50%">{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td width="50%">{if $values.insurer_position}{$values.insurer_position} {/if}{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
</tr>
</table>
</body>
</html>