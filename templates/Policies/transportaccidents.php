<script type="text/javascript">
    var num1 = -1;
	var num2 = -1;
    var num3 = -1;

	function getDateVal(val) {
		var d=explode ('.', val);

		if (d.length==3) {
			var res='';
			if (d[0].length<2) {
				if (d[0].length==0) {
					res = '01' + '.';
				} else {
					res = '0' + d[0] + '.';
				}
			} else {
				res = d[0] + '.';
			}

			if (d[1].length<2) {
				if (d[1].length==0) {
					res+='01'+'.';
				} else {
					res += '0'+d[1]+'.';
				}
			} else {
				res += d[1]+'.';
			}

			if (d[2].length<4) {
				if (d[2].length==0 || d[2].length==3 || d[2].length==1) {
					res+='2000';
				} else if(d[2].length==2) {
					res += '19'+d[2];
				}
			} else {
				res+=d[2];
			}

			this.value = res;
			Day=this.value.substring(0,2);
			Month=this.value.substring(3,5);
			Year=this.value.substring(6,10);
		} else {
			Day=Month=Year=0;
		}

		if (Day.substring(0,1)=='0') {
			Day = Day.substring(1, 2);
		}

		if (Month.substring(0,1)=='0') {
			Month = Month.substring(1, 2);
		}

        Day		= parseInt(Day);
        Month	= parseInt(Month);
        Year	= parseInt(Year);

		var result = new Date(Year, Month-1, Day);
		return result;
	}

	function setInsurerIdCard() {
    	if($('[name=insurer_id_card]:checked').val() == 0) {
    		$('table#passportTRANSPORTACCIDENTS').show();
    		$('table#insurer_new_passport_table').hide();
    	} else {
    		$('table#passportTRANSPORTACCIDENTS').hide();
    		$('table#insurer_new_passport_table').show();
    	}
    }

	function changePersonType(init) {
		switch ( $('select[name=insurer_person_types_id] option:selected').val() ) {
			case '1'://физ. лицо
				/*if ( $('input[name=types_id]').val() != '2' && !init) {
					changeMode();
					$('.quote').css('display', 'none');
				}*/
				$('.personBlock').css('display', '');
				$('.companyBlock').css('display', 'none');

				$('table#insurer_id_card_table').show();
				setInsurerIdCard();
                //$('.terms_id').css('display', '');
				//$('#end_datetime').attr('readonly', true);
				//$('#end_datetime').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
                setEnd();
				break;
			case '2'://юр. лицо
				$('.personBlock').css('display', 'none');
				$('.companyBlock').css('display', '');

				$('table#insurer_id_card_table').hide();
				$('table#insurer_new_passport_table').hide();
                //$('.terms_id').css('display', 'none');
				//$('#end_datetime').attr('readonly', false);
				//$('#end_datetime').attr('style', '');
				$('.quote').css('display', 'block');
				break;
		}
    }

	function setOrganizationTitle() {
		if ($('#organization_types_id').val() > 0) {
			$('.organizationTitleBlock').css('display', 'none');
			$('input[name=organization_types_title]').val('');
		} else {
			$('.organizationTitleBlock').css('display', '');
		}
	}

    function changeAgentSign() {
        if (getElementValue('sign_agents_id') == 0) {
            alert('Необхідно вибрати менеджера!');
            return;
        }

        $.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'html',
            data:	    'do=Policies|changeSignInWindow' +
                        '&product_types_id=' + getElementValue('product_types_id') +
                        '&policies_id=<?=$data['id']?>' +
                        '&sign_agents_id=' + getElementValue('sign_agents_id'),
            success: function(result) {
                alert('Менеджера було змiнено.');
            }
        });
    }

    function checkFields() {
       if ($('#policy_statuses_id option:selected').val() == <?=POLICY_STATUSES_GENERATED?>) {
            if (!window.confirm('Після переходу в статус "Сформован" редагування полісу стане неможливим. Продовжити?'))
                return false;
        }
		
		if ($('input[name=payment_brakedown_id]').val() < 1) {
			alert('Невірна кількість платежів.')
			return false;
		}

        return true;
    }
  
	function cancelPolicy(button) {
		button.disabled = true;
		$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Policies|getPayDissolutionInWindow' +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&dissolutionPercent=20' +
							'&policies_id=<?=$data['id']?>',
				success:	function(result) {
								if (result.returnAmount == '-1') {
									alert('Помилка отримання данних за полісом.');
									return;
								}

								if (!window.confirm('За полісом підлягають поверненю кошти у розмірі ' + result.returnAmount + ' грн.\r\nВи дійсно бажаєте анулювати поліс?')) {
									return;
								}

								document.location='/index.php?do=Policies|cancelPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
							}
		});
		button.disabled = false;
	}

	function continuePolicy() {
		if (!window.confirm('Ви дійсно бажаєте пролонгувати поліс?')) {
				return;
		}
		document.location='/index.php?do=Policies|continuePolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
	}

	function renewPolicy() {
		if (!window.confirm('Ви дійсно бажаєте переукласти поліс?')) {
			return;
		}
		document.location='/index.php?do=Policies|renewPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
	}
	
	$(function() {
		$('#organization_types_id').bind('change',
			function() {
				setOrganizationTitle();
			}
		);
		//setVisibility();
	});
	
	

    function setEnd() {return;


        with (document.<?=$this->objectTitle?>) {
            beginDay	= begin_datetime_day.value;
            beginMonth	= begin_datetime_month.value;
            beginYear	= begin_datetime_year.value;

            if (beginDay.substring(0,1)=='0') {
				beginDay = beginDay.substring(1, 2);
			}

            if (beginMonth.substring(0,1)=='0') {
				beginMonth = beginMonth.substring(1, 2);
			}

            beginDay	= parseInt(beginDay);
            beginMonth	= parseInt(beginMonth);
            beginYear	= parseInt(beginYear);

            if (beginDay>0 && beginMonth>0 && beginYear>0) {
                beginDate	= new Date(beginYear, beginMonth - 1, beginDay);
                endDate		= null;
				addmonth	= 0;
				adddays		= -1;

                switch (getElementValue('terms_years_id')) {
					case '1'://до 1-го року
						addmonth = 1*12;
						adddays		= -1;
						break;
					case '2'://2-роки
						addmonth = 2*12;
						adddays		= -1;
						break;
					case '3'://3-роки
						addmonth = 3*12;
						adddays		= -1;
						break;
					case '4'://4-роки
						addmonth = 4*12;
						adddays		= -1;
						break;
					case '5'://5-роки
						addmonth = 5*12;
						adddays		= -1;
						break;
					case '6'://6-роки
						addmonth = 6*12;
						adddays		= -1;
						break
					case '7'://7-роки
						addmonth = 7*12;
						adddays		= -1;
						break;	
					case '7'://7-роки
						addmonth = 7*12;
						adddays		= -1;
						break;	
					case '8'://8-роки
											addmonth = 8*12;
											adddays		= -1;
											break;	
					case '9'://9-роки
											addmonth = 9*12;
											adddays		= -1;
											break;	
					case '10'://10-роки
											addmonth = 10*12;
											adddays		= -1;
											break;	
					case '11'://11-роки
											addmonth = 11*12;
											adddays		= -1;
											break;	
					case '12'://12-роки
											addmonth = 12*12;
											adddays		= -1;
											break;	
					case '13'://13-роки
											addmonth = 13*12;
											adddays		= -1;
											break;	
					case '14'://14-роки
											addmonth = 14*12;
						adddays		= -1;
						break;							
					case '15'://15-роки
						addmonth = 15*12;
						adddays		= -1;
						break;				
				}

				if (beginMonth==2 && beginDay==29) adddays = 0;

				endDate = beginDate.addMonths(addmonth).addDays(adddays);

                if (endDate!=null) {
                    endDay		= endDate.getDate();
                    endMonth	= endDate.getMonth() + 1;
                    endYear		= endDate.getFullYear();

                    if (endDay < 10) endDay = '0' + endDay;
                    if (endMonth < 10) endMonth = '0' + endMonth;

                    end_datetime_day.value	= endDay;
                    end_datetime_month.value	= endMonth;
                    end_datetime_year.value	= endYear;
                    end_datetime.value		= endDay + '.' + endMonth + '.' + endYear;
                }
            }
        }
    }

    function changeMode() {

        if ($('input[name=policy_statuses_id]').val() == <?=POLICY_STATUSES_GENERATED?>) {
            alert("В статусi \"Сформовано\" режим котирування використовувати заборонено");
            return;
        }

        $('input[name=changeMode]').val(1);

        switch ( $('input[name=types_id]').val() ) {
            case '<?=POLICY_TYPES_AGREEMENT?>':
                $('input[name=types_id]').val(<?=POLICY_TYPES_QUOTE?>);
                break;
            case '<?=POLICY_TYPES_QUOTE?>':
                $('input[name=types_id]').val(<?=POLICY_TYPES_AGREEMENT?>);
                break;
        }

        document.<?=$this->objectTitle?>.submit();
    }

	function calculate(m)
	{
	
	if ($('input[id=types_id]').val()==2) return;

		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=Products|getRateInWindow' + 
						'&product_types_id=' + $('input[name=product_types_id]').val() + 
						'&agencies_id=' + $('input[name=agencies_id]').val() + 
						'&price=' + $('input[name=price]').val() + 
						'&deductibles_value=' + $('select[name=deductibles_value] option:selected').val() + 
						'&rate=' + $('input[name=rate]').val() ,
			success:	setProductValues}
			);
	}	

	function setProductValues(data) {
	
		$('#rate').val(data.rate);
		$('#rate_label').html(data.amount);
		
	}
