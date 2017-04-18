<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>КАСКО. Урегулирование, заявление</title>
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
			<td><b>Заяву отримав</b></td>
		</tr>
		<tr>
			<td class="underline">{$values.masters_lastname}</td>
		</tr>
		<tr>
			<td class="underline">{$values.masters_firstname} {$values.masters_patronymicname}</td>
		</tr>
		<tr>
			<td class="sub">(П.І.Б. працівника, який прийняв заяву)</td>
		</tr>
		<tr>
			<td class="underline">{$values.car_services_title}</td>
		</tr>
		<tr>
			<td class="sub">(місце подачи заяви)</td>
		</tr>
		<tr>
			<td>Зареєстровано: № ВХ {$values.accidents_number}.{$values.product_document_types_id}, {$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
	<td width="35%" valign="top">
		<table width="100%" cellpadding="5" cellspacing="5">
		<tr>
			<td><b>Директор ТДВ "Експрес Страхування"</b></td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_lastname}</td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_firstname} {$values.applicant_patronymicname}</td>
		</tr>
		<tr>
			<td class="sub">(П.І.Б. заявника)</td>
		</tr>
		<tr>
			<td class="underline">{$values.applicant_regions_title}</td>
		</tr>
		<tr>
			<td class="underline">{if $values.applicant_area} {$values.applicant_area} р-н,{/if} {$values.applicant_city}</td>
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

<h1>Заява про подію</h1>

