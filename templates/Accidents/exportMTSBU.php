<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Звіт МТСБУ по полісам ЦВ</title>
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
        <?

            echo '<tr class="columns">';
            foreach ($fields as $name) {
                echo '<td>' . $name . '</td>';
            }
            echo '</tr>';

            foreach ($list as $i => $row) {
                echo '<tr>';
                foreach ($fields as $name) {
                    //if($name == 'accidents_number' || $name == 'insurer_car')
                        echo '<td x:str>' . $row[ $name ] . '</td>';
                    //else
                        //echo '<td x:str>' . $row[ $name ] . '</td>';
                }
            }

            echo '</tr>';
        ?>
		</table>
    </td>
</tr>
</table>
</body>
</html>
