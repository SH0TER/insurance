<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Бланки полісів ЦВ</title>
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
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
<tr class="columns">
    <td>Агенція, код</td>
    <td>Агенція, назва</td>
    <td>Чистий, шт.</td>
    <td>Використанний, шт.</td>
    <td>Зіпсований, шт.</td>
    <td>Втраченний, шт.</td>
    <td>Використано у минулому місяці, шт.</td>
</tr>
<?
    $total['clear_quantity'] = 0;
    $total['use_quantity'] = 0;
    $total['spoiled_quantity'] = 0;
    $total['lost_quantity'] = 0;
    $total['used_quantity'] = 0;

	if (sizeOf($list )) {
		foreach ($list as $row) {
			$i = 1 - $i;
?>
<tr>
    <td><?=$row['code']?></td>
    <td><?=$row['title']?></td>
    <td><?=intval($row['clear_quantity'])?></td>
    <td><?=intval($row['use_quantity'])?></td>
    <td><?=intval($row['spoiled_quantity'])?></td>
    <td><?=intval($row['lost_quantity'])?></td>
    <td><?=intval($row['used_quantity'])?></td>
</tr>
<?
            $total['clear_quantity'] += intval($row['clear_quantity']);
            $total['use_quantity'] += intval($row['use_quantity']);
            $total['spoiled_quantity'] += intval($row['spoiled_quantity']);
            $total['lost_quantity'] += intval($row['lost_quantity']);
            $total['used_quantity'] += intval($row['used_quantity']);
		}
	}
?>
<tr class="navigation">
	<td class="paging" colspan="2">&nbsp;</td>
    <td class="paging"><?=$total['clear_quantity']?></td>
    <td class="paging"><?=$total['use_quantity']?></td>
    <td class="paging"><?=$total['spoiled_quantity']?></td>
    <td class="paging"><?=$total['lost_quantity']?></td>
    <td class="paging"><?=$total['used_quantity']?></td>
</tr>
</table>
</body>
</html>