<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Реалізація полiсiв по мiсяцях:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getSellAgencies" />
			<input type="hidden" name="report" value="getSellAgencies" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<td width="10"></td>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
						<td align="right">
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
								<td><b>Перiод:</b></td>
                                <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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
					<? if (sizeOf($list)) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns" align="center">
						<td rowspan="3">Агенцiя, код</td>
							<td rowspan="3">Агенцiя, назва</td>
							<?
								$monthes = 0;
								$date = $startDate;
								while($date < $endDate) {
									$monthes++;
									echo '<td colspan="4">' . date('m.Y', $date) . '</td>';
									$date = getdate($date);
									$date = mktime(0, 0, 0, $date['mon'] + 1, $date['mday'], $date['year']);
								}
							?>
						</tr>
						<tr class="columns">
							<?
								for($i=0; $i < $monthes; $i++) {
									echo '<td colspan="2">КАСКО</td><td colspan="2">ЦВ</td>';
								}
							?>
						</tr>
						<tr class="columns">
							<?
								for($i=0; $i < $monthes; $i++) {
									echo '<td>шт.</td><td>грн.</td><td>шт.</td><td>грн.</td>';
								}
							?>
						</tr>
						<?
							$i = 0;
							foreach ($list as $id => $row) {
								$i = 1 - $i;

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
                                echo '<td>' . $row['code'] . '</td>';
								echo '<td>' . $row['title'] . '</td>';

								$date = $startDate;
								while($date < $endDate) {
									echo '<td align="right">' . intval($row[ date('m.Y', $date) ]['kasko']['quantity']) . ' &nbsp;</td>';
									echo '<td align="right">' . getMoneyFormat($row[ date('m.Y', $date) ]['kasko']['amount'], -1) . ' &nbsp;</td>';
									echo '<td align="right">' . intval($row[ date('m.Y', $date) ]['go']['quantity']) . ' &nbsp;</td>';
									echo '<td align="right">' . getMoneyFormat($row[ date('m.Y', $date) ]['go']['amount'], -1) . ' &nbsp;</td>';

									$total[ date('m.Y', $date) ]['kasko']['quantity']	+= intval($row[ date('m.Y', $date) ]['kasko']['quantity']);
									$total[ date('m.Y', $date) ]['kasko']['amount']	+= intval($row[ date('m.Y', $date) ]['kasko']['amount']);
									$total[ date('m.Y', $date) ]['go']['quantity']	+= intval($row[ date('m.Y', $date) ]['go']['quantity']);
									$total[ date('m.Y', $date) ]['go']['amount']	+= intval($row[ date('m.Y', $date) ]['go']['amount']);

									$date = getdate($date);
									$date = mktime(0, 0, 0, $date['mon'] + 1, $date['mday'], $date['year']);
								}
								echo '</tr>';
							}
						?>
						<tr class="navigation">
							<td class="paging" colspan="2"><b>Всього:</b></td>
							<?
								$date = $startDate;
								while($date < $endDate) {
									echo '<td align="right"><b>' . intval($total[ date('m.Y', $date) ]['kasko']['quantity']) . ' &nbsp;</b></td>';
									echo '<td align="right"><b>' . getMoneyFormat($total[ date('m.Y', $date) ]['kasko']['amount'], -1) . ' &nbsp;</b></td>';
									echo '<td align="right"><b>' . intval($total[ date('m.Y', $date) ]['go']['quantity']) . ' &nbsp;</b></td>';
									echo '<td align="right"><b>' . getMoneyFormat($total[ date('m.Y', $date) ]['go']['amount'], -1) . ' &nbsp;</b></td>';

									$date = getdate($date);
									$date = mktime(0, 0, 0, $date['mon'] + 1, $date['mday'], $date['year']);
								}
							?>
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
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getSellAgenciesInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>