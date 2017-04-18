<script>
function setProd(item_years_payments_id,prod_id) {

		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			async:		false,
			data:		'do=Reports|setPoliciesKaskoItemYearsPaymentsInWindow'+
						'&item_years_payments_id='+item_years_payments_id+
						'&prod_id='+prod_id,
			success: 	function(result) {
							alert(result);
						}
		});

}

$(document).ready(function(){
	$('#notexcel').click(
	function(){
		if ($(this).attr('checked'))
			$('#InWindow').val(0);
		else	
			$('#InWindow').val(1);
	}
	)
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
            <td class="caption">Договори страхування в розрізі страхових періодів:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getInsurancePeriods" />
					<input type="hidden" id="InWindow" name="InWindow" value="<?=$data['notexcel'] ? 0 : 1?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="right">
											
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
												<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
													<td>
														<b>Особа:</b> 
														<select name="insurer_person_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="">...</option>
															<option value="1" <?=($data['insurer_person_types_id'] == 1) ? 'selected' : ''?>>Фізична</option>
															<option value="2" <?=($data['insurer_person_types_id'] == 2) ? 'selected' : ''?>>Юридична</option>
														</select>
													</td>
												<?}?>	
													<td>
														<b>Вид страхування:</b> 
														<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="<?=PRODUCT_TYPES_KASKO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : ''?>>КАСКО</option>
															<option value="<?=PRODUCT_TYPES_GO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : ''?>>ОСЦПВ</option>
															<option value="<?=PRODUCT_TYPES_DGO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_DGO) ? 'selected' : ''?>>ДСЦВ</option>
															<!--option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=($data['product_types_id'] == PRODUCT_TYPES_PROPERTY) ? 'selected' : ''?>>Майно</option-->
															<option value="<?=PRODUCT_TYPES_NS?>" <?=($data['product_types_id'] == PRODUCT_TYPES_NS) ? 'selected' : ''?>>Нещасні випадки</option>
															<option value="<?=PRODUCT_TYPES_MORTAGE?>" <?=($data['product_types_id'] == PRODUCT_TYPES_MORTAGE) ? 'selected' : ''?>>Іпотека</option>
														</select>
													</td>
												<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>	
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
                                                        <b>Головна агенція:</b>
                                                        <?
                                                        echo '<select name="agencies_top_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                                        echo '<option value="">...</option>';
                                                        foreach ($agencies_top as $agency_top) {
                                                            echo ($agency_top['id'] == $data['agencies_top_id'])
                                                                ? '<option value="' . $agency_top['id'] . '" selected>' . $agency_top['title'] . '</option>'
                                                                : '<option value="' . $agency_top['id'] . '">' . $agency_top['title'] . '</option>';
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
												<? } ?>	
                                                </tr>
                                            </table>
											
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
												<?if ($data['specialuser']) {?>
													<td>
													<b>Виводити на сторiнку:</b>
													<input id="notexcel" type="checkbox" value="1" name="notexcel" <?=$data['notexcel'] ? 'checked' :'' ?>>
													</td>
												<?}?>
													<td>
														<b>Страхові випадки:</b>
														<input id="with_accidents" type="checkbox" value="1" name="with_accidents" <?=$data['with_accidents'] ? 'checked' :'' ?>>
													</td>
													<td>
														<b>Звіт:</b>
														<select name="types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="0" <?=(intval($data['types_id']) == 0 ? 'selected' : '')?>>По договорах</option>
															<option value="1" <?=(intval($data['types_id']) == 1 ? 'selected' : '')?>>За каналами</option>
															<option value="2" <?=(intval($data['types_id']) == 2 ? 'selected' : '')?>>По агенціям</option>
															<option value="4" <?=(intval($data['types_id']) == 2 ? 'selected' : '')?>>По агенціям / бренди</option>
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
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                   <?php if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>
									<tr class="columns">
										<td colspan="12">Договір</td>
										<td colspan="6">Страхувальник</td>
										<td colspan="2">Об'єкт</td>
										<td colspan="15">Період страхування</td>
										<td colspan="4">Продавець</td>
										<td colspan="2">Підписант</td>
										<td colspan="2">Комісія агента</td>
										<td colspan="3">Комісія банка</td>
                                        <td colspan="8">Задача</td>
									</tr>
									<tr class="columns">
										<td>Номер</td>
										<td>Дата</td>
										<td>Початок</td>
										<td>Закінчення</td>
										<td>Банк</td>
										<td>Статус</td>
										<td>Додаткова угода</td>
										<td>Багаторічний</td>
										<td>Документи</td>
										<td>Комісія</td>
										<td>Опція "Тест-драйв"</td>
										<td>Опція "Перегон"</td>

										<td>Особа</td>
										<td>Назва/ПІБ</td>
										<td>Дата народження</td>
                                        <td>VIP</td>
										<td>Група</td>
										<td>ІПН/ЄДРПОУ</td>
										 

										<td>Марка/Модель</td>
										<td>Кузов</td>

										<td>Продукт</td>
										<td>Вірогідний продукт</td>
										<td>Попередній продукт</td>
										<!--<td>Формула</td>-->
                                        <td>Коментар андерайтера</td>
										<td>Сума, грн.</td>
										<td>Тариф, %</td>
										<td>Премія, грн.</td>
										<td>Сплачено, грн.</td>
										<td>Сплата</td>
										<td>Початок</td>
										<td>Закінчення</td>
										<td>Пролонгація</td>
										<td>Номер платежу (розбивка)</td>
										<td>Рік страхування</td>
										<td>Другий платіж "50/50"</td>

										<td>Головна агенція</td>
										<td>Агенція</td>
										<td>Канал</td>
										<td>Продавець</td>

										<td>Агенція</td>
										<td>Продавець</td>

										<td>%</td>
										<td>грн.</td>
										<td>% від СС</td>
										<td>% від премії</td>
										<td>грн.</td>

                                        <td>Виконавець</td>
                                        <td>Тип</td>
                                        <td>Результат дзвінка</td>
                                        <td>Дата дзвінка</td>
                                        <td>Статус</td>
                                        <td>Стан</td>
                                        <td>Дата статуса</td>
                                        <td>Коментарі</td>
									</tr>
									<?
											if (sizeOf($list)) {
												$i = 0;
												foreach ($list as $row) {
													$i = 1 - $i;
                                                    list($row['task_statuses_title'], $row['task_states_title']) = explode(' \\ ', $row['task_statuses_full_title']);
										?>
										<tr class="<?=Form::getRowClass($row, $i)?>">
											<td><?=$row['policies_number']?></td>
											<td><?=$row['policies_date']?></td>
											<td><?=$row['policies_begin_datetime_format']?></td>
											<td><?=$row['policies_end_datetime_format']?></td>
											<td><?=$row['financial_institutions_title']?></td>
											<td><?=$row['policy_statuses_title']?></td>
											<td><?=$row['is_agr_title']?></td>
											<td><?=$row['long_term']?></td>
											<td><?=$row['policies_documents']?></td>
											<td><?=$row['policies_commission']?></td>
											<td><?=$row['options_test_drive']?></td>
											<td><?=$row['options_race']?></td>

											<td><?=($row['insurer_person_types_id'] == 1) ? 'Фізична' : 'Юридична'?></td>
											<td><?=$row['insurer']?></td>
											<td><?=$row['insurer_dateofbirth_format']?></td>
                                            <td><?=($row['important_person'] == 1) ? 'Так' : 'Ні'?></td>
											<td><?=$row['client_groups_title']?></td>
											<td><?=$row['insurer_identification']?></td>

											<td><?=$row['item']?></td>
											<td><?=$row['shassi']?></td>

											<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
												<td><?=$row['policies_kasko_item_years_payments_products_title']?></td>
											
												<?php if ($row['policies_kasko_item_years_payments_products_title'] == '') { 
														if ($row['begin_datetime_format'] != $row['policies_begin_datetime_format']) {
															if (intval($row['financial_institutions_id'])) {
																$sql = 'select a.id,concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
																		from insurance_products as a
																		join insurance_products_kasko as b on a.id = b.products_id
																		join insurance_products_related as c on a.id = c.related_products_id
																		join insurance_product_financial_institution_assignments as d on a.id = d.products_id
																		join insurance_product_agency_assignments as e on a.id = e.products_id
																		where c.products_id = ' . intval($row['products_id']) . ' and d.financial_institutions_id = ' . intval($row['financial_institutions_id']) . ' and e.agencies_id = ' . intval($row['agencies_id']);
																$new_products = $db->getAssoc($sql);
															} else {
																$sql = 'select a.id,concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
																		from insurance_products as a
																		join insurance_products_kasko as b on a.id = b.products_id
																		join insurance_products_related as c on a.id = c.related_products_id
																		join insurance_product_agency_assignments as e on a.id = e.products_id
																		where c.products_id = ' . intval($row['products_id']) . ' and e.agencies_id = ' . intval($row['agencies_id']);
																$new_products = $db->getAssoc($sql);
															}
															
															$row['probability_products_title'] = $new_products;
														} else {
															$sql = 'select a.id,concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
																	from insurance_products as a
																	join insurance_products_kasko as b on a.id = b.products_id
																	where a.id = ' . intval($row['products_id']);
															$new_product = $db->getAssoc($sql);
															
															$row['probability_products_title'] =  $new_product;
														}
												?>
													<td><?
													if (is_array($row['probability_products_title'])) {
														foreach($row['probability_products_title'] as $k=>$prodtitle) {
															echo '<a href="JavaScript:setProd('.$row['item_years_payments_id'].','.$k.')">'.$prodtitle.'</a> ';
														}
													
													}
													?></td>
												<? } else { ?>
													<td>&nbsp;</td>
												<? } ?>
												
											<?
												$sql = 'select concat(a.title, \'(знижка для банку: \', b.bank_discount_value, \', компенсація для банку: \', b.bank_commission_value, \')\')
														from insurance_products as a
														join insurance_products_kasko as b on a.id = b.products_id
														join insurance_policies_kasko_items as c on b.products_id = c.products_id
														join insurance_policies as d on c.policies_id = d.id
														where d.id = ' . intval($row['policies_top']) . ' and d.parent_id = 0';
												$first_product = $db->getOne($sql);
											?>
											<td><?=$first_product?></td>
												
											<!--<td><?=$row['policies_kasko_item_years_payments_formula']?></td>-->
                                            <td><?=$row['policies_kasko_comment_quote']?></td>
											<?php } ?>
											<td align="right"><?=getMoneyFormat($row['price'], -1)?></td>
											<td align="right"><?=getRateFormat($row['rate'])?></td>
											<td align="right"><?=getMoneyFormat($row['amount'], -1)?></td>
											<td align="right"><?=getMoneyFormat($row['policy_payments_calendar_amount'], -1)?></td>
											<td><?=$row['payments_date']?></td>
											<td><?=$row['begin_datetime_format']?></td>
											<? if(intval($row['payment_brakedown_id']) === 1) {
												echo "<td>".$row['policies_end_datetime_format']."</td>";
											} else {
												echo "<td>".$row['interrupt_datetime_format']."</td>";
											} ?>
											<td><?=$row['prolongation_number']?></td>
											<td><?=$row['number_part_payment']?></td>
											<td><?=$row['number_insurance_year']?></td>
											<td><?=$row['second_fifty_fifty_title']?></td>

											<td><?=$row['agencies_parent_title']?></td>
											<td><?=$row['agencies_title']?></td>
											<td><?=$row['agency_types_title']?></td>
											<td><?=$row['seller']?></td>

											<td><?=$row['seller_agencies_title']?></td>
											<td><?=$row['seller_agents_title']?></td>

											<td><?=$row['policies_commission_agent_percent']?></td>
											<td><?=$row['policy_payments_calendar_commission_agent_amount']?></td>

											<?php if (in_array($_SESSION['auth']['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
											<td><?=$row['policies_kasko_item_years_payments_bank_discount_value']?></td>
											<td><?=$row['policies_kasko_item_years_payments_bank_commission_value']?></td>
											<td><?=round($row['policy_payments_calendar_amount'] * (1 - round(1/$row['policies_kasko_item_years_payments_bank_discount_value'], 3)) + $row['price'] * $row['policies_kasko_item_years_payments_bank_commission_value'] * $row['policy_payments_calendar_amount'] / $row['amount'] / 100, 2)?></td>
											<?php } ?>

                                            <td><?=$row['task_performers_title']?></td>
                                            <td><?=$row['task_types_title']?></td>
                                            <td><?=$row['task_statuses_call_title']?></td>
                                            <td><?=$row['task_statuses_call_date']?></td>
                                            <td><?=$row['task_statuses_title']?></td>
                                            <td><?=$row['task_states_title']?></td>
                                            <td><?=$row['task_statuses_date']?></td>
                                            <td><?=$row['task_comment']?></td>
										</tr>
										<?
												}
											}
										?>
									<? } ?>	
                                </table>
                            </td>
                        </tr>
					</table>
                </form>
            </td>
        </tr>
    </table>
</div>