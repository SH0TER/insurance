<script type="text/javascript">

	function checkFields() {	
		if (isNaN(parseInt($('select[name=types_id] option:selected').val()))) {
			alert('Потрібно вибрати тип договору.');
			return false;
		}
	
       if ($('select[name=policy_statuses_id] option:selected').val() == <?=POLICY_STATUSES_GENERATED?>) {	   
            if (!window.confirm('Після переходу в статус "Сформовано" редагування полісу стане неможливим. Продовжити?'))
                return false;
        }

        return true;
    }
  
	function cancelPolicy(button) {
		if (!window.confirm('Ви дійсно бажаєте припинити дiю полісу?')) {
			return;
		}
		document.location='/index.php?do=Policies|cancelPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
	}

	function setProductValues(data) {
	
		$('#rate').val(data.rate);
		$('#rate_label').html(data.amount);
		
	}
	
	function setInsurerIdCard() {
    	if($('[name=insurer_id_card]:checked').val() == 0) {
    		$('table#insurerPassport').show();
    		$('table#insurer_new_passport_table').hide();
    	} else {
    		$('table#insurerPassport').hide();
    		$('table#insurer_new_passport_table').show();
    	}
    }

    function setInsuredIdCard() {
    	if($('[name=insured_id_card]:checked').val() == 0) {
    		$('table#insuredPassport').show();
    		$('table#insured_new_passport_table').hide();
    	} else {
    		$('table#insuredPassport').hide();
    		$('table#insured_new_passport_table').show();
    	}
    }
	
	function setInsured(obj) {
        if (obj.checked) {
            document.<?=$this->objectTitle?>.insured_lastname.value				= getElementValue('insurer_lastname');
            document.<?=$this->objectTitle?>.insured_firstname.value				= getElementValue('insurer_firstname');
            document.<?=$this->objectTitle?>.insured_patronymicname.value		= getElementValue('insurer_patronymicname');

            document.<?=$this->objectTitle?>.insured_dateofbirth.value			= document.<?=$this->objectTitle?>.insurer_dateofbirth.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_day.value		= document.<?=$this->objectTitle?>.insurer_dateofbirth_day.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_month.value		= document.<?=$this->objectTitle?>.insurer_dateofbirth_month.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_year.value		= document.<?=$this->objectTitle?>.insurer_dateofbirth_year.value;

            document.<?=$this->objectTitle?>.insured_passport_series.value		= getElementValue('insurer_passport_series');
            document.<?=$this->objectTitle?>.insured_passport_number.value		= getElementValue('insurer_passport_number');
            document.<?=$this->objectTitle?>.insured_passport_place.value			= getElementValue('insurer_passport_place');

            document.<?=$this->objectTitle?>.insured_passport_date.value			= document.<?=$this->objectTitle?>.insurer_passport_date.value;
            document.<?=$this->objectTitle?>.insured_passport_date_day.value		= document.<?=$this->objectTitle?>.insurer_passport_date_day.value;
            document.<?=$this->objectTitle?>.insured_passport_date_month.value		= document.<?=$this->objectTitle?>.insurer_passport_date_month.value;
            document.<?=$this->objectTitle?>.insured_passport_date_year.value		= document.<?=$this->objectTitle?>.insurer_passport_date_year.value;

            document.<?=$this->objectTitle?>.insured_phone.value					= getElementValue('insurer_phone');
            document.<?=$this->objectTitle?>.insured_email.value					= getElementValue('insurer_email');

            document.<?=$this->objectTitle?>.insured_city.value                  = getElementValue('insurer_city');
            document.<?=$this->objectTitle?>.insured_street.value                = getElementValue('insurer_street');
            document.<?=$this->objectTitle?>.insured_house.value                 = getElementValue('insurer_house');
            document.<?=$this->objectTitle?>.insured_flat.value                  = getElementValue('insurer_flat');

            //Новый пасспорт
            $('input[name=insurer_id_card]:checked').each(function() {
            	$('input[name=insured_id_card][value='+this.value+']').click();
            });
            document.<?=$this->objectTitle?>.insured_newpassport_number.value			= getElementValue('insurer_newpassport_number');
            document.<?=$this->objectTitle?>.insured_newpassport_place.value			= getElementValue('insurer_newpassport_place');
            document.<?=$this->objectTitle?>.insured_newpassport_reestr.value			= getElementValue('insurer_newpassport_reestr');

            document.<?=$this->objectTitle?>.insured_newpassport_date.value				= getElementValue('insurer_newpassport_date');
            document.<?=$this->objectTitle?>.insured_newpassport_date_day.value			= getElementValue('insurer_newpassport_date_day');
            document.<?=$this->objectTitle?>.insured_newpassport_date_month.value		= getElementValue('insurer_newpassport_date_month');
            document.<?=$this->objectTitle?>.insured_newpassport_date_year.value		= getElementValue('insurer_newpassport_date_year');

            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd.value			= getElementValue('insurer_newpassport_dateEnd');
            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd_day.value		= getElementValue('insurer_newpassport_dateEnd_day');
            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd_month.value	= getElementValue('insurer_newpassport_dateEnd_month');
            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd_year.value		= getElementValue('insurer_newpassport_dateEnd_year');
            //

            setSelectValues('insurer_regions_id', 'insured_regions_id');
			setSelectValues('insurer_street_types_id', 'insured_street_types_id');
			setSelectValues('insurer_person_types_id', 'insured_person_types_id');
			
        }
		
    }
	
	$(document).ready(function(){
		$('select[name=types_id]').change(function(){
			value = parseInt($(this).val());
			switch (value) {
				case 1:
					$('#insurance_priceTD').html('8 500,00');
					$('#deductibleTD').html('0.000');
					$('#rateTD').html('20,00');
					$('#insurance_premiumTD').html('1 700,00');
					break;
				case 2:
					$('#insurance_priceTD').html('8 500,00');
					$('#deductibleTD').html('0.000');
					$('#rateTD').html('20,00');
					$('#insurance_premiumTD').html('1 700,00');
					break;
				case 3:
					$('#insurance_priceTD').html('1 350,00');
					$('#deductibleTD').html('0.000');
					$('#rateTD').html('20,00');
					$('#insurance_premiumTD').html('270,00');
					break;
				case 4:
					$('#insurance_priceTD').html('3 600,00');
					$('#deductibleTD').html('0.000');
					$('#rateTD').html('20,00');
					$('#insurance_premiumTD').html('720,00');
					break;					
				default:
					$('#insurance_priceTD').html('0,00');
					$('#deductibleTD').html('0.000');
					$('#rateTD').html('0,00');
					$('#insurance_premiumTD').html('0,00');
					break;
			}
		});
		
		//$('select[name=types_id]').change();
	});
	
