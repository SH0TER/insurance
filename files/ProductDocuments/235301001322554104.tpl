<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Новый полис ГО</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="../css/pdf.css" rel="stylesheet" />
{literal}
<style type="text/css">
* {
	font-size: 18px;
	font-family: Courier, Arial, Geneva, Helvetica, sans-serif;
}
h3{
        font-size: 18px;
        letter-spacing: 1px;
        font-family: Courier, Arial, Geneva, Helvetica, sans-serif;
}
.let_spacing{
        letter-spacing: 1px;
        font-family: Courier, Arial, Geneva, Helvetica, sans-serif;
}
.let_spacing_for_money{
        font-size: 12px;
        letter-spacing: 1px;
        font-family: Courier, Arial, Geneva, Helvetica, sans-serif;
}
</style>
{/literal}
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>

<table cellpadding=0 cellspacing=0 style="margin-top: {if $values.correction_go>0}{$values.correction_go}px;{else}80px;{/if}">
<tr>
	<td width=560 height=115>&nbsp;</td>
	<td width=120><label style="font-size: 28px;">{if $values.insurance_companies_id == 3}0 0 2{else}1 5 8{/if}</label></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 30px;" border=3>
<tr>
	<td width=140 height=149>&nbsp;</td>
	<td width=45 class="let_spacing">{$values.begin_datetime|date_format:'%H'}</td>
	<td width=23 class="let_spacing">&nbsp;</td>
	<td width=50 class="let_spacing">{$values.begin_datetime|date_format:'%M'}</td>
	<td width=20 class="let_spacing">&nbsp;</td>
	<td width=45 class="let_spacing">{$values.begin_datetime|date_format:'%d'}</td>
	<td width=23>&nbsp;</td>
	<td width=45 class="let_spacing">{$values.begin_datetime|date_format:'%m'}</td>
	<td width=50>&nbsp;</td>
	<td width=45>{$values.begin_datetime|substring:3:1}</td>
	<td width=50 class="let_spacing">&nbsp;</td>
	<td width=33 class="let_spacing">{$values.end_datetime|date_format:'%d'}</td>
	<td width=35 class="let_spacing">&nbsp;</td>
	<td width=25 class="let_spacing">{$values.end_datetime|date_format:'%m'}</td>
	<td width=63 class="let_spacing">&nbsp;</td>
	<td width=50>{$values.end_datetime|substring:3:1}</td>
</tr>
</table>
<table cellpadding=0 cellspacing=0 style="margin-top: 5px;">
<tr>
	<td width=400 height=23>&nbsp;</td>
	<td>{$values.limit_life|moneyformat:1:true}</td>
</tr>
<tr>
	<td height=50>&nbsp;</td>
	<td>{$values.limit_property|moneyformat:1:true}</td>
</tr>
<tr>
	<td height=45>&nbsp;</td>
	<td>{$values.deductible|moneyformat:1:true}</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 0px;">
<tr>
	<td width=935>&nbsp;</td>
	<td class="let_spacing">&nbsp;&nbsp;&nbsp;{$values.insurer_zip}</td>
</tr>
</table>
<table height="40" border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=180>&nbsp;</td>
	<td width=450>
		<table align="top" cellpadding=0 cellspacing=0>
		<tr>
			<td height=18>&nbsp;{$values.insurer_lastname}</td>
		</tr>
		<tr>
			<td height=30>&nbsp;{$values.insurer_firstname}</td>
		</tr>
		<tr>
			<td height=0>&nbsp;{$values.insurer_patronymicname}</td>
		</tr>  
		</table>
	</td>
    <td>
            <table cellpadding=0 cellspacing=0>
                <tr>
                    <td height=0 width=450>{$values.insurer_address}</td>
                </tr>
            </table>
    </td>
</tr>
</table>
<table style="margin-top: 10px;">    
    <tr>
        <td width=215></td>
        <td width=100 style="font-weight: bold;" class="let_spacing">{$values.insurer_edrpou}</td>
         <td width=400></td>
	<td height=40 >{if $values.insurer_phone} {$values.insurer_phone}{/if}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 40px;">
