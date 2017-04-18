<?

$params = unserialize($data['params']);
foreach ($params as $key => $val) {
    $data[$key] = $val;
}

?>
<script type="text/javascript">
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
                data:		'do=Accidents|getSearchInWindow' +
							'&product_types_id=' + $('input[name=product_types_id]').val() +
							'&accidents_id=<?=$data['accidents_id']?>' +
							'&policies_number=' + $('#policies_number').val() +
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

		var policies_number = $('input[name=policies_number]:checked').val();

		if (policies_number == '') {
			alert('Необхідно вибрати договір страхування!');
			return false;
<?
			switch ($_SESSION['auth']['rolesId']) {
				case ROLES_MANAGER:
				case ROLES_ADMINISTRATOR:
?>
		} else {
			if ( $('#accidents_id' + policies_number + ' option:selected').val() == '0') {
				return confirm('Ви дійсно бажаєте створити нову справу?');
			} else {
				if ($('select[name=product_document_types_id] option:selected').val() == '<?=POLICY_DOCUMENT_TYPES_DEFECTS?>') {
					if (confirm('Ви дійсно бажаєте перевести страхову страву в статус "Приховані деффекти"?')) {
						$('input[name=surcharge]').val('1');
					} else {
						$('input[name=surcharge]').val('0');
					}
				}
			}
<?
					break;
			}
?>
		}

        return true;
    }

    function clearSearch() {
        $('#policies_number').val('');
        $('#shassi').val('');
        $('#sign').val('');
        $('#insurer_lastname').val('');
        $('#insurer_passport_series').val('');
        $('#insurer_passport_number').val('');
        $('#insurer_identification_code').val('');
        $('#insurer_driver_licence_series').val('');
        $('#insurer_driver_licence_number').val('');
    }
</script>
<? $Log->showSystem();?>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption"><?=$this->getFormTitle($actionType)?>:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
                    <tr>
                        <td>

                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
                                <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
                                <input type="hidden" name="id" value="<?=$data['id']?>" />
                                <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                                <input type="hidden" name="surcharge" value="" />
                                <input type="hidden" name="redirect" value="<?=($data['is_accidents']=='1') ? ($_SERVER['PHP_SELF'] . '?do=Accidents|view&product_types_id='.$data['product_types_id'].'&id='.$data['accidents_id']) : ($_SERVER['PHP_SELF'].'?do=Accidents|show&show=documents')?>" />
                                <table cellpadding="2" cellspacing="3" width="100%">
                                    <tr>
                                        <td>
                                            <div class="section">Договір страхування:</div>
                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td class="label grey">Номер:</td>
                                                    <td><input type="text" id="policies_number" value="<?=$data['policies_number']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
													<? if ($data['product_types_id'] != PRODUCT_TYPES_PROPERTY) { ?>
                                                    <td class="label grey">№ шасі (кузов, рама):</td>
                                                    <td><input type="text" id="shassi" value="<?=$data['shassi']?>" maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly()?> /></td>
                                                    <td class="label grey">Державний знак (реєстраційний №):</td>
                                                    <td><input type="text" id="sign" value="<?=$data['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
													<? } ?>
                                                    <td><input type="button" value="Знайти" onclick="searchPolicy()" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td>
                                                    <td><input type="button" value="Зтерти" onclick="clearSearch()" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                                </tr>
                                            </table>
                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td class="label grey">Прізвище:</td>
                                                    <td><input type="text" id="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
                                                    <td class="label grey">Паспорт, серія і номер:</td>
                                                    <td>
                                                        <input type="text" id="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
                                                        <input type="text" id="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
                                                    </td>
                                                    <td class="label grey">ІПН:</td>
                                                    <td><input type="text" id="insurer_identification_code" value="<?=$data['insurer_identification_code']?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
													<? if ($data['product_types_id'] != PRODUCT_TYPES_PROPERTY) { ?>
                                                    <td class="label grey">Водійські права, серія і номер:</td>
                                                    <td>
                                                        <input type="text" id="insurer_driver_licence_series" value="<?=$data['insurer_driver_licence_series']?>" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
                                                        <input type="text" id="insurer_driver_licence_number" value="<?=$data['insurer_driver_licence_number']?>" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
                                                    </td>
													<? } ?>
                                                </tr>
                                            </table>
                                            <div id="policies"></div><br />

                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td class="label grey"><?=$this->getMark()?>Тип:</td>
                                                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('product_document_types_id') ], $data['product_document_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                                                </tr>
                                                <tr>
                                                    <td class="label grey"><?=$this->getMark()?>Файл:</td>
                                                    <td><input type="file" name="file" value="" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                                                    <?
                                                        if ($data['file']) {
                                                            $file = array(
                                                                'id'            => $data['id'],
                                                                'position'      => $this->getFieldPositionByName('file'),
                                                                'languageCode'  => '');

                                                            echo ($this->isValidImage($data['file']) && $this->displayImage)
                                                                ? '<tr><td>&nbsp;</td><td>' . getImageTag('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data['file']) . '</td></tr>'
                                                                : '<tr><td>&nbsp;</td><td><b>' . translate('Present, size') . ' ' . getFileSize('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data['file']) . ':</b> <a href="?do=' . $this->object . '|downloadFileInWindow&&amp;file=' . urlencode(serialize($file)) . '" target="_blank">' . translate('Download') . '</a></td></tr>';
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <td class="label grey">Оригінал:</td>
                                                    <td><input type="checkbox" name="original" value="<?=$data['original']?>" <?=(intval($data['original']) ? 'checked' : '')?>  <?=$this->getReadonly(true)?> /></td>
                                                </tr>
                                                <? if ($data['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_TOTAL_LETTER) { ?>
                                                <tr>
                                                    <td class="label grey">Параметр 1:</td>
                                                    <td><input type="text" id="param1" name="param1" value="<?=$data['param1']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                                                </tr>
                                                <tr>
                                                    <td class="label grey">Параметр 2:</td>
                                                    <td><textarea id="param2" name="param2" class="fldTextArea" onfocus="this.className='fldTextAreaOver'" onblur="this.className='fldTextArea'" <?=$this->getReadonly()?>><?=$data['param2']?></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td class="label grey">Параметр 3:</td>
                                                    <td><textarea id="param3" name="param3" class="fldTextArea" onfocus="this.className='fldTextAreaOver'" onblur="this.className='fldTextArea'" <?=$this->getReadonly()?>><?=$data['param3']?></textarea></td>
                                                </tr>
                                                <? } ?>
												<tr>
                                                    <td class="label grey">Коментар:</td>
                                                    <td><textarea name="comment" class="fldNote" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';"><?=$data['comment']?></textarea></td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="oldfile" value="<?=($data['oldfile'] == '') ? $data['file'] : $data['oldfile']?>" />

                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td width="150">&nbsp;</td>
                                                    <td><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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
<script type="text/javascript">
    searchPolicy();
    initFocus(document.<?=$this->objectTitle?>);
</script>