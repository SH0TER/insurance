<?

require_once '../include/collector.inc.php';

$sql = 'select id, number
        from insurance_application_accidents
        where id > 0';
$application_accidents = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

echo '<table border="1">';

foreach($application_accidents as $application_accident) {
    ?> <tr><td colspan="2" style='mso-number-format:"\@";'><?=$application_accident['number']?></td></tr>

<?
    $sql = 'select number
            from insurance_accidents
            where application_accidents_id = ' . intval($application_accident['id']);
    echo '<tr><td colspan="2">' . implode(', ', $db->getCol($sql)) . '</td></tr>';

    $sql = 'select b.title, a.created
            from insurance_accident_documents a
            join insurance_product_document_types b on a.product_document_types_id = b.id
            where a.application_accidents_id = ' . intval($application_accident['id']);
    $documents = $db->getAll($sql);

    foreach($documents as $document) {
        echo '<tr><td>' . $document['title'] . '</td><td>' . date('d.m.Y H:s', strtotime($document['created'])) . '</td></tr>';
    }

    echo '<tr></tr>';
}

echo '</table>';

?>