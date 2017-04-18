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
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$this->object?>|show" />
                <input type="hidden" name="id" value="<?=$data['id']?>" />
                <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                <?=$this->getShowHiddenFields($data)?>
                <table width="100%" cellspacing="0" cellpadding="0">
                <? if (in_array(true, $this->permissions)) {?>
                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="bottom">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                                <? if ($this->permissions['insert']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/add.gif" alt="' . translate('Add') . '" /></a></td>'?>
                                                <? if ($this->permissions['import']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/import.gif" alt="' . translate('Import') . '" /></a></td>'?>
                                                <? if ($this->permissions['update']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/edit.gif" alt="' . translate('Edit') . '" /></a></td>'?>
                                                <? if ($this->permissions['changeStatus']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/change_status.gif" alt="Змінити статус" /></a></td>'?>
                                                <? if ($this->permissions['reset']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/reset_status.gif" alt="Перевести в статус &quote;Створено&quote;" /></a></td>'?>
                                                <? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
                                                <? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
                                                <? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action7" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
                                                <? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
												<? if ($this->permissions['export'] && in_array($Authorization->data['id'], array(1, 7126, 9698))) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ExportList\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ExportList\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ExportList\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ExportList" src="/images/administration/navigation/export.gif" alt="Експорт (форма)" /></a></td>'?>
                                                <? if ($this->permissions['importCertificates']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action10" src="/images/administration/navigation/import.gif" alt="' . translate('Import') . '" /></a></td>'?>
                                                <? if ($this->permissions['payments']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action9" src="/images/administration/navigation/payments.gif" alt="' . translate('Payments') . '" /></a></td>'?>
                                            <td width="10"></td>
                                            <td class="description" style="width: 100px;"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="100" height="1" alt="" /></div></div></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="right">
                                    <table cellpadding="0" cellspacing="5" border="0">
                                    <tr>
                                        <td  align="right"><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                        <td  align="right">
                                        <?
                                            if ($Authorization->data['roles_id'] != ROLES_CLIENT_CONTACT) {
                                                echo '<b>Клієнт:</b> ';
                                                echo '<select name="clients_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
                                                echo '<option value="">...</option>';
                                                foreach ($clients as $client) {
                                                    echo ($client['id'] == $data['clients_id'])
                                                        ? '<option value="' . $client['id'] . '" selected>' . $client['company'] . '</option>'
                                                        : '<option value="' . $client['id'] . '">' . $client['company'] . '</option>';
                                                }
                                                echo '</select>';
                                            }
                                        ?>
                                        </td>
                                        <td rowspan="2"><b>Статус:</b> <?=$fields['policy_statuses_id']['object']?></td>
                                        <td rowspan="2"><b>Оплата:</b> <?=$fields['payment_statuses_id']['object']?></td>
                                    </tr>
                                    <tr>
                                        <td valign="bottom" colspan="2" align="right"><b>№ шасі:</b> <input type="text" name="itemsShassi" value="<?=$data['itemsShassi']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                    </tr>
                                    </table>
                                    <table cellpadding="0" cellspacing="5">
                                    <tr>
                                        <td><b>Дата cертифікату:</b></td>
                                        <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        <td><b>Початок дії:</b></td>
                                        <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>begin_datetime" name="frombegin_datetime" value="<?=$data['frombegin_datetime']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>begin_datetime" name="tobegin_datetime" value="<?=$data['tobegin_datetime']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        <td><img src="/images/message.gif" width="19" height="19" alt="Ручні повідомлення" /></td>
                                        <td nowrap><b>Ручні повідомлення:</b> <input type="checkbox" name="manual" value="1" <?=($data['manual'] == 1) ? 'checked' : ''?> /></td>
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
                        <?
                            }
                            if (is_array($data['total'])) {
                        ?>
                        <tr class="total">
                            <td colspan="4">&nbsp;</td>
                            <td align="right"><?=getMoneyFormat($data['total']['price'])?> &nbsp;</td>
                            <td align="right"><?=getMoneyFormat($data['total']['amount'])?> &nbsp;</td>
                            <td colspan="8">&nbsp;</td>
                        </tr>
                        <? } ?>
                        </table>
                        <? }?>
			<?
                            if ($data['do'] == 'Policies|view') {
                                $hidden = $data['hidden'];
                            }                        
                        ?>
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
                <? if ($this->permissions['import']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action1\', document.'.$this->objectTitle.', \''.$this->object.'|import\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, true, \'' . translate('Import') . '\', false, \'\');'?>
                <? if ($this->permissions['update']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action2\', document.'.$this->objectTitle.', \''.$this->object.'|load\', \'/images/administration/navigation/edit.gif\', \'/images/administration/navigation/edit_over.gif\', \'\', \'/images/administration/navigation/edit_dim.gif\', true, false, true, false, \'' . translate('Edit') . '\', false, \'\');'?>
                <? if ($this->permissions['changeStatus']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|loadStatus\', \'/images/administration/navigation/change_status.gif\', \'/images/administration/navigation/change_status_over.gif\', \'\', \'/images/administration/navigation/change_status_dim.gif\', true, false, true, true, \'Змінити статус\', false, \'\');'?>
                <? if ($this->permissions['reset']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action4\', document.'.$this->objectTitle.', \''.$this->object.'|resetPolicyStatus\', \'/images/administration/navigation/reset_status.gif\', \'/images/administration/navigation/reset_status_over.gif\', \'\', \'/images/administration/navigation/reset_status_dim.gif\', true, false, true, false, \'Перезапустити\', true, \'Ви насправді хочете перевести сертифікат в статус "Створено"?\');'?>
                <? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
                <? if ($this->permissions['change']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|change\', \'/images/administration/navigation/change.gif\', \'/images/administration/navigation/change_over.gif\', \'\', \'/images/administration/navigation/change_dim.gif\', true, true, true, true, \'' . translate('Change') . '\', true, \'' . translate('Are you sure you want to change all this records?') . '\');'?>
                <? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action7\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
                <? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				<? if ($this->permissions['export'] && in_array($Authorization->data['id'], array(1, 7126, 9698))) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ExportList\', document.'.$this->objectTitle.', \''.$this->object.'|exportListInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'Експорт (форма)\', false, \'\');'?>
                <? if ($this->permissions['importCertificates']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action10\', document.'.$this->objectTitle.', \''.$this->object.'|importCertificates\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, true, \'' . translate('Import') . '\', false, \'\');'?>
                <? if ($this->permissions['payments']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action9\', document.'.$this->objectTitle.', \''.$this->object.'|updatePayments\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/payments_dim.gif\', true, true, true, true, \'' . translate('Payments') . '\', false, \'\');'?>
                document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                // -->
            </script>
            <? } ?>
        </td>
    </tr>
    </table>
</div>