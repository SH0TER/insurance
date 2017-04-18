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
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<link rel="stylesheet" href="/js/jquery/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript">
	function changeRowStyle(item) {
		for (i=0; i < document.getElementById( item ).rows.length; i++) {
			document.getElementById( item ).rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

	function checkDownloadAgreement(policies_id) {
		/*$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=PolicyDocuments|downloadFileInWindow' +
						'&file=' + file +
						'&product_types_id=<?=PRODUCT_TYPES_KASKO?>' +						
						'&policies_id=' + policies_id +
						'&print=1',
			success: function(result) {
				//var WinPrint = window.open('','','letf=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status=0');
				var WinPrint = window.open();
				WinPrint.document.write(result);
				WinPrint.document.close();
				WinPrint.focus();
				WinPrint.print();
				WinPrint.close();
				//$('#print_agr').innerHTML=strOldOne;
			}
		});*/
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=Policies|checkAgreementPoliciesInWindow' +
						'&id=' + policies_id +
						'&mode=2',
			success: function(result) {
				if (result.done == 1) {
					tb_remove();
				}
			}
		});
	}

    var cars = new Array();
    var types = new Array();

    var participants_cars = new Array();

    function searchPolicy(type) {
        if (type==0){
            items_id = '&items_id=<?=$data['items_id']?>';
        } else {
            items_id = '';
        }
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
                                '&datetime=' + $('input[name=datetime]').val() +
								'&product_types_id=<?=$this->product_types_id?>' +
								'&policies_id=<?=$data['policies_id']?>' +
								//'&items_id=<?=$data['items_id']?>' +
                                items_id+
								'&accidents_id=<?=$data['id']?>' +
								'&number=' + $('input[name=policies_number]').val() +
								'&date=' + $('input[name=policies_date_year]').val() + '.' + $('input[name=policies_date_month]').val() + '.' + $('input[name=policies_date_day]').val() +
								'&insurer_lastname=' + $('input[name=insurer_lastname]').val() +
								'&insurer_passport_series=' + $('input[name=insurer_passport_series]').val() +
								'&insurer_passport_number=' + $('input[name=insurer_passport_number]').val() +
								'&insurer_identification_code=' + $('input[name=insurer_identification_code]').val() +
								'&shassi=' + $('input[name=shassi]').val() +
								'&sign=' + $('input[name=sign]').val() +
								'&important_person=<?=$data['important_person']?>' +
								'&roles_id=<?=$Authorization->data['roles_id']?>',
					success: function(result) {
						$('#policies').html(result);
                        $('input[name=count_items_id]').val($('input[name=items_id]').size());
					}
				});
        }
    }

    function checkFields() {
        if($('select[name=companies_id] option:selected').val() == 4) {
            if (!$('input[name=items_id]:checked').val()) {
                alert('Необхідно вибрати договір страхування!');
                return false;
            }
        }
        return true;
    }

	function setPolicyValues(sourcePerson, destinitionPerson) {

		if ($('input[name=items_id]:checked').val() > 0) {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Policies|getApplicantValuesInWindow' +
							'&product_types_id=<?=$this->product_types_id?>' +
							'&id=' + $('input[name=items_id]:checked').val() + 
							'&person=' + sourcePerson,
				success: function(result) {
					switch (destinitionPerson) {
						case 'applicant':
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
		if (<?=intval($Authorization->data['roles_id'])?> == <?=intval(ROLES_MASTER)?>) {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'html',
				data:		'do=Policies|checkAgreementPoliciesInWindow' +
							'&id=' + policies_id + 
							'&mode=1',
				success: function(result) {
					if (result.length) {
						tb_show('<strong>Додаткові угоди:</strong>', "#TB_inline?height=300&width=500&inlineId=hiddenModalContent&modal=true", true);
						$('#TB_ajaxContent').html(result);				
					}
				}
			});
		}		
		$('#policies_id').val( policies_id );
		setRisks( $('input[name=application_risks_id]:checked').val() );
	}

    function showHideMVSBlock() {
		switch ($('select[name=mvs] option:selected').val()) {
			case '1'://Органи ГАИ
				$('#dai').css('display', 'block');
				$('#rugu').css('display', 'none');
				$('#mvsYes').css('display', 'block');
				break;
			case '2':
			case '3':
				$('#dai').css('display', 'none');
				$('#rugu').css('display', 'block');
				$('#mvs_id').val('');
				$('#mvsYes').css('display', 'block');
				break;
			default:
				$('#mvsYes').css('display', 'none');
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

	function setOwner(owner, i) {
		if (owner.checked) {
			$('#owner' + i).css('display', 'none');
			$('#participants' + i + 'owner_lastname').val( $('#participants' + i + 'insurer_lastname').val() );
			$('#participants' + i + 'owner_firstname').val( $('#participants' + i + 'insurer_firstname').val() );
			$('#participants' + i + 'owner_patronymicname').val( $('#participants' + i + 'insurer_patronymicname').val() );
			$('#participants' + i + 'owner_address').val( $('#participants' + i + 'insurerAddress').val() );
			$('#participants' + i + 'owner_phone').val( $('#participants' + i + 'insurer_phone').val() );
		} else {
			$('#owner' + i).css('display', 'block');
			$('#participants' + i + 'owner_lastname').val('');
			$('#participants' + i + 'owner_firstname').val('');
			$('#participants' + i + 'owner_patronymicname').val('');
			$('#participants' + i + 'owner_address').val('');
			$('#participants' + i + 'owner_phone').val('');
		}
	}

	function changeParticipantsRowStyle() {
		for (i=0; i < document.getElementById('participants').rows.length; i++) {
			document.getElementById('participants').rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

    var num = 0;

    function addParticipant() {

    	var participant =
	    	'<tr id="participants' + num + '">' +
				'<td>' +
					'<table cellpadding="5" cellspacing="0">' +
					'<tr>' +
                        '<td class="grey">Тип ТЗ:</td>' +
						'<td><select id="participants[' + num + '][car_types_id]" name="participants[' + num + '][car_types_id]" class="fldSelect" value="" onchange="setBrandsCars(this.id)" /></select></td>' +
						'<td class="grey">Марка:</td>' +
						'<td><select id="participants[' + num + '][brands_id]" name="participants[' + num + '][brands_id]" class="fldSelect" value="" onchange="setModelsCars(this.id)" /></select></td>' +
                        '<input type="hidden" id="participants[' + num + '][brand]" name="participants[' + num + '][brand]" value="" />' +
                        '<td class="grey">Модель:</td>' +
						'<td><select id="participants[' + num + '][models_id]" name="participants[' + num + '][models_id]" class="fldSelect" value="" onchange="setModelTitle(this.id)" /></select></td>' +
                        '<input type="hidden" id="participants[' + num + '][model]" name="participants[' + num + '][model]" value="" />' +
						'<td class="label grey">Державний знак:</td>' +
						'<td><input type="text" name="participants[' + num + '][sign]" value="" maxlength="10" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
						'<td class="label grey">Cтрахова компанія:</td>' +
						'<td><input type="text" name="participants[' + num + '][insurance_company]" value="" maxlength="50" class="fldText company" onfocus="this.className=\'fldTextOver company\'" onblur="this.className=\'fldText company\'" /></td>' +
						'<td class="label grey">№ полісу:</td>' +
						'<td><input type="text" name="participants[' + num + '][insurance_number]" value="" maxlength="20" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
					'</tr>' +
					'</table>' +

					'<div style="border-bottom: 1px solid #4453AF; font-weight: bold; padding: 5px 0 0 5px;">Водій:</div>' +
					'<table cellpadding="5" cellspacing="0">' +
					'<tr>' +
						'<td class="label grey">Прізвище:</td>' +
						'<td><input type="text" id="participants' + num + 'driver_lastname" name="participants[' + num + '][driver_lastname]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" /></td>' +
						'<td class="label grey">Ім\'я:</td>' +
						'<td><input type="text" id="participants' + num + 'driver_firstname" name="participants[' + num + '][driver_firstname]" value="" maxlength="50" class="fldText firstname" onfocus="this.className=\'fldTextOver firstname\'" onblur="this.className=\'fldText firstname\'" /></td>' +
						'<td class="label grey">По батькові:</td>' +
						'<td><input type="text" id="participants' + num + 'driver_patronymicname" name="participants[' + num + '][driver_patronymicname]" value="" maxlength="50" class="fldText patronymicname" onfocus="this.className=\'fldTextOver patronymicname\'" onblur="this.className=\'fldText patronymicname\'" /></td>' +
					'</tr>' +
					'</table>' +

					'<table cellpadding="5" cellspacing="0">' +
					'<tr>' +
						'<td class="label grey">Адреса:</td>' +
						'<td><input type="text" id="participants' + num + 'driver_address" name="participants[' + num + '][driver_address]" value="" maxlength="100" class="fldText address" onfocus="this.className=\'fldTextOver address\'" onblur="this.className=\'fldText address\'" /></td>' +
						'<td class="label grey">Телефон:</td>' +
						'<td><input type="text" id="participants' + num + 'driver_phone" name="participants[' + num + '][driver_phone]" value="" maxlength="15" class="fldText phone" onfocus="this.className=\'fldTextOver phone\'" onblur="this.className=\'fldText phone\'" /></td>' +
						'<td class="label grey">Власник ТЗ:</td>' +
						'<td><input type="checkbox" name="owner" value="1" onclick="setOwner(this, ' + num + ')" /></td>' +
					'</tr>' +
					'</table>' +

					'<div id="owner' + num + '">' +
						'<div style="border-bottom: 1px solid #4453AF; font-weight: bold; padding: 5px 0 0 5px;">Власник:</div>' +
						'<table cellpadding="5" cellspacing="0">' +
						'<tr>' +
							'<td class="label grey">Прізвище:</td>' +
							'<td><input type="text" id="participants' + num + 'owner_lastname" name="participants[' + num + '][owner_lastname]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" /></td>' +
							'<td class="label grey">Ім\'я:</td>' +
							'<td><input type="text" id="participants' + num + 'owner_firstname" name="participants[' + num + '][owner_firstname]" value="" maxlength="50" class="fldText firstname" onfocus="this.className=\'fldTextOver firstname\'" onblur="this.className=\'fldText firstname\'" /></td>' +
							'<td class="label grey">По батькові:</td>' +
							'<td><input type="text" id="participants' + num + 'owner_patronymicname" name="participants[' + num + '][owner_patronymicname]" value="" maxlength="50" class="fldText patronymicname" onfocus="this.className=\'fldTextOver patronymicname\'" onblur="this.className=\'fldText patronymicname\'" /></td>' +
						'</tr>' +
						'<tr>' +
							'<td class="label grey">Адреса:</td>' +
							'<td><input type="text" id="participants' + num + 'owner_address" name="participants[' + num + '][owner_address]" value="" maxlength="100" class="fldText address" onfocus="this.className=\'fldTextOver address\'" onblur="this.className=\'fldText address\'" /></td>' +
							'<td class="label grey">Телефон:</td>' +
							'<td colspan="3"><input type="text" id="participants' + num + 'owner_phone" name="participants[' + num + '][owner_phone]" value="" maxlength="15" class="fldText phone" onfocus="this.className=\'fldTextOver phone\'" onblur="this.className=\'fldText phone\'" /></td>' +
						'</tr>' +
						'</table>' +
					'</div>' +
				'</td>' +
				'<td><a href="javascript: deleteParticipant(' + num + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
			'</tr>';

    	$('#participants').append(participant);


        setTypesCars("participants[" + num + "][car_types_id]");

        num++;

		changeParticipantsRowStyle();
    }
    function deleteParticipant(i) {
        if (confirm('Ви дійсно бажаєте вилучити інформацію по одному з участників ДТП?')) {

        	$('#participants' + i).remove();

			changeParticipantsRowStyle();
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
			$('#search_button').hide();
			$('#missing_data').show();
			$('#policies').html('');
		} else{
			$("#search_button").show();
			$("#missing_data").hide();
		}
    }

    $(document).ready(function(){
        $('input[name=count_items_id]').val($('input[name=items_id]').size());
        $('select[name=companies_id] option:last').attr('selected','selected');
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
        $("select[name=companies_id]").attr('selectedIndex', 1);//выбираем "Експресс Страхование"
        changeInsuranceCompany();
         $('select[name=companies_id]').change(function(){
         changeInsuranceCompany()
        });
        getTypesCar();
        <? if (!ereg('view', $action)) { ?>
            getCar();
    	<? } ?>

	$('input[name=datetime]').change(function(){
		$('#policies_id').val(0);
		$('#policies').html('');
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
        var brands = document.getElementById(id.replace('car_types_id', 'brands_id'));
        var models = document.getElementById(id.replace('car_types_id', 'models_id'));
        brands.options.length = 0;
        models.options.length = 0;
        document.getElementById(id.replace('car_types_id', 'brand')).value = '';
        document.getElementById(id.replace('car_types_id', 'model')).value = '';
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
        var car_types = document.getElementById(id.replace('brands_id', 'car_types_id'));
        var models = document.getElementById(id.replace('brands_id', 'models_id'));
        document.getElementById(id.replace('brands_id', 'brand')).value = brands[brands.selectedIndex].text;
        document.getElementById(id.replace('brands_id', 'model')).value = '';
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
        document.getElementById(id.replace('models_id', 'model')).value = models[models.selectedIndex].text;
    }

    function setCars(){
        if (participants_cars.length > 0) {
            for (var i=0; i < participants_cars.length; i++){
                setTypesCars("participants[" + i + "][car_types_id]");
                document.getElementById("participants[" + i + "][car_types_id]").value = participants_cars[i][0];
                setBrandsCars("participants[" + i + "][car_types_id]");
                document.getElementById("participants[" + i + "][brands_id]").value = participants_cars[i][1];
                setModelsCars("participants[" + i + "][brands_id]");
                document.getElementById("participants[" + i + "][models_id]").value = participants_cars[i][2];
                setModelTitle("participants[" + i + "][models_id]");
            }
        }
    }

    function getTypesCar(){
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarTypes|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_KASKO?>',
            success:    function(result){
                if (participants_cars.length > 0) {
                    for (var i=0; i < participants_cars.length; i++){
                        setTypesCars("participants[" + i + "][car_types_id]");
                        document.getElementById("participants[" + i + "][car_types_id]").value = participants_cars[i][0];
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
            data:       'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_KASKO?>',
            success:    function (result) {
                setCars();
            }
        });
    }
</script>
<? $Log->showSystem();?>
<div id="txt"></div>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF)']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields();">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$this->product_types_id?>" />
    <input type="hidden" name="payment_statuses_id" value="<?=$data['payment_statuses_id']?>" />
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
		<td class="label grey"><?=$this->getMark()?>Пошкодження:</td>
		<td colspan="3"><textarea name="damage" style="height: 50px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['damage']?></textarea></td>
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
		<td class="label grey">Номер договору:</td>
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
		<? if ($this->mode == 'update') { ?><td><input type="button" id="search_button" value="Знайти" onclick="searchPolicy(1)" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td><? } ?>
	</tr>
	</table>

	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey">Водійські права:</td>
		<td>
			<input type="text" id="insurer_driver_licence_series" name="insurer_driver_licence_series" value="<?=$data['insurer_driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
			<input type="text" id="insurer_driver_licence_number" name="insurer_driver_licence_number" value="<?=$data['insurer_driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
		</td>
		<td class="label grey">№ шасі (кузов, рама):</td>
		<td><input type="text" id="shassi" name="shassi" value="<?=$data['shassi']?>" maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly()?> /></td>
		<td class="label grey">Державний знак:</td>
		<td><input type="text" id="sign" name="sign" value="<?=$data['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
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

	<div class="section">Заявник:<? if ($this->mode != 'view') {?> <span class="links"><a href="javascript: setPolicyValues('insurer', 'applicant')">Страхувальник</a> | <a href="javascript: setPolicyValues('owner', 'applicant')">Власник</a><?}?></span></div>

	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
		<td><input type="text" name="applicant_lastname" value="<?=$data['applicant_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
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
		<td><input type="text" name="applicant_phones" value="<?=$data['applicant_phones']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table>

    <div class="section">Ризик, тип події, ступінь тяжкості наслідків:</div>
    <div id="risks"></div>
	<div class="section">Повідомлено:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs') ], $data['mvs'], $data['languageCode'], $this->getReadonly(true) . ' onChange="showHideMVSBlock()"', null, $data)?></td>
		<td>
			<table id="mvsYes" cellpadding="0" cellspacing="5" style="display: <?=($data['mvs'] > 0) ? 'block' : 'none'?>">
			<tr>
				<td class="label grey"><?=$this->getMark()?>а саме:</td>
				<td id="dai" style="display: <?=($data['mvs'] == 1) ? 'block' : 'none'?>"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ], $data['mvs_id'], $data['languageCode'], 'style="width: 390px;" ' . $this->getReadonly(true), null, $data)?></td>
				<td id="rugu" style="display: <?=($data['mvs'] > 1) ? 'block' : 'none'?>"><input type="text" id="mvs_title" name="mvs_title" value="<?=($data['mvs'] > 1) ? $data['mvs_title'] : ''?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly()?> /></td>
				<td class="label grey"><?=$this->getMark()?>Дата:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ], $data[ 'mvs_date_year' ], $data[ 'mvs_date_month' ], $data[ 'mvs_date_day' ], 'mvs_date', $this->getReadonly(true))?></td>
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
				<td><?=$this->getMark()?>Причина:<td>
				<td><input type="text" id="assistance_reason" name="assistance_reason" value="<?=$data['assistance_reason']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> />
			</tr>
			</table>
		</td>
	</tr>
	</table>

	<div class="section">На час настання страхового випадку транспортним засобом керував:<? if ($this->mode != 'view') {?> <span class="links"><a href="javascript: setPolicyValues('insurer', 'driver')">Страхувальник</a> | <a href="javascript: setPolicyValues('owner', 'driver')">Власник</a></span><? } ?></div>
	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Прізвище:</td>
		<td><input type="text" id="driver_lastname" name="driver_lastname" value="<?=$data['driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
		<td class="label grey"><?=$this->getMark()?>Ім'я:</td>
		<td><input type="text" id="driver_firstname" name="driver_firstname" value="<?=$data['driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
		<td class="label grey"><?=$this->getMark()?>По батькові:</td>
		<td><input type="text" id="driver_patronymicname" name="driver_patronymicname" value="<?=$data['driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table>

	<table cellpadding="5" cellspacing="0">
	<tr>
		<td class="label grey"><?=$this->getMark()?>Водійські права, серія, номер і дата:</td>
		<td>
			<input type="text" id="driver_licence_series" name="driver_licence_series" value="<?=$data['driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
			<input type="text" id="driver_licence_number" name="driver_licence_number" value="<?=$data['driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
		</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_date') ], $data['driver_licence_date_year' ], $data['driver_licence_date_month' ], $data['driver_licence_date_day' ], 'driver_licence_date', $this->getReadonly(true))?></td>
		<td class="label grey"><?=$this->getMark()?>Керував на підставі:</td>
		<td style="width:400px;"><input type="text" id="driver_document" name="driver_document" value="<?=$data['driver_document']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table>

	<div class="section">Інші учасники пригоди: <? if ($this->mode == 'update') {?><a href="javascript: addParticipant()"><img src="/images/administration/navigation/add_over.gif" alt="Додати" width="19" height="19"></a><? } ?></div>
	<table id="participants" cellpadding="0" cellspacing="0">
	<?
		if (is_array($data['participants'])) {
			foreach ($data['participants'] as $i => $row) {echo "<script>participants_cars[" . $i . "] = new Array('" . $row['car_types_id'] . "', '" . $row['brands_id'] . "', '" . $row['models_id'] ."');</script>\r\n";
    ?>
	<tr id="participants<?=$i?>">
		<td>
			<table cellpadding="5" cellspacing="0">
			<tr>
                <td class="label grey">Тип ТЗ:</td>
				<td><select id="participants[<?=$i?>][car_types_id]" name="participants[<?=$i?>][car_types_id]" value="" onchange="setBrandsCars(this.id)" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$row['car_types_id'].'">'.$row['car_type'].'</option>';}?></td>
				<td class="label grey">Марка:</td>
				<td><select id="participants[<?=$i?>][brands_id]" name="participants[<?=$i?>][brands_id]" value="" onchange="setModelsCars(this.id)" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$row['brands_id'].'">'.$row['brand'].'</option>';}?></td>
                <input type="hidden" id="participants[<?=$i?>][brand]" name="participants[<?=$i?>][brand]" value="<?=$row['brand']?>" />
                <td class="label grey">Модель:</td>
				<td><select id="participants[<?=$i?>][models_id]" name="participants[<?=$i?>][models_id]" value="" onchange="setModelTitle(this.id)" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?if (ereg('view', $action)) { ?> disabled="disabled" <? } ?> <?=$this->getReadonly()?>><?if (ereg('view', $action)) {echo '<option value="'.$row['models_id'].'">'.$row['model'].'</option>';}?></td>
                <input type="hidden" id="participants[<?=$i?>][model]" name="participants[<?=$i?>][model]" value="<?=$row['model']?>" />
				<td class="label grey">Державний знак:</td>
				<td><input type="text" name="participants[<?=$i?>][sign]" value="<?=$row['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
				<td class="label grey">Cтрахова компанія:</td>
				<td><input type="text" name="participants[<?=$i?>][insurance_company]" value="<?=$row['insurance_company']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly()?> /></td>
				<td class="label grey">№ полісу:</td>
				<td><input type="text" name="participants[<?=$i?>][insurance_number]" value="<?=$row['insurance_number']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
			</tr>
			</table>
			<div style="border-bottom: 1px solid #4453AF; font-weight: bold; padding: 5px 0 0 5px;">Водій:</div>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey">Прізвище:</td>
				<td><input type="text" id="participants<?=$i?>driver_lastname" name="participants[<?=$i?>][driver_lastname]" value="<?=$row['driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
				<td class="label grey">Ім'я:</td>
				<td><input type="text" id="participants<?=$i?>driver_firstname" name="participants[<?=$i?>][driver_firstname]" value="<?=$row['driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
				<td class="label grey">По батькові:</td>
				<td><input type="text" id="participants<?=$i?>driver_patronymicname" name="participants[<?=$i?>][driver_patronymicname]" value="<?=$row['driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
			</tr>
			</table>
			<table cellpadding="5" cellspacing="0">
			<tr>
				<td class="label grey">Адреса:</td>
				<td><input type="text" id="participants<?=$i?>driver_address" name="participants[<?=$i?>][driver_address]" value="<?=$row['driver_address']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> /></td>
				<td class="label grey">Телефон:</td>
				<td><input type="text" id="participants<?=$i?>driver_phone" name="participants[<?=$i?>][driver_phone]" value="<?=$row['driver_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly()?> /></td>
				<td class="label grey">Власник ТЗ:</td>
				<td><input type="checkbox" name="owner" value="1" <?=($data['participants'][ $i ]['driver_lastname'] == $data['participants'][ $i ]['owner_lastname'] && $data['participants'][ $i ]['driver_firstname'] == $data['participants'][ $i ]['owner_firstname'] && $data['participants'][ $i ]['driver_patronymicname'] == $data['participants'][ $i ]['owner_patronymicname'] && $data['participants'][ $i ]['driver_address'] == $data['participants'][ $i ]['owner_address'] && $data['participants'][ $i ]['driver_phone'] == $data['participants'][ $i ]['owner_phone']) ? 'checked' : ''?> onclick="setOwner(this, <?=$i?>)" <?=$this->getReadonly(true)?> /></td>
			</tr>
			</table>

			<div id="owner<?=$i?>">
				<div style="border-bottom: 1px solid #4453AF; font-weight: bold; padding: 5px 0 0 5px;">Власник:</div>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey">Прізвище:</td>
					<td><input type="text" id="participants<?=$i?>owner_lastname" name="participants[<?=$i?>][owner_lastname]" value="<?=$row['owner_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
					<td class="label grey">Ім'я:</td>
					<td><input type="text" id="participants<?=$i?>owner_firstname" name="participants[<?=$i?>][owner_firstname]" value="<?=$row['owner_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
					<td class="label grey">По батькові:</td>
					<td><input type="text" id="participants<?=$i?>owner_patronymicname" name="participants[<?=$i?>][owner_patronymicname]" value="<?=$row['owner_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
				</tr>
				<tr>
					<td class="label grey">Адреса:</td>
					<td><input type="text" id="participants<?=$i?>owner_address" name="participants[<?=$i?>][owner_address]" value="<?=$row['owner_address']?>" maxlength="100" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly()?> /></td>
					<td class="label grey">Телефон:</td>
					<td colspan="3"><input type="text" id="participants<?=$i?>owner_phone" name="participants[<?=$i?>][owner_phone]" value="<?=$row['owner_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly()?> /></td>
				</tr>
				</table>
			</div>
		</td>
		<? if ($this->mode == 'update') {?><td><a href="javascript: deleteParticipant(<?=$i?>)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
	</tr>
	<?
			}
		}
	?>
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
		<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('car_services_id') ], $data['car_services_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeCarServiceForMasters();changeCarServiceForInspecting();"', null, $data)?></td>
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
</form>
<script type="text/javascript">
    <? if ($Authorization->data['roles_id'] != ROLES_MASTER) { echo 'changeCarServiceForMasters(' . $data['masters_id'] . '); changeCarServiceForInspecting(' . $data['inspecting_account_id'] . ');'; } ?>
    searchPolicy(0);
	changeRowStyle('participants');
	setRisks(<?=$data['application_risks_id']?>);
    initFocus(document.<?=$this->objectTitle?>);
</script>