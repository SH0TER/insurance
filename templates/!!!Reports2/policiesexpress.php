 
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Відділ продажу ТДВ "Експрес Страхування", поліси:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getExpressPolicies" />
			<input type="hidden" name="report" value="getExpressPolicies" />
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
								
		 
								
									<td><b>Продавець:</b></td>
									<td>
									<?
										echo '<select name="agent_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
										<option value="0">...</option>
										';
										foreach ($agents as $agent) {
											echo '<option value="' . $agent['id'] . '" ' . (($agent['id'] == $data['agent_id']) ? 'selected' : '') . '>' . $agent['title'] . '</option>';
										}
										echo '</select>';
									?>
									</td>
									<td><b>Тип полiса:</b></td>
									<td>
									<?
										echo '<select name="product_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
										foreach ($product_types as $product_type) {
											echo '<option value="' . $product_type['id'] . '" ' . (($product_type['id'] == $data['product_types_id']) ? 'selected' : '') . '>' . $product_type['title'] . '</option>';
										}
										echo '</select>';
									?>
									</td>
									<td><b>По датi створення:</b></td>
									<td>&nbsp;з</td><td><input type="text" id="fromDate<?=$this->objectTitle?>" name="fromDate" value="<?=$data['fromDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" id="toDate<?=$this->objectTitle?>" name="toDate" value="<?=$data['toDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td><b>По датi сплати:</b></td>
									<td>&nbsp;з</td><td><input type="text" id="fromPaymentDate<?=$this->objectTitle?>" name="fromPaymentDate" value="<?=$data['fromPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" id="toPaymentDate<?=$this->objectTitle?>" name="toPaymentDate" value="<?=$data['toPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>									<td>&nbsp;<a href="javascript: document.<?=$this->object?>.submit();">Показати</a></td>
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
						<td>ПIБ продавець</td>
						<td>Номер договору</td>
						<td>Рiтейл</td>
						<td>Дата договору</td>
						<td>ПIБ страхувальника</td>
						<td>Об'єкт</td>
						<td>Страх сума, грн</td>
						<td>Тариф %</td>
						<td>Страх премiя, грн</td>
						<td>Статус договору</td>
						<td>Оплата</td>
						<td>Дата сплати</td>
						<td>Автосалон</td>
						<td>Агент</td>
						<td>Банк</td>
					</tr>
					 
					<?
						if (sizeOf($list )) {
							foreach ($list as $row) {
 					?>
					<tr class="<?=Policies::getRowClass($row, $i)?>">
					<td><?=$row['seller']?></td>
					<td><?=$row['number']?></td>
					<td><?=($row['ritale']>0 ? 'Так':'Нi')?></td>
					<td><?=$row['policydate']?></td>
					<td><?=$row['insurer']?></td>
					<td><?=$row['item']?></td>
					<td><?=$row['price']?></td>
					<td><?=$row['rate']?></td>
					<td><?=$row['amount']?></td>
					<td><?=$row['policystate']?></td>
					<td><?=$row['paymenttitle']?></td>
					<td><?=$row['paymentdate']?></td>
					<td><?=$row['agency']?></td>
					<td><?=$row['agent']?></td>
					<td><?=$row['bank']?></td>
					
					</tr>
					<?
							}
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
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>