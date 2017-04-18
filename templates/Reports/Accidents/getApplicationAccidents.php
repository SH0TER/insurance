<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Заявлені випадки:</td>
	</tr>
	<tr>
		<td></td>
		<td align="right">
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td>
                        <b>Вид страхування:</b>
                        <select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                            <option value="<?=PRODUCT_TYPES_KASKO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : '')?> >КАСКО</option>
                            <option value="<?=PRODUCT_TYPES_GO?>" <?=(($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : '')?> >ОСЦПВ</option>
                        </select>
                    </td>
                    <td><b>Звітний період (з):</b></td>
                    <td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><b>Звітний період (по):</b></td>
                    <td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
			</form>
			</div>
		</td>
	</tr>
	</table>
</div>