<?php

require_once '../include/collector.inc.php';
require_once '../include/lib/Classes/PHPExcel/IOFactory.php';
   $objPHPExcel = PHPExcel_IOFactory::load('users.xlsx'); // При загрузке файла через форму $_FILES[...]['tmp_name']
   $sheet = $objPHPExcel->setActiveSheetIndex(0); // Выбираем первый лист

   foreach ($sheet->getRowIterator() as $rownum=>$row) {
       foreach ($row->getCellIterator() as $colnum=>$cell) {
           $val = $cell->getCalculatedValue(); // Это значение конкретной ячейки
           // $rownum - номер строки, начиная с 0
           // $row - объект строки
           // $colnum - номер столбца начиная с 1
           // $cell - объект ячейки
       }
   }
   for($i = 1; $i<=$rownum; $i++){
       $class_name[$i] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getValue();
   }

    foreach($class_name as $name){

        $all_text = file_get_contents('../include/modules/Users/' . $name);
        $find1 =  strpos($name, '.');
        $string1=substr($name, 0, $find1);
        $find = strpos($all_text, 'ROLES_AGENT:');
        if($find > 0){
            $string=substr($all_text, $find);
            $find = strpos($string, '(');
            $string=substr($string, $find+1);
            $string=preg_replace('/\s/', '', $string);
            $find = strpos($string, ');');
            $string=substr($string, 0, $find);
            $string=explode(',', $string);


            foreach($string as $str){
                $l[] = array('class_name' =>$string1, 'permissions'=>$str); 
            }
        }
        else{
            $string = 'Немає';
        }
       /* $find1 =  strpos($name, '.');
        $string1=substr($name, 0, $find1);
        $arr_str[] = $string;
        $list[] = array('class_name' =>$string1, 'permissions'=>$string);*/
    }

foreach($l as $r){
    $del = strpos($r['permissions'], 'false');
    if($del > 0){}
        else{
            $a = preg_replace('/\'/', '', $r['permissions']);
            $find = strpos($a, '=>');
            $k[]=array('class_name' =>$r['class_name'], 'permissions'=>substr($a, 0, $find));
        }
}
foreach($k as $n){
    $sql = 'SELECT title FROM ' . PREFIX . '_account_permissions WHERE object = \'Users_' . $n['class_name'] . '\' and method = \'' . $n['permissions'] . '\'';
    $tit = $db->getOne($sql);
    if(!empty($tit)){
        $title[] = $tit;
    }
}

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));
?>


<html>

    <head>
        <title></title>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <meta name=ProgId content=Excel.Sheet>
        <style>
            * {
                font-size: 11px;
                font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
            }
            .columns TD {
                height: 25px;
                color: #FFFFFF;
                padding-left: 4px;
                font-weight: bold;
                border-right: 1px solid #FFFFFF;
                border-top: 1px solid #FFFFFF;
                border-bottom: 1px solid #FFFFFF;
                background-color: #008575;
            }
            td.number {
                mso-number-format:"\@";
            }
        </style>
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border=1>
            <?
                foreach ($title as $row) {
            ?>
            <tr>

                <td align="left"><?=$row?></td>
               
            </tr>
            <? } ?>
        </table>
    </body>
</html>