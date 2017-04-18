<?php

require_once 'include/collector.inc.php';

function getPolicy($identification_code) {
    global $db;

    $sql =
        'SELECT id, number, product_types_id, title, is_bank, created
        FROM (
            SELECT a1.id, a1.number, a1.product_types_id, a4.title, a4.is_bank, a1.created
            FROM insurance_policies AS a1
            JOIN insurance_policies_kasko AS a2 ON a1.id = a2.policies_id
            JOIN insurance_agencies AS a3 ON a1.agencies_id = a3.id
              JOIN insurance_agencies AS a4 ON a3.top = a4.id
            WHERE a2.insurer_identification_code = ' . $db->quote($identification_code) . ' OR a2.insurer_edrpou = ' . $db->quote($identification_code) . '
            UNION
              /*??*/
            SELECT b1.id, b1.number, b1.product_types_id, b4.title, b4.is_bank, b1.created
            FROM insurance_policies AS b1
            JOIN insurance_policies_go AS b2 ON b1.id = b2.policies_id
            JOIN insurance_agencies AS b3 ON b1.agencies_id = b3.id
              JOIN insurance_agencies AS b4 ON b3.top = b4.id
            WHERE b2.insurer_identification_code = ' . $db->quote($identification_code) . ' OR b2.insurer_edrpou = ' . $db->quote($identification_code) . '
            UNION
              /*???*/
            SELECT c1.id, c1.number, c1.product_types_id, c4.title, c4.is_bank, c1.created
            FROM insurance_policies AS c1
            JOIN insurance_policies_dgo AS c2 ON c1.id = c2.policies_id
            JOIN insurance_agencies AS c3 ON c1.agencies_id = c3.id
              JOIN insurance_agencies AS c4 ON c3.top = c4.id
            WHERE c2.insurer_identification_code = ' . $db->quote($identification_code) . ' OR c2.insurer_edrpou = ' . $db->quote($identification_code) . '
            UNION
              /*???????*/
            SELECT d1.id, d1.number, d1.product_types_id, d4.title, d4.is_bank, d1.created
            FROM insurance_policies AS d1
            JOIN insurance_policies_mortage AS d2 ON d1.id = d2.policies_id
            JOIN insurance_agencies AS d3 ON d1.agencies_id = d3.id
              JOIN insurance_agencies AS d4 ON d3.top = d4.id
            WHERE d2.insurer_identification_code = ' . $db->quote($identification_code) . ' OR d2.insurer_edrpou = ' . $db->quote($identification_code) . '
            UNION
              /*?????*/
            SELECT e1.id, e1.number, e1.product_types_id, e4.title, e4.is_bank, e1.created
            FROM insurance_policies AS e1
            JOIN insurance_policies_property AS e2 ON e1.id = e2.policies_id
            JOIN insurance_agencies AS e3 ON e1.agencies_id = e3.id
              JOIN insurance_agencies AS e4 ON e3.top = e4.id
            WHERE e2.insurer_identification_code = ' . $db->quote($identification_code) . ' OR e2.insurer_edrpou = ' . $db->quote($identification_code) . '
            UNION
              /*?????*/
            SELECT f1.id, f1.number, f1.product_types_id, f4.title, f4.is_bank, f1.created
            FROM insurance_policies AS f1
            JOIN insurance_policies_ns AS f2 ON f1.id = f2.policies_id
            JOIN insurance_agencies AS f3 ON f1.agencies_id = f3.id
              JOIN insurance_agencies AS f4 ON f3.top = f4.id
            WHERE f2.insurer_identification_code = ' . $db->quote($identification_code) . '
         ) AS a
         ORDER BY created
         LIMIT 1';

    return $db->getRow($sql);
}
?>

<html>
<head>
    <title>Перевірка наявності договору за кодом ІПН/ЄДРПОУ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>">
        ІПН/ЄДРПОУ: <input type="text" name="identification_code" value="<? echo $data['identification_code']?>" />
        <input type="submit" value="Знайти договір" />
    </form>
<?
    if (isset($data['identification_code'])) {
        $policy = getPolicy( $data['identification_code'] );
        echo '<table border="1"><tr><td><a href="/index.php?do=Policies|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'] . '">' . $policy['number'] . '<td>' . $policy['title'] . '</td><td>' . $policy['created'] . '</td></tr></table>';
    }
?>
</body>
</html>