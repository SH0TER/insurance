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
                    <input type="hidden" name="do" value="Reports|getCertificateCargoObjects" />
                    <input type="hidden" name="product_types_id" value="<?=PRODUCT_TYPES_CARGO?>" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28" align="right">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
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
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                                    <td><b>Дата заключення:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
										<td>Страхувальник</td>
                                        <td>Номер</td>
                                        <td>Дата</td>
										<td>Об'єкт</td>
										<td>Сума, грн.</td>
										<td>Премія, грн.</td>
										<td>Початок</td>
										<td>Закінчення</td>
										<td>Статус</td>
										<td>Оплата</td>
										<td>Створено</td>
										<td>Редаговано</td>
                                    </tr>
                                    <?
                                        if (is_array($list)) {
                                            $i = 0;
                                            foreach ($list as $row) {
                                                $i = 1 - $i;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
										<td><?=$row['company']?></td>
                                        <td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
                                        <td><?=$row['date']?></td>
                                        <td><?=$row['object']?></td>
										<td align="right"><?=getMoneyFormat($row['price'], -1)?>&nbsp;</td>
										<td align="right"><?=getMoneyFormat($row['amount'], -1)?>&nbsp;</td>
										<td><?=$row['begin_datetime']?></td>
										<td><?=$row['end_datetime']?></td>
										<td><?=$row['policy_statusesTitle']?></td>
										<td><?=$row['payment_statusesTitle']?></td>
										<td><?=$row['created']?></td>
										<td><?=$row['modified']?></td>
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
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getCertificateCargoObjectsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                // -->
                </script>
            </td>
        </tr>
    </table>
</div>