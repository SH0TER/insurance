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
        <td align="right">
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
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
                    <td colspan="6" align="right"><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
</div>