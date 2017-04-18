<div class="blockCar" style="display: <?=($data['id'] && $data['victim']['car']['flag'] || $data['id'] && $data['owner_types_id'] == 1 ? 'block' : 'none')?>">
	<div class="section">Транспортний засіб:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td><b>Чи надано авто для огляду:</b></td>
			<td>
				<input type="radio" value="1" name="inspecting_car" onChange="changeInspectingCar(this.value)" <?=($data['inspecting_car'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="inspecting_car" onChange="changeInspectingCar(this.value)" <?=($data['inspecting_car'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>			
			<td>
				<table id="blockInspectingCarInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['inspecting_car'] < 0) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><?=$this->getMark()?>фактична адреса місцезнаходження ТЗ:</td><td><input style="width: 500px;" type="text" name="inspecting_car_place" value="<?=$data['inspecting_car_place']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>