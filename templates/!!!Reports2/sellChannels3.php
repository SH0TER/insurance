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
			<input type="hidden" name="do" value="<?=$this->object?>|getSellChannels3" />
			<input type="hidden" name="report" value="getSellChannels3" />
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
								
								<td><b>Тiльки кiлькicть:</b> <input type="checkbox" name="onlyCounts" value="1" <? if ($data['onlyCounts']) echo 'checked';?>></td>
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
							<td rowspan="2">Агенцiя</td>
							<td colspan="2">Каско, кредит</td>
							<td colspan="2">Каско, не кредит</td>
							<td colspan="2">Каско, Пролонгацiя</td>
							<td colspan="2">ЦВ</td>
						</tr>
						<tr class="columns" align="center">
							<td>шт.</td>
							<td>грн.</td>
							<td>шт.</td>
							<td>грн.</td>
							<td>шт.</td>
							<td>грн.</td>
							<td>шт.</td>
							<td>грн.</td>
						</tr>
						<?
							$i = 0;

							$result['kasko_bank']['quantity'] = 0;
							$result['kasko_bank']['amount'] = 0;
							$result['kasko_not_bank']['quantity'] = 0;
							$result['kasko_not_bank']['amount'] = 0;
							$result['kasko_continued']['quantity'] = 0;
							$result['kasko_continued']['amount'] = 0;

							$result['go']['quantity'] = 0;
							$result['go']['amount'] = 0;

							foreach ($list as $id => $row) {
								$i = 1 - $i;

								$result['kasko_bank']['quantity'] += $row['kasko_bank']['quantity'];
								$result['kasko_bank']['amount'] += $row['kasko_bank']['amount'];

								$result['kasko_not_bank']['quantity'] += $row['kasko_not_bank']['quantity'];
								$result['kasko_not_bank']['amount'] += $row['kasko_not_bank']['amount'];
								$result['kasko_continued']['quantity'] += $row['kasko_continued']['quantity'];
								$result['kasko_continued']['amount'] += $row['kasko_continued']['amount'];

								$result['go']['quantity'] += $row['go']['quantity'];
								$result['go']['amount'] += $row['go']['amount'];

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td><a target="_blank" href="index.php?do=Reports|getSellChannels3Details&agencies_id='.$id.'&from='.$data['from'].'&to='.$data['to'].'">' . $row['title'] . '</a></td>';

								echo '<td align="right">' . intval($row['kasko_bank']['quantity']) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['kasko_bank']['amount'], -1) . '</td>';

								echo '<td align="right">' . intval($row['kasko_not_bank']['quantity']) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['kasko_not_bank']['amount'], -1) . '</td>';
								echo '<td align="right">' . intval($row['kasko_continued']['quantity']) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['kasko_continued']['amount'], -1) . '</td>';

								echo '<td align="right">' . intval($row['go']['quantity']) . '</td>';
								echo '<td align="right">' . getMoneyFormat($row['go']['amount'], -1) . '</td>';
								
								echo '</tr>';
							}
						?>
						<tr class="navigation" style="font-weight: bold;">
							<td class="paging"><b>Всього:</b></td>
<?
							echo '<td align="right">' . intval($result['kasko_bank']['quantity']) . '</td>';
							echo '<td align="right">' . getMoneyFormat($result['kasko_bank']['amount'], -1) . '</td>';

							echo '<td align="right">' . intval($result['kasko_not_bank']['quantity']) . '</td>';
							echo '<td align="right">' . getMoneyFormat($result['kasko_not_bank']['amount'], -1) . '</td>';
							echo '<td align="right">' . intval($result['kasko_continued']['quantity']) . '</td>';
							echo '<td align="right">' . getMoneyFormat($result['kasko_continued']['amount'], -1) . '</td>';

							echo '<td align="right">' . intval($result['go']['quantity']) . '</td>';
							echo '<td align="right">' . getMoneyFormat($result['go']['amount'], -1) . '</td>';
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
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getSellChannels3InWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>