<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title><?=translate('Forgot password')?>?</title>
        <link href="/css/style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=<?=CHARSET?>">
    </head>
    <body>
        <form name="password" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Users|sendPasswordInWindow">
            <table width="100%" height="100%" cellpadding="0" cellspacing="10">
                <tr>
                    <td valign="middle" class="label"><?=translate('Your e-mail')?>:</td>
                    <td valign="middle" width="400"><input type="text" name="email" value="<?=$data['email']?>" maxlength="50" class="fldText" /></td>
                    <td valign="middle"><input type="submit" value="<?=translate('Get')?>" onMouseOver="this.className = 'buttonover';" onMouseOut="this.className = 'button';" class="button" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>