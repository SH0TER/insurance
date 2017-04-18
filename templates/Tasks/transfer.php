<script type="text/javascript">
  $(function() {
	function loadPerformers() {
		$.ajax({
		type:       'POST',
		url:        'index.php',
		dataType:   'html',
		data:       'do=Tasks|loadPerformersInWindow',
			success: function(result) {
				document.getElementById('performer').innerHTML=result;
			}
		});
	}

	loadPerformers();
});
</script>
<div class="block">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
	<td class="caption">Змiнити виконавця:</td>
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
				<input type="hidden" name="do" value="Tasks|updateTransfer">
				<input type="hidden" name="redirect" value="index.php?do=Tasks|show">
				<?php foreach ($data['id'] as $id) { ?>
				<input type="hidden" name="id[]" value="<?=$id?>" />
				<?php } ?>
				<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="label">*Виконавець:</td>
					<td id="performer"></td>
				</tr>
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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