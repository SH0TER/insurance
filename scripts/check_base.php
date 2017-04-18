<?

require_once '../include/collector.inc.php';
require_once '../include/lib/Excel/reader.php';

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);
$Excel->read('check_base.xls');

$list = array();
for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
	$row = array();
    $row[] = $Excel->sheets[0]['cells'][$i][1];
	$row[] = $Excel->sheets[0]['cells'][$i][2];
	$row[] = $Excel->sheets[0]['cells'][$i][3];
	$row[] = $Excel->sheets[0]['cells'][$i][4];
	$row[] = $Excel->sheets[0]['cells'][$i][5];
	$row[] = $Excel->sheets[0]['cells'][$i][6];
	$row[] = $Excel->sheets[0]['cells'][$i][7];
	$row[] = $Excel->sheets[0]['cells'][$i][8];
	$row[] = $Excel->sheets[0]['cells'][$i][9];
	$row[] = $Excel->sheets[0]['cells'][$i][10];
	$row[] = $Excel->sheets[0]['cells'][$i][11];
	$row[] = $Excel->sheets[0]['cells'][$i][12];
	$row[] = $Excel->sheets[0]['cells'][$i][13];
	$row[] = $Excel->sheets[0]['cells'][$i][14];
	
	$shassi = $Excel->sheets[0]['cells'][$i][9];
    
	$sql = 'select if(length(vin) > 0, 1, 0) from axapta_kasko_vin_cur where vin = ' . $db->quote($shassi);
	$row[] = $db->getOne($sql);
	
	$sql = 'select if(length(vin) > 0, 1, 0) from axapta_go_vin_cur where vin = ' . $db->quote($shassi);
	$row[] = $db->getOne($sql);
	
	$list[] = $row;
}

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table border="2">';

foreach ($list as $row) {
    echo '<tr>';

    foreach ($row as $cell) { ?>
		<td style='mso-number-format:"\@"'><?=$cell?>
	<? }

    echo '</tr>';
}

echo '</table>';

?>