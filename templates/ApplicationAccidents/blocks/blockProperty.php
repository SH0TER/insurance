<div class="blockProperty" style="display: <?=($data['id'] && $data['victim']['property']['flag'] ? 'block' : 'none')?>">
	<div class="section">Майно:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td><b>Чи потрібно оглянути майно</b></td>
			<td>
				<input type="radio" value="1" name="inspecting_property" onChange="changeInspectingProperty(this.value)" <?=($data['inspecting_property'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="inspecting_property" onChange="changeInspectingProperty(this.value)" <?=($data['inspecting_property'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>			
			<td>
				<table id="blockInspectingPropertyInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['inspecting_property'] > 0) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><?=$this->getMark()?>адреса:</td><td><input style="width: 500px;" type="text" name="inspecting_property_place" value="<?=$data['inspecting_property_place']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>