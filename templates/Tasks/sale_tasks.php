<script type="text/javascript">
    function update(){
        $('#<?=$this->objectTitle?>do').val('Tasks|update');
        $('#<?=$this->objectTitle?>form').submit();
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
    <td><? include_once 'Tasks/sales_info.php'?></td>
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
                        <input type="hidden" name="performers_id" value="<?=$data['performers_id']?>" />
                        <input type="hidden" name="recipient_types_id" value="<?=$data['recipient_types_id']?>" />
                        <input type="hidden" name="recipient_types_car_service" value="<?=RECIPIENT_TYPES_CAR_SERVICE?>" />
                        <input type="hidden" name="ukravto" value="<?=$data['ukravto']?>" />
						<input type="hidden" name="top" value="<?=$data['top']?>" />
                        <input type="hidden" name="is_accidents" value="<?=$data['is_accidents']?>" >
						<input type="hidden" name="brands_id" value="<?=$data['brands_id']?>" />
						<input type="hidden" name="count_tasks_repair" value="<?=$data['count_tasks_repair']?>" />
                        <input type="hidden" name="task_statuses_call_id" value="1" />
                        <table>
<!--
                        <tr>
                            <td colspan="2"><b>Результат дзвінка:</b></td>
                            <td width="150">
                                <select name="task_statuses_call_id" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" <?=$this->getReadonly(true)?>>
                                    <option>...</option>
                                    <option value="<?=TASK_STATUSES_CALL_NO?>" <?=($data['task_statuses_call_id'] == TASK_STATUSES_CALL_NO) ? 'selected' : ''?>>Не додзвонились</option>
                                    <option value="<?=TASK_STATUSES_CALL_YES?>" <?=($data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES) ? 'selected' : ''?>>Додзвонились</option>
                                </select>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
-->
                        <tr>
                            <td colspan="2"><b>Статус:</b></td>
                            <td width="150">
								<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('task_statuses_id') ], $data['task_statuses_id' ], $data['languageCode'], $this->getReadonly(true), null, $data)?>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Дата виконання наступної задачі:</b></td>
                            <td width="150"><?=$this->getDateSelect(0, null, null, null, 'date', $this->getReadonly(true))?></td>
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
    //$this->show($data);

    $data['history'] = 2;
    //$this->show($data);
?>