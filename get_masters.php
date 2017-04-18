<?

require_once 'include/collector.inc.php';

$sql = 'SELECT car_services.id, CONCAT(accounts.lastname, \' \', accounts.firstname) as name, car_services.title ' .
	   'FROM insurance_accounts as accounts ' .
	   'JOIN insurance_masters as masters ON accounts.id = masters.accounts_id ' .
	   'JOIN insurance_car_services as car_services ON masters.car_services_id = car_services.id ' .
	   'WHERE accounts.active = 1 ' . 
	   'ORDER BY car_services.id';
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="masters.xls"');
header('Content-Type: ' . Form::getContentType('masters.xls'));

?>

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
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<?
	$cur_car_services_id = 0;
	foreach($list as $row){
		if ($cur_car_services_id != 0) echo '<tr><td></td></tr>';
		$cur_car_services_id = $row['id'];
		if ($cur_car_services_id != $row['id']){
			echo '<tr><td colspan="2">' . $row['title'] . '</td></tr>';
		}
		echo '<tr><td></td></tr>';
		echo '<tr><td>' . $row['name'] . '</td></tr>';
	}
?>
</table>
</body>
</html>