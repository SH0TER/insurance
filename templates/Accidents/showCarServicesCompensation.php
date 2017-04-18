<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Відшкодування, СТО:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="Accidents|showCarServicesCompensation" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<?=$this->getShowHiddenFields($data);?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
				<td height="28">
					<table cellpadding="0" cellspacing="0">
					<tr>
                        <? if ($this->permissions['exportCarServicesCompensation']) echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action1\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action1" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="150" height="1" alt="" /></div></div></td>
					</tr>
					</table>
				</td>
                <td align="right">
                    <table cellpadding="0" cellspacing="5">
                        <tr valign="bottom">
                            <td><b>Власник:</b></td><td><input type="text" name="owner" value="<?=$data['owner']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
                            <td nowrap=""><b>Номер кузова / VIN:</b></td><td colspan="3"><input type="text" name="shassi" value="<?=$data['shassi']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
                            <td nowrap="" colspan="2"><b>Державний номер:</b></td><td><input type="text" name="sign" value="<?=$data['sign']?>" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
                        </tr>
                        <tr>
                            <td><? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?><b>Отримувач:</b><? } ?></td>
                            <td colspan="2">
                                <? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?>
                                <select name="car_services_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';">
									<option value="0">...</option>
                                    <?
                                        if (is_array($car_services_ukravto) && sizeof($car_services_ukravto)) {
                                            echo '<optgroup label="СТО УкрАВТО">';
											foreach ($car_services_ukravto as $row) {
												echo '<option value="' . $row['id'] . '" ' . (($data['car_services_id'] == $row['id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
											}
											echo '</optgroup >';
                                        }

                                        if (is_array($car_services_not_ukravto) && sizeof($car_services_not_ukravto)) {
                                            echo '<optgroup label="Інші СТО">';
											foreach ($car_services_not_ukravto as $row) {
												echo '<option value="' . $row['id'] . '" ' . (($data['car_services_id'] == $row['id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
											}
											echo '</optgroup >';
                                        }
                                    ?>
                                </select>
                                <? } ?>
                            </td>
                            <td><b>Дата сплати</b></td>
                            <td>з:</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                            <td>по:</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                            <td align="right"><input type="submit" value="Показати" class="button"></td>
                        </tr>
                    </table>
                </td>
			</tr>
			<? } ?>
			<tr><td colspan="2" height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td colspan="2">
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td>Номер справи</td>
                            <td>Марка, модель</td>
                            <td>Державний номер</td>
                            <td>Номер кузова</td>
                            <td>Власник ТЗ</td>
                            <td>СТО отримувач</td>
                            <td>УкрАВТО</td>
                            <td>Призначення платежу</td>
                            <td>Попередньо погоджена вартість ВР, грн</td>
                            <td>Вартість ВР, включаючи приховані пошкодження, грн</td>
                            <td>Сума відшкодування, грн</td>
                            <td>Різниця, що має бути сплачена страхувальником, грн</td>
                            <td>Дата оплати</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
							<td><a target="_blank" href="?do=Accidents|view&id=<?=$row['accidents_id']?>&product_types_id=<?=$row['product_types_id']?>">&nbsp;<?=$row['accidents_number']?></a></td>
                            <td><?=$row['item']?></td>
                            <td><?=$row['sign']?></td>
                            <td><?=$row['shassi']?></td>
                            <td><?=$row['owner']?></td>
                            <td><?=$row['recipient']?></td>
                            <td><?=$row['ukravto']?></td>
                            <td><?=$row['payments_basis']?></td>
                            <td><?=$row['total_amount']?></td>
                            <td><?=$row['previous_total_amount']?></td>
                            <td><?=$row['payments_amount']?></td>
                            <td><?=$row['diff_amount']?></td>
                            <td><?=$row['paymet_dateFormat']?></td>
						</tr>
						<? } ?>
						</table>
					<? }?>
					<div class="navigation">
						<div class="paging"><?=getPaging($data['offset' . $this->objectTitle . 'Block'], $_SESSION['auth']['records_per_page'], 7, $total, $hidden, 'offset' . $this->objectTitle . 'Block');?></div>
					</div>
				</td>
			</tr>
			</table>
			</form>
			<? if (in_array(true, $this->permissions)) {?>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? if ($this->permissions['exportCarServicesCompensation']) echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action1\', document.'.$this->objectTitle.', \''.$this->object.'|exportCarServicesCompensationInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
    			document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
			<? } ?>
		</td>
	</tr>
	</table>
</div>