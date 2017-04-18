<?

if ($_POST['ECmode']) {
    $data['ECmode'] = $_POST['ECmode'];
}

if (!$data['payment_brakedown_id']) {
    $data['payment_brakedown_id'] = 1;
}

if (!isset($data['agencies_id'])) {
    $data['agencies_id'] = $_SESSION['auth']['agencies_id'];
}

$max_cars = 25;

if (($Authorization->data['roles_id'] == ROLES_AGENT && $Authorization->data['agencies_id']==SELLER_AGENCIES_ID) || ($Authorization->data['roles_id'] != ROLES_AGENT && $data['agencies_id']==SELLER_AGENCIES_ID)) {
	$change_seller = true;
}

?>
<?
if ($this->mode != 'update') {
?>
<link rel="stylesheet" type="text/css" href="/css/jquery.fancybox-1.3.1.css" media="screen" />
<script type="text/javascript" src="/js/jquery/jquery.fancybox-1.3.1.pack.js"></script>	
<div style="display:none">
<div id="inlinecontent">
		<div align="right"> &nbsp;&nbsp; <a href="javascript:;" onclick="$.fancybox.close();">Закрыть</a><br><br></div>
		<div id="inlinecontent_inner"></div>
		
</div>
</div>
<?}?>

<script type="text/javascript">
var updatestr='';
<?if ($this->mode != 'update') {?>
function changeItemValue(itemid,fieldType,newitemvalue)
{
	$.fancybox.close();
	$('#'+itemid).val(newitemvalue);
	updatestr+='&'+$('#'+itemid).attr('name')+'='+newitemvalue;
}

$(document).ready(function() {

		$('.changeval').bind('click', function() {
			itemid = $(this).attr('itemid');
			fieldType= $(this).attr('fieldtype');
			itemval=$("#"+itemid+"").val();
			html = $(this).html();
			if (fieldType=='<?=fldText?>' || fieldType=='<?=fldDate?>')
			{
				document.getElementById('inlinecontent_inner').style.display = '';
				html+=' <input size="40" type="text" name="newitemvalue" id="newitemvalue" value="'+itemval+'">'
				html+='<br><br><div align=center><input type="button" value=" Змiнити " onclick="changeItemValue(\''+itemid+'\',\''+fieldType+'\',document.getElementById(\'newitemvalue\').value);" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" /></div>';
				$("#inlinecontent_inner").html(html);
			}
			
			
		});

	$(".changeval").fancybox({
		'modal'	:	true,
		'onComplete'	:	function() {
				
		}
	});
	
});
<?}?>
	driverStandingYears = 100;

    function setFlayerInfo()
    {
                if ($("#flayer").attr('checked'))
                 $('#flayerInfo').css('display', '');
                else
                 $('#flayerInfo').css('display', 'none');
    }

	function initLicenseDates() {
		$("input[id$='river_licence_date']" ).each(
				function(i, element) {
				$("#"+element.id+"").bind(
					'change',
					function() {
						setDriverStandingsId();
					}
				);
				}
			);
	}
		
	$(function() {
		initLicenseDates();
         $('#flayer').bind('click', function() {
           setFlayerInfo();
        });
        setFlayerInfo();
		$('#fop').bind('change',
						function() {setVisibility();}
					);
		setVisibility();		
	});	

	function setOwnerIdCard() {
    	if($('[name=owner_id_card]:checked').val() == 0) {
    		$('table#ownerfyz3').css('display', 'table');
    		$('table#owner_new_passport_table').css('display', 'none');
    	} else {
    		$('table#ownerfyz3').css('display', 'none');
    		$('table#owner_new_passport_table').css('display', 'table');
    	}

    }

    function setInsurerIdCard() {
    	if($('[name=insurer_id_card]:checked').val() == 0) {
    		$('table#insurerfyz3').css('display', 'table');
    		$('table#insurer_new_passport_table').css('display', 'none');
    	} else {
    		$('table#insurerfyz3').css('display', 'none');
    		$('table#insurer_new_passport_table').css('display', 'table');
    	}
    }

    $(function() {
    	setOwnerIdCard();
    	setInsurerIdCard();
    });

	
	function changeCompany()
	{
		return;
		companyId=getElementValue('insurance_companies_id');
		if (companyId==3)
			document.getElementById('card_assistance').style.display				= 'none';
		else
			document.getElementById('card_assistance').style.display				= '';
	}
	
	function setVisibility()
	{
		
		if ($('#fop').val()==1) 
		{
			$('.fophide').css('display', '');
		}
		else
		{
			$('.fophide').css('display', 'none');
			$('#give_a_statement').val(0);
			$('#civil_servant').val(0);
			$('#not_civil_servant').val(0);
			$('#public_figure').val(0);
		}
	}
	

	
	function setDriverStandingsId() {
		driverStandingYears = 100;

		$("input[id$='driver_licence_date']").each(
			function(i, element) {
				var day = $('#' + element.id + '_day').val();
				var month = $('#' + element.id + '_month').val();
				var year = $('#' + element.id + '_year').val();

				if (day.substring(0,1) == '0') {
					day = day.substring(1, 2);
				}

				if (month.substring(0,1) == '0') {
					month = month.substring(1, 2);
				}

				day		= parseInt(day);
				month	= parseInt(month);
				year	= parseInt(year);

				if (day > 0 && month > 0 && year > 0) {
					var d1 = new Date(year, month-1, day);
					var d2 = new Date();
					if (d2.getFullYear()-d1.getFullYear() < driverStandingYears) {
						driverStandingYears = d2.getFullYear()-d1.getFullYear();
						
						if (d2.getMonth()>d1.getMonth()) driverStandingYears++;
					}
				} else {
					driverStandingYears = 0;
				}
			}
		);

		if (driverStandingYears > 10) {
			$('#driver_standings_id option:[value=4]').attr('selected', 'selected');
		} else if (driverStandingYears > 3) {
			$('#driver_standings_id option:[value=3]').attr('selected', 'selected');
		} else if (driverStandingYears > 1) {
			$('#driver_standings_id option:[value=2]').attr('selected', 'selected');
		} else {
			$('#driver_standings_id option:[value=1]').attr('selected', 'selected');
		}
	}

    function changeDrivers() {

        var driver_ages = '<?=str_replace('\'', '\\\'', $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_ages_id') ], null))?>';
        var rows = document.getElementById('number_drivers').options[ document.getElementById('number_drivers').selectedIndex ].value - 1;

		if (rows == -1) {
			rows = 0;
		}

        document.getElementById('otherPersons').style.display = (rows==0) ? 'none' : 'block';

        while (document.getElementById('persons').rows.length / 2 > rows) {
            document.getElementById('persons').tBodies[0].deleteRow( document.getElementById('persons').rows.length - 1 );
        }

        var i = document.getElementById('persons').rows.length / 2;

        while (i < rows) {
            var row         = document.getElementById('persons').insertRow(document.getElementById('persons').rows.length);

            var cell        = row.insertCell(-1);
            cell.className  = 'label grey';
            cell.innerHTML  = '<?=$this->getMark(false)?>Прізвище:';
            var cell        = row.insertCell(-1);
            cell.innerHTML  = '<input type="text" id="persons' + i + 'lastname" name="persons[' + i + '][lastname]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" />';

            var cell        = row.insertCell(-1);
            cell.className  = 'label grey';
            cell.innerHTML  = '<?=$this->getMark(false)?>Ім\'я:';
            var cell        = row.insertCell(-1);
            cell.innerHTML  = '<input type="text" id="persons' + i + 'firstname" name="persons[' + i + '][firstname]" value="" maxlength="50" class="fldText firstname" onfocus="this.className=\'fldTextOver firstname\'" onblur="this.className=\'fldText firstname\'" />';

            var cell        = row.insertCell(-1);
            cell.className  = 'label grey';
            cell.innerHTML  = '<?=$this->getMark(false)?>По батькові:';
            var cell        = row.insertCell(-1);
            cell.innerHTML  = '<input type="text" id="persons' + i + 'patronymicname" name="persons[' + i + '][patronymicname]" value="" maxlength="50" class="fldText patronymicname" onfocus="this.className=\'fldTextOver patronymicname\'" onblur="this.className=\'fldText patronymicname\'" />';

            var row         = document.getElementById('persons').insertRow(document.getElementById('persons').rows.length);

            var cell        = row.insertCell(-1);
            cell.className  = 'label grey expressproduct';
            cell.innerHTML  = '<?=$this->getMark(false)?>Вік:';
            var cell        = row.insertCell(-1);
			cell.className  = 'expressproduct';
            cell.innerHTML  = driver_ages.replace(/driver_ages_id/g, 'persons[' + i + '][driver_ages_id]');

            var cell        = row.insertCell(-1);
            cell.className  = 'label grey expressproduct';
            cell.innerHTML  = '<?=$this->getMark(false)?>Водійські права, серія, номер і дата:';

            var cell        = row.insertCell(-1);
			cell.className  = 'expressproduct';
            cell.innerHTML  = '<input type="text" id="persons' + i + 'driver_licence_series" name="persons[' + i + '][driver_licence_series]" value="" maxlength="4" class="fldText series" onfocus="this.className=\'fldTextOver series\'" onblur="this.className=\'fldText series\'" /> <input type="text" id="persons' + i + 'driver_licence_number" name="persons[' + i + '][driver_licence_number]" value="" maxlength="9" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" />';

            var cell        = row.insertCell(-1);
			cell.className  = 'expressproduct';
            cell.innerHTML  = '<input type="text" id="persons' + i + 'driver_licence_date" name="persons[' + i + '][driver_licence_date]" maxlength="10" class="fldDatePicker" onfocus="this.className=\'fldDatePickerOver\'" onblur="this.className=\'fldDatePicker\'" /><input type="hidden" id="persons' + i + 'driver_licence_date_day" name="persons[' + i + '][driver_licence_date_day]" /><input type="hidden" id="persons' + i + 'driver_licence_date_month" name="persons[' + i + '][driver_licence_date_month]" /><input type="hidden" id="persons' + i + 'driver_licence_date_year" name="persons[' + i + '][driver_licence_date_year]" />';

            var cell        = row.insertCell(-1);
			initLicenseDates();
            i++;
        }

		initDatePicker();
		<? if ($this->mode != 'view') {?>
		setDriverStandingsId();
		<?}?>
    }

    function setDriversId() {
        switch (document.getElementById('number_drivers').options[ document.getElementById('number_drivers').selectedIndex ].value) {
            case '1':
                value = 4;
                break;
            case '2':
                value = 5;
                break;
            case '3':
                value = 6;
                break;
            case '4':
            case '5':
                value = 99;
                break;
            case '0':
                value = 7;
                break;
        }

        document.getElementById('drivers_id').value = value;

		var label = $('#insurerDriverLicenceLabel').html();
		label = label.replace('<?=$this->getMark(false)?>', '');

		if (value != 7) {
			$('#standingsBlock').css('display', 'block');
			$('#insurerDriverLicenceLabel').html( '<?=$this->getMark(false)?>' + label );
		} else {
			$('#standingsBlock').css('display', 'none');
			$('#insurerDriverLicenceLabel').html( label );
		}
		
<? if ($this->mode != 'view') {?>
        changeDrivers();
		setExpressProductVisibility();
<?}?>
    }

	function showDestinationBlock() {
		if (parseInt(getElementValue('options_race')) > 0) {
			$('.destinationBlock').css('display', '');
		} else {	
			$('.destinationBlock').css('display', 'none');
		}
	}	

    function changePersonType() {
        var person_types_id = getElementValue('person_types_id');
		var financial_institutions_id = getElementValue('financial_institutions_id');

		switch (getElementValue('owner_person_types_id')) {
			case '2':
				document.getElementById('cars_count').disabled = <?=($this->mode == 'update') ? 'false' : 'true'?>;
				display = 'none';
				document.getElementById('ownerJurpersonBlock').style.display = '';
				document.getElementById('owner_positionBlock1').style.display = '';
				document.getElementById('owner_positionBlock2').style.display ='';
				document.getElementById('owner_positionBlock3').style.display = '';
				document.getElementById('owner_positionBlock4').style.display ='';
				document.getElementById('options_workers_listBlock').style.display ='';

				document.getElementById('owner_id_card_table').style.display = 'none';
				document.getElementById('owner_new_passport_table').style.display = 'none';
				//document.getElementById('number_drivers').value = '0';

				setDriversId();
				break;
			default:
				display =  '';
				document.getElementById('ownerJurpersonBlock').style.display = 'none';
				document.getElementById('owner_positionBlock1').style.display = 'none';
				document.getElementById('owner_positionBlock2').style.display ='none';
				document.getElementById('owner_positionBlock3').style.display = 'none';
				document.getElementById('owner_positionBlock4').style.display ='none';
				document.getElementById('options_workers_listBlock').style.display ='none';
				document.getElementById('cars_count').disabled = true;
				document.getElementById('cars_count').selectedIndex = 0;

				document.getElementById('owner_id_card_table').style.display = '';
				document.getElementById('owner_new_passport_table').style.display = '';


				setCarsCount();
		}

		for (i=1; i<=4; i++) {
            document.getElementById('ownerfyz'+i).style.display = display;
        }

		switch (getElementValue('insurer_person_types_id')) {
			case '2':
				document.getElementById('cars_count').disabled = <?=($this->mode == 'update') ? 'false' : 'true'?>;
				display = 'none';
				document.getElementById('insurerJurpersonBlock').style.display = '';
				document.getElementById('insurerJurpersonBlock1').style.display = '';
				document.getElementById('insurer_positionBlock1').style.display = '';
				document.getElementById('insurer_positionBlock2').style.display ='';
				document.getElementById('insurer_positionBlock3').style.display = '';
				document.getElementById('insurer_positionBlock4').style.display ='';

				document.getElementById('insurer_id_card_table').style.display ='none';
				document.getElementById('insurer_new_passport_table').style.display = 'none';


				//setDriversId();
				break;
			default:
				display =  '';
				document.getElementById('insurerJurpersonBlock').style.display = 'none';
				document.getElementById('insurerJurpersonBlock1').style.display = 'none';
				document.getElementById('insurer_positionBlock1').style.display = 'none';
				document.getElementById('insurer_positionBlock2').style.display ='none';
				document.getElementById('insurer_positionBlock3').style.display = 'none';
				document.getElementById('insurer_positionBlock4').style.display ='none';
				document.getElementById('cars_count').disabled = true;
				document.getElementById('cars_count').selectedIndex = 0;

				document.getElementById('insurer_id_card_table').style.display ='';
				document.getElementById('insurer_new_passport_table').style.display = '';

				setCarsCount();
		}
		for (i=1; i<=3; i++) {
            document.getElementById('insurerfyz'+i).style.display = display;
        }
		setRates(true); 

		var express_products_id=parseInt(getElementValue('express_products_id'));
		if (express_products_id==110 || express_products_id==138 || express_products_id == 686 || express_products_id == 753) express_products_id = 0;
		
		if (express_products_id>0 || express_products_id=='') {
			if (express_products_id >0 && (financial_institutions_id==0 || financial_institutions_id=='')) {
				display = 'none';
			}	
			document.getElementById('driversCount1').style.display = document.getElementById('driversCount2').style.display = display;
		}
		
       setOwnerIdCard();
       setInsurerIdCard();
       
    }

    function changeCity() {
        document.getElementById('registration_cities_title').style.display = (getElementValue('registration_cities_id') == <?=CITIES_OTHER?>)
            ? 'block'
			: 'none';
    }

    function clearProductsBlocks() {
		$('div[id^=\'products\']').html('');
		<?if ($this->options['options_fifty_fifty']) {?>
        if(getElementValue('terms_id') == '29'){
            document.getElementById('options_fifty_fifty').disabled = false;
        }else{
            document.getElementById('options_fifty_fifty').disabled = true;
        }
		<?}?>
	}

    function setOptionsBlock() {
		var financial_institutions_id = getElementValue('financial_institutions_id');
        if (financial_institutions_id > 0) {
			if (financial_institutions_id==41) document.getElementById('options_agregate_no').disabled			= false; //ПАТ "ФОЛЬКСБАНК" костыль
           // document.getElementById('options_years').disabled				= true;
        } else {
            document.getElementById('options_deterioration_no').disabled		= false;
            document.getElementById('options_agregate_no').disabled			= false;
           // document.getElementById('options_years').disabled				= true;
        }
    }

	function setDeterioration() {//всегда без износа для Банкам КИПРУ и Финансы и Кредит 
		var financial_institutions_id = getElementValue('financial_institutions_id');
		if (financial_institutions_id==43 || financial_institutions_id==50 <?if ($Authorization->data['top_agencies_id'] == 847 || $Authorization->data['top_agencies_id'] == 1469) {?>|| financial_institutions_id==46<?}?>)
		{
			$("input[name=options_deterioration_no]").attr('checked', 'checked');
		}
		
	}
	 
	
    function changeFinancialInstitution() {
		
		setTermsYears();
		clearProductsBlocks();
		setRetail();
		
        var financial_institutions_id_old = <?=intval($data['financial_institutions_id'])?>;
        var financial_institutions_id = getElementValue('financial_institutions_id');
		
		setFiftyFiftyLabel();
		
		show500Block();
		
		if (financial_institutions_id!=2) //если не альфабанк то запретить
		{
			//если пролонгация запретить смену выгодоприобретателя без котирования
			if (parseInt(getElementValue('states_id'))>0 && financial_institutions_id_old>0 &&  financial_institutions_id_old!=financial_institutions_id && parseInt(getElementValue('types_id'))!=2)
			{
				$('#financial_institutions_id').val(financial_institutions_id_old);
				alert('Заборонена змiна Вигодонабувача, необхiдно перейти у режим Котирування');
				return false;
			}
		}
		
        if (financial_institutions_id > 0) {
            document.getElementById('additionalConditions').style.display	= 'none';
            document.getElementById('priority_payments_id').selectedIndex		= 1;
            document.getElementById('risksBlock').style.display				= 'none';
            document.getElementById('assuredBlock').style.display			= 'none';
            document.getElementById('agreementsBlock').style.display		= (financial_institutions_id == <?=FINANCIAL_INSTITUTIONS_UKRAUTOLEASING?>) ? 'none' : 'block';

			$('input[type=checkbox][name^=risks]').attr('checked', 'checked');

            //document.getElementById('options_deterioration_no').checked		= false;
            document.getElementById('options_deductible_glass_no').checked 	= false;

            document.getElementById('options_agregate_no').checked 			= false;
			if (financial_institutions_id==41) document.getElementById('options_agregate_no').checked 			= true; //ПАТ "ФОЛЬКСБАНК" костыль
	
            document.getElementById('assured').checked						= false;

			$('td[class=financialInstitutionCommission]').attr('display', 'block');
			
        } else {
            <?=$this->options['options_fifty_fifty'] ? "document.getElementById('options_fifty_fifty').disabled = false;" : ''?>
			<?=$this->options['options_month500'] ? "document.getElementById('options_500Block').style.display	= 'block';" :'';?>
            document.getElementById('additionalConditions').style.display	= 'block';
            document.getElementById('risksBlock').style.display				= 'block';
            document.getElementById('assuredBlock').style.display			= 'block';
            document.getElementById('agreementsBlock').style.display		= 'none';
            document.getElementById('optionsBlock').style.display			= 'block';

			$('td[class=financialInstitutionCommission]').attr('display', 'none');
			
        }
		changeExpressProduct();
        <? if ($this->mode != 'view') echo 'setOptionsBlock();'?>
		setDeterioration();
    }

    num = -1;
    function addEquipment(obj, items_id) {
        var row = document.getElementById('equipment'+items_id).insertRow(-1);

        var cell = row.insertCell(0);
        cell.innerHTML	= '<input type="text" name="items['+items_id+'][equipment][' + num + '][title]" value="" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" />';

        cell = row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="items['+items_id+'][equipment][' + num + '][brand]" value="" maxlength="20" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" />';

        cell = row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="items['+items_id+'][equipment][' + num + '][model]" value="" maxlength="20" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" />';

        cell = row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="items['+items_id+'][equipment][' + num + '][price]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" onchange="changeAmountEquipment('+items_id+')" title="items'+items_id+'EquipmentPrice" />';


        cell = row.insertCell(-1);
        cell.innerHTML	= '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteEquipment(this,' + items_id + ')" />';

        num--;
    }

    function deleteEquipment(obj, items_id) {
        if (confirm('Ви дійсно бажаєте вилучити вибране додаткове обладнання?')) {
            document.getElementById('equipment' + items_id).deleteRow( obj.parentNode.parentNode.sectionRowIndex);
            setRate(items_id);
        }
    }

    function getPriceEquipmentItem(items_id) {
		var result = 0;

		$('input[title=\'items' + items_id + 'EquipmentPrice\']').each(function () {
			result += parseFloat($(this).val());
		});

		return getRateFormat(result);
    }

    function changeAmountEquipment(items_id) {
		var price	= getRateFormat(getPriceEquipmentItem(items_id));
		var rate	= ($('#items' + items_id + 'rate_equipment').val()) ? getRateFormat($('#items' + items_id + 'rate_equipment').val()) : getRateFormat(0);
		$('#items' + items_id + 'rate_equipment').val(rate);
        $('#items' + items_id + 'amount_equipment').val( getRateFormat(price * rate / 100) );

		changeAmountItem(items_id);
    }

	function changeAmountAccident(items_id) {
		/*var price	= ($('#items' + items_id + 'price_accident').val()) ? getRateFormat($('#items' + items_id + 'price_accident').val()) : getRateFormat(0);
		var rate	= ($('#items' + items_id + 'rate_accident').val()) ? getRateFormat($('#items' + items_id + 'rate_accident').val(),5) : getRateFormat(0);

		$('#items' + items_id + 'price_accident').val(price);
		$('#items' + items_id + 'rate_accident').val(rate);

        $('#items' + items_id + 'amount_accident').val( getRateFormat(price * rate / 100) );
		*/
		changeAmountItem(items_id);
	}

    function getDeductiblesId(items_id) {
        return $('input[id=items' + items_id + 'deductibles_id]:checked').val();
    }

	function getAmountItem(items_id) {
		var amount_kasko = ($('#items' + items_id + 'amount_kasko').val()) ? $('#items' + items_id + 'amount_kasko').val() : 0;
		var amount_equipment = ($('#items' + items_id + 'amount_equipment').val()) ? $('#items' + items_id + 'amount_equipment').val() : 0;
		var amount_accident = 0;//($('#items' + items_id + 'amount_accident').val()) ? $('#items' + items_id + 'amount_accident').val() : 0;
		var express_products_id = $('#express_products_id option:selected').val();
		var items0car_price= $('#items0car_price').val();
		var amount_season = 0;
		if (express_products_id == '138') amount_season = parseFloat(items0car_price)*0.1/100;
		
		return parseFloat(amount_kasko) + parseFloat(amount_equipment) + parseFloat(amount_accident) + amount_season;
	}

	function getAmount() {
		var result = 0;

		$('input[title=\'itemsAmount\']').each(function () {
			if (parseFloat($(this).val()) >= 0) {
			
				result += parseFloat($(this).val());
			}
		});

        $('#certificateInfo').css('display', 'none');

        express_products_id = $('#express_products_id option:selected').val();
        terms_id = $('#terms_id option:selected').val();
        financial_institutions_id = $('#financial_institutions_id option:selected').val();
        items0car_types_id = $('#items0car_types_id option:selected').val();
		items0car_price= $('#items0car_price').val();
		var certificate = getElementValue('certificate');
        if ( certificate != '' && items0car_types_id == '8' &&
              express_products_id != '140' && terms_id == '29' && certificate.length==8) {
                //result -= 500;
                $('#certificateInfo').css('display', 'block');
        } else {
            $('input[name=certificate]').val('');
        }

    	return result;
	}

	function changeAmount() {
        document.getElementById('amount').innerHTML = getMoneyFormat( getAmount() );
	}

	function changeAmountItem(items_id) {
		$('#items' + items_id + 'amount').val( getRateFormat(getAmountItem(items_id)) );
		changeAmount();
	}

	function setPaymentBrakedowns() {
		<? if ($this->subMode == 'calculate') {?>
		if ($("#options_month500").attr('checked')) return;
		var payment_brakedown_id = $('input[type=radio][name=payment_brakedown_id]:checked').val();

		var paymentBrakedowns = new Array(false, false, false);
		
		$('input[title=\'deductibles_id\']:checked').each(function () {

			values = $('#' + $(this).attr('id').replace('deductibles_id', 'paymentBrakedown' + $(this).val()) ).val().split(';');

			for (var i=0; i < values.length; i++) {
				value = values[ i ].split('|');
				paymentBrakedowns[ value[0] - 1 ] = (parseFloat(value[ 1 ]) > 0) ? true : false;
			}
		});

		//закрываем все
		$('input[type=radio][name=payment_brakedown_id]').attr('checked', false);
		$('input[type=radio][name=payment_brakedown_id]').attr('disabled', true);

		if (!paymentBrakedowns[ payment_brakedown_id - 1 ]) {
			payment_brakedown_id = 1;//единоразовый платеж
		}

		for (var i=1; i <= paymentBrakedowns.length; i++) {
			$('input[type=radio][name=payment_brakedown_id][value=' + i + ']').attr('disabled', !paymentBrakedowns[ i - 1 ]);
		}

		$('input[type=radio][name=payment_brakedown_id][value=' + payment_brakedown_id + ']').attr('checked', true);
		<? } ?>
	}

	function getPaymentBrakedownValue(items_id, deductibles_id) {
		var result = 0;

        var values = document.getElementById('items' + items_id + 'paymentBrakedown' + deductibles_id).value.split(';');
		var payment_brakedown_id = $('input[type=radio][name=payment_brakedown_id]:checked').val();

		for (var i=0; i<values.length;i++) {
			value = values[ i ].split('|');

			if (payment_brakedown_id == value[ 0 ]) {
				result = parseFloat(value[ 1 ]);
			}
		}
		if ($("#options_month500").attr('checked')) return 1;//не применяеться для опции 500
        return result;
	}

	function setDiscountCardCarManWoman() {
		$('td[title=\'cart_discount\']').each(function () {
			if ($('#cart_discount').attr('checked')) {
				$(this).css('display', '');
			} else {
//				$(this).css('display', 'none');
			}
		});
	}

	function setCartDiscount(cart_discount) {
		$('#cart_discount').val(cart_discount);

		if (cart_discount == 0) {
//			$('#cart_discount').attr('checked', false);
//			$('#cart_discount').attr('disabled', true);
		} else {
			$('#cart_discount').attr('disabled', false);
		}
		
		setDiscountCardCarManWoman();
    }

    function setDiscount(data) {
	<? if ($this->mode != 'view') { ?>
        var discount = document.getElementById('discount');

        var discountPercent	= parseInt(discount.options[ discount.selectedIndex ].value);
        var curmaxDiscount	= parseInt(discount.options[ discount.options.length - 1].value);
		var maxDiscount		= parseInt(data.discount);

        if (curmaxDiscount != maxDiscount) {
            discount.options.length = 0;

            for (var k=0; k <= maxDiscount; k++) {
                discount.options[ discount.options.length ] = new Option(k + '.00', k + '.00');
                if (k == discountPercent) {
                    discount.selectedIndex = k;
                }
            }
        }
		setCartDiscount(parseInt(data.cart_discount));
	<?}?>	
    }
	
	function changeDiscount() {
		var products_id = '';

		$('input[title=\'products_id\']').each(function () {
			if ($(this).val()) {
				products_id += '&products_id[]=' + $(this).val();
			}
		});

		$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'json',
			async:		false,
            data:       'do=Products|getDiscountInWindow' +
                        products_id +
                        '&date=' + $('#date_year').val() + '-' + $('#date_month').val() + '-' + $('#date_day').val() +
                        '&agencies_id=<?=$data['agencies_id']?>' +
						'&states_id='+$('#states_id').val() +
						'&financial_institutions_id=' + $('#financial_institutions_id option:selected').val() +
						'&agreement_types_id='+$('#agreement_types_id').val() +
						'&card_car_man_woman=' + $('#card_car_man_woman').val(),
			success: setDiscount});
	}

	<? if ($data['showCommission']) { ?>
	function changeCommissions(items_id, discount) {
		$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Products|getCommissionsInWindow' +
                        '&products_id=' + $('#items' + items_id + 'products_id' + getDeductiblesId(items_id)).val() +
                        '&date=' + $('#date_year').val() + '-' + $('#date_month').val() + '-' + $('#date_day').val() +
                        '&agencies_id=<?=$data['agencies_id']?>' +
						'&financial_institutions_id=' + $('#financial_institutions_id option:selected').val() +
						'&discount=' + discount,
			success: function(result) {
				$('input[name=\'items[' + items_id + '][commission_agency_percent]\']').val(getRateFormat(result.commission_agency_percent));
				$('input[name=\'items[' + items_id + '][commission_agent_percent]\']').val(getRateFormat(result.commission_agent_percent));
			}
		});
	}
	<? } ?>

	function changeAmountKASKO(items_id) {
		$('#items' + items_id + 'amount_kasko').val( getRateFormat($('#items' + items_id + 'rate_kasko').val() * $('#items' + items_id + 'car_price').val() / 100) );

		changeAmountItem(items_id);
	}
