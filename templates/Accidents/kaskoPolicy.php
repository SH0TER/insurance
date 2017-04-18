<script type="text/javascript">
    <? if ($Authorization->data['rolesId'] != ROLES_MASTER) {?>
    <?=CarServices::getJavaScriptArray()?>
    function changeCarService(masters_id) {
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
    <? } ?>

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
                data:		'do=Policies|getSearchInWindow' +
							'&product_types_id=<?=PRODUCT_TYPES_KASKO?>' +
							'&policies_id=<?=$data['policies_id']?>' +
							'&items_id=<?=$data['items_id']?>' +
							'&number=' + $('#policies_number').val() +
							'&insurer_lastname=' + $('#insurer_lastname').val() +
							'&insurer_passport_series=' + $('#insurer_passport_series').val() +
							'&insurer_passport_number=' + $('#insurer_passport_number').val() +
							'&insurer_identification_code=' + $('#insurer_identification_code').val() +
							'&shassi=' + $('#shassi').val() +
							'&sign=' + $('#sign').val(),
                success: function(result) {
                    $('#policies').html(result);
                }
            });
        }
    }

    function checkFields() {
        if (!$('input[name=items_id]:checked').val()) {
			alert('Необхідно вибрати договір страхування!');
			return false;
        }
        return true;
    }
</script>
<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <table cellpadding="2" cellspacing="3" width="100%">
        <tr>
            <td>
                <div class="section">Страхувальник:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Номер полісу:</td>
                        <td><input type="text" id="policies_number" name="policies_number" value="<?=$data['policies_number']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                        <td class="label grey">Страхувальник:</td>
                        <td><input type="text" id="insurer_lastname" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
					</tr>
				</table>

                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Паспорт, серія і номер:</td>
                        <td>
                            <input type="text" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
                            <input type="text" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
                        </td>
                        <td class="label grey">ІПН:</td>
                        <td><input type="text" id="insurer_identification_code" name="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Водійські права, серія і номер:</td>
                        <td>
                            <input type="text" id="insurer_driver_licence_series" name="insurer_driver_licence_series" value="<?=$data['insurer_driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
                            <input type="text" id="insurer_driver_licence_number" name="insurer_driver_licence_number" value="<?=$data['insurer_driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
                        </td>
                    </tr>
                </table>
                <div class="section">Автомобіль:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">№ шасі (кузов, рама):</td>
                        <td><input type="text" id="shassi" name="shassi" value="<?=$data['shassi']?>" maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly()?> /></td>
                        <td class="label grey">Державний знак (реєстраційний №):</td>
                        <td><input type="text" id="sign" name="sign" value="<?=$data['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                        <td><input type="button" value="Знайти" onclick="searchPolicy()" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td>
                    </tr>
                </table><br />
                <div id="policies"></div>

                <? if ($Authorization->data['rolesId'] != ROLES_MASTER) {?>
                <div class="section">Параметри:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
						<td class="label grey">Номер:</td>
						<td><input type="text" name="number" value="<?=$data['number']?>" maxlength="30" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
                        <td class="label grey"><?=$this->getMark()?>СТО:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('car_services_id') ], $data['car_services_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeCarService();"', null, $data)?></td>
                        <td class="label grey"><?=$this->getMark()?>Майстер:</td>
                        <td><select id="masters_id" name="masters_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
                    </tr>
                </table>
                <? } ?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    <? if ($Authorization->data['rolesId'] != ROLES_MASTER) { echo 'changeCarService(' . $data['masters_id'] . ');'; } ?>
    searchPolicy();
    initFocus(document.<?=$this->objectTitle?>);
</script>