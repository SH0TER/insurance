<?//_dump($data)?>
<script type="text/javascript">
    var policies_id;
	
	function changeCompromiseState(){
		if ($('input[name=compromise_set]').attr('checked')) {
			$('.compromiseBlock').show();
			$('input[name=compromise]').val(1);
		} else {
			$('.compromiseBlock').hide();
			$('input[name=compromise]').val(0);
		}
	}

    function showHideInsuranceBlock() {
		switch ( $('input[name=insurance]:checked').val() ) {
			case '1'://страхова, з виплатою
				$('#insurance1').css('display', 'block');
				$('#insurance23').css('display', 'none');
				$('.notPaymentBlock2').css('display', 'none');
				$('.notPaymentBlock3').css('display', 'none');
				break;
			case '2'://страхова, без виплати
				$('#insurance1').css('display', 'none');
				$('#insurance23').css('display', 'block');
				$('.notPaymentBlock2').css('display', 'block');
				$('.notPaymentBlock3').css('display', 'none');
				break;
			case '3'://не страхова
				$('#insurance1').css('display', 'none');
				$('#insurance23').css('display', 'block');
				$('.notPaymentBlock2').css('display', 'none');
				$('.notPaymentBlock3').css('display', 'block');
				break;
		}
    }

	function setRegres() {
		if ($('input[name=regres]:checked').val() == '1') {
			$('#participant').css('display', 'block');
		} else {
			$('#participant').css('display', 'none');
		}
	}

	function setParticipantOwner() {
		if ($('input[name=participant_owner]:checked').val() == '1') {
			$('input[name=participant_owner_lastname]').val( $('input[name=participant_driver_lastname]').val() );
			$('input[name=participant_owner_firstname]').val( $('input[name=participant_driver_firstname]').val() );
			$('input[name=participant_owner_patronymicname]').val( $('input[name=participant_driver_patronymicname]').val() );
			$('input[name=participant_owner_address]').val( $('input[name=participant_driver_address]').val() );
			$('input[name=participant_owner_phone]').val( $('input[name=participant_driver_phone]').val() );
		} else {
			$('input[name=participant_owner_lastname]').val('');
			$('input[name=participant_owner_firstname]').val('');
			$('input[name=participant_owner_patronymicname]').val('');
			$('input[name=participant_owner_address]').val('');
			$('input[name=participant_owner_phone]').val('');
		}
	}

    function showHideMVSBlock() {
		switch ($('select[name=mvs_average] option:selected').val()) {
			case '1'://Органи ГАИ
				$('#dai_average').css('display', 'block');
				$('#rugu_average').css('display', 'none');
				$('#mvsYes').css('display', 'block');
				break;
			case '2':
			case '3':
				$('#dai_average').css('display', 'none');
				$('#rugu_average').css('display', 'block');
				$('#mvs_average_id').val('');
				$('#mvsYes').css('display', 'block');
				break;
			default:
				$('#mvsYes').css('display', 'none');
				break;
		}
    }

    function setAmountRoughVisibility(){
        value = parseInt($('input[name=amount_rough_type]:checked').val());
        switch (value){
            case 1:
                $("#amount_rough_block").hide();
                break;
            case 2:
                $("#amount_rough_block").show();
                break;
        }
    }

    $(document).ready(function(){

    })
