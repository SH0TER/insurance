<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Заявлені випадки:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getApplicationAccidentsInWindow" />
			<table width="80%" cellspacing="0" cellpadding="0">
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
                                    <table>
                                        <tr>
                                            <td><b>Звітний період (з):</b></td>
                                            <td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><b>Звітний період (по):</b></td>
                                            <td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
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
					<? if (sizeOf($list)) {?>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td>Номер справи</td>
							<td>Страхувальник</td>
							<td>Номер договору</td>
							<td>Дата договору</td>
							<td>Об'єкт</td>
							<td>Д.н.з або VIN</td>
							<td>Дата події</td>
							<td>Дата заяви</td>
							<td>Орієнтвний збиток, грн.</td>
							<td>Дата закриття</td>
						</tr>
						<?
							$i = 0;
							$amount = 0;
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['accidents_number']?></td>
							<td><?=$row['insurer']?></td>
							<td><?=$row['policies_number']?></td>
							<td><?=$row['policies_date']?></td>
							<td><?=$row['item']?></td>
							<td><?=$row['item_sign']?></td>
							<td><?=$row['accidents_datetime']?></td>
							<td><?=$row['accidents_date']?></td>
							<td align="right"><?=getRateFormat($row['amount_rough'], 2)?></td>
							<td><?=$row['accidents_acts_date']?></td>
						</tr>
						<?
								$amount = $amount + $row['amount_rough'];
							}
						?>
					<tr class="navigation">
						<td class="paging">Всьго: <?=(sizeof($list))?></td>
						<td colspan="7">&nbsp;</td>
						<td class="paging" align="right"><?=getMoneyFormat($amount)?></td>
						<td>&nbsp;</td>
					</tr>
					</table>
					<? }?>
				</td>
			</tr>
			</table>
			</form>
			</div>
			<script type="text/javascript">
				document.<?=$this->objectTitle?>.buttons = new Array();
				<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getApplicationAccidentsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			</script>
		</td>
	</tr>
	</table>
</div>