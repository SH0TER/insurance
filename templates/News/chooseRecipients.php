<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Вiдправка:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
			<tr><td>
				<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="do" value="<?=$this->object?>|send" />
				<input type="hidden" name="news_id" value="<?=$data['id']?>" />
				<input type="hidden" name="redirect" value="<?=($data['redirect'] == '') ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
				<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr>
					<td class="label"><b>Тестова вiдправка:</b></td>
					<td><input type="radio" name="types_id" value="1" checked /></td>
				</tr>
				<tr>
					<td align="right" valign="top" nowrap><b>Вiдправка усiм отримувачам:</b></td>
					<td><input type="radio" name="types_id" value="2"></td>
				</tr>
				<tr>
					<td width="150">&nbsp;</td>
					<td align="center">
						<input type="button" name="back" value=" <?=translate('Back')?> " onClick="location.href = '?do=<?=$this->object?>|show';" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" />
						<input type="submit" name="submit" value=" <?=translate('Send')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" />
					</td>
				</tr>
				</table>
				</form>
			</td></tr>
			</table>
		</td>
	</tr>
	</table>
</div>