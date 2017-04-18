<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Письмо столичное автошоу</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body >

{literal}
<style>
.letter {
	font-size: 20px;
	text-align : justify;
}

.letterbold {
	font-size: 22px;
	text-align : justify;
	font-weight :bold;
}

.letter1 {
	font-size: 20px;

}
.lsmall {
	font-size: 13px;
	font-weight :bold;

}
</style>
{/literal}
<br><br>
<br><br><br><br>
<br>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="30%">
            <br/><br/>
            <br/><br/>
            <p style="font-size: 14px;">
                Вих. № _____________________ <br/><br/>
                від __________________ {$smarty.now|date_format:"%Y"}р.
		    </p>
        </td>
        <td width="40%">
        </td>
        <td width="30%" valign="top" align="right">
            
        </td>
    </tr>
</table>
<br/><br/><br/>		<br/><br/><br/><br/><br/><br/>
<div style="width: 1000px;padding-left:50px">


<!-- письмо на акционные условия-->

<p align="center" > <b class="letter1">Шановний(а) {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}!</b> </p>
<br><br><br><br>
<p><br>
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;СК «Експрес Страхування» щиро вдячна Вам за те, що турботу про захист Вашого автомобіля Ви довірили саме нашій компанії. Маємо честь запросити Вас та Вашу родину на святкування десятої річниці проведення головної автомобільної події - «Столичне Автошоу», яке відбудеться 14 та 15 вересня 2013 року за адресою м. Київ, Столичне шосе, 90.
<p><br>
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ми завжди піклуємося про наших клієнтів та нагадуємо, що  {$values.original.second_year.lastdate|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. закінчується дія страхового захисту за Вашим договором страхування.</b>: 
<br><bR>
<p class="letterbold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;З нагоди святкування 10-ї річниці «Столичного Автошоу»,  пропонуємо скористатися  Вам найкращими умовами придбання полісу КАСКО на наступний рік*:</b> 
<br><bR>
<table cellpadding="5" cellspacing="0" width="100%">
<tr  align="center">
	<td class="all letter1" width="20%">Марка авто</td>
	<td class="right top bottom letter1" width="20%">Модель авто</td>
	<td class="right top bottom letter1" width="20%">Вартість авто</td>
	<td class="right top bottom letter1" width="15%">Тариф, %</td>
	<td class="right top bottom letter1"  width="10%">Знижка, %</td>
	<td class="right top bottom letter1"  width="15%">Страховий платіж*, грн.</td>
</tr>
<tr>
	<td class="left right bottom letter1">{$values.brand}</td>
	<td class="right bottom letter1">{$values.model}</td>
	<td class="right bottom letter1" align="center">{$values.original.second_year.item_price|moneyformat:-1}</td>
	<td class="right bottom letter1" align="center">{$values.original.second_year.rate_kasko|moneyformat:-1}</td>
	<td class="right bottom letter1" align="center">{$values.original.second_year.discount|moneyformat:-1}</td>
	<td class="right bottom letter1" align="center">{$values.original.second_year.amount_kasko|moneyformat:-1}</td>
</tr>
</table>
<p class="lsmall"> *пропозиція дійсна лише протягом двох днів на час проведення Автошоу: 14-15 вересня 2013 року, з 10.00 до 19.00. </p>
<br><bR>
<p><br>
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Щоб скористатися спеціальними умовами страхування, Вам необхідно звернутися до представника ТДВ «Експрес Страхування» біля стенду компанії в Автосалоні на Столичному (у торговому залі брендів Chevrolet та Opel). Детальна інформація за номером телефону 0&nbsp;800&nbsp;502&nbsp;300 (дзвінки зі стаціонарних телефонів в межах України безкоштовні).
<p><br>
<p class="letter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;«Столичне Автошоу» - це завжди вдале місце та час для придбання нового авто, а також можливість скористатися найкращими умовами страхування та кредитування. Ви не лише першими дізнаєтесь про головні автомобільні новинки року, а й зможете насолодитися цікавим та захоплюючим дійством.
<p><br><p><br><p><br><p><br>
<div align="center"><b class="letter1">Будемо раді вітати Вас та Вашу родину на Столичному Автошоу 2013!</div>
<div align="center"><b class="letter1">На Вас чекають приємні сюрпризи!</div>
<br><br><p><br><p><br><br><br><p><br><p><br>
<table width="100%">
<tr>
<td width="80%"><p  class="letter"><b class="letter">З повагою, <br>Директор ТДВ «Експрес Страхування»</b></td>
<td width="20%"><b class="letter"><br>Щучьєва Т.А.</b></td>
</tr>
</table>
 

 
 
</body>
</html>