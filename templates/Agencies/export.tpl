{literal}
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
<style>
* {
	font-size: 11px;
	font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
}
.columns TD {
	height: 25px;
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background-color: #008575;
}
</style>
</head>
<body>
<table border="1" cellpadding=0 cellspacing=0>
<tr class="columns">
	<td>Код</td>
	<td>Назва</td>
	<td>Код ЄДРПОУ</td>
	<td>Посада, ПІБ у називному відмінку</td>
	<td>Посада, ПІБ у родовому відмінку</td>
	<td>Адреса</td>
	<td>Телефони</td>
	<td>Договір КАСКО, діє на підставі</td>
    <td>Акт, діє на підставі</td>
	<td>Номер агенського договору</td>
    <td>Дата агенського договору</td>
	<td>Банкiвськi реквізити</td>
    <td>Код дирекції НАСК "Оранта"</td>
	<td>Номер агенського договору НАСК "Оранта"</td>
	<td>Дата агенського договору НАСК "Оранта"</td>
	<td>Область</td>
	<td>Активний</td>
	<td>Акти директор</td>
	<td>Акти заст. директора</td>
	<td>Акти заст. директора сервiс</td>
</tr>
{/literal}
{section name="roll" loop=$list}
<tr>
	<td x:str>{$list[roll].code}</td>
	<td>{$list[roll].title}</td>
	<td>{$list[roll].edrpou}</td>
	<td>{$list[roll].director1}</td>
	<td>{$list[roll].director2}</td>
	<td>{$list[roll].address}</td>
	<td>{$list[roll].phones}</td>
	<td>{$list[roll].ground_kasko}</td>
	<td>{$list[roll].ground_akt}</td>
	<td>{$list[roll].agreement_number}</td>
	<td>{$list[roll].agreement_date|date_format:$smarty.const.DATE_FORMAT}</td>
    <td>{$list[roll].bank}{if $list[roll].bank_mfo} МФО:{$list[roll].bank_mfo}{/if}{if $list[roll].bank_account} р/р у банку:{$list[roll].bank_account}{/if}</td>
    <td>{$list[roll].codeOranta}</td>
	<td>{$list[roll].agreement_number_oranta}</td>
	<td>{$list[roll].agreement_dateOranta|date_format:$smarty.const.DATE_FORMAT}</td>
	<td>{$list[roll].regionsTitle}</td>
	<td>{if $list[roll].active}так{else}ні{/if}</td>
	<td>{$list[roll].director1_akt}</td>
	<td>{$list[roll].director2_akt}</td>
	<td>{$list[roll].director3_akt}</td>
</tr>
{/section}
</table>
</body>
</html>