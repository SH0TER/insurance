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
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<link rel="stylesheet" href="/js/jquery/thickbox.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/validationEngine.jquery.css" />
<script type="text/javascript">
	function log(value) {
		console.log(value);
	}

	var fields = {
		'blockTimeAndPlace': {
			'datetime': 						{'check': true, 'valid': false},
			'datetimeTimePicker': 				{'check': true, 'valid': true},
			'address': 							{'check': true, 'valid': false}
		},
		'blockPolicies': {
			'policies': 						{'check': false, 'valid': false}
		},
		'blockRisks': {
			'application_risks_id': 			{'check': true, 'valid': false},
			'victim_application_risks_id':		{'check': false, 'valid': false},
			'damage_extent_id':					{'check': false, 'valid': false},
			'property_types_id':				{'check': false, 'valid': false},
			'property':							{'check': false, 'valid': false},
			'victim_car_type_id':				{'check': false, 'valid': false},
			'victim_brand_id':					{'check': false, 'valid': false},
			'victim_model_id':					{'check': false, 'valid': false},
			'victim_sign':						{'check': false, 'valid': false},
			'damage_extent_id':					{'check': false, 'valid': false},
			'damage':							{'check': true, 'valid': false}
		},
		'blockMessageAbout': {
			'europrotocol': 					{'check': false},
			'accident_schemes_id': 				{'check': false, 'valid': false},
			'applicant_insurer_company': 		{'check': false, 'valid': false},
			'applicant_policies_series': 		{'check': false, 'valid': false},
			'applicant_policies_number': 		{'check': false, 'valid': false},
			'competent_authorities_id': 		{'check': false, 'valid': false},
			'none_information_ca_reason': 		{'check': false, 'valid': false},
			'none_information_ca_reason_text':	{'check': false, 'valid': false},
			'mvs_id':							{'check': false, 'valid': false},
			'mvs_title':						{'check': false, 'valid': false},
			'mvs_date':							{'check': false, 'valid': false},
			'administrativeprotocol':			{'check': false},
			'administrative_protocol_series':	{'check': false, 'valid': false},
			'administrative_protocol_number':	{'check': false, 'valid': false},
			'administrative_protocol_persons':	{'check': false, 'valid': false},
			'assistance':						{'check': false},
			'assistance_place':					{'check': false},
			'assistance_date':					{'check': false, 'valid': false},
			'assistance_reason':				{'check': true, 'valid': false},
			'assistance_reason_text':			{'check': false, 'valid': false}
		},
		'blockCar': {
			'inspecting_car':					{'check': false},
			'inspecting_car_place':				{'check': false, 'valid': false}
		},
		'blockDriver': {
			'driver_lastname':					{'check': true, 'valid': false},
			'driver_firstname':					{'check': true, 'valid': false},
			'driver_patronymicname':			{'check': true, 'valid': false},
			'driver_licence_series':			{'check': true, 'valid': false},
			'driver_licence_number':			{'check': true, 'valid': false},
			'driver_licence_date':				{'check': true, 'valid': false}
		},
		'blockApplicant': {
			'applicant_types_id':				{'check': false},
			'applicant_lastname':				{'check': true, 'valid': false},
			'applicant_firstname':				{'check': true, 'valid': false},
			'applicant_patronymicname':			{'check': true, 'valid': false},
			'applicant_regions_id':				{'check': true, 'valid': false},
			'applicant_area':					{'check': false, 'valid': false},
			'applicant_city':					{'check': true, 'valid': false},
			'applicant_street_types_id':		{'check': true, 'valid': false},
			'applicant_street':					{'check': true, 'valid': false},
			'applicant_house':					{'check': true, 'valid': false},
			'applicant_flat':					{'check': false, 'valid': false},
			'applicant_phone':					{'check': true, 'valid': false}
		},
		'blockParticipants': {}
	};

	var policies_kasko_id = <?=intval($data['policies_kasko_id'])?>;
	var policies_kasko_items_id = <?=intval($data['policies_kasko_items_id'])?>;
	var policies_go_id = <?=intval($data['policies_go_id'])?>;
	var cars = new Array();
    var types = new Array();
	var victim_car = new Array(<?=intval($data['victim_car_type_id'])?>, <?=intval($data['victim_brand_id'])?>, <?=intval($data['victim_model_id'])?>);
	var participants_cars = new Array();
	
	function setCars(){
        if (participants_cars.length > 0) {
            for (var i=0; i < participants_cars.length; i++){
                setTypesCars("participants" + i + "car_type_id");
                document.getElementById("participants" + i + "car_type_id").value = participants_cars[i][0];
                setBrandsCars("participants" + i + "car_type_id");
                document.getElementById("participants" + i + "brand_id").value = participants_cars[i][1];
                setModelsCars("participants" + i + "brand_id");
                document.getElementById("participants" + i + "model_id").value = participants_cars[i][2];
                setModelTitle("participants" + i + "model_id");
            }
        }
    }

	function getCarTypes() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarTypes|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>',
            success:    function (result){
							if (participants_cars.length > 0) {
								for (var i=0; i < participants_cars.length; i++){
									setTypesCars("participants" + i + "car_type_id");
									document.getElementById("participants" + i + "car_type_id").value = participants_cars[i][0];
								}
							}
			}
        });
    }

	function getCar() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>',
            success:    function (result) {
                            if (victim_car.length) {
                                $("#victim_car_type_id").val(victim_car[0]);
								if (parseInt($("#victim_car_type_id").val()) > 0) {
									fields['blockRisks']['victim_car_type_id']['valid'] = true;
								}
                                setBrandsCars("victim_car_type_id");
                                $("#victim_brand_id").val(victim_car[1]);
								if (parseInt($("#victim_brand_id").val()) > 0) {
									fields['blockRisks']['victim_brand_id']['valid'] = true;
								}
                                setModelsCars("victim_brand_id");
                                $("#victim_model_id").val(victim_car[2]);
								if (parseInt($("#victim_brand_id").val()) > 0) {
									fields['blockRisks']['victim_model_id']['valid'] = true;
								}
								setModelTitle("victim_model_id");
                            }
							if (participants_cars.length > 0) {
								for (var i=0; i < participants_cars.length; i++){
									setTypesCars("participants" + i + "car_type_id");
									document.getElementById("participants" + i + "car_type_id").value = participants_cars[i][0];
									setBrandsCars("participants" + i + "car_type_id");
									document.getElementById("participants" + i + "brand_id").value = participants_cars[i][1];
									setModelsCars("participants" + i + "brand_id");
									document.getElementById("participants" + i + "model_id").value = participants_cars[i][2];
									setModelTitle("participants" + i + "model_id");
								}
							}
							searchPolicy(1);
							//$('select, input').change();
							setRisks(<?=$data['application_risks_id']?>);
							changeEuroprotocol($('input[name=europrotocol]').checked);
							<? if ($action == 'update') { ?> $('select, input, textarea').change(); <? } ?>
							<? if ($action == 'view') { ?> $('select, input, textarea').attr('disabled', 'true'); <? } ?>
            }
        });
    }

	function setTypesCars(id){
        var car_types = document.getElementById(id);
        car_types.options.length = 0;
        car_types.options[0] = new Option ('...', '-1');
        for (var i=0; i < types.length; i++){
            car_types.options[i+1] = new Option (types[i][1], types[i][0]);
        }
    }

    function setBrandsCars(id){		
		var select_brands_id = document.getElementById(id.replace('car_type_id', 'brand_id')).value;	
        var car_types = document.getElementById(id);				
        var brands = document.getElementById(id.replace('car_type_id', 'brand_id'));		
        brands.options.length = 0;
        document.getElementById(id.replace('car_type_id', 'brand')).value = '';
        brands.options[0] = new Option ('...', '-1');
        for (var i=0; i < cars.length; i++){
            if (cars[i][0] == car_types[car_types.selectedIndex].value){
                for (var j=0; j < cars[i][1].length; j++){
                    brands.options[j+1] = new Option (cars[ i ][ 1 ][ j ][ 1 ], cars[ i ][ 1 ][ j ][ 0 ]);
                }
            }
        }
		$('#'+id.replace('car_type_id', 'brand_id')).val(select_brands_id);
    }

    function setModelsCars(id){
		var select_models_id = document.getElementById(id.replace('brand_id', 'model_id')).value;
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
		$('#'+id.replace('brand_id', 'model_id')).val(select_models_id);
    }

    function setModelTitle(id){
		var models = document.getElementById(id);
		document.getElementById(id.replace('model_id', 'model')).value = models[models.selectedIndex].text;
    }

	function addPolicy() {
		tb_show('<strong>Пошук договору/полісу:</strong>', '#TB_inline?height=600&width=800&inlineId=hiddenModalContent', false);
	}

	function searchPolicy(type) {
		if (($('#search_policies_number').val() ||
			$('#search_policies_date').val() ||
            $('#search_insurer_lastname').val() ||
            $('#search_insurer_passport_series').val() ||
            $('#search_insurer_passport_number').val() ||
            $('#search_insurer_identification_code').val() ||
            $('#search_shassi').val() ||
            $('#search_sign').val()) && type == 0) {
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Policies|getSearchInWindow' +
								'&policies_kasko_id=' + policies_kasko_id +
								'&policies_kasko_items_id=' + policies_kasko_items_id +
								'&policies_go_id=' + policies_go_id +
								'&product_types_idx[]=<?=PRODUCT_TYPES_KASKO?>' +
								'&product_types_idx[]=<?=PRODUCT_TYPES_GO?>' +
                                '&datetime=' + $('input[name=datetime]').val() +
								'&number=' + $('input[name=search_policies_number]').val() +
								'&date=' + $('input[name=search_policies_date_year]').val() + '.' + $('input[name=search_policies_date_month]').val() + '.' + $('input[name=search_policies_date_day]').val() +
								'&insurer_lastname=' + $('input[name=search_insurer_lastname]').val() +
								'&insurer_passport_series=' + $('input[name=search_insurer_passport_series]').val() +
								'&insurer_passport_number=' + $('input[name=search_insurer_passport_number]').val() +
								'&insurer_identification_code=' + $('input[name=search_insurer_identification_code]').val() +
								'&shassi=' + $('input[name=search_shassi]').val() +
								'&sign=' + $('input[name=search_sign]').val(),
					success: function(result) {
						$('#searchPoliciesList').html(result);
					}
				});
        } else if (type > 0 && (policies_kasko_id > 0 || policies_go_id > 0)) {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				async:		false,
				data:		'do=Policies|getSearchInWindow' +
							'&type=1' +
							'&policies_kasko_id=' + policies_kasko_id +
							'&policies_kasko_items_id=' + policies_kasko_items_id +
							'&policies_go_id=' + policies_go_id +
							'&product_types_idx[]=<?=PRODUCT_TYPES_KASKO?>' +
							'&product_types_idx[]=<?=PRODUCT_TYPES_GO?>',
				success: function(result) {
					for (key in result) {
						$('#blockPoliciesInfo').append('<tr><td>'+result[key].insurer+'</td><td>'+result[key].number+'</td><td>'+result[key].date_format+'</td><td>'+result[key].item+'</td><td>'+result[key].shassi+'</td><td>'+result[key].sign+'</td><td>'+result[key].begin_datetime_format+'</td><td>'+result[key].interrupt_datetime_format+'</td>'+
						<? if($action != 'view') { ?>
						'<td><a href="#" onclick="deletePolicy(this, ' + result[key].product_types_id + ', ' + result[key].items_id + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>'+
						<? } ?>
						'</tr>');
					}
				}
			});
		}
	}



	function choosePolicy(policies_id, items_id, product_types_id, insurer, number, date_format, item, shassi, sign, begin_datetime_format, interrupt_datetime_format) {
		switch (product_types_id) {
			case 3:
				if (policies_kasko_id == 0) {
					policies_kasko_id = policies_id;
					policies_kasko_items_id = items_id;
					$('input[name=policies_kasko_id]').val(policies_id);
					$('input[name=policies_kasko_items_id]').val(items_id);
					$('#blockPoliciesInfo').append('<tr><td>'+insurer+'</td><td>'+number+'</td><td>'+date_format+'</td><td>'+item+'</td><td>'+shassi+'</td><td>'+sign+'</td><td>'+begin_datetime_format+'</td><td>'+interrupt_datetime_format+'</td><td><a href="#" onclick="deletePolicy(this, ' + product_types_id + ', ' + items_id + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');
				} else {
					alert('Договір КАСКО уже додано до списку.');
					return;
				}
				break;
			case 4:
				if (policies_go_id == 0) {
					policies_go_id = policies_id;
					$('input[name=policies_go_id]').val(policies_id);
					$('#blockPoliciesInfo').append('<tr><td>'+insurer+'</td><td>'+number+'</td><td>'+date_format+'</td><td>'+item+'</td><td>'+shassi+'</td><td>'+sign+'</td><td>'+begin_datetime_format+'</td><td>'+interrupt_datetime_format+'</td><td><a href="#" onclick="deletePolicy(this, ' + product_types_id + ', ' + policies_id + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');
				} else {
					alert('Договір ОСЦПВ уже додано до списку.');
					return;
				}
				break;
		}
		$('.blockRisks').show();
		if ($('input[name=owner_types_id]:checked').val() == 2) $('#blockVictimInfo').show();
		else $('#blockVictimInfo').hide();
		setRisks(0);
		tb_remove();
	}

	function deletePolicy(obj, product_types_id, id) {
        if (confirm('Ви дійсно бажаєте вилучити договір/поліс?')) {
            document.getElementById('blockPoliciesInfo').deleteRow( obj.parentNode.parentNode.sectionRowIndex );
			switch (product_types_id) {
				case 3:
					policies_kasko_id = 0;
					policies_kasko_items_id = 0;
					$('input[name=policies_kasko_id]').val(0);
					$('input[name=policies_kasko_items_id]').val(0);
					break;
				case 4:
					policies_go_id = 0;
					$('input[name=policies_go_id]').val(0);
					break;
			}
			setRisks(0);
		}
    }

	function setRisks(application_risks_id) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=Policies|getApplicationRisksInWindow' +
						'&policies_kasko_id=' + policies_kasko_id +
						'&policies_go_id=' + policies_go_id +
						'&application_risks_id=' + application_risks_id,
			success: function(result) {
				$('#risks').html( result );
				if (application_risks_id > 0) fields['blockRisks']['application_risks_id']['valid'] = true;
				else fields['blockRisks']['application_risks_id']['valid'] = false;
				$('input[name=application_risks_id]').bind(
					"click", function() {
						$('.blockMessageAbout').show();
					}
				);
				checkFields(null);
			}
		});
	}

	function changeEuroprotocol(checked) {
		if (checked) {
			$('#blockEuroprotocolInfo').show();
			$('#blockCompetentAuthorities').hide();
			fields['blockMessageAbout']['accident_schemes_id']['check'] = true;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = true;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = true;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = true;
		} else {
			$('#blockEuroprotocolInfo').hide();
			$('#blockCompetentAuthorities').show();
			fields['blockMessageAbout']['accident_schemes_id']['check'] = false;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = false;
		}
		checkFields(null);
	}

	function changeCompetentAuthoritiesId(id) {
		switch (id) {
			case '1':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').show();
				$('#daiNo').hide();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').show();
				$('#blockNoneInformationCA').hide();
				$('#blockNoneInformationCAtext').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = true;
				fields['blockMessageAbout']['mvs_title']['check'] = false;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['none_information_ca_reason']['check'] = false;
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = false;
				break;
			case '2':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').hide();
				$('#daiNo').show();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').hide();
				$('#blockNoneInformationCA').hide();
				$('#blockNoneInformationCAtext').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = true;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['none_information_ca_reason']['check'] = false;
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = false;
				break;
			case '3':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').hide();
				$('#daiNo').show();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').hide();
				$('#blockNoneInformationCA').hide();
				$('#blockNoneInformationCAtext').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = true;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['none_information_ca_reason']['check'] = false;
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = false;
				break;
			case '0':
				$('#blockCompetentAuthoritiesInfo').hide();
				$('#daiYes').hide();
				$('#daiNo').hide();
				$('#blockEuroprotocol').show();
				$('#blockAministrativeProtocol').hide();
				$('#blockNoneInformationCA').show();
				//$('#blockNoneInformationCAtext').show();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = false;
				fields['blockMessageAbout']['mvs_date']['check'] = false;
				fields['blockMessageAbout']['none_information_ca_reason']['check'] = true;
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = false;
				break;
			default:
				$('#blockCompetentAuthoritiesInfo').hide();
				$('#daiYes').hide();
				$('#daiNo').hide();
				$('#blockEuroprotocol').show();
				$('#blockAministrativeProtocol').hide();
				$('#blockNoneInformationCA').hide();
				//$('#blockNoneInformationCAtext').show();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = false;
				fields['blockMessageAbout']['mvs_date']['check'] = false;
				fields['blockMessageAbout']['none_information_ca_reason']['check'] = false;
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = false;
				break;
		}
		checkFields(null);
	}

	function changeNonInformationCAreason(id) {
		switch (id) {
			case '5':
				$('#blockNoneInformationCAtext').show();
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = true;
				break;
			default:
				$('#blockNoneInformationCAtext').hide();
				fields['blockMessageAbout']['none_information_ca_reason_text']['check'] = false;
				break;
		}
		checkFields(null);
	}

	function changeNonInformationAreason(id) {
		switch (id) {
			case '3':
				$('#blockNoneInformationAtext').show();
				fields['blockMessageAbout']['assistance_reason_text']['check'] = true;
				break;
			default:
				$('#blockNoneInformationAtext').hide();
				fields['blockMessageAbout']['assistance_reason_text']['check'] = false;
				break;
		}
		checkFields(null);
	}

	function changeAministrativeProtocol(checked) {
		if (checked) {
			$('#blockAministrativeProtocolInfo').show();
			fields['blockMessageAbout']['administrative_protocol_series']['check'] = true;
			fields['blockMessageAbout']['administrative_protocol_number']['check'] = true;
			fields['blockMessageAbout']['administrative_protocol_persons']['check'] = true;
		} else {
			$('#blockAministrativeProtocolInfo').hide();
			fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
			fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;
			fields['blockMessageAbout']['administrative_protocol_persons']['check'] = false;
		}
		checkFields(null);
	}

	function changeInspectingCar(checked) {
		if (checked) {
			$('#blockInspectingCarInfo').show();
			fields['blockCar']['inspecting_car_place']['check'] = true;
		} else {
			$('#blockInspectingCarInfo').hide();
			fields['blockCar']['inspecting_car_place']['check'] = false;
		}
		if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
		checkFields(null);
	}

	function showHideAssistanceBlock() {
        if ($('input[name=assistance]:checked').val() == '1') {
            $('#assistanceYes').css('display', 'block');
            $('#assistanceNo').css('display', 'none');
			fields['blockMessageAbout']['assistance_reason']['check'] = false;
			fields['blockMessageAbout']['assistance_date']['check'] = true;
        } else {
            $('#assistanceYes').css('display', 'none');
            $('#assistanceNo').css('display', 'block');
			fields['blockMessageAbout']['assistance_reason']['check'] = true;
			fields['blockMessageAbout']['assistance_date']['check'] = false;
        }
		checkFields(null);
    }

	function showHideAssistanceDate() {
        if ($('input[name=assistance_place]:checked').val() == '1') {
            $('#assistance_dateBlock').css('display', 'none');
			fields['blockMessageAbout']['assistance_date']['check'] = false;
			if (checkFields('blockMessageAbout')) {
				$('.blockCar').show();
				$('.blockDriver').show();
			}
		} else {
            $('#assistance_dateBlock').css('display', 'block');
			fields['blockMessageAbout']['assistance_date']['check'] = true;
		}
		checkFields(null);
	}

	function setApplicant(types_id) {
		switch(types_id) {
			case 1:
			case 2:
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'json',
					data:		'do=Policies|getApplicationInfoInWindow' +
								'&types_id=' + types_id +
								'&policies_kasko_id=' + policies_kasko_id +
								'&policies_go_id=' + policies_go_id,
					success: function(result) {
						if (result.status == 1) {
							$('input[name=applicant_lastname]').val(result.applicant_lastname);
							$('input[name=applicant_firstname]').val(result.applicant_firstname);
							$('input[name=applicant_patronymicname]').val(result.applicant_patronymicname);
							$('select[name=applicant_regions_id]').val(result.applicant_regions_id);
							$('input[name=applicant_area]').val(result.applicant_area);
							$('input[name=applicant_city]').val(result.applicant_city);
							$('select[name=applicant_street_types_id]').val(result.applicant_street_types_id);
							$('input[name=applicant_street]').val(result.applicant_street);
							$('input[name=applicant_house]').val(result.applicant_house);
							$('input[name=applicant_flat]').val(result.applicant_flat);
							$('input[name=applicant_phone]').val(result.applicant_phone);
							$('input[name^=applicant_]').change();
							$('select[name^=applicant_]').change();
						} else {
							alert('Інформацію не знайдено.');
						}
					}
				});
				break;
			case 3:
				$('input[name=applicant_lastname]').val($('input[name=driver_lastname]').val());
				$('input[name=applicant_firstname]').val($('input[name=driver_firstname]').val());
				$('input[name=applicant_patronymicname]').val($('input[name=driver_patronymicname]').val());
				$('select[name=applicant_regions_id]').val(0);
				$('input[name=applicant_area]').val('');
				$('input[name=applicant_city]').val('');
				$('select[name=applicant_street_types_id]').val(0);
				$('input[name=applicant_street]').val('');
				$('input[name=applicant_house]').val('');
				$('input[name=applicant_flat]').val('');
				$('input[name=applicant_phone]').val('');
				$('input[name^=applicant_]').change();
				$('select[name^=applicant_]').change();
				break;
		}
	}

	$(document).ready(function() {
		showHideAssistanceDate();
		showHideAssistanceBlock();				
		getCarTypes();
		getCar();		

		//тип заявника
		$('input[name=owner_types_id]').bind(
			"change", function() {				
				if (this.value == 1 && this.value == $('input[name=owner_types_id]:checked').val()) {
					$('.blockTimeAndPlace').show();
					$('#blockVictimInfo').hide();
					fields['blockRisks']['victim_application_risks_id']['check'] = false;
				}
				if (this.value == 2 && this.value == $('input[name=owner_types_id]:checked').val()) {
					$('.blockTimeAndPlace').show();
					$('#blockVictimInfo').show();
					fields['blockRisks']['victim_application_risks_id']['check'] = true;
				}
			}
		);
		//дата пригоди
		$('input[name=datetime]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					fields['blockTimeAndPlace']['datetime']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					if (fields['blockMessageAbout']['assistance_date']['check']) $('input[name=assistance_date]').change();
					if (fields['blockMessageAbout']['mvs_date']['check']) $('input[name=mvs_date]').change();
					checkFields(null);
					return;
				}
				fields['blockTimeAndPlace']['datetime']['valid'] = false;
				showPrompt(this, 'Невірна дата пригоди.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		//час пригоди
		$('input[name=datetimeTimePicker]').bind(
			"change", function() {
				var expr = /\d\d:\d\d/g;
				fields['blockTimeAndPlace']['datetimeTimePicker'] = 1;
				if (this.value.search(expr) == 0 && parseInt(this.value.substr(0,2)) >= 0 && parseInt(this.value.substr(0,2)) < 24 && parseInt(this.value.substr(3,2)) >=0 && parseInt(this.value.substr(0,2)) < 60) {
					fields['blockTimeAndPlace']['datetimeTimePicker']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					checkFields(null);
					return;
				}
				fields['blockTimeAndPlace']['datetimeTimePicker']['valid'] = false;
				showPrompt(this, 'Невірний час пригоди.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//адреса пригоди
		$('input[name=address]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockTimeAndPlace']['address']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					checkFields(null);
					return;
				}
				fields['blockTimeAndPlace']['address']['valid'] = false;
				showPrompt(this, 'Введіть адресу, де сталася пригода.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//тип шкоди завданої потерпілому
		$('select[name=victim_application_risks_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim_application_risks_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim_application_risks_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати тип шкоди.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//тип пошкодженого майна
		$('select[name=property_types_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['property_types_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['property_types_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати тип пошкодженого майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//тип ТЗ потерпілого
		$('select[name=victim_car_type_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim_car_type_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim_car_type_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати тип ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//марка ТЗ потерпілого
		$('select[name=victim_brand_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim_brand_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim_brand_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати марку ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//модель ТЗ потерпілого
		$('select[name=victim_model_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim_model_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim_model_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати модель ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//номер ТЗ потерпілого
		$('input[name=victim_sign]').bind(
			"change", function() {
				if (this.value.length && isValidSign(fixSignSimbols(this.value))) {
					fields['blockRisks']['victim_sign']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim_sign']['valid'] = false;
				showPrompt(this, 'Введіть номер ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//опис пошкодженого майна, крім ТЗ
		$('input[name=property]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['property']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['property']['valid'] = false;
				showPrompt(this, 'Введіть опис пошкодженого майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//ступінь ушкоджень потерпілого
		$('select[name=damage_extent_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['damage_extent_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['damage_extent_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати ступінь ушкоджень.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//пошкодження
		$('textarea[name=damage]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['damage']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['damage']['valid'] = false;
				showPrompt(this, 'Введіть пошкодження.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//віддідлення ДАІ
		$('select[name=mvs_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockMessageAbout']['mvs_id']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати віддідлення ДАІ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//назва компетентних органів
		$('input[name=mvs_title]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['mvs_title']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_title']['valid'] = false;
				showPrompt(this, 'Введіть назву компетентних органів.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//дата звернення до компетентних органів
		$('input[name=mvs_date]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) >= new Date(parseInt($('input[name=datetime]').val().substr(6,4)), parseInt($('input[name=datetime]').val().substr(3,2)-1), parseInt($('input[name=datetime]').val().substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					$('#'+this.name+'ErrorPrompt').remove();
					fields['blockMessageAbout']['mvs_date']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_date']['valid'] = false;
				showPrompt(this, 'Невірна дата звернення до компетентних органів.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		//причина не повідомлення ДАІ
		$('select[name=none_information_ca_reason]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockMessageAbout']['none_information_ca_reason']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['none_information_ca_reason']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати причину не повідомлення ДАІ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//інша причина не повідомлення ДАІ
		$('input[name=none_information_ca_reason_text]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['none_information_ca_reason_text']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['none_information_ca_reason_text']['valid'] = false;
				showPrompt(this, 'Введіть причину не повідомлення ДАІ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//схема ДТП за європротоколом
		$('select[name=accident_schemes_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockMessageAbout']['accident_schemes_id']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['accident_schemes_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати схему ДТП.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//СК заявника
		$('input[name=applicant_insurer_company]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['applicant_insurer_company']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['applicant_insurer_company']['valid'] = false;
				showPrompt(this, 'Введіть страхову компанію.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//серія полісу заявника
		$('input[name=applicant_policies_series]').bind(
			"change", function() {
				var expr = /[А-Я][А-Я]/g;
				if (this.value.search(expr) == 0 && this.value.length == 2) {
					fields['blockMessageAbout']['applicant_policies_series']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть серію полісу.');
				} else {
					showPrompt(this, 'Формат серії полісу невірний.');
				}
				fields['blockMessageAbout']['applicant_policies_series']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//номер полісу заявника
		$('input[name=applicant_policies_number]').bind(
			"change", function() {
				var expr = /\d{7}/g;
				if (this.value.search(expr) == 0 && this.value.length == 7) {
					fields['blockMessageAbout']['applicant_policies_number']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть номер полісу.');
				} else {
					showPrompt(this, 'Формат номера полісу невірний.');
				}
				fields['blockMessageAbout']['applicant_policies_number']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//причина не повідомлення в ДЦ
		$('select[name=assistance_reason]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockMessageAbout']['assistance_reason']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['assistance_reason']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати причину не повідомлення ДЦ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//інша причина не повідомлення ДЦ
		$('input[name=assistance_reason_text]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['assistance_reason_text']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['assistance_reason_text']['valid'] = false;
				showPrompt(this, 'Введіть причину не повідомлення ДЦ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		/*$('input[name=assistance_reason]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['assistance_reason']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['assistance_reason']['valid'] = false;
				showPrompt(this, 'Вкажіть причину.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);*/
		//дата повідомлення в ДЦ
		$('input[name=assistance_date]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) >= new Date(parseInt($('input[name=datetime]').val().substr(6,4)), parseInt($('input[name=datetime]').val().substr(3,2)-1), parseInt($('input[name=datetime]').val().substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					$('#'+this.name+'ErrorPrompt').remove();
					fields['blockMessageAbout']['assistance_date']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['assistance_date']['valid'] = false;
				showPrompt(this, 'Невірна дата повідомлення в диспетчерський центр.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		//серія АП
		$('input[name=administrative_protocol_series]').bind(
			"change", function() {
				var expr = /[А-Я][А-Я]/g;
				if (this.value.search(expr) == 0 && this.value.length == 2) {
					fields['blockMessageAbout']['administrative_protocol_series']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть серію адміністративного протоколу.');
				} else {
					showPrompt(this, 'Формат серії адміністративного протоколу невірний.');
				}
				fields['blockMessageAbout']['administrative_protocol_series']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//номер АП
		$('input[name=administrative_protocol_number]').bind(
			"change", function() {
				var expr = /\d{7}/g;
				if (this.value.search(expr) == 0 && this.value.length == 7) {
					fields['blockMessageAbout']['administrative_protocol_number']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть номер адміністративного протоколу.');
				} else {
					showPrompt(this, 'Формат номера адміністративного протоколу невірний.');
				}
				fields['blockMessageAbout']['administrative_protocol_number']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//перелік осіб АП
		$('input[name=administrative_protocol_persons]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['administrative_protocol_persons']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						$('.blockCar').show();
						$('.blockDriver').show();
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['administrative_protocol_persons']['valid'] = false;
				showPrompt(this, 'Вкажіть перелік осіб, на яких складено АП.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//місце знаходження ТЗ
		$('input[name=inspecting_car_place]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockCar']['inspecting_car_place']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				}
				fields['blockCar']['inspecting_car_place']['valid'] = false;
				showPrompt(this, 'Вкажіть місце знаходження ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//прізвище водія
		$('input[name=driver_lastname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockDriver']['driver_lastname']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_lastname']['valid'] = false;
				showPrompt(this, 'Вкажіть прізвище водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//ім"я водія
		$('input[name=driver_firstname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockDriver']['driver_firstname']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_firstname']['valid'] = false;
				showPrompt(this, 'Вкажіть ім\'я водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//по батькові водія
		$('input[name=driver_patronymicname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockDriver']['driver_patronymicname']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_patronymicname']['valid'] = false;
				showPrompt(this, 'Вкажіть по батькові водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//серія ПВ водія
		$('input[name=driver_licence_series]').bind(
			"change", function() {
				var expr = /[А-Я][А-Я][А-Я]/g;
				if (this.value.search(expr) == 0 && this.value.length == 3) {
					fields['blockDriver']['driver_licence_series']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть серію посвідчення водія.');
				} else {
					showPrompt(this, 'Формат серії посвідчення водія невірний.');
				}
				fields['blockDriver']['driver_licence_series']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//номер ПВ водія
		$('input[name=driver_licence_number]').bind(
			"change", function() {
				var expr = /\d{6}/g;
				if (this.value.search(expr) == 0 && this.value.length == 6) {
					fields['blockDriver']['driver_licence_number']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть номер посвідчення водія.');
				} else {
					showPrompt(this, 'Формат номера посвідчення водія невірний.');
				}
				fields['blockDriver']['driver_licence_number']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//дата видачі ПВ водія
		$('input[name=driver_licence_date]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))) {
					fields['blockDriver']['driver_licence_date']['valid'] = true;
					if (checkFields('blockCar') && checkFields('blockDriver')) $('.blockApplicant').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_licence_date']['valid'] = false;
				showPrompt(this, 'Невірна дата видачі посвідчення водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		//прізвище заявника
		$('input[name=applicant_lastname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_lastname']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_lastname']['valid'] = false;
				showPrompt(this, 'Вкажіть прізвище заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//ім"я заявника
		$('input[name=applicant_firstname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_firstname']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_firstname']['valid'] = false;
				showPrompt(this, 'Вкажіть ім\'я заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//по батькові заявника
		$('input[name=applicant_patronymicname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_patronymicname']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_patronymicname']['valid'] = false;
				showPrompt(this, 'Вкажіть по батькові заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//область заявника
		$('select[name=applicant_regions_id]').change(function() {
			if (parseInt(this.value) > 0) {
				fields['blockApplicant']['applicant_regions_id']['valid'] = true;
				if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
				else if (checkFields('blockApplicant')) $('.blockDoduments').show();
				checkFields(null);
				return;
			}
			fields['blockApplicant']['applicant_regions_id']['valid'] = false;
			$(this).blur();
			showPrompt(this, 'Потрібно вибрати область заявника.');
			$(this).bind(
				'focus', function() {
					$('#'+this.name+'ErrorPrompt').remove();
				}
			);
		});
		//місто заявника
		$('input[name=applicant_city]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_city']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_city']['valid'] = false;
				showPrompt(this, 'Вкажіть місто заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//тип вулиці заявника
		$('select[name=applicant_street_types_id]').change(function() {
			if (parseInt(this.value) > 0) {
				fields['blockApplicant']['applicant_street_types_id']['valid'] = true;
				if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
				else if (checkFields('blockApplicant')) $('.blockDoduments').show();
				checkFields(null);
				return;
			}
			fields['blockApplicant']['applicant_street_types_id']['valid'] = false;
			$(this).blur();
			showPrompt(this, 'Потрібно вибрати тип вулиці заявника.');
			$(this).bind(
				'focus', function() {
					$('#'+this.name+'ErrorPrompt').remove();
				}
			);
		});
		//вулиця заявника
		$('input[name=applicant_street]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_street']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_street']['valid'] = false;
				showPrompt(this, 'Вкажіть назву.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		//будинок заявника
		$('input[name=applicant_house]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_house']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_house']['valid'] = false;
				showPrompt(this, 'Вкажіть будинок.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);

		//телефони заявника
		$('input[name=applicant_phone]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_phone']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockDoduments').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_phone']['valid'] = false;
				showPrompt(this, 'Вкажіть телефон.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);

		$('select[name=victim_application_risks_id]').change(function() {
            if($('select[name=victim_application_risks_id] option:selected').val() == '2') {
                $("#damage_extent").css('display','');
                $("#car").css('display','none');
                $("#property_type").css('display','none');
				fields['blockRisks']['damage_extent_id']['check'] = true;
				fields['blockRisks']['property_types_id']['check'] = false;
            }
            else if($('select[name=victim_application_risks_id] option:selected').val() == '1'){
                $("#damage_extent").css('display','none');
                $('select[name=property_types_id]').change(function(){
                    if($('select[name=property_types_id] option:selected').val() == '1') {
                        $("#property").css('display','none');
                        $("#car").css('display','');
						fields['blockRisks']['property']['check'] = false;
						fields['blockRisks']['victim_car_type_id']['check'] = true;
						fields['blockRisks']['victim_brand_id']['check'] = true;
						fields['blockRisks']['victim_model_id']['check'] = true;
						fields['blockRisks']['victim_sign']['check'] = true;
                    }
                    else if($('select[name=property_types_id] option:selected').val() == '2'){
                        $("#car").css('display','none');
                        $("#property").css('display','');
						fields['blockRisks']['property']['check'] = true;
						fields['blockRisks']['victim_car_type_id']['check'] = false;
						fields['blockRisks']['victim_brand_id']['check'] = false;
						fields['blockRisks']['victim_model_id']['check'] = false;
						fields['blockRisks']['victim_sign']['check'] = false;
                    }
                });
				fields['blockRisks']['damage_extent_id']['check'] = false;
				fields['blockRisks']['property_types_id']['check'] = true;
                $("#property_type").css('display','');
            } else {
				$("#property_type").css('display','none');
				$("#property").css('display','none');
				fields['blockRisks']['damage_extent_id']['check'] = false;
				fields['blockRisks']['property_types_id']['check'] = false;
				fields['blockRisks']['property']['check'] = false;
				fields['blockRisks']['victim_car_type_id']['check'] = false;
				fields['blockRisks']['victim_brand_id']['check'] = false;
				fields['blockRisks']['victim_model_id']['check'] = false;
				fields['blockRisks']['victim_sign']['check'] = false;
			}

        });

		/*$('select[name=property_types_id]').click(function() {
			if ($('select[name=product_types_id] option:selected').val() == )
		});*/


		//$('select, input').change();
	});

	function showPrompt(field, promptText) {
		for(key_1 in fields) {
			for(key_2 in fields[key_1])
				if (key_2 == field.name && !fields[key_1][key_2]['check'] ) {
					return false;
				}
		}

		var prompt = $('<div id="' + field.name.replaceArray(['\\[','\\]'],['','']) + 'ErrorPrompt">');
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
		})
		$('input[name=btn_save]').hide();
	}

	function array_sum(array) {
		var key, sum=0;

		for(var key in array){
			sum += array[key];
		}

		return sum;
	}

	function checkFields(block) {
		if (block) {
			for(key in fields[block]) {
				if (fields[block][key]['check'] && !fields[block][key]['valid']) return false;
			}
			return true;
		} else {
			for(key_1 in fields) {
				for(key_2 in fields[key_1])
					if (key_1 == 'blockParticipants') {
						for (key_3 in fields[key_1][key_2])
							if (fields[key_1][key_2][key_3]['check'] && !fields[key_1][key_2][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								return false;
							}
					}
					else if (fields[key_1][key_2]['check'] && !fields[key_1][key_2]['valid']) {
						$('input[name=btn_save]').hide();
						log(key_2);
						return false;
					}
			}
			$('input[name=btn_save]').show();
			return true;
		}
	}

	function changeParticipantsRowStyle() {
		for (i=0; i < document.getElementById('participants').rows.length; i++) {
			document.getElementById('participants').rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

    var num = -1;

    function addParticipant() {

    	var participant =
	    	'<tr id="participants' + num + '">' +
				'<td>' +
					'<table cellpadding="5" cellspacing="0">' +
						'<tr>' +
							'<td class="label grey">Прізвище, ім\'я, по батькові:</td>' +
							'<td><input type="text" id="participants' + num + 'name" name="participants[' + num + '][name]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" /></td>' +
							'<td class="grey">Тип ТЗ:</td>' +
							'<td><select id="participants' + num + 'car_type_id" name="participants[' + num + '][car_type_id]" class="fldSelect" value="" onchange="setBrandsCars(this.id)" /></select></td>' +
							'<td class="grey">Марка:</td>' +
							'<td><select id="participants' + num + 'brand_id" name="participants[' + num + '][brand_id]" class="fldSelect" value="" onchange="setModelsCars(this.id)" /></select></td>' +
							'<input type="hidden" id="participants' + num + 'brand" name="participants[' + num + '][brand]" value="" />' +
							'<td class="grey">Модель:</td>' +
							'<td><select id="participants' + num + 'model_id" name="participants[' + num + '][model_id]" class="fldSelect" value="" onchange="setModelTitle(this.id)" /></select></td>' +
							'<input type="hidden" id="participants' + num + 'model" name="participants[' + num + '][model]" value="" />' +
							'<td class="label grey">Державний знак:</td>' +
							'<td><input type="text" id="participants' + num + 'sign" name="participants[' + num + '][sign]" value="" maxlength="10" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
						'</tr>' +
					'</table>' +					
				'</td>' +
				'<td><a href="javascript: deleteParticipant(' + num + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
			'</tr>';

    	$('#participants').append(participant);

        setTypesCars("participants" + num + "car_type_id");
		
		var p = {
				'name': {'check': true, 'valid': false},
				'car_type_id': {'check': true, 'valid': false},
				'brand_id': {'check': true, 'valid': false},
				'model_id': {'check': true, 'valid': false},
				'sign': {'check': true, 'valid': false}
			};
		
		fields['blockParticipants'][num] = p;
		
		checkFields(null);

		var i = num;
		$('#participants' + i + 'name').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['name']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['name']['valid'] = false;
				showPrompt(this, 'Введіть \'Прізвище, ім\'я, по батькові\'.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);

		$('#participants' + i + 'car_type_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['car_type_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['car_type_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати тип ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'brand_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['brand_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['brand_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати марку ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'model_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['model_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['model_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати модель ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'sign').bind(
			"change", function() {
				if (this.value.length && isValidSign(fixSignSimbols(this.value))) {
					fields['blockParticipants'][i]['sign']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['sign']['valid'] = false;
				showPrompt(this, 'Введіть номер ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
        num--;

		changeParticipantsRowStyle();
    }
	
	function deleteParticipant(i) {
        if (confirm('Ви дійсно бажаєте вилучити інформацію по одному з участників ДТП?')) {

			delete(fields['blockParticipants'][i]);
			checkFields(null);
		
        	$('#participants' + i).remove();

			changeParticipantsRowStyle();
        }
    }
	
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
</script>
<? $Log->showSystem();?>
<form style="margin: 10px;" id="<?=$this->objectTitle?>" name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF)']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields(null);">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=($data['id'] ? $data['id'] : -1)?>" />
	<input type="hidden" name="policies_kasko_id" value="<?=$data['policies_kasko_id']?>" />
	<input type="hidden" name="policies_kasko_items_id" value="<?=$data['policies_kasko_items_id']?>" />
	<input type="hidden" name="policies_go_id" value="<?=$data['policies_go_id']?>" />

	<div class="blockApplicantType">
		<div class="section">Сторона, що заявляє про подію від:</div>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td><input type="radio" name="owner_types_id" value="1" <?=(($data['owner_types_id'] == 1) ? 'checked' : '')?> />страхувальника</td>
				<td><input type="radio" name="owner_types_id" value="2" <?=(($data['owner_types_id'] == 2) ? 'checked' : '')?> />потерпілого</td>
			</tr>
		</table>
	</div>

	<div class="blockTimeAndPlace" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Час та місце пригоди:</div>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey" style="width: 120px;"><?=$this->getMark()?>Дата та час настання:</td>
				<td style="width: 170px;"><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('datetime') ], $data[ 'datetime_year' ], $data[ 'datetime_month' ], $data[ 'datetime_day' ], ($data[ 'datetime_hour' ]>0 ? $data[ 'datetime_hour' ] : '00'), ($data[ 'datetime_minute' ]>0 ? $data[ 'datetime_minute' ] : '00'), 'datetime', $this->getReadonly(true))?></td>
				<td class="label grey" style="width: 50px;"><?=$this->getMark()?>Адреса:</td>
				<td style="width: 355px;"><input type="text" name="address" value="<?=$data['address']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
			</tr>
		</table>
	</div>
	
	<div class="blockPolicies" style="width: 120px; display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Договори:</div>
		<? if($action != 'view') { ?>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey" style="width: 120px;">Додати договір / поліс:</td><td><a href="javascript: addPolicy()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати договір / поліс" /></td>
			</tr>
		</table>
		<? } ?>
		<div id="blockPoliciesList">
			<table id="blockPoliciesInfo" border="1" cellpadding="5" cellspacing="0">
				<tr class="columns">
					<td>Страхувальник</td>
					<td>Номер</td>
					<td>Дата</td>
					<td>Автомобіль</td>
					<td>Шасі</td>
					<td>Номер</td>
					<td>Початок</td>
					<td>Закінчення</td>
					<? if($action != 'view') { ?>
					<td></td>
					<? } ?>
				</tr>
			</table>
			<div id="listPoliciesItemsId"></div>
		</div>
	</div>
	
	<div class="blockRisks" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Ризик, тип події, ступінь тяжкості наслідків:</div>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td colspan="2">
					<div id="risks"></div>
				</td>
			</tr>
			<tr>
				<td id="blockVictimInfo" colspan="2">
					<table>
						<tr>
							<td>Заподіяно шкоду:
								<select name="victim_application_risks_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
									<option value="">...</option>
									<option value="1" <?=($data['victim_application_risks_id'] == 1) ? 'selected' : ''?>>Майно</option>
									<option value="2" <?=($data['victim_application_risks_id'] == 2) ? 'selected' : ''?>>Здоров'я</option>
								</select>
							</td>
							<td><div id="property_type" style="display: <?=($data['victim_application_risks_id'] == 1) ? 'block' : 'none'?>"><label class="label grey">Тип пошкодженого майна</lable><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('property_types_id') ], $data['property_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></div></td>
							<td><div id="damage_extent" style="display: <?=($data['victim_application_risks_id'] == 2) ? 'block' : 'none'?>"><label class="label grey">Ступінь ушкоджень</lable><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('damage_extent_id') ], $data['damage_extent_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></div></td>
						</tr>
						<tr>
							<td colspan="3">
								<table cellpadding="5" cellspacing="0">
									<tr id = "car" style="display: <?=($data['property_types_id'] == 1) ? 'block' : 'none'?>">
										<td class="label grey"><?=$this->getMark()?>Тип ТЗ:</td>
										<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('victim_car_type_id') ], "", $data['languageCode'], $this->getReadonly(true) . ' onchange="setBrandsCars(this.id)"', null, $data)?></td>
										<td class="label grey"><?=$this->getMark()?>Марка ТЗ:
											<select id="victim_brand_id" name="victim_brand_id" value="<?=$data[ 'victim_brand_id' ]?>" onchange="setModelsCars(this.id)" class="owner fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$data['victim_brand_id'].'">'.$data['victim_brand'].'</option>';}?></select>
											<input type="hidden" id="victim_brand" name="victim_brand" value="" />
										</td>
										<td class="label grey"><?=$this->getMark()?>Модель ТЗ:
											<select id="victim_model_id"  name="victim_model_id" value="" onchange="setModelTitle(this.id)" class="owner fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$data['victim_model_id'].'">'.$data['victim_model'].'</option>';}?></select>
											<input type="hidden" id="victim_model" name="victim_model" value="" />
										</td>
										<td class="label grey"><?=$this->getMark()?>Номер ТЗ:</td>
										<td><input type="text" id="victim_sign" name="victim_sign" value="<?=$data['victim_sign']?>" class="owner fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td nowrap="1"><div id="property" style="display: <?=($data['property_types_id'] == 2) ? 'block' : 'none'?>"><lable class="label grey"><?=$this->getMark()?>Назва майна</lable><input type="text" name="property" value="<?=$data['property']?>" class="owner fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></div></td>
						</tr>						
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="label grey" style="vertical-align: top;"><?=$this->getMark()?>Пошкодження:</td>
				<td>
					<textarea name="damage" style="height: 100px; width: 250px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['damage']?></textarea>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="blockMessageAbout" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Повідомлено:</div>
		<table id="blockEuroprotocol" cellpadding="5" cellspacing="5">
			<tr>
				<td>Європротокол:</td><td><input type="checkbox" value="1" name="europrotocol" onChange="changeEuroprotocol(this.checked)" <?=($data['europrotocol'] == 1) ? 'checked' : ''?>></td>
				<td>
					<table id="blockEuroprotocolInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['europrotocol'] == 1) ? 'block' : 'none'?>">
						<tr>
							<td class="label grey"><?=$this->getMark()?>Схема ДТП:</td>
							<td>
								<select name="accident_schemes_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
									<option value="">...</option>
									<option value="1" <?=($data['accident_schemes_id'] == 1) ? 'selected' : ''?>>Схема1</option>
									<option value="2" <?=($data['accident_schemes_id'] == 2) ? 'selected' : ''?>>Схема2</option>
									<option value="3" <?=($data['accident_schemes_id'] == 3) ? 'selected' : ''?>>Схема3</option>
									<option value="4" <?=($data['accident_schemes_id'] == 4) ? 'selected' : ''?>>Схема4</option>
									<option value="5" <?=($data['accident_schemes_id'] == 5) ? 'selected' : ''?>>Схема5</option>
									<option value="6" <?=($data['accident_schemes_id'] == 6) ? 'selected' : ''?>>Схема6</option>
									<option value="7" <?=($data['accident_schemes_id'] == 7) ? 'selected' : ''?>>Схема7</option>
								</select>
							</td>
							<td class="label grey"><?=$this->getMark()?>Страховик заявника:</td>
							<td><input type="text" id="applicant_insurer_company" name="applicant_insurer_company" value="<?=$data['applicant_insurer_company']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
							<td class="label grey"><?=$this->getMark()?>Серія поліса:</td>
							<td><input type="text" id="applicant_policies_series" name="applicant_policies_series" value="<?=$data['applicant_policies_series']?>" maxlength="4" class="fldText" style="width: 50px;" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
							<td class="label grey"><?=$this->getMark()?>Номер поліса:</td>
							<td><input type="text" id="applicant_policies_number" name="applicant_policies_number" value="<?=$data['applicant_policies_number']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table id="blockCompetentAuthorities" cellpadding="5" cellspacing="5">
			<tr>
				<td>
					<select name="competent_authorities_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onChange="changeCompetentAuthoritiesId(this.value)">
						<option value="">Компетентні органи</option>
						<option value="0" <?=($data['competent_authorities_id'] == 0) ? 'selected' : ''?>>Нiкуди</option>
						<option value="1" <?=($data['competent_authorities_id'] == 1) ? 'selected' : ''?>>Органи ДАІ</option>
						<option value="2" <?=($data['competent_authorities_id'] == 2) ? 'selected' : ''?>>Органи МВС</option>
						<option value="3" <?=($data['competent_authorities_id'] == 3) ? 'selected' : ''?>>МНС</option>
					</select>
				</td>
				<td>&nbsp;</td>
				<td>
					<table id="blockCompetentAuthoritiesInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['competent_authorities_id'] > 0) ? 'block' : 'none'?>">
						<tr>
							<td id="daiYes" style="display: <?=($data['competent_authorities_id'] == 1) ? 'block' : 'none'?>"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ], $data['mvs_id'], $data['languageCode'], 'style="width: 390px;" ' . $this->getReadonly(true), null, $data)?></td>
							<td id="daiNo" style="display: <?=($data['competent_authorities_id'] > 1) ? 'block' : 'none'?>"><input type="text" id="mvs_title" name="mvs_title" value="<?=($data['mvs'] > 1) ? $data['mvs_title'] : ''?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly()?> /></td>
							<td class="label grey"><?=$this->getMark()?>Дата:</td>
							<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ], $data[ 'mvs_date_year' ], $data[ 'mvs_date_month' ], $data[ 'mvs_date_day' ], 'mvs_date', $this->getReadonly(true))?></td>							
						</tr>
					</table>
					<table id="blockNoneInformationCA" style="display: <?=($data['competent_authorities_id'] == 0) ? 'block' : 'none'?>">
						<td>Причина не повідомлення: </td>
						<td>
							<select name="none_information_ca_reason" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onChange="changeNonInformationCAreason(this.value)">
								<option value="0">...</option>
								<option value="1" <?=($data['none_information_ca_reason'] == 1) ? 'selected' : ''?>>Немає інших учасників ДТП</option>
								<option value="2" <?=($data['none_information_ca_reason'] == 2) ? 'selected' : ''?>>Незначні пошкодження</option>
								<option value="3" <?=($data['none_information_ca_reason'] == 3) ? 'selected' : ''?>>Відсутність зв'язку</option>
								<option value="4" <?=($data['none_information_ca_reason'] == 4) ? 'selected' : ''?>>Виклик ДАІ був, але не приїхали</option>
								<option value="5" <?=($data['none_information_ca_reason'] == 5) ? 'selected' : ''?>>Інше</option>
							</select>
						</td>
						<td id="blockNoneInformationCAtext" style="display: <?=($data['none_information_ca_reason'] == 5) ? 'block' : 'none'?>">
							<input type="text" id="none_information_ca_reason_text" name="none_information_ca_reason_text" value="<?=$data['none_information_ca_reason_text']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> />
						</td>
					</table>
				</td>
			</tr>
		</table>
		<table id="blockAministrativeProtocol" cellpadding="5" cellspacing="5" style="display: <?=($data['competent_authorities_id'] == 1) ? 'block' : 'none'?>">
			<tr>
				<td>Складено адміністративний протокол:</td><td><input type="checkbox" value="1" name="administrativeprotocol" onChange="changeAministrativeProtocol(this.checked)" <?=($data['administrativeprotocol'] == 1) ? 'checked' : ''?>></td>
				<td>
					<table id="blockAministrativeProtocolInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['administrativeprotocol'] == 1) ? 'block' : 'none'?>">
						<tr>
							<td class="label grey"><?=$this->getMark()?>Серія:</td>
							<td><input type="text" id="administrative_protocol_series" name="administrative_protocol_series" value="<?=$data['administrative_protocol_series']?>" maxlength="4" class="fldText lastname" style="width: 50px;" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
							<td class="label grey"><?=$this->getMark()?>Номер поліса:</td>
							<td><input type="text" id="administrative_protocol_number" name="administrative_protocol_number" value="<?=$data['administrative_protocol_number']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
							<td class="label grey"><?=$this->getMark()?>складений на:</td>
							<td><input type="text" id="administrative_protocol_persons" name="administrative_protocol_persons" value="<?=$data['administrative_protocol_persons']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>							
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td nowrap>Диспетчерський центр страховика:</td>
				<td><input type="checkbox" name="assistance" value="1" onclick="showHideAssistanceBlock()" <?=($data['assistance']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>
				<td>
					<table id="assistanceYes" cellpadding="0" cellspacing="5" style="display: <?=($data['assistance']) ? 'block' : 'none'?>">
						<tr>
							<td>з місця пригоди <input type="checkbox" name="assistance_place" value="1" <?=($data['assistance_place']) ? 'checked' : ''?> onclick="showHideAssistanceDate()" <?=$this->getReadonly(true)?> /></td>
							<td>
								<table id="assistance_dateBlock" cellpadding="0" cellspacing="5" style="display: <?=($data['assistance_place']) ? 'none' : 'block'?>">
								<tr>
									<td><?=$this->getMark()?>Дата:</td>
									<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ], $data[ 'assistance_date_year' ], $data[ 'assistance_date_month' ], $data[ 'assistance_date_day' ], 'assistance_date', $this->getReadonly(true))?></td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
					<table width="100%" id="assistanceNo" cellpadding="0" cellspacing="5" style="display: <?=($data['assistance']) ? 'none' : 'block'?>">
						<tr>
							<!--td><?=$this->getMark()?>Причина:<td>
							<td><input type="text" id="assistance_reason" name="assistance_reason" value="<?=$data['assistance_reason']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> /></td-->
							<td>Причина не повідомлення: </td>
							<td>
								<select name="assistance_reason" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onChange="changeNonInformationAreason(this.value)">
									<option value="0">...</option>
									<option value="1" <?=($data['assistance_reason'] == 1) ? 'selected' : ''?>>Відсутність зв'язку</option>
									<option value="2" <?=($data['assistance_reason'] == 2) ? 'selected' : ''?>>Не знав про необхідність дзвінка</option>
									<option value="3" <?=($data['assistance_reason'] == 3) ? 'selected' : ''?>>Інше</option>
								</select>
							</td>
							<td id="blockNoneInformationAtext" style="display: <?=($data['assistance_reason'] == 3) ? 'block' : 'none'?>">
								<input type="text" id="assistance_reason_text" name="assistance_reason_text" value="<?=$data['assistance_reason_text']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> />
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="blockCar" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Транспортний засіб:</div>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td>
					<input type="checkbox" value="1" name="inspecting_car" onChange="changeInspectingCar(this.checked)" <?=($data['inspecting_car'] == 1) ? 'checked' : ''?>>
				</td>
				<td>оглянути авто</td>
				<td>
					<table id="blockInspectingCarInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['inspecting_car'] > 0) ? 'block' : 'none'?>">
						<tr>
							<td class="label grey"><?=$this->getMark()?>адреса:</td><td><input type="text" name="inspecting_car_place" value="<?=$data['inspecting_car_place']?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly()?> /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="blockDriver" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Водій на момент ДТП:</div>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
				<td colspan="4"><input type="text" name="driver_lastname" value="<?=$data['driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
				<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
				<td colspan="2"><input type="text" name="driver_firstname" value="<?=$data['driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
				<td class="label grey"><?=$this->getMark()?>По батькові:</td>
				<td><input type="text" name="driver_patronymicname" value="<?=$data['driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
			</tr>
			<tr>
				<td class="label grey">Посвідчення водія</td>
				<td class="label grey"><?=$this->getMark()?>серія:</td><td><input type="text" id="driver_licence_series" name="driver_licence_series" value="<?=$data['driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> /></td>
				<td class="label grey"><?=$this->getMark()?>номер:</td><td><input type="text" id="driver_licence_number" name="driver_licence_number" value="<?=$data['driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
				<td class="label grey" align="left"><?=$this->getMark()?>дата:</td><td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_date') ], $data['driver_licence_date_year' ], $data['driver_licence_date_month' ], $data['driver_licence_date_day' ], 'driver_licence_date', $this->getReadonly(true))?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
		</table>
	</div>
	
	<div class="blockApplicant" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Інформація про заявника:</div>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td><input type="radio" name="applicant_types_id" value="1" onclick="setApplicant(1)" />Страхувальник</td>
				<td><input type="radio" name="applicant_types_id" value="2" onclick="setApplicant(2)" />Власник</td>
				<td><input type="radio" name="applicant_types_id" value="3" onclick="setApplicant(3)" />Водій</td>
			</tr>
		</table>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
				<td colspan="4"><input type="text" name="applicant_lastname" value="<?=$data['applicant_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
				<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
				<td><input type="text" name="applicant_firstname" value="<?=$data['applicant_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
				<td class="label grey"><?=$this->getMark()?>По батькові:</td>
				<td><input type="text" name="applicant_patronymicname" value="<?=$data['applicant_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>				
			</tr>
		</table>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark(false)?>Область:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('applicant_regions_id') ], $data['applicant_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
				<td class="label grey">Район:</td>
				<td><input type="text" name="applicant_area" value="<?=$data['applicant_area']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Місто:</td>
				<td><input type="text" name="applicant_city" value="<?=$data['applicant_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
			</tr>
		</table>
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey"><?=$this->getMark(false)?>Вулиця:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('applicant_street_types_id') ], $data['applicant_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="applicant_street" value="<?=$data['applicant_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark(false)?>Будинок:</td>
				<td><input type="text" name="applicant_house" value="<?=$data['applicant_house']?>" maxlength="15" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey">Квартира:</td>
				<td><input type="text" name="applicant_flat" value="<?=$data['applicant_flat']?>" maxlength="10" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
				<td class="label grey"><?=$this->getMark()?>Телефон(и):</td>
				<td><input type="text" name="applicant_phone" value="<?=$data['applicant_phone']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
			</tr>
		</table>
	</div>
	
	<div class="blockParticipants" style="display: <?=($data['id'] && is_array($data['participants']) && sizeOf($data['participants']) ? 'block' : 'none')?>">
		<div class="section">Інші учасники: <? if($action != 'view') { ?><a href="javascript: addParticipant()"><img src="/images/administration/navigation/add_over.gif" alt="Додати" width="19" height="19"></a><? } ?></div>
		<table id="participants" cellpadding="0" cellspacing="0">
		<?
			if (is_array($data['participants'])) {
				$i=0;
				foreach ($data['participants'] as $row) {echo "<script>participants_cars[" . $i . "] = new Array('" . $row['car_type_id'] . "', '" . $row['brand_id'] . "', '" . $row['model_id'] ."');</script>\r\n";
		?>
			<tr id="participants<?=$i?>">
				<td>
					<table cellpadding="5" cellspacing="0">
						<tr>
							<td class="label grey">Прізвище, ім'я, по батькові:</td>
							<td><input type="text" id="participants<?=$i?>name" name="participants[<?=$i?>][name]" value="<?=$row['name']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
							<td class="label grey">Тип ТЗ:</td>
							<td><select id="participants<?=$i?>car_type_id" name="participants[<?=$i?>][car_type_id]" value="" onchange="setBrandsCars(this.id)" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$row['car_types_id'].'">'.$row['car_type'].'</option>';}?></td>
							<td class="label grey">Марка:</td>
							<td><select id="participants<?=$i?>brand_id" name="participants[<?=$i?>][brand_id]" value="" onchange="setModelsCars(this.id)" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$row['brands_id'].'">'.$row['brand'].'</option>';}?></td>
							<input type="hidden" id="participants<?=$i?>brand" name="participants[<?=$i?>][brand]" value="<?=$row['brand']?>" />
							<td class="label grey">Модель:</td>
							<td><select id="participants<?=$i?>model_id" name="participants[<?=$i?>][model_id]" value="" onchange="setModelTitle(this.id)" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$row['models_id'].'">'.$row['model'].'</option>';}?></td>
							<input type="hidden" id="participants<?=$i?>model" name="participants[<?=$i?>][model]" value="<?=$row['model']?>" />
							<td class="label grey">Державний знак:</td>
							<td><input type="text" id="participants<?=$i?>sign" name="participants[<?=$i?>][sign]" value="<?=$row['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
						</tr>
					</table>				
				</td>
				<? if ($this->mode == 'update') {?><td><a href="javascript: deleteParticipant(<?=$i?>)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
			</tr>
		<?
					$i++;
				}
			}
		?>
		</table>
	</div>
	
	<div class="blockDoduments" style="display: <?=($data['id'] ? 'block' : 'none')?>">
		<div class="section">Документи:</div>
		<? include_once 'documents.php'; ?>
		<table width="600" cellpadding="5" cellspacing="0">
			<tr>
				<td width="50%" valign="top">
					<? if ($this->mode == 'update') {?>
					<table>
						<tr>
							<td><b>Інші документи:</b></td>
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
	</div>
	
	<? if($action != 'insert') { ?>
	<div class="section">Параметри:</div>
	<table>
		<tr>			
			<td>Статус:</td>
			<td>							
				<select name="statuses_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
					<option value="1" <?=($data['statuses_id'] == 1) ? 'selected' : ''?>>Створено</option>
					<option value="2" <?=($data['statuses_id'] == 2) ? 'selected' : ''?>>Прийнято</option>
				</select>				
			</td>
		</tr>
	</table>
	<? } ?>

	<? if ($action != 'view') {?>
	<table>
		<tr>
			<td>
				<input name="btn_save" type="submit" value=" Зберегти " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
			</td>
		</tr>
	</table>
	<? } ?>
	
</form>
<script type="text/javascript">	
    initFocus(document.<?=$this->objectTitle?>);
</script>

<div id="hiddenModalContent" style="display:none;">
    
	<table cellpadding="5" cellspacing="0" border="1">
	<tr>
		<td class="label grey">Номер договору:</td>
		<td><input type="text" id="search_policies_number" name="search_policies_number" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Дата:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('search_policies_date') ], $data['search_policies_date_year' ], $data['search_policies_date_month' ], $data['search_policies_date_day' ], 'search_policies_date', $this->getReadonly(true))?></td>
		<td class="label grey">Страхувальник:</td>
		<td><input type="text" id="search_insurer_lastname" name="search_insurer_lastname" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
	</tr>
	<!--/table>

	<table cellpadding="5" cellspacing="0"-->
	<tr>		
		<td class="label grey">Паспорт:</td>
		<td>
			<input type="text" id="search_insurer_passport_series" name="search_insurer_passport_series" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
			<input type="text" id="search_insurer_passport_number" name="search_insurer_passport_number" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
		</td>
		<td class="label grey">ІПН:</td>
		<td><input type="text" id="search_insurer_identification_code" name="search_insurer_identification_code" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Водійські права:</td>
		<td>
			<input type="text" id="search_insurer_driver_licence_series" name="search_insurer_driver_licence_series" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
			<input type="text" id="search_insurer_driver_licence_number" name="search_insurer_driver_licence_number" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
		</td>		
	</tr>
	<!--/table>

	<table cellpadding="5" cellspacing="0"-->
	<tr>		
		<td class="label grey">№ шасі (кузов, рама):</td>
		<td><input type="text" id="search_shassi" name="search_shassi" maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Державний знак:</td>
		<td><input type="text" id="search_sign" name="search_sign" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
		<td></td>
		<td align="right"><input type="button" id="search_button" value="Знайти" onclick="searchPolicy(0)" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td>
	</tr>
	</table>
	
	<div id="searchPoliciesList" style="width: 780px;">
	</div>
</div>