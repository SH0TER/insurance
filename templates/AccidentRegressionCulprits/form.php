<script type="text/javascript">
	
	$(document).ready(function(){
	
        $('input[name=find_accident]').click(function() {
			if ($('input[name=accidents_number]').val().length > 0) {
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'json',
					async:		false,
					data:		'do=AccidentRegressionCulprits|findAccidentInWindow' +
								'&accidents_number=' + $('input[name=accidents_number]').val(),
					success: 
						function(result) {
							if (result > 0) {
								alert('Справу знайдено');
								$("#culpritsBlock").show();
							} else {
								alert('Справу не знайдено');
								$("#culpritsBlock").hide();
							}
							$('input[name=accidents_id]').val(result);
						}
				});
			} else {
				alert('Введіть номер справи.')
			}
		});
		
		$('input[name=button_back]').click(function() {
			window.location = '?do=<?=$this->object?>|show';
		});
		
		$('input[name=pretension]').click(function() {
			$('#pretensionBlock').toggle();
		});
		
		$('input[name=claim]').click(function() {
			$('#claimBlock').toggle();
		});
		
		$('select[name=person_types_id]').change(function() {
			switch (this.value) {
				case '1':
					$("#person_types_id2Block").hide();
					break;
				case '2':
					$("#person_types_id2Block").show();
					break;
			}
		});
		
		$('select[name=insurance_companies_id]').change(function() {
			$('input[name=title]').val($("select[name=insurance_companies_id] option:selected").text())
		});

		if (parseInt(<?=$data['person_types_id']?>) == 2) {
			$('#person_types_id2Block').show();
		} else {
			$('#person_types_id2Block').hide();
		}
		
    });
   
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
						<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
						
						<input type="hidden" name="id" value="<?=$data['id']?>" />
						<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
						<input type="hidden" name="regressions_id" value="<?=$data['regressions_id']?>" />
						
						<table cellpadding="2" cellspacing="0" border="0">
							<tr>
								<td width="150"><b>Справа:*</b></td>
								<td width="200" colspan="2"><input type="edit" name="accidents_number" value="<?=$data['accidents_number']?>" style="width: 100px" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> />&nbsp;<input type="button" value="Знайти" name="find_accident" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" style="display: <?=($action == 'view' ? 'none' : 'block')?>" /></td>
							</tr>
							<tr>
								<td><b>Дата:*</b></td>
								<td width="100" align="left"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data[ 'date_year' ], $data[ 'date_month' ], $data[ 'date_day' ], 'date', $this->getReadonly(true))?></td>
								<td>&nbsp;</td>
							</tr>
						</table>
						<table cellpadding="2" cellspacing="0" id="culpritsBlock" style="display: <?=(intval($data['accidents_id']) ? 'block' : 'none')?>" border="0">
							<tr>
								<td width="150"><b>Тип особи:*</b></td>
								<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('person_types_id') ], $data['person_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
							</tr>
							<tr id="person_types_id2Block">
								<td width="150"><b>Страхова компанія:</b></td>
								<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurance_companies_id') ], $data['insurance_companies_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
							</tr>
							<tr>
								<td><b>Інша сторона:</b></td>
								<td><input type="edit" name="title" class="fldText" style="width: 300px" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" value="<?=$data['title']?>" <?=$this->getReadonly(true)?> /></td>
							</tr>
							<tr>
								<td><b>претензія</b> <input type="checkbox" name="pretension" value="1" <?=(intval($data['pretension']) ? 'checked' : '')?> /></td>
								<td>&nbsp;</td>
							</tr>
						</table>
						<table id="pretensionBlock" style="display: <?=(intval($data['pretension']) ? 'block' : 'none')?>" <?=$this->getReadonly(true)?>>
							<tr>
								<td width="150"><b>Дата:*</b></td>
								<td width="100" align="left"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('pretension_date') ], $data[ 'pretension_date_year' ], $data[ 'pretension_date_month' ], $data[ 'pretension_date_day' ], 'pretension_date', $this->getReadonly(true))?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Номер*:</b></td>
								<td width="100" colspan="2"><input type="edit" name="pretension_number" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" value="<?=$data['pretension_number']?>" <?=$this->getReadonly(true)?> /></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Сума*:</b></td>
								<td width="100" colspan="2"><input type="edit" name="pretension_amount" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" value="<?=$data['pretension_amount']?>" <?=$this->getReadonly(true)?> /></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Коментар:</b></td>
								<td width="500" colspan="3"><textarea name="pretension_comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['pretension_comment']?></textarea></td>
							</tr>
							<tr>
								<td><b>Виконавець:*</b></td>
								<td>
									<select name="pretension_perfmormers_id" <?=$this->getReadonly(true)?>>
										<option value="0">...</option>
										<option value="12102" <?=($data['pretension_perfmormers_id'] == 12102 ? 'selected' : '')?>>Беляєв Юрій</option>
										<option value="6663" <?=($data['pretension_perfmormers_id'] == 6663 ? 'selected' : '')?>>Войніч Олена</option>
										<option value="8714" <?=($data['pretension_perfmormers_id'] == 8714 ? 'selected' : '')?>>Мартинюк Сергій</option>
										<option value="13170" <?=($data['pretension_perfmormers_id'] == 13170 ? 'selected' : '')?>>Шуплякова Світлана</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><b>позов</b> <input type="checkbox" name="claim" value="1" <?=(intval($data['claim']) ? 'checked' : '')?> /></td>
								<td>&nbsp;</td>
							</tr>
						</table>
						<table id="claimBlock" style="display: <?=(intval($data['claim']) ? 'block' : 'none')?>">
							<tr>
								<td width="150"><b>Дата:*</b></td>
								<td width="100" align="left"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('claim_date') ], $data[ 'claim_date_year' ], $data[ 'claim_date_month' ], $data[ 'claim_date_day' ], 'claim_date', $this->getReadonly(true))?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Номер*:</b></td>
								<td width="100" colspan="2"><input type="edit" name="claim_number" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" value="<?=$data['claim_number']?>" <?=$this->getReadonly(true)?> /></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Сума*:</b></td>
								<td width="100" colspan="2"><input type="edit" name="claim_amount" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" value="<?=$data['claim_amount']?>" <?=$this->getReadonly(true)?> /></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Коментар:</b></td>
								<td width="500" colspan="3"><textarea name="claim_comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['claim_comment']?></textarea></td>
							</tr>
							<tr>
								<td><b>Виконавець:*</b></td>
								<td>
									<select name="claim_perfmormers_id" <?=$this->getReadonly(true)?>>
										<option value="0">...</option>
										<option value="12102" <?=($data['claim_perfmormers_id'] == 12102 ? 'selected' : '')?>>Беляєв Юрій</option>
										<option value="6663" <?=($data['claim_perfmormers_id'] == 6663 ? 'selected' : '')?>>Войніч Олена</option>
										<option value="8714" <?=($data['claim_perfmormers_id'] == 8714 ? 'selected' : '')?>>Мартинюк Сергій</option>
										<option value="13170" <?=($data['claim_perfmormers_id'] == 13170 ? 'selected' : '')?>>Шуплякова Світлана</option>
									</select>
								</td>
							</tr>
						</table>
						<table width="100%" cellpadding="2" cellspacing="0" border="0">
							<tr>
								<td width="150"><b>Статус:*</b></td>
								<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('regression_statuses_id') ], $data['regression_statuses_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
							</tr>
							<tr>
								<td width="150"><b>Коментар:</b></td>
								<td><textarea name="comment" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['comment']?></textarea></td>
							</tr>
						</table>
						<div align="center">
							<table>
								<tr>
									<td><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" style="display: <?=($action == 'view' ? 'none' : 'block')?>" /></td>
									<td><input name="button_back" type="button" value=" <?=translate('Назад')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
								</tr>
							</table>
						</div>
					</form>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>

<? 
if ($action == 'view') {
	$AccidentRegressionPayments = new AccidentRegressionPayments(array());
	$AccidentRegressionPayments->show(array('accident_regression_culprits_id' => $data['id'], 'redirect' => '/index.php?do=AccidentRegressionCulprits|view&id=' . intval($data['id'])));
} 
?>