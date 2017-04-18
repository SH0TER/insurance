<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Інформаційний лист</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
</head>
<body>
{literal}
<style>
    span {
        font-size: 200%;
    }
</style>
{/literal}
<!--
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
    <td align="center"><b style="color:red;">ІНФОРМАЦІЙНИЙ ЛИСТ</b></td>
</tr>
</table><br />
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
    <td><b>Регрес:</b></td>
    <td class="all">{if $values.regres == 1}Так{else}Ні{/if}</td>
    <td align="right"><b>Номер договору:</b></td>
    <td class="all">{$values.policies_number}</td>
</tr>
<tr>
    <td><b>СТО:</b></td>
    <td class="right left">{$values.car_services_title}</td>
    <td align="right"><b>Дата договору:</b></td>
    <td class="bottom right left">{$values.policies_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</td>
</tr>
<tr>
    <td><b>Орієнтовний збиток:</b></td>
    <td class="all">&nbsp;</td>
    <td ></td>
</tr>
</table><br />
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
    <td align="right" width="40%" colspan="2"><b>Справа №</b></td>
    <td width="20%" class="all" align=center>{$values.accidents_number}</b></td>
    <td align="right">Сальдо:</td>
    <td class="all">&nbsp;</td>
    <td>&nbsp;</td>
</tr>
</table>
<br />
<table cellspacing="0" cellpadding="5" width="100%" border=1>
<tr>
    <td><b>1. Страхувальник</b></td>
    <td colspan="3">{$values.policies_insurer_lastname} {$values.policies_insurer_firstname} {$values.policies_insurer_patronymicname}</td>
</tr>
<tr>
    <td><b>2. Вигодонабувач</b></td>
    <td colspan="3"><b>{$values.policies_assured_title}</b></td>
</tr>
<tr>
    <td><b>3. Об'єкт страхування</b></td>
    <td><b>{$values.policies_brand} {$values.policies_model}</b></td>
    <td align="center"><b>д/н</b></td>
    <td><b>{$values.policies_sign}</b></td>
</tr>
</table>
<br />
<table cellspacing="0" cellpadding="5" width="100%" border=1>
<tr>
    <td><b>1. Дата події</b></td>
    <td colspan="3">{$values.accidents_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</td>
</tr>
<tr>
    <td><b>2. Дата заяви</b></td>
    <td colspan="3">{$values.accidents_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.</td>
</tr>
<tr>
    <td><b>3. Дата отримання док СК</b></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><b>4. Дата звернення в асистанс</b></td>
    <td colspan="3">{if $values.accidents_assistance == 1}{$values.accidents_assistance_date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р.{else}&nbsp;{/if}</td>
</tr>
<tr>
    {if $values.accidents_kasko_mvs == 0}
    <td><b>5. Звернення до органів МВС, МНС, ДАІ</b></td>
    <td colspan="3">Ні</td>
    {/if}
    {if $values.accidents_kasko_mvs == 1}
    <td><b>5. Звернення до органів ДАІ</b></td>
    <td colspan="3">Так</td>
    {/if}
    {if $values.accidents_kasko_mvs == 2}
    <td><b>5. Звернення до органів МВС</b></td>
    <td colspan="3">Так</td>
    {/if}
    {if $values.accidents_kasko_mvs == 3}
    <td><b>5. Звернення до органів МНС</b></td>
    <td colspan="3">Так</td>
    {/if}
</tr>
</table>
<br />
<b>Перелік документів:</b>
<br />
<br />
<table cellspacing="0" cellpadding="5" width="100%" border=1>
<tr>
    <td><b>1. Заява на виплату</b></td>
    <td width = "5%" align="center">{if $values.product_document_types.45 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>16. Посвідчення водія</b></td>
    <td width = "5%" align="center">{if $values.product_document_types.13 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>2. 	Довідка органів МВС, ДАІ (форма 1)</b></td>
    <td align="center">{if $values.product_document_types.55 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>17. Реєстраційний талон</b></td>
    <td align="center">{if $values.product_document_types.12 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>3. Довідка органів МВС, ДАІ (форма 2)</b></td>
    <td align="center">{if $values.product_document_types.56 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>18. Громадянський паспорт особи, яка керувала ТЗ</b></td>
    <td align="center">{if $values.product_document_types.72 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>4. Постанова суду</b></td>
    <td align="center">{if $values.product_document_types.60 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>19. Паспорт страхувальника</b></td>
    <td align="center">{if $values.product_document_types.19 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>5. Рахунок фактура(калькуляція)</b></td>
    <td align="center">{if $values.product_document_types.64 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>20. Кредитний договір</b></td>
    <td align="center">{if $values.product_document_types.74 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>6. Ідентифікаційний номер</b></td>
    <td align="center">{if $values.product_document_types.72 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>21. Заява на страхування ТЗ</b></td>
    <td align="center">{if $values.product_document_types.1 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>7. Протокол огляду</b></td>
    <td align="center">{if $values.product_document_types.63 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>22. Договір страхування</b></td>
    <td align="center">{if $values.product_document_types.2 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>8. Фото ТЗ</b></td>
    <td align="center">{if $values.product_document_types.36 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>23. Довідка дорожньої служби</b></td>
    <td align="center">{if $values.product_document_types.52 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>9. Заява про подію</b></td>
    <td align="center">{if $values.product_document_types.7 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>24. Довідка з метеорологічної або сейсмологічної служби про стихійне лихо в місці настання страхового випадку</b></td>
    <td align="center">{if $values.product_document_types.23 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>10. Паспорт Вигодонабувача</b></td>
    <td align="center">{if $values.product_document_types.51 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>25. Довідка органів пожежного нагляду</b></td>
    <td align="center">{if $values.product_document_types.57 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>11. Довідка з відділу кадрів, що водій дійсно є працівником підприємства</b></td>
    <td align="center">{if $values.product_document_types.53 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>26. Доручення на право керування</b></td>
    <td align="center">{if $values.product_document_types.14 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>12. Довідка комунальної служби</b></td>
    <td align="center">{if $values.product_document_types.54 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>27. Постанова про порушення кримінальної справи або про відмову у порушені кримінальної справи</b></td>
    <td align="center">{if $values.product_document_types.59 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>13. Договір оренди автомобіля</b></td>
    <td align="center">{if $values.product_document_types.17 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>28. Протокол ДАІ про адміністративне правопорушення</b></td>
    <td align="center">{if $values.product_document_types.62 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>14. Подорожній лист</b></td>
    <td align="center">{if $values.product_document_types.16 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>29. Талон-повідомлення УМВС</b></td>
    <td align="center">{if $values.product_document_types.65 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
<tr>
    <td><b>15. Пояснення водія, свідків про обставини події</b></td>
    <td align="center">{if $values.product_document_types.61 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
    <td><b>30. Тимчасовий реєстраційний талон</b></td>
    <td align="center">{if $values.product_document_types.15 !=''}<span>+</span>{else}<b>&mdash;</b>{/if}</td>
</tr>
</table>
<br />
{if count($values.additional_documents) >= 1}
<b>Додатково:</b>
<br />
<br />
<table cellspacing="0" cellpadding="5" width = "100%" border=1>
    {section name="roll" loop=$values.additional_documents}
    <tr>
        <td><b>{$values.additional_documents[roll]}</b></td>
    </tr>
    {/section}
</table>
{/if}
<br />
<table cellspacing="0" cellpadding="5" width = "100%" border=1>
    <tr>
        <td><b>Коментар:</b></td>
    </tr>
    <tr>
        <td>{$values.comment}</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="5" width = "100%">
<tr>
    <td align ="center">Внесено в базу <b>e-insurance.in.ua</b></td>
    <td align="center"><ins>{$values.accident_status_changes_application_created|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</ins></td>
    <td align="center"><ins>{$values.accident_status_changes_accounts_title}</ins></td>
</tr>
<tr>
    <td>Дата отримання справи аварійним комісаром</td>
    <td align="center">___________</td>
    <td align="center">_________________________</td>
</tr>
</table>-->
</body>
</html>