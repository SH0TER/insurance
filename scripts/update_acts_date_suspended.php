<?

include '../include/collector.inc.php';

$sql = 'select accidents.id
		from insurance_accidents as accidents
		join insurance_accident_status_changes as changes on accidents.id = changes.accidents_id and changes.accident_statuses_id = 10
		join insurance_accidents_acts as acts on accidents.id = acts.accidents_id and acts.amount = 0
		where accidents.product_types_id = 3
		group by accidents.id';
$list = $db->getCol($sql);

foreach ($list as $id) {
	$sql = 'select created from insurance_accident_status_changes where accidents_id = ' . intval($id) . ' AND accident_statuses_id = 10 order by created';
	$changes = $db->getCol($sql);
	//if($id == 3470) {_dump($changes);}
	
	$sql = 'select id from insurance_accidents_acts where amount = 0 and accidents_id = ' . intval($id);
	$acts = $db->getCol($sql);
	//if($id == 3470) {_dump($acts);}
	
	foreach ($acts as $key => $val) {
		if ($changes[$key]) {
			$sql = 'update insurance_accidents_acts set date = ' . $db->quote($changes[$key]) . ' WHERE id = ' . intval($val);
			$db->query($sql);
			_dump($sql);
		}
	}
}

?>