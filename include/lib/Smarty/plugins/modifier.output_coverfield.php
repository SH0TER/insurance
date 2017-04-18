<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_output_coverfield($data, $id,$deductible)
{
	$data=unserialize($data);
	if (strlen($data[$id]['deductibleValue'])==0) $data[$id]['deductibleValue']='&nbsp;';
	if (strlen($data[$id]['value'])==0) $data[$id]['value']='&nbsp;';
//	     _dump($data);
	$res='<table cellspacing=0 cellpadding=2 width="100%"><tr>
		<td class="all" align="center" width="20%">'.($data[$id]['value']>0 ?  'Так' : 'Нi').'</td>
		<td width="20%" align="right">&nbsp;&nbsp;&nbsp;Лiмiт&nbsp;</td>
		<td width="20%" class="all" align="center">'.$data[$id]['value'].'</td>
		'.($deductible ? '<td width="20%">&nbsp;&nbsp;&nbsp;Франшиза&nbsp;</td><td width="20%" class="all" align="center">'.$data[$id]['deductibleValue'].'</td>' : 
		'<td width="20%"></td><td width="20%"></td>').'</tr></table>';

    return $res;
}

/* vim: set expandtab: */

?>
