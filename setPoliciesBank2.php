<?php

require_once 'include/collector.inc.php';

$sql =  'SELECT b.id, IF(insurer_person_types_id = 2, a.insurer_edrpou, a.insurer_identification_code) AS insurer_identification_code '.
        'FROM insurance_policies_property AS a '.
        'JOIN insurance_policies AS b ON a.policies_id = b.id ' .
        'JOIN insurance_agencies AS c ON b.agencies_id = c.id ' .
//        'WHERE ISNULL(b.is_bank) ' .
        'WHERE b.id = 201416 ' .
        'LIMIT 5000';
echo $sql . '<br />';
$res = $db->query($sql);

while($res->fetchInto($row)) {
    $sql = 'CALL set_policies_is_bank(' . $db->quote( $row['insurer_identification_code'] ) . ', ' . $row['id'] . ')';
    echo $sql . '<br />';
    $db->query($sql);
}

?>


<html>
<head>
	<meta http-equiv="refresh" content="600"/>
</head>
<body>
reloding...
</body>
</html>