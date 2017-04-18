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
	<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	<td align="right" class="large">
		<b>
			<p style="line-height: 2">"ЗАТВЕРДЖУЮ"</p>
			<p style="line-height: 2">Головний лікар</p>
			<p style="line-height: 2">ДУ ІТО НАМНУ</p>
			<p style="line-height: 2">___________ С.І. Герасименко</p>
			<p style="line-height: 2">"_____" ______________ 2015р.</p>
		</b>
	</td>
</tr>
</table>

<br/><br/><br/><br/><br/>

<h1>Калькуляція хворого</h1>
<p style="text-decoration: underline; text-align: center; line-height: 2">{$policy.insured}</p>
<p style="text-decoration: underline; text-align: center; line-height: 2">Договір: {$policy.policiesNumber}</p><br /><br /><br />

<h1 style="font-style: italic; text-decoration: underline;">Клініка: {$calculation.clinik}</h1><br /><br /><br />
<p style="font-style: italic; text-decoration: underline; font-weight: bold;">Діагноз:</><br />
<p style="line-height: 2">{$calculation.diagnos}</p><br /><br /><br />

<p style="font-style: italic; text-decoration: underline; font-weight: bold;">Проведено:</><br /><br /><br />

{assign var="total" value=0}
<table cellpadding=5 cellspacing=0 width="100%">
	{section name=position loop=$calculation.positions}
		<tr>
			<td width="20px" class="left top right" align="center">{$calculation.positions[position].num}</td>
			<td width="750px" class="top right">{$calculation.positions[position].name}</td>
			<td class="top right" align="center">{$calculation.positions[position].count}</td>
			<td class="top right" align="center">{$calculation.positions[position].amount|moneyformat:-1}</td>
			<td class="top right" align="center">грн.</td>
		</tr>
		{assign var="total" value="`$total+$calculation.positions[position].amount`"}
	{/section}
	<tr>
		<td width="20px" class="left top right bottom">&nbsp;</td>
		<td width="750px" class="top right bottom"><b>Всього:</b></td>
		<td class="top right bottom" align="center">&nbsp;</td>
		<td class="top right bottom" align="center"><b>{$total|moneyformat:-1}</b></td>
		<td class="top right bottom" align="center"><b>грн.</b></td>
	</tr>	
</table>
<br/><br/><br/><br/><br/>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
	<tr>
		<td width="20%">
			<b>
			<p>Заступник директора з</p> 
			<p>економічних питань</p></td>
			</b>
		<td width="65%">&nbsp;</td>
		<td width="15%">
			<b>
			<p>Матюшина Л.Є.</p> 
			</b>
		</td>
	</tr>
</table>


</body>
</html>