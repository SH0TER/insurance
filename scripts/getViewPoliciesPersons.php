<?

require_once '../include/collector.inc.php';

$policies = array('202.14.2222093','208.14.2221897','202.14.2221698','208.14.2221190','208.14.2221593','202.14.2222067','202.14.2221432','202.14.2221973','208.14.2221634','208.14.2221881');

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table>';
foreach($policies as $policy) {
	echo '<tr><td>' . $policy .  '</td></tr>';
	$sql = 'select concat_ws(\' \', accounts.lastname, accounts.firstname, accounts.patronymicname) as person, date_format(log.created, \'%H:%i:%s %d.%m.%Y\') as created 
			from insurance_accounts as accounts 
			join insurance_log as log on accounts.id = log.accounts_id 
			join insurance_policies as policies on log.items_id = policies.id
			where log.action = \'Policies|view\' and policies.number = ' . $db->quote($policy);
	$list = $db->getAll($sql);
	
	foreach($list as $row) {
		echo '<tr>';
		echo '<td>' . $row['person'] . '</td>';
		echo '<td>' . $row['created'] . '</td>';
		echo '</tr>';
	}
	echo '<tr><td></td></tr>';
}
echo '</table>';

?>