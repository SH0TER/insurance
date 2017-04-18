<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="do" value="<?=$this->object?>|copyPolicy" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<div class="section">Дублікат:</div>
	  <table cellpadding="5" cellspacing="0">
		<tr>
			<td class="label grey">*Серія поліса:</td>
			<td><input type="text" id="blank_series" name="blank_series" value="<?=$data[ 'blank_series' ]?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'"/></td>
			<td class="label grey">*Номер поліса:</td>
			<td><input type="text" id="blank_number" name="blank_number" value="<?=$data[ 'blank_number' ]?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'"/></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
        initFocus(document.<?=$this->objectTitle?>);
</script>