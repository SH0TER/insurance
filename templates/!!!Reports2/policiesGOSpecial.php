<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Реалізація полiсiв ЦВ. Акція:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getPoliciesGOSpecial" />
			<input type="hidden" name="report" value="getPoliciesGOSpecial" />
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
								<table cellpadding="0" cellspacing="5">
								<tr>
									<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
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
									<? } ?>
									<td>
										<b>Марка:</b> 
										<?
											echo '<select name="brands_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
											echo '<option value="">...</option>';
											foreach ($brands as $brand) {
												echo '<option value="' . $brand['id'] . '" ' . (($brand['id'] == $data['brands_id']) ? 'selected' : '') . '>' . $brand['title'] . '</option>';
											}
											echo '</select>';
										?>
									</td>
								</tr>
								</table>
								<table cellpadding="0" cellspacing="5">
								<tr>
                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
									<td><b>Дата реалізації:</b></td>
									<td>&nbsp;з</td><td><input type="text" id="from" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" id="to" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
						<td>Агенцiя</td>
						<? }?>
						<td>Менеджер</td>
						<td>Номер</td>
						<td>Страхувальник</td>
						<td>ІПН</td>
						<td>Марка</td>
						<td>Модель</td>
						<td>Рік</td>
						<td>№ шасі (кузов, рама)</td>
						<td>Тип</td>
						<td>Премія</td>
						<td>Дата</td>
						<td>Статус</td>
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
						<td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
						<td><?=$row['insurer']?></td>
						<td><?=$row['insurer_identification_code']?></td>
						<td><?=$row['brand']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row['year']?></td>
						<td><?=$row['shassi']?></td>
						<td><?=$row['types_id']?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['amount'], -1)?></td>
						<td><?=$row['date']?></td>
						<td><?=$row['statusesTitle']?></td>
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