<script>
function setAkt(accounts_id) {
	if (document.getElementById(accounts_id).checked) {
		akt = '1';
	} else {
		akt = '0';
	}
	
	$.ajax({
		type:		'POST',
		url:		'index.php',
		dataType:	'html',
		data:		'do=Agents|setAktInWindow' + 
					'&accounts_id=' + document.getElementById(accounts_id).value +
					'&akt=' + akt,
		success:	function(result) {}
	});
}
</script>
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Заборгованiсть агентів за полiсами КАСКО:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getInsuranceManagerActivity" />
			<input type="hidden" name="report" value="getInsuranceManagerActivity" />
			
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<?='<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
						<td width="10"></td>
						<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                        <? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
						<td align="right">
							<table cellpadding="0" cellspacing="5">
							<tr>
								
								<td>
									<b>Агенція:</b> 
									<?
										echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
										echo '<option value="">...</option>';
										foreach ($agencies as $agency) {
											echo '<option value="' . $agency['id'] . '" ' . (($agency['id'] == $data['agencies_id']) ? 'selected' : '') . '>' . str_repeat('&nbsp;', $agency['level'] * 3) . $agency['title'] . '</option>';
										}
										echo '</select>';
									?>
								</td>
								<td>&nbsp;<a href="javascript: document.<?=$this->object?>.submit();">Показати</a></td>
							</tr>
							</table>
						</td>
                        <? } ?>
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
							<td>Агенція</td>
							<td>Агент</td>
							<td>Кiлькість полiсiв</td>
							<td>Кiлькість полiсiв > 30 днiв</td>
							<td>Формувати акт</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<td><?=$row['agencies_title']?></td>
							<td><?=$row['fio']?></td>
							<td><?=$row['policesCount']?></td>
							<td><?=$row['policesCount1']?></td>
							<td>
                            <?
                                if ($Authorization->roles_id == ROLES_AGENT) {
                                    echo ($row['akt']) ? 'так' : 'ні';
                                } else {
                                    echo '<input onclick="setAkt(\'accounts_id' . $row['accounts_id'] . '\')" value="' . $row['accounts_id'] . '" type="checkbox" name="accounts_id' . $row['accounts_id'] . '" id="accounts_id' . $row['accounts_id'] . '" ' . (($row['akt']) ? 'checked' : '') . ' />';
                                }
                            ?>
                           </td>
						</tr>
						<? } ?>
						</table>
					<? }?>
				</td>
			</tr>
			</table>
			</form>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getInsuranceManagerActivityInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>