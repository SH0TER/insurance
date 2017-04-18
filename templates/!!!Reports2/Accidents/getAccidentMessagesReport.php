<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Задачі по страхових справах:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getAccidentMessagesReport" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description" valign="bottom"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
													<td>
                                                        <b>Справа:</b><br>
                                                        <input type="text" name="accidents_number" class="fldText" onmouseover="this.className='fldTextOver'" onmouseout="this.className='fldText'" />
                                                    </td>
                                                    <td rowspan="2">
                                                        <b>Виконавець:</b><br>
														<select name="recipients_id[]" multiple size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <?
                                                            foreach ($recipients as $recipient) {
                                                                   echo (in_array($recipient['id'], $data['recipients_id']))
                                                                    ? '<option value="' . $recipient['id'] . '" selected>' . $recipient['title'] . '</option>'
                                                                    : '<option value="' . $recipient['id'] . '">' . $recipient['title'] . '</option>';
                                                                }
                                                            ?>
														</select>
                                                    </td>
                                                    <td rowspan="2">
                                                        <b>Виконавець, організація:</b><br>
														<select name="recipient_organizations_id[]" multiple size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <?
                                                            foreach ($recipient_organizations as $recipient_organization) {
                                                                   echo (in_array($recipient_organization['id'], $data['recipient_organizations_id']))
                                                                    ? '<option value="' . $recipient_organization['id'] . '" selected>' . $recipient_organization['title'] . '</option>'
                                                                    : '<option value="' . $recipient_organization['id'] . '">' . $recipient_organization['title'] . '</option>';
                                                                }
                                                            ?>
														</select>
                                                    </td>
                                                    <td rowspan="2">
                                                        <b>Автор:</b><br>
														<select name="authors_id[]" multiple size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <?
                                                            foreach ($authors as $author) {
                                                                echo (in_array($author['id'], $data['authors_id']))
                                                                        ? '<option value="' . $author['id'] . '" selected>' . $author['title'] . '</option>'
                                                                        : '<option value="' . $author['id'] . '">' . $author['title'] . '</option>';
                                                                }
                                                            ?>
														</select>
                                                    </td>                                                    
                                                    <td rowspan="2">
                                                        <b>Тип:</b><br>
                                                        <select name="message_types_id[]" multiple size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <?
                                                            foreach ($message_types as $message_type) {
                                                                echo (in_array($message_type['id'], $data['message_types_id']))
                                                                        ? '<option value="' . $message_type['id'] . '" selected>' . $message_type['title'] . '</option>'
                                                                        : '<option value="' . $message_type['id'] . '">' . $message_type['title'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td rowspan="2">
                                                        <b>Статус:</b><br>
                                                        <select name="statuses_id[]" multiple size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <option value="<?=ACCIDENT_MESSAGE_STATUSES_QUESTION?>" <?=(in_array(ACCIDENT_MESSAGE_STATUSES_QUESTION, $data['statuses_id'])) ? 'selected' : ''?>>Задача</option>
                                                            <option value="<?=ACCIDENT_MESSAGE_STATUSES_ANSWER?>" <?=(in_array(ACCIDENT_MESSAGE_STATUSES_ANSWER, $data['statuses_id'])) ? 'selected' : ''?>>Рішення</option>
                                                            <option value="<?=ACCIDENT_MESSAGE_STATUSES_ERROR?>" <?=(in_array(ACCIDENT_MESSAGE_STATUSES_ERROR, $data['statuses_id'])) ? 'selected' : ''?>>Помилки</option>
                                                            <option value="<?=ACCIDENT_MESSAGE_STATUSES_INTERRUPTED?>" <?=(in_array(ACCIDENT_MESSAGE_STATUSES_INTERRUPTED, $data['statuses_id'])) ? 'selected' : ''?>>Перервано</option>
                                                        </select>
                                                    </td>
                                                </tr>
												<tr>
													<td>
														<b>Вид страхування:</b><br>
														<select name="product_types_id[]" multiple size="3" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <option value="<?=PRODUCT_TYPES_KASKO?>" <?=(in_array(PRODUCT_TYPES_KASKO, $data['product_types_id'])) ? 'selected' : ''?>>КАСКО</option>
                                                            <option value="<?=PRODUCT_TYPES_GO?>" <?=(in_array(PRODUCT_TYPES_GO, $data['product_types_id'])) ? 'selected' : ''?>>ОСЦПВ</option>
                                                        </select>
													</td>
												</tr>
                                                <tr>
                                                    <td colspan="6" align="right"><input type="submit" class="button" value="Виконати" /></td>
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
                                <table width="100%" cellpadding="5" cellspacing="0">
                                    <tr class="columns">
                                        <td align="center">Справа</td>
										<td align="center">Статус</td>
										<td align="center">Аварійний комісар</td>
                                        <td align="center">Тип</td>
                                        <td align="center">Статус</td>
                                        <td align="center">Автор</td>
                                        <td align="center">Виконавець</td>
                                        <td align="center">Виконавець, організація</td>
                                        <td align="center">Дата переведення справи в "Розгляд"</td>
                                        <td align="center">Дата постановки задачі</td>
                                        <td align="center">Дата рішення задачі</td>
                                        <td align="center">Тривалість виконання</td>
                                    </tr>
                                    <?
                                        foreach ($list as $row) {
                                    ?>
                                    <tr>
                                        <td align="center"><?=$row['accidents_number']?></td>
										<td align="center"><?=$row['accident_statuses_title']?></td>
										<td align="center"><?=$row['average_manager']?></td>
                                        <td align="center"><?=$row['message_types_title']?></td>
                                        <td align="center"><?=$row['statuses']?></td>
                                        <td align="center"><?=$row['author']?></td>
                                        <td align="center"><?=$row['recipient']?></td>
                                        <td align="center"><?=$row['recipient_organization']?></td>
                                        <td align="center"><?=$row['investigated_date']?></td>
                                        <td align="center"><?=$row['created_date']?></td>
                                        <td align="center"><?=$row['decision_date']?></td>
                                        <td align="center"><?=$row['days']?></td>
                                    </tr>
                                    <?
                                        }
                                    ?>
                                </table>
                                <div class="navigation">
                                    <div class="paging"><?=getPaging($data['offset' . $this->objectTitle . 'Block'], $_SESSION['auth']['records_per_page'], 7, $total, $hidden, 'offset' . $this->objectTitle . 'Block');?></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAccidentMessagesReportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>