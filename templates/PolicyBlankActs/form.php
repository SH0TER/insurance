<script type="text/javascript">
	numspecial = -1;
    function addPolicyBlanks (obj) {
        alert(111);
        var row	= document.getElementById('items').insertRow(-1);

        cell = row.insertCell(0);
        cell.innerHTML	= '<td><input type="text" name="policy_blanks[' + numspecial + '][series]" value="" maxlength="5" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' ;
        cell = row.insertCell(-1);
        cell.innerHTML	= '<td><input type="text" name="policy_blanks[' + numspecial +'][number_from]" value="" maxlength="7" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>';
        cell = row.insertCell(-1);
        cell.innerHTML	= '<td><input type="text" name="policy_blanks[' + numspecial + '][number_to]" value="" maxlength="7" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' ;
        cell = row.insertCell(-1);
        cell.innerHTML	= '<td><input type="text" name="policy_blanks[' + numspecial + '][count]" value="" maxlength="7" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' ;

        cell = row.insertCell(-1);
        cell.innerHTML	= '<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deletePolicyBlanks(this)" />';

        numspecial--;
    }
	
	function deletePolicyBlanks(obj) {
        if (confirm('Ви дійсно бажаєте вилучити вибранний набiр бланкiв?')) {
            document.getElementById('items').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );
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
                        <input type="hidden" name="redirect" value="index.php?do=PolicyBlanks|show" />
                        <input type="hidden" name="date_day" value="<?=$data['date_day']?>" />
                        <input type="hidden" name="date_month" value="<?=$data['date_month']?>" />
                        <input type="hidden" name="date_year" value="<?=$data['date_year']?>" />

                        <table cellpadding="2" cellspacing="0" width="100%">
                        <?=$this->buildFieldsPart($data, $actionType);?>
                        <?=PolicyBlankActItems::getList($data, $actionType);?>
                        <tr>
                            <td width="150">&nbsp;</td>
                            <td>
                                <?
                                switch ($action) {
                                    case 'view':
                                        echo '<input type="button" value=" ' . translate('Back') . ' " class="button" onclick="changeLocation(document.path, ' . (sizeOf($_SESSION['auth']['path']) - 2) . ')" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" />';
                                        break;
                                    default:
                                        echo '<input type="submit" value=" ' . translate('Save') . ' " class="button" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" />';
                                        break;
                                }
                                ?>
                            </td>
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
<script type="text/javascript">
    var agencies_id_old = 0;

    $(function() {
        agencies_id_old =  $('#agencies_id').val();
        $('#agencies_id').blur();
        $('#agencies_id').bind('focus', function() {
            $(this).blur();
            return;
        } );

        $('#agencies_id').bind('change', function() {
            $('#agencies_id').val(agencies_id_old);
            return;
        } );
    });

    function selectAll() {
        $('input[type=checkbox][name=policy_blanks\[\]][class!=obligatory][class1!="created"]').attr('checked', $('input[type=checkbox][name=sample]').is(':checked'));
		//$('input[type=checkbox][name=policy_blanks\[\]]').attr('checked', $('input[type=checkbox][name=sample]').is(':checked'));
    }

    $('input[type=checkbox][name=policy_blanks\[\]][class="obligatory"]').bind('click', function() {
        $(this).attr('checked', true);
    });

    $('input[type=checkbox][name=policy_blanks\[\]][class1="created"]').bind('click', function() {
		v=""+$(this).attr('checked');
		if (v=='true')
			alert('Полiс в статусi "створений" не може бути включено до акту. Змiнiть статус або дату початку полiсу');
		
        $(this).attr('checked', false);
    });

    initFocus(document.<?=$this->objectTitle?>);
</script>