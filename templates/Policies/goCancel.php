<? $Log->showSystem();
$this->mode='update';
?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="do" value="<?=$this->object?>|cancelPolicy" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<div class="section">Дострокове припинення:</div>
	  <table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">*Сума що пiдляга поверненю:</td>
			<td><input type="text" id="amount_return" name="amount_return" value="<?=$data[ 'amount_return' ]?>" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'"/></td>
			<td class="label grey"><?=$this->getMark()?>Дата розриву:</td>
            <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('interrupt_datetime') ], $data[ 'interrupt_datetime_year' ], $data[ 'interrupt_datetime_month' ], $data[ 'interrupt_datetime_day' ], 'interrupt_datetime', '  ' . $this->getReadonly(true))?></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
        initFocus(document.<?=$this->objectTitle?>);
</script>