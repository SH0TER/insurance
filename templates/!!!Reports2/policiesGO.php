<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Агентська винагорода, поліси ЦВ:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getPoliciesGO" />
			<input type="hidden" name="report" value="getPoliciesGO" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td valign="bottom">
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
									<td width="10"></td>
									<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
								</tr>
								</table>
							</td>
							<td align="right">
								<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
								<table cellpadding="0" cellspacing="5">
								<tr>
									<td>
										<b>Агенція:</b> 
										<?
											echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">';
											echo '<option value="">...</option>';
											foreach ($agencies as $agency) {
															echo ($agency['id'] == $data['agencies_id'])
																? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
																: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
											}
											echo '</select>';
										?>
									</td>
									<td>
										<b>СК:</b> 
										<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
											<option value="">...</option>
											<option value="<?=INSURANCE_COMPANIES_KNIAZHA?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_KNIAZHA) ? 'selected' : ''?>>ПАТ "Українська страхова  компанія "Княжа Вієнна Іншуранс Груп"</option>
											<option value="<?=INSURANCE_COMPANIES_ORANTA?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_ORANTA) ? 'selected' : ''?>>НАСК "Оранта"</option>
											<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
										</select>
									</td>
									<td>
										<b>Акція:</b> 
										<select name="special" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
											<option value="">...</option>
											<option value="0" <?=($data['special'] === '0') ? 'selected' : ''?>>ні</option>
											<option value="1" <?=($data['special'] === '1') ? 'selected' : ''?>>так</option>
										</select>
									</td>
									<td><b>Вітзвітовано перед СК:</b></td>
									<td>&nbsp;з</td><td><input type="text" name="fromPaymentDateAgency" value="<?=$data['fromPaymentDateAgency']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" name="toPaymentDateAgency" value="<?=$data['toPaymentDateAgency']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
								</tr>
								</table>
								<? } ?>
								<table cellpadding="0" cellspacing="5">
								<tr>
                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
									<td><b>СТО:</b> <input type="checkbox" name="service" value="1" <?=($data['service']) ? 'checked' : ''?> /></td>
									<td><b>Не виплаченно агентам:</b> <input type="checkbox" name="notPayed" value="1" <?=($data['notPayed']) ? 'checked' : ''?> /></td>
									<td><b>Термін:</b></td>
									<td>&nbsp;з</td><td><input type="text" name="fromWaitingPaymentDate" value="<?=$data['fromWaitingPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" name="toWaitingPaymentDate" value="<?=$data['toWaitingPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td><b>Отримано:</b></td>
									<td>&nbsp;з</td><td><input type="text" name="fromPaymentDate" value="<?=$data['fromPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" name="toPaymentDate" value="<?=$data['toPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td>&nbsp;<a href="javascript: document.<?=$this->object?>.submit();">Показати</a></td>
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
					<? if (is_array($list)) {?>
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr class="columns">
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
						<td rowspan="2">Агенцiя</td>
						<? }?>
						<td rowspan="2">Менеджер</td>
						<td rowspan="2">Страхувальник</td>
						<td rowspan="2">Об'єкт</td>
						<td colspan="5">Договір</td>
						<td colspan="3">Платіж</td>
						<td colspan="4">Комiciя агента</td>
						<td colspan="5">Комiciя СТО</td>
						<? if ($showcomissions) {?>
						<td colspan="4">Комiciя підприємства</td>
						<?}?>
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
						<td colspan="<?=($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 5 : 4?>"><? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>Вигодонабувач<? } else { ?>ТДВ "Експрес страхування"<? } ?></td>
						<?}?>
					</tr>
					<tr class="columns">
						<td>№</td>
						<td>дата</td>
						<td>премія, грн.</td>
						<td>статус</td>
						<td>акція</td>
						<td>термін</td>
						<td>отримано</td>
						<td>грн.</td>
						<td>%</td>
						<td>грн.</td>
						<td>акт</td>
						<td>сплачено</td>
						<td>представник</td>
						<td>%</td>
						<td>грн.</td>
						<td>акт</td>
						<td>сплачено</td>
						<? if ($showcomissions) { ?>
						<td>%</td>
						<td>грн.</td>
						<td>акт</td>
						<td>сплачено</td>
						<? } ?>
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) { ?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td>назва</td><? } ?>
						<td>%</td>
						<td>грн.</td>
						<td>акт</td>
						<td>сплачено</td>
						<? } ?>
					</tr>
					<?
						if (sizeOf($list )) {
							foreach ($list as $row) {

								$i = 1 - $i;

								$showact = true;
								if ($Authorization->data['roles_id'] == ROLES_AGENT &&
									$row['agents_id'] !=$Authorization->data['id']) {
										$showact = false;
								}
					?>
					<tr class="<?=Policies::getRowClass($row, $i)?>">
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?><td><?=$row['agencies_title']?></td><?}?>
						<td><?=$row['agent']?></td>
						<td><?=$row['insurer']?></td>
						<td><?=$row['item']?></td>
						<td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
						<td><?=$row['date']?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
						<td><?=$row['policy_statusesTitle']?></td>
						<td><?=($row['special']) ? 'так' : 'ні'?></td>
						<td><?=$row['waitingPaymentDate']?></td>
						<td><?=$row['payment_date']?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['paymentsAmount'], -1)?></td>
						<td align="right"><?=getMoneyFormat($row['commission_agent_percent'], -1)?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['commission_agent_amount'], -1)?></td>
						<td><? if ($row['agents_akt_number'] && $showact) {?><a href="?do=Agents|downloadFileInWindow&id=<?=$row['agents_id']?>&aktnumber=<?=$row['agents_akt_number']?>"><?}?><?=$row['agents_akt_number']?><? if ($row['agents_akt_number'] && $showact) {?></a><?}?></td>
						<td align="center"><?=$row['payment_date_agent']?></td>
						<td><?=$row['service_person']?></td>
						<td align="right"><?=getMoneyFormat($row['commission_service_percent'], -1)?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['commission_service_amount'], -1)?></td>
						<td><? if ($row['service_akt_number'] && $showact) {?><a href="?do=Agents|downloadFileInWindow&id=<?=$row['service_id']?>&aktnumber=<?=$row['service_akt_number']?>&car_service=1"><?}?><?=$row['service_akt_number']?><? if ($row['service_akt_number'] && $showact) {?></a><?}?></td>
						<td align="center"><?=$row['payment_date_service']?></td>
						<? if ($showcomissions) {?>
						<td align="right" nowrap><?=getMoneyFormat($row['commission_agency_percent'], -1)?></td>
						<td align="right"><?=getMoneyFormat($row['commission_agency_amount'], -1)?></td>
						<td><? if ($row['agencies_akt_number']) {?><a href="?do=Agencies|downloadFileInWindow&id=<?=$row['agencies_id']?>&aktnumber=<?=$row['agencies_akt_number']?>&product_types_id=<?=$row['product_types_id']?>"><?}?><?=$row['agencies_akt_number']?><? if ($row['agencies_akt_number']) {?></a><?}?></td>
						<td align="center"><?=$row['payment_date_agency']?></td>
						<? } ?>
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?><td align="right"><?=$row['financial_institutions_title']?></td><? } ?>
						<td align="right"><?=getMoneyFormat($row['commission_financial_institution_percent'], -1)?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['commission_financial_institution_amount'], -1)?></td>
						<td><?=$row['financial_institutions_akt_number']?></td>
						<td align="center"><?=$row['payment_date_financial_institution']?></td>
						<? } ?>
					</tr>
					<?
							}
						}
					?>
					</table>
					<div class="navigation">
						<div class="paging">Всьго: <?=(sizeof($list))?></div>
					</div>
					<? }?>
				</td>
			</tr>
			</table>
			</form>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>