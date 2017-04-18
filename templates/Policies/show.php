<script type="text/javascript">
    function setChecked(id, name, value) {
<?if ($_SESSION['auth']['roles_id']!=ROLES_AGENT) {?>
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            data:		'do=Policies|setCheckedInWindow' +
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
<? } ?>
    }

    function setComment(id, policy_comment) {
<?if ($_SESSION['auth']['roles_id']!=ROLES_AGENT) {?>
        policy_comment = prompt('Введіть коментар', policy_comment);
        if (policy_comment==null) return;
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            data:		'do=Policies|setCommentInWindow' +
                        '&id=' + id +
                        '&policy_comment=' + policy_comment,
            success: 	function(result) {
                            switch (result.type) {
                                case 'confirm':
                                    $('#policy_comment' + id).html(policy_comment);
                                    break;
                                case 'error':
                                    alert(result.text);
                                    break;
                            }
                        }
        });
<? } ?>
    }
</script>
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
					<input type="hidden" name="redirect" value="<?=$_SERVER['PHP_SELF']?>?do=<?=$this->object?>|show&product_types_id=<?=$data['product_types_id']?>" />
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
                                                    <? if ($this->permissions['copy']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action11" src="/images/administration/navigation/copy.gif" alt="' . translate('Copy') . '" /></a></td>'?>
                                                    <? if ($this->permissions['changeStatus']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action2\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action2" src="/images/administration/navigation/change_status.gif" alt="Змінити статус" /></a></td>'?>
													<? if ($this->permissions['reset']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action3\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action3" src="/images/administration/navigation/reset_status.gif" alt="Перевести в статус &quote;Створено&quote;" /></a></td>'?>
                                                    <? if ($this->permissions['view']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action4\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action4" src="/images/administration/navigation/view.gif" alt="' . translate('View') . '" /></a></td>'?>
                                                    <? if ($this->permissions['change']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action5\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action5" src="/images/administration/navigation/change.gif" alt="' . translate('Change') . '" /></a></td>'?>
                                                    <? if ($this->permissions['delete']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action6\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action6" src="/images/administration/navigation/delete.gif" alt="' . translate('Delete') . '" /></a></td>'?>
                                                    <? if ($this->permissions['export']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action7\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action7" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                                    <? if ($this->permissions['exportActions']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action8\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action8" src="/images/administration/navigation/export.gif" alt="Експорт перевірки полісів" /></a></td>'?>
                                                    <? if ($this->permissions['payments']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action9\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action9" src="/images/administration/navigation/payments.gif" alt="' . translate('Payments') . '" /></a></td>'?>
													<? if ($this->permissions['documents']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action10\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action10" src="/images/administration/navigation/payments.gif" alt="Документи" /></a></td>'?>
													<? if ($this->permissions['transfer']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (out) out.out(); return true;"><img height="19" width="19" border="0" name="'.$this->objectTitle.'Action11" src="/images/administration/navigation/transfer.gif" alt="Змiнити менеджера" /></a></td>'?>
													<? if ($this->permissions['importMTSBU']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionImportMTSBU\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionImportMTSBU\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionImportMTSBU\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionImportMTSBU" src="/images/administration/navigation/payments.gif" alt="Імпорт в МТСБУ" /></a></td>'?>
                                                    <td width="10"></td>
                                                    <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5" border="0">
                                                <tr>
                                                    <td align="right" valign="bottom">
														<?
															if ($Authorization->data['roles_id'] != ROLES_AGENT || $Authorization->data['agencies_id']==SELLER_AGENCIES_ID) {
																echo '<b>Агенція:</b> ';
																echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
																echo '<option value="">...</option>';
																foreach ($agencies as $agency) {
																	echo ($agency['id'] == $data['agencies_id'])
																		? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
																		: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
																}
																echo '</select>';
															}
                                                        ?>
													</td>
                                                    <td valign="bottom" <?if (intval($_SESSION['auth']['agent_financial_institutions_id'])==0) {?>rowspan="2"<?}?>><b>Статус:</b> <?=$fields['policy_statuses_id']['object']?></td>
                                                    <td valign="bottom" <?if (intval($_SESSION['auth']['agent_financial_institutions_id'])==0) {?>rowspan="2"<?}?>><b>Оплата:</b> <?=$fields['payment_statuses_id']['object']?></td>
                                                </tr>
												<?if ($Authorization->data['top_agencies_id'] != 245) {?>
												<?if (intval($_SESSION['auth']['agent_financial_institutions_id'])==0) {?>
												<tr>
													<td align="right" valign="bottom">
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
												</tr>
												<?}?>
												<tr>
													<td align="right" colspan="3">
                                                        <b>Вид страхування:</b>
                                                        <select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <option value="3" <?=($data['product_types_id'] == 3) ? 'selected' : ''?>>КАСКО</option>
                                                            <? if ($Authorization->data['top_agencies_id'] == 556 || $Authorization->data['top_agencies_id'] == 560) { ?><option value="10" <?=($data['product_types_id'] == 10) ? 'selected' : ''?>>Генеральні договори добровільного страхування наземних ТЗ</option><? } ?>
                                                            <?if ($Authorization->data['top_agencies_id'] != 561 &&  $Authorization->data['top_agencies_id'] != 417 && $Authorization->data['top_agencies_id'] != 423) {?><option value="4" <?=($data['product_types_id'] == 4) ? 'selected' : ''?>>ОСЦПВ</option><?}?>
															<?if ($Authorization->data['top_agencies_id'] != 846 && $Authorization->data['top_agencies_id'] != 846 && $Authorization->data['top_agencies_id'] != 1254) {?>
															<?if ($Authorization->data['top_agencies_id'] != 563 && $Authorization->data['top_agencies_id'] != 417) {?>
                                                            <option value="7" <?=($data['product_types_id'] == 7) ? 'selected' : ''?>>ДСЦВ</option>
                                                            <option value="6" <?=($data['product_types_id'] == 6) ? 'selected' : ''?>>Добровільне страхування квартири та відповідальності</option>
															<?}?>
                                                            <option value="12" <?=($data['product_types_id'] == 12) ? 'selected' : ''?>>Майно</option>
															<?}?>
															<?if ($Authorization->data['top_agencies_id'] != 563) {?>
                                                            <option value="13" <?=($data['product_types_id'] == 13) ? 'selected' : ''?>><?=$Authorization->data['top_agencies_id'] == 417 || $Authorization->data['top_agencies_id'] == 1254 || $Authorization->data['top_agencies_id'] == 846 ? 'Страхування життя' : 'Cтрахування від нещасних випадків'?></option>
															<option value="23" <?=($data['product_types_id'] == 23) ? 'selected' : ''?>>Cтрахування від нещасних випадків на транспорті</option>
															<?if ($Authorization->data['top_agencies_id'] != 417) { ?>
															<option value="15" <?=($data['product_types_id'] == 15) ? 'selected' : ''?>>Майно iпотека</option>
															<?}?>
															<?}?>
															<option value="16" <?=($data['product_types_id'] == 16) ? 'selected' : ''?>>Добровільне страхування відповідальності перевізника</option>
															<option value="17" <?=($data['product_types_id'] == 17) ? 'selected' : ''?>>Добровільне страхування цивільної відповідальності перед третіми особами</option>
															<option value="18" <?=($data['product_types_id'] == 18) ? 'selected' : ''?>>Добровільне страхування цивільної відповідальності перед третіми особами (проф. відповідальність)</option>
															<option value="19" <?=($data['product_types_id'] == 19) ? 'selected' : ''?>>Нещасні випадки на транспорті юр. особами</option>
															<option value="20" <?=($data['product_types_id'] == 20) ? 'selected' : ''?>>Небезпечні об'єкти</option>
															<option value="21" <?=($data['product_types_id'] == 21) ? 'selected' : ''?>>Разове вантажоперевезення</option>
                                                            <option value="22" <?=($data['product_types_id'] == 22) ? 'selected' : ''?>>ДМС</option>
                                                        </select>
														<?if (intval($_SESSION['auth']['agent_financial_institutions_id'])==0) {?>
														<? if ($data['product_types_id'] == 22) { ?>
                                                        <b>СК:</b>
														<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="">...</option>
															<option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ "Експрес страхування"</option>
															<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
															<option value="<?=9?>" <?=($data['insurance_companies_id'] == 9) ? 'selected' : ''?>>ПрАТ «Сатис»</option>
														</select>
														<? } ?>
														<? if ($data['product_types_id']==PRODUCT_TYPES_KASKO) { ?>
                                                        <b>cпеціальні умови:</b><input type="checkbox" name="special" value="1" <?=($data['special'] ? 'checked': '')?>>&nbsp;&nbsp;
														<b>тест драйв:</b><input type="checkbox" name="options_test_drive" value="1" <?=($data['options_test_drive'] ? 'checked': '')?>>&nbsp;&nbsp;
														<b>перегон:</b><input type="checkbox" name="options_race" value="1" <?=($data['options_race'] ? 'checked': '')?>>
														<?}?>
														<?}?>
													</td>
												</tr>
												<?}?>
                                            </table>
                                            <? if(in_array($data['product_types_id'], array(PRODUCT_TYPES_GO, PRODUCT_TYPES_KASKO))) { ?>
                                                <table cellpadding="0" cellspacing="5">
                                                    <tr>
                                                        <td><b>Шасі/VIN:</b> <input type="text" name="shassi" value="<?=$data['shassi']?>" class="fldText shassi" onfocus="this.className='fldTextOver shassi';" onblur="this.className='fldText shassi'" /></td>
                                                        <td><b>Державний номер:</b> <input type="text" name="sign" value="<?=$data['sign']?>" class="fldText sign" onfocus="this.className='fldTextOver sign';" onblur="this.className='fldText sign'" /></td>
                                                    </tr>
                                                </table>
                                            <? } ?>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                                    <td><b>Страхувальник:</b> <input type="text" name="insurer" value="<?=$data['insurer']?>" class="fldText lastname" onfocus="this.className='fldTextOver lastname';" onblur="this.className='fldText lastname';" /></td>
                                                    <td><b>Коментар:</b> <input type="text" name="policy_comment" value="<?=$data['policy_comment']?>" class="fldText lastname" onfocus="this.className='fldTextOver lastname';" onblur="this.className='fldText lastname';" /></td>
                                                    <td><b>Дата полісу:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" maxlength="10" class="fldDatePicker" onfocus="this.className='fldDatePickerOver'" onblur="this.className='fldDatePicker'" /></td>
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
										<td class="" <? if (in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) {?>colspan="2"<?}?>><a href="">Коментар</a></td>
                                    </tr>
                                    <?
                                        foreach ($list as $row) {
                                            $i = 1 - $i;
											
											/*$sql = 'SELECT count(*) FROM ' . PREFIX . '_policy_messages WHERE policies_id = ' . intval($row['id']);
											$countMessages = $db->getOne($sql);
											
											$sql = 'SELECT count(distinct messages_id) FROM ' . PREFIX . '_policy_message_views WHERE policies_id = ' . intval($row['id']) . ' AND accounts_id = ' . intval($Authorization->data['id']);
											$countMessagesView = $db->getOne($sql);
											
											if ($countMessages > $countMessagesView && ($data['product_types_id'] == 3|| $data['product_types_id'] == 4)) $row['message'] = 1;*/
											
                                    ?>
                                    <tr class="<?=$this->getRowClass($row, $i)?>">
                                        <td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
                                        <?=$this->getRowValues($data, $row, array_merge($hidden, array('product_types_id' => $row['productTypesId'])), $total)?>
										<td id="policy_comment<?=$row['id']?>"><?=$row['policy_comment']?></td>
									    <?if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) {?><td><a title="<?=$row['comment_user']?>" href="javascript:setComment(<?=$row['id']?>, <?=$db->quote($row['policy_comment'])?>)"><img src="/images/administration/navigation/edit_over.gif" width="19" height="19" alt="Редагувати коментар" /></a></td><?}?>
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
                    <? if ($this->permissions['copy']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action11\', document.'.$this->objectTitle.', \''.$this->object.'|copy\', \'/images/administration/navigation/copy.gif\', \'/images/administration/navigation/copy_over.gif\', \'\', \'/images/administration/navigation/copy_dim.gif\', true, false, true, false, \'' . translate('Copy') . '\', false, \'\');'?>
                    <? if ($this->permissions['changeStatus']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action2\', document.'.$this->objectTitle.', \''.$this->object.'|loadStatus\', \'/images/administration/navigation/change_status.gif\', \'/images/administration/navigation/change_status_over.gif\', \'\', \'/images/administration/navigation/change_status_dim.gif\', true, false, true, true, \'Змінити статус\', false, \'\');'?>
					<? if ($this->permissions['reset']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action3\', document.'.$this->objectTitle.', \''.$this->object.'|resetPolicyStatus\', \'/images/administration/navigation/reset_status.gif\', \'/images/administration/navigation/reset_status_over.gif\', \'\', \'/images/administration/navigation/reset_status_dim.gif\', true, false, true, false, \'Перезапустити\', true, \'Ви насправді хочете перевести поліс в статус "Створено"?\');'?>                   
                    <? if ($this->permissions['view']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action4\', document.'.$this->objectTitle.', \''.$this->object.'|view\', \'/images/administration/navigation/view.gif\', \'/images/administration/navigation/view_over.gif\', \'\', \'/images/administration/navigation/view_dim.gif\', true, false, true, false, \'' . translate('View') . '\', false, \'\');'?>
                    <? if ($this->permissions['change']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action5\', document.'.$this->objectTitle.', \''.$this->object.'|change\', \'/images/administration/navigation/change.gif\', \'/images/administration/navigation/change_over.gif\', \'\', \'/images/administration/navigation/change_dim.gif\', true, true, true, true, \'' . translate('Change') . '\', true, \'' . translate('Are you sure you want to change all this records?') . '\');'?>
                    <? if ($this->permissions['delete']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action6\', document.'.$this->objectTitle.', \''.$this->object.'|delete\', \'/images/administration/navigation/delete.gif\', \'/images/administration/navigation/delete_over.gif\', \'\', \'/images/administration/navigation/delete_dim.gif\', true, false, true, true, \'' . translate('Delete') . '\', true, \'' . translate('Are you sure you want to delete selected records?') . '\');'?>
                    <? if ($this->permissions['export']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action7\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    <? if ($this->permissions['exportActions']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action8\', document.'.$this->objectTitle.', \''.$this->object.'|exportActionsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'Експорт перевірки полісів\', false, \'\');'?>
                    <? if ($this->permissions['payments']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action9\', document.'.$this->objectTitle.', \''.$this->object.'|updatePayments\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/payments_dim.gif\', true, true, true, true, \'' . translate('Payments') . '\', false, \'\');'?>
					<? if ($this->permissions['documents111']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action10\', document.'.$this->objectTitle.', \''.$this->object.'|updateDocuments\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/payments_dim.gif\', true, true, true, true, \'Документи\', false, \'\');'?>
					<? if ($this->permissions['transfer']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action11\', document.'.$this->objectTitle.', \''.$this->object.'|loadTransfer\', \'/images/administration/navigation/transfer.gif\', \'/images/administration/navigation/transfer_over.gif\', \'\', \'/images/administration/navigation/transfer_dim.gif\', true, false, true, false, \'' . translate('Змінити менеджера') . '\', false, \'\');'?>
					<? if ($this->permissions['importMTSBU']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionImportMTSBU\', document.'.$this->objectTitle.', \''.$this->object.'|importMTSBU\', \'/images/administration/navigation/payments.gif\', \'/images/administration/navigation/payments_over.gif\', \'\', \'/images/administration/navigation/payments_dim.gif\', true, false, true, true, \'Імпорт в МТСБУ\', false, \'\');'?>
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
    $('input[type=checkbox][name^=documents]').bind('click', function() {
        value = $(this).attr('name').match(/\[[0-9]*\]/ig);
        id = value[ 0 ].substr( 1, value[ 0 ].length - 2);
        value = ($(this).attr('checked')) ? 1 : 0;
        setChecked(id, 'documents', value);
    })

    $('input[type=checkbox][name^=commission]').bind('click', function() {
        value = $(this).attr('name').match(/\[[0-9]*\]/ig);
        id = value[ 0 ].substr( 1, value[ 0 ].length - 2);
        value = ($(this).attr('checked')) ? 1 : 0;
        setChecked(id, 'commission', value);
    })
</script>