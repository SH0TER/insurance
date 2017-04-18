<?//_dump($data)?>
<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<script type="text/javascript">
    function showHideCarReviewBlock() {
        switch ( $('input[name=car_review]:checked').val() ) {
            case '1':
                $('#car_review').css('display', 'block');
                break;
            default:
                $('#car_review').css('display', 'none');
                break;
        }
    }

    function isValidDeteriorationValue() {
        var deterioration_value = parseFloat( $('input[name=deterioration_value]').val() );

        if (deterioration_value < 0 || deterioration_value > 1) {
            alert('Не вірний коефіцієнт зносу!');
            $('input[name=deterioration_value]').val('');
            return false;
        }

        if (parseFloat(deterioration_value) > 0 && parseInt(<?=($data['message_types_id'] != ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH ? '1' : '0')?>) == 1) {
            $('#deterioration_basisBlock').css('display', 'block');
        } else {
            $('#deterioration_basisBlock').css('display', 'none');
        }

        return true;
    }

    function changeAmount() {
        var amount = parseFloat($('input[name=amount_details]').val()) + parseFloat($('input[name=amount_material]').val()) + parseFloat($('input[name=amount_work]').val());
        $('#amount').html( getMoneyFormat(amount) );
    }

    function changeRepairProblem(value){
        if(value){
            $('.hide_change_repair_problem').hide();
            setObligatory(false);
        }else{
            $('.hide_change_repair_problem').show();
            setObligatory(true);
        }
    }

    function setObligatory(value){
        $('#answer_market_price').val(value);
        $('#answer_amount_residual').val(value);
        $('#answer_deterioration_value').val(value);
        $('#answer_amount_details').val(value);
        $('#answer_amount_material').val(value);
        $('#answer_amount_work').val(value);
        $('#result_calculation_car_services_id').val(value);
    }

    function setAudatexCodeBlock(value){
        console.log(value);
        $('input[name=result_calculation_car_services_title]').val($('select[name=result_calculation_car_services_id] option:selected').text())
        if(value < 1 || car_services_list[value] == 0){
            $('.audatex_codeBlock').hide();
            $('input[name=result_calculation_car_services_tis]').val(0);
        }else if (car_services_list[value] == 1) {
            $('.audatex_codeBlock').show();
            $('input[name=result_calculation_car_services_tis]').val(1);
        }
    }

    function setResultCalculationCarServicesId(value){
        if(value){
            $('select[name=result_calculation_car_services_id]').val(value);
        }
    }

    function getCarServicesList(){
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarServices|getAllCarServicesInWindow',
            success:    function(result){
                setAudatexCodeBlock($('select[name=result_calculation_car_services_id] option:selected').val());
            }
        });
    }

    function setViewBlocks(value) {
        if (value == <?=ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH?>) {
            $('.calculation').hide();
            $('input[name=result_calculation_car_services_tis]').val(0);
            $('#answer_result_calculation_car_services_id').val(false);
        }
        if (value == <?=ACCIDENT_MESSAGE_TYPES_INSPECTION?>) {
            $('#params').hide();
        }
    }

    function showCarServicesWindow(elem) {
        tb_show('<strong>Вибір СТО:</strong>', '#TB_inline?height=600&width=800&inlineId=hiddenModalContent'+elem, false);
    }

    function setEssentialCarService(recipients_id, recipient, recipient_identification_code, bank_account, bank_mfo, bank_edrpou, bank, tis, elem) {
        $('select[name=' + elem + ']').val(recipients_id);
        tb_remove();
        if (elem == 'calculation_car_services_id') {
            $('select[name=' + elem + ']').change();
        }
    }

    function getListBySearch(elem) {
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=CarServices|getListBySearchInWindow'+
                        '&elem='+elem+
                        '&search_title='+$('#search_title'+elem).val(),
            success:    function(result){
                $('#carServicesContent'+elem).html(result);
            }
        });
    }

    function changeTypes(){
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'json',
            data:       'do=AccidentMessages|getAutoInformationInWindow'+
                        '&accidents_id=<?=$data['accidents_id']?>',
            success:    function(result){
                $('input[name=owner_brand]').val( result.owner_brand );
                $('input[name=owner_model]').val( result.owner_model );
                $('input[name=owner_sign]').val( result.owner_sign );
                $('input[name=insurer_brand]').val( result.insurer_brand );
                $('input[name=insurer_model]').val( result.insurer_model );
                $('input[name=insurer_sign]').val( result.insurer_sign );
            }
        });

        if($('#owner_types_id').val() == 1){
           $('#insurer').show();
           $('#owner').hide();
        }
        else if($('#owner_types_id').val() == 2){
           $('#insurer').hide();
           $('#owner').show();
        }
        else{
           $('#insurer').hide();
           $('#owner').hide();
        }
    }
    
    function setClassRepair(value) {
        if (value <= 2) {
            $('#class_repair').html(1);
            $('input[name=repair_classifications_id]').val(1);
        } else if (value <= 6) {
            $('#class_repair').html(2);
            $('input[name=repair_classifications_id]').val(2);
        } else if (value <= 12) {
            $('#class_repair').html(3);
            $('input[name=repair_classifications_id]').val(3);
        } else {
            $('#class_repair').html(4);
            $('input[name=repair_classifications_id]').val(4);
        }
    }
    
    function setClassParts(value) {
        if (value <= 1) {
            $('#class_parts').html(1);
            $('input[name=parts_classifications_id]').val(1);
        } else if (value <= 3) {
            $('#class_parts').html(2);
            $('input[name=parts_classifications_id]').val(2);
        } else if (value <= 30) {
            $('#class_parts').html(3);
            $('input[name=parts_classifications_id]').val(3);
        } else {
            $('#class_parts').html(4);
            $('input[name=parts_classifications_id]').val(4);
        }
    }
    
    function showComments(){
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=AccidentMessages|getMonitoringInWindow&id=<?=$data['id']?>',
            success:    function(result){
                $('#comments').html(result);
            }
        });
    }

    $(document).ready(function(){
        if (parseInt(<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH ? '1' : '0')?>) != 1) {
            getCarServicesList();
            setResultCalculationCarServicesId($('input[name=accidents_car_services_id]').val());
            //changeRepairProblem($('input[name=repair_problem]').is(':checked'));
        }
        setViewBlocks(<?=$data['message_types_id']?>);
        changeTypes();
        
        $('input[name=repair_days]').bind("change keyup input click", function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
            
            setClassRepair(parseInt(this.value));
        });
        
        $('input[name=parts_days]').bind("change keyup input click", function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
            
            setClassParts(parseInt(this.value));
        });
        
        $('select[name=calculation_car_services_id]').change(function(){
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'json',
                data:       'do=Accidents|setCalculationCarServicesIdInWindow'+
                            '&car_services_id='+this.value+'&accidents_id=<?=$data['accidents_id']?>',
                success:    function(result){
                    alert(result.message);
                }
            });
        });
        
        showComments();
        
    });
    