<tr>
	<td width=168 height=30>&nbsp;</td>
        <td width=70 class="let_spacing">{if $values.person_types_id==1}{$values.insurer_dateofbirth|date_format:'%d'}{else}-{/if}</td>
        <td width=72 class="let_spacing">{if $values.person_types_id==1}{$values.insurer_dateofbirth|date_format:'%m'}{else}-{/if}</td>
        <td width=62 class="let_spacing">{if $values.person_types_id==1}{$values.insurer_dateofbirth|date_format:'%Y'}{else}-{/if}</td>
        <td width=268></td>
	<td width=493 style="font-weight: bold; letter-spacing: 0.15ex;">{$values.insurer_identification_code}</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 25px;">
    <tr height=10>
        <td width=220>&nbsp;</td> 
        <td width=100>{if $values.person_types_id==1}{if $values.privileges>=1}Посвідчення{else}Паспорт{/if}{else}-{/if}</td>
        <td width=210>&nbsp;<td>
        <td width=100>{if $values.person_types_id==1}{if $values.privileges>=1}{$values.certificate_series}{else}{if $values.insurer_id_card != 1}{$values.insurer_passport_series}{else}-{/if}{/if}{else}-{/if}</td> 
        <td width="">&nbsp;<td>
        <td>{if $values.person_types_id==1}{if $values.privileges>=1}{$values.certificate_number}{else}{if $values.insurer_id_card != 1}{$values.insurer_passport_number}{else}{$values.insurer_newpassport_number}{/if}{/if}{else}-{/if}</td>
        <td width=182>&nbsp;<td>
        <td width=67 class="let_spacing">
        {if $values.person_types_id==1}{$values.certificate_date|date_format:'%d'}{else}{if $values.insurer_id_card != 1}{$values.insurer_passport_date|date_format:'%d'}{else}{$values.insurer_newpassport_date|date_format:'%d'}{/if}{/if}</td>
        <td width=72 class="let_spacing">{if $values.person_types_id==1}{$values.certificate_date|date_format:'%m'}{else}{if $values.insurer_id_card != 1}{$values.insurer_passport_date|date_format:'%m'}{else}{$values.insurer_newpassport_date|date_format:'%m'}{/if}{/if}</td>
        <td class="let_spacing">{if $values.person_types_id==1}{if $values.privileges>=1}{$values.certificate_date|date_format:'%Y'}{else}{if $values.insurer_id_card != 1}{$values.insurer_passport_date|date_format:'%Y'}{else}{$values.insurer_newpassport_date|date_format:'%Y'}{/if}{/if}{/if}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 15px;">
    <tr>
        <td width=300></td>
        <td width=700>{if $values.privileges>=1}{$values.certificate_place}{else}{if $values.insurer_id_card != 1}{$values.insurer_passport_place}{else}{$values.insurer_newpassport_place}{/if}{/if}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 26px;">
    <tr>
        <td width=400></td>
	<td width=200 align=center class="let_spacing">{if $values.engineSizesCode}{$values.engineSizesCode}{elseif $values.car_weight_code}{$values.car_weight_code}{elseif $values.passengers_code}{$values.passengers_code}{/if}</td>
        <td width=80></td>
        <td width=290 class="let_spacing">&nbsp;{$values.sign}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 10px;">
    <tr>
        <td width=220></td>
        <td width="500">{$values.brand}&nbsp;{$values.model}</td>
        <td width=340></td>
        <td class="let_spacing">{$values.year}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 10px;">
    <tr>
        <td width=260>&nbsp;</td>
        <td class="let_spacing_for_money" width="200">&nbsp;{$values.shassi}</td>
        <td width=350></td>
        <td width =300>&nbsp;{$values.registration_cities_title}</td>
    </tr>
