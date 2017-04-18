<?php
/*
 * Title: error handler
 *
 * @author Eugene Cherkassky
 * @email i@cherkassky.kiev.ua
 * @version 2.0
 */

//handle all DB errors
function handleDbErrors($error_obj) {

	$display_str = $error_obj->getMessage()."<br>".$error_obj->getDebugInfo();
	$log_str = date("d/m/Y H:i")." :: ".$error_obj->getMessage()."\n".$error_obj->getDebugInfo()."\n------------------------------------------------------\n";

	switch (DEBUG_MODE) {
		case 0:// just exit
				exit;
		        break;
		case 1:// display errors
		        exit($display_str);
		        break;
		case 2:// log errors
		        error_log($log_str, 3, '../logs/dberror.log');
				exit;
		        break;
		case 3:// display&log errors
		        error_log($log_str, 3, '../logs/dberror.log');
		        exit($display_str);
		        break;
	}//switch
}//handleDbErrors

?>