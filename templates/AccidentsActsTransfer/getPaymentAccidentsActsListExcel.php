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
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
<? if (is_array($list)) { ?>

<? if ($data['transfer_statuses_id'] > 1) { ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size: 20px;">
	<tr>
		<td align="right" colspan="12" style="font-size: 15px;">
			<b>Додаток № 1 до акту виконаних робіт за <?=mb_strtolower($transfer['month'], 'UTF-8')?> <?=$transfer['year']?> року</b>
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="font-size: 15px;">
			<b>Головний бухгалтер</b>
		</td>
		<td style="font-size: 15px;">
			<b>Білогорська М.Ю.</b>
		</td>
		<td colspan="6">&nbsp;</td>
		<td colspan="3" style="font-size: 15px;">
			<b>Заст. генарального директора</b>
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
		<td colspan="6">&nbsp;</td>
		<td colspan="2" style="font-size: 15px;">
			<b>головний бухгалтер</b>
		</td>
		<td style="font-size: 15px;">
			<b>Бобрік Л.В.</b>
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="font-size: 15px;">
			<b>М.П.</b>
		</td>
		<td style="font-size: 15px;">
			<b>      _____________________</b>
		</td>
		<td colspan="6">&nbsp;</td>
		<td colspan="2" style="font-size: 15px;">
			<b>М.П.</b>
		</td>
		<td style="font-size: 15px;">
			<b>      _____________________</b>
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
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
			Перелік випадків, які були врегульовані за <?=mb_strtolower($transfer['month'], 'UTF-8')?> <?=$transfer['year']?> р.
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
		<td>Вид страхування</td>
		<td>Номер договору</td>
		<td>Страхувальник</td>
		<td>Потерпілий</td>
		<td>Номер страхового акту</td>
		<? if ($this->permissions['comment']) { ?>
			<td>Статус акту</td>
		<? } ?>
		<td>Дата затвердження страхового акту</td>
		<td>Рішення по справі</td>
		<td>№ звіту Повіренного / дата</td>
		<td>Сума</td>
	</tr>
    <?
        $i = 0;
		$number = 0;
        foreach ($list as $row) {
            $i = 1 - $i;
			$number++;
    ?>
        <tr>
			<td><?=$number?></td>
            <td style='mso-number-format:"\@";'><?=$row['accidents_number']?></td>							
			<td><?=$row['product_types_title']?></td>
			<td><?=$row['policies_number']?></td>
			<td><?=$row['insurer']?></td>
			<td><?=$row['owner']?></td>
			<td><?=$row['accidents_acts_number']?></td>
			<? if ($this->permissions['comment']) { ?>
				<td><?=$row['act_statuses_title']?></td>
			<? } ?>
			<td><?=$row['accidents_acts_date']?></td>
			<td><?=$row['insurance_title']?></td>
			<td><?=$row['transfer_info']?></td>
			<td><?=AMONT_PAYMENT_EUASSIST?></td>
        </tr>
    <?
        }
    ?>
</table>
<? } ?>
</body>
</html>