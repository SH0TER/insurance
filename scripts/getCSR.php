<?

require_once '../include/collector.inc.php';

$sql = 'SELECT a.number, b.answer as a1, c.answer as a2
		FROM insurance_accidents_acts a
		JOIN insurance_accident_messages b ON a.accident_messages_id = b.id
		JOIN insurance_accident_messages c ON a.request_id = c.id
		WHERE b.recipient_roles_id = 4';
		
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table>';

$data = array();
foreach ($list as $row) {
	$a1 = unserialize($row['a1']);
	$a2 = unserialize($row['a2']);
	
	$data[] = array($row['number'], $a2['request_date'], $a2['answer_date'], $a1['parts_days']);
	
	echo '<tr>';
    echo '<td align="left">' . $row['number'] . '</td>';
    echo '<td align="left">' . $a2['request_date'] . '</td>';
    echo '<td align="left">' . $a2['answer_date'] . '</td>';
    echo '<td align="left">' . $a1['parts_days'] . '</td>';
	echo '</tr>';
	
}

echo '</table>';

?>
