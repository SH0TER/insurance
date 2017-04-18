<html>
<head>
</head>
<body>
<?php

require_once '../include/collector.inc.php';
require_once '../include/lib/Excel/reader.php';

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);

$Excel->read('../base.xls');
echo '<table border="1">';
for ($i=1; $i<=$Excel->sheets[0]['numRows']; $i++) {
	echo '<tr>';
	for ($j=1; $j < 16; $j++) {
		echo '<td>' . $Excel->sheets[0]['cells'][ $i ][ $j ] . '</td>';
	}

	list($number, $sub_number) = explode('-', $Excel->sheets[0]['cells'][ $i ][ 1 ]);

	if (is_null($sub_number)) {
		$sub_number = '0';
	}

	$sql =	'SELECT ' . PREFIX . '_agencies.title AS agencies_title, ' . PREFIX . '_accounts.lastname, ' . PREFIX . '_accounts.firstname ' .
			'FROM ' . PREFIX . '_policies ' .
			'LEFT JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_policies.agencies_id = ' . PREFIX . '_agencies.id ' .
			'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_policies.agents_id = ' . PREFIX . '_accounts.id ' .
			'WHERE ' . PREFIX . '_policies.number = ' . $db->quote($number) . ' AND sub_number = ' . $db->quote($sub_number);
	$row = $db->getRow($sql);

	echo '<td>' . $row['agencies_title'] . '</td>';
	echo '<td>' . $row['lastname'] . ' ' . $row['firstname'] . '</td>';
	echo '</tr>';
}
echo '</table>';

?>
</body>
</html>