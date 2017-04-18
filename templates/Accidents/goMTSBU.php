<script type="text/javascript">
    var cars = new Array();
    var types = new Array();
    var owner_car = new Array();

       <? if (!ereg('view', $action)) { ?>
           getCarTypes();
           getCar();
       <? } ?>


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
    function changePersonType(value) {
        if (value == 1) {
            $('.legal').css('display','none');
            $('.phys').css('display','');
            $('.all').css('display','');
        }
        else if (value == 2) {
            $('.legal').css('display','');
            $('.phys').css('display','none');
            $('.all').css('display','');
        }
    }

    function setPolicyValues(sourcePerson, destinitionPerson) {

			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Policies|getApplicantValuesInWindow' +
							'&product_types_id=<?=$this->product_types_id?>' +
							'&id=' + $('input[name=policies_id]').val() +
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
							$('input[name=insurer_driver_lastname]').val( result.lastname );
							$('input[name=insurer_driver_firstname]').val( result.firstname );
							$('input[name=insurer_driver_patronymicname]').val( result.patronymicname );
							$('input[name=insurer_driver_identification_code]').val( result.identification_code );
							break;
					}
				}
			});
	}

    $(document).ready(function(){

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

</script>
<? $Log->showSystem();
        if (intval($data['id'])){
            echo "<script>owner_car = new Array('" . $data['owner_car_type_id'] . "', '" . $data['owner_brand_id'] . "', '" . $data['owner_model_id'] ."');</script>\r\n";
        }
?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="accident_statuses_id" value="<?=$data['accident_statuses_id']?>" />
	<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="mvs" value="<?=$data['mvs']?>" />
     <!--------------Власник------------------>
    <div class="section">Власник, якому заподіяно шкоду:</div>
    <div id="owner">
    <table cellpadding="5" cellspacing="0">
    <tr>
        <table>
            <tr>
                <td class="label grey"><?=$this->getMark()?>Тип особи:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_person_types_id') ], $data['owner_person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changePersonType(this.value);"', null, $data)?></td>
            </tr>
        </table>
    </tr>
    <tr>
        <td>
            <table class="phys" style="display: <?=($data['owner_person_types_id'] == 1) ? 'block' : 'none'?>">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
                <td><input type="text" name="owner_lastname" value="<?=$data['owner_lastname']?>" maxlength="50" class="fldText lastname owner" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
                <td><input type="text" name="owner_firstname" value="<?=$data['owner_firstname']?>" maxlength="50" class="fldText firstname owner" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
                <td class="label grey"><?=$this->getMark()?>По батькові:</td>
                <td><input type="text" name="owner_patronymicname" value="<?=$data['owner_patronymicname']?>" maxlength="50" class="fldText patronymicname owner" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
            </tr>
            </table>
             <table class="legal" style="display: <?=($data['owner_person_types_id'] == 2) ? 'block' : 'none'?>">
           <tr>
                <td class="label grey"><?=$this->getMark()?>Назва:</td>
                <td><input type="text" style="width: 300;" name="owner_company" value="<?=htmlspecialchars($data['owner_lastname'])?>" maxlength="300" class="fldText lastname owner" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
            </tr>
            </table>
        </td>
	</tr>
    <tr>
        <td>
        <table cellpadding="5" cellspacing="0" class="all" style="display: <?=($data['owner_person_types_id'] == 1 || $data['owner_person_types_id'] == 2) ? 'block' : 'none'?>">
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
        </td>
    </tr>
    <tr>
        <td>
            <table cellpadding="5" cellspacing="0" class="all" style="display: <?=($data['owner_person_types_id'] == 1 || $data['owner_person_types_id'] == 2) ? 'block' : 'none'?>">
                <tr>
					<td class="label grey"><?=$this->getMark(false)?>Індекс:</td>
                    <td><input type="text" name="owner_zip_code" value="<?=$data['owner_zip_code']?>" maxlength="5" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark(false)?>Область:</td>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_regions_id') ], $data['owner_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                    <td class="label grey">Район:</td>
                    <td><input type="text" name="owner_area" value="<?=$data['owner_area']?>" maxlength="50" class="fldText city owner" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark(false)?>Місто:</td>
                    <td><input type="text" name="owner_city" value="<?=$data['owner_city']?>" maxlength="50" class="fldText city owner" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                </tr>
            </table>
         </td>
    </tr>
    <tr>
        <td>
            <table cellpadding="5" cellspacing="0" class="all" style="display: <?=($data['owner_person_types_id'] == 1 || $data['owner_person_types_id'] == 2) ? 'block' : 'none'?>">
                <tr>
                    <td class="label grey"><?=$this->getMark(false)?>Вулиця:</td>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_street_types_id') ], $data['owner_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?><input type="text" name="owner_street" value="<?=$data['owner_street']?>" maxlength="50" class="fldText street owner" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark(false)?>Будинок:</td>
                    <td><input type="text" name="owner_house" value="<?=$data['owner_house']?>" maxlength="15" class="fldText house owner" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey">Квартира:</td>
                    <td><input type="text" name="owner_flat" value="<?=$data['owner_flat']?>" maxlength="10" class="fldText flat owner" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>Телефон(и):</td>
                    <td><input type="text" name="owner_phones" value="<?=$data['owner_phones']?>" maxlength="50" class="fldText owner" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                </tr>
            </table>
        </td>
     </tr>
    <tr>
        <td>
            <table cellpadding="2" cellspacing="3" class="all" style="display: <?=($data['owner_person_types_id'] == 1 || $data['owner_person_types_id'] == 2) ? 'block' : 'none'?>">
                    <td class="label grey"><?=$this->getMark()?>Постраждалий є резидентом:
                    <td><?='<input type="checkbox" name="owner_resident" value="1" ' . (($data['owner_resident'] == 1) ? 'checked ' : ' ') . ' ' . $this->getReadonly(true) . ' />'?></td>
                    <td class="label grey"><?=$this->getMark()?><lable class="phys">ІПН постраждалого:</lable><lable class="legal">ЄДРПОУ постраждалого:</lable></td>
                    <td><input type="text" name="owner_identification_code" value="<?=$data['owner_identification_code']?>" maxlength="10" class="fldText firstname applicant" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
                            <td class="label grey"><?=$this->getMark(false)?>Страхова компанія потерпілого:</td>
                            <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('owner_insurer_company') ], $data['owner_insurer_company'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                </tr>
            </table>
        </td>
     </tr>
    <tr>
        <td>
            <div class="section">Водій забезпеченого ТЗ:&nbsp;<a href="javascript: setPolicyValues('insurer', 'driver')" style="color: red;" class="insurer_link">Є страхувальником</a></div></div>
             <table cellpadding="5" cellspacing="0">
                <tr>
                    <td>
                        <table>
                        <tr>
                        <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
                        <td><input type="text" name="insurer_driver_lastname" value="<?=$data['insurer_driver_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
                        <td><input type="text" name="insurer_driver_firstname" value="<?=$data['insurer_driver_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly()?> /></td>
                        <td class="label grey"><?=$this->getMark()?>По батькові:</td>
                        <td><input type="text" name="insurer_driver_patronymicname" value="<?=$data['insurer_driver_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly()?> /></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                <table>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>ІПН водія:</td>
                        <td><input type="text" name="insurer_driver_identification_code" value="<?=$data['insurer_driver_identification_code']?>" maxlength="10" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td></td>
                     </tr>
                </table>
            <div class="section">Інше:</div>
                <table cellpadding="2" cellspacing="3">
                <tr>
                    <td class="label grey" width ="10%">Примітка:</td>
                    <td width ="90%"><textarea name="note" style="height: 100px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['note']?></textarea></td>
                </tr>
            </table>
</form>
<script type="text/javascript">
    initFocus(document.<?=$this->objectTitle?>);
    <? if($action != 'add') {?>
        $('#policies_id').attr('checked',true);
    <?}?>
</script>