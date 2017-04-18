<? if ($_SESSION['auth']['agent_financial_institutions_id']==25) {
$showcomissions = false;
}
?>
<script>

function  deleteFromAkt(policies_id,aktnumber,aktType)
{
	if (confirm('Ви дійсно бажаєте вилучити анкету з акту ?')) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			data:		'do=InsurancePeriods|deleteFromAktInWindow' +
						'&policies_id=' + policies_id+
						'&aktnumber=' + aktnumber+
						'&aktType=' + aktType,
			success: 	function(result) {
							switch (result.type) {
								case 'confirm':
									$("#akt" + policies_id+aktType).html('');
									//$('#bank_akt_payment_date' + id).html('<a href="javascript: addToBankAkt(' + id + ')" title="Додати до акту"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати до акту" /></a>');
									break;
								case 'error':
									alert(result.text);
									break;
							}
						}
		});
	}
}

</script>
<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Агентська винагорода, поліси:</td>
	</tr>
	<tr>
		<td></td>
		<td align="right">
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
                <? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td>
                        <b>СК:</b>
                        <select name="insurance_companies_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" style="width: 200px;">
                            <option value="">...</option>
                            <option value="<?=INSURANCE_COMPANIES_EXPRESS?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) ? 'selected' : ''?>>ТДВ Експрес страхування</option>
                            <option value="<?=INSURANCE_COMPANIES_GENERALI?>" <?=($data['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? 'selected' : ''?>>ВАТ "УСК "Гарант-Авто"</option>
                        </select>
                    </td>
                    <td><b>СТО:</b> <input type="checkbox" name="service" value="1" <?=($data['service']) ? 'checked' : ''?> /></td>
                    <td>
                        <b>Агенція:</b>
                        <?
                            echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                            echo '<option value="">...</option>';
                            foreach ($agencies as $agency) {
                                            echo ($agency['id'] == $data['agencies_id'])
                                                ? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
                                                : '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
                            }

                            echo '</select>';
                        ?>
                    </td>
                </tr>
                </table>
                <? } ?>
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <? if ($_SESSION['auth']['agent_financial_institutions_id']!=25) {?>
                    <td>
                        <b>Банк:</b>
                        <?
                            echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                            echo '<option value="">...</option>';
                            foreach ($financial_institutions as $financial_institution) {
                                echo '<option value="' . $financial_institution['id'] . '" ' . (($financial_institution['id'] == $data['financial_institutions_id']) ? 'selected' : '') . '>' . $financial_institution['title'] . '</option>';
                            }
                            echo '</select>';
                        ?>
                    </td>
                    <? } ?>
                    <td>
                        <b>Статус:</b>
                        <select id="policy_statuses_id" name="policy_statuses_id[]" multiple size="3"  class="fldSelect " onfocus="this.className='fldSelectOver '" onblur="this.className='fldSelect '">
                        <?  foreach ($policiy_statuses as $status) {
                              echo '<option value="'.$status['id'].'" '.(in_array($status['id'],$data['policy_statuses_id']) ? 'selected' : '').' >'.$status['title'].'</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                </table>
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td><b>Тип полiса:</b></td>
                    <td>
                    <?
                        echo '<select name="product_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                        foreach ($product_types as $product_type) {
                            echo '<option value="' . $product_type['id'] . '" ' . (($product_type['id'] == $data['product_types_id']) ? 'selected' : '') . '>' . $product_type['title'] . '</option>';
                        }
                        echo '</select>';
                    ?>
                    </td>
                    <td><b>Номер:</b> <input type="text" name="number" value="<?=$data['number']?>" class="fldAuth" onfocus="this.className='fldAuthOver';" onblur="this.className='fldAuth';" /></td>
                    <td><b>Термін:</b></td>
                    <td>&nbsp;з</td><td><input type="text" name="fromWaitingPaymentDate" value="<?=$data['fromWaitingPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td nowrap>&nbsp;до</td><td><input type="text" name="toWaitingPaymentDate" value="<?=$data['toWaitingPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><b>Отримано:</b></td>
                    <td>&nbsp;з</td><td><input type="text" name="fromPaymentDate" value="<?=$data['fromPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td nowrap>&nbsp;до</td><td><input type="text" name="toPaymentDate" value="<?=$data['toPaymentDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';"></td>
                </tr>
                </table>
			</form>
            </div>
		</td>
	</tr>
	</table>
</div>