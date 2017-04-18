<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<script type="text/javascript">

    function showCarServicesWindow(elem) {
        tb_show('<strong>Вибір СТО і майстра:</strong>', '#TB_inline?height=600&width=800&inlineId=hiddenModalContent'+elem, false);
    }

    function setEssentialCarService(recipients_id, recipient, recipient_identification_code, bank_account, bank_mfo, bank_edrpou, bank, tis, elem) {
        $('input[name=car_services_id_message]').val(recipients_id);
        $('input[name=car_services_title_message]').val(recipient);

        if (recipients_id == 0) {
            setMaster(0, '');
            return;
        }

        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=Masters|getMastersByCarServicesIdInWindow'+
                '&elem='+elem+
                '&car_services_id='+recipients_id,
            success:    function(result){
                //$('#TB_ajaxContent').html(result);
                $('#search_title').css('display', 'none');
                $('#search_btn').css('display', 'none');
                $('#carServicesContent'+elem).html('');
                $('#mastersContent').html(result);
            }
        });
    }

    function getListBySearch(elem) {
        if ($('#search_title'+elem).val() !== undefined) {
            search_title = $('#search_title'+elem).val();
        } else {
            search_title = '';
        }

        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=CarServices|getListBySearchInWindow'+
                '&elem='+elem+
                '&empty_row=1'+
                '&search_title='+search_title,
            success:    function(result){
                //$('#TB_ajaxContent').html(result);
                console.log(result);
                $('#carServicesContent'+elem).html(result);
            }
        });
    }

    function setMaster(id/*, name*/) {
        $('input[name=masters_id_message]').val(id);
        //$('input[name=masters_name_message]').val(name);
        getListBySearch('select_master_recipient');
        tb_remove();
        if (id > 0) {
			$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'json',
				data:       'do=Masters|getNameInWindow'+
					'&id='+id,
				success:    function(result){
					$('input[name=masters_name_message]').val(result.name);
					$('#masters_info').html(result.name + ' - ' + $('input[name=car_services_title_message]').val());
				}
			});            
        } else {
            $('#masters_info').html('Вибрати майстра');
        }
    }

    function changeInspectingAccount(){
        if (parseInt($('input[name=masters_id_message]').val()) > 0) {
            $('#<?=$this->objectTitle?>do').submit();
        } else {
            alert('Виберіть майстра');
        }
    }

    $(document).ready(function(){
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
                                <input type="hidden" name="do" value="<?=$this->object.'|changeInspectingAccount'?>" />
                                <input type="hidden" name="change" value="1" />
                                <input type="hidden" name="car_services_title_message" value="<?=$data['car_services_title_message']?>" />
                                <input type="hidden" name="masters_id_message" value="<?=$data['masters_id_message']?>" />
                                <input type="hidden" name="masters_name_message" value="<?=$data['masters_name_message']?>" />
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
										<td class="label">
                                            <a id="select_master_recipient" href="javascript: showCarServicesWindow('select_master_recipient')"><label id="masters_info">Вибрати майстра</label></a>
										</td>
									</tr>
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center"><input type="button" onclick="changeInspectingAccount()" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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
<?=CarServices::getListToChoose($data['car_services_id'], 1, 'select_master_recipient');?>