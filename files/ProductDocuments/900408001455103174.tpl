<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Доп соглашение КАБ</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>

<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
 		<h1>Додаткова угода № 1 <br>
		до Договору добровільного страхування наземних транспортних засобів {$values.number}
		   від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h1>
	</td>
	<td width="220" align="center">
		<br> 
	</td>
</tr>
<tr>
	<td align="left" >
	м. Київ                                                                                                        
	</td>
    <td align="right" colspan="2">
		<p>{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table><br />

<div class=dop>
&nbsp;&nbsp;&nbsp;&nbsp;ТДВ «Експрес Страхування», 

{if $values.agencies_id==560 || $values.agencies_id==1486}
{if $values.agencies_id==560}
в особі ФО-П Турчини Надії Миколаївни , яка діє на підставі Довіреності №10/АС від 23.11.2012р. та Договору доручення №10/АС від 23.11.2012р. (далі - Страховик) відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ «Експрес Страхування» добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу) та додатків до них, зареєстрованих  Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008 р. (далі - Правила)
{/if}
{if $values.agencies_id==1486}
в особі ФО-П Турчина Максима Костянтиновича , який діє на підставі Довіреності № 137/Д от 10.07.2014 р. та Договору доручення №4/АС от 10.07.2014 р. (далі - Страховик) відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ «Експрес Страхування» добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу) та додатків до них, зареєстрованих  Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008 р. (далі - Правила)
{/if}

{else}

{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}
в особі {$values.director2}, що діє на підставі {$values.ground_kasko}
{else} 
в особі Директора Щучьєвої Тетяни Андріївни, що діє на підставі Статуту
{/if}

