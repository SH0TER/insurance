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
	<td>Номер справи</td>
	<td>СТО</td>
    <td>Марка</td>
	<td>Модель</td>
	<td>Державний номер</td>
	<td>Категорія справи</td>
	<td>Клас ремонту</td>
	<td>Кількість днів на ремонт</td>
	<td>Клас постави ЗЧ</td>
	<td>ЗЧ (так/ні)</td>
	<td>Кількість днів на поставку ЗЧ</td>
	<td>Дата запиту рахунку СТО</td>
	<td>Дата отримання рахунку СТО</td>
	<td>Дата закриття задачі</td>
	<td>Рахунок-фактура</td>
	<td>Дата рахунок-фактура</td>
	<td>Сума</td>
	<td>Дата заяви</td>
	<td>Дата оплати</td>
	<td>Дата документа</td>
    <td>Дата початку ВР</td>
	<td>Сума оплати</td>
	<td>Плановий строк обслуговування</td>
	<td>Строк обслуговування</td>
	<td>Дата замовлення ЗЧ</td>
	<td>Орієнтовна дата отримання ЗЧ</td>
	<td>Фактична дата отримання ЗЧ</td>
	<td>Дата запрошення</td>
	<td>Планова дата заїзду</td>
	<td>ТЗ на території СТО</td>
	<td>Дата відкриття няряд-замовлення</td>
	<td>Номер АВР</td>
	<td>Дата відкриття АВР</td>
	<td>Дата закриття АВР</td>
	<td>Сума АВР</td>
    <td>Ремонт, початок</td>
    <td>Ремонт, закінчення</td>
    <td>Перевірено</td>
	<td>Статус</td>
	<? if (intval($data['showMonitoring'])) { ?>
	<td>Моніторинг</td>	
	<? } ?>
</tr>

