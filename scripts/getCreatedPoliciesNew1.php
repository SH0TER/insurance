<?

require_once '../include/collector.inc.php';
//file_get_contents('http://e-insurance.in.ua/scripts/new_set.php');

//$count = 0;
//$date = 'now()';

$day = 1;
$month = 1;
$year = 2015;

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
		</tr>';



    $count_bank_new = 0;
    $count_bank_prolong = 0;
    $count_retail_new = 0;
    $count_retail_prolong = 0;
    $count_ukrauto = 0;
    $count = 0;

    $sql = 'SELECT b.number,c.financial_institutions_id,min(a.date) as date,number_insurance_year,clients_id,insurer_edrpou
FROM  insurance_policy_payments_calendar a
join insurance_policies b on b.id=a.policies_id
join  insurance_policies_kasko c on c.policies_id=b.id
where a.statuses_id>=3 and a.amount>0
group by b.number,c.financial_institutions_id,number_insurance_year,clients_id,insurer_edrpou
having min(a.date)>=\'2015-01-01\'
order by min(a.date)
';

				$list_first = $db->getAll($sql);

    foreach ($list_first as $last_payment) {
			$t = strtotime ( $last_payment['date']);
            if (in_array($last_payment['clients_id'], $ukrauto_clients_id) || in_array($last_payment['insurer_edrpou'], $ukrauto_edrpou)) $count_ukrauto++;
            elseif (intval($last_payment['financial_institutions_id']) && intval($last_payment['number_insurance_year'])>1) $count_bank_prolong++;
            elseif (intval($last_payment['financial_institutions_id'])) $count_bank_new++;
            elseif (intval($last_payment['number_insurance_year'])>1) $count_retail_prolong++;
            else $count_retail_new++;
			
			echo '<tr>';
			echo '<td>'.$last_payment['number']. '</td>';
			echo '<td align="left">' . date('01.m.Y',$t). '</td>';
 
			if (in_array($last_payment['clients_id'], $ukrauto_clients_id) || in_array($last_payment['insurer_edrpou'], $ukrauto_edrpou)) echo '<td>укравто</td>';
            elseif (intval($last_payment['financial_institutions_id']) && intval($last_payment['number_insurance_year'])>1) echo '<td>банк пролонг</td>';
            elseif (intval($last_payment['financial_institutions_id'])) echo '<td>банк новый</td>';
            elseif (intval($last_payment['number_insurance_year'])>1) echo '<td>ретайл пролонг</td>';
            else echo '<td>ретайл новый</td>';
			echo '</tr>';
			

            $count++;

     
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

 
echo '</table>';


?>