 <script>
 function showSearchClientForm()
 {
	if (document.getElementById('showSearchClient').checked)
	{
		document.getElementById('searchClientBlock').style.display = '';
	}
	else
		document.getElementById('searchClientBlock').style.display	= 'none';
 }
 
 function searchClient()
 {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'html',
				data:		'do=Clients|searchClientInWindow' +
							'&id=' + getElementValue('id') +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&policies_number=' + getElementValue('policies_number') +
							'&shassi=' + getElementValue('shassi') +
							'&identification_code=' + getElementValue('identification_code') +
							'&passport_series=' + getElementValue('passport_series') +
							'&passport_number=' + getElementValue('passport_number') ,
				success:    function(result) {
								$('#searchResult').html(result);
								if (parseInt($('input[name=parent_id]').val()))
									$('#loadPoliceButton').attr('disabled',false);
								else
									$('#loadPoliceButton').attr('disabled',true);
									
							}
			});
 }

function loadPolice()
{
} 
 </script>
 
 <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
 <input type="checkbox" name="showSearchClient" id="showSearchClient" value="1" onclick="showSearchClientForm()" <?=$this->getReadonly(true)?>> <b>Пошук клiента для повторного страхування</b>
 <input type="hidden"  name="product_types_id" value="<?=$data['product_types_id']?>" />
 <input type="hidden" name="do" value="Policies|loadPolicy" />
 <input type="hidden" name="prolongation" value="1" />
 <input type="hidden" name="action" value="insert" />
 <input type="hidden" name="types_id" value="1" />

  <div id="searchClientBlock" style="display: none">
		<table   cellpadding="0" cellspacing="5">
        <tr>
			<td class="label grey">Номер полiсу:</td>
            <td><input style="width:120px;" type="text" id="policies_number" name="policies_number" value="<?=$data['policies_number']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
            <td class="label grey">Номер кузова:</td>
            <td><input style="width:120px;" type="text" id="shassi" name="shassi" value="<?=$data['shassi']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
            <td class="label grey">IПН:</td>
            <td><input style="width:120px;" type="text" id="identification_code" name="identification_code" value="<?=$data['identification_code']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
		</tr>
		</table>
		<table   cellpadding="0" cellspacing="5">
		<tr>
			<td class="label grey">Паспорт серiя:</td>
			<td><input type="text" id="passport_series" name="passport_series" value="<?=$data['passport_series']?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> /></td>
			<td class="label grey">Паспорт номер:</td>
			<td><input type="text" id="passport_number" name="passport_number" value="<?=$data['passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
			<td><input type="button" value=" Знайти" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="searchClient()" /></td>
			<td><input id="loadPoliceButton" disabled type="submit" value=" Завантажити" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="loadPolice()" /></td>
		</tr>
	</table>
  </div>
  <div id="searchResult" style="padding-left:15px;font-weight:bold"></div>
 </form>
 
