<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ГО. Княжа, 1-я страница</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="../css/pdf.css" rel="stylesheet" />
{literal}
<style type="text/css">
* {
	font-size: 18px;
	font-family: Courier, Arial, Geneva, Helvetica, sans-serif;
}
</style>
{/literal}
</head>
<body {if !$values.closed && false}style="background: url(../files/ProductDocuments/images/sample.gif)"{/if} style="background1: url(../files/ProductDocuments/images/go_generali_background.jpg) 0% 0% no-repeat; ">

<table cellpadding=0 cellspacing=0 style="margin-top: 120px;">
<tr>
	<td width=570 height=30>&nbsp;</td>
	<td width=85 >&nbsp;002</td>
	<td width=260 >&nbsp;</td>
	<td width=45 align=center>{$values.types_id}</td>
</tr>
</table>
<table cellpadding=0 cellspacing=0 style="margin-top: 155px;">
<tr>
	<td width=470 height=40>&nbsp;</td>
	<td>{100000|moneyformat:1:true}</td>
</tr>
<tr>
	<td height=40>&nbsp;</td>
	<td>{50000|moneyformat:1:true}</td>
</tr>
<tr>
	<td height=40>&nbsp;</td>
	<td>{if $values.deductible != '0.00'}{$values.deductible|moneyformat:1:true}{else}без франшизи{/if}</td>
</tr>
<tr>
	<td height=40>&nbsp;</td>
	<td>{$values.termsTitle}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 13px;">
<tr>
	<td width=232 height=28>&nbsp;</td>
	<td width=45>{$values.begin_datetime|date_format:'%H'}</td>
	<td width=20>&nbsp;</td>
	<td width=45>{$values.begin_datetime|date_format:'%M'}</td>
	<td width=20>&nbsp;</td>
	<td width=45>{$values.begin_datetime|date_format:'%d'}</td>
	<td width=20>&nbsp;</td>
	<td width=45>{$values.begin_datetime|date_format:'%m'}</td>
	<td width=45>&nbsp;</td>
	<td width=45>{$values.begin_datetime|date_format:'%y'}</td>
	<td width=175>&nbsp;</td>
	<td width=45>{$values.end_datetime|date_format:'%d'}</td>
	<td width=25>&nbsp;</td>
	<td width=45>{$values.end_datetime|date_format:'%m'}</td>
	<td width=35>&nbsp;</td>
	<td width=45>{$values.end_datetime|date_format:'%y'}</td>
</tr>
</table>
<!-- table border=0 cellpadding=0 cellspacing=0 style="margin-top: 48px;">
<tr>
	<td width=1000>&nbsp;</td>
	<td>{$values.insurer_zip}</td>
</tr>
</table-->
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 45px;">
<tr>
	<td width=180>&nbsp;</td>
	<td width=450>
		<table cellpadding=0 cellspacing=0>
		<tr>
			<td height=30>{$values.insurer_lastname}</td>
		</tr>
		<tr>
			<td height=32>{$values.insurer_firstname}</td>
		</tr>
		<tr>
			<td height=32>{$values.insurer_patronymicname}</td>
		</tr>
		</table>
	</td>
	<td width=35></td>
	<td width=430 valign="top">
		<table cellpadding=0 cellspacing=0>
		<tr>
			
			<td  width=40 height=30></td>
			<td  width=40 height=30  ALIGN=RIGHT >{$values.insurer_zip}</td>
		</tr>
		<tr>
			<td height=45 colspan=2>{$values.insurer_address}</td>
		</tr>
		<tr>
		<td width=5></td>
		
			<td height=25 >{if $values.insurer_phone} {$values.insurer_phone}{/if}</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 5px;">
<tr>
	<td width=173 height=28>&nbsp;</td>
	<td width=220 style="font-weight: bold;">{$values.insurer_identification_code}</td>
	<td width=520>&nbsp;</td>
	<td width=180 style="font-weight: bold;">{$values.insurer_edrpou}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 14px;">
<tr>
	<td width=220 height=28>&nbsp;</td>
	<td width=145>{$values.insurer_driver_licence_series}</td>
	<td width=70>&nbsp;</td>
	<td width=200 style="font-weight: bold;">{$values.insurer_driver_licence_number}</td>
	<td width=175>&nbsp;</td>
	<td width=90>{if $values.insurer_driver_licence_series || $values.insurer_driver_licence_number}{$values.insurer_driver_licence_date|date_format:'%Y'}{else}&nbsp;{/if}</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 40px;">
<tr>
	<td width=170 height=28>&nbsp;</td>
	<td width=380>{$values.persons.0.lastname|default:'********'}</td>
	<td width=150></td>
	<td width=130 align=center>{$values.persons.0.driver_licence_series|default:'***'}</td>
	<td width=80></td>
	<td width=130 align=center>{$values.persons.0.driver_licence_number|default:'******'}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=170 height=32>&nbsp;</td>
	<td width=420>{$values.persons.0.firstname|default:'********'} {$values.persons.0.patronymicname|default:'********'}</td>
	<td width=220></td>
	<td width=80 align=center valign=bottom>{$values.persons.0.driver_licence_date_year|default:'****'}</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 25px;">
