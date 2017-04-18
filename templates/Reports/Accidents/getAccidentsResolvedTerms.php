<script>
	function changeProductTypesId() {
		var sum_ptId = 0;
		
		$("#product_types_id option:selected").each(function(){
			sum_ptId += parseInt(this.value);
		});

		if (sum_ptId == 3) {
			$("#only_berlinBlock").show();
			$("input[name=only_berlin]").attr("disabled", "");
		} else {
			$("#only_berlinBlock").hide();			
			$("input[name=only_berlin]").attr("disabled", "disabled");
		}
	}
	
	$(document).ready(function(){
		changeProductTypesId();
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
        <td class="caption">Строки врегулювання справи</td>
    </tr>
    <tr>
        <td></td>
        <td align="right">
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="1" />
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td rowspan="3"><b>Вид страхування:</b></td>
                    <td rowspan="3">
                        <select id="product_types_id" name="product_types_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="changeProductTypesId();">
                                <option value="<?=PRODUCT_TYPES_KASKO?>" <?=(in_array(PRODUCT_TYPES_KASKO, $data['product_types_id']) ? 'selected' : '')?>>КАСКО</option>
                                <option value="<?=PRODUCT_TYPES_GO?>" <?=(in_array(PRODUCT_TYPES_GO, $data['product_types_id']) ? 'selected' : '')?>>ОСЦПВ</option>
                                <option value="<?=PRODUCT_TYPES_PROPERTY?>" <?=(in_array(PRODUCT_TYPES_PROPERTY, $data['product_types_id']) ? 'selected' : '')?>>Майно</option>
                        </select>
                        </br><div id="only_berlinBlock"><input type="checkbox" name="only_berlin" value="1" <?=(intval($data['only_berlin']) ? 'checked' : '')?>/> Берлін</div>
                    </td>
                    <td rowspan="3"><b>Аварійний комісар:</b></td>
                    <td rowspan="3">
                        <select id="average_managers_id" name="average_managers_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                            <option value="0" <?=(in_array(0, $data['average_managers_id']) ? 'selected' : '')?>>...</option>
                            <? foreach($evarage_managers as $evarage_manager) { ?>
                                <option value="<?=$evarage_manager['id']?>" <?=(in_array($evarage_manager['id'], $data['average_managers_id']) ? 'selected' : '')?>><?=$evarage_manager['lastname']?> <?=$evarage_manager['firstname']?></option>
                            <? } ?>
                        </select>
                    </td>
                    <td rowspan="3"><b>Статус справи:</b></td>
                    <td rowspan="3">
                        <select id="accident_statuses_id" name="accident_statuses_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                            <option value="0" <?=(in_array(0, $data['accident_statuses_id']) ? 'selected' : '')?>>...</option>
                            <? foreach($accident_statuses as $accident_status) { ?>
                                <option value="<?=$accident_status['id']?>" <?=(in_array($accident_status['id'], $data['accident_statuses_id']) ? 'selected' : '')?>><?=$accident_status['title']?></option>
                            <? } ?>
                        </select>
                    </td>
                    <td colspan="6" style="vertical-align: top;"><b>Дата :</b></td>
                    <td rowspan="3" style="vertical-align: bottom;">&nbsp;<a href="javascript: document.<?=$this->objectTitle?>.submit();">Показати</a></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>написання заяви:&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>AccidentsDate" name="fromAccidentsDate" value="<?=$data['fromAccidentsDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>AccidentsDate" name="toAccidentsDate" value="<?=$data['toAccidentsDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>вругелювання справи:&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>ResolvedDate" name="fromResolvedDate" value="<?=$data['fromResolvedDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>ResolvedDate" name="toResolvedDate" value="<?=$data['toResolvedDate']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
</div>