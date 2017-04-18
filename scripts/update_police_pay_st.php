<?

require_once '../include/collector.inc.php';

$sql = 'SELECT id FROM insurance_policies WHERE id > 191840 AND product_types_id = 3 ORDER BY id LIMIT 5000';
$list = $db->getCol($sql);

foreach ($list as $policies_id) {

	$sql =  'SELECT * ' .
			'FROM ' . PREFIX . '_policies ' .
			'WHERE id = ' . intval($policies_id);
	$policy = $db->getRow($sql);

	$sql =  'SELECT datetime, SUM(amount) as amount ' .
			'FROM ' . PREFIX . '_policy_payments ' .
			'WHERE policies_id = ' . intval($policies_id) . ' ' .
			'GROUP BY datetime ' .
			'ORDER BY datetime ASC';
	$payments = $db->getAll($sql);

	$sql =  'SELECT id, date, amount, ' . PAYMENT_STATUSES_NOT . ' AS statuses_id, \'0000-00-00\' AS payment_date_report ' .
			'FROM ' . PREFIX . '_policy_payments_calendar ' .
			'WHERE policies_id = ' . intval($policies_id) . ' ' .
			'ORDER BY date ASC';
	$breakdowns = $db->getAll($sql);

	if (sizeOf($breakdowns)) {

		$amount_payments = 0;
		$payments_info = array();
		foreach($payments as $payment){
			$amount_payments += $payment['amount'];
			$payments_info[] = array('amount' => $amount_payments, 'date' => $payment['datetime'], 'flag' => 1);
		}


		$amount_calendar = 0;
		if($amount_payments > 0){
			for($j=0; $j<sizeof($breakdowns); $j++){
				$amount_calendar += $breakdowns[$j]['amount'];
				for($pay=0; $pay < sizeof($payments_info); $pay++){
					$payment_info = $payments_info[$pay];
					if ($payment_info['flag']){
						$payments_info[$pay]['flag'] = 0;
						if(round($amount_calendar,2) < round($payment_info['amount'],2)){
							if (sizeof($breakdowns) == $j+1){
								$breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_OVER;
								if ($breakdowns[$j]['payment_date_report'] == '0000-00-00') $breakdowns[$j]['payment_date_report'] = $payment_info['date'];
								break;
							}else{
								$breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_PAYED;
								$breakdowns[$j]['payment_date_report'] = $payment_info['date'];
								$payments_info[$pay]['flag'] = 1;
								break;
							}
						}                                              
						if(round($amount_calendar,2) == round($payment_info['amount'],2)){
							if (sizeof($payments_info) == $pay+1){
								$breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_PAYED;
								$breakdowns[$j]['payment_date_report'] = $payment_info['date'];
								break;
							}elseif((sizeof($breakdowns) != $j+1)){
								$breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_PAYED;
								$breakdowns[$j]['payment_date_report'] = $payment_info['date'];
								$payments_info[$pay]['flag'] = 1;
								break;
							}
						}
						if(round($amount_calendar,2) > round($payment_info['amount'],2) && (sizeof($payments_info) == $pay+1)){
							$breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_PARTIAL;
							$breakdowns[$j]['payment_date_report'] = '0000-00-00';
							break;
						}
					}
				}
			}
		}
		unset($payments_info);

		foreach ($breakdowns AS $breakdown) {
			$sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
					'statuses_id = ' . intval($breakdown['statuses_id']) . ', ' .
					'payment_date_report = ' . $db->quote($breakdown['payment_date_report']) . ' ' .
					'WHERE id = ' . intval($breakdown['id']);
			$db->query($sql);

			$statuses_id = $breakdown['statuses_id'];
			
			switch ($policy['product_types_id']) {
				case PRODUCT_TYPES_CARGO_GENERAL:
					$table = PREFIX . '_policies_cargo';
				case PRODUCT_TYPES_DRIVE_GENERAL:

					if (!$table) {
						$table = PREFIX . '_policies_drive';
					}

					switch ($statuses_id) {
						case PAYMENT_STATUSES_PAYED:
						case PAYMENT_STATUSES_OVER:
							$statuses_id = PAYMENT_STATUSES_PAYED;
							break;
						default:
							$statuses_id = PAYMENT_STATUSES_NOT;
							break;
					}

					$sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
							'JOIN ' . $table . ' AS b ON a.id = b.policies_id SET ' .
								'payment_statuses_id = ' . $statuses_id . ' ' .
							'WHERE b.payments_id = ' . intval($breakdown['id']);
					//$db->query($sql);

					break;
			}
		}
	}
	_dump($policies_id);
}
	
?>