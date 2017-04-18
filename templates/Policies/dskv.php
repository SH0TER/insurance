<?
if ($_POST['ECmode']) {
    $data['ECmode'] = $_POST['ECmode'];
}
?>
<script type="text/javascript">
    function changeProduct() {
		<?=ParametersPropertySections::getJavaScriptArray($data)?>
        var products_id = getElementValue('products_id');

        if (products_id) {
            for (i=0; i < property_sections.length; i++) {
                if (property_sections[i][0] == products_id) {
                    document.getElementById('property_sectionsValue' + property_sections[i][1]).value = (property_sections[i][2] != '0.00')
                        ? property_sections[i][2]
                    : '-';
                }
            }
        }

        getRate(document.getElementById('products_id'));
    }

    //новый пасспорт 
    function setInsurerIdCard() {
        if($('[name=insurer_id_card]:checked').val() == 0) {
            $('#passportDSKV').css('display', 'table');
            $('table#insurer_new_passport_table').css('display', 'none');
        } else {
            $('#passportDSKV').css('display', 'none');
            $('table#insurer_new_passport_table').css('display', 'table');
        }
    }

	function setRate() {
		var discount = parseFloat($('#discount option:selected').val());
		var cart_discount = ($('#cart_discount').attr('checked')) ? parseFloat($('#cart_discount').val()) : 0;

		var rate = getRateFormat(parseFloat($('#rate').val()) * (100 - discount - cart_discount) / 100);
		var amount = getRateFormat( parseFloat($('#price').val() ) * rate / 100, 2);

		var rate_dskv = getRateFormat(parseFloat($('#rate_dskv').val()) * (100 - discount - cart_discount) / 100);
		var amount_dskv = getRateFormat(parseFloat($('#priceDSKV').val()) * rate_dskv / 100, 2);

		var rate_other = getRateFormat(parseFloat($('#rate_other').val()) * (100 - discount - cart_discount) / 100);
		var amount_other = getRateFormat(parseFloat($('#price_other').val()) * rate_other / 100, 2);

        document.getElementById('rate_dskvBlock').innerHTML	= rate_dskv + '%, ' + getMoneyFormat(amount_dskv);
        document.getElementById('rate_otherBlock').innerHTML	= rate_other + '%, ' + getMoneyFormat(amount_other);

        document.getElementById('rateBlock').innerHTML	= getMoneyFormat(parseFloat(amount_dskv) + parseFloat(amount_other));
	}

    function setProductValues(data) {
		$('#rate').val(data.rate);
		$('#price').val(data.price);

		$('#priceDSKV').val(data.priceDSKV);
		$('#rate_dskv').val(data.rate_dskv);

		$('#price_other').val(data.price_other);
		$('#rate_other').val(data.rate_other);

		setRate();
    }

    function setPropertySections(elem) {
        if (elem.type != 'checkbox' || elem.name.indexOf('property_sections') == -1) {
            return;
        }

        choose_property_section = false;

        for(i=document.<?=$this->objectTitle?>.elements.length-1; i > 0; i--) {
            if (document.<?=$this->objectTitle?>.elements[ i ].name.indexOf('property_sections') != -1) {
                if (elem.name == document.<?=$this->objectTitle?>.elements[ i ].name) {
                    choose_property_section = true;
                } else if (!choose_property_section && !elem.checked) {
                    document.<?=$this->objectTitle?>.elements[ i ].checked = false;
                } else if (choose_property_section && elem.checked) {
                    document.<?=$this->objectTitle?>.elements[ i ].checked = true;
                }
            }
        }
    }

    function getRate(elem) {

        risks = '';

        for(i=0; i < document.<?=$this->objectTitle?>.elements.length; i++) {
            if (document.<?=$this->objectTitle?>.elements[ i ].name == 'risks[]' &&
                (document.<?=$this->objectTitle?>.elements[ i ].type == 'hidden' || document.<?=$this->objectTitle?>.elements[ i ].checked)) {
                risks = risks + '&' + document.<?=$this->objectTitle?>.elements[ i ].name + '=' + document.<?=$this->objectTitle?>.elements[ i ].value;
            }
        }

        setPropertySections(elem);

        property_sections = '';

        for(i=0; i < document.<?=$this->objectTitle?>.elements.length; i++) {
            if (document.<?=$this->objectTitle?>.elements[ i ].name.indexOf('property_sections') != -1 &&
                document.<?=$this->objectTitle?>.elements[ i ].checked) {
                property_sections = property_sections + '&' + document.<?=$this->objectTitle?>.elements[ i ].name +  '=' + document.<?=$this->objectTitle?>.elements[ i ].value;
            }
        }

        if (getElementValue('products_id')) {
            $.ajax({
                type:		'POST',
                url:		'index.php',
                dataType:	'json',
                data:		'do=Products|getRateInWindow' +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&policies_id=<?=$data['id']?>' +
							'&products_id=' + getElementValue('products_id') +
							risks +
							property_sections +
							'&price_other=' + getElementValue('price_other'),
                success:	setProductValues
            });

			changeDiscount();
        }
    }

    function showHideInsurerAddressBlock(obj) {
        document.getElementById('insurer_addressBlock').style.display = (obj.checked) ? 'block' : 'none';
    }

    /*function setEnd() {
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
                endDate		= beginDate.addYears(1).addDays(-1)

                if (endDate != null) {
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
    }*/
	
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

			bday=begin_datetime_day.value;
			bmonth=begin_datetime_month.value;
			byear=begin_datetime_year.value;

			if (bday.substring(0,1)=='0') bday=bday.substring(1,2);
			if (bmonth.substring(0,1)=='0') bmonth=bmonth.substring(1,2);

			bday		= parseInt(bday);
			bmonth	= parseInt(bmonth);
			byear	= parseInt(byear);

			if (bday>0 && bmonth>0 && byear>0) {
				date = new Date(byear, bmonth-1, bday);
				newdate = null;

			
				if (bmonth==2 && bday==29)
					newdate = date.addYears(1)
				else
					newdate = date.addYears(1).addDays(-1);
			
				if (newdate != null) {
					eday		= newdate.getDate();
					emonth	= newdate.getMonth()+1;
					eyear	= newdate.getFullYear();
					if (eday<10) eday='0'+eday;
					if (emonth<10) emonth='0'+emonth;

					end_datetime_day.value	= eday;
					end_datetime_month.value	= emonth;
					end_datetime_year.value	= eyear;
					end_datetime.value=eday+'.'+	emonth+'.'+	eyear;
					
				}
			}
		}
	}

    var showAlert = false;

    function checkFields() {

        if (!getElementValue('description') && !showAlert) {
            i = 0;
            while (i < document.<?=$this->objectTitle?>.elements.length) {
                if (document.<?=$this->objectTitle?>.elements[ i ].name == 'risks[]' &&
                    document.<?=$this->objectTitle?>.elements[ i ].checked &&
                    (document.<?=$this->objectTitle?>.elements[ i ].value == <?=RISKS_PDTO?> ||
                    document.<?=$this->objectTitle?>.elements[ i ].value == <?=RISKS_HIJACKING2?>)) {
                        alert('Виплата за ризиками "Крадіжка, грабіж, розбій" та "ПДТО" можлива лише при наданні опису майна, що приймається на страхування. Наявність фотографій обов\'язкова!');
                        showAlert = true;
                        break;
                }
                i++;
            }
        }

        if ($('#policy_statuses_id option:selected').val() == <?=POLICY_STATUSES_GENERATED?> &&	!window.confirm('Після зміни статусу на "Сформовано" редагування полісу стане неможливим. Продовжити?')) {
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

	function setAssured(obj) {
		document.getElementById('assuredData').style.display = (obj.checked) ? 'block' : 'none';
	}

	function setDiscountCardCarManWoman() {
		$('td[title=\'cart_discount\']').each(function () {
			if ($('#cart_discount').attr('checked')) {
				$(this).css('display', '');
			} else {
				$(this).css('display', 'none');
			}
		});
	}

	function setCartDiscount(cart_discount) {
		$('#cart_discount').val(cart_discount);
		
		if (cart_discount == 0) {
			$('#cart_discount').attr('checked', false);
			$('#cart_discount').attr('disabled', true);
		} else {
			$('#cart_discount').attr('disabled', false);
		}
		
		setDiscountCardCarManWoman();
	}

	function setDiscount(data) {
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
	}
	
	function changeDiscount() {
		$.ajax({
			type:       'POST',
			url:        'index.php',
			dataType:   'json',
			async:		false,
			data:       'do=Products|getDiscountInWindow' +
						'&products_id[]=' + $('#products_id').val() +
						'&date=' + $('#date_year').val() + '-' + $('#date_month').val() + '-' + $('#date_day').val() +
						'&agencies_id=<?=$data['agencies_id']?>' +
						'&card_car_man_woman=' + $('#card_car_man_woman').val(),
			success: setDiscount});
	}
</script>

<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data"  onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" id="clients_id" name="clients_id" value="<?=$data['clients_id']?>" />
    <input type="hidden" id="date_day" name="date_day" value="<?=$data['date_day']?>" />
    <input type="hidden" id="date_month" name="date_month" value="<?=$data['date_month']?>" />
    <input type="hidden" id="date_year" name="date_year" value="<?=$data['date_year']?>" />
    <input type="hidden" id="description" name="description" value="<?=$data['description']?>" />
	<input type="hidden" id="price" name="price" value="<?=$data['price']?>" />
    <input type="hidden" id="rate" name="rate" value="<?=$data['rate']?>" />
	<input type="hidden" id="priceDSKV" name="priceDSKV" value="<?=$data['priceDSKV']?>" />
	<input type="hidden" id="rate_dskv" name="rate_dskv" value="<?=$data['rate_dskv']?>" />
	<input type="hidden" id="rate_other" name="rate_other" value="<?=$data['rate_other']?>" />
    <table cellpadding="2" cellspacing="3" width="100%">
        <tr>
            <td>
                <div class="section">Страхування майна:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Опція:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('products_id') ], $data['products_id'], $data['languageCode'], 'onchange="changeProduct()" ' . $this->getReadonly(true), null, $data)?></td>
                        <td><?=ParametersRisks::getListPolicy($data['product_types_id'], $data, $this->getReadonly(true) . ' onclick="getRate(this)"')?></td>
                        <td class="label grey"><b>Тариф:</b></td>
                        <td id="rate_dskvBlock"><?=getRateFormat($data['rate_dskv'])?>%; <?=getMoneyFormat($data['amount_dskv'])?></td>
                    </tr>
                </table>

                <?=ParametersPropertySections::getListPolicy($data, $this->getReadonly(true) . ' onclick="getRate(this)"')?>

                <div class="section">Страхування відповідальності:</div>
                <table cellspacing="0" cellpadding="5">
                    <tr>
                        <td class="label grey">Ліміти відшкодування (страхова сума), грн.:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('price_other') ], $data['price_other'], $data['languageCode'], 'onchange="changeProduct(); getRate(this)" ' . $this->getReadonly(true), null, $data)?></td>
                        <td class="label grey"><b>Тариф:</b></td>
                        <td id="rate_otherBlock"><?=getRateFormat($data['rate_other'])?>%; <?=getMoneyFormat($data['amount_other'])?></td>
                        <td class="label grey"><b>Всього:</b></td>
                        <td id="rateBlock"><?=getMoneyFormat($data['amount'])?></td>
						<td class="label grey">Знижка агента, %:</td>
						<td>
							<select id="discount" name="discount" <?=$this->getReadonly(true)?> class="fldSelect<?=$this->isEqual('discount')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('discount')?>'" onblur="this.className='fldSelect<?=$this->isEqual('discount')?>'" onchange="changeProduct();">
								<option value="0.00">0.00
								<?
									for ($j=1; $j <= $data['discount']; $j++) {
										echo '<option value="' . $j . '.00" ' . ((intval($j) == intval($data['discount'])) ? ' selected' : '') . '>' . $j . '.00';
									}
							?>
							</select>
						</td>
						<td class="label grey">Чи є у вас картка CarMan@CarWoman:</td>
						<td><input type="checkbox" id="cart_discount" name="cart_discount" value="<?=intval($data['cart_discount'])?>" <?if (intval($data['cart_discount'])) echo 'checked';?> onclick="setRate(false)" <?=$this->getReadonly(true)?> /></td>
						<td class="label grey" title="cart_discount">*Номер:</td>
						<td title="cart_discount"><input type="text" id="card_car_man_woman" name="card_car_man_woman" value="<?=$data['card_car_man_woman']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number<?=$this->isEqual('card_car_man_woman')?>'" onblur="this.className='fldText number'" onchange="setRate(false)" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

                <div class="section">Дані щодо квартири:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Область:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('regions_id') ], $data['regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
						<td class="label grey">Район:</td>
						<td><input type="text" id="area" name="area" value="<?=$data['area']?>" maxlength="50" class="fldText city<?=$this->isEqual('area')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('area')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Місто:</td>
                        <td><input type="text" id="city" name="city" value="<?=$data['city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Вулиця:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('street_types_id') ], $data['street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('street_types_id'))?><input type="text" id="street" name="street" value="<?=$data['street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Будинок:</td>
                        <td><input type="text" id="house" name="house" value="<?=$data['house']?>" maxlength="6" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Квартира:</td>
                        <td><input type="text" id="flat" name="flat" value="<?=$data['flat']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

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
                <table cellpadding="5" cellspacing="0" id="passportDSKV" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?>>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Паспорт, серія і номер:</td>
                        <td>
                            <input type="text" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> />
                            <input type="text" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                        </td>
                        <td class="label grey"><?=$this->getMark()?>Паспорт. Ким і де виданий:</td>
                        <td><input type="text" id="insurer_passport_place" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td>
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
                        <td><input type="text" id="insurer_identification_code" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Телефон:</td>
                        <td><input type="text" id="insurer_phone" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey">E-mail:</td>
                        <td><input type="text" id="insurer_email" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="label grey">Адреса квартири не співпадає з адресою проживання:</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" id="notInsurerAddress" name="notInsurerAddress" value="1" onclick="showHideInsurerAddressBlock(this)"  <?=$this->getReadonly(true)?> /></td>
                    </tr>
                </table>

                <table id="insurer_addressBlock" cellpadding="5" cellspacing="0" <?=(!$data['notInsurerAddress']) ? 'style="display: none"': ''?>>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Область:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
						<td class="label grey">Район:</td>
						<td><input type="text" id="insurer_area" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_area')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_area')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Місто:</td>
                        <td><input type="text" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Вулиця:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_street_types_id'))?><input type="text" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Будинок:</td>
                        <td><input type="text" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="6" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey">Квартира:</td>
                        <td><input type="text" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

                <div class="section">Параметри полісу страхування:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <? if ($this->mode == 'view') {?>
						<td class="label grey">Номер полісу:</td>
						<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="14" class="fldText number<?=$this->isEqual('number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('number')?>'" onblur="this.className='fldText number<?=$this->isEqual('number')?>'" <?=$this->getReadonly()?> />
                        <td class="label grey"><?=$this->getMark()?>Дата заключення полісу:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', '  ' . $this->getReadonly(true))?></td>
                        <? } ?>
                        <td class="label grey"><?=$this->getMark()?>Дата початку дії полісу:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'onchange="setEnd()" ' . $this->getReadonly(true))?></td>
                        <td class="label grey"><?=$this->getMark()?>Дата закінчення дії полісу:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', ' style="color: #aca899; background-color: #f5f5f5;" disabled ' . $this->getReadonly(true))?></td>
                    </tr>
                </table>
                <table id="assuredBlock" cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey" nowrap>Поліс прошу укласти на користь Вигодонабувача:</td>
                        <td width="20"><input type="checkbox" id="assured" name="assured" value="1" <?=(($data['assured'] || $data['assured_title']) ? 'checked': '')?> onclick="setAssured(this)" <?=$this->getReadonly(true)?> /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table id="assuredData" cellpadding="0" cellspacing="5" style="display: <?=($data['assured'] || $data['assured_title']) ? 'block' : 'none'?>">
                                <tr>
                                    <td class="label grey"><?=$this->getMark()?>ПІБ (назва):</td>
                                    <td><input type="text" id="assured_title" name="assured_title" value="<?=$data['assured_title']?>" maxlength="50" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey"><?=$this->getMark()?>ІПН (ЄРДПОУ):</td>
                                    <td><input type="text" id="assured_identification_code" name="assured_identification_code" value="<?=$data['assured_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey"><?=$this->getMark()?>Адреса:</td>
                                    <td><input type="text" id="assured_address" name="assured_address" value="<?=$data['assured_address']?>" maxlength="50" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey"><?=$this->getMark()?>Телефон:</td>
                                    <td><input type="text" id="assured_phone" name="assured_phone" value="<?=$data['assured_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

				<div class="section">Додатково:</div>
				<table cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey"><?=$this->getMark()?>Статус:</td>
						<td width=100><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
						<? if ($Authorization->data['service'] || $data['service_person']) {//показываем только для тех полисов где есть сотрудник СТО или продажи идут с участием СТО ?>
						<td class="label grey">Представник СТО:</td>
						<td><input type="text" id="service_person" name="service_person" value="<?=$data['service_person']?>" maxlength="70" class="fldText email<?=$this->isEqual('service_person')?>" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
						<? } ?>
					</tr>
				</table>	
				<table width="100%" cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey">Коментар:</td>
						<td width="100%" colspan=3><textarea id="comment" name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
					</tr>
				</table>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
<? if (!ereg('view', $action)) echo 'changeProduct();'?>
    initFocus(document.<?=$this->objectTitle?>);
</script>