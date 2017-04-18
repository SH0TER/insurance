<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>Сертифікати добровільного страхування вантажів та багажу (вантажобагажу). Об'єкти</title>
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
                border-right: 1px solid #FFFFFF;
                border-top: 1px solid #FFFFFF;
                border-bottom: 1px solid #FFFFFF;
                background-color: #008575;
            }
        </style>
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border=1>
		<tr class="columns">
			<td>Страхувальник</td>
			<td>Номер</td>
			<td>Дата</td>
			<td>Об'єкт</td>
			<td>Сума, грн.</td>
			<td>Премія, грн.</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Статус</td>
			<td>Оплата</td>
			<td>Створено</td>
			<td>Редаговано</td>
		</tr>
		<?
			if (is_array($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['company']?></td>
			<td><?=$row['number']?></td>
			<td><?=$row['date']?></td>
			<td><?=$row['object']?></td>
			<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
			<td><?=$row['begin_datetime']?></td>
			<td><?=$row['end_datetime']?></td>
			<td><?=$row['policy_statusesTitle']?></td>
			<td><?=$row['payment_statusesTitle']?></td>
			<td><?=$row['created']?></td>
			<td><?=$row['modified']?></td>
		</tr>
		<?
				}
			}
		?>
        </table>
    </body>
</html>