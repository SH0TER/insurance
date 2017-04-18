<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />
<script type="text/javascript">
	var institutions_information = new Array();
	var institutions_information_list = {};
	var type = 2;

	function setRegistrationCarServicesId() {
		$('#car_services_id_hidden').val(<?=$data['car_services_id']?>);

	}

	function getCitiesList() {
		$.ajax({
			type:	    'POST',
			url:	    'index.php',
			dataType:   'script',
			data:	    'do=Reports|getFinancialInstitutionsOrCarServicesInWindow' +
						'&institution_type=' + type,
			success: function(result) {
				institutions_information_list.results = institutions_information;
				institutions_information_list.total = institutions_information.length;
				if(type == 1){
					$('#financial_institutions_id').flexbox(institutions_information_list, {
						allowInput: true,
						width: 400,
						paging: false,
						maxVisibleRows: 8,
						maxCacheBytes: 0,
						noResultsText: 'Результатів не знайдено',
						compare: function(elem){
								return true;
						}
					});
					setRegistrationFinancialInstitutionsId();
					$('#financial_institutions_id_input').val($('input[name=financial_institutions_title]').val());

				}
				else{
					$('#car_services_id').flexbox(institutions_information_list, {
						allowInput: true,
						width: 400,
						paging: false,
						maxVisibleRows: 8,
						maxCacheBytes: 0,
						noResultsText: 'Результатів не знайдено',
						compare: function(elem){
								return true;
						}
					});
					setRegistrationCarServicesId();
					$('#car_services_id_input').val($('input[name=car_services_title]').val());

				}
			}

		});
	}
   
	$(document).ready(function() {
        getCitiesList();
	});

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
            <td class="caption">Калькуляції по страховим справам:</td>
        </tr>
        <tr>
            <td></td>
            <td align="right">
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>'?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="<?=$this->object?>|getCarServicesCalculationByAccidentMessages" />
					<input type="hidden" name="InWindow" value="1" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>                          
                            <td align="right">
                                <table>
                                    <tr>
										<td>
											<b>СТО, калькуляція:</b> <div id="car_services_id"></div>
										</td>
                                        <td>
											<table>
												<tr>
													<td><b>Дата заявки експерту (з):</b></td>
													<td><input type="text" id="fromCreated" name="fromCreated" value="<?=$data['fromCreated']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>(по):</b></td>
													<td><input type="text" id="toCreated" name="toCreated" value="<?=$data['toCreated']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>Дата погодження заявки (з):</b></td>
													<td><input type="text" id="fromDecision" name="fromDecision" value="<?=$data['fromDecision']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>(по):</b></td>
													<td><input type="text" id="toDecision" name="toDecision" value="<?=$data['toDecision']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
												</tr>
												<tr>
													<td><b>Дата запиту рахунку (з):</b></td>
													<td><input type="text" id="fromAccountRequestDate" name="fromAccountRequestDate" value="<?=$data['fromAccountRequestDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>(по):</b></td>
													<td><input type="text" id="toAccountRequestDate" name="toAccountRequestDate" value="<?=$data['toAccountRequestDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>Дата отримання рахунку (з):</b></td>
													<td><input type="text" id="fromAccountAnswerDate" name="fromAccountAnswerDate" value="<?=$data['fromAccountAnswerDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
													<td><b>(по):</b></td>
													<td><input type="text" id="toAccountAnswerDate" name="toAccountAnswerDate" value="<?=$data['toAccountAnswerDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
												</tr>
											</table>
										</td>
										<td><input type="submit" value="Експорт" class="button"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>                        
                    </table>
                </form>
            </td>
        </tr>
    </table>
</div>