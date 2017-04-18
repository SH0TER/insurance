<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">КАСКО. Бордеро премій:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getKASKOBordero" />
                    <input type="hidden" name="product_types_id" value="<?=PRODUCT_TYPES_KASKO?>" />
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
														<b>СК:</b> 
														<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
															<option value="">...</option>
															<option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ Експрес страхування</option>
															<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
														</select>
													</td>
                                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                                    <td><b>Дата  полiсу:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>1" name="from1" value="<?=$data['from1']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>1" name="to1" value="<?=$data['to1']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
	
                                                    <td><b>Дата  платежу:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>

                                                    <td><b>Дата  початку страхового періоду:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>2" name="from2" value="<?=$data['from2']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>2" name="to2" value="<?=$data['to2']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
                                        <td colspan="3">Договір страхування</td>
                                        <td rowspan="2">Страхувальник</td>
                                        <td rowspan="2">Об'єкт</td>
                                        <td rowspan="2">Номер шассі/кузова</td>
                                        <td rowspan="2">Держ. номер</td>
                                        <td colspan="2">Період страхування</td>
                                        <td rowspan="2">Страхова сума, грн.</td>
                                        <td colspan="3">Оплати</td>
                                        <td rowspan="2" width="60">Страхові випадки</td>
                                        <td rowspan="2">Рік</td>
                                        <td colspan="2">Франшиза</td>
                                        <td rowspan="2">Ризики</td>
                                        <td rowspan="2">Без врахування зносу</td>
                                        <td rowspan="2">Вигодонабувач</td>
                                    </tr>
                                    <tr class="columns">
                                        <td>№</td>
                                        <td>Дата</td>
                                        <td>Платіж</td>
                                        <td>з</td>
                                        <td>до</td>
                                        <td>Кiльк.</td>
                                        <td>Дата</td>
                                        <td>Статус</td>
                                        <td width="60">Викр.</td>
                                        <td width="60">Пош.</td>
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
                                        <td>&nbsp;<?=$row['datetimeLastFormat']?></td>
                                        <td>&nbsp;<?=$row['insurer'] ?></td>
                                        <td>&nbsp;<?=$row['item']?></td>
                                        <td>&nbsp;<?=$row['shassi']?></td>
                                        <td>&nbsp;<?=$row['sign']?></td>
                                        <td>&nbsp;<?=$row['begin_datetimeFormat']?></td>
                                        <td>&nbsp;<?=$row['end_datetimeFormat']?></td>
                                        <td style="text-align: right; padding-right: 10px;"><?=getMoneyFormat($row['price'], -1)?></td>
                                        <td>
                                        <?
                                            switch ($row['payment_brakedown_id']) {
                                                case 1:
                                                    echo '1';
                                                    break;
                                                case 2:
                                                    echo '2';
                                                    break;
                                                case 3:
                                                    echo '4';
                                                    break;
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?
                                            foreach ($row['payments'] as $payment) {
                                                if ($payment['statuses_id'] >= PAYMENT_STATUSES_PAYED) echo '<b>';
                                                echo date('d.m.Y',smarty_make_timestamp($payment['date']));
                                                if ($payment['statuses_id'] >= PAYMENT_STATUSES_PAYED) echo '</b>';
                                                echo '<br />';
                                            }
                                        ?>
                                        </td>
                                        <td>
                                                        <?
                                                        foreach ($row['payments'] as $payment) {
                                                            echo $payment['paymentStatusesTitle'] . '<br />';
                                                        }
                                                        ?>
                                        </td>
                                        <td align="center">&nbsp;<?=$row['eventsNumber']?></td>
                                        <td>&nbsp;<?=$row['year']?></td>
                                        <td align="right">&nbsp;<?=($row['deductibles_absolute1']) ? getMoneyFormat($row['deductibles_value1']) : $row['deductibles_value1'] . ' %'?></td>
                                        <td align="right">&nbsp;<?=($row['deductibles_absolute0']) ? getMoneyFormat($row['deductibles_value0']) : $row['deductibles_value0'] . ' %'?></td>
                                        <td><?=implode('; ', $row['risks'])?></td>
                                        <td><?=(($row['options_deterioration_no'] == 1) ? 'так' : 'ні')?></td>
                                        <td>&nbsp;<?=$row['assured_title']?></td>
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
<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getKASKOBorderoInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                            document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                            MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                            // -->
                </script>
            </td>
        </tr>
    </table>
</div>