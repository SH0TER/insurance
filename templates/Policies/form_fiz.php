<script type="text/javascript">
    var num1 = <?=intval(sizeof($data['items']))==0 ? '-1' : '-'.(intval(sizeof($data['items']))+1)?>;

    function calculateRate() {
        var risks = '';

        $('input[type=checkbox][name^=risks_id]:checked').each(function () {
            risks += '&risks[]='+$(this).val();
        });

		alert(risks);

        var params = '';
        for (var i=1;i<=8;i++) {
            elemId = 'values_id' + i;
            $('#values_id' + i + ' option:selected').each(function () {
                params += '&params[]='+$(this).val();
            });
        }

        $('select[name$=[title]]').each(function(index, value) {

            var row_idx = $('#'+value.id).attr('idx');
            var row_price = parseFloat($('#items' + row_idx + 'price').val());
            var row_deductible = parseFloat($('#items' + row_idx + 'value').val());
            var row_title = $('#items' + row_idx + 'title').val();

			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				data:		'do=Products|getRateInWindow' +
							'&financial_institutions_id=' + $('input[name=financial_institutions_id]').val() +
							'&terms_id=' + $('input[name=terms_id]').val() +
							'&product_types_id=' + $('input[name=product_types_id]').val() +
							risks +params+
							'&price=' + row_price+
							'&deductible=' + row_deductible+
							'&property_group=' + row_title,
				success:	function(data) {
					$('#items' + row_idx + 'amount').val( data.amount );
					$('#items' + row_idx + 'rate').val( data.rate );
					setItemAmount(row_idx);
				}
			});
		});
    }

    function addItem() {
        var row	= document.getElementById('items').insertRow(1);
        row.style.background = (document.getElementById('items').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';
        var title=$('#objecttitle').val();
        var address=$('#object_location').val();

        var cell        = row.insertCell(-1);
        var selectTitle  = '<select idx="'+num1+'" id="items' + num1 + 'title" name="items[' + num1 + '][title]" class="fldSelect" onfocus="this.className=\'fldSelectOver \'" onblur="this.className=\'fldSelect\'">';
        selectTitle  += '    <option value="Житлове приміщення">Житлове приміщення</option>';
        selectTitle  += '    <option value="Оздоблення">Оздоблення</option>';
        selectTitle  += '    <option value="Обладнання">Обладнання</option>';
        selectTitle  += '    <option value="Рухоме майно">Рухоме майно</option>';
        selectTitle  += '    <option value="Господарські будівлі">Господарські будівлі</option>';
        selectTitle  += '</select>';
        cell.innerHTML = selectTitle;

        var cell        = row.insertCell(-1);
        cell.innerHTML  = '<input type="text" id="items' + num1 + 'cost" name="items[' + num1 + '][cost]" value="" maxlength="12" class="fldMoney total_cost" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'"  onchange="calcTotalCost()" />';

        var cell        = row.insertCell(-1);
        cell.innerHTML  = '<input type="text" id="items' + num1 + 'price" name="items[' + num1 + '][price]" value="" maxlength="12" class="fldMoney total_price" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="setItemAmount(' + num1 + ')" />';

        var cell        = row.insertCell(-1);
        var selectDeductible  = '<select id="items' + num1 + 'value" name="items[' + num1 + '][value]" class="fldSelect" onfocus="this.className=\'fldSelectOver \'" onblur="this.className=\'fldSelect\'">';
        selectDeductible  += '    <option value="1">1</option>';
        selectDeductible  += '    <option value="1.5">1.5</option>';
        selectDeductible  += '    <option value="2">2</option>';
        selectDeductible  += '</select>';
        selectDeductible  += '         <input type="hidden" name="items[' + num1 + '][absolute]" value="0"/>';
        cell.innerHTML  =selectDeductible;

        var cell        = row.insertCell(-1);
        cell.innerHTML  = '<input type="text" id="items' + num1 + 'rate" name="items[' + num1 + '][rate]" value="" maxlength="6" class="fldPercent" onfocus="this.className=\'fldPercentOver\'" onblur="this.className=\'fldPercent\'" onchange="setItemAmount(' + num1 + ')" <?=($this->subMode == 'calculate') ? 'readonly' : ''?> />';

        var cell        = row.insertCell(-1);
        cell.innerHTML  = '<input type="text" id="items' + num1 + 'amount" name="items[' + num1 + '][amount]" value="" maxlength="10" class="fldMoney total_amount" onchange="calcTotalAmount();" readonly/>';

        var cell        = row.insertCell(-1);
        cell.innerHTML  = '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteItem(this)" />';

        num1--;
    }

    function deleteItem(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибране майно?')) {
            document.getElementById('items').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            for(i=0; i<document.getElementById('items').rows.length; i++) {
                document.getElementById('items').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
            }

            setItemAmount();
        }
    }

    function setItemAmount(i) {
        var amount = number_format((parseFloat($('#items' + i + 'price').val()) * parseFloat($('#items' + i + 'rate').val()) / 100), 2, '.', '');
        if (isNaN(amount)) {
            amount = 0;
        }

        $('#items' + i + 'amount').val( amount );

        var total_price = 0;
        $('input[name$=[price]]').each(function(index,value) {
            total_price += parseFloat(value.value);
        });

        total_price = number_format(total_price, 2, ',', '');
        $('#total_price').html(total_price);

        var total_amount = 0;

        $('input[name$=[amount]]').each(function(index,value) {
            total_amount += parseFloat(value.value);
        });

        total_amount= number_format(total_amount, 2, ',', '');
        $('#total_amount').html(total_amount);
    }

    function calcTotalCost() {
        var total_cost = 0;

        $('input[name$=[cost]]').each(function(index,value) {
            total_cost += parseFloat(value.value);
        });

		total_cost = number_format(total_cost, 2, ',', '');

        $('#total_cost').html(total_cost);
    }

    function calcTotalPrice(){
        var total_price = 0;

        $('input[name$=[price]]').each(function(index,value) {
            total_price += parseFloat(value.value);
        });

        $('#total_price').html(total_price);
    }

    function calcTotalAmount(){
        var total_amount = 0;

        $('input[name$=[amount]]').each(function(index,value) {
            total_amount += parseFloat(value.value);
        });

        $('#total_amount').html(total_amount);
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
                    <input type="hidden" id="id" name="id" value="<?=$data['id']?>" />
                    <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                    <input type="hidden" name="product_types_id" value="<?=$_REQUEST['product_types_id']?>" />
                    <input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
                    <input type="hidden" name="financial_institutions_id" value="<?=intval($data['financial_institutions_id'])?>" />
                    <input type="hidden" name="terms_id" value="<?=intval($data['terms_id'])?>" />

                    <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />

                    <input type="hidden" name="insurer_person_types_id" value="<?=$this->insurer_person_types_id?>" />

                    <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Страхові ризики:</td>
                        <td><?=$this->buildCheckboxes($this->formDescription['fields'][ $this->getFieldPositionByName('risks_id') ], $data['risks_id'], null, $this->getReadonly(true), $data, ' ')?></td>
                    </tr>
                    </table>

                    <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td><?=$this->getMark()?>Місце страхування:</td>
                        <td><input type="text" name="object_location" value="<?=$data['object_location']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                    <tr>
                        <td><?=$this->getMark()?>Тип будівлі:</td>
                        <td>
                            <?
                                $data['types_id'] = 1;
                                echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, $this->getReadonly(true), null, $data)
                            ?>
                        </td>
                    </tr>
                    </table>

                    <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td><?=$this->getMark()?>Рік зведення будівлі<br />(введення в експлуатацію):</td>
                        <td>
                        <?
                            unset($data['types_id']);
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('house_years')], $data['house_years'], null, $this->getReadonly(true), null, $data);
                        ?>
                       </td>
                    </tr>
                    <tr>
                        <td><?=$this->getMark()?>Строк експлуатації приватного<br />будинку (квартири) без капітального ремонту:</td>
                        <td>
                        <?
                            $data['types_id'] = 2;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, $this->getReadonly(true), null, $data)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?=$this->getMark()?>Заявлене на страхування рухоме<br />та нерухоме майно використовується:</td>
                        <td>
                        <?
                            $data['types_id'] = 3;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, $this->getReadonly(true), null, $data)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?=$this->getMark()?>Характер експлуатації квартири<br />(приватного будинку),<br />що заявляється на страхування:</td>
                        <td>
                        <?
                            $data['types_id'] = 4;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, $this->getReadonly(true), null, $data)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?=$this->getMark()?>Приватний будинок (квартира)<br />знаходиться в зоні:</td>
                        <td>
                        <?
                            $data['types_id'] = 5;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'multiple size="7" '. $this->getReadonly(true), null, $data)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Протипожежна безпека:</td>
                        <td>
                        <?
                            $data['types_id'] = 6;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'multiple size="5" '. $this->getReadonly(true), null, $data)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Інші засоби безпеки:</td>
                        <td>
                        <?
                            $data['types_id'] = 7;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, 'multiple size="5" '. $this->getReadonly(true) , null, $data)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Система опалення:</td>
                        <td>
                        <?
                            $data['types_id'] = 8;
                            echo $this->buildSelect($this->formDescription['fields'][$this->getFieldPositionByName('values_id')], $data['values_id'], null, ' '. $this->getReadonly(true), null, $data)
                        ?>
                        </td>
                    </tr>
                    </table>

                    <div class="section">Перелік застрахованого майна:</div>
                    <table id="items" width="100%" cellpadding="5" cellspacing="0">
                    <tr class="columns">
                        <td>Назва</td>
                        <td width="150">Страхова вартість, грн.</td>
                        <td width="150">Страхова сума, грн.</td>
                        <td>Франшиза, %</td>
                        <td width="80">Тариф, %</td>
                        <td width="80">Премія, грн.</td>
                        <? if ($this->mode != 'view') { ?><td width="25"><a href="javascript:addItem()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати майно" /></a></td><? } ?>
                    </tr>
                    <?
                        $i = 0;
                        $total_cost=0;
                        $total_price=0;
                        $total_amount=0;
                        if (is_array($data['items'])) {
                            foreach ($data['items'] as $i => $item) {
                                $total_cost +=$data['items'][$i]['cost'];
                                $total_price +=$data['items'][$i]['price'];
                                $total_amount +=$data['items'][$i]['amount'];
                    ?>
                    <tr style="background: <?=($i % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>">
                        <td>
                            <select id="items<?=$i?>title" idx="<?=$i?>" name="items[<?=$i?>][title]" class="fldSelect" onfocus="this.className=fldSelectOver" onblur="this.className=fldSelect" <?=$this->getReadonly(true)?>>
                                <option value="Житлове приміщення" <?=($item['title']=='Житлове приміщення' ? 'selected':'')?>>Житлове приміщення</option>
                                <option value="Оздоблення" <?=($item['title']=='Оздоблення' ? 'selected':'')?>>Оздоблення</option>
                                <option value="Обладнання" <?=($item['title']=='Обладнання' ? 'selected':'')?>>Обладнання</option>
                                <option value="Рухоме майно" <?=($item['title']=='Рухоме майно' ? 'selected':'')?>>Рухоме майно</option>
                                <option value="Господарські будівлі" <?=($item['title']=='Господарські будівлі' ? 'selected':'')?>>Господарські будівлі</option>
                            </select>
                        </td>
                        <td><input type="text" id="items<?=$i?>cost" name="items[<?=$i?>][cost]" value="<?=$item['cost']?>" maxlength="12" class="fldText code total_cost" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> onchange="calcTotalCost()" /></td>
                        <td><input type="text" id="items<?=$i?>price" name="items[<?=$i?>][price]" value="<?=$item['price']?>" maxlength="12" class="fldText code total_price" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> onchange="setItemAmount(<?=$i?>)" /></td>
                        <td>
                            <select id="items<?=$i?>value" name="items[<?=$i?>][value]" class="fldSelect" onfocus="this.className=fldSelectOver" onblur="this.className=fldSelect" <?=$this->getReadonly(true)?>>
                                <option value="1" <?=($item['value']==1 ? 'selected':'')?>>1</option>
                                <option value="1.5" <?=($item['value']==1.5 ? 'selected':'')?>>1.5</option>
                                <option value="2" <?=($item['value']==2 ? 'selected':'')?>>2</option>
                            </select>
                            <input type="hidden" name="items[<?=$i?>][absolute]" value="0"/>

                        </td>
                        <td><input type="text" id="items<?=$i?>rate" name="items[<?=$i?>][rate]" value="<?=$item['rate']?>" maxlength="6" class="fldPercent" onfocus="this.className='fldPercentOver'" onblur="this.className='fldPercent'" <?=$this->getReadonly(false)?> onchange="setItemAmount(<?=$i?>)" <?=($this->subMode == 'calculate') ? 'readonly' : ''?> /></td>
                        <td><input type="text" id="items<?=$i?>amount" name="items[<?=$i?>][amount]" value="<?=$item['amount']?>" maxlength="10" class="fldMoney total_amount" class="fldMoney" onchange="calcTotalAmount();" <?=$this->getReadonly(false)?> readonly/></td>
                        <? if ($this->mode != 'view') { ?><td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити майно"  onclick="deleteItem(this)" /></td><? } ?>
                    </tr>
                    <?
                            }
                        }
                    ?>
                    <tr style="background: <?=($i % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>" class="columns">
                        <td>Разом:</td>
                        <td id="total_cost"><?=getMoneyFormat($total_cost, -1)?></td>
                        <td id="total_price"><?=getMoneyFormat($total_price, -1)?></td>
                        <td>X</td>
                        <td>X</td>
                        <td id="total_amount"><?=getMoneyFormat($total_amount, -1)?></td>
                        <? if ($this->mode != 'view') { ?><td>&nbsp;</td><? } ?>
                    </tr>
                    </table><br />
                    <?if ($this->mode != 'view' && false) {?>
                    <input type="button" value=" Розрахувати тарифи " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="calculateRate();" />
                    <?}?>
                    <div class="section">Додаткова інформація:</div>
                    <table cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <td><textarea name="additional" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly(false)?>><?=$data['additional']?></textarea></td>
                    </tr>
                    </table>

                    <?if ($action!='view') {?>
                    <table cellpadding="2" cellspacing="0" width="100%">
                    <tr>
                        <td width="150">&nbsp;</td>
                        <td align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                    </tr>
                    </table>
                    <?}?>
                    </form>
                </td>
            </tr>
            </table>
        </td>
    </tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>