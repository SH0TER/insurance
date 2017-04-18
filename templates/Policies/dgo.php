<?
if (($Authorization->data['roles_id'] == ROLES_AGENT && $Authorization->data['agencies_id']==SELLER_AGENCIES_ID) || ($Authorization->data['roles_id'] != ROLES_AGENT && $data['agencies_id']==SELLER_AGENCIES_ID)) {
    $change_seller = true;
}

?>
<script type="text/javascript" src="/js/jquery/form.js"></script>
<script type="text/javascript">
    var month_array = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

    function changeInsuranceCompany(value) {
        if (value == 505) {
            $('.go_load').show();
            $('.go_date').hide();
        } else if (value == 0) {
            $('.go_date').hide();
            $('.go_load').hide();
        } else {
            $('.go_load').hide();
            $('.go_date').show();
        }
    }

    function setPoliciesPeriod() {
        var begin_arr = $('input[name=go_begin_datetime]').val().split('.');
        var begin = Date.parse(begin_arr[1]+'/'+begin_arr[0]+'/'+begin_arr[2][2]+begin_arr[2][3]);
        var now = new Date();
        var today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).valueOf();
        if (begin < today) {
            $('input[name=begin_datetime]').val(now.getDate()+'.'+month_array[now.getMonth()]+'.'+now.getFullYear());
            $('#begin_datetime_day').val(now.getDate());
            $('#begin_datetime_month').val(month_array[now.getMonth()]);
            $('#begin_datetime_year').val(now.getFullYear());
        } else {
            $('input[name=begin_datetime]').val($('input[name=go_begin_datetime]').val());
            $('#begin_datetime_day').val($('#go_begin_datetime_day').val());
            $('#begin_datetime_month').val($('#go_begin_datetime_month').val());
            $('#begin_datetime_year').val($('#go_begin_datetime_year').val());
        }

        $('input[name=end_datetime]').val($('input[name=go_end_datetime]').val());
        $('#end_datetime_day').val($('#go_end_datetime_day').val());
        $('#end_datetime_month').val($('#go_end_datetime_month').val());
        $('#end_datetime_year').val($('#go_end_datetime_year').val());
    }

    function changePersonTypesId(value) {
        $('#insurerBlock').show();
        switch (value) {
            case '1':
                $('.person_types_id_1_Fields').show();
                $('.person_types_id_2_Fields').hide();
                $('table#insurer_id_card_table').show();
                setInsurerIdCard();
                break;
            case '2':
                $('.person_types_id_1_Fields').hide();
                $('.person_types_id_2_Fields').show();
                $('table#insurer_id_card_table').hide();
                $('table#insurer_new_passport_table').hide();
                break;
            default:
                $('#insurerBlock').hide();
        }
    }

    function loadGO() {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Policies|loadGoInWindow' +
                        '&product_types_id=<?=PRODUCT_TYPES_DGO?>' +
                        '&go_series=' + getElementValue('go_series') +
                        '&go_number=' + getElementValue('go_number'),
            success: function(result) {
                if (result.success == 1) {
                    setFields(result);
                } else {
                    alert('Полісу ОСЦПВ не знайдено');
                }
            }
        });
    }

    function setFields(values) {
        $('input[name=go_begin_datetime]').val(values.begin_datetime);
        $('#go_begin_datetime_day').val(values.begin_datetime_day);
        $('#go_begin_datetime_month').val(values.begin_datetime_month);
        $('#go_begin_datetime_year').val(values.begin_datetime_year);
        $('input[name=go_end_datetime]').val(values.end_datetime);
        $('#go_end_datetime_day').val(values.end_datetime_day);
        $('#go_end_datetime_month').val(values.end_datetime_month);
        $('#go_end_datetime_year').val(values.end_datetime_year);
        $('select[name=car_types_id]').val(values.car_types_id);
        setBrandsCars('car_types_id');
        $('select[name=brands_id]').val(values.brands_id);
        setModelsCars('brands_id');
        $('select[name=models_id]').val(values.models_id);
        changeModel('models_id');
        $('input[name=sign]').val(values.sign);
        $('input[name=shassi]').val(values.shassi);
        $('input[name=year]').val(values.year);
        $('select[name=registration_cities_id]').val(values.registration_cities_id);
        $('input[name=registration_cities_title]').val(values.registration_cities_title);
        $('#person_types_id').val(values.person_types_id);
        changePersonTypesId(values.person_types_id);
        if (values.person_types_id == '1') {

            $('table#insurer_id_card_table').css('display', 'table');
            $('table#insurer_new_passport_table').css('display', 'table');
            $('table#passportDGO').css('display', 'table');


            $('input[name=insurer_lastname]').val(values.insurer_lastname);
            $('input[name=insurer_firstname]').val(values.insurer_firstname);
            $('input[name=insurer_patronymicname]').val(values.insurer_patronymicname);
            $('input[name=insurer_dateofbirth]').val(values.insurer_dateofbirth);
            $('#insurer_dateofbirth_day').val(values.insurer_dateofbirth_day);
            $('#insurer_dateofbirth_month').val(values.insurer_dateofbirth_month);
            $('#insurer_dateofbirth_year').val(values.insurer_dateofbirth_year);
            $('input[name=insurer_passport_series]').val(values.insurer_passport_series);
            $('input[name=insurer_passport_number]').val(values.insurer_passport_number);
            $('input[name=insurer_passport_place]').val(values.insurer_passport_place);
            $('input[name=insurer_passport_date]').val(values.insurer_passport_date);
            $('#insurer_passport_date_day').val(values.insurer_passport_date_day);
            $('#insurer_passport_date_month').val(values.insurer_passport_date_month);
            $('#insurer_passport_date_year').val(values.insurer_passport_date_year);

            

            $('input[name=insurer_id_card]').val(values.insurer_id_card);
            $('input[name=insurer_newpassport_number]').val(values.insurer_newpassport_number);
            $('input[name=insurer_newpassport_place]').val(values.insurer_newpassport_place);
            $('input[name=insurer_newpassport_date]').val(values.insurer_newpassport_date);
            $('#insurer_newpassport_date_day').val(values.insurer_newpassport_date_day);
            $('#insurer_newpassport_date_month').val(values.insurer_newpassport_date_month);
            $('#insurer_newpassport_date_year').val(values.insurer_newpassport_date_year);
            $('input[name=insurer_newpassport_reestr]').val(values.insurer_newpassport_reestr);
            $('input[name=insurer_newpassport_dateEnd]').val(values.insurer_newpassport_dateEnd);
            $('#insurer_newpassport_dateEnd_day').val(values.insurer_newpassport_dateEnd_day);
            $('#insurer_newpassport_dateEnd_month').val(values.insurer_newpassport_dateEnd_month);
            $('#insurer_newpassport_dateEnd_year').val(values.insurer_newpassport_dateEnd_year);
            

            $('input[name=insurer_identification_code]').val(values.insurer_identification_code);
            //$('input[name=insurer_driver_licence_series]').val(values.insurer_driver_licence_series);
            //$('input[name=insurer_driver_licence_number]').val(values.insurer_driver_licence_number);
            //$('input[name=insurer_driver_licence_date]').val(values.insurer_driver_licence_date);
            //$('#insurer_driver_licence_date_day').val(values.insurer_driver_licence_date_day);
            //$('#insurer_driver_licence_date_month').val(values.insurer_driver_licence_date_month);
            //$('#insurer_driver_licence_date_year').val(values.insurer_driver_licence_date_year);
        }
        if (values.person_types_id == '2'){
            $('table#insurer_id_card_table').css('display', 'none');
            $('table#insurer_new_passport_table').css('display', 'none');
            $('table#passportDGO').css('display', 'none');

            $('input[name=insurer_company]').val(values.insurer_lastname);
            $('input[name=insurer_edrpou]').val(values.insurer_edrpou);
            $('input[name=insurer_lastname]').val('');
            $('input[name=insurer_firstname]').val('');
            $('input[name=insurer_patronymicname]').val('');

            
            $('#insurer_passport_series').val('');
            $('#insurer_passport_number').val('');
            $('input[name=insurer_newpassport_number').val('');
            $('input[name=insurer_newpassport_reestr').val('');
            $('input[name=insurer_newpassport_place').val('');
        }
        $('input[name=insurer_zip]').val(values.insurer_zip);
        $('select[name=insurer_regions_id]').val(values.insurer_regions_id);
        $('input[name=insurer_area]').val(values.insurer_area);
        $('input[name=insurer_city]').val(values.insurer_city);
        $('select[name=insurer_street_types_id]').val(values.insurer_street_types_id);
        $('input[name=insurer_street]').val(values.insurer_street);
        $('input[name=insurer_house]').val(values.insurer_house);
        $('input[name=insurer_flat]').val(values.insurer_flat);
        $('input[name=insurer_phone]').val(values.insurer_phone);
        $('input[name=insurer_email]').val(values.insurer_email);

        

        setPoliciesPeriod();
    }

    function setInsurerIdCard() {
        if($('[name=insurer_id_card]:checked').val() == 0) {
            $('#passportDGO').show();
            $('table#insurer_new_passport_table').hide();
        } else {
            $('#passportDGO').hide();
            $('table#insurer_new_passport_table').show();
        }
    }

    function getCar() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_DGO?>',
            success:    function (result) {
                setBrandsCars('car_types_id');
                $('#brands_id').val(<?=$data['brands_id']?>);
                setModelsCars('brands_id');
                $('#models_id').val(<?=$data['models_id']?>);
                changeModel('models_id');
            }
        });
    }

    function setBrandsCars(id){
        var car_types = document.getElementById(id);
        var brands = document.getElementById('brands_id');
        var models = document.getElementById('models_id');
        brands.options.length = 0;
        models.options.length = 0;
        document.getElementById('brand').value = '';
        document.getElementById('model').value = '';
        brands.options[0] = new Option ('...', '-1');
        for (var i=0; i < cars.length; i++){
            if (cars[i][0] == car_types[car_types.selectedIndex].value){
                for (var j=0; j < cars[i][1].length; j++){
                    brands.options[j+1] = new Option (cars[ i ][ 1 ][ j ][ 1 ], cars[ i ][ 1 ][ j ][ 0 ]);
                }
            }
        }
    }

    function setModelsCars(id){
        var brands = document.getElementById(id);
        var car_types = document.getElementById('car_types_id');
        var models = document.getElementById('models_id');
        document.getElementById('brand').value = brands[brands.selectedIndex].text;
        document.getElementById('model').value = '';
        models.options.length = 0;
        models.options[0] = new Option ('...', '-1');
        for (var i=0; i < cars.length; i++) {
            if (cars[ i ][ 0 ] == car_types[car_types.selectedIndex].value) {
                for (var j=0; j < cars[ i ][ 1 ].length; j++) {
                    if (cars[ i ][ 1 ][ j ][ 0 ] == brands[brands.selectedIndex].value) {
                        for (var k=0; k < cars[ i ][ 1 ][ j ][ 2 ].length; k++) {
                            models.options[k+1] = new Option( cars[ i ][ 1 ][ j ][ 2 ][ k ][ 1 ], cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ]);
                        }
                        break;
                    }
                }
            }
        }
    }

    function changeModel(id){
        var models = document.getElementById(id);
        document.getElementById('model').value = models[models.selectedIndex].text;
    }

    function calculateRate() {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=Products|getRateInWindow' +
                        '&product_types_id=<?=PRODUCT_TYPES_DGO?>' +
                        '&insurance_price_id= '+getElementValue('insurance_price_id') +
                        '&agencies_id= '+getElementValue('agencies_id') +
                        '&end_datetime= '+getElementValue('end_datetime') +
                        '&begin_datetime= '+getElementValue('begin_datetime') ,
            success: function(result) {
                $('#rateBlock').html(result.rate + ' %, ' + getMoneyFormat(result.amount));
                $('#price').val(result.amount);
                $('#product_id').val(result.products_id);
            }
        });
    }

    function checkFields() {
        if ($('#policy_statuses_id option:selected').val() == <?=POLICY_STATUSES_GENERATED?> && !window.confirm('Після зміни статусу на "Сформовано" редагування полісу стане неможливим. Продовжити?')) {
            return false;
        }

        document.<?=$this->objectTitle?>.end_datetime_day.disabled      = false;
        document.<?=$this->objectTitle?>.end_datetime_month.disabled        = false;
        document.<?=$this->objectTitle?>.end_datetime_year.disabled     = false;

        document.<?=$this->objectTitle?>.end_datetime_day.style.display = 'none';
        document.<?=$this->objectTitle?>.end_datetime_month.style.display   = 'none';
        document.<?=$this->objectTitle?>.end_datetime_year.style.display    = 'none';

        return true;
    }

    $(document).ready(function(){
        
        
        getCar();

        $('#go_begin_datetime').change(function(){
            setPoliciesPeriod();
        });
        $('#go_end_datetime').change(function(){
            setPoliciesPeriod();
        });
        changePersonTypesId('<?=$data['person_types_id']?>');

        $('#go_insurance_company_id').val(<?=$data['go_insurance_company_id']?>);
        changeInsuranceCompany(parseInt(<?=intval($data['go_insurance_company_id'])?>));
        
        
            <?
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
            ?>
    });

    
    function cancelPolicy(button) {
        if (!window.confirm('Ви дійсно бажаєте припинити дiю полісу?')) {
            return;
        }
        document.location = '/index.php?do=Policies|cancelPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
    }
    
