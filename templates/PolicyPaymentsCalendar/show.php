<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Календар оплат:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="PolicyPaymentsCalendar|show" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="bottom">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <?=($this->permissions['export']) ? '<td width="22" style="vertical-align: bottom;"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>' : ''?>
                                                    <td width="10"></td>
                                                    <td class="description" style="width: 100px;"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="50" height="1" alt="" /></div></div></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                            <tr>
                                                <td align="right">
                                                    <b>Страхова компанія:</b>
                                                    <?
                                                        echo '<select name="insurance_companies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                        echo '<option value="0">...</option>';
                                                        echo '<option value="' . INSURANCE_COMPANIES_KNIAZHA . '" ' . (($data['insurance_companies_id'] == INSURANCE_COMPANIES_KNIAZHA) ? 'selected' : '') . '>Княжа</option>';
                                                        echo '<option value="' . INSURANCE_COMPANIES_ORANTA . '" ' . (($data['insurance_companies_id'] == INSURANCE_COMPANIES_ORANTA) ? 'selected' : '') . '>Оранта</option>';
                                                        echo '<option value="' . INSURANCE_COMPANIES_GENERALI . '" ' . (($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : '') . '>Гарант-Авто</option>';
                                                        echo '<option value="' . INSURANCE_COMPANIES_EXPRESS . '" ' . (($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : '') . '>Експрес страхування</option>';
                                                        echo '</select>';
                                                    ?>
                                                    <b>Вид страхування:</b>
                                                    <?
                                                        echo '<select name="product_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">';
                                                        echo '<option value="0">...</option>';
                                                        foreach ($product_types as $product_type) {
                                                            echo ($product_type['id'] == $data['product_types_id'])
                                                                ? '<option value="' . $product_type['id'] . '" selected>' . str_repeat('&nbsp;', $product_type['level'] * 3) . $product_type['title'] . '</option>'
                                                                : '<option value="' . $product_type['id'] . '">' . str_repeat('&nbsp;', $product_type['level'] * 3) . $product_type['title'] . '</option>';
                                                        }
                                                        echo '</select>';
                                                    ?>
                                                </td>
                                                <td valign="bottom" rowspan="2"><b>Статус:</b> <?=$fields['policy_statuses_id']['object']?></td>
                                                <td valign="bottom" rowspan="2"><b>Оплата:</b> <?=$fields['statuses_id']['object']?></td>
                                            </tr>
											<tr>
												<td align="right">
                                                    <b>Агенція:</b>
                                                    <?
                                                        echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
                                                        echo '<option value="">...</option>';
                                                        foreach ($agencies as $agency) {
                                                           			echo ($agency['id'] == $data['agencies_id'])
																		? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
																		: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';

                                                        }
                                                        echo '</select>';
                                                    ?>
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
											</tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <td valign="bottom"><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                                                    <td valign="bottom"><b>Страхувальник:</b> <input type="text" name="insurer" value="<?=$data['insurer']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
													<td><b>Термін:</b></td>
													<td>&nbsp;з</td><td><input type="text" id="fromWaitingPaymentDate" name="fromWaitingPaymentDate" value="<?=$data['fromWaitingPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td nowrap>&nbsp;до</td><td><input type="text" id="toWaitingPaymentDate" name="toWaitingPaymentDate" value="<?=$data['toWaitingPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>Отримано:</b></td>
													<td>&nbsp;з</td><td><input type="text" id="fromPaymentDate" name="fromPaymentDate" value="<?=$data['fromPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td nowrap>&nbsp;до</td><td><input type="text" id="toPaymentDate" name="toPaymentDate" value="<?=$data['toPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
                                        <td rowspan="2">Страхувальник</td>
                                        <td colspan="10">Поліс</td>
                                        <td colspan="5">Оплата</td>
                                        <td rowspan="2">Агенцiя</td>
										<td rowspan="2">Банк</td>
                                        <td rowspan="2">Рахунок</td>
                                        <td rowspan="2">Лист</td>
                                    </tr>
                                    <tr class="columns">
                                        <td>Номер</td>
										<td>Дата</td>
                                        <td>Початок</td>
                                        <td>Закінчення</td>
                                        <td>Багаторічний</td>
										<td>Пролонгацiя (3 міс)</td>
										<td>Пролонгацiя (6 міс)</td>
										<td>Опцiя 50/50</td>
										<td>Кiльк платежiв</td>
                                        <td>Статус</td>
                                        <td>Сума, грн.</td>
                                        <td>Термін</td>
                                        <td>Отримано</td>
										<td>Статус</td>
										<td>Фактично сплачено</td>										
                                    </tr>
                                    <?
                                        foreach ($list as $row) {
                                            $i = 1 - $i;
                                            if ($row['prev_status'] == 1) {
                                                continue;
                                            }
                                    ?>
                                    <tr class="<?=$this->getRowClass($row, $i)?>">
                                        <td><?=$row['insurer']?></td>
                                        <td><a href="/?do=Policies|view&id=<?=$row['policies_id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
										<td><?=$row['policies_date']?></td>
										<td><?=$row['policies_begin_datetime']?></td>
										<td><?=$row['policies_end_datetime']?></td>
										<td><?=($row['days'] > 367) ? 'так' : 'ні'?></td>
										<td><?=($row['states_id']>0 ? 'так' : 'нi' )?></td>
										<td><?=($row['states_id2']>0 ? 'так' : 'нi' )?></td>
										
										<td><?=($row['options_fifty_fifty']>0 ? 'так' : 'нi' )?></td>
										<td><?=($row['payment_brakedown_id']==3 ? '4 платежi' : ($row['payment_brakedown_id']==2 ? '2 платежi': '1 платiж') )?></td>
										
										<td><?=$row['policy_statuses_title']?></td>
                                        <td align="right"><?=getMoneyFormat($row['amount'])?> &nbsp;</td>
                                        <td><?=$row['date']?></td>
                                        <td><?=$row['payment_date']?></td>
                                        <td><?=$row['payment_statuses_title']?></td>
										<td align="right"><?=getMoneyFormat($row['payedamount'])?> &nbsp;</td>
                                        <td><?=$row['agencies_title']?></td>
										<td><?=$row['fin_institutionTitle']?></td>
                                        <?
                                            $file = array(
                                                'id'		=> $row['id'],
                                                'position' 	=> 0,
                                                'languageCode=' => '');

                                            $url = 'http://'.$_SERVER['SERVER_NAME'].'/index.php?do=PolicyPaymentsCalendar|downloadFileInWindow&file=' . urlencode(serialize($file)) . '&policies_id=' . $row['policies_id'] . '&product_types_id=' . $row['product_types_id'];
                                        ?>
                                        <td><a target="_blank" href="<?=$url?>">Скачати</a></td>
                                        <?
                                            $url = 'http://'.$_SERVER['SERVER_NAME'].'/index.php?do=PolicyPaymentsCalendar|downloadFileInWindow&file=' . urlencode(serialize($file)) . '&type=letter&policies_id=' . $row['policies_id'] . '&product_types_id=' . $row['product_types_id'];
                                        ?>
                                        <td><a target="_blank" href="<?=$url?>">Скачати</a></td>
                                    </tr>
                                    <? } ?>
                                    <tr class="navigation">
                                        <td class="paging" colspan="<?php echo ($data['clients_id']) ? 11 : 4?>">Всього:</td>
                                        <td align="right" nowrap><b><?=getMoneyFormat($total['amount'])?></b></td>
                                        <td colspan="3">&nbsp;</td>
                                        <td><b><?=$total['number']?> шт.</b></td>
                                        <td colspan="<?php echo ($data['clients_id']) ? 4 : 2?>">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?=($this->permissions['export']) ? 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');' : ''?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>