<? if ($this->mode != 'view') {?>
	function certificateTenPercentProcess(data) {

		var express_products_id = $('#express_products_id option:selected').val();

		if (express_products_id != 673) {
			return;
		}

		if (data == undefined) {

			var _certificateNumber = $("input[name=certificateTenPercent]").val();
			var _state = true;
			if (_certificateNumber.length != 4) {
				alert("Номер сертифiкату знижка 'КАСКО 10%' повинен містити 4 символи");
				_state = false;
			} else if (parseInt(_certificateNumber) < 1 || parseInt(_certificateNumber) > 1300) {
				alert("Номер сертифiкату знижка 'КАСКО 10%' повинен знаходитись в діапазоні '0001' - '1300'");
				_state = false;
			}

			if (!_state) {
				return;
			}

			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Policies|checkCertificateTenPercentInWindow' +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&certificateTenPercent=' + _certificateNumber +
							'&policies_id=<?=intval($data["id"])?>',
				success:    function(result) {
								certificateTenPercentProcess(result);
							},
				error: 		function(result) {
					alert("System error");
				}
			});
		} else {

			if (!data.check) {
				alert("Номер сертифiкату знижка 'КАСКО 10%' уже використано");
				return;
			}

			cars_count = parseInt(getElementValue('cars_count'));
        	for (var i=0; i<cars_count; i++) {
            	setRate(i);
        	}

		}

	}
