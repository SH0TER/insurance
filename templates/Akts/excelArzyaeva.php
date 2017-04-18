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
.text{
    mso-number-format:"\@";/*force text*/
}
</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
    <td colspan="4">Акти</td>
    <td colspan="5">Поліса до сплати</td>
</tr>
<tr class="columns">
    <td>Номер</td>
    <td>Дата</td>
    <td>Агент</td>
    <td>Оплата</td>

    <td>№ Справи</td>
    <td>Номер</td>
    <td>Страхувальник</td>
    <td>Перелік документів (Заява/огляд)</td>
    <td>Сума винагороди</td>
</tr>
<?
    foreach ($list as $row) {
?>
<tr>
    <td class="text"><?=$row['akt_number']?></td>
    <td><?=$row['akt_date']?></td>
    <td><?=$row['akt_agent_name']?></td>
    <td><?=$row['akt_status']?></td>

    <td class="text"><?=$row['acc_number']?></td>
    <td class="text"><?=$row['number']?></td>
    <td><?=htmlspecialchars_decode($row['insurer'])?></td>
    <td><?
        if($row['comission_master'] > 0)
            echo '(+)/';
        else
            echo '(-)/';

        if($row['comission_investigation'] > 0)
            echo '(+)';
        else
            echo '(-)';
    ?></td>
    <td><?=$row['commission_amount_white']?></td>
</tr>
<? } ?>
</table>
</body>
</html>