<?$Log->showSystem() ?>
<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Аналіз врегулювання страхових справ:</td>
        </tr>
        <tr>
            <td></td>
            <td align="right">
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="<?=$this->object?>|getAnalysisAccidentsByAverageInWindow" />

                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                             
                            <td align="right">
                                <table>
                                    <tr>
										<td><b>Вид страхування:</b></td>
										<td>
                                            <select name="product_types_id[]" size="6" class="fldSelect" multiple="" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
												<option value="<?=PRODUCT_TYPES_KASKO?>" <?=(in_array(PRODUCT_TYPES_KASKO, $data['product_types_id']) ? 'selected' : '')?>>КАСКО</option>
												<option value="<?=PRODUCT_TYPES_GO?>" <?=(in_array(PRODUCT_TYPES_GO, $data['product_types_id']) ? 'selected' : '')?>>ОСЦПВ</option>
												<option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=(in_array(PRODUCT_TYPES_PROPERTY, $data['product_types_id']) ? 'selected' : '')?>>Майно</option>
                                            </select>
                                        </td>
                                        <td><b>Місяць:</b></td>
										<td>
                                            <select name="monthes[]" size="6" class="fldSelect" multiple="" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
											<? foreach($MONTHES as $key => $val) { ?>
												<option value="<?=$key+1?>" <?=(in_array($key + 1, $data['monthes']) ? 'selected' : '')?>><?=$val?></option>
											<? } ?>
                                            </select>
                                        </td>
										<td><b>Рік:</b></td>
										<td>
											<select name="year" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                            <? for ($i = 2010; $i <= intval(date('Y')); $i++){ ?>
												<option value="<?=$i?>" <?=($data['year'] == $i ? 'selected' : '')?>><?=$i?></option>
                                            <? } ?>
                                            </select>
                                        </td>
                                        <td><input type="checkbox" name="is_all" <?=(($data['is_all']) ? 'checked' : '')?>>всі аваркоми</td>
                                       <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getAnalysisAccidentsByAverageInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>