<tr>
	<td width=170 height=28>&nbsp;</td>
	<td width=400>{$values.persons.1.lastname|default:'********'}</td>
	<td width=160></td>
	<td width=130 align=center>{$values.persons.1.driver_licence_series|default:'***'}</td>
	<td width=80></td>
	<td width=130 align=center>{$values.persons.1.driver_licence_number|default:'******'}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=170 height=32>&nbsp;</td>
	<td width=420>{$values.persons.1.firstname|default:'********'} {$values.persons.1.patronymicname|default:'********'}</td>
	<td width=220></td>
	<td width=80 align=center valign=bottom>{$values.persons.1.driver_licence_date_year|default:'****'}</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 25px;">
<tr>
	<td width=170 height=28>&nbsp;</td>
	<td width=420>{$values.persons.2.lastname|default:'********'}</td>
	<td width=170></td>
	<td width=130 align=center>{$values.persons.2.driver_licence_series|default:'***'}</td>
	<td width=80></td>
	<td width=130 align=center>{$values.persons.2.driver_licence_number|default:'******'}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=170 height=32>&nbsp;</td>
	<td width=420>{$values.persons.2.firstname|default:'********'} {$values.persons.2.patronymicname|default:'********'}</td>
	<td width=220></td>
	<td width=80 align=center valign=bottom>{$values.persons.2.driver_licence_date_year|default:'****'}</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 12px;">
<tr>
	<td width=170 height=32>&nbsp;</td>
	<td width=420>{$values.persons.3.lastname|default:'********'}</td>
	<td width=150></td>
	<td width=130 align=center>{$values.persons.3.driver_licence_series|default:'***'}</td>
	<td width=80></td>
	<td width=130 align=center>{$values.persons.3.driver_licence_number|default:'******'}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=170 height=32>&nbsp;</td>
	<td width=420>{$values.persons.3.firstname|default:'********'} {$values.persons.3.patronymicname|default:'********'}</td>
	<td width=220></td>
	<td width=80 align=center valign=bottom>{$values.persons.3.driver_licence_date_year|default:'****'}</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 72px;">
<tr>
	<td width=105 height=30>&nbsp;</td>
	<td width=50 align=center >{if $values.engineSizesCode}{$values.engineSizesCode}{else}{$values.car_weight_code}{/if}</td>
	<td width=120>&nbsp;</td>
	<td width=510>{$values.brand} {$values.model}</td>
	<td width=130>&nbsp;</td>
	<td width=160 align=center>{$values.sign}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 2px;">
<tr>
	<td width=221 height=30>&nbsp;</td>
	<td width=370 style="font-weight: bold;">{$values.shassi}</td>
	<td width=100>&nbsp;</td>
	<td width=70 align=center>{$values.year}</td>
	<td width=100>&nbsp;</td>
	<td width=232>{$values.place}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 11px;">
<tr>
	<td width=818 height=30>&nbsp;</td>
	<td>
		<table border="0" cellpadding=0 cellspacing=0 style="text-align: center;">
		<tr>
			<td width=44 height=30>{$values.cartypes.A}</td>
			<td width=44>{$values.cartypes.B}</td>
			<td width=44>{$values.cartypes.C}</td>
			<td width=44>{$values.cartypes.D}</td>
			<td width=44>{$values.cartypes.E}</td>	
			<td width=44>{$values.cartypes.F}</td>		
		</tr>
		</table>
	</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 22px;">
<tr>
	<td width=250 height=30>&nbsp;</td>
	<td width=90 align=center>{$values.amount_number}</td>
	<td width=20>&nbsp;</td>
	<td width=45 align=center>{$values.amount_decimal}</td>
	<td width=60>&nbsp;</td>
	<td width=730>{$values.amount_go|moneyformat:1:true}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 17px;">
<tr>
	<td width=160 height=30>&nbsp;</td>
	<td width=40 align=center>{$values.payment_datetime|date_format:'%H'}</td>
	<td width=20>&nbsp;</td>
	<td width=40 align=center>{$values.payment_datetime|date_format:'%M'}</td>
	<td width=20>&nbsp;</td>
	<td width=40 align=center>{$values.payment_datetime|date_format:'%d'}</td>
	<td width=30>&nbsp;</td>
	<td width=40 align=center>{$values.payment_datetime|date_format:'%m'}</td>
	<td width=40>&nbsp;</td>
	<td width=40 align=center>{$values.payment_datetime|date_format:'%y'}</td>
	<td width=40 align=center>&nbsp;</td>
	<td width=40 align=center>{$values.payment_number}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 65px;">
<tr>
	<td width=460 height=32>&nbsp;</td>
	<!-- td width=200>{if $values.certificate_series}посвідчення {$values.certificate_series} {$values.certificate_number}{/if}</td-->
	<td width=45>{$values.stiker_series}</td> 
	<td width=90></td>
	<td width=140 style="font-weight: bold;">{$values.stiker_number}</td>
	<td width=230>ТЗ {if $values.otk}підлягає ОТК{else}не підлягає ОТК{/if}<br>Заява є невід’ємною частиною договору</td>
	
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 10px;">
	<tr>
		<td height=140 width=200></td>
	</tr>
</table>
</body>
</html>