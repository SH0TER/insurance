<html>
<head>
	<title>Certificate. Bill</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	{literal}
	<style type="text/css">
		* {
			font-size: 19px;
			font-family: Arial, Geneva, Helvetica, sans-serif;
		}
		TH {
			background-color: #eeeeee;
		}
	</style>
	{/literal}
</head>
<body {if $values.payed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/payed.gif)"{/if}>
<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td width=50>&nbsp;</td>
    <td>
        <b>Страховик:</b><br />
        ТДВ «ЕКСПРЕС СТРАХУВАННЯ»<br />
        <!--Р/р 26507620526463 в ПАТ "Промінвестбанк"
        МФО 300012, ЄДРПОУ 36086124-->
		Р/р 265073011592  в АТ "ОЩАДБАНК"
        МФО 300465, ЄДРПОУ 36086124
		<br />
        Страхова компанія є платником податку на прибуток згідно умов п.7.2. статті 7 Закону України "Про оподаткування прибутку підприємств"<br />
        Тел: (044) 594 87 00; факс: (044) 594 87 02
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td colspan="2">
        <b>Страхувальник:</b><br />
        {$values.insurer}<br /><br />
        Платник: той же
    </td>
</tr>
</table>

<table width=100% cellpadding=5 cellspacing=0>
<tr>
	<td align=center>
        <b>РАХУНОК-ФАКТУРА</b><br /><br />
        №&nbsp; {$values.bill_number}<br />
        від {$values.bill_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.<br /><br />
    </td>
</tr>
</table>

<table width="100%" cellpadding=3 cellspacing=0>
<tr>
    <th class="all">Призначення платежу</th>
    <th class="top right bottom">Сума до перерахування, грн.</th>
</tr>
<tr>
    <td class="right bottom left">Страховий платіж згідно страхового сертифiкату №&nbsp; {$values.number} від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
    <td class="right bottom" align=right>{$values.amount|moneyformat:-1}</td>
</tr>
<tr>
    <td class="right bottom" align=right ><b>Разом:</b></td>
    <td class="right bottom" align=right><b>{$values.amount|moneyformat:-1}</b></td>
</tr>
</table><br /><br />
<b>Всього:</b> (ПДВ зі страхових премій не стягується): {$values.amount|moneyformat:1:true}<br /><br /><br /><br />

________________/________
</body>
</html>