<script>
	function setRealLimitPaymentDate(id, value) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			async:		false,
			data:		'do=AccidentPaymentsCalendar|setRealLimitPaymentDateInWindow' +
						'&id=' + id +
						'&date=' + value,
			success: 	function(result) {
							//location.reload();
						}
		});
	}	
	
	function rowsHideShow(type) {
		if ($('.rows'+type).css('display') == 'none') {
			$('.rows'+type).show();
		} else {
			$('.rows'+type).hide();
		}
	}
</script>

<div class="block">	
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Календар виплат СВ:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getAccidentsPaymentsCalendar" />
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
													<td><b>Дата виплати (гранична / планова):</b></td>
													<td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td colspan="6" align="right"><input type="submit" class="button" value="Виконати" /></td>
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
                                <table width="100%" cellpadding="5" cellspacing="0">
                                    <tr class="columns">
										<td></td>
                                        <? 
											foreach ($days as $day) {
												echo '<td>' . $day . '</td>';
											}
										?>
                                    </tr>
                                    <?
										$totals = array();
									
										foreach ($values as $id => $product_type) {								
											$count_total = 0;
											$amount_total = 0;
											
											foreach ($product_type['list'] as $recipient => $type) {
												if (!sizeof($type['list'])) continue;

												foreach ($days as $day) {
													$count[$day] = 0;
													$amount[$day] = 0;
													
													if ($recipient == 'car_services_ukravto') {
														foreach ($type['list'] as $recipients_id => $recipients_id_data) {
															foreach ($recipients_id_data['list'][date('Y-m-d', strtotime($day))] as $row) {
																$totals[$id][$recipient][$recipients_id][$day]['count']++;
																$totals[$id][$recipient][$recipients_id][$day]['amount'] += $row['amount'];
																
																$count[$day]++;
																$amount[$day] += $row['amount'];
															}
														}
													} else {
														foreach ($type['list'][date('Y-m-d', strtotime($day))] as $row) {
															$count[$day]++;
															$amount[$day] += $row['amount'];
														}
													}
												}
												
												foreach ($days as $day) {																											
													$totals[$id][$recipient][$day]['count'] = $count[$day];
													$totals[$id][$recipient][$day]['amount'] = $amount[$day];
												
													$totals[$id][$day]['count'] += $count[$day];
													$totals[$id][$day]['amount'] += $amount[$day];
												}
											}
											
											foreach ($days as $day) {
												
											}
										}
									
                                        foreach ($values as $id => $product_type) {
											echo '<tr class="columns">
													<td><a href="javascript:rowsHideShow(' . $id . ')">' . $product_type['title'] . '</a></td>';
											foreach ($days as $day) {
												echo '<td>' . intval($totals[$id][$day]['count']) .  ' шт. - ' . (float)$totals[$id][$day]['amount'] . ' грн.</td>';
											}
											echo '</tr>';
											
											foreach ($product_type['list'] as $recipient => $type) {
												if (!sizeof($type['list'])) continue;

												echo '<tr bgcolor="808080" class="rows' . $id . '">
														<td valign="top" nowrap><a href="javascript:rowsHideShow(\'' . $id . $recipient . '\')">' . $type['title'] . '</a></td>';
												foreach ($days as $day) {
													echo '<td>' . intval($totals[$id][$recipient][$day]['count']) .  ' шт. - ' . (float)$totals[$id][$recipient][$day]['amount'] . ' грн.</td>';
												}
												echo '</tr>';												

												if ($recipient == 'car_services_ukravto') {													
													$prev_recipients_id = 0;
													foreach ($type['list'] as $recipients_id => $recipients_id_data) {
														echo '<tr bgcolor="cccccc" class="rows' . $id . ' rows' . $id . $recipient . '">
																<td valign="top" nowrap><a href="javascript:rowsHideShow(\'' . $id . $recipient . $recipients_id . '\')">' . $recipients_id_data['title'] . '</a></td>';
														foreach ($days as $day) {
															echo '<td>' . intval($totals[$id][$recipient][$recipients_id][$day]['count']) .  ' шт. - ' . (float)$totals[$id][$recipient][$recipients_id][$day]['amount'] . ' грн.</td>';
														}
														echo '</tr>';
														echo '<tr class="rows' . $id . ' rows' . $id . $recipient . ' rows' . $id . $recipient . $recipients_id . '"><td></td>';
														foreach ($days as $day) {
															echo '<td nowrap valign="top">';
															foreach ($recipients_id_data['list'][date('Y-m-d', strtotime($day))] as $row) {
																echo $row['accidents_number'] . ' ' . $row['amount'] . '<br/>';
															}
															echo '</td>';
														}
													}
													
												} else {
													echo '<tr class="rows' . $id . ' rows' . $id . $recipient . ' rows' . $id . $recipient . $recipients_id . '"><td></td>';
													foreach ($days as $day) {
														echo '<td nowrap valign="top">';
														foreach ($type['list'][date('Y-m-d', strtotime($day))] as $row) {
															echo $row['accidents_number'] . ' ' . $row['amount'] . '<br/>';
														}
														echo '</td>';
													}
												}
												
												echo '</tr>';
											}
										}
										
										echo '<tr class="navigation">';
										echo '<td>Всього: </td>';
										foreach ($days as $day) {
											$count = 0;
											$amount = 0;
											foreach ($product_types_idx as $product_types_id => $title) {
												$count += $totals[$product_types_id][$day]['count'];
												$amount += $totals[$product_types_id][$day]['amount'];
											}
											echo '<td>' . intval($count) .  ' шт. - ' . (float)$amount . ' грн.</td>';
										}
										echo '</tr>';
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAccidentsPaymentsCalendarInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>