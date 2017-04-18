<?

include_once '../include/collector.inc.php';

//$sql = 'select checkCalendarIdAsBeginPeriod(584505,2)';
//_dump($db->getOne($sql));

//$buh = array('4.13.7134','4.12.7015','4.13.1','4.13.7','4.13.6','4.12.7126','4.13.11','4.13.14','4.13.17','4.13.16','4.13.20','4.13.18','4.13.19','4.12.5870','4.13.23','4.13.25','4.13.24','4.13.28','4.13.27','4.13.32','4.13.33','4.13.30','4.13.38','4.13.35','4.13.34','4.13.39','4.13.41','4.13.42','4.13.51','4.13.8','4.13.52','4.13.48','4.13.46','4.13.13','4.13.49','4.13.47','4.13.53','4.13.58','4.13.61','4.13.55','4.13.54','4.13.57','4.13.63','4.13.62','4.13.60','4.13.64','4.13.65','4.13.69','4.13.56','4.13.67','4.13.71','4.13.68','4.13.70','4.13.74','4.13.76','4.13.4','4.13.78','4.13.79','4.13.93','4.13.80','4.13.88','4.13.89','4.13.82','4.13.86','4.13.75','4.13.87','4.13.92','4.13.85','4.13.94','4.13.95','4.13.96','4.13.97','4.13.100','4.13.98','4.13.101','4.13.102','4.13.104','4.13.105','4.13.106','4.13.108','4.13.110','4.13.109','4.13.107','4.13.111','4.13.114','4.13.116','4.13.118','4.13.119','4.13.127','4.13.122','4.13.123','4.13.124');

//$id = array(6342,5558,5894,5887,6250,6286,6430,6450,6492,6556,6620,6601,6680,6653,6661,6663,6708,6759,6729,6804,6797,6844,);
//$accidents = $db->getCol('SELECT number FROM insurance_accidents WHERE product_types_id = 4 AND amount_rough > 0 AND date BETWEEN \'2013-01-01\' AND \'2013-03-31\'  ORDER BY date');
/*foreach($buh as $a){
	if(!in_array($a, $accidents)){
		_dump($a);
	}
}*/


/*$accidents = $db->getAll('SELECT a.id, a.number, a.amount_rough, a.date 
			FROM insurance_accidents as a
			JOIN insurance_accidents_go as b ON a.id = b.accidents_id
			LEFT JOIN insurance_accident_status_changes as c ON a.id = c.accidents_id AND c.accident_statuses_id = 5 
			WHERE a.product_types_id = 4 AND a.amount_rough > 0 AND a.date < \'2014-01-01\' AND b.owner_types_id = 2 AND (c.created >= \'2014-01-01\'  OR c.created IS NULL)
			GROUP BY id
			ORDER BY date');*/
/*$accidents = $db->getAll('SELECT a.id, a.number, a.amount_rough, a.date 
			FROM insurance_accidents as a
			JOIN insurance_accidents_go as b ON a.id = b.accidents_id
			LEFT JOIN insurance_accidents_acts as c ON a.id = c.accidents_id
			WHERE a.product_types_id = 4 AND a.amount_rough > 0 AND a.date < \'2014-01-01\' AND b.owner_types_id = 2
			GROUP BY a.id
			HAVING MIN(c.date) >= \'2014-01-01\' OR ((MIN(c.date) = \'0000-00-00\' OR MIN(c.date) IS NULL) AND c.number = CONCAT(a.number,\'-1\')) 
			ORDER BY a.date');*/

$product_types_id = 4;

if ($product_types_id==4) {

$accidents = $db->getAll('SELECT a.id, a.number, a.amount_rough, a.date 
			FROM insurance_accidents as a
			JOIN insurance_accidents_go as b ON a.id = b.accidents_id
			LEFT JOIN insurance_accidents_acts as c ON a.id = c.accidents_id AND CONCAT(a.number, \'-1\') = c.number
			WHERE a.product_types_id = 4 AND a.amount_rough > 0 AND a.date < \'2016-03-01\' AND b.owner_types_id = 2 AND
				(c.date >= \'2016-03-01\' OR c.date = \'0000-00-00\' OR c.date IS NULL) 
			GROUP BY a.id
			ORDER BY a.date');

}

if ($product_types_id==3) {
$accidents = $db->getAll('SELECT a.id, a.number, a.amount_rough, a.date 
			FROM insurance_accidents as a
			LEFT JOIN insurance_accidents_acts as c ON a.id = c.accidents_id AND CONCAT(a.number, \'-1\') = c.number
			WHERE a.product_types_id = 3 AND a.amount_rough > 0 AND a.date < \'2014-04-01\' AND
				(c.date >= \'2014-04-01\' && c.act_statuses_id = 10 OR c.date = \'0000-00-00\' OR c.date IS NULL) AND
				a.date > \'2012-01-01\'
			GROUP BY a.id
			ORDER BY a.date');
}

//_dump($accidents);exit;
$count = 0;
$amount_rough = 0;
$ids = array();
$idx = array();
foreach($accidents as $accident){
    /*$payment_date = $db->getOne('SELECT payment_date FROM insurance_accident_payments_calendar WHERE payment_types_id = 6 AND accidents_id = ' . intval($accident['id']));
     if(strlen($payment_date) != 0){
        if($payment_date == '0000-00-00' || strtotime($payment_date) >= strtotime('2013-12-01')){
            $accident['payment_date'] = $payment_date;
//            _dump($accident);
            $count++;
		$ids[] = '\'' . $accident['number'] . '\'';
		$idx[] = $accident['number'];
            $amount_rough += $accident['amount_rough'];
        }
    }else{
        $accident['payment_date'] = $payment_date;
//        _dump($accident);*/
        $count++;
	$ids[] = '\'' . $accident['number'] . '\'';
//echo $accident['number'].';	'.$accident['amount_rough'].'<br>';
echo $accident['number'].'<br>';
	$idx[] = array('number' => $accident['number'], 'amount' => $accident['amount_rough']);
        $amount_rough += $accident['amount_rough'];
//    }
}

_dump($count); _dump($amount_rough); _dump(implode(',',$ids));exit;

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));	   

?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
<style>
* {
	font-size: 11px;
	font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
}
.columns TD {
	height: 25px;
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background-color: #008575;
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
<? if (is_array($idx)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
        <td>number</td>
	<td>amount</td>
    </tr>
    <?
        foreach ($idx as $row) {
    ?>
        <tr>
			<td style='mso-number-format:"\@";'><?=$row['number']?></td>
			<td><?=$row['amount']?></td>
        </tr>
    <?
        }
    ?>
</table>
<? } ?>
</body>
</html>