<script>
	function setStatus(value) {
		if (value == 2) {
			if (!confirm('Ви дійсно хочете змінити статус реєстру на \'Сформований\'?')) {
				return;
			}
		}
		
		if (value == 3) {
			if (!confirm('Ви дійсно хочете змінити статус реєстру на \'Відзвітований\'?')) {
				return;
			}
		}
		
		if (value == 4) {
			if (!confirm('Ви дійсно хочете змінити статус реєстру на \'Закритий\'?')) {
				return;
			}
		}
	
		if($('input[name=id[]]:checked').length == 0 && value == 2) {
			alert('Необхідно вибрати хоча б один акт');
			return;
		}		
	
		var acts_id = '';
		
		if (value == 2) {
			$('input[name=id[]]').each(function(){
				if (!$(this).attr('checked')) {
					acts_id = acts_id + '&acts_id[]=' + this.value;
				}			
			});
		}

		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=AccidentsActsTransfer|changeStatusesIdInWindow' +
						'&id=' + <?=$data['id']?> +
						'&types_id=' + <?=$data['types_id']?> +
						'&value=' + value + acts_id,
			success: function(result) {
				alert(result.message);
				//location.reload();
				location.replace('index.php?do=AccidentsActsTransfer|show&types_id='+<?=$data['types_id']?>);
			}
		});
	}
	
	function setComment(id, transfer_comment) {
		if ($('textarea[name=transfer_comment'+id+']').val().length == 0) {
			return;
		}
		if (!confirm('Ви впевненні, що хочете зберегти зауваження?')) {
			return;
		}
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            data:		'do=AccidentsActsTransfer|setCommentInWindow' +
						'&transfer_id=' + <?=intval($data['id'])?> +
                        '&id=' + id +
                        '&transfer_comment=' + $('textarea[name=transfer_comment'+id+']').val(),
            success: 	function(result) {
                            switch (result.type) {
                                case 'confirm':								
									//$('textarea[name=transfer_comment'+id+']').attr('disabled', 'disabled');
									//$('#set_transfer_comment' + id).hide();
                                    break;
                                case 'error':
                                    alert(result.text);
                                    break;
                            }
                        }
        });
    }
	
	function backToRisk(id) {
		if (!confirm('Ви впевненні, що хочете передати акт на доопрацювання?')) {
			return;
		}
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            data:		'do=AccidentsActsTransfer|backToRiskInWindow' +
						'&transfer_id=' + <?=intval($data['id'])?> +
                        '&id=' + id,
            success: 	function(result) {
                            switch (result.type) {
                                case 'confirm':								
									$('#back_to_risk' + id).hide();
                                    break;
                                case 'error':
                                    alert(result.text);
                                    break;
                            }
                        }
        });
	}
	
	function backToList() {
		window.location = '?do=<?=$this->object?>|show&types_id=<?=$data['types_id']?>';
	}
