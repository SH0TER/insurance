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
        <? if (sizeOf($list)) {?>
        <table width="100%" cellpadding="0" cellspacing="0" border="1">
            <tr class="columns">
                <td>Агенція</td>
                <td>Агент</td>
                <td>Кiлькість полiсiв</td>
                <td>Кiлькість полiсiв > 30 днiв</td>
                <td>Формувати акт</td>
            </tr>
            <?
                foreach ($list as $row) {
                    $i = 1 - $i;
            ?>
            <tr class="<?=Form::getRowClass($row, $i)?>">
                <td><?=$row['agencies_title']?></td>
                <td><?=$row['fio']?></td>
                <td><?=$row['policesCount']?></td>
                <td><?=$row['policesCount1']?></td>
                <td><?=($row['akt']) ? 'так' : 'ні'?></td>
            </tr>
            <? } ?>
        </table>
        <? }?>
    </body>
</html>