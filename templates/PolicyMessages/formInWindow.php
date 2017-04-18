<?
	if (!$data['isPresent']) {
?>
<script type="text/javascript">
	function getFormValues(form) {
		var result = '';
		for (i=0; i<form.elements.length; i++) {
			result += '&' + form.elements[ i ].name + '=' + getElementValue(form.elements[ i ]);
		}

		return result;
	}

	function insertInWindow() {

		setCookie('message[policies_id]', '', -3600);
		setCookie('message[subject]', '', -3600);
		setCookie('message[text]', '', -3600);

		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=<?=$this->object?>|insertInWindow' + getFormValues(document.<?=$this->objectTitle?>),
			success:	function success(result) { document.getElementById('PolicyMessageInWindow').innerHTML = result; }
		})
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
			<td id="PolicyMessageInWindow">
<? } ?>
				<?=$Log->showSystem()?>
				<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
				<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="label">*Отримувач(і):</td>
					<td><?=$this->buildCheckboxes($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organizations_id') ], $data['recipients_id'], null, null, $data, '<br />')?></td>
				</tr>
				<?=$this->buildFieldsPart($data, $actionType);?>
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center"><input type="button" value=" Відправити " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="insertInWindow()" /></td>
				</tr>
				</table>
				</form>
<? if (!$data['isPresent']) { ?>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>
<? } ?>