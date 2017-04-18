<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Дзвінок-повідомлення про подію</title>
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
                    <td class="bottom" align="center">{$values.creator_lastname} {$values.creator_firstname|truncate:2:'':true}. {$values.creator_patronymicname|truncate:2:'':true}.</td>
                </tr>
                <tr>
                    <td class="sub">(П.І.Б працівника, який приймав заяву)</td>
                </tr>
                <tr>
                    <td align="center">{$values.created_format}</td>
                </tr>
                <tr>
                    <td align="center">№ повідомлення: {$values.application_calls_number}</td>
                </tr>
            </table>
        </td>
        <td width="30%">&nbsp;</td>
        <td style="vertical-align: top;">
            <table width="100%">
                <tr>
                    <td class="bottom" align="center"><b>{$values.applicant}</b></td>
                </tr>
                <tr>
                    <td class="sub">(П.І.Б страхувальника/заявника)</td>
                </tr>
                <tr>
                    <td class="bottom" align="center">{if $values.applicant_phone}тел. {$values.applicant_phone}{/if}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br/><br/>
<h1><i>Повідомлення про подію (телефоном)</i></h1>
<p align="center" style="font-weight: bold; font-style: italic;">від {$values.owner_types_title}</p>
<p align="center" style="font-weight: bold; font-style: italic;">по
    {if $values.policies_kasko_id > 0}договору КАСКО № {$values.policies_kasko_number} від {$values.policies_kasko_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.{/if}
    {if $values.policies_kasko_id > 0 && $values.policies_go_id > 0} та {/if}
    {if $values.policies_go_id > 0}полісу ОСЦПВ № {$values.policies_go_number} від {$values.policies_go_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.{/if}
</p>

<p style="text-indent: 10; font-weight: bold;">
    Повідомляю Вас про те, що {$values.datetime_format} за адресою: {$values.address} відбулася подія, що має ознаки страхової:
</p>

<p style="text-indent: 10; font-weight: bold;">
    Ризик, тип події:
</p>

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
		<td class="all" colspan="8"><b>Транспортний засіб страхувальника</b></td>
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


<table width="100%">
    <tr>
        <td><b>Опис події, обставини:</b></td>
    </tr>
    <tr>
        <td><u>{$values.description}</u></td>
    </tr>
</table>
<br/>

{if $values.making == 1}
	<table width="100%" cellspacing="0">
		<tr>
			<td width="30%"><b>Чи було складено європротокол:</b></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.making == 1}X{/if}</td>
			<td width="5%" align="center">так</td>
			<td width="5%"></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.making != 1}X{/if}</td>
			<td width="5%" align="center">ні</td>
			<td width="5%"></td>
			<td width="40%"></td>
		</tr>
	</table>
	<br/>
{/if}

{if $values.making == 1}
    <table width="100%" cellspacing="0">
        <tr>
            <td width="15%" class="all">Страховик іншого учасника</td>
            <td width="20%" class="top bottom right" align="center">{$values.europrotocol.applicant_insurer_company}</td>
            <td width="5%"></td>
            <td width="10%" class="all" align="center">серія</td>
            <td width="10%" class="top bottom right" align="center">{$values.europrotocol.applicant_policies_series}</td>
            <td width="5%"></td>
            <td width="15%" class="all" align="center">номер</td>
            <td width="20%" class="top bottom right" align="center">{$values.europrotocol.applicant_policies_number}</td>
        </tr>
    </table><br/>
{/if}

{if $values.making == 2}
	<table width="100%" cellspacing="0">
		<tr>
			<td width="30%"><b>Про подію було повідомлено в органи ДАІ:</b></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.making == 2}X{/if}</td>
			<td width="5%" align="center">так</td>
			<td width="5%"></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.making != 2}X{/if}</td>
			<td width="5%" align="center">ні</td>
			<td width="5%"></td>
			<td width="40%"></td>
		</tr>
	</table>
	<br/>
{/if}

