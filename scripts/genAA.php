<?

require_once '../include/collector.inc.php';

/*$kasko = array("3.14.2656","3.14.2797","3.14.2806","3.14.2808","3.14.2809","3.14.2816","3.14.2818","3.14.2821","3.14.2823","3.14.2825","3.14.2832","3.14.2833","3.14.2842","3.14.2843","3.14.2848","3.14.2856","3.14.1196","3.14.1237","3.14.1279","3.14.1324","3.14.1368",
			   "3.14.1410","3.14.1463","3.14.1590","3.14.1678","3.14.1730","3.14.1833","3.14.1847","3.14.2038","3.14.2108","3.14.2120","3.14.2121","3.14.2250","3.14.2321","3.14.2386","3.14.2387","3.14.2531","3.14.2615","3.14.2618","3.14.2623","3.14.2641",
			   "3.14.2655","3.14.2659","3.14.2660","3.14.2661","3.14.2663","3.14.2664","3.14.2667","3.14.2670","3.14.2672","3.14.2673","3.14.2681","3.14.2688","3.14.2689","3.14.2692","3.14.2696","3.14.2700","3.14.2705","3.14.2706","3.14.2716","3.14.2720",
			   "3.14.2725","3.14.2730","3.14.2733","3.14.2739","3.14.2740","3.14.2741","3.14.2749","3.14.2755","3.14.2762","3.14.2765","3.14.2768","3.14.2769","3.14.2772","3.14.2773","3.14.2781","3.14.2782","3.14.2787","3.14.2788","3.14.2797","3.14.904",
			   "3.14.913","3.14.933","3.14.968");
			   
$go = array("4.14.915","4.14.918","4.14.922","4.14.918","4.14.320","4.14.350","4.14.364","4.14.400","4.14.551","4.14.642","4.14.664","4.14.845","4.14.854","4.14.856","4.14.862","4.14.863","4.14.866","4.14.876","4.14.879","4.14.882","4.14.895","4.14.907");*/

$kasko = array("3.14.1660","3.14.1707","3.14.1749");
$go = array("4.14.542");

foreach ($kasko as $number) {

	$sql = 'select a.policies_id, b.items_id, a.masters_id, a.date, a.applicant_lastname, a.applicant_firstname, a.applicant_patronymicname, b.inspecting_account_id
			from insurance_accidents a
			join insurance_accidents_kasko b on a.id = b.accidents_id
			where a.number = ' . $db->quote($number);
	$row = $db->getRow($sql);
	_dump($sql);
	
	$sql = 'insert into insurance_application_accidents set owner_types_id = 1,
				statuses_id = 10, policies_kasko_id = ' . intval($row['policies_id']) . ', policies_kasko_items_id = ' . intval($row['items_id']) . ', applicant_lastname = ' . $db->quote($row['applicant_lastname']) . ', 
				applicant_firstname = ' . $db->quote($row['applicant_firstname']) . ', applicant_patronymicname = ' . $db->quote($row['applicant_patronymicname']) . ', creator_id = ' . intval($row['masters_id']) . ',
				inspecting_accounts_id = ' . intval($row['inspecting_account_id']) . ', created = ' . $db->quote($row['date']);
	$db->query($sql);
	_dump($sql);
	
	$id = mysql_insert_id();
	
	$sql = 'update insurance_application_accidents set number = ' . $db->quote('14.' . $id) . ' where id = ' . $id;
	$db->query($sql);	
	_dump($sql);
			
}		
		
foreach ($go as $number) {
	
	$sql = 'select a.policies_id, a.masters_id, a.date, a.applicant_lastname, a.applicant_firstname, a.applicant_patronymicname, b.inspecting_account_id, b.owner_types_id
			from insurance_accidents a
			join insurance_accidents_go b on a.id = b.accidents_id
			where a.number = ' . $db->quote($number);
	$list = $db->getAll($sql);
	_dump($sql);
	
	foreach ($list as $row) {
		$sql = 'insert into insurance_application_accidents set owner_types_id = ' . $row['owner_types_id'] . ',
				statuses_id = 10, policies_go_id = ' . intval($row['policies_id']) . ', applicant_lastname = ' . $db->quote($row['applicant_lastname']) . ', 
				applicant_firstname = ' . $db->quote($row['applicant_firstname']) . ', applicant_patronymicname = ' . $db->quote($row['applicant_patronymicname']) . ', creator_id = ' . intval($row['masters_id']) . ',
				inspecting_accounts_id = ' . intval($row['inspecting_account_id']) . ', created = ' . $db->quote($row['date']);
		$db->query($sql);
		_dump($sql);
		
		$sql = 'update insurance_application_accidents set number = ' . $db->quote('14.' . $id) . ' where id = ' . $id;
		$db->query($sql);
		_dump($sql);
	}
			
}

?>