<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption"><?=$this->getFormTitle('show')?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" onkeydown="if ( event.keyCode == 13 ) this.submit();">
			<input type="hidden" name="do" value="<?=$this->object?>|show" />
			<input type="hidden" name="id" value="<?=$data['id']?>" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
			<?=$this->getShowHiddenFields($data)?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="bottom">
							<table cellpadding="0" cellspacing="0">
							<tr>
								<? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
								<? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
								<? if ($this->permissions['updatePassword']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/password.gif" alt="' . translate('Password') . '" /></a></td>'?>
								<? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
								<? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
								<? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
								<? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                <? if ($this->permissions['exportMTSBU']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action7" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                <? if ($this->permissions['importMTSBU']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/import.gif" alt="' . translate('Import') . '" /></a></td>'?>
								<? if ($this->permissions['payments']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action9" src="/images/administration/navigation/payments.gif" alt="' . translate('Payments') . '" /></a></td>'?>
                                <? if ($this->permissions['importPolicyBlanksList']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action10" src="/images/administration/navigation/import.gif" alt="Імпорт списку бланків для МТСБУ" /></a></td>'?>
								<td width="10"></td>
								<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
							</tr>
							</table>
						</td>
						<td align="right">
							<table cellpadding="0" cellspacing="5">
							<tr>
								<td>
									<b>Компанія:</b> 
									<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="">...</option>
<!--
										<option value="<?=INSURANCE_COMPANIES_KNIAZHA?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_KNIAZHA) ? 'selected' : ''?>>ПАТ "Українська страхова  компанія "Княжа Вієнна Іншуранс Груп"</option>
										<option value="<?=INSURANCE_COMPANIES_ORANTA?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_ORANTA) ? 'selected' : ''?>>НАСК "Оранта"</option>
										<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>СК "Гарант Авто"</option>
-->
										<option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ "Експрес Страхування"</option>
									</select>
								</td>
                                <td><b>Тип:</b> <?=$fields['product_types_id']['object']?></td>
								<td><b>Статус бланку:</b> <?=$fields['blank_statuses_id']['object']?></td>
								<td><b>Серія:</b> <input type="text" name="series" value="<?=$data['series']?>" class="fldText series" onfocus="this.className='fldTextOver series';" onblur="this.className='fldText series';" /></td>
								<td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldText number" onfocus="this.className='fldTextOver number';" onblur="this.className='fldText number';" /></td>
                                <td><b>Не вітзвітован:</b> <input type="checkbox" name="reported" value="0" <?=($data['reported'] === '0') ? 'checked' : ''?> /></td>
							</tr>
							</table>
							<table cellpadding="0" cellspacing="5">
							<tr>
								<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
								<td>
									<b>Агенція:</b> 
									<?
										echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
										echo '<option value="">...</option>';
										foreach ($data['agencies'] as $agency) {
											echo ($agency['id'] == $data['agencies_id'])
                                                ? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
                                                : '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
										}
										echo '</select>';
									?>
								</td>
								<? } ?>
								<td>
									<b>Статус акту:</b>
									<?
										echo '<select name="acts_input_statuses_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
											echo '<option value="">...</option>';
											echo '<option value="1" ' . (($data['acts_input_statuses_id'] == 1) ? 'selected' : '') . '>створено</option>';
											echo '<option value="2" ' . (($data['acts_input_statuses_id'] == 2) ? 'selected' : '') . '>передано</option>';
										echo '</select>';
									?>
								</td>
								<td><b>Початок:</b></td>
                                <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
								<td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
							</tr>
							</table>
						</td>
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
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
							<?=$this->getRowValues($data, $row, $hidden, $total)?>
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
			</div>
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
				<? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                <? if ($this->permissions['exportMTSBU']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action7\', document.'.$this->objectTitle.', \''.$this->object.'|exportMTSBUInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Експорт в МТСБУ') . '\', false, \'\');'?>
                <? if ($this->permissions['importMTSBU']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|importMTSBU\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, true, \'' . translate('Імпорт з МТСБУ') . '\', false, \'\');'?>
				<? if ($this->permissions['payments']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action9\', document.'.$this->objectTitle.', \''.$this->object.'|updatePayments\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/payments_dim.gif\', true, true, true, true, \'' . translate('Payments') . '\', false, \'\');'?>
                <? if ($this->permissions['importPolicyBlanksList']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action10\', document.'.$this->objectTitle.', \''.$this->object.'|importPolicyBlanksList\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, true, \'' . translate('Імпорт списку бланків для МТСУ') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>