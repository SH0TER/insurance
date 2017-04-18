<? if ($_SESSION['auth']['agent_financial_institutions_id']==25) {
$showcomissions = false;
}
?>
<script>

function  deleteFromAkt(policies_id,aktnumber,aktType)
{
	if (confirm('Ви дійсно бажаєте вилучити анкету з акту ?')) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=InsurancePeriods|deleteFromAktInWindow' +
						'&policies_id=' + policies_id+
						'&aktnumber=' + aktnumber+
						'&aktType=' + aktType,
			success: 	function(result) {
							switch (result.type) {
								case 'confirm':
									$("#akt" + policies_id+aktType).html('');
									//$('#bank_akt_payment_date' + id).html('<a href="javascript: addToBankAkt(' + id + ')" title="Додати до акту"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати до акту" /></a>');
									break;
								case 'error':
									alert(result.text);
									break;
							}
						}
		});
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
		<td class="caption">Агентська винагорода, поліси:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getPolicies" />
			<input type="hidden" name="report" value="getPolicies" />
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
										<b>СК:</b> 
										<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
											<option value="">...</option>
											<option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ Експрес страхування</option>
											<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
										</select>
									</td>
									<td><b>СТО:</b> <input type="checkbox" name="service" value="1" <?=($data['service']) ? 'checked' : ''?> /></td>
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
									<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
									<td>
										<b>Банк:</b> 
										<?
											echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
											echo '<option value="">...</option>';
											foreach ($financial_institutions as $financial_institution) {
												echo '<option value="' . $financial_institution['id'] . '" ' . (($financial_institution['id'] == $data['financial_institutions_id']) ? 'selected' : '') . '>' . $financial_institution['title'] . '</option>';
											}
											echo '</select>';
										?>
									</td>
									<? } ?>
									<td>
									<b>Статус:</b> <select id="policy_statuses_id" name="policy_statuses_id[]" multiple size="3"  class="fldSelect " onfocus="this.className='fldSelectOver '" onblur="this.className='fldSelect '">
									<?  foreach ($policiy_statuses as $status) {
										  echo '<option value="'.$status['id'].'" '.(in_array($status['id'],$data['policy_statuses_id']) ? 'selected' : '').' >'.$status['title'].'</option>';
										}
									?>
									</select>
									</td>
									
								</tr>
								</table>
								<table cellpadding="0" cellspacing="5">
								<tr>
									<td><b>Тип полiса:</b></td>
									<td>
									<?
										echo '<select name="product_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
										foreach ($product_types as $product_type) {
											echo '<option value="' . $product_type['id'] . '" ' . (($product_type['id'] == $data['product_types_id']) ? 'selected' : '') . '>' . $product_type['title'] . '</option>';
										}
										echo '</select>';
									?>
									</td>
                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
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
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT  || $_SESSION['auth']['agent_financial_institutions_id']==25) {?>
						<td rowspan="2">Агенцiя</td>
						<? }?>
						<td rowspan="2">Менеджер</td>
						<td rowspan="2">Страхувальник</td>
						<td rowspan="2">Об'єкт</td>
						<td colspan="<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {echo '5';} else echo '4'; ?>">Договір</td>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td  rowspan="2">Дата банк</td><? } ?>
						<td colspan="3">Платіж</td>
						<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
						<td colspan="2">Комiciя агента</td>
						<?}?>
					
						<? if ($showcomissions) {?>
						<td colspan="2">Комiciя підприємства</td>
						<?}?>
						<? if (($Authorization->data['roles_id'] != ROLES_AGENT || $Authorization->data['agencies_id']==SELLER_AGENCIES_ID) && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
						<td rowspan=2><? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?>Вигодонабувач<? } else { ?>ТДВ "Експрес страхування"<? } ?></td>
						<?}?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td rowspan=2>пролонгация</td><? } ?>
						
					</tr>
					<tr class="columns">
						<td>№</td>
						<td>дата</td>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td>Тариф</td><? } ?>
						<td>премія, грн.</td>
						<td>статус</td>
						<td>термін</td>
						<td>отримано</td>
						<td>грн.</td>
						<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
						<td>%</td>
						<td>грн.</td>
						<?}?>
					 
						<? if ($showcomissions) { ?>
						<td>%</td>
						<td>грн.</td>
						
						 
						
						<? } ?>
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT && ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) { ?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td>назва</td><? } ?>
						

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
						<? if ($Authorization->data['roles_id'] != ROLES_AGENT || $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td><?=$row['agencies_title']?></td><?}?>
						<td><?=$row['agent']?></td>
						<td><?=$row['insurer']?></td>
						<td><?=$row['item']?></td>
						<td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
						<td><?=$row['date']?></td>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO &&  $_SESSION['auth']['agent_financial_institutions_id']==25) {?><td  align="right"><?=getMoneyFormat($row['rate'], -1)?></td><? } ?>
						<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
						<td><?=$row['policy_statusesTitle']?></td>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td><?=$row['bank_akt_payment_date']?></td><? } ?>
						<td><?=$row['waitingPaymentDate']?></td>
						<td><?=$row['payment_date']?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['paymentsAmount'], -1)?></td>
						<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
						<td align="right"><?=getMoneyFormat($row['commission_agent_percent'], -1)?></td>
						<td align="right" nowrap><?=($row['documents'] ? getMoneyFormat($row['commission_agent_amount'], -1) : 0)?></td>
						<?}?>
						 
						<? if ($showcomissions) {?>
						<td align="right" nowrap><?=getMoneyFormat($row['commission_agency_percent'], -1)?></td>
						<td align="right"><?=($row['documents'] ? getMoneyFormat($row['commission_agency_amount'], -1) : 0)?></td>
						<? } ?>
						<? if (($Authorization->data['roles_id'] != ROLES_AGENT || $Authorization->data['agencies_id']==SELLER_AGENCIES_ID)&& ($data['product_types_id'] == PRODUCT_TYPES_KASKO || $data['product_types_id'] == PRODUCT_TYPES_GO)) {?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) { ?><td align="right"><?=$row['financial_institutions_title']?></td><? } ?>

						<? } ?>
						<? if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {?><td><?=($row['prolong']>0 ? 'Так' : 'Нi')?></td><? } ?>
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