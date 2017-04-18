<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
{literal}
<style>
*, P {
	font-size: 18px;
	line-height: 24px;
}
H1 {
	font-size: 20px;
	font-weight: bold;
	text-align: center;
	margin: 0px;
}
H2 {
	margin-top: 0px;
	font-size: 18px;
	font-weight: bold;
	text-align: center;
}
.small P {
	font-size: 18px;
	line-height: 20px;
}
.large P {
	font-size: 20px;
}
</style>
{/literal}
</head>
<body>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 50px 0 100px 0;">
<tr>
	<td width="50%" valign="top" class="small">
		<p>Вих. № __________________________________</p><br />
		<p>від "____" __________ ______ р.</p>
	</td>
</tr>
</table>

<p align="left"><b>Шановний (-а), {$values.insurer}!</b></p>
<br/>
<p style="text-indent: 2em; text-align: justify;">Товариство з додатковою відповідальністю «Експрес Страхування» щиро вдячне Вам за вибір нашої Компанії при страхуванні Вашого автомобіля.</p>
<br/>
<p style="text-indent: 2em; text-align: justify;">Між Вами та ТДВ «Експрес Страхування» {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. укладено Договір №{$values.policies_number} добровільного страхування  наземних транспортних засобів (далі – Договір страхування).</p>
<br/>
<p style="text-indent: 2em; text-align: justify;">Дозвольте нагадати, що умовами Договору страхування передбачено, що, в разі, настання страхового випадку Страховик здійснює виплату пропорційно співвідношенню страхової суми до дійсної вартості ТЗ.</p>
<br/>
<p style="text-indent: 2em; text-align: justify;">У зв’язку з цим інформуємо Вас, що станом на «{$values.nowday}» {$monthes[$values.nowmonth]} {$values.nowyear} р. дійсна вартість Вашого транспортного засобу складає {$values.market_price} грн.</p>
<br/>

{if $values.payed_amount > 0}
	<p style="text-indent: 2em; text-align: justify;">Крім того, відповідно до умов Договору (розділи «Визначення термінів», «Страхова сума») після отримання Вами страхового відшкодування страхова сума за Договором зменшилася на суму виплати та становить {$values.item_price_other} грн.</p>
	<br/>
{/if}
<p style="text-indent: 2em; text-align: justify;">З метою уникнення негативних наслідків, а також для забезпечення повного страхового захисту Вашого автомобіля пропонуємо збільшити розмір страхової суми до дійсної вартості та сплатити додатковий страховий платіж, визначений з урахуванням страхового тарифу за Договором страхування.</p>
<br/>
<p style="text-indent: 2em; text-align: justify;"><b>Сума додаткового страхового платежу за поточний період дії Договору за збільшення розміру страхової суми за Договором страхування станом на «{$values.nowday}» {$monthes[$values.nowmonth]} {$values.nowyear} р. становить: {$values.diff_amount} грн. ({$values.diff_amount|moneyformat:1:true}).</b></p>
<br/>
<p style="text-indent: 2em; text-align: justify;">У випадку Вашої згоди на збільшення розміру страхової суми, для оформлення Додаткової угоди на внесення відповідних змін до Договору страхування просимо Вас звернутися:</p>
<ul>
	<li>
		до Вашого агента: {$values.agents_lastname} {$values.agents_firstname} {$values.agents_patronymicname}
	</li>
	<li>
		до фахівців відділу з продажу компанії за тел. <b>(044) 594-87-00.</b>
	</li>
</ul>
<br/><br/>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="50%">
		З повагою,<br/>Директор
	</td>
	<td width="50%" align="right">Т.А. Щучьєва</td>
</tr>
</table>
</body>
</html>