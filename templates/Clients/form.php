<? $Log->showSystem();?>
<script type="text/javascript">
    function changePersonType() {
        $.ajax({
            type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=<?=$this->object?>|changePersonTypeInWindow' +
                        '&person_types_id=' + getElementValue('person_types_id'),
                success:    function(result) {
								document.getElementById('data').innerHTML = result;
							}
			});
    }

    function setHabbitationAddress(element) {
        if (element.checked) {
            with (document.<?=$this->objectTitle?>) {
                habitation_regions_id.selectedIndex		= registration_regions_id.selectedIndex;
                habitation_area.value					= registration_area.value;
                habitation_city.value					= registration_city.value;
                habitation_street.value					= registration_street.value;
                habitation_house.value					= registration_house.value;
                habitation_flat.value					= registration_flat.value;
                if (getElementValue('person_types_id') == 1) {
                    habitation_phone.value				= registration_phone.value;
                } else {
					habitation_area_en.value				= registration_area_en.value;
					habitation_cityEn.value				= registration_city_en.value;
					habitation_street_en.value			= registration_street_en.value;
				}
            }
        }
    }
	
	function changeVipStatus(obj){
        if(obj.checked){
            important_person = obj.value = 1;
        }
        else{
            important_person = obj.value = 0;
        }
	}

    function showHideDetails() {
        document.getElementById('details').style.display = (document.getElementById('details').style.display == 'none')  ? 'block' : 'none';
    }
</script>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>

            <td class="bullet" rowspan="2"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption bottom">
                <ul id="tabs">
                    <li class="active"><span><?=$this->messages['single']?></span></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <table class="wizard" cellpadding="2" cellspacing="3" width="100%">
                    <tr>
                        <td>
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
                                <input type="hidden" name="id" value="<?=$data['id']?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <input type="hidden" name="important_person" value="0" />
                                <table cellpadding="2" cellspacing="3" width="100%">
                                    <tr>
                                        <td>
                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td class="label grey"><?=$this->getMark()?>Тип особи:</td>
                                                    <td>
                                                        <select id="person_types_id" name="person_types_id" class="fldSelect" onchange="changePersonType()" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
                                                            <option value="1" <?=($data['person_types_id'] == 1) ? 'selected' : ''?>>Фізична</option>
                                                            <option value="2" <?=($data['person_types_id'] == 2) ? 'selected' : ''?>>Юридична</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div id="data">
                                                <?
                                                    switch ($data['person_types_id']) {
                                                        case '1':
                                                            include_once $this->object . '/private.php';
                                                            break;
                                                        case '2':
                                                            include_once $this->object . '/company.php';
                                                            break;
                                                    }
                                                ?>
                                            </div>
											<div class="section">Група:</div>
                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td class="label grey"><?=$this->getMark()?>Група:</td>
                                                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('client_groups_id') ], $data['client_groups_id' ], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div align="center">
    <? if ($this->mode == 'view') {?><input type="button" value=" <?=translate('Back')?> " class="button" onclick="changeLocation(document.path, '<?=(sizeOf($_SESSION['auth']['path']) - 2)?>')" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /><? } ?>
    <? if ($this->mode == 'update') {?><input type="button" value=" <?=translate('Save')?> " class="button" onclick="document.<?=$this->objectTitle?>.submit();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /><? } ?>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>