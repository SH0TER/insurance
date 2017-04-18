<?//_dump($data)?><script type="text/javascript">

    $(document).ready(function(){
        hideDates();
        $('.repairBlock').hide();
        $('.showCheckbox').hide();
        $('#no_repair').hide();
        $('.noRepairBlock').hide();
        $('.noRepairInput').hide();
        changeStatusesCall();
    })

    function changeStatusesCall(){
        value = parseInt($('select[name=task_statuses_call_id] option:selected').val());
        switch(value){
            case 1://alert('sad');
                $('.repairBlock').hide();
                $('#no_repair').hide();
                $('.noRepairInput').hide();
                $('.noRepairBlock').hide();
                if(parseInt($('input[name=recipient_types_id]').val()) == parseInt($('input[name=recipient_types_car_service]').val()) && parseInt($('input[name=ukravto]').val()) == 1 && parseInt($('input[name=task_types_id]').val()) == <?=TASK_TYPES_COMPENSATION_MESSAGE?>){
                    $('.showCheckbox').show();
				}
				$('#next_date_taskBlock').show();
                break;				
            case 2:
                if(parseInt($('input[name=recipient_types_id]').val()) == parseInt($('input[name=recipient_types_car_service]').val()) && parseInt($('input[name=ukravto]').val()) == 1){
                    $('#no_repair').show();
                    $('.noRepairInput').show();
                    if($('#no_repair').attr("checked")){
                        $('.noRepairBlock').show();
                    }
                    else{
						$('#no_repair').show();
						$('.repairBlock').show();
                    }
					
					if (parseInt($('input[name=task_types_id]').val()) == 1 && parseInt($('input[name=brands_id]').val()) != 13 && parseInt($('input[name=product_types_id]').val()) == 3 && parseInt($('input[name=count_tasks_repair]').val()) == 0) {
						$('#next_date_taskBlock').hide();
					} else {
						$('#next_date_taskBlock').show();
					}
                }
                $('.showCheckbox').hide();
                break;
            default:
                $('.repairBlock').hide();
                $('.showCheckbox').hide();
                $('#no_repair').hide();
                $('.noRepairBlock').hide();
                $('.noRepairInput').hide();
                break;
        }
    }

    function mastersAnswer(){
        $('#<?=$this->objectTitle?>do').val('Tasks|mastersAnswer');
		$('#<?=$this->objectTitle?>form').submit();
    }

    function update(){
        value = parseInt($('select[name=task_statuses_call_id] option:selected').val());
        switch(value){
            case 1:
            case 2:
                $('#<?=$this->objectTitle?>do').val('Tasks|update');
		        $('#<?=$this->objectTitle?>form').submit();
                $("#call_result_yes").show();
                break;
            default:
                alert('Виберіть результат дзвінка')
                break;
        }
    }

    function hideDates(){
        if($('#no_repair').attr("checked")){
            $('.noRepairBlock').show();
            $('.repairBlock').hide();
        }
        else{
            $('.noRepairBlock').hide();
            $('.repairBlock').show();
        }
    }

</script>
<div class="block">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
	<td class="caption"><?=$this->getFormTitle($actionType)?>:</td>
</tr>
<tr>
    <td></td>
    <td><? include_once 'Tasks/applicant_info.php'?></td>
