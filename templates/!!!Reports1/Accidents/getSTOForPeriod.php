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
                    <input type="hidden" name="do" value="<?=$this->object?>|getSTOForPeriod" />
					<input type="hidden" name="InWindow" value="true" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
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