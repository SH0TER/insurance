<script type="text/javascript">
    function setResponsibleList(type){
        switch (parseInt(type)) {
            case 1:
                $('#responsible_average_list').show();
                $('#responsible_estimate_list').hide();
                break;
            case 2:
                $('#responsible_average_list').hide();
                $('#responsible_estimate_list').show();
                break;
        }
    }

    function setResponsibleName(name) {
        alert(name);
    }

    function changeResponsible(){
        var responsible_type = parseInt($('input[name=responsible_type]:checked').val());
        var managers_id;
        if (responsible_type == 1 || responsible_type == 2) {
            switch (responsible_type) {
                case 1:
                    managers_id = parseInt($('select[name=responsible_average_list] option:selected').val());
                    break;
                case 2:
                    managers_id = parseInt($('select[name=responsible_estimate_list] option:selected').val());
                    break;
            }
            if (!managers_id) {
                alert('Виберіть менеджера зі списку');
            } else {
                $('#<?=$this->objectTitle?>do').submit();
            }
        } else {
            alert('Виберіть тип відповідального');
        }
    }

    $(document).ready(function(){
        setResponsibleList($('input[name=responsible_type]:checked').val());
    })
</script>

<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption">Зміна відповідальних по справі:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
                    <tr>
                        <td>
                            <form id="<?=$this->objectTitle?>do" name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$this->object.'|changeResponsible'?>" />
                                <input type="hidden" name="responsible_name" />
                                <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
								<?
									if (is_array($data['id'])) {
										foreach ($data['id'] as $id) {
											echo '<input type="hidden" name="id[]" value="' . $id . '" />';
										}
									}
								?>
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <tr>
                                        <td class="label">*Тип відповідального:</td>
                                        <td>
                                            <input id="responsible_average" type="radio" name="responsible_type" value="1" onclick="setResponsibleList(this.value)"><label for="responsible_average">Аварійний комісар</label>
                                            <input id="responsible_estimate" type="radio" name="responsible_type" value="2" onclick="setResponsibleList(this.value)"><label for="responsible_estimate">Експерт</label>
                                        </td>
                                    </tr>
                                    <tr>
										<td class="label">*Виберіть менеджера:</td>
										<td>
                                            <select id="responsible_average_list" name="responsible_average_list" onchange="$('input[name=responsible_name]').val($('#responsible_average_list option:selected').text())" style="display: <?=($data['responsible_type'] == 1 ? 'block' : 'none')?>;" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                <?
                                                    echo '<option value="">...</option>';
                                                    foreach ($average_managers as $average_manager) {
                                                        echo '<option value="' . $average_manager['id'] . '">' . $average_manager['name'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                            <select id="responsible_estimate_list" name="responsible_estimate_list" onchange="$('input[name=responsible_name]').val($('#responsible_estimate_list option:selected').text())" style="display: <?=($data['responsible_type'] == 2 ? 'block' : 'none')?>;" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                <?
                                                    echo '<option value="">...</option>';
                                                    foreach ($estimate_managers as $estimate_manager) {
                                                        echo '<option value="' . $estimate_manager['id'] . '">' . $estimate_manager['name'] . '</option>';
                                                    }
                                                ?>
                                            </select>
										</td>
									</tr>
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center"><input type="button" onclick="changeResponsible()" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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