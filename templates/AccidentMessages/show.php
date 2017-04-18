<script>

	function send() {
		$('form[name=<?=$this->objectTitle?>]').attr('action', '<?=$_SERVER["PHP_SELF"]?>?do=Accidents|show&show=messages');
		$('input[name=do]').remove();
		$('form[name=<?=$this->objectTitle?>]').submit();		
	}
	
	function approvalTask() {
		var idx = '';
	
		$('input[name=id[]]:checked').each(function(){
			idx = idx + 'id[]=' + this.value + '&';
		});
	
		$.ajax({
			type:       'POST',
			url:        'index.php',
			dataType:   'json',
			data:       'do=AccidentMessages|approvalTaskIdInWindow'+
						'&'+idx,
			success:    function(result){
			}
		});
	
		send();
		return false;
	}

</script>

<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<? if (intval($data['accidents_id'])) { ?>
	<tr>
		<td class="bullet">
			<?      
				$bullet = ($_COOKIE[$this->object.'Block'.$prefix] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block'.$prefix.'\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption"><?=$this->getFormTitle('show')?>:</td>
	</tr>
	<? } ?>
	<tr>
		<td></td>
		<td>
			<? if (intval($data['accidents_id'])) { ?>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'.$prefix] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<? } ?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" onkeydown="if ( event.keyCode == 13 ) send();">
			<input type="hidden" name="do" value="<?=$this->object?>|show" />
			<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
            <input type="hidden" name="is_accidents" value="<?=(intval($data['accidents_id']) ? 1 : 0)?>" />
			<?
				echo $this->getShowHiddenFields($data);
			?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
				<td>
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="bottom">
							<table cellpadding="0" cellspacing="0">
							<tr>
								<? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript: var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
								<? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
								<? if ($this->permissions['updatePassword']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/password.gif" alt="' . translate('Password') . '" /></a></td>'?>
								<? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
								<? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
								<? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
								<? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
								<? if ($this->permissions['send']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (out) out.out(); return true;"><img height="19" width="19" border="0" name="'.$this->objectTitle.'Action9" src="/images/administration/navigation/send.gif" alt="" /></a></td>'?>
								<? if ($this->permissions['generate']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/generate.gif" alt="Выполнить" /></a></td>'?>
                                <? if ($this->permissions['request'] && $data['product_types_id'] == PRODUCT_TYPES_KASKO) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action10" src="/images/administration/navigation/generate.gif" alt="Запит" /></a></td>'?>
								<? if ($this->permissions['approval']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionApproval\'); if (approvalTask()) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionApproval\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionApproval\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionApproval" src="/images/administration/navigation/ok.gif" alt="Затвердити" /></a></td>'?>
								<td width="10"></td>
								<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
							</tr>
							</table>
						</td>
						<? if (!intval($data['accidents_id'])) { ?>
						<td class="filters" align="right">
							<table cellpadding="0" cellspacing="5">
							<tr>
								<? if(isset($data['show'])) { ?>
								<td><b>Вид страхування:</b>
									<select name="product_types_id" class="filter fldSelect" onfocus="filter this.className='fldSelectOver'" onblur="filter this.className='fldSelect'" style="width: 200px;">
										<option value="3" <?=($data['product_types_id'] == 3) ? 'selected' : ''?>>КАСКО</option>
										<option value="4" <?=($data['product_types_id'] == 4) ? 'selected' : ''?>>ЦВ</option>
										<option value="12" <?=($data['product_types_id'] == 12) ? 'selected' : ''?>>Майно</option>
										<option value="9" <?=($data['product_types_id'] == 9) ? 'selected' : ''?>>Вантаж та багаж</option>
									</select>
								</td>
								<? } ?>
								<td valign="bottom"><b>Тип:</b> <?=$fields['message_types']['object']?></td>
								<td valign="bottom">
									<b>Виконавець, організація:</b> 
									<select name="recipient_organizations_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
									<?
										foreach ($fields['recipient_organizations'] as $row) {
											echo '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['recipient_organizations_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
										}
									?>
									</select>
								</td>
								<td valign="bottom">
									<b>Виконавець:</b>
									<select name="recipients_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
									<?
										foreach ($fields['recipients'] as $row) {
											echo '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['recipients_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
										}
									?>
									</select>
								</td>
                                <td valign="bottom">
									<b>Автор:</b>
									<select name="authors_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
									<?
										foreach ($fields['recipients'] as $row) {
											echo '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['authors_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
										}
									?>
									</select>
								</td>
								<td valign="bottom">
									<b>Куратор:</b>
									<select name="curators_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
									<?
										foreach ($fields['recipients'] as $row) {
											echo '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $data['curators_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
										}
									?>
									</select>
								</td>
							</tr>
							</table>
								
							<table cellpadding="0" cellspacing="5">
							<tr>
								<td valign="bottom"><b>Справа:</b> <input type="text" name="number" value="<?=$data['number']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" /></td>
                                <td valign="bottom">
									<b>Архів/в роботі(справа):</b>
									<select name="messages_archive_statuses_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                        <option value="<?=ACCIDENT_ARCHIVE_STATUSES_NO?>" <?= (in_array(ACCIDENT_ARCHIVE_STATUSES_NO, $data['messages_archive_statuses_id']) ? 'selected' : '') ?> >в роботі</option>;
                                        <option value="<?=ACCIDENT_ARCHIVE_STATUSES_YES?>" <?= (in_array(ACCIDENT_ARCHIVE_STATUSES_YES, $data['messages_archive_statuses_id']) ? 'selected' : '') ?> >архів</option>;
									</select>
								</td>								
								<td valign="bottom"><b>Статус:</b> <?=$fields['statuses']['object']?></td>
                                <td><b>Дата наступного дзвінка:</b></td>
                                <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="filter fldDatePicker" onfocus="this.className='filter fldDatePickerOver';" onblur="this.className='filter fldDatePicker';" /></td>
                                <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="filter fldDatePicker" onfocus="this.className='filter fldDatePickerOver';" onblur="this.className='filter fldDatePicker';" /></td>
								<td valign="bottom">&nbsp;<input type="button" onClick="send()" value="Показати" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
							</tr>
							</table>
						</td>
						<? } ?>
					</tr>
					</table>
				</td>
			</tr>
			<? } ?>
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td id="block<?=$this->object?>Table">
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td class="id"><input type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
							<?=$this->getColumnTitles()?>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;

						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
                            <?$hidden['product_types_id'] = $row['product_types_id']?>
							<?=$this->getRowValues($data, $row, $hidden, $total)?>
						</tr>
						<? } ?>
						</table>
					<? }?>
					<div class="navigation">
                        <!--?unset($hidden['product_types_id']);?--> <!--убираем тип продукта для пейджинга-->
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
				<? if ($this->permissions['updatePassword']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action2\', document.'.$this->objectTitle.', \''.$this->object.'|loadPassword\', \'/images/administration/navigation/password.gif\', \'/images/administration/navigation/password_over.gif\', \'\', \'/images/administration/navigation/password_dim.gif\', true, false, true, true, \'' . translate('Password') . '\', false, \'\');'?>
				<? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
				<? if ($this->permissions['change']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action4\', document.'.$this->objectTitle.', \''.$this->object.'|change\', \'/images/administration/navigation/change.gif\', \'/images/administration/navigation/change_over.gif\', \'\', \'/images/administration/navigation/change_dim.gif\', true, true, true, true, \'' . translate('Change') . '\', true, \'' . translate('Are you sure you want to change all this records?') . '\');'?>
				<? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
				<? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|exportRecoveryRisk\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				<? if ($this->permissions['send']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action9\', document.'.$this->objectTitle.', \''.$this->object.'|chooseRecipients\', \'/images/administration/navigation/send.gif\', \'/images/administration/navigation/send_over.gif\', \'\', \'/images/administration/navigation/send_dim.gif\', true, false, true, false, \'' . translate('Send') . '\', false, \'\');'?>
                <? if ($this->permissions['generate']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|generate\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/generate.gif\', true, false, true, false, \'Выполнить\', false, \'\');'?>
                <? if ($this->permissions['request'] && $data['product_types_id'] == PRODUCT_TYPES_KASKO) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action10\', document.'.$this->objectTitle.', \''.$this->object.'|requestInWindow\', \'/images/administration/navigation/payments_over.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/generate.gif\', true, false, true, false, \'Запит\', false, \'\');'?>
				<? if ($this->permissions['approval']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionApproval\', document.'.$this->objectTitle.', \''.$this->object.'|generate\', \'/images/administration/navigation/ok.gif\', \'/images/administration/navigation/ok_over.gif\', \'\', \'/images/administration/navigation/ok_dim.gif\', true, false, true, true, \'Затвердити\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			-->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>