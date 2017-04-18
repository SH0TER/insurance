<html>
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
<? if(!intval($data['types_id'])) { ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<?php if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
		<tr class="columns">
			<td colspan="17">Договір</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 7 : 5 ?>">Страхувальник</td>
			<td colspan="6">Об'єкт</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 20 : 13 ?>">Період страхування</td>
			<td colspan="8">Продавець</td>
			<td colspan="2">Підписант</td>
			<td colspan="2">Комісія агента</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?><td colspan="3">Комісія банка</td><?php } ?>
			<td colspan="8">Задача</td>
			<td rowspan="2">Повідомлення</td>
			<td rowspan="2">Область в которой клиент первый раз оформлял договор КАСКО</td>
			<td rowspan="2">Количество водителей</td>
			<td rowspan="2">Территория эксплуатации</td>
			<td rowspan="2">Стаж вождения</td>
			<td rowspan="2">Возраст водителя</td>
			<td rowspan="2">Место хранения ТС</td>
			<td rowspan="2">Приоритет выплат</td>
			<td rowspan="2">Страхование без противоугонных средств</td>
			<td rowspan="2">Место регистрации</td>
			<td rowspan="2">КПП</td>
			<td rowspan="2">Тип кузова</td>
			<td rowspan="2">Топливо</td>
			<?php if (intval($data['with_accidents'])) { ?>
			<td colspan="4">Страхові випадки</td>
			<? } ?>
		</tr>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Банк</td>
			<td>Експрес Асістанс</td>
			<td>Статус</td>
			<td>Додаткова угода</td>
			<td>Багаторічний</td>
			<td>Документи</td>
			<td>Комісія</td>
			<td>Опція "Тест-драйв"</td>
			<td>Опція "Перегон"</td>
			<td>Опція "Неагрегатна страхова сума"</td>
			<td>Опція "50/50"</td>
			<td>Стороний клиент</td>
			<td>CarMan@CarWoman</td>

			<td>Особа</td>
			<td>Назва/ПІБ</td>
            <td>VIP</td>
			<td>Група</td>
			<td>ІПН/ЄДРПОУ</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Адреса</td>
			<td>Телефон</td>
			<?php } ?>

			<td>Марка/Модель</td>
			<td>Кузов</td>
			<td>Держ номер</td>
			<td>Об'єм двигуна</td>
			<td>Рік випуску</td>
			<td>Пробіг, тис. км.</td>


			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Продукт</td>
			<td>Вірогідний продукт</td>
			<td>Попередній продукт</td>
			<td>Формула</td>
            <td>Коментар андерайтера</td>
			<td>Останній період року</td>
			<?php } ?>
			<td>Сума, грн.</td>
			<td>Ринк. варт., грн.</td>
			<td>Тариф, %</td>
			<td>Премія, грн.</td>
			<td>Сплачено, грн.</td>
			<td>Сплата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Пролонгація</td>
			<td>Розбивка</td>
			<td>Номер платежу (розбивка)</td>
			<td>Рік страхування</td>
			<td>Другий платіж "50/50"</td>
			<td>Додаткова угода</td>

			<td>Головна агенція</td>
			<td>Агенція</td>
			<td>% КВ для МП</td>
			<td>Область</td>
			<td>Канал</td>
			<td>Продавець</td>
			<td>Менеджер що привiв клiєнта</td>
			<td>Сервіс</td>

			<td>Агенція</td>
			<td>Продавець</td>			
			<td>%</td>
			<td>грн.</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>% від СС</td>
			<td>% від премії</td>
			<td>грн.</td>
			<? } ?>

            <td>Тип</td>
            <td>Виконавець</td>
			<td>Результат дзвінка</td>
			<td>Дата дзвінка</td>
			<td>Статус</td>
            <td>Стан</td>
			<td>Дата статуса</td>
			<td>Коментарі</td>	
			
			<?php if (intval($data['with_accidents'])) { ?>
			<td>Дата</td>
			<td>Ризик</td>
			<td>Орієнтовний збиток</td>
			<td>Відшкодування</td>
			<? } ?>
		</tr>
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
                    list($row['task_statuses_title'], $row['task_states_title']) = explode(' \\ ', $row['task_statuses_full_title']);
					
					$sql = 'SELECT GROUP_CONCAT(CONCAT(\'Дата: \', date_format(created, \'%d.%m.%Y %H:%i:%s\'), \'; автор: \', author, \'; тема: \', subject, \'; текст: \', text) ORDER BY created ASC SEPARATOR \'; \') ' .
						   'FROM ' . PREFIX . '_policy_messages ' .
						   'WHERE policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
					$messages = $db->getOne($sql);
					
					if (intval($data['with_accidents'])) {
						$sql = 'SELECT date_format(a.date, \'%d.%m.%Y\') as date, c.title as risk, a.amount_rough, getCompensation(a.id, 3) as amount ' .
							   'FROM ' . PREFIX . '_accidents as a ' .
							   'JOIN ' . PREFIX . '_accidents_kasko as b ON a.id = b.accidents_id ' .
							   'JOIN ' . PREFIX . '_parameters_risks as c on a.application_risks_id = c.id ' .
							   'WHERE b.items_id = ' . intval($row['items_id']) . ' AND a.date BETWEEN ' . $db->quote(date('Y-m-d', strtotime($row['begin_datetime_format']))) . ' AND ' . $db->quote(date('Y-m-d', strtotime($row['interrupt_datetime_format'])));
						$accidents = $db->getAll($sql);
						
						if (is_array($accidents) && sizeOf($accidents)) {
							$row_count = sizeOf($accidents);
						} else {
							$row_count = 1;
						}
					} else {
						$row_count = 1;
					}
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['policies_number']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_date']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_begin_datetime_format']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_end_datetime_format']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['financial_institutions_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['card_assistance']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policy_statuses_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['is_agr_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['long_term']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_documents']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_commission']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['options_test_drive']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['options_race']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['options_agregate_no']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['options_fifty_fifty']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['outside_client']==1 ? 'Так' : 'Ні'?></td>
			<td style="mso-number-format:'\@'" rowspan="<?=$row_count?>"><?=$row['card_car_man_woman']?></td>

			<td rowspan="<?=$row_count?>"><?=($row['insurer_person_types_id'] == 1) ? 'Фізична' : 'Юридична'?></td>
			<td rowspan="<?=$row_count?>"><?=$row['insurer']?></td>
            <td rowspan="<?=$row_count?>"><?=($row['important_person'] == 1) ? 'Так' : 'Ні'?></td>
            <td rowspan="<?=$row_count?>"><?=$row['client_groups_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['insurer_identification']?></td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td rowspan="<?=$row_count?>"><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td rowspan="<?=$row_count?>"><?=$row['insurer_phone']?></td>
			<?php } ?>

			<td><?=$row['item']?></td>
			<td><?=$row['shassi']?></td>
			<td><?=$row['sign']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['engine_size']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['year']?></td>			
			<td rowspan="<?=$row_count?>"><?=$row['race']?></td>			

			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
				<td rowspan="<?=$row_count?>"><?=$row['policies_kasko_item_years_payments_products_title']?></td>
			
				<?php if ($row['policies_kasko_item_years_payments_products_title'] == '') { 
						if ($row['begin_datetime_format'] != $row['policies_begin_datetime_format']) {
							if (intval($row['financial_institutions_id'])) {
								$sql = 'select concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
										from insurance_products as a
										join insurance_products_kasko as b on a.id = b.products_id
										join insurance_products_related as c on a.id = c.related_products_id
										join insurance_product_financial_institution_assignments as d on a.id = d.products_id
										join insurance_product_agency_assignments as e on a.id = e.products_id
										where c.products_id = ' . intval($row['products_id']) . ' and d.financial_institutions_id = ' . intval($row['financial_institutions_id']) . ' and e.agencies_id = ' . intval($row['agencies_id']);
								$new_products = $db->getCol($sql);
							} else {
								$sql = 'select concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
										from insurance_products as a
										join insurance_products_kasko as b on a.id = b.products_id
										join insurance_products_related as c on a.id = c.related_products_id
										join insurance_product_agency_assignments as e on a.id = e.products_id
										where c.products_id = ' . intval($row['products_id']) . ' and e.agencies_id = ' . intval($row['agencies_id']);
								$new_products = $db->getCol($sql);
							}
							
							$row['probability_products_title'] = /*$sql;*/implode(', ', $new_products);
						} else {
							$sql = 'select concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
									from insurance_products as a
									join insurance_products_kasko as b on a.id = b.products_id
									where a.id = ' . intval($row['products_id']);
							$new_product = $db->getOne($sql);
							
							$row['probability_products_title'] = /*$sql;*/$new_product;
						}
				?>
					<td rowspan="<?=$row_count?>"><?=$row['probability_products_title']?></td>
				<? } else { ?>
					<td rowspan="<?=$row_count?>">&nbsp;</td>
				<? } ?>
				
			<?
				$sql = 'select concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
						from insurance_products as a
						join insurance_products_kasko as b on a.id = b.products_id
						join insurance_policies_kasko_items as c on b.products_id = c.products_id
						join insurance_policies as d on c.policies_id = d.id
						where d.id = ' . intval($row['policies_top']) . ' and d.parent_id = 0';
				$first_product = $db->getOne($sql);
			?>
			<td rowspan="<?=$row_count?>"><?=$first_product?></td>
				
			<td rowspan="<?=$row_count?>"><?=$row['policies_kasko_item_years_payments_formula']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['policies_kasko_comment_quote']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['last_years_period_title']?></td>
			<?php } ?>
			<td rowspan="<?=$row_count?>" align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td rowspan="<?=$row_count?>" align="right"><?=getMoneyFormat($row['market_price'], -1)?></td>
			<td rowspan="<?=$row_count?>" align="right"><?=getRateFormat($row['rate'])?></td>
			<td rowspan="<?=$row_count?>" align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
			<td rowspan="<?=$row_count?>" align="right"><?=getMoneyFormat($row['policy_payments_calendar_amount'], -1)?></td>
			<td rowspan="<?=$row_count?>"><?=$row['payments_date']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['begin_datetime_format']?></td>
			<td rowspan="<?=$row_count?>">
				<? if(intval($row['payment_brakedown_id']) === 1) {
					echo $row['policies_end_datetime_format'];
				} else {
					echo $row['interrupt_datetime_format'];
				} ?>
			</td>
			<td rowspan="<?=$row_count?>"><?=$row['prolongation_number']?></td>
			<td rowspan="<?=$row_count?>">
			<?
				echo $row['policy_payments_calendar_number'] . ' - ';

				switch ($row['payment_brakedown_id']) {
					case 2:
						echo '6 місяців';
						break;
					case 3:
						echo '3 місяці';
						break;
					default:
						echo 'разовий';
						break;
				}
			?>
			</td>
			<td rowspan="<?=$row_count?>"><?=$row['number_part_payment']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['number_insurance_year']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['second_fifty_fifty_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$agreement_types_title[$row['agreement_types_id']]?></td>

			<td rowspan="<?=$row_count?>"><?=$row['agencies_parent_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['agencies_title']?></td>

			<td rowspan="<?=$row_count?>"><?=$row['motivation_manager_percent']?></td>
			
			<td rowspan="<?=$row_count?>"><?=$row['regions_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['agency_types_title']?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['task_types_id']==3 && intval($row['financial_institutions_id'])==0)
				echo $row['task_performers_title'];
			else echo $row['seller'];
			?></td>
			<td rowspan="<?=$row_count?>"><?=$row['manager_agent']?></td>
			<td rowspan="<?=$row_count?>"><?=(intval($row['service']) ? 'так' : 'ні')?></td>

			

			<td rowspan="<?=$row_count?>"><?=$row['seller_agencies_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['seller_agents_title']?></td>			

			<td rowspan="<?=$row_count?>"><?=str_replace('.', ',', $row['policies_commission_agent_percent'])?></td>
			<td rowspan="<?=$row_count?>"><?=str_replace('.', ',', $row['policy_payments_calendar_commission_agent_amount'])?></td>

			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td rowspan="<?=$row_count?>"><?=str_replace('.', ',', $row['policies_kasko_item_years_payments_bank_discount_value'])?></td>
			<td rowspan="<?=$row_count?>"><?=str_replace('.', ',', $row['policies_kasko_item_years_payments_bank_commission_value'])?></td>
			<td rowspan="<?=$row_count?>"><?=str_replace('.', ',', round($row['policy_payments_calendar_amount'] * (1 - round(1/$row['policies_kasko_item_years_payments_bank_discount_value'], 3)) + $row['price'] * $row['policies_kasko_item_years_payments_bank_commission_value'] * $row['policy_payments_calendar_amount'] / $row['amount'] / 100, 2))?></td>
			<?php } ?>

            <td rowspan="<?=$row_count?>"><?=$row['task_types_title']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['task_performers_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_statuses_call_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_statuses_call_date']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['task_statuses_title']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['task_states_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_statuses_date']?></td>
			<td rowspan="<?=$row_count?>"><?=$data['persons']?></td>			
			<td rowspan="<?=$row_count?>"><?=$messages?></td>
			
			<td rowspan="<?=$row_count?>">
			<?
				$sql = 'select c.title
						from insurance_policies as a
						join insurance_agencies b on b.id=a.agencies_id 
						join insurance_regions c on c.id=b.regions_id
						where a.id = ' . intval($row['policies_top']) . '  ';
				$region = $db->getOne($sql);
				echo $region;
			?>
			</td>
			
			<td rowspan="<?=$row_count?>"><?=$data['number_drivers']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['zone']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['driverExp']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['driverAge']?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['residences']==1) echo 'стоянка що охороняється'; else echo 'будь-яке місце';
			?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['priorityPayments']==1) echo 'СТО'; else echo 'експертиза';
			?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['noImmobiliser']==1) echo 'Да'; else echo 'Нет';
			?></td>
			<td rowspan="<?=$row_count?>"><?=$row['registration']?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['transmissionsAuto']==1) echo 'Автомат'; else if ($row['transmissionsAuto']==2) echo 'Ручна / Механіка'; else if ($row['transmissionsAuto']==3) echo 'Адаптивна'; else if ($row['transmissionsAuto']==4) echo 'Варіатор'; else if ($row['transmissionsAuto']==5) echo 'Типтронік'; else echo '';
			?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['carBody']==1) echo 'Седан'; else if ($row['carBody']==2) echo 'Універсал'; else if ($row['carBody']==3) echo 'Позашляхових / Кроссовер'; else if ($row['carBody']==4) echo 'Хетчбек'; else if ($row['carBody']==5) echo 'Кабріолет'; else if ($row['carBody']==6) echo 'Купе'; else if ($row['carBody']==7) echo 'Лімузин'; else if ($row['carBody']==8) echo 'Мікроавтобус'; else if ($row['carBody']==9) echo 'Мінівен'; else if ($row['carBody']==10) echo 'Пікап'; else if ($row['carBody']==11) echo 'Фургон'; else echo '';
			?></td>
			<td rowspan="<?=$row_count?>"><?
			if ($row['engineType']==1) echo 'Бензин'; else if ($row['engineType']==2) echo 'Дизель'; else if ($row['engineType']==3) echo 'Газ'; else if ($row['engineType']==4) echo 'Газ/бензин'; else if ($row['engineType']==5) echo 'Гібрид'; else if ($row['engineType']==6) echo 'Електро'; else echo '';
			?></td>
			
			
			
			<?
				if (intval($data['with_accidents'])) {
					if (sizeOf($accidents)) {
						$i = 0;
						foreach ($accidents as $accident) {
							if ($i) {
								echo '</tr><tr>';
								echo '<td>' . $row['policies_number'] . '</td>';
								echo '<td>' . $row['item'] . '</td>';								
								echo '<td>' . $row['shassi'] . '</td>';
								echo '<td>' . $row['sign'] . '</td>';
							}
							echo '<td>' . $accident['date'] . '</td>';
							echo '<td>' . $accident['risk'] . '</td>';
							echo '<td>' . $accident['amount_rough'] . '</td>';
							echo '<td>' . $accident['amount'] . '</td>';
							$i++;
						}
					} else {
						echo "<td>&nbsp;</td>";
						echo "<td>&nbsp;</td>";
						echo "<td>&nbsp;</td>";
						echo "<td>&nbsp;</td>";
					}
				}
			?>
			
		</tr>
		<?
				}
			}
		?>
	<?php } ?>
	
	<?php if ($data['product_types_id'] == PRODUCT_TYPES_GO || $data['product_types_id'] == PRODUCT_TYPES_DGO) { ?>
		<tr class="columns">
			<td colspan="7">Договір</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 8 : 6 ?>">Страхувальник</td>
			<td colspan="4">Об'єкт</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 7 : 6 ?>">Період страхування</td>
			<td colspan="<?php echo ($data['product_types_id'] == PRODUCT_TYPES_GO) ? 9 : 9?>">Продавець</td>
			<td colspan="2">Підписант</td>
			<td colspan="2">Комісія агента</td>
			<td colspan="8">Задача</td>
			<td rowspan="2">Повідомлення</td>
			<td rowspan="2">Коментар андерайтера</td>
			
			<?php if (intval($data['with_accidents'])) { ?>
			<td colspan="4">Страхові випадки</td>
			<? } ?>
			
		</tr>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Статус</td>
			<td>Документи</td>
			<td>Комісія</td>

			<td>Особа</td>
			<td>Назва/ПІБ</td>
            <td>VIP</td>
			<td>Стороний клиент</td>
			<td>Група</td>
			<td>ІПН/ЄДРПОУ</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Адреса</td>
			<td>Телефон</td>
			<?php } ?>

			<td>Марка/Модель</td>
			<td>Кузов</td>
			<td>Держ номер</td>
			<td>Експрес Асістанс</td>

			<td>Сума, грн.</td>
			<td>Тариф, %</td>
			<td>Премія, грн.</td>
			<td>Сплата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Пролонгація</td>

			<td>Головна агенція</td>
			<td>Агенція</td>
			<td>% КВ для МП</td>
			<td>Область</td>
			<td>Канал</td>
			<td>Продавець</td>
            <? if ($data['product_types_id'] == PRODUCT_TYPES_GO || $data['product_types_id'] == PRODUCT_TYPES_DGO) { ?>
                <td>Менеджер що привiв клiєнта</td>
            <? } ?>
            <td>Сервіс</td>
			<td>Axapta</td>

			<td>Агенція</td>
			<td>Продавець</td>

			<td>%</td>
			<td>грн.</td>

            <td>Тип</td>
            <td>Виконавець</td>
			<td>Результат дзвінка</td>
			<td>Дата дзвінка</td>
			<td>Статус</td>
            <td>Стан</td>
			<td>Дата статуса</td>
			<td>Коментарі</td>	
			<?php if (intval($data['with_accidents'])) { ?>
			<td>Дата</td>
			<td>Ризик</td>
			<td>Орієнтовний збиток</td>
			<td>Відшкодування</td>
			<? } ?>

		</tr>
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
					$sql = 'SELECT GROUP_CONCAT(CONCAT(\'Дата: \', date_format(created, \'%d.%m.%Y %H:%i:%s\'), \'; автор: \', author, \'; тема: \', subject, \'; текст: \', text) ORDER BY created ASC SEPARATOR \'; \') ' .
						   'FROM ' . PREFIX . '_policy_messages ' .
						   'WHERE policies_id = ' . intval($row['policies_id']) . ' GROUP BY policies_id';
					$messages = $db->getOne($sql);
					
					if (intval($data['with_accidents'])) {
						$sql = 'SELECT date_format(a.date, \'%d.%m.%Y\') as date, c.title as risk, a.amount_rough, getCompensation(a.id, 3) as amount ' .
							   'FROM ' . PREFIX . '_accidents as a ' .
							   'JOIN ' . PREFIX . '_parameters_risks as c on a.application_risks_id = c.id ' .
							   'WHERE a.policies_id = ' . intval($row['policies_id']) . ' AND a.date BETWEEN ' . $db->quote(date('Y-m-d', strtotime($row['begin_datetime_format']))) . ' AND ' . $db->quote(date('Y-m-d', strtotime($row['interrupt_datetime_format'])));
						$accidents = $db->getAll($sql);
						
						if (is_array($accidents) && sizeOf($accidents)) {
							$row_count = sizeOf($accidents);
						} else {
							$row_count = 1;
						}
					} else {
						$row_count = 1;
					}
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td rowspan="<?=$row_count?>"><?=$row['policies_number']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_date']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_begin_datetime_format']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_end_datetime_format']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policy_statuses_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_documents']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policies_commission']?></td>

			<td rowspan="<?=$row_count?>"><?=($row['insurer_person_types_id'] == 1) ? 'Фізична' : 'Юридична'?></td>
			<td rowspan="<?=$row_count?>"><?=$row['insurer']?></td>
            <td rowspan="<?=$row_count?>"><?=($row['important_person'] == 1) ? 'Так' : 'Ні'?></td>
			<td rowspan="<?=$row_count?>"><?=($row['outside_client'] == 1) ? 'Так' : 'Ні'?></td>
			<td rowspan="<?=$row_count?>"><?=$row['client_groups_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['insurer_identification']?></td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td rowspan="<?=$row_count?>"><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td rowspan="<?=$row_count?>"><?=$row['insurer_phone']?></td>
			<?php } ?>

			<td rowspan="<?=$row_count?>"><?=$row['item']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['shassi']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['sign']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['card_assistance']?></td>

			<td rowspan="<?=$row_count?>" align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td rowspan="<?=$row_count?>" align="right"><?=getRateFormat($row['rate'])?></td>
			<td rowspan="<?=$row_count?>" align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
			<td rowspan="<?=$row_count?>"><?=$row['payments_date']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['begin_datetime_format']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['interrupt_datetime_format']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['prolongation_number']?></td>

			<td rowspan="<?=$row_count?>"><?=$row['agencies_parent_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['agencies_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['motivation_manager_percent']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['regions_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['agency_types_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['seller']?></td>
            <? if ($data['product_types_id'] == PRODUCT_TYPES_GO || $data['product_types_id'] == PRODUCT_TYPES_DGO) { ?>
                <td rowspan="<?=$row_count?>"><?=$row['manager_agent']?></td>
            <? } ?>
            <td rowspan="<?=$row_count?>"><?=(intval($row['service']) ? 'так' : 'ні')?></td>
			<td rowspan="<?=$row_count?>"><?=(intval($row['axapta_car']) ? 'так' : 'ні')?></td>

			<td rowspan="<?=$row_count?>"><?=$row['seller_agencies_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['seller_agents_title']?></td>

			<td rowspan="<?=$row_count?>"><?=$row['policies_commission_agent_percent']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['policy_payments_calendar_commission_agent_amount']?></td>

            <td rowspan="<?=$row_count?>"><?=$row['task_types_title']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['task_performers_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_statuses_call_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_statuses_call_date']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['task_statuses_title']?></td>
            <td rowspan="<?=$row_count?>"><?=$row['task_states_title']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_statuses_date']?></td>
			<td rowspan="<?=$row_count?>"><?=$row['task_comment']?></td>	
			<td rowspan="<?=$row_count?>"><?=$messages?></td>
			<td rowspan="<?=$row_count?>"><?=$row['comment_quote']?></td>
			<?
				if (intval($data['with_accidents'])) {
					if (sizeOf($accidents)) {
						$i = 0;
						foreach ($accidents as $accident) {
							if ($i) {
								echo '</tr><tr>';
							}
							echo '<td>' . $accident['date'] . '</td>';
							echo '<td>' . $accident['risk'] . '</td>';
							echo '<td>' . $accident['amount_rough'] . '</td>';
							echo '<td>' . $accident['amount'] . '</td>';
							$i++;
						}
					} else {
					}
				}
			?>
		</tr>
		<?
				}
			}
		?>
	<?php } ?>
	
	<?php if ($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) { ?>
		<tr class="columns">
			<td colspan="8">Договір</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 7 : 5 ?>">Страхувальник</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 10 : 10 ?>">Період страхування</td>
			<td colspan="5">Продавець</td>
			<td colspan="2">Підписант</td>
			<td colspan="2">Комісія агента</td>
		</tr>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Банк</td>
			<td>Статус</td>
			<td>Додаткова угода</td>
			<td>Багаторічний</td>
			<td>Документи</td>
			<td>Комісія</td>

			<td>Особа</td>
			<td>Назва/ПІБ</td>
            <td>VIP</td>
			<td>Група</td>
			<td>ІПН/ЄДРПОУ</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Адреса</td>
			<td>Телефон</td>
			<?php } ?>

			<td>Сума, грн.</td>
			<td>Тариф, %</td>
			<td>Премія, грн.</td>

			<td>Сплата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Пролонгація</td>
			<td>Номер платежу (розбивка)</td>
			<td>Рік страхування</td>
			<td>Другий платіж "50/50"</td>

			<td>Головна агенція</td>
			<td>Агенція</td>
			<td>Область</td>
			<td>Канал</td>
			<td>Продавець</td>

			<td>Агенція</td>
			<td>Продавець</td>

			<td>%</td>
			<td>грн.</td>
		</tr>	
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['policies_number']?></td>
			<td><?=$row['policies_date']?></td>
			<td><?=$row['financial_institutions_title']?></td>
			<td><?=$row['policy_statuses_title']?></td>
			<td><?=$row['is_agr_title']?></td>
			<td><?=$row['long_term']?></td>
			<td><?=$row['policies_documents']?></td>
			<td><?=$row['policies_commission']?></td>

			<td><?=($row['insurer_person_types_id'] == 1) ? 'Фізична' : 'Юридична'?></td>
			<td><?=$row['insurer']?></td>
            <td><?=($row['important_person'] == 1) ? 'Так' : 'Ні'?></td>
			<td><?=$row['client_groups_title']?></td>
			<td><?=$row['insurer_identification']?></td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td><?=$row['insurer_phone']?></td>
			<?php } ?>

			<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td align="right"><?=getRateFormat($row['rate'])?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>

			<td><?=$row['payments_date']?></td>
			<td><?=$row['begin_datetime_format']?></td>
			<td><?=$row['interrupt_datetime_format']?></td>
			<td><?=$row['prolongation_number']?></td>
			<td><?=$row['number_part_payment']?></td>
			<td><?=$row['number_insurance_year']?></td>
			<td><?=$row['second_fifty_fifty_title']?></td>

			<td><?=$row['agencies_parent_title']?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['regions_title']?></td>
			<td><?=$row['agency_types_title']?></td>
			<td><?=$row['seller']?></td>

			<td><?=$row['seller_agencies_title']?></td>
			<td><?=$row['seller_agents_title']?></td>

			<td><?=$row['policies_commission_agent_percent']?></td>
			<td><?=$row['policy_payments_calendar_commission_agent_amount']?></td>
		</tr>
		<?
				}
			}
		?>
	<?php } ?>
	
	<?php if ($data['product_types_id'] == PRODUCT_TYPES_NS) { ?>
		<tr class="columns">
			<td colspan="8">Договір</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 7 : 5 ?>">Страхувальник</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 11 : 10 ?>">Період страхування</td>
			<td colspan="5">Продавець</td>
			<td colspan="2">Підписант</td>
			<td colspan="2">Комісія агента</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?><td colspan="3">Комісія банка</td><?php } ?>
		</tr>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Банк</td>
			<td>Статус</td>
			<td>Додаткова угода</td>
			<td>Багаторічний</td>
			<td>Документи</td>
			<td>Комісія</td>

			<td>Особа</td>
			<td>Назва/ПІБ</td>
            <td>VIP</td>
			<td>Група</td>
			<td>ІПН/ЄДРПОУ</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Адреса</td>
			<td>Телефон</td>
			<?php } ?>

			<td>Сума, грн.</td>
			<td>Тариф, %</td>
			<td>Премія, грн.</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Продукт</td>
			<?php } ?>
			<td>Сплата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Пролонгація</td>
			<td>Номер платежу (розбивка)</td>
			<td>Рік страхування</td>
			<td>Другий платіж "50/50"</td>

			<td>Головна агенція</td>
			<td>Агенція</td>
			<td>Область</td>
			<td>Канал</td>
			<td>Продавець</td>

			<td>Агенція</td>
			<td>Продавець</td>

			<td>%</td>
			<td>грн.</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>% від СС</td>
			<td>% від премії</td>
			<td>грн.</td>
			<? } ?>
		</tr>	
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['policies_number']?></td>
			<td><?=$row['policies_date']?></td>
			<td><?=$row['financial_institutions_title']?></td>
			<td><?=$row['policy_statuses_title']?></td>
			<td><?=$row['is_agr_title']?></td>
			<td><?=$row['long_term']?></td>
			<td><?=$row['policies_documents']?></td>
			<td><?=$row['policies_commission']?></td>

			<td><?=($row['insurer_person_types_id'] == 1) ? 'Фізична' : 'Юридична'?></td>
			<td><?=$row['insurer']?></td>
            <td><?=($row['important_person'] == 1) ? 'Так' : 'Ні'?></td>
			<td><?=$row['client_groups_title']?></td>
			<td><?=$row['insurer_identification']?></td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td><?=$row['insurer_phone']?></td>
			<?php } ?>

			<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td align="right"><?=getRateFormat($row['rate'])?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td><?=$row['products_title']?></td>
			<?php } ?>
			<td><?=$row['payments_date']?></td>
			<td><?=$row['begin_datetime_format']?></td>
			<td><?=$row['interrupt_datetime_format']?></td>
			<td><?=$row['prolongation_number']?></td>
			<td><?=$row['number_part_payment']?></td>
			<td><?=$row['number_insurance_year']?></td>
			<td><?=$row['second_fifty_fifty_title']?></td>

			<td><?=$row['agencies_parent_title']?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['regions_title']?></td>
			<td><?=$row['agency_types_title']?></td>
			<td><?=$row['seller']?></td>

			<td><?=$row['seller_agencies_title']?></td>
			<td><?=$row['seller_agents_title']?></td>

			<td><?=$row['policies_commission_agent_percent']?></td>
			<td><?=$row['policy_payments_calendar_commission_agent_amount']?></td>

			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td><?=$row['bank_discount_value']?></td>
			<td><?=$row['bank_commission_value']?></td>
			<td><?=round($row['amount'] * (1 - round(1/$row['bank_discount_value'], 3)) + $row['price'] * $row['bank_commission_value'] / 100, 2)?></td>
			<?php } ?>
		</tr>
		<?
				}
			}
		?>
	<?php } ?>
	
	<?php if ($data['product_types_id'] == PRODUCT_TYPES_MORTAGE) { ?>
		<tr class="columns">
			<td colspan="8">Договір</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 6 : 4 ?>">Страхувальник</td>
			<td colspan="<?php echo (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) ? 10 : 10 ?>">Період страхування</td>
			<td colspan="5">Продавець</td>
			<td colspan="2">Підписант</td>
			<td colspan="2">Комісія агента</td>
		</tr>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Банк</td>
			<td>Статус</td>
			<td>Додаткова угода</td>
			<td>Багаторічний</td>
			<td>Документи</td>
			<td>Комісія</td>

			<td>Особа</td>
			<td>Назва/ПІБ</td>
            <td>VIP</td>
			<td>Група</td>
			<td>ІПН/ЄДРПОУ</td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td>Адреса</td>
			<td>Телефон</td>
			<?php } ?>

			<td>Сума, грн.</td>
			<td>Тариф, %</td>
			<td>Премія, грн.</td>

			<td>Сплата</td>
			<td>Початок</td>
			<td>Закінчення</td>
			<td>Пролонгація</td>
			<td>Номер платежу (розбивка)</td>
			<td>Рік страхування</td>
			<td>Другий платіж "50/50"</td>

			<td>Головна агенція</td>
			<td>Агенція</td>
			<td>Область</td>
			<td>Канал</td>
			<td>Продавець</td>

			<td>Агенція</td>
			<td>Продавець</td>

			<td>%</td>
			<td>грн.</td>
		</tr>	
		<?
			if (sizeOf($list)) {
				$i = 0;
				foreach ($list as $row) {
					$i = 1 - $i;
		?>
		<tr class="<?=Form::getRowClass($row, $i)?>">
			<td><?=$row['policies_number']?></td>
			<td><?=$row['policies_date']?></td>
			<td><?=$row['financial_institutions_title']?></td>
			<td><?=$row['policy_statuses_title']?></td>
			<td><?=$row['is_agr_title']?></td>
			<td><?=$row['long_term']?></td>
			<td><?=$row['policies_documents']?></td>
			<td><?=$row['policies_commission']?></td>

			<td><?=($row['insurer_person_types_id'] == 1) ? 'Фізична' : 'Юридична'?></td>
			<td><?=$row['insurer']?></td>
            <td><?=($row['important_person'] == 1) ? 'Так' : 'Ні'?></td>
			<td><?=$row['client_groups_title']?></td>
			<td><?=$row['insurer_identification']?></td>
			<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
			<td><?=str_replace('flat', 'кв.', str_replace('house', 'буд.', str_replace('region', 'район', $row['address'])))?></td>
			<td><?=$row['insurer_phone']?></td>
			<?php } ?>

			<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
			<td align="right"><?=getRateFormat($row['rate'])?></td>
			<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>

			<td><?=$row['payments_date']?></td>
			<td><?=$row['begin_datetime_format']?></td>
			<td><?=$row['interrupt_datetime_format']?></td>
			<td><?=$row['prolongation_number']?></td>
			<td><?=$row['number_part_payment']?></td>
			<td><?=$row['number_insurance_year']?></td>
			<td><?=$row['second_fifty_fifty_title']?></td>

			<td><?=$row['agencies_parent_title']?></td>
			<td><?=$row['agencies_title']?></td>
			<td><?=$row['regions_title']?></td>
			<td><?=$row['agency_types_title']?></td>
			<td><?=$row['seller']?></td>

			<td><?=$row['seller_agencies_title']?></td>
			<td><?=$row['seller_agents_title']?></td>

			<td><?=$row['policies_commission_agent_percent']?></td>
			<td><?=$row['policy_payments_calendar_commission_agent_amount']?></td>
		</tr>
		<?
				}
			}
		?>
	<?php } ?>
	</table>
