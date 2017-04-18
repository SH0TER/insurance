<script name="text/javascript">
<?=ExpertOrganizations::getList()?>
<?=CarServices::getList()?>
function setFieldAvailables(value) {
	var fields = new Array('recipient', 'recipient_identification_code');
	for (i=0; i<fields.length; i++) {
		$('input[name=' + fields[ i ] + ']').attr('readonly', value);
		if (value) {
			$('input[name=' + fields[ i ] + ']').css('color', '#666666');
			$('input[name=' + fields[ i ] + ']').css('background-color', '#f5f5f5');
		} else {
			$('input[name=' + fields[ i ] + ']').css('color', '#000000');
			$('input[name=' + fields[ i ] + ']').css('background-color', '#ffffff');
		}
	}
}
function setValues(recipient, identification_code, bank, bank_mfo, bank_edrpou, bank_account, bank_card_number) {
	$('input[name=recipient]').val(recipient);
	$('input[name=recipient_identification_code]').val(identification_code);
	$('input[name=payment_bank]').val(bank);
	$('input[name=payment_bank_mfo]').val(bank_mfo);
    $('input[name=bank_edrpou]').val(bank_edrpou);
	$('input[name=payment_bank_account]').val(bank_account);
	$('input[name=payment_bank_card_number]').val(bank_card_number);
}
function setEssential(recipients_id) {
	if (recipients_id == null) {
		recipients_id = $('#recipients_id').val();
	}

	switch ($('select[name=recipient_types_id]').val()) {
		case '1'://Власник
		case '2'://Вигодонабувач
		case '4'://Страхувальник
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Accidents|getEssentialInWindow' +
							'&product_types_id=<?=$data['product_types_id']?>' +
							'&recipient_types_id=' + $('select[name=recipient_types_id]').val() +
							'&id=<?=$data['accidents_id']?>',
				success:	function(result) {
								setValues(result.title, result.identification_code, result.bank, result.bank_mfo, result.bank_account, result.bank_card_number);
							}
			});
			break;
		case '3'://Експерт
			for (var i=0; i < experts.length; i++) {
				if (recipients_id == experts[ i ][ 0 ]) {
					setValues(experts[ i ][ 1 ], experts[ i ][ 2 ], experts[ i ][ 3 ], experts[ i ][ 4 ],experts[ i ][ 5 ], experts[ i ][ 6 ], '');
				}
			}
			break;
		case '5'://СТО
			for (var i=0; i < car_services.length; i++) {
				if (recipients_id == car_services[ i ][ 0 ]) {
					setValues(car_services[ i ][ 1 ], car_services[ i ][ 2 ], car_services[ i ][ 3 ], car_services[ i ][ 4 ], car_services[ i ][ 5 ], car_services[ i ][ 6 ], '');
				}
			}
			break;
	}
}
function setRecipients(init) {
	document.getElementById('recipients_id').options.length = 0;
	switch ($('select[name=recipient_types_id]').val()) {
		case '1'://Власник
			$('#recipients_id').css('display', 'none');
			setFieldAvailables(false);
			break;
		case '2'://Вигодонабувач
			$('#recipients_id').css('display', 'none');
			setFieldAvailables(false);
			break;
		case '3'://Експерт
			$('#recipients_id').css('display', 'block');
			for (var i=0; i < experts.length; i++) {
				$('#recipients_id').get(0)[$('#recipients_id option').length] = new Option(experts[ i ][ 1 ], experts[ i ][ 0 ]);
			}
			setFieldAvailables(true);
			break;
		case '4'://Страхувальник
			$('#recipients_id').css('display', 'none');
			setFieldAvailables(false);
			break;
		case '5'://СТО
			$('#recipients_id').css('display', 'block');
			for (var i=0; i < car_services.length; i++) {
				$('#recipients_id').get(0)[$('#recipients_id option').length] = new Option(car_services[ i ][ 1 ], car_services[ i ][ 0 ]);
			}
			setFieldAvailables(true);
			break;
	}
    $("#recipients_id [value='<?=$data['recipients_id']?>']").attr("selected", "selected");

	if (init == false) {
		setEssential();
	}
}

function disablePaymentsDetails() {
    //$('#recipients_id').attr('disabled',true);
    //$('select[name=payment_types_id]').attr('disabled',true);
    //$('select[name=recipient_types_id]').attr('disabled',true);
    //$('select[name=recipients_id]').attr('disabled',true);
    $('#amount').attr('readonly',true);
    //$('#basis').attr('readonly',true);
    //$('#payment_bank_mfo').attr('readonly',true);
    //$('#bank_edrpou').attr('readonly',true);
    //$('#payment_bank').attr('readonly',true);
}

