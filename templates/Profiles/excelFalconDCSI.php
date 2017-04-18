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
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
	<td>Survey Code</td>
	<td>Survey Date</td>
	<td>Distributor Code</td>
	<td>Dealer Code</td>
	<td>Interviewer ID</td>
	<td>Respondent ID</td>
	<td>VIN</td>
	<td>Category Code</td>
	<td>Question Code</td>
	<td>Answer</td>
	<td>Verbatim</td>
	<td>Verbatim Translation into English</td>
</tr>
<?
	foreach ($result as $row) {
	    $i = 1 - $i;
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
    <td> <?=$row['service_code']?></td>
	<td> <?=$row['date']?></td>
	<td> <?=$row['distributor_code']?></td>
	<td> <?=$row['diler_code']?></td>
	<td> <?=$row['user_code']?></td>
	<td> <?=$row['respondent_code']?></td>
	<td> <?=$row['shassi']?></td>
	<td> <?=$row['category_code']?></td>
	<td> <?=$row['question_code']?></td>
	<td> <?=$row['answer_code']?></td>
	<td> <?=$row['answer_uk']?></td>
	<td> <?=$row['answer_en']?></td>
</tr>
<? } ?>
</table>
</body>
</html>