<?

require_once '../include/collector.inc.php';

$year = 2012;

$sql = 'SELECT date_format(policies.date, \'%m.%Y\') as month, COUNT(policies.id) as sales
		FROM insurance_policies as policies 
		JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id AND policies_kasko.financial_institutions_id = 0
		JOIN insurance_agencies as agencies ON policies.agencies_id = agencies.id AND agencies.ukravto = 1
		WHERE date_format(policies.date, \'%Y\') = ' . 2012 . ' AND policies.parent_id = 0 AND policies.product_types_id = 3 AND policies.payment_statuses_id <> 1
		GROUP BY date_format(policies.date, \'%m.%Y\')';
$list = $db->getAll($sql);

$values = array();

foreach ($list as $row) {
	$sql = 'SELECT policies.id
			FROM insurance_policies as policies 
			JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id AND policies_kasko.financial_institutions_id = 0
			JOIN insurance_agencies as agencies ON policies.agencies_id = agencies.id AND agencies.ukravto = 1
			WHERE date_format(policies.date, \'%m.%Y\') = ' . $db->quote($row['month']) . ' AND policies.parent_id = 0 AND policies.product_types_id = 3 AND policies.payment_statuses_id <> 1';
	$policies = $db->getCol($sql);
	
	$sql = 'SELECT COUNT(policies.id) as count_prolongation
			FROM insurance_policies as policies 
			JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id AND policies_kasko.financial_institutions_id = 0
			WHERE policies.parent_id <> 0 AND policies.product_types_id = 3 AND policies.payment_statuses_id <> 1 AND policies.parent_id IN (' . implode(', ', $policies) . ')';
	$values[] = array('month' => $row['month'], 'sales' => $row['sales'], 'prolongation' => $db->getOne($sql));
}
		
header('Content-Disposition: attachment; filename="getRetailStat' . $current_year . '.xls"');
header('Content-Type: ' . Form::getContentType('getRetailStat' . $current_year . '.xls'));
		
?>

<table>
	<tr><td colspan="3"><?=$year?></td></tr>
	<?		
		foreach ($values as $row) {
			echo '<tr>';
			echo '<td>' . $row['month'] . '</td>';
			echo '<td>' . $row['sales'] . '</td>';
			echo '<td>' . $row['prolongation'] . '</td>';
			echo '</tr>';
		}
	?>
</table>