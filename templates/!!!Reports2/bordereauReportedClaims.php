<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Бордеро заявлених збитків:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getBordereauReportedClaims" />
			<input type="hidden" name="report" value="getBordereauReportedClaims" />
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
                                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
									<td><b>Дата події:</b></td>
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
						<td colspan="2">Договір страхування</td>
						<td rowspan="2">Страхувальник</td>
						<td rowspan="2">Транспортний засіб</td>
						<td rowspan="2">Номер кузова/шасі</td>
						<td rowspan="2">Державний реєстраційний номер</td>
						<td colspan="2">Період страхування</td>
						<td rowspan="2">Страхова сума, грн.</td>
						<td rowspan="2">Дата випадку</td>
						<td rowspan="2">Ризик</td>
						<td rowspan="2">Сплачено відшкодування, грн.</td>
						<td rowspan="2">Орієнтовний збиток, грн.</td>
						<td rowspan="2">Регрес</td>
					</tr>
					<tr class="columns">
						<td>№</td>
						<td>Дата</td>
						<td>з</td>
						<td>до</td>
					</tr>
					<?
						if (sizeOf($list )) {
							foreach ($list as $row) {
								$i = 1 - $i;
					?>
					<tr class="<?=Policies::getRowClass($row, $i)?>">
						<td><a href="/?do=Policies|view&id=<?=$row['id']?>&product_types_id=<?=$row['product_types_id']?>" title="Переглянути"><?=$row['number']?></a></td>
						<td><?=$row['policiesDate']?></td>
						<td><?=$row['insurer']?></td>
						<td><?=$row['brand']?> <?=$row['model']?></td>
						<td><?=$row['shassi']?></td>
						<td><?=$row['sign']?></td>
						<td><?=$row['begin_datetimeFormat']?></td>
						<td><?=$row['interrupt_datetimeFormat']?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['car_price'], -1)?></td>
						<td><?=$row['eventsDateTime']?></td>
						<td><?=$row['risksTitle']?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['estimatesAmount'], -1)?></td>
						<td align="right" nowrap><?=getMoneyFormat($row['amountRough'], -1)?></td>
						<td><?=($row['regres']) ? 'так' : 'ні'?></td>
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