<? } ?>
    function setRate(items_id) {
		set500Block();
        var deductibles_id = getDeductiblesId(items_id);
console.log(deductibles_id);
		if (!deductibles_id) {
			return;
		}
		var info = $('#items' + items_id + 'info' + deductibles_id).val();
console.log("deductibles_id");
		
		$('#infoDocumentDescription').html(info);
		$('#document_info').val(info);
		if (parseFloat($('#items' + items_id + 'rate_equipment' + deductibles_id).val()) == 0) {
			if (document.getElementById('equipment' + items_id).rows.length > 1 && confirm('Обрана Вами програма страхування не передбачає страхування додаткового обладнання. Продовжити?')) {
				while (document.getElementById('equipment' + items_id).rows.length > 1) {
					document.getElementById('equipment' + items_id).deleteRow( document.getElementById('equipment' + items_id).rows.length - 1 );
				}
			} else {
				//document.getElementById('items' + items_id + 'deductibles_id').checked = false;
			}
		}

		$('#items' + items_id + 'products_id').val( $('#items' + items_id + 'products_id' + deductibles_id).val() );

		$('#items' + items_id + 'deductibles_value0').val( $('#items' + items_id + 'deductiblesOther' + deductibles_id).val() );
		switch ($('#items' + items_id + 'deductiblesOtherAbsolute' + deductibles_id).val()) {
			case '0'://риск в %
				$('#items' + items_id + 'deductibles_absolute0Percent').attr('checked', true);
				break;
			case '1'://риск в грн.
				$('#items' + items_id + 'deductibles_absolute0Amount').attr('checked', true);
				break;
		}

		$('#items' + items_id + 'deductibles_value1').val( $('#items' + items_id + 'deductiblesHijacking' + deductibles_id).val() );
		switch ($('#items' + items_id + 'deductiblesHijackingAbsolute' + deductibles_id).val()) {
			case '0'://риск в %
				$('#items' + items_id + 'deductibles_absolute1Percent').attr('checked', true);
				break;
			case '1'://риск в грн.
				$('#items' + items_id + 'deductibles_absolute1Amount').attr('checked', true);
				break;
		}

		changeDiscount();
		setPaymentBrakedowns();

		var discount = parseFloat($('#discount option:selected').val());
		var cart_discount = ($('#cart_discount').attr('checked')) ? parseFloat($('#cart_discount').val()) : 0;
		var bonus_malus = parseFloat($('#bonus_malus').val());
		var financial_institutions_id = getElementValue('financial_institutions_id');
		var _certificateNumber = $("input[name=certificateTenPercent]").val();

		var rkasko = parseFloat($('#items' + items_id + 'rate_kasko' + deductibles_id).val()) * getPaymentBrakedownValue(items_id, deductibles_id) ;//* (100  - discount-  cart_discount) / 100 *bonus_malus
		 
		
		
		var certificate = $('input[name=certificate]').val();
		var express_products_id = $('#express_products_id option:selected').val();
		var terms_id = $('#terms_id option:selected').val();
		var items0car_types_id = $('#items0car_types_id option:selected').val();

console.log(express_products_id);		
console.log(_certificateNumber);
		if ( certificate != '' && items0car_types_id == '8' &&
            express_products_id != '140' && terms_id == '29' && certificate.length==8) {
			//уменьшаем на 500грн
			var cprice = parseFloat($('#items' + items_id + 'car_price').val());
			var new_amount_kasko = cprice*rkasko/100-500;
			rkasko = 100 * new_amount_kasko/cprice;
		} else if (_certificateNumber != '' && express_products_id == 673 && _certificateNumber.length == 4) {
			var cprice = parseFloat($('#items' + items_id + 'car_price').val());
			var new_amount_kasko = 0.9 * cprice*rkasko/100;
			console.log(rkasko);
			rkasko = 100 * new_amount_kasko/cprice;
			console.log(new_amount_kasko);
			console.log(rkasko);
		} else {
			$('input[name=certificate]').val('');
			$("input[name=certificateTenPercent]").val('');
		}
		
		$('#items' + items_id + 'rate_kasko').val( getRateFormat( rkasko, 3) );		
		$('#items' + items_id + 'rate_equipment').val( getRateFormat( parseFloat($('#items' + items_id + 'rate_equipment' + deductibles_id).val())* getPaymentBrakedownValue(items_id, deductibles_id) ,3));

		if ($('#financial_institutions_id').val()!=19 && $('#financial_institutions_id').val()!=52) {
			//$('#items' + items_id + 'price_accident').val( getRateFormat( parseFloat($('#items' + items_id + 'price_accident' + deductibles_id).val())) );
			//$('#items' + items_id + 'rate_accident').val( getRateFormat( parseFloat($('#items' + items_id + 'rate_accident' + deductibles_id).val()) * bonus_malus,3) );
		}
        //if (parseInt($('#express_products_id').val())>0)
            //$('#items' + items_id + 'rate_accident').val(  parseFloat($('#items' + items_id + 'rate_accident' + deductibles_id).val()) );
		changeAmountKASKO(items_id);
		changeAmountEquipment(items_id);
		changeAmountAccident(items_id);
		<? if ($data['showCommission']) { ?>
		changeCommissions(items_id, discount);
		<? } ?>
    }

    function setRates(discount) {

		if (discount) {
			changeDiscount();
		} else {
			setDiscountCardCarManWoman();
		}

        cars_count = parseInt(getElementValue('cars_count'));
        for (var i=0; i<cars_count; i++) {
            setRate(i);
        }
    }

    function setSelect(from, to) {
        var to = document.getElementById(to);
        var fromValue = getElementValue(from);

        for (i=0; i < to.options.length; i++) {
            if (fromValue == to.options[ i ].value) {
                to.selectedIndex = i;
                break;
            }
        }
    }

	
    function setInsurer(obj) {
        if (obj.checked) {
            document.<?=$this->objectTitle?>.insurer_lastname.value				= getElementValue('owner_lastname');
            document.<?=$this->objectTitle?>.insurer_firstname.value				= getElementValue('owner_firstname');
            document.<?=$this->objectTitle?>.insurer_patronymicname.value		= getElementValue('owner_patronymicname');

            document.<?=$this->objectTitle?>.insurer_dateofbirth.value			= document.<?=$this->objectTitle?>.owner_dateofbirth.value;
            document.<?=$this->objectTitle?>.insurer_dateofbirth_day.value		= document.<?=$this->objectTitle?>.owner_dateofbirth_day.value;
            document.<?=$this->objectTitle?>.insurer_dateofbirth_month.value		= document.<?=$this->objectTitle?>.owner_dateofbirth_month.value;
            document.<?=$this->objectTitle?>.insurer_dateofbirth_year.value		= document.<?=$this->objectTitle?>.owner_dateofbirth_year.value;

            document.<?=$this->objectTitle?>.insurer_passport_series.value		= getElementValue('owner_passport_series');
            document.<?=$this->objectTitle?>.insurer_passport_number.value		= getElementValue('owner_passport_number');
            document.<?=$this->objectTitle?>.insurer_passport_place.value			= getElementValue('owner_passport_place');

            document.<?=$this->objectTitle?>.insurer_passport_date.value			= document.<?=$this->objectTitle?>.owner_passport_date.value;
            document.<?=$this->objectTitle?>.insurer_passport_date_day.value		= document.<?=$this->objectTitle?>.owner_passport_date_day.value;
            document.<?=$this->objectTitle?>.insurer_passport_date_month.value		= document.<?=$this->objectTitle?>.owner_passport_date_month.value;
            document.<?=$this->objectTitle?>.insurer_passport_date_year.value		= document.<?=$this->objectTitle?>.owner_passport_date_year.value;

            document.<?=$this->objectTitle?>.insurer_dateofbirth.value			= document.<?=$this->objectTitle?>.owner_dateofbirth.value;
            document.<?=$this->objectTitle?>.insurer_dateofbirth_day.value		= document.<?=$this->objectTitle?>.owner_dateofbirth_day.value;
            document.<?=$this->objectTitle?>.insurer_dateofbirth_month.value		= document.<?=$this->objectTitle?>.owner_dateofbirth_month.value;
            document.<?=$this->objectTitle?>.insurer_dateofbirth_year.value		= document.<?=$this->objectTitle?>.owner_dateofbirth_year.value;

            document.<?=$this->objectTitle?>.insurer_phone.value					= getElementValue('owner_phone');
            document.<?=$this->objectTitle?>.insurer_email.value					= getElementValue('owner_email');
			
			document.<?=$this->objectTitle?>.insurer_company.value				= getElementValue('owner_company');
			document.<?=$this->objectTitle?>.insurer_edrpou.value				= getElementValue('owner_edrpou');
			document.<?=$this->objectTitle?>.insurer_bank.value					= getElementValue('owner_bank');
			document.<?=$this->objectTitle?>.insurer_bank_mfo.value				= getElementValue('insurer_bank_mfo');
			document.<?=$this->objectTitle?>.insurer_bank_account.value			= getElementValue('owner_bank_account');
			document.<?=$this->objectTitle?>.insurer_area.value					= getElementValue('owner_area');
			
			document.<?=$this->objectTitle?>.insurer_bank_mfo.value					= getElementValue('owner_bank_mfo');
			document.<?=$this->objectTitle?>.insurer_position.value					= getElementValue('owner_position');
			document.<?=$this->objectTitle?>.insurer_ground.value					= getElementValue('owner_ground');

            document.<?=$this->objectTitle?>.insurer_city.value                  = getElementValue('owner_city');
            document.<?=$this->objectTitle?>.insurer_street.value                = getElementValue('owner_street');
            document.<?=$this->objectTitle?>.insurer_house.value                 = getElementValue('owner_house');
            document.<?=$this->objectTitle?>.insurer_flat.value                  = getElementValue('owner_flat');
            document.<?=$this->objectTitle?>.insurer_identification_code.value    = getElementValue('owner_identification_code');

            //Новый пасспорт
            $('input[name=owner_id_card]:checked').each(function() {
            	$('input[name=insurer_id_card][value='+this.value+']').click();
            });
            document.<?=$this->objectTitle?>.insurer_newpassport_number.value			= getElementValue('owner_newpassport_number');
            document.<?=$this->objectTitle?>.insurer_newpassport_place.value			= getElementValue('owner_newpassport_place');
            document.<?=$this->objectTitle?>.insurer_newpassport_reestr.value			= getElementValue('owner_newpassport_reestr');

            document.<?=$this->objectTitle?>.insurer_newpassport_date.value				= getElementValue('owner_newpassport_date');
            document.<?=$this->objectTitle?>.insurer_newpassport_date_day.value			= getElementValue('owner_newpassport_date_day');
            document.<?=$this->objectTitle?>.insurer_newpassport_date_month.value		= getElementValue('owner_newpassport_date_month');
            document.<?=$this->objectTitle?>.insurer_newpassport_date_year.value		= getElementValue('owner_newpassport_date_year');

            document.<?=$this->objectTitle?>.insurer_newpassport_dateEnd.value			= getElementValue('owner_newpassport_dateEnd');
            document.<?=$this->objectTitle?>.insurer_newpassport_dateEnd_day.value		= getElementValue('owner_newpassport_dateEnd_day');
            document.<?=$this->objectTitle?>.insurer_newpassport_dateEnd_month.value	= getElementValue('owner_newpassport_dateEnd_month');
            document.<?=$this->objectTitle?>.insurer_newpassport_dateEnd_year.value		= getElementValue('owner_newpassport_dateEnd_year');
            //

            setSelectValues('owner_regions_id', 'insurer_regions_id');
			setSelectValues('owner_street_types_id', 'insurer_street_types_id');
			setSelectValues('owner_person_types_id', 'insurer_person_types_id');
			
        }
		changePersonType();
		
    }

    function getProductsBlock(items_id, deductibles_id) {

		set500Block();
	
        document.getElementById('products' + items_id).innerHTML = '';
		/*if (parseInt(getElementValue('options_race')) > 0) {
			alert('Використання опцiї Перегон можливо лише у режимі котирування');
			return;
		}*/
		
		if (getElementValue('driver_standings_id') == 0 && getElementValue('drivers_id')!=7) {
			alert('Необхідно вибрати "Мінімальний водійський стаж з усіх, хто буде керувати автомобілем"!');
		} 
		else if (getElementValue('insurance_companies_id') == 0) {
			alert('Необхідно вибрати Страхову компанiю');
		}
		
		else if (getElementValue('items' + items_id + 'car_types_id') == 0) {
			alert('Необхідно вибрати тип ТЗ');
		} else if (getElementValue('items' + items_id + 'year') == 0) {
			alert('Необхідно заповнити рiк випуску ТЗ');
		} else if (getElementValue('drivers_id') == 0) {
			alert('Необходно вибрати "Кількість осіб"!');
		} else if (getElementValue('owner_person_types_id') == 0 || getElementValue('insurer_person_types_id') == 0) {
			if (getElementValue('owner_person_types_id') == 0)
				alert('Необходно вибрати Тип особи Власника!');
			else
				alert('Необходно вибрати Тип особи Страхувальника!');
		} else if (getElementValue('items' + items_id + 'car_price') == '') {
			alert('Необхідно вказати "Страхову вартість, грн"!');
		} else if (getElementValue('driver_ages_id') == 0 && getElementValue('drivers_id')!=7) {
			alert('Необхідно вказати "Вік водія"!');
		} else if (getElementValue('terms_id') == 0) {
			alert('Необхідно вибрати "Термін страхування"!');
		} else if (getElementValue('priority_payments_id') == 0) {
			alert('Необхідно вибрати "Пріоритет виплати"!');
		} else if (getElementValue('zones_id') == 0) {
			alert('Необхідно вибрати Зону дії полісу');
		} else if (getElementValue('residences_id') == 0) {
			alert('Необхідно вибрати "Місце зберігання ТЗ"!');
		} else if (getElementValue('items' + items_id + 'year') == '') {
			alert('Необхідно вказати "Рік випуску"!');
		} 
		else if (getElementValue('financial_institutions_id') == 0 && getElementValue('express_products_id')==0) {
			alert('Необхідно вибрати програму страхування!');
		} 
		else {

			risks = '';

			for(i=0; i < document.<?=$this->objectTitle?>.elements.length; i++) {
				if (document.<?=$this->objectTitle?>.elements[ i ].name == 'risks[]' &&
					(document.<?=$this->objectTitle?>.elements[ i ].type == 'hidden' || document.<?=$this->objectTitle?>.elements[ i ].checked)) {
					risks = risks + '&' + document.<?=$this->objectTitle?>.elements[ i ].name + '=' + document.<?=$this->objectTitle?>.elements[ i ].value;
				}
			}
			var optionsAlarm = 0;
			if (getElementValue('items' + items_id + 'protection_multlock')>0 ||
				getElementValue('items' + items_id + 'protection_immobilaser')>0 ||
				getElementValue('items' + items_id + 'protection_manual')>0 ||
				getElementValue('items' + items_id + 'protection_signalling')>0)
			{
				optionsAlarm = 1;
			}
            if (getElementValue('items' + items_id + 'no_immobiliser')>0) {
                optionsAlarm = 0;
            } else {
                optionsAlarm = 1;
            }
			person_types_id = (getElementValue('owner_person_types_id')=='2' || getElementValue('insurer_person_types_id')=='2') ? '2' : '1';

			var certificate = $('input[name=certificate]').val();
			var express_products_id = $('#express_products_id option:selected').val();
			var terms_id = $('#terms_id option:selected').val();
			var items0car_types_id = $('#items0car_types_id option:selected').val();

		
			if ( certificate != '' && items0car_types_id == '8' &&
              express_products_id != '140' && terms_id == '29' && certificate.length==8) {
			} else {
				$('input[name=certificate]').val('');
			}
		
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'html',
				data:		'do=Products|getShowBlockInWindow' +
							'&items_id=' + items_id+
							'&number_drivers=' + getElementValue('number_drivers') +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&insurance_companies_id=' + getElementValue('insurance_companies_id') +
							'&policies_id=<?=$data['id']?>' +
							'&agencies_id=<?=$data['agencies_id']?>' +
							'&solutions_id=<?=$data['solutions_id']?>' +
							'&parent_id=<?=$data['parent_id']?>' +
							'&deductibles_id=' + parseInt(deductibles_id) +
							'&person_types_id=' + person_types_id +
							'&car_types_id=' + getElementValue('items' + items_id + 'car_types_id') +
							'&brands_id=' + getElementValue('items' + items_id + 'brands_id') +
							'&driver_standings_id=' + getElementValue('driver_standings_id') +
							'&drivers_id=' + getElementValue('drivers_id') +
							'&zones_id=' + getElementValue('zones_id') +
							'&payment_brakedown_id=1' + 
                            //'&mileage_car_id=' + getElementValue('mileage_car_id') +
							'&price=' + parseFloat(getElementValue('items' + items_id + 'car_price'))  +
							'&driver_ages_id=' + getElementValue('driver_ages_id') +
							'&registration_cities_id=' + getElementValue('registration_cities_id') +
							'&terms_id=' + getElementValue('terms_id') +
							'&optionsAlarm=' + optionsAlarm +
							'&protection_multlock=' + getElementValue('items' + items_id + 'protection_multlock') +
							'&protection_immobilaser=' + getElementValue('items' + items_id + 'protection_immobilaser') +
							'&protection_manual=' + getElementValue('items' + items_id + 'protection_manual')+
							'&protection_signalling=' + getElementValue('items' + items_id + 'protection_signalling') +
							'&no_immobiliser=' + getElementValue('items' + items_id + 'no_immobiliser') +
							'&cars_count=' + getElementValue('cars_count') +
							'&options_race=' + getElementValue('options_race') +
							'&special=' + getElementValue('special') +
							'&express_products_id=' + getElementValue('express_products_id') +
							'&states_id=' + getElementValue('states_id') +
							'&financial_institutions_id=' + getElementValue('financial_institutions_id') +
							risks +
							'&priority_payments_id=' + getElementValue('priority_payments_id') +
							'&residences_id=' + getElementValue('residences_id') +
							'&year=' + getElementValue('items' + items_id + 'year') +
							'&use_as_car_work=' + getElementValue('items' + items_id + 'use_as_car_work') +
							'&use_as_car_private=' + getElementValue('items' + items_id + 'use_as_car_private') +
							'&options_deterioration_no=' + getElementValue('options_deterioration_no') +
							'&options_deductible_glass_no=' + getElementValue('options_deductible_glass_no') +
							'&options_workers_list=' + getElementValue('options_workers_list') +
							//'&options_first_accident=' + getElementValue('options_first_accident') +
							//'&options_season=' + getElementValue('options_season') +
                            '&options_fifty_fifty=' + getElementValue('options_fifty_fifty') +
							//'&options_holiday=' + getElementValue('options_holiday') +
							//'&options_work=' + getElementValue('options_work') +
							'&options_taxy=' + getElementValue('options_taxy') +
							'&options_test_drive=' + getElementValue('options_test_drive') +
							'&options_agregate_no=' + getElementValue('options_agregate_no') +
							'&options_second_year=' + getElementValue('options_second_year') +
							//'&options_years=' + getElementValue('options_years') +
							'&allowed_products_id=' + getElementValue('allowed_products_id') +
							'&related_products_id=' + getElementValue('items' + items_id + 'related_products_id') +
							'&amount_accident=' + getElementValue('amount_accident') +
							'&next_policy_statuses_id=' + getElementValue('next_policy_statuses_id') +
							'&flayer=' + getElementValue('flayer') +
							'&certificate=' + getElementValue('certificate') +
							'&bonus_malus='  +getElementValue('bonus_malus')+
							'&insurer_identification_code='  +getElementValue('insurer_identification_code')+
							'&insurer_edrpou='  +getElementValue('insurer_edrpou')+
							'&shassi=' + getElementValue('items' + items_id + 'shassi') +
							'&agreement_types_id=' + getElementValue('agreement_types_id') +
							<?if ($data['agreement_types_id'] >0) {?>
							'&begin_date=' + getElementValue('begin_datetime_year')+'-'+getElementValue('begin_datetime_month')+'-'+getElementValue('begin_datetime_day')+
							'&end_date=' + getElementValue('end_datetime_year')+'-'+getElementValue('end_datetime_month')+'-'+getElementValue('end_datetime_day')+
							'&begin_date_parent=' + getElementValue('begin_datetime_parent_year')+'-'+getElementValue('begin_datetime_parent_month')+'-'+getElementValue('begin_datetime_parent_day')+
							<?}?>
							'&discount='+getElementValue('discount')+
							'&cart_discount='+(($('#cart_discount').attr('checked')) ? parseFloat($('#cart_discount').val()) : 0),
				success:    function(result) {
								if ($('#financial_institutions_id').val()==19 || $('#financial_institutions_id').val()==52) //укргаз банк
								{
									$('#items'+items_id+'price_accident').removeAttr('readonly');
									$('#items'+items_id+'rate_accident').removeAttr('readonly');
								}
								document.getElementById('products'+items_id).innerHTML = result;
								if (document.getElementById('deductibles_id')==null && !deductibles_id) {
									setPaymentBrakedowns();
								}
								if (parseInt($('#express_products_id').val())>0 && parseInt($('#express_products_id').val())!=137 && parseInt($('#express_products_id').val())!=138 && parseInt($('#cars_count').val())<2) {
									$('input[id=items'+items_id+'deductibles_id]').attr('checked', true); 
									
								}
								$('input[id=items'+items_id+'deductibles_id]').each(function () {
										if ($(this).attr('checked')) {setRate(items_id, true);}
											
								});

							}
			});
			if (getElementValue('types_id')!=2) //не котирование
			{
				if (getElementValue('solutions_id')>0) //с ЭК 
				{
					$('#items'+items_id+'market_price').val($('#items'+items_id+'car_price').val());
				}
				else {//запрс на рыночную цену
					if (parseFloat($('#items'+items_id+'market_price').val())==0) //нет рыночной цены пробуем найти 
					{
					
						$.ajax({
						type:		'POST',
						url:		'index.php',
						dataType:	'json',
						data:		'do=Policies|getmarketPriceInWindow' +
									'&items_id=' + items_id+
									'&product_types_id=' + getElementValue('product_types_id') +
									'&solutions_id=<?=$data['solutions_id']?>' +
									'&car_types_id=' + getElementValue('items' + items_id + 'car_types_id') +
									'&brands_id=' + getElementValue('items' + items_id + 'brands_id') +
									'&models_id=' + getElementValue('items' + items_id + 'models_id') +
									'&transmissions_id=' + getElementValue('items' + items_id + 'transmissions_id') +
									'&car_body_id=' + getElementValue('items' + items_id + 'car_body_id') +
									'&modification=' + getElementValue('items' + items_id + 'modification') +
									'&car_engine_type_id=' + getElementValue('items' + items_id + 'car_engine_type_id') +
									'&year=' + getElementValue('items' + items_id + 'year') +
									'&engine_size=' + getElementValue('items' + items_id + 'engine_size') ,
						success:    function(result) {
											//$('#items'+items_id+'market_price').val(result.marketPrice);
											//setupMarketPrice();
									}
						});
					}
				}
			
			}
			
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
	
	function changeRace() {
        if (getElementValue('items0race') == 0) {
            alert('Необхідно ввести пробiг бiльше нуля!');
            return;
        }

        $.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'html',
            data:	    'do=Policies|changeRaceInWindow' +
                        '&product_types_id=' + getElementValue('product_types_id') +
                        '&policies_id=<?=$data['id']?>' +
                        '&race=' + getElementValue('items0race'),
            success: function(result) {
                alert(result);
            }
        });
    }
	
	function changePolicyVals() {
		if (updatestr.length==0)
		{
            alert('Не змiнено жодного поля');
            return;
        }
		
		$.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'html',
            data:	    'do=Policies|changePolicyInWindow' +
                        '&product_types_id=' + getElementValue('product_types_id') +
                        '&policies_id=<?=$data['id']?>' +updatestr
						,
            success: function(result) {
                alert('Полiс було змiнено документи регенеровано');
            }
        });
       
    }

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

    function setAssured(obj) {
        document.getElementById('assuredData').style.display = (obj.checked) ? 'block' : 'none';
    }

    function checkFields() {
       if ($('#policy_statuses_id option:selected').val() == <?=POLICY_STATUSES_GENERATED?>) {
            if (!window.confirm('Після переходу в статус "Сформован" редагування полісу стане неможливим. Продовжити?'))
                return false;
        }

        document.<?=$this->objectTitle?>.end_datetime_day.disabled		= false;
        document.<?=$this->objectTitle?>.end_datetime_month.disabled		= false;
        document.<?=$this->objectTitle?>.end_datetime_year.disabled		= false;
        document.<?=$this->objectTitle?>.end_datetime_day.style.display	= 'none';
        document.<?=$this->objectTitle?>.end_datetime_month.style.display	= 'none';
        document.<?=$this->objectTitle?>.end_datetime_year.style.display	= 'none';

        return true;
    }

    Date.prototype.lastday = function() {
        var d = new Date(this.getFullYear(), this.getMonth() + 1, 0);
        return d.getDate();
    }

    Date.prototype.addDays = function(d) {
        this.setDate( this.getDate() + d );
        return this;
    }

    Date.prototype.addMonths= function(m) {

        var d = this.getDate();
        this.setMonth(this.getMonth() + m);

        if (this.getDate() < d)
            this.setDate(0);
        return this;
    }

    Date.prototype.addYears = function(y) {

        var m = this.getMonth();
        this.setFullYear(this.getFullYear() + y);

        if (m < this.getMonth()) {
            this.setDate(0);
        }
        return this;
    }

    function checkYear() {
		return;
        cars_count = parseInt(getElementValue('cars_count'));
        for (i=0; i<cars_count; i++) {
            year = parseInt(document.getElementById('items' + i + 'year').value);

          /* if (<?=date('Y')?> - year > 3 &&
                document.getElementById('options_deterioration_no').checked) {

                alert('Без врахування зносу можно застрахувати автомобіль вік якого не перевищує 3 роки.');
                document.getElementById('options_deterioration_no').checked = false;
                document.getElementById('options_deterioration_no').enabled = false;
            } else {
                document.getElementById('options_deterioration_no').enabled = true;
            }*/

            /*if ((<?=date('Y')?> - year) > 8) {
                document.getElementById('options_years').checked = true;
            } else {
                document.getElementById('options_years').checked = false;
            }*/
        }
    }
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
	if ($data['agreement_types_id'] == 1 || $data['agreement_types_id'] == 2  || $data['agreement_types_id'] == 3 || $data['agreement_types_id'] == 4) {//Для переукладених дата оконечная идет из полиса оригинала
	?>
		$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'json',
					data:		'do=Policies|getAmountUsedInWindow' +
								'&product_types_id=' + getElementValue('product_types_id') +
								'&id=<?=$data['parent_id']?>' +
								'&agreement_types_id='+ getElementValue('agreement_types_id') +
								'&date=' + beginYear + '-' + beginMonth + '-' + beginDay,
					success:	function(result) {
									if (result.amountUsed == '-1') {
										alert('Помилка отримання данних за полісом.');
										return;
									}
									document.<?=$this->objectTitle?>.amount_parent.value = result.amountUsed;
									document.getElementById('amount_usedBlock').innerHTML = result.amountUsed;
									
									$('#end_datetime').val(result.end_datetime);
									$('#end_datetime_day').val(result.end_datetime_day);
									$('#end_datetime_month').val(result.end_datetime_month);
									$('#end_datetime_year').val(result.end_datetime_year);
								}
			});
			return;
	<?}?>		

			if (getElementValue('terms_years_id')!='1' && getElementValue('terms_years_id')!='')
			{
				$('#terms_id').val(29);
			}

           if (beginDay>0 && beginMonth>0 && beginYear>0) {
                beginDate	= new Date(beginYear, beginMonth - 1, beginDay);
                endDate		= null;
				addmonth	= 0;
				adddays		= -1;

                switch (getElementValue('terms_id')) {
					
					case '54'://1 день
						addmonth = 0;
						adddays		= 1;
						break;
					case '49'://3 день
						addmonth = 0;
						adddays		= 2;
						break;
					case '50'://7 день
						addmonth = 0;
						adddays		= 6;
						break;
					case '51'://10 день
						addmonth = 0;
						adddays		= 9;
						break;
					case '52'://20 день
						addmonth = 0;
						adddays		= 19;
						break;
					case '40'://15 дней
						addmonth = 0;
						adddays		= 14;
						break;
					case '41'://1 місяць
						addmonth = 1;
						break;
					case '42'://2 місяці
						addmonth = 2;
						break;
					case '26'://3 місяці
						addmonth = 3;
						break;
					case '43'://4 місяці
						addmonth = 4;
						break;
					case '44'://5 місяці
						addmonth = 5;
						break;
					case '27'://6 місяців
						addmonth = 6;
						break;
					case '45'://7 місяців
						addmonth = 7;
						break;
					case '46'://8 місяців
						addmonth = 8;
						break;
					case '28'://9 місяців
						addmonth = 9;
						break;
					case '47'://10 місяців
						addmonth = 10;
						break;
					case '48'://11 місяців
						addmonth = 11;
						break;
					case '29'://1 рік
						addmonth = 12;
						//спец условие профин
						if(getElementValue('financial_institutions_id')=='44' && getElementValue('expert_period')==18)
							addmonth = 18;
						break;
				}
				
				switch (getElementValue('terms_years_id')) {
					case '1'://до 1-го року
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
					case '8'://8-роки
						addmonth = 8*12;
						adddays		= -1;
						break;	
					
				}
				
						if (beginMonth==2 && beginDay==29) adddays = 0;
				
				
						if ($("#financial_institutions_id option:selected").val()==11)
							endDate = beginDate.addMonths(addmonth).addDays(adddays+1);
						else				
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

    function setBrands(car_type, brands_id) {

        var car_types_id = car_type.options[ car_type.selectedIndex ].value;

        var brand = document.getElementById( car_type.id.replace('car_types_id', 'brands_id') );
		
		var bodytype = car_type.id.replace('car_types_id', 'bodyType') ;
		
		if (car_types_id==8)
			$('.'+bodytype).css('display', '');
		else
			$('.'+bodytype).css('display', 'none');
		
        brand.options.length = 0;

        var model = document.getElementById( car_type.id.replace('car_types_id', 'models_id') );
        model.options.length = 0;

        for (var i=0; i < cars.length; i++) {
            if (car_types_id == cars[ i ][ 0 ] ) {
                for (var j=0; j < cars[ i ][1].length; j++) {
                    brand.options[ j ] = new Option( cars[ i ][ 1 ][ j ][ 1 ], cars[ i ][ 1 ][ j ][ 0 ]);

                    if (brands_id == cars[ i ][ 1 ][ j ][ 0 ]) {
                        brand.selectedIndex = j;
                    }
                }
                break;
            }
        }
    }

    function setModels(car_type, models_id) {

        var car_types_id = car_type.options[ car_type.selectedIndex ].value;

        var brand = document.getElementById( car_type.id.replace('car_types_id', 'brands_id') );
        if (brand.selectedIndex == -1) {
            return;
        }

        var brands_id = brand.options[ brand.selectedIndex ].value;
        var model = document.getElementById( car_type.id.replace('car_types_id', 'models_id') );
        model.options.length = 0;

        for (var i=0; i < cars.length; i++) {
            if (car_types_id == cars[ i ][ 0 ] ) {
                for (var j=0; j < cars[ i ][ 1 ].length; j++) {
                    if (brands_id == cars[ i ][ 1 ][ j ][ 0 ]) {
                        for (var k=0; k < cars[ i ][ 1 ][ j ][ 2 ].length; k++) {
                            model.options[ k ] = new Option( cars[ i ][ 1 ][ j ][ 2 ][ k ][ 1 ], cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ]);
                            if (models_id == cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ] ) {
                                model.selectedIndex = k;
                            }
                        }
                        break;
                    }
                }
            }
        }
    }

	function setupMarketPrice() {
		var r_only = true;
		if ($('#types_id').val()==2) //котирование
		{
			r_only = false;
		}
		$('.market_price_input').attr('readonly', r_only);
		var financial_institutions_id = getElementValue('financial_institutions_id');
		var solutions_id = parseInt(getElementValue('solutions_id'));
		var agreement_types_id= parseInt(getElementValue('agreement_types_id'));
		<?if ($this->mode != 'view') {?>
		//alert(solutions_id);
		if (solutions_id==0 && ((financial_institutions_id==19 && agreement_types_id!=3 ) || financial_institutions_id==46 || financial_institutions_id==1) ) {
			$('#items0car_price').attr('readonly', true);
			var v = parseFloat($('#items0market_price').val());
			if (v>0) $('#items0car_price').val(v);
		}
		<?}?>
	}
    function changeBrand(car_type) {
        setModels(car_type, 0);
    }

    function changeCarType(car_type) {
        setBrands(car_type, 0);
        changeBrand(car_type);
    }

    function setCar() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarModels|getJavaScriptInWindow',
            success:    function (result) {
<?
if (is_array($data['items'])) {
    foreach($data['items'] as $i => $item) {
        echo 'setBrands(document.getElementById(\'items' . $i . 'car_types_id\'), \'' . $item['brands_id'] . '\');' . "\r\n";
        echo 'setModels(document.getElementById(\'items' . $i . 'car_types_id\'), \'' . $item['models_id'] . '\');' . "\r\n";
		if ($this->mode != 'view' && $data['types_id'] == POLICY_TYPES_AGREEMENT && !$data['axapta_id']) {
            echo 'getProductsBlock(\'' . $i . '\', \'' . $item['deductibles_id'] . '\');' . "\r\n";
        }
    }
}
?>
				changePersonType();
				<? if ($this->mode != 'view') echo 'setOptionsBlock();'?>
			
			<?	
				//для доп угоды по смене страх суммы выключаем все от редактирования
				if(($data['agreement_types_id']==4 || $data['agreement_types_id']==3) && $Authorization->data['roles_id']==ROLES_AGENT) {
			?>
			var allowed_fields = {'policy_statuses_id':1,'seller_agencies_id':1,'seller_agents_id':1,'sign_agents_id':1,'items0transmissions_id':1,'items0car_body_id':1,'items0car_engine_type_id':1};
			$("select").each(function(idx,elem) {
				el = $(elem);
				var el_id = el.attr("id")
				if (!allowed_fields[el_id]) {
					el.addClass('readonly').data('readonly', true).attr('disabled', true);
					el.after('<input type="hidden" name="' + el[0].name + '" value="' + el[0].value + '" data-select-sham>');
				}
			});
			
			$("input").each(function(idx,elem) {
				el = $(elem);
				if (el.attr("id")!='items0car_price' && el.attr("id")!='items0race' && el.attr("id")!='items0transmissions_id'  && el.attr("id")!='items0car_body_id'  && el.attr("id")!='items0car_engine_type_id'  && el.attr("id")!='items0modification' && el.attr("id")!='items0market_price' )
					el.attr('readonly', true);
			});
			
			$(':input[type=checkbox]').each(function(idx,elem) {
				el = $(elem);
				el.bind(
					'click',
					function() {
						return false;
					}
				);
		
			});
			$(':input[type=radio]').each(function(idx,elem) {
				el = $(elem);
				el.bind(
					'click',
					function() {
						return false;
					}
				);
		
			});
			$('#searchprodbutton').html('');
			$('.addeqip').html('');
			$('.dp-choose-date').each(function(idx,elem) {
				el = $(elem);
				el.bind(
					'click',
					function() {
						return false;
					}
				);
		
			});
			<?if ($data['policy_statuses_id']!=10) {?>
			$('#policy_statuses_id').append('<option value="10">сформований</option>');
			<?}?>
			
			<?
			}
			?>
            }
        })
		
    }

    function str_replace(haystack, needle, replacement) {
        var temp = haystack.split(needle);
        return temp.join(replacement);
    }

    function setCarsCount() {
        cars_count = parseInt(getElementValue('cars_count'));
        for (i=0; i<<?=$max_cars?>; i++) {

			var car = document.getElementById('car' + i);

            if (car.innerHTML.length==0 && i<=cars_count) {
				car.innerHTML = document.getElementById('car').innerHTML;
                car.innerHTML = str_replace(car.innerHTML, 'CAR_NUMBER', i);
                car.innerHTML = str_replace(car.innerHTML, 'CAR_TITLE', i + 1);
                car.style.display = 'block';
            }

            if (cars_count <= i) {
                car.innerHTML = '';
                car.style.display = 'none';
            }
        }
		setupMarketPrice();
    }

    function setRequiredFields() {
		<? if ($this->subMode == 'set') {?>

		var policy_statuses_id = $('#policy_statuses_id').val();

		switch (policy_statuses_id) {
			case '<?=POLICY_STATUSES_CREATED?>':
			case '<?=POLICY_STATUSES_REQUEST_QUOTE?>':
			case '<?=POLICY_STATUSES_REQUEST_QUOTE_ERROR?>':
			case '<?=POLICY_STATUSES_REQUEST_QUOTE_AGAIN?>':
			case '<?=POLICY_STATUSES_QUOTE?>':
				$('span.required').text('');
				return;
		}
		<? } ?>
		$('span.required').text('*');
		setDiscountCardCarManWoman();
    }
	
	function setTermsYears()
	{
	
		var financial_institutions_id = getElementValue('financial_institutions_id');
		
		if (financial_institutions_id=='1' || financial_institutions_id=='52' || financial_institutions_id=='53' || financial_institutions_id=='25' || financial_institutions_id=='5' || financial_institutions_id=='51' || financial_institutions_id=='30' || financial_institutions_id=='3'  || financial_institutions_id=='27'|| financial_institutions_id=='38'|| financial_institutions_id=='41'|| financial_institutions_id=='50' || financial_institutions_id=='43'  || financial_institutions_id=='20' || financial_institutions_id=='11' || financial_institutions_id=='45' || financial_institutions_id=='55'|| financial_institutions_id=='20'|| financial_institutions_id=='2'|| financial_institutions_id=='44'|| financial_institutions_id=='33' || financial_institutions_id=='19' || financial_institutions_id=='40' || financial_institutions_id=='15' || financial_institutions_id=='39'   || financial_institutions_id=='7'  || financial_institutions_id=='34' || financial_institutions_id=='59' || financial_institutions_id=='63')
		{
			$('.termsYears').css('display', '');
			<?if (!ereg('^view', $action)) {?>
				var  expert_period = parseInt($('#expert_period').val());
				expert_period = parseInt(expert_period/12);
				if (expert_period>0 && parseInt($('#states_id').val())!=1)
					$('#terms_years_id').val(expert_period);
			<?}?>
		
		}
		else
		{
			$('.termsYears').css('display', 'none');
			$('#terms_years_id').val(1);
		}
	}

	function changeMode() {
		if($('#policy_statuses_id').val()==10) {
			alert("В статусi Сформовано режим котирування використовувати заборонено");
			return;
		}
		document.<?=$this->objectTitle?>['changeMode'].value = '1';
		switch (document.<?=$this->objectTitle?>['types_id'].value) {
			case '<?=POLICY_TYPES_AGREEMENT?>':
				document.<?=$this->objectTitle?>['types_id'].value = '<?=POLICY_TYPES_QUOTE?>';
				break;
			case '<?=POLICY_TYPES_QUOTE?>':
				document.<?=$this->objectTitle?>['types_id'].value = '<?=POLICY_TYPES_AGREEMENT?>';
				break;
		}
		document.<?=$this->objectTitle?>.submit();
	}

	function cancelPolicy1(button) {
		button.disabled = true;
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=Policies|getamount_returnInWindow' +
						'&product_types_id=' + getElementValue('product_types_id') +
						'&id=<?=$data['id']?>',
			success:	function(result) {
							button.disabled = false;
							if (result.amount_return == '-1') {
								alert('Помилка отримання данних за полісом.');
								return;
							}

							if (!window.confirm('За полісом підлягають поверненю кошти у розмірі ' + result.amount_return + ' грн.\r\nВи дійсно бажаєте анулювати поліс?')) {
								return;
							}
							var cancelDate='';
							cancelDate =  prompt('Введить дату розриву дд.мм.гггг', cancelDate);
							if (cancelDate==null) return;


							document.location = '/index.php?do=Policies|cancelPolicy&id=<?=$data['id']?>&cancelDate='+cancelDate+'&product_types_id=<?=$data['product_types_id']?>';
						}
		});
	}

	function cancelPolicy(button) {
		if (!window.confirm('Ви дійсно бажаєте припинити дiю полісу?')) {
			return;
		}
		document.location = '/index.php?do=Policies|cancelPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
	}


	function continuePolicy() {
		if (!window.confirm('Ви дійсно бажаєте пролонгувати поліс?')) {
				return;
		}
		document.location='/index.php?do=Policies|continuePolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
	}

	function renewPolicy(agreement_types_id) {
		if (!window.confirm('Ви дійсно бажаєте створити додаткову угоду до полісу?')) {
			return;
		}
		if (agreement_types_id==3) //проверить возможность вост СС
		{
			$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'json',
				data:       'do=Policies|checkRestoreSumInWindow' +
							'&id=' + <?=intval($data['id'])?>+
							'&product_types_id=' + getElementValue('product_types_id')  ,
				success: function(result) {
						if (result.responce!='ok')
						{
							alert(result.responce);
						
						}
						document.location='/index.php?do=Policies|renewPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>&agreement_types_id=3&types_id=2';
					
				}
			});
			return;
		}
		document.location='/index.php?do=Policies|renewPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>&agreement_types_id='+agreement_types_id+'&types_id='+(agreement_types_id==2 || agreement_types_id==3 || agreement_types_id==4 ? 2 :1);
	}

	$(function() {
		$('#begin_datetime').bind(
			'change',
			function() {
				setEnd();
			}
		);
	});
	
	function changeExpressProduct()
	{

	var express_products_id=parseInt(getElementValue('express_products_id'));


	    if (express_products_id==671) {
			$('.expressproduct4').css('display', '');
			document.getElementById('additionalConditions').style.display	= 'block';
			return;
			
		}
		if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE4?>) {
			$('.testdriveroute').css('display', '');
		}
		else {
			$('.testdriveroute').css('display', 'none');
		}
