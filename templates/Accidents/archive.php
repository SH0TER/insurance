<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption">Переміщення в архів / з архіву:</td>
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
                                <input type="hidden" name="do" value="<?=$this->object.'|updateArchive'?>" />
								<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>">
								<?
									if (is_array($data['id'])) {
										foreach ($data['id'] as $id) {
											echo '<input type="hidden" name="id[]" value="' . $id . '" />';
										}
									}
								?>
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <tr>
										<td class="label">*Архів:</td>
										<td>
											<select name="archive_statuses_id" class="fldSelect" onfocus="this.className='fldSelectOver '" onblur="this.className='fldSelect'">
												<option value="0" <?=($data['archive_statuses_id'] == '0') ? 'selected' : ''?>>в роботі</option>
												<option value="1" <?=($data['archive_statuses_id'] == '1') ? 'selected' : ''?>>архів</option>
											</select>
										</td>
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