<?
function _dump($val) {
	echo '<pre>';
	var_dump($val);
	echo '</pre>';
}

  ini_set('soap.wsdl_cache_enabled', '0');
  require_once 'WSSecurity.class.php';
  $url = 'http://e-insurance.in.ua/ws/servertest.php?WSDL';
			$databaseUsr = 'assistance';
			$databasePwd = 'E4f5tge5Ds1';

  $soapClient = new WSSoapClient($url, array('trace' => 1, 'exception' => 0));		
  $soapClient->__setUsernameToken($databaseUsr, $databasePwd);
//  $soapClient = new SoapClient($url, array('trace' => 1, 'exception' => 0));		

  $params['q'] = 'ibm';
  try {
	  $res=$soapClient->__soapCall('getQuote', array($params));
  }
  catch (Exception $e) {
	_dump($e);
  }


				echo "REQUEST:\n" . $soapClient->__getLastRequest() . "\n";
				echo "Response:\n" . $soapClient->__getLastResponse() . "\n";
_dump($res);

?>