function setPaymentType() {
	if ($('#payment_types_id').val() == '1') {
		$("select[name=recipient_types_id] [value='3']").attr('selected', 'selected');
		setRecipients(false);
	}
}
</script>
<div class="block">
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
                                <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
								<input type="hidden" name="id" value="<?=$data['id']?>" />
								<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
								<input type="hidden" name="managers_id" value="<?=$data['managers_id']?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <input type="hidden" name="acts_id" value="<?=$data['acts_id']?>" />
                                <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                                <div id='disabledBlock'>
                                    <input type="hidden" name="recipient_types_id" value="<?=$data['recipient_types_id']?>" />
                                    <input type="hidden" name="recipients_id" value="<?=$data['recipients_id']?>" />
                                    <input type="hidden" name="payment_types_id" value="<?=$data['payment_types_id']?>" />
                                </div>
								<table cellpadding="5" cellspacing="0">
								<tr>
									<td class="label grey"><?=$this->getMark()?>Сума, грн.:</td>
									<td><input type="text" name="amount"  id="amount" value="<?=$data['amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" /></td>
									<td class="label grey"><?=$this->getMark()?>Згідно:</td>
									<td><input type="text" name="basis" id="basis" value="<?=$data['basis']?>" maxlength="500" style="width: 510px;" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
								</tr>
								</table>

								<div class="section">Отримувач:</div>
                                <div id="recipient_block1">
                                    <table cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td class="label grey"><?=$this->getMark()?>Призначення:</td>
                                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('payment_types_id') ], $data['payment_types_id'], $data['languageCode'], ' onchange="setPaymentType();"' , null, $data)?></td>
                                        <td class="label grey"><?=$this->getMark()?>Отримувач:</td>
                                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_types_id') ], $data['recipient_types_id'], $data['languageCode'], ' onchange="setRecipients(false);"' , null, $data)?></td>
                                        <td><select id="recipients_id" name="recipients_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="setEssential()"></select></td>
                                    </tr>
                                    </table>
                                </div>
								<table cellpadding="2" cellspacing="0">
								<tr>
									<td class="label grey"><?=$this->getMark()?>Назва:</td>
									<td><input type="text" name="recipient" value="<?=$data['recipient']?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company';" onblur="this.className='fldText company';" /></td>
									<td class="label grey"><?=$this->getMark()?>ІПН (ЄДРПОУ):</td>
									<td><input type="text" name="recipient_identification_code" value="<?=$data['recipient_identification_code']?>" maxlength="10" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
								</tr>
								</table>

								<div class="section">Банківські реквізити:</div>
								<table cellpadding="2" cellspacing="0">
								<tr>
									<td class="label grey">СКР:</td>
									<td><input type="text" name="payment_bank_card_number" value="<?=$data['payment_bank_card_number']?>" maxlength="19" class="fldText bank_account" onfocus="this.className='fldTextOver bank_account';" onblur="this.className='fldText bank_account';" /></td>
									<td class="label grey"><?=$this->getMark()?>Рахунок:</td>
									<td><input type="text" name="payment_bank_account" value="<?=$data['payment_bank_account']?>" maxlength="20" class="fldText bank_account" onfocus="this.className='fldTextOver bank_account';" onblur="this.className='fldText bank_account';" /></td>
									<td class="label grey"><?=$this->getMark()?>МФО:</td>
									<td><input type="text" name="payment_bank_mfo" id="payment_bank_mfo" value="<?=$data['payment_bank_mfo']?>" maxlength="6" class="fldText mfo" onfocus="this.className='fldTextOver mfo';" onblur="this.className='fldText mfo';" /></td>
									<td class="label grey"><?=$this->getMark()?>ЄДРПОУ(банка):</td>
									<td><input type="text" name="bank_edrpou" id="bank_edrpou" value="<?=$data['bank_edrpou']?>" maxlength="8" class="fldText edrpou" onfocus="this.className='fldTextOver edrpou';" onblur="this.className='fldText edrpou';" /></td>
									<td class="label grey"><?=$this->getMark()?>Банк:</td>
									<td><input type="text" name="payment_bank" id="payment_bank" value="<?=$data['payment_bank']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company';" onblur="this.className='fldText company';" /></td>
								</tr>
								</table><br />

								<div align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></div>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
setRecipients(true);
<? if (ereg('update$', $_REQUEST['do'])) { ?>
setEssential('<?=$data['recipients_id']?>');
<? } ?>
initFocus(document.<?=$this->objectTitle?>);
<?
if(intval($data['acts_id']) != 0)
    echo 'disablePaymentsDetails()';
else
    echo '$(#disabledBlock).css("display", none)';
?>
</script>