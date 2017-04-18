<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">КАСКО, пролонгація по регіонам:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getContinuePoliciesRegions" />
					<input type="hidden" name="report" value="getContinuePoliciesRegions" />
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
                                <? if (sizeOf($regions)) {?>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr class="columns">
                                        <td rowspan="2">Область</td>
                                        <td rowspan="2">Агенція</td>
										<td colspan="2">План</td>
										<td colspan="2">Факт</td>
										<td colspan="2">Виконання, %</td>
                                    </tr>
                                    <tr class="columns">
										<td>Одиниць</td>
										<td>Сума, грн.</td>
										<td>Одиниць</td>
										<td>Сума, грн.</td>
										<td>Одиниць</td>
										<td>Сума, грн.</td>
                                    </tr>
                                    <?
										$i = 0;

										$plan_amount = 0;
										$plan_quantity = 0;
										$fact_amount = 0;
										$fact_quantity = 0;

                                        foreach ($regions as $row) {
                                            $i = 1 - $i;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$list[ $row['regions_id'] ][ $row['agencies_id'] ]['regions_title']?></td>
                                        <td><?=$list[ $row['regions_id'] ][ $row['agencies_id'] ]['agencies_title']?></td>

										<td align="right"><?=intval($list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_quantity'])?></td>
										<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_amount'], -1)?></td>

										<td align="right"><?=intval($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_quantity'])?></td>
										<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_amount'], -1)?></td>

										<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_quantity'] / $list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_quantity'] * 100, -1)?></td>
										<td align="right"><?=getMoneyFormat($list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_amount'] / $list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_amount'] * 100, -1)?></td>
                                    </tr>
									<?
											$plan_amount = $plan_amount + $list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_amount'];
											$plan_quantity = $plan_quantity + $list[ $row['regions_id'] ][ $row['agencies_id'] ]['plan_quantity'];
											$fact_amount = $fact_amount + $list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_amount'];
											$fact_quantity = $fact_quantity + $list[ $row['regions_id'] ][ $row['agencies_id'] ]['fact_quantity'];
										}
									?>
								<tr class="navigation">
									<td class="paging" colspan="2">Всьго: <?=(sizeof($list))?></td>
									<td class="paging" align="right"><?=$plan_quantity?></td>
									<td class="paging" align="right"><?=getMoneyFormat($plan_amount, -1)?></td>
									<td class="paging" align="right"><?=$fact_quantity?></td>
									<td class="paging" align="right"><?=getMoneyFormat($fact_amount, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($fact_quantity / $plan_quantity * 100, -1)?></td>
									<td class="paging" align="right"><?=getMoneyFormat($fact_amount / $plan_amount * 100, -1)?></td>
								</tr>
                                </table>
                                <? }?>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>