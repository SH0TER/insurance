<script type="text/javascript">
    var num2 = -1;

    function addRate() {
        var row	= document.getElementById('rates').insertRow(-1);
        row.style.background = (document.getElementById('rates').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

        var cell = row.insertCell(0);
        cell.innerHTML	= '<select name="rates[' + num2 + '][item_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'"><option value="1">Автомобільні запчастини, масла, аксесуари</option><option value="2">Автомобілі</option><option value="3">Запчастини для автомобілів T-150</option><option value="3">Автомобільні запчастини</option><option value="4">Машинокомплекти</option></select>';
        cell.style.borderBottom = 'solid 1px #EBEBEB';

        cell		= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="rates[' + num2 + '][days]" value="" maxlength="5" class="fldInteger" onfocus="this.className=\'fldIntegerOver\';" onblur="this.className=\'fldInteger\';" />';
        cell.style.borderBottom = 'solid 1px #EBEBEB';

        cell		= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="rates[' + num2 + '][rate]" value="" maxlength="6" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />';
        cell.style.borderBottom = 'solid 1px #EBEBEB';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити тариф" onclick="deleteRate(this)" />';
        cell.style.borderBottom = 'solid 1px #EBEBEB';

        num2--;
    }

    function deleteRate(obj) {
        if (confirm('Ви дійсно бажаєте вилучити тариф?')) {
            document.getElementById('rates').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            for(i=0; i<document.getElementById('rates').rows.length; i++) {
                document.getElementById('rates').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
            }
        }
    }

    function showHideDeductibles() {
        showHideBlock('deductibles');
    }

    function showHideRates() {
        showHideBlock('rates');
    }
</script>
<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" id="clients_id" name="clients_id" value="<?=$data['clients_id']?>" />
    <input type="hidden" id="person_types_id" name="person_types_id" value="2" />
    <table cellpadding="2" cellspacing="3" width="100%">
        <tr>
            <td>
                <div class="section">Страхувальник:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Прізвище:</td>
                        <td><input type="text" name="lastname" value="<?=$data['lastname']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Ім'я:</td>
                        <td><input type="text" name="firstname" value="<?=$data['firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>По батькові:</td>
                        <td><input type="text" name="patronymicname" value="<?=$data['patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Посада:</td>
                        <td><input type="text" name="position" value="<?=$data['position']?>" maxlength="100" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Діє на підставі:</td>
                        <td><input type="text" name="ground" value="<?=$data['ground']?>" maxlength="250" class="fldText ground" onfocus="this.className='fldTextOver ground'" onblur="this.className='fldText ground'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

				<b>Англійська:</b>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Прізвище:</td>
                        <td><input type="text" name="lastname_en" value="<?=$data['lastname_en']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey">Ім'я:</td>
                        <td><input type="text" name="firstname_en" value="<?=$data['firstname_en']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey">По батькові:</td>
                        <td><input type="text" name="patronymicname_en" value="<?=$data['patronymicname_en']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Посада:</td>
                        <td><input type="text" name="position_en" value="<?=$data['position_en']?>" maxlength="100" class="fldText position" onfocus="this.className='fldTextOver position'" onblur="this.className='fldText position'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey">Діє на підставі:</td>
                        <td><input type="text" name="ground_en" value="<?=$data['ground_en']?>" maxlength="250" class="fldText ground" onfocus="this.className='fldTextOver ground'" onblur="this.className='fldText ground'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

                <div class="section">Вигодонабувач:</div>
                <table width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Вигодонабувач:</td>
                        <td width="100%"><input type="text" name="assured" value="<?=$data['assured']?>" maxlength="150" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

				<b>Англійська:</b>
                <table width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Вигодонабувач:</td>
                        <td width="100%"><input type="text" name="assured_en" value="<?=$data['assured_en']?>" maxlength="150" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>

                <div class="section">Ризики:</div>
                <?=ParametersRisks::getListPolicy(PRODUCT_TYPES_CARGO, $data, $this->getReadonly(true), 'vertical')?>

                <div class="section">
                    <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="section" style="border: none; padding-bottom: 10px;">Франшизи:</td>
                            <?
                            switch ($this->mode) {
                                case 'view':
                                    echo '<td><a href="javascript: showHideDeductibles()"><img id="button" src="/images/administration/navigation/details_over.gif" width="19" height="19" alt="Показати/зховати" alt="Показати/зховати" /></a></td><td><a href="javascript: showHideDeductibles()">показати/cховати франшизи</a></td>';
                                    break;
                            }
                            ?>
                        </tr>
                    </table>
                </div>

                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table id="deductibles" style="border: 1px solid rgb(0, 0, 0); display: <?=($this->mode == 'update') ? 'block' : 'none'?>" cellpadding="5" cellspacing="0">
                                <tr class="columns">
                                    <td>Вантаж</td>
                                    <td>Розмір</td>
                                </tr>
                                <tr style="background: #FFFFFF">
                                    <td><input type="hidden" name="deductibles[0][item_types_id]" value="1" /> автомобільні запчастини, масла, аксесуари</td>
                                    <td>
                                        <input type="text" name="deductibles[0][value]" value="<?=$data['deductibles'][ 0 ]['value']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false)?> />
                                        <input type="radio" name="deductibles[0][absolute]" value="0" <?=(!intval($data['deductibles'][ 0 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />%
                                        <input type="radio" name="deductibles[0][absolute]" value="1" <?=(intval($data['deductibles'][ 0 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> грн.
                                    </td>
                                </tr>
                                <tr style="background: #F0F0F0">
                                    <td><input type="hidden" name="deductibles[2][item_types_id]" value="3" /> запчастини для автомобілів T-150</td>
                                    <td>
                                        <input type="text" name="deductibles[2][value]" value="<?=$data['deductibles'][ 2 ]['value']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false)?> />
                                        <input type="radio" name="deductibles[2][absolute]" value="0" <?=(!intval($data['deductibles'][ 2 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />%
                                        <input type="radio" name="deductibles[2][absolute]" value="1" <?=(intval($data['deductibles'][ 2 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> грн.
                                    </td>
                                </tr>
                                <tr style="background: #FFFFFF">
                                    <td><input type="hidden" name="deductibles[1][item_types_id]" value="2" /> автомобіль</td>
                                    <td>
                                        <input type="text" name="deductibles[1][value]" value="<?=$data['deductibles'][ 1 ]['value']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false)?> />
                                        <input type="radio" name="deductibles[1][absolute]" value="0" <?=(!intval($data['deductibles'][ 1 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />%
                                        <input type="radio" name="deductibles[1][absolute]" value="1" <?=(intval($data['deductibles'][ 1 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> грн.
                                    </td>
                                </tr>
								<tr style="background: #FFFFFF">
                                    <td><input type="hidden" name="deductibles[3][item_types_id]" value="4" /> автомобільні запчастини</td>
                                    <td>
                                        <input type="text" name="deductibles[3][value]" value="<?=$data['deductibles'][ 3 ]['value']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false)?> />
                                        <input type="radio" name="deductibles[3][absolute]" value="0" <?=(!intval($data['deductibles'][ 3 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />%
                                        <input type="radio" name="deductibles[3][absolute]" value="1" <?=(intval($data['deductibles'][ 3 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> грн.
                                    </td>
                                </tr>
								
								<tr style="background: #FFFFFF">
                                    <td><input type="hidden" name="deductibles[4][item_types_id]" value="5" /> машинокомплекти</td>
                                    <td>
                                        <input type="text" name="deductibles[4][value]" value="<?=$data['deductibles'][ 4 ]['value']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" <?=$this->getReadonly(false)?> />
                                        <input type="radio" name="deductibles[4][absolute]" value="0" <?=(!intval($data['deductibles'][ 4 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> />%
                                        <input type="radio" name="deductibles[4][absolute]" value="1" <?=(intval($data['deductibles'][ 4 ]['absolute'])) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> грн.
                                    </td>
                                </tr>
							</table>
						</td>
					</tr>
				</table>

                <div class="section">
                    <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="section" style="border: none; padding-bottom: 10px;">Тариф:</td>
                            <?
                            switch ($this->mode) {
                                case 'update':
                                    echo '<td><a href="javascript: addRate()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати тариф" /></a></td><td><a href="javascript: addRate()">додати тариф</a></td>';
                                    break;
                                case 'view':
                                    echo '<td><a href="javascript: showHideRates()"><img id="button" src="/images/administration/navigation/details_over.gif" width="19" height="19" alt="Показати/зховати" alt="Показати/зховати" /></a></td><td><a href="javascript: showHideRates()">показати/cховати тарифи</a></td>';
                                    break;
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <table id="rates" style="border: 1px solid rgb(0, 0, 0); display: <?=($this->mode == 'update') ? 'block' : 'none'?>" cellpadding="5" cellspacing="0">
                    <tr class="columns">
                        <td>Вантаж</td>
                        <td>Термін, дні</td>
                        <td>Тариф</td>
                        <? if ($this->mode == 'update') { ?><td>&nbsp;</td><? } ?>
                    </tr>
                    <?
                    $i = 0;
                    if (is_array($data['rates'])) {
                        foreach ($data['rates'] as $i => $row) {
                    ?>
                    <tr style="background: <?=($i % 2 != 1) ? '#FFFFFF' : '#F0F0F0'?>">
                        <td>
                            <select name="rates[<?=$i?>][item_types_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
                                <option value="1" <?=($data['rates'][ $i ]['item_types_id'] == 1) ? 'selected' : ''?>>автомобільні запчастини, масла, аксесуари</option>
								<option value="3" <?=($data['rates'][ $i ]['item_types_id'] == 3) ? 'selected' : ''?>>запчастини для автомобілів T-150</option>
                                <option value="2" <?=($data['rates'][ $i ]['item_types_id'] == 2) ? 'selected' : ''?>>автомобілі</option>
								<option value="4" <?=($data['rates'][ $i ]['item_types_id'] == 4) ? 'selected' : ''?>>автомобільні запчастини</option>
								<option value="5" <?=($data['rates'][ $i ]['item_types_id'] == 5) ? 'selected' : ''?>>машинокомплекти</option>
                            </select>
                        </td>
                        <td><input type="text" name="rates[<?=$i?>][days]" value="<?=$data['rates'][ $i ]['days']?>" maxlength="5" class="fldInteger" onfocus="this.className='fldIntegerOver';" onblur="this.className='fldInteger';" <?=$this->getReadonly(false)?> /></td>
                        <td><input type="text" name="rates[<?=$i?>][rate]" value="<?=$data['rates'][ $i ]['rate']?>" maxlength="6" class="fldPercent" onfocus="this.className='fldPercentOver';" onblur="this.className='fldPercent';" <?=$this->getReadonly(false)?> /></td>
                        <? if ($this->mode == 'update') { ?><td><a href="#" onclick="deleteRate(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити тариф" /></a></td><? } ?>
                    </tr>
                        <?
                        }
                    }
                    ?>
                </table>

                <div class="section">Умови страхування:</div>
                <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey"><?=$this->getMark()?>Вид транспортування:</td>
                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('delivery_ways_id') ], $data['delivery_ways_id' ], $data['languageCode'], 'multiple size="3" ' . $this->getReadonly(true), 'double', $data)?></td>
                    <td class="label grey"><?=$this->getMark()?>Умови поставки:</td>
                    <td><input type="text" name="shipping" value="<?=$data['shipping']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>Метод оцінки страхової суми:</td>
                    <td><input type="text" name="method" value="<?=$data['method']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey"><?=$this->getMark()?>Страхова сума на 1 перевезення, %:</td>
                    <td><input type="text" name="price_percent" value="<?=$data['price_percent']?>" maxlength="6" class="fldPercent" onfocus="this.className='fldPercent'" onblur="this.className='fldPercent'" <?=$this->getReadonly(false)?> /></td>
                </tr>
                </table>
				<b>Англійська:</b>
                <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="label grey">Умови поставки:</td>
                    <td><input type="text" name="shipping_en" value="<?=$data['shipping_en']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
                    <td class="label grey">Метод оцінки страхової суми:</td>
                    <td><input type="text" name="method_en" value="<?=$data['method_en']?>" maxlength="50" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
                </tr>
                </table>

                <div class="section">Параметри договору страхування:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Номер:</td>
                        <td><input type="text" id="number" name="number" value="<?=$data['number']?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Дата заключення:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', '  ' . $this->getReadonly(true))?></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Дата початку дії:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', $this->getReadonly(true))?></td>
                        <td class="label grey"><?=$this->getMark()?>Дата закінчення дії:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', $this->getReadonly(true))?></td>
                    </tr>
                </table>
				<? if ($action == 'insert') { ?>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Оплата за кожен серфтифікат окремо:</td>
                        <td><input type="checkbox" name="payment_types_id" value="1" <?=($data['payment_types_id'] == 1) ? 'checked' : ''?> /></td>
                    </tr>
                </table>
				<? } ?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
<? if ($data['do'] == $this->object . '|add') echo 'addRate();';?>
    initFocus(document.<?=$this->objectTitle?>);
</script>