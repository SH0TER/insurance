<div class="blockMessageAbout" style="display: <?=($data['id'] ? 'block' : 'none')?>">
	<div class="section">Повідомлено:</div>
	<table id="blockEuroprotocol" cellpadding="5" cellspacing="5" style="display: <?=($data['europrotocol'] != 0 && $data['types_id'] == 2 ? 'block' : 'none')?>" >
		<tr>
			<td><b>Чи було складено європротокол:</b></td>
			<td>
				<input type="radio" value="1" name="europrotocol" onChange="changeEuroprotocol(this.value)" <?=($data['europrotocol'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="europrotocol" onChange="changeEuroprotocol(this.value)" <?=($data['europrotocol'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>
			<td>
				<table id="blockEuroprotocolInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['europrotocol'] == 1) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><b>Схема ДТП:</b></td>
						<td>
							<select name="accident_schemes_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?> >
								<option value="">...</option>
								<option value="1" <?=($data['accident_schemes_id'] == 1) ? 'selected' : ''?>>Схема1</option>
								<option value="2" <?=($data['accident_schemes_id'] == 2) ? 'selected' : ''?>>Схема2</option>
								<option value="3" <?=($data['accident_schemes_id'] == 3) ? 'selected' : ''?>>Схема3</option>
								<option value="4" <?=($data['accident_schemes_id'] == 4) ? 'selected' : ''?>>Схема4</option>
								<option value="5" <?=($data['accident_schemes_id'] == 5) ? 'selected' : ''?>>Схема5</option>
								<option value="6" <?=($data['accident_schemes_id'] == 6) ? 'selected' : ''?>>Схема6</option>
								<option value="7" <?=($data['accident_schemes_id'] == 7) ? 'selected' : ''?>>Схема7</option>
							</select>
						</td>
						<td class="label grey"><b>Страховик заявника:</b></td>
						<td><input type="text" id="applicant_insurer_company" name="applicant_insurer_company" value="<?=$data['applicant_insurer_company']?>" maxlength="100" class="fldText" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
						<td class="label grey"><b>Серія поліса:</b></td>
						<td><input type="text" id="applicant_policies_series" name="applicant_policies_series" value="<?=$data['applicant_policies_series']?>" maxlength="4" class="fldText" style="width: 50px;" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
						<td class="label grey"><b>Номер поліса:</b></td>
						<td><input type="text" id="applicant_policies_number" name="applicant_policies_number" value="<?=$data['applicant_policies_number']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table id="blockCompetentAuthorities" cellpadding="5" cellspacing="5">
		<tr>
			<td><b>Чи було повідомлено в компетентні органи:</b></td>
			<td>
				<input type="radio" value="1" name="competent_authorities" onChange="changeCompetentAuthorities(this.value)" <?=($data['competent_authorities'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="competent_authorities" onChange="changeCompetentAuthorities(this.value)" <?=($data['competent_authorities'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>
			<td>
				<select name="competent_authorities_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onChange="changeCompetentAuthoritiesId(this.value)" style="display: <?=($data['competent_authorities'] == 1 ? 'block' : 'none')?>" <?=$this->getReadonly(true)?> >
					<option value=""><b>...</b></option>
					<option value="1" <?=($data['competent_authorities_id'] == 1) ? 'selected' : ''?>><b>Органи ДАІ</b></option>
					<option value="2" <?=($data['competent_authorities_id'] == 2) ? 'selected' : ''?>><b>Органи МВС</b></option>
					<option value="3" <?=($data['competent_authorities_id'] == 3) ? 'selected' : ''?>><b>МНС</b></option>
					<option value="4" <?=($data['competent_authorities_id'] == 4) ? 'selected' : ''?>><b>Поліція</b></option>
				</select>
			</td>
			<td></td>
			<td>
				<table id="blockCompetentAuthoritiesInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['competent_authorities_id'] > 0) ? 'block' : 'none'?>" <?=$this->getReadonly(true)?> >
					<tr>
						<td id="daiYes" style="display: <?=($data['competent_authorities_id'] == 1) ? 'block' : 'none'?>">
							<div id="mvs_id" style="display: block;" ></div>
							<!--?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ], $data['mvs_id'], $data['languageCode'], 'style="width: 390px;" ' . $this->getReadonly(true), null, $data)?-->
						</td>
						<td id="daiNo" style="display: <?=($data['competent_authorities_id'] > 1) ? 'block' : 'none'?>">
							<input type="text" id="mvs_title" name="mvs_title" value="<?=($data['competent_authorities_id'] > 1) ? $data['mvs_title'] : ''?>" maxlength="100" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly()?> />
						</td>
						<td class="label grey"><b>Дата:</b></td>
						<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ], $data[ 'mvs_date_year' ], $data[ 'mvs_date_month' ], $data[ 'mvs_date_day' ], 'mvs_date', $this->getReadonly(true))?></td>							
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table id="blockAministrativeProtocol" cellpadding="5" cellspacing="5" style="display: <?=($data['competent_authorities_id'] == 1 || $data['competent_authorities_id'] == 4) ? 'block' : 'none'?>">
		<tr>
			<td><b>Чи було складено адміністративний протокол на водія:</b></td>
			<td>
				<input type="radio" value="1" name="administrativeprotocol" onChange="changeAministrativeProtocol(this.value)" <?=($data['administrativeprotocol'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="administrativeprotocol" onChange="changeAministrativeProtocol(this.value)" <?=($data['administrativeprotocol'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>
			<td>
				<table id="blockAministrativeProtocolInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['administrativeprotocol'] == 1) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><b>Серія:</b></td>
						<td><input type="text" id="administrative_protocol_series" name="administrative_protocol_series" value="<?=$data['administrative_protocol_series']?>" maxlength="4" class="fldText lastname" style="width: 50px;" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
						<td class="label grey"><b>Номер:</b></td>
						<td><input type="text" id="administrative_protocol_number" name="administrative_protocol_number" value="<?=$data['administrative_protocol_number']?>" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table id="blockUnifiedStateRegister" cellpadding="5" cellspacing="5" style="display: <?=($data['competent_authorities_id'] == 2) ? 'block' : 'none'?>">
		<tr>
			<td><b>Чи були внесені відомості про подію до ЄДРДР:</b></td>
			<td>
				<input type="radio" value="1" name="unifiedstateregister" <?=($data['unifiedstateregister'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="unifiedstateregister" <?=($data['unifiedstateregister'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>
		</tr>
	</table>
	<table id="blockCriminal" cellpadding="5" cellspacing="5" style="display: <?=($data['competent_authorities_id'] == 1 || $data['competent_authorities_id'] == 2 || $data['competent_authorities_id'] == 4) ? 'block' : 'none'?>">
		<tr>
			<td><b>Чи було відкрито кримінальне провадження:</b></td>
			<td>
				<input type="radio" value="1" name="criminal" onChange="changeCriminal(this.value)" <?=($data['criminal'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>так</b>
				<input type="radio" value="-1" name="criminal" onChange="changeCriminal(this.value)" <?=($data['criminal'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> ><b>ні</b>
			</td>
			<td>
				<table id="blockCriminalInfo" cellpadding="0" cellspacing="0" style="display: <?=($data['criminal'] == 1) ? 'block' : 'none'?>">
					<tr>
						<td class="label grey"><b>Орган досудового розслідування:</b></td>
						<td><input type="text" id="criminal_name" name="criminal_name" value="<?=$data['criminal_name']?>" class="fldText" style="width: 500px;" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table id="blockAssistance" cellpadding="5" cellspacing="0" style="display: <?=($data['owner_types_id'] == 1) ? 'block' : 'none'?>">
		<tr>
			<td nowrap><b>Чи було повідомлено в диспетчерський центр страховика:</b></td>
			<td>
				<input type="radio" name="assistance" value="1" onclick="showHideAssistanceBlock(this.value)" <?=($data['assistance'] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> <?=$this->getReadonly(true)?> /><b>так</b>
				<input type="radio" name="assistance" value="-1" onclick="showHideAssistanceBlock(this.value)" <?=($data['assistance'] == -1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> <?=$this->getReadonly(true)?> /><b>ні</b>
			</td>
		</tr>
		<tr>
			<td>
				<table id="assistanceYes" cellpadding="0" cellspacing="5" style="display: <?=($data['assistance']) ? 'block' : 'none'?>">
					<tr>
						<td><b>з місця пригоди</b></td>
						<td>
							<input type="radio" name="assistance_place" value="1" <?=($data['assistance_place'] == 1) ? 'checked' : ''?> onclick="showHideAssistanceDate(this.value)" <?=$this->getReadonly(true)?> /><b>так</b>
							<input type="radio" name="assistance_place" value="-1" <?=($data['assistance_place'] == -1) ? 'checked' : ''?> onclick="showHideAssistanceDate(this.value)" <?=$this->getReadonly(true)?> /><b>ні</b>
						</td>
						<td>
							<table id="assistance_dateBlock" cellpadding="0" cellspacing="5" style="display: <?=($data['assistance_place'] == -1) ? 'block' : 'none'?>">
							<tr>
								<td><b>дата:</b></td>
								<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ], $data[ 'assistance_date_year' ], $data[ 'assistance_date_month' ], $data[ 'assistance_date_day' ], 'assistance_date', $this->getReadonly(true))?></td>
							</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>