<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Звіт по аварійним комісарам, Акти:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getCreatedActsByAvarage" />
			<input type="hidden" name="InWindow" value="1" />
			
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							 
							<td align="right">
								<table>
                                    <tr>
									<td><b>Дата реалізації:</b></td>
									<td>&nbsp;з</td><td><input type="text" id="from" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td nowrap>&nbsp;до</td><td><input type="text" id="to" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
									<td>&nbsp;<a href="javascript: document.<?=$this->object?>.submit();">Експорт</a></td>
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
				<? if (isset($date_title)) {?>
					<table width="100%" cellpadding="2" cellspacing="0">
                     <tr class="columns">
                        <td>&nbsp;</td>
                     <? foreach ($date_title as $date_value){?>
                        <td><?=$date_value?></td>
                     <? }?>
                    </tr>
					<? if ($Authorization->data['rolesId'] != ROLES_AGENT) {
                        foreach($avarage_managers as $manager) {
							$i = 1 - $i;
                    ?>
                        <tr class="row<?=$i?>">
                            <td><?=$manager['fio']?></td>
                          <? foreach($date_title as $date_value){?>
                            <td align="center"><?=(intval($average_counts_acts[$manager['fio']."/".$date_value]) != 0) ? '<b>'.$average_counts_acts[$manager['fio']."/".$date_value].'</b>' : '0' ?></td>
                          <?}?>
                        </tr>
                        <?}
                       }?>
					</table>
					<div class="navigation">
						<div class="paging">Всьго: <?=(sizeof($list))?></div>
					</div>
				<?}?>
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