<? foreach ($list as $row) { 
		
		$rowspan = 1;

        $sql = 'SELECT checked FROM insurance_executed_work_acts WHERE recovery_repairs_id = ' . intval($row['id']);
        $row['avrChecked'] = $db->getOne($sql);

		$sql = 'SELECT number, date_format(begin_date, \'%d.%m.%Y\') as begin_date, if(end_date = \'0000-00-00\', \'00.00.0000\', date_format(end_date, \'%d.%m.%Y\')) as end_date, amount ' .
			   'FROM ' . PREFIX . '_executed_work_acts WHERE recovery_repairs_id = ' . intval($row['id']) . ' ORDER BY end_date';
		$avrList = $db->getAll($sql);
		if (is_array($avrList) && sizeOf($avrList)) $rowspan = sizeOf($avrList);
		
		if (intval($data['showMonitoring'])) {
		
			$sql = 'SELECT * FROM ' . PREFIX . '_recovery_repairs_monitoring WHERE recovery_repairs_id = ' . intval($row['id']) . ' ORDER BY created';
			$monitoringList = $db->getAll($sql);
			
			$monitoringHTML = '<table cellspacing="20" cellpading="25" style="border-collapse: collapse;">';
			
			foreach($monitoringList as $monitoringRow) {
				$monitoringHTML .= '<tr style="border-bottom: 1px solid black;">';
				$monitoringHTML .= '<td>' . $monitoringRow['created'] . '</td>';
				$monitoringHTML .= '<td>' . $monitoringRow['account'] . '</td>';
				$monitoringHTML .= '<td>' . $monitoringRow['text'] . '</td>';
				$monitoringHTML .= '</tr>';
			}
			
			$monitoringHTML .= '</table>';
			
		}
		
		$sql = 'SELECT answer FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($row['accident_messages_id']);
		$answerMessage = unserialize($db->getOne($sql));
		
		$row['repair_parts'] = (($answerMessage['amount_details'] > 0) ? 'так' : 'ні');
		
		$sql = 'SELECT decision FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($row['accident_messages_id']);
		$decision = $db->getOne($sql);
		
		$sql = 'SELECT  a.modified FROM  insurance_accidents aa JOIN insurance_application_accidents bb ON bb.id=aa.application_accidents_id JOIN insurance_accident_documents a ON a.application_accidents_id=aa.application_accidents_id WHERE product_document_types_id =149  AND aa.id= ' . intval($row['accidents_id']);
		$modified_date = $db->getOne($sql);
		
?>
	<tr align="left">
		<td rowspan="<?=$rowspan?>"><?=$row['accidents_number']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['car_services_id']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['brand']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['model']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['sign']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['section_title']?></td>
		<td rowspan="<?=$rowspan?>"><?=$answerMessage['repair_classifications_id']?></td>
		<td rowspan="<?=$rowspan?>"><?=$answerMessage['repair_days']?></td>
		<td rowspan="<?=$rowspan?>"><?=$answerMessage['parts_classifications_id']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['repair_parts']?></td>
		<td rowspan="<?=$rowspan?>"><?=$answerMessage['parts_days']?></td>
		
		<td rowspan="<?=$rowspan?>"><?=date('d.m.Y', strtotime($answerMessage['account_request_date']))?></td>
		<td rowspan="<?=$rowspan?>"><?=date('d.m.Y', strtotime($answerMessage['account_answer_date']))?></td>
		<td rowspan="<?=$rowspan?>"><?=date('d.m.Y', strtotime($decision))?></td>
		
		<td rowspan="<?=$rowspan?>"><?=($answerMessage['payment_document_title'] . ' ' . $answerMessage['payment_document_number'])?></td>
		<td rowspan="<?=$rowspan?>"><?=$answerMessage['payment_document_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=floatval($answerMessage['amount_details'] + $answerMessage['amount_material'] + $answerMessage['amount_work'])?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['accidents_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['payment_date']?></td>

		<td rowspan="<?=$rowspan?>"><?=($modified_date ? date('d.m.Y', strtotime($modified_date)) : '-')?> </td>
        <td rowspan="<?=$rowspan?>"><?=$row['created_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['amount']?></td>
		<td rowspan="<?=$rowspan?>"><?=$this->getPlanDays($row['id'])?></td>
		<td rowspan="<?=$rowspan?>"><?=$this->getFactDays($row['id'])?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['order_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['get_oriented_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['get_fact_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['call_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['check_oriented_date']?></td>
		<td rowspan="<?=$rowspan?>"><?=$this->yesno[ $row['sto'] ]?></td>
		<td rowspan="<?=$rowspan?>"><?=$row['order_equipment_open_date']?></td>
		
		<?
			if (is_array($avrList) && sizeOf($avrList)) { 
				$i = 0;
				foreach ($avrList as $avrRow) {
					if ($i) echo '</tr><tr>';
					
					echo '<td>' . $avrRow['number'] . '</td>';
					echo '<td>' . $avrRow['begin_date'] . '</td>';
					echo '<td>' . $avrRow['end_date'] . '</td>';
					echo '<td>' . $avrRow['amount'] . '</td>';
					
					if (!$i) {
					?>
                        <td rowspan="<?=$rowspan?>"><?=$row['repair_begin_date']?></td>
                        <td rowspan="<?=$rowspan?>"><?=$row['repair_end_date']?></td>
                        <td rowspan="<?=$rowspan?>"><? if($row['avrChecked']) echo '+'; else echo '-'; ?></td>
						<td rowspan="<?=$rowspan?>"><?=$this->statuses[ $row['statuses_id'] ]['title']?></td>
						<? if (intval($data['showMonitoring'])) { ?>
						<td rowspan="<?=$rowspan?>"><?=$monitoringHTML?></td>
						<? } ?>
					<?
					}
					
					$i++;
				}
			} else {
				echo '<td>&nbsp;</td>';
				echo '<td>&nbsp;</td>';
				echo '<td>&nbsp;</td>';
				echo '<td>&nbsp;</td>';
				?>
                <td rowspan="<?=$rowspan?>"><?=$row['repair_begin_date']?></td>
                <td rowspan="<?=$rowspan?>"><?=$row['repair_end_date']?></td>
                <td rowspan="<?=$rowspan?>"><? if($row['avrChecked']) echo '+'; else echo '-'; ?></td>
				<td rowspan="<?=$rowspan?>"><?=$this->statuses[ $row['statuses_id'] ]['title']?></td>
				<? if (intval($data['showMonitoring'])) { ?>
				<td rowspan="<?=$rowspan?>"><?=$monitoringHTML?></td>
				<? } ?>
				<?
			}
		?>				
	</tr>
<? } ?>

</table>
</body>
</html>