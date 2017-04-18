<div class="block">
<script>
	var num1 = -1;
	var num2 = -1;
    var num3 = -1;

	function getTotalByName(form, name, subname) {
        var total = 0;

        for (i=0; i < form.length; i++) {
            if (form.elements[ i ].name.indexOf(name) != -1 && form.elements[ i ].name.indexOf(subname) != -1) {
                if (form.elements[ i ].value != '' && isNaN(parseFloat(form.elements[ i ].value.replace(',', '.')))) {
                    alert('Формат вартості не вірний!');
                    form.elements[ i ].value = '';
                    return 0;
                } else {
                    total += parseFloat(form.elements[ i ].value.replace(',', '.'));
                }
            }
        }

        return total;
    }

	function addLoses() {
        var row	= document.getElementById('loses').insertRow(document.getElementById('loses').rows.length );
        row.style.background = (document.getElementById('loses').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="loses' + num3 + 'date" losesId="'+num3+'" name="loses[' + num3 + '][date]" maxlength="10" class="fldDatePicker calendarDate" onfocus="this.className=\'fldDatePickerOver calendarDate\'" onblur="this.className=\'fldDatePicker calendarDate\'" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="loses' + num3 + 'text" name="loses[' + num3 + '][text]" value="" maxlength="200" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" />';

		
		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="loses' + num3 + 'amount" name="loses[' + num3 + '][amount]" value="" maxlength="12" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="setAmountPayments()" />';

		var cell        = row.insertCell(-1);
        cell.innerHTML  = '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteLoses(this)" />';

		num3--;

		initDatePicker();
	}

	function deleteLoses(obj) {
        if (confirm('Ви дійсно бажаєте вилучити запис?')) {
            document.getElementById('loses').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            for(i=0; i<document.getElementById('loses').rows.length; i++) {
                document.getElementById('loses').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
            }
        }
    }
	
	function addItem() {
		var row	= document.getElementById('items').insertRow(1);
		row.style.background = (document.getElementById('items').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

		var title=$('#objecttitle').val();
		var address=$('#object_location').val();

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'title" name="items[' + num1 + '][title]" value="'+title+'" maxlength="250" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'storage" name="items[' + num1 + '][storage]" value="'+address+'" maxlength="170" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'cost" name="items[' + num1 + '][cost]" value="" maxlength="12" class="fldMoney total_cost" onchange="calcTotalCost();" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'quantity" name="items[' + num1 + '][quantity]" value="" maxlength="5" class="fldInteger" onfocus="this.className=\'fldIntegerOver\'" onblur="this.className=\'fldInteger\'" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'price" name="items[' + num1 + '][price]" value="" maxlength="12" class="fldMoney total_price" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="setItemAmount(' + num1 + ')" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<div style="text-align: right; padding-right: 7px;"><a href="javascript:addRisk(' + num1 + ')"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати ризик/франшизу" /></a></div><table id="risks' + num1 + '" width="100%" cellpadding="5" cellspacing="0"></table>';

		cell.innerHTML  = '<td>';
		cell.innerHTML  += '<input type="text" name="items[' + num1 + '][value]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'"  />';
		cell.innerHTML  += '<input type="radio" name="items[' + num1 + '][absolute]" value="0" checked/>%';
		cell.innerHTML  += '<input type="radio" name="items[' + num1 + '][absolute]" value="1"  /> грн.';
		cell.innerHTML  += '</td>';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'rate" name="items[' + num1 + '][rate]" value="" maxlength="6" class="fldPercent" onfocus="this.className=\'fldPercentOver\'" onblur="this.className=\'fldPercent\'" onchange="setItemAmount(' + num1 + ')" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="items' + num1 + 'amount" name="items[' + num1 + '][amount]" value="" maxlength="10" class="fldMoney total_amount" onchange="calcTotalAmount();"/>';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteItem(this)" />';

		num1--;
	}

    function deleteItem(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибране майно?')) {
            document.getElementById('items').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            for(i=0; i<document.getElementById('items').rows.length; i++) {
                document.getElementById('items').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
            }

			setItemAmount();
        }
    }
	
	function setItemAmount(i) {
		var amount = number_format((parseFloat($('#items' + i + 'price').val()) * parseFloat($('#items' + i + 'rate').val()) / 100), 2, '.', '');

		if (isNaN(amount)) {
			amount = 0;
		}

		$('#items' + i + 'amount').val( amount );

		setAmount();
		var total_price = 0;

		$('input[name$=[price]]').each(function(index, value) {
			total_price += parseFloat(value.value);
		});

		$('#total_price').html(total_price);

		var total_amount = 0;

		$('input[name$=[amount]]').each(function(index, value) {
			total_amount += parseFloat(value.value);
		});

		$('#total_amount').html(total_amount);
	}

	function setAmount() {
		price	= getTotalByName(document.<?=$this->objectTitle?>, 'items', 'price');
		amount	= getTotalByName(document.<?=$this->objectTitle?>, 'items', 'amount');

		$('#totalBlock').html(getRateFormat(amount / price * 100) + '%, ' + getMoneyFormat(amount));
	}

	function setVisibility() {
		var object_typeId = $('#object_type').val();

		if (object_typeId == 1) {
			$('#houseTypeBlock').css('display', '');
			$('.bud').css('display', '');
			//$('.skladAreaBlock').css('display', 'none');
		} else {
			$('input[name=housesTypesId]').val(0);
			$('#houseTypeBlock').css('display', 'none');
			$('.bud').css('display', 'none');
			$('#houses_types_id').val(0);
			//$('.skladAreaBlock').css('display', '');
		}

		if (object_typeId == 2) {
			$('.eqp').css('display', '');
		} else {
			$('.eqp').css('display', 'none');
			$('#equipments_types_id').val(0);
		}

		if (object_typeId == 2) {
			$('.object_areaBlock').css('display', 'none');
		} else {
			$('.object_areaBlock').css('display', '');
		}

		if (object_typeId == 3) {
			$('.tmcblock').css('display', '');
		} else {
			$('.tmcblock').css('display', 'none');
			$('#tmc_types_id').val(0);
		}

		if (object_typeId == 4) {
			$('.contentblock').css('display', '');
		} else {
			$('.contentblock').css('display', 'none');
			$('#contents_types_id').val(0);
		}
		if ($('#houses_types_id').val() != 7) {
//			$('input[name=total_stock_area]').val('');
		}

		sklad = false;
		if ($('#houses_types_id').val() == 7 || $('#object_houses_types_id').val() == 7) {//склад
			$('.skladType').css('display', '');
			sklad = true;
			$('.object_areaBlock').css('display', 'none');
			$('.skladAreaBlock').css('display', '');
		} else {
			$('.skladType').css('display', 'none');
			$('.skladAreaBlock').css('display', 'none');
		}

		if (!sklad) {
			$('input[name=stock_type_id][value=1]').attr('checked', '');
			$('input[name=stock_type_id][value=2]').attr('checked', '');
			//$('.skladAreaBlock').css('display', 'none');
		} else {
			//$('.skladAreaBlock').css('display', '');
		}
		
		/*if ($('#houses_types_id').val() == 7)
		{
			$('.skladAreaBlock').css('display', '');
		}
		else
			$('.skladAreaBlock').css('display', 'none');
			*/
//alert($('.skladAreaBlock').css('display'));
		if (parseInt($('input[name=stock_type_id]:checked').val()) > 0) {
			$('.skladType1').css('display', '');
			if (parseInt($('input[name=stock_type_id]:checked').val()) == 1) {
				$('.skladType2').css('display', 'none');
			} else {
				$('.skladType2').css('display', '');
			}
		} else {
			$('.skladType1').css('display', 'none');
		}

		if (object_typeId == 2 || object_typeId == 3 || object_typeId == 4) {
			$('.houseType1').css('display', '');
		} else {
			$('.houseType1').css('display', 'none');
			$('#object_houses_types_id').val(0);
		}
		
		if (object_typeId == 2) {
			$('.objectEquipmentBlock').css('display', '');
		} else {
			$('.objectEquipmentBlock').css('display', 'none');
			$('input[name=object_equipment_area]').val('');
		}

		if ($('input[name=other_person_goods]:checked').val() == 1) {
			$('.other_person_goods_accessBlock').css('display', '');
		} else {
			$('.other_person_goods_accessBlock').css('display', 'none');
			$('input[name=other_person_goods_access]').val('');
		}

		if ($('input[name=stock_load_unload]:checked').val() == 1) {
			$('.stock_load_unloadBlock').css('display', '');
		} else {
			$('.stock_load_unloadBlock').css('display', 'none');
			$('input[name=stock_load_unload_type]').val('');
		}

		skladB = false;
		if (sklad == true && parseInt($('input[name=stock_type_id]:checked').val())==2) {
			skladB = true;
		}

		skladA = false;
		if (sklad==true && parseInt($('input[name=stock_type_id]:checked').val())==1) {
			skladA=true;
		}

		if (object_typeId == 3) {// если ТМЦ
			$('.tmcBlock').css('display', '');
		} else {
			$('.tmcBlock').css('display', 'none');
			$('input[name=other_person_goods][value=0]').attr('checked', 'checked');
			$('input[name=stock_load_unload][value=0]').attr('checked', 'checked');
			$('input[name=other_person_goods_access]').val('');
			$('input[name=stock_load_unload_type]').val('');
			$('input[name=doors_count]').val('');
			$('input[name=personal_count]').val('');
		}

		if (skladB == true) {
			$('.notB').css('display', 'none');
			$('input[name=total_house_area]').val('');
			$('input[name=object_area]').val('');
			$('input[name=floor_count]').val('');
			$('input[name=object_floor]').val('');
			$('input[name=object_equipment_area]').val('');
			$('input[name=wallmaterial]').val('');
			$('input[name=roofmaterial]').val('');
			$('input[name=footingmaterial]').val('');
			$('input[name=overlapmaterial]').val('');
			$('input[name=decorationmaterial]').val('');
			$('input[name=sprinklers_source]').val('');
			$('input[name=sprinklers][value=0]').attr('checked', 'checked');
			$('input[name=fire_alarm][value=0]').attr('checked', 'checked');
			//$('.skladAreaBlock').css('display', 'none');
		} else {
			$('.notB').css('display', '');
			//if (skladA);
			//$('.skladAreaBlock').css('display', '');
		}

		if ($('input[name=distance_object_lt20]:checked').val() == 1) {// если відстань до об'єкта страхування менше 20 м
			$('.objtype1Block').css('display', '');
		} else {
			$('.objtype1Block').css('display', 'none');
			$('#objtype1').val('');
		}
		
		if ($('input[name=distance_object_gt20]:checked').val()==1) {// если відстань до об'єкта страхування бiльше 20 м
			$('.objtype2Block').css('display', '');
		} else {
			$('.objtype2Block').css('display', 'none');
			$('textarea[name=objtype2]').val('');
		}

		if ($('input[name=extinguisher]:checked').val() == 1) {
			$('.extinguisherBlock').css('display', '');
		} else {
			$('.extinguisherBlock').css('display', 'none');
			$('input[name=extinguisher_count]').val('');
			$('input[name=extinguisher_type]').val('');
		}

		if ($('input[name=sprinklers]:checked').val() == 1) {
			$('.sprinklersBlock').css('display', '');
		} else {
			$('.sprinklersBlock').css('display', 'none');
			$('input[name=sprinklers_source]').val('');
		}

		if ($('input[name=fire_alarm]:checked').val() == 1) {
			$('.fire_alarmBlock').css('display', '');
		} else {
			$('.fire_alarmBlock').css('display', 'none');
			$('input[name=sensor_heat][value=0]').attr('checked', 'checked');
			$('input[name=sensor_smoke][value=0]').attr('checked', 'checked');
		}

		if ($('input[name=has_pdto_alarm]:checked').val() == 1) {
			$('.PDTOAlarmBlock').css('display', '');
		} else {
			$('.PDTOAlarmBlock').css('display', 'none');
			$('input[name=manual_pdto][value=0]').attr('checked', 'checked');
			$('input[name=automatic_pdto][value=0]').attr('checked', 'checked');
		}

		if ($('input[name=has_protection]:checked').val() == 1) {
			$('.has_protectionBlock').css('display', '');
			$('input[name=no_protection][value=0]').attr('checked', 'checked');
			$('.hasNoProtectionBlock').css('display', 'none');
		} else {
			$('.has_protectionBlock').css('display', 'none');
			$('input[name=no_protection][value=1]').attr('checked', 'checked');
			$('.hasNoProtectionBlock').css('display', '');
			$('input[name=mvs_protection][value=0]').attr('checked', 'checked');
			$('input[name=ooxp_protection][value=0]').attr('checked', 'checked');
			$('input[name=nonmilitary_protection][value=0]').attr('checked', 'checked');
			$('input[name=private_protection][value=0]').attr('checked', 'checked');
			$('input[name=armored_doors][value=0]').attr('checked', 'checked');
			$('input[name=fense][value=0]').attr('checked', 'checked');
		}

		if ($('input[name=no_protection]:checked').val() == 1) {
			$('.no_protection_reasonBlock').css('display', '');
		} else {
			$('.no_protection_reasonBlock').css('display', 'none');
			$('input[name=no_protection_reason]').val('');
		}

		if ($('input[name=mvs_protection]:checked').val() == 1) {
			$('.mvs_protectionBlock').css('display', '');
		} else {
			$('.mvs_protectionBlock').css('display', 'none');
			$('input[name=mvs_guards]').val('');
			$('input[name=mvs_detours]').val('');
		}

		if ($('input[name=ooxp_protection]:checked').val() == 1) {
			$('.ooxp_protectionBlock').css('display', '');
		} else {
			$('.ooxp_protectionBlock').css('display', 'none');
			$('input[name=ooxp_guards]').val('');
			$('input[name=ooxp_detours]').val('');
		}

		if ($('input[name=nonmilitary_protection]:checked').val() == 1) {
			$('.nonmilitary_guardsBlock').css('display', '');
		} else {
			$('.nonmilitary_guardsBlock').css('display', 'none');
			$('input[name=nonmilitary_guards]').val('');
			$('input[name=nonmilitary_detours]').val('');
		}

		if ($('input[name=private_protection]:checked').val() == 1) {
			$('.private_protectionBlock').css('display', '');
		} else {
			$('.private_protectionBlock').css('display', 'none');
			$('input[name=private_guards]').val('');
			$('input[name=private_detours]').val('');
		}

		if ($('#fire_expenses').val() == 1) {
			$('.fire_expenses_limitBlock').css('display', '');
		} else {
			$('.fire_expenses_limitBlock').css('display', 'none');
			$('input[name=fire_expenses_limit]').val('');
		}

		if ($('#cleaning_expenses').val() == 1) {
			$('.cleaning_expensesBlock').css('display', '');
		} else {
			$('.cleaning_expensesBlock').css('display', 'none');
			$('input[name=cleaning_expenses_limit]').val('');
		}

		if ($('#glasses_expenses').val() == 1) {
			$('.glasses_expensesBlock').css('display', '');
		} else {
			$('.glasses_expensesBlock').css('display', 'none');
			$('input[name=glasses_expenses_limit]').val('');
			$('#glasses_expenses_deductible').val('');
		}

		if ($('#damage_expenses').val() == 1) {
			$('.damage_expensesBlock').css('display', '');
		} else {
			$('.damage_expensesBlock').css('display', 'none');
			$('input[name=damage_expenses_limit]').val('');
			$('#damage_expenses_deductible').val('');
		}

		if ($('#interruption_expenses').val() == 1) {
			$('.interruption_expensesBlock').css('display', '');
		} else {
			$('.interruption_expensesBlock').css('display', 'none');
			$('input[name=interruption_expenses_limit]').val('');
			$('input[name=interruption_expenses_deductible]').val('');
		}

		if ($('#property_ownership').val() == 4) {
			$('.property_ownershipBlock').css('display', '');
		} else {
			$('.property_ownershipBlock').css('display', 'none');
			$('input[name=property_ownership_other]').val('');
		}

		if ($('#property_accepted_type').val() == 4) {
			$('.property_accepted_typeSumBlock').css('display', '');
		} else {
			$('.property_accepted_typeSumBlock').css('display', 'none');
			$('input[name=insured_responsible_sum]').val('');
		}

		if ($('input[name=last5_loses]:checked').val() == 1) {
			$('.losestab').css('display', '');
		} else {
			$('.losestab').css('display', 'none');
		}

		if ($('input[name=cctvsystem]:checked').val() == 1) {
			$('.cctvsystemBlock').css('display', '');
		} else {
			$('.cctvsystemBlock').css('display', 'none');
			$('input[name=cctv_territory][value=0]').attr('checked', 'checked');
			$('input[name=cctvindoors][value=0]').attr('checked', 'checked');
		}

		if ($('input[name=fire_substances]:checked').val() == 1) {
			$('.fire_substancesBlock').css('display', '');
		} else {
			$('.fire_substancesBlock').css('display', 'none');
			$('input[name=substance_name]').val('');
			$('input[name=substance_type]').val('');
			$('input[name=substance_amount]').val('');
			$('input[name=substance_storing_type]').val('');
			$('input[name=safety_futures]').val('');
		}
	}

	function calcTotalCost() {
		var total_cost = 0;

		$('input[name$=[cost]]').each(function(index, value) {
			total_cost += parseFloat(value.value);
		});

		$('#total_cost').html(total_cost);
	}

	function calcTotalPrice() {
		var total_price = 0;

		$('input[name$=[price]]').each(function(index, value) {
			total_price += parseFloat(value.value);
		});

		$('#total_price').html(total_price);
	}

	function calcTotalAmount(){
		var total_amount = 0;

		$('input[name$=[amount]]').each(function(index, value) {
			total_amount += parseFloat(value.value);
		});

		$('#total_amount').html( total_amount );
	}

	$(function() {
		$('#object_type').bind('change', function() {setVisibility();} );
		$('#organization_types_id').bind('change', function() {setVisibility();} );
		$('#houses_types_id').bind('change', function() {setVisibility();} );
		$('input[name=stock_type_id]').bind('change', function() {setVisibility();} );
		$('input[name=other_person_goods]').bind('change', function() {setVisibility();} );
		$('input[name=stock_load_unload]').bind('change', function() {setVisibility();} );
		$('#object_houses_types_id').bind('change', function() {setVisibility();} );
		$('input[name=distance_object_lt20]').bind('change', function() {setVisibility();} );
		$('input[name=distance_object_gt20]').bind('change', function() {setVisibility();} );
		$('input[name=extinguisher]').bind('change', function() {setVisibility();} );
		$('input[name=sprinklers]').bind('change', function() {setVisibility();} );
		$('input[name=fire_alarm]').bind('change', function() {setVisibility();} );
		$('input[name=has_pdto_alarm]').bind('change', function() {setVisibility();} );
		$('input[name=has_protection]').bind('change', function() {setVisibility();} );
		$('input[name=mvs_protection]').bind('change', function() {setVisibility();} );
		$('input[name=ooxp_protection]').bind('change', function() {setVisibility();} );
		$('input[name=nonmilitary_protection]').bind('change', function() {setVisibility();} );
		$('input[name=private_protection]').bind('change', function() {setVisibility();} );
		$('input[name=armored_doors]').bind('change', function() {setVisibility();} );
		$('input[name=no_protection]').bind('change', function() {setVisibility();} );
		$('#fire_expenses').bind('change', function() {setVisibility();} );
		$('#cleaning_expenses').bind('change', function() {setVisibility();} );
		$('#glasses_expenses').bind('change', function() {setVisibility();} );
		$('#damage_expenses').bind('change', function() {setVisibility();} );
		$('#interruption_expenses').bind('change', function() {setVisibility();} );
		$('#property_ownership').bind('change', function() {setVisibility();} );
		$('#property_accepted_type').bind('change', function() {setVisibility();} );			
		$('input[name=last5_loses]').bind('change', function() {setVisibility();} );
		$('input[name=cctvsystem]').bind('change', function() {setVisibility();} );	
		$('input[name=fire_substances]').bind('change', function() {setVisibility();} );	

		setVisibility();
	});
</script>
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
				<input type="hidden" id="id" name="id" value="<?=$data['id']?>" />
				<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
				<input type="hidden" name="product_types_id" value="<?=$_REQUEST['product_types_id']?>" />
				<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
				<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Назва об'єкта страхування:</td>
					<td><input id="objecttitle" type="text" name="title" value="<?=$data['title']?>" class="fldText company<?=$this->isEqual('title')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('title')?>'" onblur="this.className='fldText company<?=$this->isEqual('title')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Тип об'єкту страхування:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('object_type') ], $data['object_type'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('object_type'))?></td>
				</tr>
				</table>
	
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top">
						<table cellpadding="5" cellspacing="0" id="houseTypeBlock">
						<tr>
							<td class="label grey">Тип конструкції:</td>
							<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('construction_types_id') ], $data['construction_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('construction_types_id'))?></td>
						</tr>
						</table>
					</td>
					<td>
						<table cellpadding="5" cellspacing="0" class="eqp">
						<tr>
							<td class="label grey">Призначення об'єкта страхування:</td>
							<td><input type="text" name="object_purpose" value="<?=$data['object_purpose']?>" class="fldText company<?=$this->isEqual('object_purpose')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('object_purpose')?>'" onblur="this.className='fldText company<?=$this->isEqual('object_purpose')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>

				<div class="section">Тип об'єкта страхування:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey bud"><?=$this->getMark()?>Будинки, споруди, приміщення:</td>
					<td class="bud"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('houses_types_id') ], $data['houses_types_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('organization_types_id'))?></td>
					<td class="label grey eqp"><?=$this->getMark()?>Обладнання:</td>
					<td class="eqp"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('equipments_types_id') ], $data['equipments_types_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('equipments_types_id'))?></td>
					<td class="label grey tmcblock"><?=$this->getMark()?>ТМЦ:</td>
					<td class="tmcblock"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('tmc_types_id') ], $data['tmc_types_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('tmc_types_id'))?></td>
					<td class="label grey contentblock"><?=$this->getMark()?>Вміст:</td>
					<td class="contentblock"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('contents_types_id') ], $data['contents_types_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('contents_types_id'))?></td>
				</tr>
				</table>

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey houseType1"><?=$this->getMark()?>Тип будівлі/споруди, де знаходиться об'єкт страхування:</td>
					<td class="houseType1"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('object_houses_types_id') ], $data['object_houses_types_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('organization_types_id'))?></td>
					<td class="skladType">

						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey"><?=$this->getMark(false)?>Тип складу:</td>
							<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('stock_type_id') ], $data['stock_type_id' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
						</tr>
						</table><br />

						<table cellpadding="5" cellspacing="0" class="skladType1">
						<tr>
							<td class="label grey skladType2">Загальна площа території:</td>
							<td class="skladType2"><input type="text" name="stock_area" value="<?=$data['stock_area']?>"   class="fldText company<?=$this->isEqual('stock_area')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('stock_area')?>'" onblur="this.className='fldText company<?=$this->isEqual('stock_area')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						<tr>
							<td class="label grey skladType2">Вид огорожі:</td>
							<td class="skladType2"><input type="text" name="barrier_type" value="<?=$data['barrier_type']?>" class="fldText company<?=$this->isEqual('barrier_type')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('barrier_type')?>'" onblur="this.className='fldText company<?=$this->isEqual('barrier_type')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>

				<table cellpadding="5" cellspacing="0" class="skladAreaBlock">
				<tr>
					<td class="label grey">Загальна площа складу, м<sup>2</sup>:</td>
					<td><input type="text" name="total_stock_area" value="<?=$data['total_stock_area']?>" class="fldText company<?=$this->isEqual('total_stock_area')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('total_stock_area')?>'" onblur="this.className='fldText company<?=$this->isEqual('total_stock_area')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>

				<div class="section tmcBlock"><b>Умови зберігання складських запасів:</b></div>
				<table cellpadding="5" cellspacing="0" class="tmcBlock">
				<tr>
					<td>
						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey"><?=$this->getMark(false)?>Чи зберігаються на території складу товари,<br />які належать іншим особам:</td>
							<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('other_person_goods') ], $data['other_person_goods' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
						</tr>
						</table><br />

						<table cellpadding="5" cellspacing="0" class="other_person_goods_accessBlock" >
						<tr>
							<td class="label grey">Чи обмежено доступ власників таких товарів<br />до товарів, що належать заявнику і яким чином:</td>
							<td><input type="text" name="other_person_goods_access" value="<?=$data['other_person_goods_access']?>" class="fldText company<?=$this->isEqual('other_person_goods_access')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('other_person_goods_access')?>'" onblur="this.className='fldText company<?=$this->isEqual('other_person_goods_access')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table><br />
					</td>
					<td>
						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey"><?=$this->getMark(false)?>Чи здійснюється на теритоії<br />складу завантаження/розвантаження:</td>
							<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('stock_load_unload') ], $data['stock_load_unload'], $data['languageCode'], $this->getReadonly(true), $data)?></td>
						</tr>
						</table><br />

						<table cellpadding="5" cellspacing="0" class="stock_load_unloadBlock">
						<tr>
							<td class="label grey">Яким чином здійснюються такі операції:</td>
							<td><input type="text" name="stock_load_unload_type" value="<?=$data['stock_load_unload_type']?>" class="fldText company<?=$this->isEqual('stock_load_unload_type')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('stock_load_unload_type')?>'" onblur="this.className='fldText company<?=$this->isEqual('stock_load_unload_type')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey">Кількість зовнішніх входів<br />до складських приміщень:</td>
							<td><input type="text" name="doors_count" value="<?=$data['doors_count']?>" class="fldText company<?=$this->isEqual('doors_count')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('doors_count')?>'" onblur="this.className='fldText company<?=$this->isEqual('doors_count')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</td>
					<td>
						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey">Кількість персоналу,<br />щопрацює на території складу:</td>
							<td><input type="text" name="personal_count" value="<?=$data['personal_count']?>" class="fldText company<?=$this->isEqual('personal_count')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('personal_count')?>'" onblur="this.className='fldText company<?=$this->isEqual('personal_count')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey"><b>Наявніть на складі вогненебезпечних речовин:</b></td>
							<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('fire_substances') ], $data['other_person_goods' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
						</tr>
						</table>
					</td>
					<td>
						<table cellpadding="5" cellspacing="0" class="fire_substancesBlock">
						<tr>
							<td class="label grey">назва речовини:</td>
							<td><input type="text" name="substance_name" value="<?=$data['substance_name']?>" class="fldText company<?=$this->isEqual('substance_name')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('substance_name')?>'" onblur="this.className='fldText company<?=$this->isEqual('substance_name')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						<tr>
							<td class="label grey">тип (рідина, газ, тверда):</td>
							<td><input type="text" name="substance_type" value="<?=$data['substance_type']?>" class="fldText company<?=$this->isEqual('substance_type')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('substance_type')?>'" onblur="this.className='fldText company<?=$this->isEqual('substance_type')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						<tr>
							<td class="label grey">кількість:</td>
							<td><input type="text" name="substance_amount" value="<?=$data['substance_amount']?>" class="fldText company<?=$this->isEqual('substance_amount')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('substance_amount')?>'" onblur="this.className='fldText company<?=$this->isEqual('substance_amount')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						<tr>
							<td class="label grey">спосіб зберігання:</td>
							<td><input type="text" name="substance_storing_type" value="<?=$data['substance_storing_type']?>" class="fldText company<?=$this->isEqual('substance_storing_type')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('substance_storing_type')?>'" onblur="this.className='fldText company<?=$this->isEqual('substance_storing_type')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						<tr>
							<td class="label grey">особливі засоби безпеки:</td>
							<td><input type="text" name="safety_futures" value="<?=$data['safety_futures']?>" class="fldText company<?=$this->isEqual('safety_futures')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('safety_futures')?>'" onblur="this.className='fldText company<?=$this->isEqual('safety_futures')?>'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>

				<div class="section tmcBlock">Характеристика складських приміщень/території, де зберігаються складські запаси:</div>
				<table cellpadding="5" cellspacing="0" border=0 class="tmcBlock">
				<tr>
					<td class="label grey">Висота стелажів, м.:</td>
					<td><input type="text" name="racking_height" value="<?=$data['racking_height']?>" class="fldText company<?=$this->isEqual('racking_height')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('racking_height')?>'" onblur="this.className='fldText company<?=$this->isEqual('racking_height')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Ширина проходів, м.:</td>
					<td><input type="text" name="passess_width" value="<?=$data['passess_width']?>" class="fldText company<?=$this->isEqual('passess_width')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('passess_width')?>'" onblur="this.className='fldText company<?=$this->isEqual('passess_width')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey">Ступінь захисту:</td>
					<td><input type="text" name="defense_type" value="<?=$data['defense_type']?>" class="fldText company<?=$this->isEqual('defense_type')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('defense_type')?>'" onblur="this.className='fldText company<?=$this->isEqual('defense_type')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Чи дозволяється особам, які не<br />працюють на складі, перебувати на території складу:</td>
					<td><input type="text" name="person_on_stock" value="<?=$data['person_on_stock']?>" class="fldText company<?=$this->isEqual('person_on_stock')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('person_on_stock')?>'" onblur="this.className='fldText company<?=$this->isEqual('person_on_stock')?>'" <?=$this->getReadonly(false)?> /></td>
					<td colspan="2"></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0" class="notB">
				<tr>
					<td class="label grey">Загальна площа будівлі, м<sup>2</sup>:</td>
					<td><input type="text" name="total_house_area" value="<?=$data['total_house_area']?>" class="fldText company<?=$this->isEqual('total_house_area')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('total_house_area')?>'" onblur="this.className='fldText company<?=$this->isEqual('total_house_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey object_areaBlock"><b>Площа об'єкта, м<sup>2</sup>:</b></td>
					<td class="object_areaBlock"><input type="text" name="object_area" value="<?=$data['object_area']?>" class="fldText company<?=$this->isEqual('object_area')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('object_area')?>'" onblur="this.className='fldText company<?=$this->isEqual('object_area')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey objectEquipmentBlock" rowspan=2><b>Площа приміщення,<br />де знаходиться обладнання, м<sup>2</sup>:</b></td>
					<td rowspan=2 class="objectEquipmentBlock"><input type="text" name="object_equipment_area" value="<?=$data['object_equipment_area']?>" class="fldText company<?=$this->isEqual('object_equipment_area')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('object_equipment_area')?>'" onblur="this.className='fldText company<?=$this->isEqual('object_equipment_area')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey">Скільки поверхів у будівлі:</td>
					<td><input type="text" name="floor_count" value="<?=$data['floor_count']?>" class="fldText company<?=$this->isEqual('floor_count')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('floor_count')?>'" onblur="this.className='fldText company<?=$this->isEqual('floor_count')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey object_floorBlock">На якому поверсі розташований об'єкт:</td>
					<td class="object_floorBlock"><input type="text" name="object_floor" value="<?=$data['object_floor']?>" class="fldText company<?=$this->isEqual('object_floor')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('object_floor')?>'" onblur="this.className='fldText company<?=$this->isEqual('object_floor')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey notB">Вік будівлі/складу:</td>
					<td class="notB"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('house_years') ], $data['house_years' ], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('house_years'))?></td>
					<td class="label grey eqp">Вік обладнання:</td>
					<td class="eqp"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('equipment_years') ], $data['equipment_years' ], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('equipment_years'))?></td>
					<td class="label grey eqp" rowspan="2">Досвід персоналу,<br />що має доступ до обладнання:</td>
					<td rowspan="2" class="eqp"><input type="text" name="staff_experience" value="<?=$data['staff_experience']?>" class="fldText company<?=$this->isEqual('staff_experience')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('staff_experience')?>'" onblur="this.className='fldText company<?=$this->isEqual('staff_experience')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey">Місцезнаходженния<br />об'єкта страхування:</td>
					<td><input type="text" id="object_location" name="object_location" value="<?=$data['object_location']?>" class="fldText company<?=$this->isEqual('object_location')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('object_location')?>'" onblur="this.className='fldText company<?=$this->isEqual('object_location')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Додаткова інформація<br />про об'єкт страхування:</td>
					<td><textarea cols="45" rows="5" name="additional_info" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?> /><?=$data['additional_info']?></textarea></td>
				</tr>
				</table><br />

				<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label grey" rowspan=2><b>Сусідні об'єкти:</b></td>
					<td>відстань до об'єкта страхування менше 20 м <?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('distance_object_lt20') ], $data['distance_object_lt20' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td style="padding-left:20px">відстань до об'єкта страхування бiльше 20 м <?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('distance_object_gt20') ], $data['distance_object_gt20' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				<tr>
					<td>
						<table class="objtype1Block">
						<tr>
							<td>тип об'єкта</td>
							<td><textarea cols="45" rows="5" name="objtype1" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?> /><?=$data['objtype1']?></textarea></td>
						</tr>
						</table>
					</td>		
					<td>
						<table class="objtype2Block">
						<tr>
							<td>тип об'єкта</td>
							<td><textarea cols="45" rows="5" name="objtype2" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?> /><?=$data['objtype1']?></textarea></td>
						</tr>
						</table>						
					</td>							
				</tr>
				</table><br />
	
				<table cellpadding="5" cellspacing="0" class="notB">
				<tr>
					<td class="label grey"><b>Матеріал:</b></td>
					<td class="label grey">Стін:</td>
					<td><input type="text" name="wallmaterial" value="<?=$data['wallmaterial']?>" class="fldText company<?=$this->isEqual('wallmaterial')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('wallmaterial')?>'" onblur="this.className='fldText company<?=$this->isEqual('wallmaterial')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Крівлі:</td>
					<td><input type="text" name="roofmaterial" value="<?=$data['roofmaterial']?>" class="fldText company<?=$this->isEqual('roofmaterial')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('roofmaterial')?>'" onblur="this.className='fldText company<?=$this->isEqual('roofmaterial')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Фундаменту:</td>
					<td><input type="text" name="footingmaterial" value="<?=$data['footingmaterial']?>" class="fldText company<?=$this->isEqual('footingmaterial')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('footingmaterial')?>'" onblur="this.className='fldText company<?=$this->isEqual('footingmaterial')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td></td>
					<td class="label grey">Перекриттів:</td>
					<td><input type="text" name="overlapmaterial" value="<?=$data['overlapmaterial']?>" class="fldText company<?=$this->isEqual('overlapmaterial')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('overlapmaterial')?>'" onblur="this.className='fldText company<?=$this->isEqual('overlapmaterial')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Оздоблення:</td>
					<td><input type="text" name="decorationmaterial" value="<?=$data['decorationmaterial']?>" class="fldText company<?=$this->isEqual('decorationmaterial')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('decorationmaterial')?>'" onblur="this.className='fldText company<?=$this->isEqual('decorationmaterial')?>'" <?=$this->getReadonly(false)?> /></td>
					<td colspan="2"></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0" class="notB">
				<tr>
					<td class="label grey"><b>Забезпечуючі системи:</b></td>
					<td>Водопровідна:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('water_system') ], $data['water_system' ], $data['languageCode'], $this->getReadonly(true) . ' onchange=""', null, $data, $this->isEqual('water_system'))?></td>
					<td>Каналізаційна:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sewage_system') ], $data['sewage_system' ], $data['languageCode'], $this->getReadonly(true) . ' onchange=""', null, $data, $this->isEqual('sewage_system'))?></td>
					<td>Електрична:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('electric_sytem') ], $data['electric_sytem' ], $data['languageCode'], $this->getReadonly(true) . ' onchange=""', null, $data, $this->isEqual('electric_sytem'))?></td>
					<td>Опалювальна:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('heating_system') ], $data['heating_system' ], $data['languageCode'], $this->getReadonly(true) . ' onchange=""', null, $data, $this->isEqual('heating_system'))?></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0" class="notB">
				<tr>
					<td class="label grey">Вогнестійкість несучих об'ектів:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('fire_objects') ], $data['fire_objects' ], $data['languageCode'], $this->getReadonly(true) . ' onchange=""', null, $data, $this->isEqual('fire_objects'))?></td>
				</tr>
				</table><br />
			
				<div class="section">Засоби пожежної безпеки:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Вогнегасник:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('extinguisher') ], $data['extinguisher' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey extinguisherBlock">кількість:</td>
					<td class="extinguisherBlock"><input type="text" name="extinguisher_count" value="<?=$data['extinguisher_count']?>" class="fldText company<?=$this->isEqual('extinguisher_count')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('extinguisher_count')?>'" onblur="this.className='fldText company<?=$this->isEqual('extinguisher_count')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey extinguisherBlock">марка:</td>
					<td class="extinguisherBlock"><input type="text" name="extinguisher_type" value="<?=$data['extinguisher_type']?>" class="fldText company<?=$this->isEqual('extinguisher_type')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('extinguisher_type')?>'" onblur="this.className='fldText company<?=$this->isEqual('extinguisher_type')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0" class="notB">
				<tr>
					<td class="label grey">Спринклери:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('sprinklers') ], $data['sprinklers' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey sprinklersBlock">Джерело води для спринклерів:</td>
					<td class="sprinklersBlock"><input type="text" name="sprinklers_source" value="<?=$data['sprinklers_source']?>" class="fldText company<?=$this->isEqual('sprinklers_source')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('sprinklers_source')?>'" onblur="this.className='fldText company<?=$this->isEqual('sprinklers_source')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0" class="notB">
				<tr>
					<td class="label grey">Протипожежна сигналізація:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('fire_alarm') ], $data['fire_alarm' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey fire_alarmBlock"><b>тип датчиків:</b></td>
					<td class="label grey fire_alarmBlock">тепло:</td>
					<td class="fire_alarmBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('sensor_heat') ], $data['sensor_heat' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey fire_alarmBlock">дим:</td>
					<td class="fire_alarmBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('sensor_smoke') ], $data['sensor_smoke' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey fire_alarmBlock">вогонь:</td>
					<td class="fire_alarmBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('sensor_fire') ], $data['sensor_fire' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><b>Передача сигналу тривоги:</b></td>
					<td class="label grey">на пульт державної пожежної частини:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('signal_remote_state') ], $data['signal_remote_state' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey">на контрольний пункт на підприємстві:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('signal_enterprise') ], $data['signal_enterprise' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Відстань до державної пожежної частини:</td>
					<td><input type="text" name="distance_fire" value="<?=$data['distance_fire']?>" class="fldText company<?=$this->isEqual('distance_fire')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('distance_fire')?>'" onblur="this.className='fldText company<?=$this->isEqual('distance_fire')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Час до державної пожежної частини:</td>
					<td><input type="text" name="time_fire" value="<?=$data['time_fire']?>" class="fldText company<?=$this->isEqual('time_fire')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('time_fire')?>'" onblur="this.className='fldText company<?=$this->isEqual('time_fire')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Відсутня сигналізація (причина):</td>
					<td><input type="text" name="no_alarm" value="<?=$data['no_alarm']?>" class="fldText company<?=$this->isEqual('no_alarm')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('no_alarm')?>'" onblur="this.className='fldText company<?=$this->isEqual('no_alarm')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Інша сигналізація:</td>
					<td><input type="text" name="other_alarm" value="<?=$data['other_alarm']?>" class="fldText company<?=$this->isEqual('other_alarm')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('other_alarm')?>'" onblur="this.className='fldText company<?=$this->isEqual('other_alarm')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Наявність блискавковідводів:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('has_lightning') ], $data['has_lightning' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				</table><br />

				<div class="section">Захист від протиправних дій:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><b>Наявність сигналізації:</b></td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('has_pdto_alarm') ], $data['has_pdto_alarm' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey PDTOAlarmBlock">ручна:</td>
					<td class="PDTOAlarmBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('manual_pdto') ], $data['manual_pdto' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey PDTOAlarmBlock">автоматична:</td>
					<td class="PDTOAlarmBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('automatic_pdto') ], $data['automatic_pdto' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				</table><br />
	
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><b>Наявність охорони:</b></td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('has_protection') ], $data['has_protection' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td colspan="4"></td>
				</tr>
				<tr class="has_protectionBlock">
					<td class="label grey">державна (МВС):</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_protection') ], $data['mvs_protection' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey mvs_protectionBlock">кількість охоронців на зміні:</td>
					<td class="mvs_protectionBlock"><input type="text" name="mvs_guards" value="<?=$data['mvs_guards']?>" class="fldText flat<?=$this->isEqual('mvs_guards')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('mvs_guards')?>'" onblur="this.className='fldText flat<?=$this->isEqual('mvs_guards')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey mvs_protectionBlock">кількість обходів:</td>
					<td class="mvs_protectionBlock"><input type="text" name="mvs_detours" value="<?=$data['mvs_detours']?>" class="fldText flat<?=$this->isEqual('mvs_detours')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('mvs_detours')?>'" onblur="this.className='fldText flat<?=$this->isEqual('mvs_detours')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr class="has_protectionBlock">
					<td class="label grey">озброєна охорона (ООХР):</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('ooxp_protection') ], $data['ooxp_protection' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey ooxp_protectionBlock">кількість охоронців на зміні:</td>
					<td class="ooxp_protectionBlock"><input type="text" name="ooxp_guards" value="<?=$data['ooxp_guards']?>" class="fldText flat<?=$this->isEqual('ooxp_guards')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('ooxp_guards')?>'" onblur="this.className='fldText flat<?=$this->isEqual('ooxp_guards')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey ooxp_protectionBlock">кількість обходів:</td>
					<td class="ooxp_protectionBlock"><input type="text" name="ooxp_detours" value="<?=$data['ooxp_detours']?>" class="fldText flat<?=$this->isEqual('ooxp_detours')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('ooxp_detours')?>'" onblur="this.className='fldText flat<?=$this->isEqual('ooxp_detours')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr class="has_protectionBlock">
					<td class="label grey">відомча невоєнізована:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('nonmilitary_protection') ], $data['nonmilitary_protection' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey nonmilitary_guardsBlock">кількість охоронців на зміні:</td>
					<td class="nonmilitary_guardsBlock"><input type="text" name="nonmilitary_guards" value="<?=$data['nonmilitary_guards']?>" class="fldText flat<?=$this->isEqual('nonmilitary_guards')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('nonmilitary_guards')?>'" onblur="this.className='fldText flat<?=$this->isEqual('nonmilitary_guards')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey nonmilitary_guardsBlock">кількість обходів:</td>
					<td class="nonmilitary_guardsBlock"><input type="text" name="nonmilitary_detours" value="<?=$data['nonmilitary_detours']?>" class="fldText flat<?=$this->isEqual('nonmilitary_detours')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('nonmilitary_detours')?>'" onblur="this.className='fldText flat<?=$this->isEqual('nonmilitary_detours')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr class="has_protectionBlock">
					<td class="label grey">приватна:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('private_protection') ], $data['private_protection' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey private_protectionBlock">кількість охоронців на зміні:</td>
					<td class="private_protectionBlock"><input type="text" name="private_guards" value="<?=$data['private_guards']?>" class="fldText flat<?=$this->isEqual('private_guards')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('private_guards')?>'" onblur="this.className='fldText flat<?=$this->isEqual('private_guards')?>'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey private_protectionBlock">кількість обходів:</td>
					<td class="private_protectionBlock"><input type="text" name="private_detours" value="<?=$data['private_detours']?>" class="fldText flat<?=$this->isEqual('private_detours')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('private_detours')?>'" onblur="this.className='fldText flat<?=$this->isEqual('private_detours')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr class="has_protectionBlock">
					<td class="label grey">броньовані вхідні двері:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('armored_doors') ], $data['armored_doors' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey">огорожа, паркан:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('fense') ], $data['fense' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td colspan="2"></td>
				</tr>
				<tr class="hasNoProtectionBlock">
					<td class="label grey">відсутня:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('no_protection') ], $data['no_protection' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey no_protection_reasonBlock">вкажіть причину:</td>
					<td colspan="3" class="no_protection_reasonBlock"><input type="text" name="no_protection_reason" value="<?=$data['no_protection_reason']?>" class="fldText company<?=$this->isEqual('no_protection_reason')?>" onfocus="this.className='fldTextOver company<?=$this->isEqual('no_protection_reason')?>'" onblur="this.className='fldText company<?=$this->isEqual('no_protection_reason')?>'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table><br />
			
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><b>Система відеоспостереження:</b></td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('cctvsystem') ], $data['cctvsystem' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey cctvsystemBlock">на території:</td>
					<td class="cctvsystemBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('cctv_territory') ], $data['cctv_territory' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
					<td class="label grey cctvsystemBlock">в приміщенні:</td>
					<td class="cctvsystemBlock"><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('cctvindoors') ], $data['cctvindoors' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				</table><br />
	
				<div class="section">Страхові ризики:</div>
				<table><?=$this->getFieldPart($data, $actionType, $this->getFieldPositionByName('risks_id'))?></table>
	
				<div class="section">Додаткове страховне покриття:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="grey"><?=$this->getMark()?>Витрати, що пов'язані з гасінням пожежі та іншими заходами по ліквідації страхового випадку, спрямовані на зменшення наслідків страхового випадку:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('fire_expenses') ], $data['fire_expenses'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('fire_expenses'))?></td>
					<td class="label grey fire_expenses_limitBlock"><?=$this->getMark()?>Ліміт:</td>
					<td class="fire_expenses_limitBlock"><input type="text" name="fire_expenses_limit" value="<?=$data['fire_expenses_limit']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td colspan="2" class="fire_expenses_limitBlock"></td>
				</tr>
				<tr>
					<td class="grey"><?=$this->getMark()?>Витрати по розчищенню території, зламу і розбору руїн, вивезенню сміття, утилізації залишків майна та ін.:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('cleaning_expenses') ], $data['cleaning_expenses'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('cleaning_expenses'))?></td>
					<td class="label grey cleaning_expensesBlock"><?=$this->getMark()?>Ліміт:</td>
					<td class="cleaning_expensesBlock"><input type="text" name="cleaning_expenses_limit" value="<?=$data['cleaning_expenses_limit']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td colspan=2 class="cleaning_expensesBlock"></td>
				</tr>
				<tr>
					<td class="grey"><?=$this->getMark()?>Бій скла , вітрин, вітражів, скляних стін, віконних та дверних рам:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('glasses_expenses') ], $data['glasses_expenses'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('glasses_expenses'))?></td>
					<td class="label grey glasses_expensesBlock"><?=$this->getMark()?>Ліміт:</td>
					<td class="glasses_expensesBlock"><input type="text" name="glasses_expenses_limit" value="<?=$data['glasses_expenses_limit']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey glasses_expensesBlock"><?=$this->getMark()?>Франшиза</td>
					<td class="glasses_expensesBlock"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('glasses_expenses_deductible') ], $data['glasses_expenses_deductible'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('glasses_expenses_deductible'))?></td>
				</tr>
				<tr>
					<td class="grey"><?=$this->getMark()?>Пошкодження або знищення предметів, закріплених на зовнішній стороні застрахованої будівлі:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('damage_expenses') ], $data['damage_expenses'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('damage_expenses'))?></td>
					<td class="label grey damage_expensesBlock"><?=$this->getMark()?>Ліміт:</td>
					<td class="damage_expensesBlock"><input type="text" name="damage_expenses_limit" value="<?=$data['damage_expenses_limit']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey damage_expensesBlock"><?=$this->getMark()?>Франшиза:</td>
					<td class="damage_expensesBlock"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('damage_expenses_deductible') ], $data['damage_expenses_deductible'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('damage_expenses_deductible'))?></td>
				</tr>
				<tr>
					<td class="grey"><?=$this->getMark()?>Збитки від перерви у виробництві:</td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('interruption_expenses') ], $data['interruption_expenses'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('interruption_expenses'))?></td>
					<td class="label grey interruption_expensesBlock"><?=$this->getMark()?>Ліміт:</td>
					<td class="interruption_expensesBlock" ><input type="text" name="interruption_expenses_limit" value="<?=$data['interruption_expenses_limit']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey interruption_expensesBlock"><?=$this->getMark()?>Франшиза:</td>
					<td class="interruption_expensesBlock"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('interruption_expenses_deductible') ], $data['interruption_expenses_deductible'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('interruption_expenses_deductible'))?></td>
				</tr>
				</table>				

				<div class="section">Умови страхування:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
						<td class="label grey"><?=$this->getMark()?><b>Метод визначення вартості майна:</b></td>
						<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('method_property_cost') ], $data['method_property_cost'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('method_property_cost'))?></td>
						<td class="label grey"><?=$this->getMark()?><b>Форма власності об'єкту страхування:</b></td>
						<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('property_ownership') ], $data['property_ownership'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('property_ownership'))?></td>
						<td class="property_ownershipBlock"><input type="text" name="property_ownership_other" value="<?=$data['property_ownership_other']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?><b>Майно приймається на страхування:</b></td>
					<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('property_accepted_type') ], $data['property_accepted_type'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('property_accepted_type'))?></td>
					<td class="label grey property_accepted_typeSumBlock"><?=$this->getMark()?>Страхова сума відповідає:</td>
					<td class="property_accepted_typeSumBlock"><input type="text" name="insured_responsible_sum" value="<?=$data['insured_responsible_sum']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
					<td class="property_accepted_typeSumBlock">% від вартості майна</td>
				</tr>
				</table>

				<div class="section">Перелік застрахованого майна:</div>
				<table id="items" width="100%" cellpadding="5" cellspacing="0">
				<tr class="columns">
					<td width="200">Назва</td>
					<td width="200">Місце зберігання/адреса</td>
					<td width="100">Страхова вартість майна, грн.</td>
					<td width="100">Кількість, шт./площа, м<sup>2</sup></td>
					<td width="90">Страхова сума, грн.</td>
					<td>Франшизи</td>
					<td width="80">Тариф, %</td>
					<td width="80">Премія, грн.</td>
					<? if ($this->mode != 'view') { ?><td width="25"><a href="javascript:addItem()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати майно" /></a></td><? } ?>
				</tr>
				<?
					$i = 0;
					$total_cost=0;
					$total_price=0;
					$total_amount=0;
					if (is_array($data['items'])) {
						foreach ($data['items'] as $i => $item) {
							//print_r($data['items']);
							$total_cost +=$data['items'][$i]['cost'];
							$total_price +=$data['items'][$i]['price'];
							$total_amount +=$data['items'][$i]['amount'];
				?>
				<tr style="background: <?=($i % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>">
					<td><input type="text" id="items<?=$i?>title" name="items[<?=$i?>][title]" value="<?=$item['title']?>" maxlength="250" class="fldText " onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
					<td><input type="text" id="items<?=$i?>storage" name="items[<?=$i?>][storage]" value="<?=$item['storage']?>" maxlength="170" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
					<td><input type="text" id="items<?=$i?>cost" name="items[<?=$i?>][cost]" value="<?=$item['cost']?>" maxlength="12" class="fldText code total_cost" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> onchange="calcTotalCost();"/></td>
					<td><input type="text" id="items<?=$i?>quantity" name="items[<?=$i?>][quantity]" value="<?=$item['quantity']?>" maxlength="5" class="fldInteger" onfocus="this.className='fldIntegerOver'" onblur="this.className='fldInteger'" <?=$this->getReadonly(false)?> /></td>
					<td><input type="text" id="items<?=$i?>price" name="items[<?=$i?>][price]" value="<?=$item['price']?>" maxlength="12" class="fldText code total_price" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> onchange="setItemAmount(<?=$i?>)" /></td>
					<td>
						<input type="text" name="items[<?=$i?>][value]" value="<?=$item['value']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> />
						<input type="radio" name="items[<?=$i?>][absolute]" value="0" <?=(!intval($item['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />%
						<input type="radio" name="items[<?=$i?>][absolute]" value="1" <?=(intval($item['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> грн.
					</td>
					<td><input type="text" id="items<?=$i?>rate" name="items[<?=$i?>][rate]" value="<?=$item['rate']?>" maxlength="6" class="fldPercent" onfocus="this.className='fldPercentOver'" onblur="this.className='fldPercent'" <?=$this->getReadonly(false)?> onchange="setItemAmount(<?=$i?>)" /></td>
					<td><input type="text" id="items<?=$i?>amount" name="items[<?=$i?>][amount]" value="<?=$item['amount']?>" maxlength="10" class="fldMoney total_amount" class="fldMoney" onchange="calcTotalAmount();"<?=$this->getReadonly(false)?>/></td>
					<? if ($this->mode != 'view') { ?><td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити майно"  onclick="deleteItem(this)" /></td><? } ?>
				</tr>
				<?
						}
					}
				?>
				<tr style="background: <?=($i % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>" class="columns">
					<td>Разом:</td>
					<td></td>
					<td id="total_cost"><?=getMoneyFormat($total_cost, -1)?></td>
					<td>X</td>
					<td id="total_price"><?=getMoneyFormat($total_price, -1)?></td>
					<td>X</td>
					<td>X</td>
					<td id="total_amount"><?=getMoneyFormat($total_amount, -1)?></td>
					<td>&nbsp;</td>
				</tr>
				</table>

				<div class="section">Додаткова інформація:</div>
				<table cellpadding="5" cellspacing="0" width="500">
				<tr>
					<td width="100%"><textarea  name="additional" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['additional']?></textarea></td>
				</tr>
				</table>

				<div class="section">Заключні положення:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Попередній/поточний страховик:</td>
					<td><input type="text" name="prev_insurer" value="<?=$data['prev_insurer']?>" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				</table>
				<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label grey">Дані про збитки за останні 5 (п'ять) років:</td>
					<td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('last5_loses') ], $data['last5_loses' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
				</tr>
				</table><br />
	
				<div class="losestab">
					<table id="loses" cellpadding="5" cellspacing="0">
					<tr class="columns">
						<td width="90">Дата</td>
						<td width="400" >Коротка характеристика</td>
						<td width="120">Сума, грн.</td>
						<? if ($this->mode != 'view') { ?><td><a href="javascript:addLoses()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" /></a></td><? } ?>
					</tr>
					<?
						$j = 0;
						$amount = 0;
						if (is_array($data['loses'])) {
							foreach ($data['loses'] as $i => $row) {
								$amount += $row['amount'];
					?>
					<tr style="background: <?=($j % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>">
						<td><input type="text" name="loses[<?=$i?>][date]" losesId="<?=$i?>" value="<?=$row['date']?>" maxlength="10" class="fldDatePicker calendarDate" onChange="fillCalendar()" onfocus="this.className='fldDatePickerOver calendarDate'" onblur="this.className='fldDatePicker calendarDate'" <?=$this->getReadonly(false)?> /></td>
						<td><input type="text" name="loses[<?=$i?>][text]"  value="<?=$row['text']?>" maxlength="200" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
						<td><input type="text" name="loses[<?=$i?>][amount]" id="loses<?=$i?>amount" value="<?=$row['amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
						<? if ($this->mode != 'view') { ?><td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити"  onclick="deleteLoses(this)" /></td><? } ?>
					</tr>
					<?
								$j++;
							}
						}
					?>
					</table>
				</div>
	
				<?if ($action!='view') {?>
				<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
				</tr>
				</table>
				<?}?>
				</form>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>