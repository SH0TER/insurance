<?

require_once '../include/collector.inc.php';

$sql = 'select group_concat(distinct accidents.number separator \', \') as accidents_list, accounts.email 
		from insurance_accidents as accidents
		join insurance_policies as policies on accidents.policies_id = policies.id
		join insurance_accounts as accounts on accidents.average_managers_id = accounts.id 		
		where accidents.accident_statuses_id in (3,8,13,14,16) and policies.payment_statuses_id < 3 and policies.product_types_id = 3 
		group by accounts.id';
$list = $db->getAll($sql);

foreach ($list as $row) {
	$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: Express group <support@e-insurance.in.ua>' . "\r\n";
    $subject = 'Повідомлення.';
    $txt='<literal>Справи, що врегульовуються по неоплаченим договорам / додатковим угодам: ' . $row['accidents_list'] . '</literal>';
    $emails = array();
    $emails[] = $row['email'];
    $emails[] = 's.vinogradov@express-group.com.ua';
    $Templates = Templates::factory($data, 'Mail');
    $Templates->send(implode(', ', $emails), null, $template = null, $subject, $txt, 'Express group', 'support@e-insurance.in.ua', false, $files);
    exit;
}

?>