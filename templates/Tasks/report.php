<? $Log->showSystem() ?>

<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script><link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />
<script>

	var institutions_information = new Array();
    var institutions_information_list = {};
	
	$(document).ready(function(){
		$('#old').hide();
	
		$('select[name=type]').change(function(){
			$('#old').toggle();
			$('#new').toggle();
		});
		
		$.ajax({
			type:	    'POST',
			url:	    'index.php',
			dataType:   'script',
			data:	    'do=CarServices|getCarServicesInWindow',
			success: function(result) {
				institutions_information_list.results = institutions_information;
				institutions_information_list.total = institutions_information.length;
				$('#car_services_accidents_id').flexbox(institutions_information_list, {
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
			}
		});
		
		$.ajax({
			type:	    'POST',
			url:	    'index.php',
			dataType:   'script',
			data:	    'do=CarServices|getCarServicesInWindow',
			success: function(result) {
				institutions_information_list.results = institutions_information;
				institutions_information_list.total = institutions_information.length;
				$('#car_services_payment_id').flexbox(institutions_information_list, {
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
			}
		});
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
            <td class="caption">Звіт. Дзвінки. Відновлювальний ремонт:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="do" value="Tasks|reportInWindow" />
                    <input type="hidden" name="report" value="1" />
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="28">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="left">
                                            <table cellpadding="0" cellspacing="5">
												<tr>
													<td>
														<select name="type" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
															<option value="1" selected>Новий</option>
															<option value="2">Старий</option>
														</select>
													</td>
													<td id="old">
														<table>
															<tr>
																<td><b>Тип звіту :</b></td>
																<td>
																	<select id="report_type" name="report_type" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
																		<option value="1" selected="selected">По першому дзвінку</option>
																		<option value="2" selected="selected">По даті планового закінчення ремонту</option>
																	</select>
																</td>
																<td><b>Дата :</b></td>
																<td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
																<td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>																
															</tr>
														</table>
													</td>
													<td id="new">
														<table>
															<tr>
																<td><b>Прийом заяви, СТО:</b></td>
																<td><div id="car_services_accidents_id"></div></td>																
															
																<td><b>Дата виконання задачі:</b></td>
																<td>&nbsp;з</td><td><input type="text" id="fromDateTask<?=$this->objectTitle?>" name="fromDateTask" value="<?=$data['fromDateTask']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
																<td nowrap>&nbsp;до</td><td><input type="text" id="toDateTask<?=$this->objectTitle?>" name="toDateTask" value="<?=$data['toDateTask']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>																
																
																<td><b>Результат дзвінка:</b></td>
																<td>
																	<select name="task_statuses_call_id" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
																		<option>...</option>
																		<option value="1">Недозвон</option>
																		<option value="2">Дозвон</option>
																	</select>
																</td>
																
																<td><b>Дата виплати:</b></td>
																<td>&nbsp;з</td><td><input type="text" id="fromDatePayment<?=$this->objectTitle?>" name="fromDatePayment" value="<?=$data['fromDatePayment']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
																<td nowrap>&nbsp;до</td><td><input type="text" id="toDatePayment<?=$this->objectTitle?>" name="toDatePayment" value="<?=$data['toDatePayment']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>																
																
																<td><b>Регіон:</b></td>
																<td>
																	<select name="type_region" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
																		<option>...</option>
																		<option value="1">Київ1</option>
																		<option value="2">Регіони</option>
																	</select>
																</td>
																
																<td><b>Клас ремонту:</b></td>
																<td>
																	<select name="repair_classifications_id" class="fldSelect" onblur="this.className = 'fldSelectOver';" onfocus="this.className = 'fldSelect';">
																		<option>...</option>
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td><b>Отримувач, СТО:</b></td>
																<td><div id="car_services_payment_id"></div></td>
															</tr>
														</table>
													</td>
													<td valign="bottom">&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
												</tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                </form>
            </td>
        </tr>
    </table>
</div>