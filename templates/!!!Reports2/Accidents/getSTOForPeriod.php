<?$Log->showSystem() ?>
<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />
<script type="text/javascript">
    var institutions_information = new Array();
    var institutions_information_list = {};
    var type;


    function isChecked(obj){
        if($("#is_financial_institutions").is(":checked")){
            type = 1;
            $("#financial_institutions_id").show();
            $("#car_services_id").hide();
            $("#car_services_id").empty();
        }
        else{
            type = 2;
            $("#car_services_id").show();
            $("#financial_institutions_id").hide();
            $("#financial_institutions_id").empty();
        }
        getCitiesList();
    }

    function setRegistrationFinancialInstitutionsId() {
        $('#financial_institutions_id_hidden').val(<?=$data['financial_institutions_id']?>);

    }

    function setRegistrationCarServicesId() {
        $('#car_services_id_hidden').val(<?=$data['car_services_id']?>);

    }

    function getCitiesList() {
        $.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'script',
            data:	    'do=Reports|getFinancialInstitutionsOrCarServicesInWindow' +
                        '&institution_type=' + type,
            success: function(result) {
                institutions_information_list.results = institutions_information;
                institutions_information_list.total = institutions_information.length;
                if(type == 1){
                    $('#financial_institutions_id').flexbox(institutions_information_list, {
                        allowInput: true,
                        width: 400,
                        paging: false,
                        maxVisibleRows: 8,
                        maxCacheBytes: 0,
                        noResultsText: 'Результатів не знайдено',
                        compare: function(elem){
                                return true;
                        }
                    });
                    setRegistrationFinancialInstitutionsId();
                    $('#financial_institutions_id_input').val($('input[name=financial_institutions_title]').val());

                }
                else{
                    $('#car_services_id').flexbox(institutions_information_list, {
                        allowInput: true,
                        width: 400,
                        paging: false,
                        maxVisibleRows: 8,
                        maxCacheBytes: 0,
                        noResultsText: 'Результатів не знайдено',
                        compare: function(elem){
                                return true;
                        }
                    });
                    setRegistrationCarServicesId();
                    $('#car_services_id_input').val($('input[name=car_services_title]').val());

                }
            }

        });
   }

   $(document).ready(function() {
        if($("#is_financial_institutions").is(":checked")){
            type = 1;
            $("#financial_institutions_id").show();
            $("#car_services_id").hide();
        }
        else{
            type = 2;
            $("#financial_institutions_id").hide();
            $("#car_services_id").show();
        }
    });

