<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Заява на виплату (Бланк)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td width=25%>
	<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
	</td>
	<td width=33%>
		<b>Товариство з додатковою відповідальністю<br />
		"Експрес Страхування"<br />
		01004, м. Київ, вул. Велика Васильківська 15/2.<br />
		тел.: 044-(594-87-00</b>
	</td>
	<td width=42% align="right">
		Директору ТДВ «Експрес Страхування»<br />
		Щучьєвій Т.А.<br /><br />
		{$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname}<br>
		{$values.applicant_address}<br>
		{if $values.person_types_id==1}
		назва документа {if $values.privileges==1}Посвідчення{else}Паспорт{/if} серія  {if $values.privileges==1}{$values.certificate_series}{else}{$values.insurer_passport_series}{/if} № {if $values.privileges==1}{$values.certificate_number}{else}{$values.insurer_passport_number}{/if},<br>
	    дата видачі {if $values.privileges==1}{$values.certificate_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{else}{$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.{/if}, виданий {if $values.privileges==1}{$values.certificate_place}{else}{$values.insurer_passport_place}{/if}
		{/if}
	</td>
</tr>
</table><br />
{$values.begin_datetime|date_format:'%H'}.{$values.begin_datetime|date_format:'%M'} год {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
		по 24.00 год {$values.end_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.,

<h1 align=center>Заява про страхове відшкодування</h1>

<p>У зв’язку із дорожньо-транспортною пригодою, яка сталась	{$values.datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} року 	о {$values.datetime|date_format:'%I'} год. {$values.datetime|date_format:'%M'} хв. за адресою {$values.address},
<p>прошу сплатити страхове відшкодування за шкоду, заподіяну винною у ДТП особою, відповідальність якої застраховано за полісом страхування: {$values.policies_number} від {$values.begin_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
<br><br>
<table cellpadding="5" width="100%">
<tr>
    <td width="30%">
        Чи було отримано відшкодування від винної особи
    </td>
    <td class="bottom" align="left">
        &nbsp;
    </td>
<tr>
    <tr>
        <td class="bottom" colspan="2">&nbsp;</td>
    </tr>
</table>
<br />
<p>Страхове відшкодування прошу виплатити таким чином:
<table cellpadding="5" width="50%">
<tr>
    <td align="right" width="5%">
        Отримувач:
    </td>
    <td class="bottom">
        &nbsp;
    </td>
</tr>
<tr>
    <td align="right">
        Банк:
    </td>
    <td class="bottom">
        &nbsp;
    </td>
</tr>
<tr>
    <td align="right">
        P/p
    </td>
    <td class="bottom">
        &nbsp;
    </td>
</tr>
<tr>
    <td align="right">
       ІПН(ЄДРПОУ):
    </td>
    <td class="bottom">
        &nbsp;
    </td>
</tr>
<tr>
    <td align="right">
        МФО:
    </td>
    <td class="bottom">
        &nbsp;
    </td>
</tr>
</table>

<p>До заяви додано:
{foreach name="roll" from=$values.documents key=k item=item}
{if $smarty.foreach.roll.first}<ol>{/if}
	<li>{$item}{if $smarty.foreach.roll.last}.{else};{/if}</li>
{if $smarty.foreach.roll.last}</ol>{/if}
{/foreach}
</body>
</html>