<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Заява/повідомлення про подію</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<style type="text/css">
{literal}
	* {
		font-style: italic;
	}
	
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
<body style="padding-right: 5px;">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	{if $values.euassist == 1}
		<td width="30%" id="company5"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	{else}
		<td width="30%" style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo_express_transparent.gif) no-repeat 0 0;"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	{/if}
	<td width="30%">&nbsp;</td>
	<td align="left" valign="bottom" class="large">
		<p>Директору</p>
		<p>ТДВ «Експрес Страхування»</p>
		<p>Щучьєвій Т. А.</p>
	</td>
</tr>
</table>

<br/><br/>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
	<td width="30%" class="top bottom left right" style="vertical-align: top;">
		<table width="100%">
			<tr>
				<td><b>Повідомлення отримав</b></td>
			</tr>
			<tr>
				<td class="bottom" align="center">{$values.creator_lastname} {$values.creator_firstname|truncate:2:'':true}. {$values.creator_patronymicname|truncate:2:'':true}</td>
			</tr>
			<tr>
				<td class="sub">(П.І.Б працівника, який приймав заяву)</td>
			</tr>
			<tr>
				<td align="center">{$values.created_format}</td>
			</tr>
			<tr>
				<td align="center">№ повідомлення: {$values.application_accidents_number}</td>
			</tr>
		</table>
	</td>
	<td width="30%">&nbsp;</td>
	<td style="vertical-align: top;">
		<table width="100%">
			<tr>
				<td class="bottom">{$values.applicant}</td>
			</tr>
			<tr>
				<td class="sub">(П.І.Б заявника)</td>
			</tr>
			<tr>
				<td class="bottom">{$values.applicant_address}</td>
			</tr>
			<tr>
				<td class="bottom">{if $values.applicant_phone}тел. {$values.applicant_phone}{/if}</td>
			</tr>
		</table>
	</td>
</tr>
</table>

