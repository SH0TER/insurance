<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption"><?=$this->getFormTitle($actionType)?>:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
                    <tr>
                        <td>
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$data['do']?>" />
                                <input type="hidden" name="id" value="<?=$data['id']?>" />
								<?
									if (is_array($data['clients_id'])) {
										foreach ($data['clients_id'] as $clients_id) {
											echo '<input type="hidden" name="clients_id[]" value="' . $clients_id . '" />';
										}
									}
								?>
                                <input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
                                <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
								<input type="hidden" name="process" value="1" />
								<input type="hidden" name="file" value="1" />
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <tr>
                                        <td class="label">*Дата:</td>
                                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date')?></td>
                                    </tr>
									
                                    <tr <?if ($data['product_types_id']!=4) { echo 'style="display: none;"'; }?>>
                                        <td class="label">*Сума:</td>
                                    <td><input type="text" id="amount" name="amount" value="<?=$data['amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney" <?=$this->getReadonly(false)?> /></td>
                                    </tr>
									
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>