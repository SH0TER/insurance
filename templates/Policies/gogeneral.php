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
                        <td><input type="text" name="ground" value="<?=$data['ground']?>" maxlength="50" class="fldText ground" onfocus="this.className='fldTextOver ground'" onblur="this.className='fldText ground'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>
                <div class="section">Параметри договору страхування:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Номер:</td>
                        <td><input type="text" id="number" name="number" value="<?=$data['number']?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                        <td class="label grey"><?=$this->getMark()?>Дата заключення:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', '  ' . $this->getReadonly(true))?></td>
                        <td class="label grey"><?=$this->getMark()?>Дата початку дії:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', $this->getReadonly(true))?></td>
                        <td class="label grey"><?=$this->getMark()?>Дата закінчення дії:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', $this->getReadonly(true))?></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Страховий продукт:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('products_id') ], $data['products_id'], $data['languageCode'], ' ' .$this->getReadonly(true), null, $data)?></td>
                        <td class="label grey"><?=$this->getMark()?>Кількість:</td>
                        <td><input type="text" id="quantity" name="quantity" value="<?=$data['quantity']?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                    </tr>
                </table>
				<? if ($action == 'insert') { ?>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Оплата за кожен сертифікат окремо:</td>
                        <td><input type="checkbox" name="payment_types_id" value="1" <?=($data['payment_types_id'] == 1) ? 'checked' : ''?> /></td>
                    </tr>
                </table>
				<? } ?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    initFocus(document.<?=$this->objectTitle?>);
</script>