<div class="section">Задача:</div>
<table cellpadding="2" cellspacing="0">
	<tr>
		<td class="label">Суд, до якого буде здійснюватись запит:</td>
		<td>
			<?
			
				$courts = Courts::getList($data);
				
				echo '<select name="courts_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';" ' . $this->getReadonly(true) . '>';
				echo '<option value="0">...</option>';
				
				if (is_array($courts)) {
					foreach($courts as $court) {
						echo '<option value="' . $court['id'] . '">' . $court['title'] . '</option>';
					}
				}
				
				echo '</select>';
			?>
			<input type="hidden" name="fields[question][courts_id][type]" value="fldInteger" />
			<input type="hidden" name="fields[question][courts_id][label]" value="Суд, до якого буде здійснюватись запит" />
			<input type="hidden" name="fields[question][courts_id][obligatory]" value="true" />
		</td>
	</tr>
	<tr>
		<td class="label">Коментар:</td>
		<td>
			<textarea name="comment_question" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(true, $data['action'] == 'update' && $data['statuses_id_old'] == ACCIDENT_MESSAGE_STATUSES_ANSWER)?>><?=$data['comment_question']?></textarea>
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