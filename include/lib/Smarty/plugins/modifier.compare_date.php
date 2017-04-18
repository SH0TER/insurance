<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     cat<br>
 * Date:     Feb 24, 2003
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$res|compare_date:date1:date2} 1 - date1 > date2; 0 - date1 = date2; -1 - date1 < date2
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_compare_date($res, $date1, $date2)
{
	if (strtotime($date1) > strtotime($date2)) {
		return 1;
	} elseif (strtotime($date1) == strtotime($date2)) {
		return 0;
	} else {
		return -1;
	}
}

/* vim: set expandtab: */

?>
