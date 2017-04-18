<div class="blockPolicies" style="width: 120px; display: <?=($data['id'] ? 'block' : 'none')?>">
	<div class="section">Договори:</div>
	<? if($action != 'view') { ?>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey" style="width: 120px;"><b>Додати договір / поліс:</b></td><td><a href="javascript: addPolicy()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати договір / поліс" /></td>
		</tr>
	</table>
	<? } ?>
	<div id="blockPoliciesList">
		<table id="blockPoliciesInfo" border="1" cellpadding="5" cellspacing="0">
			<tr class="columns">
				<td>Страхувальник</td>
				<td>Вид страхування</td>
				<td>Номер</td>
				<td>Дата</td>
				<td>Автомобіль</td>
				<td>Шасі</td>
				<td>Номер</td>
				<td>Початок</td>
				<td>Закінчення</td>
				<? if($action == 'update' && $data['statuses_id'] == 2) { ?>
				<td>Статус справи</td>
				<? } ?>
				<? if($action != 'view') { ?>
				<td></td>
				<? } ?>
			</tr>
		</table>
		<div id="listPoliciesItemsId"></div>
	</div>
	<div id="blockPoliciesDatesErrors"  style="width: 600px;"></div>
</div>