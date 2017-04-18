<? $Log->showSystem(); ?>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Прийняття компромісного рішення:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getCompromises" />
                    <input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
                    <input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                        <td width="10"></td>
                                        <td class="description" valign="bottom"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="125" height="1" alt="" /></div></div></td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="5">
                                                <tr>
                                                    <?if(in_array(44, $Authorization->data['account_groups_id']) || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR){?>
                                                        <td><b>Реєстр</b></td>
                                                        <td>
                                                            <select name="register" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                                <option value="1" <?=(($data['register'] == 1) ? 'selected' : '')?>>для Ассістант</option>
                                                                <option value="2" <?=(($data['register'] == 2) ? 'selected' : '')?>>повний по компромісу</option>
                                                            </select>
                                                        </td>
                                                    <?}?>
                                                    <td><b>Дата переведення в статус "погодження КР":</b></td>
                                                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                                                    <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
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
                            <?if(sizeof($list)) {?>
                                <table width="100%" cellpadding="0" cellspacing="0" border="1">
                                    <tr class="columns">
                                        <td>Номер справи</td>
                                        <?if($data['register']==2){?><td>Номер договору</td><?}?>
                                        <td>Дата договору</td>
                                        <td>Марка/модель</td>
                                        <?if($data['register']==2){?>
                                            <td>Страхувальник</td>
                                            <td>Державний номер</td>
                                            <td>Номер кузова</td>
                                            <td>СТО</td>
                                        <?}?>
                                        <td>Дата події</td>
                                        <td>Сума платежу</td>
                                        <td>Орієнтований збиток</td>
                                        <td>Франшиза</td>
                                        <td>Попередні події по договору</td>
                                        <td>Сума виплачених відшкодувань по попередніх справах по договору</td>
                                        <td>Попередні договори по авто</td>
                                        <td>Сума платежів по попередніх договорах по авто</td>
                                        <td>Сума виплачених відшкодувань по попередніх договорах по авто</td>
                                        <?if($data['register']==2){?>
                                            <td>Інші договори по клієнту</td>
                                            <td>Сума платежиів по інших договорах по клієнту</td>
                                            <td>Сума виплачених відшкодувань по інших договорах по клієнту</td>
                                            <td>Випадок</td>
                                            <td>Дата прийняття компромісного рішення</td>
                                            <td>Дата відмови</td>
                                            <td>Дата сплати</td>
                                            <td>Відшкодування</td>
                                            <td>Отримувач</td>
                                        <?}?>
                                        <td>Опис події, що відбулась</td>
                                        <td>Умови договору, що порушені</td>
                                        <td>Коментар</td>
                                    </tr>
                                    <?
                                        $color = 0;
                                        foreach($list as $row) {
                                        $color = 1 - $color;
                                        echo '<tr class="' . $this->getRowClass($row, $color) . '">';
                                            echo '<td>' . $row['accidents_number'] . '</td>';
                                            if($data['register']==2){ echo '<td>' . $row['policies_number'] . '</td>';}
                                            echo '<td>' . $row['policies_date'] . '</td>';
                                            echo '<td>' . $row['items'] . '</td>';
                                            if($data['register']==2){
                                                echo '<td>' . $row['insurer'] . '</td>';
                                                if($row['sign'] != ''){ echo '<td>' . $row['sign'] . '</td>';} else {echo '<td>-</td>';};
                                                echo '<td>' . $row['shassi'] . '</td>';
                                                echo '<td>' . $row['car_services_title'] . '</td>';
                                            }
                                            echo '<td>' . $row['accidents_datetime'] . '</td>';
                                            echo '<td>' . getRateFormat($row['compensations'], 2) . '</td>';
                                            echo '<td>' . getRateFormat($row['amount_rough'], 2) . '</td>';
                                            echo '<td>' . getRateFormat($row['deductibles_amount'], 2) . '</td>';
                                            if($row['policies_previous_accidents_list'] != ''){ echo '<td>' . $row['policies_previous_accidents_list'] . '</td>';} else {echo '<td>Немає</td>';};
                                            if($row['policies_previous_accidents_amount'] != ''){ echo '<td>' . getRateFormat($row['policies_previous_accidents_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                                            if($row['previous_policies_item_list'] != ''){ echo '<td>' . $row['previous_policies_item_list'] . '</td>';} else {echo '<td>Немає</td>';};
                                            if($row['previous_policies_item_amount'] != ''){ echo '<td>' . getRateFormat($row['previous_policies_item_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                                            if($row['previous_policies_item_accidents_amount'] != ''){ echo '<td>' . getRateFormat($row['previous_policies_item_accidents_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                                            if($data['register']==2){
                                                if($row['all_policies_insurer_list'] != ''){ echo '<td>' . $row['all_policies_insurer_list'] . '</td>';} else {echo '<td>Немає</td>';};
                                                if($row['all_policies_insurer_amount'] != ''){ echo '<td>' . getRateFormat($row['all_policies_insurer_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                                                if($row['all_policies_insurer_accidents_amount'] != ''){ echo '<td>' . getRateFormat($row['all_policies_insurer_accidents_amount'], 2) . '</td>';} else {echo '<td>0,00</td>';};
                                                if($row['insurance'] == 1){ echo '<td>сплатити</td>';} elseif($row['insurance'] == 2){echo '<td>без виплати</td>';} elseif($row['insurance'] == 3){echo '<td>відмова</td>';}else {echo '<td>-</td>';};
                                                if($row['compromise_date'] != '00.00.0000'){ echo '<td>' . $row['compromise_date'] . '</td>';} else {echo '<td>-</td>';};
                                                if($row['date_no'] != '00.00.0000' && $row['date_no'] != ''){ echo '<td>' . $row['date_no'] . '</td>';} else {echo '<td>-</td>';};
                                                if($row['payment_date'] != '00.00.0000'  && $row['payment_date']!= ''){ echo '<td>' . $row['payment_date'] . '</td>';} else {echo '<td>-</td>';};
                                                if($row['payment_amount'] != ''){ echo '<td>' . $row['payment_amount'] . '</td>';} else {echo '<td>-</td>';};
                                                if($row['recipient'] != ''){ echo '<td>' . $row['recipient'] . '</td>';} else {echo '<td>-</td>';};

                                            }
                                            if($row['description'] != ''){ echo '<td>' . $row['description']. '</td>';} else {echo '<td>-</td>';};
                                            if($row['compromises_title'] != ''){ echo '<td>' . $row['compromises_title'] . '</td>';} else {echo '<td>-</td>';};
                                            if($row['compromise_comment'] != ''){ echo '<td>' . $row['compromise_comment']. '</td>';} else {echo '<td>-</td>';};
                                        echo '</tr>';
                                        }?>
                                    <tr class="navigation">
                                        <td class="paging" colspan="28">Всього: <?=(sizeof($list))?></td>
                                    </tr>
                                </table>
                            <?}?>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getCompromisesInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>
<div style="color: white;"><?=$time?></div>