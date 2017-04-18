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

.rows TD {
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
			&nbsp;
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
			&nbsp;
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
			&nbsp;
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			_____________ Л.В. Бобрік
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			«___»_______20__
		</td>
		<td colspan="7">
			&nbsp;
		</td>
		<td colspan="2">
			«___»_______20__
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
			Звіт повіреного № <?=$transfer['number']?> <? if ($data['transfer_statuses_id'] > 1) { ?>від <?=$transfer['date_format']?> р.<? } ?> по врегульованим страховим випадкам
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
		<? if ($data['types_id'] == 1) { ?>
			<td colspan="2">Сума страхової виплати</td>		
			<!--td>Порушено пункт правил страхування</td-->				
			<td>Примітка</td>
		<? } ?>
		<? if ($data['types_id'] == 2) { ?>
			<td>№ звіту Повіренного / дата</td>
			<td>Сума</td>
		<? } ?>
    </tr>
    <?
        $i = 0;
		$number = 0;
        foreach ($list as $row) {
            $i = 1 - $i;
			$number++;
    ?>
        <tr class="rows">
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
			<? if ($data['types_id'] == 1) { ?>
				<td colspan="2" style='mso-number-format:"\#\ \#\#0\.00"'><?=getRateFormat($row['amount'],2)?></td>
				<!--td><?=$row['reason']?></td-->			
				<td><?=$row['notes']?></td>
			<? } ?>
			<? if ($data['types_id'] == 2) { ?>
				<td><?=$row['transfer_info']?></td>
				<td><?=AMONT_PAYMENT_EUASSIST?></td>
			<? } ?>
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
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">
			Заступник директора Департаменту 
			врегулювання збитків та обслуговування 
			клієнтів ТДВ "Експрес Страхування"
		</td>
		<td colspan="8">&nbsp;</td>
		<td colspan="2">
			Виконавець:__________________ <?=$transfer['formed_accounts_name']?>
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">
			_______________________ Петренко Д.М.
		</td>
		<td colspan="8">&nbsp;</td>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">
			Начальник відділу обліку, реєстрації та 
			контролю якості Департаменту 
			врегулювання збитків та обслуговування 
			клієнтів ТДВ "Експрес Страхування"
		</td>
		<td colspan="8">&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr height="60">
		<td colspan="2">
			_______________________ Горобець О.М.
		</td>
		<td colspan="10">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
			Виконавець:__________________ Арзяєва О.М.
		</td>
		<td colspan="10">&nbsp;</td>		
	</tr>
</table>
<? } ?>
<? } ?>
</body>
</html>