<br/><br/>
<h1><i>Повідомлення про подію</i></h1>
<p align="center" style="font-weight: bold; font-style: italic;">від {$values.owner_types_title}</p>
<p align="center" style="font-weight: bold; font-style: italic;">по 
	{if $values.policies_kasko_id > 0}договору КАСКО № {$values.policies_kasko_number} від {$values.policies_kasko_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.{/if}
	{if $values.policies_kasko_id > 0 && $values.policies_go_id > 0} та {/if}
	{if $values.policies_go_id > 0}полісу ОСЦПВ № {$values.policies_go_number} від {$values.policies_go_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.{/if}
</p>

<p style="text-indent: 10; font-weight: bold;">
Повідомляю Вас про те, що {$values.datetime_format} за адресою: {$values.address} відбулася дорожньо-транспортна пригода:
</p>

<p style="text-indent: 10; font-weight: bold;">
Ризик,тип події,ступінь тяжкості наслідків:
</p>
{if $values.owner_types_id == 1}
<table width="100%">
	<tr>
		<td class="all">
			{$values.application_risks_title}
		</td>
	</tr>
</table>
<br/>

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="all" colspan="8"><b>Транспортний засіб</b></td>
	</tr>
	<tr>
		<td class="left right bottom" width="15%" align="center"><b>Тип ТЗ:</b></td>
		<td class="right bottom" width="15%" align="center">{if $values.policies_kasko_id > 0}{$values.car_types_kasko_title}{else}{$values.car_types_go_title}{/if}</td>
		<td class="right bottom" align="center"><b>Марка:</b></td>
		<td class="right bottom" align="center">{if $values.policies_kasko_id > 0}{$values.kasko_brand}{else}{$values.go_brand}{/if}</td>
		<td class="right bottom" align="center"><b>Модель:</b></td>
		<td class="right bottom" align="center">{if $values.policies_kasko_id > 0}{$values.kasko_model}{else}{$values.go_model}{/if}</td>
		<td class="right bottom" width="15%" align="center"><b>Державний реєстраційний номер:</b></td>
		<td class="right bottom" align="center">{if $values.policies_kasko_id > 0}{$values.kasko_sign}{else}{$values.go_sign}{/if}</td>
	</tr>
	<tr>
		<td class="left right bottom" colspan="8">
			<b>Пошкодження:</b> {$values.damage}
		</td>
	</tr>
</table>
<br/>
{/if}

{if $values.owner_types_id == 2}
<table width="100%">
	<tr>
		<td class="all">
			ДТП
		</td>
	</tr>
</table>
<br/>

<table width="100%">
	<tr>
		<td width="10%">Потерпіла сторона</td>
		<td class="all">{$values.victim.name}</td>
	</tr>
</table>
<br/>

<table width="100%">
	{if $values.victim.car.flag == 1}
		<tr>
			<td colspan="2">
				<table cellspacing=0 cellpadding=0 width="100%" style="background-color: #abc5c5">
					<tr>
						<td class="all" width="10%"><i><b>Транспортний засіб</b></i></td>
						<td class="top right bottom" width="5%" align="center"><b>Тип ТЗ:</b></td>
						<td class="top right bottom" width="10%" align="center">{$values.victim.car.data.car_type_title}</td>
						<td class="top right bottom" width="5%" align="center"><b>Марка:</b></td>
						<td class="top right bottom" width="30%" align="center">{$values.victim.car.data.brand}</td>
						<td class="top right bottom" width="5%" align="center"><b>Модель:</b></td>
						<td class="top right bottom" width="20%" align="center">{$values.victim.car.data.model}</td>
						<td class="top right bottom" width="10%" align="center"><b>Державний номер:</b></td>
						<td class="top right bottom" width="5%" align="center">{$values.victim.car.data.sign}</td>
					</tr>
					<tr>
						<td class="left right bottom"><b>Пошкодження:</b></td>
						<td class="bottom right" colspan="8">{$values.victim.car.data.damage}</td>
					</tr>
				</table>
			</td>
		</tr>
	{/if}
	{if $values.victim.property.flag == 1}
		<tr>
			<td colspan="2">
				<table cellspacing=0 cellpadding=1 width="100%" style="background-color: #adc2b5">
					<tr>
						<td class="all" width="10%"><i><b>Майно</b></i></td>
						<td class="top bottom right" width="5%" align="center"><b>Назва:</b></td>
						<td class="top bottom right" width="20%" align="center">{$values.victim.property.data.name}</td>
						<td class="top bottom right" width="5%" align="center"><b>адреса:<b></td>
						<td class="top bottom right" width="20%" align="center">{$values.victim.property.data.address}</td>
						<td class="top bottom right" width="5%" align="center"><b>пошкодження:</b></td>
						<td class="top bottom right" width="35%" align="center">{$values.victim.property.data.damage}</td>
					</tr>
				</table>
			</td>
		</tr>
	{/if}
	{if $values.victim.life.flag == 1}
		<tr>
			<td colspan="2">
				<table cellspacing=0 cellpadding=1 width="100%" style="background-color: #afb8c0">
					<tr>
						<td class="all" width="10%"><i><b>Життя/здоров'я</b></i></td>
						<td class="top bottom right" width="10%"><b>Ступінь ушкоджень:</b></td>
						<td class="top bottom right" width="20%">{$values.victim.life.data.damage_title}</td>
						<td class="top bottom right" width="5%"><b>ушкодження:</b></td>
						<td class="top bottom right" width="55%">{$values.victim.life.data.damage}</td>
					</tr>
				</table>
			</td>
		</tr>
	{/if}
</table>
<br/>

{/if}

<table width="100%">
	<tr>
		<td class="bottom"><b>Опис події, обставини:</b></td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom">&nbsp;</td>
	</tr>
</table>

<br/>

<h2><i>Схематичне зображення місця події</i></h2>
<p class="sub">(схема ділянки дороги(перехрестя), назва вулиць, траєкторія руху, місце зіткнення, дорожні знаки, орієнтири тощо)</p>
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
</table>
<br/>

<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Чи було складено європротокол:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.europrotocol == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.europrotocol != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="5%"></td>
		{if $values.europrotocol == 1}
			<td width="15%" class="all" align="center">Схема ДТП</td>
			<td class="top bottom right" align="center">схема {$values.accident_schemes_id}</td>
		{else}
			<td width="40%"></td>
		{/if}
	</tr>
</table>
<br/>


{if $values.europrotocol == 1}
	<table width="100%" cellspacing="0">
		<tr>
			<td width="15%" class="all">Страховик іншого учасника</td>
			<td width="20%" class="top bottom right" align="center">{$values.applicant_insurer_company}</td>
			<td width="5%"></td>
			<td width="10%" class="all" align="center">серія</td>
			<td width="10%" class="top bottom right" align="center">{$values.applicant_policies_series}</td>
			<td width="5%"></td>
			<td width="15%" class="all" align="center">номер</td>
			<td width="20%" class="top bottom right" align="center">{$values.applicant_policies_number}</td>
		</tr>
	</table><br/>
{/if}

<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Про подію було повідомлено в компетентні органи:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.competent_authorities == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.competent_authorities != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="5%"></td>
		{if $values.competent_authorities == 1}
			<td width="10%" class="all" align="center">назва</td>
			<td class="top bottom right" align="center">{$values.mvs_title}</td>
		{else}
			<td width="40%"></td>
		{/if}
	</tr>	
</table>
<br/>

{if $values.competent_authorities == 1}
	<table width="100%" cellspacing="0">
		<tr>
			<td width="60%">&nbsp;</td>
			<td width="10%" class="all" align="center">дата</td>
			<td width="30%" class="top bottom right" align="center">{$values.mvs_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		</tr>
	</table><br/>
{/if}

<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Чи було складено адміністративний протокол:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.administrativeprotocol == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.administrativeprotocol != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="5%"></td>
		{if $values.administrativeprotocol == 1}
			<td width="8%" class="all" align="center">Серія</td>
			<td width="8%" class="all" align="center">{$values.administrative_protocol_series}</td>
			<td width="8%" class="all" align="center">Номер</td>
			<td class="top bottom right" align="center">{$values.administrative_protocol_number}</td>
		{else}
			<td width="40%"></td>
		{/if}
	</tr>
</table>
<br/>

<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Чи були внесені відомості про подію до ЄДРДР:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.unifiedstateregister == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.unifiedstateregister != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="45%"></td>
	</tr>
</table>
<br/>

<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Чи було відкрито кримінальне провадження:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.criminal == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.criminal != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="5%"></td>
		{if $values.criminal == 1}
			<td rowspan="2" width="10%" class="all" align="center">орган досудового розслідування</td>
			<td rowspan="2" class="top bottom right" align="center">{$values.criminal_name}</td>
		{else}
			<td width="40%"></td>
		{/if}
	</tr>
    {if $values.criminal == 1}
        <tr><td colspan=7"">&nbsp;</td></tr>
    {/if}
</table>
<br/>

{if $values.owner_types_id == 1}
	<table width="100%" cellspacing="0">
		<tr>
			<td width="30%"><b>Чи було повідомлено в диспечерський центр страховика:</b></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.assistance == 1}X{/if}</td>
			<td width="5%" align="center">так</td>
			<td width="5%"></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.assistance != 1}X{/if}</td>
			<td width="5%" align="center">ні</td>
			<td width="45%"></td>
		</tr>
	</table>
	<br/>

	{if $values.assistance == 1}
		<table width="100%" cellspacing="0">
			<tr>
				<td width="30%"><b>з місця пригоди:</b></td>
				<td width="5%" class="all" align="center">&nbsp;{if $values.assistance_place == 1}X{/if}</td>
				<td width="5%" align="center">так</td>
				<td width="5%"></td>
				<td width="5%" class="all" align="center">&nbsp;{if $values.assistance_place != 1}X{/if}</td>
				<td width="5%" align="center">ні</td>
				<td width="5%"></td>
				{if $values.assistance_place != 1}
					<td width="10%" class="all" align="center">дата:</td>
					<td class="top bottom right" align="center">{$values.assistance_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</td>
				{else}
					<td width="40%"></td>
				{/if}
			</tr>
		</table>
		<br/>
	{/if}
{/if}

{if $values.owner_types_id == 1 || $values.victim.car.flag == 1}
<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Чи надано авто для огляду:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.inspecting_car == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.inspecting_car != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="5%"></td>
		{if $values.inspecting_car == -1}
			<td rowspan="2" width="10%" class="all" align="center">фактична адреса місцезнаходження ТЗ:</td>
			<td rowspan="2" class="top bottom right" align="center">{$values.inspecting_car_place}</td>
		{else}
			<td width="40%"></td>
		{/if}
	</tr>
    {if $values.inspecting_car == -1}
        <tr><td colspan=7"">&nbsp;</td></tr>
    {/if}
</table>
<br/>
{/if}

{if $values.victim.property.flag == 1}
<table width="100%" cellspacing="0">
	<tr>
		<td width="30%"><b>Чи надано майно для огляду:</b></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.inspecting_property == 1}X{/if}</td>
		<td width="5%" align="center">так</td>
		<td width="5%"></td>
		<td width="5%" class="all" align="center">&nbsp;{if $values.inspecting_property != 1}X{/if}</td>
		<td width="5%" align="center">ні</td>
		<td width="5%"></td>
		{if $values.inspecting_property == 1}
			<td width="10%" class="all" align="center">адреса:</td>
			<td class="top bottom right" align="center">{$values.inspecting_property_place}</td>
		{else}
			<td width="40%"></td>
		{/if}
	</tr>
</table>
<br/>
{/if}

<table width="100%" cellspacing="0">
	<tr>
		<td width="10%"><b>Водій на момент ДТП:</b></td>
		<td colspan="9">{$values.driver}</td>
	</tr>
</table>
</br>

{if $values.participants|@count > 0 && $values.participants != false}
{assign var=number value=1}
<b>Інші учасники:</b>
<table width="100%" cellspacing=0 cellpadding=5>
	{section name=participant loop=$values.participants}
		{if $number==1}
			<tr>
				<td width="15%"><b>Учасник пригоди {$number}.</b></td>
				<td>{$values.participants[participant].name}</td>
			</tr>
			{if $values.participants[participant].car.flag == 1}
				<tr>
					<td colspan="2">
						<table cellspacing=0 cellpadding=0 width="100%" style="background-color: #abc5c5">
							<tr>
								<td class="all" width="10%"><i><b>Транспортний засіб</b></i></td>
								<td class="top right bottom" width="5%" align="center"><b>Тип ТЗ:</b></td>
								<td class="top right bottom" width="10%" align="center">{$values.participants[participant].car.data.car_type_title}</td>
								<td class="top right bottom" width="5%" align="center"><b>Марка:</b></td>
								<td class="top right bottom" width="30%" align="center">{$values.participants[participant].car.data.brand}</td>
								<td class="top right bottom" width="5%" align="center"><b>Модель:</b></td>
								<td class="top right bottom" width="20%" align="center">{$values.participants[participant].car.data.model}</td>
								<td class="top right bottom" width="10%" align="center"><b>Державний номер:</b></td>
								<td class="top right bottom" width="5%" align="center">{$values.participants[participant].car.data.sign}</td>
							</tr>
							<tr>
								<td class="left right bottom"><b>Пошкодження:</b></td>
								<td class="bottom right" colspan="8">{$values.participants[participant].car.data.damage}</td>
							</tr>
						</table>
					</td>
				</tr>
			{/if}
			{if $values.participants[participant].property.flag == 1}
				<tr>
					<td colspan="2">
						<table cellspacing=0 cellpadding=1 width="100%" style="background-color: #adc2b5">
							<tr>
								<td class="all" width="10%"><i><b>Майно</b></i></td>
								<td class="top bottom right" width="5%" align="center"><b>Назва:</b></td>
								<td class="top bottom right" width="20%" align="center">{$values.participants[participant].property.data.name}</td>
								<td class="top bottom right" width="5%" align="center"><b>адреса:<b></td>
								<td class="top bottom right" width="20%" align="center">{$values.participants[participant].property.data.address}</td>
								<td class="top bottom right" width="5%" align="center"><b>пошкодження:</b></td>
								<td class="top bottom right" width="35%" align="center">{$values.participants[participant].property.data.damage}</td>
							</tr>
						</table>
					</td>
				</tr>
			{/if}			
			{if $values.participants[participant].life.flag == 1}
				<tr>
					<td colspan="2">
						<table cellspacing=0 cellpadding=1 width="100%" style="background-color: #afb8c0">
							<tr>
								<td class="all" width="10%"><i><b>Життя/здоров'я</b></i></td>
								<td class="top bottom right" width="10%"><b>Ступінь ушкоджень:</b></td>
								<td class="top bottom right" width="15%">{$values.participants[participant].life.data.damage_title}</td>
								<td class="top bottom right" width="5%"><b>ушкодження:</b></td>
								<td class="top bottom right" width="60%">{$values.participants[participant].life.data.damage}</td>
							</tr>
						</table>
					</td>
				</tr>
			{/if}
		{else}
			<tr>
				<td width="15%"><b>Учасник пригоди {$number}.</b></td>
				<td>{$values.participants[participant].name}</td>
			</tr>
			{if $values.participants[participant].car.flag == 1}
				<tr>
					<td colspan="2">
						<table cellspacing=0 cellpadding=0 width="100%" style="background-color: #abc5c5">
							<tr>
								<td class="all" width="10%"><i><b>Транспортний засіб</b></i></td>
								<td class="top right bottom" width="5%" align="center"><b>Тип ТЗ:</b></td>
								<td class="top right bottom" width="10%" align="center">{$values.participants[participant].car.data.car_type_title}</td>
								<td class="top right bottom" width="5%" align="center"><b>Марка:</b></td>
								<td class="top right bottom" width="30%" align="center">{$values.participants[participant].car.data.brand}</td>
								<td class="top right bottom" width="5%" align="center"><b>Модель:</b></td>
								<td class="top right bottom" width="20%" align="center">{$values.participants[participant].car.data.model}</td>
								<td class="top right bottom" width="10%" align="center"><b>Державний номер:</b></td>
								<td class="top right bottom" width="5%" align="center">{$values.participants[participant].car.data.sign}</td>
							</tr>
							<tr>
								<td class="left right bottom"><b>Пошкодження:</b></td>
								<td class="bottom right" colspan="8">{$values.participants[participant].car.data.damage}</td>
							</tr>
						</table>
					</td>
				</tr>
			{/if}
			{if $values.participants[participant].property.flag == 1}
				<tr>
					<td colspan="2">
						<table cellspacing=0 cellpadding=1 width="100%" style="background-color: #adc2b5">
							<tr>
								<td class="all" width="10%"><i><b>Майно</b></i></td>
								<td class="top bottom right" width="5%" align="center"><b>Назва:</b></td>
								<td class="top bottom right" width="20%" align="center">{$values.participants[participant].property.data.name}</td>
								<td class="top bottom right" width="5%" align="center"><b>адреса:<b></td>
								<td class="top bottom right" width="20%" align="center">{$values.participants[participant].property.data.address}</td>
								<td class="top bottom right" width="5%" align="center"><b>пошкодження:</b></td>
								<td class="top bottom right" width="35%" align="center">{$values.participants[participant].property.data.damage}</td>
							</tr>
						</table>
					</td>
				</tr>
			{/if}
			{if $values.participants[participant].life.flag == 1}
				<tr>
					<td colspan="2">
						<table cellspacing=0 cellpadding=1 width="100%" style="background-color: #afb8c0">
							<tr>
								<td class="all" width="10%"><i><b>Життя/здоров'я</b></i></td>
								<td class="top bottom right" width="10%"><b>Ступінь ушкоджень:</b></td>
								<td class="top bottom right" width="15%">{$values.participants[participant].life.data.damage_title}</td>
								<td class="top bottom right" width="5%"><b>ушкодження:</b></td>
								<td class="top bottom right" width="60%">{$values.participants[participant].life.data.damage}</td>
							</tr>
						</table>
					</td>
				</tr>
			{/if}
		{/if}
		<tr><td colspan="2">&nbsp;</td></tr>
	{assign var=number value=$number+1}
	{/section}
</table>
<br/>
{/if}

{if $values.competent_authorities != 1 && $values.europrotocol != 1}
	<table cellpadding=0 cellspacing=0 width="100%">
		<tr>
			<td nowrap><b>Чому не було повідомлено про подію в компетентні органи?</b></td>
			<td class="bottom" width="100%">&nbsp;</td>
		</tr>
		<tr>
			<td class="bottom" width="100%" colspan="2">&nbsp;</td>
		</tr>
	</table><br/>
{/if}

{if $values.owner_types_id == 1 && $values.assistance != 1}
	<table cellpadding=0 cellspacing=0 width="100%">
		<tr>
			<td nowrap><b>Чому не було повідомлено в диспетчерський центр Страховика?</b></td>
			<td class="bottom" width="100%">&nbsp;</td>
		</tr>
		<tr>
			<td class="bottom" width="100%" colspan="2">&nbsp;</td>
		</tr>
	</table><br/>
{/if}

{if $values.assistance == 1 && $values.assistance_place != 1}
	<table cellpadding=0 cellspacing=0 width="100%">
		<tr>
			<td nowrap><b>Чому було повідомлено в диспетчерський центр Страховика не з місця пригоди?</b></td>
			<td class="bottom" width="100%">&nbsp;</td>
		</tr>
		<tr>
			<td class="bottom" width="100%" colspan="2">&nbsp;</td>
		</tr>
	</table><br/>
{/if}

<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td nowrap><b>Чи приймав раніше Ваш транспортний засіб участь у ДТП?</b></td>
		<td class="bottom" width="100%">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>

<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td nowrap><b>Чи мав Ваш транспортний засіб пошкодження до даної пригоди?</b></td>
		<td class="bottom" width="100%">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>

<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td nowrap><b>Чи вживали Ви перед пригодою напої або речовини, що містять алкоголь, наркотики, токсичні або лікарськи препарати?</b></td>
		<td class="bottom" width="100%">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>

<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td nowrap><b>Чи є свідки події? Якщо є, то вказати їх (П.І.Б., адреса, номери телефонів)</b></td>
		<td class="bottom" width="100%">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>

{if $values.owner_types_id == 2}
<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td nowrap><b>Інформація про здійснені взаєморозрахунки між Страхувальником та Потерпілою особою</b></td>
		<td class="bottom" width="100%">&nbsp;</td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>

<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td width="100%" colspan="2"><b>Чи застрахований Ваш автомобіль по програмі КАСКО? Якщо так, то вказати назву страхової компанії, номер договору, дату укладання.</b></td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>

<table cellpadding=0 cellspacing=0 width="100%">
	<tr>
		<td width="100%" colspan="2"><b>Чи застраховані Ви по договору ОСЦПВВНТЗ? Якщо так, то вказати назву страхової компанії, серію та номер полісу, дату укладання.</b></td>
	</tr>
	<tr>
		<td class="bottom" width="100%" colspan="2">&nbsp;</td>
	</tr>
</table><br/>
{/if}

{if $values.documents|@count > 0 && $values.documents != false}
{assign var=number value=1}
<table width="100%" cellspacing=0 cellpadding=5>
	{section name=document loop=$values.documents}
		{if $number==1}
			<tr>
				<td rowspan="{$values.documents|@count}" style="vertical-align: top;"><b>До повідомлення додаються:</b></td>
				<td>{$number}. {if $values.documents[document].id > 0}{$values.documents[document].title}{else}{$values.documents[document]}{/if}</td>
			</tr>
		{else}
			<tr>
				<td>{$number}. {if $values.documents[document].id > 0}{$values.documents[document].title}{else}{$values.documents[document]}{/if}</td>
			</tr>
		{/if}
	{assign var=number value=$number+1}
	{/section}
</table>
<br/>
{/if}

<p style="text-indent: 10; font-style: italic; text-align: justify;">
Достовірність всієї інформації в цій заяві підтверджую.
</p>
<br/>
<p style="text-indent: 10; font-style: italic; text-align: justify;">
Надаю ТДВ "Експрес-Страхування (надалі Страховик) свою згоду на внесення моїх пересональних даних ( в тому числі паспорнх даних,ідентифікаційного номеру, даних щодо місця проживання,місця реєстрації,номери засобів зв,язку,адреси електронної пошти,реквізити банківського рахунку,інших даних,які надаються мною аба будут отримані Страховиком з метою реалізації мети обробки) до бази даних,що ведеться Страховиком і посвідчую, що належним чином повідомлений про факт внесення моїх персональних даних в таку базу для ії подальшої обробки у будь-який спосіб. При цьому підтверджую, що належним чином повідомлений про свої права,визначені "Законом про захист персональних даних" та мету збору даних-врегулювання заявленої події для прийняття рішення щодо здійснення страхового відшкодування,реалізація інших видносин  у сфері страхування,адміністративно-правових відносин,податкових відносин,відносин у сфері бухгалтерського обліку,відносин у сфері обліку та звітності.
</p>
<br/>
<p style="text-indent: 10; font-style: italic; text-align: justify;">
Дана згода є безстроковою та не потребує письмових повідомлень про зміну чи знищення пересональних даних або обмеження доступу до них,передачу даних третім особам.
</p>
<br/>

<br/><br/>

<table width="100%">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="30%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td>{$values.created_format}</td>
		<td width="5%">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td width="30%"><b>Заявник:</b></td>
		<td width="5%">&nbsp;</td>
		<td width="30%" class="bottom">&nbsp;</td>
		<td width="5%" align="right">/</td>
		<td class="bottom">&nbsp;</td>
		<td width="5%">/</td>
	</tr>
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="30%" class="sub">(підпис)</td>
		<td width="5%">&nbsp;</td>
		<td class="sub">(ПІБ)</td>
		<td width="5%">&nbsp;</td>
	</tr>
</table>
{php} if (!is_null($this->_tpl_vars['values']['kasko_brand'])) { {/php}
<div style="page-break-after: always"></div>

<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="227" id="company{$values.companies_id}"><img src="http://{$smarty.server.HTTP_HOST}/images/pixel.gif" width="227" height="105" /></td>
	<td align="right">
		<p>ТДВ "Експрес Страхування"</p>
		<p>01004, м. Київ, вул. Велика Васильківська, буд. 15/2</p>
		<p>Тел/факс: 594-87-00/02<p>
	</td>
</tr>
</table><br />

<h1>Пам`ятка</h1><br /><br />

<p>Страхувальнику (власнику, довіреній особі) пошкодженого транспортного засобу щодо отримання страхового відшкодування за Договором добровільного страхування наземних транспортних засобів.</p>
<p>Залежно від характеру та обставин страхового випадку, настання страхового випадку та розмір збитків має бути підтверджено наступними документами:</p><br />
<p>У разі пошкодження транспортного засобу, ризик «{$values.application_risks_title}»:</p><br />

<p>Документи отримані страховою компанією:</p>
<ul>
    {php} if (in_array(19, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Громадянський паспорт (Страхувальника, Власника (копії 1,2,3, 12стор.)'; {/php}
    {php} if (in_array(55, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Довідка органів МВС, ДАІ (форма 1)'; {/php}
    {php} if (in_array(1, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Заява на страхування транспортного засобу'; {/php}
    {php} if (in_array(154, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Заява про порядок виплати страхового відшкодування'; {/php}
    {php} if (in_array(72, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Ідентифікаційний номер (Страхувальника, Власника)'; {/php}
    {php} if (in_array(153, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Копія договіру страхування КАСКО'; {/php}
    {php} if (in_array(13, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Посвідчення водія, талон до посвідчення водія, особи, яка керувала транспортним засобом'; {/php}
    {php} if (in_array(62, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Протокол ДАІ про адміністративне правопорушення'; {/php}
    {php} if (in_array(63, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Протокол огляду'; {/php}
    {php} if (in_array(12, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Реєстраційний талон (техпаспорт)'; {/php}
    {php} if (in_array(15, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Тимчасовий реєстраційний талон'; {/php}
    {php} if (in_array(36, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Фото пошкодженого ТЗ'; {/php}
	{php} foreach ($this->_tpl_vars['values']['additional_documents'] as $doc) echo 'li'.$doc {/php}
</ul><br /><br />

<p>Документи, які необхідно отримати страховою компанією для подальшого розгляду справи:</p>
<ul>
	{php} if (in_array($this->_tpl_vars['values']['application_risks_id'], array(1,4,5)) && in_array($this->_tpl_vars['values']['competent_authorities_id'], array(1,2,3,4))) echo '<li>Довідка органів МВС, ДАІ (форма 2)'; {/php}
    {php} if (!in_array(63, $this->_tpl_vars['values']['product_document_types_ids']) && in_array($this->_tpl_vars['values']['application_risks_id'], array(1,2,3,4,5,6))) echo '<li>Протокол огляду'; {/php}
    {php} if (!in_array(36, $this->_tpl_vars['values']['product_document_types_ids']) && in_array($this->_tpl_vars['values']['application_risks_id'], array(1,2,3,4,5,6))) echo '<li>Фото пошкодженого ТЗ'; {/php}
    {php} if ($this->_tpl_vars['values']['financial_institutions_id'] > 0) echo '<li>Заява(лист) вигодонабувача про порядок виплати страхового відшкодування'; {/php}
	<li>Рахунок-фактура (калькуляція)
</ul><br /><br />

Документи, які необхідно надати страхувальнику для подальшого розгляду справи:
<ul>
    {php} if (!in_array(19, $this->_tpl_vars['values']['product_document_types_ids']) && (in_array($this->_tpl_vars['values']['application_risks_id'], array(1,2,3,4,5,6)) || $this->_tpl_vars['values']['application_risks_id'] == 7 && in_array($this->_tpl_vars['values']['competent_authorities_id'], array(1,2,3,4)) ) ) echo '<li>Громадянський паспорт (Страхувальника, Власника (копії 1,2,3, 12стор.)'; {/php}
    {php} if (!in_array(55, $this->_tpl_vars['values']['product_document_types_ids']) && in_array($this->_tpl_vars['values']['application_risks_id'], array(1,4,5)) && in_array($this->_tpl_vars['values']['competent_authorities_id'], array(1,2,3,4))) echo '<li>Довідка органів МВС, ДАІ (форма 1) (у разі наявності)'; {/php}
    {php} if (false && !in_array(1, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Заява на страхування транспортного засобу'; {/php}
    {php} if (!in_array(154, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Заява про порядок виплати страхового відшкодування'; {/php}
    {php} if (!in_array(72, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Ідентифікаційний номер (Страхувальника, Власника)'; {/php}
    {php} if (false && !in_array(153, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Копія договіру страхування КАСКО'; {/php}
    {php} if (false && !in_array(13, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Посвідчення водія, талон до посвідчення водія, особи, яка керувала транспортним засобом'; {/php}
    {php} if (!in_array(62, $this->_tpl_vars['values']['product_document_types_ids']) && in_array($this->_tpl_vars['values']['application_risks_id'], array(1)) && in_array($this->_tpl_vars['values']['competent_authorities_id'], array(1,2,3,4)) ) echo '<li>Протокол ДАІ про адміністративне правопорушення (у разі наявності)'; {/php}
    {php} if (!in_array(63, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Протокол огляду'; {/php}
    {php} if (!in_array(12, $this->_tpl_vars['values']['product_document_types_ids']) && in_array($this->_tpl_vars['values']['application_risks_id'], array(1,2,3,4,5,6,7))) echo '<li>Реєстраційний талон (техпаспорт)'; {/php}
    {php} if (!in_array(15, $this->_tpl_vars['values']['product_document_types_ids']) && in_array($this->_tpl_vars['values']['competent_authorities_id'], array(1,2,3,4))) echo '<li>Тимчасовий реєстраційний талон (у разі наявності)'; {/php}
    {php} if (!in_array(36, $this->_tpl_vars['values']['product_document_types_ids'])) echo '<li>Фото пошкодженого ТЗ'; {/php}
</ul><br /><br />

<p><b>Інші документи, які дають змогу встановити розмір збитків, що підлягають відшкодуванню, обставини настання страхового випадку та дають право Страховику на регресні вимоги до винних осіб.</b></p><br />

<p>Ремонт Вашого автомобіля й розрахунок суми страхового відшкодування здійснюється відповідно до умов, які Ви обрали в Договорі страхування.</p><br />
<p>Партнерська СТО ТДВ «Експрес Страхування» складе рахунок про вартість відновлювального ремонту Вашого транспортного засобу та надасть його до ТДВ «Експрес Страхування». Після отримання інформації про суму відновлювального ремонту від партнерської СТО, ТДВ «Експрес Страхування» здійснить розрахунок та виплату відшкодування.</p><br />
<p>ВИПЛАТА страхового відшкодування здійснюється Страховиком у строк передбачений умовами Договору страхування, починаючи з дня одержання письмової заяви Страхувальника про виплату страхового відшкодування (встановленої форми), оформлену належним чином. Якщо даного строку виявилося недостатньо для з’ясування обставин, що впливають на визначення відповідальності Страховика, страхове відшкодування сплачується відповідно до умов Договору страхування від дати отримання останнього документу, необхідного для з’ясування обставин страхового випадку та/або розміру збитку.</p><br />
<p>Для отримання додаткової інформації стосовно справи щодо відшкодування збитків за Вашим страховим випадком зателефонуйте до цілодобового Контакт-центру ТДВ «Експрес Страхування» за номерами:<br />
<ul>
    <li><b>0 800 502 300</b> (безкоштовно зі стаціонарних телефонів в Україні)
    <li><b>(044) 594 87 00</b>
</ul>
<p>та обов’язково повідомте спеціалісту Контакт-центру номер Вашого Договору страхування, реєстраційний номер застрахованого автомобіля, або номер справи.</p><br />

<p><b>Підтверджую, що наведена в цій пам’ятці інформація щодо всіх дій, необхідних для отримання страхового відшкодування роз’яснена мені належним чином.</b></p>

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
<tr>
	<td width="50%">{$values.created_format}</td>
	<td width="50%" align="right">«____________________________________»  _____________</td>
</tr>
</table>
{php} } {/php}
</body>
</html>