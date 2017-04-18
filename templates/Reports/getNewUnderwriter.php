<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Платежi по полiсам / Збитки по подiям:</td>
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
                </tr>
                </table>
                <table cellpadding="0" cellspacing="5">
				
                <tr>
					<td>
						<b>Головна агенція:</b>
						<?
						echo '<select name="agencies_top_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
						echo '<option value="">...</option>';
						foreach ($agencies_top as $agency_top) {
							echo ($agency_top['id'] == $data['agencies_top_id'])
								? '<option value="' . $agency_top['id'] . '" selected>' . $agency_top['title'] . '</option>'
								: '<option value="' . $agency_top['id'] . '">' . $agency_top['title'] . '</option>';
						}
						echo '</select>';
						?>
					</td>
                    <td><b>Початок року страхування:</b></td>
                    <td>&nbsp;з</td><td><input type="text" id="begin_dateFrom" name="begin_dateFrom" value="<?=$data['begin_dateFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td>&nbsp;до</td><td><input type="text" id="begin_dateTo" name="begin_dateTo" value="<?=$data['begin_dateTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
					<td><b>Дата підписання:</b></td>
                    <td>&nbsp;з</td><td><input type="text" id="dateFrom" name="dateFrom" value="<?=$data['dateFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td>&nbsp;до</td><td><input type="text" id="dateTo" name="dateTo" value="<?=$data['dateTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';"></td>
                </tr>
                </table>
			</form>
			</div>
		</td>
	</tr>
	</table>
</div>