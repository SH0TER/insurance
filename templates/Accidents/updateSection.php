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
						<input type="hidden" name="do" value="<?=$this->object.'|updateSection'?>" />
						<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                        <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>">
                        <input type="hidden" name="id" value="<?=$data['id']?>">
                        <input type="hidden" name="number" value="<?=$data['number']?>">
						<table width="100%" cellpadding="2" cellspacing="0">
						<tr>
                            <td><?=$this->getMark()?>Категорія:</td>
		                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('accident_sections_id') ], $data['accident_sections_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
						</tr>
						<tr>
							<td><?=$this->getMark()?>Коментар:</td>
							<td><textarea name="update_section_comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';"></textarea></td>
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