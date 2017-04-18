<?php
/*
 * Title: process event
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassky@gmail.com
 * @version 3.0
 */

require_once 'include/collector.inc.php';

$agreements = array(
'202.14.2245307',
'202.14.2248145',
'202.14.2246357',
'202.14.2244362',
'202.14.2246927',
'202.14.2241920',
'202.14.2245073',
'202.14.2244427',
'202.14.2245654',
'202.14.2244851',
'202.14.2245131',
'202.14.2242438',
'202.14.2246604',
'202.14.2248068',
'202.14.2244816',
'202.14.2245751'
);

$sql =  'SELECT number, sub_number, insurer_lastname, insurer_firstname, insurer_patronymicname,
        CONCAT(
            IF(insurance_regions.id = 26, \'\', CONCAT(insurance_regions.title, \', \')),
            IF(TRIM(insurer_area) = \'\', \'\', CONCAT(insurer_area, \' р-н., \')),
            CONCAT(\' \', insurer_city, \', \'),
            CONCAT(\' \', insurance_street_types.title),
            CONCAT(\' \', insurer_street),
            CONCAT(\' \', insurer_house),
            IF(TRIM(insurer_flat) = \'\', \'\', CONCAT(\' кв. \', insurer_flat))
        ) as address,
        CONCAT(
            CONCAT(\' \', insurance_street_types.title),
            CONCAT(\' \', insurer_street),
            CONCAT(\' \', insurer_house),
            IF(TRIM(insurer_flat) = \'\', \'\', CONCAT(\' кв. \', insurer_flat))
        ) AS street,
        insurer_city
        FROM insurance_policies
        LEFT JOIN insurance_policies_kasko ON insurance_policies.id = insurance_policies_kasko.policies_id
        LEFT JOIN insurance_regions ON insurer_regions_id = insurance_regions.id
        LEFT JOIN insurance_street_types ON insurer_street_types_id = insurance_street_types.id
        WHERE number IN(\'' . implode('\', \'', $agreements) . '\') AND insurance_policies.interrupt_datetime = insurance_policies.end_datetime';
$res = $db->query($sql);

//echo $sql;

echo '<table border="1">';
while ($res->fetchInto($row)) {
    echo '<tr>' .
            '<td>' . $row['number'] . '</td>' .
            '<td>' . $row['insurer_lastname'] . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname'] . '</td>' .
            '<td>' . $row['address'] . '</td>' .
            '<td>' . $row['street'] . '</td>' .
            '<td>' . $row['insurer_city'] . '</td>' .
        '</tr>';
}
echo '</table>';
