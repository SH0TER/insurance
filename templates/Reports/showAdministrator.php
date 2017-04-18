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
                                <?=($this->checkPermissionsBooleanResult('showMenuAccidentsReport') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|showAccidentsReport">Врегулювання</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuReinsuranceReport') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|showReinsuranceReport">Перестрахування</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetPolicyBlanks') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getPolicyBlanks">Бланки полісів ЦВ</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetPaymentsAndPremiums') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getPaymentsAndPremiums">Страхові відшкодування та страхові премії</a></li>' : ''?>
                            <!--<?=($this->checkPermissionsBooleanResult('showMenuGetFinancialInstitutionsCommissions') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getFinancialInstitutionsCommissions">Комісія по договорах (Глушак Юлія)</a></li>' : ''?>-->
                                <?=($this->checkPermissionsBooleanResult('showMenuReportBuilderShow') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=ReportBuilder|show">Отчеты</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetSalesInOutFlows') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getSalesInOutFlows">Вхідний потік</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetInsurancePeriods') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getInsurancePeriods">Страхові періоди</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetSellAgencies') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getSellAgencies">Реалізація полiсiв по мiсяцях</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetProfitability') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getProfitability">Рентабельність</a></li>' : ''?>
                                <?=($this->checkPermissionsBooleanResult('showMenuGetNewUnderwriter') || $this->checkPermissionsBooleanResult('showAll') || $Authorization->data['id'] == 13680) ? '<li><a href="?do=Reports|getNewUnderwriter">Платежi по полiсам / Збитки по подiям</a></li>' : ''?>                               
                                <?=($this->checkPermissionsBooleanResult('showMenuGetAktPayments') || $this->checkPermissionsBooleanResult('showAll') || $Authorization->data['id'] == 3909 || $Authorization->data['id'] == 4748 || $Authorization->data['id'] == 11467 || $Authorization->data['id'] == 3193) ? '<li><a href="?do=Reports|getAktPayments">Выплаты по агенским актам</a></li>' : ''?>                               
                                <?=($this->checkPermissionsBooleanResult('showMenuGetLoadShassi') || $this->checkPermissionsBooleanResult('showAll') || $Authorization->data['id'] == 3909 || $Authorization->data['id'] == 4748) ? '<li><a href="?do=Reports|getLoadShassi">Завантажити номера кузовiв</a></li>' : ''?>                             
                                <?=($this->checkPermissionsBooleanResult('showMenuGetDMS') || $this->checkPermissionsBooleanResult('showAll')) ? '<li><a href="?do=Reports|getDMS">ДМС, анализ урегулированных событий</a></li>' : ''?>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>