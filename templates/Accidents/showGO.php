<script>

	function send() {
		$('form[name=<?=$this->objectTitle?>]').attr('action', '<?=$_SERVER["PHP_SELF"]?>?do=Accidents|show&show=go');
		$('input[name=do]').remove();
		$('form[name=<?=$this->objectTitle?>]').submit();		
	}

</script>

<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
	<? if (intval($data['accidents_id'])) { ?>
    <tr>
        <td class="bullet">
        <?
            $bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
            echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
        ?>
        </td>
        <td class="caption"><?=$this->getFormTitle('show')?>:</td>
    </tr>
	<? } ?>
    <tr>
        <td></td>
        <td>
			<? if (intval($data['accidents_id'])) { ?>
            <div id="<?=$this->objectTitle?>Block" <?=($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : ''?> >
			<? } ?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" onkeydown="if ( event.keyCode == 13 ) send();">
                <input type="hidden" name="do" value="<?=$this->object?>|show" />
                <input type="hidden" name="id" value="<?=$data['id']?>" />
                <input type="hidden" name="number" value="<?=$data['number']?>" />
                <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
				<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                <?=$this->getShowHiddenFields($data)?>
                <table width="100%" cellspacing="0" cellpadding="0">
                <? if (in_array(true, $this->permissions) && !intval($data['accidents_id'])) {?>
                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="bottom">
                                <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
                                    <? if ($this->permissions['update'] || $this->permissions['updateClassification'] || $this->permissions['updateRisk'] || $this->permissions['updateEstimates'] || $this->permissions['updateActs']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
                                    <? if ($this->permissions['changeStatus']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/change_status.gif" alt="Змінити статус" /></a></td>'?>
                                    <? if ($this->permissions['updateSection']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/change_section.gif" alt="Змінити категорію" /></a></td>'?>
                                    <? if ($this->permissions['reset']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/reset_status.gif" alt="Перевести в статус &quote;Створено&quote;" /></a></td>'?>
                                    <? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
                                    <? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
                                    <? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action7" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
                                    <? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                    <? if ($this->permissions['archive']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action9" src="/images/administration/navigation/archive.gif" alt="' . translate('Archive') . '" /></a></td>'?>
									<? if ($this->permissions['inExpress']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionInExpress\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionInExpress\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionInExpress\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionInExpress" src="/images/administration/navigation/archive.gif" alt="Змінити статус наявності справи" /></a></td>'?>
                                    <? if ($this->permissions['paymentApplication']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action10" src="/images/administration/navigation/payment_application.gif" alt="Додати заяву на виплату" /></a></td>'?>
                                    <? if ($this->permissions['exportAll']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action11" src="/images/administration/navigation/export.gif" alt="' . translate('export') . '" /></a></td>'?>
                                    <? if ($this->permissions['exportClosed']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action12\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action12\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action12\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action12" src="/images/administration/navigation/export.gif" alt="' . translate('export') . '" /></a></td>'?>
                                    <? if ($this->permissions['exportPayments']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action13\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action13\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action13\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action13" src="/images/administration/navigation/export.gif" alt="' . translate('export') . '" /></a></td>'?>
                                    <? if ($this->permissions['importAll']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action14\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action14\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action14\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action14" src="/images/administration/navigation/import.gif" alt="' . translate('import') . '" /></a></td>'?>
                                    <? if ($this->permissions['importClosed']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action15\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action15\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action15\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action15" src="/images/administration/navigation/import.gif" alt="' . translate('import') . '" /></a></td>'?>
                                    <? if ($this->permissions['importPayments']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action16\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action16\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action16\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action16" src="/images/administration/navigation/import.gif" alt="' . translate('import') . '" /></a></td>'?>
                                    <? if ($this->permissions['updateClassification']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action17\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action17\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action17\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action17" src="/images/administration/navigation/change_persons.gif" alt="Змінити відповідальних" /></a></td>'?>
                                    <td width="10"></td>
                                    <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                </tr>
                                </table>
                            </td>
                            <td class="filters" align="right">
                                <table cellpadding="0" cellspacing="5">
                                    <tr>
                                        <td><b>Потерпілий, ПІБ:</b></td><td><input type="text" name="applicant" value="<?=$data['applicant']?>" class="filter fldText lastname" onfocus="this.className='filter fldTextOver lastname';" onblur="this.className='filter fldText lastname';" /><a/td>
                                        <!--td><b>Вид страхування:</b>
                                        <select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
                                            <option value="3" <?=($data['product_types_id'] == 3) ? 'selected' : ''?>>КАСКО</option>
                                            <option value="4" <?=($data['product_types_id'] == 4) ? 'selected' : ''?>>ЦВ</option>
                                            <option value="12" <?=($data['product_types_id'] == 12) ? 'selected' : ''?>>Майно</option>
                                            <option value="9" <?=($data['product_types_id'] == 9) ? 'selected' : ''?>>Вантаж та багаж</option>
                                        </select>
										</td-->
                                        <td align="right"><b>Держ. номер:</b> <input type="text" name="sign" value="<?=$data['sign']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" /></td>
                                        <td valign="bottom" rowspan="2"></td>
                                        <td valign="bottom" rowspan="2">

                                        </td>
										<td align="right"><b>Держ. номер потерпілого:</b> <input type="text" name="owner_sign" value="<?=$data['owner_sign']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" /></td>
                                        <td valign="bottom" rowspan="2">
                                        <td><b>№ шасі (кузов, рама):</b> <input type="text" name="shassi" value="<?=$data['shassi']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" /></td>
                                        </td>
                                        <td valign="bottom" rowspan="2"></td>
                                    </tr>
                                    <tr>
										<b>Заявник:</b>
                                        <select name="owner_types_id[]" multiple="multiple" size="2" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                            <option value="1" <?=(is_array($data['owner_types_id']) && in_array(1, $data['owner_types_id'])) ? 'selected' : ''?>>Страхувальник</option>
                                            <option value="2" <?=(is_array($data['owner_types_id']) && in_array(2, $data['owner_types_id'])) ? 'selected' : ''?>>Потерпілий</option>
                                        </select>
                                        <b>Архів:</b>
                                        <select name="archive_statuses_id[]" multiple="multiple" size="2" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                            <option value="0" <?=(is_array($data['archive_statuses_id']) && in_array(0, $data['archive_statuses_id'])) ? 'selected' : ''?>>в роботі</option>
                                            <option value="1" <?=(is_array($data['archive_statuses_id']) && in_array(1, $data['archive_statuses_id'])) ? 'selected' : ''?>>архів</option>
                                        </select>
                                        <b>Категорія:</b> <?=$fields['accident_sections_id']['object']?>
                                        <b>Статус:</b> <?=$fields['accident_statuses_id']['object']?>
                                        <b>Клас ремонту:</b>
                                        <select name="repair_classifications_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                            <option value="0" <?=(is_array($data['repair_classifications_id']) && in_array(0, $data['repair_classifications_id'])) ? 'selected' : ''?>>Не визначено</option>
                                            <option value="1" <?=(is_array($data['repair_classifications_id']) && in_array(1, $data['repair_classifications_id'])) ? 'selected' : ''?>>Клас 1</option>
                                            <option value="2" <?=(is_array($data['repair_classifications_id']) && in_array(2, $data['repair_classifications_id'])) ? 'selected' : ''?>>Клас 2</option>
                                            <option value="3" <?=(is_array($data['repair_classifications_id']) && in_array(3, $data['repair_classifications_id'])) ? 'selected' : ''?>>Клас 3</option>
                                            <option value="4" <?=(is_array($data['repair_classifications_id']) && in_array(4, $data['repair_classifications_id'])) ? 'selected' : ''?>>Клас 4</option>
                                        </select>
                                        <b>Аварком:</b>
                                        <select name="average_managers_id[]" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
                                            <?
                                            foreach ($fields['average_managers'] as $id=>$value) {
                                                echo '<option value="' . $id . '" ' . (in_array($id, $data['recipients_id']) ? 'selected' : '') . '>' . $value . '</option>';
                                            }
                                            ?>
                                        </select>										
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="5">
                                <tr>
                                    <td><b>Справа:</b><input type="text" name="number" value="<?=$data['number']?>" class="filter fldText number" onfocus="this.className='filter fldTextOver number';" onblur="this.className='filter fldText number';" /></td>
                                    <td><b>Поліс:</b> <input type="text" name="policies_number" value="<?=$data['policies_number']?>" class="filter fldAuth" onfocus="this.className='filter fldAuthOver';" onblur="this.className='filter fldAuth';" /></td>
                                    <td><b>Страхувальник:</b> <input type="text" name="insurer" value="<?=$data['insurer']?>" class="filter fldText lastname" onfocus="this.className='filter fldTextOver lastname';" onblur="this.className='filter fldText lastname';" /></td>
                                    <td><b>Дата створення:</b></td>
                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="filter fldDatePicker" onfocus="this.className='filter fldDatePickerOver';" onblur="this.className='filter fldDatePicker';" /></td>
                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="filter fldDatePicker" onfocus="this.className='filter fldDatePickerOver';" onblur="this.className='filter fldDatePicker';" /></td>
									<? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?>
										<td valign="bottom" rowspan="2">
											<b>СТО:</b>
											<select name="car_services_id" multiple="multiple" size="3" class="filter fldSelect" onfocus="this.className='filter fldSelectOver'" onblur="this.className='filter fldSelect'">
												<?
												echo '<option value="">...</option>';
												foreach ($fields['car_services'] as $id=>$value) {
													echo '<option value="' . $id . '" ' . ($id == $data['car_services_id'] ? 'selected' : '') . '>' . $value[0] . ' - ' . $value[1] . '</option>';
												}
												?>
											</select>
										</td>
										<? } ?>
                                    <td align="right">&nbsp;<input type="button" onClick="send()" value="Показати" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                </tr>
                                </table>
                            </td>
                            <td valign="middle">
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
							<td nowrap>В ремонт</td>
                        </tr>
                        <?
                        foreach ($list as $row) {

                            $i = 1 - $i;

                        ?>
                        <tr class="<?=$this->getRowClass($row, $i)?>">
                            <td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
                            <td valign="middle"><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['number']?>&nbsp;<? if($row['in_express'] == 1) echo '<img src="/images/logo_opacity.gif" width="20">'; ?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['date_format']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=Policies|view&amp;id=' . $row['policies_id'] . '&product_types_id=' . $data['product_types_id']?>" target="_blank"><?=$row['policies_number']?><?if($row['important_person'] == 1){?>  <b style="color: red;">VIP</b><?}?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['applicant']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['owner']?></a></td>
                            <td style="white-space:normal;"><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['insurer']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['item']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['sign']?></a></td>
                            <td align="right"><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=getMoneyFormat($row['amount_rough'])?></a>&nbsp;</td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=(($row['accident_sections_title']) ? $row['accident_sections_title'] : 'не визначено').'/'.$row['accidents_days']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$this->getInsuranceTitle($row['insurance'])?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=($row['regres']) ? 'так' : 'ні'?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=($row['repair_classifications_id'] == 0) ? 'Не визначено' : $row['repair_classifications_id']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['payment_statuses_id']?></a></td>
                            <td align="right"><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=getMoneyFormat($row['compensation'])?></a>&nbsp;</td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['accident_statuses_id']?></a></td>
                            <td class="" align="center">
                                <input type="hidden" value="<?=$row['id']?>" name="master_documentsHidden[<?=$row['id']?>]">
                                <input type="checkbox" value="1" name="master_documents[<?=$row['id']?>]" <?=$row['master_documents'] ? 'checked' :''?>>
                            </td>
							<td class="" align="center">
                                <input type="hidden" value="<?=$row['id']?>" name="avr_signHidden[<?=$row['id']?>]">
                                <input type="checkbox" value="1" name="avr_sign[<?=$row['id']?>]" <?=$row['avr_sign'] ? 'checked' :''?>>
                            </td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['modified_format']?></a></td>
                            <td>
                                м - <a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['masters_id']?></a><br />
                                а - <a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['average_manager']?></a><br />
                                е - <a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>"><?=$row['estimate_manager']?></a>
                            </td>
                            <td><?=$row['days']?>&nbsp;</td>
                           <td><?=$row['mtsbu_date_format']?></td>
						   <td class="<?=$class?>" align="center"><img  src="<? if($row['circle_label'] == 1) echo '/images/agree.gif'; else echo '/images/reject.gif';  ?>"></td>
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
                 <?
                if(!$data['accidents_id'] && $Authorization->data['roles_id'] != ROLES_MASTER && !in_array(ACCOUNT_GROUPS_SERVICE_DEPARTMENT, $Authorization->data['account_groups_id']) && $Authorization->data['permissions']['AccidentCalls']['show']) {//выводить только если не во view дела
                    $AccidentCalls = new AccidentCalls($data);
                    $AccidentCalls->show($data);
                }
                ?>
            </div>
            <? if (in_array(true, $this->permissions)) {?>
            <script type="text/javascript">
                <!--
                document.<?=$this->objectTitle?>.buttons = new Array();
                <? if ($this->permissions['insert']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|add\', \'/images/administration/navigation/add.gif\', \'/images/administration/navigation/add_over.gif\', \'\', \'/images/administration/navigation/add_dim.gif\', true, true, true, true, \'' . translate('Add') . '\', false, \'\');'?>
                <? if ($this->permissions['update'] || $this->permissions['updateClassification'] || $this->permissions['updateRisk'] || $this->permissions['updateEstimates'] || $this->permissions['updateActs']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action1\', document.'.$this->objectTitle.', \''.$this->object.'|load\', \'/images/administration/navigation/edit.gif\', \'/images/administration/navigation/edit_over.gif\', \'\', \'/images/administration/navigation/edit_dim.gif\', true, false, true, false, \'' . translate('Edit') . '\', false, \'\');'?>
                <? if ($this->permissions['changeStatus']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action2\', document.'.$this->objectTitle.', \''.$this->object.'|loadStatus\', \'/images/administration/navigation/change_status.gif\', \'/images/administration/navigation/change_status_over.gif\', \'\', \'/images/administration/navigation/change_status_dim.gif\', true, false, true, true, \'Змінити статус\', false, \'\');'?>
                <? if ($this->permissions['updateSection']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|loadSection\', \'/images/administration/navigation/change_section.gif\', \'/images/administration/navigation/change_section_over.gif\', \'\', \'/images/administration/navigation/change_section_dim.gif\', true, false, true, true, \'Змінити категорію\', false, \'\');'?>
                <? if ($this->permissions['reset']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action4\', document.'.$this->objectTitle.', \''.$this->object.'|reset\', \'/images/administration/navigation/reset_status.gif\', \'/images/administration/navigation/reset_status_over.gif\', \'\', \'/images/administration/navigation/reset_status_dim.gif\', true, false, true, false, \'Перезапустити\', true, \'Ви насправді хочете перевести справу в статус "Перезапущено"?\');'?>
                <? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
                <? if ($this->permissions['change']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|change\', \'/images/administration/navigation/change.gif\', \'/images/administration/navigation/change_over.gif\', \'\', \'/images/administration/navigation/change_dim.gif\', true, true, true, true, \'' . translate('Change') . '\', true, \'' . translate('Are you sure you want to change all this records?') . '\');'?>
                <? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action7\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
                <? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                <? if ($this->permissions['archive']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action9\', document.'.$this->objectTitle.', \''.$this->object.'|loadArchive\', \'/images/administration/navigation/archive.gif\', \'/images/administration/navigation/archive_over.gif\', \'\', \'/images/administration/navigation/archive_dim.gif\', true, false, true, true, \'' . translate('Archive') . '\', false, \'\');'?>
				<? if ($this->permissions['inExpress']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionInExpress\', document.'.$this->objectTitle.', \''.$this->object.'|loadStateInExpress\', \'/images/administration/navigation/archive.gif\', \'/images/administration/navigation/archive_over.gif\', \'\', \'/images/administration/navigation/archive_dim.gif\', true, false, true, true, \'Змінити статус наявності справи\', false, \'\');'?>
                <? if ($this->permissions['paymentApplication']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action10\', document.'.$this->objectTitle.', \''.$this->object.'|loadPaymentApplication\', \'/images/administration/navigation/payment_application.gif\', \'/images/administration/navigation/payment_application_over.gif\', \'\', \'/images/administration/navigation/payment_application_dim.gif\', true, false, true, false, \'Додати заяву на виплату\', false, \'\');'?>
                <? if ($this->permissions['exportAll']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action11\', document.'.$this->objectTitle.', \''.$this->object.'|exportAllInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, false, \'' . translate('Експорт вимог за попередній місяць') . '\', false, \'\');'?>
                <? if ($this->permissions['exportClosed']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action12\', document.'.$this->objectTitle.', \''.$this->object.'|exportClosedInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, false, \'' . translate('Експорт справ з рішеннями') . '\', false, \'\');'?>
                <? if ($this->permissions['exportPayments']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action13\', document.'.$this->objectTitle.', \''.$this->object.'|exportPaymentsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, false, \'' . translate('Експорт выплат за попередній місяц') . '\', false, \'\');'?>
                <? if ($this->permissions['importAll']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action14\', document.'.$this->objectTitle.', \''.$this->object.'|importAll\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, false, \'' . translate('Імпорт заявлених вимог за період') . '\', false, \'\');'?>
                <? if ($this->permissions['importClosed']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action15\', document.'.$this->objectTitle.', \''.$this->object.'|importClosed\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, false, \'' . translate('Імпорт справ з рішеннями за період') . '\', false, \'\');'?>
                <? if ($this->permissions['importPayments']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action16\', document.'.$this->objectTitle.', \''.$this->object.'|importPayments\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, false, \'' . translate('Імпорт виплат за вимогами за період') . '\', false, \'\');'?>
                <? if ($this->permissions['updateClassification']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action17\', document.'.$this->objectTitle.', \''.$this->object.'|loadChangeResponsible\', \'/images/administration/navigation/change_persons.gif\', \'/images/administration/navigation/change_persons_over.gif\', \'\', \'/images/administration/navigation/change_persons_dim.gif\', true, false, true, true, \'Змінити відповідальних\', false, \'\');'?>
                document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                // -->
            </script>
            <? } ?>
        </td>
    </tr>
    </table>
</div>
<script type="text/javascript">
	function setChecked(id, name, value) {
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            data:		'do=Accidents|setCheckedInWindow' +
                        '&product_types_id=' + $('input[name=product_types_id]').val() +
                        '&id=' + id +
                        '&name=' + name +
                        '&value=' + value,
            success: 	function(result) {
                            alert( result.text );
                            if ( result.type == 'error') {
                                $('input[type=checkbox][name=' + name + '\[' + id + '\]]').attr('checked', !$('input[type=checkbox][name=' + name + '\[' + id + '\]]').attr('checked'));
                            }
                        }
        });
    }
	
    $('input[type=checkbox][name^=master_documents]').bind('click', function() {
        value = $(this).attr('name').match(/\[[0-9]*\]/ig);
        id = value[ 0 ].substr( 1, value[ 0 ].length - 2);
        value = ($(this).attr('checked')) ? 1 : 0;
        setChecked(id, 'master_documents', value);
    })
	
	$('input[type=checkbox][name^=avr_sign]').bind('click', function() {
        value = $(this).attr('name').match(/\[[0-9]*\]/ig);
        id = value[ 0 ].substr( 1, value[ 0 ].length - 2);
        value = ($(this).attr('checked')) ? 1 : 0;
        setChecked(id, 'avr_sign', value);
    })

  
</script>
