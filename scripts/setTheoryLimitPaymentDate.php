<?

require_once '../include/collector.inc.php';
require_once 'BankDay.php';

function setTheoryLimitPaymentDateKasko($id, $type) {
		global $db;
		
		switch ($type){
			case 1:
				$date = $db->getOne('SELECT date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = $db->getOne('SELECT payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
			case 2:
				$date = $db->getOne('SELECT documents_date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = $db->getOne('SELECT approval_term + payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
		}
		
		$sql = 'UPDATE ' . PREFIX . '_accident_payments_calendar ' .
			   'SET theory_limit_payment_date = ' . $db->quote(BankDay::getEndDate($date, $total_term, 'Y-m-d')) . ' ' .
			   'WHERE acts_id = ' . intval($id);
		$db->query($sql);
	}
	
function setTheoryLimitPaymentDateGo($id, $type) {
		global $db;
		
		switch ($type){
			case 1:
				//$date = $db->getOne('SELECT date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$date = $db->getOne('SELECT documents_date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = 90;//$db->getOne('SELECT payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
			case 2:
				$date = $db->getOne('SELECT documents_date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = 90;//$db->getOne('SELECT approval_term + payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
		}
		
		$sql = 'UPDATE ' . PREFIX . '_accident_payments_calendar ' .
			   'SET theory_limit_payment_date = ADDDATE(' . $db->quote($date) .  ', INTERVAL 90 DAY)' . ' ' .
			   'WHERE acts_id = ' . intval($id);
		$db->query($sql);
	}

$sql = 'select b.id, b.product_types_id, b.date
from insurance_accident_payments_calendar a
join insurance_accidents_acts b on a.acts_id = b.id
where b.documents_date = \'0000-00-00\' and b.date <> \'0000-00-00\' and a.theory_limit_payment_date = \'0000-00-00\' AND a.payment_statuses_id = 1
group by b.id';
//_dump($sql);
$sql = 'SELECT id, product_types_id, date FROM insurance_accidents_acts WHERE documents_date <> \'0000-00-00\'';
$list = $db->getAll($sql);

foreach($list as $row) {
	if ($row['product_types_id'] == 4) setTheoryLimitPaymentDateGo($row['id'], 1);
	if ($row['product_types_id'] == 3) {
		if ($row['date'] <> '0000-00-00') setTheoryLimitPaymentDateKasko($row['id'], 1);
		else setTheoryLimitPaymentDateKasko($row['id'], 2);
	}
}

?>