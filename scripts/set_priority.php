<?

require_once '../include/collector.inc.php';
require_once '../include/lib/Excel/reader.php';

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);
$Excel->read('priority.xls');

$columns = array();

for ($i = 2; $i <= 17; $i++) {
    $columns[$i] = $Excel->sheets[0]['cells'][1][$i];
}

$list = array();
for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
    $car_services_id = intval($Excel->sheets[0]['cells'][$i][1]);

    foreach ($columns as $col => $id) {
        $sql = 'insert into insurance_car_services_priority
                set car_services_id = ' . intval($car_services_id) . ',
                    brands_id = ' . intval($id) . ',
                    priority = ' . intval($Excel->sheets[0]['cells'][$i][$col]);
        $db->query($sql);
    }
}

?>