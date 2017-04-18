<?=$data['accidents']->header($data);
$Accident = new Accidents($data);?>
<? if ($Authorization->data['roles_id'] != ROLES_MASTER && sizeof($Authorization->data['account_groups_id']) > 1 || (sizeof($Authorization->data['account_groups_id']) == 1 && !in_array(27, $Authorization->data['account_groups_id']))  || ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR)) { ?>
        <table width="100%">
            <tr>
                <td width="10"><a href="javascript:showComments();" alt="Моніторинг"><img src="/images/administration/navigation/view_dim.gif"></a></td></td>
                <td width="50"><a href="javascript:showComments();" alt="Моніторинг">Моніторинг</a></td>
                <td width="10"><a href="javascript:addComment();" alt="Додати коментар"><img src="/images/administration/navigation/add_over.gif"></a></td>
                <td width="100"><a href="javascript:addComment();" alt="Додати коментар">Додати коментар</a></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5"><textarea name="monitoring_comment" id="monitoring_comment" class="fldText"></textarea></td>
            </tr>
        </table>
    <?}?>
<div id="comments"></div>
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption"><?=$this->getFormTitle('show')?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$data['accidents']->object?>|<?=$data['accidents']->mode?>Acts" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
			<input type="hidden" name="step" value="<?=$data['step']?>" />
			<?=$this->getShowHiddenFields($data)?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
				<td height="28">
					<table cellpadding="0" cellspacing="0">
					<tr>
						<? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
						<? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
						<? if ($this->permissions['insert'] && $data['product_types_id'] == PRODUCT_TYPES_KASKO) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action7" src="/images/administration/navigation/partial_return.gif" alt="Створити акт на часткове повернення" /></a></td>'?>
						<? if ($this->permissions['updateApproval'] || $this->permissions['getAccidentActs']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/change_status.gif" alt="Змінити статус" /></a></td>'?>
						<? if ($this->permissions['updatePassword']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/password.gif" alt="' . translate('Password') . '" /></a></td>'?>
						<? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
						<? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
						<? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
						<td width="10"></td>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
					</tr>
					</table>
				</td>
			</tr>
			<? } ?>
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td>
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td class="id"><input type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
							<?=$this->getColumnTitles()?>
							<!--td>Номер реєстру передачі СА</td-->
							<td>Змінити дату затвердження</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
							<?=$this->getRowValues($data, $row, $hidden, $total)?>
							<!--td><? if (intval($row['accidents_acts_transfer_id'])) { ?><a target="_blank" href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['accidents_acts_transfer_id'] . '&types_id=1'?>"><?=$row['transfer_number']?></a><? } ?></td-->
							<? if ($Authorization->data['id'] == 1 || in_array(ACCOUNT_GROUPS_RECEPTIONIST, $Authorization->data['account_groups_id'])) { ?>
								<td>
									<a id="changeDate<?=$row['id']?>" ><img src="/images/administration/navigation/edit.gif" /></a>
								</td>
							<? } ?>
							<? if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || in_array(ACCOUNT_GROUPS_AVERAGE, $Authorization->data['account_groups_id']) || in_array(ACCOUNT_GROUPS_RECEPTIONIST, $Authorization->data['account_groups_id'])) { ?>
							<script>
								$('#changeDate<?=$row['id']?>').click(function(){
									var date = prompt('Введіть дату затвердження: ', date);
									if (date==null) return;
									$.ajax({
										type:		'POST',
										url:		'index.php',
										dataType:	'html',
										async:		false,
										data:		'do=AccidentActs|setDateInWindow' +
													'&product_types_id=<?=$data['product_types_id']?>' +
													'&accidents_id=' + <?=$data['accidents_id']?> +
													'&id=<?=$row['id']?>' +
													'&date=' + date,
										success: 	function(result) {
														location.reload();
													}
									});
								})
							
								$('input[type=checkbox][name=not_proportionality[<?=$row['id']?>]]').change(function(){
									if (this.checked) {
										value = 1;
									} else {
										value = 0;
									}
									$.ajax({
										type:		'POST',
										url:		'index.php',
										dataType:	'json',
										data:		'do=AccidentActs|changeNotProportionalityInWindow' +
													'&id=' + <?=$row['id']?> +
													'&accidents_id=' + <?=$data['accidents_id']?> +
													'&value=' + value +
													'&product_types_id=' + <?=$data['product_types_id']?>,
										success: function(result) {
											if (result.value == 1) {
												alert('Акт ' + result.number + ' не враховується у пропорцію');
											} else if (result.value == 0) {
												alert('Акт ' + result.number + ' враховується у пропорцію');
											} else {
												alert('Невідома помилка');
											}
										}
									});
								});
								
								$('input[type=checkbox][name=in_repair[<?=$row['id']?>]]').change(function(){
									if (this.checked) {
										value = 1;
									} else {
										value = 0;
									}
									$.ajax({
										type:		'POST',
										url:		'index.php',
										dataType:	'json',
										data:		'do=AccidentActs|changeInRepairInWindow' +
													'&id=' + <?=$row['id']?> +
													'&accidents_id=' + <?=$data['accidents_id']?> +
													'&value=' + value +
													'&product_types_id=' + <?=$data['product_types_id']?>,
										success: function(result) {
											if (result.value == 1) {
												alert('Акт ' + result.number + ' "В ремонті"');
											} else if (result.value == 0) {
												alert('Акт ' + result.number + ' не "В ремонті"');
											} else {
												alert('Невідома помилка');
											}
										}
									});
								});
							</script>
							<? } ?>
						</tr>
						<? } ?>
						</table>
					<? }?>
					<div class="navigation">
						<div class="paging"><?=getPaging($data['offset' . $this->objectTitle . 'Block'], $_SESSION['auth']['records_per_page'], 7, $total, $hidden, 'offset' . $this->objectTitle . 'Block');?></div>
					</div>
				</td>
			</tr>
			</table>
			</form>
			<? if (in_array(true, $this->permissions)) {?>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? if ($this->permissions['insert']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|add\', \'/images/administration/navigation/add.gif\', \'/images/administration/navigation/add_over.gif\', \'\', \'/images/administration/navigation/add_dim.gif\', true, true, true, true, \'' . translate('Add') . '\', false, \'\');'?>
				<? if ($this->permissions['update']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action1\', document.'.$this->objectTitle.', \''.$this->object.'|load\', \'/images/administration/navigation/edit.gif\', \'/images/administration/navigation/edit_over.gif\', \'\', \'/images/administration/navigation/edit_dim.gif\', true, false, true, false, \'' . translate('Edit') . '\', false, \'\');'?>
				<? if ($this->permissions['insert'] && $data['product_types_id'] == PRODUCT_TYPES_KASKO) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action7\', document.'.$this->objectTitle.', \''.$this->object.'|createReturnPartialAct\', \'/images/administration/navigation/partial_return.gif\', \'/images/administration/navigation/partial_return_over.gif\', \'\', \'/images/administration/navigation/partial_return_dim.gif\', true, false, true, false, \'Створити акт на часткове повернення\', false, \'\');'?>
                <? if ($this->permissions['updateApproval'] || $this->permissions['getAccidentActs']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action2\', document.'.$this->objectTitle.', \''.$this->object.'|loadApproval\', \'/images/administration/navigation/change_status.gif\', \'/images/administration/navigation/change_status_over.gif\', \'\', \'/images/administration/navigation/change_status_dim.gif\', true, false, true, true, \'Змінити статус\', false, \'\');'?>
				<? if ($this->permissions['updatePassword']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|loadPassword\', \'/images/administration/navigation/password.gif\', \'/images/administration/navigation/password_over.gif\', \'\', \'/images/administration/navigation/password_dim.gif\', true, false, true, true, \'' . translate('Password') . '\', false, \'\');'?>
				<? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action4\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
				<? if ($this->permissions['change']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|change\', \'/images/administration/navigation/change.gif\', \'/images/administration/navigation/change_over.gif\', \'\', \'/images/administration/navigation/change_dim.gif\', true, false, true, true, \'' . translate('Change') . '\', true, \'' . translate('Are you sure you want to change all this records?') . '\');'?>
				<? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>
<?=$data['accidents']->footer($data, true, $this->objectTitle)?>