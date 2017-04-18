<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Запит до банку</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
{literal}
<style>
*, P {
	font-size: 20px;
	line-height: 22px;
}
H1 {
	font-size: 26px;
	font-weight: bold;
	text-align: center;
}
H2 {
	font-size: 24px;
	font-weight: bold;
	text-align: center;
}
.small P, .small {
	font-size: 14px;
	line-height: 26px;
}
.large P, .large {
	font-size: 26px;
}
.very_small P, .very_small {
	font-size: 10px;
}
</style>
{/literal}
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>		
        <td width="30%">
			{if $values.euassist == 1}
				<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/euassist_logo.gif" width="227" height="105" />
				<p>
					ТОВ «ЄвроАсистанс»
				</p><br/>
				<p class="small">
					04655, м. Київ, пр-т Московський, 22<br/>
					тел.: 044 594-87-00, факс: 044 594-87-02<br/>
					e-mail: reception@euassist.com.ua
				</p><br/>
				<p>
					Вих. № {$values.accident_documents_number}<br />
					від {$values.accident_documents_created|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
				</p>
			{else}
				<img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" />
				<p>
					Вих. № {$values.accident_documents_number}<br />
					від {$values.accident_documents_created|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
				</p>
			{/if}
        </td>
        <td width="40%"></td>
        <td width="30%"></td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td width="30%"></td>
        <td width="40%"></td>
        <td width="20%">
            <p><b>{if $values.financial_institutions_id == 33}ПАТ «Дельта Банк»{else}{$values.policies_assured_title}{/if}</b></p>
			<p>
                {if $values.financial_institutions_id == 1}29000, м. Хмельницький, вул. Соборна, 34
                {elseif $values.financial_institutions_id == 2}14000, м. Чернігів, пр. Перемоги, 62
				{elseif $values.financial_institutions_id == 33}м. Київ, вул. Щорса, буд.36-Б
                {else}{$values.policies_assured_address}
                {/if}
				{if $values.financial_institutions_id == 41}
					<br/>для відділу адміністрування кредитів
				{/if}
            </p>
        </td>
        <td width="10%"></td>
    </tr>
</table>
<br/>
<br/>
<p align="center"><b>Шановні панове!</b></p>
<br/>
<br/>
<p style="text-indent: 2em; text-align: justify; line-height: 120%">{if $values.euassist == 1}ТОВ "ЄвроАсистанс", як Повірений ТДВ "Експрес Страхування" (Договір доручення №31/10/13 від 31.10.2013 року),{else}ТДВ "Експрес Страхування"{/if} повідомляє Вас про те, що <b>{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b> із застрахованим згідно з договором страхування № <b>{$values.policies_number}</b> від <b>{$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b> автомобілем <b>{$values.policies_brand} {$values.policies_model}</b>{if $values.policies_sign}, д.р.н. <b>{$values.policies_sign}</b>{/if}{if $values.policies_shassi}, № шасі (кузов, рама) <b>{$values.policies_shassi}</b>{/if} сталась подія, що в подальшому може бути кваліфікована як страховий випадок.</p><br /><br />
<p>
	Власник: <b>{if $values.policies_owner_person_types_id == 1}{$values.policies_owner_lastname} {$values.policies_owner_firstname} {$values.policies_owner_patronymicname}{else}{$values.policies_owner_company}{/if}</b><br/><br/>
	{if $values.policies_owner_person_types_id == 1}ІПН: <b>{$values.policies_owner_identification_code}{else}ЄДРПОУ: {$values.policies_owner_edrpou}{/if}</b><br/><br/>
	{if $values.amount_rough_type == 1}Орієнтовний{/if}{if $values.amount_rough_type == 2}Фактичний{/if} розмір збитку становить: <b>{$values.amount_rough}</b> (що становить {$values.rough_part}% від страхової вартості ТЗ)
<br /><br />
{if $values.amount_rough_type == 1}<p class="small" style="text-indent: 2em; text-align: justify;">*Розмір орієнтовного збитку/страхового відшкодування може бути змінено, як в сторону збільшення, так і в сторону зменшення, під час
більш детального дослідження пошкодженого ТЗ щодо виявлення прихованих дефектів та з'ясування всіх обставин настання події з ознаками страхового випадку.</p>{/if}
<br />
<br />
<p style="text-indent: 2em; text-align: justify; line-height: 120%">
    Просимо, Вас як Вигодонабувача за договором страхування, узгодити спосіб виплати страхового відшкодування, за одним з варіантів наведених нижче:
</p>
<br/>
<p style="text-indent: 4em; text-align: justify; line-height: 120%">
    <img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/galochka.gif" width="20" height="20" />&emsp;На авторизовану гарантійну СТО для відновлення автомобіля, <b>відповідно до основних умов договору страхування</b>, узгодженого з Вигодонабувачем.
</p>
<br/>
<p style="text-indent: 4em; text-align: justify; line-height: 120%">
    <img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/galochka.gif" width="20" height="20" />&emsp;При прийнятті Вигодонабувачем рішення щодо зарахування страхового відшкодування в рахунок погашення кредитної заборгованості, зазначити реквізити, за якими відшкодування повинно бути сплачено.
</p>
<br/>
<p style="text-indent: 4em; text-align: justify; line-height: 120%">
    <img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/galochka.gif" width="20" height="20" />&emsp;Після надання відновленого транспортного засобу для огляду представнику страховика, сплатити відшкодування за реквізитами вказаними страхувальником.
</p>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
<tr>
	<td width="45%" align="left">
		<b style="line-height: 120%">З повагою,<br />
		{if $values.euassist == 1}
			Начальник відділу врегулювання	
			збитків за договорами КАСКО<br/>                                                               
			ТОВ «ЄвроАсистанс»
		{else}
			Заступник директора<br />
			ТДВ «Експрес Страхування»
		{/if}
	</td>
	<td width="30%" align="center"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sign_zalutskiy_color.jpg" height="300" width="300"/></td>
	<td width="25%" align="right">
		<b>
			{if $values.euassist == 1}
				Дерлеменко В. Г.
			{else}
				Залуцький С.В.
			{/if}
	</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
	<tr>
		<td>
			<p class="very_small">
				Виконав: {$values.authors_lastname} {$values.authors_firstname|truncate:2:'':true}.<br/>
				Тел. +38 044 594-87-00<br/>
				e-mail: {$values.authors_email}<br/>
				Наша справа № {$values.accidents_number}
			</p>
		</td>
	</tr>
</table>
</body>
</html>