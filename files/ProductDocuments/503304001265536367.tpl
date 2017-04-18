<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Запит в ДАІ на отримання довідки про дорожньо-транспортну пригоду</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
{literal}
<style>
*, P {
	font-size: 20px;
	line-height: 20px;
	text-align:justify;
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
	font-size: 16px;
	line-height: 20px;
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
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	{if $values.euassist == 1}
		<td width="30%">
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
				Справа № {$values.accidents_number}
			</p>
        </td>
		<td>&nbsp;</td>
	{else}
		<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
		<td align="right">
			<p>ТДВ "Експрес Страхування"</p>
			<p>01004, м. Київ, вул. Велика Васильківська, буд. 15/2</p>
			<p>Тел/факс: 594-87-00/02<p>
		</td>
	{/if}
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 50px 0 50px 0;">
<tr>
	<td width="50%" valign="top" class="small">
		{if $values.euassist != 1}
			<p>
				Вих. № <br />
				від 
			</p>
		{/if}
	</td>
	<td width="50%" align="right" class="large">
		{if $values.mvs_id_average != 149}
		<p>Начальнику</p>
		{/if}
		<p>{$values.mvs_title_average}</p>
		{if $values.mvs_id_average == 149}
		<p>{$values.mvs_address}</p>
		{/if}
	</td>
</tr>
</table>

<h1>ЗАПИТ</h1>
<h2>на отримання довідки про дорожньо-транспортну пригоду</h2><br /><br />

<p>{if $values.euassist == 1}ТОВ "ЄвроАсистанс", як Повірений ТДВ "Експрес Страхування" (Договір доручення №31/10/13 від 31.10.2013 року), відповідно{else}Відповідно{/if} до ст. 25 Закону України "Про страхування" від 07.03.1996р. № 85/96, п. 56.1.1 ст. 56.1 Закону України "Про обов’язкове страхування цивільно-правової відповідальності власників наземних транспортних засобів" № 1961-ІV від 1 липня 2004 року та Наказу МВС України "Про надання" прошу надати відомості про дорожньо-транспортну пригоду, що сталася <b>{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. {$values.address}</b>, за участю а/м <b>{$values.policies_brand} {$values.policies_model}</b>, д.н. <b>{$values.policies_sign}</b>, яким керував гр. <b>{$values.driver_lastname} {$values.driver_firstname} {$values.driver_patronymicname}</b>.<br />
{if $values.participants.0.brand || $values.participants.0.sign || $values.participants.0.driver_lastname || $values.participants.0.driver_firstname || $values.participants.0.driver_patronymicname}
Іншим(и) учасниками пригоди був(ли): а/м {$values.participants.0.brand|default:'********'}, д/н {$values.participants.0.sign|default:'********'}{if $values.participants.0.driver_lastname || $values.participants.0.driver_firstname || $values.participants.0.driver_patronymicname}, яким керував гр. {$values.participants.0.driver_lastname|default:'********'} {$values.participants.0.driver_firstname|default:'********'} {$values.participants.0.driver_patronymicname|default:'********'}{/if}
{/if}
{if $values.participants.1.brand || $values.participants.1.sign || $values.participants.1.driver_lastname || $values.participants.1.driver_firstname || $values.participants.1.driver_patronymicname}
, а/м {$values.participants.1.brand|default:'********'}, д/н {$values.participants.1.sign}{if $values.participants.1.driver_lastname || $values.participants.1.driver_firstname || $values.participants.1.driver_patronymicname}, яким керував гр. {$values.participants.1.driver_lastname|default:'********'} {$values.participants.1.driver_firstname|default:'********'} {$values.participants.1.driver_patronymicname|default:'********'}{/if}
{/if}
{if $values.participants.2.brand || $values.participants.2.sign || $values.participants.2.driver_lastname || $values.participants.2.driver_firstname || $values.participants.2.driver_patronymicname}
, а/м {$values.participants.2.brand|default:'********'}, д/н {$values.participants.2.sign|default:'********'}{if $values.participants.2.driver_lastname || $values.participants.2.driver_firstname || $values.participants.2.driver_patronymicname}, яким керував гр. {$values.participants.2.driver_lastname|default:'********'} {$values.participants.2.driver_firstname|default:'********'} {$values.participants.2.driver_patronymicname|default:'********'}{/if}
{/if}
</p>

<p>При цьому постраждалих фізично немає.</p><br />
<p>Пошкодженний транспортний засіб: <b>{$values.policies_brand} {$values.policies_model}</b>{if $values.policies_sign}, д.н. <b>{$values.policies_sign}</b>{/if}.</p><br /><br />

<p class="small">Стаття 25. У разі необхідності страховик або Моторне (транспортне) страхове бюро можуть робити запити про відомості, пов'язані із страховим випадком, до правоохоронних органів, банків, медичних закладів та інших підприємств, установ і організацій, що володіють інформацією про обставини страхового випадку, а також можуть самостійно з'ясовувати причини та обставини страхового випадку.</p>
<p class="small">Підприємства, установи та організації зобов'язані надсилати відповіді страховикам та Моторному (транспортному) страховому бюро на запити про відомості, пов'язані із страховим випадком, у тому числі й дані, що є комерційною таємницею. При цьому страховик та Моторне (транспортне) страхове бюро несуть відповідальність за їх розголошення в будь-якій формі, за винятком випадків, передбачених законодавством України.</p>
<p class="small">п. 56.1. Органи державної влади, органи місцевого самоврядування, юридичні особи та громадяни зобов'язані безоплатно надавати на запит страховиків та МТСБУ інформацію, якою вони володіють (у тому числі і конфіденційну), що пов'язана з страховими випадками з обов'язкового страхування цивільно-правової відповідальності або з подіями, що були підставою для подання потерпілими вимог про відшкодування шкоди МТСБУ. Органи Державтоінспекції МВС України також надають безоплатно страховикам та МТСБУ на їх запити відомості про реєстрацію транспортних засобів, з власниками яких ці страховики укладають договори обов'язкового страхування цивільно-правової відповідальності, дорожньо-транспортні пригоди, що мали місце.</p>
<p class="small">п. 2.2. Зобов’язати начальників підрозділів ОВС, на які покладаються обов’язки оформлення та обліку ДТП забезпечити своєчасне оформлення довідок та контроль за їх видачею відповідно до Інструкції.</b></p><br />

<p>Переконливо просимо зазначити, у діях якого з водіїв вбачається порушення, яких пунктів ПДРУ, а також назву суду, до якого відправлені адмін. матеріали і стосовно кого з водіїв.</p><br />

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
<tr>
	<td width="45%" align="left">
		<b style="line-height: 150%">З повагою,<br />
		{if $values.euassist == 1}
			Начальник відділу врегулювання	
			збитків за договорами КАСКО<br />                                                               
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
<div class="very_small i">
	Виконав: {$values.authors_lastname} {$values.authors_firstname|truncate:2:'':true}.<br/>
	Тел. +38 044 594 87 00<br/>
	e-mail: {$values.authors_email}<br/>
	Наша справа № {$values.accidents_number}
</div>
</body>
</html>