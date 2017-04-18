<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
		<td class="caption"><?=$this->getFormTitle($action)?>:</td>
	</tr>
	<tr>
		<td></td>
		<td valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr><td class="content"><?=translate('Content')?>:</td></tr>
			<tr><td>
				<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="do" value="<?=$this->object.'|changeStep'?>" />
				<input type="hidden" name="id" value="<?=$data['id']?>" />
				<input type="hidden" name="accidents_id" value="<?=$data['id']?>" />
				<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
				<input type="hidden" name="step" value="2" />
				<table cellpadding="2" cellspacing="0">
				<?=$this->buildFieldsPart($data, $actionType)?>
				</table>
				</form>
			</td></tr>
			</table>
		</td>
	</tr>
	</table>
</div>