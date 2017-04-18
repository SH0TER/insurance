<?

require_once '../include/collector.inc.php';

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