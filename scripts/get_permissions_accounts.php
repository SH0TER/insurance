<?

include_once '../include/collector.inc.php';

$sql = 'SELECT id FROM insurance_accounts WHERE LOCATE(\'euassist.com.ua\', email)';
$accounts_id = $db->getCol($sql);

//$accounts_id = array(12015, 6637, 6671, 9686);
$accounts = array();

$sql = 'SET SESSION group_concat_max_len = 10000000';
$db->query($sql);

foreach($accounts_id as $account_id) {
	$sql = 'SELECT CONCAT_WS(\' \', lastname, firstname) FROM insurance_accounts WHERE id = ' . intval($account_id);
	$accounts[intval($account_id)]['name'] = $db->getOne($sql);
	
	$sql = 'SELECT GROUP_CONCAT(a.title SEPARATOR \'; \') FROM insurance_account_groups as a JOIN insurance_account_groups_managers_assignments as b ON a.id = b.account_groups_id WHERE b.accounts_id = ' . intval($account_id);
	$accounts[intval($account_id)]['roles'] = $db->getOne($sql);
	
	$sql = 'SELECT account_groups_id FROM insurance_account_groups_managers_assignments WHERE accounts_id = ' . intval($account_id);
	$account_groups_id = $db->getCol($sql);

	$sql = 'SELECT GROUP_CONCAT(a.title SEPARATOR \'; \') FROM insurance_account_permissions as a JOIN insurance_account_group_permissions as b ON a.id = b.account_permissions_id WHERE b.account_groups_id IN (' . implode(', ', $account_groups_id) . ')';
	$accounts[intval($account_id)]['permissions'] = $db->getOne($sql);
}

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
<? if (is_array($accounts)) {?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
        <td>Менеджер</td>
		<td>Перелік ролей</td>
		<td>Перелік дій</td>
    </tr>
    <?
        foreach ($accounts as $row) {
    ?>
        <tr>
			<td><?=$row['name']?></td>
			<td><?=$row['roles']?></td>
			<td><?=$row['permissions']?></td>
        </tr>
    <?
        }
    ?>
</table>
<? } ?>
</body>
</html>