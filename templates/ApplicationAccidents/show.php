<script>

	function send() {
		$('form[name=<?=$this->objectTitle?>]').attr('action', '<?=$_SERVER["PHP_SELF"]?>?do=Accidents|show&show=applications');
		$('input[name=do]').remove();
		$('form[name=<?=$this->objectTitle?>]').submit();		
	}

</script>

<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td></td>
		<td>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" onkeydown="if ( event.keyCode == 13 ) send();">
			<input type="hidden" name="do" value="<?=$this->object?>|show" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<?=$this->getShowHiddenFields($data);?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionInsert\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionInsert\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionInsert\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionInsert" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
						<? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionUpdate\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionUpdate\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionUpdate\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionUpdate" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
						<? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionView\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionView\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionView\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionView" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
						<? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionDelete\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionDelete\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionDelete\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionDelete" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
                        <? if ($this->permissions['changeInspectingAccount']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionChangeInspectingAccount\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionChangeInspectingAccount\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionChangeInspectingAccount\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionChangeInspectingAccount" src="/images/administration/navigation/change_persons.gif" alt="Змінити особу \"Огляд ТЗ\"" /></a></td>'?>
						<? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<td width="10"></td>
                        <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
						<td class="filters" align="right">
                            <table>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td><b>Статус:</b>
                                                    <select name="statuses_id" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                                        <option value="">...</option>
                                                        <option value="1">Прийом повідомлення</option>
                                                        <option value="2">Сформовано</option>
                                                        <option value="3">Прийнято</option>
                                                        <option value="4">Страхувальник ЦВ</option>
                                                    </select>
                                                </td>
                                                <td><b>Вид страхування:</b>
                                                    <select name="product_types_id" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                                        <option value="">...</option>
                                                        <option value="<?=PRODUCT_TYPES_KASKO?>">КАСКО</option>
                                                        <option value="<?=PRODUCT_TYPES_GO?>">ОСЦПВ</option>
                                                    </select>
                                                </td>
                                                <td align="right"><b>Державний номер:</b>
                                                    <input type="text" name="sign" value="<?=$data['sign']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" />
                                                </td>
                                                <td><b>Страхувальник:</b>
                                                    <input type="text" name="insurer" value="<?=$data['insurer']?>" class="filter fldText lastname" onfocus="this.className='filter fldTextOver lastname';" onblur="this.className='filter fldText lastname';" />
                                                </td>
                                                <td><b>Договір/поліс:</b>
                                                    <input type="text" name="policies_number" value="<?=$data['policies_number']?>" class="filter fldAuth" onfocus="this.className='filter fldAuthOver';" onblur="this.className='filter fldAuth';" />
                                                </td>
                                                <td align="right"><b>Номер повідомлення:</b>
                                                    <input type="text" name="number" value="<?=$data['number']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right">
                                                    <input type="button" onClick="send()" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" value="Показати" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
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
				<td id="block<?=$this->object?>Table">
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td class="id"><input type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
							<?=$this->getColumnTitles()?>
							<td>Заява на виплату</td>
							<td>Огляд ТЗ</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
								$documents = unserialize($row['documents']);
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
							<!--?=$this->getRowValues($data, $row, $hidden, $total)?-->
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['number']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['statuses_id']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['applicant']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['datetime_format']?></a></td>
                            <td style="white-space: normal;"><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['damage']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['created_format']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['creator']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['modified_format']?></a></td>
							<td><a <?=(in_array(154, $documents['product_document_types']) ? 'style="color:red; "' : '' )?> href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id']?>"><?=(in_array(154, $documents['product_document_types']) ? '<b>так</b>' : 'ні')?></a></td>
							<td><a <?=(intval($row['inspecting_car']) == 1 ? 'style="color:red; "' : '' )?> href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id']?>"><?=(intval($row['inspecting_car']) == 1 ? '<b>так</b>' : 'ні')?></a></td>
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
				<? if ($this->permissions['insert']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionInsert\', document.'.$this->objectTitle.', \''.$this->object.'|add\', \'/images/administration/navigation/add.gif\', \'/images/administration/navigation/add_over.gif\', \'\', \'/images/administration/navigation/add_dim.gif\', true, true, true, true, \'' . translate('Add') . '\', false, \'\');'?>
				<? if ($this->permissions['update']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionUpdate\', document.'.$this->objectTitle.', \''.$this->object.'|load\', \'/images/administration/navigation/edit.gif\', \'/images/administration/navigation/edit_over.gif\', \'\', \'/images/administration/navigation/edit_dim.gif\', true, false, true, false, \'' . translate('Edit') . '\', false, \'\');'?>
				<? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionView\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
				<? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionDelete\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
                <? if ($this->permissions['changeInspectingAccount']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionChangeInspectingAccount\', document.'.$this->objectTitle.', \''.$this->object.'|changeInspectingAccount\', \'/images/administration/navigation/change_persons.gif\', \'/images/administration/navigation/change_persons_over.gif\', \'\', \'/images/administration/navigation/change_persons_dim.gif\', true, false, true, true, \'Змінити особу \"Огляд ТЗ\"\', false, \'\');'?>
				<? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>