 <script type="text/javascript">
function showSearchClientForm() {
	if ( $('input[name=showSearchClient]').attr('checked') ) {
		$('.searchClientBlock').css('display', 'block');
	} else {
		$('.searchClientBlock').css('display', 'none');
	}
}

function searchClient() {
	$.ajax({
		type:		'POST',
		url:		'index.php',
		dataType:	'html',
		data:		'do=Clients|searchClientInWindow' +
					'&id=' + $('input[name=id]').val() +
					'&product_types_id=' + $('input[name=product_types_id]').val() +
					'&policies_number=' + $('input[name=policies_number]').val() +
					'&identification_code=' + $('input[name=identification_code]').val(),
	success:    function(result) {
					$('#searchResult').html(result);

					if (parseInt($('input[name=parent_id]').val())) {
						$('#loadPoliceButton').attr('disabled', false);
					} else {
						$('#loadPoliceButton').attr('disabled', true);
					}
				}
	});
}
function loadPolice() {
} 
</script>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
	<input type="hidden"  name="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="do" value="Policies|loadPolicy" />
	<input type="hidden" name="action" value="insert" />
	<input type="hidden" name="types_id" value="1" />
	<div class="section"><input type="checkbox" name="showSearchClient" value="1" onclick="showSearchClientForm()" <?=$this->getReadonly(true)?>/> Пошук клiента для повторного страхування</div>

	<table class="searchClientBlock" style="display: none" cellpadding="0" cellspacing="5">
	<tr>
		<td class="label grey">Номер полiсу:</td>
		<td width="150"><input type="text" name="policies_number" value="<?=$data['policies_number']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
		<td class="label grey">IПН(ЄДРПОУ):</td>
		<td width="150"><input type="text" name="identification_code" value="<?=$data['identification_code']?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(true)?> /></td>
		<td><input type="button" value=" Знайти" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="searchClient()" /></td>
		<td><input id="loadPoliceButton" type="submit" value=" Завантажити " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" disabled /></td>
	</tr>
	</table>
	<div id="searchResult" style="padding: 5px;"></div>
</form>