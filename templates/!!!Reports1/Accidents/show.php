<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td>
            <td class="caption">Звіти по врегулюванню:</td>
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
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getHistoryAccidents']) ? '<li><a href="?do=Reports1|getHistoryAccidents">Глобальний</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsWithoutPayedFromMonth']) ? '<li><a href="?do=Reports1|getAccidentsWithoutPayedFromMonth">Без виплати / відмовлені протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getSTOForPeriod']) ? '<li><a href="?do=Reports1|getSTOForPeriod">Заявлені на СТО протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getApplicationAccidents']) ? '<li><a href="?do=Reports1|getApplicationAccidents">Заявлені випадки</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getDeclaredInsuranceCases']) ? '<li><a href="?do=Reports1|getDeclaredInsuranceCases">Заявлені протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getPayedCompensationCarServicesByPeriod']) ? '<li><a href="?do=Reports1|getPayedCompensationCarServicesByPeriod">Виплати на СТО протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getPayedCompensationRecipientsByPeriod']) ? '<li><a href="?do=Reports1|getPayedCompensationRecipientsByPeriod">Виплати по контрагентам протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCompromises']) ? '<li><a href="?do=Reports1|getCompromises">Компроміси</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getRepairInfo']) ? '<li><a href="?do=Reports1|getRepairInfo">Інформація ТіС</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentMessagesReport']) ? '<li><a href="?do=Reports1|getAccidentMessagesReport">Задачі по страховим справам</a><br /><br /></li>' : ''?>                                
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsActsSTO']) ? '<li><a href="?do=Reports1|getAccidentsActsSTO">Страхові акти (СТО)</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCarServices']) ? '<li><a href="?do=Reports1|getCarServices&from='.date('d.m.Y',strtotime('-7 days')).'&to='.date('d.m.Y').'">Справи по СТО</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCreatedActsByAvarage']) ? '<li><a href="?do=Reports1|getCreatedActsByAvarage&from='.date('d.m.Y',strtotime('-7 days')).'&to='.date('d.m.Y').'">Формування страхових актів по аваркомах</a><br /><br /></li>' : ''?>                                
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsResolvedTerms']) ? '<li><a href="?do=Reports1|getAccidentsResolvedTerms">Строки врегулювання справи</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getServicesAttorneys']) ? '<li><a href="?do=Reports1|getServicesAttorneys">Послуги повірених</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAnalysisAccidentsByAverage']) ? '<li><a href="?do=Reports1|getAnalysisAccidentsByAverage">Аналіз врегулювання страхових справ</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsPayments']) ? '<li><a href="?do=Reports1|getAccidentsPayments">Виплати</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsPaymentsCalendar']) ? '<li><a href="?do=Reports1|getAccidentsPaymentsCalendar">Календар виплат СВ</a><br /><br /></li>' : ''?>																
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getTermsInsuranceAccidents']) ? '<li><a href="?do=Reports1|getTermsInsuranceAccidents">Термін врегулювання справ</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCarServicesCalculationByAccidentMessages']) ? '<li><a href="?do=Reports1|getCarServicesCalculationByAccidentMessages">Калькуляції по страховим справам</a><br /><br /></li>' : ''?>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>