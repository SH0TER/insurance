<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Выплаты по агенским актам:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getAktPayments" />
            <input type="hidden" name="InWindow" value="true" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td align="right">
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
                        <td><b>Сплата:</b></td>
                        <td>&nbsp;з</td><td><input type="text" id="payment_dateFrom<?=$this->objectTitle?>" name="payment_dateFrom" value="<?=$data['payment_dateFrom']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td>&nbsp;до</td><td><input type="text" id="payment_dateTo<?=$this->objectTitle?>" name="payment_dateTo" value="<?=$data['payment_dateTo']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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