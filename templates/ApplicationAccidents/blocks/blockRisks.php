<div class="blockRisks" style="display: <?=($data['id'] ? 'block' : 'none')?>">
	<div class="section">Ризик, тип події, ступінь тяжкості наслідків:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td colspan="2">
				<div id="risks"></div>
			</td>
		</tr>
		<tr>
			<td id="blockVictimInfo" colspan="2" style="display: <?=($data['owner_types_id'] == 2 ? 'block' : 'none');?>">
				<table>
					<tr>
						<td style="text-align: left;" class="label grey"><b>Прізвище, ім'я, по батькові потерпілої особи:</b> <input type="text" id="victim_name" name="victim[name]" value="<?=$data['victim']['name']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(true)?> /></td>
					</tr>
					<tr><td><input value="1" <?=($data['victim']['car']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="victim_car" name="victim[car][flag]" onchange="changeVictimRisks(this.checked, 'car')" <?=$this->getReadonly(true)?> /> <b>Транспортний засіб</b>
					<tr id="victim_car_info" style="display: <?=($data['victim']['car']['flag'] == 1 ? 'block' : 'none')?>;">
						<td>
							<table cellpadding="5" cellspacing="0">
								<tr>									
									<td class="grey">Тип ТЗ:</td>
									<td>
										<!--select id="victim_car_type_id" name="victim[car][data][car_type_id]" class="fldSelect" value="" onchange="setBrandsCars(this.id)" /></select-->
										<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('victim_car_type_id') ], "", $data['languageCode'], $this->getReadonly(true) . ' onchange="setBrandsCars(this.id)"', null, $data)?>
									</td>
									<td class="grey">Марка:</td>
									<td><select id="victim_brand_id" name="victim[car][data][brand_id]" class="fldSelect" value="" onchange="setModelsCars(this.id)" <?=$this->getReadonly(true)?> /></select></td>
									<input type="hidden" id="victim_brand" name="victim[car][data][brand]" value="" />
									<td class="grey">Модель:</td>
									<td><select id="victim_model_id" name="victim[car][data][model_id]" class="fldSelect" value="" onchange="setModelTitle(this.id)" <?=$this->getReadonly(true)?> /></select></td>
									<input type="hidden" id="victim_model" name="victim[car][data][model]" value="" />
									<td class="label grey">Державний знак:</td>
									<td><input type="text" id="victim_sign" name="victim[car][data][sign]" value="<?=$data['victim']['car']['data']['sign']?>" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(true)?> /></td>
								</tr>
								<tr>
									<td class="label grey">Пошкодження:</td>
									<td colspan="9"><input type="textarea" id="victim_car_damage" name="victim[car][data][damage]" value="<?=$data['victim']['car']['data']['damage']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td><input value="1" <?=($data['victim']['property']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="victim_property" name="victim[property][flag]" onchange="changeVictimRisks(this.checked, 'property')" <?=$this->getReadonly(true)?> /> <b>Майно</b>
					<tr id="victim_property_info" style="display: <?=($data['victim']['property']['flag'] == 1 ? 'block' : 'none')?>;">
						<td>
							<table>
								<tr>
									<td class="label grey">Назва:</td>
									<td><input type="text" id="victim_property_name" name="victim[property][data][name]" value="<?=$data['victim']['property']['data']['name']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
									<td class="label grey">Адреса:</td>
									<td><input style="width: 500px;" type="text" id="victim_property_address" name="victim[property][data][address]" value="<?=$data['victim']['property']['data']['address']?>" maxlength="50" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
								</tr>
								<tr>
									<td class="label grey">Пошкодження:</td>
									<td colspan="3"><input type="textarea" id="victim_property_damage" name="victim[property][data][damage]" value="<?=$data['victim']['property']['data']['damage']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td><input value="1" <?=($data['victim']['life']['flag'] == 1 ? 'checked' : '')?> type="checkbox" id="victim_life" name="victim[life][flag]" onchange="changeVictimRisks(this.checked, 'life')" <?=$this->getReadonly(true)?> /> <b>Життя/здоров'я</b>
					<tr id="victim_life_info" style="display: <?=($data['victim']['life']['flag'] == 1 ? 'block' : 'none')?>;">
						<td>
							<table>
								<tr>
									<td class="label grey">Ступінь ушкоджень:</td>
									<td>
										<select id="victim_life_damage_id" name="victim[life][data][damage_id]" class="fldSelect" <?=$this->getReadonly(true)?>>
											<option>...</option>
											<option value="1" <?=($data['victim']['life']['data']['damage_id'] == 1 ? 'selected' : '')?>>Тимчасова втрата працездатності(травма)</option>
											<option value="2" <?=($data['victim']['life']['data']['damage_id'] == 2 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 1 групи)</option>
											<option value="3" <?=($data['victim']['life']['data']['damage_id'] == 3 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 2 групи)</option>
											<option value="4" <?=($data['victim']['life']['data']['damage_id'] == 4 ? 'selected' : '')?>>Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)</option>
											<option value="5" <?=($data['victim']['life']['data']['damage_id'] == 5 ? 'selected' : '')?>>Смерть</option>
											<option value="6" <?=($data['victim']['life']['data']['damage_id'] == 6 ? 'selected' : '')?>>Моральна шкода</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="label grey">Пошкодження:</td>
									<td colspan="3"><input type="textarea" id="victim_life_damage" name="victim[life][data][damage]" value="<?=$data['victim']['life']['data']['damage']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table id="blockInsurerDamage" style="display: <?=($data['owner_types_id'] == 1 ? 'block' : 'none');?>">
		<tr>
			<td class="label grey" style="vertical-align: top;"><b>Пошкодження:</b></td>
			<td>
				<textarea name="damage" style="height: 100px; width: 250px;" class="fldNote" onfocus="this.className='fldNoteOver'" onblur="this.className='fldNote'" <?=$this->getReadonly(true)?>><?=$data['damage']?></textarea>
			</td>
		</tr>
	</table>
</div>