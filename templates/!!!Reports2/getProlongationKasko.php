<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Пролонгація:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getProlongationKaskoInWindow" />
					<input type="hidden" name="report" value="getProlongationKasko" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="10"></td>
                                        <td class="description" valign="bottom"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
											<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
													<td>
														<b>Особа:</b> 
														<select name="person_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="">...</option>
															<option value="1" <?=($data['person_types_id'] == 1) ? 'selected' : ''?>>Фізична</option>
															<option value="2" <?=($data['person_types_id'] == 2) ? 'selected' : ''?>>Юридична</option>
														</select>
													</td>
													<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
													<td>
														<b>СК:</b> 
														<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
															<option value="">...</option>
															<option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ Експрес страхування</option>
															<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
														</select>
													</td>
													<?}?>
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
                                                </tr>
                                            </table>
											<? } ?>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
													<td>
														<b>Звіт:</b>
														<select name="types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="0" <?=(intval($data['types_id']) == 0 ? 'selected' : '')?>>По договорах</option>
															<option value="1" <?=(intval($data['types_id']) == 1 ? 'selected' : '')?>>За каналами продаж</option>
															<option value="2" <?=(intval($data['types_id']) == 2 ? 'selected' : '')?>>По регіонам</option>
															<option value="3" <?=(intval($data['types_id']) == 3 ? 'selected' : '')?>>По банкам</option>
														</select>
													</td>
													<td><b>План:</b> <input type="checkbox" name="mode" value="1" <?=($data['mode'] == 1) ? 'checked' : ''?> /></td>
													<td><b>Розширенний:</b> <input type="checkbox" name="advanced" value="1" <?=($data['advanced'] == 1) ? 'checked' : ''?> /></td>
                                                	<td><b>Виключити пролонговані:</b> <input type="checkbox" name="prolonged" value="1" <?=($data['prolonged'] == 1) ? 'checked' : ''?> /></td>
                                                    <? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
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
													<?}?>
                                                    <td><b>Дата пролонгації:</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>Виключно:</b> <input type="checkbox" name="strong" value="1" <?=($data['strong'] == 1) ? 'checked' : ''?> /></td>
													<td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';"></td>
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
								
									<? if (!intval($data['types_id'])) { ?>
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr class="columns">
												<td>Номер</td>
												<td>Дата</td>
												<td>Страхувальник</td>
												<td>ІПН/ЄДРПОУ</td>
												<td>Об'єкт</td>
												<td>Телефон</td>
												<td>Сума, грн.</td>
												<td>Тариф, %</td>
												<td>Премія, грн.</td>
												<td>Сплата</td>
												<td>Початок</td>
												<td>Закінчення</td>
												<td>Багаторічний</td>
												<td>Номер платежу (розбивка)</td>
												<td>Агенція</td>
												<td>Область</td>
												<td>Банк</td>
												<td>Кузов</td>
												<td>Держ номер</td>
												<td>Пролонгація</td>
												<td>Рік страхування</td>
												<td>Канал продажів</td>
											</tr>
											<?
												$i = 0;
												$amount = 0;
												foreach ($list as $row) {
													$i = 1 - $i;
											?>
											<tr class="<?=Form::getRowClass($row, $i)?>">
												<td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=3"><?=$row['number']?></a></td>
												<td><?=$row['date_format']?></td>
												<td><?=$row['insurer']?></td>
												<td><?=$row['insurer_identification']?></td>
												<td><?=$row['item']?></td>
												<td><?=$row['insurer_phone']?></td>
												<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
												<td align="right"><?=getRateFormat($row['rate'])?></td>
												<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
												<td><?=$row['payments_datetime_format'];?></td>
												<td><?=$row['begin_datetime_format']?></td>
												<td><?=$row['interrupt_datetime_format']?></td>
												<td><?=$row['long_term']?></td>
												<td><?=$row['number_payment_year']?></td>
												<td><?=$row['agencies_title']?></td>
												<td><?=$row['regions_title']?></td>
												<td><?=$row['financial_institutions_title']?></td>
												<td><?=$row['shassi']?></td>
												<td><?=$row['sign']?></td>
												<td><?=$row['prolongation_number']?></td>
												<td><?=$row['number_insurance_year']?></td>
												<td><?=$row['agency_types_title']?></td>
											</tr>
											<?
													$amount = $amount + $row['amount'];
												}
											?>
										<tr class="navigation">
											<td class="paging">Всьго: <?=(sizeof($list))?></td>
											<td colspan="6">&nbsp;</td>
											<td class="paging" align="right"><?=getMoneyFormat($amount, -1)?></td>
											<td colspan="6">&nbsp;</td>
										</tr>
										</table>
									<? } elseif (intval($data['types_id']) == 1) { ?>
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr class="columns">
												<td rowspan="2">Дата</td>
												<td colspan="2">Рітейл</td>
												<td colspan="2">Банк</td>
												<td colspan="2">Всього</td>
											</tr>
											<tr class="columns">
												<td>Кількість, шт.</td>
												<td>Сума, грн.</td>
												<td>Кількість, шт.</td>
												<td>Сума, грн.</td>
												<td>Кількість, шт.</td>
												<td>Сума, грн.</td>
											</tr>
											<?
												$total['quantityRetail'] = 0; 
												$total['amountRetail'] = 0;

												$total['quantityBank'] = 0;
												$total['amountBank'] = 0;

												$total['quantity'] = 0;
												$total['amount'] = 0;

												$i = 0;
												foreach ($list as $row) {
													$i = 1 - $i;
											?>
											<tr class="<?=Form::getRowClass($row, $i)?>">
												<td><?=$row['datetimeFormat']?></td>
												<td align="right"><?=intval($row['quantityRetail'])?></td>
												<td align="right"><?=getMoneyFormat($row['amountRetail'], -1)?></td>
												<td align="right"><?=intval($row['quantityBank'])?></td>
												<td align="right"><?=getMoneyFormat($row['amountBank'], -1)?></td>
												<td align="right"><?=intval($row['quantity'])?></td>
												<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
											</tr>
											<?
												$total['quantityRetail'] += $row['quantityRetail']; 
												$total['amountRetail'] += $row['amountRetail'];

												$total['quantityBank'] += $row['quantityBank'];
												$total['amountBank'] += $row['amountBank'];

												$total['quantity'] += $row['quantity']; 
												$total['amount'] += $row['amount'];
												}
											?>
											<tr class="navigation">
												<td class="paging">&nbsp;</td>
												<td class="paging" align="right"><?=$total['quantityRetail']?></td>
												<td class="paging" align="right"><?=getMoneyFormat($total['amountRetail'], -1)?></td>
												<td class="paging" align="right"><?=$total['quantityBank']?></td>
												<td class="paging" align="right"><?=getMoneyFormat($total['amountBank'], -1)?></td>
												<td class="paging" align="right"><?=$total['quantity']?></td>
												<td class="paging" align="right"><?=getMoneyFormat($total['amount'], -1)?></td>
											</tr>
										</table>
									<? } ?>
                                <? }?>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>