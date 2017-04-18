<?$Log->showSystem() ?>
<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Аналіз врегулювання страхових справ:</td>
        </tr>
        <tr>
            <td></td>
            <td align="right">
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getAnalysisAccidentsByAverage" />

                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                <td valign="bottom" class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
                            </td>
                            <td align="right">
                                <table>
                                    <tr>
										<td><b>Вид страхування:</b></td>
										<td>
                                            <select name="product_types_id[]" size="6" class="fldSelect" multiple="" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
												<option value="<?=PRODUCT_TYPES_KASKO?>" <?=(in_array(PRODUCT_TYPES_KASKO, $data['product_types_id']) ? 'selected' : '')?>>КАСКО</option>
												<option value="<?=PRODUCT_TYPES_GO?>" <?=(in_array(PRODUCT_TYPES_GO, $data['product_types_id']) ? 'selected' : '')?>>ОСЦПВ</option>
												<option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=(in_array(PRODUCT_TYPES_PROPERTY, $data['product_types_id']) ? 'selected' : '')?>>Майно</option>
                                            </select>
                                        </td>
                                        <td><b>Місяць:</b></td>
										<td>
                                            <select name="monthes[]" size="6" class="fldSelect" multiple="" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
											<? foreach($MONTHES as $key => $val) { ?>
												<option value="<?=$key+1?>" <?=(in_array($key + 1, $data['monthes']) ? 'selected' : '')?>><?=$val?></option>
											<? } ?>
                                            </select>
                                        </td>
										<td><b>Рік:</b></td>
										<td>
											<select name="year" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                            <? for ($i = 2010; $i <= intval(date('Y')); $i++){ ?>
												<option value="<?=$i?>" <?=($data['year'] == $i ? 'selected' : '')?>><?=$i?></option>
                                            <? } ?>
                                            </select>
                                        </td>
                                        <td><input type="checkbox" name="is_all" <?=(($data['is_all']) ? 'checked' : '')?>>всі аваркоми</td>
                                       <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr><td height="4" bgcolor="#D6D6D6" colspan="4"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                        <tr>
                            <td colspan="4">
								<table width="100%" cellpadding="3" cellspacing="0" border="1">
									<tr class="columns">
										<td>&nbsp;</td>
										<td>Залишок на початок звітнього періоду, шт.</td>
										<td>Отримано в звітній період, шт.</td>
										<td>Врегульовано (виплата), шт.</td>										
										<td>Врегульовано (відмова, без виплати), шт.</td>
										<td>Призупинені, шт.</td>
										<td>Врегульовано, шт.</td>
										<td>Середній термін врегулювання справи, дн.</td>
										<td>Оборотність справ, %</td>
										<td>Залишок на кінець звітнього періоду, шт.</td>
									</tr>
									<?
										$total = array();
										$divisor = 24 * 60 * 60;
										foreach ($list as $key => $month) {
											echo '<tr>';
											echo '<td align="right"><b>' . $MONTHES[$key-1] . ' ' . $data['year'] . '</b></td>';
											foreach ($fields as $field) {
												echo '<td id="' . $field . $key . '" align="right"></td>';
											}
											echo '</tr>';
											foreach ($month as $row) {
												echo '<tr>';
												echo '<td align="right"><i>' . $row['average_managers_name'] . '</i></td>';
												foreach ($fields as $field) {
													switch ($field) {
														case 'reversibility':
															echo '<td align="right"><i>' . roundNumber(($row['resolved_total'] / $row['new']) * 100, 2) . '</i></td>';
															break;
														case 'term':
															echo '<td align="right"><i>' . 
																intval(roundNumber(($row[$field] / $divisor) / $row['resolved_total'], 2)) . 'дн.' . 
																roundNumber((roundNumber(($row[$field] / $divisor) / $row['resolved_total'], 2) - intval(roundNumber(($row[$field] / $divisor) / $row['resolved_total'], 2))) * 24, 0) . 'год.' . 
																'</i></td>';
															$total[$key][$field] += $row[$field];
															break;
														default:
															echo '<td align="right"><i>' . $row[$field] . '</i></td>';
															$total[$key][$field] += $row[$field];
															break;
													}
												}
												echo '</tr>';
											}
											foreach ($fields as $field) {
												switch ($field) {
													case 'reversibility':
														echo '<script>$("#' . $field . $key . '").html("<b>' . roundNumber(($total[$key]['resolved_total'] / $total[$key]['new']) * 100, 2) . '</b>")</script>';
														break;
													case 'term':
														echo '<script>$("#' . $field . $key . '").html("<b>' . 
															intval(roundNumber(($total[$key][$field] / $divisor) / $total[$key]['resolved_total'], 2)) . 'дн.' . 
															roundNumber((roundNumber(($total[$key][$field] / $divisor) / $total[$key]['resolved_total'], 2) - intval(roundNumber(($total[$key][$field] / $divisor) / $total[$key]['resolved_total'], 2))) * 24, 0) . 'год.' . 
															'</b>")</script>';
														$total[0][$field] += $total[$key][$field];
														break;
													default:
														echo '<script>$("#' . $field . $key . '").html("<b>' . $total[$key][$field] . '</b>")</script>';
														$total[0][$field] += $total[$key][$field];
														break;
												}
											}
											
										}
										echo '<tr class="navigation">';
										if (sizeof($list) && is_array($list)) {
											echo '<td class="paging" align="right">Підсумок:</td>';
											foreach ($fields as $field) {
												switch ($field) {
													case 'begin_balance':
														echo '<td class="paging" align="right">' . $total[$data['monthes'][0]][$field] . '</td>';
														break;
													case 'end_balance':
														echo '<td class="paging" align="right">' . $total[$data['monthes'][sizeof($data['monthes']) - 1]][$field] . '</td>';
														break;
													case 'reversibility':
														echo '<td class="paging" align="right">' . roundNumber(($total[0]['resolved_total'] / $total[0]['new']) * 100, 2) . '</td>';
														break;
													case 'term':
														echo '<td class="paging" align="right">' . 
														intval(roundNumber(($total[0][$field] / $divisor) / $total[0]['resolved_total'], 2)) . 'дн.' . 
														roundNumber((roundNumber(($total[0][$field] / $divisor) / $total[0]['resolved_total'], 2) - intval(roundNumber(($total[0][$field] / $divisor) / $total[0]['resolved_total'], 2))) * 24, 0) . 'год.' . 
														'</td>';
														break;
													default:
														echo '<td class="paging" align="right">' . $total[0][$field] . '</td>';
														break;
												}
											}
											echo '</tr>';
										}
									?>
								</table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAnalysisAccidentsByAverageInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>