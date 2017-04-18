<html>
<head>
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
    border-right: 1px solid #4F5D75;
    border-top: 1px solid #4F5D75;
    border-bottom: 1px solid #4F5D75;
    background-color: #008575;
}
.grey {
    background-color: #CCCCCC;
}
</style>
</head>
<body>
<? if (is_array($list)) {?>
<?
$dates = array();
$rows = array();
foreach ($list as $row) {
    $dates[$row['date']] = 1;
    $rows[$row['agencies_title'].$row['agents_title'].$row['personType']] = array('agencies_title'=>$row['agencies_title'],'agents_title'=>$row['agents_title'],'personType'=>$row['personType']);
}

?>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr class="columns">
        <td>Агенція</td>
        <td>Агент</td>
        <td>Тип агента</td>
        <?
        foreach($dates as $k=>$v) {
            echo '<td>Cплачено '.$k.'</td>';
        }
        ?>
         
    </tr>
    <?
        $i = 0;
        $amount = 0;
        foreach ($rows as $k=>$reprow) {
            $i = 1 - $i;
    ?>
        <tr>
            <td><?=$reprow['agencies_title']?></td>
            <td><?=$reprow['agents_title']?></td>
            <td><?=$reprow['personType']?></td>
            <?
                foreach($dates as $k1=>$v) {
                    $f=0;
                    foreach ($list as $row) {
                        if ($row['agencies_title']==$reprow['agencies_title'] && $row['agents_title']==$reprow['agents_title'] &&  $row['personType']==$reprow['personType']  && $row['date']==$k1)
                        {
                            echo '<td>'.str_replace('.', ',', $row['all_amount1']).'</td>';
                            $f=1;
                            break;
                        }
                    }
                    if (!$f)echo '<td>0,00</td>';
                }
            ?>
        </tr>
    <?
        }
    ?>
     
</table>
<? } ?>
</body>
</html>