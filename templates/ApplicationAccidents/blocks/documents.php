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

//$array = array(51,152,73,19,55,153,1,154,155,156,157,158,13,61,159,62,63,12,15,36);
//$array = array(51,152,73,19,55,153,1,154,72,13,61,159,62,63,12,15,36);
$array = array(19,55,153,1,154,72,13,62,63,12,15,36);

$document_types = ProductDocumentTypes::getListByIdx($array);

$count_rows = 7;

?>
<table cellpadding="5" cellspacing="0">
	<? for($i=0; $i<$count_rows; $i++) { ?>
		<tr>
			<? for($j=$i; $j<sizeOf($document_types); $j+=$count_rows) { ?>
				<td width="600">					
					<div id="document_type_title<?=$document_types[$j]['id']?>" style="font-weight: <?=(in_array($document_types[$j]['id'], $data['product_document_types']) ? 'bolder' : 'normal')?>">
						<input onchange="changeDocument(this.value, this.checked);"  type="checkbox" name="product_document_types[]" readonly value="<?=$document_types[$j]['id']?>" <?=(in_array($document_types[$j]['id'], $data['product_document_types']) ? 'checked' : '')?> <?=$this->getReadonly(true)?> />
						<?=$document_types[$j]['title']?>
					</div>
				</td>
				<td></td>
			<? } ?>
		</tr>
	<? } ?>
</table>