<?

include_once '../include/collector.inc.php';
include_once '../include/lib/WebServices/MTSBU.class.php';

if (date('Y-m-d') == '2014-12-31') {
	$sql = 'UPDATE insurance_accidents_last_numbers SET accidents_last_number = 0';
	$db->query($sql);
}

$wsmtsbu = new WSMTSBU();
if (date('w') == 7) {
	$wsmtsbu->loadDictionaries();
}
$wsmtsbu->import(array('Policies_Import' => true, 'PolicyBlanks_Import' => true));

if (date('w') != 5 && date('w') != 6) {
	include_once '../include/modules/ApplicationCalls.class.php';
	ApplicationCalls::generateTasks();
}

?>