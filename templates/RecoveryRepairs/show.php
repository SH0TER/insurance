<script>

    function setShowMonitoring(val) {
        $('input[name=showMonitoring]').val(val);
    }

</script>

<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td></td>
        <td>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Accidents|show" />
            <input type="hidden" name="show" value="recovery" />
            <input type="hidden" name="showMonitoring" value="0" />
            <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
            <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
            <?=$this->getShowHiddenFields($data);?>
            <table width="100%" cellspacing="0" cellpadding="0">
            <? if (in_array(true, $this->permissions)) {?>
            <tr>
                <td height="28">
                    <table cellpadding="0" cellspacing="0">
                    <tr>
                        <? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
                        <? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
                        <? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
                        <? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
                        <? if ($this->permissions['export']) echo '<td width="22"><a href="javascript: setShowMonitoring(0); var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                        <? if ($this->permissions['export']) echo '<td width="22"><a href="javascript: setShowMonitoring(1); var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action7" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                        <td width="10"></td>
                        <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
                    </tr>
                    </table>
                </td>
                <td align="right">
                    <table cellpadding="0" cellspacing="5">
                        <tr>
                            <td><b>Архів:</b></td>
                            <td>
                                <select name="archive" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'">
                                    <option value="0">...</option>
                                    <option value="1" <?=($data['archive'] == 1 ? 'selected' : '')?> >В роботі</option>
                                    <option value="2" <?=($data['archive'] == 2 ? 'selected' : '')?> >Архів</option>
                                </select>
                            </td>
                            <td><b>СТО:</b></td>
                            <td>
                                <select name="car_services_id" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'">
                                    <?
                                        echo '<option value="0">...</option>';
                                        foreach ($car_services as $car_service) {
                                            echo '<option value="' . $car_service['id'] . '" ' . ($car_service['id'] == $data['car_services_id'] ? 'selected' : '') . '>' . $car_service['title'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><b>Номер справи:</b></td>
                            <td><input type="text" name="accidents_number" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" value="<?=$data['accidents_number']?>" /></td>
                            <td><b>Статус:</b></td>
                            <td>
                                <select name="statuses_id" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'">
                                    <?
                                        echo '<option value="0">...</option>';
                                        foreach ($this->statuses as $status) {
                                            echo '<option value="' . $status['id'] . '" ' . ($status['id'] == $data['statuses_id'] ? 'selected' : '') . '>' . $status['title'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><b>Державний номер:</b></td>
                            <td><input type="text" name="sign" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" value="<?=$data['sign']?>" /></td>
                            <td><b>VIN:</b></td>
                            <td><input type="text" name="shassi" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" value="<?=$data['shassi']?>" /></td>
                            <td><b>ПІБ:</b></td>
                            <td><input type="text" name="FIO" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" value="<?=$data['FIO']?>" /></td>
                            
                            <td valign="bottom">&nbsp;<input type="submit" value="Показати" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <? } ?>
            <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
            <tr>
                <td colspan="2">
                    <? if ($total) { ?>
                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr class="columns">
                            <td class="id"><input type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
                            <?=$this->getColumnTitles()?>
                        </tr>
                        <?
                            foreach ($list as $row) {
                                $i = 1 - $i;
                                
                                $row['status'] = $row['statuses_id'];
                                $row['statuses_id'] = $this->statuses[ $row['statuses_id'] ]['title'];
                                
                                if (intval($row['accident_messages_id'])) {
                                    $sql = 'SELECT answer FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($row['accident_messages_id']);
                                    $answer = unserialize($db->getOne($sql));
                                    
                                    $row['repair_classifications_id'] = $answer['repair_classifications_id'];
                                    $row['parts_classifications_id'] = $answer['parts_classifications_id'];
                                    $row['calc_amount'] = floatval($answer['amount_details'] + $answer['amount_material'] + $answer['amount_work']);
                                    $row['repair_parts'] = ((isset($answer['repair_parts']) && $answer['repair_parts'] == 'on') ? 'так' : 'ні');
                                    $row['is_repair_parts'] = ((isset($answer['repair_parts']) && $answer['repair_parts'] == 'on') ? 1 : 0);
                                }
                                
                                $row['persons'] = 'м - ' . $row['master_name'] . '<br />а - ' . $row['average_name'] . '<br />е - ' . $row['estimate_name'];
                                
                        ?>
                        <tr class="<?=$this->getRowClass($row, $i)?>">
                            <td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
                            <?=$this->getRowValues($data, $row, $hidden, $total)?>                          
                        </tr>
                        <? } ?>
                        </table>
                    <? } ?>
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
                <? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action7\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'Експорт (моніторинг)\', false, \'\');'?>
                document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
            // -->
            </script>
            <? } ?>
        </td>
    </tr>
    </table>
</div>