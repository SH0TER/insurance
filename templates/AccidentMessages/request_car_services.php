<? //_dump($data) ?>
<!--div class="section">Задача:</div-->
<div id="solution" style="display: <?=($data['action']=='update' || ($data['action'] == 'view' && $data['answer'])) ? 'block' : 'none'?>">
	<div class="section">Рішення:</div>
	<table>
		<tr>
			<td style="border: 4px solid #ff0000;" class="label">Підтвердження:<input type="checkbox" name="confirm" value="1" <?=(($data['confirm']) ? 'checked' : ' ')?> <?=$this->getReadonly(true)?> /></td>
			<input type="hidden" name="fields[answer][confirm][type]"  value="fldBoolean" />
			<input type="hidden" name="fields[answer][confirm][label]"  value="Підтвердження" />
			<input type="hidden" name="fields[answer][confirm][obligatory]" value="false" />
		</tr>
	</table>
    
    <script>
		
        var num_parts = -1;

        function addPart() {
            $('#problem_parts').append(
            '<tr>'+
                '<td class="label">Найменування відсутньої ЗЧ:</td><td><input style="width: 180px;" type="text" name="problem_parts[' + num_parts + '][title]" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
                '<td class="label">Каталожний номер ЗЧ:</td><td><input style="width: 80px;" type="text" name="problem_parts[' + num_parts + '][catalog_number]" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
                '<td class="label">Категорія ЗЧ:</td><td><input style="width: 50px;" type="text" name="problem_parts[' + num_parts + '][category]" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
                '<td width="30"><a href="#" onclick="deletePart(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>' +
            '</tr>');

            num_parts--;
        }

        function deletePart(obj) {
            if (confirm('Ви дійсно бажаєте вилучити ЗЧ?')) {
                document.getElementById('problem_parts').deleteRow( obj.parentNode.parentNode.sectionRowIndex );
            }
        }
    
    </script>
    
    <table width="600" cellpadding="5" cellspacing="0">
        <tr>
            <td width="50%" valign="top">
                <? if ($this->mode == 'update' && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) {?>
                <table>
                    <tr>
                        <td><b>Проблемні ЗЧ:</b></td>
                        <td><a href="javascript: addPart()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати ЗЧ" /></a></td>
                        <td><a href="javascript: addPart()">додати ЗЧ</a></td>
                    </tr>
                </table>
                <? } ?>

                <table id="problem_parts" width="100%" cellpadding="5" cellspacing="0">
                <?
                    if (is_array($data['problem_parts'])) {
                        foreach ($data['problem_parts'] as $i => $problem_part) {
                ?>
                <tr>
                    <td class="label">Найменування відсутньої ЗЧ:</td><td><input style="width: 180px;" type="text" name="problem_parts[<?=$i?>][title]" value="<?=$problem_part["title"]?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true, in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_ANSWER)))?> ></td>
                    <td class="label">Каталожний номер ЗЧ:</td><td><input style="width: 80px;" type="text" name="problem_parts[<?=$i?>][catalog_number]" value="<?=$problem_part["catalog_number"]?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true, in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_ANSWER)))?> ></td>
                    <td class="label">Категорія ЗЧ:</td><td><input style="width: 50px;" type="text" name="problem_parts[<?=$i?>][category]" value="<?=$problem_part["category"]?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true, in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_ANSWER)))?> ></td>
                    <? if ($this->mode == 'update' && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) {?><td><a onclick="deletePart(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
                </tr>
                <?
                        }
                    }
                ?>
                </table>
            </td>
        </tr>
    </table>	
    
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