</script>
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption"><?=$this->messages['single']?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>		
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getTransferAccidentsActsList" />
			<input type="hidden" name="transfer_id" value="<?=$data['id']?>" />
			<input type="hidden" name="transfer_statuses_id" value="<?=$data['statuses_id']?>" />
			<input type="hidden" name="types_id" value="<?=$data['types_id']?>" />
			<table width="80%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="28">
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="bottom">
							<table cellpadding="0" cellspacing="0">
							<tr>
								<? if ($this->permissions['export']) { echo '<td width="22"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionExport\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionExport\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'ActionExport\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'ActionExport" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'; }?>
								<td width="10"></td>
								<td class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
							</tr>
							</table>
						</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td>
					<? if (sizeOf($list)) {?>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns" style="text-align: center;">
							<? if ($data['statuses_id'] == 1 && $action == 'update') { ?>
								<td class="id"><input name="sel_all" type="checkbox" onClick="selectAll(document.<?=$this->objectTitle?>, 'id[]', checked); MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');" /></td>
							<? } ?>
							<td>№</td>
							<td>Номер справи</td>
							<td>Вид страхування</td>
							<td>Номер договору</td>
							<td>Страхувальник</td>
							<td>Потерпілий</td>
							<td>Номер страхового акту</td>
							<? if ($this->permissions['comment']) { ?>
								<td>Статус акту</td>
							<? } ?>
							<td>Дата затвердження страхового акту</td>
							<td>Рішення по справі</td>
							<? if ($data['types_id'] == 1) { ?>
								<td>Сума страхової виплати</td>
								<!--td>Порушено пункт правил страхування</td-->							
								<td>Примітка</td>
								<? if (($this->permissions['comment'] || $this->permissions['formed']) && $data['statuses_id'] > 2) { ?>
									<td colspan="2">Зауваження</td>
								<? } ?>
								<? if ($this->permissions['comment'] && $data['statuses_id'] > 2) { ?>
									<td colspan="2">Дії</td>
								<? } ?>
							<? } ?>
							<? if ($data['types_id'] == 2) { ?>
								<td>№ звіту Повіренного / дата</td>
								<td>Сума</td>
							<? } ?>
						</tr>
						<?
							$i = 0;
							$number = 0;
							foreach ($list as $row) {
								$i = 1 - $i;
								$number++;
						?>
						<tr class="<?=Form::getRowClass($row, $i)?>">
							<? if ($data['statuses_id'] == 1 && $action == 'update') { ?>
								<td class="<?=$class?>"><input type="checkbox" name="id[]" value="<?=$row['id']?>" onclick="javascript: MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]')"></td>
							<? } ?>
							<td><?=$number?>.</td>
							<td><a target="_blank" href="<?=$_SERVER['PHP_SELF'] . '?do=Accidents|view&id=' . $row['accidents_id'] . '&product_types_id=' . $row['product_types_id']?>"><?=$row['accidents_number']?></a></td>							
							<td><?=$row['product_types_title']?></td>
							<td><?=$row['policies_number']?></td>
							<td><?=$row['insurer']?></td>
							<td><?=$row['owner']?>&nbsp;</td>
							<td><a target="_blank" href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentActs|view&id=' . $row['id'] . '&product_types_id=' . $row['product_types_id']?>"><?=$row['accidents_acts_number']?></a></td>
							<? if ($this->permissions['comment']) { ?>
								<td><?=$row['act_statuses_title']?></td>
							<? } ?>
							<td><?=$row['accidents_acts_date']?></td>
							<td><?=$row['insurance_title']?></td>
							<? if ($data['types_id'] == 1) { ?>
								<td><?=getRateFormat($row['amount'],2)?>&nbsp;</td>
								<!--td><?=$row['reason']?>&nbsp;</td-->							
								<td><?=$row['notes']?></td>
								<? if (($this->permissions['comment'] || $this->permissions['formed']) && $data['statuses_id'] > 2) { ?>
									<td class="bottom" id="transfer_comment<?=$row['id']?>TD">
										<textarea name="transfer_comment<?=$row['id']?>" style="resize:none; height:25px; width:250px;" <?=(($data['statuses_id'] > 2 && $this->permissions['comment']) ? '' : 'disabled')?>><?=$row['transfer_comment']?></textarea>
									</td>
									<td><? if ($data['statuses_id'] > 2 && $this->permissions['comment']) { ?><a id="set_transfer_comment<?=$row['id']?>" href="javascript:setComment(<?=$row['id']?>, <?=$db->quote($row['transfer_comment'])?>)" title="Зберегти коментар"><img src="/images/administration/navigation/edit_over.gif" width="19" height="19" alt="Редагувати коментар" /></a><? } ?></td>
								<? } ?>							
								<td><? if ($data['statuses_id'] > 2 && $this->permissions['comment'] && in_array($row['act_statuses_id'], array(ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY, ACCIDENT_STATUSES_PAYMENT))) { ?><input id="back_to_risk<?=$row['id']?>" type="button" class="button" onClick="backToRisk(<?=$row['id']?>)" value="ПР" title="Перевести справу на 'Повторний розгляд'" /><? } ?></td>
							<? } ?>
							<? if ($data['types_id'] == 2) { ?>
								<td><a target="_blank" href="<?=$_SERVER['PHP_SELF'] . '?do=AccidentsActsTransfer|view&id=' . $row['transfer_id'] . '&types_id=1'?>"><?=$row['transfer_info']?></a></td>
								<td><?=AMONT_PAYMENT_EUASSIST?></td>
							<? } ?>
						</tr>
						<?
							}
						?>
					</table>
					<? }?>
				</td>
			</tr>
			<tr>
				<td align="center">
					<? if($this->permissions['formed'] && $data['statuses_id'] == 1 && $action == 'update') echo '<input type="button" class="button" value="Сформувати" onClick="setStatus(2);">'; ?>
					<? if($this->permissions['received'] && $data['statuses_id'] == 2) echo '<input type="button" class="button" value="Отримати" onClick="setStatus(3);">'; ?>
					<? if($this->permissions['received'] && $data['statuses_id'] == 3) echo '<input type="button" class="button" value="Закрити" onClick="setStatus(4);">'; ?>
					<input type="button" class="button" value="Назад" onClick="backToList();">
				</td>
			</tr>
			</table>
			</form>
			</div>
			<script type="text/javascript">
				document.<?=$this->objectTitle?>.buttons = new Array();
				<? if ($this->permissions['export']) { echo 'document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'ActionExport\', document.'.$this->objectTitle.', \''.$this->object.'|exportInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'; }?>
				document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
				MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
				<? if ($data['statuses_id'] == 1 && $action == 'update') { ?>
					$('input[name=sel_all]').attr('checked', 'checked');
					$('input[name=id[]]').each(function(){
						$(this).attr('checked', 'checked');
					})
				<? } ?>
			</script>
		</td>
	</tr>
	</table>
</div>