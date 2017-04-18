﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Договір добровільного страхування від нещасних випадків, Укрсоцбанк</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<p>Частина "А" Договору страхування</p>
		<h1>Особливі умови страхування</h1>
	</td>
	<td width="220" align="center">
		<img src="http://{$smarty.server.HTTP_HOST}/images/barcode_img.php?num={$values.filename}" /><br>
		{$values.filename}
	</td>
	<td align="right">
		<p>№ {$values.number}</p>
		<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>

<h2>1. Попередні відомості</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">1.1.</td>
	<td class="top right bottom"><b>Страховик</b></td>
		{if $values.ground_kasko}
			<b>Товариство з додатковою відповідальністю "Експрес Страхування",</b> яке перебуває на загальній системі оподаткування, згідно з Розділом 3 Податкового кодексу України та Розділом 19 Податкового кодексу України «Прикінцеві положення», 
			в особі {if $values.agencies_id==1469 || $values.agencies_id==1496 || $values.agencies_id==1497 || $values.agencies_id==1498 && $values.seller_agencies_id==0}{$values.director2}, що діє{else}{$values.director2} та {$values.findirector2}, що діють{/if} на підставі {$values.ground_kasko} від імені та в інтересах Страховика
		{else}
			{if $values.new_director == 1}
				<td class="top right bottom">Товариство з додатковою відповідальністю "Експрес Страхування", що є платником податку згідно ст.133 пп.133.1.1 Податкового кодексу України №2755-VI від 02.12.2010 р.,  в особі Директора Щучьєвої Тетяни Андріївни, яка діє на підставі Статуту</td>
			{else}
				<td class="top right bottom">Товариство з додатковою відповідальністю "Експрес Страхування", що є платником податку згідно ст.133 пп.133.1.1 Податкового кодексу України №2755-VI від 02.12.2010 р.,  в особі Директора Скрипника Олександра Олексійовича, який діє на підставі Статуту</td>
			{/if}
		{/if}
</tr>
<tr>
	<td class="right bottom left">1.2.</td>
	<td class="right bottom"><b>Адреса та номер телефону Страховика</b></td>
	<td class="right bottom">
		<p>Юридична адреса: 01004, м. Київ, вул. Велика Васильківська, 15/2;</p>
		<p>Фактична адреса: 01004, м. Київ, вул. Велика Васильківська, 15/2;</p>
		<p>тел. (044) 594-87-00, факс: (044) 594-87-02</p>
	</td>
</tr>
<tr>
	<td class="right bottom left">1.3.</td>
	<td class="right bottom"><b>Вид страхування</b></td>
	<td class="right bottom">Добровільне страхування від нещасних випадків</td>
</tr>
<tr>
	<td class="right bottom left">1.4.</td>
	<td class="right bottom"><b>Договір укладено відповідно до:</b></td>
	<td class="right bottom">
		<ul>
			<li>Закону України "Про страхування";</li>
			<li>Правил ТДВ "Експрес Страхування" добровільного страхування від нещасних випадків від 13 жовтня 2008р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008р.</li>
			<li>Ліцензії серія АВ № 429898 (строк дії ліцензії: з 23.10.2008р. безстроковий)</li>
		</ul>
	</td>
</tr>
</table><br />

<h2>2. Відомості про страхувальника</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">2.1.</td>
	<td class="top right bottom"><b>Страхувальник</b></td>
	<td class="top right bottom" colspan="4">{$values.insurer_title}</td>
