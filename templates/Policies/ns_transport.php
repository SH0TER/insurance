<?
if ($_POST['ECmode']) {
    $data['ECmode'] = $_POST['ECmode'];
}
?>
<script type="text/javascript">
 function setInsurer(obj) {
        if (obj.checked) {
            document.<?=$this->objectTitle?>.insured_lastname.value             = getElementValue('insurer_lastname');
            document.<?=$this->objectTitle?>.insured_firstname.value                = getElementValue('insurer_firstname');
            document.<?=$this->objectTitle?>.insured_patronymicname.value       = getElementValue('insurer_patronymicname');

            document.<?=$this->objectTitle?>.insured_dateofbirth.value          = document.<?=$this->objectTitle?>.insurer_dateofbirth.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_day.value      = document.<?=$this->objectTitle?>.insurer_dateofbirth_day.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_month.value        = document.<?=$this->objectTitle?>.insurer_dateofbirth_month.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_year.value     = document.<?=$this->objectTitle?>.insurer_dateofbirth_year.value;

            document.<?=$this->objectTitle?>.insured_passport_series.value      = getElementValue('insurer_passport_series');
            document.<?=$this->objectTitle?>.insured_passport_number.value      = getElementValue('insurer_passport_number');
            document.<?=$this->objectTitle?>.insured_passport_place.value           = getElementValue('insurer_passport_place');

            document.<?=$this->objectTitle?>.insured_passport_date.value            = document.<?=$this->objectTitle?>.insurer_passport_date.value;
            document.<?=$this->objectTitle?>.insured_passport_date_day.value        = document.<?=$this->objectTitle?>.insurer_passport_date_day.value;
            document.<?=$this->objectTitle?>.insured_passport_date_month.value      = document.<?=$this->objectTitle?>.insurer_passport_date_month.value;
            document.<?=$this->objectTitle?>.insured_passport_date_year.value       = document.<?=$this->objectTitle?>.insurer_passport_date_year.value;

            document.<?=$this->objectTitle?>.insured_dateofbirth.value          = document.<?=$this->objectTitle?>.insurer_dateofbirth.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_day.value      = document.<?=$this->objectTitle?>.insurer_dateofbirth_day.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_month.value        = document.<?=$this->objectTitle?>.insurer_dateofbirth_month.value;
            document.<?=$this->objectTitle?>.insured_dateofbirth_year.value     = document.<?=$this->objectTitle?>.insurer_dateofbirth_year.value;

            document.<?=$this->objectTitle?>.insured_phone.value                    = getElementValue('insurer_phone');

            //Новый пасспорт
            $('input[name=insurer_id_card]:checked').each(function() {
                $('input[name=insured_id_card][value='+this.value+']').click();
            });
            document.<?=$this->objectTitle?>.insured_newpassport_number.value           = getElementValue('insurer_newpassport_number');
            document.<?=$this->objectTitle?>.insured_newpassport_place.value            = getElementValue('insurer_newpassport_place');
            document.<?=$this->objectTitle?>.insured_newpassport_reestr.value           = getElementValue('insurer_newpassport_reestr');

            document.<?=$this->objectTitle?>.insured_newpassport_date.value             = getElementValue('insurer_newpassport_date');
            document.<?=$this->objectTitle?>.insured_newpassport_date_day.value         = getElementValue('insurer_newpassport_date_day');
            document.<?=$this->objectTitle?>.insured_newpassport_date_month.value       = getElementValue('insurer_newpassport_date_month');
            document.<?=$this->objectTitle?>.insured_newpassport_date_year.value        = getElementValue('insurer_newpassport_date_year');

            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd.value          = getElementValue('insurer_newpassport_dateEnd');
            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd_day.value      = getElementValue('insurer_newpassport_dateEnd_day');
            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd_month.value    = getElementValue('insurer_newpassport_dateEnd_month');
            document.<?=$this->objectTitle?>.insured_newpassport_dateEnd_year.value     = getElementValue('insurer_newpassport_dateEnd_year');
            //
                        
            document.<?=$this->objectTitle?>.insured_area.value                 = getElementValue('insurer_area');
            
            
            document.<?=$this->objectTitle?>.insured_city.value                  = getElementValue('insurer_city');
            document.<?=$this->objectTitle?>.insured_street.value                = getElementValue('insurer_street');
            document.<?=$this->objectTitle?>.insured_house.value                 = getElementValue('insurer_house');
            document.<?=$this->objectTitle?>.insured_flat.value                  = getElementValue('insurer_flat');
            document.<?=$this->objectTitle?>.insured_identification_code.value    = getElementValue('insurer_identification_code');

            setSelectValues('insurer_regions_id', 'insured_regions_id');
            setSelectValues('insurer_street_types_id', 'insured_street_types_id');
            setSelectValues('insurer_person_types_id', 'insured_person_types_id');
            
        }
        
        
    }
    function checkValidRisks(risk_id) {}
    
    function setInsuredIdCard() {
        if($('[name=insured_id_card]:checked').val() == 0) {
            $('#insuredPassport').show();
            $('table#insured_new_passport_table').hide();
        } else {
            $('#insuredPassport').hide();
            $('table#insured_new_passport_table').show();
        }

    }

    function setInsurerIdCard() {
        if($('[name=insurer_id_card]:checked').val() == 0) {
            $('#insurerPassport').show();
            $('table#insurer_new_passport_table').hide();
        } else {
            $('#insurerPassport').hide();
            $('table#insurer_new_passport_table').show();
        }
    }

    function changeServicePerson() {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=Policies|changeServicePersonInWindow' +
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

     
    
     
    
    function setDefault()
    {
        $('.insurer_position').css('display', '');
        $('.insurer_company').css('display', '');
    }
    
    
    //загружаем модели для выбранного бренда
    function setCar() {
        <?if (!ereg('^view', $action)) {?>
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>&brands_id=<?=$data['brands_id']?>&models_id=<?=$data['models_id']?>',
            success:    function (result) {
                setModel();
            }
        })
        <?}?>
    }


    function loadRisks() {

               
                    setDefault();
                 
                changeProduct();
                $.ajax({
                    type:       'POST',
                    url:        'index.php',
                    dataType:   'html',
                    data:       'do=ParametersRisks|getListPolicyInWindow' +
                                '&agencies_id=<?=$data['agencies_id']?>' +
                                '&product_types_id=' + $('input[name=product_types_id]').val() +
                                '&financial_institutions_id=' + $('select[name=financial_institutions_id] option:selected').val() +
                                '&types_id=' + $('input[name=types_id]').val(),
                    success:    function(result) {
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
                async:      false,
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
             $('#rate_label').html('<b>Тариф:</b>' + ' ' + data.rate + '%; <b>Платiж: </b>' + data.amount);
         <?}?>
            $('[name=rate]').val(data.rate);
            //$('#correct_factors').html('<b>Поправочний коефіцієнт:</b>' + ' '  + data.product_factors);
            $('#cart_discount').val(data.cart_discount);
        }
        else {
            $('#cart_discount').val(0);
        <? if (!ereg('view', $action)) {?>
            $('#rate_label').html('<b>Тариф:</b>' + ' '  + data.rate_without_cart_discount + '%; <b>Платiж: </b>' + data.amount_without_cart_discount) ;
         <?}?>  
            $('[name=rate]').val(data.rate_without_cart_discount);
        }
    }

    function changeProduct() {
        //changeDiscount();
        <?if($data['types_id'] == POLICY_TYPES_AGREEMENT) {?>
        setDefault();
        
        if(!$('select[name=discount] option:selected').val())  discount = 0;
        else discount = $('select[name=discount] option:selected').val();
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Products|getRateInWindow' + 
                        '&product_types_id=' + $('input[name=product_types_id]').val() + 
                        '&agencies_id=' + $('input[name=agencies_id]').val() + 
                        '&financial_institutions_id=' + $('select[name=financial_institutions_id] option:selected').val() + 
                        '&price=' + getElementValue('price') + 
                        '&insurance_companies_id=' + getElementValue('insurance_companies_id') + 
                        '&cart_discount=' + $('#cart_discount]:checked').val() + 
                        '&discount=' + discount +
                        '&cart_discount=' + $('#cart_discount]:checked').val() +
                        '&allowed_products_id=' + getElementValue('allowed_products_id') +
                        '&terms_id=' + $('select[name=terms_id] option:selected').val() +
                        '&products_id=' + $('input[name=products_id]').val() +
                        getRisks() +
                        getFactors(),
            success:    setProductValues}
        );
        <?}?>
    }

     
        
    function calculate() {
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

            beginDay    = begin_datetime_day.value;
            beginMonth  = begin_datetime_month.value;
            beginYear   = begin_datetime_year.value;
            if (beginDay.substring(0,1)=='0') {
                beginDay = beginDay.substring(1, 2);

            }

            if (beginMonth.substring(0,1)=='0') {
                beginMonth = beginMonth.substring(1, 2);
            }

            beginDay    = parseInt(beginDay);
            beginMonth  = parseInt(beginMonth);
            beginYear   = parseInt(beginYear);

    <?
    if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {//Для переукладених дата оконечная идет из полиса оригинала
    ?>
        $.ajax({
                    type:       'POST',
                    url:        'index.php',
                    dataType:   'json',
                    data:       'do=Policies|getAmountUsedInWindow' +
                                '&product_types_id=' + getElementValue('product_types_id') +
                                '&id=<?=$data['parent_id']?>' +
                                '&date=' + beginYear + '-' + beginMonth + '-' + beginDay,
                    success:    function(result) {
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

                beginDate   = new Date(beginYear, beginMonth - 1, beginDay);
                endDate     = null;
                addmonth    = 0;
                adddays     = -1;

                 switch ($('#terms_id').val()) {

                    case '92'://1 мес.
                        addmonth = 1;
                        adddays     = 0;
                        break;
                    case '93'://2 мес.
                        addmonth = 2;
                        adddays     = 0;
                        break;
                    case '94'://3 мес.
                        addmonth = 3;
                        adddays     = 6;
                        break;
                    case '95'://4 мес.
                        addmonth = 4;
                        adddays     = 0;
                        break;
                    case '96'://5 мес.
                        addmonth = 5;
                        adddays     = 0;
                        break;
                    case '97'://6 мес.
                        addmonth = 6;
                        adddays     = 0;
                        break;
                    case '98'://7 мес.
                        addmonth = 7;
                        break;
                    case '99'://8 мес.
                        addmonth = 8;
                        break;
                    case '100'://9 мес.
                        addmonth = 9;
                        break;
                    case '101'://10 мес.
                        addmonth = 10;
                        break;
                    case '102'://11 мес.
                        addmonth = 11;
                        break;
                    case '103'://1 год.
                        addmonth = 12;
                        break;
                                    
                }

                if (beginMonth==2 && beginDay==29) adddays = 0;

                if ($("#financial_institutions_id option:selected").val() == 11) {
                    endDate = beginDate.addMonths(addmonth).addDays(adddays + 1);
                } else {
                    endDate = beginDate.addMonths(addmonth).addDays(adddays);

                }

                if (endDate!=null) {
                    endDay      = endDate.getDate();
                    endMonth    = endDate.getMonth() + 1;
                    endYear     = endDate.getFullYear();

                    if (endDay < 10) endDay = '0' + endDay;
                    if (endMonth < 10) endMonth = '0' + endMonth;

                    end_datetime_day.value      = endDay;
                    end_datetime_month.value    = endMonth;
                    end_datetime_year.value     = endYear;
                    end_datetime.value          = endDay + '.' + endMonth + '.' + endYear;
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
     

    function getAllRisks() {
        var risks =
                '';
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

        <?if (!ereg('^view', $action)) {?>setCar();<?}?>
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
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=Policies|changeSignInWindow' +
                        '&product_types_id=' + getElementValue('product_types_id') +
                        '&policies_id=<?=$data['id']?>' +
                        '&sign_agents_id=' + getElementValue('sign_agents_id'),
            success: function(result) {
                alert('Менеджера було змiнено.');
            }
        });
    }
    
     
     

</script>

<? $Log->showSystem();?>
<?
if  ($action=='insert') {
    $Clients = new Clients($data);
    $Clients->getSearchForm($data);
}
?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data"  >
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
            <!--<div align="right"><?if ($this->mode != 'view' && $this->permissions['quote'] && $data['ECmode']!=1 && $data['policy_statuses_id'] == POLICY_STATUSES_CREATED) {?><a href="javascript: changeMode()" style="color:#ff0066"><?=($this->subMode == 'calculate') ? 'Перейти у режим "Котирування"' : 'Вийти з режиму "Котирування"'?></a><? } ?></div>-->
            
            <div id="agreementParams">
            
                <table cellpadding="5" cellspacing="0">
                <tr>
                    <input type="hidden" id="insurance_companies_id" name="insurance_companies_id" value="4" />
                    <input type="hidden" id="financial_institutions_id" name="financial_institutions_id" value="<?=$data['financial_institutions_id']?>" />
            
                    <!--<td class="label grey"> Банк:</td>
                    <td><?
                    //$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ], $data['financial_institutions_id'], $data['languageCode'], '  ' . $this->getReadonly(true), null, $data)
                    ?></td>-->
                </tr>
                </table>
            

            
            <div class="section">Ризики:</div>
            <div id="risksDiv"><?=ParametersRisks::getListPolicy($data['product_types_id'], $data, $additional, $layout='horisontal')?></div>
            <div class="section">Дані щодо автомобіля:</div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Автомобіль:</td>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('car_types_id') ], $data[ 'car_types_id' ], $data['languageCode'], $this->getReadonly(true) . ' style="width: 140px;" onchange="changeProduct();changeCarType();"', null, $data)?></td>
                    <td class="label grey"><?=$this->getMark()?>Марка:</td>
                    <td><select id="brands_id" name="brands_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" onchange="changeBrand(); calculate();" <?=$this->getReadonly(true)?>><?if (ereg('^view', $action)) {echo '<option value="'.$data['brands_id'].'">'.$data['brand'].'</option>';}?></select></td>
                    <td class="label grey"><?=$this->getMark()?>Модель:</td>
                    <td><select id="models_id" name="models_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" onchange="" <?=$this->getReadonly(true)?>><?if (ereg('^view', $action)) {echo '<option value="'.$data['models_id'].'">'.$data['model'].'</option>';}?></select></td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>№ шасі (кузов, рама):</td>
                    <td>
                        <input type="text" name="shassi" id="shassi" value="<?=$data[ 'shassi' ]?>" onchange=""   maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly(false, $data['ECmode'])?> />
                    </td>
                    <td class="label grey"><?=$this->getMark()?>Державний знак (реєстраційний №):</td>
                    <td>
                        <input id="sign" type="text" name="sign" value="<?=$data[ 'sign' ]?>" maxlength="15" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" autocomplete="off" />
                    </td>
                </tr>
            </table>
            <div class="section additional_info">Додаткові відомості:</div>
                <table cellpadding="5" cellspacing="0" class="additional_info">
                    <tr>
                       
                        <td class="label grey"><?=$this->getMark()?>Вік Страхувальника/Застрахованої особи</td>
                        <td>
                            <? $data['factor_types_id'] = PRODUCT_CORRECTION_FACTORS_TYPES_AGES;
                               echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'onchange="calculate()" '. $this->getReadonly(true), null, $data);
                            ?>
                        </td>
                        

                    </tr>
                </table>
                 
                
            <div class="section"></div>
             
            <table cellspacing="0" cellpadding="5">
                <tr>
                <td class="label grey">Cтрахова сума, грн.:</td>
                <td align="left">
                 
                    <span id="priceblock"><input type="text" id="price" name="price" value="<?=$data['price']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" onchange="calculate()" <?=$this->getReadonly(true)?>/></span>
                    <br><span style="color:red">Вказати страхову суму: 50 000, 100 000, 200 000 грн</span>
                    </td>
                    <td>Термін страхування:</td>
                    <td><?
                        
                        //убераем тип, для переопределенной функции buildSelect
                        unset($data['factor_types_id']);
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ], $data['terms_id' ], $data['languageCode'], 'onchange="calculate(); setEnd();" ' . $this->getReadonly(true).($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW ? ' disabled':''), null, $data, $this->isEqual('terms_id'))?></td>
                    <td class="label grey"  >Знижка агента, %:</td>
                    <td  >
                        <select id="discount" name="discount" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="calculate();" <?=$this->getReadonly(true)?>>
                            <option value="0.00">0.00
                            <?
                                for ($j=1; $j <= $data['discount']; $j++) {
                                    echo '<option value="' . $j . '.00" ' . ((intval($j) == intval($data['discount'])) ? ' selected' : '') . '>' . $j . '.00';
                                }
                        ?>
                        </select>
                    </td>
                    <!--<td class="label grey"  >Чи є у вас картка CarMan@CarWoman:</td>
                    
                    <td  ><input type="checkbox" name="cart_discount" id="cart_discount" value="<?=$data['cart_discount']?>" <? if ($data['cart_discount'] > 0) echo 'checked';?> onclick="calculate()" <?=$this->getReadonly(true)?> /></td>
                    <td class="label grey" title="cart_discount" style="display: <?=$hide_fields ? 'none' : ''?>">Номер:</td>
                    <td    title="cart_discount"><input type="text" name="card_car_man_woman" value="<?=$data['card_car_man_woman']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" onchange="calculate(false)" <?=$this->getReadonly(false)?> /></td>-->
                    <?if($data['types_id'] == POLICY_TYPES_AGREEMENT) {?>
                    <td id="rate_label" class="label grey" align="left"><b>Тариф:</b> <?=getRateFormat($data['rate'])?>%; <b>Платiж: </b><?=getMoneyFormat($data['amount'])?></td>
                    <?}?>
                </tr>
            </table>
            
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <td id="correct_factors" class="label grey" align="left"></td>
                </tr>
            </table>
            
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td width="25%">Історія збитків (зазначте, чи мали місце за останні 3 роки нещасні випадки на транспорті на Вашому автотранспортному засобі?):</td>
                <td width="25%"><textarea id="info1" name="info1" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['info1']?></textarea></td>
                <td width="25%">Наявність інших чинних договорів страхування щодо предмета договору:</td>
                <td width="25%"><textarea id="info2" name="info2" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['info2']?></textarea></td>
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
            <table cellpadding="5" cellspacing="0" id="insurerPassport" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?>>
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
            
            <div class="section">
                    <table id="ownerBlock" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="section" style="border: none;">Застрахований:</td>
                        <td class="label grey">страхувальник є застрахованим:</td>
                        <td class=" testdriveproduct">&nbsp;</td>
                        <td class=" testdriveproduct"><input type="checkbox" id="owner" value="1" onclick="setInsurer(this)" <?=$this->getReadonly(true)?> /></td>
                    </tr>
                    </table>
            </div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
                    <td><input type="text" name="insured_lastname" value="<?=$data['insured_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
                    <td><input type="text" name="insured_firstname" value="<?=$data['insured_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>По батькові:</td>
                    <td><input type="text" name="insured_patronymicname" value="<?=$data['insured_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>Дата народження:</td>
                    <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_dateofbirth') ], $data['insured_dateofbirth_year' ], $data['insured_dateofbirth_month' ], $data['insured_dateofbirth_day' ], 'insured_dateofbirth', $this->getReadonly(true))?></td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" id="insured_id_card_table">
                <tr>
                    <td class="label grey">ID-картка:</td>
                    <td class="label grey"><input type="radio" onclick="setInsuredIdCard()" name="insured_id_card" <?=$this->getReadonly(true)?> value="1" <?= (intval($data['insured_id_card'])?'checked':'') ?> /></td>
                    <td>Так</td>
                    <td class="label grey"><input type="radio" onclick="setInsuredIdCard()" name="insured_id_card" <?=$this->getReadonly(true)?> value="0" <?= (intval($data['insured_id_card'])?'':'checked') ?> /></td>
                    <td>Ні</td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" id="insuredPassport" <?= (intval($data['insured_id_card']) ? 'style="display:none"' : '') ?>>
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Паспорт, серія і номер:</td>
                    <td>
                        <input type="text" name="insured_passport_series" value="<?=$data['insured_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> />
                        <input type="text" name="insured_passport_number" value="<?=$data['insured_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                    </td>
                    <td class="label grey"><?=$this->getMark()?>Паспорт. Ким і де виданий:</td>
                    <td><input type="text" name="insured_passport_place" value="<?=$data['insured_passport_place']?>" maxlength="100" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>Паспорт. Дата видачі:</td>
                    <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_passport_date') ], $data['insured_passport_date_year' ], $data['insured_passport_date_month' ], $data['insured_passport_date_day' ], 'insured_passport_date', $this->getReadonly(true))?></td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" <?= (intval($data['insured_id_card'])?'':'style="display:none"') ?> id="insured_new_passport_table">
                <tr>
                    <td class="label grey">Паспорт. Номер:</td>
                    <td><input type="text" name="insured_newpassport_number" value="<?=$data['insured_newpassport_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                    <td>Паспорт. Ким і де виданий:</td>
                    <td><input type="text" name="insured_newpassport_place" value="<?=$data['insured_newpassport_place']?>" maxlength="15" class="fldInteger number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                    <td>Паспорт. Дата видачі:</td>
                    <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_date') ], $data['insured_newpassport_date_year' ], $data['insured_newpassport_date_month' ], $data['insured_newpassport_date_day' ], 'insured_newpassport_date', $this->getReadonly(true))?></td>
                    <td>
                        Унікальний номер запису в реєстрі:
                    </td>
                    <td>
                        <input type="text" name="insured_newpassport_reestr" value="<?= $data['insured_newpassport_reestr'] ?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                    </td>
                    <td>
                        Дійсний до:
                    </td>
                    <td>
                        <?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_dateEnd') ], $data['insured_newpassport_dateEnd_year' ], $data['insured_newpassport_dateEnd_month' ], $data['insured_newpassport_dateEnd_day' ], 'insured_newpassport_dateEnd', $this->getReadonly(true))?>
                    </td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>ІПН:</td>
                <td><input type="text" name="insured_identification_code" value="<?=$data['insured_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>
             
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Область:</td>
                <td>
                    <?
                    echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_regions_id') ], $data['insured_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data);
                    ?>
                </td>
                <td class="label grey">Район:</td>
                <td><input type="text" id="insured_area" name="insured_area" value="<?=$data['insured_area']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Місто:</td>
                <td><input type="text" name="insured_city" value="<?=$data['insured_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Вулиця:</td>
                <td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insured_street_types_id') ], $data['insured_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="insured_street" value="<?=$data['insured_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false);
                    ?>
                </td>
                <td class="label grey"><?=$this->getMark()?>Будинок:</td>
                <td><input type="text" name="insured_house" value="<?=$data['insured_house']?>" maxlength="6" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">Квартира:</td>
                <td><input type="text" name="insured_flat" value="<?=$data['insured_flat']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Телефон:</td>
                <td><input type="text" id="insured_phone" name="insured_phone" value="<?=$data['insured_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>
            
            
            <div class="section">Вигодонабувач:</div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"> ПІБ/Назва:</td>
                    <td><input type="text" name="assured_title" value="<?=$data['assured_title']?>" maxlength="150" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"> ІПН/ЄДРПОУ:</td>
                <td><input type="text" name="assured_identification_code" value="<?=$data['assured_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
                    
                </tr>
            </table>
            
         
             
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"> Область:</td>
                <td>
                    <?
                    echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('assured_regions_id') ], $data['assured_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data);
                    ?>
                </td>
                <td class="label grey">Район:</td>
                <td><input type="text" id="assured_area" name="assured_area" value="<?=$data['assured_area']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"> Місто:</td>
                <td><input type="text" name="assured_city" value="<?=$data['assured_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"> Вулиця:</td>
                <td>
                    <?
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('assured_street_types_id') ], $data['assured_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="assured_street" value="<?=$data['assured_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false);
                    ?>
                </td>
                <td class="label grey"> Будинок:</td>
                <td><input type="text" name="assured_house" value="<?=$data['assured_house']?>" maxlength="6" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">Квартира:</td>
                <td><input type="text" name="assured_flat" value="<?=$data['assured_flat']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"> Телефон:</td>
                <td><input type="text" id="assured_phone" name="assured_phone" value="<?=$data['assured_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
            </tr>
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
                 
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey">Особливі умови:</td>
                <td width="100%"><textarea id="comment" name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
            </tr>
            </table>
        </td>
    </tr>
    </table>
</form>
<script>
//loadRisks()
</script>