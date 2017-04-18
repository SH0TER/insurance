<div class="block">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
	<td class="caption">Оплати:</td>
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
				<input type="hidden" name="do" value="<?=$this->object.'|updatePayments'?>" />
				<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
				<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
				<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="label">*Файл:</td>
					<td><input type="file" id="file" name="file" class="fldText" /></td>
				</tr>
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center"><input type="submit" value=" Відправити" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>