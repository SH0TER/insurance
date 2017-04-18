<script type="text/javascript">
    var statuses = Array();
    <?php
        $t = array();
        foreach ($task_statuses as $task_status) {

            if (!in_array($task_status['task_types_id'], $t)) {
                echo 'statuses[' . $task_status['task_types_id'] . '] = Array();' . "\r\n";
                $t[] = $task_status['task_types_id'];
                $i = 0;
            }

            echo 'statuses[' . $task_status['task_types_id'] . '][' . $i . '] = [' . $task_status['id'] . ', ' . $db->quote($task_status['title']) . ', ' . $task_status['parent_id'] . '];' . "\r\n";
            $i++;
        }
    ?>

    function changeType() {

        var task_types_id = document.getElementById('task_types_id').value;
        var task_statuses = document.getElementById('task_statuses_id');

        task_statuses.options.length = 0;

        //устанавливаем
        task_statuses.options[0] = new Option('...', -1);
        if (task_types_id > 0) {
            for (var i=0; i < statuses[task_types_id].length; i++) {
                task_statuses.options.add( new Option(statuses[task_types_id][i][1], statuses[task_types_id][i][0]) );
            }
        }
    }
</script>
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'.$data["history"]] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block'. $data["history"] .'\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption"><?=$this->getFormTitle('show')?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
            <?
                $this->objectTitle .=  $data['history'];
            ?>
			<?='<div id="' . $this->object . 'Block' . $data['history'] . '" ' . (($_COOKIE[$this->object.'Block'.$data["history"]] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|show" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
            <input type="hidden" name="is_accidents" value="<?=$data['is_accidents']?>" />
			<?=$this->getShowHiddenFields($data);?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="10%" valign="bottom">
                                <? if (in_array(true, $this->permissions)) {?>
                                <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
                                    <? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
                                    <? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
                                    <? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
                                    <? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                    <? if ($this->permissions['report'] && !$data['history'] && $data['do'] != 'Accidents|view') echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/generate.gif" alt="Звіт" /></a></td>'?>
									<? if ($this->permissions['transfer']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (out) out.out(); return true;"><img height="19" width="19" border="0" name="'.$this->objectTitle.'Action11" src="/images/administration/navigation/transfer.gif" alt="Змiнити виконавця" /></a></td>'?>
                                    <? if ($this->permissions['axapta']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionAxapta\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionAxapta\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionAxapta\'); if (out) out.out(); return true;"><img height="19" width="19" border="0" name="'.$this->objectTitle.'ActionAxapta" src="/images/administration/navigation/axapta.gif" alt="Аксапта" /></a></td>'?>
									<td width="10"></td>
                                    <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                </tr>
                                </table>
                                <? } ?>
                            </td>
                            <td align="right">
                                <table cellpadding="0" cellspacing="5" style="display: <?=(($data['do'] == 'Accidents|view' || in_array($data['history'], array(1,2))) ? 'none' : '')?>">
                                    <tr>
                                        <td>
                                            <b>Тип:&nbsp;</b>
                                            <select id="task_types_id" name="task_types_id" class="fldSelect" onchange="changeType()" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
                                                <option value="">...</option>
                                                <?php
                                                    foreach($task_types as $task_type) {
                                                        echo '<option value="' . $task_type['id'] . '" ' . (($data['task_types_id'] == $task_type['id']) ? 'selected': '') . '>' . $task_type['title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </td>
										<td  >
                                                        <b>Банк:</b>
                                                        <?
                                                            echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
                                                            echo '<option value="">...</option>';
                                                            foreach ($financial_institutions as $financial_institution) {
                                                                echo ($financial_institution['id'] == $data['financial_institutions_id'])
                                                                    ? '<option value="' . $financial_institution['id'] . '" selected>' . $financial_institution['title'] . '</option>'
                                                                    : '<option value="' . $financial_institution['id'] . '">' . $financial_institution['title'] . '</option>';
                                                            }
                                                            echo '</select>';
                                                        ?>
                                        </td>
                                        <td>
                                            <b>Статус:&nbsp;</b><select id="task_statuses_id" name="task_statuses_id" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';" ></select></td>
                                        <td>
                                            <b>Дзвінок:&nbsp;</b>
                                            <select name='task_statuses_call_id' class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
                                                <option value="">...</option>
                                                <option value="<?=TASK_STATUSES_CALL_NO?>" <?=(($data['task_statuses_call_id']==TASK_STATUSES_CALL_NO) ? 'selected': '')?>>Не додзвонились</option>
                                                <option value="<?=TASK_STATUSES_CALL_YES?>" <?=(($data['task_statuses_call_show_id']==TASK_STATUSES_CALL_YES) ? 'selected': '')?>>Додзвонились</option>
                                            </select>
                                        </td>
                                         <td>
                                            <b>Дата виконання задачі: З</b>
                                        </td>
                                        <td>
                                            <input type="text" id="from" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" />
                                        </td>
                                        <td>
                                            <b>По:</b>
                                        </td>
                                        <td>
                                            <input type="text" id="to" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Договір:&nbsp;<br/></b>
                                            <input type="text" name="policies_number" value="<?=$data['policies_number']?>" class="fldText" onmouseout="this.className='fldText';" onmouseover="this.className='fldTextOver';" />
                                        </td>

                                        <td>
                                            <b>Справа:&nbsp;<br/></b>
                                            <input type="text" name="accidents_number" value="<?=$data['accidents_number']?>" class="fldText" onmouseout="this.className='fldText';" onmouseover="this.className='fldTextOver';" />
                                        </td>

                                        <td colspan="2">
                                            <b>Страхувальник:&nbsp;<br/></b>
                                            <input type="text" name="insurer" value="<?=$data['insurer']?>" class="fldText" onmouseout="this.className='fldText';" onmouseover="this.className='fldTextOver';" />
                                        </td>

                                        <td colspan="3">
                                             <b>Виконавець:&nbsp;<br/></b>
                                            <input type="text" name="performers_name" value="<?=$data['performers_name']?>" class="fldText" onmouseout="this.className='fldText';" onmouseover="this.className='fldTextOver';" />
                                        </td>
										<td  align="right">
                                            <input type="submit" class="button" value="Показати" />
                                        </td>
                                    </tr>
                                     
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
			</tr>
			<tr><td height="4" bgcolor="#D6D6D6" colspan="7"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td colspan="7">
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td class="id"><input type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
                            <?=$this->getColumnTitles()?>
                            <td>Банк</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
							<td><a href="?do=Tasks|view&id=<?=$row['id']?>">&nbsp;<?=$row['date_format']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>"><?=$row['task_types_title']?></a></td>
                            <td><a target="_blank" href="?do=Clients|view&id=<?=$row['clients_id']?>"><?=$row['policies_insurer']?> <?=($row['important_person'] == 1) ? '<b style="color: red;">VIP</b>' : ''?>
							<?
								if ($row['important_person'] == 1) {
									switch ($row['important_person_groups_id']) {
										case 1:
											echo '<b style="color: red;">Укравто</b>';
											break;
										case 2:
											echo '<b style="color: red;">Інші</b>';
											break;
										case 3:
											echo '<b style="color: red;">777</b>';
											break;
									}
								}
							?>
							</a></td>
                            <td><a target="_blank" href="?do=Policies|view&id=<?=$row['policies_id']?>&product_types_id=<?=$row['product_types_id']?>"><?=$row['policies_number']?></a></td>
                            <td><?=$row['begin_datetime_format']?></td>
                            <td><?=$row['interrupt_datetime_format']?></td>
                            <td><a target="_blank" href="?do=Accidents|view&id=<?=$row['accidents_id']?>&product_types_id=<?=$row['accident_product_types_id']?>"><?=$row['accidents_number']?></a></td>
                            <td><a target="_blank" href="?do=AccidentActs|view&id=<?=$row['acts_id']?>&product_types_id=<?=$row['accident_product_types_id']?>">&nbsp;<?=$row['acts_number']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>">&nbsp;<?=$row['payment_date']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>">&nbsp;<?=$row['task_statuses_call_title']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>">&nbsp;<?=$row['task_statuses_title']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>">&nbsp;<?=$row['performers_id']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>">&nbsp;<?=$row['comment']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>"><?=$row['created_format']?></a></td>
                            <td><a href="?do=Tasks|view&id=<?=$row['id']?>"><?=$row['modified_format']?></a></td>
							<td><a href="?do=Tasks|view&id=<?=$row['id']?>"><?=$row['financial_institutions_title']?></a></td>
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
				<? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
				<? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
                <? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				<? if ($this->permissions['report']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|report\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/generate.gif\', true, true, true, false, \'Звіт\', false, \'\');'?>
				<? if ($this->permissions['transfer']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action11\', document.'.$this->objectTitle.', \''.$this->object.'|loadTransfer\', \'/images/administration/navigation/transfer.gif\', \'/images/administration/navigation/transfer_over.gif\', \'\', \'/images/administration/navigation/transfer_dim.gif\', true, false, true, true, \'' . translate('Змінити виконавця') . '\', false, \'\');'?>
                <? if ($this->permissions['axapta']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionAxapta\', document.'.$this->objectTitle.', \''.$this->object.'|importAxapta\', \'/images/administration/navigation/axapta.gif\', \'/images/administration/navigation/axapta.gif\', \'\', \'/images/administration/navigation/axapta.gif\', true, true, true, true, \'' . translate('Аксапта') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
                changeType();
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>