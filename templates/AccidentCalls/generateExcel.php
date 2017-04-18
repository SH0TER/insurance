<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
</head>
<body>
<?
    echo '<table width="500" cellpadding="0" cellspacing="0" border="1">';
    echo '<tr>';
    foreach ($data['outputparamstitle'] as $title)
        echo '<td width="120" style="font-weight: bold; vertical-align: top;">'.$title.'</td>';
    echo '</tr>';
    foreach ($data['writetofile'] as $item){
        echo '<tr>';
        foreach ($item as $value)
            echo '<td width="120" align="left" style="vertical-align: top;">'.$value.'</td>';
        echo '</tr>';
    }
    echo '</table>';

?>
</body>