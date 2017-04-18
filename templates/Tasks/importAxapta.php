<script type="text/javascript">
    var statuses = Array();
    <?php
        $t = array();
        foreach ($task_statuses as $task_status) {

            if (!in_array($task_status['task_types_id'], $t)) {
                echo 'statuses[' . $task_status['task_types_id'] . '] = Array();' . "\r\n";
                $t[] = $task_status['task_types_id'];
                $i = 0;
            }

            echo 'statuses[' . $task_status['task_types_id'] . '][' . $i . '] = [' . $task_status['id'] . ', ' . $db->quote($task_status['title']) . ', ' . $task_status['parent_id'] . '];' . "\r\n";
            $i++;
        }
    ?>

    function changeType() {

        var task_types_id = document.getElementById('task_types_id').value;
        var task_statuses = document.getElementById('task_statuses_id');

        task_statuses.options.length = 0;

        //устанавливаем
        task_statuses.options[0] = new Option('...', -1);
        if (task_types_id > 0) {
            for (var i=0; i < statuses[task_types_id].length; i++) {
                task_statuses.options.add( new Option(statuses[task_types_id][i][1], statuses[task_types_id][i][0]) );
            }
        }
    }
</script>

<? $Log->showSystem(); ?>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
		<td class="caption">Імпорт:</td>
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
					<input type="hidden" name="do" value="<?=$this->object?>|importAxapta" />
					<input type="hidden" name="process" value="1" />
					<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
					<table cellpadding="2" cellspacing="0" width="100%">
                        <tr>
                            <td class="label"><?=$this->getMark()?>Агенція:</td>
                            <td>
                                <select name="agencies_id" class="fldSelect" onfocus="this.className = 'fldSelect';" onblur="this.className = 'fldSelectOver';">
                                    <?
                                        echo '<option value="">...</option>';
                                        foreach ($agencies as $agency) {
                                            echo ($agency['id'] == $data['agencies_id'])
                                                ? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
                                                : '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td class="label"><?=$this->getMark()?>Тип:</td>
							<td>
								<select id="task_types_id" name="task_types_id" class="fldSelect" onchange="changeType()" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
									<option value="">...</option>
									<?php
										foreach($task_types as $task_type) {
											echo '<option value="' . $task_type['id'] . '" ' . (($data['task_types_id'] == $task_type['id']) ? 'selected': '') . '>' . $task_type['title'] . '</option>';
										}
									?>
								</select>
							</td>
                        </tr>
						<tr>
                            <td class="label"><?=$this->getMark()?>Статус:</td>
							<td>
								<select id="task_statuses_id" name="task_statuses_id" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';" ></select>
							</td>
                        </tr>

						<tr>
							<td class="label"><?=$this->getMark()?>Файл:</td>
							<td><input type="file" name="file" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
						</tr>
						<tr>
							<td width="150">&nbsp;</td>
							<td align="center"><input type="submit" value=" Імпортувати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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
	changeType();
	initFocus(document.<?=$this->objectTitle?>);
</script>