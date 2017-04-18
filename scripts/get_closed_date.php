<?

require_once '../include/collector.inc.php';
require_once '../include/lib/Excel/reader.php';

$sql = 'SELECT number FROM insurance_accidents WHERE resolved_date IS NULL OR resolved_date = \'0000-00-00\'';
$col = $db->getCol($sql);

foreach ($col as $number) {
	$col_0[] = ltrim($number, '0');
	$col_1[ltrim($number, '0')] = $number;
}

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);
$Excel->read('acc_10-11.xls');

for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++){
    $accidents_number = $Excel->sheets[0]['cells'][$i][1];
    $closed_date = substr($Excel->sheets[0]['cells'][$i][3], 6, 4) . '-' . substr($Excel->sheets[0]['cells'][$i][3], 3, 2) . '-' . substr($Excel->sheets[0]['cells'][$i][3], 0, 2);
	if (in_array($accidents_number, $col) || in_array($accidents_number, $col_0)) {
		$sql = 'UPDATE insurance_accidents SET resolved_date = ' . $db->quote($closed_date) . ' WHERE number = ' . $db->quote($col_1[$accidents_number]);
		$db->query($sql);
	}
}

$sql = 'SELECT number FROM insurance_accidents WHERE resolved_date IS NULL OR resolved_date = \'0000-00-00\'';
$col = $db->getCol($sql);

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);
$Excel->read('acc_10-11_2.xls');

for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++){
    $accidents_number = $Excel->sheets[0]['cells'][$i][1];_dump($accidents_number);
    $closed_date = substr($Excel->sheets[0]['cells'][$i][3], 6, 4) . '-' . substr($Excel->sheets[0]['cells'][$i][3], 3, 2) . '-' . substr($Excel->sheets[0]['cells'][$i][3], 0, 2);
	if (in_array($accidents_number, $col)) {	
		$sql = 'UPDATE insurance_accidents SET resolved_date = ' . $db->quote($closed_date) . ' WHERE number = ' . $db->quote($accidents_number);
		$db->query($sql);
	}
}

?>