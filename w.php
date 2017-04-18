<?



var_dump(file_get_contents ('https://aps-gw.credit-agricole.com.ua/UkrAutoExchange.asmx?WSDL'));
exit;
include_once './include/collector.inc.php';

 
$sql='
select * from insurance_policies where product_types_id=3 and agreement_types_id=3
';


$res = $db->getAll($sql);
foreach($res as $row){
$sql1='
select id from insurance_policies_kasko_item_years_payments where policies_id='.$row['id'].' order by date limit 1';

echo $sql1.'<br>';
$res = $db->getOne($sql1);

if ($res)
$db->query('update insurance_policies_kasko_item_years_payments set f=1 where id='.$res);

}
echo 'done';

?>