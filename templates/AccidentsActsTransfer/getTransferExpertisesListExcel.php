<html>
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
	text-align: center;
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
<? if (is_array($list)) {?>

<? if ($data['transfer_statuses_id'] > 1) { ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size: 20px;">
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10">&nbsp;</td>
		<td colspan="2" style="font-size: 13px;">Додаток №5<br/>до Договору №31/10/13 від 31.10.13р.</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			"Затверджую"
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			"Затверджую"
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			Директор
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			Генеральний директор
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			ТДВ "Експрес Страхування"
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			ТОВ "ЄВРОАСИСТАНС"
		</td>
	</tr>
	<tr height="60">
		<td>&nbsp;</td>
		<td colspan="2">
			_____________ Т.А.Щучьєва
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			_____________ С.В. Залуцький
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			Головний бухгалтер
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			Головний бухгалтер
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			ТДВ "Експрес Страхування"
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			ТОВ "ЄВРОАСИСТАНС"
		</td>
	</tr>
	<tr height="60">
		<td>&nbsp;</td>
		<td colspan="2">
			_____________ М.Ю. Білогорська
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			_____________ Л.В. Бобрік
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2" style="font-size: 13px;">
			м. Київ, вул.Червоноармійська, 15/2<br/>
			Р/р 265000464000 в АБ «БрокБізнесБанк»<br/>
			МФО 300249<br/>
			Код ЄДРПОУ 36086124
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2" style="font-size: 13px;">
			04073, м. Київ, пр.-т. Московський, 22<br/>
			Р/р 26006022437000 в АТ «БРОКБІЗНЕСБАНК»<br/>
			у м. Києві<br/>
			МФО 300249<br/>
			Код ЄДРПОУ 34484756
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			«___»_______20___
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			«___»_______20___
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
</table>
<? } ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size: 20px;">
	<tr>
		<td colspan="3">
			&nbsp;
		</td>
		<td colspan="7" align="center">
			Звіт повіреного № <?=$transfer['number']?> <? if ($data['transfer_statuses_id'] > 1) { ?>від <?=$transfer['date_format']?> р.<? } ?> по експертизам, що підлягають компенсації
		</td>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">
			&nbsp;
		</td>
		<td colspan="7" align="center">
			за Договором Доручення № 31/10/13 від 31.10.2013 р.
		</td>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
		<td>№</td>
		<td>Номер справи</td>
		<td colspan="2">Страхувальник</td>
		<td>Номер договору</td>
		<td>Марка авто Страхувальника</td>
		<td>Д.н.з. або VIN</td>
		<td>Дата події</td>
		<td>Дата заяви</td>
		<td colspan="2">Експертна організація
		<td>Витрати на експертизу, грн.</td>
    </tr>
    <?
        $i = 0;
		$number = 0;
		$expertise_amount_total = 0;
        foreach ($list as $row) {
            $i = 1 - $i;
			$number++;
			$expertise_amount_total += $row['expertise_amount'];
    ?>
        <tr>
			<td><?=$number?>.</td>
			<td style='mso-number-format:"\@";'><a target="_blank" href="<?=$_SERVER['PHP_SELF'] . '?do=Accidents|view&id=' . $row['accidents_id'] . '&product_types_id=' . $row['product_types_id']?>"><?=$row['accidents_number']?></a></td>
			<td colspan="2"><?=$row['insurer']?></td>
			<td><?=$row['policies_number']?></td>
			<td><?=$row['policies_item']?></td>
			<td><?=$row['policies_item_sign']?></td>
			<td><?=$row['accidents_datetime']?></td>
			<td><?=$row['accidents_date']?></td>
			<td colspan="2"><?=$row['expert_organizations_title']?></td>
			<td><?=getRateFormat($row['expertise_amount'], 2)?></td>
        </tr>
    <?
        }
    ?>
</table>
<? if ($data['transfer_statuses_id'] > 1) { ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">Сума виплат по експертизам згідно цього реєстру складає: <?=getRateFormat($expertise_amount_total, 2)?> грн.</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="3" style="font-size: 20px;">Погоджено:</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="3" style="font-size: 20px;">
			Генеральний Директор ТОВ "ЄвроАсистанс"
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="3" style="font-size: 20px;">
			_______________________ Залуцький С.В.
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="3" style="font-size: 20px;">
			Управління безпеки
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="3" style="font-size: 20px;">
			_______________________ Вінцевіч О.М.
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="3" style="font-size: 20px;">
			Виконавець:________________ Цибенко Ю.В.
		</td>
	</tr>
	<tr height="60">
		<td colspan="2">&nbsp;</td>
		<td colspan="10">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td colspan="10">&nbsp;</td>		
	</tr>
</table>
<? } ?>
<? } ?>
</body>
</html>