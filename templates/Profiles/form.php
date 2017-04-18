<?//_dump($data)?>

<script>

	$(document).ready(function(){
		$('select[name=profile_types_id]').change(function(){
			var question_answer = '';
			$('input[name^=question_answer_hidden]').each(function(){
				question_answer += this.name.replace('_hidden', '') + '=' + this.value + '&';
				console.log(this.name.replace('_hidden', '') + '=' + this.value + '&');
			});
			
			var question_comment = '';
			$('input[name^=question_comment_hidden]').each(function(){
				question_comment += this.name.replace('_hidden', '') + '=' + this.value + '&';
			});
			
			$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'html',
				data:       'do=Profiles|loadQuestionsInWindow&action=<?=$action?>&profile_types_id=' + this.value + '&' + question_answer + '&' + question_comment,
				success:    function (result){
					$('#blockQuestions').html(result);
					$('select[name^=question_answer]').change();
				}
			});
		});
		
		$('select[name=profile_types_id]').change();
	})
	
	function changeAnswer(value, id) {
		if (value == 'Інше' || value == 'Так, СМС' || value == 'Так, електронною поштою') {
			$('.commentBlock' + id).show();
			$('.commentBlockNone' + id).hide();
		} else {
			$('.commentBlock' + id).hide();
			$('.commentBlockNone' + id).show();
		}
	}

</script>
<?//_dump($data)?>
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
					<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
						<input type="hidden" name="id" value="<?=$data['id']?>" />
						<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
						
						<?
							foreach ($data['question_answer'] as $id => $question_answer) {
								if ($question_answer) echo '<input type="hidden" name="question_answer_hidden[' . $id . ']" value="' . $question_answer . '" />';
							}
						?>
						
						<?
							foreach ($data['question_comment'] as $id => $question_comment) {
								if ($question_comment) echo '<input type="hidden" name="question_comment_hidden[' . $id . ']" value="' . $question_comment . '" />';
							}
						?>
						
						<table width="100%" cellpadding="2" cellspacing="0" border="0">
							<tr>
								<td class="label">*Тип анкети:</td><td colspan="3"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('profile_types_id') ], $data['profile_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
							</tr>
							<!--tr>
								<td class="label">*Клієнт:</td><td colspan="3"><input class="fldText" type="text" onblur="this.className='fldText';" onfocus="this.className='fldTextOver';" maxlength="255" value="<?=$data['client_name']?>" name="client_name"></td>
							</tr-->
							<tr>
								<td id="blockQuestions" colspan="4"></td>
							</tr>
							<tr>
								<td class="label">Коментар:</td><td colspan="3"><textarea class="fldNote" onblur="this.className='fldNote';" onfocus="this.className='fldNoteOver';" name="comment" <?=$this->getReadonly(false)?> ><?=$data['comment']?></textarea></td>
							</tr>
							<tr>
								<td width="150">&nbsp;</td>
								<td align="center" colspan="3"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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