<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td>
            <td class="caption"><?=translate('Preferences')?></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" colspan="2" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr>
                        <td width="50%" valign="top"><br>
                            <b><?=translate('Password')?></b>
                            <ul>
                                <li><a href="?do=Users|loadPassword"><?=translate('Change password')?></a>
                            </ul>
                            <b><?=translate('Screen resolution')?></b>
                            <ul>
                                <li><a href="?do=Users|loadScreenResolutions"><?=translate('Change screen resolutions')?></a>
                            </ul>
                        </td>
                        <td width="50%" valign="top"><br>
                            <b><?=translate('Profile')?></b>
                            <ul>
                                <li><a href="?do=Users|loadProfile"><?=translate('Change profile')?></a>
                            </ul>
                            <b><?=translate('Number of records per page')?></b>
                            <ul>
                                <li><a href="?do=Users|loadRecordsPerPage"><?=translate('Change number of records per page')?></a>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>