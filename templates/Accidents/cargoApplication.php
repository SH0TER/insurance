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
            $('#insurer_identification_code').val()) {
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Policies|getSearchInWindow' +
                                '&datetime=' + $('input[name=datetime]').val() +
								'&product_types_id=<?=$this->product_types_id?>' +
								'&policies_id=<?=$data['policies_id']?>' +
                                items_id+
								'&accidents_id=<?=$data['id']?>' +
								'&number=' + $('input[name=policies_number]').val() +
								'&date=' + $('input[name=policies_date_year]').val() + '.' + $('input[name=policies_date_month]').val() + '.' + $('input[name=policies_date_day]').val() +
								'&important_person=<?=$data['important_person']?>' +
								'&roles_id=<?=$Authorization->data['roles_id']?>' +
								'&one_shipping='+$('input[name=one_shipping]:checked').val(),
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
	
	function setRisks(application_risks_id) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=Policies|getRisksInWindow' +
                        '&product_types_id=<?=PRODUCT_TYPES_CARGO_CERTIFICATE?>' +
						'&id=' + $('#policies_id').val() +
						'&accidents_id=<?=$data['id']?>' +
						'&application_risks_id=' + application_risks_id+
						'&one_shipping='+$('input[name=one_shipping]:checked').val(),
			success: function(result) {
				$('#risks').html( result );
			}
		});
	}

	function choosePolicy(policies_id) {
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

		$('input[name=datetime]').change(function(){
			$('#policies_id').val(0);
			$('#policies').html('');
		});
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
		<td class="label grey">Номер сертифікату (договору - для РВ):</td>		
		<td><input type="text" id="policies_number" name="policies_number" value="<?=$data['policies_number']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
		<td><input type="checkbox" name="one_shipping" value="1" <?=(intval($data['one_shipping']) || $data['policies_product_types_id'] == 21 ? 'checked' : '')?> /> разове вантажоперевезення</td>
		<td class="label grey">Дата:</td>
		<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policies_date') ], $data['policies_date_year' ], $data['policies_date_month' ], $data['policies_date_day' ], 'policies_date', $this->getReadonly(true))?></td>
        <? if ($this->mode == 'update') { ?><td><input type="button" id="search_button" value="Знайти" onclick="searchPolicy(1)" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td><? } ?>
	</tr>
	</table>

	<div id="policies"></div>

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
	setRisks(<?=$data['application_risks_id']?>);
    initFocus(document.<?=$this->objectTitle?>);
</script>