<? include_once $this->object . '/header.php'?>
<table cellpadding="2" cellspacing="3" width="100%">
<tr>
	<td height="50" align="center">
		<? $Log->showSystem();?>
	</td>
</tr>
</table><br />
			</td>
		</tr>
		</table><br />
	</td>
</tr>
</table>
<div align="center">
	<input type="button" value=" Повернутися до списку " onclick="window.location='<?=$_SERVER['PHP_SELF']?>?do=Certificates|show'" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
	<? if ($this->permissions['insert']) { ?><input type="button" value=" Створити ще один " onclick="window.location='<?=$_SERVER['PHP_SELF']?>?do=<?=$this->object?>|add&product_types_id=<?=$data['product_types_id']?>'" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
</div>
</div>