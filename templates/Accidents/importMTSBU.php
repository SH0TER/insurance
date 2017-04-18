<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$data['do']?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="step" value="<?=$data['step']?>" />
	<input type="hidden" name="number" value="<?=$data['number']?>" />
	<input type="hidden" name="amount" value="<?=doubleval($data['amount'])?>" />
	<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="policies_price" value="<?=$data['policies_price']?>" />
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="policies_amount" value="<?=$data['policies_amount']?>" />
	<input type="hidden" name="recipient_types_id" value="<?=$data['recipient_types_id']?>" />
	<input type="hidden" name="policy_payments_amount" value="<?=$data['policy_payments_amount']?>" />
	<input type="hidden" name="policies_begin_datetime_format" value="<?=$data['policies_begin_datetime_format']?>" />
	<input type="hidden" name="policies_interrupt_datetime_format" value="<?=$data['policies_interrupt_datetime_format']?>" />

	<input type="hidden" name="comment" value="<?=$data['comment']?>" />
    <table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td>
			Файл імпорту:<input type="file" name="file" value="" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> />
		</td>
	</tr>
    <tr>
		<td>
			Дата імпорту:<input type="text" name="date_import" />
		</td>
	</tr>
    </table>
   <input type="submit" value=" <?=translate('Import')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" />

</form>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>