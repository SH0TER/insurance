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
        </style>
    </head>
    <body>
        <table border="1" cellpadding=0 cellspacing=0>
            <tr class="columns">
                <td>Код</td>
                <td>Назва</td>
                <td>Страхова компанiя</td>
                <td>Знижка за карткою CarMan@CarWoman, %</td>
				
				
                <td>Розмір максимальної знижки, %</td>
                <td>Знижка для банкiв</td>
                <td>Компенсацiя банка</td>
                
				<td>Опис</td>
                <td>Показувати</td>
				
				<td>Смерть, яка настала внаслідок нещасного випадку</td>
				<td>Встановлення І групи інвалідності</td>
				<td>Встановлення ІІ групи інвалідності</td>
				<td>Встановлення ІІІ групи інвалідності</td>
				<td>Тимчасова втрата загальної працездатності</td>
				
				
				<td>ТЕРИТОРІЯ Україна</td>
				<td>ТЕРИТОРІЯ Весь світ</td>
				
				<td>КАТЕГОРІЇ СПОРТСМЕНІВ Група 0</td>
				<td>КАТЕГОРІЇ СПОРТСМЕНІВ Група 1</td>
				<td>КАТЕГОРІЇ СПОРТСМЕНІВ Група 2</td>
				<td>КАТЕГОРІЇ СПОРТСМЕНІВ Група 3</td>
                
				<td>ПЕРЕЛІК ПРОФЕСІЙ Група 1</td>
				<td>ПЕРЕЛІК ПРОФЕСІЙ Група 2</td>
				<td>ПЕРЕЛІК ПРОФЕСІЙ Група 3</td>
				<td>ПЕРЕЛІК ПРОФЕСІЙ Група 4</td>
				
				<td>ВІК СТРАХУВАЛЬНИКА до 19 років</td> 
				<td>ВІК СТРАХУВАЛЬНИКА 20-25 років</td> 
				<td>ВІК СТРАХУВАЛЬНИКА 26-40 років</td> 
				<td>ВІК СТРАХУВАЛЬНИКА 41-50 років</td> 
				<td>ВІК СТРАХУВАЛЬНИКА 51-60 (69) років</td> 
				
				<td>ДІЯ СТРАХОВОГО ЗАХИСТУ Впродовж 24 годин на добу</td>
				<td>ДІЯ СТРАХОВОГО ЗАХИСТУ Впродовж робочого (навчального) часу, включаючи час на дорогу</td>
				<td>ДІЯ СТРАХОВОГО ЗАХИСТУ Впродовж робочого (навчального) часу</td>
				<td>ДІЯ СТРАХОВОГО ЗАХИСТУ 24 год на добу, за виключенням робочого (навчального) часу</td>
            </tr>
            <? foreach ($list as $row) {?>
            <tr>
                <td><?=$row['code']?></td>
				<td><?=$row['title']?></td>
				<td><?=($row['insurance_companies_id']==4 ? ' ТДВ "Eкспрес Страхування"' : 'УСК «Гарант-Лайф»  ') ?></td>
                <td><?=$row['cart_discount']?></td>
				<td><?=$row['max_discount']?></td>
				<td><?=$row['bank_discount_value']?></td>
				<td><?=$row['bank_commission_value']?></td>
				<td><?=$row['description']?></td>
	 
				<td><?=($row['publish'] ? 'Так' : 'Нi') ?></td>
				<?
				$rr=$db->getAll('select * from  insurance_product_risks where  products_id='.$row['products_id'].' order by risks_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_ns_values where  products_id='.$row['products_id'].' and values_id in(18,19) order by values_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_ns_values where  products_id='.$row['products_id'].' and values_id in(9,10,11,12) order by values_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_ns_values where  products_id='.$row['products_id'].' and values_id in(1,2,3,4) order by values_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_ns_values where  products_id='.$row['products_id'].' and values_id in(13,14,15,16,17) order by values_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_ns_values where  products_id='.$row['products_id'].' and values_id in(5,6,7,8 ) order by values_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
            </tr>
            <?}?>
        </table>
    </body>
</html>