<script>
	function changePaymentStatusId(payment_statuses_id) {
		if (payment_statuses_id == 1) {
			$('#infoDate').html('Гранична дата виплати');
		} else if (payment_statuses_id == 2) {
			$('#infoDate').html('Фактична дата виплати');
		} else {
			$('#infoDate').html('');
		}
	}

	function setRealLimitPaymentDate(id, value) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			async:		false,
			data:		'do=AccidentPaymentsCalendar|setRealLimitPaymentDateInWindow' +
						'&id=' + id +
						'&date=' + value,
			success: 	function(result) {
			console.log(result);
							$('#messages_block').html(result.html);
							$('#messages_block').show();
							for (id in result.idx) {
							console.log(result.idx[id]);
								$('input[name=real_limit_payment_date' + result.idx[id] + ']').val(value);
							}
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
			<td></td>
			<td id="messages_block" onclick="$('#messages_block').hide();" style="cursor: pointer;"></td>
		</tr>
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Виплати:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getAccidentsPayments" />
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
													<td><b>Статус оплати:</b></td>
													<td>
														<select onchange="changePaymentStatusId(this.value)" name="payment_statuses_id" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'">
															<option value="1" <?=($data['payment_statuses_id'] == 1 ? 'selected' : '')?>>Не сплачено</option>
															<option value="2" <?=($data['payment_statuses_id'] == 2 ? 'selected' : '')?>>Сплачено</option>
														</select>
													</td>
													<td><b id="infoDate">Гранична дата виплати:</b></td>
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
                                        <td align="center">Справа</td>
										<td align="center">Статус</td>
										<td align="center">Договір/поліс</td>
										<td align="center">Страхувальник</td>
                                        <td align="center">Отримувач</td>
                                        <td align="center">Сума</td>
                                        <td align="center">Дата виплати</td>
                                        <td align="center">Гранична дата виплати</td>
										<? if ($data['payment_statuses_id'] == 1) { ?>
											<td>Планова дата виплати</td>
										<? } ?>
                                    </tr>
                                    <?
										$total['count'] = 0;
										$total['amount'] = 0;
									
                                        foreach ($values as $id => $product_type) {
											if ($data['payment_statuses_id'] == 1) {
												echo '<tr class="columns"><td><a href="javascript:rowsHideShow(' . $id . ')">' . $product_type['title'] . '</a></td><td id="info' . $id . '" colspan="9"></td></tr>';
											} else {
												echo '<tr class="columns"><td><a href="javascript:rowsHideShow(' . $id . ')">' . $product_type['title'] . '</a></td><td id="info' . $id . '" colspan="8"></td></tr>';
											}											
											
											$count_total = 0;
											$amount_total = 0;
											
											foreach ($product_type['list'] as $recipient => $type) {
												if (!sizeof($type['list'])) continue;
												
												if ($data['payment_statuses_id'] == 1) {
													echo '<tr bgcolor="1c94e4" class="rows' . $id . '"><td valign="top" ><a href="javascript:rowsHideShow(\'' . $id . $recipient . '\')">' . $type['title'] . '</a></td><td id="info' . $id . $recipient . '" colspan="9"></td></tr>';
												} else {
													echo '<tr bgcolor="1c94e4" class="rows' . $id . '"><td valign="top" ><a href="javascript:rowsHideShow(\'' . $id . $recipient . '\')">' . $type['title'] . '</a></td><td id="info' . $id . $recipient . '" colspan="8"></td></tr>';
												}
												
												$count = 0;
												$amount = 0;
												
												foreach ($type['list'] as $row) {
													$count++;
													$amount += $row['amount'];
													echo '<tr class="rows' . $id . ' rows' . $id . $recipient . '">';
													echo '<td></td>';
													echo '<td>' . $row['accidents_number'] . '</td>';
													echo '<td>' . $row['statuses_title'] . '</td>';
													echo '<td>' . $row['policies_number'] . '</td>';
													echo '<td>' . $row['insurer'] . '</td>';
													echo '<td>' . $row['recipient'] . '</td>';
													echo '<td>' . $row['amount'] . '</td>';
													echo '<td>' . $row['payment_date'] . '</td>';
													echo '<td>' . $row['theory_limit_payment_date'] . '</td>';
													if ($data['payment_statuses_id'] == 1 && in_array($Authorization->data['id'], array(1, 11466))) {
														echo '<td width="110">
																<input onchange="setRealLimitPaymentDate(' . $row['calendar_id'] . ', this.value)" type="text" id="real_limit_payment_date' . $row['calendar_id'] .'" name="real_limit_payment_date' . $row['calendar_id'] .'" value="' . $row['real_limit_payment_date'] . '" class="fldDatePicker" />
															  </td>';
													}  elseif ($data['payment_statuses_id'] == 1) {
														echo '<td>' . $row['real_limit_payment_date'] . '</td>';
													}
													echo '</tr>';
												}
												$count_total += $count;
												$amount_total += $amount;
												
												echo '<script>
													$("#info' . $id . $recipient . '").html("Всього: ' . $count .  ' шт. на суму ' . $amount . ' грн.");
												  </script>';
											}
											
											$total['count'] += $count_total;
											$total['amount'] += $amount_total;
											echo '<script>
													$("#info' . $id . '").html("Всього: ' . $count_total .  ' шт. на суму ' . $amount_total . ' грн.");
												  </script>';
										}
										
										if ($data['payment_statuses_id'] == 1) {
											echo '<tr class="navigation"><td valign="top" >Всього: ' . $total['count'] .  ' шт. на суму ' . $total['amount'] . ' грн.</td><td colspan="9"></td></tr>';
										} else {
											echo '<tr class="navigation"><td valign="top" >Всього: ' . $total['count'] .  ' шт. на суму ' . $total['amount'] . ' грн.</td><td colspan="8"></td></tr>';
										}
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <!--
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAccidentsPaymentsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                    // -->
                </script>
            </td>
        </tr>
    </table>
</div>