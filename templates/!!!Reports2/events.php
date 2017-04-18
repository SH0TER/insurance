<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Перелік страхових випадків:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getEvents" />
			<input type="hidden" name="report" value="getEvents" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<td width="10"></td>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
						<td align="right">
							<table cellpadding="0" cellspacing="5">
							<tr>
                                <td rowspan="2" valign="bottom"><b>Статус:</b></td>
								<td rowspan="2">
									<select name="event_statuses_id[]" multiple="multiple" size="3" class="fldSelect " onfocus="this.className='fldSelectOver '" onblur="this.className='fldSelect '">
									<?
										foreach ($event_statuses as $event_status) {
											echo '<option value="' . $event_status['id'] . '" ' . ((is_array($data['event_statuses_id']) && in_array($event_status['id'], $data['event_statuses_id'])) ? 'selected' : '') . '">' . $event_status['title'] . '</option>';
										}
									?>
									</select>
								</td>
								<td rowspan="2" valign="bottom"><b>Оплата:</b></td>
								<td rowspan="2">
									<select name="payment_statuses_id[]" multiple="multiple" size="3" class="fldSelect " onfocus="this.className='fldSelectOver '" onblur="this.className='fldSelect '">
									<?
										foreach ($payment_statuses as $payment_status) {
											echo '<option value="' . $payment_status['id'] . '" ' . ((is_array($data['payment_statuses_id']) && in_array($payment_status['id'], $data['payment_statuses_id'])) ? 'selected' : '') . '">' . $payment_status['title'] . '</option>';
										}
									?>
									</select>
								</td>
								<td>
									<input type="checkbox" name="insurance" value="1" <?=(intval($data['insurance'])) ? 'checked' : ''?> /> відмова
									<input type="checkbox" name="regres" value="1" <?=(intval($data['regres'])) ? 'checked' : ''?> /> регрес
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table cellpadding="0" cellspacing="5">
									<tr>
										<td valign="bottom"><b>Перiод:</b></td>
										<td valign="bottom">&nbsp;з</td>
										<td valign="bottom"><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
										<td valign="bottom" nowrap>&nbsp;до</td>
										<td valign="bottom"><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
										<td valign="bottom">&nbsp;<a href="javascript: document.<?=$this->object?>.submit();">Показати</a></td>
									</tr>
									</table>
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
					<? if (sizeOf($list)) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns" align="center">
							<td rowspan="2">Номер</td>
							<td rowspan="2">Страхувальник</td>
							<td colspan="2">Договір</td>
							<td rowspan="2">Об'єкт</td>
							<td rowspan="2">VIN</td>
							<td colspan="2">Дата</td>
							<td colspan="2">Збиток</td>
							<td rowspan="2">Статус</td>
							<td rowspan="2">Оплата</td>
						</tr>
						<tr class="columns" align="center">
							<td>Номер</td>
							<td>Дата</td>
							<td>Події</td>
							<td>Заяви</td>
							<td>Орієнтовний</td>
							<td>Фактичний</td>
						</tr>
						<?
							$i = 0;
							foreach ($list as $id => $row) {
								$i = 1 - $i;

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td>' . $row['number'] . '</td>';
								echo '<td>' . $row['insurer'] . '</td>';
								echo '<td>' . $row['policiesNumber'] . '</td>';
								echo '<td>' . $row['policiesDate'] . '</td>';
								echo '<td>' . $row['object'] . '</td>';
								echo '<td>' . $row['shassi'] . '</td>';
								echo '<td>' . $row['datetimeFormat'] . '</td>';
								echo '<td>' . $row['date_format'] . '</td>';
								echo '<td>' . $row['amountRough'] . '</td>';
								echo '<td>' . $row['amount'] . '</td>';
								echo '<td>' . $row['event_statusesTitle'] . '</td>';
								echo '<td>' . $row['payment_statusesTitle'] . '</td>';
								echo '</tr>';
							}
						?>
						<tr class="navigation">
							<td class="paging" colspan="12"><b>Всього:</b> <?=sizeOf($list)?></td>
						</tr>
						</table>
					<? }?>
				</td>
			</tr>
			</table>
			</form>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getEventsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>