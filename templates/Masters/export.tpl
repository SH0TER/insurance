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
	<td>СТО</td>
	<td>Логін</td>
	<td>Пароль</td>
	<td>Прізвище</td>
	<td>Ім'я</td>
	<td>Телефон</td>
	<td>Факс</td>
	<td>Мобільний</td>
	<td>E-mail</td>
	<td>Активний</td>
</tr>
{/literal}
{section name="roll" loop=$list}
<tr>
	<td>{$list[roll].car_servicesCode}</td>
	<td>{$list[roll].car_services_title}</td>
	<td x:str>{$list[roll].login}</td>
	<td>{$list[roll].password}</td>
	<td>{$list[roll].lastname}</td>
	<td>{$list[roll].firstname}</td>
	<td>{$list[roll].phone}</td>
	<td>{$list[roll].fax}</td>
	<td>{$list[roll].mobile}</td>
	<td>{$list[roll].email}</td>
	<td>{if $list[roll].active}так{else}ні{/if}</td>
</tr>
{/section}
</table>
</body>
</html>