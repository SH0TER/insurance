<?

require_once '../include/collector.inc.php';
file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

//$count = 0;
//$date = 'now()';

$day = 1;
$month = 1;
$year = 2016;

$sql = 'select id from insurance_clients where client_groups_id = 1';
$ukrauto_clients_id = $db->getCol($sql);

$sql = 'select edrpou from insurance_agencies where ukravto = 1 and length(edrpou)';
$ukrauto_edrpou = $db->getCol($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table border=1>
		<tr class="columns">
			<td>Номер</td>
			<td>Дата</td>
			<td>Тип</td>
			<td>!!!!</td>
			<td>просрочен</td>
			 
		</tr>';

while (mktime(0, 0, 0, 1, 1, 2017) > mktime(0, 0, 0, $month, $day, $year)) {

    $count_bank_new = 0;
    $count_bank_prolong = 0;
    $count_retail_new = 0;
    $count_retail_prolong = 0;
    $count_ukrauto = 0;
    $count = 0;
  $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation, a.number_part_payment, c.financial_institutions_id, b.clients_id, c.insurer_edrpou
                from insurance_policy_payments_calendar a
                join insurance_policies b on a.policies_id = b.id
                join insurance_policies_kasko c on b.id = c.policies_id
                where ' . $db->quote(date('Y-m-d', mktime(0, 0, 0, $month, $day, $year))) . ' between a.date and a.end_date and a.valid = 1 and b.product_types_id = 3 and a.amount>0 and b.item <> \'Автопарк\' and datediff(a.end_date, a.date) <= 366';
    $list_first = $db->getAll($sql);

    foreach ($list_first as $row_first) {
        if ($row_first['is_agr'] == 1) {
            //запис календаря, що визначає початок страхового періоду
            $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation
                        from insurance_policy_payments_calendar a
                        join insurance_policies b on a.policies_id = b.id
                        where b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.is_agr = 0 and a.valid = 1
                        order by date asc
                        limit 1';
            $valid = $db->getRow($sql);

            //запис календаря - точно діючий
            $sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation, c.financial_institutions_id, b.clients_id, c.insurer_edrpou
                        from insurance_policy_payments_calendar a
                        join insurance_policies b on a.policies_id = b.id
                        join insurance_policies_kasko c on b.id = c.policies_id
                        where b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.statuses_id > 2 and a.valid = 1
                        order by date asc
                        limit 1';
            $last_payment = $db->getRow($sql);

            if (!intval($last_payment['id'])) continue;

            /*$sql = 'select if(c.id > 0, c.amount_kasko, b.amount_kasko) as premium
                    from insurance_policies a
                    join insurance_policies_kasko_items b on a.id = b.policies_id
                    left join insurance_policies_kasko_item_years_payments c on b.id = c.items_id and now() between c.date and subdate(adddate(c.date, interval 1 year), interval 1 day)
                    where a.id = ' . $last_payment['policies_id'];
            $premium = $db->getOne($sql);*/

            if (in_array($last_payment['clients_id'], $ukrauto_clients_id) || in_array($last_payment['insurer_edrpou'], $ukrauto_edrpou)) $count_ukrauto++;
            elseif (intval($last_payment['financial_institutions_id']) && intval($last_payment['number_prolongation'])) $count_bank_prolong++;
            elseif (intval($last_payment['financial_institutions_id'])) $count_bank_new++;
            elseif (intval($last_payment['number_prolongation'])) $count_retail_prolong++;
            else $count_retail_new++;
			
			echo '<tr>';
			echo '<td>'.$row_first['number'].(intval($row_first['sub_number'])>0 ? '-'.$row_first['sub_number'] : '').'</td>';
			echo '<td align="left">' . ($day. '.'.$month.'.'. $year). '</td>';
 
			if (in_array($last_payment['clients_id'], $ukrauto_clients_id) || in_array($last_payment['insurer_edrpou'], $ukrauto_edrpou)) echo '<td>укравто</td>';
            elseif (intval($last_payment['financial_institutions_id']) && intval($last_payment['number_prolongation'])) echo '<td>банк пролонг</td>';
            elseif (intval($last_payment['financial_institutions_id'])) echo '<td>банк новый</td>';
            elseif (intval($last_payment['number_prolongation'])) echo '<td>ретайл пролонг</td>';
            else echo '<td>ретайл новый</td>';
			echo '<td>'.$last_payment['financial_institutions_id'].'</td>';
			echo '<td>0</td>';
			echo '</tr>';
			

            $count++;

        } elseif ($row_first['statuses_id'] > 2) {

            /*$sql = 'select if(c.id > 0, c.amount_kasko, b.amount_kasko) as premium
                    from insurance_policies a
                    join insurance_policies_kasko_items b on a.id = b.policies_id
                    left join insurance_policies_kasko_item_years_payments c on b.id = c.items_id and now() between c.date and subdate(adddate(c.date, interval 1 year), interval 1 day)
                    where a.id = ' . $row_first['policies_id'];
            $premium = $db->getOne($sql);*/

            echo '<tr>';
			echo '<td>'.$row_first['number'].(intval($row_first['sub_number'])>0 ? '-'.$row_first['sub_number'] : '').'</td>';
			echo '<td align="left">' . ($day. '.'.$month.'.'. $year). '</td>';
 
			if (in_array($row_first['clients_id'], $ukrauto_clients_id) || in_array($row_first['insurer_edrpou'], $ukrauto_edrpou)) echo '<td>укравто</td>';
            elseif (intval($row_first['financial_institutions_id']) && intval($row_first['number_prolongation'])) echo '<td>банк пролонг</td>';
            elseif (intval($row_first['financial_institutions_id'])) echo '<td>банк новый</td>';
            elseif (intval($row_first['number_prolongation'])) echo '<td>ретайл пролонг</td>';
            else echo '<td>ретайл новый</td>';
			echo '<td>'.$row_first['financial_institutions_id'].'</td>';
			echo '<td>0</td>';
			echo '</tr>';


            $count++;
        } elseif ($row_first['number_part_payment'] > 1) { //планово зайдет второй платеж
			continue;
						$sql = 'select a.id, a.policies_id, a.date, a.end_date, a.statuses_id, a.is_agr, b.number, a.number_insurance_year, a.number_prolongation, c.financial_institutions_id, b.clients_id, c.insurer_edrpou
					from insurance_policy_payments_calendar a
					join insurance_policies b on a.policies_id = b.id
					join insurance_policies_kasko c on b.id = c.policies_id
					where a.is_agr = 0 and b.number = ' . $db->quote($row_first['number']) . ' and a.number_insurance_year = ' . intval($row_first['number_insurance_year']) . ' and a.statuses_id > 2 and a.valid = 1 and a.number_part_payment < ' . $row_first['number_part_payment'] . '
					order by date asc
					limit 1';
            $last_payment = $db->getRow($sql);//смотрим чтобы был оплачен первый платеж

			
			if (!intval($last_payment['id'])) continue;

            			echo '<tr>';
			echo '<td>'.$row_first['number'].(intval($row_first['sub_number'])>0 ? '-'.$row_first['sub_number'] : '').'</td>';
			echo '<td align="left">' . ($day. '.'.$month.'.'. $year). '</td>';
 
			if (in_array($last_payment['clients_id'], $ukrauto_clients_id) || in_array($last_payment['insurer_edrpou'], $ukrauto_edrpou)) echo '<td>укравто</td>';
            elseif (intval($last_payment['financial_institutions_id']) && intval($last_payment['number_prolongation'])) echo '<td>банк пролонг</td>';
            elseif (intval($last_payment['financial_institutions_id'])) echo '<td>банк новый</td>';
            elseif (intval($last_payment['number_prolongation'])) echo '<td>ретайл пролонг</td>';
            else echo '<td>ретайл новый</td>';
			echo '<td>'.$last_payment['financial_institutions_id'].'</td>';
			echo '<td>1</td>';
			echo '</tr>';

			
			$count++;
		} else {
            continue;
        }
    }

    /*echo '<tr>';
    echo '<td align="left">' . date('Y-m-d', mktime(0, 0, 0, $month, $day, $year)) . '</td>';
    echo '<td align="left">' . $count_bank_new . '</td>';
    echo '<td align="left">' . $count_bank_prolong . '</td>';
    echo '<td align="left">' . $count_retail_new . '</td>';
    echo '<td align="left">' . $count_retail_prolong . '</td>';
    echo '<td align="left">' . $count_ukrauto . '</td>';
    echo '<td align="left">' . $count . '</td>';
	echo '</tr>';*/

    $month++;

}

echo '</table>';


?>