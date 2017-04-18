<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Багаторiчний календар:</td>
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
							<td>Дата</td>
							<td>Страхова сума</td>
							<td>Тариф</td>
							<td>Страхова премiя</td>
							<td>Продукт</td>
							<td width="250">Формула</td>
						</tr>
						<?
							 
							foreach ($years_payments as $yearRow) {
								$i = 1 - $i;
								 
						?>
						<tr class="<?=$this->getRowClass($yearRow, $i)?>"  >
							<td><?=date('d.m.Y',strtotime($yearRow['date']))?></td>
							<td><?=getMoneyFormat($yearRow['item_price'],-1)?></td>
							<td><?=getMoneyFormat($yearRow['rate_kasko'],-1)?></td>
							<td><?=getMoneyFormat($yearRow['amount_kasko'],-1)?></td>
							<td><?= $yearRow['products_title'] ?></td>
							<td width="250"  ><?= str_replace('+','+<br>',$yearRow['formula']) ?></td>
						</tr>
						<? } ?>
						</table>
					   
				</td>
			</tr>
			</table>
			 
		 
		</td>
	</tr>
	</table>
</div>