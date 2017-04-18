<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">КАСКО. Полиси:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getKaskoPolicies" />
                    <input type="hidden" name="product_typesId" value="<?=PRODUCT_TYPES_KASKO?>" />
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
                                        <td>
										<b>Банк:</b> 
										<?
											echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
											echo '<option value="">...</option>';
											foreach ($financial_institutions as $financial_institution) {
												echo '<option value="' . $financial_institution['id'] . '" ' . (($financial_institution['id'] == $data['financial_institutions_id']) ? 'selected' : '') . '>' . $financial_institution['title'] . '</option>';
											}
											echo '</select>';
										?>
										</td>
										<td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
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
                                        <td rowspan="2">Вигодонабувач</td>
										 <td rowspan="2">ПІБ клієнта</td>
                                        <td rowspan="2">ІПН Клієнта</td>
                                        <td rowspan="2">№ договору страхування </td>
                                        <td rowspan="2">Дата укладання договору</td>
                                        <td rowspan="2">Страхова сума за договором, грн.</td>
                                        <td colspan="2">Період</td>
										<td rowspan="2">Умови за договором (тариф, %)</td>
										<td rowspan="2">Платіж отриманий Страховиком у звітному періоді, грн.</td>
										<td rowspan="2">Продукт</td>
										<td rowspan="2">Бренд</td>
										<td rowspan="2">Агенция</td>
										<td rowspan="2">Пролонг</td>
										<td rowspan="2">Знижка для банкiв</td>
										<td rowspan="2">Компенсацiя банка</td>
										<td rowspan="2">Сума кредиту</td>
										<td rowspan="2">Знижка агента</td>
										<td rowspan="2">Знижка Car man</td>
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
                                        <td><?=$row['finansialInstitutionTitle']?></td>
										<td><?=$row['insurer']?></td>
										<td><?=$row['insurer_identification_code']?></td>
										<td><?=$row['number']?></td>
										<td><?=$row['dateTimeFormat']?></td>
										<td><?=$row['price']?></td>
										
										<td><?=$row['begin_datetimeFormat']?></td>
										<td><?=$row['end_datetimeFormat']?></td>
										<td><?=$row['rate']?></td>
                                        <td><?=$row['pamount']?></td>
										<td><?=$row['products_title']?></td>
										<td><?=$row['brand']?></td>
										<td><?=$row['agencyTitle']?></td>
										<td><?=($row['states_id']>0 ? 'так' : 'нi' )?></td>
										<td><?=$row['bank_discount_value']?></td>
										<td><?=$row['bank_commission_value']?></td>
										<td><?=$row['bankCreditAgreementAmount']?></td>
										<td><?=$row['discount']?></td>
										<td><?=$row['cart_discount']?></td>
										
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
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getKaskoPoliciesInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                            document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                            MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                            // -->
                </script>
            </td>
        </tr>
    </table>
</div>