<?
if ($data['types_id']>1) echo 'return;'; //выйти если режим котирования
?>
		//$('.testDriveDescription').css('display', 'none');
		 $('.bankblock').css('display', '');
		var financial_institutions_id = parseInt(getElementValue('financial_institutions_id'));
		if (financial_institutions_id>0 && parseInt(getElementValue('express_products_id'))>0)
		{
			if (parseInt(getElementValue('express_products_id'))!=137 && parseInt(getElementValue('express_products_id'))!=288) {
				alert('Еспрес продукти дозволяється використовувати якшо вигонодонабувач не є Банком');
				$('#express_products_id').val(0);
				changePersonType();
				return;
			}
		}
		if (parseInt(getElementValue('express_products_id'))==137 ) return;
		
		if (express_products_id==138) {
			$('#note_text').html('Тариф зазначено з врахуванням програми Сезон+');
			$('.propertyplace').css('display', '');
		}
		else {
			$('#note_text').html('');
			$('.propertyplace').css('display', 'none');
		}
		if (express_products_id==110 || express_products_id==686 || express_products_id == 753) express_products_id = 0;
		$('#options_agregate_no').removeAttr('disabled'); 
		document.getElementById('risksBlock').style.display				= '';

		$('.expressproduct').css('display', '');
		setTermsYears();
		$('.testdriveregion').css('display', 'none');
		if (financial_institutions_id>0)
		{
			$('#assuredBlock').css('display', 'none');
		}
		

		if (express_products_id==0 || getElementValue('express_products_id')=='' )
		{
            $('.other_policiesBlock').css('display','');
            $('.order_basis_carBlock').css('display','');
            $('.use_as_carBlock').css('display','');
			if (getElementValue('express_products_id') == 753 || getElementValue('express_products_id')==686 || getElementValue('express_products_id')==110 || getElementValue('express_products_id')==138 || getElementValue('express_products_id')==673)
			{
				$('.bankblock').css('display', 'none');
			}	
			changePersonType();
			return;
		}
		//установка значений по умолчанию для выбраного экспресс продукта
		$('#insurance_companies_id').val(4);
		changeCompany();
	
			
			$('.other_policiesBlock').css('display','');
            //$('.order_basis_carBlock').css('display','none');
            //$('.use_as_carBlock').css('display','none');
			if (parseInt($('#driver_standings_id').val())==0 || $('#driver_standings_id').val()=='') $('#driver_standings_id').val(2);
			
			$('#number_drivers').val(1);
			setDriversId();
			$('#options_agregate_no').attr('disabled', 'disabled');
			$('#options_agregate_no').attr('checked', false);
			$('#priority_payments_id').val(1);
			<?if ($data['types_id']!=2) {?>
			$('#terms_id').val(29);
			$('#terms_years_id').val(1);
			setEnd(); clearProductsBlocks();
			<?}?>
		
			if(getElementValue('express_products_id')==673) {//vip
				$('#options_fifty_fifty').attr('checked', false);
				$('#options_deterioration_no').attr('checked', true);
				$('#options_agregate_no').attr('checked', true);
				$('#zones_id').val(4);
				$('#residences_id').val(2);
				$('#number_drivers').val(0);
				setDriversId();
			}
			
			persontype=1;
			if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE1?>
				|| express_products_id==<?=PRODUCT_KASKO_TESTDRIVE2?>
				|| express_products_id==<?=PRODUCT_KASKO_TESTDRIVE3?>
				|| express_products_id==<?=PRODUCT_KASKO_TESTDRIVE4?>) {
                        $('.other_policiesBlock').css('display','none');
                        $('.order_basis_carBlock').css('display','none');
                        $('.use_as_carBlock').css('display','none');
						$('#options_test_drive').attr('checked', true);
						$('#zones_id').val(1);
						$('#number_drivers').val(0);
						$('#residences_id').val(2);
						$('#priority_payments_id').val(1);
						
						setDriversId();
						<?if ($data['types_id']!=2) {?>
						$('#terms_id').val(40);
						setEnd(); clearProductsBlocks();
						<?}?>
						persontype=2;
						
			}
			<?if ($data['types_id']!=2) {?>
			 
			if (express_products_id==288) {
				$('#financial_institutions_id').val(25);
				$('#options_deterioration_no').attr('checked', false);
				$('#number_drivers').val(0);
				$('#bonus_malus').val(1);
				$('#zones_id').val(1);
				$('#residences_id').val(2);
				setDriversId();
			}
			if (express_products_id==<?=PRODUCT_KASKO1?>)
			{
				$('#zones_id').val(1);
				$('#residences_id').val(2);
				$('#number_drivers').val(0);
				setDriversId();
			}
			
			if (express_products_id==599 || express_products_id==684 )
			{
				$('#residences_id').val(2);
				$('#number_drivers').val(0);
				setDriversId();
			}
			if (express_products_id==684 ) {
				$('#zones_id').val(1);
			}
			
			if (express_products_id==<?=PRODUCT_KASKO2?>)
			{
				$('#residences_id').val(2);	
				$('#zones_id').val(4);
				$('#number_drivers').val(0);
				setDriversId();
			}	
			
			if (express_products_id==<?=PRODUCT_KASKO3?>)
			{
				$('#residences_id').val(2);	
				$('#zones_id').val(4);
				$('#number_drivers').val(0);
				setDriversId();
			}	
			
			document.getElementById('risksBlock').style.display				= '';
			$('.riskbox').attr('checked', true); 
			$('.riskbox').attr('options_taxy', false); 
			
			
			if (parseInt($('#registration_cities_id').val())==0 || $('#registration_cities_id').val()=='') {$('#registration_cities_id').val(1);changeCity();}
			if (parseInt($('#driver_ages_id').val())==0 || $('#driver_ages_id').val()=='') {$('#driver_ages_id').val(2);}
			<?}?>
			
			
			
			//$('#owner_person_types_id').val(persontype);
			//$('#insurer_person_types_id').val(persontype);
			changePersonType();
			
			cars_count = parseInt($('#cars_count').val());
			for (i=0;i<cars_count;i++) {
				$('#items'+i+'protection_signalling').attr('checked', true); 
				
				$('#items'+i+'number_places').val('5');
				//$('#items'+i+'race').val('0');
				$('#items'+i+'transmissions_id').val(1);
				if (express_products_id!=288) {
					//$('#items'+i+'engine_size').val('1');
					
					//$('#items'+i+'colors_id').val(18);
				}
				
				
				
				if (parseInt($('#items'+i+'car_types_id').val())==0 || $('#items'+i+'car_types_id').val()=='')
				{
					$('#items'+i+'car_types_id').val(8);
					changeCarType(document.getElementById('items'+i+'car_types_id'));
				}
			}	
			setExpressProductVisibility();
	}
	function setTestDriveProductVisibility()
	{
		$('#options_deterioration_no').attr('checked', true);
		$('#options_agregate_no').attr('checked', true);
		$('#optionsBlock').css('display', 'none');
		$('#risksBlock').css('display', 'none');
		$('#options_raceBlock').css('display', 'none');
		$('.expressproduct').css('display', 'none');
		$('.expressproductidea').css('display', '');
	}
	function setExpressProductVisibility()
	{
		var express_products_id =parseInt(getElementValue('express_products_id'));
		
		if ( express_products_id==599 || express_products_id==684)
				$('.expressproduct4').css('display', 'none');
		else		
			$('.expressproduct4').css('display', '');

		if (express_products_id==138) {
			var html = $('.propertyplace').html().replace("16.10", "01.12");
			html = html.replace("15.04", "31.03");
			$('.propertyplace').html(html);
			$('.propertyplace').css('display', '');
		}
		else if (express_products_id==686) {
			var html = $('.propertyplace').html().replace("01.12", "16.10");
			html = html.replace("31.03", "15.04");
			$('.propertyplace').html(html);
			$('.propertyplace').css('display', '');
		}
		else {
			$('.propertyplace').css('display', 'none');
		}
		
		if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE4?>) {
			$('.testdriveroute').css('display', '');
		}
		else {
			$('.testdriveroute').css('display', 'none');
		}
<?
if ($data['types_id']>1) echo 'return;'; //выйти если режим котирования
?>
		if (parseInt(getElementValue('express_products_id'))==137) 
		{
			$('.expressproduct').css('display', '');
			$('.testdriveregion').css('display', 'none');
			return;
		}
		express_products_id=parseInt(getElementValue('express_products_id'));
		if ( express_products_id == 753 || express_products_id==110 || express_products_id==686) express_products_id = 0;
		$('.testDriveDescription').css('display', 'none');
		if (express_products_id==0 || getElementValue('express_products_id')=='' )
		{
			//changePersonType();
			return;
		}
			$('.expressproduct').css('display', 'none');
			$('.expressproductidea').css('display', '');
			if (express_products_id==<?=PRODUCT_KASKO1?>)
				$('.expressproduct1').css('display', '');
			if (express_products_id==<?=PRODUCT_KASKO2?>)
				$('.expressproduct2').css('display', '');
			if (express_products_id==<?=PRODUCT_KASKO3?> || express_products_id==599)
				$('.expressproduct3').css('display', '');
			if( express_products_id==684)
				$('.marketpriceblock').css('display', 'none');
			
				
				
			if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE1?>
				|| express_products_id==<?=PRODUCT_KASKO_TESTDRIVE2?>
				|| express_products_id==<?=PRODUCT_KASKO_TESTDRIVE3?>)
			{
				$('.testdriveproduct').css('display', '');
				$('.testDriveDescription').css('display', '');
				$('.testDriveDescription1').css('display', 'none');
				$('.testDriveDescription2').css('display', 'none');
				$('.testDriveDescription3').css('display', 'none');
				if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE1?>)
					$('.testDriveDescription1').css('display', '');
				if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE2?>)
					$('.testDriveDescription2').css('display', '');
				if (express_products_id==<?=PRODUCT_KASKO_TESTDRIVE3?>)
					$('.testDriveDescription3').css('display', '');
			}
		
	}

	

	
	function is500action()
	{
		    //проверка возможности использования опции
			/*Страхователь – физ лицо
			Тип ТС – легковой
			Пробег – 0
			Выплата возмещения – приоритет СТО
			Срок страхования- 1 год*/
			var payment_brakedown_id = $('input[type=radio][name=payment_brakedown_id]:checked').val();
			if (payment_brakedown_id>1 
				 || getElementValue('terms_id')!='29' || getElementValue('financial_institutions_id')>0)
				{
				  return false;
				}
				else return true;
	}
	
	
	function checkPayment_brakedown()
	{
		    //проверка возможности разбивки платежа только для договоров на 1 год
			 
			/*var payment_brakedown_id = $('input[type=radio][name=payment_brakedown_id]:checked').val();
			if (payment_brakedown_id>1 && parseInt(getElementValue('types_id'))!=2 && parseInt($('#agreement_types_id').val())==0
				 && (getElementValue('terms_id')!='29' || getElementValue('terms_years_id')>1))
				{
				  alert('Розбивка платежу можлива за умови страхування на 12 мiсяцiв');
				  $("input[type=radio][name=payment_brakedown_id][value=" + payment_brakedown_id + "]").attr('checked', '');
				  $("input[type=radio][name=payment_brakedown_id][value=1]").attr('checked', 'checked');
				}*/
	}
	
	function set500Block()
	{
		express_products_id=parseInt(getElementValue('express_products_id'));
		
		if ($("#options_month500").attr('checked') && !is500action())
		{
			$("#options_month500").attr('checked',false);
			alert('Використання опцiї "місяць страхування за 500 грн" можливо за наступних умов: '+"\n"+'Оплата: 1 платiж');
		}
		var payment_brakedown_id = $('input[type=radio][name=payment_brakedown_id]:checked').val();
		if ($("#options_fifty_fifty").attr('checked') && payment_brakedown_id>1 ) {
			$("#options_fifty_fifty").attr('checked',false);
			alert('Використання опцiї "50 на 50" можливо за наступних умов: '+"\n"+'Оплата: 1 платiж');
		}
		 
	}
	function show500Block()
	{
			var financial_institutions_id = getElementValue('financial_institutions_id');
			if (financial_institutions_id>0) 
				document.getElementById('options_deductible_glass_noBlock').style.display	= '';
			else document.getElementById('options_deductible_glass_noBlock').style.display	= 'none';
			
			<?if ($this->options['options_month500']) {?>
			if (financial_institutions_id>0 || getElementValue('express_products_id')==140)
			{
				//спрятать акция 500
				$("#options_month500").attr('checked',false);		
				document.getElementById('options_500Block').style.display	= 'none';
			}
			else			
			{
				document.getElementById('options_500Block').style.display	= '';
			}
			<?}?>
	}
	
	function setRetail()
	{
		
		var financial_institutions_id = getElementValue('financial_institutions_id');
		if(financial_institutions_id==0 && parseInt(getElementValue('types_id'))!=2)
		{
			$(".riskbox").each(function () {
                if (parseInt(this.value)<7) {
					$(this).attr('checked', 'checked');
				}
              });
		}
		else
			$(".riskbox").attr('style','');
		
	}
	
	$(function() {
		$('.riskbox').bind('change', function(elem) {
		setRetail();
		<? if ($this->options['all_risks']) {?>
			$(".riskbox").each(function () {
					$(this).attr('checked', 'checked');

            });
		<?}?>
		} );
	});
	
	function calculate()
	{
	}

    function changeNoImmobiliser(value, item){
        if (!value) {
            $("#items"+item+"protection_multlock").attr("disabled", "");
		    $("#items"+item+"protection_immobilaser").attr("disabled", "");
            $("#items"+item+"protection_manual").attr("disabled", "");
            $("#items"+item+"protection_signalling").attr("disabled", "");
        } else {
            $("#items" + item + "protection_multlock").attr("disabled", "disabled");
            $("#items" + item + "protection_immobilaser").attr("disabled", "disabled");
            $("#items" + item + "protection_manual").attr("disabled", "disabled");
            $("#items" + item + "protection_signalling").attr("disabled", "disabled");
            $("#items" + item + "protection_multlock").attr("checked", "");
            $("#items" + item + "protection_immobilaser").attr("checked", "");
            $("#items" + item + "protection_manual").attr("checked", "");
            $("#items" + item + "protection_signalling").attr("checked", "");
        }
    }
	
