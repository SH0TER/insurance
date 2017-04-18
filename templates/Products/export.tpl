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
                <td>Пріоритет виплати, СТО</td>
                <td>Пріоритет виплати, Експертиза</td>
                <td>Місце зберігання ТЗ, стоянка що охороняється</td>
                <td>Місце зберігання ТЗ, будь-яке місце</td>
                <td>без франшизи на вітрові стекла</td>
                <td>є протиугінний пристрій</td>
                <td>не встановлено протиугінний пристрій</td>
                <td>страхування таксі</td>
                <td>опція "50/50</td>
                <td>неагрегатна страхова сума</td>
				<td>Додаткове обладнання, тариф, %</td>
				<td>НС, страхова сума, грн</td>
				<td>НС, тариф, %</td>
				<td>Обов'язкове стахування НС</td>
				<td>Обов'язкова неагрегатна страхова сумма</td>
				<td>Р/р банку для рахунку</td>
				<td>МФО банку для рахунку</td>
				<td>Спеціальні умови</td>
				<td>Розмір максимальної знижки, %</td>
				<td>Знижка за карткою CarMan@CarWoman, %</td>
				<td>Знижка для банкiв</td>
				<td>Компенсацiя банка</td>
				<td>Знижка для банкiв (3 рiк)</td>
				<td>Компенсацiя банка (3 рiк)</td>
				<td>Знижка для банкiв (4 рiк)</td>
				<td>Компенсацiя банка (4 рiк)</td>
				<td>Опис</td>
				<td>Банки</td>
				<td>Марки</td>
				<td>Продукти наступного періоду</td>
				<td>Ритейл</td>
				<td>Страх. 2-й рiк</td>
				<td>Показувати</td>
				<td>ДТП	</td>
				<td>Нез. завол.	</td>
				<td>ПДТО	</td>
				<td>Пожежа	</td>
				<td>Стихія	</td>
				<td>Пад. пред.	</td>
				<td>Нап. тварин</td>
				<td>СТАЖ ВОДІЯ меньше 1 року</td>
				<td>СТАЖ ВОДІЯ від 1 до 3 років</td>
				<td>СТАЖ ВОДІЯ від 3 до 10 років</td>
				<td>СТАЖ ВОДІЯ більше 10 років</td>
				<td>ВІК ВОДІЯ до 25 років</td>
				<td>ВІК ВОДІЯ 25-65 років</td>
				<td>ВІК ВОДІЯ більше 65 років</td>
				
				<td>КІЛЬКІСТЬ ОСІБ 1</td>
				<td>КІЛЬКІСТЬ ОСІБ 2</td>
				<td>КІЛЬКІСТЬ ОСІБ від 3-х до 5-т</td>
				<td>КІЛЬКІСТЬ ОСІБ будь-яка особа на законних підставах</td>
				
				<td>ТЕРИТОРІЯ ПЕРЕВАЖНОГО ВИКОРИСТАННЯ   з населенням понад 1 млн. </td>
				<td>ТЕРИТОРІЯ ПЕРЕВАЖНОГО ВИКОРИСТАННЯ   з населенням 500 тис. - 1 млн. </td>
				<td>ТЕРИТОРІЯ ПЕРЕВАЖНОГО ВИКОРИСТАННЯ   з населенням 100 тис. - 500 тис. </td>
				<td>ТЕРИТОРІЯ ПЕРЕВАЖНОГО ВИКОРИСТАННЯ   з населенням 50 тис. – 100 тис </td>
				<td>ТЕРИТОРІЯ ПЕРЕВАЖНОГО ВИКОРИСТАННЯ   з населенням менше 50 тис </td>
				<td>ТЕРИТОРІЯ РIТЕЙЛ  Зона 1 </td>
				<td>ТЕРИТОРІЯ РIТЕЙЛ  Зона 2 </td>
				<td>ТЕРИТОРІЯ РIТЕЙЛ  Зона 3 </td>
				
				<td>ЗОНА Україна</td>
				<td>ЗОНА Україна+СНД</td>
				<td>ЗОНА Україна+Європа</td>
				<td>ЗОНА Україна+СНД+Європа</td>
				
				<td>вартістю до 150 000 грн</td>
				<td>вартістю від 150 000 грн до 800 000 грн</td>
				<td>понад 800 000 грн</td>
				
				<td>2 платежi</td>
				<td>4 платежi</td>
				
				<td>0</td>
				<td>0.25</td>
				<td>0.5</td>
				<td>0.75</td>
				<td>1</td>
				<td>2</td>
				<td>Комiсiя агента ≤ 800 000</td>
				<td>Комiсiя агента ≥ 800 001</td>
				
            </tr>
            <? foreach ($list as $row) {?>
            <tr>
                <td><?=$row['code']?></td>
				<td><?=$row['title']?></td>
				<td><?=($row['insurance_companies_id']==4 ? ' ТДВ "Eкспрес Страхування"' : 'ВАТ «УСК «Гарант-Авто» ') ?></td>
                <td><?=$row['priority_payments_car_service_value']?></td>
				<td><?=$row['priority_payments_examination_value']?></td>
				<td><?=$row['residences_garage_value']?></td>
				<td><?=$row['residences_any_place_value']?></td>
				<td><?=$row['options_deductible_glass_no_value']?></td>
				<td><?=$row['options_alarm_yes_value']?></td>
				<td><?=$row['options_alarm_no_value']?></td>
				<td><?=$row['options_taxy_value']?></td>
				<td><?=$row['options_fifty_fifty_value']?></td>
				<td><?=$row['options_agregate_no_value']?></td>
				<td><?=$row['rate_equipment']?></td>
				<td><?=$row['price_accident']?></td>
				<td><?=$row['rate_accident']?></td>
				<td><?=($row['option_accident'] ? 'Так' : 'Нi') ?></td>
				<td><?=($row['options_agregate_no'] ? 'Так' : 'Нi') ?></td>
				<td><?=$row['bill_bank_account']?></td>
				<td><?=$row['bill_bank_mfo']?></td>
				<td><?
					if ($row['special']==1) echo ' вiдсутнi ';
					if ($row['special']==2) echo '  страхування тест драйву  ';
					if ($row['special']==3) echo '  страхування перегону  ';
					?>
				</td>
				<td><?=$row['max_discount']?></td>
				<td><?=$row['cart_discount']?></td>
				<td><?=$row['bank_discount_value']?></td>
				<td><?=$row['bank_commission_value']?></td>
				<td><?=$row['bank_discount_value1']?></td>
				<td><?=$row['bank_commission_value1']?></td>
				<td><?=$row['bank_discount_value2']?></td>
				<td><?=$row['bank_commission_value2']?></td>
				<td><?=$row['description']?></td>
				<td><?
				$f = $db->getCol('select b.title from insurance_product_financial_institution_assignments a join insurance_financial_institutions b on b.id=a.financial_institutions_id where a.products_id='.$row['products_id']);
				if (is_array($f)) echo implode(";", $f);
				?></td>
				<td><?
				$f = $db->getCol('select b.title from insurance_product_car_brand_assignments a join insurance_car_brands b on b.id=a.car_brands_id where a.products_id='.$row['products_id']);
				if (is_array($f)) echo implode(";", $f);
				?></td>
				<td><?
				$f = $db->getCol('select b.title from insurance_products_related a join insurance_products b on b.id=a.related_products_id where a.products_id='.$row['products_id']);
				if (is_array($f)) echo implode(";", $f);
				?></td>
				<td><?=($row['retail'] ? 'Так' : 'Нi') ?></td>
				<td><?=($row['second_year'] ? 'Так' : 'Нi') ?></td>
				<td><?=($row['publish'] ? 'Так' : 'Нi') ?></td>
				<?
				$rr=$db->getRow('select * from insurance_product_base_rates where car_types_id=8 and products_id='.$row['products_id']);
				echo '<td>'.$rr['base_rate_dtp'].'</td>';
				echo '<td>'.$rr['base_rate_hijacking'].'</td>';
				echo '<td>'.$rr['base_rate_pdto'].'</td>';
				echo '<td>'.$rr['base_rate_fire'].'</td>';
				echo '<td>'.$rr['base_rate_actofgod'].'</td>';
				echo '<td>'.$rr['base_rate_downfall'].'</td>';
				echo '<td>'.$rr['base_rate_animal'].'</td>';
				
				?>
				<?
				$rr=$db->getAll('select * from insurance_product_driver_standings where  products_id='.$row['products_id'].' order by driver_standings_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				<?
				$rr=$db->getAll('select * from insurance_product_driver_ages where  products_id='.$row['products_id'].' order by driver_ages_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_drivers where  products_id='.$row['products_id'].' order by drivers_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_regions where regions_id<13 AND products_id='.$row['products_id'].' order by regions_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_regions where regions_id>=13 AND products_id='.$row['products_id'].' order by regions_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				
				<?
				$rr=$db->getAll('select * from  insurance_product_zones where   products_id='.$row['products_id'].' order by zones_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from  insurance_product_car_prices where   products_id='.$row['products_id'].' order by car_price_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
 				
				?>
				
				<?
				$rr=$db->getAll('select * from   insurance_product_payment_breakdowns where   products_id='.$row['products_id'].' order by payment_breakdown_id ');
				foreach($rr as $rr1) {
					echo '<td>'.$rr1['value'].'</td>';
				}	
				$fr = $db->getAssoc('select value0,value_other from insurance_product_deductibles where products_id='.$row['products_id'].' and car_types_id=8 and value1=7');
				
				?>
				<td><?=($fr['0.00'] ? $fr['0.00'] : '-')?></td>
				<td><?=($fr['0.25'] ? $fr['0.25'] : '-')?></td>
				<td><?=($fr['0.50'] ? $fr['0.50'] : '-')?></td>
				<td><?=($fr['0.75'] ? $fr['0.75'] : '-')?></td>
				<td><?=($fr['1.00'] ? $fr['1.00'] : '-')?></td>
				<td><?=($fr['2.00'] ? $fr['2.00'] : '-')?></td>
				<td><?=$row['agent_commission_value']?></td>
				<td><?=$row['agent_commission_value2']?></td>
            </tr>
            <?}?>
        </table>
    </body>
</html>