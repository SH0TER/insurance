<?

require_once '../include/collector.inc.php';

$agencies = $db->getAll('SELECT *
                        FROM `insurance_agencies`
                        WHERE `code` LIKE \'556.%\'');
foreach($agencies as $agency){
    $code = explode('.', $agency['code']);
    if(sizeof($code) == 1) $code[1] = 0;
    $db->query('UPDATE insurance_agencies
                 SET top = ' . $code[0] . ',
                     num_l = ' . $code[1] . ',
                     level = 2,
                     parent_id = ' . $code[0] .'
                 WHERE id = ' . $agency['id']);
}

?>