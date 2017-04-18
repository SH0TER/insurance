<script>

    var avr_count = -1;

    $(document).ready(function(){
        $('#avr_add').click(function(){
            var table = $('#avr_list');
            var tr = $('<tr />');
            var td = $('<td />');
            var begin_date = $('<input />').attr({'name': 'avr[' + avr_count + '][begin_date]', 'id': 'avr[' + avr_count + '][begin_date]', 'type': 'text'});
            var end_date = $('<input />').attr({'name': 'avr[' + avr_count + '][end_date]', 'id': 'avr[' + avr_count + '][end_date]', 'type': 'text'});
            var number = $('<input />').attr({'name': 'avr[' + avr_count + '][number]', 'type': 'text', 'class': 'fldText'});
            var amount = $('<input />').attr({'name': 'avr[' + avr_count + '][amount]', 'type': 'text', 'class': 'fldMoney'});
            var remove = $('<a><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a>');
            
            var tdBeginDate = td.clone().append(begin_date);
            var tdEndDate = td.clone().append(end_date);            
            var tdNumber = td.clone().append(number);
            var tdAmount = td.clone().append(amount);
            var tdRemove = td.clone().append(remove);
            
            tr.append('<td class="label">Дата відкриття:</td>');
            tr.append(tdBeginDate);
            tr.append('<td class="label" style="width: 100px;">Дата закриття:</td>');
            tr.append(tdEndDate);
            tr.append('<td class="label" style="width: 70px;">Номер:</td>');
            tr.append(tdNumber);
            tr.append('<td class="label" style="width: 60px;">Сума:</td>');
            tr.append(tdAmount);
            tr.append(tdRemove);
            
            table.append(tr);
            
            $(begin_date).datePicker({'startDate' : '01/01/2015'});         
            $(end_date).datePicker({'startDate' : '01/01/2015'});
            
            $(remove).click(function(){
                $(this).parent().parent().remove();
            });
            
            avr_count--;
        });
        
        showComments();
    });
    
    function showComments(){
        $.ajax({
            type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=RecoveryRepairs|getMonitoringInWindow&id=<?=$data['id']?>',
            success:    function(result){
                $('#comments').html(result);
            }
        });
    }

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
                    <tr><td colspan="2" class="content">Дані:</td></tr>
                    <tr><td colspan="2" class="content">Загальні:</td></tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td class="label">Номер справи:</td>
                                    <td>
                                        <a href="<?=$_SERVER['PHP_SELF'] . '?do=Accidents|view&id=' . $info['accidents_id'] . '&product_types_id=' . $this->getProductTypesId($data['id'])?>" target="_blank">
                                            <u><?=$info['accidents_number']?></u>
                                        </a>
                                    </td>
                                    <td class="label">ТЗ:</td>
                                    <td><?=$info['item']?></td>
                                    <td class="label">Власник:</td>
                                    <td><?=$info['owner']?></td>
                                    <td class="label">Дата заяви:</td>
                                    <td><?=$info['accidents_date']?></td>
                                    <td class="label">Плановий строк обслуговування:</td>
                                    <td><?=$info['plan_days']?></td>
                                    <td class="label">Строк обслуговування:</td>
                                    <td><?=$info['fact_days']?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2" class="content">Розрахунок суми відновлювального ремонту:</td></tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td class="label">Кількість днів на ремонт:</td>
                                    <td><?=$info["answer"]['repair_days']?></td>
                                    <td class="label">Клас ремонту:</td>
                                    <td><?=$info["answer"]['repair_classifications_id']?></td>
                                    <td class="label">Кількість днів на поставку ЗЧ:</td>
                                    <td><?=$info["answer"]['parts_days']?></td>
                                    <td class="label">Клас поставки ЗЧ:</td>
                                    <td><?=$info["answer"]['parts_classifications_id']?></td>
                                </tr>
                                <tr>
                                    <td class="label">Дата запиту рахунку СТО:</td>
                                    <td><?=date('d.m.Y', strtotime($info["answer"]['account_request_date']))?></td>
                                    <td class="label">Дата отримання рахунку СТО:</td>
                                    <td><?=date('d.m.Y', strtotime($info["answer"]['account_answer_date']))?></td>
                                    <td class="label">Дата закриття задачі:</td>
                                    <td><?=date('d.m.Y', strtotime($info['decision']))?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Вартість<br />відновлювального ремонту:</td>
                                    <td>
                                        <table cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td class="label grey">Згiдно:</td>
                                                <td width="100"><?=$info["answer"]['payment_document_title']?></td>
                                                <td> &nbsp;&nbsp;номер&nbsp;&nbsp; </td>
                                                <td width="100"><?=$info["answer"]['payment_document_number']?></td>
                                                <td> &nbsp;&nbsp;вiд&nbsp;&nbsp; </td>
                                                <td><?=date('d.m.Y', strtotime($info["answer"]['payment_document_date']))?></td>
                                            </tr>
                                        </table>
                                        <table cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td class="label grey">Запчастин, грн.:</td>
                                                <td><?=$info["answer"]['amount_details']?></td>
                                                <td class="label grey">Матеріалів, грн.:</td>
                                                <td><?=$info["answer"]['amount_material']?></td>
                                                <td class="label grey">Робіт, грн.:</td>
                                                <td><?=$info["answer"]['amount_work']?></td>
                                                <td class="label grey"><b>Всього, грн.:</b></td>
                                                <td><?=$info["answer"]['amount_details'] + $info["answer"]['amount_material'] + $info["answer"]['amount_work']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>                       
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2" class="content">Розрахунок суми відшкодування:</td></tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td class="label">Франшиза:</td>
                                    <td><?=$info['deductibles_amount']?></td>
                                    <td class="label">Коефіцієнт пропорційності:</td>
                                    <td><?=$info['proportionality_value']?></td>
                                    <td class="label">Фізичний знос:</td>
                                    <td><?=$info['deterioration_value']?></td>
                                </tr>                               
                                <tr>
                                    <td class="label">Результат:</td>
                                    <td colspan="5"><?=$info['calc_info']?></td>
                                </tr>
                                <tr>
                                    <td class="label">Сума оплати:</td>
                                    <td><?=$info['payment_amount']?></td>
                                    <td class="label">Дата оплати:</td>
                                    <td><?=$info['payment_date']?></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td colspan="2" class="content">Відновлювальний ремонт:</td></tr>
                    <tr>
                        <td colspan="2">
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                                <input type="hidden" name="id" value="<?=$data['id']?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />                        
                                <table>
                                    <tr>
                                        <td class="label">Дата замовлення ЗЧ:</td>
                                        <td><?=$this->getDateSelect(0, $data[ 'order_date_year' ], $data[ 'order_date_month' ], $data[ 'order_date_day' ], 'order_date',  $this->getReadonly(true, $info['answer']['repair_parts'] != 'on'))?></td>
                                        <td rowspan="8">
                                            <table width="600" cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td width="50%" valign="top">
                                                        <table>
                                                            <tr>
                                                                <td width="10"><b>Моніторинг:</b></td>
                                                                <td><div id="comments" style="overflow-y: scroll; height: 150px; border: 2px solid; border-radius: 10px;"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Запис в моніторинг:</b></td>
                                                                <td><textarea name="monitoring_comment" rows="6" cols="100" <?=$this->getReadonly(true)?>></textarea></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">Орієнтовна дата отримання ЗЧ:</td>
                                        <td><?=$this->getDateSelect(0, $data[ 'get_oriented_date_year' ], $data[ 'get_oriented_date_month' ], $data[ 'get_oriented_date_day' ], 'get_oriented_date',  $this->getReadonly(false, $info['answer']['repair_parts'] != 'on'))?></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Фактична дата отримання ЗЧ:</td>
                                        <td><?=$this->getDateSelect(0, $data[ 'get_fact_date_year' ], $data[ 'get_fact_date_month' ], $data[ 'get_fact_date_day' ], 'get_fact_date',  $this->getReadonly(false, $info['answer']['repair_parts'] != 'on'))?></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Дата запрошення:</td>
                                        <td><?=$this->getDateSelect(0, $data[ 'call_date_year' ], $data[ 'call_date_month' ], $data[ 'call_date_day' ], 'call_date',  $this->getReadonly(false))?></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Планова дата заїзду:</td>
                                        <td><?=$this->getDateSelect(0, $data[ 'check_oriented_date_year' ], $data[ 'check_oriented_date_month' ], $data[ 'check_oriented_date_day' ], 'check_oriented_date',  $this->getReadonly(true))?></td>
                                    </tr>
                                    <tr>
                                        <td class="label">ТЗ на території СТО:</td>
                                        <td><input type="checkbox" name="sto" value="1" <?=(intval($data['sto']) ? 'checked' : ' ')?> <?=$this->getReadonly(true)?> /></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Дата відкриття наряд-замовлення:</td>
                                        <td><?=$this->getDateSelect(0, $data[ 'order_equipment_open_date_year' ], $data[ 'order_equipment_open_date_month' ], $data[ 'order_equipment_open_date_day' ], 'order_equipment_open_date',  $this->getReadonly(true))?></td>
                                    </tr>                               
                                    <tr>
                                        <td class="label">Ремонт:</td>
                                        <td>
                                            <table>
                                            <tr>
                                                <td>початок</td>
                                                <td><?=$this->getDateSelect(0, $data[ 'repair_begin_date_year' ], $data[ 'repair_begin_date_month' ], $data[ 'repair_begin_date_day' ], 'repair_begin_date',  $this->getReadonly(true))?></td>
                                                <td>&nbsp;</td>
                                                <td>закінчення</td>
                                                <td><?=$this->getDateSelect(0, $data[ 'repair_end_date_year' ], $data[ 'repair_end_date_month' ], $data[ 'repair_end_date_day' ], 'repair_end_date',  $this->getReadonly(true))?></td>
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">Акти виконаних робіт:</td>
                                        <td><? if($action != 'view') { ?><a id="avr_add"><img src="/images/administration/navigation/add_over.gif" alt="Додати" width="19" height="19"></a><? } ?></td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td colspan="3">
                                            <table id="avr_list">
                                                <?
                                                    if (is_array($data['avr']) && sizeOf($data['avr'])) {
                                                        foreach ($data['avr'] as $key => $avr) {
                                                                  
                                                            $script = "<script>
                                                                            var table = $('#avr_list');
                                                                            var tr = $('<tr />');
                                                                            var td = $('<td />');
                                                                            var begin_date = $('<input />').attr({'name': 'avr[" . $key . "][begin_date]', 'id': 'avr[" . $key . "][begin_date]', 'type': 'text', 'value': '" . $avr['begin_date'] . "'});
                                                                            var end_date = $('<input />').attr({'name': 'avr[" . $key . "][end_date]', 'id': 'avr[" . $key . "][end_date]', 'type': 'text', 'value': '" . $avr['end_date'] . "'});
                                                                            var number = $('<input />').attr({'name': 'avr[" . $key . "][number]', 'type': 'text', 'class': 'fldText', 'value': '" . $avr['number'] . "'});
                                                                            var amount = $('<input />').attr({'name': 'avr[" . $key . "][amount]', 'type': 'text', 'class': 'fldMoney', 'value': '" . $avr['amount'] . "'});
    
                                                                            var checked = $('<input />').attr({'name': 'avr[" . $key . "][checked]', 'type': 'checkbox', 'class': 'fldBoolean', 'value' : '1' " . (intval($avr["checked"]) ? ", 'checked' : 'checked'" : "") . "});
                                                                            
                                                                            var remove = $('<a><img src=\"/images/administration/navigation/delete_over.gif\" width=\"19\" height=\"19\" alt=\"Вилучити\" /></a>');

                                                                            var tdBeginDate = td.clone().append(begin_date);
                                                                            var tdEndDate = td.clone().append(end_date);

                                                                            var tdNumber = td.clone().append(number);
                                                                            var tdAmount = td.clone().append(amount);
                                                                            var tdRemove = td.clone().append(remove);
                                                                            
                                                                            var tdChecked = td.clone().append(checked);
                                                                            
                                                                            tr.append('<td class=\"label\">Дата відкриття:</td>');
                                                                            tr.append(tdBeginDate);
                                                                            tr.append('<td class=\"label\" style=\"width: 100px;\">Дата закриття:</td>');
                                                                            tr.append(tdEndDate);
                                                                            tr.append('<td class=\"label\" style=\"width: 70px;\">Номер:</td>');
                                                                            tr.append(tdNumber);
                                                                            tr.append('<td class=\"label\" style=\"width: 60px;\">Сума:</td>');
                                                                            tr.append(tdAmount);
                                                                            tr.append('<td class=\"label\" style=\"width: 60px;\">Перевірено:</td>');
                                                                            tr.append(tdChecked);
                                                                            tr.append('<td><textarea name=\"avr[" . $key . "][avr_comment]\" rows=\"3\" cols=\"50\" " . $this->getReadonly(true) . " >" . $avr['avr_comment'] . "</textarea></td>');" .

                                                                            ($action != "view" ? 
                                                                                "$(begin_date).datePicker({'startDate' : '01/01/2015'});
                                                                                 $(end_date).datePicker({'startDate' : '01/01/2015'});
                                                                                 tr.append(tdRemove);" : 
                                                                                "$(begin_date).attr({'disabled': true}).css({'background-color': '#dddddd'});
                                                                                 $(end_date).attr({'disabled': true}).css({'background-color': '#dddddd'});
                                                                                 $(number).attr({'disabled': true}).css({'background-color': '#dddddd'});
                                                                                 $(amount).attr({'disabled': true}).css({'background-color': '#dddddd'});
                                                                                 $(checked).attr({'disabled': true}).css({'background-color': '#dddddd'});
                                                                                 ") .
                                                                            (!$this->checkPermissionsBooleanResult("avrCheck", "RecoveryRepairs") ?
                                                                                "$(checked).attr({'disabled': true}).css({'background-color': '#dddddd'});$('textarea[name*=avr_comment]').attr({'disabled': true});" :
                                                                                "") .
                                                                            
                                                                            "
                                                                            table.append(tr);
                                                                            $(remove).click(function(){
                                                                                $(this).parent().parent().remove();
                                                                            });
                                                                       </script>";
                                                            echo $script;
                                                        }
                                                    }
                                                ?>
                                            </table>
                                            <script>
                                                $('input[name*=date]').bind('keyup', function(e){
                                                    var key = e.which ? e.which : event.keyCode;
                                                     if(key == 110 || key == 188) {
                                                        e.preventDefault();
                                                        var value = $(this).val();
                                                        $(this).val(value.replace(",", "."));
                                                    }
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td class="label">Статус:</td>
                                        <td>
                                            <select name="statuses_id" disabled="" >
                                                <option value="0">...</option>
                                                <? foreach ($this->statuses as $status) { ?>
                                                    <? if ($status['id'] == 2 && $info["answer"]['repair_parts'] != 'on') continue; ?>
                                                    <option value="<?=$status['id']?>" <?=($data['statuses_id'] == $status['id'] ? 'selected' : '')?> ><?=$status['title']?></option>
                                                <? } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <? if ($action != 'view') { ?>
                                            <td align="center" colspan="3"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                        <? } else { ?>
                                            <td align="center" colspan="3"><input onclick="location='index.php?do=Accidents|show&show=recovery'" type="button" value=" <?=translate('Back')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                        <? } ?>
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
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>