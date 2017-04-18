<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$_SERVER['HTTP_HOST']?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?=CHARSET?>">
	<link href="/css/administration.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" language="JavaScript">
		var sent = false;
		function send() {
			if (sent) {
				return;
			} else {
				sent = true;
			}
			document.send.submit();
		}
	</script>
</head>
<body <? if (!$isSend && $data['types_id'] == 2) { ?>onload="setTimeout('send()', <?=NEWSLETTER_BLAST_PAUSE?>)"<? } ?>>
<table width="100%" height="100%">
<tr>
	<td align="center" valign="center">
		<?
			$Log->showSystem();

			if (!$isSend && $data['types_id'] == 2) {
				echo '<form name="send" action="' . $_SERVER['PHP_SELF'] . '" method="post">';
				echo '<input type="hidden" name="do" value="' . $this->object . '|sendInWindow" />';
				echo '<input type="hidden" name="types_id" value="' . $data['types_id'] . '" />';
				echo '<input type="hidden" name="news_id" value="' . $data['news_id'] . '" />';
				echo '<br><br><input type="submit" value=" ' . translate('Continue') . ' " class="button" onMouseOver="this.className = \'buttonover\';" onMouseOut="this.className = \'button\';" />';
				echo '</form>';
			} else {
				echo '<br><br><input type="button" value=" ' . translate('Back') . ' " onclick="parent.window.location.href = \'' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show\'" class="button" onMouseOver="this.className = \'buttonover\';" onMouseOut="this.className = \'button\';" />';
			}
		?>
	</td>
</tr>
</table>
</body>
</html>