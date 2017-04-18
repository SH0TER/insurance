<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Лист для гарантії своєчасного ремонту</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="10">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="left" style="background-color: red; color: white;">
		<p>ТДВ "Експрес Страхування"</p>
        <p>01004, Україна, Київ</p>
        <p>вул. Велика Васильківська, 15/2</p>
        <p>Телефон: +38(044)591 16 01</p>
        <p>Факс: +38(044)591 16 02</p>
	</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 50px 0 100px 0;">
<tr>
	<td width="50%" valign="top" class="small">
		<p>Вих. № {$values.accidents_number}-1 від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>
<br>
<table width="100%"cellspacing="10">
    <tr>
        <td width="30%"></td>
        <td width="30%"></td>
        <td align="right"><b>Директору {$values.car_services_title}</b></td>
    </tr>
    <tr>
        <td width="30%"></td>
        <td width="30%" align="center"><h1>КОПІЯ:</h1></td>
        <td align="right"><b>Заступнику директору по сервісу та запасним частинам {$values.car_services_title}</b></td>
    </tr>
</table>

<br><br><h1>Шановні партнери!</h1><br><br>

<p style="text-indent: 2em; text-align:justify;">Інформуємо, що ТДВ «Експрес Страхування» планується здійснення страхового відшкодування за пошкоджений автомобіль {$values.policies_brand}/{$values.policies_model} державний номер {$values.policies_sign}.
Рахунок-фактура СТО додається.</p>
<p style="text-indent: 2em; text-align:justify;">Враховуючи викладене, просимо Вас повідомити чи має СТО можливість після перерахування страхового відшкодування здійснити відновлювальний ремонт в строки,
відповідно до затверджених план-класів ({$values.term} днів).</p>
<p style="text-indent: 2em; text-align:justify;">Відповідь просимо надати протягом 3-х годин з моменту відправлення даного листа. Ненадання відповіді у вказаний термін означатиме відмову у здійсненні відновлювального ремонту відповідно
до затверджених план-класів, за даним випадком.</p>

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
<tr>
	<td width="30%" align="left">
		<b>З повагою,<br />
		Директор ТДВ «Експрес Страхування»</b>
	</td>
    <td width="40%" align="center"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sign.gif" height="40" width="120"/></td>
	<td width="30%" align="right"><b>Скрипник О.О.</b></td>
</tr>
</table>
</body>
</html>