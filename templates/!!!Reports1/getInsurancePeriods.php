<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Договори страхування в розрізі страхових періодів:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports1|getInsurancePeriods" />
					<input type="hidden" name="InWindow" value="true" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="right">
											<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
													<td>
														<b>Особа:</b> 
														<select name="insurer_person_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="">...</option>
															<option value="1" <?=($data['insurer_person_types_id'] == 1) ? 'selected' : ''?>>Фізична</option>
															<option value="2" <?=($data['insurer_person_types_id'] == 2) ? 'selected' : ''?>>Юридична</option>
														</select>
													</td>
													<td>
														<b>Вид страхування:</b> 
														<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="3" <?=($data['product_types_id'] == 3) ? 'selected' : ''?>>КАСКО</option>
														</select>
													</td>
													<td>
														<b>Канал:</b>
														<?
                                                        echo '<select name="agency_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                        echo '<option value="">...</option>';
                                                        foreach ($agency_types as $agency_type) {
                                                            echo ($agency_type['id'] == $data['agency_types_id'])
                                                            ? '<option value="' . $agency_type['id'] . '" selected>' . $agency_type['title'] . '</option>'
                                                            : '<option value="' . $agency_type['id'] . '">' . $agency_type['title'] . '</option>';
                                                        }
                                                        echo '</select>';
                                                        ?>
													</td>
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
                                                </tr>
                                            </table>
											<? } ?>
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
													<td>
														<b>Звіт:</b>
														<select name="types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="0" <?=(intval($data['types_id']) == 0 ? 'selected' : '')?>>По договорах</option>
															<option value="1" <?=(intval($data['types_id']) == 1 ? 'selected' : '')?>>За каналами</option>
															<option value="2" <?=(intval($data['types_id']) == 2 ? 'selected' : '')?>>По агенціям</option>
															<option value="3" <?=(intval($data['types_id']) == 3 ? 'selected' : '')?>>По банкам</option>
														</select>
													</td>
													
													<td><b>Дата:</b></td>
													<td>
														<select name="date_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="1" <?=(intval($data['date_types_id']) == 1 ? 'selected' : '')?>>заключення</option>
															<option value="2" <?=(intval($data['date_types_id']) == 2 ? 'selected' : '')?>>повної сплати</option>
															<option value="3" <?=(intval($data['date_types_id']) == 3 ? 'selected' : '')?>>закінчення</option>
														</select>
													</td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
					</table>
                </form>
            </td>
        </tr>
    </table>
</div>