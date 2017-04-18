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
    <?
    if ($res)
    ?>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <?
                {
                    echo '<table width="100%" cellpadding="0" cellspacing="0">';
                    echo '<tr class="columns" align="center">';
                    foreach($data['outputparameters'] as $parameter)
                    {
                        echo '<td>'.$parameter['title'].'</td>';
                    }

                    echo '</tr>';
                    while($res->fetchInto($row)) {
                        $i = 1 - $i;
                        echo '<tr class="'.Policies::getRowClass($row, $i).'">';
                        foreach($data['outputparameters'] as $parameter)
                        {
                            echo '<td '.$parameter['style'].'>'.$this->printOutputParameter($row[$parameter['alias']],$parameter,$row,true).'</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>