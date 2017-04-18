<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td>
            <td class="caption">Звіти:</td>
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
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|showAccidentsReport">Врегулювання</a></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|showReinsuranceReport">Перестрахування</a></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|getPolicyBlanks">Бланки полісів ЦВ</a></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|getSellChannels">Реалізація полiсiв по каналам</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|getPaymentsAndPremiums">Страхові відшкодування та страхові премії</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|getFinancialInstitutionsCommissions">Комісія по договорах (Глушак Юлія)</a></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=ReportBuilder|show">Отчеты</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|getSalesInOutFlows">Вхідний потік</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<li><a href="?do=Reports1|getInsurancePeriods">Страхові періоди</a></li>' : ''?>
                            </ul>

                            <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) ? '<a href="?do=Reports1|show">Старі звіти</a>' : ''?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>