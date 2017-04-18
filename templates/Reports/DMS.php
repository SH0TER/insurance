<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">ДМС, анализ урегулированных событий:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getDMSInWindow" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td align="right">
                    <table cellpadding="0" cellspacing="5">
					<tr>
						<td>
							<b>СК:</b>
							<?
							echo '<select name="insurance_companies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
								echo '<option value="">...</option>';
								echo '<option value="4" ' . ($data['insurance_companies_id'] == '4') . '>ТДВ &quot;Експрес Страхування&quot;</option>';
								echo '<option value="9" ' . ($data['insurance_companies_id'] == '9') . '>ПрАТ &quot;СК &quot;САТІС&quot;</option>';
							echo '</select>';
							?>
						</td>
                        <td><b>Дата договора:</b></td>
                        <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td><b>Дата оплаты:</b></td>
                        <td>&nbsp;з</td><td><input type="text" id="payment_from<?=$this->objectTitle?>" name="payment_from" value="<?=$data['payment_from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td>&nbsp;до</td><td><input type="text" id="payment_to<?=$this->objectTitle?>" name="payment_to" value="<?=$data['payment_to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td><input type="submit" value="Експорт" class="button"></td>
                    </tr>
                    </table>
				</td>
			</tr>
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			</table>
			</form>
			</div>
		</td>
	</tr>
	</table>
</div>