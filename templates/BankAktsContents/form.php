<script>
function searchPolicies()
{
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'html',
				data:		'do=BankAktsContents|searchPoliciesInWindow' +
							'&policiesNumber=' + getElementValue('policiesNumber')  ,
				success:    function(result) {
								$('#searchResult').html(result);
									
							}
			});
}
function setNumber(number)
{
	$('input[name=number]').val($('#number'+number).val());
	$('input[name=payment_amount]').val($('#payment_amount'+number).val());
	$('input[name=product_title]').val($('#product_title'+number).val());
	$('input[name=insurer]').val($('#insurer'+number).val());
	$('input[name=prolongation]').val($('#prolongation'+number).val());
	$('input[name=quote]').val($('#quote'+number).val());
	$('input[name=assured_title]').val($('#assured_title'+number).val());
	$('input[name=bank_discount_value]').val($('#bank_discount_value'+number).val());
	$('input[name=bank_commission_value]').val($('#bank_commission_value'+number).val());
	$('input[name=bank_rko_insurance_amount]').val($('#bank_rko_insurance_amount'+number).val());
	$('input[name=ek_number]').val($('#ek_number'+number).val());
	$('input[name=statuses_id]').val($('#statuses_id'+number).val());
	$('input[name=manual]').val($('#manual'+number).val());
	
	$('input[name=rate]').val($('#rate'+number).val());
	$('input[name=commission_amount]').val($('#commission_amount'+number).val());
	$('input[name=insurance_amount]').val($('#insurance_amount'+number).val());
	$('input[name=credit_amount]').val($('#credit_amount'+number).val());
	$('input[name=bank_rko_credit_amount]').val($('#bank_rko_credit_amount'+number).val());
	$('input[name=bank_rko_credit_amount]').val($('#bank_rko_credit_amount'+number).val());
	$('input[name=types_id][value=1]').attr('checked', 'checked');
	
	
	$('input[name=payments_calendar_id]').val(number);
}

$(function() {
	/*$('input[name=base_commission_percent]').bind('change',
							function() {
								var v = $('input[name=base_commission_percent]').val();
								v=v.replace(',','.');
								$('input[name=base_commission_percent]').val(v)
								$('input[name=base_commission_amount]').val(Math.round(parseFloat($('input[name=base_commission_percent]').val())*parseFloat($('input[name=payment_amount]').val())/100*100)/100) ;
							}
						);
	$('input[name=commission_percent]').bind('change',
			function() {
				var v = $('input[name=commission_percent]').val();
				v=v.replace(',','.');
				$('input[name=commission_percent]').val(v)
				$('input[name=commission_amount]').val(Math.round(parseFloat($('input[name=commission_percent]').val())*parseFloat($('input[name=payment_amount]').val())/100*100)/100) ;
			}
		);		*/
});
</script>

<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption"><?=$this->getFormTitle($actionType)?>:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
                    <? if ($action == 'insert'){?>
                    <tr><td colspan="2">
                    <form name="searchForm">
					
					  <div id="searchClientBlock" style="padding-left:110px;">
							<table   cellpadding="0" cellspacing="5">
							<tr>
							<td colspan="3"><b>Добавить полис</b></td>
							</tr>
					        <tr>
								<td class="label grey" ><b>Номер полiсу:</b></td>
					            <td><input style="width:120px;" type="text" id="policiesNumber" name="policiesNumber" value="<?=$data['policiesNumber']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
					            <td><input type="button" value=" Знайти" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="searchPolicies()" /></td>
							</tr>
							</table>
							<br>
					  </div>
					  <div id="searchResult" style="padding-left:115px;font-weight:bold"></div>
					 </form>
                    </td></tr>
                    <?}?>
                    <tr>
                        <td>
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                                <input type="hidden" name="redirect" value="/index.php?do=BankAkts|view&id=<?=$data['akts_id']?>" />
								<input type="hidden" name="manual" value="1" />
                                
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <?=$this->buildFieldsPart($data, $actionType);?>
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>
<script>
$("#number").attr("readonly","true");
</script>