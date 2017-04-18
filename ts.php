<?
require_once 'include/collector.inc.php';
	require_once 'Products.class.php';
	require_once 'Policies.class.php';
	require_once 'Products/KASKO.class.php';
	require_once 'Policies/KASKO.class.php';
	require_once 'Policies/DGO.class.php';
    require_once 'Policies/GO.class.php';
	require_once 'Policies/NS.class.php';
	require_once 'Policies/DSKV.class.php';
	require_once 'Policies/Property.class.php';
	require_once 'Policies/Drive.class.php';
	require_once 'Policies/DriveGeneral.class.php';
	require_once 'Policies/Cargo.class.php';

	$Kasko=new Policies_KASKO($data);

$sql='select * from temp_policies';
$list = $db->getAll($sql);
foreach($list as $row)
{
//	      $Kasko->setCommissions($row['policies_id']);
$data['id'] = $row['policies_id']          ;
$Kasko->changeServicePersonInWindow($data);
//		echo file_get_contents('http://e-insurance.in.ua/index.php?do=Policies|changeServicePersonInWindow&id='.$row['policies_id'].'&product_types_id=3');
//exit;
}
echo 'done';
?>