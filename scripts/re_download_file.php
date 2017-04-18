<?

include_once '../include/collector.inc.php';

$buf = file_get_contents('MVI_3202.rar');

$f = fopen('../files/AccidentDocuments/806683001427378625.rar', 'w');
fwrite($f, $buf);
fclose($f);

?>