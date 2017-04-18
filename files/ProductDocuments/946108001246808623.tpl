<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Сертификат. Грузы</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 11px;
		}
		H1 {
			margin: 0px;
			font-size: 12px;
			font-weight: bold;
		}
		H2 {
			font-size: 11px;
			font-weight: bold;
		}
		P {
			font-size: 11px;
			padding-top:4px;
			padding-bottom:4px;
			margin-top: 4px;
			margin-bottom:4px;
		}
		UL {
			margin: 0px;
			padding-left: 20px;
		}
		LI {
			padding: 1px 0px 1px 0px;
		}
		.large {
			font-size: 11px;
		}
		.tsmall {
			font-size: 9px;
		}
	</style>
	{/literal}
</head>
<body>
<h1 align="center">
	Страховий {if $values.policy}поліс{else}сертифікат{/if} № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
	{if $values.En}Insurance {if $values.policy}policy{else}certificate{/if} No {$values.number} from {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}<br />{/if}
	до Генерального договору добровільного<br />
	{if $values.En}to the General agreeement about the voluntary insurance<br>{/if}
	страхування вантажів та багажу (вантажобагажу), далі - Договір, № {$values.generalNumber} від {$values.generalDate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br />
	{if $values.En}of cargo and baggage, hereinafter - the Agreement, No. {$values.generalNumber} from {$values.generalDate|date_format:$smarty.const.DATE_FORMAT_SMARTY}{/if}
</h1>

<p>
	Цей Страховий cертифікат видано на підставі зазначеного вище Договору, укладеного між ТДВ "Експрес Страхування", далі - Страховик, і {$values.insurer_company}, далі – Страхувальник, разом надалі - Сторони, на підтвердження страхування за Договором.
	{if $values.En}<br />Present Insurance certificate is issued based on the aforementioned Agreement, between «EXPRESS INSURANCE» ALC, hereinafter Insurance company, and {$values.clientsCompanyEn}, hereinafter Insured, hereinafter the Parties, for the confirmation of insurance by the Agreement.{/if}
</p>	

<p>
	1. <b>Страхувальник</b> - {$values.clientsCompany}, {$values.generalPosition} {$values.generalLastname} {$values.generalFirstname} {$values.generalPatronymicname}{if $values.generalGround}, який діє на підставі {$values.generalGround}{/if}
	{if $values.En}<br /><b>Insured</b> - {$values.clientsCompanyEn}, {$values.generalPositionEn} {$values.generalLastnameEn} {$values.generalFirstnameEn} {$values.generalPatronymicnameEn} acting under the {$values.generalGroundEn}{/if}
	2. <b>Вигодонабувач</b> - {$values.assured}{if $values.En} / <b>Beneficiary</b> - {$values.assured_en}{/if}</p>


{section name="roll" loop=$values.items}
{if $smarty.section.roll.first}
<table id="items" width="100%" cellspacing="0" cellpadding="3">
	<tr>
		<td colspan="5" class="all"><b>3. Застрахований вантаж{if $values.En}/Insured cargo{/if}</b></td>
		<td colspan="{if $values.clients_id == $smarty.const.CLIENTS_AUTOZAZ}4{else}5{/if}" class="top right bottom"><b>4. Транспортування вантажу{if $values.En}/ Cargo transportation{/if}</b></td>
	</tr>
	<tr>
		<td width="14%" class="right bottom left"><b>3.1. Найменування{if $values.En}<br>/Cargo name{/if} </b></td>
		{if $values.item_types_id == 1 || $values.item_types_id == 3 || $values.item_types_id == 4 || $values.item_types_id == 5}
		<td class="right bottom"><b>3.2.Кількість<br />місць {if $values.En}/Number of packages{/if}<b></td>
		<td class="right bottom"><b>3.3.Упаковка{if $values.En}/Method of packaging{/if}<b></td>
		<td class="right bottom"><b>3.4.Маса{if $values.En}/Cargo weight,kg{/if}<b></td>
		{/if}
		{if $values.item_types_id == 2}
		<td class="right bottom"  width="8%"><b>3.2.Марка{if $values.En}<br>/Mark{/if}</b></td>
		<td class="right bottom" width="8%"><b>3.3.Модель{if $values.En}<br>/Model{/if}</b></td>
		<td class="right bottom" width="8%"><b>3.4.№ шасі (кузов, рама){if $values.En}<br>/Shassi{/if}</b></td>
		{/if}
		<td class="right bottom"><b>3.5.Вартість, {if $values.amount_usd>0}USD/{/if}грн.{if $values.En}<br>/Value of cargo, USD/UAH{/if}</b></td>
		<td class="right bottom" width="9%"><b>4.1.Пункт<br />відправлення{if $values.En}<br>/Port of loading{/if}</b></td>
		{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $values.item_types_id == 2 && $values.policies_general_id!=296485}
		<td class="right bottom"><b>4.2.Маршрут<br />{if $values.En}/{/if}</b></td>
		{else}
		<td class="right bottom"><b>4.2.Пункт<br />призначення{if $values.En}<br>/Port of discharge{/if}</b></td>
		{/if}
		<td class="right bottom"><b>4.3.Відправник{if $values.En}/Sender{/if}</b></td>
		<td class="right bottom"><b>4.4.Отримувач{if $values.En}/Consignee{/if}</b></td>
		{if $values.clients_id != $smarty.const.CLIENTS_AUTOZAZ}<td class="right bottom"><b>4.5. Документи<br />(ТТН та ін.){if $values.En}<br>/Shipping documents (waybill, bill of lading, etc.){/if}</b></td>{/if}
	</tr>
	{/if}
	<tr>
		{if $values.item_types_id == 1 || $values.item_types_id == 3 || $values.item_types_id == 4 || $values.item_types_id == 5}
		<td class="right bottom left tsmall">{if $values.item_types_text}{$values.item_types_text}{else}{if $values.item_types_id == 1}автомобільні запчастини, масла, аксесуари{if $values.En} /car Parts, oil, accessories{/if}{/if}{if $values.item_types_id == 4}автомобільні запчастини{if $values.En} /car Parts{/if}{/if}{if $values.item_types_id == 5}машинокомплекти{if $values.En} /vehicle set{/if}{/if}{if $values.item_types_id == 3}запчастини для автомобілів T-150{if $values.En} /components parts for cars T-150{/if}{/if}{/if}</td>
		<td class="right bottom tsmall">{$values.items[roll].quantity}</td>
		<td class="right bottom tsmall">{$values.items[roll].packing|default:'Згідно заяви'}</td>
		<td class="right bottom tsmall">{$values.items[roll].weight}</td>
		{/if}
		{if $values.item_types_id == 2}
		<td class="right bottom left tsmall">автомобіль {if $values.En}/ Auto{/if}</td>
		<td class="right bottom tsmall">{$values.items[roll].brand}</td>
		<td class="right bottom tsmall">{$values.items[roll].model}</td>
		<td class="right bottom tsmall">{$values.items[roll].shassi}</td>
		{/if}
		<td class="right bottom tsmall"><span class="large">{if $values.amount_usd>0}{$values.items[roll].price_usd|moneyformat:-1}/{/if}{$values.items[roll].price|moneyformat:-1}</span></td>
		<td class="right bottom tsmall">{$values.items[roll].send}{if $values.En && $values.items[roll].send_en} /{$values.items[roll].send_en}{/if}</td>
		{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $values.item_types_id == 2 && $values.policies_general_id!=296485}
		<td class="right bottom tsmall">
			за будь-яким маршрутом, вказаним в Додатку до даного Договору страхування
			{if $values.En} /on any route specified in the Annex to this Insurance Contract{/if}
		</td>
		{else}
		<td class="right bottom tsmall">{$values.items[roll].destination}{if $values.En}/{$values.items[roll].destination_en}{/if}</td>
		{/if}
		<td class="right bottom tsmall">{$values.items[roll].sender}{if $values.En}/{$values.items[roll].sender_en}{/if}</td>
		<td class="right bottom tsmall">{$values.items[roll].recipient}{if $values.En}/{$values.items[roll].recipient_en}{/if}</td>
		{if $values.clients_id != $smarty.const.CLIENTS_AUTOZAZ}<td class="right bottom tsmall">{$values.items[roll].document_number}, {$values.items[roll].document_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>{/if}
	</tr>
	{if $values.clients_id == $smarty.const.CLIENTS_AUTOZAZ}
	<tr>
		<td class="right bottom left"><b>4.5. Документи</b><br />(ТТН та ін.){if $values.En}<br>/Shipping documents (waybill, bill of lading, etc.){/if}</td>
		<td colspan="{if $values.clients_id == $smarty.const.CLIENTS_AUTOZAZ}8{else}9{/if}" class="right bottom">{$values.items[roll].document_number}, {$values.items[roll].document_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
	</td>
	{/if}
	{if $smarty.section.roll.last}
</table><br />
{/if}
{/section}

{if $values.policies_general_id!=296485}
<table width="100%" cellspacing="0" cellpadding="3">
	<tr>
		<td width="30%" colspan="2" class="all"><b>4.6.Тимчасове складування{if $values.En}/Temporary storage{/if}</b></td>
		<td rowspan="2" class="top right bottom"><b>4.7.Перевантаження<br />(з одного ТЗ на інший){if $values.En}/Overload{/if}</b></td>
		<td rowspan="2" class="top right bottom"><b>4.8.Експедитор, перевізник{if $values.En}/Forwarder, carrier{/if}</b></td>
		<td width="40%" rowspan="2" class="top right bottom"><b>4.9. Транспорт,що використовується в період перевезення вантажу {if $values.En}/ Transport used during cargo transportation{/if}</b></td>
	</tr>
	<tr>
		<td class="right bottom left">місце тимчасового складування{if $values.En}<br>/place of temporary storage{/if}
		<td class="right bottom">ліміт відшкодування Страховика<br />на одне місце тимчасового складування{if $values.En}<br>/Insurance company's reimbursement limit for one spot of temporary storage{/if}</td>
	</tr>
	<tr>
		<td class="right bottom left">{if $values.temporary_storage}{$values.temporary_storage}{if $values.En && $values.temporary_storage_en} / {$values.temporary_storage_en}{/if}{else}немає{if $values.En} / No{/if}{/if}</td>
		<td class="right bottom">{if $values.temporary_storage}{$values.price|moneyformat}{if $values.En}/{$values.price|moneyformat:-1}UAH{/if}{else}немає{if $values.En} / No{/if}{/if}</td>
		<td class="right bottom">можливе{if $values.En} / Yes{/if}</td>
		<td class="right bottom">{$values.transportation_company}{if $values.En && $values.transportation_company_en}/{$values.transportation_company_en}{/if}</td>
		<td class="right bottom">
			найменування - {$values.delivery_ways_title}{if $values.delivery_title} {$values.delivery_title}{/if}, {if $values.sign_car}№ - {$values.sign_car}{if $values.sign_trailer}; причіп, № - {$values.sign_trailer}{/if}{else}за фактом доставки{/if}; на період дії страхового покриття за даним {if $values.policy}Полiсом{else}Сертифікатом{/if} Страхувальник має право здійснити перевантаження застрахованного вантажу на інший транспортний засіб без попереднього повідомлення про це Страховика
			{if $values.En}
				<br>name - {$values.delivery_ways_title_en}{if $values.delivery_title} {$values.delivery_title}{/if}, 
				{if $values.sign_car}# - {$values.sign_car}
				{if $values.sign_trailer}; trailer, # - {$values.sign_trailer}{/if}
				{else}on actual delivery{/if}; 
				for the period of insurance coverage according to this Certificate, the Insurer has a right to load the insured freight to another vehicle without preliminary notice of the Insurer 
			{/if}
		</td>
	</tr>
</table><br />
{else}
<table width="100%" cellspacing="0" cellpadding="3">
	<tr>
		<td width="30%" colspan="2" class="all"><b>4.6.Тимчасове складування{if $values.En}/Temporary storage{/if}</b></td>
		<td   class="top right bottom"><b>4.7.Перевантаження<br />(з одного ТЗ на інший){if $values.En}/Overload{/if}</b></td>
		<td   class="top right bottom"><b>4.8.Експедитор, перевізник{if $values.En}/Forwarder, carrier{/if}</b></td>
		<td width="40%"   class="top right bottom"><b>4.9. Транспорт,що використовується в період перевезення вантажу {if $values.En}/ Transport used during cargo transportation{/if}</b></td>
	</tr>
	 
	<tr>
		<td class="right bottom left" colspan="2">не покривається</td>
		<td class="right bottom">не покривається</td>
		<td class="right bottom">{$values.transportation_company}{if $values.En && $values.transportation_company_en}/{$values.transportation_company_en}{/if}</td>
		<td class="right bottom">
			найменування - {$values.delivery_ways_title}{if $values.delivery_title} {$values.delivery_title}{/if}, {if $values.sign_car}№ - {$values.sign_car}{if $values.sign_trailer}; причіп, № - {$values.sign_trailer}{/if}{else}за фактом доставки{/if}; 
			{if $values.En}
				<br>name - {$values.delivery_ways_title_en}{if $values.delivery_title} {$values.delivery_title}{/if}, 
				{if $values.sign_car}# - {$values.sign_car}
				{if $values.sign_trailer}; trailer, # - {$values.sign_trailer}{/if}
				{else}on actual delivery{/if}; 
				
			{/if}
		</td>
	</tr>
</table><br />
{/if}





<table width="100%" cellspacing="0" cellpadding="3">
	<tr>
		<td class="all"><b>5.1.Перелік страхових випадків{if $values.En}/Insurance conditions{/if}</b></td>
		<td colspan="3" class="top right bottom">
			{$values.risks}
			{if $values.En}
			<br>
			{$values.risksEn}
			{/if}
		</td>
	</tr>
	<tr>
		<td class="right bottom left"><b>5.2. Умови поставки (згідно Міжнародних торговельних термінів "INCOTERMS"{if $values.En}/Delivery conditions (according to "INCOTERMS"){/if}</b></td>
		<td class="right bottom">{$values.shipping}{if $values.En && $values.shipping_en} / {$values.shipping_en}{/if}</td>
		<td class="right bottom"><b>5.3.Страхова сума на 1 перевезення ({if $values.amount_usd>0}USD/{/if}грн.) {if $values.En}/ Insurance amount for 1 transfer ({if $values.amount_usd>0}USD/{/if}UAH){/if}</b></td>
		<td class="right bottom"><span class="large">{if $values.amount_usd>0}{$values.priceAmountUSD|moneyformat:-1} USD (в еквiвалентi {/if}{$values.priceAmount|moneyformat:-1} {if $values.amount_usd>0}грн.){/if} , що складає {$values.price_percent}% від вартості вантажу{if $values.En}<br>/ {if $values.amount_usd>0}{$values.priceAmountUSD|moneyformat:-1} USD (in an equivalent {/if}{$values.priceAmount|moneyformat:-1} {if $values.amount_usd>0}UAH){/if}, that is {$values.price_percent}% of the cargo cost{/if}</span></td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="3">
	<tr>
		<td class="right bottom left" valign="top"><b>5.4. Метод оцінки страхової суми{if $values.En} /Method for estimating the sum insured{/if}</b></td>
		<td class="right bottom" valign="top">{$values.method}{if $values.En && $values.method_en} / {$values.method_en}{/if}</td>
		<td class="right bottom" valign="top"><b>5.5.Страховий тариф, %{if $values.En} / Insurance rate, %{/if}</b></td>
		<td class="right bottom" valign="top">{$values.rate}</td>
		<td class="right bottom" valign="top"><b>5.6.Страховий платіж на 1 перевезення, {if $values.amount_usd>0}USD/{/if}грн.{if $values.En}/Insurance payment for 1 transfer {if $values.amount_usd>0}USD/{/if}UAH{/if}</b></td>
		<td class="right bottom" valign="top" width="60"><span class="large">{if $values.amount_usd>0}{$values.amount_usd|moneyformat:-1}/<br>{/if}{$values.amount|moneyformat:-1}</span></td>
		<td class="right bottom" valign="top"><b>5.7.Безумовна франшиза {if $values.En}/Unconditional deductable{/if}</b></td>
		<td class="right bottom" valign="top"><span class="large">{$values.deductibles_value|sign:$values.deductibles_absolute}</span> {if $values.En} / <span class="large">{$values.deductibles_value|signEn:$values.deductibles_absolute}</span>{/if}</td>
	</tr>
	<tr>
		<td class="right bottom left"><b>5.8.Строк дії Страхового {if $values.policy}полiсу{else}сертифікату{/if}{if $values.En}/Term of Insurance {if $values.policy}policy{else}certificate{/if}{/if}</b></td>
		<td colspan="7" class="right bottom">З{if $values.En}/From{/if} 00.00 год. за місцевим часом{if $values.En}/Kyiv time{/if} {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. до 24.00 год. за місцевим часом{if $values.En}/Kyiv time{/if} {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. (але не раніше дати прибуття в кінцевий пункт призначення){if $values.En}/(but not before reaching the final destination ){/if}</td>
	</tr>
</table>
<p>
<!--Дія страхового покриття за даним сертифікатом починається з дати надходження страхового платежу на рахунок Страховика.
<br>-->
	{if $values.comment}{$values.comment}<br />{/if}
	{if $values.comment_en}{$values.comment_en}<br />{/if}
	{if $values.amount_usd>0}* еквівалент вартості у гривні розраховується за НБУ на дату укладання данного {if $values.policy}Полiсу{else}Сертифікату{/if}<br />{/if}
	{if $values.amount_usd>0 && $values.En}* equivalents calculated by the Bank rate at the date of signing certificate data<br />{/if}
	<!--div style="page-break-after: always"></div-->
	Копії документів, зазначених в п.4.5. даного Страхового {if $values.policy}полісу{else}сертифікату{/if}, є його невід’ємною частиною.<br />
	{if $values.En}Document copies, indicated in item 4.5. of the present Insurance certificate are its integral part.<br />{/if}
	Цей Страховий {if $values.policy}полiс{else}сертифікат{/if} є Додатком до Договору та його невід’ємною частиною. Взаємовідносини Сторін регламентуються чинним законодавством України та Договором.<br />
	{if $values.En}This insurance {if $values.policy}policy{else}certificate{/if} is an Appendix to the Agreement and its integral part. Relation between the parties is regulated by the Ukrainian Law in force and the Agreement.
	<br>
	premium is already paid<br>
	claims to be paid at destination in Egypt in the same l/c currency
	{/if}
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
					<td colspan=2 class="bottom">01004, м. Київ, вул. Велика Васильківська, 15/2</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">Р/р 265073011592 в АТ «ОЩАДБАНК»</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">МФО 300465, Код ЄДРПОУ 36086124</td>
				</tr>
				
				 
				<tr>
					<td width="60%">Директор Щучьєва Т.А.</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				
				{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $values.item_types_id == 1 && $values.policies_general_id!=36077}
				<!--<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>Бухгалтер</td>
				</tr>-->
				{/if}
			</table>
		</td>
		<td>&nbsp;</td>
		<td width=48% align=right valign=top>
			<table width=100% cellspacing=0 cellpadding=5>
				<tr>
					<td colspan=2 align=center><b>З боку Страхувальника:</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom"><b>{$values.insurer_company}</b></td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">{$values.insurer_address}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">Р/р {$values.insurer_bank_account} {if $values.insurer_bank}в {$values.insurer_bank}{/if}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">МФО {$values.insurer_bank_mfo}, Код ЄДРПОУ {$values.insurer_edrpou}</td>
				</tr>
				 
			
				<tr>
					<td width="75%">
						{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $res|compare_date:$values.date:'01.04.2014' != -1}
							Заступник генерального директора з фінансів Баюк Л. Б.
						{else}
							{$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.
						{/if}
					</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $values.item_types_id == 1 && $values.policies_general_id != 36077}
				<!--<tr>
					<td>&nbsp;</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>-->
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
					<td width=60%>Director Schucheva T.</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $values.item_types_id == 1 && $values.policies_general_id != 36077}
				<tr>
					<td width=50%>&nbsp;</td>
					<td width=50% class="bottom">&nbsp;</td>
				</tr>
				
				{/if}
			</table>
		</td>
		<td>&nbsp;</td>
		<td width=48% align=right valign=top>
			<table width=100% cellspacing=0 cellpadding=5>
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
					<td colspan=2 class="bottom">Settlement account {$values.insurer_bank_account} {if $values.insurer_bank_en}in {$values.insurer_bank_en}{/if}</td>
				</tr>
				<tr>
					<td colspan=2 class="bottom">MFO {$values.insurer_bank_mfo}, EDRPOU Code {$values.insurer_edrpou}</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				
				<tr>
					<td width="60%">{$values.generalPositionEn} {$values.generalLastnameEn} {$values.generalFirstnameEn|truncate:1:'':true}. {if $values.generalPatronymicnameEn}{$values.generalPatronymicnameEn|truncate:1:'':true}.{/if}</td>
					<td class="bottom"></td>
				</tr>
				
				{if $values.clients_id == $smarty.const.CLIENTS_AUTOCAPITAL && $values.item_types_id == 1 && $values.policies_general_id != 36077}
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