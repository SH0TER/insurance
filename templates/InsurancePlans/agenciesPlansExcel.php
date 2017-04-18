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
	<td>ID агенции</td>
    <td>Агенцiя</td>
    <td>Кредит/КАСКО Банк,шт</td>
    <td>Пролонгацiя Рітейл,шт</td>
    <td>Рітейл 1й рік,шт</td>
    <td>ОСАГО,шт</td>
	
	<td>Кредит/КАСКО Банк,грн</td>
    <td>Пролонгацiя Рітейл,грн</td>
    <td>Рітейл 1й рік,грн</td>
    <td>ОСАГО,грн</td>
	
	
	<td>Кiльк брендiв</td>
	
	<td>ЗАЗ %</td>
	<td>Chevrolet %</td>
	<td>KIA % </td>
	<td>Chery %</td>
	<td>LADA %</td>
	<td>Mercedes %</td>
	<td>JEEP %</td>
	<td>CHRYSLER %</td>
	<td>OPEL %</td>
	<td>Nissan %</td>
	<td>Renault %</td>
	<td>Toyota %</td>
	<td>Iтого</td>
    </tr>
							
							<?
							if ($list)
							{

								foreach($list as $row) {
									$i = 1 - $i;
									echo '<tr>';
									echo '<td>'.$row['id'].'</td>';
									echo '<td x:str>'.$row['agencyTitle'].'</td>';
                                    
									echo '<td>'.$row['credit_cars'].'</td>';
									echo '<td>'.$row['continued_cars'].'</td>';
									echo '<td>'.$row['not_credit_cars'].'</td>';
									echo '<td>'.$row['go_cars'].'</td>';
									echo '<td>'.$row['dgo_cars'].'</td>';
									
									echo '<td>'.str_replace('.',',',doubleval($row['credit_cars_money'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['continued_cars_money'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['not_credit_cars_money'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['go_cars_money'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['dgo_cars_money'])).'</td>';
									
									
									echo '<td>'.$row['brand_count'].'</td>';
									
                                    echo '<td>'.str_replace('.',',',doubleval($row['zaz'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['chevrolet'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['kia'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['chery'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['lada'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['mercedes'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['jeep'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['chrasler'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['opel'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['nissan'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['renault'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['toyota'])).'</td>';
									echo '<td>'.str_replace('.',',',doubleval($row['itog'])).'</td>';
                                    
									echo '</tr>';
								}
							}
							
							?>
                        </table>
</body>
</html>