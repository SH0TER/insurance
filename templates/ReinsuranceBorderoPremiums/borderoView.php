<table width="100%" cellpadding="0" cellspacing="0">
<tr class="columns">
	<td colspan="2" align="center" nowrap><b>Договір страхування</b></td>
	<td rowspan="2" nowrap><b>Страхувальник</b></td>
	<td rowspan="2" nowrap><b>Застрахований<br />транспортний<br />засіб</b></td>
	<td rowspan="2" nowrap><b>Номер кузова/шассі</b></td>
	<td rowspan="2"><b>Державний<br />реєстраційний<br />номер</b></td>
	<td colspan="2" align="center"><b>Період страхування</b></td>
	<td rowspan="2"><b>Страхова сума, грн.</b></td>
	<td rowspan="2"><b>Страхова випадки</b></td>
	<td rowspan="2"><b>Рік випуску</b></td>
	<td colspan="2" align="center"><b>Франшиза</b></td>
	<td rowspan="2" nowrap><b>Відповідальність<br />Перестрахувальника, грн.</b></td>
	<td rowspan="2" nowrap><b>Відповідальність<br />Перестраховика, грн.</b></td>
	<td rowspan="2"><b>Перестраховий тариф, річний, %</b></td>
	<td rowspan="2"><b>Загальна перестрахова премія, грн.</b></td>
	<td rowspan="2"><b>Перестрахова премія за звітний період, грн.</b></td>
	<td rowspan="2"><b>Дата<br />наступного<br />платежу</b></td>
	<td rowspan="2"><b>Сума наступного платежу, грн.</b></td>
	<td rowspan="2"><b>Застраховано з врахуванням зносу</b></td>
</tr>
<tr>
	<td><b>№</b></td>
	<td><b>Дата</b></td>
	<td align="center"><b>з</b></td>
	<td align="center"><b>до</b></td>
	<td width="60" align="center" nowrap><b>Викр.%</b></td>
	<td width="60" align="center" nowrap><b>Пош.%</b></td>
</tr>
<?
	if (is_array($data['list'])) {
		$i = 0;
		foreach ($data['list'] as $row) {
			$i = 1 - $i;
?>
<tr>
	<td nowrap><?=$row['policiesNumber']?></td>
	<td nowrap><?=$row['policiesDate']?></td>
	<td><?=$row['policiesInsurer']?></td>
	<td><?=$row['item']?></td>
	<td nowrap><?=$row['shassi']?></td>
	<td nowrap><?=$row['sign']?></td>
	<td nowrap><?=$row['policiesbegin_datetime']?></td>
	<td nowrap><?=$row['policiesinterrupt_datetime']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['itemsPrice'], -1)?></td>
	<td><?=getRisksFormat($row['policyRisks'])?></td>
	<td nowrap><?=$row['year']?></td>
	<td align="right" nowrap><?=$row['deductibles_value1']?></td>
	<td align="right" nowrap><?=$row['deductibles_value0']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['insurerPrice'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['price'], -1)?></td>
	<td align="right" nowrap><?=$row['rate']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['totalAmount'], -1)?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
	<td align="right" nowrap><?=($row['nextPaymentAmount'] > 0) ? $row['nextPaymentDate'] : 'немає'?></td>
	<td align="right" nowrap><?=($row['nextPaymentAmount'] > 0) ? getMoneyFormat($row['nextPaymentAmount']) : 'немає'?></td>
	<td><?=($row['options_deterioration_no'] == 0) ? 'так' : 'ні'?></td>
</tr>
<?}?>
</table>
<div class="navigation"><div class="paging">Всьго: <?=sizeOf($list)?></div></div>
<? }?>