</script>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                    $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                    echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption">Звіт по СТО/Банках за період:</td>
        </tr>
        <tr>
            <td></td>
            <td align="right">
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Reports|getSTOForPeriod" />

                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <?='<td width="22" valign="bottom"><a href="javascript:var b = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (b) b.click();" onMouseOver="var over = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (over) over.over(); return true;" onMouseOut="var out = MM_getButtonWithName(document.'.$this->objectTitle.', \''.$this->objectTitle.'Action0\'); if (out) out.out(); return true;"><img height="19" width="19" name="'.$this->objectTitle.'Action0" src="/images/administration/navigation/export.gif" alt="' . translate('Export') . '" /></a></td>'?>
                                <td valign="bottom" class="description"><div id="<?=$this->objectTitle?>Description"><div id="<?=$this->objectTitle?>DescriptionNN"><img src="/images/pixel.gif" width="350" height="1" alt="" /></div></div></td>
                            </td>
                            <td align="right">
                                <table>
                                    <tr>
                                        <td><b>Звіт по банках:</b><input type="checkbox" id="is_financial_institutions" name="is_financial_institutions" onclick="isChecked(<?=$this->objectTitle?>);" <?=(!empty($data['is_financial_institutions']) ? 'checked' : '') ?> ></td>
                                        <td><div id="financial_institutions_id"></div></td>
                                        <td><div id="car_services_id"></div></td>
                                        <input type="hidden" name="financial_institutions_title" value="<?=$data['financial_institutions_title']?>" />
                                        <input type="hidden" name="car_services_title" value="<?=$data['car_services_title']?>" />
                                        <td><b>Місяць :</b></td>
                                        <td>
                                            <select name="month[]" size="6" class="fldSelect" multiple="" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                                <option value="1" <?=(in_array(1, $data['month']) ? 'selected' : '')?>>Січень</option>
                                                <option value="2" <?=(in_array(2, $data['month']) ? 'selected' : '')?>>Лютий</option>
                                                <option value="3" <?=(in_array(3, $data['month']) ? 'selected' : '')?>>Березень</option>
                                                <option value="4" <?=(in_array(4, $data['month']) ? 'selected' : '')?>>Квітень</option>
                                                <option value="5" <?=(in_array(5, $data['month']) ? 'selected' : '')?>>Травень</option>
                                                <option value="6" <?=(in_array(6, $data['month']) ? 'selected' : '')?>>Червень</option>
                                                <option value="7" <?=(in_array(7, $data['month']) ? 'selected' : '')?>>Липень</option>
                                                <option value="8" <?=(in_array(8, $data['month']) ? 'selected' : '')?>>Серпень</option>
                                                <option value="9" <?=(in_array(9, $data['month']) ? 'selected' : '')?>>Вересень</option>
                                                <option value="10" <?=(in_array(10, $data['month']) ? 'selected' : '')?>>Жовтень</option>
                                                <option value="11" <?=(in_array(11, $data['month']) ? 'selected' : '')?>>Листопад</option>
                                                <option value="12" <?=(in_array(12, $data['month']) ? 'selected' : '')?>>Грудень</option>
                                            </select>
                                        </td>
                                        <td><b>Рік :</b></td>
                                        <td>
                                            <?
                                            echo '<select name="year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                            $year = date("Y");
                                                for ($i=2010; $i<=$year; $i++){
                                                    if ($i == $data['year']) echo"<option value = $i selected>".$i."</option>"; 
                                                    else
                                                    echo "<option value = $i>".$i."</option>";}
                                            ?>
                                            </select>
                                        </td>
                                       <td>&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr><td height="4" bgcolor="#D6D6D6" colspan="4"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                        <tr>
                            <td colspan="4">
                                <? if (sizeOf($list)) {?>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                                        <tr class="columns">
                                            <td>№ справи</td>
                                            <td>Страхувальник</td>
                                            <td>Об'єкт</td>
                                            <td>Vin</td>
                                            <?if(isset($data['is_financial_institutions'])){?><td>Сума об'єкту страхування<?}?>
                                            <?if(isset($data['is_financial_institutions'])){?><td>Страховий випадок <?}?>
                                            <?if(isset($data['is_financial_institutions'])){?><td>Дата події<?}?>
                                            <?if(!isset($data['is_financial_institutions'])){?><td>Франшиза</td><?}?>
                                            <td>Дата заяви</td>
                                            <?if(isset($data['is_financial_institutions'])){?><td>Сума збитку, заявлена страхувальником , грн.<?}?>
                                            <?if(isset($data['is_financial_institutions'])){?><td>Сума збитку, згідно з висновком СК<?}?>
                                            <?if(isset($data['is_financial_institutions'])){?><td>СК прийнято рішення про виплату:<?}?>
                                            <?if(isset($data['is_financial_institutions'])){?><td>Кошти фактично виплачені <?}?>
                                            <?if(isset($data['is_financial_institutions'])){?><td>ПІБ куратора <?}?>
                                             <?if(!isset($data['is_financial_institutions'])){?><td>Статус справи</td><?}?>
                                            <td>Фактично сплачено</td>
                                             <?if(!isset($data['is_financial_institutions'])){?><td>Призначення платежу</td><?}?>
                                        </tr>
                                        <?
                                            $color = 0;
                                            foreach ($list as $row) {
                                                echo '<tr>';
                                                $color = 1 - $color;
                                                echo '<tr class="' . $this->getRowClass($row, $color) . '">';
                                                echo '<td>' . $row['number'] . '</td>';
                                                echo '<td>' . $row['insurer'] . '</td>';
                                                echo '<td>' . $row['item'] . '</td>';
                                                if($row['sign']!='') echo '<td>' . $row['sign'] .  '</td>'; else echo '<td>-</td>';
                                                 if(isset($data['is_financial_institutions'])){echo '<td>' . getRateFormat($row['policies_price'], 2) . '</td>';}
                                                 if(isset($data['is_financial_institutions'])){echo '<td>' . $row['risk_title'] . '</td>';}
                                                 if(isset($data['is_financial_institutions'])){echo '<td>' . $row['datetime'] . '</td>';}
                                                if(!isset($data['is_financial_institutions'])){if($row['deductibles_amount']!='') echo '<td>' . getRateFormat($row['deductibles_amount'], 2) .  '</td>'; else echo '<td>0,00</td>';}
                                                echo '<td>' . $row['date'] . '</td>';
                                                if(isset($data['is_financial_institutions'])){echo '<td>' . getRateFormat($row['amount_rough'], 2) . '</td>';}
                                                if(isset($data['is_financial_institutions'])){echo '<td>' . getRateFormat($row['amount_rough'], 2) . '</td>';}
                                                if(isset($data['is_financial_institutions'])){if($row['insurance']==1) echo '<td>Так</td>'; elseif($row['insurance']==2 || $row['insurance']==3)echo '<td>Ні</td>'; else echo '<td>--</td>';}
                                                if(isset($data['is_financial_institutions'])){echo '<td>' . $row['payment_statuses_title'] . '</td>';}
                                                if(isset($data['is_financial_institutions'])){echo '<td>Базічев Я.О.</td>';}
                                                if(!isset($data['is_financial_institutions'])){if($row['insurance']==1) $row['insurance'] = 'страховий з виплатою'; elseif($row['insurance']==2) $row['insurance'] = 'страховий без виплати'; else $row['insurance'] = 'не страховий'; echo '<td>' . $row['status'] . ', ' . $row['insurance'] . '</td>';}
                                                if($row['amount']!='') echo '<td>' . $row['amount'] .  '</td>'; else echo '<td>0,00</td>';
                                                if(!isset($data['is_financial_institutions'])){if($row['assignment_payments']!='') echo '<td>' . $row['assignment_payments'] .  '</td>'; else echo '<td>-</td>';}
                                                echo '</tr>';
                                            }
                                        ?>
                                        <tr class="navigation">
                                            <td class="paging" colspan="14">Всього: <?=(sizeof($list))?></td>
                                        </tr>
                                    </table>
                                <?}?>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    document.<?=$this->objectTitle?>.buttons = new Array();
                    <?='document.'.$this->objectTitle.'.buttons[document.'.$this->objectTitle.'.buttons.length] = new MMCommandButton(\''.$this->objectTitle.'Action0\', document.'.$this->objectTitle.', \''.$this->object.'|getSTOForPeriodInWindow\', \'/images/administration/navigation/export.gif\', \'/images/administration/navigation/export_over.gif\', \'\', \'/images/administration/navigation/export_dim.gif\', true, true, true, true, \'' . translate('Export') . '\', false, \'\');'?>
                    document.<?=$this->objectTitle?>.actionDescription = '<?=$this->objectTitle?>Description';
                    MM_toggleItem(document.<?=$this->objectTitle?>, 'id[]');
                </script>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">

	$(document).ready(function() {
        getCitiesList();

	});

</script>