<style>
.columns TD {
	height: 25px;
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold !important;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background: #008575 url(../images/administration/tabBorder.gif);
}
</style>

<?

require_once '../include/collector.inc.php';

$min_year = 2012;

$current_year = $min_year;

$prolongation = array();

while ($current_year <= date('Y')) {
	$current_year2 = $min_year;	
	while($current_year2 < $current_year) {
		if (!isset($prolongation[$current_year])) $prolongation[$current_year] = array();
		$prolongation[$current_year][] = $current_year2;
		$current_year2++;
	}
	$current_year++;
}
//_dump($prolongation);exit;

$agencies_id = $db->getAll('SELECT id, title FROM insurance_agencies WHERE ukravto = 1');
//_dump($agencies_id);exit;
$current_year = $min_year;
$values = array();
while ($current_year <= date('Y')) {

	foreach ($agencies_id as $agency) {

		$sql = 'SELECT COUNT(policies.id) as count_sales 
				FROM insurance_policies as policies 
				JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id AND policies_kasko.financial_institutions_id = 0
				WHERE date_format(policies.date, \'%Y\') = ' . $db->quote($current_year) . ' AND policies.parent_id = 0 AND policies.product_types_id = 3 AND policies.payment_statuses_id <> 1 AND policies.agencies_id = ' . $agency['id'];
		$list = $db->getAll($sql);	

		foreach ($list as $row) {
			if (!isset ($values[ $agency['id'] ]) ) $values[ $agency['id'] ]['agencies_title'] = $agency['title'];
			$values[ $agency['id'] ]['data'][$current_year]['sales'] = $row['count_sales'];
		}	
		
		foreach ($prolongation[$current_year] as $prolongation_year) {
			$sql = 'SELECT policies.id
					FROM insurance_policies as policies 
					JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id AND policies_kasko.financial_institutions_id = 0
					WHERE date_format(policies.date, \'%Y\') = ' . $db->quote($prolongation_year) . ' AND policies.parent_id = 0 AND policies.product_types_id = 3 AND policies.payment_statuses_id <> 1';
			$policies = $db->getCol($sql);

			$sql = 'SELECT COUNT(policies.id) as count_prolongation
					FROM insurance_policies as policies 
					JOIN insurance_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id AND policies_kasko.financial_institutions_id = 0
					WHERE policies.parent_id <> 0 AND policies.product_types_id = 3 AND policies.payment_statuses_id <> 1 AND policies.top IN (' . implode(', ', $policies) . ') AND date_format(policies.date, \'%Y\') = ' . $db->quote($current_year) . ' AND policies.agencies_id = ' . $agency['id'];
			$list2 = $db->getAll($sql);	
			
			foreach ($list2 as $row) {
				$values[ $agency['id'] ]['data'][$current_year]['prolongation'][$prolongation_year] = $row['count_prolongation'];
			}
			
			$prolongation_year++;
			
		}
	
	}
	$current_year++;
}
//_dump($values);exit;
header('Content-Disposition: attachment; filename="getRetailStat' . $current_year . '.xls"');
header('Content-Type: ' . Form::getContentType('getRetailStat' . $current_year . '.xls'));

?>

<table border="1">

	<tr class="columns">
		<td rowspan="3">Агенція</td>		
		<?
			$year = $min_year;
			while ($year <= date('Y')) {
				echo '<td colspan="' . (sizeof($prolongation[$year])+1) . '">' . $year . '</td>';
				$year++;
			}			
		?>
	</tr>
	<tr class="columns">
		<?
			$year = $min_year;
			while ($year <= date('Y')) {
				echo '<td rowspan="2">Продаж</td>';
				if (sizeof($prolongation[$year])) echo '<td colspan="' . sizeof($prolongation[$year]) . '">Прогонгація</td>';
				$year++;
			}			
		?>
	</tr>
	<tr class="columns">
		<?
			$year = $min_year;
			while ($year <= date('Y')) {
				foreach ($prolongation[$year] as $prolongation_year) echo '<td>' . $prolongation_year . '</td>';				
				$year++;
			}			
		?>
	</tr>
	<?
		foreach ($values as $row) {
			echo '<tr>';
			echo '<td>' . $row['agencies_title'] . '</td>';
			
			$year = $min_year;
			while ($year <= date('Y')) {
				echo '<td>' . intval($row['data'][$year]['sales']) . '</td>';
				foreach ($prolongation[$year] as $prolongation_year) echo '<td>' . intval($row['data'][$year]['prolongation'][$prolongation_year]) . '</td>';
				$year++;
			}	
			echo '</tr>';
		}
	?>
	
</table>