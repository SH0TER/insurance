<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<?	$max_cars = 1;?>
<script type="text/javascript">
    function clearProductsBlocks() {
		$('div[id^=\'products\']').val('');
	}

    num = -1;

    function getDeductiblesId(items_id) {
        return $('input[id=items' + items_id + 'deductibles_id]:checked').val();
    }

	function getAmountItem(items_id) {
		var amount_kasko = ($('#items' + items_id + 'amount_kasko').val()) ? $('#items' + items_id + 'amount_kasko').val() : 0;
		return parseFloat(amount_kasko);
	}

	function getAmount() {
		var result = 0;

		$('input[title=\'itemsAmount\']').each(function () {
			if (parseFloat($(this).val()) >= 0) {
			
				result += parseFloat($(this).val());
			}
		});

		return result;
	}

	function changeAmount() {
        document.getElementById('amount').innerHTML = getMoneyFormat( getAmount() );
	}

	function changeAmountItem(items_id) {
		$('#items' + items_id + 'amount').val( getRateFormat(getAmountItem(items_id), 2) );
		changeAmount();
	}

	function changeAmountKASKO(items_id) {
		$('#items' + items_id + 'amount_kasko').val( getRateFormat($('#items' + items_id + 'rate_kasko').val() * $('#items' + items_id + 'car_price').val() / 100, 2) );
		changeAmountItem(items_id);
	}

    function setRate(items_id) {
        var deductibles_id = getDeductiblesId(items_id);

		if (!deductibles_id) {
			return;
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

		$('#items' + items_id + 'rate_kasko').val( getRateFormat(parseFloat($('#items' + items_id + 'rate_kasko' + deductibles_id).val()) ) );

		changeAmountKASKO(items_id);
	}

    function setRates(discount) {
        cars_count = parseInt(getElementValue('cars_count'));
        for (var i=0; i<cars_count; i++) {
            setRate(i);
        }
    }

    function getProductsBlock(items_id, deductibles_id) {

        document.getElementById('products' + items_id).innerHTML = '';

		if (!$('#policies_general_id').val()) {
			alert('Необхідно вибрати "Генеральний договір"!');
		} else if (getElementValue('items' + items_id + 'car_types_id') == 0) {
			alert('Необхідно вибрати "Тип ТЗ"!');
		} else if (getElementValue('items' + items_id + 'year') == 0) {
			alert('Необхідно заповнити "Рiк випуску ТЗ"!');
		} else if (getElementValue('items' + items_id + 'car_price') == 0) {
			alert('Необхідно вказати "Вартість, грн"!');
		} else if (getElementValue('terms_id') == 0) {
			alert('Необхідно вибрати "Термін страхування"!');
		} else if (getElementValue('zones_id') == 0) {
			alert('Необхідно вибрати "Зону дії полісу"!');
		} else if (getElementValue('items' + items_id + 'year') == '') {
			alert('Необхідно вказати "Рік випуску"!');
		} else {

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

			person_types_id = (getElementValue('owner_person_types_id')=='2' || getElementValue('insurer_person_types_id')=='2') ? '2' : '1';

			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'html',
				data:		'do=Products|getShowBlockInWindow' +
							'&items_id=' + items_id+
							'&product_types_id=<?=PRODUCT_TYPES_KASKO?>' +
							'&insurance_companies_id=' + getElementValue('insurance_companies_id') +
							'&policies_id=<?=$data['id']?>' +
							'&policies_general_id=' + $('#policies_general_id').val() + 
							'&parent_id=<?=$data['parent_id']?>' +
							'&deductibles_id=' + parseInt(deductibles_id) +
							'&person_types_id=' + person_types_id +
							'&car_types_id=' + getElementValue('items' + items_id + 'car_types_id') +
							'&brands_id=' + getElementValue('items' + items_id + 'brands_id') +
							'&driver_standings_id=' + getElementValue('driver_standings_id') +
							'&drivers_id=' + getElementValue('drivers_id') +
							'&zones_id=' + getElementValue('zones_id') +
							'&price=' + parseFloat(getElementValue('items' + items_id + 'car_price'))  +
							'&driver_ages_id=' + getElementValue('driver_ages_id') +
							'&registration_cities_id=' + getElementValue('registration_cities_id') +
							'&terms_id=' + getElementValue('terms_id') +
							'&optionsAlarm=' + optionsAlarm +
							'&cars_count=' + getElementValue('cars_count') +
							'&special=' + getElementValue('special') +
							'&financial_institutions_id=' + getElementValue('financial_institutions_id') +
							risks +
							'&priority_payments_id=' + getElementValue('priority_payments_id') +
							'&residences_id=' + getElementValue('residences_id') +
							'&year=' + getElementValue('items' + items_id + 'year') +
							'&options_deterioration_no=' + getElementValue('options_deterioration_no') +
							'&options_deductible_glass_no=' + getElementValue('options_deductible_glass_no') +
							'&options_guilty_no=' + getElementValue('options_guilty_no') +
							'&options_taxy=' + getElementValue('options_taxy') +
							'&options_test_drive=' + getElementValue('options_test_drive') +
							'&options_agregate_no=' + getElementValue('options_agregate_no') +
							'&allowed_products_id=' + getElementValue('allowed_products_id') +
							'&amount_accident=' + getElementValue('amount_accident') +
							'&next_policy_statuses_id=' + getElementValue('next_policy_statuses_id') +
							'&bonus_malus='  +getElementValue('bonus_malus')+
							<?if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {?>
							'&beginDate=' + getElementValue('begin_datetime_year')+'-'+getElementValue('begin_datetime_month')+'-'+getElementValue('begin_datetime_day')+
							'&endDate=' + getElementValue('end_datetime_year')+'-'+getElementValue('end_datetime_month')+'-'+getElementValue('end_datetime_day')+
							<?}?>
							'&discount=0',
				success:    function(result) {
								document.getElementById('products'+items_id).innerHTML = result;
							}
			});
		}
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

            if (beginDay>0 && beginMonth>0 && beginYear>0) {
                beginDate	= new Date(beginYear, beginMonth - 1, beginDay);
                endDate		= null;
				addmonth	= 0;
				adddays		= -1;

                switch (getElementValue('terms_id')) {
					case '54'://1 день
						addmonth	= 0;
						adddays		= 0;
						break;
					case '49'://3 дні
						addmonth	= 0;
						adddays		= 2;
						break;
					case '50'://7 днів
						addmonth	= 0;
						adddays		= 6;
						break;
					case '51'://10 днів
						addmonth	= 0;
						adddays		= 9;
						break;
					case '52'://20 днів
						addmonth	= 0;
						adddays		= 19;
						break;
					case '53'://31 день
						addmonth	= 0;
						adddays		= 30;
						break;
				}

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
		if ($this->mode != 'view' && $data['types_id'] == POLICY_TYPES_AGREEMENT) {
            echo 'getProductsBlock(\'' . $i . '\', \'' . $item['deductibles_id'] . '\');' . "\r\n";
        }
    }
}
?>
            }
        })

		setCarsCount();
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
    }

	function changeMode() {
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

    function getPoliciesGeneral(policies_general_id) {
	
		$.ajax({
			type:       'POST',
            url:        'index.php',
			dataType:   'script',
			//async:		false,
			data:       'do=Certificates|getPoliciesGeneralInWindow' +
						'&product_types_id=<?=PRODUCT_TYPES_DRIVE_GENERAL?>' +
						'&clients_id=' + getElementValue('clients_id') +
						'&date=' + getElementValue('date_year') + getElementValue('date_month') + getElementValue('date_day'),
			success:    function (result) {

							var policies_general = document.getElementById('policies_general_id');

							policies_general.options.length = 0;

							for(i=0; i < policies.length; i++) {
								policies_general.options[ i ] = new Option( policies[ i ][ 1 ], policies[ i ][ 0 ]);
								if (policies_general_id == policies[ i ][ 0 ]) {
									policies_general.selectedIndex = i;
								}
							}

							setCar();
						}
		})
    }

    function showDistributorsWindow() {
        tb_show('<strong>Вибір вигодонабувача:</strong>', "#TB_inline?height=200&width=400&inlineId=hiddenModalContent", false);
    }
	
    function setDistributorFields(title, title_en, identification_code, address, address_en, phone) {
		$('input[name=assured_title]').val(title);
		$('input[name=assured_identification_code]').val(identification_code);
		$('input[name=assured_address]').val(address);
		$('input[name=phone]').val(phone);

		if ($('input[name=send_en]').val() != '' || $('input[name=destination_en]').val() != '') {
			$('input[name=assured_title_en]').val(title_en);
			$('input[name=assured_address_en]').val(address_en);
		}
        tb_remove();
    }

</script>
<!--autoselect-->
<script type='text/javascript' src='/js/jquery/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='/js/jquery/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='/js/jquery/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="/js/jquery/jquery.autocomplete.css" />
<script>
var cities = [
<? if (is_array($data['client_points']) && sizeof($data['client_points'])) {?>
	<? foreach ($data['client_points'] as $i => $row) {?>
	"<?=str_replace ('&quot;' , '\"' ,$row['title'] )?>"<?if ($i!=sizeof($data['client_points'])-1) echo ',';?>
	<?}?>
<?}?>
];
</script>
<div id="car" style="visibility: hidden;z-index: -1;position: absolute;">
	<div class="section">
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
	</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Вартість, грн:</td>
		<td><input type="text" id="itemsCAR_NUMBERcar_price" name="items[CAR_NUMBER][car_price]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="changeAmountKASKO(CAR_NUMBER)" <?=$this->getReadonly(false)?> /></td>
		<td class="label grey"><?=$this->getMark(false)?>Об'єм двигуна, см<sup>3</sup>:</td>
		<td><input type="text" id="itemsCAR_NUMBERengine_size" name="items[CAR_NUMBER][engine_size]" value="" maxlength="8" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
		<td class="label grey"><?=$this->getMark()?>Рік випуску:</td>
		<td><input type="text" id="itemsCAR_NUMBERyear" name="items[CAR_NUMBER][year]" value="" maxlength="4" class="fldYear" onfocus="this.className='fldYearOver'" onblur="this.className='fldYear'" <?=$this->getReadonly(false)?> /></td>
		<td class="label grey"><?=$this->getMark()?>Пробіг, тис. км.:</td>
		<td><input type="text" name="items[CAR_NUMBER][race]" value="" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark(false)?>Колір:</td>
		<td>
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
		<td class="label grey"><?=$this->getMark(false)?>Кількість місць:</td>
		<td><input type="text" name="items[CAR_NUMBER][number_places]" value="" maxlength="2" class="fldInteger" onfocus="this.className='fldIntegerOver'" onblur="this.className='fldInteger'" /></td>
		<td class="label grey"><?=$this->getMark(false)?>№ шасі (кузов, рама):</td>
		<td><input type="text" name="items[CAR_NUMBER][shassi]" value="" maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly(false)?> /></td>
	</tr>
	</table>
	<table cellpadding="5" cellspacing="0">
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
	</tr>
	</table>

	<div class="section">Страховий продукт: <input type="button" value=" Знайти " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="getProductsBlock(CAR_NUMBER);" /></div>
	<div id="productsCAR_NUMBER"></div><br />

	<input type="hidden" id="itemsCAR_NUMBERproducts_id" name="items[CAR_NUMBER][products_id]" value="" title="products_id" />
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr class="columns">
		<td>Інші ризики</td>
		<td>Незаконне заволодіння</td>
		<td>КАСКО, тариф, %</td>
		<td>КАСКО, премія, грн.</td>
		<td>Тариф, грн.</td>
	</tr>
	<tr class="row1">
		<td><input type="text" id="itemsCAR_NUMBERdeductibles_value0" name="items[CAR_NUMBER][deductibles_value0]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute0Percent" name="items[CAR_NUMBER][deductibles_absolute0]" value="0" <?=($item['deductibles_absolute0'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> />% <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute0Amount" name="items[CAR_NUMBER][deductibles_absolute0]" value="1" <?=($item['deductibles_absolute0'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /> грн.</td>
		<td><input type="text" id="itemsCAR_NUMBERdeductibles_value1" name="items[CAR_NUMBER][deductibles_value1]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute1Percent" name="items[CAR_NUMBER][deductibles_absolute1]" value="0" <?=($item['deductibles_absolute1'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> />% <input type="radio" id="itemsCAR_NUMBERdeductibles_absolute1Amount" name="items[CAR_NUMBER][deductibles_absolute1]" value="1" <?=($item['deductibles_absolute1'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /> грн.</td>
		<td><input type="text" id="itemsCAR_NUMBERrate_kasko" name="items[CAR_NUMBER][rate_kasko]" value="" maxlength="5" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" onchange="changeAmountKASKO(CAR_NUMBER)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
		<td><input type="text" id="itemsCAR_NUMBERamount_kasko" name="items[CAR_NUMBER][amount_kasko]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>
		<td><input type="text" id="itemsCAR_NUMBERamount" name="items[CAR_NUMBER][amount]" value="" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" style="color: #666666; background-color: #f5f5f5;" readonly title="itemsAmount" /></td>
	</tr>
	</table>
</div>
<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="types_id" value="1" />
	<input type="hidden" name="changeMode" value="0" />
	<input type="hidden" name="terms_years_id" value="1" />
	
	<input type="hidden" name="fop" value="0" />
	<input type="hidden" name="give_a_statement" value="0" />
	<input type="hidden" name="civil_servant" value="0" />
	<input type="hidden" name="not_civil_servant" value="0" />
	<input type="hidden" name="public_figure" value="0" />
	
    <input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" id="clients_id" name="clients_id" value="<?=$data['clients_id']?>" />
    <input type="hidden" name="policy_statuses_id_old" value="<?=($data['policy_statuses_id_old']) ? $data['policy_statuses_id_old'] : $data['policy_statuses_id']?>" />
	<input type="hidden" id="next_policy_statuses_id" name="next_policy_statuses_id" value="<?=intval($data['next_policy_statuses_id'])?>" />
	<? if ($this->mode != 'view' && ($data['agencies_id'] != AGENCIES_EXPRESS_INSURANCE || $data['types_id'] != POLICY_TYPES_QUOTE)) {?>
	<input type="hidden" id="date_day" name="date_day" value="<?=$data['date_day']?>" />
	<input type="hidden" id="date_month" name="date_month" value="<?=$data['date_month']?>" />
	<input type="hidden" id="date_year" name="date_year" value="<?=$data['date_year']?>" />
	<? } ?>
	<input type="hidden" id="bonus_malus" name="bonus_malus" value="1" />

	
	<input type="hidden" id="insurance_companies_id" name="insurance_companies_id" value="<?=INSURANCE_COMPANIES_EXPRESS?>" />
	<input type="hidden" id="financial_institutions_id" name="financial_institutions_id" value="0" />
	<input type="hidden" id="cars_count" name="cars_count" value="1" />
	<input type="hidden" id="drivers_id" name="drivers_id" value="7" />
	<input type="hidden" id="number_drivers" name="number_drivers" value="0" />
	<input type="hidden" id="registration_cities_id" name="registration_cities_id" value="1" />
	<input type="hidden" id="residences_id" name="residences_id" value="2" />
	<input type="hidden" id="priority_payments_id" name="priority_payments_id" value="1" />
	<input type="hidden" id="options_deterioration_no" name="options_deterioration_no" value="0" />
	<input type="hidden" id="options_taxy" name="options_taxy" value="0" />
	<input type="hidden" id="options_agregate_no" name="options_agregate_no" value="0" />
	<input type="hidden" id="options_guilty_no" name="options_guilty_no" value="0" />
	<input type="hidden" id="options_test_drive" name="options_test_drive" value="0" />
	<input type="hidden" id="options_race" name="options_race" value="0" />
	<input type="hidden" id="payment_brakedown_id" name="payment_brakedown_id" value="1" />
	<input type="hidden" id="allowed_products_id" name="allowed_products_id" value="<?=$data['allowed_products_id']?>" />

	<input type="hidden" id="owner_person_types_id" name="owner_person_types_id" value="<?=$data['owner_person_types_id']?>" />
	<input type="hidden" id="owner_company" name="owner_company" value="<?=$data['owner_company']?>" />
	<input type="hidden" id="owner_bank" name="owner_bank" value="<?=$data['owner_bank']?>" />
	<input type="hidden" id="owner_bank_account" name="owner_bank_account" value="<?=$data['owner_bank_account']?>" />
	<input type="hidden" id="owner_bank_mfo" name="owner_bank_mfo" value="<?=$data['owner_bank_mfo']?>" />
	<input type="hidden" id="owner_edrpou" name="owner_edrpou" value="<?=$data['owner_edrpou']?>" />
	<input type="hidden" id="owner_lastname" name="owner_lastname" value="<?=$data['owner_lastname']?>" />
	<input type="hidden" id="owner_firstname" name="owner_firstname" value="<?=$data['owner_firstname']?>" />
	<input type="hidden" id="owner_patronymicname" name="owner_patronymicname" value="<?=$data['owner_patronymicname']?>" />
	<input type="hidden" id="owner_position" name="owner_position" value="<?=$data['owner_position']?>" />
	<input type="hidden" id="owner_ground" name="owner_ground" value="<?=$data['owner_ground']?>" />
	<input type="hidden" id="owner_dateofbirth" name="owner_dateofbirth" value="<?=$data['owner_dateofbirth']?>" />
	<input type="hidden" id="owner_dateofbirth_year" name="owner_dateofbirth_year" value="<?=$data['owner_dateofbirth_year']?>" />
	<input type="hidden" id="owner_dateofbirth_month" name="owner_dateofbirth_month" value="<?=$data['owner_dateofbirth_month']?>" />
	<input type="hidden" id="owner_dateofbirth_day" name="owner_dateofbirth_day" value="<?=$data['owner_dateofbirth_day']?>" />
	<input type="hidden" id="owner_passport_series" name="owner_passport_series" value="<?=$data['owner_passport_series']?>" />
	<input type="hidden" id="owner_passport_number" name="owner_passport_number" value="<?=$data['owner_passport_number']?>" />
	<input type="hidden" id="owner_passport_place" name="owner_passport_place" value="<?=$data['owner_passport_place']?>" />
	<input type="hidden" id="owner_passport_date" name="owner_passport_date" value="<?=$data['owner_passport_date']?>" />
	<input type="hidden" id="owner_passport_date_year" name="owner_passport_date_year" value="<?=$data['owner_passport_date_year']?>" />
	<input type="hidden" id="owner_passport_date_month" name="owner_passport_date_month" value="<?=$data['owner_passport_date_month']?>" />
	<input type="hidden" id="owner_passport_date_day" name="owner_passport_date_day" value="<?=$data['owner_passport_date_day']?>" />
	<input type="hidden" id="owner_identification_code" name="owner_identification_code" value="<?=$data['owner_identification_code']?>" />
	<input type="hidden" id="owner_phone" name="owner_phone" value="<?=$data['owner_phone']?>" />
	<input type="hidden" id="owner_email" name="owner_email" value="<?=$data['owner_email']?>" />
	<input type="hidden" id="owner_regions_id" name="owner_regions_id" value="<?=$data['owner_regions_id']?>" />
	<input type="hidden" id="owner_area" name="owner_area" value="<?=$data['owner_area']?>" />
	<input type="hidden" id="owner_city" name="owner_city" value="<?=$data['owner_city']?>" />
	<input type="hidden" id="owner_street_types_id" name="owner_street_types_id" value="<?=$data['owner_street_types_id']?>" />
	<input type="hidden" id="owner_street" name="owner_street" value="<?=$data['owner_street']?>" />
	<input type="hidden" id="owner_house" name="owner_house" value="<?=$data['owner_house']?>" />
	<input type="hidden" id="owner_flat" name="owner_flat" value="<?=$data['owner_flat']?>" />

	<input type="hidden" id="insurer_person_types_id" name="insurer_person_types_id" value="<?=$data['insurer_person_types_id']?>" />
	<input type="hidden" id="insurer_company" name="insurer_company" value="<?=$data['insurer_company']?>" />
	<input type="hidden" id="insurer_bank" name="insurer_bank" value="<?=$data['insurer_bank']?>" />
	<input type="hidden" id="insurer_bank_account" name="insurer_bank_account" value="<?=$data['insurer_bank_account']?>" />
	<input type="hidden" id="insurer_bank_mfo" name="insurer_bank_mfo" value="<?=$data['insurer_bank_mfo']?>" />
	<input type="hidden" id="insurer_edrpou" name="insurer_edrpou" value="<?=$data['insurer_edrpou']?>" />
	<input type="hidden" id="insurer_lastname" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" />
	<input type="hidden" id="insurer_firstname" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" />
	<input type="hidden" id="insurer_patronymicname" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" />
	<input type="hidden" id="insurer_position" name="insurer_position" value="<?=$data['insurer_position']?>" />
	<input type="hidden" id="insurer_ground" name="insurer_ground" value="<?=$data['insurer_ground']?>" />
	<input type="hidden" id="insurer_dateofbirth" name="insurer_dateofbirth" value="<?=$data['insurer_dateofbirth']?>" />
	<input type="hidden" id="insurer_dateofbirth_year" name="insurer_dateofbirth_year" value="<?=$data['insurer_dateofbirth_year']?>" />
	<input type="hidden" id="insurer_dateofbirth_month" name="insurer_dateofbirth_month" value="<?=$data['insurer_dateofbirth_month']?>" />
	<input type="hidden" id="insurer_dateofbirth_day" name="insurer_dateofbirth_day" value="<?=$data['insurer_dateofbirth_day']?>" />
	<input type="hidden" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" />
	<input type="hidden" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" />
	<input type="hidden" id="insurer_passport_place" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" />
	<input type="hidden" id="insurer_passport_date" name="insurer_passport_date" value="<?=$data['insurer_passport_date']?>" />
	<input type="hidden" id="insurer_passport_date_year" name="insurer_passport_date_year" value="<?=$data['insurer_passport_date_year']?>" />
	<input type="hidden" id="insurer_passport_date_month" name="insurer_passport_date_month" value="<?=$data['insurer_passport_date_month']?>" />
	<input type="hidden" id="insurer_passport_date_day" name="insurer_passport_date_day" value="<?=$data['insurer_passport_date_day']?>" />
	<input type="hidden" id="insurer_identification_code" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" />
	<input type="hidden" id="insurer_phone" name="insurer_phone" value="<?=$data['insurer_phone']?>" />
	<input type="hidden" id="insurer_email" name="insurer_email" value="<?=$data['insurer_email']?>" />
	<input type="hidden" id="insurer_regions_id" name="insurer_regions_id" value="<?=$data['insurer_regions_id']?>" />
	<input type="hidden" id="insurer_area" name="insurer_area" value="<?=$data['insurer_area']?>" />
	<input type="hidden" id="insurer_city" name="insurer_city" value="<?=$data['insurer_city']?>" />
	<input type="hidden" id="insurer_street_types_id" name="insurer_street_types_id" value="<?=$data['insurer_street_types_id']?>" />
	<input type="hidden" id="insurer_street" name="insurer_street" value="<?=$data['insurer_street']?>" />
	<input type="hidden" id="insurer_house" name="insurer_house" value="<?=$data['insurer_house']?>" />
	<input type="hidden" id="insurer_flat" name="insurer_flat" value="<?=$data['insurer_flat']?>" />
	<input type="hidden" id="sign_agents_id" name="sign_agents_id" value="0" />

    <table cellpadding="2" cellspacing="3" width="100%">
	<tr>
		<td>
			<div class="section">Параметри страхування:</div>
			<table cellpadding="5" cellspacing="0" width="100%">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Генеральний договір:</td>
				<td><select id="policies_general_id" name="policies_general_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="changeRate()" <?=$this->getReadonly(true)?>></select></td>
				<td class="label grey"><?=$this->getMark()?>Зона дії полісу:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('zones_id') ], $data['zones_id'], $data['languageCode'], ' ' .$this->getReadonly(true), null, $data, $this->isEqual('zones_id'));?></td>
				<td class="label grey"><?=$this->getMark(false)?>Термін страхування:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ], $data['terms_id' ], $data['languageCode'], 'onchange="setEnd(); clearProductsBlocks();" ' . $this->getReadonly(true).($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? ' disabled':''), null, $data, $this->isEqual('terms_id'))?><?=($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? ' <input type="hidden" name="terms_id" value="'.$data['terms_id'].'" />':'')?></td>
				<td width="100%" align="right">&nbsp;<?if ($this->mode != 'view' && $this->permissions['quote'] && $data['policy_statuses_id'] == POLICY_STATUSES_CREATED) {?><a href="javascript: changeMode()" style="color:#ff0066"><?=($this->subMode == 'calculate') ? 'Перейти у режим "Котирування"' : 'Вийти з режиму "Котирування"'?></a><? } ?></td>
			</tr>
			</table>

			<?=ParametersRisks::getListPolicy(PRODUCT_TYPES_KASKO, $data, $this->getReadonly(true))?>
			<table id="optionsBlock" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<table id="options_deductible_glass_noBlock" width="100%" cellpadding="0" cellspacing="5">
					<tr>
						<td class="label grey" style="width:100%">без франшизи на вітрові стекла:</td>
						<td><div class="<?=$this->isEqual('options_deductible_glass_no')?>"><input type="checkbox" id="options_deductible_glass_no" name="options_deductible_glass_no" value="1" <?=($data['options_deductible_glass_no']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

			<?
				for ($i=0; $i < $max_cars; $i++) {
					$bgcolor= ($i % 2 == 0) ? '#F0F0F0' : '#FFFFFF';
					echo '<div id="car' . $i . '" style="padding: 5px; background: ' . $bgcolor . ';' . (is_array($data['items'][ $i ]) ? 'display: block;':'display: none;') . '">';

					//**********************************************************************
					if (is_array($data['items'][ $i ])) {
						$item = $data['items'][ $i ]; 
			?>
			<div class="section">
				<input type="hidden" name="items[<?=$i?>][id]" value="<?=$item['id']?>">
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
				<span><select id="items<?=$i?>brands_id" name="items[<?=$i?>][brands_id]" onchange="changeBrand(document.getElementById('items<?=$i?>car_types_id'));" class="fldSelect<?=$this->isEqual('items|' . $i . '|brands_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|brands_id')?>';" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|brands_id')?>';" <?=$this->getReadonly(true)?>></select></span>
				<span class="label grey"><?=$this->getMark()?><b>Модель:</b></span>
				<span><select id="items<?=$i?>models_id" name="items[<?=$i?>][models_id]" class="fldSelect<?=$this->isEqual('items|' . $i . '|models_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|models_id')?>';" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|models_id')?>';" <?=$this->getReadonly(true)?>></select></span>
			</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Вартість, грн:</td>
				<td><input type="text" id="items<?=$i?>car_price" name="items[<?=$i?>][car_price]" value="<?=$item['car_price']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|car_price')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|car_price')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|car_price')?>';" onchange="changeAmountKASKO(CAR_NUMBER)" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Об'єм двигуна, см<sup>3</sup>:</td>
				<td><input type="text" id="items<?=$i?>engine_size" name="items[<?=$i?>][engine_size]" value="<?=$item['engine_size']?>" maxlength="8" class="fldText flat<?=$this->isEqual('items|' . $i . '|engine_size')?>" onfocus="this.className='fldTextOver flat<?=$this->isEqual('items|' . $i . '|engine_size')?>'" onblur="this.className='fldText flat<?=$this->isEqual('items|' . $i . '|engine_size')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>КПП:</td>
				<td>
					<select id="items<?=$i?>transmissions_id"  name="items[<?=$i?>][transmissions_id]" class="fldSelect<?=$this->isEqual('items|' . $i . '|transmissions_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|transmissions_id')?>'" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|transmissions_id')?>'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->transmissions_id as $id => $row) {
								echo '<option ' . ($item['transmissions_id']==$id ? 'selected':'') . ' value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</td>
				<td class="label grey"><?=$this->getMark()?>Рік випуску:</td>
				<td><input type="text" id="items<?=$i?>year" name="items[<?=$i?>][year]" value="<?=$item['year']?>" maxlength="4" class="fldYear<?=$this->isEqual('items|' . $i . '|year')?>" onfocus="this.className='fldYearOver<?=$this->isEqual('items|' . $i . '|year')?>'" onblur="this.className='fldYear<?=$this->isEqual('items|' . $i . '|year')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Пробіг, тис. км.:</td>
				<td><input type="text" name="items[<?=$i?>][race]" value="<?=$item['race']?>" maxlength="10" class="fldText number<?=$this->isEqual('items|' . $i . '|race')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('items|' . $i . '|race')?>'" onblur="this.className='fldText number<?=$this->isEqual('items|' . $i . '|race')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark(false)?>Колір:</td>
				<td>
					<select id="items<?=$i?>colors_id" name="items[<?=$i?>][colors_id]" class="fldSelect<?=$this->isEqual('items|' . $i . '|colors_id')?>" onfocus="this.className='fldSelectOver<?=$this->isEqual('items|' . $i . '|colors_id')?>'" onblur="this.className='fldSelect<?=$this->isEqual('items|' . $i . '|colors_id')?>'" <?=$this->getReadonly(true)?>>
						<option value="">...</option>
						<?
							foreach($this->colors_id as $id => $row) {
								echo '<option '.($item['colors_id']==$id ? 'selected':'').' value="' . $id . '" ' . (($row['obligatory']) ? 'class="obligatory"' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
							}
						?>
					</select>
				</td>
				<td class="label grey"><?=$this->getMark(false)?>Кількість місць:</td>
				<td><input type="text" name="items[<?=$i?>][number_places]" value="<?=$item['number_places']?>" maxlength="2" class="fldInteger<?=$this->isEqual('items|' . $i . '|number_places')?>" onfocus="this.className='fldIntegerOver<?=$this->isEqual('items|' . $i . '|number_places')?>'" onblur="this.className='fldInteger<?=$this->isEqual('items|' . $i . '|number_places')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>№ шасі (кузов, рама):</td>
				<td><input type="text" name="items[<?=$i?>][shassi]" value="<?=$item['shassi']?>" maxlength="20" class="fldText shassi<?=$this->isEqual('items|' . $i . '|shassi')?>" onfocus="this.className='fldTextOver shassi<?=$this->isEqual('items|' . $i . '|shassi')?>'" onblur="this.className='fldText shassi<?=$this->isEqual('items|' . $i . '|shassi')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Засоби захисту:</td>
					<td class="label grey">Mul-T-Lock:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_multlock')?>"><input type="checkbox" id="items<?=$i?>protection_multlock" name="items[<?=$i?>][protection_multlock]" value="1" <?=($item['protection_multlock']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					<td class="label grey">Immobilaser:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_immobilaser')?>"><input type="checkbox" id="items<?=$i?>protection_immobilaser" name="items[<?=$i?>][protection_immobilaser]" value="1" <?=($item['protection_immobilaser']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					<td class="label grey">Механічна:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_manual')?>"><input type="checkbox" id="items<?=$i?>protection_manual" name="items[<?=$i?>][protection_manual]" value="1" <?=($item['protection_manual']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
					<td class="label grey">Сигналізація:</td>
					<td><div class="<?=$this->isEqual('items|' . $i . '|protection_signalling')?>"><input type="checkbox" id="items<?=$i?>protection_signalling" name="items[<?=$i?>][protection_signalling]" value="1" <?=($item['protection_signalling']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></div></td>
				</tr>
			</table>

			<div class="section">Страховий продукт: <? if ($this->mode != 'view') {?><input type="button" value=" Знайти " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="getProductsBlock(<?=$i?>);" /><? } ?></div>
			<div id="products<?=$i?>"></div>

			<div class="section">Параметри:</div>
			<input type="hidden" id="items<?=$i?>products_id" name="items[<?=$i?>][products_id]" value="<?=$item['products_id']?>" title="products_id" />
			<table width="100%" cellpadding="0" cellspacing="0">
			<tr class="columns">
				<td>Інші ризики</td>
				<td>Незаконне заволодіння</td>
				<td>КАСКО, тариф, %</td>
				<td>КАСКО, премія, грн.</td>
				<td>Тариф, грн.</td>
			</tr>
			<tr class="row1">
				<td><input type="text" id="items<?=$i?>deductibles_value0" name="items[<?=$i?>][deductibles_value0]" value="<?=$item['deductibles_value0']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value0')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|deductibles_value0')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value0')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute0')?>"><input type="radio" id="items<?=$i?>deductibles_absolute0Percent" name="items[<?=$i?>][deductibles_absolute0]" value="0" <?=($item['deductibles_absolute0'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /></span>% <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute0')?>"><input type="radio" id="items<?=$i?>deductibles_absolute0Amount" name="items[<?=$i?>][deductibles_absolute0]" value="1" <?=($item['deductibles_absolute0'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /></span> грн.</td>
				<td><input type="text" id="items<?=$i?>deductibles_value1" name="items[<?=$i?>][deductibles_value1]" value="<?=$item['deductibles_value1']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value1')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|deductibles_value1')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|deductibles_value1')?>';" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /> <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute1')?>"><input type="radio" id="items<?=$i?>deductibles_absolute1Percent" name="items[<?=$i?>][deductibles_absolute1]" value="0" <?=($item['deductibles_absolute1'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /></span>% <span class="<?=$this->isEqual('items|' . $i . '|deductibles_absolute1')?>"><input type="radio" id="items<?=$i?>deductibles_absolute1Amount" name="items[<?=$i?>][deductibles_absolute1]" value="1" <?=($item['deductibles_absolute1'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $this->subMode == 'calculate')?> /></span> грн.</td>
				<td><input type="text" id="items<?=$i?>rate_kasko" name="items[<?=$i?>][rate_kasko]" value="<?=$item['rate_kasko']?>" maxlength="5" class="fldPercent<?=$this->isEqual('items|' . $i . '|rate_kasko')?>" onfocus="this.className='fldPercentOver<?=$this->isEqual('items|' . $i . '|rate_kasko')?>';" onblur="this.className='fldPercent<?=$this->isEqual('items|' . $i . '|rate_kasko')?>';" onchange="changeAmountKASKO(<?=$i?>)" <?=$this->getReadonly(false, $this->subMode == 'calculate')?> /></td>
				<td><input type="text" id="items<?=$i?>amount_kasko" name="items[<?=$i?>][amount_kasko]" value="<?=$item['amount_kasko']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|amount_kasko')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|amount_kasko')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|amount_kasko')?>';" style="color: #666666; background-color: #f5f5f5;" readonly /></td>
				<td><input type="text" id="items<?=$i?>amount" name="items[<?=$i?>][amount]" value="<?=$item['amount']?>" maxlength="10" class="fldMoney<?=$this->isEqual('items|' . $i . '|amount')?>" onfocus="this.className='fldMoneyOver<?=$this->isEqual('items|' . $i . '|amount')?>';" onblur="this.className='fldMoney<?=$this->isEqual('items|' . $i . '|amount')?>';" style="color: #666666; background-color: #f5f5f5;" readonly title="itemsAmount" /></td>
			</tr>
			</table>
			<?
					}
					//**********************************************************************
					echo '</div>';
				}
			?>

			<table class="section2" cellpadding="5" cellspacing="0">
			<tr>
				<td><b>ТАРИФ:</b></td>
				<td id="amount"><?=getMoneyFormat($data['amount'])?></td>
			</tr>
			</table>

			<div class="section">Параметри полісу страхування:</div>
			<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Документ, номер і дата:</td>
					<td><input type="text" name="document_number" value="<?=$data['document_number']?>" maxlength="20" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('document_date') ], $data['document_date_year' ], $data['document_date_month' ], $data['document_date_day' ], 'document_date', $this->getReadonly(true))?></td>
				</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Пункт відправлення:</td>
					<td><input type="text" name="send" value="<?=$data['send']?>" maxlength="100" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company autocompletecity'" onblur="this.className='fldText company autocompletecity'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey"><?=$this->getMark()?>Пункт призначення:</td>
					<td><input type="text" name="destination" value="<?=$data['destination']?>" maxlength="100" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company autocompletecity'" onblur="this.className='fldText company autocompletecity'" <?=$this->getReadonly(false)?> /></td>
				</tr>
				<tr>
					<td class="label grey">Пункт відправлення (англ.):</td>
					<td><input type="text" name="send_en" value="<?=$data['send_en']?>" maxlength="100" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company autocompletecity'" onblur="this.className='fldText company autocompletecity'" <?=$this->getReadonly(false)?> /></td>
					<td class="label grey">Пункт призначення (англ.):</td>
					<td><input type="text" name="destination_en" value="<?=$data['destination_en']?>" maxlength="100" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company autocompletecity'" onblur="this.className='fldText company autocompletecity'" <?=$this->getReadonly(false)?> /></td>
				</tr>
			</table>

			<table cellpadding="5" cellspacing="0">
			<tr>
				<? if ($this->mode == 'view' || $data['types_id']== POLICY_TYPES_QUOTE) {?>
				<td class="label grey">Номер полісу:</td>
				<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="20" class="fldText number<?=$this->isEqual('number')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('number')?>'" onblur="this.className='fldText number<?=$this->isEqual('number')?>'" <?=($action == 'insert') ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"'?> />
				<td class="label grey"><?=$this->getMark(false)?>Дата полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', ($action == 'insert') ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"')?></td>
				<? } ?>
				<td class="label grey"><?=$this->getMark(false)?>Дата початку дії полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'id="begin_datetime" ' . $this->getReadonly(true))?></td>
				<td class="label grey"><?=$this->getMark(false)?>Дата закінчення дії полісу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', ' '.($this->subMode == 'calculate' ? 'style="color: #aca899; background-color: #f5f5f5;" disabled ':' '). $this->getReadonly(true))?></td>
			</tr>
			</table>

			<input type="hidden" name="assured" value="1" />
			<div class="section">Вигодонабувач:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark(false)?>ПІБ (назва):</td>
				<td><input type="text" id="assured_title" name="assured_title" value="<?=$data['assured_title']?>" maxlength="50" class="fldText address<?=$this->isEqual('assured_title')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_title')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_title')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>ІПН (ЄРДПОУ):</td>
				<td><input type="text" id="assured_identification_code" name="assured_identification_code" value="<?=$data['assured_identification_code']?>" maxlength="10" class="fldText code<?=$this->isEqual('assured_identification_code')?>" onfocus="this.className='fldTextOver code<?=$this->isEqual('assured_identification_code')?>'" onblur="this.className='fldText code<?=$this->isEqual('assured_identification_code')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Адреса:</td>
				<td><input type="text" id="assured_address" name="assured_address" value="<?=$data['assured_address']?>" maxlength="100" class="fldText address<?=$this->isEqual('assured_address')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_address')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_address')?>'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Телефон:</td>
				<td><input type="text" id="assured_phone" name="assured_phone" value="<?=$data['assured_phone']?>" maxlength="15" class="fldText phone<?=$this->isEqual('assured_phone')?>" onfocus="this.className='fldTextOver phone<?=$this->isEqual('assured_phone')?>'" onblur="this.className='fldText phone<?=$this->isEqual('assured_phone')?>'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			<tr>
				<td class="label grey">ПІБ (назва) (англ.):</td>
				<td><input type="text" id="assured_title_en" name="assured_title_en" value="<?=$data['assured_title_en']?>" maxlength="50" class="fldText address<?=$this->isEqual('assured_title_en')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_title_en')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_title_en')?>'" <?=$this->getReadonly(false)?> /></td>
				<td colspan="2">&nbsp;</td>
				<td class="label grey">Адреса (англ.):</td>
				<td><input type="text" id="assured_address_en" name="assured_address_en" value="<?=$data['assured_address_en']?>" maxlength="100" class="fldText address<?=$this->isEqual('assured_address_en')?>" onfocus="this.className='fldTextOver address<?=$this->isEqual('assured_address_en')?>'" onblur="this.className='fldText address<?=$this->isEqual('assured_address_en')?>'" <?=$this->getReadonly(false)?> /></td>
				<td colspan="2"><? if ($this->mode == 'update') {?> <a href="javascript: showDistributorsWindow()"><img src="/images/administration/bulletPath.gif" alt="Вибрати вигодонабувача" width="13" height="9" /></a><? } ?></td>
			</tr>
			</table>

			<div class="section">Додатково:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Статус:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], 'onchange="setRequiredFields()" ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
			</tr>
			</table>
			<?=Distributors::getListToChoose()?>
		</td>
	</tr>
    </table>
</form>
<script type="text/javascript">
    setRequiredFields();
    setCar();
	<? if (!$data['end_datetimeFormat']) echo 'setEnd();'; ?>

	$(function() {
		$('#begin_datetime').bind(
			'change',
			function() {
				setEnd();
			}
		);
	});

	$(document).ready(function(){
		$('.notEqual').css('background-color', '#ff6666');
		$('.autocompletecity').focus().autocomplete(cities);
		getPoliciesGeneral(<?=intval($data['policies_general_id'])?>);
	});

    initFocus(document.<?=$this->objectTitle?>);
</script>