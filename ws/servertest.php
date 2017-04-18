<?php 
function _dump($val) {
	echo '<pre>';
	var_dump($val);
	echo '</pre>';
}

function _dump_file($val) {
	$res = var_export($val, true);
$handle = fopen('dump.dat', 'a');
fwrite($handle, $res) ;
fclose($handle);

}



	ini_set('soap.wsdl_cache_enabled', '0');

$quotes = array( 
  "ibm" => 98.42 
); 

function getQuote($values) { 
  global $quotes;
//  $symbol=(string)$values->q;
//  $values->getQuoteResult = $quotes[$symbol];
$values->getQuoteResult=10.1;
  return $values; 
  return $quotes[$symbol]; 
} 



	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {

		/*$server = new SoapServer("stockquote.wsdl"); 
   		$server->addFunction("getQuote"); 
        $server->handle(); 
        exit; */

		require('soap-server-wsse.php'); 
//$c= file_get_contents('php://input');
/*
$handle = fopen('dump.dat', 'w+');
fwrite($handle, $c) ;
fclose($handle);
*/

		$soap = new DOMDocument(); 
		$soap->load('php://input'); 
		$server = new SoapServer("stockquote.wsdl"); 
		$s = new WSSESoapServer($soap); 
		try { 
		    if ($s->process()) { 
        		$server->addFunction("getQuote"); 
		        $server->handle($s->saveXML()); 
		        exit; 
		    } 
		} catch (Exception $e) { 
			$server->fault(8, $e->getMessage()); 
		} 
		$server->fault(8, "Invalid request"); 
        

	} else {
	     $SoapServer = new SoapServer("stockquote.wsdl"); 
		 $SoapServer->handle();
	}



?>
