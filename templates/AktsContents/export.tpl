 
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
	<p>Номер акта: <?=$data['akt']['number']?>
	<br>Тип контрагента: <?
		switch($data['akt']['person_types_id']) {
			case 1:
				echo ' фiз особа агент ';
				break;
			case 2:
				echo '  фiз особа директор  ';
				break;
			case 3:
				echo '  фiз особа заст. директора  ';
				break;	
			case 4:
				echo '  фiз особа керiвник вiдд продажу  ';
				break;
			case 5:
				echo '  юр особа  ';
				break;	
				
		}
		
		
	?>
	<br>Дата акта: <?=date('d.m.Y',strtotime( $data['akt']['date'] )) 	?>
	<br>Агент: <?=$data['akt']['agent_name']?>
	<br>Номер картки: <?=$data['akt']['agent']['skr']?>
	<br>Дата дії: <?=$data['akt']['agent']['cart_date']?>
	<br>Назва банку: <?=$data['akt']['agent']['bank_name']?>
	<br>МФО 2: <?=$data['akt']['agent']['mfo2']?>
	<br>ЗКПО 2: <?=$data['akt']['agent']['zkpo2']?>
	<br>Рахунок 2: <?=$data['akt']['agent']['bank_account2']?>
	
	<br>Оплата акта статус: <?
		switch($data['akt']['payment_statuses_id']) {
			case 1:
				echo ' не сплачено ';
				break;
			case 2:
				echo '  частково сплачено  ';
				break;
			case 3:
				echo '  сплачено  ';
				break;	
			case 4:
				echo '  переплата  ';
				break;
		 	
				
		}
		
	if ($data['akt']['sellers_department']) {
		$plans_id = $db->getOne('select id from insurance_policy_plans where date='.$db->quote($data['akt']['date']));
		$pr = $db->getRow('select * from insurance_policy_plans_agents where agreement_number='.$db->quote($data['akt']['agreement_number']).' and plans_id='.$plans_id);
		echo '<br>Кредит/КАСКО Банк,шт: '.$pr['credit_cars'];
		echo '<br>Пролонгацiя Рітейл,шт: '.$pr['continued_cars'];
		echo '<br>Рітейл 1й рік,шт: '.$pr['not_credit_cars'];
		echo '<br>ОСАГО,шт: '.$pr['go_cars'];
		echo '<br>Кредит/КАСКО Банк,грн: '.$pr['credit_cars_money'];
		echo '<br>Пролонгацiя Рітейл,грн: '.$pr['continued_cars_money'];
		echo '<br>Рітейл 1й рік,грн: '.$pr['not_credit_cars_money'];
		echo '<br>ОСАГО,грн: '.$pr['go_cars_money'];
	
	}

	else {
	
	
	?>
	<br>Кредитнi авто план: <?=$data['akt']['credit_cars']?>
	<br>Не кредитнi авто план: <?=$data['akt']['not_credit_cars']?>
	<!--<br>Пролонгованi авто план: <?=$data['akt']['continued_cars']?>-->
	<br>ЦВ авто план: <?=$data['akt']['go_cars']?>
	
	<?
	}
	if (is_array($data['plan'])) {
		$c=0;
		foreach($data['plan'] as $plan) {
			if ($plan['types_id']==1) $c++;
		}
		echo '<br>Факт виконання по КАСКО БАНК: '.$c;
			$c=0;
		foreach($data['plan'] as $plan) {
			if ($plan['types_id']==3) $c++;
		}
		echo '<br>Факт виконання по КАСКО БАНК/Пролонгацiя: '.$c;
		
		$c=0;
		foreach($data['plan'] as $plan) {
			if ($plan['types_id']==2) $c++;
		}
		echo '<br>Факт виконання по КАСКО РIТЕЙЛ: '.$c;
		
		
		$c=0;
		foreach($data['plan'] as $plan) {
			if ($plan['types_id']==4) $c++;
		}
		echo '<br>Факт виконання по ЦВ: '.$c;
		
		
	}
	
	
	?>
	
	<br>
        <table border="1" cellpadding=0 cellspacing=0>
            <tr class="columns">
                <td>Полис</td>
				<td>Дата полiсу</td>
				<td>ПІБ страхувальника</td>
				<td>Страхова сума, грн.</td>
                <td>Платеж, грн</td>
				<td>Марка/Модель</td>
				<? if  ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR 
				|| ($Authorization->data['roles_id']!=ROLES_AGENT  && $Authorization->data['permissions']['Akts']['showall'])) { ?>
                <td>База Комісія, %</td>
                <td>База Комісія, грн</td>
				<?}?>
				<? if ($Authorization->data['roles_id']!=ROLES_AGENT || SHOW_ACT_COMISSION) {?>
                <td>Комісія, %</td>
                <td>Комісія, грн</td>
				<?}?>
				<? if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || 
				($Authorization->data['roles_id']!=ROLES_AGENT  && $Authorization->data['permissions']['Akts']['showall']))   {?>
				<td>КВ банка от СС </td>
				<td>КВ банка от СП  </td>
				<?}?>
                <td>Поточний/Попереднiй</td>
				<td>Дата сплати, згідно договору</td>
				<td>Дата фактичної сплати</td>
                <td>Статус</td>
				<td>Документи</td>
                <td>Комiсiя</td>
				<td>Дата перевірки договору </td>
				<td>Знижка за рахунок комісії агента, % </td>
				<td>Менеджер, що привів клієнта</td>
				<td>СТО</td>
				<td>Зарахований в план за звітний період</td>
                <td>Редаговано</td>
				<td>Агенція продавець</td>
				<td>Менеджер продавець</td>
				<td>Тип доп угоди</td>
				<?
				if ($data['akt']['sellers_department'] && $Authorization->data['roles_id']!=ROLES_AGENT) {
				echo '<td>Попереднiй</td>';
				echo '<td>1</td><td>2</td>';
				}
				?>
            </tr>

			<? foreach ($list as $row) {
			
				$policy = null;
				if (is_Array($data['policies'])) {
					foreach($data['policies'] as $p) {
						if ($p['akts_contents_id'] == $row['id']) {
							$policy = $p;
							break;
						}
						
					}
				}
			?>
            <tr>
                <td><?=$row['number']?></td>
				<td><?=$policy['policy_date']?></td>
				<td><?=$policy['insurer']?></td>
				<td><?=str_replace('.',',',$policy['price'])?></td>
				
				
                <td><?=str_replace('.',',',$row['payment_amount'])?></td>
				<td><?=$policy['item']?></td>
				<? if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || 
				($Authorization->data['roles_id']!=ROLES_AGENT  && $Authorization->data['permissions']['Akts']['showall'])) {?>
                <td><?=str_replace('.',',',$row['base_commission_percent'])?></td>
                <td><?=str_replace('.',',',$row['base_commission_amount'])?></td>
				<?}?>
				<? if ($Authorization->data['roles_id']!=ROLES_AGENT || SHOW_ACT_COMISSION) {?>
                <td><?=str_replace('.',',',$row['commission_percent'])?></td>
                <td><?=str_replace('.',',',$row['commission_amount'])?></td>
				<?}?>
				
				<?if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR ||
				($Authorization->data['roles_id']!=ROLES_AGENT  && $Authorization->data['permissions']['Akts']['showall'])) {?>
				<td><?=str_replace('.',',',$policy['bank_commission_value'])?></td>
				<td><?=str_replace('.',',',$policy['bank_discount_value'])?></td>
				<?}?>
				
                <td><?=($row['types_id']==1 ? 'Поточний' : 'Попереднiй') ?></td>
				<td><?=$policy['plandate']?></td>
				<td><?=$policy['factdate']?></td>
                <td><?=$row['statuses_id']?></td>
				<td><?=($policy['documents']==1 ? 'Так' : 'Нi') ?></td>
                <td><?=($row['documents']==1 ? 'Так' : 'Нi') ?></td>
				<td><?=$policy['checkpolicy']?></td>
				
				<td><?=str_replace('.',',',$policy['discount'])?></td>
				<td><?=$policy['managerfio']?></td>
				<td><?=($policy['service']==1 ? 'Так' : 'Нi') ?></td>
				<td><?=$policy['infact']?></td>
				
                <td><?=$row['modified_format']?></td>
				
				<td><?=$policy['agency_title']?></td>
				<td><?=$policy['agent_name']?></td>
				<td><?
				if($policy['agreement_types_id']>0) {
					if($policy['agreement_types_id']==3)
						echo 'Дострахування/Поновлення СС';
					else
						echo 'Доп угода';
				}
				else {
				echo '-';
				}
				?></td>
				<?
				if ($data['akt']['sellers_department'] && $Authorization->data['roles_id']!=ROLES_AGENT) {
					echo '<td>'.$policy['parent_number'].'</td>';
				
					if(strpos($row['number'], '202.')!==false) {
						if ($row['base_commission_percent'] == $row['commission_percent'] || $data['akt']['number']=='13155/ВП.10.15' || $data['akt']['number']=='13534/ВП.10.15'){
							echo '<td>'.str_replace('.',',',$row['base_commission_percent']*7/6).'</td>';
							echo '<td>'.str_replace('.',',',$row['base_commission_amount']*7/6).'</td>';
							
						}
						else {
							echo '<td>'.str_replace('.',',',$row['base_commission_percent']*5/6).'</td>';
							echo '<td>'.str_replace('.',',',$row['base_commission_amount']*5/6).'</td>';
							

						}
					}
					else echo '<td></td><td></td>';
				}
				?>
            </tr>
            <?}?>
        </table>
		<?
		if (!is_array($data['ek'])) $data['ek']=array();
		?>
		<br>Продаж кредитних авто 




<table border=1 cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td ><b>№ анкети</b></td>
	<td  ><b>Транспортний засіб</b></td>
	<td  ><b>ПІБ Клієнта</b></td>
	<td  ><b>Сума кредиту, грн</b></td>
	<td  ><b>Комiciя, %</b></td>
    <td  ><b>Комiciя, грн</b></td>
</tr>
 
<? foreach($data['ek'] as $ek) {
echo '
<tr>
	<td>'.$ek['number'].'</td>
	<td>'.$ek['cars_title'].'</td>
	<td>'.$ek['client'].'</td>
	<td>'.str_replace('.',',',$ek['credit_amount']).'</td>
	<td>'.str_replace('.',',',$ek['commission_percent']).'</td>
    <td>'.str_replace('.',',',$ek['commission_amount']).'</td>
</tr>';
}
?>

 

 
</table><br /><br />
    </body>
</html>