<?
function _dump($val) {
	echo '<pre>';
	var_dump($val);
	echo '</pre>';
}

  ini_set('soap.wsdl_cache_enabled', '0');
  require_once 'WSSecurity.class.php';
  $url = 'https://e-insurance.in.ua/synchronization/assistance/policies.php?WSDL';
  $databaseUsr = 'assistance';
  $databasePwd = 'E4f5tge5Ds1';

  $soapClient = new WSSoapClient($url, array('trace' => 1, 'exception' => 0));		
  $soapClient->__setUsernameToken($databaseUsr, $databasePwd);

  $params['request'] = '
  <request>
	<product_type>КАСКО</product_type>
	<agreement_number></agreement_number>
	<insured_company></insured_company>
	<insured_lastname>Рога</insured_lastname>
	<insured_firstname></insured_firstname>
	<insured_patronymic></insured_patronymic>
	<vehicle_number></vehicle_number>
	<vehicle_vin></vehicle_vin>
</request>
  ';
  try {
	  $res=$soapClient->__soapCall('getAgreements', array($params));
  }
  catch (Exception $e) {
	_dump($e);
  }


				echo "REQUEST:\n" . $soapClient->__getLastRequest() . "\n";
				echo "Response:\n" . $soapClient->__getLastResponse() . "\n";
echo $res->getAgreementsResult;

?>