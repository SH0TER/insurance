<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<script type="text/javascript">

    function setEnableLeader(value){
        if (1 <= value && value <= 4) {
            $('#leader').removeAttr('disabled');
			$('#leader_block').css('display', 'block');
        } else {
            $('#leader').attr('disabled', 'disabled');
			$('#leader_block').css('display', 'none');
        }
		if (value == -1) {
			$('#select_master_recipient').css('display', 'block');
		} else {
			$('#select_master_recipient').css('display', 'none');
		}
    }
	
	function showCarServicesWindow(elem) {
		//getListBySearch(elem);
        tb_show('<strong>Вибір СТО і майстра:</strong>', '#TB_inline?height=600&width=800&inlineId=hiddenModalContent'+elem, false);
    }
	
	function setEssentialCarService(recipients_id, recipient, recipient_identification_code, bank_account, bank_mfo, bank_edrpou, bank, tis, elem) {
        $('input[name=car_services_id_message]').val(recipients_id);
		$('input[name=car_services_title_message]').val(recipient);
		
		if (recipients_id == 0) {
			setMaster(0, '');
			return;
		}

        //tb_remove();
		$.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=Masters|getMastersByCarServicesIdInWindow'+
						'&elem='+elem+
                        '&car_services_id='+recipients_id,
            success:    function(result){
                $('#TB_ajaxContent').html(result);
				/*$('#search_title').css('display', 'none');
				$('#search_btn').css('display', 'none');
				$('#carServicesContent'+elem).html('');
				$('#mastersContent').html(result);*/
            }
        });
    }
	
	function getListBySearch(elem) {
		if ($('#search_title'+elem).val() !== undefined) {
			search_title = $('#search_title'+elem).val();
		} else {
			search_title = '';
		}
		
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=CarServices|getListBySearchInWindow'+
						'&elem='+elem+
						'&empty_row=1'+
                        '&search_title='+search_title,
            success:    function(result){
                $('#TB_ajaxContent').html(result);
				/*console.log(result);
				$('#carServicesContent'+elem).html(result);
				$('#mastersContent').hide();*/
            }
        });
    }
	
	function setMaster(id, name) {
		$('input[name=masters_id_message]').val(id);				
		getListBySearch('select_master_recipient');
		tb_remove();		
		
		if (id > 0) {
			$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'json',
				data:       'do=Masters|getNameInWindow'+
							'&id='+id,
				success:    function(result){
					$('input[name=masters_name_message]').val(result.name);
					$('#masters_info').html($('input[name=masters_name_message]').val() + ' - ' + $('input[name=car_services_title_message]').val());
				}
			});			
		} else {
			$('#masters_info').html('Вибрати майстра');
		}
	}

    $(document).ready(function(){
		setEnableLeader(parseInt(<?=$data['recipient_organizations_id']?>));
		setEssentialCarService(parseInt(<?=$data['car_services_id_message']?>), <?=$db->quote($data['car_services_title_message'])?>, null, null, null, null, null, null);
		setMaster(parseInt(<?=$data['masters_id_message']?>), <?=$db->quote($data['masters_name_message'])?>);
    });
	
</script>
<div class="section">Питання:</div>
<table cellpadding="2" cellspacing="0" width="100%">
<tr>
	<td class="label"><?=$this->getMark(false)?>Отримувач:</td>
	<td width="65%">
		<?
			$recipient_organizations = AccountGroups::getRecipientOrganizations();
			$recipient_organizations[] = array('id' => -1, 'title' => 'СТО');
			foreach($recipient_organizations as $recipient_organization){
				echo '<input id="recipient_organizations_' . $recipient_organization['id'] . '" name="recipient_organizations_id" value="' . $recipient_organization['id'] .'" type="radio" onclick="setEnableLeader(this.value)" ' . ($recipient_organization['id'] == $data['recipient_organizations_id'] ? 'checked' : '') . ' ' . $this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id']) . ' /> <label for="recipient_organizations_' . $recipient_organization['id'] . '">' . $recipient_organization['title'] . '</label>';
			}
		?>
	</td>
	<td nowrap="nowrap">
		<? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?>
			<a id="select_master_recipient" href="javascript: showCarServicesWindow('select_master_recipient')" style="display: <?=($data['recipient_organizations_id'] == -1) ? 'block' : 'none'?>"><label id="masters_info">Вибрати майстра</label></a>
		<? } ?>		
		<div id="leader_block"><input type="checkbox" id="leader" name="leader" value="1" /> начальник</div>
		<input type="hidden" name="car_services_id_message" value="<?=$data['car_services_id_message']?>" />
		<input type="hidden" name="fields[question][car_services_id_message][type]"  value="fldInteger" />
		<input type="hidden" name="car_services_title_message" value="<?=$data['car_services_title_message']?>" />
		<input type="hidden" name="fields[question][car_services_title_message][type]"  value="fldText" />
		<input type="hidden" name="masters_id_message" value="<?=$data['masters_id_message']?>" />
		<input type="hidden" name="fields[question][masters_id_message][type]"  value="fldInteger" />
		<input type="hidden" name="masters_name_message" value="<?=$data['masters_name_message']?>" />
		<input type="hidden" name="fields[question][masters_name_message][type]"  value="fldText" />
	</td>
</tr>
<tr>
	<td class="label"><?=$this->getMark(false)?>Тема:</td>
	<td colspan="2"><input type="text" name="subject" value="<?=$data['subject']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /></td>
</tr>
<tr>
	<td class="label">Текст:</td>
	<td colspan="2">
		<textarea name="comment_question" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?>><?=$data['comment_question']?></textarea>
		<input type="hidden" name="fields[question][comment_question][type]"  value="fldText" />
		<input type="hidden" name="fields[question][comment_question][label]"  value="Текст" />
		<input type="hidden" name="fields[question][comment_question][obligatory]" value="true" />
	</td>
</tr>
</table>
<div id="solution" style="display: <?=($data['action']=='update' || ($data['action'] == 'view' && $data['answer'])) ? 'block' : 'none'?>">
	<div class="section">Відповідь:</div>
	<table cellpadding="2" cellspacing="0" width="100%">
	<tr>
		<td class="label">Текст:</td>
		<td>
			<textarea name="comment_answer" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment_answer']?></textarea>
			<input type="hidden" name="fields[answer][comment_answer][type]"  value="fldNote" />
			<input type="hidden" name="fields[answer][comment_answer][label]"  value="Текст" />
			<input type="hidden" name="fields[answer][comment_answer][obligatory]" value="true" />
		</td>
	</tr>
    <? if ($data['recipient_organizations_id']==ACCOUNT_GROUPS_CONTACT_CENTER) { ?>
        <tr>
            <td class="label">
                Дата наступного дзвінка:
            </td>
            <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('phone_date') ], $data['phone_date_year' ], $data['phone_date_month' ], $data['phone_date_day' ], 'phone_date', $this->getReadonly(true))?></td>
        </tr>
        <tr>
            <td class="label">
                Кількість дзвінків:
            </td>
            <td>
                <input type="text" id="phone_count" name="phone_count" value="<?=$data['phone_count']?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
            </td>
        </tr>
    <? } ?>
	</table>
</div>
<?=CarServices::getListToChoose($data['car_services_id'], 1, 'select_master_recipient');?>