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
<? if (is_array($list)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
        <td>Номер полісу</td>
        <td>Дата полісу</td>
        <td>Початок дії полісу</td>
        <td>Закінчення дії полісу</td>
        <td>Страхувальник</td>
        <td>ТЗ</td>
        <td>Вартість ТЗ</td>
        <td>Тариф</td>
        <td>Державний номер</td>
        <td>Шасі</td>
        <td>Страхова премія</td>
        <td>Сплачена премія</td>
        <td>Комісія агента(договір), грн.</td>
        <td>Комісія агента(договір), %</td>
        <td>Комісія банку</td>
        <td>Сума страхових відшкодувань, грн</td>
        <td>Додаткові витрати на врегулювання, грн.</td>
        <td>Сума страхових відшкодувань не врахованих у пропорцію, грн</td>
        <td>Загальна сума витрат, грн.</td>
    </tr>
    <?
        $i = 0;
        foreach ($list as $row) {
            $i = 1 - $i;
    ?>
        <tr>
            <td><?=$row['policies_number']?></td>
            <td><?=$row['policies_date']?></td>
            <td><?=$row['policies_begin_datetime']?></td>
            <td><?=$row['policies_end_datetime']?></td>
            <td><?=$row['insurer']?></td>
            <td><?=$row['item']?></td>
            <td><?=$row['car_price']?></td>
            <td><?=$row['rate']?></td>
            <td><?=$row['sign_item']?></td>
            <td><?=$row['shassi_item']?></td>
            <td><?=$row['premium_total']?></td>
            <td><?=($row['premium_pays'] ? $row['premium_pays'] : '0')?></td>
            <td><?=($row['commission_amount_agent_policies'] ? $row['commission_amount_agent_policies'] : '0')?></td>
            <td><?=($row['commission_percent_agent_policies'] ? $row['commission_percent_agent_policies'] : '0')?></td>
            <td><?=($row['commission_amount_financial_institution'] ? $row['commission_amount_financial_institution'] : '0')?></td>
            <td><?=($row['acts_amount'] ? $row['acts_amount'] : '0')?></td>
            <td><?=($row['commission_amount_agent_accidents'] ? $row['commission_amount_agent_accidents'] : '0')?></td>
            <td><?=($row['acts_amount_not_proportionality'] ? $row['acts_amount_not_proportionality'] : '0')?></td>
            <td><?=($row['commission_amount_agent_policies'] + $row['commission_amount_agent_accidents'] + $row['commission_amount_financial_institution'] + $row['acts_amount'])?></td>
        </tr>
    <?
        }
    ?>
</table>
<? } ?>
</body>
</html>