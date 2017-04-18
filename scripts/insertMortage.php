<?
require_once '../include/collector.inc.php';
require_once '../include/lib/Classes/PHPExcel/IOFactory.php';

$objPHPExcel = PHPExcel_IOFactory::load('111.xls');
$sheet = $objPHPExcel->setActiveSheetIndex(0);

foreach ($sheet->getRowIterator() as $rownum=>$row) {
   foreach ($row->getCellIterator() as $colnum=>$cell) {
       $val = $cell->getCalculatedValue();
   }
}

for($i = 2; $i<=$rownum; $i++){
    $policies_number[] =  $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
    $mortage_groups_id[] =  intval($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(17, $i)->getValue());
}

for($i=0; $i<sizeof($policies_number); $i++){
$sql = 'SELECT id FROM insurance_policies WHERE number = \'' . $policies_number[$i] . '\'';

$sql = 'SELECT policies.id as policies_id, property_objects.id, ' . $mortage_groups_id[$i] . ' as mortage_groups_id, policies_property.terms_id, policies_property.insurer_person_types_id, policies_property.insurer_lastname, policies_property.insurer_firstname, policies_property.insurer_patronymicname,
        policies_property.insurer_lastname_rod, policies_property.insurer_firstname_rod, policies_property.insurer_patronymicname_rod, policies_property.insurer_dateofbirth, policies_property.insurer_identification_code,
        policies_property.insurer_passport_series, policies_property.insurer_passport_number, policies_property.insurer_passport_place,	policies_property.insurer_passport_date,
        policies_property.insurer_regions_id, policies_property.insurer_area, policies_property.insurer_city, policies_property.insurer_street_types_id, policies_property.insurer_street,
        policies_property.insurer_house, policies_property.insurer_flat, policies_property.financial_institutions_id, policies_property.assured_title, policies_property.assured_identification_code,
        policies_property.assured_address, policies_property.assured_phone,
        property_objects.title as object_title, property_objects.object_location, property_objects.additional, property_objects.created, property_objects.modified, property_objects.ground_appointment,
        property_objects_items.*
        FROM insurance_policies as policies
        JOIN insurance_policies_property as policies_property ON policies.id = policies_property.policies_id
        LEFT JOIN insurance_policies_property_objects as property_objects ON policies.id = property_objects.policies_id
        JOIN insurance_policies_property_objects_items as property_objects_items ON property_objects.id = property_objects_items.objects_id
        WHERE policies.number = \'' . $policies_number[$i] . '\'';
$from_properties[] = $db->getRow($sql);
}
foreach($from_properties as $to_mortage){
    $sql = 'INSERT INTO insurance_policies_mortage (policies_id, deductibles_value, mortage_groups_id, terms_years_id, insurer_person_types_id, insurer_lastname, insurer_firstname, insurer_patronymicname,
            insurer_dateofbirth, insurer_identification_code, insurer_passport_series, insurer_passport_number, insurer_passport_place, insurer_passport_date, insurer_regions_id, insurer_area, insurer_city,
            insurer_street_types_id, insurer_street, insurer_house, insurer_flat, financial_institutions_id, assured_title, assured_identification_code, assured_address, assured_phone, mortage_place)
            VALUES (' . $to_mortage['policies_id'] . ', ' . $to_mortage['value'] . ', ' . $to_mortage['mortage_groups_id'] . ', ' . $to_mortage['terms_id'] . ',
            ' . $to_mortage['insurer_person_types_id'] . ', \'' . $to_mortage['insurer_lastname'] . '\', \'' . $to_mortage['insurer_firstname'] . '\', \'' . $to_mortage['insurer_patronymicname'] . '\',
            \'' . $to_mortage['insurer_dateofbirth'] . '\', \'' . $to_mortage['insurer_identification_code'] . '\', \'' . $to_mortage['insurer_passport_series'] . '\', \'' . $to_mortage['insurer_passport_number'] . '\',
            \'' . $to_mortage['insurer_passport_place'] . '\', \'' . $to_mortage['insurer_passport_date'] . '\', ' . $to_mortage['insurer_regions_id'] . ', \'' . $to_mortage['insurer_area'] . '\',
            \'' . $to_mortage['insurer_city'] . '\', ' . $to_mortage['insurer_street_types_id'] . ', \'' . $to_mortage['insurer_street'] . '\', \'' . $to_mortage['insurer_house'] . '\', \'' . $to_mortage['insurer_flat'] . '\',
            ' . $to_mortage['financial_institutions_id'] . ', \'' . $to_mortage['assured_title'] . '\', \'' . $to_mortage['assured_identification_code'] . '\', \'' . $to_mortage['assured_address'] . '\',
            \'' . $to_mortage['assured_phone'] . '\', \'' . $to_mortage['object_location'] . '\')';
    $db->query($sql);

}

foreach($policies_number as $number){
    $sql = 'UPDATE insurance_policies SET product_types_id = 15 WHERE number = ' . $db->quote($number);
    $db->query($sql);
}


?>