</tr>
<tr>
    <td></td>
    <td>
        <table width="100%" cellspacing="0" cellpadding="0">
		    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
		    <tr><td colspan="2" class="content"><?=translate('Result')?>:</td></tr>
            <tr>
                <td id="QuestionnaireMessageInWindow">
                    <?=$Log->showSystem()?>
                    <form id="<?=$this->objectTitle?>form" name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <input id="<?=$this->objectTitle?>do" type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
                        <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                        <input type="hidden" name="id" value="<?=$data['id']?>" />
                        <input type="hidden" name="task_types_id" value="<?=$data['task_types_id']?>" />
                        <input type="hidden" name="calendar_id" value="<?=$data['calendar_id']?>" />
                        <input type="hidden" name="acts_id" value="<?=$data['acts_id']?>" />
                        <input type="hidden" name="acts_number" value="<?=$data['acts_number']?>" />
                        <input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
                        <input type="hidden" name="accidents_number" value="<?=$data['accidents_number']?>" />
                        <input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
                        <input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
                        <input type="hidden" name="repair_classifications_id" value="<?=$data['repair_classifications_id']?>" />
                        <input type="hidden" name="term" value="<?=$data['term']?>" />
                        <input type="hidden" name="accounts_id" value="<?=$Authorization->data['id']?>" />
                        <input type="hidden" name="recipient_types_id" value="<?=$data['recipient_types_id']?>" />
                        <input type="hidden" name="recipient_types_car_service" value="<?=RECIPIENT_TYPES_CAR_SERVICE?>" />
                        <input type="hidden" name="ukravto" value="<?=$data['ukravto']?>" />
						<input type="hidden" name="top" value="<?=$data['top']?>" />
                        <input type="hidden" name="is_accidents" value="<?=$data['is_accidents']?>" >
						<input type="hidden" name="brands_id" value="<?=$data['brands_id']?>" />
						<input type="hidden" name="count_tasks_repair" value="<?=$data['count_tasks_repair']?>" />
						<? foreach ($data['hiddens'] as $key => $value) {
							if ($key == 'do') continue;
							echo '<input type="hidden" name="hiddens[' . $key . ']" value="' . $value . '" />';
						} ?>
                        <table>
                        <tr>
                            <td colspan="2"><b>Результат дзвінка:</b></td>
                            <td width="150">
                                <select name="task_statuses_call_id" onchange="changeStatusesCall()" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" <?=$this->getReadonly(true)?>>
                                    <option>...</option>
                                    <option value="<?=TASK_STATUSES_CALL_NO?>" <?=($data['task_statuses_call_id'] == TASK_STATUSES_CALL_NO && $data['task_statuses_id'] == TASK_STATUSES_CLOSED) ? 'selected' : ''?>>Не додзвонились</option>
                                    <option value="<?=TASK_STATUSES_CALL_YES?>" <?=($data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && $data['task_statuses_id'] == TASK_STATUSES_CLOSED) ? 'selected' : ''?>>Додзвонились</option>
                                </select>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Був дзвінок з СТО:</b></td>
                            <td><input type="checkbox" id="sto_call" name="sto_call" value="1" <?=(!empty($data['sto_call']) ? 'checked' : '')?>></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="noRepairInput" colspan="2"><b>ТЗ не поставлений в ремонт:<b></td>
                            <td><input type="checkbox" id="no_repair" name="no_repair" <?=(!empty($data['no_repair']) ? 'checked' : '')?> onclick="hideDates();"></td>
                            <td class="noRepairBlock"><b>Причина:</b></td>
                            <td class="noRepairBlock">
                                <select name="no_repair_reason" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" <?=$this->getReadonly(true)?>>
                                    <option value="0" <?=($data['no_repair_reason'] == 0) ? 'selected' : ''?>>...</option>
                                    <option value="1" <?=($data['no_repair_reason'] == 1) ? 'selected' : ''?>>По бажанню клієнта</option>
                                    <option value="7" <?=($data['no_repair_reason'] == 7) ? 'selected' : ''?>>Зауважень немає</option>
                                    <option value="2" <?=($data['no_repair_reason'] == 2) ? 'selected' : ''?>>Відсутність запасних частин</option>
                                    <option value="5" <?=($data['no_repair_reason'] == 5) ? 'selected' : ''?>>Відсутність працівника</option>
                                    <option value="4" <?=($data['no_repair_reason'] == 4) ? 'selected' : ''?>>Завантаженність/черга на СТО</option>
                                    <option value="3" <?=($data['no_repair_reason'] == 3) ? 'selected' : ''?>>Не виклик клієнта на СТО</option>
                                    <option value="6" <?=($data['no_repair_reason'] == 6) ? 'selected' : ''?>>Інше</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="repairBlock">
                            <td><b>Дата заїзду:</b></td>
                            <td>
                                <?=$this->getDateSelect(0, substr($data['date_begin_repair'], 6, 4), substr($data['date_begin_repair'], 3, 2), substr($data['date_begin_repair'], 0, 2), 'date_begin_repair',  $this->getReadonly(true))?>
                            </td>
                            <td><b>Причина:</b></td>
                            <td>
                                <select name="no_begin_repair_reason" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" <?=$this->getReadonly(true)?>>
                                    <option value="0" <?=($data['no_begin_repair_reason'] == 0) ? 'selected' : ''?>>...</option>
                                    <option value="1" <?=($data['no_begin_repair_reason'] == 1) ? 'selected' : ''?>>По бажанню клієнта</option>
                                    <option value="7" <?=($data['no_begin_repair_reason'] == 7) ? 'selected' : ''?>>Зауважень немає</option>
                                    <option value="2" <?=($data['no_begin_repair_reason'] == 2) ? 'selected' : ''?>>Відсутність запасних частин</option>
                                    <option value="5" <?=($data['no_begin_repair_reason'] == 5) ? 'selected' : ''?>>Відсутність працівника</option>
                                    <option value="4" <?=($data['no_begin_repair_reason'] == 4) ? 'selected' : ''?>>Завантаженність/черга на СТО</option>
                                    <option value="3" <?=($data['no_begin_repair_reason'] == 3) ? 'selected' : ''?>>Не виклик клієнта на СТО</option>
                                    <option value="6" <?=($data['no_begin_repair_reason'] == 6) ? 'selected' : ''?>>Інше</option>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="repairBlock">
                            <td><b>Дата виїзду:</b></td>
                            <td>
                                <?=$this->getDateSelect(0, substr($data['date_end_repair'], 6, 4), substr($data['date_end_repair'], 3, 2), substr($data['date_end_repair'], 0, 2), 'date_end_repair',  $this->getReadonly(true))?>
                            </td>
                            <td><b>Причина:</b></td>
                            <td>
                                <select name="no_end_repair_reason" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" <?=$this->getReadonly(true)?>>
                                    <option value="0" <?=($data['no_end_repair_reason'] == 0) ? 'selected' : ''?>>...</option>
                                    <option value="1" <?=($data['no_end_repair_reason'] == 1) ? 'selected' : ''?>>По бажанню клієнта</option>
                                    <option value="7" <?=($data['no_end_repair_reason'] == 7) ? 'selected' : ''?>>Зауважень немає</option>
                                    <option value="2" <?=($data['no_end_repair_reason'] == 2) ? 'selected' : ''?>>Відсутність запасних частин</option>
                                    <option value="5" <?=($data['no_end_repair_reason'] == 5) ? 'selected' : ''?>>Відсутність працівника</option>
                                    <option value="4" <?=($data['no_end_repair_reason'] == 4) ? 'selected' : ''?>>Завантаженність/черга на СТО</option>
                                    <option value="3" <?=($data['no_end_repair_reason'] == 3) ? 'selected' : ''?>>Не виклик клієнта на СТО</option>
                                    <option value="6" <?=($data['no_end_repair_reason'] == 6) ? 'selected' : ''?>>Інше</option>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="showCheckbox">
                            <td>Створити відновлювальний ремонт</td>
                            <td ><input type="checkbox" name="create_compensation_repair" <?=(!empty($data['create_compensation_repair']) ? 'checked' : '')?>></td>
                        </tr>
                        <tr id="next_date_taskBlock">
                            <td colspan="2"><b>Дата виконання наступної задачі:</b></td>
                            <td width="150" >
                                <?=$this->getDateSelect(0, null, null, null, 'date', $this->getReadonly(true))?>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>Коментарій:</b>
                            </td>
                            <td colspan="3">
                                <textarea name="comment" rows="15" cols="100" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" align="center">
                                <? if($action == 'update') { ?><input class="button" type="button" onclick="update()" onmouseout="this.className = 'button';" onmouseover="this.className = 'buttonOver';" value="Зберегти"><? } ?>
                                <? if($Authorization->data['roles_id'] == ROLES_MASTER && $data['task_statuses_id'] == TASK_STATUSES_CLOSED) { ?><input class="button" type="button" onmouseout="this.className = 'button';" onmouseover="this.className = 'buttonOver';" onclick="mastersAnswer()" value="Відповісти"><? } ?>
                                <input class="button" type="button" onmouseout="this.className = 'button';" onmouseover="this.className = 'buttonOver';" onclick="changeLocation(document.path, '0')" value=" Назад ">
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
    initFocus(document.<?=$this->objectTitle?>);
</script>
<?
    $data['history'] = 1;
    $this->show($data);

    $data['history'] = 2;
    $this->show($data);
?>