<?

require_once '../include/collector.inc.php';

$query = 'SELECT a.number, date_format(a.date, \'%d.%m.%Y\') as date, b.answer ' .
		 'FROM ' . PREFIX . '_accidents a ' .
		 'JOIN ' . PREFIX . '_accident_messages b ON a.id = b.accidents_id ' .
		 'WHERE a.date >= \'2014-01-01\' AND a.accident_statuses_id IN (3,8,13,14) AND b.message_types_id = 5';
$list = $db->getAll($query);

$res = array();
foreach ($list as $row) {	
	$answer = unserialize($row['answer']);
	
	if ($answer['result_calculation_car_services_id'] == 37) {
		$res[] = array('number' => $row['number'], 'date' => $row['date'], 'amount' => $answer['amount_work'] + $answer['amount_details'] + $answer['amount_material']);
	}
}

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
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
    <table width="600" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <td align="center">Справа</td>
			<td align="center">Дата</td>
			<td align="center">Сума</td>
        </tr>
        <?
            foreach ($res as $row) {
        ?>
        <tr>
            <td x:str align="center"><?=$row['number']?></td>
			<td align="center"><?=$row['date']?></td>
			<td align="center"><?=$row['amount']?></td>
        </tr>
        <?
            }
        ?>
    </table>
</body>
</html>