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
			<input type="hidden" name="do" value="<?=$this->objectTitle?>|show" />
			<input type="hidden" name="export" value="0" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<?=$this->getShowHiddenFields($data);?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>
							<? if (in_array(true, $this->permissions)) {?>
							<table height="28" cellpadding="0" cellspacing="0">
							<tr>
								<? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
								<? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
								<? if ($this->permissions['updatePassword']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/password.gif" alt="' . translate('Password') . '" /></a></td>'?>
								<? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
								<? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
								<? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
								<? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
								<? if ($this->permissions['generate']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/generate.gif" alt="Выполнить" /></a></td>'?>
								<? if ($this->permissions['send']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (out) out.out(); return true;"><img height="19" width="19" border="0" name="'.$this->objectTitle.'Action9" src="/images/administration/navigation/send.gif" alt="" /></a></td>'?>
								<td width="1"></td>
								<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="20" height="1" alt="" /></div></div></td>
							</tr>
							</table>
							<? } ?>
						</td>
						<td align="right">
							<table cellpadding="0" cellspacing="5">
							<tr>
								<td class="label grey"><b>Період отримання коштів (для експорту):</b></td>
								<td><input type="text" id="from_payed_date" name="from_payed_date" value="<?=$data['from_payed_date']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
								<td><input type="text" id="to_payed_date" name="to_payed_date" value="<?=$data['to_payed_date']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
								<td class="label grey"><b>Справа:</b></td>
								<td><input name="accidents_number" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" value="<?=$data['accidents_number']?>" /></td>
								<td class="label grey"><b>Тип особи:</b></td>
								<td>
									<select name="person_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="">...</option>
										<option <?=$data['person_types_id'] == 1 ? 'selected' : ''?> value="1"  >фізична</option>
										<option <?=$data['person_types_id'] == 2 ? 'selected' : ''?> value="2"  >юридична</option>
									</select>
								</td>
								<td class="label grey"><b>Назва:</b></td>
								<td><input name="title" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" value="<?=$data['title']?>" /></td>
								<td class="label grey"><b>СК:</b></td>
								<td>
									<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="">...</option>
										<?
											foreach($data['insurance_companies'] as $row) {
												echo '<option ' . ($data['insurance_companies_id'] == $row['id'] ? 'selected' : '') . ' value="' . $row['id'] . '"  >' . $row['title'] . '</option>';
											}
										?>
									</select>
								</td>
								<td class="label grey"><b>Статус:</b></td>
								<td>
									<select name="regression_statuses_id[]" multiple class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="0" <?=(in_array(0, $data['regression_statuses_id']) ? 'selected' : '')?>>...</option>
										<?
											foreach($data['regression_statuses'] as $row) {
												echo '<option ' . (in_array($row['id'], $data['regression_statuses_id']) ? 'selected' : '') . ' value="' . $row['id'] . '"  >' . $row['title'] . '</option>';
											}
										?>
									</select>
								</td>
								<td><input type="submit" value="Показати" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td>
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td class="id" rowspan="2"><input type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
							<td colspan="3">Справа</td>
							<td colspan="2">Інша сторона</td>
							<td colspan="7">Претензія</td>
							<td colspan="7">Позов</td>

							<td rowspan="2">Статус</td>
							<td rowspan="2">Коментар</td>
							<td rowspan="2">Створено</td>
							<td rowspan="2">Редаговано</td>
						</tr>
						<tr class="columns">
							<td>Номер</td>
							<td>Подія</td>
							<td>Передача</td>

							<td>Особа</td>
							<td>Назва</td>

							<td>Номер</td>
							<td>Дата</td>
							<td>Сума, грн.</td>
							<td>Дата останнього отримання коштів</td>
							<td>Сума, грн.</td>
							<td>Коментар</td>
							<td>Виконавець</td>

							<td>Номер</td>
							<td>Дата</td>
							<td>Сума, грн.</td>
							<td>Дата останнього отримання коштів</td>
							<td>Сума, грн.</td>
							<td>Коментар</td>
							<td>Виконавець</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>

							<td><?=$row['accidents_number']?></a></td>
							<td><?=$row['accidents_date_format']?></td>
							<td><?=$row['date_format']?></td>

							<td>
								<?php
									switch (intval($row['person_types_id'])) {
										case 1:
											echo 'Фізична';
											break;
										case 2:
											echo 'Юридична';
											break;
										default:
											echo '&nbsp;';
											break;
									}
								?>
							</td>
							<td><?=$row['title']?></td>
							
							<?
								$sql = 'SELECT date_format(MAX(date), \'%d.%m.%Y\') as date, SUM(amount) as amount FROM ' . PREFIX . '_accident_regression_payments WHERE ' . implode(' AND ', $data['pretension_conditions']) . ' AND accident_regression_culprits_id = ' . intval($row['id']);
								$pretension_data = $db->getRow($sql);
							?>

							<td><?=$row['pretension_number']?></td>
							<td><?=$row['pretension_date_format']?></td>
							<td><?=$row['pretension_amount']?></td>
							<td><?=$pretension_data['date']?></td>
							<td><?=$pretension_data['amount']?></td>
							<td><?=$row['pretension_comment']?></td>
							<td><?=$row['pretension_perfmormers_title']?></td>
							
							<?
								$sql = 'SELECT date_format(MAX(date), \'%d.%m.%Y\') as date, SUM(amount) as amount FROM ' . PREFIX . '_accident_regression_payments WHERE ' . implode(' AND ', $data['claim_conditions']) . ' AND accident_regression_culprits_id = ' . intval($row['id']);
								$claim_data = $db->getRow($sql);
							?>

							<td><?=$row['claim_number']?></td>
							<td><?=$row['claim_date_format']?></td>							
							<td><?=$row['claim_amount']?></td>
							<td><?=$claim_data['date']?></td>		
							<td><?=$claim_data['amount']?></td>
							<td><?=$row['claim_comment']?></td>
							<td><?=$row['claim_perfmormers_title']?></td>

							<td><?=$row['regres_statuses_title']?></td>
							<td><?=$row['comment']?></td>
							<td><?=$row['created_format']?></td>
							<td><?=$row['modified_format']?></td>
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
				<? if ($this->permissions['updatePassword']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action2\', document.'.$this->objectTitle.', \''.$this->object.'|loadPassword\', \'/images/administration/navigation/password.gif\', \'/images/administration/navigation/password_over.gif\', \'\', \'/images/administration/navigation/password_dim.gif\', true, false, true, true, \'' . translate('Password') . '\', false, \'\');'?>
				<? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
				<? if ($this->permissions['change']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action4\', document.'.$this->objectTitle.', \''.$this->object.'|change\', \'/images/administration/navigation/change.gif\', \'/images/administration/navigation/change_over.gif\', \'\', \'/images/administration/navigation/change_dim.gif\', true, true, true, true, \'' . translate('Change') . '\', true, \'' . translate('Are you sure you want to change all this records?') . '\');'?>
				<? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
				<? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				<? if ($this->permissions['generate']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|generate\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/generate.gif\', true, false, true, false, \'Выполнить\', false, \'\');'?>
				<? if ($this->permissions['send']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action9\', document.'.$this->objectTitle.', \''.$this->object.'|chooseRecipients\', \'/images/administration/navigation/send.gif\', \'/images/administration/navigation/send_over.gif\', \'\', \'/images/administration/navigation/send_dim.gif\', true, false, true, false, \'' . translate('Send') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>