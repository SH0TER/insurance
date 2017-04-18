<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Cтрахові випадки по місяцях:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getMonthEvents" />
			<input type="hidden" name="report" value="getMonthEvents" />
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
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td>
					<? if (sizeOf($list)) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns" align="center">
							<td>Месяц</td>
							<td>Заявленные</td>
							<td>Оплаченные</td>
							<td>Отказ</td>
							<td>Регрес</td>
							<td>Виплати, грн.</td>
						</tr>
						<?
							$i = 0;
							$declared	= 0;
							$payed		= 0;
							$rejected	= 0;
							$regres		= 0;
							$amount		= 0;
							foreach ($list as $id => $row) {
								$i = 1 - $i;

								$declared	+= $row['declared'];
								$payed		+= $row['payed'];
								$rejected	+= $row['rejected'];
								$regres		+= $row['regres'];
								$amount		+= $row['amount'];

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td>' . $row['date'] . '</td>';
								echo '<td>' . $row['declared'] . '</td>';
								echo '<td>' . $row['payed'] . '</td>';
								echo '<td>' . $row['rejected'] . '</td>';
								echo '<td>' . $row['regres'] . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['amount'], -1) . '</td>';
								echo '</tr>';
							}
						?>
						<tr class="navigation">
							<td class="paging"><b>Всього:</b></td>
							<td><b><?=$declared?></b></td>
							<td><b><?=$payed?></b></td>
							<td><b><?=$rejected?></b></td>
							<td><b><?=$regres?></b></td>
							<td align="right"><b><?=getMoneyFormat($amount, -1)?></b></td>
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
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getMonthEventsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>