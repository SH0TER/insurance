<div class="section">Персональні дані:</div>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td class="label grey"><?=$this->getMark()?>Компанія:</td>
        <td width="500"><input type="text" name="company" value="<?=$data[ 'company' ]?>" maxlength="150" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
        <td class="label grey">VIP статус:</td>
        <td><input type="checkbox" name="important_person" <?if($action == 'view'){?>disabled=""<?}?> <?if($data['important_person'] == 1){?>checked=""<?}?> onclick="changeVipStatus(this);"/></td>
        <td class="label grey"><?=$this->getMark()?>ЄРДПОУ:</td>
        <td><input type="text" name="identification_code" value="<?=$data[ 'identification_code' ]?>" maxlength="8" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
		<?=($this->mode == 'view') ? '<td><a href="javascript: showHideDetails()"><img id="button" src="/images/administration/navigation/details_over.gif" width="19" height="19" alt="Показати/зховати" alt="Показати/сховати" /></a></td><td><a href="javascript: showHideDetails()">показати/cховати деталі</a></td>' : '';?>
    </tr>
</table>
<div id="details" <? if ($this->mode == 'view') echo 'style="display: none;"'?>>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
			<td><input type="text" name="lastname" value="<?=$data[ 'lastname' ]?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
			<td><input type="text" name="firstname" value="<?=$data[ 'firstname' ]?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>По батькові:</td>
			<td><input type="text" name="patronymicname" value="<?=$data[ 'patronymicname' ]?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><?=$this->getMark()?>Посада:</td>
			<td><input type="text" name="position" value="<?=$data[ 'position' ]?>" maxlength="150" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Діє на підставі:</td>
			<td><input type="text" name="ground" value="<?=$data[ 'ground' ]?>" maxlength="50" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><?=$this->getMark()?>Стать:</td>
			<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sexes_id') ], $data[ 'sexes_id' ], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
			<td class="label grey">Дата народження:</td>
			<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('dateofbirth') ], $data[ 'dateofbirthYear' ], $data[ 'dateofbirthMonth' ], $data[ 'dateofbirthDay' ], 'dateofbirth', $this->getReadonly(true))?></td>
		</tr>
	</table>

	<b>Англійська:</b>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">Компанія:</td>
			<td width="500"><input type="text" name="company_en" value="<?=$data[ 'company_en' ]?>" maxlength="150" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">Прізвище:</td>
			<td><input type="text" name="lastname_en" value="<?=$data[ 'lastname_en' ]?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Ім'я:</td>
			<td><input type="text" name="firstname_en" value="<?=$data[ 'firstname_en' ]?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">По батькові:</td>
			<td><input type="text" name="patronymicname_en" value="<?=$data[ 'patronymicname_en' ]?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">Посада:</td>
			<td><input type="text" name="position_en" value="<?=$data[ 'position_en' ]?>" maxlength="100" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Діє на підставі:</td>
			<td><input type="text" name="ground_en" value="<?=$data[ 'ground_en' ]?>" maxlength="50" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>
	

	<div class="section">Юридична адреса:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><?=$this->getMark()?>Область:</td>
			<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('registration_regions_id') ], $data[ 'registration_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
			<td class="label grey">Район:</td>
			<td colspan="3"><input type="text" name="registration_area" value="<?=$data[ 'registration_area' ]?>" maxlength="50" class="fldText area" onfocus="this.className='fldTextOver area'" onblur="this.className='fldText area'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>Місто:</td>
			<td><input type="text" name="registration_city" value="<?=$data[ 'registration_city' ]?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly()?> /></td>
		</tr>
		<tr>
			<td class="label grey"><?=$this->getMark()?>Вулиця:</td>
			<td>
				<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('registration_street_types_id') ], $data['registration_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?>
				<input type="text" name="registration_street" value="<?=$data[ 'registration_street' ]?>" maxlength="200" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly()?> />
			</td>
			<td class="label grey"><?=$this->getMark()?>Будинок:</td>
			<td><input type="text" name="registration_house" value="<?=$data[ 'registration_house' ]?>" maxlength="5" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Офіс:</td>
			<td><input type="text" name="registration_flat" value="<?=$data[ 'registration_flat' ]?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly()?> /></td>
			<td colspan="2">&nbsp;</td>
		</tr>
	</table>

	<b>Англійська:</b>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">Район:</td>
			<td><input type="text" name="registration_area_en" value="<?=$data[ 'registration_area_en' ]?>" maxlength="50" class="fldText area" onfocus="this.className='fldTextOver area'" onblur="this.className='fldText area'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Місто:</td>
			<td><input type="text" name="registration_city_en" value="<?=$data[ 'registration_city_en' ]?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Вулиця:</td>
			<td><input type="text" name="registration_street_en" value="<?=$data[ 'registration_street_en' ]?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>

	<div class="section">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td class="section" style="border: none;">Фактична адреса: &nbsp; </td>
				<td>співпадає з юридичною адресою:</td>
				<td><input type="checkbox" name="isSameHabitation" value="1" onclick="setHabbitationAddress(this)" <?=$this->getReadonly(true)?> /></td>
			</tr>
		</table>
	</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey"><?=$this->getMark()?>Область:</td>
			<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('habitation_regions_id') ], $data[ 'habitation_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
			<td class="label grey">Район:</td>
			<td colspan="3"><input type="text" name="habitation_area" value="<?=$data[ 'habitation_area' ]?>" maxlength="50" class="fldText area" onfocus="this.className='fldTextOver area'" onblur="this.className='fldText area'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>Місто:</td>
			<td><input type="text" name="habitation_city" value="<?=$data[ 'habitation_city' ]?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly()?> /></td>
		</tr>
		<tr>
			<td class="label grey"><?=$this->getMark()?>Вулиця:</td>
			<td>
				<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('habitation_street_types_id') ], $data['habitation_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?>
				<input type="text" name="habitation_street" value="<?=$data[ 'habitation_street' ]?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly()?> />
			</td>
			<td class="label grey"><?=$this->getMark()?>Будинок:</td>
			<td><input type="text" name="habitation_house" value="<?=$data[ 'habitation_house' ]?>" maxlength="5" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Офіс:</td>
			<td><input type="text" name="habitation_flat" value="<?=$data[ 'habitation_flat' ]?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly()?> /></td>
			<td class="label grey"><?=$this->getMark()?>Телефон:</td>
			<td><input type="text" name="habitation_phone" value="<?=$data[ 'habitation_phone' ]?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>

	<b>Англійська:</b>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">Район:</td>
			<td><input type="text" name="habitation_area_en" value="<?=$data[ 'habitation_area_en' ]?>" maxlength="50" class="fldText area" onfocus="this.className='fldTextOver area'" onblur="this.className='fldText area'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Місто:</td>
			<td><input type="text" name="habitation_cityEn" value="<?=$data[ 'habitation_cityEn' ]?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Вулиця:</td>
			<td><input type="text" name="habitation_street_en" value="<?=$data[ 'habitation_street_en' ]?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly()?> /></td>
		</tr>
	</table>

	<div class="section">Банківські реквізити:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Банк:</td>
		<td><input type="text" name="bank" value="<?=$data['bank']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
		<td class="label grey"><?=$this->getMark()?>МФО:</td>
		<td><input type="text" name="bank_mfo" value="<?=$data['bank_mfo']?>" maxlength="6" class="fldText mfo" onfocus="this.className='fldTextOver mfo'" onblur="this.className='fldText mfo'" <?=$this->getReadonly(false)?> /></td>
		<td class="label grey"><?=$this->getMark()?>Розрахунковий рахунок:</td>
		<td><input type="text" name="bank_account" value="<?=$data['bank_account']?>" maxlength="14" class="fldText bank_account" onfocus="this.className='fldTextOver bank_account'" onblur="this.className='fldText bank_account'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	</table>
	<b>Англійська:</b>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey">Банк:</td>
		<td><input type="text" name="bank_en" value="<?=$data['bank_en']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	</table>

	<div class="section">Додатково:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey">Номер картки CarMan@CarWoman:</td>
		<td><input type="text" name="card_car_man_woman" value="<?=$data['card_car_man_woman']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	</table>
</div>