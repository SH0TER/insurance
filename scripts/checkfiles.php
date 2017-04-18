<?

require_once '../include/collector.inc.php';

$mas=array();
$mas=explode("\r\n", file_get_contents('files3.txt'));
//_dump($mas);

foreach ($mas as $f) {
	$sql = 'INSERT INTO `!files` VALUES(' . $db->quote($f) . ', 3)';
	_dump($sql);
	$db->query($sql);
}


exit;

$types = array(
	1	=>	array(
		'table'			=>	'insurance_accident_documents',
		'title'			=>	'AccidentDocuments',
		'catalog'		=>	'../files/AccidentDocuments',
		'size'			=>	0
	)/*,
	2	=>	array(
		'table'			=>	'insurance_accident_documents',
		'title'			=>	'AccidentDocumentsTemplates',
		'catalog'		=>	'../files/AccidentDocumentsTemplates',
		'size'			=>	0
	)*/
);

$count = 0;
$total_count = 0;
$total_size = 0;

foreach ($types as $type) {
	
	$count = 0;
	echo $type['title'] . ':<br>';
	if ($handle = opendir($type['catalog'])) {

		while (false !== ($file = readdir($handle))) { 
			if ($file !== '.' && $file !== '..') {
				$sql = 'SELECT id FROM ' . $type['table'] . ' WHERE template = ' . $db->quote($file);
				if (!intval($db->getOne($sql))) {
					//echo $file . ' - '  . filesize($type['catalog'] . '/' . $file) . '<br/>';
					$type['size'] += filesize($type['catalog'] . '/' . $file);
					$count++;
				}				
			}
		}
		closedir($handle); 
	}
	echo 'Count: ' . $count . '. Size(b): ' . $type['size'] . '. Size(Kb): ' . roundNumber($type['size'] / 1024, 2) . '. Size(Mb): ' . roundNumber($type['size'] / (1024 * 1024), 2) . '<br>';
	$total_count += $count;
	$total_size += $type['size'];
}

echo 'Count: ' . $total_count . '. Size(b): ' . $total_size . '. Size(Kb): ' . roundNumber($total_size / 1024, 2) . '. Size(Mb): ' . roundNumber($total_size / (1024 * 1024), 2) . '<br>';

?>