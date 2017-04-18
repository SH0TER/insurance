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

    var participants_cars = new Array();

    function searchPolicy() {
        if ($('#policies_number').val() ||
            $('#insurer_lastname').val() ||
            $('#insurer_passport_series').val() ||
            $('#insurer_passport_number').val() ||
            $('#insurer_identification_code').val()) {
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Policies|getSearchInWindow' +
								'&product_types_id=<?=$this->product_types_id?>' +
								'&policies_id=<?=$data['policies_id']?>' +
								//'&items_id=<?=$data['items_id']?>' +
								'&accidents_id=<?=$data['id']?>' +
								'&number=' + $('input[name=policies_number]').val() +
								'&date=' + $('input[name=policies_date_year]').val() + '.' + $('input[name=policies_date_month]').val() + '.' + $('input[name=policies_date_day]').val() +
								'&insurer_lastname=' + $('input[name=insurer_lastname]').val() +
								'&insurer_passport_series=' + $('input[name=insurer_passport_series]').val() +
								'&insurer_passport_number=' + $('input[name=insurer_passport_number]').val() +
                                				'&important_person=<?=$data['important_person']?>' +
								'&insurer_identification_code=' + $('input[name=insurer_identification_code]').val(),
					success: function(result) {
						$('#policies').html(result);
                        $('#risks').html('');
                        $('#objects').html('');
                        $('#items').html('');
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

	function setRisks(objects_id, risks_id){
        var application_risks_id = 0;
        if(risks_id) application_risks_id = risks_id;
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=Policies|getRisksInWindow' +
                        '&accidents_id=<?=$data['id']?>' +
                        '&product_types_id=<?=$this->product_types_id?>' +
                        '&objects_id=' + objects_id +
						'&application_risks_id=' + application_risks_id,
			success: function(result){
				        $('#risks').html(result);
			}
		});
	}

    function setObjects(policies_id){
        if(policies_id){
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'html',
                data:       'do=Policies|getObjectsInWindow'+
                            '&accidents_id=<?=$data['id']?>' +
                            '&product_types_id=<?=$this->product_types_id?>'+
                            '&policies_id='+policies_id+
                            '&objects_id=<?=$data['objects_id']?>',
                success:    function(result){
                                $('#objects').html(result);
                                setItems(parseInt($('input[name=objects_id]').val()));
                }
            })
        }
    }

    function setItems(objects_id){
        if(objects_id){
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'html',
                data:       'do=Policies|getItemsInWindow'+
                            '&accidents_id=<?=$data['id']?>' +
                            '&product_types_id=<?=$this->product_types_id?>'+
                            '&objects_id='+objects_id+
                            '&items_id=<?=$data['items_id']?>',
                success:    function(result){
                                $('#items').html(result);
                                setRisks(objects_id, parseInt($('input[name=application_risks_id]').val()));
                }
            })
        }
    }

    function setObjectsItems(policies_id){
        if(policies_id){
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'html',
                data:       'do=Policies|getObjectsItemsInWindow'+
                            '&accidents_id=<?=$data['id']?>' +
                            '&product_types_id=<?=$this->product_types_id?>'+
                            '&policies_id='+policies_id+
                            '&items_id=<?=$data['items_id']?>',
                success:    function(result){
                                $('#objects').html(result);
                                //setItems(parseInt($('input[name=objects_id]').val()));
                                setRisk(parseInt($('input[name=items_id]').val()));
                }
            })
        }
    }

    function setRisk(items_id){
        if(items_id){
            $.ajax({
                type:		'POST',
                url:		'index.php',
                dataType:	'html',
                data:		'do=Policies|getRisksInWindow' +
                            '&accidents_id=<?=$data['id']?>' +
                            '&product_types_id=<?=$this->product_types_id?>' +
                            '&items_id=' + items_id+
                            '&application_risks_id=<?=$data['application_risks_id']?>',
                success: function(result){
                            $('#risks').html(result);
                }
            });
        }
	}

	function choosePolicy(policies_id) {
		$('#policies_id').val(policies_id);
        $('#risks').html('');
        setObjectsItems(policies_id);
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
        $("select[name=car_services_id]").index($("select[name=car_services_id]").val('1'));
        changeCarServiceForMasters();
        changeCarServiceForInspecting();
    });

</script>
<? $Log->showSystem();?>
<div id="txt"></div>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF)']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields();">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$this->product_types_id?>" />
    <input type="hidden" name="payment_statuses_id" value="<?=$data['payment_statuses_id']?>" />
    <input type="hidden" name="objects_id" value="<?=$data['objects_id']?>" />
    <input type="hidden" name="items_id" value="<?=$data['items_id']?>" />
    <input type="hidden" name="application_risks_id" value="<?=$data['application_risks_id']?>" />
    <? include_once 'Accidents/monitoring.php'?>
    <div id="comments"></div>
	<div class="section">Поліс:</div>
	<table cellpadding="5" cellspacing="0">
	<tr>
        <td class="label grey">Назва компанії:</td>
        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('companies_id') ], $data['companies_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
		<td class="label grey">Номер:</td>
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

	<div id="policies"></div>
    <div id="objects"></div>
    <div id="items"></div>

	<!--div class="section">Заявник:<? if ($this->mode != 'view') {?> <span class="links"><a href="javascript: setPolicyValues('insurer', 'applicant')">Страхувальник</a> | <a href="javascript: setPolicyValues('owner', 'applicant')">Власник</a><?}?></span></div-->
    <div class="section">Заявник:</div>
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
		<td class="label grey"><?=$this->getMark()?>Місце знаходження майна:</td>
		<td colspan="3"><input type="text" name="location" value="<?=$data['location']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
	</tr>
	</table>
    <div class="section">Ризик:</div>
    <div id="risks"></div>
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
        <td class="label grey"><?=$this->getMark()?>Огляд майна провів:</td>
        <td><select id="inspecting_master" name="inspecting_account_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
	</tr>
	</table>
	<? } else {?>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td colspan="5">
                    <td class="label grey"><?=$this->getMark()?>Огляд майна провів:</td>
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
    searchPolicy();
    choosePolicy(<?=$data['policies_id']?>);
    initFocus(document.<?=$this->objectTitle?>);
</script>