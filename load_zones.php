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
			for ($i=0; $i<=$Excel->sheets[0]['numRows']; $i++) {
			
				


						$sql='INSERT INTO temp1 (city,zone) '.
							 ' values('.$db->quote($Excel->sheets[0]['cells'][ $i ][1]).','.$db->quote($Excel->sheets[0]['cells'][ $i ][2]).'  )' ;
							  _dump($sql);
							  $db->query($sql);
					
				
			
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