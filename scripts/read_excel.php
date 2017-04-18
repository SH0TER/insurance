<?php

require_once '../include/collector.inc.php';
require_once '../include/lib/Excel/reader.php';

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding(CHARSET);
$id=1;
$Excel->read('rezerv.xls');
for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
    //echo $Excel->sheets[0]['cells'][$i][1];exit;
    $sql = 'INSERT INTO rezerv_buh SET ' .
           'number = ' . $db->quote($Excel->sheets[0]['cells'][$i][2]) . ', ' .
           'amount = ' . $db->quote($Excel->sheets[0]['cells'][$i][3]);/* . ', ' .
           'amount = ' . str_replace(',', '.', $Excel->sheets[0]['cells'][$i][3]) . ', ' .
           'amount_without_return = ' . str_replace(',', '.', $Excel->sheets[0]['cells'][$i][4]) . ', ' .
           'amount_return = ' . str_replace(',', '.', $Excel->sheets[0]['cells'][$i][5]) . ', ' .
           'policies_status = ' . $db->quote($Excel->sheets[0]['cells'][$i][6]) . ', ' .
           'statuses_id = ' . $Excel->sheets[0]['cells'][$i][7] . ', ' .
           'status = ' . $db->quote($Excel->sheets[0]['cells'][$i][8]) . ', ' .
           'series_old = ' . $db->quote($Excel->sheets[0]['cells'][$i][9]) . ', ' .
           'number_old = ' . $db->quote($Excel->sheets[0]['cells'][$i][10]);*/
    //_dump($sql);exit;
    $db->query($sql);

}
exit;

?>