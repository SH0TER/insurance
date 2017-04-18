<div class="blockTimeAndPlace" style="display: <?=($data['id'] ? 'block' : 'none')?>">
	<div class="section">Час та місце пригоди:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey" style="width: 120px;"><b>Дата та час настання:</b></td>
			<td style="width: 170px;"><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('datetime') ], $data[ 'datetime_year' ], $data[ 'datetime_month' ], $data[ 'datetime_day' ], ($data[ 'datetime_hour' ]>0 ? $data[ 'datetime_hour' ] : '00'), ($data[ 'datetime_minute' ]>0 ? $data[ 'datetime_minute' ] : '00'), 'datetime', $this->getReadonly(true))?></td>
			<td class="label grey" style="width: 50px;"><b>Адреса:</b></td>
			<td style="width: 355px;"><input type="text" name="address" value="<?=$data['address']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
</div>