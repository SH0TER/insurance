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
				<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                <input type="hidden" name="product_types_id" value="<?=PRODUCT_TYPES_GO?>" />
				<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
				<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="label"><?=$this->getMark()?>Компанія:</td>
					<td colspan="4">
						<?
							$field = $this->formDescription['fields'][ $this->getFieldPositionByName('insurance_companies_id') ];
							echo $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, null, $data);
						?>
					</td>
				</tr>
				<tr>
					<td class="label"><?=$this->getMark()?>Тип:</td>
					<td colspan="4">
						<?
							$field = $this->formDescription['fields'][ $this->getFieldPositionByName('product_types_id') ];
							echo $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, null, $data);
						?>
					</td>
				</tr>
				<tr>
					<td class="label">Агенція:</td>
					<td colspan="4">
						<?
							$field = $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ];
							echo $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, null, null, $data);
						?>
					</td>
				</tr>
				<tr>
					<td class="label"><?=$this->getMark()?>Серія поліса:</td>
					<td colspan="4"><input type="text" id="series" name="series" value="<?=$data['series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series';" onblur="this.className='fldText series';" /></td>
				</tr>
				<tr>
					<td class="label"><?=$this->getMark()?>Номер бланку з:</td>
					<td><input type="text" id="from" name="from" value="<?=$data['from']?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number';" onblur="this.className='fldText number';" /></td>
					<td class="label"><?=$this->getMark()?>по:</td>
					<td><input type="text" id="to" name="to" value="<?=$data['to']?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number';" onblur="this.className='fldText number';" /></td>
					<td width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center" colspan="4"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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