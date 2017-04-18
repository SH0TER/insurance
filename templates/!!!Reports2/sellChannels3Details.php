<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Реалізація полiсiв по каналам:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getSellChannels3Details" />
			<input type="hidden" name="report" value="getSellChannels3Details" />
			<input type="hidden" name="from" value="<?=$data['from']?>" />
			<input type="hidden" name="to" value="<?=$data['to']?>" />
			<input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
			
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<td width="10"></td>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
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
							<td>Агенцiя</td>
							<td>Номер полiсу</td>
							<td>Страхувальник</td>
							<td>Авто</td>
							<td>Цiна</td>
							<td>Премiя</td>
							<td>Платiж</td>
							<td>Комiсiя агент %</td>
							<td>Комiсiя агент грн</td>
							<td>Комiсiя директор %</td>
							<td>Комiсiя директор грн</td>
							<td>Комiсiя заступник %</td>
							<td>Комiсiя заступник грн</td>
							<td>Тип</td>
						</tr>
						
						<?
							$i = 0;


							foreach ($list as $id => $row) {
								$i = 1 - $i;

	
								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td>' . $row['title'] . '</td>';
								echo '<td>' . $row['number'] . '</td>';
								echo '<td>' . $row['insurer'] . '</td>';
								echo '<td>' . $row['item'] . '</td>';
								
								echo '<td align="right">' . getMoneyFormat($row['price'], -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['amount'], -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['payment_amount'], -1) . '</td>';
								
								echo '<td align="right">' . getMoneyFormat(round($row['commission_agent_amount']*100/$row['payment_amount'],2), -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['commission_agent_amount'], -1) . '</td>';
								
								echo '<td align="right">' . getMoneyFormat(round($row['commission_director1_amount']*100/$row['payment_amount'],2), -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['commission_director1_amount'], -1) . '</td>';
								
								echo '<td align="right">' . getMoneyFormat(round($row['commission_director2_amount']*100/$row['payment_amount'],2), -1) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['commission_director2_amount'], -1) . '</td>';

								
								echo '<td align="right">' . $row['type'] . '</td>';
								
								echo '</tr>';
							}
						?>
						
						</table>
					<? }?>
				</td>
			</tr>
			</table>
			</form>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getSellChannels3DetailsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>