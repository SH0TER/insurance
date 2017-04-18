<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Сертификат. Перегоны</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 12px;
		}
		H1 {
			margin: 0px;
			font-size: 13px;
			font-weight: bold;
		}
		H2 {
			font-size: 11px;
			font-weight: bold;
		}
		P {
			font-size: 12px;
			padding-top:5px;
			padding-bottom:5px;
			margin-top: 5px;
			margin-bottom:5px;
		}
		UL {
			margin: 0px;
			padding-left: 20px;
		}
		LI {
			padding: 1px 0px 1px 0px;
		}
		.large {
			font-size: 12px;
		}
	</style>
	{/literal}
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1>Страховий сертифікат № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		{if $values.En}Insurance certificate No {$values.number} from {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}<br />{/if}
		{if $values.clients_id == 6}
		до Договору добровільного страхування наземних транспортних засобів № {$values.generalNumber} від {$values.generalDate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		(надалі по тексту іменується «Договір страхування»)
		<br>
		{else}
		до Договору добровільного страхування наземних транспортних засобів, далі - Договір, № {$values.generalNumber} від {$values.generalDate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
		{/if}
		{if $values.En}attached to the Agreement o voluntary insurance of land-based vehicle, hereinafter the Agreement {$values.number} from {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}
		</h1>
	</td>
</tr>
</table>

<p>
{if $values.clients_id == 6}
	Цей Страховий Сертифікат видано на підставі Заяви на страхування перегону автомобілів на підтвердження страхування за Договором страхування.
{else}	
	Цей Страховий Сертифікат видано на підставі зазначеного вище Договору, укладеного між ТДВ "Експерес Страхування", далі - Страховик, і {$values.insurer_company}, далі – Страхувальник, разом надалі - Сторони, на підтвердження страхування за Договором.
{/if}	
	{if $values.En}<br />This insurance certificate is issued based on the mentioned Agreement concluded between «EXPRESS INSURANCE» ALC, hereinafter Insurance company, and Insured, hereinafter the Parties, for the confirmation of insurance by the Agreement.{/if}
</p>


{if $values.clients_id == 6}
<p>1. <b>Страховик</b> – Товариство з додатковою відповідальністю «Експрес Страхування»</p>
<p>
	2. <b>Страхувальник</b> - {$values.insurer_company}.<br />
	{if $values.En}<b>Insured</b> - {$values.insurer_company_en}, {$values.insurer_position_en} {$values.insurer_lastname_en} {$values.insurer_firstname_en} {$values.insurer_patronymicname_en}.{/if}
</p>
<p>
	3. <b>Вигодонабувач</b> - {$values.assured_title}; {$values.assured_identification_code}; {$values.assured_address}; {$values.assured_phone}<br />
	{if $values.En}<b>Beneficiary</b> - {$values.assured_title_en}; {$values.assured_identification_code}; {$values.assured_addressEn}; {$values.assured_phone}{/if}
</p>

{else}

<p>
	1. <b>Страхувальник</b> - {$values.insurer_company}, {$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}.<br />
	{if $values.En}<b>Insured</b> - {$values.insurer_company_en}, {$values.insurer_position_en} {$values.insurer_lastname_en} {$values.insurer_firstname_en} {$values.insurer_patronymicname_en}.{/if}
</p>
<p>
	2. <b>Вигодонабувач</b> - {$values.assured_title}; {$values.assured_identification_code}; {$values.assured_address}; {$values.assured_phone}<br />
	{if $values.En}<b>Beneficiary</b> - {$values.assured_title_en}; {$values.assured_identification_code}; {$values.assured_addressEn}; {$values.assured_phone}{/if}
</p>
{/if}
<table width="100%" cellspacing="0" cellpadding="3">
    <tr>
        <td class="top right left"><b>3.Застрахований автомобіль{if $values.En} / Insured vehicles{/if}</b></td>
        <td class="top right bottom"><b>Марка, модель автомобіля{if $values.En} / Car make, model{/if}</b></td>
        <td class="top right bottom"><b>VIN-код автомобіля{if $values.En} / Car VIN-code{/if}</b></td>
        <td class="top right bottom"><b>Вартість автомобіля, грн.{if $values.En} /Car cost, UAH{/if}</b></td>
    </tr>
    <tr>
        <td class="right bottom left">(Об’єкт страхування) {if $values.En} / (Insurance object){/if}</td>
        <td class="right bottom">{$values.brand} {$values.model}</td>
        <td class="right bottom">{$values.shassi}</td>
        <td class="right bottom"><span class="large">{$values.price|moneyformat:-1}</span></td>
    </tr>
</table><br />

<table width="100%" cellspacing="0" cellpadding="3">
    <tr>
        <td class="all"><b>4. Місце страхування (маршрут перегону){if $values.En} / Place of insurance (transfer route){/if}</b></td>
        <td class="top right bottom">
            {if $values.clients_id == CLIENTS_AUTOCAPITAL}
                за будь-яким маршрутом, вказаним в Додатку до даного Договору страхування
				{if $values.En} / <span style="color:red">за будь-яким маршрутом, вказаним в Додатку до даного Договору страхування</span>{/if}
            {else}
                Пункт відправлення{if $values.En} / Departure{/if}: {$values.send}{if $values.En && $values.send_en} / {$values.send_en}{/if}<br />
                Пункт призначення{if $values.En} / Arrival{/if}: {$values.destination}{if $values.En && $values.destination_en} / {$values.destination_en}{/if}
            {/if}
        </td>
    </tr>
    <tr>
        <td class="right bottom left"><b>5.Підстава для перегону автомобіля (№ та дата відповідного документу){if $values.En} / Reason for vehicle transfer (number and date of relative document){/if}</b></td>
        <td class="right bottom">{$values.document_number}, {$values.document_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
    </tr>
    <tr>
        <td class="right bottom left"><b>6. Перелік страхових випадків{if $values.En} / List of contingency{/if}</b></td>
        <td class="right bottom">
			{$values.risks}
			{if $values.En}<br>{$values.risksEn}{/if}
		</td>
    </tr>
    <tr>
        <td class="right bottom left"><b>7. Страхова сума на 1 перегін, грн{if $values.En} / Insurance payment for 1 transfer, UAH{/if}</b></td>
        <td class="right bottom"><span class="large">{$values.price|moneyformat:-1}</span></td>
    </tr>
    <tr>
        <td class="right bottom left"><b>8. Франшиза (безумовна){if $values.En} / Deductible (unconditional){/if}</b></td>
        <td class="right bottom">{if $values.deductibles0}за всіма ризиками, крім «незаконного заволодіння» {$values.deductibles0};{/if}{if $values.deductibles1} за ризиком "Незаконне заволодіння" - {$values.deductibles1};{/if}{if $values.deductible} {$values.deductible}{if $values.En}/{$values.deductible}{/if}{/if}</td>
    </tr>
    <tr>
        <td class="right bottom left"><b>9. Страховий тариф {if $values.En}/Insurance rate{/if}</b></td>
        <td class="right bottom">{$values.rate} % від страхової суми{if $values.En} / {$values.rate} % from insurance payment {/if}</td>
    </tr>
    <tr>
        <td class="right bottom left"><b>10. Страховий платіж, грн.{if $values.En} / Insurance payment, UAH{/if}</b></td>
        <td class="right bottom"><span class="large">{$values.amount|moneyformat:-1}</span></td>
    </tr>
    <tr>
        <td class="right bottom left"><b>11. Строк дії страхового сертифікату{if $values.En} / Insurance certificate term{/if}</b></td>
        <td class="right bottom">
            з 00.00 год. за Київським часом {if $values.En}/ From 00.00 Kyiv time{/if} {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}<br />
            до 24.00 год. за Київським часом {if $values.En}/ till 24.00 hour Kyiv time{/if}  {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} {if $values.clients_id == CLIENTS_AUTOCAPITAL} (але не раніше дати прибуття в кінцевий пункт призначення згідно будь-якого маршруту, вказаного в Додатку до даного Договору страхування) {if $values.En}/(but not before reaching the final destination){/if}{/if}<br />
            з врахуванням часових обмежень, передбачених Розділом "Строк дії Договору страхування. Періоди страхування" Частини "А" Договору
			{if $values.En}<br>/including time limits foreseen by Chapter «Insurance agreement term. Insurance periods» Part A of the Agreement {/if}
        </td>
    </tr>
    <tr>
        <td class="right bottom left"><b>12. Додаткові умови{if $values.En} / ADDITIONAL TERMS{/if}</b></td>
        <td class="right bottom">
			Копії документів, зазначених в п. 5. Даного Страхового сертифікату, є його невід’ємною частиною.
			{if $values.En}<br>/Document copies, indicated in item 5. of the present Insurance certificate are its integral part.{/if}
		</td>
    </tr>
</table>

<p>
{if $values.clients_id == 6}
	Цей Страховий Сертифікат  є додатком до Договору страхування та його невід’ємною частиною. Взаємовідносини Сторін регламентуються чинним законодавством України та Договором страхування.
{else}
	Цей Страховий Сертифікат є Додатком до Договору та його невід’ємною частиною. Взаємовідносини Сторін регламентуються чинним законодавством України та Договором.
{/if}	
	{if $values.En}<br>/This insurance certificate is an Appendix to the Agreement and its integral part. Relation between the parties is regulated by the Ukrainian Law in force and the Agreement.{/if}
</p>

<table width=100% cellpadding=0 cellspacing=0>
	<tr>
		<td width=48% align=left valign=top>
			<table width="90%" cellspacing=0 cellpadding=5>
				<tr>
					<td colspan=2 align=center><b>З боку Страховика:</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom"><b>ТДВ "Експрес Страхування"</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">{if $values.clients_id == 6}юридична адреса: {/if}01004, м. Київ, вул. Велика Васильківська, 15/2</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">Р/р 265073011592 в АТ «ОЩАДБАНК»</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">МФО 300465, Код ЄДРПОУ 36086124</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>Директор Щучьєва Т.А.</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				{if $values.clients_id == CLIENTS_AUTOCAPITAL && $values.item_types_id == 1}
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>Бухгалтер</td>
				</tr>
				{/if}
			</table>
		</td>
		<td>&nbsp;</td>
		<td width=48% align=right valign=top>
			<table width=90% cellspacing=0 cellpadding=5>
				<tr>
					<td colspan=2 align=center><b>З боку Страхувальника:</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom"><b>{$values.insurer_company}</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">{if $values.clients_id == 6}юридична адреса: 01004,{/if}{$values.insurer_address}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">Р/р {$values.insurer_bank_account} {if $values.insurer_bank}в {$values.insurer_bank}{/if}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">МФО {$values.insurer_bank_mfo}, код ЄДРПОУ {$values.insurer_edrpou}</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>
						{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $res|compare_date:$values.date:'01.03.2014' != -1}
							Заступник генерального директора з фінансів Баюк Л. Б.
						{else}
							{$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.
						{/if}
					</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				
				{if $values.clients_id == 6}
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>
					Заступник Генерального директора<br> Гребенюк Н.П.

					</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				{/if}
			</table>
		</td>
	</tr>
</table>

{if $values.En}
<table width=100% cellpadding=0 cellspacing=0>
	<tr>
		<td width=48% align=left valign=top>
			<table width="90%" cellspacing=0 cellpadding=5>
				<tr>
					<td colspan=2 align=center><b>For Insurance company:</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom"><b>«EXPRESS INSURANCE» ALC</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">04001, Kyiv, Velyka Vasylkivska str., 15/2</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">Settlement account 265073011592 PJC "State Savings Bank of Ukraine"</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">MFO 300012, EDRPOU Code 36086124</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>Director Schucheva T.</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				{if $values.clients_id == CLIENTS_AUTOCAPITAL && $values.item_types_id == 1}
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>Бухгалтер</td>
				</tr>
				{/if}
			</table>
		</td>
		<td>&nbsp;</td>
		<td width=48% align=right valign=top>
			<table width=90% cellspacing=0 cellpadding=5>
				<tr>
					<td colspan=2 align=center><b>For Insured:</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom"><b>{$values.insurer_company_en}</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">{$values.insurer_addressEn}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">Settlement account {$values.insurer_bank_account}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">MFO {$values.insurer_bank_mfo}, EDRPOU Code {$values.insurer_edrpou}</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>{$values.insurer_position_en} {$values.insurer_lastname_en} {$values.insurer_firstname_en|truncate:2:'':true}. {$values.insurer_patronymicname_en|truncate:2:'':true}.</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				{if $values.clients_id == CLIENTS_AUTOCAPITAL && $values.item_types_id == 1}
				<tr>
					<td>&nbsp;</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				{/if}
			</table>
		</td>
	</tr>
</table>
{/if}
</body>
</html>