</script>
<? $Log->showSystem(); /*_dump($data);*/?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="mvs_id" value="<?=$data['mvs_id']?>" />
	<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="policies_price" value="<?=$data['policies_price']?>" />
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="policies_amount" value="<?=$data['policies_amount']?>" />
	<input type="hidden" name="policy_payments_amount" value="<?=$data['policy_payments_amount']?>" />
    <input type="hidden" name="financial_institutions_id" value="<?=$data['financial_institutions_id']?>" />
	<input type="hidden" name="policies_begin_datetime_format" value="<?=$data['policies_begin_datetime_format']?>" />
	<input type="hidden" name="policies_interrupt_datetime_format" value="<?=$data['policies_interrupt_datetime_format']?>" />
	<input type="hidden" name="policies_financial_institutions_id" value="<?=$data['policies_financial_institutions_id']?>" />
	<input type="hidden" name="comment" value="<?=$data['comment']?>" />
    <table cellpadding="2" cellspacing="3" width="100%">
	<tr>
		<td>
            <? include_once 'Accidents/monitoring.php' ?>
            <div id="comments"></div>
			<div class="section">Поліс:</div>
			<b>Номер: </b><a href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>" target="_blank"><?=$data['policies_number']?><?if($data['important_person'] == 1){?><b style="color: red;"> VIP</b><?}?></a>

            <? /*include_once 'Accidents/kaskoPolicyCalendar.php'*/ ?><br><br>

            <b>Коментар:</b> <?=$data['comment']?><br><br>


			<div class="section">Обставини:</div>
            <table cellpadding="0" cellspacing="5">
				<tr>
					<td class="label grey">Компроміс:</td>
					<td><input onclick="changeCompromiseState();" type="checkbox" name="compromise_set" value="1" <?=($data['compromise'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['accident_statuses_id'] == ACCIDENT_STATUSES_APPROVAL)?> /></td>
					<input type="hidden" name="compromise" value="<?=intval($data['compromise'])?>" />
				</tr>
			</table>
			<table cellpadding="0" cellspacing="5">
				<tr class="compromiseBlock" style="display:<?=(($data['compromise'] == 1) ? 'block' : 'none')?>;">
					<td class="label grey">Умови договору, що порушені:</td>
					<td>
						<select name="compromise_violation[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true, $data['accident_statuses_id'] == ACCIDENT_STATUSES_APPROVAL)?>>
							<?
								foreach($data['compromise_violation_list'] as $compromise_violation) {
									echo '<option value="' . $compromise_violation['value'] . '" ' . (($data['compromise_violation']&intval($compromise_violation['value'])) ? 'selected' : '') . '>' . $compromise_violation['title'] . '</option>';
								}
							?>
						</select>
						<input type="hidden" name="compromise_violation_hidden" value="<?=intval($data['compromise_violation'])?>" />
					</td>
					<td class="label grey">Дата прийняття компромісного рішення:</td>
					<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('compromise_date') ], $data[ 'compromise_date_year' ], $data[ 'compromise_date_month' ], $data[ 'compromise_date_day' ], 'compromise_date', $this->getReadonly(true))?></td>
					<td class="label grey"><?=$this->getMark()?>Коментарій:</td>
					<td width="640" colspan="3"><textarea name="compromise_comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['compromise_comment']?></textarea></td>
				</tr>
                <tr class="compromiseBlockFailed" style="display:<?=(($data['compromise'] == 1 && $data['accident_statuses_id'] == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT) ? 'block' : 'none')?>;">
                    <td class="label grey">
                        Рішення компромісного комітету - відмова: <input type="checkbox" name="compromise_failed" value="1" />
                    </td>
                </tr>
            </table>
			<table cellpadding="0" cellspacing="5">
            <tr>
                <td class="label grey" style="width: 120px;"><?=$this->getMark()?>Дата та час настання:</td>
                <td style="width: 170px;"><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('datetime_average') ], $data[ 'datetime_average_year' ], $data[ 'datetime_average_month' ], $data[ 'datetime_average_day' ], $data[ 'datetime_average_hour' ], $data[ 'datetime_average_minute' ], 'datetime_average', $this->getReadonly(true))?></td>
                <td class="label grey" style="width: 50px;"><?=$this->getMark()?>Адреса:</td>
                <td style="width: 355px;"><input type="text" name="address_average" value="<?=$data['address_average']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
            </tr>
			<tr>
				<td class="label grey"><?=$this->getMark()?>Обставини:</td>
				<td width="640" colspan="3"><textarea name="description_average" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['description_average']?></textarea></td>
			</tr>
			</table>

			<div class="section">Повідомлено:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_average') ], $data['mvs_average'], $data['languageCode'], $this->getReadonly(true) . ' onChange="showHideMVSBlock()"', null, $data)?></td>
				<td>
					<table id="mvsYes" cellpadding="0" cellspacing="5" style="display: <?=($data['mvs_average'] > 0) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><?=$this->getMark()?>а саме:</td>
						<td id="dai_average" style="display: <?=($data['mvs_average'] == 1) ? 'block' : 'none'?>"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ], $data['mvs_id_average'], $data['languageCode'], 'style="width: 390px;" ' . $this->getReadonly(true), null, $data)?></td>
						<td id="rugu_average" style="display: <?=($data['mvs_average'] > 1) ? 'block' : 'none'?>"><input type="text" id="mvs_title_average" name="mvs_title_average" value="<?=($data['mvs_average'] > 1) ? $data['mvs_title_average'] : ''?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey"><?=$this->getMark()?>Дата:</td>
						<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ], $data[ 'mvs_date_average_year' ], $data[ 'mvs_date_average_month' ], $data[ 'mvs_date_average_day' ], 'mvs_date_average', $this->getReadonly(true))?></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

			<div class="section">Випадок:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td>Страховий, з виплатою:</td>
				<td><input type="radio" name="insurance" value="1"  <?=($data['insurance'] == 1) ? 'checked' : ''?> onclick="showHideInsuranceBlock()" <?=$this->getReadonly(true)?> /></td>
				<td>Страховий, без виплати:</td>
				<td><input type="radio" name="insurance" value="2"  <?=($data['insurance'] == 2) ? 'checked' : ''?> onclick="showHideInsuranceBlock()" <?=$this->getReadonly(true)?> /></td>
				<td>Не страховий:</td>
				<td><input type="radio" name="insurance" value="3"  <?=($data['insurance'] == 3) ? 'checked' : ''?> onclick="showHideInsuranceBlock()" <?=$this->getReadonly(true)?> /></td>
			</tr>
			</table>

			<div id="insurance1" style="display: <?=($data['insurance'] == 1) ? 'block' : 'none'?>">

				<div class="section">Параметри:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey bold"><?=$this->getMark()?>Виплата:</td>
					<td><input type="radio" name="payments_id" value="1" <?=($data['payments_id'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
					<td>СТО</td>
					<? if ($data['financial_institutions_id']) { ?><td><input type="radio" name="payments_id" value="2" <?=($data['payments_id'] == 2) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td><td>Банк</td><? } ?>
					<td><input type="radio" name="payments_id" value="3" <?=($data['payments_id'] == 3) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td><td>Вигодонабувач</td>
				</tr>
				</table>

				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey bold"><?=$this->getMark()?>Кримінальна справа:</td>
					<td><input type="radio" name="criminal" value="0" <?=(intval($data['criminal']) == 0) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
					<td>не порушена</td>
					<td><input type="radio" name="criminal" value="1" <?=(intval($data['criminal']) == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
					<td>порушена</td>
					<td><input type="radio" name="criminal" value="2" <?=(intval($data['criminal']) == 2) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
					<td>призупинена</td>
					<td class="label grey bold">Регрес:</td>
					<td><input type="checkbox" name="regres" value="1" <?=(intval($data['regres'])) ? 'checked' : ''?> onclick="setRegres()" <?=$this->getReadonly(true)?> /></td>
				</tr>
				</table>

                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey bold"><?=$this->getMark()?>Збиток для банку:</td>
                        <td>Орієнтовний</td>
                        <td><input type="radio" name="amount_rough_type" value="1"  <?=($data['amount_rough_type'] == 1) ? 'checked' : ''?> onclick="setAmountRoughVisibility()" <?=$this->getReadonly(true)?> /></td>
                        <td>Фактичний</td>
                        <td><input type="radio" name="amount_rough_type" value="2"  <?=($data['amount_rough_type'] == 2) ? 'checked' : ''?> onclick="setAmountRoughVisibility()" <?=$this->getReadonly(true)?> /></td>
                        <td>
                            <div id="amount_rough_block" style="display: <?=($data['amount_rough_type'] == 2) ? 'block' : 'none'?>;">
                                <table cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td><?=$this->getMark()?>Орієнтовний збиток для банку, грн.:</td>
                                        <td><input type="text" name="financial_institutions_amount_rough" value="<?=($data['financial_institutions_amount_rough'] > 0) ? $data['financial_institutions_amount_rough'] : ''?>" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly()?> /></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>

				<div id="participant" style="display: <?=($data['regres'] == '1') ? 'block' : 'none'?>">

					<div class="section">Дані про перевізника вантажу:</div>
					<table cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey">Марка, модель:</td>
						<td><input type="text" name="carrier_brand" value="<?=$data['carrier_brand']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">Державний знак:</td>
						<td><input type="text" name="carrier_sign" value="<?=$data['carrier_sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">Перевізник:</td>
						<td><input type="text" name="carrier" value="<?=$data['carrier']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table>

					<div style="border-bottom: 1px solid rgb(68, 83, 175); font-weight: bold; padding: 5px 0pt 0pt 5px;">Водій:</div>
					<table cellpadding="5" cellspacing="0">
					<tr>
						<td class="label grey">Прізвище:</td>
						<td><input type="text" name="carrier_driver_lastname" value="<?=$data['carrier_driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">Ім'я:</td>
						<td><input type="text" name="carrier_driver_firstname" value="<?=$data['carrier_driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">По батькові:</td>
						<td><input name="carrier_driver_patronymicname" value="<?=$data['carrier_driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
					</tr>
					</table>

					<div id="participant_owner">
						<div style="border-bottom: 1px solid rgb(68, 83, 175); font-weight: bold; padding: 5px 0pt 0pt 5px;">Власник:</div>
						<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey">Власник ТЗ:</td>
							<td><input type="text" id="carrier_owner" name="carrier_owner" value="<?=$data['carrier_owner']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="label grey">Адреса:</td>
							<td><input type="text" id="carrier_owner_address" name="carrier_owner_address" value="<?=$data['carrier_owner_address']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false)?> /></td>
							<td class="label grey">Телефон:</td>
							<td colspan="3"><input type="text" id="carrier_owner_phone" name="carrier_owner_phone" value="<?=$data['carrier_owner_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
						</tr>
						</table>
					</div>
				</div>
			</div>
			<table id="insurance23" cellpadding="5" cellspacing="0" style="display: <?=($data['insurance'] != 1) ? 'block' : 'none'?>">
			<tr>
				<td><?=$this->getMark()?>Згідно:<td>
				<td width="525"><input type="text" name="reason" value="<?=$data['reason']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
				<td>
					<table cellpadding="0" cellspacing="5">
						<tr>
							<td class="label grey">Критерії відмови в виплаті:</td>
							<td class="notPaymentBlock2" style="display:<?=(($data['insurance'] == 2) ? 'block' : 'none')?>;">
								<select name="reason_not_payment_insurance_2[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
									<?
										foreach($data['reason_not_payment_insurance_2'] as $reason_not_payment_insurance_2) {
											echo '<option value="' . $reason_not_payment_insurance_2['value'] . '" ' . (($data['reason_not_payment']&intval($reason_not_payment_insurance_2['value'])) ? 'selected' : '') . '>' . $reason_not_payment_insurance_2['title'] . '</option>';
										}
									?>
								</select>
							</td>
							<td class="notPaymentBlock3" style="display:<?=(($data['insurance'] == 3) ? 'block' : 'none')?>;">
								<select name="reason_not_payment_insurance_3[]" multiple="multiple" size="3" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
									<?
										foreach($data['reason_not_payment_insurance_3'] as $reason_not_payment_insurance_3) {
											echo '<option value="' . $reason_not_payment_insurance_3['value'] . '" ' . (($data['reason_not_payment']&intval($reason_not_payment_insurance_3['value'])) ? 'selected' : '') . '>' . $reason_not_payment_insurance_3['title'] . '</option>';
										}
									?>
								</select>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
</form>
<script type="text/javascript">
	showHideInsuranceBlock();
	initFocus(document.<?=$this->objectTitle?>);
</script>