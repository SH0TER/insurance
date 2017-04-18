			</td>
		</tr>
		</table><br />
	</td>
</tr>
</table>
<script type="text/javascript">
	function back() {
		window.location = '?do=<?=$this->object?>|changeStep&accidents_id=<?=$data['accidents_id']?>&step=<?=($data['product_types_id'] != PRODUCT_TYPES_GO && $data['step'] == 4 ? $data['step'] - 2 : $data['step'] - 1)?>&product_types_id=<?=$data['product_types_id']?>';
	}

	function next(btn) {	
		if (document.<?=$this->objectTitle?>.onsubmit != null) {
			if (!document.<?=$this->objectTitle?>.onsubmit()) {
				return;
			}
		}		
		$(btn).attr('disabled', true);
		eval('document.<?=$this->objectTitle?>.submit()');
	}

	function backToList() {
		pt_id = parseInt(<?=intval($data['product_types_id'])?>);
		
		switch (pt_id) {
			case 3:
				type = 'kasko';
				break;
			case 3:
				type = 'kasko';
				break;
			case 3:
				type = 'kasko';
				break;
			case 3:
				type = 'kasko';
				break;
			default:
				type = '';
				break;
		}
		
		window.location = '?do=<?=$this->object?>|show&show='+type;
	}
	
	function previousStatuses() {
		if (confirm('Ви дійсно бажаєте перевести справу на "Попередній етап"?')) {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'html',
				async:		false,
				data:		'do=Accidents|backPreviousStatusesInWindow' +
							'&product_types_id=<?=intval($data['product_types_id'])?>'+
							'&accidents_id='+<?=intval($previousStatusesInfo['accidents_id'])?>+
							'&accident_statuses_id='+<?=intval($previousStatusesInfo['accident_statuses_id'])?>+
							'&accounts_id='+<?=intval($previousStatusesInfo['accounts_id'])?>+
							'&accounts_title='+<?=$db->quote($previousStatusesInfo['accounts_title'])?>+
							'&duration='+<?=intval($previousStatusesInfo['duration'])?>+
							'&created='+<?=$db->quote($previousStatusesInfo['created'])?>,
				success: function(result) {
					alert('Справу переведено на попередній етап');
					location.reload();
				}
			});
		}
	}

	function backToRisk() {
		if (confirm('Ви дійсно бажаєте перевести справу на "Повторний розгляд"?')) {
			window.location = '?do=<?=$this->object?>|backToRisk&id=<?=$data['accidents_id']?>';
		}
	}
    function closeAccident() {
		if (confirm('Ви дійсно бажаєте закрити справу')) {
			window.location = '?do=<?=$this->object?>|closeAccident&id=<?=$data['accidents_id']?>';
		}
	}

    function setComment(){
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'html',
            async:		false,
            data:		'do=Accidents|setAccidentClosedCommentInWindow' +
                        '&accidents_id='+$('input[name="accidents_id"]').val()+
                        '&comment_closed='+ $("#comment_closed").val(),
            success: function(result) {
                alert('Коментар збережено');
                $("#comment_closed").val(result);
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'html',
            async:		false,
            data:		'do=Accidents|getAccidentClosedCommentInWindow' +
                        '&accidents_id='+$('input[name="accidents_id"]').val(),
            success: function(result) {
                $("#comment_closed").val(result);
            }
        });
    })
</script>

<div align="center">
    <? if ($closeAccident && $data['step'] == 5) { ?>
        <textarea id="comment_closed" class="fldNote" onblur="this.className='fldNote';" onfocus="this.className='fldNoteOver';" style="width:450px; resize:none" ></textarea><br/>
        <input type="button" value="Коментар" onclick="setComment();" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" class="button" />
    <? } ?>
</div>
<br/>
<div align="center">
	<? if ($back) { ?><input type="button" value=" Назад " onclick="back();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
	<? if ($next) { ?><input type="button" value=" Далі " onclick="next(this);" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
	<? if ($backToList) { ?><input type="button" value=" Повернутись до списку " onclick="backToList();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
	<? if ($previousStatuses) { ?><input type="button" value=" Попередній етап " onclick="previousStatuses();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
	<? if ($backToRisk) { ?><input type="button" value=" Перевести на &quot;Повторний розгляд&quot; " onclick="backToRisk();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
    <? if ($closeAccident || $Authorization->data['id'] == 1) { ?><input type="button" value=" Закрити справу " onclick="closeAccident();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
</div>
<?
	if (!intval($data['accidents_id'])) {
		$data['accidents_id'] = $data['id'];
	}

	if (intval($data['accidents_id'])) {

        /*$AccidentMessages = new AccidentMessages($data);
        $AccidentMessages->show($data);*/

		//if ($Authorization->data['roles_id'] != ROLES_MASTER || ($Authorization->data['roles_id'] == ROLES_MASTER && in_array($this->getCarServicesId($data['accidents_id']), $Authorization->data['car_service']))) {
        if ($Authorization->data['roles_id'] != ROLES_AGENT) {
            $AccidentMessages = new AccidentMessages($data);
            $AccidentMessages->show($data);
        }

		if ($Authorization->data['roles_id'] != ROLES_MASTER) {

			$AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);
			$AccidentPaymentsCalendar->show($data, $fields, $conditions);

			$AccidentPayments = new AccidentPayments($data);
			$AccidentPayments->show($data, $fields, $conditions);

            if($Authorization->data['permissions']['Tasks']['show'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR){
                $Tasks = new Tasks($data);
                $Tasks->show($data);
            }
		}

        if($Authorization->data['roles_id'] == ROLES_MASTER || $Authorization->data['permissions']['AccidentDocuments']['show'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR){
            $AccidentDocuments = new AccidentDocuments($data);
            $AccidentDocuments->show($data);
        }
		
	    if($Authorization->data['permissions']['AccidentEmails']['show'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR){
            $AccidentEmails = new AccidentEmails($data);
            $AccidentEmails->show($data);
        }

        if ($Authorization->data['permissions']['AccidentStatusChanges']['show'] || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) {
            $AccidentStatusChanges = new AccidentStatusChanges($data);
            $AccidentStatusChanges->show($data);
        }
        
	}
?>