<div class="blockApplicant" style="display: <?=($data['id'] ? 'block' : 'none')?>">
	<div class="section">Інформація про заявника:</div>
	<table cellpadding="5" cellspacing="0">
		<tr id="blockApplicantTypesId" style="display: <?=($data['owner_types_id'] == 1 ? 'block' : 'none')?>">
			<td><input type="radio" name="applicant_types_id" value="1" onclick="setApplicant(1)" <?=$this->getReadonly(true)?> /><b>Страхувальник</b></td>
			<td><input type="radio" name="applicant_types_id" value="2" onclick="setApplicant(2)" <?=$this->getReadonly(true)?> /><b>Власник</b></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><b>Прізвище:</b></td>
			<td colspan="4"><input type="text" name="applicant_lastname" value="<?=$data['applicant_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><b>Ім'я:</b></td>
			<td><input type="text" name="applicant_firstname" value="<?=$data['applicant_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><b>По батькові:</b></td>
			<td><input type="text" name="applicant_patronymicname" value="<?=$data['applicant_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>				
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><b>Область:</b></td>
			<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('applicant_regions_id') ], $data['applicant_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
			<td class="label grey"><b>Район:</b></td>
			<td><input type="text" name="applicant_area" value="<?=$data['applicant_area']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
			<td class="label grey"><b>Місто:</b></td>
			<td><input type="text" name="applicant_city" value="<?=$data['applicant_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><b>Вулиця:</b></td>
			<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('applicant_street_types_id') ], $data['applicant_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="applicant_street" value="<?=$data['applicant_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
			<td class="label grey"><b>Будинок:</b></td>
			<td><input type="text" name="applicant_house" value="<?=$data['applicant_house']?>" maxlength="15" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
			<td class="label grey"><b>Квартира:</b></td>
			<td><input type="text" name="applicant_flat" value="<?=$data['applicant_flat']?>" maxlength="10" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
			<td class="label grey"><b>Телефон(и):</b></td>
			<td><input type="text" name="applicant_phone" value="<?=$data['applicant_phone']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
</div>