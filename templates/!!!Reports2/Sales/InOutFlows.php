<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Вхідний та вихідний потоки (фінанси):</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="do" value="Reports|getSalesInOutFlows" />
            <input type="hidden" name="InWindow" value="true" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td align="right">
                    <table cellpadding="0" cellspacing="5">
                    <tr>
                        <td>
                            <b>Вид страхування:</b>
                            <?
                                echo '<select name="product_types_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                echo '<option value="">...</option>';
                                foreach ($product_types as $product_type) {
                                    echo ($product_type['id'] == $data['product_types_id'])
                                            ? '<option value="' . $product_type['id'] . '" selected>' . $product_type['title'] . '</option>'
                                            : '<option value="' . $product_type['id'] . '">' . $product_type['title'] . '</option>';
                                }
                                echo '</select>';
                            ?>
                        </td>
                        <td>
                            <b>Агенція:</b>
                            <?
                            echo '<select name="agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                            echo '<option value="">...</option>';
                            foreach ($agencies as $agency) {
                                echo ($agency['id'] == $data['agencies_id'])
                                    ? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
                                    : '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </td>
                    </tr>
                    </table>
                    <table cellpadding="0" cellspacing="5">
                    <tr>
                        <td>
                            <b>Банк:</b>
                            <?
                                echo '<select name="financial_institutions_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                                echo '<option value="">...</option>';
                                foreach ($financial_institutions as $financial_institution) {
                                    echo ($financial_institution['id'] == $data['financial_institutions_id'])
                                            ? '<option value="' . $financial_institution['id'] . '" selected>' . $financial_institution['title'] . '</option>'
                                            : '<option value="' . $financial_institution['id'] . '">' . $financial_institution['title'] . '</option>';
                                }
                                echo '</select>';
                            ?>
                        </td>
                        <td><b>Сплата:</b></td>
                        <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                        <td>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
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