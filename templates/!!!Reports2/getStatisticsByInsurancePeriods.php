<script>
	$(document).ready(function(){
		$('.amount').keypress(function(event){
			var key, keyChar;
			if(!event) var event = window.event;

			if (event.keyCode) key = event.keyCode;
			else if(event.which) key = event.which;

			if(
				key == 8				 	||	//backspace
				key == 13					||	//enter
				(key >= 48 && key <= 57)	||	// 0..9
				key == 45					||	//-
				key == 59					||	//;
				key == 37					||
				key == 38					|| 
				key == 39					||
				key == 40					||
				key == 46					||
				key == 35					||
				key == 36					||
				key == 9
				)
			{
				return true;
			} else {
				return false;
			}
		});
	})
</script>

<style>
	.filter {
		color: white !important;
		background-color: blue !important;
	}
</style>

<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Статистика по ТЗ, витрати:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getStatisticsByinsurancePeriods" />
			<table width="80%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td align="left">
							<table cellpadding="0" cellspacing="5" border="0">
							<!--tr>
								<td>
									<b>Вид страхування:</b>
									<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                        <option value="<?=PRODUCT_TYPES_KASKO?>">КАСКО</option>
                                        <option value="<?=PRODUCT_TYPES_GO?>">ЦВ</option>
                                    </select>
								</td>
							</tr-->
							<tr>
								<td><b style="font-size: 14;">Договір.</b></td>
							</tr>
							<tr>
								<td>
									<b>Номер</b>
									<input type="text" id="policies_number" name="policies_number" value="<?=$data['policies_number']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" />
								</td>
								<td>
									<b>Страхувальник</b>
									<input type="text" id="insurer" name="insurer" value="<?=$data['insurer']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" />									
								</td>
								<td>
									<b>ІПН / код ЄДРПОУ</b>
									<input type="text" id="insurer_code" name="insurer_code" value="<?=$data['insurer_code']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" />									
								</td>
								<td>
									<b>Статус</b>
									<select name="policy_statuses_id[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';">
										<?
											foreach ($policy_statuses_id as $policy_status_id) {
												echo '<option value="' . $policy_status_id['id'] . '" ' . (in_array($policy_status_id['id'], $data['policy_statuses_id']) ? 'selected' : '') . '>' . $policy_status_id['title'] . '</option>';
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td><b>Дата укладання</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromPolicyDate<?=$this->objectTitle?>" name="fromPolicyDate" value="<?=$data['fromPolicyDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toPolicyDate<?=$this->objectTitle?>" name="toPolicyDate" value="<?=$data['toPolicyDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Дата початку</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromPolicyBeginDate<?=$this->objectTitle?>" name="fromPolicyBeginDate" value="<?=$data['fromPolicyBeginDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toPolicyBeginDate<?=$this->objectTitle?>" name="toPolicyBeginDate" value="<?=$data['toPolicyBeginDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Дата закінчення</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromPolicyEndDate<?=$this->objectTitle?>" name="fromPolicyEndDate" value="<?=$data['fromPolicyEndDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toPolicyEndDate<?=$this->objectTitle?>" name="toPolicyEndDate" value="<?=$data['toPolicyEndDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>								
							</tr>
							<tr>
								<td><b style="font-size: 14;">Об'єкт.</b></td>
							</tr>
							<tr>
								<td>
									<b>Тип</b>
									<?=CarTypes::getListForHTML($data)?>
								</td>
								<td>
									<b>Марка</b>
									<?=CarBrands::getListForHTML($data)?>
								</td>
								<td>
									<b>Державний номер</b>
									<input type="text" id="item_sign" name="item_sign" value="<?=$data['item_sign']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" />
								</td>
								<td>
									<b>Шасі / VIN</b>
									<input type="text" id="item_shassi" name="item_shassi" value="<?=$data['item_shassi']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" />
								</td>
							</tr>
							<tr>
								<td><b style="font-size: 14;">Періоди.</b></td>
							</tr>
							<tr>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Дата початку</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromPeriodBeginDate<?=$this->objectTitle?>" name="fromPeriodBeginDate" value="<?=$data['fromPeriodBeginDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toPeriodBeginDate<?=$this->objectTitle?>" name="toPeriodBeginDate" value="<?=$data['toPeriodBeginDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Дата закінчення</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromPeriodEndDate<?=$this->objectTitle?>" name="fromPeriodEndDate" value="<?=$data['fromPeriodEndDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toPeriodEndDate<?=$this->objectTitle?>" name="toPeriodEndDate" value="<?=$data['toPeriodEndDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
								<td>
									<b>Страхова сума</b>
									<input type="text" id="car_price" name="car_price" value="<?=$data['car_price']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
								<td>
									<b>Оплачена премія</b>
									<input type="text" id="item_payments_amount" name="item_payments_amount" value="<?=$data['item_payments_amount']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
							</tr>
							<tr>
								<td>
									<b>Комісія агенту</b>
									<input type="text" id="commission_agent_amount" name="commission_agent_amount" value="<?=$data['commission_agent_amount']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
								<td>
									<b>Комісія директора</b>
									<input type="text" id="commission_director1_amount" name="commission_director1_amount" value="<?=$data['commission_director1_amount']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
								<td>
									<b>Комісія заст. директора</b>
									<input type="text" id="commission_director2_amount" name="commission_director2_amount" value="<?=$data['commission_director2_amount']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
							</tr>
							<tr>
								<td><b style="font-size: 14;">Страхові випадки.</b></td>
							</tr>
							<tr>
								<td>
									<b>Номер</b>
									<input type="text" id="accidents_number" name="accidents_number" value="<?=$data['accidents_number']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" />
								</td>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Дата повідомлення</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromAccidentsDate<?=$this->objectTitle?>" name="fromAccidentsDate" value="<?=$data['fromAccidentsDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toAccidentsDate<?=$this->objectTitle?>" name="toAccidentsDate" value="<?=$data['toAccidentsDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Дата випадку</b></td>
											<td>(з):</td>
                                            <td><input type="text" id="fromAccidentsDateTime<?=$this->objectTitle?>" name="fromAccidentsDateTime" value="<?=$data['fromAccidentsDateTime']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
											<td>(по):</td>
											<td><input type="text" id="toAccidentsDateTime<?=$this->objectTitle?>" name="toAccidentsDateTime" value="<?=$data['toAccidentsDateTime']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
								<td>
									<b>Ризик</b>
									<?=ParametersRisks::getListForHTML($data)?>
								</td>
							</tr>
							<tr>
								<td>
									<b>Орієнтовний збиток</b>
									<input type="text" id="amount_rough" name="amount_rough" value="<?=$data['amount_rough']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
								<td>
									<b>Сума врегульованих збитків</b>
									<input type="text" id="accident_compensation" name="accident_compensation" value="<?=$data['accident_compensation']?>" class="fldText amount" onfocus="this.className='fldTextOver amount';" onblur="this.className='fldText amount';" />
								</td>
								<td>
									<input type="submit" value="Виконати" class="button">
									<?='<a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a>'?>
								</td>
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
				<table width="100%" cellpadding="2" cellspacing="0" border="1">
					<tr class="columns" align="center">
						<td colspan="7">Договір</td>
						<td colspan="5">Об'єкт</td>
						<td colspan="12">Періоди</td>
						<td colspan="6">Страхові випадки</td>
					</tr>
					<tr class="columns" align="center">
						<td class="<?=(in_array('policies_number', $filters) ? 'filter' : '')?>">№ договору</td>
						<td class="<?=(in_array('insurer', $filters) ? 'filter' : '')?>">Страхувальник</td>
						<td class="<?=(in_array('insurer_code', $filters) ? 'filter' : '')?>">ІПН / код ЄДРПОУ</td>
						<td class="<?=(in_array('policies_date', $filters) ? 'filter' : '')?>">Дата укладання</td>
						<td class="<?=(in_array('policies_begin_date', $filters) ? 'filter' : '')?>">Дата початку</td>
						<td class="<?=(in_array('policies_end_date', $filters) ? 'filter' : '')?>">Дата закінчення</td>
						<td class="<?=(in_array('policy_statuses_title', $filters) ? 'filter' : '')?>">Статус договору</td>
						
						<td class="<?=(in_array('item_brand', $filters) ? 'filter' : '')?>">Марка</td>
						<td>Модель</td>
						<td class="<?=(in_array('car_types_title', $filters) ? 'filter' : '')?>">Тип ТЗ</td>
						<td class="<?=(in_array('item_sign', $filters) ? 'filter' : '')?>">Державний № ТЗ</td>
						<td class="<?=(in_array('item_shassi', $filters) ? 'filter' : '')?>">Шасі / VIN</td>
						
						<td class="<?=(in_array('period_begin_date', $filters) ? 'filter' : '')?>">Дата початку</td>
						<td class="<?=(in_array('period_end_date', $filters) ? 'filter' : '')?>">Дата закінчення</td>
						<td>Пролонгація</td>
						<td class="<?=(in_array('car_price', $filters) ? 'filter' : '')?>">Страхова сума</td>
						<td>Нарахована премія, грн.</td>
						<td class="<?=(in_array('item_payments_amount', $filters) ? 'filter' : '')?>">Оплачена премія, грн.</td>
						<td>Страховий тариф, %</td>
						<td>Франшиза (за ризиком НЗ), грн.</td>
						<td>Франшиза (за іншими ризиками), грн.</td>
						<!--td>Компенсація банку</td>
						<td>Знижка банку</td-->
						<td class="<?=(in_array('commission_agent_amount', $filters) ? 'filter' : '')?>">Комісія агенту</td>
						<td class="<?=(in_array('commission_director1_amount', $filters) ? 'filter' : '')?>">Комісія директора</td>
						<td class="<?=(in_array('commission_director2_amount', $filters) ? 'filter' : '')?>">Комісія заст. директора</td>
						
						<td class="<?=(in_array('accidents_number', $filters) ? 'filter' : '')?>">№ справи</td>
						<td class="<?=(in_array('accidents_date', $filters) ? 'filter' : '')?>">Дата повідомлення</td>
						<td class="<?=(in_array('accidents_datetime', $filters) ? 'filter' : '')?>">Дата випадку</td>
						<td class="<?=(in_array('parameters_risks_title', $filters) ? 'filter' : '')?>">Ризик</td>
						<td class="<?=(in_array('amount_rough', $filters) ? 'filter' : '')?>">Орієнтовний збиток, грн.</td>
						<td class="<?=(in_array('accident_compensation', $filters) ? 'filter' : '')?>">Сума врегульованих збитків, грн.</td>
					</tr>
				<?
					$i = 0;
					$counter = 0;
					$items_id = -1;
					$policies_number = '';
					$shassi = '';
					$item = '';
					
					$items = array();
					$periods_id = array();
					$periods = array();
					$accidents_id = array();
					$accidents = array();
					$accidents_count = 0;
					foreach ($list as $row) {
						$counter++;
						$i = 1 - $i;
						
						if ($shassi != $row['item_shassi']) {
							if ($shassi != '') {						
								$previous_periods_id = 0;
								foreach ($items as $item) {
									echo '<tr>';
									if ($previous_periods_id == 0) {
									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_number', $filters) ? 'filter' : '') . '">';
											echo $item['policies_number'];
										echo '&nbsp;</td>';									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('insurer', $filters) ? 'filter' : '') . '">';
											echo $item['insurer'];
										echo '&nbsp;</td>';									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('insurer_code', $filters) ? 'filter' : '') . '">';
											echo $item['insurer_code'];
										echo '&nbsp;</td>';									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_date', $filters) ? 'filter' : '') . '">';
											echo $item['policies_date'];
										echo '&nbsp;</td>';									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_begin_date', $filters) ? 'filter' : '') . '">';
											echo $item['policies_begin_date'];
										echo '&nbsp;</td>';									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_end_date', $filters) ? 'filter' : '') . '">';
											echo $item['policies_end_date'];
										echo '&nbsp;</td>';									
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policy_statuses_title', $filters) ? 'filter' : '') . '">';
											echo $item['policy_statuses_title'];
										echo '&nbsp;</td>';									
										
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('item_brand', $filters) ? 'filter' : '') . '">';
											echo $item['item_brand'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($items) . '">';
											echo $item['item_model'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('car_types_title', $filters) ? 'filter' : '') . '">';
											echo $item['car_types_title'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('item_sign', $filters) ? 'filter' : '') . '">';
											echo $item['item_sign'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('item_shassi', $filters) ? 'filter' : '') . '">';
											echo $item['item_shassi'];
										echo '&nbsp;</td>';
										
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_begin_date', $filters) ? 'filter' : '') . '">';
											echo $item['period_begin_date'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_end_date', $filters) ? 'filter' : '') . '">';
											echo $item['period_end_date'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['prolongation'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('car_price', $filters) ? 'filter' : '') . '">';
											echo $item['car_price'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['item_payments_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('item_payments_amount', $filters) ? 'filter' : '') . '">';
											echo $item['item_payments_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['car_rate'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['deductibles_amount_max'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['deductibles_amount_min'];
										echo '&nbsp;</td>';
										/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['commission_financial_institution_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo '-1000';
										echo '&nbsp;</td>';*/
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_agent_amount', $filters) ? 'filter' : '') . '">';
											echo $item['commission_agent_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director1_amount', $filters) ? 'filter' : '') . '">';
											echo $item['commission_director1_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director2_amount', $filters) ? 'filter' : '') . '">';
											echo $item['commission_director2_amount'];
										echo '&nbsp;</td>';
										
										echo '<td class="' . (in_array('accidents_number', $filters) ? 'filter' : '') . '">';
											echo $item['accidents_number'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('accidents_date', $filters) ? 'filter' : '') . '">';
											echo $item['accidents_date'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('accidents_datetime', $filters) ? 'filter' : '') . '">';
											echo $item['accidents_datetime'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('parameters_risks_title', $filters) ? 'filter' : '') . '">';
											echo $item['parameters_risks_title'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('amount_rough', $filters) ? 'filter' : '') . '">';
											echo $item['amount_rough'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('accident_compensation', $filters) ? 'filter' : '') . '">';
											echo (intval($item['accidents_id'])) ? $item['accident_compensation'] : '';
										echo '&nbsp;</td>';
										
										echo '</tr>';
										$previous_periods_id = $item['periods_id'];
										continue;
									} 
									
									if ($item['periods_id'] != $previous_periods_id) {
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_begin_date', $filters) ? 'filter' : '') . '">';
											echo $item['period_begin_date'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_end_date', $filters) ? 'filter' : '') . '">';
											echo $item['period_end_date'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['prolongation'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('car_price', $filters) ? 'filter' : '') . '">';
											echo $item['car_price'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['item_payments_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('item_payments_amount', $filters) ? 'filter' : '') . '">';
											echo $item['item_payments_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['car_rate'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['deductibles_amount_max'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['deductibles_amount_min'];
										echo '&nbsp;</td>';
										/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo $item['commission_financial_institution_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
											echo '-1000';
										echo '&nbsp;</td>';*/
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_agent_amount', $filters) ? 'filter' : '') . '">';
											echo $item['commission_agent_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director1_amount', $filters) ? 'filter' : '') . '">';
											echo $item['commission_director1_amount'];
										echo '&nbsp;</td>';
										echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '"class="' . (in_array('commission_director2_amount', $filters) ? 'filter' : '') . '"> ';
											echo $item['commission_director2_amount'];
										echo '&nbsp;</td>';
										
										echo '<td class="' . (in_array('accidents_number', $filters) ? 'filter' : '') . '">';
											echo $item['accidents_number'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('accidents_date', $filters) ? 'filter' : '') . '">';
											echo $item['accidents_date'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('accidents_datetime', $filters) ? 'filter' : '') . '">';
											echo $item['accidents_datetime'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('parameters_risks_title', $filters) ? 'filter' : '') . '">';
											echo $item['parameters_risks_title'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('amount_rough', $filters) ? 'filter' : '') . '">';
											echo $item['amount_rough'];
										echo '&nbsp;</td>';
										echo '<td class="' . (in_array('accident_compensation', $filters) ? 'filter' : '') . '">';
											echo (intval($item['accidents_id'])) ? $item['accident_compensation'] : '';
										echo '&nbsp;</td>';
										
										echo '</tr>';
										$previous_periods_id = $item['periods_id'];
										continue;
									}
									
									echo '<td class="' . (in_array('accidents_number', $filters) ? 'filter' : '') . '">';
										echo $item['accidents_number'];
									echo '&nbsp;</td>';
									echo '<td class="' . (in_array('accidents_date', $filters) ? 'filter' : '') . '">';
										echo $item['accidents_date'];
									echo '&nbsp;</td>';
									echo '<td class="' . (in_array('accidents_datetime', $filters) ? 'filter' : '') . '">';
										echo $item['accidents_datetime'];
									echo '&nbsp;</td>';
									echo '<td class="' . (in_array('parameters_risks_title', $filters) ? 'filter' : '') . '">';
										echo $item['parameters_risks_title'];
									echo '&nbsp;</td>';
									echo '<td class="' . (in_array('amount_rough', $filters) ? 'filter' : '') . '">';
										echo $item['amount_rough'];
									echo '&nbsp;</td>';
									echo '<td class="' . (in_array('accident_compensation', $filters) ? 'filter' : '') . '">';
										echo (intval($item['accidents_id'])) ? $item['accident_compensation'] : '';
									echo '&nbsp;</td>';
									
									echo '</tr>';
									$previous_periods_id = $item['periods_id'];
								}					
							}
							$shassi = $row['item_shassi'];
							$items = array();
							$periods_id = array();
							$periods = array();
							$accidents_id = array();
							$accidents = array();	
							$items[] = $row;
							$periods_id[] = $row['periods_id'];
							$periods[$row['periods_id']] = array(
								'period_begin_date' 						=> $row['period_begin_date'], 
								'period_end_date' 							=> $row['period_end_date'],
								'prolongation'								=> $row['prolongation'],
								'car_price'									=> $row['car_price'],
								'item_payments_amount'						=> $row['item_payments_amount'],
								'car_rate'									=> $row['car_rate'],
								'deductibles_amount_max'					=> $row['deductibles_amount_max'],
								'deductibles_amount_min'					=> $row['deductibles_amount_min'],
								'commission_financial_institution_amount'	=> $row['commission_financial_institution_amount'],
								'commission_agent_amount'					=> $row['commission_agent_amount'],
								'commission_director1_amount'				=> $row['commission_director1_amount'],
								'commission_director2_amount'				=> $row['commission_director2_amount']);						
							$accidents_id[$row['periods_id']][] = $row['accidents_id'];
							$accidents[$row['periods_id']][$row['accidents_id']] = array(
								'accidents_number'									=> $row['accidents_number'],
								'accidents_date'									=> $row['accidents_date'],
								'accidents_datetime'								=> $row['accidents_datetime'],
								'parameters_risks_title'							=> $row['parameters_risks_title'],
								'amount_rough'										=> $row['amount_rough'],
								'accident_compensation'								=> $row['accident_compensation']);
							$accidents_count++;
						} else {
							$items[] = $row;
							if (!in_array($row['periods_id'], $periods_id)) {
								$periods_id[] = $row['periods_id'];
								$periods[$row['periods_id']] = array(
									'period_begin_date' 						=> $row['period_begin_date'], 
									'period_end_date' 							=> $row['period_end_date'],
									'prolongation'								=> $row['prolongation'],
									'car_price'									=> $row['car_price'],
									'item_payments_amount'						=> $row['item_payments_amount'],
									'car_rate'									=> $row['car_rate'],
									'deductibles_amount_max'					=> $row['deductibles_amount_max'],
									'deductibles_amount_min'					=> $row['deductibles_amount_min'],
									'commission_financial_institution_amount'	=> $row['commission_financial_institution_amount'],
									'commission_agent_amount'					=> $row['commission_agent_amount'],
									'commission_director1_amount'				=> $row['commission_director1_amount'],
									'commission_director2_amount'				=> $row['commission_director2_amount']);
								}
							if (!in_array($row['accidents_id'], $accidents_id[$row['periods_id']])) {
								$accidents_id[$row['periods_id']][] = $row['accidents_id'];
								$accidents[$row['periods_id']][$row['accidents_id']] = array(
									'accidents_number'									=> $row['accidents_number'],
									'accidents_date'									=> $row['accidents_date'],
									'accidents_datetime'								=> $row['accidents_datetime'],
									'parameters_risks_title'							=> $row['parameters_risks_title'],
									'amount_rough'										=> $row['amount_rough'],
									'accident_compensation'								=> $row['accident_compensation']);
								$accidents_count++;
							}
						}
						
					}
					
					if ($shassi != '') {						
						$previous_periods_id = 0;
						foreach ($items as $item) {
							echo '<tr>';
							if ($previous_periods_id == 0) {
							
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_number', $filters) ? 'filter' : '') . '">';
									echo $item['policies_number'];
								echo '&nbsp;</td>';									
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('insurer', $filters) ? 'filter' : '') . '">';
									echo $item['insurer'];
								echo '&nbsp;</td>';									
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('insurer_code', $filters) ? 'filter' : '') . '">';
									echo $item['insurer_code'];
								echo '&nbsp;</td>';									
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_date', $filters) ? 'filter' : '') . '">';
									echo $item['policies_date'];
								echo '&nbsp;</td>';									
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_begin_date', $filters) ? 'filter' : '') . '">';
									echo $item['policies_begin_date'];
								echo '&nbsp;</td>';									
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policies_end_date', $filters) ? 'filter' : '') . '">';
									echo $item['policies_end_date'];
								echo '&nbsp;</td>';									
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('policy_statuses_title', $filters) ? 'filter' : '') . '">';
									echo $item['policy_statuses_title'];
								echo '&nbsp;</td>';									
								
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('item_brand', $filters) ? 'filter' : '') . '">';
									echo $item['item_brand'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($items) . '">';
									echo $item['item_model'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('car_types_title', $filters) ? 'filter' : '') . '">';
									echo $item['car_types_title'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('item_sign', $filters) ? 'filter' : '') . '">';
									echo $item['item_sign'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($items) . '" class="' . (in_array('item_shassi', $filters) ? 'filter' : '') . '">';
									echo $item['item_shassi'];
								echo '&nbsp;</td>';
								
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_begin_date', $filters) ? 'filter' : '') . '">';
									echo $item['period_begin_date'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_end_date', $filters) ? 'filter' : '') . '">';
									echo $item['period_end_date'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['prolongation'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('car_price', $filters) ? 'filter' : '') . '">';
									echo $item['car_price'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['item_payments_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('item_payments_amount', $filters) ? 'filter' : '') . '">';
									echo $item['item_payments_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['car_rate'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['deductibles_amount_max'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['deductibles_amount_min'];
								echo '&nbsp;</td>';
								/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['commission_financial_institution_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo '-1000';
								echo '&nbsp;</td>';*/
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_agent_amount', $filters) ? 'filter' : '') . '">';
									echo $item['commission_agent_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director1_amount', $filters) ? 'filter' : '') . '">';
									echo $item['commission_director1_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director2_amount', $filters) ? 'filter' : '') . '">';
									echo $item['commission_director2_amount'];
								echo '&nbsp;</td>';
								
								echo '<td class="' . (in_array('accidents_number', $filters) ? 'filter' : '') . '">';
									echo $item['accidents_number'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('accidents_date', $filters) ? 'filter' : '') . '">';
									echo $item['accidents_date'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('accidents_datetime', $filters) ? 'filter' : '') . '">';
									echo $item['accidents_datetime'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('parameters_risks_title', $filters) ? 'filter' : '') . '">';
									echo $item['parameters_risks_title'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('amount_rough', $filters) ? 'filter' : '') . '">';
									echo $item['amount_rough'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('accident_compensation', $filters) ? 'filter' : '') . '">';
									echo (intval($item['accidents_id'])) ? $item['accident_compensation'] : '';
								echo '&nbsp;</td>';
								
								echo '</tr>';
								$previous_periods_id = $item['periods_id'];
								continue;
							} 
							
							if ($item['periods_id'] != $previous_periods_id) {
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_begin_date', $filters) ? 'filter' : '') . '">';
									echo $item['period_begin_date'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('period_end_date', $filters) ? 'filter' : '') . '">';
									echo $item['period_end_date'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['prolongation'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('car_price', $filters) ? 'filter' : '') . '">';
									echo $item['car_price'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['item_payments_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('item_payments_amount', $filters) ? 'filter' : '') . '">';
									echo $item['item_payments_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['car_rate'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['deductibles_amount_max'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['deductibles_amount_min'];
								echo '&nbsp;</td>';
								/*echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo $item['commission_financial_institution_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '">';
									echo '-1000';
								echo '&nbsp;</td>';*/
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_agent_amount', $filters) ? 'filter' : '') . '">';
									echo $item['commission_agent_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director1_amount', $filters) ? 'filter' : '') . '">';
									echo $item['commission_director1_amount'];
								echo '&nbsp;</td>';
								echo '<td rowspan="' . sizeof($accidents_id[$item['periods_id']]) . '" class="' . (in_array('commission_director2_amount', $filters) ? 'filter' : '') . '">';
									echo $item['commission_director2_amount'];
								echo '&nbsp;</td>';
								
								echo '<td class="' . (in_array('accidents_number', $filters) ? 'filter' : '') . '">';
									echo $item['accidents_number'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('accidents_date', $filters) ? 'filter' : '') . '">';
									echo $item['accidents_date'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('accidents_datetime', $filters) ? 'filter' : '') . '">';
									echo $item['accidents_datetime'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('parameters_risks_title', $filters) ? 'filter' : '') . '">';
									echo $item['parameters_risks_title'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('amount_rough', $filters) ? 'filter' : '') . '">';
									echo $item['amount_rough'];
								echo '&nbsp;</td>';
								echo '<td class="' . (in_array('accident_compensation', $filters) ? 'filter' : '') . '">';
									echo (intval($item['accidents_id'])) ? $item['accident_compensation'] : '';
								echo '&nbsp;</td>';
								
								echo '</tr>';
								$previous_periods_id = $item['periods_id'];
								continue;
							}
							
							echo '<td class="' . (in_array('accidents_number', $filters) ? 'filter' : '') . '">';
								echo $item['accidents_number'];
							echo '&nbsp;</td>';
							echo '<td class="' . (in_array('accidents_date', $filters) ? 'filter' : '') . '">';
								echo $item['accidents_date'];
							echo '&nbsp;</td>';
							echo '<td class="' . (in_array('accidents_datetime', $filters) ? 'filter' : '') . '">';
								echo $item['accidents_datetime'];
							echo '&nbsp;</td>';
							echo '<td class="' . (in_array('parameters_risks_title', $filters) ? 'filter' : '') . '">';
								echo $item['parameters_risks_title'];
							echo '&nbsp;</td>';
							echo '<td class="' . (in_array('amount_rough', $filters) ? 'filter' : '') . '">';
								echo $item['amount_rough'];
							echo '&nbsp;</td>';
							echo '<td class="' . (in_array('accident_compensation', $filters) ? 'filter' : '') . '">';
								echo (intval($item['accidents_id'])) ? $item['accident_compensation'] : '';
							echo '&nbsp;</td>';
							
							echo '</tr>';
							$previous_periods_id = $item['periods_id'];
						}					
					}
				?>
				</table>
				</td>
			</tr>
			</table>
			</form>			
			</div>
			<script type="text/javascript">
				document.<?=$this->objectTitle?>.buttons = new Array();
				<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getStatisticsByInsurancePeriodsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			</script>
		</td>
	</tr>
	</table>
</div>