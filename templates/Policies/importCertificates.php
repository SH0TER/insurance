<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
		<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
		<td class="caption">Імпорт1:</td>
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
					<input type="hidden" name="do" value="<?=$this->object?>|importCertificates" />
					<input type="hidden" name="process" value="1" />
                    <input type="hidden" name="top" value="<?=$data['top']?>" />
                    <input type="hidden" name="policies_general_id" value="<?=$data['top']?>" />
					<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
					<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
					<table cellpadding="2" cellspacing="0" width="100%">
					<tr>
						<td class="label"><?=$this->getMark()?>Дата:</td>
						<td width="120"><?=$this->getDateSelect(null, $data['date_year'], $data['date_month'], $data['date_day'], 'date')?></td>
						<td></td>	
					</tr>
					<tr>
						<td class="label"><?=$this->getMark()?>Файл:</td>
						<td colspan="2"><input type="file" name="file" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
					</tr>
					<tr>
						<td width="150">&nbsp;</td>
						<td align="center"><input type="submit" value=" Імпортувати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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