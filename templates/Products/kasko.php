 
<script type="text/javascript">
    num = -1;
    function addDeductible(obj) {
        var row			= document.getElementById('deductibles').insertRow(-1);

		var cell		= row.insertCell(0);
        cell.innerHTML	= '<select name="deductibles[' + num + '][car_types_id]" value="" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';" /><?foreach ($data['car_types'] as $j=>$car_type) {echo '<option value="'.$j.'">'.$car_type.'</option>';}?> </select>';

		cell		= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="deductibles[' + num + '][value0]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' + num + '][absolute0]" value="0" />% <input type="radio" name="deductibles[' + num + '][absolute0]" value="1" /> грн.';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="deductibles[' + num + '][value1]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' + num + '][absolute1]" value="0" />% <input type="radio" name="deductibles[' + num + '][absolute1]" value="1" /> грн.';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="deductibles[' + num + '][value_other]" value="" maxlength="10" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="deductibles[' + num + '][value_hijacking]" value="" maxlength="10" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteDeductible(this)" />';

        num--;
    }

    function deleteDeductible(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибранний набір франшиз?')) {
            document.getElementById('deductibles').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );
        }
    }

	numspecial = -1;
    function addSpecialCar(obj) {
        var row			= document.getElementById('specialcars').insertRow(-1);

		var cell		= row.insertCell(0);
        cell.innerHTML	= '<select name="special_cars[' + numspecial + '][brands_id]" value="" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';" /><?foreach ($data['car_brands'] as $j => $car_brand) {echo '<option value="' . $j . '">' . $car_brand . '</option>';}?> </select>';

		cell		= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="special_cars[' + numspecial + '][value]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteSpecialCar(this)" />';

        numspecial--;
    }
	
	function deleteSpecialCar(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибранний тип авто?')) {
            document.getElementById('specialcars').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );
        }
    }
</script>
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
                    <tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
                    <tr>
                        <td>
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? 'index.php?do=ProductTypes|view&id='.$data['product_types_id'].'&title='.$_POST['filtertitle'] : $data['redirect']?>">
								<? if ($action=='insert') {?>
									<input type="hidden" name="copyprod" value="<?=$data['id']?>" />
								<?}?>

                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <?=$this->buildFieldsPart($data, $actionType);?>
                                    <? 
									if ($action == 'view') {
									 $db = $GLOBALS['db'];
									 $l=$db->getAll('SELECT b.title FROM insurance_products_related a JOIN insurance_products b on b.id=a.related_products_id WHERE a.products_id = '.intval($data['id']));
										echo '<tr>
                                        <td width="150" class="label">Продукти наступного перiоду:</td>
										<td>';
										if (is_array($l)) {
											foreach($l as $r) {
												echo '<b>'.$r['title'].'</b><br>';
											}
										}
										echo'</td>
										</tr>';
									}
                                    //if ($action != 'view') {
										echo ParametersBaseRates::getList($data, $data['product_types_id']);
                                        echo ParametersDeductibles::getList($data, $data['product_types_id']);
										echo ParametersCarPrices::getList($data, $data['product_types_id']);
										echo ParametersDriverStandings::getList($data, PRODUCT_TYPES_KASKO);
                                        echo ParametersDriverAges::getList($data, $data['product_types_id']);
                                        echo ParametersDrivers::getList($data, $data['product_types_id']);
                                        echo ParametersRegions::getList($data, PRODUCT_TYPES_AUTO);
										echo ParametersRegions::getList($data, PRODUCT_TYPES_KASKO);
										echo ParametersCarYears::getList($data, $data['product_types_id']);
										echo ParametersSpecialCars::getList($data, $data['product_types_id']);
										echo ParametersZones::getList($data, $data['product_types_id']);
                                        echo ParametersCarNumbers::getList($data, $data['product_types_id']);
										echo ParametersTerms::getList($data, $data['product_types_id']);
                                        echo ParametersPaymentBreakdowns::getList($data, $data['product_types_id']);
                                        //echo ParametersMileageCar::getList($data, $data['product_types_id']);
                                    //}
                                    ?>
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center">
                                            <?
                                            switch ($action) {
                                                case 'view':
                                                    echo '<input type="button" value=" ' . translate('Back') . ' " class="button" onclick="changeLocation(document.path, ' . (sizeOf($_SESSION['auth']['path']) - 2) . ')" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" />';
                                                    break;
                                                default:
                                                    echo '<input type="submit" value=" ' . translate('Save') . ' " class="button" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" />';
                                                    break;
                                            }
                                            ?>
                                        </td>
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