<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Реєстри передачі. <?=$types[$data['types_id']]?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="AccidentsActsTransfer|show" />
			<? if ($data['types_id'] == 2 && $this->permissions['generated']) { ?>
			<input type="hidden" name="types_id" value="<?=$data['types_id']?>" />
			<? } ?>
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<?=$this->getShowHiddenFields($data)?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
				<td height="28" valign="bottom">
					<table cellpadding="0" cellspacing="0">
					<tr>
						<? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionAdd\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionAdd\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionAdd\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionAdd" src="/images/administration/navigation/add.gif" alt="Створити" /></a></td>'?>
						<? if ($this->permissions['generated']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionGenerated\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionGenerated\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionGenerated\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionGenerated" src="/images/administration/navigation/add.gif" alt="Згенерувати" /></a></td>'?>
						<? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionUpdate\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionUpdate\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionUpdate\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionUpdate" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
						<? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionView\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionView\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionView\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionView" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
						<? if ($this->permissions['exportAll']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionExportAll\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionExportAll\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionExportAll\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionExportAll" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<? if ($data['types_id'] == 2 && $this->permissions['generated']) { ?>
							<td><b>Місяць: </b></td>
							<td>
								<select name="month" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
									<option value="1" <?=($data['month'] == 1 ? 'selected' : '')?>>Січень</option>
									<option value="2" <?=($data['month'] == 2 ? 'selected' : '')?>>Лютий</option>
									<option value="3" <?=($data['month'] == 3 ? 'selected' : '')?>>Березень</option>
									<option value="4" <?=($data['month'] == 4 ? 'selected' : '')?>>Квітень</option>
									<option value="5" <?=($data['month'] == 5 ? 'selected' : '')?>>Травень</option>
									<option value="6" <?=($data['month'] == 6 ? 'selected' : '')?>>Червень</option>
									<option value="7" <?=($data['month'] == 7 ? 'selected' : '')?>>Липень</option>
									<option value="8" <?=($data['month'] == 8 ? 'selected' : '')?>>Серпень</option>
									<option value="9" <?=($data['month'] == 9 ? 'selected' : '')?>>Вересень</option>
									<option value="10" <?=($data['month'] == 10 ? 'selected' : '')?>>Жовтень</option>
									<option value="11" <?=($data['month'] == 11 ? 'selected' : '')?>>Листопад</option>
									<option value="12" <?=($data['month'] == 12 ? 'selected' : '')?>>Грудень</option>
								</select>
							</td>
							<td><b>Рік: </b></td>
							<td>
								<?
								echo '<select name="year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
								$year = date("Y");
								for ($i=2013; $i<=$year; $i++){
									if ($i == $data['year']) echo"<option value = $i selected>".$i."</option>";
									else echo "<option value = $i>".$i."</option>";
								}
								?>
								</select>
							</td>
						<? } ?>
						<td width="10"></td>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
					</tr>
					</table>
				</td>
				<td align="right">
					<table cellpadding="0" cellspacing="5">
						<tr>
							<? if ($data['types_id'] != 2) { ?>
							<td rowspan="3" style="vertical-align: top;">
								<select name="types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
								<? foreach($types as $types_id => $types_title) { ?>
									<option value="<?=$types_id?>" <?=($types_id == $data['types_id'] ? 'selected' : '')?>><?=$types_title?></option>
								<? } ?>
								</select>
							</td>
							<? } ?>
							<td rowspan="3" style="vertical-align: top;">
								<select name="statuses_id[]" multiple size="4" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
								<? foreach($statuses as $status) { ?>
									<option value="<?=$status['id']?>" <?=(in_array($status['id'], $data['statuses_id']) ? 'selected' : '')?>><?=$status['title']?></option>
								<? } ?>
								</select>
							</td>
							<td valign="bottom"><b>Дата формування:</b></td>
							<td valign="bottom">&nbsp;з</td><td valign="bottom"><input type="text" id="dateFrom<?=$this->objectTitle?>" name="dateFrom" value="<?=$data['dateFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
							<td valign="bottom" nowrap>&nbsp;до</td><td valign="bottom"><input type="text" id="dateTo<?=$this->objectTitle?>" name="dateTo" value="<?=$data['dateTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
							<td valign="bottom" align="right" rowspan="3"><input type="submit" class="button" value="Показати"></td>
						</tr>
						<tr>
							<td valign="bottom"><b>Дата отримання:</b></td>
							<td valign="bottom">&nbsp;з</td><td valign="bottom"><input type="text" id="receivedDateFrom<?=$this->objectTitle?>" name="receivedDateFrom" value="<?=$data['receivedDateFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
							<td valign="bottom" nowrap>&nbsp;до</td><td valign="bottom"><input type="text" id="receivedDateTo<?=$this->objectTitle?>" name="receivedDateTo" value="<?=$data['receivedDateTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
						</tr>
						<tr>
							<td valign="bottom"><b>Дата закриття:</b></td>
							<td valign="bottom">&nbsp;з</td><td valign="bottom"><input type="text" id="closedDateFrom<?=$this->objectTitle?>" name="closedDateFrom" value="<?=$data['closedDateFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
							<td valign="bottom" nowrap>&nbsp;до</td><td valign="bottom"><input type="text" id="closedDateTo<?=$this->objectTitle?>" name="closedDateTo" value="<?=$data['closedDateTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
						</tr>
					</table>
				</td>
			</tr>
			<? } ?>
			<tr><td colspan="2" height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td colspan="2">
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
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['number']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['statuses_title']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['date_format']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['formed_accounts_name']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['received_date_format']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['received_accounts_name']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['closed_date_format']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['created_format']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['created_accounts_name']?></a></td>
							<td><a href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['id'] . '&types_id=' . $data['types_id']?>"><?=$row['modified_format']?></a></td>
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
				<? if ($this->permissions['insert']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionAdd\', document.'.$this->objectTitle.', \''.$this->object.'|add\', \'/images/administration/navigation/add.gif\', \'/images/administration/navigation/add_over.gif\', \'\', \'/images/administration/navigation/add_dim.gif\', true, true, true, true, \'Створити\', false, \'\');'?>
				<? if ($this->permissions['generated']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionGenerated\', document.'.$this->objectTitle.', \''.$this->object.'|generate\', \'/images/administration/navigation/add.gif\', \'/images/administration/navigation/add_over.gif\', \'\', \'/images/administration/navigation/add_dim.gif\', true, true, true, true, \'Згенерувати\', false, \'\');'?>
				<? if ($this->permissions['update']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionUpdate\', document.'.$this->objectTitle.', \''.$this->object.'|load\', \'/images/administration/navigation/edit.gif\', \'/images/administration/navigation/edit_over.gif\', \'\', \'/images/administration/navigation/edit_dim.gif\', true, false, true, false, \'' . translate('Edit') . '\', false, \'\');'?>
				<? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionView\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
				<? if ($this->permissions['exportAll']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionExportAll\', document.'.$this->objectTitle.', \''.$this->object.'|ExportAllInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>