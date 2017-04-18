<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Послуги повірених</title>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
	<style>
		* {
			font-size: 11px;
			font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
		}
		.columns TD {
            width: 300px;
			height: 25px;
			color: #FFFFFF;
			padding-left: 4px;
			font-weight: bold;
			border-right: 1px solid #FFFFFF;
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #FFFFFF;
			background-color: #008575;
		}
        tr.columns {
            height: 50px;
        }
        td.row {
            width: 100px;
        }
        td.neither_big_no_small {
            width: 200px;
        }
        td.big_row{
           width: 450px;
        }
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
            <tr class="columns">
                <td>Повірений</td>
				<td>СТО</td>
				<td>К-сть прийнятих заяв</td>
				<td>К-сть оглянутих ТЗ</td>
				<td>Сума</td>
            </tr>
            <?
                foreach($list as $row) {
                    echo '<tr>';
                        echo '<td>' . $row['master_name'] . '</td>';
						echo '<td>' . $row['car_services_title'] . '</td>';
						echo '<td>' . $row['count_application'] . '</td>';
						echo '<td>' . $row['count_inspection'] . '</td>';
						echo '<td>' . $row['total_amount'] . '</td>';
                    echo '</tr>';
                }
            ?>
    <!--tr class="navigation">
        <td class="paging">Всього: <?=(sizeof($list))?></td>
    </tr-->
</table>
</body>
</html>