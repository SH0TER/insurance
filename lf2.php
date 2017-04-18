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

				$agdate = $Excel->sheets[0]['cells'][ $i ][2];
				if ($agdate) {
				$agdate = date('Y-m-d',strtotime ( str_replace('/','.',$agdate))-1);
				}


				$reciver = htmlspecialchars ($Excel->sheets[0]['cells'][ $i ][3]);
				$mfo2 = $Excel->sheets[0]['cells'][ $i ][4];
				$zkpo2 = $Excel->sheets[0]['cells'][ $i ][5];

				$rah2 = $Excel->sheets[0]['cells'][ $i ][6];
				$prizn = $Excel->sheets[0]['cells'][ $i ][7];

						$sql='update insurance_agents SET recipient = '.$db->quote($reciver).',mfo='.$db->quote($mfo2).',zkpo='.$db->quote($zkpo2).',bank_account='.$db->quote($rah2).',bank_reference='.$db->quote($prizn).' where agreement_number='.$db->quote($ag_number);
$db->query($sql);
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