<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Страхові відшкодування та страхові премії:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getPaymentsAndPremiums" />
					<input type="hidden" name="report" value="getPaymentsAndPremiums" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description" valign="bottom"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
				                            <table cellpadding="0" cellspacing="5">
												<tr>
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
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr class="columns">
                                        <td rowspan="2">Номер</td>
                                        <td rowspan="2">Підприємство УкрАВТО</td>
										<td rowspan="2">Виплата, де Страхувальник - СТО УкрАВТО</td>
                                        <td colspan="3">Виплати на СТО без тих, де Страхувальник СТО</td>
										<td colspan="4">Страхові платежі (отримані) за період з</td>
										<td colspan="3">Питома вага платежів до виплат на СТО, %</td>
                                    </tr>
									<tr class="columns">
										<td>КАСКО</td>
										<td>ЦВ</td>
										<td>Всього</td>
										<td>КАСКО</td>
										<td>ЦВ</td>
										<td>інші види</td>
										<td>Всього</td>
										<td>КАСКО</td>
										<td>ЦВ</td>
										<td>Всьго</td>
									</tr>
                                    <?
										$i = 0;
										$num = 0;
										$amount_compensation_car_services_kiev = 0;
										$amount_compensation_kasko_kiev = 0;
										$amount_compensation_go_kiev = 0;
										$amount_premium_kasko_kiev = 0;
										$amount_premium_go_kiev = 0;
										$amount_premium_other_kiev = 0;
                                        foreach ($list_car_services_agency_kiev as $row) {
                                            ++$num;
											$i = 1 - $i;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$num?></td>
                                        <td><?=$row['title']?></td>
                                        <td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&type=0&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_compensation_car_services'] == '' || $row['amount_compensation_car_services'] == 0) ? '0.00' : $row['amount_compensation_car_services']?></a></td>
                                        <td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=3&type=1&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_compensation_kasko'] == '' || $row['amount_compensation_kasko'] == 0) ? '0.00' : $row['amount_compensation_kasko']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=4&type=1&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_compensation_go'] == '' || $row['amount_compensation_go'] == 0) ? '0.00' : $row['amount_compensation_go']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=0&type=1&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=(($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == '' || ($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == 0) ? '0.00' :($row['amount_compensation_kasko'] + $row['amount_compensation_go'])?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=3&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=$row['amount_premium_kasko']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=4&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=$row['amount_premium_go']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=0&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=$row['amount_premium_other']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=-1&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other'])?></a></td>
										<td align="right"><?=calcRatio($row['amount_premium_kasko'], $row['amount_compensation_kasko'], 2)?></td>
										<td align="right"><?=calcRatio($row['amount_premium_go'], $row['amount_compensation_go'], 2)?></td>
										<td align="right"><?=calcRatio(($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other']), ($row['amount_compensation_kasko'] + $row['amount_compensation_go'] + $row['amount_compensation_car_services']), 2)?></td>
                                    </tr>
									<?
											$amount_compensation_car_services_kiev += $row['amount_compensation_car_services'];
											$amount_compensation_kasko_kiev += $row['amount_compensation_kasko'];
											$amount_compensation_go_kiev += $row['amount_compensation_go'];
											$amount_premium_kasko_kiev += $row['amount_premium_kasko'];
											$amount_premium_go_kiev += $row['amount_premium_go'];
											$amount_premium_other_kiev += $row['amount_premium_other'];
										}
									?>
								<tr class="navigation">
									<td class="paging" colspan="2">Всього по Київським підприємствам:</td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_car_services_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_go_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev + $amount_compensation_go_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_premium_go_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_premium_other_kiev, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev + $amount_premium_go_kiev + $amount_premium_other_kiev, -1)?></td>
									<td class="paging" align="right"><?=calcRatio($amount_premium_kasko_kiev, $amount_compensation_kasko_kiev, 2)?></td>
									<td class="paging" align="right"><?=calcRatio($amount_premium_go_kiev, $amount_compensation_go_kiev, 2)?></td>
									<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko_kiev + $amount_premium_go_kiev + $amount_premium_other_kiev), ($amount_compensation_kasko_kiev + $amount_compensation_go_kiev + $amount_compensation_car_services_kiev), 2)?></td>
								</tr>
								
								<?
										$amount_compensation_car_services = 0;
										$amount_compensation_kasko = 0;
										$amount_compensation_go = 0;
										$amount_premium_kasko = 0;
										$amount_premium_go = 0;
										$amount_premium_other = 0;
                                        foreach ($list_car_services_agency_other as $row) {
                                            ++$num;
											$i = 1 - $i;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$num?></td>
                                        <td><?=$row['title']?></td>
                                        <td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&type=0&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_compensation_car_services'] == '' || $row['amount_compensation_car_services'] == 0) ? '0.00' : $row['amount_compensation_car_services']?></a></td>
                                        <td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=3&type=1&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_compensation_kasko'] == '' || $row['amount_compensation_kasko'] == 0) ? '0.00' : $row['amount_compensation_kasko']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=4&type=1&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_compensation_go'] == '' || $row['amount_compensation_go'] == 0) ? '0.00' : $row['amount_compensation_go']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=0&type=1&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=(($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == '' || ($row['amount_compensation_kasko'] + $row['amount_compensation_go']) == 0) ? '0.00' :($row['amount_compensation_kasko'] + $row['amount_compensation_go'])?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=3&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=$row['amount_premium_kasko']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=4&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=$row['amount_premium_go']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=0&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=$row['amount_premium_other']?></a></td>
										<td align="right"><a style="color: blue;" href="index.php?do=Reports|getPaymentsAndPremiumsDetailsInWindow&id=<?=$row['agencies_id']?>&product_types_id=-1&type=2&from=<?=$data['from']?>&to=<?=$data['to']?>" target="_blank"><?=($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other'])?></a></td>
										<td align="right"><?=calcRatio($row['amount_premium_kasko'], $row['amount_compensation_kasko'], 2)?></td>
										<td align="right"><?=calcRatio($row['amount_premium_go'], $row['amount_compensation_go'], 2)?></td>
										<td align="right"><?=calcRatio(($row['amount_premium_kasko'] + $row['amount_premium_go'] + $row['amount_premium_other']), ($row['amount_compensation_kasko'] + $row['amount_compensation_go'] + $row['amount_compensation_car_services']), 2)?></td>
                                    </tr>
									<?
											$amount_compensation_car_services += $row['amount_compensation_car_services'];
											$amount_compensation_kasko += $row['amount_compensation_kasko'];
											$amount_compensation_go += $row['amount_compensation_go'];
											$amount_premium_kasko += $row['amount_premium_kasko'];
											$amount_premium_go += $row['amount_premium_go'];
											$amount_premium_other += $row['amount_premium_other'];
										}
									?>
									<tr class="navigation">
										<td class="paging" colspan="2">Всього по регіональним підприємствам:</td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_car_services, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_go, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko + $amount_compensation_go, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_go, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_other, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko + $amount_premium_go + $amount_premium_other, -1)?></td>
										<td class="paging" align="right"><?=calcRatio($amount_premium_kasko, $amount_compensation_kasko, 2)?></td>
										<td class="paging" align="right"><?=calcRatio($amount_premium_go, $amount_compensation_go, 2)?></td>
										<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko + $amount_premium_go + $amount_premium_other), ($amount_compensation_kasko + $amount_compensation_go + $amount_compensation_car_services), 2)?></td>
									</tr>
									<tr class="navigation">
										<td class="paging" colspan="2">Всього:</td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_car_services_kiev + $amount_compensation_car_services, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev + $amount_compensation_kasko, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_go_kiev + $amount_compensation_go, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_compensation_kasko_kiev + $amount_compensation_go_kiev + $amount_compensation_kasko + $amount_compensation_go, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev + $amount_premium_kasko, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_go_kiev + $amount_premium_go, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_other_kiev + $amount_premium_other, -1)?></td>
										<td class="paging" align="right"><?=getMoneyFormat($amount_premium_kasko_kiev + $amount_premium_kasko + $amount_premium_go_kiev + $amount_premium_go + $amount_premium_other_kiev + $amount_premium_other, -1)?></td>
										<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko_kiev + $amount_premium_kasko), ($amount_compensation_kasko_kiev + $amount_compensation_kasko), 2)?></td>
										<td class="paging" align="right"><?=calcRatio(($amount_premium_go_kiev + $amount_premium_go), ($amount_compensation_go_kiev + $amount_compensation_go), 2)?></td>
										<td class="paging" align="right"><?=calcRatio(($amount_premium_kasko_kiev + $amount_premium_kasko + $amount_premium_go_kiev + $amount_premium_go + $amount_premium_other_kiev + $amount_premium_other), ($amount_compensation_kasko_kiev + $amount_compensation_go_kiev + $amount_compensation_kasko + $amount_compensation_go + $amount_compensation_car_services_kiev + $amount_compensation_car_services), 2)?></td>
									</tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getPaymentsAndPremiumsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>