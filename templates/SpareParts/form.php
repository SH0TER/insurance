<?

	//_dump($data);
	$car_types = CarTypes::getListArray(array('conditions' => 'product_types_id = 3'));
	
?>

<link rel="stylesheet" type="text/css" media="screen" href="/css/validationEngine.jquery.css" />
<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />

<script>

	var num_file = 0;

	function log(value) {
		console.log(value);
	}
	
	function getCarServicesList() {
        $.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'json',
            data:	    'do=CarServices|getListJsonInWindow',
            success: function(car_services) {
                var data = {};
                data.results = car_services;
                data.length = car_services.length;
                $('#car_services_id').flexbox(data, {
                    allowInput: <?=($action == 'view' ? 0 : 1)?>,
                    width: 400,
                    paging: false,
                    maxVisibleRows: 8,
                    maxCacheBytes: 0,
                    noResultsText: 'Результатів не знайдено',
                    readOnly: <?=($action == 'view' ? 1 : 0)?>,
                    compare: function(elem){
                        return true;
                    }
                });

                <? if ($data['car_services_id'] > 0) { ?>
                    $('#car_services_id_hidden').val(<?=$data['car_services_id']?>);
                    $('#car_services_id_input').val('<?=htmlspecialchars_decode(CarServices::getTitle($data['car_services_id']))?>');
                <? } ?>
            }

        });
    }

	$(document).ready(function(){
		
		$('select[name=car_types_id]').bind('change', function(event, args){
			$.ajax({
				type:       'GET',
				url:        'index.php',
				dataType:   'json',
				data:       'do=CarBrands|getListJsonInWindow'+
							'&car_types_id=' + this.value,
				success:    function (car_brands){
					var obj = $('select[name=models_id]');
					obj.empty();
					obj.append( $('<option value="-1">...</option>') );
					
					obj = $('select[name=brands_id]');
					obj.empty();
					obj.append( $('<option value="-1">...</option>') );
					for (var i=0; i < car_brands.length; i++){
						obj.append( $('<option value="' + car_brands[i].id + '">' + car_brands[i].title + '</option>') );
					}

					$(obj.selector + ' [value=<?=$data['brands_id']?>]').attr('selected', 'selected');
				}
			});
        });
		
		$('select[name=brands_id]').bind('change', function(event, args){
			$.ajax({
				type:       'GET',
				url:        'index.php',
				dataType:   'json',
				data:       'do=CarModels|getListJsonInWindow'+
							'&brands_id=' + this.value +
							'&car_types_id= ' + $('select[name=car_types_id] option:selected').val(),
				success:    function (car_models){
					var obj = $('select[name=models_id]');
					obj.empty();
					obj.append( $('<option value="-1">...</option>') );
					for (var i=0; i < car_models.length; i++){
						obj.append( $('<option value="' + car_models[i].id + '">' + car_models[i].title + '</option>') );
					}

					$(obj.selector + ' [value=<?=$data['models_id']?>]').attr('selected', 'selected');
				}
			});
        });
		
		<? if (intval($data['id'])) { ?>
			$('select[name=car_types_id]').change();
			$('select[name=brands_id]').change();
		<? } ?>
		
		getCarServicesList();
		
		var count_files = -1;
		
		$('#add_file').css('cursor', 'pointer').bind('click', function(){
			//$('#files').append('<tr><td><input type="text" name="document[' + num_documents + ']" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td><td width="30"><a href="#" onclick="deleteDocument(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');
			$('#files').append('<tr><td class="label">Файл ' + (num_file + 1) + ':<input type="hidden" value="' + count_files + '" name="files_idx[]"></td><td width="300"><input type="file" name="file[' + count_files + ']" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'"></td><td align="left"><a onclick="deleteFile(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');

			num_file++;
			count_files--;
		});
		
	});	
	
	function deleteFile(obj, i) {
		if (confirm('Ви дійсно бажаєте вилучити файл?')) {
            document.getElementById('files').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            changeFilesList();
			num_file--;
			
			$('#del_db').append('<input type="hidden" name="del_db[]" value="' + i + '"/>');
        }
	}
	
	function changeFilesList() {
		i = 1;
		$('#files tr').each(function(){
			$(this).find('.label').each(function(){
				$(this).html('Файл ' + i + ':');
				i++;
			});
		});
	}
	
	function changeFile(i) {
		$('#del_db').append('<input type="hidden" name="del_db[]" value="' + i + '"/>');
	}

</script>

<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
		<td class="caption"><?=$this->getFormTitle($actionType)?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
			<tr>
				<td>
					<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
						<input type="hidden" name="id" value="<?=$data['id']?>" />
						<input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
						
						<table width="100%" cellpadding="2" cellspacing="0" border="0">
							<tr>
								<td class="label">*Група запчастин:</td>
								<td colspan="3"><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('spare_part_groups_id') ], $data['spare_part_groups_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
							</tr>
							<tr>
								<td class="label">*Тип ТЗ:</td>
								<td>
									<select name="car_types_id" class="fldSelect" onblur="this.className='fldSelect'" onfocus="this.className='fldSelectOver'" <?=$this->getReadonly(true)?> >
										<?
											echo '<option value="-1">...</option>';
											foreach ($car_types as $car_type) {
												echo '<option value="' . $car_type['id'] . '" ' . ($car_type['id'] == $data['car_types_id'] ? 'selected' : '') . '>' . $car_type['title'] . '</option>';
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="label">*Марка:</td>
								<td><select id="car_brands_id" name="brands_id" class="fldSelect" value="" <?=$this->getReadonly(true)?> /></select></td>
							</tr>
							<tr>
								<td class="label">*Модель:</td>
								<td><select id="car_models_id" name="models_id" class="fldSelect" value="" <?=$this->getReadonly(true)?> /></select></td>
							</tr>
							<tr>
								<td class="label">*Рік випуску:</td>
								<td><input type="text" name="year" value="<?=$data['year']?>" class="fldText year" onfocus="this.className='fldTextOver year'" onblur="this.className='fldText year'" <?=$this->getReadonly()?> /></td>
							</tr>
							<tr>
								<td class="label">*Ціна:</td>
								<td><input type="text" name="price" value="<?=$data['price']?>" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly()?> /></td>
							</tr>
							<tr>
								<td class="label">Опис:</td>
								<td colspan="3"><textarea class="fldNote" onblur="this.className='fldNote';" onfocus="this.className='fldNoteOver';" name="notice" <?=$this->getReadonly(false)?> ><?=$data['notice']?></textarea></td>
							</tr>
							<tr>
								<td class="label">*СТО:</td>
							    <td><div id="car_services_id"></div></td>
							</tr>
							<tr style="display: none;"><td id="del_db"></td></tr>
							<tr>
								<td colspan="2">
									<table id="files" width="100%" cellpadding="5" cellspacing="0" border="0">									
									<?
									
										$data['files'] = $this->getFiles($data['id']);
										if (is_array($data['files'])) {
											foreach ($data['files'] as $i => $file) {
												echo '<script>num_file = num_file + 1;</script>';
												$file['spare_parts_id'] = $data['id'];
												$file['id'] = $i;
									?>
									<tr>
										<td class="label">Файл <?=($i+1)?>:<input type="hidden" value="<?=$i?>" name="files_idx[]"></td>
										<? if ($this->mode == 'update') {?><td width="300"><input onchange="changeFile(<?=intval($i)?>)" type="file" name="file[<?=$i?>]" value="<?=$file?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> ></td><? } ?>
										<td width="300"><b><?=translate('Present, size')?> <?=getFileSize('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data['file'])?>:</b> <a href="?do=<?=$this->object?>|downloadFileInWindow&&amp;file=<?=urlencode(serialize($file))?>" target="_blank"><?=$file['name_load']?></a></td>
										<td align="left"><? if ($this->mode == 'update') {?><a onclick="deleteFile(this, <?=intval($i)?>)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a><? } ?></td>
									</tr>
									<?
											}
										}
									?>
									</table>
								</td>
							</tr>
							<? if ($this->mode == 'update') {?>
							<tr>
								<td class="label"><a id="add_file">Додати файл</a></td>
								<td>&nbsp;</td>
							</tr>							
							<tr>
								<td width="150">&nbsp;</td>
								<td align="center" colspan="3"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
							</tr>
							<? } ?>
						</table>
					</form>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>