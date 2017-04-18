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
	<td>Назва</td>
	<td>Код ЄДРПОУ</td>
	<td>Посада, ПІБ у називному відмінку</td>
	<td>Посада, ПІБ у родовому відмінку</td>
	<td>Адреса</td>
	<td>Телефони</td>
	<td>Банківські реквизити</td>
    <td>Акт, діє на підставі</td>

</tr>
{/literal}
{section name="roll" loop=$list}
<tr>
	<td>{$list[roll].title}</td>
	<td>{$list[roll].edrpou}</td>
	<td>{$list[roll].director1}</td>
	<td>{$list[roll].director2}</td>
	<td>{$list[roll].address}</td>
	<td>{$list[roll].phones}</td>
	<td>{$list[roll].banking_details}</td>
	<td>{$list[roll].ground_akt}</td>
	
</tr>
{/section}
</table>
</body>
</html>