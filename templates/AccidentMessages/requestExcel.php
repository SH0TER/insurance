<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
</head>
<body>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td><b>Номер справи:</b> <?=$row['number']?></td>
            <td align="right" colspan="3"><b>Дата та час формування:</b> <?=$row['date_now']?></td>
        </tr>
        <tr>
            <td><b>Страхувальник:</b>  <?=$row['insurer']?></td>
        </tr>
        <tr>
            <td><b>Транспортний засіб:</b> <?=$row['item']?> <b>Державний номер:</b> <?=$row['sign']?> <b>VIN:</b> <?=$row['shassi']?> <b>Рік випуску:</b> <?=$row['year']?></td>
        </tr>
        <tr>
            <td><b>Клас ремонту:</b> <?=$row['repair_classifications_id']?></td>
        </tr>
        <tr>
            <td><b>Кількість днів на поставку ЗЧ:</b> <?=$row['answer']['parts_days']?> днів </td>
        </tr>
        <tr>
            <td><b>ДП, яке виконує ВР:</b> <?=$row['car_services_title']?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                <table cellpadding="0" cellspacing="0" border="1">
                    <tr>
                        <td colspan="4" valign="top" align="center">
                           1-а частина <br/> (заповнюється ДП на першому етапі) <br/>строк відповіді не пізніше, ніж до 12:00 робочого дня<br/> наступного за днем отримання запиту
                        </td>
                        <td class="header_2" colspan="7" align="center">
                           2-а частина <br/> (заповнюється на другому етапі ДК, а якщо ДК не надав інформації у встановлені строки або строки перевищують граничні - <br/>запит заповнюється ДРТЗЧ на третьому етапі після закінчення
                           двох робочих днів на пошук ДК альтернативного вирішення питання)
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Номер</td>
                        <td align="center">Найменування <br/> відсутньої ЗЧ</td>
                        <td align="center">Каталожний <br/> номер ЗЧ</td>
                        <td align="center">Категорія ЗЧ</td>
                        <td align="center">Дата поставки</td>
                        <td align="center">Дата поставки <br/> при зовнішній поставці</td>
                        <td align="center">Дозвіл <br/> на зовнішню поставку</td>
                        <td align="center" colspan="2">Ціна</td>
                        <td align="center">Контактні дані <br/> зовнішнього постачальника</td>
                        <td align="center">Категорія ЗЧ</td>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td align="center">2</td>
                        <td align="center">3</td>
                        <td align="center">4</td>
                        <td align="center">5</td>
                        <td align="center">6</td>
                        <td align="center">7</td>
                        <td align="center" colspan="2">8</td>
                        <td align="center">9</td>
                        <td align="center">10</td>
                    </tr>
                    <?
						if (sizeOf($row['answer']['problem_parts'])) {
							$i=1;
							foreach($row['answer']['problem_parts'] as $part) {
								echo '<tr>';
								echo '<td>'.$i.'</td>';
								echo '<td>'.$part['title'].'</td>';
								echo '<td style=\'mso-number-format:"\@"\'>'.$part['catalog_number'].'</td>';
								echo '<td>'.$part['category'].'</td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td colspan="2"></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '</tr>';
								$i++;
							}
						} else {
							for($i=0; $i <= 15; $i++) {
								echo '<tr>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td colspan="2"></td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '</tr>';
							}
						}
                    ?>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>