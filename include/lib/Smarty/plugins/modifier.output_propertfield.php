<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_output_propertfield($value)
{

	$res='<table cellspacing=0 cellpadding=2 width="100%"><tr><td class="all" align="center">'.($value ?  $value : '---').'</td></tr></table>';

    return $res;
}

/* vim: set expandtab: */

?>
