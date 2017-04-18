 
<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<script type="text/javascript">
	var prefix = '';
	var load = true;
	
	function setLimitsDate() {
		var documents_date = $('#documents_date_day').val() + '.' + $('#documents_date_month').val() + '.' + $('#documents_date_year').val();

		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			async:		false,
			data:		'do=AccidentActs|getLimitsDateInWindow' +
						'&product_types_id=<?=$data['product_types_id']?>' +
						'&documents_date=' + documents_date,
			success: 	function(result) {
							$('#limit_payment_date').html(result.limit_payment_date);
						}
		});
	}

	function isValidDeteriorationValue() {
		var deterioration_value = parseFloat( $('input[name=deterioration_value]').val() );

		if (deterioration_value < 0 || deterioration_value > 1) {
			alert('Не вірний коефіцієнт зносу!');
			$('input[name=deterioration_value]').val('');
			return false;
		}

		return true;
	}

	function setProportionality() {
		var insurance_price = parseFloat($('input[name=insurance_price]').val());
		var market_price = parseFloat($('input[name=market_price]').val());

		var proportionality_value = (insurance_price / market_price > 1) ? getRateFormat(1) : getRateFormat(insurance_price / market_price, 5);

		$('#proportionality').html( proportionality_value );

		return proportionality_value;
	}

	function changeDeductible() {
		if ( $('input[name=deductibles_change]:checked').val() == '1' ) {
			$('input[name=deductibles_amount]').attr('readonly', false);
			$('input[name=deductibles_amount]').css({'color': 'rgb(0, 0, 0)', 'background-color':'rgb(255, 255, 255)'});
			$('input[name=deductibles_amount]').focus();
		} else {
			$('input[name=deductibles_amount]').attr('readonly', true);
			$('input[name=deductibles_amount]').css({'color': 'rgb(102, 102, 102)', 'background-color':'rgb(245, 245, 245)'});
		}
		changeAmount();
	}
	
	function changeParams() {
		if ($('input[name=act_type]:checked').val() == 1 && load == false) {
			$('input[name=amount_details]').val(roundNumber(parseFloat($('input[name=amount_details]').val()) + parseFloat($('input[name=amount_details_previous]').val()), 2));
			$('input[name=amount_material]').val(roundNumber(parseFloat($('input[name=amount_material]').val()) + parseFloat($('input[name=amount_material_previous]').val()), 2));
			$('input[name=amount_work]').val(roundNumber(parseFloat($('input[name=amount_work]').val()) + parseFloat($('input[name=amount_work_previous]').val()), 2));			
		}
		if ($('input[name=act_type]:checked').val() == 2) {
			$('input[name=amount_details]').val(roundNumber(parseFloat($('input[name=amount_details]').val()) - parseFloat($('input[name=amount_details_previous]').val()), 2));
			$('input[name=amount_material]').val(roundNumber(parseFloat($('input[name=amount_material]').val()) - parseFloat($('input[name=amount_material_previous]').val()), 2));
			$('input[name=amount_work]').val(roundNumber(parseFloat($('input[name=amount_work]').val()) - parseFloat($('input[name=amount_work_previous]').val()), 2));			
		}		
		load = false;
	}	

	function changeAmount(init) {	

        if (parseFloat($('input[name=discount]').val()) > 0) {
        	$('#discount').css('display', 'block');
		} else {
			$('input[name=discount]').val(0);
			$('#discount').css('display', 'none');
		}

		//показываем общую сумму счета на восстановление
		billAmount = parseFloat($('input[name=amount_details]').val()) + parseFloat($('input[name=amount_material]').val()) + parseFloat($('input[name=amount_work]').val());
		$('#billAmount').html( getMoneyFormat(billAmount) );

        market_price = parseFloat($('input[name=market_price]').val());

		(parseFloat($('input[name=deterioration_value]').val()) > 0)
			? $('#deterioration_basis').css('display', 'block')
			: $('#deterioration_basis').css('display', 'none');

		amount_previous_accidents = parseFloat($('input[name=amount_previous_accidents]').val());
		amount_previous_acts = parseFloat($('input[name=amount_previous_acts]').val());

		//Определяем и вычесляем нужные параметры для расчета возмещения
        var deductibles_amount =$('input[name=deductibles_amount]').val();//Франшиза
        var deterioration = 1 - parseFloat($('input[name=deterioration_value]').val());// коеф. износа

		var amount_vrz = parseFloat($('input[name=amount_details]').val()) * deterioration + parseFloat($('input[name=amount_material]').val()) + parseFloat($('input[name=amount_work]').val()); //сумма запчастей, материалов и работ с учетом износа
        var amount = amount_vrz;
		
		if ($('input[name=act_type]:checked').val() == 1) {
			amount = amount - amount_previous_acts;
		}
        var amount_compensation	= parseFloat($('input[name=amount_compensation]').val());//евакуатор

        amount_vrz += amount_compensation;

        total = (billAmount >= market_price) ? 1 : 0;
        limit = 0;

        discount = $('input[name=discount]').val();
        amount_residual	= parseFloat($('input[name=amount_residual]').val());
		
		if (isNaN(amount_residual))
			amount_residual = 0.00;

		//amount	= amount + amount_compensation;
		
		var temp = "<?=$data['policies_begin_datetime_format']?>";
		temp = temp.split(".");
		var begin_date_time = [];
		begin_date_time['day'] = parseInt(temp[0]);
		begin_date_time['month'] = parseInt(temp[1]);
		begin_date_time['year'] = parseInt(temp[2]);
		
		var temp1 = "<?=$data['datetime_datetime_format']?>";
		temp1 = temp1.split(".");
		var date_time = [];
		date_time['day'] = parseInt(temp1[0]);
		date_time['month'] = parseInt(temp1[1]);
		date_time['year'] = parseInt(temp1[2]);
		
		var d1 = new Date(begin_date_time['year'] + "-" + begin_date_time['month'] + "-" + begin_date_time['day']);
		var d2 = new Date("2016-02-19");
		var d3 = new Date(date_time['year'] + "-" + date_time['month'] + "-" + date_time['day']);
		
        if($('input[name=mvs_average]').val() == 4 && d3 < d2 /*billAmount*/ && amount_vrz > 25000 && market_price - amount_residual > 25000){//если оформление дела по европротоколу, то максимальная сумма 25 тыс. грн.
            amount = 25000;// - amount_previous_acts;
            limit_amount = 25000;
            total = 0;
            limit = 1;
            amount_residual = 0;
            help = ' (гранична сума при оформленні події згідно європротоколу 25 тис. грн)';
        }
		else if($('input[name=mvs_average]').val() == 4 && d3 >= d2 /*billAmount*/ && amount_vrz > 50000 && market_price - amount_residual > 50000){//если оформление дела по европротоколу, то максимальная сумма 50 тыс. грн.
            amount = 50000;// - amount_previous_acts;
            limit_amount = 50000;
            total = 0;
            limit = 1;
            amount_residual = 0;
            help = ' (гранична сума при оформленні події згідно європротоколу 50 тис. грн)';
        }
        else if($('input[name=mvs_average]').val() >= 1 && d1 < d2 && $('input[name=mvs_average]').val() != 4 && $('input[name=risks_id]').val() == 1 && /*billAmount*/ amount_vrz > 50000 && market_price - amount_residual > 50000){//не європротокол, майно - 50000
            amount = 50000;// - amount_previous_acts;
            limit_amount = 50000;
            total = 0;
            limit = 1;
            amount_residual = 0;
            help = ' (ліміт відповідальності у разі пошкодження майна 50 тис. грн)';
        }
		else if($('input[name=mvs_average]').val() >= 1 && d1 >= d2 && $('input[name=mvs_average]').val() != 4 && $('input[name=risks_id]').val() == 1 && /*billAmount*/ amount_vrz > 100000 && market_price - amount_residual > 100000){//не європротокол, майно - 100000
            amount = 100000;// - amount_previous_acts;
            limit_amount = 100000;
            total = 0;
            limit = 1;
            amount_residual = 0;
            help = ' (ліміт відповідальності у разі пошкодження майна 100 тис. грн)';
        }
        else if($('input[name=mvs_average]').val() >= 1 && d1 < d2 && $('input[name=mvs_average]').val() != 4 && $('input[name=risks_id]').val() == 2 && /*billAmount*/ amount_vrz > 100000 && market_price - amount_residual > 100000){//не європротокол, життя - 100000
            amount = 100000;// - amount_previous_acts;
            limit_amount = 100000;
            total = 0;
            limit = 1;
            amount_residual = 0;
            help = ' (ліміт відповідальності у разі нанесення шкоди життю та здоров\'ю 100000 тис. грн)';
        }
		else if($('input[name=mvs_average]').val() >= 1 && d1>= d2 && $('input[name=mvs_average]').val() != 4 && $('input[name=risks_id]').val() == 2 && /*billAmount*/ amount_vrz > 200000 && market_price - amount_residual > 200000){//не європротокол, життя - 200000
            amount = 200000;// - amount_previous_acts;
            limit_amount = 200000;
            total = 0;
            limit = 1;
            amount_residual = 0;
            help = ' (ліміт відповідальності у разі нанесення шкоди життю та здоров\'ю 200000 тис. грн)';
        }
        else{
            limit = 0;
            if(total == 1){
				if ($('input[name=act_type]:checked').val() == 1) {
					amount = market_price - amount_previous_acts;
				}
				else {
					amount = market_price;	
				}
                
				console.log(amount);
                $('#residual').show();
            }else{
                $('#residual').hide();
                amount_residual = 0;
            }
            help = '';
        }

		//amount	= getRateFormat(amount - deductibles_amount - amount_residual - discount, 2);

		amount = roundNumber(amount - deductibles_amount - amount_residual - discount + amount_compensation, 2);
//console.log(amount);
		if (amount < 0) {
			amount = 0;
		}

		if (amount > 0) {
			$('#paymentsBlock').css('display', 'block');
		} else {
			$('#paymentsBlock').css('display', 'none');
		}

		$('input[name=deductibles_amount]').val( number_format(parseFloat(deductibles_amount), 2, '.', '') );

		result = '';
		calc_info = '';

		if (amount > 0) {
			result = '<b>Підлягає страхове відшкодування в розмірі:</b> ';
			calc_info = 'підлягає страхове відшкодування в розмірі: ';


            if(limit == 0){
                if(total == 1) {
					result = result + market_price + ' (ринкова вартість) ' + ' - ' + amount_residual + ' (залишки)';
					calc_info = calc_info + market_price + ' (ринкова вартість) ' + ' - ' + amount_residual + ' (залишки)';
				} else {
					result = result + '(' + $('input[name=amount_details]').val() + ' * ' + getRateFormat(deterioration, 4) + ' + ' +  $('input[name=amount_material]').val() + ' + '+ $('input[name=amount_work]').val();
					calc_info = calc_info + parseFloat(roundNumber(amount_vrz, 2)).toFixed(2);
				}

				if ($('input[name=act_type]:checked').val() == 1) {
					result = result + ' - ' + amount_previous_acts + ' (передплата)';
					calc_info = calc_info + ' - ' + amount_previous_acts + ' (передплата)';
				}

                if(amount_compensation > 0) {
                    result = result + ' + ' + amount_compensation + '(евакуатор)';
                    calc_info = calc_info + ' + ' + amount_compensation + '(евакуатор)';
                }
            }else{
                result = result + limit_amount;
				calc_info = calc_info + limit_amount;
				
				if ($('input[name=act_type]:checked').val() == 1) {
					result = result + ' - ' + amount_previous_acts + ' (передплата)';
					calc_info = calc_info + ' - ' + amount_previous_acts + ' (передплата)';
				}
            }

			result = result + ' - ' + deductibles_amount + ' (франшиза)) ';
			calc_info = calc_info + ' - ' + deductibles_amount + ' (франшиза)) ';

            if(discount > 0) {
                   result = result + ' - ' + discount + '(знижка) ';
				   calc_info = calc_info + ' - ' + discount + '(знижка) ';
            }

            result = result + ' = <b>' + getMoneyFormat(amount) + '</b>' + help;
            calc_info = calc_info + ' = <b>' + getMoneyFormat(amount) + '</b>' + help;
		} else {
			result = '<b>без виплати, франшиза більша збитку</b>';
			calc_info = '<b>без виплати, франшиза більша збитку</b>';
		}

		$('#amount').html( result );
		$('input[name=calc_info]').val(calc_info.toLowerCase());
	}

	//снимаем выделение со всех получателей
	function setNormal(i) {
        $('#express' + i).attr('style', 'font-weight: normal;');
		$('#insurer' + i).attr('style', 'font-weight: normal;');
		$('#assured' + i).attr('style', 'font-weight: normal;');
		$('#car_service' + i).attr('style', 'font-weight: normal;');
		$('#other' + i).attr('style', 'font-weight: normal;');
	}

	//изменяется назначение платежа
	function changePaymentTypesId(i) {
		switch ($('select[name="payments_calendar[' + i + '][payment_types_id]"] option:selected').val()) {
			case '<?=PAYMENT_TYPES_PART_PREMIUM?>':
                $('.hidden_link').css('display', 'none');
                $('#express_link').click(function(i){
                     setEssentialExpress(i);
                });
                $('#insurer_link').click(function(i){
                    setEssentialInsurer(i);
                });
				$('#recipientEssential' + i).css('display', 'none');
				$('#payment_types_id' + i).css('display', 'none');
				$('#recipient_types_id' + i).val(<?=RECIPIENT_TYPES_INSURED?>);
				break;
			case '<?=PAYMENT_TYPES_COMPENSATION?>':
                $('.hidden_link').css('display', '');
				$('#recipientEssential' + i).css('display', 'block');
				//$('input[name="payments_calendar[' + i + '][basis]"]').attr('readonly', 'readonly');
				//$('input[name="payments_calendar[' + i + '][basis]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				break;
		}
	}

	//устанавливаем назначение платежа
	function setBasis(i) {
		var basis = '';
		switch ( $('select[name="payments_calendar[' + i + '][payment_types_id]"] option:selected').val() ) {
			case '<?=PAYMENT_TYPES_PART_PREMIUM?>':
				basis = 'Зарахувати згідно договору страхування № ' + $('input[name=policies_number]').val() + ' від ' + $('input[name=policies_date_format]').val() + 'р. в якості оплати страхового платежу по вказаному договору';
				break;
			case '<?=PAYMENT_TYPES_COMPENSATION?>':
				basis = 'Страхове вiдшкодування згiдно полісу страхування № ' + $('input[name=policies_number]').val() + ' від ' + $('input[name=policies_date_format]').val() + 'р. ' + "<?=htmlspecialchars($data['accidents_owner'])?>";

				switch ( $('input[name="payments_calendar[' + i + '][recipient_types_id]"]').val() ) {
					case '<?=RECIPIENT_TYPES_CAR_SERVICE?>':
						basis = basis + ' та згiдно ' + $('input[name=payment_document_number]').val();// + ' вiд ' + $('input[name=payment_document_date]').val() + 'р.';
						break;
					default:
						//basis = basis + ' ІПН: ' + $('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').val() + '; ';
                        basis = basis + ' ІПН: ' + <?=$data['owner_identification_code']?> + '; ';

						if ( $('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val() != '' ) {
							basis = basis + 'СКР: ' + $('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val();
						} else if ( $('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').val().length > 8 ) {
							basis = basis + 'Без ПДВ';					
						}
						break;
				}
				break;
			default:
				//$('input[name="payments_calendar[' + i + '][basis]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][basis]"]').attr('style', 'color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);');
				break;
		}

		$('input[name="payments_calendar[' + i + '][basis]"]').val( basis );
	}

	//устанавливаем поля к заполнению в зависимости от типа получателя
    function setRecipientType(i, recipient_types_id) {

		$('input[name="payments_calendar[' + i + '][recipient_types_id]"]').val( recipient_types_id );

		setNormal(i);

		switch ( parseInt(recipient_types_id) ) {
            case <?=RECIPIENT_TYPES_INSURED?>:
                $('#express' + i).attr('style', 'font-weight: bold;');
                break;
			case <?=RECIPIENT_TYPES_INSURER?>:
				$('#insurer' + i).attr('style', 'font-weight: bold;');

				$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('readonly', '');

				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				break;
			case <?=RECIPIENT_TYPES_ASSURED?>:
				$('#assured' + i).attr('style', 'font-weight: bold;');

				$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('readonly', '');

				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				break;
			case <?=RECIPIENT_TYPES_CAR_SERVICE?>:
				$('#car_service' + i).attr('style', 'font-weight: bold;');

				$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');

				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][recipient]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('readonly', '');
				//$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				break;
			case <?=RECIPIENT_TYPES_OTHER?>:
				$('#other' + i).attr('style', 'font-weight: bold;');

				$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('readonly', '');

				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('readonly', '');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('readonly', '');
				break;
		}
	}

	//изменения при изменения какого-то из банковских реквизитов
	function changeEssential(i) {

		changePaymentsCalendarAmount();

		changePaymentTypesId(i);

		setBasis(i);
	}

	//устанавливаем банковские реквизиты получателя
	function setEssential(i, result) {
		$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val(result.bank_card_number);
		$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').val(result.bank_account);
		$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').val(result.bank_mfo);
		$('input[name="payments_calendar[' + i + '][bank_edrpou]"]').val(result.bank_edrpou);
		$('input[name="payments_calendar[' + i + '][payment_bank]"]').val(result.bank);

		$('input[name="payments_calendar[' + i + '][recipients_id]"]').val(result.recipients_id);
		$('input[name="payments_calendar[' + i + '][recipient]"]').val(result.recipient);
		$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').val(result.recipient_identification_code);

        $('input[name="payments_calendar[' + i + '][car_services_tis]"]').val(0);
        $('#audatex_codeBlock'+i).hide();

		setRecipientType(i, result.recipient_types_id);

		changeEssential(i);
	}

	function setEssentialInsurer(i) {
		$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Accidents|getEssentialInsurerInWindow' +
						'&product_types_id=<?=$data['product_types_id']?>' +
                        '&id=<?=$data['accidents_id']?>',
			success: function (result) {
						setEssential(i, result);
					}
		});
	}

    function setEssentialExpress(i) {
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'json',
                data:       'do=Accidents|getEssentialExpressInWindow' +
                            '&product_types_id=<?=$data['product_types_id']?>' +
                            '&id=<?=$data['accidents_id']?>',
                success: function (result) {
                            setEssential(i, result);
                        }
            });
        }

	function setEssentialAssured(i) {
		$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Accidents|getEssentialAssuredInWindow' +
						'&product_types_id=<?=$data['product_types_id']?>' +
                        '&id=<?=$data['accidents_id']?>',
			success: function (result) {
						setEssential(i, result);
					}
		});
	}
	var item = 0;
    function showCarServicesWindow(i) {
		item = i;
        tb_show('<strong>Вибір СТО:</strong>', '#TB_inline?height=600&width=800&inlineId=hiddenModalContentcar_services_id', false);
    }

    function setEssentialCarService(recipients_id, recipient, recipient_identification_code, bank_account, bank_mfo, bank_edrpou, bank, tis) {

		$('input[name="payments_calendar[' + item + '][recipients_id]"]').val(recipients_id);
		$('input[name="payments_calendar[' + item + '][recipient]"]').val(recipient);
		$('input[name="payments_calendar[' + item + '][recipient_identification_code]"]').val(recipient_identification_code);
		$('input[name="payments_calendar[' + item + '][payment_bank_account]"]').val(bank_account);
		$('input[name="payments_calendar[' + item + '][payment_bank]"]').val(bank);
		$('input[name="payments_calendar[' + item + '][payment_bank_mfo]"]').val(bank_mfo);
        $('input[name="payments_calendar[' + item + '][bank_edrpou]"]').val(bank_edrpou);
        $('input[name="payments_calendar[' + item + '][car_services_tis]"]').val(tis);

        if(tis==1){
            $('#audatex_codeBlock'+item).show();
        }else if(tis==0){
            $('#audatex_codeBlock'+item).hide();
        }

		setRecipientType(item, <?=RECIPIENT_TYPES_CAR_SERVICE?>);
		changeEssential(item);

        tb_remove();
    }
    
    function getListBySearch() {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=CarServices|getListBySearchInWindow'+
						'&elem=car_services_id'+
                        '&search_title='+$('#search_titlecar_services_id').val() + 
			'&empty_row=1',
            success:    function(result){
                $('#carServicesContentcar_services_id').html(result);
            }
        });
    }

	function setEssentialOther(i) {
		$('input[name="payments_calendar[' + i + '][recipients_id]"]').val(0);
		$('input[name="payments_calendar[' + i + '][recipient]"]').val('');
		$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').val('');
		$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').val('');
		$('input[name="payments_calendar[' + i + '][bank]"]').val('');
		$('input[name="payments_calendar[' + i + '][bank_mfo]"]').val('');
		$('input[name="payments_calendar[' + i + '][bank_edrpou]"]').val('');
		$('input[name="payments_calendar[' + i + '][bank_card_number]"]').val('');

        $('input[name="payments_calendar[' + i + '][car_services_tis]"]').val(0);
        $('#audatex_codeBlock'+i).hide();

		setRecipientType(i, '<?=RECIPIENT_TYPES_OTHER?>');
	}

	function changeRowStyle(item) {
		for (i=0; i < document.getElementById( item ).rows.length; i++) {
			document.getElementById( item ).rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

    var payment = -1 - <?=intval(sizeof($data['payments_calendar']))?>;

	function addPayment() {

    	var item =
			'<tr id="payments_calendar' + payment + '">' +
				'<td>' +
                    '<input type="hidden" name="payments_calendar[' + payment + '][product_types_id]" value="<?=PRODUCT_TYPES_GO?>" />' +
					'<input type="hidden" name="payments_calendar[' + payment + '][id]" value="' + payment + '" />' +
					'<input type="hidden" name="payments_calendar[' + payment + '][recipient_types_id]" value="" />' +
					'<input type="hidden" name="payments_calendar[' + payment + '][recipients_id]" value="" />' +
                    '<input type="hidden" name="payments_calendar[' + payment + '][car_services_tis]" value="" />' +

					'<table width="100%" cellpadding="5" cellspacing="0">' +
					'<tr>' +
						'<td class="label grey"><?=$this->getMark()?>Сума, грн.:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][amount]" value="" maxlength="10" class="fldMoney" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>Тип:</td>' +
						'<td>' +
							'<select name="payments_calendar[' + payment + '][payment_types_id]" onblur="this.className=\'fldSelect\'" onfocus="this.className=\'fldSelectOver\'" onchange="changeEssential(' + payment + ')" class="fldSelect">' +
                                '<option>...</option>' +
								'<option value="5">Частина страхової премії</option>' +
								'<option value="6">Страхове відшкодування</option>' +
							'</select>' +
						'</td>' +
						'<td align="right">' +
                            '<a href="javascript: setEssentialExpress(' + payment + ')" id="express_link"><span id="express' + payment + '">ТДВ \"Експрес Страхування\"</span></a> &nbsp; | &nbsp; ' +
							'<a href="javascript: setEssentialInsurer(' + payment + ')" id="insurer_link"><span id="insurer' + payment + '">Страхувальник</span></a> &nbsp; <label class="hidden_link">|</label> &nbsp; ' +
							'<a class="hidden_link" href="javascript: showCarServicesWindow(' + payment + ')" id="car_service_link"><span id="car_service' + payment + '">СТО</span></a> &nbsp; <label class="hidden_link">|</label> &nbsp; ' +
							'<a class="hidden_link" href="javascript: setEssentialOther(' + payment + ')" id="other_link"><span id="other' + payment + '">Фізична особа</span></a>' +
						'</td>' +
					'</tr>' +
					'</table>' +

					'<table id="recipientEssential' + payment + '" cellpadding="5" cellspacing="0" style="display: none;">' +
					'<tr>' +
						'<td class="label grey">СКР отримувача:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][payment_bank_card_number]" value="" maxlength="19" class="fldText edrpou" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver edrpou\'" onblur="this.className=\'fldText edrpou\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>Розрахунковий рахунок:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][payment_bank_account]" value="" maxlength="20" class="fldText bankAccount" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver bankAccount\'" onblur="this.className=\'fldText bankAccount\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>MФО:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][payment_bank_mfo]" value="" maxlength="6" class="fldText mfo" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver mfo\'" onblur="this.className=\'fldText mfo\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>ЄДРПОУ банку:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][bank_edrpou]" value="" maxlength="8" class="fldText edrpou" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver edrpou\'" onblur="this.className=\'fldText edrpou\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>Банк:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][payment_bank]" value="" maxlength="50" class="fldText company" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver company\'" onblur="this.className=\'fldText company\'" /></td>' +
					'</tr>' +
					'</table>' +

					'<table cellpadding="0" cellspacing="0">' +
					'<tr>' +
						'<td class="label grey"><?=$this->getMark()?>Отримувач:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][recipient]" value="" maxlength="100" class="fldText company" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver company\';" onblur="this.className=\'fldText company\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>ІПН (ЄДРПОУ):</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][recipient_identification_code]" value="" maxlength="10" class="fldText code" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver code\'" onblur="this.className=\'fldText code\'" /></td>' +
						'<td class="label grey"><?=$this->getMark()?>Призначення:</td>' +
						'<td width="100%"><input type="text" name="payments_calendar[' + payment + '][basis]" value="" maxlength="500" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
					'</tr>' +
                    '</table>' +
                    '<table cellpadding="0" cellspacing="0">' +
                    '<tr id="audatex_codeBlock' + payment + '" style="display: none">' +
                        '<td class="label grey"><?=$this->getMark()?>Код AUDATEX:</td>' +
                        '<td><input type="text" name="payments_calendar[' + payment + '][audatex_code]" value="' + $('input[name=audatex]').val() + '" maxlength="10" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" <?=$this->getReadonly(false)?> /></td>' +
                    '</tr>' +
					'</table>' +
				'</td>' +
				'<td><a onclick="deletePayment(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
			'</tr>';

    	$('#payments_calendar').append(item);

        payment--;

		changeRowStyle('payments_calendar');
    }

    function deletePayment(obj) {
        if (confirm('Ви дійсно бажаєте вилучити платіж?')) {
            document.getElementById('payments_calendar').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

			changePaymentsCalendarAmount();
			changeRowStyle('payments_calendar');
        }
    }

	function changePaymentsCalendarAmount() {
		var amount = 0
		$('input[name$="[amount]"]').each(function() {
			amount += parseFloat($(this).val());
		});

		$('#payments_calendar_amount').html('Відшкодування: <b>' + getMoneyFormat(amount) + '</b>');
	}

    var documentIdx = -1;

    function addDocument() {
        var row	= document.getElementById('documents').insertRow(document.getElementById('documents').rows.length);
        row.style.background = (document.getElementById('documents').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

        var i = document.getElementById('documents').rows.length;
        row.className = documentIdx;

        cell = row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="document[' + documentIdx + ']" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" />';

        cell = row.insertCell(-1);
        cell.innerHTML = '<a href="#" onclick="deleteDocument(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a>';
		cell.width = '30px;';

        documentIdx--;

		changeRowStyle('documents');
    }

    function deleteDocument(obj) {
        if (confirm('Ви дійсно бажаєте вилучити документ?')) {
            document.getElementById('documents').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

			changeRowStyle('documents');
        }
    }
    $(document).ready(function(){
        if('<?=$action?>' == 'insert')
        $('input[name=deductibles_amount]').val(getRateFormat(510, 2));
		$('input[name=act_type]').change(function () {
			changeParams();
			changeAmount();
		});
    });
</script>
<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="step" value="<?=$data['step']?>" />
	<input type="hidden" name="reason" value="<?=$data['reason']?>" />
	<input type="hidden" name="risks_id" value="<?=$data['risks_id']?>" />
	<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
	<input type="hidden" name="insurance" value="<?=$data['insurance']?>" />
    <input type="hidden" name="mvs" value="<?=$data['mvs']?>" />
    <input type="hidden" name="mvs_average" value="<?=$data['mvs_average']?>" />
	<input type="hidden" name="amount" value="<?=doubleval($data['amount'])?>" />
	<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="insurance_price" value="<?=$data['insurance_price']?>" />
	<input type="hidden" name="amount_previous_acts" value="<?=$data['amount_previous_acts']?>">
	<input type="hidden" name="amount_previous_accidents" value="<?=doubleval($data['amount_previous_accidents'])?>">
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="policies_date_format" value="<?=$data['policies_date_format']?>" />
	<input type="hidden" name="policies_price" value="<?=$data['policies_price']?>" />
	<input type="hidden" name="policies_amount" value="<?=$data['policies_amount']?>" />
	<input type="hidden" name="policies_insurer_lastname" value="<?=$data['policies_insurer_lastname']?>" />
	<input type="hidden" name="policies_insurer_firstname" value="<?=$data['policies_insurer_firstname']?>" />
	<input type="hidden" name="policies_insurer_patronymicname" value="<?=$data['policies_insurer_patronymicname']?>" />
	<input type="hidden" name="policies_insurer_company" value="<?=$data['policies_insurer_company']?>" />
	<input type="hidden" name="policies_insurer_person_types_id" value="<?=$data['policies_insurer_person_types_id']?>" />
	<input type="hidden" name="policy_payments_amount" value="<?=$data['policy_payments_amount']?>" />
	<input type="hidden" name="policies_begin_datetime_format" value="<?=$data['policies_begin_datetime_format']?>" />
	<input type="hidden" name="policies_interrupt_datetime_format" value="<?=$data['policies_interrupt_datetime_format']?>" />
	<input type="hidden" name="policies_deductibles_value0" value="<?=$data['policies_deductibles_value0']?>" />
	<input type="hidden" name="policies_deductibles_absolute0" value="<?=$data['policies_deductibles_absolute0']?>" />
	<input type="hidden" name="policies_deductibles_value1" value="<?=$data['policies_deductibles_value1']?>" />
	<input type="hidden" name="policies_deductibles_absolute1" value="<?=$data['policies_deductibles_absolute1']?>" />
	<input type="hidden" name="comment" value="<?=$data['comment']?>" />
    <input type="hidden" name="audatex" value="<?=$data['audatex_code']?>" />
    <input type="hidden" name="result_calculation_car_services_id" value="<?=$data['result_calculation_car_services_id']?>" />
	<input type="hidden" name="calc_info" value="<?=$data['calc_info']?>" />
	
	<input type="hidden" name="accident_messages_id" value="<?=$data['accident_messages_id']?>" />
	
	<input type="hidden" name="amount_details_previous" value="<?=$data['amount_details_previous']?>" />
	<input type="hidden" name="amount_work_previous" value="<?=$data['amount_work_previous']?>" />
	<input type="hidden" name="amount_material_previous" value="<?=$data['amount_material_previous']?>" />

    <table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td>
            <?if($data['amount_previous_acts'] > 0 && $data['insurance'] == 1) {?>
            <div class="section">Тип акта:</div>
            <table>
                <tr>
                    <td style="display: none;"><input type="radio" name="act_type" value="0" <?=($data['act_type'] == 0) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                    <td class="label grey">Доплата:</td>
                    <td><input type="radio" name="act_type" value="1" <?=($data['act_type'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                    <td class="label grey">Повернення грошей та виплата на інші реквізити:</td>
                    <td><input type="radio" name="act_type" value="2" <?=($data['act_type'] == 2) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                    <td class="label grey">Повернення грошей та відмова:</td>
                    <td><input type="radio" name="act_type" value="3" <?=($data['act_type'] == 3) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                </tr>
            </table>
            <?}elseif($data['amount_previous_acts'] > 0 && $data['insurance'] != 1) {?>
            <div class="section">Тип акта:</div>
            <table>
                <tr>
                    <td class="label grey">Повернення грошей та відмова:</td>
                    <td><input type="checkbox" name="act_type" value="3" <?=($data['act_type'] == 3) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                </tr>
            </table>
            <?}?>
			<div class="section">Поліс:</div>
			<b>Поліс:</b> <a href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>" target="_blank"><?=$data['policies_number']?><?if($data['important_person'] == 1){?>  <b style="color: red;">VIP</b><?}?></a> &nbsp; &nbsp; <b>Термін дії:</b> <?=$data['policies_begin_datetime_format']?> - <?=$data['policies_interrupt_datetime_format']?> &nbsp; &nbsp; <b>Премія:</b> <?=getMoneyFormat($data['policies_amount'])?> &nbsp; &nbsp; <b>Сплачено:</b> <?=($data['policies_amount'] < $data['policy_payments_amount']) ? '<span id="payments_amountBlock" class="attention">' . getMoneyFormat($data['policy_payments_amount']) . '</span>' : '<span id="payments_amountBlock" class="">'.getMoneyFormat($data['policy_payments_amount']). '</span>'?>
			<b>Коментар:</b> <?=$data['comment']?>
			<?if ((($action == 'insert' || $action == 'update') && $data['insurance'] == 1) || ($action == 'view' && $data['act_insurance'] == 1)) { ?>
            <div class="section">Ринкова вартість:</div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Ринкова вартість:</td>
                    <td><input type="text" name="market_price" value="<?=$data['market_price']?>" maxlength="13" onchange="changeAmount();" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
                </td>
		    </tr>
			</table>
			<div class="section">Коефіцієнти:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Коефіцієнт зносу:</td>
				<td><input type="text" name="deterioration_value" value="<?=$data['deterioration_value']?>" maxlength="8" onchange="if (isValidDeteriorationValue()) changeAmount();" class="fldPercent" onfocus="this.className='fldPercentOver'" onblur="this.className='fldPercent'" <?=$this->getReadonly(false)?> /></td>
				<td id="deterioration_basis" style="display: <?=($data['deterioration_value'] > 0) ? 'block' : 'none'?>">
					<table cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey"><?=$this->getMark()?>Згідно:</td>
						<td width="500"><input type="text" name="deterioration_basis" value="<?=$data['deterioration_basis']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table>					
				</td>
		    </tr>
			</table>
			<div class="section">Розмір матеріального збитку:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Згiдно:</td>
				<td width="490"><input type="text" name="payment_document_number" value='<?=htmlspecialchars($this->replacetags(trim($data['payment_document_number'])))?>' maxlength="300" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
				<!--td> &nbsp;&nbsp;вiд&nbsp;&nbsp; </td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_date') ], $data[ 'payment_document_date_year' ], $data[ 'payment_document_date_month' ], $data[ 'payment_document_date_day' ], 'payment_document_date',  $this->getReadonly(true))?></td-->
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Запчастин, грн.:</td>
				<td><input type="text" name="amount_details" value="<?=$data['amount_details']?>" maxlength="10" onchange="changeAmount()" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Матеріалів, грн.:</td>
				<td><input type="text" name="amount_material" value="<?=$data['amount_material']?>" maxlength="10" onchange="changeAmount()" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Робіт, грн.:</td>
				<td><input type="text" name="amount_work" value="<?=$data['amount_work']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><b>Всього, грн.:</b></td>
				<td id="billAmount"><?=getMoneyFormat($data['amount_details'] + $data['amount_material'] + $data['amount_work'])?></td>
			</tr>
            </table>
            <table>
            <tr>
				<td>
                    <table>
                        <tr>
                            <td class="label grey"><?=$this->getMark()?>Франшиза, грн.:</td>
                            <td colspan="6"><input type="text" name="deductibles_amount" value="<?=$data['deductibles_amount']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>Знижка, грн.:</td>
                            <td><input type="text" name="discount" value="<?=$data['discount']?>" maxlength="10" class="fldPercent" onchange="changeAmount()" onfocus="this.className='fldPercentOver'" onblur="this.className='fldPercent'" <?=$this->getReadonly(false)?> /></td>
                            <td id="discount" style="display: <?=($data['discount'] > 0) ? 'block' : 'none'?>">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="label grey"><?=$this->getMark()?>Згідно:</td>
                                        <td width="400"><input type="text" name="discount_basis" value="<?=$data['discount_basis']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                                    </tr>
                                </table>
				            </td>
                            <td id="residual" style="display: <?=($data['amount_residual'] > 0) ? 'block' : 'none'?>">
                                <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="label grey"><?=$this->getMark()?>Залишки, грн.:</td>
                                    <td><input type="text" name="amount_residual" value="<?=$data['amount_residual']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

            </tr>
			</table>
			<div class="section">Витрати:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Вартість експертизи, грн.:</td>
				<td><input type="text" name="amount_expertize" value="<?=$data['amount_expertize']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, true)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Вартість транспортування, грн.:</td>
				<td><input type="text" name="amount_evacuate" value="<?=$data['amount_evacuate']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, true)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Евакуатор, грн.:</td>
				<td><input type="text" name="amount_compensation" value="<?=$data['amount_compensation']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table>

			<table cellpadding="5" cellspacing="0">
			<tr>
				<td id="amount"><?//=getMoneyFormat($data['amount']?></td>
			</tr>
			</table>
			<? } ?>

			<div id="paymentsBlock" style="display: <?=($data['amount']) ? 'block' : 'none'?>">
				<div class="section">Відшкодування:</div>
				<?=($this->mode == 'update') ? '<a href="javascript: addPayment()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати платіж" /></a> <a href="javascript: addPayment()">Додати платіж</a>' : ''?>
				<table id="payments_calendar">
				<? foreach($data['payments_calendar'] as $payment) { ?>
				<tr id="payment_calendar<?=$payment['id']?>">
					<td>
                        <input type="hidden" name="payments_calendar[<?=$payment['id']?>][product_types_id]" value="<?=PRODUCT_TYPES_GO?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][id]" value="<?=$payment['id']?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][recipient_types_id]" value="<?=$payment['recipient_types_id']?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][recipients_id]" value="<?=$payment['recipients_id']?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][payed_amount]" value="<?=$payment['payed_amount']?>" />
                        <input type="hidden" name="payments_calendar[<?=$payment['id']?>][car_services_tis]" value="<?=$payment['car_services_tis']?>" />

						<table width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey"><?=$this->getMark()?>Сума, грн.:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][amount]" value="<?=$payment['amount']?>" maxlength="10" class="fldMoney" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>Тип:</td>
							<td>
								<select name="payments_calendar[<?=$payment['id']?>][payment_types_id]" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" onchange="changeEssential(<?=$payment['id']?>)" class="fldSelect" <?=$this->getReadonly(true)?>>
									<option value="<?=PAYMENT_TYPES_PART_PREMIUM?>" <?=($payment['payment_types_id'] == PAYMENT_TYPES_PART_PREMIUM) ? 'selected' : ''?>>Частина страхової премії</option>
									<option value="<?=PAYMENT_TYPES_COMPENSATION?>" <?=($payment['payment_types_id'] == PAYMENT_TYPES_COMPENSATION) ? 'selected' : ''?>>Страхове відшкодування</option>
								</select>
							</td>
							<td><b>Сплачено:</b> <?=getMoneyFormat($payment['payed_amount'])?></td>
							<td align="right">
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: setEssentialInsurer(<?=$payment['id']?>)"><? } ?><span id="insurer<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_INSURER) ? 'bold' : 'normal'?>">Страхувальник</span><? if ($this->mode == 'update') {?></a><? } ?> &nbsp; | &nbsp; 
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: setEssentialAssured(<?=$payment['id']?>)"><? } ?><span id="assured<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_ASSURED) ? 'bold' : 'normal'?>">Вигодонабувач</span><? if ($this->mode == 'update') {?></a><? } ?> &nbsp; | &nbsp;
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: showCarServicesWindow(<?=$payment['id']?>)"><? } ?><span id="car_service<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE) ? 'bold' : 'normal'?>">СТО</span><? if ($this->mode == 'update') {?></a><? } ?> &nbsp; | &nbsp; 
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: setEssentialOther(<?=$payment['id']?>)"><? } ?><span id="other<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_OTHER) ? 'bold' : 'normal'?>">Фізична особа</span><? if ($this->mode == 'update') {?></a><? } ?>
							</td>
						</tr>
						</table>

						<table id="recipientEssential<?=$payment['id']?>" cellpadding="5" cellspacing="0" style="display: <?=($payment['payment_types_id'] == 6) ? 'block' : 'none'?>">
						<tr>
							<td class="label grey">СКР отримувача:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][payment_bank_card_number]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['payment_bank_card_number'])))?>" maxlength="19" class="fldText edrpou" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver edrpou'" onblur="this.className='fldText edrpou'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>Розрахунковий рахунок:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][payment_bank_account]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['payment_bank_account'])))?>" maxlength="20" class="fldText bankAccount" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver bankAccount'" onblur="this.className='fldText bankAccount'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>MФО:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][payment_bank_mfo]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['payment_bank_mfo'])))?>" maxlength="6" class="fldText mfo" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver mfo'" onblur="this.className='fldText mfo'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>ЄДРПОУ банку:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][bank_edrpou]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['bank_edrpou'])))?>" maxlength="8" class="fldText edrpou" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver edrpou'" onblur="this.className='fldText edrpou'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>Банк:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][payment_bank]" value='<?=htmlspecialchars($this->replaceTags(trim($payment['payment_bank'])))?>' maxlength="50" class="fldText company" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>

						<table cellpadding="0" cellspacing="0">
						<tr>
							<td class="label grey"><?=$this->getMark()?>Отримувач:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][recipient]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['recipient'])))?>" maxlength="50" class="fldText" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>ІПН (ЄДРПОУ):</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][recipient_identification_code]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['recipient_identification_code'])))?>" maxlength="10" class="fldText code" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey"><?=$this->getMark()?>Призначення:</td>
							<td width="500"><input type="text" name="payments_calendar[<?=$payment['id']?>][basis]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['basis'])))?>" maxlength="500" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
						</tr>
                        </table>
                        <table cellpadding="0" cellspacing="0">
                        <tr id="audatex_codeBlock<?=$payment['id']?>" style="display: <?=($payment['car_services_tis'] == 1 ? 'block' : 'none')?>">
                            <td class="label grey"><?=$this->getMark()?>Код AUDATEX:</td>
                            <td><input type="text" name="payments_calendar[<?=$payment['id']?>][audatex_code]" value="<?=$payment['audatex_code']?>" maxlength="10" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                        </tr>
						</table><br />
					</td>
					<? if ($this->mode == 'update') {?><td><? if ($payment['payed_amount'] <= 0) {?><a onclick="deletePayment(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a><? } else '&nbsp;' ?></td><? } ?>
				</tr>
				<? } ?>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td id="payments_calendar_amount"><?//=getMoneyFormat($data['amount']?></td>
				</tr>
				</table>
			</div>
			<?=CarServices::getListToChoose($data[0]['result_calculation_car_services_id'], 1, 'car_services_id');?>
			

			<div class="section">Перелік документів, використаних для складання акту:</div>
			<table width="100%" cellpadding="5" cellspacing="0">
			<tr>
				<td width="50%" valign="top"><?=$this->getDocumentTypes($data)?></td>
				<td width="50%" valign="top">
					<? if ($this->mode == 'update') {?>
					<table>
					<tr>
						<td><b>Додатково:</b></td>
						<td><a href="javascript: addDocument()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати документ" /></a></td>
						<td><a href="javascript: addDocument()">додати документ</a></td>
					</tr>
					</table>
					<? } ?>

					<table id="documents" width="100%" cellpadding="5" cellspacing="0">
					<?
						if (is_array($data['document'])) {
							foreach ($data['document'] as $i => $document) {
					?>
					<tr>
						<td><input type="text" name="document[<?=$i?>]" value='<?=$document?>' class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> ></td>
						<? if ($this->mode == 'update') {?><td><a onclick="deleteDocument(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
					</tr>
					<?
							}
						}
					?>
					</table>
				</td>
			</tr>
			</table>

			<div class="section">Додатково:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Статус:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ], $data['act_statuses_id'], $data['languageCode'], $this->getReadonly(false), null, $data);?></td>
				<td class="label grey"><?=$this->getMark()?>Дата отримання останнього документу:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('documents_date') ], $data[ 'documents_date_year' ], $data[ 'documents_date_month' ], $data[ 'documents_date_day' ], 'documents_date', $this->getReadonly(true) . ' onchange="setLimitsDate()"')?></td>
			</tr>
			<tr>
				<? if ($data['insurance'] == 1) {?>
				<td class="label grey" colspan="2" nowrap>Гранична дата виплати: <b id="limit_payment_date"><?=date('d.m.Y', strtotime('+ 90 day', strtotime($data['documents_date'])))?></b></td>
				<? } ?>
			</tr>
			</table>

			<? if ($this->mode == 'update') {?><div align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></div><? } ?>
		</td>
	</tr>
	</table>
</form>
<script type="text/javascript">
	changeAmount(true);
	changeRowStyle('payments_calendar');
	changeRowStyle('documents');
	initFocus(document.<?=$this->objectTitle?>);
</script>