<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td>
            <td class="caption">Звіти з перестрахування:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td height="10"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr>
                        <td valign="top">
                            <ul style="line-height: 20px;">
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getKASKOBordero']) ? '<li><a href="?do=Reports1|getKASKOBordero&product_types_id=' . PRODUCT_TYPES_KASKO . '">КАСКО. Бордеро премій</a></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCargoBordero']) ? '<li><a href="?do=Reports1|getCargoBordero&product_types_id=' . PRODUCT_TYPES_CARGO . '">Сертифікати добровільного страхування вантажів та багажу (вантажобагажу). Бордеро премій.</a></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCertificateCargoObjects']) ? '<li><a href="?do=Reports1|getCertificateCargoObjects">Сертифікати добровільного страхування вантажів та багажу (вантажобагажу). Об\'єкти</a></li>' : ''?>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>