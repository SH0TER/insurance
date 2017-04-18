<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Бланки суворої звітності:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->objectTitle . 'Block" ' . (($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="Reports1|getPolicyBlanks" />
            <input type="hidden" name="InWindow" value="true" />
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
                <td align="right">
                    <table cellpadding="0" cellspacing="5">
                    <tr>
                        <td>
                            <b>Тип:</b>
                            <select name="product_types_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                                <option value="<?=PRODUCT_TYPES_KASKO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? 'selected' : ''?>>КАСКО</option>
                                <option value="<?=PRODUCT_TYPES_GO?>" <?=($data['product_types_id'] == PRODUCT_TYPES_GO) ? 'selected' : ''?>>ЦВ</option>
                            </select>
                        </td>
                        <? if ($Authorization->data['roles_id'] != ROLES_AGENT) {?>
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
                        <? } ?>
                        <td><input type="submit" value="Експорт" class="button" onMouseOver="this.className = 'buttonover';" onMouseOut="this.className = 'button';" /></td>
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