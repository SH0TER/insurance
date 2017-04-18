<div class="blockDriver" style="display: <?=($data['id'] && $data['driver_lastname'] ? 'block' : 'none')?>">
	<div class="section">Водій на момент ДТП:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td id="driver_types_id_1" style="display: <?=($data['owner_types_id'] == 1 ? 'block' : 'none')?>"><input type="radio" name="driver_types_id" value="1" <?=($data['driver_types_id'] == 1) ? '' : ''?> <?=$this->getReadonly(true)?> /><b>Страхувальник</b></td>
			<td id="driver_types_id_2" style="display: <?=($data['owner_types_id'] == 1 ? 'block' : 'none')?>"><input type="radio" name="driver_types_id" value="2" <?=($data['driver_types_id'] == 2) ? '' : ''?> <?=$this->getReadonly(true)?> /><b>Власник</b></td>
			<td><input type="radio" name="driver_types_id" value="3" <?=($data['driver_types_id'] == 3) ? '' : ''?> <?=$this->getReadonly(true)?> /><b>Заявник</b></td>
			<td><input type="radio" name="driver_types_id" value="4" <?=($data['driver_types_id'] == 4) ? '' : ''?> <?=$this->getReadonly(true)?> /><b>Без водія</b></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0" id="blockDriverInfo">
		<tr>
			<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
			<td colspan="4"><input type="text" name="driver_lastname" value="<?=$data['driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
			<td colspan="2"><input type="text" name="driver_firstname" value="<?=$data['driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>По батькові:</td>
			<td><input type="text" name="driver_patronymicname" value="<?=$data['driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
		</tr>
		<!--tr>
			<td class="label grey">Посвідчення водія</td>
			<td class="label grey"><?=$this->getMark()?>серія:</td><td><input type="text" id="driver_licence_series" name="driver_licence_series" value="<?=$data['driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>номер:</td><td><input type="text" id="driver_licence_number" name="driver_licence_number" value="<?=$data['driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
			<td class="label grey" align="left"><?=$this->getMark()?>дата:</td><td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_date') ], $data['driver_licence_date_year' ], $data['driver_licence_date_month' ], $data['driver_licence_date_day' ], 'driver_licence_date', $this->getReadonly(true))?></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr-->
	</table>
</div>