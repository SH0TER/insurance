<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Акт огляду ТЗ</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body>
<p align="center"><b>Акт огляду транспортного засобу</p>
<p align="center">Заповнюється представником Страховика</b></p>
<table width="100%" height="1400" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td width="20%" style="font-size:16px;">&nbsp;&nbsp;Місце огляду</td>
        <td width="80%"></td>
    </tr>
    <tr>
        <td width="20%" style="font-size:16px;">&nbsp;&nbsp;Дата огляду</td>
        <td width="80%"><pre>		_________________ 20______р.					час:</pre></td>
    </tr>
    <tr>
        <td width="20%" style="font-size:16px;">&nbsp;&nbsp;Представником ТДВ  «Експрес-страхування»</td>
        <td width="80%">
            <table height="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20%" colspan="4" class="bottom right"></td>
                    <td width="40%" colspan="8" class="bottom right">на підставі Договору страхування №</td>
                    <td width="20%" colspan="4" class="bottom"> {$values.number}</td>
                </tr>
                <tr>
                    <td width="15%" colspan="3" class="right">за адресою</td>
                    <td width="30%" colspan="6" class="right"></td>
                    <td width="15%" colspan="3" class="right">Проведено огляд ТЗ держ. номер:</td>
                    <td width="20%" colspan="4"> {$values.sign}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="100%" colspan="2" style="font-size:16px;">&nbsp;&nbsp;Пошкодження ТЗ (наявні пошкодження відмітити на схемі порядковим номером)</td>
    </tr>
    <tr>
        <td width="100%" colspan="2" align="center"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/act_car_photo.png" /></td>
    </tr>
    <tr>
        <td width="20%" style="font-size:16px;">&nbsp;&nbsp;Заключення огляду</td>
        <td>
            <table height="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20%" class="bottom right">Номер пошкодження</td>
                    <td width="60%" class="bottom">Характер пошкодження (якісна та кількісна характеристика пошкодження)</td>
                </tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="right"></td><td></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="30%" style="background-color: #CCCCCC; font-size:16px;">&nbsp;&nbsp;Протиугонні пристрої</td>
        <td>
            <table height="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="25%" class="bottom right">Найменування (марка, модель)</td>
                    <td width="45%" class="bottom">Характер пошкодження (якісна та кількісна характеристика пошкодження)</td>
                </tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="bottom right"></td><td class="bottom"></td></tr>
                <tr><td height="20" class="right"></td><td></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="30%" style="background-color: #CCCCCC; font-size:16px;">&nbsp;&nbsp;Додаткове обладнання (ДО)</td>
        <td>
            <table height="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="70%" colspan="2" class="bottom">ДО, що підлягає страхуванню згідно даної заяви на страхування, є у наявності та перебуває у робочому стані</td>
                </tr>
                <tr><td width="25%" class="bottom right">Наявність пошкоджень:</td><td class="bottom"></td></tr>
                <tr><td width="25%" class="right">Опис пошкоджень:</td><td></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="30%" style="font-size:16px;">&nbsp;&nbsp;Оригінали ключів від ТЗ</td>
        <td>
            <table height="100%" border="0" cellspacing="0" cellpadding="0">
                <tr><td width="25%" class="bottom right">Так/ні</td><td class="bottom"></td></tr>
                <tr><td width="25%" class="bottom right">Кількість ключів (скільки із скількох)</td><td class="bottom"></td></tr>
                <tr><td width="25%" class="right">Пояснення</td><td></td></tr>
            </table>
        </td>
    </tr>
	{if $values.financial_institutions_id==28}
	 <tr>
        <td width="30%" style="font-size:16px;">&nbsp;&nbsp;Стан майна          </td>
        <td>
            <table height="100%" border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
				<td class="" width="10%">&nbsp;&nbsp; </td><td width="20%" class="left">добрий</td>
				<td class="left" width="10%">&nbsp;&nbsp; </td><td width="20%" class="left">задовільний</td>
				<td class="left" width="10%">&nbsp;&nbsp; </td><td width="20%" class="left">незадовільний</td>
				
				</tr>
            </table>
        </td>
    </tr>
	{/if}
	
    <tr>
        <td colspan="2" style="font-size:16px;">&nbsp;&nbsp;Відомості, що зазначені в Заяві на страхування, перевірено та ідентифіковано</td>
    </tr>
    <tr>
        <td width="20%" style="font-size:16px;">&nbsp;&nbsp;Фотоматеріали з місця огляду ТЗ знаходяться за адресою:</td>
        <td></td>
    </tr>
    <tr>
        <td width="20%" style="font-size:16px;">&nbsp;&nbsp;В електронному вигляді в кількості</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шт.</td>
    </tr>
    <tr>
        <td colspan="2">
			<table height="100%" width="100%" border="0">
				<tr><td width="60%">Представник ТДВ  «Експрес-страхування»</td><td>__________________ /_______________ Дата ________</td></tr>
				<tr><td width="60%">Страхувальник {$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>__________________ /_______________ Дата ________</td></tr>
			</table>
        </td>
    </tr>
</table>
</body>
</html>