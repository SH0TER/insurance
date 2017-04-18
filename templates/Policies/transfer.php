<script type="text/javascript">


  $(function() {
      <?if ($data['product_types_id']==/*PRODUCT_TYPES_GO*/9999) {?>
        $('#agencies_id').blur();
        $('#agencies_id').bind('focus', function() {
              $(this).blur();
              return;
           } );
       <?}?>
		$('#agencies_id').bind('change', function() {
            <?if ($data['product_types_id']==PRODUCT_TYPES_GO) {?>

            <?}?>
			loadManagers();
			
		});

		function loadManagers()
		{
			$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'html',
            data:       'do=Policies|loadAgentsInWindow' +
                        '&agencies_id=' + getElementValue('agencies_id') +
						'&product_types_id=' + getElementValue('product_types_id') +
                        '&old_agents_id=' + getElementValue('old_agents_id'),
				success: function(result) {
					document.getElementById('selectmanager').innerHTML=result;
				}
			});
		}
		loadManagers();
});
</script>
<div class="block">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
	<td class="caption">Змiнити менеджера:</td>
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
				<input type="hidden" name="do" value="Policies|updateTransfer">
				<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>">
				<input type="hidden" name="id" value="<?=intval($data['id'])?>" />
				<input type="hidden" name="product_types_id" value="<?=intval($data['product_types_id'])?>" />
				<input type="hidden" id="old_agents_id" name="old_agents_id" value="<?=intval($data['old_agents_id'])?>" />
				
				<table cellpadding="2" cellspacing="0" width="100%">
				<?=$this->buildFieldsPart($data, 'update');?>
				<tr>
				<td class="label">*Менеджер:</td>
				<td id="selectmanager">
				
				</td>
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