</script>
<div class="section">Задача:</div>
<?if(intval($data['message_types_id']) == ACCIDENT_MESSAGE_TYPES_INSPECTION){?>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr>
            <td>
                <table cellpadding="2" cellspacing="0" width="40%">
                    <tr>
                        <td class="label">Оглянути автомобіль:</td>
                        <td>
                            <table cellpadding="0" cellspacing="0">
                                <? if ($data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
                                <tr>
                                    <td class="label grey">Тип особи:</td>
                                    <td>
                                            <select id="owner_types_id" name="owner_types_id" onchange="changeTypes();" class="fldSelect " onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?>>
                                            <option value="">...</option>
                                            <option value="1" <?=(($data['owner_types_id'] == 1) ? 'selected' : '')?>>Страхувальник</option>
                                            <option value="2" <?=(($data['owner_types_id'] == 2) ? 'selected' : '')?>>Потерпілий</option>
                                            </select>
                                            <input type="hidden" name="fields[question][owner_types_id][type]"  value="fldSelect" />
                                            <input type="hidden" name="fields[question][owner_types_id][label]"  value="Тип особи" />
                                    </td>
                                </tr>
                                <? } ?>
                                <tr style="height: 10px;"><td colspan="6"></td></tr>
                                <tr id="owner" style="display: none;">
                                    <td class="label grey">Марка ТЗ:</td>
                                    <td>
                                        <input type="text" name="owner_brand" value="<?=$data['owner_brand']?>" maxlength="50" class="fldText brand" onfocus="this.className='fldTextOver brand'" onblur="this.className='fldText brand'" disabled="" />
                                    </td>
                                    <td class="label grey">Модель ТЗ:</td>
                                    <td>
                                        <input type="text" name="owner_model" value="<?=$data['owner_model']?>" maxlength="50" class="fldText model" onfocus="this.className='fldTextOver model'" onblur="this.className='fldText model'" disabled="" />
                                    </td>
                                    <td class="label grey">Номер ТЗ:</td>
                                    <td>
                                        <input type="text" name="owner_sign" value="<?=$data['owner_sign']?>" maxlength="50" class="fldText model" onfocus="this.className='fldTextOver sign'" onblur="this.className='fldText sign'" disabled="" />
                                    </td>
                                </tr>
                                <tr id="insurer" style="display: none;">
                                    <td class="label grey">Марка ТЗ:</td>
                                    <td>
                                        <input type="text" name="insurer_brand" value="<?=$data['insurer_brand']?>" maxlength="50" class="fldText brand" onfocus="this.className='fldTextOver brand'" onblur="this.className='fldText brand'" disabled="" />
                                    </td>
                                    <td class="label grey">Модель ТЗ:</td>
                                    <td>
                                        <input type="text" name="insurer_model" value="<?=$data['insurer_model']?>" maxlength="50" class="fldText model" onfocus="this.className='fldTextOver model'" onblur="this.className='fldText model'" disabled="" />
                                    </td>
                                    <td class="label grey">Номер ТЗ:</td>
                                    <td>
                                        <input type="text" name="insurer_sign" value="<?=$data['insurer_sign']?>" maxlength="50" class="fldText model" onfocus="this.className='fldTextOver sign'" onblur="this.className='fldText sign'" disabled="" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table id="car_review_go" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td class="label grey">За адресою:</td>
                                        <td>
                                            <input type="text" name="car_address" value="<?=$data['car_address']?>" maxlength="50" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                                            <input type="hidden" name="fields[question][car_address][type]"  value="fldText" />
                                            <input type="hidden" name="fields[question][car_address][label]"  value="Оглянути автомобіль, за адресою" />
                                        </td>
                                        <td class="label grey">Контакт:</td>
                                        <td>
                                            <input type="text" name="car_contact" value="<?=$data['car_contact']?>" maxlength="50" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                                            <input type="hidden" name="fields[question][car_contact][type]"  value="fldText" />
                                            <input type="hidden" name="fields[question][car_contact][label]"  value="Оглянути автомобіль, контакт" />
                                        </td>
                                        <td class="label grey">Телефон:</td>
                                        <td>
                                            <input type="text" name="car_phone" value="<?=$data['car_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                                            <input type="hidden" name="fields[question][car_phone][type]"  value="fldText" />
                                            <input type="hidden" name="fields[question][car_phone][label]"  value="Оглянути автомобіль, телефон" />
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2"></td></tr>
                    <tr>
                        <td class="label">Коментар:</td>
                        <td>
                            <textarea name="comment_question" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?>><?=$data['comment_question']?></textarea>
                            <input type="hidden" name="fields[question][comment_question][type]"  value="fldNote" />
                            <input type="hidden" name="fields[question][comment_question][label]"  value="Коментар" />
                            <input type="hidden" name="fields[question][comment_question][obligatory]" value="true" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?}else{?>
    <table cellpadding="2" cellspacing="0" width="100%">
    <tr>        
        <td>
            <table cellpadding="2" cellspacing="0" width="40%">
            <? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?>
            <tr>
                <td class="label">Оглянути автомобіль:</td>
                <td>
                    <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <input type="checkbox" name="car_review" value="1" <?=($data['car_review']) ? 'checked' : ''?> onclick="showHideCarReviewBlock()" <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                            <input type="hidden" name="fields[question][car_review][type]"  value="fldCheckboxes" />
                            <input type="hidden" name="fields[question][car_review][label]"  value="Оглянути автомобіль" />
                        </td>
                        <td>
                            <table id="car_review" cellpadding="5" cellspacing="0" style="display: <?=($data['car_review']) ? 'block' : 'none'?>">
                            <tr>
                                <td class="label grey">За адресою:</td>
                                <td>
                                    <input type="text" name="car_address" value="<?=$data['car_address']?>" maxlength="50" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                                    <input type="hidden" name="fields[question][car_address][type]"  value="fldText" />
                                    <input type="hidden" name="fields[question][car_address][label]"  value="Оглянути автомобіль, за адресою" />
                                </td>
                                <td class="label grey">Контакт:</td>
                                <td>
                                    <input type="text" name="car_contact" value="<?=$data['car_contact']?>" maxlength="50" class="fldText address" onfocus="this.className='fldTextOver address'" onblur="this.className='fldText address'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                                    <input type="hidden" name="fields[question][car_contact][type]"  value="fldText" />
                                    <input type="hidden" name="fields[question][car_contact][label]"  value="Оглянути автомобіль, контакт" />
                                </td>
                                <td class="label grey">Телефон:</td>
                                <td>
                                    <input type="text" name="car_phone" value="<?=$data['car_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> />
                                    <input type="hidden" name="fields[question][car_phone][type]"  value="fldText" />
                                    <input type="hidden" name="fields[question][car_phone][label]"  value="Оглянути автомобіль, телефон" />
                                </td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="2"></td></tr>
            <tr>
                <td class="label">Виконати:</td>
                <td>
                    <input type="checkbox" name="perform_audatex" value="1" <?=($data['perform_audatex']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> розрахунок ПК "АУДАТЕКС"
                    <input type="hidden" name="fields[question][perform_audatex][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_audatex][label]"  value="Розрахунок ПК &quot;АУДАТЕКС&quot;" /><br />

                    <input type="checkbox" name="perform_deterioration_method" value="1" <?=($data['perform_deterioration_method']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> розрахунок фізичного зносу, згідно методики
                    <input type="hidden" name="fields[question][perform_deterioration_method][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_deterioration_method][label]"  value="Розрахунок фізичного зносу, згідно методики" /><br />

                    <input type="checkbox" name="perform_deterioration_agreement" value="1" <?=($data['perform_deterioration_agreement']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> розрахунок фізичного зносу, згідно умов договору страхування
                    <input type="hidden" name="fields[question][perform_deterioration_agreement][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_deterioration_agreement][label]"  value="Розрахунок фізичного зносу, згідно умов договору страхування" /><br />

                    <input type="checkbox" name="perform_car_price" value="1" <?=($data['perform_car_price']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> розрахунок вартості транспортного засобу на момент страхування
                    <input type="hidden" name="fields[question][perform_car_price][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_car_price][label]"  value="Розрахунок вартості транспортного засобу на момент страхування" /><br />

                    <input type="checkbox" name="perform_car_price_damaged" value="1" <?=($data['perform_car_price_damaged']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> розрахунок вартості пошкодженого транспортного засобу
                    <input type="hidden" name="fields[question][perform_car_price_damaged][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_car_price_damaged][label]"  value="Розрахунок вартості пошкодженого транспортного засобу" /><br />

                    <input type="checkbox" name="perform_car_price_damaged_auction" value="1" <?=($data['perform_car_price_damaged_auction']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline
                    <input type="hidden" name="fields[question][perform_car_price_damaged_auction][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_car_price_damaged_auction][label]"  value="Визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline" /><br />

                    <input type="checkbox" name="perform_check_research" value="1" <?=($data['perform_check_research']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> провести товарознавчу експертизу
                    <input type="hidden" name="fields[question][perform_check_research][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][perform_check_research][label]"  value="Провести товарознавчу експертизу" />
                </td>
            </tr>
            <? } ?>
            <tr><td colspan="2"></td></tr>
            <tr>
                <td class="label">Узгодити:</td>
                <td>
                    Рахунок з СТО:
                    <? $car_services = CarServices::getAllCarServices();
                        echo '<select name="calculation_car_services_id" class="fldSelect " onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id']) . '>
                                <option value="">...</option>';
                        foreach($car_services as $service) {
                            echo '<option value="' . $service['id'] . '" ' . (($data['calculation_car_services_id'] == $service['id']) ? ' selected' : '') . '>' .$service['title'].'</option>';
                        }
                        echo '</select>';
                    ?>
                    
                    <? if ($data['action'] == 'insert') { ?>
                        <a href="javascript: showCarServicesWindow('calculation_car_services_id')">СТО</a>
                        <input type="hidden" name="fields[question][calculation_car_services_id][type]"  value="fldSelect" />
                        <input type="hidden" name="fields[question][calculation_car_services_id][label]"  value="Рахунок з СТО" /><br />
                    <? } else { ?>
                        <input type="hidden" name="calculation_car_services_id"  value="<?=$data['calculation_car_services_id']?>" />
                    <? } ?>
                    
                    <br/>

                    <input type="checkbox" name="report_survey" value="1" <?=($data['report_survey']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> протокол огляду
                    <input type="hidden" name="fields[question][report_survey][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][report_survey][label]"  value="Протокол огляду" /><br />

                    <input type="checkbox" name="car_photo" value="1" <?=($data['car_photo']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> фото пошкодженого автомобіля
                    <input type="hidden" name="fields[question][car_photo][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][car_photo][label]"  value="Фото пошкодженого автомобіля" /><br />

                    <? if ($Authorization->data['roles_id'] != ROLES_MASTER) { ?>
                    <input type="checkbox" name="conclusion_expert" value="1" <?=($data['conclusion_expert']) ? 'checked' : ''?> <?=$this->getReadonly(true, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?> /> висновок експерта
                    <input type="hidden" name="fields[question][conclusion_expert][type]"  value="fldCheckboxes" />
                    <input type="hidden" name="fields[question][conclusion_expert][label]"  value="Висновок експерта" />
                    <? } ?>
                </td>
            </tr>
            <tr><td colspan="2"></td></tr>
            <tr>
                <td class="label">Коментар:</td>
                <td>
                    <textarea name="comment_question" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false, $data['action'] == 'update' && $Authorization->data['id'] != $data['authors_id'])?>><?=$data['comment_question']?></textarea>
                    <input type="hidden" name="fields[question][comment_question][type]"  value="fldNote" />
                    <input type="hidden" name="fields[question][comment_question][label]"  value="Коментар" />
                    <input type="hidden" name="fields[question][comment_question][obligatory]" value="true" />
                </td>
            </tr>
            </table>
        </td>
        <td valign="top">
            <? if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION) {?>
            <label><b>Призначення експерта:</b></label>
            <table cellpadding="0" cellspacing="0">
            <tr class="columns">
                <td width="200">Експерт</td>
                <td width="200">Призначити</td>
                <td width="70">Невиконаних задач</td>
            </tr>
            <?
                $list = Experts::getListByOrganizationId($data['expert_organizations_id']);
                if (sizeOf($list)) {
                    foreach ($list as $expert) {
                        $i = 1 - $i;
            ?>
            <tr class="<?=$this->getRowClass($expert, $i)?>">
                <td><?=(sizeOf($list)) ? $expert['expert_name']:'В даній організації відсутні експерти'?></td>
                <td align="center"><?='<input type="radio" name="recipients_id" value="' . $expert['id'].'"' . (($expert['id'] == $data['recipients_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true). ' />'?></td>
                <td align="center"><?=$expert['messages_count']?></td>
            </tr>
            <?
                    }
                }
            ?>
            </table>
            <?}?>
        </td>
    </tr>
    </table>
<?}?>

<div id="solution_sto" style="display: <?=($data['action']=='update' && $data['recipient_roles_id'] == ROLES_MASTER || ($data['action'] == 'view' && $data['recipient_roles_id'] == ROLES_MASTER)) ? 'block' : 'none'?>">
    <div class="section">Рішення CТО:</div>
    
    <div id="sto_params">
        <table cellpadding="2" cellspacing="0">
            <tr>
                <td class="label">Кількість днів на ремонт:</td>
                <td><input type="text" name="repair_days" value="<?=$data['repair_days']?>" class="fldInteger" maxlength="3" onfocus="this.className='fldIntegerOver'" onblur="this.className='fldInteger'" <?=$this->getReadonly(true, in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_ANSWER)))?> /></td>
                <input type="hidden" name="repair_classifications_id" value="<?=$data['repair_classifications_id']?>">
                
                <td class="label">Клас ремонту:</td>
                <td id="class_repair"><?=$data['repair_classifications_id']?></td>
            </tr>
            <tr>
                <td class="label">Кількість днів на поставку ЗЧ:</td>
                <td><input type="text" name="parts_days" value="<?=$data['parts_days']?>" class="fldInteger" maxlength="3" onfocus="this.className='fldIntegerOver'" onblur="this.className='fldInteger'" <?=$this->getReadonly(true, in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_ANSWER)))?> /></td>
                
                <input type="hidden" name="parts_classifications_id" value="<?=$data['parts_classifications_id']?>">
                
                <td class="label">Клас поставки ЗЧ:</td>
                <td id="class_parts"><?=$data['parts_classifications_id']?></td>
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
                    <? if ($this->mode == 'update' && ($data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION || $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ERROR)) {?>
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
    </div>
</div>

<div id="solution" style="display: <?=($data['action']=='update' && $Authorization->data['roles_id'] != ROLES_MASTER || ($data['action'] == 'view' && (intval($data['repair_classifications_id']) || $data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH))) ? 'block' : 'none'?>">
    <div class="section">Рішення експерта:</div>

    <div id='params'>
        <table cellpadding="2" cellspacing="0">
        
        <? if ($data['recipient_roles_id'] == ROLES_MASTER) {?>
        
        <tr class="calculation">
            <td colspan="2">
                <table>
                    <tr>
                        <td style="border: 4px solid #ff0000;" class="label">Запасні частини:<input type="checkbox" name="repair_parts" <?=(($data['repair_parts']) ? 'checked' : ' ')?> <?=$this->getReadonly(true)?> /></td>
                        <input type="hidden" name="fields[answer][repair_parts][type]"  value="fldBoolean" />
                        <input type="hidden" name="fields[answer][repair_parts][label]"  value="Запасні частини" />
                        <input type="hidden" name="fields[answer][repair_parts][obligatory]" value="false" />
                        
                        <?php
                            if((intval(substr($data[ 'account_request_date' ], 0, 4)) < 1000 || intval(substr($data[ 'account_request_date' ], 5, 2)) > 12 || intval(substr($data[ 'account_request_date' ], 5, 2)) < 1) && $data['id'])
                            {
                                global $db;

                                $sql = "SELECT created FROM insurance_accident_messages WHERE id = " . intval($data['id']);
                                $date = $db->getOne($sql);

                                $data[ 'account_request_date' ] = date_format(date_create($date), "Y-m-d");
                                unset($sql);
                                unset($date);
                            }

                        ?>

                        <td class="label">Дата запиту рахунку СТО:</td>
                        <td><?=$this->getDateSelect(0, $data[ 'account_request_date_year' ] ? $data[ 'account_request_date_year' ] : substr($data[ 'account_request_date' ], 0, 4), $data[ 'account_request_date_month' ] ? $data[ 'account_request_date_month' ] : substr($data[ 'account_request_date' ], 5, 2), $data[ 'account_request_date_day' ] ? $data[ 'account_request_date' ] : substr($data[ 'account_request_date' ], 8, 2), 'account_request_date',  $this->getReadonly(true, true))?></td>
                        <input type="hidden" name="fields[answer][account_request_date][type]"  value="fldDate" />
                        <input type="hidden" name="fields[answer][account_request_date][label]"  value="Дата запиту рахунку СТО" />
                        <input type="hidden" name="fields[answer][account_request_date][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />
                        
                        <td class="label">Дата отримання рахунку СТО:</td>
                        <td><?=$this->getDateSelect(0, $data[ 'account_answer_date_year' ] ? $data[ 'account_answer_date_year' ] : substr($data[ 'account_answer_date' ], 0, 4), $data[ 'account_answer_date_month' ] ? $data[ 'account_answer_date_month' ] : substr($data[ 'account_answer_date' ], 5, 2), $data[ 'account_answer_date_day' ] ? $data[ 'account_answer_date' ] : substr($data[ 'account_answer_date' ], 8, 2), 'account_answer_date',  $this->getReadonly(true))?></td>
                        <input type="hidden" name="fields[answer][account_answer_date][type]"  value="fldDate" />
                        <input type="hidden" name="fields[answer][account_answer_date][label]"  value="Дата запиту рахунку СТО" />
                        <input type="hidden" name="fields[answer][account_answer_date][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />                        
                    </tr>
                </table>
            </td>
        </tr>
        
        <? } ?>
        
        <? if ($data['recipient_roles_id'] == ROLES_MANAGER) {?>
        
        <tr class="hide_change_repair_problem calculation">
            <td class="label">Класифікація ремонту:</td>
            <td>
            <?
                $repairs = $this->getRepairList();
                foreach($repairs as $repair) {
                    echo $repair['title'] . ' <input type="radio" name="repair_classifications_id" value="' . $repair['id'].'"' . (($repair['id'] == $data['repair_classifications_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true). ' />';
                }
            ?>
            <input type="hidden" name="fields[answer][repair_classifications_id][type]"  value="fldRadio" />
            </td>
        </tr>
        
        <? } ?>
        
        <tr class="hide_change_repair_problem">
            <td class="label"><?=$this->getMark()?>Коефіцієнти:</td>
            <td>
                <table cellpadding="5" cellspacing="0">
                <tr>
                    <td><?=$this->getMark()?>Ринкова вартість, грн.:</td>
                    <td>
                        <input type="text" name="market_price" value="<?=(($data['action'] == 'update' && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) ? $data['previous_acts_market_price'] : $data['market_price'])?>" maxlength="13" onchange="changeAmount()" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][market_price][type]"  value="fldMoney" />
                        <input type="hidden" name="fields[answer][market_price][label]"  value="Ринкова вартість, грн." />
                        <input id="answer_market_price" type="hidden" name="fields[answer][market_price][obligatory]" value="true" />
                    </td>
                    <td><?=$this->getMark()?>Залишки, грн.:</td>
                    <td>
                        <input type="text" name="amount_residual" value="<?=$data['amount_residual']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(true)?> />
                        <input type="hidden" name="fields[answer][amount_residual][type]"  value="fldMoney" />
                        <input type="hidden" name="fields[answer][amount_residual][label]"  value="Залишки, грн." />
                        <input id="answer_amount_residual" type="hidden" name="fields[answer][amount_residual][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />
                    </td>
                    <td><?=$this->getMark()?>Сума первинного рахунку, грн.:</td>
                    <td>
                        <input type="text" name="first_repair_amount" value="<?=$data['first_repair_amount']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(true)?> />
                        <input type="hidden" name="fields[answer][first_repair_amount][type]"  value="fldMoney" />
                        <input type="hidden" name="fields[answer][first_repair_amount][label]"  value="Сума первинного рахунку, грн." />
                        <input id="answer_amount_residual" type="hidden" name="fields[answer][first_repair_amount][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />
                    </td>
                </tr>
                </table>

                <table cellpadding="5" cellspacing="0">
                <tr>
                    <td><?=$this->getMark()?>Коефіцієнт зносу:</td>
                    <td>
                        <input type="text" name="deterioration_value" value="<?=(($data['action'] == 'update' && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) ? $data['previous_acts_deterioration_value'] : $data['deterioration_value'])?>" maxlength="6" onchange="if (isValidDeteriorationValue()) changeAmount();" class="fldPercent" onfocus="this.className='fldPercentOver'" onblur="this.className='fldPercent'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][deterioration_value][type]"  value="fldPercent" />
                        <input type="hidden" name="fields[answer][deterioration_value][label]"  value="Коефіцієнт зносу" />
                        <input id="answer_deterioration_value" type="hidden" name="fields[answer][deterioration_value][obligatory]" value="true" />
                    </td>
                    <td id="deterioration_basisBlock" style="display: <?=(($data['deterioration_value'] > 0 || $data['previous_acts_deterioration_value'] > 0) && $data['message_types_id'] != ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH) ? 'block' : 'none'?>">
                        <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td><?=$this->getMark()?>Згідно:</td>
                            <td width="500">
                                <input type="text" name="deterioration_basis" value="<?=$data['deterioration_basis']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> />
                                <input type="hidden" name="fields[answer][deterioration_basis][type]"  value="fldText" />
                                <input type="hidden" name="fields[answer][deterioration_basis][label]"  value="Коефіцієнт зносу, згідно" />
                                <input id="answer_deterioration_basis" type="hidden" name="fields[answer][deterioration_basis][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH ? 'false' : 'true')?>" />
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>
            </td>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <td class="label"><?=$this->getMark()?>Вартість<br />відновлювального ремонту:</td>
            <td>
                <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Згiдно:</td>
                    <td width="100">
                        <input type="text" name="payment_document_title" value="<?=$data['payment_document_title']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][payment_document_title][type]"  value="fldText" />
                        <input type="hidden" name="fields[answer][payment_document_title][label]"  value="Згiдно" />
                        <input id="answer_payment_document_number" type="hidden" name="fields[answer][payment_document_title][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />
                    </td>
                    <td> &nbsp;&nbsp;номер&nbsp;&nbsp; </td>
                    <td width="250">
                        <input type="text" name="payment_document_number" value="<?=$data['payment_document_number']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][payment_document_number][type]"  value="fldText" />
                        <input type="hidden" name="fields[answer][payment_document_number][label]"  value="Згiдно" />
                        <input id="answer_payment_document_number" type="hidden" name="fields[answer][payment_document_number][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />
                    </td>
                    <td> &nbsp;&nbsp;вiд&nbsp;&nbsp; </td>
                    <td>
                        <?=$this->getDateSelect(0, $data[ 'payment_document_date_year' ] ? $data[ 'payment_document_date_year' ] : substr($data[ 'payment_document_date' ], 0, 4), $data[ 'payment_document_date_month' ] ? $data[ 'payment_document_date_month' ] : substr($data[ 'payment_document_date' ], 5, 2), $data[ 'payment_document_date_day' ] ? $data[ 'payment_document_date_day' ] : substr($data[ 'payment_document_date' ], 8, 2), 'payment_document_date',  $this->getReadonly(true))?>
                        <input type="hidden" name="fields[answer][payment_document_date][type]"  value="fldDate" />
                        <input type="hidden" name="fields[answer][payment_document_date][label]"  value="Згiдно, вiд" />
                        <input type="hidden" name="fields[answer][payment_document_date][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION ? 'true' : 'false')?>" />
                    </td>
                </tr>
                <? if ($data['recipient_roles_id'] == ROLES_MANAGER) {?>
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Калькуляція з СТО:</td>
                    <td nowrap>
                        <? 
                            $car_services = CarServices::getAllCarServices();
                            echo '<select name="result_calculation_car_services_id" onChange="setAudatexCodeBlock(this.value)" class="fldSelect " onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $this->getReadonly(true, $data['action'] == 'view') . '>
                                  <option value="">...</option>';
                            foreach($car_services as $service) {
                                echo '<option value="' . $service['id'] . '" ' . (($data['result_calculation_car_services_id'] == $service['id']) ? ' selected' : '') . '>' .$service['title'].'</option>';
                            }
                            echo '</select>';
                        ?>
                        <a href="javascript: showCarServicesWindow('result_calculation_car_services_id')">СТО</a>
                        <input type="hidden" name="accidents_car_services_id" value="<?=(($data['action'] == 'update' && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) ? intval($data['accidents_car_services_id']) : intval($data['result_calculation_car_services_id']))?>" />

                        <input type="hidden" name="fields[answer][result_calculation_car_services_id][type]"  value="fldSelect" />
                        <input type="hidden" name="fields[answer][result_calculation_car_services_id][label]" value="Калькуляція з СТО" />
                        <input id="result_calculation_car_services_id" type="hidden" name="fields[answer][result_calculation_car_services_id][obligatory]" value="true" />

                        <input type="hidden" name="result_calculation_car_services_tis" value="<?=$data['result_calculation_car_services_tis']?>" />
                        <input type="hidden" name="result_calculation_car_services_title"  value="<?=$data['result_calculation_car_services_title']?>" />
                        <input type="hidden" name="fields[answer][result_calculation_car_services_title][type]"  value="fldText" />
                        <input type="hidden" name="fields[answer][result_calculation_car_services_title][label]"  value="СТО, назва" />
                        <input type="hidden" name="fields[answer][result_calculation_car_services_title][obligatory]" value="<?=($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH ? 'false' : 'true')?>" />
                    </td>
                </tr>
                <? } ?>
                <tr class="audatex_codeBlock calculation" style="display: <?=($data['recipient_roles_id'] == ROLES_MASTER && $data['result_calculation_car_services_tis'] == 1 ? 'block' : 'none')?>;">
                    <td class="label grey"><?=$this->getMark()?>Код AUDATEX:</td>
                    <td>
                        <input type="hidden" name="result_calculation_car_services_tis" value="<?=$data['result_calculation_car_services_tis']?>" />
                        <input type="text" name="audatex_code" value="<?=$data['audatex_code']?>" maxlength="10" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][audatex_code][type]"  value="fldText" />
                        <input type="hidden" name="fields[answer][audatex_code][label]"  value="Код AUDATEX" />
                        <input id="answer_audatex_code" type="hidden" name="fields[answer][audatex_code][obligatory]" value="true" />
                    </td>
                </tr>
                </table>
                <table cellpadding="5" cellspacing="0" class="hide_change_repair_problem">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Запчастин, грн.:</td>
                    <td>
                        <input type="text" name="amount_details" value="<?=$data['amount_details']?>" maxlength="10" onchange="changeAmount()" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][amount_details][type]"  value="fldMoney" />
                        <input type="hidden" name="fields[answer][amount_details][label]"  value="Запчастин, грн." />
                        <input id="answer_amount_details" type="hidden" name="fields[answer][amount_details][obligatory]" value="true" />
                    </td>
                    <td class="label grey"><?=$this->getMark()?>Матеріалів, грн.:</td>
                    <td>
                        <input type="text" name="amount_material" value="<?=$data['amount_material']?>" maxlength="10" onchange="changeAmount()" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][amount_material][type]"  value="fldMoney" />
                        <input type="hidden" name="fields[answer][amount_material][label]"  value="Матеріалів, грн." />
                        <input id="answer_amount_material" type="hidden" name="fields[answer][amount_material][obligatory]" value="true" />
                    </td>
                    <td class="label grey"><?=$this->getMark()?>Робіт, грн.:</td>
                    <td>
                        <input type="text" name="amount_work" value="<?=$data['amount_work']?>" maxlength="10" class="fldMoney" onchange="changeAmount()" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly()?> />
                        <input type="hidden" name="fields[answer][amount_work][type]"  value="fldMoney" />
                        <input type="hidden" name="fields[answer][amount_work][label]"  value="Робіт, грн." />
                        <input id="answer_amount_work" type="hidden" name="fields[answer][amount_work][obligatory]" value="true" />
                    </td>
                    <td class="label grey"><b>Всього, грн.:</b></td>
                    <td id="amount"><?=getMoneyFormat($data['amount_details'] + $data['amount_material'] + $data['amount_work'])?></td>
                </tr>
                </table>
            </td>
        </tr>
        </table>        
    </div>    
</div>

<table width="600" cellpadding="5" cellspacing="0">
    <tr>
        <td width="50%" valign="top">
            <table>
                <tr>
                    <td width="10"><b>Моніторинг:</b></td>
                    <td><div id="comments" style="overflow-y: scroll; height: 150px;"></div></td>
                </tr>
                <tr>
                    <td><b>Запис в моніторинг:</b></td>
                    <td><textarea name="monitoring_comment" rows="10" cols="100" <?=$this->getReadonly(true)?>></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?=CarServices::getListToChoose($data['calculation_car_services_id'], 0, "calculation_car_services_id");?>
<?=CarServices::getListToChoose($data['calculation_car_services_id'], 0, "result_calculation_car_services_id");?>