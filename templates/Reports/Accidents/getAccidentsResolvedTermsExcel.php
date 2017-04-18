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
	/*height: 25px;*/
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background-color: #008575;
	text-align: center;
	vertical-align: middle;
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
    <table width="600" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <!--td>№ п/п</td>
			<td>Номер справи</td>
			<td>Відповідальний <br/>(аварком)</td>
			<td>Відповідальний <br/>(експерт)</td>
			<td>Кількість днів з моменту внесення заяви в базу до моменту класифікації</td>
			<td>Кількість днів справа знаходиться в класифікації на момент формування звіту (<?=date('d.m.Y')?>)</td>													
			<td>Кількість днів з моменту класифікації до статусу "розгляд"</td>			
			<td>Відповідальний за класифікацію</td>
			<td>Експертна робота</td>
			<td>Кількість днів на розгляді від статусу «класифікація» до статусу «передано в СК»</td>
			<td>Кількість днів справа знаходиться у розгляді на момент формування звіту (<?=date('d.m.Y')?>)</td>
			<td>Кількість днів на розгляді з моменту класифікації (статус "розгляд") до переведення справи у статус "затвердження"</td>
			<td>Кількість днів справа знаходиться в затвердженні на момент формування звіту (<?=date('d.m.Y')?>)</td>
			<td>Кількість днів з моменту розгляду (статус "затвердження") до переведення справи у статус "передача в СК"</td>
			<td>Кількість днів від переведення справи в статус "передача в СК" до статусу "оплата" чи "врегульовано"</td>
			<td>Кількість днів від переведення справи в статус "прийом заяви" до статусу "оплата" чи "врегульовано"</td>
			<td>Кількість днів з моменту внесення заяви в базу до статусу "врегулювання"</td>
			<td>Статус справи</td>
			<td>Категорія справи</td-->
			<td>№ п/п</td>
			<?
				foreach ($fields as $field) {
					echo '<td>' . $field['title'] . '</td>';
				}
			?>
        </tr>
        <?
			$total = sizeof($list);
			$count_to_classification = 0;
			$count_classification = 0;
			$count_investigation = 0;
			$count_experts = 0;
			$count_approval = 0;
			$count_approval_express = 0;
			$count_approval_standart = 0;
			$count_between_create_transfer_plus = 0;
			$count_between_create_transfer_plus_express = 0;
			$count_between_create_transfer_plus_standart = 0;
			$count_payments = 0;
			$number = 0;			
			$divisor = 24 * 60 * 60;
			
			$total_duration_to_classification = 0;
			$total_duration_classification_current = 0;
			$total_duration_classification = 0;
			$total_duration_expert_messages = 0;
			$total_duration_classification_to_transfer = 0;
			$total_duration_investigation_current = 0;
			$total_duration_investigation = 0;
			$total_duration_approval_current = 0;
			$total_duration_approval = 0;
			$total_duration_approval_express = 0;
			$total_duration_approval_standart = 0;
			$total_duration_transfer = 0;
			$total_duration_between_create_transfer_plus = 0;
			$total_duration_between_create_transfer_plus_express = 0;
			$total_duration_between_create_transfer_plus_standart = 0;
			$total_duration_payments = 0;
			$total_duration_resolved = 0;
            foreach ($list as $row) {
				$number++;
				
				$duration_to_classification = roundNumber($row['duration_to_classification'] / $divisor, 2);
				$duration_classification_current = roundNumber($row['duration_classification_current'] / $divisor, 2);
				$duration_classification = roundNumber($row['duration_classification'] / $divisor, 2);
				$duration_expert_messages = roundNumber(AccidentMessages::getMessagesDuration(array('list' => $row['messages_list'])) / $divisor, 2);
				$duration_classification_to_transfer = roundNumber($row['duration_classification_to_transfer'] / $divisor, 2);
				$duration_investigation_current = roundNumber($row['duration_investigation_current'] / $divisor, 2);
				$duration_investigation = roundNumber($row['duration_investigation'] / $divisor, 2);
				$duration_approval_current = roundNumber($row['duration_approval_current'] / $divisor, 2);
				$duration_approval = roundNumber($row['duration_approval'] / $divisor, 2);
				$duration_transfer = roundNumber($row['duration_transfer'] / $divisor, 2);
				$duration_between_create_transfer_plus = roundNumber($row['duration_between_create_transfer_plus'] / $divisor, 2);
				$duration_resolved = roundNumber($row['duration_resolved'] / $divisor, 2);
				$duration_payments = roundNumber($row['duration_payments'] / $divisor, 2);
				
				if ($row['duration_to_classification'] > 0) {
					$count_to_classification++;
				}
				if ($row['duration_classification'] > 0) {
					$count_classification++;
				}
				if ($row['duration_investigation'] > 0) {
					$count_investigation++;
				}
				if (AccidentMessages::getMessagesDuration(array('list' => $row['messages_list'])) > 0) {
					$count_experts++;
				}
				if ($row['duration_approval'] > 0) {
					$count_approval++;
				}
				if ($row['duration_approval'] > 0 && $row['accident_sections_id'] == 1) {
					$count_approval_express++;
					$total_duration_approval_express += $duration_approval;
				}
				if ($row['duration_approval'] > 0 && $row['accident_sections_id'] == 2) {
					$count_approval_standart++;
					$total_duration_approval_standart += $duration_approval;
				}
				if ($row['duration_between_create_transfer_plus'] > 0) {
					$count_between_create_transfer_plus++;
				}
				if ($row['duration_between_create_transfer_plus'] > 0 && $row['accident_sections_id'] == 1) {
					$count_between_create_transfer_plus_express++;
					$total_duration_between_create_transfer_plus_express += $duration_between_create_transfer_plus;
				}
				if ($row['duration_between_create_transfer_plus'] > 0 && $row['accident_sections_id'] == 2) {
					$count_between_create_transfer_plus_standart++;
					$total_duration_between_create_transfer_plus_standart += $duration_between_create_transfer_plus;
				}
				if ($row['duration_payments'] > 0) {
					$count_payments++;
					$total_duration_payments += $duration_payemts;
				}
				
				$total_duration_to_classification += $duration_to_classification;
				$total_duration_classification_current += $duration_classification_current;
				$total_duration_classification += $duration_classification;
				$total_duration_expert_messages += $duration_expert_messages;
				$total_duration_classification_to_transfer += $duration_classification_to_transfer;
				$total_duration_investigation_current += $duration_investigation_current;
				$total_duration_investigation += $duration_investigation;
				$total_duration_approval_current += $duration_approval_current;
				$total_duration_approval += $duration_approval;
				$total_duration_transfer += $duration_transfer;
				$total_duration_between_create_transfer_plus += $duration_between_create_transfer_plus;
				$total_duration_resolved += $duration_resolved;
        ?>
        <tr>
            <td><?=$number?></td>
			<?
				foreach ($fields as $field => $attr) {
					echo '<td style=' . $attr['style'] . '>';
					if ($attr['row']) {
						echo $row[$field];
					} else {
						echo $$field;
					}
					echo '</td>';
				}
			?>
			<!--td><?=$row['accidents_number']?></td>
			<td><?=$row['average_managers_name']?></td>
			<td><?=$row['estimate_managers_name']?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_to_classification?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_classification_current?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_classification?></td>			
			<td><?=$row['classification_responsible']?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_expert_messages?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_classification_to_transfer?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_investigation_current?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_investigation?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_approval_current?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_approval?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_transfer?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_between_create_transfer_plus?></td>
			<td style='mso-number-format:"0\.00"'><?=$duration_resolved?></td>
			<td><?=$row['accident_statuses_title']?></td>
			<td><?=$row['accident_sections_title']?></td-->
        </tr>
        <?
            }
        ?>
		<tr class="navigation">
			<td class="paging">Всьго: <?=(sizeof($list))?></td>
			<?
				foreach ($data['fields'] as $field) {
					echo '<td style=' . $fields[$field]['style'] . '>';
					if ($fields[$field]['row']) {
						echo '&nbsp;';
					} else {
						$total_field = 'total_' . $field;
						echo $$total_field;
					}
					echo '</td>';
				}
			?>
			<!--td><?=str_replace('.', ',', $total_duration_to_classification)?></td>
			<td><?=str_replace('.', ',', $total_duration_classification_current)?></td>
			<td><?=str_replace('.', ',', $total_duration_classification)?></td>
			<td>&nbsp;</td>
			<td><?=str_replace('.', ',', $total_duration_expert_messages)?></td>
			<td><?=str_replace('.', ',', $total_duration_classification_to_transfer)?></td>
			<td><?=str_replace('.', ',', $total_duration_investigation_current)?></td>
			<td><?=str_replace('.', ',', $total_duration_investigation)?></td>
			<td><?=str_replace('.', ',', $total_duration_approval_current)?></td>
			<td><?=str_replace('.', ',', $total_duration_approval)?></td>
			<td><?=str_replace('.', ',', $total_duration_transfer)?></td>
			<td><?=str_replace('.', ',', $total_duration_between_create_transfer_plus)?></td>
			<td><?=str_replace('.', ',', $total_duration_resolved)?></td>
			<td colspan="2">&nbsp;</td-->
		</tr>
		<tr><td colspan="19">&nbsp;</td></tr>
		<tr><td colspan="19">&nbsp;</td></tr>
		<tr>
			<td colspan="19">
				<!--Середня кількість днів з моменту внесення заяви в базу до моменту класифікації - -->
				<b>Прийом заяви</b> - <?=$count_to_classification?> справ, середня кількість днів -
					<?=roundNumber($total_duration_to_classification / $count_to_classification, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_to_classification / $count_to_classification, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_to_classification / $count_to_classification, 2) - intval(roundNumber($total_duration_to_classification / $count_to_classification, 2))) * 24, 0)?> год.)
			</td>
		</tr>
		<tr>
			<td colspan="19">
				<!--Середня кількість днів з моменту класифікації до статусу "розгляд" - -->
				<b>Класифікація</b> - <?=$count_classification?> справ, середня кількість днів -
					<?=roundNumber($total_duration_classification / $count_classification, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_classification / $count_classification, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_classification / $count_classification, 2) - intval(roundNumber($total_duration_classification / $count_classification, 2))) * 24, 0)?> год.)
			</td>								
		</tr>
		<!--tr>
			<td colspan="19">
				Середня кількість днів щодо <?=$total?> справ, які на дату складання звіту (<?=date('d.m.Y')?>) знаходяться, або знаходились у статусі "розгляд" - 
					<?=roundNumber($total_duration_investigation_current / $total, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_investigation_current / $total, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_investigation_current / $total, 2) - intval(roundNumber($total_duration_investigation_current / $total, 2))) * 24, 0)?> год.)
			</td>								
		</tr-->
		<tr>
			<td colspan="19">
				<!--Середня кількість днів на розгляді з моменту класифікації (статус "розгляд") до переведення справи у статус "затвердження" - -->
				<b>Розгляд</b> - <?=$count_investigation?> справ, середня кількість днів -
					<?=roundNumber($total_duration_investigation / $count_investigation, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_investigation / $count_investigation, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_investigation / $count_investigation, 2) - intval(roundNumber($total_duration_investigation / $count_investigation, 2))) * 24, 0)?> год.)
			</td>								
		</tr>
		<tr>
			<td colspan="19">
				<!--Середня кількість днів справа знаходиться в затвердженні на момент формування звіту (<?=date('d.m.Y')?>) - -->
				<b>Опрацювання експертами</b> - <?=$count_experts?> справ, середня кількість днів -
					<?=roundNumber($total_duration_expert_messages / $count_experts, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_expert_messages / $count_experts, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_expert_messages / $count_experts, 2) - intval(roundNumber($total_duration_expert_messages / $count_experts, 2))) * 24, 0)?> год.)
			</td>								
		</tr>
		<tr>
			<td colspan="19">
				<!--Середня кількість днів з моменту розгляду (статус "затвердження") до переведення справи у статус "передача СК" - всього справ - <?=$count_transfer?> --->
				<b>Затвердження</b> - <?=$count_approval?> справ, середня кількість днів -
					<?=roundNumber($total_duration_approval / $count_approval, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_approval / $count_approval, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_approval / $count_approval, 2) - intval(roundNumber($total_duration_approval / $count_approval, 2))) * 24, 0)?> год.)
			</td>								
		</tr>
		<tr>
			<td colspan="19">
				<!--Середня кількість днів з моменту розгляду (статус "затвердження") до переведення справи у статус "передача СК" - всього справ - <?=$count_transfer?> --->
				з них <b>експрес справи</b> - <?=$count_approval_express?> справ, середня кількість днів -
					<?=roundNumber($total_duration_approval_express / $count_approval_express, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_approval_express / $count_approval_express, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_approval_express / $count_approval_express, 2) - intval(roundNumber($total_duration_approval_express / $count_approval_express, 2))) * 24, 0)?> год.);
				з них <b>стандарт справи</b> - <?=$count_approval_standart?> справ, середня кількість днів -
					<?=roundNumber($total_duration_approval_standart / $count_approval_standart, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_approval_standart / $count_approval_standart, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_approval_standart / $count_approval_standart, 2) - intval(roundNumber($total_duration_approval_standart / $count_approval_standart, 2))) * 24, 0)?> год.);
			</td>								
		</tr>
		<tr>
			<td colspan="19">
				<!--Середня кількість днів від переведення справи в статус "прийом заяви" до статусу "оплата" чи "врегульовано" - -->
				<b>Строк врегулювання</b> - <?=$count_between_create_transfer_plus?> справ, середня кількість днів -
					<?=roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2) - intval(roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2))) * 24, 0)?> год.)
			</td>								
		</tr>
		<tr>
			<td colspan="19">
				з них <b>експрес справи</b> - <?=$count_between_create_transfer_plus_express?> справ, середня кількість днів -
					<?=roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2) - intval(roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2))) * 24, 0)?> год.);
				з них <b>стандарт справи</b> - <?=$count_between_create_transfer_plus_standart?> справ, середня кількість днів -
					<?=roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2) - intval(roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2))) * 24, 0)?> год.);
			</td>								
		</tr>
		<tr>
			<td colspan="19">
				<b>Строк оплати</b> - <?=$count_payments?> справ, середня кількість днів -
					<?=roundNumber($total_duration_payments / $count_payments, 2)?> дн. 
					(<?=intval(roundNumber($total_duration_payments / $count_payments, 2))?> дн. 
					<?=roundNumber((roundNumber($total_duration_payments / $count_payments, 2) - intval(roundNumber($total_duration_payments / $count_payments, 2))) * 24, 0)?> год.)
			</td>								
		</tr>
    </table>
</body>
</html>