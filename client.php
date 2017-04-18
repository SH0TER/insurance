<?

require_once 'include/collector.inc.php';
require_once 'include/modules/Policies.class.php';

$sql =	'SELECT * ' .
	    'FROM insurance_policies as a '	 .
	    'JOIN insurance_policies_kasko as b ON a.id = b.policies_id ' .
	    'WHERE id = 120814';
$row =	$db->getRow($sql);

$Policies = Policies::factory($data, 'KASKO');
$Policies->setClient($row);

?>