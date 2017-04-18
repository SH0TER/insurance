<?

require_once '../include/collector.inc.php';

$sql = 'SELECT id, title FROM insurance_agencies WHERE id = top AND active = 1 ORDER BY title';
$top_agencies = $db->getAll($sql);

foreach ($top_agencies as $top_agency) {
	$values[$top_agency['id']]['top']['id'] = $top_agency['id'];
	$values[$top_agency['id']]['top']['title'] = $top_agency['title'];
	
	$sql = 'SELECT a.id, a.title as agency_title, b.title as agency_types_title FROM insurance_agencies a JOIN insurance_agency_types b ON a.agency_types_id = b.id WHERE a.active = 1 AND a.top = ' . intval($top_agency['id']);
	$agencies = $db->getAll($sql);
	foreach ($agencies as $agency) {
		$values[$top_agency['id']]['agencies'][$agency['id']]['id'] = $agency['id'];
		$values[$top_agency['id']]['agencies'][$agency['id']]['title'] = $agency['agency_title'];
		$values[$top_agency['id']]['agencies'][$agency['id']]['type'] = $agency['agency_types_title'];
	}
}

header('Content-Disposition: attachment; filename="getAgencyTypes.xls"');
header('Content-Type: ' . Form::getContentType('getAgencyTypes.xls'));

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
<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<tr class="columns">
		<td>Головна агенція</td>
		<td>Агенція</td>
		<td>Тип</td>
	</tr>
	<? 
	$previous_top = 0;
	foreach($values as $row) { 
	?>
	<tr>
		<td style="vertical-align: top;" rowspan="<?=sizeof($row['agencies'])?>"><?=$row['top']['title']?></td>
		<? foreach ($row['agencies'] as $agency) { ?>
			<? if ($row['top']['id'] != $agency['id']) { ?>
				
			<? } ?>
				<td><?=$agency['title']?></td>
				<td><?=$agency['type']?></td>
			</tr>
		<? } ?>
	<? } ?>
</table>
</body>
</html>