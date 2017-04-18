<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Акти виконанних робіт, агентська винагорода:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                    <input type="hidden" name="InWindow" value="true" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="bottom">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                                    <td width="10"></td>
                                                    <td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                                </tr>
                                            </table>
                                        </td>
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
                                                    <td>
                                                        <b>Банк:</b>
                                                            <?
                                                            echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                            echo '<option value="">...</option>';
                                                            foreach ($financial_institutions as $financial_institution) {
                                                                echo '<option value="' . $financial_institution['id'] . '" ' . (($financial_institution['id'] == $data['financial_institutions_id']) ? 'selected' : '') . '>' . str_repeat('&nbsp;', $financial_institution['level'] * 3) . $financial_institution['title'] . '</option>';
                                                            }
                                                            echo '</select>';
                                                            ?>
                                                    </td>
                                                    <? } ?>
                                                </tr>
                                            </table>

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
													<?}?>
													<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
                                                    <td><b>Тип полiса:</b></td>
                                                    <td>
                                                        <?
                                                            echo '<select name="product_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                            foreach ($product_types as $product_type) {
                                                                echo '<option value="' . $product_type['id'] . '" ' . (($product_type['id'] == $data['product_types_id']) ? 'selected' : '') . '>' . $product_type['title'] . '</option>';
                                                            }
                                                            echo '</select>';
                                                        ?>
                                                    </td>
													<?}?>
                                                    <td><b>Отримувач:</b></td>
                                                    <td>
                                                        <?
                                                            echo '<select name="recipients_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                            echo '<option value="1" ' . (($data['recipients_id'] == 1) ? 'selected' : '') . '>Агент</option>';
                                                            echo '<option value="2" ' . (($data['recipients_id'] == 2) ? 'selected' : '') . '>Агенція</option>';
                                                            echo '<option value="3" ' . (($data['recipients_id'] == 3) ? 'selected' : '') . '>Банк</option>';
															
															echo '<option value="4" ' . (($data['recipients_id'] == 4) ? 'selected' : '') . '>Директор</option>';
															echo '<option value="5" ' . (($data['recipients_id'] == 5) ? 'selected' : '') . '>Заст. дир</option>';
                                                            echo '</select>';
                                                        ?>
                                                    <td><b>Період сплати:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td><input type="checkbox" name="payed" value="1" <?=($data['payed'] ? 'checked' : '')?> /></td>
                                                    <td>сплачені</td>
                                                    <td>&nbsp;<a href="javascript: document.<?=$this->object?>.submit();">Показати</a></td>
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
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr class="columns">
                                        <td>Агент</td>
                                        <td>Акт</td>
										<td>Кількість полісів, шт.</td>
										<td>Сума реалізації, грн.</td>
                                        <td>Сума винагороди до опадаткування, грн.</td>
                                        <td>Дата сплати за актом</td>
                                    </tr>
                                    <?
										$policiesCount = 0;
										$policiesAmount = 0;
                                        $commission_amount = 0;
                                        if (is_array($list )) {
                                            foreach ($list as $row) {
                                                $i = 1 - $i;
												$policiesCount += $row['policiesCount'];
												$policiesAmount += $row['policiesAmount'];
                                                $commission_amount += $row['commission_amount'];
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$row['recipient']?></td>
                                        <td><a href="?do=<?=$row['recipientsGroup']?>|downloadFileInWindow&id=<?=$row['recipients_id']?>&aktnumber=<?=$row['aktNumber']?>&product_types_id=<?=$data['product_types_id']?>"><?=$row['aktNumber']?></a></td>
                                        <td align="right"><?=$row['policiesCount']?> &nbsp;</td>
										<td align="right"><?=getMoneyFormat($row['policiesAmount'])?> &nbsp;</td>
                                        <td align="right"><?=getMoneyFormat($row['commission_amount'])?> &nbsp;</td>
                                        <td><?=$row['payment_date_format']?></td>
                                    </tr>
                                    <?
                                        }
                                    }
                                    ?>
                                    <tr class="navigation">
                                        <td class="paging">Всього:</td>
                                        <td class="paging"><?=(sizeof($list))?></td>
										<td align="right" class="paging"><?=$policiesCount?> &nbsp;</td>
										<td align="right" class="paging"><?=getMoneyFormat($policiesAmount)?> &nbsp;</td>
                                        <td align="right" class="paging"><?=getMoneyFormat($commission_amount)?> &nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                        document.<?=$this->objectTitle?>.buttons = new Array();
                        <? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                        document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                        MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>