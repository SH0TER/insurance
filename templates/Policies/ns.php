<?
if ($_POST['ECmode']) {
    $data['ECmode'] = $_POST['ECmode'];
}
?>
<script type="text/javascript">
function changeServicePerson() {
        $.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'html',
            data:	    'do=Policies|changeServicePersonInWindow' +
                        '&product_types_id=' + getElementValue('product_types_id') +
                        '&id=<?=$data['id']?>' +
                        '&service_person=' + getElementValue('service_person'),
            success: function(result) {
                alert(result);
            }
        });
    }

	function changeMode() {

		if($('#policy_statuses_id').val() == <?=POLICY_STATUSES_GENERATED?>) {
			alert('В статусi Сформовано режим котирування використовувати заборонено!');
			return;
		}

		$('[name=change_mode]').val(1);

		switch ( $('[name=types_id]').val() ) {
			case '<?=POLICY_TYPES_AGREEMENT?>':
				$('[name=types_id]').val(<?=POLICY_TYPES_QUOTE?>);
				break;
			case '<?=POLICY_TYPES_QUOTE?>':
				$('[name=types_id]').val(<?=POLICY_TYPES_AGREEMENT?>);
				break;
		}
		document.<?=$this->objectTitle?>.submit();
	}

	function setUkrGaz()
	{
		$("#values_id3 [value=5]").attr("selected", "selected");
		setDefault();
	}

		//новый пасспорт 
	function setInsurerIdCard() {
	    if($('[name=insurer_id_card]:checked').val() == 0) {
	        $('#passportNS').show();
	        $('table#insurer_new_passport_table').hide();
	    } else {
	        $('#passportNS').hide();
	        $('table#insurer_new_passport_table').show();
	    }
	}
	
	function setVTB() {
		$("#values_id3 [value=5]").attr("selected", "selected");
		$("#values_id5 [value=18]").attr("selected", "selected");
		$("#values_id2 [value=15]").attr("selected", "selected");
		$("#values_id4 [value=1]").attr("selected", "selected");
		$("#values_id1 [value=12]").attr("selected", "selected");
		$('.profession_list').css('display', 'none');
		$('.additional_info').css('display', 'none');
		$('.insurer_activity').css('display', 'none');
		$('.insurer_position').css('display', 'none');
		$('.insurer_company').css('display', 'none');
	}
	
	function setDefault()
	{
		$('.profession_list').css('display', '');
		$('.additional_info').css('display', '');
		$('.insurer_activity').css('display', '');
		$('.insurer_position').css('display', '');
		$('.insurer_company').css('display', '');
	}
	
	function loadRisks() {

                if($('select[name=financial_institutions_id] option:selected').val() == 19) {
                    setUkrGaz();
                }
				else if($('select[name=financial_institutions_id] option:selected').val() == 28) {
                    setVTB();
                }
				else
				{
					setDefault();
				}
                changeProduct();
                $.ajax({
                    type:		'POST',
                    url:		'index.php',
                    dataType:	'html',
                    data:		'do=ParametersRisks|getListPolicyInWindow' +
								'&agencies_id=<?=$data['agencies_id']?>' +
                                '&product_types_id=' + $('input[name=product_types_id]').val() +
                                '&financial_institutions_id=' + $('select[name=financial_institutions_id] option:selected').val() +
                                '&types_id=' + $('input[name=types_id]').val(),
                    success:	function(result) {
                                    $('#risksDiv').html(result);
                                }}

                );

	}

	function setRisks(obj) {
		var max = 0;
		$('input[name=risks[]][checked=true]').each(
			function() {
				max = this.value;
			}
		);

		$('input[name=risks[]][checked=false]').each(
			function() {
				if (this.value < max) {
					this.checked = true;
				}
			}
		);
	}
	
	function changeDiscount() {
			$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'json',
				async:		false,
				data:       'do=Products|getDiscountInWindow' +
							'&products_id[]=' + $('input[name=products_id]').val() +
							'&date=' + $('#date_year').val() + '-' + $('#date_month').val() + '-' + $('#date_day').val() +
							'&agencies_id=<?=$data['agencies_id']?>' +
							'&card_car_man_woman=0',
				success: setDiscount});
	}

		
	function getRisks() {
		var result = '';
        $('input[name=risks[]]:hidden').each(
			function() {
				result = result + '&' + this.name + '=' + this.value;
			}

		);
		$('input[name=risks[]][checked=true]').each(
			function() {
				result = result + '&' + this.name + '=' + this.value;
			}

		);
        return result;
	}
    function getFactors() {
		var params = '';
            $('select[name*="values_id"] option:selected').each(function () {
                if($(this).val() != '') params += '&values_id[]='+ $(this).val();
            });
        return params;
	}

    function setDiscount(max_discount) {
        var discount = document.getElementById('discount');
		var current_discount = $('select[name=discount] option:selected').val();

		discount.options.length = 0;
		for (var i=0; i <= max_discount; i++) {
			discount.options[ discount.options.length ] = new Option(i + '.00', i + '.00');
			if (i + '.00' == current_discount) {
				discount.selectedIndex = i;
			}
		}
    }

	function setProductValues(data) {
        if($('[name=types_id]').val() == <?=POLICY_TYPES_AGREEMENT?>) setDiscount(data.max_discount);
		
        //при установке и сняитии галочки на скидочной карте, то пересчитываем каоьуляцию
        if($('#cart_discount').attr("checked") == true) {
		 <? if (!ereg('view', $action)) {?>
             $('#rate_label').html('<b>Тариф:</b>' + ' ' + data.rate + '%; ' + data.amount);
		 <?}?>
			$('[name=rate]').val(data.rate);
            //$('#correct_factors').html('<b>Поправочний коефіцієнт:</b>' + ' '  + data.product_factors);
            $('#cart_discount').val(data.cart_discount);
            $('#values_id4').change(function(){$('#profession_description').html('<b>Опис: </b>' + data.description[$('select[name=values_id4] option:selected').val()])});
            $('#profession_description').html('<b>Опис: </b>' + data.description[$('select[name=values_id4] option:selected').val()]);
            $('#sport_description').html('<b>Опис: </b>' + data.description[$('select[name=values_id1] option:selected').val()]);
        }
        else {
            $('#cart_discount').val(0);
		<? if (!ereg('view', $action)) {?>
            $('#rate_label').html('<b>Тариф:</b>' + ' '  + data.rate_without_cart_discount + '%; ' + data.amount_without_cart_discount) ;
		 <?}?>	
			$('[name=rate]').val(data.rate_without_cart_discount);
            //$('#correct_factors').html('<b>Поправочний коефіцієнт:</b>' + ' '  + data.product_factors);
            $('#profession_description').html('<b>Опис: </b>' + data.description[$('select[name=values_id4] option:selected').val()]);
            $('#sport_description').html('<b>Опис: </b>' + data.description[$('select[name=values_id1] option:selected').val()]);
        }
	}

	function changeProduct() {
		//changeDiscount();
		<?if($data['types_id'] == POLICY_TYPES_AGREEMENT) {?>
        if($('select[name=financial_institutions_id] option:selected').val() == 19) {
                    setUkrGaz();
        }
		else if($('select[name=financial_institutions_id] option:selected').val() == 28) {
                    setVTB();
        }
		else {setDefault();}
		
        if(!$('select[name=discount] option:selected').val())  discount = 0;
        else discount = $('select[name=discount] option:selected').val();
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=Products|getRateInWindow' + 
						'&product_types_id=' + $('input[name=product_types_id]').val() + 
						'&agencies_id=' + $('input[name=agencies_id]').val() + 
						'&financial_institutions_id=' + $('select[name=financial_institutions_id] option:selected').val() + 
						'&price=' + getElementValue('price') + 
						'&insurance_companies_id=' + getElementValue('insurance_companies_id') + 
						'&discount=' + discount +
						'&cart_discount=' + $('#cart_discount]:checked').val() +
						'&allowed_products_id=' + getElementValue('allowed_products_id') +
                        '&terms_id=' + $('select[name=terms_id] option:selected').val() +
						'&options_second_year=' + getElementValue('options_second_year') +
                        '&products_id=' + $('input[name=products_id]').val() +
						getRisks() +
                        getFactors(),
			success:	setProductValues}
		);
		<?}?>
	}

	function initPravex() {
	<? if($Authorization->data['top_agencies_id'] == 417 && $this->mode != 'view') {?>
		$('#financial_institutions_id').val(34);
		$('#terms_id').val(66);
		var insurance_companies_id = getElementValue('insurance_companies_id');
		if (insurance_companies_id==4) {
			$('#priceblock').css('display','none');
			$('#temppriceblock').css('display','');
		}
		else {
			$('#priceblock').css('display','');
			$('#temppriceblock').css('display','none');
		}

		<?}?>
	}	
		
    function calculate() {
		initPravex();
		<?if($data['types_id'] == POLICY_TYPES_AGREEMENT) {?>
		setRisks();
		changeProduct();
		<?}?>
	}

	$(function() {
		$('#begin_datetime').bind(
			'change',
			function() {
				setEnd();
			}
		);
	});
	
	
    function setEnd() {

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

	<?
	if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {//Для переукладених дата оконечная идет из полиса оригинала
	?>
		$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'json',
					data:		'do=Policies|getAmountUsedInWindow' +
								'&product_types_id=' + getElementValue('product_types_id') +
								'&id=<?=$data['parent_id']?>' +
								'&date=' + beginYear + '-' + beginMonth + '-' + beginDay,
					success:	function(result) {
									if (result.amountUsed == '-1') {
										alert('Помилка отримання данних за полісом.');
										return;
									}
									//document.<?=$this->objectTitle?>.amountUsed.value = result.amountUsed;
									document.getElementById('amount_usedBlock').innerHTML = result.amountUsed;
								}
			});

			return;
	<?}?>		

            if (beginDay>0 && beginMonth>0 && beginYear>0) {

                beginDate	= new Date(beginYear, beginMonth - 1, beginDay);
                endDate		= null;
				addmonth	= 0;
				adddays		= -1;

                 switch ($('#terms_id').val()) {

					case '55'://1 мес.
						addmonth = 1;
						adddays		= 0;
						break;
					case '56'://2 мес.
						addmonth = 2;
						adddays		= 0;
						break;
					case '57'://3 мес.
						addmonth = 3;
						adddays		= 6;
						break;
					case '58'://4 мес.
						addmonth = 4;
						adddays		= 0;
						break;
					case '59'://5 мес.
						addmonth = 5;
						adddays		= 0;
						break;
					case '60'://6 мес.
						addmonth = 6;
						adddays		= 0;
						break;
					case '61'://7 мес.
						addmonth = 7;
						break;
					case '62'://8 мес.
						addmonth = 8;
						break;
					case '63'://9 мес.
						addmonth = 9;
						break;
					case '64'://10 мес.
						addmonth = 10;
						break;
					case '65'://11 мес.
						addmonth = 11;
						break;
					case '66'://1 год.
						addmonth = 12;
						break;
					case '68'://
						addmonth = 13;
						break;	
					case '69'://
						addmonth = 14;
						break;	
					case '70'://
						addmonth = 15;
						break;	
					case '71'://
						addmonth = 16;
						break;	
					case '72'://
						addmonth = 17;
						break;	
						case '73'://
						addmonth = 18;
						break;	
					case '74'://
						addmonth = 19;
						break;	
					case '75'://
						addmonth = 20;
						break;	
					case '76'://
						addmonth = 21;
						break;	
					case '77'://
						addmonth = 22;
						break;	
					case '78'://
						addmonth = 23;
						break;	
					case '79'://
						addmonth = 24;
						break;	
					case '80'://
						addmonth = 25;
						break;	
					case '81'://
						addmonth = 26;
						break;	
					case '82'://
						addmonth = 27;
						break;	
					case '83'://
						addmonth = 28;
						break;	
					case '84'://
						addmonth = 29;
						break;	
					case '85'://
						addmonth = 30;
						break;
					case '86'://
						addmonth = 31;
						break;	
					case '87'://
						addmonth = 32;
						break;	
					case '88'://
						addmonth = 33;
						break;	
					case '89'://
						addmonth = 34;
						break;	
					case '90'://
						addmonth = 35;
						break;	
					case '91'://
						addmonth = 36;
						break;							
				}

				if (beginMonth==2 && beginDay==29) adddays = 0;

				if ($("#financial_institutions_id option:selected").val() == 11) {
					endDate = beginDate.addMonths(addmonth).addDays(adddays + 1);
				} else {
					endDate = beginDate.addMonths(addmonth).addDays(adddays);

				}

                if (endDate!=null) {
                    endDay		= endDate.getDate();
                    endMonth	= endDate.getMonth() + 1;
                    endYear		= endDate.getFullYear();

                    if (endDay < 10) endDay = '0' + endDay;
                    if (endMonth < 10) endMonth = '0' + endMonth;

                    end_datetime_day.value		= endDay;
                    end_datetime_month.value	= endMonth;
                    end_datetime_year.value		= endYear;
                    end_datetime.value			= endDay + '.' + endMonth + '.' + endYear;
                }
            }
        }
    }

	function changeRowStyle(id) {
		for (i=0; i < document.getElementById( id ).rows.length; i++) {
			document.getElementById( id ).rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

	var num = -1;
    function addAgreement() {
		var agreement = 
			'<tr class="agreement' + num + '">' +
				'<td><input type="text" name="agreements[' + num + '][company]" maxlength="100" class="fldText company" onfocus="this.className=\'fldTextOver company\'" onblur="this.className=\'fldText company\'" /></td>' +
				'<td><input type="text" name="agreements[' + num + '][kind]" maxlength="100" class="fldText company" onfocus="this.className=\'fldTextOver company\'" onblur="this.className=\'fldText company\'" /></td>' +
				'<td><input type="text" name="agreements[' + num + '][price]" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" /></td>' +
				'<td>' +
					'<input type="text" id="agreements_' + num + '_date" name="agreements[' + num + '][date]" maxlength="10" class="fldDatePicker" onfocus="this.className=\'fldDatePickerOver\'" onblur="this.className=\'fldDatePicker\'" />' +
					'<input type="hidden" id="agreements_' + num + '_date_day" name="agreements[' + num + '][date_day]" />' +
					'<input type="hidden" id="agreements_' + num + '_date_month" name="agreements[' + num + '][date_month]" />' +
					'<input type="hidden" id="agreements_' + num + '_date_year" name="agreements[' + num + '][date_year]" />' +
				'</td>' +
				'<td align="center"><a href="javascript:deleteAgreement(' + num + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
			'</tr>';

		$('#agreements').append(agreement);
		changeRowStyle('agreements');
		num--;

		initDatePicker();
    }

    function getAllRisks() {
        var risks =
                '';
    }

	function deleteAgreement(i) {
		$('.agreement' + i).remove();
		changeRowStyle('agreements');
	}

	function setVisibility() {
		if ($('#fop').val() == 1) {
			$('.fophide').css('display', '');
		} else {
			$('.fophide').css('display', 'none');
			$('#give_a_statement').val(0);
			$('#civil_servant').val(0);
			$('#not_civil_servant').val(0);
			$('#public_figure').val(0);
		}
	}

    function quoteCalculate() {
        var amount;
        amount = parseFloat($('#price').val()) * parseFloat($('#rate').val()) / 100;
        $('#amount').val(amount);
    }
	$(function() {
		$('#fop').bind('change', function() {setVisibility();});
		setVisibility();
		<? if (!ereg('view', $action)) echo 'changeProduct();'?>
		initFocus(document.<?=$this->objectTitle?>);
	});

    $(document).ready(function(){

        if('<?=$action?>' == 'viewDocuments') {
            $('input[name*="risk"]').attr('disabled', true);
			if($('select[name=financial_institutions_id] option:selected').val() == 28) {
              setVTB();
			}
			else {setDefault();}
        }
        
        $('#values_id3').change(function(){
             if($('select[name=financial_institutions_id] option:selected').val() == 19) {
                setUkrGaz();
            }
			else if($('select[name=financial_institutions_id] option:selected').val() == 28) {
                setVTB();
            }
			else {setDefault();}
        });
		
        switch ( $('[name=types_id]').val() ) {
			case '<?=POLICY_TYPES_AGREEMENT?>':
                
				break;
			case '<?=POLICY_TYPES_QUOTE?>':
				quoteCalculate();
				break;
		}


    });

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
	
	function setAmount()
	{
		var credit_amount = getElementValue('credit_amount');
		var credit_percent = getElementValue('credit_percent');
		credit_amount.replace(',','.');
		credit_percent.replace(',','.');
		credit_amount = parseFloat(credit_amount);
		credit_percent = parseFloat(credit_percent);
		credit_amount= isNaN(credit_amount) ? 0 : credit_amount;
		credit_percent= isNaN(credit_percent) ? 0 : credit_percent;
		var amount = credit_amount+(credit_amount/100*credit_percent);
		$('#price').val(amount);
		calculate();
	}
	function checkFields() {
		var err_flag = false;
		 $('select[name*="values_id"]').each(function () {
              if($(this).val()=='')
			  {
				alert("Усi поля позначенi символом * мають бути заповненi");
				err_flag = true;
				return;
			  }	
         });
		if (err_flag) return false;
		document.<?=$this->objectTitle?>.submit();
		return true;
	}

</script>

<? $Log->showSystem();?>
<?
if  ($action=='insert') {
	$Clients = new Clients($data);
	$Clients->getSearchForm($data);
}
?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" id="id" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="products_id" value="<?=$data['products_id']?>" />
	<input type="hidden" id="parent_id" name="parent_id" value="<?=$data['parent_id']?>" />
    <input type="hidden" name="insurer_person_types_id" value="1" />
	<input type="hidden" name="types_id" value="<?=$data['types_id']?>" />
	<input type="hidden" name="change_mode" value="0" />
	<input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" name="clients_id" value="<?=$data['clients_id']?>" />
    <input type="hidden" name="date_day" value="<?=$data['date_day']?>" />
    <input type="hidden" name="date_month" value="<?=$data['date_month']?>" />
    <input type="hidden" name="date_year" value="<?=$data['date_year']?>" />
	<?if ($_SESSION['auth']['top_agencies_id'] != 1254 && $_SESSION['auth']['top_agencies_id']!=417) {?>
	<input type="hidden" id="allowed_products_id" name="allowed_products_id" value="<?=$data['allowed_products_id']?>" />
	<?}?>
	<?
		if (!$data['insurance_companies_id']) $data['insurance_companies_id']=4;
	?>
	
	
	
    <table cellpadding="2" cellspacing="3" width="100%">
	<tr>
		<td>
			<div align="right"><?if ($this->mode != 'view' && $this->permissions['quote'] && $data['ECmode']!=1 && $data['policy_statuses_id'] == POLICY_STATUSES_CREATED) {?><a href="javascript: changeMode()" style="color:#ff0066"><?=($this->subMode == 'calculate') ? 'Перейти у режим "Котирування"' : 'Вийти з режиму "Котирування"'?></a><? } ?></div>
            
            <div id="agreementParams">
			
                <table cellpadding="5" cellspacing="0">
                <tr>
					<?if ($_SESSION['auth']['top_agencies_id'] == 417 || $Authorization->data['roles_id']!=ROLES_AGENT) {?>
					<td class="label grey"><?=$this->getMark()?>Страхова компанiя:</td>
					<td ><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurance_companies_id') ], $data['insurance_companies_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="calculate()"', null, $data, $this->isEqual('insurance_companies_id'))?></td>								
					<?} else {?>
					<input type="hidden" id="insurance_companies_id" name="insurance_companies_id" value="<?=$data['insurance_companies_id']?>" />
					<?}?>
				
                    <td class="label grey"><?=$this->getMark()?>Банк:</td>
					<?if ($_SESSION['auth']['top_agencies_id'] != 245) {?>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ], $data['financial_institutions_id'], $data['languageCode'], 'onchange="loadRisks()" ' . $this->getReadonly(true), null, $data)?></td>
					<? } else { ?>
					<td><select name="financial_institutions_id" id="financial_institutions_id"><option selected="" value="28">ПАТ "ВТБ БАНК"</option></select></td>
					<?}?>
					<?if ($_SESSION['auth']['top_agencies_id'] == 1254) {?>
					<td class="label grey"><?=$this->getMark()?>Продукт:</td>
					<td>
					<select name="allowed_products_id" id="allowed_products_id" onchange="calculate()">
					<option <? if ($data['allowed_products_id']==376) echo 'selected';?> value="376">Продукт-2.5</option>
					<option <? if ($data['allowed_products_id']==339) echo 'selected';?> value="339">Продукт-3.99</option>
					<option <? if ($data['allowed_products_id']==377) echo 'selected';?>  value="377">Продукт-5.99</option>
					</select>
					</td>
					<?}?>
					<?if ($_SESSION['auth']['top_agencies_id'] == 417) {?>
					<td class="label grey">Продукт:</td>
					<td>
					<select name="allowed_products_id" id="allowed_products_id" onchange="calculate()">
					<option value="">...</option>
					<option <? if ($data['allowed_products_id']==634) echo 'selected';?> value="634">Легкий (Тариф 1,5%)</option>
					<option <? if ($data['allowed_products_id']==414) echo 'selected';?> value="414">Оптимальний (Тариф 4%)</option>
					</select>
					</td>
					<?}?>
					 
					<td class="label grey">стороннiй клієнт:</td>
					<td><input type="checkbox" id="options_second_year" name="options_second_year" onclick="calculate()"  value="1" <?=($data['options_second_year']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>

					
                </tr>
                </table>
			

			
            <div class="section">Ризики:</div>
			<div id="risksDiv"><?=ParametersRisks::getListPolicy($data['product_types_id'], $data, $additional, $layout='horisontal')?></div>
            <div class="section additional_info">Додаткові відомості:</div>
                <table cellpadding="5" cellspacing="0" class="additional_info">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Територія дії Договору страхування</td>
                        <td>
						
                            <?
							$data['factor_types_id'] = PRODUCT_CORRECTION_FACTORS_TYPES_LOCATION;
                               echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'onchange="calculate()" '. $this->getReadonly(true), null, $data);
                            ?>
                        </td>
                        <td class="label grey"><?=$this->getMark()?>Вік Страхувальника/Застрахованої особи</td>
                        <td>
                            <? $data['factor_types_id'] = PRODUCT_CORRECTION_FACTORS_TYPES_AGES;
                               echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'onchange="calculate()" '. $this->getReadonly(true), null, $data);
                            ?>
                        </td>
                        <td class="label grey"><?=$this->getMark()?>Дія страхового захисту впродовж доби</td>
                        <td>
                            <? $data['factor_types_id'] = PRODUCT_CORRECTION_FACTORS_TYPES_TERMS_HOURS;
                               echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'onchange="calculate()" '. $this->getReadonly(true), null, $data);
                            ?>
                        </td>

                    </tr>
                </table>
                <hr noshade width="100%" color="#4453AF" size="1" class="profession_list">
                <table cellpadding="5" cellspacing="0" width="100%" class="profession_list">
                    <tr>
                        <td class="label grey" width="20%"><?=$this->getMark()?>Перелік професій:</td>
                        <td height="100">
                            <? $data['factor_types_id'] = PRODUCT_CORRECTION_FACTORS_TYPES_PROFESSIONS;
                               echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'onchange="calculate()" '. $this->getReadonly(true), null, $data);
                            ?>
                        </td>
                        <td id="profession_description" width="60%"></td>
                    </tr>
                    <tr>
                        <td class="label grey" width="20%"><?=$this->getMark()?>Категорії спортсменів:</td>
                        <td height="80">
                            <? $data['factor_types_id'] = PRODUCT_CORRECTION_FACTORS_TYPES_SPORTS;
                               echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'onchange="calculate()" '. $this->getReadonly(true), null, $data);
                            ?>
                        </td>
                         <td id="sport_description" width="60%"></td>
                    </tr>
                </table>
            <div class="section"></div>
			<?
				$show_fields = $_SESSION['auth']['top_agencies_id'] == 245 || $data['financial_institutions_id']==28 ? true : false ;
			?>
			<table cellspacing="0" cellpadding="5" style="display: <?=$show_fields ? '' : 'none'?>">
			<tr>
                <td class="label grey">Сума кредиту, грн.:</td>
                <td align="left"><input type="text" id="credit_amount" name="credit_amount" value="<?=$data['credit_amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="setAmount()" <?=$this->getReadonly(true)?>/></td>
				<td class="label grey">Річна відсоткова ставка , %:</td>
                <td align="left"><input type="text" id="credit_percent" name="credit_percent" value="<?=$data['credit_percent']?>" maxlength="6" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="setAmount()" <?=$this->getReadonly(true)?>/></td>

			<tr>
			</table>
			<table cellspacing="0" cellpadding="5">
                <tr>
				<td class="label grey">Cтрахова сума, грн.:</td>
				<td align="left">
				<? if ($Authorization->data['top_agencies_id'] == 417 && $this->mode != 'view') { //правекс выбор сумм только из списка
				?>
					<span id="temppriceblock">
					<select id="tempprice" name="tempprice" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="$('#price').val(this.value);calculate();" <?=$this->getReadonly(true)?>>
						<option value="0.00" <?if (intval($data['price'])==0) echo 'selected' ?>>0.00
						<option value="1250" <?if (intval($data['price'])==1250) echo 'selected' ?>>1250.00
						<option value="2500" <?if (intval($data['price'])==2500) echo 'selected' ?>>2500.00
						<option value="5000" <?if (intval($data['price'])==5000) echo 'selected' ?>>5000.00
						<option value="7500" <?if (intval($data['price'])==7500) echo 'selected' ?>>7500.00
						<option value="10000" <?if (intval($data['price'])==10000) echo 'selected' ?>>10000.00
						<option value="12500" <?if (intval($data['price'])==12500) echo 'selected' ?>>12500.00
						<option value="25000" <?if (intval($data['price'])==25000) echo 'selected' ?>>25000.00
					</select>
					</span>
				<?
				}  
				?>
                    <span id="priceblock" style="display: <?= $Authorization->data['top_agencies_id'] == 417 && $this->mode != 'view' ? 'none' : '' ?>"><input type="text" id="price" name="price" value="<?=$data['price']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="calculate()" <?=$this->getReadonly(true)?>/></span>
                    
					</td>
					<td>Термін страхування:</td>
                    <td><?
						$hide_fields = $_SESSION['auth']['top_agencies_id'] == 245 || $_SESSION['auth']['top_agencies_id'] == 417 || $_SESSION['auth']['top_agencies_id'] == 1254 || $_SESSION['auth']['top_agencies_id'] == 846 || $_SESSION['auth']['top_agencies_id'] == 561 ? true : false ;
						
                        //убераем тип, для переопределенной функции buildSelect
                        unset($data['factor_types_id']);
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ], $data['terms_id' ], $data['languageCode'], 'onchange="calculate(); setEnd();" ' . $this->getReadonly(true).($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? ' disabled':''), null, $data, $this->isEqual('terms_id'))?></td>
                    <td class="label grey" style="display: <?=$hide_fields ? 'none' : ''?>">Знижка агента, %:</td>
                    <td style="display: <?=$hide_fields ? 'none' : ''?>">
                        <select id="discount" name="discount" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="calculate();" <?=$this->getReadonly(true)?>>
                            <option value="0.00">0.00
                            <?
                                for ($j=1; $j <= $data['discount']; $j++) {
                                    echo '<option value="' . $j . '.00" ' . ((intval($j) == intval($data['discount'])) ? ' selected' : '') . '>' . $j . '.00';
                                }
                        ?>
                        </select>
                    </td>
                    <td class="label grey" style="display: <?=$hide_fields ? 'none' : ''?>">Чи є у вас картка CarMan@CarWoman:</td>
					
                    <td style="display: <?=$hide_fields ? 'none' : ''?>"><input type="checkbox" name="cart_discount" id="cart_discount" value="<?=$data['cart_discount']?>" <? if ($data['cart_discount'] > 0) echo 'checked';?> onclick="calculate()" <?=$this->getReadonly(true)?> /></td>
                    <td class="label grey" title="cart_discount" style="display: <?=$hide_fields ? 'none' : ''?>">Номер:</td>
                    <td  style="display: <?=$hide_fields ? 'none' : ''?>" title="cart_discount"><input type="text" name="card_car_man_woman" value="<?=$data['card_car_man_woman']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" onchange="calculate(false)" <?=$this->getReadonly(false)?> /></td>
                    <?if($data['types_id'] == POLICY_TYPES_AGREEMENT) {?>
					<td id="rate_label" class="label grey" align="left"><?=getRateFormat($data['rate'])?>%; <?=getMoneyFormat($data['amount'])?></td>
					<?}?>
                </tr>
            </table>
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <td id="correct_factors" class="label grey" align="left"></td>
                </tr>
			</table>
             </div>
            <?if($data['types_id'] != POLICY_TYPES_AGREEMENT) {?>
            <div id="quoteParams">
                
                <div class="section">Параметри:</div>
                <table width="100%" cellpadding="3" cellspacing="0">
                    <tr class="columns">
                        <td>Знижка для банкiв, %</td>
                        <td>Компенсацiя банка, %</td>
                        <td>Тариф, %.</td>
                        <td>Тариф, грн.</td>
                    </tr>
                    <tr class="row1">
                        <td><input type="text" name="bank_discount_value" value="<?=$data['bank_discount_value']?>" maxlength="10" class="fldPercent" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"/></td>
                        <td><input type="text" name="bank_commission_value" value="<?=$data['bank_commission_value']?>" maxlength="10" class="fldPercent" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"/></td>
                        <td><input type="text" name="rate" id="rate" value="<?=$data['rate']?>" maxlength="10" class="fldPercent" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="quoteCalculate();" /></td>
                        <td><input type="text" name="amount" readonly id= "amount" value="<?=$data['amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"/></td>
                    </tr>
                </table>
                <div class="section">Комісійна винагорода:</div>
                    <table width="100%" cellpadding="0" cellspacing="0">
                    <tr class="columns">
                        <td>Агеція:</b></td>
                        <td>Агент:</b></td>
                        <td class="financialInstitutionCommission">Керiвник:</b></td>
                        <td class="financialInstitutionCommission">Заст. керiвника:</b></td>
                    </tr>
                    <tr class="row1">
                        <td>
                            <input type="text" name="commission_agency_percent" value="<?=$data['commission_agency_percent']?>" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> /> %
                            від страх <input type="radio" name="commission_agency_base" value="1" <?=($data['commission_agency_base'] == 1) ?'checked': '' ?>/> суми <input type="radio" name="commission_agency_base" value="2" <?=($data['commission_agency_base'] == 2) ?'checked': '' ?> /> премії &nbsp; <b>АБО</b> &nbsp;
                            <input type="text" name="commission_agency_amount" value="<?=$data['commission_agency_amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" /> грн. &nbsp;
                        </td>
                        <td>
                            <input type="text" name="commission_agent_percent" value="<?=$data['commission_agent_percent']?>" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> />
                            від страх <input type="radio" name="commission_agent_base" value="1"   <?=($data['commission_agent_base'] == 1) ?'checked': '' ?> /> суми <input type="radio" name="commission_agent_base" value="2" <?=($data['commission_agent_base'] == 2) ?'checked': '' ?> /> премії &nbsp; <b>АБО</b> &nbsp;
                            <input type="text" name="commission_agent_amount" value="<?=$data['commission_agent_amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" /> грн. &nbsp;
                        </td>

                        <td class="financialInstitutionCommission">
                            <input type="text" name="director1_commission_percent" value="<?=$data['director1_commission_percent']?>" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> />
                            від страх <input type="radio" name="director1_commission_base" value="1" <?=($data['director1_commission_base'] == 1) ?'checked': '' ?> /> суми <input type="radio" name="director1_commission_base" value="2" <?=($data['director1_commission_base'] == 2) ?'checked': '' ?> /> премії <b>АБО</b>
                            <input type="text" name="director1_commission_amount" value="<?=$data['director1_commission_amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" /> грн.
                        </td>
                        <td class="financialInstitutionCommission">
                            <input type="text" name="director2_commission_percent" value="<?=$data['director2_commission_percent']?>" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> />
                            від страх <input type="radio" name="director2_commission_base" value="1" <?=($data['director2_commission_base'] == 1) ?'checked': '' ?> /> суми <input type="radio" name="director2_commission_base" value="2" <?=($data['director2_commission_base'] == 2) ?'checked': '' ?> /> премії <b>АБО</b>
                            <input type="text" name="director2_commission_amount" value="<?=$data['director2_commission_amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" /> грн.
                        </td>

                    </tr>
                    </table>
            <?}
			else {
			?>
                        <input type="hidden" name="bank_discount_value" value="<?=$data['bank_discount_value']?>" />
                        <input type="hidden" name="bank_commission_value" value="<?=$data['bank_commission_value']?>"/>
                        <input type="hidden" name="rate"  value="<?=$data['rate']?>"  />
                        <input type="hidden" name="amount" readonly id="amount" value="<?=$data['amount']?>"/>
                        <input type="hidden" name="commission_agency_percent" value="<?=$data['commission_agency_percent']?>"  />
                        <input type="hidden" name="commission_agency_base" value="<?=($data['commission_agency_base'])?>"/> 
                        <input type="hidden" name="commission_agency_amount" value="<?=$data['commission_agency_amount']?>"/>
                        <input type="hidden" name="commission_agent_percent" value="<?=$data['commission_agent_percent']?>"/>
                        <input type="hidden" name="commission_agent_base" value="<?=($data['commission_agent_base'])?>" /> 
                        <input type="hidden" name="commission_agent_amount" value="<?=$data['commission_agent_amount']?>"/>
                        <input type="hidden" name="director1_commission_percent" value="<?=$data['director1_commission_percent']?>" />
                        <input type="hidden" name="director1_commission_base" value="<?=($data['director1_commission_base'])?>" />
                        <input type="hidden" name="director1_commission_amount" value="<?=$data['director1_commission_amount']?>" />
                        <input type="hidden" name="director2_commission_percent" value="<?=$data['director2_commission_percent']?>"/>
                        <input type="hidden" name="director2_commission_base" value="<?=($data['director1_commission_base'])?>" />
                        <input type="hidden" name="director2_commission_amount" value="<?=$data['director2_commission_amount']?>"/>
			<?}?>
            <div class="section">Страхувальник:</div>
			<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
					<td><input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
					<td><input type="text" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>По батькові:</td>
					<td><input type="text" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Дата народження:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ], $data['insurer_dateofbirth_year' ], $data['insurer_dateofbirth_month' ], $data['insurer_dateofbirth_day' ], 'insurer_dateofbirth', $this->getReadonly(true))?></td>
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
			<table cellpadding="5" cellspacing="0" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?> id="passportNS">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Паспорт, серія і номер:</td>
					<td>
						<input type="text" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> />
						<input type="text" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark()?>Паспорт. Ким і де виданий:</td>
					<td><input type="text" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Паспорт. Дата видачі:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ], $data['insurer_passport_date_year' ], $data['insurer_passport_date_month' ], $data['insurer_passport_date_day' ], 'insurer_passport_date', $this->getReadonly(true))?></td>
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
				<td class="label grey"><?=$this->getMark()?>ІПН:</td>
				<td><input type="text" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey insurer_company"><?=$this->getMark()?>Місце роботи:</td>
				<td class="insurer_company"><input type="text" name="insurer_company" value="<?=$data['insurer_company']?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey insurer_position"><?=$this->getMark()?>Посада:</td>
				<td class="insurer_position"><input type="text" name="insurer_position" value="<?=$data['insurer_position']?>" maxlength="100" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0" class="insurer_activity">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Вид діяльності:</td>
				<td><input type="text" name="insurer_activity" value="<?=$data['insurer_activity']?>" maxlength="100" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">Заняття активними видами спорту (якщо так, то вкажіть вид  спорту):</td>
				<td><input type="text" name="insurer_sport" value="<?=$data['insurer_sport']?>" maxlength="100" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Область:</td>
				<td>
                    <?
                    echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data);
                    ?>
                </td>
				<td class="label grey">Район:</td>
				<td><input type="text" id="insurer_area" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Місто:</td>
				<td><input type="text" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Вулиця:</td>
				<td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false);
                    ?>
                </td>
				<td class="label grey"><?=$this->getMark()?>Будинок:</td>
				<td><input type="text" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="6" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">Квартира:</td>
				<td><input type="text" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Телефон:</td>
				<td><input type="text" id="insurer_phone" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">E-mail:</td>
				<td><input type="text" id="insurer_email" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>

			<div class="section">Існуючі Договори страхування від нещасних випадків:</div>
			<table id="agreements" cellpadding="5" cellspacing="0">
			<tr class="columns">
				<td width="250">Назва страхової компанії</td>
				<td width="250">Вид страхування</td>
				<td width="150">Страхова сума, грн.</td>
				<td width="120">Дата заключення</td>
				<td width="20" align="center"><?=($this->mode == 'update') ? '<a href="javascript:addAgreement()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" /></a>' : '&nbsp;'?></td>
			</tr>
			<?
				if (is_array($data['agreements'])) {
					foreach ($data['agreements'] as $i => $agreement) {
			?>
			<tr class="agreement<?=$i?>">
				<td><input type="text" name="agreements[<?=$i?>][company]" value="<?=$agreement['company']?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
				<td><input type="text" name="agreements[<?=$i?>][kind]" value="<?=$agreement['kind']?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
				<td><input type="text" name="agreements[<?=$i?>][price]" value="<?=$agreement['price']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
				<td>
					<input type="text" id="agreements_<?=$i?>_date" name="agreements[<?=$i?>][date]" value="<?=$agreement['date']?>" maxlength="10" class="fldDatePicker" onfocus="this.className='fldDatePickerOver'" onblur="this.className='fldDatePicker'" />
					<input type="hidden" id="agreements_<?=$i?>_date_day" name="agreements[<?=$i?>][date_day]" value="<?=$agreement['date_day']?>" />
					<input type="hidden" id="agreements_<?=$i?>_date_month" name="agreements[<?=$i?>][date_month]" value="<?=$agreement['date_month']?>" />
					<input type="hidden" id="agreements_<?=$i?>_date_year" name="agreements[<?=$i?>][date_year]" value="<?=$agreement['date_year']?>" />
				</td>
				<td align="center"><?=($this->mode == 'update') ? '<a href="javascript:deleteAgreement(' . $i . ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a>' : '&nbsp;'?></td>
			</tr>
			<?
					}
				}
			?>
			</table>

			<div class="section">Параметри полісу страхування:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<? if ($this->mode == 'view') {?>
				<td class="label grey">Номер полісу:</td>
				<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
				<td class="label grey"><?=$this->getMark()?>Дата заключення полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', '  ' . $this->getReadonly(true))?></td>
				<? } ?>
				<td class="label grey"><?=$this->getMark()?>Дата початку дії полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', ' ' . $this->getReadonly(true))?></td>
				<td class="label grey"><?=$this->getMark()?>Дата закінчення дії полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', ' style="color: #aca899; background-color: #f5f5f5;" disabled ' . $this->getReadonly(true))?></td>
			</tr>
			</table>

			<div class="section">Пiдписи:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Пiдпис полicа:</td>
				<td>
					<?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ], $data['sign_agents_id' ], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('sign_agents_id'));
                    ?>
					<? if (intval($data['documents'])==0 && $this->mode != 'update') {?>
					<? if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['roles_id']==ROLES_AGENT) {?><input type="button" value=" Змiнити " onclick="changeAgentSign();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><?}?>
						<? if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies_KASKO']['update']) {?>
						<input type="button" value=" Змiнити значення " onclick="changePolicyVals();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
						<?}?>
					<?}?>
				</td>
				<? if ($Authorization->data['service'] || $Authorization->data['reset'] || $data['service_person'] || $Authorization->data['id'] == 1 || $Authorization->data['permissions']['Policies_KASKO']['superupdate']) {//показываем только для тех полисов где есть сотрудник СТО или продажи идут с участием СТО ?>
				<td class="label grey"></td>
				<td><input type="hidden" id="service_person" name="service_person" value="<?=$data['service_person']?>" maxlength="70" class="fldText email<?=$this->isEqual('service_person')?>" onfocus="this.className='fldTextOver email<?=$this->isEqual('service_person')?>'" onblur="this.className='fldText email<?=$this->isEqual('service_person')?>'" /></td>
				<? if ($this->mode != 'update') {?><td><input type="button" value=" Перерахунок комiсiй " onclick="changeServicePerson();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /></td><? } ?>
				<? } ?>
			</tr>
			</table>

			<div class="section">Ідентифікація Заявника:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Я є фізичною особою-підприємцем:</td>
				<td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('fop') ], $data['fop'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fop'));
                    ?>
                </td>
				<td class="label grey fophide"><?=$this->getMark()?>Подаю виписку або витяг з Єдиного державного реєстру юридичних осіб та фізичних осіб - підприємців:</td>
				<td class="fophide">
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('give_a_statement') ], $data['give_a_statement'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fop'))
                    ?>
                </td>
			</tr>
			</table>	
			<table cellpadding="5" cellspacing="0" class="fophide">	
			<tr>
				<td class="label grey"><?=$this->getMark()?>Я є особою, яка обіймає посаду державного службовця, службовця<br />органу місцевого самоврядування першої або другої категорії, претендую<br />на зайняття чи займаю виборну посаду в органах влади та додаю<br />декларацію про майновий стан і доходи<br />(або податкову декларацію) встановленого зразка або заповнюю<br />додаток до цієї Заяви (якщо так, вказати «додаю» або «заповнюю»,<br />якщо не відноситесь до таких осіб, вказати «ні»).:</td>
				<td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('civil_servant') ], $data['civil_servant'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('civil_servant'));
                    ?>
                </td>
				<td class="label grey"><?=$this->getMark()?>Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий<br />стан відкритою та додаю податкову декларацію встановленого зразка<br />або заповнюю додаток до цієї Заяви добровільно<br />(якщо так, вказати «додаю» або «заповнюю»,<br />якщо вважаєте цю інформацію конфіденційною, вказати «ні»:</td>
				<td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('not_civil_servant') ], $data['not_civil_servant'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fop'))
                    ?>
                </td>
			</tr>
			<tr>
				<td class="label grey"><?=$this->getMark()?>Я є публічним діячем* або пов'язаною з ними особою** або особою,<br />що діє від його імені (якщо так, вказати відношення до публічного діяча, дані про<br />публічного діяча та додати офіційні документи, що дають можливість<br />з'ясувати джерела походження коштів і вказати назву та реквізити цих документів,<br />якщо не відноситесь до таких осіб, вказати «ні»):</td>
				<td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('public_figure') ], $data['public_figure'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('civil_servant'))
                    ?>
                </td>
				<td></td>
				<td></td>
			</tr>
			</table>

			<div class="section">Додатково:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Статус:</td>
				<td width=100>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], $this->getReadonly(true), null, $data)
                    ?>
                </td>
				<? if ($Authorization->data['service'] || $data['service_person']) {//показываем только для тех полисов где есть сотрудник СТО или продажи идут с участием СТО ?>
				<td class="label grey">Представник СТО:</td>
				<td><input type="text" id="service_person" name="service_person" value="<?=$data['service_person']?>" maxlength="70" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
				<? } ?>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey">Особливі умови:</td>
				<td width="100%"><textarea id="comment" name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
			</tr>
			</table>
			<?if (ereg('^view', $action) && ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR)) {?>
				<a style="color:red" href="JavaScript:loadFinProducts()">Завантажити продукти</a> |
				<span id="ins_products">
				</span>
				<script type="text/javascript">
					 
					function loadFinProducts() {
							$.ajax({
						type:       'POST',
						url:        'index.php',
						dataType:   'html',
						data:       'do=Policies|loadBankProductsInWindow' +
									'&product_types_id=' + getElementValue('product_types_id') +
									'&financial_institutions_id='+getElementValue('financial_institutions_id'),
							success: function(result) {
								document.getElementById('ins_products').innerHTML=result;
							}
						});
					}
					function setupProd() {
						$.ajax({
							type:       'POST',
							url:        'index.php',
							dataType:   'html',
							data:       'do=Policies|setupAllowedFinProdInWindow' +
										'&product_types_id=' + getElementValue('product_types_id') +
										'&allowed_product_id='+$('#allowed_ins_product_id').find(":selected").val()+
										'&id=<?=$data['id']?>',
								success: function(result) {
									alert(result);
								}
							});
					}
					 
				</script>
			<?}?>
		</td>
	</tr>
    </table>
</form>
<script>
<? if ($this->mode != 'view') {?>
	initPravex();
<?}?>
loadRisks()
</script>