</table>
<table border=0 cellpadding=3 cellspacing=0 style="margin-top: 55px;">
    <tr height=20>
        <td width=670>&nbsp;</td> 
        <td>{if $values.taxi == 1}Так{else}Ні{/if}</td>      
    </tr>
    <tr height=40>
        <td width=670>&nbsp;</td>
        <td align="center">{if $values.otk == 1}Так{else}Ні{/if}</td>
        <td width=465></td>
        <td width=30 class="let_spacing">{if $values.otk == 1}{$values.otkdateDay}{else}&nbsp;{/if}</td>
	<td width=30 class="let_spacing">&nbsp;</td>
	<td width=20 class="let_spacing">{if $values.otk == 1}{$values.otkdateMonth}{else}&nbsp;{/if}</td>
	<td width=20 class="let_spacing">&nbsp;</td>
	<td width=45 align="right">{if $values.otk == 1}{$values.otkdateYear}{else}&nbsp;{/if}</td>
    </tr>
    <tr height=35>
        <td width=670 style="margin-top: 30px;"></td>
        <td>{if $values.stage3 == 1}Так{else}Ні{/if}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 65px;">
    <tr>
         <td width=15</td>
         <td width=80>180.00</td>
         <td width=75>{$values.k1}</td>
         <td width=75>{$values.k2}</td>
         <td width=75>{$values.k3}</td>
         <td width=80>{$values.k4}</td>
         <td width=75>{$values.k5}</td>
         <td width=75>{$values.k6}</td>
         <td width=105>{$values.k7}</td>
         <td width=165>{$values.bonus_malus}</td>
         <td width=155>{$values.k_car_numbers}</td>
         <td width=70>{if $values.privileges}50{else}0{/if}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0  style="margin-top: 15px;">
    <tr>
         <td width=300</td>
         {if $values.amount_go|strlength == 7}
          <td width=90 class="let_spacing" align="center">{$values.amount_go|substring:0:4}</td>
          <td width=150></td>
          <td width=50 class="let_spacing">{$values.amount_go|substring:5:2}</td>
         {/if}
         {if $values.amount_go|strlength == 6}
         <td width=130 class="let_spacing" align="center">{$values.amount_go|substring:0:3}</td>
         <td width=150></td>
         <td width=50 class="let_spacing">{$values.amount_go|substring:4:2}</td>
         {/if}
         {if $values.amount_go|strlength == 5}
         <td width=130 class="let_spacing" align="center">{$values.amount_go|substring:0:2}</td>
         <td width=150></td>
         <td width=50 class="let_spacing">{$values.amount_go|substring:3:2}</td>
         {/if}
         <td width=420></td>
         <td width=730>{$values.amount_go|moneyformat:1:true}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 25px;">
<tr>
	<td width=109 height=45>&nbsp;</td>
	<td width=40 align=center class="let_spacing">{if $values.payment_datetime=='0000-00-00 00:00:00'}&nbsp;{else}{$values.payment_datetime|date_format:'%H'}{/if}</td>
	<td width=23>&nbsp;</td>
	<td width=40 align=center class="let_spacing">{if $values.payment_datetime=='0000-00-00 00:00:00'}&nbsp;{else}{$values.payment_datetime|date_format:'%M'}{/if}</td>
	<td width=25>&nbsp;</td>
	<td width=40 align=center class="let_spacing">{if $values.payment_datetime=='0000-00-00 00:00:00'}&nbsp;{else}{$values.payment_datetime|date_format:'%d'}{/if}</td>
	<td width=30>&nbsp;</td>
	<td width=40 align=center class="let_spacing">{if $values.payment_datetime=='0000-00-00 00:00:00'}&nbsp;{else}{$values.payment_datetime|date_format:'%m'}{/if}</td>
	<td width=45>&nbsp;</td>
	<td width=40 align=center>{if $values.payment_datetime=='0000-00-00 00:00:00'}&nbsp;{else}{$values.payment_datetime|substring:3:1}{/if}</td>
	<td width=45>&nbsp;</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 100px;">
    <tr>
        <td>Виданий спеціальний знак серії&nbsp; {$values.stiker_series} № {$values.stiker_number}</td>
    </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 style="margin-top: 120px;">
<tr>
	<td width=300>&nbsp;</td>
	<td class="let_spacing" width=40 align=center>{$values.date|date_format:'%d'}</td>
	<td width=30>&nbsp;</td>
	<td class="let_spacing" width=52>{$values.date|date_format:'%m'}</td>
	<td width=45>&nbsp;</td>
	<td width=40>{$values.date|substring:9:1}</td>
</tr>
</table>
</body>
</html>