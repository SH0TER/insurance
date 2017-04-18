<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="bullet">
            <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
            ?>
        </td>
        <td class="caption">Сертифікати добровільного страхування вантажів та багажу (вантажобагажу). Об'єкти:</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td>
                        <b>Страхувальник:</b>
                        <?
                            echo '<select name="clients_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                            echo '<option value="">...</option>';
                            foreach ($clients as $client) {
                                echo '<option value="' . $client['id'] . '" ' . (($client['id'] == $data['clients_id']) ? 'selected' : '') . '>' . $client['company'] . '</option>';
                            }
                            echo '</select>';
                        ?>
                    </td>
                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                    <td><b>Дата заключення:</b></td>
                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonover';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
</div>