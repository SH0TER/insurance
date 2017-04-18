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
    <table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
            <td rowspan="2">Страхувальник</td>
            <td rowspan="2">Адреса</td>
            <td colspan="10">Поліс</td>
            <td colspan="5">Оплата</td>
            <td rowspan="2">Агенцiя</td>
			<td rowspan="2">Банк</td>
        </tr>
        <tr class="columns">
            <td>Номер</td>
            <td>Дата</td>
            <td>Початок</td>
            <td>Закінчення</td>
            <td>Багаторічний</td>
            <td>Пролонгацiя (3 міс)</td>
			<td>Пролонгацiя (6 міс)</td>
            <td>Опцiя 50/50</td>
            <td>Кiльк платежiв</td>
            <td>Статус</td>
            <td>Сума, грн.</td>
            <td>Термін</td>
            <td>Отримано</td>
            <td>Статус</td>
            <td>Фактично сплачено</td>
        </tr>
        <?
        foreach ($list as $row) {
            $i = 1 - $i;
		if ($row['prev_status'] == 1) {
				continue;
			}
        ?>
		<tr class="<?=$this->getRowClass($row, $i)?>">
			<td><?=$row['insurer'] . (strlen($row['insurer_patronymicname']) ? ' ' . $row['insurer_patronymicname'] : '')?></td>
            <td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td><?=$row['number']?></td>
			<td><?=$row['policies_date']?></td>
            <td><?=$row['policies_begin_datetime']?></td>
            <td><?=$row['policies_end_datetime']?></td>
			<td><?=($row['days'] > 367) ? 'так' : 'ні'?></td>
			<td><?=($row['states_id']>0 ? 'так' : 'нi' )?></td>
			<td><?=($row['states_id2']>0 ? 'так' : 'нi' )?></td>
			
			<td><?=($row['options_fifty_fifty']>0 ? 'так' : 'нi' )?></td>
			<td><?=($row['payment_brakedown_id']==3 ? '4 платежi' : ($row['payment_brakedown_id']==2 ? '2 платежi': '1 платiж') )?></td>

										
			<td><?=$row['policy_statuses_title']?></td>
			<td align="right"><?=str_replace('.', ',', $row['amount'])?></td>
			<td><?=$row['date']?></td>
			<td><?=$row['payment_date']?></td>
			<td><?=$row['payment_statuses_title']?></td>
			<td align="right"><?=str_replace('.', ',', $row['payedamount'])?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['fin_institutionTitle']?></td>
		</tr>
        <? } ?>
    </table>
</body>
</html>