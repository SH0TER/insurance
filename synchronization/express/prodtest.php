<?

	require_once '../../include/collector.inc.php';
gc_enable();
	require_once 'Products.class.php';
	require_once 'Policies.class.php';
	require_once 'Products/KASKO.class.php';
	require_once 'Policies/KASKO.class.php';
//	$KaskoProd=new Products_KASKO($data);
//	$KaskoPoliciy=new Policies_KASKO($data);
$sql='
SELECT a.id, a.number
FROM insurance_policies a
JOIN insurance_policies_kasko b ON b.policies_id = a.id
WHERE a.product_types_id =3
AND year( begin_datetime ) =2013
AND number LIKE \'201.%\'
AND (length( sub_number ) =0
OR sub_number IS NULL 
OR sub_number = \'0\'
)
AND a.types_id =1
AND b.discount =0
';
$list = $db->getAll($sql);
?>
<table border=1>



<?
$t=0;
foreach($list as $r) {
	$data=array();
	$data['id'] = $r['id'];
	$KaskoPoliciy=new Policies_KASKO($data);
	$data = $KaskoPoliciy->load($data,false); 	
$t++;
//echo $t.'<br>';
	$KaskoProd=new Products_KASKO(array());
	$res = $KaskoProd->calculateNewRate(array_merge ( $data,$data['items'][0] ));
	echo '
	<tr>
	<td>'.$r['number'].'</td>
	<td>'.$data['items'][0]['rate_kasko'] .'</td>
	<td>'.$res['result'].'</td>
	<td>'.$data['items'][0]['commission_agent_percent'].'</td>
	<td>'.$res['formula'].'</td>
	</tr>
	';

	unset($KaskoPoliciy);unset($KaskoProd);
	unset($data);
}
/*$data['id'] = 198314;
	$data = $KaskoPoliciy->load($data,false);
//_dump($data);
	$res = $KaskoProd->calculateNewRate(array_merge ( $data,$data['items'][0] ));
_dump($res);
*/
?>
</table>