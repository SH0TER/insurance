<table width="100%" cellpadding="0" cellspacing="0">
<tr class="columns">
	<td colspan="3" align="center" nowrap><b>Договір страхування</b></td>
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
	<td rowspan="2" nowrap><b>Відповідальність<br />Перестраховика, %</b></td>
	<td rowspan="2" nowrap><b>Застраховано<br />з врахуванням<br />зносу</b></td>
	<td rowspan="2"><b>Вигодонабувач</b></td>
	<td rowspan="2"><b>Перестраховано</b></td>
</tr>
<tr class="columns">
	<td><b>№</b></td>
	<td><b>Дата</b></td>
	<td><b>Платіж</b></td>
	<td align="center"><b>з</b></td>
	<td align="center"><b>до</b></td>
	<td width="60" align="center" nowrap><b>Викр.%</b></td>
	<td width="60" align="center" nowrap><b>Пош.%</b></td>
</tr>
 <?
	if (is_array($list)) {
		$i = 0;
		foreach ($list as $row) {
			$i = 1 - $i;
?>
<tr class="<?=Form::getRowClass($row, $i)?>">
	<td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>"><?=$row['policiesNumber']?></td>
	<td><?=$row['policiesDate']?></td>
	<td><?=$row['payment_date']?></td>
	<td><?=$row['policiesInsurer'] ?></td>
	<td><?=$row['item']?></td>
	<td><?=$row['shassi']?></td>
	<td><?=$row['sign']?></td>
	<td><?=$row['policiesbegin_datetime']?></td>
	<td><?=$row['policiesinterrupt_datetime']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['itemsPrice'], -1)?></td>
	<td><?=getRisksFormat($row['policyRisks'])?></td>
	<td><?=$row['year']?></td>
	<td align="right" nowrap><?=$row['deductibles_value1']?></td>
	<td align="right" nowrap><?=$row['deductibles_value0']?></td>
	<td align="right" nowrap><?=getMoneyFormat($row['insurerPrice'], -1)?></td>
	<td align="right" nowrap><?=$share?></td>
	<td><?=($row['options_deterioration_no'] == 0) ? 'так' : 'ні'?></td>
	<td><?=$row['assured_title']?></td>
	<td nowrap><?=$row['bordero_premiumsNumbers']?></td>
</tr>
<?
		}
?>
</table>
<div class="navigation"><div class="paging">Всьго: <?=sizeOf($list)?></div></div>
<? }?>