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
	<table width="100%" cellpadding="0" cellspacing="0">
    <tr class="columns" align="center">
    <td>Агенський договiр</td>
    <td>Призвище</td>
    <td>Агенцiя</td>
    <td>Кредит/КАСКО Банк,шт</td>
    <td>Пролонгацiя Рітейл,шт</td>
    <td>Рітейл 1й рік,шт</td>
    <td>ОСАГО,шт</td>
	
	<td>Кредит/КАСКО Банк,грн</td>
    <td>Пролонгацiя Рітейл,грн</td>
    <td>Рітейл 1й рік,грн</td>
    <td>ОСАГО,грн</td>
    </tr>
							
							<?
							if ($list)
							{

								foreach($list as $row) {
									$i = 1 - $i;
									echo '<tr>';
									echo '<td x:str>'.$row['agreement_number'].'</td>';
                                    echo '<td>'.$row['fio'].'</td>';
                                    echo '<td>'.$row['agency'].'</td>';
                                    echo '<td>'.intval($row['credit_cars']).'</td>';
                                    echo '<td>'.intval($row['not_credit_cars']).'</td>';
                                    echo '<td>'.intval($row['continued_cars']).'</td>';
                                    echo '<td>'.intval($row['go_cars']).'</td>';
									echo '<td>'.intval($row['credit_cars_money']).'</td>';
                                    echo '<td>'.intval($row['not_credit_cars_money']).'</td>';
                                    echo '<td>'.intval($row['continued_cars_money']).'</td>';
                                    echo '<td>'.intval($row['go_cars_money']).'</td>';
									echo '</tr>';
								}
							}
							
							?>
                        </table>
</body>
</html>