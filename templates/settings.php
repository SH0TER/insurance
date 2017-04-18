<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td>
            <td class="caption">Установки:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" colspan="2" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td height="10" colspan="2"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr>
                        <td width="50%" valign="top">
							<b>Загальні:</b>
                            <ul>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER && $Authorization->data['permissions']['CurrencyRates']['show'])) ? '<li><a href="?do=CurrencyRates|show">Курси валют</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER && $Authorization->data['permissions']['CarBrands']['show'])) ? '<li><a href="?do=CarBrands|show">Марки, моделі авто</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['TransportationCompanies']['show'])) ? '<li><a href="?do=TransportationCompanies|show">Транспортні компанії</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['Distributors']['show'])) ? '<li><a href="?do=Distributors|show">Дистрибутори автотехніки</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['FinancialInstitutions']['show'])) ? '<li><a href="?do=FinancialInstitutions|show">Банки</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=ParametersProperty|show">Параметри майно</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=InsuranceCover|show">Додаткове страхове покриття</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=InsuranceCompanies|show">Перестраховi компанії</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=Risks|show">Ризики</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id']== ROLES_MANAGER) ? '<li><a href="?do=Cities|show">Мiста</a><br /><br /></li>' : ''?>
                            </ul>
                        </td>
                        <td width="50%" valign="top">
							<b>Врегулювання:</b>
                            <ul>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['MVS']['show'])) ? '<li><a href="?do=MVS|show">Органи ДАІ</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['CarServices']['show'])) ? '<li><a href="?do=CarServices|show">СТО</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['Experts']['show'])) ? '<li><a href="?do=ExpertOrganizations|show">Експерти (незалежна експертиза)</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['Courts']['show'])) ? '<li><a href="?do=Courts|show">Суди</a><br /><br /></li>' : ''?>
							</ul>
							<b>Користувачі:</b>
							<ul>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=AccountPermissions|show">Операції</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=AccountGroups|show">Ролі</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['Managers']['show'])) ? '<li><a href="?do=Managers|show">Менеджери ТДВ "Експрес Страхування"</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) ? '<li><a href="?do=Managers|showServiceDepartment">Менеджери Департаменту сервісу</a><br /><br /></li>' : ''?>
                                <?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || ($Authorization->data['roles_id']== ROLES_MANAGER &&  $Authorization->data['permissions']['GeneraliBranches']['show'])) ? '<li><a href="?do=GeneraliBranches|show">Філії "Гарант-Авто" та менеджери</a><br /><br /></li>' : ''?>
							</ul>
						</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>