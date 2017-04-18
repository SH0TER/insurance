<style type="text/css">
    .ac_results {
	padding: 0px;
	border: 1px solid WindowFrame;
	background-color: Window;
	overflow: hidden;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results iframe {
	display:none;/*sorry for IE5*/
	display/**/:block;/*sorry for IE5*/
	position:absolute;
	top:0;
	left:0;
	z-index:-1;
	filter:mask();
	width:3000px;
	height:3000px;
}

.ac_results li {
	position:relative;
    margin: 0px;
	padding: 2px 5px;
	cursor: pointer;
	display: block;
	width: 100%;
	font: menu;
	font-size: 12px;
	overflow: hidden;
}

.ac_loading {
	background : Window url('autocomplete_indicator.gif') right center no-repeat;
}

.ac_over {
	background-color: Highlight;
	color: HighlightText;
}
</style>
<script type="text/javascript">

    var cars = new Array();
    var types = new Array();
    var owner_car = new Array();

    <? if (!ereg('view', $action)) { ?>
        getCarTypes();
        getCar();
    <? } ?>
	
	function checkInsurerApplication() {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			async:		false,
			data:		'do=Accidents|checkInsurerApplicationInWindow' +
						'&product_types_id=<?=PRODUCT_TYPES_GO?>' +
						'&accidents_date=' + $('input[name=datetime]').val() +
						'&policies_id=' + $('input[name=policies_id]').val(),
			success: function(result) {
				if (result.state == 1) {
					$('#info_messages').html(result.message);				
					$('#info_messages').show();
					document.location = "#message";
				}
				else $('#info_messages').hide();
			}
		});
	}

    function searchPolicy() {
        if ($('#policies_number').val() ||
            $('#insurer_lastname').val() ||
            $('#insurer_passport_series').val() ||
            $('#insurer_passport_number').val() ||
            $('#insurer_identification_code').val() ||
            $('#shassi').val() ||
            $('#sign').val()) {
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Policies|getSearchInWindow' +
                                '&accidents_date=' + $('input[name=datetime]').val() +
								'&product_types_id=<?=$this->product_types_id?>' +
								'&policies_id=<?=$data['policies_id']?>' +
								'&accidents_id=<?=$data['id']?>' +
								'&number=' + $('input[name=policies_number]').val() +
								'&date=' + $('input[name=policies_date_year]').val() + '.' + $('input[name=policies_date_month]').val() + '.' + $('input[name=policies_date_day]').val() +
								'&insurer_lastname=' + $('input[name=insurer_lastname]').val() +
								'&insurer_passport_series=' + $('input[name=insurer_passport_series]').val() +
								'&insurer_passport_number=' + $('input[name=insurer_passport_number]').val() +
								'&insurer_identification_code=' + $('input[name=insurer_identification_code]').val() +
                                '&important_person=<?=$data['important_person']?>' +
								'&shassi=' + $('input[name=shassi]').val() +
								'&sign=' + $('input[name=sign]').val(),
					success: function(result) {
						$('#policies').html(result);
                        $('input[name=count_items_id]').val($('input[name=policies_id]').size() - 1);
					}
				});
        }
    }

    function checkFields() {
        if($('select[name=companies_id] option:selected').val() == 4) {
            if (!$('input[name=policies_id]:checked').val()) {
                alert('Необхідно вибрати договір страхування!');
                return false;
            }
        }
		
        return true;
    }

	function setPolicyValues(sourcePerson, destinitionPerson) {

		if ($('input[name=policies_id]:checked').val() > 0) {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Policies|getApplicantValuesInWindow' +
							'&product_types_id=<?=$this->product_types_id?>' +
							'&id=' + $('input[name=policies_id]:checked').val() +
							'&person=' + sourcePerson,
				success: function(result) {
					switch (destinitionPerson) {
						case 'owner':
							$('input[name=applicant_lastname]').val( result.lastname );
							$('input[name=applicant_firstname]').val( result.firstname );
							$('input[name=applicant_patronymicname]').val( result.patronymicname );
							$('select[name=applicant_regions_id] [value=' + result.regions_id + ']').attr('selected', 'selected');
							$('input[name=applicant_area]').val( result.area );
							$('input[name=applicant_city]').val( result.city );
							$('select[name=applicant_street_types_id] [value=' + result.street_types_id + ']').attr('selected', 'selected');
							$('input[name=applicant_street]').val( result.street );
							$('input[name=applicant_house]').val( result.house );
							$('input[name=applicant_flat]').val( result.flat );
							$('input[name=applicant_phones]').val( result.phone );
							break;
						case 'driver':
							$('input[name=driver_lastname]').val( result.lastname );
							$('input[name=driver_firstname]').val( result.firstname );
							$('input[name=driver_patronymicname]').val( result.patronymicname );
							$('input[name=driver_licence_series]').val( result.driver_licence_series );
							$('input[name=driver_licence_number]').val( result.driver_licence_number );
							$('input[name=driver_licence_date]').val( result.driver_licence_date );
							$('input[name=driver_licence_date_year]').val( result.driver_licence_date_year );
							$('input[name=driver_licence_date_month]').val( result.driver_licence_date_month );
							$('input[name=driver_licence_date_day]').val( result.driver_licence_date_day );
							break;
					}
				}
			});
		} else {
			alert('Необхідно визначитись з об\'єктом страхування.');
		}
	}

	function setRisks(application_risks_id) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=Policies|getRisksInWindow' +
						'&id=' + $('#policies_id').val() +
						'&accidents_id=<?=$data['id']?>' +
						'&application_risks_id=' + application_risks_id + 
						'&types_id=<?=$data['types_id']?>' +
						'&consequences=<?=(is_array($data['consequences'])) ? array_sum($data['consequences']) : $data['consequences']?>',
			success: function(result) {
				$('#risks').html( result );
			}
		});
	}

	function choosePolicy(policies_id) {
		//$('#policies_id').val( policies_id );
        $('input[name=policies_id]').val(policies_id);
		setRisks( $('input[name=application_risks_id]:checked').val() );
	}

    function showHideMVSBlock() {
		switch ($('select[name=mvs] option:selected').val()) {
			case '1'://Органи ГАИ
				$('#dai').css('display', 'block');
				$('#rugu').css('display', 'none');
                $('#mvsNo').css('display', 'none');
				$('#mvsYes').css('display', 'block');
				break;
			case '2':
                $('#mvsYes').css('display', 'none');
                $('#mvsNo').css('display', 'block');
                break;
			default:
				$('#mvsYes').css('display', 'none');
                $('#mvsNo').css('display', 'none');
				break;
		}
    }

    function showHideAssistanceBlock() {
        if ($('input[name=assistance]:checked').val() == '1') {
            $('#assistanceYes').css('display', 'block');
            $('#assistanceNo').css('display', 'none');
        } else {
            $('#assistanceYes').css('display', 'none');
            $('#assistanceNo').css('display', 'block');
        }
    }

	function showHideAssistanceDate() {
        if ($('input[name=assistance_place]:checked').val() == '1') {
            $('#assistance_dateBlock').css('display', 'none');
		} else {
            $('#assistance_dateBlock').css('display', 'block');
		}
	}

    <? if ($Authorization->data['roles_id'] != ROLES_MASTER) {?>
    <?=CarServices::getJavaScriptArray()?>
    function changeCarServiceForMasters(masters_id) {
        var car_services_id = $('[name="car_services_id"] option:selected').val();
        var master = document.getElementById('masters_id');
		master.options.length = 0;

        for (var i=0; i < masters.length; i++) {
            if (car_services_id == masters[ i ][ 0 ] ) {
                for (var j=0; j < masters[ i ][ 1 ].length; j++) {
                    master.options[ j ] = new Option( masters[ i ][ 1 ][ j ][ 1 ], masters[ i ][ 1 ][ j ][ 0 ]);

                    if (masters_id == masters[ i ][ 1 ][ j ][ 0 ]) {
                        master.selectedIndex = j;
                    }
                }
				break;
            }
		}
    }
    function changeCarServiceForInspecting(inspecting_master_id) {
        var car_services_id = $('[name="car_services_id"] option:selected').val();
        var inspecting_master = document.getElementById('inspecting_master');
        inspecting_master.options.length = 0;
        for (var i=0; i < masters.length; i++) {
            if (car_services_id == masters[ i ][ 0 ] ) {
                for (var j=0; j < masters[ i ][ 1 ].length; j++) {
                    inspecting_master.options[ j ] = new Option( masters[ i ][ 1 ][ j ][ 1 ], masters[ i ][ 1 ][ j ][ 0 ]);
                    if (inspecting_master_id == masters[ i ][ 1 ][ j ][ 0 ]) {
                        inspecting_master.selectedIndex = j;
                    }
                }
				break;
            }
		}
    }
    <? } ?>

	function changeDocumentsRowStyle() {
		for (i=0; i < document.getElementById('documents').rows.length; i++) {
			document.getElementById('documents').rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

    var num2 = -1;

    function addDocument() {
    	$('#documents').append('<tr><td><input type="text" name="document[' + num2 + ']" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td><td width="30"><a href="#" onclick="deleteDocument(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');

		changeDocumentsRowStyle();
        num2--;
    }

    function deleteDocument(obj) {
        if (confirm('Ви дійсно бажаєте вилучити документ?')) {
            document.getElementById('documents').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            changeDocumentsRowStyle();
        }
    }

    function changeInsuranceCompany() {
		if ($('select[name=companies_id] option:selected').val() != 4){
			//$('#search_button').hide();
			$('#missing_data').show();
			$('#policies').html('');
		} else{
			$("#search_button").show();
			$("#missing_data").hide();
		}
    }
    function showHideBlockBySelector(selector, action) {
        switch(action){
            case 'show':
                $(selector).css('display', '');
                break;
            case 'hide':
                $(selector).css('display', 'none');
                break;
        }
    }
    function showHideBlocksByDataAction(action) {
        switch(action) {
            case 'insert' :
            case 'update' :
                if(typeof($('input[name=owner_types_id]:checked').val()) == 'undefined' && action == 'insert') {
                        showHideBlockBySelector('#applicant', 'hide');
                }
                $('input[name=owner_types_id]').click(function(){
                    if($('input[name=owner_types_id]:checked').val() == '1') {    //власник = страхуальник
                        showHideBlockBySelector('#applicant','show');
                        showHideBlockBySelector('#owner_property','hide');

                    }
                    else if($('input[name=owner_types_id]:checked').val() == '2') { //власник = потерпілий
                         showHideBlockBySelector('#applicant','show');
                        showHideBlockBySelector('#owner_property', 'show');
                    }
                });
                break;
            case 'view' :
                switch('<?=$data['owner_types_id']?>') {
                    case '1':
                        showHideBlockBySelector('#driver','hide');
                        showHideBlockBySelector('#owner','hide');
                        showHideBlockBySelector('#applicant','show');
                        showHideBlockBySelector('#owner_property','hide');
                        break;
                    case '2':
                        showHideBlockBySelector('#driver','show');
                        showHideBlockBySelector('#owner','hide');
                        break;
                }

                break;
        }
    }
    function setApplicantValues() {

		$('input[name=applicant_lastname]').val( $('input[name=owner_lastname]').val() );
		$('input[name=applicant_firstname]').val( $('input[name=owner_firstname]').val() );
		$('input[name=applicant_patronymicname]').val( $('input[name=owner_patronymicname]').val() );
	    $('select[name=applicant_regions_id] [value=' + $('select[name=owner_regions_id] option:selected').val() + ']').attr('selected', 'selected');
		$('input[name=applicant_area]').val( $('input[name=owner_area]').val() );
	    $('input[name=applicant_city]').val( $('input[name=owner_city]').val() );
		$('select[name=applicant_street_types_id] [value=' +$('select[name=owner_street_types_id] option:selected').val() + ']').attr('selected', 'selected');
		$('input[name=applicant_street]').val( $('input[name=owner_street]').val() );
		$('input[name=applicant_house]').val( $('input[name=owner_house]').val() );
		$('input[name=applicant_flat]').val( $('input[name=owner_flat]').val() );
		$('input[name=applicant_phones]').val( $('input[name=owner_phones]').val() );
    }
    function setDisplayBlocks() {
        $('select[name=companies_id] option:last').attr('selected','selected');
        showHideBlockBySelector('.insurer_link', 'hide');
        if($('input[name=owner_types_id]:checked').val() == '1') {    //проверка, когда форма не отправилась по валидации
            showHideBlockBySelector('#owner', 'hide');
            showHideBlockBySelector('#driver','hide');
            showHideBlockBySelector('.insurer_link', 'show');
        }
        //в зависмиости от действия apdate/insert/view прячем\показываем блоки
        showHideBlocksByDataAction('<?=$action?>');
        showHideBlockBySelector('#driver','hide');
    }
    function driverDocumentsAutoComplete() {
        $("#driver_document").autocompleteArray([
            "Свідоцтва про реєстрацію ТЗ",
            "Тимчасового реєстраційного талону ДАП №",
            "Подорожнього листа №"
        ],
            {
                delay:10,
                minChars:1,
                matchSubset:1,
                autoFill:true,
                maxItemsToShow:10
            }
        );
    }

    $(document).ready(function(){

        $('input[name=count_items_id]').val($('input[name=policies_id]').size() - 1);
        setDisplayBlocks();
        changeInsuranceCompany();
        driverDocumentsAutoComplete();
        $('select[name=companies_id]').change(function(){
           changeInsuranceCompany()
        });
        $('select[name=application_risks_id]').click(function() {
            if($('select[name=application_risks_id] option:selected').val() == '2') {
                $("#damage_extent").css('display','');
                $("#car").css('display','none');
                $("#property_type").css('display','none');
            }
            else if($('select[name=application_risks_id] option:selected').val() == '1'){
                $("#damage_extent").css('display','none');
                $('select[name=property_types_id]').click(function(){
                    if($('select[name=property_types_id] option:selected').val() == '1') {
                        $("#property").css('display','none');
                        $("#car").css('display','');
                    }
                    else if($('select[name=property_types_id] option:selected').val() == '2'){
                        $("#car").css('display','none');
                        $("#property").css('display','');
                    }
                });

                $("#property_type").css('display','');
            }

        });
        $("#applicant_insurer").click(function(){
            $(".insurer_link").css('display','');
            $(".owner_link").css('display','none');
        });
        $("#applicant_victim").click(function(){
            $(".insurer_link").css('display','none');
            $(".owner_link").css('display','');
            $(".applicant").each(function(){
                 this.value = '';
             });
        });
    });

    function setTypesCars(id){
        var car_types = document.getElementById(id);
        car_types.options.length = 0;
        car_types.options[0] = new Option ('...', '-1');
        for (var i=0; i < types.length; i++){
            car_types.options[i+1] = new Option (types[i][1], types[i][0]);
        }
    }

    function setBrandsCars(id){
        var car_types = document.getElementById(id);
        var brands = document.getElementById(id.replace('car_type_id', 'brand_id'));
        var models = document.getElementById(id.replace('car_type_id', 'model_id'));
        brands.options.length = 0;
        models.options.length = 0;
        document.getElementById(id.replace('car_type_id', 'brand')).value = '';
        document.getElementById(id.replace('car_type_id', 'model')).value = '';
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
        var car_types = document.getElementById(id.replace('brand_id', 'car_type_id'));
        var models = document.getElementById(id.replace('brand_id', 'model_id'));
        document.getElementById(id.replace('brand_id', 'brand')).value = brands[brands.selectedIndex].text;
        document.getElementById(id.replace('brand_id', 'model')).value = '';
        models.options.length = 0;
        models.options[0] = new Option ('...', '-1');
        for (var i=0; i < cars.length; i++) {
            if (cars[ i ][ 0 ] == car_types[car_types.selectedIndex].value) {
                for (var j=0; j < cars[ i ][ 1 ].length; j++) {
                    if (cars[ i ][ 1 ][ j ][ 0 ] == brands[brands.selectedIndex].value) {
                        for (var k=0; k < cars[ i ][ 1 ][ j ][ 2 ].length; k++) {
                            models.options[k+1] = new Option( cars[ i ][ 1 ][ j ][ 2 ][ k ][ 1 ], cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ]);
                            /*if (cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ] == models[models.selectedIndex].value) {
                                model.selectedIndex = k;
                            }*/
                        }
                        break;
                    }
                }
            }
        }
    }

    function setModelTitle(id){
        var models = document.getElementById(id);
        document.getElementById(id.replace('model_id', 'model')).value = models[models.selectedIndex].text;
    }

    function getCarTypes() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarTypes|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>',
            success:    function (result){}
        });
    }

    function getCar() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>',
            success:    function (result) {
                            if (owner_car.length) {
                                $("#owner_car_type_id").val(owner_car[0]);
                                setBrandsCars("owner_car_type_id");
                                $("#owner_brand_id").val(owner_car[1]);
                                setModelsCars("owner_brand_id");
                                $("#owner_model_id").val(owner_car[2]);
								setModelTitle("owner_model_id");
                            }
                    
            }
        });
    }
