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
	<?=$this->getColumnTitles(true)?>
    <td>Коментар</td>
	<td>Коментар ФИО</td>
	<td>Банк</td>
</tr>
<?
	foreach ($list as $row) {
	$i = 1 - $i;
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
	<?=$this->getRowValuesExcel($data, $row, $hidden, $total)?>
    <td><?=$row['policy_comment']?></td>
	<td><?=$row['comment_user']?></td>
	<td>
	<?
	foreach ($financial_institutions as $fin) {
		if ($fin['id']==$row['financial_institutions_id']) echo $fin['title'];
	}
	?>
	</td>
</tr>
<? } ?>
</table>
</body>
</html>