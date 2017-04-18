<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Виплати агентам за полiсом:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td>
 						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
							<td>Агент</td>
							<td>Комiсiя</td>
						</tr>
						<?
							$akt_itog = 0;
							foreach ($akt_payments as $temp_row) {
								$i = 1 - $i;
								$akt_itog+=$temp_row['commission_amount'];
						?>
						<tr class="<?=$this->getRowClass($temp_row, $i)?>">
							<td><?=$temp_row['agent_name']?></td>
							<td><?=getMoneyFormat($temp_row['commission_amount'],-1)?></td>
						</tr>
						<? } ?>
						</table>
					  <div class="navigation">
                                    <div class="paging">Всього: <?=getMoneyFormat($akt_itog,-1)?></div>
                        </div>
				</td>
			</tr>
			</table>
			 
		 
		</td>
	</tr>
	</table>
</div>