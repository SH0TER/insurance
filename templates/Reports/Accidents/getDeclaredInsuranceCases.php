<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="bullet">
            <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
            ?>
        </td>
        <td class="caption">Заявлені страхові випадки за місяць:</td>
    </tr>
    <tr>
        <td></td>
        <td align="right">
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td><b>Вид страхування: </b></td>
                    <td>
                        <select name="product_types_id" id="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                            <option value="<?=PRODUCT_TYPES_KASKO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : '')?>>КАСКО</option>
                            <option value="<?=PRODUCT_TYPES_GO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : '')?>>ОСЦПВ</option>
                            <option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) ? 'selected' : '')?>>Майно</option>
							<option value="<?=PRODUCT_TYPES_CARGO_CERTIFICATE?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE) ? 'selected' : '')?> >Вантаж та багаж</option>
                        </select>
                    </td>
                    <td><b>Місяць: </b></td>
                    <td>
                        <select name="month[]" size="6" multiple="" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                            <option value="1" <?=(in_array(1, $data['month']) ? 'selected' : '')?>>Січень</option>
                            <option value="2" <?=(in_array(2, $data['month']) ? 'selected' : '')?>>Лютий</option>
                            <option value="3" <?=(in_array(3, $data['month']) ? 'selected' : '')?>>Березень</option>
                            <option value="4" <?=(in_array(4, $data['month']) ? 'selected' : '')?>>Квітень</option>
                            <option value="5" <?=(in_array(5, $data['month']) ? 'selected' : '')?>>Травень</option>
                            <option value="6" <?=(in_array(6, $data['month']) ? 'selected' : '')?>>Червень</option>
                            <option value="7" <?=(in_array(7, $data['month']) ? 'selected' : '')?>>Липень</option>
                            <option value="8" <?=(in_array(8, $data['month']) ? 'selected' : '')?>>Серпень</option>
                            <option value="9" <?=(in_array(9, $data['month']) ? 'selected' : '')?>>Вересень</option>
                            <option value="10" <?=(in_array(10, $data['month']) ? 'selected' : '')?>>Жовтень</option>
                            <option value="11" <?=(in_array(11, $data['month']) ? 'selected' : '')?>>Листопад</option>
                            <option value="12" <?=(in_array(12, $data['month']) ? 'selected' : '')?>>Грудень</option>
                        </select>
                    </td>
                    <td><b>Рік: </b></td>
                    <td>
                        <?
                            echo '<select name="year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                            $year = date("Y");
                            for ($i=2010; $i<=$year; $i++){
                                if ($i == $data['year']) echo"<option value = $i selected>".$i."</option>";
                                else echo "<option value = $i>".$i."</option>";
                            }
                        ?>
                        </select>
                    </td>
                   <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
</div>