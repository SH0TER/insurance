<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty sign modifier plugin
 *
 * Type:     modifier<br>
 * Name:     sign<br>
 * Purpose:  convert string to lowercase
 * @link http://smarty.php.net/manual/en/language.modifier.lower.php
 *          lower (Smarty online manual)
 * @param string
 * @return string
 */
function smarty_modifier_sign($value, $absolute = 0)
{
    return $value . ( ($absolute)? ' грн.' : '%');
}

?>
