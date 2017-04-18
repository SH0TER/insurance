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
				<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
				<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="label">*Агенція:</td>
					<td colspan="4">
						<?
							$field = $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ];
							echo $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, null, null, $data);
						?>
					</td>
				</tr>
				<tr>
					<td class="label">*Номер картки з:</td>
					<td><input type="text" id="from" name="from" value="<?=$data['from']?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number';" onblur="this.className='fldText number';" /></td>
					<td class="label">*по:</td>
					<td><input type="text" id="to" name="to" value="<?=$data['to']?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number';" onblur="this.className='fldText number';" /></td>
					<td width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="label">*Статус:</td>
					<td colspan="4">
						<?
							$field = $this->formDescription['fields'][ $this->getFieldPositionByName('card_statuses_id') ];
							echo $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, null, null, $data);
						?>
					</td>
				</tr>
				<!--tr>
					<td class="label">*Дата транзакції:</td>
					<td colspan="4">
						<?
							$field = $this->formDescription['fields'][ $this->getFieldPositionByName('transaction_date') ];
							echo $this->getDateSelect($field, $data[ $field['name'].$languageCode.'Year' ], $data[ $field['name'].$languageCode.'Month' ], $data[ $field['name'].$languageCode.'Day' ], $field['name'].$languageCode);
						?>
					</td>
				</tr-->
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