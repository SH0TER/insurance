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
				<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
				<input type="hidden" name="id" value="<?=$data['id']?>" />
				<table cellpadding="2" cellspacing="0">
				<?=$this->buildFieldsPart($data, $actionType)?>
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center"><input type="button" value=" <?=translate('Back')?> " class="button" onclick="history.go(-1)" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
				</tr>
				</table>
				</form>
			</td></tr>
			</table>
		</td>
	</tr>
	</table>
</div>