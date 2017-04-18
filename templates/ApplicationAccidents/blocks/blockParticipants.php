<div class="blockParticipants" style="display: <?=($data['id'] && is_array($data['participants']) && sizeOf($data['participants']) ? 'block' : 'none')?>">
	<div class="section">Інші учасники: <? if($action != 'view') { ?><a href="javascript: addParticipant()"><img src="/images/administration/navigation/add_over.gif" alt="Додати" width="19" height="19"></a><? } ?></div>
	<table id="participants" cellpadding="0" cellspacing="0">
	<?
		if (is_array($data['participants'])) {
			$i=0;			
			foreach ($data['participants'] as $row) {echo "<script>participants_cars[" . $i . "] = new Array('" . $row['car']['data']['car_type_id'] . "', '" . $row['car']['data']['brand_id'] . "', '" . $row['car']['data']['model_id'] ."');</script>\r\n";
	?>
		<tr id="participants<?=$i?>">
			<td>
				<table>
					<tr>
						<td style="text-align: left;" class="label grey">Прізвище, ім'я, по батькові:<input type="text" id="participants<?=$i?>_name" name="participants[<?=$i?>][name]" value="<?=$row['name']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
					</tr>
					<tr><td colspan="2"><input value="1" <?=($row['car']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="participants<?=$i?>_car" name="participants[<?=$i?>][car][flag]" onchange="changeParticipant(this.checked, <?=$i?>, 'car')" <?=$this->getReadonly(true)?> /> <b>Транспортний засіб</b>
					<tr id="participants<?=$i?>_car_info" style="display: <?=($row['car']['flag'] == 1 ? 'block' : 'none')?>;">
						<td>
							<table cellpadding="5" cellspacing="0">
								<tr>									
									<td class="grey">Тип ТЗ:</td>
									<td><select id="participants<?=$i?>car_car_type_id" name="participants[<?=$i?>][car][data][car_type_id]" class="fldSelect" value="" onchange="setBrandsCars(this.id)" <?=$this->getReadonly(true)?> /></select></td>
									<td class="grey">Марка:</td>
									<td><select id="participants<?=$i?>car_brand_id" name="participants[<?=$i?>][car][data][brand_id]" class="fldSelect" value="" onchange="setModelsCars(this.id)" <?=$this->getReadonly(true)?> /></select></td>
									<input type="hidden" id="participants<?=$i?>car_brand" name="participants[<?=$i?>][car][data][brand]" value="" />
									<td class="grey">Модель:</td>
									<td><select id="participants<?=$i?>car_model_id" name="participants[<?=$i?>][car][data][model_id]" class="fldSelect" value="" onchange="setModelTitle(this.id)" <?=$this->getReadonly(true)?> /></select></td>
									<input type="hidden" id="participants<?=$i?>car_model" name="participants[<?=$i?>][car][data][model]" value="" />
									<td class="label grey">Державний знак:</td>
									<td><input type="text" id="participants<?=$i?>car_sign" name="participants[<?=$i?>][car][data][sign]" value="<?=$row['car']['data']['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
								</tr>
								<tr>
									<td class="label grey">Пошкодження:</td>
									<td colspan="9"><input type="text" id="participants<?=$i?>car_damage" name="participants[<?=$i?>][car][data][damage]" value="<?=$row['car']['data']['damage']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td><input value="1" <?=($row['property']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="participants<?=$i?>_property" name="participants[<?=$i?>][property][flag]" onchange="changeParticipant(this.checked, <?=$i?>, 'property')" <?=$this->getReadonly(true)?> /> <b>Майно</b>
					<tr id="participants<?=$i?>_property_info" style="display: <?=($row['property']['flag'] == 1 ? 'block' : 'none')?>;">
						<td>
							<table>
								<tr>
									<td class="label grey">Назва:</td>
									<td><input type="text" id="participants<?=$i?>property_name" name="participants[<?=$i?>][property][data][name]" value="<?=$row['property']['data']['name']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
									<td class="label grey">Адреса:</td>
									<td><input type="text" id="participants<?=$i?>property_address" name="participants[<?=$i?>][property][data][address]" value="<?=$row['property']['data']['address']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
									<td class="label grey">Пошкодження:</td>
									<td><input type="text" id="participants<?=$i?>property_damage" name="participants[<?=$i?>][property][data][damage]" value="<?=$row['property']['data']['damage']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td><input value="1" <?=($row['life']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="participants<?=$i?>_life" name="participants[<?=$i?>][life][flag]" onchange="changeParticipant(this.checked, <?=$i?>, 'life')" <?=$this->getReadonly(true)?> /> <b>Життя/здоров'я</b>
					<tr id="participants<?=$i?>_life_info" style="display: <?=($row['life']['flag'] == 1 ? 'block' : 'none')?>;">
						<td>
							<table>
								<tr>
									<td class="label grey">Ступінь ушкоджень:</td>
									<td>
										<select id="participants<?=$i?>life_damage_id" name="participants[<?=$i?>][life][data][damage_id]" class="fldSelect" <?=$this->getReadonly(true)?> >
											<option>...</option>
											<option value="1" <?=($row['life']['data']['damage_id'] == 1 ? 'selected' : '')?>>Тимчасова втрата працездатності(травма)</option>
											<option value="2" <?=($row['life']['data']['damage_id'] == 2 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 1 групи)</option>
											<option value="3" <?=($row['life']['data']['damage_id'] == 3 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 2 групи)</option>
											<option value="4" <?=($row['life']['data']['damage_id'] == 4 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)</option>
											<option value="5" <?=($row['life']['data']['damage_id'] == 5 ? 'selected' : '')?>>Смерть</option>
											<option value="6" <?=($row['life']['data']['damage_id'] == 6 ? 'selected' : '')?>>Моральна шкода</option>
										</select>
									</td>
									<td class="label grey">Пошкодження:</td>
									<td><input type="text" id="participants<?=$i?>life_damage" name="participants[<?=$i?>][life][data][damage]" value="<?=$row['life']['data']['damage']?>" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				</table>
			</td>
			<? if ($this->mode == 'update') {?><td><a href="javascript: deleteParticipant(<?=$i?>)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
		</tr>
	<?
				$script = "<script>
								var p = {									
									'car_type_id': {'check': true, 'valid': false},
									'brand_id': {'check': true, 'valid': false},
									'model_id': {'check': true, 'valid': false},
									'sign': {'check': true, 'valid': false},
									'damage': {'check': true, 'valid': false}
								};
								
							fields['blockParticipants'][$i] = {};
							
							fields['blockParticipants'][$i]['name'] = {'check': true, 'valid': false};
							
							fields['blockParticipants'][$i]['car'] = p;
							
							$('#participants' + $i + '_name').bind(
								'change', function() {
									if (this.value.length) {
										fields['blockParticipants'][$i]['name']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['name']['valid'] = false;
									showPrompt(this, 'Введіть \'Прізвище, ім\'я, по батькові\'.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);

							$('#participants' + $i + 'car_car_type_id').bind(
								'change', function() {
									if (parseInt(this.value) > 0) {
										fields['blockParticipants'][$i]['car']['car_type_id']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['car']['car_type_id']['valid'] = false;
									$(this).blur();
									showPrompt(this, 'Потрібно вибрати тип ТЗ.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'car_brand_id').bind(
								'change', function() {
									if (parseInt(this.value) > 0) {
										fields['blockParticipants'][$i]['car']['brand_id']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['car']['brand_id']['valid'] = false;
									$(this).blur();
									showPrompt(this, 'Потрібно вибрати марку ТЗ.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'car_model_id').bind(
								'change', function() {
									if (parseInt(this.value) > 0) {
										fields['blockParticipants'][$i]['car']['model_id']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['car']['model_id']['valid'] = false;
									$(this).blur();
									showPrompt(this, 'Потрібно вибрати модель ТЗ.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'car_sign').bind(
								'change', function() {
									if (this.value.length && isValidSign(fixSignSimbols(this.value))) {
										fields['blockParticipants'][$i]['car']['sign']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['car']['sign']['valid'] = false;
									showPrompt(this, 'Введіть номер ТЗ.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'car_damage').bind(
								'change', function() {
									if (this.value.length) {
										fields['blockParticipants'][$i]['car']['damage']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['car']['damage']['valid'] = false;
									showPrompt(this, 'Введіть пошкодження.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							
							//property
							var p = {
									'name': {'check': true, 'valid': false},
									'address': {'check': true, 'valid': false},
									'damage': {'check': true, 'valid': false}
								};
								
							fields['blockParticipants'][$i]['property'] = p;
								
							$('#participants' + $i + 'property_name').bind(
								'change', function() {
									if (this.value.length) {
										fields['blockParticipants'][$i]['property']['name']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['property']['name']['valid'] = false;
									showPrompt(this, 'Введіть назву майна.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'property_address').bind(
								'change', function() {
									if (this.value.length) {
										fields['blockParticipants'][$i]['property']['address']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['property']['address']['valid'] = false;
									showPrompt(this, 'Введіть адресу майна.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'property_damage').bind(
								'change', function() {
									if (this.value.length) {
										fields['blockParticipants'][$i]['property']['damage']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['property']['damage']['valid'] = false;
									showPrompt(this, 'Введіть пошкодження майна.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							
							//life
							var p = {
									'damage_id': {'check': true, 'valid': false},
									'damage': {'check': true, 'valid': false}
								};
								
							fields['blockParticipants'][$i]['life'] = p;
							
							$('#participants' + $i + 'life_damage_id').bind(
								'change', function() {
									if (parseInt(this.value) > 0) {
										fields['blockParticipants'][$i]['life']['damage_id']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['life']['damage_id']['valid'] = false;
									$(this).blur();
									showPrompt(this, 'Потрібно вибрати ступінь ушкоджень');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
							$('#participants' + $i + 'life_damage').bind(
								'change', function() {
									if (this.value.length) {
										fields['blockParticipants'][$i]['life']['damage']['valid'] = true;
										checkFields(null);
										return;
									}
									fields['blockParticipants'][$i]['life']['damage']['valid'] = false;
									showPrompt(this, 'Введіть пошкодження особи.');
									$(this).bind(
										'focus', function() {
											$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
										}
									);
								}
							);
						   </script>";				
				echo $script;
				$i++;
			}
		}
	?>
	</table>
</div>
<script>changeParticipantsRowStyle()</script>