</script>
<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" id="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data"  onsubmit="return checkFields()">
    <input type="hidden" name="do" id="do" value="Policies|<?=($action ? $action: $data['action'])?>" />
    <input type="hidden" name="action" value="<?=($action ? $action : $data['action'])?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" id="products_id" name="products_id" value="<?=$data['products_id']?>" />
    <input type="hidden" id="rate" name="rate" value="<?=$data['rate']?>" />
    <input type="hidden" id="date_day" name="date_day" value="<?=$data['date_day']?>" />
    <input type="hidden" id="date_month" name="date_month" value="<?=$data['date_month']?>" />
    <input type="hidden" id="date_year" name="date_year" value="<?=$data['date_year']?>" />
    <input type="hidden" id="brand" name="brand" value="<?=$data['brand']?>" />
    <input type="hidden" id="model" name="model" value="<?=$data['model']?>" />
    <input type="hidden" id="price" name="price" value="<?=$data['price']?>" />
    <input type="hidden"  name="insurance_companies_id" value="4" />
    <input type="hidden" id="individual_motivation" name="individual_motivation" value="<?=intval($data['individual_motivation'])?>" />
    <table cellpadding="2" cellspacing="3" width="100%">
        <tr>
            <td>
                <div class="section">Поліс ОСЦПВ:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Серія:</td>
                        <td><input type="text" id="go_series" name="go_series" value="<?=$data[ 'go_series' ]?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Номер:</td>
                        <td><input type="text" id="go_number" name="go_number" value="<?=$data[ 'go_number' ]?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Страхова компанія:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('go_insurance_company_id') ], $data['go_insurance_company_id' ], $data['languageCode'], 'onchange="changeInsuranceCompany(this.value)" ' . $this->getReadonly(true), null, $data)?></td>
                        <td class="go_load" ><input name="load_go_btn" type="button" value="Завантажити поліс" onclick="loadGO()" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                        <td class="label grey go_date"><?=$this->getMark(false)?>Дата початку дії:</td>
                        <td class="go_date"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('go_begin_datetime') ], $data['go_begin_datetime_year' ], $data['go_begin_datetime_month' ], $data['go_begin_datetime_day' ], 'go_begin_datetime', $this->getReadonly(true))?></td>
                        <td class="label grey go_date"><?=$this->getMark(false)?>Дата закінчення дії:</td>
                        <td class="go_date"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('go_end_datetime') ], $data['go_end_datetime_year' ], $data['go_end_datetime_month' ], $data['go_end_datetime_day' ], 'go_end_datetime', $this->getReadonly(true))?></td>
                    </tr>
                </table>

                <div class="section">Параметри страхування:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Страхова сума:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurance_price_id') ], $data['insurance_price_id' ], $data['languageCode'], 'onchange="calculateRate();" ' . $this->getReadonly(true), null, $data)?></td>
                        <td class="label grey"><b>Тариф:</b></td>
                        <td id="rateBlock"><?=getRateFormat($data['rate'])?>%; <?=getMoneyFormat($data['amount'])?></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                   <tr>
                        <td class="label grey"><?=$this->getMark()?>Дата та час початку дії полісу:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data[ 'begin_datetime_year' ], $data[ 'begin_datetime_month' ], $data[ 'begin_datetime_day' ], 'begin_datetime', 'onchange="calculateRate();" ' .$this->getReadonly(true))?></td>
                        <td class="label grey"><?=$this->getMark()?>Дата закінчення дії полісу:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data[ 'end_datetime_year' ], $data[ 'end_datetime_month' ], $data[ 'end_datetime_day' ], 'end_datetime',  'onchange="calculateRate();" ' .$this->getReadonly(true))?></td>
                    </tr>
                </table>
                

                <div class="section">Дані щодо ТЗ:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Тип ТЗ:</td>
                        <td colspan="3"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('car_types_id') ], $data['car_types_id' ], $data['languageCode'], 'onchange="setBrandsCars(this.id);" ' . $this->getReadonly(true), null, $data)?></td>
                        <td class="label grey"><?=$this->getMark()?>Марка:</td>
                        <td><select id="brands_id" name="brands_id" onchange="setModelsCars(this.id);" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
                        <td class="label grey"><?=$this->getMark()?>Модель:</td>
                        <td><select id="models_id" name="models_id" onchange="changeModel(this.id);" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
                    </tr>
                    <tr>
                        <td class="label grey">Державний знак (реєстраційний №):</td>
                        <td><input type="text" name="sign" value="<?=$data[ 'sign' ]?>" maxlength="15" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>№ шасі (кузов, рама):</td>
                        <td><input type="text" name="shassi" value="<?=$data[ 'shassi' ]?>"  class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Рік випуску:</td>
                        <td><input type="text" name="year" value="<?=$data[ 'year' ]?>" maxlength="20" class="fldText year" onfocus="this.className='fldTextOver year'" onblur="this.className='fldText year'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Місце реєстрації:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('registration_cities_id') ], $data['registration_cities_id' ], $data['languageCode'], 'style="width: 200px" onchange="changeCity(); changeProduct();" ' . $this->getReadonly(true), null, $data)?></td>
                        <td id="registration_cities_title" style="display: <?=($data['registration_cities_id'] == CITIES_OTHER) ? 'block' : 'none'?>"><input type="text" name="registration_cities_title" value="<?=$data['registration_cities_title']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                    
                </table>
                
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey">Картка Експрес Асістанс: </td>
                <td><input type="text" name="card_assistance" id="card_assistance" value="<?=$data['card_assistance']?>" maxlength="4" class="fldText number<?=$this->isEqual('card_assistance')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('card_assistance')?>'" onblur="this.className='fldText number<?=$this->isEqual('card_assistance')?>'" <?=$this->getReadonly(false)?> /></td>

            </tr>
            </table>

                <div class="section">Страхувальник:</div>
                <table>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Тип особи:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('person_types_id') ], $data['person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changePersonTypesId(this.value);"', null, $data)?></td>
                    </tr>
                </table>

                <div id="insurerBlock">
                    <table class="person_types_id_2_Fields" cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="label grey""><?=$this->getMark()?>Компанiя:</td>
                            <td><input type="text" id="insurer_company" name="insurer_company" value="<?=$data['insurer_company']?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>ЄДРПОУ:</td>
                            <td><input type="text" id="insurer_edrpou" name="insurer_edrpou" value="<?=$data[ 'insurer_edrpou' ]?>" maxlength="10" class="fldText edrpou" onfocus="this.className='fldTextOver edrpou'" onblur="this.className='fldText edrpou'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark(false)?>Банк:</td>
                            <td><input type="text" name="insurer_bank" id="insurer_bank" value="<?=$data[ 'insurer_bank' ]?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark(false)?>МФО:</td>
                            <td><input type="text" name="insurer_bank_mfo" id="insurer_bank_mfo" value="<?=$data[ 'insurer_bank_mfo' ]?>" maxlength="6" class="fldText mfo" onfocus="this.className='fldTextOver mfo'" onblur="this.className='fldText mfo'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark(false)?>Р/р:</td>
                            <td><input type="text" name="insurer_bank_account" id="insurer_bank_account" value="<?=$data[ 'insurer_bank_account' ]?>" maxlength="20" class="fldText bank_account" onfocus="this.className='fldTextOver bank_account'" onblur="this.className='fldText bank_account'" <?=$this->getReadonly(false)?> /></td>
                        </tr>
                    </table>

                    <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
                            <td><input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
                            <td><input type="text" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>По батькові:</td>
                            <td><input type="text" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey person_types_id_1_Fields"><?=$this->getMark(false)?>Дата народження:</td>
                            <td class="person_types_id_1_Fields"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ], $data['insurer_dateofbirth_year' ], $data['insurer_dateofbirth_month' ], $data['insurer_dateofbirth_day' ], 'insurer_dateofbirth', $this->getReadonly(true))?></td>
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

                    <table cellpadding="5" cellspacing="0" class="person_types_id_1_Fields" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?> id="passportDGO">
                        <tr>
                            <td class="label grey"><?=$this->getMark(false)?>Паспорт, серія і номер:</td>
                            <td>
                                <input type="text" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> />
                                <input type="text" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                            </td>
                            <td class="label grey"><?=$this->getMark(false)?>Паспорт. Ким і де виданий:</td>
                            <td><input type="text" id="insurer_passport_place" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark(false)?>Паспорт. Дата видачі:</td>
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

                    <table cellpadding="5" cellspacing="0" class="person_types_id_1_Fields">
                        <tr>
                            <!--td id="insurerDriverLicenceLabel" class="label grey">Водійські права, серія, номер і дата:</td>
                            <td>
                                <input type="text" id="insurer_driver_licence_series" name="insurer_driver_licence_series" value="<?=$data['insurer_driver_licence_series']?>" maxlength="4" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> />
                                <input type="text" id="insurer_driver_licence_number" name="insurer_driver_licence_number" value="<?=$data['insurer_driver_licence_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                            </td>
                            <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_driver_licence_date') ], $data['insurer_driver_licence_date_year' ], $data['insurer_driver_licence_date_month' ], $data['insurer_driver_licence_date_day' ], 'insurer_driver_licence_date', 'onchange="setDriverStandingsId()" ' . $this->getReadonly(true))?></td-->
                            <td class="label grey"><?=$this->getMark()?>ІПН:</td>
                            <td><input type="text" id="insurer_identification_code" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
                        </tr>
                    </table>

                    <table cellpadding="5" cellspacing="0" class="person_types_id_2_Fields">
                        <tr>
                            <td class="label grey"><?=$this->getMark(false)?>Посада:</td>
                            <td><input type="text" id="insurer_position" name="insurer_position" value="<?=$data['insurer_position']?>" maxlength="150" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark(false)?>Діє на підставі:</td>
                            <td><input type="text" id="insurer_ground" name="insurer_ground" value="<?=$data['insurer_ground']?>" maxlength="50" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td>
                        </tr>
                    </table>

                    <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="label grey">Індекс:</td>
                            <td><input type="text" name="insurer_zip" value="<?=$data['insurer_zip']?>" maxlength="5" class="fldText zip" onfocus="this.className='fldTextOver zip'" onblur="this.className='fldText zip'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>Область:</td>
                            <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                            <td class="label grey">Район:</td>
                            <td><input type="text" id="insurer_area" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_area')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_area')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>Місто:</td>
                            <td><input type="text" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                    </table>

                    <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="label grey"><?=$this->getMark()?>Вулиця:</td>
                            <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_street_types_id'))?><input type="text" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>Будинок:</td>
                            <td><input type="text" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="6" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey">Квартира:</td>
                            <td><input type="text" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey"><?=$this->getMark()?>Телефон:</td>
                            <td><input type="text" id="insurer_phone" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
                            <td class="label grey">E-mail:</td>
                            <td><input type="text" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
                        </tr>
                    </table>
                </div>

                <div class="section">Параметри полісу страхування:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <? if ($this->mode == 'view') {?>
                        <td class="label grey">Номер полісу:</td>
                        <td><input type="text" name="number" value="<?=$data['number']?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
                        <td class="label grey"><?=$this->getMark()?>Дата заключення полісу:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', '  ' . $this->getReadonly(true))?></td>
                        <? } ?>
                    </tr>
                </table>

                <div class="section">Пiдписи:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Пiдпис полicа:</td>
                        <td>
                            <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ], $data['sign_agents_id' ], $data['languageCode'], $this->getReadonlySign($data) . ' onchange=""', null, $data, $this->isEqual('sign_agents_id'))?>
                            <? if (intval($data['documents'])==0 && $this->mode != 'update') {?>
                            <input type="button" value=" Змiнити " onclick="changeAgentSign();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
                            <?}?>
                        </td>
                    </tr>
                </table>

                <div class="section">Додатково:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Статус:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'))?></td>
                        
                        <td class="label grey client_manager">Сторонiй клiєнт:</td>
                        <td class="client_manager"><input id="outside_client" type="checkbox" name="outside_client" value="1" <?if ($data['outside_client']==1) echo 'checked';?> <?=$this->getReadonly(true)?> /></td>

                        <? if ($data['cons_agents_id']==0) { ?>
                        <td class="label grey client_manager"><?=$this->getMark()?>Менеджер що привiв клiєнта:</td>
                        <td class="client_manager" id="selectsellermanager">
                            <?if (ereg('^view', $action)) {?>
                                <b><?=$data['manager_fio']?></b>
                            <?} else {?>
                                <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('manager_id')], $data['manager_id'], $data['languageCode'], $this->getReadonly($data) . ' onchange=""', null, $data, $this->isEqual('manager_id'))?>
                            <?}?>
                        </td>   
                        <? if ($data['individual_motivation']) {?>
                        <td>
                        % КВ для МП:
                        <input id="motivation_manager_percent" class="fldPercent flat" type="text" onblur="this.className='fldPercent flat'" onfocus="this.className='fldPercent flat'" maxlength="10" value="<?=$data['motivation_manager_percent']?>" name="motivation_manager_percent" <?=$this->getReadonly(true)?> >
                        </td>       
                        <?}?>
                        <?
                        }  else {
                                echo '<td>Створив консультацiю: '.$data['cons_agents_fio'].'</td>';
                            }
                        ?>


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
                    </tr>
                </table>

                <table width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Особливі умови:</td>
                        <td width="100%"><textarea id="comment" name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea></td>
                    </tr>
                </table>
                
                <?if (!ereg('^view', $action) && ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['id']==1)) {?>
                <table   cellpadding="0" cellspacing="0">
                <tr>
                    <td class="label grey"><b style="color:#ff0066">ПРИ ЗБЕРЕЖЕННI НЕ ПЕРЕРАХОВУВАТИ ТАРИФ:</b></td>
                    <td >&nbsp;</td>
                    <td><input type="checkbox" id="owner" value="1" name="dontRecalcRate" /></td>
                    <td class="label grey"><b style="color:#ff0066">ПРИ ЗБЕРЕЖЕННI НЕ ПЕРЕВIРЯТИ ФОРМАТИ:</b></td>
                    <td >&nbsp;</td>
                    <td><input type="checkbox" id="owner" value="1" name="dontCheckFormat" /></td>
                </tr>
                </table>
            <?}?>
            </td>
        </tr>
    </table>
</form>