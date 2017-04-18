<?

require_once '../include/collector.inc.php';

$sql = 'select * from axapta where phone_valid = 0 and id > 280000 order by id limit 10000';
$list = $db->getAll($sql);

foreach ($list as $row) {
	$count = strlen(preg_replace('/[^\d]/', '', $row['telephone']));
	/*_dump($row);
	_dump($count);*/
	if ($count >= 5) {
		$sql = 'update axapta set phone_valid = 1 where id = ' . intval($row['id']);
		$db->query($sql);
	}
	/*_dump($sql);
	exit;*/
}

?>