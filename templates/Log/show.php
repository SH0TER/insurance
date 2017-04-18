<div id="log">
	<div class="caption"><?=translate('Message')?>:</div>
<?
	foreach($_SESSION['log'] as $row) {
		echo '<div class="' . $row['type'] . '">' . $row['text'] . '</div>';
	}
?>
</div>