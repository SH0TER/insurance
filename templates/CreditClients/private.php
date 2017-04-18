<div class="section">Персональні дані:</div>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
        <td><input type="text" name="lastname" value="<?=$data[ 'lastname' ]?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
        <td><input type="text" name="firstname" value="<?=$data[ 'firstname' ]?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>По батькові:</td>
        <td><input type="text" name="patronymicname" value="<?=$data[ 'patronymicname' ]?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
    </tr>
    <tr>
        <td class="label grey"><?=$this->getMark()?>Стать:</td>
        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sexes_id') ], $data[ 'sexes_id' ], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
        <td class="label grey">Дата народження:</td>
        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('dateofbirth') ], $data[ 'dateofbirthYear' ], $data[ 'dateofbirthMonth' ], $data[ 'dateofbirthDay' ], 'dateofbirth', $this->getReadonly(true))?></td>
    </tr>
</table>

<div class="section">Паспортні дані, ідентифікаційний код:</div>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td class="label grey"><?=$this->getMark()?>Паспорт, серія та номер:</td>
        <td>
            <input type="text" name="passport_series" value="<?=$data[ 'passport_series' ]?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
            <input type="text" name="passport_number" value="<?=$data[ 'passport_number' ]?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
        </td>
        <td class="label grey"><?=$this->getMark()?>Ким і де виданий:</td>
        <td><input type="text" name="passport_place" value="<?=$data[ 'passport_place' ]?>" maxlength="100" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>Дата видачі:</td>
        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('passport_date') ], $data[ 'passport_date_year' ], $data[ 'passport_date_month' ], $data[ 'passport_date_day' ], 'passport_date', $this->getReadonly(true))?></td>
    </tr>
</table>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td class="label grey"><?=$this->getMark()?>ІПН:</td>
        <td><input type="text" name="identification_code" value="<?=$data[ 'identification_code' ]?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>Мобільний телефон:</td>
        <td><input type="text" name="mobile_phone" value="<?=$data[ 'mobile_phone' ]?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly()?> /></td>
        <td class="label grey">E-mail:</td>
        <td><input type="text" name="email" value="<?=$data[ 'email' ]?>" maxlength="50" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly()?> /></td>
    </tr>
</table>

<div class="section">Дані щодо водійських прав:</div>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td class="label grey"><?=$this->getMark()?>Водійські права, серія та номер:</td>
        <td>
            <input type="text" name="driver_licence_series" value="<?=$data[ 'driver_licence_series' ]?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
            <input type="text" name="driver_licence_number" value="<?=$data[ 'driver_licence_number' ]?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
        </td>
        <td class="label grey"><?=$this->getMark()?>Місце видачі:</td>
        <td><input type="text" name="driver_licence_place" value="<?=$data[ 'driver_licence_place' ]?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>Дата видачі:</td>
        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_date') ], $data[ 'driver_licence_date_year' ], $data[ 'driver_licence_date_month' ], $data[ 'driver_licence_date_day' ], 'driver_licence_date', $this->getReadonly(true))?></td>
    </tr>
</table>

<div class="section">Адреса реєстрації:</div>
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
            <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('registration_street_types_id') ], $data[ 'registration_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?>
            <input type="text" name="registration_street" value="<?=$data[ 'registration_street' ]?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly()?> />
        </td>
        <td class="label grey"><?=$this->getMark()?>Будинок:</td>
        <td><input type="text" name="registration_house" value="<?=$data[ 'registration_house' ]?>" maxlength="5" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly()?> /></td>
        <td class="label grey">Квартира:</td>
        <td><input type="text" name="registration_flat" value="<?=$data[ 'registration_flat' ]?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>Телефон:</td>
        <td><input type="text" name="registration_phone" value="<?=$data[ 'registration_phone' ]?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly()?> /></td>
    </tr>
</table>

<div class="section">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td class="section" style="border: none;">Адреса фактичного проживання: &nbsp; </td>
            <td>співпадає з адресою реєстрації:</td>
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
            <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('habitation_street_types_id') ], $data[ 'habitation_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?>
            <input type="text" name="habitation_street" value="<?=$data[ 'habitation_street' ]?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly()?> />
        </td>
        <td class="label grey"><?=$this->getMark()?>Будинок:</td>
        <td><input type="text" name="habitation_house" value="<?=$data[ 'habitation_house' ]?>" maxlength="5" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly()?> /></td>
        <td class="label grey">Квартира:</td>
        <td><input type="text" name="habitation_flat" value="<?=$data[ 'habitation_flat' ]?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly()?> /></td>
        <td class="label grey"><?=$this->getMark()?>Телефон:</td>
        <td><input type="text" name="habitation_phone" value="<?=$data[ 'habitation_phone' ]?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly()?> /></td>
    </tr>
</table>