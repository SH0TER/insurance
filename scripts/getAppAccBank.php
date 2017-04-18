<?

require_once '../include/collector.inc.php';

$fid = 1;

$sql = 'select accidents.id, accidents.number,
			if (policies_kasko.insurer_person_types_id = 1, concat_ws(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_lastname) as insurer,
			if (policies_kasko.insurer_person_types_id = 1, policies_kasko.insurer_identification_code, policies_kasko.insurer_edrpou) as insurer_code,
			date_format(accidents.date, \'%d.%m.%Y\') as accidents_date,
			policies_kasko.insurer_phone
		from insurance_accidents as accidents
		join insurance_policies_kasko as policies_kasko on accidents.policies_id = policies_kasko.policies_id
		where accidents.date between \'2013-01-01\' and \'2014-09-01\' and policies_kasko.financial_institutions_id = ' . intval($fid);
$accidents = $db->getAll($sql);
//_dump($accidents);exit;

$insurance_title = array(0 => 'в роботі', 1 => 'страховий, з виплатою', 2 => 'страховий, без виплати', 3 => 'не страховий', 4 => 'не визначено', 5 => 'призупинено');

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table>
		<tr class="columns">
			<td>ПІБ/Назва</td>
			<td>ІНН/ЄДРПОУ</td>
			<td>Вид страхування</td>
			<td>Дата звернення</td>
			<td>Телефон</td>
			<td>Рішення</td>
		</tr>';

foreach ($accidents as $accident) {
	$sql = 'select insurance, act_statuses_id
			from insurance_accidents_acts
			where act_statuses_id in (5,6,10) and accidents_id = ' . intval($accident['id']) . '
			order by date desc limit 1';
	$insurance = $db->getRow($sql);
	
	if ($insurance == null) $insurance = 0;
	elseif ($insurance['act_statuses_id'] == 10) $insurance = 5;
	elseif ($insurance['act_statuses_id'] == 0) $insurance = 4;
	else $insurance = $insurance['insurance'];
	
	echo '<tr>
			<td>' . $accident['insurer'] . '</td>
			<td>' . $accident['insurer_code'] . '</td>
			<td>КАСКО</td>
			<td>' . $accident['accidents_date'] . '</td>
			<td>' . $accident['insurer_phone'] . '</td>
			<td>' . $insurance_title[$insurance] . '</td>
			<td>' . $accident['number'] . '</td>
		</tr>';
}

echo '</table>';

?>