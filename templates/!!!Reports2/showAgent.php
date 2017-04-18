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
                            <ul>
							<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25 && $_SESSION['auth']['agent_financial_institutions_id']!=1) {?>
                                <li><a href="?do=Reports|getSellAgencies">Реалізація полiсiв по мiсяцях</a><br /><br /></li>
                                <li><a href="?do=Reports|getSellFinancialInstitutions">Реалізація полiсiв за програмою "АВТОБАНК" (физ лица)</a><br /><br /></li>
                                <li><a href="?do=Reports|getPoliciesGO">Реалізація полiсiв ЦВ. Акція</a><br /><br /></li>
							<?}?>	
                                <li><a href="?do=Reports|getPolicies">Агентська винагорода, поліси</a><br /><br /></li>
							<? if ($_SESSION['auth']['agent_financial_institutions_id']!=25 && $_SESSION['auth']['agent_financial_institutions_id']!=1) {?>	
                                <li><a href="?do=Reports|getInsuranceManagerActivity">Заборгованiсть агентів за полiсами КАСКО</a><br /><br /></li>
                                <li><a href="?do=Akts|show">Акти виконанних робіт, агентська винагорода</a><br /><br /></li>
							<?}?>		
								<? if ($_SESSION['auth']['agent_financial_institutions_id']!=1) {?>	
								<li><a href="?do=Reports|getPoliciesGOCompanies">ЦВ, реалізація полісів компаніями за період</a><br /><br /></li>
								<?}?>
								<?=($_SESSION['auth']['agent_financial_institutions_id']==25 && $Authorization->data['agencies_id'] == 561
								    ||  $_SESSION['auth']['agent_financial_institutions_id']==1 && $Authorization->data['agencies_id'] == 563
									)  ? '<li><a href="?do=Reports|getContinuePolicies">КАСКО, пролонгація по договорах</a><br /><br /></li>' : ''?>
								<!--<?=($_SESSION['auth']['agent_financial_institutions_id']==25 && $Authorization->data['agencies_id'] == 561)  ? '<li><a href="?do=Reports|getContinuePoliciesRegions">КАСКО, пролонгація по регіонам</a><br /><br /></li>' : ''?>-->
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>