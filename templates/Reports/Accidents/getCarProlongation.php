<script>
	function setCarParams(id) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			async:		false,
			data:		'do=Policies|setCarParamsInWindow&item_id=' +id+'&product_types_id=3'+
						'&transmissions_id='+$('#items'+id+'transmissions_id').val()+
						'&car_engine_type_id='+$('#items'+id+'car_engine_type_id').val()+
						'&car_body_id='+$('#items'+id+'car_body_id').val()+
						'&market_price='+$('#items'+id+'market_price').val(),
			success: 	function(result) {
							alert(result);
						}
		});
	}	
	function findPrice(id) {
	
			var year = $('#items' + id + 'year').html();
			var engine_size = $('#items' + id + 'engine_size').html();
			$.ajax({
						type:		'POST',
						url:		'index.php',
						dataType:	'json',
						data:		'do=Policies|getmarketPriceInWindow' +
									'&items_id=' + id+
									'&product_types_id=3'  +
									'&solutions_id=0' +
									'&car_types_id=' + getElementValue('items' + id + 'car_types_id') +
									'&brands_id=' + getElementValue('items' + id + 'brands_id') +
									'&models_id=' + getElementValue('items' + id + 'models_id') +
									'&modification=' + getElementValue('items' + id + 'modification') +
									'&transmissions_id=' + getElementValue('items' + id + 'transmissions_id') +
									'&car_body_id=' + getElementValue('items' + id + 'car_body_id') +
									'&car_engine_type_id=' + getElementValue('items' + id + 'car_engine_type_id') +
									'&year=' + year +
									'&engine_size=' + engine_size ,
						success:    function(result) {
											//
											if (result.marketPrice==0)
												alert("Цена не найдена");
											else	
												$('#items'+id+'find_market_price').html(result.marketPrice);
									}
						});
	}
	
	//загружаем модели для выбранного бренда
	function setCar() {
    
    $.ajax({
        type:		'GET',
        url:		'index.php',
        dataType:	'script',
        data:		'do=CarModels|getJavaScriptInWindow&product_types_id=3&brands_id=<?=$data['brands_id']?>&models_id=<?=$data['models_id']?>',
        success:	function (result) {
            setModel();
        }
    })
    
	}



	$(document).ready(function() {
        setCar();
	});
	
</script>

