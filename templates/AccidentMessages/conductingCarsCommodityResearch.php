<script>
	var participant_number = <?=intval(sizeof($data['participant']) + 1)?>;

    function addParticipant() {
        var row	= document.getElementById('participants').insertRow(document.getElementById('participants').rows.length);
        row.style.background = (document.getElementById('participants').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

        var i = document.getElementById('participants').rows.length;
        row.className = participant_number;

        cell = row.insertCell(-1);
        cell.innerHTML	= participant_number + '. <input type="text" name="participant[' + participant_number + ']" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" style="width:600px;"/>'+
			'<input type="hidden" name="fields[question][participant' + participant_number + '][type]"  value="fldText" />' +
			'<input type="hidden" name="fields[question][participant' + participant_number + '][label]"  value="Опис учасника" />' +
			'<input type="hidden" name="fields[question][participant' + participant_number + '][obligatory]" value="true" />' +
			'<input type="hidden" name="fields[question][participant' + participant_number + '][alias]" value="participant" />' +
			'<input type="hidden" name="fields[question][participant' + participant_number + '][number]" value="' + participant_number + '" />';

        cell = row.insertCell(-1);
        cell.innerHTML = '<a href="#" onclick="deleteParticipant(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a>';
		cell.width = '30px;';

        participant_number++;

		changeRowStyle('participants');
    }

    function deleteParticipant(obj) {
        if (confirm('Ви дійсно бажаєте вилучити опис?')) {
            document.getElementById('participants').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

			changeRowStyle('participants');
        }
    }
</script>
<div class="section">Задача:</div>
<table cellpadding="2" cellspacing="0">
<tr>
	<td class="label">Відповідальний:</td>
	<td>
		<?
			$data['account_groups_id'] = array(ACCOUNT_GROUPS_ESTIMATE, ACCOUNT_GROUPS_ESTIMATE_HEAD);
			$experts = Managers::getList($data);
		?>
		<select name="recipients_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> >
			<option value="">...</option>
			<? foreach ($experts as $expert) { ?>
				<option value="<?=$expert['accounts_id']?>" <?=(($expert['accounts_id'] == $data['recipients_id']) ? 'selected' : '')?>><?=$expert['accounts_name']?></option>
			<? } ?>
		</select>
		<!--input type="hidden" name="fields[question][recipients_id][type]"  value="fldSelect" />
		<input type="hidden" name="fields[question][recipients_id][label]"  value="Відповідальний" /><br /-->
	</td>
</tr>
<tr>
	<td class="label" style="vertical-align: top;">Дані про інших учасників: <? if ($this->mode == 'update' && $Authorization->data['id'] == $data['authors_id'] || intval($data['authors_id']) == 0) {?><a href="javascript: addParticipant()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати документ" /></a><? } ?></td>
	<td>
		<table id="participants" width="100%" cellpadding="5" cellspacing="0">
			<?
				if (is_array($data['participant'])) {
					foreach ($data['participant'] as $i => $participant) {
			?>
			<tr>
				<td nowrap><?=$i?>. <input type="text" name="participant[<?=$i?>]" value='<?=$participant?>' class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> style="width:600px;" ></td>
				<input type="hidden" name="fields[question][participant<?=$i?>][type]"  value="fldText" />
				<input type="hidden" name="fields[question][participant<?=$i?>][label]"  value="Опис учасника" />
				<input type="hidden" name="fields[question][participant<?=$i?>][obligatory]" value="true" />
				<input type="hidden" name="fields[question][participant<?=$i?>][alias]" value="participant" />
				<input type="hidden" name="fields[question][participant<?=$i?>][number]" value="<?=$i?>" />
				<? if ($this->mode == 'update' && $Authorization->data['id'] == $data['authors_id'] || intval($data['authors_id']) == 0) {?><td><a onclick="deleteParticipant(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
			</tr>
			<?
					}
				}
			?>
		</table>
	</td>
</tr>
<tr>
	<td class="label" style="vertical-align: top;">Коментар:</td>
	<td>
		<textarea name="comment_question" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?>><?=$data['comment_question']?></textarea>
		<input type="hidden" name="fields[question][comment_question][type]"  value="fldNote" />
		<input type="hidden" name="fields[question][comment_question][label]"  value="Коментар" />
		<input type="hidden" name="fields[question][comment_question][obligatory]" value="true" />
	</td>
</tr>
</table>
<div id="solution" style="display: <?=($data['action']=='update' || ($data['action'] == 'view' && $data['answer'])) ? 'block' : 'none'?>">
	<div class="section">Рішення:</div>
	<table cellpadding="2" cellspacing="0">
	<tr>
		<td class="label">Дата заявки:</td>
		<td><?=$this->getDateSelect($data['entry_date'], $data['entry_date_year' ], $data['entry_date_month' ], $data['entry_date_day' ], 'entry_date', $this->getReadonly(true))?></td>
		<input type="hidden" name="fields[answer][entry_date][type]"  value="fldDate" />
		<input type="hidden" name="fields[answer][entry_date][label]"  value="Дата заявки" />
		<input type="hidden" name="fields[answer][entry_date][obligatory]" value="true" />
	</tr>
	<tr>
		<td class="label" style="vertical-align: top;">Експертна організація:</td>
		<td>
			<select name="free_expert_organizations_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(false)?> >
				<option value="">...</option>
				<? foreach ($data['free_expert_organizations'] as $free_expert_organization) { ?>
					<option value="<?=$free_expert_organization['id']?>" <?=(($free_expert_organization['id'] == $data['free_expert_organizations_id']) ? 'selected' : '')?>><?=$free_expert_organization['title']?></option>
				<? } ?>
			</select>
			<input type="hidden" name="fields[answer][free_expert_organizations_id][type]"  value="fldInteger" />
			<input type="hidden" name="fields[answer][free_expert_organizations_id][label]"  value="Експертна організація" />
			<input type="hidden" name="fields[answer][free_expert_organizations_id][obligatory]" value="true" />
		</td>
	</tr>
	<tr>
		<td class="label" style="vertical-align: top;">Коментар:</td>
		<td width="578">
			<textarea name="comment_answer" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment_answer']?></textarea>
			<input type="hidden" name="fields[answer][comment_answer][type]"  value="fldNote" />
			<input type="hidden" name="fields[answer][comment_answer][label]"  value="Коментар" />
			<input type="hidden" name="fields[answer][comment_answer][obligatory]" value="true" />
		</td>
	</tr>
	</table>
</div>