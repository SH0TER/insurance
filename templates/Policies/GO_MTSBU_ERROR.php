<div style="margin-left: 15px">
	<form action="index.php" method="POST">
	<?php
		foreach ($data as $key => $val) {
			if(count($val) > 1)
				foreach($val as $val2)
					echo '<input type="hidden" name="' . $key . '[]" value="' . $val2 . '">';
			elseif ($key == "id")
				echo '<input type="hidden" name="' . $key . '[]" value="' . $val[0] . '">';
			else
				echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
		}
	?>
	<input type="hidden" name="mtsbuChecked" value="1">
	<h1 style="font-size: 15px">Увага! Ви дійсно маєте намір видалити поліс<?=(count($mtsbu)>1) ? 'и' : '';?> після його загрузки в ЦБД?</h1>
	<p>Поліс<?=(count($mtsbu)>1) ? 'и' : '';?>: <? echo implode(", ", $mtsbu); ?></p>
	</form>
	<input style="width: 38px; margin-right: 5px;" type="button" value="Так" onclick="formSubmit();" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" class="button">
	<input style="width: 38px" type="button" value="Ні" onclick="goBack();" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" class="button">
</div>
<script type="text/javascript">
	function formSubmit() {
		$('form').submit();
	}
	function goBack() {
		window.history.back();
	}
</script>