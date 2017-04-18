<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
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
 <table width="100%"   cellpadding="0" cellspacing="0">
    <tr class="columns">
        <td>Полис</td>
        <td>Страхувальник</td>
        <td>Марка</td>
        <td>Модель</td>
        <td>Vin</td>
        <td>Год</td>
        <td>КПП</td>
        <td>Объем</td>
        <td>Топливо</td>
        <td>Кузов</td>
        <td>Модификация</td>
        <td>Страх  стоимость по дог.</td>
        <td>Рыночаня цена по базе</td>
        <td>Рыночная цена по дог., грн.</td>
		<td>Рыночная цена эксперт, грн.</td>
        <td>Кто установил</td>
        <td>Дата</td>
        <td></td>
    </tr>
    <?
        foreach ($list as $row) {
        $i = $row['item_id'];
    ?>
    <tr>
        <td><a href="index.php?do=Policies|view&id=<?=$row['policies_id']?>&product_types_id=3" target="_blank"><?=$row['number']?></a></td>
        <td><?=$row['insurer']?></td>
        <td><?=$row['brand']?></td>
        <td><?=$row['model']?></td>
        <td><?=$row['shassi']?></td>
        <td><?=$row['year']?></td>
        <td>
            <?
                foreach($this->transmissions as $id => $title) {
                    if ($row['transmissions_id'] == $id) echo $title;
                }
            ?>
        </td>
        <td><?=$row['engine_size']?></td>
        <td>
            <?
                foreach($this->car_engine_type as $id => $title) {
                    if ($row['car_engine_type_id'] == $id) echo $title;
                }
            ?>
        </td>
        <td>
            <?
                foreach($this->car_body as $id => $title) {
                    if ($row['car_body_id'] == $id) echo  $title;
                }
            ?>
        </td>
        <td><?=$row['modification']?></td>
        <td><?=$row['car_price']?></td>
        <td><?=$row['find_market_price']?></td>
        <td><?=$row['market_price']?></td>
		<td><?=$row['market_price_expert']?></td>
        <td><?=$row['expert']?></td>
        <td><?=$row['expert_date']?></td>
    </tr>
    <?
        }
    ?>
</table>
</body>
</html>