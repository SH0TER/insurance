<?php
/*$a=(0.1+0.7)*10;
echo intval($a);
exit;
echo urlencode('https://scontent.xx.fbcdn.net/hprofile-xfa1/v/t1.0-1/c13.0.50.50/p50x50/28250_127791530585996_7588219_n.jpg?oh=02b1e8be9848a1049ef0a54ede0ef18e&oe=5727DD84');
exit;
include_once 'include/collector.inc.php';

$sql =  'SELECT c.id, a.performers_id ' .
        'FROM ' . PREFIX . '_tasks AS a ' .
        'LEFT JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
        'LEFT JOIN ' . PREFIX . '_clients AS c ON b.clients_id = c.id ' .
        'WHERE task_types_id IN (3, 4, 8, 9) AND performers_id IN (13685, 13212, 13076, 13534, 13155, 12494, 13862) ' .
        'ORDER BY a.id ASC';
$res = $db->query($sql);

while ($res->fetchInto($row)) {
    $sql = 'UPDATE insurance_clients SET agents_id = ' . intval($row['performers_id']) . ' WHERE id = ' . intval($row['id']);
    echo $sql . '<br />';
    $db->query($sql);
}*/

?>

<form name="Akts" action="/index.php" method="post" _lpchecked="1">
    <input type="hidden" name="do" value="Akts|generateMasterAkt">
	<input type="hidden" name="id" value="55586">
	<input type="submit" name="">
</form>