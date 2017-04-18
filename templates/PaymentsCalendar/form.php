<script>
	numspecial = -1;
    function addProdTypes(obj) {
        var row			= document.getElementById('producttypes').insertRow(-1);

		var cell		= row.insertCell(0);
        cell.innerHTML	= '<select name="prod_types[' + numspecial + '][product_types_id]" value="" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';" /><?foreach ($data['types'] as $j => $prod_type) {echo '<option value="' . $j . '">' . $prod_type . '</option>';}?> </select>';

		cell		= row.insertCell(-1);
        cell.innerHTML	= '<input type="text" name="prod_types[' + numspecial + '][value]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />';

        cell			= row.insertCell(-1);
        cell.innerHTML	= '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteProdTypes(this)" />';

        numspecial--;
    }
	
	function deleteProdTypes(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибранний вид страхування?')) {
            document.getElementById('producttypes').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );
        }
    }

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
                    <tr>
                        <td>
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <?=$this->buildFieldsPart($data, $actionType);?>									
									<?
                                    if ($action != 'view') {
										echo PaymentsCalendar::getList($data);

										
                                    }
                                    ?>
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