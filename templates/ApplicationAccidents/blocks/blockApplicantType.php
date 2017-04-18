<div class="blockApplicantType">
	<div class="section">Сторона, що заявляє про подію від:</div>
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td><input type="radio" name="owner_types_id" value="1" <?=(($data['owner_types_id'] == 1) ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>страхувальника</b></td>
			<td><input type="radio" name="owner_types_id" value="2" <?=(($data['owner_types_id'] == 2) ? 'checked' : '')?> <?=$this->getReadonly(true)?> /><b>потерпілого</b></td>
		</tr>
	</table>
</div>
