<table cellpadding="5" cellspacing="0" border="<?=($data['step'] == 4 && !isset($data['act_type'])) ? 1 : 0?>" width="530">
    <? if ($data['step'] == 4 && !isset($data['act_type'])) { ?>
    <tr align="center" class='columns'>
        <td rowspan="2" colspan="2">Номер</td>
        <td colspan="2">Термін дії</td>
        <td colspan="2">Період страхування</td>
        <td rowspan="2">Сума</td>
        <td rowspan="2">Сплачено</td>
        <td rowspan="2">Статус</td>
    </tr>
    <tr align="center" class='columns'>
        <td>Початок</td>
        <td>Кінець</td>
        <td>Початок</td>
        <td>Кінець</td>
    </tr>
    <? } 
        $period = 0;
        $cur_policies_id = 0;
        $policies_id = array();
        $accidents_period = -1;
        $flag = false;
        $accidents_date = $data['accidents_date_values']['day'] . '.' . $data['accidents_date_values']['month'] . '.' . $data['accidents_date_values']['year'];
        for (;$period < sizeof($data['policy_payments_calendar']['payments_calendar']); $period++) {
			$row = $data['policy_payments_calendar']['payments_calendar'][$period];
		
            $cur_policies_id = $row['id'];
            $bold = 0;
            $colour = '';
			
			switch($row['statuses_id']) {
				case 1:
					$statuses = 'не сплачено';
					$colour = 'red';
					break;
				case 2:
					$statuses = 'частково сплачено';
					$colour = 'yellow';
					break;
				case 3:
					$statuses = 'сплачено';
					$colour = 'green';
					break;
				case 4:
					$statuses = 'переплата';
					$colour = 'green';
					break;
				default:
					$statuses = 'не визначено';
					$color = '';
					break;
			}
			
			if(strtotime($accidents_date) >= strtotime($row['date']) && strtotime($accidents_date) <= strtotime($row['end'])) {
				$bold = 1;
				$accidents_period = $period;
				$statuses_a = $statuses;
			} else {
				$bold = 0;
			}
			
			if ($data['step'] == 4 && !isset($data['act_type'])) {
				echo '<tr align="center" bgcolor="' . $colour . '">';
				if(!in_array($cur_policies_id, $policies_id)) {
					echo '<td><input type="radio" id="radio_policies_id' . $row['id'] . '" name="policies_id_risk_list" value="' . $row['id'] . '" onclick="setPoliciesParams(' . $row['id'] . ')" ' . ' ' . ($bold == 0 ? 'disabled' : '') . ' ' . $this->getReadonly(true) . '></td>';
				} else {
					echo '<td> </td>';
				}
				if($data['important_person'] == 0){
					echo '<td><a href="/?do=Policies|view&id=' . $row['id'] . '&product_types_id=' . $data['product_types_id'] . '" target="_blank">' . ($bold ? '<b>' : '') . $row['policies_full_number'] . ($bold ? '</b>' : '') . '</a></td>';
				}
				else{
					echo '<td><a href="/?do=Policies|view&id=' . $row['id'] . '&product_types_id=' . $data['product_types_id'] . '" target="_blank">' . ($bold ? '<b>' : '') . $row['policies_full_number'] . ' <b style="color: red;">VIP</b>' .  ($bold ? '</b>' : '') . '</a></td>';
				}
				echo '<td>' . ($bold ? '<b>' : '') . date('d.m.Y', strtotime($row['begin_datetime'])) . ($bold ? '</b>' : '') . '</td>';
				echo '<td>' . ($bold ? '<b>' : '') . date('d.m.Y', strtotime($row['end_datetime'])) . ($bold ? '</b>' : '') . '</td>';
				echo '<td>' . ($bold ? '<b>' : '') . date('d.m.Y', strtotime($row['date'])) . ($bold ? '</b>' : '') . '</td>';
				echo '<td>' . ($bold ? '<b>' : '') . date('d.m.Y', strtotime($row['end'])) . ($bold ? '</b>' : '') . '</td>';
				echo '<td>' . ($bold ? '<b>' : '') . getRateFormat($row['amount'], 2) . ($bold ? '</b>' : '') . '</td>';
				echo '<td>' . ($bold ? '<b>' : '') . getRateFormat(floatval($row['payed_amount']), 2) . ($bold ? '</b>' : '') . '</td>';
				echo '<td>' . ($bold ? '<b>' : '') . $statuses . ($bold ? '</b>' : '') . '</td>';
				echo '</tr>';
			}

            if(!in_array($cur_policies_id, $policies_id)) {
                $policies_id[] = $cur_policies_id;
            }

            if ($bold && $data['step'] == 4) {
                echo '<script>var policies_id = ' . intval($policies_id[sizeof($policies_id) - 2]) . ';</script>';
            }
        }

        if ($data['step'] !=  4 || isset($data['act_type'])) {
            if ($accidents_period >= 0) {
                echo '<tr>';
                echo '<td nowrap><b>Термін дії:</b> ' . date('d.m.Y', strtotime($data['policy_payments_calendar']['payments_calendar'][$accidents_period]['begin_datetime'])) . ' - ' . date('d.m.Y', strtotime($data['policy_payments_calendar']['payments_calendar'][$accidents_period]['end_datetime'])) . '</td>';
                echo '<td nowrap><b>Період страхування:</b> ' . date('d.m.Y', strtotime($data['policy_payments_calendar']['payments_calendar'][$accidents_period]['date'])) . ' - ' . date('d.m.Y', strtotime($data['policy_payments_calendar']['payments_calendar'][$accidents_period]['end'])) . '</td>';
                echo '<td nowrap><b>Премія:</b> ' . $data['policy_payments_calendar']['payments_calendar'][$accidents_period]['amount'] . ' грн.</td>';
                echo '<td nowrap><b>Сплачено:</b> ' . $data['policy_payments_calendar']['payments_calendar'][$accidents_period]['payed_amount'] . ' грн.</td>';
                echo '<td nowrap><b>Статус:</b> ' . $statuses_a . '</td>';
                echo '</tr>';
            } else {
                echo '<tr>';
                echo '<td nowrap><b>Термін дії:</b> ' . date('d.m.Y', strtotime($data['policy_payments_calendar']['payments_calendar'][0]['begin_datetime'])) . ' - ' . date('d.m.Y', strtotime($data['policy_payments_calendar']['payments_calendar'][0]['end_datetime'])) . '</td>';
                echo '<td nowrap><b>Період страхування:</b> -</td>';
                echo '<td nowrap><b>Премія:</b> -</td>';
                echo '<td nowrap><b>Сплачено:</b> -</td>';
                echo '<td nowrap><b>Статус:</b> -</td>';
                echo '</tr>';
            }
        }

    ?>
</table>