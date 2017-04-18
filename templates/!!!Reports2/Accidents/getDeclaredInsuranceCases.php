<?$Log->showSystem() ?>
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
                    <input type="hidden" name="do" value="Reports|getDeclaredInsuranceCases" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                <td valign="bottom" class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
                            </td>
                            <td align="right">
                                <table>
                                    <tr>
                                        <td><b>Вид страхування: </b></td>
                                        <td>
                                            <select name="product_types_id" id="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                <option value="<?=PRODUCT_TYPES_KASKO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : '')?>>КАСКО</option>
                                                <option value="<?=PRODUCT_TYPES_GO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : '')?>>ОСЦПВ</option>
                                                <option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) ? 'selected' : '')?>>Майно</option>
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
                                                    else
                                                    echo "<option value = $i>".$i."</option>";}
                                            ?>
                                            </select>
                                        </td>
                                       <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr><td height="7" bgcolor="#D6D6D6" colspan="4"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                        <tr>
                            <td colspan="7">
                                <? if (sizeOf($list)) {?>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                                        <tr class="columns">
                                            <td>№ справи</td>
                                            <td>Страхувальник</td>
                                            <td>Номер договору</td>
                                            <td>Дата договору</td>
                                            <td>Об'єкт страхування</td>
                                            <? if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) { ?>
                                                <td>Майно</td>
                                            <?}else{?>
                                                <td>Державний номер</td>
                                            <?}?>
											<? if($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
											<td>Потерпілий</td>
											<td>ТЗ потерпілого</td>
											<td>Держ. номер ТЗ потерпілого</td>
											<? } ?>
                                            <td>Дата події</td>
                                            <td>Дата заяви</td>
                                            <td>Орієнтований збиток</td>
                                            <td>Фактично сплачено</td>
                                            <? if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) { ?>
                                                <td>Дата відмови</td>
                                                <td>Остання дата страхового відшкодування</td>
                                            <?}?>
                                            <td>Дата закриття справи</td>
                                            <td>Регрес</td>
                                            <td>Дата створення справи</td>
                                        </tr>
                                        <?
                                            $amount = 0;
                                            $color = 0;
                                            foreach ($list as $row) {
                                                echo '<tr>';
                                                $color = 1 - $color;
                                                echo '<tr class="' . $this->getRowClass($row, $color) . '">';
                                                echo '<td>' . $row['accidents_number'] . '</td>';
                                                echo '<td>' . $row['insurer'] . '</td>';
                                                echo '<td>' . $row['policies_number'] . '</td>';
                                                echo '<td>' . $row['policies_date'] .  '</td>';
                                                echo '<td>' . $row['item'] . '</td>';
                                                if($row['sign']!='') echo '<td>' . $row['sign'] .  '</td>'; else echo '<td>-</td>';
												if($data['product_types_id'] == PRODUCT_TYPES_GO) {
													echo '<td>' . $row['owner'] . '</td>';
													echo '<td>' . $row['owner_item'] . '</td>';
													echo '<td>' . $row['owner_sign'] . '</td>';
												}
                                                echo '<td>' . $row['datetime'] .  '</td>';
                                                echo '<td>' . $row['accidents_date'] .  '</td>';
                                                echo '<td>' . getRateFormat($row['amount_rough'], 2) .  '</td>';
                                                if($row['amount']!='') echo '<td>' . $row['amount'] .  '</td>'; else echo '<td>-</td>';
                                                if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) {
                                                    if($row['date_no']!='') echo '<td>' . $row['date_no'] .  '</td>'; else echo '<td>-</td>';
                                                    if($row['first_recovery_date']!='') echo '<td>' . $row['first_recovery_date'] .  '</td>'; else echo '<td>-</td>';
                                                }
                                                if($row['created']!='') echo '<td>' . $row['created'] .  '</td>'; else echo '<td>-</td>';
                                                if($row['regres']==0) echo '<td>Ні</td>'; else echo '<td>Так</td>';
												if($row['accidents_created']!='') echo '<td>' . $row['accidents_created'] .  '</td>'; else echo '<td>-</td>';
                                                echo '</tr>';
                                                $amount_rough = $amount_rough + $row['amount_rough'];

                                                if($row['amount'] != '' ){
                                                    $amounts_str = explode('<br>', $row['amount']);
                                                    for($i=0; $i<sizeof($amounts_str); $i++){
                                                       $amount += str_replace(',', '.', $amounts_str[$i]);
                                                    }
                                                }
                                            }
                                        ?>
                                        <tr class="navigation">
                                            <td class="paging">Всьго: <?=(sizeof($list))?></td>
                                            <td colspan="<?=($data['product_types_id'] == PRODUCT_TYPES_GO ? '10' : '7')?>">&nbsp;</td>
                                            <td class="paging" align="right"><?=getMoneyFormat($amount_rough)?></td>
                                            <td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
                                            <?if($data['product_types_id'] == PRODUCT_TYPES_PROPERTY){?>
                                                <td colspan="2">&nbsp;</td>
                                            <?}?>
                                        </tr>
                                    </table>
                                <?}?>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getDeclaredInsuranceCasesInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>