{/if}
 ,(далі - Страховик), з однієї Сторони та   <br>
 {if $values.insurer_person_types_id==1}
{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}, 
{else}
{$values.insurer_company} в особі {$values.insurer_position} {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname} , що діє на підставі {$values.insurer_ground}
{/if}
(далі – Страхувальник) з другої Сторони , (далі разом – Сторони), 
<br>уклали цю додаткову Угоду № 1 (далі - «Додаткова угода»)  до  Договору   страхування наземних транспортних засобів № {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. р. (далі – «Договір страхування»)  про наступне:
<br>
<br><br>
</div>



 <p>1.	Доповнити частину А Договору пунктом 12 «Додаткові опції»:
 <br><br>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td width="20%"   valign="top"><b>12. Додаткові опції</b></td>
        <td class="all" width="70%">неагрегатна страхова сума</td>
        <td class="right top bottom" width="10%">нi</td>
    </tr>
</table><br />

<p>2.	Доповнити Розділ 2 «Визначення термінів» частини Б Договору пунктами 2.1.16. та 2.1.17.:
<br><br>
<p>«2.1.16.	Агрегатна страхова сума – грошова сума, в межах якої Страховик зобов'язується здійснити  страхове відшкодування за кожним страховим випадком, що трапився протягом строку дії Договору. При цьому страхова сума за Договором зменшується після виплати Страховиком страхового відшкодування на величину проведеного страхового відшкодування. Страхувальник після виплати страхового відшкодування зобов’язаний відновити розмір страхової суми шляхом сплати додаткового страхового платежу, визначеного з урахуванням страхового тарифу, встановленого у відповідному періоді страхування за Договором. У разі, якщо страхова сума не буде відновлена, всі наступні виплати страхового відшкодування здійснюватимуться пропорційно співвідношенню зменшеної страхової суми до дійсної ринкової вартості ТЗ на момент укладання Договору. 
<p>2.1.17.	Неагрегатна страхова сума – грошова сума, в межах якої Страховик зобов’язується здійснити  страхове відшкодування по кожному страховому випадку (незалежно від їх кількості),  що мали місце протягом строку дії періоду страхування за Договором. При цьому страхова сума за Договором не зменшується після виплати Страховиком страхового відшкодування. Страхова сума не поновлюється до первісного розміру у випадку повної конструктивної загибелі ТЗ в результаті страхового випадку.»

<br><br>
<p>3.	У зв’язку з цим, п.п. 2.1.16., 2.1.17. частини Б Договору вважати п.п. 2.1.18., 2.1.19.
<br><br>
<p>4.	Доповнити Розділ 7 «Страхова сума. Ліміт відповідальності Страховика. Франшиза» частини Б Договору пунктом 7.2.:
<br><br>
<p>«7.2. Страхова сума за цим Договором може бути агрегатною або неагрегатною, згідно з умовами п.12 частини А Договору страхування.»
<br><br>
<p>5.	У зв’язку з цим, п.п. 7.2. – 7.4. частини Б Договору вважати п.п. 7.3. – 7.5.
<br><br>
<p>6.	Видалити п.7.5. частини Б Договору.
<br><br>
<p>7.	Викласти п.10.2. Розділу 10 «Визначення розміру, порядок та умови здійснення виплати страхового відшкодування» частини Б Договору в наступній редакції:
<br><br>
<p>«10.2. Сума страхового відшкодування не може бути більшою за страхову суму, що обумовлена Договором страхування.
<br><br>
<p>Виплата страхового відшкодування за цим Договором, в разі чергового настання страхового випадку та прийняття Страховиком рішення про виплату страхового відшкодування, здійснюється останнім з урахуванням або без урахування попередніх виплат страхового відшкодування за цим Договором, згідно з умовами п.12 частини А Договору страхування.»
<br><br>
<p>8.	Всі інші умови Договору страхування залишаються без змін.
<br><br>
<p>9.	Дана Додаткова угода складена в 2-х примірниках, які мають однакову юридичну силу, по одному примірнику для кожної із Сторін.

<p>10.	Дана Додаткова угода є невід’ємною частиною Договору страхування і набуває чинності з дати її підписання Сторонами.
<br><br>
<br />
<br />
<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td width="45%" valign=top>
		<table width="100%" cellspacing=0 cellpadding=5>
		<tr>
			<td colspan=2 align="center"><b>СТРАХОВИК</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom"><b>ТДВ "Експрес Страхування"</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">01004, м. Київ, вул. Велика Васильківська, 15/2</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">{if $values.bill_bank_account}{$values.bill_bank_account}{else}Р/р 265073011592 в АТ «ОЩАДБАНК»{/if}</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">{if $values.bill_bank_mfo}{$values.bill_bank_mfo}{else}МФО 300465, Код ЄДРПОУ 36086124{/if}</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">
			{if $values.agencies_id==1469 && $values.seller_agencies_id==0}
			в особі ФО-П Поліщука Михайла Олександровича, <br>
			м. Біла Церква, вул. Курсова, б. 33, кв. 22<br>
			IПН 1609508158
			{elseif $values.agencies_id==560}
			
			в особі ФОП Турчина Надія Миколаївна, <br>
			м. Київ вул. Драгоманова буд. 8-А кв.197<br>
			Р/р 26009052618831 ПАТ КБ «Приватбанк», МФО 320649, IПН 2698309504
			{elseif $values.agencies_id==1486}
			
			ФО-П Турчин Максим Костянтинович, <br>
			м. Київ вул. Драгоманова буд. 8-А кв.197<br>
			Р/р 26008052631916 ПАТ КБ «Приватбанк», МФО 320649, IПН 3482913811
			
			{else}
			&nbsp;
			{/if}
			</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<td width="50%">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}</td>
			<td class="bottom">&nbsp;</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="45%" align=right valign=top>
		{if $values.person_types_id==1}
			<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td colspan=2 align=center><b>СТРАХУВАЛЬНИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">Адреса реєстрації: {$values.insurer_address}</td>
			</tr>
			<tr>
				{if $values.insurer_id_card == 1}<td colspan=2 class="bottom">ID-карта: № {$values.insurer_newpassport_number},<br />Орган, що видав: {$values.insurer_newpassport_place} ({$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{else}<td colspan=2 class="bottom">Паспорт: {$values.insurer_passport_series} {$values.insurer_passport_number},<br />виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{/if}
			</tr>
			<tr>
				<td colspan=2 class="bottom">ІПН: {$values.insurer_identification_code}</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">&nbsp;</td>
				
			</tr>
			<tr>
				<td>{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
                <td width="50%" class="bottom">&nbsp;</td>
			</tr>
			</table>
		{else}
			<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td colspan=2 align=center><b>СТРАХУВАЛЬНИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b>{$values.insurer_company}</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">{$values.insurer_address}</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">Р/р {$values.insurer_bank_account} в {$values.insurer_bank}</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">МФО {$values.insurer_bank_mfo}, код ЄДРПОУ {$values.insurer_edrpou}</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">{if $values.insurer_position}{$values.insurer_position} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
				<td class="bottom">&nbsp;</td>
			</tr>
			</table>
		{/if}
	</td>
</tr>
{if $values.agencies_id==1486111}

<tr>
	<td width="45%" valign=top>
		<table width="100%" cellspacing=0 cellpadding=5>
		<tr>
			<td colspan=2 align="center"><b>СТРАХОВИЙ АГЕНТ</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom"><b>ФО-П Турчин Максим Костянтинович</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">м. Київ вул. Драгоманова буд. 8-А кв.197</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Р/р  26008052631916  </td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">ПАТ КБ «Приватбанк»,  </td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">МФО 320649, ІПН 3482913811</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<td width="50%">Турчина Н.М.</td>
			<td class="bottom">&nbsp;</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="49%" align=right valign=top>
		
	</td>
</tr>
{/if}

{if $values.agencies_id==1469111}

<tr>
	<td width="45%" valign=top>
		<table width="100%" cellspacing=0 cellpadding=5>
		<tr>
			<td colspan=2 align="center"><b>СТРАХОВИЙ АГЕНТ</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom"><b>ФОП Поліщук Михайло Олександрович</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Паспорт серія СК № 640606</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Виданий Міським відділом №2 Білоцерківського МУГУ МВС України в Київській області 30.09.1997 </td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">ІПН 1609508158</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Адреса м. Біла Церква, вул. Курсова, б. 33, кв. 22</td>
		</tr>
		
		<tr>
			<td colspan=2 class="bottom">Банк отримувач: АТ «ОЩАДБАНК», МФО 300465 </td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Номер рахунку: 265073011592</td>
		</tr>
		<tr>
			<td width="50%">Поліщук М.О.</td>
			<td class="bottom">&nbsp;</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="49%" align=right valign=top>
		
	</td>
</tr>
{/if}


<tr>
	<td width="45%" valign=top>
	<br><br><br>
		<table width="100%" cellspacing=0 cellpadding=5>
		<tr>
			<td colspan=2 align="center"><b>БАНК</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom"><b>Публічне акціонерне товариство</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom"><b>ПАТ «Креді Агріколь Банк»</b></td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Місцезнаходження: Україна, 01004, м. Київ, вул. Пушкінська, 42/4 </td>
		</tr>
		<tr>
			<td colspan=2 class="bottom">Код ЄДРПОУ 14361575, МФО 300614</td>
		</tr>
	
		<tr>
			<td colspan=2 class="bottom"> &nbsp;</td>
		</tr>
		<tr>
			<td colspan=2 class="bottom"> &nbsp;</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="49%" align=right valign=top>
		
	</td>
</tr>
</table>

</body>
</html>