<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Інформація ТіС:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getRepairInfo" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action11\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action11" src="/images/administration/navigation/import.gif" alt="Імпрот" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description" valign="bottom"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <td>
                                                        <b>Справа:</b><br>
                                                        <input type="text" name="accidents_number" value="<?=$data['accidents_number']?>" class="fldText" onmouseover="this.className='fldTextOver'" onmouseout="this.className='fldText'" />
                                                    </td>
                                                    <td>
                                                        <b>Власник:</b><br>
                                                        <input type="text" name="owner" value="<?=$data['owner']?>" class="fldText" onmouseover="this.className='fldTextOver'" onmouseout="this.className='fldText'" />
                                                    </td>
                                                    <td>
                                                        <b>VIN:</b><br>
                                                        <input type="text" name="shassi" value="<?=$data['shassi']?>" class="fldText" onmouseover="this.className='fldTextOver'" onmouseout="this.className='fldText'" />
                                                    </td>
                                                    <td>
                                                        <b>СТО:</b><br>
														<select name="car_services_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                            <option value="">...</option>
                                                            <?
                                                            foreach ($car_services as $car_service) {
                                                                   echo ($car_service['id'] == $data['car_services_id'])
                                                                    ? '<option value="' . $car_service['id'] . '" selected>' . $car_service['title'] . '</option>'
                                                                    : '<option value="' . $car_service['id'] . '">' . $car_service['title'] . '</option>';
                                                                }
                                                            ?>
														</select>
                                                    </td>
                                                    <td>
                                                        <b>AUDATEX:</b><br>
                                                        <input type="text" name="audatex_number" value="<?=$data['audatex_number']?>" class="fldText" onmouseover="this.className='fldTextOver'" onmouseout="this.className='fldText'" />
                                                    </td>
													<td><b>Дата калькуляції:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>calc" name="from_calc" value="<?=$data['from_calc']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>calc" name="to_calc" value="<?=$data['to_calc']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>                                                    
                                                </tr>
                                                <tr>
													<td colspan="5"></td>
													<td><b>Дата останнього оновлення інформації:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>exchange" name="from_exchange" value="<?=$data['from_exchange']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>exchange" name="to_exchange" value="<?=$data['to_exchange']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><input type="checkbox" name="groupby" <?=(($data['groupby']) ? 'checked' : '')?>>групувати</td>                                                    
                                                </tr>
												<tr>
													<td colspan="10" align="right"><input type="submit" class="button" value="Виконати" /></td>
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
                                        <td align="center">Власник</td>
                                        <td align="center">ТЗ</td>
                                        <td align="center">Держ. номер</td>
                                        <td align="center">VIN</td>
                                        <td align="center">СТО, назва</td>
                                        <td align="center">СТО, ЄДРПОУ</td>
                                        <td align="center">Номер калькуляції (AUDATEX)</td>
                                        <td align="center">Дата калькуляції</td>
                                        <td align="center">Сума калькуляції</td>
                                        <td align="center">Дата замовлення ЗЧ</td>
                                        <td align="center">Дата заказ-наряду (початкова)</td>
                                        <td align="center">Сума заказ-наряду (початкова)</td>
                                        <td align="center">Автор заказ-наряду (початкового)</td>
                                        <td align="center">Дата заказ-наряду (кінцева)</td>
                                        <td align="center">Сума заказ-наряду (кінцева)</td>
                                        <td align="center">Франшиза</td>
                                        <td align="center">Автор заказ-наряду (початкового)</td>
                                        <td align="center">Дата останнього обміну</td>
                                        <td align="center">Створено</td>
                                    </tr>
                                    <?
                                        foreach ($list as $row) {
                                    ?>
                                    <tr>
                                        <td align="center"><?=$row['accidents_number']?></td>
                                        <td align="center"><?=$row['insurer']?></td>
                                        <td align="center"><?=$row['item']?></td>
                                        <td align="center"><?=$row['sign']?></td>
                                        <td align="center"><?=$row['shassi']?></td>
                                        <td align="center"><?=$row['car_services_title']?></td>
                                        <td align="center"><?=$row['car_services_edrpou']?></td>
                                        <td align="center"><?=$row['number_audanet']?></td>
                                        <td align="center"><?=$row['document_date_format']?></td>
                                        <td align="center"><?=$row['amount']?></td>
                                        <td align="center"><?=$row['order_parts_date_format']?></td>
                                        <td align="center"><?=$row['order_outfit_begin_date_format']?></td>
                                        <td align="center"><?=$row['order_outfit_begin_amount']?></td>
                                        <td align="center"><?=$row['order_outfit_begin_author']?></td>
                                        <td align="center"><?=$row['order_outfit_end_date_format']?></td>
                                        <td align="center"><?=$row['order_outfit_end_amount']?></td>
                                        <td align="center"><?=$row['deductible_amount']?></td>
                                        <td align="center"><?=$row['order_outfit_end_author']?></td>
                                        <td align="center"><?=$row['last_date_exchange_format']?></td>
                                        <td align="center"><?=$row['created_format']?></td>
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
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getRepairInfoInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action11\', document.'.$this->objectTitle.', \'Accidents|importAccidentRepairInfo\', \'/images/administration/navigation/import.gif\', \'/images/administration/navigation/import_over.gif\', \'\', \'/images/administration/navigation/import_dim.gif\', true, true, true, true, \'Імпрот\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>