<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Майно. Урегулирование, заявление</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
<style type="text/css">
{literal}
#schema {
	width: 100%;
}
#schema td {
	border-width: 1px;
	padding: 1px;
	border-style: dotted;
	border-color: #000000;
}
{/literal}
</style>
</head>
<body>
<div id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></div>
<table cellspacing=0 cellpadding=5 width=100%>
<tr>
	<td width="35%" valign="top">
		<table width="100%" cellpadding="5" cellspacing="5">
		<tr>
			<td><b>Повідомлення одержано: <label class="underline">{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</label> </b></td>
		</tr>
		<tr>
			<td class="underline" align="center">{$values.masters_lastname} {$values.masters_firstname} {$values.masters_patronymicname}</td>
		</tr>
		<tr>
			<td class="sub">(П.І.Б. працівника, який прийняв заяву)</td>
		</tr>
		<tr>
			<td class="underline" align="center">{$values.car_services_title}</td>
		</tr>
		<tr>
			<td class="sub">(місце подачи заяви)</td>
		</tr>
		<tr>
			<td>Зареєстровано: № ВХ {$values.accidents_number}.{$values.product_document_types_id} </td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="35%" valign="top">
		<table width="100%" cellpadding="5" cellspacing="5">
		<tr>
			<td><b>Директору ТДВ "Експрес Страхування"</b></td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname}</td>
		</tr>
		<tr>
			<td class="sub">(П.І.Б. заявника)</td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_regions_title}</td>
		</tr>
		<tr>
			<td class="underline">{if $values.applicant_area}, {$values.applicant_area} р-н,{/if} {$values.applicant_city}</td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_street}, буд. {$values.applicant_house}{if $values.applicant_flat}, кв/офіс {$values.applicant_flat}{/if}</td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_phones}</td>
		</tr>
		<tr>
			<td class="sub">(адреса та телефон заявника)</td>
		</tr>
		</table>
	</td>
</tr>
</table>

<h1>Заява</h1>

    <table cellpadding="5" width="100%">
        <tr>
            <td class="all"><b>Заявник</b></td>
            <td class="all">{if $values.owner_types_id == 1}Особа, відповідальність якої застрахована{else}Постраждалий{/if}</td>
        </tr>
        <tr>
            <td class="all"><b>Поліс страхування</b></td>
            <td class="all"> <ins><b>{$values.policies_number}</b></ins> від <b>{$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b><br /></td>
        </tr>
        <tr>
            <td class="all"><b>Подія відбулася</b></td>
            <td class="all"><b>{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b> о <b>{$values.accidents_datetime|date_format:'%H'} год. {$values.accidents_datetime|date_format:'%M'} хв.</b><br /></td>
        </tr>
        <tr>
            <td class="all"><b>за адресою </b></td>
            <td class="all">{$values.address}<br /></td>
        </tr>
        <tr>
          <td class="all"><b>за таких обставин </b>(короткий опис події та її наслідків)</td>
          <td class="all">{$values.damage}</td>
        <tr>
    </table>
<br />
    <p>Повідомляємо Вам, що внаслідок події з ознаками страхового випадку, яка сталась {$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. було виявлено пошкодження майна, застрахованого за договором страхування № {$values.policies_number} від {$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
    <p>Пошкодження сталось за наступних обставин: {$values.description}
    <p>Опис пошкодженого майна: {$values.damage}

<p><b>{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</b></p>
<p>&nbsp;</p>

<p>Заявник: <b>{$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname}</b>  / ________________________________ /</p>
<div class="sub" style="text-align: left; padding-left: 500px;">(підпис)</div>
<div style="page-break-after: always"></div>

</body>
</html>