</tr>
<tr>
	<td class="right bottom left">2.2.</td>
	<td class="right bottom"><b>Адреса проживання</b></td>
	<td class="right bottom">{$values.insurer_address}</td>
	<td class="right bottom">2.3.</td>
	<td class="right bottom"><b>Дата народження</b></td>
	<td class="right bottom">{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table><br />

<h2>3. Відомості про вигодонабувача</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">3.1.</td>
	<td class="top right bottom">{$values.assured_title}, {if $values.financial_institutions_id == 0}ІПН: {else}ЄДРПОУ: {/if}{$values.assured_identification_code}, Адреса: {$values.assured_address}, Телефон:{$values.assured_phone}</td>
</tr>
</table><br />

<h2>4. Суттєві умови договору страхування</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">4.1.</td>
	<td class="top right bottom"><b>Строк дії Договору страхування:</b></td>
	<td class="top right bottom" colspan="2">з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
<tr>
	<td class="right bottom left">4.2.</td>
	<td class="right bottom"><b>Період дії страхового покриття:</b></td>
	<td class="right bottom" colspan="2">з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
<tr>
	<td class="right bottom left">4.3.</td>
	<td class="right bottom"><b>Територія дії Договору страхування:</b></td>
	<td class="right bottom" colspan="2">Україна</td>
</tr>
<tr>
	<td class="right bottom left">4.4.</td>
	<td class="right bottom"><b>Вид діяльності Застрахованої особи:</b></td>
	<td class="right bottom" colspan="2">{$values.insurer_activity}</td>
</tr>
<tr>
	<td class="right bottom left">4.5.</td>
	<td class="right bottom"><b>Страхова сума, грн.:</b></td>
	<td class="right bottom" colspan="2">{$values.price|moneyformat:-1}</td>
</tr>
<tr>
	<td class="right bottom left">4.6.</td>
	<td class="right bottom"><b>Страховий (річний) тариф, %:</b></td>
	<td class="right bottom" colspan="2">{$values.rate}</td>
</tr>
<tr>
	<td class="right bottom left">4.7.</td>
	<td class="right bottom"><b>Страховий платіж, грн.:</b></td>
	<td class="right bottom" colspan="2">{$values.amount|moneyformat:-1}</td>
</tr>
<tr>
	<td class="right bottom left" rowspan="2">4.8.</td>
	<td class="right bottom" rowspan="2"><b>Особливі умови:</b></td>
    <td class="right bottom">4.8.1. Дія страхового захисту продовж доби:</td>
	<td class="right bottom">{$values.correct_factors.3}</td>
</tr>
    <td class="right bottom">4.8.2.</td>
	<td class="right bottom">&nbsp;</td>
</tr>
</table><br />

<h2>5. Страхові випадки</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">5.1.</td>
	<td class="top right bottom" rowspan="3"><b>Страхові випадки:</b></td>
	<td class="top right bottom">Смерть Страхувальника/Застрахованої особи, яка настала внаслідок нещасного випадку, який відбувся зі Страхувальником/Застрахованою особою під час дії Договору страхування</td>
	<td class="top right bottom">{if $values.ns_death}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td class="right bottom left">5.2.</td>
	<td class="right bottom">Встановлення І групи інвалідності Страхувальнику/Застрахованій особі, яка настала внаслідок нещасного випадку, який відбувся зі Страхувальником/Застрахованою особою під час дії Договору страхування</td>
    <td class="right bottom">{if $values.invalid1}Так{else}Ні{/if}</td>
</tr>
<tr>
	<td class="right bottom left">5.3.</td>
	<td class="right bottom">Встановлення ІІ групи інвалідності Страхувальнику/Застрахованій особі, яка настала внаслідок нещасного випадку, який відбувся зі Страхувальником/Застрахованою особою під час дії Договору страхування</td>
    <td class="right bottom">{if $values.invalid2}Так{else}Ні{/if}</td>
</tr>
</table>

<h2>6. Порядок внесення страхового платежу</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">6.1.</td>
	<td class="top right bottom"><b>Страховий платіж сплачується:</b></td>
	<td class="top right bottom">Одноразово</td>
	<td class="top right bottom"><b>Сплатити до:</b></td>
	<td class="top right bottom">{$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table><br />

<h2>7. Прикінцеві положення</h2>																																						
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td class="all">7.1.</td>
	<td class="top right bottom">Договір складається з Частини А – Особливі умови, Частини Б – Умови добровільного страхування від нещасних випадків та Заяви на страхування, що підписана Страхувальником та на підставі якої був укладений договір страхування, і є дійсним за наявності всіх частин договору. Страхувальник має право отримати дублікат Договору страхування або його частин у випадку втрати. Відсутність хоча б однієї з частин свідчить про недійсність Договору страхування.</td>
</tr>
<tr>
	<td class="left right bottom">7.2.</td>
	<td class="right bottom">Цей Договір страхування набирає чинностіз 00 год. дати, наступної за датою надходження страхового платежу на розрахунковий рахунок Страховика, але не раніше дати початку строку дії Договору страхування.</td>
</tr>
</table><br />

<table cellpadding="2" cellspacing="4" width="100%">
<tr>
	<td width="45%" align="center"><b>СТРАХОВИК</b></td>

	<td width="45%" align="center"><b>СТРАХУВАЛЬНИК</b></td>
</tr>
<tr>
	<td>М.П.</td>
	<td align="center"><b>З Правилами страхування ознайомлений, з умовами Договору страхування згоден</b></td>
</tr>
<tr>
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}{if $values.new_director == 1}Директор Щучьєва Т.А.{else}Директор Скрипник О.О.{/if}{/if}</td>
	<td height="30">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td class="top center">(П.І.Б., підпис)</td>
</tr>
{if $values.agencies_id!=1469 || $values.agencies_id!=1496 || $values.agencies_id!=1497 || $values.agencies_id!=1498}
<tr>
			<td width="50%">{$values.findirector1}</td>
			<td>&nbsp;</td>
		</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td></td>
</tr>
{/if}
</table><br />
																																			
<div style="page-break-after: always"></div>

<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<p>Частина "Б" Договору страхування:</p>
		<h1>Умови добровільного страхування від нещасних випадків</h1>
	</td>
	<td align="right">
		<p>№ {$values.number}</p>
		<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>


<h2>1. ПРЕДМЕТ ДОГОВОРУ  СТРАХУВАННЯ</h2>
<p>1.1.	Предметом Договору страхування є добровільне страхування від нещасних випадків. Страховик бере на себе зобов’язання, у разі настання страхового випадку, виплатити Страхувальнику/Застрахованій особі, Спадкоємцеві (за законом) або Вигодонабувачу страхову виплату в межах страхової суми, згідно з умовами цього Договору страхування.
<h2>2.	ОБ’ЄКТ СТРАХУВАННЯ</h2>
<p>2.1.	Об’єктом страхування є майнові інтереси, що не суперечать законодавству України, пов’язані з життям, здоров’ям та працездатністю Страхувальника/Застрахованої особи.
<h2>3.	ЗАГАЛЬНІ ПОЛОЖЕННЯ</h2>
<p>3.1.	Якщо Страхувальник уклав Договір власного страхування від нещасних випадків, то він одночасно є і Застрахованою особою.
<p>3.2.	Нещасний випадок – це раптова, випадкова, короткочасна, не передбачувана та незалежна від волі Страхувальника та Вигодонабувача подія, що фактично відбулася і внаслідок якої настав розлад здоров’я і/або  смерть Страхувальника, а саме: травматичні пошкодження, поранення; випадкове потрапляння в дихальні шляхи чужорідного тіла або рідини; ураження блискавкою і/або електричним струмом; опіки; утоплення; обмороження; переохолодження; укуси тварин,  отруйних комах, змій; випадкове отруєння газами, побутовими або промисловими хімічними речовинами, отруйними рослинами, ліками (крім випадків самолікування), захворювання кліщовим енцефалітом, ботулізмом, малярією, правцем, сказом.
<h2>4.	ВИКЛЮЧЕННЯ ІЗ СТРАХОВИХ ВИПАДКІВ</h2>
<p>4.1.	Згідно з умовами даного Договору страхування, Страховик не несе вiдповiдальностi i не здійснює страхових виплат прямо чи побічно пов'язаних з:
<p>4.1.1.	    умисними діями чи грубою необережністю з боку Страхувальника/Застрахованої особи або Вигодонабувача;
<p>4.1.2.	 навмисними заподіяннями Страхувальником/Застрахованою особою собі тілесних ушкоджень;
<p>4.1.3.	самогубством або спробою самогубства, за винятком тих випадків, коли Страхувальника/Застраховану особу було доведено до такого стану протиправними діями третіх осіб;
<p>4.1.4.	бійкою, вживанням алкоголю, наркотиків та інших речовин, що можуть спричинити сп’яніння, за винятком прийому цих речовин внаслідок протиправних дій третіх осіб у вигляді примусу або загрози життю;
<p>4.1.5.	керуванням Страхувальником/Застрахованою особою засобами наземного або водного транспорту без відповідного посвідчення або відповідної категорії, а також передачею управління транспортним засобом особі, яка знаходилась в стані алкогольного, наркотичного або токсичного сп’яніння, не має посвідчення водія або відповідної категорії;
<p>4.1.6.	з польотами на будь-яких літальних апаратах, за винятком випадків, коли Страхувальник/Застрахована особа летить у ролі пасажира у цивільному літаку, власник якого має ліцензію на пасажирські перевезення;
<p>4.1.7.	участю в спортивних заняттях, тренуваннях, змаганнях та інших заняттях, пов'язаних з підвищеною небезпекою для життя та здоров'я, крім випадків коли було сплачено додатковий тариф, та обумовлено в „Особливих умовах” Договору страхування (Частина А);
<p>4.1.8.	службою в збройних силах та військових формуваннях;
<p>4.1.9.	форс-мажорними  обставинами (війна, військові дії, їх наслідки, народні хвилювання, революція, заколот, повстання, громадянські заворушення, страйки, терористичні акти, надзвичайні, особливі чи військові стани, оголошені органами державної влади у встановленому законодавством порядку, природні лиха, радіоактивне, хімічне або бактеріологічне забруднення, дія іонізуючого випромінення);
<p>4.1.10.	самолікуванням, негативними наслідками діагностичних та лікувальних процедур;
<p>4.1.11.	хворобами різного роду, у тому числі професійними, та їх наслідками;
<p>4.1.12.	харчовими отруєннями, епідеміями.
<p>4.2.	Втрата професійної працездатності не є страховим випадком та не є підставою для здійснення виплати.
<p>4.3.	Не визнаються страховим випадком смерть або інвалідність, які сталися більш ніж через шість місяців з дня настання нещасного випадку, який мав місце під час дії Договору страхування.
<h2>5.	УМОВИ ЗДІЙСНЕННЯ СТРАХОВОЇ ВИПЛАТИ</h2>
<p>5.1.	Для отримання страхової виплати Страховику надаються  наступні документи:
<p>5.1.1.	Заява про страхову виплату з зазначенням обставин настання та характеру страхового випадку від особи, яка зазначена у Договорі страхування для отримання страхової виплати;
<p>5.1.2.	Договір страхування;
<p>5.1.3.	документи, що підтверджують настання страхового випадку (оригiнали або завiренi вiдповiдними медичними установами або уповноваженим представником Страховика копії):
<ul>
    <li>	акт про нещасний випадок на виробництві з детальним описом причин, якi зумовили настання страхового випадку, підписаний керівником або представником підприємства, на якому працює Страхувальник/Застрахована особа, іншою відповідальною особою – при нещасних випадках, що сталися на виробництві;
    <li>	лікувальний лист або довідка про непрацездатність (у впадку непрацездатності), довідка щодо амбулаторного (стаціонарного) лікування для дітей та непрацюючих;
    <li>	документи, видані медико-соціальною експертною комісією (МСЕК), що пiдтверджують встановлення групи iнвалiдностi;
    <li>	рентгенологічні знімки, заключення лабораторних та інструментальних методів дослідження, а також інші документи за запитом Страховика, якщо це необхідно для прийняття рішення про настання страхоовго випадку та визначення розміру збитку;
    <li>	результати досліджень на наявність алкоголю та наркотиків;
    <li>	в разі смерті Страхувальника/Застрахованої особи внаслідок нещасного випадку - свідоцтво про смерть Страхувальника/Застрахованої особи, протокол розтину, або акт судово-медичної єкспертизи.
</ul>
<p>5.1.4.	документи про правонаступництво (для Спадкоємців);
<p>5.1.5.	паспорт та довідка про присвоєння ідентифікаційного номеру особи, яка отримує страхову виплату;
<p>5.1.6.	довідка з ДАІ, якщо страховий випадок стався внаслідок дорожньо-транспортної пригоди;
<p>5.1.7.	матеріали слідчих та судових органів – у разі необхідності.*
<p>*Документи надаються у разі, якщо у зв’язку з подією, яка призвела до страхового випадку, ведеться кримінальна справа, розпочато розслідування слідчими органами, розпочато судовий процес або закінчено розслідування або судовий розгляд.
<p>5.2.	Страхова виплата здійснюється в залежності від переліку страхових випадків, зазначених в Частині А даного Договору страхування, в наступних розмірах:
<p>5.2.1.	у разі смерті Страхувальника/Застрахованої особи внаслідок нещасного випадку, який відбувся під час дії Договору страхування - 100% страхової суми;
<p>5.2.2.	у разі встановлення первинної інвалідності Страхувальнику/Застрахованій особі внаслідок нещасного випадку, який відбувся під час дії Договору страхування:
<ul>
    <li>50% від  страхової суми – за ІІІ групу інвалідності;
    <li>75% від страхової суми – за ІІ групу інвалідності;
    <li>100% від страхової суми  – за І групу інвалідності;
</ul>
<p>5.2.3.	у разі тимчасової втрати Страхувальником/Затсрахованою особою загальної працездатності внаслідок нещасного випадку за кожну добу непрацездатності – 0,5% від  страхової суми, але не більше 50% страхової суми.
<p>5.3.	У разі смерті або встановлення інвалідності Страхувальнику/Застраховані особі після тимчасової втрати працездатності або отримання ним страхоовї виплати, страхувальнику (Застраховані особі або спадкоємцю) виплачується різниця між страховою виплатою, передбаченою п. 5.2.1.-5.2.2., та вже отриманою страховою виплатою.
<h2>6.	СТРОК ПРИЙНЯТТЯ РІШЕННЯ ПРО ВИПЛАТУ. ПОРЯДОК І УМОВИ ЗДІЙСНЕННЯ СТРАХОВИХ ВИПЛАТ</h2>
<p>6.1.	При наявності всіх необхідних документів Страховик здійснює їх перевірку та приймає рішення про виплату або відмову протягом 10-ти робочих днів з дня отримання останнього документа, та здійснює виплату в межах страхової суми протягом 10 робочих днів після прийняття рішення.
<p>6.2.	Страхова виплата здійснюється у національній грошовій одиниці України.
<p>6.3.	Страхова виплата здійснюється Вигодонабувачу у розмірі фактичної заборгованості Страхувальника за кредитним договором, але не більше суми страхового відшкодування, розрахованного відповідно до умов договору страхування. Різниця між сумою страхового відшкодування та сумою, виплаченою Вигодонабувачу сплачується Страхувальнику. Інший порядок виплати страхового відшкодування може бути визначенно за письмовою згодою Вигодонабувача.
<p>6.4.	Страхову виплату за страховим випадком може отримати також інша особа за письмовим розпорядженням Страхувальника/Застрахованої особи та Вигодонабувача, оформленим згідно з чинним законодавством України.
<p>6.5.	В будь-якому випадку сума страхових виплат в зв’язку з одним чи кількома страховими випадками не може перевищувати страхову суму, обумовлену Договором страхування.
<p>6.6.	Належну страхову виплату Страховик здійснює через банківську систему або на рахунок одержувача, відповідно до інформації, зазначеної в „Заяві на виплату”.
<h2>7.	ПРИЧИНИ ВІДМОВИ У СТРАХОВІЙ ВИПЛАТІ</h2>
<p>7.1.	Підставою для відмови Страховика у здійсненні страхової виплати є:
<p>7.1.1.	навмисні дії Страхувальника/Застрахованої особи, Вигодонабувача, на користь якого укладено Договір страхування, спрямовані на настання страхового випадку. Зазначена норма не поширюється на дії, пов’язані з виконанням ними громадського чи службового обов’язку, в стані необхідної оборони (без перевищення її меж), або захисту майна, життя, здоров’я, честі, гідності та ділової репутації. Класифікація дій Страхувальника/Застрахованої особи або особи, на користь якої укладено Договір страхування, встановлюється відповідно до чинного законодавства України;
<p>7.1.2.	вчинення Страхувальником/Застрахованою особою або іншою особою, на користь якої укладено Договір страхування, умисного злочину, що призвів до страхового випадку;
<p>7.1.3.	подання Страхувальником/Застрахованою особою свідомо неправдивих відомостей про об’єкт страхування або про факт настання страхового випадку;
<p>7.1.4.	несвоєчасне повідомлення Страхувальником/Застрахованою особою про настання страхового випадку без поважних на це причин або створення Страховикові перешкод у визначенні обставин, характеру та розмірів збитків;
<p>7.1.5.	відмова від обстеження Страхувальника/Застрахованої особи довіреним лікарем Страховика після настання страхового випадку;
<p>7.1.6.	 в інших випадках, передбачених законодавством України.
<h2>8.	ПРАВА ТА ОБОВ’ЯЗКИ СТОРІН</h2>
<p>8.1.	Під час дії Договору страхування Страхувальник/Застрахована особа має право:
<p>8.1.1.	на отримання страхової виплати, відповідно до обраного переліку страхових випадків (Частина А Договору страхування);
<p>8.1.2.	при укладенні Договору страхування призначити, за згодою Застрахованої особи, Вигодонабувача для отримання страхової виплати;
<p>8.1.3.	у випадку відмови Страховика виплатити страхову виплату - звернутися до Страховика з обґрунтованими претензіями і вимогою повторної перевірки документів у термін, не більше 30 днів;
<p>8.1.4.	вимагати від Страховика письмового обґрунтування причин відмови у страховій виплаті.
<p>8.2.	Страхувальник/Застрахована особа зобов’язана:
<p>8.2.1.	при укладенні Договору страхування надати інформацію Страховикові про всі відомі йому обставини, що мають істотне значення для оцінки страхового ризику, і надалі інформувати його про будь-яку зміну страхового ризику (в тому числі, пов’язані з професійною діяльністю Страхувальника/Застрахованої особи та місцем його/її перебування під час дії Договору страхування). Істотними є такі обставини, які можуть мати вплив на рішення Страховика щодо укладання Договору страхування взагалі або щодо укладення Договору страхування  на узгоджених із Страхувальником/Застрахованою особою умовах;
<p>8.2.2.	повідомляти Страховика про інші діючі договори страхування щодо об’єкта страхування;
<p>8.2.3.	дотримуватись всіх умов Договору страхування;
<p>8.2.4.	вживати заходів щодо запобігання та зменшення збитків, завданих внаслідок настання нещасного випадку;
<p>8.2.5.	 повідомити про страховий випадок протягом 2 (двох) робочих днів з дня його настання,  будь-яким способом, що дозволить об’єктивно зафіксувати факт повідомлення.
<p>8.3.	Страховик має право:
<p>8.3.1.	робити запити про вiдомостi, пов’язані зі страховим випадком, до правоохоронних органів, медичних закладiв та інших установ, що можуть володіти інформацією про характер, причини та обставини страхового випадку;
<p>8.3.2.	з'ясовувати причини та обставини страхового випадку, перевіряти всі представлені йому документи. З цією метою Страховик має право призначити незалежних експертів, направити Страхувальника/Застраховану особу для проходження медичного огляду до вказаного Страховиком медичного закладу або лікаря;
<p>8.3.3.	у разі отримання інформації про обставини, які стали причиною збільшення страхового ризику, вимагати зміни умов Договору страхування або сплати додаткового страхового платежу відповідно до збільшення ризику;
<p>8.3.4.	у випадку, якщо Страхувальник/Застрахована особа не повідомив Страховика про значні зміни в обставинах, вказаних при укладенні Договору страхування, останній має право вимагати дострокового припинення дії Договору страхування;
<p>8.3.5.	у випадку появи сумнівів щодо визнання події страховим випадком направити запити до компетентних органів (включаючи судові інстанції) та відкласти прийняття рішення про виплату (або відмову у виплаті) або здійснення страхової виплати до отримання необхідних документів від цих компетентних органів (але у будь-якому випадку термін відстрочки не може перевищувати 3-х місяців), повідомивши про це Страхувальника/Застраховану особу або Вигодонабувача у письмовій формі;
<p>8.3.6.	у разі, якщо з’ясується, що дії Страхувальника/Застрахованої особи або Вигодонабувача (Спадкоємця), які призвели до настання страхового випадку, мали протиправний характер, Страховик має право вимагати дострокового припинення дії Договору страхування та повернення фактично здійснених страхових виплат, до яких призвели ці дії;
<p>8.3.7.	відмовити у виплаті згідно з розділом 7 даного Договору страхування.
<p>8.4.	Страховик зобов’язаний:
<p>8.4.1.	ознайомити Страхувальника та Вигодонабувача з умовами та Правилами страхування;
<p>8.4.2.	при настанні страхового випадку здійснити страхову виплату у передбачений Договором страхування строк. За несвоєчасну сплату страхової виплати Страховик несе відповідальність шляхом сплати пені у розмірі 0,01% відповідної суми за кожен день прострочення, але не більше ніж подвійна облікова ставка НБУ, яка діяла на момент прострочення платежу;
<p>8.4.3.	тримати в таємниці відомості про Страхувальника та його майновий стан за винятком випадків, передбачених законодавством України.
<p>* У разі смерті Страхувальника/Застрахованої особи  – фізичної особи, який уклав Договір страхування на користь третіх осіб, його права і обов’язки можуть перейти як до цих осіб, так і до осіб, на яких відповідно до чинного законодавства покладено обов’язки щодо охорони прав і законних інтересів Застрахованих осіб. У разі визнання судом Страхувальника/Застраховану особу –фізичну особу недієздатним його права і обов’язки за Договором страхування переходять до його опікуна.
<p>8.4.4.	За невиконання або неналежне виконання умов Договору страхування Сторони несуть відповідальність згідно з Правилами ТДВ "Експрес Страхування" добровільного страхування від нещасних випадків від 13 жовтня 2008 р., зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р., і чинним законодавством України.
<h2>9.	ПОРЯДОК   ЗМІНИ  ТА  ПРИПИНЕННЯ  ДІЇ  ДОГОВОРУ СТРАХУВАННЯ</h2>
<p>9.1.	Дія Договору страхування припиняє та втрачає чинність за згодою сторін, а також у разі:
<p>9.1.1.	закінчення строку дії;
<p>9.1.2.	виконання Страховиком зобов’язань перед Страхувальником/Застрахованою особою у повному обсязі;
<p>9.1.3.	несплати Страхувальником страхових платежів у встановлені Договором строки;
<p>9.1.4.	ліквідації  Страхувальника – юридичної особи або смерті Страхувальника – громадянина чи втрати ним дієздатності, за винятком випадків, передбачених Законом України „Про страхування”;
<p>9.1.5.	ліквідації Страховика у порядку, встановленому законодавством України;
<p>9.1.6.	прийняття судового рішення про визначення Договору страхування недійсним;
<p>9.1.7.	в інших випадках, передбачених законодавством України.
<p>9.2.	Дію Договору страхування може бути достроково припинено за вимогою Страхувальника або Страховика та при письмовій згоді на таке Вигодонабувача. Про намір достроково припинити дію Договору страхування будь-яка сторона зобов’язана повідомити іншу не пізніше, як за 30 календарних днів до дати припинення дії Договору страхування.
<p>9.3.	У разі дострокового припинення дії Договору страхування за вимогою Страхувальника/Застрахованої особи  Страховик повертає йому страхові платежі за період, що залишився до закінчення дії Договору страхування, з відрахуванням нормативних витрат на ведення справи,  визначених при розрахунку страхового тарифу (30%), фактичних виплат страхових сум, що були здійснені за цим Договором страхування. Якщо вимога Страхувальника обумовлена порушенням Страховиком умов Договору страхування, то останній повертає Страхувальнику сплачені ним страхові платежі повністю.
<p>9.4.	У разі дострокового припинення Договору страхування за вимогою Страховика Страхувальнику повертаються повністю сплачені ним страхові платежі. Якщо вимога Страховика обумовлена невиконанням Страхувальником/Застрахованою особою умов Договору страхування, то Страховик повертає йому страхові платежі за період, що залишився до закінчення дії Договору страхування, з відрахуванням нормативних витрат на ведення справи, визначених при розрахунку страхового тарифу (30%), фактичних виплат страхових сум, що були здійснені за цим Договором страхування.
<p>9.5.	Зміни до Договору страхування оформлюються за взаємною згодою сторін у вигляді додаткових угод, щоз моменту їх підписання Сторнами стають невідємними частинами  даного Договору страхування.
<h2>10.	ПОРЯДОК  РОЗГЛЯДУ  СУПЕРЕЧОК</h2>
<p>10.1.	Суперечки по даному Договору страхування вирішуються шляхом переговорів або в судовому порядку у відповідності до діючого законодавства України.
<p>10.2.	На підставі Закону України „Про захист персональних даних” від 01.06.2010 року № 2297-VI, Страхувальник (або особа, стосовно якої здійснюється обробка її персональних даних) надає свою безстрокову згоду Страховику на обробку та використання його персональних даних, зазначених у цьому Договорі та будь-яких інших документах, що надаються або будуть отримані для укладання, зміни, розірвання або виконання Договору, в тому числі, - паспортних даних, ідентифікаційного номеру, даних щодо місця роботи, місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються Страхувальником добровільно з метою реалізації мети обробки. Метою обробки та використання персональних даних Страхувальника є: забезпечення укладання, зміни, розірвання або виконання Договору, реалізації інших відносин у сфері страхування, адміністративно-правових відносин, податкових відносин, відносин у сфері бухгалтерського обліку, відносин у сфері обліку та звітності.
<p>10.3.	Одночасно, підписуючи даний Договір, Страхувальник дає згоду на отримання ним звернень (повідомлень, звітів, запитів тощо) від Страховика засобами SMS – розсилок, поштового зв’язку, електронною поштою, телефоном та/або факсимільним зв’язком.
<p>10.4.	У випадку зміни будь-якої адреси, чи номеру телефону, Страхувальник зобов’язується протягом 10 (десяти)  робочих днів повідомити Страховика.
<p>10.5.	Підписавши даний Договір, Страхувальник підтверджує, що  повідомлений у письмовій формі про включення його даних до бази персональних даних, про його права, визначені Законом «Про захист персональних даних», мету збору і обробки даних та осіб, яким передаються його персональні дані.
<p>10.6.	Згода Страхувальника на обробку його персональних даних, надана ним шляхом підписання даного Договору, не вимагає здійснення письмових повідомлень про зміну чи знищення персональних даних або обмеження доступу до них, передачу персональних даних третім  особам.
<p>10.7.	Ця згода діє протягом невизначеного строку та не припиняється у зв’язку з закінченням дії цього Договору. Пред’явлення  вмотивованої вимоги щодо зміни або знищення персональних даних Страхувальника можливе, якщо ці дані обробляються незаконно чи є недостовірними.

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
			<td colspan=2 class="bottom">&nbsp;</td>
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
		{if $values.agencies_id==1469 || $values.agencies_id==1496 || $values.agencies_id==1497 || $values.agencies_id==1498}
		<tr>
			<td colspan=2 class="bottom">
			{if $values.rid == 1469}в особі ФО-П «Поліщука Михайла Олександровича»,<br>
			м. Біла Церква, вул. Курсова, б. 33, кв. 22<br>
			IПН 1609508158
			{else}
			в особі  {$values.rtitle}<br>{$values.raddress}<br>р/р {$values.rbankaccount} в {$values.rbank}<br>МФО {$values.rbankmfo}, ЄДРПОУ {$values.redrpou}
			{/if}
			</td>
		</tr>{else}
		<tr><td width="50%">{$values.findirector1}</td><td class="bottom">&nbsp;</td>
		</tr>
		{/if}
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
				<td class="bottom">&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2>{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><br />
					<p>З Правилами страхування ознайомлений,</p>
					<p>з умовами Договору страхування згодний.</p>
				</td>
			</tr>
			</table>
		{else}
			<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td colspan=2 align=center><b>СТРАХУВАЛЬНИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">{$values.insurer_address}</td>
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
				<td width="50%">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
				<td class="bottom">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><br />
					<p>З Правилами страхування ознайомлений,</p>
					<p>з умовами Договору страхування згодний.</p>
				</td>
			</tr>
			</table>
		{/if}
	</td>
</tr>
</table>


<div style="page-break-after: always"></div>
<p align="center">Пам’ятка Суб’єкта персональних даних
<p>Відповідно до Закону України "Про захист персональних даних" від 1 червня 2010 року
<p>№ 2297-VI  Суб'єкт персональних даних має право: 
<p>1) знати про місцезнаходження бази персональних даних, яка містить його персональні дані, її призначення та найменування, місцезнаходження та / або місце проживання (перебування) володільця чи розпорядника персональних даних або дати відповідне доручення щодо отримання цієї інформації уповноваженим ним особам, крім випадків, встановлених законом; 
<p>2) отримувати інформацію про умови надання доступу до персональних даних, зокрема інформацію про третіх осіб, яким передаються його персональні дані; 
<p>3) на доступ до своїх персональних даних; 
<p>4) отримувати не пізніш як за тридцять календарних днів з дня надходження запиту, крім випадків, передбачених законом, відповідь про те, чи зберігаються його персональні дані у відповідній базі персональних даних, а також отримувати зміст його персональних даних, які зберігаються; 
<p>5) пред'являти вмотивовану вимогу володільцю персональних даних із запереченням проти обробки своїх персональних даних;
<p>6) пред'являти вмотивовану вимогу щодо зміни або знищення своїх персональних даних будь-яким володільцем та розпорядником персональних даних, якщо ці дані обробляються незаконно чи є недостовірними; 
<p>7) на захист своїх персональних даних від незаконної обробки та випадкової втрати, знищення, пошкодження у зв'язку з умисним приховуванням, ненаданням чи несвоєчасним їх наданням, а також на захист від надання відомостей, що є недостовірними чи ганьблять честь, гідність та ділову репутацію фізичної особи; 
<p>8) звертатися із скаргами на обробку своїх персональних даних до органів державної влади та посадових осіб, до повноважень яких належить забезпечення захисту персональних даних, або до суду;
<p>9) застосовувати засоби правового захисту в разі порушення законодавства про захист персональних даних; 
<p>10) вносити застереження стосовно обмеження права на обробку своїх персональних даних під час надання згоди;
<p>11) відкликати згоду на обробку персональних даних;
<p>12) знати механізм автоматичної обробки персональних даних;
<p>13) на захист від автоматизованого рішення, яке має для нього правові наслідки.
<p>
<p>Персональні дані суб’єкта можуть бути передані органам  державної влади (в тому числі органам державної податкової служби, Державній комісії з регулювання ринків фінансових послуг України) та місцевого самоврядування на їх вмотивовану законну вимогу.
{include file = '../files/ProductDocuments/finmonitoring.tpl'}
</body>
</html>