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
                    <td>
                        <ul style="line-height: 20px;">
						    <!--<li><a href="?do=Reports|getPolicies">Агентська винагорода, поліси</a></li>-->
                            <li><a href="?do=Reports|getInsurancePeriods">Страхові періоди</a></li>
                            <? if ($_SESSION['auth']['agent_financial_institutions_id']!=25 && $_SESSION['auth']['agent_financial_institutions_id']!=1 && $_SESSION['auth']['agencies_id']!=1469) {?>	
                                <li><a href="?do=Reports|getInsuranceManagerActivity">Заборгованiсть агентів за полiсами КАСКО</a></li>
                                <li><a href="?do=Akts|show">Акти виконанних робіт, агентська винагорода</a></li>
							<?}?>
                        </ul>
                    </td>
                </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
