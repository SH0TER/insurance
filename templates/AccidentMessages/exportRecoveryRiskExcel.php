<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>КАСКО. Бордеро премій</title>
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
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
    <td>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr class="columns">
                <td>Номер договору</td>
                <td>П.І.Б страхувальника</td>
                <td>Адреса страхувальника</td>
            </tr>
            <?
            foreach ($information as $row){
                $i = 1 - $i;
            ?>
            <tr class="row<?=$i?>">
                <td><?=$row['number']?></td>
                <td><?=$row['owner']?></td>
                <td><?=$row['address']?></td>
            </tr>
            <?}?>
		</table>
    </td>
</tr>
</table>
</body>
</html>