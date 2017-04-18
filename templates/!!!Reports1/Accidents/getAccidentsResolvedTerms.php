<script>
	function changeProductTypesId() {
		var sum_ptId = 0;
		
		$("#product_types_id option:selected").each(function(){
			sum_ptId += parseInt(this.value);
		});

		if (sum_ptId == 3) {
			$("#only_berlinBlock").show();
			$("input[name=only_berlin]").attr("disabled", "");
		} else {
			$("#only_berlinBlock").hide();			
			$("input[name=only_berlin]").attr("disabled", "disabled");
		}
	}
	
	$(document).ready(function(){
		changeProductTypesId();
	});
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
            <td class="caption">Строки врегулювання справи</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getAccidentsResolvedTerms" />
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
													<td rowspan="3"><b>Вид страхування:</b></td>
													<td rowspan="3">
														<select id="product_types_id" name="product_types_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="changeProductTypesId();">
																<option value="<?=PRODUCT_TYPES_KASKO?>" <?=(in_array(PRODUCT_TYPES_KASKO, $data['product_types_id']) ? 'selected' : '')?>>КАСКО</option>
																<option value="<?=PRODUCT_TYPES_GO?>" <?=(in_array(PRODUCT_TYPES_GO, $data['product_types_id']) ? 'selected' : '')?>>ОСЦПВ</option>
																<option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=(in_array(PRODUCT_TYPES_PROPERTY, $data['product_types_id']) ? 'selected' : '')?>>Майно</option>
                                                        </select>
														</br><div id="only_berlinBlock"><input type="checkbox" name="only_berlin" value="1" <?=(intval($data['only_berlin']) ? 'checked' : '')?>/> Берлін</div>
													</td>
                                                    <td rowspan="3"><b>Аварійний комісар:</b></td>
                                                    <td rowspan="3">
                                                        <select id="average_managers_id" name="average_managers_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="0" <?=(in_array(0, $data['average_managers_id']) ? 'selected' : '')?>>...</option>
                                                            <? foreach($evarage_managers as $evarage_manager) { ?>
																<option value="<?=$evarage_manager['id']?>" <?=(in_array($evarage_manager['id'], $data['average_managers_id']) ? 'selected' : '')?>><?=$evarage_manager['lastname']?> <?=$evarage_manager['firstname']?></option>
															<? } ?>
                                                        </select>
                                                    </td>
													<td rowspan="3"><b>Статус справи:</b></td>
                                                    <td rowspan="3">
                                                        <select id="accident_statuses_id" name="accident_statuses_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="0" <?=(in_array(0, $data['accident_statuses_id']) ? 'selected' : '')?>>...</option>
                                                            <? foreach($accident_statuses as $accident_status) { ?>
																<option value="<?=$accident_status['id']?>" <?=(in_array($accident_status['id'], $data['accident_statuses_id']) ? 'selected' : '')?>><?=$accident_status['title']?></option>
															<? } ?>
                                                        </select>
                                                    </td>
													<td colspan="6" style="vertical-align: top;"><b>Дата :</b></td>                                                
                                                    <td rowspan="3" style="vertical-align: bottom;">&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
                                                </tr>
												<tr>
													<td colspan="2"></td>
													<td>написання заяви:&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>AccidentsDate" name="fromAccidentsDate" value="<?=$data['fromAccidentsDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>AccidentsDate" name="toAccidentsDate" value="<?=$data['toAccidentsDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td>вругелювання справи:&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>ResolvedDate" name="fromResolvedDate" value="<?=$data['fromResolvedDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>ResolvedDate" name="toResolvedDate" value="<?=$data['toResolvedDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
									<tr align="center">
										<td>&nbsp;</td>
									<? foreach ($fields as $field => $attr) { ?>
										<td>
											<input type="checkbox" name="fields[]" value="<?=$field?>" checked="true"/>
										</td>
									<? } ?>
									<tr>
                                    <tr class="columns">
                                        <td>№ п/п</td>
                                        <td>Номер справи</td>
										<td>Дата події</td>
										<td>Орієнтовний збиток</td>
										<td>Фактичний збиток</td>
										<td>Дата передачі справи в СК</td>
										<td>Дата виплати СВ</td>
										<td>Отримувач СВ</td>
										<td>Відповідальний <br/>(аварком)</td>
										<td>Відповідальний <br/>(експерт)</td>
										<td>Кількість днів з моменту внесення заяви в базу до моменту класифікації</td>
										<td>Кількість днів справа знаходиться в класифікації на момент формування звіту (<?=date('d.m.Y')?>)</td>																				
										<td>Кількість днів з моменту класифікації до статусу "розгляд"</td>										
										<td>Відповідальний за класифікацію</td>
										<td>Експертна робота</td>
										<td>Кількість днів на розгляді від статусу «класифікація» до статусу «передано в СК»</td>
										<td>Кількість днів справа знаходиться у розгляді на момент формування звіту (<?=date('d.m.Y')?>)</td>
										<td>Кількість днів на розгляді з моменту класифікації (статус "розгляд") до переведення справи у статус "затвердження"</td>
										<td>Кількість днів справа знаходиться в затвердженні на момент формування звіту (<?=date('d.m.Y')?>)</td>
										<td>Кількість днів з моменту розгляду (статус "затвердження") до переведення справи у статус "передача в СК"</td>
										<td>Кількість днів від переведення справи в статус "передача в СК" до статусу "оплата" чи "врегульовано"</td>
										<td>Кількість днів від переведення справи в статус "прийом заяви" до статусу "оплата" чи "врегульовано"</td>
										<td>Кількість днів в статусі "оплата"</td>
                                        <td>Кількість днів з моменту внесення заяви в базу до статусу "врегулювання"</td>
										<td>Статус справи</td>
										<td>Категорія справи</td>
                                    </tr>
                                <? if (sizeOf($list)) {?>									
                                    <?
										$total = sizeof($list);
										$count_to_classification = 0;
										$count_classification = 0;
										$count_investigation = 0;
										$count_experts = 0;
										$count_approval = 0;										
										$count_approval_express = 0;
										$count_approval_standart = 0;
										$count_between_create_transfer_plus = 0;
										$count_between_create_transfer_plus_express = 0;
										$count_between_create_transfer_plus_standart = 0;
										$count_payments = 0;
										$i = 0;
										$number = 0;
										$divisor = 24 * 60 * 60;
										
										$total_duration_to_classification = 0;
										$total_duration_classification_current = 0;
										$total_duration_classification = 0;
										$total_duration_expert_messages = 0;
										$total_duration_classification_to_transfer = 0;
										$total_duration_investigation_current = 0;
										$total_duration_investigation = 0;
										$total_duration_approval_current = 0;
										$total_duration_approval = 0;
										$total_duration_approval_express = 0;
										$total_duration_approval_standart = 0;
										$total_duration_transfer = 0;
										$total_duration_between_create_transfer_plus = 0;
										$total_duration_between_create_transfer_plus_express = 0;
										$total_duration_between_create_transfer_plus_standart = 0;
										$total_duration_payments = 0;
										$total_duration_resolved = 0;
                                        foreach ($list as $row) {
                                            $i = 1 - $i;
											$number++;
											
											$duration_to_classification = roundNumber($row['duration_to_classification'] / $divisor, 2);
											$duration_classification_current = roundNumber($row['duration_classification_current'] / $divisor, 2);
											$duration_classification = roundNumber($row['duration_classification'] / $divisor, 2);
											$duration_expert_messages = roundNumber(AccidentMessages::getMessagesDuration(array('list' => $row['messages_list'])) / $divisor, 2);
											$duration_classification_to_transfer = roundNumber($row['duration_classification_to_transfer'] / $divisor, 2);
											$duration_investigation_current = roundNumber($row['duration_investigation_current'] / $divisor, 2);
											$duration_investigation = roundNumber($row['duration_investigation'] / $divisor, 2);
											$duration_approval_current = roundNumber($row['duration_approval_current'] / $divisor, 2);
											$duration_approval = roundNumber($row['duration_approval'] / $divisor, 2);
											$duration_transfer = roundNumber($row['duration_transfer'] / $divisor, 2);
											$duration_between_create_transfer_plus = roundNumber($row['duration_between_create_transfer_plus'] / $divisor, 2);
											$duration_resolved = roundNumber($row['duration_resolved'] / $divisor, 2);
											$duration_payemts = roundNumber($row['duration_payments'] / $divisor, 2);
											
											if ($row['duration_to_classification'] > 0) {
												$count_to_classification++;
											}
											if ($row['duration_classification'] > 0) {
												$count_classification++;
											}
											if ($row['duration_investigation'] > 0) {
												$count_investigation++;
											}
											if (AccidentMessages::getMessagesDuration(array('list' => $row['messages_list'])) > 0) {
												$count_experts++;
											}
											if ($row['duration_approval'] > 0) {
												$count_approval++;
											}
											if ($row['duration_approval'] > 0 && $row['accident_sections_id'] == 1) {
												$count_approval_express++;
												$total_duration_approval_express += $duration_approval;
											}
											if ($row['duration_approval'] > 0 && $row['accident_sections_id'] == 2) {
												$count_approval_standart++;
												$total_duration_approval_standart += $duration_approval;
											}											
											if ($row['duration_between_create_transfer_plus'] > 0) {
												$count_between_create_transfer_plus++;
											}
											if ($row['duration_between_create_transfer_plus'] > 0 && $row['accident_sections_id'] == 1) {
												$count_between_create_transfer_plus_express++;
												$total_duration_between_create_transfer_plus_express += $duration_between_create_transfer_plus;
											}
											if ($row['duration_between_create_transfer_plus'] > 0 && $row['accident_sections_id'] == 2) {
												$count_between_create_transfer_plus_standart++;
												$total_duration_between_create_transfer_plus_standart += $duration_between_create_transfer_plus;
											}
											if ($row['duration_payments'] > 0) {
												$count_payments++;
												$total_duration_payments += $duration_payemts;
											}
											
											$total_duration_to_classification += $duration_to_classification;
											$total_duration_classification_current += $duration_classification_current;
											$total_duration_classification += $duration_classification;
											$total_duration_expert_messages += $duration_expert_messages;
											$total_duration_classification_to_transfer += $duration_classification_to_transfer;
											$total_duration_investigation_current += $duration_investigation_current;
											$total_duration_investigation += $duration_investigation;
											$total_duration_approval_current += $duration_approval_current;
											$total_duration_approval += $duration_approval;
											$total_duration_transfer += $duration_transfer;
											$total_duration_between_create_transfer_plus += $duration_between_create_transfer_plus;
											$total_duration_resolved += $duration_resolved;
                                    ?>
                                    <tr class="<?=Form::getRowClass($row, $i)?>">
                                        <td><?=$number?></td>										
                                        <td><?=$row['accidents_number']?></td>
										<td><?=$row['accidents_date']?></td>
										<td><?=$row['accidents_amount_rough']?></td>
										<td><?=$row['accidents_acts_amount']?></td>
										<td><?=$row['get_express_date']?></td>
										<td><?=$row['accidents_payment_date']?></td>
										<td><?=$row['accidents_payment_recipient']?></td>
										<td><?=$row['average_managers_name']?></td>
										<td><?=$row['estimate_managers_name']?></td>
                                        <td><?=str_replace('.', ',', $duration_to_classification)?></td>
										<td><?=str_replace('.', ',', $duration_classification_current)?></td>
                                        <td><?=str_replace('.', ',', $duration_classification)?></td>										
										<td><?=$row['classification_responsible']?></td>
										<td><?=str_replace('.', ',', $duration_expert_messages)?></td>
										<td><?=str_replace('.', ',', $duration_classification_to_transfer)?></td>
										<td><?=str_replace('.', ',', $duration_investigation_current)?></td>
                                        <td><?=str_replace('.', ',', $duration_investigation)?></td>
										<td><?=str_replace('.', ',', $duration_approval_current)?></td>
                                        <td><?=str_replace('.', ',', $duration_approval)?></td>
										<td><?=str_replace('.', ',', $duration_transfer)?></td>
										<td><?=str_replace('.', ',', $duration_between_create_transfer_plus)?></td>
										<td><?=str_replace('.', ',', $duration_payemts)?></td>
                                        <td><?=str_replace('.', ',', $duration_resolved)?></td>
										<td><?=$row['accident_statuses_title']?></td>
										<td><?=$row['accident_sections_title']?></td>
                                    </tr>
                                    <? } ?>
								<tr class="navigation">
									<td colspan="10" class="paging">Всьго: <?=(sizeof($list))?></td>
									<td><?=str_replace('.', ',', $total_duration_to_classification)?></td>
									<td><?=str_replace('.', ',', $total_duration_classification_current)?></td>
									<td><?=str_replace('.', ',', $total_duration_classification)?></td>
									<td>&nbsp;</td>
									<td><?=str_replace('.', ',', $total_duration_expert_messages)?></td>
									<td><?=str_replace('.', ',', $total_duration_classification_to_transfer)?></td>
									<td><?=str_replace('.', ',', $total_duration_investigation_current)?></td>
									<td><?=str_replace('.', ',', $total_duration_investigation)?></td>
									<td><?=str_replace('.', ',', $total_duration_approval_current)?></td>
									<td><?=str_replace('.', ',', $total_duration_approval)?></td>
									<td><?=str_replace('.', ',', $total_duration_transfer)?></td>
									<td><?=str_replace('.', ',', $total_duration_between_create_transfer_plus)?></td>
									<td><?=str_replace('.', ',', $total_duration_payments)?></td>
									<td><?=str_replace('.', ',', $total_duration_resolved)?></td>
									<td colspan="2">&nbsp;</td>
								</tr>								                                
                                <? }?>
								<tr><td colspan="19">&nbsp;</td></tr>
								<tr><td colspan="19">&nbsp;</td></tr>
								<tr>
									<td colspan="19">
										<b>Прийом заяви</b> - <?=$count_to_classification?> справ, середня кількість днів -
											<?=roundNumber($total_duration_to_classification / $count_to_classification, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_to_classification / $count_to_classification, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_to_classification / $count_to_classification, 2) - intval(roundNumber($total_duration_to_classification / $count_to_classification, 2))) * 24, 0)?> год.)
									</td>
								</tr>
								<tr>
									<td colspan="19">
										<b>Класифікація</b> - <?=$count_classification?> справ, середня кількість днів -
											<?=roundNumber($total_duration_classification / $count_classification, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_classification / $count_classification, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_classification / $count_classification, 2) - intval(roundNumber($total_duration_classification / $count_classification, 2))) * 24, 0)?> год.)
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										<b>Розгляд</b> - <?=$count_investigation?> справ, середня кількість днів -
											<?=roundNumber($total_duration_investigation / $count_investigation, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_investigation / $count_investigation, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_investigation / $count_investigation, 2) - intval(roundNumber($total_duration_investigation / $count_investigation, 2))) * 24, 0)?> год.)
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										<b>Опрацювання експертами</b> - <?=$count_experts?> справ, середня кількість днів -
											<?=roundNumber($total_duration_expert_messages / $count_experts, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_expert_messages / $count_experts, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_expert_messages / $count_experts, 2) - intval(roundNumber($total_duration_expert_messages / $count_experts, 2))) * 24, 0)?> год.)
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										<b>Затвердження</b> - <?=$count_approval?> справ, середня кількість днів -
											<?=roundNumber($total_duration_approval / $count_approval, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_approval / $count_approval, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_approval / $count_approval, 2) - intval(roundNumber($total_duration_approval / $count_approval, 2))) * 24, 0)?> год.)
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										з них <b>експрес справи</b> - <?=$count_approval_express?> справ, середня кількість днів -
											<?=roundNumber($total_duration_approval_express / $count_approval_express, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_approval_express / $count_approval_express, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_approval_express / $count_approval_express, 2) - intval(roundNumber($total_duration_approval_express / $count_approval_express, 2))) * 24, 0)?> год.);
										з них <b>стандарт справи</b> - <?=$count_approval_standart?> справ, середня кількість днів -
											<?=roundNumber($total_duration_approval_standart / $count_approval_standart, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_approval_standart / $count_approval_standart, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_approval_standart / $count_approval_standart, 2) - intval(roundNumber($total_duration_approval_standart / $count_approval_standart, 2))) * 24, 0)?> год.);
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										<b>Строк врегулювання</b> - <?=$count_between_create_transfer_plus?> справ, середня кількість днів -
											<?=roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2) - intval(roundNumber($total_duration_between_create_transfer_plus / $count_between_create_transfer_plus, 2))) * 24, 0)?> год.)
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										з них <b>експрес справи</b> - <?=$count_between_create_transfer_plus_express?> справ, середня кількість днів -
											<?=roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2) - intval(roundNumber($total_duration_between_create_transfer_plus_express / $count_between_create_transfer_plus_express, 2))) * 24, 0)?> год.);
										з них <b>стандарт справи</b> - <?=$count_between_create_transfer_plus_standart?> справ, середня кількість днів -
											<?=roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2) - intval(roundNumber($total_duration_between_create_transfer_plus_standart / $count_between_create_transfer_plus_standart, 2))) * 24, 0)?> год.);
									</td>								
								</tr>
								<tr>
									<td colspan="19">
										<b>Строк оплати</b> - <?=$count_payments?> справ, середня кількість днів -
											<?=roundNumber($total_duration_payments / $count_payments, 2)?> дн. 
											(<?=intval(roundNumber($total_duration_payments / $count_payments, 2))?> дн. 
											<?=roundNumber((roundNumber($total_duration_payments / $count_payments, 2) - intval(roundNumber($total_duration_payments / $count_payments, 2))) * 24, 0)?> год.)
									</td>								
								</tr>
								</table>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAccidentsResolvedTermsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>