{if $values.making == 2}
    <table width="100%" cellspacing="0">
        <tr>
            <td width="15%" class="all">Коментар:</td>
            <td width="85%" class="top bottom right" align="center">{$values.dai_reason}</td>
        </tr>
    </table><br/>
{/if}

{if $values.making == 3}
	<table width="100%" cellspacing="0">
		<tr>
			<td width="30%"><b>Про подію було повідомлено в органи МВС:</b></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.making == 3}X{/if}</td>
			<td width="5%" align="center">так</td>
			<td width="5%"></td>
			<td width="5%" class="all" align="center">&nbsp;{if $values.making != 3}X{/if}</td>
			<td width="5%" align="center">ні</td>
			<td width="5%"></td>
			<td width="40%"></td>
		</tr>
	</table>
	<br/>
{/if}

{if $values.making == 3}
    <table width="100%" cellspacing="0">
        <tr>
            <td width="15%" class="all">Коментар:</td>
            <td width="85%" class="top bottom right" align="center">{$values.mvs_reason}</td>
        </tr>
    </table><br/>
{/if}

{if $values.making == 4}
    <table width="100%" cellspacing="0">
        <tr>
            <td width="15%" class="all">Про подію було повідомлено в (інше):</td>
            <td width="85%" class="top bottom right" align="center">{$values.other_reason}</td>
        </tr>
    </table><br/>
{/if}

<table width="100%" cellspacing="0">
    <tr>
        <td width="30%"><b>Виклик швидкої допомоги:</b></td>
        <td width="5%" class="all" align="center">&nbsp;{if $values.ambulance == 1}X{/if}</td>
        <td width="5%" align="center">так</td>
        <td width="5%"></td>
        <td width="5%" class="all" align="center">&nbsp;{if $values.ambulance != 1}X{/if}</td>
        <td width="5%" align="center">ні</td>
        <td width="5%"></td>
        <td width="40%"></td>
    </tr>
</table>
<br/>

<table width="100%" cellspacing="0">
    <tr>
        <td width="30%"><b>Авто знаходиться на місці пригоди:</b></td>
        <td width="5%" class="all" align="center">&nbsp;{if $values.place == 1}X{/if}</td>
        <td width="5%" align="center">так</td>
        <td width="5%"></td>
        <td width="5%" class="all" align="center">&nbsp;{if $values.place != 1}X{/if}</td>
        <td width="5%" align="center">ні</td>
        <td width="5%"></td>
        <td width="40%"></td>
    </tr>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
	<tr>
		<td width="30%"><b>Повідомлено з адреси:</b></td>
		<td colspan="7" class="all">{$values.place_address}</td>
	</tr>
</table>
<br/>

<table width="100%" cellspacing="0">
    <tr>
        <td width="10%"><b>Водій на момент ДТП:</b></td>
        <td>{$values.driver}, <b>телефон:</b> {$values.driver_phone}</td>
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
                    <td width="15%"><b>Учасник пригоди {$number}. {$participant}</b></td>
                    <td>{$values.participants[participant].name}, <b>телефон</b> {$values.participants[participant].phone}</td>
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

<table width="100%" cellspacing="0">
    <tr>
        <td width="100%"><b>Заявника направлено на пункт прийому заяви:</b></td>
	</tr>
	<tr>
        <td width="100%" class="top bottom right left">{$values.car_services_title}</td>
    </tr>
</table>
</br>

<table width="100%" cellspacing="0">
    <tr>
        <td width="100%"><b>Коментар:</b></td>
	</tr>
	{if $values.comment}
	<tr>
        <td width="100%" class="top bottom right left">{$values.comment}</td>
    </tr>
	{/if}
</table>
</br>

<table width="100%" cellspacing="0">
    <tr>
        <td width="10%"><b>ID дзвінка:</b></td>
        <td colspan="9">{$values.calls_id}</td>
    </tr>
</table>
</br>

</body>
</html>