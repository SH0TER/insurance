<?
	foreach($list as $row){
		echo '<input type="radio" name="application_risks_id" value="' . $row['risks_id'] . '"' . (($row['risks_id'] == $data['application_risks_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true, $data['action'] == 'view') . ' onclick="setRisk()" /><b>' . $row['title'] . '</b></td>';
    }
?>
<br /><br />
<div id="risks<?=RISKS_DTP?>" style="display: <?=($data['application_risks_id'] == RISKS_DTP) ? 'block' : 'none'?>" name="risks">
	<select name="types_id" class="fldSelect" onChange="changeTypeDTP(this.value)" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true, $data['action'] == 'view')?>>
		<option value="1" <?=($data['types_id'] == 1) ? 'selected': ''?>>1 ТЗ</option>
		<option value="2" <?=($data['types_id'] == 2) ? 'selected': ''?>>2-3 ТЗ</option>
		<option value="3" <?=($data['types_id'] == 3) ? 'selected': ''?>>Пішохід</option>
		<option value="4" <?=($data['types_id'] == 4) ? 'selected': ''?>>Велосипед</option>
	</select><br /><br />
</div>

<script type="text/javascript">
function setRisk() {
	$('div[name=risks]').css('display', 'none');

	var risksId = $('input[type=radio][name=application_risks_id]:checked').val();

	$('#risks' + risksId).css('display', 'block');
	
	fields['blockRisks']['application_risks_id']['valid'] = true;
	
	switch (risksId) {
		case '1':
			if ($('select[name=types_id]:selected').val() == 2) {
				$('#blockEuroprotocol').show();
				fields['blockMessageAbout']['europrotocol']['check'] = true;
				if ($('input[name=europrotocol]:checked').val() == 1) {
					fields['blockMessageAbout']['accident_schemes_id']['check'] = true;
					fields['blockMessageAbout']['applicant_insurer_company']['check'] = true;
					fields['blockMessageAbout']['applicant_policies_series']['check'] = true;
					fields['blockMessageAbout']['applicant_policies_number']['check'] = true;
				}
			}			
			break;
		default:
			$('#blockEuroprotocol').hide();
			fields['blockMessageAbout']['europrotocol']['check'] = false;
			fields['blockMessageAbout']['accident_schemes_id']['check'] = false;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = false;
			break;
	}
	
	checkFields(null);	
}

function changeTypeDTP(value) {
	switch(value) {
		case '1':
			if (checkFields('blockDriver')) {
				$('.blockParticipants').show();				
			}
			$('#blockEuroprotocol').hide();
			fields['blockMessageAbout']['europrotocol']['check'] = false;
			fields['blockMessageAbout']['accident_schemes_id']['check'] = false;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = false;
			break;
		case '2':
			if (checkFields('blockDriver')) {
				$('.blockParticipants').show();				
			}
			$('#blockEuroprotocol').show();
			fields['blockMessageAbout']['europrotocol']['check'] = true;
			if ($('input[name=europrotocol]:checked').val() == 1) {
				fields['blockMessageAbout']['accident_schemes_id']['check'] = true;
				fields['blockMessageAbout']['applicant_insurer_company']['check'] = true;
				fields['blockMessageAbout']['applicant_policies_series']['check'] = true;
				fields['blockMessageAbout']['applicant_policies_number']['check'] = true;
			}
			break;
		case '3':
			$('.blockParticipants').hide();
			$('#blockEuroprotocol').hide();
			fields['blockMessageAbout']['europrotocol']['check'] = false;
			fields['blockMessageAbout']['accident_schemes_id']['check'] = false;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = false;
			fields['blockDriver']['driver_lastname'] = false;
			fields['blockDriver']['driver_firstname'] = false;
			fields['blockDriver']['driver_patronymicname'] = false;
		default:
			$('.blockParticipants').hide();
			$('#blockEuroprotocol').hide();
			fields['blockMessageAbout']['europrotocol']['check'] = false;
			fields['blockMessageAbout']['accident_schemes_id']['check'] = false;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = false;
			break;
	}
}
</script>