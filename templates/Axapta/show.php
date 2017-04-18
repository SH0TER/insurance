<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption"><?=$this->getFormTitle('show')?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
			<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input type="hidden" name="do" value="<?=$this->object?>|show" />
			<input type="hidden" name="offset<?=$this->objectTitle?>Block" value="<?=$form['offset' . $this->objectTitle . 'Block']?>" />
			<input type="hidden" name="total<?=$this->objectTitle?>Block" value="<?=$total?>" />
			<?
				echo $this->getShowHiddenFields($data);

			?>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? if (in_array(true, $this->permissions)) {?>
			<tr>
                <td align="right">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td><b>Страхувальник:</b> <input type="text" name="owner_lastname" value="<?=$data['owner_lastname']?>" class="fldText lastname" onfocus="this.className='fldTextOver lastname';" onblur="this.className='fldText lastname';" /></td>
                            <td><input type="submit" value="Показати" class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                        </tr>
                    </table>
                </td>
             </tr>
			<? } ?>
			<tr><td colspan="2" height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr>
				<td colspan="2">
					<? if ($total) {?>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr class="columns">
                            <td>Агенція</td>
                            <td>Страхувальник</td>
                            <td>Телефон</td>
                            <td>Марка/модель</td>
                            <td>Ціна</td>
                            <td>Адреса</td>
                            <td>Дата продажу</td>
                            <td>Дата документу</td>
						</tr>
						<?
							foreach ($list as $row) {
								$i = 1 - $i;
						?>
						<tr class="<?=$this->getRowClass($row, $i)?>">
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=$row['axaptaDealer']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=$row['lastname']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=$row['mobilePhone']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=$row['brand']?> / <?=$row['model']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=getRateFormat($row['priceWithNDS'], 2)?></a></td>
                            <td><?=$row['registrationAddress']?></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=$row['sa_date']?></a></td>
                            <td><a href="<?=$_SERVER['PHP_SELF'] . '?do=' . $this->object . '|sendAdaptedFieldsToAdd&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)?>" target="_blank"><?=$row['modified']?></a></td>
                        </tr>
						<? } ?>
						</table>
					<? }?>
					<div class="navigation">
						<div class="paging"><?=getPaging($data['offset' . $this->objectTitle . 'Block'], $_SESSION['auth']['records_per_page'], 7, $total, $hidden, 'offset' . $this->objectTitle . 'Block');?></div>
					</div>
				</td>
			</tr>
			</table>
			</form>
		</td>
	</tr>
	</table>
</div>