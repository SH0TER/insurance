<?

require_once '../include/collector.inc.php';
require_once 'Accidents.class.php';
$AK = new Accidents(array('product_types_id'=>3));
$data['id'] = 16576;
$AK->generateDocuments($data['id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_NOTE_AGREEMENT), $data);
?>