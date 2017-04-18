<?

require_once '../include/collector.inc.php';

$sql = 'select vid_nomenklaturi, model
        from axapta
        group by vid_nomenklaturi, model';
$objects = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table border="1">';
echo '<tr>';
echo '<td rowspan="2">Всього</td>';
echo '<td rowspan="2">Марка</td>';
echo '<td rowspan="2">Модель</td>';
echo '<td rowspan="2">Рік</td>';
echo '<td colspan="2">Були</td>';
echo '<td colspan="2">Є</td>';
echo '</tr>';

echo '<tr>';
echo '<td>КАСКО</td>';
echo '<td>ЦВ</td>';
echo '<td>КАСКО</td>';
echo '<td>ЦВ</td>';
echo '</tr>';

$year = 2009;
$lim_year = 2015;
while ($year < $lim_year) {

    $values = array();

    foreach($objects as $object) {

        $sql = 'select count(*) as count, sum(kasko) as kasko, sum(go) as go, sum(kasko_cur) as kasko_cur, sum(go_cur) as go_cur
                from axapta
                where person_types_id = 1 and vid_nomenklaturi = ' . $db->quote($object['vid_nomenklaturi']) . ' and model = ' . $db->quote($object['model']) . ' and locate(' . $db->quote($year) . ', data_documenta) > 0';
        $info = $db->getRow($sql);//_dump($sql);exit;

        if ($info) {

            echo '<tr>';

            echo '<td>' . intval($info['count']) . '</td>';
            echo '<td>' . $object['vid_nomenklaturi'] . '</td>';
            echo '<td>' . $object['model'] . '</td>';
            echo '<td>' . $year . '</td>';
            echo '<td>' . intval($info['kasko']) . '</td>';
            echo '<td>' . intval($info['go']) . '</td>';
            echo '<td>' . intval($info['kasko_cur']) . '</td>';
            echo '<td>' . intval($info['go_cur']) . '</td>';

            echo '</tr>';

        }

    }

    $year++;
}

echo '</table>';

?>