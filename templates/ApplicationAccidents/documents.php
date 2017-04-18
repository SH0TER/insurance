<script>
	function changeDocument(id, checked){
		if (checked) {
			$('#document_type_title'+id).css('font-weight', 'bolder');
		} else {
			$('#document_type_title'+id).css('font-weight', 'normal');			
		}
	}
</script>
<?

$array = array(151, 12, 13, 55, 149, 61, 62, 63, 73, 19, 150, 51, 157, 152, 153, 154, 155, 158, 15, 159);

$document_types = ProductDocumentTypes::getListByIdx($array);

$count_rows = 11;

?>
<table cellpadding="5" cellspacing="0">
	<? for($i=0; $i<$count_rows; $i++) { ?>
		<tr>
			<? for($j=$i; $j<sizeOf($document_types); $j+=$count_rows) { ?>
				<td width="600">					
					<div id="document_type_title<?=$document_types[$j]['id']?>" style="font-weight: <?=(in_array($document_types[$j]['id'], $data['product_document_types']) ? 'bolder' : 'normal')?>">
						<input onchange="changeDocument(this.value, this.checked);"  type="checkbox" name="product_document_types[]" readonly value="<?=$document_types[$j]['id']?>" <?=(in_array($document_types[$j]['id'], $data['product_document_types']) ? 'checked' : '')?> />
						<?=$document_types[$j]['title']?>
					</div>
				</td>
				<td></td>
			<? } ?>
		</tr>
	<? } ?>
</table>