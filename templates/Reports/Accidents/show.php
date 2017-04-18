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
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getHistoryAccidents']) ? '<li><a href="?do=Reports|getHistoryAccidents">Глобальний</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsWithoutPayedFromMonth']) ? '<li><a href="?do=Reports|getAccidentsWithoutPayedFromMonth">Без виплати / відмовлені протягом місяця</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getSTOForPeriod']) ? '<li><a href="?do=Reports|getSTOForPeriod">Заявлені на СТО протягом місяця</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getApplicationAccidents']) ? '<li><a href="?do=Reports|getApplicationAccidents">Заявлені випадки</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getDeclaredInsuranceCases']) ? '<li><a href="?do=Reports|getDeclaredInsuranceCases">Заявлені протягом місяця</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getPayedCompensationCarServicesByPeriod']) ? '<li><a href="?do=Reports|getPayedCompensationCarServicesByPeriod">Виплати на СТО протягом місяця</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getPayedCompensationRecipientsByPeriod']) ? '<li><a href="?do=Reports|getPayedCompensationRecipientsByPeriod">Виплати по контрагентам протягом місяця</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCompromises']) ? '<li><a href="?do=Reports|getCompromises">Компроміси</a></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getRepairInfo']) ? '<li><a href="?do=Reports|getRepairInfo">Інформація ТіС</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentMessagesReport']) ? '<li><a href="?do=Reports|getAccidentMessagesReport">Задачі по страховим справам</a></li>' : ''?>                                
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsActsSTO']) ? '<li><a href="?do=Reports|getAccidentsActsSTO">Страхові акти (СТО)</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCarServices']) ? '<li><a href="?do=Reports|getCarServices&from='.date('d.m.Y',strtotime('-7 days')).'&to='.date('d.m.Y').'">Справи по СТО</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCreatedActsByAvarage']) ? '<li><a href="?do=Reports|getCreatedActsByAvarage&from='.date('d.m.Y',strtotime('-7 days')).'&to='.date('d.m.Y').'">Формування страхових актів по аваркомах</a></li>' : ''?>                                
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsResolvedTerms']) ? '<li><a href="?do=Reports|getAccidentsResolvedTerms">Строки врегулювання справи</a></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getServicesAttorneys']) ? '<li><a href="?do=Reports|getServicesAttorneys">Послуги повірених</a></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAnalysisAccidentsByAverage']) ? '<li><a href="?do=Reports|getAnalysisAccidentsByAverage">Аналіз врегулювання страхових справ</a></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsPayments']) ? '<li><a href="?do=Reports|getAccidentsPayments">Виплати</a></li>' : ''?>								
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentsPaymentsCalendar']) ? '<li><a href="?do=Reports|getAccidentsPaymentsCalendar">Календар виплат СВ</a></li>' : ''?>																
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getTermsInsuranceAccidents']) ? '<li><a href="?do=Reports|getTermsInsuranceAccidents">Термін врегулювання справ</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCarServicesCalculationByAccidentMessages']) ? '<li><a href="?do=Reports|getCarServicesCalculationByAccidentMessages">Калькуляції по страховим справам</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getCarsProlongation']) ? '<li><a href="?do=Reports|getCarsProlongation">Встановлення ринк. цiн на авто</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getUnderwriter']) ? '<li><a href="?do=Reports|getUnderwriter">Страховика</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getSentAcceptedAA']) ? '<li><a href="?do=Reports|getSentAcceptedAA">Направлені / Прийняті</a></li>' : ''?>
								<?=($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Reports']['getAccidentActPayment']) ? '<li><a href="?do=Reports|getAccidentActPayment">Страхові акти</a></li>' : ''?>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>