<?

require_once '../include/collector.inc.php';

$sql = 'select acts_id from insurance_accident_payments_calendar where recipient_types_id = 5 and payment_types_id = 6 group by acts_id';
$list = $db->getCol($sql);

_dump($list);

$sql = 'update insurance_accidents_acts set in_repair = 1 where id in(' . implode(',',$list) .  ')';
$db->query($sql);

?>