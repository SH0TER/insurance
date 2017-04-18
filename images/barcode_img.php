<?php
	$path = array(
		'include/lib',
		'include/modules',
		'../include/lib',
		'../include/modules'
		);

	(eregi('win', $_SERVER['SERVER_SOFTWARE']))
		? ini_set('include_path', implode(';', $path))
		: ini_set('include_path', implode(':', $path));

require_once("Image/Barcode.php");

$num = isset($_REQUEST['num']) && strlen($_REQUEST['num'])>0 ? $_REQUEST['num'] : '000000000000000000';

$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'int25';
$imgtype = isset($_REQUEST['imgtype']) ? $_REQUEST['imgtype'] : 'png';

Image_Barcode::draw($num, $type, $imgtype);

?>