<? } 

	elseif ($data['types_id'] != 4) { ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
        <td rowspan="3"></td>
        <td colspan="6">Банк</td>
        <td colspan="14">Рітейл</td>
		<td colspan="6">Сервіс</td>
    </tr>
    <tr class="columns">
        <td colspan="2">Новий</td>
        <td colspan="2">Пролонгація</td>
        <td colspan="2">Додаткова угода<br/>Другий платіж "50/50"</td>
        <td colspan="2">Новий Сторонній</td>
		<td colspan="2">Новий Axapta</td>
        <td colspan="2">Пролонгація</td>
		<td colspan="2">в т.ч. пролонгація ВП</td>
        <td colspan="2">Наступні платежі</td>
        <td colspan="2">Додаткова угода<br/>Другий платіж "50/50"</td>
		<td colspan="2"><?if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) echo 'Тест драйв'; else echo 'Короткострокові(до 6 міс)';?></td>
		<td colspan="2">Новий</td>
        <td colspan="2">Пролонгація</td>
        <td colspan="2">Додаткова угода<br/>Другий платіж "50/50"</td>
    </tr>
    <tr class="columns">
        <td>шт.</td>
        <td>грн.</td>
		 <td>шт.</td>
        <td>грн.</td>
        <td>шт.</td>
        <td>грн.</td>
        <td>шт.</td>
        <td>грн.</td>
        <td>шт.</td>
        <td>грн.</td>
        <td>шт.</td>
        <td>грн.</td>
		 <td>шт.</td>
		    <td>грн.</td>
		 <td>шт.</td>
        <td>грн.</td>
        <td>шт.</td>
        <td>грн.</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>шт.</td>
        <td>грн.</td>
		<td>шт.</td>
        <td>грн.</td>
		<td>шт.</td>
        <td>грн.</td>
    </tr>
    <?
        if (sizeOf($values)) {
            foreach ($values as $row) {
    ?>
    <tr>
        <td><?=$row['title']?></td>
        <td><?=intval($row['data']['bank']['new']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['bank']['new']['amount'], -1)?></td>
        <td><?=intval($row['data']['bank']['prolong']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['bank']['prolong']['amount'], -1)?></td>
        <td><?=intval($row['data']['bank']['agr']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['bank']['agr']['amount'], -1)?></td>
        
		
		
		<td><?=intval($row['data']['retail']['new']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['new']['amount'], -1)?></td>
		
		<td><?=intval($row['data']['retail']['new_axapta']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['new_axapta']['amount'], -1)?></td>
		
        <td><?=intval($row['data']['retail']['prolong']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['prolong']['amount'], -1)?></td>        

		<td><?=intval($row['data']['retail']['prolong2']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['prolong2']['amount'], -1)?></td>        
		
		<td><?=intval($row['data']['retail']['prolong1']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['prolong1']['amount'], -1)?></td>        
		
		
        <td><?=intval($row['data']['retail']['agr']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['agr']['amount'], -1)?></td>
		
		<td><?=intval($row['data']['retail']['testdrive']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['testdrive']['amount'], -1)?></td>
		
		<td><?=intval($row['data']['retail']['service']['new']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['service']['new']['amount'], -1)?></td>
		<td><?=intval($row['data']['retail']['service']['prolong']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['service']['prolong']['amount'], -1)?></td>
		<td><?=intval($row['data']['retail']['service']['agr']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['service']['agr']['amount'], -1)?></td>
    </tr>
    <?
            }
        }
    ?>
	</table>
