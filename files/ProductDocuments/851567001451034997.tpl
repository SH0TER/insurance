<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ЗАЯВА на  страхування  від  нещасних  випадків, на транспорте</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1>ЗАЯВА</h1
		<h1>на добровільне страхування від нещасних випадків<br> на транспорті</h1>
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
<br />
<br />
<br />
<p><b>1. Заявник/Страхувальник</b>
<table width="100%" cellspacing="0" cellpadding="5" border=1>
<tr>
	<td>ПІБ</td>
	<td>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</td>
</tr>
<tr>
	<td>Паспорт</td>
	<td>серія, № {$values.insurer_passport_series} {$values.insurer_passport_number} від {$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} виданий {$values.insurer_passport_place}</td>
</tr>
<tr>
	<td>ІПН</td>
	<td> {$values.insurer_identification_code}</td>
</tr>
<tr>
	<td>Адреса реєстрації</td>
	<td> {$values.insurer_address}</td>
</tr>

<tr>
	<td>Фактична адреса</td>
	<td> {$values.insurer_address}</td>
</tr>

<tr>
	<td>Телефон</td>
	<td> {$values.insurer_phone}</td>
</tr>


<tr>
	<td>E-mail</td>
	<td> {$values.insurer_email}</td>
</tr>

</table><br />


<p>Прошу укласти Договір добровільного страхування від нещасних випадків на транспорті згідно з Правилами добровільного страхування від нещасних випадків ТДВ «Експрес Страхування» на наступних умовах:

<p><b>2. Умови страхування</b>


<table width="100%" cellspacing="0" cellpadding="5" border=1>
<tr>
<td rowspan=6 width="33%">
<b>Застрахована особа</b>
</td>
<td  width="20%">ПІБ</td>
<td>{$values.insured_lastname} {$values.insured_firstname} {$values.insured_patronymicname}</td>
</tr>

<tr>
<td>Адреса</td>
<td>{$values.insured_address}</td>
</tr>

<tr>
<td>Дата народження</td>
<td>{$values.insured_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>


<tr>
<td>ІПН</td>
<td>{$values.insured_identification_code}</td>
</tr>


<tr>
<td>Паспорт</td>
<td>серія, № {$values.insured_passport_series} {$values.insured_passport_number} від {$values.insured_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} виданий {$values.insured_passport_place}</td>
</tr>

<tr>
<td>Телефон</td>
<td>{$values.insured_phone}</td>
</tr>





<tr>
<td rowspan=4>
<b>Вигодонабувач</b>
</td>
<td>ПІБ/Назва</td>
<td>{if $values.assured_title}{$values.assured_title}{else}Згідно з Законодавством України{/if}</td>
</tr>

<tr>
<td>Адреса</td>
<td>{if $values.assured_title}{$values.assured_address}{/if}</td>
</tr>

<tr>
<td>ІНПП/ЄДРПОУ</td>
<td>{if $values.assured_title}{$values.assured_identification_code}{/if}</td>
</tr>

<tr>
<td>Телефон</td>
<td>{if $values.assured_title}{$values.assured_phone}{/if}</td>
</tr>





<tr>
<td rowspan=4>
<b>Страхові ризики </b>
</td>
<td colspan=2>Наступні події, що мають ознаки ймовірності та випадковості настання та сталися із Застрахованою особою під час дії Договору страхування внаслідок нещасного випадку на транспорті:</td>
</tr>

<tr>
<td><b>Смерть</b></td>
<td> {if $values.ns_death == 1}ТАК{else}НI{/if}</td>
</tr>

<tr>
<td><b>Встановлення І групи інвалідності</b></td>
<td> {if $values.invalid1 == 1}ТАК{else}НI{/if}</td>
</tr>

<tr>
<td><b>Встановлення ІІ групи інвалідності</b></td>
<td> {if $values.invalid2 == 1}ТАК{else}НI{/if}</td>
</tr>


<tr>
<td >
<b>Час дії Договору в межах проміжку доби </b>
</td>
<td colspan=2>Під час знаходження будь-якому засобі наземного транспорту, крім залізничного, а саме: автомобіль, автобус, самохідна машина, що сконструйована на шасі автомобілів, причеп, напівпричіп, трактор, комбайн, сільськогосподарська та дорожня машина тощо, що зареєстровані відповідно до законодавства України або країни, на території якої сталася подія, що може буди визнана страховою.</td>
</tr>

 


<tr>
<td> <b>Страхова сума</b> </td>
<td colspan=2>{$values.price|moneyformat:-1} грн.</td>
</tr>



<tr>
<td> <b>Територія дії Договору</b> </td>
<td colspan=2>Весь світ (крім зон воєнних дій, конфліктів та прирівняних до них)</td>
</tr>



<tr>
<td> <b>Бажаний строк дії договору страхування</b> </td>
<td colspan=2>	з 00.00 год {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. 
		по 24.00 год {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. включно</td>
</tr>


<tr>
<td> <b>Історія збитків</b> (зазначте, чи мали місце за останні 3 роки нещасні випадки на транспорті на Вашому автотранспортному засобі?)   </td>
<td colspan=2>{if $values.info1}{$values.info1}{else}НI{/if}</td>
</tr>



<tr>
<td> <b>Наявність інших чинних договорів страхування щодо предмета договору</b> </td>
<td colspan=2>{if $values.info1}{$values.info2}{else}НI{/if}</td>
</tr>
 

</table>
<br><br>
<p>Інша інформація, яка впливає на ступінь ризику, може бути дописана від руки і буде невід’ємною частиною цієї Заяви. 

<br><br><br>
<p><b>Декларація Страхувальника:</b>

<p>Я заявляю, що ознайомлений з умовами та Правилами ТДВ «ЕКСПРЕС СТРАХУВАННЯ» добровільного страхування від нещасних випадків, зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р., із змінами та доповненнями. Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору страхування і буде його невід’ємною частиною.
<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.                                                                                                                       
<br><br>
<p>Інформація, щодо: 
<ul>
<li>  страхової послуги, вартості цієї послуги для мене;
<li> умов надання додаткових страхових послуг та їх вартість;
<li> порядку сплати податків і зборів за мій рахунок в результаті отримання страхової послуги;
<li> правових наслідків та порядку здійснення розрахунків зі мною внаслідок дострокового припинення Договору страхування;
<li> механізму захисту Страховиком прав споживачів та порядку урегулювання спірних питань, що виникають у процесі надання послуги зі страхування;
<li>  реквізитів органу, який здійснює державне регулювання ринків фінансових послуг (адреса, номер телефону тощо), а також реквізитів органів з питань захисту прав споживачів;
<li> розміру винагороди фінансової установи у разі, коли вона пропонує страхові послуги, що надаються іншими фінансовими установами,
надана мені  до укладання Договору страхування та мені зрозуміла.
</ul>


<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" align="right">Заяву заповнив&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="30%" class="bottom">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	<td width="7%" align="center">&nbsp;/&nbsp;</td>
	<td width="10%" class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="20%" >&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}Директор Щучьєва Т.А.{/if}</td>
	<!--{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}-->
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
</body>
</html>