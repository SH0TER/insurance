<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Бланки полісів ЦВ:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="Reports|getPolicyBlanks" />
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
									<b>Компанія:</b> 
									<select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="">...</option>
										<option value="<?=INSURANCE_COMPANIES_KNIAZHA?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_KNIAZHA) ? 'selected' : ''?>>ПАТ "Українська страхова  компанія "Княжа Вієнна Іншуранс Груп"</option>
										<option value="<?=INSURANCE_COMPANIES_ORANTA?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_ORANTA) ? 'selected' : ''?>>НАСК "Оранта"</option>
										<option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
										<option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ "Експрес Страхування"</option>
									</select>
								</td>
								<td>
									<b>Тип:</b>
									<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="<?=PRODUCT_TYPES_KASKO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : ''?>>КАСКО</option>
										<option value="<?=PRODUCT_TYPES_GO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : ''?>>ЦВ</option>
									</select>
								</td>
							</tr>
							</table>
							<table cellpadding="0" cellspacing="5">
							<tr>
								<? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
								<td>
									<b>Агенція:</b> 
									<?
										echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
										echo '<option value="">...</option>';
										foreach ($agencies as $agency) {
											echo ($agency['id'] == $data['agencies_id'])
													? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
													: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
										}
										echo '</select>';
									?>
								</td>
								<? } ?>
								<td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
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
					<?
						$total['clear_quantity'] = 0;
						$total['use_quantity'] = 0;
						$total['spoiled_quantity'] = 0;
						$total['lost_quantity'] = 0;
						$total['used_quantity'] = 0;

						if (sizeOf($list)) {
					?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
                            <td>Агенція, код</td>
							<td>Агенція, назва</td>
							<td>Чистий, шт.</td>
							<td>Використанний, шт.</td>
							<td>Зіпсований, шт.</td>
							<td>Втраченний, шт.</td>
                            <td>Використано у минулому місяці, шт.</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
                            <td><?=$row['code']?></td>
							<td><?=$row['title']?></td>
							<td><?=intval($row['clear_quantity'])?></td>
							<td><?=intval($row['use_quantity'])?></td>
							<td><?=intval($row['spoiled_quantity'])?></td>
                            <td><?=intval($row['lost_quantity'])?></td>
							<td><?=intval($row['used_quantity'])?></td>
						</tr>
						<?
							$total['clear_quantity'] += intval($row['clear_quantity']);
							$total['use_quantity'] += intval($row['use_quantity']);
							$total['spoiled_quantity'] += intval($row['spoiled_quantity']);
							$total['lost_quantity'] += intval($row['lost_quantity']);
							$total['used_quantity'] += intval($row['used_quantity']);
						}
						?>
						<tr class="navigation">
							<td class="paging" colspan="2">&nbsp;</td>
							<td class="paging"><?=$total['clear_quantity']?></td>
							<td class="paging"><?=$total['use_quantity']?></td>
							<td class="paging"><?=$total['spoiled_quantity']?></td>
							<td class="paging"><?=$total['lost_quantity']?></td>
							<td class="paging"><?=$total['used_quantity']?></td>
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
				<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getPolicyBlanksInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			</script>
		</td>
	</tr>
	</table>
</div>