<? } else { ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="2">
    <tr class="columns">
        <td rowspan="3"></td>
        <td colspan="9">Банк</td>
        <td colspan="15">Рітейл</td>
    </tr>
    <tr class="columns">
        <td colspan="3">Новий</td>
        <td colspan="3">Пролонгація</td>
        <td colspan="3">Додаткова угода<br/>Другий платіж "50/50"</td>
        <td colspan="3">Новий</td>
        <td colspan="3">Пролонгація</td>
		<td colspan="3">Наступні платежі</td>
		<td colspan="3">Сервіс</td>
        <td colspan="3">Додаткова угода<br/>Другий платіж "50/50"</td>
    </tr>
    <tr class="columns">
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
		<td>Бренд</td>
        <td>шт.</td>
        <td>грн.</td>
    </tr>
    <?
        if (sizeOf($values)) {
            foreach ($values as $row) {
    ?>
    <tr>
        <td><?=$row['title']?></td>
		
		<?
			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['bank']['new']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['bank']['new']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['bank']['new']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['bank']['new']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['bank']['new']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['bank']['new']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';

			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['bank']['prolong']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['bank']['prolong']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['bank']['prolong']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['bank']['prolong']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['bank']['prolong']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['bank']['prolong']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';
			
			

			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['bank']['agr']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['bank']['agr']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['bank']['agr']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['bank']['agr']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['bank']['agr']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['bank']['agr']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';

			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['retail']['new']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['retail']['new']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['retail']['new']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['retail']['new']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['retail']['new']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['retail']['new']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';

			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['retail']['prolong']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['retail']['prolong']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['retail']['prolong']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['retail']['prolong']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['retail']['prolong']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['retail']['prolong']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';
			
			
			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['retail']['prolong1']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['retail']['prolong1']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['retail']['prolong1']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['retail']['prolong1']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['retail']['prolong1']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['retail']['prolong1']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';
			
			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['retail']['service']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['retail']['service']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['retail']['service']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['retail']['service']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['retail']['service']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['retail']['service']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';

			echo '<td colspan="3"><table border="1">';
            echo '<tr>';
            echo '<td>Всього</td>';
            echo '<td>' . intval(array_sum($row['data']['retail']['agr']['count'])) . '</td>';
            echo '<td>' . getMoneyFormat(array_sum($row['data']['retail']['agr']['amount']), -1) . '</td>';
            echo '</tr>';
			foreach ($ukravto_brands_idx as $ukravto_brands_id) {
				echo '<tr>';
				echo '<td>' . CarBrands::getTitle($ukravto_brands_id) . '</td>';
				echo '<td>' . intval($row['data']['retail']['agr']['count'][$ukravto_brands_id]) . '</td>';
				echo '<td>' . getMoneyFormat($row['data']['retail']['agr']['amount'][$ukravto_brands_id], -1) . '</td>';
				echo '</tr>';
			}
			echo '<tr>';
			echo '<td>Інші</td>';
			echo '<td>' . intval($row['data']['retail']['agr']['count'][0]) . '</td>';
			echo '<td>' . getMoneyFormat($row['data']['retail']['agr']['amount'][0], -1) . '</td>';
			echo '</tr>';
			echo '</table></td>';
		
        /*<td><?=intval($row['data']['bank']['prolong']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['bank']['prolong']['amount'], -1)?></td>
		
        <td><?=intval($row['data']['bank']['agr']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['bank']['agr']['amount'], -1)?></td>
		
        <td><?=intval($row['data']['retail']['new']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['new']['amount'], -1)?></td>
		
        <td><?=intval($row['data']['retail']['prolong']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['prolong']['amount'], -1)?></td>
		
        <td><?=intval($row['data']['retail']['agr']['count'])?></td>
        <td><?=getMoneyFormat($row['data']['retail']['agr']['amount'], -1)?></td>*/
		
		?>
    </tr>
    <?
            }
        }
    ?>
	</table>
<? } ?>
</body>
</html>