<?

include_once './include/collector.inc.php';


//kasko
$sql1='
select distinct a.id from insurance_policies a
join insurance_policies_kasko b on b.policies_id=a.id
join insurance_policy_payments_calendar c on c.policies_id=a.id 
where  (a.date >= \'2016-08-01\' OR payment_date>=\'2016-08-01\') and a.agreement_types_id<>3
';

//go
$sql2='
select distinct a.id from insurance_policies a
join insurance_policies_go b on b.policies_id=a.id
join insurance_policy_payments_calendar c on c.policies_id=a.id 
where (a.date >= \'2016-08-01\' OR payment_date>=\'2016-08-01\' or  begin_datetime>=\'2016-08-01\')
';

//dgo
$sql3='
select distinct a.id from insurance_policies a
join insurance_policies_dgo b on b.policies_id=a.id
join insurance_policy_payments_calendar c on c.policies_id=a.id 
where (a.date >= \'2016-08-01\' OR payment_date>=\'2016-08-01\' or  begin_datetime>=\'2016-08-01\')  
';



//$sql='SELECT policies_id as id 
//FROM  temp ';

$res = $db->getAll($sql1);
_dump(sizeof($res));

$k=0;
foreach($res as $row){

 $url = 'http://e-insurance.in.ua/index.php?do=Policies|changeServicePersonInWindow&id='.$row['id'].'&product_types_id=3';
_dump($url);
//exit;
$contents = file_get_contents ($url);


            _dump($contents );
}
//_dump($k);

?>