<div class="block">	
    <table width="100%" cellspacing="0" cellpadding="0">				
    <tr>
        <td class="bullet">
            <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
            ?>
        </td>
        <td class="caption">Установка параметров по объектам страхования:</td>
    </tr>
    <tr>
        <td></td>
        <td align="right">
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <table cellpadding="0" cellspacing="5">
                <tr>
	                <td class="label grey"><?=$this->getMark()?>Автомобіль:</td>
					<td>
					<select onchange="changeCarType();" id="car_types_id" name="car_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'"  >
						<option value="">...</option>
						<?
							foreach($this->car_types_id as $id => $title) {
								echo '<option ' . ($data['car_types_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . $title . '</option>';
							}
						?>
					</select>
					</td>
					<td class="label grey"><?=$this->getMark()?>Марка:</td>
					<td><select id="brands_id" name="brands_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" onchange="changeBrand(); "  ></select></td>
					<td class="label grey"><?=$this->getMark()?>Модель:</td>
					<td><select id="models_id" name="models_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';"    ></select></td>
					<td>
						<b>Номер:</b>
						<input style="width: 65px;" class="fldText" type="text" onblur="this.className='fldText';" onfocus="this.className='fldTextOver';" value="<?=$data['number']?>" name="number" >
                    </td>
					<td>
						<b>Рік:</b>
						<input style="width: 45px;" class="fldText" type="text" onblur="this.className='fldText';" onfocus="this.className='fldTextOver';" value="<?=$data['year']?>" name="year" >
                    </td>
				</tr>
				</table>
				 <table cellpadding="0" cellspacing="5">
				<tr>	
					<td align="right" valign="bottom">
						<b>Банк:</b>
						<?
							echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
							echo '<option value="">...</option>';
							foreach ($financial_institutions as $financial_institution) {
								echo ($financial_institution['id'] == $data['financial_institutions_id'])
									? '<option value="' . $financial_institution['id'] . '" selected>' . $financial_institution['title'] . '</option>'
									: '<option value="' . $financial_institution['id'] . '">' . $financial_institution['title'] . '</option>';
							}
							echo '</select>';
						?>
					</td>
					<td><b>Дата:</b></td>
					<td><select id="date_types_id" name="date_types_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';"    >
						<option value="1" <? if ($data['date_types_id']==1) echo 'selected'?>>пролонгации</option>
						<option value="2" <? if ($data['date_types_id']==2) echo 'selected'?>>установки</option>
					</select></td>
					
                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
					<td>
					Эксель<input  type="checkbox" value="1" name="InWindow">
					</td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
	
	 <table width="100%"   cellpadding="0" cellspacing="0">
        <tr class="columns">
            <td>Полис</td>
            <td>Страхувальник</td>
			<td>Марка</td>
			<td>Модель</td>
            <td>Vin</td>
            <td>Год</td>
            <td>КПП</td>
            <td>Объем</td>
            <td>Топливо</td>
            <td>Кузов</td>
			<td>Модификация</td>
			<td>Страх  стоимость по дог.</td>
			<td>Рыночаня цена по базе</td>
            <td>Рыночная цена, грн.</td>
			<td>Кто установил</td>
			<td>Дата</td>
			<td></td>
        </tr>
        <?
            foreach ($list as $row) {
			$i = $row['item_id'];
        ?>
        <tr <?=$row['policy_statuses_id']==1 ? 'class="commission"' : ''?>>
            <td><a href="index.php?do=Policies|view&id=<?=$row['policies_id']?>&product_types_id=3" target="_blank"><?=$row['number']?></a></td>
            <td><?=$row['insurer']?></td>
			<td><?=$row['brand']?></td>
			<td><?=$row['model']?></td>
			<input type="hidden" id="items<?=$i?>brands_id" name="items[<?=$i?>][brands_id]" value="<?=$row['brands_id']?>"    />
			<input type="hidden" id="items<?=$i?>models_id" name="items[<?=$i?>][models_id]" value="<?=$row['models_id']?>"    />
			<input type="hidden" id="items<?=$i?>car_types_id" name="items[<?=$i?>][car_types_id]" value="<?=$row['car_types_id']?>"    />
			<td><?=$row['shassi']?></td>
			<td id="items<?=$i?>year"><?=$row['year']?></td>
			<td>
                <select id="items<?=$i?>transmissions_id" name="items[<?=$i?>][transmissions_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'"  >
                    <option value="">...</option>
                    <?
                        foreach($this->transmissions as $id => $title) {
                            echo '<option ' . ($row['transmissions_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . $title . '</option>';
                        }
                    ?>
                </select>
			</td>
			<td id="items<?=$i?>engine_size"><?=$row['engine_size']?></td>
			<td>
                <select id="items<?=$i?>car_engine_type_id" name="items[<?=$i?>][car_engine_type_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'"  >
                    <option value="">...</option>
                    <?
                        foreach($this->car_engine_type as $id => $title) {
                            echo '<option ' . ($row['car_engine_type_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . $title . '</option>';
                        }
                    ?>
                </select>
			</td>
			<td>
                <select id="items<?=$i?>car_body_id" name="items[<?=$i?>][car_body_id]" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'"  >
                    <option value="">...</option>
                    <?
                        foreach($this->car_body as $id => $title) {
                            echo '<option ' . ($row['car_body_id']==$id ? 'selected':'') . ' value="' . $id . '"  >' . $title . '</option>';
                        }
                    ?>
                </select>
			</td>
			<td><input type="text" id="items<?=$i?>modification" name="items[<?=$i?>][modification]" value="<?=$row['modification']?>" maxlength="10" class="fldText" onfocus="this.className='fldTextOver';" onblur="this.className='fldText';" /></td>
			<td><?=$row['car_price']?></td>
			<td id="items<?=$i?>find_market_price"><?=$row['find_market_price']?> <a href="JavaScript:findPrice(<?=$i?>)" title="уточнить цену">?</a></td>
			<td>
	    		<input type="<?=($row['canchange'] ? 'text' : 'hidden')?>" id="items<?=$i?>market_price" name="items[<?=$i?>][market_price]" value="<?=$row['market_price_expert']?>" maxlength="10" class="fldMoney" onfocus="this.className='fldMoneyOver';" onblur="this.className='fldMoney';"     />
		    	<?if (!$row['canchange']) echo $row['market_price_expert']; ?>
			</td>
			<td><?=$row['expert']?></td>
			<td><?=$row['expert_date']?></td>
			<td><input   type="button" value=" Зберегти " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" onclick="setCarParams(<?=$i?>);" /></td>
        </tr>
        <?
            }
        ?>
    </table>
</div>