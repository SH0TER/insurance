<script>
	function changePaymentStatusId(payment_statuses_id) {
		if (payment_statuses_id == 1) {
			$('#infoDate').html('Гранична дата виплати');
		} else if (payment_statuses_id == 2) {
			$('#infoDate').html('Фактична дата виплати');
		} else {
			$('#infoDate').html('');
		}
	}

	function setRealLimitPaymentDate(id, value) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'json',
			async:		false,
			data:		'do=AccidentPaymentsCalendar|setRealLimitPaymentDateInWindow' +
						'&id=' + id +
						'&date=' + value,
			success: 	function(result) {
			console.log(result);
							$('#messages_block').html(result.html);
							$('#messages_block').show();
							for (id in result.idx) {
							console.log(result.idx[id]);
								$('input[name=real_limit_payment_date' + result.idx[id] + ']').val(value);
							}
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
        <td></td>
        <td id="messages_block" onclick="$('#messages_block').hide();" style="cursor: pointer;"></td>
    </tr>
    <tr>
        <td class="bullet">
            <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
            ?>
        </td>
        <td class="caption">Виплати:</td>
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
                    <td><b>Статус оплати:</b></td>
                    <td>
                        <select onchange="changePaymentStatusId(this.value)" name="payment_statuses_id" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'">
                            <option value="1" <?=($data['payment_statuses_id'] == 1 ? 'selected' : '')?>>Не сплачено</option>
                            <option value="2" <?=($data['payment_statuses_id'] == 2 ? 'selected' : '')?>>Сплачено</option>
                        </select>
                    </td>
                    <td><b id="infoDate">Гранична дата виплати:</b></td>
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