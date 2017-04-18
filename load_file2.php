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
			for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
			
				
				$ag_number = $Excel->sheets[0]['cells'][ $i ][1];
				$bank_number = $Excel->sheets[0]['cells'][ $i ][2];
				$mfo2 = $Excel->sheets[0]['cells'][ $i ][3];
				$zkpo2 = $Excel->sheets[0]['cells'][ $i ][4];
				$rah2 = $Excel->sheets[0]['cells'][ $i ][5];
				$cardnum = $Excel->sheets[0]['cells'][ $i ][6];
				$carddate = $Excel->sheets[0]['cells'][ $i ][7];
				if ($carddate) {
				$carddate = date('Y-m-d',strtotime ( str_replace('/','.',$carddate))-1);
				}

						$sql='update insurance_agents SET bank_name = '.$db->quote($bank_number).',mfo2='.$db->quote($mfo2).',zkpo2='.$db->quote($zkpo2).',bank_account2='.$db->quote($rah2).',skr='.$db->quote($cardnum).',cart_date='.$db->quote($carddate).' where agreement_number='.$db->quote($ag_number);
						echo $sql.';<br>';
			
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