</script>
<? $Log->showSystem();?>
<?
if  ($action=='insert') {
	$Clients = new Clients($data);
	$data['template'] = 'searchPropertyForm.php';
	$Clients->getSearchForm($data);
}
?>

<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" name="product_types_id" id ="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" name="clients_id" value="<?=$data['clients_id']?>" />
	<input type="hidden" name="parent_id" value="<?=$data['parent_id']?>" />
	<input type="hidden" name="amount_parent" id="amount_parent" value="<?=$data['amount_parent']?>" />
    <input type="hidden" name="changeMode" value="0" />
    <input type="hidden" name="types_id" id="types_id" value="<?=$data['types_id']?>" />
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
				<!--<div align="right" class="quote"><?if ($this->mode != 'view' && $this->permissions['quote'] && $data['policy_statuses_id'] == POLICY_STATUSES_CREATED) {?><a href="javascript: changeMode()" style="color:#ff0066"><?=($this->subMode == 'calculate') ? 'Перейти у режим "Котирування"' : 'Вийти з режиму "Котирування"'?></a><? } ?></div>-->
				<div class="section">Страхувальник:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Тип особи:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_person_types_id') ], $data['insurer_person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changePersonType();"', null, $data, $this->isEqual('insurer_person_types_id'))?></td>
					<td class="label grey companyBlock"><?=$this->getMark()?>Компанiя:</td>
					<td class="companyBlock"><input type="text" name="insurer_company" value="<?=$data['insurer_company']?>" maxlength="100" class="fldText company<?=$this->isEqual('insurer_identification_code')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('insurer_identification_code')?>'" onblur="this.className='fldText company<?=$this->isEqual('insurer_identification_code')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey companyBlock"><?=$this->getMark()?>ЄДРПОУ:</td>
					<td class="companyBlock"><input type="text" name="insurer_edrpou" value="<?=$data['insurer_edrpou']?>" maxlength="10" class="fldText edrpou<?=$this->isEqual('insurer_edrpou')?>" onfocus="this.className='fldTextOver edrpou<?=$this->isEqual('insurer_edrpou')?>'" onblur="this.className='fldText edrpou<?=$this->isEqual('insurer_edrpou')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey personBlock"><?=$this->getMark()?>ІПН:</td>
					<td class="personBlock"><input type="text" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('insurer_identification_code')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('insurer_identification_code')?>'" onblur="this.className='fldText code<?=$this->isEqual('insurer_identification_code')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
					<td><input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
					<td><input type="text" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>По батькові:</td>
					<td><input type="text" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey personBlock"><?=$this->getMark(false)?>Дата народження:</td>
                    <td class="personBlock"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ], $data['insurer_dateofbirth_year' ], $data['insurer_dateofbirth_month' ], $data['insurer_dateofbirth_day' ], 'insurer_dateofbirth', $this->isEqual('insurer_passport_place') . ' ' .$this->getReadonly(true))?></td>

				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Прізвище род:</td>
					<td><input type="text" name="insurer_lastname_rod" value="<?=$data['insurer_lastname_rod']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Ім'я род:</td>
					<td><input type="text" name="insurer_firstname_rod" value="<?=$data['insurer_firstname_rod']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>По батькові род:</td>
					<td><input type="text" name="insurer_patronymicname_rod" value="<?=$data['insurer_patronymicname_rod']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
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
				<table class="personBlock" cellpadding="5" cellspacing="0" id="passportTRANSPORTACCIDENTS" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?>>
					<tr>
						<td class="label grey"><?=$this->getMark(false)?>Паспорт, серія номер:</td>
						<td>
							<input type="text" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series<?=$this->isEqual('insurer_passport_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('insurer_passport_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('insurer_passport_series')?>'" <?=$this->getReadonly(false)?> />
							<input type="text" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number<?=$this->isEqual('insurer_passport_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('insurer_passport_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('insurer_passport_number')?>'" <?=$this->getReadonly(false)?> />
						</td>
						<td class="label grey"><?=$this->getMark(false)?>Паспорт. Ким і де виданий:</td>
						<td><input type="text" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('insurer_passport_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_passport_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_passport_place')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark(false)?>Паспорт. Дата видачі:</td>
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
					<td class="companyBlock"><?=$this->getMark(false)?>Посада:</td>
					<td class="companyBlock"><input type="text" name="insurer_position" value="<?=$data['insurer_position']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="companyBlock"><?=$this->getMark(false)?>Посада род:</td>
					<td class="companyBlock"><input type="text" name="insurer_position_rod" value="<?=$data['insurer_position_rod']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position')?>'" <?=$this->getReadonly(false)?> /></td>
					
					<td class="companyBlock"><?=$this->getMark(false)?>Діє на підставі:</td>
					<td class="companyBlock"><input type="text" name="insurer_ground" value="<?=$data['insurer_ground']?>" maxlength="50" class="fldText place<?=$this->isEqual('insurer_ground')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_ground')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_ground')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>Телефон:</td>
					<td><input type="text" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('insurer_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('insurer_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('insurer_phone')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">E-mail:</td>
					<td><input type="text" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email<?=$this->isEqual('insurer_email')?>" onfocus="this.className='fldTextOver email<?=$this->isEqual('insurer_email')?>'" onblur="this.className='fldText email<?=$this->isEqual('insurer_email')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />
				
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Прізвище 2:</td>
					<td><input type="text" name="insurer_lastname1" value="<?=$data['insurer_lastname1']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Ім'я 2:</td>
					<td><input type="text" name="insurer_firstname1" value="<?=$data['insurer_firstname1']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">По батькові 2:</td>
					<td><input type="text" name="insurer_patronymicname1" value="<?=$data['insurer_patronymicname1']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Прізвище 2 род:</td>
					<td><input type="text" name="insurer_lastname_rod1" value="<?=$data['insurer_lastname_rod1']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Ім'я 2 род:</td>
					<td><input type="text" name="insurer_firstname_rod1" value="<?=$data['insurer_firstname_rod1']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">По батькові 2 род:</td>
					<td><input type="text" name="insurer_patronymicname_rod1" value="<?=$data['insurer_patronymicname_rod1']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="companyBlock">Посада 2:</td>
					<td class="companyBlock"><input type="text" name="insurer_position1" value="<?=$data['insurer_position1']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="companyBlock">Посада 2 род:</td>
					<td class="companyBlock"><input type="text" name="insurer_position_rod1" value="<?=$data['insurer_position_rod1']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position')?>'" <?=$this->getReadonly(false)?> /></td>

					<td class="companyBlock">Діє на підставі 2:</td>
					<td class="companyBlock"><input type="text" name="insurer_ground1" value="<?=$data['insurer_ground1']?>" maxlength="50" class="fldText place<?=$this->isEqual('insurer_ground')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_ground')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_ground')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<div class="companyBlock">
					<!--b>Додатково:</b>
					<table cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey">Прізвище:</td>
						<td><input type="text" name="insurer_lastname1" value="<?=$data['insurer_lastname1']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname1')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname1')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname1')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">Ім'я:</td>
						<td><input type="text" name="insurer_firstname1" value="<?=$data['insurer_firstname1']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname1')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname1')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname1')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">По батькові:</td>
						<td><input type="text" name="insurer_patronymicname1" value="<?=$data['insurer_patronymicname1']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname1')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname1')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname1')?>'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table>
					<table cellpadding="5" cellspacing="0">
					<tr>
						<td>Посада:</td>
						<td><input type="text" name="insurer_position1" value="<?=$data['insurer_position1']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position1')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position1')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position1')?>'" <?=$this->getReadonly(false)?> /></td>
						<td>Діє на підставі:</td>
						<td><input type="text" name="insurer_ground1" value="<?=$data['insurer_ground1']?>" maxlength="50" class="fldText place<?=$this->isEqual('insurer_ground1')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_ground1')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_ground1')?>'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table><br /-->

					<b>Банківські реквізити:</b>
					<table cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey"><?=$this->getMark(false)?>Банк:</td>
						<td><input type="text" name="insurer_bank" value="<?=$data[ 'insurer_bank' ]?>" maxlength="100" class="fldText company<?=$this->isEqual('insurer_bank')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('insurer_bank')?>'" onblur="this.className='fldText company<?=$this->isEqual('insurer_bank')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark(false)?>МФО:</td>
						<td><input type="text" name="insurer_bank_mfo" value="<?=$data[ 'insurer_bank_mfo' ]?>" maxlength="6" class="fldText mfo<?=$this->isEqual('insurer_bank_mfo')?>" onfocus="this.className='fldTextOver mfo<?=$this->isEqual('insurer_bank_mfo')?>'" onblur="this.className='fldText mfo<?=$this->isEqual('insurer_bank_mfo')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark(false)?>Р/р:</td>
						<td><input type="text" name="insurer_bank_account" value="<?=$data[ 'insurer_bank_account' ]?>" maxlength="20" class="fldText bank_account<?=$this->isEqual('insurer_bank_account')?>" onfocus="this.className='fldTextOver bank_account<?=$this->isEqual('insurer_bank_account')?>'" onblur="this.className='fldText bank_account<?=$this->isEqual('insurer_bank_account')?>'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table><br />
				</div>

				<b>Адреса:</b>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Область:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_regions_id'))?></td>
					<td class="label grey">Район:</td>
					<td><input type="text" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText area<?=$this->isEqual('insurer_area')?>" onfocus="this.className='fldTextOver area<?=$this->isEqual('insurer_area')?>'" onblur="this.className='fldText area<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>Місто:</td>
					<td><input type="text" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_city')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_city')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_city')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Вулиця:</td>
					<td>
						<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data. $this->isEqual('insurer_street_types_id'))?>
						<input type="text" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street<?=$this->isEqual('insurer_street')?>" onfocus="this.className='fldTextOver street<?=$this->isEqual('insurer_street')?>'" onblur="this.className='fldText street<?=$this->isEqual('insurer_street')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark(false)?>Будинок:</td>
					<td><input type="text" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="6" class="fldText house<?=$this->isEqual('insurer_house')?>" onfocus="this.className='fldTextOver house<?=$this->isEqual('insurer_house')?>'" onblur="this.className='fldText house<?=$this->isEqual('insurer_house')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Квартира:</td>
					<td><input type="text" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="10" class="fldText flat<?=$this->isEqual('insurer_flat')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('insurer_flat')?>'" onblur="this.className='fldText flat<?=$this->isEqual('insurer_flat')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>

				<!--div class="section">Вигодонабувач:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
				
					<td class="label grey"><?=$this->getMark()?>Тип особи:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('assured_person_types_id') ], $data['assured_person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changePersonType1();" ', null, $data, $this->isEqual('assured_person_types_id'))?></td>
					<td class="label grey">Банк:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ], $data['financial_institutions_id'], $data['languageCode'], 'onchange="changeFinancialInstitution()" ' . $this->getReadonly(true), null, $data, $this->isEqual('financial_institutions_id'))?></td>
					<td>
						<table id="assuredBlock1" cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey">Поліс прошу укласти на користь Вигодонабувача:</td>
							<td><input type="checkbox" name="assured" value="1" <?=(($data['assured'] || $data['assured_title']) ? 'checked': '')?> onclick="setAssured(this)" <?=$this->isEqual('assured')?> <?=$this->getReadonly(true)?> /></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>

				<table id="assuredBlock2" cellpadding="0" cellspacing="5" style="display: <?=($data['assured'] || $data['assured_title']) ? 'block' : 'none'?>">
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>ПІБ (назва):</td>
					<td><input type="text" name="assured_title" value="<?=$data['assured_title']?>" maxlength="200" class="fldText address<?=$this->isEqual('assured_title')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_title')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_title')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>ІПН (ЄРДПОУ):</td>
					<td><input type="text" name="assured_identification_code" value="<?=$data['assured_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('assured_identification_code')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('assured_identification_code')?>'" onblur="this.className='fldText code<?=$this->isEqual('assured_identification_code')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>Адреса:</td>
					<td><input type="text" name="assured_address" value="<?=$data['assured_address']?>" maxlength="100" class="fldText address<?=$this->isEqual('assured_address')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_address')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_address')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>Телефон:</td>
					<td><input type="text" name="assured_phone" value="<?=$data['assured_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('assured_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('assured_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('assured_phone')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey assuredpersonBlock"><?=$this->getMark(false)?>Дата народження:</td>
                    <td class="assuredpersonBlock"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('assured_dateofbirth') ], $data['assured_dateofbirth_year' ], $data['assured_dateofbirth_month' ], $data['assured_dateofbirth_day' ], 'assured_dateofbirth', $this->isEqual('assured_dateofbirth') . ' ' .$this->getReadonly(true))?></td>
					<td class="label grey"><?=$this->getMark(false)?>Рахунок:</td>
					<td><input type="text" name="assured_bank_account" value="<?=$data['assured_bank_account']?>" maxlength="50" class="fldText address<?=$this->isEqual('assured_bank_account')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_bank_account')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_bank_account')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>відкритий в:</td>
					<td><input type="text" name="assured_bank" value="<?=$data['assured_bank']?>" maxlength="50" class="fldText code<?=$this->isEqual('assured_bank')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('assured_bank')?>'" onblur="this.className='fldText code<?=$this->isEqual('assured_bank')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>МФО:</td>
					<td><input type="text" name="assured_bank_mfo" value="<?=$data['assured_bank_mfo']?>" maxlength="100" class="fldText address<?=$this->isEqual('assured_bank_mfo')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_bank_mfo')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_bank_mfo')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table  cellpadding="0" cellspacing="5">
				<tr>
					<td colspan="8">
						<table id="agreementsBlock" cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey">договор іпотеки , номер:</td>
							<td><input type="text" name="mortage_agreement_number" value="<?=$data['mortage_agreement_number']?>" maxlength="15" class="fldText number<?=$this->isEqual('mortage_agreement_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('mortage_agreement_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('mortage_agreement_number')?>'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey">договор іпотеки від, дата</td>
							<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mortage_agreement_date') ], $data['mortage_agreement_date_year' ], $data['mortage_agreement_date_month' ], $data['mortage_agreement_date_day' ], 'mortage_agreement_date', $this->getReadonly(true))?></td>
						</tr>
						 
						</table>
					</td>
				</tr>
				</table-->

		
				<div class="section">Застрахована особа:</div>
				<input type="hidden" name="owner_person_types_id" value="1" />
 
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
					<td><input type="text" name="owner_lastname" value="<?=$data['owner_lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('owner_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('owner_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('owner_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
					<td><input type="text" name="owner_firstname" value="<?=$data['owner_firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('owner_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('owner_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('owner_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>По батькові:</td>
					<td><input type="text" name="owner_patronymicname" value="<?=$data['owner_patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('owner_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('owner_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('owner_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark(false)?>Дата народження:</td>
                    <td  ><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_dateofbirth') ], $data['owner_dateofbirth_year' ], $data['owner_dateofbirth_month' ], $data['owner_dateofbirth_day' ], 'owner_dateofbirth', $this->isEqual('owner_passport_place') . ' ' .$this->getReadonly(true))?></td>

				</tr>
				</table>
				 
				<table cellpadding="5" cellspacing="0">
				<tr>
				<td class="label grey"><?=$this->getMark()?>ІПН:</td>
					<td><input type="text" name="owner_identification_code" value="<?=$data['owner_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('owner_identification_code')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('owner_identification_code')?>'" onblur="this.className='fldText code<?=$this->isEqual('owner_identification_code')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>Телефон:</td>
					<td><input type="text" name="owner_phone" value="<?=$data['owner_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('owner_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('owner_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('owner_phone')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />
 

				<b>Адреса:</b>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Область:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_regions_id') ], $data['owner_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('owner_regions_id'))?></td>
					<td class="label grey">Район:</td>
					<td><input type="text" name="owner_area" value="<?=$data['owner_area']?>" maxlength="50" class="fldText area<?=$this->isEqual('owner_area')?>" onfocus="this.className='fldTextOver area<?=$this->isEqual('owner_area')?>'" onblur="this.className='fldText area<?=$this->isEqual('owner_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>Місто:</td>
					<td><input type="text" name="owner_city" value="<?=$data['owner_city']?>" maxlength="50" class="fldText city<?=$this->isEqual('owner_city')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('owner_city')?>'" onblur="this.className='fldText city<?=$this->isEqual('owner_city')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Вулиця:</td>
					<td>
						<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_street_types_id') ], $data['owner_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data. $this->isEqual('owner_street_types_id'))?>
						<input type="text" name="owner_street" value="<?=$data['owner_street']?>" maxlength="50" class="fldText street<?=$this->isEqual('owner_street')?>" onfocus="this.className='fldTextOver street<?=$this->isEqual('owner_street')?>'" onblur="this.className='fldText street<?=$this->isEqual('owner_street')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark(false)?>Будинок:</td>
					<td><input type="text" name="owner_house" value="<?=$data['owner_house']?>" maxlength="6" class="fldText house<?=$this->isEqual('owner_house')?>" onfocus="this.className='fldTextOver house<?=$this->isEqual('owner_house')?>'" onblur="this.className='fldText house<?=$this->isEqual('owner_house')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Квартира:</td>
					<td><input type="text" name="owner_flat" value="<?=$data['owner_flat']?>" maxlength="10" class="fldText flat<?=$this->isEqual('owner_flat')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('owner_flat')?>'" onblur="this.className='fldText flat<?=$this->isEqual('owner_flat')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>

				 


				<div class="section">Параметри:</div>
				<table cellspacing="0" cellpadding="5">
                <tr>
                    <td class="label grey"><b>Cтрахова сума, грн.:</b></td>
                    <td align="left"><input type="text" onchange="calculate(false)" id="price" name="price" value="<?=$data['price']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"   <?=$this->getReadonly(true)?>/></td>
                    <!--td class="label grey"><b>Франшиза, %:</b></td>
                    <td align="left">
					
					<select id="deductibles_value" name="deductibles_value" <?=$this->getReadonly(true)?> class="fldSelect<?=$this->isEqual('deductibles_value')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('deductibles_value')?>'" onblur="this.className='fldSelect<?=$this->isEqual('deductibles_value')?>'" onchange="calculate(false);">
						<option value="0.00" <?if ($data['deductibles_value']==0) echo 'selected'?>>0.00
						<option value="0.25" <?if ($data['deductibles_value']==0.25) echo 'selected'?>>0.25
						<option value="0.50" <?if ($data['deductibles_value']==0.5) echo 'selected'?>>0.50
						<option value="1.00" <?if ($data['deductibles_value']==1) echo 'selected'?>>1.00
						<option value="1.50" <?if ($data['deductibles_value']==1.5) echo 'selected'?>>1.50
						<option value="2.00" <?if ($data['deductibles_value']==2) echo 'selected'?>>2.00
					</select>
					
					</td-->
					
					<td class="label grey"><b>Кількість платежів:</b></td>
                    <td align="left"><input type="text" id="payment_brakedown_id" name="payment_brakedown_id" value="<?=$data['payment_brakedown_id']?>" maxlength="10" class="fldInteger" onfocus="this.className='fldIntegerOver';" onblur="this.className='fldInteger';"   <?=$this->getReadonly(true)?>/></td>
					
					<td class="label grey"><b>Тариф, %:</b></td>
                    <td align="left"><input type="text" onchange="calculate(false)" id="rate" name="rate" value="<?=$data['rate']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"   <?=$this->getReadonly(true)?>/></td>
					<td class="label grey"><b>Премiя:</b></td>
					<td id="rate_label" class="label grey" align="left"><?=getMoneyFormat($data['amount'])?></td>
					<td><input class="button" type="button" onmouseout="this.className = 'button';" onmouseover="this.className = 'buttonOver';" onclick="calculate()" value=" Розрахувати "></td>
					</tr>
				</table>	
				<table cellpadding="5" cellspacing="0">
				<tr>
					<? if ($this->mode == 'view' || ($data['agencies_id'] == AGENCIES_EXPRESS_INSURANCE) || ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW)) {?>
					<td class="label grey">Номер полісу:</td>
					<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="20" class="fldText number<?=$this->isEqual('number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('number')?>'" onblur="this.className='fldText number<?=$this->isEqual('number')?>'" <?=($action == 'insert' || $data['agencies_id'] == AGENCIES_EXPRESS_INSURANCE) ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"'?> />
					<td class="label grey"><?=$this->getMark(false)?><?=($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? 'Дата дод. угоди:' : 'Дата полісу:')?></td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', ($action == 'insert' || $data['agencies_id'] == AGENCIES_EXPRESS_INSURANCE) ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"')?></td>
					<? } ?>
					<!--td class="label grey termsYears"><?=$this->getMark(false)?>Період співпраці за договором:</td>
					<td class="termsYears"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('terms_years_id') ], $data['terms_years_id' ], $data['languageCode'], 'onchange="setEnd();calculate(false);" ' . $this->getReadonly(true), null, $data, $this->isEqual('terms_years_id'))?></td-->
					<td class="label grey"><?=$this->getMark(false)?>Дата початку дії полісу:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'id="begin_datetime"  onchange="setEnd(); " ' . $this->getReadonly(true))?></td>
					<td class="label grey"><?=$this->getMark(false)?>Дата закінчення дії полісу:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', /*'  '.($this->subMode == 'calculate' ? 'style="color: #aca899; background-color: #f5f5f5;" disabled ':' '). */$this->getReadonly(true))?></td>
				</tr>
				</table>
				
				<div class="section">Пiдписи:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
				<td class="label grey"><?=$this->getMark()?>Статус:</td>
                <td>
                <?
                    $field = $this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ];
                    if ($data['ECmode'] && $data['financial_institutions_id']==35) {
                        $field['name'] .= '_temp';
                        echo '<input type="hidden" id="policy_statuses_id" name="policy_statuses_id" value="' . $data['policy_statuses_id'] . '" />';
                        echo $this->buildSelect($field, $data['policy_statuses_id'], $data['languageCode'], ' disabled', null, $data);
                    } else {
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'));
                    }
                ?>
                </td>
				
					<td class="label grey"><?=$this->getMark()?>Пiдпис полicа:</td>
					<td>
						<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ], $data['sign_agents_id' ], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('sign_agents_id'))?>
						<? if (intval($data['documents'])==0 && $this->mode != 'update') {?>
						<input type="button" value=" Змiнити " onclick="changeAgentSign();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
						<?}?>
					</td>
				</tr>
				</table>

				<div class="section">Додатково:</div>
				<table width="100%" cellpadding="5" cellspacing="0">
				<? if ($this->mode == 'view') {?>
				<tr>
					<td class="label grey"><?=$this->getMark()?>Статус:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], 'onchange="setRequiredFields()" ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
				</tr>
				<?}?>
				<tr>
					<td class="label grey">Коментар:</td>
					<td width="100%"><textarea name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->isEqual('comment')?> <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
				</tr>
				</table>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
	initFocus(document.<?=$this->objectTitle?>);
	changePersonType();
	//changePersonType1();
</script>