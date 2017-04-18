<script>
	function changeDocument(id, checked){
		if (checked) {
			$('#document_type_title'+id).css('font-weight', 'bolder');
		} else {
			$('#document_type_title'+id).css('font-weight', 'normal');			
		}
	}
</script>
<div class="section">Задача:</div>
<table cellpadding="2" cellspacing="0">
<tr>
	<td class="label" style="vertical-align: top;"><?=$this->getMark(false)?>Документи:</td>
	<td>
		<?

			$document_types = ProductDocumentTypes::getList($data);

			if (is_array($document_types)) {
				foreach($document_types as $id=>$document_type) {
					echo '<div id="document_type_title' . $document_type['id'] . '" style="font-weight:' . (in_array($document_type['id'], $data['document_types']) ? 'bolder' : 'normal') . '"><input onchange="changeDocument(this.value, this.checked);"  type="checkbox" name="document_types[]" readonly value="' . $document_type['id'] . '" ' . (in_array($document_type['id'], $data['document_types']) ? 'checked' : '') . ' ' . ($Authorization->data['roles_id'] == ROLES_MASTER ? 'onclick="return false" onkeydown="return false"' : '') . $this->getReadonly(true, $data['action'] == 'update' && $data['statuses_id_old'] == ACCIDENT_MESSAGE_STATUSES_ANSWER && ($Authorization->data['id'] == $data['authors_id'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || in_array( $data['authors_id'],$Authorization->data['managers']) || in_array(ACCOUNT_GROUPS_CONTACT_CENTER, $Authorization->data['account_groups_id']) || in_array(ACCOUNT_GROUPS_RECEPTIONIST, $Authorization->data['account_groups_id']))) . ' /> ' . $document_type['title'] . '</div>';
				}
			}
		?>
		<input type="hidden" name="fields[question][document_types][type]" value="fldCheckboxes" />
		<input type="hidden" name="fields[question][document_types][label]" value="Документи" />
		<input type="hidden" name="fields[question][document_types][obligatory]" value="true" />
	</td>
</tr>
<tr>
	<td class="label">Коментар:</td>
	<td>
		<textarea name="comment_question" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(true, $data['action'] == 'update' && $data['statuses_id_old'] == ACCIDENT_MESSAGE_STATUSES_ANSWER && ($Authorization->data['id'] == $data['authors_id'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || !in_array( $data['authors_id'],$Authorization->data['managers']) || in_array(ACCOUNT_GROUPS_CONTACT_CENTER, $Authorization->data['account_groups_id']) || in_array(ACCOUNT_GROUPS_RECEPTIONIST, $Authorization->data['account_groups_id'])))?>><?=$data['comment_question']?></textarea>
		<input type="hidden" name="fields[question][comment_question][type]"  value="fldNote" />
		<input type="hidden" name="fields[question][comment_question][label]"  value="Коментар" />
		<input type="hidden" name="fields[question][comment_question][obligatory]" value="true" />
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
<div id="solution" style="display: <?=($data['action']=='update' || ($data['action'] == 'view' && $data['answer'])) ? 'block' : 'none'?>">
	<div class="section">Рішення:</div>
	<table cellpadding="2" cellspacing="0">
	<tr>
		<td class="label">Коментар:</td>
		<td width="578">
			<textarea name="comment_answer" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment_answer']?></textarea>
			<input type="hidden" name="fields[answer][comment_answer][type]"  value="fldNote" />
			<input type="hidden" name="fields[answer][comment_answer][label]"  value="Коментар" />
			<input type="hidden" name="fields[answer][comment_answer][obligatory]" value="true" />
		</td>
	</tr>
	</table>
</div>