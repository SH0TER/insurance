<?//_dump($data)?>
<script type="text/javascript">
    function hide_showTemplate(value){
        var message_types_id = $('select[name=message_types_id] option:selected').val();
        if (value == <?=ACCIDENT_MESSAGE_STATUSES_INTERRUPTED?> || message_types_id == <?=ACCIDENT_MESSAGE_TYPES_INSPECTION?>) {
            $('#params').hide();
            setObligatory(false);
            $('#answer_payment_document_number').val(false);
            $('#answer_audatex_code').val(false);
        }
        else $('#params').show();
    }

	function createAct() {
		$('#<?=$this->objectTitle?>do').val('AccidentActs|create');
		$('#<?=$this->objectTitle?>form').submit();
	}

	function backWithError() {
		$('#<?=$this->objectTitle?>do').val('<?=$this->object.'|load'?>');
		$('#<?=$this->objectTitle?>form').submit();
	}
	
	function edit() {
		location = 'index.php?do=AccidentMessages|load&id=<?=$data['id']?>';
	}

    function generateAdditionalAgreement(){
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            async:		false,
            data:		'do=AccidentMessages|isAnotherRecoveryInWindow' +
                        '&id=' + <?=intval($data['id'])?>,
            success: function(result) {
                if (result.exist!='1')
                {
                    alert(result.exist);
                    return;
                }
                else
                {
		            window.open('/index.php?do=Policies|renewPolicy&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>&messages_id=<?=$data['id']?>&agreement_types_id=3');
                }
            }
        });
    }

    function viewExecutant(){
        var product_types_id = <?=$data['product_types_id']?>;
        if($('#message_types_id').val() == <?=ACCIDENT_MESSAGE_TYPES_INSPECTION?>){
            $('#assistance_managers').show();
            $('#recipient_master').hide();
        }
        else{
            $('#assistance_managers').hide();
            $('#recipient_master').show();
        }
    }

    $(document).ready(function(){
        viewExecutant();
		$('select[name=message_types_id]').change(function(){
            start_type_id = <?=intval($data['message_types_id'])?>;
            start_type_title = '<?=$data['subject']?>';
            if(<?=intval($data['message_types_id'])?> == <?=ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT?>){
                alert('Ви не можете змінити тип задачі \'Відновлення страхової суми\'');
                $('select[name=message_types_id]').value = start_type_id;

                $('select[name=message_types_id]').val(start_type_title);
            }
            else{
                if($('select[name=message_types_id] option:selected').val() == <?=ACCIDENT_MESSAGE_TYPES_INSPECTION?>) {
                    $('input[name=recipient_roles_id]').val('<?=ROLES_EXPERT?>');
                }
                else{
                    $('input[name=recipient_roles_id]').val('');
                }
                $.ajax({
                    type:		'POST',
                    url:		'index.php',
                    dataType:	'html',
                    async:		false,
                    data:		'do=AccidentMessages|includeValuesTemplateInWindow' +
                                '&accidents_id=<?=intval($data['accidents_id'])?>' +
                                '&action=<?=$action?>' +
                                '&product_types_id=<?=$data['product_types_id']?>' +
                                '&message_types_id=' + $('select[name=message_types_id] option:selected').val() +
                                '&authors_id=' + $('input[name=authors_id]').val(),
                    success: function(result) {
                        $('#template').html(result);
                    }
                });
            }
       });

        if ($('select[name=statuses_id] option:selected').val() == <?=ACCIDENT_MESSAGE_STATUSES_INTERRUPTED?>) $('#params').hide();
    });
