<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>ТДВ "Експрес Cтрахування"</title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=CHARSET?>" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="cache-control" content="no-cache" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link href="/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/js/script.js"></script>
		<script type="text/javascript" src="/js/jquery/jquery.js"></script>
    </head>
    <body onload="javascript: document.authorization.login.focus();">
        <table width="100%" height="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" valign="middle">
                    <table width="500" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="2" height="168" align="center" valign="bottom">
                                <a href="/"><img src="/images/administration/logoLarge.gif" width="267" height="191" vspace="21" alt="<?=$_SERVER['HTTP_HOST']?>" /></a>
                            </td>
                        </tr>
                        <tr>
                            <td id="authorization" colspan="2">
                                <? if (!empty($_POST['login'])) echo '<div class="error">' . translate('Login or password is not correct. Try again.') . '</div>';?>
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="caption"><b><?=translate('Authorization')?>:</b></td>
                                    </tr>
                                    <tr>
                                        <td class="content">
                                            <form name="authorization" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                                <input type="hidden" name="do" value="login" />
                                                <table width="100%" cellspacing="0" cellpadding="4">
                                                    <tr>
                                                        <td class="label" width="175"><?=translate('Login')?>:</td>
                                                        <td><input type="text" name="login" value="<?= ($_COOKIE['saveLogin'] && $_POST['do'] != 'login') ? $_COOKIE['saveLogin'] : $_POST['login']?>" maxlength="55" class="fldAuth" autocomplete="off" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label"><?=translate('Password')?>:</td>
                                                        <td><input type="password" name="password" value="<?= ($_POST['do'] != 'login') ? $_COOKIE['savePassword'] : $_POST['password']?>" maxlength="25" class="fldAuth" autocomplete="off" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label"></td>
                                                        <td><input type="checkbox" name="save" value="1" <? if ($_COOKIE['saveLogin'] != '' && $_COOKIE['savePassword'] != '') echo 'checked';?> /> <?=translate('Save login and password on this computer.')?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center"><input type="submit" value="  <?=translate('Enter')?>  " class="button" onMouseOver="this.className = 'buttonover';" onMouseOut="this.className = 'button';" /></td>
                                                    </tr>
                                                    <tr><td colspan="2" align="center"><a href="javascript: windowOpen('forgotPassword', '<?=$_SERVER['PHP_SELF']?>?do=Users|recoveryPasswordInWindow', 400, 130, 0, 0, 0, 0, 0)"><?=translate('Forgot password')?>?</a></td></tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" height="100" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td class="version"><?=translate('Version')?> 1.00</td>
                                        <td class="copyright">&copy; <?=$_SERVER['HTTP_HOST']?>, 2008-<?=date('Y')?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
	<? if ($_GET['admin'] == 1) { ?>
		<script>
			$('input[name=login]').val('<?=$_GET['login']?>');
			$('input[name=password]').val('<?=$_GET['password']?>');
			document.authorization.submit();
		</script>
	<? } ?>
</html>