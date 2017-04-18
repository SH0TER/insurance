<?php

function smarty_modifier_in_array($array, $value)
{
var_dump($value);
var_dump($array);
exit;

    return in_array($value, $array);
}

?>