</script>

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
					<form id="<?=$this->objectTitle?>form" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
						<input type="hidden" id="<?=$this->objectTitle?>do" name="do" value="<?=$this->object.'|'.$action?>" />

						<input type="hidden" name="id" value="<?=$data['id']?>" />
						<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
						<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
						<input type="hidden" name="car_services_id" value="<?=$data['car_services_id']?>" />
						<input type="hidden" name="masters_id" value="<?=$data['masters_id']?>" />
						<input type="hidden" name="managers_id" value="<?=$data['managers_id']?>" />
						<input type="hidden" name="average_managers_id" value="<?=$data['average_managers_id']?>" />
						<input type="hidden" name="estimate_managers_id" value="<?=$data['estimate_managers_id']?>" />
						<input type="hidden" name="subject" value="<?=htmlspecialchars($data['subject'])?>" />
						<input type="hidden" name="recipient_roles_id" value="<?=$data['recipient_roles_id']?>" />
						<input type="hidden" name="recipient_organizations_id" value="<?=$data['recipient_organizations_id']?>" />
						<input type="hidden" name="recipient_organization" value="<?=htmlspecialchars($data['recipient_organization'])?>"  />
                        <!--input type="hidden" name="expert_organizations_id" value="<?=$data['recipient_organizations_id']?>" /-->
						<input type="hidden" name="recipients_id" value="<?=$data['recipients_id']?>" />
						<input type="hidden" name="recipient" value="<?=htmlspecialchars($data['recipient'])?>" />
						<input type="hidden" name="author_roles_id" value="<?=$data['author_roles_id']?>" />
						<input type="hidden" name="author_organization" value="<?=htmlspecialchars($data['author_organization'])?>" />
						<input type="hidden" name="authors_id" value="<?=$data['authors_id']?>" />
                        <input type="hidden" name="phone_date" value="<?=$data['phone_date']?>" />
                        <input type="hidden" name="phone_date_year" value="<?=$year?>" />
                        <input type="hidden" name="phone_date_month" value="<?=$month?>" />
                        <input type="hidden" name="phone_date_day" value="<?=$day?>" />
						<input type="hidden" name="author" value="<?=htmlspecialchars($data['author'])?>" />
						<input type="hidden" name="question" value="<?=htmlspecialchars($data['question'])?>" />
						<input type="hidden" name="answer" value="<?=htmlspecialchars($data['answer'])?>" />
						<input type="hidden" name="statuses_id_old" value="<?=($data['statuses_id_old'] != '') ? $data['statuses_id_old'] : $data['statuses_id']?>" />
						<input type="hidden" name="redirect" value="<?=(($data['is_accidents']=='1') ? ($_SERVER['PHP_SELF'] . '?do=Accidents|view&product_types_id='.$data['product_types_id'].'&id='.$data['accidents_id']) : ($_SERVER['PHP_SELF'].'?do=Accidents|show&show=messages'))?>" />

                        <? if($Authorization->data['roles_id'] == ROLES_MASTER) { ?>
                            <input type="hidden" name="message_types_id" value="<?=$data['message_types_id']?>" />
                            <?=(($data['recipients_id'] == $data['masters_id']) ? '<input type="hidden" name="recipient_master" value="1" />' : '')?>
                        <? } ?>

						<table cellpadding="10" cellspacing="0">
						<tr>
							<td><b>Справа:</b> <a target="_blank" href="/?do=Accidents|view&amp;id=<?=$data['accidents_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><?=$data['accidents_number']?></a></td>
							<td><b>Номер:</b> <a target="_blank" href="/?do=Policies|view&amp;id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><?=$data['policies_number']?></a></td>							
                            <td><b>Аварійний комісар:</b> <?=$data['average_lastname']?> <?=$data['average_firstname']?></td>
                            <td><b>Експерт:</b> <?=$data['estimate_lastname']?> <?=$data['estimate_firstname']?></td>
						</tr>
						<tr>
							<td><b>Страхувальник:</b> <?=$data['insurer_lastname']?> <?=$data['insurer_firstname']?> <?=$data['insurer_patronymicname']?></td>
							<td><b>Телефон:</b> <?=$data['insurer_phone']?></td>
						</tr>
						<tr>
							<td><b>Заявник:</b> <?=$data['applicant_lastname']?> <?=$data['applicant_firstname']?> <?=$data['applicant_patronymicname']?></td>
							<td><b>Телефон:</b> <?=$data['applicant_phones']?></td>
						</tr>
						</table>

						<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
						<input type="hidden" name="accidents_number" value="<?=$data['accidents_number']?>" />
						<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
						<input type="hidden" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" />
						<input type="hidden" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" />
						<input type="hidden" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>">

						<table cellspacing="0" cellpadding="2">
						<tr>
							<td class="label"><?=$this->getMark()?>Тип:</td>
							<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('message_types_id') ], $data['message_types_id'], $data['languageCode'], $this->getReadonly((($Authorization->data['roles_id'] == ROLES_MASTER) ? true :false), $action == 'update' && $Authorization->data['id'] != $data['authors_id']) . ' onchange="viewExecutant();"' . ', id = message_types_id', null, $data)?></td>
						</tr>                       
                        <? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?>
                            <tr id="recipient_master" style="display: none;">
                                <td class="label"><?=$this->getMark()?>Виконавець - майстер справи:</td>
                                <td><input type="checkbox" name="recipient_master" <?=(($data['recipients_id'] == $data['masters_id']) ? 'checked' : '')?> ></td>
                            </tr>
                        <? } ?>

                        <tr id="assistance_managers" style="display: none;">
                            <td class="label">Виконавець:</td>
                            <td>
                                <?if(!$data['assistance_managers']){?>
                                        <? echo '<select name="recipients_id" class="fldSelect " onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id']) . '>';
                                            echo '<option value="' . $data['recipients_id'] . '" selected="">' .$data['recipient'].'</option>';
                                        echo '</select>';
                                    ?>
                                <?}else{?>
                                    <? echo '<select name="recipients_id" class="fldSelect " onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id']) . '>
                                                <option value="">...</option>';
                                        foreach($data['assistance_managers'] as $assistance_manager) {
                                            echo '<option value="' . $assistance_manager['id'] . '" ' . (($data['recipients_id'] == $assistance_manager['id']) ? ' selected' : '') . '>' .$assistance_manager['expert'].'</option>';
                                        }
                                        echo '</select>';
                                    ?>
                                <?}?>
                            </td>
                        </tr>
						</table>

						<div id="template">
						<?
							$data['action'] = $action;
							$this->includeValuesTemplateInWindow($data);
						?>
						</div>

						<table cellpadding="2" cellspacing="0">
						 <tr>
							<td class="label"><?=$this->getMark()?>Статус:</td>
							<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ], $data['statuses_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="hide_showTemplate(this.value)" ', null, $data)?></td>
						</tr>
						<tr>
							<td width="200">&nbsp;</td>
							<td align="center">
							<?
								switch ( $action ) {
									case 'view':
										echo '<input type="button" value=" ' . translate('Back') . ' " class="button" onclick="changeLocation(document.path, \'' . (sizeOf($_SESSION['auth']['path']) - 2) . '\')" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';

										if (($data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ANSWER && $Authorization->data['permissions']['AccidentActs']['insert']) || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) {
                                            if($data['message_types_id'] !=15) {
                                                echo '<input type="button" value=" Створити акт " class="button" onclick="createAct()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
                                                echo '<input type="button" value=" Помилки " class="button" onclick="backWithError()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
                                            }
										}
										
										if ($data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION && $data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION) {
											echo '<input type="button" value=" Редагувати " class="button" onclick="edit()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
										}
										break;
									case 'insert':
										echo '<input type="submit" value=" ' . translate('Save') . ' " class="button" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
										break;
									case 'update':
										echo '<input type="button" value=" ' . translate('Back') . ' " class="button" onclick="changeLocation(document.path, \'' . (sizeOf($_SESSION['auth']['path']) - 2) . '\')" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
                                        echo '<input type="submit" value=" ' . translate('Save') . ' " class="button" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
										if($data['message_types_id'] == 15 && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) {
											echo '<input type="button" value=" Відновити страхову суму " onclick="generateAdditionalAgreement();" class="button" onclick="" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" /> ';
										}
                                        break;
								}
							?>
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
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>