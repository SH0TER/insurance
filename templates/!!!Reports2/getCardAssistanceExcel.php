<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
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
    <table width="600" cellpadding="0" cellspacing="0">
        <tr class="columns">
            <!--td rowspan="2" align="center">Код</td-->
            <td rowspan="2" align="center">Агенція</td>
            <? foreach($periods as $period){ ?>
                <td colspan="2" align="center"><?=$period[0]?> - <?=$period[1]?></td>
            <? } ?>
        </tr>
        <tr class="columns">
            <? foreach($periods as $period){ ?>
                <td align="center">Видано</td>
                <td align="center">Залишок</td>
            <? } ?>
        </tr>
        <? foreach($list as $row) { ?>
            <tr>
                <!--td align="left"><?=$row['code']?></td-->
                <td align="left"><?=$row['title']?></td>
                <?
                    $part = 1;
                    foreach($periods as $period) {
                ?>
                        <td align="center"><?=intval($row['data'][$part]['count_issued'])?></td>
                        <td align="center"><?=intval($row['data'][$part]['count_not_issued'])?></td>
                <?
                    $part++;
                    }
                ?>
            </tr>
        <? } ?>
    </table>
</body>
</html>