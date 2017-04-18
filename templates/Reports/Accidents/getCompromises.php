<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Прийняття компромісного рішення:</td>
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
                        <?if(in_array(44, $Authorization->data['account_groups_id']) || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR){?>
                            <td><b>Реєстр</b></td>
                            <td>
                                <select name="register" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                    <option value="1" <?=(($data['register'] == 1) ? 'selected' : '')?>>для Ассістант</option>
                                    <option value="2" <?=(($data['register'] == 2) ? 'selected' : '')?>>повний по компромісу</option>
                                </select>
                            </td>
                        <?}?>
                        <td><b>Дата переведення в статус "погодження КР":</b></td>
                        <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                    </tr>
                    </table>
                </form>
                </div>
            </td>
        </tr>
    </table>
</div>
<div style="color: white;"><?=$time?></div>