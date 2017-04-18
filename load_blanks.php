<?php
/*
 * Title: process event
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 1.0
 */
//mb_internal_encoding("UTF-8");
require_once 'include/collector.inc.php';
require_once 'include/lib/Excel/reader.php';
//setlocale(LC_ALL, 'uk_UA.UTF-8');
//mb_internal_encoding("UTF-8");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$Excel = new Spreadsheet_Excel_Reader();
			$Excel->setOutputEncoding(CHARSET);
			$Excel->read($_FILES['report']['tmp_name']);
			for ($i=1; $i<=$Excel->sheets[0]['numRows']; $i++) {
			
				
				$series = $Excel->sheets[0]['cells'][ $i ][1];
				$number = $Excel->sheets[0]['cells'][ $i ][2];

						$sql='insert into  temp_tab(series,number) values('.$db->quote($series).','.$db->quote($number).')' ;
						$db->query($sql);
						echo $sql.'<br>';
			
			}
		
		echo 'Done';
	exit;
	}
?>

<html>
<head>
	<title>File processing...</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<table cellpadding="5" cellspacing="5">
<tr>
	<td>*Реестр:</td>
	<td><input type="file" name="report" /></td>
<tr>
				
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Обработать" />
</tr>
</table>
</form>

<br>
<br>

</body>
</html>