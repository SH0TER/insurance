<?$Log->showSystem() ?>
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Звіт по СТО:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|getCarServicesInWindow" />
			<input type="hidden" name="report" value="sto_report" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td valign="bottom">
							</td>
							<td align="right">
								<table>
                                    <tr>
                                        <td><b>Є СТО УКРАВТО</b></td>
                                        <td><input type="checkbox" name="is_ukravto" value="1" <?if($data['is_ukravto'] == 1){?> checked="" <?}?>></td>
                                        <td><b>Місяць: </b></td>
                                        <td>
                                            <select name="month[]" size="6" multiple="" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                <option value="1" <?=(in_array(1, $data['month']) ? 'selected' : '')?>>Січень</option>
                                                <option value="2" <?=(in_array(2, $data['month']) ? 'selected' : '')?>>Лютий</option>
                                                <option value="3" <?=(in_array(3, $data['month']) ? 'selected' : '')?>>Березень</option>
                                                <option value="4" <?=(in_array(4, $data['month']) ? 'selected' : '')?>>Квітень</option>
                                                <option value="5" <?=(in_array(5, $data['month']) ? 'selected' : '')?>>Травень</option>
                                                <option value="6" <?=(in_array(6, $data['month']) ? 'selected' : '')?>>Червень</option>
                                                <option value="7" <?=(in_array(7, $data['month']) ? 'selected' : '')?>>Липень</option>
                                                <option value="8" <?=(in_array(8, $data['month']) ? 'selected' : '')?>>Серпень</option>
                                                <option value="9" <?=(in_array(9, $data['month']) ? 'selected' : '')?>>Вересень</option>
                                                <option value="10" <?=(in_array(10, $data['month']) ? 'selected' : '')?>>Жовтень</option>
                                                <option value="11" <?=(in_array(11, $data['month']) ? 'selected' : '')?>>Листопад</option>
                                                <option value="12" <?=(in_array(12, $data['month']) ? 'selected' : '')?>>Грудень</option>
                                            </select>
                                        </td>
                                        <td><b>Рік: </b></td>
                                        <td>
                                            <?
                                            echo '<select name="year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                            $year = date("Y");
                                                for ($i=2010; $i<=$year; $i++){
                                                    if ($i == $data['year']) echo"<option value = $i selected>".$i."</option>";
                                                    else
                                                    echo "<option value = $i>".$i."</option>";}
                                            ?>
                                            </select>
                                        </td>
                                       <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Експорт</a></td>
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
				    <table width="100%" cellpadding="0" cellspacing="0">
					<tr align="center">
						<td>&nbsp;</td>
						<td><input type="checkbox" name="fields[]" value="edrpou" checked="true"/></td>
						<td><input type="checkbox" name="fields[]" value="regions_title" checked="true"/></td>
						<td><input type="checkbox" name="fields[]" value="count_accidents" checked="true"/></td>
						<?if(intval($data['is_ukravto']) == 1){?><td><input type="checkbox" name="fields[]" value="amount_rough" checked="true"/></td><?}?>
						<td><input type="checkbox" name="fields[]" value="count_payment" checked="true"/></td>
						<td><input type="checkbox" name="fields[]" value="count_not_payment" checked="true"/></td>
						<td><input type="checkbox" name="fields[]" value="deductibles_amount" checked="true"/></td>
						<td><input type="checkbox" name="fields[]" value="payments_amount" checked="true"/></td>
					</tr>
					<tr class="columns">
						<td>Назва СТО</td>
                        <td>ЄДРПОУ</td>
						<td>Регіон</td>
						<td>Кількість заяв</td>
                        <?if(intval($data['is_ukravto']) == 1){?><td>Орієнтовний збиток</td><?}?>
						<td>Кількість справ з виплатою</td>
						<td>Кількість справ без виплати</td>
						<td>Сума франшиз по справ з виплатою</td>
						<td>Сума до сплати по справам з виплатою</td>
					</tr>
					 
				    </table>
				</td>
			</tr>
			</table>
			</form>
			<script type="text/javascript">
			<!--
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getCarServicesInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			// -->
			</script>
		</td>
	</tr>
	</table>
</div>