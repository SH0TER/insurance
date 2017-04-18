<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<script type="text/javascript">
	var prefix = '';
	
	function setLimitsDate() {
		var documents_date = $('#documents_date_day').val() + '.' + $('#documents_date_month').val() + '.' + $('#documents_date_year').val();
		var approval_term = parseInt($('input[name=approval_term]').val());
		var payment_term = parseInt($('input[name=payment_term]').val());

		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			async:		false,
			data:		'do=AccidentActs|getLimitsDateInWindow' +
						'&product_types_id=<?=$data['product_types_id']?>' +
						'&documents_date=' + documents_date +
						'&date=<?=$data['date']?>' + 
						'&approval_term=' + approval_term +
						'&payment_term=' + payment_term,
			success: 	function(result) {
							$('#limit_approval_date').html(result.limit_approval_date);
							$('#limit_payment_date').html(result.limit_payment_date);
						}
		});
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

	function changeAmount(init) {

		item_types_id = parseInt($('input[name=item_types_id]').val());
		//показываем общую сумму счета на восстановление
		amount_start = (item_types_id == 2 ? parseFloat($('input[name=amount_details]').val()) + parseFloat($('input[name=amount_material]').val()) + parseFloat($('input[name=amount_work]').val()) : parseFloat($('input[name=amount_start]').val()));
		amount_start = roundNumber(amount_start, 2);

		$('#billAmount').html( getMoneyFormat(amount_start > 0 ? amount_start : 0) );
		//определяем страховую сумму
		var insurance_price = parseFloat($('input[name=insurance_price]').val());

		//вычисляем сумму страхового возмещения без учета франшизы

		var deductibles_amount = $('input[name=deductibles_amount]').val();

		discount = parseFloat($('input[name=discount]').val());

		amount	= amount_start - deductibles_amount - discount;

		amount	= getRateFormat(amount, 2);
console.log(deductibles_amount);
		if (amount < 0) {
			amount = 0;
		}

		if (amount > 0) {
			$('#paymentsBlock').css('display', 'block');
		} else {
			$('#paymentsBlock').css('display', 'none');
		}

		result = '';

		if (amount > 0) {
			result = '<b>Підлягає страхове відшкодування в розмірі:</b> ';

            if (discount > 0) {
				result = result + ' (' ;
			}

            result = result + amount_start;

			result = result + ' - ' + deductibles_amount + ' (франшиза) ';

			if (discount > 0) {
				result = result + ' - ' + discount + ' (знижка) ';
			}

			result = result + ' = <b>' + getMoneyFormat(amount) + '</b>';
		} else {
			result = '<b>без виплати, франшиза більша збитку</b>';
		}

		$('#amount').html( result );
	}

	//снимаем выделение со всех получателей
	function setNormal(i) {
        $('#express' + i).attr('style', 'font-weight: normal;');
		$('#insurer' + i).attr('style', 'font-weight: normal;');
		$('#owner' + i).attr('style', 'font-weight: normal;');
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
                    $('#insurer_owner').css('display');
                });
				$('#recipientEssential' + i).css('display', 'none');
				$('#payment_types_id' + i).css('display', 'none');
				$('#recipient_types_id' + i).val(<?=RECIPIENT_TYPES_INSURED?>);
                $('input[name="payments_calendar[' + i + '][policies_number]"]').attr('readonly', '');
				break;
			case '<?=PAYMENT_TYPES_COMPENSATION?>':
                $('.hidden_link').css('display', '');
				$('#recipientEssential' + i).css('display', 'block');
				$('input[name="payments_calendar[' + i + '][basis]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][basis]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
                $('input[name="payments_calendar[' + i + '][policies_number]"]').attr('readonly', 'readonly');
				break;
		}
	}

    //устанавливаем текстовку для Отримуача в целях справки для аваркомов
    function setRecipientText(i) {
        var recipientText = '';
        if ($('input[name="payments_calendar[' + i + '][recipient]"]').val() != '' && $('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val() == '') {
            recipientText = recipientText + 'Отримувач: <b>' + $('input[name="payments_calendar[' + i + '][recipient]"]').val() + '</b><br />';
        }
        else if ($('input[name="payments_calendar[' + i + '][recipient]"]').val() != '' && $('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val() != '') {
            recipientText = recipientText + 'Отримувач: <b>' + $('input[name="payments_calendar[' + i + '][payment_bank]"]').val() + '</b><br />';
        }
        if ($('input[name="payments_calendar[' + i + '][payment_bank_account]"]').val() != '') recipientText = recipientText + 'р/р <b>' + $('input[name="payments_calendar[' + i + '][payment_bank_account]"]').val() + '</b>;<br />';
		if ($('input[name="payments_calendar[' + i + '][payment_bank]"]').val() != '')recipientText = recipientText + 'Банк: <b>' + $('input[name="payments_calendar[' + i + '][payment_bank]"]').val() + '</b><br />';
        if ($('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').val() != '')recipientText = recipientText + 'МФО: <b>' + $('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').val() + '</b><br />';
        if ($('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val() != '')recipientText = recipientText + 'СКР: <b>' + $('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').val() + '</b><br />';

        if ($('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').val() != '')recipientText = recipientText + 'ІПН(ЄДРПОУ): <b>' + $('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').val() + '</b><br />';

        $('#recipientText').html(  recipientText  );
    }

	//устанавливаем назначение платежа
	function setBasis(i) {
		var basis = '';
		switch ( $('select[name="payments_calendar[' + i + '][payment_types_id]"] option:selected').val() ) {
			case '<?=PAYMENT_TYPES_PART_PREMIUM?>':
                if($('#policies_number').val() == $('input[name="payments_calendar[' + i + '][policies_number]"]').val())
                    end_of_basis = 'вказаному договору';
                else
                    end_of_basis = 'договору страхування ' + $('input[name="payments_calendar[' + i + '][policies_number]"]').val();

				    basis = 'Зарахувати згідно договору страхування № ' + $('#policies_number').val() + ' від ' + $('input[name=policies_date_format]').val() + 'р. в якості оплати страхового платежу по ' + end_of_basis;

				break;
			case '<?=PAYMENT_TYPES_COMPENSATION?>':
				basis = 'Страхове вiдшкодування згiдно договору страхування № ' + $('input[name=policies_number]').val() + ' від ' + $('input[name=policies_date_format]').val() + 'р. ' + 
				'<?=($data['policies_insurer_person_types_id'] == 1 ? $data['policies_insurer_lastname'] . ' ' . $data['policies_insurer_firstname'] . ' ' . $data['policies_insurer_patronymicname'] : $this->replacetags($data['policies_insurer_company']))?>';

				switch ( $('input[name="payments_calendar[' + i + '][recipient_types_id]"]').val() ) {
					case '<?=RECIPIENT_TYPES_CAR_SERVICE?>':
						basis = basis + ' та згiдно ' + $('input[name=payment_document_number]').val() + ' вiд ' + $('input[name=payment_document_date]').val() + 'р.';
						break;
					default:
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

		$('input[name="payments_calendar[' + i + '][basis]"]').val(basis);
		//$('#basis').html( 'Призначення: ' + '<b>' + basis + '</b>' );

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
			case <?=RECIPIENT_TYPES_OWNER?>:

				$('#owner' + i).attr('style', 'font-weight: bold;');

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

				$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][payment_bank_card_number]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][payment_bank_account]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][payment_bank_mfo]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][payment_bank]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');

				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][recipient]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('readonly', 'readonly');
				$('input[name="payments_calendar[' + i + '][recipient_identification_code]"]').attr('style', 'color: rgb(102, 102, 102); background-color: rgb(245, 245, 245);');
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
        setRecipientText(i);
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

	function setEssentialOwner(i) {
		$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Accidents|getEssentialOwnerInWindow' +
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
        tb_show('<strong>Вибір СТО:</strong>', '#TB_inline?height=600&width=800&inlineId=hiddenModalContent', false);
    }

    function setEssentialCarService(recipients_id, recipient, recipient_identification_code, bank_account, bank_mfo, bank_edrpou, bank) {

		$('input[name="payments_calendar[' + item + '][recipients_id]"]').val(recipients_id);
		$('input[name="payments_calendar[' + item + '][recipient]"]').val(recipient);
		$('input[name="payments_calendar[' + item + '][recipient_identification_code]"]').val(recipient_identification_code);
		$('input[name="payments_calendar[' + item + '][payment_bank_account]"]').val(bank_account);
		$('input[name="payments_calendar[' + item + '][payment_bank]"]').val(bank);
		$('input[name="payments_calendar[' + item + '][payment_bank_mfo]"]').val(bank_mfo);
        $('input[name="payments_calendar[' + item + '][bank_edrpou]"]').val(bank_edrpou);

		setRecipientType(item, <?=RECIPIENT_TYPES_CAR_SERVICE?>);
		changeEssential(item);

        tb_remove();
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

		setRecipientType(i, '<?=RECIPIENT_TYPES_OTHER?>');
	}

	function changeRowStyle(item) {
		for (i=0; i < document.getElementById( item ).rows.length; i++) {
			document.getElementById( item ).rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

    var payment = -1;

	function addPayment() {

    	var item =
			'<tr id="payments_calendar' + payment + '">' +
				'<td>' +
                    '<input type="hidden" name="payments_calendar[' + payment + '][product_types_id]" value="<?=PRODUCT_TYPES_PROPERTY?>" />' +
					'<input type="hidden" name="payments_calendar[' + payment + '][id]" value="' + payment + '" />' +
					'<input type="hidden" name="payments_calendar[' + payment + '][recipient_types_id]" value="" />' +
					'<input type="hidden" name="payments_calendar[' + payment + '][recipients_id]" value="" />' +

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
							'<a class="hidden_link" href="javascript: setEssentialOwner(' + payment + ')" id="owner_link"><span id="owner' + payment + '">Власник</span></a> &nbsp; <label class="hidden_link">|</label> &nbsp; ' +
							'<a class="hidden_link" href="javascript: setEssentialAssured(' + payment + ')" id="assured_link"><span id="assured' + payment + '">Вигодонабувач</span></a> &nbsp; <label class="hidden_link">|</label> &nbsp; ' +
							'<a class="hidden_link" href="javascript: showCarServicesWindow(' + payment + ')" id="car_service_link"><span id="car_service' + payment + '">СТО</span></a> &nbsp; <label class="hidden_link">|</label> &nbsp; ' +
							'<a class="hidden_link" href="javascript: setEssentialOther(' + payment + ')" id="other_link"><span id="other' + payment + '">Фізична особа</span></a>' +
						'</td>' +
					'</tr>' +
					'</table>' +

					'<table id="recipientEssential' + payment + '" cellpadding="5" cellspacing="0" style="display: none;">' +
					'<tr>' +
						'<td class="label grey">СКР отримувача:</td>' +
						'<td><input type="text" name="payments_calendar[' + payment + '][payment_bank_card_number]" value="" maxlength="16" class="fldText edrpou" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver edrpou\'" onblur="this.className=\'fldText edrpou\'" /></td>' +
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
                        '<td class="label grey"><?=$this->getMark()?>Номер договору:</td> ' +
						'<td width="100"><input type="text" name="payments_calendar[' + payment + '][policies_number]" value="<?=$payment['policies_number']?>" class="fldText" onchange="changeEssential(' + payment + ')" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" <?=$this->getReadonly(false, $payment['payment_types_id'] == PAYMENT_TYPES_COMPENSATION)?> /></td>' +
					'</tr>' +
					'</table>' +
					'<table>' +
                    '<tr>' +
                        '<td class="label grey"><?=$this->getMark()?>Призначення:</td>' +
                        '<td width="1000"><input type="text" name="payments_calendar[' + payment + '][basis]" value="" maxlength="500" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" <?=$this->getReadonly(false)?> /></td>' +
                    '</tr>' +
                    '</table>' +
				'</td>' +
				'<td><a onclick="deletePayment(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
			'</tr>';

    	$('#payments_calendar').append(item);
        //устанавливаем текущий номер договора в новый платеж (для взаимозачёта)
        $('input[name="payments_calendar[' + payment + '][policies_number]"]').val($('#policies_number').val());
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
</script>
<? $Log->showSystem(); //_dump($data)?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="step" value="<?=$data['step']?>" />
	<input type="hidden" name="reason" value="<?=$data['reason']?>" />
	<input type="hidden" name="risks_id" value="<?=$data['risks_id']?>" />
	<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
	<input type="hidden" name="insurance" value="<?=$data['insurance']?>" />
	<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
		
	<input type="hidden" name="certificates_number" value="<?=$data['certificates_number']?>" />
	<input type="hidden" name="item_types_id" value="<?=$data['item_types_id']?>" />
	
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="policies_date_format" value="<?=$data['policies_date_format']?>" />
	<input type="hidden" name="policies_insurer_lastname" value="<?=$data['policies_insurer_lastname']?>" />
	<input type="hidden" name="policies_insurer_firstname" value="<?=$data['policies_insurer_firstname']?>" />
	<input type="hidden" name="policies_insurer_patronymicname" value="<?=$data['policies_insurer_patronymicname']?>" />
	<input type="hidden" name="policies_insurer_company" value="<?=htmlspecialchars($this->replacetags(trim(str_replace("\\", "", $data['policies_insurer_company']))))?>" />

    <table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td>
            <?if($data['acts_count'] > 0 && $data['insurance'] == 1) {?>
            <div class="section">Тип акта:</div>
            <table>
                <tr>
                    <td class="label grey">Доплата:</td>
                    <td><input type="radio" name="act_type" value="1" <?=($data['act_type'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                    <td class="label grey">Повернення грошей та виплата на інші реквізити:</td>
                    <td><input type="radio" name="act_type" value="2" <?=($data['act_type'] == 2) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                </tr>
            </table>
            <?}elseif($data['acts_count'] > 0 && $data['insurance'] != 1) {?>
            <div class="section">Тип акта:</div>
            <table>
                <tr>
                <td class="label grey">Повернення грошей та відмова:</td>
                <td><input type="checkbox" name="act_type" value="3" <?=($data['act_type'] == 3) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
                </tr>
            </table>
            <?}?>
			<div class="section">Сертифікат:</div>
			<b>Сертифікат:</b> 
				<a href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>" target="_blank">
				<?=$data['certificates_number']?>
				<?if($data['important_person'] == 1){?>  
					<b style="color: red;">VIP</b>
				<?}?></a> &nbsp; &nbsp; 
				<b>Термін дії:</b> <?=$data['policies_begin_datetime_format']?> - <?=$data['policies_interrupt_datetime_format']?> &nbsp; &nbsp; 
				<b>Премія:</b> <?=getMoneyFormat($data['policies_amount'])?> &nbsp; &nbsp; 				
			<b>Коментар:</b> <?=$data['comment']?>

			<?if ((($action == 'insert' || $action == 'update') && $data['insurance'] == 1) || ($action == 'view' && $data['act_insurance'] == 1)) { ?>
			
			<div class="section">Коефіцієнти:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey">Страхова сума, грн.:</td>
				<td><?=getMoneyFormat($data['insurance_price'])?></td>
				<td class="label grey"><?=$this->getMark()?>Ринкова вартість, грн.:</td>
				<td><input type="text" name="market_price" value="<?=$data['market_price']?>" maxlength="13" onchange="changeAmount(0)" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, $returnPartialReadonly)?> /></td>
			</tr>
			</table>
			
			<div class="section">Розмір матеріального збитку:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Згiдно:</td>
				<td width="490"><input type="text" name="payment_document_number" value="<?=$data['payment_document_number']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
				<td> &nbsp;&nbsp;вiд&nbsp;&nbsp; </td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_date') ], $data[ 'payment_document_date_year' ], $data[ 'payment_document_date_month' ], $data[ 'payment_document_date_day' ], 'payment_document_date',  $this->getReadonly(true))?></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<? if ($data['item_types_id'] == 2) {?>
			<?} else {?>
			<tr>
				<td class="label grey"><?=$this->getMark()?>Розмір збитку, грн.:</td>
				<td><input type="text" name="amount_start" value="<?=$data['amount_start']?>" maxlength="10" onchange="changeAmount()" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
			</tr>
			</table><br />
			<? } ?>
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
			</table><br />
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Франшиза, грн.:</td>
				<td><input type="text" name="deductibles_amount" value="<?=$data['deductibles_amount']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, !$data['deductibles_change'])?> /></td>
				<td><input type="checkbox" name="deductibles_change" value="1" onclick="changeDeductible()" <?=($data['deductibles_change'] ? 'checked' : '')?> <?=$this->getReadonly(true, $this->mode == 'view' || $data['amount_previous'] > 0)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Знижка, грн.:</td>
				<td><input type="text" name="discount" value="<?=$data['discount']?>" maxlength="5" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false)?> /></td>
				<td id="discount" style="display: <?=($data['discount_percent'] > 0) ? 'block' : 'none'?>">
					<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="label grey"><?=$this->getMark()?>Згідно:</td>
						<td width="400"><input type="text" name="discount_basis" value="<?=$data['discount_basis']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			
			<div class="section">Витрати:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Вартість експертизи, грн.:</td>
				<td><input type="text" name="amount_expertize" value="<?=$data['amount_expertize']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, $returnPartialReadonly)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Інші витрати, грн.:</td>
				<td><input type="text" name="amount_other" value="<?=$data['amount_other']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, $returnPartialReadonly)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Евакуатор, грн.:</td>
				<td><input type="text" name="amount_evacuate" value="<?=$data['amount_evacuate']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, $returnPartialReadonly)?> /></td>
				
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
				<tr id="payment<?=$payment['id']?>">
					<td>
                        <input type="hidden" name="payments_calendar[<?=$payment['id']?>][product_types_id]" value="<?=PRODUCT_TYPES_KASKO?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][id]" value="<?=$payment['id']?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][recipient_types_id]" value="<?=$payment['recipient_types_id']?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][recipients_id]" value="<?=$payment['recipients_id']?>" />
						<input type="hidden" name="payments_calendar[<?=$payment['id']?>][payed_amount]" value="<?=$payment['payed_amount']?>" />

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
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: setEssentialOwner(<?=$payment['id']?>)"><? } ?><span id="owner<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_OWNER) ? 'bold' : 'normal'?>">Власник</span><? if ($this->mode == 'update') {?></a><? } ?> &nbsp; | &nbsp;
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: setEssentialAssured(<?=$payment['id']?>)"><? } ?><span id="assured<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_ASSURED) ? 'bold' : 'normal'?>">Вигодонабувач</span><? if ($this->mode == 'update') {?></a><? } ?> &nbsp; | &nbsp;
								<a href="javascript: showCarServicesWindow(<?=$payment['id']?>)"><span id="car_service<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE) ? 'bold' : 'normal'?>">СТО</span><? if ($this->mode == 'update') {?></a><? } ?> &nbsp; | &nbsp;
								<? if ($this->mode == 'update' && $payment['payed_amount'] <= 0) {?><a href="javascript: setEssentialOther(<?=$payment['id']?>)"><? } ?><span id="other<?=$payment['id']?>" style="font-weight: <?=($payment['recipient_types_id'] == RECIPIENT_TYPES_OTHER) ? 'bold' : 'normal'?>">Фізична особа</span><? if ($this->mode == 'update') {?></a><? } ?>
							</td>
						</tr>
						</table>

						<table id="recipientEssential<?=$payment['id']?>" cellpadding="5" cellspacing="0" style="display: <?=($payment['payment_types_id'] == 6) ? 'block' : 'none'?>">
						<tr>
							<td class="label grey">СКР отримувача:</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][payment_bank_card_number]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['payment_bank_card_number'])))?>" maxlength="16" class="fldText edrpou" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver edrpou'" onblur="this.className='fldText edrpou'" <?=$this->getReadonly(false)?> /></td>
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
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][recipient]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['recipient'])))?>" maxlength="50" class="fldText" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false, $payment['recipient_types_id'] != RECIPIENT_TYPES_OTHER)?> /></td>
							<td class="label grey"><?=$this->getMark()?>ІПН (ЄДРПОУ):</td>
							<td><input type="text" name="payments_calendar[<?=$payment['id']?>][recipient_identification_code]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['recipient_identification_code'])))?>" maxlength="10" class="fldText code" onchange="changeEssential(<?=$payment['id']?>)" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false, $payment['recipient_types_id'] != RECIPIENT_TYPES_OTHER)?> /></td>
							<td class="label grey"><?=$this->getMark()?>Номер договору:</td>
							<td width="500"><input type="text" name="payments_calendar[<?=$payment['id']?>][policies_number]" value="<?=$payment['policies_number']?>"  onchange="changeEssential(<?=$payment['id']?>)" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
						<table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="label grey"><?=$this->getMark()?>Призначення:</td>
                            <td width="1000"><input type="text" name="payments_calendar[<?=$payment['id']?>][basis]" value="<?=htmlspecialchars($this->replaceTags(trim($payment['basis'])))?>" maxlength="500" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?>></td>
                        </tr>
                        </table>
						<br />
					</td>
					<? if ($this->mode == 'update') {?><td><? if ($payment['payed_amount'] <= 0) {?><a onclick="deletePayment(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a><? } else '&nbsp;' ?></td><? } ?>
				</tr>
				<? } ?>
				</table>
				<table cellpadding="5" cellspacing="0" style="margin-top: 30px;">
                <tr>
                    <td><b>Підказки до акту:</b></td>
                </tr>
                <tr>
                    <td id="basis"></td>
                </tr>
                 <tr>
                    <td id="recipientText"></td>
                </tr>
				<tr>
					<td id="payments_calendar_amount"><?//=getMoneyFormat($data['amount']?></td>
				</tr>
				</table>
			</div>
			<?=CarServices::getListToChoose($data['car_services_id']);?>


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
						<td><input type="text" name="document[<?=$i?>]" value="<?=$document?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> ></td>
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
				<td class="label grey"><?=$this->getMark()?>Кількість робочих днів на прийняття рішення:</td>
				<td><input onchange="setLimitsDate()" class="fldInteger" type="text" onblur="this.className='fldInteger'" onfocus="this.className='fldIntegerOver'" maxlength="2" value="<?=$data['approval_term']?>" name="approval_term" <?=$this->getReadonly(false)?>></td>
				<? if ($data['insurance'] == 1) {?>
				<td class="label grey"><?=$this->getMark()?>Кількість робочих днів на виплату:</td>
				<td><input onchange="setLimitsDate()" class="fldInteger" type="text" onblur="this.className='fldInteger'" onfocus="this.className='fldIntegerOver'" maxlength="2" value="<?=$data['payment_term']?>" name="payment_term" <?=$this->getReadonly(false)?>></td>
				<? } ?>
			</tr>
			<tr>
				<td class="label grey" colspan="2" nowrap>Гранична дата прийняття рішення: <b id="limit_approval_date"><?=($data['documents_date'] == null || $data['documents_date'] == '0000-00-00' ? '' : BankDay::getEndDate($data['documents_date'], $data['approval_term'], 'd.m.Y'))?></b></td>
				<? if ($data['insurance'] == 1) {?>
				<td class="label grey" colspan="2" nowrap>Гранична дата виплати: <b id="limit_payment_date"><?=($data['date'] != '0000-00-00' && $data['date'] != null ? BankDay::getEndDate($data['date'], $data['payment_term'], 'd.m.Y') : ($data['documents_date'] == null || $data['documents_date'] == '0000-00-00' ? '' : BankDay::getEndDate($data['documents_date'], $data['approval_term'] + $data['payment_term'], 'd.m.Y')))?></b></td>
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
	setLimitsDate();
</script>