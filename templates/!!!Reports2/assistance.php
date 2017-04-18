<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Асiстанс, поліси страхування:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getAssistance" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
													<td>
														<b>Вид страхування:</b>
														<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
															<option value="">...</option>
															<option value="<?=PRODUCT_TYPES_KASKO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : ''?>>КАСКО</option>
															<option value="<?=PRODUCT_TYPES_GO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : ''?>>ЦВ</option>
														</select>
													</td>
													<td><b>Картка:</b></td><td><input type="text" name="card_assistance" value="<?=$data['card_assistance']?>" class="fldText"/></td>
                                                    <td><b>Дата:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
                                <? if (sizeof($list)) {?>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr class="columns">
                                        
                                        <td rowspan="2">ПІБ клієнта</td>
										<td rowspan="2">Номер</td>
                                        <td rowspan="2">Марка ТЗ</td>
                                        <td rowspan="2">Модель ТЗ</td>
                                        <td rowspan="2">Номер кузова (шасі)</td>
                                        <td rowspan="2">Номер Сервісної картки</td>
                                        <td colspan="2">Період обслуговування</td>
										<td rowspan="2">Тип договору</td>
                                    </tr>
                                    <tr class="columns">
                                       <td>Дата початку</td>
                                       <td>Дата закінчення</td>
                                    </tr>
                                        <?
                                        if (is_array($list)) {
                                            $i = 0;
                                            foreach ($list as $row) {
                                                $i = 1 - $i;
                                                ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$row['insurer']?></td>
										<td><?=$row['number']?></td>
										<td><?=$row['brand']?></td>
										<td><?=$row['model']?></td>
										<td><?=$row['shassi']?></td>
										<td x:str><?=$row['card_assistance']?></td>
										<td><?=$row['begin_datetimeFormat']?></td>
										<td><?=$row['end_datetimeFormat']?></td>
										<td><?=$row['products_title']?></td>
                                    </tr>
                                    <?
                                            }
                                        }
                                    ?>
                                </table>
                                <? }?>
                                
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
					document.<?=$this->objectTitle?>.buttons = new Array();
					<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAssistanceInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
					document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
					MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>