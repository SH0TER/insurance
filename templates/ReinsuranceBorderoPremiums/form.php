<script type="text/javascript">
function loadItems() {

	var financial_institutions_id = '';
	$('#financial_institutions_id option:selected').each(function(){
		financial_institutions_id = financial_institutions_id + '&financial_institutions_id[]=' + this.value;
	});

	if ($('#date').val() == '') {
		alert('Необхідно заповнити дату');
		return;
	} else if ($('#agreements_id options:selected').val() == '') {
		alert('Необхідно вибрати номер договору!');
		return;
	} else if ($('input[name=itemsPrice]').val() == '') {
		alert('Необхідно заповнити мінімальну страхову суму!');
		return;
	} else if (financial_institutions_id == '') {
		alert('Необхідно вибрати банки!');
		return;
	}

	$.ajax({
		type:		'POST',
		url:		'index.php',
		dataType:	'html',
		data:		'do=ReinsuranceBorderoPremiums|loadItemsInWindow' +
					'&date=' + $('#date_year').val() + '-' + $('#date_month').val() + '-' + $('#date_day').val() +
					'&agreements_id=' + $('#agreements_id').val() +
					'&itemsPrice=' + $('input[name=itemsPrice]').val() +
					financial_institutions_id,
		success:    function(result) {
						$('#result').html(result);
					}
	});
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
                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
								<table cellspacing="5" cellpadding="0">
								<tr>
									<td class="label"><?=$this->getMark()?>Дата:</td>
									<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year'], $data['date_month'], $data['date_day'], 'date')?></td>
									<td rowspan="3" class="label" style="width: 100px;"><?=$this->getMark()?>Банки:</td>
									<td rowspan="3">
									<?
											echo '<select id="financial_institutions_id" name="financial_institutions_id[]" class="fldSelect " onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" size="5" multiple>';
											echo '<option value="0">без банку</option>';
											foreach ($data['financial_institutions'] as $financial_institution) {
												echo '<option value="' . $financial_institution['id'] . '" >' . $financial_institution['title'] . '</option>';
											}
											echo '</select>';
									?>
									</td>
									<td rowspan="3" style="vertical-align: middle;"><input type="button" value=" Завантажити  " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="loadItems()"/></td>
								</tr>
								<tr>
									<td class="label"><?=$this->getMark()?>Договір:</td>
									<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('agreements_id') ], $data['agreements_id'], null, null, null, $data)?></td>
								</tr>
								<tr>
									<td class="label"><?=$this->getMark()?>Мінімальна страхова сума, грн.:</td>
									<td><input type="text" name="itemsPrice" value="<?=$data['itemsPrice']?>" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';" /></td>
								</tr>
								</table>
								<div id="result"></div>
								<?
									if ($action != 'view') {
								?>
								<table cellpadding="2" cellspacing="0" width="100%">	
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                    </tr>
                                </table>
								<?
									}
								?>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>