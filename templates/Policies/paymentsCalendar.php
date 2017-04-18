<script type="text/javascript">
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

	function calculateamount_parent() {
        $.ajax({
            type:	    'POST',
            url:	    'index.php',
			async:		false,
            dataType:   'html',
            data:	    'do=Policies|getamount_parentInWindow' +
                        '&id=<?=$data['parent_id']?>' +
                        '&end_datetime=' + $('#begin_datetime').val().substring(6, 10) + '-' +  $('#begin_datetime').val().substring(3, 5) + '-' +  $('#begin_datetime').val().substring(0, 2),
			success:	function(result) {
							$('input[name=amount_parent]').val(result);
						}
        });
	}

	function setAmount() {
		price	= parseFloat($('input[name=price]').val());
		amount	= parseFloat($('input[name=amount]').val());

		$('#totalBlock').html(getRateFormat(amount / price * 100) + '%, ' + getMoneyFormat(amount));

		calculateamount_parent();

		$('#amount_parentBlock').html(getMoneyFormat($('input[name=amount_parent]').val()));

		$('#amountBlock').html(getMoneyFormat(amount - $('input[name=amount_parent]').val()));
		fillCalendar();
	}
	
	function getTotalAmount() {
		price	= parseFloat($('input[name=price]').val());
		amount	= parseFloat($('input[name=amount]').val());
		return parseFloat(amount - $('input[name=amount_parent]').val());
	}

	function getDateVal(val) {
		var d = explode('.', val);

		if (d.length == 3) {
			var res = '';
			if (d[0].length<2) {
				if (d[0].length==0) res='01'+'.';
				else res='0'+d[0]+'.';
			} else res=d[0]+'.';

			if (d[1].length<2) {
				if (d[1].length==0) res+='01'+'.';
				else res+='0'+d[1]+'.';
			} else res+=d[1]+'.';

			if (d[2].length<4) {
				if (d[2].length==0 || d[2].length==3 || d[2].length==1) res+='2000';
				else if(d[2].length==2) res+='19'+d[2];
			} else res+=d[2];

			this.value=res;
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

	function fillCalendar() {
		bdat1=bdat=getDateVal($("#begin_datetime").val());
		edat=getDateVal($("#end_datetime").val());
		dt = (edat.getTime() - bdat.getTime()) / (1000*60*60*24)+1;

		amount = getTotalAmount();

		lastcalendarId=0;
        prevcalendarId=0;
		firstitem=true;

		$(".calendarDate").each(function (i, element) {

			if ($(this).val().length>0) {
				
				calendarId=$(this).attr('calendarId');
				edat1=getDateVal($(this).val());
				dt1 = (edat1.getTime() - bdat1.getTime()) / (1000*60*60*24)+(firstitem ? 1 : 0);
				bdat1=edat1;
				v = Math.round(dt1*amount/dt*100)/100;
				$('#payments'+calendarId+'amount').val(v);

                if (parseInt(getElementValue('options_first_payment'))>0 && prevcalendarId!=0)
                    $('#payments'+prevcalendarId+'amount').val(v);

				lastcalendarId=calendarId;
				firstitem=false;
                prevcalendarId=$(this).attr('calendarId');
			}
		});

		total=0;
		$(".calendarDate").each(function (i,element) {
			if ($(this).val().length>0) {
				calendarId=$(this).attr('calendarId');
				if (calendarId==lastcalendarId) {
					$('#payments'+calendarId+'amount').val(Math.round((amount-total)*100)/100);
				}
				total=total+parseFloat($('#payments'+calendarId+'amount').val());
			}
		});
		setAmountPayments();
	}

	function setItemAmount(i) {
		var amount = number_format((parseFloat($('#items' + i + 'price').val()) * parseFloat($('#items' + i + 'rate').val()) / 100), 2, '.', '');

		if (isNaN(amount)) {
			amount = 0;
		}

		$('#items' + i + 'amount').val( amount );

		setAmount();
		setAmountPayments();
	}

    function addPayment() {
        var row	= document.getElementById('payments').insertRow(document.getElementById('payments').rows.length - 1);
        row.style.background = (document.getElementById('payments').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="payments' + num3 + 'date" calendarId="'+num3+'" name="payments[' + num3 + '][date]" maxlength="10" class="fldDatePicker calendarDate" onChange="fillCalendar()" onfocus="this.className=\'fldDatePickerOver calendarDate\'" onblur="this.className=\'fldDatePicker calendarDate\'" />';

		var cell        = row.insertCell(-1);
		cell.innerHTML  = '<input type="text" id="payments' + num3 + 'amount" name="payments[' + num3 + '][amount]" value="" maxlength="12" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="setAmountPayments()" />';

		var cell        = row.insertCell(-1);
        cell.innerHTML  = '<img class="delpayment" src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити платіж" onclick="deletePayment(this)" />';
		curnum=num3;
		num3--;

		initDatePicker();
	}

    function deletePayment(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибраний платіж?')) {
            document.getElementById('payments').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            for(i=0; i<document.getElementById('payments').rows.length; i++) {
                document.getElementById('payments').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
            }
			setAmountPayments();
        }
    }

	function paymentsCount() {
		var i = 0;
		$('.delpayment').each(function() {
			i++;
		});
		return i;
	}	

	function deleteAllPAyments() {
		$('.delpayment').each(function() {
			document.getElementById('payments').deleteRow(this.parentNode.parentNode.sectionRowIndex);
		});

		for(i=0; i<document.getElementById('payments').rows.length; i++) {
			document.getElementById('payments').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
        }

		setAmountPayments();
	}

    function checkFields() {
       if ($('#policy_statuses_id option:selected').val() == <?=POLICY_STATUSES_GENERATED?>) {
            if (!window.confirm('Після переходу в статус "Сформован" редагування полісу стане неможливим. Продовжити?'))
                return false;
        }

        return true;
    }

	function setAmountPayments() {
		var amount	= parseFloat($('input[name=amount]').val());

		if (isNaN(amount)) {
			amount = 0;
		}

		$('#amountPaymentsBlock').html(getMoneyFormat(amount));

		if ($('#amountBlock').html() == $('#amountPaymentsBlock').html()) {
			$('#amountPaymentsBlock').addClass('bold');
		} else {
			$('#amountPaymentsBlock').removeClass('bold');
		}
	}

	function fillCalendarAuto(dt, pcount) {
		var bdate;

		dcount= Math.round(dt/pcount);

		for (i=1; i<=pcount; i++) {
			bdate = new Date(beginYear, beginMonth - 1, beginDay);

            if (parseInt(getElementValue('options_first_payment'))==0)
			    endDate = bdate.addDays(dcount*i-(i==pcount? 0: 1));
            else
                endDate = bdate.addDays(dcount*(i-1));
			
			addPayment();

			if (endDate!=null) {
				endDay		= endDate.getDate();
				endMonth	= endDate.getMonth() + 1;
				endYear		= endDate.getFullYear();

				if (endDay < 10) endDay = '0' + endDay;
				if (endMonth < 10) endMonth = '0' + endMonth;

				if (i==pcount && parseInt(getElementValue('options_first_payment'))==0)
					$('input[calendarid='+curnum+']').val($('#end_datetime').val());
				else	
					$('input[calendarid='+curnum+']').val(endDay + '.' + endMonth + '.' + endYear);
            }
		}

		fillCalendar();
	}
	
	function divPayments(pcount) {

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

			endDay	= end_datetime_day.value;
            endMonth	= end_datetime_month.value;
            endYear	= end_datetime_year.value;

            if (endDay.substring(0,1)=='0') {
				endDay = endDay.substring(1, 2);
			}

            if (endMonth.substring(0,1)=='0') {
				endMonth = endMonth.substring(1, 2);
			}

            endDay	= parseInt(endDay);
            endMonth	= parseInt(endMonth);
            endYear	= parseInt(endYear);
		}	

		if (beginDay>0 && beginMonth>0 && beginYear>0 && endDay>0 && endMonth>0 && endYear>0) {
			beginDate	= new Date(beginYear, beginMonth - 1, beginDay);
			endDate	= new Date(endYear, endMonth - 1, endDay);
			dt = (endDate.getTime() - beginDate.getTime()) / (1000*60*60*24);

			if (paymentsCount()>0) {
				if (confirm('Поточний календар буде видалено. Продовжити?')) {
					deleteAllPAyments();
					fillCalendarAuto(dt,pcount);
				}	
			} else {
				fillCalendarAuto(dt,pcount);
			}
		}
	}
</script>
<? $Log->showSystem();?>
<?/*_dump($data['insurer_identification_code']);*/?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
	<input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
	<input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="types_id" value="<?=$data['types_id']?>" />
	<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
	<input type="hidden" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" />
	<input type="hidden" name="product_types_id" id ="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="parent_id" value="<?=$data['parent_id']?>" />
	<input type="hidden" name="amount_parent" id="amount_parent" value="<?=$data['amount_parent']?>" />
	<input type="hidden" name="rate" id="rate" value="<?=$data['rate']?>" />
	<input type="hidden" name="amount" id="amount" value="<?=$data['amount']?>" />
	<input type="hidden" name="price" id="price" value="<?=$data['price']?>" />
	<input type="hidden" name="states_id" value="<?=intval($data['states_id'])?>" />
	<input type="hidden" name="policy_statuses_id_old" value="<?=($data['policy_statuses_id_old']) ? $data['policy_statuses_id_old'] : $data['policy_statuses_id']?>" />

	<div class="section">Параметри:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<? if (!$data['parent_id'] || $data['states_id'] ==  POLICY_STATUSES_CONTINUED) { ?>
		<td class="label grey">Номер полісу:</td>
		<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=($action == 'insert' || $action == 'update') ? '' : 'readonly style="color: #666666; background-color: #f5f5f5;"'?> />
		<? } else {
		?>
			<input type="hidden" name="number" value="<?=$data['number']?>">						
		<? } ?>
		<td class="label grey">Дата <?=($data['parent_id'] &&  $data['states_id'] !=  POLICY_STATUSES_CONTINUED) ? 'адендуму' : 'полісу'?>:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', ($action == 'insert' || $action == 'update') ? '' : 'readonly123 style="color: #666666; background-color: #f5f5f5;"')?></td>
		<td class="label grey"><?=$this->getMark(false)?>Дата початку дії полісу:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'id="begin_datetime" onchange="setAmount()" ' . $this->getReadonly(true) .($data['insurer_person_types_id']==1 ? 'readonly style="color: #666666; background-color: #f5f5f5;"':''))?></td>
		<td class="label grey"><?=$this->getMark(false)?>Дата закінчення дії полісу:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', ' onchange="setAmount()" '.($this->subMode == 'calculate' ? 'style="color: #aca899; background-color: #f5f5f5;" disabled ':' '). $this->getReadonly(true).($data['insurer_person_types_id']==1 ? 'readonly style="color: #666666; background-color: #f5f5f5;"':''))?></td>
	</tr>
	</table>

	<? if ($this->mode != 'view' && ($data['insurer_person_types_id']!=1 || $data['multi_year']>0)) { ?>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="bold">Тариф:</td>
		<td id="totalBlock"><?=getRateFormat($data['rate'])?> %, <?=getMoneyFormat($data['amount'] + $data['amount_parent'])?></td>
		<td class="bold">Залишок від сплаченної страхової премії:</td>
		<td id="amount_parentBlock"><?=getMoneyFormat($data['amount_parent'])?></td>
		<td class="bold">До сплати:</td>
		<td id="amountBlock"><?=getMoneyFormat($data['amount'])?></td>
	</tr>
	<? if ($data['insurer_person_types_id'] != 1) {?>
	<tr>
		<td colspan="10">Перший платiж внести до початку дiї страхового покриття <input type="checkbox" id="options_first_payment" name="options_first_payment" value="1" <?=($data['options_first_payment']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
	</tr>
	<? } ?>
	</table>

	<div class="section">Cтроки сплати страхового платежу:</div>
	<? if ($this->mode != 'view') { ?>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td>
			<b>Розбити на:</b>
			<a href="javascript:divPayments(1)">1 платіж</a> |
			<a href="javascript:divPayments(2)">2 платежа</a> |
			<a href="javascript:divPayments(4)">4 платежа</a> |
			<a href="javascript:divPayments(12)">12 платежів</a>
		</td>
	</tr>
	</table>
	<?
		}
	}
	?>

	<div class="section">Термін сплати страхового платежу:</div>
	<table id="payments" cellpadding="5" cellspacing="0">
	<tr class="columns">
		<td width="90">Дата</td>
		<td width="120">Сума, грн.</td>
		<? if ($this->mode != 'view' && ($data['insurer_person_types_id']!=1 || $data['multi_year']>0)) { ?><td><a href="javascript:addPayment()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати платіж" /></a></td><? } ?>
	</tr>
	<?
		$j = 0;
		$amount = 0;
		if (is_array($data['payments'])) {
			foreach ($data['payments'] as $i => $row) {
				$amount += $row['amount'];
	?>
	<tr style="background: <?=($j % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>">
		<td><input type="text" name="payments[<?=$i?>][date]" calendarId="<?=$i?>" value="<?=$row['date']?>" maxlength="10" class="fldDatePicker calendarDate" onChange="fillCalendar()" onfocus="this.className='fldDatePickerOver calendarDate'" onblur="this.className='fldDatePicker calendarDate'" <?=$this->getReadonly(false)?> <?=($data['insurer_person_types_id']==1 && $data['multi_year']==0) ?'readonly':''?>/></td>
		<td><input type="text" name="payments[<?=$i?>][amount]" id="payments<?=$i?>amount" value="<?=$row['amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" onchange="setAmountPayments();" <?=$this->getReadonly(false)?> <?=($data['insurer_person_types_id']==1 && $data['multi_year']==0) ?'readonly':''?> /></td>
		<? if ($this->mode != 'view'  && ($data['insurer_person_types_id']!=1 || $data['multi_year']>0)) { ?><td><img class="delpayment" src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити платіж"  onclick="deletePayment(this)" /></td><? } ?>
	</tr>
	<?
				$j++;
			}
		}
	?>
	<tr>
		<td align="right" class="bold">ВСЬОГО:</td>
		<td id="amountPaymentsBlock" <?=($data['amount'] == $amount) ? 'class="bold"': ''?>><?=getMoneyFormat($amount)?></td>
		<? if ($this->mode != 'view') { ?><td>&nbsp;</td><? } ?>
	</tr>
	</table>

	<div class="section">Додатково:</div>
	<table width="100%" cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Статус:</td>
		<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], 'onchange="setRequiredFields()" ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
	</tr>
	<tr>
		<td class="label grey">Коментар:</td>
		<td width="100%"><textarea name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
	</tr>
	</table>
</form>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>