<p>
	Повідомляю Вас про те, що <b>{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. о {$values.accidents_datetime|date_format:'%H'} год. {$values.accidents_datetime|date_format:'%M'} хв.</b>   
	за адресою: <b>{$values.address}</b>, транспортний засіб марки <b>{$values.policies_brand} {$values.policies_model}</b>, державний реєстраційний номер <b>{$values.policies_sign}</b>, 
	що застрахований по полісу КАСКО № <b>{$values.policies_number}</b> від <b>{$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b> було пошкоджено внаслідок:
</p><br />

<table cellpadding="5" cellspacing="5">
<tr>
	<td class="all">{if $values.application_risks_id == 1}X{else}&nbsp;{/if}</td>
	<td>Дорожньо-транспортної пригоди (ДТП);</td>
</tr>
<tr>
	<td class="all">{if $values.application_risks_id == 2}X{else}&nbsp;{/if}</td>
	<td>Протиправних дій третіх осіб (ПДТО);</td>
</tr>
<tr>
	<td class="all">{if $values.application_risks_id == 3}X{else}&nbsp;{/if}</td>
	<td>Стихійних явищ (бурі, урагану, шквалу, смерчу, граду, зсуву, удару блискавки, тощо);</td>
</tr>
<tr>
	<td class="all">{if $values.application_risks_id == 4}X{else}&nbsp;{/if}</td>
	<td>Падіння літальних апаратів або їх частин, дерев, інших предметів;</td>
</tr>
<tr>
	<td class="all">{if $values.application_risks_id == 5}X{else}&nbsp;{/if}</td>
	<td>Нападу тварин;</td>
</tr>
<tr>
	<td class="all">{if $values.application_risks_id == 6}X{else}&nbsp;{/if}</td>
	<td>Пожежі, вибуху, самозаймання ТЗ;</td>
</tr>
<tr>
	<td class="all">{if $values.application_risks_id == 7}X{else}&nbsp;{/if}</td>
	<td>Незаконного заволодіння ТЗ.</td>
</tr>
</table><br />

{if $values.application_risks_id == $smarty.const.RISKS_DTP}
<p>
	<b>Тип події:</b>
	{if $values.types_id == 1} 
		Зіткнення: 2-х учасників
	{elseif $values.types_id == 2}
		Зіткнення: 3-х учасників
	{elseif $values.types_id == 3}	
		Перекидання
	{elseif $values.types_id == 4}
		Наїзд на перешкоду
	{elseif $values.types_id == 5}
		Наїзд на пішохода
	{elseif $values.types_id == 6}
		Наїзд на велосипедиста
	{elseif $values.types_id == 7}
		Наїзд на тварину
	{elseif $values.types_id == 8}
		Наїзд на гужовий транспорт
	{elseif $values.types_id == 9}
		Наїзд на транспортний засіб, що стоїть
	{elseif $values.types_id == 10}
		Інше
	{/if}
</p><br /><br />

<p>
	<b>Cтупінь тяжкості наслідків:</b>
	{if $values.consequences & 1}матеріальний збиток;{/if}
	{if $values.consequences & 2}легкі тілесні ушкодження;{/if}
	{if $values.consequences & 4}тілесні ушкодження середнього ступеня тяжкості і тяжкі;{/if}
	{if $values.consequences & 8}смерть потерпілого;{/if}
	{if $values.consequences & 16}особливо тяжкі наслідки (загинуло 4 і більш або поранено 15 і більш людей);{/if}
</p><br /><br />
{/if}

<p><b>Опис події, обставини:</b></p>
<p>{$values.description}</p><br /><br />

<p><b>Пошкодження:</b></p>
<p>{$values.damage}</p><br /><br />

<p align="center">
	<b>Схематичне зображення місця події:</b><br />
	<i>(схема ділянки дороги(перехрестя), назва вулиць, траєкторія руху, місце зіткнення, дорожні знаки, орієнтири, тощо)</i>
</p>
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

<p>Заявник: {$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname} / ________________________________ /</p>
<div class="sub" style="text-align: left; padding-left: 430px;">(підпис)</div>
<div style="page-break-after: always"></div>

<p>
	{if $values.assistance}
		Про подію <b>повідомлено</b> в диспетчерський центр страховика: <b>{$values.assistance_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}, {if $values.assistance_place}з місця пригоди{else}не з місці пригоди{/if}</b>.
	{else}
		Про подію <b>не повідомлено</b> в диспетчерський центр страховика, причина: <b>{$values.assistance_reason}</b>.
	{/if}
</p>
<p>
	{if $values.mvs_title}
		Про подію <b>повідомлено</b> - <b>{$values.mvs_title}, {$values.mvs_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</b>.
	{else}
		Про подію <b>не повідомлено</b> відповідні органи. 
	{/if}
</p>
<p>&nbsp;</p>
<p>На час настання вказаного випадку транспортним засобом керував (ла): <b>{$values.driver_lastname} {$values.driver_firstname} {$values.driver_patronymicname}</b> на підставі <b>{$values.driver_document}</b></p>
<p>&nbsp;</p>
{section name="roll" loop=$values.participants}
{if $smarty.section.roll.first}<p><b>Відомості про інших учасників події:</b></p>{/if}
<p>Транспортний засіб:{if $values.participants[roll].brand} Марка, модель {$values.participants[roll].brand};{/if}{if $values.participants[roll].sign} держ. номер {$values.participants[roll].sign}.{/if}</p>
<ul>
	{if $values.participants[roll].driver_lastname || $values.participants[roll].driver_firstname || $values.participants[roll].driver_patronymicname || $values.participants[roll].driver_phone || $values.participants[roll].driver_address}<li>{if $values.participants[roll].driver_lastname || $values.participants[roll].driver_firstname || $values.participants[roll].driver_patronymicname}ПІБ водія {$values.participants[roll].driver_lastname} {$values.participants[roll].driver_firstname} {$values.participants[roll].driver_patronymicname}{/if}{if $values.participants[roll].driver_phone}, тел. {$values.participants[roll].driver_phone}{/if}{if $values.participants[roll].driver_address}, адреса водія: {$values.participants[roll].driver_address}{/if}.</li>{/if}
	{if $values.participants[roll].owner_lastname || $values.participants[roll].owner_firstname || $values.participants[roll].owner_patronymicname || $values.participants[roll].owner_phone || $values.participants[roll].owner_address}<li>{if $values.participants[roll].owner_lastname || $values.participants[roll].owner_firstname || $values.participants[roll].owner_patronymicname}ПІБ власника {$values.participants[roll].owner_lastname} {$values.participants[roll].owner_firstname} {$values.participants[roll].owner_patronymicname}{/if}{if $values.participants[roll].owner_phone}, тел. {$values.participants[roll].owner_phone}{/if}{if $values.participants[roll].owner_address}, адреса власника: {$values.participants[roll].owner_address}{/if}.</li>{/if}
</ul>
{if $values.participants[roll].insurance_company}<p>Назва Страхової компанії - {$values.participants[roll].insurance_company}, № полісу ЦВ - {$values.participants[roll].insurance_number}</p>{/if}
{/section}
<p>&nbsp;</p>
<p>Прошу Вас оглянути пошкоджений ТЗ за адресою: <b>{$values.location}</b>.</p>
<p>&nbsp;</p>
<p><b>До заяви додаються:</b></p>
{foreach name="roll" from=$values.documents key=k item=item}
{if $smarty.foreach.roll.first}<ol>{/if}
	<li>{$item}{if $smarty.foreach.roll.last}.{else};{/if}</li>
{if $smarty.foreach.roll.last}</ol>{/if}
{/foreach}
<p>&nbsp;</p>
<p>Надаю ТДВ "Експрес-Страхування" (надалі – Страховик) свою згоду на внесення моїх персональних даних (в тому числі паспортних даних, ідентифікаційного номеру, даних щодо місця проживання, місця реєстрації, номери засобів зв’язку, адреси електронної пошти, реквізити банківського рахунку, інших даних, які  надаються мною або будуть отримані Страховиком з метою реалізації мети обробки) до бази даних , що ведеться Страховиком і посвідчую, що належним чином повідомлений про факт внесення моїх персональних даних в таку базу для їх подальшої обробки у будь-який спосіб. При цьому підтверджую, що належним чином повідомлений про свої права, визначені «Законом про захист персональних даних» та мету збору даних – врегулювання заявленої події для прийняття рішення щодо здійснення страхового відшкодування, реалізація інших відносин у сфері страхування, адміністративно-правових відносин, податкових відносин, відносин у сфері бухгалтерського обліку, відносин у сфері обліку та звітності.</p>
<p>&nbsp;</p>
<p>Дана згода є безстроковою та не потребує здійснення письмових повідомлень про зміну чи знищення персональних даних або обмеження доступу до них, передачу персональних даних третім особам.</p>
<p>&nbsp;</p>
<p><b>Я ознайомлений(а), що у випадку надання невірних, неповних або недостовірних відомостей про випадок, створення перешкод Страховику або його представнику у розслідуванні обставин та визначенні розміру збитку, Страховик має право зменшити суму відшкодування або відмовити у виплаті.</b></p>
<p>&nbsp;</p>
<p><b>Зобов’язуюсь забезпечити страховику можливість оглянути пошкоджений транспортний засіб та надати всі необхідні документи що стосуються даної події.</b></p>
<p>&nbsp;</p>
<p style="text-decoration:underline;">Я, що нижче підписався, заявляю про те. що подана в даній заяві інформація(незалежно від того, заповнено заяву мною особисто або моїм представником) є повною та правдивою.</p>
<p>&nbsp;</p>
<p>{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}.</p>
<p>&nbsp;</p>
<p>Заявник: {$values.applicant_lastname} {$values.applicant_firstname} {$values.applicant_patronymicname} / ________________________________ /</p>
<div class="sub" style="text-align: left; padding-left: 430px;">(підпис)</div>
</body>
</html>