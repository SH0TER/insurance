<?

if (!is_array($data['participants'])) {
    $data['participants'] = unserialize($data['participants']);
}

?>
<style type="text/css">
    .columns TD {
        height: 25px;
        color: #FFFFFF;
        font-weight: bold !important;
        border-right: 1px solid #4F5D75;
        border-top: 1px solid #4F5D75;
        border-bottom: 1px solid #4F5D75;
        background: #008575 url(../images/administration/tabBorder.gif);
    }
</style>

<link rel="stylesheet" type="text/css" media="screen" href="/css/validationEngine.jquery.css" />
<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />

<script>

    var product_types_suffixes = {
        3: 'Kasko',
        4: 'Go'
    };

    function log(string) {
        console.log(string);
    }
    
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }
    
    $(document).ready(function(){
        
        $('select[name=regions_id]').bind('change', clearInformation);
        
        $('select[name=car_services_workers]').bind('change', function () {
            changePhoneWorker();
        });
        
        $('select[name=car_services_id]').bind('change', function() {
            clearInformation();
            showSTOWorkers(parseInt(this.value));
            showSTOaddress(parseInt(this.value));
        });

        $('input[name=owner_types_id]').bind('change', function() {
            $('select[name=regions_id]').attr('disabled', false);

            if($('select[name=regions_id] option:selected').val() == 26)
            {
                $('select[name=regions_id]').val(0);
                fullClearInfo();
            }
        });
        
        $('input[name=owner_types_id]').bind('click', function(){
            changeOwnerTypesId(parseInt(this.value));
            changeDisplayingGeneralAgencie(parseInt(this.value));
        });

        $('input[name=btnSearchKasko]').bind('click', function(){
           searchPolicy(<?=PRODUCT_TYPES_KASKO?>, $('input[name=policies_kasko_number]').val(), $('input[name=policies_kasko_item_sign]').val(), $('input[name=policies_kasko_insurer]').val(), $('input[name=datetime]').val());
        });

        $('input[name=btnClearKasko]').bind('click', function(){
            $('input[name=policies_kasko_number]').val('');
            $('input[name=policies_kasko_item_sign]').val('');
            $('#blockPolicyKaskoInfo').html('');
            $('input[name=policies_kasko_id]').val(0);
            $('input[name=generalAgencieName]').val('');
        });

        $('input[name=btnSearchGo]').bind('click', function(){
            searchPolicy(<?=PRODUCT_TYPES_GO?>, $('input[name=policies_go_number]').val(), $('input[name=policies_go_item_sign]').val(), $('input[name=policies_go_insurer]').val(), $('input[name=datetime]').val());
        });

        $('input[name=btnClearGo]').bind('click', function(){
            $('input[name=policies_go_number]').val('');
            $('input[name=policies_go_item_sign]').val('');
            $('#blockPolicyGoInfo').html('');
            $('input[name=generalAgencieName]').val('');
        });

        $('input[name=applicant_types_id]').bind('click', function(){
            setApplicant(parseInt(this.value));
        });

        $('input[name=application_risks_id]').bind('click', function(){
            if (!parseInt($('input[name=policies_kasko_items_id]:checked').val()) && !parseInt($('input[name=policies_go_id]:checked').val())) {
                getCarTypes($('select[name=car_types_id]'), null, 0);
            }
        });

        $('select[name=car_types_id]').bind('change', function(event, args){
            getCarBrands($('select[name=car_brands_id]'), parseInt(this.value), args);
        });

        $('select[name=car_brands_id]').bind('change', function(event, args){
           getCarModels($('select[name=car_models_id]'), parseInt(this.value), args);
        });

        $('input[name=making]').bind('click', function(){
           changeMaking(parseInt(this.value));
        });

        $('input[name=driver_types_id]').bind('click', function(){
            setDriver(parseInt(this.value));
        });
        
        $('input[name=place]').bind('click', function(){
            if (this.value == 1) {
                $('#blockPlaceAddressInfo').hide();
            } else {
                $('#blockPlaceAddressInfo').show();
            }           
        });

        getRegionsList();
        //getCarServicesList();

        <?
                
            if (intval($data['policies_kasko_items_id'])) {
                echo "loadPolicy(3, parseInt(" . intval($data['policies_kasko_items_id']) . "));";
            }

            if (intval($data['policies_go_id'])) {
                echo "loadPolicy(4, parseInt(" . intval($data['policies_go_id']) . "));";
            }

            if (intval($data['car_types_id']) && !intval($data['policies_go_id']) && !intval($data['policies_kasko_items_id'])) {
                echo "getCarTypes($('select[name=car_types_id]'), {'car_types_id': " . intval($data['car_types_id']) . ", 'brands_id': " . intval($data['car_brands_id']) . ", 'models_id': " . intval($data['car_models_id']) . "}, 0);";
                //echo "changeParticipantsRowStyle();";
            }
            
            if(intval($data['car_services_workers']) && intval($data['car_services_id']))
            {
                echo "showSTOWorkers(" . intval($data['car_services_id']) . ");";
            }
        ?>

    });

    function fullClearInfo() {
        $('select[name=car_services_id]').empty();
        $('select[name=car_services_workers]').empty();
        $('td[id=car_services_workers_phone]').html('');
        $('input[name=car_service_adress]').val('');
        $('select[name=car_services_workers]').append($('<option value="0">...</option>'));
        $('select[name=car_services_workers]').append($('<option value="0">...</option>'));
    }
    
    function clearInformation() {
        $('select[name=car_services_workers]').empty();
        $('td[id=car_services_workers_phone]').html('');
        $('input[name=car_service_adress]').val('');
        $('select[name=car_services_workers]').append($('<option value="0">...</option>'));
    }
    
    function changePhoneWorker() {
        if($('option:selected', $('select[name=car_services_workers]')).val() > 0)
            $('td[id=car_services_workers_phone]').html('<b>Телефон: </b> ' + $('option:selected', $('select[name=car_services_workers]')).attr('phone'));
        else if ($('option:selected', $('select[name=car_services_workers]')).val() == 0)
            $('td[id=car_services_workers_phone]').html('');
    }
    
    function getGeneralAgencie() {
        if($('input[name=owner_types_id]').val() == 1) {
            if($('input[name=policies_kasko_id]') && isNumeric($('input[name=policies_kasko_id]').val())) {
                searchGeneralAgencie(parseInt($('input[name=policies_kasko_id]').val()));
            } else {
                if($('input[name=policies_go_id]') && isNumeric($('input[name=policies_go_id]').val())) {
                    console.log('1');
                    searchGeneralAgencie(parseInt($('input[name=policies_go_id]').val()));
                }
            }
        }
    }
    
    function showSTOaddress(car_services_id) {
        if(car_services_id > 0) {
            $.ajax({
                type:       'GET',
                url:        'index.php',
                dataType:   'json',
                async:      true,
                data:       'do=ApplicationCalls|getSTOAddressInWindow'+
                            '&car_services_id=' + car_services_id,
                success:    function (STOAddress){
                    if(STOAddress.car_services_id == -1)
                        return;
                    
                    obj = $('input[name=car_service_adress]');
                    obj.val(STOAddress.address.replace(/&quot;/g, '"'));
                    
                    if (obj.val().length > obj.attr('size'))
                        obj.attr('size', obj.val().length + 3);
                    else {
                        if(obj.attr('size') > 47 && obj.val().length <= 47) {
                            obj.attr('size', 47);
                        } else if (obj.attr('size') > 47 && obj.val().length > 47)
                            obj.attr('size', obj.val().length + 3);
                    }
                }
            });
        }
    }
    
    function changeDisplayingGeneralAgencie(owner_type) {
        if(owner_type == 1) {
            if($('tr[id=generalAgencie]').is(":hidden"))
                $('tr[id=generalAgencie]').show();
        } else {
            if(!$('tr[id=generalAgencie]').is(":hidden"))
                $('tr[id=generalAgencie]').hide();
        }
    }
    
    function searchGeneralAgencie(policies_id) {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getGeneralAgencieInWindow'+
                        '&policies_id=' + policies_id,
            success:    function (genAgencie){
                if(genAgencie.agencie_id == -1)
                    return;
                
                obj = $('input[name=generalAgencieName]');
                obj.val(genAgencie.title.replace(/&quot;/g, '"'));
                
                if (obj.val().length > obj.attr('size'))
                        obj.attr('size', obj.val().length + 3);
                    else {
                        if(obj.attr('size') > 47 && obj.val().length <= 47) {
                            obj.attr('size', 47);
                        } else if (obj.attr('size') > 47 && obj.val().length > 47)
                            obj.attr('size', obj.val().length + 3);
                    }
            }
        });
    }
    
    function showSTOWorkers(car_services_id) {
        if(car_services_id > 0) {
            $.ajax({
                type:       'GET',
                url:        'index.php',
                dataType:   'json',
                async:      true,
                data:       'do=ApplicationCalls|getSTOWorkersInWindow'+
                            '&car_services_id=' + car_services_id,
                success:    function (STOWorkers){
                    if(STOWorkers.car_services_id == -1)
                        return;
                    obj = $('select[name=car_services_workers]');
                    obj.empty();
                    obj.append($('<option value="0">...</option>'));
                    
                    selected=0;
                    
                    for(i in STOWorkers) {
                        obj.append($('<option value="'+STOWorkers[i].id+'" phone="'+STOWorkers[i].phone+'" ' + (<?=intval($data['car_services_workers'])?> == STOWorkers[i].id ? 'selected' : '') + '>'+STOWorkers[i].FIO+'</option>'));
                    }
                    
                    changePhoneWorker();
                }
            });
        }
    }
    
    function changeOwnerTypesId(owner_types_id){
        switch (owner_types_id){
            case 1:
                $('#blockPolicyKasko').show();
                $('#blockApplicantTypesId').show();
                $('#driver_types_id1').show();
                $('#driver_types_id2').show();
                break;
            case 2:
                $('#blockPolicyKasko').hide();
                $('#blockApplicantTypesId').hide();
                $('#driver_types_id1').hide();
                $('#driver_types_id2').hide();
                break;
            default:
                log('changeOwnerTypesId. Unknown field "owner_types_id": ' + owner_types_id);
                break;
        }
    }

    function searchPolicy(product_types_id, policies_number, sign, insurer, datetime){
        if (policies_number || sign || insurer) {
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'html',
                async:      false,
                data:       'do=ApplicationCalls|getSearchPolicyInWindow' +
                            '&datetime=' + datetime +
                            '&product_types_id=' + product_types_id +
                            '&number=' + policies_number +
                            '&sign=' + sign +
                            '&insurer=' + insurer,
                success: function(result) {
                    $('#blockPolicy' + product_types_suffixes[product_types_id] + 'Info').html(result);
                    $('#sign_agency_title_dest').html( $('#sign_agency_title_src').html() );
                }
            });
        } else {
            alert('Для пошуку необхідно ввести номер договору/полісу, державний номер ТЗ або страхувальника');
        }
    }

    function choosePolicy(policies_id, product_types_id) {
        switch (product_types_id) {
            case 3:
                $('input[name=policies_kasko_id]').val(policies_id);
                getCarTypes($('select[name=car_types_id]'), null, 1);
                getCar(parseInt($('input[name=policies_kasko_items_id]:checked').val()), parseInt($('input[name=policies_go_id]:checked').val()));
                break;
            case 4:
                getCarTypes($('select[name=car_types_id]'), null, 1);
                getCar(parseInt($('input[name=policies_kasko_items_id]:checked').val()), parseInt($('input[name=policies_go_id]:checked').val()));
                break;
            default:
                log('choosePolicy. Unknown field "product_types_id": ' + product_types_id);
                break;
        }
        
        if($('input[name=owner_types_id][type=radio]').is(':checked')) {
            searchGeneralAgencie(parseInt(policies_id));
        }
    }

    function loadPolicy(product_types_id, value) {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            async:      false,
            data:       'do=ApplicationCalls|getSearchPolicyInWindow' +
                        '&product_types_id=' + product_types_id +
                        '&value=' + value +
                        '&action=<?=$action?>',
            success: function(result) {
                $('#blockPolicy' + product_types_suffixes[product_types_id] + 'Info').html(result);
                getCarTypes($('select[name=car_types_id]'), null, 1);
                getCar(parseInt($('input[name=policies_kasko_items_id]:checked').val()), parseInt($('input[name=policies_go_id]:checked').val()));
                getGeneralAgencie();
            }
        });
    }

    function setApplicant(applicant_types_id) {
        switch(applicant_types_id) {
            case 1:
            case 2:
                $.ajax({
                    type:       'POST',
                    url:        'index.php',
                    dataType:   'json',
                    data:       'do=Policies|getApplicationInfoInWindow' +
                                '&types_id=' + applicant_types_id +
                                '&policies_kasko_id=' + $('input[name=policies_kasko_id]').val() +
                                '&policies_go_id=' + $('input[name=policies_go_id]:checked').val(),
                    success: function(result) {
                        if (result.status == 1) {
                            $('input[name=applicant_lastname]').val(result.applicant_lastname);
                            $('input[name=applicant_firstname]').val(result.applicant_firstname);
                            $('input[name=applicant_patronymicname]').val(result.applicant_patronymicname);
                        } else {
                            alert('Інформацію не знайдено.');
                        }
                    }
                });
                break;
        }
    }

    function getCarTypes(obj, car, isInsurer) {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getCarTypesJsonInWindow'+
                        '&policies_kasko_id=' + $('input[name=policies_kasko_id]').val() +
                        '&policies_go_id=' + $('input[name=policies_go_id]:checked').val() +
                        '&is_insurer=' + isInsurer,
            success:    function (car_types){
                setCarTypes(obj, car_types, car);
            }
        });
    }

    function setCarTypes(obj, car_types, car) {log(car_types);
        obj.empty();
        obj.append( $('<option value="-1">...</option>') );
        for (var i=0; i < car_types.length; i++){
            obj.append( $('<option value="' + car_types[i].id + '">' + car_types[i].title + '</option>') );
        }

        if (car) {
            $(obj.selector + ' [value=' + car.car_types_id + ']').attr('selected', 'selected');
            $(obj.selector).trigger('change', car);
        }
    }

    function getCarBrands(obj, car_types_id, car) {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getCarBrandsJsonInWindow'+
                        '&car_types_id=' + car_types_id,
            success:    function (car_brands){
                setCarBrands(obj, car_brands, car);
            }
        });
    }

    function setCarBrands(obj, car_brands, car) {
        obj.empty();
        obj.append( $('<option value="-1">...</option>') );
        for (var i=0; i < car_brands.length; i++){
            obj.append( $('<option value="' + car_brands[i].id + '">' + car_brands[i].title + '</option>') );
        }

        if (car) {
            $(obj.selector + ' [value=' + car.brands_id + ']').attr('selected', 'selected');
            $(obj.selector).trigger('change', car);
        }
    }

    function getCarModels(obj, brands_id, car) {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getCarModelsJsonInWindow'+
                        '&brands_id=' + brands_id,
            success:    function (car_models){
                setCarModels(obj, car_models, car);
            }
        });
    }

    function setCarModels(obj, car_models, car) {
        obj.empty();
        obj.append( $('<option value="-1">...</option>') );
        for (var i=0; i < car_models.length; i++){
            obj.append( $('<option value="' + car_models[i].id + '">' + car_models[i].title + '</option>') );
        }

        if (car) {
            $(obj.selector + ' [value=' + car.models_id + ']').attr('selected', 'selected');
        }
    }

    function changeMaking(making) {
        switch (making) {
            case 1:
                $('#blockEuroprotocolInfo').show();
                $('#blockDaiInfo').hide();
                $('#blockMvsInfo').hide();
                $('#blockOtherInfo').hide();
                break;
            case 2:
                $('#blockEuroprotocolInfo').hide();
                $('#blockDaiInfo').show();
                $('#blockMvsInfo').hide();
                $('#blockOtherInfo').hide();
                break;
            case 3:
                $('#blockEuroprotocolInfo').hide();
                $('#blockDaiInfo').hide();
                $('#blockMvsInfo').show();
                $('#blockOtherInfo').hide();
                break;
            case 4:
                $('#blockEuroprotocolInfo').hide();
                $('#blockDaiInfo').hide();
                $('#blockMvsInfo').hide();
                $('#blockOtherInfo').show();
                break;
            default:
                log('changeMaking. Unknown field "making": ' + making);
                break;
        }
    }

    function setDriver(driver_types_id) {
        switch(driver_types_id) {
            case 1:
            case 2:
                $('#blockDriverInfo').show();
                $.ajax({
                    type:       'POST',
                    url:        'index.php',
                    dataType:   'json',
                    data:       'do=Policies|getApplicationInfoInWindow' +
                                '&types_id=' + driver_types_id +
                                '&policies_kasko_id=' + $('input[name=policies_kasko_id]').val() +
                                '&policies_go_id=' + $('input[name=policies_go_id]:checked').val(),
                    success: function(result) {
                        if (result.status == 1) {
                            $('input[name=driver_lastname]').val(result.applicant_lastname);
                            $('input[name=driver_firstname]').val(result.applicant_firstname);
                            $('input[name=driver_patronymicname]').val(result.applicant_patronymicname);
                            $('input[name=driver_phone]').val('');
                        } else {
                            alert('Інформацію не знайдено.');
                        }
                    }
                });
                break;
            case 3:
                $('#blockDriverInfo').show();
                $('input[name=driver_lastname]').val($('input[name=applicant_lastname]').val());
                $('input[name=driver_firstname]').val($('input[name=applicant_firstname]').val());
                $('input[name=driver_patronymicname]').val($('input[name=applicant_patronymicname]').val());
                $('input[name=driver_phone]').val($('input[name=applicant_phone]').val());
                break;
            case 4:
                $('#blockDriverInfo').hide();
                break;
            default:
                $('#blockDriverInfo').hide();
                log('setDriver. Unknown field "driver_types_id": ' + driver_types_id);
                break;
        }
    }

    function getCar(policies_kasko_items_id, policies_go_id) {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getCarJsonInWindow'+
                        '&policies_kasko_items_id=' + policies_kasko_items_id +
                        '&policies_go_id=' + policies_go_id,
            success:    function (car){
                $('select[name=car_types_id] [value=' + car.car_types_id + ']').attr('selected', 'selected');
                getCarBrands($('select[name=car_brands_id]'), parseInt(car.car_types_id), car);
                getCarModels($('select[name=car_models_id]'), parseInt(car.brands_id), car);
                $('input[name=car_brand]').val(car.brand);
                $('input[name=car_model]').val(car.model);
            }
        });
    }

    var num_participants = -1;

    function addParticipant() {

        var participant =
            '<tr id="participants' + num_participants + '"><td><table>'+
                '<tr>'+
                '<td style="text-align: left;"  class="label grey">Прізвище, ім\'я, по батькові:<input type="text" id="participants' + num_participants + '_name" name="participants[' + num_participants + '][name]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" />' +
                '&nbsp;&nbsp;&nbsp;Телефон:<input type="text" id="participants' + num_participants + '_phone" name="participants[' + num_participants + '][phone]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" />' +
                '</td>' +
                '<td><a href="javascript: deleteParticipant(' + num_participants + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
                '</tr>' +
                '<tr><td><input value="1" type="checkbox" id="participants' + num_participants + '_car" name="participants[' + num_participants + '][car][flag]" onchange="changeParticipant(this.checked, ' + num_participants + ', \'car\')"/> <b>Транспортний засіб</b>'+
                '<tr id="participants' + num_participants + '_car_info" style="display: none;">'+
                '<td>' +
                '<table cellpadding="5" cellspacing="0">' +
                '<tr>' +
                '<td class="grey">Тип ТЗ:</td>' +
                '<td><select id="participants' + num_participants + 'car_car_type_id" name="participants[' + num_participants + '][car][data][car_type_id]" class="fldSelect" value="" /></select></td>' +
                '<td class="grey">Марка:</td>' +
                '<td><select id="participants' + num_participants + 'car_brand_id" name="participants[' + num_participants + '][car][data][brand_id]" class="fldSelect" value="" /></select></td>' +
                '<input type="hidden" id="participants' + num_participants + 'car_brand" name="participants[' + num_participants + '][car][data][brand]" value="" />' +
                '<td class="grey">Модель:</td>' +
                '<td><select id="participants' + num_participants + 'car_model_id" name="participants[' + num_participants + '][car][data][model_id]" class="fldSelect" value="" /></select></td>' +
                '<input type="hidden" id="participants' + num_participants + 'car_model" name="participants[' + num_participants + '][car][data][model]" value="" />' +
                '<td class="label grey">Державний знак:</td>' +
                '<td><input type="text" id="participants' + num_participants + 'car_sign" name="participants[' + num_participants + '][car][data][sign]" value="" maxlength="10" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
                '</tr>' +
                '<tr>' +
                '<td class="label grey">Пошкодження:</td>' +
                '<td colspan="9"><input type="text" id="participants' + num_participants + 'car_damage" name="participants[' + num_participants + '][car][data][damage]" value="" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
                '</tr>' +
                '</table>' +
                '</td>' +
                '</tr>'+
                '<tr><td><input value="1" type="checkbox" id="participants' + num_participants + '_property" name="participants[' + num_participants + '][property][flag]" onchange="changeParticipant(this.checked, ' + num_participants + ', \'property\')"/> <b>Майно</b>'+
                '<tr id="participants' + num_participants + '_property_info" style="display: none;">'+
                '<td>'+
                '<table>'+
                '<tr>'+
                '<td class="label grey">Назва:</td>'+
                '<td><input type="text" id="participants' + num_participants + 'property_name" name="participants[' + num_participants + '][property][data][name]" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
                '<td class="label grey">Адреса:</td>'+
                '<td><input type="text" id="participants' + num_participants + 'property_address" name="participants[' + num_participants + '][property][data][address]" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
                '<td class="label grey">Пошкодження:</td>'+
                '<td><input type="text" id="participants' + num_participants + 'property_damage" name="participants[' + num_participants + '][property][data][damage]" value="" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
                '</tr>'+
                '</table>' +
                '</td>'+
                '</tr>'+
                '<tr><td><input value="1" type="checkbox" id="participants' + num_participants + '_life" name="participants[' + num_participants + '][life][flag]" onchange="changeParticipant(this.checked, ' + num_participants + ', \'life\')"/> <b>Життя/здоров\'я</b>'+
                '<tr id="participants' + num_participants + '_life_info" style="display: none;">'+
                '<td>'+
                '<table>'+
                '<tr>'+
                '<td class="label grey">Ступінь ушкоджень:</td>'+
                '<td>'+
                '<select id="participants' + num_participants + 'life_damage_id" name="participants[' + num_participants + '][life][data][damage_id]" class="fldSelect">'+
                '<option>...</option>'+
                '<option value="1">Тимчасова втрата працездатності(травма)</option>'+
                '<option value="2">Стійка втрата працездатності(інвалідність 1 групи)</option>'+
                '<option value="3">Стійка втрата працездатності(інвалідність 2 групи)</option>'+
                '<option value="4">Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)</option>'+
                '<option value="5">Смерть</option>'+
                '<option value="6">Моральна шкода</option>'+
                '</select>'+
                '</td>' +
                '<td class="label grey">Пошкодження:</td>'+
                '<td><input type="text" id="participants' + num_participants + 'life_damage" name="participants[' + num_participants + '][life][data][damage]" value="" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
                '</tr>'+
                '</table>' +
                '</td>'+
        '</tr>'+
        '</table></tr>';

        $('#participants').append(participant);

        var i = num_participants;

        getCarTypes($('#participants' + i + 'car_car_type_id'), null, 0);

        $('#participants' + i + 'car_car_type_id').bind('change', function(event, args){
            getCarBrands($('#participants' + i + 'car_brand_id'), parseInt(this.value), null);
        });

        $('#participants' + i + 'car_brand_id').bind('change', function(event, args){
            getCarModels($('#participants' + i + 'car_model_id'), parseInt(this.value), null);
        });

        num_participants--;

        changeParticipantsRowStyle();
    }

    function changeParticipant(checked, number, type) {
        if (checked) {
            $('#participants'+number+'_'+type+'_info').show();
        } else {
            $('#participants'+number+'_'+type+'_info').hide();
        }
    }

    function changeParticipantsRowStyle() {
        for (i=0; i < document.getElementById('participants').rows.length; i++) {
            document.getElementById('participants').rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
        }
    }

    function deleteParticipant(i) {
        if (confirm('Ви дійсно бажаєте вилучити інформацію по одному з участників ДТП?')) {

            $('#participants' + i).remove();

            changeParticipantsRowStyle();
        }
    }

    function getCarServicesList(regions_id, car_types_id, car_brands_id, owner_types_id) {
        /*$.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getCarServicesJsonInWindow',
            success: function(car_services) {
                var data = {};
                data.results = car_services;
                data.length = car_services.length;
                $('#car_services_id').flexbox(data, {
                    allowInput: <?=($action == 'view' ? 0 : 1)?>,
                    width: 400,
                    paging: false,
                    maxVisibleRows: 8,
                    maxCacheBytes: 0,
                    noResultsText: 'Результатів не знайдено',
                    readOnly: <?=($action == 'view' ? 1 : 0)?>,
                    compare: function(elem){
                        return true;
                    }
                });

                <? if ($data['car_services_id'] > 0) { ?>
                    $('#car_services_id_hidden').val(<?=$data['car_services_id']?>);
                    $('#car_services_id_input').val('<?=htmlspecialchars_decode(CarServices::getTitle($data['car_services_id']))?>');
                <? } ?>
            }

        });*/
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getCarServicesJsonInWindow&regions_id='+regions_id+'&car_types_id='+car_types_id+'&car_brands_id='+car_brands_id+'&owner_types_id='+owner_types_id,
            success:    function(car_services) {
                var obj = $('select[name=car_services_id]');
                obj.empty();
                obj.append( $('<option value="0">...</option>') );
                for (i in car_services) {
                    switch (car_services[i].priority) {
                        case '1':
                            color = 'green';
                            break;
                        case '2':
                            color = 'yellow';
                            break;
                        case '3':
                            color = 'red';
                            break;
                        default:
                            color = 'whitesmoke';
                            break;
                    }

                    obj.append( $('<option style="background-color: ' + color + '" value="' + car_services[i].id + '" ' + (<?=intval($data['car_services_id'])?> == car_services[i].id ? 'selected' : '') + '>' + car_services[i].title + '</option>') );

                    showSTOaddress(parseInt(obj.val()));
                }
            }
        });
    }

    function getRegionsList() {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=ApplicationCalls|getRegionsListJsonInWindow&car_services_id=<?=intval($data['car_services_id'])?>',
            success:    function(regions) {
                obj = $('select[name=regions_id]');
                obj.append( $('<option value="0">...</option>') );
                selected = 0;
                for (i in regions) {
                    if (regions[i].is_select == 1) selected = regions[i].id;
                    obj.append( $('<option value="' + regions[i].id + '" ' + (regions[i].is_select == 1 ? 'selected' : '') + '>' + regions[i].title + '</option>') );
                }
                obj.bind('change', function(event, args){
                    getCarServicesList(this.value, $('#car_types_id option:selected').val(), $('#car_brands_id option:selected').val(), $('input[name=owner_types_id]:checked').val());
                });
                getCarServicesList(selected, <?=intval($data['car_types_id'])?>, <?=intval($data['car_brands_id'])?>, <?=intval($data['owner_types_id'])?>);
            }
        });
    }

    function save() {

        if (checkFields()) {
            eval('document.<?=$this->objectTitle?>.submit()');
        }
    }

    function download() {
        window.location = '?do=ApplicationCalls|downloadInWindow&id=<?=$data['id']?>';
    }

    var fields = {
        'input':    {
            'text':     Array('applicant_lastname', 'applicant_firstname', 'applicant_patronymicname', 'applicant_phone', 'address', 'datetime', 'datetimeTimePicker'),
            'radio':    Array('owner_types_id', 'application_risks_id', 'place')
        },
        'select':   Array('car_types_id', 'car_brands_id', 'car_models_id'),
        'textarea': Array('damage', 'description')
    }

    function checkFields() {

        $('.formError').remove();

        var count_errors = 0;

        for (type in fields) {
            if (toString.call(fields[type]) === '[object Object]') {

                for (subtype in fields[type]) {

                    for (field in fields[type][subtype]) {
                        switch (subtype) {
                            case 'text':
                                selector = 'input[name=' + fields[type][subtype][field] + ']';
                                break;
                            case 'radio':
                                selector = 'input[name=' + fields[type][subtype][field] + ']:checked';
                                break;
                            default: selector = null; break;
                        }
                        count_errors += checkField($(selector), subtype);
                    }

                }

            } else {

                for (field in fields[type]) {
                    switch (type) {
                        case 'select':
                            selector = 'select[name=' + fields[type][field] + '] option:selected';
                            break;
                        case 'textarea':
                            selector = 'textarea[name=' + fields[type][field] + ']';
                            break;
                        default: selector = null; break;
                    }
                    count_errors += checkField($(selector), type);
                }

            }
        }

        return (count_errors ? false : true);

    }

    function checkField(obj, type) {

        var error = false;

        switch (type) {
            case 'text':
            case 'textarea':
                if (obj.val() == '') error = true;
                obj = obj[0];
                break;
            case 'select':
                if (parseInt(obj.val()) < 1 || isNaN(parseInt(obj.val()))) {
                    error = true;
                    selector = obj.selector.replace(' option:selected', '');
                    obj = $(selector);
                }
                break;
            case 'radio':
                if (parseInt(obj.val()) < 1 || isNaN(parseInt(obj.val()))) {
                    error = true;
                    selector = obj.selector.replace(':checked', '');
                    obj = $(selector + ':last');
                }
                break;
            default: log('checkField. Unknown field "type": ' + type);
        }

        if (error) {
            //log(selector);
            showPrompt(obj, 'Виберіть/введіть поле.')
        }

        return error ? 1 : 0;

    }

    function showPrompt(field, promptText) {

        var prompt = $('<div id="' + field.name + 'ErrorPrompt">');
        prompt.addClass("reqformError");
        prompt.addClass("parentFormError");
        prompt.addClass("formError");

        var promptContent = $('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);
        var arrow = $('<div>').addClass("formErrorArrow");

        prompt.find(".formErrorContent").before(arrow);
        arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');

        prompt.addClass('formErrorInsideDialog');
        prompt.css({
            "opacity": 0,
            'position':'absolute'
        });
        $(field).before(prompt);

        var promptTopPosition, promptleftPosition, marginTopSize;
        promptleftPosition = $(field).position().left + $(field).width() - 30;
        promptTopPosition =  $(field).position().top +  $(field).height() + 5;
        marginTopSize = 0;

        prompt.css({
            "top": promptTopPosition,
            "left": promptleftPosition,
            "marginTop": marginTopSize,
            "opacity": 100
        });

        prompt.click(function() {
            $(this).remove();
        });

        $(field).click(function() {
            prompt.remove();
        }) ;
    }
</script>

<form style="margin: 10px;" id="<?=$this->objectTitle?>" name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF)']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=($data['id'] ? $data['id'] : -1)?>" />

    <div class="section">Сторона, що заявляє про подію від:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td><input type="radio" name="owner_types_id" value="1" <?=(($data['owner_types_id'] == 1) ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>страхувальника</b></td>
            <td><input type="radio" name="owner_types_id" value="2" <?=(($data['owner_types_id'] == 2) ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>потерпілого</b></td>
        </tr>
    </table>

    <div class="section">Час та місце пригоди:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td class="label grey" style="width: 120px;"><b>Дата та час настання:</b></td>
            <td style="width: 170px;"><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('datetime') ], $data[ 'datetime_year' ], $data[ 'datetime_month' ], $data[ 'datetime_day' ], ($data[ 'datetime_hour' ]>0 ? $data[ 'datetime_hour' ] : '00'), ($data[ 'datetime_minute' ]>0 ? $data[ 'datetime_minute' ] : '00'), 'datetime', $this->getReadonly(true))?></td>
            <td class="label grey" style="width: 50px;"><b>Адреса:</b></td>
            <td style="width: 355px;"><input type="text" name="address" value="<?=$data['address']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
        </tr>
    </table>

    <div id="blockPolicyKasko" style="display: <?=($data['owner_types_id'] == 2 ? 'none' : 'block')?>;">
        <div class="section">Договір КАСКО страхувальника:</div>
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey" style="width: 130px; text-align: left;"><b>Номер договору:</b></td>
                <td><input type="text" name="policies_kasko_number" value="<?=$data['policies_kasko_number']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><b>Державний номер ТЗ:</b></td>
                <td><input type="text" name="policies_kasko_item_sign" value="<?=$data['policies_kasko_item_sign']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><b>Страхувальник:</b></td>
                <td><input type="text" name="policies_kasko_insurer" value="<?=$data['policies_kasko_insurer']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                <td><input type="button" name="btnSearchKasko" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" value="Знайти" style="display: <?=($action == 'view' ? 'none' : 'block')?>;" /></td>
                <td><input type="button" name="btnClearKasko" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" value="Очистити" style="display: <?=($action == 'view' ? 'none' : 'block')?>;" /></td>
            </tr>
        </table>
        <div id="blockPolicyKaskoInfo"></div>
    </div>

    <div id="blockPolicyGo">
        <div class="section">Поліс ОСЦПВ страхувальника:</div>
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey" style="width: 130px; text-align: left;"><b>Серія та номер полісу:</b></td>
                <td><input type="text" name="policies_go_number" value="<?=$data['policies_go_number']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><b>Державний номер ТЗ:</b></td>
                <td><input type="text" name="policies_go_item_sign" value="<?=$data['policies_go_item_sign']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><b>Страхувальник:</b></td>
                <td><input type="text" name="policies_go_insurer" value="<?=$data['policies_go_insurer']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                <td><input type="button" name="btnSearchGo" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" value="Знайти" style="display: <?=($action == 'view' ? 'none' : 'block')?>;" /></td>
                <td><input type="button" name="btnClearGo" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" value="Очистити" style="display: <?=($action == 'view' ? 'none' : 'block')?>;" /></td>
            </tr>
        </table>
        <div id="blockPolicyGoInfo"></div>
    </div>

    <div class="section">Інформація про заявника:</div>
    <table cellpadding="5" cellspacing="0">
        <tr id="blockApplicantTypesId" style="display: <?=($action == 'view' || $data['owner_types_id'] == 2 ? 'none' : 'block')?>;">
            <td><input type="radio" name="applicant_types_id" value="1" <?=$this->getReadonly(true)?> /><b>Страхувальник</b></td>
            <td><input type="radio" name="applicant_types_id" value="2" <?=$this->getReadonly(true)?> /><b>Власник</b></td>
        </tr>
    </table>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td class="label grey"><b>Прізвище:</b></td>
            <td colspan="4"><input type="text" name="applicant_lastname" value="<?=$data['applicant_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>Ім'я:</b></td>
            <td><input type="text" name="applicant_firstname" value="<?=$data['applicant_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>По батькові:</b></td>
            <td><input type="text" name="applicant_patronymicname" value="<?=$data['applicant_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>Телефон(и):</b></td>
            <td style="width: 400px;" ><input type="text" name="applicant_phone" value="<?=$data['applicant_phone']?>" maxlength="150" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
        </tr>
    </table>

    <div class="section">Ризик:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2">
                <input type="radio" value="1" name="application_risks_id" <?=($data['application_risks_id'] == 1 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>ДТП</b>
                <input type="radio" value="2" name="application_risks_id" <?=($data['application_risks_id'] == 2 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>ПДТО</b>
                <input type="radio" value="3" name="application_risks_id" <?=($data['application_risks_id'] == 3 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>Стихійні явища</b>
                <input type="radio" value="4" name="application_risks_id" <?=($data['application_risks_id'] == 4 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>Падіння предметів</b>
                <input type="radio" value="5" name="application_risks_id" <?=($data['application_risks_id'] == 5 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>Напад тварин</b>
                <input type="radio" value="6" name="application_risks_id" <?=($data['application_risks_id'] == 6 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>Пожежа, вибух</b>
                <input type="radio" value="7" name="application_risks_id" <?=($data['application_risks_id'] == 7 ? 'checked' : '')?> <?=$this->getReadonly(true, $data['action'] == 'view')?> /><b>Незаконне заволодіння</b>
            </td>
        </tr>
    </table>

    <div class="section">Транспортний засіб страхувальника:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td class="grey"><b>Тип ТЗ:</b></td>
            <td><select id="car_types_id" name="car_types_id" class="fldSelect" value="" <?=$this->getReadonly(true)?> /></select></td>
            <td class="grey"><b>Марка:</b></td>
            <td><select id="car_brands_id" name="car_brands_id" class="fldSelect" value="" <?=$this->getReadonly(true)?> /></select></td>
            <td class="grey"><b>Модель:</b></td>
            <td><select id="car_models_id" name="car_models_id" class="fldSelect" value="" <?=$this->getReadonly(true)?> /></select></td>
        </tr>
    </table>

    <div class="section">Пошкодження:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td>
                <textarea name="damage" style="height: 100px; width: 400px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['damage']?></textarea>
            </td>
        </tr>
    </table>

    <div class="section">Опис події, обставини:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td>
                <textarea name="description" style="height: 100px; width: 400px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['description']?></textarea>
            </td>
        </tr>
    </table>

    <div class="section">Оформлення, повідомлення про подію:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td><input type="radio" name="making" value="1" <?=($data['making'] == 1 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>Європротокол</b></td>
            <td><input type="radio" name="making" value="2" <?=($data['making'] == 2 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>ДАІ</b></td>
            <td><input type="radio" name="making" value="3" <?=($data['making'] == 3 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>МВС</b></td>
            <td><input type="radio" name="making" value="4" <?=($data['making'] == 4 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>Інше</b></td>
        </tr>
    </table>
    <table cellpadding="5" cellspacing="0">
        <tr id="blockEuroprotocolInfo" style="display: <?=($data['making'] == 1 ? 'block' : 'none')?>;">
            <td class="label grey" style="width: 180px;"><b>Страхова компанія:</b></td>
            <td><input type="text" id="insurer_company" name="insurer_company" value="<?=$data['insurer_company']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>Серія поліса:</b></td>
            <td><input type="text" id="policies_series" name="policies_series" value="<?=$data['policies_series']?>" maxlength="4" class="fldText" style="width: 50px;" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>Номер поліса:</b></td>
            <td><input type="text" id="policies_number" name="policies_number" value="<?=$data['policies_number']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
        </tr>
        <tr id="blockDaiInfo" style="display: <?=($data['making'] == 2 ? 'block' : 'none')?>;">
            <td class="label grey" style="width: 180px;"><b>Причина неповідомлення ДАІ:</b></td>
            <td colspan="5">
                <textarea name="dai_reason" style="height: 100px; width: 400px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['dai_reason']?></textarea>
            </td>
        </tr>
        <tr id="blockMvsInfo" style="display: <?=($data['making'] == 3 ? 'block' : 'none')?>;">
            <td class="label grey" style="width: 180px;"><b>Причина неповідомлення МВС:</b></td>
            <td colspan="5">
                <textarea name="mvs_reason" style="height: 100px; width: 400px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['mvs_reason']?></textarea>
            </td>
        </tr>
        <tr id="blockOtherInfo" style="display: <?=($data['making'] == 4 ? 'block' : 'none')?>;">
            <td class="label grey" style="width: 180px;"><b>Інше:</b></td>
            <td colspan="5">
                <textarea name="other_reason" style="height: 100px; width: 400px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['other_reason']?></textarea>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="label grey" style="width: 180px;"><b>Виклик швидкої допомоги:</b></td>
            <td colspan="5">
                <input type="radio" name="ambulance" value="1" <?=($data['ambulance'] == 1 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>так</b>
                <input type="radio" name="ambulance" value="2" <?=($data['ambulance'] == 2 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>ні</b>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="label grey" style="width: 180px;"><b>З місця пригоди:</b></td>
            <td colspan="5">
                <input type="radio" name="place" value="1" <?=($data['place'] == 1 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>так</b>
                <input type="radio" name="place" value="2" <?=($data['place'] == 2 ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>ні</b>
            </td>
        </tr>
        <tr id="blockPlaceAddressInfo" style="display: <?=($data['place'] == 2 ? 'block' : 'none')?>">
            <td><b>Адреса:</b></td>
            <td><input type="text" name="place_address" value="<?=$data['place_address']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
        </tr>
    </table>

    <div class="section">Водій на момент ДТП:</div>
    <table cellpadding="5" cellspacing="0">
        <tr style="display: <?=($action == 'view' ? 'none' : 'block')?>;">
            <td id="driver_types_id1" style="display: <?=($data['owner_types_id'] == 2 ? 'none' : 'block')?>"><input type="radio" name="driver_types_id" value="1" <?=$this->getReadonly(true)?> /><b>Страхувальник</b></td>
            <td id="driver_types_id2" style="display: <?=($data['owner_types_id'] == 2 ? 'none' : 'block')?>"><input type="radio" name="driver_types_id" value="2" <?=$this->getReadonly(true)?> /><b>Власник</b></td>
            <td><input type="radio" name="driver_types_id" value="3" <?=$this->getReadonly(true)?> /><b>Заявник</b></td>
            <td><input type="radio" name="driver_types_id" value="4" <?=$this->getReadonly(true)?> /><b>Без водія</b></td>
        </tr>
    </table>
    <table cellpadding="5" cellspacing="0" id="blockDriverInfo">
        <tr>
            <td class="label grey"><b>Прізвище:</b></td>
            <td colspan="4"><input type="text" name="driver_lastname" value="<?=$data['driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>Ім'я:</b></td>
            <td colspan="2"><input type="text" name="driver_firstname" value="<?=$data['driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>По батькові:</b></td>
            <td><input type="text" name="driver_patronymicname" value="<?=$data['driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
            <td class="label grey"><b>Телефон(и):</b></td>
            <td style="width: 400px;" ><input type="text" name="driver_phone" value="<?=$data['driver_phone']?>" maxlength="150" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
        </tr>
    </table>

    <div class="section">Інші учасники: <? if($action != 'view') { ?><a href="javascript: addParticipant()"><img src="/images/administration/navigation/add_over.gif" alt="Додати" width="19" height="19"></a><? } ?></div>
    <table id="participants" cellpadding="0" cellspacing="0">
    <?
    if (is_array($data['participants'])) {
        $i=0;
        foreach ($data['participants'] as $row) {//echo "<script>participants_cars[" . $i . "] = new Array('" . $row['car']['data']['car_type_id'] . "', '" . $row['car']['data']['brand_id'] . "', '" . $row['car']['data']['model_id'] ."');</script>\r\n";
            ?>
            <tr id="participants<?=$i?>">
                <td>
                    <table>
                        <tr>
                            <td style="text-align: left;" class="label grey">Прізвище, ім'я, по батькові:<input type="text" id="participants<?=$i?>_name" name="participants[<?=$i?>][name]" value="<?=$row['name']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> />
                            &nbsp;&nbsp;&nbsp;Телефон:<input type="text" id="participants<?=$i?>_phone" name="participants[<?=$i?>][phone]" value="<?=$row['phone']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                        </tr>
                        <tr><td colspan="2"><input value="1" <?=($row['car']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="participants<?=$i?>_car" name="participants[<?=$i?>][car][flag]" onchange="changeParticipant(this.checked, <?=$i?>, 'car')" <?=$this->getReadonly(true)?> /> <b>Транспортний засіб</b>
                        <tr id="participants<?=$i?>_car_info" style="display: <?=($row['car']['flag'] == 1 ? 'block' : 'none')?>;">
                            <td>
                                <table cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td class="grey">Тип ТЗ:</td>
                                        <td><select id="participants<?=$i?>car_car_type_id" name="participants[<?=$i?>][car][data][car_type_id]" class="fldSelect" value="" <?=$this->getReadonly(true)?> ></select></td>
                                        <td class="grey">Марка:</td>
                                        <td><select id="participants<?=$i?>car_brand_id" name="participants[<?=$i?>][car][data][brand_id]" class="fldSelect" value="" <?=$this->getReadonly(true)?> ></select></td>
                                        <td class="grey">Модель:</td>
                                        <td><select id="participants<?=$i?>car_model_id" name="participants[<?=$i?>][car][data][model_id]" class="fldSelect" value="" <?=$this->getReadonly(true)?> ></select></td>
                                        <td class="label grey">Державний знак:</td>
                                        <td><input type="text" id="participants<?=$i?>car_sign" name="participants[<?=$i?>][car][data][sign]" value="<?=$row['car']['data']['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                                    </tr>
                                    <tr>
                                        <td class="label grey">Пошкодження:</td>
                                        <td colspan="9"><input type="text" id="participants<?=$i?>car_damage" name="participants[<?=$i?>][car][data][damage]" value="<?=$row['car']['data']['damage']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td><input value="1" <?=($row['property']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="participants<?=$i?>_property" name="participants[<?=$i?>][property][flag]" onchange="changeParticipant(this.checked, <?=$i?>, 'property')" <?=$this->getReadonly(true)?> /> <b>Майно</b>
                        <tr id="participants<?=$i?>_property_info" style="display: <?=($row['property']['flag'] == 1 ? 'block' : 'none')?>;">
                            <td>
                                <table>
                                    <tr>
                                        <td class="label grey">Назва:</td>
                                        <td><input type="text" id="participants<?=$i?>property_name" name="participants[<?=$i?>][property][data][name]" value="<?=$row['property']['data']['name']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                                        <td class="label grey">Адреса:</td>
                                        <td><input type="text" id="participants<?=$i?>property_address" name="participants[<?=$i?>][property][data][address]" value="<?=$row['property']['data']['address']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                                        <td class="label grey">Пошкодження:</td>
                                        <td><input type="text" id="participants<?=$i?>property_damage" name="participants[<?=$i?>][property][data][damage]" value="<?=$row['property']['data']['damage']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td><input value="1" <?=($row['life']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="participants<?=$i?>_life" name="participants[<?=$i?>][life][flag]" onchange="changeParticipant(this.checked, <?=$i?>, 'life')" <?=$this->getReadonly(true)?> /> <b>Життя/здоров'я</b>
                        <tr id="participants<?=$i?>_life_info" style="display: <?=($row['life']['flag'] == 1 ? 'block' : 'none')?>;">
                            <td>
                                <table>
                                    <tr>
                                        <td class="label grey">Ступінь ушкоджень:</td>
                                        <td>
                                            <select id="participants<?=$i?>life_damage_id" name="participants[<?=$i?>][life][data][damage_id]" class="fldSelect" <?=$this->getReadonly(true)?> >
                                                <option>...</option>
                                                <option value="1" <?=($row['life']['data']['damage_id'] == 1 ? 'selected' : '')?>>Тимчасова втрата працездатності(травма)</option>
                                                <option value="2" <?=($row['life']['data']['damage_id'] == 2 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 1 групи)</option>
                                                <option value="3" <?=($row['life']['data']['damage_id'] == 3 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 2 групи)</option>
                                                <option value="4" <?=($row['life']['data']['damage_id'] == 4 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)</option>
                                                <option value="5" <?=($row['life']['data']['damage_id'] == 5 ? 'selected' : '')?>>Смерть</option>
                                                <option value="6" <?=($row['life']['data']['damage_id'] == 6 ? 'selected' : '')?>>Моральна шкода</option>
                                            </select>
                                        </td>
                                        <td class="label grey">Пошкодження:</td>
                                        <td><input type="text" id="participants<?=$i?>life_damage" name="participants[<?=$i?>][life][data][damage]" value="<?=$row['life']['data']['damage']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <? if ($this->mode == 'update') {?><td><a href="javascript: deleteParticipant(<?=$i?>)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
            </tr>
            <?

            echo "
                <script>
                    getCarTypes($('#participants' + $i + 'car_car_type_id'), {'car_types_id': " . intval($row['car']['data']['car_type_id']) . ", 'brands_id': " . intval($row['car']['data']['brand_id']) . ", 'models_id': " . intval($row['car']['data']['model_id']) . "}, 0);

                    $('#participants' + $i + 'car_car_type_id').bind('change', function(event, args){
                        getCarBrands($('#participants' + $i + 'car_brand_id'), parseInt(this.value), args);
                    });

                    $('#participants' + $i + 'car_brand_id').bind('change', function(event, args){
                        getCarModels($('#participants' + $i + 'car_model_id'), parseInt(this.value), args);
                    });
                </script>
            ";

            $i++;
        }
    }
    ?>
    </table>

    <div class="section">Пункт прийому заяви:</div>
    <table cellpadding="5" cellspacing="0">
        <tr id="generalAgencie">
            <td>
                <b>Головна агенція:</b>
            </td>
            <td colspan="8">
                <input readonly type="text" size="47" name="generalAgencieName" value="" <?=$this->getReadonly(true)?> >
            </td>
        </tr>
        <tr>
            <td>
                <b>Регіон:</b>
            </td>
            <td>
                <select name="regions_id" class="fldSelect" <?=$this->getReadonly(true)?> ></select>
            </td>
            <td>
                <b>Пункт:</b>
            </td>
            <td>
                <select name="car_services_id" class="fldSelect" <?=$this->getReadonly(true)?> ></select>
                <!--div id="car_services_id"></div-->
            </td>
            <td>
                <b>Працівник:</b>
            </td>
            <td>
                <select name="car_services_workers" class="fldSelect" <?=$this->getReadonly(true)?> ></select>
            </td>
            <td id="car_services_workers_phone">
            </td>
            <td id="sign_agency_title_dest"></td>
        </tr>
        <tr>
            <td>
                <b>Адреса пункту прийому:</b>
            </td>
            <td colspan="8">
                <input readonly type="text" size="47" name="car_service_adress" value="" <?=$this->getReadonly(true)?> >
            </td>
    </table>

    <div class="section">Коментар:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td>
                <textarea name="comment" style="height: 100px; width: 400px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['comment']?></textarea>
            </td>
        </tr>
    </table>

    <div class="section">Інші параметри:</div>
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td class="label grey"><b>ІД дзвінка:</b></td>
            <td>
                <input type="text" name="calls_id" value="<?=$data['calls_id']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?>></textarea>
            </td>
        </tr>
    </table>

    <? if ($data['id']) { ?>
        <input onclick="download()" name="btn_save" type="button" value=" Скачати " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
    <? } ?>
    <input onclick="save()" name="btn_save" type="button" value=" Зберегти " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />

</form>