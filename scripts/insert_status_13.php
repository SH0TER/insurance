<?

require_once '../include/collector.inc.php';

/*$sql = 'SELECT accidents_id
		FROM insurance_accident_status_changes
		WHERE accident_statuses_id = 14
		GROUP BY accidents_id';
$list = $db->getCol($sql);*/

$sql = 'SELECT id
		FROM insurance_accidents
		WHERE accident_statuses_id = 13';
$list = $db->getCol($sql);

foreach ($list as $el) {
	$sql = 'select authors_id, authors_title, created from insurance_accident_documents where product_document_types_id = 109 and accidents_id = ' . intval($el);
	$i = $db->getRow($sql);
	
	if (is_array($i) && sizeof($i)) {
		$sql =	'INSERT INTO ' . PREFIX . '_accident_status_changes SET ' .
					'accidents_id = ' . intval($el) . ', ' .
					'accident_statuses_id = ' . intval(13) . ', ' .
					'accounts_id = ' . intval($i['authors_id']) . ', ' .
					'accounts_title = ' . $db->quote($i['authors_title']) . ', ' .
					'created = ' . $db->quote($i['created']);
		$db->query($sql);
	}
}

$db->query('UPDATE insurance_accident_status_changes SET duration = 0');
$sql = 'SELECT *
        FROM insurance_accident_status_changes
        WHERE accident_statuses_id <> -1
        ORDER BY accidents_id, created ASC';
$res = $db->getAll($sql);
$cur_accident_id = 0;
$cur_created = '0000-00-00';
foreach($res as $row){
    if ($cur_accident_id != $row['accidents_id']){
        $cur_accident_id = $row['accidents_id'];
        $cur_created = $row['created'];
    }else{
        $duration = strtotime($row['created'])-strtotime($cur_created);
        if ($duration > 0){
            $sql_update = 'UPDATE insurance_accident_status_changes SET duration = ' . $duration . ' WHERE created = \'' . $cur_created . '\' AND accidents_id = ' . $cur_accident_id;
            $db->query($sql_update);
        }
        $cur_created = $row['created'];
    }
}

?>