</script>
<div id="car" style="visibility: hidden;z-index: -1;position: absolute;">
	<div class="section">
		<input type="hidden" id="itemsCAR_NUMBERrelated_products_id" name="items[CAR_NUMBER][related_products_id]" />
		Дані щодо автомобіля CAR_TITLE:
		<span class="label grey"><?=$this->getMark()?><b>Тип ТЗ:</b></span>
		<span>
			<select id="itemsCAR_NUMBERcar_types_id" onchange="changeCarType(this);" name="items[CAR_NUMBER][car_types_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
				<option value="">...</option>
				<?
					foreach($this->car_types_id as $id => $row) {
						echo '<option value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
					}
				?>
			</select>
		</span>
		<span class="label grey"><?=$this->getMark()?><b>Марка:</b></span>
		<span><select id="itemsCAR_NUMBERbrands_id" name="items[CAR_NUMBER][brands_id]" onchange="changeBrand(document.getElementById('itemsCAR_NUMBERcar_types_id'));" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></span>
		<span class="label grey"><?=$this->getMark()?><b>Модель:</b></span>
		<span><select id="itemsCAR_NUMBERmodels_id" name="items[CAR_NUMBER][models_id]" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></span>
		<A href="#" onclick="document.getElementById('carCAR_NUMBER').innerHTML = '';document.getElementById('carCAR_NUMBER').style.display = 'none';return false;"><img src="/images/administration/navigation/delete_over.gif" width="14" height="14" alt="Вилучити"  /></a>
	</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Страхова вартість, грн:</td>
		<td><input type="text" id="itemsCAR_NUMBERcar_price" name="items[CAR_NUMBER][car_price]" value="0" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="changeAmountKASKO(CAR_NUMBER)" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
		<td class="label grey marketpriceblock"><?=$this->getMark()?>Ринкова вартість, грн:</td>
		<td class="marketpriceblock"><input  type="text" id="itemsCAR_NUMBERmarket_price" name="items[CAR_NUMBER][market_price]" value="0" maxlength="10" class="fldMoney market_price_input" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false, $data['ECmode'])?> <?if ($_SESSION['auth']['roles_id'] == ROLES_AGENT) echo 'readonly'; ?>/></td>
		
		<td class="label grey expressproduct expressproductidea">*Об'єм двигуна, см<sup>3</sup>:</td>
		<td class="expressproduct expressproductidea"><input type="text" id="itemsCAR_NUMBERengine_size" name="items[CAR_NUMBER][engine_size]" value="" maxlength="8" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
		<td class="label grey"><?=$this->getMark()?>Рік випуску:</td>
		<td><input type="text" id="itemsCAR_NUMBERyear" name="items[CAR_NUMBER][year]" onchange="checkYear()" value="" maxlength="4" class="fldYear" onfocus="this.className='fldYearOver'" onblur="this.className='fldYear'" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
		<td class="label grey"><?=$this->getMark()?>Пробіг, тис. км.:</td>
		<td class="" ><input id="itemsCAR_NUMBERrace" type="text" name="items[CAR_NUMBER][race]" value="" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey expressproduct expressproductidea">*Колір:</td>
		<td class="expressproduct expressproductidea">
			<?
				if ($data['ECmode']) {
					$field['name'] .= '_temp';
					echo '<input type="hidden" name="items['.$i.'][colors_id]" value="' . $item['colors_id'] . '" />';
				}
			?>
			<select id="itemsCAR_NUMBERcolors_id" name="items[CAR_NUMBER][colors_id<?=($data['ECmode'] ? '_temp':'')?>]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
				<option value="">...</option>
				<?
					foreach($this->colors_id as $id => $row) {
						echo '<option value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
					}
				?>
			</select>
		</td>
		<td class="label grey expressproduct"><?=$this->getMark(false)?>Кількість місць:</td>
		<td class="expressproduct"><input  id="itemsCAR_NUMBERnumber_places" type="text" name="items[CAR_NUMBER][number_places]" value="" maxlength="2" class="fldInteger" onfocus="this.className='fldIntegerOver'" onblur="this.className='fldInteger'" /></td>
		<td class="label grey">*№ шасі (кузов, рама):</td>
		<td><input type="text" name="items[CAR_NUMBER][shassi]" value="" maxlength="40" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
		<td class="label grey">Державний знак (реєстраційний №):</td>
		<td><input type="text" name="items[CAR_NUMBER][sign]" value="" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	<tr>
		<td>*КПП:</td>
		<td>
			<select id="itemsCAR_NUMBERtransmissions_id" name="items[CAR_NUMBER][transmissions_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
				<option value="">...</option>
				<?
					foreach($this->transmissions as $id => $row) {
						echo '<option value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
					}
				?>
			</select>
		</td>
		<td class="itemsCAR_NUMBERbodyType">*Тип кузова:</td>
		<td class="itemsCAR_NUMBERbodyType">
			<select id="itemsCAR_NUMBERcar_body_id" name="items[CAR_NUMBER][car_body_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
				<option value="">...</option>
				<?
					foreach($this->car_body as $id => $row) {
						echo '<option value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
					}
				?>
			</select>
		</td>
		<td>*Топливо:</td>
		<td>
			<select id="itemsCAR_NUMBERcar_engine_type_id" name="items[CAR_NUMBER][car_engine_type_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
				<option value="">...</option>
				<?
					foreach($this->car_engine_type as $id => $row) {
						echo '<option value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
					}
				?>
			</select>
		</td>
		<td class="label grey">Модифікація:</td>
		<td><input type="text" name="items[CAR_NUMBER][modification]" value="" maxlength="40" class="fldText modification" onfocus="this.className='fldTextOver modification'" onblur="this.className='fldText modification'" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
	</tr>
	
	</table>
	<table cellpadding="5" cellspacing="0" class="expressproduct testdriveproduct expressproduct3">
	<tr>
		<td class="label grey">Засоби захисту:</td>
		<td class="label grey">Mul-T-Lock:</td>
		<td><input type="checkbox" id="itemsCAR_NUMBERprotection_multlock" name="items[CAR_NUMBER][protection_multlock]" value="1" <?=$this->getReadonly(true)?> /></td>
		<td class="label grey">Immobilaser:</td>
		<td><input type="checkbox" id="itemsCAR_NUMBERprotection_immobilaser" name="items[CAR_NUMBER][protection_immobilaser]" value="1" <?=$this->getReadonly(true)?> /></td>
		<td class="label grey">Механічна:</td>
		<td><input type="checkbox" id="itemsCAR_NUMBERprotection_manual" name="items[CAR_NUMBER][protection_manual]" value="1" <?=$this->getReadonly(true)?> /></td>
		<td class="label grey">Сигналізація:</td>
		<td><input type="checkbox" id="itemsCAR_NUMBERprotection_signalling" name="items[CAR_NUMBER][protection_signalling]" value="1" <?=$this->getReadonly(true)?> /></td>
        <td class="label grey">Страхування без протиугінного пристрою:</td>
		<td><input type="checkbox" id="itemsCAR_NUMBERno_immobiliser" name="items[CAR_NUMBER][no_immobiliser]" value="1" <?=$this->getReadonly(true)?> onChange="changeNoImmobiliser(this.checked, CAR_NUMBER)"/></td>
	</tr>
	</table>
	<div id="destinationBlock" class="destinationBlock" <?=(intval($data['options_race'])==0 ?'style="display: none;"' : '')?>>
		<table  cellpadding="0" cellspacing="0" >
		<tr>
			<td class="label grey">* Маршрут:</td>
			<td><input style="width:250px;" type="text" id="itemsCAR_NUMBERroute" name="items[CAR_NUMBER][route]" value="" maxlength="250" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'"/></td>
		</tr>
		</table>
	</div>
    <div class="other_policiesBlock">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey" valign="top">Діючі договори:</td>
                <td><textarea rows="1" cols="150" id="itemsCAR_NUMBERother_policies" name="items[CAR_NUMBER][other_policies]" class="fldTextArea" onfocus="this.className='fldTextAreaOver'" onblur="this.className='fldTextArea'" <?=$this->getReadonly(false)?>><?=$item['other_policies']?></textarea></td>
            </tr>
        </table>
    </div>
    <div class="order_basis_carBlock">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><b>Розпорядження (користування) ТЗ на підставі:</b></td>
                <td><input type="radio" name="items[CAR_NUMBER][order_basis_car_id]" value="1" <?if ($data['order_basis_car_id']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />права власності</td>
                <td><input type="radio" name="items[CAR_NUMBER][order_basis_car_id]" value="2" <?if ($data['order_basis_car_id']==2) echo 'checked';?> <?=$this->getReadonly(true)?> />оренди</td>
                <td><input type="radio" name="items[CAR_NUMBER][order_basis_car_id]" value="3" <?if ($data['order_basis_car_id']==3) echo 'checked';?> <?=$this->getReadonly(true)?> />доручення</td>
                <td><input type="radio" name="items[CAR_NUMBER][order_basis_car_id]" value="4" <?if ($data['order_basis_car_id']==4) echo 'checked';?> <?=$this->getReadonly(true)?> />лізингу</td>
            </tr>
        </table>
    </div>
    <div class="use_as_carBlock">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><b>Використання ТЗ в якості:</b></td>
                <td><input id="itemsCAR_NUMBERuse_as_car_private" type="checkbox" name="items[CAR_NUMBER][use_as_car_private]" value="1" <?if ($data['use_as_car_private']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />в особистих цілях</td>
                <td><input id="itemsCAR_NUMBERuse_as_car_work" type="checkbox" name="items[CAR_NUMBER][use_as_car_work]" value="2" <?if ($data['use_as_car_work']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />в робочих цілях</td>
                <td><input id="itemsCAR_NUMBERuse_as_car_leasing" type="radio" name="items[CAR_NUMBER][use_as_car_leasing]" value="4" <?if ($data['use_as_car_leasing']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />оренда, лізинг</td>
            </tr>
        </table>
    </div>
	<div class="section">Додаткове обладнання:</div>
	<table id="equipmentCAR_NUMBER" cellpadding="5" cellspacing="0" width="100%">
		<tr class="columns">
			<td>Найменування</td>
			<td>Марка</td>
			<td>Модель</td>
			<td>Вартість, грн.</td>
			<td width="25" style="padding: 0px 0px 0px 10px; text-align: center;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addEquipment(this,CAR_NUMBER)" /></td>
		</tr>
	</table>

	<div class="section">Страховий продукт: <input   type="button" value=" Знайти " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="getProductsBlock(CAR_NUMBER);" /></div>
	<div id="productsCAR_NUMBER"></div><br />

	<input type="hidden" id="itemsCAR_NUMBERproducts_id" name="items[CAR_NUMBER][products_id]" value="" title="products_id" />
	<table width="100%" cellpadding="0" cellspacing="0" <?if ($this->mode != 'view') {?>class="expressproduct expressproduct1 testdriveproduct"<?}?>>
	<tr class="columns">
		<td>Інші ризики</td>
		<td>Незаконне заволодіння</td>
		<td>КАСКО, тариф, %</td>
		<td>КАСКО, премія, грн.</td>
		<td>ДО, тариф, %</td>
		<td>ДО, премія, грн.</td>
		<!--<td>НС, страхова сума, грн.</td>
		<td>НС, тариф, %</td>
		<td>НС, премія, грн.</td>-->
		<td>Тариф, грн.</td>
	</tr>
	<tr class="row1">
		<td><input type="text" id="itemsCAR_NUMBERdeductibles_value0" name="items[CAR_NUMBER][deductibles_value0]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute0Percent" name="items[CAR_NUMBER][deductibles_absolute0]" value="0" <?=($item['deductibles_absolute0'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> />% <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute0Amount" name="items[CAR_NUMBER][deductibles_absolute0]" value="1" <?=($item['deductibles_absolute0'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /> грн.</td>
		<td><input type="text" id="itemsCAR_NUMBERdeductibles_value1" name="items[CAR_NUMBER][deductibles_value1]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute1Percent" name="items[CAR_NUMBER][deductibles_absolute1]" value="0" <?=($item['deductibles_absolute1'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> />% <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute1Amount" name="items[CAR_NUMBER][deductibles_absolute1]" value="1" <?=($item['deductibles_absolute1'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /> грн.</td>
		<td><input type="text" id="itemsCAR_NUMBERrate_kasko" name="items[CAR_NUMBER][rate_kasko]" value="" maxlength="8" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" onchange="changeAmountKASKO(CAR_NUMBER)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
		<td><input type="text" id="itemsCAR_NUMBERamount_kasko" name="items[CAR_NUMBER][amount_kasko]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>
		<td><input type="text" id="itemsCAR_NUMBERrate_equipment" name="items[CAR_NUMBER][rate_equipment]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" onchange="changeAmountEquipment(CAR_NUMBER)" onchange="changeAmountEquipment(CAR_NUMBER)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
		<td><input type="text" id="itemsCAR_NUMBERamount_equipment" name="items[CAR_NUMBER][amount_equipment]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>
		<!--<td><input type="text" id="itemsCAR_NUMBERprice_accident" name="items[CAR_NUMBER][price_accident]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="changeAmountAccident(CAR_NUMBER)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
		<td><input type="text" id="itemsCAR_NUMBERrate_accident" name="items[CAR_NUMBER][rate_accident]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" onchange="changeAmountAccident(CAR_NUMBER)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
		<td><input type="text" id="itemsCAR_NUMBERamount_accident" name="items[CAR_NUMBER][amount_accident]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>-->
		<td><input type="text" id="itemsCAR_NUMBERamount" name="items[CAR_NUMBER][amount]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" style="color: #666666; background-color: #f5f5f5;" readonly title="itemsAmount" /></td>
	</tr>
	</table>
	<? if ($data['showCommission']) { ?>
	<div class="section">Комісійна винагорода:</div>
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr class="columns">
		<td>Агеція:</b></td>
		<td>Агент (без участі МП):</b></td>
		<td class="financialInstitutionCommission">Керiвник:</b></td>
		<td class="financialInstitutionCommission">Заст. керiвника:</b></td>
	</tr>
	<tr class="row1">
		<td>
			<input type="text" name="items[CAR_NUMBER][commission_agency_percent]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> /> %
		</td>
		<td>
			<input type="text" name="items[CAR_NUMBER][commission_agent_percent]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> /> %
		</td>
		
		<td class="financialInstitutionCommission">
			<input type="text" name="items[CAR_NUMBER][director1_commission_percent]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> /> %
		</td>
		<td class="financialInstitutionCommission">
			<input type="text" name="items[CAR_NUMBER][director2_commission_percent]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> /> %
		</td>
		
	</tr>
	</table>
	<?  } ?>
</div>
<? $Log->showSystem();?>
<?
if  ($action=='insert') {
	
	if ($Authorization->data['roles_id']==ROLES_AGENT  	&& $Authorization->data['ukravto']==1
		&& !in_array ( $Authorization->data['agencies_id'], array(206,52,55,56,848,15)  )
	) {}
	else {
		$Clients = new Clients($data);
		$Clients->getSearchForm($data);
	}
}
?>

<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" id="id" name="id" value="<?=$data['id']?>" />
	<input type="hidden" id="parent_id" name="parent_id" value="<?=intval($data['parent_id'])?>" />
	<input type="hidden" id="child_id" name="child_id" value="<?=intval($data['child_id'])?>" />
    <input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" name="types_id" id="types_id" value="<?=$data['types_id']?>" />
	<input type="hidden" name="changeMode" value="0" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" id="clients_id" name="clients_id" value="<?=$data['clients_id']?>" />
    <input type="hidden" id="drivers_id" name="drivers_id" value="<?=($data['drivers_id'] ? $data['drivers_id'] : 4)?>" />
    <input type="hidden" id="allowed_products_id" name="allowed_products_id" value="<?=$data['allowed_products_id']?>" />
	<input type="hidden" id="expert_period" name="expert_period" value="<?=$data['expert_period']?>" />
	<input type="hidden" id="agreement_types_id" name="agreement_types_id" value="<?=intval($data['agreement_types_id'])?>" />
	
	<input type="hidden" id="cons_agents_id" name="cons_agents_id" value="<?=intval($data['cons_agents_id'])?>" />
	

    <input type="hidden" name="policy_statuses_id_old" value="<?=($data['policy_statuses_id_old']) ? $data['policy_statuses_id_old'] : $data['policy_statuses_id']?>" />

	<?if ($data['next_policy_statuses_id']==POLICY_STATUSES_RENEW) {?>
	<input type="hidden" id="agents_id" name="agents_id" value="<?=intval($data['agents_id'])?>" />
	<?}?>
	<input type="hidden" id="next_policy_statuses_id" name="next_policy_statuses_id" value="<?=intval($data['next_policy_statuses_id'])?>" />
	
    <input type="hidden" name="amount_parent" value="<?=$data['amount_parent']?>" />
	<input type="hidden" name="max_bonus_malus" value="<?=doubleval($data['max_bonus_malus'])?>" />
	
	<input type="hidden" id="solutions_id" name="solutions_id" value="<?=intval($data['solutions_id'])?>" />
	<input type="hidden" id="states_id" name="states_id" value="<?=intval($data['states_id'])?>" />
	<input type="hidden" id="individual_motivation" name="individual_motivation" value="<?=intval($data['individual_motivation'])?>" />
	<input type="hidden" id="messages_id" name="messages_id" value="<?=intval($_GET['messages_id'])?>" />
	<? if ($data['axapta_id'])  {
	echo '<input type="hidden" id="axapta_id" name="axapta_id" value="' . $data['axapta_id'] . '" />';
	}
	?>
	<? if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW)  {
	echo '<input type="hidden" id="begin_datetime_parent_day" name="begin_datetime_parent_day" value="' . $data['begin_datetime_parent_day'] . '" />';
	echo '<input type="hidden" id="begin_datetime_parent_month" name="begin_datetime_parent_month" value="' . $data['begin_datetime_parent_month'] . '" />';
	echo '<input type="hidden" id="begin_datetime_parent_year" name="begin_datetime_parent_year" value="' . $data['begin_datetime_parent_year'] . '" />';
	
	echo '<input type="hidden" name="number" value="' . $data['number'] . '" />';

	}
	?>
	<? if ($this->mode != 'view' && ($data['agencies_id'] != AGENCIES_EXPRESS_INSURANCE || $data['types_id'] != POLICY_TYPES_QUOTE) && $data['next_policy_statuses_id'] != POLICY_STATUSES_RENEW) {?>
	<input type="hidden" id="date_day" name="date_day" value="<?=$data['date_day']?>" />
	<input type="hidden" id="date_month" name="date_month" value="<?=$data['date_month']?>" />
	<input type="hidden" id="date_year" name="date_year" value="<?=$data['date_year']?>" />
	<? } ?>
	<?if ($action=='update' || $data['ECmode']) {
		if ($data['ECmode']) $data['insurance_companies_id']=4;
	?>
	<input type="hidden" name="insurance_companies_id" value="<?=$data['insurance_companies_id']?>" />
	<?}?>
    <table cellpadding="2" cellspacing="3" width="100%">
	<tr>
		<td>
			<?
			if ($this->isRenew($data)) {
				//echo '<div  style="display:none">';
			}
			?>
			<div class="section">Параметри страхування:<?=($data['load_number'] ? ' Завантажено полiс '.$data['load_number'] : '')?></div>
			<table cellpadding="5" cellspacing="0">
			<tr>

				<td class="label grey">Програми страхування:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('express_products_id') ], $data['express_products_id'], $data['languageCode'], $this->getReadonly(true,$data['ECmode']) . ' onchange="changeExpressProduct()"', null, $data, $this->isEqual('express_products_id'))?></td>								
				
				<input type="hidden" name="insurance_companies_id" value="<?=(!$data['insurance_companies_id']  ? 4 : $data['insurance_companies_id'])?>" />
				
				<td class="label grey expressproduct"><?=$this->getMark()?>Кількість ТЗ:</td>
				<td class="expressproduct">
					<select id="cars_count" name="cars_count" onchange="setCarsCount();setRates(false);changeExpressProduct();" <?=$this->getReadonly(true)?> class="fldSelect<?=$this->isEqual('cars_count')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('cars_count')?>'" onblur="this.className='fldSelect<?=$this->isEqual('cars_count')?>'">
						<? for ($i=1;$i<=$max_cars;$i++) {?>
						<option value="<?=$i?>" <?=($data['cars_count'] == $i) ? 'selected' : ''?>><?=$i?></option>
						<?}?>
					</select>
				</td>
				<? if ($this->options['options_month500']) {?>
				<td>
					<table id="options_500Block" class="expressproduct" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%;color:Red">місяць страхування за 500 грн:</td>
						<td><div class="<?=$this->isEqual('options_month500')?>"><input onclick="set500Block()" type="checkbox" id="options_month500" name="options_month500" value="1" <?=($data['options_month500']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<?}?>
				<td width="100%" align="right">&nbsp;<?if ($this->mode != 'view' && $this->permissions['quote'] && $data['policy_statuses_id'] == POLICY_STATUSES_CREATED) {?><a href="javascript: changeMode()" style="color:#ff0066"><?=($this->subMode == 'calculate') ? 'Перейти у режим "Котирування"' : 'Вийти з режиму "Котирування"'?></a><? } ?></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td id="driversCount1" class="label grey expressproduct"><?=$this->getMark()?>Кількість осіб:</td>
				<td id="driversCount2" class="expressproduct">
					<select id="number_drivers" name="number_drivers" onchange="setDriversId()" <?=$this->getReadonly(true)?> class="fldSelect<?=$this->isEqual('number_drivers')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('number_drivers')?>'" onblur="this.className='fldSelect<?=$this->isEqual('number_drivers')?>'">
						<? for ($i=1;$i<=5;$i++) {?>
						<option value="<?=$i?>" <?=($data['number_drivers'] == $i) ? 'selected' : ''?>><?=$i?></option>
						<? } ?>
						<option value="0" <?=($data['number_drivers'] == 0) ? 'selected' : ''?>>будь-яка особа на законних підставах</option>
					</select>
				</td>
				<td class="label grey expressproduct expressproduct3"><?=$this->getMark()?>Зона дії полісу:</td>
				<td class="expressproduct expressproduct3"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('zones_id') ], $data['zones_id'], $data['languageCode'], ' ' .$this->getReadonly(true), null, $data, $this->isEqual('zones_id'));?></td>
				<? if ($Authorization->data['roles_id']!=ROLES_AGENT || $Authorization->data['alternative']==1 || intval($_SESSION['auth']['agent_financial_institutions_id'])==34 || $Authorization->data['top_agencies_id'] == 1469) {?>
				<td class="label grey">стороннiй клієнт:</td>
				<td><input type="checkbox" id="options_second_year" name="options_second_year" value="1" <?=($data['options_second_year']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
				<?}else {?>
				<input type="hidden" id="options_second_year" name="options_second_year" value="<?=($data['options_second_year'])?>" />
				<?}?>
			</tr>
			</table>
			
			<table cellpadding="5" cellspacing="0" id="standingsBlock" <?=(($data['insurer_person_types_id'] == 2 || $data['drivers_id'] == 7) ? 'style="display: none"' : '')?>>
			<tr>
				<td class="label grey expressproduct"><?=$this->getMark()?>Мінімальний водійський стаж з усіх, хто буде керувати автомобілем:</td>
				<td class="expressproduct"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_standings_id') ], $data['driver_standings_id' ], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('driver_standings_id'))?></td>
				<td class="label grey expressproduct"><?=$this->getMark(false)?>Мінімальний вік водія з усіх, хто буде керувати автомобілем:</td>
				<td class="expressproduct"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_ages_id') ], $data['driver_ages_id' ], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('driver_ages_id'))?></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey expressproduct bankblock">Банк:</td>
				<td class="expressproduct bankblock">
					<?
						$field = $this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ];
						if ($data['ECmode']) {
							$field['name'] .= '_temp';
							echo '<input type="hidden" id="financial_institutions_id" name="financial_institutions_id" value="' . $data['financial_institutions_id'] . '" />';
							echo $this->buildSelect($field, $data['financial_institutions_id'], $data['languageCode'], 'onchange="changeFinancialInstitution()" disabled', null, $data, $this->isEqual('financial_institutions_id'));
						} else {
							echo $this->buildSelect($field, $data['financial_institutions_id'], $data['languageCode'], 'onchange="changeFinancialInstitution()" ' .$this->getReadonly(true), null, $data, $this->isEqual('financial_institutions_id'));
						}
					?>
				</td>
				<td class="label grey"><?=$this->getMark()?>Місце реєстрації:</td><td class="label grey testdriveproduct testdriveregion" style="display:none"><?=$this->getMark()?>Регіон використання ТЗ:<td>
				<td class="testdriveproduct"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('registration_cities_id') ], $data['registration_cities_id' ], $data['languageCode'], 'style="width: 200px" onchange="changeCity();" ' . $this->getReadonly(true), null, $data, $this->isEqual('registration_cities_id'))?></td>
				<td id="registration_cities_title" style="display: <?=($data['registration_cities_id'] == CITIES_OTHER) ? 'block' : 'none'?>"><input type="text" name="registration_cities_title" value="<?=$data['registration_cities_title']?>" maxlength="50" class="fldText city<?=$this->isEqual('registration_cities_title')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('registration_cities_title')?>'" onblur="this.className='fldText city<?=$this->isEqual('registration_cities_title')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey expressproduct"><?=$this->getMark(false)?>Місце зберігання ТЗ:</td>
				<td class="expressproduct"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('residences_id') ], $data['residences_id' ], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('residences_id'))?></td>
			</tr>
			</table>

			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey expressproduct testdriveproduct"><?=$this->getMark(false)?>Термін страхування:</td>
				<td class="expressproduct testdriveproduct"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ], $data['terms_id' ], $data['languageCode'], 'onchange="setEnd(); clearProductsBlocks(); set500Block();checkPayment_brakedown();" ' . $this->getReadonly(true).($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? ' disabled':''), null, $data, $this->isEqual('terms_id'))?><?=($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? ' <input type="hidden" name="terms_id" value="'.$data['terms_id'].'" />':'')?></td>
				<td class="label grey termsYears expressproduct testdriveproduct"><?=$this->getMark(false)?>Період співпраці за договором:</td>
				<td class="termsYears expressproduct testdriveproduct"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('terms_years_id') ], $data['terms_years_id' ], $data['languageCode'], 'onchange="setEnd(); clearProductsBlocks();setTermsYears();set500Block();checkPayment_brakedown();" ' . $this->getReadonly(true), null, $data, $this->isEqual('terms_years_id'))?></td>
				
				<td class="expressproduct4">
					<table id="additionalConditions" cellpadding="5" cellspacing="0" style="display: <?=($data['financial_institutions_id']) ? 'none' : 'block'?>">
					<tr>
						<td class="label grey"><?=$this->getMark()?>Пріоритет виплати:</td>
						<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('priority_payments_id') ], $data['priority_payments_id' ], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('priority_payments_id'))?></td>
					</tr>
					</table>
				</td>
				<? if ($this->options['options_test_drive']) {?>
				<td class="expressproduct testdriveproduct">
					<table id="options_guilty_noBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">тест драйв:</td>
						<td><div class="<?=$this->isEqual('options_test_drive')?>"><input type="checkbox" id="options_test_drive" name="options_test_drive" value="1" <?=($data['options_test_drive']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<?} 
				if ($this->options['options_race']) { ?>
				<td class="expressproduct testdriveproduct">
					<table id="options_raceBlock" width="100%" cellpadding="0" cellspacing="5"  class="expressproduct">
					<tr>
						<td class="label grey" style="width:100%">перегон:</td>
						<td><div class="<?=$this->isEqual('options_race')?>"><input type="checkbox" id="options_race" name="options_race" onclick="showDestinationBlock()" value="1" <?=($data['options_race']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<?}?>
			</tr>
			</table>
			
			<table cellpadding="5" cellspacing="0" class="propertyplace">
			<tr>
				<td class="label grey">Адреса місцезнаходження ТЗ в період його знаходження в нерухливому стані з 01.12. по 31.03 :</td>
				<td><input type="text"   name="propertyplace" value="<?=$data['propertyplace']?>" maxlength="150" class="fldText lastname<?=$this->isEqual('propertyplace')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('propertyplace')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('propertyplace')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			
			<table cellpadding="5" cellspacing="0" class="testdriveroute">
			<tr>
				<td class="label grey">Пункт відправки:</td>
				<td><input type="text"   name="startplace" value="<?=$data['startplace']?>" maxlength="150" class="fldText lastname<?=$this->isEqual('startplace')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('startplace')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('startplace')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">Пункт прибуття:</td>
				<td><input type="text"   name="endplace" value="<?=$data['endplace']?>" maxlength="150" class="fldText lastname<?=$this->isEqual('endplace')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('endplace')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('endplace')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			<tr>
				<td class="label grey">Автомобільна траса:</td>
				<td><input type="text"   name="testdriveroad" value="<?=$data['testdriveroad']?>" maxlength="150" class="fldText lastname<?=$this->isEqual('testdriveroad')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('testdriveroad')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('testdriveroad')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">Міста, розташовані за маршрутом руху:</td>
				<td><input type="text"   name="testdrivecities" value="<?=$data['testdrivecities']?>" maxlength="150" class="fldText lastname<?=$this->isEqual('testdrivecities')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('testdrivecities')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('testdrivecities')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			
			
			<?=ParametersRisks::getListPolicy($data['product_types_id'], $data, $this->getReadonly(true))?>
			<table id="optionsBlock" cellpadding="0" cellspacing="0" class="expressproduct">
			<tr>
				<td>
					<table id="options_deterioration_noBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">без врахування зносу:</td>
						<td><div class="<?=$this->isEqual('options_deterioration_no')?>"><input type="checkbox"  onclick="checkYear()" id="options_deterioration_no" name="options_deterioration_no" value="1" <?=($data['options_deterioration_no']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<td>
					<table id="options_deductible_glass_noBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">без франшизи на вітрові стекла:</td>
						<td><div class="<?=$this->isEqual('options_deductible_glass_no')?>"><input type="checkbox" id="options_deductible_glass_no" name="options_deductible_glass_no" value="1" <?=($data['options_deductible_glass_no']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<td>
					<table id="options_taxyBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">страхування таксі:</td>
						<td><div class="<?=$this->isEqual('options_taxy')?>"><input type="checkbox" id="options_taxy" name="options_taxy" value="1" <?=($data['options_taxy']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<td>
					<table id="options_agregate_noBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">неагрегатна страхова сума:</td>
						<td><div class="<?=$this->isEqual('options_agregate_no')?>"><input type="checkbox" id="options_agregate_no" name="options_agregate_no" value="1" <?=($data['options_agregate_no']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<td>
					<table id="options_workers_listBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">водії підприємства згідно наказу:</td>
						<td><div class="<?=$this->isEqual('options_workers_list')?>"><input type="checkbox" id="options_workers_list" name="options_workers_list" value="1" <?=($data['options_workers_list']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<? if ($this->options['options_fifty_fifty']) { ?>
                <td>
					<table id="options_fifty_fifty_Block" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td id="options_fifty_fifty_label" class="label grey" style="width:100%">50 на 50:</td>
						<td><div class="<?=$this->isEqual('options_fifty_fifty')?>"><input onclick="set500Block()" type="checkbox" id="options_fifty_fifty" name="options_fifty_fifty" value="1" <?=($data['options_fifty_fifty']) ? 'checked' : ''?> <?=($data['financial_institutions_id'] > 0 ? 'disabled' : '')?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
				<?}?>
                <!--td>
					<table id="options_mileage_car_Block" width="100%" cellpadding="0" cellspacing="5">
                        <tr>
                            <td class="label grey" style="width:100%">пробіг авто:</td>
                            <td>
                                <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mileage_car_id') ], $data['mileage_car_id'], $data['languageCode'], ' ' .$this->getReadonly(true), null, $data, $this->isEqual('mileage_car_id'));?>
                            </td>
                        </tr>
					</table>
				</td-->
			</tr>
<!--
			<tr>
				<td>
					<table id="options_first_accidentBlock" width="100%" cellpadding="0" cellspacing="5">
						<tr>
							<td class="label grey" style="width:100%">перший страховий випадок:</td>
							<td><div class="<?=$this->isEqual('options_first_accident')?>"><input type="checkbox" id="options_first_accident" name="options_first_accident" value="1" <?=($data['options_first_accident']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
						</tr>
					</table>
				</td>
				<td>
					<table id="options_yearsBlock" width="100%" cellpadding="0" cellspacing="5">
						<tr>
							<td class="label grey" style="width:100%">страхування ТЗ віком більше 8 років:</td>
							<td><div class="<?=$this->isEqual('options_years')?>"><input type="checkbox" id="options_years" name="options_years" value="1" enabled="false" <?=($data['options_years']) ? 'checked' : ''?> disabled /></div></td>
						</tr>
					</table>
				</td>
				<td>
					<table id="options_holidayBlock" width="100%" cellpadding="0" cellspacing="5">
						<tr>
							<td class="label grey" style="width:100%">вихідний день:</td>
							<td><div class="<?=$this->isEqual('options_work')?>"><input type="checkbox" onclick="document.getElementById('options_work').checked=false" id="options_holiday" name="options_holiday" value="1" <?=($data['options_holiday']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
						</tr>
					</table>
				</td>
				<td>
					<table id="options_workBlock" width="100%" cellpadding="0" cellspacing="5">
						<tr>
							<td class="label grey" style="width:100%">робочий день:</td>
							<td><div class="<?=$this->isEqual('options_holiday')?>"><input type="checkbox" onclick="document.getElementById('options_holiday').checked=false" id="options_work" name="options_work" value="1" <?=($data['options_work']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
						</tr>
					</table>
				</td>
				<td>
					<table id="options_seasonBlock" width="100%" cellpadding="0" cellspacing="5">
						<tr>
							<td class="label grey" style="width:100%">сезон:</td>
							<td><div class="<?=$this->isEqual('options_season')?>"><input type="checkbox" id="options_season" name="options_season" value="1" <?=($data['options_season']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
						</tr>
					</table>
				</td>
			</tr>
-->
			</table>
			<?
			//if ($this->isRenew($data)) {echo '</div>';}
			?>
			<div id="infoDocumentDescriptionDiv" style="padding-left:10px;">
				<b>Додатковi умови по договору:</b>
				<span id="infoDocumentDescription"><?=$data['document_info']?></span>
			</div>
			<input type="hidden" id="document_info" name="document_info" value="<?=$data['document_info']?>" />
			
			<div class="testDriveDescription" style="padding-left:10px; display:none">
			<b class="testDriveDescription1">Опис: Тест драйв 1 типу проводиться клієнтами  у присутності співробітника страхувальника</b>
			<b class="testDriveDescription2">Опис: Тест-драйв 2 типу проводиться клієнтами – юридичними особами самостійно в порядку та на умовах, визначених відповідною Угодою щодо проведення тест-драйвів автомобілів</b>
			<b class="testDriveDescription3">Опис: Тест драйв 3 типу проводиться клієнтами-представниками засобів масової інформації (ЗМІ) самостійно в порядку та на умовах, визначених договором оренди</b>
			</div>
			<?
				for ($i=0; $i<$max_cars; $i++) {
					$bgcolor= ($i % 2 == 0) ? '#F0F0F0' : '#FFFFFF';
					echo '<div id="car' . $i . '" style="padding: 5px; background: ' . $bgcolor . ';' . (is_array($data['items'][ $i ]) ? 'display: block;':'display: none;') . '">';

					//**********************************************************************
					if (is_array($data['items'][ $i ])) {
						$item = $data['items'][ $i ];
			?>
			<div class="section">
				<input type="hidden" name="items[<?=$i?>][id]" value="<?=($action!='insert' ? $item['id'] : '')?>" />
				<input type="hidden" id="items<?=$i?>related_products_id" name="items[<?=$i?>][related_products_id]" value="<?=$item['related_products_id']?>" />
				Дані щодо автомобіля <?=($i+1)?>:
				<span class="label grey"><?=$this->getMark()?><b>Тип ТЗ:</b></span>
				<span>
					<select id="items<?=$i?>car_types_id" onchange="changeCarType(this);" name="items[<?=$i?>][car_types_id]" class="fldSelect<?=$this->isEqual('items|' . $i . '|car_types_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|car_types_id')?>'" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|car_types_id')?>'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->car_types_id as $id => $row) {
								echo '<option '.($item['car_types_id'] == $id ? 'selected':'').' value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</span>
				<span class="label grey"><?=$this->getMark()?><b>Марка:</b></span>
				<span><select id="items<?=$i?>brands_id" name="items[<?=$i?>][brands_id]" onchange="changeBrand(document.getElementById('items<?=$i?>car_types_id'));" class="fldSelect<?=$this->isEqual('items|' . $i . '|brands_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|brands_id')?>';" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|brands_id')?>';" <?=$this->getReadonly(true)?>><?if (ereg('^view', $action)) {echo '<option value="">'.$item['brand'].'</option>';}?></select></span>
				<span class="label grey"><?=$this->getMark()?><b>Модель:</b></span>
				<span><select id="items<?=$i?>models_id" name="items[<?=$i?>][models_id]" class="fldSelect<?=$this->isEqual('items|' . $i . '|models_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|models_id')?>';" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|models_id')?>';" <?=$this->getReadonly(true)?>><?if (ereg('^view', $action)) {echo '<option value="">'.$item['model'].'</option>';}?></select></span>
			 	<?if ($i>0 && $this->mode != 'view') {?><A href="#" onclick="document.getElementById('car<?=$i?>').innerHTML = '';document.getElementById('car<?=$i?>').style.display = 'none';return false;"><img src="/images/administration/navigation/delete_over.gif" width="14" height="14" alt="Вилучити"  /></a><?}?>
			</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Страхова вартість, грн:</td>
				<td><input type="text" id="items<?=$i?>car_price" name="items[<?=$i?>][car_price]" value="<?=$item['car_price']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|car_price')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|car_price')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|car_price')?>';" onchange="changeAmountKASKO(<?=$i?>)" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
				
				<td class="label grey marketpriceblock"><?=$this->getMark()?>Ринкова вартість, грн:</td>
				<td class="marketpriceblock"><input type="text" id="items<?=$i?>market_price" name="items[<?=$i?>][market_price]" value="<?=doubleval($item['market_price'])?>" maxlength="10" class="fldMoney market_price_input" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"   <?=$this->getReadonly(false, $data['ECmode'])?> <?if ($_SESSION['auth']['roles_id'] == ROLES_AGENT) echo 'readonly'; ?>/></td>
		
				<td class="label grey expressproduct expressproductidea">*Об'єм двигуна, см<sup>3</sup>:</td>
				<td class="expressproduct expressproductidea"><input type="text" id="items<?=$i?>engine_size" name="items[<?=$i?>][engine_size]" value="<?=$item['engine_size']?>" maxlength="8" class="fldText flat<?=$this->isEqual('items|' . $i . '|engine_size')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('items|' . $i . '|engine_size')?>'" onblur="this.className='fldText flat<?=$this->isEqual('items|' . $i . '|engine_size')?>'" <?=$this->getReadonly(false, $data['ECmode'])?> <?=$this->getRenew($data)?>/></td>

				<td class="label grey"><?=$this->getMark()?>Рік випуску:</td>
				<td><input type="text" id="items<?=$i?>year" name="items[<?=$i?>][year]" onchange="checkYear()" value="<?=$item['year']?>" maxlength="4" class="fldYear<?=$this->isEqual('items|' . $i . '|year')?>" onfocus="this.className='fldYearOver<?=$this->isEqual('items|' . $i . '|year')?>'" onblur="this.className='fldYear<?=$this->isEqual('items|' . $i . '|year')?>'" <?=$this->getReadonly(false, $data['ECmode'])?> <?=$this->getRenew($data)?>/></td>
				<td class="label grey"><?=$this->getMark()?><?=$this->getLink('Пробіг, тис. км.','items'.$i.'race',fldText)?>:</td>
				<td class=""><input type="text" id="items<?=$i?>race" name="items[<?=$i?>][race]" value="<?=$item['race']?>" maxlength="10" class="fldText number<?=$this->isEqual('items|' . $i . '|race')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('items|' . $i . '|race')?>'" onblur="this.className='fldText number<?=$this->isEqual('items|' . $i . '|race')?>'"  /><?if ($this->mode == 'view') {?>&nbsp;&nbsp;<a href="JavaScript:changeRace()"><b>Змiнити</b></a><?}?></td>
				
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey expressproduct expressproductidea">*Колір:</td>
				<td class="expressproduct expressproductidea">
					<?
						if ($data['ECmode']) {
							$field['name'] .= '_temp';
							echo '<input type="hidden" name="items['.$i.'][colors_id]" value="' . $item['colors_id'] . '" />';
						}
					?>
					 <select id="items<?=$i?>colors_id" name="items[<?=$i?>][colors_id<?=($data['ECmode'] ? '_temp':'')?>]" class="fldSelect<?=$this->isEqual('items|' . $i . '|colors_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|colors_id')?>'" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|colors_id')?>'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->colors_id as $id => $row) {
								echo '<option '.($item['colors_id']==$id ? 'selected':'').' value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</td>
				<td class="label grey expressproduct"><?=$this->getMark(false)?>Кількість місць:</td>
				<td class="expressproduct"><input id="items<?=$i?>number_places" type="text" name="items[<?=$i?>][number_places]" value="<?=$item['number_places']?>" maxlength="2" class="fldInteger<?=$this->isEqual('items|' . $i . '|number_places')?>" onfocus="this.className='fldIntegerOver<?=$this->isEqual('items|' . $i . '|number_places')?>'" onblur="this.className='fldInteger<?=$this->isEqual('items|' . $i . '|number_places')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
				<td class="label grey">*<?=$this->getLink('№ шасі (кузов, рама)','items'.$i.'shassi',fldText)?>:</td>
				<td><input type="text" id="items<?=$i?>shassi" name="items[<?=$i?>][shassi]" value="<?=$item['shassi']?>" maxlength="40" class="fldText shassi<?=$this->isEqual('items|' . $i . '|shassi')?>" onfocus="this.className='fldTextOver shassi<?=$this->isEqual('items|' . $i . '|shassi')?>'" onblur="this.className='fldText shassi<?=$this->isEqual('items|' . $i . '|shassi')?>'" <?=$this->getReadonly(false, $data['ECmode'])?> <?=$this->getRenew($data)?>/></td>
				<td class="label grey"><?=$this->getLink('Державний знак (реєстраційний №)','items'.$i.'sign',fldText)?>:</td>
				<td><input type="text" id="items<?=$i?>sign" name="items[<?=$i?>][sign]" value="<?=$item['sign']?>" maxlength="10" class="fldText number<?=$this->isEqual('items|' . $i . '|sign')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('items|' . $i . '|sign')?>'" onblur="this.className='fldText number<?=$this->isEqual('items|' . $i . '|sign')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
			</tr>
			<tr>
				<td>*КПП:</td>
				<td>
					<select id="items<?=$i?>transmissions_id" name="items[<?=$i?>][transmissions_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->transmissions as $id => $row) {
								echo '<option ' . ($item['transmissions_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</td>
				<td class="items<?=$i?>bodyType">*Тип кузова:</td>
				<td class="items<?=$i?>bodyType">
					<select id="items<?=$i?>car_body_id" name="items[<?=$i?>][car_body_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->car_body as $id => $row) {
								echo '<option ' . ($item['car_body_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</td>
				<td>*Топливо:</td>
				<td>
					<select id="items<?=$i?>car_engine_type_id" name="items[<?=$i?>][car_engine_type_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->car_engine_type as $id => $row) {
								echo '<option ' . ($item['car_engine_type_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</td>
				<td class="label grey"><?=$this->getLink('Модифікація','items'.$i.'modification',fldText)?>:</td>
				<td><input type="text" id="items<?=$i?>modification" name="items[<?=$i?>][modification]" value="<?=$item['modification']?>" maxlength="40" class="fldText modification<?=$this->isEqual('items|' . $i . '|modification')?>" onfocus="this.className='fldTextOver modification<?=$this->isEqual('items|' . $i . '|modification')?>'" onblur="this.className='fldText modification<?=$this->isEqual('items|' . $i . '|modification')?>'" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0" class="expressproduct testdriveproduct expressproduct3">
				<tr>
					<td class="label grey">Засоби захисту:</td>
					<td class="label grey">Mul-T-Lock:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_multlock')?>"><input type="checkbox" id="items<?=$i?>protection_multlock" name="items[<?=$i?>][protection_multlock]" value="1" <?=($item['no_immobiliser']) ? 'disabled' : ''?> <?=($item['protection_multlock']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					<td class="label grey">Immobilaser:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_immobilaser')?>"><input type="checkbox" id="items<?=$i?>protection_immobilaser" name="items[<?=$i?>][protection_immobilaser]" value="1" <?=($item['no_immobiliser']) ? 'disabled' : ''?> <?=($item['protection_immobilaser']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					<td class="label grey">Механічна:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_manual')?>"><input type="checkbox" id="items<?=$i?>protection_manual" name="items[<?=$i?>][protection_manual]" value="1" <?=($item['no_immobiliser']) ? 'disabled' : ''?> <?=($item['protection_manual']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					<td class="label grey">Сигналізація:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_signalling')?>"><input type="checkbox" id="items<?=$i?>protection_signalling" name="items[<?=$i?>][protection_signalling]" value="1" <?=($item['no_immobiliser']) ? 'disabled' : ''?> <?=($item['protection_signalling']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
                    <td class="label grey">Страхування без протиугінного пристрою:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|no_immobiliser')?>"><input type="checkbox" id="items<?=$i?>no_immobiliser" name="items[<?=$i?>][no_immobiliser]" value="1" <?=($item['no_immobiliser']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> onChange="changeNoImmobiliser(this.checked, <?=$i?>)"/></div></td>
				</tr>
			</table>
			<div id="destinationBlock" class="destinationBlock" <?=(intval($data['options_race'])==0 ?'style="display: none;"' : '')?>>
				<table  cellpadding="0" cellspacing="0" >
				<tr>
					<td class="label grey"><?=$this->getMark()?>Маршрут:</td>
					<td><input type="text" name="items[<?=$i?>][route]" value="<?=$item['route']?>" maxlength="250" class="fldText<?=$this->isEqual('items|' . $i . '|route')?>" onfocus="this.className='fldTextOver<?=$this->isEqual('items|' . $i . '|route')?>'" onblur="this.className='fldText<?=$this->isEqual('items|' . $i . '|route')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
			</div><br />
            <div class="other_policiesBlock">
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey" valign="top">Діючі договори:</td>
                        <td><textarea rows="1" cols="150" id="items<?=$i?>other_policies" name="items[<?=$i?>][other_policies]" class="fldTextArea" onfocus="this.className='fldTextAreaOver'" onblur="this.className='fldTextArea'" <?=$this->getReadonly(false)?>><?=$item['other_policies']?></textarea></td>
                    </tr>
                </table>
            </div>
            <div class="order_basis_carBlock">
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td><b>Розпорядження (користування) ТЗ на підставі:</b></td>
                        <td><input type="radio" name="items[<?=$i?>][order_basis_car_id]" value="1" <?if ($item['order_basis_car_id']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />права власності</td>
                        <td><input type="radio" name="items[<?=$i?>][order_basis_car_id]" value="2" <?if ($item['order_basis_car_id']==2) echo 'checked';?> <?=$this->getReadonly(true)?> />оренди</td>
                        <td><input type="radio" name="items[<?=$i?>][order_basis_car_id]" value="3" <?if ($item['order_basis_car_id']==3) echo 'checked';?> <?=$this->getReadonly(true)?> />доручення</td>
                        <td><input type="radio" name="items[<?=$i?>][order_basis_car_id]" value="4" <?if ($item['order_basis_car_id']==4) echo 'checked';?> <?=$this->getReadonly(true)?> />лізингу</td>
                    </tr>
                </table>
            </div>
            <div class="use_as_carBlock">
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td><b>Використання ТЗ в якості:</b></td>
                        <td><input id="items<?=$i?>use_as_car_private" type="checkbox" name="items[<?=$i?>][use_as_car_private]" value="1" <?if ($item['use_as_car_private']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />в особистих цілях</td>
                        <td><input id="items<?=$i?>use_as_car_work" type="checkbox" name="items[<?=$i?>][use_as_car_work]" value="2" <?if ($item['use_as_car_work']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />в робочих цілях</td>
                        <td><input id="items<?=$i?>use_as_car_leasing" type="checkbox" name="items[<?=$i?>][use_as_car_leasing]" value="4" <?if ($item['use_as_car_leasing']==1) echo 'checked';?> <?=$this->getReadonly(true)?> />оренда, лізинг</td>
                    </tr>
                </table>
            </div>

			<div class="section">Додаткове обладнання:</div>
			<table id="equipment<?=$i?>" cellpadding="5" cellspacing="0" width="100%">
			<tr class="columns">
				<td>Найменування</td>
				<td>Марка</td>
				<td>Модель</td>
				<td>Вартість, грн.</td>
				<? if ($this->mode != 'view') { ?><td width="25" style="padding: 0px 0px 0px 10px; text-align: center;" class="addeqip"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addEquipment(this,<?=$i?>)" /></td><? } ?>
			</tr>
			<?
				if (is_array($item['equipment'])) {
					foreach ($item['equipment'] as $j => $equipment) {
			?>
			<tr>
				<td><input type="text" name="items[<?=$i?>][equipment][<?=$j?>][title]" value="<?=$equipment['title']?>" maxlength="50" class="fldText<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|title')?>" onfocus="this.className='fldTextOver<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|title')?>';" onblur="this.className='fldText<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|title')?>';" <?=$this->getReadonly(false)?> /></td>
				<td><input type="text" name="items[<?=$i?>][equipment][<?=$j?>][brand]" value="<?=$equipment['brand']?>" maxlength="20" class="fldText<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|brand')?>" onfocus="this.className='fldTextOver<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|brand')?>';" onblur="this.className='fldText<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|brand')?>';" <?=$this->getReadonly(false)?> /></td>
				<td><input type="text" name="items[<?=$i?>][equipment][<?=$j?>][model]" value="<?=$equipment['model']?>" maxlength="20" class="fldText<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|model')?>" onfocus="this.className='fldTextOver<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|model')?>';" onblur="this.className='fldText<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|model')?>';" <?=$this->getReadonly(false)?> /></td>
				<td><input type="text" name="items[<?=$i?>][equipment][<?=$j?>][price]" value="<?=$equipment['price']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|price')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|price')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|equipment|' . $j . '|price')?>';" onchange="changeAmountEquipment(<?=$i?>)" <?=$this->getReadonly(false)?> title="items<?=$i?>EquipmentPrice" /></td>
				<? if ($this->mode != 'view') { ?><td><a href="#" onclick="deleteEquipment(this,<?=$i?>)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
			</tr>
			<?
					}
				}
			?>
			</table>

			<div class="section" id="searchprodbutton">Страховий продукт: <? if ($this->mode == 'view' && $Authorization->data['roles_id']!=ROLES_AGENT ) {?><?=$item['products_title']?><?}?> <? if ($this->mode != 'view') {?><input  type="button" value=" Знайти " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="getProductsBlock(<?=$i?>);" /><? } ?></div>
			<?
			if (($Authorization->data['id']==1 || $Authorization->data['id']==11456 || $Authorization->data['id']==13680 || $Authorization->data['id']==3526 || $Authorization->data['id']==3909 || $Authorization->data['id']==6659 || $Authorization->data['id']==3193 || $Authorization->data['id']==11467 || $Authorization->data['id']==4748 || $Authorization->data['id']==13097 || $Authorization->data['id']==6236) && $this->mode == 'view') echo 'Формула: '.$item['formula'];
			?>
			<div id="products<?=$i?>"></div>

			<div class="section">Параметри:</div>
			<input type="hidden" id="items<?=$i?>products_id" name="items[<?=$i?>][products_id]" value="<?=$item['products_id']?>" title="products_id" />
			<table width="100%" cellpadding="0" cellspacing="0" >
			<tr class="columns">
				<td>Інші ризики</td>
				<td>Незаконне заволодіння</td>
				<td>КАСКО, тариф, %</td>
				<td>КАСКО, премія, грн.</td>
				<td>ДО, тариф, %</td>
				<td>ДО, премія, грн.</td>
				<!--<td>НС, страхова сума, грн.</td>
				<td>НС, тариф, %</td>
				<td>НС, премія, грн.</td>-->
				<td>Тариф, грн.</td>
			</tr>
			<tr class="row1">
				<td><input type="text" id="items<?=$i?>deductibles_value0" name="items[<?=$i?>][deductibles_value0]" value="<?=$item['deductibles_value0']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value0')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|deductibles_value0')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value0')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute0')?>"><input type="radio" id="items<?=$i?>deductibles_absolute0Percent" name="items[<?=$i?>][deductibles_absolute0]" value="0" <?=($item['deductibles_absolute0'] == 0) ? 'checked' : ''?> <?=$this->getReadonlyRadio(false, $this->subMode == 'calculate')?> /></span>% <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute0')?>"><input type="radio" id="items<?=$i?>deductibles_absolute0Amount" name="items[<?=$i?>][deductibles_absolute0]" value="1" <?=($item['deductibles_absolute0'] == 1) ? 'checked' : ''?> <?=$this->getReadonlyRadio(false, $this->subMode == 'calculate')?> /></span> грн.</td>
				<td><input type="text" id="items<?=$i?>deductibles_value1" name="items[<?=$i?>][deductibles_value1]" value="<?=$item['deductibles_value1']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value1')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|deductibles_value1')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value1')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute1')?>"><input type="radio" id="items<?=$i?>deductibles_absolute1Percent" name="items[<?=$i?>][deductibles_absolute1]" value="0" <?=($item['deductibles_absolute1'] == 0) ? 'checked' : ''?> <?=$this->getReadonlyRadio(false, $this->subMode == 'calculate')?> /></span>% <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute1')?>"><input type="radio" id="items<?=$i?>deductibles_absolute1Amount" name="items[<?=$i?>][deductibles_absolute1]" value="1" <?=($item['deductibles_absolute1'] == 1) ? 'checked' : ''?> <?=$this->getReadonlyRadio(false, $this->subMode == 'calculate')?> /></span> грн.</td>
				<td><input type="text" id="items<?=$i?>rate_kasko" name="items[<?=$i?>][rate_kasko]" value="<?=$item['rate_kasko']?>" maxlength="8" class="fldPercent<?=$this->isEqual('items|' . $i . '|rate_kasko')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|rate_kasko')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|rate_kasko')?>';" onchange="changeAmountKASKO(<?=$i?>)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> />  <? if ($data['agreement_types_id']==3 && !ereg('^view', $action)) { ?><a href="JavaScript:calculateRenewInsuranceAmount($('#items0car_price').val())"><img src="/images/reload.png" width="16" height="16" alt="Оновити" /></a><?}?></td>
				<td><input type="text" id="items<?=$i?>amount_kasko" name="items[<?=$i?>][amount_kasko]" value="<?=$item['amount_kasko']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|amount_kasko')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|amount_kasko')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|amount_kasko')?>';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>
				<td><input type="text" id="items<?=$i?>rate_equipment" name="items[<?=$i?>][rate_equipment]" value="<?=$item['rate_equipment']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|rate_equipment')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|rate_equipment')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|rate_equipment')?>';" onchange="changeAmountEquipment(<?=$i?>)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
				<td><input type="text" id="items<?=$i?>amount_equipment" name="items[<?=$i?>][amount_equipment]" value="<?=$item['amount_equipment']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|amount_equipment')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|amount_equipment')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|amount_equipment')?>';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>
				<!--<td><input type="text" id="items<?=$i?>price_accident" name="items[<?=$i?>][price_accident]" value="<?=$item['price_accident']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|price_accident')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|price_accident')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|price_accident')?>';" onchange="changeAmountAccident(<?=$i?>)" <?=$this->getReadonly(false, false)?> /></td>
				<td><input type="text" id="items<?=$i?>rate_accident" name="items[<?=$i?>][rate_accident]" value="<?=$item['rate_accident']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|rate_accident')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|rate_accident')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|rate_accident')?>';" onchange="changeAmountAccident(<?=$i?>)" <?=$this->getReadonly(false, false)?> /></td>
				<td><input type="text" id="items<?=$i?>amount_accident" name="items[<?=$i?>][amount_accident]" value="<?=$item['amount_accident']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|amount_accident')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|amount_accident')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|amount_accident')?>';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>-->
				<td><input type="text" id="items<?=$i?>amount" name="items[<?=$i?>][amount]" value="<?=$item['amount']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|amount')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|amount')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|amount')?>';" style="color: #666666; background-color: #f5f5f5;" readonly title="itemsAmount" /></td>
			</tr>
			</table>

			<? if ($data['showCommission']) { ?>
			<div class="section">Комісійна винагорода:</div>
			<table width="100%" cellpadding="0" cellspacing="0">
			<tr class="columns">
				<td>Агеція: </td>
				<td>Агент (без участі МП): </td>
				<td class="financialInstitutionCommission">Керiвник: </td>
				<td class="financialInstitutionCommission">Заст. керiвника: </td>
				<td>Менеджер що привiв клiєнта: </td>
				<td>Менеджер продавець: </td>
			</tr>
			<tr class="row1">
				<td>
					<input readonly type="text" name="items[<?=$i?>][commission_agency_percent]" value="<?=$item['commission_agency_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_agency_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_agency_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_agency_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<? if ($data['types_id'] == POLICY_TYPES_QUOTE) {?>
					Знижка<input type="text" name="items[<?=$i?>][commission_agency_discount_percent]" value="<?=$item['commission_agency_discount_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_agency_discount_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_agency_discount_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_agency_discount_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %					
					<?}?>
				</td>
				<td>
					<input readonly type="text" name="items[<?=$i?>][commission_agent_percent]" value="<?=$item['commission_agent_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_agent_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_agent_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_agent_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<? if ($data['types_id'] == POLICY_TYPES_QUOTE) {?>
					Знижка<input type="text" name="items[<?=$i?>][commission_agent_discount_percent]" value="<?=$item['commission_agent_discount_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_agent_discount_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_agent_discount_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_agent_discount_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %					
					<?}?>
				</td>
				<td class="financialInstitutionCommission">
					<input readonly type="text" name="items[<?=$i?>][director1_commission_percent]" value="<?=$item['director1_commission_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|director1_commission_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|director1_commission_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|director1_commission_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<? if ($data['types_id'] == POLICY_TYPES_QUOTE) {?>
					Знижка<input type="text" name="items[<?=$i?>][director1_commission_discount_percent]" value="<?=$item['director1_commission_discount_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|director1_commission_discount_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|director1_commission_discount_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|director1_commission_discount_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %					
					<?}?>
				</td>
				<td class="financialInstitutionCommission">
					<input readonly type="text" name="items[<?=$i?>][director2_commission_percent]" value="<?=$item['director2_commission_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|director2_commission_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|director2_commission_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|director2_commission_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<? if ($data['types_id'] == POLICY_TYPES_QUOTE) {?>
					Знижка<input type="text" name="items[<?=$i?>][director2_commission_discount_percent]" value="<?=$item['director2_commission_discount_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|director2_commission_discount_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|director2_commission_discount_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|director2_commission_discount_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<?}?>
				</td>
				
				<td>
					<input readonly type="text" name="items[<?=$i?>][commission_manager_percent]" value="<?=$item['commission_manager_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_manager_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_manager_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_manager_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<? if ($data['types_id'] == POLICY_TYPES_QUOTE) {?>
					Знижка<input type="text" name="items[<?=$i?>][commission_manager_discount_percent]" value="<?=$item['commission_manager_discount_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_manager_discount_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_manager_discount_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_manager_discount_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<?}?>
				</td>
				<td>
					<input readonly type="text" name="items[<?=$i?>][commission_seller_agents_percent]" value="<?=$item['commission_seller_agents_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_seller_agents_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_seller_agents_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_seller_agents_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %
					<? if ($data['types_id'] == POLICY_TYPES_QUOTE) {?>
					Знижка<input type="text" name="items[<?=$i?>][commission_seller_agents_discount_percent]" value="<?=$item['commission_seller_agents_discount_percent']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|commission_seller_agents_discount_percent')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|commission_seller_agents_discount_percent')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|commission_seller_agents_discount_percent')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> %					
					<?}?>
				</td>
			</tr>
			</table>
			<? } else { ?>
					<input   type="hidden" name="items[<?=$i?>][commission_agency_percent]" value="<?=$item['commission_agency_percent']?>"  /> 
					<input type="hidden" name="items[<?=$i?>][commission_agency_discount_percent]" value="<?=$item['commission_agency_discount_percent']?>"  />  				
					<input   type="hidden" name="items[<?=$i?>][commission_agent_percent]" value="<?=$item['commission_agent_percent']?>"/>  
					<input type="hidden" name="items[<?=$i?>][commission_agent_discount_percent]" value="<?=$item['commission_agent_discount_percent']?>"/>  					
					<input   type="hidden" name="items[<?=$i?>][director1_commission_percent]" value="<?=$item['director1_commission_percent']?>" />  
					<input type="hidden" name="items[<?=$i?>][director1_commission_discount_percent]" value="<?=$item['director1_commission_discount_percent']?>"/>  					
					<input   type="hidden" name="items[<?=$i?>][director2_commission_percent]" value="<?=$item['director2_commission_percent']?>" />  
					<input type="hidden" name="items[<?=$i?>][director2_commission_discount_percent]" value="<?=$item['director2_commission_discount_percent']?>"/>  
					<input   type="hidden" name="items[<?=$i?>][commission_manager_percent]" value="<?=$item['commission_manager_percent']?>" />  
					<input type="hidden" name="items[<?=$i?>][commission_manager_discount_percent]" value="<?=$item['commission_manager_discount_percent']?>" />  
					<input   type="hidden" name="items[<?=$i?>][commission_seller_agents_percent]" value="<?=$item['commission_seller_agents_percent']?>"/>  
					<input type="hidden" name="items[<?=$i?>][commission_seller_agents_discount_percent]" value="<?=$item['commission_seller_agents_discount_percent']?>"/> 					
			<?}?>
			<?
					}
					//**********************************************************************
					echo '</div>';
				}
			?>
			<table cellpadding="5" cellspacing="0" class="expressproduct1 testdriveproduct">
			<tr>
				<td  class="label grey"><b>Оплата:</b></td>
				<td><span class="<?=$this->isEqual('payment_brakedown_id')?>"><input type="radio" name="payment_brakedown_id" value="1" <?if ($data['payment_brakedown_id']==1) echo 'checked';?> onclick="set500Block();checkPayment_brakedown();setRates(false);" <?=$this->getReadonly(true)?> /></span> 1 платіж</td>
				<td><span class="<?=$this->isEqual('payment_brakedown_id')?>"><input type="radio" name="payment_brakedown_id" value="2" <?if ($data['payment_brakedown_id']==2) echo 'checked';?> onclick="set500Block();checkPayment_brakedown();setRates(false);"<?=$this->isEqual('payment_brakedown_id')?> <?=$this->getReadonly(true)?> /></span> 2 платежі</td>
				<td><span class="<?=$this->isEqual('payment_brakedown_id')?>"><input type="radio" name="payment_brakedown_id" value="3" <?if ($data['payment_brakedown_id']==3) echo 'checked';?> onclick="set500Block();checkPayment_brakedown();setRates(false);"<?=$this->isEqual('payment_brakedown_id')?> <?=$this->getReadonly(true)?> /></span> 4 платежі</td>
				<? if ($Authorization->data['id'] == 1 || $Authorization->data['permissions']['Policies_KASKO']['superupdate']) {?>
				<td>Инд. разбивка <input type="text" id="admin_payments_count" name="admin_payments_count" value="<?=$data['admin_payments_count']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'"/></td>
				<?}?>

				<td class="label grey expressproduct">Знижка агента, %:</td>
				
				<td class="expressproduct">
					<select id="discount" name="discount" <?=$this->getReadonly(true)?> class="fldSelect<?=$this->isEqual('discount')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('discount')?>'" onblur="this.className='fldSelect<?=$this->isEqual('discount')?>'" onchange="clearProductsBlocks();">
						<option value="0.00">0.00
						<?
							for ($j=1; $j <= $data['discount']; $j++) {
								echo '<option value="' . $j . '.00" ' . ((intval($j) == intval($data['discount'])) ? ' selected' : '') . '>' . $j . '.00';
							}
						?>
					</select>
				</td>
				<td class="label grey expressproduct">Бонус-малус, %:</td>
				<td class="expressproduct">
					<? if ($Authorization->data['permissions']['Policies_KASKO']['superbonusmalus']) { ?>
						<input type="text" id="bonus_malus" name="bonus_malus" value="<?=$data['bonus_malus']?>" maxlength="5" class="fldText number<?=$this->isEqual('bonus_malus')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('bonus_malus')?>'" onblur="this.className='fldText number<?=$this->isEqual('bonus_malus')?>'" onchange="clearProductsBlocks();" <?=$this->getReadonly(false)?> />
					<?} else {?>
					<select id="bonus_malus" name="bonus_malus" <?=$this->getReadonly(true)?> class="fldSelect<?=$this->isEqual('bonus_malus')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('bonus_malus')?>'" onblur="this.className='fldSelect<?=$this->isEqual('bonus_malus')?>'" onchange="clearProductsBlocks();">
						<?
							if ($data['max_bonus_malus']>1)
								echo '<option value="' . $data['max_bonus_malus'] . '"  selected> + ' . (-(100 - $data['max_bonus_malus'] * 100)) . '.00';
								
							for ($j=1.0; $j >= $data['max_bonus_malus']-0.000001; $j=$j-0.05) {
								echo '<option value="' . $j . '" ' . (((string)($j * 100) == (string)($data['bonus_malus'] * 100)) ? ' selected' : '') . '> '.($j!=1 ? '-':'' )  . (100 - $j * 100) . '.00';
							}
						?>
					</select>
					<?}?>
				</td>	
			</tr>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey expressproduct">Чи є у вас картка CarMan@CarWoman:</td>
				<td class="expressproduct"><input type="checkbox" id="cart_discount" name="cart_discount" value="<?=intval($data['cart_discount'])?>" <?if (intval($data['cart_discount'])) echo 'checked';?> onclick="<?=(in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER)) ? 'setRates(false)' : 'return false')?>" <?=$this->getReadonly(true)?> /></td>
				<td class="label grey expressproduct" title="cart_discount"><?=$this->getLink('Номер:','card_car_man_woman',fldText)?></td>
				<td title="cart_discount" class="expressproduct"><input type="text" id="card_car_man_woman" name="card_car_man_woman" value="<?=$data['card_car_man_woman']?>" <?=(in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER)) ? ' ' : 'readonly')?>  maxlength="13" class="fldText number<?=$this->isEqual('card_car_man_woman')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('card_car_man_woman')?>'" onblur="this.className='fldText number<?=$this->isEqual('card_car_man_woman')?>'" onchange="setRates(false)" <?=$this->getReadonly(false)?> /></td>
				
				<td class="label grey"><?=$this->getLink('Картка Експрес Асістанс:','card_assistance',fldText)?></td>
				<td><input type="text" name="card_assistance" id="card_assistance" value="<?=$data['card_assistance']?>" maxlength="4" class="fldText number<?=$this->isEqual('card_assistance')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('card_assistance')?>'" onblur="this.className='fldText number<?=$this->isEqual('card_assistance')?>'" <?=$this->getReadonly(false)?> /></td>
				
                <? if (intval($data['id']) && false) {?>
				<td class="label grey">Акцiя НВ за 1 грн.</td>
                <td><div class="<?=$this->isEqual('flayer')?>"><input type="checkbox" id="flayer" name="flayer" value="1" <?=($data['flayer']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
                <? } ?>
				
				<td class="label grey" style="display: none;">Номер сертифiкату знижка КАСКО 500 грн. (8 знакiв)</td>
				<td style="display: none;">
					 <input type="text" id="certificate" name="certificate" value="<?=$data['certificate']?>" maxlength="8" class="fldText number<?=$this->isEqual('certificate')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('certificate')?>'" onblur="this.className='fldText number<?=$this->isEqual('certificate')?>'" onchange="setRates(false)" <?=$this->getReadonly(false)?> />
				</td>

<?
	$displayCertificateTenPercent = "none";
	if ($this->mode == "view" || $Authorization->roles_id != ROLES_AGENT) {
		$displayCertificateTenPercent = "''";
	}
?>

				<td class="label grey" style="display: <?=$displayCertificateTenPercent?>;">Номер сертифiкату знижка КАСКО 10% (4 знаки)</td>
				<td style="display: <?=$displayCertificateTenPercent?>;">
					 <input type="text" id="certificate" name="certificateTenPercent" value="<?=$data['certificateTenPercent']?>" maxlength="4" class="fldText number<?=$this->isEqual('certificateTenPercent')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('certificateTenPercent')?>'" onblur="this.className='fldText number<?=$this->isEqual('certificateTenPercent')?>'" onchange="certificateTenPercentProcess()" <?=$this->getReadonly(false)?> />
				</td>
            </tr>
			</table>
            <div id="flayerInfo" style="display:none;color:Red">
                Договір страхування за акцією «Повне КАСКО з подарунком» оформлюється лише при пред’явленні клієнтом акційного флаєру. Акційний флаєр вилучається у клієнта та додається до договору КАСКО – екземпляру страхової компанії. Сканокопія акційного флаєру підкріплюється в систему в розділ «Документи».
            </div>
            <div id="certificateInfo" style="display:none;color:Red">
                Знижка надається від звичайного страхового платежу за договором страхування КАСКО строком 1 рік, розрахованого за Програмами страхування наземних транспортних засобів «КАСКО Комфорт» (включаючи додаткові опції «Перший місяць страхування за 500 грн.» (за даною опцією – знижка застосовується при сплаті другого платежу),  «50/50»), «Сезон +» та «КАСКО Банк». Сертифікат вилучається у клієнта та додається до договору КАСКО – екземпляру страхової компанії. Сканокопія сертифікату підкріплюється в систему на закладку «Документи».
            </div>

			<table class="section2" cellpadding="5" cellspacing="0">
			<tr>
				<td><b>ТАРИФ:</b></td>
				<td id="amount"><?=getMoneyFormat($data['amount'])?></td>
				<td id="note_text"><? if ($data['express_products_id']==138) echo 'Тариф зазначено з врахуванням програми Сезон+' ?> </td>
				<? if ($data['policy_statuses_id'] == POLICY_STATUSES_CANCELLED) {?>
				<td><b>Сума, що підлягає поверненню:</td>
				<td><?=getMoneyFormat($data['amount_return'])?></td>
				<?}?>
				<? if ($data['agreement_types_id'] > 0) {?>
				<td><b>Використано покриття за попереднiм полiсом:</td>
				<td id="amount_usedBlock"><?=getMoneyFormat($data['amount_parent'])?></td>

				<? } ?>
				<td width="100%">&nbsp;</td>
			</tr>
			</table>
			
			<?
			if ($this->isRenew($data)) {
				echo '<div  style="display:none">';
			}
			?>
			<div class="testdriveproduct">
			<div class="section testdriveproduct">Власник:</div>
			<table cellpadding="0" cellspacing="0" class="testdriveproduct">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Тип особи:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_person_types_id') ], $data['owner_person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changePersonType();"', null, $data, $this->isEqual('owner_person_types_id'))?></td>								
			</tr>
			</table>
			<table id="ownerJurpersonBlock" cellpadding="5" cellspacing="0" class="testdriveproduct">
			<tr>
				<td class="label grey" id="fyzlabel"><?=$this->getMark()?>Компанiя:</td>
				<td><input type="text" id="owner_company" name="owner_company" value="<?=$data['owner_company']?>" maxlength="100" class="fldText company<?=$this->isEqual('owner_company')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('owner_company')?>'" onblur="this.className='fldText company<?=$this->isEqual('owner_company')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>ЄДРПОУ:</td>
				<td><input type="text" name="owner_edrpou" id="owner_edrpou" value="<?=$data[ 'owner_edrpou' ]?>" maxlength="10" class="fldText edrpou<?=$this->isEqual('owner_edrpou')?>" onfocus="this.className='fldTextOver edrpou<?=$this->isEqual('owner_edrpou')?>'" onblur="this.className='fldText edrpou<?=$this->isEqual('owner_edrpou')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Банк:</td>
				<td><input type="text" name="owner_bank" id="owner_bank" value="<?=$data[ 'owner_bank' ]?>" maxlength="100" class="fldText company<?=$this->isEqual('owner_bank')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('owner_bank')?>'" onblur="this.className='fldText company<?=$this->isEqual('owner_bank')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>МФО:</td>
				<td><input type="text" name="owner_bank_mfo" id="owner_bank_mfo" value="<?=$data[ 'owner_bank_mfo' ]?>" maxlength="6" class="fldText mfo<?=$this->isEqual('owner_bank_mfo')?>" onfocus="this.className='fldTextOver mfo<?=$this->isEqual('owner_bank_mfo')?>'" onblur="this.className='fldText mfo<?=$this->isEqual('owner_bank_mfo')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Р/р:</td>
				<td><input type="text" name="owner_bank_account" id="owner_bank_account" value="<?=$data[ 'owner_bank_account' ]?>" maxlength="20" class="fldText bank_account<?=$this->isEqual('owner_bank_account')?>" onfocus="this.className='fldTextOver bank_account<?=$this->isEqual('owner_bank_account')?>'" onblur="this.className='fldText bank_account<?=$this->isEqual('owner_bank_account')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>

			<table cellpadding="5" cellspacing="0" class="testdriveproduct">
			<tr>
				<td class="label grey" id="fyzlabel"><?=$this->getMark()?><?=$this->getLink('Прізвище:','owner_lastname',fldText)?></td>
				<td><input type="text" id="owner_lastname" name="owner_lastname" value="<?=$data['owner_lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('owner_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('owner_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('owner_lastname')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?><?=$this->getLink('Ім\'я','owner_firstname',fldText)?>:</td>
				<td><input type="text" id="owner_firstname" name="owner_firstname" value="<?=$data['owner_firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('owner_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('owner_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('owner_firstname')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?><?=$this->getLink('По батькові','owner_patronymicname',fldText)?>:</td>
				<td><input type="text" id="owner_patronymicname" name="owner_patronymicname" value="<?=$data['owner_patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('owner_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('owner_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('owner_patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
				<td id="ownerfyz1" class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Дата народження:','owner_dateofbirth',fldDate)?></td>
				<td id="ownerfyz2"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_dateofbirth') ], $data['owner_dateofbirth_year' ], $data['owner_dateofbirth_month' ], $data['owner_dateofbirth_day' ], 'owner_dateofbirth', $this->getReadonly(true))?></td>
			</tr>
			</table>

			<table cellpadding="0" cellspacing="0" id="owner_id_card_table">
				<tr>
					<td class="label grey">ID-картка:</td>
					<td class="label grey"><input type="radio" onclick="setOwnerIdCard()" name="owner_id_card" <?=$this->getReadonly(true)?> value="1" <?= (intval($data['owner_id_card'])?'checked':'') ?> /></td>
					<td>Так</td>
					<td class="label grey"><input type="radio" onclick="setOwnerIdCard()" name="owner_id_card" <?=$this->getReadonly(true)?> value="0" <?= (intval($data['owner_id_card'])?'':'checked') ?> /></td>
					<td>Ні</td>
				</tr>
			</table>
			<table cellpadding="5" cellspacing="0" id="ownerfyz3" class="testdriveproduct" <?= (intval($data['owner_id_card']) ? 'style="display:none"' : '') ?>>
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Паспорт, <?=$this->getLink('серія','owner_passport_series',fldText)?> і <?=$this->getLink('номер','owner_passport_number',fldText)?>:</td>
					<td>
						<input type="text" id="owner_passport_series" name="owner_passport_series" value="<?=$data['owner_passport_series']?>" maxlength="2" class="fldText series<?=$this->isEqual('owner_passport_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('owner_passport_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('owner_passport_series')?>'" <?=$this->getReadonly(false)?> />
						<input type="text" id="owner_passport_number" name="owner_passport_number" value="<?=$data['owner_passport_number']?>" maxlength="13" class="fldText number<?=$this->isEqual('owner_passport_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('owner_passport_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('owner_passport_number')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Паспорт. Ким і де виданий','owner_passport_place',fldText)?>:</td>
					<td><input type="text" id="owner_passport_place" name="owner_passport_place" value="<?=$data['owner_passport_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('owner_passport_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('owner_passport_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('owner_passport_place')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Паспорт. Дата видачі','owner_passport_date',fldDate)?>:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_passport_date') ], $data['owner_passport_date_year' ], $data['owner_passport_date_month' ], $data['owner_passport_date_day' ], 'owner_passport_date', $this->getReadonly(true))?></td>
				</tr>
			</table>
			<table cellpadding="5" cellspacing="0" <?= (intval($data['owner_id_card'])?'':'style="display:none"') ?> id="owner_new_passport_table">
				<tr>
					<td class="label grey">Паспорт. Номер:</td>
					<td><input type="text" name="owner_newpassport_number" value="<?=$data['owner_newpassport_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td>Паспорт. Ким і де виданий:</td>
					<td><input type="text" name="owner_newpassport_place" value="<?=$data['owner_newpassport_place']?>" maxlength="15" class="fldInteger number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td>Паспорт. Дата видачі:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_date') ], $data['owner_newpassport_date_year' ], $data['owner_newpassport_date_month' ], $data['owner_newpassport_date_day' ], 'owner_newpassport_date', $this->getReadonly(true).' '.$this->getRenew($data))?></td>
					<td>
						Унікальний номер запису в реєстрі:
					</td>
					<td>
						<input type="text" name="owner_newpassport_reestr" value="<?= $data['owner_newpassport_reestr'] ?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
					</td>
					<td>
						Дійсний до:
					</td>
					<td>
						<?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_dateEnd') ], $data['owner_newpassport_dateEnd_year' ], $data['owner_newpassport_dateEnd_month' ], $data['owner_newpassport_dateEnd_day' ], 'owner_newpassport_dateEnd', $this->getReadonly(true).' '.$this->getRenew($data))?>
					</td>
				</tr>
			</table>
			<table cellpadding="5" cellspacing="0" id="ownerfyz4" class="testdriveproduct">
			<tr>
				<td class="label grey"><?=$this->getMark()?><?=$this->getLink('ІПН','owner_identification_code',fldText)?>:</td>
				<td><input type="text" id="owner_identification_code" name="owner_identification_code" value="<?=$data['owner_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('owner_identification_code')?>" onfocus="this.className='fldTextOver code'<?=$this->isEqual('owner_identification_code')?>" onblur="this.className='fldText code'<?=$this->isEqual('owner_identification_code')?>" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0" class="testdriveproduct">
			<tr>
				<td id="owner_positionBlock1"><?=$this->getMark(false)?><?=$this->getLink('Посада','owner_position',fldText)?>:</td>
				<td id="owner_positionBlock2"><input type="text" id="owner_position" name="owner_position" value="<?=$data['owner_position']?>" maxlength="150" class="fldText place<?=$this->isEqual('owner_position')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('owner_position')?>'" onblur="this.className='fldText place<?=$this->isEqual('owner_position')?>'" <?=$this->getReadonly(false)?> /></td>
				<td id="owner_positionBlock3"><?=$this->getMark(false)?><?=$this->getLink('Діє на підставі','owner_ground',fldText)?>:</td>
				<td id="owner_positionBlock4"><input type="text" id="owner_ground" name="owner_ground" value="<?=$data['owner_ground']?>" maxlength="100" class="fldText place<?=$this->isEqual('owner_ground')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('owner_ground')?>'" onblur="this.className='fldText place<?=$this->isEqual('owner_ground')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Телефон','owner_phone',fldText)?>:</td>
				<td><input type="text" id="owner_phone" name="owner_phone" value="<?=$data['owner_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('owner_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('owner_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('owner_phone')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getLink('E-mail','owner_email',fldText)?>:</td>
				<td><input type="text" id="owner_email" name="owner_email" value="<?=$data['owner_email']?>" maxlength="50" class="fldText email<?=$this->isEqual('owner_email')?>" onfocus="this.className='fldTextOver email<?=$this->isEqual('owner_email')?>'" onblur="this.className='fldText email<?=$this->isEqual('owner_email')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0" class="testdriveproduct">
			<tr>
				<td class="label grey"><?=$this->getMark(false)?>Область:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_regions_id') ], $data['owner_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('owner_regions_id'))?></td>
				<td class="label grey"><?=$this->getLink('Район','owner_area',fldText)?>:</td>
				<td><input type="text" id="owner_area" name="owner_area" value="<?=$data['owner_area']?>" maxlength="50" class="fldText city<?=$this->isEqual('owner_area')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('owner_area')?>'" onblur="this.className='fldText city<?=$this->isEqual('owner_area')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Місто','owner_city',fldText)?>:</td>
				<td><input type="text" id="owner_city" name="owner_city" value="<?=$data['owner_city']?>" maxlength="50" class="fldText city<?=$this->isEqual('owner_city')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('owner_city')?>'" onblur="this.className='fldText city<?=$this->isEqual('owner_city')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0" class="testdriveproduct">
			<tr>
				<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Вулиця','owner_street',fldText)?>:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_street_types_id') ], $data['owner_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('owner_street_types_id'))?><input type="text" id="owner_street" name="owner_street" value="<?=$data['owner_street']?>" maxlength="50" class="fldText street<?=$this->isEqual('owner_street')?>" onfocus="this.className='fldTextOver street<?=$this->isEqual('owner_street')?>'" onblur="this.className='fldText street<?=$this->isEqual('owner_street')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Будинок','owner_house',fldText)?>:</td>
				<td><input type="text" id="owner_house" name="owner_house" value="<?=$data['owner_house']?>" maxlength="15" class="fldText house<?=$this->isEqual('owner_house')?>" onfocus="this.className='fldTextOver house<?=$this->isEqual('owner_house')?>'" onblur="this.className='fldText house<?=$this->isEqual('owner_house')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getLink('Квартира','owner_flat',fldText)?>:</td>
				<td><input type="text" id="owner_flat" name="owner_flat" value="<?=$data['owner_flat']?>" maxlength="10" class="fldText flat<?=$this->isEqual('owner_flat')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('owner_flat')?>'" onblur="this.className='fldText flat<?=$this->isEqual('owner_flat')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			</div>
			<?if ($this->isRenew($data)) {echo '</div>';}?>
			<div id="insurerBlock">
				<div class="section">
					<table id="ownerBlock" cellpadding="0" cellspacing="0">
					<tr>
						<td class="section" style="border: none;">Страхувальник:</td>
						<?if (!$this->isRenew($data)) {?>
						<td class="label grey testdriveproduct">власник є страхувальником:</td>
						<td class=" testdriveproduct">&nbsp;</td>
						<td class=" testdriveproduct"><input type="checkbox" id="owner" value="1" onclick="setInsurer(this)" <?=$this->getReadonly(true)?> /></td>
						<?}?>
					</tr>
					</table>
				</div>
				<table id="ownerBlock" cellpadding="0" cellspacing="0"  >
				<tr>
					<td class="label grey"><?=$this->getMark()?>Тип особи:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_person_types_id') ], $data['insurer_person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changePersonType();"', null, $data, $this->isEqual('insurer_person_types_id'))?></td>
					<td class="label grey">не резидент:</td>
					<td width="100px"><input type="checkbox" value="1" name="no_resident" <?=(intval($data['no_resident']) ? 'checked' : '')?> <?=$this->getReadonly(true)?> /></td>
				</tr>
				</table>
				<table id="insurerJurpersonBlock" cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey" id="fyzlabel"><?=$this->getMark()?><?=$this->getLink('Компанiя','insurer_company',fldText)?>:</td>
					<td><input type="text" id="insurer_company" name="insurer_company" value="<?=$data['insurer_company']?>" maxlength="100" class="fldText company<?=$this->isEqual('insurer_company')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('insurer_company')?>'" onblur="this.className='fldText company<?=$this->isEqual('insurer_company')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark()?><?=$this->getLink('ЄДРПОУ','insurer_edrpou',fldText)?>:</td>
					<td><input type="text" name="insurer_edrpou" id="insurer_edrpou" value="<?=$data[ 'insurer_edrpou' ]?>" maxlength="10" class="fldText edrpou<?=$this->isEqual('insurer_edrpou')?>" onfocus="this.className='fldTextOver edrpou<?=$this->isEqual('insurer_edrpou')?>'" onblur="this.className='fldText edrpou<?=$this->isEqual('insurer_edrpou')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Банк','insurer_bank',fldText)?>:</td>
					<td><input type="text" name="insurer_bank" id="insurer_bank" value="<?=$data[ 'insurer_bank' ]?>" maxlength="100" class="fldText company<?=$this->isEqual('insurer_bank')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('insurer_bank')?>'" onblur="this.className='fldText company<?=$this->isEqual('insurer_bank')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('МФО','insurer_bank_mfo',fldText)?>:</td>
					<td><input type="text" name="insurer_bank_mfo" id="insurer_bank_mfo" value="<?=$data[ 'insurer_bank_mfo' ]?>" maxlength="6" class="fldText mfo<?=$this->isEqual('insurer_bank_mfo')?>" onfocus="this.className='fldTextOver mfo<?=$this->isEqual('insurer_bank_mfo')?>'" onblur="this.className='fldText mfo<?=$this->isEqual('insurer_bank_mfo')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Р/р','insurer_bank_account',fldText)?>:</td>
					<td><input type="text" name="insurer_bank_account" id="insurer_bank_account" value="<?=$data[ 'insurer_bank_account' ]?>" maxlength="20" class="fldText bank_account<?=$this->isEqual('insurer_bank_account')?>" onfocus="this.className='fldTextOver bank_account<?=$this->isEqual('insurer_bank_account')?>'" onblur="this.className='fldText bank_account<?=$this->isEqual('insurer_bank_account')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
				</tr>
				</table>
			
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?><?=$this->getLink('Прізвище','insurer_lastname',fldText)?>:</td>
					<td><input type="text" id="insurer_lastname" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark()?><?=$this->getLink('Ім\'я','insurer_firstname',fldText)?>:</td>
					<td><input type="text" id="insurer_firstname" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark()?><?=$this->getLink('По батькові','insurer_patronymicname',fldText)?>:</td>
					<td><input type="text" id="insurer_patronymicname" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey" id="insurerfyz1"><?=$this->getMark(false)?><?=$this->getLink('Дата народження','insurer_dateofbirth',fldDate)?>:</td>
					<td id="insurerfyz2"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ], $data['insurer_dateofbirth_year' ], $data['insurer_dateofbirth_month' ], $data['insurer_dateofbirth_day' ], 'insurer_dateofbirth', $this->getReadonly(true).' '.$this->getRenew($data))?></td>
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
				<table cellpadding="5" cellspacing="0" id="insurerfyz3" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?>>
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Паспорт, <?=$this->getLink('серія','insurer_passport_series',fldText)?> і <?=$this->getLink('номер','insurer_passport_number',fldText)?>:</td>
					<td>
						<input type="text" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series<?=$this->isEqual('insurer_passport_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('insurer_passport_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('insurer_passport_series')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/>
						<input type="text" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number<?=$this->isEqual('insurer_passport_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('insurer_passport_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('insurer_passport_number')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/>
					</td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Паспорт. Ким і де виданий','insurer_passport_place',fldText)?>:</td>
					<td><input type="text" id="insurer_passport_place" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('insurer_passport_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_passport_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_passport_place')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Паспорт. Дата видачі','insurer_passport_date',fldDate)?>:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ], $data['insurer_passport_date_year' ], $data['insurer_passport_date_month' ], $data['insurer_passport_date_day' ], 'insurer_passport_date', $this->getReadonly(true).' '.$this->getRenew($data))?></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0" <?= (intval($data['insurer_id_card'])?'':'style="display:none"') ?> id="insurer_new_passport_table">
					<tr>
						<td class="label grey">Паспорт. Номер:</td>
						<td><input type="text" name="insurer_newpassport_number" value="<?=$data['insurer_newpassport_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td>Паспорт. Ким і де виданий:</td>
						<td><input type="text" name="insurer_newpassport_place" value="<?=$data['insurer_newpassport_place']?>" maxlength="15" class="fldInteger number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td>Паспорт. Дата видачі:</td>
						<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ], $data['insurer_newpassport_date_year' ], $data['insurer_newpassport_date_month' ], $data['insurer_newpassport_date_day' ], 'insurer_newpassport_date', $this->getReadonly(true).' '.$this->getRenew($data))?></td>
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
							<?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ], $data['insurer_newpassport_dateEnd_year' ], $data['insurer_newpassport_dateEnd_month' ], $data['insurer_newpassport_dateEnd_day' ], 'insurer_newpassport_dateEnd', $this->getReadonly(true).' '.$this->getRenew($data))?>
						</td>
					</tr>
				</table>
				<table cellpadding="5" cellspacing="0"  id="insurerfyz4">
				<tr>
					<td id="insurerDriverLicenceLabel" class="label grey expressproduct testdriveproduct">Водійські права, <?=$this->getLink('серія','insurer_driver_licence_series',fldText)?>, <?=$this->getLink('номер','insurer_driver_licence_number',fldText)?> і <?=$this->getLink('дата','insurer_driver_licence_date',fldDate)?>:</td>
					<td class="expressproduct testdriveproduct">
						<input type="text" id="insurer_driver_licence_series" name="insurer_driver_licence_series" value="<?=$data['insurer_driver_licence_series']?>" maxlength="4" class="fldText series<?=$this->isEqual('insurer_driver_licence_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('insurer_driver_licence_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('insurer_driver_licence_series')?>'" <?=$this->getReadonly(false)?> />
						<input type="text" id="insurer_driver_licence_number" name="insurer_driver_licence_number" value="<?=$data['insurer_driver_licence_number']?>" maxlength="9" class="fldText number<?=$this->isEqual('insurer_driver_licence_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('insurer_driver_licence_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('insurer_driver_licence_number')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="expressproduct testdriveproduct"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_driver_licence_date') ], $data['insurer_driver_licence_date_year' ], $data['insurer_driver_licence_date_month' ], $data['insurer_driver_licence_date_day' ], 'insurer_driver_licence_date', ' ' . $this->getReadonly(true).' ')?></td>
					<td class="label grey"><?=$this->getMark()?><?=$this->getLink('ІПН','insurer_identification_code',fldText)?>:</td>
					<td><input type="text" id="insurer_identification_code" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('insurer_identification_code')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('insurer_identification_code')?>'" onblur="this.className='fldText code<?=$this->isEqual('insurer_identification_code')?>'" <?=$this->getReadonly(false)?> <?=$this->getRenew($data)?>/></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td id="insurer_positionBlock1"><?=$this->getMark(false)?><?=$this->getLink('Посада','insurer_position',fldText)?>:</td>
					<td id="insurer_positionBlock2"><input type="text" id="insurer_position" name="insurer_position" value="<?=$data['insurer_position']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position')?>'" <?=$this->getReadonly(false)?> /></td>
					<td id="insurer_positionBlock3"><?=$this->getMark(false)?><?=$this->getLink('Діє на підставі','insurer_ground',fldText)?>:</td>
					<td id="insurer_positionBlock4"><input type="text" id="insurer_ground" name="insurer_ground" value="<?=$data['insurer_ground']?>" maxlength="100" class="fldText place<?=$this->isEqual('insurer_ground')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_ground')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_ground')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Телефон','insurer_phone',fldText)?>:</td>
					<td><input type="text" id="insurer_phone" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('insurer_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('insurer_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('insurer_phone')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getLink('E-mail','insurer_email',fldText)?>:</td>
					<td><input type="text" id="insurer_email" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email<?=$this->isEqual('insurer_email')?>" onfocus="this.className='fldTextOver email<?=$this->isEqual('insurer_email')?>'" onblur="this.className='fldText email<?=$this->isEqual('insurer_email')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				
				<div id="insurerJurpersonBlock1">
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getLink('Прізвище','insurer_lastname1',fldText)?>:</td>
					<td><input type="text" id="insurer_lastname1" name="insurer_lastname1" value="<?=$data['insurer_lastname1']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('insurer_lastname1')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('insurer_lastname1')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('insurer_lastname1')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getLink('Ім\'я','insurer_firstname1',fldText)?>:</td>
					<td><input type="text" id="insurer_firstname1" name="insurer_firstname1" value="<?=$data['insurer_firstname1']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('insurer_firstname1')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('insurer_firstname1')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('insurer_firstname1')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getLink('По батькові','insurer_patronymicname1',fldText)?>:</td>
					<td><input type="text" id="insurer_patronymicname1" name="insurer_patronymicname1" value="<?=$data['insurer_patronymicname1']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('insurer_patronymicname1')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('insurer_patronymicname1')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('insurer_patronymicname1')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td><?=$this->getLink('Посада','insurer_position1',fldText)?>:</td>
					<td><input type="text" id="insurer_position1" name="insurer_position1" value="<?=$data['insurer_position1']?>" maxlength="150" class="fldText place<?=$this->isEqual('insurer_position1')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_position1')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_position1')?>'" <?=$this->getReadonly(false)?> /></td>
					<td><?=$this->getLink('Діє на підставі','insurer_ground1',fldText)?>:</td>
					<td><input type="text" id="insurer_ground1" name="insurer_ground1" value="<?=$data['insurer_ground1']?>" maxlength="50" class="fldText place<?=$this->isEqual('insurer_ground1')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_ground1')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_ground1')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				</div>
				
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Область:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_regions_id'))?></td>
					<td class="label grey"><?=$this->getLink('Район','insurer_area',fldText)?>:</td>
					<td><input type="text" id="insurer_area" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_area')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_area')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Місто','insurer_city',fldText)?>:</td>
					<td><input type="text" id="insurer_city" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_city')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_city')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_city')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Вулиця','insurer_street',fldText)?>:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_street_types_id'))?><input type="text" id="insurer_street" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street<?=$this->isEqual('insurer_street')?>" onfocus="this.className='fldTextOver street<?=$this->isEqual('insurer_street')?>'" onblur="this.className='fldText street<?=$this->isEqual('insurer_street')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?><?=$this->getLink('Будинок','insurer_house',fldText)?>:</td>
					<td><input type="text" id="insurer_house" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="15" class="fldText house<?=$this->isEqual('insurer_house')?>" onfocus="this.className='fldTextOver house<?=$this->isEqual('insurer_house')?>'" onblur="this.className='fldText house<?=$this->isEqual('insurer_house')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getLink('Квартира','insurer_flat',fldText)?>:</td>
					<td><input type="text" id="insurer_flat" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="10" class="fldText flat<?=$this->isEqual('insurer_flat')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('insurer_flat')?>'" onblur="this.className='fldText flat<?=$this->isEqual('insurer_flat')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
			</div>

			<div id="otherPersons" class="section" style="display: <?=(is_array($data['persons']) && sizeOf($data['persons'])) ? 'block' : 'none'?>">Інші застраховані особи:</div>
			<table id="persons" cellpadding="5" cellspacing="0">
			<?
				if (is_array($data['persons'])) {
					$driver_ages = $this->formDescription['fields'][ $this->getFieldPositionByName('driver_ages_id') ];
					$driver_standings = $this->formDescription['fields'][ $this->getFieldPositionByName('driver_standings_id') ];

					foreach ($data['persons'] as $i => $row) {
						$driver_ages['name'] 		= 'persons[' . $i . '][driver_ages_id]';
						$driver_standings['name']	= 'persons[' . $i . '][driver_standings_id]';
			?>
				<tr>
					<td class="label grey"><?=$this->getMark(false)?>Прізвище:</td>
					<td><input type="text" id="persons<?=$i?>lastname" name="persons[<?=$i?>][lastname]" value="<?=$row['lastname']?>" maxlength="50" class="fldText lastname<?=$this->isEqual('persons|' . $i . '|lastname')?>" onfocus="this.className='fldTextOver lastname<?=$this->isEqual('persons|' . $i . '|lastname')?>'" onblur="this.className='fldText lastname<?=$this->isEqual('persons|' . $i . '|lastname')?>'" <?=$this->getReadonly(false)?> />
					<td class="label grey"><?=$this->getMark(false)?>Ім'я:</td>
					<td><input type="text" id="persons<?=$i?>firstname" name="persons[<?=$i?>][firstname]" value="<?=$row['firstname']?>" maxlength="50" class="fldText firstname<?=$this->isEqual('persons|' . $i . '|firstname')?>" onfocus="this.className='fldTextOver firstname<?=$this->isEqual('persons|' . $i . '|firstname')?>'" onblur="this.className='fldText firstname<?=$this->isEqual('persons|' . $i . '|firstname')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark(false)?>По батькові:</td>
					<td><input type="text" id="persons<?=$i?>patronymicname" name="persons[<?=$i?>][patronymicname]" value="<?=$row['patronymicname']?>" maxlength="50" class="fldText patronymicname<?=$this->isEqual('persons|' . $i . '|patronymicname')?>" onfocus="this.className='fldTextOver patronymicname<?=$this->isEqual('persons|' . $i . '|patronymicname')?>'" onblur="this.className='fldText patronymicname<?=$this->isEqual('persons|' . $i . '|patronymicname')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey expressproduct"><?=$this->getMark(false)?>Вік:</td>
					<td class="expressproduct"><?=$this->buildSelect($driver_ages, $row[ 'driver_ages_id' ], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('driver_ages_id'))?></td>
					<td class="label grey expressproduct"><?=$this->getMark(false)?>Водійські права, серія, номер і дата:</td>
					<td class="expressproduct">
						<input type="text" id="persons<?=$i?>driver_licence_series" name="persons[<?=$i?>][driver_licence_series]" value="<?=$row['driver_licence_series']?>" maxlength="4" class="fldText series<?=$this->isEqual('persons|' . $i . '|driver_licence_series')?>" onfocus="this.className='fldTextOver series<?=$this->isEqual('persons|' . $i . '|driver_licence_series')?>'" onblur="this.className='fldText series<?=$this->isEqual('persons|' . $i . '|driver_licence_series')?>'" <?=$this->getReadonly(false)?> />
						<input type="text" id="persons<?=$i?>driver_licence_number" name="persons[<?=$i?>][driver_licence_number]" value="<?=$row['driver_licence_number']?>" maxlength="9" class="fldText number<?=$this->isEqual('persons|' . $i . '|driver_licence_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('persons|' . $i . '|driver_licence_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('persons|' . $i . '|driver_licence_number')?>'" <?=$this->getReadonly(false)?> />
					</td>
					<td class="expressproduct">
						<input type="text" id="persons<?=$i?>driver_licence_date" name="persons[<?=$i?>][driver_licence_date]" value="<?=$row['driver_licence_date']?>" maxlength="10" class="fldDatePicker<?=($this->mode == 'update' ? '' : 'Disabled')?><?=$this->isEqual('persons|' . $i . '|driver_licence_date')?>" onfocus="this.className='fldDatePickerOver <?=$this->isEqual('persons|' . $i . '|driver_licence_date')?>'" onblur="this.className='fldDatePicker <?=$this->isEqual('persons|' . $i . '|driver_licence_date')?>'" <?=$this->getReadonly(false)?> />
						<input type="hidden" id="persons<?=$i?>driver_licence_date_day" name="persons[<?=$i?>][driver_licence_date_day]" value="<?=$row['driver_licence_date_day']?>" />
						<input type="hidden" id="persons<?=$i?>driver_licence_date_month" name="persons[<?=$i?>][driver_licence_date_month]" value="<?=$row['driver_licence_date_month']?>" />
						<input type="hidden" id="persons<?=$i?>driver_licence_date_year" name="persons[<?=$i?>][driver_licence_date_year]" value="<?=$row['driver_licence_date_year']?>" />
					</td>
					<td>&nbsp;</td>
				</tr>
			<?
					}
				}
			?>
			</table>

			<div class="section">Параметри полісу страхування:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<? if ($this->mode == 'view' || ($data['agencies_id'] == AGENCIES_EXPRESS_INSURANCE && $data['types_id'] == POLICY_TYPES_QUOTE) || ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW)) {?>
				<td class="label grey">Номер полісу:</td>
				<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="20" class="fldText number<?=$this->isEqual('number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('number')?>'" onblur="this.className='fldText number<?=$this->isEqual('number')?>'" <?=($action == 'insert') ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"'?> />
				<td class="label grey"><?=$this->getMark(false)?><?=($data['agreement_types_id'] >0 ? 'Дата дод. угоди:' : 'Дата полісу:')?></td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', ($action == 'insert') ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"')?></td>
				<? } ?>
				<td class="label grey"><?=$this->getMark(false)?>Дата початку дії полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'id="begin_datetime" ' . $this->getReadonly(true))?></td>
				<?
					$enddateedit = false;
					if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies_KASKO']['enddateedit']  || $this->subMode != 'calculate') {
						$enddateedit = true;
					}
					 
				?>
			
				<td class="label grey"><?=$this->getMark(false)?>Дата закінчення дії полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', ' '.($enddateedit ===false ? 'style="color: #aca899; background-color: #f5f5f5;" disabled ':' '). $this->getReadonly(true))?></td>
			</tr>
			</table>

			<table class="expressproduct" id="assuredBlock" width="100%" cellpadding="5" cellspacing="0" style="display: <?=($data['financial_institutions_id']) ? 'none' : 'block'?>">
			<tr>
				<td class="label grey">Поліс прошу укласти на користь Вигодонабувача:</td>
				<td width="20"><input type="checkbox" id="assured" name="assured" value="1" <?=(($data['assured'] || $data['assured_title']) ? 'checked': '')?> onclick="setAssured(this)" <?=$this->getReadonly(true)?> /></td>
				<td width="70%">
					<table id="assuredData" cellpadding="0" cellspacing="5" style="display: <?=($data['assured'] || $data['assured_title']) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><?=$this->getMark(false)?>ПІБ (назва):</td>
						<td><input type="text" id="assured_title" name="assured_title" value="<?=$data['assured_title']?>" maxlength="150" class="fldText address<?=$this->isEqual('assured_title')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_title')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_title')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark(false)?>ІПН (ЄРДПОУ):</td>
						<td><input type="text" id="assured_identification_code" name="assured_identification_code" value="<?=$data['assured_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('assured_identification_code')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('assured_identification_code')?>'" onblur="this.className='fldText code<?=$this->isEqual('assured_identification_code')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark(false)?>Адреса:</td>
						<td><input type="text" id="assured_address" name="assured_address" value="<?=$data['assured_address']?>" maxlength="100" class="fldText address<?=$this->isEqual('assured_address')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_address')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_address')?>'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark(false)?>Телефон:</td>
						<td><input type="text" id="assured_phone" name="assured_phone" value="<?=$data['assured_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('assured_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('assured_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('assured_phone')?>'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

			<table id="agreementsBlock" cellpadding="5" cellspacing="0" style="display: <?=($data['financial_institutions_id'] && $data['financial_institutions_id'] != 35) ? 'block' : 'none'?>">
			<tr>
				<td class="label grey">Kредитний договір, номер:</td>
				<td><input type="text" id="credit_agreement_number" name="credit_agreement_number" value="<?=$data['credit_agreement_number']?>" maxlength="25" class="fldText number<?=$this->isEqual('credit_agreement_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('credit_agreement_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('credit_agreement_number')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">від</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('credit_agreement_date') ], $data['credit_agreement_date_year' ], $data['credit_agreement_date_month' ], $data['credit_agreement_date_day' ], 'credit_agreement_date', $this->getReadonly(true))?></td>
                <td colspan="4">&nbsp;</td>
            </tr>
			<tr>
				<td class="label grey">Договір застави, номер:</td>
				<td><input type="text" id="pawn_agreement_number" name="pawn_agreement_number" value="<?=$data['pawn_agreement_number']?>" maxlength="25" class="fldText number<?=$this->isEqual('pawn_agreement_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('pawn_agreement_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('pawn_agreement_number')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">від</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('pawn_agreement_date') ], $data['pawn_agreement_date_year' ], $data['pawn_agreement_date_month' ], $data['pawn_agreement_date_day' ], 'pawn_agreement_date', $this->getReadonly(true))?></td>
                <td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td class="label grey">Рахунок (для договірного списання коштів)</td>
				<td><input type="text" id="bank_account_number" name="bank_account_number" value="<?=$data['bank_account_number']?>" maxlength="14" class="fldText number<?=$this->isEqual('bank_account_number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('bank_account_number')?>'" onblur="this.className='fldText number<?=$this->isEqual('bank_account_number')?>'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">відкритий в</td>
                <td><input type="text" id="bank_account_title" name="bank_account_title" value="<?=$data['bank_account_title']?>" maxlength="70" class="fldText number<?=$this->isEqual('bank_account_title')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('bank_account_title')?>'" onblur="this.className='fldText number<?=$this->isEqual('bank_account_number')?>'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">МФО</td>
                <td><input type="text" id="bank_account_mfo" name="bank_account_mfo" value="<?=$data['bank_account_mfo']?>" maxlength="14" class="fldText number<?=$this->isEqual('bank_account_mfo')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('bank_account_mfo')?>'" onblur="this.className='fldText number<?=$this->isEqual('bank_account_mfo')?>'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">ЄДРПОУ</td>
                <td><input type="text" id="bank_account_edrpou" name="bank_account_edrpou" value="<?=$data['bank_account_edrpou']?>" maxlength="14" class="fldText number<?=$this->isEqual('bank_account_edrpou')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('bank_account_edrpou')?>'" onblur="this.className='fldText number<?=$this->isEqual('bank_account_edrpou')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>

			<div class="section">Пiдписи:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Пiдпис полicа:</td>
				<td>
					<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id')], $data['sign_agents_id'], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('sign_agents_id'))?>
					<? if (intval($data['documents'])==0 && $this->mode != 'update') {?>
					<? if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['roles_id']==ROLES_AGENT) {?><input type="button" value=" Змiнити " onclick="changeAgentSign();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><?}?>
						<? if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies_KASKO']['update']) {?>
						<input type="button" value=" Змiнити значення " onclick="changePolicyVals();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
						<?}?>
					<?}?>
				</td>
				<? if ($Authorization->data['service'] || $Authorization->data['reset'] || $data['service_person'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies_KASKO']['superupdate']) {//показываем только для тех полисов где есть сотрудник СТО или продажи идут с участием СТО ?>
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
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('fop') ], $data['fop'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fop'))?></td>
				<td class="label grey fophide"><?=$this->getMark()?>Подаю виписку або витяг з Єдиного державного реєстру юридичних осіб та фізичних осіб - підприємців:</td>
				<td class="fophide"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('give_a_statement') ], $data['give_a_statement'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fop'))?></td>
			</tr>
			</table>	
			<table cellpadding="5" cellspacing="0" class="fophide">	
			<tr>
				<td class="label grey"><?=$this->getMark()?>Я є особою, яка обіймає посаду державного службовця, службовця<br> органу місцевого самоврядування першої або другої категорії, претендую<br> на зайняття чи займаю виборну посаду в органах влади та додаю<br />декларацію про майновий стан і доходи<br />(або податкову декларацію) встановленого зразка або заповнюю<br />додаток до цієї Заяви (якщо так, вказати «додаю» або «заповнюю»,<br />якщо не відноситесь до таких осіб, вказати «ні»).:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('civil_servant') ], $data['civil_servant'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('civil_servant'))?></td>
				<td class="label grey"><?=$this->getMark()?>Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий <br>стан відкритою та додаю податкову декларацію встановленого зразка<br />або заповнюю додаток до цієї Заяви добровільно<br> (якщо так, вказати «додаю» або «заповнюю»,<br />якщо вважаєте цю інформацію конфіденційною, вказати «ні»:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('not_civil_servant') ], $data['not_civil_servant'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fop'))?></td>
			</tr>
			<tr>
				<td class="label grey"><?=$this->getMark()?>Я є публічним діячем* або пов'язаною з ними особою** або особою, <br>що діє від його імені (якщо так, вказати відношення до публічного діяча, дані про<br> публічного діяча та додати офіційні документи, що дають можливість <br>з'ясувати джерела походження коштів і вказати назву та реквізити цих документів,<br />якщо не відноситесь до таких осіб, вказати «ні»):</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('public_figure') ], $data['public_figure'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('civil_servant'))?></td>
				<td></td><td></td>
			</tr>
			</table>
			<div class="section">Додатково:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Статус:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], 'onchange="setRequiredFields()" ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
				<?
				$showf = 1;//(intval($data['solutions_id'])==0 && intval($data['financial_institutions_id'])==0);
				
				if ($Authorization->data['roles_id']==ROLES_AGENT) $showf=$showf && (intval($Authorization->data['ukravto']) || $_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID );
				//if ($data['cons_agents_id']>0) $showf =false;
				
				if ($showf) {
				?>
				<td class="label grey client_manager">Сторонiй клiєнт:</td>
				<td class="client_manager"><input id="outside_client" type="checkbox" name="outside_client" value="1" <?if ($data['outside_client']==1) echo 'checked';?> <?=$this->getReadonly(true)?> /></td>
				<? if ($data['cons_agents_id']==0) { ?>
				<td class="label grey client_manager">Менеджер що привiв клiєнта:</td>
				<td class="client_manager"  id="selectsellermanager">
				<?if (ereg('^view', $action)) {
					echo $data['manager_fio'];
				} else {
				?>
				
				<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('manager_id')], $data['manager_id'], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('manager_id'))?>
				
				<?}?>
				</td>	
				<? if ($data['individual_motivation']) {?>
				<td>
				% КВ для МП:
				<input id="motivation_manager_percent" class="fldPercent flat" type="text" onblur="this.className='fldPercent flat'" onfocus="this.className='fldPercent flat'" maxlength="10" value="<?=$data['motivation_manager_percent']?>" name="motivation_manager_percent" <?=$this->getReadonly(true)?> >
				</td>		
				<?}?>
				<?} 
				else {
					echo '<td>Створив консультацiю: '.$data['cons_agents_fio'].'</td>';
				}
				}?>
				
				
				<?
						if ($change_seller) {
							echo '<td>';
							echo 'Агенція продавець: ';
							echo '<select '.$this->getReadonly().' name="seller_agencies_id" id="seller_agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
							echo '<option value="">...</option>';
							$agencies = $data['seller_agencies'];
							foreach ($agencies as $agency) {
								echo ($agency['id'] == $data['seller_agencies_id'])
									? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
									: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
							}
							echo '</select>';
							echo '</td>';
							echo '<td>Менеджер продавець:</td>
							<td id="selectmanager">
								<b>'.$data['seller_agents_fio'].'</b>
							</td>';
						}
						else {
							echo '<input type="hidden" id="seller_agencies_id" name="seller_agencies_id" value="'.intval($data['seller_agencies_id']).'" />
							<input type="hidden" id="seller_agents_id" name="seller_agents_id" value="'.intval($data['seller_agents_id']).'" />
							';
						}
                ?>
				
				</td>
			</tr>
			</table>

			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey">Особливі умови:</td>
				<td width="100%"><textarea id="comment" name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
			</tr>
			<? if (($data['types_id'] == POLICY_TYPES_QUOTE || strlen($data['comment_quote'])) && in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
				<tr>
					<td class="label grey">Коментар андерайтера:</td>
					<td width="100%"><textarea id="comment_quote" name="comment_quote" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment_quote']?></textarea></td>
				</tr>
			<? } ?>
			</table>			
			<?if (!ereg('^view', $action) && ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR)) {?>
				<table   cellpadding="0" cellspacing="0">
				<tr>
					<td class="label grey"><b style="color:#ff0066">ПРИ ЗБЕРЕЖЕННI НЕ ПЕРЕРАХОВУВАТИ ТАРИФ:</b></td>
					<td >&nbsp;</td>
					<td><input type="checkbox" id="owner" value="1" name="dontRecalcRate" /></td>
					<td class="label grey"><b style="color:#ff0066">ПРИ ЗБЕРЕЖЕННI НЕ ПЕРЕВIРЯТИ ФОРМАТИ:</b></td>
					<td >&nbsp;</td>
					<td><input type="checkbox" id="owner" value="1" name="dontCheckFormat" /></td>
					
					<td class="label grey"><b style="color:#ff0066">РОЗБИВКА ПЛАТЕЖУ РIВНИМИ ЧАСТИНАМИ:</b></td>
					<td >&nbsp;</td>
					<td><input type="checkbox" id="owner" value="1" name="equalPayments" /></td>


				</tr>
				</table>
			<?}?>
			<?if (ereg('^view', $action) && ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR)) {?>
				<a style="color:red" href="JavaScript:makeRitale(1)">Перевести в ритейл Комфорт</a> |
				<a style="color:red" href="JavaScript:makeRitale(2)">Перевести в ритейл Премиум</a> |
				<a style="color:red" href="JavaScript:makeRitale(3)">Перевести в ритейл Каско мини</a> |
				<a style="color:red" href="JavaScript:loadFinProducts()">Завантажити продукти</a> |
				<span id="ins_products">
				</span>
				<script type="text/javascript">
					function makeRitale(ptype) {
						$.ajax({
						type:       'POST',
						url:        'index.php',
						dataType:   'json',
						data:       'do=Policies|makeritaleInWindow' +
									'&product_types_id=' + getElementValue('product_types_id') +
									'&ptype=' + ptype +
									'&id=<?=$data['id']?>' ,
							success: function(result) {
								 alert(result.text);
							}
						}); 
					}
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
<script type="text/javascript">

    setRequiredFields();
	setTermsYears();
	<?if (!ereg('^view', $action)) {?>
    setCar();
	<?} else {?>
	changePersonType();
	<?}?>
	setDriversId();
    
    setCarsCount();
	
    initFocus(document.<?=$this->objectTitle?>);
	function calculateRenewInsuranceAmount(price) {
				$.ajax({
					type:       'POST',
					url:        'index.php',
					dataType:   'json',
					data:       'do=Products|calculateRenewInsuranceAmountInWindow' +
								'&product_types_id=' + getElementValue('product_types_id') +
								'&car_price=' + price+ 
								'&id=<?=$data['parent_id']?>' ,
						success: function(result) {
							$('#items0rate_kasko').val(result.rate_kasko);
							changeAmountKASKO(0);
						}
					}); 
	}
	$(document).ready(function(){
		$('.notEqual').css('background-color', '#ff6666');
		<? if ((!$data['end_datetime_format'] || $data['agreement_types_id']==1) && !ereg('^view', $action)) echo 'setEnd();'; ?>
		<? if ($data['agreement_types_id']==3 && !ereg('^view', $action)) { ?>
		
		$('#items0car_price').change(function(elem) {
			var price = parseFloat($( this ).val());
			 calculateRenewInsuranceAmount(price);
		});
		<?}?>
	});
	
	<? if ($this->mode != 'view') { ?>
	changeCompany();
	
	<?}?>
	function setFiftyFiftyLabel() {
		var financial_institutions_id = getElementValue('financial_institutions_id');
		if (financial_institutions_id==25 || financial_institutions_id==59) 
			$("#options_fifty_fifty_label").html('Розумне КАСКО:');
		else	
			$("#options_fifty_fifty_label").html('50 на 50:');
	}

	$(document).ready(function(){
		<? if ($this->mode != 'view') { ?>
			changeExpressProduct();
			setDeterioration();
		<?} else {?>
			 setFiftyFiftyLabel();
             setExpressProductVisibility();
		<?}?>
		$('input[name="options_deterioration_no"]').bind('change',
							function() {setDeterioration();}
						);
		show500Block();				
		<? if ($action == 'insert' || $action == 'update') 
		{
			echo 'changeFinancialInstitution();';
			if ($change_seller) {
			?>
			
			$('#seller_agencies_id').bind('change', function() {
				loadManagers();
			});

			function loadManagers()
			{
				$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'html',
				data:       'do=Policies|loadAgentsInWindow' +
							'&agencies_id=' + getElementValue('seller_agencies_id') +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&agent_field=seller_agents_id'+
							'&old_agents_id=<?=intval($data['seller_agents_id'])?>',
					success: function(result) {
						document.getElementById('selectmanager').innerHTML=result;
					}
				});
				
				$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'html',
				data:       'do=Policies|loadAgentsInWindow' +
							'&agencies_id=' + getElementValue('seller_agencies_id') +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&agent_field=manager_id'+
							'&isseller=1'+
							'&old_agents_id=<?=intval($data['manager_id'])?>',
					success: function(result) {
						document.getElementById('selectsellermanager').innerHTML=result;
					}
				});
			}
			loadManagers();
			<?
			}
			if ($data['agreement_types_id']==2 || $data['agreement_types_id']==4) echo 	'setEnd();';
		
		
		}
		?>
		
		
		
	});
</script>