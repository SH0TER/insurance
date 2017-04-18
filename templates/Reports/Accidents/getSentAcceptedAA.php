<div class="block">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet">
			<?
				$bullet = ($_COOKIE[$this->objectTitle.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
				echo '<a href="javascript: showHideModule(\'' . $this->objectTitle . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->objectTitle . 'BlockBullet" alt="" /></a>';
			?>
		</td>
		<td class="caption">Направлені / Прийняті:</td>
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
                        <b>Місяць:</b>
                        <select name="month" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
                            <option value="1" <?=(($data['month'] == 1) ? 'selected' : '')?> >Січень</option>
                            <option value="2" <?=(($data['month'] == 2) ? 'selected' : '')?> >Лютий</option>
                            <option value="3" <?=(($data['month'] == 3) ? 'selected' : '')?> >Березень</option>
                            <option value="4" <?=(($data['month'] == 4) ? 'selected' : '')?> >Квітень</option>
                            <option value="5" <?=(($data['month'] == 5) ? 'selected' : '')?> >Травень</option>
                            <option value="6" <?=(($data['month'] == 6) ? 'selected' : '')?> >Червень</option>
                            <option value="7" <?=(($data['month'] == 7) ? 'selected' : '')?> >Липень</option>
                            <option value="8" <?=(($data['month'] == 8) ? 'selected' : '')?> >Серпень</option>
                            <option value="9" <?=(($data['month'] == 9) ? 'selected' : '')?> >Вересень</option>
                            <option value="10" <?=(($data['month'] == 10) ? 'selected' : '')?> >Жовтень</option>
                            <option value="11" <?=(($data['month'] == 11) ? 'selected' : '')?> >Листопад</option>
                            <option value="12" <?=(($data['month'] == 12) ? 'selected' : '')?> >Грудень</option>
                        </select>
                    </td>
                    <td>
                        <b>Рік:</b>
                        <?
                        echo '<select name="year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
                        $year = date("Y");
                            for ($i=2010; $i<=$year; $i++){
                                if ($i == $data['year']) echo"<option value = $i selected>".$i."</option>";
                                else echo "<option value = $i>".$i."</option>";
                            }
                        ?>
                        </select>
                    </td>
                    <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
			</form>
			</div>
		</td>
	</tr>
	</table>
</div>
