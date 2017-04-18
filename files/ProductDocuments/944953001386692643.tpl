<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ЗАЯВА на  страхування  від  нещасних  випадків, Правекс физ лица</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<div align="right">
Додаток №1
до Договору добровільного страхування від нещасних випадків<br>
<!--№ {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.-->
</div>

<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1>ЗАЯВА</h1
		<h1>на  страхування  від  нещасних  випадків</h1>
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
<br><br>
<p><b>1. Страхувальник/Застрахована особа (ПІБ):</b> {$values.insurer_title}<br><br>
<p><b>2. Адреса реєстрації / Адреса фактичного місця проживання:</b> {$values.insurer_address}<br><br>
<p><b>3. Дата народження:</b> {$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br><br>
<p><b>4. Страхувальник/Застрахована особа бажає отримати страховий захист за наступними страховими випадками:</b> <br><br>

<table width="100%" cellspacing="0" cellpadding="5">
<tr>
<td class="all"><b>4.1. Смерть</b> Страхувальника/Застрахованої особи внаслідок нещасного випадку</td>
</tr>
<tr>
<td class="left right bottom"><b>4.2. Встановлення І групи інвалідності</b> Страхувальнику/Застрахованій особі внаслідок нещасного випадку </td>
</tr>
</table><br /><br><br>

<p><b>5. Страхова сума, грн.: {$values.price|moneyformat:-1}</b> <br><br>
<p><b>6. Бажаний строк дії Договору страхування:</b>  з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. по {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br><br>
<p><b>7. Територія дії Договору страхування: </b> Україна<br><br>
<p><b>8. Час дії Договору страхування в межах проміжку доби:</b> цілодобово<br><br>
<p><b>9. Існуючі Договори страхування від нещасних випадків:  </b> 
{section name="roll" loop=$values.agreements}
<b>Так</b>
{sectionelse}
<b>Ні</b>
{/section}<br><br>
<p><b>10. Договір страхування прошу укласти на користь Вигодонабувача:</b>  згідно з законодавством України.<br><br>
<p><b>Декларація Страхувальника:</b>
<p>Я заявляю, що ознайомлений з умовами та Правилами ТДВ «ЕКСПРЕС СТРАХУВАННЯ» добровільного страхування від нещасних випадків, зареєстрованих Державною комісією з регулювання ринків фінансових послуг України  23 жовтня 2008 р., із змінами та доповненнями. Всі приведені вище твердження і свідчення є правдивими і ніяка інформація щодо предмету Договору страхування не була прихована. Я згоден з тим, що ця Заява, підписана мною чи за моїм дорученням, стане основою Договору страхування і буде його невід’ємною частиною.
<p>Я проінформований про те, що заповнення даної Заяви ніяким чином не зобов'язує мене вступати в правовідносини зі Страховиком, а Страховика зі мною, а також про те, що у випадку, якщо інформація про предмет Договору страхування, надана в цій Заяві, є неправдивою, Страховик має право відмовити у виплаті страхового відшкодування.                                                                                                                       
<br><br>
<p>Інформація, щодо: 
<ul>
<li> страхової послуги, вартості цієї послуги для мене;
<li> умов надання додаткових страхових послуг та їх вартість;
<li> порядку сплати податків і зборів за мій рахунок в результаті отримання страхової послуги;
<li> правових наслідків та порядку здійснення розрахунків зі мною внаслідок дострокового припинення Договору страхування;
<li> механізму захисту Страховиком прав споживачів та порядку урегулювання спірних питань, що виникають у процесі надання послуги зі страхування;
<li> реквізитів органу, який здійснює державне регулювання ринків фінансових послуг (адреса, номер телефону тощо), а також реквізитів органів з питань захисту прав споживачів;
<li> розміру винагороди фінансової установи у разі, коли вона пропонує страхові послуги, що надаються іншими фінансовими установами,<br>
надана мені  до укладання Договору страхування та мені зрозуміла. 
</ul>

 

 
<br><br>
 
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" align="left">Заяву заповнив&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="30%" class="bottom">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	<td width="7%" align="center">&nbsp;/&nbsp;</td>
	<td width="10%" class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="20%" >&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom"><!--{if $values.ground_kasko}{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}{else}Скрипник О.О.{/if}-->{$values.director1}</td>
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>&nbsp;</td>
</tr>
{if $values.agencies_id != 1469 && $values.agencies_id != 1496 && $values.agencies_id != 1497 && $values.agencies_id != 1498}
		<tr>
			<td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td class="bottom">{$values.findirector1}</td>
			<td align="center">&nbsp;/&nbsp;</td>
			<td class="bottom">&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
{else}{/if}
</table>
</body>
</html>