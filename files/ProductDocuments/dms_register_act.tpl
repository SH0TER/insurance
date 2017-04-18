<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Калькуляція, ДМС</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="74%" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	<td align="left" class="large">
		<b>
			<p style="line-height: 2">"ЗАТВЕРДЖУЮ"</p>
			<p style="line-height: 2">Заступник директора</p> 
			<p style="line-height: 2">ТДВ "Експрес Страхування"</p>
			<p style="line-height: 2">Залуцький С.В.</p>
			<p style="line-height: 2">"_____" ______________ 20____ р.</p>
		</b>
	</td>
</tr>
</table>

<br/><br/><br/><br/><br/>

<p class="large"><b>СТРАХОВИЙ  АКТ-РЕЄСТР № 1011-{$registerAct.date}</b></p>
<p>Нами, представниками Страховика , на основі представлених  документів складений страховий акт-реєстр страхових випадків по добровільному медичному страхуванню:</p>
<br/>
<p class="large"><b>1. ВХІДНІ ДАНІ:</b></p>
<table>
	<tr>
		<td width="45%"><b>Програма страхування</b></td>
		<td>Добровільне медичне страхування (безперервне страхування здоров"я)</td>
	</tr>
	<tr>
		<td><b>Місце виникнення страхових випадків</b></td>
		<td>Київ</td>
	</tr>
</table>
<br/>
<p class="large"><b>2. ДОСЛІДЖЕННЯ:</b></p>

{assign var="total" value=0}
{assign var="counter" value=0}
<table cellpadding=5 cellspacing=0 width="100%">
	<tr style="text-align: center; font-weight: bold;">
		<td width="20px" class="left top right" align="center">№</td>
		<td width="350px" class="top right">П.І.Б.</td>
		<td class="top right">Договір страхування</td>
		<td class="top right">Термін дії договору страхування</td>
		<td class="top right">Страхова сума за договором</td>
		<td class="top right">Термін виникнення страхового випадку</td>
		<td class="top right">Розмір виплати (грн.)</td>
	</tr>
	{section name=index loop=$calculations}
		{assign var="counter" value="`$counter+1`"}
		<tr>
			<td width="20px" class="left top right" align="center">{$counter}</td>
			<td width="350px" class="top right">{$calculations[index].insured}</td>
			<td class="top right">{$calculations[index].policiesNumber}</td>
			<td class="top right" align="center" nowrap>{$calculations[index].policiesBeginDate} - {$calculations[index].policiesEndDate}</td>
			<td class="top right" align="right">{$calculations[index].insurancePrice|moneyformat:-1}</td>
			<td class="top right" align="center">{$calculations[index].calculationDate}</td>
			<td class="top right" align="right">{$calculations[index].calculationAmount|moneyformat:-1}</td>
		</tr>
		{assign var="total" value="`$total+$calculations[index].calculationAmount`"}
	{/section}
	<tr>
		<td colspan="4" class="top">&nbsp;</td>
		<td colspan="2" class="top"><b>Загальна сума:</b></td>
		<td class="top" align="right"><b>{$total|moneyformat:-1}</b></td>
	</tr>	
</table>
<p class="large"><b>3. ВИСНОВОК</b></p>
<table width="100%" cellspacing=0>
	<tr>
		<td width="55%"><b>Загальна сума заподіяних збитків (грн.)</b></td>
		<td>{$total|moneyformat} ({$total|moneyformat:1:true})</td>
	</tr>
	<tr>
		<td><b>Вказані події є страховими (так , чи ні; якщо ні вказати причину).</b></td>
		<td>Так</td>
	</tr>
	<tr>
		<td width="50%"><b>Загальна сума страхового відшкодування, що підлягає виплати становить:</b></td>
		<td>{$total|moneyformat} ({$total|moneyformat:1:true})</td>
	</tr>
	<tr>
		<td style="vertical-align: top;"><b>Перелік документів на підставі яких був складений страховий акт</b></td>
		<td>&nbsp;</td>		
	</tr>
	<tr>
		<td colspan="2" class="right top left bottom">1. Відповідні договори ДМС</td>
	</tr>
	<tr>
		<td colspan="2"  class="right left bottom">2. Договір з ДУ "Інститут травматології та ортопедії НАМН України" - № М- 93/15 від 28.04.15</td>
	</tr>
	<tr>
		<td colspan="2"  class="right left bottom">3. Рахунок-фактура №</td>
	</tr>
	<tr>
		<td colspan="2" class="right left bottom">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="right left bottom">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="right left bottom">4. Акт виконаних робіт №</td>
	</tr>
	<tr>
		<td colspan="2" class="right left bottom">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="right left bottom">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td><b>Можливість регресного позову</b></td>
		<td>Ні</td>
	</tr>
	<tr>
		<td><b>Вигодонабувач:</b></td>
		<td>ДУ "Інститут травматології та ортопедії НАМН України"</td>
	</tr>
</table>
<br/>
<p class="large"><b>4. РОЗПОРЯДЖЕННЯ:</b></p>
<p>
	<b>Страхове відшкодування у розмірі:</b> {$total|moneyformat} ({$total|moneyformat:1:true}) <b>виплатити</b> 
	ДУ "Інститут травматології та ортопедії НАМН України" <b>за реквізитами, відповідно до рахунку фактури № </b>
</p>

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
	<tr>
		<td width="30%">
			<b>Акт склав:</b>
		</td>
		<td width="5%">&nbsp;</td>
		<td class="bottom" width="15%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td>
			Дячук Т.В.
		</td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" class="large"><b>ПОГОДЖЕНО:</b></td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td>
			<b>Фахівець відділу обслуговування клієнтів Управління по роботі з корпоративними клієнтами</b>
		</td>
		<td width="5%">&nbsp;</td>
		<td class="bottom">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td style="vertical-align: bottom;">
			Шкоденко С.С.
		</td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td>
			<b>Начальник Управління по роботі з корпоративними клієнтами</b>
		</td>
		<td width="5%">&nbsp;</td>
		<td class="bottom">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td style="vertical-align: bottom;">
			Раєвська О. В.
		</td>
	</tr>
</table>


</body>
</html>