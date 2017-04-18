<script>
	function setRealLimitPaymentDate(id, value) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			async:		false,
			data:		'do=AccidentPaymentsCalendar|setRealLimitPaymentDateInWindow' +
						'&id=' + id +
						'&date=' + value,
			success: 	function(result) {
							//location.reload();
						}
		});
	}	
	
	function rowsHideShow(type) {
		if ($('.rows'+type).css('display') == 'none') {
			$('.rows'+type).show();
		} else {
			$('.rows'+type).hide();
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
        <td class="caption">Календар виплат СВ:</td>
    </tr>
    <tr>
        <td></td>
        <td align="right">
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td><b>Дата виплати (гранична / планова):</b></td>
                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
</div>