</script>
<? $Log->showSystem();?>
<?
/*if  ($action=='insert') {
	$Clients = new Clients($data);
	$data['template'] = 'searchPropertyForm.php';
	$Clients->getSearchForm($data);
}*/
?>

<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" name="product_types_id" id ="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" name="clients_id" value="<?=$data['clients_id']?>" />
	<input type="hidden" name="parent_id" value="<?=$data['parent_id']?>" />
    <input type="hidden" name="changeMode" value="0" />
	<input type="hidden" name="states_id" value="<?=intval($data['states_id'])?>" />
    <input type="hidden" name="policy_statuses_id_old" value="<?=($data['policy_statuses_id_old']) ? $data['policy_statuses_id_old'] : $data['policy_statuses_id']?>" />
	<input type="hidden" name="policy_statuses_id" value="<?=intval($data['policy_statuses_id'])?>" />
<?if ($action=='update') {?>
	<input type="hidden" id="date_day" name="date_day" value="<?=$data['date_day']?>" />
	<input type="hidden" id="date_month" name="date_month" value="<?=$data['date_month']?>" />
	<input type="hidden" id="date_year" name="date_year" value="<?=$data['date_year']?>" />
<?}?>
    <table cellpadding="2" cellspacing="3" width="100%">
        <tr>
            <td>
				<div class="section">Страхувальник:</div>
                
                <b>Персональні дані:</b>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
					<td><input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
					<td><input type="text" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>По батькові:</td>
					<td><input type="text" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey personBlock"><?=$this->getMark()?>Дата народження:</td>
                    <td class="personBlock"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ], $data['insurer_dateofbirth_year' ], $data['insurer_dateofbirth_month' ], $data['insurer_dateofbirth_day' ], 'insurer_dateofbirth', $this->isEqual('insurer_passport_place') . ' ' .$this->getReadonly(true))?></td>

				</tr>
				</table>
				<table cellpadding="5" cellspacing="0" id="insurer_id_card_table">
					<tr>
						<td class="label grey">ID-картка:</td>
						<td class="label grey"><input type="radio" name="insurer_id_card" onclick="setInsurerIdCard()" <?=$this->getReadonly(true)?> value="1" <?= (intval($data['insurer_id_card'])?'checked':'') ?> /></td>
						<td>Так</td>
						<td class="label grey"><input type="radio" name="insurer_id_card" onclick="setInsurerIdCard()" <?=$this->getReadonly(true)?> value="0" <?= (intval($data['insurer_id_card'])?'':'checked') ?> /></td>
						<td>Ні</td>
					</tr>
				</table>
				<table class="personBlock" cellpadding="5" cellspacing="0" id="insurerPassport" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?>>
					<tr>
						<td class="label grey"><?=$this->getMark()?>Паспорт, серія номер:</td>
						<td>
							<input type="text" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series<?=$this->isEqual('insurer_passport_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('insurer_passport_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('insurer_passport_series')?>'" <?=$this->getReadonly(false)?> />
							<input type="text" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="6" class="fldText number<?=$this->isEqual('insurer_passport_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('insurer_passport_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('insurer_passport_number')?>'" <?=$this->getReadonly(false)?> />
						</td>
						<td class="label grey"><?=$this->getMark()?>Паспорт. Ким і де виданий:</td>
						<td><input type="text" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('insurer_passport_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_passport_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_passport_place')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark()?>Паспорт. Дата видачі:</td>
						<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ], $data['insurer_passport_date_year' ], $data['insurer_passport_date_month' ], $data['insurer_passport_date_day' ], 'insurer_passport_date', $this->isEqual('insurer_passport_place') . ' ' .$this->getReadonly(true))?></td>
					</tr>
				</table>
				<table cellpadding="5" cellspacing="0" <?= (intval($data['insurer_id_card'])?'':'style="display:none"') ?> id="insurer_new_passport_table">
					<tr>
						<td class="label grey">Паспорт. Номер:</td>
						<td><input type="text" name="insurer_newpassport_number" value="<?=$data['insurer_newpassport_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td>Паспорт. Ким і де виданий:</td>
						<td><input type="text" name="insurer_newpassport_place" value="<?=$data['insurer_newpassport_place']?>" maxlength="15" class="fldInteger number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td>Паспорт. Дата видачі:</td>
						<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ], $data['insurer_newpassport_date_year' ], $data['insurer_newpassport_date_month' ], $data['insurer_newpassport_date_day' ], 'insurer_newpassport_date', $this->getReadonly(true))?></td>
						<td>
							Унікальний номер запису в реєстрі:
						</td>
						<td>
							<input type="text" name="insurer_newpassport_reestr" value="<?= $data['insurer_newpassport_reestr'] ?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
						</td>
						<td>
							Дійсний до:
						</td>
						<td>
							<?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ], $data['insurer_newpassport_dateEnd_year' ], $data['insurer_newpassport_dateEnd_month' ], $data['insurer_newpassport_dateEnd_day' ], 'insurer_newpassport_dateEnd', $this->getReadonly(true))?>
						</td>
					</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Телефон:</td>
					<td><input type="text" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('insurer_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('insurer_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('insurer_phone')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">E-mail:</td>
					<td><input type="text" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email<?=$this->isEqual('insurer_email')?>" onfocus="this.className='fldTextOver email<?=$this->isEqual('insurer_email')?>'" onblur="this.className='fldText email<?=$this->isEqual('insurer_email')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<b>Адреса:</b>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Область:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_regions_id'))?></td>
					<td class="label grey">Район:</td>
					<td><input type="text" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText area<?=$this->isEqual('insurer_area')?>" onfocus="this.className='fldTextOver area<?=$this->isEqual('insurer_area')?>'" onblur="this.className='fldText area<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Місто:</td>
					<td><input type="text" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_city')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_city')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_city')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey"><?=$this->getMark()?>Вулиця:</td>
					<td>
						<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data. $this->isEqual('insurer_street_types_id'))?>
						<input type="text" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street<?=$this->isEqual('insurer_street')?>" onfocus="this.className='fldTextOver street<?=$this->isEqual('insurer_street')?>'" onblur="this.className='fldText street<?=$this->isEqual('insurer_street')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark()?>Будинок:</td>
					<td><input type="text" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="6" class="fldText house<?=$this->isEqual('insurer_house')?>" onfocus="this.className='fldTextOver house<?=$this->isEqual('insurer_house')?>'" onblur="this.className='fldText house<?=$this->isEqual('insurer_house')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Квартира:</td>
					<td><input type="text" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="10" class="fldText flat<?=$this->isEqual('insurer_flat')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('insurer_flat')?>'" onblur="this.className='fldText flat<?=$this->isEqual('insurer_flat')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
                
                <div class="section">Застрахована особа:</div>

                <b>Персональні дані:</b>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey testdriveproduct">застрахована особа є страхувальником:</td>
					<td class=" testdriveproduct">&nbsp;</td>
					<td class=" testdriveproduct"><input type="checkbox" id="owner" value="1" onclick="setInsured(this)" <?=$this->getReadonly(true)?> /></td>
				</td>
				</table>
				<table>
				<tr>
					<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
					<td><input type="text" name="insured_lastname" value="<?=$data['insured_lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insured_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insured_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insured_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
					<td><input type="text" name="insured_firstname" value="<?=$data['insured_firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insured_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insured_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insured_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>По батькові:</td>
					<td><input type="text" name="insured_patronymicname" value="<?=$data['insured_patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insured_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insured_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insured_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey personBlock"><?=$this->getMark()?>Дата народження:</td>
                    <td class="personBlock"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_dateofbirth') ], $data['insured_dateofbirth_year' ], $data['insured_dateofbirth_month' ], $data['insured_dateofbirth_day' ], 'insured_dateofbirth', $this->isEqual('insured_passport_place') . ' ' .$this->getReadonly(true))?></td>

				</tr>
				</table>
				<table cellpadding="5" cellspacing="0" id="insured_id_card_table">
					<tr>
						<td class="label grey">ID-картка:</td>
						<td class="label grey"><input type="radio" name="insured_id_card" onclick="setInsuredIdCard()" <?=$this->getReadonly(true)?> value="1" <?= (intval($data['insured_id_card'])?'checked':'') ?> /></td>
						<td>Так</td>
						<td class="label grey"><input type="radio" name="insured_id_card" onclick="setInsuredIdCard()" <?=$this->getReadonly(true)?> value="0" <?= (intval($data['insured_id_card'])?'':'checked') ?> /></td>
						<td>Ні</td>
					</tr>
				</table>
				<table class="personBlock" cellpadding="5" cellspacing="0" id="insuredPassport" <?= (intval($data['insured_id_card'])?'style="display:none"':'') ?>>
				<tr>
					<td class="label grey"><?=$this->getMark()?>Паспорт, серія номер:</td>
					<td>
						<input type="text" name="insured_passport_series" value="<?=$data['insured_passport_series']?>" class="fldText series<?=$this->isEqual('insured_passport_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('insured_passport_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('insured_passport_series')?>'" <?=$this->getReadonly(false)?> />
						<input type="text" name="insured_passport_number" value="<?=$data['insured_passport_number']?>" class="fldText number<?=$this->isEqual('insured_passport_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('insured_passport_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('insured_passport_number')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark()?>Паспорт. Ким і де виданий:</td>
					<td><input type="text" name="insured_passport_place" value="<?=$data['insured_passport_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('insured_passport_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insured_passport_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('insured_passport_place')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Паспорт. Дата видачі:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_passport_date') ], $data['insured_passport_date_year' ], $data['insured_passport_date_month' ], $data['insured_passport_date_day' ], 'insured_passport_date', $this->isEqual('insured_passport_place') . ' ' .$this->getReadonly(true))?></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0" <?= (intval($data['insured_id_card'])?'':'style="display:none"') ?> id="insured_new_passport_table">
					<tr>
						<td class="label grey">Паспорт. Номер:</td>
						<td><input type="text" name="insured_newpassport_number" value="<?=$data['insured_newpassport_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td>Паспорт. Ким і де виданий:</td>
						<td><input type="text" name="insured_newpassport_place" value="<?=$data['insured_newpassport_place']?>" maxlength="15" class="fldInteger number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td>Паспорт. Дата видачі:</td>
						<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_date') ], $data['insured_newpassport_date_year' ], $data['insured_newpassport_date_month' ], $data['insured_newpassport_date_day' ], 'insured_newpassport_date', $this->getReadonly(true))?></td>
						<td>
							Унікальний номер запису в реєстрі:
						</td>
						<td>
							<input type="text" name="insured_newpassport_reestr" value="<?= $data['insured_newpassport_reestr'] ?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
						</td>
						<td>
							Дійсний до:
						</td>
						<td>
							<?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_dateEnd') ], $data['insured_newpassport_dateEnd_year' ], $data['insured_newpassport_dateEnd_month' ], $data['insured_newpassport_dateEnd_day' ], 'insured_newpassport_dateEnd', $this->getReadonly(true))?>
						</td>
					</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Телефон:</td>
					<td><input type="text" name="insured_phone" value="<?=$data['insured_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('insured_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('insured_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('insured_phone')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">E-mail:</td>
					<td><input type="text" name="insured_email" value="<?=$data['insured_email']?>" maxlength="50" class="fldText email<?=$this->isEqual('insured_email')?>" onfocus="this.className='fldTextOver email<?=$this->isEqual('insured_email')?>'" onblur="this.className='fldText email<?=$this->isEqual('insured_email')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<b>Адреса:</b>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Область:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_regions_id') ], $data['insured_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insured_regions_id'))?></td>
					<td class="label grey">Район:</td>
					<td><input type="text" name="insured_area" value="<?=$data['insured_area']?>" maxlength="50" class="fldText area<?=$this->isEqual('insured_area')?>" onfocus="this.className='fldTextOver area<?=$this->isEqual('insured_area')?>'" onblur="this.className='fldText area<?=$this->isEqual('insured_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Місто:</td>
					<td><input type="text" name="insured_city" value="<?=$data['insured_city']?>" maxlength="50" class="fldText city<?=$this->isEqual('insured_city')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insured_city')?>'" onblur="this.className='fldText city<?=$this->isEqual('insured_city')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey"><?=$this->getMark()?>Вулиця:</td>
					<td>
						<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_street_types_id') ], $data['insured_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data. $this->isEqual('insured_street_types_id'))?>
						<input type="text" name="insured_street" value="<?=$data['insured_street']?>" maxlength="50" class="fldText street<?=$this->isEqual('insured_street')?>" onfocus="this.className='fldTextOver street<?=$this->isEqual('insured_street')?>'" onblur="this.className='fldText street<?=$this->isEqual('insured_street')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark()?>Будинок:</td>
					<td><input type="text" name="insured_house" value="<?=$data['insured_house']?>" maxlength="6" class="fldText house<?=$this->isEqual('insured_house')?>" onfocus="this.className='fldTextOver house<?=$this->isEqual('insured_house')?>'" onblur="this.className='fldText house<?=$this->isEqual('insured_house')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Квартира:</td>
					<td><input type="text" name="insured_flat" value="<?=$data['insured_flat']?>" maxlength="10" class="fldText flat<?=$this->isEqual('insured_flat')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('insured_flat')?>'" onblur="this.className='fldText flat<?=$this->isEqual('insured_flat')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>

				<div class="section">Параметри:</div>
				
				<table cellspacing="0" cellpadding="5">
                <tr>
					<td class="label grey"><?=$this->getMark()?>Тип договору:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ], $data['types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('types_id'))?></td>
				
                    <td class="label grey"><b>Cтрахова сума, грн.:</b></td>
                    <td align="left" id="insurance_priceTD"><?=$data['price']?></td>

					<td class="label grey"><b>Франшиза, %:</b></td>
                    <td align="left" id="deductibleTD"><?=$data['deductible']?></td>
					
					<td class="label grey"><b>Тариф, %:</b></td>
                    <td align="left" id="rateTD"><?=$data['rate']?></td>
                    
					<td class="label grey"><b>Премiя, грн.:</b></td>
					<td class="label grey" align="left" id="insurance_premiumTD"><?=$data['amount']?></td>
                </tr>
				</table>	
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Номер полісу:</td>
					<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="14" class="fldText number<?=$this->isEqual('number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('number')?>'" onblur="this.className='fldText number<?=$this->isEqual('number')?>'" <?=$this->getReadonly(false)?> />
					<td class="label grey"><?=$this->getMark(false)?><?=($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? 'Дата дод. угоди:' : 'Дата полісу:')?></td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', ($action == 'insert' || $data['agencies_id'] == AGENCIES_EXPRESS_INSURANCE) ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"')?></td>
					<td class="label grey"><?=$this->getMark(false)?>Дата початку дії полісу:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'id="begin_datetime"  onchange="setEnd(); " ' . $this->getReadonly(true))?></td>
					<td class="label grey"><?=$this->getMark(false)?>Дата закінчення дії полісу:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', /*'  '.($this->subMode == 'calculate' ? 'style="color: #aca899; background-color: #f5f5f5;" disabled ':' '). */$this->getReadonly(true))?></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
                    <td class="label grey"><?=$this->getMark()?>Страхова компанія:</td>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurance_companies_id') ], $data['insurance_companies_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurance_companies_id'))?></td>					
					<td class="label grey"> Діагноз:</td>
					<td width="500px"><input type="text" name="diagnosis" value="<?=$data['diagnosis']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>

				<div class="section">Додатково:</div>
				<table width="100%" cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Статус:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], 'onchange="setRequiredFields()" ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
				</tr>
				<tr>
					<td class="label grey">Коментар:</td>
					<td width="100%"><textarea name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->isEqual('comment')?> <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
				</tr>
				<tr>
					<td class="label grey">Призначення платежу:</td>
					<td width="100%">
						<?=$data['number']?>, 
						<?=$data['insurer_lastname']?> <?=substr($data['insurer_firstname'], 0, 2)?>. <?=substr($data['insurer_patronymicname'], 0, 2)?>.
						<?=($data['date_day'].'.'.$data['date_month'].'.'.$data['date_year'])?>р. Страховий платіж згідно договору(полісу) без ПДВ</td>
				</tr>
				</table>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
	initFocus(document.<?=$this->objectTitle?>);
	//changePersonType1();
</script>