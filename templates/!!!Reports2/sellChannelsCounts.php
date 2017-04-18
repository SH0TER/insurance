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
			<input type="hidden" name="do" value="<?=$this->object?>|getSellChannels" />
			<input type="hidden" name="report" value="getSellChannels" />
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
							<td>Агенцiя</td>
							<td>Каско, УкрАВТО</td>
							<td>Каско, кредит</td>
							<td>Каско, лізинг</td>
							<td>Каско, готівка</td>
							<td>ЦВ</td>
							<td>ДСЦВ</td>
						</tr>
						<?
							$i = 0;
							$result['kasko_ukrauto']['quantity'] = 0;
							$result['kasko_bank_one']['quantity'] = 0;
							$result['kasko_bank_many']['quantity'] = 0;

							$result['kasko_leasing_one']['quantity'] = 0;
							$result['kasko_leasing_many']['quantity'] = 0;

							$result['kasko_cash_one']['quantity'] = 0;
							$result['kasko_cash_many']['quantity'] = 0;

							$result['go']['quantity'] = 0;
							$result['dgo']['quantity'] = 0;


							foreach ($list as $id => $row) {
								$i = 1 - $i;

								$result['kasko_ukrauto']['quantity'] += $row['kasko_ukrauto']['quantity'];

								$result['kasko_bank_one']['quantity'] += $row['kasko_bank_one']['quantity'];
								$result['kasko_bank_many']['quantity'] += $row['kasko_bank_many']['quantity'];

								$result['kasko_leasing_one']['quantity'] += $row['kasko_leasing_one']['quantity'];
								$result['kasko_leasing_many']['quantity'] += $row['kasko_leasing_many']['quantity'];

								$result['kasko_cash_one']['quantity'] += $row['kasko_cash_one']['quantity'];
								$result['kasko_cash_many']['quantity'] += $row['kasko_cash_many']['quantity'];

								$result['go']['quantity'] += $row['go']['quantity'];
								$result['go']['amount'] += $row['go']['amount'];

								$result['dgo']['quantity'] += $row['dgo']['quantity'];
								$result['dgo']['amount'] += $row['dgo']['amount'];

								echo '<tr class="' . $this->getRowClass($row, $i) . '">';
								echo '<td>' . $row['title'] . '</td>';

								echo '<td align="right">' . intval($row['kasko_ukrauto']['quantity']) . '</td>';

								echo '<td align="right">' . (intval($row['kasko_bank_one']['quantity'])+intval($row['kasko_bank_many']['quantity'])) . '</td>';

								echo '<td align="right">' . (intval($row['kasko_leasing_one']['quantity'])+intval($row['kasko_leasing_many']['quantity'])) . '</td>';

								echo '<td align="right">' . (intval($row['kasko_cash_one']['quantity'])+intval($row['kasko_cash_many']['quantity'])) . '</td>';

								echo '<td align="right">' . intval($row['go']['quantity']) . '</td>';

								echo '<td align="right">' . intval($row['dgo']['quantity']) . '</td>';
								
								echo '</tr>';
							}
						?>
						<tr class="navigation" style="font-weight: bold;">
							<td class="paging"><b>Всього:</b></td>
<?
							echo '<td align="right">' . intval($result['kasko_ukrauto']['quantity']) . '</td>';

							echo '<td align="right">' . (intval($result['kasko_bank_one']['quantity'])+intval($result['kasko_bank_many']['quantity'])) . '</td>';

							echo '<td align="right">' . (intval($result['kasko_leasing_one']['quantity'])+intval($result['kasko_leasing_many']['quantity'])) . '</td>';

							echo '<td align="right">' . (intval($result['kasko_cash_one']['quantity'])+intval($result['kasko_cash_many']['quantity'])) . '</td>';

							echo '<td align="right">' . intval($result['go']['quantity']) . '</td>';

							echo '<td align="right">' . intval($result['dgo']['quantity']) . '</td>';
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
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getSellChannelsInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>