<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Заява на продовження лікування, ДМС</title>
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
			<p>Головному лікарю</p>
			<p>ДУ НАМН України</p>
			<p>Герасименко С.І.</p>
		</b>
	</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 30px 0 30px 0;">
<tr>
	<td width="60%">
		&nbsp;
	</td>
	<td width="40%" align="right" class="large">
		<table width="100%">
			<tr>
				<td>{$values.insurer5}</td>
			</tr>
			<tr>
				<td>Адреса реєстрації: {$values.insurer_address}</td>
			</tr>
			<tr>
				<td>Паспорт Серія {$values.insurer_passport_series} № {$values.insurer_passport_number} </td>
			</tr>
			<tr>
				<td>Страхова компанія {$values.insurance_companies_title}</td>
			</tr>
			<tr>
				<td>№ поліса {if $values.insurance_companies_id == 4} № {$values.policies_number}{else} Серія  54 – 33 – Т № 02 – {$values.policies_id}{/if}</td>
			</tr>
			<tr>
				<td>Строки дії договору з {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} по {$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</td>
			</tr>
		</table>
	</td>
</tr>
</table>

<br/><br/><br/><br/><br/>

<h1>ЗАЯВА</h1><br /><br /><br />

<p>Прошу безкоштовно(на загальних підставах) згідно ст.№49 Конституції України)  надати мені медичну допомогу ( послуги):</p>
<table width="100%">
	<tr><td class="bottom">&nbsp;</td></tr>
	<tr><td class="bottom">&nbsp;</td></tr>
	<tr><td class="bottom">&nbsp;</td></tr>
	<tr><td class="bottom">&nbsp;</td></tr>
	<tr><td class="bottom">&nbsp;</td></tr>
	<tr><td class="bottom">&nbsp;</td></tr>
</table>
<br />
<p>як жителю _____________________(міста,області) в зв’язку з тим, що послуги, які вказано вище, не підлягають оплаті згідно договору добровільного медичного страхування.</p>

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
	<tr>
		<td width="15%" class="bottom"></td>
		<td width="70%">&nbsp;</td>
		<td width="15%" class="bottom"></td>
	</tr>
	<tr>
		<td width="15%" class="small" align="center">дата</td>
		<td width="70%">&nbsp;</td>
		<td width="15%" class="small" align="center">підпис пацієнта</td>
	</tr>
</table>


</body>
</html>