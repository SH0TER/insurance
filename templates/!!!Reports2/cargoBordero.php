<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Сертифікати добровільного страхування вантажів та багажу (вантажобагажу). Бордеро премій:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getCargoBordero" />
                    <input type="hidden" name="product_types_id" value="<?=PRODUCT_TYPES_CARGO?>" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28" align="right">
                                <table cellpadding="0" cellspacing="5">
                                    <tr>
                                        <td>
                                            <b>Марка:</b>
                                            <?
                                            echo '<select name="brands_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                            echo '<option value="">...</option>';
                                            foreach ($brands as $brand) {
                                                echo '<option value="' . $brand['id'] . '" ' . (($brand['id'] == $data['brands_id']) ? 'selected' : '') . '>' . $brand['title'] . '</option>';
                                            }
                                            echo '</select>';
                                            ?>
                                        </td>
                                        <td>
                                            <b>Клієнт:</b>
                                            <?
                                            echo '<select name="clients_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                            echo '<option value="">...</option>';
                                            foreach ($clients as $client) {
                                                echo '<option value="' . $client['id'] . '" ' . (($client['id'] == $data['clients_id']) ? 'selected' : '') . '>' . $client['company'] . '</option>';
                                            }
                                            echo '</select>';
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                                    <td><b>Дата заключення:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>

                                                    <td><b>Дата початку дії:</b></td>
                                                    <td>&nbsp;з <input type="text" id="beginFrom<?=$this->objectTitle?>" name="beginFrom" value="<?=$data['beginFrom']?>" class="fldDate" onfocus="this.className='fldDateOver';" onblur="this.className='fldDate';" /></td>
                                                    <td id="beginFrom<?=$this->objectTitle?>Button" class="fldDateButton"><img src="/images/pixel.gif" width="20" height="20" alt="З" /></td>
                                                    <td>&nbsp;до <input type="text" id="beginTo<?=$this->objectTitle?>" name="beginTo" value="<?=$data['beginTo']?>" class="fldDate" onfocus="this.className='fldDateOver';" onblur="this.className='fldDate';" /></td>
                                                    <td id="beginTo<?=$this->objectTitle?>Button" class="fldDateButton"><img src="/images/pixel.gif" width="20" height="20" alt="До" /></td>

                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="beginFrom" value="<?=$data['beginFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="beginTo" value="<?=$data['beginTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>


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
                                        <td colspan="3">Сертифікат</td>
                                        <td rowspan="2">Модель</td>
                                        <td rowspan="2">Номер кузова(шасі)</td>
                                        <td rowspan="2">Вартість вантажу, грн.</td>
                                        <td rowspan="2">Страхова сума, грн.</td>
                                    </tr>
                                    <tr class="columns">
                                        <td>№</td>
                                        <td>Дата заключення</td>
                                        <td>№ документу</td>
                                    </tr>
                                    <?
                                        if (is_array($list)) {
                                            $i = 0;
                                            foreach ($list as $row) {
                                                $i = 1 - $i;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><a href="/?do=Policies|view&id=<?=$row['policies_id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
                                        <td>&nbsp;<?=$row['date_format']?></td>
                                        <td>&nbsp;<?=$row['document_number']?> від <?=$row['document_date_format']?></td>
                                        <td>&nbsp;<?=$row['model'] ?></td>
                                        <td>&nbsp;<?=$row['shassi']?></td>
                                        <td style="text-align: right; padding-right: 10px;"><?=getMoneyFormat($row['price'], -1)?></td>
                                        <td style="text-align: right; padding-right: 10px;"><?=getMoneyFormat($row['price'], -1)?></td>
                                    </tr>
                                    <?
                                            }
                                        }
                                    ?>
                                </table>
                                <? }?>
                                <div class="navigation">
                                    <div class="paging">Всьго: <?=$total?></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getCargoBorderoInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                // -->
                </script>
            </td>
        </tr>
    </table>
</div>