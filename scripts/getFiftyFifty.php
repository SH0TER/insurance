<?

require_once '../include/collector.inc.php';

$sql = 'select a.datetime, b.number, if(c.insurer_person_types_id=1, concat_ws(\' \', c.insurer_lastname, c.insurer_firstname, c.insurer_patronymicname), c.insurer_company) as insurer
		from insurance_application_accidents as a
		join insurance_policies as b on a.policies_kasko_id = b.id
		join insurance_policies_kasko as c on b.id = c.policies_id
		where c.options_fifty_fifty = 1 and a.datetime between \'2015-01-01 00:00:00\' and \'2015-03-31 23:59:59\'
		group by b.number';
		
$accidents = $db->getAll($sql);

$result = array();

foreach ($accidents as $accident) {
	$row = array();
	$row['number'] = $accident['number'];
	$row['insurer'] = $accident['insurer'];

	$sql = 'select max(a.date)
			from insurance_policy_payments_calendar as a
			join insurance_policies as b on a.policies_id = b.id
			where a.valid = 1 and a.date <= ' . $db->quote($accident['datetime']) . ' and b.number = ' . $db->quote($accident['number']);
	$date = $db->getOne($sql);
	
	$sql = 'select a.number_insurance_year
			from insurance_policy_payments_calendar as a
			join insurance_policies as b on a.policies_id = b.id
			where a.valid = 1 and a.date = ' . $db->quote($date) . ' and b.number = ' . $db->quote($accident['number']);
	$number_insurance_year = $db->getOne($sql);
	
	$sql = 'select a.amount
			from insurance_policy_payments_calendar as a
			join insurance_policies as b on a.policies_id = b.id
			where a.valid = 1 and a.number_insurance_year = ' . intval($number_insurance_year) . ' and b.number = ' . $db->quote($accident['number']) . '
			order by a.date limit 1';
	$amount = $db->getOne($sql);
	
	$row['row'] = $amount;
	
	$result[] = $row;
}

//_dump($result);

header('Content-Disposition: attachment; filename="fifty_fifty.xls"');
header('Content-Type: ' . Form::getContentType('fifty_fifty.xls'));

echo '<table><tr>';

echo '<td>Сума</td>';
echo '<td>Номер договору</td>';
echo '<td>Страхувальник</td>';

echo '</tr>';

foreach ($result as $row) {
    echo '<tr>';
	
	echo '<td>' . getRateFormat($row['row'], 2) . '</td>';
	echo '<td>' . $row['number'] . '</td>';
	echo '<td>' . $row['insurer'] . '</td>';
	
    echo '</tr>';
}

echo '</table>';

?>