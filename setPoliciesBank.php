<?php

require_once 'include/collector.inc.php';

function isBank($agencies_id) {
    $banks = array('1254', '236', '245', '417', '421', '422', '423', '557', '561', '562', '563', '832', '845', '846', '847');

    return (in_array($agencies_id, $banks)) ? true : false;
}

function getAgenciesId($identification_code) {
    global $db;

    $sql =  'SELECT top ' .
            'FROM (' .
                'SELECT a3.top, a1.created ' .//каско
                'FROM insurance_policies AS a1 ' .
                'JOIN insurance_policies_kasko AS a2 ON a1.id = a2.policies_id ' .
                'JOIN insurance_agencies AS a3 ON a1.agencies_id = a3.id ' .
                'WHERE a2.insurer_identification_code = ' . $db->quote($identification_code) . ' ' .
                'UNION ' .//ГО
                'SELECT b3.top, b1.created ' .
                'FROM insurance_policies AS b1 ' .
                'JOIN insurance_policies_go AS b2 ON b1.id = b2.policies_id ' .
                'JOIN insurance_agencies AS b3 ON b1.agencies_id = b3.id ' .
                'WHERE b2.insurer_identification_code = ' . $db->quote($identification_code) . ' ' .
                'UNION ' .//ДГО
                'SELECT c3.top, c1.created ' .
                'FROM insurance_policies AS c1 ' .
                'JOIN insurance_policies_dgo AS c2 ON c1.id = c2.policies_id ' .
                'JOIN insurance_agencies AS c3 ON c1.agencies_id = c3.id ' .
                'WHERE c2.insurer_identification_code = ' . $db->quote($identification_code) . ' ' .
                'UNION ' .//Ипотека
                'SELECT d3.top, d1.created ' .
                'FROM insurance_policies AS d1 ' .
                'JOIN insurance_policies_mortage AS d2 ON d1.id = d2.policies_id ' .
                'JOIN insurance_agencies AS d3 ON d1.agencies_id = d3.id ' .
                'WHERE d2.insurer_identification_code = ' . $db->quote($identification_code) . ' ' .
                'UNION ' .//Майно
                'SELECT e3.top, e1.created ' .
                'FROM insurance_policies AS e1 ' .
                'JOIN insurance_policies_property AS e2 ON e1.id = e2.policies_id ' .
                'JOIN insurance_agencies AS e3 ON e1.agencies_id = e3.id ' .
                'WHERE e2.insurer_identification_code = ' . $db->quote($identification_code) . ') as a ' .
            'ORDER BY created ASC '.
            'LIMIT 1';
    return $db->getOne($sql);
}

$tables = array('insurance_policies_kasko', 'insurance_policies_go', 'insurance_policies_dgo', 'insurance_policies_property');

$sql =  'SELECT b.id, a.insurer_identification_code '.
        'FROM insurance_policies_kasko AS a '.
        'JOIN insurance_policies AS b ON a.policies_id = b.id ' .
        'WHERE ISNULL(bank) ' .
        'LIMIT 1000';
$res = $db->query($sql);

while($res->fetchInto($row)) {
    $agencies_id = getAgenciesId( $row['insurer_identification_code'] );

    $bank = 0;
    if (isBank($agencies_id)) {
        var_dump($agencies_id);
        exit;
        $bank = 1;
    }

    $sql = 'UPDATE insurance_policies SET bank = ' . intval($bank) . ' WHERE id = ' . intval($row['id']);
    $db->query($sql);
}

?>


<html>
<head>
	<meta http-equi111v="refresh111" content="120"/>
</head>
<body>
reloding...
</body>
</html>