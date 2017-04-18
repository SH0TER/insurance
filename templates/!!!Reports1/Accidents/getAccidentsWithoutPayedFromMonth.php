<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Без виплати / відмовлені протягом місяця:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="<?=$this->object?>|getAccidentsWithoutPayedFromMonth" />
			<input type="hidden" name="InWindow" value="true" />
			<table width="80%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="bottom">
							<table cellpadding="0" cellspacing="0">
							<tr>
								<td width="10"></td>
								<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
							</tr>
							</table>
						</td>
						<td align="right">
							<table cellpadding="0" cellspacing="5">
							<tr>
								<td>
									<b>Вид страхування:</b>
									<select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                        <option value="<?=PRODUCT_TYPES_KASKO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : '')?> >КАСКО</option>
                                        <option value="<?=PRODUCT_TYPES_GO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : '')?> >ОСЦПВ</option>
                                    </select>
								</td>
								<td>
									<b>Страховий випадок:</b>
									<select name="insurance" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                        <option value="2" <?=(($data['insurance'] == 2) ? 'selected' : '')?> >Без виплати</option>
                                        <option value="3" <?=(($data['insurance'] == 3) ? 'selected' : '')?> >Відмова</option>
                                    </select>
								</td>
								<td>
                                    <table>
                                        <tr>
                                            <td><b>Звітний період (з):</b></td>
                                            <td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><b>Звітний період (по):</b></td>
                                            <td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                        </tr>
                                    </table>
                                </td>
                                <!--td>
                                    <b>Місяць:</b>
									<select name="month" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="1" <?=(($data['month'] == 1) ? 'selected' : '')?> >Січень</option>
                                        <option value="2" <?=(($data['month'] == 2) ? 'selected' : '')?> >Лютий</option>
                                        <option value="3" <?=(($data['month'] == 3) ? 'selected' : '')?> >Березень</option>
										<option value="4" <?=(($data['month'] == 4) ? 'selected' : '')?> >Квітень</option>
										<option value="5" <?=(($data['month'] == 5) ? 'selected' : '')?> >Травень</option>
										<option value="6" <?=(($data['month'] == 6) ? 'selected' : '')?> >Червень</option>
										<option value="7" <?=(($data['month'] == 7) ? 'selected' : '')?> >Липень</option>
										<option value="8" <?=(($data['month'] == 8) ? 'selected' : '')?> >Серпень</option>
										<option value="9" <?=(($data['month'] == 9) ? 'selected' : '')?> >Вересень</option>
										<option value="10" <?=(($data['month'] == 10) ? 'selected' : '')?> >Жовтень</option>
										<option value="11" <?=(($data['month'] == 11) ? 'selected' : '')?> >Листопад</option>
										<option value="12" <?=(($data['month'] == 12) ? 'selected' : '')?> >Грудень</option>										
                                    </select>
                                </td>
                                <td>
                                    <b>Рік:</b>
									<select name="year" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
										<option value="2010" <?=(($data['year'] == 2010) ? 'selected' : '')?> >2010</option>
                                        <option value="2011" <?=(($data['year'] == 2011) ? 'selected' : '')?> >2011</option>
                                        <option value="2012" <?=(($data['year'] == 2012) ? 'selected' : '')?> >2012</option>
										<option value="2013" <?=(($data['year'] == 2013) ? 'selected' : '')?> >2013</option>
                                    </select>
                                </td-->
								<td><input type="submit" value="Експорт" class="button"></td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			 
				 
		 
			</table>
			</form>
			</div>
			<script type="text/javascript">
				document.<?=$this->objectTitle?>.buttons = new Array();
				<?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAccidentsWithoutPayedFromMonthInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
			</script>
		</td>
	</tr>
	</table>
</div>