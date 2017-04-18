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
                            <ul>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getHistoryAccidents']) ? '<li><a href="?do=Reports|getHistoryAccidents">Глобальний</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsWithoutPayedFromMonth']) ? '<li><a href="?do=Reports|getAccidentsWithoutPayedFromMonth">Без виплати / відмовлені протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getSTOForPeriod']) ? '<li><a href="?do=Reports|getSTOForPeriod">Заявлені на СТО протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getApplicationAccidents']) ? '<li><a href="?do=Reports|getApplicationAccidents">Заявлені випадки</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getDeclaredInsuranceCases']) ? '<li><a href="?do=Reports|getDeclaredInsuranceCases">Заявлені протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getPayedCompensationCarServicesByPeriod']) ? '<li><a href="?do=Reports|getPayedCompensationCarServicesByPeriod">Виплати на СТО протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getPayedCompensationRecipientsByPeriod']) ? '<li><a href="?do=Reports|getPayedCompensationRecipientsByPeriod">Виплати по контрагентам протягом місяця</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCompromises']) ? '<li><a href="?do=Reports|getCompromises">Компроміси</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getRepairInfo']) ? '<li><a href="?do=Reports|getRepairInfo">Інформація ТіС</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentMessagesReport']) ? '<li><a href="?do=Reports|getAccidentMessagesReport">Задачі по страховим справам</a><br /><br /></li>' : ''?>                                
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsActsSTO']) ? '<li><a href="?do=Reports|getAccidentsActsSTO">Страхові акти (СТО)</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCarServices']) ? '<li><a href="?do=Reports|getCarServices&from='.date('d.m.Y',strtotime('-7 days')).'&to='.date('d.m.Y').'">Справи по СТО</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCreatedActsByAvarage']) ? '<li><a href="?do=Reports|getCreatedActsByAvarage&from='.date('d.m.Y',strtotime('-7 days')).'&to='.date('d.m.Y').'">Формування страхових актів по аваркомах</a><br /><br /></li>' : ''?>                                
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsActsTransferList']) ? '<li><a href="?do=AccidentsActsTransfer|show&types_id=1">Реєстри передачі страхових актів / експертиз</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsActsPaymentList']) ? '<li><a href="?do=AccidentsActsTransfer|show&types_id=2">Акти оплати за надання послуг</a><br /><br /></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsResolvedTerms']) ? '<li><a href="?do=Reports|getAccidentsResolvedTerms">Строки врегулювання справи</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getServicesAttorneys']) ? '<li><a href="?do=Reports|getServicesAttorneys">Послуги повірених</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAnalysisAccidentsByAverage']) ? '<li><a href="?do=Reports|getAnalysisAccidentsByAverage">Аналіз врегулювання страхових справ</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsPayments']) ? '<li><a href="?do=Reports|getAccidentsPayments">Виплати</a><br /><br /></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsPaymentsCalendar']) ? '<li><a href="?do=Reports|getAccidentsPaymentsCalendar">Календар виплат СВ</a><br /><br /></li>' : ''?>								
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>