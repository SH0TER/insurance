<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Заява ДМС</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
{literal}
<style>
*, P {
	font-size: 20px;
	line-height: 20px;
	text-align:justify;
}
H1 {
	font-size: 26px;
	font-weight: bold;
	text-align: center;
}
H2 {
	font-size: 24px;
	font-weight: bold;
	text-align: center;
}
.small P, .small {
	font-size: 16px;
	line-height: 20px;
}
.large P, .large {
	font-size: 26px;
}
.very_small P, .very_small {
	font-size: 10px;
}
</style>
{/literal}	
</head>
<body>
{if $values.insurance_companies_id ==9}
	<h1>ЗАЯВА</h1>

	<h2>на медичне страхування</h2><br /><br /><br/><br/><br/>

	<p>Я, застрахована особа {$values.insured}, прошу {$values.insurance_companies_title} укласти договір добровільного медичного страхування при ушкодженні мого здоров'я з</p><br/><br/>

	<p>{$values.insurer4}</p><br/><br/>

	<p>Погоджуюсь на укладання договору<br/><br/> __________________________________________________________________(прізвище та ініціали, підпис)</p><br/><br/>

	<p> Дата заяви: {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
{else}
	<h1>ЗАЯВА</h1>

	<h2>на медичне страхування</h2><br /><br /><br/><br/><br/>

	<p>Я, {$values.insurer}, прошу {$values.insurance_companies_title} укласти договір добровільного медичного страхування при ушкодженні здоров'я</p><br/><br/>

	<p>{$values.insured2}</p><br/><br/>
	
	<p>Даю згоду на укладання стосовно себе договору страхування<br/><br/> _________________________________________(прізвище та ініціали, підпис)</p><br/><br/>

	<p> Дата заяви: {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
{/if}

</body>
</html>