<script>

	var log = function(value) {
		console.log(value);
	};

	var positionCount = -1;
	
	var servicesJSON = null;
	
	var positions = <? echo json_encode($data['positions']); ?>;
	var action = '<? echo $action; ?>';

	$(document).ready(function(){
	
		//add position
		$('#positionAdd').click(function(){
			addPostition(positionCount, undefined);
			
			positionCount--;
		});
		
		getServices();		
		
	});
	
	//set services by load page
	var setServices = function() {
		
		$.each(positions, function(id, position) {
			addPostition(id, position);
		});
		
	}
	
	//get services
	var getServices = function() {
	
		$.ajax({
			type:       'POST',
			url:        'index.php',
			dataType:   'json',
			data:       'do=DMSCalculation|getServicesInWindow',
			success:    function(result){
				servicesJSON = result;
				setServices();
			}
		});
	
	};
	
	//build select category
	var buildCategoryTypesSelect = function(positionNum) {
		
		var categoryTypesSelect = $("<select />").attr({'name': 'positions[' + positionNum + '][category]', 'positionNum': positionNum});
		categoryTypesSelect.append(new Option("...", -1));
		$.each(servicesJSON, function(id, category) {
			categoryTypesSelect.append(new Option(category.title, category.id));
		});		
		
		return categoryTypesSelect;

	}
	
	//add position into table
	var addPostition = function(id, position) {
		var table = $('#positions');
		var tr = $('<tr />');
		var td = $('<td />');

		//create controls
		var categorySelect = buildCategoryTypesSelect(id);			
		var serviceSelect = $('<select />').attr({'name': 'positions[' + id + '][service]'});		
		var countInput = $('<input />').attr({'name': 'positions[' + id + '][count]', 'type': 'text', 'class': 'fldInteger'});		
		var priceInput = $('<input />').attr({'name': 'positions[' + id + '][price]', 'type': 'text', 'class': 'fldMoney'});
		var removeButton = $('<a><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a>');
		
		//create event listener on categorySelect (onChange)
		categorySelect.change(function(){
			var categoryId = $(this).val();
			var positionNum = $(this).attr('positionNum');

			serviceSelect.children().remove();
			serviceSelect.append(new Option("...", -1));
			
			if (categoryId == -1) return;
			
			$.each(servicesJSON, function(id, category) {
				if (category.id == categoryId) {
					$.each(category.list, function(id, service) {
						serviceSelect.append(new Option(service.title, service.id));
						priceInput.val(null);
					});
					return;
				}
			});
		});
		
		serviceSelect.change(function(){
			var serviceId = $(this).val();
			
			if (serviceId == -1) return;
			
			$.each(servicesJSON, function(id, category) {
				$.each(category.list, function(id, service) {
					if (service.id == serviceId) {
						priceInput.val(service.price);
						return;
					}
				});				
			});
		});

		//append controls into TD
		var tdCategoryTypes = td.clone().append(categorySelect);
		var tdServiceTypes = td.clone().append(serviceSelect);
		var tdPrice = td.clone().append(priceInput);
		var tdCount = td.clone().append(countInput);
		var tdRemove = td.clone().append(removeButton);
		
		//appent TD into TR
		tr.append(td.clone().append("<b>Категорія:</b>"));
		tr.append(tdCategoryTypes);
		tr.append(td.clone().append("<b>Назва:</b>"));
		tr.append(tdServiceTypes);		
		tr.append(td.clone().append("<b>Кількість:</b>"));
		tr.append(tdCount);
		tr.append(td.clone().append("<b>Вартість:</b>"));
		tr.append(tdPrice);
		//tr.append(tdRemove);
		
		if (action == 'view') { 			
			categorySelect.attr({'disabled': true}).css({'background-color': '#dddddd'});
			serviceSelect.attr({'disabled': true}).css({'background-color': '#dddddd'});
			countInput.attr({'disabled': true}).css({'background-color': '#dddddd'});
			priceInput.attr({'disabled': true}).css({'background-color': '#dddddd'});
		} else {
			tr.append(tdRemove);
		}
		
		//append TR into TABLE
		table.append(tr);
		
		$(removeButton).click(function(){
			$(this).parent().parent().remove();
		});
		
		if (position === undefined) return;
		
		categorySelect.val(position.category);
		categorySelect.change();
		serviceSelect.val(position.service);
		countInput.val(position.count);
		priceInput.val(position.price);
		
	}

</script>
<?//_dump($data)?>
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
					<tr><td colspan="2" class="content">Дані:</td></tr>					
					
					<tr>
						<td>
							<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
								<input type="hidden" name="id" value="<?=$data['id']?>" />
								<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
								<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />						
								<table>
									<tr>
										<td class="label">*Період надання послуги:</td>
										<td><input style="width: 150px;" type="text" name="date_input" value="<?=$data["date_input"]?>" <?=$this->getReadOnly()?> /></td>
									</tr>
									<tr>
										<td class="label">*Клініка:</td>
										<td><input style="width: 470px;" type="text" name="clinik" value="<?=$data["clinik"]?>" <?=$this->getReadOnly()?> /></td>
									</tr>
									<tr>
										<td class="label" style="vertical-align: top;">*Діагноз:</td>
										<td><textarea cols="90" rows="6" name="diagnos" <?=$this->getReadOnly()?>><?=$data["diagnos"]?></textarea></td>
									</tr>
									<tr>
										<td class="label"></td>
										<td></td>
									</tr>
									<tr>
										<td class="label">Позиції:</td>
										<td><? if($action != 'view') { ?><a id="positionAdd"><img src="/images/administration/navigation/add_over.gif" alt="Додати" width="19" height="19"></a><? } ?></td>
									</tr>
								</table>
								<table id="positions" style="padding-left: 150px"></table>								
								<table>
									<tr>
										<td width="150">&nbsp;</td>
										<? if ($action != 'view') { ?>
											<td align="center" colspan="3"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
										<? } else { ?>
											<td align="center" colspan="3"><input onclick="location='index.php?do=Policies|view&product_types_id=<?=PRODUCT_TYPES_DMS?>&id=<?=$data['policies_id']?>'" type="button" value=" <?=translate('Back')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
										<? } ?>
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