<?
    if(in_array($data['product_types_id'], array(PRODUCT_TYPES_PROPERTY, PRODUCT_TYPES_NS))) {//для Майна блок описаный внизу не нужен (так же в НС и может в других видах)
        if(count($list) <= 6) { //так как рисков может быть довольно много, выводим их по разному (для нормального вида)
            foreach($list as $row){
                echo '<input type="radio" name="application_risks_id" value="' . $row['risks_id'] . '"' . (($row['risks_id'] == $data['application_risks_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' onclick="setRisk()" /> ' . $row['title'] . ' </td>';
            }
        }
        else {
            echo '<table>';
            $k=0;
            while ($list[$k]) {
                echo '<tr>
                        <td><input type="radio" name="application_risks_id" value="' . $list[$k]['risks_id'] . '"' . (($list[$k]['risks_id'] == $data['application_risks_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' onclick="setRisk()" /> ' . $list[$k]['title'] . ' </td> ';
                       echo '<td>'; if($list[$k+1]) echo '<input type="radio" name="application_risks_id" value="' .$list[$k+1]['risks_id'] . '"' . (($list[$k+1]['risks_id'] == $data['application_risks_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' onclick="setRisk()" /> ' . $list[$k+1]['title']; else echo '</td> ' .
                     '</tr>';
                $k=$k+2;
            }
            echo '</table>';
        }
    } else {
        foreach($list as $row){
            echo '<input type="radio" name="application_risks_id" value="' . $row['risks_id'] . '"' . (($row['risks_id'] == $data['application_risks_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' onclick="setRisk()" /> ' . $row['title'] . ' </td>';
    }
    ?>
	<br /><br />
	<div id="risks<?=RISKS_DTP?>" style="display: <?=($data['application_risks_id'] == RISKS_DTP) ? 'block' : 'none'?>" name="risks">
		<select name="types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
			<option value="1" <?=($data['types_id'] == 1) ? 'selected': ''?>>Зіткнення: 2-х учасників</option>
			<option value="2" <?=($data['types_id'] == 2) ? 'selected': ''?>>Зіткнення: 3-х учасників</option>
			<option value="3" <?=($data['types_id'] == 3) ? 'selected': ''?>>Перекидання</option>
			<option value="4" <?=($data['types_id'] == 4) ? 'selected': ''?>>Наїзд на перешкоду</option>
			<option value="5" <?=($data['types_id'] == 5) ? 'selected': ''?>>Наїзд на пішохода</option>
			<option value="6" <?=($data['types_id'] == 6) ? 'selected': ''?>>Наїзд на велосипедиста</option>
			<option value="7" <?=($data['types_id'] == 7) ? 'selected': ''?>>Наїзд на тварину</option>
			<option value="8" <?=($data['types_id'] == 8) ? 'selected': ''?>>Наїзд на гужовий транспорт</option>
			<option value="9" <?=($data['types_id'] == 9) ? 'selected': ''?>>Наїзд на транспортний засіб, що стоїть</option>
			<option value="10" <?=($data['types_id'] == 10) ? 'selected': ''?>>Інше</option>
		</select><br /><br />

		<b>Ступінь тяжкості наслідків:</b><br />
		<input type="checkbox" name="consequences[]" value="1" <?=($data['consequences'] & 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> матеріальний збиток
		<input type="checkbox" name="consequences[]" value="2" <?=($data['consequences'] & 2) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> легкі тілесні ушкодження
		<input type="checkbox" name="consequences[]" value="4" <?=($data['consequences'] & 4) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> тілесні ушкодження середнього ступеня тяжкості і тяжкі
		<input type="checkbox" name="consequences[]" value="8" <?=($data['consequences'] & 8) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> смерть потерпілого
		<input type="checkbox" name="consequences[]" value="16" <?=($data['consequences'] & 16) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> особливо тяжкі наслідки (загинуло 4 і більш або поранено 15 і більш людей)
	</div>

<script type="text/javascript">
function setRisk() {
	$('div[name=risks]').css('display', 'none');

	var risksId = $('input[type=radio][name=application_risks_id]:checked').val();

	$('#risks' + risksId).css('display', 'block');
}
</script>
<?}?>