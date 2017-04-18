<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Виплати по контрагентам протягом місяця:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getPayedCompensationRecipientsByPeriod" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="bottom">
							<table cellpadding="0" cellspacing="0">
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
								<td>
                                    <b>Вид страхування:</b>
									<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="<?=PRODUCT_TYPES_KASKO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : '')?> >КАСКО</option>
                                        <option value="<?=PRODUCT_TYPES_GO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : '')?> >ОСЦПВ</option>
                                    </select>
                                </td>
                                <td>
                                    <b>Місяць:</b>
									<select name="month" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="1" <?=(($data['month'] == 1) ? 'selected' : '')?> >Січень</option>
                                        <option value="2" <?=(($data['month'] == 2) ? 'selected' : '')?> >Лютий</option>
                                        <option value="3" <?=(($data['month'] == 3) ? 'selected' : '')?> >Березень</option>
										<option value="4" <?=(($data['month'] == 4) ? 'selected' : '')?> >Квітень</option>
										<option value="5" <?=(($data['month'] == 5) ? 'selected' : '')?> >Травень</option>
										<option value="6" <?=(($data['month'] == 6) ? 'selected' : '')?> >Червень</option>
										<option value="7" <?=(($data['month'] == 7) ? 'selected' : '')?> >Липень</option>
										<option value="8" <?=(($data['month'] == 8) ? 'selected' : '')?> >Серпень</option>
										<option value="9" <?=(($data['month'] == 9) ? 'selected' : '')?> >Вересень</option>
										<option value="10" <?=(($data['month'] == 10) ? 'selected' : '')?> >Жовтень</option>
										<option value="11" <?=(($data['month'] == 11) ? 'selected' : '')?> >Листопад</option>
										<option value="12" <?=(($data['month'] == 12) ? 'selected' : '')?> >Грудень</option>										
                                    </select>
                                </td>
                                <td>
                                    <b>Рік:</b>
									<?
									echo '<select name="year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
									$year = date("Y");
										for ($i=2010; $i<=$year; $i++){
											if ($i == $data['year']) echo"<option value = $i selected>".$i."</option>";
											else
											echo "<option value = $i>".$i."</option>";}
									?>
									</select>
                                </td>
								<td><input type="submit" value="Виконати" class="button"></td>
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
					<? if (sizeOf($values)) {?>
					<table width="100%" cellpadding="5" cellspacing="0" border="1">
						<tr class="columns">
							<td>Контрагенти</td>
							<? foreach ($periods_format as $period_format) {
								echo '<td>Всього ' . $period_format['begin'] . ' по ' . $period_format['end'] . '</td>';
							} ?>
							<td>Всього за <?=mb_convert_case($MONTHES[intval($data['month']) - 1], MB_CASE_LOWER, "UTF-8")?> <?=$data['year']?>р.</td>
						</tr>
						<?
							$total_payed_amount_periods = array();
							foreach ($values as $alias => $row) {
								$total_payed_amount_recipient = 0;																
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['title']?></td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td align="right">' . getRateFormat($row[$key]['payed_amount'], 2) . '</td>';
								$total_payed_amount_recipient += $row[$key]['payed_amount'];
								if ($alias != 'ukravto_total') {							
									$total_payed_amount_periods[$key] += $row[$key]['payed_amount'];
								}
							} 
							echo '<td align="right">' . getRateFormat($total_payed_amount_recipient, 2) . '</td>';
							if ($alias != 'ukravto_total') {
								$total_payed_amount_periods[-1] += $total_payed_amount_recipient;
							}
							?>
						</tr>
						<?
							}
						?>
						<tr class="columns">
							<td>Всього</td>
							<? foreach ($periods_format as $key => $period_format) {
								echo '<td align="right">' . getRateFormat($total_payed_amount_periods[$key], 2) . '</td>';
							} ?>
							<td align="right"><?=getRateFormat($total_payed_amount_periods[-1], 2)?></td>
						</tr>						
					</table>
					<? } ?>
				</td>
			</tr>
			</table>
			</form>
			</div>
			<script type="text/javascript">
				document.<?=$this->objectTitle?>.buttons = new Array();
				<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getPayedCompensationRecipientsByPeriodInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			</script>
		</td>
	</tr>
	</table>
</div>
