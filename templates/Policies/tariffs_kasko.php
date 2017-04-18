<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <title>Тарифы КАСКО</title>
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
				<td>Тип авто</td>
                <td>Зона дії полісу</td>
				<td>Мінімальний водійський стаж</td>
				<td>Вік водія</td>
				<td>Кількість осіб</td>
				<td>Територія переважного використання</td>
				<td>без врахування зносу</td>
				<td>без франшизи на вітрові стекла</td>
				<td>неагрегатна страхова сума</td>
				<td>Пріоритет виплати</td>
				<td>Місце зберігання ТЗ</td>
				<?foreach ($deductibles as $deductible)
				{
					echo '<td>'.$deductible['title'].'</td>';
					echo '<td>'.$deductible['title'].' (-30%)</td>';
					echo '<td>'.$deductible['title'].' П</td>';
				}
				?>
                
            </tr>
			
			<?
			$c=0;
				foreach ($car_types as $car_type) {
					foreach ($zones as $zone) {
						foreach ($driver_standings as $driver_standing) {
							foreach ($driver_ages as $driver_age) {
								foreach ($drivers as $driver) {
									foreach ($regions as $region) {
										foreach ($options_deterioration_no as $optionsDeterioration) {
											foreach ($options_deductible_glass_no as $optionsDeductibleGlass) {
												foreach ($options_agregate_no as $optionsAgregate) {
													foreach ($priorityPayments as $priorityPayment) {
														foreach ($residences as $residence) {
														$c++;
														?>
														 <tr>
															<td><?=$car_type['title']?></td>
															<td><?=$zone['title']?></td>
															<td><?=$driver_standing['title']?></td>
															<td><?=$driver_age['title']?></td>
															<td><?=$driver['title']?></td>
															<td><?=$region['title']?></td>
															<td><?=$optionsDeterioration['title']?></td>
															<td><?=$optionsDeductibleGlass['title']?></td>
															<td><?=$optionsAgregate['title']?></td>
															<td><?=$priorityPayment['title']?></td>
															<td><?=$residence['title']?></td>
															<?foreach ($deductibles as $deductible)
															{
																$item=array();
																$item['year']=date('Y');
																$item['brands_id']=$brands_id;
																$item['protection_multlock']=1;

																$data['zones_id']=$zone['id'];
																$data['items']=array();
																$data['items'][]=$item;
																$data['agencies_id']=1;
																$data['date']=date('Y-m-d');
																$data['discount']=0;
																$data['priority_payments_id']=$priorityPayment['id'];
																$data['residences_id']=$residence['id'];
																$data['risks']=array();
																$data['risks'][]=1;
																$data['risks'][]=2;
																$data['risks'][]=3;
																$data['risks'][]=4;
																$data['risks'][]=5;
																$data['risks'][]=6;
																$data['risks'][]=7;
																$data['options_deductible_glass_no']=$optionsDeductibleGlass['id'];
																$data['options_agregate_no']=$optionsAgregate['id'];
																$data['drivers_id']=$driver['id'];
																$data['options_deterioration_no']=$optionsDeterioration['id'];
																
																$Products->calculate(1000, $car_type['id'], 1, $driver_standing['id'], $driver['id'], 100000, $driver_age['id'], $region['cities_id'], 29, $deductible['id'], $data, $item);
																echo '<td>'.str_replace('.',',',$item['rate_kasko']).'</td>';
																echo '<td>'.str_replace('.',',',$item['rate_kasko']*0.7).'</td>';
																echo '<td>'.str_replace('.',',',$item['P']).'</td>';
															}
															?>
															
														</tr>
														
														<?
														
														}
													}
												}
											}
										}
									}
								}
							}	
						}
					}
				}
		//echo $c;
			?>
            
         
        </table>
    </body>
</html>