<?

require_once '../include/collector.inc.php';

$sql = 'UPDATE aaa SET p = NULL';
$db->query($sql);

$sql = '
SELECT * 
FROM aaa AS a1
JOIN (

SELECT MAX( DATE ) AS date1, clients_id
FROM aaa
GROUP BY clients_id
) AS a2 ON a1.clients_id = a2.clients_id
AND a1.date = a2.date1 WHERE p IS NULL and performers_id IN(13685, 13212, 13076, 13534, 13155, 12494)';

$res = $db->query($sql);

while($res->fetchInto($row)) {

	$sql = 'UPDATE insurance_clients SET agents_id = ' . $row['performers_id'] . ' WHERE id = ' . intval($row['clients_id']);
	$db->query($sql);
	echo $sql . '<br >';

	$sql = 'UPDATE aaa SET p = 1 WHERE clients_id = ' . intval($row['clients_id']);
	$db->query($sql);
	echo $sql . '<br ><br >';
}

?>