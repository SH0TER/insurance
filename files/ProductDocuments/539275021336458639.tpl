<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ГО. Урегулирование, заявление</title>
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

<h1>ПОВІДОМЛЕННЯ</h1>

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
          <td class="all">{$values.description}</td>
        <tr>
    </table>
<br />

    <table cellpadding="5" width="100%">
            <tr>
                <td class="all"><b>Майно (транспортний засіб тощо) учасника ДТП</b></td>
                <td class="all"><b>{if $values.owner_types_id == 1}{$values.insurer_brand} {$values.insurer_model}{if $values.insurer_sign}, д.н. {$values.insurer_sign}</b>{/if}{else}{$values.owner_brand} {$values.owner_model}{if $values.owner_sign}, д.н. {$values.owner_sign}{/if}{/if}</td>
            </tr>
            <tr>
                <td class="all"><b>Майно (транспортний засіб тощо) знаходиться за адресою:  </b></td>
                <td class="all"><b>{$values.location}</b></td>
            </tr>
{*            <tr>*}
{*                <td class="all"><b>ТЗ керував</b></td>*}
{*                <td class="all"><b>{$values.driver_lastname} {$values.driver_firstname} {$values.driver_patronymicname}</b> на підставі <b>{$values.driver_document}</b></td>*}
{*            </tr>*}
            <tr>
              <td class="all"><b>Опис пошкоджень ТЗ винуватця</td>
              <td class="all">{$values.damage}</td>
            <tr>
           <tr>
              <td class="all"><b>Опис пошкоджень майна постраждалого </td>
              <td class="all">{$values.victim_damage_note}</td>
            <tr>
     </table>
    {if $values.owner_types_id == 2}
    <table cellpadding="5">
            <tr>
                <td><b>Внаслідок події завдано шкоду життю та здоров’ю </b></td>
                <td class="all">{if $values.application_risks_id == 2}Так{else}Ні{/if}</b></td>
            </tr>
     </table>
    {/if}
<br />

 <table cellpadding="5" width="100%">
            <tr>
                <td><b>Оформлення ДТП здійснено шляхом:</b></td>
                <td class="all" align="left">{if $values.accidents_go_mvs == 2}оформлення європротоколу{else}виклику працівників : <b>{$values.mvs_title}</b>{/if} </b></td>
            </tr>
 </table>
<br />
<br />
<table>
    <tr style="margin-top: 50px;">
                <td>/ ________________________________ /</td>
            </tr>
            <tr>
                <td class="sub">(підпис)</td>
            </tr>
</table>

<div style="page-break-after: always"></div>
<p align="center">
	<b>Схематичне зображення місця події:</b><br />
	<i>(схема ділянки дороги(перехрестя), назва вулиць, траєкторія руху, місце зіткнення, дорожні знаки, орієнтири, тощо)</i>
</p>
<br />
<table id="schema">
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table><br /><br />
<br />
<p>
Попередньо розмір матеріального збитку складає ________________________________________________
<div class="sub" style="text-align: left; padding-left: 430px;">(заповнюється постраждалим)</div>
</p>
<br/><br />
<p><b>До заяви додаються:</b></p>
{foreach name="roll" from=$values.documents key=k item=item}
{if $smarty.foreach.roll.first}<ol>{/if}
	<li>{$item}{if $smarty.foreach.roll.last}.{else};{/if}</li>
{if $smarty.foreach.roll.last}</ol>{/if}
{/foreach}
<br />
<p>Достовірність всієї інформації в цій заяві підтверджую.
<p>Зобов’язуюсь не розпочинати відновлювальний ремонт ТЗ до його огляду представником ТДВ "Експрес-Страхування",
<b><p>Надаю ТДВ "Експрес-Страхування" (надалі – Страховик) свою згоду на внесення моїх персональних даних (в тому числі паспортних даних, ідентифікаційного номеру, даних щодо місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною або будуть отримані Страховиком з метою реалізації мети обробки) до бази даних, що ведеться Страховиком і посвідчую, що належним чином повідомлений про факт внесення моїх персональних даних в таку базу для їх подальшої обробки у будь-який спосіб. При цьому підтверджую, що належним чином повідомлений про свої права, визначені «Законом про захист персональних даних» та мету збору даних – врегулювання заявленої події для прийняття рішення щодо здійснення страхового відшкодування, реалізація інших відносин у сфері страхування, адміністративно-правових відносин, податкових відносин, відносин у сфері бухгалтерського обліку, відносин у сфері обліку та звітності.
<p>Дана згода є безстроковою та не потребує здійснення письмових повідомлень про зміну чи знищення персональних даних або обмеження доступу до них, передачу персональних даних третім  особам.</b>
<br />
<br />

<p><b>{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</b></p>
<p>&nbsp;</p>

<p>Заявник: <b>{$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname}</b>  / ________________________________ /</p>
<div class="sub" style="text-align: left; padding-left: 500px;">(підпис)</div>
<div style="page-break-after: always"></div>

</body>
</html>