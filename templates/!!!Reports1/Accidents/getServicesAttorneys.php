<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Послуги повірених:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="<?=$this->object?>|getServicesAttorneysInWindow" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="description" valign="bottom"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <td>
														<b>Місяць:</b>
														<select name="month" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
															<option value="00" <?=(($data['month'] == '00') ? 'selected' : '')?> >...</option>
															<option value="01" <?=(($data['month'] == '01') ? 'selected' : '')?> >Січень</option>
															<option value="02" <?=(($data['month'] == '02') ? 'selected' : '')?> >Лютий</option>
															<option value="03" <?=(($data['month'] == '03') ? 'selected' : '')?> >Березень</option>
															<option value="04" <?=(($data['month'] == '04') ? 'selected' : '')?> >Квітень</option>
															<option value="05" <?=(($data['month'] == '05') ? 'selected' : '')?> >Травень</option>
															<option value="06" <?=(($data['month'] == '06') ? 'selected' : '')?> >Червень</option>
															<option value="07" <?=(($data['month'] == '07') ? 'selected' : '')?> >Липень</option>
															<option value="08" <?=(($data['month'] == '08') ? 'selected' : '')?> >Серпень</option>
															<option value="09" <?=(($data['month'] == '09') ? 'selected' : '')?> >Вересень</option>
															<option value="10" <?=(($data['month'] == '10') ? 'selected' : '')?> >Жовтень</option>
															<option value="11" <?=(($data['month'] == '11') ? 'selected' : '')?> >Листопад</option>
															<option value="12" <?=(($data['month'] == '12') ? 'selected' : '')?> >Грудень</option>										
														</select>
													</td>
													<td>
														<b>Рік:</b>														
														<select name="year" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
														<option value="0" <?=(($data['month'] == 0) ? 'selected' : '')?>>...</option>
														<?
														$year = date("Y");
															for ($i=2013; $i<=$year; $i++){
																if ($i == $data['year']) 
																	echo"<option value = $i selected>".$i."</option>";
																else
																	echo "<option value = $i>".$i."</option>";
																}
														?>
														</select>
													</td>
													<td><input type="submit" value="Виконати" class="button"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getServicesAttorneysInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>
<div style="color: white;"><?=$time?></div>