</script>
<? $Log->showSystem();
        if (intval($data['id'])){
            echo "<script>owner_car = new Array('" . $data['owner_car_type_id'] . "', '" . $data['owner_brand_id'] . "', '" . $data['owner_model_id'] ."');</script>\r\n";
        }
?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF)']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields();">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="action" value="<?=$action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
    <input type="hidden" name="parent_id" value="<?=$data['parent_id']?>" />
    <input type="hidden" name="child_id" value="<?=$data['child_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$this->product_types_id?>" />
    <input type="hidden" name="payment_statuses_id" value="<?=$data['payment_statuses_id']?>" />
    <input type="hidden" name="owner_types_id" value="<?=$data['owner_types_id']?>" />
    <input type="hidden" name="mvs" value="<?=$data['mvs']?>" />
    <input type="hidden" name="count_items_id" />	
    <? include_once 'Accidents/monitoring.php'?>
    <div id="comments"></div>

    <div class="section">Обставини пригоди:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey" style="width: 120px;"><?=$this->getMark()?>Дата та час настання:</td>
		<td style="width: 170px;"><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('datetime') ], $data[ 'datetime_year' ], $data[ 'datetime_month' ], $data[ 'datetime_day' ], $data[ 'datetime_hour' ], $data[ 'datetime_minute' ], 'datetime', $this->getReadonly(true))?></td>
		<td class="label grey" style="width: 50px;"><?=$this->getMark()?>Адреса:</td>
		<td style="width: 355px;"><input type="text" name="address" value="<?=$data['address']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
	</tr>
	<tr>
		<td class="label grey"><?=$this->getMark()?>Обставини:</td>
		<td colspan="3"><textarea name="description" style="height: 100px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['description']?></textarea></td>
	</tr>
	<tr>
		<td class="label grey"><?=$this->getMark()?>Місце знаходження ТЗ:</td>
		<td colspan="3"><input type="text" name="location" value="<?=$data['location']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table>

	<div class="section">Поліс:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
        <td class="label grey">Назва компанії:</td>
        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('companies_id') ], $data['companies_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
		<td class="label grey">Поліс:</td>
		<td><input type="text" id="policies_number" name="policies_number" value="<?=$data['policies_number']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Дата:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policies_date') ], $data['policies_date_year' ], $data['policies_date_month' ], $data['policies_date_day' ], 'policies_date', $this->getReadonly(true))?></td>
	</tr>
	</table>

	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey">Страхувальник:</td>
		<td><input type="text" id="insurer_lastname" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Паспорт:</td>
		<td>
			<input type="text" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
			<input type="text" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
		</td>
		<td class="label grey">ІПН:</td>
		<td><input type="text" id="insurer_identification_code" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
		<? if ($this->mode == 'update') { ?><td><input type="button" id="search_button" value="Знайти" onclick="searchPolicy()" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td><? } ?>
	</tr>
	</table>

	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey">Водійські права:</td>
		<td>
			<input type="text" id="insurer_driver_licence_series" name="insurer_driver_licence_series" value="<?=$data['insurer_driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
			<input type="text" id="insurer_driver_licence_number" name="insurer_driver_licence_number" value="<?=$data['insurer_driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
		</td>
		<td class="label grey">Державний знак:</td>
		<td><input type="text" id="sign" name="sign" value="<?=$data['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
        <td class="label grey">Державний знак:</td>
		<td><input type="text" id="shassi" name="shassi" value="<?=$data['shassi']?>" maxlength="20" style="width:175px;" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table>
	<table id="missing_data" cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey">Марка:</td>
		<td><input type="text" id="brand" name="brand" value="<?=$data['brand']?>" maxlength="20" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Модель:</td>
		<td><input type="text" id="model" name="model" value="<?=$data['model']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table><br />
	<div id="policies"></div>
    <div class="caption bottom section" style="margin-top: 30px;"><?$this->showApplicantTabs($data,$action)?></div>
    <table cellpadding="2" cellspacing="3" width="100%">
    <tr>
    <td>
     <!--------------Власник------------------>
    <div class="section" id="owner" style="display: <?=($action == 'insert') ? 'block' : 'none'?>">Власник, якому заподіяно шкоду:&nbsp;<span class="links"><?if($action =='insert'){?>Потерпілий<input type="radio" id="applicant_victim" name="owner_types_id" value="2" <?=($data['owner_types_id'] == 2) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />Страхувальник<input onclick="checkInsurerApplication();" type="radio" name="owner_types_id" value="1" id="applicant_insurer" <?=($data['owner_types_id'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /><?}?></span></div>

     <!---------------Заявник----------------->
            <div id="applicant">
            <div class="section">Заявник: <?if($action =='insert'){?><a href="javascript: setPolicyValues('insurer', 'owner')" style="color: red;" class="insurer_link">Є страхувальником</a><?}?></div>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
                <td><input type="text" name="applicant_lastname" value="<?=$data['applicant_lastname']?>" maxlength="50" class="fldText lastname applicant" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
                <td><input type="text" name="applicant_firstname" value="<?=$data['applicant_firstname']?>" maxlength="50" class="fldText firstname applicant" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><?=$this->getMark()?>По батькові:</td>
                <td><input type="text" name="applicant_patronymicname" value="<?=$data['applicant_patronymicname']?>" maxlength="50" class="fldText patronymicname applicant" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0" id="owner_property">
            <tr>
                <td>Заподіяно шкоду
                <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('application_risks_id') ], $data[ 'application_risks_id' ], $data['languageCode'], $this->getReadonly(true) . ' onchange="setBrandsCars(this.id)"', null, $data)?></td>
                <td><div id="property_type" style="display: <?=($data['application_risks_id'] == 1) ? 'block' : 'none'?>"><lable class="label grey">Тип пошкодженого майна</lable><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('property_types_id') ], $data['property_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></div></td>
                <td><div id="damage_extent" style="display: <?=($data['application_risks_id'] == 2) ? 'block' : 'none'?>"><lable class="label grey">Ступінь ушкоджень</lable><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('damage_extent_id') ], $data['damage_extent_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></div></td>
            </tr>
            <tr>
                <td colspan="3">
                    <table cellpadding="5" cellspacing="0">
                        <tr id = "car" style="display: <?=($data['property_types_id'] == 1) ? 'block' : 'none'?>">
                            <td class="label grey"><?=$this->getMark()?>Тип ТЗ:</td>
                            <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_car_type_id') ], $data[ 'owner_car_type_id' ], $data['languageCode'], $this->getReadonly(true) . ' onchange="setBrandsCars(this.id)"', null, $data)?></td>
                            <td class="label grey"><?=$this->getMark()?>Марка ТЗ:
                                <select id="owner_brand_id" name="owner_brand_id" value="" onchange="setModelsCars(this.id)" class="owner fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$data['owner_brands_id'].'">'.$data['owner_brand'].'</option>';}?></select>
                                <input type="hidden" id="owner_brand" name="owner_brand" value="" />
                            </td>
                            <td class="label grey"><?=$this->getMark()?>Модель ТЗ:
                                <select id="owner_model_id"  name="owner_model_id" value="this[this.selectedIndex].value" onchange="setModelTitle(this.id)" class="owner fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$data['owner_models_id'].'">'.$data['owner_model'].'</option>';}?></select>
                                <input type="hidden" id="owner_model" name="owner_model" value="" />
                            </td>
                            <td class="label grey"><?=$this->getMark()?>Номер ТЗ:</td>
                            <td><input type="text" id="owner_sign" name="owner_sign" value="<?=$data['owner_sign']?>" class="owner fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td nowrap="1"><div id="property" style="display: <?=($data['property_types_id'] == 2) ? 'block' : 'none'?>"><lable class="label grey"><?=$this->getMark()?>Назва майна</lable><input type="text" name="property" value="<?=$data['property']?>" class="owner fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></div></td>
            </tr>
        </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark(false)?>Область:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('applicant_regions_id') ], $data['applicant_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                <td class="label grey">Район:</td>
                <td><input type="text" name="applicant_area" value="<?=$data['applicant_area']?>" maxlength="50" class="fldText city applicant" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark(false)?>Місто:</td>
                <td><input type="text" name="applicant_city" value="<?=$data['applicant_city']?>" maxlength="50" class="fldText city applicant" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark(false)?>Вулиця:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('applicant_street_types_id') ], $data['applicant_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="applicant_street" value="<?=$data['applicant_street']?>" maxlength="50" class="fldText street applicant" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark(false)?>Будинок:</td>
                <td><input type="text" name="applicant_house" value="<?=$data['applicant_house']?>" maxlength="15" class="fldText house applicant" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">Квартира:</td>
                <td><input type="text" name="applicant_flat" value="<?=$data['applicant_flat']?>" maxlength="10" class="fldText flat applicant" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Телефон(и):</td>
                <td><input type="text" name="applicant_phones" value="<?=$data['applicant_phones']?>" maxlength="50" class="fldText applicant" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
            </tr>
            </table>
            </div>

    <div class="section">Опис пошкоджень:</div>
    <table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Опис пошкоджень ТЗ винуватця::</td>
		<td colspan="3" style="width:500px;"><textarea name="damage" style="height: 100px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['damage']?></textarea></td>
	</tr>
    <tr>
		<td class="label grey"><?=$this->getMark()?>Опис пошкоджень майна постраждалого:</td>
		<td colspan="3"><textarea name="victim_damage_note" style="height: 100px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['victim_damage_note']?></textarea></td>
	</tr>
	</table>
	<div class="section">Оформлення ДТП здійснено шляхом:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs') ], $data['mvs'], $data['languageCode'], $this->getReadonly(true) . ' onChange="showHideMVSBlock()"', null, $data)?></td>
		<td>
			<table id="mvsYes" cellpadding="0" cellspacing="5" style="display: <?=($data['mvs'] == 1) ? 'block' : 'none'?>">
			<tr>
				<td class="label grey"><?=$this->getMark()?>а саме:</td>
				<td id="dai" style="display: <?=($data['mvs'] == 1) ? 'block' : 'none'?>"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ], $data['mvs_id'], $data['languageCode'], 'style="width: 390px;" ' . $this->getReadonly(true), null, $data)?></td>
				<td class="label grey"><?=$this->getMark()?>Дата:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ], $data[ 'mvs_date_year' ], $data[ 'mvs_date_month' ], $data[ 'mvs_date_day' ], 'mvs_date', $this->getReadonly(true))?></td>
			</tr>
			</table>
            <table id="mvsNo" cellpadding="0" cellspacing="5" style="display: <?=($data['mvs'] == 2) ? 'block' : 'none'?>">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Схема ДТП:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ], $data['accident_schemes_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                <td class="label grey"><?=$this->getMark()?>Страховик заявника:</td>
                <td><input type="text" id="applicant_insurer_company" name="owner_insurer_company" value="<?=$data['owner_insurer_company']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><?=$this->getMark()?>Серія поліса:</td>
                <td><input type="text" id="applicant_policies_series" name="owner_policies_series" value="<?=$data['owner_policies_series']?>" maxlength="4" class="fldText" style="width: 50px;" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><?=$this->getMark()?>Номер поліса:</td>
                <td><input type="text" id="applicant_policies_number" name="owner_policies_number" value="<?=$data['owner_policies_number']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
            </tr>
        </table>
		</td>
	</tr>
	</table>
	<div class="section">Перелік документів, що додаються до заяви:</div>
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


	<div class="section">Параметри:</div>
     <? if ($Authorization->data['roles_id'] != ROLES_MASTER) {?>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Дата:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data[ 'date_year' ], $data[ 'date_month' ], $data[ 'date_day' ], 'date', $this->getReadonly(true))?></td>
		<td class="label grey"><?=$this->getMark()?>СТО:</td>
		<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('car_services_id') ], $data['car_services_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeCarServiceForMasters();changeCarServiceForInspecting(); "', null, $data)?></td>
		<td class="label grey"><?=$this->getMark()?>Майстер:</td>
		<td><select id="masters_id" name="masters_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
        <td class="label grey"><?=$this->getMark()?>Огляд ТЗ провів:</td>
        <td><select id="inspecting_master" name="inspecting_account_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
	</tr>
	</table>
	<? } else {?>
	<table cellpadding="5" cellspacing="0">
            <tr>
                <td colspan="5">
                    <td class="label grey"><?=$this->getMark()?>Огляд ТЗ провів:</td>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('inspecting_account_id') ], $data['inspecting_account_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?>

                 </td>
            </tr>
      </table>
            <input type="hidden" name="date_year" value="<?=$data['date_year']?>" />
            <input type="hidden" name="date_month" value="<?=$data['date_month']?>" />
            <input type="hidden" name="date_day" value="<?=$data['date_day']?>" />
	<? } ?>

	<div class="section">Додатково:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Статус:</td>
		<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('accident_statuses_id') ], $data['accident_statuses_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
	</tr>
	</table>

	<table cellpadding="0" cellspacing="5">
	<tr>
		<td class="label grey">Коментар:</td>
		<td width="500"><textarea name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['comment']?></textarea></td>
	</tr>
	</table>
    </td>
    </tr>
    </table>
</form>
<script type="text/javascript">
    <? if ($Authorization->data['roles_id'] != ROLES_MASTER) { echo 'changeCarServiceForMasters(' . $data['masters_id'] . '); changeCarServiceForInspecting(' . $data['inspecting_account_id'] . ');'; } ?>
    searchPolicy();
	setRisks(<?=$data['application_risks_id']?>);
    initFocus(document.<?=$this->objectTitle?>);
    <? if($action != 'add') {?>
        //$('#policies_id').attr('checked',true);
    <?}?>
</script>
