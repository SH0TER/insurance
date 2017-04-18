<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт, КАСКО+ГО+ДГО, физ. лицо</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<!-- body style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)" -->



{if $data.person_types_id==2}
<div style="page-break-after: always"></div>

<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center"><h1>АКТ виконаних послуг</h1></td>
	<td align="right">
		<p>№ {$row.agency.aktnumber}</p>
		<p>від  {$row.lastday|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
		за період з {$row.firstday} р. по {$row.lastday}р.
		<br>{if $row.city}{$row.city}{else}м. Київ{/if}
	</td>
</tr> 
</table>

		<p>

	Товариство з додатковою відповідальністю "Експрес страхування", в особі Директора <b>Щучьєвої Тетяни Андріївни</b>, що діє на підставі Статуту , далі  іменується  " Страховик ", з  однієї  сторони, та {$row.agency.title}, в особі <b>{$row.agency.director2}</b>  іменується "Агент", спільно за текстом іменуються – "Сторони", склали цей  Акт виконаних робіт про наступне:
	<p><p>

	<p>1.Виконавець надав, а Замовник прийняв та оплатив наступні послуги за Договором:
<p>1.1.	 Послуги зі сприяння в укладанні договорів страхування за {$row.aktdate}р.
<p>2.	Сума винагороди  за цим Актом складає 100.00  грн. ( Сто грн. 00 коп.), в т.ч. ПДВ – 16,67 грн.
<p>3.	Даний Акт складено у двох примірниках, які зберігаються у Сторін за вищевказаним Договором і мають однакову юридичну силу.
<p>4.	Сторони одна до одної претензій не мають.


<table width="100%">
<tr>
	<td width="50%">
		<div align="center"><b>СТРАХОВИК</b></div><br />

		ТДВ "Експрес Страхування"<br />
		01004, м. Київ, вул.. Велика Васильківська, 15/2<br />
		Р/р 265073011592 в АТ «ОЩАДБАНК»<br />
		МФО 300465, Код ЄДРПОУ 36086124<br /><br /><br />
		Директор Щучьєва Т.А.________________________
	</td>
	<td width="50%">
		<div align="center"><b>АГЕНТ</b></div><br />


		{$row.agency.title} <br />
		Адреса: {$row.agency.address}<br />
		{$row.agency.bank}<br />
		МФО {$row.agency.bank_mfo} Р/р {$row.agency.bank_account}
		<br>
		Код ЄДРПОУ:{$row.agency.edrpou} <br /><br /><br />
		{$row.agency.director1} __________________

	</td>
</tr>
</table>

{/if}









</body>
</html>