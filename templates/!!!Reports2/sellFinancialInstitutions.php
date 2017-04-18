<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Реалізація полiсiв за програмою "АВТОБАНК":</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getSellFinancialInstitutions" />
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
                                                    <? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
                                                    <td>
                                                        <b>Агенція:</b>
                                                            <?
                                                            echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                            echo '<option value="">...</option>';
                                                           foreach ($agencies as $agency) {
															echo ($agency['id'] == $data['agencies_id'])
																? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
																: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
															}
                                                            echo '</select>';
                                                            ?>
                                                    </td>
                                                    <? } ?>
                                                    <td>
                                                        <b>Банк:</b>
                                                        <?
                                                        echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                        echo '<option value="">...</option>';
                                                        foreach ($financial_institutions as $financial_institution) {
                                                            echo ($financial_institution['id'] == $data['financial_institutions_id'])
                                                            ? '<option value="' . $financial_institution['id'] . '" selected>' . $financial_institution['title'] . '</option>'
                                                            : '<option value="' . $financial_institution['id'] . '">' . $financial_institution['title'] . '</option>';
                                                        }
                                                        echo '</select>';
                                                        ?>
                                                    </td>
                                                    <td><b>Дата платежу:</b></td>
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
                                <? if (sizeOf($list)) {?>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr class="columns">
                                        <td rowspan="3">Вигодонабувач</td>
                                        <td rowspan="3">ПІБ Клієнта</td>
                                        <td rowspan="3">ІПН Клієнта</td>
                                        <td rowspan="3">№ договору страхування</td>
                                        <td rowspan="3">Дата укладання договору</td>
                                        <td rowspan="3">Страхова сума за договором, грн.</td>
                                        <td rowspan="2" colspan="2">Термін дії договору</td>
                                        <td rowspan="2" colspan="2">Умови за договором</td>
                                        <td rowspan="3">Платіж отриманий Страховиком у звітному періоді, грн.</td>
                                        <td rowspan="3">Спосіб оплати</td>
                                        <td colspan="2">Комісійна винагорода</td>
                                        <td rowspan="3">Регіональна філія СК "Х"</td>
                                    </tr>
                                    <tr class="columns">
                                        <td colspan="2">Х - по факту отримання платежу</td>
                                    </tr>
                                    <tr class="columns">
                                        <td>з</td>
                                        <td>по</td>
										<td>%</td>
										<td>грн.</td>
                                        <td>за консультації,%</td>
                                        <td>cума винагороди, грн.</td>
                                    </tr>
                                    <?
                                        foreach ($list as $row) {
                                            $i = 1 - $i;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$row['financial_institutions_title']?></td>
                                        <td><?=$row['insurer_lastname'] . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname']?></td>
                                        <td><?=$row['insurer_identification_code']?></td>
                                        <td><a href="<?=$_SERVER['PHP_SELF']?>?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>"><?=$row['number']?></a></td>
                                        <td><?=$row['date_format']?></td>
                                        <td><?=getMoneyFormat($row['price'], -1)?></td>
                                        <td><?=$row['begin_datetimeFormat']?></td>
                                        <td><?=$row['end_datetimeFormat']?></td>
										<td><?=getRateFormat($row['rate'])?></td>
                                        <td><?=getMoneyFormat($row['policiesAmount'], -1)?></td>
                                        <td><?=getMoneyFormat($row['amount'], -1)?></td>
                                        <td><?=$row['paymentsTitle']?></td>
                                        <td><?=getRateFormat($row['commission_financial_institution_percent'])?></td>
                                        <td><?=getMoneyFormat($row['commission_financial_institution_amount'], -1)?></td>
                                        <td><?=$row['agencies_title']?></td>
                                    </tr>
                                        <? } ?>
                                </table>
                                <? }?>
                                <div class="navigation">
                                    <div class="paging">Всьго: <?=sizeOf($list)?></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getSellFinancialInstitutionsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>