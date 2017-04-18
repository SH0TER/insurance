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
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
	<?=$this->getColumnTitles(true)?>
	<td>Заява на виплату</td>
	<td>Огляд ТЗ</td>
	<td>від кого отримано повідомлення</td>
	<td>Пункт прийому </td>
	<td>Справа</td>
	<td>Марка</td>
	<td>Модель</td>
	<td>Державний номер</td>
 </tr>
<?
	foreach ($list as $row) {
	$i = 1 - $i;
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
	<td class="text"><?=$row['number']?>|</td>
	<td><?=$row['statuses_id']?></td>
	<td><?=$row['applicant']?></td>
	<td><?=$row['datetime_format']?></td>
	<td><?=$row['damage']?></td>
	<td><?=$row['created_format']?></td>
	<td><?=$row['creator']?></td>
	<td><?=$row['modified_format']?></td>
	<td><?=(in_array(154, $documents['product_document_types']) ? '<b>так</b>' : 'ні')?></td>
	<td><?=(intval($row['inspecting_car']) == 1 ? '<b>так</b>' : 'ні')?></td>
	<td><?=(intval($row['owner_types_id']) == 1 ? 'страхувальника' : 'потерпілого')?></td>
	<td><?=$row['car_services_title']?></td>
	<td>
	<?
		echo $db->getOne('select number from insurance_accidents where application_accidents_id='.$row['id']);
	?>
	</td>
	<?
	if ($row['policies_kasko_items_id']>0) {
		$car = $db->getRow('select brand,model,sign from insurance_policies_kasko_items where id='.$row['policies_kasko_items_id']);
		echo '<td>'.$car['brand'].'</td>';
		echo '<td>'.$car['model'].'</td>';
		echo '<td>'.$car['sign'].'</td>';
	}
	else {
		if ($row['owner_types_id'] == 1) {
			$car = $db->getRow('select brand,model,sign from insurance_policies_go where policies_id='.$row['policies_go_id']);
			echo '<td>'.$car['brand'].'</td>';
			echo '<td>'.$car['model'].'</td>';
			echo '<td>'.$car['sign'].'</td>';
		}
		else {
			if (strlen($row['victim_brand'])>2) {
				echo '<td>'.$row['victim_brand'].'</td>';
				echo '<td>'.$row['victim_model'].'</td>';
				echo '<td>'.$row['victim_sign'].'</td>';
			}
			else {
			
				$victim = unserialize (  $row['victim'] );
				echo '<td>'.(isset($victim['car']['data']['brand']) ? $victim['car']['data']['brand'] : '-').'</td>';
				echo '<td>'.(isset($victim['car']['data']['model']) ? $victim['car']['data']['model'] : '-').'</td>';
				echo '<td>'.(isset($victim['car']['data']['sign']) ? $victim['car']['data']['sign'] : '-').'</td>';
			}
			
		}
	}
	?>

</tr>
<? } ?>
</table>
</body>
</html>