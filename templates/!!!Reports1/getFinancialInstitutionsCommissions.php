<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="bullet">
            <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
            ?>
        </td>
        <td class="caption">Комісія по договорах (Глушак Юлія):</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$this->object?>|getFinancialInstitutionsCommissions" />
                <input type="hidden" name="InWindow" value="true" />
                <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right">
                        <table cellpadding="0" cellspacing="5">
                        <tr>
                            <td>Вид страхування:</td>
                            <td>
                                <select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';">
                                    <option value=<?=PRODUCT_TYPES_KASKO?> <?=(($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : '')?>>КАСКО</option>
                                    <option value=<?=PRODUCT_TYPES_GO?> <?=(($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : '')?>>ОСЦПВ</option>
                                    <option value=<?=PRODUCT_TYPES_NS?> <?=(($data['product_types_id'] == PRODUCT_TYPES_NS) ? 'selected' : '')?>>Нещасний випадок</option>
                                    <option value=<?=PRODUCT_TYPES_MORTAGE?> <?=(($data['product_types_id'] == PRODUCT_TYPES_MORTAGE) ? 'selected' : '')?>>Іпотека</option>
                                    <option value=<?=PRODUCT_TYPES_PROPERTY?> <?=(($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) ? 'selected' : '')?>>Майно</option>
                                </select>
                            </td>
                            <td><b>Дата платежу:</b></td>
                            <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                            <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                            <td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonover';" onMouseOut="this.className = 'button';" /></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>
            </form>
        </td>
    </tr>
    </table>
</div>
