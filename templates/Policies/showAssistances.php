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
                <tr>
                    <td height="28">
                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right">
                                <table cellpadding="0" cellspacing="5">
                                <tr>
                                    <td>
                                        <b>Агенція:</b>
                                        <?
                                        echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
                                        echo '<option value="">...</option>';
                                        foreach ($agencies as $agency) {
                                            echo ($agency['id'] == $data['agencies_id'])
                                            ? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', $agency['level'] * 3) . $agency['title'] . '</option>'
                                            : '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', $agency['level'] * 3) . $agency['title'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td>
                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                    <td><b>Страхувальник:</b> <input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" class="fldText lastname" onfocus="this.className='fldTextOver lastname';" onblur="this.className='fldText lastname';" /></td>
                                </tr>
                                </table>
                                <table cellpadding="0" cellspacing="5">
                                <tr>
                                    <td><b>Об'єкт:</b> <input type="text" name="item" value="<?=$data['item']?>" class="fldText lastname" onfocus="this.className='fldTextOver lastname';" onblur="this.className='fldText lastname';" /></td>
                                    <td><b>Рік випуску:</b> <input type="text" name="year" value="<?=$data['year']?>" class="fldText year" onfocus="this.className='fldTextOver year';" onblur="this.className='fldText year';" /></td>
                                    <td><b>№ шасі (кузов, рама):</b> <input type="text" name="shassi" value="<?=$data['shassi']?>" class="fldText shassi" onfocus="this.className='fldTextOver shassi';" onblur="this.className='fldText shassi';" /></td>
                                    <td><b>Державний знак (реєстраційний №):</b> <input type="text" name="sign" value="<?=$data['sign']?>" class="fldText number" onfocus="this.className='fldTextOver number';" onblur="this.className='fldText number';" /></td>
                                    <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
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
        </td>
    </tr>
    </table>
</div>