<?
/*
 *
 */

require_once '../../include/collector.inc.php';
$data = clearQuotes(array_merge($_GET, $_POST));
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<resultset>
<?
	$sql='SELECT b.*,c.title as driver_ages_title,d.title as driver_standings_title FROM '.PREFIX.'_policies a '.
		 'JOIN '.PREFIX.'_policies_kasko b ON b.policies_id=a.id '.
		 'JOIN '.PREFIX.'_parameters_driver_ages c ON c.id=b.driver_ages_id '.
		 'JOIN '.PREFIX.'_parameters_driver_standings d ON d.id=b.driver_standings_id '.
		 'WHERE a.id='.intval($data['policiesId']);
	$row=$db->getRow($sql);
	if ($row) {
?>
	<row>
		<lastname><?=$row['insurer_lastname']?></lastname>
		<firstname><?=$row['insurer_firstname']?></firstname>
		<patronymicname><?=$row['insurer_patronymicname']?></patronymicname>
		<driver_agesTitle><?=$row['driver_ages_title']?></driver_agesTitle>
		<driver_standingsTitle><?=$row['driver_standings_title']?></driver_standingsTitle>
	</row>
<?
	}
	$sql='SELECT * FROM '.PREFIX.'_policies_kasko_persons WHERE policies_id ='.intval($data['policies_id']);
	$res = $db->query($sql);

	while ($res->fetchInto($row)) {
	print '<row>
		<lastname>'.$row['lastname'].'</lastname>
		<firstname>'.$row['firstname'].'</firstname>
		<patronymicname>'.$row['patronymicname'].'</patronymicname>
		<driver_agesTitle>'.$row['driver_ages_title'].'</driver_agesTitle>
		<driver_standingsTitle>'.$row['driver_standings_title'].'</driver_standingsTitle>
	</row>';
	
	}
?>

</resultset>
