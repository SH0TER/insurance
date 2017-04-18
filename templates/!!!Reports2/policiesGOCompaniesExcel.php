<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>ЦВ, реалізація полісів компаніями за період</title>
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
		<table width="100%" cellpadding="0" cellspacing="0">
		<tr class="columns">
			<td rowspan="2">Номер</td>
			<td rowspan="2">Дата</td>
			<td rowspan="2">Тип</td>
			<td rowspan="2">Страхувальник</td>
			<td rowspan="2">Об'єкт</td>
			<td rowspan="2">Премія, грн.</td>
			<td rowspan="2">Початок</td>
			<td rowspan="2">Закінчення</td>
			<td rowspan="2">Статус</td>
			<td rowspan="2">Сплачено</td>
			<td colspan="2">Акти</td>
			<td rowspan="2">Агенція</td>
			<td rowspan="2">Менеджер</td>
		</tr>
		<tr class="columns">
			<td>Агенція</td>
			<td>Агент</td>
		</td>
		<?
			if (sizeOf($list )) {
				foreach ($list as $row) {
					$i = 1 - $i;
		?>
		<tr class="<?=Policies::getRowClass($row, $i)?>">
			<td><?=$row['number']?></td>
			<td><?=$row['date_format']?></td>
			<td><?=$row['personTypesTitle']?></td>
			<td><?=$row['insurer']?></td>
			<td><?=$row['item']?></td>
			<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
			<td><?=$row['begin_datetimeFormat']?></td>
			<td><?=$row['end_datetimeFormat']?></td>
			<td><?=$row['statusesTitle']?></td>
			<td><?=$row['paymentsDateTimeFormat']?></td>
			<td><?=$row['agencies_akt_number']?></td>
			<td><?=$row['agents_akt_number']?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['manager']?></td>
		</tr>
		<?
				}
			}
		?>
		</table>
    </body>
</html>