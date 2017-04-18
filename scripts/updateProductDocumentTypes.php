<?
require_once '../include/collector.inc.php';
require_once '../include/lib/Classes/PHPExcel/IOFactory.php';

$objPHPExcel = PHPExcel_IOFactory::load('111.xls');
$sheet = $objPHPExcel->setActiveSheetIndex(0);

foreach ($sheet->getRowIterator() as $rownum=>$row) {
   foreach ($row->getCellIterator() as $colnum=>$cell) {
       $val = $cell->getCalculatedValue();
   }
}

for($i = 2; $i<=$rownum; $i++){
    $policies_number[] =  $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(18, $i)->getValue();
}
foreach($policies_number as $row){
    $sql = 'Update insurance_policy_documents SET product_document_types_id = 107 WHERE product_document_types_id = 44 AND policies_id = ' . intval($row);
    $db->query($sql);
    $sql = 'Update insurance_policy_documents SET product_document_types_id = 106 WHERE product_document_types_id = 70 AND policies_id = ' . intval($row);
    $db->query($sql);
}
?>