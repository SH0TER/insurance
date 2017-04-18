<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<title>Договори ДМС</title>
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
			border-right: 1px solid #FFFFFF;
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #FFFFFF;
			background-color: #008575;
		}
	</style>
</head>
<body>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<tr class="columns">
			<td>Дата надання послуги</td>
			<td>ПІБ застрахованої особи</td>
			<td>ПІБ страхувальника</td>
			<td>№ договору</td>
			<td>Програма страхування</td>
			<td>Діагноз</td>
			<td>Номер відділення</td>
			<td>Перелік наданих послуг</td>
			<td>Вартість наданих послуг</td>
			<td>Назва СК</td>
			<td>Страховий платіж, грн</td>
			<td>Дата сплати</td>
			<td>Сплачено, грн</td>
			<td>Статус договору</td>
		</tr>
		<?
			foreach ($list as $row) {
				echo '<tr>';
				echo '<td>' . $row['policies_date'] . '</td>';
				echo '<td>' . $row['insured'] . '</td>';
				echo '<td>' . $row['insurer'] . '</td>';
				echo '<td>' . $row['policies_number'] . '</td>';
				echo '<td>' . (($row['types_id']==3 || $row['types_id']==4) ? 'КОНСУЛЬТАТИВНО-ДІАГНОСТИЧНА ДОПОМОГА' : 'Стаціонар') . '</td>';
				echo '<td>' . $row['diagnosis'] . '</td>';
				echo '<td>&nbsp;</td>';
				echo '<td>' . $types_id[ $row['types_id'] ] .  '</td>';
				echo '<td>&nbsp;</td>';
				echo '<td>' . $insurance_companies_id[ $row['insurance_companies_id'] ] .  '</td>';
				echo '<td>' . $row['amount'] .  '</td>';
				echo '<td>' . $row['payment_date'] .  '</td>';
				echo '<td>' . $row['payed_amount'] .  '</td>';
				echo '<td>' . $row['statuses_title'] .  '</td>';
				echo '</tr>';
				$amount_rough = $amount_rough + $row['amount_rough'];

				if($row['amount'] != '' ){
					$amounts_str = explode('<br>', $row['amount']);
					for($i=0; $i<sizeof($amounts_str); $i++){
					   $amount += str_replace(',', '.', $amounts_str[$i]);
					}
				}
			}
		?>
	</table>
</body>
</html>